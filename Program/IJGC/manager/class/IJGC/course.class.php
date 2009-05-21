<?php
require_once(PATH_IJGA. "/DBConn/DBManager.php");

class course_factory{
	var $SimpleDB;
	
	function course_factory(){
		$this->SimpleDB = new MySQLAccess();
		$this->SimpleDB->setHost(DB_HOST);
		$this->SimpleDB->setUser(DB_USER);
		$this->SimpleDB->setPassword(DB_PASS);
		$this->SimpleDB->setDBName(DB_NAME);
	}
	
	function create_course($course){
		if(trim($course->course_id) == ""){
			$name = trim($course->course_name);
			$desc = trim($course->course_desc);
			$addr = trim($course->course_addr);
			$telp = trim($course->course_phone);
			$path = trim($course->course_logopath);
			
			$this->SimpleDB->connect();
			
			$SQL = "select course_id from m_course where course_name='$name'";
			$rst = $this->SimpleDB->query($SQL);
			if((is_object($rst)) && (!$rst->next())){
				$SQL = "insert into m_course(course_name, course_desc, course_address, course_phone, course_logopath) values('$name', '$desc', '$addr', '$telp', '$path')";
				$this->SimpleDB->execute($SQL);
				
			}			

			$SQL = "select course_id from m_course where course_name = '$name'";
			$rst = $this->SimpleDB->query($SQL);
			if((is_object($rst)) && ($rst->next())){
				$id = $rst->get(0);

				$SQL = "insert into m_course_detail(course_id) values($id)";
				$this->SimpleDB->execute($SQL);
			}			
			
			$this->SimpleDB->disconnect();
		}
	}
	
	function update_course($course){
		if(trim($course->course_id) != ""){
			$id = trim($course->course_id);
			$name = trim($course->course_name);
			$desc = trim($course->course_desc);
			$addr = trim($course->course_addr);
			$phone = trim($course->course_phone);
			
			$SQL = "update m_course set course_name='$name', course_desc = '$desc', course_address = '$addr', course_phone = '$phone' where course_id = $id";
			$this->SimpleDB->connect();
			$this->SimpleDB->execute($SQL);
			$this->SimpleDB->disconnect();
		}
	}
	
	function remove_course($course_id){
		if(trim($course_id) != ""){
			$id = trim($course_id);
			$this->SimpleDB->connect();			
			
			$SQL = "delete from m_course where course_id = $id";
			$this->SimpleDB->execute($SQL);
			
			$SQL = "delete from m_course_detail where course_id = $id";
			$this->SimpleDB->execute($SQL);
			
			$SQL = "delete from m_course_length where course_id = $id";
			$this->SimpleDB->execute($SQL);
									
			$this->SimpleDB->disconnect();
		}		
	}
	
	function upload_logo($course_id, $path_logo){}

