<?php
require_once(PATH_CLASS. "/DBConn/DBManager.php");

class tournament_factory{
	
	var $SimpleDB;
	
	function tournament_factory(){
		$this->SimpleDB = new MySQLAccess();
		$this->SimpleDB->setHost(DB_HOST);
		$this->SimpleDB->setUser(DB_USER);
		$this->SimpleDB->setPassword(DB_PASS);
		$this->SimpleDB->setDBName(DB_NAME);		
	}
	
	function create_tournaments($tour){
		$tour->id = "G".$tour->level.$tour->type.date("YmdHis");
		$lanjut = true;
		if(trim($tour->name) == "") $lanjut = false;
		if(!is_numeric($tour->course_id))$lanjut = false;
		if(!is_numeric($tour->teebox)) $lanjut = false;
		if(!is_numeric($tour->type)) $lanjut = false;
		if(!is_numeric($tour->level)) $lanjut = false;
		
		if($lanjut){
			$SQL  = "insert into t_tournaments(";
			$SQL .= "  tour_id,";
			$SQL .= "  tour_name,";
			$SQL .= "  tour_place,";
			$SQL .= "  tour_descr,";
			$SQL .= "  tour_type,";
			$SQL .= "  tour_due_date,";
			$SQL .= "  tour_evt_date,";
			$SQL .= "  tour_max_player,";
			$SQL .= "  tour_reward,";
			$SQL .= "  tour_trial_points,";
			$SQL .= "  tour_levels,";
			$SQL .= "  tour_status,";
			$SQL .= "  course_id,";
			$SQL .= "  course_type_id)";
			$SQL .= " values(";
			$SQL .= "  '".$tour->id."',";
			$SQL .= "  '".$tour->name."',";
			$SQL .= "  '".$tour->place."',";
			$SQL .= "  '".$tour->desc."',";
			$SQL .= "  ".$tour->type.",";
			$SQL .= "  '".$tour->reg_date."',";
			$SQL .= "  '".$tour->evt_date."',";
			$SQL .= "  ".$tour->max_player.",";
			$SQL .= "  ".$tour->reward.",";
			$SQL .= "  ".$tour->points.",";
			$SQL .= "  ".$tour->level.",";
			$SQL .= "  ".$tour->status.",";
			$SQL .= "  ".$tour->course_id.",";
			$SQL .= "  ".$tour->teebox.")";
			$this->SimpleDB->connect();
			$this->SimpleDB->execute($SQL);
			$this->SimpleDB->disconnect();
			return $tour->id;
		}else{
			return "";
		}
	}
	
	function update_tournaments($tour){
		$SQL  = "update t_tournaments set";
		$SQL .= "  tour_name='".$tour->name."',";
		$SQL .= "  tour_place='".$tour->place."',";
		$SQL .= "  tour_descr='".$tour->desc."',";
		$SQL .= "  tour_type=".$tour->type.",";
		$SQL .= "  tour_due_date='".$tour->reg_date."',";
		$SQL .= "  tour_evt_date='".$tour->evt_date."',";
		$SQL .= "  tour_max_player=".$tour->max_player.",";
		$SQL .= "  tour_reward=".$tour->reward.",";
		$SQL .= "  tour_trial_points=".$tour->points.",";
		$SQL .= "  tour_levels=".$tour->level.",";
		$SQL .= "  tour_status=".$tour->status.",";
		$SQL .= "  course_id=".$tour->course_id.",";
		$SQL .= "  course_type_id=".$tour->teebox;
		$SQL .= " where tour_id ='".$tour->id."'";
		$this->SimpleDB->connect();
		$this->SimpleDB->execute($SQL);
		$this->SimpleDB->disconnect();	
	}
	
	function remove_tournaments($tour_id){
		$this->SimpleDB->connect();
		$SQL = "select games_id from t_games c where c.id_round_tour in (select id_round_tour from t_tournaments_round d where d.tour_id = '".$tour_id."')";
		$rst = $this->SimpleDB->query($SQL);
		$games = new games_factory();
		while((is_object($rst)) && ($rst->next())){
			$games_id = $rst->get(0);
			$games->remove_games($games_id);
		}
		$this->SimpleDB->disconnect();
		
		// UPDATE TBL_MEMBERSHIP
		$SQL = "select earning_reward, earning_ranking_points, earning_trial_points, membership_id from tbl_membership_reward where tour_id = '$tour_id'";
		$this->SimpleDB->connect();
		$rest = $this->SimpleDB->query($SQL);
		$this->SimpleDB->disconnect();
		while((is_object($rest)) && ($rest->next())){
			$voucher = $rst->get(0);
			$ranking = $rst->get(1);
			$trial = $rst->get(2); 
			$member_id = $rst->get(3); 

			$UPDT  = "update tbl_membership set ";
			$UPDT .= "  reward_earned = reward_earned - $voucher,";
			$UPDT .= "  ranking_point = ranking_point - $ranking,";
			$UPDT .= "  trial_point = trial_point - $trial,";
			$UPDT .= " where id='$member_id'";
			$this->SimpleDB->connect();
			$this->SimpleDB->execute($UPDT);
			$this->SimpleDB->disconnect();				
		}
		
		$SQL = array();
		$SQL[]  = "delete from tbl_membership_reward where tour_id = '".$tour_id."'";
		$SQL[]  = "delete from t_tournaments_round where tour_id = '".$tour_id."'";
		$SQL[]  = "delete from t_tournaments_indent where tour_id = '".$tour_id."'";
		$SQL[]  = "delete from t_tournaments_player where tour_id = '".$tour_id."'";
		$SQL[]  = "delete from t_tournaments where tour_id = '".$tour_id."'";
		$this->SimpleDB->connect();
		foreach($SQL as $var){
			$this->SimpleDB->execute($var);
		}
		$this->SimpleDB->disconnect();	
	}
	
