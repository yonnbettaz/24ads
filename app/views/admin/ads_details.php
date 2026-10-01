<!-- Advertisement Detailed Review Workstation -->
<?php
$bannerUrl = (!empty($info['banner']) && file_exists(FCPATH.'media/banner/'.$info['banner'])) 
    ? base_url('media/banner/'.$info['banner']) 
    : base_url('assets/themes/ad_placeholder.jpg');

$locationParts = array_filter([$info['country'] ?? '', $info['region'] ?? '', $info['district'] ?? '']);
$locationStr = !empty($locationParts) ? implode(', ', $locationParts) : 'National / Worldwide';
?>

<!-- Header Toolbar -->
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            <div>
                <a href="<?=base_url('admin/ads/all_ads')?>" class="text-muted small font-weight-700 mb-1 d-inline-block">
                    <i class="fa fa-arrow-left mr-1"></i> Back to Advertisements List
                </a>
                <h3 class="font-weight-800 text-dark mb-0" style="font-size: 22px;">
                    Review Campaign #<?=$info['id']?>: <?=htmlspecialchars($info['title'])?>
                </h3>
            </div>
            <!-- Action Buttons Toolbar -->
            <div class="mt-2 mt-md-0 d-flex align-items-center">
                <?php if($info['ads_status'] != '1'){ ?>
                    <button type="button" class="btn btn-success font-weight-700 shadow-sm px-3 py-2 mr-2" onclick="openApproveModal(<?=$info['id']?>, '<?=htmlspecialchars(addslashes($info['title']))?>')" style="border-radius: 8px;">
                        <i class="fa fa-check-circle mr-1"></i> Approve & Activate
                    </button>
                <?php } ?>

                <?php if($info['ads_status'] != '3'){ ?>
                    <button type="button" class="btn btn-danger font-weight-700 shadow-sm px-3 py-2 mr-2" onclick="openRejectModal(<?=$info['id']?>, '<?=htmlspecialchars(addslashes($info['title']))?>')" style="border-radius: 8px;">
                        <i class="fa fa-times-circle mr-1"></i> Reject Advertisement
                    </button>
                <?php } ?>

                <?php if($info['ads_status'] == '1'){ ?>
                    <button type="button" class="btn btn-secondary font-weight-700 shadow-sm px-3 py-2 mr-2" onclick="close_ads(<?=$info['id']?>)" style="border-radius: 8px;">
                        <i class="fa fa-ban mr-1"></i> Close Ad
                    </button>
                <?php } ?>

                <a href="<?=base_url('home/ads_content?ads='.$info['id'])?>" target="_blank" class="btn btn-light font-weight-700 px-3 py-2" style="border-radius: 8px; border: 1px solid #cbd5e1;">
                    <i class="fa fa-external-link mr-1"></i> Public Preview
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Status Banner Alert if Rejected or Pending -->
<?php if($info['ads_status'] == '3' && !empty($info['rejected_reason'])){ ?>
<div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 12px; background: #fef2f2; color: #991b1b; border-left: 5px solid #ef4444 !important;">
    <div class="d-flex align-items-center">
        <div class="mr-3" style="font-size: 24px;"><i class="fa fa-exclamation-triangle"></i></div>
        <div>
            <h6 class="font-weight-800 mb-1">Current Status: REJECTED</h6>
            <p class="mb-0 small"><strong>Rejection Reason:</strong> <?=htmlspecialchars($info['rejected_reason'])?></p>
            <?php if(!empty($info['rejected_date'])){ ?>
                <small class="text-muted d-block mt-1">Logged on: <?=date('d M Y, H:i', strtotime($info['rejected_date']))?></small>
            <?php } ?>
        </div>
    </div>
</div>
<?php } elseif($info['ads_status'] == '2'){ ?>
<div class="alert alert-warning border-0 shadow-sm mb-4" style="border-radius: 12px; background: #fffbeb; color: #92400e; border-left: 5px solid #f59e0b !important;">
    <div class="d-flex align-items-center">
        <div class="mr-3" style="font-size: 24px;"><i class="fa fa-clock-o"></i></div>
        <div>
            <h6 class="font-weight-800 mb-0">Current Status: PENDING REVIEW</h6>
            <p class="mb-0 small">This advertisement is hidden from public view until you verify its contents, images, and quiz questions.</p>
        </div>
    </div>
</div>
<?php } elseif($info['ads_status'] == '1'){ ?>
<div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 12px; background: #f0fdf4; color: #166534; border-left: 5px solid #10b981 !important;">
    <div class="d-flex align-items-center">
        <div class="mr-3" style="font-size: 24px;"><i class="fa fa-check-circle"></i></div>
        <div>
            <h6 class="font-weight-800 mb-0">Current Status: ACTIVE & PUBLISHED</h6>
            <p class="mb-0 small">This advertisement is currently active and visible to all viewers across the platform.</p>
        </div>
    </div>
</div>
<?php } ?>

