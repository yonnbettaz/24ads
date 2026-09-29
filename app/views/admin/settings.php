<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Add/Update Setting</h4>
				</div>
				<div class="card-body">
					<form method="POST" id="data-form">
						<div class="form-group">
							<label>Provider Name:</label>
							<input type="text" name="setting_key" value="<?php if(isset($info['setting_key']) && $info['setting_key']!=""){ echo $info['setting_key'];} ?>" class="form-control" placeholder="eg. minimum_budge">
							<input type="hidden" name="setting" value="<?php if(isset($setting) && $setting!=""){ echo $setting;} ?>">
						</div>
						<div class="form-group">
							<label>Provider Name:</label>
							<input type="text" name="setting_value" value="<?php if(isset($info['setting_value']) && $info['setting_value']!=""){ echo $info['setting_value'];} ?>" class="form-control" placeholder="eg. 300">
						</div>
						<div id="resultMsg"></div>
                        <div class="form-group">
                        	<?php if($setting!=""){ ?>
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
					<h4 class="card-title">List</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-center datatable1 mb-0 w-break">
							<thead>
								<th class="text-center">#</th>
								<th>Setting Key</th>
								<th>Setting Value</th>
								<th class="text-center">Status</th>
								<th>Action</th>
							</thead>
							<tbody>
								<?php
									$counter=0;
									foreach ($settings as $setting) {
										$counter++;
										$status="";
										$action='<a href="settings?setting='.$setting->id.'" class="btn btn-xs btn-info m-r-10"><i class="fa fa-edit"></i></a>';
										if($setting->status=="0"){
											$status='<span class="badge badge-primary">Active</span>';
											$action.='<a href="javascript:void(0);" onclick="diactivate_row('.$setting->id.', \'settings\', \'setting\');" class="btn btn-xs btn-warning">Diactivate</a>';
										}else{
											$status='<span class="badge badge-danger">Disabled</span>';
											$action.='<a href="javascript:void(0);" onclick="activate_row('.$setting->id.', \'settings\', \'setting\');" class="btn btn-xs btn-success">Activate</a>';
										}
										$action.='<a href="javascript:void(0);" onclick="delete_row('.$setting->id.', \'settings\', \'setting\');" class="btn btn-xs btn-danger m-l-10"><i class="fa fa-trash"></i></a>';
										echo '<tr>';
										echo '<td class="text-center">'.$counter.'</td>';
										echo '<td>'.$setting->setting_key.'</td>';
										echo '<td>'.ucwords($setting->setting_value).'</td>';
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
                url: '<?php echo site_url(); ?>admin/save_system_setting',
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
                url: '<?php echo site_url(); ?>admin/update_system_setting',
                type: 'POST',
                data:$('#data-form').serialize(),
                async: true,
                processData: false,
                success: function (data) {
                    if(data.trim()=='Success'){
                        var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button> Success </div>'; 
                        $('#resultMsg').html(output);
                        document.getElementById("data-form").reset();
                        window.location="<?=base_url('admin/settings')?>";
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