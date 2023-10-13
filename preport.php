<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
<?php 
							
							if(isset($_POST['add_bal']))
							{
								$pid = $_GET['pid'];
								$amt = $_POST['amt'];
								 $vp = $mysqli->query("select * from partner where id=".$pid."")->fetch_assoc();
	  
  $table="partner";
  $field = array('credit'=>$vp['credit']+$amt);
  $where = "where id=".$pid."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
	   
	   
	   $table="tbl_credit_report";
  $field_values=array("pid","message","status","amt");
  $data_values=array("$pid",'Credit Balance Added by '.$set['d_title'].'.','Credit',"$amt");
   
      $h = new Common();
	  $checks = $h->Insertdata($field_values,$data_values,$table);
	  if($checks == 1)
{
	$msg = 'Credit Add Successfully!!';
	echo "<meta http-equiv='refresh' content='3'>";
}

							}
							?>
							
							<?php 
							if(isset($_POST['sub_bal']))
							{
								$pid = $_GET['pid'];
								$amt = $_POST['amt'];
								 $vp = $mysqli->query("select * from partner where id=".$pid."")->fetch_assoc();
	  if($vp['credit'] >= $amt)
	  {
  $table="partner";
  $field = array('credit'=>$vp['credit'] - $amt);
  $where = "where id=".$pid."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
	  
	   
	   $table="tbl_credit_report";
  $field_values=array("pid","message","status","amt");
  $data_values=array("$pid",'credit Balance Substract by '.$set['d_title'].'.','Debit',"$amt");
   
      $h = new Common();
	  $checks = $h->Insertdata($field_values,$data_values,$table);
	 if($checks == 1)
{
$msgno = 'Credit Substract Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}

							}
							else 
							{
								 $msgno = 'Wallet Not Substract Because Your Amount High As Per User Available Balance!!';
								 echo "<meta http-equiv='refresh' content='3'>";
							}
							}
							?>
							
	
							
<?php 
						if(isset($_GET['pid']))
						{
							$udata = $mysqli->query("select * from partner where id=".$_GET['pid']."")->fetch_assoc();
							if($udata['name'] == '')
							{
								header("Location: partner.php");
							}
						}
					else 
					{
						header("Location: partner.php");
					}
						
						?>
		

        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
			<div class="section-header">
                    <h1><?php echo $udata['name'];?> Card Report</h1>
                </div>
				
			<div class="row">
                    
                   
					
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
					
                        <div class="card card-statistic-1">
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas fa-shopping-bag heart"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Order</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $mysqli->query("select * from tbl_order where rid=".$_GET['pid']."")->num_rows;?>                                </div>
                            </div>
                        </div> 
						
                    </div>
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
					
                        <div class="card card-statistic-1">
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas fa-money-bill-alt"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Credit Balance</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $udata['credit'];?>                             </div>
                            </div>
                        </div> 
						
                    </div>
					
					
					</div>
					
					<div class="section-header">
				                    <h1>Add Credit OR Substract Credit</h1>
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
                                            <label>Credit</label>
                                            <input type="number" class="form-control" placeholder="Enter Credit" name="amt" required="">
                                        </div>
										
										
										
										
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                          <button type="submit" name="add_bal" class="btn btn-info mb-2">+ Add Credit</button>
												<button type="submit" name="sub_bal" class="btn btn-danger mb-2"> - Substract Credit</button>
                                    </div>
                                </form>
				                            </div>
											
                <div class="section-header">
                    <h1><?php echo $udata['name'];?> Wallet Transaction Report</h1>
                </div>
				<div class="card">
				
                               <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped v_center" id="table-1">
                                             <thead>
                                            <tr>
                                               <th class="text-center">
                                                    Sr No.
                                                </th>
												<th class="text-center">
                                                   Wallet Id
                                                </th>
												 
                                                <th>Message</th>
                                                
                                                
                                                
                                               
												<th>Status</th>
                                                <th>Credit</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                           <?php 
											 $stmt = $mysqli->query("SELECT * FROM `tbl_credit_report` where pid=".$_GET['pid']." order by id desc");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td class="align-middle">
                                                    <?php echo $i; ?>
                                                </td>
												<td class="align-middle"> <?php echo $row['id']; ?></td>
												
                                                <td> <?php echo $row['message']; ?></td>
                                                
												
                                                
                                               
												
												
																								<?php if($row['status'] == 'Credit') { ?>
                                                <td><div class="badge badge-success">Credit</div></td>
												<?php } else { ?>
												<td><div class="badge badge-danger">Debit</div></td>
												<?php } ?>
												
												<?php if($row['status'] == 'Credit') { ?>
                                                <td><div class="text text-success">+ <?php echo $row['amt'];?></div></td>
												<?php } else { ?>
												<td><div class="text text-danger">- <?php echo $row['amt'];?></div></td>
												<?php } ?>
												
                                                </tr>
<?php } ?>                                           
                                        </tbody>
                                        </table>
                                    </div>
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