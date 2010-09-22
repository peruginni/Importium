<?php

namespace CMS\Multimedia;

/**
 * IImageDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IImageDao extends \CMS\Common\IBaseDao
{
    /**#@+ columns allowed for ordering */
    const ORDER = 'order';
    const DATE_CREATED = 'dateCreated';
    /**#@- */
}

