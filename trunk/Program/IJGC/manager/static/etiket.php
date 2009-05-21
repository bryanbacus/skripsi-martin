<?php
// simpan data
if($_POST['simpan']){
	$contact = $_POST['contact'];
	$contact = preg_replace("@<[/]?script[^>]*(>)?@i","",$contact);
	$contact = str_replace("'","`",$contact);
	$tulis = fopen(PATH_STATIC."/etiket.tpl", "w");
	// Let's make sure the file exists and is writable first.
	if (is_writable(PATH_STATIC."/etiket.tpl")) {
		// Write $somecontent to our opened file.
		if (fwrite($tulis, $contact) === FALSE) {
			$pesan = "Etiquette tidak dapat disimpan. Hubungi Administrator dengan subject : File Etiquette is unwriteable";
		}
		$pesan = "Etiquette berhasil disimpan !";
		fclose($tulis);

	} else {
		$pesan = "Etiquette tidak dapat disimpan. Hubungi Administrator dengan subject : File Rules is unwriteable";
		die();
	}
	$smarty->assign('pesan',$pesan);
}

// buka ./static/contact.tpl
$tulis = "";
$contact = "";
if(file_exists(PATH_STATIC."/etiket.tpl")){
	$tulis = fopen(PATH_STATIC."/etiket.tpl", "r");
	while(!feof($tulis)){
		$contact .= preg_replace("@[\n\r]@i","",fread($tulis,4096));
	}
	fclose($tulis);
	$smarty->assign('contact',$contact);
}

$smarty->assign('judul',"Edit Etiquette");
$smarty->assign('path_editor',PATH_EDITOR);
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$content = $smarty->fetch("etiket.tpl");
$smarty->assign('content',$content);
?>