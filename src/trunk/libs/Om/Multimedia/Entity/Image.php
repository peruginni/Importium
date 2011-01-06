<?php

namespace Om\Multimedia;

use Om\Core\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * Image
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class Image extends BaseEntity
{
	
	/** @Id @Column(type="integer") @GeneratedValue */
	private $id;

	/**
	 * Owning side (changes persisted)
	 * @OneToOne(targetEntity="\Om\Multimedia\File")
	 */
	private $file;

	/** @Column(type="string") */
	private $description;

	/**
	 * Inversed side (changes ignored)
	 * @OneToMany(targetEntity="\Om\Multimedia\Image", mappedBy="sourceImage")
	 */
	private $thumbnails;

	/**
	 * Owning side (changes persisted)
	 * @ManyToOne(targetEntity="\Om\Multimedia\Image", inversedBy="thumbnails")
	 */
	private $sourceImage;

	/** @Column(type="integer") */
	private $width;

	/** @Column(type="integer") */
	private $height;

	/** @Column(type="datetime") */
	private $dateCreated;

	/**
	 * order relative to other images within the album
	 * @Column(type="integer") 
	 */
	private $ordering;

	/**
	 * Owning side for relationship with Album
	 * @ManyToOne(targetEntity="\Om\Multimedia\Album")
	 */
	private $album;



	public function __construct()
	{
		$this->thumbnails = new ArrayCollection;
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
	 * Get/set file entity
	 */
	public function getFile()
	{
		return $this->file;
	}

	public function setFile(File $file)
	{
		$this->file = $file;
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
	 * Get/set/add/remove thumbnails
	 * To ensure that relationship to Image is added/removed the Image
	 * must be persisted. This is inversed side.
	 */
	public function getThumbnails()
	{
		return $this->thumbnails;
	}

	public function setThumbnails(ArrayCollection $thumbnails)
	{
		$this->thumbnails = $thumbnails;
	}

	public function addThumbnail(Image $image)
	{
		$this->thumbnails->add($image);
		$image->setSourceImage($this);
	}

	public function removeThumbnail(Image $image)
	{
		$this->thumbnails->remove($image);
		$image->setSourceImage(null);
	}



	/**
	 * Get/set source image
	 */
	public function getSourceImage()
	{
		return $this->sourceImage;
	}

	public function setSourceImage(Image $sourceImage)
	{
		$this->sourceImage = $sourceImage;
	}



	/**
	 * Get/set width
	 */
	public function getWidth()
	{
		return $this->width;
	}

	public function setWidth($width)
	{
		$this->width = (int) $width;
	}



	/**
	 * Get/set height
	 */
	public function getHeight()
	{
		return $this->height;
	}

	public function setHeight($height)
	{
		$this->height = (int) $height;
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
	 * Get/set order
	 */
	public function getOrdering()
	{
		return $this->ordering;
	}

	public function setOrdering($order)
	{
		$this->ordering = (int) $order;
	}



	/**
	 * Get/set album
	 */
	public function getAlbum()
	{
		return $this->album;
	}

	public function setAlbum(Album $album)
	{
		$this->album = $album;
	}
	
}


