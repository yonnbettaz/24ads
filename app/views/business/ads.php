<!-- Page Header -->
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="font-weight-800 text-dark mb-1" style="font-size: 22px;">Ad Campaigns</h4>
        <p class="text-muted small mb-0">Manage all your Pay-Per-View advertising campaigns and track viewer engagements.</p>
    </div>
    <a href="<?=base_url('business/new_ads')?>" class="btn btn-primary font-weight-700 shadow-sm px-3 py-2" style="border-radius: 10px; font-size: 13px;">
        <i class="fas fa-plus-circle mr-1"></i> Create New Ad
    </a>
</div>

<!-- Status Filter Tabs -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-body p-2">
        <ul class="nav nav-pills custom-status-pills">
            <li class="nav-item mr-2">
                <a class="nav-link font-weight-600 <?=empty($current_filter) && $current_filter !== '0' ? 'active' : ''?>" href="<?=base_url('business/ads')?>" style="border-radius: 8px; font-size: 13px;">
                    All Campaigns <span class="badge badge-light ml-1"><?=$stats['total_ads'] ?? 0?></span>
                </a>
            </li>
            <li class="nav-item mr-2">
                <a class="nav-link font-weight-600 <?=$current_filter === '1' ? 'active' : ''?>" href="<?=base_url('business/ads?status=1')?>" style="border-radius: 8px; font-size: 13px;">
                    <i class="fas fa-check-circle text-success mr-1"></i> Active <span class="badge badge-light ml-1"><?=$stats['active_ads'] ?? 0?></span>
                </a>
            </li>
            <li class="nav-item mr-2">
                <a class="nav-link font-weight-600 <?=$current_filter === '2' ? 'active' : ''?>" href="<?=base_url('business/ads?status=2')?>" style="border-radius: 8px; font-size: 13px;">
                    <i class="fas fa-hourglass-half text-warning mr-1"></i> Pending <span class="badge badge-light ml-1"><?=$stats['pending_ads'] ?? 0?></span>
                </a>
            </li>
            <li class="nav-item mr-2">
                <a class="nav-link font-weight-600 <?=$current_filter === '0' ? 'active' : ''?>" href="<?=base_url('business/ads?status=0')?>" style="border-radius: 8px; font-size: 13px;">
                    <i class="fas fa-ban text-secondary mr-1"></i> Closed <span class="badge badge-light ml-1"><?=$stats['closed_ads'] ?? 0?></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-600 <?=$current_filter === '3' ? 'active' : ''?>" href="<?=base_url('business/ads?status=3')?>" style="border-radius: 8px; font-size: 13px;">
                    <i class="fas fa-times-circle text-danger mr-1"></i> Denied <span class="badge badge-light ml-1"><?=$stats['denied_ads'] ?? 0?></span>
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Campaigns Table Card -->
<div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-center align-middle mb-0">
                <thead class="bg-light text-muted" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th style="width: 70px;">Banner</th>
                        <th>Campaign Details</th>
                        <th class="text-center">Questions</th>
                        <th>Cost / View</th>
                        <th>Budget Allocated</th>
                        <th class="text-center">Total Views</th>
                        <th>Total Spent</th>
                        <th class="text-center">Status</th>
                        <th class="text-right pr-4">Action</th>
                    </tr>
                </thead>
                <tbody style="font-size: 13.5px;">
                    <?php
                    if(!empty($ads)){
                        $counter = 0;
                        foreach ($ads as $ad){
                            $counter++;

                            // Status Badge
                            $status_badge = '';
                            if($ad->ads_status == '1'){
                                $status_badge = '<span class="badge badge-pill badge-success font-weight-700 px-2 py-1" style="background: rgba(16,185,129,0.12); color: #10b981; font-size: 11.5px;"><i class="fas fa-circle mr-1" style="font-size: 7px;"></i> Active</span>';
                            }elseif($ad->ads_status == '2'){
                                $status_badge = '<span class="badge badge-pill badge-warning font-weight-700 px-2 py-1" style="background: rgba(245,158,11,0.15); color: #d97706; font-size: 11.5px;"><i class="fas fa-hourglass-half mr-1" style="font-size: 8px;"></i> Under Review</span>';
                            }elseif($ad->ads_status == '0'){
                                $status_badge = '<span class="badge badge-pill badge-secondary font-weight-700 px-2 py-1" style="background: rgba(100,116,139,0.12); color: #64748b; font-size: 11.5px;"><i class="fas fa-ban mr-1" style="font-size: 8px;"></i> Closed</span>';
                            }elseif($ad->ads_status == '3'){
                                $status_badge = '<span class="badge badge-pill badge-danger font-weight-700 px-2 py-1" style="background: rgba(239,68,68,0.12); color: #ef4444; font-size: 11.5px;"><i class="fas fa-times-circle mr-1" style="font-size: 8px;"></i> Denied</span>';
                            }

                            $banner_img = (!empty($ad->banner) && file_exists(FCPATH.'media/banner/'.$ad->banner))
                                ? base_url('media/banner/'.$ad->banner)
                                : base_url('assets/themes/ad_placeholder.jpg');

                            $budget = (float)($ad->budget_allocated ?? 0);
                            $spent = (float)($ad->total_spent ?? 0);
                            $percent_spent = $budget > 0 ? min(100, round(($spent / $budget) * 100)) : 0;
                    ?>
                        <tr>
                            <td class="text-center font-weight-600 text-muted"><?=$counter?></td>
                            <td>
                                <img src="<?=$banner_img?>" alt="<?=htmlspecialchars($ad->title)?>" class="rounded shadow-xs" style="width: 54px; height: 40px; object-fit: cover; border: 1px solid #e2e8f0;">
                            </td>
                            <td>
                                <span class="font-weight-700 text-dark d-block text-truncate" style="max-width: 240px;" title="<?=htmlspecialchars($ad->title)?>">
                                    <?=htmlspecialchars($ad->title)?>
                                </span>
                                <div class="d-flex align-items-center small text-muted mt-1">
                                    <span class="mr-2"><i class="far fa-calendar-alt mr-1"></i> <?=date('d M Y', strtotime($ad->date_uploaded))?></span>
                                    <?php if(!empty($ad->question_timer)){ ?>
                                        <span><i class="far fa-clock mr-1"></i> <?=$ad->question_timer?>s</span>
                                    <?php } ?>
                                </div>
                                <?php if($ad->ads_status == '3' && !empty($ad->rejected_reason)){ ?>
                                    <div class="text-danger small mt-1 font-weight-600">
                                        <i class="fas fa-exclamation-triangle mr-1"></i> Reason: <?=htmlspecialchars($ad->rejected_reason)?>
                                    </div>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-light font-weight-600 px-2 py-1" style="background: #f1f5f9; border-radius: 6px;">
                                    <i class="far fa-question-circle mr-1 text-primary"></i> <?=$ad->total_questions?>
                                </span>
                            </td>
                            <td class="text-dark font-weight-600">
                                <?=number_format((float)$ad->cost_per_click)?> TZS
                            </td>
                            <td>
                                <span class="font-weight-700 text-dark"><?=number_format($budget)?> TZS</span>
                                <progress value="<?=$percent_spent?>" max="100" style="width: 100px; height: 5px; border-radius: 10px; accent-color: var(--primary, #4f46e5);" title="<?=$percent_spent?>% of budget spent"></progress>
                            </td>
                            <td class="text-center font-weight-700 text-primary">
                                <?=number_format($ad->total_views)?>
                            </td>
                            <td class="font-weight-700 text-dark">
                                <?=number_format($spent)?> <span class="text-muted small">TZS</span>
                            </td>
                            <td class="text-center">
                                <?=$status_badge?>
                            </td>
                            <td class="text-right pr-4">
                                <div class="btn-group">
                                    <?php if($ad->ads_status == '3'){ ?>
                                        <a href="<?=base_url('business/edit_ad?ad='.$ad->id)?>" class="btn btn-sm btn-danger font-weight-700 px-2 py-1 mr-1" title="Edit & Resubmit" style="border-radius: 6px; font-size: 12px;">
                                            <i class="fas fa-edit mr-1"></i> Edit & Resubmit
                                        </a>
                                    <?php } elseif($ad->ads_status == '2') { ?>
                                        <a href="<?=base_url('business/edit_ad?ad='.$ad->id)?>" class="btn btn-sm btn-outline-warning font-weight-600 px-2 py-1 mr-1" title="Edit Pending Ad" style="border-radius: 6px; font-size: 12px;">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                    <?php } ?>
                                    <?php if(!empty($ad->url)){ ?>
                                        <a href="<?=htmlspecialchars($ad->url)?>" target="_blank" class="btn btn-sm btn-light font-weight-600 px-2 py-1 mr-1" title="Visit Link" style="border-radius: 6px; font-size: 12px;">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    <?php } ?>
                                    <a href="<?=base_url('home/ads_content?ads='.$ad->id)?>" target="_blank" class="btn btn-sm btn-outline-primary font-weight-600 px-2 py-1" title="Preview Ad" style="border-radius: 6px; font-size: 12px;">
                                        <i class="fas fa-eye mr-1"></i> Preview
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php
                        }
                    } else { ?>
                        <tr>
                            <td colspan="10" class="text-center py-5">
                                <div class="p-4">
                                    <div class="mb-3" style="width: 64px; height: 64px; border-radius: 50%; background: #f8fafc; display: inline-flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 28px;">
                                        <i class="fas fa-bullhorn"></i>
                                    </div>
                                    <h6 class="font-weight-700 text-secondary mb-1">No campaigns found for this filter</h6>
                                    <p class="text-muted small mb-3">Create or adjust filters to view your advertising campaigns.</p>
                                    <a href="<?=base_url('business/new_ads')?>" class="btn btn-primary font-weight-600 px-3 py-2" style="border-radius: 8px; font-size: 13px;">
                                        <i class="fas fa-plus mr-1"></i> Create New Ad
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