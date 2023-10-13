<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}

if($data['uid'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
$uid =  $data['uid'];
$cid = $data['cid'];
$p_method_id = $data['p_method_id'];
$full_address = $data['full_address'];
$timestamp = date("Y-m-d");
$lats = $data['lat'];
$longs = $data['longs'];
if(!empty($data['add_on']))
{	
$pol = array();
$add = $data['add_on'];
for($p=0;$p<count($data['add_on']);$p++)
{
	$pol[] = mysqli_real_escape_string($mysqli,$add[$p]);
}

$add_on = implode(',',$pol);
}
else 
{
	$add_on = 0;
}
$time = $data['time'];
$date = $data['date'];
$add_per_price = implode(',',$data['add_per_price']);
if(empty($data['add_per_price']))
{
	$add_total = 0;
}
else 
{
$add_total = number_format((float)array_sum($data['add_per_price']), 2, '.', '');
}
$wal_amt = $data['wal_amt'];
$pid = $data['pid'];
if($pid == 0)
{
	$htype = 'Random';
}
else 
{
	$htype = 'Direct';
}

$transaction_id = $data['transaction_id'];
$product_total = number_format((float)$data['product_total'], 2, '.', '');
$subtotal = $data['product_total'] - $add_total;
$product_subtotal = number_format((float)$subtotal, 2, '.', '');
if($subtotal < 0)
{
	$product_subtotal = 0; 
}
$table="tbl_order";
  $field_values=array("uid","odate","p_method_id","address","o_total","subtotal","trans_id","cid","add_on","add_total","add_per_price","time","date","longs","lats","wal_amt","rid","htype");
  $data_values=array("$uid","$timestamp","$p_method_id","$full_address","$product_total","$product_subtotal","$transaction_id","$cid","$add_on","$add_total","$add_per_price","$time","$date","$longs","$lats","$wal_amt","$pid","$htype");
  
      $h = new Common();
	  $oid = $h->InsertData_Api_Id($field_values,$data_values,$table);
	/*  $udata = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
	  $idp = $set['asid'];
$token = $set['token'];
$url = "https://api.twilio.com/2010-04-01/Accounts/$idp/SMS/Messages";
$from = $set['megic_Num'];
$to = $udata['ccode'].$udata['mobile']; // twilio trial verified number
$body = "New Order Id #".$oid." Received";
$datavp = array (
    'From' => $from,
    'To' => $to,
    'Body' => $body,
);
$post = http_build_query($datavp);
$x = curl_init($url );
curl_setopt($x, CURLOPT_POST, true);
curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($x, CURLOPT_USERPWD, "$idp:$token");
curl_setopt($x, CURLOPT_POSTFIELDS, $post);
$y = curl_exec($x);
curl_close($x); */

	  $ProductData = $data['ProductData'];
for($i=0;$i<count($ProductData);$i++)
{

$title = mysqli_real_escape_string($mysqli,$ProductData[$i]['title']);

$cost = $ProductData[$i]['cost'];
$qty = $ProductData[$i]['qty'];
$discount = $ProductData[$i]['discount'];


$table="tbl_order_product";
  $field_values=array("oid","pquantity","ptitle","pdiscount","pprice");
  $data_values=array("$oid","$qty","$title","$discount","$cost");
  
      $h = new Common();
	   $h->InsertData_Api($field_values,$data_values,$table);
	   
	   $mysqli->query("update tbl_user set wallet = wallet-".$wal_amt." where id=".$uid."");
	    
	  
	   if($wal_amt != 0)
	   {
	   $table="wallet_report";
  $field_values=array("uid","message","status","amt");
  $data_values=array("$uid",'Wallet Used!!','Debit',"$wal_amt");
   
      $h = new Common();
	   $h->InsertData_Api($field_values,$data_values,$table);
	   }
}
	$wallet = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();   
$returnArr = array("wallet"=>$wallet['wallet'],"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Placed Successfully!!!");
}

echo json_encode($returnArr);