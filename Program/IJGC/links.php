<?
//definisi variabel
$smarty->assign("tampil",true);
$smarty->assign("icon","./images/links.gif");

// fetch data
$x = 0;
$kDef->sql = "select id,gambar,link,substr(content,1,200) as isi from tbl_links where status=1 order by id Desc";
$kDef->perPage = REC_PER_PAGE;
$kDef->gul = 10;
$smarty->assign('paging',$kDef->pageMe());
$sql = $kDef->genSql();

//echo $sql;
$result = $kDef->exQ($sql);
if(@mysql_num_rows($result)>0){
	while($data = mysql_fetch_array ($result,MYSQL_ASSOC)){
		$listLinks[$x]['id'] = $data['id'];
		$listLinks[$x]['link'] = $data['link'];
			if($data['gambar'] != ""){
					$listLinks[$x]['image'] = IMAGE_LINK."/".$data['gambar'];
				}else {
					$listLinks[$x]['image'] = IMAGE_LINK."/noPict.jpg";
			}
		$listLinks[$x]['isi'] = $data['isi'];
		$x++;
		} 
	}else {
		$smarty->assign("pesan","Belum ada data");
	}
$smarty->assign('listLinks',$listLinks);
?>