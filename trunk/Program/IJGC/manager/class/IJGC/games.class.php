<?php
require_once(PATH_IJGA. "/DBConn/DBManager.php");

class games_factory{
	
	var $SimpleDB;
	
	function games_factory(){
		$this->SimpleDB = new MySQLAccess();
		$this->SimpleDB->setHost(DB_HOST);
		$this->SimpleDB->setUser(DB_USER);
		$this->SimpleDB->setPassword(DB_PASS);
		$this->SimpleDB->setDBName(DB_NAME);	
	}
	
	function create_games($games){
		// CREATE GAMES ID
		$games->games_id = "G".$games->games_type.date("YmdHis").$games->members_id;
		
		// INSERT INTO T_GAMES
		$SQL  = "insert into t_games(";
		$SQL .= "  games_id,";
		$SQL .= "  games_date,";
		$SQL .= "  games_type,";
		$SQL .= "  games_weather,";
		$SQL .= "  games_note,";
		$SQL .= "  games_holeplay,";
		$SQL .= "  course_id,";
		$SQL .= "  course_length_id,";
		$SQL .= "  members_id,";
		$SQL .= "  members_name)";
		$SQL .= " values(";
		$SQL .= "  '".$games->games_id."',";
		$SQL .= "  '".$games->games_date."',";
		$SQL .= "  '".$games->games_type."',";
		$SQL .= "  '".$games->games_weather."',";
		$SQL .= "  '".$games->games_note."',";
		$SQL .= "  ".$games->games_holeplay.",";
		$SQL .= "  ".$games->course_id.",";
		$SQL .= "  ".$games->course_length_id.",";
		$SQL .= "  '".$games->members_id."',";
		$SQL .= "  '".$games->members_name."')";
		$this->SimpleDB->connect();
		$this->SimpleDB->execute($SQL);
		$this->SimpleDB->disconnect();
		
		// INSERT INTO T_GAMES_SCORE		
		$course = new course($games->course_id);
		$par = $course->get_detail();
		$tee = $course->getTee($games->course_length_id);
		
		switch($games->games_holeplay){
			case 1:
				$first_hole = 0;
				$last_hole = 18;
				break;
			case 2:
				$first_hole = 0;
				$last_hole = 8;			
				break;
			case 3:
				$first_hole = 9;
				$last_hole = 18;			
				break;
			default:
				$first_hole = 0;
				$last_hole = 18;			
				break;			
		}
		
		for($i = $first_hole; $i < $last_hole; $i++){
			$val_par = $par['hole'][$i]['par'];
			$val_hcp = $par['hole'][$i]['hcp'];
			$val_lng = $tee['hole'][$i]['length'];
			
			$k = $i + 1;
			$SQL  = "insert into t_games_score(";
			$SQL .= "  games_id,";
			$SQL .= "  hole_no,";
			$SQL .= "  hole_length,";
			$SQL .= "  hole_par,";
			$SQL .= "  hole_hcp,"; 
			$SQL .= "  hole_score)";
			$SQL .= " values(";
			$SQL .= "  '".$games->games_id."',";
			$SQL .= "  ".$k.",";
			$SQL .= "  ".$val_lng.",";
			$SQL .= "  ".$val_par.",";
			$SQL .= "  ".$val_hcp.", 0)";
			$this->SimpleDB->connect();
			$this->SimpleDB->execute($SQL);
			$this->SimpleDB->disconnect();
		}

		// INSERT INTO T_GAMES_RESULT
		$SQL  = "insert into t_games_result(";
		$SQL .= "  games_id)";
		$SQL .= " values(";
		$SQL .= "  '".$games->games_id."')";
		$this->SimpleDB->connect();
		$this->SimpleDB->execute($SQL);
		$this->SimpleDB->disconnect();
		
		return $games->games_id;
	}

