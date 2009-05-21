<?
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

require_once(PATH_CLASS."/foundation.php");

// new links class
$found = new foundation;
$found->konek();

// def var
$template = "foundation.tpl";
$smarty->assign('judul',$kate." Foundation Management");
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=found&kategori='.$kategori.'\'" />';
if($_SERVER['HTTP_REFERER']){
	$smarty->assign('referer',$_SERVER['HTTP_REFERER']);
}else{
	$smarty->assign('referer',$_SERVER['SCRIPT_NAME']."?aksi=found&kategori=$kategori");
}
$smarty->assign('path_editor',PATH_EDITOR);

// fetch data
$x = 0;
$found->sql = "select id, gambar, substr(deskripsi,1,100) as isi, link, kategori, if(status=1,'aktif', 'non aktif') as status from tbl_foundation order by id Desc";
//echo $found->sql;
$found->perPage = REC_PER_PAGE;
$found->gul = 10;
$sql = $found->genSql();
$result = $found->exQ($sql);
while($data = mysql_fetch_array ($result,MYSQL_ASSOC)){
	foreach($data as $k=>$i){
		$listFoundation[$x][$k]=$i;
		if($k=="gambar"){
			if($i != ""){
				$listFoundation[$x][$k] = PATH_FOUNDATION."/".$i;
			} else {
				$listFoundation[$x][$k] = PATH_FOUNDATION."/noPict.jpg";
			}
		}
		if($k=="kategori"){
			//kategoritips
			$listkategori = $found->Kategori($i);
			$listFoundation[$x][$k] = $listkategori['description'];
		}
	}
	$x++;
}
$smarty->assign('paging',$found->pageMe());
$smarty->assign('listFoundation',$listFoundation);


// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if($_POST['smbDelete'] && $aksi2==""){
	$aksi2 = "delete";
}
$smarty->assign('aksi2',$aksi2);
switch($aksi2){
	case "add":
		$ListKate = $found->ListKategori();
		$smarty->assign("ListKategori",$ListKate);
		if($found->add_foundation()){
			$rec = mysql_fetch_array(mysql_query("select max(id) from tbl_foundation"),MYSQL_NUM);
			if($_FILES['gambar']['size']>0){
				$nfile = $rec[0];
				if(!$found->uploadFile(100000,$nfile)){
					$meta = $found->pesan;
					$smarty->assign('kembali',true);
					$smarty->assign('id',$nfile);
					$smarty->assign('aksi2',$aksi2);
				}else{
					$sql = "update tbl_foundation set gambar='$found->thumbName' where id=$rec[0]";
					$found->exQ($sql);
				}
			}
			$smarty->assign('pesan',"Foundation added !<br>".$meta);
			$smarty->assign('dShowMe',true);
		}else{
			$smarty->assign("kategori",eraseStrange($_POST['kategori']));
			$smarty->assign("link",eraseStrange($_POST['link']));
			$smarty->assign("content",str_replace(array("\r","\n","\e"),"",eraseStrange($_POST['content'])));
			$status = preg_replace("@[^0-9]@i","",$_POST['status']);
			if($status==1){
				$smarty->assign("checked","checked");
			}else{
				$smarty->assign("checked","");
			}
			$smarty->assign('pesan',$found->pesan);
		}
		$template = "found_add_edit.tpl";
		break;
	case "edit":
		$id = @preg_replace("@[^0-9]@i","",$_GET['id']);
		$ListKate = $found->ListKategori();
		$smarty->assign("ListKategori",$ListKate);
		if($found->edit_news($id)){
			if($_FILES['gambar']['size']>0){
				if(!$found->uploadFile(100000,$id)){
					$meta = $found->pesan;
					$smarty->assign('kembali',true);
					$smarty->assign('id',$id);
				}else{
					$sql = "update tbl_foundation set photo='$found->thumbName' where id=$id";
					#echo $sql;
					$found->exQ($sql);
				}
			}
			$smarty->assign('pesan',"Foundation edited !<br>".$meta);
			$smarty->assign('dShowMe',true);
		}else{
			$sql = "select gambar,deskripsi,link,kategori,status from tbl_foundation where id=$id";
			#echo $sql;
			if($r = $found->exQ($sql)){
				if(mysql_num_rows($r)>0){
					$data = mysql_fetch_array($r,MYSQL_ASSOC);
					$smarty->assign("kategori",$data['kategori']);
					$smarty->assign("link",$data['link']);
					$smarty->assign("content",str_replace(array("\r","\n","\e"),"",$data['deskripsi']));
					$status = preg_replace("@[^0-9]@i","",$data['status']);
					if($status==1){
						$smarty->assign("checked","checked");
					}else{
						$smarty->assign("checked","");
					}
					if($data['gambar']){
						$smarty->assign('gbr',true);
						$smarty->assign('urlGbr',PATH_FOUNDATION.$data['gambar']);
					}
				}else{
					$smarty->assign('pesan',"Data tidak terdapat di dalam database !".$meta);
					$smarty->assign('dShowMe',true);
				}
			}
		}
		$template = "found_add_edit.tpl";
		break;
	case "delete":
		if($_POST['smbDelete']){
			#print_r($_POST);
			if(count($_POST['cPoll'])>0){
				foreach($_POST['cPoll'] as $k=>$i){
					$id = preg_replace("@[^0-9]@i","",$i);
					$sql = "select gambar from tbl_foundation where id='$id'";
					$r = $found->exQ($sql);
					$data = mysql_fetch_array($r,MYSQL_ASSOC);
					if(file_exists(WEB_PATH.PATH_IMAGES.'/foundation/'.$data['gambar'])){
						unlink(WEB_PATH.PATH_IMAGES.'/foundation/'.$data['gambar']);
					}
					mysql_query ("DELETE from tbl_foundation WHERE id='$id'");
					$pollrows = mysql_num_rows (mysql_query ("SELECT * from tbl_foundation"));
					if ($pollrows == 0) {
						mysql_query ("TRUNCATE tbl_tips");
					}
				}
				$smarty->assign('pesan',"Foundation/s deleted !".$meta);
				$smarty->assign('dShowMe',true);
			}else{
				$smarty->assign('pesan',"Choose Foundation/s to delete !");
			}
		}
		break;
	default:
		$template = "foundation.tpl";
}

// assign links template
$content = $smarty->fetch($template);
$smarty->assign('content',$content);
?>