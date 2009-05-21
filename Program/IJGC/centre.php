<?
// fetch data
$kDef->konek();
//OtherNews
$sqlo = "select id,judul,date_format(tanggal,'%D %M %y') as waktu,substr(cuplikan,1,125) as isi,gambar from tbl_news where kategori=1 and status=1 order by id Desc limit 1";
	if($bariso = mysql_fetch_array($kDef->exq($sqlo))){
	$smarty->assign("oid",$bariso['id']);
	$smarty->assign("ojudul",$bariso['judul']);
	$smarty->assign("otanggal",$bariso['waktu']);
	$smarty->assign("oisi",$bariso['isi']);
	if($bariso['gambar']!=""){
		$smarty->assign("oimage",PATH_THUMB_NEWS."/".$bariso['gambar']);	
	} else {
		$smarty->assign("oimage",PATH_THUMB_NEWS."/noPict.jpg");	
	}
} else {
	$pesan = "Belum ada data";
}

//PlayerNews
$sqlp = "select id,judul,date_format(tanggal,'%D %M %y') as waktu,substr(cuplikan,1,125) as isi,gambar from tbl_news where kategori=2 and status=1 order by id Desc limit 1";
	if($barisp = mysql_fetch_array($kDef->exq($sqlp))){
		$smarty->assign("pid",$barisp['id']);
		$smarty->assign("pjudul",$barisp['judul']);
		$smarty->assign("ptanggal",$barisp['waktu']);
		$smarty->assign("pisi",$barisp['isi']);
		if($barisp['gambar']!=""){
			$smarty->assign("pimage",PATH_THUMB_NEWS."/".$barisp['gambar']);	
		} else {
			$smarty->assign("pimage",PATH_THUMB_NEWS."/noPict.jpg");	
		}
	} else {
		$pesan = "Belum ada data";
}
//assign variabel
$smarty->assign('pesan',$pesan);
?>