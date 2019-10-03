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
class Update extends Controller
{


    /**
     * Allow method for the request
     */
	protected $method = 'ANY';


    /**
     * Products/Update Constructor
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
	 * @throws Exception MISSING_DATA
	 * @throws Exception PRODUCT_NOT_FOUND
	 * @throws Exception UNABLE_TO_UPDATE_PRODUCT
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


		$posted = Providers\Shared::GetBodyData();

		/* ecrire une fonction pour gerer ceci, comme not_empty */
		if ( !isset($posted['name']) || !isset($posted['price']) )
			throw new Exception( "MISSING_DATA" , 1);


		$query = " 
			SELECT *
			FROM `products`
			WHERE
				id = :id
			; 
		";

		$parameter = [
			'id' => $id
		];

		$product = $DB->run( $query , $parameter );

		if ( !$product )
			throw new Exception( "PRODUCT_NOT_FOUND" , 1);


		$query = " 
			UPDATE `products` 
			SET 
				`name` = :name ,
				`price` = :price 
			WHERE 
				`id` = :id
		";

		$parameter = [
			'id' => $id,
			'name' => $posted['name'],
			'price' => $posted['price']
		];

		$count = $DB->count( $query , $parameter );


		if ( !$count )
			throw new Exception( "UNABLE_TO_UPDATE_PRODUCT" , 1);


		$data['id'] = $id;
		$data['name'] = $parameter['name'];
		$data['price'] = $parameter['price'];

		
		Providers\Rest::Status(200);
		
		
		// ==============================================
		// STOP EDITING
		// ==============================================


		return $data;
	}


}