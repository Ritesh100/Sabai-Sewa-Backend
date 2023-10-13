<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['rid'] == '' or $data['cid'] == '')
{
    
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
$rid =  strip_tags(mysqli_real_escape_string($mysqli,$data['rid']));
$cid =  strip_tags(mysqli_real_escape_string($mysqli,$data['cid']));
$checkimei = mysqli_num_rows(mysqli_query($mysqli,"select * from partner where  `id`=".$rid.""));

if($checkimei != 0)
    {
		
		
       $sel = $mysqli->query("select title,price,img from tbl_addon where cid=".$cid." and status=1");
$myarray = array();
while($row = $sel->fetch_assoc())
{
	$myarray[] = $row;
}
    $returnArr = array("Addondata"=>$myarray,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Add On Get Successfully!");
	}
    else
    {
      $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Request To Update Own Device!!!!");  
    }
    
}

echo json_encode($returnArr);