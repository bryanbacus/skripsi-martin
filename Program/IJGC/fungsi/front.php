<?
if(file_exists(PATH_FUNGSI.'/koneksi.php')){
	require_once(PATH_FUNGSI.'/koneksi.php');
}else{
	die("File koneksi not Found !");
}

class front extends koneksi{
	
	var $arrKat = array(1=>"SetyoClub","National","International");
	
	function showLinks($jml,$judul,$preClass){
		$sql = "select * from tbl_links where status=1";
		$rJml=mysql_num_rows($this->exQ($sql));
		$sql = "select * from tbl_links where status=1 order by urut asc limit 0,$jml";
		if($r=$this->exQ($sql)){
			if(mysql_num_rows($r)>0){
				while($data = mysql_fetch_array($r,MYSQL_ASSOC)){
					$deskripsi = strip_tags($data['deskripsi']);
					$res .= '
							  <tr>
								<td width="9"></td>
								<td width="15" align="center"><img src="./images/dot.gif"></td>
								<td width="144" class="item"><a href="'.$data['url'].'" target="'.$data['target'].'" title="'.$deskripsi.'">'.$data['label'].'</a></td>
							  </tr>
							  <tr>
								<td colspan="3" height="3"></td>
							  </tr>	
							  <tr>
								<td></td>
								<td class="tdbg" colspan="2"></td>
							  </tr>
							  <tr>
								<td colspan="3" height="4"></td>
							  </tr>	
							';
				}
				if($rJml>$jml) $this->more = true; else $this->more = false;
				return $res;
			}else{
				return false;
			}
		}else{
			redirect(HOME."error.php?p=1");
		}
		return false;
	}
		
	function showNews($jenis){
		$sql = "select id, kategori, date_format(tanggal,'%W, %d %M %Y') as tanggal, judul, cuplikan, isi, status, gambar from news_content where kategori=$jenis and status='1' order by id desc limit 1";
		if($r = $this->exQ($sql)){
			if(mysql_num_rows($r)>0){
				$data = mysql_fetch_array($r,MYSQL_ASSOC);
				$url = "index.php?page=news&id=".$data['id']."&kategori=$jenis";
				if(trim($data['gambar'])){
					$gbr = PATH_THUMB_NEWS.'/'.$data['gambar'];
				}else{
					$gbr = PATH_THUMB_NEWS.'/noPict.jpg';
				}
				$res = '
							<table width="100%"  border="0" cellspacing="0" cellpadding="0">
							  <tr>
							  	<td width="3"></td>
								<td><IMG src="'.$gbr.'" border="1" width="75" height="75"></td>
								<td width="7"></td>
								<td valign="top" align="left" width="260">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr><td><div class="contenttitle">'.$data['judul'].'</div></td></tr>
										<tr><td><div class="ctgl"><i>'.$data['tanggal'].'</i></div></td></tr>
										<tr><td>'.substr($data['cuplikan'],0,180).'...</td></tr>
									</table>
								</td>
							  </tr>
							  <tr>
							  	<td width="3"></td>		
								<td colspan="3" height="5"></td>
							  </tr>
							  <tr>
							  	<td colspan="4" align="center">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td>'.$this->arrKat[$jenis].' News | <a href="'.$url.'">read more</a></td>
											<td width="195" height="11"><img src="./images/read_more.jpg" width="195" height="11" border="0"></td>								
									</table>
								</td>
							  </tr>
							  <tr>
							  	<td width="3"></td>
								<td colspan="3" height="5"></td>
							  </tr>
							</table>';			
			}else{
				$res = '	<br>
							<table width="100%"  border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td>Berita '.$this->arrKat[$jenis].' belum ada</td>
							  </tr>
							  <tr>
								<td align="right">'.$this->arrKat[$jenis].' News | <a href="'.$url.'">read more</a><img src="./images/read_more.jpg" width="190" height="11" border="0"></td>
							  </tr>
							</table>
						';
			}
			return $res;
		}else{
			redirect(HOME."error.php?p=1");
		}
	}
	
	function tips(){
		$sql = "select id, judul, concat(left(cuplikan,60),'...') as cuplikan from tips where status='1' order by id desc limit 1";
		if($r = $this->exQ($sql)){
			if(mysql_num_rows($r)>0){
				$arrTips = array();
				$data = mysql_fetch_array($r,MYSQL_ASSOC);
				foreach($data as $k=>$i){
					$arrTips[$k] = $i;
				}
				return $arrTips;
			}else{
				return false;
			}
		}else{
			redirect(HOME."error.php?p=1");
		}
	}

	function highlight(){
		$sql = "select id, judul, concat(left(cuplikan,60),'...') as cuplikan from highlight where status='1' order by id desc limit 1";
		if($r = $this->exQ($sql)){
			if(mysql_num_rows($r)>0){
				$arrTips = array();
				$data = mysql_fetch_array($r,MYSQL_ASSOC);
				foreach($data as $k=>$i){
					$arrHL[$k] = $i;
				}
				return $arrHL;
			}else{
				return false;
			}
		}else{
			redirect(HOME."error.php?p=1");
		}
	}
	
	function counter(){
		#echo "<input type=hidden value='".$_SESSION['lockUser']."'>";
		if(!$_SESSION['lockUser']){
			$sql = "select jumlah from counter";
			if($r = $this->exQ($sql)){
				if(mysql_num_rows($r)>0){
					$sql = "update counter set jumlah = jumlah + 1";
					$this->exQ($sql);
				}else{
					$sql = "insert into counter values('1')";
					$this->exQ($sql);
				}
			}else{
				redirect(HOME."error.php?p=1");
			}
			$_SESSION['lockUser']=true;
		}
	}
	
	function showCounter(){
		$sql = "select jumlah from counter";
		if($r = $this->exQ($sql)){
			if(mysql_num_rows($r)>0){
				$res = "";
				$data = mysql_fetch_array($r,MYSQL_NUM);
				$data = substr("000000".$data[0],-6);
				for($x=0;$x<strlen($data);$x++){
					$res .= "<img src='".PATH_IMAGES."/".$data[$x].".gif' border=0>";
				}
				return $res;
			}else{
				redirect(HOME."error.php?p=1");
			}
		}else{
			redirect(HOME."error.php?p=1");
		}
	}
	
	function chaptcha($jml){
		for($x=0;$x<$jml;$x++){
			$rnd = rand(0,9);
			$sesChaptcha .= $rnd;
			$chaptcha .= "<img src='".PATH_IMAGES."/$rnd.gif"."' height='18' align='absmiddle'>";
		}
		$_SESSION['chaptcha']=$sesChaptcha;
		return $chaptcha;
	}
	
}
?>