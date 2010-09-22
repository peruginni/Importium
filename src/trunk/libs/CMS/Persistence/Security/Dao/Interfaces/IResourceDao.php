<?php

namespace CMS\Security;

/**
 * IResourceDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IResourceDao extends \CMS\Common\IBaseDao
{
    public function findByName($name);
}

