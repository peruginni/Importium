<?php

namespace Om\Multimedia;

use DateTime;

/**
 * Used for virtual organization of images
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class Album extends Folder
{

	/** @Column(type="string") */
	private $location;

	/** @Column(type="datetime") */
	private $dateCaptured;



	/**
	 *
	 *  Getters and setters
	 *
	 */



	/**
	 * Get/set location
	 */
	public function getLocation()
	{
		return $this->location;
	}

	public function setLocation($location)
	{
		$this->location = (string) $location;
	}



	/**
	 * Get/set captured date
	 */
	public function getDateCaptured()
	{
		return $this->dateCaptured;
	}

	public function setDateCaptured(DateTime $dateCaptured)
	{
		$this->dateCaptured = $dateCaptured;
	}

}


