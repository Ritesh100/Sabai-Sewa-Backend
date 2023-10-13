<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
   <?php 
		if(isset($_POST['icat']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			
			$okey = $_POST['status'];
			$popular = $_POST['tcomment'];
			$target_dir = "assets/category/catimg/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
			
    
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				


  $table="tbl_happy_user";
  $field_values=array("title","img","status","comment");
  $data_values=array("$dname","$target_file","$okey","$popular");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
$msg = 'Testimonial Insert Successfully!!'; 
echo "<meta http-equiv='refresh' content='3'>";
}
}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			
			$okey = $_POST['status'];
			$popular = $_POST['tcomment'];
			$target_dir = "assets/category/catimg/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cat_img"]["name"] != '')
	{		
    
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				 
$table="tbl_happy_user";
  $field = array('title'=>$dname,'status'=>$okey,'img'=>$target_file,'comment'=>$popular);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
$msg = 'Testimonial Update Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}

	}
	else 
	{
		
		$table="tbl_happy_user";
  $field = array('title'=>$dname,'status'=>$okey,'comment'=>$popular);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
if($check == 1)
{
$msg = 'Testimonial Update Successfully!!';
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
					<h1>Edit Testimonial</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add Testimonial</h1>
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
					$data = $mysqli->query("select * from tbl_happy_user where id=".$_GET['id']."")->fetch_assoc();
					?>
					<form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Testimonial Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Testimonial Name" value="<?php echo $data['title'];?>" name="cname" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Testimonial Image</label>
                                            <input type="file" class="form-control" name="cat_img">
											<img src="<?php echo $data['img']?>" width="100px"/>
                                        </div>
										<div class="form-group">
                                            <label>Testimonial Description</label>
                                           <textarea name="tcomment" class="form-control"><?php echo $data['comment']; ?></textarea>
                                        </div>
										
										 <div class="form-group">
                                            <label>Testimonial Status</label>
                                            <select name="status" class="form-control">
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update Testimonial</button>
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
                                            <label>Testimonial Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Testimonial Name"  name="cname" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Testimonial Image</label>
                                            <input type="file" class="form-control" name="cat_img">
											
                                        </div>
										
										<div class="form-group">
                                            <label>Testimonial Description</label>
                                           <textarea name="tcomment" class="form-control"></textarea>
                                        </div>
										
										 <div class="form-group">
                                            <label>Testimonial Status</label>
                                            <select name="status" class="form-control">
											<option value="1">Publish</option>
											<option value="0"  >UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add Testimonial</button>
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