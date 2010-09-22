<?php

namespace CMS\Security;

use CMS\Common\BaseDao;

/**
 * RoleDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class RoleDao extends BaseDao implements IRoleDao
{
    protected $entityName = 'CMS\Security\Role';

    public function findByName($name)
    {
        return $this->em->getRepository($this->entityName)->findByName($name);
    }

    public function findByParent(Role $parent)
    {
        return $this->em->getRepository($this->entityName)->findByParent($parent);
    }
}

