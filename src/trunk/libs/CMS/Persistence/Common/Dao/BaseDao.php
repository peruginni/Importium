<?php

namespace CMS\Common;

use Nette\Environment;
use Doctrine\ORM\EntityManager;

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

    /** @var array */
    protected $orderByColumns;

    public function __construct()
    {
        $this->getEntityManager();
        $this->getCache();
    }

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

    /** @return array */
    public function getOrderByColumns()
    {
        return $this->orderByColumns;
    }

    public function setOrderByColumns(array $orderByColumns)
    {
        $this->orderByColumns = $orderByColumns;
    }

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

    /** @return \Doctrine\ORM\Query */
    public function findAll(array $orderBy = array())
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('u')->from($this->entityName, 'u');
        $this->configureOrderBy($qb, $orderBy);
        return $qb->getQuery();
    }

    public function findById($id)
    {
        return $this->em->getRepository($this->entityName)->find($id);
    }
    
    protected function configureOrderBy(QueryBuilder &$qb, array $orderBy)
    {
        $columns = $this->getOrderByColumns();
        $orders = array(self::ASC, self::DESC);
        foreach($orderBy as $column => $order) {
            if(!in_array($column, $columns) && !in_array($order, $orders)) {
                throw new InvalidArgumentException();
            }
            $qb->orderBy($column, $order);
        }
    }
}

