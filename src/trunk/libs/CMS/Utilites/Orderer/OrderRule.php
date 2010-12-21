<?php

namespace CMS\Utilities;

use CMS\InvalidArgumentException;

/**
 * OrderRule
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class OrderRule implements IOrderRule
{
    protected $property;
    protected $ordering;
    protected $nextRule;
    
    public function __construct($property, $ordering = self::ASC)
    {
        $this->property = $property;
        $this->ordering = $ordering;
    }

    /** @return string */
    public function getProperty()
    {
        return $this->property;
    }

    public function setProperty($property)
    {
        $this->property = $property;
    }

    /** @return string */
    public function getOrdering()
    {
        return $this->ordering;
    }

    public function setOrdering($ordering)
    {
        if($ordering != self::ASC || $ordering != self::DESC) {
            throw new InvalidArgumentException('Allowed ordering is '.self::ASC.', '.self::DESC);
        }
        $this->ordering = $ordering;
    }

    /** @return IOrderRule */
    public function getNextRule()
    {
        return $this->nextRule;
    }

    public function setNextRule(IOrderRule $nextRule)
    {
        $this->nextRule = $nextRule;
    }

}
