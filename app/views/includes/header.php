<?php
    $first_param=rtrim($this->uri->slash_segment(1), '/');
    $second_param=rtrim($this->uri->slash_segment(2), '/');
    // die($folder_name);
    // die(uri_string());
    if($first_param!='users' && uri_string()!='users/register' && uri_string()!='users/business_register' && uri_string()!='users' && uri_string()!='login' && uri_string()!='register_business'&& uri_string()!='register' && uri_string()!='account_activation' && uri_string()!='logout' && uri_string()!=''){
    // if(basename($_SERVER['PHP_SELF'])!='login' && basename($_SERVER['PHP_SELF'])!='register' && basename($_SERVER['PHP_SELF'])!='logout'){
        // $this->session->set_userdata('redirect_back', $_SERVER['HTTP_REFERER']);
        $this->session->set_userdata('redirect_back', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI']);
    }
    if(basename($_SERVER['PHP_SELF'])!=""){
        new_pageView(basename($_SERVER['PHP_SELF']));
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=$title?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="24ads is Tanzania's premier Pay-Per-View advertising and rewards platform. Earn real cash by viewing ads or reach thousands of potential customers.">
	<meta name="keywords" content="24ads, earn money online, tanzania advertising, mpesa rewards, tigo pesa ads, airtel money earn">
	
	<!-- Favicons -->
	<link href="<?=base_url('assets/themes/logo.png')?>" rel="icon">
	
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/css/themify-icons.css')?>">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome/css/fontawesome.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome/css/all.min.css')?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	
	<!-- Slick Slider CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
	
	<!-- Template CSS -->
	<link rel="stylesheet" href="<?=base_url('assets/css/dimension.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/css/style.css')?>">
    <!-- Datatables CSS -->
	<link rel="stylesheet" href="<?=base_url('assets/admin/plugins/datatables/datatables.min.css')?>">
	<!-- 24ads Master Custom Design System (Loaded Last for Proper Precedence) -->
	<link rel="stylesheet" href="<?=base_url('assets/css/24ads.css')?>">

	<!-- jQuery -->
	<script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
	<!-- Bootstrap Core JS -->
	<script src="<?=base_url('assets/js/popper.min.js')?>"></script>
	<script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
	<!-- Slick Slider JS -->
	<script src="<?=base_url('assets/js/slick.js')?>"></script>
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>
<body class="<?=(isset($page) && $page=='index') ? 'home-page' : 'inner-page'?>">
	<div class="main-wrapper">
		<header class="header header-custom">
			<div class="container">
				<nav class="navbar navbar-expand-lg header-nav">
					<div class="navbar-header">
						<a id="mobile_btn" href="javascript:void(0);" aria-label="Toggle navigation">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
						</a>
						<a href="<?=base_url();?>" class="navbar-brand logo">
							<img src="<?=base_url('assets/themes/logo.png')?>" class="img-fluid" alt="24ads Logo">
						</a>
					</div>
					<div class="main-menu-wrapper">
						<div class="menu-header">
							<a href="<?=base_url();?>" class="menu-logo">
								<img src="<?=base_url('assets/themes/logo.png')?>" class="img-fluid" alt="24ads Logo">
							</a>
							<a id="menu_close" class="menu-close" href="javascript:void(0);" aria-label="Close menu">
								<i class="fas fa-times"></i>
							</a>
						</div>
						<ul class="main-nav">
							<li class="<?=(!isset($page) || $page=='index') ? 'active' : ''?>"><a href="<?=base_url();?>">Home</a></li>
							<li class="<?=(isset($page) && $page=='contact') ? 'active' : ''?>"><a href="<?=base_url('contact');?>">Help & Support</a></li>
							<li class="has-submenu">
								<a href="javascript:void(0);">Register <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
									<?php if($this->session->userdata('account_type')!="business"){ ?>
									<li><a href="<?=base_url('register_business');?>">Business Account</a></li>
									<?php } ?>
									<?php if($this->session->userdata('account_type')!="personal"){ ?>
									<li><a href="<?=base_url('register');?>">Personal Account</a></li>
									<?php } ?>
								</ul>
							</li>
							<?php if(!isset($_SESSION['24ads_user_idetification']) || $_SESSION['24ads_user_idetification']==""){ ?>
							<li class="login-link header-login"><a href="javascript:void(0);" data-toggle="modal" data-target="#login_popup">Login</a></li>
							<?php } ?>
						</ul>
					</div>		 
					<ul class="nav header-navbar-rht">
						<li class="nav-item contact-item d-none d-xl-flex align-items-center">
							<div class="header-contact-img">
								<i class="fas fa-headset"></i>							
							</div>
							<div class="header-contact-detail">
								<p class="contact-header">24/7 Support</p>
								<p class="contact-info-header">info@24ads.co</p>
							</div>
						</li>
						
						<!-- User Menu -->
						<?php if(isset($_SESSION['24ads_user_idetification']) && $_SESSION['24ads_user_idetification']!=""){ ?>
						<li class="nav-item dropdown has-arrow logged-item">
							<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
								<span class="user-img">
									<img class="rounded-circle" src="<?=base_url('media/avatar/'.$this->session->userdata('user_avatar'))?>" width="36" height="36" alt="User Avatar">
								</span>
								<span class="user-name-header d-none d-md-inline-block ml-2 font-weight-600"><?php echo htmlspecialchars($this->session->userdata('user_full_name'), ENT_QUOTES, 'UTF-8'); ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
								<div class="user-header">
									<div class="avatar avatar-sm">
										<img src="<?=base_url('media/avatar/'.$this->session->userdata('user_avatar'))?>" alt="User Image" class="avatar-img rounded-circle">
									</div>
									<div class="user-text">
										<h6><?php echo htmlspecialchars($this->session->userdata('user_full_name'), ENT_QUOTES, 'UTF-8'); ?></h6>
										<p class="text-muted mb-0 badge badge-pill badge-primary-light"><?=ucwords($this->session->userdata('account_type'))?></p>
									</div>
								</div>
								<a class="dropdown-item" href="<?php echo base_url().$this->session->userdata('account_type'); ?>"><i class="fas fa-tachometer-alt mr-2 text-primary"></i> My Dashboard</a>
								<a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#changepassword"><i class="fas fa-key mr-2 text-warning"></i> Change Password</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item text-danger" href="<?=base_url('logout');?>"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
							</div>
						</li>
						<?php }else{ ?>
						<li class="nav-item"><a class="nav-link header-login" href="javascript:void(0);" data-toggle="modal" data-target="#login_popup">login </a></li>
						<?php } ?>
						<!-- /User Menu -->
					</ul>
				</nav>
			</div>
		</header>
		
		<?php if(isset($page) && $page!='index'){ ?>
		<div class="breadcrumb-bar search_bar">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-12 col-12">
						<form method="GET" action="<?=base_url('home/search_results')?>">
                            <div class="input-group">
							  <input type="text" name="keyword" value="<?php if(isset($keyword)){ echo htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8');} ?>" class="form-control" placeholder="Search by key, business or ad name" aria-label="Search ads">
							  <div class="input-group-append">
							    <button class="btn btn-primary" type="submit"><i class="fa fa-search mr-1"></i> Search</button>
							  </div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="container p-b-40">
		<?php } else { ?>
		<div class="content home-content p-0">
		<?php } ?>