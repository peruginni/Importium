<?php

namespace CMS\Multimedia;

use CMS\Common\IOrderable;

/**
 * IFileBusiness
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IFileBusiness extends IBaseBusiness
{
    public function create(File $file);
    public function edit(File $file);
    public function remove(File $file);
    public function findById($id);
    public function listFilesByFolder(Folder $folder, $orderBy = null, $ordering = IOrderable::ACS, $page = 0, $perPage = 15, $countOnly = false);
}

