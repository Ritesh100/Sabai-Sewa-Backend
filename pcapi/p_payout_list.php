<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['pid'] == '')
{
    
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$plist = $mysqli->query("select * from payout_setting where vid=".$data['pid']."");
	$status = array();
	$pdata = array();
	while($row = $plist->fetch_assoc())
	{
		$status['id'] = $row['id'];
		$status['request_id'] = $row['rid'];
		$status['amt'] = $row['amt'];
		if($row['status'] == 'pending')
		{
			$status['status'] = 'Under Review';
		}
		else 
		{
			$status['status'] = 'Completed';
		}
		
		$status['proof'] = empty($row['proof']) ? "" : $row['proof'];
		$status['p_by'] = empty($row['p_by']) ? "" : $row['p_by'];
		$status['r_date'] = date("F d, h:i A", strtotime($row['r_date']));
		$status['bname'] = empty($row['bname']) ? "" : $row['bname'];
		$status['ifsc'] =  empty($row['ifsc']) ? "" : $row['ifsc'];
		$status['rname'] =  empty($row['rname']) ? "" : $row['rname'];
		$status['acno'] =  empty($row['acno']) ? "" : $row['acno'];
		$status['paypalid'] =  empty($row['paypalid']) ? "" : $row['paypalid'];
		$status['upi'] =  empty($row['upi']) ? "" : $row['upi'];
		$pdata[] = $status;
	}
	$returnArr = array("PayoutListData"=>$pdata,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Payout List Get Successfully!!");
}

echo json_encode($returnArr);