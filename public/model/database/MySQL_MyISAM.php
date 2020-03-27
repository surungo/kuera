<?php
class DataSourceManager {
	private $result;
	private $link;
	private $con;
	private $con_db;
	private $port = '3306';
	private $timeout;
	private $mysqli;
	private $host = 'localhost';
	private $database = 'c420';
	private $dbusername = 'c420';
	private $dbpassword = '*nc$spWQ';
	public function DataSourceManager() {
	}
	public function __construct() {
	}
	public function getConnection() {
		return $this;
	}
	public function close($fake) {
		try {
			if (! ($this->result == 1 || $this->result == 0)) {
				mysql_free_result ( $this->result );
			}
			if ($this->link != null)
				mysql_close ( $this->link );
			
			$this->con = null;
		} catch ( Exception $e ) {
		}
	}
	public function query($query) {
		$this->link = mysql_connect ( $this->host, $this->dbusername, $this->dbpassword );
		try {
			if (! $this->link) {
				throw new Exception ( 'Falha na conexao com servidor MySQL: ' . mysql_error () );
			}
			$this->con_db = @mysql_select_db ( $this->database, $this->link ) or $this->erroMySQL ();
			if (! $this->con_db) {
				throw new Exception ( 'Falha na selecao do banco ' . $this->database . ' : ' . mysql_error () );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		$this->result = mysql_query ( $query, $this->link ) or die ( 'Query failed: ' . mysql_error () );
		return $this;
	}
	public function fetch_assoc() {
		return mysql_fetch_assoc ( $this->result );
	}
	public function rollback() {
		return 0;
	}
	public function commit() {
		return 0;
	}
}

?> 