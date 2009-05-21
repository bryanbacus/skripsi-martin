<?php
// simpan data
if($_POST['simpan']){
	$contact = $_POST['contact'];
	$contact = preg_replace("@<[/]?script[^>]*(>)?@i","",$contact);
	$contact = str_replace("'","`",$contact);
	$tulis = fopen(PATH_STATIC."/contact.tpl", "w");
	// Let's make sure the file exists and is writable first.
	if (is_writable(PATH_STATIC."/contact.tpl")) {
		// Write $somecontent to our opened file.
		if (fwrite($tulis, $contact) === FALSE) {
			$pesan = "Contact tidak dapat disimpan. Hubungi Administrator dengan subject : File Contact is unwriteable";
		}
		$pesan = "Contact berhasil disimpan !";
		fclose($tulis);

	} else {
		$pesan = "Contact tidak dapat disimpan. Hubungi Administrator dengan subject : File Contact is unwriteable";
		die();
	}
	$smarty->assign('pesan',$pesan);
}

// buka ./static/contact.tpl
$tulis = "";
$contact = "";
if(file_exists(PATH_STATIC."/contact.tpl")){
	$tulis = fopen(PATH_STATIC."/contact.tpl", "r");
	while(!feof($tulis)){
		$contact .= preg_replace("@[\n\r]@i","",fread($tulis,4096));
	}
	fclose($tulis);
	$smarty->assign('contact',$contact);
}

$smarty->assign('judul',"Edit Contact");
$smarty->assign('path_editor',PATH_EDITOR);
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$content = $smarty->fetch("contact.tpl");
$smarty->assign('content',$content);
?>