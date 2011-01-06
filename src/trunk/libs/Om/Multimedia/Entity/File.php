<?php

namespace Om\Multimedia;

use Om\Core\BaseEntity;
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

	/**
	* relative to storage direcory (specified in model),
	* but universal part for both editing and presenting
	* @Column(type="text")
	*/
	private $path;

	/** @Column(type="string") */
	private $filename;

	/** @Column(type="string") */
	private $extension;

	/** @Column(type="datetime") */
	private $dateCreated;

	/**
	 * Owning side for relationship with Folder
	 * @ManyToOne(targetEntity="\Om\Multimedia\Folder")
	 */
	private $folder;



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
	 * Get/set path
	 */
	public function getPath()
	{
		return $this->path;
	}

	public function setPath($path)
	{
		$this->path = (string) $path;
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
	 * Get full path to file (path plus filename and extension)
	 */
	public function getFullPath()
	{
		return $this->getPath().'/'.$this->getFilename().'.'.$this->getExtension();
	}
    
}
