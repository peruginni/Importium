<?php

namespace CMS\Multimedia;

use CMS\Common\IBaseDao;
use CMS\Utilities\IPaginator;
use CMS\Utilities\IOrderRule;



/**
 * IAlbumDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IAlbumDao extends IBaseDao
{
    public function listAlbums(IOrderRule $order = null, IPaginator $paginator = null);
}

