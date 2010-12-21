<?php

namespace CMS\Multimedia;

use CMS\Common\IBaseDao;
use CMS\Utilities\IOrderRule;
use CMS\Utilities\IPaginator;



/**
 * IFolderDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IFolderDao extends IBaseDao
{
    public function listFolders(IOrderRule $order = null, IPaginator $paginator = null);
}
