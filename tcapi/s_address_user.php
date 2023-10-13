<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
$data = json_decode(file_get_contents('php://input'), true);
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if($data['uid'] == '' or $data['address'] == '' or $data['pincode'] == '' or $data['houseno']==''  or $data['landmark'] == '' or $data['type'] == '' or $data['lat_map'] == '' or $data['long_map'] == '' or $data['aid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$uid = $data['uid'];
	$address = $data['address'];
	$pincode = $data['pincode'];
	$city = $data['city'];
	$houseno = $data['houseno'];
	$landmark = $data['landmark'];
	$type = $data['type'];
	$lat_map = $data['lat_map'];
	$long_map = $data['long_map'];
	$aid = $data['aid'];
	
	$count = $mysqli->query("select * from tbl_user where id=".$uid." and status = 1")->num_rows;
	if($count != 0)
	{
	if($aid == 0)
	{
		$pincheck = $mysqli->query("select * from tbl_city where cname='".$city."'")->num_rows;	
	if($pincheck != 0)
	{
		$counter_address = $mysqli->query("select * from tbl_address where type='".$type."' and uid=".$uid."")->num_rows;
		if($counter_address  != 0)
		{
		$adatas = $mysqli->query("select * from tbl_address where type='".$type."' and uid=".$uid."")->fetch_assoc();
$table="tbl_address";
  $field = array('address'=>$address,'pincode'=>$pincode,'houseno'=>$houseno,'landmark'=>$landmark,'type'=>$type,'lat_map'=>$lat_map,'long_map'=>$long_map);
  $where = "where id=".$adatas['id']."";
$h = new Common();
	  $check = $h->UpdateData_Api($field,$table,$where);
	  
		}
		else 
		{
	$table="tbl_address";
  $field_values=array("uid","address","pincode","houseno","landmark","type","lat_map","long_map");
  $data_values=array("$uid","$address","$pincode","$houseno","$landmark","$type","$lat_map","$long_map");
  $h = new Common();
  $check = $h->InsertData_Api($field_values,$data_values,$table);
		}
  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Address Saved Successfully!!!");
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Not Deliver On This Location!!");
	}
	
	}
	else 
	{
		$table="tbl_address";
  $field = array('address'=>$address,'pincode'=>$pincode,'houseno'=>$houseno,'landmark'=>$landmark,'type'=>$type,'lat_map'=>$lat_map,'long_map'=>$long_map);
  $where = "where id=".$aid."";
$h = new Common();
	  $check = $h->UpdateData_Api($field,$table,$where);
	  
		$adata = $mysqli->query("select * from tbl_address where id=".$aid."")->fetch_assoc();
		$p = array();
		$p['id'] = $adata['id'];
		$p['uid'] = $adata['uid'];
		$p['hno'] = $adata['houseno'];
		$p['address'] = $adata['address'];
		$p['lat_map'] = $adata['lat_map'];
		$p['long_map'] = $adata['long_map'];
		$p['pincode'] = $adata['pincode'];
		$p['landmark'] = $adata['landmark'];
		$p['type'] = $adata['type'];
		
		$returnArr = array("AddressData"=>$p,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Address Updated Successfully!!!");
	}
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Either Not Exit OR Deactivated From Admin!");
	}
}
echo json_encode($returnArr);