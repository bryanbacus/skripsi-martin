<?php

if(!defined("NODIRECT")){
	die("No direct Access !!");
}
if($_SESSION['levelUser']!=1){
	header("Location:index.php");
}

require_once(PATH_CLASS."/IJGA/course.class.php");

// declare var
$course_fact = new course_factory();
$template = "course_view.tpl";

$showList = false;
$showDetail = false;

$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=crtype\'" />';

$smarty->assign('judul',"Golf Course List");
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$smarty->assign('referer',$_SERVER['SCRIPT_NAME']."?aksi=crview");

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if(strtolower(trim($_POST['caribtn'])) == "search"){
	$aksi2 = "search";
}else if(strtolower(trim($_POST['refreshbtn'])) == "reload"){
	$aksi2 = "reload";
}else if(strtolower(trim($_POST['cancelbtn'])) == "close & back to list"){
	$aksi2 = "reload";
}

$smarty->assign('aksi2',$aksi2);

// Process aksi2
switch($aksi2){
	case "search":
		$showList = true;
		$val = trim($_POST['search_val']);
		$course_list = $course_fact->get_listByName($val);
		$smarty->assign('courselist',$course_list);		
		$smarty->assign('course_msg',"There are currently no such type of course. Click reload button to refresh.");
		break;
	case "reload":
		$showList = true;
		$course_list = $course_fact->get_list();
		$smarty->assign('courselist',$course_list);
		$smarty->assign('course_msg',"There are currently no type of course. Please create one.");
		break;
	case "edit":
		$showDetail = true;	
		$id = trim($_REQUEST['id']);
		
		$course = $course_fact->get_course($id);
		$smarty->assign('editDetail',true);
		$smarty->assign('pathimage',$course->course_logopath);
		$smarty->assign('course_id', $course->course_id);
		$smarty->assign('course_name',$course->course_name);
		$smarty->assign('course_addr',$course->course_addr);
		$smarty->assign('course_phone',$course->course_phone);
		$smarty->assign('course_desc',$course->course_desc);
		$smarty->assign('savebtn',"Save course");
		
		$par = $course->get_detail();
		$hole = $par["hole"];
		$key = 1;
		$in_par = 0;
		$out_par = 0;
		
		$smarty->assign('cr_id',$par["course_id"]);		
		$smarty->assign('par_id',$par["course_subid"]);
		for($j=0;$j<=18;$j++){
			$par = $hole[$j]["par"];
			$hcp = $hole[$j]["hcp"];
			if($j <= 8) {
				$out_par += $par;
			}else{
				$in_par += $par;
			}

			$smarty->assign('hole'.$key.'_par', $par);
			$smarty->assign('hole'.$key.'_hcp', $hcp);				
			$key++;
		}
		
		$smarty->assign('out_par', $out_par);
		$smarty->assign('in_par', $in_par);
		$smarty->assign('total_par', $in_par + $out_par);
		
		$teelist = $course->get_teeList();
		$smarty->assign('teelist',$teelist);
		break;
	default:
		$course_list = $course_fact->get_list();
		$smarty->assign('courselist',$course_list);
		$smarty->assign('course_msg',"There are currently no type of course. Please create one.");
		$showList = true;
		break;	
}

$smarty->assign('showList',$showList);
$smarty->assign('showDetail',$showDetail);

// assign template
$content = $smarty->fetch($template);
$smarty->assign('content',$content);
?>
