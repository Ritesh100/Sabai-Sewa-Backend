<?php 
require 'include/dbconfig.php';
require 'include/Common.php';


?>
<!DOCTYPE html>
<html lang="en">


<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<title>Login Page - <?php echo $set['d_title'];?></title>
<link rel="shortcut icon"  href="<?php echo $set['logo'];?>">
<!-- General CSS Files -->
<link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">
<link rel="stylesheet" href="assets/modules/izitoast/css/iziToast.min.css">
<!-- CSS Libraries -->
<link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">

<!-- Template CSS -->
<link rel="stylesheet" href="assets/css/style.min.css">
<link rel="stylesheet" href="assets/css/components.min.css">
<link rel="stylesheet" href="css/index.css">
</head>

<body class="layout-4">

<div id="app">
	<section id="getmsg" style="text-align:center;"></section>
<div class='login'>

  
  <div class='login_fields'>
  
  	 <form method="POST" action="#">
      <div class='login_title text-center'>
    <img src="<?php echo $set['logo']; ?>" style="width:120px"  class="mb-3"><br>
    <h6>Activate  Product</h6>
  </div>
    <div class='login_fields__user'>
     
      <input placeholder='Enter Envato Purchase Code' type='text' name="code" id="inputCode" tabindex="1" required autofocus>
        
      </input>
    </div>
    <div class='login_fields__submit'>
      <input type='button' value='Activate' class="button" id="sub_login" name="sub_login">
      
    </div>
</form>
  </div>
  
</div>

	
</div>

<!-- General JS Scripts -->
<?php require 'include/footer.php';?>

</body>


</html>