	function getTournaments($tour_id){
		$this->SimpleDB->connect();

		$result = "";
		$SQL  = "select";
		$SQL .= "  tour_id,";
		$SQL .= "  tour_name,";
		$SQL .= "  tour_place,";
		$SQL .= "  tour_descr,";
		$SQL .= "  tour_type,";
		$SQL .= "  tour_due_date,";
		$SQL .= "  tour_evt_date,";
		$SQL .= "  tour_max_player,";
		$SQL .= "  tour_reward,";
		$SQL .= "  tour_trial_points,";
		$SQL .= "  tour_levels,";
		$SQL .= "  tour_status,";
		$SQL .= "  course_id,";
		$SQL .= "  course_type_id ";
		$SQL .= " from t_tournaments ";
		$SQL .= " where ";
		$SQL .= "  tour_id = '$tour_id'"; 
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$result = new tournaments();
			$result->id = $rst->get(0);
			$result->name = $rst->get(1);
			$result->place = $rst->get(2);
			$result->desc = $rst->get(3);
			$result->type = $rst->get(4);
			$result->reg_date = $rst->get(5);
			$result->evt_date = $rst->get(6);
			$result->max_player = $rst->get(7);
			$result->reward = $rst->get(8);
			$result->points = $rst->get(9);
			$result->level = $rst->get(10);
			$result->status = $rst->get(11);
			$result->course_id = $rst->get(12);
			$result->teebox = $rst->get(13);
		}
		
