<!-- Edit & Resubmit Advertisement View -->
<div class="d-flex align-items-center justify-content-between mb-4">
	<div>
		<h4 class="font-weight-800 text-dark mb-1" style="font-size: 22px;">Edit & Resubmit Ad Campaign</h4>
		<p class="text-muted small mb-0">Revise your campaign details and quiz questions. Resubmitted campaigns return to <strong>PENDING REVIEW</strong> for administrator verification.</p>
	</div>
	<a href="<?=base_url('business/ads')?>" class="btn btn-outline-secondary font-weight-600 px-3 py-2" style="border-radius: 10px; font-size: 13px;">
		<i class="fas fa-arrow-left mr-1"></i> Back to Campaigns
	</a>
</div>

<!-- Rejection Reason Callout if Previously Rejected -->
<?php if($ad['ads_status'] == '3' && !empty($ad['rejected_reason'])){ ?>
<div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 14px; background: #fef2f2; color: #991b1b; border-left: 5px solid #ef4444 !important;">
	<div class="d-flex align-items-start">
		<div class="mr-3 mt-1" style="font-size: 24px;"><i class="fas fa-exclamation-circle text-danger"></i></div>
		<div>
			<h6 class="font-weight-800 mb-1" style="font-size: 15px;">Administrator Feedback & Rejection Reason:</h6>
			<p class="mb-2" style="font-size: 14px; line-height: 1.5;"><?=htmlspecialchars($ad['rejected_reason'])?></p>
			<small class="text-muted"><i class="fas fa-info-circle mr-1"></i> Please address the points above before clicking <strong>Resubmit Campaign for Review</strong> below.</small>
		</div>
	</div>
</div>
<?php } ?>

