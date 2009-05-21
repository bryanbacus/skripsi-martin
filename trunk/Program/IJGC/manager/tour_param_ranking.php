<?php

if(!defined("NODIRECT")){
	die("No direct Access !!");
}

if($_SESSION['levelUser']!=1){
	header("Location:index.php");
}

require_once(PATH_CLASS."/IJGA/parameter.class.php");

$param = new parameter_ranking();

// def var
$template = "tour_param_ranking.tpl";
$smarty->assign('judul',"Tournament Parameter - Ranking");
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$smarty->assign('referer',$_SERVER['SCRIPT_NAME']."?aksi=ranking");
$smarty->assign("button_value", "Add");

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);

if(strtolower(trim($_POST['addbtn'])) == "add"){
	$aksi2 = "add";
}else if(strtolower(trim($_POST['addbtn'])) == "update"){
	$aksi2 = "update";
}

$smarty->assign('aksi2',$aksi2);
$smarty->assign("ranking", "0");
$smarty->assign("prosentase", "0");
		
// Process aksi2
switch($aksi2){
	case "add":
		$pos = trim($_POST['position']);
		$ranking = trim($_POST['ranking']);
		$prosentase = trim($_POST['prosentase']);
		$param->add_param($pos, $ranking, $prosentase);
		$smarty->assign("button_value", "Add");
		break;
	case "edit":
		$smarty->assign('disable',"disabled");
		
		$id = $_REQUEST['id'];
		$arrType = $param->get_ranking($id);
		if(count($arrType) > 0 ){
			$smarty->assign("id_param", $id);
			$smarty->assign("position", $arrType[0]["position"]);
			$smarty->assign("ranking", $arrType[0]["points"]);
			$smarty->assign("prosentase", $arrType[0]["prosentase"]);
			$smarty->assign("button_value", "Update");		
		}
		break;
	case "update":	
		$id = $_POST['id_param'];
		$pos = trim($_POST['pos_no']);
		$ranking = trim($_POST['ranking']);
		$prosentase = trim($_POST['prosentase']);
		$param->update_param($id, $pos, $ranking, $prosentase);
		
		$smarty->assign("id_param", "");
		$smarty->assign("pos_no", "");
		$smarty->assign("position", "");
		$smarty->assign("ranking", "0");
		$smarty->assign("prosentase", "0");		
		$smarty->assign("button_value", "Add");
		break;
	case "delete":
		$id = $_REQUEST['id'];
		$param->remove_param($id);
		break;		
	default:
		break;	
}

// user list
$doAksi2 = false;
$param_list = $param->get_list();
$smarty->assign('typelist',$param_list);

// assign user template
$content = $smarty->fetch($template);

$smarty->assign('content',$content);
?>