	function update_course_detail($course_detail){
		if(($course_detail->course_subid != "") && ($course_detail->course_id != "")){
			$SQL  = "update m_course_detail set";
			$SQL .= "  course_id = $course_detail->course_id,";
			$SQL .= "  hole1_par = $course_detail->hole01_par,";
			$SQL .= "  hole1_hcp = $course_detail->hole01_hcp,";
			$SQL .= "  hole2_par = $course_detail->hole02_par,";
			$SQL .= "  hole2_hcp = $course_detail->hole02_hcp,";
			$SQL .= "  hole3_par = $course_detail->hole03_par,";
			$SQL .= "  hole3_hcp = $course_detail->hole03_hcp,";
			$SQL .= "  hole4_par = $course_detail->hole04_par,";
			$SQL .= "  hole4_hcp = $course_detail->hole04_hcp,";
			$SQL .= "  hole5_par = $course_detail->hole05_par,";
			$SQL .= "  hole5_hcp = $course_detail->hole05_hcp,";
			$SQL .= "  hole6_par = $course_detail->hole06_par,";
			$SQL .= "  hole6_hcp = $course_detail->hole06_hcp,";
			$SQL .= "  hole7_par = $course_detail->hole07_par,";
			$SQL .= "  hole7_hcp = $course_detail->hole07_hcp,";
			$SQL .= "  hole8_par = $course_detail->hole08_par,";
			$SQL .= "  hole8_hcp = $course_detail->hole08_hcp,";
			$SQL .= "  hole9_par = $course_detail->hole09_par,";
			$SQL .= "  hole9_hcp = $course_detail->hole09_hcp,";
			$SQL .= "  hole10_par = $course_detail->hole10_par,";
			$SQL .= "  hole10_hcp = $course_detail->hole10_hcp,";
			$SQL .= "  hole11_par = $course_detail->hole11_par,";
			$SQL .= "  hole11_hcp = $course_detail->hole11_hcp,";
			$SQL .= "  hole12_par = $course_detail->hole12_par,";
			$SQL .= "  hole12_hcp = $course_detail->hole12_hcp,";
			$SQL .= "  hole13_par = $course_detail->hole13_par,";
			$SQL .= "  hole13_hcp = $course_detail->hole13_hcp,";
			$SQL .= "  hole14_par = $course_detail->hole14_par,";
			$SQL .= "  hole14_hcp = $course_detail->hole14_hcp,";
			$SQL .= "  hole15_par = $course_detail->hole15_par,";
			$SQL .= "  hole15_hcp = $course_detail->hole15_hcp,";
			$SQL .= "  hole16_par = $course_detail->hole16_par,";
			$SQL .= "  hole16_hcp = $course_detail->hole16_hcp,";
			$SQL .= "  hole17_par = $course_detail->hole17_par,";
			$SQL .= "  hole17_hcp = $course_detail->hole17_hcp,";
			$SQL .= "  hole18_par = $course_detail->hole18_par,";
			$SQL .= "  hole18_hcp = $course_detail->hole18_hcp";
			$SQL .= " where course_sub_id = $course_detail->course_subid";
			$this->SimpleDB->connect();
			$this->SimpleDB->execute($SQL);
			$this->SimpleDB->disconnect();			
		}	
	}
		
	function add_course_tee($course_tee){
		if(($course_tee->course_subid == "") && ($course_tee->course_id != "")){
			$SQL  = "insert into m_course_length(";
			$SQL .= " course_id,";
			$SQL .= " course_type_id,";
			$SQL .= " course_measure,";
			$SQL .= " course_rating,";
			$SQL .= " slope_rating,";
			$SQL .= " hole1_length,";
			$SQL .= " hole2_length,";
			$SQL .= " hole3_length,";
			$SQL .= " hole4_length,";
			$SQL .= " hole5_length,";
			$SQL .= " hole6_length,";
			$SQL .= " hole7_length,";
			$SQL .= " hole8_length,";
			$SQL .= " hole9_length,";
			$SQL .= " hole10_length,";
			$SQL .= " hole11_length,";
			$SQL .= " hole12_length,";
			$SQL .= " hole13_length,";
			$SQL .= " hole14_length,";
			$SQL .= " hole15_length,";
			$SQL .= " hole16_length,";
			$SQL .= " hole17_length,";
			$SQL .= " hole18_length) ";
			$SQL .= "values(";
			$SQL .= " $course_tee->course_id,";
			$SQL .= " $course_tee->course_type_id,";
			$SQL .= " '$course_tee->course_measure',";
			$SQL .= " $course_tee->course_rating,";
			$SQL .= " $course_tee->course_slope_rating,";
			$SQL .= " $course_tee->hole01_length,";
			$SQL .= " $course_tee->hole02_length,";
			$SQL .= " $course_tee->hole03_length,";
			$SQL .= " $course_tee->hole04_length,";
			$SQL .= " $course_tee->hole05_length,";
			$SQL .= " $course_tee->hole06_length,";
			$SQL .= " $course_tee->hole07_length,";
			$SQL .= " $course_tee->hole08_length,";
			$SQL .= " $course_tee->hole09_length,";
			$SQL .= " $course_tee->hole10_length,";
			$SQL .= " $course_tee->hole11_length,";
			$SQL .= " $course_tee->hole12_length,";
			$SQL .= " $course_tee->hole13_length,";
			$SQL .= " $course_tee->hole14_length,";
			$SQL .= " $course_tee->hole15_length,";
			$SQL .= " $course_tee->hole16_length,";
			$SQL .= " $course_tee->hole17_length,";
			$SQL .= " $course_tee->hole18_length)";

			$this->SimpleDB->connect();
			$this->SimpleDB->execute($SQL);
			$this->SimpleDB->disconnect();			
		}
	}

