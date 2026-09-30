<?php
$avail_bal = (float)($summary['total_commission'] ?? 0) - ((float)($summary['total_withdraw'] ?? 0) + (float)($summary['total_charge'] ?? 0));
if($avail_bal < 0){ $avail_bal = 0; }
?>

<!-- Account Balance Overview Banner -->
<div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #0f2942 0%, #1e3a8a 100%); border-radius: 16px; color: #ffffff; overflow: hidden; position: relative;">
	<div class="card-body p-4 position-relative" style="z-index: 2;">
		<div class="row align-items-center">
			<div class="col-lg-6 mb-3 mb-lg-0">
				<div class="d-flex align-items-center mb-2">
					<span class="badge badge-pill badge-warning text-dark font-weight-700 px-3 py-1 mr-2" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Wallet Balance</span>
					<span class="text-white-50 small"><i class="fas fa-shield-alt mr-1"></i> Instant Payouts</span>
				</div>
				<span class="text-white-50 d-block font-weight-500" style="font-size: 13px;">Available for Withdrawal</span>
				<h2 class="font-weight-800 text-white mb-2" style="font-size: 32px; letter-spacing: -0.5px;">
					<?=number_format($avail_bal)?> <span style="font-size: 18px; font-weight: 600; color: #ff9800;">TZS</span>
				</h2>
				<input type="hidden" value="<?=$avail_bal?>" id="available_balance">
			</div>
			
			<div class="col-lg-6">
				<div class="row text-center text-lg-left">
					<div class="col-4 px-2">
						<div class="p-2 rounded" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(4px);">
							<span class="text-white-50 d-block" style="font-size: 10px; text-transform: uppercase;">Total Earned</span>
							<span class="font-weight-700 text-white" style="font-size: 13px;"><?=number_format((float)($summary['total_commission'] ?? 0))?> TZS</span>
						</div>
					</div>
					<div class="col-4 px-2">
						<div class="p-2 rounded" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(4px);">
							<span class="text-white-50 d-block" style="font-size: 10px; text-transform: uppercase;">Total Withdrawn</span>
							<span class="font-weight-700 text-white" style="font-size: 13px;"><?=number_format((float)($summary['total_withdraw'] ?? 0))?> TZS</span>
						</div>
					</div>
					<div class="col-4 px-2">
						<div class="p-2 rounded" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(4px);">
							<span class="text-white-50 d-block" style="font-size: 10px; text-transform: uppercase;">Total Fees</span>
							<span class="font-weight-700 text-white" style="font-size: 13px;"><?=number_format((float)($summary['total_charge'] ?? 0))?> TZS</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Background decoration shapes -->
	<div style="position: absolute; right: -30px; top: -30px; width: 160px; height: 160px; background: rgba(255,255,255,0.05); border-radius: 50%; pointer-events: none;"></div>
	<div style="position: absolute; right: 200px; bottom: -60px; width: 140px; height: 140px; background: rgba(255,107,44,0.15); border-radius: 50%; pointer-events: none;"></div>
</div>

