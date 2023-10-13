<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        
	<?php 
						if(isset($_POST['mark_com']))
						{
							$pby = $_POST['pby'];
							$id = $_POST['request_id'];
							
       $target_dir = "assets/proof/";
								$temp = explode(".", $_FILES["p_proof"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
       
        
       move_uploaded_file($_FILES["p_proof"]["tmp_name"], $target_file);
						
						$status = 'completed';
						$table="payout_setting";
  $field = array('proof'=>$target_file,'p_by'=>$pby,'status'=>$status);
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
$msg = 'Payout Update Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}
 }
						?>	
		
						
        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Payout List</h1>
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
					<?php } ?>
                               <div class="card-body">
							   <?php 
	if(isset($_GET['payout']))
						{
							?>
							<form class="form" method="post"  enctype="multipart/form-data">
							<div class="form-body">
								

								

								
								<div class="form-group">
									<label for="cname">PayOut By?</label>
									<select name="pby" class="form-control" required>
									<option value="">select a Method</option>
									<option value="UPI">UPI</option>
									<option value="BANK">BANK</option>
									<option value="PAYPAL">PAYPAL</option>
									</select>
								</div>
								

								
<div class="form-group">
						<label for="cname">PayOut Image?</label>			
<input type="hidden" name="request_id" value="<?php echo $_GET['payout'];?>"/>								
								
								

                                                <input type="file" name="p_proof" class="form-control" required>
                                                
                                          
											
								</div>
								
							</div>

							 <div class=" text-left">
                                        <button name="mark_com" class="btn btn-primary">Complete Payout <i class="fas fa-receipt"></i></button>
                                    </div>
							
							
						</form>
							   <?php 
						}
						else 
						{
						?>
                                    <div class="table-responsive">
                                        <table class="table table-striped v_center" id="table-1">
                                            <thead>
                                                <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                               <th>Request Id</th>
                                    <th>Amount</th>
                                   
									<th>Partner Name</th>
									<th>Upi Address</th>
									<th>Paypal Address</th>
                                    <th>Bank Details</th>
									<th>Partner Mobile</th>
									
									 <th>Status</th>
<th>Action</th>
                                                </tr>
                                            </thead>
                                           <tbody>
                                            <?php 
											 $stmt = $mysqli->query("SELECT * FROM `payout_setting`");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td><?php echo $row['rid'];?></td> 
                                    <td><?php echo $row['amt'].' '.$set['currency'];?></td>
									<?php 
									$vdetails = $mysqli->query("select * from partner where id=".$row['vid']."")->fetch_assoc();
									?>
									<td><?php echo $vdetails['name'];?></td>
									<td><?php echo $row['upi'];?></td>
									<td><?php echo $row['paypalid'];?></td>
									<td><?php echo 'Bank Name: '.$row['bname'].'<br>'.'A/C No: '.$row['acno'].'<br>'.'A/C Name: '.$row['rname'].'<br>'.'IFSC CODE: '.$row['ifsc'].'<br>';?></td>
									 <td><?php echo $vdetails['mobile'];?></td>
									 
									 <td><?php echo ucfirst($row['status']);?></td>
                                     <td>
									 <?php if($row['status'] == 'pending') {?>
									<a href="?payout=<?php echo $row['id'];?>"><button class="btn shadow-z-2 btn-danger gradient-pomegranate">Make A Payout</button></a>
									 <?php } else { ?>
									 <p><?php echo ucfirst($row['status']);?></p>
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


</html>