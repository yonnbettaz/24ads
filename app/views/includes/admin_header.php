<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$title?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/themes/logo.png')?>">	
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url('assets/admin/css/bootstrap.min.css')?>">	
	<!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?=base_url('assets/admin/css/font-awesome.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/css/themify-icons.css')?>">
	<!-- Feathericon CSS -->
    <link rel="stylesheet" href="<?=base_url('assets/admin/css/feathericon.min.css')?>">	
	<link rel="stylesheet" href="<?=base_url('assets/admin/plugins/morris/morris.css')?>">	
	<!-- Main CSS -->
	<link rel="stylesheet" href="<?=base_url('assets/css/dimension.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/admin/css/style.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/admin/css/admin.css')?>">
    <!-- Datatables CSS -->
	<link rel="stylesheet" href="<?=base_url('assets/admin/plugins/datatables/datatables.min.css')?>">
	<!-- jQuery -->
    <script src="<?=base_url('assets/admin/js/jquery-3.2.1.min.js')?>"></script>
	
	<!-- Bootstrap Core JS -->
    <script src="<?=base_url('assets/admin/js/popper.min.js')?>"></script>
    <script src="<?=base_url('assets/admin/js/bootstrap.min.js')?>"></script>
    
	<!--[if lt IE 9]>
		<script src="<?=base_url('assets/admin/js/html5shiv.min.js')?>"></script>
		<script src="<?=base_url('assets/admin/js/respond.min.js')?>"></script>
	<![endif]-->