	function update_games($games){
		$holeplay = "";
		$course_id = "";
		$course_length_id = "";
		$lanjut = false;
			
		$SQL  = "select";
		$SQL .= "  games_id,";
		$SQL .= "  games_date,";
		$SQL .= "  games_type,";
		$SQL .= "  games_weather,";
		$SQL .= "  games_note,";
		$SQL .= "  games_holeplay,";
		$SQL .= "  course_id,";
		$SQL .= "  course_length_id,";
		$SQL .= "  members_id ";
		$SQL .= " from t_games ";
		$SQL .= " where ";
		$SQL .= "  games_id = '".$games->games_id."'"; 
		$this->SimpleDB->connect();
		$rst = $this->SimpleDB->query($SQL);
		$this->SimpleDB->disconnect();
		
		if((is_object($rst)) && ($rst->next())){
			$holeplay = $rst->get(5);
			$course_id = $rst->get(6);
			$course_length_id = $rst->get(7);
			$lanjut = true;
		}
		
		if($lanjut){
			$SQL  = "update t_games set";
			$SQL .= "  games_date='".$games->games_date."',";
			$SQL .= "  games_weather='".$games->games_weather."',";
			$SQL .= "  games_note='".$games->games_note."',";
			$SQL .= "  games_holeplay=".$games->games_holeplay.",";
			$SQL .= "  course_id=".$games->course_id.","; 
			$SQL .= "  course_length_id=".$games->course_length_id.",";
			$SQL .= "  members_id='".$games->members_id."'";
			$SQL .= " where ";
			$SQL .= "  games_id = '".$games->games_id."'";
			$this->SimpleDB->connect();			
			$this->SimpleDB->execute($SQL);
			$this->SimpleDB->disconnect();
			
			if(($games->course_id != $course_id) || ($games->course_length_id != $games->course_length_id) || ($games->games_holeplay != $holeplay)){
				
				$SQL  = "delete from t_games_result where games_id = '".$games->games_id."'";
				$this->SimpleDB->connect();
				$this->SimpleDB->execute($SQL);
				$this->SimpleDB->disconnect();
				
				$SQL  = "delete from t_games_score where games_id = '".$games->games_id."'";
				$this->SimpleDB->connect();
				$this->SimpleDB->execute($SQL);
				$this->SimpleDB->disconnect();

				$course = new course($games->course_id);
				$par = $course->get_detail();
				$tee = $course->getTee($games->course_length_id);
				
				switch($games->games_holeplay){
					case 1:
						$first_hole = 0;
						$last_hole = 18;
						break;
					case 2:
						$first_hole = 0;
						$last_hole = 8;			
						break;
					case 3:
						$first_hole = 9;
						$last_hole = 18;			
						break;
					default:
						$first_hole = 0;
						$last_hole = 18;			
						break;			
				}
				
				for($i = $first_hole; $i < $last_hole; $i++){
					$val_par = $par['hole'][$i]['par'];
					$val_hcp = $par['hole'][$i]['hcp'];
					$val_lng = $tee['hole'][$i]['length'];
					
					$k = $i + 1;
					$SQL  = "insert into t_games_score(";
					$SQL .= "  games_id,";
					$SQL .= "  hole_no,";
					$SQL .= "  hole_length,";
					$SQL .= "  hole_par,";
					$SQL .= "  hole_hcp,"; 
					$SQL .= "  hole_score)";
					$SQL .= " values(";
					$SQL .= "  '".$games->games_id."',";
					$SQL .= "  ".$k.",";
					$SQL .= "  ".$val_lng.",";
					$SQL .= "  ".$val_par.",";
					$SQL .= "  ".$val_hcp.", 0)";
					$this->SimpleDB->connect();
					$this->SimpleDB->execute($SQL);
					$this->SimpleDB->disconnect();
				}
		
				$SQL  = "insert into t_games_result(";
				$SQL .= "  games_id)";
				$SQL .= " values(";
				$SQL .= "  '".$games->games_id."')";
				$this->SimpleDB->connect();
				$this->SimpleDB->execute($SQL);
				$this->SimpleDB->disconnect();
			}
		}
	}
		
	function remove_games($games_id){
		$this->SimpleDB->connect();
		
		$SQL  = "delete from t_games_result where games_id = '".$games_id."'";
		$this->SimpleDB->execute($SQL);
		
		$SQL  = "delete from t_games_score where games_id = '".$games_id."'";
		$this->SimpleDB->execute($SQL);
		
		$SQL  = "delete from t_games where games_id = '".$games_id."'";
		$this->SimpleDB->execute($SQL);				
		$this->SimpleDB->disconnect();
	}
	
