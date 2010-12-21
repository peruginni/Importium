<?php

namespace CMS\Common;

use strtoupper;
use Nette\Environment;
use Nette\Caching\ICacheStorage;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use CMS\Utilities\IPaginator;
use CMS\Utilities\IFilter;
use CMS\Utilities\IOrderRule;
use CMS\Utilities\IPaginator;



/**
 * BaseDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
abstract class BaseDao implements IBaseDao
{
    /** @var string */
    protected $entityName;

    /** @var EntityManager */
    protected $em;

    /** @var ICacheStorage */
    protected $cache;



    public function __construct()
    {
        $this->getEntityManager();
        $this->getCache();
    }



    /** Getters and setters *************************************************/


    
    /** @return string */
    public function getEntityName()
    {
        return $this->entityName;
    }
    


    public function setEntityName(string $entityName)
    {
        $this->entityName = $entityName;

    }



    /** @return EntityManager */
    public function getEntityManager()
    {
        if($this->em == null) {
            $dl = Environment::getService('DoctrineLoader');
            $this->em = $dl->getEntityManager();
        }
        return $this->em;
    }



    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }



    /** @return ICacheStorage */
    public function getCache()
    {
        if($this->cache === null) {
            $this->cache = Environment::getCache();
        }
        return $this->cache;
    }



    public function setCache(ICacheStorage $cache)
    {
        $this->cache = $cache;
    }



    /** Core methods *******************************************************/



    public function persist($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }



    public function remove($entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
    }



    public function findById($id)
    {
        return $this->em->getRepository($this->getEntityName())->find($id);
    }



    /** @return array */
    public function listResults(IFilter $filter = null, IOrderRule $order = null, IPaginator $paginator = null)
    {
        if($paginator !== null) {
            // find total results
            $qb = $this->createListQuery(true);
            $this->applyFilterToQuery($qb, $filter);
            $this->applyOrderToQuery($qb, $order);
            $totalResults = $qb->getQuery()->getSingleScalarResult();
            $paginator->setTotalResults($totalResults);
        }

        // find entites
        $qb = $this->createListQuery(false);
        $this->applyFilterToQuery($qb, $filter);
        $this->applyOrderToQuery($qb, $order);
        $query = $qb->getQuery();
        if($paginator !== null) {
            $page = $paginator->getCurrentPage() - 1;
            $perPage = $paginator->getResultsPerPage();
            $query->setFirstResult($page*$perPage);
            $query->setMaxResults($perPage);
        }
        return $query->getResult();
    }



    /** Helpers *************************************************************/



    protected function applyFilterToQuery(QueryBuilder $qb, IFilter $filter)
    {
        while($filter !== null) {
            $property = $filter->getProperty();
            switch($filter->getConjuction()) {
                case IFilter::CONJUCTION_NONE:
                    $qb->where('e.'.$property.' = :'.$property);
                    break;
                case IFilter::CONJUCTION_AND:
                    $qb->andWhere('e.'.$property.' = :'.$property);
                    break;
                case IFilter::CONJUCTION_OR:
                    $qb->orWhere('e.'.$property.' = :'.$property);
                    break;
                default:
                    throw new InvalidArgumentException('Invalid filter conjuction');
            }
            $qb->setParameter(':'.$property, $filter->getValue());
            $filter = $filter->getNextFilter();
        }
    }



    protected function applyOrderToQuery(QueryBuilder $qb, IOrderRule $order)
    {
        while($order !== null) {
            $qb->orderBy($order->getProperty(), $order->getOrdering());
            $order = $order->getNextRule();
        }
    }



    /** @return QueryBuilder */
    protected function createListQuery($onlyCount)
    {
        $qb = $this->em->createQueryBuilder();

        if($onlyCount)
            $qb->select('COUNT(e.id)');
        else
            $qb->select('e');

        $qb->from($this->getEntityName(), 'e');
        return $qb;
    }

}

