<?php

namespace CMS\Entity\Multimedia;

use Doctrine\Common\Collections\ArrayCollection;

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

    /** @OneToOne(targetEntity="File") */
    private $file;

    /** @OneToMany(targetEntity="Image", mappedBy="sourceImage") */
    private $thumbnails;

    /** @ManyToOne(targetEntity="Image", inversedBy="thumbnails") */
    private $sourceImage;

    /** @Column(type="integer") */
    private $width;

    /** @Column(type="integer") */
    private $height;

    /**
     * ------------------------------------------------------------------------
     * Constructor
     * ------------------------------------------------------------------------
     */
    public function __construct()
    {
        $this->thumbnails = new ArrayCollection;
    }

    /**
     * ------------------------------------------------------------------------
     * Getters and setters
     * ------------------------------------------------------------------------
     */

    /** @return int */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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
        $this->width = $width;
    }

    /** @return int */
    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }
}


