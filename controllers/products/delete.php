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
class Delete extends Controller
{


    /**
     * Allow method for the request
     */
	protected $method = 'ANY';


    /**
     * Products/Delete Constructor
	 * 
     * @access public
     * @return object
     */
	public function __construct()
	{
		$rest = new Providers\Rest( $this->method );
		return $this;
	}


	/**
	 * Generic method
     * 
     * @access public
     * @param int|string $id
	 * @throws Exception PRODUCT_ID_NOT_VALID
	 * @throws Exception PRODUCT_NOT_FOUND
     * @return mixed <array|object>
	 */
	public function Data($id)
	{
		global $DB;


		// ==============================================
		// START EDITING
		// ==============================================


		$id = (integer)$id ;

		if ( !is_integer($id) )
			throw new Exception( "PRODUCT_ID_NOT_VALID" , 1);


		$query = " 
			DELETE FROM `products` 
			WHERE 
				`id` = :id
			; 
		";

		$parameter = [
			'id' => $id
		];

		$count = $DB->count( $query , $parameter );

		if ( !$count )
			throw new Exception( "PRODUCT_NOT_FOUND" , 1);


		$data = [
			'id' => $id
		];


		Providers\Rest::Status(200);


		// ==============================================
		// STOP EDITING
		// ==============================================
		

		return $data;
	}


}