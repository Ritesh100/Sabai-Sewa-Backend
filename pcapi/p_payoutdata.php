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
	
    
$sales  = $mysqli->query("select sum(o_total - (o_total * pcommission/100)) as full_total from tbl_order where o_status='Completed'  and  rid=".$data['pid']."")->fetch_assoc();
             $payout =   $mysqli->query("select sum(amt) as full_payout from payout_setting where vid=".$data['pid']."")->fetch_assoc();
                 $bs = 0;
				
				
				 if($sales['full_total'] == ''){ $earn = $bs;}else {$earn =  number_format((float)($sales['full_total']) - $payout['full_payout'], 2, '.', ''); } 
    $main_data = $mysqli->query("select mlimit from setting")->fetch_assoc();
	$limit = $main_data['mlimit'];
	$returnArr = array("payoutlimit"=>$limit,"walletbalance"=>$earn,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Payout Information Get successfully!");
}

echo json_encode($returnArr);