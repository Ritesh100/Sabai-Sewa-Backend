<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
<?php 
		if(isset($_POST['icat']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$category = $_POST['category'];
			$okey = $_POST['status'];
			$target_dir = "assets/category/catimg/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
			$temps = explode(".", $_FILES["cat_video"]["name"]);
			$vname = uniqid() . '.' . end($temps);
$newfilename = uniqid() . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
$target_files = $target_dir . basename($vname);
			
			
  
		
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				move_uploaded_file($_FILES["cat_video"]["tmp_name"], $target_files);


  $table="g_subcategory";
  $field_values=array("title","img","status","cid","video");
  $data_values=array("$dname","$target_file","$okey","$category","$target_files");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
$msg = 'Subcategory Insert Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}
		}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$category = $_POST['category'];
			$okey = $_POST['status'];
			$target_dir = "assets/category/catimg/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
			$temps = explode(".", $_FILES["cat_video"]["name"]);
			$vname = uniqid() . '.' . end($temps);
$newfilename = uniqid() . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
$target_files = $target_dir . basename($vname);
			
	if($_FILES["cat_img"]["name"] != '' and $_FILES["cat_video"]["name"] == '')
	{		
    
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				 
$table="g_subcategory";
  $field = array('title'=>$dname,'status'=>$okey,'img'=>$target_file,'cid'=>$category);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
$msg = 'Subcategory Update Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}

	}
	else if($_FILES["cat_img"]["name"] == '' and $_FILES["cat_video"]["name"] != '')
	{		
    
			
		move_uploaded_file($_FILES["cat_video"]["tmp_name"], $target_files);
				 
$table="g_subcategory";
  $field = array('title'=>$dname,'status'=>$okey,'video'=>$target_files,'cid'=>$category);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
$msg = 'Subcategory Update Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}

	}
	else if($_FILES["cat_img"]["name"] != '' and $_FILES["cat_video"]["name"] != '')
	{		
    
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
		move_uploaded_file($_FILES["cat_video"]["tmp_name"], $target_files);
				 
$table="g_subcategory";
  $field = array('title'=>$dname,'status'=>$okey,'video'=>$target_files,'img'=>$target_file,'cid'=>$category);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
$msg = 'Subcategory Update Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}

	}
	else 
	{
		
		$table="g_subcategory";
  $field = array('title'=>$dname,'status'=>$okey,'cid'=>$category);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
if($check == 1)
{
$msg = 'Subcategory Update Successfully!!';
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
					<h1>Edit Sub Category</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add Sub Category</h1>
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
					$data = $mysqli->query("select * from g_subcategory where id=".$_GET['id']."")->fetch_assoc();
					?>
					<form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
									
									<div class="form-group">
									<label for="cname">Select Category</label>
									<select name="category" class="form-control chosen-select" required>
									
									<?php 
									$product = $mysqli->query("select * from category");
									while($rmed = $product->fetch_assoc())
									{
									?>
									<option value="<?php echo $rmed['id'];?>" <?php if($data['cid'] == $rmed['id']){echo 'selected';}?>><?php echo $rmed['cat_name'];?></option>
									<?php } ?>
									</select>
								</div>
								
                                        <div class="form-group">
                                            <label>Sub Category Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Category Name" value="<?php echo $data['title'];?>" name="cname" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Sub Category Image</label>
                                            <input type="file" class="form-control" name="cat_img">
											<br>
											<img src="<?php echo $data['img']?>" width="100px"/>
                                        </div>
										<div class="form-group">
                                            <label>Category Video</label>
                                            <input type="file" class="form-control" name="cat_video">
											<br>
											<video width="120" height="140" controls>
  <source src="<?php echo $data['video']?>" type="video/mp4">
  
</video>
                                        </div>
										 <div class="form-group">
                                            <label>Sub Category Status</label>
                                            <select name="status" class="form-control">
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update Category</button>
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
									<label for="cname">Select Category</label>
									<select name="category" class="form-control chosen-select" required>
									
									<?php 
									$product = $mysqli->query("select * from category");
									while($rmed = $product->fetch_assoc())
									{
									?>
									<option value="<?php echo $rmed['id'];?>"><?php echo $rmed['cat_name'];?></option>
									<?php } ?>
									</select>
								</div>
                                        <div class="form-group">
                                            <label>Sub Category Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Sub Category Name" name="cname" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Sub Category Image</label>
                                            <input type="file" class="form-control" name="cat_img"  required="">
                                        </div>
										<div class="form-group">
                                            <label>Sub Category Video</label>
                                            <input type="file" class="form-control" name="cat_video"  required="">
                                        </div>
										 <div class="form-group">
                                            <label>Sub Category Status</label>
                                            <select name="status" class="form-control">
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add Sub Category</button>
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