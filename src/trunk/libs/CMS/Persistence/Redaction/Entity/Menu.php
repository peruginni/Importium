<?php

namespace CMS\Redaction;

/**
 * Menu entity
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class Menu
{
    /** @Id @Column(type="integer") @GeneratedValue */
    private $id;

    /** @Column(type="string", unique=true) */
    private $name;
   
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
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = (string) $name;
    }

}
