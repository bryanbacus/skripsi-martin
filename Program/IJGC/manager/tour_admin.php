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
require_once(PATH_CLASS."/IJGA/parameter.class.php");

// declare var
$showList = false;
$showDetail = false;
$showPlayer = false;
$editDetail = false;


// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if(strtolower(trim($_POST['caribtn'])) == "search"){
	$aksi2 = "search";
}else if(strtolower(trim($_POST['filterbtn'])) == "filter & reload"){
	$aksi2 = "reload";
}else if(strtolower(trim($_POST['createbtn'])) == "create new tournaments"){
	$aksi2 = "create";
}else if(strtolower(trim($_POST['cancelbtn'])) == "cancel / back to list"){
	$aksi2 = "cancel";
}else if(strtolower(trim($_POST['cancelbtn'])) == "close / back to list"){
	$aksi2 = "register";
}else if(strtolower(trim($_POST['cancelbtn2'])) == "cancel / back to list"){
	$aksi2 = "player";
}else if(strtolower(trim($_POST['aksi2'])) == "updatelist"){
	$aksi2 = "updatelist";
}else if(strtolower(trim($_POST['aksi2'])) == "scoreplayer"){
	$aksi2 = "scoreplayer";
}else if(strtolower(trim($_POST['aksi2'])) == "resultplayer"){
	$aksi2 = "result";
}else if(strtolower(trim($_POST['addbtn'])) == "add tournaments"){
	$aksi2 = "addtour";
}else if(strtolower(trim($_POST['addbtn'])) == "save tournaments"){
	$aksi2 = "savetour";
}else if(strtolower(trim($_POST['addbtn'])) == "add / save round"){
	$aksi2 = "addround";
}else if(strtolower(trim($_POST['addbtn'])) == "add player"){
	$aksi2 = "addplayer";
}else if(strtolower(trim($_POST['addbtn'])) == "save player"){
	$aksi2 = "saveplayer";
}else if(strtolower(trim($_POST['addbtn'])) == "add selected"){
	$aksi2 = "savemember";
}else if(strtolower(trim($_POST['cariregbtn'])) == "search"){
	$aksi2 = "searchreg";
}else if(strtolower(trim($_POST['reloadregbtn'])) == "reload"){
	$aksi2 = "register";
}else if(strtolower(trim($_POST['approveregbtn'])) == "approved"){
	$aksi2 = "aprovereg";
}else if(strtolower(trim($_POST['cariplayerbtn'])) == "search"){
	$aksi2 = "cariplayer";
}else if(strtolower(trim($_POST['reloadplayerbtn'])) == "reload"){
	$aksi2 = "player";
}else if(strtolower(trim($_POST['createplayerbtn'])) == "add non-member"){
	$aksi2 = "createplayer";
}else if(strtolower(trim($_POST['createplayerbtn'])) == "add member"){
	$aksi2 = "createmember";
}else if(strtolower(trim($_POST['cancelplayerbtn'])) == "cancel & back to list"){
	$aksi2 = "player";
}else if(strtolower(trim($_POST['cancelparbtn'])) == "close"){
	$aksi2 = "player";
}else if(strtolower(trim($_POST['saveparbtn'])) == "save score"){
	$aksi2 = "savescore";
}else if(strtolower(trim($_POST['calculatebtn'])) == "calculate result tournaments"){
	$aksi2 = "calculate";
}

