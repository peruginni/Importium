<?php

namespace CMS\Security;

/**
 * Permission
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class Permission
{
    /** @Id @Column(type="integer") @GeneratedValue */
    private $id;

    /** @ManyToOne(targetEntity="\CMS\Security\Resource") */
    private $resource;

    /** @ManyToOne(targetEntity="\CMS\Security\Role") */
    private $role;

    /** @ManyToOne(targetEntity="\CMS\Security\Privilege") */
    private $privilege;

    /** * @Column(type="boolean") */
    private $isAllowed;

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

    /** @return Resource */
    public function getResource()
    {
        return $this->resource;
    }

    public function setResource(Resource $resource)
    {
        $this->resource = $resource;
    }

    /** @return Role */
    public function getRole()
    {
        return $this->role;
    }

    public function setRole(Role $role)
    {
        $this->role = $role;
    }

    /** @return Privilege */
    public function getPrivilege()
    {
        return $this->privilege;
    }

    public function setPrivilege(Privilege $privilege)
    {
        $this->privilege = $privilege;
    }

    /** @return boolean */
    public function isAllowed()
    {
        return $this->isAllowed;
    }

    /** @return boolean */
    public function getIsAllowed()
    {
        return $this->isAllowed;
    }

    public function setIsAllowed($isAllowed)
    {
        $this->isAllowed = (boolean) $isAllowed;
    }

}
