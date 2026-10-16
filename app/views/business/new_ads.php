<!-- Create New Ad Header -->
<div class="d-flex align-items-center justify-content-between mb-4">
	<div>
		<h4 class="font-weight-800 text-dark mb-1" style="font-size: 22px;">Create New Ad Campaign</h4>
		<p class="text-muted small mb-0">Launch an interactive Pay-Per-View campaign and reward engaged consumers for reading your story.</p>
	</div>
	<a href="<?=base_url('business/ads')?>" class="btn btn-outline-secondary font-weight-600 px-3 py-2" style="border-radius: 10px; font-size: 13px;">
		<i class="fas fa-arrow-left mr-1"></i> Back to Campaigns
	</a>
</div>

<form method="POST" id="new-ad-form" enctype="multipart/form-data">
	<div class="row">
		<!-- Left Main Form Column -->
		<div class="col-lg-8">
			<!-- Campaign Info Card -->
			<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
				<div class="card-header bg-white border-bottom p-3 px-4">
					<h5 class="mb-0 font-weight-700 text-dark" style="font-size: 16px;">
						<i class="fas fa-bullhorn text-primary mr-2"></i> 1. Campaign Details
					</h5>
				</div>
				<div class="card-body p-4">
					<div class="form-group mb-3">
						<label for="ad_title" class="font-weight-700 text-dark small text-uppercase">Ad Campaign Title <span class="text-danger">*</span></label>
						<input type="text" name="title" id="ad_title" class="form-control" placeholder="e.g., Special 50% Weekend Discount on Electronics" required style="border-radius: 8px; height: 46px;">
						<small class="form-text text-muted">Catchy title summarizing your promotion or brand message.</small>
					</div>

					<div class="row">
						<div class="col-md-7 mb-3">
							<label for="ad_url" class="font-weight-700 text-dark small text-uppercase">Destination Link / Website</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-light"><i class="fas fa-link text-muted"></i></span>
								</div>
								<input type="url" name="url" id="ad_url" class="form-control" placeholder="https://yourwebsite.com or WhatsApp link" style="border-radius: 0 8px 8px 0; height: 46px;">
							</div>
							<small class="form-text text-muted">Where users can visit after completing the ad quiz.</small>
						</div>

						<div class="col-md-5 mb-3">
							<label for="question_timer" class="font-weight-700 text-dark small text-uppercase">Quiz Time Limit <span class="text-danger">*</span></label>
							<select name="question_timer" id="question_timer" class="form-control custom-select" style="border-radius: 8px; height: 46px;">
								<option value="1">1 Minute</option>
								<option value="2" selected>2 Minutes (Recommended)</option>
								<option value="3">3 Minutes</option>
								<option value="5">5 Minutes</option>
							</select>
							<small class="form-text text-muted">Time allowed for readers to complete the questions.</small>
						</div>
					</div>

					<div class="form-group mb-0">
						<label for="contents" class="font-weight-700 text-dark small text-uppercase">Ad Description & Story Content <span class="text-danger">*</span></label>
						<textarea name="contents" id="contents" class="form-control" rows="7" placeholder="Write full details about your product, service, pricing, offers, branches, and contact information. Readers will need to read this carefully to answer your quiz questions!" required style="border-radius: 8px;"></textarea>
						<small class="form-text text-muted">Make sure to include the answers to your interactive questions within this content!</small>
					</div>
				</div>
			</div>

			<!-- Interactive Quiz Questions Card -->
			<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
				<div class="card-header bg-white border-bottom p-3 px-4 d-flex justify-content-between align-items-center">
					<div>
						<h5 class="mb-0 font-weight-700 text-dark" style="font-size: 16px;">
							<i class="fas fa-question-circle text-primary mr-2"></i> 2. Interactive Verification Questions
						</h5>
						<small class="text-muted">Questions ensure that readers have genuinely paid attention to your ad.</small>
					</div>
					<div class="d-flex align-items-center">
						<button type="button" class="btn btn-sm btn-outline-primary font-weight-600 mr-2" id="addQuestionBtn" style="border-radius: 8px;">
							<i class="fas fa-plus mr-1"></i> Add Question
						</button>
						<button type="button" class="btn btn-sm btn-outline-warning text-dark font-weight-700" id="addBonusQuestionBtn" style="border-radius: 8px; border-color: #f59e0b; background: #fffdf5;">
							<i class="fas fa-star text-warning mr-1"></i> Add Bonus Question
						</button>
					</div>
				</div>
				<div class="card-body p-4">
					<div id="questions-container">
						<!-- Default Question 1 -->
						<div class="question-block card mb-3 border bg-light" id="q_block_0" style="border-radius: 12px;">
							<div class="card-body p-3">
								<div class="d-flex justify-content-between align-items-center mb-2">
									<h6 class="font-weight-700 text-primary mb-0 q-number-title">Question #1</h6>
									<span class="badge badge-primary-light text-primary font-weight-600 px-2 py-1" style="font-size: 11px;">Standard Question</span>
								</div>
								<div class="form-group mb-2">
									<label for="q0_text" class="small font-weight-600 text-muted mb-1">Question Text</label>
									<input type="text" name="questions[0][text]" id="q0_text" class="form-control" placeholder="e.g., What is the discount percentage offered this weekend?" required style="border-radius: 8px;">
								</div>
								<div class="row">
									<div class="col-md-7 mb-2">
										<label for="q0_answers" class="small font-weight-600 text-muted mb-1">Answer Options (Comma separated)</label>
										<input type="text" name="questions[0][answers]" id="q0_answers" class="form-control" placeholder="e.g., 20%, 30%, 50%, 70%" required style="border-radius: 8px;">
									</div>
									<div class="col-md-5 mb-2">
										<label for="q0_correct" class="small font-weight-600 text-muted mb-1">Correct Answer (Exact match)</label>
										<input type="text" name="questions[0][correct]" id="q0_correct" class="form-control" placeholder="e.g., 50%" required style="border-radius: 8px;">
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Single Bonus Question Container -->
					<div id="bonus-question-container" style="display: none;">
						<div class="question-block card mb-3 border" id="bonus_q_block" style="border-radius: 14px; border: 2px solid #f59e0b !important; background: #fffdf5; box-shadow: 0 4px 14px rgba(245, 158, 11, 0.12);">
							<div class="card-body p-3">
								<div class="d-flex justify-content-between align-items-center mb-2">
									<div class="d-flex align-items-center">
										<span class="badge badge-warning text-dark font-weight-800 px-2 py-1 mr-2" style="font-size: 11px; background: #fbbf24;">
											<i class="fas fa-crown mr-1"></i> SINGLE BONUS QUESTION
										</span>
										<span class="text-warning font-weight-700 small"><i class="fas fa-coins mr-1"></i> High Payout Challenge</span>
									</div>
									<button type="button" class="btn btn-sm btn-outline-danger py-0 px-2" id="removeBonusBtn" style="border-radius: 6px; font-size: 11px;">
										<i class="fas fa-times mr-1"></i> Remove Bonus
									</button>
								</div>
								<p class="text-muted small mb-2"><i class="fas fa-info-circle text-warning mr-1"></i> Readers answering this bonus question correctly will receive an additional <strong>High Payout Reward</strong>!</p>
								<input type="hidden" name="questions[bonus][is_bonus]" id="bonus_is_bonus" value="1" disabled>
								<div class="form-group mb-2">
									<label for="bonus_text" class="small font-weight-700 text-dark mb-1">Bonus Question Text <span class="text-danger">*</span></label>
									<input type="text" name="questions[bonus][text]" id="bonus_text" class="form-control" placeholder="e.g., What is our special VIP coupon code mentioned in the ad?" style="border-radius: 8px; border-color: #fde68a;" disabled>
								</div>
								<div class="row">
									<div class="col-md-7 mb-2">
										<label for="bonus_answers" class="small font-weight-700 text-dark mb-1">Answer Options (Comma separated) <span class="text-danger">*</span></label>
										<input type="text" name="questions[bonus][answers]" id="bonus_answers" class="form-control" placeholder="e.g., VIP2026, SUPER50, GOLD100, BONUS24" style="border-radius: 8px; border-color: #fde68a;" disabled>
									</div>
									<div class="col-md-5 mb-2">
										<label for="bonus_correct" class="small font-weight-700 text-dark mb-1">Correct Answer (Exact match) <span class="text-danger">*</span></label>
										<input type="text" name="questions[bonus][correct]" id="bonus_correct" class="form-control" placeholder="e.g., VIP2026" style="border-radius: 8px; border-color: #fde68a;" disabled>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="d-flex justify-content-between align-items-center">
						<small class="text-muted"><i class="fas fa-info-circle mr-1"></i> Viewers answer interactive questions after reading your ad.</small>
						<span class="badge badge-light text-muted font-weight-600 px-2 py-1" style="font-size: 11px;" id="bonus-status-badge">
							<i class="fas fa-star text-muted mr-1"></i> Single Bonus Question: Optional
						</span>
					</div>
				</div>
			</div>
		</div>

		<!-- Right Side Column: Banner & Budget -->
		<div class="col-lg-4">
			<!-- Banner Upload Card -->
			<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
				<div class="card-header bg-white border-bottom p-3 px-4">
					<h5 class="mb-0 font-weight-700 text-dark" style="font-size: 16px;">
						<i class="fas fa-image text-primary mr-2"></i> 3. Ad Banner Image
					</h5>
				</div>
				<div class="card-body p-4 text-center">
					<div class="banner-preview-box mb-3" style="width: 100%; height: 170px; border: 2px dashed #cbd5e1; border-radius: 12px; background: #f8fafc; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
						<img id="banner-preview" src="<?=base_url('assets/themes/ad_placeholder.jpg')?>" alt="Banner Preview" style="width: 100%; height: 100%; object-fit: cover; display: none;">
						<div id="banner-placeholder" class="text-center p-3">
							<i class="fas fa-cloud-upload-alt text-muted mb-2" style="font-size: 32px; color: #94a3b8;"></i>
							<p class="small text-muted mb-0 font-weight-600">Click below to upload banner</p>
							<span class="text-muted" style="font-size: 11px;">PNG, JPG, JPEG (Max 25MB)</span>
						</div>
					</div>
					<label for="ad_banner" class="btn btn-outline-primary btn-block font-weight-600 mb-0" style="border-radius: 8px;">
						<i class="fas fa-upload mr-1"></i> Choose Banner File
					</label>
					<input type="file" name="banner" id="ad_banner" accept="image/*" required style="display: none;">
				</div>
			</div>

			<!-- Budget & Rewards Card -->
			<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
				<div class="card-header bg-white border-bottom p-3 px-4">
					<h5 class="mb-0 font-weight-700 text-dark" style="font-size: 16px;">
						<i class="fas fa-wallet text-primary mr-2"></i> 4. Budget & Pricing
					</h5>
				</div>
				<div class="card-body p-4">
					<div class="form-group mb-3">
						<label for="budget_allocated" class="font-weight-700 text-dark small text-uppercase">Total Budget (TZS) <span class="text-danger">*</span></label>
						<div class="input-group">
							<input type="number" name="budget_allocated" id="budget_allocated" class="form-control font-weight-700" placeholder="50000" min="1000" step="500" required style="border-radius: 8px 0 0 8px; height: 46px;">
							<div class="input-group-append">
								<span class="input-group-text bg-light font-weight-600">TZS</span>
							</div>
						</div>
						<small class="form-text text-muted">Total budget allocated for this campaign.</small>
					</div>

					<div class="form-group mb-3">
						<label for="cost_per_click" class="font-weight-700 text-dark small text-uppercase">Standard Reward Per View / Reader <span class="text-danger">*</span></label>
						<div class="input-group">
							<input type="number" name="cost_per_click" id="cost_per_click" class="form-control font-weight-700" placeholder="100" min="20" step="10" required style="border-radius: 8px 0 0 8px; height: 46px;">
							<div class="input-group-append">
								<span class="input-group-text bg-light font-weight-600">TZS</span>
							</div>
						</div>
						<small class="form-text text-muted">Amount earned by reader upon correct standard quiz answers.</small>
					</div>

					<!-- Single Bonus Question High Payout Section -->
					<div id="bonus-budget-card" class="p-3 mb-3 border rounded-lg" style="display: none; background: #fffdf5; border-color: #fde68a !important; border-radius: 12px; box-shadow: 0 2px 8px rgba(245, 158, 11, 0.08);">
						<div class="d-flex align-items-center justify-content-between mb-2">
							<div class="d-flex align-items-center">
								<i class="fas fa-crown text-warning mr-2" style="font-size: 15px;"></i>
								<h6 class="font-weight-800 text-dark mb-0 small text-uppercase">Bonus Question High Payout</h6>
							</div>
							<span class="badge badge-warning text-dark font-weight-700 px-2 py-1" style="font-size: 10px; background: #fbbf24;">HIGH PAYOUT</span>
						</div>

						<div class="form-group mb-3">
							<label for="bonus_payout" class="font-weight-700 text-dark small text-uppercase">High Payout Per Winner (TZS) <span class="text-danger">*</span></label>
							<div class="input-group">
								<input type="number" name="bonus" id="bonus_payout" class="form-control font-weight-700" placeholder="500" min="50" step="50" style="border-radius: 8px 0 0 8px; height: 46px; border-color: #fcd34d;" disabled>
								<div class="input-group-append">
									<span class="input-group-text bg-warning text-dark font-weight-700">TZS</span>
								</div>
							</div>
							<small class="form-text text-muted">High reward paid to each reader who answers the bonus question correctly (must exceed standard reward).</small>
						</div>

						<div class="form-group mb-0">
							<label for="total_bonus_allocated" class="font-weight-700 text-dark small text-uppercase">Total Bonus Budget (TZS) <span class="text-danger">*</span></label>
							<div class="input-group">
								<input type="number" name="total_bonus_allocated" id="total_bonus_allocated" class="form-control font-weight-700" placeholder="20000" min="500" step="500" style="border-radius: 8px 0 0 8px; height: 46px; border-color: #fcd34d;" disabled>
								<div class="input-group-append">
									<span class="input-group-text bg-warning text-dark font-weight-700">TZS</span>
								</div>
							</div>
							<small class="form-text text-muted">Separate pool dedicated exclusively to bonus payouts.</small>
						</div>
					</div>

					<!-- Estimated Audience Reach Calculation Card -->
					<div class="p-3 mb-3" style="background: linear-gradient(135deg, rgba(30,58,138,0.06) 0%, rgba(16,185,129,0.06) 100%); border-radius: 12px; border: 1px solid #e2e8f0;">
						<div class="d-flex justify-content-between align-items-center mb-1">
							<span class="small font-weight-600 text-muted">Standard Viewers:</span>
							<h6 class="font-weight-800 text-primary mb-0" id="estimated_reach">0 Viewers</h6>
						</div>
						<div id="bonus-reach-row" class="justify-content-between align-items-center mb-1" style="display: none;">
							<span class="small font-weight-600 text-warning"><i class="fas fa-crown mr-1"></i> Bonus Winners:</span>
							<h6 class="font-weight-800 text-warning mb-0" id="estimated_bonus_reach">0 Winners</h6>
						</div>
						<div id="total-investment-row" class="justify-content-between align-items-center pt-2 mt-2 border-top" style="display: none;">
							<span class="small font-weight-700 text-dark">Total Budget:</span>
							<h6 class="font-weight-800 text-success mb-0" id="total_campaign_budget">0 TZS</h6>
						</div>
					</div>

					<!-- Result Notification Box -->
					<div id="resultMsg" class="mb-3"></div>

					<!-- Submit Buttons -->
					<div class="form-group mb-0">
						<button type="button" class="btn btn-primary btn-block font-weight-700 shadow-sm py-3" id="saveAdBtn" style="border-radius: 10px; font-size: 15px;">
							<i class="fas fa-rocket mr-1"></i> Launch Ad Campaign
						</button>
						<button type="button" class="btn btn-primary btn-block font-weight-700 py-3" id="progressAdBtn" style="display: none; border-radius: 10px; font-size: 15px;" disabled>
							<i class="fas fa-spinner fa-spin mr-1"></i> Submitting Campaign...
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
$(document).ready(function(){
	// Banner image preview
	$('#ad_banner').change(function(){
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#banner-preview').attr('src', e.target.result).show();
				$('#banner-placeholder').hide();
			}
			reader.readAsDataURL(this.files[0]);
		}
	});

	// Bonus Question Management (Single Bonus Question with High Payout)
	var hasBonus = false;

	function toggleBonusQuestion(enable){
		hasBonus = enable;
		if(hasBonus){
			$('#bonus-question-container').slideDown(250);
			$('#bonus_is_bonus').prop('disabled', false);
			$('#bonus_text, #bonus_answers, #bonus_correct').prop('disabled', false).prop('required', true);

			$('#bonus-budget-card').slideDown(250);
			$('#bonus_payout, #total_bonus_allocated').prop('disabled', false).prop('required', true);

			// Pre-fill suggested high payout if empty
			var cpc = parseFloat($('#cost_per_click').val()) || 100;
			if(!$('#bonus_payout').val()){
				$('#bonus_payout').val(cpc * 5); // 5x higher payout suggestion
			}
			if(!$('#total_bonus_allocated').val()){
				var regularBudget = parseFloat($('#budget_allocated').val()) || 50000;
				$('#total_bonus_allocated').val(Math.max(10000, Math.floor(regularBudget * 0.3)));
			}

			$('#bonus-reach-row, #total-investment-row').css('display', 'flex');
			$('#addBonusQuestionBtn').removeClass('btn-outline-warning').addClass('btn-warning text-dark')
				.html('<i class="fas fa-check mr-1"></i> Bonus Active (1/1)').prop('disabled', true);
			$('#bonus-status-badge').removeClass('badge-light text-muted').addClass('badge-warning text-dark')
				.html('<i class="fas fa-crown mr-1"></i> Single Bonus Question Active');
		} else {
			$('#bonus-question-container').slideUp(250);
			$('#bonus_is_bonus').prop('disabled', true);
			$('#bonus_text, #bonus_answers, #bonus_correct').prop('disabled', true).prop('required', false).val('');

			$('#bonus-budget-card').slideUp(250);
			$('#bonus_payout, #total_bonus_allocated').prop('disabled', true).prop('required', false).val('');

			$('#bonus-reach-row, #total-investment-row').hide();
			$('#addBonusQuestionBtn').removeClass('btn-warning text-dark').addClass('btn-outline-warning text-dark')
				.html('<i class="fas fa-star text-warning mr-1"></i> Add Bonus Question').prop('disabled', false);
			$('#bonus-status-badge').removeClass('badge-warning text-dark').addClass('badge-light text-muted')
				.html('<i class="fas fa-star text-muted mr-1"></i> Single Bonus Question: Optional');
		}
		calculateReach();
	}

	$('#addBonusQuestionBtn').click(function(){
		toggleBonusQuestion(true);
	});

	$('#removeBonusBtn').click(function(){
		toggleBonusQuestion(false);
	});

	// Live estimated reach calculation
	function calculateReach(){
		var budget = parseFloat($('#budget_allocated').val()) || 0;
		var cpc = parseFloat($('#cost_per_click').val()) || 0;
		if(budget > 0 && cpc > 0){
			var reach = Math.floor(budget / cpc);
			$('#estimated_reach').text(reach.toLocaleString() + ' Viewers');
		} else {
			$('#estimated_reach').text('0 Viewers');
		}

		if(hasBonus){
			var bonusBudget = parseFloat($('#total_bonus_allocated').val()) || 0;
			var bonusPayout = parseFloat($('#bonus_payout').val()) || 0;
			if(bonusBudget > 0 && bonusPayout > 0){
				var bonusReach = Math.floor(bonusBudget / bonusPayout);
				$('#estimated_bonus_reach').text(bonusReach.toLocaleString() + ' Winners');
			} else {
				$('#estimated_bonus_reach').text('0 Winners');
			}
			var totalInvestment = budget + bonusBudget;
			$('#total_campaign_budget').text(totalInvestment.toLocaleString() + ' TZS');
		}
	}
	$('#budget_allocated, #cost_per_click, #bonus_payout, #total_bonus_allocated').on('input change', calculateReach);

	// Dynamic Standard Quiz Questions Management
	var qCount = 1;
	$('#addQuestionBtn').click(function(){
		var index = qCount;
		qCount++;
		var qHtml = `
			<div class="question-block card mb-3 border bg-light" id="q_block_${index}" style="border-radius: 12px;">
				<div class="card-body p-3">
					<div class="d-flex justify-content-between align-items-center mb-2">
						<h6 class="font-weight-700 text-primary mb-0 q-number-title">Question #${index + 1}</h6>
						<button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 remove-q-btn" data-target="#q_block_${index}" style="border-radius: 6px; font-size: 11px;">
							<i class="fas fa-times mr-1"></i> Remove
						</button>
					</div>
					<div class="form-group mb-2">
						<input type="text" name="questions[${index}][text]" class="form-control" placeholder="Enter your verification question" required style="border-radius: 8px;">
					</div>
					<div class="row">
						<div class="col-md-7 mb-2">
							<label class="small font-weight-600 text-muted mb-1">Answer Options (Comma separated)</label>
							<input type="text" name="questions[${index}][answers]" class="form-control" placeholder="e.g., Option A, Option B, Option C, Option D" required style="border-radius: 8px;">
						</div>
						<div class="col-md-5 mb-2">
							<label class="small font-weight-600 text-muted mb-1">Correct Answer (Exact match)</label>
							<input type="text" name="questions[${index}][correct]" class="form-control" placeholder="e.g., Option B" required style="border-radius: 8px;">
						</div>
					</div>
				</div>
			</div>
		`;
		$('#questions-container').append(qHtml);
	});

	// Remove standard question block
	$(document).on('click', '.remove-q-btn', function(){
		var target = $(this).data('target');
		$(target).remove();
	});

	// AJAX Form Submit
	$('#saveAdBtn').click(function(){
		var form = document.getElementById('new-ad-form');
		if(!form.checkValidity()){
			form.reportValidity();
			return false;
		}

		// Bonus Question Validation if enabled
		if(hasBonus){
			var cpc = parseFloat($('#cost_per_click').val()) || 0;
			var bonusPayout = parseFloat($('#bonus_payout').val()) || 0;
			var bonusBudget = parseFloat($('#total_bonus_allocated').val()) || 0;

			if(bonusPayout <= 0){
				$('#resultMsg').html('<div class="alert alert-danger" style="border-radius: 10px;"><i class="fas fa-exclamation-circle mr-1"></i> Please enter a valid high payout amount for the bonus question.</div>');
				$('#bonus_payout').focus();
				return false;
			}
			if(bonusBudget <= 0){
				$('#resultMsg').html('<div class="alert alert-danger" style="border-radius: 10px;"><i class="fas fa-exclamation-circle mr-1"></i> Please enter a valid total bonus budget.</div>');
				$('#total_bonus_allocated').focus();
				return false;
			}
			if(bonusPayout <= cpc){
				$('#resultMsg').html('<div class="alert alert-danger" style="border-radius: 10px;"><i class="fas fa-exclamation-circle mr-1"></i> Bonus question payout (' + bonusPayout.toLocaleString() + ' TZS) must be higher than the standard reward per view (' + cpc.toLocaleString() + ' TZS).</div>');
				$('#bonus_payout').focus();
				return false;
			}
			if(bonusPayout > bonusBudget){
				$('#resultMsg').html('<div class="alert alert-danger" style="border-radius: 10px;"><i class="fas fa-exclamation-circle mr-1"></i> Bonus question payout cannot exceed the total allocated bonus budget.</div>');
				$('#bonus_payout').focus();
				return false;
			}
		}

		$('#saveAdBtn').hide();
		$('#progressAdBtn').show();
		$('#resultMsg').html('');

		var formData = new FormData(form);

		$.ajax({
			url: '<?=base_url("business/save_ad")?>',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			cache: false,
			success: function(response){
				if(response.trim() === 'Success'){
					var successHtml = `
						<div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px;">
							<i class="fas fa-check-circle mr-1"></i> <strong>Congratulations!</strong> Your ad campaign has been submitted successfully and is now under review.
						</div>
					`;
					$('#resultMsg').html(successHtml);
					setTimeout(function(){
						window.location.href = '<?=base_url("business/ads")?>';
					}, 1200);
				} else {
					$('#resultMsg').html(response);
					$('#saveAdBtn').show();
					$('#progressAdBtn').hide();
				}
			},
			error: function(xhr, status, error){
				$('#resultMsg').html('<div class="alert alert-danger" style="border-radius: 10px;">An error occurred: ' + error + '</div>');
				$('#saveAdBtn').show();
				$('#progressAdBtn').hide();
			}
		});
	});
});
</script>