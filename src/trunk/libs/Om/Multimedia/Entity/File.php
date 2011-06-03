<?php

namespace Om\Multimedia;

use Om\Core\BaseEntity;
use Om\Users\UserAccount;
use DateTime;

/**
 * File
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class File extends BaseEntity
{

	/** @Id @Column(type="integer") @GeneratedValue */
	private $id;

	/** @Column(type="string") */
	private $title;

	/** @Column(type="string") */
	private $filename;

	/** @Column(type="string") */
	private $extension;

	/** @Column(type="datetime") */
	private $dateCreated;

	/**
	 * Owning side for relationship with Folder (changes persisted)
	 * @ManyToOne(targetEntity="\Om\Multimedia\Folder")
	 */
	private $folder;

	/**
	 * Owning side for relationship with UserAccount (changes persisted)
	 * @ManyToOne(targetEntity="\Om\Users\UserAccount")
	 */
	private $author;



	public function __construct()
	{
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
		$this->id = (int) $id;
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
	 * Get/set filename
	 */
	public function getFilename()
	{
		return $this->filename;
	}

	public function setFilename($filename)
	{
		$this->filename = (string) $filename;
	}



	/**
	 * Get/set extension
	 */
	public function getExtension()
	{
		return $this->extension;
	}

	public function setExtension($extension)
	{
		$this->extension = (string) $extension;
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



	/**
	 * Get/set folder
	 */
	public function getFolder()
	{
		return $this->folder;
	}

	public function setFolder(Folder $folder)
	{
		$this->folder = $folder;
	}



	/**
	 * Get/set author
	 */
	public function getAuthor()
	{
		return $this->author;
	}

	public function setAuthor(UserAccount $author)
	{
		$this->author = $author;
	}



	/**
	 * Get filename and extension
	 */
	public function getBasename()
	{
		return $this->getFilename().'.'.$this->getExtension();
	}
    
}
