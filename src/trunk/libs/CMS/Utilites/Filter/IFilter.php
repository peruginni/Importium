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
    /**#@+ conjuctions */
    const CONJUCTION_NONE = '';
    const CONJUCTION_AND = 'AND';
    const CONJUCTION_OR = 'OR';
    /**#@- */

    public function __construct($property, $value, $conjuction);
    public function getProperty();
    public function setProperty($property);
    public function getValue();
    public function setValue($value);
    public function getConjuction();
    public function setConjuction($conjuction);
    public function getNextFilter();
    public function setNextFilter(IFilter $nextFilter);
}
