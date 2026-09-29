<!-- Transaction Details Header -->
<div class="d-flex align-items-center justify-content-between mb-4">
	<div>
		<h4 class="font-weight-800 text-dark mb-1" style="font-size: 22px;">Transaction Details</h4>
		<p class="text-muted small mb-0">Detailed financial record and campaign payout breakdown.</p>
	</div>
	<a href="<?=base_url('business/transactions')?>" class="btn btn-outline-secondary font-weight-600 px-3 py-2" style="border-radius: 10px; font-size: 13px;">
		<i class="fas fa-arrow-left mr-1"></i> Back to Transactions
	</a>
</div>

<?php if(!empty($info)){ 
	$type_label = ucwords(str_replace('_', ' ', $info['transaction_type']));
	$status_label = ($info['is_complete'] == '0' || $info['is_complete'] === null) ? 'Completed' : 'Pending';
	$status_class = ($info['is_complete'] == '0' || $info['is_complete'] === null) ? 'badge-success' : 'badge-warning';
	
	$amount_val = (!empty($info['credit']) && (float)$info['credit'] > 0) 
		? '+'.number_format((float)$info['credit']).' TZS'
		: '-'.number_format((float)$info['debit']).' TZS';
	$amount_color = (!empty($info['credit']) && (float)$info['credit'] > 0) ? 'text-success' : 'text-danger';

	$banner_img = (!empty($info['ad_banner']) && file_exists(FCPATH.'media/banner/'.$info['ad_banner']))
		? base_url('media/banner/'.$info['ad_banner'])
		: base_url('assets/themes/ad_placeholder.jpg');
?>
	<div class="row">
		<div class="col-lg-8 mx-auto">
			<div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
				<!-- Top Receipt Header Banner -->
				<div class="card-header p-4 text-center" style="background: linear-gradient(135deg, #0f2942 0%, #1e3a8a 100%); color: #ffffff;">
					<div class="mb-2" style="width: 54px; height: 54px; border-radius: 50%; background: rgba(255,255,255,0.15); display: inline-flex; align-items: center; justify-content: center; font-size: 22px;">
						<i class="fas fa-receipt"></i>
					</div>
					<h4 class="font-weight-800 text-white mb-1">Transaction Voucher</h4>
					<p class="text-white-50 small mb-2">Reference #TXN-<?=str_pad($info['id'], 6, '0', STR_PAD_LEFT)?></p>
					<h2 class="font-weight-800 text-white mb-0" style="font-size: 32px;"><?=$amount_val?></h2>
				</div>

				<div class="card-body p-4">
					<!-- Transaction Meta -->
					<div class="row border-bottom pb-3 mb-3">
						<div class="col-6 mb-2">
							<span class="text-muted small text-uppercase font-weight-600 d-block">Transaction Type</span>
							<span class="font-weight-700 text-dark" style="font-size: 15px;"><?=$type_label?></span>
						</div>
						<div class="col-6 mb-2 text-right">
							<span class="text-muted small text-uppercase font-weight-600 d-block">Status</span>
							<span class="badge badge-pill <?=$status_class?> font-weight-700 px-3 py-1" style="font-size: 12px;"><?=$status_label?></span>
						</div>
						<div class="col-6">
							<span class="text-muted small text-uppercase font-weight-600 d-block">Date & Time</span>
							<span class="font-weight-600 text-dark"><?=date("d M Y, H:i:s", strtotime($info['createdDate']))?></span>
						</div>
						<div class="col-6 text-right">
							<span class="text-muted small text-uppercase font-weight-600 d-block">Payment Method</span>
							<span class="font-weight-600 text-dark">24ads Wallet / Pay-Per-View</span>
						</div>
					</div>

					<!-- Linked Campaign Info -->
					<?php if(!empty($info['ad_title'])){ ?>
						<h6 class="font-weight-700 text-dark mb-3"><i class="fas fa-bullhorn text-primary mr-1"></i> Associated Campaign</h6>
						<div class="p-3 mb-4 rounded d-flex align-items-center" style="background: #f8fafc; border: 1px solid #e2e8f0;">
							<img src="<?=$banner_img?>" alt="Banner" class="rounded mr-3" style="width: 70px; height: 50px; object-fit: cover;">
							<div>
								<h6 class="font-weight-700 text-dark mb-1"><?=htmlspecialchars($info['ad_title'])?></h6>
								<div class="small text-muted">
									<span class="mr-3">Budget: <b><?=number_format((float)($info['budget_allocated'] ?? 0))?> TZS</b></span>
									<span>Cost/View: <b><?=number_format((float)($info['cost_per_click'] ?? 0))?> TZS</b></span>
								</div>
							</div>
						</div>
					<?php } ?>

					<!-- Recipient / Viewer Info -->
					<?php if(!empty($info['recipient_name'])){ ?>
						<h6 class="font-weight-700 text-dark mb-3"><i class="fas fa-user-check text-success mr-1"></i> Rewarded Viewer</h6>
						<div class="p-3 mb-4 rounded d-flex align-items-center justify-content-between" style="background: #f8fafc; border: 1px solid #e2e8f0;">
							<div class="d-flex align-items-center">
								<div class="mr-3" style="width: 44px; height: 44px; border-radius: 50%; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: 700;">
									<?=strtoupper(substr($info['recipient_name'], 0, 1))?>
								</div>
								<div>
									<h6 class="font-weight-700 text-dark mb-0"><?=htmlspecialchars($info['recipient_name'])?></h6>
									<span class="text-muted small"><?=htmlspecialchars($info['recipient_phone'] ?? $info['recipient_email'] ?? 'Verified user')?></span>
								</div>
							</div>
							<span class="badge badge-light text-muted font-weight-600 px-2 py-1">Direct Commission</span>
						</div>
					<?php } ?>

					<div class="text-center pt-2">
						<button type="button" class="btn btn-outline-secondary font-weight-600 px-4 mr-2" onclick="window.print();" style="border-radius: 8px;">
							<i class="fas fa-print mr-1"></i> Print Voucher
						</button>
						<a href="<?=base_url('business/transactions')?>" class="btn btn-primary font-weight-600 px-4" style="border-radius: 8px;">
							<i class="fas fa-list mr-1"></i> All Transactions
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="card border-0 shadow-sm p-5 text-center" style="border-radius: 16px;">
		<i class="fas fa-exclamation-circle text-muted mb-3" style="font-size: 48px;"></i>
		<h5 class="font-weight-700 text-dark">Transaction Not Found</h5>
		<p class="text-muted small mb-3">The requested transaction voucher does not exist or has been removed.</p>
		<a href="<?=base_url('business/transactions')?>" class="btn btn-primary btn-sm font-weight-600 mx-auto" style="border-radius: 8px; max-width: 200px;">
			Return to Transactions
		</a>
	</div>
<?php } ?>
