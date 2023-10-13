<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
	<?php
		
		if(isset($_POST['icat']))
		{
			
			
			$mtitle = $mysqli->real_escape_string($_POST['mtitle']);
			$sdisc = $_POST['sdisc'];
			$stime = $_POST['stime'];
			$mqty = $_POST['mqty'];
			$status = $_POST['status'];
			$thing = $_POST['thing'];
			$price = $_POST['price'];
			$cat = $_POST['cat'];
			$subcat = $_POST['subcat'];
			$child = $_POST['child'];
			$mdesc = $mysqli->real_escape_string($_POST['sdescription']);
			
			$rdate = date("Y-m-d H:i:s");
				$target_dir = "assets/product/";
$temps = explode(".", $_FILES["cat_video"]["name"]);
$vname = uniqid() . '.' . end($temps);				
	$target_files = $target_dir . basename($vname);

			
 if(count($_FILES['cat_img']['name']) > 5)
		{
			$msgno = "Please Select Max 5 Images Allowed!!";
echo "<meta http-equiv='refresh' content='3'>";			
		}
		else 
		{
		
		$arr = array();
							foreach($_FILES['cat_img']['tmp_name'] as $key => $tmp_name ){
	$file_name = uniqid().$_FILES['cat_img']['name'][$key];
	
	$file_size =$_FILES['cat_img']['size'][$key];
	$file_tmp =$_FILES['cat_img']['tmp_name'][$key];
	
	$file_type = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
	if($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg"
&& $file_type != "gif" ) {
 $related = '';
}
else 
{
	
	move_uploaded_file($file_tmp,"assets/product/".$file_name);
	$arr[] = "assets/product/".$file_name;
}
							}
							$related = implode(',',$arr);
							move_uploaded_file($_FILES["cat_video"]["tmp_name"], $target_files);
				

if($subcat == '')
{
	$subcat = 0;
}
  $table="tbl_partner_service";
  $field_values=array("img","title","status","mid","sid","sdesc","cid","s_show","video","ttken","mqty","price","discount");
  $data_values=array("$related","$mtitle","$status","$cat","$subcat","$mdesc","$child","$thing","$target_files","$stime","$mqty","$price","$sdisc");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
$msg = 'Partner Service Insert Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}
		}
		}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			
			
			$servicedata = $mysqli->query("select * from tbl_partner_service where id=".$_GET['id']."")->fetch_assoc();
			$mtitle = $mysqli->real_escape_string($_POST['mtitle']);
			$sdisc = $_POST['sdisc'];
			$stime = $_POST['stime'];
			$mqty = $_POST['mqty'];
			$status = $_POST['status'];
			$thing = $_POST['thing'];
			$price = $_POST['price'];
			$cat = $_POST['cat'];
			$subcat = $_POST['subcat'];
			$child = $_POST['child'];
			$mdesc = $mysqli->real_escape_string($_POST['sdescription']);
			
			$rdate = date("Y-m-d H:i:s");
				$target_dir = "assets/product/";
$temps = explode(".", $_FILES["cat_video"]["name"]);
$vname = uniqid() . '.' . end($temps);				
	$target_files = $target_dir . basename($vname);
			
			
	if(empty($_FILES['cat_img']['name'][0]))
							{
								$related = $servicedata['img'];
							}
							else 
							{
							$arr = array();
							foreach($_FILES['cat_img']['tmp_name'] as $key => $tmp_name ){
	$file_name = uniqid().$_FILES['cat_img']['name'][$key];
	
	$file_size =$_FILES['cat_img']['size'][$key];
	$file_tmp =$_FILES['cat_img']['tmp_name'][$key];
	
	$file_type = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
	if($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg"
&& $file_type != "gif" ) {
 $related = '';
}
else 
{
	
	move_uploaded_file($file_tmp,"assets/product/".$file_name);
	$arr[] = "assets/product/".$file_name;
}
							}
							$related = implode(',',$arr);	
							}
		if($_FILES["cat_video"]["name"] == '')
		{
			$target_files = $servicedata['video'];
		}
else 
{
	
			
	move_uploaded_file($_FILES["cat_video"]["tmp_name"], $target_files);
				
}	
				
$table="tbl_partner_service";
 $field=array('img'=>$related,'title'=>$mtitle,'status'=>$status,'mid'=>$cat,'sid'=>$subcat,'sdesc'=>$mdesc,'cid'=>$child,'s_show'=>$thing,'video'=>$target_files,'ttken'=>$stime,'mqty'=>$mqty,'price'=>$price,'discount'=>$sdisc);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
