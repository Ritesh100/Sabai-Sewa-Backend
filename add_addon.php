<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
       
		<?php 
		if(isset($_POST['icat']))
		{
			$title = mysqli_real_escape_string($mysqli,$_POST['title']);
			$price = $_POST['price'];
			$category = $_POST['category'];
			$okey = $_POST['status'];
			$target_dir = "assets/category/addon/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = uniqid() . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
			
    
		
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				


  $table="tbl_addon";
  $field_values=array("title","img","status","price","cid");
  $data_values=array("$title","$target_file","$okey","$price","$category");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
$msg = 'Add On Insert Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}
		
		
		}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			$title = mysqli_real_escape_string($mysqli,$_POST['title']);
			
			$category = $_POST['category'];
			$price = $_POST['price'];
			$okey = $_POST['status'];
			$target_dir = "assets/category/addon/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = uniqid() . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cat_img"]["name"] != '')
	{		
   
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				 
$table="tbl_addon";
  $field = array('title'=>$title,'status'=>$okey,'img'=>$target_file,'cid'=>$category,'price'=>$price);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
$msg = 'Add On Update Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}		
	}
	else 
	{
		
		$table="tbl_addon";
  $field = array('title'=>$title,'status'=>$okey,'cid'=>$category,'price'=>$price);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
if($check == 1)
{
$msg = 'Add On Update Successfully!!';
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
					<h1>Edit Add On</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add Add On</h1>
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
					$data = $mysqli->query("select * from tbl_addon where id=".$_GET['id']."")->fetch_assoc();
					
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
                                            <label>Add On Title</label>
                                            <input type="text" class="form-control" placeholder=" Enter Add On Title" value="<?php echo $data['title'];?>" name="title" required="">
                                        </div>
										
										 <div class="form-group">
                                            <label>Add On Price</label>
                                            <input type="number" class="form-control" placeholder="Enter Add On Price" value="<?php echo $data['price'];?>" step="any" name="price" required="">
                                        </div>
										
                                        <div class="form-group">
                                            <label>Add On Image</label>
                                            <input type="file" class="form-control" name="cat_img">
											<br>
											<img src="<?php echo $data['img']?>" width="100px"/>
                                        </div>
										 <div class="form-group">
                                            <label>Add On Status</label>
                                            <select name="status" class="form-control">
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update Add On</button>
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
                                            <label>Add On Title</label>
                                            <input type="text" class="form-control" placeholder="Enter Add On Title" name="title" required="">
                                        </div>
										<div class="form-group">
                                            <label>Add On Price</label>
                                            <input type="number" class="form-control" placeholder="Enter Add On Price"  step="any" name="price" required="">
                                        </div>
										
										
                                        <div class="form-group">
                                            <label>Add On Image</label>
                                            <input type="file" class="form-control" name="cat_img"  required="">
                                        </div>
										 <div class="form-group">
                                            <label>Add On Status</label>
                                            <select name="status" class="form-control">
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add Add On</button>
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