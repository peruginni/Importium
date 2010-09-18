<?php

namespace CMS\Dao\Redaction;

use CMS\Entity\Redaction\Page;

/**
 * IPageDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IPageDao
{
    public function findByTitle($title);
}

