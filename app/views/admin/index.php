<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-xl-3 col-sm-6 col-12">
			<div class="card">
				<div class="card-body">
					<div class="dash-widget-header">
						<span class="dash-widget-icon text-primary border-primary">
							<i class="fe fe-users"></i>
						</span>
						<div class="dash-count">
							<h3><?=$total_personal_accounts?></h3>
						</div>
					</div>
					<div class="dash-widget-info">
						<h6 class="text-muted">Total Pers. Accounts</h6>
						<div class="progress progress-sm">
							<div class="progress-bar bg-primary w-<?=($total_personal_accounts/($total_personal_accounts+$total_business_accounts))*100?>"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6 col-12">
			<div class="card">
				<div class="card-body">
					<div class="dash-widget-header">
						<span class="dash-widget-icon text-success">
							<i class="fe fe-money"></i>
						</span>
						<div class="dash-count">
							<h3><?=$total_business_accounts?></h3>
						</div>
					</div>
					<div class="dash-widget-info">						
						<h6 class="text-muted">Total Bus. Accounts</h6>
						<div class="progress progress-sm">
							<div class="progress-bar bg-success w-<?=($total_business_accounts/($total_personal_accounts+$total_business_accounts))*100?>"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6 col-12">
			<div class="card">
				<div class="card-body">
					<div class="dash-widget-header">
						<span class="dash-widget-icon text-danger border-danger">
							<i class="fe fe-folder"></i>
						</span>
						<div class="dash-count">
							<h3><?=$total_ads?></h3>
						</div>
					</div>
					<div class="dash-widget-info">						
						<h6 class="text-muted">Total Ads</h6>
						<div class="progress progress-sm">
							<div class="progress-bar bg-danger w-80"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6 col-12">
			<div class="card">
				<div class="card-body">
					<div class="dash-widget-header">
						<span class="dash-widget-icon text-warning border-warning">
							<i class="fe fe-folder"></i>
						</span>
						<div class="dash-count">
							<h3><?=$total_active_ads?></h3>
						</div>
					</div>
					<div class="dash-widget-info">						
						<h6 class="text-muted">Total Active</h6>
						<div class="progress progress-sm">
							<div class="progress-bar bg-warning w-<?=($total_active_ads/$total_ads)*100?>"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card card-table">
				<div class="card-header">
					<h4 class="card-title">Latest Ads</h4>
				</div>
				<div class="card-body">
					<div class="tbl-responsive">
						<table class="table table-hover table-center w-break mb-0">
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
									foreach ($latest_ads as $ads) {
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