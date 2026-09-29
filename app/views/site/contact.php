<!-- Contact Page Container -->
<div class="contact-page-wrapper py-4">
	<!-- Top Intro Banner -->
	<div class="text-center mb-5">
		<span class="badge badge-pill badge-primary-light font-weight-700 px-3 py-1 mb-2 text-uppercase" style="font-size: 11px; letter-spacing: 0.8px;">Support & Inquiries</span>
		<h1 class="font-weight-800 text-dark mb-2" style="font-size: 32px; letter-spacing: -0.5px;">Get in Touch With Us</h1>
		<p class="text-muted mx-auto" style="max-width: 600px; font-size: 15px;">
			Have questions about placing ads, daily earnings, or mobile money payouts? Our dedicated customer team is ready to assist you.
		</p>
	</div>

	<div class="row">
		<!-- Left Column: Contact Cards & Info -->
		<div class="col-lg-5 mb-4 mb-lg-0">
			<!-- Direct Phone Support -->
			<div class="card border-0 shadow-sm mb-3" style="border-radius: 16px; overflow: hidden; transition: transform 0.2s ease;">
				<div class="card-body p-4 d-flex align-items-center">
					<div class="mr-3" style="width: 54px; height: 54px; border-radius: 14px; background: rgba(16, 185, 129, 0.12); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;">
						<i class="fas fa-phone-alt"></i>
					</div>
					<div>
						<h6 class="font-weight-700 text-dark mb-1" style="font-size: 15px;">Phone & WhatsApp</h6>
						<p class="mb-0 font-weight-600 text-secondary" style="font-size: 14px;">
							<a href="tel:+255752844733" class="text-secondary text-decoration-none d-block">+255 752 844 733</a>
							<a href="tel:+255786567890" class="text-secondary text-decoration-none d-block">+255 786 567 890</a>
						</p>
						<small class="text-muted">Available 24/7 for urgent assistance</small>
					</div>
				</div>
			</div>

			<!-- Official Email Support -->
			<div class="card border-0 shadow-sm mb-3" style="border-radius: 16px; overflow: hidden; transition: transform 0.2s ease;">
				<div class="card-body p-4 d-flex align-items-center">
					<div class="mr-3" style="width: 54px; height: 54px; border-radius: 14px; background: rgba(59, 130, 246, 0.12); color: #3b82f6; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;">
						<i class="fas fa-envelope-open-text"></i>
					</div>
					<div>
						<h6 class="font-weight-700 text-dark mb-1" style="font-size: 15px;">Email Support</h6>
						<p class="mb-0 font-weight-600 text-secondary" style="font-size: 14px;">
							<a href="mailto:info@24ads.co" class="text-primary text-decoration-none font-weight-700">info@24ads.co</a>
						</p>
						<small class="text-muted">Average response time: within 2 hours</small>
					</div>
				</div>
			</div>

			<!-- Office Location -->
			<div class="card border-0 shadow-sm mb-3" style="border-radius: 16px; overflow: hidden; transition: transform 0.2s ease;">
				<div class="card-body p-4 d-flex align-items-center">
					<div class="mr-3" style="width: 54px; height: 54px; border-radius: 14px; background: rgba(255, 107, 44, 0.12); color: #ff6b2c; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;">
						<i class="fas fa-map-marker-alt"></i>
					</div>
					<div>
						<h6 class="font-weight-700 text-dark mb-1" style="font-size: 15px;">Head Office</h6>
						<p class="mb-0 font-weight-600 text-secondary" style="font-size: 14px;">
							Dar es Salaam, Tanzania
						</p>
						<small class="text-muted">East Africa Operations Center</small>
					</div>
				</div>
			</div>

			<!-- Quick FAQ Help Banner -->
			<div class="p-4 rounded-lg mt-4" style="background: linear-gradient(135deg, #0f2942 0%, #1e3a8a 100%); color: #ffffff; border-radius: 16px;">
				<div class="d-flex align-items-center mb-2">
					<i class="fas fa-question-circle text-warning mr-2" style="font-size: 20px;"></i>
					<h6 class="font-weight-700 text-white mb-0" style="font-size: 15px;">Have Quick Questions?</h6>
				</div>
				<p class="text-white-50 small mb-3">Find instant answers about account verification, ad reward calculations, and minimum withdrawals.</p>
				<a href="<?=base_url('faq')?>" class="btn btn-sm btn-outline-light font-weight-600 px-3 py-1" style="border-radius: 8px; font-size: 12px; border: 1.5px solid rgba(255,255,255,0.4);">
					Explore FAQs <i class="fas fa-arrow-right ml-1"></i>
				</a>
			</div>
		</div>

		<!-- Right Column: Interactive Send Message Form -->
		<div class="col-lg-7">
			<div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
				<div class="card-header bg-white border-bottom p-4">
					<div class="d-flex align-items-center">
						<div class="mr-3" style="width: 44px; height: 44px; border-radius: 12px; background: rgba(15, 41, 66, 0.08); color: #0f2942; display: flex; align-items: center; justify-content: center; font-size: 18px;">
							<i class="fas fa-paper-plane text-primary"></i>
						</div>
						<div>
							<h4 class="font-weight-800 text-dark mb-0" style="font-size: 19px;">Send Us a Message</h4>
							<small class="text-muted">Fill in the details below and we will get back to you promptly</small>
						</div>
					</div>
				</div>

				<div class="card-body p-4 pt-3">
					<form id="data-form" method="POST">
						<!-- Full Name -->
						<div class="form-group mb-3">
							<label class="font-weight-700 text-secondary small text-uppercase">Your Full Name <span class="text-danger">*</span></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-light border-right-0" style="border-color: #e2e8f0; color: #64748b;"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" name="name" class="form-control border-left-0 font-weight-600" placeholder="e.g. Jerry Sam" required style="border-color: #e2e8f0; font-size: 14px; height: 46px;">
							</div>
						</div>

						<div class="row">
							<!-- Phone Number -->
							<div class="form-group col-md-6 mb-3">
								<label class="font-weight-700 text-secondary small text-uppercase">Phone Number <span class="text-danger">*</span></label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text bg-light border-right-0" style="border-color: #e2e8f0; color: #64748b;"><i class="fas fa-phone"></i></span>
									</div>
									<input type="text" name="phone" class="form-control border-left-0 font-weight-600" placeholder="e.g. 0754000111" required style="border-color: #e2e8f0; font-size: 14px; height: 46px;">
								</div>
							</div>

							<!-- Email Address -->
							<div class="form-group col-md-6 mb-3">
								<label class="font-weight-700 text-secondary small text-uppercase">Email Address <small class="text-muted">(Optional)</small></label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text bg-light border-right-0" style="border-color: #e2e8f0; color: #64748b;"><i class="fas fa-envelope"></i></span>
									</div>
									<input type="email" name="email" class="form-control border-left-0 font-weight-600" placeholder="name@example.com" style="border-color: #e2e8f0; font-size: 14px; height: 46px;">
								</div>
							</div>
						</div>

						<!-- Message Textarea -->
						<div class="form-group mb-4">
							<label class="font-weight-700 text-secondary small text-uppercase">Your Message <span class="text-danger">*</span></label>
							<textarea class="form-control font-weight-500" rows="5" name="message" placeholder="Type your message, inquiry, or question in detail here..." required style="border-color: #e2e8f0; font-size: 14px; border-radius: 12px; padding: 12px;"></textarea>
						</div>

						<!-- Result Notification -->
						<div id="resultMsg" class="mb-3"></div>

						<!-- Submit Button -->
						<div class="form-group mb-0">
							<button type="button" class="btn btn-primary btn-block btn-lg font-weight-700 turnOnProgress shadow-sm" id="sendBtn" style="height: 48px; border-radius: 12px; font-size: 15px; box-shadow: 0 4px 14px rgba(255, 107, 44, 0.35);">
								<i class="fas fa-paper-plane mr-2"></i> Send Message
							</button>
							<button type="button" class="btn btn-primary btn-block btn-lg font-weight-700 progressBarBtn" disabled style="height: 48px; border-radius: 12px; font-size: 15px; display: none;">
								<i class="fa fa-spinner fa-spin mr-2"></i> Sending Message...
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
        $('#sendBtn').click(function(){
            $('.turnOnProgress').css('display','none');
            $('.progressBarBtn').css('display','inline-block');
            $.ajax({
                url: '<?php echo site_url(); ?>home/send_contact_message',
                type: 'POST',
                data: $('#data-form').serialize(),
                async: true,
                processData: false,
                success: function (data) {
                    if(data.trim()=='Success'){
                        var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-check-circle mr-1"></i> Thank you! Your message has been sent successfully. Our team will contact you shortly. </div>'; 
                        $('#resultMsg').html(output);
                        document.getElementById("data-form").reset();
                    }else{
                        $('#resultMsg').html(data);
                    }
                    $('.turnOnProgress').css('display','inline-block');
                    $('.progressBarBtn').css('display','none');
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
</script>