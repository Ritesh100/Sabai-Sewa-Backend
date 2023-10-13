<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
$uid = $data['uid'];
if($uid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$count = $mysqli->query("select * from tbl_address where uid=".$uid."")->num_rows;
	if($count != 0)
	{
	$cy = $mysqli->query("select * from tbl_address where uid=".$uid."");
	$p = array();
	$q = array();
	while($adata = $cy->fetch_assoc())
	{
		$p['id'] = $adata['id'];
		$p['uid'] = $adata['uid'];
		$p['hno'] = $adata['houseno'];
		$p['address'] = $adata['address'];
		$p['lat_map'] = $adata['lat_map'];
		$p['long_map'] = $adata['long_map'];
		
		$p['pincode'] = $adata['pincode'];
		
		$p['landmark'] = $adata['landmark'];
		$p['type'] = $adata['type'];
		if($adata['type'] == 'Office')
		{
			$p['address_image'] = 'a_icon/ic_office_current_location.png';
		}
		else if($adata['type'] == 'Home')
		{
			$p['address_image'] = 'a_icon/ic_home_current_location.png';
		}
		else
		{
			$p['address_image'] = 'a_icon/ic_other_current_location.png';
		}
		$q[] = $p;
	}
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Address List Get Successfully!!!","AddressList"=>$q);
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Address List Not Found!!");
	}
}
echo json_encode($returnArr);
?>