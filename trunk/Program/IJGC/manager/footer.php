<?php
$smarty->assign("footer","Powered by Smarty");
$footer = $smarty->fetch("footer.tpl");
$smarty->assign('footer',$footer);
?>