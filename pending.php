<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
$getkey = $mysqli->query("select * from setting")->fetch_assoc();
define('ONE_KEY',$getkey['one_key']);
define('ONE_HASH',$getkey['one_hash']);
define('r_key',$getkey['r_key']);
define('r_hash',$getkey['r_hash']);
function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}

?>
        <!-- Start main left sidebar menu -->
        

<?php 
								if(isset($_POST['make_decision']))
								{
									$status = $_POST['status'];
									$comment = $_POST['comment'];
									$credit = $_POST['credit'];
									if($status == 1)
									{
									 
									 $table="tbl_order";
  $field = array('a_status'=>$status,'comment_reject'=>$comment,'r_credit'=>$credit);
  $where = "where id=".$_GET['dsid']."";
  
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
	  $checks = $mysqli->query("select * from tbl_order where id=".$_GET['dsid']."")->fetch_assoc(); 
	  $uid = $checks['uid'];
	  $cid = $checks['cid'];
			$udata = $mysqli->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['name'];

	  $oid = $_GET['dsid'];
	  $timestamp = date("Y-m-d H:i:s");

$title_main = "Service Booked!!";
$description = $name.', Your Service #'.$oid.' Has Been Booked.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
      $h = new Common();
	   $h->Insertdata($field_values,$data_values,$table);
	   
	   
$content = array(
       "en" => $name.', Your Service #'.$_GET['dsid'].' Has Been Booked.'
   );
$heading = array(
   "en" => "Service Booked!!"
);

$fields = array(
'app_id' => ONE_KEY,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$_GET['dsid']),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/order_process_img/received.png'
);

$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.ONE_HASH));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);

if($checks['rid'] == 0)
{
	$plist = $mysqli->query("select id from partner where category_id=".$cid."");
	while($row = $plist->fetch_assoc())
	{
	$content = array(
       "en" => 'New Service Arrival!!'
   );
$heading = array(
   "en" => "Check Service And Accept!!"
);

$fields = array(
'app_id' => r_key,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$_GET['dsid']),
'filters' => array(array('field' => 'tag', 'key' => 'PartnerId', 'relation' => '=', 'value' => $row['id'])),
'contents' => $content,
'headings' => $heading
);

$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.r_hash));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);
	}
}
else 
{

$content = array(
       "en" => 'New Service Arrival!!'
   );
$heading = array(
   "en" => "Check Service And Accept!!"
);

$fields = array(
'app_id' => r_key,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$_GET['dsid']),
'filters' => array(array('field' => 'tag', 'key' => 'PartnerId', 'relation' => '=', 'value' => $checks['rid'])),
'contents' => $content,
'headings' => $heading
);

$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.r_hash));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);
}
if($check == 1)
{
$msg = 'Order Approve Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
 
}

									}
									else 
									{
										 
										 $table="tbl_order";
  $field = array('a_status'=>$status,'comment_reject'=>$comment,'order_status'=>2,'o_status'=>'Cancelled');
  $where = "where id=".$_GET['dsid']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
$msgno = 'Order Reject Successfully!!'; 
echo "<meta http-equiv='refresh' content='3'>";
}
									}
									
								}
									?>

		
		
		
        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
				<?php 
				if(isset($_GET['oid']))
				{
					?>
					<h1>Assign Rider</h1>
					<?php 
				}
				elseif(isset($_GET['dsid']))
				{
					?>
					<h1>ACCEPT OR REJECT ORDER</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Pending Order List</h1>
                <?php } ?>
				</div>
				<div class="card">
				<?php 
if($msg != '')
{
?>
<div class="alert alert-success alert-dismissible show fade">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert"><span>×</span></button>
                                            <?php echo $msg;?>
                                        </div>
                                    </div>
					<?php } else if($msgno != '') {?>
					<div class="alert alert-danger alert-dismissible show fade">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert"><span>×</span></button>
                                            <?php echo $msgno;?>
                                        </div>
                                    </div>
					<?php }else {}?>
                               <div class="card-body">
							   <?php 
							   if(isset($_GET['dsid']))
				{
							   ?>
							  <form class="form" method="post" enctype="multipart/form-data">
							<div class="form-body">
								


								<div class="form-group">
									<label for="cname">Select Status</label>
									<select name="status" class="form-control" required>
									<option value="">select a Status</option>
									<option value="1">Accept</option>
									<option value="2">Reject</option>
									</select>
								</div>
                                
								<div class="form-group">
									<label for="cname">Comment</label>
									<textarea  class="form-control" name="comment"  required></textarea>
								</div>
								
								
								<div class="form-group">
									<label for="cname">Credit Required For This Order Accept??</label>
									<input  type="number" class="form-control" name="credit"  required />
								</div>
								
								<div class="card-footer text-left">
                                        <button name="make_decision" class="btn btn-primary">Submit Decision</button>
                                    </div>
								</div>
								</form>
								
							   <?php } else { ?>
                                    <div class="table-responsive">
									
                                        <table class="table table-striped v_center" id="table-1">
                                            <thead>
                                                <tr>
                                               <th>#</th>
												 <th>Order Id</th>
                                                 <th>Order Date </th>
												 <th>Service Partner Name</th>
                                                 <th>Current Status</th>
												 <th>Hire Type</th>
                                                 
												 <th>Credit Required?</th>
												 <th>Preview Data</th>
												 <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											
											 $stmt = $mysqli->query("SELECT * FROM `tbl_order` where o_status!='Cancelled' and o_status!='Completed'  order by id desc");

while($row = $stmt->fetch_assoc())
{
	
											?>
                                                <tr>
												
												<?php 
												if($row['o_status'] == 'Pending')
												{
													?>
												<td class="beep">  </td>
                                                <?php } else if($row['o_status'] == 'Processing') {?>
												<td class="beeps">  </td>
                                                <?php } else {?>
												<td class="beepss">  </td>
												<?php }?>
												
												<td> <?php echo $row['id']; ?> </td>
                                                
                                                
                                               <td> <?php 
											   $date=date_create($row['odate']);
echo date_format($date,"d-m-Y");
											   ?></td>
											   <td><?php $rdata = $mysqli->query("select * from partner where id=".$row['rid']."")->fetch_assoc(); if($rdata['name'] == '') {echo '';}else {echo $rdata['name'];}?></td>
											   <td> <?php echo $row['o_status']; ?></td>
											  <td> <?php echo $row['htype']; ?></td>
												 
												 <td> <?php echo $row['r_credit'];?></td>
                                               <td> <button class="preview_d btn btn-primary" data-id="<?php echo $row['id'];?>" data-toggle="modal" data-target="#myModal">Preview</button></td>
												<td>
												<?php if($row['a_status'] == 0){?>
												<a href="?dsid=<?php echo $row['id']; ?>"  class="btn btn-success">Make A Decision</a>
												
												<?php }else if($row['a_status'] == 1) {?>
												<span class="text text-success">Accepted</span>
												<?php } else { ?>
												<span class="text text-danger"> Rejected </span>
												<?php } ?>
												
												</td>
                                                </tr>
<?php } ?>                                           
                                            </tbody>
                                        </table>
									
                                    </div>
									<?php } ?>
                                </div>
                            </div>
            </div>
					
                
            </section>
        </div>
        
       
    </div>
</div>

<?php require 'include/footer.php';?>


</body>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg ">

    
    <div class="modal-content gray_bg_popup">
      <div class="modal-header">
        <h4>Order Preivew</h4>
        <button type="button" class="close popup_open" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body p_data">
      
      </div>
     
    </div>

  </div>
</div>
</html>