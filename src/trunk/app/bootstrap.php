<?php

/**
 * CMS bootstrap
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */

use Nette\Debug;
use Nette\Environment;
use Nette\Application\Route;
use Nette\Application\SimpleRouter;
use Nette\Caching\FileStorage;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;

/**
 * Load Nette Framework
 */

require LIBS_DIR . '/Nette/loader.php';

//Debug::enable();

/**
 * Configure environment
 */

Environment::loadConfig();
Environment::setMode(Environment::DEVELOPMENT);

// caching
$fileStorage = new FileStorage(Environment::getVariable('cacheDir'));
Environment::getServiceLocator()->removeService('Nette\Caching\ICacheStorage');
Environment::getServiceLocator()->addService('Nette\Caching\ICacheStorage', $fileStorage);
	
// doctrine
$doctrineLoader = new DoctrineLoader();
$doctrineLoader->registerEntityManager();

if(!Environment::isProduction()) {
	$dataInitializator = new DataInitializator(
		DataInitializator::DROP_AND_CREATE
	);
	$dataInitializator->setEntityManager(Environment::getService('Doctrine\ORM\EntityManager'));
	//$dataInitializator->run();
}

/**
 * Configure application
 */

// get and setup a front controller
$application = Environment::getApplication();
$application->errorPresenter = 'Error';
$application->catchExceptions = false;



/**
 * Setup application router
 */

$router = $application->getRouter();

if (function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules())) {
	
	$router[] = new Route('admin/<presenter>/<action>/<id> ? <page> ', array(
		'module'    => 'Admin',
		'presenter' => 'User',
		'action'    => 'default',
		'id'        => null
	));

	$router[] = new Route('index.php', array(
		'module'    => 'Front',
		'presenter' => 'Default',
	), Route::ONE_WAY);

	$router[] = new Route('<presenter>/<action>/<id> ? <page> ', array(
		'module'    => 'Front',
		'presenter' => 'Default',
		'action'    => 'default',
		'id'        => NULL,
	));

} else {
	
	$router[] = new SimpleRouter('Front:Default:default');

}





/**
 * Run the application
 */

$application->run();

