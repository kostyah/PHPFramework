<?php
	/**
	 * Database class
	 */

class Db {
	
	protected static $instance;
	private $dbh;
	
	/**
	 * Db Constructor
	 * @param string $host
	 * @param string $user
	 * @param string $pass
	 * @param string $dbName
	 */
	protected function __construct( $host, $user, $pass, $dbName){
		try {
			$this->dbh = new PDO( 'mysql:host='.$host.';dbname='.$dbName, $user, $pass );
			$this->dbh->query("SET NAMES UTF8");

			$this->dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );
			
		} catch ( Exception $e ){
			$this->showError( "<b>Data Base connexion error : </b>", $e );
		}
	}
	
	/**
	 * Returns database instance
	 * @return db instance
	 */
	
	public static function getInstance(){
		
		if( !isset (self::$instance) ){
			$dbName	= DB_NAME;
			$host = DB_HOST;
			$user = DB_USER;
			$pass = DB_PASS;
			
			self::$instance = new self( $host, $user, $pass, $dbName );
		}
		
		return self::$instance;
	}
	
	/**
	 * Performs a query over database
	 * @param string $dbQuery sqlQuery
	 * @return mixed $result
	 */
	public function query( $dbQuery ){
		
		if( $dbQuery !== '' ){
			try{				
				return $this->dbh->query( $dbQuery ) ;
			} catch ( PDOException $e) {
				$this->showError( $dbQuery, $e );
			}
		} else {
			$this->showError( "Error : empty query" );
			return false;
		}
	}
	
	/**
	 * Performs a SELECT query and returns a row
	 * @param string $dbQuery
	 * @return array $row
	 */
	public function getRow( $dbQuery ) {
		$dbResultIdentifier = $this->query( $dbQuery );
		if( $dbResultIdentifier != false ) {
			return $dbResultIdentifier->fetch( PDO::FETCH_ASSOC );
		}
		$this->showError(" Unable to query {".$dbQuery."}");
		return false;
	}
	
	/**
	 *	perform a select query and return an array of rows
	 *
	 *	@param	string	$dbQuery	a valid query
	 *	@return	mixed
	 */
	public function getRows( $dbQuery ) {
		$dbRes = $this->query($dbQuery);
		if( $dbRes ) {
			return $dbRes->fetchAll( PDO::FETCH_ASSOC );
		} else {
			$this->showError( "invalid query, can't get rows" );
		}
		return false;
	}
	
	/**
	 * Shows error in error block
	 * @param string $errorMessage error message
	 * @param Exception $e optionnal
	 */
	protected function showError( $errorMessage, $e = false){
		//@TODO : Customize error messages
		// if using bootstrap, use shadow box ?
		if( $e !== false ){
			$errorMessage .= '<br/>Exception message :' .$e->getMessage() .'';
		}
		
		echo '<p class="">'.$errorMessage.'</p>';
	}
	
	/**
	 * Closes database connection
	 */
	public function closeDb(){
		$dbName = DB_NAME;
		
		if( isset ( self::$instance ) ){
			$inst = self::$instance;
			$inst->dbh = null;
		}
	}
}
?>