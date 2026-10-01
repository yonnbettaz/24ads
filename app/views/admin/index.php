<!-- Admin Dashboard -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            <div>
                <h3 class="font-weight-800 text-dark mb-1" style="font-size: 24px; letter-spacing: -0.5px;">
                    <i class="fe fe-activity text-primary mr-2"></i>Advertisement Administration Dashboard
                </h3>
                <p class="text-muted mb-0 font-weight-500">
                    Administrator-controlled ad approval overview, real-time workflow statistics, and moderation audit logs.
                </p>
            </div>
            <div class="mt-2 mt-md-0">
                <a href="<?=base_url('admin/ads/pending_ads')?>" class="btn btn-warning font-weight-700 shadow-sm px-3 py-2 mr-2" style="border-radius: 8px;">
                    <i class="fa fa-clock-o mr-1"></i> Review Pending Ads (<?=$pending_ads?>)
                </a>
                <a href="<?=base_url('admin/ads/all_ads')?>" class="btn btn-primary font-weight-700 shadow-sm px-3 py-2" style="border-radius: 8px;">
                    <i class="fa fa-list mr-1"></i> All Campaigns
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Primary Workflow Summary Cards (Top Row) -->
<div class="row">
    <!-- Total Ads -->
    <div class="col-xl-3 col-sm-6 col-12 mb-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border-left: 4px solid #3b82f6 !important;">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted font-weight-700 text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Total Advertisements</span>
                    <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                        <i class="fe fe-folder"></i>
                    </div>
                </div>
                <h2 class="font-weight-800 text-dark mb-1"><?=number_format($total_ads)?></h2>
                <div class="d-flex align-items-center small text-muted">
                    <a href="<?=base_url('admin/ads/all_ads')?>" class="text-primary font-weight-600">View all ads <i class="fa fa-arrow-right ml-1"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Ads -->
    <div class="col-xl-3 col-sm-6 col-12 mb-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border-left: 4px solid #f59e0b !important; background: linear-gradient(to right, #ffffff, #fffbeb);">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-warning font-weight-700 text-uppercase" style="font-size: 11px; letter-spacing: 0.5px; color: #b45309 !important;">Pending Review</span>
                    <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(245, 158, 11, 0.15); color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                        <i class="fe fe-clock"></i>
                    </div>
                </div>
                <h2 class="font-weight-800 text-dark mb-1 text-warning" style="color: #b45309 !important;"><?=number_format($pending_ads)?></h2>
                <div class="d-flex align-items-center small">
                    <a href="<?=base_url('admin/ads/pending_ads')?>" class="text-warning font-weight-700" style="color: #b45309 !important;">Requires Administrator Review <i class="fa fa-chevron-right ml-1"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Ads -->
    <div class="col-xl-3 col-sm-6 col-12 mb-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border-left: 4px solid #10b981 !important;">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted font-weight-700 text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Active / Published</span>
                    <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                        <i class="fe fe-check-circle"></i>
                    </div>
                </div>
                <h2 class="font-weight-800 text-dark mb-1"><?=number_format($active_ads)?></h2>
                <div class="d-flex align-items-center small text-muted">
                    <span class="text-success font-weight-600"><i class="fa fa-eye mr-1"></i> Visible to public users</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Rejected Ads -->
    <div class="col-xl-3 col-sm-6 col-12 mb-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border-left: 4px solid #ef4444 !important;">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted font-weight-700 text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Rejected Ads</span>
                    <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(239, 68, 68, 0.1); color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                        <i class="fe fe-x-circle"></i>
                    </div>
                </div>
                <h2 class="font-weight-800 text-dark mb-1"><?=number_format($rejected_ads)?></h2>
                <div class="d-flex align-items-center small text-muted">
                    <a href="<?=base_url('admin/ads/denied_ads')?>" class="text-danger font-weight-600">View rejection logs <i class="fa fa-arrow-right ml-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Secondary Today Daily Pulse Statistics (Requirement 3 & 17) -->
