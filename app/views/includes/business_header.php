<?php
$current_page = isset($active_menu) && $active_menu != '' ? $active_menu : $this->uri->segment(2);
if(empty($current_page)){ 
    $current_page = ($this->uri->segment(1) == 'users' && $this->uri->segment(2) == 'business_profile') ? 'business_profile' : 'index'; 
}
$business_logo = $this->session->userdata('logo');
$logo_url = (!empty($business_logo) && file_exists(FCPATH.'media/logo/'.$business_logo)) 
    ? base_url('media/logo/'.$business_logo) 
    : base_url('assets/img/user-default.png');
$biz_name = $this->session->userdata('business_name') ?: $this->session->userdata('user_full_name');
?>

<div class="row">
	<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
		
		<!-- Business Profile Sidebar -->
		<div class="profile-sidebar modern-sidebar-card shadow-sm mb-4">
			<div class="widget-profile pro-widget-content">
				<div class="profile-info-widget">
					<a href="<?=base_url('business')?>" class="booking-doc-img profile-avatar-wrap">
						<img src="<?=$logo_url?>" alt="<?=htmlspecialchars($biz_name ?? 'Business')?>" class="img-fluid rounded-circle shadow-sm" style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #ffffff; box-shadow: 0 4px 14px rgba(0,0,0,0.12);">
						<span class="online-indicator"></span>
					</a>
					<div class="profile-det-info mt-2">
						<h3 class="user-display-name mb-1 font-weight-700"><?php echo htmlspecialchars($biz_name ?? 'Business Account'); ?></h3>							
						<div class="patient-details">
							<span class="badge badge-pill badge-warning-light font-weight-600 px-3 py-1" style="color: #d97706; background: rgba(245,158,11,0.15);">
								<i class="fas fa-briefcase mr-1"></i> Business Account
							</span>
						</div>
					</div>
				</div>
			</div>
			
			<div class="dashboard-widget">
				<nav class="dashboard-menu modern-dash-menu">
					<ul>
						<li class="<?=$current_page=='index' ? 'active' : ''?>">
							<a href="<?=base_url('business')?>">
								<i class="fas fa-tachometer-alt"></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li class="<?=$current_page=='ads' ? 'active' : ''?>">
							<a href="<?=base_url('business/ads')?>">
								<i class="fas fa-bullhorn"></i> 
								<span>Ad Campaigns</span>
							</a>
						</li>
						<li class="<?=$current_page=='new_ads' ? 'active' : ''?>">
							<a href="<?=base_url('business/new_ads')?>">
								<i class="fas fa-plus-circle"></i> 
								<span>Create New Ad</span>
							</a>
						</li>
						<li class="<?=$current_page=='transactions' ? 'active' : ''?>">
							<a href="<?=base_url('business/transactions')?>">
								<i class="fas fa-wallet"></i>
								<span>Transactions</span>
							</a>
						</li>
						<li class="<?=$current_page=='business_profile' ? 'active' : ''?>">
							<a href="<?=base_url('users/business_profile')?>">
								<i class="fas fa-building"></i>
								<span>Business Profile</span>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);" data-toggle="modal" data-target="#changepassword">
								<i class="fas fa-lock"></i>
								<span>Change Password</span>
							</a>
						</li>
						<li class="menu-logout">
							<a href="<?=base_url('logout')?>" class="text-danger">
								<i class="fas fa-sign-out-alt text-danger"></i>
								<span>Logout</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- /Business Profile Sidebar -->
		
	</div>
	<div class="col-md-7 col-lg-8 col-xl-9">