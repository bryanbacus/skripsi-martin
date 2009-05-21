<?
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

require_once(PATH_CLASS."/tip.php");

// new links class
$tips = new tips;
$tips->konek();

// kategori berita
$listkategori = $tips->Kategori(1);
//echo "<pre>";
//print_r($listkategori);
//echo "</pre>";

$fKat = "1=1";
if(isset($_GET['kategori'])){
	$kategori = @preg_replace("@[^0-9]@i","",$_GET['kategori']);
	$listkategori = $tips->Kategori($kategori);
	if($listkategori != ""){
		foreach($listkategori as $key->value){
			$kate = $listkategori['description'];
			$fKat = "kategori = "."'".$listkategori['id']."'"; 
		}
	} else {
			$kate = "Getting Started";
			$fKat = "kategori = 1"; 
	}
	$smarty->assign('kategori',$kategori);
}

// def var
$template = "tip.tpl";
$smarty->assign('judul',$kate." Tips Management");
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=tip&kategori='.$kategori.'\'" />';
if($_SERVER['HTTP_REFERER']){
	$smarty->assign('referer',$_SERVER['HTTP_REFERER']);
}else{
	$smarty->assign('referer',$_SERVER['SCRIPT_NAME']."?aksi=tip&kategori=$kategori");
}
$smarty->assign('path_editor',PATH_EDITOR);

// fetch data
$x = 0;
$tips->sql = "select id, photo, substr(content,1,100) as isi, link, kategori, if(status=1,'aktif', 'non aktif') as status from tbl_tips where $fKat order by id Desc";
$tips->perPage = REC_PER_PAGE;
$tips->gul = 10;
$sql = $tips->genSql();
$result = $tips->exQ($sql);
while($data = mysql_fetch_array ($result,MYSQL_ASSOC)){
	foreach($data as $k=>$i){
		$listTips[$x][$k]=$i;
		if($k=="kategori"){
			//kategoritips
			$listkategori = $tips->Kategori($kategori);
			$listTips[$x][$k] = $listkategori['description'];
		}
	}
	$x++;
}
$smarty->assign('paging',$tips->pageMe());
$smarty->assign('listTips',$listTips);

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if($_POST['smbDelete'] && $aksi2==""){
	$aksi2 = "delete";
}
$smarty->assign('aksi2',$aksi2);
switch($aksi2){
	case "add":
		if($tips->add_news()){
			$rec = mysql_fetch_array(mysql_query("select max(id) from tbl_tips"),MYSQL_NUM);
			if($_FILES['gambar']['size']>0){
				$nfile = $rec[0];
				if(!$tips->uploadFile(100000,$nfile)){
					$meta = $tips->pesan;
					$smarty->assign('kembali',true);
					$smarty->assign('id',$nfile);
					$smarty->assign('aksi2',$aksi2);
				}else{
					$sql = "update tbl_tips set photo='$tips->thumbName' where id=$rec[0]";
					$tips->exQ($sql);
				}
			}
			$smarty->assign('pesan',"Tips added !<br>".$meta);
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
			$smarty->assign('pesan',$tips->pesan);
		}
		$template = "tip_add_edit.tpl";
		break;
	case "edit":
		$id = @preg_replace("@[^0-9]@i","",$_GET['id']);
		if($tips->edit_news($id)){
			if($_FILES['gambar']['size']>0){
				if(!$tips->uploadFile(100000,$id)){
					$meta = $tips->pesan;
					$smarty->assign('kembali',true);
					$smarty->assign('id',$id);
				}else{
					$sql = "update tbl_tips set photo='$tips->thumbName' where id=$id";
					#echo $sql;
					$tips->exQ($sql);
				}
			}
			$smarty->assign('pesan',"Tips edited !<br>".$meta);
			$smarty->assign('dShowMe',true);
		}else{
			$sql = "select photo,content,link,kategori,status from tbl_tips where id=$id";
			#echo $sql;
			if($r = $tips->exQ($sql)){
				if(mysql_num_rows($r)>0){
					$data = mysql_fetch_array($r,MYSQL_ASSOC);
					$smarty->assign("kategori",$data['kategori']);
					$smarty->assign("link",$data['link']);
					$smarty->assign("content",str_replace(array("\r","\n","\e"),"",$data['content']));
					$status = preg_replace("@[^0-9]@i","",$data['status']);
					if($status==1){
						$smarty->assign("checked","checked");
					}else{
						$smarty->assign("checked","");
					}
					if($data['photo']){
						$smarty->assign('gbr',true);
						$smarty->assign('urlGbr','../images/tips/'.$data['photo']);
					}
				}else{
					$smarty->assign('pesan',"Data tidak terdapat di dalam database !".$meta);
					$smarty->assign('dShowMe',true);
				}
			}
		}
		$template = "tip_add_edit.tpl";
		break;
	case "delete":
		if($_POST['smbDelete']){
			#print_r($_POST);
			if(count($_POST['cPoll'])>0){
				foreach($_POST['cPoll'] as $k=>$i){
					$id = preg_replace("@[^0-9]@i","",$i);
					$sql = "select photo from tbl_tips where id='$id'";
					$r = $tips->exQ($sql);
					$data = mysql_fetch_array($r,MYSQL_ASSOC);
					if(file_exists(WEB_PATH.PATH_IMAGES.'/tips/'.$data['photo'])){
						unlink(WEB_PATH.PATH_IMAGES.'/tips/'.$data['photo']);
					}
					mysql_query ("DELETE from tbl_tips WHERE id='$id'");
					$pollrows = mysql_num_rows (mysql_query ("SELECT * from tbl_tips"));
					if ($pollrows == 0) {
						mysql_query ("TRUNCATE tbl_tips");
					}
				}
				$smarty->assign('pesan',"Tips/s deleted !".$meta);
				$smarty->assign('dShowMe',true);
			}else{
				$smarty->assign('pesan',"Choose Tips/s to delete !");
			}
		}
		break;
	default:
		$template = "tip.tpl";
}

// assign links template
$content = $smarty->fetch($template);
$smarty->assign('content',$content);
?>