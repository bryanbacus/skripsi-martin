<?php
// simpan data
if($_POST['simpan']){
	$contact = $_POST['contact'];
	$contact = preg_replace("@<[/]?script[^>]*(>)?@i","",$contact);
	$contact = str_replace("'","`",$contact);
	$tulis = fopen(PATH_STATIC."/become.tpl", "w");
	// Let's make sure the file exists and is writable first.
	if (is_writable(PATH_STATIC."/become.tpl")) {
		// Write $somecontent to our opened file.
		if (fwrite($tulis, $contact) === FALSE) {
			$pesan = "How to Become Member tidak dapat disimpan. Hubungi Administrator dengan subject : File Contact is unwriteable";
		}
		$pesan = "How to Become Member berhasil disimpan !";
		fclose($tulis);

	} else {
		$pesan = "How to Become Member tidak dapat disimpan. Hubungi Administrator dengan subject : File Contact is unwriteable";
		die();
	}
	$smarty->assign('pesan',$pesan);
}

// buka ./static/contact.tpl
$tulis = "";
$contact = "";
if(file_exists(PATH_STATIC."/become.tpl")){
	$tulis = fopen(PATH_STATIC."/become.tpl", "r");
	while(!feof($tulis)){
		$contact .= preg_replace("@[\n\r]@i","",fread($tulis,4096));
	}
	fclose($tulis);
	$smarty->assign('contact',$contact);
}

$smarty->assign('judul',"Edit How to Become Member");
$smarty->assign('path_editor',PATH_EDITOR);
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$content = $smarty->fetch("become.tpl");
$smarty->assign('content',$content);
?>