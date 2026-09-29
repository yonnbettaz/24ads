<?php
$current_operator = $info[0]['operator'] ?? 'mpesa';
$current_phone = $info[0]['account_number'] ?? '';
$current_name = $info[0]['account_name'] ?? '';
$current_code = $info[0]['country_code'] ?? '+255';
?>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
	<div class="card-header bg-white border-bottom p-3 px-4 d-flex justify-content-between align-items-center">
		<div class="d-flex align-items-center">
			<i class="fas fa-mobile-alt text-primary mr-2" style="font-size: 20px;"></i>
			<div>
				<h5 class="mb-0 font-weight-700 text-dark" style="font-size: 17px;">Payout & Mobile Wallet Details</h5>
				<small class="text-muted">Set up your receiving mobile money account for withdrawal payouts</small>
			</div>
		</div>
		<button type="button" class="btn btn-sm btn-outline-primary font-weight-600 px-3 py-1" onclick="actiateEditField();" style="border-radius: 8px;">
			<i class="fas fa-edit mr-1"></i> Edit Account
		</button>
	</div>

	<div class="card-body p-4">
		<!-- Active payout badge if configured -->
		<?php if(!empty($current_phone)){ ?>
			<div class="alert alert-success border-0 mb-4 d-flex align-items-center justify-content-between p-3" style="border-radius: 12px; background: rgba(16,185,129,0.1); color: #065f46;">
				<div class="d-flex align-items-center">
					<i class="fas fa-check-circle mr-3" style="font-size: 24px; color: #10b981;"></i>
					<div>
						<span class="font-weight-700 d-block" style="font-size: 14px;">Configured Payout Wallet</span>
						<span class="small font-weight-500 text-dark"><?=strtoupper($current_operator)?> • <?=htmlspecialchars($current_code.' '.$current_phone)?> (<?=htmlspecialchars($current_name)?>)</span>
					</div>
				</div>
				<span class="badge badge-success font-weight-600 px-2 py-1">Active</span>
			</div>
		<?php } else { ?>
			<div class="alert alert-warning border-0 mb-4 d-flex align-items-center p-3" style="border-radius: 12px; background: rgba(245,158,11,0.1); color: #92400e;">
				<i class="fas fa-exclamation-triangle mr-3" style="font-size: 24px; color: #f59e0b;"></i>
				<div>
					<span class="font-weight-700 d-block" style="font-size: 14px;">No Payout Account Configured</span>
					<span class="small">Please select your mobile network and enter your registered phone number below so we can process your withdrawals.</span>
				</div>
			</div>
		<?php } ?>

		<form id="data-form" method="POST">
			<div class="row">
				<div class="form-group col-md-6 mb-3">
					<label class="font-weight-700 text-secondary small text-uppercase">Account ID</label>
					<input type="text" name="accountID" class="form-control font-weight-700" value="<?php if(isset($info[0]['accountID']) && $info[0]['accountID']!=''){ echo htmlspecialchars($info[0]['accountID']); }else{ echo generateAccountID('personal');} ?>" readonly style="background: #f8fafc; font-family: monospace;">
				</div>
				
				<div class="form-group col-md-6 mb-3">             
					<label class="font-weight-700 text-secondary small text-uppercase">Payment Method</label>
					<select class="form-control readonly font-weight-600" name="payment_method" readonly style="background: #f8fafc;">
						<option value="mobile" selected>Mobile Money Wallet</option>  
						<option value="bank" disabled>Bank Wire (Coming Soon)</option>
					</select>
				</div>
				
				<div class="form-group col-md-12 mb-3">             
					<label class="font-weight-700 text-secondary small text-uppercase mb-2">Select Network Operator <span class="text-danger">*</span></label>
					<div class="mobile_payment_list payout-operators-container p-3 rounded" style="background: #f8fafc; border: 1px solid #e2e8f0;">
						<div class="row">
							<!-- Tanzania Operators -->
							<div class="col-6 col-md-4 col-lg-3 mb-2">
								<label class="operator-select-card d-flex align-items-center p-2 rounded w-100 mb-0" style="cursor: pointer; background: #ffffff; border: 1.5px solid #e2e8f0;">
									<input type="radio" name="operator" value="mpesa" onclick="showPhoneNumber('tanzania')" <?php if($current_operator=='mpesa'){ echo 'checked';} ?> class="disabled mr-2" disabled>
									<img src="<?=site_url('assets/themes/payment_method/mpesa.png')?>" alt="M-Pesa" style="max-height: 24px; max-width: 50px; object-fit: contain;" class="mr-2">
									<span class="font-weight-600 small">Vodacom</span>
								</label>
							</div>
							
							<div class="col-6 col-md-4 col-lg-3 mb-2">
								<label class="operator-select-card d-flex align-items-center p-2 rounded w-100 mb-0" style="cursor: pointer; background: #ffffff; border: 1.5px solid #e2e8f0;">
									<input type="radio" name="operator" value="airtelmoney" onclick="showPhoneNumber('tanzania')" <?php if($current_operator=='airtelmoney'){ echo 'checked';} ?> class="disabled mr-2" disabled>
									<img src="<?=site_url('assets/themes/payment_method/airtelmoney.png')?>" alt="Airtel" style="max-height: 24px; max-width: 50px; object-fit: contain;" class="mr-2">
									<span class="font-weight-600 small">Airtel Money</span>
								</label>
							</div>

							<div class="col-6 col-md-4 col-lg-3 mb-2">
								<label class="operator-select-card d-flex align-items-center p-2 rounded w-100 mb-0" style="cursor: pointer; background: #ffffff; border: 1.5px solid #e2e8f0;">
									<input type="radio" name="operator" value="tigopesa" onclick="showPhoneNumber('tanzania')" <?php if($current_operator=='tigopesa'){ echo 'checked';} ?> class="disabled mr-2" disabled>
									<img src="<?=site_url('assets/themes/payment_method/tigopesa1.png')?>" alt="Tigo Pesa" style="max-height: 24px; max-width: 50px; object-fit: contain;" class="mr-2">
									<span class="font-weight-600 small">Tigo Pesa</span>
								</label>
							</div>

							<div class="col-6 col-md-4 col-lg-3 mb-2">
								<label class="operator-select-card d-flex align-items-center p-2 rounded w-100 mb-0" style="cursor: pointer; background: #ffffff; border: 1.5px solid #e2e8f0;">
									<input type="radio" name="operator" value="halopesa" onclick="showPhoneNumber('tanzania')" <?php if($current_operator=='halopesa'){ echo 'checked';} ?> class="disabled mr-2" disabled>
									<img src="<?=site_url('assets/themes/payment_method/halo-pesa.png')?>" alt="HaloPesa" style="max-height: 24px; max-width: 50px; object-fit: contain;" class="mr-2">
									<span class="font-weight-600 small">HaloPesa</span>
								</label>
							</div>

							<div class="col-6 col-md-4 col-lg-3 mb-2">
								<label class="operator-select-card d-flex align-items-center p-2 rounded w-100 mb-0" style="cursor: pointer; background: #ffffff; border: 1.5px solid #e2e8f0;">
									<input type="radio" name="operator" value="ezypesa" onclick="showPhoneNumber('tanzania')" <?php if($current_operator=='ezypesa'){ echo 'checked';} ?> class="disabled mr-2" disabled>
									<img src="<?=site_url('assets/themes/payment_method/zantel.png')?>" alt="EzyPesa" style="max-height: 24px; max-width: 50px; object-fit: contain;" class="mr-2">
									<span class="font-weight-600 small">EzyPesa</span>
								</label>
							</div>

							<div class="col-6 col-md-4 col-lg-3 mb-2">
								<label class="operator-select-card d-flex align-items-center p-2 rounded w-100 mb-0" style="cursor: pointer; background: #ffffff; border: 1.5px solid #e2e8f0;">
									<input type="radio" name="operator" value="ttclpesa" onclick="showPhoneNumber('tanzania')" <?php if($current_operator=='ttclpesa'){ echo 'checked';} ?> class="disabled mr-2" disabled>
									<img src="<?=site_url('assets/themes/payment_method/t-pesa.jpg')?>" alt="T-Pesa" style="max-height: 24px; max-width: 50px; object-fit: contain;" class="mr-2">
									<span class="font-weight-600 small">TTCL T-Pesa</span>
								</label>
							</div>

							<div class="col-6 col-md-4 col-lg-3 mb-2">
								<label class="operator-select-card d-flex align-items-center p-2 rounded w-100 mb-0" style="cursor: pointer; background: #ffffff; border: 1.5px solid #e2e8f0;">
									<input type="radio" name="operator" value="safaricom" onclick="showPhoneNumber('kenya')" <?php if($current_operator=='safaricom'){ echo 'checked';} ?> class="disabled mr-2" disabled>
									<img src="<?=site_url('assets/themes/payment_method/safaricom.png')?>" alt="Safaricom" style="max-height: 24px; max-width: 50px; object-fit: contain;" class="mr-2">
									<span class="font-weight-600 small">Safaricom (KE)</span>
								</label>
							</div>

							<div class="col-6 col-md-4 col-lg-3 mb-2">
								<label class="operator-select-card d-flex align-items-center p-2 rounded w-100 mb-0" style="cursor: pointer; background: #ffffff; border: 1.5px solid #e2e8f0;">
									<input type="radio" name="operator" value="mtn_uganda" onclick="showPhoneNumber('uganda')" <?php if($current_operator=='mtn_uganda'){ echo 'checked';} ?> class="disabled mr-2" disabled>
									<img src="<?=site_url('assets/themes/payment_method/mtn1.jpg')?>" alt="MTN UG" style="max-height: 24px; max-width: 50px; object-fit: contain;" class="mr-2">
									<span class="font-weight-600 small">MTN Uganda</span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group col-md-6 mb-3" id="phone_number">
					<label class="font-weight-700 text-secondary small text-uppercase">Registered Phone Number <span class="text-danger">*</span></label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text font-weight-700 bg-light" id="country_code"><?php if(isset($info[0]['country_code'])){ echo htmlspecialchars($info[0]['country_code']);}else{ echo '+255';} ?></span>
						</div>
						<input type="hidden" name="country_code" id="country_code_value" value="<?php if(isset($info[0]['country_code'])){ echo htmlspecialchars($info[0]['country_code']);}else{ echo '+255';} ?>">
						<input type="text" name="phone_number" class="form-control readonly font-weight-700" placeholder="e.g. 754000111" value="<?php if(isset($info[0]['account_number'])){ echo htmlspecialchars($info[0]['account_number']);} ?>" readonly>
					</div>
					<small class="text-muted">Enter without leading zero, e.g. <strong>754000111</strong></small>
				</div>

				<div class="form-group col-md-6 mb-3">
					<label class="font-weight-700 text-secondary small text-uppercase">Account Registered Name <span class="text-danger">*</span></label>
					<input type="text" name="account_name" class="form-control readonly font-weight-700" value="<?php if(isset($info[0]['account_name'])){ echo htmlspecialchars($info[0]['account_name']);} ?>" placeholder="e.g. Juma Ally" readonly>
					<small class="text-muted">Must match name on mobile money SIM card</small>
				</div>

				<input type="hidden" name="country" id="country" value="<?php if(isset($info[0]['country'])){ echo htmlspecialchars($info[0]['country']);}else{ echo 'tanzania';} ?>">
				<input type="hidden" name="currency" id="currency" value="<?php if(isset($info[0]['currency'])){ echo htmlspecialchars($info[0]['currency']);}else{ echo 'TZS';} ?>">

				<div class="col-md-12 my-2" id="resultMsg"></div>

				<div class="form-group col-md-12 mt-3">
					<button type="button" class="btn btn-outline-secondary font-weight-600 px-3 py-2 mr-2" onclick="actiateEditField();" style="border-radius: 8px;">
						<i class="fas fa-unlock mr-1"></i> Unlock Fields to Edit
					</button>
					<button type="button" class="btn btn-primary font-weight-700 px-4 py-2 turnOnProgress" id="saveBtn" style="border-radius: 8px;">
						<i class="fas fa-save mr-1"></i> Save Payout Details
					</button>
					<button type="button" class="btn btn-primary font-weight-700 px-4 py-2 progressBarBtn" style="display: none; border-radius: 8px;" disabled>
						<i class="fa fa-spinner fa-spin mr-1"></i> Saving Payout Details...
					</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
        $('#saveBtn').click(function(){
            $('.turnOnProgress').css('display','none');
            $('.progressBarBtn').css('display','inline-block');
            $.ajax({
                url: '<?php echo site_url(); ?>personal/save_account_info',
                type: 'POST',
                data:$('#data-form').serialize(),
                async: true,
                processData: false,
                success: function (data) {
                    if(data.trim()=='Success'){
                        var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button> <i class="fas fa-check-circle mr-1"></i> Payout details updated successfully! </div>'; 
                        $('#resultMsg').html(output);
                        setTimeout(function(){ window.location.reload(); }, 1200);
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
        });
    });

    function showPhoneNumber(country){
        var currency="TZS";
        if(country=='tanzania'){
            $('#country_code').html('+255');
            document.getElementById('country_code_value').value="+255";
        }else if(country=='kenya'){
            $('#country_code').html('+254');
            document.getElementById('country_code_value').value="+254";
        }else if(country=='uganda'){
            $('#country_code').html('+256');
            document.getElementById('country_code_value').value="+256";
        }else if(country=='rwanda'){
            $('#country_code').html('+250');
            document.getElementById('country_code_value').value="+250";
        }else if(country=='ghana'){
            $('#country_code').html('+233');
            document.getElementById('country_code_value').value="+233";
        }else if(country=='Ivory Coast'){
            $('#country_code').html('+225');
            document.getElementById('country_code_value').value="+225";
        }
        document.getElementById('country').value=country;
        document.getElementById('currency').value=currency;
    }

    function actiateEditField(){
        $('.disabled').removeAttr("disabled");
        $('.readonly').removeAttr("readonly").css('background', '#ffffff');
    }
</script>