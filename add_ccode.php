<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
<?php 
		if(isset($_POST['icat']))
		{
			$dname = $_POST['pincode'];
			
			$okey = $_POST['status'];
			
		
				


  $table="tbl_code";
  $field_values=array("ccode","status");
  $data_values=array("$dname","$okey");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
$msg = 'Country Code Insert Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}

		}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			$dname = $_POST['pincode'];
			
			$okey = $_POST['status'];
			
			
$table="tbl_code";
  $field = array('ccode'=>$dname,'status'=>$okey);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
$msg = 'Country Code Update Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}

		}
		?>		

        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
				<?php 
				if(isset($_GET['id']))
				{
					?>
					<h1>Edit Country Code</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add Country Code</h1>
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
					<?php } ?>
				<?php 
				if(isset($_GET['id']))
				{
					$data = $mysqli->query("select * from tbl_code where id=".$_GET['id']."")->fetch_assoc();
					?>
					<form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Country Code</label>
                                            <input type="text"  value="<?php echo $data['ccode'];?>"  class="form-control" placeholder="Enter Country Code" name="pincode" required="">
                                        </div>
                                        
										  <div class="form-group">
                                            <label>Country Code Status</label>
                                            <select name="status" class="form-control">
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update Country Code</button>
                                    </div>
                                </form>
					<?php 
				}
				else 
				{
					?>
                                <form method="post">
                                    
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Country Code</label>
                                            <input type="text"  class="form-control" placeholder="Enter Country Code" name="pincode" required="">
                                        </div>
                                        
										 <div class="form-group">
                                            <label>Country Code Status</label>
                                            <select name="status" class="form-control">
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add Country Code</button>
                                    </div>
                                </form>
				<?php } ?>
                            </div>
            </div>
					
                
            </section>
        </div>
        
       
    </div>
</div>

<?php require 'include/footer.php';?>


</body>


</html>