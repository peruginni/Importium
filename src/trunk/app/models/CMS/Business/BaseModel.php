<?php

namespace CMS;

use Doctrine\ORM\EntityManager;

/**
 * BaseModel
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class BaseModel extends \Nette\Object
{
    /** @var EntityManager */
    protected $em;

    public function __construct()
    {
        $this->getEntityManager();
    }

    /**
     * Get entity manager from DoctrineLoader service
     * @return EntityManager
     */
    public function getEntityManager()
    {
        if($this->em == null) {
            $dl = \Nette\Environment::getService('CMS\DoctrineLoader');
            $this->em = $dl->getEntityManager();
        }
        return $this->em;
    }

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }

}


