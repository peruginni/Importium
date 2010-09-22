<?php

namespace CMS\Common;

/**
 * IMetaDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IMetaDao extends IBaseDao
{
    public function findByKey($key);
}

