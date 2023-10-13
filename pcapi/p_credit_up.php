<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
header('Content-type: text/json');
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
if($data['pid'] == '' or $data['credit'] == '')
{
    
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $wallet = strip_tags(mysqli_real_escape_string($mysqli,$data['credit']));
$pid =  strip_tags(mysqli_real_escape_string($mysqli,$data['pid']));
$checkimei = mysqli_num_rows(mysqli_query($mysqli,"select * from partner where  `id`=".$pid.""));

if($checkimei != 0)
    {
		
		$getcredits = $mysqli->query("select * from partner where id=".$pid."")->fetch_assoc();
		
		$table="partner";
  $field = array('credit'=>$getcredits['credit'] + $wallet);
  $where = "where id=".$pid."";
$h = new Common();
	  $h->UpdateData_Api($field,$table,$where);
	  
	  $table="tbl_credit_report";
  $field_values=array("pid","message","status","amt");
  $data_values=array("$pid",'Credit Added!!','Credit',"$wallet");
   
      $h = new Common();
	   $h->InsertData_Api_Id($field_values,$data_values,$table);
	   $getcredit = $mysqli->query("select * from partner where id=".$pid."")->fetch_assoc();
      
        $returnArr = array("Partner_credit"=>$getcredit['credit'],"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Credit Update successfully!");
        
    
	}
    else
    {
      $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"You Not Find In Our Account!!!!");  
    }
    
}

echo json_encode($returnArr);