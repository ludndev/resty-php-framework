<?php


/*
|--------------------------------------------------------------------------
| Default Routes
|--------------------------------------------------------------------------
|
| For security reason, YOU SHOULD DELETE OR EDIT THIS FILE CONTENT.
|
*/


/**
 * Set default route
 */

$router->any( '/' , function() {

	global $DB;

	$mysql_version = $DB
						->run( " SELECT VERSION() as vs ; " )
						->vs ;

	return 
		[ 
			'app'                    => $_ENV['APP_NAME'], 
			'version'                => $_ENV['APP_VERSION'], 
			'description'            => 'Resty , the PhP Framework For Restful APIs',

			'author'                 => [
				'name'               => 'Ludndev',
				'email'              => 'ludndev [at] gmail [dot] com',
				'homepage'           => 'https://github.com/ludndev/'
			],

			'requirements'           => [
				"php"                => ">=7.X",
			],
			
			'dependancies' => [
				'phroute/phroute'    => '^2.1',
				'vlucas/phpdotenv'   => '^3.6',
				'guzzlehttp/guzzle'  => '^6.3',
				'fzaninotto/faker'   => '^1.8'
			],

			'server'                 => [
				'php_version'        => phpversion(),
				'mysql_version'      => $mysql_version
			]
		];
	
});