	function update_course_tee($course_tee){
		if(($course_tee->course_subid != "") && ($course_tee->course_id != "")){
			$SQL  = "update m_course_length set";
			$SQL .= "  course_id = $course_tee->course_id,";
			$SQL .= "  course_type_id = $course_tee->course_type_id,";
			$SQL .= "  course_measure = '$course_tee->course_measure',";
			$SQL .= "  course_rating = $course_tee->course_rating,";
			$SQL .= "  slope_rating = $course_tee->course_slope_rating,";
			$SQL .= "  hole1_length = $course_tee->hole01_length,";
			$SQL .= "  hole2_length = $course_tee->hole02_length,";
			$SQL .= "  hole3_length = $course_tee->hole03_length,";
			$SQL .= "  hole4_length = $course_tee->hole04_length,";
			$SQL .= "  hole5_length = $course_tee->hole05_length,";
			$SQL .= "  hole6_length = $course_tee->hole06_length,";
			$SQL .= "  hole7_length = $course_tee->hole07_length,";
			$SQL .= "  hole8_length = $course_tee->hole08_length,";
			$SQL .= "  hole9_length = $course_tee->hole09_length,";
			$SQL .= "  hole10_length = $course_tee->hole10_length,";
			$SQL .= "  hole11_length = $course_tee->hole11_length,";
			$SQL .= "  hole12_length = $course_tee->hole12_length,";
			$SQL .= "  hole13_length = $course_tee->hole13_length,";
			$SQL .= "  hole14_length = $course_tee->hole14_length,";
			$SQL .= "  hole15_length = $course_tee->hole15_length,";
			$SQL .= "  hole16_length = $course_tee->hole16_length,";
			$SQL .= "  hole17_length = $course_tee->hole17_length,";
			$SQL .= "  hole18_length = $course_tee->hole18_length ";
			$SQL .= " where course_sub_id = $course_tee->course_subid";
			$this->SimpleDB->connect();
			$this->SimpleDB->execute($SQL);
			$this->SimpleDB->disconnect();			
		}	
	}
	
	function remove_course_detail($course_sub_id){
		$sub = trim($course_sub_id);
		if($sub != ""){
			$SQL = "delete from m_course_detail where course_sub_id = $sub";
			$this->SimpleDB->connect();
			$this->SimpleDB->execute($SQL);
			$this->SimpleDB->disconnect();
		}	
	}
	
	function get_course($course_id){
		$this->SimpleDB->connect();
		
		$result = "";
		$SQL = "select course_id, course_name, course_desc, course_address, course_phone, course_logopath from m_course where course_id = $course_id";
		$rst = $this->SimpleDB->query($SQL);
		
		if((is_object($rst)) && ($rst->next())){
			$result = new course($rst->get(0));
			$result->course_id = $rst->get(0);
			$result->course_name = $rst->get(1);
			$result->course_desc = $rst->get(2);
			$result->course_addr = $rst->get(3);
			$result->course_phone = $rst->get(4);
			$result->course_logopath = $rst->get(5);
		}
		$this->SimpleDB->disconnect();	
		
		return $result;		
	}
	
	function get_courseByName($course_name){
		$this->SimpleDB->connect();
		
		$result = "";
		$SQL = "select course_id, course_name, course_desc, course_address, course_phone, course_logopath from m_course where course_name = '$course_name'";
		$rst = $this->SimpleDB->query($SQL);
		
		if((is_object($rst)) && ($rst->next())){
			$result = new course($rst->get(0));
			$result->course_id = $rst->get(0);
			$result->course_name = $rst->get(1);
			$result->course_desc = $rst->get(2);
			$result->course_addr = $rst->get(3);
			$result->course_phone = $rst->get(4);
			$result->course_logopath = $rst->get(5);
		}
		$this->SimpleDB->disconnect();	
		
		return $result;		
	}
		
	function get_list(){
		$this->SimpleDB->connect();
		
		$key = 0;		
		$arrList = array();
		$SQL = "select course_id, course_name, course_desc, course_address, course_phone, course_logopath from m_course";
		$rst = $this->SimpleDB->query($SQL);
		
		while((is_object($rst)) && ($rst->next())){
			$arrList[$key]['course_id'] = $rst->get(0);
			$arrList[$key]['course_name'] = $rst->get(1);
			$arrList[$key]['course_desc'] = $rst->get(2);
			$arrList[$key]['course_addr'] = $rst->get(3);
			$arrList[$key]['course_phone'] = $rst->get(4);
			$arrList[$key]['course_logopath'] = $rst->get(5);
			$key++;
		}
		$this->SimpleDB->disconnect();	
		
		return $arrList;			
	}

