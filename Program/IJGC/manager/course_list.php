<?php

if(!defined("NODIRECT")){
	die("No direct Access !!");
}
if($_SESSION['levelUser']!=1){
	header("Location:index.php");
}

error_reporting(E_ALL ^ E_NOTICE);

require_once(PATH_CLASS."/IJGA/course.class.php");

// declare var
$course_fact = new course_factory();
$template = "course_list.tpl";

$showList = false;
$showDetail = false;
$showCourse = false;
$showTee = false;

$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=crlist\'" />';

$smarty->assign('judul',"List of Golf Course");
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$smarty->assign('referer',$_SERVER['SCRIPT_NAME']."?aksi=crlist");

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if(strtolower(trim($_POST['caribtn'])) == "search"){
	$aksi2 = "search";
}else if(strtolower(trim($_POST['refreshbtn'])) == "reload"){
	$aksi2 = "reload";
}else if(strtolower(trim($_POST['createbtn'])) == "create a new course"){
	$aksi2 = "create";
}else if(strtolower(trim($_POST['savebtn'])) == "add course"){
	$aksi2 = "add";
}else if(strtolower(trim($_POST['savebtn'])) == "save course"){
	$aksi2 = "update";
}else if(strtolower(trim($_POST['cancelbtn'])) == "cancel"){
	$aksi2 = "reload";
}else if(strtolower(trim($_POST['saveparbtn'])) == "save"){
	$aksi2 = "updatepar";
}else if(strtolower(trim($_POST['cancelparbtn'])) == "cancel"){
	$aksi2 = "edit";
}else if(strtolower(trim($_POST['saveteebtn'])) == "add tee"){
	$aksi2 = "addtee";
}else if(strtolower(trim($_POST['saveteebtn'])) == "save tee"){
	$aksi2 = "savetee";
}else if(strtolower(trim($_POST['cancelteebtn'])) == "cancel"){
	$aksi2 = "edit";
}else if(strtolower(trim($_POST['upload'])) == "upload"){
	$aksi2 = "upload";
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
	case "create":
		$showDetail = true;	
		$smarty->assign('editDetail',false);
		$smarty->assign('pathimage',"../".PATH_IMAGES."/upload/noPict.gif");
		$smarty->assign('course_id',"");
		$smarty->assign('course_name',"");
		$smarty->assign('course_addr',"");
		$smarty->assign('course_phone',"");
		$smarty->assign('course_desc',"");
		$smarty->assign('savebtn',"Add course");
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
		
		$smarty->assign('cr_id',$par["course_id"]);		
		$smarty->assign('par_id',$par["course_subid"]);
		foreach ($hole as $val){
			$smarty->assign('hole'.$key.'_par', $val["par"]);
			$smarty->assign('hole'.$key.'_hcp', $val["hcp"]);
			$key++;
		}
		
		$teelist = $course->get_teeList();
		$smarty->assign('teelist',$teelist);
		break;
	case "delete":
		$id = trim($_REQUEST['id']);
		$course_fact->remove_course($id);
		
		$showList = true;
		$course_list = $course_fact->get_list();
		$smarty->assign('courselist',$course_list);
		break;		
	case "add":
		$showDetail = true;
		
		$name = trim($_POST['course_name']);
		$addr = trim($_POST['course_addr']);
		$desc = trim($_POST['course_desc']);
		$phone = trim($_POST['course_phone']);	
		$path = "..".PATH_IMAGES."/upload/noPict.gif";
		
		if($name != ""){
			$course = new course();
			$course->course_name = $name;
			$course->course_addr = $addr;
			$course->course_desc = $desc;
			$course->course_phone = $phone;
			$course->course_logopath = $path;
			
			$course_fact->create_course($course);
			$course = $course_fact->get_courseByName($name);
			
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
			
			$smarty->assign('cr_id',$par["course_id"]);
			$smarty->assign('par_id',$par["course_subid"]);
			foreach ($hole as $val){
				$smarty->assign('hole'.$key.'_par', $val["par"]);
				$smarty->assign('hole'.$key.'_hcp', $val["hcp"]);
				$key++;
			}
		}else{
			$smarty->assign('editDetail',false);
			$smarty->assign('pathimage',"../".PATH_IMAGES."/upload/noPict.gif");
			$smarty->assign('course_id',"");
			$smarty->assign('course_name',"");
			$smarty->assign('course_addr',"");
			$smarty->assign('course_phone',"");
			$smarty->assign('course_desc',"");
			$smarty->assign('savebtn',"Add course");		
		}
		break;
	case "update":
		$id = trim($_POST['course_id']);
		$name = trim($_POST['course_name']);
		$addr = trim($_POST['course_addr']);
		$desc = trim($_POST['course_desc']);
		$phone = trim($_POST['course_phone']);	
		
		if($id != ""){
			$course = new course($id);
			$course->course_name = $name;
			$course->course_addr = $addr;
			$course->course_desc = $desc;
			$course->course_phone = $phone;
			
			$course_fact->update_course($course);
		}	
		
		$showList = true;		
		$course_list = $course_fact->get_list();
		$smarty->assign('courselist',$course_list);		
		break;		
	case "upload":	
		$id = trim($_REQUEST['id']);
		$upload = $course_fact->uploadFile(1048576, $id);
		
		// SHOW Edit
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
		
		$smarty->assign('cr_id',$par["course_id"]);		
		$smarty->assign('par_id',$par["course_subid"]);
		foreach ($hole as $val){
			$smarty->assign('hole'.$key.'_par', $val["par"]);
			$smarty->assign('hole'.$key.'_hcp', $val["hcp"]);
			$key++;
		}
		
		$teelist = $course->get_teeList();
		$smarty->assign('teelist',$teelist);
		break;
	case "editpar":
		$showCourse = true;
		
		$id = trim($_REQUEST['id']);
		
		$course = $course_fact->get_course($id);
		$par = $course->get_detail();
		$hole = $par["hole"];
		$key = 1;
		foreach ($hole as $val){
			$smarty->assign('hole'.$key.'_par', $val["par"]);
			$smarty->assign('hole'.$key.'_hcp', $val["hcp"]);
			$key++;
		}
		break;
	case "updatepar":
		$id = trim($_REQUEST['id']);
		$sid = trim($_REQUEST['sid']);		
		
		$detail = new course_detail();
		$detail->course_id = $id;
		$detail->course_subid = $sid;
		$detail->hole01_par = (int) trim($_POST['hole1_par']);
		$detail->hole01_hcp = (int) trim($_POST['hole1_hcp']);
		$detail->hole02_par = (int) trim($_POST['hole2_par']);
		$detail->hole02_hcp = (int) trim($_POST['hole2_hcp']);
		$detail->hole03_par = (int) trim($_POST['hole3_par']);
		$detail->hole03_hcp = (int) trim($_POST['hole3_hcp']);
		$detail->hole04_par = (int) trim($_POST['hole4_par']);
		$detail->hole04_hcp = (int) trim($_POST['hole4_hcp']);
		$detail->hole05_par = (int) trim($_POST['hole5_par']);
		$detail->hole05_hcp = (int) trim($_POST['hole5_hcp']);
		$detail->hole06_par = (int) trim($_POST['hole6_par']);
		$detail->hole06_hcp = (int) trim($_POST['hole6_hcp']);
		$detail->hole07_par = (int) trim($_POST['hole7_par']);
		$detail->hole07_hcp = (int) trim($_POST['hole7_hcp']);
		$detail->hole08_par = (int) trim($_POST['hole8_par']);
		$detail->hole08_hcp = (int) trim($_POST['hole8_hcp']);
		$detail->hole09_par = (int) trim($_POST['hole9_par']);
		$detail->hole09_hcp = (int) trim($_POST['hole9_hcp']);
		$detail->hole10_par = (int) trim($_POST['hole10_par']);
		$detail->hole10_hcp = (int) trim($_POST['hole10_hcp']);
		$detail->hole11_par = (int) trim($_POST['hole11_par']);
		$detail->hole11_hcp = (int) trim($_POST['hole11_hcp']);								
		$detail->hole12_par = (int) trim($_POST['hole12_par']);
		$detail->hole12_hcp = (int) trim($_POST['hole12_hcp']);								
		$detail->hole13_par = (int) trim($_POST['hole13_par']);
		$detail->hole13_hcp = (int) trim($_POST['hole13_hcp']);								
		$detail->hole14_par = (int) trim($_POST['hole14_par']);
		$detail->hole14_hcp = (int) trim($_POST['hole14_hcp']);								
		$detail->hole15_par = (int) trim($_POST['hole15_par']);
		$detail->hole15_hcp = (int) trim($_POST['hole15_hcp']);								
		$detail->hole16_par = (int) trim($_POST['hole16_par']);
		$detail->hole16_hcp = (int) trim($_POST['hole16_hcp']);								
		$detail->hole17_par = (int) trim($_POST['hole17_par']);
		$detail->hole17_hcp = (int) trim($_POST['hole17_hcp']);								
		$detail->hole18_par = (int) trim($_POST['hole18_par']);
		$detail->hole18_hcp = (int) trim($_POST['hole18_hcp']);
		
		$course_fact->update_course_detail($detail);
		
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
		
		$smarty->assign('cr_id',$par["course_id"]);		
		$smarty->assign('par_id',$par["course_subid"]);
		foreach ($hole as $val){
			$smarty->assign('hole'.$key.'_par', $val["par"]);
			$smarty->assign('hole'.$key.'_hcp', $val["hcp"]);
			$key++;
		}
		
		$teelist = $course->get_teeList();
		$smarty->assign('teelist',$teelist);	
		break;
	case "createtee":
		$showTee = true;
		
		$type = new course_type();
		$type_list = $type->get_listSelect("");
		$smarty->assign('typelist',$type_list);		
		
		$smarty->assign('course_rating', "0.00");
		$smarty->assign('slope_rating',"0");
		$smarty->assign('savetee', "Add Tee");
				
		for($a=1; $a<=18; $a++) $smarty->assign('hole'.$a, "0");
		break;
	case "updatetee":
		$id = $_REQUEST['id'];
		$sid = $_REQUEST['sid'];
		
		$course  = new course($id);
		$data = $course->get_tee($sid);
		
		$showTee = true;
		
		$type = new course_type();
		$type_list = $type->get_listSelect($data->course_type_id);
		$smarty->assign('typelist',$type_list);		
		
		if(strtolower($data->course_measure) == "meters"){
			$smarty->assign('s1', "selected");
		}else{
			$smarty->assign('s2', "selected");	
		}
			
		$smarty->assign('course_rating', $data->course_rating);
		$smarty->assign('slope_rating',$data->course_slope_rating);
		$smarty->assign('savetee', "Save Tee");
		
		$smarty->assign('hole1', $data->hole01_length);		
		$smarty->assign('hole2', $data->hole02_length);
		$smarty->assign('hole3', $data->hole03_length);
		$smarty->assign('hole4', $data->hole04_length);
		$smarty->assign('hole5', $data->hole05_length);
		$smarty->assign('hole6', $data->hole06_length);
		$smarty->assign('hole7', $data->hole07_length);
		$smarty->assign('hole8', $data->hole08_length);
		$smarty->assign('hole9', $data->hole09_length);
		$smarty->assign('hole10', $data->hole10_length);
		$smarty->assign('hole11', $data->hole11_length);
		$smarty->assign('hole12', $data->hole12_length);
		$smarty->assign('hole13', $data->hole13_length);
		$smarty->assign('hole14', $data->hole14_length);
		$smarty->assign('hole15', $data->hole15_length);
		$smarty->assign('hole16', $data->hole16_length);
		$smarty->assign('hole17', $data->hole17_length);
		$smarty->assign('hole18', $data->hole18_length);

		break;
	case "addtee":
		$id = trim($_REQUEST['id']);
		
		$tee = new course_tee();
		$tee->course_id = $id;
		$tee->course_subid = "";
		$tee->course_type_id = $_POST["course_type"];
		$tee->course_measure = $_POST["course_measure"];
		$tee->course_rating = $_POST["course_rating"];
		$tee->course_slope_rating = $_POST["slope_rating"];
		
		$tee->hole01_length=$_POST["hole1"];
		$tee->hole02_length=$_POST["hole2"];
		$tee->hole03_length=$_POST["hole3"];
		$tee->hole04_length=$_POST["hole4"];
		$tee->hole05_length=$_POST["hole5"];
		$tee->hole06_length=$_POST["hole6"];
		$tee->hole07_length=$_POST["hole7"];
		$tee->hole08_length=$_POST["hole8"];
		$tee->hole09_length=$_POST["hole9"];
		$tee->hole10_length=$_POST["hole10"];
		$tee->hole11_length=$_POST["hole11"];
		$tee->hole12_length=$_POST["hole12"];
		$tee->hole13_length=$_POST["hole13"];
		$tee->hole14_length=$_POST["hole14"];
		$tee->hole15_length=$_POST["hole15"];
		$tee->hole16_length=$_POST["hole16"];
		$tee->hole17_length=$_POST["hole17"];
		$tee->hole18_length=$_POST["hole18"];
		
		$course_fact->add_course_tee($tee);
		
		// Back to show detail		
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
		
		$smarty->assign('cr_id',$par["course_id"]);		
		$smarty->assign('par_id',$par["course_subid"]);
		foreach ($hole as $val){
			$smarty->assign('hole'.$key.'_par', $val["par"]);
			$smarty->assign('hole'.$key.'_hcp', $val["hcp"]);
			$key++;
		}
		$teelist = $course->get_teeList();	
		$smarty->assign('teelist',$teelist);	
		break;		
	case "savetee":
		$id = trim($_REQUEST['id']);
		$sid = trim($_REQUEST['sid']);
		
		$tee = new course_tee();
		$tee->course_id = $id;
		$tee->course_subid = $sid;
		$tee->course_type_id = $_POST["course_type"];
		$tee->course_measure = $_POST["course_measure"];
		$tee->course_rating = $_POST["course_rating"];
		$tee->course_slope_rating = $_POST["slope_rating"];
		
		$tee->hole01_length=$_POST["hole1"];
		$tee->hole02_length=$_POST["hole2"];
		$tee->hole03_length=$_POST["hole3"];
		$tee->hole04_length=$_POST["hole4"];
		$tee->hole05_length=$_POST["hole5"];
		$tee->hole06_length=$_POST["hole6"];
		$tee->hole07_length=$_POST["hole7"];
		$tee->hole08_length=$_POST["hole8"];
		$tee->hole09_length=$_POST["hole9"];
		$tee->hole10_length=$_POST["hole10"];
		$tee->hole11_length=$_POST["hole11"];
		$tee->hole12_length=$_POST["hole12"];
		$tee->hole13_length=$_POST["hole13"];
		$tee->hole14_length=$_POST["hole14"];
		$tee->hole15_length=$_POST["hole15"];
		$tee->hole16_length=$_POST["hole16"];
		$tee->hole17_length=$_POST["hole17"];
		$tee->hole18_length=$_POST["hole18"];
		
		$course_fact->update_course_tee($tee);
				
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
		
		$smarty->assign('cr_id',$par["course_id"]);		
		$smarty->assign('par_id',$par["course_subid"]);
		foreach ($hole as $val){
			$smarty->assign('hole'.$key.'_par', $val["par"]);
			$smarty->assign('hole'.$key.'_hcp', $val["hcp"]);
			$key++;
		}
		$teelist = $course->get_teeList();	
		$smarty->assign('teelist',$teelist);	
		break;
	case "removetee":
		$sid = trim($_REQUEST['sid']);
		$course_fact->remove_course_tee($sid);

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
		
		$smarty->assign('cr_id',$par["course_id"]);		
		$smarty->assign('par_id',$par["course_subid"]);
		foreach ($hole as $val){
			$smarty->assign('hole'.$key.'_par', $val["par"]);
			$smarty->assign('hole'.$key.'_hcp', $val["hcp"]);
			$key++;
		}
		$teelist = $course->get_teeList();	
		$smarty->assign('teelist',$teelist);	
		break;
	case "upload":
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
$smarty->assign('showCourse',$showCourse);
$smarty->assign('showTee',$showTee);

// assign template
$content = $smarty->fetch($template);
$smarty->assign('content',$content);
?>
