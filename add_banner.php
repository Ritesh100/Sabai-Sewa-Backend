<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
		<?php 
		if(isset($_POST['icat']))
		{
			
			
			$okey = $_POST['status'];
			$cat = $_POST['cat'];
			$subcat = $_POST['subcat'];
			$child = $_POST['child'];
			$target_dir = "assets/category/catimg/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
			
    
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				


  $table="banner";
  $field_values=array("img","status","mid","sid","cid");
  $data_values=array("$target_file","$okey","$cat","$subcat","$child");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
$msg = 'Banner Insert Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}

		}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			
			
			$okey = $_POST['status'];
			$cat = $_POST['cat'];
			$subcat = $_POST['subcat'];
			$child = $_POST['child'];
			$target_dir = "assets/category/catimg/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cat_img"]["name"] != '')
	{		
    
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				 
$table="banner";
  $field = array('status'=>$okey,'img'=>$target_file,'mid'=>$cat,'sid'=>$subcat,'cid'=>$child);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
$msg = 'Banner Update Successfully!!'; 
echo "<meta http-equiv='refresh' content='3'>";
}

	}
	else 
	{
		
		$table="banner";
  $field = array('status'=>$okey,'mid'=>$cat,'sid'=>$subcat,'cid'=>$child);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
if($check == 1)
{
$msg = 'Banner Update Successfully!!';
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
				if(isset($_GET['id']))
				{
					?>
					<h1>Edit Banner</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add Banner</h1>
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
					$data = $mysqli->query("select * from banner where id=".$_GET['id']."")->fetch_assoc();
					?>
					<form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        
                                        <div class="form-group">
                                            <label>Banner Image</label>
                                            <input type="file" class="form-control" name="cat_img"><br>
											<img src="<?php echo $data['img']?>" width="200px"/>
                                        </div>
										
										

								<div class="form-group">
									<label>Service Category</label>
									<select name="cat" class="form-control cat" required>
									<option value="">Select Service Category</option>
									<?php 
									$web = $mysqli->query("select * from category where cat_status=1");
									while($row = $web->fetch_assoc())
									{
										?>
										<option value="<?php echo $row['id'];?>" <?php if($row['id'] == $data['mid']){echo 'selected';}?> ><?php echo $row['cat_name'];?></option>
										<?php 
									}
									?>
									</select>
								</div>
								
								
								

								<div class="form-group sub">
									<label>Service Sub Category</label>
									<select name="subcat" class="form-control subcat">
									<option value="">Select Service Sub Category</option>
									<?php 
									$web = $mysqli->query("select * from g_subcategory where cid=".$data['mid']." and status=1");
									while($row = $web->fetch_assoc())
									{
										?>
										<option value="<?php echo $row['id'];?>" <?php if($row['id'] == $data['sid']){echo 'selected';}?> ><?php echo $row['title'];?></option>
										<?php 
									}
									?>
									</select>
								</div>
								
								
								

								<div class="form-group child">
									<label>Service Child Category</label>
									<select name="child" class="form-control" required>
									<option value="">Select Service Child Category</option>
									<?php 
									if($data['sid'] == 0)
									{
										$web = $mysqli->query("select * from tbl_child where cid=".$data['mid']."  and status=1");
									}
									else 
									{
									$web = $mysqli->query("select * from tbl_child where cid=".$data['mid']." and sid=".$data['sid']." and status=1");
									}
									while($row = $web->fetch_assoc())
									{
										?>
										<option value="<?php echo $row['id'];?>" <?php if($row['id'] == $data['cid']){echo 'selected';}?> ><?php echo $row['title'];?></option>
										<?php 
									}
									?>
									</select>
								</div>
								
								
										 <div class="form-group">
                                            <label>Banner Status</label>
                                            <select name="status" class="form-control">
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update Banner</button>
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
                                            <label>Banner Image</label>
                                            <input type="file" class="form-control" name="cat_img"  required="">
                                        </div>
										
										
										

								<div class="form-group">
									<label>Service Category</label>
									<select name="cat" class="form-control cat" required>
									<option value="">Select Service Category</option>
									<?php 
									$web = $mysqli->query("select * from category where cat_status=1");
									while($row = $web->fetch_assoc())
									{
										?>
										<option value="<?php echo $row['id'];?>"><?php echo $row['cat_name'];?></option>
										<?php 
									}
									?>
									</select>
								</div>
								
								
								

								<div class="form-group sub">
									<label>Service Sub Category</label>
									<select name="subcat" class="form-control subcat">
									<option value="">Select Service Sub Category</option>
									
									</select>
								</div>
								
								
								

								<div class="form-group child">
									<label>Service Child Category</label>
									<select name="child" class="form-control" required>
									<option value="">Select Service Child Category</option>
									
									</select>
								</div>
								
								 <div class="form-group">
                                            <label>Banner Status</label>
                                            <select name="status" class="form-control">
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add Banner</button>
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