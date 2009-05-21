<?
//security checking
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

include(PATH_CLASS."/boardManager.php");
$board = new boardManager;
define("IMAGES_PATH","../images/profile");
$smarty->assign("imagesPath",IMAGES_PATH);
$template = "boardManager.tpl";

// def var
$smarty->assign('judul',"Profile Management");
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=board\'" />';
if($_SERVER['HTTP_REFERER']){
	$smarty->assign('referer',$_SERVER['HTTP_REFERER']);
	$reff='<meta http-equiv="refresh" content="2;url=\''.$_SERVER['HTTP_REFERER'].'\'"/>';
}else{
	$smarty->assign('referer',$_SERVER['SCRIPT_NAME']."?aksi=board");
}
$smarty->assign('path_editor',PATH_EDITOR);
$smarty->assign("ListBoards",$board->tipeBoards());

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if($_POST['smbDelete'] && $aksi2==""){
	$aksi2 = "delete";
}
$smarty->assign('aksi2',$aksi2);
switch($aksi2){
	case "add":
		if($board->add_profile()){
			$rec = mysql_fetch_array(mysql_query("select max(id) from tbl_boardmanager"),MYSQL_NUM);
			if($_FILES['gambar']['size']>0){
				$nfile = $rec[0];
				if(!$board->uploadFile(100000,$nfile)){
					$meta = $board->pesan;
					$smarty->assign('kembali',true);
					$smarty->assign('id',$nfile);
					$smarty->assign('aksi2',$aksi2);
				}else{
					$sql = "update tbl_boardmanager set photo='$board->thumbName' where id=$rec[0]";
					$board->exQ($sql);
				}
			}
			$smarty->assign('pesan',"Profile added !<br>".$meta);
			$smarty->assign('dShowMe',true);
		}else{
			//jika gagal submit	
			if($status==1){
				$smarty->assign("checked","checked");
			}else{
				$smarty->assign("checked","");
			}
			$smarty->assign('pesan',$board->pesan);
		}
		$template = "board_add_edit.tpl";
		break;
	case "edit":
		$id = @preg_replace("@[^0-9]@i","",$_GET['id']);
		$smarty->assign('id',$id);
		if($board->edit_profile($id)){
			if($_FILES['gambar']['size']>0){
				if(!$board->uploadFile(100000,$id)){
					$meta = $board->pesan;
					$smarty->assign('kembali',true);
				}else{
					$sql = "update tbl_boardmanager set photo='$board->thumbName' where id=$id";
					#echo $sql;
					$board->exQ($sql);
				}
			}
			
			$smarty->assign('pesan',"Profile edited !<br>".$meta);
			$smarty->assign('dShowMe',true);
		}else{
			$sql = "select * from tbl_boardmanager where id=$id order by id asc";
			if($r = $board->exQ($sql)){
				if(mysql_num_rows($r)>0){
					$data = mysql_fetch_array($r,MYSQL_ASSOC);
					$status = preg_replace("@[^0-9]@i","",$data['status']);
					if($status==1){
						$smarty->assign("checked","checked");
					}else{
						$smarty->assign("checked","");
					}
					$smarty->assign("nama",eraseStrange($data['name']));
					$smarty->assign("title",eraseStrange($data['jabatan']));
					$smarty->assign("narasi",str_replace(array("\r","\n","\e"),"",eraseStrange($data['deskripsi'])));
					if($data['photo']){
						$smarty->assign('gbr',true);
						$smarty->assign('urlGbr','../images/profile/'.$data['photo']);
					}
				}else{
					$smarty->assign('pesan',"Data tidak terdapat di dalam database !".$meta);
					$smarty->assign('dShowMe',true);
				}
			}
		}
		$template = "board_add_edit.tpl";
		break;
	case "delete":
		if($_POST['smbDelete']){
			#print_r($_POST);1
			if(count($_POST['cProf'])>0){
				foreach($_POST['cProf'] as $k=>$i){
					$id = preg_replace("@[^0-9]@i","",$i);
					$sql = "select photo from tbl_boardmanager where id='$id'";
					$r = $board->exQ($sql);
					$data = mysql_fetch_array($r,MYSQL_ASSOC);
					if(file_exists(WEB_PATH.'/'.PATH_PROFILE.'/'.$data['photo'])){
						unlink(WEB_PATH.'/'.IMAGES_PATH.'/'.$data['photo']);
					}
					mysql_query ("DELETE from tbl_boardmanager WHERE id='$id'");
				}
				$smarty->assign('pesan',"Profile/s deleted !".$meta);
				$smarty->assign('dShowMe',true);
			}else{
				$smarty->assign('pesan',"Choose Profile/s to delete !");
			}
		}
		break;
	case "up":
		$urut = @preg_replace("@[^0-9]@i","",$_GET['urut']);
		if($urut){
			if($board->up($urut,$kategori)){
				$smarty->assign('pesan',"Order changed !".$reff);
				$smarty->assign('dShowMe',true);
			}else{
				$smarty->assign('pesan',"Failed to change Link/s order !");
			}
		}
		break;
	case "down":
		$urut = @preg_replace("@[^0-9]@i","",$_GET['urut']);
		if($urut){
			if($board->down($urut,$kategori)){
				$smarty->assign('pesan',"Order changed !".$reff);
				$smarty->assign('dShowMe',true);
			}else{
				$smarty->assign('pesan',"Failed to change Link/s order !");
			}
		}
		break;
	default:
		$template = "boardManager.tpl";
}

// fetch data
$x = 0;
$board->sql = "select * from tbl_boardmanager order by urut asc";
$board->perPage = REC_PER_PAGE;
$board->gul = 10;
$smarty->assign('paging',$board->pageMe());
$sql = $board->genSql();
$result = $board->exQ($sql);
if(mysql_num_rows($result)>0){
	$pertama = false;
	while($data = mysql_fetch_array ($result,MYSQL_ASSOC)){
		if($board->page==1){
			if(!$pertama){
				$listProfile[$x]['pertama'] = true;
				$pertama = true;
			}
		}
		foreach($data as $k=>$i){
			$listProfile[$x][$k]=$i;
			if($k=='jabatan'){
				$listProfile[$x][$k] = $board->tipeBoard($i);
			}
			//check image
			if($k=="photo"){
				if($i != ""){
					$listProfile[$x][$k]=IMAGES_PATH."/".$i;
				}else{
					$listProfile[$x][$k]=IMAGES_PATH."/noPict.jpg";
				}
			}
			//check status
			if($k=="status"){
				if($i==1){
					$listProfile[$x][$k]="Aktif";
				}else{
					$listProfile[$x][$k]="nonAktif";
				}
			}
		}
		$x++;
	}
	if($board->totPage==$board->page){
		$listProfile[$x-1]['terakhir'] = true;
	}
}
$smarty->assign('listProfile',$listProfile);

// assign links template
$content = $smarty->fetch($template);
$smarty->assign('content',$content);

?>