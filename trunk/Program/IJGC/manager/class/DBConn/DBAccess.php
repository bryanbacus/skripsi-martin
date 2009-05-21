<?php
require_once("ResultSet.php");

/**
* this class is an abstact class that define the common
* database handling method, it doesn't implements any
* specific database connection handling.
*
* author : gusto(watonist@telkom.net)
*
* db connection URL : db:dbtype://user:password@serverInstance
*/

class DBAccess{
	private $_host = "";
	private $_isSetHost = false;
	private $_port = 0;
	private $_isSetPort = false;
	private $_user = "";
	private $_isSetUser = false;
	private $_passwd = "";
	private $_isSetPassword = false;
	private $_url = "";

	public $dbType = "";
	public $serverInstance = "";

	public $isConnect = false;
	public $connection;

	public function DBAccess(){
	}

	public function setConnectionString($url){
		$this->parseURL($url);
	}

	public function parseURL($url){
		$this->_url = $url;
		$_a = parse_url($this->_url);
		list($Scheme, $this->dbType) = explode(".", $_a["scheme"]);

		/*
		echo "DBAccess::url=".$this->_url."<br>";
		echo "DBAccess::scheme=".$_a["scheme"]."<br>";
		echo "DBAccess::host=".$_a["host"].(($_a["port"]!="")?(":".$_a["port"]):"")."<br>";
		echo "DBAccess::port=".$_a["port"]."<br>";
		echo "DBAccess::user=".$_a["user"]."<br>";
		echo "DBAccess::password=".$_a["pass"]."<br>";
		echo "DBAccess:path=".$_a["path"]."<br>";
		*/
		if(strtolower($Scheme) != "db") return false;

		if($_a["host"] != ""){
			$this->_host=$_a["host"];
			$this->_isSetHost=true;
		}

		if($_a["port"] != ""){
			$this->_port=$_a["port"];
			$this->_isSetPort=true;
		}

		if($_a["user"] != ""){
			$this->_user=$_a["user"];
			$this->_isSetUser=true;
		}

		if($_a["pass"] != ""){
			$this->_passwd=$_a["pass"];
			$this->_isSetPassword=true;
		}
		$this->serverInstance = $_a["path"];

		return true;
	}

	public function setHost($host){
		$sVal = explode(":", $host);
		$sCount = count($sVal);

		if($sCount >= 1){
			$this->_host = $sVal[0];
			$this->_isSetHost = true;
		}
		if($sCount >= 2){
			$this->_port = $sVal[1];
			$this->_isSetPort = true;
		}
	}

	public function getHost(){
		return $this->_host;
	}

	public function setPort($port){
		$this->_port = $port;
		$this->_isSetPort = true;
	}

	public function getPort(){
		return $this->_port;
	}

	public function setUser($user){
		$this->_user = $user;
		$this->_isSetUser = true;
	}

	public function getUser(){
		return $this->_user;
	}

	public function setPassword($password){
		$this->_passwd = $password;
		$this->_isSetPassword = true;
	}

	public function getPassword(){
		return $this->_passwd;
	}

	public function setURL($url){
		$this->parseURL($url);
	}

	public function getURL(){
		return $this->_url;
	}

	public function connect(){
	}

	public function disconnect(){
	}

	public function execute($SQLCmd){
	}

	public function query($SQLCmd){
	}

	public function autoCommit(){
	}

	public function noAutoCommit(){
	}

	public function commit(){
	}

	public function rollback(){
	}
}
?>