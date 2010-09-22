<?php

namespace CMS\Common;

use Nette\Environment;
use Nette\Caching\ICacheStorage;
use BadMethodCallException;

/**
 * BaseBusiness
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
abstract class BaseBusiness implements IBaseBusiness
{
    /** @var string */
    protected $daoType;

    /** @var IBaseDao */
    protected $dao;

    /** @var ICacheStorage */
    protected $cache;

    public function __construct()
    {
        $this->getDao();
        $this->getCache();
    }

    /** @return string */
    public function getDaoType()
    {
        return $this->daoType;
    }

    public function setDaoType($daoType)
    {
        $this->daoType = (string) $daoType;
    }

    /** @return IBaseDao */
    public function getDao()
    {
        if($this->dao == null) {
            $this->dao = Environment::getService($this->daoType);
        }
        return $this->dao;
    }

    public function setDao(IBaseDao $dao)
    {
        $this->dao = $dao;
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

    public function persist($entity)
    {
        $this->dao->persist($entity);
    }

    public function remove($entity)
    {
        $this->dao->remove($entity);
    }

    public function findAll()
    {
        return $this->dao->findAll();
    }

    public function findById($id)
    {
        return $this->dao->findById($id);
    }

    public function __call($method, $arguments)
    {
        if(method_exists($this->dao, $method)) {
            call_user_method($method, $this->dao, $arguments);
        } else {
            throw new BadMethodCallException();
        }
    }
}

