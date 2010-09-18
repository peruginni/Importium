<?php

namespace CMS\Entity;

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
    private $date;
    
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
    public function getDate()
    {
        return $this->date;
    }

    public function setDate(DateTime $date)
    {
        $this->date = $date;
    }
    
}


