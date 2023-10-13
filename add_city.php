<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
       
	<?php 
		if(isset($_POST['icat']))
		{
			$cname = mysqli_real_escape_string($mysqli,$_POST['cname']);
		$status = $_POST['status'];
  $table="tbl_city";
  $field_values=array("cname","status");
  $data_values=array("$cname","$status");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
$msg = 'City Insert Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}


		
		
		}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			$cname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$status = $_POST['status'];
			
	
		$table="tbl_city";
  $field = array('cname'=>$cname,'status'=>$status);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
if($check == 1)
{
$msg = 'City Update Successfully!!';
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
					<h1>Edit City</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add City</h1>
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
					$data = $mysqli->query("select * from tbl_city where id=".$_GET['id']."")->fetch_assoc();
					?>
					<form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>City Name</label>
                                            <input type="text" class="form-control" placeholder="Enter City Name" value="<?php echo $data['cname'];?>" name="cname" required="">
                                        </div>
										
                                        
										 <div class="form-group">
                                            <label>City Status</label>
                                            <select name="status" class="form-control">
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >UnPublish</option>
											</select>
                                        </div>
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update City</button>
                                    </div>
                                </form>
					<?php 
				}
				else 
				{
					?>
                                <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>City Name</label>
                                            <input type="text" class="form-control" placeholder="Enter City Name" name="cname" required="">
                                        </div>
										
										
										<div class="form-group">
                                            <label>City Status</label>
                                            <select name="status" class="form-control">
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
										
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add City</button>
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