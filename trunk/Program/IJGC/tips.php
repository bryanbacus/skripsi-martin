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
$sqlB = "select id,description,icon from m_tips where id = '$tipeProfile'";
$data = $kDef->exQ($sqlB);
if(mysql_num_rows($data)==1){
	if($baris = mysql_fetch_array($data,MYSQL_BOTH)){
		$listM['id'] = $baris['id'];
		$listM['description'] = $baris['description'];	
		$smarty->assign("icon",$baris['icon']);
		}else {
		$smarty->assign("pesan","This Category still empty");
	}
} 
if(isset($_GET['id'])){
//detail halaman tips
	$id = preg_replace("@[^0-9]@i","",$_GET['id']);
	$sql = "select photo,content,link from tbl_tips where id=$id and status=1";
	if($baris = mysql_fetch_array($kDef->exq($sql))){
		$smarty->assign("link", $baris['link']);
		if($baris['photo'] != ""){
			$smarty->assign("image",IMAGE_TIPS_PATH."/".$baris['photo']);
		}else {
			$smarty->assign("image",IMAGE_TIPS_PATH."/noPict.jpg");
		}
		$smarty->assign("isi",$baris['content']);
	} else {
		$pesan = "ID not Matched";
	}
	$smarty->assign("tampil",false);
	//$smarty->assign("listData",$listData);
} else {
	// fetch data
	$x = 0;
	$kDef->sql = "select id,photo,link,substr(content,1,200) as isi from tbl_tips where kategori='".$listM['id']."' and status=1 order by id Desc";
	$kDef->perPage = REC_PER_PAGE;
	$kDef->gul = 10;
	$smarty->assign('paging',$kDef->pageMe());
	$sql = $kDef->genSql();
	//echo $sql;
	$result = $kDef->exQ($sql);
	if(@mysql_num_rows($result)>0){
		while($data = mysql_fetch_array ($result,MYSQL_ASSOC)){
			$listTips[$x]['id'] = $data['id'];
			$listTips[$x]['link'] = $data['link'];
			if($data['photo'] != ""){
				$listTips[$x]['image'] = IMAGE_TIPS_PATH."/".$data['photo'];
			}else {
				$listTips[$x]['image'] = IMAGE_TIPS_PATH."/noPict.jpg";
			}
			$listTips[$x]['isi'] = $data['isi'];
		$x++;
		} 
	}else {
		$smarty->assign("pesan","Belum ada data");
	}
}
$smarty->assign('listTips',$listTips);
?>