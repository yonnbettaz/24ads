<!-- Welcome Banner -->
<div class="card border-0 shadow-sm mb-4 personal-welcome-card" style="background: linear-gradient(135deg, #0f2942 0%, #1e3a8a 100%); border-radius: 16px; color: #ffffff; overflow: hidden; position: relative;">
	<div class="card-body p-4 position-relative" style="z-index: 2;">
		<div class="row align-items-center">
			<div class="col-lg-8 mb-3 mb-lg-0">
				<div class="d-flex align-items-center mb-2">
					<span class="badge badge-pill badge-warning text-dark font-weight-700 px-3 py-1 mr-2" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Dashboard</span>
					<span class="text-white-50 small"><i class="far fa-calendar-alt mr-1"></i> <?=date('l, d F Y')?></span>
				</div>
				<h2 class="font-weight-800 text-white mb-2" style="font-size: 24px;">Welcome back, <?=htmlspecialchars($this->session->userdata('user_full_name') ?? 'User')?>! 👋</h2>
				<p class="text-white-50 mb-0" style="font-size: 14px; max-width: 580px;">Read high-paying business ads, answer quick questions correctly, and collect instant mobile cash directly to your wallet.</p>
			</div>
			<div class="col-lg-4 text-lg-right">
				<div class="d-flex flex-wrap justify-content-lg-end gap-2">
					<a href="<?=base_url()?>" class="btn btn-warning font-weight-700 shadow-sm px-3 py-2 mr-2 mb-2" style="border-radius: 10px; font-size: 13px;">
						<i class="fas fa-play-circle mr-1"></i> View Ads
					</a>
					<a href="<?=base_url('personal/withdraw_balance')?>" class="btn btn-outline-light font-weight-600 px-3 py-2 mb-2" style="border-radius: 10px; font-size: 13px; border: 1.5px solid rgba(255,255,255,0.4);">
						<i class="fas fa-wallet mr-1"></i> Withdraw
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Background decoration shapes -->
	<div style="position: absolute; right: -40px; top: -40px; width: 180px; height: 180px; background: rgba(255,255,255,0.05); border-radius: 50%; pointer-events: none;"></div>
	<div style="position: absolute; right: 120px; bottom: -50px; width: 120px; height: 120px; background: rgba(255,107,44,0.15); border-radius: 50%; pointer-events: none;"></div>
</div>

