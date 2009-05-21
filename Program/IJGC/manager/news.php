<?
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

require_once(PATH_CLASS."/news.php");

// new links class
$news = new news;
$news->konek();

// kategori berita
$listkategori = $news->Kategori(1);
//echo "<pre>";
//print_r($listkategori);
//echo "</pre>";

$fKat = "1=1";
if(isset($_GET['kategori'])){
	$kategori = @preg_replace("@[^0-9]@i","",$_GET['kategori']);
	$listkategori = $news->Kategori($kategori);
	if($listkategori != ""){
		foreach($listkategori as $key->value){
			$kate = $listkategori['description'];
			$fKat = "kategori = "."'".$listkategori['id']."'"; 
		}
	} else {
			$kate = "Golf News";
			$fKat = "kategori = 1"; 
	}
	$smarty->assign('kategori',$kategori);
}

// def var
$template = "news.tpl";
$smarty->assign('judul',$kate." Management");
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=news&kategori='.$kategori.'\'" />';
if($_SERVER['HTTP_REFERER']){
	$smarty->assign('referer',$_SERVER['HTTP_REFERER']);
}else{
	$smarty->assign('referer',$_SERVER['SCRIPT_NAME']."?aksi=news&kategori=$kategori");
}
$smarty->assign('path_editor',PATH_EDITOR);

// fetch data
$x = 0;
$news->sql = "select id, kategori, judul, date_format(tanggal,'%d %b %Y') as tanggal, status
		from tbl_news where $fKat order by id asc";
$news->perPage = REC_PER_PAGE;
$news->gul = 10;
$sql = $news->genSql();
$result = $news->exQ($sql);
while($data = mysql_fetch_array ($result,MYSQL_ASSOC)){
	foreach($data as $k=>$i){
		$listNews[$x][$k]=$i;
		if($k=="kategori"){
			//kategorinews
			$listkategori = $news->Kategori($kategori);
			$listNews[$x][$k] = $listkategori['id'];
		}
		if($k=="status"){
			if($i==1){
				$listNews[$x][$k]="Aktif";
			}else{
				$listNews[$x][$k]="nonAktif";
			}
		}
	}
	$x++;
}
$smarty->assign('paging',$news->pageMe());
$smarty->assign('listNews',$listNews);

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if($_POST['smbDelete'] && $aksi2==""){
	$aksi2 = "delete";
}
$smarty->assign('aksi2',$aksi2);
switch($aksi2){
	case "add":
		if($news->add_news()){
			$rec = mysql_fetch_array(mysql_query("select max(id) from tbl_news"),MYSQL_NUM);
			if($_FILES['gambar']['size']>0){
				$nfile = $rec[0];
				if(!$news->uploadFile(100000,$nfile)){
					$meta = $news->pesan;
					$smarty->assign('kembali',true);
					$smarty->assign('id',$nfile);
					$smarty->assign('aksi2',$aksi2);
				}else{
					$sql = "update tbl_news set gambar='$news->thumbName' where id=$rec[0]";
					$news->exQ($sql);
				}
			}
			$smarty->assign('pesan',"News added !<br>".$meta);
			$smarty->assign('dShowMe',true);
		}else{
			$i = eraseStrange($_POST['kategori']);
			$listkategori = $news->Kategori($i);
				if(!array($listkategori)){
					$smarty->assign("s",$listkategori['id']," selected");
				} else {
					$smarty->assign("s1"," selected");
				}
			$smarty->assign("jdl",eraseStrange($_POST['jdl']));
			if($_POST['tgl']){
				$smarty->assign("tgl",eraseStrange($_POST['tgl']));
			}else{
				$smarty->assign("tgl",date('m-d-Y'));
			}
			$smarty->assign("cuplikan",eraseStrange($_POST['cuplikan']));
			$smarty->assign("berita",str_replace(array("\r","\n","\e"),"",eraseStrange($_POST['berita'])));
			$status = preg_replace("@[^0-9]@i","",$_POST['status']);
			if($status==1){
				$smarty->assign("checked","checked");
			}else{
				$smarty->assign("checked","");
			}
			$smarty->assign('pesan',$news->pesan);
		}
		$template = "news_add_edit.tpl";
		break;
	case "edit":
		$id = @preg_replace("@[^0-9]@i","",$_GET['id']);
		if($news->edit_news($id)){
			if($_FILES['gambar']['size']>0){
				if(!$news->uploadFile(100000,$id)){
					$meta = $news->pesan;
					$smarty->assign('kembali',true);
					$smarty->assign('id',$id);
				}else{
					$sql = "update tbl_news set gambar='$news->thumbName' where id=$id";
					#echo $sql;
					$news->exQ($sql);
				}
			}
			$smarty->assign('pesan',"News edited !<br>".$meta);
			$smarty->assign('dShowMe',true);
		}else{
			$sql = "select kategori,judul, date_format(tanggal,'%m-%d-%Y') as tanggal, cuplikan,
					isi, status, gambar from tbl_news where id=$id";
			#echo $sql;
			if($r = $news->exQ($sql)){
				if(mysql_num_rows($r)>0){
					$data = mysql_fetch_array($r,MYSQL_ASSOC);
					$i = $data['kategori'];
					$listkategori = $news->Kategori($i);
						if(!array($listkategori)){
							$smarty->assign("s",$listkategori['id']," selected");
						} else {
							$smarty->assign("s1"," selected");
						}
					$smarty->assign("jdl",$data['judul']);
					$smarty->assign("tgl",$data['tanggal']);
					$smarty->assign("cuplikan",$data['cuplikan']);
					$smarty->assign("berita",str_replace(array("\r","\n","\e"),"",$data['isi']));
					$status = preg_replace("@[^0-9]@i","",$data['status']);
					if($status==1){
						$smarty->assign("checked","checked");
					}else{
						$smarty->assign("checked","");
					}
					if($data['gambar']){
						$smarty->assign('gbr',true);
						$smarty->assign('urlGbr','../images/news/thumbs/'.$data['gambar']);
					}
				}else{
					$smarty->assign('pesan',"Data tidak terdapat di dalam database !".$meta);
					$smarty->assign('dShowMe',true);
				}
			}
		}
		$template = "news_add_edit.tpl";
		break;
	case "delete":
		if($_POST['smbDelete']){
			#print_r($_POST);
			if(count($_POST['cPoll'])>0){
				foreach($_POST['cPoll'] as $k=>$i){
					$id = preg_replace("@[^0-9]@i","",$i);
					$sql = "select gambar from tbl_news where id='$id'";
					$r = $news->exQ($sql);
					$data = mysql_fetch_array($r,MYSQL_ASSOC);
					if(file_exists(WEB_PATH.PATH_THUMB_NEWS.'/'.$data['gambar'])){
						unlink(WEB_PATH.PATH_THUMB_NEWS.'/'.$data['gambar']);
					}
					mysql_query ("DELETE from tbl_news WHERE id='$id'");
					$pollrows = mysql_num_rows (mysql_query ("SELECT * from tbl_news"));
					if ($pollrows == 0) {
						mysql_query ("TRUNCATE tbl_news");
					}
				}
				$smarty->assign('pesan',"News/s deleted !".$meta);
				$smarty->assign('dShowMe',true);
			}else{
				$smarty->assign('pesan',"Choose News/s to delete !");
			}
		}
		break;
	default:
		$template = "news.tpl";
}

// assign links template
$content = $smarty->fetch($template);
$smarty->assign('content',$content);
?>