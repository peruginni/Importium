<?php

namespace CMS\Redaction;

/**
 * IPageDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IPageDao extends \CMS\Common\IBaseDao
{
    public function findByTitle($title);
}

