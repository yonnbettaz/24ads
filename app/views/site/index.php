<!-- ==========================================================================
     HERO SECTION
     ========================================================================== -->
<section class="hero-wrapper" style="background: linear-gradient(135deg, #091a2e 0%, #0f2942 50%, #163859 100%); padding: 60px 0 75px; position: relative; overflow: hidden; color: #ffffff;">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-7 mb-5 mb-lg-0">
				<div class="hero-badge-pill" style="display: inline-flex; align-items: center; padding: 6px 16px; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 50px; font-size: 13px; font-weight: 600; color: #ffffff; margin-bottom: 20px;">
					<span class="pulse-dot" style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; margin-right: 10px; display: inline-block;"></span>
					<span>Tanzania's #1 Pay-Per-View & Rewards Platform</span>
				</div>
				
				<h1 class="hero-title" style="font-size: 42px; line-height: 1.25; font-weight: 800; color: #ffffff; margin-bottom: 18px; letter-spacing: -0.02em;">
					Read Ads, Answer Quiz & <span class="text-gradient" style="background: linear-gradient(135deg, #ff944d 0%, #ff5231 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Earn Real Money</span> Daily
				</h1>
				
				<p class="hero-subtitle" style="font-size: 16px; line-height: 1.6; color: #cbd5e1; margin-bottom: 28px; max-width: 560px;">
					Join thousands of members earning TZS every day by reading verified ads, or boost your business reach with high-conversion targeted Tanzanian campaigns.
				</p>
				
				<div class="hero-actions" style="display: flex; flex-wrap: wrap; gap: 14px; margin-bottom: 32px;">
					<a href="<?=base_url('register')?>" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, #ff7a18 0%, #ff4b2b 100%) !important; border: none; color: #ffffff !important; font-weight: 700; padding: 13px 28px; border-radius: 50px; box-shadow: 0 4px 14px rgba(255, 107, 44, 0.35);">
						<i class="fas fa-rocket mr-2"></i> Start Earning Now
					</a>
					<a href="<?=base_url('register_business')?>" class="btn btn-outline-light btn-lg" style="border: 2px solid rgba(255,255,255,0.4); color: #ffffff !important; background: rgba(255,255,255,0.08); font-weight: 700; padding: 11px 26px; border-radius: 50px;">
						<i class="fas fa-bullhorn mr-2"></i> Post an Ad
					</a>
				</div>
				
				<!-- Hero Integrated Search -->
				<div class="hero-search-box" style="background: rgba(255, 255, 255, 0.98); padding: 6px 8px; border-radius: 50px; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25); max-width: 520px; border: 2px solid rgba(255, 255, 255, 0.2);">
					<form method="GET" action="<?=base_url('home/search_results')?>">
						<div class="input-group" style="display: flex; align-items: center;">
							<span class="search-icon-prefix" style="color: #64748b; padding-left: 14px; font-size: 16px;"><i class="fas fa-search"></i></span>
							<input type="text" name="keyword" value="<?php if(isset($keyword)){ echo htmlspecialchars($keyword);} ?>" class="form-control" placeholder="Search by brand, category or ad keyword..." required style="border: none !important; background: transparent !important; font-size: 14px; padding: 8px 12px; color: #0f172a !important; box-shadow: none !important;">
							<div class="input-group-append">
								<button class="btn btn-primary btn-search" type="submit" style="background: linear-gradient(135deg, #ff7a18 0%, #ff4b2b 100%) !important; border: none; color: #ffffff; padding: 9px 22px; font-size: 13px; font-weight: 700; border-radius: 50px;">
									Find Ads <i class="fas fa-arrow-right ml-1"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			
			<div class="col-lg-5">
				<div class="hero-visual-card" style="background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 20px; padding: 24px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);">
					<div class="d-flex align-items-center justify-content-between mb-3">
						<span class="badge badge-pill badge-success px-3 py-2 font-weight-700" style="background: #10b981; font-size: 12px;">
							<i class="fas fa-bolt mr-1"></i> Live Activity
						</span>
						<small class="text-white-50 font-weight-600">Updated Just Now</small>
					</div>
					
					<!-- Live earning card 1 -->
					<div class="hero-earning-preview" style="display: flex; align-items: center; background: #ffffff; border-radius: 12px; padding: 12px 16px; color: #0f172a; margin-bottom: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.06);">
						<div class="hero-earning-icon" style="width: 42px; height: 42px; border-radius: 10px; background: #ecfdf5; color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-right: 12px; flex-shrink: 0;">
							<i class="fas fa-wallet"></i>
						</div>
						<div class="hero-earning-info" style="flex-grow: 1;">
							<h5 style="font-size: 14px; margin-bottom: 2px; font-weight: 700; color: #0f172a;">Instant Withdrawal</h5>
							<p style="font-size: 12px; color: #64748b; margin-bottom: 0;">Paid via M-Pesa to John M.</p>
						</div>
						<div class="hero-earning-amount" style="font-size: 13px; font-weight: 800; color: #10b981; background: #ecfdf5; padding: 5px 10px; border-radius: 50px;">+15,000 TZS</div>
					</div>
					
					<!-- Live earning card 2 -->
					<div class="hero-earning-preview" style="display: flex; align-items: center; background: #ffffff; border-radius: 12px; padding: 12px 16px; color: #0f172a; margin-bottom: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.06);">
						<div class="hero-earning-icon" style="width: 42px; height: 42px; border-radius: 10px; background: #fff3ec; color: #ff6b2c; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-right: 12px; flex-shrink: 0;">
							<i class="fas fa-award"></i>
						</div>
						<div class="hero-earning-info" style="flex-grow: 1;">
							<h5 style="font-size: 14px; margin-bottom: 2px; font-weight: 700; color: #0f172a;">Quiz Bonus Earned</h5>
							<p style="font-size: 12px; color: #64748b; margin-bottom: 0;">Completed 3 questions</p>
						</div>
						<div class="hero-earning-amount" style="font-size: 13px; font-weight: 800; color: #ff6b2c; background: #fff3ec; padding: 5px 10px; border-radius: 50px;">+500 TZS</div>
					</div>
					
					<!-- Live earning card 3 -->
					<div class="hero-earning-preview" style="display: flex; align-items: center; background: #ffffff; border-radius: 12px; padding: 12px 16px; color: #0f172a; margin-bottom: 0; box-shadow: 0 2px 4px rgba(0,0,0,0.06);">
						<div class="hero-earning-icon" style="width: 42px; height: 42px; border-radius: 10px; background: #eff6ff; color: #3b82f6; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-right: 12px; flex-shrink: 0;">
							<i class="fas fa-ad"></i>
						</div>
						<div class="hero-earning-info" style="flex-grow: 1;">
							<h5 style="font-size: 14px; margin-bottom: 2px; font-weight: 700; color: #0f172a;">High-Paid Ad Live</h5>
							<p style="font-size: 12px; color: #64748b; margin-bottom: 0;">Sponsored by TechHub TZ</p>
						</div>
						<div class="hero-earning-amount" style="font-size: 13px; font-weight: 800; color: #3b82f6; background: #eff6ff; padding: 5px 10px; border-radius: 50px;">Earn Now</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ==========================================================================
     STATS COUNTER BAR
     ========================================================================== -->
