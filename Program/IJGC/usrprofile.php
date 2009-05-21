<?
include_once(PATH_FUNGSI.'/kelas.php');
$usr = new kelas;
//definisi variabel
$smarty->assign("jdlImages","./images/jdlPlayerMonth.gif");
$smarty->assign("tampil",true);

if(isset($_GET['id'])){
//detail halaman tips
	$id = custom_strips($_GET['id'],"@[\\\'\"]@i");
	$sql = "select id,name,date_format(tglLahir,'%D %M %y') as waktu,tmpLahir,alamat,negara,hobby,ortu,handicap,golfClub,group_type,gambar from tbl_membership where id='$id'";
	//echo $sql;
	if($baris = mysql_fetch_array($kDef->exq($sql))){
		foreach($baris as $k=>$value){
			$listDetail[$k] = $value;
			if($k == 'gambar'){
				if($value != ""){
					$listDetail['image'] = IMAGE_MEMBER.'/'.$value;
				}else {
					$listDetail['image'] = IMAGE_MEMBER.'/noPict.jpg';
				}
			}
		}
		$smarty->assign("listDetail", $listDetail);
		$negara = $usr->country($baris['negara']);
		$group = $usr->gType($baris['group_type']);
		$smarty->assign("negara", $negara);
		$smarty->assign("group", $group);
	} else {
		$pesan = "ID not Matched";
	}
	$smarty->assign("tampil",false);
} else {
	// fetch data
	$x = 0;
	$kDef->sql = "select distinct id_unik from tbl_user where status=1 order by id_unik Asc";
	$kDef->perPage = REC_PER_PAGE;
	$kDef->gul = 10;
	$smarty->assign('paging',$kDef->pageMe());
	$sql = $kDef->genSql();
	//echo $sql;
	$result = $kDef->exQ($sql);
	if(@mysql_num_rows($result)>0){
		while($data = mysql_fetch_array ($result,MYSQL_ASSOC)){
			//detail user
			$sqld = "select id,name,ortu,gambar,golfClub from tbl_membership where id='".$data['id_unik']."'";
			//echo "<br>".$sqld;
			if($hasil = $kDef->exQ($sqld)){
				$baris = mysql_fetch_array($hasil,MYSQL_ASSOC);
				$listUsr[$x]['id'] = $baris['id'];
				$listUsr[$x]['name'] = $baris['name'];
				$listUsr[$x]['ortu'] = $baris['ortu'];
				if($baris['gambar'] != ""){
					$listUsr[$x]['gambar'] = IMAGE_MEMBER."/".$baris['gambar'];
				}else {
					$listUsr[$x]['gambar'] = IMAGE_MEMBER."/noPict.jpg";
				}
 			} else {
				$pesan .= "This ID Member doesnt exist";
			}
		$x++;
		} 
	}else {
		$smarty->assign("pesan","Belum ada data");
	}
}
$smarty->assign('listUsr',$listUsr);
?>