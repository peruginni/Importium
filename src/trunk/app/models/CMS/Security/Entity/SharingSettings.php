<?php

namespace CMS\Entity;

use Doctrine\Common\Collections\ArrayCollection;


/**
 * SharingSettings
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class SharingSettings
{
    /**#@+ sharing types */
    const TYPE_PUBLIC = 1;
    const TYPE_PRIVATE = 2;
    const TYPE_UNLISTED = 3;
	/**#@-*/

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(type="string") */
    private $authorizationKey;

    /** @Column(type="smallint") */
    private $type;

    /** @ManyToMany(targetEntity="\CMS\Entity\Role") */
    private $allowedRoles;
    
    /** @ManyToMany(targetEntity="\CMS\Entity\Role") */
    private $forbiddenRoles;
   
    public function __construct()
    {
        $this->allowedRoles = new ArrayCollection;
        $this->forbiddenRoles = new ArrayCollection;
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
    public function getAuthorizationKey()
    {
        return $this->authorizationKey;
    }

    public function setAuthorizationKey($authorizationKey)
    {
        $this->authorizationKey = (string) $authorizationKey;
    }

    /** @return int */
    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        switch($type) {
            case self::TYPE_PRIVATE:
            case self::TYPE_PUBLIC:
            case self::TYPE_UNLISTED:
                break;
            default:
                throw new \ArgumentOutOfRangeException();
        }

        $this->type = (int) $type;
    }

    /** @return ArrayCollection */
    public function getAllowedRoles()
    {
        return $this->allowedRoles;
    }

    public function setAllowedRoles(ArrayCollection $allowedRoles)
    {
        $this->allowedRoles = $allowedRoles;
    }

    public function addAllowedRole(Role $allowedRole)
    {
        $this->allowedRoles->add($allowedRole);
    }

    public function removeAllowedRole(Role $allowedRole)
    {
        $this->allowedRoles->remove($allowedRole);
    }

    /** @return ArrayCollection */
    public function getForbiddenRoles()
    {
        return $this->forbiddenRoles;
    }

    public function setForbiddenRoles(ArrayCollection $forbiddenRoles)
    {
        $this->forbiddenRoles = $forbiddenRoles;
    }

    public function addForbiddenRole(Role $forbiddenRole)
    {
        $this->forbiddenRoles->add($forbiddenRole);
    }

    public function removeForbiddenRole(Role $forbiddenRole)
    {
        $this->forbiddenRoles->remove($forbiddenRole);
    }
}

