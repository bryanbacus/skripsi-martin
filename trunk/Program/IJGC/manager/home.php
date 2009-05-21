<?php
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

$smarty->assign('judul',"Home");
$content = $smarty->fetch("home.tpl");
$smarty->assign('content',$content);
?>