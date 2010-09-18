<?php

namespace CMS\Dao\Redaction;

use CMS\Entity\Redaction\Menu;

/**
 * IMenuDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IMenuDao
{
    public function findByName();
}
