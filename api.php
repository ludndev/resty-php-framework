<?php


namespace Resty;


/**
 * API Class
 *
 * Conductor of the Resty. It is the link between the different 'parts' of the framework.
 * 
 * @package    Resty
 * @subpackage API
 * @since      1.0
 * @author     Ludndev < ludndev [at] gmail [dot] com >
 */
class API
{


	/**
	* API Constructor
	*
	* @access public
	* @return object
	*/
	public function __construct()
	{
		/* force displaying Json & setting app engine */
		Providers\Header::Custom([
			'Content-Type' => 'application/json; charset=UTF-8',
			'X-Engine' => 'Resty/1.0'
		]);

		/* resolve and set base directory as APP_ROOT */
		define( '__ROOT' , __DIR__ );

		return $this;
	}


	/**
	* API initilization
	*
	* @access public
	* @return object
	*/
	public function Init():object
	{
		return $this
			->EnvInit()
			->DatabaseInit()
		;
	}


	/**
	* Load .env data from app root 
	*
	* @access public
	* @return object
	*/
	protected function EnvInit():object
	{
		$dotenv = \Dotenv\Dotenv::create( __ROOT );
		$dotenv->load();
		return $this;
	}


	/**
	* Provide PDO instance
	*
	* @access protected
	* @return object
	*/
	protected function DatabaseInit():object
	{
		$GLOBALS['DB'] = new Providers\DBController(
			$_ENV['DB_DRIVER'],
			$_ENV['DB_HOST'],
			$_ENV['DB_NAME'],
			$_ENV['DB_USER'],
			$_ENV['DB_PASS'],
			[
	            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
	            \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
	            \PDO::ATTR_ORACLE_NULLS => \PDO::NULL_EMPTY_STRING
	        ]
		);
		return $this;
	}
	

	/**
	* Return jsonify success response base on method and uri
	*
	* @access public
	* @param string $method 
	* @param string $uri 
	* @return string
	*/
	public function ResponseHandler(string $method, string $uri):string
	{
		return 
			Providers\Response::Success( 
				Providers\Router::Match( $method, $uri )
			);
	}


	/**
	* Output error code, instead of generic string
	*
	* @access public
	* @param object $exception 
	* @return string
	*/
	public function ErrorHandler(object $exception):string
	{
		return 
			Providers\Response::Failed( 
				Providers\MOError::OnCode( $exception )
			);
	}


	/**
	* Push to screen api response
	*
	* @access public
	* @param string $response 
	* @return void
	*/
	public function Serve(string $response):void
	{
		echo $response;
	}


}