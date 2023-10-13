
<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
	<?php 
		if(isset($_POST['ucat']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$attributes = mysqli_real_escape_string($mysqli,$_POST['p_attr']);
			$ptitle = mysqli_real_escape_string($mysqli,$_POST['ptitle']);
			$okey = $_POST['status'];
			$target_dir = "assets/category/catimg/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cat_img"]["name"] != '')
	{		
    
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				 
$table="tbl_payment_list";
  $field = array('title'=>$dname,'status'=>$okey,'img'=>$target_file,'attributes'=>$attributes,'subtitle'=>$ptitle);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
$msg = 'Payment Gateway Update Successfully!!'; 
echo "<meta http-equiv='refresh' content='3'>";
}

	}
	else 
	{
		
		$table="tbl_payment_list";
  $field = array('title'=>$dname,'status'=>$okey,'attributes'=>$attributes,'subtitle'=>$ptitle);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
if($check == 1)
{
$msg = 'Payment Gateway Update Successfully!!';
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
					<h1>Edit Payment List</h1>
					<?php 
				}
				?>
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
					$data = $mysqli->query("select * from tbl_payment_list where id=".$_GET['id']."")->fetch_assoc();
					?>
					<form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Payment Gateway Name</label>
                                            <input type="text" class="form-control " disabled placeholder="Enter Payment Gateway Name" value="<?php echo $data['title'];?>" name="cname" required="">
                                        </div>
										
										<div class="form-group">
                                            <label>Payment Gateway SubTitle</label>
                                            <input type="text" class="form-control" placeholder="Enter Payment Gateway SubTitle" value="<?php echo $data['subtitle'];?>" name="ptitle" required="">
                                        </div>
										
                                        <div class="form-group">
                                            <label>Payment Gateway Image</label>
                                            <input type="file" class="form-control" name="cat_img">
											<img src="<?php echo $data['img']?>" width="100px"/>
                                        </div>
										<div class="form-group">
                                            <label>Payment Gateway Attributes<?php if($_GET['id'] == 3){echo ' ( 1 for Live Paypal And 0 for Sendbox Paypal. )';}?></label>
                                            <input type="text" class="form-control" id="p_attr" value="<?php echo $data['attributes'];?>" name="p_attr"  required="">
                                        </div>
										
										 <div class="form-group">
                                            <label>Payment Gateway Status</label>
                                            <select name="status" class="form-control">
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update Payment Gateway</button>
                                    </div>
                                </form>
					<?php 
				}
				else 
				{
					?>
					<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
	<script src="custom/payerror.js"></script>
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