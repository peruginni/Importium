<?php

namespace CMS\Security;

use CMS\Common\BaseDao;

/**
 * SharingSettingsDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class SharingSettingsDao extends BaseDao implements ISharingSettingsDao
{
    protected $entityName = 'CMS\Security\SharingSettings';
}

