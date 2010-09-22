<?php

namespace CMS\Common;

/**
 * ILanguageBusiness
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface ILanguageBusiness extends IBaseBusiness
{
    /**#@+
     * language codes
     * http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
     */
    const CZECH = 'cs';
    const SLOVAK = 'sk';
    const ENGLISH = 'en';
    /**#@- */

    public function findByTag($string);
}

