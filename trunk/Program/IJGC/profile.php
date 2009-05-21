<?
include_once(PATH_FUNGSI.'/kelas.php');
$usr = new kelas;
//definisi variabel
$smarty->assign("jdlImages","./images/jdlPlayerMonth.gif");
$smarty->assign("tampil",true);
$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?page=profile\'" />';

// fetch data
if(isset($_SESSION['userId'])){	
	//simpan data
	if(isset($_POST['submit'])){
		// save edited value
		$failed = true;
		if($_POST['submit']){
			if($failed){
				if($usr->simpan()){
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
					$smarty->assign('pesan',"Data updated, wait pproval for your parent".$usr->pesan.$meta);
					$smarty->assign('dshowMe',true);
				}else{
					$smarty->assign('pesan',"Failed to edit Membersip !".$usr->pesan.$meta);
				}
			}
		}
	}

	//pilih aksi
	if(isset($_POST['edit'])){
		$edit = true;
		$smarty->assign("edit","true");
	}
	
	$idUnik = strips($_SESSION['userId']);
	$sql = "select id,name,email,date_format(tglLahir,'%Y-%m-%d') as tglLahir,date_format(tglLahir,'%D %M %y') as waktu,
			tmpLahir,alamat,negara,noRumah,noHp,hobby,ortu,noHportu,handicap,golfClub,gambar,if(recomendation=1,'checked','') as rec,
			if(recomendation=1,'Yes','No') as recomen,level,group_type,package,reward_earned,
			ranking_point,trial_point,editProfile from tbl_membership where id='$idUnik'"; 
	$result = $usr->exQ($sql);
	if(@mysql_num_rows($result)>0){
		$data = mysql_fetch_array($result,MYSQL_ASSOC);
		foreach($data as $k=>$value){
			$listProfile[$k] = $value;
			if($k == 'gambar'){
				if($value != ""){
					$listProfile['gambar'] = IMAGE_MEMBER."/".$data['gambar'];
				}else {
					$listProfile['gambar'] = IMAGE_MEMBER."/noPict.jpg";
				}
			}
			if($k == 'negara'){
				if($edit){
					$negara = $usr->listCountry($value);
					$smarty->assign("negara",$negara);
				} else {
					$listProfile['negara'] = $usr->country($value);
				}
			}
			if($k == 'level'){
				$listProfile['level'] = $usr->viewlevel($value);
			}
			if($k == 'group_type'){
				if($edit){
					$group = $usr->listgType($value);
					$smarty->assign("group",$group);
				}else {
					$listProfile['group'] = $usr->gType($value);
				}
			}
			if($k == 'package'){
				if($edit){
					$package = $usr->pType($value);
					$smarty->assign("package",$package);
				}else {
					$listProfile['package'] = $usr->viewpType($value);
				}
			}
		
		}
	//data best tournament
	$sqlb = "select id,location,year from tbl_besttournament where id_member='$idUnik' order by id Asc";
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
}
$template = "profile.tpl";
?>