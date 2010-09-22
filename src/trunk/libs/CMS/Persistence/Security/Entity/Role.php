<?php

namespace CMS\Security;

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
    /** @Id @Column(type="integer") @GeneratedValue */
    private $id;

    /** @Column(type="string", length=64) */
    private $name;

    /** @ManyToOne(targetEntity="\CMS\Security\Role") */
    private $parent;

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
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /** @return Role */
    public function getParent()
    {
        return $this->parent;
    }

    public function setParent(Role $parent)
    {
        $this->parent = $parent;
    }
    
}

