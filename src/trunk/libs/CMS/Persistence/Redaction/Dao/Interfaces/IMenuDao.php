<?php

namespace CMS\Redaction;

/**
 * IMenuDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IMenuDao extends \CMS\Common\IBaseDao
{
    /**#@+ columns allowed for ordering */
    const NAME = 'name';
    /**#@- */

    public function findByName($name);
}

