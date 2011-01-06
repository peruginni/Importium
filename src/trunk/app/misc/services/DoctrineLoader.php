<?php

use Nette\Environment;
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
	private $proxyNamespace;



	public function __construct()
	{
		$this->setup();
	}


	/**
	 * Read configuration from nette enviroment settings and setup
	 * all necessary class properties.
	 */
	public function setup()
	{
		$database = Environment::getConfig('database');

		$this->connectionOptions = array(
			'driver'   => $database->driver,
			'dbname'   => $database->name,
			'user'     => $database->username,
			'password' => $database->password,
		);

		$doctrine = Environment::getConfig('doctrine');

		$this->entityDir = $doctrine->entityDir;
		$this->proxyDir = $doctrine->proxyDir;
		$this->proxyNamespace = $doctrine->proxyNamespace;

	}


	
	/**
	 * Returns entity manager. In case EM does not exists, will create new instance of EM.
	 * 
	 * @return EntityManager
	 */
	public function getEntityManager()
	{
		if($this->entityManager == null) {
			$config = $this->createConfiguration();
			$eventManager = new Doctrine\Common\EventManager();
			if($this->connectionOptions['driver'] == 'pdo_mysql') {
				$eventManager->addEventSubscriber(
					new \Doctrine\DBAL\Event\Listeners\MysqlSessionInit
					('utf8', 'utf8_czech_ci')
				);
			}

			$this->entityManager = EntityManager::create($this->connectionOptions, $config, $eventManager);
		}

		return $this->entityManager;
	}


	/**
	 * Set entity manager
	 */
	public function setEntityManager(EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}



	/**
	 * Create new instance of entity manager
	 */
	public function restartEntityManager()
	{
		$this->entityManager = null;
		$this->getEntityManager();
	}



	/**
	 * Register entity manager into nette service manager
	 */
	public function registerEntityManager()
	{
		Environment::getServiceLocator()->addService('Doctrine\ORM\EntityManager', $this->getEntityManager());
		Environment::setServiceAlias('Doctrine\\ORM\\EntityManager', 'EntityManager');
	}

	


	/**
	 * ******************************************************************
	 * 
	 *   Helpers
	 * 
	 * ******************************************************************
	 */



	/**
	 * Create configuration used for creating new instance of doctrine's entity manager
	 *
	 * @return Configuration
	 */
	private function createConfiguration()
	{
		$config = new Configuration;

		// set caching
		$cache = new XcacheCache;
		$config->setMetadataCacheImpl($cache);
		$config->setQueryCacheImpl($cache);

		// set metadata driver
		$driverImpl = $config->newDefaultAnnotationDriver($this->entityDir);
		$config->setMetadataDriverImpl($driverImpl);

		// set proxies
		$config->setProxyDir($this->proxyDir);
		$config->setProxyNamespace($this->proxyNamespace);
		$config->setAutoGenerateProxyClasses(true);

		return $config;
	}

}
