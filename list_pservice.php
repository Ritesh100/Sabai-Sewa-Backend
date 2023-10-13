<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
<?php 
if(isset($_GET['did']))
{
	$id = $_GET['did'];

$table="tbl_partner_service";
$where = "where id=".$id."";
$h = new Common();
	$check = $h->Deletedata($where,$table);
	
	

if($check == 1)
{
$msg = 'Partner Service Delete Successfully!!'; 
echo "<meta http-equiv='refresh' content='3'>";
}
}
?>
        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <div class="col-md-9 col-lg-9 col-xs-12">
                    <h1>Partner Service List</h1>
					</div>
					<div class="col-md-3 col-lg-3 col-xs-12">
					<a href="add_pservice.php" class="btn btn-primary" > Add New Partner Service </a>
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
												 
                                                <th>Title</th>
                                                <th>Image</th>
                                                 <th>Video</th>
                                                
												<th>Main Category</th>
												<th>Sub Category</th>
												<th>Child Category</th>
												<th>Discount</th>
												<th>Price</th>
												<th>Service Time Taken?(Mintues)</th>
												<th>Max Quantity?</th>
												<th>Which Thing Show?</th>
                                                <th>Status</th>
												
												
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											$store_id = $sdata['id'];
											 $stmt = $mysqli->query("SELECT * FROM `tbl_partner_service` order by id desc");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
												<td>
                                                    <?php echo $row['title']; ?>
                                                </td>
                                                
                                                <td class="align-middle" style="display:flex;">
                                                   <?php 
									$im_list = explode(',',$row['img']);
									foreach($im_list as $ilist)
									{
										?>
										<img src="<?php echo $ilist;?>" width="60px" height="60px"/>
										<?php 
									}
									?>
                                                </td>
                                                
												<td class="align-middle">
                                                   
									
										<video width="120" height="140" controls>
  <source src="<?php echo $row['video']?>" type="video/mp4">
  
</video>
										
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
											  <td>
                                                    <?php echo $row['discount'].' %'; ?>
                                                </td>
												<td>
                                                    <?php echo $row['price'].' '.$set['currency']; ?>
                                                </td>
												<td>
                                                    <?php echo $row['ttken'].' '.'Mintues'; ?>
                                                </td>
												<td>
                                                    <?php echo $row['mqty'].' Qty'; ?>
                                                </td>
												
												
												
												<?php if($row['s_show'] == 1) { ?>
                                                <td><div class="badge badge-success">Video</div></td>
												<?php } else { ?>
												<td><div class="badge badge-success">Images</div></td>
												<?php } ?>
												
												<?php if($row['status'] == 1) { ?>
                                                <td><div class="badge badge-success">Publish</div></td>
												<?php } else { ?>
												<td><div class="badge badge-danger">Unpublish</div></td>
												<?php } ?>
												
												
											  
                                                <td style="min-width: 87px;"><a href="add_pservice.php?id=<?php echo $row['id']; ?>" class="btn btn-info"> <i class="fas fa-edit"></i></a>
												<a href="?did=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i> </a>
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