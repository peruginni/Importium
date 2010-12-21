<?php

namespace CMS\Multimedia;

use CMS\Common\IBaseDao;
use CMS\Utilities\IPaginator;
use CMS\Utilities\IOrderRule;

/**
 * IImageDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IImageDao extends IBaseDao
{
    public function listImagesByAlbum(Album $album, IOrderRule $order = null, IPaginator $paginator = null);
}