	function get_listSelect($id = ""){
		$this->SimpleDB->connect();
		
		$key = 0;
		$result = array();		
		$SQL = "select course_id, course_name from m_course order by course_id";
		$rst = $this->SimpleDB->query($SQL);
		while((is_object($rst)) && ($rst->next())){
			$result[$key]["course_id"] = $rst->get(0);
			$result[$key]["course_name"] = $rst->get(1);
			if($id == $rst->get(0)){
				$result[$key]["selected"] = "selected";
			}else{
				$result[$key]["selected"] = "";
			}
			$key++;			
		}
		$this->SimpleDB->disconnect();	
		return $result;
	}	
	
	function get_teelistSelect($id = "", $sid = ""){
		$this->SimpleDB->connect();
		
		$key = 0;
		$result = array();		
		$SQL = "select a.course_sub_id, a.course_type_id, b.type_name from m_course_length a inner join m_course_type b where a.course_type_id = b.course_type_id and a.course_id = $id order by a.course_sub_id";
		$rst = $this->SimpleDB->query($SQL);
		while((is_object($rst)) && ($rst->next())){
			$result[$key]["course_sub_id"] = $rst->get(0);
			$result[$key]["type_name"] = $rst->get(2);
			if($sid == $rst->get(0)){
				$result[$key]["selected"] = "selected";
			}else{
				$result[$key]["selected"] = "";
			}
			$key++;			
		}
		$this->SimpleDB->disconnect();	
		return $result;
	}
			
	function get_listByName($name){
		$this->SimpleDB->connect();
		
		$key = 0;		
		$arrList = array();
		$SQL = "select course_id, course_name, course_desc, course_address, course_phone, course_logopath from m_course where course_name like '%$name%'";
		$rst = $this->SimpleDB->query($SQL);
		
		while((is_object($rst)) && ($rst->next())){
			$arrList[$key]['course_id'] = $rst->get(0);
			$arrList[$key]['course_name'] = $rst->get(1);
			$arrList[$key]['course_desc'] = $rst->get(2);
			$arrList[$key]['course_addr'] = $rst->get(3);
			$arrList[$key]['course_phone'] = $rst->get(4);
			$arrList[$key]['course_logopath'] = $rst->get(5);
			$key++;
		}
		$this->SimpleDB->disconnect();	
		
		return $arrList;			
	}	
}

class course{
	var $course_id;
	
	var $course_name;
	
	var $course_desc;
	
	var $course_addr;
	
	var $course_phone;
	
	var $course_logopath;
	
	var $SimpleDB;
	
	function course($course_id = ""){
		$this->course_id = $course_id;
		$this->course_name = "";
		$this->course_desc = "";
		$this->course_addr = "";
		$this->course_phone = "";
		$this->course_logopath = "";
		
		$this->SimpleDB = new MySQLAccess();
		$this->SimpleDB->setHost(DB_HOST);
		$this->SimpleDB->setUser(DB_USER);
		$this->SimpleDB->setPassword(DB_PASS);
		$this->SimpleDB->setDBName(DB_NAME);		
	}
	
