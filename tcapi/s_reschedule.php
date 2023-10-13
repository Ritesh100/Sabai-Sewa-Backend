<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['oid'] == ''   or $data['time']==''  or $data['date'] == '' or $data['uid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
    $oid = strip_tags(mysqli_real_escape_string($mysqli,$data['oid']));
   
    $time = strip_tags(mysqli_real_escape_string($mysqli,$data['time']));
     $date = strip_tags(mysqli_real_escape_string($mysqli,$data['date']));
	 
$uid =  strip_tags(mysqli_real_escape_string($mysqli,$data['uid']));
$checkimei = $mysqli->query("select * from tbl_user where  `id`=".$uid."")->num_rows;

if($checkimei == 0)
    {
		     $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Not Exist!!!!");  
	}

else 
{	
	   $table="tbl_order";
  $field = array('time'=>$time,'date'=>$date);
  $where = "where uid=".$uid." and id=".$oid."";
$h = new Common();
	  $check = $h->UpdateData_Api($field,$table,$where);
	  
            
        $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Reschedule successfully!");
        
    
	}
    
}

echo json_encode($returnArr);