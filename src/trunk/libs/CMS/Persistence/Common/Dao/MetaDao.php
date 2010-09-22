<?php

namespace CMS\Common;

/**
 * MetaDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class MetaDao extends BaseDao implements IMetaDao
{
    protected $entityName = 'CMS\Common\Meta';

    public function findByKey($key)
    {
        return $this->em->getRepository($this->entityName)->findByKey($key);
    }
}

