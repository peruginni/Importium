<?php

namespace CMS\Common;

/**
 * LanguageDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class LanguageDao extends BaseDao implements ILanguageDao
{
    protected $entityName = 'CMS\Common\Language';

    public function findByTag($tag)
    {
        $cacheId = 'languageDao.'.$tag;
        if(!isset($this->cache[$cacheId])) {
            $this->cache[$cacheId] = $this->em->getRepository($this->entityName)->findOneByTag($tag);
        }
        return $this->cache[$cacheId];
    }
}