switch($aksi2){
	case "search":
		$template = "tour_admin.tpl";
		$showList = true;
		search($smarty);
		break;
	case "reload":
		$template = "tour_admin.tpl";
		$showList = true;
		reload($smarty);
		break;
	case "create":
		$template = "tour_admin.tpl";
		$showDetail = true;
		create($smarty);
		break;
	case "edit":
		$template = "tour_admin.tpl";
		$showDetail = true;
		$editDetail = true;
		editDetail($smarty, $_REQUEST['id']);
		break;	
	case "delete":
		$template = "tour_admin.tpl";
		delete($smarty);
		$showList = true;
		reload($smarty);
		break;			
	case "cancel":
		$template = "tour_admin.tpl";
		$showList = true;
		reload($smarty);
		break;		
	case "updatelist":
		$template = "tour_admin.tpl";
		$showDetail = true;
		updatelist($smarty);
		break;
	case "addtour":
		$template = "tour_admin.tpl";
		$showDetail = true;
		$hasil = addtour($smarty);
		if($hasil != ""){
			$editDetail = true;
			editDetail($smarty, $hasil);
		}else{
			$editDetail = false;
			create($smarty);
		}		
		break;
	case "savetour":
		$template = "tour_admin.tpl";
		$showList = true;
		savetour($smarty);
		reload($smarty);
		break;	
	case "addround":
		$template = "tour_admin.tpl";
		$showDetail = true;
		$editDetail = true;
		$id = addround($smarty);
		editDetail($smarty, $id);	
		break;
	case "editround":
		$template = "tour_admin.tpl";
		$showDetail = true;
		$editDetail = true;
		editRound($smarty);
		editDetail($smarty, $_REQUEST['id']);	
		break;
	case "delround":
		$template = "tour_admin.tpl";
		$showDetail = true;
		$editDetail = true;	
		delround($smarty);
		editDetail($smarty, $_REQUEST['id']);
		break;
	case "register":
		$template = "tour_register.tpl";
		$showList = true;
		showRegister($smarty);
		break;
	case "searchreg":
		$template = "tour_register.tpl";
		$showList = true;
		cariRegister($smarty);
		break;
	case "aprovereg":
		$template = "tour_register.tpl";
		$showList = true;
		aprovereg($smarty);
		showRegister($smarty);
		break;
	case "viewreg":
		$template = "tour_register.tpl";
		$showList = false;
		$showDetail = true;
		viewRegister($smarty);
		break;		
	case "player":
		$template = "tour_player.tpl";
		$showList = true;
		showPlayer($smarty);
		break;
	case "cariplayer":
		$template = "tour_player.tpl";
		$showList = true;
		cariPlayer($smarty);
		break;
	case "createplayer":
		$template = "tour_player.tpl";
		$showDetail = true;
		createplayer($smarty);
		break;
	case "createmember":
		$template = "tour_player.tpl";
		$showPlayer = true;
		createmember($smarty);
		break;				
	case "editplayer":
		$template = "tour_player.tpl";
		$showDetail = true;
		editplayer($smarty);
		break;	
	case "addplayer":
		$template = "tour_player.tpl";
		$showList = true;
		addplayer($smarty);
		showPlayer($smarty);
		break;	
	case "saveplayer":
		$template = "tour_player.tpl";
		$showList = true;
		saveplayer($smarty);
		showPlayer($smarty);
		break;	
	case "savemember":
		$template = "tour_player.tpl";
		$showList = true;
		savemember($smarty);
		showPlayer($smarty);
		break;				
	case "confirmplayer":
		$template = "tour_player.tpl";
		$showList = true;
		confirmplayer($smarty);
		showPlayer($smarty);	
		break;	
	case "delplayer":
		$template = "tour_player.tpl";
		$showList = true;
		delplayer($smarty);
		showPlayer($smarty);	
		break;
	case "scoreplayer":
		$template = "tour_player.tpl";
		$editDetail = true;
		editScore($smarty);
		break;
	case "savescore":
		$template = "tour_player.tpl";
		$editDetail = true;
		saveScore($smarty);
		editScore($smarty);
		break;								
	case "result":
		$template = "tour_result.tpl";
		$smarty->assign("admin", true);
		$showList = true;
		$showDetail = true;
		showResult($smarty);
		break;	
	case "calculate":
		$template = "tour_result.tpl";
		$smarty->assign("admin", true);
		$showList = true;
		$showDetail = true;
		calculate();
		showResult($smarty);
		break;		
	default:
		$template = "tour_admin.tpl";
		$showList = true;
		reload($smarty);
		break;	
}

$date_first = trim($_POST['awal']);
$date_last = trim($_POST['akhir']);
if ($date_first == "") $date_first =  date("Y/m/d");
if ($date_last == "") $date_last =  date("Y/m/d");

// assign template
$smarty->assign('awal',$date_first);
$smarty->assign('akhir',$date_last);

$smarty->assign('judul',"Tournaments Administration");
$smarty->assign('aksi2',$aksi2);
$smarty->assign('showList',$showList);
$smarty->assign('showDetail',$showDetail);
$smarty->assign('showPlayer',$showPlayer);
$smarty->assign('editDetail',$editDetail);

