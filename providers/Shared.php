<?php


namespace Resty\Providers;


use \Exception;


/**
 * Shared Utilities
 *
 * Shared functions, utilities used anywhere.
 * 
 * @package    Resty
 * @subpackage Shared
 * @since      1.0
 * @author     Ludndev < ludndev [at] gmail [dot] com >
 */
class Shared 
{


    /**
     * Generate real uniq id
     *
     * @access public
     * @static
     * @param int $lenght
     * @return string
     */
    public static function UniqIdReal(int $lenght = 13):string
    {
        /* uniqid gives 13 chars, but you could adjust it to your needs. */
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("No cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }


    /**
     * A proper way to scan a directory, without dots
     *
     * @access public
     * @static
     * @param string $path
     * @return array
     */
    public static function ProperScandir(string $path):array
    {
        return 
            array_slice(
                scandir( $path ), 2
            );
    }


    /**
     * Convert to some variable to string
     *
     * @access public
     * @static
     * @param string|numeric|bool|null $variable
     * @throws Exception UNAUTHORIZE_TYPE
     * @return string
     */
    public static function Stringify($variable):string
    {
        if ( is_string($variable) || is_numeric($variable) )
            return "$variable";

        if ( is_bool($variable) )
            return ( $variable ? 'TRUE' : 'FALSE' );

        if ( is_null($variable) )
            return 'NULL';

        throw new Exception("UNAUTHORIZE_TYPE", 1); 
    }


    /**
     * Extract and return request 'posted' body data
     *
     * @access public
     * @static
     * @param bool $isArray
     * @return string|array|object
     */
    public static function GetBodyData(bool $isArray = TRUE)
    {
        return json_decode( file_get_contents("php://input") , $isArray );
    }


    



    /**
     * Function_description
     *
     * @access public
     * @see http://example.com/
     * @param string $parameter
     * @return string
     */
    public static function Example(string $parameter):string
    {
        #code_here
    }


}