<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
   <?php 
		if(isset($_POST['icat']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['title']);
			$subtitle = mysqli_real_escape_string($mysqli,$_POST['subtitle']);
			$okey = $_POST['status'];
			
			
			
				


  $table="tbl_home";
  $field_values=array("subtitle","title","status");
  $data_values=array("$subtitle","$dname","$okey");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
$msg = 'Home Section Insert Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}
		}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['title']);
			$subtitle = mysqli_real_escape_string($mysqli,$_POST['subtitle']);
			$okey = $_POST['status'];
			
	
		
		$table="tbl_home";
  $field = array('subtitle'=>$subtitle,'title'=>$dname,'status'=>$okey);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
if($check == 1)
{
$msg = 'Home Section Update Successfully!!';
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
					<h1>Edit  Section</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add  Section</h1>
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
					$data = $mysqli->query("select * from tbl_home where id=".$_GET['id']."")->fetch_assoc();
					?>
					<form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                       <div class="form-body">
								

								

								
								<div class="form-group">
									<label for="cname">Title</label>
									<input type="text" id="pimg" class="form-control"  value="<?php echo $data['title'];?>" placeholder="Enter Title" name="title" required>
								</div>
								
                                		
										<div class="form-group">
									<label for="cname">Subtitle</label>
									<input type="text" id="pimg" class="form-control"  value="<?php echo $data['subtitle'];?>" placeholder="Enter SubTitle" name="subtitle" required>
								</div>
										
										
										<div class="form-group">
											<label for="projectinput6">Status?</label>
											<select id="sub_list" name="status" class="form-control" required>
												<option value="" selected="">Select Status</option>
												<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Yes</option>
												<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>No</option>
												
												
											</select>
										</div>

								
								
							</div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update  Section</button>
                                    </div>
                                </form>
					<?php 
				}
				else 
				{
					?>
                                <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        <div class="form-body">
								

								

								
								<div class="form-group">
									<label for="cname">Title</label>
									<input type="text" id="pimg" class="form-control"  placeholder="Enter Title" name="title" required>
								</div>
								
                                		
										<div class="form-group">
									<label for="cname">Subtitle</label>
									<input type="text" id="pimg" class="form-control"  placeholder="Enter SubTitle" name="subtitle" required>
								</div>
										
										
										<div class="form-group">
											<label for="projectinput6">Status?</label>
											<select  name="status" class="form-control" required>
												<option value="" selected="">Select Status</option>
												<option value="1">Yes</option>
												<option value="0">No</option>
												
												
											</select>
										</div>

								
								
							</div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add  Section</button>
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