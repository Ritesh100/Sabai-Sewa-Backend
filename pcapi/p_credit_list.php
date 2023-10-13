 <?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
header('Content-type: text/json');
$sel = $mysqli->query("select * from tbl_credit where status=1 order by id desc");
$myarray = array();
while($row = $sel->fetch_assoc())
{
			$myarray[] = $row;
}


$returnArr = array("CreditList"=>$myarray,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Credit Package  List Founded!");
echo json_encode($returnArr);
?>