	function get_detail(){
		if(trim($this->course_id) != ""){
			$result = "";
			$id = $this->course_id;
			$this->SimpleDB->connect();	
			
			$SQL = "select ";
			$SQL .= " course_sub_id,";
			$SQL .= " course_id,";
			$SQL .= " hole1_par,";
			$SQL .= " hole1_hcp,";
			$SQL .= " hole2_par,";
			$SQL .= " hole2_hcp,";
			$SQL .= " hole3_par,";
			$SQL .= " hole3_hcp,";
			$SQL .= " hole4_par,";
			$SQL .= " hole4_hcp,";
			$SQL .= " hole5_par,";
			$SQL .= " hole5_hcp,";
			$SQL .= " hole6_par,";
			$SQL .= " hole6_hcp,";
			$SQL .= " hole7_par,";
			$SQL .= " hole7_hcp,";
			$SQL .= " hole8_par,";
			$SQL .= " hole8_hcp,";
			$SQL .= " hole9_par,";
			$SQL .= " hole9_hcp,";
			$SQL .= " hole10_par,";
			$SQL .= " hole10_hcp,";
			$SQL .= " hole11_par,";
			$SQL .= " hole11_hcp,";
			$SQL .= " hole12_par,";
			$SQL .= " hole12_hcp,";
			$SQL .= " hole13_par,";
			$SQL .= " hole13_hcp,";
			$SQL .= " hole14_par,";
			$SQL .= " hole14_hcp,";
			$SQL .= " hole15_par,";
			$SQL .= " hole15_hcp,";
			$SQL .= " hole16_par,";
			$SQL .= " hole16_hcp,";
			$SQL .= " hole17_par,";
			$SQL .= " hole17_hcp,";
			$SQL .= " hole18_par,";
			$SQL .= " hole18_hcp ";
			$SQL .= "from m_course_detail where course_id = $id";
		
			$rst = $this->SimpleDB->query($SQL);
			if((is_object($rst)) && ($rst->next())){
				$result = array();
				$result['course_subid'] = $rst->get(0);
				$result['course_id'] = $rst->get(1);
				
				$result['hole'][0]['par'] = $rst->get(2);				
				$result['hole'][0]['hcp'] = $rst->get(3);
				$result['hole'][1]['par'] = $rst->get(4);				
				$result['hole'][1]['hcp'] = $rst->get(5);
				$result['hole'][2]['par'] = $rst->get(6);				
				$result['hole'][2]['hcp'] = $rst->get(7);
				$result['hole'][3]['par'] = $rst->get(8);				
				$result['hole'][3]['hcp'] = $rst->get(9);
				$result['hole'][4]['par'] = $rst->get(10);				
				$result['hole'][4]['hcp'] = $rst->get(11);
				$result['hole'][5]['par'] = $rst->get(12);				
				$result['hole'][5]['hcp'] = $rst->get(13);
				$result['hole'][6]['par'] = $rst->get(14);				
				$result['hole'][6]['hcp'] = $rst->get(15);
				$result['hole'][7]['par'] = $rst->get(16);				
				$result['hole'][7]['hcp'] = $rst->get(17);
				$result['hole'][8]['par'] = $rst->get(18);				
				$result['hole'][8]['hcp'] = $rst->get(19);
				$result['hole'][9]['par'] = $rst->get(20);				
				$result['hole'][9]['hcp'] = $rst->get(21);
				$result['hole'][10]['par'] = $rst->get(22);				
				$result['hole'][10]['hcp'] = $rst->get(23);
				$result['hole'][11]['par'] = $rst->get(24);				
				$result['hole'][11]['hcp'] = $rst->get(25);
				$result['hole'][12]['par'] = $rst->get(26);				
				$result['hole'][12]['hcp'] = $rst->get(27);
				$result['hole'][13]['par'] = $rst->get(28);				
				$result['hole'][13]['hcp'] = $rst->get(29);
				$result['hole'][14]['par'] = $rst->get(30);				
				$result['hole'][14]['hcp'] = $rst->get(31);
				$result['hole'][15]['par'] = $rst->get(32);				
				$result['hole'][15]['hcp'] = $rst->get(33);
				$result['hole'][16]['par'] = $rst->get(34);				
				$result['hole'][16]['hcp'] = $rst->get(35);
				$result['hole'][17]['par'] = $rst->get(36);				
				$result['hole'][17]['hcp'] = $rst->get(37);
			}
			$this->SimpleDB->disconnect();	
			
			return $result;	
		}
	}

