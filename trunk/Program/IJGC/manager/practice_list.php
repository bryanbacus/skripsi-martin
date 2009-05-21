<?php

if(!defined("NODIRECT")){
	die("No direct Access !!");
}
if($_SESSION['levelUser']!=1){
	header("Location:index.php");
}

require_once(PATH_CLASS."/IJGA/course.class.php");
require_once(PATH_CLASS."/IJGA/games.class.php");

// declare var
$template = "practice_list.tpl";
$showList = false;
$showDetail = false;
$editDetail = false;
$showScore = false;
$showFirst = false;
$showSecond = false;

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if(strtolower(trim($_POST['caribtn'])) == "search"){
	$aksi2 = "search";
}else if(strtolower(trim($_POST['filterbtn'])) == "filter & reload"){
	$aksi2 = "reload";
}else if(strtolower(trim($_POST['createbtn'])) == "create a practice course"){
	$aksi2 = "create";
}else if(strtolower(trim($_POST['addbtn'])) == "add practice"){
	$aksi2 = "addpractice";
}else if(strtolower(trim($_POST['addbtn'])) == "save practice"){
	$aksi2 = "savepractice";
}else if(isset($_POST['cancelbtn'])){
	$aksi2 = "cancel";
}else if(strtolower(trim($_POST['saveparbtn'])) == "save"){
	$aksi2 = "savescore";
}else if(strtolower(trim($_POST['cancelparbtn'])) == "cancel"){
	$aksi2 = "edit";
}else if(strtolower(trim($_POST['savefirstbtn'])) == "save"){
	$aksi2 = "savefirst";
}else if(strtolower(trim($_POST['savesecondbtn'])) == "save"){
	$aksi2 = "savesecond";
}else if(strtolower(trim($_POST['validatebtn'])) == "check id"){
	$aksi2 = "checklist";
}else if(strtolower(trim($_POST['aksi2'])) == "updatelist"){
	$aksi2 = "updatelist";
}

// Process aksi2
switch($aksi2){
	case "search":
		searchList($smarty, $showList);
		break;
	case "reload":
		refreshList($smarty, $showList);
		break;
	case "create":
		$showDetail = true;
		$editDetail = false;
		create_practice($smarty);
		break;
	case "edit":
		$showDetail = true;
		$editDetail = true;	
		edit_practice($smarty,trim($_REQUEST['id']));
		break;
	case "delete":
		del_practice(trim($_REQUEST['id']));
		refreshList($smarty, $showList);
		break;
	case "cancel":
		refreshList($smarty, $showList);
		break;	
	case "addpractice":
		$hasil = add_practice($smarty);
		
		$showDetail = true;	
		if($hasil != ""){
			$editDetail = true;
			edit_practice($smarty, $hasil);
			drawScoreCare($smarty, $hasil);
		}else{
			$editDetail = false;
			create_practice($smarty);
		}
		break;
	case "savepractice":
		save_practice($smarty);
		refreshList($smarty, $showList);
		break;			
	case "checklist":
		$showDetail = true;
		checklist($smarty, $editDetail);
		break;
	case "updatelist":
		$showDetail = true;
		updatelist($smarty, $editDetail);
		break;			
	case "editscore":
		$showScore = true;
		editScore($smarty, $_REQUEST['id']);
		break;
	case "savescore":
		saveScore();	
		$showDetail = true;
		$editDetail = true;	
		edit_practice($smarty,trim($_REQUEST['id']));		
		break;	
	case "firststroke":
		$showFirst = true;
		editScore($smarty, $_REQUEST['id']);		
		break;
	case "savefirst":
		saveFirst();
		$showDetail = true;
		$editDetail = true;	
		edit_practice($smarty,trim($_REQUEST['id']));			
		break;
	case "secondstroke":
		$showSecond = true;
		editScore($smarty, $_REQUEST['id']);		
		break;			
	case "savesecond":
		saveSecond();
		$showDetail = true;
		$editDetail = true;	
		edit_practice($smarty,trim($_REQUEST['id']));			
		break;
	default:
		refreshList($smarty, $showList);
		break;	
}

$date_first = trim($_POST['awal']);
$date_last = trim($_POST['akhir']);
if ($date_first == "") $date_first =  date("Y/m/d");
if ($date_last == "") $date_last =  date("Y/m/d");

