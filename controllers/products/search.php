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
class Search extends Controller
{


    /**
     * Allow method for the request
     */
	protected $method = 'ANY';


    /**
     * Products/Search Constructor
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
     * @param int|string|null $max
	 * @throws Exception PRODUCT_NOT_FOUND
	 * @throws Exception MISSING_SEARCH_QUERY
     * @return mixed <array|object>
	 */
	public function Data($max = NULL)
	{
		global $DB;


		// ==============================================
		// START EDITING
		// ==============================================


		/* max per page */
		if ( is_null($max) || !is_integer($max) || $max <= 0 )
			$max = 100;


		/* check GET['search'] parameter */
		if ( !isset($_GET['search']) || empty(trim($_GET['search'])) )
			throw new Exception("MISSING_SEARCH_QUERY", 1);


		/* sanitize first & get search value */
		$search = $_GET['search'];


		/* check GET['page'] parameter */
		if ( !isset($_GET['page']) || empty(trim($_GET['page'])) || !is_integer($_GET['page']) || $_GET['page'] <= 0 )
			$page = 1;


		/* pagination ici */
			


		$query = " 
			SELECT * 
			FROM `products`
			WHERE 
				( 
					name LIKE :search 
					OR 
					price LIKE :search 
				)
			; 
		";

		$parameter = [
			'search' => "%$search%"
		];

		$data = $DB->all( $query , $parameter );

		if ( !$data )
			throw new Exception( "NO_PRODUCT_RECORD" , 1);
		

		Providers\Rest::Status(200);


		// ==============================================
		// STOP EDITING
		// ==============================================
		

		return $data;
	}


}