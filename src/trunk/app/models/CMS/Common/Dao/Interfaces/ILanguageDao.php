<?php

namespace CMS\Dao;

/**
 * ILanguageDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface ILanguageDao
{
    public function findOneByTag($tag);
}

