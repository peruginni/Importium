<?php

namespace CMS\Multimedia;

use DateTime;

/**
 * Album
 *
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
    
    /** @return string */
    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    {
        $this->location = (string) $location;
    }

    /** @return DateTime */
    public function getDateCaptured()
    {
        return $this->dateCaptured;
    }

    public function setDateCaptured(DateTime $dateCaptured)
    {
        $this->dateCaptured = $dateCaptured;
    }
    
}


