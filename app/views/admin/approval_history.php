<!-- Approval History & Audit Trail Management View -->
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            <div>
                <h4 class="font-weight-800 text-dark mb-1" style="font-size: 20px;">
                    <i class="fe fe-activity text-primary mr-2"></i>Approval History & Audit Trail
                </h4>
                <p class="text-muted small mb-0">Complete historical audit trail of all advertisement moderation events (Approvals, Rejections, Resubmissions, and Closures).</p>
            </div>
            <div class="mt-2 mt-md-0">
                <a href="<?=base_url('admin/ads/all_ads')?>" class="btn btn-outline-primary btn-sm font-weight-700 px-3 py-2 mr-2" style="border-radius: 8px;">
                    <i class="fa fa-list mr-1"></i> All Ads
                </a>
                <a href="<?=base_url('admin/ads/pending_ads')?>" class="btn btn-warning btn-sm font-weight-700 px-3 py-2" style="border-radius: 8px;">
                    <i class="fa fa-clock-o mr-1"></i> Pending Queue
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Filters Toolbar -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-body p-3">
        <form method="GET" action="<?=base_url('admin/ads/approval_history')?>" class="form-row align-items-end">
            <!-- Search Keyword -->
            <div class="col-lg-4 col-md-6 col-12 mb-2 mb-lg-0">
                <label class="font-weight-700 text-muted small mb-1">Search Keywords</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-light border-right-0" style="border-color: #e2e8f0; color: #64748b;"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" name="search" class="form-control border-left-0" placeholder="Search by Ad ID, Title, Moderator, Comment..." value="<?=htmlspecialchars($filters['search'] ?? '')?>" style="border-color: #e2e8f0; font-size: 13px;">
                </div>
            </div>

            <!-- Action Filter -->
            <div class="col-lg-2 col-md-3 col-6 mb-2 mb-lg-0">
                <label class="font-weight-700 text-muted small mb-1">Filter by Action</label>
                <select name="action" class="form-control custom-select" style="border-color: #e2e8f0; font-size: 13px;">
                    <option value="all" <?=($filters['action'] === '' || $filters['action'] === 'all' || !isset($filters['action'])) ? 'selected' : ''?>>All Actions</option>
                    <option value="APPROVED" <?=($filters['action'] === 'APPROVED') ? 'selected' : ''?>>Approved</option>
                    <option value="REJECTED" <?=($filters['action'] === 'REJECTED') ? 'selected' : ''?>>Rejected</option>
                    <option value="RESUBMITTED" <?=($filters['action'] === 'RESUBMITTED') ? 'selected' : ''?>>Resubmitted</option>
                    <option value="CLOSED" <?=($filters['action'] === 'CLOSED') ? 'selected' : ''?>>Closed</option>
                </select>
            </div>

            <!-- From Date -->
            <div class="col-lg-2 col-md-3 col-6 mb-2 mb-lg-0">
                <label class="font-weight-700 text-muted small mb-1">From Date</label>
                <input type="date" name="start_date" class="form-control" value="<?=htmlspecialchars($filters['start_date'] ?? '')?>" style="border-color: #e2e8f0; font-size: 13px;">
            </div>

            <!-- To Date -->
            <div class="col-lg-2 col-md-3 col-6 mb-2 mb-lg-0">
                <label class="font-weight-700 text-muted small mb-1">To Date</label>
                <input type="date" name="end_date" class="form-control" value="<?=htmlspecialchars($filters['end_date'] ?? '')?>" style="border-color: #e2e8f0; font-size: 13px;">
            </div>

            <!-- Buttons -->
            <div class="col-lg-2 col-md-3 col-6">
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary font-weight-700 w-100 mr-2" style="border-radius: 8px; font-size: 13px;">
                        <i class="fa fa-filter mr-1"></i> Filter
                    </button>
                    <a href="<?=base_url('admin/ads/approval_history')?>" class="btn btn-light font-weight-600 px-3" title="Clear Filters" style="border-radius: 8px; border: 1px solid #e2e8f0;">
                        <i class="fa fa-refresh"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- History Log Table -->
