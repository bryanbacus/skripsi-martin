<?php
require_once(PATH_IJGA."/IJGC/message.class.php");

// declare var
$template = "message.tpl";

$showList = false;
$showRead = false;
$showWrite = false;

$smarty->assign('judul',"Inbox");

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if(strtolower(trim($_POST['delbtn'])) == "delete message"){
	$aksi2 = "delete";
}else if(strtolower(trim($_POST['sendbtn'])) == "write message"){
	$aksi2 = "write";
}else if(strtolower(trim($_POST['sendbtn'])) == "send message"){
	$aksi2 = "send";
}else if(strtolower(trim($_POST['replybtn'])) == "reply message"){
	$aksi2 = "reply";
}else if(strtolower(trim($_POST['cancelbtn'])) == "cancel & back to inbox"){
	$aksi2 = "display";
}

$smarty->assign('aksi2',$aksi2);

// Process aksi2
switch($aksi2){
	case "display":
		$showList = true;
		display($smarty);
		break;
	case "read":
		$showRead = true;
		read($smarty);
		break;
	case "write":
		$showWrite = true;
		break;	
	case "delete":
		$showList = true;
		delete($smarty);
		display($smarty);
		break;		
	case "send":
		send($smarty);
		$showList = true;
		display($smarty);	
		break;
	case "reply":
		$showWrite = true;
		reply($smarty);
		break;	
	default:
		$showList = true;
		display($smarty);
		break;	
}

$smarty->assign('showList',$showList);
$smarty->assign('showRead',$showRead);
$smarty->assign('showCompose',$showWrite);
$smarty->assign('msg','There is no message in your inbox.');

//================ Function

function display(&$smarty){
	$usn = $_SESSION['usn'];
	
	$message_fact = new message_factory();
	$member_id = $message_fact->getMemberIDByUSN($usn);
	$list = $message_fact->get_messageList($member_id, 0);
	
	$smarty->assign('message_list', $list);
}

function delete(&$smarty){
	$arrID = $_POST['id'];
	$message_fact = new message_factory();
	foreach($arrID as $id) $message_fact->remove_message($id);
}

function send(&$smarty){
	$id_to = trim($_POST['id_to']);
	$subject = trim($_POST['subject']);
	$message_text = trim($_POST['message']);
	
	$factory = new message_factory();
	$member_id = $factory->getMemberIDByUSN($_SESSION['usn']);
	
	$message = new message();
	$message->message_id = "";
	$message->id_member_from = $member_id;
	$message->id_member_to = $id_to;
	$message->date_time = date("Y/m/d");
	$message->subject = $subject;
	$message->message = $message_text;		
	
	$factory->send_message($message);
}

function read(&$smarty){
	$message_id = $_REQUEST['id'];
	
	$factory = new message_factory();
	$message = $factory->get_message($message_id);
	
	$smarty->assign("msg_id", $message->message_id);
	$smarty->assign("from", $message->id_member_from);
	$smarty->assign("date", $message->date_time);
	$smarty->assign("subject", $message->subject);
	$smarty->assign("message", $message->message);
}

function reply(&$smarty){
	$message_id = $_POST['msg_id'];
	
	$factory = new message_factory();
	$message = $factory->get_message($message_id);
	$reply = $factory->reply_message($message);
	
	$smarty->assign("send_to", $reply->id_member_to);
	$smarty->assign("rep_subject", $reply->subject);
	$smarty->assign("rep_message", $reply->message);
}
?>
