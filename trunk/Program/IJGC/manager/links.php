<?
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

require_once(PATH_CLASS."/links.php");
// new products class
$links = new links;
$links->konek();

// def var
$template = "links.tpl";
$smarty->assign('judul',$kate."Links Management");
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=link" />';
if($_SERVER['HTTP_REFERER']){
	$smarty->assign('referer',$_SERVER['HTTP_REFERER']);
}else{
	$smarty->assign('referer',$_SERVER['SCRIPT_NAME']."?aksi=link");
}
$smarty->assign('path_editor',PATH_EDITOR);

// fetch data
$x = 0;
$links->sql = "select id,substr(content,1,100) as isi,gambar,link, if(status=1,'aktif', 'non aktif') as 
status from tbl_links order by id Desc";
$links->perPage = REC_PER_PAGE;
$links->gul = 10;
$sql = $links->genSql();
$result = $links->exQ($sql);
while($data = mysql_fetch_array ($result,MYSQL_ASSOC)){
	foreach($data as $k=>$i){
		$listLinks[$x][$k]=$i;
		if($k=="gambar"){
			if($i == ""){
				$listLinks[$x][$k] = IMAGE_LINK."/noPict.jpg";
			} else {
				$listLinks[$x][$k] = IMAGE_LINK."/".$i;
			}
		} 
	}
	$x++;
}

$smarty->assign('paging',$links->pageMe());
$smarty->assign('listLinks',$listLinks);

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if($_POST['smbDelete'] && $aksi2==""){
	$aksi2 = "delete";
}
$smarty->assign('aksi2',$aksi2);
switch($aksi2){
	case "add":
		if($links->add_news()){
			$rec = mysql_fetch_array(mysql_query("select max(id) from tbl_links"),MYSQL_NUM);
			if($_FILES['gambar']['size']>0){
				$nfile = $rec[0];
				if(!$tips->uploadFile(100000,$nfile)){
					$meta = $links->pesan;
					$smarty->assign('kembali',true);
					$smarty->assign('id',$nfile);
					$smarty->assign('aksi2',$aksi2);
				}else{
					$sql = "update tbl_links set gambar='$links->thumbName' where id=$rec[0]";
					$tips->exQ($sql);
				}
			}
			$smarty->assign('pesan',"Links added !<br>".$meta);
			$smarty->assign('dShowMe',true);
		}else{
			$smarty->assign("link",eraseStrange($_POST['link']));
			$smarty->assign("content",str_replace(array("\r","\n","\e"),"",eraseStrange($_POST['content'])));
			$status = preg_replace("@[^0-9]@i","",$_POST['status']);
			if($status==1){
				$smarty->assign("checked","checked");
			}else{
				$smarty->assign("checked","");
			}
			$smarty->assign('pesan',$links->pesan);
		}
		$template = "links_add_edit.tpl";
		break;
	case "edit":
		$id = @preg_replace("@[^0-9]@i","",$_GET['id']);
		if($links->edit_news($id)){
			if($_FILES['gambar']['size']>0){
				if(!$links->uploadFile(100000,$id)){
					$meta = $links->pesan;
					$smarty->assign('kembali',true);
					$smarty->assign('id',$id);
				}else{
					$sql = "update tbl_links set gambar='$links->thumbName' where id=$id";
					#echo $sql;
					$links->exQ($sql);
				}
			}
			$smarty->assign('pesan',"Products edited !<br>".$meta);
			$smarty->assign('dShowMe',true);
		}else{
			$sql = "select content,gambar,link,status from tbl_links where id=$id";
			#echo $sql;
			if($r = $links->exQ($sql)){
				if(mysql_num_rows($r)>0){
					$data = mysql_fetch_array($r,MYSQL_ASSOC);
					$smarty->assign("link",$data['link']);
					$smarty->assign("content",str_replace(array("\r","\n","\e"),"",$data['content']));
					$status = preg_replace("@[^0-9]@i","",$data['status']);
					if($status==1){
						$smarty->assign("checked","checked");
					}else{
						$smarty->assign("checked","");
					}
					if($data['gambar']){
						$smarty->assign('gbr',true);
						$smarty->assign('urlGbr',IMAGE_LINK."/".$data['gambar']);
					}
				}else{
					$smarty->assign('pesan',"Data tidak terdapat di dalam database !".$meta);
					$smarty->assign('dShowMe',true);
				}
			}
		}
		$template = "links_add_edit.tpl";
		break;
	case "delete":
		if($_POST['smbDelete']){
			#print_r($_POST);
			if(count($_POST['cPoll'])>0){
				foreach($_POST['cPoll'] as $k=>$i){
					$id = preg_replace("@[^0-9]@i","",$i);
					$sql = "select gambar from tbl_links where id='$id'";
					$r = $tips->exQ($sql);
					$data = mysql_fetch_array($r,MYSQL_ASSOC);
					if(file_exists(WEB_PATH.PATH_IMAGES.'/links/'.$data['gambar'])){
						unlink(WEB_PATH.PATH_IMAGES.'/links/'.$data['gambar']);
					}
					mysql_query ("DELETE from tbl_links WHERE id='$id'");
					$pollrows = mysql_num_rows (mysql_query ("SELECT * from tbl_links"));
					if ($pollrows == 0) {
						mysql_query ("TRUNCATE tbl_links");
					}
				}
				$smarty->assign('pesan',"Link/s deleted !".$meta);
				$smarty->assign('dShowMe',true);
			}else{
				$smarty->assign('pesan',"Choose Link/s to delete !");
			}
		}
		break;
	default:
		$template = "links.tpl";
}

// assign links template
$content = $smarty->fetch($template);
$smarty->assign('content',$content);
?>