<?php
// put full path to Smarty.class.php
define("PATH_EDITOR","./editor");
define("PATH_CLASS","./class");
define("PATH_FUNGSI","../fungsi");
define("PATH_STATIC",WEB_PATH.'/templates');
//define("PATH_STATIC","../static");
define("HOME","../");
require(WEB_PATH.'/manager/smarty/Smarty.class.php');
$smarty = new Smarty();
$smarty->template_dir = WEB_PATH.'/templates/manager';
$smarty->compile_dir = WEB_PATH.'/templates_c/manager';
$smarty->cache_dir = WEB_PATH.'/cache';
$smarty->config_dir = WEB_PATH.'/configs';
?>