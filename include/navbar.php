<?php 

require 'dbconfig.php';
require 'include/Common.php';
if(isset($_SESSION['username']))
{
	
}
else 
{
	?>
	<script>
	window.location.href="/";
	</script>
	<?php 
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<title>Dashboard | <?php echo $set['d_s_title'];?></title>
<link rel="shortcut icon"  href="<?php echo $set['logo'];?>">
<!-- General CSS Files -->
<link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/common/tag.css">
<link rel="stylesheet" href="assets/modules/summernote/summernote-bs4.css">

<link rel="stylesheet" href="css/font.css"/>
<link rel="stylesheet" href="assets/modules/datatables/datatables.min.css">
<link rel="stylesheet" href="css/choose.css">
<link rel="stylesheet" href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<!-- CSS Libraries -->
<link rel="stylesheet" href="assets/modules/summernote/summernote-bs4.css">

<!-- Template CSS -->
<link rel="stylesheet" href="assets/css/style.min.css">
<link rel="stylesheet" href="assets/css/components.min.css">
</head>

<body class="layout-4">
<!-- Page Loader -->


<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
    
        <!-- Start app top navbar -->
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    
                </ul>
                
            </form>
            <ul class="navbar-nav navbar-right">
                
                <li class="dropdown">

                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <figure class="avatar mr-2 avatar-sm bg-success text-white" data-initial="<?php echo substr(strtoupper($set['d_s_title']), 0, 3) ; ?>"></figure>
					<?php
if($_SESSION['ltype'] == 'Vendor')
{
	?>
	<div class="d-sm-none d-lg-inline-block">Hi, <?php echo $sdata['name'];?></div></a>
	<?php 
}
else if($_SESSION['ltype'] == 'D_boy')
{
	?>
	<div class="d-sm-none d-lg-inline-block">Hi, <?php echo $ddata['name'];?></div></a>
	<?php 
}
else 
{					?>
                    <div class="d-sm-none d-lg-inline-block">Hi, Admin</div></a>
<?php } ?>
                    <div class="dropdown-menu dropdown-menu-right">
<?php
if($_SESSION['ltype'] == 'Vendor')
{
}
else 
{
	?>
                      
<?php } ?>
                        <a href="logout.php" class="dropdown-item has-icon text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </nav>