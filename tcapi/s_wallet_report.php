<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '')
{
    
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
$uid =  strip_tags(mysqli_real_escape_string($mysqli,$data['uid']));
$checkimei = mysqli_num_rows(mysqli_query($mysqli,"select * from tbl_user where  `id`=".$uid.""));

if($checkimei != 0)
    {
		$wallet = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
		
       $sel = $mysqli->query("select message,status,amt from wallet_report where uid=".$uid."");
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
    $returnArr = array("Walletitem"=>$myarray,"credittotal"=>$l,"debittotal"=>$k,"wallet"=>$wallet['wallet'],"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Wallet Report Get Successfully!");
	}
    else
    {
      $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Request To Update Own Device!!!!");  
    }
    
}

echo json_encode($returnArr);