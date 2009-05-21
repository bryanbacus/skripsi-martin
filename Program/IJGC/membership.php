<?
//$kDef nsias new class koneksi
$kDef->konek();
if($_POST['submit'] == "submit"){
	//clear form
	$nama = custom_strips($_POST['nama'],"@[\\\'\"]@i");
	$email = custom_strips($_POST['email'],"@[\\\'\"]@i");
	//bikin idunique
	$tgl = preg_split('/-/',$_POST['tglLahir']);
	$tglnow = date("y");
	$tglLahir =  $_POST['tglLahir'];
	$unik = genKode(3);
	$idUnik = strtoupper(substr($nama,0,1)).".".substr($tgl[2],2,2).$tgl[1].$tgl[0].".".$tglnow.".".$unik; 
	$tmpLahir = custom_strips($_POST['tmpLahir'],"@[\\\'\"]@i");
	$alamat = custom_strips($_POST['alamat'],"@[\\\'\"]@i");
	$negara = custom_strips($_POST['negara'],"@[\\\'\"]@i");
	$noRumah = custom_strips($_POST['noRumah'],"@[\\\'\"]@i");
	$noHp = custom_strips($_POST['noHp'],"@[\\\'\"]@i");
	$hobby = custom_strips($_POST['hobby'],"@[\\\'\"]@i");
	$ortu = custom_strips($_POST['ortu'],"@[\\\'\"]@i");
	$noHportu = custom_strips($_POST['noHportu'],"@[\\\'\"]@i");	
	$handicap = custom_strips($_POST['handicap'],"@[\\\'\"]@i");
	$golfClub = custom_strips($_POST['golfClub'],"@[\\\'\"]@i");
	$rec = custom_strips($_POST['recomendation'],"@[\\\'\"]@i");
	if($rec != 1){
		$rec = 0;
	}
	$jenisGroup = custom_strips($_POST['jenisGroup'],"@[\\\'\"]@i");
	$package = custom_strips($_POST['package'],"@[\\\'\"]@i");
	
	$sql = "insert into tbl_membership (id,name,email,tglLahir,tmpLahir,alamat,negara,noRumah,noHp,hobby,
			ortu,noHportu,handicap,golfClub,recomendation,group_type,package,status) values('$idUnik','$nama','$email','$tglLahir','$tmpLahir',
			'$alamat','$negara','$noRumah','$noHp','$hobby','$ortu','$noHportu','$handicap','$golfClub','$rec','$jenisGroup','$package',0)";
		if($kDef->exQ($sql)){
			for($x=1;$x<=5;$x++){
				if(($_POST['besT'.$x] || $_POST['year'.$x]) != ""){
					$year = custom_strips($_POST['year'.$x],"@[\\\'\"]@i");
					$best = custom_strips($_POST['besT'.$x],"@[\\\'\"]@i");
					$sqlb = "insert into tbl_besttournament(id_member,location,year)values('$idUnik','$best','$year')";
					$kDef->exQ($sqlb);
				}
			}
			$smarty->assign("dShow",true);
			$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?page=member\'" />';
			$smarty->assign("pesan","Data berhasil dimasukkan".$meta);
		} else {
			$smarty->assign("pesan","Data gagal berhasil dimasukkan");
		}
}

// tanggal
if(!isset($_POST['tanggal'])){
	$smarty->assign("tanggal",date("Y-m-d"));
}

//negara
$sql = "select * from national order by negara Asc";
$row = $kDef->exQ($sql);
$x = 0;
while($data = mysql_fetch_array($row)){
	foreach($data as $k=>$value){
		$listNegara[$x][$k]=$value;
	}
$x++;
}
$smarty->assign("listNegara",$listNegara);

//jenis membership
$sql = "select * from m_group order by id Asc";
$row = $kDef->exQ($sql);
$x = 0;
while($data = mysql_fetch_array($row)){
	foreach($data as $k=>$value){
		$listMembership[$x][$k]=$value;
	}
$x++;
}
$smarty->assign("listMembership",$listMembership);

//jenis package
$sql = "select * from m_package order by id Asc";
$row = $kDef->exQ($sql);
$x = 0;
while($data = mysql_fetch_array($row)){
	foreach($data as $k=>$value){
		$listPackage[$x][$k]=$value;
	}
$x++;
}
$smarty->assign("listPackage",$listPackage);
?>