</head>
<body>
	<div class="main-wrapper">
		
		<!-- Header -->
        <div class="header">
		
			<!-- Logo -->
            <div class="header-left">
                <a href="<?=base_url('admin')?>" class="logo">
					<img src="<?=base_url('assets/themes/logo.png')?>" alt="Logo">
				</a>
				<a href="<?=base_url('admin')?>" class="logo logo-small">
					<img src="<?=base_url('assets/themes/logo.png')?>" alt="Logo" width="30" height="30">
				</a>
            </div>
			<!-- /Logo -->
			
			<a href="javascript:void(0);" id="toggle_btn">
				<i class="fe fe-text-align-left"></i>
			</a>
			
			<div class="top-nav-search">
				<form action="">
					<input type="text" class="form-control" placeholder="Search here">
					<button class="btn" type="submit"><i class="fa fa-search"></i></button>
				</form>
			</div>
			
			<!-- Mobile Menu Toggle -->
			<a class="mobile_btn" id="mobile_btn">
				<i class="fa fa-bars"></i>
			</a>
			<!-- /Mobile Menu Toggle -->
			
			<!-- Header Right Menu -->
			<ul class="nav user-menu">

				<!-- Notifications -->
				<li class="nav-item dropdown noti-dropdown">
					<a href="javascript:void(0);" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<i class="fe fe-bell"></i> <span class="badge badge-pill" id="ads_note_counter1"></span>
					</a>
					<div class="dropdown-menu notifications">
						<div class="topnav-dropdown-header">
							<span class="notification-title">Notifications</span>
						</div>
						<div class="noti-content" id="ads_notification_area">
							<ul class="notification-list">
								<li class="notification-message">
									<a href="<?=base_url('admin/ads/pending_ads')?>">
										<div class="media">
											<span class="avatar avatar-sm">
												<img class="avatar-img rounded-circle" alt="User Image" src="<?=site_url('assets/themes/icon-03.png')?>">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">There is a pending ads</p>
												<p class="noti-time"><span class="notification-time" id="ads_note_counter2"></span></p>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer">
							<a href="<?=base_url('admin/ads/pending_ads')?>">View all Notifications</a>
						</div>
					</div>
				</li>
				<!-- /Notifications -->
				
				<!-- User Menu -->
				<li class="nav-item dropdown has-arrow">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img"><img class="rounded-circle" src="<?=base_url('media/admin_avatar/'.$this->session->userdata('user_avatar'))?>" width="31" alt=""></span>
					</a>
					<div class="dropdown-menu">
						<div class="user-header">
							<div class="avatar avatar-sm">
								<img src="<?=base_url('media/admin_avatar/'.$this->session->userdata('user_avatar'))?>" alt="User Image" class="avatar-img rounded-circle">
							</div>
							<div class="user-text">
								<h6><?php echo htmlspecialchars($this->session->userdata('user_full_name'), ENT_QUOTES, 'UTF-8'); ?></h6>
								<p class="text-muted mb-0">Admin</p>
							</div>
						</div>
						<a class="dropdown-item" href="<?=base_url('admin/users/profile')?>">Profile</a>
						<a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#changepassword">Change Password</a>
						<a class="dropdown-item" href="<?=base_url('admin/logout')?>">Logout</a>
					</div>
				</li>
				<!-- /User Menu -->
				
			</ul>
			<!-- /Header Right Menu -->
			
        </div>
		<!-- /Header -->
		
		<!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul>
						<li class="menu-title"> 
							<span>Main</span>
						</li>
						<li class="<?=($this->uri->segment(1)=='admin' && ($this->uri->segment(2)=='' || $this->uri->segment(2)=='index')) ? 'active' : ''?>">
							<a href="<?=base_url('admin')?>"><i class="fe fe-home"></i> <span>Dashboard</span></a>
						</li>
						<li class="submenu <?=($this->uri->segment(2)=='ads' || $this->uri->segment(1)=='admin' && in_array($this->uri->segment(2), ['pending_ads','active_ads','denied_ads','closed_ads','all_ads','ads_details'])) ? 'active' : ''?>">
							<a href="#"><i class="fe fe-document"></i> <span> Advertisements</span> <span class="badge badge-warning m-r-10" id="ads_note_counter"></span> <span class="menu-arrow"></span></a>
							<ul style="display: <?=($this->uri->segment(2)=='ads' || in_array($this->uri->segment(2), ['pending_ads','active_ads','denied_ads','closed_ads','all_ads','ads_details'])) ? 'block' : 'none'?>;">
								<li><a href="<?=base_url('admin/ads/all_ads')?>"><i class="fa fa-list mr-1"></i> All Ads</a></li>
								<li><a href="<?=base_url('admin/ads/pending_ads')?>"><i class="fa fa-clock-o text-warning mr-1"></i> Pending Approval</a></li>
								<li><a href="<?=base_url('admin/ads/active_ads')?>"><i class="fa fa-check-circle text-success mr-1"></i> Active Ads</a></li>
								<li><a href="<?=base_url('admin/ads/denied_ads')?>"><i class="fa fa-times-circle text-danger mr-1"></i> Rejected Ads</a></li>
								<li><a href="<?=base_url('admin/ads/closed_ads')?>"><i class="fa fa-ban text-secondary mr-1"></i> Closed Ads</a></li>
								<li><a href="<?=base_url('admin/ads/promo')?>"><i class="fa fa-star text-info mr-1"></i> Promo Banners</a></li>
							</ul>
						</li>
						<li class="<?=($this->uri->segment(2)=='ads' && $this->uri->segment(3)=='approval_history') ? 'active' : ''?>">
							<a href="<?=base_url('admin/ads/approval_history')?>"><i class="fe fe-activity"></i> <span>Approval History</span></a>
						</li>
						<li class="submenu <?=($this->uri->segment(2)=='users') ? 'active' : ''?>">
							<a href="#"><i class="fe fe-user"></i> <span> Users</span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="<?=base_url('admin/users/system_users')?>">System Users</a></li>
								<li><a href="<?=base_url('admin/users/add_user')?>">Add User</a></li>
								<li><a href="<?=base_url('admin/users/roles')?>">User Roles & Permissions</a></li>
							</ul>
						</li>
						<li class="submenu">
							<a href="#"><i class="fe fe-users"></i> <span> Business Accounts</span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="<?=base_url('admin/business_records')?>">Business Records</a></li>
								<li><a href="<?=base_url('admin/business_accounts')?>">Business Accounts</a></li>
								<li><a href="<?=base_url('admin/budget_history')?>">Budget History</a></li>
							</ul>
						</li>
						<li class="submenu">
							<a href="#"><i class="fe fe-users"></i> <span> Personal Accounts </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="<?=base_url('admin/personal_accounts')?>"> Personal Accounts </a></li>
								<li><a href="<?=base_url('admin/personal_records')?>"> Personal Records </a></li>
								<li><a href="<?=base_url('admin/transaction_balance')?>"> Transaction Balance</a></li>
								<li><a href="<?=base_url('admin/transaction_history')?>"> Transaction History</a></li>
								<li><a href="<?=base_url('admin/personal_withdraw')?>"> Withdraw Requests </a></li>
							</ul>
						</li>
						<li class="submenu">
							<a href="#"><i class="fe fe-book"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="<?=base_url('admin/reports/ads_report')?>"> Ads Report </a></li>
								<li><a href="<?=base_url('admin/reports/cash_flow_report')?>"> Cash Flow </a></li>
								<li><a href="<?=base_url('admin/reports/business_account_report')?>"> Business Ac. Report </a></li>
								<li><a href="<?=base_url('admin/reports/personal_account_report')?>"> Personal Ac. Report </a></li>
							</ul>
						</li>
						<li class="menu-title"> 
							<span>System</span>
						</li>
						<li class="submenu">
							<a href="javascript:void(0);"><i class="fe fe-wrench"></i> <span>Settings</span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="<?=base_url('admin/payment_providers')?>"> <span>Payment Providers</span></a></li>
								<li><a href="<?=base_url('admin/settings')?>"> <span>System Settings</span></a></li>
							</ul>
						</li>
						<li class="<?=($this->uri->segment(2)=='users' && $this->uri->segment(3)=='profile') ? 'active' : ''?>">
							<a href="<?=base_url('admin/users/profile')?>"><i class="fe fe-info"></i> <span>Profile</span></a>
						</li>
						<li>
							<a href="javascript:void(0);" data-toggle="modal" data-target="#changepassword"><i class="fe fe-key"></i> <span>Change Password</span></a>
						</li>
						<li>
							<a href="<?=base_url('admin/logout')?>"><i class="fe fe-logout"></i> <span>Logout</span></a>
						</li>
					</ul>
				</div>
            </div>
        </div>
		<!-- /Sidebar -->
		
		<!-- Page Wrapper -->
        <div class="page-wrapper">
		
            <div class="content container-fluid">
				
				<?php if(isset($page_header)){ ?>
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title"><?=ucwords($page_header)?></h3>
							<?php if(isset($page_title)){ ?>
							<ul class="breadcrumb">
								<li class="breadcrumb-item active"><?=ucwords($page_title)?></li>
							</ul>
							<?php } ?>
						</div>
					</div>
				</div>
				<?php } ?>
</body>
</html>