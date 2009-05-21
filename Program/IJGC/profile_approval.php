<?
include_once(PATH_FUNGSI.'/kelas.php');
$usr = new kelas;
//definisi variabel
$smarty->assign("jdlImages","./images/jdlPlayerMonth.gif");
$smarty->assign("tampil",true);
$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?page=profile\'" />';
$balik = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?page=approval\'" />';
$idUnik = strips($_SESSION['userId']);
$aksi = @preg_replace("@[^0-9a-z]@i","",$_POST['aksi']);

switch($aksi){
	case "Edit":
		$failed = true;
			if($failed){
				if($usr->edit()){
					$id = $_SESSION['userId'];
					$idGambar = @preg_replace("@[^0-9a-z_]@i","",$_SESSION['userId']);
					if($_FILES['gambar']['size']>0){
						if(!$usr->uploadFile(100000,$idGambar)){
							$meta = $usr->pesan;
							$smarty->assign('kembali',true);
						}else{
							$sqli = "update tbl_membership_temp set gambar='$usr->thumbName' where id=$id";
							#echo $sql;
							$usr->exQ($sqli);
						}
					}
					$smarty->assign('pesan',"Data updated !".$usr->pesan.$balik);
					$smarty->assign('dshowMe',true);
				}else{
					$smarty->assign('pesan',"Failed to edit Profile !".$usr->pesan.$meta);
				}
			}
	break;
	case "Approve":
	
	break;
	case "Reject":
	break;
	
}

//fetch data temporary
	$sql = "select id,name,email,date_format(tglLahir,'%Y-%m-%d') as tglLahir,date_format(tglLahir,'%D %M %y') as waktu,
			tmpLahir,alamat,negara,noRumah,noHp,hobby,ortu,noHportu,handicap,golfClub,gambar,if(recomendation=1,'checked','') as rec,
			if(recomendation=1,'Yes','No') as recomen,group_type,package from tbl_membership_temp where id='$idUnik'";
	//echo $sql;
	$result = $usr->exQ($sql);
	if(@mysql_num_rows($result)>0){
		$data = mysql_fetch_array($result,MYSQL_ASSOC);
		foreach($data as $k=>$value){
			$listProfile[$k] = $value;
			if($k == 'gambar'){
				if($value != ""){
					$listProfile['gambar'] = "./images/membership_temp/".$data['gambar'];
				}else {
					$listProfile['gambar'] = "./images/membership_temp/noPict.jpg";
				}
			}
			if($k == 'negara'){
				$negara = $usr->listCountry($value);
				$smarty->assign("negara",$negara);
			}
			if($k == 'group_type'){
				$group = $usr->listgType($value);
				$smarty->assign("group",$group);
			}
			if($k == 'package'){
				$package = $usr->pType($value);
				$smarty->assign("package",$package);
			}
		
		}
	//data best tournament
	$sqlb = "select id,location,year from tbl_besttournament_temp where id_member='$idUnik' order by id Asc";
	//echo $sqlb;
	$hasil = $usr->exQ($sqlb);
	$x = 0;
	while($baris = mysql_fetch_array($hasil)){
		$listBest[$x]['id'] = $baris['id'];
		$listBest[$x]['best'] = $baris['location'];
		$listBest[$x]['year'] = $baris['year'];
		$listBest[$x]['no'] = $x + 1;
		$x++;
	}
	}else{
		$smarty->assign("pesan","Belum ada data");
	}
	$smarty->assign('listProfile',$listProfile);
	$smarty->assign('listBest',$listBest);

$template = "profile_approval.tpl";

?>