	function getTee($course_sub_id){
		$this->SimpleDB->connect();
		
		$result = "";
		$SQL = "select ";
		$SQL .= " course_sub_id,";
		$SQL .= " course_id,";
		$SQL .= " course_type_id,";
		$SQL .= " course_measure,";
		$SQL .= " course_rating,";
		$SQL .= " slope_rating,";
		$SQL .= " hole1_length,";
		$SQL .= " hole2_length,";
		$SQL .= " hole3_length,";
		$SQL .= " hole4_length,";
		$SQL .= " hole5_length,";
		$SQL .= " hole6_length,";
		$SQL .= " hole7_length,";
		$SQL .= " hole8_length,";
		$SQL .= " hole9_length,";
		$SQL .= " hole10_length,";
		$SQL .= " hole11_length,";
		$SQL .= " hole12_length,";
		$SQL .= " hole13_length,";
		$SQL .= " hole14_length,";
		$SQL .= " hole15_length,";
		$SQL .= " hole16_length,";
		$SQL .= " hole17_length,";
		$SQL .= " hole18_length ";
		$SQL .= "from m_course_length where course_sub_id = $course_sub_id";
		
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$result = array();
			$result['course_subid'] = $rst->get(0);
			$result['course_id'] = $rst->get(1);
			$result['course_type_id'] = $rst->get(2);
			$result['course_measure'] = $rst->get(3);
			$result['course_rating'] = $rst->get(4);
			$result['slope_rating'] = $rst->get(5);
				
			$result['hole'][0]['length'] = $rst->get(6);				
			$result['hole'][1]['length'] = $rst->get(7);				
			$result['hole'][2]['length'] = $rst->get(8);				
			$result['hole'][3]['length'] = $rst->get(9);				
			$result['hole'][4]['length'] = $rst->get(10);				
			$result['hole'][5]['length'] = $rst->get(11);
			$result['hole'][6]['length'] = $rst->get(12);
			$result['hole'][7]['length'] = $rst->get(13);				
			$result['hole'][8]['length'] = $rst->get(14);				
			$result['hole'][9]['length'] = $rst->get(15);
			$result['hole'][10]['length'] = $rst->get(16);				
			$result['hole'][11]['length'] = $rst->get(17);				
			$result['hole'][12]['length'] = $rst->get(18);				
			$result['hole'][13]['length'] = $rst->get(19);				
			$result['hole'][14]['length'] = $rst->get(20);				
			$result['hole'][15]['length'] = $rst->get(21);				
			$result['hole'][16]['length'] = $rst->get(22);				
			$result['hole'][17]['length'] = $rst->get(23);				
		}
		$this->SimpleDB->disconnect();	
		