// assign template
$smarty->assign('awal',$date_first);
$smarty->assign('akhir',$date_last);
$smarty->assign('judul',"Members's Practice List");
$smarty->assign('aksi2',$aksi2);
$smarty->assign('showList',$showList);
$smarty->assign('showDetail',$showDetail);
$smarty->assign('editDetail',$editDetail);
$smarty->assign('showScore',$showScore);
$smarty->assign('showFirst',$showFirst);
$smarty->assign('showSecond',$showSecond);

$content = $smarty->fetch($template);
$smarty->assign('content',$content);


//======== Function =====================
function searchList(&$smarty, &$showList){
	$date_first = trim($_POST['awal']);
	$date_last = trim($_POST['akhir']);
	$column = trim($_POST['search_col']);	
	$value = trim($_POST['search_val']);
	
	$showList = true;
	$games_fact = new games_factory();
	$game_list = $games_fact->getGamesList($date_first, $date_last, "", "", $column, $value);
	$smarty->assign('gameslist',$game_list);
	$smarty->assign('course_msg',"There are currently no such game practice. Click reload button to refresh.");
}

function refreshList(&$smarty, &$showList){
	$date_first = trim($_POST['awal']);
	$date_last = trim($_POST['akhir']);
	
	$showList = true;
	$games_fact = new games_factory();
	$game_list = $games_fact->getGamesList($date_first, $date_last);
	$smarty->assign('gameslist',$game_list);
	$smarty->assign('course_msg',"There are currently no game practice. Please create one.");
}

function create_practice(&$smarty){
	$course = new course_factory();
	$course_list = $course->get_listSelect("");
	$smarty->assign('courselist',$course_list);
	$smarty->assign('addbtn',"Add Practice");
	
	$smarty->assign('memberid',"");
	$smarty->assign('members_desc',"type the ID Member, and click the Check ID button to verify");
	$smarty->assign('desc',"type the ID Member, and click the Check ID button to verify");
	$smarty->assign('tanggal',date("Y/m/d"));
	$smarty->assign('jam',date("H"));
	$smarty->assign('menit',date("i"));
}

function edit_practice(&$smarty,$games_id){
	$games_fact = new games_factory();
	$games = $games_fact->getGames($games_id);
		
	$course = new course_factory();
	$course_list = $course->get_listSelect($games->course_id);
	$teelist = $course->get_teelistSelect($games->course_id, $games->course_length_id);
	
	$smarty->assign('games_id',$games->games_id);
	$smarty->assign('valid','valid');
	$smarty->assign('memberid',$games->members_id);
	$smarty->assign('members_desc',$games->members_name);
	$smarty->assign('desc',$games->members_name);
	$smarty->assign('tanggal',substr($games->games_date,0,4)."/".substr($games->games_date,5,2)."/".substr($games->games_date,8,2));
	$smarty->assign('jam',substr($games->games_date,11,2));
	$smarty->assign('menit',substr($games->games_date,14,2));
	
	switch(strtolower(trim($games->games_weather))){
		case "sunny":
			$smarty->assign('s1','selected');
			break;
		case "cloudy":
			$smarty->assign('s2','selected');
			break;
		case "dry":
			$smarty->assign('s3','selected');
			break;
		case "rainy":
			$smarty->assign('s4','selected');
			break;
		case "misty":
			$smarty->assign('s5','selected');
			break;
		case "wet":
			$smarty->assign('s6','selected');
			break;
		case "windy":
			$smarty->assign('s7','selected');
			break;
		case "others":
			$smarty->assign('s8','selected');
			break;
	}
	
	switch(strtolower(trim($games->games_holeplay))){
		case 1:
			$smarty->assign('h1','selected');
			break;
		case 2:
			$smarty->assign('h2','selected');
			break;
		case 3:
			$smarty->assign('h3','selected');
			break;
	}
		
	$smarty->assign('courselist',$course_list);
	$smarty->assign('typelist',$teelist);
	$smarty->assign('note',$games->games_note);
	$smarty->assign('addbtn',"Save Practice");
	
	$perform = $games->getResult();
	drawPerform($smarty, $perform);
	drawScoreCare($smarty, $games_id);
}

function del_practice($games_id){
	$games_fact = new games_factory();
	$games_fact->remove_games($games_id);
}

