<?php


namespace Resty\Providers;


use \Phroute\Phroute\RouteCollector;
use \Phroute\Phroute\Dispatcher;


/**
 * Router Matching
 *
 * Init, load and dispatch routes.
 * 
 * @package    Resty
 * @subpackage Router
 * @since      1.0
 * @author     Ludndev < ludndev [at] gmail [dot] com >
 */
class Router
{


	/**
	* Match route and return response
	*
	* @access public
	* @static
	* @param string $method 
	* @param string $uri 
	* @return array|object
	*/
	public static function Match(string $method, string $uri)
	{
		$router = new RouteCollector();

		self::RoutesLoader( $router );
		
		$dispatcher =  new Dispatcher( $router->getData() );

		return $dispatcher->dispatch( $method, $uri );
	}


	/**
	* Load routes from routes directory
	*
	* @access private
	* @static
	* @param object $router 
	* @return void
	*/
	private static function RoutesLoader(object $router):void
	{
		/* get element in routes directory */
		$routes = Shared::ProperScandir( __ROOT . '/routes/' );

		/* load each valid file .php file */
        foreach ($routes as $route) {
        	if ( preg_match("/(.php)/i" , $route) )
            	require( __ROOT . "/routes/$route" );
        }
	}


}