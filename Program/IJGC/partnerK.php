<?
//definisi variabel
if($_GET['tipeP']){
	$tipeProfile = preg_replace("@[^0-9]@i","",$_GET['tipeP']);
	$smarty->assign("tipe",$tipeProfile);
} else {
	$smarty->assign("pesan","You entered wrong page !");
}
$smarty->assign("tampil",true);

//data tipeBoardProfile
$sqlB = "select id,description,icon from m_partner where id = '$tipeProfile'";
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
	$sql = "select name,description,logo,link from tbl_partner where id=$id and status=1";
	if($baris = mysql_fetch_array($kDef->exq($sql))){
		$smarty->assign("link", $baris['link']);
		$smarty->assign("name", $baris['name']);
		if($baris['logo'] != ""){
			$smarty->assign("image",IMAGE_PARTNER."/".$baris['logo']);
		}else {
			$smarty->assign("image",IMAGE_PARTNER."/noPict.jpg");
		}
		$smarty->assign("isi",$baris['description']);
	} else {
		$pesan = "ID not Matched";
	}
	$smarty->assign("tampil",false);
} else {
	// fetch data
	$x = 0;
	$kDef->sql = "select id,name,logo,link,substr(description,1,200) as isi from tbl_partner where type_partner='".$listM['id']."' and status=1 order by id Desc";
	$kDef->perPage = REC_PER_PAGE;
	$kDef->gul = 10;
	$smarty->assign('paging',$kDef->pageMe());
	$sql = $kDef->genSql();
	$result = $kDef->exQ($sql);
	if(@mysql_num_rows($result)>0){
		while($data = mysql_fetch_array ($result,MYSQL_ASSOC)){
			$listPartner[$x]['id'] = $data['id'];
			$listPartner[$x]['link'] = $data['link'];
			$listPartner[$x]['name'] = $data['name'];
			if($data['logo'] != ""){
				$listPartner[$x]['image'] = IMAGE_PARTNER."/".$data['logo'];
			}else {
				$listPartner[$x]['image'] = IMAGE_PARTNER."/noPict.jpg";
			}
			$listPartner[$x]['isi'] = $data['isi'];
		$x++;
		} 
	}else {
		$smarty->assign("pesan","Belum ada data");
	}
}
$smarty->assign('listPartner',$listPartner);
?>