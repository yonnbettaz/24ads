<div class="row justify-content-center my-4">
	<div class="col-xl-11 col-lg-12">
		<!-- Register 2-Column Card -->
		<div class="card border-0 shadow-lg" style="border-radius: 24px; overflow: hidden; background: #ffffff;">
			<div class="row no-gutters">
				
				<!-- Left Column: Brand & Benefits -->
				<div class="col-lg-5 d-none d-lg-flex flex-column justify-content-between p-5" style="background: linear-gradient(135deg, #091a2e 0%, #0f2942 60%, #163859 100%); color: #ffffff; position: relative; overflow: hidden;">
					<!-- Decorative background glow -->
					<div style="position: absolute; top: -80px; right: -80px; width: 220px; height: 220px; background: radial-gradient(circle, rgba(255, 107, 44, 0.25) 0%, rgba(255, 107, 44, 0) 70%); border-radius: 50%; pointer-events: none;"></div>
					
					<div>
						<!-- Badge -->
						<div class="d-inline-flex align-items-center mb-3" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 50px; padding: 5px 14px; font-size: 12px; font-weight: 700; color: #ff944d;">
							<i class="fas fa-bullhorn mr-2"></i> Advertisers & Businesses
						</div>
						
						<h2 class="font-weight-800 text-white mb-3" style="font-size: 30px; line-height: 1.25; letter-spacing: -0.02em;">
							Grow Your Brand Across <span style="background: linear-gradient(135deg, #ff944d 0%, #ff5231 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Tanzania</span>
						</h2>
						
						<p class="text-white-50 mb-4" style="font-size: 14px; line-height: 1.6;">
							Launch high-conversion pay-per-view campaigns with quiz-verified engagement from real active users.
						</p>

						<!-- Benefits List -->
						<ul class="list-unstyled mb-4" style="font-size: 13px;">
							<li class="d-flex align-items-center mb-3 text-white">
								<span class="d-flex align-items-center justify-content-center mr-3" style="width: 28px; height: 28px; border-radius: 50%; background: rgba(16, 185, 129, 0.2); color: #10b981; flex-shrink: 0;">
									<i class="fas fa-check" style="font-size: 11px;"></i>
								</span>
								<span><strong>100% Real Human Views:</strong> No bots or fake impressions.</span>
							</li>
							<li class="d-flex align-items-center mb-3 text-white">
								<span class="d-flex align-items-center justify-content-center mr-3" style="width: 28px; height: 28px; border-radius: 50%; background: rgba(16, 185, 129, 0.2); color: #10b981; flex-shrink: 0;">
									<i class="fas fa-check" style="font-size: 11px;"></i>
								</span>
								<span><strong>Quiz-Verified Recall:</strong> Readers answer quiz questions.</span>
							</li>
							<li class="d-flex align-items-center mb-3 text-white">
								<span class="d-flex align-items-center justify-content-center mr-3" style="width: 28px; height: 28px; border-radius: 50%; background: rgba(16, 185, 129, 0.2); color: #10b981; flex-shrink: 0;">
									<i class="fas fa-check" style="font-size: 11px;"></i>
								</span>
								<span><strong>Flexible Budgeting:</strong> Pay only for verified clicks.</span>
							</li>
							<li class="d-flex align-items-center text-white">
								<span class="d-flex align-items-center justify-content-center mr-3" style="width: 28px; height: 28px; border-radius: 50%; background: rgba(16, 185, 129, 0.2); color: #10b981; flex-shrink: 0;">
									<i class="fas fa-check" style="font-size: 11px;"></i>
								</span>
								<span><strong>Real-time Analytics:</strong> Live campaign dashboard.</span>
							</li>
						</ul>
					</div>

					<!-- Illustration & Trust Footer -->
					<div class="text-center pt-3 border-top border-secondary" style="border-color: rgba(255, 255, 255, 0.1) !important;">
						<div class="d-flex align-items-center justify-content-center text-white-50" style="font-size: 12px;">
							<i class="fas fa-shield-alt text-success mr-2" style="font-size: 14px;"></i> Trusted by 1,200+ Businesses in Tanzania
						</div>
					</div>
				</div>

				<!-- Right Column: Registration Form -->
				<div class="col-lg-7 p-4 p-md-5" style="background: #ffffff;">
					<div class="d-flex flex-wrap align-items-center justify-content-between mb-4 pb-2 border-bottom">
						<div>
							<h3 class="font-weight-800 text-dark mb-1" style="font-size: 24px;">Business Account Signup</h3>
							<p class="text-muted mb-0" style="font-size: 13px;">Create an advertiser account to post campaigns</p>
						</div>
						<div class="mt-2 mt-sm-0">
							<a href="<?=base_url('register')?>" class="btn btn-sm btn-outline-success font-weight-700 px-3 py-1" style="border-radius: 50px; font-size: 12px;">
								<i class="fas fa-user mr-1"></i> Register Personal
							</a>
						</div>
					</div>

					<!-- Feedback Flash Message -->
					<?php if($this->session->flashdata('feedback')){ ?>
						<div class="mb-3"><?php echo $this->session->flashdata('feedback');?></div>
					<?php } ?>

					<!-- Registration Form -->
					<form method="POST" action="<?=base_url('users/business_register')?>">
						<div class="form-row">
							<div class="form-group col-md-8 mb-3">
								<label class="font-weight-700 text-dark mb-1" style="font-size: 13px;">
									<i class="fas fa-user text-primary mr-1"></i> Full Name <span class="text-danger">*</span>
								</label>
								<input type="text" class="form-control" placeholder="eg. Jeremiah Samwel" name="name" value="<?php echo set_value('name'); ?>" required style="border-radius: 10px; border-color: #e2e8f0; height: 44px; font-size: 14px;">
								<?php echo form_error('name'); ?>
							</div>
							
							<div class="form-group col-md-4 mb-3">
								<label class="font-weight-700 text-dark mb-1" style="font-size: 13px;">
									<i class="fas fa-venus-mars text-primary mr-1"></i> Gender <span class="text-danger">*</span>
								</label>
								<select class="form-control" name="gender" required style="border-radius: 10px; border-color: #e2e8f0; height: 44px; font-size: 14px;">
									<option value="">Select</option>
									<option value="male" <?php if(set_value('gender')=='male'){ echo 'selected'; } ?>>Male</option>
									<option value="female" <?php if(set_value('gender')=='female'){ echo 'selected'; } ?>>Female</option>
								</select>
								<?php echo form_error('gender'); ?>
							</div>
						</div>

						<div class="form-group mb-3">
							<label class="font-weight-700 text-dark mb-1" style="font-size: 13px;">
								<i class="fas fa-building text-primary mr-1"></i> Business Name <span class="text-danger">*</span>
							</label>
							<input type="text" class="form-control" placeholder="eg. Safari Tech Solutions Ltd" name="business_name" value="<?php echo set_value('business_name'); ?>" required style="border-radius: 10px; border-color: #e2e8f0; height: 44px; font-size: 14px;">
							<?php echo form_error('business_name'); ?>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6 mb-3">
								<label class="font-weight-700 text-dark mb-1" style="font-size: 13px;">
									<i class="fas fa-phone-alt text-primary mr-1"></i> Business Phone <span class="text-danger">*</span>
								</label>
								<input type="text" class="form-control" placeholder="eg. 0752xxxxxx" name="business_phone" value="<?php echo set_value('business_phone'); ?>" required style="border-radius: 10px; border-color: #e2e8f0; height: 44px; font-size: 14px;">
								<?php echo form_error('business_phone'); ?>
							</div>

							<div class="form-group col-md-6 mb-3">
								<label class="font-weight-700 text-dark mb-1" style="font-size: 13px;">
									<i class="fas fa-envelope text-primary mr-1"></i> Email <small class="text-muted">(Username)</small> <span class="text-danger">*</span>
								</label>
								<input type="email" class="form-control" placeholder="eg. info@business.co.tz" name="email" value="<?php echo set_value('email'); ?>" required style="border-radius: 10px; border-color: #e2e8f0; height: 44px; font-size: 14px;">
								<?php echo form_error('email'); ?>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6 mb-3">
								<label class="font-weight-700 text-dark mb-1" style="font-size: 13px;">
									<i class="fas fa-lock text-primary mr-1"></i> Password <span class="text-danger">*</span>
								</label>
								<input type="password" class="form-control" placeholder="••••••••••••" name="password" value="<?php echo set_value('password'); ?>" required style="border-radius: 10px; border-color: #e2e8f0; height: 44px; font-size: 14px;">
								<?php echo form_error('password'); ?>
							</div>

							<div class="form-group col-md-6 mb-3">
								<label class="font-weight-700 text-dark mb-1" style="font-size: 13px;">
									<i class="fas fa-key text-primary mr-1"></i> Re-Enter Password <span class="text-danger">*</span>
								</label>
								<input type="password" class="form-control" placeholder="••••••••••••" name="repassword" value="<?php echo set_value('repassword'); ?>" required style="border-radius: 10px; border-color: #e2e8f0; height: 44px; font-size: 14px;">
								<?php echo form_error('repassword'); ?>
							</div>
						</div>

						<div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
							<small class="text-muted"><i class="fas fa-check-circle text-success mr-1"></i> Fast approval within minutes</small>
							<a class="forgot-link text-primary font-weight-700" href="javascript:void(0);" data-toggle="modal" data-target="#login_popup" style="font-size: 13px;">
								Already registered? Login here
							</a>
						</div>
						
						<button class="btn btn-primary btn-block btn-lg font-weight-800" type="submit" style="height: 48px; border-radius: 50px; font-size: 16px; box-shadow: 0 4px 14px rgba(255, 107, 44, 0.35);">
							Create Business Account <i class="fas fa-arrow-right ml-1"></i>
						</button>
					</form>
					<!-- /Registration Form -->
				</div>
			</div>
		</div>
		<!-- /Register 2-Column Card -->
	</div>
</div>