<?php

namespace CMS\Multimedia;

use CMS\Common\IBaseDao;
use CMS\Utilities\IOrderRule;
use CMS\Utilities\IPaginator;



/**
 * IFileDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IFileDao extends IBaseDao
{
    public function listFilesByFolder(Folder $folder, IOrderRule $order = null, IPaginator $paginator = null);
}

