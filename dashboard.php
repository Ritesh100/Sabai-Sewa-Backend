<?php
require 'include/navbar.php';
require 'include/sidebar.php';
?>
<!-- General CSS Files -->
<link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/common/tag.css">
<link rel="stylesheet" href="assets/modules/izitoast/css/iziToast.min.css">
<link rel="stylesheet" href="assets/modules/summernote/summernote-bs4.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>
<link rel="stylesheet" href="assets/modules/datatables/datatables.min.css">
<link rel="stylesheet" href="assets/modules/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<!-- CSS Libraries -->
<link rel="stylesheet" href="assets/modules/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="assets/modules/jqvmap/dist/jqvmap.min.css">
<link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons.min.css">
<link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons-wind.min.css">
<link rel="stylesheet" href="assets/modules/summernote/summernote-bs4.css">

<!-- Template CSS -->
<link rel="stylesheet" href="assets/css/style.min.css">
<link rel="stylesheet" href="assets/css/components.min.css">



<!-- Start app main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title"> Product Order Statistics

                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">
                                    <?php echo $mysqli->query("select * from tbl_order where o_status='Pending'")->num_rows; ?>
                                </div>
                                <div class="card-stats-item-label">Pending</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">
                                    <?php echo $mysqli->query("select * from tbl_order where o_status='Processing'")->num_rows; ?>
                                </div>
                                <div class="card-stats-item-label">Process</div>
                            </div>

                            <div class="card-stats-item">
                                <div class="card-stats-item-count">
                                    <?php echo $mysqli->query("select * from tbl_order where o_status='Cancelled'")->num_rows; ?>
                                </div>
                                <div class="card-stats-item-label">Cancel</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">
                                    <?php echo $mysqli->query("select * from tbl_order where o_status='Completed'")->num_rows; ?>
                                </div>
                                <div class="card-stats-item-label">Completed</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-shopping-bag heart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Orders</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $mysqli->query("select * from tbl_order")->num_rows; ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card card-statistic-2">

                    <div class="card-icon shadow-primary bg-primary" style="color:white;font-weight:bold;">
                        <?php echo $set['currency']; ?>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Sales</h4>
                        </div>
                        <div class="card-body heart">
                            <?php $sales = $mysqli->query("select sum(o_total) as full_total from tbl_order where o_status='Completed'")->fetch_assoc();
                            $sa = 0;
                            if ($sales['full_total'] == '') {
                                echo $sa . ' ' . $set['currency'];
                            } else {
                                echo $sales['full_total'] . ' ' . $set['currency'];
                            } ?>
                        </div>
                    </div>
                </div>

                <div class="card card-statistic-2">

                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-list-ol"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Main Category</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $mysqli->query("select * from category")->num_rows; ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card card-statistic-2">

                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-image"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Banner</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $mysqli->query("select * from banner")->num_rows; ?>
                        </div>
                    </div>
                </div>

                <div class="card card-statistic-2">

                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-money-bill-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Payment Gateway</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $mysqli->query("select * from tbl_payment_list")->num_rows; ?>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="row">




            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="list_subcategory.php">
                    <div class="card card-statistic-1">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-list-ol"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Sub Category</h4>
                            </div>
                            <div class="card-body">
                                <?php echo $mysqli->query("select * from g_subcategory")->num_rows; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="list_child.php">
                    <div class="card card-statistic-1">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-list-ol"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Child Category</h4>
                            </div>
                            <div class="card-body">
                                <?php echo $mysqli->query("select * from tbl_child")->num_rows; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="list_addon.php">
                    <div class="card card-statistic-1">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Add On</h4>
                            </div>
                            <div class="card-body">
                                <?php echo $mysqli->query("select * from tbl_addon")->num_rows; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="list_timedate.php">
                    <div class="card card-statistic-1">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Timeslot & Date </h4>
                            </div>
                            <div class="card-body">
                                <?php echo $mysqli->query("select * from time_date")->num_rows; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="partner.php">
                    <div class="card card-statistic-1">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Partner </h4>
                            </div>
                            <div class="card-body">
                                <?php echo $mysqli->query("select * from partner")->num_rows; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="list_pservice.php">
                    <div class="card card-statistic-1">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-tools"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Partner Service</h4>
                            </div>
                            <div class="card-body">
                                <?php echo $mysqli->query("select * from tbl_partner_service")->num_rows; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="list_credit.php">
                    <div class="card card-statistic-1">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Credit Package</h4>
                            </div>
                            <div class="card-body">
                                <?php echo $mysqli->query("select * from tbl_credit")->num_rows; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="list_section.php">
                    <div class="card card-statistic-1">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Section</h4>
                            </div>
                            <div class="card-body">
                                <?php echo $mysqli->query("select * from tbl_home")->num_rows; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="list_service.php">
                    <div class="card card-statistic-1">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-tools"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Section Service</h4>
                            </div>
                            <div class="card-body">
                                <?php echo $mysqli->query("select * from tbl_home_service")->num_rows; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="list_service.php">
                    <div class="card card-statistic-1">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-map-pin"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total City</h4>
                            </div>
                            <div class="card-body">
                                <?php echo $mysqli->query("select * from tbl_city")->num_rows; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>








            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="customer.php">
                    <div class="card card-statistic-1">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Customer</h4>
                            </div>
                            <div class="card-body">
                                <?php echo $mysqli->query("select * from tbl_user")->num_rows; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="list_testimonial.php">
                    <div class="card card-statistic-1">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-comment"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Testimonial</h4>
                            </div>
                            <div class="card-body">
                                <?php echo $mysqli->query("select * from tbl_happy_user")->num_rows; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>









        </div>



</div>

</div>
</section>
</div>


</div>
</div>

<?php require 'include/footer.php'; ?>


</body>


</html>