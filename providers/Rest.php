<?php


namespace Resty\Providers;


use \Exception;


/**
 * Restful Configuration
 *
 * Build and setip restful headers
 * 
 * @package    Resty
 * @subpackage Rest
 * @since      1.0
 * @author     Ludndev < ludndev [at] gmail [dot] com >
 * @todo       Add others traditionnals/conventionnals methods to $allowMethods
 */
class Rest extends Header
{


	/**
	 * Available methods for request
	 *
	 * @access protected
	 * @static
	 * @var array $allowMethods
	 */
	protected static $allowMethods = [
		'GET',
		'PUT',
		'POST',
		'DELETE'
	];


	/**
	 * Response max age header
	 *
	 * @access protected
	 * @static
	 * @var int $maxAge
	 */
	protected static $maxAge = 3600;


	/**
	 * Contruct Restfull Headers
	 *
	 * @access public
	 * @param string $method
	 * @todo Document link for each Header function, PhP official link
	 * @return void
	 */
	public function __construct(string $method)
	{
		$method = strtoupper($method);

		/* minimal headers , they should always be there */
		self::SetJson();
		self::SetOrigin('*');
		self::SetAge(self::$maxAge);

		/* check method */
		self::CheckMethod($method);

		/* strictness : right method only */
		self::StrictMethod($method);

		/* set method */
		self::SetMethod($method);

		/* special headers required by method */
		self::SpecialHeader($method);
	}


	/**
	 * Allow only selected methods
	 *
	 * @access protected
	 * @static
	 * @param string $method
	 * @throws Exception UNALLOWED_METHOD
	 * @return void
	 */
	protected static function CheckMethod(string $method):void
	{
		if ( !in_array( $method, self::$allowMethods ) && !self::IsAnyMethod($method) )
			throw new Exception("UNKNOWED_METHOD", 1);
	}


	/**
	 * Some headers according to the current method
	 *
	 * @access protected
	 * @static
	 * @param string $method
	 * @return void
	 */
	protected static function SpecialHeader(string $method):void
	{
		switch ($method) {
			case 'POST':
				self::SetHeaders("Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
				break;

			case 'GET':
				self::SetCredentials(TRUE);
				break;
		}
	}


	/**
	 * Set request status
	 *
	 * @access public
	 * @static
	 * @param int $code
	 * @throws Exception UNDEFINED_HTTP_CODE
	 * @return string
	 */
	public static function Status(int $code):string
	{
		$http = self::SetHTTPStatus($code);

		if ( $http['code'] === 0 )
			throw new Exception($http['error'], 1);

		return $http['error'];
	}


	/**
	 * Check if current method is matching
	 *
	 * @access protected
	 * @static
	 * @param string $method
	 * @throws Exception UNALLOWED_METHOD
	 * @return void
	 */
	protected static function StrictMethod(string $method):void
	{
		if ( $_SERVER['REQUEST_METHOD'] !== $method && !self::IsAnyMethod($method) ) 
			throw new Exception("UNALLOWED_METHOD", 1);
	}


	/**
	 * Check if is ANY method
	 *
	 * @access private
	 * @static
	 * @param string $method
	 * @return bool
	 */
	private static function IsAnyMethod(string $method):bool
	{
		return ( $method !== 'ANY' ? FALSE : TRUE );
	}


}