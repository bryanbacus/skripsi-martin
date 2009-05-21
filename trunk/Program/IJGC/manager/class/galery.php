<?
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

require_once(PATH_FUNGSI."/koneksi.php");

class galery extends koneksi{
	
	var $pesan = "";
	var $upFiles = false;
	var $idUploaded = array();

	function add_gal(){
		if(isset($_POST['simpan'])){
			if($_POST['simpan']){
				if(!detectBlank($_POST)){
					$album = eraseStrange($_POST['album']);
					$tanggal = eraseStrange($_POST['tanggal']);
					if(!preg_match("@[0-9]{2}\-[0-9]{2}\-[0-9]{4}@i",$tanggal,$tgl)){
						$this->pesan = "Format tanggal tidak valid !";
						return false;
					}
					$tgl = explode("-",$tanggal);
					$tanggal = "$tgl[2]-$tgl[0]-$tgl[1]";
					$deskripsi = eraseStrange($_POST['deskripsi']);
					$status = preg_replace("@[^0-9]@i","",$_POST['status']);
					if($status=="")	$status = "0";
					$sql = "insert into album(album, tanggal, deskripsi, status)
							values('$album','$tanggal','$deskripsi','$status')";
					#echo $sql;
					if($this->exQ($sql)){
						$id = $this->getMax("album");
						$this->id_album = $id;
						if($this->bikinDir("/images/galery",$id)){
							$this->pesan = "Album telah ditambahkan !";
							return true;
						}else{
							$this->exQ("delete from album where id=$id");
							$this->pesan = "Album gagal dibuat ! Cobalah beberapa saat lagi.";
							return false;
						}
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

	function edit_gal($id){
		if(!detectBlank($_POST)){
			$album = eraseStrange($_POST['album']);
			$tanggal = eraseStrange($_POST['tanggal']);
			if(!preg_match("@[0-9]{2}\-[0-9]{2}\-[0-9]{4}@i",$tanggal,$tgl)){
				$this->pesan = "Format tanggal tidak valid !";
				return false;
			}
			$tgl = explode("-",$tanggal);
			$tanggal = "$tgl[2]-$tgl[0]-$tgl[1]";
			$deskripsi = eraseStrange($_POST['deskripsi']);
			$status = preg_replace("@[^0-9]@i","",$_POST['status']);
			if($status=="")	$status = "0";
			$sql = "update album set album='$album', tanggal='$tanggal', deskripsi='$deskripsi', status='$status' where id=$id";
			#echo $sql;
			if($this->exQ($sql)){
				$this->pesan = "Album telah diedit !";
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
	
	function tambahGambar($id){
		$notNull = false;
		if(isset($_FILES['gambar']['name'])){
			$folder = "/images/galery/$id";
			$ind = 0;
			foreach($_FILES['gambar']['name'] as $data){
				if(strlen($_FILES['gambar']['name'][$ind])>0){
					$notNull = true;
					// insert into galery
					$sql = "insert into galery(id_album,caption) values($id,'".$_FILES['gambar']['name'][$ind]."')";
					if($this->exQ($sql)){
						$tfile = $_FILES['gambar']['tmp_name'][$ind];
						$result_array = getimagesize($tfile);
						if ($result_array !== false) {
							$nama = $this->getMax("galery").getext($_FILES['gambar']['name'][$ind]);
							if($this->uploadFile($folder,$nama,$tfile)){
								// bikin thumbs
								if(!$this->bikinThumbs($id,$nama)){
									$this->pesan .= "Pembuatan thumbnail untuk Gambar ke-".($ind+1)." gagal dilakukan !<br>";
								}
								$this->idUploaded[] = $this->getMax("galery");
								$this->pesan .= "Gambar ke-".($ind+1)." berhasil diupload !<br>";
								$sql = "update galery set thumbs='$nama' where id=".$this->getMax("galery");
								$this->exQ($sql);
							}else{
								$sql = "delete from galery where id=".$this->getMax("galery");
								$this->exQ($sql);
								$this->pesan .= "Gambar ke-".($ind+1)." gagal diupload !<br>";
							}
						} else {
							$this->pesan .= "Gambar ke-".($ind+1)." gagal diupload ! File bukan berbentuk gambar.<br>";
							return false;
						}
					}else{
						#echo mysql_error();
						redirect("../error.php?p=1");
						die();
					}
				}
				$ind++;
			}
			if(!$notNull){
				$this->pesan = "Paling tidak harus ada 1 gambar yang diupload !";
				return false;
			}else{
				return true;
			}
		}else{
			$this->pesan = "Paling tidak harus ada 1 gambar yang diupload !";
			return false;
		}
	}
	
	function simpanCaption(){
		if(isset($_POST['id'])){
			foreach($_POST['id'] as $idU){
				$caption = eraseStrange($_POST['judul'.$idU]);
				$status = preg_replace("@[^0-9]@i","",$_POST['status'.$idU]);
				if(!$status) $status=0;
				$sql = "update galery set caption='$caption', status='$status' where id=$idU";
				if(!$this->exQ($sql)){
					$this->pesan = "Data gagal diupdate !";
					return false;
				}else{
					$this->pesan = "Data berhasil diupdate !";
				}
			}
			return true;
		}else{
			$this->pesan = "Pilih salah satu gambar untuk diedit !";
			return false;
		}
	}
	
	function delGalery($id){
		$folder = FTP_PATH."/images/galery/$id";
		$ind = 1;
		$failed = false;
		foreach($_POST['cGalery'] as $idGal){
			$sql = "select caption, thumbs from galery where id=$idGal";
			$data = mysql_fetch_array($this->exQ($sql));
			$file = $data[1];
			$caption = $data[0];
			if($this->delete($folder,$file)){
				$this->pesan .= "Gambar dengan Judul : <b><i>$caption</i></b> berhasil dihapus !<br>";
				$sql = "delete from galery where id=$idGal";
				$this->exQ($sql);
			}else{
				$this->pesan .= "Gambar dengan Judul : <b><i>$caption</i></b> gagal dihapus !<br>";
				$failed = true;
			}
			$ind++;
		}
		if(!$failed){
			return true;
		}else{		
			return false;
		}
	}
	
	function delAlbum($id){
		$folder = FTP_PATH."/images/galery";
		$dirName = "$id";
		if($this->delDir($folder,$dirName)){
			$sql ="delete from galery where id_album=$id";
			$this->exQ($sql);
			$sql ="delete from album where id=$id";
			$this->exQ($sql);
			$this->pesan = "Album berhasil dihapus !";
			return true;
		}else{
			$this->pesan = "Album gagal dihapus ! Cobalah beberapa saat lagi.";
			return false;
		}
	}

	function delDir($folder,$dst_dir){
		// set up basic connection
		$conn_id = ftp_connect(FTP_HOME);
		// login with username and password
		$login_result = ftp_login($conn_id, ftp_user_name, ftp_user_pass);
		ftp_chdir($conn_id,$folder);
		$ar_files = ftp_nlist($conn_id, $dst_dir); 
		if (is_array($ar_files)){ // makes sure there are files
			for ($i=0;$i<sizeof($ar_files);$i++){ // for each file
				$st_file = $ar_files[$i]; 
				ftp_delete($conn_id, $st_file); // if not, delete the file
			}
		}
		if(ftp_rmdir($conn_id, $dst_dir)){
			ftp_close($conn_id);
			return true;
		}else{
			ftp_close($conn_id);
			return false;
		}
	} 

	function bikinDir($folder, $dirName){
		$folder = FTP_PATH.$folder;
		// set up basic connection
		$conn_id = ftp_connect(FTP_HOME);
		// login with username and password
		$login_result = ftp_login($conn_id, ftp_user_name, ftp_user_pass);
		ftp_chdir($conn_id,$folder);
		if(ftp_mkdir($conn_id,$dirName)){
			ftp_close($conn_id);
			return true;
		}else{
			ftp_close($conn_id);
			return false;
		}
	}

	function delete($folder, $nfile){
		// set up basic connection
		$conn_id = ftp_connect(FTP_HOME);
		// login with username and password
		$login_result = ftp_login($conn_id, ftp_user_name, ftp_user_pass);
		ftp_chdir($conn_id,$folder);
		if(ftp_delete($conn_id,$nfile) && ftp_delete($conn_id,"thumbs_".$nfile)){
			ftp_close($conn_id);
			return true;
		}else{
			ftp_close($conn_id);
			return false;
		}
	}

	function CreateThumb($file,$maxwdt,$maxhgt,$dfile) {
	   list($owdt,$ohgt,$otype)=@getimagesize($file);
		
	  switch($otype) {
	   case 1:  $newimg=imagecreatefromgif($file);
			#header('Content-type: image/gif');
			break;
	   case 2:  $newimg=imagecreatefromjpeg($file);
			#header('Content-type: image/jpg');
			break;
	   case 3:  $newimg=imagecreatefrompng($file);
			#header('Content-type: image/png');
			break;
		default :
			return false;
	  }
   
	  if($newimg) {
	   if($owdt>1500 || $ohgt>1200)
			   list($owdt, $ohgt) = Resample($newimg, $owdt, $ohgt, 1024,768,0);
			   
	   Resample($newimg, $owdt, $ohgt, $maxwdt, $maxhgt);
		   
	   switch($otype) {
		 case 1: imagegif($newimg,$dfile); break;    
		 case 2: imagejpeg($newimg,$dfile,90); break; 
		 case 3: imagepng($newimg,$dfile);  break; 
	   }
		   
		   imagedestroy($newimg);
	   
		return true;
	  }
	}

	function Resample(&$img, $owdt, $ohgt, $maxwdt, $maxhgt, $quality=1) { 
	  if(!$maxwdt) $divwdt=0;
	   else $divwdt=Max(1,$owdt/$maxwdt);
	   
	  if(!$maxhgt) $divhgt=0;
	   else $divhgt=Max(1,$ohgt/$maxhgt);
	   
	  if($divwdt>=$divhgt) {
	   $newwdt=$maxwdt;
	   $newhgt=round($ohgt/$divwdt);
	  } else {
	   $newhgt=$maxhgt;
	   $newwdt=round($owdt/$divhgt);
	  }
	   
	   $tn=imagecreatetruecolor($newwdt,$newhgt);
	   if($quality)
		   imagecopyresampled($tn,$img,0,0,0,0,$newwdt,$newhgt,$owdt,$ohgt);        
	   else 
		   imagecopyresized($tn,$img,0,0,0,0,$newwdt,$newhgt,$owdt,$ohgt);
	
	   imagedestroy($img);
	   
	   $img = $tn;
	   
	   return array($newwdt, $newhgt);
	}

	function bikinThumbs($id,$file){
		$nfile = WEB_PATH."/images/galery/$id/$file";
		#echo "nfile : $nfile<br>";
		$dfile = WEB_PATH."/images/galery/$id/thumbs_$file";
		#echo "dfile : $dfile<br>";
		if(file_exists($nfile)){
			if(CreateThumb($nfile,150,100,$dfile)){
				return true;
			}else{
				return false;
			}
		}
	}

	function uploadFile($folder,$nama,$tfile){
		$uploaddir = FTP_PATH.$folder;
		echo $uploaddir;
		// set up basic connection
		$conn_id = ftp_connect(FTP_HOME);
		// login with username and password
		$login_result = ftp_login($conn_id, ftp_user_name, ftp_user_pass);
		ftp_chdir($conn_id,$uploaddir);

		// upload a file
		$ftpRes = ftp_put($conn_id, $nama, $tfile, FTP_BINARY);
		if ($ftpRes){
			ftp_close($conn_id);
			return true;
		} else {
			ftp_close($conn_id);
			return false;
		}
	}
	
	function getMax($table){
		$sql = "select max(id) as maxi from $table";
		if($r = $this->exQ($sql)){
			if(mysql_num_rows($r)>0){
				$data = mysql_fetch_array($r,MYSQL_NUM);
				return $data[0];
			}else{
				return 1;
			}
		}else{
			return 1;
		}
	}
	
}
?>