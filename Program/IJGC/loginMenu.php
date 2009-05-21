<?
//check level
if(isset($_SESSION['levelUser'])){
	$smarty->assign('level',$_SESSION['levelUser']);
	$menu = $smarty->fetch("loginMenu.tpl");
	$smarty->assign('login',$menu);
}
?>