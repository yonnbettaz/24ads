<?php
$current_page = isset($active_menu) && $active_menu != '' ? $active_menu : $this->uri->segment(2);
if(empty($current_page)){ $current_page = 'index'; }
$user_avatar = $this->session->userdata('user_avatar');
$avatar_url = (!empty($user_avatar) && file_exists(FCPATH.'media/avatar/'.$user_avatar)) 
    ? base_url('media/avatar/'.$user_avatar) 
    : base_url('assets/img/user-default.png');
$user_name = $this->session->userdata('user_full_name');
?>

<div class="row">
	<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
		
		<!-- Profile Sidebar -->
		<div class="profile-sidebar modern-sidebar-card shadow-sm mb-4">
			<div class="widget-profile pro-widget-content">
				<div class="profile-info-widget">
					<a href="<?=base_url('personal')?>" class="booking-doc-img profile-avatar-wrap">
						<img src="<?=$avatar_url?>" alt="<?=htmlspecialchars($user_name ?? 'User')?>" class="img-fluid rounded-circle shadow-sm" style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #ffffff; box-shadow: 0 4px 14px rgba(0,0,0,0.12);">
						<span class="online-indicator"></span>
					</a>
					<div class="profile-det-info mt-2">
						<h3 class="user-display-name mb-1 font-weight-700"><?php echo htmlspecialchars($user_name ?? 'User Account'); ?></h3>							
						<div class="patient-details">
							<span class="badge badge-pill badge-primary-light font-weight-600 px-3 py-1">
								<i class="fas fa-user-check mr-1 text-primary"></i> Personal Account
							</span>
						</div>
					</div>
				</div>
			</div>
			
			<div class="dashboard-widget">
				<nav class="dashboard-menu modern-dash-menu">
					<ul>
						<li class="<?=$current_page=='index' ? 'active' : ''?>">
							<a href="<?=base_url('personal')?>">
								<i class="fas fa-tachometer-alt"></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li class="<?=$current_page=='recent_clicked' ? 'active' : ''?>">
							<a href="<?=base_url('personal/recent_clicked')?>">
								<i class="fas fa-history"></i> 
								<span>Recent Clicked</span>
							</a>
						</li>
						<li class="<?=$current_page=='bonus' ? 'active' : ''?>">
							<a href="<?=base_url('personal/bonus')?>">
								<i class="fas fa-gift"></i> 
								<span>Bonuses</span>
							</a>
						</li>
						<li class="<?=$current_page=='withdraw_balance' ? 'active' : ''?>">
							<a href="<?=base_url('personal/withdraw_balance')?>">
								<i class="fas fa-wallet"></i>
								<span>Withdraw & Balance</span>
							</a>
						</li>
						<li class="<?=$current_page=='transaction_records' ? 'active' : ''?>">
							<a href="<?=base_url('personal/transaction_records')?>">
								<i class="fas fa-file-invoice-dollar"></i>
								<span>Transaction Records</span>
							</a>
						</li>
						<li class="<?=$current_page=='ads_history' ? 'active' : ''?>">
							<a href="<?=base_url('personal/ads_history')?>">
								<i class="fas fa-list-alt"></i> 
								<span>Ads History</span>
							</a>
						</li>
						<li class="<?=$current_page=='account_info' ? 'active' : ''?>">
							<a href="<?=base_url('personal/account_info')?>">
								<i class="fas fa-mobile-alt"></i>
								<span>Payout Account</span>
							</a>
						</li>
						<li class="<?=$current_page=='profile' ? 'active' : ''?>">
							<a href="<?=base_url('personal/profile')?>">
								<i class="fas fa-user-cog"></i>
								<span>Profile Settings</span>
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
		<!-- /Profile Sidebar -->
		
	</div>
	<div class="col-md-7 col-lg-8 col-xl-9">