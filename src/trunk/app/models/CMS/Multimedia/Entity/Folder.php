<?php

namespace CMS\Entity;

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
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(type="string") */
    private $description;

    /** @OneToOne(targetEntity="\CMS\Entity\SharingSettings") */
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
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = (string) $description;
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