		$this->SimpleDB->disconnect();	
		return $result;		
	}
	
	function getTournamentsList($date_first = "", $date_last = "", $limit = "", $offset = "", $column = "", $value = ""){
		$this->SimpleDB->connect();
		
		$key = 0;		
		$arrList = array();

		$SQL = "select a.tour_id, a. tour_evt_date, a.tour_name, a.tour_place, b.course_name, a.tour_levels, a.tour_status from t_tournaments a , m_course b where a.course_id = b.course_id ";

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
		
		$SQL .= " and a.tour_evt_date between '$from' and '$to' order by a.tour_evt_date desc";	
		$rst = $this->SimpleDB->query($SQL);
		
		while((is_object($rst)) && ($rst->next())){
			$arrList[$key]['tour_id'] = $rst->get(0);
			$arrList[$key]['tour_evt_date'] = $rst->get(1);
			$arrList[$key]['tour_name'] = $rst->get(2);
			$arrList[$key]['tour_place'] = $rst->get(3);
			$arrList[$key]['tour_course'] = $rst->get(4);
			
			switch($rst->get(5)){
				case 1:
					$arrList[$key]['tour_levels'] = "International";
					break;
				case 2:
					$arrList[$key]['tour_levels'] = "National";
					break;				
				case 3:
					$arrList[$key]['tour_levels'] = "Regional";
					break;				
				case 4:
					$arrList[$key]['tour_levels'] = "Open";
					break;	
				case 5:
					$arrList[$key]['tour_levels'] = "Others";
					break;											
			}
			
			switch($rst->get(6)){
				case 1:
					$arrList[$key]['tour_status'] = "Open / Incoming";
					break;
				case 2:
					$arrList[$key]['tour_status'] = "Close / Match Play";
					break;				
			}
			$key++;
		}
		$this->SimpleDB->disconnect();	
		return $arrList;	
	}
	
	function getTournamentsOpenTopFive($limit = "5", $offset = "0", $status = 1){
		$this->SimpleDB->connect();
		
		$key = 0;		
		$arrList = array();

		$SQL = "select a.tour_id, a. tour_evt_date, a.tour_name, a.tour_place, b.course_name, a.tour_levels, a.tour_type from t_tournaments a , m_course b where a.course_id = b.course_id and a.tour_status=$status";
		$SQL .= " order by a.tour_evt_date asc limit $offset, $limit";

		$rst = $this->SimpleDB->query($SQL);
		
		while((is_object($rst)) && ($rst->next())){
			$arrList[$key]['tour_id'] = $rst->get(0);
			$arrList[$key]['tour_evt_date'] = $rst->get(1);
			$arrList[$key]['tour_name'] = $rst->get(2);
			$arrList[$key]['tour_place'] = $rst->get(3);
			$arrList[$key]['tour_course'] = $rst->get(4);
			
			switch($rst->get(5)){
				case 1:
					$arrList[$key]['tour_levels'] = "International";
					break;
				case 2:
					$arrList[$key]['tour_levels'] = "National";
					break;				
				case 3:
					$arrList[$key]['tour_levels'] = "Regional";
					break;				
				case 4:
					$arrList[$key]['tour_levels'] = "Open";
					break;	
				case 5:
					$arrList[$key]['tour_levels'] = "Others";
					break;											
			}

			switch($rst->get(6)){
				case 1:
					$arrList[$key]['tour_status'] = "Open";
					break;
				case 2:
					$arrList[$key]['tour_status'] = "Invitational";
					break;				
				case 3:
					$arrList[$key]['tour_status'] = "Closed / Internal Only";
					break;				
				case 2:
					$arrList[$key]['tour_status'] = "Others";
					break;														
			}
			$key++;
		}
		$this->SimpleDB->disconnect();	
		return $arrList;	
	}
	
	function getTournamentsHistory($year, $level, $type){
		$this->SimpleDB->connect();
		
		$key = 0;		
		$arrList = array();

		$SQL = "select a.tour_id, a. tour_evt_date, a.tour_name, a.tour_place, b.course_name, a.tour_levels, a.tour_type from t_tournaments a , m_course b where a.course_id = b.course_id and a.tour_status=2 and year(tour_evt_date)='$year'";
		if($level != "all")	$SQL .= " and tour_levels=$level";
		if($type != "all")	$SQL .= " and tour_type=$type";
		$SQL .= " order by a.tour_evt_date asc";
		$rst = $this->SimpleDB->query($SQL);
		while((is_object($rst)) && ($rst->next())){
			$arrList[$key]['tour_id'] = $rst->get(0);
			$arrList[$key]['tour_evt_date'] = $rst->get(1);
			$arrList[$key]['tour_name'] = $rst->get(2);
			$arrList[$key]['tour_place'] = $rst->get(3);
			$arrList[$key]['tour_course'] = $rst->get(4);
			
			switch($rst->get(5)){
				case 1:
					$arrList[$key]['tour_levels'] = "International";
					break;
				case 2:
					$arrList[$key]['tour_levels'] = "National";
					break;				
				case 3:
					$arrList[$key]['tour_levels'] = "Regional";
					break;				
				case 4:
					$arrList[$key]['tour_levels'] = "Open";
					break;	
				case 5:
					$arrList[$key]['tour_levels'] = "Others";
					break;											
			}

			switch($rst->get(6)){
				case 1:
					$arrList[$key]['tour_status'] = "Open";
					break;
				case 2:
					$arrList[$key]['tour_status'] = "Invitational";
					break;				
				case 3:
					$arrList[$key]['tour_status'] = "Closed / Internal Only";
					break;				
				case 2:
					$arrList[$key]['tour_status'] = "Others";
					break;														
			}
			$key++;
		}
		$this->SimpleDB->disconnect();	
		return $arrList;	
	}	
	
	function CalculateTournaments($tour_id){
		$tournaments = $this->getTournaments($tour_id);
		$parameter = new parameter_ranking();
		$REWARD = $tournaments->reward;
		$TRIAL_POINT = $tournaments->points;
		$TRIAL_ACUAN = 0;
		$key = 1;
		
		// Select All Games Result where belong tournaments Order By Total_Score Asc
		$SQL  ="select ";
		$SQL .="  sum(a.total_par) as par,";
		$SQL .="  sum(a.total_score) as score,";
		$SQL .="  b.id_player,";
		$SQL .="  b.members_id,";
		$SQL .="  b.members_name";
		$SQL .=" from t_games_result a inner join t_games b";
		$SQL .=" where a.games_id = b.games_id ";
		$SQL .="  and b.id_round_tour in (select id_round_tour from t_tournaments_round d where d.tour_id='$tour_id')";
		$SQL .=" group by b.id_player order by score asc";
		
		$this->SimpleDB->connect();
		$rst = $this->SimpleDB->query($SQL);
		$this->SimpleDB->disconnect();
		while((is_object($rst)) && ($rst->next())){
			$score = $rst->get(1);
			$player_id = $rst->get(2);
			$member_id = $rst->get(3);
			$member_name = $rst->get(4);
			if($key == 1) $TRIAL_ACUAN = $score;
			
			$param = $parameter->get_rankingByPos($key);
			$prosentase = $param[0]["prosentase"];
			
			$voucher = ($prosentase / 100) * $REWARD;
			$ranking = $param[0]["points"];
			$trial = $TRIAL_POINT - ($score - $TRIAL_ACUAN);
			
			// Update T_Tournaments_Player
			$SQL  ="update t_tournaments_player set";
			$SQL .="  par_total = $score,";
			$SQL .="  ranking_points = $ranking,";
			$SQL .="  voucher_points = $voucher,";
			$SQL .="  trial_points = $trial,";
			$SQL .="  position = $key";
			$SQL .=" where tour_playerid = $player_id";
			$this->SimpleDB->connect();
			$this->SimpleDB->execute($SQL);
			$this->SimpleDB->disconnect();
			
			// CHECK EXIST TOUR ID in TBL_MEMBERSHIP_REWARD WHERE ID_MEMBER NOT EMPTY
			if(trim($member_id) != ""){
				$SQL = "select tour_id from tbl_membership_reward where tour_id = '$tour_id' and membership_id = '$member_id'";
				
				$UPDT  = "update tbl_membership_reward set ";
				$UPDT .= "  earning_reward = $voucher,";
				$UPDT .= "  earning_ranking_points = $ranking,";
				$UPDT .= "  earning_trial_points = $trial";
				$UPDT .= " where tour_id='$tour_id' and membership_id='$member_id'";

				$INST  = "insert intp tbl_membership_reward(membership_id, membership_name, post_date, tour_id, earning_reward, earning_ranking_points, earning_trial_points) values(";
				$INST .= "  '$member_id',";
				$INST .= "  '$member_name',";
				$INST .= "  '".date("Y/m/d")."',";
				$INST .= "  '$tour_id',";
				$INST .= "  $voucher,";
				$INST .= "  $ranking,";
				$INST .= "  $trial)";
								
				$this->SimpleDB->connect();
				$rest = $this->SimpleDB->query($SQL);
				$this->SimpleDB->disconnect();
				
				// IF EXIST UPDATE, ELSE INSERT
				if((is_object($rest)) && ($rest->next())){
					$this->SimpleDB->connect();
					$this->SimpleDB->execute($UPDT);
					$this->SimpleDB->disconnect();				
				}else{
					$this->SimpleDB->connect();
					$this->SimpleDB->execute($INST);
					$this->SimpleDB->disconnect();				
				}
				
				// CALCULATE TBL_MEMBERSHIP
				$SQL = "select sum(a.earning_reward), sum(a.earning_ranking_points), sum(a.earning_trial_points) from tbl_membership_reward a where a.membership_id = '$member_id'";
				$this->SimpleDB->connect();
				$rast = $this->SimpleDB->query($SQL);
				$this->SimpleDB->disconnect();
				if((is_object($rast)) && ($rast->next())){
					$UPDT  = "update tbl_membership set ";
					$UPDT .= "  reward_earned = ".$rast->get(0).",";
					$UPDT .= "  ranking_point = ".$rast->get(1).",";
					$UPDT .= "  trial_point = ".$rast->get(2)."";
					$UPDT .= " where id='$member_id'";
								
					$this->SimpleDB->connect();
					$this->SimpleDB->execute($UPDT);
					$this->SimpleDB->disconnect();				
				}				
			}
			$key++;
		}
	}
	
	function getMemberList($limit = "", $offset = ""){
		$this->SimpleDB->connect();
		
		$key = 0;		
		$arrList = array();

		$SQL = "select a.id, a.name, (select b.type from m_group b where a.group_type = b.id) group_type, a.ortu, a.norumah from tbl_membership a order by a.id, a.name";
		$rst = $this->SimpleDB->query($SQL);
		while((is_object($rst)) && ($rst->next())){
			$arrList[$key]['player_members_id'] = $rst->get(0);
			$arrList[$key]['player_name'] = $rst->get(1);
			$arrList[$key]['player_group'] = $rst->get(2);
			$arrList[$key]['player_parents_name'] = $rst->get(3);
			$arrList[$key]['player_contactno'] = $rst->get(4);
			$key++;
		}
		$this->SimpleDB->disconnect();	
		return $arrList;	
	}
	
	function getMember($member_id){
		$this->SimpleDB->connect();
		
		$arrList = array();
		$SQL = "select a.id, a.name, (select b.type from m_group b where a.group_type = b.id) group_type, a.ortu, a.norumah, (select c.age from tbl_child c where c.no_membership = a.id) age, a.tgllahir, a.email, a.alamat from tbl_membership a where a.id =  '$member_id'";
		$rst = $this->SimpleDB->query($SQL);
		while((is_object($rst)) && ($rst->next())){
			$arrList['player_members_id'] = $rst->get(0);
			$arrList['player_name'] = $rst->get(1);
			$arrList['player_group'] = $rst->get(2);
			$arrList['player_parents_name'] = $rst->get(3);
			$arrList['player_contactno'] = $rst->get(4);
			$arrList['player_age'] = $rst->get(5);
			$arrList['birth_date'] = $rst->get(6);
			$arrList['player_email'] = $rst->get(7);
			$arrList['player_home_address'] = $rst->get(8);
		}
		$this->SimpleDB->disconnect();	
		return $arrList;		
	}
}

