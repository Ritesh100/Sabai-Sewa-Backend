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
    
$chek = $mysqli->query("select * from partner where (mobile='".$mobile."' or email='".$mobile."') and status = 1 and password='".$password."'");
$status = $mysqli->query("select * from partner where status = 1");
if($status->num_rows !=0)
{
if($chek->num_rows != 0)
{
    $c = $mysqli->query("select * from partner where (mobile='".$mobile."' or email='".$mobile."')  and status = 1 and password='".$password."'");
    $c = $c->fetch_assoc();
	$main_data = $mysqli->query("select currency from setting")->fetch_assoc();
	$cat = $mysqli->query("select cat_name from category where id =".$c['category_id']."")->fetch_assoc();
    $returnArr = array("PartnerLogin"=>$c,"currency"=>$main_data['currency'],"category"=>$cat['cat_name'],"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Login successfully!");
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