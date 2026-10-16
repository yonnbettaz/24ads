<!-- Edit & Resubmit Advertisement View -->
<?php
// Separate standard questions from the single bonus question if present
$standardQuestions = [];
$bonusQuestion = null;
if (!empty($questions)) {
    foreach ($questions as $q) {
        if (isset($q['is_bonus']) && $q['is_bonus'] == 1 && $bonusQuestion === null) {
            $bonusQuestion = $q;
        } else {
            $standardQuestions[] = $q;
        }
    }
}
$hasBonusInitial = ($bonusQuestion !== null) || (!empty($ad['bonus']) && (float)$ad['bonus'] > 0);
?>
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
<?php if ($ad['ads_status'] == '3' && !empty($ad['rejected_reason'])) { ?>
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
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-primary font-weight-600 mr-2" id="addQuestionBtn" style="border-radius: 8px;">
                            <i class="fas fa-plus mr-1"></i> Add Question
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-warning font-weight-600 text-dark" id="addBonusQuestionBtn" style="border-radius: 8px;">
                            <i class="fas fa-crown text-warning mr-1"></i> Add Bonus Question
                        </button>
                    </div>
                </div>
                <div class="card-body p-4">
                    <!-- Standard Questions Container -->
                    <div id="questions-container">
                        <?php 
                        if (!empty($standardQuestions)) {
                            $idx = 0;
                            foreach ($standardQuestions as $q) {
                        ?>
                            <div class="question-block card mb-3 border bg-light" id="q_block_<?=$idx?>" style="border-radius: 12px;">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="font-weight-700 text-primary mb-0 q-number-title">Question #<?=$idx+1?></h6>
                                        <?php if ($idx > 0) { ?>
                                            <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 remove-q-btn" onclick="removeQuestion(<?=$idx?>)">
                                                <i class="fas fa-times"></i> Remove
                                            </button>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="q_<?=$idx?>_text" class="small font-weight-600 text-muted mb-1">Question Text</label>
                                        <input type="text" name="questions[<?=$idx?>][text]" id="q_<?=$idx?>_text" class="form-control" value="<?=htmlspecialchars($q['question'])?>" required style="border-radius: 8px;">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7 mb-2">
                                            <label for="q_<?=$idx?>_answers" class="small font-weight-600 text-muted mb-1">Answer Options (Comma separated)</label>
                                            <input type="text" name="questions[<?=$idx?>][answers]" id="q_<?=$idx?>_answers" class="form-control" value="<?=htmlspecialchars($q['answers'])?>" required style="border-radius: 8px;">
                                        </div>
                                        <div class="col-md-5 mb-2">
                                            <label for="q_<?=$idx?>_correct" class="small font-weight-600 text-muted mb-1">Correct Answer (Exact match)</label>
                                            <input type="text" name="questions[<?=$idx?>][correct]" id="q_<?=$idx?>_correct" class="form-control" value="<?=htmlspecialchars($q['correct_answer'])?>" required style="border-radius: 8px;">
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
                                        <label for="q_0_text" class="small font-weight-600 text-muted mb-1">Question Text</label>
                                        <input type="text" name="questions[0][text]" id="q_0_text" class="form-control" placeholder="Enter question..." required style="border-radius: 8px;">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7 mb-2">
                                            <label for="q_0_answers" class="small font-weight-600 text-muted mb-1">Answer Options (Comma separated)</label>
                                            <input type="text" name="questions[0][answers]" id="q_0_answers" class="form-control" placeholder="Option 1, Option 2, Option 3" required style="border-radius: 8px;">
                                        </div>
                                        <div class="col-md-5 mb-2">
                                            <label for="q_0_correct" class="small font-weight-600 text-muted mb-1">Correct Answer (Exact match)</label>
                                            <input type="text" name="questions[0][correct]" id="q_0_correct" class="form-control" placeholder="Option 1" required style="border-radius: 8px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- Single Bonus Question Container -->
                    <div id="bonus-question-container" style="<?=$hasBonusInitial ? 'display: block;' : 'display: none;'?>">
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
                                <input type="hidden" name="questions[bonus][is_bonus]" id="bonus_is_bonus" value="1" <?=$hasBonusInitial ? '' : 'disabled'?>>
                                <div class="form-group mb-2">
                                    <label for="bonus_text" class="small font-weight-700 text-dark mb-1">Bonus Question Text <span class="text-danger">*</span></label>
                                    <input type="text" name="questions[bonus][text]" id="bonus_text" class="form-control" placeholder="e.g., What is our special VIP coupon code mentioned in the ad?" value="<?=htmlspecialchars($bonusQuestion['question'] ?? '')?>" style="border-radius: 8px; border-color: #fde68a;" <?=$hasBonusInitial ? 'required' : 'disabled'?>>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 mb-2">
                                        <label for="bonus_answers" class="small font-weight-700 text-dark mb-1">Answer Options (Comma separated) <span class="text-danger">*</span></label>
                                        <input type="text" name="questions[bonus][answers]" id="bonus_answers" class="form-control" placeholder="e.g., VIP2026, SUPER50, GOLD100, BONUS24" value="<?=htmlspecialchars($bonusQuestion['answers'] ?? '')?>" style="border-radius: 8px; border-color: #fde68a;" <?=$hasBonusInitial ? 'required' : 'disabled'?>>
                                    </div>
                                    <div class="col-md-5 mb-2">
                                        <label for="bonus_correct" class="small font-weight-700 text-dark mb-1">Correct Answer (Exact match) <span class="text-danger">*</span></label>
                                        <input type="text" name="questions[bonus][correct]" id="bonus_correct" class="form-control" placeholder="e.g., VIP2026" value="<?=htmlspecialchars($bonusQuestion['correct_answer'] ?? '')?>" style="border-radius: 8px; border-color: #fde68a;" <?=$hasBonusInitial ? 'required' : 'disabled'?>>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted"><i class="fas fa-info-circle mr-1"></i> Viewers answer interactive questions after reading your ad.</small>
                        <span class="badge <?=$hasBonusInitial ? 'badge-warning text-dark' : 'badge-light text-muted'?> font-weight-600 px-2 py-1" style="font-size: 11px;" id="bonus-status-badge">
                            <?=$hasBonusInitial ? '<i class="fas fa-crown mr-1"></i> Single Bonus Question Active' : '<i class="fas fa-star text-muted mr-1"></i> Single Bonus Question: Optional'?>
                        </span>
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
                        <label for="budget_allocated" class="font-weight-700 text-dark small text-uppercase">Total Standard Budget (TZS) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" name="budget_allocated" id="budget_allocated" class="form-control font-weight-700" value="<?=htmlspecialchars($ad['budget_allocated'])?>" required style="border-radius: 8px 0 0 8px; height: 46px;">
                            <div class="input-group-append">
                                <span class="input-group-text bg-light font-weight-600">TZS</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="cost_per_click" class="font-weight-700 text-dark small text-uppercase">Reward per Reader View (TZS) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" name="cost_per_click" id="cost_per_click" class="form-control font-weight-700" value="<?=htmlspecialchars($ad['cost_per_click'])?>" required style="border-radius: 8px 0 0 8px; height: 46px;">
                            <div class="input-group-append">
                                <span class="input-group-text bg-light font-weight-600">TZS</span>
                            </div>
                        </div>
                    </div>

                    <!-- Single Bonus Question High Payout Section -->
                    <div id="bonus-budget-card" class="p-3 mb-3 border rounded-lg" style="<?=$hasBonusInitial ? 'display: block;' : 'display: none;'?> background: #fffdf5; border-color: #fde68a !important; border-radius: 12px; box-shadow: 0 2px 8px rgba(245, 158, 11, 0.08);">
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
                                <input type="number" name="bonus" id="bonus_payout" class="form-control font-weight-700" placeholder="500" min="50" step="50" value="<?=htmlspecialchars($ad['bonus'] ?? '')?>" style="border-radius: 8px 0 0 8px; height: 46px; border-color: #fcd34d;" <?=$hasBonusInitial ? 'required' : 'disabled'?>>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-warning text-dark font-weight-700" style="border-color: #fcd34d;">TZS</span>
                                </div>
                            </div>
                            <small class="form-text text-muted">Must be significantly higher than standard reward to incentivize readers.</small>
                        </div>

                        <div class="form-group mb-1">
                            <label for="total_bonus_allocated" class="font-weight-700 text-dark small text-uppercase">Total Bonus Budget (TZS) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="total_bonus_allocated" id="total_bonus_allocated" class="form-control font-weight-700" placeholder="15000" min="500" step="100" value="<?=htmlspecialchars($ad['total_bonus_allocated'] ?? '')?>" style="border-radius: 8px 0 0 8px; height: 46px; border-color: #fcd34d;" <?=$hasBonusInitial ? 'required' : 'disabled'?>>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-warning text-dark font-weight-700" style="border-color: #fcd34d;">TZS</span>
                                </div>
                            </div>
                            <small class="form-text text-muted">Dedicated pool reserved exclusively for readers who ace the bonus question.</small>
                        </div>
                    </div>

                    <!-- Audience Reach & ROI Preview -->
                    <div class="p-3 bg-light rounded-lg mb-3" style="border-radius: 12px; border: 1px dashed #cbd5e1;">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small font-weight-700 text-dark text-uppercase">Standard Viewers:</span>
                            <span class="font-weight-800 text-primary" id="estimated_reach">0 Viewers</span>
                        </div>
                        <div class="justify-content-between align-items-center mb-1" id="bonus-reach-row" style="<?=$hasBonusInitial ? 'display: flex;' : 'display: none;'?>">
                            <span class="small font-weight-700 text-warning text-uppercase"><i class="fas fa-crown mr-1"></i> Bonus Winners:</span>
                            <span class="font-weight-800 text-warning" id="estimated_bonus_reach">0 Winners</span>
                        </div>
                        <div class="justify-content-between align-items-center pt-2 mt-1 border-top" id="total-investment-row" style="<?=$hasBonusInitial ? 'display: flex;' : 'display: none;'?>">
                            <span class="small font-weight-800 text-dark text-uppercase">Total Campaign Budget:</span>
                            <span class="font-weight-800 text-success" id="total_campaign_budget">0 TZS</span>
                        </div>
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
var qCount = <?=max(1, count($standardQuestions))?>;
var hasBonus = <?=$hasBonusInitial ? 'true' : 'false'?>;

function updateBonusUI() {
    if (hasBonus) {
        $('#bonus-question-container').show();
        $('#bonus_is_bonus').prop('disabled', false);
        $('#bonus_text, #bonus_answers, #bonus_correct').prop('disabled', false).prop('required', true);

        $('#bonus-budget-card').show();
        $('#bonus_payout, #total_bonus_allocated').prop('disabled', false).prop('required', true);

        $('#bonus-reach-row, #total-investment-row').css('display', 'flex');
        $('#addBonusQuestionBtn').removeClass('btn-outline-warning').addClass('btn-warning text-dark')
            .html('<i class="fas fa-check mr-1"></i> Bonus Active (1/1)').prop('disabled', true);
        $('#bonus-status-badge').removeClass('badge-light text-muted').addClass('badge-warning text-dark')
            .html('<i class="fas fa-crown mr-1"></i> Single Bonus Question Active');
    } else {
        $('#bonus-question-container').hide();
        $('#bonus_is_bonus').prop('disabled', true);
        $('#bonus_text, #bonus_answers, #bonus_correct').prop('disabled', true).prop('required', false);

        $('#bonus-budget-card').hide();
        $('#bonus_payout, #total_bonus_allocated').prop('disabled', true).prop('required', false);

        $('#bonus-reach-row, #total-investment-row').hide();
        $('#addBonusQuestionBtn').removeClass('btn-warning text-dark').addClass('btn-outline-warning text-dark')
            .html('<i class="fas fa-crown text-warning mr-1"></i> Add Bonus Question').prop('disabled', false);
        $('#bonus-status-badge').removeClass('badge-warning text-dark').addClass('badge-light text-muted')
            .html('<i class="fas fa-star text-muted mr-1"></i> Single Bonus Question: Optional');
    }
    calculateReach();
}

function calculateReach() {
    var budget = parseFloat($('#budget_allocated').val()) || 0;
    var cpc = parseFloat($('#cost_per_click').val()) || 0;
    if (budget > 0 && cpc > 0) {
        var reach = Math.floor(budget / cpc);
        $('#estimated_reach').text(reach.toLocaleString() + ' Viewers');
    } else {
        $('#estimated_reach').text('0 Viewers');
    }

    if (hasBonus) {
        var bonusBudget = parseFloat($('#total_bonus_allocated').val()) || 0;
        var bonusPayout = parseFloat($('#bonus_payout').val()) || 0;
        if (bonusBudget > 0 && bonusPayout > 0) {
            var bonusReach = Math.floor(bonusBudget / bonusPayout);
            $('#estimated_bonus_reach').text(bonusReach.toLocaleString() + ' Winners');
        } else {
            $('#estimated_bonus_reach').text('0 Winners');
        }
        var totalInvestment = budget + bonusBudget;
        $('#total_campaign_budget').text(totalInvestment.toLocaleString() + ' TZS');
    }
}

$('#addBonusQuestionBtn').click(function() {
    hasBonus = true;
    // Suggest high payout if currently empty
    var cpc = parseFloat($('#cost_per_click').val()) || 100;
    if (!$('#bonus_payout').val()) {
        $('#bonus_payout').val(cpc * 5);
    }
    if (!$('#total_bonus_allocated').val()) {
        var regBudget = parseFloat($('#budget_allocated').val()) || 50000;
        $('#total_bonus_allocated').val(Math.max(10000, Math.floor(regBudget * 0.3)));
    }
    $('#bonus-question-container').slideDown(250);
    $('#bonus-budget-card').slideDown(250);
    updateBonusUI();
});

$('#removeBonusBtn').click(function() {
    hasBonus = false;
    $('#bonus-question-container').slideUp(250);
    $('#bonus-budget-card').slideUp(250);
    updateBonusUI();
});

$('#budget_allocated, #cost_per_click, #bonus_payout, #total_bonus_allocated').on('input change', calculateReach);

$('#addQuestionBtn').click(function() {
    var html = '<div class="question-block card mb-3 border bg-light" id="q_block_' + qCount + '" style="border-radius: 12px;">' +
        '<div class="card-body p-3">' +
            '<div class="d-flex justify-content-between align-items-center mb-2">' +
                '<h6 class="font-weight-700 text-primary mb-0 q-number-title">Question #' + (qCount + 1) + '</h6>' +
                '<button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 remove-q-btn" onclick="removeQuestion(' + qCount + ')"><i class="fas fa-times"></i> Remove</button>' +
            '</div>' +
            '<div class="form-group mb-2">' +
                '<label for="q_' + qCount + '_text" class="small font-weight-600 text-muted mb-1">Question Text</label>' +
                '<input type="text" name="questions[' + qCount + '][text]" id="q_' + qCount + '_text" class="form-control" placeholder="Enter question..." required style="border-radius: 8px;">' +
            '</div>' +
            '<div class="row">' +
                '<div class="col-md-7 mb-2">' +
                    '<label for="q_' + qCount + '_answers" class="small font-weight-600 text-muted mb-1">Answer Options (Comma separated)</label>' +
                    '<input type="text" name="questions[' + qCount + '][answers]" id="q_' + qCount + '_answers" class="form-control" placeholder="Option 1, Option 2, Option 3" required style="border-radius: 8px;">' +
                '</div>' +
                '<div class="col-md-5 mb-2">' +
                    '<label for="q_' + qCount + '_correct" class="small font-weight-600 text-muted mb-1">Correct Answer (Exact match)</label>' +
                    '<input type="text" name="questions[' + qCount + '][correct]" id="q_' + qCount + '_correct" class="form-control" placeholder="Option 1" required style="border-radius: 8px;">' +
                '</div>' +
            '</div>' +
        '</div>' +
    '</div>';
    $('#questions-container').append(html);
    qCount++;
});

function removeQuestion(idx) {
    $('#q_block_' + idx).remove();
}

function previewBanner(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#banner-preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        $(input).next('.custom-file-label').html(input.files[0].name);
    }
}

// Initial reach calculation on load
$(document).ready(function() {
    updateBonusUI();
});

$('#edit-ad-form').submit(function(e) {
    e.preventDefault();
    var form = this;
    if (!form.checkValidity()) {
        form.reportValidity();
        return false;
    }

    var btn = $('#btnSubmitAd');
    var alertBox = $('#resubmit-alert');

    // Validation for Bonus Question if enabled
    if (hasBonus) {
        var cpc = parseFloat($('#cost_per_click').val()) || 0;
        var bonusPayout = parseFloat($('#bonus_payout').val()) || 0;
        var bonusBudget = parseFloat($('#total_bonus_allocated').val()) || 0;

        if (bonusPayout <= 0) {
            alertBox.html('<div class="alert alert-danger border-0 py-2 small mb-0"><i class="fas fa-exclamation-circle mr-1"></i> Please enter a valid high payout amount for the bonus question.</div>');
            $('#bonus_payout').focus();
            return false;
        }
        if (bonusBudget <= 0) {
            alertBox.html('<div class="alert alert-danger border-0 py-2 small mb-0"><i class="fas fa-exclamation-circle mr-1"></i> Please enter a valid total bonus budget.</div>');
            $('#total_bonus_allocated').focus();
            return false;
        }
        if (bonusPayout <= cpc) {
            alertBox.html('<div class="alert alert-danger border-0 py-2 small mb-0"><i class="fas fa-exclamation-circle mr-1"></i> Bonus question payout (' + bonusPayout.toLocaleString() + ' TZS) must be strictly higher than the standard reward per view (' + cpc.toLocaleString() + ' TZS).</div>');
            $('#bonus_payout').focus();
            return false;
        }
        if (bonusPayout > bonusBudget) {
            alertBox.html('<div class="alert alert-danger border-0 py-2 small mb-0"><i class="fas fa-exclamation-circle mr-1"></i> Bonus question payout cannot exceed the total allocated bonus budget.</div>');
            $('#bonus_payout').focus();
            return false;
        }
    }

    var formData = new FormData(form);
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Submitting for Review...');
    alertBox.html('');

    $.ajax({
        url: '<?=base_url("business/update_ad")?>',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
            if (res.trim() == 'Success') {
                alertBox.html('<div class="alert alert-success border-0 py-2 small mb-0"><i class="fas fa-check-circle mr-1"></i> Campaign updated successfully! It has been returned to PENDING REVIEW for administrator verification.</div>');
                setTimeout(function() {
                    window.location.href = '<?=base_url("business/ads?status=2")?>';
                }, 1500);
            } else {
                btn.prop('disabled', false).html('<i class="fas fa-paper-plane mr-2"></i> Resubmit for Admin Review');
                alertBox.html('<div class="alert alert-danger border-0 py-2 small mb-0">' + res + '</div>');
            }
        },
        error: function() {
            btn.prop('disabled', false).html('<i class="fas fa-paper-plane mr-2"></i> Resubmit for Admin Review');
            alertBox.html('<div class="alert alert-danger border-0 py-2 small mb-0"><i class="fas fa-exclamation-triangle mr-1"></i> An unexpected server error occurred. Please try again.</div>');
        }
    });
});
</script>
