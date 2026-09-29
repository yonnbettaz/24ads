<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-lg-2">
					<div class="col-auto profile-image">
						<a href="javascript:void();">
							<img class="rounded-circle" alt="User Image" src="<?=base_url('media/admin_avatar/'.$this->session->userdata('user_avatar'))?>">
						</a>
					</div>
				</div>
				<div class="col-lg-10">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title d-flex justify-content-between">
								<span>Personal Details</span> 
								<a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i class="fa fa-edit mr-1"></i>Edit</a>
							</h5>
							<div class="row">
								<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
								<p class="col-sm-10"><?php echo $info['name']; ?></p>
							</div>
							<div class="row">
								<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Gender</p>
								<p class="col-sm-10"><?php echo ucwords($info['gender']); ?></p>
							</div>
							<div class="row">
								<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email</p>
								<p class="col-sm-10"><?php echo $info['email']; ?></p>
							</div>
							<div class="row">
								<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
								<p class="col-sm-10"><?php echo $info['phone']; ?></p>
							</div>
						</div>
					</div>
					<div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document" >
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Update Personal Info</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form id="data-form" method="POST">
										<div class="row form-row">
											<div class="col-12 col-sm-6">
												<div class="form-group">
													<label>Full Name</label>
													<input type="text" name="name" class="form-control" value="<?php echo $info['name']; ?>" readonly>
												</div>
											</div>
											<div class="col-12 col-sm-6">
												<div class="form-group">
													<label>Gender</label>
													<select class="form-control" name="gender">
														<option value="">Select</option>
														<option value="male" <?php if($info['gender']=='male'){ echo 'selected';} ?>>Male</option>
														<option value="female" <?php if($info['gender']=='female'){ echo 'selected';} ?>>Female</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-sm-6">
												<div class="form-group">
													<label>Email ID</label>
													<input type="email" name="email" class="form-control" value="<?php echo $info['email']; ?>">
												</div>
											</div>
											<div class="col-12 col-sm-6">
												<div class="form-group">
													<label>Mobile</label>
													<input type="text" name="phone" value="<?php echo $info['phone']; ?>" class="form-control">
												</div>
											</div>
											<div class="col-12 col-md-12">
												<h5 class="form-title"><span>Profile</span></h5>
												<div class="change-avatar text-center">
													<div class="profile-img">
														<img src="<?=base_url('media/admin_avatar/'.$this->session->userdata('user_avatar'))?>" alt="User Image"  id="img-current-holder1">
													</div>
													<div class="upload-img">
														<div class="change-photo-btn">
															<label for="avatar" class="btn btn-xs btn-success"><i class="fa fa-upload"></i> Upload Photo</label>
															<input type="file" class="upload" name="avatar" id="avatar" accept="image/*" style="display: none;">
														</div>
														<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 25MB</small>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-12" id="resultMsg"></div>
                                        <a href="javascript:void();" class="btn btn-primary btn-block turnOnProgress" id="saveBtn">Save Changes</a>
                                        <a href="javascript:void();" class="btn btn-primary btn-block progressBarBtn"><i class="fa fa-spinner fa-spin"></i> Processing...</a>
									</form>
								</div>
							</div>
						</div>
					</div>							
				</div>					
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){     

        $("#avatar").change(function(){
            readURL(this);
        });

        $('#saveBtn').click(function(){
           $('.turnOnProgress').css('display','none');
           $('.progressBarBtn').css('display','inline-block');
           var formData = new FormData($('#data-form')[0]);
           $.ajax({
               url: '<?php echo base_url(); ?>admin/users/update_profile',
               type: 'POST',
               data: formData,
               async: true,
               cache: false,
               contentType: false,
               enctype: 'multipart/form-data',
               processData: false,
               success: function (data) {
                    if(data.trim()=='Success'){
                        var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button> Success </div>'; 
                        $('#resultMsg').html(output);
                        document.getElementById("data-form").reset();
                        window.location="";
                    }else{
                        $('#resultMsg').html(data);
                    }
                    $('.turnOnProgress').css('display','inline-block');
                    $('.progressBarBtn').css('display','none');
                },
                complete: function() {
                    $('.turnOnProgress').css('display','inline-block');
                    $('.progressBarBtn').css('display','none');
                },
                error: function( xhr, status, error ) {
                    $('#resultMsg').html(error);
                    console.log('ajax loading error...');
                    console.log(error);
                    $('.turnOnProgress').css('display','inline-block');
                    $('.progressBarBtn').css('display','none');
                    return false;
                }
           });
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