		return $result;	
	}
		
	function get_tee($course_sub_id){
		$this->SimpleDB->connect();
		
		$result = "";
		$SQL = "select ";
		$SQL .= " course_sub_id,";
		$SQL .= " course_id,";
		$SQL .= " course_type_id,";
		$SQL .= " course_measure,";
		$SQL .= " course_rating,";
		$SQL .= " slope_rating,";
		$SQL .= " hole1_length,";
		$SQL .= " hole2_length,";
		$SQL .= " hole3_length,";
		$SQL .= " hole4_length,";
		$SQL .= " hole5_length,";
		$SQL .= " hole6_length,";
		$SQL .= " hole7_length,";
		$SQL .= " hole8_length,";
		$SQL .= " hole9_length,";
		$SQL .= " hole10_length,";
		$SQL .= " hole11_length,";
		$SQL .= " hole12_length,";
		$SQL .= " hole13_length,";
		$SQL .= " hole14_length,";
		$SQL .= " hole15_length,";
		$SQL .= " hole16_length,";
		$SQL .= " hole17_length,";
		$SQL .= " hole18_length ";
		$SQL .= "from m_course_length where course_sub_id = $course_sub_id";
		
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$result = new course_tee();
			$result->course_subid = $rst->get(0);
			
			$result->course_id = $rst->get(1);
			$result->course_type_id = $rst->get(2);
			$result->course_measure = $rst->get(3);
			$result->course_rating = $rst->get(4);
			$result->course_slope_rating = $rst->get(5);
			$result->hole01_length = $rst->get(6);
			$result->hole02_length = $rst->get(7);
			$result->hole03_length = $rst->get(8);
			$result->hole04_length = $rst->get(9);
			$result->hole05_length = $rst->get(10);
			$result->hole06_length = $rst->get(11);
			$result->hole07_length = $rst->get(12);
			$result->hole08_length = $rst->get(13);
			$result->hole09_length = $rst->get(14);
			$result->hole10_length = $rst->get(15);
			$result->hole11_length = $rst->get(16);
			$result->hole12_length = $rst->get(17);
			$result->hole13_length = $rst->get(18);
			$result->hole14_length = $rst->get(19);
			$result->hole15_length = $rst->get(20);
			$result->hole16_length = $rst->get(21);
			$result->hole17_length = $rst->get(22);
			$result->hole18_length = $rst->get(23);
		}
		$this->SimpleDB->disconnect();	
		
		return $result;	
	}
	
	function get_teeList(){
		$id = $this->course_id;
		
		$arrList = array();		
		$this->SimpleDB->connect();
		
		if($id != ""){
			$SQL = "select ";
			$SQL .= "  a.course_sub_id,";
			$SQL .= "  a.course_id,";
			$SQL .= "  a.course_type_id,";
			$SQL .= "  a.course_measure,";
			$SQL .= "  a.course_rating,";
			$SQL .= "  a.slope_rating,";
			$SQL .= "  a.hole1_length,";
			$SQL .= "  a.hole2_length,";
			$SQL .= "  a.hole3_length,";
			$SQL .= "  a.hole4_length,";
			$SQL .= "  a.hole5_length,";
			$SQL .= "  a.hole6_length,";
			$SQL .= "  a.hole7_length,";
			$SQL .= "  a.hole8_length,";
			$SQL .= "  a.hole9_length,";
			$SQL .= "  a.hole10_length,";
			$SQL .= "  a.hole11_length,";
			$SQL .= "  a.hole12_length,";
			$SQL .= "  a.hole13_length,";
			$SQL .= "  a.hole14_length,";
			$SQL .= "  a.hole15_length,";
			$SQL .= "  a.hole16_length,";
			$SQL .= "  a.hole17_length,";
			$SQL .= "  a.hole18_length,";
			$SQL .= "  b.type_name,";
			$SQL .= "  b.type_color ";
			$SQL .= "from m_course_length a";
			$SQL .= "  inner join m_course_type b";
			$SQL .= " where";
			$SQL .= "  a.course_type_id = b.course_type_id";
			$SQL .= "  and course_id = $id";
			$rst = $this->SimpleDB->query($SQL);
			while((is_object($rst)) && ($rst->next())){
				$result = array();
				$result['course_subid'] = $rst->get(0);
				$result['course_id'] = $rst->get(1);
				$result['course_type_id'] = $rst->get(2);
				$result['course_measure'] = $rst->get(3);
				$result['course_rating'] = $rst->get(4);
				$result['slope_rating'] = $rst->get(5);
				$result['hole0_length'] = $rst->get(6);
				$result['hole1_length'] = $rst->get(7);
				$result['hole2_length'] = $rst->get(8);
				$result['hole3_length'] = $rst->get(9);
				$result['hole4_length'] = $rst->get(10);
				$result['hole5_length'] = $rst->get(11);
				$result['hole6_length'] = $rst->get(12);
				$result['hole7_length'] = $rst->get(13);
				$result['hole8_length'] = $rst->get(14);
				$result['hole9_length'] = $rst->get(15);
				$result['hole10_length'] = $rst->get(16);
				$result['hole11_length'] = $rst->get(17);
				$result['hole12_length'] = $rst->get(18);
				$result['hole13_length'] = $rst->get(19);
				$result['hole14_length'] = $rst->get(20);				
				$result['hole15_length'] = $rst->get(21);
				$result['hole16_length'] = $rst->get(22);
				$result['hole17_length'] = $rst->get(23);
				$result['type_name'] = $rst->get(24);
				$result['type_color'] = $rst->get(25);
				$result['out_length'] = 0 + $rst->get(6) +
																$rst->get(7) +
																$rst->get(8) +
																$rst->get(9) +
																$rst->get(10) +
																$rst->get(11) +
																$rst->get(12) +
																$rst->get(13) +
																$rst->get(14);
				$result['in_length'] = 0 + $rst->get(15) +
																$rst->get(16) +
																$rst->get(17) +
																$rst->get(18) +
																$rst->get(19) +
																$rst->get(20) +
																$rst->get(21) +
																$rst->get(22) +
																$rst->get(23);																			
				$result['total_length'] = $result['out_length'] + $result['in_length'];												
				$arrList[] = $result;
			}
		}
		$this->SimpleDB->disconnect();	
		return $arrList;				
	}
}

class course_detail{
	var $course_id = 0;
	var $course_subid = 0;
	var $hole01_par = 0;
	var $hole01_hcp = 0;
	var $hole02_par = 0;
	var $hole02_hcp = 0;
	var $hole03_par = 0;
	var $hole03_hcp = 0;
	var $hole04_par = 0;
	var $hole04_hcp = 0;
	var $hole05_par = 0;
	var $hole05_hcp = 0;
	var $hole06_par = 0;
	var $hole06_hcp = 0;
	var $hole07_par = 0;
	var $hole07_hcp = 0;
	var $hole08_par = 0;
	var $hole08_hcp = 0;
	var $hole09_par = 0;
	var $hole09_hcp = 0;
	var $hole10_par = 0;
	var $hole10_hcp = 0;
	var $hole11_par = 0;
	var $hole11_hcp = 0;								
	var $hole12_par = 0;
	var $hole12_hcp = 0;								
	var $hole13_par = 0;
	var $hole13_hcp = 0;								
	var $hole14_par = 0;
	var $hole14_hcp = 0;								
	var $hole15_par = 0;
	var $hole15_hcp = 0;								
	var $hole16_par = 0;
	var $hole16_hcp = 0;								
	var $hole17_par = 0;
	var $hole17_hcp = 0;								
	var $hole18_par = 0;
	var $hole18_hcp = 0;								
}

