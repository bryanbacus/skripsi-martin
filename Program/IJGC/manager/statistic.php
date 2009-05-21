<?php

if(!defined("NODIRECT")){
	die("No direct Access !!");
}
if($_SESSION['levelUser']!=1){
	header("Location:index.php");
}

require_once(PATH_CLASS."/IJGA/course.class.php");
require_once(PATH_CLASS."/IJGA/games.class.php");
require_once(PATH_CLASS."/IJGA/statistic.class.php");

// declare var
$template = "statistic.tpl";
$showList = false;
$showError = false;
$showStatistic = false;

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if(strtolower(trim($_POST['filterbtn'])) == "process"){
	$aksi2 = "process";
}else if (strtolower(trim($_POST['backlist'])) == "close & back to criteria form"){
	$aksi2 = "reload";
}

// Process aksi2
switch($aksi2){
	case "process":
		process($smarty, $showList, $showStatistic, $showError);
		break;
	default:
		refreshList($smarty, $showList, $showStatistic, $showError);
		break;	
}

$date_first = trim($_POST['awal']);
$date_last = trim($_POST['akhir']);
if ($date_first == "") $date_first =  date("Y/m/d");
if ($date_last == "") $date_last =  date("Y/m/d");

// assign template
$smarty->assign('awal',$date_first);
$smarty->assign('akhir',$date_last);
$smarty->assign('judul',"Member's Game Statistic");
$smarty->assign('aksi2',$aksi2);
$smarty->assign('showList',$showList);
$smarty->assign('showStatistic',$showStatistic);
$smarty->assign('showError',$showError);

$content = $smarty->fetch($template);
$smarty->assign('content',$content);


//======== Function =====================
function refreshList(&$smarty, &$showList, &$showStatistic, &$showError){
	$showList = true;
	$showStatistic = false;
	$showError = false;
}

function process(&$smarty, &$showList, &$showStatistic, &$showError){
	$showList = false;
			
	$member_id = trim($_POST['member_id']);
	$games_type = trim($_POST['gametype']);
	$date_first = trim($_POST['awal']);
	$date_last = trim($_POST['akhir']);
	
	$stat = new games_statistic();
	$result = $stat->getStatistic($member_id, $date_first, $date_last, $games_type);
	
	if(is_array($result)){
		$showStatistic = true;	
		
			$smarty->assign('members_id',$result['members']['id']);
			$smarty->assign('members_name',$result['members']['name']);
			$smarty->assign('members_club',$result['members']['club']);
			$smarty->assign('members_age',$result['members']['age']);
			$smarty->assign('sum_round',$result['data']['round']);
			$smarty->assign('sum_hole',$result['data']['hole']);
			$smarty->assign('sum_score',$result['data']['score']);
			$smarty->assign('sum_avgscore',$result['data']['avg_score']);
			$smarty->assign('sum_putts',$result['data']['putts']);
			$smarty->assign('sum_avgputts',$result['data']['avg_putts']);
			$smarty->assign('sum_saves',$result['data']['saves']);
			$smarty->assign('sum_fir',$result['data']['fir']);
			$smarty->assign('sum_firr',$result['data']['fir_ratio']);
			$smarty->assign('sum_gir',$result['data']['gir']);
			$smarty->assign('sum_girr',$result['data']['gir_ratio']);
			$smarty->assign('sum_fairways',$result['data']['fairways']);
			$smarty->assign('sum_rr',$result['data']['rr']);
			$smarty->assign('sum_lr',$result['data']['lr']);
			$smarty->assign('sum_bunkers',$result['data']['bunkers']);
			$smarty->assign('sum_penalties',$result['data']['penalties']);
			$smarty->assign('sum_hio',$result['data']['hole_in_one']);
			$smarty->assign('sum_condor',$result['data']['condor']);
			$smarty->assign('sum_albatros',$result['data']['albatros']);
			$smarty->assign('sum_eagles',$result['data']['eagles']);
			$smarty->assign('sum_birdies',$result['data']['birdies']);
			$smarty->assign('sum_pars',$result['data']['pars']);
			$smarty->assign('sum_bogeys',$result['data']['bogeys']);
			$smarty->assign('sum_dbogeys',$result['data']['dbogeys']);
			$smarty->assign('sum_tbogeys',$result['data']['tbogeys']);
			$smarty->assign('sum_others',$result['data']['others']);
			$smarty->assign('sum_par3avgscore',$result['data']['par3_avg_score']);
			$smarty->assign('sum_par4avgscore',$result['data']['par4_avg_score']);
			$smarty->assign('sum_par5avgscore',$result['data']['par5_avg_score']);		
			$smarty->assign('sum_par3hole',$result['data']['par3_hole']);
			$smarty->assign('sum_par4hole',$result['data']['par4_hole']);
			$smarty->assign('sum_par5hole',$result['data']['par5_hole']);								
	}else{
		$showError = true;	
	}
}
?>