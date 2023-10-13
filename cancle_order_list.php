<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Cancelled Order List</h1>
                </div>
				<div class="card">
				
                               <div class="card-body">
                                    <div class="table-responsive">
									
                                        <table class="table table-striped v_center" id="table-1">
                                            <thead>
                                                <tr>
                                                 <th>#</th>
												 <th>Order Id</th>
                                                 <th>Order Date </th>
                                                 <th>Current Status</th>
												  <th>Hire Type</th>
                                                 <th>Preview Data</th>
												 
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											
											 $stmt = $mysqli->query("SELECT * FROM `tbl_order` where o_status ='Cancelled'   order by id desc");

while($row = $stmt->fetch_assoc())
{
	
											?>
                                                <tr>
                                               <td class="beepred"></td>
												<td > <?php echo $row['id']; ?></td>
                                                
                                                
                                                
                                               <td> <?php 
											   $date=date_create($row['odate']);
echo date_format($date,"d-m-Y");
											   ?></td>
											   <td> <?php echo $row['o_status']; ?></td>
											    <td> <?php echo $row['htype']; ?></td>
												 <td> <button class="preview_d btn btn-primary" data-id="<?php echo $row['id'];?>" data-toggle="modal" data-target="#myModal">Preview</button></td>
                                                
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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    
    <div class="modal-content gray_bg_popup">
      <div class="modal-header">
        <h4>Order Preivew</h4>
        <button type="button" class="close popup_open" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body p_data">
      
      </div>
     
    </div>

  </div>
</div>
</html>