class course_tee{
	var $course_id = "";
	var $course_subid = "";
	var $course_type_id = 0;
	var $course_measure = "";
	var $course_rating = 0;
	var $course_slope_rating = 0;
	
	var $hole01_length = 0;
	var $hole02_length = 0;
	var $hole03_length = 0;
	var $hole04_length = 0;
	var $hole05_length = 0;
	var $hole06_length = 0;
	var $hole07_length = 0;
	var $hole08_length = 0;
	var $hole09_length = 0;
	var $hole10_length = 0;
	var $hole11_length = 0;
	var $hole12_length = 0;
	var $hole13_length = 0;
	var $hole14_length = 0;
	var $hole15_length = 0;
	var $hole16_length = 0;
	var $hole17_length = 0;
	var $hole18_length = 0;
}


class course_type{
	var $SimpleDB;
	
	function course_type(){
		$this->SimpleDB = new MySQLAccess();
		$this->SimpleDB->setHost(DB_HOST);
		$this->SimpleDB->setUser(DB_USER);
		$this->SimpleDB->setPassword(DB_PASS);
		$this->SimpleDB->setDBName(DB_NAME);
	}
	
	function add_type($type_name, $type_color = "#FFFFFF"){
		$this->SimpleDB->connect();
		
		$SQL = "select type_name from m_course_type where type_name = '$type_name'";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && (!$rst->next())){
			$SQL = "insert into m_course_type(type_name, type_color) values('$type_name', '$type_color')";
			$this->SimpleDB->execute($SQL);
		}
		$this->SimpleDB->disconnect();
	}
	
	function update_type($type_id, $type_name, $type_color = "#FFFFFF"){
		$this->SimpleDB->connect();
		
		$SQL = "update m_course_type set type_name = '$type_name', type_color = '$type_color' where course_type_id=$type_id";
		$this->SimpleDB->execute($SQL);
		
		$this->SimpleDB->disconnect();	
	}
	
	function remove_type($type_id){
		$this->SimpleDB->connect();
		
		$SQL = "delete from m_course_type where course_type_id = $type_id";
		$this->SimpleDB->execute($SQL);

		$SQL = "delete from m_course_detail where course_type_id = $type_id";
		$this->SimpleDB->execute($SQL);
		
		$this->SimpleDB->disconnect();	
	}

	function get_type($id){
		$this->SimpleDB->connect();

		$result = array();
		$SQL = "select course_type_id, type_name, type_color from m_course_type where course_type_id = '$id'";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$result[0]["type_id"] = $rst->get(0);
			$result[0]["type_name"] = $rst->get(1);
			$result[0]["type_color"] = $rst->get(2);
		}
		$this->SimpleDB->disconnect();	
		return $result;
	}
		
	function get_list(){
		$this->SimpleDB->connect();
		
		$key = 0;
		$result = array();		
		$SQL = "select course_type_id, type_name, type_color from m_course_type order by course_type_id";
		$rst = $this->SimpleDB->query($SQL);
		while((is_object($rst)) && ($rst->next())){
			$result[$key]["type_id"] = $rst->get(0);
			$result[$key]["type_name"] = $rst->get(1);
			$result[$key]["type_color"] = $rst->get(2);			
			$key++;			
		}
		$this->SimpleDB->disconnect();	
		return $result;
	}
	
	function get_listSelect($id){
		$this->SimpleDB->connect();
		
		$key = 0;
		$result = array();		
		$SQL = "select course_type_id, type_name from m_course_type order by course_type_id";
		$rst = $this->SimpleDB->query($SQL);
		while((is_object($rst)) && ($rst->next())){
			$result[$key]["type_id"] = $rst->get(0);
			$result[$key]["type_name"] = $rst->get(1);			
			if($id == $rst->get(0)){
				$result[$key]["selected"] = "selected";
			}else{
				$result[$key]["selected"] = "";
			}
			$key++;			
		}
		$this->SimpleDB->disconnect();	
		return $result;
	}	
}
?>