function add_practice(&$smarty){
	$valid = trim($_POST['valid']);
	
	if($valid != ""){
		$games = new games();
		$games_fact = new games_factory();	
		$games->games_date = $_POST['tanggal']." ".$_POST['time1'].":".$_POST['time2'].":00";
		$games->games_weather = $_POST['weather'];
		$games->games_type = 1;
		$games->games_note = $_POST['notes'];
		$games->games_holeplay = $_POST['playrule'];
		$games->course_id = $_POST['course'];
		$games->course_length_id = $_POST['tee'];
		$games->id_round_tour = "";
		$games->members_id = $_POST['memberid'];
		$games->members_name = "";
		$games->members_group = "";
		$games->members_age = "";		
		
		$hasil = $games_fact->create_games($games);
		return $hasil;
	}else{
		return "";
	}
}

function save_practice(){
	$valid = trim($_POST['valid']);
	
	if($valid != ""){
		$games_fact = new games_factory();
		
		$games = new games($_POST['games_id']);
		$games->games_date = $_POST['tanggal']." ".$_POST['time1'].":".$_POST['time2'].":00";
		$games->games_weather = $_POST['weather'];
		$games->games_note = $_POST['notes'];
		$games->games_holeplay = $_POST['playrule'];
		$games->course_id = $_POST['course'];
		$games->course_length_id = $_POST['tee'];
		$games->members_id = $_POST['memberid'];
		
		$games_fact->update_games($games);
		$games->calculate();
	}
}

function drawPerform(&$smarty, $perform){
	
	$fir_div = $perform[0]['PAR5_HOLE'] + $perform[0]['PAR4_HOLE'];
	if($fir_div != 0) {
  	$fir_ratio = round(($perform[0]['TOTAL_FIR'] / $fir_div) * 100, 1);
	}else {
		$fir_ratio = 0;
	}
	
	if($perform[0]['TOTAL_HOLE'] != 0){
		$gir_ratio = round(($perform[0]['TOTAL_GIR'] / $perform[0]['TOTAL_HOLE']) * 100, 1);
	}else{
		$gir_ratio = 0;
	}
	
	$smarty->assign('sum_score', $perform[0]['TOTAL_SCORE']);
	$smarty->assign('sum_putts', $perform[0]['TOTAL_PUTTS']);
	$smarty->assign('sum_fir', $perform[0]['TOTAL_FIR']);
	$smarty->assign('sum_firr', $fir_ratio."%");
	$smarty->assign('sum_gir', $perform[0]['TOTAL_GIR']);
	$smarty->assign('sum_girr', $gir_ratio."%");
	$smarty->assign('sum_saves', $perform[0]['TOTAL_SAVES']);
	$smarty->assign('sum_fairways', $perform[0]['TOTAL_FAIRWAYS']);
	$smarty->assign('sum_rr', $perform[0]['TOTAL_RR']);
	$smarty->assign('sum_lr', $perform[0]['TOTAL_LR']);
	$smarty->assign('sum_bunkers', $perform[0]['TOTAL_BUNKERS']);
	$smarty->assign('sum_penalties', $perform[0]['TOTAL_PENALTIES']);
	$smarty->assign('sum_hio', $perform[0]['HOLE_IN_ONE']);
	$smarty->assign('sum_condor', $perform[0]['CONDOR']);
	$smarty->assign('sum_albatros', $perform[0]['ALBATROS']);
	$smarty->assign('sum_eagles', $perform[0]['EAGLES']);
	$smarty->assign('sum_birdies', $perform[0]['BIRDIES']);
	$smarty->assign('sum_pars', $perform[0]['PARS']);
	$smarty->assign('sum_bogeys', $perform[0]['BOGEYS']);
	$smarty->assign('sum_dbogeys', $perform[0]['DBOGEYS']);
	$smarty->assign('sum_tbogeys', $perform[0]['TBOGEYS']);
	$smarty->assign('sum_others', $perform[0]['OTHERS']);
}

