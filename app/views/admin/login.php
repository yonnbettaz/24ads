<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>24ads - Administrator Portal</title>		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/themes/logo.png')?>">
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?=base_url('assets/admin/css/bootstrap.min.css')?>">		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?=base_url('assets/admin/css/font-awesome.min.css')?>">		
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?=base_url('assets/admin/css/style.css')?>">		
        <link rel="stylesheet" href="<?=base_url('assets/admin/css/admin.css')?>">		
        <style>
            body {
                background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            }
            .admin-login-card {
                background: #ffffff;
                border-radius: 20px;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
                overflow: hidden;
                width: 100%;
                max-width: 440px;
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .admin-login-header {
                background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
                padding: 35px 30px;
                text-align: center;
                color: #ffffff;
            }
            .admin-login-body {
                padding: 35px 30px;
            }
            .form-control-custom {
                border-radius: 10px;
                height: 48px;
                padding-left: 45px;
                border: 1.5px solid #e2e8f0;
                font-size: 14px;
                transition: all 0.2s ease;
            }
            .form-control-custom:focus {
                border-color: #4f46e5;
                box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
            }
            .input-icon {
                position: absolute;
                left: 16px;
                top: 15px;
                color: #94a3b8;
                font-size: 16px;
                z-index: 5;
            }
            .btn-login {
                background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
                border: none;
                border-radius: 10px;
                height: 48px;
                font-weight: 700;
                font-size: 15px;
                letter-spacing: 0.3px;
                box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35);
                transition: transform 0.15s ease, box-shadow 0.15s ease;
            }
            .btn-login:hover {
                transform: translateY(-1px);
                box-shadow: 0 6px 16px rgba(79, 70, 229, 0.45);
            }
            .badge-security {
                display: inline-flex;
                align-items: center;
                background: rgba(255, 255, 255, 0.18);
                color: #ffffff;
                font-size: 11.5px;
                font-weight: 600;
                padding: 4px 12px;
                border-radius: 50px;
                margin-top: 10px;
                letter-spacing: 0.5px;
            }
        </style>
    </head>
    <body>
	
        <div class="container py-4">
            <div class="d-flex justify-content-center">
                <div class="admin-login-card">
                    <div class="admin-login-header">
                        <img src="<?=base_url('assets/themes/logo_white.png')?>" alt="24ads Logo" style="height: 38px; margin-bottom: 12px;">
                        <h4 class="font-weight-bold text-white mb-0" style="font-size: 20px;">Administrator Portal</h4>
                        <span class="badge-security">
                            <i class="fas fa-shield-alt mr-1"></i> Ad Approval & Management
                        </span>
                    </div>

                    <div class="admin-login-body">
                        <form method="post" id="login-form">
                            <!-- CSRF Security Token -->
                            <input type="hidden" name="<?=$this->admin_auth->get_csrf_token_name()?>" value="<?=$this->admin_auth->get_csrf_token()?>">

                            <div class="form-group position-relative mb-3">
                                <i class="fas fa-envelope input-icon"></i>
                                <input class="form-control form-control-custom" type="text" name="username" placeholder="Username or Email" required autofocus>
                            </div>

                            <div class="form-group position-relative mb-4">
                                <i class="fas fa-lock input-icon"></i>
                                <input class="form-control form-control-custom" type="password" name="password" placeholder="Password" id="passwordField" required>
                            </div>

                            <div class="form-group mb-3">									
                                <button type="button" class="btn btn-primary btn-block btn-login turnOnLoginProgress" onclick="loginPopup();">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Sign In to Dashboard
                                </button>
                                <button type="button" class="btn btn-primary btn-block btn-login progressBarLoginBtn" style="display: none;" disabled>
                                    <i class="fa fa-spinner fa-spin mr-2"></i> Verifying Credentials...
                                </button>
                            </div>
                        </form>

                        <div id="resultMsgLogin" class="mt-3"></div>

                        <div class="text-center mt-4 pt-3 border-top">
                            <a href="<?=base_url()?>" class="text-muted small font-weight-600">
                                <i class="fas fa-arrow-left mr-1"></i> Back to Public Website
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
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