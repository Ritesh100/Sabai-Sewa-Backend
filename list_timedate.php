<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
   <?php 
if(isset($_GET['did']))
{
	$id = $_GET['did'];

$table="time_date";
$where = "where id=".$id."";
$h = new Common();
	$check = $h->Deletedata($where,$table);

if($check == 1)
{
$msg = 'Timeslot & Date Delete Successfully!!';
echo "<meta http-equiv='refresh' content='3'>";
}
}
?>     

        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
				<div class="col-md-9 col-lg-9 col-xs-12">
                    <h1>Timeslot & Date List</h1>
					</div>
					<div class="col-md-3 col-lg-3 col-xs-12">
					<a href="add_timedate.php" class="btn btn-primary" > Add New Timeslot & Date </a>
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
												
                                                <th>Current Or Next Date?</th>
                                                
                                                <th>Added Days</th>
                                                <th>Selected Sloats</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											 $stmt = $mysqli->query("SELECT * FROM `time_date`");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                
												<td> <?php $gcat = $mysqli->query("select * from category where id=".$row['cid']."")->fetch_assoc(); echo $gcat['cat_name']; ?></td>
												
                                               <?php if($row['dstatus'] == 1) { ?>
                                                <td><div class="badge badge-success">Current</div></td>
												<?php } else { ?>
												<td><div class="badge badge-success">Next</div></td>
												<?php } ?>
                                                
                                                <td>
                                                    <?php echo $row['days']; ?>
                                                </td>
												<td>
                                                    <?php echo $row['tslot']; ?>
                                                </td>
												
                                                <td style="min-width:100px;"><a href="add_timedate.php?id=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
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