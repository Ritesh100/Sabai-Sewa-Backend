<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
   <?php 
if(isset($_GET['did']))
{
	$id = $_GET['did'];

$table="category";
$where = "where id=".$id."";
$h = new Common();
	$check = $h->Deletedata($where,$table);

if($check == 1)
{
$msg = 'Category Delete Successfully!!'; 
echo "<meta http-equiv='refresh' content='3'>";
}
}
?>     

        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
				<div class="col-md-9 col-lg-9 col-xs-12">
                    <h1>Category List</h1>
					</div>
					<div class="col-md-3 col-lg-3 col-xs-12">
					<a href="add_category.php" class="btn btn-primary" > Add New Category </a>
					</div>
                </div>
				<div class="card">
				<?php 
if($msg != '')
{
?>
<div class="alert alert-danger alert-dismissible show fade">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert"><span>×</span></button>
                                            <?php echo $msg;?>
                                        </div>
                                    </div>
					<?php } ?>
                               <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped v_center" id="table-1">
                                            <thead>
                                                <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Category Name</th>
												<th>Category Subtitle</th>
                                                <th>Category Image</th>
                                                <th>Category Video</th>
                                                
                                                <th>Status</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											 $stmt = $mysqli->query("SELECT * FROM `category`");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td> <?php echo $row['cat_name']; ?></td>
												<td> <?php echo $row['cat_subtitle']; ?></td>
                                                <td class="align-middle">
                                                   <img src="<?php echo $row['cat_img']; ?>" width="60" height="60"/>
                                                </td>
                                                
                                                <td class="align-middle">
                                                  <video width="120" height="140" controls>
  <source src="<?php echo $row['cat_video']; ?>" type="video/mp4">
  
  Your browser does not support the video tag.
</video>
                                                </td>
												
												<?php if($row['cat_status'] == 1) { ?>
                                                <td><div class="badge badge-success">Publish</div></td>
												<?php } else { ?>
												<td><div class="badge badge-danger">Unpublish</div></td>
												<?php } ?>
                                                <td><a href="add_category.php?id=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
												<a href="?did=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
												</td>
                                                </tr>
<?php } ?>                                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
            </div>
					
                
            </section>
        </div>
        
       
    </div>
</div>

<?php require 'include/footer.php';?>


</body>


</html>