<?php

namespace CMS\Dao;

use Doctrine\ORM\EntityManager;

/**
 * IBaseDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IBaseDao
{
    public function getEntityName();
    public function setEntityName($entityName);
    public function getEntityManager();
    public function setEntityManager(EntityManager $em);
    
    public function persist($entity);
    public function remove($entity);
    public function findAll();
    public function findById($id);
}

