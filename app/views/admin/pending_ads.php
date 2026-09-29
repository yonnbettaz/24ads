<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Pending Ads</h4>
				</div>
				<div class="card-body">
					<div class="tbl-responsive">
						<table class="datatable1 table table-hover table-bordered table-center w-break">
							<thead>
								<tr>
									<th>#</th>
									<th></th>
									<th>Title</th>
									<th>Business</th>
									<th>Ads Status</th>
									<th>Budget Allocated (TZS)</th>
									<th>Cost (TZS)</th>
									<th>Bonus Allocated (TZS)</th>
									<th>Uploaded Date</th>
									<th class="text-center">Status</th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$counter=0;
									foreach ($ads as $ads) {
										$counter++;
										$status="";
										$ads_status="";
										if($ads->ads_status=="0"){
											$ads_status='<span class="badge badge-pill bg-success inv-badge">Closed</span>';
										}elseif($ads->ads_status=="1"){
											$ads_status='<span class="badge badge-pill bg-info inv-badge">Active</span>';
										}elseif($ads->ads_status=="2"){
											$ads_status='<span class="badge badge-pill bg-warning inv-badge">Pending</span>';
										}elseif($ads->ads_status=="3"){
											$ads_status='<span class="badge badge-pill bg-danger inv-badge">Denied</span>';
										}
										$action='<a href="'.base_url('admin/ads/ads_details').'?ads='.$ads->id.'" class="btn btn-xs bg-info-light"><i class="fa fa-info-circle"></i></a>';
										$action.='<a href="javascript:void(0);" onclick="enable_ads('.$ads->id.');" class="btn btn-block btn-xs bg-success-light">Enable Ads</a>';
										$action.='<a href="javascript:void(0);" onclick="close_ads('.$ads->id.');" class="btn btn-block btn-xs bg-danger-light">Close Ads</a>';
										$action.='<a href="javascript:void(0);" onclick="loadDenyForm('.$ads->id.', \''.$ads->title.'\');" class="btn btn-block btn-xs bg-danger-light">Reject Ads</a>';
										if($ads->status=="0"){
											$status='<span class="badge badge-pill bg-success inv-badge">Active</span>';
											$action.='<a href="javascript:void(0);" onclick="diactivate_row('.$ads->id.', \'ads\', \'ads\');" class="btn btn-xs bg-warning-light">Diactivate</a>';
										}else{
											$status='<span class="badge badge-pill bg-danger inv-badge">Disabled</span>';
											$action.='<a href="javascript:void(0);" onclick="activate_row('.$ads->id.', \'ads\', \'ads\');" class="btn btn-xs bg-success-light">Activate</a>';
										}
										$action.='<a href="javascript:void(0);" onclick="delete_row('.$ads->id.', \'ads\', \'ads\');" class="btn btn-xs bg-danger-light m-l-10"><i class="fa fa-trash"></i></a>';
										$total_bonus_allocated=0;
										if($ads->total_bonus_allocated!=""){
											$total_bonus_allocated=$ads->total_bonus_allocated;
										}
										echo '<tr>';
										echo '<td>'.$counter.'</td>';
										echo '<td>
												<div class="table-avatar">
													<a href="javascript:void(0);" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="'.base_url('media/banner/').$ads->banner.'" alt=""></a>
												</div>
											</td>';
										echo '<td>'.ucwords($ads->title).'</td>';
										echo '<td>'.ucwords($ads->business_name).'</td>';
										echo '<td>'.$ads_status.'</td>';
										echo '<td>'.number_format($ads->budget_allocated).'</td>';
										echo '<td>'.$ads->cost_per_click.'</td>';
										echo '<td>'.number_format($total_bonus_allocated).'</td>';
										echo '<td>'.date("d-m-Y H:i", strtotime($ads->date_uploaded)).'</td>';
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