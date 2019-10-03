<?php


namespace Resty\Providers;


/**
 * JSON Response
 *
 * On response type ( Success | Failed ), return JSON formated data
 * 
 * @package    Resty
 * @subpackage Response
 * @since      1.0
 * @author     Ludndev < ludndev [at] gmail [dot] com >
 */
class Response
{


	/**
	 * Set success response and format response as JSON
	 *
	 * @access public
	 * @static
	 * @param array|object|string $data
	 * @return string
	 * @todo  "Do i need to add message for success response ?"
	 */
	public static function Success($data = NULL):string
	{
		return 
			json_encode([
				'status' => Shared::Stringify(TRUE),		
				'data' => $data
			]);
	}


	/**
	 * Set failed response and format response as JSON
	 *
	 * @access public
	 * @static
	 * @param string $message
	 * @return string
	 */
	public static function Failed(string $message):string
	{
		return 
			json_encode([
				'status' => Shared::Stringify(FALSE),
				'message' => $message
			]);
	}


}