class tournaments{
	var $SimpleDB;
	
	var $id = "";
	var $name = "";
	var $place = "";
	var $level = "";
	var $type = "";
	var $evt_date = "";
	var $reg_date = "";
	var $course_id = "";
	var $teebox = "";
	var $max_player = "";
	var $reward = "";
	var $points = "";
	var $status = "";
	var $desc = "";
		
	function tournaments($id = ""){
		$this->id = $id;
		$this->SimpleDB = new MySQLAccess();
		$this->SimpleDB->setHost(DB_HOST);
		$this->SimpleDB->setUser(DB_USER);
		$this->SimpleDB->setPassword(DB_PASS);
		$this->SimpleDB->setDBName(DB_NAME);		
	}
	
	function add_round($round_no, $round_date, $weather, $rule, $note){
		$this->SimpleDB->connect();
		$SQL = "select round_no from t_tournaments_round where round_no=$round_no and tour_id='$this->id'";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && (!$rst->next())){
			$SQL  = "insert into t_tournaments_round(";
			$SQL .= "  tour_id,";
			$SQL .= "  round_no,";
			$SQL .= "  round_date,";
			$SQL .= "  round_weather,";
			$SQL .= "  round_holeplay,";
			$SQL .= "  round_note)";
			$SQL .= " values(";
			$SQL .= "  '".$this->id."',";
			$SQL .= "  ".$round_no.",";
			$SQL .= "  '".$round_date."',";
			$SQL .= "  '".$weather."',";
			$SQL .= "  '".$rule."',";
			$SQL .= "  '".$note."')";
			$this->SimpleDB->execute($SQL);
		}
		$this->SimpleDB->disconnect();
		
