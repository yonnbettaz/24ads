<!-- Business Welcome Hero Banner -->
<div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #0f2942 0%, #1e3a8a 100%); border-radius: 16px; color: #ffffff; overflow: hidden; position: relative;">
	<div class="card-body p-4 position-relative" style="z-index: 2;">
		<div class="row align-items-center">
			<div class="col-lg-8 mb-3 mb-lg-0">
				<div class="d-flex align-items-center mb-2">
					<span class="badge badge-pill badge-warning text-dark font-weight-700 px-3 py-1 mr-2" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Business Portal</span>
					<span class="text-white-50 small"><i class="far fa-calendar-alt mr-1"></i> <?=date('l, d F Y')?></span>
				</div>
				<h2 class="font-weight-800 text-white mb-2" style="font-size: 24px;">
					Welcome, <?=htmlspecialchars($business['business_name'] ?? $this->session->userdata('business_name') ?? 'Business Partner')?>! 🚀
				</h2>
				<p class="text-white-50 mb-0" style="font-size: 14px; max-width: 600px;">
					Manage your interactive ad campaigns, monitor real-time user engagements, and track your advertising budget performance.
				</p>
			</div>
			<div class="col-lg-4 text-lg-right">
				<div class="d-flex flex-wrap justify-content-lg-end gap-2">
					<a href="<?=base_url('business/new_ads')?>" class="btn btn-warning font-weight-700 shadow-sm px-3 py-2 mr-2 mb-2" style="border-radius: 10px; font-size: 13px;">
						<i class="fas fa-plus-circle mr-1"></i> Create New Ad
					</a>
					<a href="<?=base_url('business/ads')?>" class="btn btn-outline-light font-weight-600 px-3 py-2 mb-2" style="border-radius: 10px; font-size: 13px; border: 1.5px solid rgba(255,255,255,0.4);">
						<i class="fas fa-bullhorn mr-1"></i> All Campaigns
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Decorative background circles -->
	<div style="position: absolute; right: -40px; top: -40px; width: 190px; height: 190px; background: rgba(255,255,255,0.04); border-radius: 50%; pointer-events: none;"></div>
	<div style="position: absolute; right: 140px; bottom: -50px; width: 130px; height: 130px; background: rgba(245,158,11,0.12); border-radius: 50%; pointer-events: none;"></div>
</div>

