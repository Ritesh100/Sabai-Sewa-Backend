<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
<?php 
		if(isset($_POST['uprofile']))
		{
			$dname = $_POST['username'];
			$dsname = $_POST['password'];
			$id = 1;
			
$table="admin";
  $field = array('username'=>$dname,'password'=>$dsname);
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
$msg = 'Profile Update Successfully!!!'; 
echo "<meta http-equiv='refresh' content='3'>";
}
			
		}
		?>
        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Profile</h1>
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
				 $admindata = $mysqli->query("SELECT * FROM `admin`")->fetch_assoc();
				?>
                                <form method="post">
                                    
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="username" required="" value="<?php echo $admindata['username']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" class="form-control" name="password" value="<?php echo $admindata['password']; ?>" required="">
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="uprofile" class="btn btn-primary">Update Profile</button>
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