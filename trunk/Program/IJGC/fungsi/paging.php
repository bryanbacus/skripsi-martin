<?
class paging{
	
	var $totPage = 0;
	var $page = 0;
	var $max = 0;
	var $perPage = 10;
	var $gul = 6;
	var $sql = "";
	var $sqlLim = "";
	var $varName = "p";
	var $url = "";
	var $strP = "";
	
	function numRec(){
		$this->url = $this->getUrl();
		$rec = $this->exQ($this->sql);
		if($rec){
			return mysql_num_rows($rec);
		}else{
			return false;
		}
	}
	
	function pageMe(){
		if($this->tipe==2){
			$this->strP = $this->pageB();
			return $this->strP;
		}else{
			$this->strP = $this->pageA();
			return $this->strP;
		}
	}
	
	function pageA(){
		if($this->numRec()){
			$this->page = $this->getPage();
			$jmlHal = $this->jmlHal();
			$jarak = ceil(($this->gul-2)/2);
			$strP = "<div id='paging'>";
			if($this->page==1){ # 1st page
				$strP .= "&lt;&lt;Prev [1] ";
			}else{
				$strP .= "<a href='".$this->url.$this->varName."=".($this->page-1)."'>&lt;&lt;Prev</a> <a href='".$this->url.$this->varName."=1'>[1]</a> ";
			}
			if($jmlHal>=$this->gul){
				$hal = $this->page;
				if($hal>=$this->gul){
					$min = $this->page-$jarak;
					$max = $this->page+$jarak;
					if($min<=2){
						$min = 2;
					}
					if($max>=$jmlHal){
						$max = $jmlHal-1;
					}
				}else{
					$min = 2;
					$max = $this->gul;
				}
				if($max==$jmlHal) $max = $jmlHal-1;
			}else{
				$min = 2;
				$max = $jmlHal-1;
			}
			#echo "<br>Min : ".$min;
			#echo "<br>Max : ".$max;
			#echo "<br>page : ".$this->page;
			#echo "<br>jmlHal : ".$jmlHal;
			#echo "<br>gul : ".$this->gul;
			#echo "<br>jarak : ".$jarak;
			if(($max-$min)<($this->gul-2)){
				if(($this->page+$jarak)>=$jmlHal){
					$min = $min - (($this->page+$jarak)-$jmlHal) - 1;
				}
				if($min<=1) $min = 2;
			}
			for($x=$min;$x<=$max;$x++){
				if($this->page==$x){
					$strP .= " [$x] ";
				}else{
					$strP .= " <a href='".$this->url.$this->varName."=$x'>[$x]</a> ";
				}
			}
			if($jmlHal>1){
				if($this->page==$jmlHal){ # last page
					$strP .= " [$jmlHal] Next&gt;&gt;";
				}else{
					$strP .= " <a href='".$this->url.$this->varName."=$jmlHal'>[$jmlHal]</a> <a href='".$this->url.$this->varName."=".($this->page+1)."'>Next&gt;&gt;</a> ";
				}
			}else{
				$strP .= " Next&gt;&gt;";
			}
			$strP .= "</div>";
			return $strP;
		}else{
			return "";
		}
	}

	function pageB(){
		if($this->numRec()){
			$this->page = $this->getPage();
			$jmlHal = $this->jmlHal();
			$strP = "<div id='paging'>";
			if($this->page==1){ # 1st page
				$strP .= "&lt;&lt;Prev ";
			}else{
				$strP .= "<a href='".$this->url.$this->varName."=".($this->page-1)."'>&lt;&lt;Prev</a> ";
			}
			$strP .= " &nbsp;$this->page of $jmlHal&nbsp; ";
			if($this->page==$jmlHal){ # last page
				$strP .= " Next&gt;&gt;";
			}else{
				$strP .= " <a href='".$this->url.$this->varName."=".($this->page+1)."'>Next&gt;&gt;</a>";
			}
			$strP .= "</div>";
			return $strP;
		}else{
			return "";
		}
	}
	
	function getPage(){
		$p = preg_replace("@[^0-9]@","",$_GET[$this->varName]);
		if($p){
			if($p>$this->jmlHal()){
				return $this->jmlHal();
			}elseif($p<1){
				return 1;
			}else{
				return $p;
			}
		}else{
			return 1;
		}
	}
	
	function jmlHal(){
		if($this->numRec()){
			$jmlHal = ceil($this->numRec()/$this->perPage);
			$this->totPage = $jmlHal;
			return $jmlHal;
		}else{
			return 0;
		}
	}
	
	function getUrl(){
		$url = $_SERVER['REQUEST_URI'];
		$regex = "@([\?\&])+(".$this->varName."=[0-9]*)(\&)?@i";
		$replace = "$1";
		$url = preg_replace($regex,$replace,$url);
		if(stristr($url,"?")){
			$url = $url."&";
		}else{
			$url = $url."?";
		}
		$url = str_replace("&&","&",$url);
		return $url;
	}
	
	function genSql(){
		$page = $this->getPage() - 1;
		$sql = $this->sql;
		$this->sqlLim = $sql." limit ".($page*$this->perPage).",".$this->perPage;
		return $this->sqlLim;
	}
	
}
?>