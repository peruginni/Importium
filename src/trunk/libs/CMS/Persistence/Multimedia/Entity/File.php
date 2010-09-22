<?php

namespace CMS\Multimedia;

use DateTime;

/**
 * File
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class File
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

    /** @ManyToOne(targetEntity="\CMS\Multimedia\Folder") */
    private $folder;

    public function __construct()
    {
        
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
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = (string) $title;
    }

    /** @return string */
    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = (string) $path;
    }

    /** @return string */
    public function getFilename()
    {
        return $this->filename;
    }

    public function setFilename($filename)
    {
        $this->filename = (string) $filename;
    }

    /** @return string */
    public function getExtension()
    {
        return $this->extension;
    }

    public function setExtension($extension)
    {
        $this->extension = (string) $extension;
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

    /** @return Folder */
    public function getFolder()
    {
        return $this->folder;
    }

    public function setFolder(Folder $folder)
    {
        $this->folder = $folder;
    }

    /** @return string */
    public function getFullPath()
    {
        return $this->getPath().'/'.$this->getFilename().'.'.$this->getExtension();
    }
    
}