	function getGames($games_id){
		$this->SimpleDB->connect();

		$result = "";
		$SQL  = "select";
		$SQL .= "  games_id,";
		$SQL .= "  games_date,";
		$SQL .= "  games_type,";
		$SQL .= "  games_weather,";
		$SQL .= "  games_note,";
		$SQL .= "  games_holeplay,";
		$SQL .= "  course_id,";
		$SQL .= "  course_length_id,";
		$SQL .= "  members_id,";
		$SQL .= "  members_name ";
		$SQL .= " from t_games ";
		$SQL .= " where ";
		$SQL .= "  games_id = '$games_id'"; 
		
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$result = new games($rst->get(0));
			$result->games_date = $rst->get(1);
			$result->games_type = $rst->get(2);
			$result->games_weather = $rst->get(3);
			$result->games_note = $rst->get(4);
			$result->games_holeplay = $rst->get(5);
			$result->course_id = $rst->get(6);
			$result->course_length_id = $rst->get(7);
			$result->members_id = $rst->get(8);
			$result->members_name = $rst->get(9);
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
		$SQL .= "  id = ( select id_unik from tbl_user b where b.user='$usn')"; 
		
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$result = $rst->get(0);
		}
		$this->SimpleDB->disconnect();	
		return $result;				
	}
	
	function getGamesList($date_first = "", $date_last = "", $limit = "", $offset = "", $column = "", $value = "", $member_id = ""){
		$this->SimpleDB->connect();
		
		$key = 0;		
		$arrList = array();
		$SQL = "select a.games_id, a.games_date, a.members_id, a.members_name, a.course_id, a.course_length_id, a.games_holeplay, b.total_par, b.total_score from t_games a inner join t_games_result b where a.games_id = b.games_id";

		if($member_id != "") $SQL .= " and a.members_id='$member_id'";
		
		if(($column != "") && ($value != "")){
			$SQL .= " and ".$column." like '%".$value."%'";
		}	

		if(($date_first != "") && ($date_last != "")){
			$from = $date_first." 00:00:00";
			$to = $date_last." 23:59:59";
		}else{
			$from = date("Y/m/d")." 00:00:00";
			$to = date("Y/m/d")." 23:59:59";
		}
		
		$SQL .= " and a.games_date between '$from' and '$to' order by a.games_date desc";	
		$rst = $this->SimpleDB->query($SQL);
		
		while((is_object($rst)) && ($rst->next())){
			$arrList[$key]['games_id'] = $rst->get(0);
			$arrList[$key]['games_date'] = $rst->get(1);
			$arrList[$key]['games_memberid'] = $rst->get(2);
			$arrList[$key]['games_membername'] = $rst->get(3);
			
			$course = $this->getCourseName($rst->get(4));
			if($course != ""){
				$arrList[$key]['games_course'] = $course;
			}else{
				$arrList[$key]['games_course'] = $rst->get(4);
			}		
			
			switch($rst->get(6)){
				case 1:
					$arrList[$key]['games_holeplay'] = "18-Holes";
					break;
				case 2:
					$arrList[$key]['games_holeplay'] = "9-OUT";
					break;				
				case 3:
					$arrList[$key]['games_holeplay'] = "9-IN";
					break;				
			}
			$arrList[$key]['games_total_par'] = $rst->get(7);
			$arrList[$key]['games_total_score'] = $rst->get(8);
			$key++;
		}
		$this->SimpleDB->disconnect();	
		return $arrList;			
	}
		
	function getGamesListByName($date_first, $date_last, $limit = "", $offset = ""){}
	
	function getNameAge($memberid){
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
	
	function getCourseName($course_id){
		$this->SimpleDB->connect();

		$result = "";
		$SQL = "select course_name from m_course where course_id=$course_id";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$result = $rst->get(0);
		}
		$this->SimpleDB->disconnect();	
		return $result;			
	}
	
	function getTeeName($course_sub_id){
		$this->SimpleDB->connect();

		$result = "";
		$SQL = "select b.type_name from m_course_length a inner join m_course_type b where a.course_type_id = b.course_type_id and a.course_sub_id=$course_sub_id";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$result = $rst->get(0);
		}
		$this->SimpleDB->disconnect();	
		return $result;				
	}	
}

