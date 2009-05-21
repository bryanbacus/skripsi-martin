<?
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

require_once(PATH_CLASS."/galery.php");

$gal = new galery;

// def var
$template = "galery.tpl";
$smarty->assign('judul',"Galery Management");
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=galery" />';
$smarty->assign('referer',$_SERVER['SCRIPT_NAME']."?aksi=galery");

// fetch data
$x = 0;
$gal->sql = "select *, date_format(tanggal, '%d %M %Y') as tanggal, left(album,25) as album, if(status=1,'Aktif','nonAktif') as status from album order by id asc";
$gal->perPage = 3;
$gal->gul = 10;
$sql = $gal->genSql();
$result = $gal->exQ($sql);
while($data = mysql_fetch_array ($result,MYSQL_ASSOC)){
	$thumbFile = "kosong.gif";
	if(is_dir("../images/galery/".$data['id'])){
		if ($handle = opendir('../images/galery/'.$data['id'])) {
			while (false !== ($file = readdir($handle))) { 
				if(!($file=="." || $file=="..")){
					if(substr($file,0,6)=="thumbs"){
						$thumbFile = $data['id'].'/'.$file;
						break;
					}
				}
			}
			closedir($handle); 
		}
	}else{
		echo "Failed !";
	}
	$listAlbum[$x]['thumbs']="/images/galery/".$thumbFile;
	foreach($data as $k=>$i){
		$listAlbum[$x][$k]=$i;
	}
	$x++;
}
$smarty->assign('paging',$gal->pageMe());
$smarty->assign('listAlbum',$listAlbum);

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if($_POST['edit'] && $aksi2==""){
	$aksi2 = "edit";
}
if($_POST['gambar'] && $aksi2==""){
	$aksi2 = "gambar";
}
if($_POST['delete'] && $aksi2==""){
	$aksi2 = "delete";
}
$smarty->assign('aksi2',$aksi2);
switch($aksi2){
	case "add":
		if($gal->add_gal()){
			$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=galery&aksi2=gambar&id='.$gal->id_album.'" />';
			$smarty->assign('pesan',$gal->pesan.$meta);
			$smarty->assign('dShowMe',true);
		}else{
			$smarty->assign("album",eraseStrange($_POST['album']));
			if($_POST['tanggal']){
				$smarty->assign("tanggal",eraseStrange($_POST['tanggal']));
			}else{
				$smarty->assign("tanggal",date('m-d-Y'));
			}
			$smarty->assign("deskripsi",eraseStrange($_POST['deskripsi']));
			$status = preg_replace("@[^0-9]@i","",$_POST['status']);
			if($status==1){
				$smarty->assign("status","checked");
			}else{
				$smarty->assign("status","");
			}
			$smarty->assign('pesan',$gal->pesan);
		}
		$template = "galery_add_edit.tpl";
		break;
	case "edit":
		if(isset($_POST['simpan'])){
			$id = preg_replace("@[^0-9]@i","",$_POST['id']);
			if($gal->edit_gal($id)){
				$smarty->assign("pesan",$gal->pesan.$meta);
				$smarty->assign('dShowMe',true);
			}else{
				$smarty->assign("pesan",$gal->pesan);
			}
		}else{
			if(isset($_POST['cAlbum'])){
				$id = preg_replace("@[^0-9]@i","",$_POST['cAlbum']);
				$sql = "select *,date_format(tanggal,'%m-%d-%Y') as tanggal from album where id=$id";
				if($r = $gal->exQ($sql)){
					$data = mysql_fetch_array($r,MYSQL_ASSOC);
					$smarty->assign("id_album",$id);
					$smarty->assign("album",$data['album']);
					$smarty->assign("tanggal",$data['tanggal']);
					$smarty->assign("deskripsi",str_replace(array("\n"."\r"),"<br>",$data['deskripsi']));
					if($data['status']==1){
						$smarty->assign("status"," checked");
					}else{
						$smarty->assign("status","");
					}
				}
				$template = "galery_add_edit.tpl";
			}else{
				$smarty->assign("pesan","Pilih salah satu album untuk diedit !");
			}
		}
		break;
	case "delete":
		if(isset($_POST['cAlbum'])){
			$id = preg_replace("@[^0-9]@i","",$_POST['cAlbum']);
			if($gal->delAlbum($id)){
				$smarty->assign("pesan",$gal->pesan.$meta);
				$smarty->assign('dShowMe',true);
			}else{
				$smarty->assign("pesan",$gal->pesan);
			}
		}else{
			$smarty->assign("pesan","Pilih salah satu album untuk didelete !");
		}
		break;
	case "gambar":
		include "galery_gambar.php";
		break;
	default:
		$template = "galery.tpl";
}

// assign links template
$content = $smarty->fetch($template);
$smarty->assign('content',$content);
?>