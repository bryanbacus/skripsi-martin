<?php

if(!defined("NODIRECT")){
	die("No direct Access !!");
}

if($_SESSION['levelUser']!=1){
	header("Location:index.php");
}

require_once(PATH_CLASS."/IJGA/course.class.php");

$type = new course_type();

// def var
$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=crtype\'" />';

$template = "course_type.tpl";
$smarty->assign('judul',"List of Course Type");
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$smarty->assign('referer',$_SERVER['SCRIPT_NAME']."?aksi=crtype");
$smarty->assign("button_value", "Add");

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);

if(strtolower(trim($_POST['addbtn'])) == "add"){
	$aksi2 = "add";
}else if(strtolower(trim($_POST['addbtn'])) == "update"){
	$aksi2 = "update";
}

$smarty->assign('aksi2',$aksi2);

// Process aksi2
switch($aksi2){
	case "add":
		$type_name = trim ($_POST['type_name']);
		$type_color = trim ($_POST['type_color']);
		$type->add_type($type_name, $type_color);
		$smarty->assign("button_value", "Add");
		break;
	case "edit":
		$id = $_REQUEST['id'];
		$arrType = $type->get_type($id);
		if(count($arrType) > 0 ){
			$smarty->assign("type_id", $arrType[0]["type_id"]);
			$smarty->assign("type_value", $arrType[0]["type_name"]);
			$smarty->assign("type_color", $arrType[0]["type_color"]);
			$smarty->assign("button_value", "Update");		
		}
		break;
	case "update":	
		$id = $_POST['type_id'];
		$name = trim($_POST['type_name']);
		$color = trim($_POST['type_color']);
		$type->update_type($id, $name, $color);
		
		$smarty->assign("type_id", "");
		$smarty->assign("type_value", "");
		$smarty->assign("type_color", "");		
		$smarty->assign("button_value", "Add");
		break;
	case "delete":
		$id = $_REQUEST['id'];
		$type->remove_type($id);
		break;		
	default:
		break;	
}

// user list
$doAksi2 = false;
$type_list = $type->get_list();
$smarty->assign('typelist',$type_list);

// assign user template
$content = $smarty->fetch($template);

$smarty->assign('content',$content);
?>