function drawScoreCare(&$smarty, $games_id){
	$games = new games($games_id);
	$data = $games->getDetail();
	
	$out_length = 0;
	$out_par = 0;
	$out_score = 0;
	$in_length = 0;
	$in_par = 0;
	$in_score = 0;
	
	$fir = 0;
	$lr1 = 0;
	$rr1 = 0;
	$bunker1 = 0;
	$penalty1 = 0;
	$gir = 0;
	$fairway = 0;
	$lr2 = 0;
	$rr2 = 0;
	$on = 0;
	$bunker2 = 0;
	$penalty2 = 0;
	$putts = 0;
	$control = 0;
	$saves = 0;
	
	for($a=1;$a<=18;$a++){
		if($a <= 9){
			$out_length += $data[$a]["length"];
			$out_par += $data[$a]["par"];
			$out_score += $data[$a]["score"];
		}else{
			$in_length += $data[$a]["length"];
			$in_par += $data[$a]["par"];
			$in_score += $data[$a]["score"];
		}
		
		$fir += $data[$a]["fir"];
		$lr1 += $data[$a]["lr1"];
		$rr1 += $data[$a]["rr1"];
		$bunker1 += $data[$a]["bunker1"];
		$penalty1 += $data[$a]["penalty1"];
		$gir += $data[$a]["gir"];
		$fairway += $data[$a]["fairway"];
		$lr2 += $data[$a]["lr2"];
		$rr2 += $data[$a]["rr2"];
		$on += $data[$a]["on"];
		$bunker2 += $data[$a]["bunker2"];
		$penalty2 += $data[$a]["penalty2"];
		$putts += $data[$a]["putts"];
		$control += $data[$a]["control"];
		$saves += $data[$a]["saves"];
			
		$smarty->assign('hole'.$a.'_length', $data[$a]["length"]);
		$smarty->assign('hole'.$a.'_par', $data[$a]["par"]);
		$smarty->assign('hole'.$a.'_hcp', ($data[$a]["hcp"] == "0") ? "" : $data[$a]["hcp"]);
		$smarty->assign('hole'.$a.'_score', ($data[$a]["score"] == "0") ? "" : $data[$a]["score"]);
		$smarty->assign('hole'.$a.'_fir', ($data[$a]["fir"] == "0") ? "" : $data[$a]["fir"]);
		$smarty->assign('hole'.$a.'_rr1', ($data[$a]["rr1"] == "0") ? "" : $data[$a]["rr1"]);
		$smarty->assign('hole'.$a.'_lr1', ($data[$a]["lr1"] == "0") ? "" : $data[$a]["lr1"]);
		$smarty->assign('hole'.$a.'_bunker1', ($data[$a]["bunker1"] == "0") ? "" : $data[$a]["bunker1"]);
		$smarty->assign('hole'.$a.'_penalty1', ($data[$a]["penalty1"] == "0") ? "" : $data[$a]["penalty1"]);
		$smarty->assign('hole'.$a.'_gir', ($data[$a]["gir"] == "0") ? "" : $data[$a]["gir"]);
		$smarty->assign('hole'.$a.'_fairway', ($data[$a]["fairway"] == "0") ? "" : $data[$a]["fairway"]);
		$smarty->assign('hole'.$a.'_rr2', ($data[$a]["rr2"] == "0") ? "" : $data[$a]["rr2"]);
		$smarty->assign('hole'.$a.'_lr2', ($data[$a]["lr2"] == "0") ? "" : $data[$a]["lr2"]);
		$smarty->assign('hole'.$a.'_on', ($data[$a]["on"] == "0") ? "" : $data[$a]["on"]);
		$smarty->assign('hole'.$a.'_bunker2', ($data[$a]["bunker2"] == "0") ? "" : $data[$a]["bunker2"]);
		$smarty->assign('hole'.$a.'_penalty2', ($data[$a]["penalty2"] == "0") ? "" : $data[$a]["penalty2"]);
		$smarty->assign('hole'.$a.'_putts', ($data[$a]["putts"] == "0") ? "" : $data[$a]["putts"]);
		$smarty->assign('hole'.$a.'_control', ($data[$a]["control"] == "0") ? "" : $data[$a]["control"]);
		$smarty->assign('hole'.$a.'_saves', ($data[$a]["saves"] == "0") ? "" : $data[$a]["saves"]);
	}
	
	$smarty->assign('holeout_length', ($out_length == "0") ? "" : $out_length);
	$smarty->assign('holein_length', ($in_length == "0") ? "" : $in_length);	
	$smarty->assign('holetotal_length', $in_length + $out_length);	
	
	$smarty->assign('holeout_par', ($out_par == "0") ? "" : $out_par);
	$smarty->assign('holein_par', ($in_par == "0") ? "" : $in_par);		
	$smarty->assign('holetotal_par', $in_par + $out_par);	
	
	$smarty->assign('holeout_score', ($out_score == "0") ? "" : $out_score);
	$smarty->assign('holein_score', ($in_score == "0") ? "" : $in_score);		
	$smarty->assign('holetotal_score', $in_score + $out_score);		
	
	$smarty->assign('holetotal_fir', ($fir == "0" ) ? "" :$fir);
	$smarty->assign('holetotal_rr1', ($rr1 == "0" ) ? "" :$rr1);
	$smarty->assign('holetotal_lr1', ($lr1 == "0" ) ? "" :$lr1);
	$smarty->assign('holetotal_bunker1', ($bunker1 == "0" ) ? "" :$bunker1);
	$smarty->assign('holetotal_penalty1', ($penalty1 == "0" ) ? "" :$penalty1);
	$smarty->assign('holetotal_gir', ($gir == "0" ) ? "" :$gir);
	$smarty->assign('holetotal_fairway', ($fairway == "0" ) ? "" :$fairway);
	$smarty->assign('holetotal_rr2', ($rr2 == "0" ) ? "" :$rr2);
	$smarty->assign('holetotal_lr2', ($lr2 == "0" ) ? "" :$lr2);
	$smarty->assign('holetotal_on', ($on == "0" ) ? "" :$on);
	$smarty->assign('holetotal_bunker2', ($bunker2 == "0" ) ? "" :$bunker2);
	$smarty->assign('holetotal_penalty2', ($penalty2 == "0" ) ? "" :$penalty2);
	$smarty->assign('holetotal_putts', ($putts == "0" ) ? "" :$putts);
	$smarty->assign('holetotal_control', ($control == "0" ) ? "" :$control);
	$smarty->assign('holetotal_saves', ($saves == "0" ) ? "" :$saves);	
}

