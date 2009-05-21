<?php

if(!defined("NODIRECT")){
	die("No direct Access !!");
}
if($_SESSION['levelUser']!=1){
	header("Location:index.php");
}

require_once(PATH_CLASS."/IJGA/course.class.php");
require_once(PATH_CLASS."/IJGA/games.class.php");
require_once(PATH_CLASS."/IJGA/tournaments.class.php");

// declare var
$showList = false;
$showDetail = false;
$editDetail = false;

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if(strtolower(trim($_POST['cancelbtn'])) == "close & back to list"){
	$aksi2 = "cancel";
}else if(strtolower(trim($_POST['cancelbtn'])) == "close & back to tournaments list"){
	$aksi2 = "cancel";
}else if(strtolower(trim($_POST['addbtn'])) == "register me!"){
	$aksi2 = "addreg";
}

switch($aksi2){
	case "edit":
		$template = "tour_list.tpl";
		$showDetail = true;
		editDetail($smarty, $_REQUEST['id']);
		break;	
	case "cancel":
		$template = "tour_list.tpl";
		$showList = true;
		reload($smarty);
		break;		
	case "register":
		$template = "tour_reg.tpl";
		$showDetail = true;
		showForm($smarty);
		break;			
	case "addreg":
		$template = "tour_reg.tpl";
		$hasil = addReg($smarty);
		if($hasil){
			$showDetail = false;
			$smarty->assign('showSukses',true);
		}else{
			$showDetail = true;
			showForm($smarty);
		}
		break;				
	default:
		$template = "tour_list.tpl";
		$showList = true;
		reload($smarty);
		break;	
}

// assign template
$smarty->assign('judul',"Tournaments Event List");
$smarty->assign('aksi2',$aksi2);
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
	$list = $tour_fact->getTournamentsOpenTopFive();
	
	$smarty->assign('datalist',$list);
	$smarty->assign('course_msg',"There are currently no tournaments. Please create one.");
}

// Edit Detail
function editDetail(&$smarty, $tour_id){
	$fact = new tournament_factory();
	$tour = $fact->getTournaments($tour_id);
		
	$course = new course_factory();
	$course_list = $course->get_course($tour->course_id);
	$teelist = $course->get_teelistSelect($tour->course_id, $tour->teebox);
	
	$smarty->assign('tour_id',$tour->id);
	$smarty->assign('tour_name',$tour->name);	
	$smarty->assign('tour_place',$tour->place);
	$smarty->assign('evt_date',substr($tour->evt_date,0,4)."/".substr($tour->evt_date,5,2)."/".substr($tour->evt_date,8,2));
	$smarty->assign('reg_date',substr($tour->reg_date,0,4)."/".substr($tour->reg_date,5,2)."/".substr($tour->reg_date,8,2));
	$smarty->assign('max_player',$tour->max_player);
	$smarty->assign('reward',$tour->reward);
	$smarty->assign('points',$tour->points);		
	$smarty->assign('descr', $tour->desc);
	$smarty->assign('courselist',$course_list->course_name);	
	$smarty->assign('typelist',$teelist);
	
	switch($tour->level){
		case 1:
			$smarty->assign('s1','International');
			break;
		case 2:
			$smarty->assign('s1','National');
			break;
		case 3:
			$smarty->assign('s1','Regional');
			break;
		case 4:
			$smarty->assign('s1','Open');
			break;
		case 5:
			$smarty->assign('s1','Others');
			break;
	}	
	switch($tour->type){
		case 1:
			$smarty->assign('t1','Open');
			break;
		case 2:
			$smarty->assign('t1','Invitational');
			break;
		case 3:
			$smarty->assign('t1','Closed / Internal Only');
			break;
		case 4:
			$smarty->assign('t1','Others');
			break;
	}	
	switch($tour->status){
		case 1:
			$smarty->assign('u1','Open / Incoming');
			break;
		case 2:
			$smarty->assign('u1','Close / Match Play');
			break;
	}

	showRound($smarty, $tour->id);
}

// Show Round List
function showRound(&$smarty, $tour_id){
	$tour = new Tournaments($tour_id);
	$smarty->assign('round_date', date("Y/m/d"));
	$smarty->assign('datalist', $tour->getRoundList());
}

// Show Register Form
function showForm(&$smarty){
	$tour_fact = new tournament_factory();
	$list = $tour_fact->getTournamentsOpenTopFive();
	
	$smarty->assign('birth_date',date("Y/m/d"));
	$smarty->assign('list',$list);
}

function addReg(&$smarty){
	$lanjut = true;
	if(($_REQUEST['tour_id'] == "") || ($_REQUEST['tour_id'] == "value")) $lanjut = false;
	if($_REQUEST['player_name'] == "") $lanjut = false;
	if($_REQUEST['player_parents'] == "") $lanjut = false;
  if($_REQUEST['player_contactno'] == "") $lanjut = false;
  if($_REQUEST['player_home_address'] == "") $lanjut = false;
  
	$player = new player();
	$player->tour_id = $_REQUEST['tour_id'];
	$player->player_members_id = $_REQUEST['player_member'];
	$player->player_name= $_REQUEST['player_name'];
	$player->player_age = $_REQUEST['player_age'];
	$player->player_birthdate = $_REQUEST['birth_date'];
	$player->player_parents_name = $_REQUEST['player_parents'];
	$player->player_contactno = $_REQUEST['player_contactno'];
	$player->player_email = $_REQUEST['player_email'];
	$player->player_home_address = $_REQUEST['player_home_address'];
	$player->player_group = $_REQUEST['player_group'];

	$register = new tournaments_register("");
	if($lanjut) $register->create_indentRegistrant($player);
	return $lanjut;
}
?>