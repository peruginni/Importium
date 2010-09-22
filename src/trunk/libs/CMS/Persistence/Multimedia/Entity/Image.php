<?php

namespace CMS\Multimedia;

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
class Image
{
    /** @Id @Column(type="integer") @GeneratedValue */
    private $id;

    /** @OneToOne(targetEntity="\CMS\Multimedia\File") */
    private $file;

    /** @Column(type="string") */
    private $description;

    /** @OneToMany(targetEntity="\CMS\Multimedia\Image", mappedBy="sourceImage") */
    private $thumbnails;

    /** @ManyToOne(targetEntity="\CMS\Multimedia\Image", inversedBy="thumbnails") */
    private $sourceImage;

    /** @Column(type="integer") */
    private $width;

    /** @Column(type="integer") */
    private $height;

    /** @Column(type="datetime") */
    private $dateCreated;
    
    /** @Column(type="integer") */
    private $order;

    public function __construct()
    {
        $this->thumbnails = new ArrayCollection;
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

    /** @return File */
    public function getFile()
    {
        return $this->file;
    }

    public function setFile(File $file)
    {
        $this->file = $file;
    }

    /** @return string */
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = (string) $description;
    }

    /** @return ArrayCollection */
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

    /** @return Image */
    public function getSourceImage()
    {
        return $this->sourceImage;
    }
    
    public function setSourceImage(Image $sourceImage)
    {
        $this->sourceImage = $sourceImage;
    }

    /** @return int */
    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width = (int) $width;
    }

    /** @return int */
    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = (int) $height;
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

    /** @return int */
    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder($order)
    {
        $this->order = (int) $order;
    }
}


