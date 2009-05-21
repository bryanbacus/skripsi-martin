<?
if(file_exists(PATH_FUNGSI.'/umum.php')){
	require_once(PATH_FUNGSI.'/umum.php');
}else{
	die("File umum not Found !");
}

if(file_exists(PATH_FUNGSI.'/paging.php')){
	require_once(PATH_FUNGSI.'/paging.php');
}else{
	die("File paging not Found !");
}

class koneksi extends paging{
	var $host = "localhost";
	var $usn = "root";
	var $pwd = "";
	var $db = "ijga";
	
	function konek(){
		$k = mysql_connect($this->host,$this->usn,$this->pwd);
		if($k){
			mysql_select_db($this->db);
		}else{
			redirect(HOME."error.php?p=1");
		}
	}
	
	function exQ($sql){
		$this->konek();
		if($q = mysql_query($sql)){
			return $q;
		}else{
			return false;
		}
	}

}
?>