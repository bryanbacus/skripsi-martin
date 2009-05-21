<?
define("PATH_FUNGSI","./fungsi");
define("HOME","./");
define("PATH_IJGA","./manager/class");
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "ijga");

require_once(PATH_FUNGSI."/koneksi.php");
$kDef = new koneksi;
$sql = "select * from tbl_config";
if($r=$kDef->exQ($sql)){
	while($data=mysql_fetch_array($r,MYSQL_NUM)){
		define($data[0],$data[1]);
	}
}else{
	redirect(HOME."error.php?p=1");
}

// namabulan
$bulan = array("","Januari", "Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$hari = array('mon'=>"Senin",'tue'=>"Selasa",'wed'=>"Rabu",'thu'=>"Kamis",'fri'=>"Jum'at",'sat'=>"Sabtu",'sun'=>"Minggu");
?>
