<?php

namespace CMS\Multimedia;

/**
 * IFileDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IFileDao extends \CMS\Common\IBaseDao
{
    /**#@+ columns allowed for ordering */
    const DATE_CREATED = 'dateCreated';
    const TITLE = 'title';
    /**#@- */
    
    public function findByFolder(Folder $folder, array $orderBy = array());
    public function findByTitle($title);
}

