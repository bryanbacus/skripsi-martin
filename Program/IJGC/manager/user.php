<?php
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

if($_SESSION['levelUser']!=1){
	header("Location:index.php");
}

require_once(PATH_CLASS."/user.php");

// new user class
$usr = new users;

// def var
$smarty->assign('judul',"User Management");
$smarty->assign('path_editor',PATH_EDITOR);
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=users\'" />';
$smarty->assign('referer',$_SERVER['SCRIPT_NAME']."?aksi=users");
$template = "user.tpl";

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if($_POST['delete']){
	$aksi2 = "delete";
}
$smarty->assign('aksi2',$aksi2);
switch($aksi2){
	case "add":
		if($_POST['simpan']){
			if(!detectBlank($_POST)){
				if($usr->tambah($id)){
					$smarty->assign('pesan',"User Added !".$meta);
					$smarty->assign('dshowMe',true);
				}else{
					$smarty->assign('pesan',$usr->pesan);
					$smarty->assign('username',$_POST['username']);
					$smarty->assign('nama',$_POST['nama']);
					$smarty->assign('email',$_POST['email']);
					if(isset($_POST['level'])){
						if($_POST['level']==1){
							$smarty->assign('s1',"selected");
						}else{
							$smarty->assign('s2',"selected");
						}
					}else{
						$smarty->assign('s1',"selected");
					}
				}
			}else{
				$smarty->assign('pesan',"Isilah semua field yang disediakan !");
				$smarty->assign('username',$_POST['username']);
				$smarty->assign('nama',$_POST['nama']);
				$smarty->assign('email',$_POST['email']);
				if(isset($_POST['level'])){
					if($_POST['level']==1){
						$smarty->assign('s1',"selected");
					}else{
						$smarty->assign('s2',"selected");
					}
				}else{
					$smarty->assign('s1',"selected");
				}
			}
		}
		$template = "user_add_edit.tpl";
		break;
	case "edit":
		$id = @preg_replace("@[^0-9a-z_]@i","",$_GET['usn']);
		// save edited value
		$failed = false;
		if($_POST['simpan']){
			if(isset($_POST['pwd1'])){
				if($_POST['pwd']==$_POST['pwd1']){
					$usr->ubahPass($id);
				}else{
					$failed = true;
					$smarty->assign('pesan',"Password dan Retype Password tidak sama !");
				}
			}
			if(!$failed){
				if($usr->simpan($id)){
					$smarty->assign('pesan',"User Updated !".$meta);
					$smarty->assign('dshowMe',true);
				}else{
					$smarty->assign('pesan',"Failed to edit User !");
				}
			}
		}
		if($data = $usr->showData($id)){
			// assign data
			$smarty->assign('usn',$id);
			if(isset($_POST['nama'])){
				$smarty->assign('nama',$_POST['nama']);
			}else{
				$smarty->assign('nama',$data['nama']);
			}
			if(isset($_POST['email'])){
				$smarty->assign('email',$_POST['email']);
			}else{
				$smarty->assign('email',$data['email']);
			}
			if(isset($_POST['level'])){
				$data['level']=$_POST['level'];
			}
			if($data['level']==1){
				$smarty->assign('s1',"selected");
			}else{
				$smarty->assign('s2',"selected");
			}
		}
		$template = "user_add_edit.tpl";
		break;
	case "delete":
		if($_POST['delete']){
			if($usr->delUsers()){
				$smarty->assign('pesan',"User/s Deleted !".$meta);
				$smarty->assign('dshowMe',true);
			}else{
				$smarty->assign('pesan',"Failed to delete User/s !");
			}
		}
		break;
	default:
		$template = "user.tpl";
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