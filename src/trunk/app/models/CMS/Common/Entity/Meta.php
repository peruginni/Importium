<?php

namespace CMS\Entity;

/**
 * Meta - key-value pair
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class Meta
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(type="string") */
    private $key;

    /** @Column(type="string") */
    private $value;

    public function __construct()
    {
        
    }

    /** @return int */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    /** @return string */
    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = (string) $key;
    }

    /** @return string */
    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = (string) $value;
    }

}

