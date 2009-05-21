<?
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

require_once(PATH_FUNGSI."/koneksi.php");

class userm extends koneksi{
	
	function level($param){
		$sql = "select id,level from m_level order by id asc";
		$row = $this->exQ($sql);
		$x = 0;
		while($data = mysql_fetch_array($row,MYSQL_BOTH)){
			if($data[0] == $param){
				$listLevel[$x]['id'] = $data['id'];
				$listLevel[$x]['level'] = $data['level'];
				$listLevel[$x]['select'] = "selected";
			} else {
				$listLevel[$x]['id'] = $data['id'];
				$listLevel[$x]['level'] = $data['level'];
			}
			$x++;
		}
		return $listLevel;		
	}

	function country(){
		$sql = "select id,negara from national order by id asc";
		$row = $this->exQ($sql);
		$x = 0;
		while($data = mysql_fetch_array($row,MYSQL_BOTH)){
			$listNegara[$x]['id'] = $data['id'];
			$listNegara[$x]['negara'] = $data['negara'];
			$x++;
		}
		return $listNegara;		
	}

	function pType($param){
		$sql = "select id,type,description from m_package order by id asc";
		$row = $this->exQ($sql);
		$x = 0;
		while($data = mysql_fetch_array($row,MYSQL_BOTH)){
			if($data[0] == $param){
				$listPackage[$x]['id'] = $data['id'];
				$listPackage[$x]['type'] = $data['type'];
				$listPackage[$x]['description'] = "description";
				$listPackage[$x]['select'] = "selected";
			} else {
				$listPackage[$x]['id'] = $data['id'];
				$listPackage[$x]['type'] = $data['type'];
				$listPackage[$x]['description'] = "description";
			}
			$x++;
		}
		return $listPackage;		
	}

	function gType($param){
		$sql = "select id,type,description from m_group order by id asc";
		$row = $this->exQ($sql);
		$x = 0;
		while($data = mysql_fetch_array($row,MYSQL_BOTH)){
			if($data[0] == $param){
				$listGroup[$x]['id'] = $data['id'];
				$listGroup[$x]['group'] = $data['type'];
				$listGroup[$x]['description'] = $data['description'];
				$listGroup[$x]['select'] = "selected";
			} else {
				$listGroup[$x]['id'] = $data['id'];
				$listGroup[$x]['group'] = $data['type'];
				$listGroup[$x]['description'] = $data['description'];
			}
			$x++;
		}
		return $listGroup;		
	}
	
	function showUsers(){
		$listUsers = array();
		$this->sql="select id,name,email,date_format(tglLahir,'%d %M %Y') as tglLahir,alamat,noRumah,noHp,ortu,gambar,if(status=1,'Aktif','Not Active') as status from tbl_membership where status=0 order by id asc $limit";
		$this->perPage = REC_PER_PAGE;
		$this->gul = 10;
		$sql = $this->genSql();
		$x = 0;
		$r = $this->exQ($sql);
		if($r){
			if(mysql_num_rows($r)>0){
				$pertama = false;
				while($data = mysql_fetch_array($r,MYSQL_ASSOC)){
					foreach($data as $k=>$i){
						$listUsers[$x][$k] = $i;	
						if($k == 'gambar'){
							if($i != ""){
								$listUsers[$x]['gambar'] = "/images/membership/".$i;
							} else {
								$listUsers[$x]['gambar'] = "/images/membership/noPict.gif";
							}
						}
					}
					$x++;
				}
			}else{
				return false;
			}
		}else{
			redirect(HOME."error.php?p=1");
		}
		return $listUsers;
	}
	
