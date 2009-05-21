<?php
// simpan data
if($_POST['simpan']){
	$about = $_POST['about'];
	$about = preg_replace("@<[/]?script[^>]*(>)?@i","",$about);
	$about = str_replace("'","`",$about);
	$tulis = fopen(PATH_STATIC."/about.tpl", "w");
	// Let's make sure the file exists and is writable first.
	if (is_writable(PATH_STATIC."/about.tpl")) {
		// Write $somecontent to our opened file.
		if (fwrite($tulis, $about) === FALSE) {
			$pesan = "About us tidak dapat disimpan. Hubungi Administrator dengan subject : File About is unwriteable";
		}
		$pesan = "About us berhasil disimpan !";
		fclose($tulis);

	} else {
		$pesan = "About us tidak dapat disimpan. Hubungi Administrator dengan subject : File About us is unwriteable";
		die();
	}
	$smarty->assign('pesan',$pesan);
}

// buka ./static/visi.tpl
$tulis = "";
$about = "";
if(file_exists(PATH_STATIC."/about.tpl")){
	$tulis = fopen(PATH_STATIC."/about.tpl", "r");
	while(!feof($tulis)){
		$about .= preg_replace("@[\n\r]@i","",fread($tulis,4096));
	}
	fclose($tulis);
	$smarty->assign('about',$about);
}

$smarty->assign('judul',"Edit About us");
$smarty->assign('path_editor',PATH_EDITOR);
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$content = $smarty->fetch("about.tpl");
$smarty->assign('content',$content);
?>