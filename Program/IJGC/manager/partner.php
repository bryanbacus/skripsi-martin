<?
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

require_once(PATH_CLASS."/partner.php");
// new products class
$partner = new partner;
$partner->konek();

// kategori product /default1
$listkategori = $partner->Kategori(1);

// def var
$template = "partnerK.tpl";
$smarty->assign('judul',"Partners and Event Management");
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=partnerk" />';
if($_SERVER['HTTP_REFERER']){
	$smarty->assign('referer',$_SERVER['HTTP_REFERER']);
}else{
	$smarty->assign('referer',$_SERVER['SCRIPT_NAME']."?aksi=partner");
}
$smarty->assign('path_editor',PATH_EDITOR);

// fetch data
$x = 0;
$partner->sql = "select id,name,substr(description,1,100) as isi,logo,link,type_partner, if(status=1,'aktif', 'non aktif') as status from tbl_partner order by id Desc";
$partner->perPage = REC_PER_PAGE;
$partner->gul = 10;
$sql = $partner->genSql();
$result = $partner->exQ($sql);
while($data = mysql_fetch_array ($result,MYSQL_ASSOC)){
	foreach($data as $k=>$i){
		$listPartner[$x][$k]=$i;
		if($k=="logo"){
			if($i == ""){
				$listPartner[$x][$k] = IMAGE_PARTNER."/noPict.jpg";
			} else {
				$listPartner[$x][$k] = IMAGE_PARTNER."/".$i;
			}
		} 
		if($k=="type_partner"){
			//kategoriPrduct
			$listkategori = $partner->Kategori($i);
			$listPartner[$x][$k] = $listkategori['description'];
		}
	}
	$x++;
}

$smarty->assign('paging',$partner->pageMe());
$smarty->assign('listPartner',$listPartner);

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if($_POST['smbDelete'] && $aksi2==""){
	$aksi2 = "delete";
}
$smarty->assign('aksi2',$aksi2);
switch($aksi2){
	case "add":
		if($partner->add_news()){
			$rec = mysql_fetch_array(mysql_query("select max(id) from tbl_partner"),MYSQL_NUM);
			if($_FILES['gambar']['size']>0){
				$nfile = $rec[0];
				if(!$partner->uploadFile(100000,$nfile)){
					$meta = $partner->pesan;
					$smarty->assign('kembali',true);
					$smarty->assign('id',$nfile);
					$smarty->assign('aksi2',$aksi2);
				}else{
					$sql = "update tbl_partner set logo='$partner->thumbName' where id=$rec[0]";
					$partner->exQ($sql);
				}
			}
			$smarty->assign('pesan',"Products added !<br>".$meta);
			$smarty->assign('dShowMe',true);
		}else{
			$kategori = eraseStrange($_POST['kategori']);
			$draw = $partner->drawKategori('$kategori');
			$smarty->assign("drawK",$draw);
			$smarty->assign("name",eraseStrange($_POST['name']));
			$smarty->assign("link",eraseStrange($_POST['link']));
			$smarty->assign("content",str_replace(array("\r","\n","\e"),"",eraseStrange($_POST['content'])));
			$status = preg_replace("@[^0-9]@i","",$_POST['status']);
			if($status==1){
				$smarty->assign("checked","checked");
			}else{
				$smarty->assign("checked","");
			}
			$smarty->assign('pesan',$partner->pesan);
		}
		$draw = $partner->drawKategori("");
		$smarty->assign("drawK",$draw);
		$template = "partnerK_add_edit.tpl";
		break;
	case "edit":
		$id = @preg_replace("@[^0-9]@i","",$_GET['id']);
		if($partner->edit_news($id)){
			if($_FILES['gambar']['size']>0){
				if(!$partner->uploadFile(100000,$id)){
					$meta = $partner->pesan;
					$smarty->assign('kembali',true);
					$smarty->assign('id',$id);
				}else{
					$sql = "update tbl_partner set logo='$partner->thumbName' where id=$id";
					#echo $sql;
					$partner->exQ($sql);
				}
			}
			$smarty->assign('pesan',"Products edited !<br>".$meta);
			$smarty->assign('dShowMe',true);
		}else{
			$sql = "select name,description,logo,link,type_partner,status from tbl_partner where id=$id";
			#echo $sql;
			if($r = $partner->exQ($sql)){
				if(mysql_num_rows($r)>0){
					$data = mysql_fetch_array($r,MYSQL_ASSOC);
					$draw = $partner->drawKategori($data['type_partner']);
					$smarty->assign("drawK",$draw);
					$smarty->assign("link",$data['link']);
					$smarty->assign("name",$data['name']);
					$smarty->assign("content",str_replace(array("\r","\n","\e"),"",$data['description']));
					$status = preg_replace("@[^0-9]@i","",$data['status']);
					if($status==1){
						$smarty->assign("checked","checked");
					}else{
						$smarty->assign("checked","");
					}
					if($data['logo']){
						$smarty->assign('gbr',true);
						$smarty->assign('urlGbr',IMAGE_PARTNER."/".$data['logo']);
					}
				}else{
					$smarty->assign('pesan',"Data tidak terdapat di dalam database !".$meta);
					$smarty->assign('dShowMe',true);
				}
			}
		}
		$template = "partnerK_add_edit.tpl";
		break;
	case "delete":
		if($_POST['smbDelete']){
			#print_r($_POST);
			if(count($_POST['cPoll'])>0){
				foreach($_POST['cPoll'] as $k=>$i){
					$id = preg_replace("@[^0-9]@i","",$i);
					$sql = "select logo from tbl_partner where id='$id'";
					$r = $partner->exQ($sql);
					$data = mysql_fetch_array($r,MYSQL_ASSOC);
					if(file_exists(WEB_PATH.PATH_IMAGES.'/partner/'.$data['logo'])){
						unlink(WEB_PATH.PATH_IMAGES.'/partner/'.$data['logo']);
					}
					mysql_query ("DELETE from tbl_partner WHERE id='$id'");
					$pollrows = mysql_num_rows (mysql_query ("SELECT * from tbl_partner"));
					if ($pollrows == 0) {
						mysql_query ("TRUNCATE tbl_partner");
					}
				}
				$smarty->assign('pesan',"Partner/s deleted !".$meta);
				$smarty->assign('dShowMe',true);
			}else{
				$smarty->assign('pesan',"Choose Partner/s to delete !");
			}
		}
		break;
	default:
		$template = "partnerK.tpl";
}

// assign links template
$content = $smarty->fetch($template);
$smarty->assign('content',$content);
?>