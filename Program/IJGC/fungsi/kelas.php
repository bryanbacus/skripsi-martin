<?
if(file_exists(PATH_FUNGSI.'/koneksi.php')){
	require_once(PATH_FUNGSI.'/koneksi.php');
}else{
	die("File koneksi not Found !");
}

class kelas extends koneksi{
	
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

	function viewlevel($param){
		$sql = "select id,level from m_level where id='$param' order by id asc";
		$row = $this->exQ($sql);
		$x = 0;
		while($data = mysql_fetch_array($row,MYSQL_BOTH)){
			if($data[0] == $param){
				$listLevel = $data['level'];
			} else {
				$listLevel = "Unlevel";
			}
			$x++;
		}
		return $listLevel;		
	}

	function listCountry($param){
		$sql = "select id,negara from national order by id asc";
		$row = $this->exQ($sql);
		$x = 0;
		while($data = mysql_fetch_array($row,MYSQL_BOTH)){
			if($data[0] == $param){
				$listNegara[$x]['id'] = $data['id'];
				$listNegara[$x]['negar'] = $data['negara'];
				$listNegara[$x]['select'] = "selected";
			} else {
				$listNegara[$x]['id'] = $data['id'];
				$listNegara[$x]['negar'] = $data['negara'];
			}
		$x++;
		}
		return $listNegara;		
	}

	function country($param){
		$sql = "select id,negara from national order by id asc";
		$row = $this->exQ($sql);
		$x = 0;
		while($data = mysql_fetch_array($row,MYSQL_BOTH)){
			if($data[0] == $param){
				$listNegara = $data['negara'];
			}
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

	function viewpType($param){
		$sql = "select id,type,description from m_package where id='$param' order by id asc";
		$row = $this->exQ($sql);
		$x = 0;
		while($data = mysql_fetch_array($row,MYSQL_BOTH)){
			if($data[0] == $param){
				$listPackage = $data['description'];
			} else {
				$listPackage = "Unpackage";
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
				$listGroup = $data['description'];
			}
			$x++;
		}
		return $listGroup;		
	}
	function listgType($param){
		$sql = "select id,type,description from m_group order by id asc";
		$row = $this->exQ($sql);
		$x = 0;
		while($data = mysql_fetch_array($row,MYSQL_BOTH)){
			if($data[0] == $param){
				$listGroup[$x]['id'] = $data['id'];
				$listGroup[$x]['type'] = $data['type'];
				$listGroup[$x]['description'] = $data['description'];
				$listGroup[$x]['select'] = "selected";
			}else {
				$listGroup[$x]['id'] = $data['id'];
				$listGroup[$x]['type'] = $data['type'];
				$listGroup[$x]['description'] = $data['description'];
			}
			$x++;
		}
		return $listGroup;		
	}

	function simpan(){
		//data membership
		$nama = custom_strips($_POST['nama'],"@[\\\'\"]@i");
		$email = custom_strips($_POST['email'],"@[\\\'\"]@i");
		$tglLahir =  $_POST['tglLahir'];
		$idUnik = custom_strips($_SESSION['userId'],"@[\\\'\"]@i");
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
		$group = custom_strips($_POST['group'],"@[\\\'\"]@i");
		$package = custom_strips($_POST['package'],"@[\\\'\"]@i");
		
		$sql = "insert into tbl_membership_temp(id,name,email,tglLahir,tmpLahir,alamat,negara,noRumah,noHp,hobby,ortu,
				noHportu,handicap,golfClub,recomendation,group_type,package)values('$idUnik','$nama','$email','$tglLahir','$tmpLahir',
				'$alamat','$negara','$noRumah','$noHp','$hobby','$ortu','$noHportu','$handicap','$golfClub','$rec','$group','$package')";
				//echo $sql;
			if($this->exQ($sql)){
				//rubah flag
				$sqlu = "update tbl_membership set editProfile=1 where id='$idUnik'";
				if($this->exQ($sqlu)){
					//masukkan data table temporary
					for($x=1;$x<=5;$x++){
						if(($_POST['best'.$x] || $_POST['year'.$x]) != ""){
							$year = custom_strips($_POST['year'.$x],"@[\\\'\"]@i");
							$best = custom_strips($_POST['best'.$x],"@[\\\'\"]@i");
							$idb = $_POST['idb'.$x];
							$sqlb = "insert into tbl_besttournament_temp(id,id_member,location,year)values('$idb','$idUnik','$best','$year')";
							if($this->exQ($sqlb)){
								$this->pesan .= "<br>Data temporary best tournament ke".$x." berhasil dimasukkan<br>";
							} else {
								$this->pesan .= "<br>Data temporary best tournament ke".$x." tidak berhasil dimasukkan<br>";
							}
						}
					}
				}
				return true;
			} else {
				return false;
			}
	}

	function edit(){
		//data membership
		$nama = custom_strips($_POST['nama'],"@[\\\'\"]@i");
		$email = custom_strips($_POST['email'],"@[\\\'\"]@i");
		$tglLahir =  $_POST['tglLahir'];
		$idUnik = custom_strips($_SESSION['userId'],"@[\\\'\"]@i");
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
		$group = custom_strips($_POST['group'],"@[\\\'\"]@i");
		$package = custom_strips($_POST['package'],"@[\\\'\"]@i");
		
		$sql = "update tbl_membership_temp set name='$nama',email='$email',tglLahir='$tglLahir',tmpLahir='$tmpLahir',alamat='$alamat',
				negara='$negara',noRumah='$noRumah',noHp='$noHp',hobby='$hobby',ortu='$ortu',noHportu='$noHportu',handicap='$handicap',
				golfClub='$golfClub',recomendation='$rec',group_type='$group',package='$package'";
				//echo $sql;
			if($this->exQ($sql)){
					//masukkan data table temporary
					for($x=1;$x<=5;$x++){
						if(($_POST['best'.$x] || $_POST['year'.$x]) != ""){
							$year = custom_strips($_POST['year'.$x],"@[\\\'\"]@i");
							$best = custom_strips($_POST['best'.$x],"@[\\\'\"]@i");
							$idb = $_POST['idb'.$x];
							if($idb == ""){
								$sqlb = "insert into tbl_besttournament_temp(id,id_member,location,year)values('$idb','$idUnik','$best','$year')";
							} else {
								$sqlb = "update tbl_besttournament_temp set location='$best',year='$year' where id=$idb";
							}
							if($this->exQ($sqlb)){
								$this->pesan .= "<br>Data temporary best tournament ke".$x." berhasil dimasukkan<br>";
							} else {
								$this->pesan .= "<br>Data temporary best tournament ke".$x." tidak berhasil dimasukkan<br>";
							}
						}
					}
				return true;
			} else {
				return false;
			}
	}

	function uploadFile($max,$nfile){
		if($_FILES['gambar']['size']>$max){
			$this->pesan = "Catatan : Gambar gagal diupload ! <br><u>File gambar tidak boleh lebih dari ".floor($max/1024)." Kb</u> !<br><br>";
			return false;
		}else{
			$uploaddir = FTP_PATH.'/images/membership_temp';
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
				$this->pesan = "<br><u><b>Catatan</b></u> : Gambar gagal diupload. Anda dapat mencoba meng-upload-nya kembali dengan memilih <i><b>edit</b></i> pada profile yang bersangkutan.";
				return false;
			}
		}
	}

}