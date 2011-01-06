<?php

namespace Om\Multimedia;

use Om\Core\BaseEntity;
use DateTime;

/**
 * Used for virtual organization of files
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 * @MappedSuperclass
 */
class Folder extends BaseEntity
{
	
	/** @Id @Column(type="integer") @GeneratedValue */
	private $id;

	/** @Column(type="string") */
	private $title;

	/** @Column(type="string") */
	private $description;

	/** @Column(type="datetime") */
	private $dateCreated;



	public function __construct($id = null)
	{
		$this->id = $id;
		$this->dateCreated = new DateTime();
	}



	/**
	 *
	 *  Getters and setters
	 *
	 */



	/**
	 * Get/set id
	 */
	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}



	/**
	 * Get/set title
	 */
	public function getTitle()
	{
		return $this->title;
	}

	public function setTitle($title)
	{
		$this->title = (string) $title;
	}



	/**
	 * Get/set description
	 */
	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = (string) $description;
	}



	/**
	 * Get/set date created
	 */
	public function getDateCreated()
	{
		return $this->dateCreated;
	}

	public function setDateCreated(DateTime $dateCreated)
	{
		$this->dateCreated = $dateCreated;
	}

}


