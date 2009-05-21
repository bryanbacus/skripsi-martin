<?php
$smarty->assign("tanggal",date("d F Y"));
$header = $smarty->fetch("header.tpl");
$smarty->assign('header',$header);
?>