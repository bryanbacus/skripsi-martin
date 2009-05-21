<?php
require_once(PATH_CLASS. "/DBConn/DBManager.php");

class parameter_ranking{
	var $SimpleDB;
	
	function parameter_ranking(){
		$this->SimpleDB = new MySQLAccess();
		$this->SimpleDB->setHost(DB_HOST);
		$this->SimpleDB->setUser(DB_USER);
		$this->SimpleDB->setPassword(DB_PASS);
		$this->SimpleDB->setDBName(DB_NAME);
	}
	
	function add_param($position, $ranking_point, $prosentase){
		$this->SimpleDB->connect();
		
		$SQL = "select position_no from m_param_rankingpoints where position_no = $position";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && (!$rst->next())){
			$SQL = "insert into m_param_rankingpoints(position_no, ranking_points, prosentase_reward) values($position, $ranking_point, $prosentase)";
			$this->SimpleDB->execute($SQL);
		}
		$this->SimpleDB->disconnect();
	}
	
	function update_param($id_param, $position, $ranking, $prosentase){
		$this->SimpleDB->connect();
		
		$SQL = "update m_param_rankingpoints set position_no = $position, ranking_points = $ranking, prosentase_reward = $prosentase where id_param=$id_param";
		$this->SimpleDB->execute($SQL);
		
		$this->SimpleDB->disconnect();	
	}
	
	function remove_param($id_param){
		$this->SimpleDB->connect();
		
		$SQL = "delete from m_param_rankingpoints where id_param = $id_param";
		$this->SimpleDB->execute($SQL);
		
		$this->SimpleDB->disconnect();	
	}

	function get_ranking($id){
		$this->SimpleDB->connect();

		$result = array();
		$SQL = "select position_no, ranking_points, prosentase_reward from m_param_rankingpoints where id_param = '$id'";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$result[0]["position"] = $rst->get(0);
			$result[0]["points"] = $rst->get(1);
			$result[0]["prosentase"] = $rst->get(2);
		}
		$this->SimpleDB->disconnect();	
		return $result;
	}
	
	function get_rankingByPos($pos){
		$this->SimpleDB->connect();

		$result = array();
		$result[0]["position"] = 0;
		$result[0]["points"] = 0;
		$result[0]["prosentase"] = 0;		
		$SQL = "select position_no, ranking_points, prosentase_reward from m_param_rankingpoints where position_no = '$pos'";
		$rst = $this->SimpleDB->query($SQL);
		if((is_object($rst)) && ($rst->next())){
			$result[0]["position"] = $rst->get(0);
			$result[0]["points"] = $rst->get(1);
			$result[0]["prosentase"] = $rst->get(2);
		}
		$this->SimpleDB->disconnect();	
		return $result;
	}
			
	function get_list(){
		$this->SimpleDB->connect();
		
		$key = 0;
		$result = array();		
		$SQL = "select id_param, position_no, ranking_points, prosentase_reward from m_param_rankingpoints";
		$rst = $this->SimpleDB->query($SQL);
		while((is_object($rst)) && ($rst->next())){
			$result[$key]["id_param"] = $rst->get(0);
			$result[$key]["position"] = $rst->get(1);
			$result[$key]["points"] = $rst->get(2);
			$result[$key]["prosentase"] = $rst->get(3);			
			$key++;			
		}
		$this->SimpleDB->disconnect();	
		return $result;
	}
}
?>