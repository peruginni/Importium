<?php

namespace Om\Core;

use Nette\Environment;
use Nette\Caching\ICacheStorage;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Om\Utilities\IPaginator;



/**
 * General class for DAO objects
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
abstract class BaseDao implements IBaseDao
{
	
	/**
	 * Instance of entity manager
	 * 
	 * @var EntityManager
	 */
	protected $em;

	/**
	 * Instance of cache manager
	 *
	 * @var ICacheStorage
	 */
	protected $cache;



	/**
	 * Initialize entity manager and cache
	 */
	public function __construct()
	{
		// empty
	}



	/**
	 *
	 *  Getters and setters
	 *
	 */



	/**
	 * Get shortcut to Doctrine's entity manager
	 *
	 * @return EntityManager
	 */
	public function getEntityManager()
	{
		if($this->em == null) {
			$dl = Environment::getService('DoctrineLoader');
			$this->em = $dl->getEntityManager();
		}
		return $this->em;
	}


	/**
	 * Set shortcut to Doctrine's entity manager
	 *
	 * @param EntityManager $em
	 */
	public function setEntityManager(EntityManager $em)
	{
		$this->em = $em;
	}



	/**
	 * Get cache manager
	 *
	 * @return ICacheStorage
	 */
	public function getCache()
	{
		if($this->cache === null) {
			$this->cache = Environment::getCache();
		}
		return $this->cache;
	}



	/**
	 * Set cache manager
	 *
	 * @param ICacheStorage $cache
	 */
	public function setCache(ICacheStorage $cache)
	{
		$this->cache = $cache;
	}



	/**
	 *
	 *  Core methods
	 *
	 */



	/**
	 * Persists given entity.
	 */
	public function persist($entity)
	{
		$em = $this->getEntityManager();
		$em->persist($entity);
		$em->flush();
	}



	/**
	 * Removes given entity
	 */
	public function remove($entity)
	{
		$em = $this->getEntityManager();
		$em->remove($entity);
		$em->flush();
	}



	/**
	 * Find entity by id
	 */
	public function findById($id)
	{
		$em = $this->getEntityManager();
		return $em->getRepository($this->getEntityName())->find($id);
	}



	/**
	 * Find all entities. Can be limited by paginator
	 *
	 * @return ArrayCollection
	 */
	public function findAll(IPaginator $paginator = null)
	{
		$qb = $this->createQueryBuilder();

		if($paginator !== null) {
			$this->setupPaginator($qb, $paginator);
		}

		return $qb->getQuery()->getResult();
	}
	
	

	/**
	 *
	 *  Helpers
	 *
	 */



	/**
	 * Create query builder object
	 * 
	 * @return QueryBuilder
	 */
	protected function createQueryBuilder()
	{
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$qb->select('e');
		$qb->from($this->getEntityName(), 'e');
		return $qb;
	}



	/**
	 * Setup paginator object from given QueryBuilder instance. Before using
	 * this method querybuilder object should be prepared for querying
	 *
	 * @param QueryBuilder $queryBuilder
	 * @param IPaginator $paginator
	 * @return QueryBuilder
	 */
	protected function setupPaginator(QueryBuilder $queryBuilder, IPaginator $paginator)
	{
		$from = $queryBuilder->getDQLPart('from');
		$fromAlias = $from[0]->getAlias();
		
		// finding total results for query
		$queryBuilderForPaginator = clone $queryBuilder;
		$queryBuilderForPaginator->select('COUNT('.$fromAlias.'.id)');
		$totalResults = $queryBuilderForPaginator->getQuery()->getSingleScalarResult();
		$paginator->setTotalResults($totalResults);

		// configure given querybuilder
		$page = $paginator->getCurrentPage() - 1;
		$perPage = $paginator->getResultsPerPage();
		$queryBuilder->setFirstResult($page*$perPage);
		$queryBuilder->setMaxResults($perPage);

		return $queryBuilder;
	}

}

