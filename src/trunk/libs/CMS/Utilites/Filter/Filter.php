<?php

namespace CMS\Utilities;

use CMS\InvalidArgumentException;
use in_array;
use implode;
use strtoupper;

/**
 * Filter
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class Filter implements IFilter
{
    protected $property;
    protected $value;
    protected $conjuction;
    protected $nextFilter;
    
    public function __construct($property, $value, $conjuction = self::CONJUCTION_NONE)
    {
        $this->property = $property;
        $this->value = $value;
        $this->conjuction = $value;
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

    /** @return mixed */
    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value= $value;
    }

    /** @return string */
    public function getConjuction()
    {
        return $this->conjuction;
    }

    public function setConjuction($conjuction)
    {
        $conjunction = strtoupper($conjuction);
        $allowedConjuctions = array(
            self::CONJUCTION_NONE,
            self::CONJUCTION_AND,
            self::CONJUCTION_OR
        );
        if(!in_array($conjuction, $allowedConjuctions)) {
            throw new InvalidArgumentException('Allowed conjuctions are '.implode(',',$allowedConjuctions));
        }
        $this->conjuction= $conjuction;
    }

    /** @return IFilter */
    public function getNextFilter()
    {
        return $this->nextFilter;
    }

    public function setNextFilter(IFilter $nextFilter)
    {
        $this->nextFilter = $nextFilter;
    }

}
