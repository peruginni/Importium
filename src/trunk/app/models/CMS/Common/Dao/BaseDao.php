<?php

namespace CMS\Dao;

use Doctrine\ORM\EntityManager;

/**
 * BaseDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
abstract class BaseDao extends \Nette\Object implements IBaseDao
{
    /** @var string */
    protected $entityName;

    /** @var EntityManager */
    protected $em;

    public function __construct()
    {
        $this->getEntityManager();
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
            $dl = \Nette\Environment::getService('DoctrineLoader');
            $this->em = $dl->getEntityManager();
        }
        return $this->em;
    }

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
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

    public function findAll()
    {
        return $this->em->getRepository($this->entityName)->findAll();
    }

    public function findById($id)
    {
        return $this->em->getRepository($this->entityName)->find($id);
    }
}