<div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
    <div class="card-header bg-white border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
        <h5 class="card-title font-weight-800 text-dark mb-0" style="font-size: 15px;">
            Audit Events: <span class="text-primary font-weight-800"><?=number_format($total_records)?></span> Logged Actions
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead class="bg-light text-muted" style="font-size: 11.5px; text-transform: uppercase; letter-spacing: 0.5px;">
                    <tr>
                        <th class="text-center" style="width: 70px;">Log #</th>
                        <th style="width: 140px;">Action</th>
                        <th>Target Advertisement</th>
                        <th>Business / Creator</th>
                        <th>Administrator / Actor</th>
                        <th>Comment / Reason</th>
                        <th>Timestamp</th>
                        <th class="text-right pr-4">Review</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($history)){
                        foreach($history as $item){
                            $actionBadge = '';
                            if($item->action == 'APPROVED'){
                                $actionBadge = '<span class="badge badge-pill badge-success font-weight-700 px-3 py-1"><i class="fa fa-check mr-1"></i> APPROVED</span>';
                            } elseif($item->action == 'REJECTED'){
                                $actionBadge = '<span class="badge badge-pill badge-danger font-weight-700 px-3 py-1"><i class="fa fa-times mr-1"></i> REJECTED</span>';
                            } elseif($item->action == 'RESUBMITTED'){
                                $actionBadge = '<span class="badge badge-pill badge-info font-weight-700 px-3 py-1"><i class="fa fa-refresh mr-1"></i> RESUBMITTED</span>';
                            } elseif($item->action == 'CLOSED'){
                                $actionBadge = '<span class="badge badge-pill badge-secondary font-weight-700 px-3 py-1"><i class="fa fa-ban mr-1"></i> CLOSED</span>';
                            } else {
                                $actionBadge = '<span class="badge badge-pill badge-light font-weight-700 px-2 py-1">'.htmlspecialchars($item->action).'</span>';
                            }
                    ?>
                    <tr>
                        <td class="text-center text-muted font-weight-700">#<?=$item->id?></td>
                        <td><?=$actionBadge?></td>
                        <td>
                            <a href="<?=base_url('admin/ads/review?ads='.$item->ad_id)?>" class="font-weight-700 text-dark d-block text-truncate" style="max-width: 260px;" title="<?=htmlspecialchars($item->ad_title)?>">
                                #<?=$item->ad_id?> - <?=htmlspecialchars($item->ad_title)?>
                            </a>
                        </td>
                        <td>
                            <span class="font-weight-600 text-dark"><?=htmlspecialchars($item->business_name ?: 'N/A')?></span>
                        </td>
                        <td>
                            <strong class="text-dark"><i class="fa fa-user mr-1 text-muted"></i> <?=htmlspecialchars($item->admin_name ?: ($item->admin_username ?: 'System User'))?></strong>
                        </td>
                        <td>
                            <span class="text-muted d-block text-truncate" style="max-width: 320px;" title="<?=htmlspecialchars($item->comment)?>">
                                <?=htmlspecialchars($item->comment ?: '-')?>
                            </span>
                        </td>
                        <td class="text-muted small">
                            <i class="fa fa-clock-o mr-1"></i> <?=date('d M Y, H:i:s', strtotime($item->created_at))?>
                        </td>
                        <td class="text-right pr-4">
                            <a href="<?=base_url('admin/ads/review?ads='.$item->ad_id)?>" class="btn btn-sm btn-outline-primary font-weight-600 px-2 py-1" style="border-radius: 6px; font-size: 11.5px;">
                                <i class="fa fa-search mr-1"></i> Inspect
                            </a>
                        </td>
                    </tr>
                    <?php } } else { ?>
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <div class="p-4">
                                <i class="fa fa-history text-muted mb-2" style="font-size: 36px;"></i>
                                <h6 class="font-weight-700 text-secondary mb-1">No approval history records found</h6>
                                <p class="text-muted small">Try modifying your filter selections or date range.</p>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if($total_pages > 1){ ?>
        <div class="p-3 border-top d-flex justify-content-between align-items-center flex-wrap">
            <small class="text-muted">Showing Page <strong><?=$current_page?></strong> of <strong><?=$total_pages?></strong> (Total <?=$total_records?> records)</small>
            <nav aria-label="Table pagination">
                <ul class="pagination pagination-sm mb-0">
                    <?php
                        $queryParams = $_GET;
                        if($current_page > 1){
                            $queryParams['page'] = $current_page - 1;
                            echo '<li class="page-item"><a class="page-link" href="?'.http_build_query($queryParams).'"><i class="fa fa-chevron-left"></i></a></li>';
                        }
                        $startP = max(1, $current_page - 2);
                        $endP = min($total_pages, $current_page + 2);
                        for($p = $startP; $p <= $endP; $p++){
                            $queryParams['page'] = $p;
                            $activeClass = ($p == $current_page) ? 'active' : '';
                            echo '<li class="page-item '.$activeClass.'"><a class="page-link font-weight-600" href="?'.http_build_query($queryParams).'">'.$p.'</a></li>';
                        }
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