<div class="container">
	<div class="stats-bar-section" style="margin-top: -35px; position: relative; z-index: 10; margin-bottom: 45px;">
		<div class="stats-bar-card" style="background: #ffffff; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.1); border: 1px solid #edf2f7; padding: 20px 24px;">
			<div class="row align-items-center">
				<div class="col-lg-3 col-6 mb-3 mb-lg-0">
					<div class="stat-item" style="display: flex; align-items: center;">
						<div class="stat-icon green" style="width: 48px; height: 48px; border-radius: 12px; background: #ecfdf5; color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-right: 14px; flex-shrink: 0;">
							<i class="fas fa-coins"></i>
						</div>
						<div class="stat-data">
							<h3 style="font-size: 22px; font-weight: 800; margin-bottom: 2px; color: #0f172a;">50M+</h3>
							<p style="font-size: 12px; color: #64748b; font-weight: 500; margin-bottom: 0;">TZS Paid to Members</p>
						</div>
					</div>
				</div>
				
				<div class="col-lg-3 col-6 mb-3 mb-lg-0">
					<div class="stat-item" style="display: flex; align-items: center;">
						<div class="stat-icon orange" style="width: 48px; height: 48px; border-radius: 12px; background: #fff3ec; color: #ff6b2c; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-right: 14px; flex-shrink: 0;">
							<i class="fas fa-users"></i>
						</div>
						<div class="stat-data">
							<h3 style="font-size: 22px; font-weight: 800; margin-bottom: 2px; color: #0f172a;">25,000+</h3>
							<p style="font-size: 12px; color: #64748b; font-weight: 500; margin-bottom: 0;">Active Earners</p>
						</div>
					</div>
				</div>
				
				<div class="col-lg-3 col-6">
					<div class="stat-item" style="display: flex; align-items: center;">
						<div class="stat-icon blue" style="width: 48px; height: 48px; border-radius: 12px; background: #eff6ff; color: #3b82f6; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-right: 14px; flex-shrink: 0;">
							<i class="fas fa-bullhorn"></i>
						</div>
						<div class="stat-data">
							<h3 style="font-size: 22px; font-weight: 800; margin-bottom: 2px; color: #0f172a;">1,200+</h3>
							<p style="font-size: 12px; color: #64748b; font-weight: 500; margin-bottom: 0;">Live Brand Ads</p>
						</div>
					</div>
				</div>
				
				<div class="col-lg-3 col-6">
					<div class="stat-item" style="display: flex; align-items: center;">
						<div class="stat-icon purple" style="width: 48px; height: 48px; border-radius: 12px; background: #f5f3ff; color: #8b5cf6; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-right: 14px; flex-shrink: 0;">
							<i class="fas fa-bolt"></i>
						</div>
						<div class="stat-data">
							<h3 style="font-size: 22px; font-weight: 800; margin-bottom: 2px; color: #0f172a;">100% Instant</h3>
							<p style="font-size: 12px; color: #64748b; font-weight: 500; margin-bottom: 0;">Mobile Payouts</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ==========================================================================
     HIGH-PAID FEATURED ADS SECTION
     ========================================================================== -->
