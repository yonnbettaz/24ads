<div class="row justify-content-center my-4">
	<div class="col-xl-11 col-lg-12">
		<!-- Register 2-Column Card -->
		<div class="card border-0 shadow-lg" style="border-radius: 24px; overflow: hidden; background: #ffffff;">
			<div class="row no-gutters">
				
				<!-- Left Column: Brand & Benefits -->
				<div class="col-lg-5 d-none d-lg-flex flex-column justify-content-between p-5" style="background: linear-gradient(135deg, #091a2e 0%, #0f2942 60%, #163859 100%); color: #ffffff; position: relative; overflow: hidden;">
					<!-- Decorative background glow -->
					<div style="position: absolute; top: -80px; right: -80px; width: 220px; height: 220px; background: radial-gradient(circle, rgba(16, 185, 129, 0.25) 0%, rgba(16, 185, 129, 0) 70%); border-radius: 50%; pointer-events: none;"></div>
					
					<div>
						<!-- Badge -->
						<div class="d-inline-flex align-items-center mb-3" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 50px; padding: 5px 14px; font-size: 12px; font-weight: 700; color: #10b981;">
							<i class="fas fa-coins mr-2"></i> Earners & Personal Users
						</div>
						
						<h2 class="font-weight-800 text-white mb-3" style="font-size: 30px; line-height: 1.25; letter-spacing: -0.02em;">
							Earn Real Money <span style="background: linear-gradient(135deg, #10b981 0%, #34d399 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Every Day</span>
						</h2>
						
						<p class="text-white-50 mb-4" style="font-size: 14px; line-height: 1.6;">
							Read verified advertisements, answer quick quiz questions, and withdraw your earnings directly to your mobile wallet.
						</p>

						<!-- Benefits List -->
						<ul class="list-unstyled mb-4" style="font-size: 13px;">
							<li class="d-flex align-items-center mb-3 text-white">
								<span class="d-flex align-items-center justify-content-center mr-3" style="width: 28px; height: 28px; border-radius: 50%; background: rgba(16, 185, 129, 0.2); color: #10b981; flex-shrink: 0;">
									<i class="fas fa-check" style="font-size: 11px;"></i>
								</span>
								<span><strong>100% Free Registration:</strong> No fees or hidden charges.</span>
							</li>
							<li class="d-flex align-items-center mb-3 text-white">
								<span class="d-flex align-items-center justify-content-center mr-3" style="width: 28px; height: 28px; border-radius: 50%; background: rgba(16, 185, 129, 0.2); color: #10b981; flex-shrink: 0;">
									<i class="fas fa-check" style="font-size: 11px;"></i>
								</span>
								<span><strong>Daily High-Paid Ads:</strong> Updated 24/7 with fresh rewards.</span>
							</li>
							<li class="d-flex align-items-center mb-3 text-white">
								<span class="d-flex align-items-center justify-content-center mr-3" style="width: 28px; height: 28px; border-radius: 50%; background: rgba(16, 185, 129, 0.2); color: #10b981; flex-shrink: 0;">
									<i class="fas fa-check" style="font-size: 11px;"></i>
								</span>
								<span><strong>Instant Mobile Payouts:</strong> M-Pesa, Tigo, Airtel, HaloPesa.</span>
							</li>
							<li class="d-flex align-items-center text-white">
								<span class="d-flex align-items-center justify-content-center mr-3" style="width: 28px; height: 28px; border-radius: 50%; background: rgba(16, 185, 129, 0.2); color: #10b981; flex-shrink: 0;">
									<i class="fas fa-check" style="font-size: 11px;"></i>
								</span>
								<span><strong>Quiz Bonuses:</strong> Extra cash for correct answers.</span>
							</li>
						</ul>
					</div>

					<!-- Trust Footer -->
					<div class="text-center pt-3 border-top border-secondary" style="border-color: rgba(255, 255, 255, 0.1) !important;">
						<div class="d-flex align-items-center justify-content-center text-white-50" style="font-size: 12px;">
							<i class="fas fa-shield-alt text-success mr-2" style="font-size: 14px;"></i> 25,000+ Active Tanzanian Members
						</div>
					</div>
				</div>

				<!-- Right Column: Registration Form -->
				<div class="col-lg-7 p-4 p-md-5" style="background: #ffffff;">
					<div class="d-flex flex-wrap align-items-center justify-content-between mb-4 pb-2 border-bottom">
						<div>
							<h3 class="font-weight-800 text-dark mb-1" style="font-size: 24px;">Personal Account Signup</h3>
							<p class="text-muted mb-0" style="font-size: 13px;">Create an earner account to start making money</p>
						</div>
						<div class="mt-2 mt-sm-0">
							<a href="<?=base_url('register_business')?>" class="btn btn-sm btn-outline-primary font-weight-700 px-3 py-1" style="border-radius: 50px; font-size: 12px;">
								<i class="fas fa-briefcase mr-1"></i> Register Business
							</a>
						</div>
					</div>

					<!-- Feedback Flash Message -->
					<?php if($this->session->flashdata('feedback')){ ?>
						<div class="mb-3"><?php echo $this->session->flashdata('feedback');?></div>
					<?php } ?>

					<!-- Registration Form -->
					<form method="POST" action="<?=base_url('users/register')?>">
						<div class="form-group mb-3">
							<label class="font-weight-700 text-dark mb-1" style="font-size: 13px;">
								<i class="fas fa-user text-primary mr-1"></i> Full Name <span class="text-danger">*</span>
							</label>
							<input type="text" class="form-control" placeholder="eg. Jeremiah Samwel" name="name" value="<?php echo set_value('name'); ?>" required style="border-radius: 10px; border-color: #e2e8f0; height: 44px; font-size: 14px;">
							<?php echo form_error('name'); ?>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6 mb-3">
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

							<div class="form-group col-md-6 mb-3">
								<label class="font-weight-700 text-dark mb-1" style="font-size: 13px;">
									<i class="fas fa-calendar-alt text-primary mr-1"></i> Date of Birth <span class="text-danger">*</span>
								</label>
								<input type="date" class="form-control" name="date_of_birth" value="<?php echo set_value('date_of_birth'); ?>" required style="border-radius: 10px; border-color: #e2e8f0; height: 44px; font-size: 14px;">
								<?php echo form_error('date_of_birth'); ?>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6 mb-3">
								<label class="font-weight-700 text-dark mb-1" style="font-size: 13px;">
									<i class="fas fa-phone-alt text-primary mr-1"></i> Phone Number <span class="text-danger">*</span>
								</label>
								<input type="text" class="form-control" placeholder="eg. 0752xxxxxx" name="phone" value="<?php echo set_value('phone'); ?>" required style="border-radius: 10px; border-color: #e2e8f0; height: 44px; font-size: 14px;">
								<?php echo form_error('phone'); ?>
							</div>

							<div class="form-group col-md-6 mb-3">
								<label class="font-weight-700 text-dark mb-1" style="font-size: 13px;">
									<i class="fas fa-envelope text-primary mr-1"></i> Email <small class="text-muted">(Username)</small> <span class="text-danger">*</span>
								</label>
								<input type="email" class="form-control" placeholder="eg. yourname@email.com" name="email" value="<?php echo set_value('email'); ?>" required style="border-radius: 10px; border-color: #e2e8f0; height: 44px; font-size: 14px;">
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
							<small class="text-muted"><i class="fas fa-check-circle text-success mr-1"></i> Free registration & instant activation</small>
							<a class="forgot-link text-primary font-weight-700" href="javascript:void(0);" data-toggle="modal" data-target="#login_popup" style="font-size: 13px;">
								Already registered? Login here
							</a>
						</div>
						
						<button class="btn btn-primary btn-block btn-lg font-weight-800" type="submit" style="height: 48px; border-radius: 50px; font-size: 16px; box-shadow: 0 4px 14px rgba(255, 107, 44, 0.35);">
							Create Personal Account <i class="fas fa-arrow-right ml-1"></i>
						</button>
					</form>
					<!-- /Registration Form -->
				</div>
			</div>
		</div>
		<!-- /Register 2-Column Card -->
	</div>
</div>