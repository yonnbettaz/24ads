<!DOCTYPE html>
<html>
<head>

</head>
<body>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Ad Details</h4>
				</div>
				<div class="row card-body">
					<div class="col-md-4 profile-image123">
						<a href="javascript:void(0);">
							<img class="img-thumbnail banner_detail" alt="" src="<?php echo base_url('media/banner/').$info['banner']; ?>">
						</a>
					</div>
					<div class="col-md-6 profile-user-info123">
						<h4 class="user-name mb-0"><?php echo ucwords($info['title']); ?></h4>
						<h6 class="text-muted">By @ <?php echo ucwords($info['business_name']); ?></h6>
						<p>Question Time: <b><?php echo $info['question_timer']; ?></b> Mins</p>
						<p>Budget Allocated: <b><?php echo $info['budget_allocated']; ?></b> TZS</p>
						<p>Cost per question: <b><?php echo $info['cost_per_click']; ?></b> TZS</p>
						<p>Bonus Allocated: <b><?php echo $info['total_bonus_allocated']; ?></b> TZS</p>
						<p>Bonus per Ads: <b><?php echo $info['bonus']; ?></b> TZS</p>
						<p>Ads Status: <b>
							<?php
								$ads_status="";
								if($info['ads_status']=='0'){
									$ads_status='<span class="badge badge-pill bg-success inv-badge">Closed</span>';
								}elseif($info['ads_status']=='1'){
									$ads_status='<span class="badge badge-pill bg-info inv-badge">Active</span>';
								}elseif($info['ads_status']=='2'){
									$ads_status='<span class="badge badge-pill bg-warning inv-badge">Pending</span>';
								}elseif($info['ads_status']=='3'){
									$ads_status='<span class="badge badge-pill bg-danger inv-badge">Denied</span>';
								}
								echo $ads_status;
							?>
							</b></p>
						<div class="about-text"><?php echo $info['contents']; ?></div>
						<hr>
						<p><?php if($info['rejected_reason']!="") echo 'Rejected Reason: <b>'.ucfirst($info['rejected_reason']).'</b>'; ?></p>
					</div>
					<div class="col-md-2 profile-btn">						
						<?php
							$action='<a href="javascript:void(0);" onclick="enable_ads('.$info['id'].');" class="btn btn-block btn-xs bg-success-light">Enable Ads</a>';
							$action.='<a href="javascript:void(0);" onclick="close_ads('.$info['id'].');" class="btn btn-block btn-xs bg-danger-light">Close Ads</a>';
							$action.='<a href="javascript:void(0);" onclick="loadDenyForm('.$info['id'].', \''.$info['title'].'\');" class="btn btn-block btn-xs bg-danger-light">Reject Ads</a>';
							if($info['status']=="0"){
								$stat='<span class="badge badge-pill bg-success inv-badge btn-block m-b-10">In Active Status</span>';
								$action.='<a href="javascript:void(0);" onclick="diactivate_row('.$info['id'].', \'ads\', \'ads\');" class="btn btn-block btn-xs bg-warning-light">Diactivate</a>';
							}else{
								$stat='<span class="badge badge-pill bg-danger inv-badge btn-block m-b-10">Disabled Status</span>';
								$action.='<a href="javascript:void(0);" onclick="activate_row('.$info['id'].', \'ads\', \'ads\');" class="btn btn-block btn-xs bg-success-light">Activate</a>';
							}
							$action.='<a href="javascript:void(0);" onclick="delete_row('.$info['id'].', \'ads\', \'ads\');" class="btn btn-block btn-xs bg-danger-light"><i class="fa fa-trash"></i> Delete</a>';
							echo $stat;
							echo '<br>';
							echo $action;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>