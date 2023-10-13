<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
<?php 
if(isset($_GET['did']))
{
	$id = $_GET['did'];

$table="tbl_user";
$where = "where id=".$id."";
$h = new Common();
	$check = $h->Deletedata($where,$table);

if($check == 1)
{
$msg = 'Customer Delete Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}

}
?>

<?php 
		
		if(isset($_GET['status']))
		{
			
		$id = $_GET['id'];
$status = $_GET['status'];
 $table="tbl_user";
  $field = "status=".$status."";
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData_single($field,$table,$where);
if($check == 1)
{
$msg = 'Customer Status Update Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}

		}
		?>
		

        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Customer List</h1>
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
                               <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped v_center" id="table-1">
                                            <thead>
                                                <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                
                                                
                                                <th>Mobile</th>
												<th>Wallet</th>
												<th>Status</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											 $stmt = $mysqli->query("SELECT * FROM `tbl_user` order by id desc");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td> <?php echo $row['name']; ?></td>
                                                <td> <?php echo $row['email']; ?></td>
												<td> <?php echo $row['mobile']; ?></td>
                                                
                                               <td> <?php echo $row['wallet'].' '.$set['currency'] ; ?></td>
												
												
																								<?php if($row['status'] == 1) { ?>
                                                <td><a href="?id=<?php echo $row['id'];?>&status=0"><div class="badge badge-danger">Make Deactive</div></a></td>
												<?php } else { ?>
												<td><a href="?id=<?php echo $row['id'];?>&status=1"><div class="badge badge-success">Make Active</div></a></td>
												<?php } ?>
												<td>
												<a href="?did=<?php echo $row['id']; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete Customer" ><i class="fas fa-trash-alt"></i></a>
												<a href="addlist.php?uid=<?php echo $row['id']; ?>" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Show Address" ><i class="fas fa-map-marker-alt"></i></a>
												<a href="ureport.php?uid=<?php echo $row['id']; ?>" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Manage User Report" ><i class="fas fa-chart-bar"></i></a>
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