function checklist(&$smarty, &$editDetail){
	$games_id = trim($_POST['games_id']);
	$valid = trim($_POST['valid']);
	$memberid = trim($_POST['memberid']);
	$tanggal = trim($_POST['tanggal']);
	$jam = trim($_POST['time1']);
	$menit = trim($_POST['time2']);
	$id = trim($_POST['course']);
	$sid = trim($_POST['tee']);
	$weather = strtolower(trim($_POST['weather']));
	$rule = trim($_POST['playrule']);
	$note = trim($_POST['notes']);
	
	$games = new games_factory();		
	$course = new course_factory();
	
	$desc = $games->getNameAge($memberid);
	$course_list = $course->get_listSelect($id);
	$teelist = $course->get_teelistSelect($id, $sid);
	
	$smarty->assign('games_id',$games_id);
	$smarty->assign('valid',$valid);
	$smarty->assign('memberid',$memberid);
	$smarty->assign('members_desc',$desc);
	$smarty->assign('desc',$desc);
	$smarty->assign('tanggal',$tanggal);
	$smarty->assign('jam',$jam);
	$smarty->assign('menit',$menit);		
	$smarty->assign('courselist',$course_list);	
	$smarty->assign('typelist',$teelist);
	$smarty->assign('note',$note);
	
	if($desc != "")	$smarty->assign('valid','valid');

	switch($weather){
		case "sunny":
			$smarty->assign('s1','selected');
			break;
		case "cloudy":
			$smarty->assign('s2','selected');
			break;
		case "dry":
			$smarty->assign('s3','selected');
			break;
		case "rainy":
			$smarty->assign('s4','selected');
			break;
		case "misty":
			$smarty->assign('s5','selected');
			break;
		case "wet":
			$smarty->assign('s6','selected');
			break;
		case "windy":
			$smarty->assign('s7','selected');
			break;
		case "others":
			$smarty->assign('s8','selected');
			break;
	}
	
	switch($rule){
		case 1:
			$smarty->assign('h1','selected');
			break;
		case 2:
			$smarty->assign('h2','selected');
			break;
		case 3:
			$smarty->assign('h3','selected');
			break;
	}		
	if($games_id == ""){
		$smarty->assign('addbtn',"Add Practice");
		$editDetail = false;
	}else{
		$smarty->assign('addbtn',"Save Practice");
		$editDetail = true;			
	}		
}

