<?php

namespace CMS\Common;

/**
 * ILanguageDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface ILanguageDao extends IBaseDao
{
    public function findByTag($tag);
}