class games{
	
	var $games_id;
	var $games_date;
	var $games_type;
	var $games_weather;
	var $games_note;
	var $games_holeplay;
	var $course_id;
	var $course_length_id;
	var $id_round_tour;
	var $members_id;
	var $members_name;
	var $members_group;
	var $members_age;
	
	var $SimpleDB;
	
	function games($games_id = ""){
		$this->SimpleDB = new MySQLAccess();
		$this->SimpleDB->setHost(DB_HOST);
		$this->SimpleDB->setUser(DB_USER);
		$this->SimpleDB->setPassword(DB_PASS);
		$this->SimpleDB->setDBName(DB_NAME);	
		
		$this->games_id = $games_id;
	}
	
	function getDetail(){
		$this->SimpleDB->connect();
		$games_id = $this->games_id;
		
		$result = "";
		$SQL  = "select ";
		$SQL .= "  hole_no,";
		$SQL .= "  hole_length,";
		$SQL .= "  hole_par,";
		$SQL .= "  hole_hcp,";
		$SQL .= "  hole_score,";
		$SQL .= "  fir,";
		$SQL .= "  rr1,";
		$SQL .= "  lr1,";
		$SQL .= "  bunker1,";
		$SQL .= "  penalty1,";
		$SQL .= "  gir,";
		$SQL .= "  fairway,";
		$SQL .= "  rr2,";
		$SQL .= "  lr2,";
		$SQL .= "  on_,";
		$SQL .= "  bunker2,";
		$SQL .= "  penalty2,";
		$SQL .= "  putts,";
		$SQL .= "  control,";
		$SQL .= "  saves";
		$SQL .= " from t_games_score ";
		$SQL .= " where ";
		$SQL .= "  games_id='$games_id'";
		$rst = $this->SimpleDB->query($SQL);
		while((is_object($rst)) && ($rst->next())){
			$hole = $rst->get(0);
			$result[$hole]['length'] = $rst->get(1);
			$result[$hole]['par'] = $rst->get(2);
			$result[$hole]['hcp'] = $rst->get(3);
			$result[$hole]['score'] = $rst->get(4);
			$result[$hole]['fir'] = $rst->get(5);
			$result[$hole]['rr1'] = $rst->get(6);
			$result[$hole]['lr1'] = $rst->get(7);
			$result[$hole]['bunker1'] = $rst->get(8);
			$result[$hole]['penalty1'] = $rst->get(9);
			$result[$hole]['gir'] = $rst->get(10);
			$result[$hole]['fairway'] = $rst->get(11);
			$result[$hole]['rr2'] = $rst->get(12);
			$result[$hole]['lr2'] = $rst->get(13);
			$result[$hole]['on'] = $rst->get(14);
			$result[$hole]['bunker2'] = $rst->get(15);
			$result[$hole]['penalty2'] = $rst->get(16);
			$result[$hole]['putts'] = $rst->get(17);
			$result[$hole]['control'] = $rst->get(18);
			$result[$hole]['saves'] = $rst->get(19);
		}
		$this->SimpleDB->disconnect();	
		return $result;					
	}
	
