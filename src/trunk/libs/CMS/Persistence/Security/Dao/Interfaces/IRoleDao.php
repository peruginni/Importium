<?php

namespace CMS\Security;

/**
 * IRoleDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IRoleDao extends \CMS\Common\IBaseDao
{
    public function findByName($name);
    public function findByParent(Role $parent);
}

