<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $uid = strip_tags(mysqli_real_escape_string($mysqli,$data['uid']));
    
    
$check = $mysqli->query("select * from tbl_notification where uid=".$uid."");
$op = array();
while($row = $check->fetch_assoc())
{
		$op[] = $row;
}
if(empty($op))
{
	$returnArr = array("NotificationData"=>$op,"ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>"Notification List Not Found!!");
}
else 
{
$returnArr = array("NotificationData"=>$op,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Notification List Get Successfully!!");
}
}
echo json_encode($returnArr);