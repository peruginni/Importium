<?php

namespace CMS\Security;

/**
 * IPrivilegeDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IPrivilegeDao extends \CMS\Common\IBaseDao
{
    public function findByName($name);
}

