<?php

namespace CMS\Multimedia;

use CMS\Common\BaseDao;

/**
 * FolderDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class FolderDao extends BaseDao implements IFolderDao
{
    protected $entityName = 'CMS\Multimedia\Folder';

    protected $orderByColumns = array(
        IFileDao::DATE_CREATED,
        IFileDao::TITLE
    );
}

