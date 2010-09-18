<?php

namespace CMS\Dao;

/**
 * ITagDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface ITagDao
{
    public function findByTitle($title);
}

