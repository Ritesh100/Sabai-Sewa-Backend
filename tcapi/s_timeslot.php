<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
$data = json_decode(file_get_contents('php://input'), true);
function current_date($dbs)
{
	$date = date('Y-m-d',strtotime('-1 day'));
$weekOfdays = array();
for($i =0; $i < $dbs; $i++){
    $date = date('Y-m-d', strtotime('+1 day', strtotime($date)));
    $weekOfdays[] = date('D d', strtotime($date));
}
return $weekOfdays;
}

function next_date($dbs)
{
	$date = date('Y-m-d');
$weekOfdays = array();
for($i =0; $i < $dbs; $i++){
    $date = date('Y-m-d', strtotime('+1 day', strtotime($date)));
    $weekOfdays[] = date('D d', strtotime($date));
}
return $weekOfdays;
}

if($data['cid'] == '' or $data['uid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$cid = $data['cid'];
	$sel = $mysqli->query("select * from time_date where cid=".$cid."");
	$c = array();$p=array();
	while($row = $sel->fetch_assoc())
	{
		if($row['dstatus'] == 1)
		{
			$c['status'] = 'current';
		$c['days'] = current_date($row['days']);	
		}
		else 
		{
			$c['status'] = 'next';
			$c['days'] = next_date($row['days']);;
		}
		$c['tslot'] = explode(',',$row['tslot']);
		$p[] = $c;
	}
	
	$adata = $mysqli->query("select * from tbl_address where uid=".$data['uid']."");
		$adlist = array();
		$popt = array();
		while($po = $adata->fetch_assoc())
		{
			$popt['id'] = $po['id'];
		$popt['uid'] = $po['uid'];
		$popt['hno'] = $po['houseno'];
		$popt['address'] = $po['address'];
		$popt['lat_map'] = $po['lat_map'];
		$popt['long_map'] = $po['long_map'];
		
		$popt['pincode'] = $po['pincode'];
		
		$popt['landmark'] = $po['landmark'];
		$popt['type'] = $po['type'];
		if($po['type'] == 'Office')
		{
			$popt['address_image'] = 'a_icon/ic_office_current_location.png';
		}
		else if($po['type'] == 'Home')
		{
			$popt['address_image'] = 'a_icon/ic_home_current_location.png';
		}
		else
		{
			$popt['address_image'] = 'a_icon/ic_other_current_location.png';
		}
			$adlist[] = $popt;
		}
		
	$returnArr = array("AddressData"=>$adlist,"TimeslotData"=>$p,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"TimeSloat And Date Get Successfully!!");
}
echo json_encode($returnArr);