$content = $smarty->fetch($template);
$smarty->assign('content',$content);

//===================Function===============

// Search Tournaments
function search(&$smarty){
	$date_first = trim($_POST['awal']);
	$date_last = trim($_POST['akhir']);
	$column = trim($_POST['search_col']);	
	$value = trim($_POST['search_val']);
	
	$tour_fact = new tournament_factory();
	$list = $tour_fact->getTournamentsList($date_first, $date_last, "", "", $column, $value);
	
	$smarty->assign('datalist',$list);
	$smarty->assign('course_msg',"There are currently no such game practice. Click reload button to refresh.");
}

// Reload Tournaments
function reload(&$smarty){
	$date_first = trim($_POST['awal']);
	$date_last = trim($_POST['akhir']);
	
	$tour_fact = new tournament_factory();
	$list = $tour_fact->getTournamentsList($date_first, $date_last, "", "", "", "");
	
	$smarty->assign('datalist',$list);
	$smarty->assign('course_msg',"There are currently no tournaments. Please create one.");
}

// Create Tournaments
function create(&$smarty){
	$course = new course_factory();
	$course_list = $course->get_listSelect("");
	$smarty->assign('courselist',$course_list);
	$smarty->assign('evt_date',date("Y/m/d"));
	$smarty->assign('reg_date',date("Y/m/d"));
	$smarty->assign('max_player',"0");
	$smarty->assign('reward',"0");
	$smarty->assign('points',"0");
	$smarty->assign('u1','selected');
	$smarty->assign('addbtn',"Add Tournaments");
}

// Update Course List
function updatelist(&$smarty){
	$tour_id = trim($_POST['tour_id']);
	$tour_name = trim($_POST['tour_name']);
	$tour_place = trim($_POST['tour_place']);
	$tour_level = trim($_POST['tour_level']);
	$tour_type = trim($_POST['tour_type']);
	$evt_date = trim($_POST['evt_date']);
	$reg_date = trim($_POST['reg_date']);
	$course_id = trim($_POST['course']);
	$max_player = trim($_POST['max_player']);
	$reward = trim($_POST['reward']);
	$points = trim($_POST['points']);
	$tour_status = trim($_POST['tour_status']);
	$tour_desc = trim($_POST['notes']);
	
	$course = new course_factory();
	$course_list = $course->get_listSelect($course_id);
	$teelist = $course->get_teelistSelect($course_id);
	
	$smarty->assign('tour_id',$tour_id);
	$smarty->assign('tour_name',$tour_name);	
	$smarty->assign('tour_place',$tour_place);
	$smarty->assign('evt_date',$evt_date);
	$smarty->assign('reg_date',$reg_date);
	$smarty->assign('max_player',$max_player);
	$smarty->assign('reward',$reward);
	$smarty->assign('points',$points);		
	$smarty->assign('descr', $tour_desc);
	$smarty->assign('courselist',$course_list);	
	$smarty->assign('typelist',$teelist);
	
	switch($tour_level){
		case 1:
			$smarty->assign('s1','selected');
			break;
		case 2:
			$smarty->assign('s2','selected');
			break;
		case 3:
			$smarty->assign('s3','selected');
			break;
		case 4:
			$smarty->assign('s4','selected');
			break;
		case 5:
			$smarty->assign('s5','selected');
			break;
	}	

	switch($tour_type){
		case 1:
			$smarty->assign('t1','selected');
			break;
		case 2:
			$smarty->assign('t2','selected');
			break;
		case 3:
			$smarty->assign('t3','selected');
			break;
		case 4:
			$smarty->assign('t4','selected');
			break;
	}	
	
	switch($tour_status){
		case 1:
			$smarty->assign('u1','selected');
			break;
		case 2:
			$smarty->assign('u2','selected');
			break;
	}		

	if($tour_id == ""){
		$smarty->assign('addbtn',"Add Tournaments");
		$editDetail = false;
	}else{
		$smarty->assign('addbtn',"Save Tournaments");
		$editDetail = true;
		showRound($smarty, $tour_id);
	}		
}