		$SQL  = "update t_tournaments_player set";
		$SQL .= "  player_confirmed = 0";
		$SQL .= " where tour_id = '$this->id'";
		$this->SimpleDB->connect();
		$this->SimpleDB->execute($SQL);
		$this->SimpleDB->disconnect();		
	}
	
	function update_round($round_id, $round_no, $round_date, $weather, $rule, $note){
		$this->SimpleDB->connect();
		$SQL = "select round_no from t_tournaments_round where id_round_tour=$round_id";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$SQL  = "update t_tournaments_round set";
			$SQL .= "  round_date='".$round_date."',";
			$SQL .= "  round_weather='".$weather."',";
			$SQL .= "  round_holeplay='".$rule."',";
			$SQL .= "  round_note='".$note."'";
			$SQL .= " where id_round_tour= $round_id";
			$this->SimpleDB->execute($SQL);
		}
		$this->SimpleDB->disconnect();	
		
		$this->SimpleDB->connect();
		$SQL = "select games_id from t_games c where c.id_round_tour=$round_id";
		$rst = $this->SimpleDB->query($SQL);
		$games = new games_factory();
		while((is_object($rst)) && ($rst->next())){
			$games_id = $rst->get(0);
			$games->remove_games($games_id);
		}
		$this->SimpleDB->disconnect();			
		
		$SQL  = "update t_tournaments_player set";
		$SQL .= "  player_confirmed = 0";
		$SQL .= " where tour_id = '$this->id'";
		$this->SimpleDB->connect();
		$this->SimpleDB->execute($SQL);
		$this->SimpleDB->disconnect();				
	}
	
	function remove_round($round_id){
		$this->SimpleDB->connect();
		$SQL = "select games_id from t_games c where c.id_round_tour=$round_id";
		$rst = $this->SimpleDB->query($SQL);
		$games = new games_factory();
		while((is_object($rst)) && ($rst->next())){
			$games_id = $rst->get(0);
			$games->remove_games($games_id);
		}
		$this->SimpleDB->disconnect();
			
		$SQL  = "delete from t_tournaments_round where id_round_tour=$round_id";
		$this->SimpleDB->connect();
		$this->SimpleDB->execute($SQL);
		$this->SimpleDB->disconnect();
	}
	
	function getRound($round_id){
		if($this->id != ""){
			$this->SimpleDB->connect();
			$key = 0;		
			$arrList = array();
			$SQL  = "select id_round_tour, tour_id, round_no, round_date, round_weather, round_holeplay, round_note from t_tournaments_round where id_round_tour='$round_id'";
			$rst = $this->SimpleDB->query($SQL);
			
			if((is_object($rst)) && ($rst->next())){
				$arrList[$key]['round_id'] = $rst->get(0);
				$arrList[$key]['tour_id'] = $rst->get(1);
				$arrList[$key]['round_no'] = $rst->get(2);
				$arrList[$key]['round_date'] = $rst->get(3);
				$arrList[$key]['round_weather'] = $rst->get(4);
				$arrList[$key]['round_rule'] = $rst->get(5);
				$arrList[$key]['round_note'] = $rst->get(6);
				$key++;
			}
			$this->SimpleDB->disconnect();	
			return $arrList;		
		}else{
			return "";
		}	
	}
	
	function getRoundList(){
		if($this->id != ""){
			$this->SimpleDB->connect();
			$key = 0;		
			$arrList = array();
			$SQL  = "select id_round_tour, tour_id, round_no, round_date, round_weather, round_holeplay, round_note from t_tournaments_round where tour_id='$this->id'";
			$SQL .= " order by round_no";	
			$rst = $this->SimpleDB->query($SQL);
			
			while((is_object($rst)) && ($rst->next())){
				$arrList[$key]['round_id'] = $rst->get(0);
				$arrList[$key]['tour_id'] = $rst->get(1);
				$arrList[$key]['round_no'] = $rst->get(2);
				$arrList[$key]['round_date'] = $rst->get(3);
				$arrList[$key]['round_weather'] = $rst->get(4);
				switch($rst->get(5)){
					case 1:
						$arrList[$key]['round_rule'] = "18 HOLES";
						break;
					case 2:
						$arrList[$key]['round_rule'] = "9-OUT";
						break;
					case 3:
						$arrList[$key]['round_rule'] = "9-IN";
						break;												
				}
				$arrList[$key]['round_rulehole'] = $rst->get(5);
				$arrList[$key]['round_note'] = $rst->get(6);
				$key++;
			}
			$this->SimpleDB->disconnect();	
			return $arrList;		
		}else{
			return "";
		}
	}
	
	function add_player($player){
		$SQL  = "insert into t_tournaments_player(";
		$SQL .= "  tour_id,";
		$SQL .= "  player_members_id,";
		$SQL .= "  player_name,";
		$SQL .= "  player_age,";
		$SQL .= "  player_birthdate,";
		$SQL .= "  player_parents_name,";
		$SQL .= "  player_contactno,";
		$SQL .= "  player_email,";
		$SQL .= "  player_homeaddress,";
		$SQL .= "  player_group,";
		$SQL .= "  indent_id,";
		$SQL .= "  player_confirmed)";
		$SQL .= " values(";
		$SQL .= "  '$this->id',";
		$SQL .= "  '$player->player_members_id',";
		$SQL .= "  '$player->player_name',";
		$SQL .= "  '$player->player_age',";
		$SQL .= "  '$player->player_birthdate',";
		$SQL .= "  '$player->player_parents_name',";
		$SQL .= "  '$player->player_contactno',";
		$SQL .= "  '$player->player_email',";
		$SQL .= "  '$player->player_home_address',";
		$SQL .= "  '$player->player_group',";
		$SQL .= "  '$player->indent_id',";
		$SQL .= "  0)";				
		$this->SimpleDB->connect();
		$this->SimpleDB->execute($SQL);
		$this->SimpleDB->disconnect();
	}
	
	function update_player($player){
		$SQL  = "update t_tournaments_player set";
		$SQL .= "  player_members_id = '$player->player_members_id',";
		$SQL .= "  player_name = '$player->player_name',";
		$SQL .= "  player_age = '$player->player_age',";
		$SQL .= "  player_birthdate = '$player->player_birthdate',";
		$SQL .= "  player_parents_name = '$player->player_parents_name',";
		$SQL .= "  player_contactno = '$player->player_contactno',";
		$SQL .= "  player_email = '$player->player_email',";
		$SQL .= "  player_homeaddress = '$player->player_home_address',";
		$SQL .= "  player_group = '$player->player_group'";
		$SQL .= " where tour_playerid = $player->player_id";
		$this->SimpleDB->connect();
		$this->SimpleDB->execute($SQL);
		$this->SimpleDB->disconnect();	
	}
	
	function confirm_player($player_id){
		$SQL  = "update t_tournaments_player set";
		$SQL .= "  player_confirmed = 1";
		$SQL .= " where tour_playerid = $player_id";
		$this->SimpleDB->connect();
		$this->SimpleDB->execute($SQL);
		$this->SimpleDB->disconnect();

		// Create Games
		$player = $this->getPlayer($player_id);
		$roundlist = $this->getRoundList();
		$tourm = new tournament_factory();
		$toura = $tourm->getTournaments($this->id);
		foreach($roundlist as $round){
				$id_round = $round['round_id'];
				$id_player = $player[0]['player_id'];
				$games_date = $round['round_date'];
				$weather = $round['round_weather'];
				$notes = $round['round_note']; 
				$rule = $round['round_rulehole'];
				$course = $toura->course_id;
				$tee = $toura->teebox;
				$members_id = $player[0]['player_members_id'];
				$members_name = $player[0]['player_name'];
				$members_group = $player[0]['player_group'];
				$members_age = $player[0]['player_age'];
				$this->create_games($id_round, $id_player, $games_date, $weather, $notes, $rule, $course, $tee, $members_id, $members_name, $members_group, $members_age);
		}
	}
	
	function remove_player($player_id){
		$this->SimpleDB->connect();
		$SQL = "select games_id from t_games c where c.id_player=$player_id";
		$rst = $this->SimpleDB->query($SQL);
		$games = new games_factory();
		while((is_object($rst)) && ($rst->next())){
			$games_id = $rst->get(0);
			$games->remove_games($games_id);
		}
		$this->SimpleDB->disconnect();
			
		$this->SimpleDB->connect();
		$SQL = array();
		$SQL[]  = "delete from t_tournaments_player where tour_playerid = $player_id";
		$SQL[]  = "delete from t_tournaments_indent where indent_id in (select indent_id from t_tournaments_player where tour_playerid=$player_id)";
		foreach($SQL as $var){
			$this->SimpleDB->execute($var);
		}
		$this->SimpleDB->disconnect();		
	}
		
	function create_games($id_round, $id_player, $games_date, $weather, $notes, $rule, $course, $tee, $members_id, $members_name, $members_group, $members_age){
		$this->SimpleDB->connect();
		$SQL  = "select games_id from t_games where id_round_tour=$id_round and id_player=$id_player";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && (!$rst->next())){
			$games = new games();
			$games->games_date = $games_date;
			$games->games_weather = $weather;
			$games->games_type = 2;
			$games->games_note = $notes;
			$games->games_holeplay = $rule;
			$games->course_id = $course;
			$games->course_length_id = $tee;
			$games->members_id = $members_id;
			$games->members_name = $members_name;
			$games->members_group = $members_group;
			$games->members_age = $members_age;		
			$games->id_round_tour = $id_round;
			$games->id_player = $id_player;
			
			$games_fact = new games_factory();
			$games_fact->create_games($games);
		}
		$this->SimpleDB->disconnect();	
	}
	
	function getPlayer($player_id){
		$this->SimpleDB->connect();
		$arrList = "";
		
		if($player_id != ""){
			$SQL  = "select tour_playerid, tour_id, player_members_id, player_name, player_age, player_birthdate, player_parents_name, player_contactno, player_email, player_homeaddress, player_group, player_confirmed from t_tournaments_player where tour_playerid='$player_id' ";
			$rst = $this->SimpleDB->query($SQL);
			if((is_object($rst)) && ($rst->next())){
				$arrList = array();
				$arrList[0]['player_id'] = $rst->get(0);
				$arrList[0]['tour_id'] = $rst->get(1);
				$arrList[0]['player_members_id'] = trim($rst->get(2));
				$arrList[0]['player_name'] = $rst->get(3);
				$arrList[0]['player_age'] = $rst->get(4);
				$arrList[0]['player_birthdate'] = $rst->get(5);
				$arrList[0]['player_parents_name'] = $rst->get(6);
				$arrList[0]['player_contactno'] = $rst->get(7);
				$arrList[0]['player_email'] = $rst->get(8);
				$arrList[0]['player_home_address'] = $rst->get(9);
				$arrList[0]['player_group'] = $rst->get(10);
				$arrList[0]['player_confirmed'] = trim($rst->get(11));
			}
		}		
		$this->SimpleDB->disconnect();	
		return $arrList;		
	}
	
	function getPlayerList($limit = "", $offset = "", $column = "", $value = ""){
		if($this->id != ""){
			$this->SimpleDB->connect();
			$key = 0;		
			$arrList = array();
			$SQL  = "select tour_playerid, tour_id, player_members_id, player_name, player_age, player_birthdate, player_parents_name, player_contactno, player_email, player_homeaddress, player_group, player_confirmed from t_tournaments_player where tour_id='$this->id' ";
			if(($column != "") && ($value != "")) $SQL .= " and ".$column." like '%".$value."%'";
			$SQL .= " order by tour_playerid";
			$rst = $this->SimpleDB->query($SQL);
			while((is_object($rst)) && ($rst->next())){
				$arrList[$key]['player_id'] = $rst->get(0);
				$arrList[$key]['tour_id'] = $rst->get(1);
				$arrList[$key]['player_members_id'] = (trim($rst->get(2)) == "") ? "Not IJGC Members" : $rst->get(2);
				$arrList[$key]['player_name'] = $rst->get(3);
				$arrList[$key]['player_age'] = $rst->get(4);
				$arrList[$key]['player_birthdate'] = $rst->get(5);
				$arrList[$key]['player_parents_name'] = $rst->get(6);
				$arrList[$key]['player_contactno'] = $rst->get(7);
				$arrList[$key]['player_email'] = $rst->get(8);
				$arrList[$key]['player_home_address'] = $rst->get(9);
				$arrList[$key]['player_group'] = $rst->get(10);
				$arrList[$key]['player_confirmed'] = (trim($rst->get(11)) == "0") ? "Not Confirmed" : "Confirmed";
				$key++;
			}
			$this->SimpleDB->disconnect();	
			return $arrList;		
		}else{
			return "";
		}		
	}
	
	function getPositionList(){
		if($this->id != ""){
			$this->SimpleDB->connect();
			$key = 0;		
			$arrList = array();
			$SQL  = "select player_name, player_group, par_total, ranking_points, trial_points, voucher_points from t_tournaments_player where tour_id='$this->id' ";
			$SQL .= " order by par_total asc";
			$rst = $this->SimpleDB->query($SQL);
			while((is_object($rst)) && ($rst->next())){
				$arrList[$key]['position_no'] = $key + 1;
				$arrList[$key]['player_name'] = $rst->get(0);
				$arrList[$key]['player_group'] = $rst->get(1);
				$arrList[$key]['player_score'] = $rst->get(2);
				$arrList[$key]['player_ranking'] = $rst->get(3);
				$arrList[$key]['player_trial'] = $rst->get(4);
				$arrList[$key]['player_reward'] = $rst->get(5);
				$key++;
			}
			$this->SimpleDB->disconnect();	
			return $arrList;		
		}else{
			return "";
		}			
	}
	
	function getGamesID($id_round, $id_player){
		$arrList = "";
		
		$this->SimpleDB->connect();
		$SQL  = "select games_id from t_games where id_round_tour=$id_round and id_player=$id_player";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())) $arrList = $rst->get(0);
		$this->SimpleDB->disconnect();	
		return $arrList;	
	}
	
	function getResultRound($round_id){
		$this->SimpleDB->connect();
		$SQL  = "select games_id, members_name from t_games where id_round_tour='$round_id' ";
		$rst = $this->SimpleDB->query($SQL);
		$this->SimpleDB->disconnect();
		
		$key = 0;
		$arrList = array();
		while((is_object($rst)) && ($rst->next())){
			$games = new games($rst->get(0));
			$data = $games->getDetail();
			$arrList[$key]['name'] = $rst->get(1);
			
			$out = 0;
			$in = 0;
			for($a=1;$a<=18;$a++){
				if($a <= 9) $out += $data[$a]['score'];
				if($a > 9) $in += $data[$a]['score']; 
				$arrList[$key]['hole'.$a.'_score'] = $data[$a]['score'];
			}
			$arrList[$key]['holeout_score'] = $out;
			$arrList[$key]['holein_score'] = $in;
			$arrList[$key]['holetotal_score'] = $out + $in;
			$key++;
		}
		return $arrList;
	}
}

