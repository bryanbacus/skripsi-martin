<?php

if(!defined("NODIRECT")){
	die("No direct Access !!");
}

require_once(PATH_IJGA."/IJGC/course.class.php");
require_once(PATH_IJGA."/IJGC/games.class.php");
require_once(PATH_IJGA."/IJGC/tournaments.class.php");

// declare var
$showList = false;
$showDetail = false;
$editDetail = false;

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if(strtolower(trim($_POST['cancelbtn'])) == "cancel / back to list"){
	$aksi2 = "cancel";
}else if(strtolower(trim($_POST['filterbtn'])) == "filter tournaments"){
	$aksi2 = "filter";
}

switch($aksi2){
	case "cancel":
		$template = "tour_rest.tpl";
		$showList = true;
		reload($smarty);
		break;		
	case "result":
		$template = "tour_result.tpl";
		$showList = true;
		$showDetail = true;
		showResult($smarty);
		break;	
	case "filter":
		$template = "tour_rest.tpl";
		$smarty->assign("batas", true);
		$showList = true;	
		filter($smarty);
		break;
	default:
		$template = "tour_rest.tpl";
		$showList = true;
		reload($smarty);
		break;	
}

// assign template
$smarty->assign('judul',"Tournaments Event List");
$smarty->assign('aksi2',$aksi2);
$smarty->assign('tahun',genYear((isset($_POST['filter_thn']))? $_POST['filter_thn'] : date("Y")));
$smarty->assign('showList',$showList);
$smarty->assign('showDetail',$showDetail);

$content = $smarty->fetch($template);
$smarty->assign('content',$content);

//===================Function===============

// Reload Tournaments
function reload(&$smarty){
	$date_first = trim($_POST['awal']);
	$date_last = trim($_POST['akhir']);
	
	$tour_fact = new tournament_factory();
	$list = $tour_fact->getTournamentsOpenTopFive(5, 0, 2);
	
	$smarty->assign('datalist',$list);
	$smarty->assign('course_msg',"There are currently no tournaments.");
}

function filter(&$smarty){
	$year = trim($_POST['filter_thn']);
	$level = trim($_POST['tour_level']);
	$type = trim($_POST['tour_type']);
	
	switch($level){
		case 1:
			$smarty->assign("s1", "selected");
			break;
		case 2:
			$smarty->assign("s2", "selected");
			break;
		case 3:
			$smarty->assign("s3", "selected");
			break;
		case 4:
			$smarty->assign("s4", "selected");
			break;
		case 5:
			$smarty->assign("s5", "selected");
			break;
	}

	switch($type){
		case 1:
			$smarty->assign("t1", "selected");
			break;
		case 2:
			$smarty->assign("t2", "selected");
			break;
		case 3:
			$smarty->assign("t3", "selected");
			break;
		case 4:
			$smarty->assign("t4", "selected");
			break;
	}
			
	if($year == "")  $year = date("Y");
	if($level == "")  $level = "all";
	if($type  == "")  $type = "all";
	
	$tour_fact = new tournament_factory();
	$list = $tour_fact->getTournamentsHistory($year, $level, $type);
	
	$smarty->assign('datalist',$list);
	$smarty->assign('course_msg',"There are currently no tournaments.");
}

// Show Result
function showResult(&$smarty){
	$tour_id = trim($_REQUEST['id']);
	
	$tournaments = new tournaments($tour_id);
	$datalist = $tournaments->getPositionList();
	
	$smarty->assign('datalist',$datalist);
	$smarty->assign('course_msg',"There are currently no register player.");
	
	//drawresult
	$select = $_POST['id_round'];
	$none = true;
	$data = $tournaments->getRoundList();
	$key = 0;
	$mark = 0;
	foreach($data as $var){
		switch($var['round_no']){
			case 1:
				$nama = "First";
				break;
			case 2:
				$nama = "Second";
				break;
			case 3:
				$nama = "Third";
				break;
			case 4:
				$nama = "Fourth";
				break;
			case 5:
				$nama = "Fifth";
				break;
			default:
				$nama = "";
				break;																				
		}
		$list[$key]['param'] = $nama;
		$list[$key]['value'] = $var['round_id'];
		$list[$key]['selected'] = "";
		if($select == $var['round_id']){
			$list[$key]['selected'] = "selected";
			$none = false;
			$mark = $key;
		}
		$key++;	
	}
	if($none) $list[0]['selected'] = "selected";
	$smarty->assign('list', $list);
	
	$tour_fact = new tournament_factory();
	$capek = $tour_fact->getTournaments($tour_id);
	
	$course_fact = new course_factory();	
	$course = $course_fact->get_course($capek->course_id);
		
	$par = $course->get_detail();
	$hole = $par["hole"];
	$key = 1;
	$in_par = 0;
	$out_par = 0;
		
	for($j=0;$j<=18;$j++){
		$par = $hole[$j]["par"];
		if($j <= 8) {
			$out_par += $par;
		}else{
			$in_par += $par;
		}

		$smarty->assign('hole'.$key.'_par', $par);
		$key++;
	}
	$smarty->assign('out_par', $out_par);
	$smarty->assign('in_par', $in_par);
	$smarty->assign('total_par', $in_par + $out_par);
	
	$id_round = $list[$mark]['value'];
	$restlist = $capek->getResultRound($id_round);
	$smarty->assign('playerlist', $restlist);
}

function genYear($year = ""){
	$key = 2007;
	$arrlist = array();
	for($a=0;$a<=10;$a++) {	
		$arrlist[$a]['value'] = $key + $a;
		if($year == $arrlist[$a]['value']) $arrlist[$a]['selected'] = "selected=\"selected\"";
	}	
	return $arrlist;
}
?>