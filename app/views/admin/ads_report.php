<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Ads Report</h4>
				</div>
				<div class="card-body">
					<div class="col-md-6 mx-auto">
						<form class="row" method="GET">
							<div class="col-md-8">
								<div class="input-group">
	                                <input type="date" name="startDate" class="form-control" value="<?php if(isset($startDate)){ echo $startDate;} ?>" />
									<div class="input-group-prepend">
	                                	<span class="input-group-text"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                                <input type="date" name="endDate" class="form-control" value="<?php if(isset($endDate)){ echo $endDate;} ?>" />
								</div>
								<p><small>Filter report by start date and end date.</small></p>
							</div>
							<div class="col-md-4">
								<button class="btn btn-info">Filter</button>
							</div>
						</form>
					</div>
					<hr>
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
								</tr>
							</thead>
							<tbody>
								<?php 
									$counter=0;
									foreach ($reports as $ads) {
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
										if($ads->status=="0"){
											$status='<span class="badge badge-pill bg-success inv-badge">Active</span>';
										}else{
											$status='<span class="badge badge-pill bg-danger inv-badge">Disabled</span>';
										}
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