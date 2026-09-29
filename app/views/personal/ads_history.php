<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
	<div class="card-header bg-white border-bottom p-3 px-4 d-flex justify-content-between align-items-center">
		<div class="d-flex align-items-center">
			<div class="mr-3" style="width: 40px; height: 40px; border-radius: 10px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; display: flex; align-items: center; justify-content: center; font-size: 18px;">
				<i class="fas fa-list-alt"></i>
			</div>
			<div>
				<h5 class="mb-0 font-weight-700 text-dark" style="font-size: 17px;">Complete Ads History</h5>
				<small class="text-muted">Lifetime log of all viewed and rewarded ad campaigns</small>
			</div>
		</div>
		<a href="<?=base_url()?>" class="btn btn-sm btn-primary font-weight-600 px-3 py-2" style="border-radius: 8px; font-size: 12.5px;">
			<i class="fas fa-play mr-1"></i> Browse More Ads
		</a>
	</div>
	<div class="card-body p-0">
		<?php if(!empty($results)){ ?>
			<div class="table-responsive p-3">
				<table class="table table-hover table-center align-middle datatable mb-0 w-100" id="adsHistoryTable">
					<thead class="bg-light text-muted">
						<tr>
							<th class="text-center" style="width: 40px;">#</th>
							<th style="width: 65px;" class="text-center">Banner</th>
							<th>Ad Campaign</th>
							<th>Publisher</th>
							<th class="text-center">Questions</th>
							<th class="text-center">Quiz Score</th>
							<th class="text-right">Cash Earned</th>
							<th class="text-right pr-3">Date Clicked</th>
						</tr>
					</thead>
					<tbody style="font-size: 13.5px;">
						<?php
							$counter = 0;
							foreach ($results as $result) {
								$counter++;
								$cash_display = (!empty($result->total_cash)) 
									? '<span class="badge badge-success-light font-weight-700 px-2 py-1" style="font-size: 13px; color: #10b981; background: rgba(16,185,129,0.12); border-radius: 6px;">+'.number_format((float)$result->total_cash).' TZS</span>'
									: '<span class="text-muted font-weight-500">0 TZS</span>';
								
								$banner_img = (!empty($result->banner) && file_exists(FCPATH.'media/banner/'.$result->banner))
									? base_url('media/banner/'.$result->banner)
									: base_url('assets/themes/ad_placeholder.jpg');

								$publisher = !empty($result->business_name) ? htmlspecialchars($result->business_name) : 'Verified Business';
								$date_str = !empty($result->date_clicked) ? date("d M Y, H:i", strtotime($result->date_clicked)) : 'Recently';
						?>
							<tr>
								<td class="text-center font-weight-600 text-muted"><?=$counter?></td>
								<td class="text-center">
									<img src="<?=$banner_img?>" alt="Ad Banner" class="rounded shadow-xs" style="width: 50px; height: 36px; object-fit: cover; border: 1px solid #e2e8f0;">
								</td>
								<td>
									<span class="font-weight-700 text-dark d-block text-truncate" style="max-width: 220px;" title="<?=htmlspecialchars($result->title)?>">
										<?=htmlspecialchars($result->title)?>
									</span>
								</td>
								<td>
									<span class="badge badge-light text-secondary font-weight-600 px-2 py-1" style="background: #f1f5f9; border-radius: 6px;">
										<i class="far fa-building mr-1"></i> <?=$publisher?>
									</span>
								</td>
								<td class="text-center font-weight-600 text-secondary">
									<?=$result->total_question?>
								</td>
								<td class="text-center">
									<span class="badge badge-pill font-weight-700 px-2 py-1" style="background: #e0f2fe; color: #0284c7;">
										<?=$result->correct_answer?> / <?=$result->total_question?>
									</span>
								</td>
								<td class="text-right font-weight-700">
									<?=$cash_display?>
								</td>
								<td class="text-right pr-3 text-muted small">
									<i class="far fa-calendar-alt mr-1"></i> <?=$date_str?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>		
			</div>
		<?php } else { ?>
			<div class="text-center py-5">
				<div class="p-4">
					<div class="mb-3 d-inline-flex align-items-center justify-content-center" style="width: 64px; height: 64px; border-radius: 50%; background: rgba(59, 130, 246, 0.1); color: #3b82f6; font-size: 26px;">
						<i class="fas fa-list-alt"></i>
					</div>
					<h6 class="font-weight-700 text-dark mb-1">No ads history recorded yet</h6>
					<p class="text-muted small mb-3">Browse our active campaigns and start earning real cash right away!</p>
					<a href="<?=base_url()?>" class="btn btn-primary btn-sm font-weight-700 px-4 py-2" style="border-radius: 8px;">
						<i class="fas fa-play mr-1"></i> Start Viewing Ads
					</a>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		if ($('#adsHistoryTable').length > 0) {
	        $('#adsHistoryTable').DataTable({
	        	"destroy": true,
	            "searching": true,
	            "ordering": true,
	            "pageLength": 15,
	            "bLengthChange": true,
	            "order": [[0, "asc"]],
	            "columnDefs": [
	            	{ "orderable": false, "targets": [1] }
	            ],
	            "language": {
	                "search": "",
	                "searchPlaceholder": "Search ads history...",
	                "lengthMenu": "Show _MENU_ entries",
	                "info": "Showing _START_ to _END_ of _TOTAL_ ads",
	                "paginate": {
	                	"next": '<i class="fas fa-chevron-right"></i>',
	                	"previous": '<i class="fas fa-chevron-left"></i>'
	                }
	            }
	        });
	    }
	});
</script>