<?php
require_once("DBAccess.php");
require_once("ORAAccess.php");
require_once("ORA8Access.php");
require_once("PGAccess.php");
require_once("MySQLAccess.php");

/**
* author gusto(watonist@telkom.net)
*/
class DBManager extends DBAccess{
	public $DB_UNKNOWN = 0;
	public $DB_ORACLE = 1;
	public $DB_ORACLE8 = 2;
	public $DB_POSTGRES = 3;
	public $DB_MYSQL = 4;

	private $_mode = 0;
	private $_tmpConn;

	public function DBManager(){
		$nArgs = func_num_args();

		if($nArgs <= 0){
		}else if($nArgs == 1){
			$this->_mode = func_get_arg(0);
		}

		$this->init();
	}

	public function setMode($mode){
		$this->_mode = $mode;
	}

	public function init(){
		if($this->_mode == $this->DB_UNKNOWN){
			$this->_tmpConn = new DBAccess();
		}else if($this->_mode == $this->DB_ORACLE){
			$this->_tmpConn = new ORAAccess();
		}else if($this->_mode == $this->DB_ORACLE8){
			$this->_tmpConn = new ORA8Access();
		}else if($this->_mode == $this->DB_POSTGRES){
			$this->_tmpConn = new PGAccess();
		}else if($this->_mode == $this->DB_MYSQL){
			$this->_tmpConn = new MySQLAccess();
		}
	}

	/**
    * ORACLE Connection only
    */
	public function setSID($sid){
		if($this->_mode == $this->DB_ORACLE){
			return $this->_tmpConn->setSID($sid);
		}else if($this->_mode == $this->DB_ORACLE8){
			return $this->_tmpConn->setSID($sid);
		}

		return null;
	}

	/**
    * PostgreSQL & MySQL connection only
    */
	public function setDBName($name){
		if($this->_mode == $this->DB_POSTGRES){
			return $this->_tmpConn->setDBName($name);
		}else if($this->_mode == $this->DB_MYSQL){
			return $this->_tmpConn->setDBName($name);
		}

		return null;
	}

	// common
	public function parseURL($url){
		$this->_tmpConn->parseURL($url);
	}

	public function setHost($host){
		$this->_tmpConn->setHost($host);
	}

	public function getHost(){
		return $this->_tmpConn->getHost;
	}

	public function setPort($port){
		$this->_tmpConn->setPort($port);
	}

	public function getPort(){
		return $this->_tmpConn->getPort();
	}

	public function setUser($user){
		$this->_tmpConn->setUser($user);
	}

	public function getUser(){
		return $this->_tmpConn->getUser();
	}

	public function setPassword($password){
		$this->_tmpConn->setPassword($password);
	}

	public function getPassword(){
		return $this->_tmpConn->getPassword();
	}

	public function setURL($url){
		$this->_tmpConn->setURL($url);
	}

	public function getURL(){
		return $this->_tmpConn->getURL();
	}


	public function connect(){
		$this->_tmpConn->connect();
		$this->isConnect = $this->_tmpConn->isConnect;
		return $this->isConnect;
	}

	public function disconnect(){
		$this->_tmpConn->disconnect();
		$this->isConnect = $this->_tmpConn->isConnect;
	}

	public function execute($SQLCmd){
		return $this->_tmpConn->execute($SQLCmd);
	}

	public function query($SQLCmd){
		return $this->_tmpConn->query($SQLCmd);
	}

	public function autoCommit(){
		return $this->_tmpConn->autoCommit();
	}

	public function noAutoCommit(){
		return $this->_tmpConn->disconnect();
	}

	public function commit(){
		return $this->_tmpConn->commit();
	}

	public function rollback(){
		return $this->_tmpConn->rollback();
	}

}

$DB_MANAGER = new DBManager();
?>