// Edit Detail
function editDetail(&$smarty, $tour_id){
	$fact = new tournament_factory();
	$tour = $fact->getTournaments($tour_id);
		
	$course = new course_factory();
	$course_list = $course->get_listSelect($tour->course_id);
	$teelist = $course->get_teelistSelect($tour->course_id, $tour->teebox);
	
	$smarty->assign('tour_id',$tour->id);
	$smarty->assign('tour_name',$tour->name);	
	$smarty->assign('tour_place',$tour->place);
	$evt_date = substr($tour->evt_date,0,4)."/".substr($tour->evt_date,5,2)."/".substr($tour->evt_date,8,2);
	$smarty->assign('evt_date',$evt_date);
	$reg_date = substr($tour->reg_date,0,4)."/".substr($tour->reg_date,5,2)."/".substr($tour->reg_date,8,2);
	$smarty->assign('reg_date',$reg_date);
	$smarty->assign('max_player',$tour->max_player);
	$smarty->assign('reward',$tour->reward);
	$smarty->assign('points',$tour->points);		
	$smarty->assign('descr', $tour->desc);
	$smarty->assign('courselist',$course_list);	
	$smarty->assign('typelist',$teelist);
	
	switch($tour->level){
		case 1:
			$smarty->assign('s1','selected');
			break;
		case 2:
			$smarty->assign('s2','selected');
			break;
		case 3:
			$smarty->assign('s3','selected');
			break;
		case 4:
			$smarty->assign('s4','selected');
			break;
		case 5:
			$smarty->assign('s5','selected');
			break;
	}	

	switch($tour->type){
		case 1:
			$smarty->assign('t1','selected');
			break;
		case 2:
			$smarty->assign('t2','selected');
			break;
		case 3:
			$smarty->assign('t3','selected');
			break;
		case 4:
			$smarty->assign('t4','selected');
			break;
	}	
	
	switch($tour->status){
		case 1:
			$smarty->assign('u1','selected');
			break;
		case 2:
			$smarty->assign('u2','selected');
			break;
	}
	$smarty->assign('addbtn',"Save Tournaments");
	
	showRound($smarty, $tour->id);
}

// Add Tournaments
function addtour(&$smarty){
	$fact = new tournament_factory();
	$tour = new tournaments();
	
	$tour->id = trim($_POST['tour_id']);
	$tour->name = trim($_POST['tour_name']);
	$tour->place = trim($_POST['tour_place']);
	$tour->level = trim($_POST['tour_level']);
	$tour->type = trim($_POST['tour_type']);
	$tour->evt_date = trim($_POST['evt_date']);
	$tour->reg_date = trim($_POST['reg_date']);
	$tour->course_id = trim($_POST['course']);
	$tour->teebox = trim($_POST['tee']);
	$tour->max_player = trim($_POST['max_player']);
	$tour->reward = trim($_POST['reward']);
	$tour->points = trim($_POST['points']);
	$tour->status = trim($_POST['tour_status']);
	$tour->desc = trim($_POST['notes']);
	
	$hasil = $fact->create_tournaments($tour);
	return $hasil;
}

// Save Tournaments
function savetour(&$smarty){
	$fact = new tournament_factory();
	$tour = new tournaments();
	
	$tour->id = trim($_POST['tour_id']);
	$tour->name = trim($_POST['tour_name']);
	$tour->place = trim($_POST['tour_place']);
	$tour->level = trim($_POST['tour_level']);
	$tour->type = trim($_POST['tour_type']);
	$tour->evt_date = trim($_POST['evt_date']);
	$tour->reg_date = trim($_POST['reg_date']);
	$tour->course_id = trim($_POST['course']);
	$tour->teebox = trim($_POST['tee']);
	$tour->max_player = trim($_POST['max_player']);
	$tour->reward = trim($_POST['reward']);
	$tour->points = trim($_POST['points']);
	$tour->status = trim($_POST['tour_status']);
	$tour->desc = trim($_POST['notes']);
	
	$fact->update_tournaments($tour);
}

// Delete Tournaments
function delete(&$smarty){
	$tour_id = trim($_REQUEST['id']);
	$fact = new tournament_factory();
	$fact->remove_tournaments($tour_id);
}

// Show Round List
function showRound(&$smarty, $tour_id){
	$tour = new Tournaments($tour_id);
	$date =  date("Y/m/d");
	$smarty->assign('round_date', $date);
	$smarty->assign('datalist', $tour->getRoundList());
}

