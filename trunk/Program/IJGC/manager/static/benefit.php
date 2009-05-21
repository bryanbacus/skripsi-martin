<?php
// simpan data
if($_POST['simpan']){
	$contact = $_POST['contact'];
	$contact = preg_replace("@<[/]?script[^>]*(>)?@i","",$contact);
	$contact = str_replace("'","`",$contact);
	$tulis = fopen(PATH_STATIC."/benefit.tpl", "w");
	// Let's make sure the file exists and is writable first.
	if (is_writable(PATH_STATIC."/benefit.tpl")) {
		// Write $somecontent to our opened file.
		if (fwrite($tulis, $contact) === FALSE) {
			$pesan = "Benefit of Membership tidak dapat disimpan. Hubungi Administrator dengan subject : File Benefit of Membership is unwriteable";
		}
		$pesan = "Benefit of Membership berhasil disimpan !";
		fclose($tulis);

	} else {
		$pesan = "Benefit of Membership tidak dapat disimpan. Hubungi Administrator dengan subject : File Benefit of Membership is unwriteable";
		die();
	}
	$smarty->assign('pesan',$pesan);
}

// buka ./static/contact.tpl
$tulis = "";
$contact = "";
if(file_exists(PATH_STATIC."/benefit.tpl")){
	$tulis = fopen(PATH_STATIC."/benefit.tpl", "r");
	while(!feof($tulis)){
		$contact .= preg_replace("@[\n\r]@i","",fread($tulis,4096));
	}
	fclose($tulis);
	$smarty->assign('contact',$contact);
}

$smarty->assign('judul',"Edit Benefit of Membership");
$smarty->assign('path_editor',PATH_EDITOR);
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$content = $smarty->fetch("benefit.tpl");
$smarty->assign('content',$content);
?>