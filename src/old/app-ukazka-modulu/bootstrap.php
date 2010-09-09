<?php

use Nette\Debug,
	Nette\Environment,
	Nette\Application\Route,
	Nette\Application\SimpleRouter;



// Step 1: Load Nette Framework
// this allows load Nette Framework classes automatically so that
// you don't have to litter your code with 'require' statements
// require LIBS_DIR . '/Nette/loader.php';
require LIBS_DIR . '/Nette/loader.php';



// Step 2: Configure environment
// 2a) enable Nette\Debug for better exception and error visualisation
Debug::enable();

// 2b) load configuration from config.ini file
Environment::loadConfig();



// Step 3: Configure application
$application = Environment::getApplication();



// Step 4: Setup application router
$router = $application->getRouter();

// mod_rewrite detection
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
