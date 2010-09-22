<?php

namespace CMS;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\Common\Cache\XcacheCache;
use Doctrine\Common\EventManager;

/**
 * DoctrineLoader
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class DoctrineLoader extends \Nette\Object
{
    private $entityManager;
    private $connectionOptions;
    private $entityDir;
    private $proxyDir;
    private $prefix;

    public function __construct($options)
    {
        if(isset($options['connection'])) {
            $this->setConnectionOptions($options['connection']);
        }
        if(isset($options['entityDir'])) {
            $this->setEntityDir($options['entityDir']);
        }
        if(isset($options['proxyDir'])) {
            $this->setProxyDir($options['proxyDir']);
        }
        if(isset($options['prefix'])) {
            $this->setPrefix($options['prefix']);
        }
    }

    /** @return DoctrineLoader */
    public static function createDoctrineLoader($options)
    {
        return new DoctrineLoader($options);
    }

    /** @return array */
    public function getConnectionOptions()
    {
        return $this->connectionOptions;
    }

    public function setConnectionOptions($connectionOptions)
    {
        $this->connectionOptions = (array) $connectionOptions;
    }

    /** @return string */
    public function getEntityDir()
    {
        return $this->entityDir;
    }

    public function setEntityDir($entityDir)
    {
        $this->entityDir = (string) $entityDir;
    }

    /** @return string */
    public function getProxyDir()
    {
        return $this->proxyDir;
    }

    public function setProxyDir($proxyDir)
    {
        $this->proxyDir = (string) $proxyDir;
    }

    /** @return string */
    public function getPrefix()
    {
        return $this->prefix;
    }

    public function setPrefix($prefix)
    {
        $this->prefix = (string) $prefix;
    }

    /** @return EntityManager */
    public function getEntityManager()
    {
        if($this->entityManager == null) {
            $config = $this->createConfiguration();
            $options = $this->getConnectionOptions();
            $this->entityManager = EntityManager::create($options, $config);
        }
        return $this->entityManager;
    }

    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /** @return Configuration */
    public function createConfiguration()
    {
        $config = new Configuration;

        // set caching
        $cache = new XcacheCache;
        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);

        // set metadata driver
        $driverImpl = $config->newDefaultAnnotationDriver($this->getEntityDir());
        $config->setMetadataDriverImpl($driverImpl);

        // set proxies
        $config->setProxyDir($this->getProxyDir());
        $config->setProxyNamespace('\CMS\Entity\Proxy');
        $config->setAutoGenerateProxyClasses(true);

        return $config;
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $classMetadata = $eventArgs->getClassMetadata();
        $classMetadata->setTableName($this->getPrefix() . $classMetadata->getTableName());
    }

}
