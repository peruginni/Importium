<?php

namespace Om\Users;

use Om\Core\BaseEntity;
use DateTime;

/**
 * Represents user account information
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class UserAccount extends BaseEntity
{
    
	/** @Id @Column(type="integer") @GeneratedValue */
	private $id;

	/** @Column(type="string", unique=true) */
	private $username;

	/** @Column(type="string") */
	private $password;

	/** @Column(type="string") */
	private $salt;

	/** @Column(type="string", unique=true) */
	private $email;

	/** @Column(type="string") */
	private $realName;

	/** @Column(type="datetime") */
	private $dateCreated;



	public function __construct()
	{
		// empty
	}



	/**
	 *
	 *  Getters and setters
	 *
	 */



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
	public function getUsername()
	{
		return $this->username;
	}

	public function setUsername($username)
	{
		$this->username = (string) $username;
	}



	/** @return string */
	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($password)
	{
		$this->password = (string) $password;
	}



	/** @return string */
	public function getSalt()
	{
		return $this->salt;
	}

	public function setSalt($salt)
	{
		$this->salt = (string) $salt;
	}



	/** @return string */
	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = (string) $email;
	}



	/** @return string */
	public function getRealName()
	{
		return $this->realName;
	}

	public function setRealName($realName)
	{
		$this->realName = (string) $realName;
	}



	/** @return DateTime */
	public function getDateCreated()
	{
		return $this->dateCreated;
	}

	public function setDateCreated(DateTime $dateCreated)
	{
		$this->dateCreated = $dateCreated;
	}

}

