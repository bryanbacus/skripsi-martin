<?php
require_once(PATH_IJGA. "/DBConn/DBManager.php");

class games_statistic{
	
	var $SimpleDB;
	
	function games_statistic(){
		$this->SimpleDB = new MySQLAccess();
		$this->SimpleDB->setHost(DB_HOST);
		$this->SimpleDB->setUser(DB_USER);
		$this->SimpleDB->setPassword(DB_PASS);
		$this->SimpleDB->setDBName(DB_NAME);	
	}
	
	function getStatistic($member_id, $date_first, $date_last, $games_type){
		
		if(($member_id != "") && ($date_first != "") && ($date_last != "") && ($games_type != "none")){
			$date_first = $date_first." 00:00:00";
			$date_last = $date_last." 23:59:59";
					
			$this->SimpleDB->connect();
			$result = array();
			
			// Get Data Member
			$SQL  = "select";
			$SQL .= "  id,";
			$SQL .= "  name,";
			$SQL .= "  golfclub,";
			$SQL .= "  tgllahir ";
			$SQL .= " from tbl_membership";
			$SQL .= " where id='$member_id'";
			$rst = $this->SimpleDB->query($SQL);
			if((is_object($rst)) && ($rst->next())){
				$id = $rst->get(0);
				$nama = $rst->get(1);
				$club = $rst->get(2);
				$birth = $rst->get(3);
				
				$age = date("Y-m-d") - $birth;
			}
			
			// Get Statistic
			
			$SQL  = "select";
			$SQL .= "  count(games_id) as cnt_game,";
			$SQL .= "  sum(total_hole) as cnt_hole,";
			$SQL .= "  sum(total_score) as cnt_core,";
			$SQL .= "  sum(total_putts) as cnt_putts,";
			$SQL .= "  sum(total_saves) as cnt_saves,";
			$SQL .= "  sum(total_fir) as cnt_fir,";
			$SQL .= "  sum(par3_hole) as cnt_par3,";
			$SQL .= "  sum(par4_hole) as cnt_par4,";
			$SQL .= "  sum(par5_hole) as cnt_par5,";
			$SQL .= "  sum(total_gir) as cnt_gir,";
			$SQL .= "  sum(total_fairways) as cnt_fairways,";
			$SQL .= "  sum(total_rr) as cnt_rr,";
			$SQL .= "  sum(total_lr) as cnt_lr,";
			$SQL .= "  sum(total_bunkers) as cnt_bunkers,";
			$SQL .= "  sum(total_penalties) as cnt_penalties,";
			$SQL .= "  sum(hole_in_one) as cnt_hio,";
			$SQL .= "  sum(condor) as cnt_condor,";
			$SQL .= "  sum(albatros) as cnt_albatros,";
			$SQL .= "  sum(eagles) as cnt_eagles,";
			$SQL .= "  sum(birdies) as cnt_birdies,";
			$SQL .= "  sum(pars) as cnt_pars,";
			$SQL .= "  sum(bogeys) as cnt_bogeys,";
			$SQL .= "  sum(dbogeys) as cnt_dbogeys,";
			$SQL .= "  sum(tbogeys) as cnt_tbogeys,";
			$SQL .= "  sum(others) as cnt_others,";
			$SQL .= "  sum(par3_score) as par3_score,";
			$SQL .= "  sum(par4_score) as par4_score,";
			$SQL .= "  sum(par5_score) as par5_score";			
			$SQL .= " from t_games_result";
			$SQL .= "  where games_id in (";
			$SQL .= "      select games_id ";
			$SQL .= "      from t_games b ";
			$SQL .= "      where ";
			$SQL .= "        b.members_id ='$member_id'";
			if($games_type != "0") $SQL .= "        and b.games_type = $games_type";
			$SQL .= "        and b.games_date between '$date_first' and '$date_last'";
			$SQL .= "   )";
			$rst = $this->SimpleDB->query($SQL);
			if((is_object($rst)) && ($rst->next())){
				$cnt_round = $rst->get(0);
				$cnt_hole = $rst->get(1);
				$cnt_score = $rst->get(2);
				$avg_score = ($cnt_round > 0) ? number_format($cnt_score/$cnt_round, 2) : 0;
				$cnt_putts = $rst->get(3);
				$avg_putts = ($cnt_hole > 0) ? number_format($cnt_putts/$cnt_hole, 2) : 0;
				$cnt_saves = $rst->get(4);
				$cnt_fir = $rst->get(5);
				$cnt_par3 = $rst->get(6);
				$cnt_par4 = $rst->get(7);
				$cnt_par5 = $rst->get(8);
				$fir_ratio = (($cnt_par4 + cnt_par5) > 0) ? number_format((($cnt_fir/($cnt_par4+$cnt_par5)) * 100),2)."%" : 0;
				$cnt_gir = $rst->get(9);
				$gir_ratio = ($cnt_hole > 0) ? number_format((($cnt_gir/$cnt_hole) * 100),2)."%" : 0;
				$cnt_fairway = $rst->get(10);
				$cnt_rr = $rst->get(11);
				$cnt_lr = $rst->get(12);
				$cnt_bunkers = $rst->get(13);
				$cnt_penalties = $rst->get(14);
				$cnt_hio = $rst->get(15);
				$cnt_condor = $rst->get(16);
				$cnt_albatros = $rst->get(17);
				$cnt_eagles = $rst->get(18);
				$cnt_birdies = $rst->get(19);
				$cnt_pars = $rst->get(20);
				$cnt_bogeys = $rst->get(21);
				$cnt_dbogeys = $rst->get(22);
				$cnt_tbogeys = $rst->get(23);
				$cnt_others = $rst->get(24);
				$par3 = $rst->get(25);
				$par4 = $rst->get(26);
				$par5 = $rst->get(27);
				$avg_par3 = ($cnt_par3 > 0) ? number_format(($par3/$cnt_par3),2) : 0;
				$avg_par4 = ($cnt_par4 > 0) ? number_format(($par4/$cnt_par4),2) : 0;
				$avg_par5 = ($cnt_par5 > 0) ? number_format(($par5/$cnt_par5),2) : 0;
			}			
			// Save to Array
			
			$result['members']['id'] = $id;
			$result['members']['name'] = $nama;
			$result['members']['club'] = $club;
			$result['members']['age'] = $age;			
			$result['data']['round'] = (isset($cnt_round))? $cnt_round : 0;
			$result['data']['hole'] = (isset($cnt_hole))? $cnt_hole : 0;
			$result['data']['score'] = (isset($cnt_score))? $cnt_score : 0;
			$result['data']['avg_score'] = (isset($avg_score))? $avg_score : 0;
			$result['data']['putts'] = (isset($cnt_putts))? $cnt_putts : 0;
			$result['data']['avg_putts'] = (isset($avg_putts))? $avg_putts : 0;
			$result['data']['saves'] = (isset($cnt_saves))? $cnt_saves : 0;
			$result['data']['fir'] = (isset($cnt_fir))? $cnt_fir : 0;
			$result['data']['fir_ratio'] = (isset($fir_ratio))? $fir_ratio : 0;
			$result['data']['gir'] = (isset($cnt_gir))? $cnt_gir : 0;
			$result['data']['gir_ratio'] = (isset($gir_ratio))? $gir_ratio : 0;
			$result['data']['fairways'] = (isset($cnt_fairway))? $cnt_fairway : 0;
			$result['data']['rr'] = (isset($cnt_rr))? $cnt_rr : 0;
			$result['data']['lr'] = (isset($cnt_lr))? $cnt_lr : 0;
			$result['data']['bunkers'] = (isset($cnt_bunkers))? $cnt_bunkers : 0;
			$result['data']['penalties'] = (isset($cnt_penalties))? $cnt_penalties : 0;
			$result['data']['hole_in_one'] = (isset($cnt_hio))? $cnt_hio : 0;
			$result['data']['condor'] = (isset($cnt_condor))? $cnt_condor : 0;
			$result['data']['albatros'] = (isset($cnt_albatros))? $cnt_albatros : 0;
			$result['data']['eagles'] = (isset($cnt_eagles))? $cnt_eagles : 0;
			$result['data']['birdies'] = (isset($cnt_birdies))? $cnt_birdies : 0;
			$result['data']['pars'] = (isset($cnt_pars))? $cnt_pars : 0;
			$result['data']['bogeys'] = (isset($cnt_bogeys))? $cnt_bogeys : 0;
			$result['data']['dbogeys'] = (isset($cnt_dbogeys))? $cnt_dbogeys : 0;
			$result['data']['tbogeys'] = (isset($cnt_tbogeys))? $cnt_tbogeys : 0;
			$result['data']['others'] = (isset($cnt_others))? $cnt_others : 0;
			$result['data']['par3_avg_score'] = (isset($avg_par3))? $avg_par3 : 0;
			$result['data']['par4_avg_score'] = (isset($avg_par4))? $avg_par4 : 0;
			$result['data']['par5_avg_score'] = (isset($avg_par5))? $avg_par5 : 0;
			$result['data']['par3_hole'] = (isset($cnt_par3))? $cnt_par3 : 0;
			$result['data']['par4_hole'] = (isset($cnt_par4))? $cnt_par4 : 0;
			$result['data']['par5_hole'] = (isset($cnt_par5))? $cnt_par5 : 0;			
			$this->SimpleDB->disconnect();
		}
		return $result;
	}
}

