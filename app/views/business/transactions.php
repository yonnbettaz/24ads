<!-- Transactions Financial Header -->
<div class="d-flex align-items-center justify-content-between mb-4">
	<div>
		<h4 class="font-weight-800 text-dark mb-1" style="font-size: 22px;">Transactions & Financials</h4>
		<p class="text-muted small mb-0">Track your advertising budget allocations, viewer payouts, and financial transactions.</p>
	</div>
	<a href="<?=base_url('business/new_ads')?>" class="btn btn-primary font-weight-700 shadow-sm px-3 py-2" style="border-radius: 10px; font-size: 13px;">
		<i class="fas fa-plus-circle mr-1"></i> New Campaign
	</a>
</div>

<!-- 4 Financial KPI Summary Cards -->
<div class="row mb-4">
	<!-- Total Funded Budget -->
	<div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
		<div class="card border-0 shadow-sm h-100" style="border-radius: 14px;">
			<div class="card-body p-3 p-md-4">
				<div class="d-flex align-items-center justify-content-between mb-2">
					<span class="text-muted text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Total Budget Funded</span>
					<div style="width: 42px; height: 42px; border-radius: 10px; background: rgba(30,58,138,0.1); color: #1e3a8a; display: flex; align-items: center; justify-content: center; font-size: 18px;">
						<i class="fas fa-wallet"></i>
					</div>
				</div>
				<h3 class="font-weight-800 text-dark mb-1" style="font-size: 22px;"><?=number_format((float)($summary['total_budget'] ?? 0))?> <small style="font-size: 13px; font-weight: 600;">TZS</small></h3>
				<span class="small text-muted">Across all ad campaigns</span>
			</div>
		</div>
	</div>

	<!-- Total Viewer Payouts / Spend -->
	<div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
		<div class="card border-0 shadow-sm h-100" style="border-radius: 14px;">
			<div class="card-body p-3 p-md-4">
				<div class="d-flex align-items-center justify-content-between mb-2">
					<span class="text-muted text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Total Disbursed</span>
					<div style="width: 42px; height: 42px; border-radius: 10px; background: rgba(239,68,68,0.1); color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 18px;">
						<i class="fas fa-hand-holding-usd"></i>
					</div>
				</div>
				<h3 class="font-weight-800 text-danger mb-1" style="font-size: 22px;"><?=number_format((float)($summary['total_spent'] ?? 0))?> <small style="font-size: 13px; font-weight: 600;">TZS</small></h3>
				<span class="small text-muted">Rewarded to viewers</span>
			</div>
		</div>
	</div>

	<!-- Remaining Balance -->
	<div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
		<div class="card border-0 shadow-sm h-100" style="border-radius: 14px;">
			<div class="card-body p-3 p-md-4">
				<div class="d-flex align-items-center justify-content-between mb-2">
					<span class="text-muted text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Active Balance</span>
					<div style="width: 42px; height: 42px; border-radius: 10px; background: rgba(16,185,129,0.1); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 18px;">
						<i class="fas fa-coins"></i>
					</div>
				</div>
				<h3 class="font-weight-800 text-success mb-1" style="font-size: 22px;"><?=number_format((float)($summary['net_balance'] ?? 0))?> <small style="font-size: 13px; font-weight: 600;">TZS</small></h3>
				<span class="small text-muted">Available for active ads</span>
			</div>
		</div>
	</div>

	<!-- Total Records -->
	<div class="col-sm-6 col-lg-3">
		<div class="card border-0 shadow-sm h-100" style="border-radius: 14px; background: #0f2942; color: #ffffff;">
			<div class="card-body p-3 p-md-4">
				<div class="d-flex align-items-center justify-content-between mb-2">
					<span class="text-white-50 text-uppercase font-weight-600" style="font-size: 11px; letter-spacing: 0.5px;">Transactions</span>
					<div style="width: 42px; height: 42px; border-radius: 10px; background: rgba(255,255,255,0.1); color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 18px;">
						<i class="fas fa-receipt"></i>
					</div>
				</div>
				<h3 class="font-weight-800 text-white mb-1" style="font-size: 22px;"><?=number_format((int)($summary['total_transactions'] ?? 0))?></h3>
				<span class="small text-white-50">Total ledger logs</span>
			</div>
		</div>
	</div>