// Add / Save Round
function addround(&$smarty){
	$id = trim($_POST['tour_id']);
	$sid = trim($_POST['round_id']);
	$round_no = trim($_POST['round_no']);
	$_POST['time1'] = ($_POST['time1'] == "") ? "00" : $_POST['time1'];
	$_POST['time2'] = ($_POST['time2'] == "") ? "00" : $_POST['time2'];
	$round_datep = $_POST['round_date']." ".$_POST['time1'].":".$_POST['time2'] .":00";
	$weather = trim($_POST['round_weather']);
	$rule = trim($_POST['round_playrule']);
	$note = trim($_POST['notes']);
	$tour = new tournaments($id);	
	if($sid == "") {
		$tour->add_round($round_no, $round_datep, $weather, $rule, $note);
	}else{
		$tour->update_round($sid, $round_no, $round_datep, $weather, $rule, $note);
	}	
	return $id;
}

// Edit Round
function editRound(&$smarty){
	$tour_id = trim($_REQUEST['id']);
	$round_id = trim($_REQUEST['sid']);
	
	$tournaments = new tournaments($tour_id);
	$data = $tournaments->getRound($round_id);

	switch($data[0]['round_no']){
		case 1:
			$smarty->assign("a1", "selected");
			break;
		case 2:
			$smarty->assign("a2", "selected");
			break;
		case 3:
			$smarty->assign("a3", "selected");
			break;
		case 4:
			$smarty->assign("a4", "selected");
			break;
		case 5:
			$smarty->assign("a5", "selected");
			break;												
	}
	$smarty->assign("round_date", $data[0]['round_date']);
	$smarty->assign("jam", substr($data[0]['round_date'],11,2));
	$smarty->assign("menit", substr($data[0]['round_date'],14,2));
	switch(strtolower(trim($data[0]['round_weather']))){
		case "sunny":
			$smarty->assign("b1", "selected");
			break;
		case "cloudy":
			$smarty->assign("b2", "selected");
			break;
		case "dry":
			$smarty->assign("b3", "selected");
			break;
		case "rainy":
			$smarty->assign("b4", "selected");
			break;
		case "misty":
			$smarty->assign("b5", "selected");
			break;					
		case "wet":
			$smarty->assign("b6", "selected");
			break;	
		case "windy":
			$smarty->assign("b7", "selected");
			break;	
		case "others":
			$smarty->assign("b8", "selected");
			break;																	
	}
	switch($data[0]['round_rule']){
		case 1:
			$smarty->assign("h1", "selected");
			break;
		case 2:
			$smarty->assign("h2", "selected");
			break;
		case 3:
			$smarty->assign("h3", "selected");
			break;
	}
	$smarty->assign("round_note", $data[0]['round_note']);
	$smarty->assign("round_id", $data[0]['round_id']);
}

// Delete round
function delround(&$smarty){
	$id = trim($_REQUEST['id']);
	$sid = trim($_REQUEST['sid']);
	$tour = new tournaments($id);	
	$tour->remove_round($sid);
}

// Show Register
function showRegister(&$smarty){
	$tour_id = trim($_REQUEST['id']);
	
	$register = new tournaments_register($tour_id);
	$datalist = $register->get_registerlist();
	
	$smarty->assign('datalist',$datalist);
	$smarty->assign('course_msg',"There are currently no register player.");	
}

// Cari Register
function cariRegister(&$smarty){
	$tour_id = trim($_REQUEST['id']);
	$column = trim($_POST['search_col']);	
	$value = trim($_POST['search_val']);
		
	$register = new tournaments_register($tour_id);
	$datalist = $register->get_registerlist("", "", $column, $value);
	
	$smarty->assign('datalist',$datalist);
	$smarty->assign('course_msg',"There are currently no register player match by criteria.");	
}

// Approve Register
function aprovereg(&$smarty){
	$tour_id = trim($_REQUEST['id']);
	$indent_id = trim($_REQUEST['sid']);
	
	$register = new tournaments_register($tour_id);
	$register->approve_indentRegistrant($indent_id);
}

