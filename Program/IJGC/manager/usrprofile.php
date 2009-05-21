<?php
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

if($_SESSION['levelUser']!=1){
	header("Location:index.php");
}

require_once(PATH_CLASS."/usrprofile.php");

// new user class
$usr = new userm;

// def var
$smarty->assign('judul',"Membership Management");
$smarty->assign('path_editor',PATH_EDITOR);
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=usrprofile\'" />';
$smarty->assign('referer',$_SERVER['SCRIPT_NAME']."?aksi=usrprofile");
$template = "userm.tpl";

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if($_POST['delete']){
	$aksi2 = "delete";
}
$smarty->assign('aksi2',$aksi2);
switch($aksi2){
	case "edit":
		$id = @preg_replace("@[^0-9a-z_.]@i","",$_GET['id']);
		$idGambar = @preg_replace("@[^0-9a-z_A-Z]@i","",$_GET['id']);
		//echo $idGambar;
		// save edited value
		$failed = false;
		if($_POST['simpan']){
			if(!$failed){
				if($usr->simpan()){
					if($_FILES['gambar']['size']>0){
						if(!$usr->uploadFile(100000,$idGambar)){
							$meta = $usr->pesan;
							$smarty->assign('kembali',true);
						}else{
							$sql = "update tbl_membership set gambar='$usr->thumbName' where id=$id";
							#echo $sql;
							$usr->exQ($sql);
						}
					}
					$smarty->assign('pesan',"Data Updated !".$meta);
					$smarty->assign('dshowMe',true);
				}else{
					$smarty->assign('pesan',"Failed to edit Membersip !");
				}
			}
		}
		if($data = $usr->showData($id)){
			$datausr = $usr->showUsr($id);
			$smarty->assign("datausr",$datausr);
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
		$template = "usrprofile_edit.tpl";
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
		$template = "usrprofile.tpl";
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