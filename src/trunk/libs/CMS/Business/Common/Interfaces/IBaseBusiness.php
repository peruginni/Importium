<?php

namespace CMS\Common;

use CMS\Common\IBaseDao;

/**
 * IBaseBusiness
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IBaseBusiness extends IOrderable
{   
    public function getDao($daoServiceIdentifier);
    public function getCache();
    public function setCache(ICacheStorage $cache);
}

