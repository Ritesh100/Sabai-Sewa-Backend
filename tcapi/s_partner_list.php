<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
header('Content-type: text/json');
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
 

$cid = $data['cid'];
$uid = $data['uid'];
if($uid == '' or $cid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$plist = $mysqli->query("select * from partner where category_id=".$cid."");
	$polists = array();
	$pp = array();
	while($row = $plist->fetch_assoc())
	{
		$pp['id'] = $row['id'];
		$pp['name'] = $row['name'];
		$pp['email'] = $row['email'];
		$pp['mobile'] = $row['mobile'];
		$pp['password'] = $row['password'];
		$pp['ccode'] = $row['ccode'];
		$pp['status'] = $row['status'];
		$pp['rdate'] = $row['rdate'];
		$pp['credit'] = $row['credit'];
		$pp['city'] = $row['city'];
		$pp['address'] = $row['address'];
		$pp['category_id'] = $row['category_id'];
		$pp['aprove'] = $row['aprove'];
		if($row['bio'] == '')
		{
			$pp['bio'] = 'Bio not updated yet!!';
		}
		else 
		{
		$pp['bio'] = $row['bio'];
		}
		$pp['rate'] = $row['rate'];
		$pp['commission'] = $row['commission'];
		$pp['pimg'] = $row['pimg'];
		$cat = $mysqli->query("select cat_name from category where id =".$row['category_id']."")->fetch_assoc();
			if($cat['cat_name'] == '')
			{
				$pp['pimg'] = '';
			}
			else 
			{
				$pp['cat_name'] = $cat['cat_name'];
			}
			$pp['total_complete'] = $mysqli->query("select * from tbl_order where o_status='Completed'  and  rid=".$row['id']."")->num_rows;
			$sales  = $mysqli->query("select sum(o_total - (o_total * pcommission/100)) as full_total from tbl_order where o_status='Completed'  and  rid=".$row['id']."")->fetch_assoc();
             $payout =   $mysqli->query("select sum(amt) as full_payout from payout_setting where vid=".$row['id']."")->fetch_assoc();
                 $bs = 0;
				
				
				 if($sales['full_total'] == ''){ $earn = $bs;}else {$earn =  number_format((float)($sales['full_total']) - $payout['full_payout'], 2, '.', ''); }
				 $pp['total_earn'] = $earn;
		$polists[] = $pp;
	}
	if(empty($polists))
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Partner List Not Found!");
	}
	else 
	{
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Partner List Data Get Successfully!","PartnerListData"=>$polists);
	}
}
echo json_encode($returnArr);