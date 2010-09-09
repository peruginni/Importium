<?php

namespace CMS\Entity\User;

/**
 * Privilege
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class Privilege
{
    /**
     * ------------------------------------------------------------------------
     * Attributes
     * ------------------------------------------------------------------------
     */

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(type="string", length=64) */
    private $name;


    /**
     * ------------------------------------------------------------------------
     * Constructor
     * ------------------------------------------------------------------------
     */

    public function __construct()
    {

    }

    /**
     * ------------------------------------------------------------------------
     * Getters and setters
     * ------------------------------------------------------------------------
     */

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

}


