<?php

namespace CMS\Dao;

use CMS\Common\BaseDao;

/**
 * PageDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class PageDao extends BaseDao implements IPageDao
{
    protected $entityName = 'CMS\Redaction\Page';

    public function findByTitle($title)
    {
        return $this->em->getRepository($this->entityName)->findByTitle($title);
    }
}

