<?php

namespace CMS\Redaction;

use CMS\Common\BaseDao;

/**
 * MenuItemDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class MenuItemDao extends BaseDao implements IMenuItemDao
{
    protected $entityName = 'CMS\Redaction\MenuItem';

    protected $orderByColumns = array(
        IMenuItemDao::LANGUAGE,
        IMenuItemDao::ORDER,
        IMenuItemDao::TITLE
    );

}

