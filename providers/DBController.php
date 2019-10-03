<?php


namespace Resty\Providers;


use \PDO;
use \PDOException;
use \Exception;


/**
 * Database Controller
 *
 * Simple, and easier database controller.
 * 
 * @package    Resty
 * @subpackage DBControllers
 * @since      1.0
 * @author     Ludndev < ludndev [at] gmail [dot] com >
 * @todo       Correct documentation, with valid links
 */
class DBController
{

	/**
	 * Available data output type
	 *
	 * @access protected
	 * @see http://php.net/_____doc
	 * @var array $allowDataType
	 */
	protected $allowDataType = [
		'object' => PDO::FETCH_OBJ,
		'array' => PDO::FETCH_ASSOC,
	];


	/**
	 * Store PDO connection instance
	 *
	 * @access private
	 * @var null|object $conn
	 */
	private $conn = NULL;

	
	/**
	 * Constructor : initialize PDO connection
	 *
	 * @access public
	 * @param string $DRIVER
	 * @param string $DB_HOST
	 * @param string $DB_NAME
	 * @param string $DB_USER
	 * @param string $DB_PASS
	 * @param string $OPTIONS
	 * @return object
	 */
	public function __construct(
		string $DRIVER, 
		string $DB_HOST, 
		string $DB_NAME, 
		string $DB_USER, 
		string $DB_PASS, 
		array  $OPTIONS 
	 )
	{
		$this->connect( "$DRIVER:host=$DB_HOST; dbname=$DB_NAME" , $DB_USER, $DB_PASS, $OPTIONS );
		return $this;
	}


	/**
	 * Connect to database using PDO
	 *
	 * @access protected
	 * @param string $DSN
	 * @param string $DB_USER
	 * @param string $DB_PASS
	 * @param string $OPTIONS
	 * @throws Exception MOError::DBError( $exception )
	 * @see http://php.net/_____doc
	 * @return bool
	 */
	protected function connect(string $DSN, string $DB_USER, string $DB_PASS, array $OPTIONS):bool
	{
		try {
			$this->conn = new PDO( $DSN, $DB_USER, $DB_PASS, $OPTIONS );
			return TRUE;
		} catch ( PDOException $exception ) {
			throw new Exception(
				MOError::DBError( $exception ) , 1
			);
			return FALSE;
		}
	}


	/**
	 * Return PDO connection instance
	 *
	 * @access public
	 * @return object
	 */
	public function conn():object
	{	
		return $this->conn;
	}


	/**
	 * Begin transaction
	 *
	 * @access public
	 * @see http://php.net/_____doc
	 * @return bool
	 */
	public function start():bool
	{	
		return $this->conn()->beginTransaction();
	}


	/**
	 * End transaction and roll back if there is some mistakes
	 *
	 * @access public
	 * @see http://php.net/_____doc
	 * @return bool
	 */
	public function end():bool
	{	
		return $this->conn()->rollBack();
	}


	/**
	 * Prepare and execute SQL query.
	 *
	 * @access protected
	 * @param string $query
	 * @param array $parameter
	 * @see http://php.net/_____doc_prepare_req_exec_req
	 * @return object
	 */
	protected function preExec(string $query, array $parameter = NULL)
	{
		$statement = $this->conn()->prepare($query);
		$statement->execute($parameter);
		return $statement;
	}


	/**
	 * Fetch row after statement's execution
	 *
	 * @access public
	 * @param string $query
	 * @param array $parameter
	 * @param string $type
	 * @see http://php.net/_____doc
	 * @return array|object
	 */
	public function run(string $query, array $parameter = NULL, string $type = 'object')
	{
		$statement = $this->preExec( $query, $parameter );
		$data = $statement->fetch( $this->getDataType($type) );
		$statement->closeCursor();
		return $data;
	}


	/**
	 * Fetch all data after statement's execution
	 *
	 * @access public
	 * @param string $query
	 * @param array $parameter
	 * @param string $type
	 * @see http://php.net/_____doc
	 * @return array|object
	 */
	public function all(string $query, array $parameter = NULL, string $type = 'object')
	{
		$statement = $this->preExec( $query, $parameter );
		$data = $statement->fetchAll( $this->getDataType($type) );
		$statement->closeCursor();
		return $data;
	}


	/**
	 * Count query returned row after statement's execution
	 *
	 * @access public
	 * @param string $query
	 * @param array $parameter
	 * @param string $type
	 * @see http://php.net/_____doc
	 * @return int
	 */
	public function count(string $query, array $parameter = NULL, string $type = 'object')
	{
		$statement = $this->preExec( $query, $parameter );
		$data = $statement->rowCount( $this->getDataType($type) );
		$statement->closeCursor();
		return $data;
	}


	/**
	 * Return the last inserted row id
	 *
	 * @access public
	 * @see http://php.net/_____doc
	 * @return int
	 */
	public function lastInsertId():int
	{
		return $this->conn()->lastInsertID();
	}


	/**
	 * Correct data type , return object as default
	 *
	 * @access protected
	 * @param string $type
	 * @return mixed|string
	 */
	protected function getDataType(string $type)
	{
		if ( array_key_exists( $type, $this->allowDataType ) ) {
			return $this->allowDataType[$type];
		} else {
			return PDO::FETCH_OBJ;
		}
	}


}