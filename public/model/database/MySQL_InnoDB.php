<?php
class DataSourceManager {
	private $port = '3306';
	private $timeout;
	public $mysqli;
	private $host = 'localhost';
	private $database = 'c420';
	private $dbusername = 'root';
	private $dbpassword = '';
	public function DataSourceManager() {
	}
	public function create() {
		// commit-autocommit example that uses an InnoDB table
		$this->mysqli = new mysqli ( $this->host, $this->dbusername, $this->dbpassword, $this->database );
		if (mysqli_connect_errno ()) {
			trigger_error ( 'Error connecting to host. ' . $this->mysqli->error, E_USER_ERROR );
		}
		// turn off AUTOCOMMIT, then run some queries
		$this->mysqli->autocommit ( FALSE );
		return $this->mysqli;
	}
	public function getConnection() {
		if (! $this->mysqli) {
			$this->mysqli = $this->create ();
		}
		return $this;
	}
	public function close($mysqliC) {
		// close connection
		$this->mysqli->close ();
	}
	public function commit() {
		$this->mysqli->commit ();
	}
	public function rollback() {
		$this->mysqli->rollback ();
	}
	public function query($query) {
		return $this->mysqli->query ( $query );
	}
}
?> 