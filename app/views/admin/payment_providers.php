<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Add/Update Provider</h4>
				</div>
				<div class="card-body">
					<form method="POST" id="data-form">
						<div class="form-group">
							<label>Method:</label>
							<select class="form-control" name="method">
								<option value="">--Select--</option>
								<option value="mobile" <?php if(isset($info['method']) && $info['method']=="mobile"){ echo 'selected';} ?>>Mobile</option>
								<option value="bank" <?php if(isset($info['method']) && $info['method']=="bank"){ echo 'selected';} ?>>Bank</option>
							</select>
						</div>
						<div class="form-group">
							<label>Provider Name:</label>
							<input type="text" name="provider" value="<?php if(isset($info['provider']) && $info['provider']!=""){ echo $info['provider'];} ?>" class="form-control" placeholder="eg. Mpesa or crdb">
							<input type="hidden" name="provider_id" value="<?php if(isset($provider) && $provider!=""){ echo $provider;} ?>">
						</div>
						<div id="resultMsg"></div>
                        <div class="form-group">
                        	<?php if($provider!=""){ ?>
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
								<th>Method</th>
								<th>Provider</th>
								<th class="text-center">Status</th>
								<th>Action</th>
							</thead>
							<tbody>
								<?php
									$counter=0;
									foreach ($providers as $provider) {
										$counter++;
										$status="";
										$action='<a href="payment_providers?provider='.$provider->id.'" class="btn btn-xs btn-info m-r-10"><i class="fa fa-edit"></i></a>';
										if($provider->status=="0"){
											$status='<span class="badge badge-primary">Active</span>';
											$action.='<a href="javascript:void(0);" onclick="diactivate_row('.$provider->id.', \'payment_provider\', \'provider\');" class="btn btn-xs btn-warning">Diactivate</a>';
										}else{
											$status='<span class="badge badge-danger">Disabled</span>';
											$action.='<a href="javascript:void(0);" onclick="activate_row('.$provider->id.', \'payment_provider\', \'provider\');" class="btn btn-xs btn-success">Activate</a>';
										}
										$action.='<a href="javascript:void(0);" onclick="delete_row('.$provider->id.', \'payment_provider\', \'provider\');" class="btn btn-xs btn-danger m-l-10"><i class="fa fa-trash"></i></a>';
										echo '<tr>';
										echo '<td class="text-center">'.$counter.'</td>';
										echo '<td>'.ucwords($provider->method).'</td>';
										echo '<td>'.$provider->provider.'</td>';
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
                url: '<?php echo site_url(); ?>admin/save_payment_provider',
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
                url: '<?php echo site_url(); ?>admin/update_payment_provider',
                type: 'POST',
                data:$('#data-form').serialize(),
                async: true,
                processData: false,
                success: function (data) {
                    if(data.trim()=='Success'){
                        var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button> Success </div>'; 
                        $('#resultMsg').html(output);
                        document.getElementById("data-form").reset();
                        window.location="<?=base_url('admin/payment_providers')?>";
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