<?php

namespace CMS\Utilities;

/**
 * IFilter
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IFilter
{
	public function __construct($expression, $parameters);
}