<div class="row">
    <!-- Left Column: Banner Gallery & Advertisement Content -->
    <div class="col-lg-8 col-12 mb-4">
        <!-- Banner Inspection Gallery -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
            <div class="card-header bg-white border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="card-title font-weight-800 mb-0" style="font-size: 15px;">
                    <i class="fa fa-picture-o text-primary mr-2"></i>Advertisement Banner Gallery
                </h5>
                <button type="button" class="btn btn-sm btn-outline-primary font-weight-600" onclick="previewImage('<?=$bannerUrl?>', '<?=htmlspecialchars(addslashes($info['title']))?>')">
                    <i class="fa fa-search-plus mr-1"></i> Inspect Full-Size
                </button>
            </div>
            <div class="card-body p-4 text-center" style="background: #f8fafc;">
                <div class="position-relative d-inline-block">
                    <img src="<?=$bannerUrl?>" alt="<?=htmlspecialchars($info['title'])?>" class="img-fluid rounded shadow-sm" style="max-height: 380px; width: 100%; object-fit: cover; border: 1px solid #e2e8f0; cursor: pointer;" onclick="previewImage('<?=$bannerUrl?>', '<?=htmlspecialchars(addslashes($info['title']))?>')">
                    <span class="badge badge-dark position-absolute p-2" style="bottom: 12px; right: 12px; opacity: 0.85; border-radius: 6px;">
                        <i class="fa fa-search mr-1"></i> Click to Zoom
                    </span>
                </div>
            </div>
        </div>

        <!-- Advertisement Story & Description -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h5 class="card-title font-weight-800 mb-0" style="font-size: 15px;">
                    <i class="fa fa-align-left text-primary mr-2"></i>Advertisement Copy & Content
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="p-3 rounded mb-3" style="background: #f8fafc; border: 1px solid #e2e8f0; font-size: 14.5px; line-height: 1.7; color: #1e293b; white-space: pre-wrap;">
<?=htmlspecialchars($info['contents'])?>
                </div>

                <?php if(!empty($info['url'])){ ?>
                    <div class="p-3 rounded d-flex align-items-center justify-content-between" style="background: #eff6ff; border: 1px solid #bfdbfe;">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-link text-primary mr-2" style="font-size: 18px;"></i>
                            <div>
                                <small class="text-muted d-block">Destination Website / Target URL</small>
                                <a href="<?=htmlspecialchars($info['url'])?>" target="_blank" class="font-weight-700 text-primary text-break">
                                    <?=htmlspecialchars($info['url'])?> <i class="fa fa-external-link ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Quiz Questions Inspection -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="card-title font-weight-800 mb-0" style="font-size: 15px;">
                    <i class="fa fa-question-circle text-primary mr-2"></i>Attached Quiz Questions
                </h5>
                <span class="badge badge-light font-weight-700 p-2">
                    <?=count($info['questions'] ?? [])?> Questions Attached
                </span>
            </div>
            <div class="card-body p-4">
                <?php if(!empty($info['questions'])){
                    $qNum = 0;
                    foreach($info['questions'] as $q){
                        $qNum++;
                ?>
                    <div class="p-3 mb-3 rounded" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="font-weight-700 text-dark mb-0">Question #<?=$qNum?></h6>
                            <?php if(!empty($q['is_bonus']) && $q['is_bonus'] == '1'){ ?>
                                <span class="badge badge-warning font-weight-700 text-dark px-2 py-1"><i class="fa fa-star mr-1"></i> Bonus Question</span>
                            <?php } ?>
                        </div>
                        <p class="font-weight-600 text-dark mb-2"><?=htmlspecialchars($q['question'])?></p>
                        
                        <?php if(!empty($q['answers'])){
                            $answers = array_map('trim', explode(',', $q['answers']));
                        ?>
                            <div class="ml-2 mb-2">
                                <small class="text-muted font-weight-700 text-uppercase d-block mb-1" style="font-size: 11px;">Options:</small>
                                <div class="row">
                                    <?php foreach($answers as $ans){ 
                                        $isCorrect = (trim(strtolower($ans)) == trim(strtolower($q['correct_answer'] ?? '')));
                                    ?>
                                        <div class="col-sm-6 col-12 mb-1">
                                            <div class="p-2 rounded small font-weight-600 <?= $isCorrect ? 'bg-success text-white' : 'bg-white border' ?>">
                                                <i class="fa <?= $isCorrect ? 'fa-check-circle' : 'fa-circle-o' ?> mr-1"></i>
                                                <?=htmlspecialchars($ans)?>
                                                <?= $isCorrect ? ' <span class="badge badge-light text-success float-right">Correct</span>' : '' ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } } else { ?>
                    <p class="text-muted small mb-0">No quiz questions attached to this advertisement.</p>
                <?php } ?>
            </div>
        </div>

        <!-- Approval History & Audit Trail (Requirement 11) -->
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h5 class="card-title font-weight-800 mb-0" style="font-size: 15px;">
                    <i class="fa fa-history text-primary mr-2"></i>Audit History for This Advertisement
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                        <thead class="bg-light text-muted" style="font-size: 11.5px; text-transform: uppercase;">
                            <tr>
                                <th>Action</th>
                                <th>Moderator / Actor</th>
                                <th>Reason / Comment</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($info['history'])){
                                foreach($info['history'] as $h){
                                    $actionBadge = '';
                                    if($h->action == 'APPROVED'){
                                        $actionBadge = '<span class="badge badge-success font-weight-700 px-2 py-1"><i class="fa fa-check mr-1"></i> APPROVED</span>';
                                    } elseif($h->action == 'REJECTED'){
                                        $actionBadge = '<span class="badge badge-danger font-weight-700 px-2 py-1"><i class="fa fa-times mr-1"></i> REJECTED</span>';
                                    } elseif($h->action == 'RESUBMITTED'){
                                        $actionBadge = '<span class="badge badge-info font-weight-700 px-2 py-1"><i class="fa fa-refresh mr-1"></i> RESUBMITTED</span>';
                                    } elseif($h->action == 'CLOSED'){
                                        $actionBadge = '<span class="badge badge-secondary font-weight-700 px-2 py-1"><i class="fa fa-ban mr-1"></i> CLOSED</span>';
                                    } else {
                                        $actionBadge = '<span class="badge badge-light font-weight-700 px-2 py-1">'.htmlspecialchars($h->action).'</span>';
                                    }
                            ?>
                                <tr>
                                    <td><?=$actionBadge?></td>
                                    <td>
                                        <strong class="text-dark"><?=htmlspecialchars($h->admin_name ?: ($h->admin_username ?: 'System User'))?></strong>
                                    </td>
                                    <td>
                                        <span class="text-muted"><?=htmlspecialchars($h->comment ?: '-')?></span>
                                    </td>
                                    <td class="text-muted font-weight-500">
                                        <?=date('d M Y, H:i', strtotime($h->created_at))?>
                                    </td>
                                </tr>
                            <?php } } else { ?>
                                <tr><td colspan="4" class="text-center py-4 text-muted small">No audit history recorded yet for this ad.</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Campaign Budget & Creator/Business Information -->
    <div class="col-lg-4 col-12">
        <!-- Campaign Financial & Targeting Overview -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h5 class="card-title font-weight-800 mb-0" style="font-size: 15px;">
                    <i class="fa fa-calculator text-primary mr-2"></i>Financial & Metrics
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small font-weight-600">Current Status:</span>
                    <div><?=ad_status_badge($info['ads_status'])?></div>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small font-weight-600">Total Budget:</span>
                    <strong class="text-dark font-weight-800"><?=number_format((float)$info['budget_allocated'])?> TZS</strong>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small font-weight-600">Cost per View / Question:</span>
                    <strong class="text-primary font-weight-700"><?=number_format((float)$info['cost_per_click'])?> TZS</strong>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small font-weight-600">Total Bonus Allocated:</span>
                    <span class="text-dark font-weight-600"><?=number_format((float)$info['total_bonus_allocated'])?> TZS</span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small font-weight-600">Bonus per Viewer:</span>
                    <span class="text-dark font-weight-600"><?=number_format((float)$info['bonus'])?> TZS</span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small font-weight-600">Timer per Question:</span>
                    <span class="text-dark font-weight-600"><?=$info['question_timer'] ?: 2?> Seconds</span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small font-weight-600">Target Location:</span>
                    <span class="text-dark font-weight-600 text-right"><?=htmlspecialchars($locationStr)?></span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small font-weight-600">Created Date:</span>
                    <span class="text-muted small"><?=date('d M Y, H:i', strtotime($info['date_uploaded']))?></span>
                </div>
                <?php if(!empty($info['updated_at'])){ ?>
                <div class="d-flex justify-content-between py-2">
                    <span class="text-muted small font-weight-600">Last Modified:</span>
                    <span class="text-muted small"><?=date('d M Y, H:i', strtotime($info['updated_at']))?></span>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- Advertiser / Business Profile Card -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h5 class="card-title font-weight-800 mb-0" style="font-size: 15px;">
                    <i class="fa fa-briefcase text-primary mr-2"></i>Advertiser Profile
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="mr-3" style="width: 50px; height: 50px; border-radius: 12px; background: rgba(79, 70, 229, 0.1); color: #4f46e5; display: flex; align-items: center; justify-content: center; font-size: 22px;">
                        <i class="fa fa-building"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-800 text-dark mb-0"><?=htmlspecialchars($info['business_name'])?></h6>
                        <small class="text-muted">Owner: <?=htmlspecialchars($info['owner_name'] ?: 'N/A')?></small>
                    </div>
                </div>

                <div class="py-2 border-bottom d-flex justify-content-between small">
                    <span class="text-muted font-weight-600"><i class="fa fa-phone mr-1"></i> Phone:</span>
                    <span class="font-weight-600 text-dark"><?=htmlspecialchars($info['business_phone'] ?: '-')?></span>
                </div>
                <div class="py-2 border-bottom d-flex justify-content-between small">
                    <span class="text-muted font-weight-600"><i class="fa fa-envelope mr-1"></i> Email:</span>
                    <span class="font-weight-600 text-dark text-truncate" style="max-width: 180px;"><?=htmlspecialchars($info['business_email'] ?: '-')?></span>
                </div>
                <?php if(!empty($info['business_website'])){ ?>
                <div class="py-2 border-bottom d-flex justify-content-between small">
                    <span class="text-muted font-weight-600"><i class="fa fa-globe mr-1"></i> Website:</span>
                    <a href="<?=htmlspecialchars($info['business_website'])?>" target="_blank" class="font-weight-600 text-primary text-truncate" style="max-width: 180px;">
                        <?=htmlspecialchars($info['business_website'])?>
                    </a>
                </div>
                <?php } ?>
                <?php if(!empty($info['TIN'])){ ?>
                <div class="py-2 border-bottom d-flex justify-content-between small">
                    <span class="text-muted font-weight-600">TIN Number:</span>
                    <span class="font-weight-600 text-dark"><?=htmlspecialchars($info['TIN'])?></span>
                </div>
                <?php } ?>
                <?php if(!empty($info['business_address'])){ ?>
                <div class="py-2 d-flex justify-content-between small">
                    <span class="text-muted font-weight-600">Address:</span>
                    <span class="font-weight-600 text-dark text-right"><?=htmlspecialchars($info['business_address'])?></span>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>