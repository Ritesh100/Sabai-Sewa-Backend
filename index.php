<?php 
require 'include/dbconfig.php';
require 'include/Common.php';

if(isset($_SESSION['username']))
{
	?>
	<script>
	window.location.href="dashboard.php";
	</script>
	<?php 
}
else 
{
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<title>Login Page - Sabae Sewa</title>
<link rel="shortcut icon"  href="<?php echo $set['logo'];?>">
<!-- General CSS Files -->
<link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="css/font.css"/>
<link rel="stylesheet" href="assets/css/style.min.css">
<link rel="stylesheet" href="assets/css/components.min.css">
<link rel="stylesheet" href="css/index.css">
</head>

<body class="layout-4">

<div id="app">
	
<div class='login align'>
  <?php 
	if(isset($_POST['sub_login']))
	{
	    
		$username = $_POST['username'];
		$password = $_POST['password'];
	
	 $h = new Common();
	 
	 $count = $h->Login($username,$password,'admin');
 if($count != 0)
 {
	 $_SESSION['username'] = $username;
	 
	 $msg = 'Login Successfully!!!';
	 header("refresh:3;url=dashboard.php");
 }
 else 
 {
	 $msgno = 'Email or username and Password Wrong!!!';
 }
	 
	 	
	}
	?>
	
  <div class='login_fields'>
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
  	 <form method="POST" action="#">
  	 	<div class='login_title text-center'>
  	<img src="assets/img/logo_transparent.png" style="width:120px"  class=" mb-3"><br>
    <h6>Login to your Dashboard</h6>
  </div>
    <div class='login_fields__user'>
     
      <input placeholder='Username' type='text' name="username" tabindex="1" required autofocus>
       
      </input>
    </div>
    <div class='login_fields__password'>
      
      <input placeholder='Password' type='password' name="password" tabindex="2" required>
      
    </div>
	 
    <div class='login_fields__submit'>
      <input type='submit' value='Log In' class="button" name="sub_login">
      
    </div>
</form>
  </div>
  
</div>

	
</div>

<!-- General JS Scripts -->
<?php require 'include/footer.php';?>

<!-- use Common; -->


</body>


</html>