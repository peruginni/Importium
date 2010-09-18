<?php

namespace CMS\Dao;

/**
 * TagDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class TagDao extends BaseDao implements ITagDao
{
    protected $entityName = 'CMS\Entity\Tag';

    public function findByTitle($title)
    {
        return $this->em->getRepository($this->entityName)->findOneByTitle($title);
    }
}