<?php if(isset($high_paid_ads) && sizeof($high_paid_ads) > 0){ ?>
<section class="high-paid-section" style="background: #ffffff; padding: 45px 0 55px; border-bottom: 1px solid #edf2f7;">
	<div class="container">
		<div class="row align-items-end mb-4">
			<div class="col-md-8">
				<div class="section-header-modern mb-0">
					<span class="section-tag" style="display: inline-flex; align-items: center; gap: 6px; background: #fff2eb; color: #ff6b2c; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; padding: 5px 12px; border-radius: 50px; margin-bottom: 8px;">
						<i class="fas fa-fire"></i> Top Rewards
					</span>
					<h2 class="section-title-modern" style="font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 4px;">High Paid Ads</h2>
					<p class="section-desc-modern" style="font-size: 15px; color: #64748b; margin-bottom: 0;">Earn the highest rewards per ad by viewing these premium verified campaigns.</p>
				</div>
			</div>
		</div>

		<div class="row">
			<?php 
			$top_ads = array_slice($high_paid_ads, 0, 8);
			foreach ($top_ads as $h_ads){ 
				$banner_img = !empty($h_ads->banner) ? base_url('media/banner/'.$h_ads->banner) : base_url('assets/themes/default_background.jpg');
				$cost = number_format((float)$h_ads->cost_per_click, 0);
			?>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-4">
					<div class="ad-card" style="background: #ffffff; border-radius: 14px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.07); display: flex; flex-direction: column; height: 100%;">
						<div class="ad-card-banner" style="position: relative; width: 100%; height: 175px; overflow: hidden; background: #0f172a;">
							<a href="<?=base_url('home/ads_content?ads='.$h_ads->id);?>" style="display: block; width: 100%; height: 100%;">
								<img src="<?=$banner_img?>" alt="<?=htmlspecialchars($h_ads->title)?>" loading="lazy" style="width: 100% !important; height: 175px !important; max-height: 175px !important; min-height: 175px !important; object-fit: cover !important; display: block !important;" onerror="this.src='<?=base_url('assets/themes/default_background.jpg')?>'">
							</a>
							<div class="ad-reward-badge" style="position: absolute; top: 10px; right: 10px; background: rgba(16, 185, 129, 0.95); backdrop-filter: blur(8px); color: #ffffff; font-size: 12px; font-weight: 800; padding: 4px 10px; border-radius: 50px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); z-index: 2;">
								<i class="fas fa-coins"></i> <?=$cost?> TZS
							</div>
							<div class="ad-business-badge" title="<?=htmlspecialchars($h_ads->business_name)?>" style="position: absolute; bottom: 10px; left: 10px; background: rgba(15, 23, 42, 0.88); backdrop-filter: blur(8px); color: #ffffff; font-size: 11px; font-weight: 600; padding: 4px 10px; border-radius: 50px; max-width: 85%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; z-index: 2;">
								<i class="fas fa-check-circle verified" style="color: #38bdf8;"></i> <?=htmlspecialchars(ucwords($h_ads->business_name))?>
							</div>
						</div>
						
						<div class="ad-card-body" style="padding: 16px; display: flex; flex-direction: column; flex-grow: 1;">
							<h3 class="ad-card-title" style="font-size: 15px; font-weight: 700; line-height: 1.4; margin-bottom: 8px; color: #0f172a; height: 42px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
								<a href="<?=base_url('home/ads_content?ads='.$h_ads->id);?>" title="<?=htmlspecialchars($h_ads->title)?>" style="color: #0f172a;">
									<?=ucwords(get_words($h_ads->title, '10'))?>
								</a>
							</h3>
							
							<div class="ad-card-meta" style="display: flex; align-items: center; justify-content: space-between; padding-top: 10px; margin-top: auto; border-top: 1px dashed #edf2f7;">
								<div class="ad-earning-rate" style="font-size: 13px; font-weight: 800; color: #10b981; display: flex; align-items: center; gap: 4px;">
									<i class="far fa-money-bill-alt"></i> <?=$cost?> TZS
								</div>
								<a href="<?=base_url('home/ads_content?ads='.$h_ads->id);?>" class="ad-btn-read" style="background: #fff2eb; color: #ff6b2c; font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 50px; text-decoration: none;">
									Earn Now <i class="fas fa-arrow-right ml-1"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php } ?>

<!-- ==========================================================================
     HOW IT WORKS (3-STEP PROCESS)
     ========================================================================== -->
<section class="how-it-works-section" style="padding: 65px 0; background: #f8fafc;">
	<div class="container">
		<div class="text-center section-header-modern mb-5">
			<span class="section-tag" style="display: inline-flex; align-items: center; gap: 6px; background: #fff2eb; color: #ff6b2c; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; padding: 5px 12px; border-radius: 50px; margin-bottom: 8px;">
				<i class="fas fa-cogs"></i> Simple Process
			</span>
			<h2 class="section-title-modern" style="font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 4px;">How It Works in 3 Easy Steps</h2>
			<p class="section-desc-modern mx-auto" style="font-size: 15px; color: #64748b;">Start earning money from your phone or computer in less than 2 minutes.</p>
		</div>

		<div class="row">
			<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
				<div class="step-card" style="background: #ffffff; border: 1px solid #edf2f7; border-radius: 16px; padding: 32px 22px; text-align: center; position: relative; height: 100%; box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.05);">
					<div class="step-number" style="position: absolute; top: -14px; left: 50%; transform: translateX(-50%); width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #ff7a18 0%, #ff4b2b 100%); color: #ffffff; font-weight: 800; font-size: 13px; display: flex; align-items: center; justify-content: center;">1</div>
					<div class="step-icon-wrap" style="width: 68px; height: 68px; border-radius: 18px; margin: 10px auto 18px; display: flex; align-items: center; justify-content: center; font-size: 26px; background: #fff2eb; color: #ff6b2c;">
						<i class="fas fa-mouse-pointer"></i>
					</div>
					<h3 class="step-title" style="font-size: 18px; font-weight: 800; margin-bottom: 8px; color: #0f172a;">Choose an Ad</h3>
					<p class="step-desc" style="font-size: 14px; color: #64748b; line-height: 1.6; margin-bottom: 0;">
						Browse through hundreds of live ads from top Tanzanian brands and select high-paying campaigns.
					</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
				<div class="step-card" style="background: #ffffff; border: 1px solid #edf2f7; border-radius: 16px; padding: 32px 22px; text-align: center; position: relative; height: 100%; box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.05);">
					<div class="step-number" style="position: absolute; top: -14px; left: 50%; transform: translateX(-50%); width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #ff7a18 0%, #ff4b2b 100%); color: #ffffff; font-weight: 800; font-size: 13px; display: flex; align-items: center; justify-content: center;">2</div>
					<div class="step-icon-wrap" style="width: 68px; height: 68px; border-radius: 18px; margin: 10px auto 18px; display: flex; align-items: center; justify-content: center; font-size: 26px; background: #eff6ff; color: #3b82f6;">
						<i class="fas fa-clipboard-check"></i>
					</div>
					<h3 class="step-title" style="font-size: 18px; font-weight: 800; margin-bottom: 8px; color: #0f172a;">Read & Answer Quiz</h3>
					<p class="step-desc" style="font-size: 14px; color: #64748b; line-height: 1.6; margin-bottom: 0;">
						Spend a few seconds reading the advertisement content and answer quick simple quiz questions to confirm.
					</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-6">
				<div class="step-card" style="background: #ffffff; border: 1px solid #edf2f7; border-radius: 16px; padding: 32px 22px; text-align: center; position: relative; height: 100%; box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.05);">
					<div class="step-number" style="position: absolute; top: -14px; left: 50%; transform: translateX(-50%); width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #ff7a18 0%, #ff4b2b 100%); color: #ffffff; font-weight: 800; font-size: 13px; display: flex; align-items: center; justify-content: center;">3</div>
					<div class="step-icon-wrap" style="width: 68px; height: 68px; border-radius: 18px; margin: 10px auto 18px; display: flex; align-items: center; justify-content: center; font-size: 26px; background: #ecfdf5; color: #10b981;">
						<i class="fas fa-mobile-alt"></i>
					</div>
					<h3 class="step-title" style="font-size: 18px; font-weight: 800; margin-bottom: 8px; color: #0f172a;">Instant Cash Payout</h3>
					<p class="step-desc" style="font-size: 14px; color: #64748b; line-height: 1.6; margin-bottom: 0;">
						Receive your cash instantly in your 24ads wallet and withdraw straight to M-Pesa, Tigo Pesa, Airtel, or HaloPesa.
					</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ==========================================================================
     ALL AVAILABLE ADS GRID
     ========================================================================== -->
<section class="py-5" style="background: #ffffff;">
	<div class="container">
		<div class="row align-items-center mb-4">
			<div class="col-md-8">
				<div class="section-header-modern mb-0">
					<span class="section-tag" style="display: inline-flex; align-items: center; gap: 6px; background: #fff2eb; color: #ff6b2c; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; padding: 5px 12px; border-radius: 50px; margin-bottom: 8px;">
						<i class="fas fa-layer-group"></i> Latest Campaigns
					</span>
					<h2 class="section-title-modern" style="font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 4px;">All Available Ads</h2>
					<p class="section-desc-modern" style="font-size: 15px; color: #64748b; margin-bottom: 0;">Explore live campaigns and click to start earning TZS right now.</p>
				</div>
			</div>
			<div class="col-md-4 text-md-right mt-3 mt-md-0">
				<span class="badge badge-light font-weight-700 p-2 px-3 border" style="font-size: 13px;">
					<i class="fas fa-check-circle text-success mr-1"></i> <?=isset($ads) ? count($ads) : 0?> Active Ads
				</span>
			</div>
		</div>

		<div class="row">
			<?php if(isset($ads) && sizeof($ads)>0){ ?>
				<?php foreach ($ads as $ad_item){ 
					$banner_img = !empty($ad_item->banner) ? base_url('media/banner/'.$ad_item->banner) : base_url('assets/themes/default_background.jpg');
					$cost = number_format((float)$ad_item->cost_per_click, 0);
				?>
					<div class="col-md-6 col-lg-4 col-xl-3 mb-4">
						<div class="ad-card" style="background: #ffffff; border-radius: 14px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.07); display: flex; flex-direction: column; height: 100%;">
							<div class="ad-card-banner" style="position: relative; width: 100%; height: 175px; overflow: hidden; background: #0f172a;">
								<a href="<?=base_url('home/ads_content?ads='.$ad_item->id);?>" style="display: block; width: 100%; height: 100%;">
									<img src="<?=$banner_img?>" alt="<?=htmlspecialchars($ad_item->title)?>" loading="lazy" style="width: 100% !important; height: 175px !important; max-height: 175px !important; min-height: 175px !important; object-fit: cover !important; display: block !important;" onerror="this.src='<?=base_url('assets/themes/default_background.jpg')?>'">
								</a>
								<div class="ad-reward-badge" style="position: absolute; top: 10px; right: 10px; background: rgba(16, 185, 129, 0.95); backdrop-filter: blur(8px); color: #ffffff; font-size: 12px; font-weight: 800; padding: 4px 10px; border-radius: 50px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); z-index: 2;">
									<i class="fas fa-coins"></i> <?=$cost?> TZS
								</div>
								<div class="ad-business-badge" title="<?=htmlspecialchars($ad_item->business_name)?>" style="position: absolute; bottom: 10px; left: 10px; background: rgba(15, 23, 42, 0.88); backdrop-filter: blur(8px); color: #ffffff; font-size: 11px; font-weight: 600; padding: 4px 10px; border-radius: 50px; max-width: 85%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; z-index: 2;">
									<i class="fas fa-building"></i> <?=htmlspecialchars(ucwords($ad_item->business_name))?>
								</div>
							</div>
							
							<div class="ad-card-body" style="padding: 16px; display: flex; flex-direction: column; flex-grow: 1;">
								<h3 class="ad-card-title" style="font-size: 15px; font-weight: 700; line-height: 1.4; margin-bottom: 8px; color: #0f172a; height: 42px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
									<a href="<?=base_url('home/ads_content?ads='.$ad_item->id);?>" title="<?=htmlspecialchars($ad_item->title)?>" style="color: #0f172a;">
										<?=ucwords(get_words($ad_item->title, '10'))?>
									</a>
								</h3>
								
								<div class="ad-card-meta" style="display: flex; align-items: center; justify-content: space-between; padding-top: 10px; margin-top: auto; border-top: 1px dashed #edf2f7;">
									<div class="ad-earning-rate" style="font-size: 13px; font-weight: 800; color: #10b981; display: flex; align-items: center; gap: 4px;">
										<i class="far fa-money-bill-alt"></i> <?=$cost?> TZS
									</div>
									<a href="<?=base_url('home/ads_content?ads='.$ad_item->id);?>" class="ad-btn-read" style="background: #fff2eb; color: #ff6b2c; font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 50px; text-decoration: none;">
										Read Ad <i class="fas fa-arrow-right ml-1"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } else { ?>
				<div class="col-12">
					<div class="text-center py-5 bg-white rounded-lg border">
						<i class="fas fa-ad fa-3x text-muted mb-3"></i>
						<h4>No Ads Available Right Now</h4>
						<p class="text-muted">Check back soon or post an advertisement for your business.</p>
						<a href="<?=base_url('register_business')?>" class="btn btn-primary mt-2">Post an Ad</a>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>

<!-- ==========================================================================
     BENEFITS SECTION (EARNERS VS BUSINESSES)
     ========================================================================== -->
<section class="benefits-section" style="padding: 65px 0; background: #f8fafc;">
	<div class="container">
		<div class="text-center section-header-modern mb-5">
			<span class="section-tag" style="display: inline-flex; align-items: center; gap: 6px; background: #fff2eb; color: #ff6b2c; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; padding: 5px 12px; border-radius: 50px; margin-bottom: 8px;">
				<i class="fas fa-star"></i> Why Choose 24ads
			</span>
			<h2 class="section-title-modern" style="font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 4px;">Designed for Both Earners & Advertisers</h2>
			<p class="section-desc-modern mx-auto" style="font-size: 15px; color: #64748b;">A win-win platform connecting curious readers with ambitious businesses.</p>
		</div>

		<div class="row">
			<!-- Personal Account Benefits -->
			<div class="col-lg-6 mb-4 mb-lg-0">
				<div class="benefit-card-large" style="background: #ffffff; border-radius: 16px; padding: 34px 28px; border: 1px solid #edf2f7; box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.05); height: 100%;">
					<span class="benefit-badge earner" style="display: inline-block; font-size: 12px; font-weight: 700; text-transform: uppercase; padding: 4px 12px; border-radius: 50px; background: #ecfdf5; color: #065f46; margin-bottom: 12px;">
						<i class="fas fa-user mr-1"></i> For Personal Users
					</span>
					<h3 style="font-weight: 800; font-size: 22px; margin-bottom: 10px; color: #0f172a;">Earn Cash in Your Free Time</h3>
					<p style="font-size: 14px; color: #64748b; margin-bottom: 18px;">Turn your daily smartphone screen time into a reliable stream of extra income with complete peace of mind.</p>
					
					<ul class="benefit-list" style="list-style: none; padding: 0; margin: 0 0 24px;">
						<li style="display: flex; align-items: flex-start; font-size: 14px; color: #334155; margin-bottom: 12px;">
							<i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px; margin-top: 3px;"></i>
							<div><strong>100% Free Registration:</strong> No initial investment or registration fee required.</div>
						</li>
						<li style="display: flex; align-items: flex-start; font-size: 14px; color: #334155; margin-bottom: 12px;">
							<i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px; margin-top: 3px;"></i>
							<div><strong>Daily Fresh High-Paying Ads:</strong> Multiple categories updated 24 hours a day.</div>
						</li>
						<li style="display: flex; align-items: flex-start; font-size: 14px; color: #334155; margin-bottom: 12px;">
							<i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px; margin-top: 3px;"></i>
							<div><strong>Instant Mobile Wallet Payouts:</strong> Direct withdrawals to M-Pesa, Tigo Pesa, Airtel Money, and HaloPesa.</div>
						</li>
						<li style="display: flex; align-items: flex-start; font-size: 14px; color: #334155; margin-bottom: 12px;">
							<i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px; margin-top: 3px;"></i>
							<div><strong>Interactive Quiz Bonuses:</strong> Earn extra bonus cash for answering quiz questions correctly.</div>
						</li>
					</ul>
					
					<a href="<?=base_url('register')?>" class="btn btn-primary" style="background: linear-gradient(135deg, #ff7a18 0%, #ff4b2b 100%) !important; border: none; color: #ffffff; padding: 10px 22px; font-weight: 700; border-radius: 50px;">
						<i class="fas fa-user-plus mr-1"></i> Create Personal Account Free
					</a>
				</div>
			</div>

			<!-- Business Account Benefits -->
			<div class="col-lg-6">
				<div class="benefit-card-large" style="background: #ffffff; border-radius: 16px; padding: 34px 28px; border: 1px solid #edf2f7; box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.05); height: 100%;">
					<span class="benefit-badge business" style="display: inline-block; font-size: 12px; font-weight: 700; text-transform: uppercase; padding: 4px 12px; border-radius: 50px; background: #eff6ff; color: #1d4ed8; margin-bottom: 12px;">
						<i class="fas fa-briefcase mr-1"></i> For Businesses & Advertisers
					</span>
					<h3 style="font-weight: 800; font-size: 22px; margin-bottom: 10px; color: #0f172a;">Reach Verified Tanzanian Customers</h3>
					<p style="font-size: 14px; color: #64748b; margin-bottom: 18px;">Ensure your advertisement is actually seen and remembered with guaranteed quiz-verified engagement.</p>
					
					<ul class="benefit-list" style="list-style: none; padding: 0; margin: 0 0 24px;">
						<li style="display: flex; align-items: flex-start; font-size: 14px; color: #334155; margin-bottom: 12px;">
							<i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px; margin-top: 3px;"></i>
							<div><strong>100% Real Human Attention:</strong> Users answer quiz questions based on your ad, ensuring high brand recall.</div>
						</li>
						<li style="display: flex; align-items: flex-start; font-size: 14px; color: #334155; margin-bottom: 12px;">
							<i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px; margin-top: 3px;"></i>
							<div><strong>Pay-Per-Verified-View (PPV):</strong> You only pay for readers who thoroughly engage with your campaign.</div>
						</li>
						<li style="display: flex; align-items: flex-start; font-size: 14px; color: #334155; margin-bottom: 12px;">
							<i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px; margin-top: 3px;"></i>
							<div><strong>Flexible Budgeting:</strong> Start with any budget and scale as you see conversions.</div>
						</li>
						<li style="display: flex; align-items: flex-start; font-size: 14px; color: #334155; margin-bottom: 12px;">
							<i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px; margin-top: 3px;"></i>
							<div><strong>Comprehensive Analytics:</strong> Track impressions, click-through rates, and audience engagement live.</div>
						</li>
					</ul>
					
					<a href="<?=base_url('register_business')?>" class="btn btn-outline-primary" style="border: 2px solid #ff6b2c; color: #ff6b2c; background: transparent; padding: 8px 22px; font-weight: 700; border-radius: 50px;">
						<i class="fas fa-bullhorn mr-1"></i> Register Business & Post Ads
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ==========================================================================
     PAYMENT PARTNERS & TRUST
     ========================================================================== -->
<section class="trust-section" style="padding: 50px 0; background: #ffffff; border-top: 1px solid #edf2f7; border-bottom: 1px solid #edf2f7;">
	<div class="container text-center">
		<span class="section-tag mb-2" style="display: inline-flex; align-items: center; gap: 6px; background: #ecfdf5; color: #065f46; font-size: 12px; font-weight: 700; text-transform: uppercase; padding: 4px 12px; border-radius: 50px;">
			<i class="fas fa-shield-alt"></i> Fast & Secure
		</span>
		<h4 style="font-weight: 800; font-size: 22px; color: #0f172a; margin-bottom: 4px;">Instant Payouts to All Major Mobile Wallets</h4>
		<p style="font-size: 14px; color: #64748b; margin-bottom: 24px;">Withdraw your cash directly with zero hassle within minutes.</p>

		<div class="payment-logos-wrapper" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 16px;">
			<div class="payment-pill" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 8px 20px; display: inline-flex; align-items: center; gap: 10px; height: 46px;">
				<img src="<?=base_url('assets/themes/payment_method/mpesa.png')?>" alt="M-Pesa" style="max-height: 26px !important; max-width: 80px !important; height: 26px !important; width: auto !important; object-fit: contain !important;">
				<span style="font-weight: 700; font-size: 13px; color: #0f172a;">Vodacom M-Pesa</span>
			</div>
			<div class="payment-pill" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 8px 20px; display: inline-flex; align-items: center; gap: 10px; height: 46px;">
				<img src="<?=base_url('assets/themes/payment_method/tigopesa.png')?>" alt="Tigo Pesa" style="max-height: 26px !important; max-width: 80px !important; height: 26px !important; width: auto !important; object-fit: contain !important;">
				<span style="font-weight: 700; font-size: 13px; color: #0f172a;">Tigo Pesa</span>
			</div>
			<div class="payment-pill" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 8px 20px; display: inline-flex; align-items: center; gap: 10px; height: 46px;">
				<img src="<?=base_url('assets/themes/payment_method/airtelmoney.png')?>" alt="Airtel Money" style="max-height: 26px !important; max-width: 80px !important; height: 26px !important; width: auto !important; object-fit: contain !important;">
				<span style="font-weight: 700; font-size: 13px; color: #0f172a;">Airtel Money</span>
			</div>
			<div class="payment-pill" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 8px 20px; display: inline-flex; align-items: center; gap: 10px; height: 46px;">
				<img src="<?=base_url('assets/themes/payment_method/halopesa.png')?>" alt="HaloPesa" style="max-height: 26px !important; max-width: 80px !important; height: 26px !important; width: auto !important; object-fit: contain !important;">
				<span style="font-weight: 700; font-size: 13px; color: #0f172a;">HaloPesa</span>
			</div>
		</div>
	</div>
</section>

<!-- ==========================================================================
     CALL TO ACTION BANNER
     ========================================================================== -->
<section class="cta-banner-section" style="padding: 55px 0;">
	<div class="container">
		<div class="cta-banner-box" style="background: linear-gradient(135deg, #091a2e 0%, #0f2942 60%, #1e3a5f 100%); border-radius: 20px; padding: 42px 36px; color: #ffffff; box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.25); position: relative; overflow: hidden;">
			<div class="row align-items-center">
				<div class="col-lg-8 mb-4 mb-lg-0">
					<span class="badge badge-pill badge-light px-3 py-1 font-weight-700 mb-2 text-dark" style="font-size: 12px;">
						🚀 Get Started Today
					</span>
					<h2 class="cta-banner-title" style="font-size: 28px; font-weight: 800; color: #ffffff; margin-bottom: 8px;">Ready to Start Earning or Grow Your Brand?</h2>
					<p class="cta-banner-desc" style="font-size: 15px; color: #cbd5e1; max-width: 520px; margin-bottom: 0;">
						Join thousands of happy Tanzanian members already earning daily or launching high-impact business campaigns.
					</p>
				</div>
				<div class="col-lg-4 text-lg-right">
					<a href="<?=base_url('register')?>" class="btn btn-primary btn-lg font-weight-700 mr-2 mb-2 mb-sm-0" style="background: linear-gradient(135deg, #ff7a18 0%, #ff4b2b 100%) !important; color: #ffffff !important; border: none; padding: 12px 26px; border-radius: 50px;">
						Start Earning Now
					</a>
					<a href="<?=base_url('contact')?>" class="btn btn-outline-light btn-lg font-weight-700" style="border: 2px solid #ffffff !important; color: #ffffff !important; background: transparent !important; padding: 10px 24px; border-radius: 50px;">
						Contact Us
					</a>
				</div>
			</div>
		</div>
	</div>
</section>