<form method="POST" id="edit-ad-form" enctype="multipart/form-data">
	<input type="hidden" name="ad_id" value="<?=$ad['id']?>">

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
						<input type="text" name="title" id="ad_title" class="form-control" placeholder="e.g., Special Weekend Promotion" value="<?=htmlspecialchars($ad['title'])?>" required style="border-radius: 8px; height: 46px;">
					</div>

					<div class="row">
						<div class="col-md-7 mb-3">
							<label for="ad_url" class="font-weight-700 text-dark small text-uppercase">Destination Link / Website</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-light"><i class="fas fa-link text-muted"></i></span>
								</div>
								<input type="url" name="url" id="ad_url" class="form-control" placeholder="https://yourwebsite.com" value="<?=htmlspecialchars($ad['url'])?>" style="border-radius: 0 8px 8px 0; height: 46px;">
							</div>
						</div>

						<div class="col-md-5 mb-3">
							<label for="question_timer" class="font-weight-700 text-dark small text-uppercase">Quiz Time Limit <span class="text-danger">*</span></label>
							<select name="question_timer" id="question_timer" class="form-control custom-select" style="border-radius: 8px; height: 46px;">
								<option value="1" <?=($ad['question_timer'] == 1) ? 'selected' : ''?>>1 Minute</option>
								<option value="2" <?=($ad['question_timer'] == 2 || empty($ad['question_timer'])) ? 'selected' : ''?>>2 Minutes (Recommended)</option>
								<option value="3" <?=($ad['question_timer'] == 3) ? 'selected' : ''?>>3 Minutes</option>
								<option value="5" <?=($ad['question_timer'] == 5) ? 'selected' : ''?>>5 Minutes</option>
							</select>
						</div>
					</div>

					<div class="form-group mb-0">
						<label for="contents" class="font-weight-700 text-dark small text-uppercase">Ad Description & Story Content <span class="text-danger">*</span></label>
						<textarea name="contents" id="contents" class="form-control" rows="8" required style="border-radius: 8px;"><?=htmlspecialchars($ad['contents'])?></textarea>
						<small class="form-text text-muted">Ensure your description contains the answers to your quiz questions.</small>
					</div>
				</div>
			</div>

			<!-- Interactive Quiz Questions Card -->
			<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
				<div class="card-header bg-white border-bottom p-3 px-4 d-flex justify-content-between align-items-center">
					<div>
						<h5 class="mb-0 font-weight-700 text-dark" style="font-size: 16px;">
							<i class="fas fa-question-circle text-primary mr-2"></i> 2. Interactive Questions
						</h5>
						<small class="text-muted">Questions verify that readers paid attention before receiving their reward.</small>
					</div>
					<button type="button" class="btn btn-sm btn-outline-primary font-weight-600" id="addQuestionBtn" style="border-radius: 8px;">
						<i class="fas fa-plus mr-1"></i> Add Question
					</button>
				</div>
				<div class="card-body p-4">
					<div id="questions-container">
						<?php 
						if(!empty($questions)){
							$idx = 0;
							foreach($questions as $q){
						?>
							<div class="question-block card mb-3 border bg-light" id="q_block_<?=$idx?>" style="border-radius: 12px;">
								<div class="card-body p-3">
									<div class="d-flex justify-content-between align-items-center mb-2">
										<h6 class="font-weight-700 text-primary mb-0 q-number-title">Question #<?=$idx+1?></h6>
										<?php if($idx > 0){ ?>
											<button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 remove-q-btn" onclick="removeQuestion(<?=$idx?>)">
												<i class="fas fa-times"></i> Remove
											</button>
										<?php } ?>
									</div>
									<div class="form-group mb-2">
										<label class="small font-weight-600 text-muted mb-1">Question Text</label>
										<input type="text" name="questions[<?=$idx?>][text]" class="form-control" value="<?=htmlspecialchars($q['question'])?>" required style="border-radius: 8px;">
									</div>
									<div class="row">
										<div class="col-md-7 mb-2">
											<label class="small font-weight-600 text-muted mb-1">Answer Options (Comma separated)</label>
											<input type="text" name="questions[<?=$idx?>][answers]" class="form-control" value="<?=htmlspecialchars($q['answers'])?>" required style="border-radius: 8px;">
										</div>
										<div class="col-md-5 mb-2">
											<label class="small font-weight-600 text-muted mb-1">Correct Answer (Exact match)</label>
											<input type="text" name="questions[<?=$idx?>][correct]" class="form-control" value="<?=htmlspecialchars($q['correct_answer'])?>" required style="border-radius: 8px;">
										</div>
									</div>
								</div>
							</div>
						<?php 
								$idx++;
							}
						} else { ?>
							<div class="question-block card mb-3 border bg-light" id="q_block_0" style="border-radius: 12px;">
								<div class="card-body p-3">
									<h6 class="font-weight-700 text-primary mb-2 q-number-title">Question #1</h6>
									<div class="form-group mb-2">
										<label class="small font-weight-600 text-muted mb-1">Question Text</label>
										<input type="text" name="questions[0][text]" class="form-control" placeholder="Enter question..." required style="border-radius: 8px;">
									</div>
									<div class="row">
										<div class="col-md-7 mb-2">
											<label class="small font-weight-600 text-muted mb-1">Answer Options (Comma separated)</label>
											<input type="text" name="questions[0][answers]" class="form-control" placeholder="Option 1, Option 2, Option 3" required style="border-radius: 8px;">
										</div>
										<div class="col-md-5 mb-2">
											<label class="small font-weight-600 text-muted mb-1">Correct Answer (Exact match)</label>
											<input type="text" name="questions[0][correct]" class="form-control" placeholder="Option 1" required style="border-radius: 8px;">
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>

		<!-- Right Side Column: Banner & Budget -->
		<div class="col-lg-4">
			<!-- Banner Image Upload Card -->
			<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
				<div class="card-header bg-white border-bottom p-3 px-4">
					<h5 class="mb-0 font-weight-700 text-dark" style="font-size: 16px;">
						<i class="fas fa-image text-primary mr-2"></i> 3. Campaign Banner
					</h5>
				</div>
				<div class="card-body p-4 text-center">
					<?php 
					$bannerUrl = (!empty($ad['banner']) && file_exists(FCPATH.'media/banner/'.$ad['banner'])) 
						? base_url('media/banner/'.$ad['banner']) 
						: base_url('assets/themes/ad_placeholder.jpg');
					?>
					<div class="mb-3">
						<img src="<?=$bannerUrl?>" id="banner-preview" class="img-fluid rounded shadow-xs" style="max-height: 180px; width: 100%; object-fit: cover; border: 1px solid #e2e8f0;">
					</div>
					<div class="custom-file text-left">
						<input type="file" name="banner" class="custom-file-input" id="banner_file" accept="image/*" onchange="previewBanner(this)">
						<label class="custom-file-label" for="banner_file" style="border-radius: 8px;">Choose replacement...</label>
					</div>
					<small class="text-muted d-block mt-2 font-size-11">Leave blank to keep existing banner. Recommended: 1200x630 (JPG, PNG).</small>
				</div>
			</div>

			<!-- Budget & Financial Card -->
			<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
				<div class="card-header bg-white border-bottom p-3 px-4">
					<h5 class="mb-0 font-weight-700 text-dark" style="font-size: 16px;">
						<i class="fas fa-coins text-primary mr-2"></i> 4. Budget & Reward
					</h5>
				</div>
				<div class="card-body p-4">
					<div class="form-group mb-3">
						<label for="budget_allocated" class="font-weight-700 text-dark small text-uppercase">Total Allocated Budget (TZS) <span class="text-danger">*</span></label>
						<input type="number" name="budget_allocated" id="budget_allocated" class="form-control font-weight-700" value="<?=htmlspecialchars($ad['budget_allocated'])?>" required style="border-radius: 8px; height: 46px;">
					</div>

					<div class="form-group mb-4">
						<label for="cost_per_click" class="font-weight-700 text-dark small text-uppercase">Reward per Reader View (TZS) <span class="text-danger">*</span></label>
						<input type="number" name="cost_per_click" id="cost_per_click" class="form-control font-weight-700" value="<?=htmlspecialchars($ad['cost_per_click'])?>" required style="border-radius: 8px; height: 46px;">
					</div>

					<!-- Resubmit Button -->
					<div id="resubmit-alert" class="mb-3"></div>
					<button type="submit" class="btn btn-warning btn-block btn-lg font-weight-800 shadow-sm" id="btnSubmitAd" style="border-radius: 10px; height: 50px; font-size: 15px; color: #78350f !important;">
						<i class="fas fa-paper-plane mr-2"></i> Resubmit for Admin Review
					</button>
					<small class="text-muted text-center d-block mt-2 font-size-11">
						<i class="fas fa-shield-alt mr-1 text-success"></i> Status will return to <strong>PENDING REVIEW</strong> upon resubmission.
					</small>
				</div>
			</div>
		</div>
	</div>
</form>

<script>
var qCount = <?=max(1, count($questions ?? []))?>;

$('#addQuestionBtn').click(function(){
	var html = '<div class="question-block card mb-3 border bg-light" id="q_block_' + qCount + '" style="border-radius: 12px;">' +
		'<div class="card-body p-3">' +
			'<div class="d-flex justify-content-between align-items-center mb-2">' +
				'<h6 class="font-weight-700 text-primary mb-0 q-number-title">Question #' + (qCount + 1) + '</h6>' +
				'<button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 remove-q-btn" onclick="removeQuestion(' + qCount + ')"><i class="fas fa-times"></i> Remove</button>' +
			'</div>' +
			'<div class="form-group mb-2">' +
				'<label class="small font-weight-600 text-muted mb-1">Question Text</label>' +
				'<input type="text" name="questions[' + qCount + '][text]" class="form-control" placeholder="Enter question..." required style="border-radius: 8px;">' +
			'</div>' +
			'<div class="row">' +
				'<div class="col-md-7 mb-2">' +
					'<label class="small font-weight-600 text-muted mb-1">Answer Options (Comma separated)</label>' +
					'<input type="text" name="questions[' + qCount + '][answers]" class="form-control" placeholder="Option 1, Option 2, Option 3" required style="border-radius: 8px;">' +
				'</div>' +
				'<div class="col-md-5 mb-2">' +
					'<label class="small font-weight-600 text-muted mb-1">Correct Answer (Exact match)</label>' +
					'<input type="text" name="questions[' + qCount + '][correct]" class="form-control" placeholder="Option 1" required style="border-radius: 8px;">' +
				'</div>' +
			'</div>' +
		'</div>' +
	'</div>';
	$('#questions-container').append(html);
	qCount++;
});

function removeQuestion(idx){
	$('#q_block_' + idx).remove();
}

function previewBanner(input){
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e){
			$('#banner-preview').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
		$(input).next('.custom-file-label').html(input.files[0].name);
	}
}

