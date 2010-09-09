<?php

namespace CMS\Entity\User;

/**
 * Role
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class Role
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

    /** @Column(type="string", length=64, unique=TRUE) */
    private $name;

    /** @ManyToOne(targetEntity="Role") */
    private $parentRole;

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

    public function getParentRole()
    {
        return $this->parentRole;
    }

    public function setParentRole(Role $parentRole)
    {
        $this->parentRole = $parentRole;
    }
}


