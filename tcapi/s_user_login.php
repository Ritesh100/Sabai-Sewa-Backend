<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['mobile'] == ''  or $data['password'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $mobile = strip_tags(mysqli_real_escape_string($mysqli,$data['mobile']));
    $password = strip_tags(mysqli_real_escape_string($mysqli,$data['password']));
    
$chek = $mysqli->query("select * from tbl_user where (mobile='".$mobile."' or email='".$mobile."') and status = 1 and password='".$password."'");
$status = $mysqli->query("select * from tbl_user where status = 1");
if($status->num_rows !=0)
{
if($chek->num_rows != 0)
{
    $c = $mysqli->query("select * from tbl_user where (mobile='".$mobile."' or email='".$mobile."')  and status = 1 and password='".$password."'");
    $c = $c->fetch_assoc();
	$check = $mysqli->query("select * from tbl_address where uid=".$c['id']."")->num_rows;
	if($check != 0)
	{
		$status_check = TRUE;
	}
	else 
	{
		$status_check = FALSE;
		
		}
    $returnArr = array("UserLogin"=>$c,"AddressExist"=>$status_check,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Login successfully!");
}
else
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Invalid Email/Mobile No or Password!!!");
}
}
else  
{
	 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Your Status Deactivate!!!");
}
}

echo json_encode($returnArr);