<?php

namespace CMS\Multimedia;

use CMS\Common\BaseDao;

/**
 * AlbumDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class AlbumDao extends FileDao implements IAlbumDao
{
    protected $entityName = 'CMS\Multimedia\Album';

    protected $orderByColumns = array(
        IFileDao::DATE_CREATED,
        IFileDao::TITLE,
        IAlbumDao::DATE_CAPTURED,
        IAlbumDao::LOCATION
    );
}

