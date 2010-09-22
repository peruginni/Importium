<?php

namespace CMS\Common;

/**
 * ITagDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface ITagDao extends IBaseDao
{
    public function findByTitle($title);
}

