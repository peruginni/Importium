<?php

namespace CMS\Multimedia;

/**
 * IFolderDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IFolderDao extends \CMS\Common\IBaseDao
{
    /**#@+ columns allowed for ordering */
    const DATE_CREATED = 'dateCreated';
    const TITLE = 'title';
    /**#@- */
}

