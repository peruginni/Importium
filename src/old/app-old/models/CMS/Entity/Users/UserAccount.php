<?php

namespace CMS\Entity\User;

use DateTime;
use CMS\EntityValidationException;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * UserAccount entity
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class UserAccount
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

    /** @Column(type="string", unique=TRUE) */
    private $username;

    /** @Column(type="string") */
    private $password;

    /** @Column(type="string") */
    private $salt;

    /** @Column(type="string", unique=TRUE) */
    private $email;

    /** @Column(type="string") */
    private $realName;

    /** @Column(type="datetime") */
    private $dateCreated;

    /** @ManyToMany(targetEntity="Role") */
    private $roles;

    /**
     * ------------------------------------------------------------------------
     * Constructor
     * ------------------------------------------------------------------------
     */
    public function __construct()
    {
        $this->roles = new ArrayCollection;
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

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getRealName()
    {
        return $this->realName;
    }

    public function setRealName($realName)
    {
        $this->realName = $realName;
    }
    
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    public function setDateCreated(DateTime $dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles(ArrayCollection $roles)
    {
        $this->roles = $roles;
    }

    public function addRole(Role $role)
    {
        $this->roles->add($role);
    }

    public function removeRole(Role $role)
    {
        $this->roles->remove($role);
    }
}

