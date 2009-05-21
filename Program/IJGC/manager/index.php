<?
session_start();

$smarty = "";
define("PATH_FUNGSI","../fungsi");
define("HOME","./");
define("PATH_FUNGSI","./fungsi");
require_once("../define.php");
require_once("./config.php");
include("./header.php");
include("./footer.php");

// global var
$smarty->assign('this_page',$_SERVER['SCRIPT_NAME']);

// otentifikasi admin
if(@$_POST['smbAdmin']=="Login"){
	if(isset($_POST['usn']) && isset($_POST['pwd'])){
		if($_SESSION['kodever']==$_POST['kodever']){
			require_once(PATH_FUNGSI."/koneksi.php");
			$k = new koneksi;
			$usn = strtolower(strips($_POST['usn']));
			$pwd = md5(strips($_POST['pwd']));
			$sql = "select level from tbl_admin where usn='$usn' and pwd='$pwd'";
			$q = $k->exQ($sql);
			if($q){
				if(mysql_num_rows($q)==1){
					$unique = genUnique(32);
					$sql = "update tbl_admin set unique_id='$unique',last_login='".date("Y-m-d H:i:s")."' where usn='$usn'";
					$k->exQ($sql);
					$data = mysql_fetch_array($q,MYSQL_NUM);
					$_SESSION['usn']=$usn;
					$_SESSION['pwd']=strips($_POST['pwd']);
					$_SESSION['levelUser']=$data[0];
					$_SESSION['uniqueId']=$unique;
					// login ke forum
					#include_once("forum.php");
					// redirect halaman
					header("Location: ".$_SERVER['HTTP_REFERER']);
					die();
				}else{
					$smarty->assign("pesan","Invalid Username or Password !");
					session_destroy();
				}
			}else{
				redirect("../error.php?p=1");
			}
		}else{
			$smarty->assign("pesan","Kode Verifikasi tidak Valid !");
		}
	}else{
		$smarty->assign("pesan","Username / Password tidak boleh kosong !");
	}
}

// cek session
if(@$_SESSION['usn']){
	require_once(PATH_FUNGSI."/koneksi.php");
	$k = new koneksi;
	$sql = "select 1 from tbl_admin where usn='".$_SESSION['usn']."' and unique_id='".$_SESSION['uniqueId']."'";
	$q = $k->exQ($sql);
	if($q){
		if(mysql_num_rows($q)!=1){
			session_destroy();
			header("Location: ".$_SERVER['HTTP_REFERER']);
			die();
		}else{
			$logged = true;
		}
	}else{
		redirect("../error.php?p=1");
	}
}else{
	$logged = false;
}

// cek otentifikasi
if(!@$_SESSION['usn']){
	include("./login.php");
	$login = $smarty->fetch("login.tpl");
	$smarty->assign('content',$login);
	$smarty->assign('header',"kosong");
}

if($logged){
	// pilih aksi
	$aksi = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi']);
	if($_POST['aksi']){
		$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_POST['aksi']);
	}
	switch($aksi){
		case "about":
			include "./static/about.php";
			break;
		case "alamat":
			include "./static/alamat.php";
			break;
		case "contact":
			include "./static/contact.php";
			break;
		case "visi":
			include "./static/visi.php";
			break;
		case "donor":
			include "./static/donor.php";
			break;
		case "become":
			include "./static/become.php";
			break;
		case "benefit":
			include "./static/benefit.php";
			break;
		case "rules":
			include "./static/rules.php";
			break;
		case "etiket":
			include "./static/etiket.php";
			break;
		case "partner":
			include "./static/partner.php";
			break;
		case "users":
			include "./user.php";
			break;
		case "userm":
			include "./userm.php";
			break;
		case "usrprofile":
			include "./usrprofile.php";
			break;
		case "board":
			include "./boardmanager.php";
			break;
		case "found":
			include "./foundation.php";
			break;
		case "crtype":
			include "./course_type.php";
			break;	
		case "crlist":
			include "./course_list.php";
			break;
		case "crview":
			include "./course_view.php";
			break;
		case "ranking":
			include "./tour_param_ranking.php";
			break;
		case "gamelist":
			include "./practice_list.php";
			break;				
		case "gamestat":
			include "./statistic.php";
			break;			
		case "touradmin":
			include "./tour_admin.php";
			break;		
		case "tourlist":
			include "./tour_list.php";
			break;							
		case "topranking":
			include "./topten.php";
			break;
		case "tourrest":
			include "./tour_rest.php";
			break;			
		case "conduct":
			include "./static/conduct.php";
			break;										
		case "news":
			include "./news.php";
			break;					
		case "tip":
			include "./tip.php";
			break;
		case "product":
			include "./product.php";
			break;
		case "partnerk":
			include "./partner.php";
			break;
		case "link":
			include "./links.php";
			break;
		case "galery":
			include "./galery.php";
			break;
		case "out":
			session_destroy();
			header('Location:index.php');
			break;
		default:
			include "./home.php";
			// website settings
	}
}
$smarty->display("index.tpl");

// print POST data
?>