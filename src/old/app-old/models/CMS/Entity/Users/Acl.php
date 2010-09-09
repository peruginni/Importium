<?php

namespace CMS\Entity\User;

/**
 * Acl
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class Acl
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

    /** @Column(type="boolean") */
    private $isAllowed;

    /**
     * ------------------------------------------------------------------------
     * Relations
     * ------------------------------------------------------------------------
     */

    /** @ManyToOne(targetEntity="Role") */
    private $role;

    /** @ManyToOne(targetEntity="Privilege") */
    private $privilege;

    /** @ManyToOne(targetEntity="Resource") */
    private $resource;


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

    public function getIsAllowed()
    {
        return $this->isAllowed;
    }

    public function setIsAllowed($isAllowed)
    {
        $this->isAllowed = $isAllowed;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole(Role $role)
    {
        $this->role = $role;
    }

    public function getPrivilege()
    {
        return $this->privilege;
    }

    public function setPrivilege(Privilege $privilege)
    {
        $this->privilege = $privilege;
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function setResource(Resource $resource)
    {
        $this->resource = $resource;
    }

}


