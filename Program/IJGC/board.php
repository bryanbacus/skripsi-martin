<?php
//definisi variabel
if($_GET['tipeP']){
	$tipeProfile = preg_replace("@[^0-9]@i","",$_GET['tipeP']);
	$smarty->assign("tipe",$tipeProfile);
	if($tipeProfile == 1){
		$jdlImages = "./images/mProfile.gif";
	}else {
		$jdlImages = "./images/bProfile.gif";
	}
} else {
	$pesan = "You entered wrong page !";
}
$smarty->assign("jdlImages",$jdlImages);
$smarty->assign("tampil",true);
//data tipeBoardProfile
$sqlB = "select id,description from m_boardmanager where id = '$tipeProfile' and status = 1";
$data = $kDef->exQ($sqlB);
if(mysql_num_rows($data)==1){
	if($baris = mysql_fetch_array($data,MYSQL_BOTH)){
		$listM['id'] = $baris['id'];
		$listM['description'] = $baris['description'];	
		}else {
		$pesan = "This Category still empty";
	}
} 
if(isset($_GET['id'])){
	$id = preg_replace("@[^0-9]@i","",$_GET['id']);
	$sql = "select * from tbl_boardmanager where id=$id and status=1";
	if($baris = mysql_fetch_array($kDef->exq($sql))){
		$smarty->assign("name", $baris['name']);
		if($baris['photo'] != ""){
			$smarty->assign("image",PATH_PROFILE."/".$baris['photo']);
		}else {
			$smarty->assign("image",PATH_PROFILE."/noPict.jpg");
		}
		$smarty->assign("deskripsi",$baris['deskripsi']);
	} else {
		$pesan = "ID not Matched";
	}
	$smarty->assign("tampil",false);
} else {
	// fetch data
	$x = 0;
	$kDef->sql = "select *,substr(deskripsi,1,200) as deskrip from tbl_boardmanager where jabatan='".$listM['id']."' and status=1 order by id asc";
	$kDef->perPage = REC_PER_PAGE;
	$kDef->gul = 10;
	$smarty->assign('paging',$kDef->pageMe());
	$sql = $kDef->genSql();
	//echo $sql;
	$result = $kDef->exQ($sql);
	if(mysql_num_rows($result)>0){
		while($data = mysql_fetch_array ($result,MYSQL_ASSOC)){
			$listBoard[$x]['id'] = $data['id'];
			$listBoard[$x]['nama'] = $data['name'];
			if($data['photo'] != ""){
				$listBoard[$x]['image'] = PATH_PROFILE."/".$data['photo'];
			}else {
				$listBoard[$x]['image'] = PATH_PROFILE."/noPict.jpg";
			}
			$listBoard[$x]['deskripsi'] = $data['deskrip'];
		$x++;
		} 
	}else {
		$pesan .= "<br>Beluma ada data";
	}
}
$smarty->assign("pesan",$pesan);
$smarty->assign('listBoard',$listBoard);
?>