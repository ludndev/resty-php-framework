<?php


namespace Resty\Controllers;


use \Resty\Providers;


/**
 * Class_full_name
 * 
 * Class_description
 * 
 * @since      1.0
 */
class Controller
{


    /**
     * Controller/Action Constructor
	 * 
     * @access public
     * @return object
     */
    public function __construct()
    {
        $rest = new Providers\Rest( $this->method );
		return $this;
    }


}