<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
header('Content-type: text/json');
$sel = $mysqli->query("select * from category where cat_status=1");
$myarray = array();
while($row = $sel->fetch_assoc())
{
			$myarray[] = $row;
}


$returnArr = array("Catlist"=>$myarray,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Category  List Founded!");
echo json_encode($returnArr);
?>