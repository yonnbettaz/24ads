<!-- All Advertisements Management Table -->
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            <div>
                <h4 class="font-weight-800 text-dark mb-1" style="font-size: 20px;">
                    <i class="fe fe-list text-primary mr-2"></i>Advertisement Management
                </h4>
                <p class="text-muted small mb-0">Browse, filter, search, and manage all advertisements across the platform.</p>
            </div>
            <div class="mt-2 mt-md-0">
                <a href="<?=base_url('admin/ads/pending_ads')?>" class="btn btn-warning btn-sm font-weight-700 shadow-sm px-3 py-2 mr-2" style="border-radius: 8px;">
                    <i class="fa fa-clock-o mr-1"></i> Pending Approval
                </a>
                <a href="<?=base_url('admin/ads/approval_history')?>" class="btn btn-outline-secondary btn-sm font-weight-700 px-3 py-2" style="border-radius: 8px;">
                    <i class="fa fa-history mr-1"></i> Approval History
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Search & Filtering Toolbar -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-body p-3">
        <form method="GET" action="<?=base_url('admin/ads/all_ads')?>" class="form-row align-items-end">
            <!-- Search Keyword -->
            <div class="col-lg-4 col-md-6 col-12 mb-2 mb-lg-0">
                <label class="font-weight-700 text-muted small mb-1">Search Keywords</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-light border-right-0" style="border-color: #e2e8f0; color: #64748b;"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" name="search" class="form-control border-left-0" placeholder="Search by ID, Title, Business, Location..." value="<?=htmlspecialchars($filters['search'] ?? '')?>" style="border-color: #e2e8f0; font-size: 13px;">
                </div>
            </div>

            <!-- Status Filter -->
            <div class="col-lg-2 col-md-3 col-6 mb-2 mb-lg-0">
                <label class="font-weight-700 text-muted small mb-1">Status Filter</label>
                <select name="status" class="form-control custom-select" style="border-color: #e2e8f0; font-size: 13px;">
                    <option value="all" <?=($filters['status'] === '' || $filters['status'] === 'all' || !isset($filters['status'])) ? 'selected' : ''?>>All Statuses</option>
                    <option value="2" <?=($filters['status'] === '2') ? 'selected' : ''?>>Pending Review</option>
                    <option value="1" <?=($filters['status'] === '1') ? 'selected' : ''?>>Active (Published)</option>
                    <option value="3" <?=($filters['status'] === '3') ? 'selected' : ''?>>Rejected</option>
                    <option value="0" <?=($filters['status'] === '0') ? 'selected' : ''?>>Closed</option>
                </select>
            </div>

            <!-- Start Date -->
            <div class="col-lg-2 col-md-3 col-6 mb-2 mb-lg-0">
                <label class="font-weight-700 text-muted small mb-1">From Date</label>
                <input type="date" name="start_date" class="form-control" value="<?=htmlspecialchars($filters['start_date'] ?? '')?>" style="border-color: #e2e8f0; font-size: 13px;">
            </div>

            <!-- End Date -->
            <div class="col-lg-2 col-md-3 col-6 mb-2 mb-lg-0">
                <label class="font-weight-700 text-muted small mb-1">To Date</label>
                <input type="date" name="end_date" class="form-control" value="<?=htmlspecialchars($filters['end_date'] ?? '')?>" style="border-color: #e2e8f0; font-size: 13px;">
            </div>

            <!-- Submit & Reset Buttons -->
            <div class="col-lg-2 col-md-3 col-6">
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary font-weight-700 w-100 mr-2" style="border-radius: 8px; font-size: 13px;">
                        <i class="fa fa-filter mr-1"></i> Filter
                    </button>
                    <a href="<?=base_url('admin/ads/all_ads')?>" class="btn btn-light font-weight-600 px-3" title="Clear Filters" style="border-radius: 8px; border: 1px solid #e2e8f0;">
                        <i class="fa fa-refresh"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Advertisements Table -->
