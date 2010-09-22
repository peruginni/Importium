<?php

namespace CMS\Multimedia;

/**
 * IAlbumDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IAlbumDao extends IFileDao
{
    /**#@+ columns allowed for ordering */
    const DATE_CAPTURED = 'dateCaptured';
    const LOCATION = 'location';
    /**#@- */
}

