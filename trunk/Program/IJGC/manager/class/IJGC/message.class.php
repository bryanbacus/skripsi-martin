<?php
require_once(PATH_IJGA. "/DBConn/DBManager.php");

class message_factory{
	var $SimpleDB;
	
	function message_factory(){
		$this->SimpleDB = new MySQLAccess();
		$this->SimpleDB->setHost(DB_HOST);
		$this->SimpleDB->setUser(DB_USER);
		$this->SimpleDB->setPassword(DB_PASS);
		$this->SimpleDB->setDBName(DB_NAME);	
	}
	
	function get_message($message_id){
		$result = "";
		
		$SQL = "select message_id, user_id_from, user_id_to, folder_id, date_time, subject, message from mos_messages where message_id = $message_id";
		$this->SimpleDB->connect();
		$rst = $this->SimpleDB->query($SQL);
		$this->SimpleDB->disconnect();
		
		if((is_object($rst)) && ($rst->next())){
			$result = new message();
			$result->message_id = $rst->get(0);
			$result->id_member_from = $rst->get(1);
			$result->id_member_to = $rst->get(2);
			$result->folder_id = $rst->get(3);
			$result->date_time = $rst->get(4);
			$result->subject = $rst->get(5);
			$result->message = $rst->get(6);
		}
		return $result;	
	}
	
	function get_messageList($id_member_to, $folder_id){
		$result = array();
		$key = 0;
				
		$SQL = "select a.message_id, a.user_id_from, a.folder_id, a.date_time, a.state, a.subject, a.message, b.name, b.gambar from mos_messages a inner join tbl_membership b where a.user_id_from = b.id and a.user_id_to='$id_member_to' and a.folder_id=$folder_id";
		$this->SimpleDB->connect();
		$rst = $this->SimpleDB->query($SQL);
		$this->SimpleDB->disconnect();
		
		while((is_object($rst)) && ($rst->next())){
			$result[$key]['message_id'] = $rst->get(0);
			$result[$key]['user_id_from'] = $rst->get(1);
			$result[$key]['folder_id'] = $rst->get(2);
			$result[$key]['date_time'] = $rst->get(3);
			$result[$key]['state'] = $rst->get(4);
			$result[$key]['subject'] = $rst->get(5);
			$result[$key]['message'] = $rst->get(6);
			$result[$key]['name_from'] = $rst->get(7);
			$result[$key]['gambar_from'] = $rst->get(8);
			$key++;
		}
		return $result;		
	}
	
	function reply_message($message){
		$reply = new message();
		
		$reply->message_id = "";
		$reply->id_member_from = $message->id_member_to;
		$reply->id_member_to = $message->id_member_from;
		$reply->date_time = date("Y/m/d");
		$reply->subject = "Re: ".$message->subject;
		$reply->message = " \noriginal message: \n".$message->message;		
		return $reply;
	}
	
	function send_message($message){
		$this->SimpleDB->connect();
		
		$SQL  = "insert into mos_messages(";
		$SQL .= "  user_id_from,";
		$SQL .= "  user_id_to,";
		$SQL .= "  folder_id,";
		$SQL .= "  date_time,";
		$SQL .= "  subject,";
		$SQL .= "  message)";
		$SQL .= " values(";
		$SQL .= "  '".$message->id_member_from."',";
		$SQL .= "  '".$message->id_member_to."',";
		$SQL .= "  0,";
		$SQL .= "  '".$message->date_time."',";
		$SQL .= "  '".$message->subject."',";
		$SQL .= "  '".$message->message."')";		
		$this->SimpleDB->execute($SQL);

		$this->SimpleDB->disconnect();	
	}
	
	function mark_read($message_id){
		$this->SimpleDB->connect();
		$SQL  = "update mos_messages set";
		$SQL .= "  state = 1,";
		$SQL .= " where message_id = $message_id";
		$this->SimpleDB->execute($SQL);
		$this->SimpleDB->disconnect();		
	}
	
	function remove_message($message_id){
		$SQL = "delete from mos_messages where message_id = $message_id";
		$this->SimpleDB->connect();
		$rst = $this->SimpleDB->execute($SQL);
		$this->SimpleDB->disconnect();
	}
	
	function getName($memberid){
		$this->SimpleDB->connect();

		$result = "";
		$SQL = "select name from tbl_membership where id='$memberid'";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$result = $rst->get(0);
		}
		$this->SimpleDB->disconnect();	
		return $result;		
	}
	
	function getMemberIDByUSN($usn){
		$this->SimpleDB->connect();

		$result = "";
		$SQL  = "select";
		$SQL .= "  id";
		$SQL .= " from tbl_membership ";
		$SQL .= " where ";
		$SQL .= "  id = ( select id_unik from tbl_user b where b.user_tipe=2 and b.user='$usn')"; 
		
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$result = $rst->get(0);
		}
		$this->SimpleDB->disconnect();	
		return $result;				
	}	
}

class message{
	var $message_id = "";
	var $id_member_from = "";
	var $id_member_to = "";
	var $folder_id = 0;
	var $date_time = "";
	var $state = 0;
	var $priority = 0;
	var $subject = "";
	var $message = "";
	
	function message(){}
}

?>