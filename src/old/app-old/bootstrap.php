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
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;


// Step 1: Load Nette Framework
// this allows load Nette Framework classes automatically so that
// you don't have to litter your code with 'require' statements
require LIBS_DIR . '/Nette/loader.php';



// Step 2: Configure environment
// 2a) enable Nette\Debug for better exception and error visualisation
Debug::enable();

// 2b) load configuration from config.ini file
Environment::loadConfig();



// Step 3: Configure application
// 3a) get and setup a front controller
$application = Environment::getApplication();
$application->errorPresenter = 'Error';
//$application->catchExceptions = TRUE;

// 3b) initialize data
$dataInitializator = new CMS\DataInitializator(
    Environment::getVariable('dataInitializatorGenerationStrategy')
);
$dataInitializator->run();



// Step 4: Setup application router
$router = $application->getRouter();

if (function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules())) {
    # AdminModule routes
    $router[] = new Route('admin/<presenter>/<action>/<id>', array(
        'module'    => 'Admin',
        'presenter' => 'Default',
        'action'    => 'default',
        'id'        => null
    ));

    $router[] = new Route('index.php', array(
		'module' => 'Front',
		'presenter' => 'Default',
	), Route::ONE_WAY);

	$router[] = new Route('<presenter>/<action>/<id>', array(
		'module'    => 'Front',
        'presenter' => 'Default',
		'action' => 'default',
		'id' => NULL,
	));
} else {
	$router[] = new SimpleRouter('Front:Default:default');
}


// Step 5: Run the application!
$application->run();