class tournaments_register{
	var $SimpleDB;
	var $tour_id = "";
	
	function tournaments_register($tour_id){
		$this->tour_id = $tour_id;
		
		$this->SimpleDB = new MySQLAccess();
		$this->SimpleDB->setHost(DB_HOST);
		$this->SimpleDB->setUser(DB_USER);
		$this->SimpleDB->setPassword(DB_PASS);
		$this->SimpleDB->setDBName(DB_NAME);		
	}
	
	function create_indentRegistrant($player){
		$tanggal = date("Y/m/d");	
		$SQL  = "insert into t_tournaments_indent(";
		$SQL .= "  tour_id,";
		$SQL .= "  register_date,";
		$SQL .= "  player_members_id,";
		$SQL .= "  player_name,";
		$SQL .= "  player_age,";
		$SQL .= "  player_birthdate,";
		$SQL .= "  player_parents_name,";
		$SQL .= "  player_contactno,";
		$SQL .= "  player_email,";
		$SQL .= "  player_home_address,";
		$SQL .= "  player_group,";
		$SQL .= "  player_approved)";
		$SQL .= " values(";
		$SQL .= "  '$player->tour_id',";
		$SQL .= "  '$tanggal',";
		$SQL .= "  '$player->player_members_id',";
		$SQL .= "  '$player->player_name',";
		$SQL .= "  '$player->player_age',";
		$SQL .= "  '$player->player_birthdate',";
		$SQL .= "  '$player->player_parents_name',";
		$SQL .= "  '$player->player_contactno',";
		$SQL .= "  '$player->player_email',";
		$SQL .= "  '$player->player_home_address',";
		$SQL .= "  '$player->player_group',";
		$SQL .= "  0)";				
		$this->SimpleDB->connect();
		$this->SimpleDB->execute($SQL);
		$this->SimpleDB->disconnect();
	}
	
