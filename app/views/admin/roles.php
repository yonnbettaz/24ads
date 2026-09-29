<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Add/Update Roles</h4>
				</div>
				<div class="card-body">
					<form method="POST" id="data-form">
						<div class="form-group">
							<label>Role Name:</label>
							<input type="text" name="role_name" value="<?php if(isset($role) && $role!=""){ echo $info['role_name'];} ?>" class="form-control" placeholder="eg. Customer support">
							<input type="hidden" name="role" value="<?php if(isset($role) && $role!=""){ echo $role;} ?>">
						</div>
						<div id="resultMsg"></div>
                        <div class="form-group">
                        	<?php if($role!=""){ ?>
                            	<a href="javascript:void(0);" class="btn btn-primary btn-block btn-sm turnOnProgress" id="updateBtn">Update</a>
                        	<?php }else{ ?>
                            	<a href="javascript:void(0);" class="btn btn-primary btn-block btn-sm turnOnProgress" id="saveBtn">Submit</a>
                        	<?php } ?>
                            <a href="javascript:void(0);" class="btn btn-primary btn-block btn-sm progressBarBtn"><i class="fa fa-spinner fa-spin"></i> Processing...</a>
                        </div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Roles</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-center datatable1 mb-0 w-break">
							<thead>
								<!-- <tr> -->
									<th class="text-center">#</th>
									<th>Name</th>
									<th>Permissions</th>
									<th class="text-center">Status</th>
									<th>Action</th>
								<!-- </tr> -->
							</thead>
							<tbody>
								<?php
									$counter=0;
									foreach ($roles as $role) {
										$counter++;
										$status="";
										$action='<a href="roles?role='.$role->id.'" class="btn btn-xs btn-info m-r-10"><i class="fa fa-edit"></i></a>';
										if($role->status=="0"){
											$status='<span class="badge badge-primary">Active</span>';
											$action.='<a href="javascript:void(0);" onclick="diactivate_row('.$role->id.', \'roles\', \'role\');" class="btn btn-xs btn-warning">Diactivate</a>';
										}else{
											$status='<span class="badge badge-danger">Disabled</span>';
											$action.='<a href="javascript:void(0);" onclick="activate_row('.$role->id.', \'roles\', \'role\');" class="btn btn-xs btn-success">Activate</a>';
										}
										$action.='<a href="javascript:void(0);" onclick="delete_row('.$role->id.', \'roles\', \'role\');" class="btn btn-xs btn-danger m-l-10"><i class="fa fa-trash"></i></a>';
										echo '<tr>';
										echo '<td class="text-center">'.$counter.'</td>';
										echo '<td>'.ucwords($role->role_name).'</td>';
										echo '<td>'.$role->permissions.'</td>';
										echo '<td>'.$status.'</td>';
										echo '<td>'.$action.'</td>';
										echo '</tr>';
									}
								?>

							</tbody>
						</table>		
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		if ($('.datatable1').length > 0) {
	        $('.datatable1').DataTable({
	            "bFilter": false,
	            "searching": true
	        });
	    }

	    $('#saveBtn').click(function(){
            $('.turnOnProgress').css('display','none');
            $('.progressBarBtn').css('display','inline-block');
            $.ajax({
                url: '<?php echo site_url(); ?>admin/users/save_user_roles',
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
                url: '<?php echo site_url(); ?>admin/users/update_user_role',
                type: 'POST',
                data:$('#data-form').serialize(),
                async: true,
                processData: false,
                success: function (data) {
                    if(data.trim()=='Success'){
                        var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button> Success </div>'; 
                        $('#resultMsg').html(output);
                        document.getElementById("data-form").reset();
                        window.location="<?=base_url('admin/users/roles')?>";
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