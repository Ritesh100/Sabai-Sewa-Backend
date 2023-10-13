<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
header('Content-type: text/json');
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
 
$uid = $data['uid'];
$cid = $data['cid'];
if($uid == '' or $cid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$vps = array();
	$polists = array();
	$sel = $mysqli->query("select * from g_subcategory where cid=".$cid." and status=1");
	while($kol = $sel->fetch_assoc())
	{
		$cdta = $mysqli->query("select * from category where id=".$kol['cid']."")->fetch_assoc();
		
		$vps['subcat_id'] = $kol['id'];
		$vps['img'] = $kol['img'];
		$vps['title'] = $kol['title'];
		$vps['subtitle'] = $cdta['cat_subtitle'];
		$vps['video'] = $kol['video'];
		$vps['child_count'] = $mysqli->query("select * from tbl_child where sid=".$kol['id']."")->num_rows;
		$polists[] = $vps;
	}
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Sub Category Data Get Successfully!","Subcatdata"=>$polists);
}
echo json_encode($returnArr);