<?php
$total_cash_clicked = 0;
$total_clicks = count($results ?? []);
if(!empty($results)){
    foreach($results as $r){
        $total_cash_clicked += (float)($r->total_cash ?? 0);
    }
}
$correct = (int)($stats['correct_answers'] ?? 0);
$incorrect = (int)($stats['incorrect_answers'] ?? 0);
$total_answers = $correct + $incorrect;
$accuracy_rate = $total_answers > 0 ? round(($correct / $total_answers) * 100) : 100;
?>

<!-- 3 KPI Summary Cards -->
<div class="row mb-4">
	<div class="col-sm-6 col-lg-4 mb-3 mb-lg-0">
		<div class="card border-0 shadow-sm h-100 stat-kpi-card" style="border-radius: 16px; background: #ffffff; transition: transform 0.2s ease, box-shadow 0.2s ease;">
			<div class="card-body p-3 p-md-4 d-flex align-items-center">
				<div class="stat-icon-wrap mr-3" style="width: 52px; height: 52px; border-radius: 14px; background: rgba(255, 107, 44, 0.12); color: #ff6b2c; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;">
					<i class="fas fa-mouse-pointer"></i>
				</div>
				<div>
					<span class="text-muted text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Recent Clicks</span>
					<h3 class="font-weight-800 text-dark mb-0 mt-1" style="font-size: 24px;"><?=$total_clicks?> <small class="text-muted" style="font-size: 13px; font-weight: 600;">Ads</small></h3>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-lg-4 mb-3 mb-lg-0">
		<div class="card border-0 shadow-sm h-100 stat-kpi-card" style="border-radius: 16px; background: #ffffff; transition: transform 0.2s ease, box-shadow 0.2s ease;">
			<div class="card-body p-3 p-md-4 d-flex align-items-center">
				<div class="stat-icon-wrap mr-3" style="width: 52px; height: 52px; border-radius: 14px; background: rgba(16, 185, 129, 0.12); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;">
					<i class="fas fa-wallet"></i>
				</div>
				<div>
					<span class="text-muted text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Earned from Clicks</span>
					<h3 class="font-weight-800 text-success mb-0 mt-1" style="font-size: 24px;"><?=number_format($total_cash_clicked)?> <small style="font-size: 13px; font-weight: 600;">TZS</small></h3>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-lg-4">
		<div class="card border-0 shadow-sm h-100 stat-kpi-card" style="border-radius: 16px; background: linear-gradient(135deg, #0f2942 0%, #1e3a8a 100%); color: #ffffff;">
			<div class="card-body p-3 p-md-4 d-flex align-items-center">
				<div class="stat-icon-wrap mr-3" style="width: 52px; height: 52px; border-radius: 14px; background: rgba(255, 255, 255, 0.15); color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;">
					<i class="fas fa-bullseye"></i>
				</div>
				<div>
					<span class="text-white-50 text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Quiz Accuracy</span>
					<h3 class="font-weight-800 text-white mb-0 mt-1" style="font-size: 24px;"><?=$accuracy_rate?>% <small class="text-white-50" style="font-size: 12px; font-weight: 500;">(<?=$correct?>/<?=$total_answers?> correct)</small></h3>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Main Table Card Container -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 18px; overflow: hidden; background: #ffffff;">
	<div class="card-header bg-white border-bottom p-3 px-4 d-flex justify-content-between align-items-center flex-wrap" style="gap: 12px;">
		<div class="d-flex align-items-center">
			<div class="mr-3" style="width: 44px; height: 44px; border-radius: 12px; background: rgba(255, 107, 44, 0.1); color: #ff6b2c; display: flex; align-items: center; justify-content: center; font-size: 20px;">
				<i class="fas fa-history"></i>
			</div>
			<div>
				<h5 class="mb-0 font-weight-800 text-dark" style="font-size: 18px;">Recent Clicked Campaigns</h5>
				<small class="text-muted font-weight-500">Log of rewarded Pay-Per-View ad interactions and quiz earnings</small>
			</div>
		</div>
		<div class="d-flex align-items-center" style="gap: 8px;">
			<a href="<?=base_url()?>" class="btn btn-primary font-weight-700 btn-sm px-3 py-2 shadow-xs" style="border-radius: 8px; font-size: 12.5px;">
				<i class="fas fa-play mr-1"></i> View More Ads
			</a>
			<a href="<?=base_url('personal/ads_history')?>" class="btn btn-light font-weight-600 text-secondary btn-sm px-3 py-2" style="border-radius: 8px; font-size: 12.5px; border: 1px solid #e2e8f0;">
				<i class="fas fa-list-alt mr-1"></i> Full History
			</a>
		</div>
	</div>

	<div class="card-body p-0">
		<?php if(!empty($results)){ ?>
			<div class="p-3">
			<div class="table-responsive">
				<table class="table table-hover table-center align-middle datatable mb-0 w-100" id="recentClickedTable">
					<thead class="bg-light text-muted">
						<tr>
							<th class="text-center" style="width: 40px;">#</th>
							<th>Ad Campaign</th>
							<th>Advertiser</th>
							<th class="text-center">Verification Quiz</th>
							<th class="text-right">Cash Rewarded</th>
							<th class="text-right">Date Clicked</th>
							<th class="text-center" style="width: 80px;">Action</th>
						</tr>
					</thead>
					<tbody style="font-size: 13.5px;">
						<?php
							$counter = 0;
							foreach ($results as $result) {
								$counter++;
								$cash = (float)($result->total_cash ?? 0);
								$cash_display = ($cash > 0) 
									? '<span class="badge badge-success-light font-weight-800 px-3 py-1" style="font-size: 13px; color: #10b981; background: rgba(16,185,129,0.12); border-radius: 8px;">+'.number_format($cash).' TZS</span>'
									: '<span class="text-muted font-weight-500">0 TZS</span>';
								
								$banner_img = (!empty($result->banner) && file_exists(FCPATH.'media/banner/'.$result->banner))
									? base_url('media/banner/'.$result->banner)
									: base_url('assets/themes/ad_placeholder.jpg');

								$publisher = !empty($result->business_name) ? htmlspecialchars($result->business_name) : 'Verified Business';
								$date_str = !empty($result->date_clicked) ? date("d M Y, H:i", strtotime($result->date_clicked)) : 'Recently';
								
								$score_badge_bg = '#e0f2fe';
								$score_badge_color = '#0284c7';
								if($result->total_question > 0 && $result->correct_answer == $result->total_question){
									$score_badge_bg = 'rgba(16,185,129,0.12)';
									$score_badge_color = '#10b981';
								} elseif($result->correct_answer == 0){
									$score_badge_bg = 'rgba(239,68,68,0.1)';
									$score_badge_color = '#ef4444';
								}
						?>
							<tr>
								<td class="text-center font-weight-600 text-muted"><?=$counter?></td>
								<td>
									<div class="d-flex align-items-center">
										<img src="<?=$banner_img?>" alt="<?=htmlspecialchars($result->title)?>" class="rounded shadow-xs mr-3 flex-shrink-0" style="width: 58px; height: 42px; object-fit: cover; border: 1px solid #e2e8f0;">
										<div class="overflow-hidden" style="max-width: 260px;">
											<span class="font-weight-700 text-dark d-block text-truncate" title="<?=htmlspecialchars($result->title)?>" style="font-size: 13.5px;">
												<?=htmlspecialchars($result->title)?>
											</span>
											<small class="text-muted d-block mt-0">
												<i class="far fa-check-circle text-success mr-1"></i> Rewarded View
											</small>
										</div>
									</div>
								</td>
								<td>
									<span class="badge badge-light text-secondary font-weight-600 px-2 py-1" style="background: #f1f5f9; border-radius: 6px; font-size: 12px;">
										<i class="far fa-building text-primary mr-1"></i> <?=$publisher?>
									</span>
								</td>
								<td class="text-center">
									<span class="badge badge-pill font-weight-700 px-3 py-1" style="background: <?=$score_badge_bg?>; color: <?=$score_badge_color?>; font-size: 12.5px;">
										<i class="fas fa-check-double mr-1"></i> <?=$result->correct_answer?> / <?=$result->total_question?>
									</span>
								</td>
								<td class="text-right font-weight-700">
									<?=$cash_display?>
								</td>
								<td class="text-right text-muted small font-weight-500">
									<i class="far fa-calendar-alt text-muted mr-1"></i> <?=$date_str?>
								</td>
								<td class="text-center">
									<a href="<?=base_url('home/ads_content?ads='.$result->id)?>" target="_blank" class="btn btn-sm btn-outline-primary font-weight-600 px-2 py-1" style="border-radius: 6px; font-size: 12px;" title="View Ad Content">
										<i class="fas fa-eye mr-1"></i> View
									</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>		
			</div>
			</div>
		<?php } else { ?>
			<div class="text-center py-5">
				<div class="p-4">
					<div class="mb-3 d-inline-flex align-items-center justify-content-center" style="width:68px;height:68px;border-radius:50%;background:rgba(255,107,44,.1);color:#ff6b2c;font-size:28px;">
						<i class="fas fa-mouse-pointer"></i>
					</div>
					<h5 class="font-weight-800 text-dark mb-1">No Clicked Ads Yet</h5>
					<p class="text-muted small mb-4" style="max-width: 420px; margin: 0 auto;">You haven't viewed any advertising campaigns yet. Explore active campaigns, test your knowledge with quick questions, and earn instant cash rewards!</p>
					<a href="<?=base_url()?>" class="btn btn-primary font-weight-700 px-4 py-2" style="border-radius: 10px; font-size: 14px;">
						<i class="fas fa-play mr-1"></i> Start Viewing Ads
					</a>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		if ($('#recentClickedTable').length > 0) {
	        $('#recentClickedTable').DataTable({
	        	"destroy": true,
	            "searching": true,
	            "ordering": true,
	            "pageLength": 10,
	            "bLengthChange": true,
	            "order": [[0, "asc"]],
	            "columnDefs": [
	            	{ "orderable": false, "targets": [1, 6] }
	            ],
	            "language": {
	                "search": "",
	                "searchPlaceholder": "Search clicked ads...",
	                "lengthMenu": "Show _MENU_ entries",
	                "info": "Showing _START_ to _END_ of _TOTAL_ ads",
	                "infoEmpty": "No ads to show",
	                "zeroRecords": "No matching ads found",
	                "paginate": {
	                	"next": '<i class="fas fa-chevron-right"></i>',
	                	"previous": '<i class="fas fa-chevron-left"></i>'
	                }
	            }
	        });
	    }
	});
</script>