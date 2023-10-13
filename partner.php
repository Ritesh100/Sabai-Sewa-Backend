<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
<?php 
	if(isset($_POST['add_cash']))
	{
		$rcash = $_POST['rcash'];
		$message = $_POST['message'];
		$rid = $_GET['cashid'];
$timestamp = date("Y-m-d H:i:s");
	   
	   $table="tbl_cash";
  $field_values=array("rid","message","amt","pdate");
  $data_values=array("$rid","$message","$rcash","$timestamp");
   
      $h = new Common();
	  $checks = $h->Insertdata($field_values,$data_values,$table);
	  
	  if($checks == 1)
{
$msg = 'Partner Cash Collect Successfully!!'; 
echo "<meta http-equiv='refresh' content='3'>";
}
		}
	?>
	
	<?php 
							
							if(isset($_POST['setcom']))
							{
								$pid = $_GET['cid'];
								$amt = $_POST['commission'];
								 $vp = $mysqli->query("select * from partner where id=".$pid."")->fetch_assoc();
	  
  $table="partner";
  $field = array('commission'=>$amt);
  $where = "where id=".$pid."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
	  if($check == 1)
{
	$msg = 'Partner Commission Set Successfully!!';
	echo "<meta http-equiv='refresh' content='3'>";
}
}
							?>
							
							
<?php 
if(isset($_GET['did']))
{
	$id = $_GET['did'];

$table="partner";
$where = "where id=".$id."";
$h = new Common();
	$check = $h->Deletedata($where,$table);

if($check == 1)
{
$msgno = 'Partner Delete Successfully!!'; 
echo "<meta http-equiv='refresh' content='3'>";
} 
}
?>

