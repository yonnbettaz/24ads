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
						<h4 class="user-name mb-0"><?php echo htmlspecialchars(ucwords($info['title']), ENT_QUOTES, 'UTF-8'); ?></h4>
						<h6 class="text-muted">By @ <?php echo htmlspecialchars(ucwords($info['business_name']), ENT_QUOTES, 'UTF-8'); ?></h6>
						<p>Question Time: <b><?php echo htmlspecialchars($info['question_timer'], ENT_QUOTES, 'UTF-8'); ?></b> Mins</p>
						<p>Budget Allocated: <b><?php echo htmlspecialchars($info['budget_allocated'], ENT_QUOTES, 'UTF-8'); ?></b> TZS</p>
						<p>Cost per question: <b><?php echo htmlspecialchars($info['cost_per_click'], ENT_QUOTES, 'UTF-8'); ?></b> TZS</p>
						<p>Bonus Allocated: <b><?php echo htmlspecialchars($info['total_bonus_allocated'], ENT_QUOTES, 'UTF-8'); ?></b> TZS</p>
						<p>Bonus per Ads: <b><?php echo htmlspecialchars($info['bonus'], ENT_QUOTES, 'UTF-8'); ?></b> TZS</p>
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
						<div class="about-text"><?php echo htmlspecialchars($info['contents'], ENT_QUOTES, 'UTF-8'); ?></div>
						<hr>
						<p><?php if($info['rejected_reason']!="") echo 'Rejected Reason: <b>'.htmlspecialchars(ucfirst($info['rejected_reason']), ENT_QUOTES, 'UTF-8').'</b>'; ?></p>
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