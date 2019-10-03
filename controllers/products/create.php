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
class Create extends Controller
{


    /**
     * Allow method for the request
     */
	protected $method = 'ANY';


    /**
     * Products/Create Constructor
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
     * @throws Exception MISSING_DATA
	 * @throws Exception UNABLE_TO_CREATE_PRODUCT
     * @return mixed <array|object>
	 */
	public function Data()
	{
		global $DB;


		// ==============================================
		// START EDITING
		// ==============================================


		$posted = Providers\Shared::GetBodyData();

		/* ecrire une fonction pour gerer ceci, comme not_empty */
		if ( !isset($posted['name']) || !isset($posted['price']) )
			throw new Exception( "MISSING_DATA" , 1);


		$query = " 
			INSERT INTO `products` 
				(`name`, `price`) 
			VALUES 
				( :name , :price ) 
			; 
		";


		$parameter = [
			'name' => $posted['name'],
			'price' => $posted['price']
		];

		$count = $DB->count( $query , $parameter );


		if ( !$count )
			throw new Exception( "UNABLE_TO_CREATE_PRODUCT" , 1);


		$data['id'] = $DB->lastInsertId();
		$data['name'] = $parameter['name'];
		$data['price'] = $parameter['price'];

		
		Providers\Rest::Status(200);
		

		// ==============================================
		// STOP EDITING
		// ==============================================


		return $data;
			
	}


}