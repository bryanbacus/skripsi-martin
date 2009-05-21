<?php
// put full path to Smarty.class.php
require(WEB_PATH.'/manager/smarty/Smarty.class.php');
$smarty = new Smarty();
$smarty->template_dir = WEB_PATH.'/templates';
$smarty->compile_dir = WEB_PATH.'/templates_c';
$smarty->cache_dir = WEB_PATH.'/cache';
$smarty->config_dir = WEB_PATH.'/configs';
?>