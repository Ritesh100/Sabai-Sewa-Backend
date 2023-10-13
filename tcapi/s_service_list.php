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
		$vps['childcat_id'] = $kol['id'];
		
		$vps['title'] = $kol['title'];
		$s = array();
		$service = array();
		$vpss = $mysqli->query("select * from tbl_partner_service where cid=".$kol['id']." and status=1");
		while($row = $vpss->fetch_assoc())
		{
			
			$s['service_id'] = $row['id'];
			$s['service_img'] = explode(',',$row['img']);
			$s['service_video'] = $row['video'];
			$s['service_title'] = $row['title'];
			$s['service_discount'] = $row['discount'];
			$s['service_ttken'] = $row['ttken'];
			$s['service_mqty'] = $row['mqty'];
			$s['service_price'] = $row['price'];
			$countimg = count(explode(',',$row['img']));
			if($countimg == 1 and $row['s_show'] == 0)
			{
				$s['service_s_show'] = "1";
			}
			else if($countimg >= 1 and $row['s_show'] == 0)
			{
				$s['service_s_show'] = "2";
			}
			else 
			{
			$s['service_s_show'] = "3";
			}
			$s['service_cat_id'] = $row['mid'];
			$s['service_subcat_id'] = $row['sid'];
			$s['service_childcat_id'] = $row['cid'];
			$s['service_sdesc'] = $row['sdesc'];
			$service[] = $s;
			
			
		}
		$vps['Service_list'] = $service; 
		$polists[] = $vps;
	}
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Service List Data Get Successfully!","Servicelistdata"=>$polists);
}
echo json_encode($returnArr);