<!DOCTYPE html>
<html>
<head>
	
</head>
<body>

				</div>			
			</div>
			<!-- /Page Wrapper -->		
        </div>
		<!-- /Main Wrapper -->

		<!-- Model -->
	    <!-- Change Password Modal -->
	    <div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-hidden="true">
	        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 480px;">
	            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
	                <!-- Header with gradient & key icon -->
	                <div class="modal-header border-0 pb-3 pt-4 px-4 position-relative" style="background: linear-gradient(135deg, #0f2942 0%, #1e3a8a 100%); color: #ffffff;">
	                    <div class="d-flex align-items-center">
	                        <div class="mr-3" style="width: 48px; height: 48px; border-radius: 14px; background: rgba(255, 107, 44, 0.2); color: #ff6b2c; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
	                            <i class="fas fa-key"></i>
	                        </div>
	                        <div>
	                            <h4 class="modal-title font-weight-800 text-white mb-0" style="font-size: 19px;">Change Password</h4>
	                            <small class="text-white-50">Update your account credentials securely</small>
	                        </div>
	                    </div>
	                    <button type="button" class="close text-white position-absolute" data-dismiss="modal" aria-label="Close" style="top: 18px; right: 20px; opacity: 0.8; font-size: 24px;">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>

	                <div class="modal-body p-4 pt-4">
	                    <form method="post" id="changepassword-form">
	                        <!-- Current Password -->
	                        <div class="form-group mb-3">
	                            <label class="font-weight-700 text-dark mb-1" style="font-size: 13px;">
	                                <i class="fas fa-lock text-muted mr-1"></i> Current Password <span class="text-danger">*</span>
	                            </label>
	                            <div class="input-group">
	                                <div class="input-group-prepend">
	                                    <span class="input-group-text bg-light border-right-0" style="border-color: #e2e8f0; color: #64748b;"><i class="fas fa-shield-alt"></i></span>
	                                </div>
	                                <input type="password" name="cpassword" id="cpasswordField" class="form-control border-left-0 border-right-0" placeholder="Enter current password" required style="border-color: #e2e8f0; font-size: 14px; height: 44px;" />
	                                <div class="input-group-append">
	                                    <span class="input-group-text bg-light border-left-0" style="border-color: #e2e8f0; cursor: pointer; color: #64748b;" onclick="toggleCPasswordVisibility('cpasswordField', 'toggleCPassIcon1');">
	                                        <i class="fas fa-eye" id="toggleCPassIcon1"></i>
	                                    </span>
	                                </div>
	                            </div>
	                        </div>

	                        <!-- New Password -->
	                        <div class="form-group mb-3">
	                            <label class="font-weight-700 text-dark mb-1" style="font-size: 13px;">
	                                <i class="fas fa-key text-primary mr-1"></i> New Password <span class="text-danger">*</span>
	                            </label>
	                            <div class="input-group">
	                                <div class="input-group-prepend">
	                                    <span class="input-group-text bg-light border-right-0" style="border-color: #e2e8f0; color: #64748b;"><i class="fas fa-lock"></i></span>
	                                </div>
	                                <input type="password" name="password" id="newpasswordField" class="form-control border-left-0 border-right-0" placeholder="Enter new strong password" required style="border-color: #e2e8f0; font-size: 14px; height: 44px;" />
	                                <div class="input-group-append">
	                                    <span class="input-group-text bg-light border-left-0" style="border-color: #e2e8f0; cursor: pointer; color: #64748b;" onclick="toggleCPasswordVisibility('newpasswordField', 'toggleCPassIcon2');">
	                                        <i class="fas fa-eye" id="toggleCPassIcon2"></i>
	                                    </span>
	                                </div>
	                            </div>
	                        </div>

	                        <!-- Confirm New Password -->
	                        <div class="form-group mb-3">
	                            <label class="font-weight-700 text-dark mb-1" style="font-size: 13px;">
	                                <i class="fas fa-check-double text-success mr-1"></i> Confirm New Password <span class="text-danger">*</span>
	                            </label>
	                            <div class="input-group">
	                                <div class="input-group-prepend">
	                                    <span class="input-group-text bg-light border-right-0" style="border-color: #e2e8f0; color: #64748b;"><i class="fas fa-lock"></i></span>
	                                </div>
	                                <input type="password" name="repassword" id="passwordChangeField" class="form-control border-left-0 border-right-0" placeholder="Re-enter new password" required style="border-color: #e2e8f0; font-size: 14px; height: 44px;" />
	                                <div class="input-group-append">
	                                    <span class="input-group-text bg-light border-left-0" style="border-color: #e2e8f0; cursor: pointer; color: #64748b;" onclick="toggleCPasswordVisibility('passwordChangeField', 'toggleCPassIcon3');">
	                                        <i class="fas fa-eye" id="toggleCPassIcon3"></i>
	                                    </span>
	                                </div>
	                            </div>
	                        </div>

	                        <div class="mt-4 mb-2">
	                            <button type="button" class="btn btn-primary btn-block btn-lg font-weight-700 turnOnChangePassProgress" id="userChangePassword" style="height: 46px; border-radius: 50px; font-size: 15px; box-shadow: 0 4px 14px rgba(255, 107, 44, 0.35);">
	                                <i class="fas fa-save mr-1"></i> Update Password
	                            </button>
	                            <button type="button" class="btn btn-primary btn-block btn-lg progressBarChangePassBtn" disabled style="height: 46px; border-radius: 50px; font-size: 15px; display: none;">
	                                <i class="fa fa-spinner fa-spin mr-1"></i> Updating Password...
	                            </button>
	                        </div>
	                    </form>
	                    
	                    <div class="mt-3" id="resultMsgChangePass"></div>

	                    <div class="text-center mt-3 pt-2 border-top">
	                        <small class="text-muted" style="font-size: 11px;">
	                            <i class="fas fa-shield-alt text-success mr-1"></i> 256-Bit Encrypted & Secure Password Update
	                        </small>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- /Change Password Modal -->

	    <!-- /Change Password Modal -->

        <!-- Approve & Activate Confirmation Modal (Requirement 7) -->
        <div class="modal fade" id="approve_ad_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                    <div class="modal-header border-0 pb-2 pt-4 px-4" style="background: linear-gradient(135deg, #065f46 0%, #047857 100%); color: #ffffff;">
                        <div class="d-flex align-items-center">
                            <div class="mr-3" style="width: 46px; height: 46px; border-radius: 12px; background: rgba(255, 255, 255, 0.2); display: flex; align-items: center; justify-content: center; font-size: 22px;">
                                <i class="fa fa-check-circle text-white"></i>
                            </div>
                            <div>
                                <h5 class="modal-title font-weight-800 text-white mb-0" style="font-size: 18px;">Approve Advertisement</h5>
                                <small class="text-white-50">Publish campaign to public viewers</small>
                            </div>
                        </div>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.8;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="p-3 rounded mb-3" style="background: #f0fdf4; border: 1px solid #bbf7d0;">
                            <p class="font-weight-700 text-dark mb-1" style="font-size: 14.5px;">Are you sure you want to approve this advertisement?</p>
                            <p class="text-muted small mb-0">This will make the advertisement visible to all active users on the platform.</p>
                            <div class="mt-2 font-weight-600 text-success small" id="approve_ad_title"></div>
                        </div>
                        <form id="approve_ad_form">
                            <input type="hidden" name="ads_id" id="approve_ad_id">
                            <input type="hidden" name="admin_csrf_token" id="approve_csrf_token" value="<?=$this->admin_auth->get_csrf_token()?>">
                            <div class="form-group mb-0">
                                <label class="font-weight-700 text-dark small mb-1">Approval Comment / Note <span class="text-muted font-weight-normal">(Optional)</span></label>
                                <textarea name="approval_comment" id="approve_ad_comment" class="form-control" rows="2" placeholder="e.g., Advertisement reviewed and verified. Meets community guidelines." style="border-radius: 8px; font-size: 13px;"></textarea>
                            </div>
                        </form>
                        <div id="approve_modal_alert" class="mt-3"></div>
                    </div>
                    <div class="modal-footer border-0 bg-light px-4 py-3">
                        <button type="button" class="btn btn-light font-weight-600 px-3" data-dismiss="modal" style="border-radius: 8px;">Cancel</button>
                        <button type="button" class="btn btn-success font-weight-700 px-4" id="btnConfirmApprove" onclick="executeApproveAd()" style="border-radius: 8px;">
                            <i class="fa fa-check-circle mr-1"></i> Approve & Activate
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reject Advertisement Modal (Requirement 8) -->
        <div class="modal fade" id="reject_ad_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                    <div class="modal-header border-0 pb-2 pt-4 px-4" style="background: linear-gradient(135deg, #991b1b 0%, #dc2626 100%); color: #ffffff;">
                        <div class="d-flex align-items-center">
                            <div class="mr-3" style="width: 46px; height: 46px; border-radius: 12px; background: rgba(255, 255, 255, 0.2); display: flex; align-items: center; justify-content: center; font-size: 22px;">
                                <i class="fa fa-times-circle text-white"></i>
                            </div>
                            <div>
                                <h5 class="modal-title font-weight-800 text-white mb-0" style="font-size: 18px;">Reject Advertisement</h5>
                                <small class="text-white-50">Specify feedback for the advertiser</small>
                            </div>
                        </div>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.8;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <p class="text-muted small mb-2">Campaign: <strong class="text-dark" id="reject_ad_title"></strong></p>
                        <form id="reject_ad_form">
                            <input type="hidden" name="ads_id" id="reject_ad_id">
                            <input type="hidden" name="admin_csrf_token" id="reject_csrf_token" value="<?=$this->admin_auth->get_csrf_token()?>">
                            <div class="form-group mb-0">
                                <label class="font-weight-700 text-dark small mb-1">
                                    Rejection Reason <span class="text-danger">* (Mandatory)</span>
                                </label>
                                <textarea name="rejected_reason" id="reject_ad_reason" class="form-control" rows="3" required placeholder="Please provide specific feedback explaining why this ad is being rejected..." style="border-radius: 8px; font-size: 13.5px;"></textarea>
                                <small class="text-muted mt-1 d-block">The advertiser will see this reason in their portal so they can revise and resubmit the advertisement.</small>
                            </div>
                        </form>
                        <div id="reject_modal_alert" class="mt-3"></div>
                    </div>
                    <div class="modal-footer border-0 bg-light px-4 py-3">
                        <button type="button" class="btn btn-light font-weight-600 px-3" data-dismiss="modal" style="border-radius: 8px;">Cancel</button>
                        <button type="button" class="btn btn-danger font-weight-700 px-4" id="btnConfirmReject" onclick="executeRejectAd()" style="border-radius: 8px;">
                            <i class="fa fa-times-circle mr-1"></i> Reject Advertisement
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lightbox Full Image Preview Modal -->
        <div class="modal fade" id="image_lightbox_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content border-0 shadow-lg bg-dark text-white" style="border-radius: 16px; overflow: hidden;">
                    <div class="modal-header border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                        <h6 class="modal-title font-weight-700 text-white mb-0" id="lightbox_caption">Banner Inspection</h6>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0 text-center" style="background: #0b0f19;">
                        <img src="" id="lightbox_image" alt="Full Image" class="img-fluid" style="max-height: 80vh; width: auto; object-fit: contain;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Legacy compatibility modal for deny_ads -->
        <div class="modal fade" id="deny_ads" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Reject Ads</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <p>Title: <span id="deny_title"></span></p>
                        <form method="post" id="deny-form">
                            <div class="form-group">
                                <input type="hidden" name="ads" id="ads_fld" class="form-control">
                                <textarea class="form-control" name="rejected_reason" placeholder="Enter rejection reason"></textarea>
                            </div>
                        </form>
                        <div class="row"><div class="col-md-12" id="resultMsgDeny"></div></div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-danger btn-sm text-white waves-effect waves-light turnOnChangePassProgress" id="saveReject">Submit</a>
                        <a class="btn btn-danger btn-sm text-white waves-light progressBarChangePassBtn"><i class="fa fa-spinner fa-spin"></i> Processing...</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deny_withdraw_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Reject Withdraw Request</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <p>Title: <span id="withdraw_deny_name"></span></p>
                        <form method="post" id="deny_withdraw-form">
                            <div class="form-group">
                                <input type="hidden" name="withdraw" id="withdraw_request_id" class="form-control">
                                <textarea class="form-control" name="rejected_reason"></textarea>
                            </div>
                        </form>
                        <div class="row"><div class="col-md-12" id="resultMsgDenyWithdraw"></div></div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-info btn-sm text-white waves-effect waves-light turnOnChangePassProgress" id="saveWithdrawReject">Submit</a>
                        <a class="btn btn-info btn-sm text-white waves-light progressBarChangePassBtn"><i class="fa fa-spinner fa-spin"></i> Processing...</a>
                    </div>
                </div>
            </div>
        </div>
		<!-- end of model -->
		
		<!-- Slimscroll JS -->
        <script src="<?=base_url('assets/admin/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>		
		<script src="<?=base_url('assets/admin/plugins/raphael/raphael.min.js')?>"></script>    
		<script src="<?=base_url('assets/admin/plugins/morris/morris.min.js')?>"></script>  
		<script src="<?=base_url('assets/admin/js/chart.morris.js')?>"></script>
		<!-- Datatables JS -->
		<script src="<?=base_url('assets/admin/plugins/datatables/jquery.dataTables.min.js')?>"></script>
		<script src="<?=base_url('assets/admin/plugins/datatables/datatables.min.js')?>"></script>		
		<!-- Custom JS -->
		<script  src="<?=base_url('assets/admin/js/script.js')?>"></script>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
        check_pending_ads();
        var loadF = setInterval(function(){ check_pending_ads(); }, 60000);//60 Secs

        $('#userChangePassword').click(function(){
            $('.turnOnChangePassProgress').css('display','none');
            $('.progressBarChangePassBtn').css('display','inline-block');
            $.ajax({
                url:'<?= base_url() ?>admin/users/change_password',
                type:"POST",
                data:$('#changepassword-form').serialize(),
                success: function(data){
                    if(data.trim()=='Success'){
                        var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button> Success </div>'; 
                        $('#resultMsgChangePass').html(output);
                        document.getElementById("changepassword-form").reset();
                        window.location='';
                    }else{
                        $('#resultMsgChangePass').html(data);
                    }
                    $('.turnOnChangePassProgress').css('display','inline-block');
                    $('.progressBarChangePassBtn').css('display','none');
                },
	            error: function(xhr, status, error) {
	                $('#resultMsgChangePass').html(error);
	                $('.turnOnChangePassProgress').css('display','inline-block');
	                $('.progressBarChangePassBtn').css('display','none');
	                return false;
	            }
            });
        });
        
        $("#passwordChangeField").keyup(function(event){
            if(event.keyCode == 13){
                var mValue=document.getElementById("passwordChangeField").value;
                if(mValue!=""){
                    $("#userChangePassword").click();
                }
            }
        });

        $('#saveReject').click(function(){
            $('.turnOnProgress').css('display','none');
            $('.progressBarBtn').css('display','inline-block');
            $.ajax({
                url:'<?= base_url() ?>admin/ads/reject_ads',
                type:"POST",
                data:$('#deny-form').serialize(),
                success: function(data){
                    if(data.trim()=='Success'){
                        var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button> Success </div>'; 
                        $('#resultMsgDeny').html(output);
                        document.getElementById("deny-form").reset();
                        window.location='';
                    }else{
                        $('#resultMsgDeny').html(data);
                    }
                    $('.turnOnProgress').css('display','inline-block');
                    $('.progressBarBtn').css('display','none');
                },
                error: function(xhr, status, error){
                    $('#resultMsgDeny').html(error);
                    $('.turnOnProgress').css('display','inline-block');
                    $('.progressBarBtn').css('display','none');
                    return false;
                }
            });
        });

        $('#saveWithdrawReject').click(function(){
            $('.turnOnProgress').css('display','none');
            $('.progressBarBtn').css('display','inline-block');
            $.ajax({
                url:'<?= base_url() ?>admin/reject_withdraw',
                type:"POST",
                data:$('#deny_withdraw-form').serialize(),
                success: function(data){
                    if(data.trim()=='Success'){
                        var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button> Success </div>'; 
                        $('#resultMsgDenyWithdraw').html(output);
                        document.getElementById("deny_withdraw-form").reset();
                        window.location='';
                    }else{
                        $('#resultMsgDenyWithdraw').html(data);
                    }
                    $('.turnOnProgress').css('display','inline-block');
                    $('.progressBarBtn').css('display','none');
                },
                error: function(xhr, status, error){
                    $('#resultMsgDenyWithdraw').html(error);
                    $('.turnOnProgress').css('display','inline-block');
                    $('.progressBarBtn').css('display','none');
                    return false;
                }
            });
        });

    });

    function delete_row(info, record, title){
        if(confirm("Do you want to delete this "+title+"?")){
            $.ajax({
                url:'<?= base_url() ?>admin/delete_data_row?k_ey='+info+'&record='+record,
                type:"POST",
                success: function(data){
                    if(data.trim()=='Success'){
                        window.location='';
                    }else{
                        alert(error);
                    }
                },
                error: function(xhr, status, error) {
                    alert(error);
                    return false;
                }
            });
        }
    }

    function activate_row(info, record, title){
        if(confirm("Do you want to activate this "+title+"?")){
            $.ajax({
                url:'<?= base_url() ?>admin/activate_data_row?k_ey='+info+'&record='+record,
                type:"POST",
                success: function(data){
                    if(data.trim()=='Success'){
                        window.location='';
                    }else{
                        alert(error);
                    }
                },
                error: function(xhr, status, error) {
                    alert(error);
                    return false;
                }
            });
        }
    }

    function diactivate_row(info, record, title){
        if(confirm("Do you want to disable this "+title+"?")){
            $.ajax({
                url:'<?= base_url() ?>admin/diactivate_data_row?k_ey='+info+'&record='+record,
                type:"POST",
                success: function(data){
                    if(data.trim()=='Success'){
                        window.location='';
                    }else{
                        alert(error);
                    }
                },
                error: function(xhr, status, error) {
                    alert(error);
                    return false;
                }
            });
        }
    }

    function disable_ads(info){
        if(confirm("Do you want to disable this ad?")){
            $.ajax({
                url:'<?= base_url() ?>admin/ads/disable_ads?k_ey='+info,
                type:"POST",
                success: function(data){
                    if(data.trim()=='Success'){
                        window.location='';
                    }else{
                        alert(error);
                    }
                },
                error: function(xhr, status, error) {
                    alert(error);
                    return false;
                }
            });
        }
    }

    function enable_ads(info){
        if(confirm("Do you want to enable this ad?")){
            $.ajax({
                url:'<?= base_url() ?>admin/ads/enable_ads?k_ey='+info,
                type:"POST",
                success: function(data){
                    if(data.trim()=='Success'){
                        window.location='';
                    }else{
                        alert(error);
                    }
                },
                error: function(xhr, status, error) {
                    alert(error);
                    return false;
                }
            });
        }
    }

    function close_ads(info){
        if(confirm("Do you want to close this ad?")){
            $.ajax({
                url:'<?= base_url() ?>admin/ads/close_ads?k_ey='+info,
                type:"POST",
                success: function(data){
                    if(data.trim()=='Success'){
                        window.location='';
                    }else{
                        alert(error);
                    }
                },
                error: function(xhr, status, error) {
                    alert(error);
                    return false;
                }
            });
        }
    }

    function enable_withdraw(info){
        if(confirm("Do you want to enable this withdraw request")){
            $.ajax({
                url:'<?= base_url() ?>admin/enable_withdraw?k_ey='+info,
                type:"POST",
                success: function(data){
                    if(data.trim()=='Success'){
                        window.location='';
                    }else{
                        alert(error);
                    }
                },
                error: function(xhr, status, error) {
                    alert(error);
                    return false;
                }
            });
        }
    }

    function disburse_withdraw(info){
        if(confirm("Do you want to disburse this withdraw request")){
            $.ajax({
                url:'<?= base_url() ?>admin/disburse_withdraw_request?k_ey='+info,
                type:"POST",
                success: function(data){
                    if(data.trim()=='Success'){
                        window.location='';
                    }else{
                        alert(error);
                    }
                },
                error: function(xhr, status, error) {
                    alert(error);
                    return false;
                }
            });
        }
    }

    function check_pending_ads(){
        $.ajax({
            url:'<?= base_url() ?>admin/check_pending_ads',
            type:"POST",
            success: function(data){
                var new_ads=data.trim();
                if(!isNaN(new_ads)){
                    $('#ads_note_counter').html(new_ads);
                    $('#ads_note_counter1').html(new_ads);
                    $('#ads_note_counter2').html(new_ads+" Pending Ads");
                    $('#ads_notification_area').css('display','inline-block');
                }else{
                    alert(new_ads);
                }
            },
            error: function(xhr, status, error) {
                alert(error);
                return false;
            }
        });
    }

    function loadDenyForm(ads, title){
        $('#deny_title').html(title);
        document.getElementById('ads_fld').value=ads;
        $('#deny_ads').modal('show');
    }

    function loadWithdrawDenyForm(ads, title){
        $('#withdraw_deny_name').html(title);
        document.getElementById('withdraw_request_id').value=ads;
        $('#deny_withdraw_modal').modal('show');
    }

    function toggleCPasswordVisibility(fieldId, iconId) {
        var input = document.getElementById(fieldId);
        var icon = document.getElementById(iconId);
        if (input && icon) {
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    }

    /* Modern Advertisement Approval & Rejection Workflows */
    function openApproveModal(adId, title){
        $('#approve_ad_id').val(adId);
        $('#approve_ad_title').html('Campaign: #' + adId + ' - ' + title);
        $('#approve_ad_comment').val('');
        $('#approve_modal_alert').html('');
        $('#btnConfirmApprove').prop('disabled', false).html('<i class="fa fa-check-circle mr-1"></i> Approve & Activate');
        $('#approve_ad_modal').modal('show');
    }

    function executeApproveAd(){
        var form = $('#approve_ad_form');
        var btn = $('#btnConfirmApprove');
        var alertBox = $('#approve_modal_alert');
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-1"></i> Approving & Activating...');

        $.ajax({
            url: '<?=base_url("admin/ads/approve_ad")?>',
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(res){
                if(res.csrf_token){
                    $('#approve_csrf_token').val(res.csrf_token);
                    $('#reject_csrf_token').val(res.csrf_token);
                }
                if(res.success){
                    alertBox.html('<div class="alert alert-success border-0 py-2 small mb-0"><i class="fa fa-check-circle mr-1"></i> ' + res.message + '</div>');
                    setTimeout(function(){
                        $('#approve_ad_modal').modal('hide');
                        window.location.reload();
                    }, 1000);
                } else {
                    btn.prop('disabled', false).html('<i class="fa fa-check-circle mr-1"></i> Approve & Activate');
                    alertBox.html('<div class="alert alert-danger border-0 py-2 small mb-0"><i class="fa fa-exclamation-triangle mr-1"></i> ' + (res.message || 'Error occurred.') + '</div>');
                }
            },
            error: function(xhr, status, error){
                btn.prop('disabled', false).html('<i class="fa fa-check-circle mr-1"></i> Approve & Activate');
                var errMsg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Error communicating with server.';
                alertBox.html('<div class="alert alert-danger border-0 py-2 small mb-0"><i class="fa fa-exclamation-triangle mr-1"></i> ' + errMsg + '</div>');
            }
        });
    }

    function openRejectModal(adId, title, currentReason){
        $('#reject_ad_id').val(adId);
        $('#reject_ad_title').text('#' + adId + ' - ' + title);
        $('#reject_ad_reason').val(currentReason || '');
        $('#reject_modal_alert').html('');
        $('#btnConfirmReject').prop('disabled', false).html('<i class="fa fa-times-circle mr-1"></i> Reject Advertisement');
        $('#reject_ad_modal').modal('show');
    }

    function executeRejectAd(){
        var form = $('#reject_ad_form');
        var reason = $('#reject_ad_reason').val().trim();
        var btn = $('#btnConfirmReject');
        var alertBox = $('#reject_modal_alert');

        if(!reason){
            alertBox.html('<div class="alert alert-danger border-0 py-2 small mb-0"><i class="fa fa-exclamation-circle mr-1"></i> Rejection reason is required. Please explain why this ad cannot be approved.</div>');
            $('#reject_ad_reason').focus();
            return false;
        }

        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-1"></i> Rejecting Advertisement...');

        $.ajax({
            url: '<?=base_url("admin/ads/reject_ad")?>',
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(res){
                if(res.csrf_token){
                    $('#approve_csrf_token').val(res.csrf_token);
                    $('#reject_csrf_token').val(res.csrf_token);
                }
                if(res.success){
                    alertBox.html('<div class="alert alert-success border-0 py-2 small mb-0"><i class="fa fa-check-circle mr-1"></i> ' + res.message + '</div>');
                    setTimeout(function(){
                        $('#reject_ad_modal').modal('hide');
                        window.location.reload();
                    }, 1000);
                } else {
                    btn.prop('disabled', false).html('<i class="fa fa-times-circle mr-1"></i> Reject Advertisement');
                    alertBox.html('<div class="alert alert-danger border-0 py-2 small mb-0"><i class="fa fa-exclamation-triangle mr-1"></i> ' + (res.message || 'Error occurred.') + '</div>');
                }
            },
            error: function(xhr, status, error){
                btn.prop('disabled', false).html('<i class="fa fa-times-circle mr-1"></i> Reject Advertisement');
                var errMsg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Error communicating with server.';
                alertBox.html('<div class="alert alert-danger border-0 py-2 small mb-0"><i class="fa fa-exclamation-triangle mr-1"></i> ' + errMsg + '</div>');
            }
        });
    }

    function previewImage(imageUrl, caption){
        $('#lightbox_image').attr('src', imageUrl);
        $('#lightbox_caption').text(caption || 'Advertisement Banner');
        $('#image_lightbox_modal').modal('show');
    }
</script>