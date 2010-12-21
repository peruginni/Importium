<?php

namespace CMS\Common;

use Doctrine\ORM\EntityManager;
use Nette\Caching\ICacheStorage;

/**
 * IBaseDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IBaseDao extends IOrderable
{

    /**
     *
     *  Getters and setters
     *
     */

    public function getEntityName();
    public function setEntityName($entityName);
    public function getEntityManager();
    public function setEntityManager(EntityManager $em);
    public function getCache();
    public function setCache(ICacheStorage $cache);


    /**
     *
     *  Core methods
     *
     */

    public function persist($entity);
    public function remove($entity);
    public function findById($id);
    public function listResults(IFilter $filter = null, IOrderRule $order = null, IPaginator $paginator = null);
}

