<?php

namespace CMS\Multimedia;

use CMS\Common\IOrderable;

/**
 * IFolderBusiness
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IFolderBusiness extends IBaseBusiness
{
    public function create(Folder $folder);
    public function edit(Folder $folder);
    public function remove(Folder $folder);
    public function findById($id);
    public function listFolders($orderBy = null, $ordering = IOrderable::ASC, $page = 0, $perPage = 15, $countOnly = false);
}

