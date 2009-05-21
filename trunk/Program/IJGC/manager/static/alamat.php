<?php
// simpan data
if($_POST['simpan']){
	$alamat = $_POST['alamat'];
	$alamat = preg_replace("@<[/]?script[^>]*(>)?@i","",$alamat);
	$alamat = str_replace("<?","",$alamat);
	$alamat = str_replace("?>","",$alamat);
	$alamat = str_replace("'","`",$alamat);
	$alamat = str_replace("\r\n","<br>",$alamat);
	$tulis = fopen(PATH_STATIC."/alamat.tpl", "w");
	// Let's make sure the file exists and is writable first.
	if (is_writable(PATH_STATIC."/alamat.tpl")) {
		// Write $somecontent to our opened file.
		if (fwrite($tulis, $alamat) === FALSE) {
			$pesan = "Quick Facts tidak dapat disimpan. Hubungi Administrator dengan subject : File Quick Facts is unwriteable";
		}
		$pesan = "Quick Facts berhasil disimpan !";
		fclose($tulis);

	} else {
		$pesan = "Quick Facts tidak dapat disimpan. Hubungi Administrator dengan subject : File Quick Facts is unwriteable";
		die();
	}
	$smarty->assign('pesan',$pesan);
}

// buka ./static/Alamat.php
$tulis = "";
$alamat = "";
if(file_exists(PATH_STATIC."/alamat.tpl")){
	$tulis = fopen(PATH_STATIC."/alamat.tpl", "r");
	while(!feof($tulis)){
		$alamat .= fread($tulis,4096);
	}
	fclose($tulis);
	//$alamat = str_replace("<br>","\n",$alamat);
	$smarty->assign('alamat',$alamat);
}

$smarty->assign('judul',"Edit Quicik Facts");
$smarty->assign('path_editor',PATH_EDITOR);
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$content = $smarty->fetch("alamat.tpl");
$smarty->assign('content',$content);
?>