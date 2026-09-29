<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Business Accounts</h4>
				</div>
				<div class="card-body">
					<div class="tbl-responsive">
						<table class="datatable1 table table-hover table-bordered table-center w-break">
							<thead>
								<tr>
									<th>#</th>
									<th></th>
									<th>Name</th>
									<th>Gender</th>
									<th>Business</th>
									<th>Contacts</th>
									<th>Username</th>
									<th>Location</th>
									<th>Registered Date</th>
									<th class="text-center">Status</th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$counter=0;
									foreach ($accounts as $account) {
										$counter++;
										$status="";
										$action="";
										if($account->status=="0"){
											$status='<span class="badge badge-pill bg-success inv-badge">Active</span>';
											$action.='<a href="javascript:void(0);" onclick="diactivate_row('.$account->id.', \'users\', \'business account\');" class="btn btn-xs bg-warning-light">Diactivate</a>';
										}else{
											$status='<span class="badge badge-pill bg-danger inv-badge">Disabled</span>';
											$action.='<a href="javascript:void(0);" onclick="activate_row('.$account->id.', \'users\', \'business account\');" class="btn btn-xs bg-success-light">Activate</a>';
										}
										$action.='<a href="javascript:void(0);" onclick="delete_row('.$account->id.', \'users\', \'business account\');" class="btn btn-xs bg-danger-light m-l-10"><i class="fa fa-trash"></i></a>';
										$logo="default.png";
										if($account->logo!=""){
											$logo=$account->logo;
										}

										echo '<tr>';
										echo '<td>'.$counter.'</td>';
										echo '<td>
												<div class="table-avatar">
													<a href="javascript:void(0);" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="'.base_url('media/logo/').$logo.'" alt=""></a>
												</div>
											</td>';
										echo '<td>'.ucwords($account->name).'</td>';
										echo '<td>'.ucwords($account->gender).'</td>';
										echo '<td>'.ucwords($account->business_name).' - '.$account->TIN.'</td>';
										echo '<td>'.$account->business_phone.' - '.$account->business_email.' - '.$account->business_address.'</td>';
										echo '<td>'.$account->username.'</td>';
										echo '<td>'.$account->country.' - '.$account->region.' - '.$account->district.'</td>';
										echo '<td>'.date("d-m-Y H:i", strtotime($account->createdDate)).'</td>';
										echo '<td class="text-center">'.$status.'</td>';
										echo '<td class="text-right">'.$action.'</td>';
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

	});
</script>