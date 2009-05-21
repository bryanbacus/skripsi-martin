<?
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

require_once(PATH_FUNGSI."/koneksi.php");

class users extends koneksi{
	function showUsers(){
		$listUsers = array();
		$this->sql="select usn,nama,email,date_format(last_login,'%d %M %Y %H:%i:%s') as last_login,if(level=1,'Administrator','Moderator') as level from tbl_admin order by usn asc $limit";
		$this->perPage = REC_PER_PAGE;
		$this->gul = 10;
		$sql = $this->genSql();
		$x = 0;
		$r = $this->exQ($sql);
		if($r){
			if(mysql_num_rows($r)>0){
				$pertama = false;
				while($data = mysql_fetch_array($r,MYSQL_ASSOC)){
					$listUsers[$x]['no'] = $x+1;
					foreach($data as $k=>$i){
						$listUsers[$x][$k] = $i;
					}
					$x++;
				}
			}else{
				return false;
			}
		}else{
			redirect(HOME."error.php?p=1");
		}
		return $listUsers;
	}
	
	function showData($usn){
		$sql="select usn,nama,email,date_format(last_login,'%d %M %Y %H:%i:%s') as last_login,level from tbl_admin where usn='$usn'";
		$r = $this->exQ($sql);
		if($r){
			if(mysql_num_rows($r)>0){
				if($data = mysql_fetch_array($r,MYSQL_ASSOC)){
					foreach($data as $k=>$i){
						$listUsers[$k] = $i;
					}
					$x++;
				}
			}else{
				return false;
			}
		}else{
			redirect(HOME."error.php?p=1");
		}
		return $listUsers;
	}

	function simpan($usn){
		$nama = custom_strips($_POST['nama'],"@[\\\'\"]@i");
		$email = custom_strips($_POST['email'],"@[\\\'\"]@i");
		$level = custom_strips($_POST['level'],"@[\\\'\"]@i");
		$sql = "update tbl_admin set nama='$nama',email='$email',level='$level' where usn='$usn'";
		if($this->exQ($sql)){
			return true;
		}else{
			return false;
		}
	}

	function ubahPass($usn){
		$pwd = md5(custom_strips($_POST['pwd'],"@[\\\'\"]@i"));
		$sql = "update tbl_admin set pwd='$pwd' where usn='$usn'";
		#echo $sql;
		if($this->exQ($sql)){
			return true;
		}else{
			return false;
		}
	}

	function tambah(){
		$usn = strtolower(custom_strips($_POST['username'],"@[\\\'\"]@i"));
		if(preg_match("@[^0-9a-z_]@i",$usn)){
			$this->pesan = "Username hanya terdiri dari angka, huruf dan underscore [ _ ] !";
			return false;
		}elseif($this->cekUser($usn)){
			$this->pesan = "Username sudah ada. Silakan pilih username lain !";
			return false;		
		}else{
			$pwd = md5(custom_strips($_POST['pwd'],"@[\\\'\"]@i"));
			$nama = custom_strips($_POST['nama'],"@[\\\'\"]@i");
			$email = custom_strips($_POST['email'],"@[\\\'\"]@i");
			$level = custom_strips($_POST['level'],"@[\\\'\"]@i");
			$sql = "insert into tbl_admin(usn,pwd,nama,email,level)
					values('$usn','$pwd','$nama','$email','$level')";
			#echo $sql;
			if($this->exQ($sql)){
				return true;
			}else{
				return false;
			}
		}
	}
	
	function cekUser($usn){
		$sql = "select * from tbl_admin where usn='$usn'";
		if($r=$this->exQ($sql)){
			if(mysql_num_rows($r)>0){
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
	}
	
	function delUsers(){
		#print_r($_POST);
		if(count($_POST['cUser'])>1){
			$gId = "";
			foreach($_POST['cUser'] as $k=>$i){
				if($i!="admin"){
					$id = preg_replace("@[^0-9a-z_]@i","",$i);
					$gId .= "'".$id."',";
				}
			}
			#echo strlen($gId)-1;
			$gId = substr($gId,0,strlen($gId)-1);
			$sql = "delete from tbl_admin where usn in($gId)";
		}else{
			$id = preg_replace("@[^0-9a-z_]@i","",$_POST['cUser'][0]);
			if($id!="admin"){
				$sql = "delete from tbl_admin where usn='$id'";
			}
		}
		#echo $sql;
		if($this->exQ($sql)){
			return true;
		}else{
			return false;
		}
	}

}
?>