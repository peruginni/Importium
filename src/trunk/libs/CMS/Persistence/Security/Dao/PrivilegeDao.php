<?php

namespace CMS\Security;

use CMS\Common\BaseDao;

/**
 * PrivilegeDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class PrivilegeDao extends BaseDao implements IPrivilegeDao
{
    protected $entityName = 'CMS\Security\Privilege';

    public function findByName($name)
    {
        return $this->em->getRepository($this->entityName)->findByName($name);
    }
}

