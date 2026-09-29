<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>24ads - Login</title>		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/themes/logo.png')?>">
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?=base_url('assets/admin/css/bootstrap.min.css')?>">		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?=base_url('assets/admin/css/font-awesome.min.css')?>">		
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?=base_url('assets/admin/css/style.css')?>">		
        <link rel="stylesheet" href="<?=base_url('assets/admin/css/admin.css')?>">		
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper login-body">
            <div class="login-wrapper">
            	<div class="container">
                	<div class="loginbox">
                    	<div class="login-left">
							<img class="img-fluid" src="<?=base_url('assets/themes/logo_white.png')?>" alt="Logo">
                        </div>
                        <div class="login-right">
							<div class="login-right-wrap">
								<h1>Login</h1>
								<p class="account-subtitle">24ads Dashboard</p>
								<form amethod="post" id="login-form">
									<div class="form-group">
										<input class="form-control" type="text" name="username" placeholder="Enter your username">
									</div>
									<div class="form-group">
										<input class="form-control" type="password" name="password" placeholder="************" id="passwordField">
									</div>
									<div class="form-group">									
					                    <a class="btn btn-primary btn-block turnOnLoginProgress" onclick="loginPopup();">Login</a>
					                    <a class="btn btn-primary btn-block progressBarLoginBtn"><i class="fa fa-spinner fa-spin"></i> Processing...</a>
									</div>
								</form>
                    			<div class="row"><div class="col-md-12" id="resultMsgLogin"></div></div>
								<div class="text-center forgotpass"><a href="javascript:void();" onclick="alert('Contac top admin');">Forgot Password?</a></div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="<?=base_url('assets/admin/js/jquery-3.2.1.min.js')?>"></script>
		<!-- Bootstrap Core JS -->
        <script src="<?=base_url('assets/admin/js/popper.min.js')?>"></script>
        <script src="<?=base_url('assets/admin/js/bootstrap.min.js')?>"></script>
		<!-- Custom JS -->
		<script src="<?=base_url('assets/admin/js/script.js')?>"></script>
    </body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
        
        $("#passwordField").keyup(function(event){
            if(event.keyCode == 13){
                var mValue=document.getElementById("passwordField").value;
                if(mValue!=""){
                    loginPopup();
                }
            }
        });

    });

	function loginPopup(){
        $('.turnOnLoginProgress').css('display','none');
        $('.progressBarLoginBtn').css('display','inline-block');
        $.ajax({
            url:'<?= base_url() ?>admin/users/user_login',
            type:"POST",
            data:$('#login-form').serialize(),
            success: function(data){
                if(data.trim()=='Success'){
                    var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button> Success </div>'; 
                    $('#resultMsgLogin').html(output);
                    document.getElementById("login-form").reset();
                    window.location='<?=base_url('admin')?>';
                }else{
                    $('#resultMsgLogin').html(data);
                }
                $('.turnOnLoginProgress').css('display','inline-block');
                $('.progressBarLoginBtn').css('display','none');
            },
            error: function(xhr, status, error) {
                $('#resultMsgLogin').html(error);                
                $('.turnOnLoginProgress').css('display','inline-block');
                $('.progressBarLoginBtn').css('display','none');
                return false;
            }
        });
    }
</script>