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
						<label class="font-weight-700 text-dark small text-uppercase">Ad Campaign Title <span class="text-danger">*</span></label>
						<input type="text" name="title" id="ad_title" class="form-control" placeholder="e.g., Special 50% Weekend Discount on Electronics" required style="border-radius: 8px; height: 46px;">
						<small class="form-text text-muted">Catchy title summarizing your promotion or brand message.</small>
					</div>

					<div class="row">
						<div class="col-md-7 mb-3">
							<label class="font-weight-700 text-dark small text-uppercase">Destination Link / Website</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-light"><i class="fas fa-link text-muted"></i></span>
								</div>
								<input type="url" name="url" class="form-control" placeholder="https://yourwebsite.com or WhatsApp link" style="border-radius: 0 8px 8px 0; height: 46px;">
							</div>
							<small class="form-text text-muted">Where users can visit after completing the ad quiz.</small>
						</div>

						<div class="col-md-5 mb-3">
							<label class="font-weight-700 text-dark small text-uppercase">Quiz Time Limit <span class="text-danger">*</span></label>
							<select name="question_timer" class="form-control custom-select" style="border-radius: 8px; height: 46px;">
								<option value="1">1 Minute</option>
								<option value="2" selected>2 Minutes (Recommended)</option>
								<option value="3">3 Minutes</option>
								<option value="5">5 Minutes</option>
							</select>
							<small class="form-text text-muted">Time allowed for readers to complete the questions.</small>
						</div>
					</div>

					<div class="form-group mb-0">
						<label class="font-weight-700 text-dark small text-uppercase">Ad Description & Story Content <span class="text-danger">*</span></label>
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
					<button type="button" class="btn btn-sm btn-outline-primary font-weight-600" id="addQuestionBtn" style="border-radius: 8px;">
						<i class="fas fa-plus mr-1"></i> Add Question
					</button>
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
									<input type="text" name="questions[0][text]" class="form-control" placeholder="e.g., What is the discount percentage offered this weekend?" required style="border-radius: 8px;">
								</div>
								<div class="row">
									<div class="col-md-7 mb-2">
										<label class="small font-weight-600 text-muted mb-1">Answer Options (Comma separated)</label>
										<input type="text" name="questions[0][answers]" class="form-control" placeholder="e.g., 20%, 30%, 50%, 70%" required style="border-radius: 8px;">
									</div>
									<div class="col-md-5 mb-2">
										<label class="small font-weight-600 text-muted mb-1">Correct Answer (Exact match)</label>
										<input type="text" name="questions[0][correct]" class="form-control" placeholder="e.g., 50%" required style="border-radius: 8px;">
									</div>
								</div>
							</div>
						</div>
					</div>
					<small class="text-muted"><i class="fas fa-info-circle mr-1"></i> You can add multiple questions. Viewers will answer them after reading your ad.</small>
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
						<label class="font-weight-700 text-dark small text-uppercase">Total Budget (TZS) <span class="text-danger">*</span></label>
						<div class="input-group">
							<input type="number" name="budget_allocated" id="budget_allocated" class="form-control font-weight-700" placeholder="50000" min="1000" step="500" required style="border-radius: 8px 0 0 8px; height: 46px;">
							<div class="input-group-append">
								<span class="input-group-text bg-light font-weight-600">TZS</span>
							</div>
						</div>
						<small class="form-text text-muted">Total budget allocated for this campaign.</small>
					</div>

					<div class="form-group mb-3">
						<label class="font-weight-700 text-dark small text-uppercase">Reward Per View / Reader <span class="text-danger">*</span></label>
						<div class="input-group">
							<input type="number" name="cost_per_click" id="cost_per_click" class="form-control font-weight-700" placeholder="100" min="20" step="10" required style="border-radius: 8px 0 0 8px; height: 46px;">
							<div class="input-group-append">
								<span class="input-group-text bg-light font-weight-600">TZS</span>
							</div>
						</div>
						<small class="form-text text-muted">Amount earned by reader upon correct quiz answers.</small>
					</div>

					<!-- Estimated Audience Reach Calculation Card -->
					<div class="p-3 mb-3" style="background: linear-gradient(135deg, rgba(30,58,138,0.06) 0%, rgba(16,185,129,0.06) 100%); border-radius: 12px; border: 1px solid #e2e8f0;">
						<div class="d-flex justify-content-between align-items-center">
							<span class="small font-weight-600 text-muted">Estimated Reach:</span>
							<h5 class="font-weight-800 text-primary mb-0" id="estimated_reach">0 Viewers</h5>
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
	}
	$('#budget_allocated, #cost_per_click').on('input change', calculateReach);

	// Dynamic Quiz Questions Management
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

	// Remove question block
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
				$('#resultMsg').html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
				$('#saveAdBtn').show();
				$('#progressAdBtn').hide();
			}
		});
	});
});
</script>