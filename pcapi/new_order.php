<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
if($data['pid'] == '' or $data['status'] == '')
{ 
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
 $pid =  strip_tags(mysqli_real_escape_string($mysqli,$data['pid']));
 $cdata = $mysqli->query("select * from partner where id=".$pid."")->fetch_assoc();
 $cid = $cdata['category_id'];
$status = $data['status'];
if($status == 'new')
{
  $sel = $mysqli->query("select * from tbl_order where cid = ".$cid." and (rid=0 or rid=".$pid.") and  o_status='Pending'  and a_status=1 order by id desc");
}
else if($status == 'ongoing')
{
	$sel = $mysqli->query("select * from tbl_order where cid = ".$cid." and rid=".$pid." and o_status='Processing'  and a_status=1 order by id desc");
}
else
{
$sel = $mysqli->query("select * from tbl_order where cid = ".$cid." and rid=".$pid." and o_status='Completed' and a_status=1 order by id desc");	
}
  if($sel->num_rows != 0)
  {
  $result = array();
  $pp = array();
  while($row = $sel->fetch_assoc())
    {
		$pp['order_id'] = $row['id'];
		$pp['category_id'] = $row['cid'];
		$pp['order_date'] = $row['odate'];
		$pname = $mysqli->query("select * from tbl_payment_list where id=".$row['p_method_id']."")->fetch_assoc();
		
		$getudata = $mysqli->query("select name,mobile,email from tbl_user where id=".$row['uid']."")->fetch_assoc();
		$pp['p_method_name'] = $pname['title'];
		$pp['customer_address'] = $row['address'];
		$pp['customer_name'] = $getudata['name'];
		$pp['customer_mobile'] = $getudata['mobile'];
		$pp['customer_email'] = $getudata['email'];
		$pp['lats'] = $row['lats'];
		$pp['longs'] = $row['longs'];
		$pp['order_time'] = $row['time'];
		$pp['hire_type'] = $row['htype'];
		$pp['order_dateslot'] = $row['date'];
		$add_on = explode(',',$row['add_on']);
		$add_per_price = explode(',',$row['add_per_price']);
		$ar = array();
		$pos = array();
		for($pps =0;$pps<count($add_on);$pps++)
		{
			$ar['title'] = $add_on[$pps];
			$ar['price'] = $add_per_price[$pps];
			$pos[] = $ar;
		}
		$pp['add_on_data'] = $pos;
		$pp['add_total'] = $row['add_total'];
		$pp['r_credit'] = $row['r_credit'];
		$pp['Order_Total'] = $row['o_total'];
		$pp['wal_amt'] = $row['wal_amt'];
		
		
		$pp['Order_Transaction_id'] = $row['trans_id'];
		$pp['Order_Status'] = $row['o_status'];
		$fetchpro = $mysqli->query("select *  from tbl_order_product where oid=".$row['id']."");
		$kop = array();
		$pdata = array();
		$total_price = 0;
		while($jpro = $fetchpro->fetch_assoc())
		{
			$kop['Product_quantity'] = $jpro['pquantity'];
			$kop['Product_name'] = $jpro['ptitle'];
			$kop['Product_discount'] = $jpro['pdiscount'];
			
			$kop['Product_price'] = $jpro['pprice'];
			
			$discount = $jpro['pprice'] * $jpro['pdiscount']*$jpro['pquantity'] /100;
			
			$kop['Product_total'] = ($jpro['pprice'] * $jpro['pquantity']) - $discount;
			$total_price = $total_price + $kop['Product_total'];
			$pdata[] = $kop;
		}
		if($row['subtotal'] == 0)
		{
			$pp['Order_SubTotal'] = $total_price;
		}
		else 
		{
		$pp['Order_SubTotal'] = $row['subtotal'];
		}
		$pp['Order_Product_Data'] = $pdata;
		$pp['add_desc'] =  empty($row['add_desc']) ? "" : $row['add_desc'];
		$pp['add_price'] =  empty($row['add_price']) ? "" : $row['add_price'];
		if($row['p_id'] != '')
		{
		$pnames = $mysqli->query("select * from tbl_payment_list where id=".$row['p_id']."")->fetch_assoc();
		$pp['add_method_name'] = $pnames['title'];
		$pp['add_tran_id'] = $row['t_id'];
		}
		else 
		{
			$pp['add_method_name'] = '';
			$pp['add_tran_id'] = '';
		}
		$result[] = $pp;
	}
   
   
      
            
    $returnArr = array("order_data"=>$result,"Is_approve"=>$cdata['aprove'],"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Get successfully!");
  }
  else 
  {
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"No ".$status." Order Found!");   
  }
}
echo json_encode($returnArr);