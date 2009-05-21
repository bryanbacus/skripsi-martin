<?
//definisi variabel
if($_GET['tipeP']){
	$tipeProfile = preg_replace("@[^0-9]@i","",$_GET['tipeP']);
	$smarty->assign("tipe",$tipeProfile);
} else {
	$smarty->assign("pesan","You entered wrong page !");
}
$smarty->assign("jdlImages",$jdlImages);
$smarty->assign("tampil",true);
//data tipeBoardProfile
$sqlB = "select id,description,icon from m_news where id = '$tipeProfile'";
$data = $kDef->exQ($sqlB);
if(mysql_num_rows($data)==1){
	if($baris = mysql_fetch_array($data,MYSQL_BOTH)){
		$listM['id'] = $baris['id'];
		$listM['description'] = $baris['description'];	
		$smarty->assign("icon","./images/".$baris['icon']);
		}else {
		$smarty->assign("pesan","This Category still empty");
	}
} 
if(isset($_GET['id'])){
//detail halaman tips
	$id = preg_replace("@[^0-9]@i","",$_GET['id']);
	$sql = "select judul,date_format(tanggal,'%D %M %y') as waktu,isi,gambar from tbl_news where id=$id and status=1";
	if($baris = mysql_fetch_array($kDef->exq($sql))){
		$smarty->assign("judul", $baris['judul']);
		$smarty->assign("tanggal", $baris['waktu']);
		$smarty->assign("isi", $baris['isi']);
		if($baris['gambar'] != ""){
			$smarty->assign("image",PATH_THUMB_NEWS."/".$baris['gambar']);
		}else {
			$smarty->assign("image",PATH_THUMB_NEWS."/noPict.jpg");
		}
	} else {
		$pesan = "ID not Matched";
	}
	$smarty->assign("tampil",false);
} else {
	// fetch data
	$x = 0;
	$kDef->sql = "select id,judul,date_format(tanggal,'%D %M %y') as waktu,substr(cuplikan,1,200) as isi,gambar from tbl_news where kategori='".$listM['id']."' and status=1 order by id Desc";
	$kDef->perPage = REC_PER_PAGE;
	$kDef->gul = 10;
	$smarty->assign('paging',$kDef->pageMe());
	$sql = $kDef->genSql();
	$result = $kDef->exQ($sql);
	if(@mysql_num_rows($result)>0){
		while($data = mysql_fetch_array ($result,MYSQL_ASSOC)){
			$listNews[$x]['id'] = $data['id'];
			$listNews[$x]['judul'] = $data['judul'];
			$listNews[$x]['tanggal'] = $data['waktu'];
			$listNews[$x]['isi'] = $data['isi'];
			if($data['gambar'] != ""){
				$listNews[$x]['image'] = PATH_THUMB_NEWS."/".$data['gambar'];
			}else {
				$listNews[$x]['image'] = PATH_THUMB_NEWS."/noPict.jpg";
			}
			$listNews[$x]['isi'] = $data['isi'];
		$x++;
		} 
	}else {
		$smarty->assign("pesan","Belum ada data");
	}
}
$smarty->assign('listNews',$listNews);
?>