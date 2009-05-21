<?php
// simpan data
if($_POST['simpan']){
	$about = $_POST['about'];
	$about = preg_replace("@<[/]?script[^>]*(>)?@i","",$about);
	$about = str_replace("'","`",$about);
	$tulis = fopen(PATH_STATIC."/partner.tpl", "w");
	// Let's make sure the file exists and is writable first.
	if (is_writable(PATH_STATIC."/partner.tpl")) {
		// Write $somecontent to our opened file.
		if (fwrite($tulis, $about) === FALSE) {
			$pesan = "How to Become Partner tidak dapat disimpan. Hubungi Administrator dengan subject : File How to Become Partner is unwriteable";
		}
		$pesan = "How to Become Partner berhasil disimpan !";
		fclose($tulis);

	} else {
		$pesan = "How to Become Partner tidak dapat disimpan. Hubungi Administrator dengan subject : File How to Become Partner is unwriteable";
		die();
	}
	$smarty->assign('pesan',$pesan);
}

// buka ./static/visi.tpl
$tulis = "";
$about = "";
if(file_exists(PATH_STATIC."/partner.tpl")){
	$tulis = fopen(PATH_STATIC."/partner.tpl", "r");
	while(!feof($tulis)){
		$about .= preg_replace("@[\n\r]@i","",fread($tulis,4096));
	}
	fclose($tulis);
	$smarty->assign('about',$about);
}

$smarty->assign('judul',"Edit How to Become Partner");
$smarty->assign('path_editor',PATH_EDITOR);
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$content = $smarty->fetch("partner.tpl");
$smarty->assign('content',$content);
?>