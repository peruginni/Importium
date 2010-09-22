<?php

namespace CMS\Security;

use CMS\Common\BaseDao;

/**
 * PermissionDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class PermissionDao extends BaseDao implements IPermissionDao
{
    protected $entityName = 'CMS\Security\Permission';

    public function findByRole(Role $role)
    {
        return $this->em->getRepository($this->entityName)->findByRole($role);
    }

    public function findByResource(Resource $resource)
    {
        return $this->em->getRepository($this->entityName)->findByResource($resource);
    }
}