// View Register
function viewRegister(&$smarty){
	$tour_id = trim($_REQUEST['id']);
	$indent_id = trim($_REQUEST['sid']);
	
	$register = new tournaments_register($tour_id);
	$arrList = $register->get_registrant($indent_id);	
	
	$smarty->assign("indent_id",$arrList[0]['indent_id']);
	$smarty->assign("tour_id",$arrList[0]['tour_id']);
	$smarty->assign("reg_date",$arrList[0]['register_date']);
	$smarty->assign("player_member_id",$arrList[0]['player_members_id']);
	$smarty->assign("player_name",$arrList[0]['player_name']);
	$smarty->assign("age",$arrList[0]['player_age']);
	$smarty->assign("birth_date",$arrList[0]['player_birthdate']);
	$smarty->assign("parent_name",$arrList[0]['player_parents_name']);
	$smarty->assign("contact_no",$arrList[0]['player_contactno']);
	$smarty->assign("email",$arrList[0]['player_email']);
	$smarty->assign("address",$arrList[0]['player_home_address']);
	$smarty->assign("group",$arrList[0]['player_group']);
	$smarty->assign("approved",$arrList[0]['player_approved']);	
}

// Show Player
function showPlayer(&$smarty){
	$tour_id = trim($_REQUEST['id']);
	
	$tournaments = new tournaments($tour_id);
	$datalist = $tournaments->getPlayerList();
	
	$smarty->assign('datalist',$datalist);
	$smarty->assign('course_msg',"There are currently no register player.");	
}

// Cari Player
function cariPlayer(&$smarty){
	$tour_id = trim($_REQUEST['id']);
	$column = trim($_POST['search_col']);	
	$value = trim($_POST['search_val']);
		
	$tournaments = new tournaments($tour_id);
	$datalist = $tournaments->getPlayerList("", "", $column, $value);
	
	$smarty->assign('datalist',$datalist);
	$smarty->assign('course_msg',"There are currently no player match by player.");	
}

// Create Player
function createplayer(&$smarty){
	$smarty->assign('tour_id',trim($_REQUEST['id']));
	$smarty->assign('birth_date',date("Y/m/d"));
	$smarty->assign('a2','selected');
	$smarty->assign('addbtn',"Add Player");
}

// Create member
function createmember(&$smarty){
	$tour_id = trim($_REQUEST['id']);
	
	$tournaments = new tournament_factory();
	$datalist = $tournaments->getMemberList();
	
	$smarty->assign('datalist',$datalist);
}

// Edit Player
function editplayer(&$smarty){
	$tournaments = new tournaments(trim($_REQUEST['id']));
	$arrList = $tournaments->getPlayer($_REQUEST['sid']);
	
	$smarty->assign('tour_id',$arrList[0]['tour_id']);
	$smarty->assign('player_id',$arrList[0]['player_id']);
	$smarty->assign('player_member',$arrList[0]['player_members_id']);
	$smarty->assign('player_name',$arrList[0]['player_name']);
	$smarty->assign('player_age',$arrList[0]['player_age']);
	$smarty->assign('birth_date',substr($arrList[0]['player_birthdate'],0,4)."/".substr($arrList[0]['player_birthdate'],5,2)."/".substr($arrList[0]['player_birthdate'],8,2));
	$smarty->assign('player_parents',$arrList[0]['player_parents_name']);
	$smarty->assign('player_contactno',$arrList[0]['player_contactno']);
	$smarty->assign('player_email',$arrList[0]['player_email']);
	$smarty->assign('player_home_address',$arrList[0]['player_home_address']);
	
	switch($arrList[0]['player_group']){
		case "A":
			$smarty->assign("g1", "selected");
			break;
		case "B":
			$smarty->assign("g2", "selected");
			break;
		case "C":
			$smarty->assign("g3", "selected");
			break;
		case "D":
			$smarty->assign("g4", "selected");
			break;
		case "E":
			$smarty->assign("g5", "selected");
			break;												
	}

	$smarty->assign('addbtn',"Save Player");
}