<!-- Key Performance Stat Cards Grid -->
<div class="row mb-4">
	<!-- Total Campaigns -->
	<div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
		<div class="card border-0 shadow-sm h-100" style="border-radius: 14px;">
			<div class="card-body p-3 p-md-4">
				<div class="d-flex align-items-center justify-content-between mb-2">
					<span class="text-muted text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Total Campaigns</span>
					<div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(30,58,138,0.1); color: #1e3a8a; display: flex; align-items: center; justify-content: center; font-size: 18px;">
						<i class="fas fa-bullhorn"></i>
					</div>
				</div>
				<h3 class="font-weight-800 text-dark mb-1" style="font-size: 26px;"><?=number_format($stats['total_ads'] ?? 0)?></h3>
				<div class="d-flex align-items-center small text-muted">
					<span class="text-success font-weight-600 mr-2"><i class="fas fa-check-circle mr-1"></i><?=$stats['active_ads'] ?? 0?> Active</span>
					<span class="text-warning font-weight-600"><i class="fas fa-clock mr-1"></i><?=$stats['pending_ads'] ?? 0?> Pending</span>
				</div>
			</div>
		</div>
	</div>

	<!-- Total Views / Engagements -->
	<div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
		<div class="card border-0 shadow-sm h-100" style="border-radius: 14px;">
			<div class="card-body p-3 p-md-4">
				<div class="d-flex align-items-center justify-content-between mb-2">
					<span class="text-muted text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Total Engagements</span>
					<div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(16,185,129,0.1); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 18px;">
						<i class="fas fa-mouse-pointer"></i>
					</div>
				</div>
				<h3 class="font-weight-800 text-dark mb-1" style="font-size: 26px;"><?=number_format($stats['total_views'] ?? 0)?></h3>
				<span class="small text-muted">Verified viewers rewarded</span>
			</div>
		</div>
	</div>

	<!-- Budget Allocated -->
	<div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
		<div class="card border-0 shadow-sm h-100" style="border-radius: 14px;">
			<div class="card-body p-3 p-md-4">
				<div class="d-flex align-items-center justify-content-between mb-2">
					<span class="text-muted text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Total Budget</span>
					<div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(245,158,11,0.12); color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 18px;">
						<i class="fas fa-coins"></i>
					</div>
				</div>
				<h3 class="font-weight-800 text-dark mb-1" style="font-size: 22px;"><?=number_format($stats['total_budget'] ?? 0)?> <small style="font-size: 13px; font-weight: 600;">TZS</small></h3>
				<span class="small text-muted">Allocated for campaigns</span>
			</div>
		</div>
	</div>

	<!-- Total Spent -->
	<div class="col-xl-3 col-sm-6">
		<div class="card border-0 shadow-sm h-100" style="border-radius: 14px;">
			<div class="card-body p-3 p-md-4">
				<div class="d-flex align-items-center justify-content-between mb-2">
					<span class="text-muted text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Total Spent</span>
					<div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(99,102,241,0.1); color: #6366f1; display: flex; align-items: center; justify-content: center; font-size: 18px;">
						<i class="fas fa-chart-line"></i>
					</div>
				</div>
				<h3 class="font-weight-800 text-dark mb-1" style="font-size: 22px;"><?=number_format($stats['total_spent'] ?? 0)?> <small style="font-size: 13px; font-weight: 600;">TZS</small></h3>
				<div class="small text-muted d-flex align-items-center justify-content-between">
					<span>Remaining:</span>
					<span class="font-weight-700 text-success"><?=number_format($stats['remaining_budget'] ?? 0)?> TZS</span>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Campaigns from tbl_ads Section -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
	<div class="card-header bg-white border-bottom p-3 px-4 d-flex justify-content-between align-items-center">
		<div class="d-flex align-items-center">
			<div class="mr-2" style="width: 32px; height: 32px; border-radius: 8px; background: rgba(30,58,138,0.1); color: #1e3a8a; display: flex; align-items: center; justify-content: center; font-size: 15px;">
				<i class="fas fa-layer-group"></i>
			</div>
			<h5 class="mb-0 font-weight-700 text-dark" style="font-size: 17px;">Your Ad Campaigns</h5>
		</div>
		<div class="d-flex align-items-center">
			<a href="<?=base_url('business/ads')?>" class="btn btn-sm btn-light font-weight-600 text-primary px-3 py-1 mr-2" style="border-radius: 8px; font-size: 12.5px;">
				View All (<?=$stats['total_ads'] ?? 0?>) <i class="fas fa-arrow-right ml-1"></i>
			</a>
			<a href="<?=base_url('business/new_ads')?>" class="btn btn-sm btn-primary font-weight-600 px-3 py-1" style="border-radius: 8px; font-size: 12.5px;">
				<i class="fas fa-plus mr-1"></i> New Ad
			</a>
		</div>
	</div>
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-hover table-center align-middle mb-0">
				<thead class="bg-light text-muted" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
					<tr>
						<th class="text-center" style="width: 50px;">#</th>
						<th style="width: 70px;">Banner</th>
						<th>Campaign Title</th>
						<th class="text-center">Questions</th>
						<th>Budget (TZS)</th>
						<th>Cost / View</th>
						<th class="text-center">Views</th>
						<th>Spent (TZS)</th>
						<th class="text-center">Status</th>
						<th class="text-right pr-4">Action</th>
					</tr>
				</thead>
				<tbody style="font-size: 13.5px;">
					<?php 
					if(!empty($recent_ads)){
						$counter = 0;
						foreach ($recent_ads as $ad){
							$counter++;
							
							// Ad Status Badge
							$status_badge = '';
							if($ad->ads_status == '1'){
								$status_badge = '<span class="badge badge-pill badge-success-light font-weight-700 px-2 py-1" style="color: #10b981; background: rgba(16,185,129,0.12); font-size: 11.5px;"><i class="fas fa-circle mr-1" style="font-size: 7px;"></i> Active</span>';
							}elseif($ad->ads_status == '2'){
								$status_badge = '<span class="badge badge-pill badge-warning-light font-weight-700 px-2 py-1" style="color: #d97706; background: rgba(245,158,11,0.15); font-size: 11.5px;"><i class="fas fa-hourglass-half mr-1" style="font-size: 8px;"></i> Pending</span>';
							}elseif($ad->ads_status == '0'){
								$status_badge = '<span class="badge badge-pill badge-secondary-light font-weight-700 px-2 py-1" style="color: #64748b; background: rgba(100,116,139,0.12); font-size: 11.5px;"><i class="fas fa-ban mr-1" style="font-size: 8px;"></i> Closed</span>';
							}elseif($ad->ads_status == '3'){
								$status_badge = '<span class="badge badge-pill badge-danger-light font-weight-700 px-2 py-1" style="color: #ef4444; background: rgba(239,68,68,0.12); font-size: 11.5px;"><i class="fas fa-times-circle mr-1" style="font-size: 8px;"></i> Denied</span>';
							}

							$banner_img = (!empty($ad->banner) && file_exists(FCPATH.'media/banner/'.$ad->banner))
								? base_url('media/banner/'.$ad->banner)
								: base_url('assets/themes/ad_placeholder.jpg');
					?>
						<tr>
							<td class="text-center font-weight-600 text-muted"><?=$counter?></td>
							<td>
								<img src="<?=$banner_img?>" alt="<?=htmlspecialchars($ad->title)?>" class="rounded shadow-xs" style="width: 52px; height: 38px; object-fit: cover; border: 1px solid #e2e8f0;">
							</td>
							<td>
								<span class="font-weight-700 text-dark d-block text-truncate" style="max-width: 220px;" title="<?=htmlspecialchars($ad->title)?>">
									<?=htmlspecialchars($ad->title)?>
								</span>
								<small class="text-muted"><i class="far fa-calendar-alt mr-1"></i> <?=date('d M Y', strtotime($ad->date_uploaded))?></small>
							</td>
							<td class="text-center font-weight-600">
								<span class="badge badge-light font-weight-600 px-2 py-1" style="background: #f1f5f9; border-radius: 6px;">
									<i class="far fa-question-circle mr-1 text-primary"></i> <?=$ad->total_questions?>
								</span>
							</td>
							<td class="font-weight-700 text-dark">
								<?=number_format((float)$ad->budget_allocated)?>
							</td>
							<td class="text-secondary font-weight-600">
								<?=number_format((float)$ad->cost_per_click)?> TZS
							</td>
							<td class="text-center font-weight-700 text-primary">
								<?=number_format($ad->total_views)?>
							</td>
							<td class="font-weight-700 text-dark">
								<?=number_format($ad->total_spent)?> <span class="text-muted small">TZS</span>
							</td>
							<td class="text-center">
								<?=$status_badge?>
							</td>
							<td class="text-right pr-4">
								<a href="<?=base_url('business/ads')?>" class="btn btn-sm btn-outline-primary font-weight-600 px-2 py-1" style="border-radius: 6px; font-size: 12px;">
									<i class="fas fa-eye mr-1"></i> Details
								</a>
							</td>
						</tr>
					<?php 
						}
					} else { ?>
						<tr>
							<td colspan="10" class="text-center py-5">
								<div class="p-4">
									<div class="mb-3" style="width: 64px; height: 64px; border-radius: 50%; background: #f8fafc; display: inline-flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 28px;">
										<i class="fas fa-bullhorn"></i>
									</div>
									<h6 class="font-weight-700 text-secondary mb-1">No ad campaigns found</h6>
									<p class="text-muted small mb-3">You haven't launched any advertising campaigns yet. Create one now to reach thousands of targeted consumers!</p>
									<a href="<?=base_url('business/new_ads')?>" class="btn btn-primary font-weight-600 px-3 py-2" style="border-radius: 8px; font-size: 13px;">
										<i class="fas fa-plus mr-1"></i> Create Your First Campaign
									</a>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Recent Viewer Engagements Section -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
	<div class="card-header bg-white border-bottom p-3 px-4 d-flex justify-content-between align-items-center">
		<div class="d-flex align-items-center">
			<div class="mr-2" style="width: 32px; height: 32px; border-radius: 8px; background: rgba(16,185,129,0.1); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 15px;">
				<i class="fas fa-history"></i>
			</div>
			<h5 class="mb-0 font-weight-700 text-dark" style="font-size: 17px;">Recent Viewer Activity</h5>
		</div>
		<span class="badge badge-light text-muted font-weight-600 px-3 py-1" style="background: #f1f5f9; border-radius: 8px;">
			Real-time user rewards
		</span>
	</div>
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-hover table-center align-middle mb-0">
				<thead class="bg-light text-muted" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
					<tr>
						<th class="text-center" style="width: 50px;">#</th>
						<th>Viewer</th>
						<th>Ad Campaign</th>
						<th class="text-center">Quiz Score</th>
						<th class="text-center">Reward Paid</th>
						<th class="text-right pr-4">Time</th>
					</tr>
				</thead>
				<tbody style="font-size: 13.5px;">
					<?php 
					if(!empty($recent_clicks)){
						$clickCount = 0;
						foreach($recent_clicks as $click){
							$clickCount++;
							$viewer_name = !empty($click->user_name) ? htmlspecialchars($click->user_name) : 'Anonymous User';
							$viewer_avatar = (!empty($click->user_avatar) && file_exists(FCPATH.'media/avatar/'.$click->user_avatar))
								? base_url('media/avatar/'.$click->user_avatar)
								: base_url('assets/img/user-default.png');
					?>
						<tr>
							<td class="text-center font-weight-600 text-muted"><?=$clickCount?></td>
							<td>
								<div class="d-flex align-items-center">
									<img src="<?=$viewer_avatar?>" alt="<?=$viewer_name?>" class="rounded-circle mr-2" style="width: 32px; height: 32px; object-fit: cover; border: 1px solid #e2e8f0;">
									<span class="font-weight-600 text-dark"><?=$viewer_name?></span>
								</div>
							</td>
							<td>
								<span class="font-weight-700 text-dark d-block text-truncate" style="max-width: 260px;" title="<?=htmlspecialchars($click->title)?>">
									<?=htmlspecialchars($click->title)?>
								</span>
							</td>
							<td class="text-center">
								<span class="badge badge-pill font-weight-700 px-2 py-1" style="background: #e0f2fe; color: #0284c7;">
									<?=$click->correct_answer?> / <?=$click->total_question?>
								</span>
							</td>
							<td class="text-center">
								<span class="badge badge-success-light font-weight-700 px-2 py-1" style="color: #10b981; background: rgba(16,185,129,0.12); border-radius: 6px;">
									+<?=number_format((float)$click->total_cash)?> TZS
								</span>
							</td>
							<td class="text-right pr-4 text-muted small">
								<i class="far fa-clock mr-1"></i> <?=date('d M, H:i', strtotime($click->date_clicked))?>
							</td>
						</tr>
					<?php 
						}
					} else { ?>
						<tr>
							<td colspan="6" class="text-center py-4 text-muted">
								<i class="fas fa-info-circle mr-1"></i> No viewer interactions recorded yet. Once your active ads are seen and answered by users, records will show here.
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>