function updatelist(&$smarty, &$editDetail){
	$games_id = trim($_POST['games_id']);
	$valid = trim($_POST['valid']);
	$memberid = trim($_POST['memberid']);
	$desc = trim($_POST['desc']);
	$tanggal = trim($_POST['tanggal']);
	$jam = trim($_POST['time1']);
	$menit = trim($_POST['time2']);
	$valid = trim($_POST['valid']);
	$id = trim($_POST['course']);
	$weather = strtolower(trim($_POST['weather']));
	$rule = trim($_POST['playrule']);
	$note = trim($_POST['notes']);
			
	$course = new course_factory();
	$course_list = $course->get_listSelect($id);
	$teelist = $course->get_teelistSelect($id);
	
	$smarty->assign('games_id',$games_id);
	$smarty->assign('valid',$valid);	
	$smarty->assign('memberid',$memberid);
	$smarty->assign('members_desc',$desc);
	$smarty->assign('desc',$desc);
	$smarty->assign('tanggal',$tanggal);
	$smarty->assign('jam',$jam);
	$smarty->assign('menit',$menit);		
	$smarty->assign('valid', $valid);
	$smarty->assign('courselist',$course_list);	
	$smarty->assign('typelist',$teelist);
	$smarty->assign('note',$note);
	switch($weather){
		case "sunny":
			$smarty->assign('s1','selected');
			break;
		case "cloudy":
			$smarty->assign('s2','selected');
			break;
		case "dry":
			$smarty->assign('s3','selected');
			break;
		case "rainy":
			$smarty->assign('s4','selected');
			break;
		case "misty":
			$smarty->assign('s5','selected');
			break;
		case "wet":
			$smarty->assign('s6','selected');
			break;
		case "windy":
			$smarty->assign('s7','selected');
			break;
		case "others":
			$smarty->assign('s8','selected');
			break;
	}	
	
	switch($rule){
		case 1:
			$smarty->assign('h1','selected');
			break;
		case 2:
			$smarty->assign('h2','selected');
			break;
		case 3:
			$smarty->assign('h3','selected');
			break;
	}		
	if($games_id == ""){
		$smarty->assign('addbtn',"Add Practice");
		$editDetail = false;
	}else{
		$smarty->assign('addbtn',"Save Practice");
		$editDetail = true;			
	}		
}

function editScore(&$smarty, $games_id){
	$smarty->assign('games_id',$games_id);
	drawScoreCare($smarty, $games_id);
}

function saveScore(){
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
}

function saveFirst(){
	$games_id = trim($_POST['games_id']);
	$games = new games($games_id);
	for($i=1;$i<=18;$i++){
		$field_par = "hole".$i."_par";
		$field_fir = "hole".$i."_fir";
		$field_rr1 = "hole".$i."_rr1";
		$field_lr1 = "hole".$i."_lr1";
		$field_bunker1 = "hole".$i."_bunker1";
		$field_penalty1 = "hole".$i."_penalty1";
		
		$hole = $i;
		$par = trim($_POST[$field_par]);
		$fir = trim($_POST[$field_fir]);
		$rr1 = trim($_POST[$field_rr1]);
		$lr1 = trim($_POST[$field_lr1]);
		$bunker1 = trim($_POST[$field_bunker1]);
		$penalty1 = trim($_POST[$field_penalty1]);
		
		$games->updateFirst($hole, $par, $fir, $rr1, $lr1, $bunker1, $penalty1);
	}
	$games->calculate();
}

function saveSecond(){
	$games_id = trim($_POST['games_id']);
	$games = new games($games_id);
	for($i=1;$i<=18;$i++){
		$field_par = "hole".$i."_par";
		$field_gir = "hole".$i."_gir";
		$field_fairway = "hole".$i."_fairway";
		$field_rr2 = "hole".$i."_rr2";
		$field_lr2 = "hole".$i."_lr2";
		$field_on = "hole".$i."_on";
		$field_bunker2 = "hole".$i."_bunker2";
		$field_penalty2 = "hole".$i."_penalty2";
		$field_putts = "hole".$i."_putts";


		$hole = $i;
		$par = trim($_POST[$field_par]);
		$gir = trim($_POST[$field_gir]);
		$fairway = trim($_POST[$field_fairway]);
		$rr2 = trim($_POST[$field_rr2]);
		$lr2 = trim($_POST[$field_lr2]);
		$on = trim($_POST[$field_on]);
		$bunker2 = trim($_POST[$field_bunker2]);
		$penalty2 = trim($_POST[$field_penalty2]);		
		$putts = trim($_POST[$field_putts]);
		
		$games->updateSecond($hole, $par, $gir, $fairway, $rr2, $lr2, $on, $bunker2, $penalty2, $putts);
	}
	$games->calculate();
}
?>