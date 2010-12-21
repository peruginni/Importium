<?php

namespace CMS;

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



	public function __construct()
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
	}

	
	/** @return EntityManager */
	public function getEntityManager()
	{
		if($this->entityManager == null) {
			$config = $this->createConfiguration();
			$connectionOptions = $this->getConnectionOptions();

			$eventManager = new Doctrine\Common\EventManager();
			if($connectionOptions['driver'] == 'pdo_mysql') {
				$eventManager->addEventSubscriber(new \Doctrine\DBAL\Event\Listeners\MysqlSessionInit('utf8', 'utf8_czech_ci'));
			}

			$this->entityManager = EntityManager::create($connectionOptions, $config, $eventManager);
		}

		return $this->entityManager;
	}



	public function setEntityManager(EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}



	public function registerEntityManager()
	{
		Environment::getServiceLocator()->addService('Doctrine\ORM\EntityManager', $this->entityManager);
		Environment::setServiceAlias('Doctrine\\ORM\\EntityManager', 'EntityManager');
	}



	/** @return Configuration */
	private function createConfiguration()
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



	private function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
	{
		$classMetadata = $eventArgs->getClassMetadata();
		$classMetadata->setTableName($this->getPrefix() . $classMetadata->getTableName());
	}

}
