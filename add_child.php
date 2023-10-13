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
			$subcategory = $_POST['subcategory'];
			if($subcategory == '')
			{
				$subcategory = 0;
			}
			$okey = $_POST['status'];
			$target_dir = "assets/category/catimg/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = uniqid() . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
			
   
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				


  $table="tbl_child";
  $field_values=array("title","img","status","cid","sid");
  $data_values=array("$dname","$target_file","$okey","$category","$subcategory");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
$msg = 'Child Category Add Successfully!!'; 
echo "<meta http-equiv='refresh' content='3'>";
}
}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$category = $_POST['category'];
			$subcategory = $_POST['subcategory'];
			if($subcategory == '')
			{
				$subcategory = 0;
			}
			$okey = $_POST['status'];
			$target_dir = "assets/category/catimg/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = uniqid() . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cat_img"]["name"] != '')
	{		
   
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				 
$table="tbl_child";
  $field = array('title'=>$dname,'status'=>$okey,'img'=>$target_file,'cid'=>$category,'sid'=>$subcategory);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
$msg = 'Child Category Update Successfully!!'; 
echo "<meta http-equiv='refresh' content='3'>";
		
		
	}
	}
	else 
	{
		
		$table="tbl_child";
  $field = array('title'=>$dname,'status'=>$okey,'cid'=>$category,'sid'=>$subcategory);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
if($check == 1)
{
$msg = 'Child Category Update Successfully!!';
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
					<h1>Edit Child Category</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add Child Category</h1>
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
					$data = $mysqli->query("select * from tbl_child where id=".$_GET['id']."")->fetch_assoc();
					?>
					<form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
									
									<div class="form-group">
									<label for="cname">Select Category</label>
									<select name="category" class="form-control cats" required>
										<option value="0">Select A Category</option>
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
									<label for="cname">Select Sub Category</label>
									<select name="subcategory" class="form-control sub">
										<option value="0">Select A Sub Category</option>
									<?php 
									$product = $mysqli->query("select * from g_subcategory where cid=".$data['cid']."");
									while($rmed = $product->fetch_assoc())
									{
									?>
									<option value="<?php echo $rmed['id'];?>" <?php if($data['sid'] == $rmed['id']){echo 'selected';}?>><?php echo $rmed['title'];?></option>
									<?php } ?>
									
									</select>
								</div>
								
                                        <div class="form-group">
                                            <label>Child Category Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Child Name" value="<?php echo $data['title'];?>" name="cname" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Child Category Image</label>
                                            <input type="file" class="form-control" name="cat_img">
											<br>
											<img src="<?php echo $data['img']?>" width="100px"/>
                                        </div>
										 <div class="form-group">
                                            <label>Child Category Status</label>
                                            <select name="status" class="form-control">
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update Child</button>
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
									<select name="category" class="form-control  cats" required>
										<option value="0">Select A Category</option>
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
									<label for="cname">Select Sub Category</label>
									<select name="subcategory" class="form-control  sub">
									
									
									</select>
								</div>
								
                                        <div class="form-group">
                                            <label>Child Category Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Child Category Name" name="cname" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Child Category Image</label>
                                            <input type="file" class="form-control" name="cat_img"  required="">
                                        </div>
										 <div class="form-group">
                                            <label>Child Category Status</label>
                                            <select name="status" class="form-control">
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add Child Category</button>
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