	function getResult(){
		$this->SimpleDB->connect();
		$games_id = $this->games_id;
		
		$result = "";
		$SQL  = "select ";
		$SQL .= "  total_hole, ";
		$SQL .= "  total_length, ";
		$SQL .= "  total_hcp, ";
		$SQL .= "  total_par, ";
		$SQL .= "  total_score, ";
		$SQL .= "  total_putts, ";
		$SQL .= "  total_saves, ";
		$SQL .= "  total_fir, ";
		$SQL .= "  total_gir, ";
		$SQL .= "  total_rr, ";
		$SQL .= "  total_lr, ";
		$SQL .= "  total_on, ";
		$SQL .= "  total_fairways, ";
		$SQL .= "  total_bunkers, ";
		$SQL .= "  total_penalties, ";
		$SQL .= "  condor, ";
		$SQL .= "  albatros, ";
		$SQL .= "  eagles, ";
		$SQL .= "  birdies, ";
		$SQL .= "  pars, ";
		$SQL .= "  bogeys, ";
		$SQL .= "  dbogeys, ";
		$SQL .= "  tbogeys, ";
		$SQL .= "  others, ";
		$SQL .= "  hole_in_one, ";
		$SQL .= "  par3_hole, ";
		$SQL .= "  par3_score, ";
		$SQL .= "  par4_hole, ";
		$SQL .= "  par4_score, ";
		$SQL .= "  par5_hole, ";
		$SQL .= "  par5_score";
		$SQL .= " from t_games_result ";
		$SQL .= " where ";
		$SQL .= "  games_id='$games_id'";
		$rst = $this->SimpleDB->query($SQL);
		$hole = 0;
		while((is_object($rst)) && ($rst->next())){
			$result[$hole][$rst->fieldName(0)] = $rst->get(0);
			$result[$hole][$rst->fieldName(1)] = $rst->get(1);
			$result[$hole][$rst->fieldName(2)] = $rst->get(2);
			$result[$hole][$rst->fieldName(3)] = $rst->get(3);
			$result[$hole][$rst->fieldName(4)] = $rst->get(4);
			$result[$hole][$rst->fieldName(5)] = $rst->get(5);
			$result[$hole][$rst->fieldName(6)] = $rst->get(6);
			$result[$hole][$rst->fieldName(7)] = $rst->get(7);
			$result[$hole][$rst->fieldName(8)] = $rst->get(8);
			$result[$hole][$rst->fieldName(9)] = $rst->get(9);
			$result[$hole][$rst->fieldName(10)] = $rst->get(10);
			$result[$hole][$rst->fieldName(11)] = $rst->get(11);
			$result[$hole][$rst->fieldName(12)] = $rst->get(12);
			$result[$hole][$rst->fieldName(13)] = $rst->get(13);
			$result[$hole][$rst->fieldName(14)] = $rst->get(14);
			$result[$hole][$rst->fieldName(15)] = $rst->get(15);
			$result[$hole][$rst->fieldName(16)] = $rst->get(16);
			$result[$hole][$rst->fieldName(17)] = $rst->get(17);
			$result[$hole][$rst->fieldName(18)] = $rst->get(18);
			$result[$hole][$rst->fieldName(19)] = $rst->get(19);
			$result[$hole][$rst->fieldName(20)] = $rst->get(20);
			$result[$hole][$rst->fieldName(21)] = $rst->get(21);
			$result[$hole][$rst->fieldName(22)] = $rst->get(22);
			$result[$hole][$rst->fieldName(23)] = $rst->get(23);
			$result[$hole][$rst->fieldName(24)] = $rst->get(24);
			$result[$hole][$rst->fieldName(25)] = $rst->get(25);
			$result[$hole][$rst->fieldName(26)] = $rst->get(26);
			$result[$hole][$rst->fieldName(27)] = $rst->get(27);
			$result[$hole][$rst->fieldName(28)] = $rst->get(28);
			$result[$hole][$rst->fieldName(29)] = $rst->get(29);
			$hole++;
		}
		$this->SimpleDB->disconnect();	
		return $result;		
	}
	
	function updateScore($hole_no = "", $par = "", $score = ""){
		$games_id = $this->games_id;
		$hole_no = trim($hole_no);
		$par = trim($par);
		$score = trim($score);
		
		if(($hole_no != "") && ($par != "") && ($score != "")){
			$condor = 0;
			$albatros = 0;
			$eagles = 0;
			$birdies = 0;
			$pars = 0;
			$bogeys = 0;
			$dbogeys = 0;
			$tbogeys = 0;
			$others = 0;
			$hole_in_one = 0;
			
			if($score == 1) $hole_in_one = 1;
			
			$stroke = $score - $par;
			switch($stroke){
				case -4:
					$condor += 1;
					break;
				case -3:
					$albatros += 1;
					break;
				case -2:
					$eagles += 1;
					break;
				case -1:
					$birdies += 1;
					break;
				case 0:
					$pars += 1;
					break;
				case 1:
					$bogeys += 1;
					break;
				case 2:
					$dbogeys += 1;
					break;
				case 3:
					$tbogeys += 1;
					break;				
				default:
					$others += 1;
					break;																									
			}
				
			$SQL  = "update t_games_score set";
			$SQL .= "  hole_score = $score, ";
			$SQL .= "  condor = $condor, ";
			$SQL .= "  albatros = $albatros, ";
			$SQL .= "  eagles = $eagles, ";
			$SQL .= "  birdies = $birdies, ";
			$SQL .= "  pars = $pars, ";
			$SQL .= "  bogeys = $bogeys, ";
			$SQL .= "  dbogeys = $dbogeys, ";
			$SQL .= "  tbogeys = $tbogeys, ";
			$SQL .= "  others = $others, ";
			$SQL .= "  hole_in_one = $hole_in_one ";
			$SQL .= " where ";
			$SQL .= "  games_id = '$games_id' and ";
			$SQL .= "  hole_no = $hole_no";
			$this->SimpleDB->connect();			
			$this->SimpleDB->execute($SQL);
			$this->SimpleDB->disconnect();			
		}
	}
	