<div class="row mb-4">
    <div class="col-md-4 col-sm-12 mb-3 mb-md-0">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: #ffffff;">
            <div class="card-body py-3 px-4 d-flex align-items-center">
                <div class="mr-3" style="width: 44px; height: 44px; border-radius: 50%; background: rgba(79, 70, 229, 0.1); color: #4f46e5; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fa fa-upload"></i>
                </div>
                <div>
                    <h4 class="font-weight-800 text-dark mb-0"><?=$ads_created_today?></h4>
                    <span class="text-muted small font-weight-600">Ads Created Today</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12 mb-3 mb-md-0">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: #ffffff;">
            <div class="card-body py-3 px-4 d-flex align-items-center">
                <div class="mr-3" style="width: 44px; height: 44px; border-radius: 50%; background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fa fa-check"></i>
                </div>
                <div>
                    <h4 class="font-weight-800 text-dark mb-0"><?=$ads_approved_today?></h4>
                    <span class="text-muted small font-weight-600">Ads Approved Today</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: #ffffff;">
            <div class="card-body py-3 px-4 d-flex align-items-center">
                <div class="mr-3" style="width: 44px; height: 44px; border-radius: 50%; background: rgba(239, 68, 68, 0.1); color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fa fa-times"></i>
                </div>
                <div>
                    <h4 class="font-weight-800 text-dark mb-0"><?=$ads_rejected_today?></h4>
                    <span class="text-muted small font-weight-600">Ads Rejected Today</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Pending Advertisements Table (Immediate Action Required) -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
            <div class="card-header bg-white border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title font-weight-800 mb-0" style="color: #0f172a; font-size: 16px;">
                        <i class="fa fa-hourglass-half text-warning mr-2"></i>Recent Pending Advertisements
                    </h5>
                    <small class="text-muted">Campaigns awaiting administrator review before being published publicly</small>
                </div>
                <a href="<?=base_url('admin/ads/pending_ads')?>" class="btn btn-sm btn-outline-warning font-weight-700" style="border-radius: 6px;">
                    View All Pending (<?=$pending_ads?>)
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted" style="font-size: 11.5px; text-transform: uppercase; letter-spacing: 0.5px;">
                            <tr>
                                <th class="text-center" style="width: 60px;">ID</th>
                                <th style="width: 80px;">Banner</th>
                                <th>Ad Title & Business</th>
                                <th>Budget</th>
                                <th>Cost / Click</th>
                                <th>Submitted Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-right pr-4">Review Action</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 13px;">
                            <?php if(!empty($recent_pending)){
                                foreach($recent_pending as $ad){
                                    $bannerUrl = (!empty($ad->banner) && file_exists(FCPATH.'media/banner/'.$ad->banner)) 
                                        ? base_url('media/banner/'.$ad->banner) 
                                        : base_url('assets/themes/ad_placeholder.jpg');
                            ?>
                            <tr>
                                <td class="text-center font-weight-700 text-muted">#<?=$ad->id?></td>
                                <td>
                                    <img src="<?=$bannerUrl?>" alt="Banner" class="rounded shadow-xs" style="width: 60px; height: 40px; object-fit: cover; border: 1px solid #e2e8f0; cursor: pointer;" onclick="previewImage('<?=$bannerUrl?>', '<?=htmlspecialchars(addslashes($ad->title))?>')">
                                </td>
                                <td>
                                    <span class="font-weight-700 text-dark d-block text-truncate" style="max-width: 280px;">
                                        <?=htmlspecialchars($ad->title)?>
                                    </span>
                                    <small class="text-muted">By: <strong class="text-secondary"><?=htmlspecialchars($ad->business_name)?></strong></small>
                                </td>
                                <td class="font-weight-700 text-dark"><?=number_format((float)$ad->budget_allocated)?> <small>TZS</small></td>
                                <td class="font-weight-600 text-muted"><?=number_format((float)$ad->cost_per_click)?> <small>TZS</small></td>
                                <td class="text-muted"><i class="fa fa-calendar mr-1"></i> <?=date('d M Y, H:i', strtotime($ad->date_uploaded))?></td>
                                <td class="text-center"><?=ad_status_badge($ad->ads_status)?></td>
                                <td class="text-right pr-4">
                                    <div class="btn-group">
                                        <a href="<?=base_url('admin/ads/review?ads='.$ad->id)?>" class="btn btn-sm btn-primary font-weight-600 px-3 py-1 mr-1" style="border-radius: 6px; font-size: 12px;">
                                            <i class="fa fa-search mr-1"></i> Review
                                        </a>
                                        <button type="button" class="btn btn-sm btn-success font-weight-600 px-2 py-1 mr-1" onclick="openApproveModal(<?=$ad->id?>, '<?=htmlspecialchars(addslashes($ad->title))?>')" title="Approve & Activate" style="border-radius: 6px;">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger font-weight-600 px-2 py-1" onclick="openRejectModal(<?=$ad->id?>, '<?=htmlspecialchars(addslashes($ad->title))?>')" title="Reject Ad" style="border-radius: 6px;">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php } } else { ?>
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <div class="p-3">
                                        <i class="fa fa-check-circle text-success mb-2" style="font-size: 32px;"></i>
                                        <p class="font-weight-600 mb-0">All caught up! No advertisements are currently awaiting review.</p>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Approval & Rejection Activity (Requirement 17) -->
<div class="row">
    <!-- Recent Approvals -->
    <div class="col-lg-6 col-12 mb-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; overflow: hidden;">
            <div class="card-header bg-white border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
                <h5 class="card-title font-weight-800 mb-0" style="color: #0f172a; font-size: 15px;">
                    <i class="fa fa-check-circle text-success mr-2"></i>Recent Approvals
                </h5>
                <a href="<?=base_url('admin/ads/approval_history?action=APPROVED')?>" class="text-primary font-weight-600 small">View Log</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 12.5px;">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th>Ad Details</th>
                                <th>Approved By</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($recent_approvals)){
                                foreach($recent_approvals as $app){ ?>
                                <tr>
                                    <td>
                                        <a href="<?=base_url('admin/ads/review?ads='.$app->ad_id)?>" class="font-weight-700 text-dark d-block text-truncate" style="max-width: 200px;">
                                            #<?=$app->ad_id?> - <?=htmlspecialchars($app->ad_title)?>
                                        </a>
                                        <small class="text-muted"><?=htmlspecialchars($app->business_name)?></small>
                                    </td>
                                    <td>
                                        <span class="badge badge-light font-weight-600 text-secondary">
                                            <i class="fa fa-user mr-1"></i><?=htmlspecialchars($app->admin_name ?: 'System Admin')?>
                                        </span>
                                    </td>
                                    <td class="text-muted font-weight-500">
                                        <?=date('d M, H:i', strtotime($app->created_at))?>
                                    </td>
                                </tr>
                            <?php } } else { ?>
                                <tr><td colspan="3" class="text-center py-4 text-muted small">No approval events recorded yet.</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Rejections -->
    <div class="col-lg-6 col-12 mb-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; overflow: hidden;">
            <div class="card-header bg-white border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
                <h5 class="card-title font-weight-800 mb-0" style="color: #0f172a; font-size: 15px;">
                    <i class="fa fa-times-circle text-danger mr-2"></i>Recent Rejections
                </h5>
                <a href="<?=base_url('admin/ads/approval_history?action=REJECTED')?>" class="text-danger font-weight-600 small">View Log</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 12.5px;">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th>Ad Details</th>
                                <th>Rejection Reason</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($recent_rejections)){
                                foreach($recent_rejections as $rej){ ?>
                                <tr>
                                    <td>
                                        <a href="<?=base_url('admin/ads/review?ads='.$rej->ad_id)?>" class="font-weight-700 text-dark d-block text-truncate" style="max-width: 180px;">
                                            #<?=$rej->ad_id?> - <?=htmlspecialchars($rej->ad_title)?>
                                        </a>
                                        <small class="text-muted"><?=htmlspecialchars($rej->business_name)?></small>
                                    </td>
                                    <td>
                                        <span class="text-danger font-weight-600 d-block text-truncate" style="max-width: 200px;" title="<?=htmlspecialchars($rej->comment)?>">
                                            <?=htmlspecialchars($rej->comment)?>
                                        </span>
                                        <small class="text-muted">By: <?=htmlspecialchars($rej->admin_name ?: 'Administrator')?></small>
                                    </td>
                                    <td class="text-muted font-weight-500">
                                        <?=date('d M, H:i', strtotime($rej->created_at))?>
                                    </td>
                                </tr>
                            <?php } } else { ?>
                                <tr><td colspan="3" class="text-center py-4 text-muted small">No rejection events recorded yet.</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>