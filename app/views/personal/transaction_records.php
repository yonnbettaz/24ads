<?php
$net_balance = (float)($summary['total_commission'] ?? 0) - ((float)($summary['total_withdraw'] ?? 0) + (float)($summary['total_charge'] ?? 0));
?>

<!-- 4 Summary KPI Cards -->
<div class="row mb-4">
	<div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
		<div class="card border-0 shadow-sm h-100" style="border-radius: 14px;">
			<div class="card-body p-3">
				<span class="text-muted text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Total Commission</span>
				<h4 class="font-weight-800 text-success mb-0 mt-1" style="font-size: 18px;"><?=number_format((float)($summary['total_commission'] ?? 0))?> TZS</h4>
			</div>
		</div>
	</div>
	
	<div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
		<div class="card border-0 shadow-sm h-100" style="border-radius: 14px;">
			<div class="card-body p-3">
				<span class="text-muted text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Total Withdrawn</span>
				<h4 class="font-weight-800 text-primary mb-0 mt-1" style="font-size: 18px;"><?=number_format((float)($summary['total_withdraw'] ?? 0))?> TZS</h4>
			</div>
		</div>
	</div>
	
	<div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
		<div class="card border-0 shadow-sm h-100" style="border-radius: 14px;">
			<div class="card-body p-3">
				<span class="text-muted text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Total Fees</span>
				<h4 class="font-weight-800 text-warning mb-0 mt-1" style="font-size: 18px;"><?=number_format((float)($summary['total_charge'] ?? 0))?> TZS</h4>
			</div>
		</div>
	</div>
	
	<div class="col-sm-6 col-lg-3">
		<div class="card border-0 shadow-sm h-100" style="border-radius: 14px; background: #0f2942; color: #ffffff;">
			<div class="card-body p-3">
				<span class="text-white-50 text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Current Balance</span>
				<h4 class="font-weight-800 text-white mb-0 mt-1" style="font-size: 18px;"><?=number_format($net_balance)?> TZS</h4>
			</div>
		</div>
	</div>
</div>

<!-- Transaction Records Table -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
	<div class="card-header bg-white border-bottom p-3 px-4 d-flex justify-content-between align-items-center">
		<div class="d-flex align-items-center">
			<i class="fas fa-file-invoice-dollar text-primary mr-2" style="font-size: 18px;"></i>
			<h5 class="mb-0 font-weight-700 text-dark" style="font-size: 17px;">Transaction Records</h5>
		</div>
	</div>
	<div class="card-body p-0">
		<?php if(!empty($records)){ ?>
			<div class="table-responsive">
				<table class="table table-hover table-center align-middle datatable mb-0 w-100">
					<thead class="bg-light text-muted" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
						<tr>
							<th class="text-center" style="width: 50px;">#</th>
							<th>Transaction Type</th>
							<th>Amount (TZS)</th>
							<th>Balance (TZS)</th>
							<th class="text-right pr-4">Date</th>
						</tr>
					</thead>
					<tbody style="font-size: 13.5px;">
						<?php
							$counter = 0;
							$balnc = 0;
							foreach ($records as $record) {
								$counter++;
								$amount_html = "---";
								$balance = "---";
								
								if(!empty($record->credit)){
									$balnc = $balnc + (float)$record->credit;
									$amount_html = '<span class="font-weight-700 text-success"><i class="fas fa-arrow-down mr-1"></i> +'.number_format((float)$record->credit).'</span>';
									$balance = number_format($balnc);
								}
								if(!empty($record->debit)){
									$balnc = $balnc - (float)$record->debit;
									$amount_html = '<span class="font-weight-700 text-danger"><i class="fas fa-arrow-up mr-1"></i> -'.number_format((float)$record->debit).'</span>';
									$balance = number_format($balnc);
								}
						?>
							<tr>
								<td class="text-center font-weight-600 text-muted"><?=$counter?></td>
								<td>
									<span class="badge badge-light font-weight-600 px-2 py-1" style="background: #f1f5f9; color: #334155; border-radius: 6px;">
										<?=htmlspecialchars(ucwords($record->transaction_type))?>
									</span>
								</td>
								<td><?=$amount_html?></td>
								<td><span class="font-weight-700 text-dark"><?=$balance?> TZS</span></td>
								<td class="text-right pr-4 text-muted small">
									<i class="far fa-calendar-alt mr-1"></i> <?=date("d M Y, H:i", strtotime($record->createdDate))?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>		
			</div>
		<?php } else { ?>
			<div class="text-center py-5">
				<div class="p-4">
					<i class="fas fa-file-invoice text-muted mb-3" style="font-size: 40px; color: #cbd5e1;"></i>
					<h6 class="font-weight-700 text-secondary">No transaction records found</h6>
					<p class="text-muted small mb-0">Your credits, ad bonuses, and withdrawal debits will appear here in chronological order.</p>
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
	                "searchPlaceholder": "Search transactions..."
	            }
	        });
	    }
	});
</script>