<!-- Stats Counter Grid -->
<div class="row mb-4">
	<div class="col-md-4 mb-3 mb-md-0">
		<div class="card border-0 shadow-sm h-100 stat-kpi-card" style="border-radius: 14px; transition: transform 0.2s ease, box-shadow 0.2s ease;">
			<div class="card-body p-4 d-flex align-items-center">
				<div class="stat-icon-wrap mr-3" style="width: 54px; height: 54px; border-radius: 14px; background: rgba(30, 58, 138, 0.1); color: #1e3a8a; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;">
					<i class="fas fa-mouse-pointer"></i>
				</div>
				<div>
					<span class="text-muted text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Total Clicked Ads</span>
					<h3 class="font-weight-800 text-dark mb-0 mt-1" style="font-size: 26px;"><?php echo (int)$clicked_ads; ?></h3>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-4 mb-3 mb-md-0">
		<div class="card border-0 shadow-sm h-100 stat-kpi-card" style="border-radius: 14px; transition: transform 0.2s ease, box-shadow 0.2s ease;">
			<div class="card-body p-4 d-flex align-items-center">
				<div class="stat-icon-wrap mr-3" style="width: 54px; height: 54px; border-radius: 14px; background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;">
					<i class="fas fa-check-circle"></i>
				</div>
				<div>
					<span class="text-muted text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Correct Answers</span>
					<h3 class="font-weight-800 text-success mb-0 mt-1" style="font-size: 26px;"><?php echo (int)($stats['correct_answers'] ?? 0); ?></h3>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="card border-0 shadow-sm h-100 stat-kpi-card" style="border-radius: 14px; transition: transform 0.2s ease, box-shadow 0.2s ease;">
			<div class="card-body p-4 d-flex align-items-center">
				<div class="stat-icon-wrap mr-3" style="width: 54px; height: 54px; border-radius: 14px; background: rgba(239, 68, 68, 0.1); color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;">
					<i class="fas fa-times-circle"></i>
				</div>
				<div>
					<span class="text-muted text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Incorrect Answers</span>
					<h3 class="font-weight-800 text-danger mb-0 mt-1" style="font-size: 26px;"><?php echo (int)($stats['incorrect_answers'] ?? 0); ?></h3>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Recent Clicked Ads Section -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
	<div class="card-header bg-white border-bottom p-3 px-4 d-flex justify-content-between align-items-center">
		<div class="d-flex align-items-center">
			<i class="fas fa-history text-primary mr-2" style="font-size: 18px;"></i>
			<h5 class="mb-0 font-weight-700 text-dark" style="font-size: 17px;">Recent Clicked Ads</h5>
		</div>
		<a href="<?=base_url('personal/ads_history')?>" class="btn btn-sm btn-light font-weight-600 text-primary px-3 py-1" style="border-radius: 8px; font-size: 12px;">
			View Full History <i class="fas fa-arrow-right ml-1"></i>
		</a>
	</div>
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-hover table-center align-middle mb-0">
				<thead class="bg-light text-muted" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
					<tr>
						<th class="text-center" style="width: 50px;">#</th>
						<th style="width: 70px;">Banner</th>
						<th>Ad Title</th>
						<th>Publisher</th>
						<th class="text-center">Questions</th>
						<th class="text-center">Score</th>
						<th class="text-right pr-4">Cash Earned</th>
					</tr>
				</thead>
				<tbody style="font-size: 13.5px;">
					<?php if(!empty($results)){
						$counter = 0;
						foreach ($results as $result) {
							$counter++;
							$cash_display = (!empty($result->total_cash)) 
								? '<span class="badge badge-success-light font-weight-700 px-2 py-1" style="font-size: 13px; color: #10b981; background: rgba(16,185,129,0.12); border-radius: 6px;">+'.number_format((float)$result->total_cash).' TZS</span>'
								: '<span class="text-muted font-weight-500">0 TZS</span>';
							
							$banner_img = (!empty($result->banner) && file_exists(FCPATH.'media/banner/'.$result->banner))
								? base_url('media/banner/'.$result->banner)
								: base_url('assets/themes/ad_placeholder.jpg');
					?>
						<tr>
							<td class="text-center font-weight-600 text-muted"><?=$counter?></td>
							<td>
								<img src="<?=$banner_img?>" alt="Ad Banner" class="rounded shadow-xs" style="width: 50px; height: 36px; object-fit: cover; border: 1px solid #e2e8f0;">
							</td>
							<td>
								<span class="font-weight-700 text-dark d-block text-truncate" style="max-width: 220px;"><?=htmlspecialchars($result->title)?></span>
							</td>
							<td>
								<span class="badge badge-light text-secondary font-weight-600 px-2 py-1" style="background: #f1f5f9; border-radius: 6px;">
									<i class="far fa-building mr-1"></i> <?=htmlspecialchars($result->business_name)?>
								</span>
							</td>
							<td class="text-center font-weight-600 text-secondary">
								<?=$result->total_question?>
							</td>
							<td class="text-center">
								<span class="badge badge-pill font-weight-700 px-2 py-1" style="background: #e0f2fe; color: #0284c7;">
									<?=$result->correct_answer?> / <?=$result->total_question?>
								</span>
							</td>
							<td class="text-right pr-4">
								<?=$cash_display?>
							</td>
						</tr>
					<?php 
						}
					} else { ?>
						<tr>
							<td colspan="7" class="text-center py-5">
								<div class="p-3">
									<i class="fas fa-mouse-pointer text-muted-light mb-3" style="font-size: 38px; color: #cbd5e1;"></i>
									<h6 class="font-weight-700 text-secondary">No clicked ads recorded yet</h6>
									<p class="text-muted small mb-3">Browse our active campaigns and start earning money right away!</p>
									<a href="<?=base_url()?>" class="btn btn-primary btn-sm font-weight-600 px-3 py-2" style="border-radius: 8px;">
										<i class="fas fa-play mr-1"></i> Start Viewing Ads
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