</div>

<!-- Type Filter Tabs -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
	<div class="card-body p-2">
		<ul class="nav nav-pills custom-status-pills">
			<li class="nav-item mr-2">
				<a class="nav-link font-weight-600 <?=empty($current_type) ? 'active' : ''?>" href="<?=base_url('business/transactions')?>" style="border-radius: 8px; font-size: 13px;">
					All Logs <span class="badge badge-light ml-1"><?=$summary['total_transactions'] ?? 0?></span>
				</a>
			</li>
			<li class="nav-item mr-2">
				<a class="nav-link font-weight-600 <?=$current_type === 'commission' ? 'active' : ''?>" href="<?=base_url('business/transactions?type=commission')?>" style="border-radius: 8px; font-size: 13px;">
					<i class="fas fa-user-check text-success mr-1"></i> Viewer Rewards
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link font-weight-600 <?=$current_type === 'deposit' ? 'active' : ''?>" href="<?=base_url('business/transactions?type=deposit')?>" style="border-radius: 8px; font-size: 13px;">
					<i class="fas fa-arrow-down text-primary mr-1"></i> Deposits / Top-ups
				</a>
			</li>
		</ul>
	</div>
</div>

<!-- Transaction History Table Card -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
	<div class="card-header bg-white border-bottom p-3 px-4 d-flex justify-content-between align-items-center">
		<div class="d-flex align-items-center">
			<div class="mr-2" style="width: 32px; height: 32px; border-radius: 8px; background: rgba(30,58,138,0.1); color: #1e3a8a; display: flex; align-items: center; justify-content: center; font-size: 15px;">
				<i class="fas fa-file-invoice-dollar"></i>
			</div>
			<h5 class="mb-0 font-weight-700 text-dark" style="font-size: 17px;">Transaction Ledger</h5>
		</div>
		<span class="badge badge-light text-muted font-weight-600 px-3 py-1" style="background: #f1f5f9; border-radius: 8px;">
			Audited Records
		</span>
	</div>
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-hover table-center align-middle mb-0">
				<thead class="bg-light text-muted" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
					<tr>
						<th class="text-center" style="width: 50px;">#</th>
						<th>Transaction Type</th>
						<th>Ad Campaign</th>
						<th>Viewer / Recipient</th>
						<th>Amount (TZS)</th>
						<th class="text-center">Status</th>
						<th>Date & Time</th>
						<th class="text-right pr-4">Details</th>
					</tr>
				</thead>
				<tbody style="font-size: 13.5px;">
					<?php 
					if(!empty($records)){
						$counter = 0;
						foreach ($records as $record){
							$counter++;
							
							// Transaction Type Formatting
							$type_label = ucwords(str_replace('_', ' ', $record->transaction_type));
							$type_badge = '';
							if($record->transaction_type == 'commission'){
								$type_badge = '<span class="badge badge-pill font-weight-600 px-2 py-1" style="background: rgba(16,185,129,0.12); color: #10b981;"><i class="fas fa-eye mr-1"></i> Viewer Reward</span>';
							} elseif($record->transaction_type == 'deposit' || $record->transaction_type == 'budget'){
								$type_badge = '<span class="badge badge-pill font-weight-600 px-2 py-1" style="background: rgba(30,58,138,0.12); color: #1e3a8a;"><i class="fas fa-plus-circle mr-1"></i> Budget Funding</span>';
							} else {
								$type_badge = '<span class="badge badge-pill badge-light font-weight-600 px-2 py-1">'.$type_label.'</span>';
							}

							// Amount Display (Credit vs Debit)
							$amount_display = '';
							if(!empty($record->credit) && (float)$record->credit > 0){
								$amount_display = '<span class="font-weight-700 text-success"><i class="fas fa-arrow-down mr-1"></i> +'.number_format((float)$record->credit).' TZS</span>';
							} elseif(!empty($record->debit) && (float)$record->debit > 0){
								$amount_display = '<span class="font-weight-700 text-danger"><i class="fas fa-arrow-up mr-1"></i> -'.number_format((float)$record->debit).' TZS</span>';
							} else {
								$amount_display = '<span class="text-muted font-weight-600">0 TZS</span>';
							}

							// Completion Status
							$status_badge = ($record->is_complete == '0' || $record->is_complete === null)
								? '<span class="badge badge-pill badge-success-light font-weight-700 px-2 py-1" style="color: #10b981; background: rgba(16,185,129,0.12);"><i class="fas fa-check-circle mr-1"></i> Completed</span>'
								: '<span class="badge badge-pill badge-warning-light font-weight-700 px-2 py-1" style="color: #d97706; background: rgba(245,158,11,0.15);"><i class="fas fa-clock mr-1"></i> Pending</span>';

							$banner_img = (!empty($record->ad_banner) && file_exists(FCPATH.'media/banner/'.$record->ad_banner))
								? base_url('media/banner/'.$record->ad_banner)
								: base_url('assets/themes/ad_placeholder.jpg');

							$viewer_name = !empty($record->recipient_name) ? htmlspecialchars($record->recipient_name) : 'Registered Viewer';
							$viewer_avatar = (!empty($record->recipient_avatar) && file_exists(FCPATH.'media/avatar/'.$record->recipient_avatar))
								? base_url('media/avatar/'.$record->recipient_avatar)
								: base_url('assets/img/user-default.png');
					?>
						<tr>
							<td class="text-center font-weight-600 text-muted"><?=$counter?></td>
							<td><?=$type_badge?></td>
							<td>
								<?php if(!empty($record->ad_title)){ ?>
									<div class="d-flex align-items-center">
										<img src="<?=$banner_img?>" alt="Ad" class="rounded mr-2" style="width: 38px; height: 28px; object-fit: cover; border: 1px solid #e2e8f0;">
										<span class="font-weight-700 text-dark d-block text-truncate" style="max-width: 180px;" title="<?=htmlspecialchars($record->ad_title)?>">
											<?=htmlspecialchars($record->ad_title)?>
										</span>
									</div>
								<?php } else { ?>
									<span class="text-muted small">Account General</span>
								<?php } ?>
							</td>
							<td>
								<?php if(!empty($record->recipient_name)){ ?>
									<div class="d-flex align-items-center">
										<img src="<?=$viewer_avatar?>" alt="<?=$viewer_name?>" class="rounded-circle mr-2" style="width: 28px; height: 28px; object-fit: cover; border: 1px solid #e2e8f0;">
										<span class="font-weight-600 text-dark small"><?=$viewer_name?></span>
									</div>
								<?php } else { ?>
									<span class="text-muted small">System Process</span>
								<?php } ?>
							</td>
							<td><?=$amount_display?></td>
							<td class="text-center"><?=$status_badge?></td>
							<td class="text-muted small">
								<i class="far fa-calendar-alt mr-1"></i> <?=date("d M Y, H:i", strtotime($record->createdDate))?>
							</td>
							<td class="text-right pr-4">
								<a href="<?=base_url('business/transaction_info?tx='.$record->id)?>" class="btn btn-sm btn-outline-primary font-weight-600 px-2 py-1" style="border-radius: 6px; font-size: 12px;">
									<i class="fas fa-info-circle mr-1"></i> Info
								</a>
							</td>
						</tr>
					<?php 
						}
					} else { ?>
						<tr>
							<td colspan="8" class="text-center py-5">
								<div class="p-4">
									<div class="mb-3" style="width: 64px; height: 64px; border-radius: 50%; background: #f8fafc; display: inline-flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 28px;">
										<i class="fas fa-receipt"></i>
									</div>
									<h6 class="font-weight-700 text-secondary mb-1">No transaction records found</h6>
									<p class="text-muted small mb-3">When your ads are viewed and rewarded or budgets are updated, all financial logs will appear here.</p>
									<a href="<?=base_url('business/new_ads')?>" class="btn btn-primary font-weight-600 px-3 py-2" style="border-radius: 8px; font-size: 13px;">
										<i class="fas fa-plus mr-1"></i> Create Ad Campaign
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