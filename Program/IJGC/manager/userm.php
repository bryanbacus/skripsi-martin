<?php
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

if($_SESSION['levelUser']!=1){
	header("Location:index.php");
}

require_once(PATH_CLASS."/userm.php");

// new user class
$usr = new userm;

// def var
$smarty->assign('judul',"Membership Management");
$smarty->assign('path_editor',PATH_EDITOR);
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
//$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=userm\'" />';
$smarty->assign('referer',$_SERVER['SCRIPT_NAME']."?aksi=userm");
$template = "userm.tpl";

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if($_POST['delete']){
	$aksi2 = "delete";
}
$smarty->assign('aksi2',$aksi2);
switch($aksi2){
	case "add":
		if(!isset($tgl)){
				$smarty->assign("tgl",date('Y-m-d'));
			}else{
				$smarty->assign("tgl",$tgl);
			}
		$smarty->assign("listLevel",$usr->level(""));	
		$smarty->assign("listGroup",$usr->gType(""));	
		$smarty->assign("listPackage",$usr->pType(""));	
		$smarty->assign("listNegara",$usr->country());	
		
		if($_POST['simpan']){
				if($usr->tambah()){
					$smarty->assign('pesan',"Data membership berhasil dimasukkan !".$meta);
					$smarty->assign('dshowMe',true);
				}else{
					$smarty->assign('pesan',$usr->pesan);
					$smarty->assign('nama',$_POST['nama']);
					$smarty->assign('email',$_POST['email']);
					$smarty->assign('alamat',$_POST['alamat']);
					$smarty->assign('noRumah',$_POST['noRumah']);
					$smarty->assign('noHp',$_POST['noHp']);
					$smarty->assign('ortu',$_POST['ortu']);
					if($_POST['tglLahir']){
						$tgl = $_POST['tglLahir'];
					} else {
						$tgl = date('m-d-Y');
					}
				}
		}
		$template = "userm_add_edit.tpl";
		break;
	case "aktivasi":
		$id = custom_strips($_GET['id'],"@[\\\'\"]@i");
		//assign level
		$level = $usr->level("");
		$smarty->assign("listLevel",$level);
		$smarty->assign("idChild",$id);
		if($_POST['simpan']){
			$id = custom_strips($_POST['idChild'],"@[\\\'\"]@i");
			$level = preg_replace("@[^0-9]@i","",$_POST['level_membership']);			
			if(!detectBlank($_POST)){
				if($usr->aktive($id)){
					$sqla = "update tbl_membership set status = 1 where id='$id'";
					//echo $sqla;
					if($usr->exQ($sqla)){
						$smarty->assign('pesan',"Membership berhasil diaktifkan !".$meta);
						$smarty->assign('dshowMe',true);
					} else {
						$smarty->assign('pesan',"Membership gagal diaktifkan lakukan pengaktifan manual dari edit user!".$meta);
					}
				}else{
					$smarty->assign('pesan',$usr->pesan);
					$smarty->assign('username',$_POST['username']);
					$smarty->assign('pwdc',$_POST['pwdc']);
					$smarty->assign('usernamep',$_POST['pwdp']);
					$smarty->assign('pwdp',$_POST['pwdc']);
					$smarty->assign('idChild','$id');
					if(isset($_POST['level'])){
						$level = $usr->level($_POST['level']);
						$smarty->assign("listLevel",$level);
					}else{
						$level = $usr->level("");
						$smarty->assign("listLevel",$level);
					}
				}
			}else{
				$smarty->assign('pesan',"Isilah semua field yang disediakan !");
					$smarty->assign('username',$_POST['username']);
					$smarty->assign('pwdc',$_POST['pwdc']);
					$smarty->assign('usernamep',$_POST['pwdp']);
					$smarty->assign('pwdp',$_POST['pwdc']);
					$smarty->assign('idChild','$id');
					if(isset($_POST['level'])){
						$level = $usr->level($_POST['level']);
						$smarty->assign("listLevel",$level);
					}else{
						$level = $usr->level("");
						$smarty->assign("listLevel",$level);
					}
			}
		}
		$template = "userm_aktivasi.tpl";
	break;	
	case "edit":
		$id = @preg_replace("@[^0-9a-z_.]@i","",$_GET['id']);
		// save edited value
		$failed = false;
		if($_POST['simpan']){
			if(!$failed){
				if($usr->simpan()){
					$smarty->assign('pesan',"Data Updated !".$meta);
					$smarty->assign('dshowMe',true);
				}else{
					$smarty->assign('pesan',"Failed to edit Membersip !");
				}
			}
		}
		if($data = $usr->showData($id)){
			$dataBest = $usr->showBest($id);
			// assign data
			$smarty->assign('dataUser',$data);
			$smarty->assign('dataB',$dataBest);
			$smarty->assign("listLevel",$usr->level($data['level']));	
			$smarty->assign("listGroup",$usr->gType($data['group_type']));	
			$smarty->assign("listPackage",$usr->pType($data['package']));	
			$smarty->assign("listNegara",$usr->country($data['negara']));	
			if($data['recomendation'] == 1){
				$smarty->assign("check", "checked");
			} else {
				$smarty->assign("check", "");
			}
		}
		$template = "userm_edit.tpl";
		break;
	case "delete":
		if($_POST['delete']){
			if($usr->delUsers()){
				$smarty->assign('pesan',"Membership/s Deleted !".$meta);
				$smarty->assign('dshowMe',true);
			}else{
				$smarty->assign('pesan',"Failed to delete Membership/s !");
			}
		}
		break;
	default:
		$template = "userm.tpl";
}

// user list
$doAksi2 = false;
if($listUsers = $usr->showUsers()){
	$smarty->assign('paging',$usr->pageMe());
	$smarty->assign('listUsers',$listUsers);
}else{
	$smarty->assign('listUsers',false);
}
// assign user template
$content = $smarty->fetch($template);

$smarty->assign('content',$content);
?>