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
    /** @var ICacheStorage */
    protected $cache;

    public function __construct()
    {
        $this->getCache();
    }
    
    /** @return IBaseDao */
    public function getDao($daoServiceIdentifier)
    {
        return Environment::getService($this->daoType);
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
}

