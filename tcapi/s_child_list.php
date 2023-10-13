<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
header('Content-type: text/json');
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
 
$uid = $data['uid'];
$cid = $data['cid'];
$sid = $data['sid'];
if($uid == '' or $cid == '' or $sid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$vps = array();
	$polists = array();
	$sel = $mysqli->query("select * from tbl_child where cid=".$cid." and sid=".$sid." and status=1");
	while($kol = $sel->fetch_assoc())
	{
		$counter = $mysqli->query("select * from tbl_partner_service where cid=".$kol['id']."")->num_rows;
		if($counter != 0)
		{
		$vps['childcat_id'] = $kol['id'];
		$vps['img'] = $kol['img'];
		$vps['title'] = $kol['title'];
		$vps['item_count'] = $mysqli->query("select * from tbl_partner_service where cid=".$kol['id']."")->num_rows;
		$polists[] = $vps;
		}
	}
	if(empty($polists))
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Child Category Not Found!");
	}
	else 
	{
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Child Category Data Get Successfully!","Childcatdata"=>$polists);
	}
}
echo json_encode($returnArr);