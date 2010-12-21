<?php

namespace CMS\Utilities;

/**
 * IOrderRule
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IOrderRule
{
    /**#@+ ordering types */
    const ASC = 'ASC';
    const DESC = 'DESC';
    /**#@- */
    
    public function __construct($property, $ordering = self::ASC);
    public function getProperty();
    public function setProperty($property);
    public function getOrdering();
    public function setOrdering($ordering);
    public function getNextRule();
    public function setNextRule(IOrderRule $rule);
}
