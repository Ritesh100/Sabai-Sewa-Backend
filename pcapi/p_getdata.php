<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['pid'] == '')
{
    
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
$pid =  strip_tags(mysqli_real_escape_string($mysqli,$data['pid']));
$checkimei = mysqli_num_rows(mysqli_query($mysqli,"select * from partner where  `id`=".$pid.""));

if($checkimei != 0)
    {
		$wallet = $mysqli->query("select * from partner where id=".$pid."")->fetch_assoc();
		
       $sel = $mysqli->query("select message,status,amt from tbl_credit_report where pid=".$pid."");
$myarray = array();
$l=0;
$k=0;

while($row = $sel->fetch_assoc())
{
	if($row['status'] == 'Credit')
	{
	$l = $l + $row['amt'];	
	}
	else 
	{
		$k = $k + $row['amt'];
	}
	$myarray[] = $row;
}
    $returnArr = array("CreditItem"=>$myarray,"partnercredittotal"=>$l,"partnerdebittotal"=>$k,"creditval"=>$wallet['credit'],"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Credit Report Get Successfully!");
	}
    else
    {
      $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Request To Update Own Device!!!!");  
    }
    
}

echo json_encode($returnArr);