	function updateFirst($hole_no = "", $par = "", $fir = 0, $rr1 = 0, $lr1 = 0, $bunker1 = 0, $penalty1 = 0){
		$games_id = $this->games_id;
		$hole_no = trim($hole_no);
		
		if(($hole_no != "") && ($par != "")){
			if(($par == "3") && ($fir != 0)) $fir = 0;
			
			$fir = ($fir == "") ? 0 : $fir;
			$rr1 = ($rr1 == "") ? 0 : $rr1;
			$lr1 = ($lr1 == "") ? 0 : $lr1;
			$bunker1 = ($bunker1 == "") ? 0 : $bunker1;
			$penalty1 = ($penalty1 == "") ? 0 : $penalty1;
					
			$SQL  = "update t_games_score set";
			$SQL .= "  fir = $fir, ";
			$SQL .= "  rr1 = $rr1, ";
			$SQL .= "  lr1 = $lr1, ";
			$SQL .= "  bunker1 = $bunker1, ";
			$SQL .= "  penalty1 = $penalty1 ";
			$SQL .= " where ";
			$SQL .= "  games_id = '$games_id' and ";
			$SQL .= "  hole_no = $hole_no";
			$this->SimpleDB->connect();			
			$this->SimpleDB->execute($SQL);
			$this->SimpleDB->disconnect();		
			
			$this->updateControl($games_id, $hole_no);	
		}
	}	
	
	function updateSecond($hole_no = "", $par = "", $gir = 0, $fairway = 0, $rr2 = 0, $lr2 = 0, $on = 0, $bunker2 = 0, $penalty2 = 0, $putts = 0){
		$games_id = $this->games_id;
		$hole_no = trim($hole_no);
		
		if(($hole_no != "") && ($par != "")){
			$gir = ($gir == "") ? 0 : $gir;
			$fairway = ($fairway == "") ? 0 : $fairway;
			$rr2 = ($rr2 == "") ? 0 : $rr2;
			$lr2 = ($lr2 == "") ? 0 : $lr2;
			$on = ($on == "") ? 0 : $on;
			$bunker2 = ($bunker2 == "") ? 0 : $bunker2;
			$penalty2 = ($penalty2 == "") ? 0 : $penalty2;
			$putts = ($putts == "") ? 0 : $putts;
		
			$SQL  = "update t_games_score set";
			$SQL .= "  gir = $gir, ";
			$SQL .= "  fairway = $fairway, ";
			$SQL .= "  rr2 = $rr2, ";
			$SQL .= "  lr2 = $lr2, ";
			$SQL .= "  on_ = $on, ";
			$SQL .= "  bunker2 = $bunker2, ";
			$SQL .= "  penalty2 = $penalty2, ";
			$SQL .= "  putts = $putts ";
			$SQL .= " where ";
			$SQL .= "  games_id = '$games_id' and ";
			$SQL .= "  hole_no = $hole_no";
			$this->SimpleDB->connect();			
			$this->SimpleDB->execute($SQL);
			$this->SimpleDB->disconnect();	
			
			$this->updateControl($games_id, $hole_no);
		}
	}
	
