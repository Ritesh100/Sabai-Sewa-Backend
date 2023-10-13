<?php
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);

$mobile = $data['mobile'];
$password = $data['password'];
if ($mobile =='' or $password =='')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
    
    $mobile = strip_tags(mysqli_real_escape_string($mysqli,$mobile));
    $password = strip_tags(mysqli_real_escape_string($mysqli,$password));
    
    $counter = $mysqli->query("select * from tbl_user where mobile='".$mobile."'");
    
   
    
    if($counter->num_rows != 0)
    {
  $table="partner";
  $field = array('password'=>$password);
  $where = "where mobile=".$mobile."";
$h = new Common();
	  $check = $h->UpdateData_Api($field,$table,$where);
	  
     $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Password Changed Successfully!!!!!");    
    }
    else
    {
     $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"mobile Not Matched!!!!");  
    }
}

echo json_encode($returnArr);
