<?php if($this->session->userdata('is_new_user')=='1'){ ?>
	<div class="alert alert-success border-0 mb-4 p-3 d-flex align-items-center" style="border-radius: 12px; background: rgba(16,185,129,0.1); color: #065f46;">
		<i class="fas fa-check-circle mr-3" style="font-size: 22px; color: #10b981;"></i>
		<div>
			<span class="font-weight-700 d-block">Welcome to 24ads!</span>
			<span class="small">Thank you for registering your account. Please complete your profile details below.</span>
		</div>
	</div>
<?php } ?>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
	<div class="card-header bg-white border-bottom p-3 px-4 d-flex justify-content-between align-items-center">
		<div class="d-flex align-items-center">
			<i class="fas fa-user-cog text-primary mr-2" style="font-size: 20px;"></i>
			<div>
				<h5 class="mb-0 font-weight-700 text-dark" style="font-size: 17px;">Personal Profile Settings</h5>
				<small class="text-muted">Manage your personal details, contact info, and avatar</small>
			</div>
		</div>
	</div>

	<div class="card-body p-4">
		<?php echo form_open_multipart('users/update_profile', array('method'=>'post')); ?>
			<div class="row">
				<div class="col-md-12"><?php echo $this->session->flashdata('feedback');?></div>
				
				<!-- Avatar Upload Box -->
				<div class="col-md-12 mb-4">
					<div class="d-flex align-items-center p-3 rounded" style="background: #f8fafc; border: 1px dashed #cbd5e1;">
						<div class="mr-3 position-relative">
							<img src="<?=base_url('media/avatar/'.$this->session->userdata('user_avatar'))?>" alt="User Avatar" id="img-current-holder1" class="rounded-circle shadow-sm" style="width: 76px; height: 76px; object-fit: cover; border: 3px solid #ffffff;">
						</div>
						<div class="upload-img">
							<label class="btn btn-sm btn-primary font-weight-600 px-3 py-2 mb-1" style="border-radius: 8px; cursor: pointer;">
								<i class="fas fa-camera mr-1"></i> Upload New Photo
								<input type="file" name="avatar" id="avatar" accept="image/*" style="display: none;">
							</label>
							<span class="d-block text-muted small">Allowed JPG, PNG or GIF (Max size 10MB)</span>
						</div>
					</div>
				</div>

				<!-- Full Name -->
				<div class="col-md-6 mb-3">
					<div class="form-group mb-0">
						<label class="font-weight-700 text-secondary small text-uppercase">Full Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control font-weight-600" name="name" value="<?php if(isset($info['name']) && $info['name']!=""){ echo htmlspecialchars($info['name']);}else{ echo set_value('name');} ?>" placeholder="Your full legal name">
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

				<!-- Date of Birth -->
				<div class="col-md-4 mb-3">
					<div class="form-group mb-0">
						<label class="font-weight-700 text-secondary small text-uppercase">Date of Birth <span class="text-danger">*</span></label>
						<input type="date" class="form-control" name="date_of_birth" value="<?php if(isset($info['date_of_birth']) && $info['date_of_birth']!=""){ echo htmlspecialchars($info['date_of_birth']);}else{ echo set_value('date_of_birth');} ?>">
						<?php echo form_error('date_of_birth'); ?>
					</div>
				</div>

				<!-- Phone -->
				<div class="col-md-4 mb-3">
					<div class="form-group mb-0">
						<label class="font-weight-700 text-secondary small text-uppercase">Phone Number <span class="text-danger">*</span></label>
						<input type="text" class="form-control font-weight-600" name="phone" value="<?php if(isset($info['phone']) && $info['phone']!=""){ echo htmlspecialchars($info['phone']);}else{ echo set_value('phone');} ?>" placeholder="e.g. 0754000111">
						<?php echo form_error('phone'); ?>
					</div>
				</div>

				<!-- Email Address -->
				<div class="col-md-4 mb-3">
					<div class="form-group mb-0">
						<label class="font-weight-700 text-secondary small text-uppercase">Email Address</label>
						<input type="email" class="form-control" name="email" value="<?php if(isset($info['email']) && $info['email']!=""){ echo htmlspecialchars($info['email']);}else{ echo set_value('email');} ?>" placeholder="name@example.com">
						<?php echo form_error('email'); ?>
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
						<label class="font-weight-700 text-secondary small text-uppercase">Region</label>
						<input type="text" class="form-control" name="region" value="<?php if(isset($info['region']) && $info['region']!=""){ echo htmlspecialchars($info['region']);}else{ echo set_value('region');} ?>" placeholder="e.g. Dar es Salaam">
						<?php echo form_error('region'); ?>
					</div>
				</div>

				<!-- District -->
				<div class="col-md-4 mb-3">
					<div class="form-group mb-0">
						<label class="font-weight-700 text-secondary small text-uppercase">District</label>
						<input type="text" class="form-control" name="district" value="<?php if(isset($info['district']) && $info['district']!=""){ echo htmlspecialchars($info['district']);}else{ echo set_value('district');} ?>" placeholder="e.g. Kinondoni">
						<?php echo form_error('district'); ?>
					</div>
				</div>

				<!-- Save Button -->
				<div class="col-md-12 mt-3">
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
		$("#avatar").change(function(){
			readURL(this);
		});
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#img-current-holder1').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>