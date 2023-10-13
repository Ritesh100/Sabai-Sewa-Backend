<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
header('Content-type: text/json');
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
 
$uid = $data['uid'];

if($uid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$v = array();
	$cp = array(); 
	$d = array();
	$pop = array();
	$sec = array();
	
	
	
$banner = $mysqli->query("select * from banner where status=1");
$poli = array();
while($row = $banner->fetch_assoc())
{
	$poli['id'] = $row['id'];
	$poli['img'] = $row['img'];
	$poli['status'] = $row['status'];
	if($row['sid'] == 0)
	{
		$poli['cat_id'] = $row['mid'];
		$poli['subcat_id'] = 0;
		$poli['child_id'] = $row['cid'];
		$ss = $mysqli->query("select * from category where id=".$row['mid']."")->fetch_assoc();
	$poli['cat_subtitle'] = $ss['cat_subtitle'];
	$poli['cat_name'] = $ss['cat_name'];
	$poli['cat_video'] = $ss['cat_video'];
	}
	else 
	{
		$poli['cat_id'] = $row['mid'];
		$poli['subcat_id'] = $row['sid'];
		$poli['child_id'] = $row['cid'];
		$ss = $mysqli->query("select * from category where id=".$row['mid']."")->fetch_assoc();
		$ssp = $mysqli->query("select * from g_subcategory where id=".$row['sid']."")->fetch_assoc();
	$poli['cat_subtitle'] = $ss['cat_subtitle'];
	$poli['cat_name'] = $ssp['title'];
	$poli['cat_video'] = $ssp['video'];
	}
    $v[] = $poli;
}

$banner = $mysqli->query("select * from category where cat_status=1");
$cat = array();
while($row = $banner->fetch_assoc())
{
	$cp['cat_id'] = $row['id'];
	$cp['cat_subtitle'] = $row['cat_subtitle'];
	$cp['cat_name'] = $row['cat_name'];
	$cp['cat_img'] = $row['cat_img'];
	$cp['cat_video'] = $row['cat_video'];
	$cp['Total_subcat'] = $mysqli->query("select * from g_subcategory where cid=".$row['id']."")->num_rows;
    $cat[] = $cp;
}

$banner = $mysqli->query("select * from tbl_home where status=1");
$section = array();
while($row = $banner->fetch_assoc())
{
	$section['sec_id'] = $row['id'];
	$section['sec_title'] = $row['title'];
	$section['sec_subtitle'] = $row['subtitle'];
	$vp = array();
	$polist = array();
	$sel = $mysqli->query("select * from tbl_home_service where sid=".$row['id']." and status=1");
	while($kol = $sel->fetch_assoc())
	{
		$vp['cat_id'] = $kol['cid'];
		$cdta = $mysqli->query("select * from category where id=".$kol['cid']."")->fetch_assoc();
		$vp['img'] = $kol['img'];
		$vp['title'] = $kol['title'];
		$vp['subtitle'] = $kol['subtitle'];
		
		$vp['cat_title'] = $cdta['cat_name'];
		$vp['cat_subtitle'] = $cdta['cat_subtitle'];
		$vp['video'] = $cdta['cat_video'];
		$polist[] = $vp;
	}
	$section['service_data'] = $polist;
	$pop[] = $section;
}

$su = $mysqli->query("select * from category where cat_status=1");
$subcat = array();
$suy = array();
while($row = $su->fetch_assoc())
{
	$count = $mysqli->query("select * from g_subcategory where cid=".$row['id']."")->num_rows;
	if($count != 0)
	{
	
	$suy['cat_subtitle'] = $row['cat_subtitle'];
	$suy['cat_name'] = $row['cat_name'];
	$sel = $mysqli->query("select * from g_subcategory where cid=".$row['id']." and status=1");
	$vps = array();
	$polists = array();
	while($kol = $sel->fetch_assoc())
	{
		$vps['cat_id'] = $kol['cid'];
		$vps['subcat_id'] = $kol['id'];
		$vps['img'] = $kol['img'];
		$vps['title'] = $kol['title'];
		$vps['subtitle'] = $row['cat_subtitle'];
		$vps['video'] = $kol['video'];
		$polists[] = $vps;
	}
	$suy['subcat_data'] = $polists;
	$subcat[] = $suy;
	}
}


$testi = $mysqli->query("select * from tbl_happy_user  order by rand() limit 6");
while($rowk = $testi->fetch_assoc())
{
    $sec[] = $rowk;
}

$main_data = $mysqli->query("select * from setting")->fetch_assoc();
$wallet = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();  
$kp = array('Banner'=>$v,'Catlist'=>$cat,"Dynmaic_section"=>$pop,"Main_Data"=>$main_data,"testimonial"=>$sec,"Subcat_section"=>$subcat,"wallet"=>$wallet['wallet']);
	
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Home Data Get Successfully!","ResultData"=>$kp);
}
echo json_encode($returnArr);