$('#edit-ad-form').submit(function(e){
	e.preventDefault();
	var formData = new FormData(this);
	var btn = $('#btnSubmitAd');
	var alertBox = $('#resubmit-alert');

	btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Submitting for Review...');
	alertBox.html('');

	$.ajax({
		url: '<?=base_url("business/update_ad")?>',
		type: 'POST',
		data: formData,
		contentType: false,
		processData: false,
		success: function(res){
			if(res.trim() == 'Success'){
				alertBox.html('<div class="alert alert-success border-0 py-2 small mb-0"><i class="fas fa-check-circle mr-1"></i> Campaign updated successfully! It has been returned to PENDING REVIEW for administrator verification.</div>');
				setTimeout(function(){
					window.location.href = '<?=base_url("business/ads?status=2")?>';
				}, 1500);
			} else {
				btn.prop('disabled', false).html('<i class="fas fa-paper-plane mr-2"></i> Resubmit for Admin Review');
				alertBox.html('<div class="alert alert-danger border-0 py-2 small mb-0">' + res + '</div>');
			}
		},
		error: function(){
			btn.prop('disabled', false).html('<i class="fas fa-paper-plane mr-2"></i> Resubmit for Admin Review');
			alertBox.html('<div class="alert alert-danger border-0 py-2 small mb-0"><i class="fas fa-exclamation-triangle mr-1"></i> An unexpected server error occurred. Please try again.</div>');
		}
	});
});
</script>
