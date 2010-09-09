<?php

namespace CMS\Entity\Multimedia;

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

    /** @Column(type="string") */
    private $title;

    /** @Column(type="text") */
    private $path; // relative to storage direcory (specified in model), but universal part for both editing and presenting

    /** @ManyToOne(targetEntity="FileType") */
    private $type;

    /** @ManyToOne(targetEntity="Folder") */
    private $folder;

    /**
     * ------------------------------------------------------------------------
     * Constructor
     * ------------------------------------------------------------------------
     */
    public function __construct()
    {
        
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

    /** @return string */
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    /** @return string */
    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    /** @return FileType */
    public function getType()
    {
        return $this->type;
    }

    public function setType(FileType $type)
    {
        $this->type = $type;
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
}


