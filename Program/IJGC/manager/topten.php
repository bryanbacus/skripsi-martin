<?php

if(!defined("NODIRECT")){
	die("No direct Access !!");
}
if($_SESSION['levelUser']!=1){
	header("Location:index.php");
}

require_once(PATH_CLASS."/IJGA/statistic.class.php");

// declare var
$course_fact = new TopRanking();
$template = "topten.tpl";

$showList = false;
$showDetail = false;


$smarty->assign('judul',"Top 10 Ranking");

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);

// Process aksi2
switch($aksi2){
	default:
		$course_list = $course_fact->getTopPosition();
		$smarty->assign('courselist',$course_list);
		$smarty->assign('course_msg',"There are currently ranking.");
		$showList = true;
		break;	
}

$smarty->assign('showList',$showList);
$smarty->assign('showDetail',$showDetail);

// assign template
$content = $smarty->fetch($template);
$smarty->assign('content',$content);
?>