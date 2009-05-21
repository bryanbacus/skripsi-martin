<?
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

require_once(PATH_FUNGSI."/koneksi.php");

class boardManager extends koneksi{
	
	var $pesan = "";
	var $thumbName = "";
	var $boardTipe = "";
	
	function tipeBoard($compare){
		$this->sql="select * from m_boardmanager where status=1 order by id Asc";
		$baris=$this->exQ($this->sql);
		while($data=mysql_fetch_array($baris,MYSQL_BOTH)){
			if($data['0']==$compare){
				$boardTipe = $data['1'];
			}
		}
	return $boardTipe;
	}

	function tipeBoards(){
		$this->sql="select * from m_boardmanager where status=1 order by id Asc";
		$baris=$this->exQ($this->sql);
		$i = 0;
		while($data=mysql_fetch_array($baris,MYSQL_BOTH)){
				$boardTipe[$i]['id'] = $data['0'];
				$boardTipe[$i]['description'] = $data['1'];
			$i++;
		}
	return $boardTipe;
	}

	function add_profile(){
		if(isset($_POST['simpan'])){
			if($_POST['simpan']){
				if(!detectBlank($_POST)){
					$nama = eraseStrange($_POST['nama']);
					$title = preg_replace("@[^0-9]@i","",$_POST['title']);
					$narasi = eraseStrange($_POST['narasi']);
					$status = preg_replace("@[^0-9]@i","",$_POST['status']);
					if($status=="")	$status = "0";
					// cari urutan
					$urut = $this->getUrutan();
					$sql = "insert into tbl_boardmanager(name,jabatan,deskripsi,status,urut) values('$nama','$title','$narasi','$status','$urut')";
					//echo $sql;
					if($this->exQ($sql)){
						$this->pesan = "Profile telah ditambahkan !";
						return true;
					}else{
						#echo mysql_error();
						redirect("../error.php?p=1");
						die();
					}
				}else{
					$this->pesan = "Isilah semua field yang disediakan !";
					return false;
				}
			}
		}
	}
	
	function edit_profile($id){
		if(isset($_POST['simpan'])){
			if($_POST['simpan']){
				if(!detectBlank($_POST)){
					$nama = eraseStrange($_POST['nama']);
					$title = eraseStrange($_POST['title']);
					$narasi = eraseStrange($_POST['narasi']);
					$status = preg_replace("@[^0-9]@i","",$_POST['status']);
					$id = preg_replace("@[^0-9]@i","",$_POST['id']);
					if($status=="")	$status = "0";
					$sql = "update tbl_boardmanager set name='$nama',jabatan='$title',deskripsi='$narasi',status='$status'
							where id=$id";
					//echo $sql;
					//echo $_POST['id']."ini idi";
					if($this->exQ($sql)){
						$this->pesan = "Profile telah ditambahkan !";
						return true;
					}else{
						//echo mysql_error();
						redirect("../error.php?p=1");
						die();
					}
				}else{
					$this->pesan = "Isilah semua field yang disediakan !";
					return false;
				}
			}
		}
	}

	function uploadFile($max,$nfile){
		if($_FILES['gambar']['size']>$max){
			$this->pesan = "Catatan : Gambar gagal diupload ! <br><u>File gambar tidak boleh lebih dari ".floor($max/1024)." Kb</u> !<br><br>";
			return false;
		}else{
			$uploaddir = FTP_PATH.'/images/profile';
			$tfile = basename($_FILES['gambar']['name']);
			#echo basename($_FILES['gambar']['name']);
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
			$conn_id = ftp_connect("10.1.10.20");
			
			// login with username and password
			$login_result = ftp_login($conn_id, ftp_user_name, ftp_user_pass);
			ftp_chdir($conn_id,$uploaddir);
			
			// upload a file
			$ftpRes = ftp_put($conn_id, $file, $remote_file, FTP_BINARY);
			if ($ftpRes) {
				//$this->copyfile($file);
				$this->thumbName = $nfile . getext($tfile);
				$this->pesan = "Gambar telah diupload !";
				return true;
			} else {
				$this->pesan = "<br><u><b>Catatan</b></u> : Gambar gagal diupload. Anda dapat mencoba meng-upload-nya kembali dengan memilih <i><b>edit</b></i> pada profile yang bersangkutan.";
				return false;
			}

			// close the connection
			ftp_close($conn_id);
/*
			if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile)) {
				$this->thumbName = $nfile . getext($tfile);
				$this->pesan = "Gambar telah diupload !";
				return true;
			} else {
				$this->pesan = "<br><u><b>Catatan</b></u> : Gambar gagal diupload. Anda dapat mencoba meng-upload-nya kembali dengan memilih <i><b>edit</b></i> pada profile yang bersangkutan.";
				return false;
			}
*/
		}
	}

	function up($urut,$kat){
		$sql = "select id, urut from tbl_boardmanager where urut<=$urut order by urut desc limit 0,2";
		#echo $sql;
		if($r=$this->exQ($sql)){
			$urut = array();
			$id = array();
			while($data=mysql_fetch_array($r,MYSQL_ASSOC)){
				$urut[] = $data['urut'];
				$id[] = $data['id'];
			}
			$sql = "update tbl_board_manager set urut=$urut[0] where id=$id[1]";
			#echo $sql;
			$this->exQ($sql);
			$sql = "update tbl_boardmanager set urut=$urut[1] where id=$id[0]";
			#echo $sql;
			$this->exQ($sql);
			return true;
		}else{
			redirect(HOME."error.php?p=1");
		}
		return false;
	}

	function down($urut,$kat){
		$sql = "select id, urut from tbl_boardmanager where urut>=$urut order by urut asc limit 0,2";
		#echo $sql;
		if($r=$this->exQ($sql)){
			$urut = array();
			$id = array();
			while($data=mysql_fetch_array($r,MYSQL_ASSOC)){
				$urut[] = $data['urut'];
				$id[] = $data['id'];
			}
			$sql = "update tbl_boardmanager set urut=$urut[0] where id=$id[1]";
			#echo $sql;
			$this->exQ($sql);
			$sql = "update tbl_boardmanager set urut=$urut[1] where id=$id[0]";
			#echo $sql;
			$this->exQ($sql);
			return true;
		}else{
			redirect(HOME."error.php?p=1");
		}
		return false;
	}

	function getUrutan(){
		$sql = "select max(urut) as urutan from tbl_boardmanager";
		if($r=$this->exQ($sql)){
			if($data=mysql_fetch_array($r,MYSQL_ASSOC)){
				if($data['urutan']){
					return $data['urutan']+1;
				}else{
					return 1;
				}
			}else{
				return 1;
			}
		}else{
				redirect(HOME."error.php?p=1");
		}
	}
}
?>