<?php

namespace CMS\Security;

/**
 * IRoleBusiness
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IRoleBusiness extends \CMS\Common\IBaseBusiness
{
    /**#@+ have unique names */
    const ADMIN = 'admin';
    const EDITOR = 'editor';
    const GUEST = 'guest';
    /**#@- */

    public function findByName($name);
}

