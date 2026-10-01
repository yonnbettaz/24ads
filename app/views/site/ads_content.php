<?php 
$ad = (!empty($info) && is_array($info)) ? $info[0] : null;
?>

<!-- Breadcrumb Navigation -->
<div class="breadcrumb-bar" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 18px 0; margin-bottom: 30px;">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-12 col-12">
				<nav aria-label="breadcrumb" class="page-breadcrumb">
					<ol class="breadcrumb mb-0 bg-transparent p-0" style="font-size: 13.5px;">
						<li class="breadcrumb-item"><a href="<?=base_url()?>" class="text-primary font-weight-600"><i class="fas fa-home mr-1"></i> Home</a></li>
						<li class="breadcrumb-item"><a href="<?=base_url()?>" class="text-muted font-weight-600">Active Ads</a></li>
						<li class="breadcrumb-item active text-dark font-weight-700 text-truncate" aria-current="page" style="max-width: 320px;">
							<?=!empty($ad) ? htmlspecialchars($ad['title']) : 'Ad Story'?>
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="content" style="padding-bottom: 60px;">
	<div class="container-fluid">
		<?php if(!empty($is_preview_mode)){ ?>
			<div class="alert alert-warning border-0 shadow-sm mb-4 font-weight-700 d-flex align-items-center" style="border-radius: 12px; background: #fffbeb; color: #b45309; border-left: 5px solid #f59e0b !important;">
				<i class="fas fa-exclamation-triangle fa-lg mr-3"></i>
				<div>
					<span><?=htmlspecialchars($preview_notice ?? 'Preview Mode')?></span>
					<span class="d-block small text-muted font-weight-normal">This advertisement is hidden from public listings and can only be seen by administrators or the campaign owner.</span>
				</div>
			</div>
		<?php } ?>
		<?php if(!empty($ad)){ 
			$banner_img = (!empty($ad['banner']) && file_exists(FCPATH.'media/banner/'.$ad['banner']))
				? base_url('media/banner/'.$ad['banner'])
				: base_url('assets/themes/ad_placeholder.jpg');

			$biz_logo = (!empty($ad['business_logo']) && file_exists(FCPATH.'media/logo/'.$ad['business_logo']))
				? base_url('media/logo/'.$ad['business_logo'])
				: base_url('assets/img/user-default.png');

			$reward_amount = (float)($ad['cost_per_click'] ?? 0);
			$timer_mins = !empty($ad['question_timer']) ? $ad['question_timer'] : 2;
			$is_logged_in = !empty($this->session->userdata('24ads_user_idetification'));
		?>
			<div class="row">
				<!-- Main Ad Content Column -->
				<div class="col-lg-8 mb-4">
					<div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
						<!-- Hero Banner Image -->
						<div class="position-relative" style="background: #0f172a; max-height: 420px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
							<img src="<?=$banner_img?>" alt="<?=htmlspecialchars($ad['title'])?>" class="img-fluid w-100" style="object-fit: cover; max-height: 420px;">
							<div class="position-absolute" style="top: 16px; right: 16px;">
								<span class="badge badge-pill badge-warning font-weight-800 px-3 py-2 shadow-sm text-dark" style="font-size: 13px; letter-spacing: 0.5px;">
									<i class="fas fa-coins mr-1"></i> Earn +<?=number_format($reward_amount)?> TZS
								</span>
							</div>
						</div>

						<div class="card-body p-4 p-md-5">
							<!-- Ad Headline & Publisher Metadata -->
							<div class="border-bottom pb-4 mb-4">
								<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
									<div class="d-flex align-items-center">
										<img src="<?=$biz_logo?>" alt="<?=htmlspecialchars($ad['business_name'] ?? 'Publisher')?>" class="rounded-circle mr-2 shadow-xs" style="width: 42px; height: 42px; object-fit: cover; border: 1.5px solid #e2e8f0;">
										<div>
											<span class="text-muted small d-block">Published by</span>
											<h6 class="font-weight-700 text-dark mb-0"><?=htmlspecialchars($ad['business_name'] ?? 'Verified Business')?></h6>
										</div>
									</div>
									<div class="d-flex align-items-center text-muted small">
										<span class="mr-3"><i class="far fa-calendar-alt mr-1"></i> <?=date('d M Y', strtotime($ad['date_uploaded']))?></span>
										<span><i class="far fa-clock mr-1"></i> <?=$timer_mins?> mins quiz</span>
									</div>
								</div>

								<h1 class="font-weight-800 text-dark mb-0" style="font-size: 26px; line-height: 1.35;">
									<?=htmlspecialchars($ad['title'])?>
								</h1>
							</div>

							<!-- Full Ad Content / Promotional Story -->
							<div class="ad-story-body text-secondary mb-4" style="font-size: 16px; line-height: 1.8; color: #334155;">
								<?=nl2br(htmlspecialchars($ad['contents']))?>
							</div>

							<!-- Advertiser Target Website Link -->
							<?php if(!empty($ad['url'])){ ?>
								<div class="p-3 mb-4 rounded d-flex flex-wrap align-items-center justify-content-between" style="background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 12px;">
									<div class="d-flex align-items-center mb-2 mb-md-0">
										<div class="mr-3" style="width: 40px; height: 40px; border-radius: 10px; background: rgba(30,58,138,0.1); color: #1e3a8a; display: flex; align-items: center; justify-content: center; font-size: 18px;">
											<i class="fas fa-globe"></i>
										</div>
										<div>
											<h6 class="font-weight-700 text-dark mb-0">Learn More from Advertiser</h6>
											<span class="text-muted small">Visit the official page for products & special inquiries</span>
										</div>
									</div>
									<a href="<?=htmlspecialchars($ad['url'])?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary font-weight-700 px-3 py-2" style="border-radius: 8px; font-size: 13px;">
										Visit Link <i class="fas fa-external-link-alt ml-1"></i>
									</a>
								</div>
							<?php } ?>

							<!-- Interactive Verification Callout Box -->
							<div class="p-4 rounded text-white shadow-sm mt-4" style="background: linear-gradient(135deg, #0f2942 0%, #1e3a8a 100%); border-radius: 16px;">
								<div class="row align-items-center">
									<div class="col-md-8 mb-3 mb-md-0">
										<div class="d-flex align-items-center mb-2">
											<span class="badge badge-warning text-dark font-weight-700 px-2 py-1 mr-2" style="font-size: 11px;">GET PAID NOW</span>
											<span class="text-white-50 small"><i class="fas fa-check-circle mr-1"></i> Instant Mobile Money Reward</span>
										</div>
										<h4 class="font-weight-800 text-white mb-1" style="font-size: 20px;">Ready to answer the quiz?</h4>
										<p class="text-white-50 mb-0 small">
											Answer the interactive questions based on the content above to receive <strong><?=number_format($reward_amount)?> TZS</strong> directly in your wallet!
										</p>
									</div>
									<div class="col-md-4 text-md-right">
										<?php if($is_logged_in){ ?>
											<a href="<?=base_url('home/ads_questions?ads='.$ad['id'])?>" class="btn btn-warning btn-lg font-weight-800 shadow-sm px-4 py-3" style="border-radius: 12px; font-size: 15px;">
												<i class="fas fa-play-circle mr-1"></i> Start Quiz
											</a>
										<?php } else { ?>
											<a href="javascript:void(0);" data-toggle="modal" data-target="#login_popup" class="btn btn-warning btn-lg font-weight-800 shadow-sm px-4 py-3" style="border-radius: 12px; font-size: 15px;">
												<i class="fas fa-sign-in-alt mr-1"></i> Login to Earn
											</a>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Right Sidebar Column -->
				<div class="col-lg-4">
					<!-- Publisher Card -->
					<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
						<div class="card-body p-4 text-center">
							<img src="<?=$biz_logo?>" alt="<?=htmlspecialchars($ad['business_name'] ?? 'Publisher')?>" class="rounded-circle mb-3 shadow-sm" style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #e2e8f0;">
							<h5 class="font-weight-800 text-dark mb-1"><?=htmlspecialchars($ad['business_name'] ?? 'Business')?></h5>
							<span class="badge badge-pill badge-success-light font-weight-600 px-3 py-1 mb-3" style="color: #10b981; background: rgba(16,185,129,0.12); font-size: 11.5px;">
								<i class="fas fa-check-circle mr-1"></i> Verified Advertiser
							</span>

							<div class="text-left border-top pt-3 mt-2" style="font-size: 13px;">
								<?php if(!empty($ad['region']) || !empty($ad['district'])){ ?>
									<div class="d-flex align-items-center mb-2 text-muted">
										<i class="fas fa-map-marker-alt text-primary mr-2" style="width: 16px;"></i>
										<span><?=htmlspecialchars(trim(($ad['district'] ?? '').', '.($ad['region'] ?? ''), ', '))?></span>
									</div>
								<?php } ?>
								<?php if(!empty($ad['business_phone'])){ ?>
									<div class="d-flex align-items-center mb-2 text-muted">
										<i class="fas fa-phone-alt text-success mr-2" style="width: 16px;"></i>
										<span><?=htmlspecialchars($ad['business_phone'])?></span>
									</div>
								<?php } ?>
								<?php if(!empty($ad['business_email'])){ ?>
									<div class="d-flex align-items-center text-muted">
										<i class="fas fa-envelope text-info mr-2" style="width: 16px;"></i>
										<span><?=htmlspecialchars($ad['business_email'])?></span>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>

					<!-- How It Works Card -->
					<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
						<div class="card-header bg-white border-bottom p-3 px-4">
							<h6 class="mb-0 font-weight-700 text-dark"><i class="fas fa-lightbulb text-warning mr-2"></i> How to Earn Cash</h6>
						</div>
						<div class="card-body p-4">
							<div class="d-flex mb-3">
								<div class="mr-3 font-weight-800 text-primary" style="width: 28px; height: 28px; border-radius: 50%; background: #e0f2fe; display: flex; align-items: center; justify-content: center; font-size: 13px;">1</div>
								<div>
									<h6 class="font-weight-700 text-dark mb-1" style="font-size: 14px;">Read Carefully</h6>
									<p class="text-muted small mb-0">Read the promotional story above to find key facts and details.</p>
								</div>
							</div>
							<div class="d-flex mb-3">
								<div class="mr-3 font-weight-800 text-success" style="width: 28px; height: 28px; border-radius: 50%; background: rgba(16,185,129,0.12); display: flex; align-items: center; justify-content: center; font-size: 13px;">2</div>
								<div>
									<h6 class="font-weight-700 text-dark mb-1" style="font-size: 14px;">Answer Questions</h6>
									<p class="text-muted small mb-0">Click 'Start Quiz' and select correct answers before time runs out.</p>
								</div>
							</div>
							<div class="d-flex">
								<div class="mr-3 font-weight-800 text-warning" style="width: 28px; height: 28px; border-radius: 50%; background: rgba(245,158,11,0.15); display: flex; align-items: center; justify-content: center; font-size: 13px;">3</div>
								<div>
									<h6 class="font-weight-700 text-dark mb-1" style="font-size: 14px;">Collect Cash</h6>
									<p class="text-muted small mb-0">Earn real Tanzanian Shillings credited immediately to your balance.</p>
								</div>
							</div>
						</div>
					</div>

					<!-- More Active Ads Widget -->
					<?php if(!empty($related_ads)){ ?>
						<div class="card border-0 shadow-sm" style="border-radius: 16px;">
							<div class="card-header bg-white border-bottom p-3 px-4">
								<h6 class="mb-0 font-weight-700 text-dark"><i class="fas fa-fire text-danger mr-2"></i> Other Active Campaigns</h6>
							</div>
							<div class="card-body p-3">
								<?php foreach($related_ads as $rel_ad){ 
									$rel_banner = (!empty($rel_ad->banner) && file_exists(FCPATH.'media/banner/'.$rel_ad->banner))
										? base_url('media/banner/'.$rel_ad->banner)
										: base_url('assets/themes/ad_placeholder.jpg');
								?>
									<a href="<?=base_url('home/ads_content?ads='.$rel_ad->id)?>" class="d-flex align-items-center p-2 rounded mb-2 text-decoration-none text-dark hover-shadow-xs" style="transition: background 0.2s ease;">
										<img src="<?=$rel_banner?>" alt="<?=htmlspecialchars($rel_ad->title)?>" class="rounded mr-3" style="width: 60px; height: 44px; object-fit: cover; border: 1px solid #e2e8f0;">
										<div class="overflow-hidden">
											<h6 class="font-weight-700 text-dark mb-1 text-truncate" style="font-size: 13px;" title="<?=htmlspecialchars($rel_ad->title)?>">
												<?=htmlspecialchars($rel_ad->title)?>
											</h6>
											<span class="badge badge-pill badge-warning text-dark font-weight-700 px-2 py-0" style="font-size: 11px;">
												+<?=number_format((float)$rel_ad->cost_per_click)?> TZS
											</span>
										</div>
									</a>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php } else { ?>
			<!-- Empty State when Ad Not Found -->
			<div class="row justify-content-center py-5">
				<div class="col-md-6 text-center">
					<div class="card border-0 shadow-sm p-5" style="border-radius: 16px;">
						<div class="mb-3" style="width: 70px; height: 70px; border-radius: 50%; background: #f1f5f9; display: inline-flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 32px;">
							<i class="fas fa-bullhorn"></i>
						</div>
						<h4 class="font-weight-800 text-dark mb-2">Campaign Not Found</h4>
						<p class="text-muted small mb-4">The advertisement you are trying to view is either inactive, expired, or has reached its reward budget.</p>
						<a href="<?=base_url()?>" class="btn btn-primary font-weight-700 px-4 py-2" style="border-radius: 8px;">
							<i class="fas fa-arrow-left mr-1"></i> Browse Available Ads
						</a>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>