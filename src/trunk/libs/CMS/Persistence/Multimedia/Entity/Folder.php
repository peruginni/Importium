<?php

namespace CMS\Multimedia;

use CMS\Security\SharingSettings;

/**
 * Folder
 *
 * Used for virtual organization of files
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 * @MappedSuperclass
 */
class Folder
{
    /** @Id @Column(type="integer") @GeneratedValue */
    private $id;

    /** @Column(type="string") */
    private $title;

    /** @Column(type="string") */
    private $description;

    /** @Column(type="datetime") */
    private $dateCreated;

    /** @OneToOne(targetEntity="\CMS\Security\SharingSettings") */
    private $sharingSettings;

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
        $this->id = $id;
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
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = (string) $description;
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

    /** @return SharingSettings */
    public function getSharingSettings()
    {
        return $this->sharingSettings;
    }

    public function setSharingSettings(SharingSettings $sharingSettings)
    {
        $this->sharingSettings = $sharingSettings;
    }

}


