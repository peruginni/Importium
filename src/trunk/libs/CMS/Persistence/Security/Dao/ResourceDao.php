<?php

namespace CMS\Security;

use CMS\Common\BaseDao;

/**
 * ResourceDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class ResourceDao extends BaseDao implements IResourceDao
{
    protected $entityName = 'CMS\Security\Resource';

    public function findByName($name)
    {
        return $this->em->getRepository($this->entityName)->findByName($name);
    }
}

