<?php


require ( __DIR__ . '/../vendor/autoload.php' );


use Faker\Factory;
use Resty\Tests\Client;


function dump($var) { echo '<pre>'; print_r($var); echo '</pre>'; }


try {


	/**
	 * Read products id 1
	 */
	dump( 
		Client::get( '/products/read/1' )
	);


	// ------------

	/**
	 * Add new products
	 */
	$faker = Factory::create();
	$seeds = require 'seeds.php';
	foreach ( $seeds as $data ) {
		$response =  Client::post( '/products/create/' , $data );
		if ( $response != '200' )
			throw new Exception ( "ERROR$response" );

	}


	// ------------


	/**
	 * Search in products
	 */
	dump( 
		Client::get( '/products/search/20/?search=d' ) 
	);


	// ------------

	
} catch (Exception $exc) {
	
	echo $exc->getMessage() ;

}






