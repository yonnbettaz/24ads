<!-- Rejected Advertisements View -->
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            <div>
                <h4 class="font-weight-800 text-dark mb-1" style="font-size: 20px;">
                    <i class="fa fa-times-circle text-danger mr-2"></i>Rejected Advertisements
                </h4>
                <p class="text-muted small mb-0">Advertisements denied during moderation. These are hidden from public view until revised and resubmitted by the advertiser.</p>
            </div>
            <div class="mt-2 mt-md-0">
                <a href="<?=base_url('admin/ads/pending_ads')?>" class="btn btn-warning btn-sm font-weight-700 px-3 py-2 mr-2" style="border-radius: 8px;">
                    <i class="fa fa-clock-o mr-1"></i> Pending Queue
                </a>
                <a href="<?=base_url('admin/ads/approval_history?action=REJECTED')?>" class="btn btn-outline-danger btn-sm font-weight-700 px-3 py-2" style="border-radius: 8px;">
                    <i class="fa fa-history mr-1"></i> Rejection Audit Log
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
    <div class="card-header bg-white border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
        <h5 class="card-title font-weight-800 text-dark mb-0" style="font-size: 15px;">
            <span class="badge badge-danger font-weight-800 px-2 py-1 mr-2"><?=count($ads ?? [])?> Rejected</span> Advertisements
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 datatable">
                <thead class="bg-light text-muted" style="font-size: 11.5px; text-transform: uppercase; letter-spacing: 0.5px;">
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th style="width: 70px;">Banner</th>
                        <th>Title & Advertiser</th>
                        <th>Rejection Reason</th>
                        <th>Budget</th>
                        <th>Rejected Date</th>
                        <th class="text-center">Status</th>
                        <th class="text-right pr-4">Actions</th>
                    </tr>
                </thead>
                <tbody style="font-size: 13px;">
                    <?php 
                    if(!empty($ads)){
                        $counter = 0;
                        foreach($ads as $ad){
                            $counter++;
                            $bannerUrl = (!empty($ad->banner) && file_exists(FCPATH.'media/banner/'.$ad->banner)) 
                                ? base_url('media/banner/'.$ad->banner) 
                                : base_url('assets/themes/ad_placeholder.jpg');
                    ?>
                    <tr>
                        <td class="text-center font-weight-700 text-muted"><?=$counter?></td>
                        <td>
                            <img src="<?=$bannerUrl?>" alt="Banner" class="rounded shadow-xs" style="width: 54px; height: 38px; object-fit: cover; border: 1px solid #e2e8f0; cursor: pointer;" onclick="previewImage('<?=$bannerUrl?>', '<?=htmlspecialchars(addslashes($ad->title))?>')">
                        </td>
                        <td>
                            <span class="font-weight-700 text-dark d-block text-truncate" style="max-width: 220px;" title="<?=htmlspecialchars($ad->title)?>">
                                <?=htmlspecialchars($ad->title)?>
                            </span>
                            <small class="text-muted">By: <strong class="text-dark"><?=htmlspecialchars($ad->business_name)?></strong></small>
                        </td>
                        <td>
                            <span class="text-danger font-weight-600 d-block text-truncate" style="max-width: 260px;" title="<?=htmlspecialchars($ad->rejected_reason)?>">
                                <i class="fa fa-exclamation-circle mr-1"></i> <?=htmlspecialchars($ad->rejected_reason ?: 'No reason specified')?>
                            </span>
                        </td>
                        <td class="font-weight-700 text-dark">
                            <?=number_format((float)$ad->budget_allocated)?> <small>TZS</small>
                        </td>
                        <td class="text-muted small">
                            <i class="fa fa-calendar-times-o mr-1 text-danger"></i> <?=date('d M Y', strtotime($ad->rejected_date ?: $ad->date_uploaded))?>
                        </td>
                        <td class="text-center">
                            <?=ad_status_badge($ad->ads_status)?>
                        </td>
                        <td class="text-right pr-4">
                            <div class="btn-group">
                                <a href="<?=base_url('admin/ads/review?ads='.$ad->id)?>" class="btn btn-sm btn-primary font-weight-600 px-3 py-1 mr-1" title="Review Full Ad Details" style="border-radius: 6px; font-size: 11.5px;">
                                    <i class="fa fa-search mr-1"></i> Review
                                </a>
                                <button type="button" class="btn btn-sm btn-success font-weight-600 px-2 py-1 mr-1" onclick="openApproveModal(<?=$ad->id?>, '<?=htmlspecialchars(addslashes($ad->title))?>')" title="Reconsider & Approve" style="border-radius: 6px; font-size: 11.5px;">
                                    <i class="fa fa-check"></i> Approve
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger font-weight-600 px-2 py-1" onclick="openRejectModal(<?=$ad->id?>, '<?=htmlspecialchars(addslashes($ad->title))?>', '<?=htmlspecialchars(addslashes($ad->rejected_reason))?>')" title="Update Rejection Reason" style="border-radius: 6px; font-size: 11.5px;">
                                    <i class="fa fa-pencil"></i> Reason
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        } 
                    } else { ?>
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <div class="p-4">
                                <i class="fa fa-check-circle text-muted mb-2" style="font-size: 32px;"></i>
                                <h6 class="font-weight-700 text-secondary mb-1">No rejected advertisements</h6>
                                <p class="text-muted small mb-0">All reviewed campaigns are currently approved or pending.</p>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>