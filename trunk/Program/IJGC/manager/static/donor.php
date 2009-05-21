<?php
// simpan data
if($_POST['simpan']){
	$about = $_POST['about'];
	$about = preg_replace("@<[/]?script[^>]*(>)?@i","",$about);
	$about = str_replace("'","`",$about);
	$tulis = fopen(PATH_STATIC."/donor.tpl", "w");
	// Let's make sure the file exists and is writable first.
	if (is_writable(PATH_STATIC."/donor.tpl")) {
		// Write $somecontent to our opened file.
		if (fwrite($tulis, $about) === FALSE) {
			$pesan = "File tidak dapat disimpan. Hubungi Administrator dengan subject : File About is unwriteable";
		}
		$pesan = "File berhasil disimpan !";
		fclose($tulis);

	} else {
		$pesan = "File tidak dapat disimpan. Hubungi Administrator dengan subject : File How to Become Donor is unwriteable";
		die();
	}
	$smarty->assign('pesan',$pesan);
}

// buka ./static/visi.tpl
$tulis = "";
$about = "";
if(file_exists(PATH_STATIC."/donor.tpl")){
	$tulis = fopen(PATH_STATIC."/donor.tpl", "r");
	while(!feof($tulis)){
		$about .= preg_replace("@[\n\r]@i","",fread($tulis,4096));
	}
	fclose($tulis);
	$smarty->assign('about',$about);
}

$smarty->assign('judul',"Edit How to Become Donors");
$smarty->assign('path_editor',PATH_EDITOR);
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$content = $smarty->fetch("donor.tpl");
$smarty->assign('content',$content);
?>