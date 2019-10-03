<?php


namespace Resty\Controllers\Products;


use \Resty\Controllers\Controller;
use \Resty\Providers;
use \Exception;


/**
 * Class_full_name
 * 
 * Class_description
 * 
 * @since      1.0
 */
class ReadAll extends Controller
{


    /**
     * Allow method for the request
     */
	protected $method = 'ANY';


	/**
	 * Generic method
     * 
     * @access public
     * @throws Exception UNABLE_TO_READ_PRODUCTS
     * @return mixed <array|object>
	 */
	public function Data()
	{
		global $DB;


		// ==============================================
		// START EDITING
		// ==============================================


		$query = " 
			SELECT *
			FROM `products`
			; 
		";

		$parameter = [];

		$data = $DB->all( $query , $parameter );

		if ( !$data )
			throw new Exception( "UNABLE_TO_READ_PRODUCTS" , 1);
		

		Providers\Rest::Status(200);


		// ==============================================
		// STOP EDITING
		// ==============================================
		

		return $data;
	}


}