$msg = 'Partner Service Update Successfully!!';
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
					<h1>Edit Partner Service</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add Partner Service</h1>
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
					<?php } else if($msgno != '') {?>
					<div class="alert alert-danger alert-dismissible show fade">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert"><span>×</span></button>
                                            <?php echo $msgno;?>
                                        </div>
                                    </div>
					<?php }else {}?>
					
				<?php 
				if(isset($_GET['id']))
				{
					$sels = $mysqli->query("select * from tbl_partner_service where id=".$_GET['id']."")->fetch_assoc();
					?>
					
                                <form method="post" enctype="multipart/form-data" onsubmit="return postForm()">
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">
<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Service Images(Max 5 Images)</label>
									<input type="file" name="cat_img[]" class="form-control-file" id="projectinput8"  multiple>
									<br>
									<?php 
									$im_list = explode(',',$sels['img']);
									foreach($im_list as $ilist)
									{
										?>
										
										<img src="<?php echo $ilist;?>" width="100px" height="100px"/>
										<?php 
									}
									?>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Service Video</label>
									<input type="file" name="cat_video" class="form-control-file" id="projectinput8" >
									<br>
											<video width="120" height="140" controls>
  <source src="<?php echo $sels['video']?>" type="video/mp4">
  
</video>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Service Title</label>
									<input type="text" name="mtitle" placeholder="Enter Service Title" class="form-control" value="<?php echo $sels['title'];?>" id="projectinput8" required>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Service Discount</label>
									<input type="number" step="any" name="sdisc" placeholder="Enter Service Discount" value="<?php echo $sels['discount'];?>" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Service Time Taken</label>
									<input type="number" step="any" name="stime" placeholder="Enter Service Time Taken(Mintues)" value="<?php echo $sels['ttken'];?>" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Max Quantity</label>
									<input type="number" step="any" name="mqty" placeholder="Enter Service Time Taken(Mintues)" value="<?php echo $sels['mqty'];?>" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
								
                             
							
							 

  	

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Service Status </label>
									<select name="status" class="form-control" required>
									<option value="">Select Service Status</option>
									<option value="1" <?php if($sels['status'] == 1){echo 'selected';}?>>Publish</option>
									<option value="0" <?php if($sels['status'] == 0){echo 'selected';}?>>Unpublish</option>
									
									</select>
								</div>
							</div>

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Which Thing Show ?</label>
									<select name="thing" class="form-control" required>
									<option value="">Select Thing</option>
									<option value="1" <?php if($sels['s_show'] == 1){echo 'selected';}?>>Video</option>
									<option value="0" <?php if($sels['s_show'] == 0){echo 'selected';}?> >Images</option>
									
									</select>
								</div>
							</div>							
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Price</label>
									<input type="number" step="any" name="price" value="<?php echo $sels['price'];?>" placeholder="Enter Service Price" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Service Category</label>
									<select name="cat" class="form-control catp" required>
									<option value="">Select Service Category</option>
									<?php 
									$web = $mysqli->query("select * from category where cat_status=1");
									while($row = $web->fetch_assoc())
									{
										?>
										<option value="<?php echo $row['id'];?>" <?php if($row['id'] == $sels['mid']){echo 'selected';}?> ><?php echo $row['cat_name'];?></option>
										<?php 
									}
									?>
									</select>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group sub">
									<label>Service Sub Category</label>
									<select name="subcat" class="form-control subcats">
									<option value="">Select Service Sub Category</option>
									<?php 
									$web = $mysqli->query("select * from g_subcategory where cid=".$sels['mid']." and status=1");
									while($row = $web->fetch_assoc())
									{
										?>
										<option value="<?php echo $row['id'];?>" <?php if($row['id'] == $sels['sid']){echo 'selected';}?> ><?php echo $row['title'];?></option>
										<?php 
									}
									?>
									</select>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group child">
									<label>Service Child Category</label>
									<select name="child" class="form-control" required>
									<option value="">Select Service Child Category</option>
									<?php 
									if($sels['sid'] == 0)
									{
										$web = $mysqli->query("select * from tbl_child where cid=".$sels['mid']."  and status=1");
									}
									else 
									{
									$web = $mysqli->query("select * from tbl_child where cid=".$sels['mid']." and sid=".$sels['sid']." and status=1");
									}
									while($row = $web->fetch_assoc())
									{
										?>
										<option value="<?php echo $row['id'];?>" <?php if($row['id'] == $sels['cid']){echo 'selected';}?> ><?php echo $row['title'];?></option>
										<?php 
									}
									?>
									</select>
								</div>
								</div>
								
								
								

											
											
							
							

<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Service Description </label>
									<textarea class="form-control" rows="5" id="mdesc" name="sdescription" style="resize: none;"><?php echo $sels['sdesc'];?></textarea>
								</div>
							</div>							
								
							</div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update Partner Service</button>
                                    </div>
                                </form>
								
					<?php 
				}
				else 
				{
					?>
					
					
			
			
			
			
	
			
			
                                <form method="post" enctype="multipart/form-data" onsubmit="return postForm()">
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">
<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Service Images(Max 5 Images)</label>
									<input type="file" name="cat_img[]" class="form-control-file" id="projectinput8" required multiple>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Service Video</label>
									<input type="file" name="cat_video" class="form-control-file" id="projectinput8" required>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Service Title</label>
									<input type="text" name="mtitle" placeholder="Enter Service Title" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Service Discount</label>
									<input type="number" step="any" name="sdisc" placeholder="Enter Service Discount" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Service Time Taken</label>
									<input type="number" step="any" name="stime" placeholder="Enter Service Time Taken(Mintues)" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Max Quantity</label>
									<input type="number" step="any" name="mqty" placeholder="Enter Service Time Taken(Mintues)" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
								
                             
							
							 

  	

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Service Status </label>
									<select name="status" class="form-control" required>
									<option value="">Select Service Status</option>
									<option value="1">Publish</option>
									<option value="0">Unpublish</option>
									
									</select>
								</div>
							</div>

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Which Thing Show ?</label>
									<select name="thing" class="form-control" required>
									<option value="">Select Thing</option>
									<option value="1">Video</option>
									<option value="0">Images</option>
									
									</select>
								</div>
							</div>							
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Price</label>
									<input type="number" step="any" name="price" placeholder="Enter Service Price" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Service Category</label>
									<select name="cat" class="form-control catp" required>
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
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group sub">
									<label>Service Sub Category</label>
									<select name="subcat" class="form-control subcats">
									<option value="">Select Service Sub Category</option>
									
									</select>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group child">
									<label>Service Child Category</label>
									<select name="child" class="form-control" required>
									<option value="">Select Service Child Category</option>
									
									</select>
								</div>
								</div>
								
								
								

											
											
							
							

<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Service Description </label>
									<textarea class="form-control" rows="5" id="mdesc" name="sdescription" style="resize: none;"></textarea>
								</div>
							</div>							
								
							</div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add Partner Service</button>
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