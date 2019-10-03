<?php


namespace Resty\Tests;


use \GuzzleHttp\Client as Guzzle;


class Client
{


	private static $api = "http://127.0.0.1:8000";


	// ========================================================
	// Public Functions
	// ========================================================


	public static function get(string $uri = '', bool $isArray = TRUE)
	{
		$fullUrl = self::$api .  $uri ;
		$response = self::exec( 'GET' , $fullUrl );
		return json_decode( $response->getBody() , $isArray );
	}
    

    public static function post(string $uri, $data)
	{
		$fullUrl = self::$api .  $uri ;
		$response = self::exec( 'POST' , $fullUrl , self::prepareData($data) );
		return $response->getStatusCode();
	}


	public static function put(string $uri, $data)
	{
		$fullUrl = self::$api .  $uri ;
		$response = self::exec( 'PUT' , $fullUrl , self::prepareData($data) );
		return $response->getStatusCode();
	}
	

	public static function delete(string $uri = '', bool $isArray = TRUE)
	{
		$fullUrl = self::$api .  $uri ;
		$response = self::exec( 'DELETE' , $fullUrl );
		return json_decode( $response->getBody() , $isArray );
    }


	// ========================================================
	// Protected Functions
	// ========================================================


	protected static function exec(string $method = 'GET', string $url, $json = ''):object
	{
		/* add prefix in here */
		$client = new Guzzle();

		/*
		$client = new Guzzle([
			'base_uri' => 'http://example.com',
		]);
		*/


		/* set headers */
		$headers = [
	        'User-Agent' => 'Resty/1.0',
	        'Accept'     => 'application/json',
	        'X-REALM'    => 'APP_NAME'
		];

	    /* execution of the request */
		return 
			$client->request(
				strtoupper($method) , 
				$url,
				[
					'headers' => $headers,
					'timeout' => 2.0,
					'http_errors' => FALSE,

					'body' => $json
				]
			);
	}


	protected static function prepareData($data)
	{
		if ( is_array($data) || is_object($data) )
			return json_encode($data);
		throw new \Exception ( 'DATA_TYPE_UNALLOWED' );
	}
	

}