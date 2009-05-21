<?
function redirect($hal){
	$hal = str_replace("[\']","",$hal);
	#echo mysql_error();
	if (!headers_sent()) {
		header("Location: ".$hal);
	}else{
		echo "<script language='javascript'>
				location.href='$hal';
			  </script>";
	}
	die();
}

function show_tgl($nama,$sel,$class,$label){
	echo "<select name='$nama' class='$class'>";
	if($label) echo "<option value=''>- Select -</option>";
	for($x=1;$x<=31;$x++){
		$sele=($x==$sel)?" selected":"";
		echo "<option value='$x'$sele>$x</option>\n";
	}
	echo "</select>";
}

function show_bln($nama,$sel,$class,$tipe,$label){
	$bln1 = array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Okt","Nov","Des");
	$bln2 = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	echo "<select name='$nama' class='$class'>";
	if($label) echo "<option value=''>- Select -</option>";
	for($x=1;$x<=12;$x++){
		$sele=($x==$sel)?" selected":"";
		if($tipe==1){ // angka 00-12
			echo "<option value='".substr('00'.$x,-2)."'$sele>".substr('00'.$x,-2)."</option>";
		}elseif($tipe==2){ // singkatan Jan, Feb
			echo "<option value='".substr('00'.$x,-2)."'$sele>".$bln1[$x-1]."</option>";
		}else{ // full name in Indonesian
			echo "<option value='".substr('00'.$x,-2)."'$sele>".$bln2[$x-1]."</option>";
		}
	}
	echo "</select>";
}

function show_thn($nama,$sel,$class,$start,$interval,$label){
	echo "<select name='$nama' class='$class'>";
	if($label) echo "<option value=''>- Select -</option>";
	for($x=$start;$x<=($start+$interval);$x++){
		$sele=($x==$sel)?" selected":"";
		echo "<option value='$x'$sele>$x</option>";
	}
	echo "</select>";
}

function strips($str){
	$str = preg_replace("@[\\\'\"\?\$\#\%\`\~]@i","",$str);
	return $str;
}

function custom_strips($str,$regex){
	$str = preg_replace($regex,"",$str);
	return $str;
}

function genUnique($jml){
	$arrKunci = "abcdefghijklmnopqrstuvwxyz1234567890";
	for($x=0;$x<$jml;$x++){
		$rnd = rand(0,36);
		$kode .= $arrKunci[$rnd];
	}
	return $kode;
}

function genKode($jmlKarakter){
	$arKunci = "1234567890";
	for($x=0;$x<$jmlKarakter;$x++){
		$rndom = rand(0,10);
		$code .= $arKunci[$rndom];
	}
	return $code;
}

function eraseStrange($isi){
	$isi = preg_replace("@<[/]?script[^>]*(>)?@i","",$isi);
	$isi = str_replace("<?","",$isi);
	$isi = str_replace("?>","",$isi);
	$isi = str_replace("'","`",$isi);
	return $isi;
}

function repl_danger($str){
	$danger = array("'","\\");
	$rpl = array("`","\\");
	$str = str_replace($danger,$rpl,$str);
	return $str;
}

function detectBlank($str){
	foreach($str as $k=>$i){
		if(strlen(trim($i))==0){
			return true;
		}
	}
	return false;
}

function getext($f) {
$ext = substr($f, strrpos($f,".") + 1);
return ".".$ext;
}

function paging($url,$size,$sel,$max){
	
}

class upFile{
	
	var $pesan;
	
	function uploadFile($max,$nfile,$folder,$width=0,$height=0){
		if($_FILES['gambar']['size']>$max and $max>0){
			$this->pesan = "Catatan : Gambar gagal diupload ! <br><u>File gambar tidak boleh lebih dari ".floor($max/1024)." Kb</u> !<br><br>";
			return false;
		}else{
			$uploaddir = FTP_PATH."$folder";
			$file = $nfile;
			$remote_file = $_FILES['gambar']['tmp_name'];
			$result_array = getimagesize($remote_file);
			if ($result_array !== false) {
				list($w, $h, $t, $attr) = $result_array;
				#print_r($result_array);
				if($width>0){
					if($width!=$w){
						$this->pesan = "Lebar Gambar [ width ] harus : $width px !";
						return false;
					}
				}
				if($height>0){
					if($height!=$h){
						$this->pesan = "Tinggi Gambar [ height ] harus : $height px !";
						return false;
					}
				}
				// nothing
			} else {
				$this->pesan = "Catatan : Gambar gagal diupload ! <br><u>File harus berbentuk gambar</u> !<br><br>";
				return false;
			}
			
			// set up basic connection
			$conn_id = ftp_connect("127.0.0.1");
			// login with username and password
			$login_result = ftp_login($conn_id, ftp_user_name, ftp_user_pass);
			// change dir
			ftp_chdir($conn_id,$uploaddir);
			// upload a file
			$ftpRes = ftp_put($conn_id, $file, $remote_file, FTP_ASCII);
			if ($ftpRes) {
				$thumbName = $nfile . getext($tfile);
				$this->pesan = "Gambar telah diupdate !";
				return true;
			} else {
				$this->pesan = "Catatan : Gambar gagal diupload ! <br><u>Silakan coba kembali</u> !<br><br>";
				return false;
			}
			// close the connection
			ftp_close($conn_id); 
		}
	}

	function uploadFileB($max,$nfile,$folder,$width=0,$height=0){
		if($_FILES['gambarB']['size']>$max and $max>0){
			$this->pesan = "Catatan : Gambar gagal diupload ! <br><u>File gambar tidak boleh lebih dari ".floor($max/1024)." Kb</u> !<br><br>";
			return false;
		}else{
			$uploaddir = FTP_PATH."$folder";
			$file = $nfile;
			$remote_file = $_FILES['gambarB']['tmp_name'];
			$result_array = getimagesize($remote_file);
			if ($result_array !== false) {
				list($w, $h, $t, $attr) = $result_array;
				#print_r($result_array);
				if($width>0){
					if($width!=$w){
						$this->pesan = "Lebar Gambar [ width ] harus : $width px !";
						return false;
					}
				}
				if($height>0){
					if($height!=$h){
						$this->pesan = "Tinggi Gambar [ height ] harus : $height px !";
						return false;
					}
				}
				// nothing
			} else {
				$this->pesan = "Catatan : Gambar gagal diupload ! <br><u>File harus berbentuk gambar</u> !<br><br>";
				return false;
			}
			
			// set up basic connection
			$conn_id = ftp_connect("127.0.0.1");
			// login with username and password
			$login_result = ftp_login($conn_id, ftp_user_name, ftp_user_pass);
			// change dir
			ftp_chdir($conn_id,$uploaddir);
			// upload a file
			$ftpRes = ftp_put($conn_id, $file, $remote_file, FTP_ASCII);
			if ($ftpRes) {
				$thumbName = $nfile . getext($tfile);
				$this->pesan = "Gambar telah diupdate !";
				return true;
			} else {
				$this->pesan = "Catatan : Gambar gagal diupload ! <br><u>Silakan coba kembali</u> !<br><br>";
				return false;
			}
			// close the connection
			ftp_close($conn_id);
		}
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
?>