<?php
$total_bonus = 0;
if(!empty($bonuses)){
	foreach($bonuses as $b){
		$total_bonus += (float)($b->amount_earned ?? 0);
	}
}
?>

<!-- Bonus Summary Widget -->
<div class="row mb-4">
	<div class="col-md-6 mb-3 mb-md-0">
		<div class="card border-0 shadow-sm h-100" style="border-radius: 14px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #ffffff;">
			<div class="card-body p-4 d-flex align-items-center">
				<div class="stat-icon-wrap mr-3" style="width: 54px; height: 54px; border-radius: 14px; background: rgba(255, 255, 255, 0.2); color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0;">
					<i class="fas fa-gift"></i>
				</div>
				<div>
					<span class="text-white-50 text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Total Bonuses Earned</span>
					<h3 class="font-weight-800 text-white mb-0 mt-1" style="font-size: 26px;"><?=number_format($total_bonus)?> <span style="font-size: 16px; font-weight: 600;">TZS</span></h3>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card border-0 shadow-sm h-100" style="border-radius: 14px;">
			<div class="card-body p-4 d-flex align-items-center">
				<div class="stat-icon-wrap mr-3" style="width: 54px; height: 54px; border-radius: 14px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0;">
					<i class="fas fa-award"></i>
				</div>
				<div>
					<span class="text-muted text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Bonus Activities</span>
					<h3 class="font-weight-800 text-dark mb-0 mt-1" style="font-size: 26px;"><?=count($bonuses ?? [])?></h3>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
	<div class="card-header bg-white border-bottom p-3 px-4 d-flex justify-content-between align-items-center">
		<div class="d-flex align-items-center">
			<i class="fas fa-gift text-success mr-2" style="font-size: 18px;"></i>
			<h5 class="mb-0 font-weight-700 text-dark" style="font-size: 17px;">Bonus Reward History</h5>
		</div>
	</div>
	<div class="card-body p-0">
		<?php if(!empty($bonuses)){ ?>
			<div class="table-responsive">
				<table class="table table-hover table-center align-middle datatable mb-0 w-100">
					<thead class="bg-light text-muted" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
						<tr>
							<th class="text-center" style="width: 50px;">#</th>
							<th>Question</th>
							<th>Submitted Answer</th>
							<th class="text-center">Bonus Earned</th>
							<th class="text-right pr-4">Date</th>
						</tr>
					</thead>
					<tbody style="font-size: 13.5px;">
						<?php
							$counter = 0;
							foreach ($bonuses as $bonus) {
								$counter++;
						?>
							<tr>
								<td class="text-center font-weight-600 text-muted"><?=$counter?></td>
								<td>
									<span class="font-weight-600 text-dark"><?=htmlspecialchars($bonus->question)?></span>
								</td>
								<td>
									<span class="badge badge-light text-secondary font-weight-600 px-2 py-1" style="background: #f1f5f9; border-radius: 6px;">
										<?=htmlspecialchars($bonus->answer)?>
									</span>
								</td>
								<td class="text-center">
									<span class="badge badge-success-light font-weight-700 px-2 py-1" style="font-size: 13px; color: #10b981; background: rgba(16,185,129,0.12); border-radius: 6px;">
										+<?=number_format((float)$bonus->amount_earned)?> TZS
									</span>
								</td>
								<td class="text-right pr-4 text-muted small">
									<i class="far fa-calendar-alt mr-1"></i> <?=date("d M Y, H:i", strtotime($bonus->answered_date))?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>		
			</div>
		<?php } else { ?>
			<div class="text-center py-5">
				<div class="p-4">
					<i class="fas fa-gift text-muted mb-3" style="font-size: 40px; color: #cbd5e1;"></i>
					<h6 class="font-weight-700 text-secondary">No bonus rewards earned yet</h6>
					<p class="text-muted small mb-0">Answer quiz questions accurately during ad views to earn extra cash bonuses!</p>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		if ($('.datatable').length > 0) {
	        $('.datatable').DataTable({
	            "bFilter": false,
	            "searching": true,
	            "language": {
	                "search": "_INPUT_",
	                "searchPlaceholder": "Search bonuses..."
	            }
	        });
	    }
	});
</script>