<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
header('Content-type: text/json');
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
if($data['oid'] == ''    or $data['uid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
    $oid = strip_tags(mysqli_real_escape_string($mysqli,$data['oid']));
   
    
	 
$uid =  strip_tags(mysqli_real_escape_string($mysqli,$data['uid']));
$checkimei = $mysqli->query("select * from tbl_user where  `id`=".$uid."")->num_rows;

if($checkimei == 0)
    {
		     $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Not Exist!!!!");  
	}

else 
{	
	   $table="tbl_order";
  $field = array('o_status'=>'Cancelled');
  $where = "where uid=".$uid." and id=".$oid."";
$h = new Common();
	  $check = $h->UpdateData_Api($field,$table,$where);
	  
            
        $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Cancelled successfully!");
        
    
	}
    
}

echo json_encode($returnArr);