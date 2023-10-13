<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
header('Content-type: text/json');
$sel = $mysqli->query("select * from tbl_code");
$myarray = array();
while($row = $sel->fetch_assoc())
{
			$myarray[] = $row;
}

$sels = $mysqli->query("select * from tbl_city");
$myarrays = array();
while($rows = $sels->fetch_assoc())
{
			$myarrays[] = $rows;
}

$returnArr = array("CountryCode"=>$myarray,"CityList"=>$myarrays,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Country Code And City List Founded!");
echo json_encode($returnArr);
?>