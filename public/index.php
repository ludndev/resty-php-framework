<?php


/**
 * Resty - Resty , the PhP Framework For Restful APIs
 *
 * @package    Resty
 * @version    1.0
 * @author     Ludndev < ludndev [at] gmail [dot] com >
 * @copyright  2019 © Ludndev
 * @todo       Changer le Init() en Daemon() ?
 */



/*
|--------------------------------------------------------------------------
| > Allow errors reporting
|--------------------------------------------------------------------------
|
| Just remove this line on production.
| Comment the block or simply delete them.
|
*/

error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", TRUE);


/*
|--------------------------------------------------------------------------
| > Register The Auto Loader
|--------------------------------------------------------------------------
|
| Oh Composer ! Provide me all classes, generated automatically and needed
| dependancies.
| We just need to require it! So simple and easy.
|
*/

require ( __DIR__ . '/../vendor/autoload.php' );


/*
|--------------------------------------------------------------------------
| > Mount on the mountain
|--------------------------------------------------------------------------
|
| Call the app main file make more easier to init and perform action from
| public index.php. 
| Secure, simple, one line and just relax ;).
|
*/

require ( __DIR__ . '/../api.php' );


/*
|--------------------------------------------------------------------------
| > Run The Application
|--------------------------------------------------------------------------
|
| Key is on. Fuel is ok. Just run.
| We need to start the app, so let us turn on the machina and vroum vroum.
|
*/

$api = new Resty\API();



try {


	/**
	 * This start the framework with minimal configs. Gets it ready for use.
	 */
	$api->Init();


	/* 
	 * Respond on incomming request
	 */
	$response = $api->ResponseHandler(
		$_SERVER['REQUEST_METHOD'],
		parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH )
	);

	
} catch (Exception $exc) {
	

	/* 
	 * What's up ? Catch me ! Catch the hidden. // attraper ce qui cloche // trouver l'erreur dans "l'image"
	 */
	$response = $api->ErrorHandler($exc);


} finally {


	/* 
	 * Serve the responses back to the browser anyway, anytime.
	 */
	$api->Serve($response);


}