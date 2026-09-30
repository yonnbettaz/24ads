<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-md-5 mx-auto">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Add/Update System User</h4>
				</div>
				<div class="card-body">
					<form method="POST" id="data-form">
						<div class="form-group row">
							<label class="col-form-label col-md-3">Name:</label>
							<div class="col-md-9">
								<input type="text" name="name" value="<?php if($user!="" && $info['name']!=""){ echo htmlspecialchars($info['name'], ENT_QUOTES, 'UTF-8');} ?>" class="form-control">
								<input type="hidden" name="user" value="<?php if($user!="" && $user!=""){ echo htmlspecialchars($user, ENT_QUOTES, 'UTF-8');} ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-md-3">Gender:</label>
							<div class="col-md-9">
								<select class="select form-control" name="gender">
									<option value="">-- Select --</option>
									<option value="male" <?php if($user!="" && $info['gender']=="male"){ echo 'selected';} ?>>Male</option>
									<option value="female" <?php if($user!="" && $info['gender']=="female"){ echo 'selected';} ?>>Female</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-md-3">Phone:</label>
							<div class="col-md-9">
								<input type="text" name="phone" value="<?php if($user!="" && $info['phone']!=""){ echo htmlspecialchars($info['phone'], ENT_QUOTES, 'UTF-8');} ?>" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-md-3">Email:</label>
							<div class="col-md-9">
								<input type="text" name="email" value="<?php if($user!="" && $info['email']!=""){ echo htmlspecialchars($info['email'], ENT_QUOTES, 'UTF-8');} ?>" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-md-3">User Role:</label>
							<div class="col-md-9">
								<select class="select form-control" name="role">
									<option value="">-- Select --</option>
									<?php
										foreach ($roles as $role) {
											if($user!="" && $info['role']==$role->id){
												echo '<option value="'.$role->id.'" selected>'.$role->role_name.'</option>';
											}else{
												echo '<option value="'.$role->id.'">'.$role->role_name.'</option>';
											}
										}
									?>
								</select>
							</div>
						</div>
						<div class="row"><p class="col-md-12">Note: default password is email address, same as username</p></div>
						<div class="row"><div class="col-md-12" id="resultMsg"></div></div>
						<div class="row">
							<div class="col-md-3"></div>
	                        <div class="form-group col-md-9">
	                        	<?php if(isset($user) && $user!=""){ ?>
	                            	<a href="javascript:void(0);" class="btn btn-primary btn-block btn-sm turnOnProgress" id="updateBtn">Update</a>
	                        	<?php }else{ ?>
	                            	<a href="javascript:void(0);" class="btn btn-primary btn-block btn-sm turnOnProgress" id="saveBtn">Submit</a>
	                        	<?php } ?>
	                            <a href="javascript:void(0);" class="btn btn-primary btn-block btn-sm progressBarBtn"><i class="fa fa-spinner fa-spin"></i> Processing...</a>
	                        </div>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){

	    $('#saveBtn').click(function(){
            $('.turnOnProgress').css('display','none');
            $('.progressBarBtn').css('display','inline-block');
            $.ajax({
                url: '<?php echo site_url(); ?>admin/users/save_system_user',
                type: 'POST',
                data:$('#data-form').serialize(),
                async: true,
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
                error: function( xhr, status, error ) {
                    $('#resultMsg').html(error);
                    $('.turnOnProgress').css('display','inline-block');
                    $('.progressBarBtn').css('display','none');
                    return false;
                }
            });
        });

	    $('#updateBtn').click(function(){
            $('.turnOnProgress').css('display','none');
            $('.progressBarBtn').css('display','inline-block');
            $.ajax({
                url: '<?php echo site_url(); ?>admin/users/update_system_user',
                type: 'POST',
                data:$('#data-form').serialize(),
                async: true,
                processData: false,
                success: function (data) {
                    if(data.trim()=='Success'){
                        var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button> Success </div>'; 
                        $('#resultMsg').html(output);
                        document.getElementById("data-form").reset();
                        window.location="<?=base_url('admin/users/system_users')?>";
                    }else{
                        $('#resultMsg').html(data);
                    }
                    $('.turnOnProgress').css('display','inline-block');
                    $('.progressBarBtn').css('display','none');
                },
                error: function( xhr, status, error ) {
                    $('#resultMsg').html(error);
                    $('.turnOnProgress').css('display','inline-block');
                    $('.progressBarBtn').css('display','none');
                    return false;
                }
            });
        });

	});
</script>