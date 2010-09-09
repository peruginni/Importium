<?php

namespace CMS;

/**
 * DataInitializator
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class DataInitializator extends BaseModel
{
    private $generationStrategy;

    public function __construct($config = null)
    {
        parent::__construct();
        if(isset($config['generationStrategy'])) {
            $this->setGenerationStrategy($config['generationStrategy']);
        }
    }

    public function getGenerationStrategy()
    {
        return $this->generationStrategy;
    }

    public function setGenerationStrategy($generationStrategy)
    {
        $this->generationStrategy = $generationStrategy;
    }

    public function run()
    {
        switch($this->generationStrategy) {
                case 'drop-and-create':
                    $this->dropSchema();
                    $this->createSchema();
                    break;
                case 'create':
                    $this->createSchema();
                    break;
                case 'update':
                    $this->updateSchema();
                    break;
                case 'drop':
                    $this->dropSchema();
                    break;
                case 'none':
                default:
            }
    }

    public function initializeData()
    {
        // load models here and work with them to upload initial data to database
        
    }

    public function createSchema()
    {
        $em = $this->getEntityManager();
        $tool = new \Doctrine\ORM\Tools\SchemaTool($em);
        $classMetadataFactory = new \Doctrine\ORM\Mapping\ClassMetadataFactory($em);
        $classes = $classMetadataFactory->getAllMetadata();
        $tool->createSchema($classes);
        $this->initializeData();
    }

    public function updateSchema()
    {
        $em = $this->getEntityManager();
        $tool = new \Doctrine\ORM\Tools\SchemaTool($em);
        $classMetadataFactory = new \Doctrine\ORM\Mapping\ClassMetadataFactory($em);
        $classes = $classMetadataFactory->getAllMetadata();
        $tool->updateSchema($classes);
    }

    public function dropSchema()
    {
        $em = $this->getEntityManager();
        $em->getConfiguration()->getMetadataCacheImpl()->deleteAll();
        $tool = new \Doctrine\ORM\Tools\SchemaTool($em);
        $classMetadataFactory = new \Doctrine\ORM\Mapping\ClassMetadataFactory($em);
        $classes = $classMetadataFactory->getAllMetadata();
        $tool->dropSchema($classes);
    }
}


