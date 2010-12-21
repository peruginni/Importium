<?php

namespace CMS\Utilities;

/**
 * AscendingOrder
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class AscendingOrder extends OrderRule
{
    public function __construct($property)
    {
        parent::__construct($property, self::ASC);
    }
}
