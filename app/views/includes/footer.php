		<?php if(isset($page) && $page!='index'){ ?>
			</div>
		</div>
		<?php } else { ?>
		</div>
		<?php } ?>
		
		<footer class="footer footer-custom">
			<!-- Footer Top -->
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">						
							<!-- Footer Widget -->
							<div class="footer-widget footer-about">
								<div class="footer-logo mb-3">
									<img src="<?=base_url('assets/themes/logo_white.png')?>" alt="24ads Logo" style="max-height: 46px;">
								</div>
								<div class="footer-about-content">
									<p class="text-muted-light mb-3">24ads connects businesses with real customers across Tanzania. Read ads, test your knowledge, and earn cash daily with instant mobile wallet payouts.</p>
									<div class="social-icon">
										<ul>
											<li>
												<a href="#" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i> </a>
											</li>
											<li>
												<a href="#" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i> </a>
											</li>
											<li>
												<a href="#" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
											</li>
											<li>
												<a href="#" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<!-- /Footer Widget -->					
						</div>
						
						<div class="col-lg-2 col-md-6 col-6 mb-4 mb-lg-0">
							<div class="footer-widget footer-menu">
								<h2 class="footer-title">Quick Links</h2>
								<ul>
									<li><a href="<?=base_url();?>"><i class="fas fa-chevron-right mr-1"></i> Home</a></li>
									<li><a href="<?=base_url('how_to')?>"><i class="fas fa-chevron-right mr-1"></i> How It Works</a></li>
									<li><a href="<?=base_url('about')?>"><i class="fas fa-chevron-right mr-1"></i> About Us</a></li>
									<li><a href="<?=base_url('faq')?>"><i class="fas fa-chevron-right mr-1"></i> FAQs</a></li>
									<li><a href="<?=base_url('contact')?>"><i class="fas fa-chevron-right mr-1"></i> Contact Us</a></li>
								</ul>
							</div>
						</div>
						
						<div class="col-lg-3 col-md-6 col-6 mb-4 mb-lg-0">
							<div class="footer-widget footer-menu">
								<h2 class="footer-title">Earn & Advertise</h2>
								<ul>
									<li><a href="<?=base_url('register')?>"><i class="fas fa-chevron-right mr-1"></i> Personal Account</a></li>
									<li><a href="<?=base_url('register_business')?>"><i class="fas fa-chevron-right mr-1"></i> Business Account</a></li>
									<li><a href="<?=base_url('how_to#withdraw_cash')?>"><i class="fas fa-chevron-right mr-1"></i> Withdraw Cash</a></li>
									<li><a href="<?=base_url('how_to#advertise')?>"><i class="fas fa-chevron-right mr-1"></i> Advertise with Us</a></li>
									<li><a href="<?=base_url('policy')?>"><i class="fas fa-chevron-right mr-1"></i> Privacy Policy</a></li>
								</ul>
							</div>
						</div>
						
						<div class="col-lg-3 col-md-6">
							<div class="footer-widget footer-contact">
								<h2 class="footer-title">Contact & Support</h2>
								<div class="footer-contact-info">
									<div class="footer-address mb-2">
										<p><i class="fas fa-map-marker-alt mr-2 text-primary"></i> Dar es Salaam, Tanzania</p>
									</div>
									<p class="mb-2">
										<i class="fas fa-phone-alt mr-2 text-primary"></i> +255 752 369 5943
									</p>
									<p class="mb-3">
										<i class="fas fa-envelope mr-2 text-primary"></i> info@24ads.co
									</p>
									<div class="badge-payment-supported">
										<small class="text-muted-light d-block mb-1">Instant Payouts via:</small>
										<span class="badge badge-light mr-1">M-Pesa</span>
										<span class="badge badge-light mr-1">Tigo Pesa</span>
										<span class="badge badge-light mr-1">Airtel</span>
										<span class="badge badge-light">HaloPesa</span>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<!-- /Footer Top -->
			
			<!-- Footer Bottom -->
	        <div class="footer-bottom">
				<div class="container">
					<!-- Copyright -->
					<div class="copyright">
						<div class="row align-items-center">
							<div class="col-md-6 col-lg-6">
								<div class="copyright-text">
									<p class="mb-0">&copy; <?php echo date("Y"); ?> <strong class="text-white">24ads</strong>. All rights reserved.</p>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<!-- Copyright Menu -->
								<div class="copyright-menu text-md-right">
									<ul class="policy-menu">
										<li><a href="<?=base_url('terms_and_conditions')?>">Terms and Conditions</a></li>
										<li><a href="<?=base_url('policy')?>">Privacy Policy</a></li>
									</ul>
								</div>
								<!-- /Copyright Menu -->
							</div>
						</div>
					</div>
					<!-- /Copyright -->
				</div>
			</div>
			<!-- /Footer Bottom -->
		</footer>
		<!-- /Footer -->
	</div>

	<!-- Redesigned Login Modal -->
	<div class="modal fade modern-auth-modal" id="login_popup" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="modal-header border-0 pb-0 position-relative" style="background: linear-gradient(135deg, #091a2e 0%, #0f2942 100%); color: #ffffff; padding: 28px 28px 20px;">
                    <div class="w-100 text-center pr-3">
                    	<div class="mb-2">
                    		<img src="<?=base_url('assets/themes/logo_white.png')?>" alt="24ads Logo" style="max-height: 38px; width: auto;">
                    	</div>
                        <h4 class="modal-title font-weight-800 text-white" id="loginModalLabel" style="font-size: 20px; margin-bottom: 4px;">Welcome Back</h4>
                        <p class="text-white-50 mb-0" style="font-size: 13px;">Login to your 24ads account to earn or manage campaigns</p>
                    </div>
                    <button type="button" class="close text-white position-absolute" data-dismiss="modal" aria-label="Close" style="top: 16px; right: 18px; opacity: 0.8; font-size: 24px; text-shadow: none;">
                    	<span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body p-4" style="background: #ffffff;">
                    <form method="post" id="login-form">
                        <div class="form-group mb-3">
                            <label class="font-weight-700 text-dark mb-1" style="font-size: 13px;"><i class="fas fa-envelope text-primary mr-1"></i> Email or Username:</label>
                            <div class="input-group">
                            	<div class="input-group-prepend">
                            		<span class="input-group-text bg-light border-right-0" style="border-color: #e2e8f0; color: #64748b;"><i class="fas fa-user"></i></span>
                            	</div>
                            	<input type="email" name="username" value="" class="form-control border-left-0" placeholder="Enter your email address" required style="border-color: #e2e8f0; font-size: 14px; height: 44px;" />
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="font-weight-700 text-dark mb-1" style="font-size: 13px;"><i class="fas fa-lock text-primary mr-1"></i> Password:</label>
                            <div class="input-group">
                            	<div class="input-group-prepend">
                            		<span class="input-group-text bg-light border-right-0" style="border-color: #e2e8f0; color: #64748b;"><i class="fas fa-key"></i></span>
                            	</div>
                            	<input type="password" name="password" value="" id="passwordField" class="form-control border-left-0 border-right-0" placeholder="••••••••••••" required style="border-color: #e2e8f0; font-size: 14px; height: 44px;" />
                            	<div class="input-group-append">
                            		<span class="input-group-text bg-light border-left-0" id="togglePasswordBtn" style="border-color: #e2e8f0; cursor: pointer; color: #64748b;" onclick="togglePasswordVisibility();"><i class="fas fa-eye" id="togglePasswordIcon"></i></span>
                            	</div>
                            </div>
                        </div>

                        <div class="mt-4 mb-2">
                        	<button type="button" class="btn btn-primary btn-block btn-lg font-weight-700 turnOnLoginProgress" onclick="loginPopup();" style="height: 46px; border-radius: 50px; font-size: 15px; box-shadow: 0 4px 14px rgba(255, 107, 44, 0.35);">
                        		Login to Account <i class="fas fa-arrow-right ml-1"></i>
                        	</button>
                        	<button type="button" class="btn btn-primary btn-block btn-lg progressBarLoginBtn" disabled style="height: 46px; border-radius: 50px; font-size: 15px; display: none;">
                        		<i class="fa fa-spinner fa-spin mr-1"></i> Logging in...
                        	</button>
                        </div>
                    </form>
                    
                    <div class="mt-3" id="resultMsgLogin"></div>

                    <!-- Register callout -->
                    <div class="text-center mt-4 pt-3 border-top">
                        <p class="text-muted mb-2" style="font-size: 13px; font-weight: 600;">Don't have an account yet?</p>
                        <div class="d-flex justify-content-center" style="gap: 10px;">
                        	<a href="<?=base_url('register')?>" class="btn btn-sm btn-outline-success font-weight-700 px-3 py-2" style="border-radius: 50px; font-size: 12px;">
                        		<i class="fas fa-user mr-1"></i> Personal Account
                        	</a>
                        	<a href="<?=base_url('register_business')?>" class="btn btn-sm btn-outline-primary font-weight-700 px-3 py-2" style="border-radius: 50px; font-size: 12px;">
                        		<i class="fas fa-briefcase mr-1"></i> Business Account
                        	</a>
                        </div>
                    </div>
                    
                    <div class="text-center mt-3">
                    	<small class="text-muted" style="font-size: 11px;"><i class="fas fa-shield-alt text-success mr-1"></i> 256-Bit SSL Encrypted & Secure Access</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 480px;">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <!-- Header with gradient & key icon -->
                <div class="modal-header border-0 pb-3 pt-4 px-4 position-relative" style="background: linear-gradient(135deg, #0f2942 0%, #1e3a8a 100%); color: #ffffff;">
                    <div class="d-flex align-items-center">
                        <div class="mr-3" style="width: 48px; height: 48px; border-radius: 14px; background: rgba(255, 107, 44, 0.2); color: #ff6b2c; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                            <i class="fas fa-key"></i>
                        </div>
                        <div>
                            <h4 class="modal-title font-weight-800 text-white mb-0" style="font-size: 19px;">Change Password</h4>
                            <small class="text-white-50">Update your account credentials securely</small>
                        </div>
                    </div>
                    <button type="button" class="close text-white position-absolute" data-dismiss="modal" aria-label="Close" style="top: 18px; right: 20px; opacity: 0.8; font-size: 24px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-4 pt-4">
                    <form method="post" id="changepassword-form">
                        <!-- Current Password -->
                        <div class="form-group mb-3">
                            <label class="font-weight-700 text-dark mb-1" style="font-size: 13px;">
                                <i class="fas fa-lock text-muted mr-1"></i> Current Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0" style="border-color: #e2e8f0; color: #64748b;"><i class="fas fa-shield-alt"></i></span>
                                </div>
                                <input type="password" name="cpassword" id="cpasswordField" class="form-control border-left-0 border-right-0" placeholder="Enter current password" required style="border-color: #e2e8f0; font-size: 14px; height: 44px;" />
                                <div class="input-group-append">
                                    <span class="input-group-text bg-light border-left-0" style="border-color: #e2e8f0; cursor: pointer; color: #64748b;" onclick="toggleCPasswordVisibility('cpasswordField', 'toggleCPassIcon1');">
                                        <i class="fas fa-eye" id="toggleCPassIcon1"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="form-group mb-3">
                            <label class="font-weight-700 text-dark mb-1" style="font-size: 13px;">
                                <i class="fas fa-key text-primary mr-1"></i> New Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0" style="border-color: #e2e8f0; color: #64748b;"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" name="password" id="newpasswordField" class="form-control border-left-0 border-right-0" placeholder="Enter new strong password" required style="border-color: #e2e8f0; font-size: 14px; height: 44px;" />
                                <div class="input-group-append">
                                    <span class="input-group-text bg-light border-left-0" style="border-color: #e2e8f0; cursor: pointer; color: #64748b;" onclick="toggleCPasswordVisibility('newpasswordField', 'toggleCPassIcon2');">
                                        <i class="fas fa-eye" id="toggleCPassIcon2"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="form-group mb-3">
                            <label class="font-weight-700 text-dark mb-1" style="font-size: 13px;">
                                <i class="fas fa-check-double text-success mr-1"></i> Confirm New Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0" style="border-color: #e2e8f0; color: #64748b;"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" name="repassword" id="passwordChangeField" class="form-control border-left-0 border-right-0" placeholder="Re-enter new password" required style="border-color: #e2e8f0; font-size: 14px; height: 44px;" />
                                <div class="input-group-append">
                                    <span class="input-group-text bg-light border-left-0" style="border-color: #e2e8f0; cursor: pointer; color: #64748b;" onclick="toggleCPasswordVisibility('passwordChangeField', 'toggleCPassIcon3');">
                                        <i class="fas fa-eye" id="toggleCPassIcon3"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 mb-2">
                            <button type="button" class="btn btn-primary btn-block btn-lg font-weight-700 turnOnChangePassProgress" id="userChangePassword" style="height: 46px; border-radius: 50px; font-size: 15px; box-shadow: 0 4px 14px rgba(255, 107, 44, 0.35);">
                                <i class="fas fa-save mr-1"></i> Update Password
                            </button>
                            <button type="button" class="btn btn-primary btn-block btn-lg progressBarChangePassBtn" disabled style="height: 46px; border-radius: 50px; font-size: 15px; display: none;">
                                <i class="fa fa-spinner fa-spin mr-1"></i> Updating Password...
                            </button>
                        </div>
                    </form>
                    
                    <div class="mt-3" id="resultMsgChangePass"></div>

                    <div class="text-center mt-3 pt-2 border-top">
                        <small class="text-muted" style="font-size: 11px;">
                            <i class="fas fa-shield-alt text-success mr-1"></i> 256-Bit Encrypted & Secure Password Update
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Change Password Modal -->


    <!-- Datatables JS -->
    <script src="<?=base_url('assets/admin/plugins/datatables/datatables.min.js')?>"></script>
    
	<!-- Sticky Sidebar JS -->
    <script src="<?=base_url('assets/plugins/theia-sticky-sidebar/ResizeSensor.js')?>"></script>
    <script src="<?=base_url('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')?>"></script>

    <!-- Circle Progress JS -->
	<script src="<?=base_url('assets/js/circle-progress.min.js')?>"></script>
	<!-- Custom JS -->
	<script src="<?=base_url('assets/js/slick.js')?>"></script>
	<script src="<?=base_url('assets/js/script.js')?>"></script>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){

        $('#userChangePassword').click(function(){
            $('.turnOnChangePassProgress').css('display','none');
            $('.progressBarChangePassBtn').css('display','inline-block');
            $.ajax({
                url:'<?= base_url() ?>/Users/change_password',
                type:"POST",
                data:$('#changepassword-form').serialize(),
                success: function(data){
                    if(data.trim()=='Success'){
                        var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button> Success </div>'; 
                        $('#resultMsgChangePass').html(output);
                        document.getElementById("changepassword-form").reset();
                        window.location='';
                    }else{
                        $('#resultMsgChangePass').html(data);
                    }
                    $('.turnOnChangePassProgress').css('display','inline-block');
                    $('.progressBarChangePassBtn').css('display','none');
                },
	            error: function(xhr, status, error) {
	                $('#resultMsgChangePass').html(error);
	                $('.turnOnChangePassProgress').css('display','inline-block');
	                $('.progressBarChangePassBtn').css('display','none');
	                return false;
	            }
            });
        });
        
        $("#passwordChangeField").keyup(function(event){
            if(event.keyCode == 13){
                var mValue=document.getElementById("passwordChangeField").value;
                if(mValue!=""){
                    $("#userChangePassword").click();
                }
            }
        });
        
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
            url:'<?= base_url() ?>/Users/user_login',
            type:"POST",
            data:$('#login-form').serialize(),
            success: function(data){
                if(data.trim()=='Success'){
                    var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button> Success </div>'; 
                    $('#resultMsgLogin').html(output);
                    document.getElementById("login-form").reset();
                    window.location='<?=base_url('business')?>';
                }else if(data.trim()=='redirect_back'){
                    window.location='<?=$this->session->userdata('redirect_back')?>';
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

    function togglePasswordVisibility() {
        var input = document.getElementById("passwordField");
        var icon = document.getElementById("togglePasswordIcon");
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }

    function toggleCPasswordVisibility(fieldId, iconId) {
        var input = document.getElementById(fieldId);
        var icon = document.getElementById(iconId);
        if (input && icon) {
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    }
</script>