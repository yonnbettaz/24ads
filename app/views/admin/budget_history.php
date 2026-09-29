<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Business Budget History</h4>
				</div>
				<div class="card-body">
					<div class="tbl-responsive">
						<table class="datatable1 table table-hover table-bordered table-center w-break">
							<thead>
								<tr>
									<th>#</th>
									<th>Business</th>
									<th></th>
									<th>Title</th>
									<!-- <th>Ads Status</th> -->
									<th>Budget Allocated (TZS)</th>
									<th>Bonus Allocated (TZS)</th>
									<th>Budget Used (TZS)</th>
									<th>Budget Remained (TZS)</th>
									<th>Used Date</th>
									<!-- <th class="text-center">Status</th> -->
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$counter=0; $budget_used=0; $exist=array();
									foreach ($ads as $ads) {
										$counter++;
										$status="";
										$ads_status=""; $ads_id=$ads->id;
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
										if($ads->status=="0"){
											$status='<span class="badge badge-pill bg-success inv-badge">Active</span>';
										}else{
											$status='<span class="badge badge-pill bg-danger inv-badge">Disabled</span>';
										}
										$total_bonus_allocated=0;
										if($ads->total_bonus_allocated!=""){
											$total_bonus_allocated=$ads->total_bonus_allocated;
										}
										if(!in_array($ads_id, $exist)){
											$budget_used=0;
											array_push($exist, $ads_id);
										}
										$budget_used=$budget_used+$ads->total_cash;
										echo '<tr>';
										echo '<td>'.$counter.'</td>';
										echo '<td>'.ucwords($ads->business_name).'</td>';
										echo '<td>
												<div class="table-avatar">
													<a href="javascript:void(0);" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="'.base_url('media/banner/').$ads->banner.'" alt=""></a>
												</div>
											</td>';
										echo '<td>'.ucwords($ads->title).'</td>';
										// echo '<td>'.$ads_status.'</td>';
										echo '<td>'.number_format($ads->budget_allocated).'</td>';
										echo '<td>'.number_format($total_bonus_allocated).'</td>';
										echo '<td>'.$ads->total_cash.'</td>';
										echo '<td>'.number_format(($ads->budget_allocated+$total_bonus_allocated)-$budget_used).'</td>';
										echo '<td>'.date("d-m-Y H:i", strtotime($ads->date_clicked)).'</td>';
										// echo '<td class="text-center">'.$status.'</td>';
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