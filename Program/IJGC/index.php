<?
session_start();
define("PATH_FUNGSI","./fungsi");
define("HOME","./");


require_once("./define.php");
require_once("./config.php");
//header
$header = $smarty->fetch("header.tpl");
$smarty->assign('header', $header);
//leftsection
$left = $smarty->fetch("left.tpl");
$smarty->assign('left', $left);
//rightsection
$right = $smarty->fetch("right.tpl");
$smarty->assign('right', $right);

// def var
//$template = "centre.tpl";

// global var
$smarty->assign('this_page',$_SERVER['SCRIPT_NAME']);

// otentifikasi admin
if($_POST['Submit_x']){
	if(isset($_POST['usn']) && isset($_POST['pass'])){
			require_once(PATH_FUNGSI."/koneksi.php");
			$k = new koneksi;
			$usn = strtolower(strips($_POST['usn']));
			$pwd = strips($_POST['pass']);
			$sql = "select id_unik,user_tipe from tbl_user where user='$usn' and password='$pwd' and status=1";
			$q = $k->exQ($sql);
			if($q){
				if(mysql_num_rows($q)==1){
					$sql = "update tbl_user set last_login='".date("Y-m-d H:i:s")."' where user='$usn'";
					$k->exQ($sql);
					$data = mysql_fetch_array($q,MYSQL_ASSOC);
					$_SESSION['usn']=$usn;
					$_SESSION['userId']=$data['id_unik'];
					$_SESSION['levelUser']=$data['user_tipe'];
					// redirect halaman
					//echo $_SERVER['HTTP_REFERER']; 
					header("Location: ".$_SERVER['HTTP_REFERER']);
					die();
				}else{
					$smarty->assign("pesan","Invalid Username or Password");
					session_destroy();
				}
			}else{
				redirect("../error.php?p=1");
			}
	}else{
		$smarty->assign("pesan","Username / Password tidak boleh kosong !");
	}
}

// cek session
if(@$_SESSION['usn']){
	require_once(PATH_FUNGSI."/koneksi.php");
	$k = new koneksi;
	$sql = "select 1 from tbl_user where user='".$_SESSION['usn']."' and user_tipe='".$_SESSION['levelUser']."'";
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
} else {
	include("./loginMenu.php");
}

