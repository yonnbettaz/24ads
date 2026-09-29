<?php if($this->session->userdata('is_new_user')=='1'){ ?>
	<div class="alert alert-success border-0 mb-4 p-3 d-flex align-items-center" style="border-radius: 12px; background: rgba(16,185,129,0.1); color: #065f46;">
		<i class="fas fa-check-circle mr-3" style="font-size: 24px; color: #10b981;"></i>
		<div>
			<span class="font-weight-700 d-block" style="font-size: 15px;">Welcome to 24ads Business! 🎉</span>
			<span class="small font-weight-500">Thank you for registering your business account. Please complete your company profile below to start publishing ad campaigns.</span>
		</div>
	</div>
<?php } ?>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
	<div class="card-header bg-white border-bottom p-3 px-4 d-flex justify-content-between align-items-center">
		<div class="d-flex align-items-center">
			<i class="fas fa-building text-primary mr-2" style="font-size: 20px;"></i>
			<div>
				<h5 class="mb-0 font-weight-700 text-dark" style="font-size: 17px;">Business Profile Settings</h5>
				<small class="text-muted">Manage your business details, contacts, branding logo, and TIN</small>
			</div>
		</div>
	</div>

	<div class="card-body p-4">
		<?php echo form_open_multipart('users/update_business_profile', array('method'=>'post')); ?>
			<div class="row">
				<div class="col-md-12"><?php echo $this->session->flashdata('feedback');?></div>
				
				<!-- Company Logo Upload Card -->
				<div class="col-md-12 mb-4">
					<div class="d-flex align-items-center p-3 rounded" style="background: #f8fafc; border: 1px dashed #cbd5e1;">
						<div class="mr-3 position-relative">
							<?php
								$biz_logo = $this->session->userdata('logo');
								$logo_src = (!empty($biz_logo) && file_exists(FCPATH.'media/logo/'.$biz_logo))
									? base_url('media/logo/'.$biz_logo)
									: base_url('assets/img/user-default.png');
							?>
							<img src="<?=$logo_src?>" alt="Business Logo" id="img-current-holder1" class="rounded shadow-sm" style="width: 84px; height: 84px; object-fit: contain; background: #ffffff; padding: 4px; border: 2px solid #e2e8f0;">
						</div>
						<div class="upload-img">
							<label class="btn btn-sm btn-primary font-weight-600 px-3 py-2 mb-1" style="border-radius: 8px; cursor: pointer;">
								<i class="fas fa-upload mr-1"></i> Upload Company Logo
								<input type="file" name="logo" id="logo" accept="image/*" style="display: none;">
							</label>
							<span class="d-block text-muted small">Recommended square PNG or JPG format (Max size 10MB)</span>
						</div>
					</div>
				</div>

				<!-- Section: Representative Details -->
				<div class="col-md-12 mb-3">
					<h6 class="font-weight-700 text-dark pb-2 border-bottom" style="font-size: 14px;">
						<i class="fas fa-user-tie text-secondary mr-1"></i> Authorized Representative
					</h6>
				</div>

				<!-- Representative Name -->
				<div class="col-md-6 mb-3">
					<div class="form-group mb-0">
						<label class="font-weight-700 text-secondary small text-uppercase">Full Legal Name <span class="text-danger">*</span></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text bg-light border-right-0"><i class="fas fa-user text-muted"></i></span>
							</div>
							<input type="text" class="form-control border-left-0 font-weight-600" name="name" value="<?php if(isset($info['name']) && $info['name']!=""){ echo htmlspecialchars($info['name']);}else{ echo set_value('name');} ?>" placeholder="Full name of representative">
						</div>
						<?php echo form_error('name'); ?>
					</div>
				</div>

				<!-- Gender -->
				<div class="col-md-6 mb-3">
					<div class="form-group mb-0">
						<label class="font-weight-700 text-secondary small text-uppercase d-block">Gender <span class="text-danger">*</span></label>
						<div class="d-flex align-items-center mt-2">
							<div class="custom-control custom-radio custom-control-inline mr-4">
								<input type="radio" id="male" name="gender" class="custom-control-input" value="male" <?php if(isset($info['gender']) && $info['gender']=='male'){ echo 'checked'; } ?>>
								<label class="custom-control-label font-weight-600" for="male">Male</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="female" name="gender" value="female" class="custom-control-input" <?php if(isset($info['gender']) && $info['gender']=='female'){ echo 'checked'; } ?>>
								<label class="custom-control-label font-weight-600" for="female">Female</label>
							</div>
						</div>
						<?php echo form_error('gender'); ?>
					</div>
				</div>

				<!-- Section: Business Information -->
				<div class="col-md-12 my-3">
					<h6 class="font-weight-700 text-dark pb-2 border-bottom" style="font-size: 14px;">
						<i class="fas fa-building text-secondary mr-1"></i> Company Registration & Official Contacts
					</h6>
				</div>

				<!-- Business Name -->
				<div class="col-md-4 mb-3">
					<div class="form-group mb-0">
						<label class="font-weight-700 text-secondary small text-uppercase">Business Name <span class="text-danger">*</span></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text bg-light border-right-0"><i class="fas fa-store text-muted"></i></span>
							</div>
							<input type="text" class="form-control border-left-0 font-weight-700" name="business_name" value="<?php if(isset($info['business_name']) && $info['business_name']!=""){ echo htmlspecialchars($info['business_name']);}else{ echo set_value('business_name');} ?>" placeholder="e.g. Acme Enterprises Ltd">
						</div>
						<?php echo form_error('business_name'); ?>
					</div>
				</div>

				<!-- Business TIN -->
				<div class="col-md-4 mb-3">
					<div class="form-group mb-0">
						<label class="font-weight-700 text-secondary small text-uppercase">Tax Identification Number (TIN) <span class="text-danger">*</span></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text bg-light border-right-0"><i class="fas fa-id-card text-muted"></i></span>
							</div>
							<input type="text" class="form-control border-left-0 font-weight-600" name="TIN" value="<?php if(isset($info['TIN']) && $info['TIN']!=""){ echo htmlspecialchars($info['TIN']);}else{ echo set_value('TIN');} ?>" placeholder="e.g. 123-456-789">
						</div>
						<?php echo form_error('TIN'); ?>
					</div>
				</div>

				<!-- Business Phone -->
				<div class="col-md-4 mb-3">
					<div class="form-group mb-0">
						<label class="font-weight-700 text-secondary small text-uppercase">Business Phone <span class="text-danger">*</span></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text bg-light border-right-0"><i class="fas fa-phone-alt text-muted"></i></span>
							</div>
							<input type="text" class="form-control border-left-0 font-weight-600" name="business_phone" value="<?php if(isset($info['business_phone']) && $info['business_phone']!=""){ echo htmlspecialchars($info['business_phone']);}else{ echo set_value('business_phone');} ?>" placeholder="e.g. 0754000111">
						</div>
						<?php echo form_error('business_phone'); ?>
					</div>
				</div>

				<!-- Business Email -->
				<div class="col-md-4 mb-3">
					<div class="form-group mb-0">
						<label class="font-weight-700 text-secondary small text-uppercase">Official Business Email <span class="text-danger">*</span></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text bg-light border-right-0"><i class="fas fa-envelope text-muted"></i></span>
							</div>
							<input type="email" class="form-control border-left-0 font-weight-600" name="business_email" value="<?php if(isset($info['business_email']) && $info['business_email']!=""){ echo htmlspecialchars($info['business_email']);}else{ echo set_value('business_email');} ?>" placeholder="info@company.co.tz">
						</div>
						<?php echo form_error('business_email'); ?>
					</div>
				</div>

				<!-- Business Website -->
				<div class="col-md-4 mb-3">
					<div class="form-group mb-0">
						<label class="font-weight-700 text-secondary small text-uppercase">Company Website</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text bg-light border-right-0"><i class="fas fa-globe text-muted"></i></span>
							</div>
							<input type="text" class="form-control border-left-0" name="business_website" value="<?php if(isset($info['business_website']) && $info['business_website']!=""){ echo htmlspecialchars($info['business_website']);}else{ echo set_value('business_website');} ?>" placeholder="https://www.company.com">
						</div>
						<?php echo form_error('business_website'); ?>
					</div>
				</div>

				<!-- Business Address -->
				<div class="col-md-4 mb-3">
					<div class="form-group mb-0">
						<label class="font-weight-700 text-secondary small text-uppercase">Physical Street Address</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text bg-light border-right-0"><i class="fas fa-map-marker-alt text-muted"></i></span>
							</div>
							<input type="text" class="form-control border-left-0" name="business_address" value="<?php if(isset($info['business_address']) && $info['business_address']!=""){ echo htmlspecialchars($info['business_address']);}else{ echo set_value('business_address');} ?>" placeholder="e.g. Samora Avenue, Plot 14">
						</div>
						<?php echo form_error('business_address'); ?>
					</div>
				</div>

				<!-- Country -->
				<div class="col-md-4 mb-3">
					<div class="form-group mb-0">
						<label class="font-weight-700 text-secondary small text-uppercase">Country</label>
						<input type="text" class="form-control" name="country" value="<?php if(isset($info['country']) && $info['country']!=""){ echo htmlspecialchars($info['country']);}else{ echo set_value('country', 'Tanzania');} ?>">
						<?php echo form_error('country'); ?>
					</div>
				</div>

				<!-- Region -->
				<div class="col-md-4 mb-3">
					<div class="form-group mb-0">
						<label class="font-weight-700 text-secondary small text-uppercase">Region / City</label>
						<input type="text" class="form-control" name="region" value="<?php if(isset($info['region']) && $info['region']!=""){ echo htmlspecialchars($info['region']);}else{ echo set_value('region');} ?>" placeholder="e.g. Dar es Salaam">
						<?php echo form_error('region'); ?>
					</div>
				</div>

				<!-- District -->
				<div class="col-md-4 mb-3">
					<div class="form-group mb-0">
						<label class="font-weight-700 text-secondary small text-uppercase">District</label>
						<input type="text" class="form-control" name="district" value="<?php if(isset($info['district']) && $info['district']!=""){ echo htmlspecialchars($info['district']);}else{ echo set_value('district');} ?>" placeholder="e.g. Ilala">
						<?php echo form_error('district'); ?>
					</div>
				</div>

				<!-- Section: About Company -->
				<div class="col-md-12 my-3">
					<h6 class="font-weight-700 text-dark pb-2 border-bottom" style="font-size: 14px;">
						<i class="fas fa-info-circle text-secondary mr-1"></i> Business Overview & Biography
					</h6>
				</div>

				<!-- Description -->
				<div class="col-md-12 mb-4">
					<div class="form-group mb-0">
						<label class="font-weight-700 text-secondary small text-uppercase">Company Bio & Products / Services Offered</label>
						<textarea class="form-control" rows="4" name="description" placeholder="Provide a brief summary of what your business does and the products/services you offer..."><?php if(isset($info['description']) && $info['description']!=""){ echo htmlspecialchars($info['description']);}else{ echo set_value('description');} ?></textarea>
						<?php echo form_error('description'); ?>
					</div>
				</div>

				<!-- Save Button -->
				<div class="col-md-12">
					<button type="submit" class="btn btn-primary font-weight-700 px-4 py-2" style="border-radius: 8px;">
						<i class="fas fa-save mr-1"></i> Save Changes
					</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){     
		$("#logo").change(function(){
			readLogoURL(this);
		});
	});

	function readLogoURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#img-current-holder1').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>