<?
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

$aksi3 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi3']);
$id = preg_replace("@[^0-9]@i","",$_GET['id']);
$smarty->assign('referer',$_SERVER['SCRIPT_NAME']."?aksi=galery&aksi2=gambar&id=$id");
$sql = "select *,date_format(tanggal,'%m-%d-%Y') as tanggal, if(status=1,'Aktif','nonAktif') as status from album where id=$id";
if($r = $gal->exQ($sql)){
	$data = mysql_fetch_array($r,MYSQL_ASSOC);
	$smarty->assign("id_album",$id);
	$smarty->assign("album",$data['album']);
	$smarty->assign("tanggal",$data['tanggal']);
	$smarty->assign("deskripsi",str_replace(array("\n","\r"),"<br>",$data['deskripsi']));
	$smarty->assign("status",$data['status']);
}

if($_POST['edit'] && $aksi3==""){
	$aksi3 = "caption";
	$smarty->assign("edit",true);
}
if($_POST['delete'] && $aksi3==""){
	$aksi3 = "delete";
}
switch($aksi3){
	case "add":
		if(isset($_POST['simpan'])){
			if($gal->tambahGambar($id)){
				$idUploaded = "";
				foreach($gal->idUploaded as $idU){
					$idUploaded .= "&cGalery[]=$idU";
				}
				$meta = '<meta http-equiv="refresh" content="2;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=galery&aksi2=gambar&aksi3=caption&id='.$id.$idUploaded.'" />';
				$smarty->assign("pesan",$gal->pesan.$meta);
				$smarty->assign('dShowMe',true);
			}else{
				$smarty->assign("pesan",$gal->pesan);
			}
		}
		$template = "galery_add.tpl";
		break;
	case "caption":
		if(isset($_POST['simpan'])){
			if($gal->simpanCaption()){
				$meta = '<meta http-equiv="refresh" content="2;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=galery&aksi2=gambar&id='.$id.'" />';
				$smarty->assign("pesan",$gal->pesan.$meta);
				$smarty->assign('dShowMe',true);
			}else{
				$smarty->assign("pesan",$gal->pesan);
			}
		}else{
			if(isset($_GET['cGalery']) || isset($_POST['cGalery'])){
				if(isset($_POST['cGalery'])){
					$cGalery = $_POST['cGalery'];
				}else{
					$cGalery = $_GET['cGalery'];
				}
				$idGal="";
				foreach($cGalery as $idUp){
					$idGal .= "$idUp,";
				}
				$idGal = substr($idGal,0,strlen($idGal)-1);
				$sql = "select *, if(status=1,'checked','') as status from galery where id in($idGal)";
				#echo $sql;
				if($r = $gal->exQ($sql)){
					$no = 0;
					while($data = mysql_fetch_array($r,MYSQL_ASSOC)){
						$listGalery[$no]['thumb']="/images/galery/$id/thumbs_".$data['thumbs'];
						foreach($data as $k=>$i){
							$listGalery[$no][$k] = $i;
						}
						$no++;
					}
					$smarty->assign("listGalery",$listGalery);
				}
			}
		}
		$template = "galery_captions.tpl";
		break;
	case "delete":
		if(isset($_POST['cGalery'])){
			if($gal->delGalery($id)){
				$meta = '<meta http-equiv="refresh" content="2;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=galery&aksi2=gambar&id='.$id.'" />';
				$smarty->assign("pesan",$gal->pesan.$meta);
				$smarty->assign('dShowMe',true);
			}else{
				$smarty->assign("pesan",$gal->pesan);
			}
		}
		$template = "galery_gambar.tpl";		
		break;
	default:
		$smarty->assign("id_album",$id);
		$sql = "select *,date_format(tanggal,'%d %M %Y') as tanggal, if(status=1,'Aktif','nonAktif') as status from album where id=$id";
		#echo $sql;
		if($r = $gal->exQ($sql)){
			$data = mysql_fetch_array($r,MYSQL_ASSOC);
			$smarty->assign("album",$data['album']);
			$smarty->assign("tanggal",$data['tanggal']);
			$smarty->assign("deskripsi",str_replace(array("\n"."\r"),"<br>",$data['deskripsi']));
			$smarty->assign("status",$data['status']);
			$gal->sql = "select *, if(status=1,'Aktif','nonAktif') as status from galery where id_album=$id";
			$gal->perPage = 5;
			$gal->gul = 10;
			$sql = $gal->genSql();
			if($rr = $gal->exQ($sql)){
				$no = 0;
				while($dataG = mysql_fetch_array($rr,MYSQL_ASSOC)){
					$listGalery[$no]['thumb']="/images/galery/$id/thumbs_".$dataG['thumbs'];
					foreach($dataG as $k=>$i){
						$listGalery[$no][$k] = $i;
					}
					$no++;
				}
				$smarty->assign('paging',$gal->pageMe());
				$smarty->assign("listGalery",$listGalery);
			}
		}
		$template = "galery_gambar.tpl";		
}
?>