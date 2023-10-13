<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
<?php 
if(isset($_GET['did']))
{
	$id = $_GET['did'];

$table="banner";
$where = "where id=".$id."";
$h = new Common();
	$check = $h->Deletedata($where,$table);

if($check == 1)
{
$msg = 'Banner Delete Successfully!!'; 
echo "<meta http-equiv='refresh' content='3'>";
}
}
?>
        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                   <div class="col-md-9 col-lg-9 col-xs-12">
                    <h1>Banner List</h1>
					</div>
					<div class="col-md-3 col-lg-3 col-xs-12">
					<a href="add_banner.php" class="btn btn-primary" > Add New Banner </a>
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
                                               
                                                <th>Banner Image</th>
                                                <th>Main Category</th>
												<th>Sub Category</th>
												<th>Child Category</th>
                                                
                                                <th>Status</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											 $stmt = $mysqli->query("SELECT * FROM `banner`");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                               
                                                <td class="align-middle">
                                                   <img src="<?php echo $row['img']; ?>" width="250" height="100"/>
                                                </td>
                                                <td>
											  <?php 
											  $bdata = $mysqli->query("select * from category where id=".$row['mid']."")->fetch_assoc();
											  echo $bdata['cat_name'];
											  ?>
											  </td>
											  
											  <td>
											  <?php 
											  $bdata = $mysqli->query("select * from g_subcategory where id=".$row['sid']."")->fetch_assoc();
											  echo $bdata['title'];
											  ?>
											  </td>
											  
											  <td>
											  <?php 
											  $bdata = $mysqli->query("select * from tbl_child where id=".$row['cid']."")->fetch_assoc();
											  echo $bdata['title'];
											  ?>
											  </td>
                                               
												<?php if($row['status'] == 1) { ?>
                                                <td><div class="badge badge-success">Publish</div></td>
												<?php } else { ?>
												<td><div class="badge badge-danger">Unpublish</div></td>
												<?php } ?>
                                                <td><a href="add_banner.php?id=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
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