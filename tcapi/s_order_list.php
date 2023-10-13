<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '')
{ 
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
 $uid =  strip_tags(mysqli_real_escape_string($mysqli,$data['uid']));
 

  $sel = $mysqli->query("select * from tbl_order where uid = ".$uid."   order by id desc");
  
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
		$partner = $mysqli->query("select * from partner where id=".$row['rid']."")->fetch_assoc();
		if($row['o_status'] == 'Pending' or $row['o_status'] == 'Cancelled')
		{
			$pp['partner_img']='';
		$pp['partner_name']='';
		$pp['partner_mobile']='';
		}
		else 
		{
		$pp['partner_img']=$partner['pimg'];
		$pp['partner_name']=$partner['name'];
		$pp['partner_mobile']=$partner['mobile'];
		}
		$pp['p_method_name'] = $pname['title'];
		$pp['customer_address'] = $row['address'];
		
		$pp['lats'] = $row['lats'];
		
		$pp['longs'] = $row['longs'];
		$pp['order_time'] = $row['time'];
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
		$pp['wal_amt'] = $row['wal_amt'];
		$pp['Order_Total'] = $row['o_total'];
		 
		
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
		$pp['Order_Product_Data'] = $pdata;
		$result[] = $pp;
	}
   
   
      
            
    $returnArr = array("customerorderlist"=>$result,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Get successfully!");
  }
  else 
  {
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"No Pending Order Found!");   
  }
}
echo json_encode($returnArr);