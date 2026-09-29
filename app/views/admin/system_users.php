<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">System Users</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="datatable1 table table-hover table-center mb-0">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Gender</th>
									<th>Phone</th>
									<th>Email (Username)</th>
									<th>Role</th>
									<th class="text-center">Status</th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$counter=0;
									foreach ($users as $user) {
										$counter++;
										$status="";
										$action='<a href="'.base_url('admin/users/add_user').'?user='.$user->id.'" class="btn btn-xs bg-info-light m-r-10"><i class="fa fa-edit"></i></a>';
										if($user->status=="0"){
											$status='<span class="badge badge-pill bg-success inv-badge">Active</span>';
											$action.='<a href="javascript:void(0);" onclick="diactivate_row('.$user->id.', \'admin\', \'user\');" class="btn btn-xs bg-warning-light">Diactivate</a>';
										}else{
											$status='<span class="badge badge-pill bg-danger inv-badge">Disabled</span>';
											$action.='<a href="javascript:void(0);" onclick="activate_row('.$user->id.', \'admin\', \'user\');" class="btn btn-xs bg-success-light">Activate</a>';
										}
										$action.='<a href="javascript:void(0);" onclick="delete_row('.$user->id.', \'admin\', \'user\');" class="btn btn-xs bg-danger-light m-l-10"><i class="fa fa-trash"></i></a>';
										echo '<tr>';
										echo '<td>'.$counter.'</td>';
										echo '<td>'.$user->name.'</td>';
										echo '<td>'.ucwords($user->gender).'</td>';
										echo '<td>'.$user->phone.'</td>';
										echo '<td>'.$user->email.'</td>';
										echo '<td>'.$user->role_name.'</td>';
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