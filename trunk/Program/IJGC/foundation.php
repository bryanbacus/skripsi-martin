<?
//definisi variabel
$smarty->assign("icon","./images/listFound.gif");
$smarty->assign("tampil",true);

$sqlB = "select id,description from m_foundation order by id Asc";
$data = $kDef->exQ($sqlB);
	if(mysql_num_rows($data)>0){
		$x=0;
		while($baris = mysql_fetch_array($data,MYSQL_BOTH)){
			$listM[$x]['id'] = $baris['id'];
			$listM[$x]['description'] = $baris['description'];	
		$x++;
		}
	} else {
		$smarty->assign("pesan","This Category still empty");
	}
//data Fopundation
function checkType($list,$param){
	foreach($list as $k=>$value){
		if($k==$param){
			$kategori=$list[$k]['description'];
		}
	}
	return $kategori;
}
if(isset($_GET['id'])){
//detail halaman tips
	$id = preg_replace("@[^0-9]@i","",$_GET['id']);
	$sql = "select gambar,substr(deskripsi,1,200) as isi,link,kategori from tbl_foundation where id=$id and status=1";
	if($baris = mysql_fetch_array($kDef->exq($sql))){
		$kategori = checkType($listM,$baris['kategori']-1);
		$smarty->assign("kategori",$kategori);
		$smarty->assign("link", $baris['link']);
		$smarty->assign("isi",$baris['isi']);
		if($baris['gambar'] != ""){
			$smarty->assign("image",PATH_FOUNDATION."/".$baris['gambar']);
		}else {
			$smarty->assign("image",PATH_FOUNDATION."/noPict.jpg");
		}
	} else {
		$pesan = "ID not Matched";
	}
	$smarty->assign("tampil",false);
} else {
	// fetch data
	$x = 0;
	$kDef->sql = "select id,gambar,substr(deskripsi,1,200) as isi,link,kategori from tbl_foundation where status=1 order by kategori Desc";
	$kDef->perPage = REC_PER_PAGE;
	$kDef->gul = 10;
	$smarty->assign('paging',$kDef->pageMe());
	$sql = $kDef->genSql();
	//echo $sql;
	$result = $kDef->exQ($sql);
	if(@mysql_num_rows($result)>0){
		while($data = mysql_fetch_array ($result,MYSQL_ASSOC)){
			$listFoundation[$x]['id'] = $data['id'];
			$listFoundation[$x]['link'] = $data['link'];
			$listFoundation[$x]['isi'] = $data['isi'];
			$kategori = checkType($listM,$data['kategori']-1);
			if($data['kategori']){
				$listFoundation[$x]['kategori'] = $kategori;
				} else {
				$listFoundation[$x]['kategori'] = "not Categorized";
			}
			if($data['gambar'] != ""){
				$listFoundation[$x]['image'] = PATH_FOUNDATION."/".$data['gambar'];
				}else {
				$listFoundation[$x]['image'] = PATH_FOUNDATION."/noPict.jpg";
			}
		$x++;
		} 
	}else {
		$smarty->assign("pesan","Belum ada data");
	}
}
$smarty->assign('listFoundation',$listFoundation);
?>