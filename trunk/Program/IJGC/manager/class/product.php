<?
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

require_once(PATH_FUNGSI."/koneksi.php");

class product extends koneksi{
	var $pesan = "";
	var $thumbName = "";
	
	function Kategori($kategori){
		$sql = "select id,description from m_products order by id asc";
		$row = $this->exQ($sql);
		while($data = mysql_fetch_array($row,MYSQL_BOTH)){
			if ($data[0] == $kategori){
				$listKategori['id'] = $data['id'];
				$listKategori['description'] = $data['description'];
			}
		}
		return $listKategori;		
	}

	function drawKategori($parameter){
		$sql = "select id,description from m_products order by id asc";
		$row = $this->exQ($sql);
		$x = 0;
		while($data = mysql_fetch_array($row,MYSQL_BOTH)){
			if ($data['id'] == $parameter){
				$optionKategori .= "<option value='".$data['id']."' selected>".$data['description']."</option>";
			} else {
				$optionKategori .= "<option value='".$data['id']."'>".$data['description']."</option>";
			}
			$x++;
		}
		return $optionKategori;		
	}
	
	function add_news(){
		if(isset($_POST['simpan'])){
			if($_POST['simpan']){
				if(!detectBlank($_POST)){
					$kategori = eraseStrange($_POST['kategori']);
					$link = eraseStrange($_POST['link']);
					$content = eraseStrange($_POST['content']);
					$status = preg_replace("@[^0-9]@i","",$_POST['status']);
					if($status=="")	$status = "0";
					$sql = "insert into tbl_products(information,link,type,status)
							values('$content','$link','$kategori','$status')";
					#echo $sql;
					if($this->exQ($sql)){
						$this->pesan = "Products telah ditambahkan !";
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
		return false;
	}

	function edit_news($id){
		if(isset($_POST['simpan'])){
			if($_POST['simpan']){
				if(!detectBlank($_POST)){
					$kategori = eraseStrange($_POST['kategori']);
					$link = eraseStrange($_POST['link']);
					$content = eraseStrange($_POST['content']);
					$status = preg_replace("@[^0-9]@i","",$_POST['status']);
					if($status=="")	$status = "0";
					$sql = "update tbl_products set information='$content',link='$link',type='$kategori',
					status='$status' where id=$id";
					#echo $sql;
					if($this->exQ($sql)){
						$this->pesan = "Products telah diedit !";
						return true;
					}else{
						echo mysql_error();
						#redirect("../error.php?p=1");
						die();
					}
				}else{
					$this->pesan = "Isilah semua field yang disediakan !";
					return false;
				}
			}
		}
		return false;
	}

	function uploadFile($max,$nfile){
		if($_FILES['gambar']['size']>$max){
			$this->pesan = "Catatan : Gambar gagal diupload ! <br><u>File gambar tidak boleh lebih dari ".floor($max/1024)." Kb</u> !<br><br>";
			return false;
		}else{
			$uploaddir = FTP_PATH.'/images/product';
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
}
?>