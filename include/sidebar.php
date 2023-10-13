
<link rel="stylesheet" href="assets/css/changes.css">

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="dashboard.php"><?php  echo $set['d_title']; ?></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="dashboard.php">Sabae Sewa</a>
        </div>


        <ul class="sidebar-menu">
            <li class="active">
                <a href="dashboard.php" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-header">City Section</li>


            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-map-pin"></i> <span>City </span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="add_city.php">Add City</a></li>
                    <li><a class="nav-link" href="list_city.php">List City</a></li>


                </ul>
            </li>

            <li class="menu-header">General Category Section</li>


            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list-ol"></i> <span>Main Category </span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="add_category.php">Add Main Category</a></li>
                    <li><a class="nav-link" href="list_category.php">List Main Category</a></li>


                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list-ol"></i> <span>Sub Category </span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="add_subcategory.php">Add Sub Category</a></li>
                    <li><a class="nav-link" href="list_subcategory.php">List Sub Category</a></li>


                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list-ol"></i> <span>Child Category </span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="add_child.php">Add Child Category</a></li>
                    <li><a class="nav-link" href="list_child.php">List Child Category</a></li>


                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-plus"></i> <span>Add On </span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="add_addon.php">Add Add On</a></li>
                    <li><a class="nav-link" href="list_addon.php">List Add On</a></li>


                </ul>
            </li>

            <li class="menu-header">TimeSloat & Date Section</li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-clock"></i> <span>TimeSlot & Date </span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="add_timedate.php">Add TimeSlot & Date </a></li>
                    <li><a class="nav-link" href="list_timedate.php">List TimeSlot & Date </a></li>


                </ul>
            </li>





            <li class="menu-header">Banner Section</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-image"></i> <span>Banner </span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="add_banner.php">Add Banner</a></li>
                    <li><a class="nav-link" href="list_banner.php">List Banner</a></li>


                </ul>
            </li>



            <li class="menu-header">Partner Section</li>
            <li><a class="nav-link" href="partner.php"><i class="fas fa-users"></i> <span>Partner List</span></a></li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-tools"></i><span>Partner Service</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="add_pservice.php">Add Partner Service</a></li>
                    <li><a class="nav-link" href="list_pservice.php">List Partner Service</a></li>


                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-credit-card"></i> <span>Credit Package</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="credit_manage.php">Add Credit Package</a></li>
                    <li><a class="nav-link" href="list_credit.php">List Credit Package</a></li>


                </ul>
            </li>

            <li class="menu-header">Dynamic Section</li>


            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th-large"></i> <span>Section </span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="add_section.php">Add Section</a></li>
                    <li><a class="nav-link" href="list_section.php">List Section</a></li>


                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-tools"></i><span>Section Offer Service</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="add_service.php">Add Service</a></li>
                    <li><a class="nav-link" href="list_service.php">List Service</a></li>


                </ul>
            </li>



            <li class="menu-header">Payment Gateway Section</li>
            <li><a class="nav-link" href="list_payment_list.php"><i class="fas fa-money-bill-alt"></i> <span>List Payment Gateway</span></a></li>

            <li class="menu-header">Payout Section</li>
            <li><a class="nav-link" href="list_payout.php"><i class="fas fa-money-bill-wave"></i> <span>List Partner Payout</span></a></li>


            <li class="menu-header">Notification Section</li>
            <li><a class="nav-link" href="push_notification.php"><i class="fas fa-bell"></i> <span>Send Notification</span></a></li>


            <li class="menu-header">Order Section</li>
            <li><a class="nav-link" href="pending.php"><i class="fas fa-shopping-cart"></i> <span>Pending Order</span></a></li>
            <li><a class="nav-link" href="complete.php"><i class="fas fa-check"></i> <span>Complete Order</span></a></li>
            <li><a class="nav-link" href="cancle_order_list.php"><i class="fas fa-times"></i> <span>Cancelled Order</span></a></li>


            <li class="menu-header">Customer Section</li>
            <li><a class="nav-link" href="customer.php"><i class="fas fa-users"></i> <span>Customers</span></a></li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-comment"></i> <span>Testimonial </span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="add_testimonial.php">Add Testimonial</a></li>
                    <li><a class="nav-link" href="list_testimonial.php">List Testimonial</a></li>


                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-flag"></i> <span>Country Code </span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="add_ccode.php">Add Country Code</a></li>
                    <li><a class="nav-link" href="list_ccode.php">List Country Code</a></li>


                </ul>
            </li>

            <li class="menu-header">Profile/App Section</li>
            <li><a class="nav-link" href="profile.php"><i class="fas fa-user"></i> <span>Update Profile</span></a></li>
            <li><a class="nav-link" href="setting.php"><i class="fas fa-sun"></i> <span>Setting</span></a></li>
        </ul>

    </aside>
</div>

