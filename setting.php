<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
  <?php 
		if(isset($_POST['usetting']))
		{
			$dname = $_POST['dname'];
			$dsname = $_POST['dsname'];
			$okey = $_POST['okey'];
			$ohash = $_POST['ohash'];
			$r_key = $_POST['r_key'];
			$r_hash = $_POST['r_hash'];
			$signupcredit = $_POST['signupcredit'];
			$refercredit = $_POST['refercredit'];
			$mlimit = $_POST['mlimit'];
			$asid = $_POST['asid'];
			$megic_Num = $_POST['megic_Num'];
			$token = $_POST['token'];
			$currency = $mysqli -> real_escape_string($_POST['currency']);
			$policy = $mysqli -> real_escape_string($_POST['policy']);
			$about = $mysqli -> real_escape_string($_POST['about']);
			$contact = $mysqli -> real_escape_string($_POST['contact']);
			$terms = $mysqli -> real_escape_string($_POST['terms']);
			$timezone = $mysqli -> real_escape_string($_POST['timezone']);
			
			$id = 1;
			if($_FILES["llogo"]["name"] == '')
			{
				$table="setting";
  $field = array('mlimit'=>$mlimit,'asid'=>$asid,'megic_Num'=>$megic_Num,'token'=>$token,'d_title'=>$dname,'d_s_title'=>$dsname,'one_key'=>$okey,'one_hash'=>$ohash,'r_key'=>$r_key,'r_hash'=>$r_hash,'currency'=>$currency,'policy'=>$policy,'about'=>$about,'contact'=>$contact,'terms'=>$terms,'timezone'=>$timezone,'refercredit'=>$refercredit,'signupcredit'=>$signupcredit);
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
$msg ='Setting Update Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}
			}
			else 
			{
				$target_dir = "assets/img/";
$target_file = $target_dir . basename($_FILES["llogo"]["name"]);
			
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
			
				move_uploaded_file($_FILES["llogo"]["tmp_name"], $target_file);
				$table="setting";
  $field = array('mlimit'=>$mlimit,'asid'=>$asid,'megic_Num'=>$megic_Num,'token'=>$token,'d_title'=>$dname,'d_s_title'=>$dsname,'one_key'=>$okey,'one_hash'=>$ohash,'r_key'=>$r_key,'r_hash'=>$r_hash,'s_key'=>$s_key,'s_hash'=>$s_hash,'currency'=>$currency,'logo'=>$target_file,'policy'=>$policy,'about'=>$about,'contact'=>$contact,'terms'=>$terms,'timezone'=>$timezone,'refercredit'=>$refercredit,'signupcredit'=>$signupcredit);
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  


if($check == 1)
{
$msg ='Setting Update Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}
			
			

		}
		}
		?>      

        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Setting</h1>
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
                                <form method="post" enctype="multipart/form-data" onsubmit="return postForm()">
                                    
									
                                    <div class="card-body">
									<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>DashBoard Name</label>
                                            <input type="text" class="form-control" name="dname" required="" value="<?php echo $set['d_title']; ?>">
                                        </div>
										</div>
										<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>DashBoard Short Name</label>
                                            <input type="text" class="form-control" name="dsname" value="<?php echo $set['d_s_title']; ?>" required="">
                                        </div>
										</div>
										<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>User App Onesignal App Id</label>
                                            <input type="text" class="form-control" name="okey" required value="<?php echo $set['one_key']; ?>">
                                        </div>
										</div>
										<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group ">
                                            <label>User Boy App Onesignal Rest Api Key</label>
                                            <input type="text" class="form-control" name="ohash" required value="<?php echo $set['one_hash']; ?>">
                                        </div>
										</div>
										<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Partner App Onesignal App Id</label>
                                            <input type="text" class="form-control" name="r_key" required value="<?php echo $set['r_key']; ?>">
                                        </div>
										</div>
										<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group ">
                                            <label>Partner App Onesignal Rest Api Key</label>
                                            <input type="text" class="form-control" name="r_hash" required value="<?php echo $set['r_hash']; ?>">
                                        </div>
										</div>
										
										<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
										<div class="form-group ">
                                            <label>Set Currency</label>
                                            <input type="text" class="form-control" name="currency" required value="<?php echo $set['currency']; ?>">
                                        </div>
										</div>
										<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
										<div class="form-group">
                                            <label>Website Logo/Favicon</label>
                                            <input type="file" class="form-control" name="llogo">
											<br>
											<img src="<?php echo $set['logo']; ?>" width="60" height="60"/>
                                        </div>
										</div>
										<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
										<?php 
								$tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
								$limit =  count($tzlist);
								?>
								<div class="form-group">
									<label for="cname">Select Timezone</label>
									<select name="timezone" class="form-control" required>
									<option value="">Select Timezone</option>
									<?php 
									for($k=0;$k<$limit;$k++)
									{
									?>
									<option <?php echo $tzlist[$k];?> <?php if($tzlist[$k] == $set['timezone']) {echo 'selected';}?>><?php echo $tzlist[$k];?></option>
									<?php } ?>
									</select>
								</div>
								</div>
								
								
								
								<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
										<div class="form-group">
                                            <label>Privacy Policy</label>
                                            <textarea class="form-control" id="policy" name="policy"><?php echo $set['policy'];?></textarea>
											
                                        </div>
										</div>
										
										<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
										<div class="form-group">
                                            <label>About Us</label>
                                            <textarea class="form-control" id="about" name="about"><?php echo $set['about'];?></textarea>
											
                                        </div>
										</div>
										
										<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
										<div class="form-group">
                                            <label>Contact Us</label>
                                            <textarea class="form-control" id="contact" name="contact"><?php echo $set['contact'];?></textarea>
											
                                        </div>
										</div>
										
										<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
										<div class="form-group">
                                            <label>Terms & Conditions</label>
                                            <textarea class="form-control" id="terms" name="terms"><?php echo $set['terms'];?></textarea>
											
                                        </div>
										</div>
										
										<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
										<div class="form-group">
                                            <label>Signup Credit</label>
                                            <input type="number" class="form-control" name="signupcredit" required value="<?php echo $set['signupcredit']; ?>">
											
                                        </div>
										</div>
										
										<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
										<div class="form-group">
                                            <label>Refer Credit</label>
                                           <input type="number" class="form-control" name="refercredit" required value="<?php echo $set['refercredit']; ?>">
											
                                        </div>
										</div>
										
										<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
										<div class="form-group">
                                            <label>Partner Withdraw Limit</label>
                                           <input type="number" class="form-control" name="mlimit" required value="<?php echo $set['mlimit']; ?>">
											
                                        </div>
										</div>
										
										<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
										<div class="form-group">
                                            <label>Twilio ACCOUNT SID</label>
                                            <input type="text" class="form-control" name="asid" required value="<?php echo $set['asid']; ?>">
											
                                        </div>
										</div>
										
										<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
										<div class="form-group">
                                            <label>Twilio AUTH TOKEN</label>
                                           <input type="text" class="form-control" name="token" required value="<?php echo $set['token']; ?>">
											
                                        </div>
										</div>
										
										<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
										<div class="form-group">
                                            <label>Twilio Number</label>
                                           <input type="text" class="form-control" name="megic_Num" required value="<?php echo $set['megic_Num']; ?>">
											
                                        </div>
										</div>
										
										
                                    </div>
									</div>
                                    <div class="card-footer text-left">
                                        <button name="usetting" class="btn btn-primary">Update Setting</button>
                                    </div>
                                </form>
                            </div>
            </div>
					
                
            </section>
        </div>
        
       
    </div>
</div>

<?php require 'include/footer.php';?>


</body>
</html>