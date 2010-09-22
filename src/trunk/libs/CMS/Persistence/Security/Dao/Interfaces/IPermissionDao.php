<?php

namespace CMS\Security;

/**
 * IPermissionDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IPermissionDao extends \CMS\Common\IBaseDao
{
    public function findByRole(Role $role);
    public function findByResource(Resource $resource);
}

