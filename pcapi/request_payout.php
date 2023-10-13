<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['pid'] == '' or $data['amt'] == '')
{
    
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$bname = $data['bname'];
	$ifsc = $data['ifsc'];
	$rname = $data['rname'];
	$acno = $data['acno'];
	$upi = $data['upi'];
	$paypalid = $data['paypalid'];
	$amt = $data['amt'];
$timestamp = date("Y-m-d H:i:s");
	$rand = uniqid();
$store_id = $data['pid'];
 $table="payout_setting";
  $field_values=array("amt","status","vid","r_date","rid","bname","ifsc","rname","acno","upi","paypalid");
  $data_values=array("$amt",'pending',"$store_id","$timestamp","$rand","$bname","$ifsc","$rname","$acno","$upi","$paypalid");
  
  $sales  = $mysqli->query("select sum(o_total - (o_total * pcommission/100)) as full_total from tbl_order where o_status='Completed'  and  rid=".$data['pid']."")->fetch_assoc();
             $payout =   $mysqli->query("select sum(amt) as full_payout from payout_setting where vid=".$data['pid']."")->fetch_assoc();
                 $bs = 0;
				
				
				 if($sales['full_total'] == ''){ $earn = $bs;}else {$earn =  number_format((float)($sales['full_total']) - $payout['full_payout'], 2, '.', ''); } 
    $main_data = $mysqli->query("select mlimit from setting")->fetch_assoc();
	$limit = $main_data['mlimit'];
	
  if($limit > $amt)
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Minimum ".$limit.' '.$main_data['currency']." for withdraw amount.");
}
else if($earn < $amt)
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"You Do Not Have Requested Amount In Wallet.!!");
}
else 
{
$h = new Common();
	  $check = $h->InsertData_Api($field_values,$data_values,$table);
	  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Payout Submit Successfully!!");
}
}
echo json_encode($returnArr);