	function approve_indentRegistrant($indent_id){
		$SQL  = "update t_tournaments_indent set";
		$SQL .= "  player_approved= 1";
		$SQL .= " where tour_id ='$this->tour_id' and indent_id=$indent_id";
		$this->SimpleDB->connect();
		$this->SimpleDB->execute($SQL);
		$this->SimpleDB->disconnect();	
		
		// Move To Player
		$this->SimpleDB->connect();
		$SQL  = "select indent_id from t_tournaments_player where indent_id=$indent_id";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && (!$rst->next())){
			$data = $this->get_registrant($indent_id);

			$player = new player();
			$player->player_id = "";
			$player->tour_id = $data[0]['tour_id'];
			$player->player_members_id = ($data[0]['player_members_id'] == "Not IJGC Members") ? " ": $data[0]['player_members_id'];
			$player->player_name = $data[0]['player_name'];
			$player->player_age = $data[0]['player_age'];
			$player->player_birthdate = $data[0]['player_birthdate'];
			$player->player_parents_name = $data[0]['player_parents_name'];
			$player->player_contactno = $data[0]['player_contactno'];
			$player->player_email = $data[0]['player_email'];
			$player->player_home_address = $data[0]['player_home_address'];
			$player->player_group = $data[0]['player_group'];
			$player->indent_id = $data[0]['indent_id'];
			$player->player_confirmed = 0;
				
			$tournaments = new tournaments($this->tour_id);
			$tournaments->add_player($player);
		}
		$this->SimpleDB->disconnect();
	}

	function get_registrant($indent_id){
		$arrList = "";
		
		$this->SimpleDB->connect();
		$SQL  = "select indent_id, tour_id, register_date, player_members_id, player_name, player_age, player_birthdate, player_parents_name, player_contactno, player_email, player_home_address, player_group, player_approved from t_tournaments_indent where indent_id='$indent_id' ";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$arrList = array();
			$arrList[0]['indent_id'] = $rst->get(0);
			$arrList[0]['tour_id'] = $rst->get(1);
			$arrList[0]['register_date'] = $rst->get(2);
			$arrList[0]['player_members_id'] = (trim($rst->get(3)) == "") ? "Not IJGC Members" : $rst->get(3);
			$arrList[0]['player_name'] = $rst->get(4);
			$arrList[0]['player_age'] = $rst->get(5);
			$arrList[0]['player_birthdate'] = $rst->get(6);
			$arrList[0]['player_parents_name'] = $rst->get(7);
			$arrList[0]['player_contactno'] = $rst->get(8);
			$arrList[0]['player_email'] = $rst->get(9);
			$arrList[0]['player_home_address'] = $rst->get(10);
			$arrList[0]['player_group'] = $rst->get(11);
			$arrList[0]['player_approved'] = ($rst->get(12) == 0) ? "Not Approved" : "Approved";
		}	
		$this->SimpleDB->disconnect();	
		return $arrList;		
	}
	
	function get_registerlist($limit = "", $offset = "", $column = "", $value = ""){
		if($this->tour_id != ""){
			$this->SimpleDB->connect();
			$key = 0;		
			$arrList = array();
			$SQL  = "select indent_id, tour_id, register_date, player_members_id, player_name, player_age, player_birthdate, player_parents_name, player_contactno, player_email, player_home_address, player_group, player_approved from t_tournaments_indent where tour_id='$this->tour_id' ";
			if(($column != "") && ($value != "")) $SQL .= " and ".$column." like '%".$value."%'";
			$SQL .= " order by indent_id";
			$rst = $this->SimpleDB->query($SQL);
			while((is_object($rst)) && ($rst->next())){
				$arrList[$key]['indent_id'] = $rst->get(0);
				$arrList[$key]['tour_id'] = $rst->get(1);
				$arrList[$key]['register_date'] = $rst->get(2);
				$arrList[$key]['player_members_id'] = (trim($rst->get(3)) == "") ? "Not IJGC Members" : $rst->get(3);
				$arrList[$key]['player_name'] = $rst->get(4);
				$arrList[$key]['player_age'] = $rst->get(5);
				$arrList[$key]['player_birthdate'] = $rst->get(6);
				$arrList[$key]['player_parents_name'] = $rst->get(7);
				$arrList[$key]['player_contactno'] = $rst->get(8);
				$arrList[$key]['player_email'] = $rst->get(9);
				$arrList[$key]['player_home_address'] = $rst->get(10);
				$arrList[$key]['player_group'] = $rst->get(11);
				$arrList[$key]['player_approved'] = ($rst->get(12) == 0) ? "Not Approved" : "Approved";
				$key++;
			}
			$this->SimpleDB->disconnect();	
			return $arrList;		
		}else{
			return "";
		}	
	}
}

class player{
	var $player_id;
	var $tour_id;
	var $player_members_id;
	var $player_name;
	var $player_age;
	var $player_birthdate;
	var $player_parents_name;
	var $player_contactno;
	var $player_email;
	var $player_home_address;
	var $player_group;
	var $player_confirmed;
	var $indent_id = -1;
	
	function player(){}
}
?>