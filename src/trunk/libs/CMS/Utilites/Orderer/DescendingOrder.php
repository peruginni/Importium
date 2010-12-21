<?php

namespace CMS\Utilities;

/**
 * DescendingOrder
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class DescendingOrder extends OrderRule
{
    public function __construct($property)
    {
        parent::__construct($property, self::DESC);
    }   
}