	function updateControl($games_id, $hole_no){
		$SQL  = "select ";
		$SQL .= "  hole_no,";
		$SQL .= "  hole_length,";
		$SQL .= "  hole_par,";
		$SQL .= "  hole_hcp,";
		$SQL .= "  hole_score,";
		$SQL .= "  fir,";
		$SQL .= "  rr1,";
		$SQL .= "  lr1,";
		$SQL .= "  bunker1,";
		$SQL .= "  penalty1,";
		$SQL .= "  gir,";
		$SQL .= "  fairway,";
		$SQL .= "  rr2,";
		$SQL .= "  lr2,";
		$SQL .= "  on_,";
		$SQL .= "  bunker2,";
		$SQL .= "  penalty2,";
		$SQL .= "  putts,";
		$SQL .= "  control,";
		$SQL .= "  saves";
		$SQL .= " from t_games_score ";
		$SQL .= " where ";
		$SQL .= "  games_id='$games_id' and";
		$SQL .= "  hole_no = $hole_no";
		$this->SimpleDB->connect();
		$rst = $this->SimpleDB->query($SQL);
		$this->SimpleDB->disconnect();
		
		if((is_object($rst)) && ($rst->next())){
			$saves = 0;
			
			$control = $rst->get(5) + $rst->get(6) + $rst->get(7) +$rst->get(8) +
								 $rst->get(9) + $rst->get(10) + $rst->get(11) + $rst->get(12) +
								 $rst->get(13) + $rst->get(14) + $rst->get(15)+ $rst->get(16)+ $rst->get(17);	
			if(($rst->get(17)	< 2) && ($rst->get(10)	< 1) && ($rst->get(2)	== $control))
				$saves = 1;				 
				
			$SQL  = "update t_games_score set";
			$SQL .= "  control = $control, ";
			$SQL .= "  saves = $saves ";
			$SQL .= " where ";
			$SQL .= "  games_id = '$games_id' and ";
			$SQL .= "  hole_no = $hole_no";
			$this->SimpleDB->connect();			
			$this->SimpleDB->execute($SQL);
			$this->SimpleDB->disconnect();						
		}		
	}
		
	function calculate(){
		$games_id = $this->games_id;
		$this->SimpleDB->connect();
		
		$SQL  = "select ";
		$SQL .= "  count(hole_no),";
		$SQL .= "  sum(hole_length),";
		$SQL .= "  sum(hole_par),";
		$SQL .= "  sum(hole_hcp),";
		$SQL .= "  sum(hole_score),";
		$SQL .= "  sum(condor),";
		$SQL .= "  sum(albatros),";
		$SQL .= "  sum(eagles),";
		$SQL .= "  sum(birdies),";
		$SQL .= "  sum(pars),";
		$SQL .= "  sum(bogeys),";
		$SQL .= "  sum(dbogeys),";
		$SQL .= "  sum(tbogeys),";
		$SQL .= "  sum(others),";
		$SQL .= "  sum(hole_in_one),";
		$SQL .= "  sum(fir),";
		$SQL .= "  sum(rr1),";
		$SQL .= "  sum(lr1),";
		$SQL .= "  sum(bunker1),";
		$SQL .= "  sum(penalty1),";
		$SQL .= "  sum(gir),";
		$SQL .= "  sum(fairway),";
		$SQL .= "  sum(rr2),";
		$SQL .= "  sum(lr2),";
		$SQL .= "  sum(on_),";
		$SQL .= "  sum(bunker2),";
		$SQL .= "  sum(penalty2),";
		$SQL .= "  sum(putts),";
		$SQL .= "  sum(saves)";
		$SQL .= " from t_games_score ";
		$SQL .= " where ";
		$SQL .= "  games_id='$games_id'";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$cntHole = $rst->get(0);
			$cntLength = $rst->get(1);
			$cntPar = $rst->get(2);
			$cntHcp = $rst->get(3);
			$cntScore = $rst->get(4);
			$cntCondor = $rst->get(5);
			$cntAlbatros = $rst->get(6);
			$cntEagles = $rst->get(7);
			$cntBirdies = $rst->get(8);
			$cntPars = $rst->get(9);
			$cntBogeys = $rst->get(10);
			$cntDBogeys = $rst->get(11);
			$cntTBogeys = $rst->get(12);
			$cntOthers = $rst->get(13);
			$cntHoleInOne = $rst->get(14);
			$cntFIR = $rst->get(15);
			$cntGIR = $rst->get(20);
			$cntFairway = $rst->get(21);
			$cntRR = $rst->get(16) + $rst->get(22);
			$cntLR = $rst->get(17) + $rst->get(23);
			$cntBunker = $rst->get(18) + $rst->get(25);
			$cntPenalty = $rst->get(19) + $rst->get(26);
			$cntON = $rst->get(24);
			$cntPutts = $rst->get(27);
			$cntSaves = $rst->get(28);
		}		
		
