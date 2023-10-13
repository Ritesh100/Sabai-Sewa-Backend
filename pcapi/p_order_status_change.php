<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
$getkey = $mysqli->query("select * from setting")->fetch_assoc();
define('ONE_KEY',$getkey['one_key']);
define('ONE_HASH',$getkey['one_hash']);
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
 header( 'Content-Type: text/html; charset=utf-8' ); 
$data = json_decode(file_get_contents('php://input'), true);

$oid = $data['oid'];
$status = $data['status'];
$rid = $data['pid'];

function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}

if ($oid =='' or $status =='' or $rid == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
    
    $oid = strip_tags(mysqli_real_escape_string($mysqli,$oid));
	$rid = strip_tags(mysqli_real_escape_string($mysqli,$rid));
    $status = strip_tags(mysqli_real_escape_string($mysqli,$status));
	
	$checks = $mysqli->query("select * from tbl_order where id=".$oid."")->fetch_assoc();
	
            $udata = $mysqli->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['name'];			
		
		$uid = $checks['uid'];
		
	$check = $mysqli->query("select *  from tbl_order where (rid=0 or rid=".$rid.") and id=".$oid."")->num_rows;
	if($check != 0)
	{
if($status == 'accept')
{
	
	
	$getdata = $mysqli->query("select * from partner where id=".$rid."")->fetch_assoc();
							$dcommission = $getdata['commission'];
							
	$table="tbl_order";
  $field = array('o_status'=>'Processing','rid'=>$rid,'pcommission'=>$dcommission);
  $where = "where id=".$oid."";
$h = new Common();
	  $h->UpdateData_Api($field,$table,$where);
	  
	  $amt = $checks['r_credit'];
	  $getcredits = $mysqli->query("select * from partner where id=".$rid."")->fetch_assoc();
	  
	  $table="partner";
  $field = array('credit'=>$getcredits['credit'] - $amt);
  $where = "where id=".$rid."";
$h = new Common();
	  $h->UpdateData_Api($field,$table,$where);
	  
	  
	  
	  
	  
	$table="tbl_credit_report";
  $field_values=array("pid","message","status","amt");
  $data_values=array("$rid",'Credit Used!!','Debit',"$amt");
   
      $h = new Common();
	   $h->InsertData_Api_Id($field_values,$data_values,$table);
	  
		

$timestamp = date("Y-m-d H:i:s");

$title_main = "Service Processed!!";
$description = $name.', Your Service #'.$oid.' Has Been Processed.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
      $h = new Common();
	   $h->Insertdata($field_values,$data_values,$table);
	   
	   

$content = array(
       "en" => $name.', Your Service #'.$oid.' Has Been Processed.'
   );
$heading = array(
   "en" => "Service Processed!!"
);

$fields = array(
'app_id' => ONE_KEY,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/order_process_img/confirmed.png'
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.ONE_HASH));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);

$getcredit = $mysqli->query("select * from partner where id=".$rid."")->fetch_assoc();



	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Accepted Successfully!!!!!","Partner_credit"=>$getcredit['credit']);    
	
}
else if($status == 'cancle')
{
	
	
	
	$table="tbl_order";
  $field = array('o_status'=>'Cancelled');
  $where = "where id=".$oid."";
$h = new Common();
	  $h->UpdateData_Api($field,$table,$where);
	   
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Cancelled Successfully!!!!!");
}
else if($status == 'reject')
{
	
	
	
	$table="tbl_order";
  $field = array('o_status'=>'Cancelled');
  $where = "where id=".$oid."";
$h = new Common();
	  $h->UpdateData_Api($field,$table,$where);
	   
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Reject Successfully!!!!!");
}
else if($status == 'add_on')
{
$desc = strip_tags(mysqli_real_escape_string($mysqli,$data['desc']));
$price = strip_tags(mysqli_real_escape_string($mysqli,$data['price']));	
$table="tbl_order";	
$field = array('add_desc'=>$desc,'add_price'=>$price);
$where = "where id=".$oid."";
$h = new Common();
	  $h->UpdateData_Api($field,$table,$where);
	  
	  $timestamp = date("Y-m-d H:i:s");

$title_main = "Service Completed!!";
$description = $name.', Your Service #'.$oid.' Has Been Completed.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
      $h = new Common();
	   $h->Insertdata($field_values,$data_values,$table);
	   
	   
	   
	 $content = array(
       "en" => $name.', Your Service #'.$oid.' Required Payment.'
   );
$heading = array(
   "en" => "Required Payment!!"
);

$fields = array(
'app_id' => ONE_KEY,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading
);

$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.ONE_HASH));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch); 
$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Amount Information Delivered Successfully!!!!!");
}
else if($status == 'complete')
{
$table="tbl_order";
  $field = array('o_status'=>'Completed');
  $where = "where id=".$oid."";
$h = new Common();
	  $h->UpdateData_Api($field,$table,$where);
	  
	 $checkcomplete = $mysqli->query("select * from tbl_order where uid=".$uid." and o_status='Completed'")->num_rows;
	if($checkcomplete == 1)
	{
	$wallet = $mysqli->query("select * from setting")->fetch_assoc();
		$fin = $wallet['refercredit'];
	$uinfo = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
	$refercode = $uinfo['refercode'];
	if($refercode != '')
	{
		$getm = $mysqli->query("select * from tbl_user where code=".$refercode."")->fetch_assoc();
		$fuid = $getm['id'];
		$mysqli->query("insert into wallet_report(`uid`,`message`,`status`,`amt`)values(".$fuid.",'Refer User Credit Added!!','Credit',".$fin.")");
		$mysqli->query("update tbl_user set wallet= wallet+".$fin." where code=".$refercode."");
	}
	}
	
	  
	    $timestamp = date("Y-m-d H:i:s");

$title_main = "Service Completed!!";
$description = $name.', Your Service #'.$oid.' Has Been Completed.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
      $h = new Common();
	   $h->Insertdata($field_values,$data_values,$table);
	   
	   
	   
	 $content = array(
       "en" => $name.', Your Service #'.$oid.' Has Been Completed.'
   );
$heading = array(
   "en" => "Service Completed!!"
);

$fields = array(
'app_id' => ONE_KEY,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/order_process_img/complete.png'
);

$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.ONE_HASH));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch); 
	
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Delivered Successfully!!!!!");    
}
else 
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Sorry This Order Assign to Other Partner Or Cancelled!");
	}
}
echo json_encode($returnArr);
mysqli_close($mysqli);
?>