	function aktive(){
		//check user variabel
		$usn = strtolower(custom_strips($_POST['username'],"@[\\\'\"]@i"));
		$usnp = strtolower(custom_strips($_POST['usernamep'],"@[\\\'\"]@i"));
		if(preg_match("@[^0-9a-z_]@i",$usn) && preg_match("@[^0-9a-z_]@i",$usnp)){
			$this->pesan = "Username parent atau child hanya terdiri dari angka, huruf dan underscore [ _ ] !";
			return false;
		}elseif($this->cekUser($usn) && $this->cekUser($usnp)){
			$this->pesan = "Username parent atau child sudah ada. Silakan pilih username lain !";
			return false;		
		}else{
			$username = custom_strips($_POST['username'],"@[\\\'\"]@i");
			$usernamep = custom_strips($_POST['usernamep'],"@[\\\'\"]@i");
			$pwdc = custom_strips($_POST['pwdc'],"@[\\\'\"]@i");
			$pwdp = custom_strips($_POST['pwdc'],"@[\\\'\"]@i");
			$id = $_POST['idChild'];
			$tipeC = preg_replace("@[^0-9]@i","",$_POST['tipe_child']);
			$tipeP = preg_replace("@[^0-9]@i","",$_POST['tipe_parent']);
			$address = custom_strips($_POST['address'],"@[\\\'\"]@i");
			$cp = custom_strips($_POST['cp'],"@[\\\'\"]@i");
			//masukkan data user
			$sqlC = "insert into tbl_user(id_unik,user,password,user_tipe,status) values('$id',
					'$username','$pwdc','$tipeC',1)";
			$sqlP = "insert into tbl_user(id_unik,user,password,user_tipe,status) values('$id',
					'$usernamep','$pwdp','$tipeP',1)";				
				//insert datauser
				if($this->exQ($sqlC)){
					if($this->exQ($sqlP)){
						$this->pesan = "User parent berhasil dimasukkan";
					}
				return true;
				} else {
					$sqld = "delete from tbl_user where id_unik='$id' and user_tipe=2";
					$this->exQ($sqld);
				return false;
				}
		}
	}
	
	function maxId(){
		$sql = "select max(uid) where user_tipe=2";
		if($penanda = $this->exQ($sql)){
			$data = mysql_fetch_array($penanda);
			if($penanda = ""){
				$hasil = 0;
			} else {
				$hasil = $data['max(uid)'];
			}	
		$hasil = $hasil + 1;
		} 
	return $hasil;
	}
	
	function showData($id){
		$sql ="select id,name,email,date_format(tglLahir,'%Y-%m-%d') as tgl, tmpLahir, alamat, negara,
			  noRumah,noHp,hobby,ortu,noHportu,handicap,golfClub,recomendation,level,group_type,package 
			  from tbl_membership where id='$id'";
		$r = $this->exQ($sql);
		if($r){
			if(mysql_num_rows($r)>0){
				if($data = mysql_fetch_array($r,MYSQL_ASSOC)){
					foreach($data as $k=>$i){
						$listUsers[$k] = $i;
					}
					$x++;
				}
			}else{
				return false;
			}
		}else{
			redirect(HOME."error.php?p=1");
		}
		return $listUsers;
	}

	function showBest($id){		
		$sqlb ="select id,location,year from tbl_besttournament where id_member='$id' order by id Asc";
		$r = $this->exQ($sqlb);
		$x = 1;
		if($r){
			if(mysql_num_rows($r)>0){
				while($data = mysql_fetch_array($r,MYSQL_ASSOC)){
					$listBest[$x]['location'.$x] = $data['location'];
					$listBest[$x]['year'.$x] = $data['year'];
					$listBest[$x]['id'.$x] = $data['id'];
					$x++;
				}
			}else{
				return false;
			}
		}
		return $listBest;
	}

	function simpan(){
		$nama = custom_strips($_POST['nama'],"@[\\\'\"]@i");
		$email = custom_strips($_POST['email'],"@[\\\'\"]@i");
		$tglLahir =  $_POST['tglLahir'];
		$idUnik = custom_strips($_POST['idUnik'],"@[\\\'\"]@i");
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
		$level = custom_strips($_POST['level'],"@[\\\'\"]@i");
		$group = custom_strips($_POST['group'],"@[\\\'\"]@i");
		$package = custom_strips($_POST['package'],"@[\\\'\"]@i");
		
		$sql = "update tbl_membership set name='$nama',email='$email',tglLahir='$tglLahir',
				tmpLahir='$tmpLahir',alamat='$alamat',negara='$negara',noRumah='$noRumah',noHp='$noHp',hobby='$hobby',ortu='$ortu',
				nohportu='$noHportu',handicap='$handicap',golfclub='$golfClub',recomendation='$rec',level='$level',
				group_type='$group',package='$package' where id='$idUnik'";
		//echo $sql;
			if($this->exQ($sql)){
				for($x=0;$x<=5;$x++){
					if(($_POST['besT'.$x] || $_POST['year'.$x]) != ""){
						$year = custom_strips($_POST['year'.$x],"@[\\\'\"]@i");
						$best = custom_strips($_POST['best'.$x],"@[\\\'\"]@i");
						$idb = $_POST['idb'.$x];
						if($idb != ''){
							$sqlb = "update tbl_besttournament set location='$best',year='$year' where id='$idb'";
						} else {
							$sqlb = "insert into tbl_besttournament(id_member,location,year)values('$idUnik','$best','$year')";
						}
						//echo $sqlb;
						$this->exQ($sqlb);
					}
				}
				return true;
			} else {
				return false;
			}
	}

	function ubahPass($usn){
		$pwd = md5(custom_strips($_POST['pwd'],"@[\\\'\"]@i"));
		$sql = "update tbl_admin set pwd='$pwd' where usn='$usn'";
		#echo $sql;
		if($this->exQ($sql)){
			return true;
		}else{
			return false;
		}
	}

	function tambah(){
		//clear form
		$nama = custom_strips($_POST['nama'],"@[\\\'\"]@i");
		$email = custom_strips($_POST['email'],"@[\\\'\"]@i");
		//bikin idunique
		$tgl = preg_split('/-/',$_POST['tglLahir']);
		$tglnow = date("y");
		$tglLahir =  $_POST['tglLahir'];
		$unik = $this->genKode(3);
		if(!$_POST['idUnik']){
			$idUnik = strtoupper(substr($nama,0,1)).".".substr($tgl[2],2,2).$tgl[1].$tgl[0].".".$tglnow.".".$unik;
			} else {
			$idUnik = custom_strips($_POST['idUnik'],"@[\\\'\"]@i");
			}
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
		$level = custom_strips($_POST['level'],"@[\\\'\"]@i");
		$group = custom_strips($_POST['group'],"@[\\\'\"]@i");
		$package = custom_strips($_POST['package'],"@[\\\'\"]@i");
		
		$sql = "insert into tbl_membership (id,name,email,tglLahir,tmpLahir,alamat,negara,noRumah,noHp,hobby,
				ortu,noHportu,handicap,golfClub,recomendation,level,group_type,package,status) values('$idUnik','$nama','$email','$tglLahir','$tmpLahir',
				'$alamat','$negara','$noRumah','$noHp','$hobby','$ortu','$noHportu','$handicap','$golfClub','$rec','$level','$group','$package',0)";
			if($this->exQ($sql)){
				for($x=0;$x<=5;$x++){
					$y .= $x;
					echo $y;
					if(($_POST['besT'.$x] || $_POST['year'.$x]) != ""){
						$year = custom_strips($_POST['year'.$x],"@[\\\'\"]@i");
						$best = custom_strips($_POST['besT'.$x],"@[\\\'\"]@i");
						$sqlb = "insert into tbl_besttournament(id_member,location,year)values('$idUnik','$best','$year')";
						$this->exQ($sqlb);
					}
				}
				return true;
			} else {
				return false;
			}
	}

	function genKode($jmlKarakter){
		$arKunci = "1234567890";
		for($x=0;$x<$jmlKarakter;$x++){
			$rndom = rand(0,10);
			$code .= $arKunci[$rndom];
		}
		return $code;
	}

	function cekUser($usn){
		$sql = "select * from tbl_user where user='$usn'";
		if($r=$this->exQ($sql)){
			if(mysql_num_rows($r)>0){
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
	}

	function uploadFile($max,$nfile){
		if($_FILES['gambar']['size']>$max){
			$this->pesan = "Catatan : Gambar gagal diupload ! <br><u>File gambar tidak boleh lebih dari ".floor($max/1024)." Kb</u> !<br><br>";
			return false;
		}else{
			$uploaddir = FTP_PATH.'/images/membership';
			$tfile = basename($_FILES['gambar']['name']);
			$uploadfile = $uploaddir . $nfile . getext($tfile);
			$result_array = getimagesize($_FILES['gambar']['tmp_name']);
			if ($result_array !== false) {
				// nothing
			} else {
				$this->pesan = "Catatan : Gambar gagal diupload ! <br><u>File harus berbentuk gambar</u> !<br><br>";
				return false;
			}
			$file = $nfile . getext($tfile);
			$remote_file = $_FILES['gambar']['tmp_name'];
			
			// set up basic connection
			$conn_id = ftp_connect(FTP_HOME);
			
			// login with username and password
			$login_result = ftp_login($conn_id, ftp_user_name, ftp_user_pass);
			ftp_chdir($conn_id,$uploaddir);
			
			// upload a file
			$ftpRes = ftp_put($conn_id, $file, $remote_file, FTP_BINARY);
			if ($ftpRes){
				$this->thumbName = $nfile . getext($tfile);
				$this->pesan = "Gambar telah diupload !";
				return true;
			} else {
				$this->pesan = "<br><u><b>Catatan</b></u> : Gambar gagal diupload. Anda dapat mencoba meng-upload-nya kembali dengan memilih <i><b>edit</b></i> pada berita yang bersangkutan.";
				return false;
			}
		}
	}

	function delUsers(){
		#print_r($_POST);
		if(count($_POST['cUser'])>1){
			$gId = "";
			foreach($_POST['cUser'] as $k=>$i){
				$sqlb = "select id from tbl_besttournament where id_member='$i'";
				if($r = $this->exQ($sqlb)){
					if(mysql_num_rows($r)>0){
					$sqld = "delete from tbl_besttournament where id_member='$i'";
					$this->exQ($sqld);
					}
				}
				$id = $i;
				$gId .= "'".$id."',";
			}
			#echo strlen($gId)-1;
			$gId = substr($gId,0,strlen($gId)-1);
			$sql = "delete from tbl_membership where id in($gId)";
			
		}else{
			$id = $_POST['cUser'][0];
			$sql = "delete from tbl_membership where id='$id'";
			$sqlb = "select id from tbl_besttournament where id_member='$id'";
			if($r = $this->exQ($sqlb)){
				if(mysql_num_rows($r)>0){
				$sqld = "delete from tbl_besttournament where id_member='$id'";
				$this->exQ($sqld);
				}
			}
		}
		#echo $sql;
		if($this->exQ($sql)){
			return true;
		}else{
			return false;
		}
	}

}
?>