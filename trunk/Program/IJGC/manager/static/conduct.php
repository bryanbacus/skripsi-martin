<?php
// simpan data
if($_POST['simpan']){
	$conduct = $_POST['conduct'];
	$conduct = preg_replace("@<[/]?script[^>]*(>)?@i","",$conduct);
	$conduct = str_replace("'","`",$conduct);
	$tulis = fopen(PATH_STATIC."/conduct.tpl", "w");
	// Let's make sure the file exists and is writable first.
	if (is_writable(PATH_STATIC."/conduct.tpl")) {
		// Write $somecontent to our opened file.
		if (fwrite($tulis, $conduct) === FALSE) {
			$pesan = "Conduct of Play tidak dapat disimpan. Hubungi Administrator dengan subject : File Conduct of Play unwriteable";
		}
		$pesan = "Conduct of Play berhasil disimpan !";
		fclose($tulis);

	} else {
		$pesan = "Conduct of Play tidak dapat disimpan. Hubungi Administrator dengan subject : File Conduct of Play is unwriteable";
		die();
	}
	$smarty->assign('pesan',$pesan);
}

// buka ./static/visi.tpl
$tulis = "";
$conduct = "";
if(file_exists(PATH_STATIC."/conduct.tpl")){
	$tulis = fopen(PATH_STATIC."/conduct.tpl", "r");
	while(!feof($tulis)){
		$conduct .= preg_replace("@[\n\r]@i","",fread($tulis,4096));
	}
	fclose($tulis);
	$smarty->assign('conduct',$conduct);
}

$smarty->assign('judul',"Edit Conduct of Play");
$smarty->assign('path_editor',PATH_EDITOR);
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$content = $smarty->fetch("conduct.tpl");
$smarty->assign('content',$content);
?>