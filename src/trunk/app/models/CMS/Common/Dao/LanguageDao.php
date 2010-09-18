<?php

namespace CMS\Dao;

/**
 * LanguageDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class LanguageDao extends BaseDao implements ILanguageDao
{
    protected $entityName = 'CMS\Entity\Language';

    public function findOneByTag($tag)
    {
        return $this->em->getRepository($this->entityName)->findOneByTag($tag);
    }
}

