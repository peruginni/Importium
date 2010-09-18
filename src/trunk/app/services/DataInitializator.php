<?php

use CMS\InvalidArgumentException;
use CMS\InvalidStateException;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Mapping\ClassMetadataFactory;

/**
 * DataInitializator
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class DataInitializator
{
    /**#@+ generation strategies */
    const NONE = 0;
    const CREATE = 1;
    const UPDATE = 2;
    const DROP = 3;
    const DROP_AND_CREATE = 4;
    /**#@-*/

    private $generationStrategy;

    public function __construct($generationStrategy = null)
    {
        if($generationStrategy !== null) {
            $this->setGenerationStrategy($generationStrategy);
        }
    }

    public function getGenerationStrategy()
    {
        return $this->generationStrategy;
    }

    public function setGenerationStrategy($generationStrategy)
    {
        switch($generationStrategy) {
            case self::CREATE:
            case self::UPDATE:
            case self::DROP:
            case self::DROP_AND_CREATE:
            case self::NONE:
                break;
            default:
                throw new InvalidArgumentException();
        }

        $this->generationStrategy = $generationStrategy;
    }

    public function run()
    {
        switch($this->generationStrategy) {
                case self::DROP_AND_CREATE:
                    $this->dropSchema();
                    $this->createSchema();
                    break;
                case self::CREATE:
                    $this->createSchema();
                    break;
                case self::UPDATE:
                    $this->updateSchema();
                    break;
                case self::DROP:
                    $this->dropSchema();
                    break;
                case self::NONE:
                    break;
                default:
                    throw new InvalidStateException();
            }
    }

    public function initializeData()
    {
        // load models here and work with them to upload initial data to database
        
    }

    public function createSchema()
    {
        $em = $this->getEntityManager();
        $tool = new SchemaTool($em);
        $classMetadataFactory = new ClassMetadataFactory($em);
        $classes = $classMetadataFactory->getAllMetadata();
        $tool->createSchema($classes);
        $this->initializeData();
    }

    public function updateSchema()
    {
        $em = $this->getEntityManager();
        $tool = new SchemaTool($em);
        $classMetadataFactory = new ClassMetadataFactory($em);
        $classes = $classMetadataFactory->getAllMetadata();
        $tool->updateSchema($classes);
    }

    public function dropSchema()
    {
        $em = $this->getEntityManager();
        $em->getConfiguration()->getMetadataCacheImpl()->deleteAll();
        $tool = new SchemaTool($em);
        $classMetadataFactory = new ClassMetadataFactory($em);
        $classes = $classMetadataFactory->getAllMetadata();
        $tool->dropSchema($classes);
    }
}


