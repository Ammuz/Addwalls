<div class="header">
    <div class="header-left">
        <a href="" class="logo">

            <span><i class="fa fa-user"></i> ADMIN</span>
        </a>
    </div>
    <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
    <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
    <ul class="nav user-menu float-right">
        <!-- <li class="nav-item dropdown d-none d-sm-block">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right">3</span></a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span>Notifications</span>
                        </div>
                        <div class="drop-scroll">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">
												<img alt="John Doe" src="<?php echo base_url('/img/user.jpg')?>" class="img-fluid">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
												<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">V</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
												<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">L</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
												<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">G</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
												<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">V</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
												<p class="noti-time"><span class="notification-time">2 days ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="activities.html">View all Notifications</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fa fa-comment-o"></i> <span class="badge badge-pill bg-danger float-right">8</span></a>
                </li> -->
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                <span class="user-img">
                    <img class="rounded-circle" src="<?php echo base_url('/img/user.jpg')?>" width="24" alt="Admin">
                    <span class="status online"></span>
                </span>
                <span> <?= session('username') ?>
            </a>
            <div class="dropdown-menu">
                <!-- <a class="dropdown-item" href="profile.html">My Profile</a> -->
                <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                <a class="dropdown-item" href="<?= site_url('admin/logout') ?>">Logout</a>
            </div>
        </li>
    </ul>
    <div class="dropdown mobile-user-menu float-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <!-- <a class="dropdown-item" href="profile.html">My Profile</a> -->
            <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
            <a class="dropdown-item" href="<?= site_url('admin/logout') ?>">Logout</a>
        </div>
    </div>
</div>
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
             
                <!-- <li class="submenu">
							<a href="#"><i class="fa fa-book"></i> <span> Attributes </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="<?=route_to('clinic.Departments');?>"> Staff Type </a></li>
								<li><a href="salary-view.html"> Payslip </a></li>
							</ul>
						</li> -->
                <li>
                    <!-- <a href="<?=route_to('clinic.Departments');?>"><i class="fa fa-hospital-o"></i> <span>Departments</span></a>
                        </li>
                        <li class="submenu">
							<a href="#"><i class="fa fa-user"></i> <span> Employees </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="<?=route_to('clinic.Employees');?>">Employees List</a></li>
								 <li><a href="leaves.html">Leaves</a></li>
								<li><a href="holidays.html">Holidays</a></li> -->
                    <!-- <li><a href="attendance.html">Attendance</a></li>
							</ul>
						</li>
                        -->
                        <li class="">
                            <a href="<?=site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
               
                <!-- <li>
                    <a href="<?=site_url('Addwalls/admins');?>"><i class="fa fa-user"></i> <span>Admin</span></a>
                </li> -->
                <li>
                    <a href="<?=site_url('Addwalls/manager');?>"><i class="fa fa-user"></i> <span>Manager</span></a>
                </li>
              
                <!-- <li>
                          <a href="<?=site_url('Addwalls/Agents');?>"><i class="fa fa-user"></i> <span>Agents</span></a>
                       </li> -->
                <!--                 <li class="submenu">-->
                <!--<a href="#"><i class="fa fa-wheelchair"></i> <span> Patients </span> <span class="menu-arrow"></span></a>-->
                <!--<ul style="display: none;">-->
                <!--	<li><a href="<?=site_url('clinic/Patients');?>">Patients List</a></li>-->
                <!--	<li><a href="<?=site_url('clinic/NewPatients');?>">New Patients</a></li> -->
                <!-- <li><a href="holidays.html">Holidays</a></li>
								<li><a href="attendance.html">Attendance</a></li> -->
                <!-- </ul>
						</li>
                        <li class="submenu">
							<a href="#"><i class="fa fa-calendar"></i> <span> Appointments </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="<?=site_url('clinic/Appointments');?>">New Appointments </a></li>
								<li><a href="<?=site_url('clinic/AllAppointments');?>">All Appointments</a></li>
								<li><a href="holidays.html">Holidays</a></li>
								<li><a href="attendance.html">Attendance</a></li> -->
                <!-- </ul>
						</li>
                        
                        <li>
                            <a href="<?=site_url('clinic/Schedule');?>"><i class="fa fa-calendar-check-o"></i> <span>Doctor Schedule</span></a>
                        </li>  -->


                <!-- <li class="submenu">
							<a href="#"><i class="fa fa-money"></i> <span> Accounts </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="invoices.html">Invoices</a></li>
								<li><a href="payments.html">Payments</a></li>
								<li><a href="expenses.html">Expenses</a></li>
								<li><a href="taxes.html">Taxes</a></li>
								<li><a href="provident-fund.html">Provident Fund</a></li>
							</ul>
						</li> -->
                <!-- <li class="submenu">
							<a href="#"><i class="fa fa-book"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="salary.html"> Employee Salary </a></li>
								<li><a href="salary-view.html"> Payslip </a></li>
							</ul>
						</li> -->
                <!-- <li class="submenu">
							<a href="#"><i class="fa fa-flag-o"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="expense-reports.html"> Expense Report </a></li>
								<li><a href="invoice-reports.html"> Invoice Report </a></li>
							</ul>
						</li>  -->
            </ul>
        </div>
    </div>
</div>