<?php

namespace CMS\Common;

/**
 * Language
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class Language
{
    /** @Id @Column(type="integer") @GeneratedValue */
    private $id;

    /** @Column(type="string", unique=true) */
    private $tag;

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
    public function getTag()
    {
        return $this->tag;
    }

    public function setTag($tag)
    {
        $this->tag = (string) $tag;
    }
    
}

