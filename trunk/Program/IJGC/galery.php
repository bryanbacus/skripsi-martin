<?
if(!defined("NODIRECT")){
	die("No direct Access !!");
}
$depan = new koneksi;

$depan->sql = "select id,left(album,25) as album from album where status='1' order by id desc";
$depan->perPage = LIST_PER_PAGE;
$depan->tipe = 2;
$sql = $depan->genSql();
$rProf = $depan->exQ($sql);
if(mysql_num_rows($rProf)>0){
	$n = 0;
	$listAlbum = array();
	while($data = mysql_fetch_array($rProf,MYSQL_ASSOC)){
		foreach($data as $k=>$i){
			$listAlbum[$n][$k]=$i;
		}
		$n++;
	}
	$smarty->assign('paging',$depan->pageMe());
	$smarty->assign('pNum',$depan->page);
	$smarty->assign("listAlbum",$listAlbum);
	// assign 1ist album
	if($_GET['id']){
		$id= @preg_replace("@[^0-9]@i","",$_GET['id']);
		$sql = "select *,date_format(tanggal,'%d %M %Y') as tanggal from album where status='1' and id=$id";
	}else{
		$sql = "select *,date_format(tanggal,'%d %M %Y') as tanggal from album where status='1' order by id desc limit 1";
	}
	if($r = $depan->exQ($sql)){
		$data = mysql_fetch_array($r,MYSQL_ASSOC);
		$smarty->assign("id_album",$data['id']);
		$smarty->assign("album",$data['album']);
		$smarty->assign("tanggal",$data['tanggal']);
		$smarty->assign("deskripsi",str_replace(array("\n","\r"),"<br>",$data['deskripsi']));
		$id = $data["id"];
	}
	if($_GET['test']){
		if($_GET['id']){
			$id= @preg_replace("@[^0-9]@i","",$_GET['id']);
			$sql = "select * from galery where id_album=$id";
		}else{
			$sql = "select * from galery where id_album=$id order by id asc";
		}
	}else{
		if($_GET['id']){
			$id= @preg_replace("@[^0-9]@i","",$_GET['id']);
			$sql = "select * from galery where status='1' and id_album=$id";
		}else{
			$sql = "select * from galery where status='1' and id_album=$id order by id asc";
		}
	}
	$depan->perPage = PHOTO_PER_PAGE;
	$depan->sql = $sql;
	$depan->tipe = 2;
	$depan->varName = "pF";
	$sql = $depan->genSql();
	$rProf = $depan->exQ($sql);
	if(mysql_num_rows($rProf)>0){
		$no = 0;
		while($data = mysql_fetch_array($rProf,MYSQL_ASSOC)){
			$listGalery[$no]['thumb']="/images/galery/".$data['id_album']."/thumbs_".$data['thumbs'];
			foreach($data as $k=>$i){
				if($k=="caption"){
					if(strlen($i)>25){
						$listGalery[$no][$k]=substr($i,0,25)."...";
					}else{
						$listGalery[$no][$k]=$i;
					}
				}else{
					$listGalery[$no][$k]=$i;
				}
			}
			$no++;
		}
		$smarty->assign('pagingPhoto',$depan->pageMe());
		$smarty->assign('pFNum',$depan->page);
		$smarty->assign("listGalery",$listGalery);
	}else{
		$smarty->assign("listGalery",false);
	}
	$smarty->assign("detailAlbum",true);
}else{
	$smarty->assign("listAlbum",false);
	$smarty->assign("pesan","Belum ada Album !");
	$smarty->assign("detailAlbum",false);
}
?>