//locating page
$page = preg_replace("@[^a-z0-9]@i","",$_GET['page']);
switch($page){
	case 'about':
		$pembuka = "<tr><td colspan=2><img src='./images/about.png'>";
		$penutup = "</tr></td>";
		$smarty->assign("pembuka", $pembuka);
		$smarty->assign("penutup", $penutup);
		$smarty->assign("about",$smarty->fetch("about.tpl"));		
		$template = "about.tpl";
		break;
	case 'visi':
		$pembuka = "<tr><td colspan=2><img src='./images/visi.gif'>";
		$penutup = "</tr></td>";
		$smarty->assign("pembuka", $pembuka);
		$smarty->assign("penutup", $penutup);
		$smarty->assign("visi",$smarty->fetch("visi.tpl"));		
		$template = "visi.tpl";
		break;
	case 'sitemap':
		$pembuka = "<tr><td colspan=2><img src='./images/sitemap.gif'>";
		$penutup = "</tr></td>";
		$smarty->assign("pembuka", $pembuka);
		$smarty->assign("penutup", $penutup);
		$smarty->assign("sitemap",$smarty->fetch("sitemap.tpl"));		
		$template = "sitemap.tpl";
		break;
	case 'objective':
		$pembuka = "<tr><td colspan=2><img src='./images/quick.gif'>";
		$penutup = "</tr></td>";
		$smarty->assign("pembuka", $pembuka);
		$smarty->assign("penutup", $penutup);
		$smarty->assign("objective",$smarty->fetch("alamat.tpl"));		
		$template = "alamat.tpl";
		break;
	case 'community':
		$pembuka = "<tr><td colspan=2>";
		$penutup = "</tr></td>";
		$smarty->assign("pembuka", $pembuka);
		$smarty->assign("penutup", $penutup);
		$smarty->assign("community",$smarty->fetch("community.tpl"));		
		$template = "community.tpl";
		break;		
	case 'become':
		$pembuka = "<tr><td colspan=2><img src='./images/bMember.gif'>";
		$penutup = "</tr></td>";
		$smarty->assign("pembuka", $pembuka);
		$smarty->assign("penutup", $penutup);
		$smarty->assign("become",$smarty->fetch("become.tpl"));		
		$template = "become.tpl";
		break;		
	case 'benefit':
		$pembuka = "<tr><td colspan=2><img src='./images/benefit.gif'>";
		$penutup = "</tr></td>";
		$smarty->assign("pembuka", $pembuka);
		$smarty->assign("penutup", $penutup);
		$smarty->assign("benefit",$smarty->fetch("benefit.tpl"));		
		$template = "benefit.tpl";
		break;		
	case 'rules':
		$pembuka = "<tr><td colspan=2><img src='./images/rules.gif'>";
		$penutup = "</tr></td>";
		$smarty->assign("pembuka", $pembuka);
		$smarty->assign("penutup", $penutup);
		$smarty->assign("rules",$smarty->fetch("rules.tpl"));		
		$template = "rules.tpl";
		break;		
	case 'etiket':
		$pembuka = "<tr><td colspan=2><img src='./images/etiket.gif'>";
		$penutup = "</tr></td>";
		$smarty->assign("pembuka", $pembuka);
		$smarty->assign("penutup", $penutup);
		$smarty->assign("etiket",$smarty->fetch("etiket.tpl"));		
		$template = "etiket.tpl";
		break;		
	case 'partner':
		$pembuka = "<tr><td colspan=2><img src='./images/bPartner.gif'>";
		$penutup = "</tr></td>";
		$smarty->assign("pembuka", $pembuka);
		$smarty->assign("penutup", $penutup);
		$smarty->assign("partner",$smarty->fetch("partner.tpl"));		
		$template = "partner.tpl";
		break;		
	case 'board':
		include("board.php");
		$template = "board.tpl";
		break;		
	case 'approval':
		include("profile_approval.php");
		break;		
	case 'listm':
		include("usrprofile.php");
		$template = "usrprofile.tpl";
		break;		
	case 'tips':
		include("tips.php");
		$template = "tips.tpl";
		break;		
	case 'links':
		include("links.php");
		$template = "links.tpl";
		break;		
	case 'product':
		include("product.php");
		$template = "product.tpl";
		break;		
	case 'partnerK':
		include("partnerK.php");
		$template = "partnerK.tpl";
		break;		
	case 'news':
		include("news.php");
		$template = "news.tpl";
		break;		
	case 'found':
		include("foundation.php");
		$template = "foundation.tpl";
		break;		
	case 'member':
		include("membership.php");
		$template = "membership.tpl";
		break;
	case 'contact':
		$pembuka = "<tr><td colspan=2><img src='./images/contact.gif'>";
		$penutup = "</tr></td>";
		$smarty->assign("pembuka", $pembuka);
		$smarty->assign("penutup", $penutup);
		$smarty->assign("contact",$smarty->fetch("contact.tpl"));		
		$template = "contact.tpl";
		break;
	case 'crview':
		include("course_view.php");
		$template = "course_view.tpl";
		break;		
	case "gamelist":
		include "./practice_list.php";
		break;				
	case "gamestat":
		include "./statistic.php";
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
	case "message":
		include "./message.php";
		break;		
	case "profile":
		include "./profile.php";
		break;
	case 'galery':
		include "./galery.php";
		$template = "galery.tpl";
		break;
	case "conduct":
		$pembuka = "<tr><td colspan=2>";
		$penutup = "</tr></td>";
		$smarty->assign("pembuka", $pembuka);
		$smarty->assign("penutup", $penutup);
		$smarty->assign("conduct",$smarty->fetch("conduct.tpl"));		
		$template = "conduct.tpl";
		break;			
	case 'donor':
		$pembuka = "<tr><td colspan=2><img src='./images/bDonor.gif'>";
		$penutup = "</tr></td>";
		$smarty->assign("pembuka", $pembuka);
		$smarty->assign("penutup", $penutup);
		$smarty->assign("donor",$smarty->fetch("donor.tpl"));		
		$template = "donor.tpl";
		break;
	case "out":
		session_destroy();
		header('Location:index.php');
		break;		
	default :
	include ("centre.php");
	$template = "centre.tpl";
}
$isi = $smarty->fetch($template);
$smarty->assign('isi', $isi);
$smarty->display('index.tpl');

//echo "<pre>";
//print_r($_POST);
//print_r($_SESSION);
//echo "</pre>";

?>