<div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
    <div class="card-header bg-white border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
        <h5 class="card-title font-weight-800 text-dark mb-0" style="font-size: 15px;">
            Total Advertisements Found: <span class="text-primary font-weight-800"><?=number_format($total_records)?></span>
        </h5>
        <?php if(!empty($filters['search']) || (isset($filters['status']) && $filters['status'] !== 'all' && $filters['status'] !== '')){ ?>
            <span class="badge badge-light text-muted font-weight-600 p-2">
                <i class="fa fa-info-circle mr-1"></i> Filtered Results
            </span>
        <?php } ?>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted" style="font-size: 11.5px; text-transform: uppercase; letter-spacing: 0.5px;">
                    <tr>
                        <th class="text-center" style="width: 50px;">ID</th>
                        <th style="width: 70px;">Banner</th>
                        <th>Title & Business</th>
                        <th>Location</th>
                        <th>Budget</th>
                        <th>Cost / View</th>
                        <th>Created Date</th>
                        <th class="text-center">Status</th>
                        <th>Moderated By</th>
                        <th class="text-right pr-4">Actions</th>
                    </tr>
                </thead>
                <tbody style="font-size: 13px;">
                    <?php if(!empty($ads)){
                        foreach($ads as $ad){
                            $bannerUrl = (!empty($ad->banner) && file_exists(FCPATH.'media/banner/'.$ad->banner)) 
                                ? base_url('media/banner/'.$ad->banner) 
                                : base_url('assets/themes/ad_placeholder.jpg');

                            $locationStr = [];
                            if(!empty($ad->region)) $locationStr[] = $ad->region;
                            if(!empty($ad->district)) $locationStr[] = $ad->district;
                            $loc = !empty($locationStr) ? implode(', ', $locationStr) : 'National / All';
                    ?>
                    <tr>
                        <td class="text-center font-weight-700 text-muted">#<?=$ad->id?></td>
                        <td>
                            <img src="<?=$bannerUrl?>" alt="Banner" class="rounded shadow-xs" style="width: 54px; height: 38px; object-fit: cover; border: 1px solid #e2e8f0; cursor: pointer;" onclick="previewImage('<?=$bannerUrl?>', '<?=htmlspecialchars(addslashes($ad->title))?>')">
                        </td>
                        <td>
                            <span class="font-weight-700 text-dark d-block text-truncate" style="max-width: 240px;" title="<?=htmlspecialchars($ad->title)?>">
                                <?=htmlspecialchars($ad->title)?>
                            </span>
                            <small class="text-muted">By: <strong class="text-dark"><?=htmlspecialchars($ad->business_name)?></strong></small>
                            <?php if($ad->ads_status == '3' && !empty($ad->rejected_reason)){ ?>
                                <small class="text-danger d-block text-truncate" style="max-width: 240px;" title="<?=htmlspecialchars($ad->rejected_reason)?>">
                                    <i class="fa fa-exclamation-circle mr-1"></i> <?=htmlspecialchars($ad->rejected_reason)?>
                                </small>
                            <?php } ?>
                        </td>
                        <td>
                            <small class="text-muted font-weight-600"><i class="fa fa-map-marker mr-1 text-danger"></i> <?=htmlspecialchars($loc)?></small>
                        </td>
                        <td class="font-weight-700 text-dark">
                            <?=number_format((float)$ad->budget_allocated)?> <small>TZS</small>
                        </td>
                        <td class="font-weight-600 text-muted">
                            <?=number_format((float)$ad->cost_per_click)?> <small>TZS</small>
                        </td>
                        <td class="text-muted small">
                            <i class="fa fa-calendar-o mr-1"></i> <?=date('d M Y', strtotime($ad->date_uploaded))?>
                        </td>
                        <td class="text-center">
                            <?=ad_status_badge($ad->ads_status)?>
                        </td>
                        <td>
                            <?php if(!empty($ad->approver_name)){ ?>
                                <small class="text-success font-weight-600 d-block"><i class="fa fa-check mr-1"></i> <?=htmlspecialchars($ad->approver_name)?></small>
                            <?php } elseif(!empty($ad->rejected_by)){ ?>
                                <small class="text-danger font-weight-600 d-block"><i class="fa fa-times mr-1"></i> Admin #<?=$ad->rejected_by?></small>
                            <?php } else { ?>
                                <small class="text-muted">-</small>
                            <?php } ?>
                        </td>
                        <td class="text-right pr-4">
                            <div class="btn-group">
                                <!-- VIEW / PUBLIC PREVIEW -->
                                <a href="<?=base_url('home/ads_content?ads='.$ad->id)?>" target="_blank" class="btn btn-sm btn-light font-weight-600 px-2 py-1 mr-1" title="View Public Story" style="border-radius: 6px; font-size: 11.5px;">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <!-- REVIEW WORKSTATION -->
                                <a href="<?=base_url('admin/ads/review?ads='.$ad->id)?>" class="btn btn-sm btn-primary font-weight-600 px-2 py-1 mr-1" title="Detailed Review" style="border-radius: 6px; font-size: 11.5px;">
                                    <i class="fa fa-search mr-1"></i> Review
                                </a>

                                <!-- APPROVE BUTTON -->
                                <?php if($ad->ads_status != '1'){ ?>
                                    <button type="button" class="btn btn-sm btn-success font-weight-600 px-2 py-1 mr-1" onclick="openApproveModal(<?=$ad->id?>, '<?=htmlspecialchars(addslashes($ad->title))?>')" title="Approve & Activate" style="border-radius: 6px; font-size: 11.5px;">
                                        <i class="fa fa-check"></i> Approve
                                    </button>
                                <?php } ?>

                                <!-- REJECT BUTTON -->
                                <?php if($ad->ads_status != '3'){ ?>
                                    <button type="button" class="btn btn-sm btn-danger font-weight-600 px-2 py-1 mr-1" onclick="openRejectModal(<?=$ad->id?>, '<?=htmlspecialchars(addslashes($ad->title))?>')" title="Reject Advertisement" style="border-radius: 6px; font-size: 11.5px;">
                                        <i class="fa fa-times"></i> Reject
                                    </button>
                                <?php } ?>

                                <!-- CLOSE BUTTON -->
                                <?php if($ad->ads_status == '1'){ ?>
                                    <button type="button" class="btn btn-sm btn-secondary font-weight-600 px-2 py-1" onclick="close_ads(<?=$ad->id?>)" title="Close Campaign" style="border-radius: 6px; font-size: 11.5px;">
                                        <i class="fa fa-ban"></i>
                                    </button>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } } else { ?>
                    <tr>
                        <td colspan="10" class="text-center py-5 text-muted">
                            <div class="p-4">
                                <i class="fa fa-folder-open-o text-muted mb-3" style="font-size: 36px;"></i>
                                <h6 class="font-weight-700 text-secondary mb-1">No advertisements found</h6>
                                <p class="text-muted small">Try modifying your search criteria or resetting filters.</p>
                                <a href="<?=base_url('admin/ads/all_ads')?>" class="btn btn-outline-primary btn-sm font-weight-600">Reset Filters</a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination Controls -->
        <?php if($total_pages > 1){ ?>
        <div class="p-3 border-top d-flex justify-content-between align-items-center flex-wrap">
            <small class="text-muted">
                Showing Page <strong><?=$current_page?></strong> of <strong><?=$total_pages?></strong> (Total <?=$total_records?> records)
            </small>
            <nav aria-label="Table pagination">
                <ul class="pagination pagination-sm mb-0">
                    <?php
                        $queryParams = $_GET;
                        // Previous page
                        if($current_page > 1){
                            $queryParams['page'] = $current_page - 1;
                            echo '<li class="page-item"><a class="page-link" href="?'.http_build_query($queryParams).'"><i class="fa fa-chevron-left"></i></a></li>';
                        }
                        // Page numbers
                        $startP = max(1, $current_page - 2);
                        $endP = min($total_pages, $current_page + 2);
                        for($p = $startP; $p <= $endP; $p++){
                            $queryParams['page'] = $p;
                            $activeClass = ($p == $current_page) ? 'active' : '';
                            echo '<li class="page-item '.$activeClass.'"><a class="page-link font-weight-600" href="?'.http_build_query($queryParams).'">'.$p.'</a></li>';
                        }
                        // Next page
                        if($current_page < $total_pages){
                            $queryParams['page'] = $current_page + 1;
                            echo '<li class="page-item"><a class="page-link" href="?'.http_build_query($queryParams).'"><i class="fa fa-chevron-right"></i></a></li>';
                        }
                    ?>
                </ul>
            </nav>
        </div>
        <?php } ?>
    </div>
</div>