// Add Player
function addplayer(&$smarty){
	$player = new player();
	$tournaments = new tournaments(trim($_POST['tour_id']));
	
	$player->player_id = "";
	$player->tour_id = trim($_POST['tour_id']);
	$player->player_members_id = trim($_POST['player_member']);
	$player->player_name = trim($_POST['player_name']);
	$player->player_age = trim($_POST['player_age']);
	$player->player_birthdate = trim($_POST['birth_date']);
	$player->player_parents_name = trim($_POST['player_parents']);
	$player->player_contactno = trim($_POST['player_contactno']);
	$player->player_email = trim($_POST['player_email']);
	$player->player_home_address = trim($_POST['player_home_address']);
	$player->player_group = trim($_POST['player_group']);
	$player->player_confirmed = 0;
	
	$tournaments->add_player($player);
}

// Save Player
function saveplayer(&$smarty){
	$player = new player();
	$tournaments = new tournaments(trim($_POST['tour_id']));
	
	$player->player_id = trim($_POST['player_id']);
	$player->tour_id = trim($_POST['tour_id']);
	$player->player_members_id = trim($_POST['player_member']);
	$player->player_name = trim($_POST['player_name']);
	$player->player_age = trim($_POST['player_age']);
	$player->player_birthdate = trim($_POST['birth_date']);
	$player->player_parents_name = trim($_POST['player_parents']);
	$player->player_contactno = trim($_POST['player_contactno']);
	$player->player_email = trim($_POST['player_email']);
	$player->player_home_address = trim($_POST['player_home_address']);
	$player->player_group = trim($_POST['player_group']);
	
	$tournaments->update_player($player);
}

// Save Member
function savemember(&$smarty){
	$list = $_POST['member_id'];
	$tour_id = trim($_REQUEST['id']);
	$tournaments_factory = new tournament_factory();
	$tournaments = new tournaments($tour_id);
	
	foreach($list as $val){	
		$data = $tournaments_factory->getMember($val);

		$player = new player();
		$player->player_id = "";
		$player->tour_id = $tour_id;
		
		$player->player_members_id = $data['player_members_id'];
		$player->player_name = $data['player_name'];
		$player->player_age = $data['player_age'];
		$player->player_birthdate = $data['birth_date'];
		$player->player_parents_name = $data['player_parents_name'];
		$player->player_contactno = $data['player_contactno'];
		$player->player_email = $data['player_email'];
		$player->player_home_address = $data['player_home_address'];
		$player->player_group = $data['player_group'];
		
		$tournaments->add_player($player);	
	}
}

// Confirm Player
function confirmplayer(&$smarty){
	$tournaments = new tournaments(trim($_REQUEST['id']));
	$tournaments->confirm_player($_REQUEST['sid']);
}

// Delete Player
function delplayer(&$smarty){
	$tournaments = new tournaments(trim($_REQUEST['id']));
	$tournaments->remove_player($_REQUEST['sid']);
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

function calculate(){
	$tour_id = trim($_REQUEST['id']);
	
	$tournaments = new tournament_factory();
	$tournaments->CalculateTournaments($tour_id);
}

function editScore(&$smarty){
	$select = $_POST['id_round'];
	$none = true;
	
	$tournaments = new tournaments(trim($_REQUEST['id']));
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
	
	// Get Games ID
	$id_player = $_REQUEST['sid'];
	$id_round = $list[$mark]['value'];
	$games_id = $tournaments->getGamesID($id_round, $id_player);
	$smarty->assign('games_id', $games_id);	

	drawScore($smarty, $games_id);
}

function drawScore(&$smarty, $games_id){
	$games = new games($games_id);
	$data = $games->getDetail();
	
	for($a=1;$a<=18;$a++){
		$smarty->assign('hole'.$a.'_length', $data[$a]["length"]);
		$smarty->assign('hole'.$a.'_par', $data[$a]["par"]);
		$smarty->assign('hole'.$a.'_score', ($data[$a]["score"] == "0") ? "" : $data[$a]["score"]);
	}
}

function saveScore(&$smarty){
	$games_id = trim($_POST['games_id']);
	$games = new games($games_id);
	for($i=1;$i<=18;$i++){
		$field_par = "hole".$i."_par";
		$field_score = "hole".$i."_score";
		$hole = $i;
		$par = trim($_POST[$field_par]);
		$score = trim($_POST[$field_score]);
		
		$games->updateScore($hole, $par, $score);
	}
	$games->calculate();
	$smarty->assign('msg', 'Score berhasil disimpan');
}

?>