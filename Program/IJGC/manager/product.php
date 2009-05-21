<?
if(!defined("NODIRECT")){
	die("No direct Access !!");
}

require_once(PATH_CLASS."/product.php");
// new products class
$product = new product;
$product->konek();

// kategori product /default1
$listkategori = $product->Kategori(1);

$fKat = "1=1";
// def var
$template = "product.tpl";
$smarty->assign('judul',$kate."Product Management");
$smarty->assign('refresh',$_SERVER['REQUEST_URI']);
$meta = '<meta http-equiv="refresh" content="3;url=\''.$_SERVER['SCRIPT_NAME'].'?aksi=product" />';
if($_SERVER['HTTP_REFERER']){
	$smarty->assign('referer',$_SERVER['HTTP_REFERER']);
}else{
	$smarty->assign('referer',$_SERVER['SCRIPT_NAME']."?aksi=product");
}
$smarty->assign('path_editor',PATH_EDITOR);

// fetch data
$x = 0;
$product->sql = "select id,substr(information,1,100) as isi,gambar,link,type, if(status=1,'aktif', 'non aktif') as status from tbl_products order by id Desc";
$product->perPage = REC_PER_PAGE;
$product->gul = 10;
$sql = $product->genSql();
$result = $product->exQ($sql);
while($data = mysql_fetch_array ($result,MYSQL_ASSOC)){
	foreach($data as $k=>$i){
		$listProducts[$x][$k]=$i;
		if($k=="gambar"){
			if($i == ""){
				$listProducts[$x][$k] = IMAGE_PRODUCT."/noPict.jpg";
			} else {
				$listProducts[$x][$k] = IMAGE_PRODUCT."/".$i;
			}
		} 
		if($k=="type"){
			//kategoriPrduct
			$listkategori = $product->Kategori($i);
			$listProducts[$x][$k] = $listkategori['description'];
		}
	}
	$x++;
}

$smarty->assign('paging',$product->pageMe());
$smarty->assign('listProducts',$listProducts);

// pilih aksi2
$aksi2 = @preg_replace("@[^0-9a-z]@i","",$_GET['aksi2']);
if($_POST['smbDelete'] && $aksi2==""){
	$aksi2 = "delete";
}
$smarty->assign('aksi2',$aksi2);
switch($aksi2){
	case "add":
		if($product->add_news()){
			$rec = mysql_fetch_array(mysql_query("select max(id) from tbl_products"),MYSQL_NUM);
			if($_FILES['gambar']['size']>0){
				$nfile = $rec[0];
				if(!$partner->uploadFile(100000,$nfile)){
					$meta = $product->pesan;
					$smarty->assign('kembali',true);
					$smarty->assign('id',$nfile);
					$smarty->assign('aksi2',$aksi2);
				}else{
					$sql = "update tbl_products set gambar='$partner->thumbName' where id=$rec[0]";
					$tips->exQ($sql);
				}
			}
			$smarty->assign('pesan',"Products added !<br>".$meta);
			$smarty->assign('dShowMe',true);
		}else{
			$kategori = eraseStrange($_POST['kategori']);
			$draw = $product->drawKategori('$kategori');
			$smarty->assign("drawK",$draw);
			$smarty->assign("link",eraseStrange($_POST['link']));
			$smarty->assign("content",str_replace(array("\r","\n","\e"),"",eraseStrange($_POST['content'])));
			$status = preg_replace("@[^0-9]@i","",$_POST['status']);
			if($status==1){
				$smarty->assign("checked","checked");
			}else{
				$smarty->assign("checked","");
			}
			$smarty->assign('pesan',$product->pesan);
		}
		$draw = $product->drawKategori("");
		$smarty->assign("drawK",$draw);
		$template = "product_add_edit.tpl";
		break;
	case "edit":
		$id = @preg_replace("@[^0-9]@i","",$_GET['id']);
		if($product->edit_news($id)){
			if($_FILES['gambar']['size']>0){
				if(!$product->uploadFile(100000,$id)){
					$meta = $product->pesan;
					$smarty->assign('kembali',true);
					$smarty->assign('id',$id);
				}else{
					$sql = "update tbl_products set gambar='$product->thumbName' where id=$id";
					#echo $sql;
					$product->exQ($sql);
				}
			}
			$smarty->assign('pesan',"Products edited !<br>".$meta);
			$smarty->assign('dShowMe',true);
		}else{
			$sql = "select information,gambar,link,type,status from tbl_products where id=$id";
			#echo $sql;
			if($r = $product->exQ($sql)){
				if(mysql_num_rows($r)>0){
					$data = mysql_fetch_array($r,MYSQL_ASSOC);
					$draw = $product->drawKategori($data['type']);
					$smarty->assign("drawK",$draw);
					$smarty->assign("link",$data['link']);
					$smarty->assign("content",str_replace(array("\r","\n","\e"),"",$data['information']));
					$status = preg_replace("@[^0-9]@i","",$data['status']);
					if($status==1){
						$smarty->assign("checked","checked");
					}else{
						$smarty->assign("checked","");
					}
					if($data['gambar']){
						$smarty->assign('gbr',true);
						$smarty->assign('urlGbr',IMAGE_PRODUCT."/".$data['gambar']);
					}
				}else{
					$smarty->assign('pesan',"Data tidak terdapat di dalam database !".$meta);
					$smarty->assign('dShowMe',true);
				}
			}
		}
		$template = "product_add_edit.tpl";
		break;
	case "delete":
		if($_POST['smbDelete']){
			#print_r($_POST);
			if(count($_POST['cPoll'])>0){
				foreach($_POST['cPoll'] as $k=>$i){
					$id = preg_replace("@[^0-9]@i","",$i);
					$sql = "select gambar from tbl_products where id='$id'";
					$r = $product->exQ($sql);
					$data = mysql_fetch_array($r,MYSQL_ASSOC);
					if(file_exists(WEB_PATH.PATH_IMAGES.'/product/'.$data['gambar'])){
						unlink(WEB_PATH.PATH_IMAGES.'/product/'.$data['gambar']);
					}
					mysql_query ("DELETE from tbl_products WHERE id='$id'");
					$pollrows = mysql_num_rows (mysql_query ("SELECT * from tbl_products"));
					if ($pollrows == 0) {
						mysql_query ("TRUNCATE tbl_products");
					}
				}
				$smarty->assign('pesan',"Product/s deleted !".$meta);
				$smarty->assign('dShowMe',true);
			}else{
				$smarty->assign('pesan',"Choose Products/s to delete !");
			}
		}
		break;
	default:
		$template = "product.tpl";
}

// assign links template
$content = $smarty->fetch($template);
$smarty->assign('content',$content);
?>