<!-- Main Tabs Section -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
	<div class="card-header bg-white border-bottom p-0">
		<ul class="nav nav-tabs nav-tabs-bottom border-0 mb-0" style="padding: 10px 20px 0;">
			<li class="nav-item">
				<a class="nav-link font-weight-700 active px-4 py-3" data-toggle="tab" href="#slot_list" id="slot_list_nav" style="border-radius: 8px 8px 0 0; font-size: 14px;">
					<i class="fas fa-list-ul mr-2 text-primary"></i> Withdrawal Records
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link font-weight-700 px-4 py-3" data-toggle="tab" href="#slot_form" id="slot_form_nav" style="border-radius: 8px 8px 0 0; font-size: 14px;">
					<i class="fas fa-paper-plane mr-2 text-warning"></i> Request Withdrawal
				</a>
			</li>
		</ul>
	</div>

	<div class="card-body p-4">
		<div class="tab-content">
			<!-- WITHDRAWAL RECORDS TAB -->
			<div id="slot_list" class="tab-pane fade show active">
				<?php if(!empty($records)){ ?>
					<div class="table-responsive">
						<table class="table table-hover table-center align-middle datatable mb-0 w-100">
							<thead class="bg-light text-muted" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
								<tr>
									<th class="text-center" style="width: 50px;">#</th>
									<th>Request ID</th>
									<th>Amount</th>
									<th>Requested Date</th>
									<th class="text-center">Status</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody style="font-size: 13.5px;">
								<?php
									$counter=0;
									foreach ($records as $record) {
										$counter++;
										$amount_formatted = (!empty($record->amount)) ? number_format((float)$record->amount).' TZS' : '---';
										$action = '<span class="text-muted small">None</span>';
										
										if($record->is_processed == "0"){
											$status = '<span class="badge font-weight-700 px-2 py-1" style="background: rgba(16,185,129,0.12); color: #10b981; border-radius: 6px;"><i class="fas fa-check-circle mr-1"></i> Complete</span>';
										} elseif($record->is_processed == "1"){
											$status = '<span class="badge font-weight-700 px-2 py-1" style="background: rgba(245,158,11,0.12); color: #d97706; border-radius: 6px;"><i class="fas fa-clock mr-1"></i> Pending</span>';
											$action = '<a href="'.base_url('personal/withdraw_balance?request=').$record->requestID.'" class="btn btn-sm btn-outline-warning font-weight-600 px-3 py-1" style="border-radius: 6px; font-size: 12px;"><i class="fas fa-edit mr-1"></i> Edit</a>';
										} elseif($record->is_processed == "2"){
											$status = '<span class="badge font-weight-700 px-2 py-1" style="background: rgba(239,68,68,0.12); color: #ef4444; border-radius: 6px;"><i class="fas fa-times-circle mr-1"></i> Rejected</span>';
										} else {
											$status = '<span class="badge badge-light">Unknown</span>';
										}
								?>
									<tr>
										<td class="text-center font-weight-600 text-muted"><?=$counter?></td>
										<td>
											<span class="font-weight-700 text-dark" style="font-family: monospace; font-size: 13px;">
												<i class="fas fa-hashtag text-muted mr-1"></i><?=htmlspecialchars($record->requestID)?>
											</span>
										</td>
										<td>
											<span class="font-weight-800 text-dark" style="font-size: 14px;"><?=$amount_formatted?></span>
										</td>
										<td>
											<span class="text-muted small">
												<i class="far fa-calendar-alt mr-1"></i> <?=date("d M Y, H:i", strtotime($record->createdDate))?>
											</span>
										</td>
										<td class="text-center"><?=$status?></td>
										<td class="text-center"><?=$action?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				<?php } else { ?>
					<div class="text-center py-5">
						<div class="p-4">
							<i class="fas fa-wallet text-muted mb-3" style="font-size: 40px; color: #cbd5e1;"></i>
							<h6 class="font-weight-700 text-secondary">No withdrawal requests yet</h6>
							<p class="text-muted small mb-0">When you request cash withdrawals, your history and status will appear here.</p>
						</div>
					</div>
				<?php } ?>
			</div>

			<!-- WITHDRAWAL FORM TAB -->
			<div id="slot_form" class="tab-pane fade">
				<form id="data-form" method="POST" class="p-2">
					<div class="row">
						<div class="col-md-6 mb-3">
							<label class="font-weight-700 text-secondary small text-uppercase">Request ID</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-light border-right-0"><i class="fas fa-barcode text-muted"></i></span>
								</div>
								<input type="text" name="requestID" class="form-control border-left-0 font-weight-700" value="<?php if(isset($info[0]['requestID']) && $info[0]['requestID']!=''){ echo htmlspecialchars($info[0]['requestID']); }else{ echo generateRequestID();} ?>" readonly style="background: #f8fafc; font-family: monospace;">
							</div>
						</div>

						<div class="col-md-6 mb-3">
							<label class="font-weight-700 text-secondary small text-uppercase">Withdrawal Amount (TZS) <span class="text-danger">*</span></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-light border-right-0 font-weight-700 text-muted">TZS</span>
								</div>
								<input type="number" name="amount" id="totalAmount" class="form-control border-left-0 font-weight-700" style="font-size: 16px;" value="<?php if(isset($info[0]['amount']) && $info[0]['amount']!=''){ echo htmlspecialchars($info[0]['amount'], ENT_QUOTES, 'UTF-8'); } ?>" placeholder="Min 1,600" min="1600" onkeyup="setAmount();">
							</div>
							
							<!-- Quick Amount Chips -->
							<div class="d-flex flex-wrap gap-1 mt-2">
								<button type="button" class="btn btn-xs btn-outline-secondary font-weight-600 mr-1 mb-1 px-2 py-1" style="border-radius: 6px; font-size: 11px;" onclick="setQuickAmount(2000);">2,000</button>
								<button type="button" class="btn btn-xs btn-outline-secondary font-weight-600 mr-1 mb-1 px-2 py-1" style="border-radius: 6px; font-size: 11px;" onclick="setQuickAmount(5000);">5,000</button>
								<button type="button" class="btn btn-xs btn-outline-secondary font-weight-600 mr-1 mb-1 px-2 py-1" style="border-radius: 6px; font-size: 11px;" onclick="setQuickAmount(10000);">10,000</button>
								<button type="button" class="btn btn-xs btn-outline-secondary font-weight-600 mr-1 mb-1 px-2 py-1" style="border-radius: 6px; font-size: 11px;" onclick="setQuickAmount(20000);">20,000</button>
								<button type="button" class="btn btn-xs btn-outline-primary font-weight-700 mr-1 mb-1 px-2 py-1" style="border-radius: 6px; font-size: 11px;" onclick="setMaxAmount();">Max Available</button>
							</div>
						</div>

						<!-- Fee Calculation Breakdown Box -->
						<div class="col-md-12 my-3">
							<div class="card bg-light border-0" style="border-radius: 12px;">
								<div class="card-body p-3">
									<h6 class="font-weight-700 text-dark mb-3" style="font-size: 13px;">
										<i class="fas fa-calculator text-primary mr-1"></i> Transaction Calculation Breakdown
									</h6>
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="text-muted small d-block">Requested Amount:</span>
											<span class="font-weight-800 text-dark" style="font-size: 15px;"><span id="total_amount">0</span> TZS</span>
										</div>
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="text-muted small d-block">Network Transfer Fee:</span>
											<span class="font-weight-800 text-muted" style="font-size: 15px;">1,534 TZS</span>
										</div>
										<div class="col-sm-4">
											<span class="text-muted small d-block">Total Deducted from Balance:</span>
											<span class="font-weight-800 text-primary" style="font-size: 15px;"><span id="net_amount">0</span> TZS</span>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Payment Channels Notice -->
						<div class="col-md-12 mb-3">
							<div class="d-flex align-items-center justify-content-between p-3 rounded" style="background: #f8fafc; border: 1px dashed #cbd5e1;">
								<div class="d-flex align-items-center">
									<i class="fas fa-mobile-alt text-success mr-3" style="font-size: 24px;"></i>
									<div>
										<span class="font-weight-700 text-dark d-block" style="font-size: 13px;">Payout Destination</span>
										<span class="text-muted small">Funds will be sent to your configured mobile money wallet. Make sure your <a href="<?=base_url('personal/account_info')?>" class="font-weight-600 text-primary">Payout Account</a> is up to date.</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-12" id="resultMsg"></div>

						<div class="col-md-12 mt-2">
							<?php if(isset($info[0]['requestID']) && $info[0]['requestID']!=''){ ?>
								<button type="button" class="btn btn-warning font-weight-700 px-4 py-2 mr-2 turnOnProgress" id="updateBtn" style="border-radius: 8px;">
									<i class="fas fa-save mr-1"></i> Update Request
								</button>
							<?php } else { ?>
								<button type="button" class="btn btn-primary font-weight-700 px-4 py-2 mr-2 turnOnProgress" id="saveBtn" style="border-radius: 8px;">
									<i class="fas fa-paper-plane mr-1"></i> Submit Withdrawal Request
								</button>
							<?php } ?>
							<button type="button" class="btn btn-primary font-weight-700 px-4 py-2 progressBarBtn" style="display: none; border-radius: 8px;" disabled>
								<i class="fa fa-spinner fa-spin mr-1"></i> Processing Request...
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modern Notification / Alert Modal -->
<div class="modal fade" id="withdrawAlertModal" tabindex="-1" role="dialog" aria-labelledby="withdrawAlertTitle" aria-hidden="true" style="z-index: 99999;">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 440px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden; background: #ffffff;">
            <div class="modal-header border-0 pb-0 pt-3 pr-3 text-right">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 0.6; font-size: 24px; outline: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4 pt-0 text-center">
                <div class="mb-3 d-inline-flex align-items-center justify-content-center" id="withdrawAlertIconWrap" style="width: 70px; height: 70px; border-radius: 50%; background: rgba(239, 68, 68, 0.12); color: #ef4444; font-size: 32px;">
                    <i class="fas fa-exclamation-circle" id="withdrawAlertIcon"></i>
                </div>
                <h5 class="font-weight-800 text-dark mb-2" id="withdrawAlertTitle" style="font-size: 20px;">Invalid Amount</h5>
                <div class="text-muted mb-4" id="withdrawAlertMessage" style="font-size: 14.5px; line-height: 1.6;">Please enter a valid withdrawal amount.</div>
                <button type="button" class="btn btn-primary btn-block font-weight-700 py-2 shadow-sm" data-dismiss="modal" style="border-radius: 10px; height: 46px; font-size: 15px;">
                    Understand & Fix
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		// Move modal to body to ensure clean viewport rendering without container clipping
		if ($('#withdrawAlertModal').length > 0) {
			$('#withdrawAlertModal').appendTo('body');
		}

		if ($('.datatable').length > 0) {
	        $('.datatable').DataTable({
	            "bFilter": false,
	            "searching": true,
	            "language": {
	                "search": "_INPUT_",
	                "searchPlaceholder": "Search records..."
	            }
	        });
	    }

	    <?php if(isset($info[0]['requestID']) && $info[0]['requestID']!=''){ ?>
	    	$('.fade').removeClass('show');
	    	$('.fade').removeClass('active');
	    	$('#slot_form').addClass('show');
	    	$('#slot_form').addClass('active');
	    	$('.nav-link').removeClass('active');
	    	$('#slot_form_nav').addClass('active');
	    	setAmount();
    	<?php } ?>

	    /*1534 is transaction charge*/
	    $('#saveBtn').click(function(){
	    	var available_balance=document.getElementById('available_balance').value;
	    	var amount_requested=document.getElementById('totalAmount').value;
	    	available_balance=parseInt(available_balance) || 0;
	    	amount_requested=parseInt(amount_requested) || 0;
	    	
	    	if(amount_requested<=0){
                showWithdrawAlert("Invalid Amount", "Please enter a valid withdrawal amount.");
                $('#totalAmount').focus();
                return;
	    	}
	    	if(amount_requested<1600){
                showWithdrawAlert("Minimum Limit", "Withdrawal amount should not be lower than <strong>1,600 TZS</strong>.");
                $('#totalAmount').focus();
                return;
	    	}
	    	if((amount_requested + 1534) > available_balance){
                showWithdrawAlert("Insufficient Balance", "Withdrawal amount + network fee (1,534 TZS) exceeds your available balance of <strong>"+available_balance.toLocaleString()+" TZS</strong>.");
                return;
	    	}else{
	            $('.turnOnProgress').css('display','none');
	            $('.progressBarBtn').css('display','inline-block');
	            $.ajax({
	                url: '<?php echo site_url(); ?>personal/save_withdraw_request',
	                type: 'POST',
	                data:$('#data-form').serialize(),
	                async: true,
	                processData: false,
	                success: function (data) {
	                    if(data.trim()=='Success'){
	                        var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button> <i class="fas fa-check-circle mr-1"></i> Withdrawal request submitted successfully! </div>';
	                        $('#resultMsg').html(output);
	                        setTimeout(function(){ window.location="<?=base_url('personal/withdraw_balance')?>"; }, 1200);
	                    }else{
	                        $('#resultMsg').html(data);
	                        $('.turnOnProgress').css('display','inline-block');
	                        $('.progressBarBtn').css('display','none');
	                    }
	                },
	                error: function( xhr, status, error ) {
	                    $('#resultMsg').html('<div class="alert alert-danger">'+error+'</div>');
	                    $('.turnOnProgress').css('display','inline-block');
	                    $('.progressBarBtn').css('display','none');
	                    return false;
	                }
	            });
	        }
        });

	    $('#updateBtn').click(function(){
	    	var available_balance=document.getElementById('available_balance').value;
	    	var amount_requested=document.getElementById('totalAmount').value;
	    	available_balance=parseInt(available_balance) || 0;
	    	amount_requested=parseInt(amount_requested) || 0;
	    	if(amount_requested<=0){
                showWithdrawAlert("Invalid Amount", "Please enter a valid withdrawal amount.");
                $('#totalAmount').focus();
                return;
	    	}
	    	if(amount_requested<1600){
                showWithdrawAlert("Minimum Limit", "Withdrawal amount should not be lower than <strong>1,600 TZS</strong>.");
                $('#totalAmount').focus();
                return;
	    	}
	    	if((amount_requested + 1534) > available_balance){
                showWithdrawAlert("Insufficient Balance", "Withdrawal amount + network fee (1,534 TZS) exceeds your available balance of <strong>"+available_balance.toLocaleString()+" TZS</strong>.");
                return;
	    	}else{
	            $('.turnOnProgress').css('display','none');
	            $('.progressBarBtn').css('display','inline-block');
	            $.ajax({
	                url: '<?php echo site_url(); ?>personal/save_withdraw_request',
	                type: 'POST',
	                data:$('#data-form').serialize(),
	                async: true,
	                processData: false,
	                success: function (data) {
	                    if(data.trim()=='Success'){
	                        var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button> <i class="fas fa-check-circle mr-1"></i> Updated Successfully! </div>';
	                        $('#resultMsg').html(output);
	                        setTimeout(function(){ window.location="<?=base_url('personal/withdraw_balance')?>"; }, 1200);
	                    }else{
	                        $('#resultMsg').html(data);
	                        $('.turnOnProgress').css('display','inline-block');
	                        $('.progressBarBtn').css('display','none');
	                    }
	                },
	                error: function( xhr, status, error ) {
	                    $('#resultMsg').html('<div class="alert alert-danger">'+error+'</div>');
	                    $('.turnOnProgress').css('display','inline-block');
	                    $('.progressBarBtn').css('display','none');
	                    return false;
	                }
	            });
	        }
        });

	});

    function showWithdrawAlert(title, message, isWarning) {
        $('#withdrawAlertTitle').text(title);
        $('#withdrawAlertMessage').html(message);
        if(isWarning){
            $('#withdrawAlertIconWrap').css({ 'background': 'rgba(245, 158, 11, 0.15)', 'color': '#d97706' });
            $('#withdrawAlertIcon').attr('class', 'fas fa-exclamation-triangle');
        } else {
            $('#withdrawAlertIconWrap').css({ 'background': 'rgba(239, 68, 68, 0.12)', 'color': '#ef4444' });
            $('#withdrawAlertIcon').attr('class', 'fas fa-exclamation-circle');
        }

        // Inline alert message in form for immediate feedback
        $('#resultMsg').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-circle mr-1"></i> ' + message + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        $('#withdrawAlertModal').modal('show');
    }

    function setAmount(){
        var totalAmount=document.getElementById('totalAmount').value;
        if(totalAmount!=""){
        	totalAmount=parseInt(totalAmount) || 0;
            $('#total_amount').html(totalAmount.toLocaleString());
            $('#net_amount').html((totalAmount+1534).toLocaleString());
        } else {
            $('#total_amount').html('0');
            $('#net_amount').html('0');
        }
    }

    function setQuickAmount(amt){
        $('#totalAmount').val(amt);
        setAmount();
    }

    function setMaxAmount(){
        var available_balance=parseInt(document.getElementById('available_balance').value) || 0;
        var maxAmt = available_balance - 1534;
        if(maxAmt < 1600){
            maxAmt = (available_balance >= 1600) ? available_balance : 1600;
        }
        $('#totalAmount').val(maxAmt);
        setAmount();
    }
</script>