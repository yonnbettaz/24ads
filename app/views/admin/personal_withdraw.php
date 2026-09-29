<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Personal Withdraw Request</h4>
				</div>
				<div class="card-body">
					<div class="tbl-responsive">
						<table class="datatable1 table table-hover table-bordered table-center w-break">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th></th>
									<th>Contacts</th>
									<th>RequestID</th>
									<th>Amount (TZS)</th>
									<th>Request Status</th>
									<th>Requested Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$counter=0;
									foreach ($records as $record) {
										$counter++;
										$avatar="default.png";
										$amount="---";
										$action="";
										$status="";
										$w_status="";
										if($record['amount']!=""){
											$amount=number_format($record['amount']);
										}
										if($record['is_processed']=="0"){
											$w_status='<span class="badge badge-pill bg-primary inv-badge">Complete</span>';
										}elseif($record['is_processed']=="1"){
											$w_status='<span class="badge badge-pill bg-warning inv-badge">Pending</span>';
											$action.='<a href="javascript:void(0);" onclick="disburse_withdraw('.$record['id'].');" class="btn btn-block btn-xs bg-success-light">Disburse Money</a>';
											$action.='<a href="javascript:void(0);" onclick="loadWithdrawDenyForm('.$record['id'].', \''.$record['name'].'\');" class="btn btn-block btn-xs bg-danger-light">Reject Ads</a>';
										}elseif($record['is_processed']=="2"){
											$w_status='<span class="badge badge-pill bg-danger inv-badge">Rejected</span>';
											$action.='<a href="javascript:void(0);" onclick="enable_withdraw('.$record['id'].');" class="btn btn-block btn-xs bg-primary-light">Enable Request</a>';
										}

										if($record['status']=="0"){
											$status='<span class="badge badge-pill bg-success inv-badge">Active</span>';
											$action.='<a href="javascript:void(0);" onclick="diactivate_row('.$record['id'].', \'withdrawal\', \'Withdraw\');" class="btn btn-xs bg-warning-light">Diactivate</a>';
										}else{
											$status='<span class="badge badge-pill bg-danger inv-badge">Disabled</span>';
											$action.='<a href="javascript:void(0);" onclick="activate_row('.$record['id'].', \'withdrawal\', \'Withdraw\');" class="btn btn-xs bg-success-light">Activate</a>';
										}
										$action.='<a href="javascript:void(0);" onclick="delete_row('.$record['id'].', \'withdrawal\', \'Withdraw\');" class="btn btn-xs bg-danger-light m-l-10"><i class="fa fa-trash"></i></a>';


										if($record['avatar']!=""){
											$avatar=$record['avatar'];
										}
										echo '<tr>';
										echo '<td>'.$counter.'</td>';
										echo '<td>'.ucwords($record['name']).'</td>';
										echo '<td class="no-break">
												<div class="table-avatar">
													<a href="javascript:void(0);" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="'.base_url('media/avatar/').$avatar.'" alt=""></a>
												</div>
											</td>';
										echo '<td>'.$record['phone'].' - '.$record['email'].'</td>';
										echo '<td class="text-center">'.$record['requestID'].'</td>';
										echo '<td>'.$amount.'</td>';
										echo '<td>'.$w_status.'</td>';
										echo '<td>'.date("d-m-Y H:i:s", strtotime($record['createdDate'])).'</td>';
										echo '<td class="text-center">'.$status.'</td>';
										echo '<td class="text-center">'.$action.'</td>';
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