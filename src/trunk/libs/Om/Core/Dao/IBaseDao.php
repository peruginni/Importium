<?php

namespace Om\Core;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Nette\Caching\ICacheStorage;
use Om\Utilities\IPaginator;

/**
 * General interface for DAO objects
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IBaseDao
{

	/**
	 *
	 *  Getters and setters
	 *
	 */



	/**
	 * Get fully canonized entity name (with namespace)
	 */
	public function getEntityName();



	/**
	 * Get/set shortcut to Doctrine's entity manager
	 */
	public function getEntityManager();
	public function setEntityManager(EntityManager $em);



	/**
	 * Get/set cache manager
	 */
	public function getCache();
	public function setCache(ICacheStorage $cache);

	

	/**
	 *
	 *  Core methods
	 *
	 */



	/**
	 * Persists given entity.
	 */
	public function persist($entity);



	/**
	 * Removes given entity
	 *
	 * @param
	 */
	public function remove($entity);



	/**
	 * Find entity by id
	 *
	 * @param mixed $id entity's id
	 */
	public function findById($id);



	/**
	 * Find all entities. Can be limited by paginator
	 */
	public function findAll(IPaginator $paginator = null);

	

}

