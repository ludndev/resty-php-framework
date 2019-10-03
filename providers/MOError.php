<?php


namespace Resty\Providers;


/**
 * Management Of Error
 *
 * Error management with custom 'errors codes'
 * 
 * @package    Resty
 * @subpackage MOError
 * @since      1.0
 * @author     Ludndev < ludndev [at] gmail [dot] com >
 * @todo       Save error in logs
 */
class MOError
{

	
	/**
	 * Map of internals error code
	 *
	 * @access protected
	 * @static 
	 * @todo do this in config files or another files
	 */
	protected static $internalErrorCode = [
		'UNDEFINED_HTTP_CODE',
		'DATABASE_CONNECTION_FAILED',
		'UNDEFINED_DATABASE_ERROR',
		'UNAUTHORIZE_TYPE'
	];


	/**
	 * Return correct error code with adaptive HTTP status
	 *
	 * @access public
	 * @static 
	 * @param object $exception
	 * @return string
	 */
	public static function OnCode( object $exception = NULL ):string
	{
		/*set HTTP status to 404 ( general case ) */
		Rest::Status(404);


		if ( is_null($exception) ) 
			return $code = 'UNDEFINED_ERROR';


		/* extract re usable var */
		$code = $exception->getMessage();
		$trace = $exception->getTrace();


		if ( self::IsInternalError( $code ) )
			Rest::Status(500);


		if ( self::IsRoutesError( $trace ) )
			return $code = 'UNKNOW_URI';


		return $code;
	}


	/**
	 * On PDO error code, return custom error message
	 *
	 * @access public
	 * @static 
	 * @param object $exception
	 * @return string
	 */
	public static function DBError(object $exception):string
	{
		$pre = 'DATABASE_';

		switch ( $exception->getCode() ) {
			case '2002':
				$code = $pre . 'CONNECTION_FAILED';
				break;
			
			default:
				$code = $pre . 'UNDEFINED_ERROR';
				break;
		}

		return $code;
	}


	/**
	 * Check if it's routes error
	 *
	 * @access private
	 * @static 
	 * @param array $trace
	 * @return bool
	 */
	private static function IsRoutesError(array $trace):bool
	{
		return preg_match( "/Phroute/i" , $trace[0]['class'] );
	}


	/**
	 * Check if it's an internal error or not
	 *
	 * @access private
	 * @static 
	 * @param string $code
	 * @return bool
	 */
	private static function IsInternalError(string $code):bool
	{
		return in_array( $code, self::$internalErrorCode );
	}


}