		$SQL  = "select ";
		$SQL .= "  count(hole_no),";
		$SQL .= "  sum(hole_par),";
		$SQL .= "  sum(hole_score)";
		$SQL .= " from t_games_score ";
		$SQL .= " where ";
		$SQL .= "  games_id='$games_id' and hole_par = 3";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$cntPar3Hole = $rst->get(0);
			$cntPar3Par = $rst->get(1);
			$cntPar3Score = $rst->get(2);
		}
		
		$SQL  = "select ";
		$SQL .= "  count(hole_no),";
		$SQL .= "  sum(hole_par),";
		$SQL .= "  sum(hole_score)";
		$SQL .= " from t_games_score ";
		$SQL .= " where ";
		$SQL .= "  games_id='$games_id' and hole_par = 4";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$cntPar4Hole = $rst->get(0);
			$cntPar4Par = $rst->get(1);
			$cntPar4Score = $rst->get(2);
		}

		$SQL  = "select ";
		$SQL .= "  count(hole_no),";
		$SQL .= "  sum(hole_par),";
		$SQL .= "  sum(hole_score)";
		$SQL .= " from t_games_score ";
		$SQL .= " where ";
		$SQL .= "  games_id='$games_id' and hole_par = 5";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$cntPar5Hole = $rst->get(0);
			$cntPar5Par = $rst->get(1);
			$cntPar5Score = $rst->get(2);
		}
		
		$SQL  = "update t_games_result set";
		$SQL .= "  total_hole = $cntHole, ";
		$SQL .= "  total_length = $cntLength, ";
		$SQL .= "  total_hcp = $cntHcp, ";
		$SQL .= "  total_par = $cntPar, ";
		$SQL .= "  total_score = $cntScore, ";
		$SQL .= "  total_putts = $cntPutts, ";
		$SQL .= "  total_saves = $cntSaves, ";
		$SQL .= "  total_fir = $cntFIR, ";
		$SQL .= "  total_gir = $cntGIR, ";
		$SQL .= "  total_rr = $cntRR, ";
		$SQL .= "  total_lr = $cntLR, ";
		$SQL .= "  total_on = $cntON, ";
		$SQL .= "  total_fairways = $cntFairway, ";
		$SQL .= "  total_bunkers = $cntBunker, ";
		$SQL .= "  total_penalties = $cntPenalty, ";
		$SQL .= "  condor = $cntCondor, ";
		$SQL .= "  albatros = $cntAlbatros, ";
		$SQL .= "  eagles = $cntEagles, ";
		$SQL .= "  birdies = $cntBirdies, ";
		$SQL .= "  pars = $cntPars, ";
		$SQL .= "  bogeys = $cntBogeys, ";
		$SQL .= "  dbogeys = $cntDBogeys, ";
		$SQL .= "  tbogeys = $cntTBogeys, ";
		$SQL .= "  others = $cntOthers, ";
		$SQL .= "  hole_in_one = $cntHoleInOne, ";
		$SQL .= "  par3_hole = $cntPar3Hole, ";
		$SQL .= "  par3_score = $cntPar3Score, ";
		$SQL .= "  par4_hole = $cntPar4Hole, ";
		$SQL .= "  par4_score = $cntPar4Score, ";
		$SQL .= "  par5_hole = $cntPar5Hole, ";
		$SQL .= "  par5_score = $cntPar5Score ";
		$SQL .= " where ";
		$SQL .= "  games_id = '$games_id'";
		$this->SimpleDB->execute($SQL);
		
		$this->SimpleDB->disconnect();		
	}
}
?>