class TopRanking{
	
	var $SimpleDB;
	
	function TopRanking(){
		$this->SimpleDB = new MySQLAccess();
		$this->SimpleDB->setHost(DB_HOST);
		$this->SimpleDB->setUser(DB_USER);
		$this->SimpleDB->setPassword(DB_PASS);
		$this->SimpleDB->setDBName(DB_NAME);		
	}
	
	function getTopPosition(){
		$this->SimpleDB->connect();
		
		$key = 0;		
		$arrList = array();

		$SQL = "select a.id, a.name, a.reward_earned, a.ranking_point, a.trial_point from tbl_membership a ";
		$SQL .= " order by a.reward_earned desc, a.id asc limit 0, 10";
		$rst = $this->SimpleDB->query($SQL);
		while((is_object($rst)) && ($rst->next())){
			$arrList[$key]['pos'] = $key + 1;
			$arrList[$key]['member_id'] = $rst->get(0);
			$arrList[$key]['member_name'] = $rst->get(1);
			$arrList[$key]['reward_earned'] = $rst->get(2);
			$arrList[$key]['ranking_point'] = $rst->get(3);
			$arrList[$key]['trial_point'] = $rst->get(4);
			$key++;
		}	
		$this->SimpleDB->disconnect();	
		return $arrList;	
	}	
}
?>