<?php 
		
		if(isset($_GET['status']))
		{
			
		$id = $_GET['id'];
$status = $_GET['status'];
 $table="partner";
  $field = "status=".$status."";
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData_single($field,$table,$where);
if($check == 1)
{
$msg = 'Partner Status Change Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}
}
		?>


<?php 
		
		if(isset($_GET['aprove']))
		{
			
		$id = $_GET['id'];
$aprove = $_GET['aprove'];
 $table="partner";
  $field = "aprove=".$aprove."";
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData_single($field,$table,$where);
if($check == 1)
{
$msg = 'Partner Approve Successfully!!'; 
echo "<meta http-equiv='refresh' content='3'>";
}
  
		}
		?>
		

        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
			<?php 
			if(isset($_GET['cid']))
			{
				?>
				<div class="section-header">
				                    <h1>Set Commission</h1>
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
				                                <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Commission</label>
                                            <input type="number" class="form-control" placeholder="Enter Commission" name="commission" required="">
                                        </div>
										
										
										
										
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="setcom" class="btn btn-primary">Set Commission</button>
                                    </div>
                                </form>
				                            </div>
											
										
				<?php 
			}
			else if(isset($_GET['cashid']))
			{
				?>
				<div class="section-header">
				                    <h1>Manage Cash</h1>
				                </div>
				
				<div class="card">
				
				
				                                <form method="post" enctype="multipart/form-data">
                                       <div class="card-body">
									   <?php $sales  = $mysqli->query("select sum(o_total) as full_total from tbl_order where o_status='completed'  and p_method_id=2 and  rid=".$_GET['cashid']."")->fetch_assoc();
             $payout =   $mysqli->query("select sum(amt) as full_payouts from tbl_cash where rid=".$_GET['cashid']."")->fetch_assoc();
                 
				
				$pb = 0;
				 if($sales['full_total'] == ''){$pb =  '0';}else {$pb  = number_format((float)($sales['full_total']) - $payout['full_payouts'], 2, '.', ''); } ?>
				 
									   <div class="form-group">
                                            <label><span class="text-danger">*</span> Remain  Cash</label>
                                            <input type="text" class="form-control" value="<?php echo $pb;?>"  name="remain" required="" readonly>
                                        </div>
										
										 <div class="form-group">
                                            <label><span class="text-danger">*</span> Received Cash</label>
                                            <input type="text" class="form-control" placeholder="Enter Received Cash"  name="rcash" required="">
                                        </div>
										
										 <div class="form-group">
                                            <label><span class="text-danger">*</span> Message</label>
                                            <input type="text" class="form-control" placeholder="Enter Message"  name="message" required="" >
                                        </div>
										
                                     
										
										
										<div class="col-12">
                                                <button type="submit" name="add_cash" class="btn btn-primary mb-2">Add Cash Collection</button>
                                            </div>
											</div>
                                    </form>
				                            </div>
											
											
				<?php 
			}
			else if(isset($_GET['hid']))
			{
				?>
				  <div class="section-header">
                    <h1>Cash Collection Log</h1>
                </div>
				<div class="card">
				
                               <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped v_center" id="table-1">
                                            <thead>
                                            <tr>
                                                <th>Sr No.</th>
												<th>Partner Name</th>
                                                
												 
												 <th>Received <br>Cash</th>
												 <th>Message</th>
                                                <th>Received <br>Date</th>
                                                

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
											 $stmts = $mysqli->query("SELECT * FROM `partner` where id =".$_GET['hid']."")->fetch_assoc();
											 $stmt = $mysqli->query("SELECT * FROM `tbl_cash` where rid =".$_GET['hid']."");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td class="align-middle">
                                                   <?php echo $stmts['name']; ?>
                                                </td>
												
                                                <td class="align-middle">
                                                  <?php echo $row['amt'].' '.$set['currency']; ?>
                                                </td>
                                                
                                               
				 <td class="align-middle">
                                                  <?php echo $row['message']; ?>
                                                </td>
												
												 <td class="align-middle">
                                                  <?php echo date("d M Y, h:i a", strtotime($row['pdate'])); ?>
                                                </td>
												
                                                </tr>
<?php } ?> 
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
				<?php 
			}
			else 
			{
			?>
                <div class="section-header">
                    <h1>Partner List</h1>
                </div>
				<div class="card">
				
                               <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped v_center" id="table-1">
                                            <thead>
                                                <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                
                                                
                                                <th>Mobile</th>
												<th>Commission</th>
												<th>Credit</th>
												<th>City</th>
												<th>Address</th>
												<th>Partner Category</th>
												<th>Status</th>
												<th>Approve??</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											 $stmt = $mysqli->query("SELECT * FROM `partner` order by id desc");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td> <?php echo $row['name']; ?></td>
                                                <td> <?php echo $row['email']; ?></td>
												<td> <?php echo $row['mobile']; ?></td>
                                                
                                               <td> <?php if($row['commission'] == 0){echo 'set commission';}else{echo $row['commission'].' %';} ?></td>
												
												
																								
												
												<td> <?php echo $row['credit']; ?></td>
												<td> <?php echo $row['city']; ?></td>
												<td> <?php echo $row['address']; ?></td>
												<td> <?php $cdata = $mysqli->query("select * from category where id=".$row['category_id']."")->fetch_assoc(); echo $cdata['cat_name'];?></td>
												<?php if($row['status'] == 1) { ?>
                                                <td><a href="?id=<?php echo $row['id'];?>&status=0"><div class="badge badge-danger">Make Deactive</div></a></td>
												<?php } else { ?>
												<td><a href="?id=<?php echo $row['id'];?>&status=1"><div class="badge badge-success">Make Active</div></a></td>
												<?php } ?>
												
												<?php if($row['aprove'] == 0) { ?>
                                                <td><a href="?id=<?php echo $row['id'];?>&aprove=1"><div class="badge badge-success">Make Approve</div></a> <a href="?id=<?php echo $row['id'];?>&aprove=2"><div class="badge badge-danger">Make Disapprove</div></a></td>
												<?php } else if($row['aprove'] == 2){ ?>
												<td><div class="badge badge-danger">Disappproved</div></td>
												<?php } else {
													?>
													<td><div class="badge badge-success">Appproved</div></td>
													<?php 
												}?>
												
												<td>
												<a href="?did=<?php echo $row['id']; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete Partner"><i class="fas fa-trash-alt"></i></a>
												<?php 
												if($row['aprove'] == 1){
												?>
												<a href="preport.php?pid=<?php echo $row['id']; ?>" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Manage Partner Report" ><i class="fas fa-chart-bar"></i></a>
												<a href="?cid=<?php echo $row['id']; ?>" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Set Commission" ><i class="fa fa-percent"></i></a>
												<a href="?cashid=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Manage Cash" class="btn btn-info shadow btn-xs sharp mr-1"><i class="fas fa-money-bill-alt"></i></a>
												<a href="?hid=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Cash Collection Log" class="btn btn-danger shadow btn-xs sharp mr-1"><i class="fa fa-history"></i></a>
												<?php } ?>
												</td>
                                                </tr>
<?php } ?>                                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
			<?php } ?>
            </div>
					
                
            </section>
        </div>
        
       
    </div>
</div>

<?php require 'include/footer.php';?>


</body>


</html>