<div class="content py-4" style="min-height: 70vh;">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-9 col-md-11">
				<form method="POST" id="data-form">
					<?php if(!isset($_SESSION['24ads_user_idetification'])){ ?>
						<!-- Login Required Card -->
						<div class="card border-0 shadow-sm text-center p-5" style="border-radius: 16px;">
							<div class="mb-3" style="width: 70px; height: 70px; border-radius: 50%; background: #fef3c7; display: inline-flex; align-items: center; justify-content: center; color: #d97706; font-size: 28px;">
								<i class="fas fa-lock"></i>
							</div>
							<h4 class="font-weight-800 text-dark mb-2">Login Required</h4>
							<p class="text-muted small mb-4">Please log in to your 24ads account to answer quiz questions and collect your cash reward.</p>
							<div>
								<a class="btn btn-primary font-weight-700 px-4 py-2" href="javascript:void(0);" data-toggle="modal" data-target="#login_popup" style="border-radius: 8px;">
									<i class="fas fa-sign-in-alt mr-1"></i> Login Now
								</a>
							</div>
						</div>
					<?php } else { ?>
						<?php 
							if($question_time=="" || ($question_time > 0 && ($question_time - $user_question_time) > 0)){
								$remained_time = "";
								if($question_time > 0){
									$remained_time = $question_time - $user_question_time;
								}
						?>
							<?php if(isset($questions['exist']) && $questions['exist'] == '0'){ ?>
								<!-- Quiz Header & Timer Card -->
								<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; background: linear-gradient(135deg, #0f2942 0%, #1e3a8a 100%); color: #ffffff;">
									<div class="card-body p-4">
										<div class="row align-items-center">
											<div class="col-md-8 mb-3 mb-md-0">
												<div class="d-flex align-items-center mb-1">
													<span class="badge badge-warning text-dark font-weight-700 px-2 py-1 mr-2" style="font-size: 11px;">VERIFICATION QUIZ</span>
													<span class="text-white-50 small"><i class="fas fa-coins mr-1"></i> Answer correctly to earn cash</span>
												</div>
												<h4 class="font-weight-800 text-white mb-1" style="font-size: 22px;">Ad Verification Questions</h4>
												<p class="text-white-50 small mb-0">Select the correct option for each question based on the ad story you read.</p>
											</div>
											<div class="col-md-4 text-md-right">
												<div class="d-inline-flex align-items-center bg-dark px-3 py-2 rounded-pill shadow-sm" style="background: rgba(0,0,0,0.3) !important; border: 1px solid rgba(255,255,255,0.15);">
													<i class="far fa-clock text-warning mr-2" style="font-size: 18px;"></i>
													<div class="text-left">
														<span class="text-white-50 d-block" style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Time Remaining</span>
														<div class="font-weight-800 text-white" style="font-size: 16px; line-height: 1;">
															<span id="minutes">--</span>m <span id="seconds">--</span>s
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Question List -->
								<?php
									$counter = 0; 
									$display_bonus = true; 
									$display_question = true;

									if(!empty($questions['questions'])){
										foreach ($questions['questions'] as $question) {
											$counter++;
											$display = false;
											if($question->is_bonus == '1'){
												$display = !empty($questions['has_bonus']);
											} else {
												$display = !empty($questions['has_commission']);
											}

											if($display){
												$is_bonus = ($question->is_bonus == '1');
												$border_color = $is_bonus ? '#f59e0b' : '#e2e8f0';
								?>
												<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; border-left: 5px solid <?=$border_color?> !important; overflow: hidden;">
													<div class="card-header bg-white border-bottom p-3 px-4 d-flex justify-content-between align-items-center">
														<span class="font-weight-700 text-dark" style="font-size: 15px;">
															Question #<?=$counter?>
														</span>
														<?php if($is_bonus){ ?>
															<span class="badge badge-warning text-dark font-weight-700 px-2 py-1" style="font-size: 11px;">
																<i class="fas fa-star mr-1"></i> Bonus Question
															</span>
														<?php } else { ?>
															<span class="badge badge-light text-primary font-weight-600 px-2 py-1" style="background: #e0f2fe; font-size: 11px;">
																Standard Question
															</span>
														<?php } ?>
													</div>
													<div class="card-body p-4">
														<h5 class="font-weight-700 text-dark mb-3" style="font-size: 16px; line-height: 1.4;">
															<?=htmlspecialchars($question->question)?>
														</h5>

														<div class="quiz-options-list">
															<?php
																$raw_answers = $question->answers;
																$answer_items = array();

																if (strpos($raw_answers, ';') !== false) {
																	$answer_items = explode(';', $raw_answers);
																} elseif (strpos($raw_answers, ',') !== false) {
																	$answer_items = explode(',', $raw_answers);
																} elseif (strpos($raw_answers, "\n") !== false) {
																	$answer_items = explode("\n", $raw_answers);
																} else {
																	$answer_items = array($raw_answers);
																}

																$opt_idx = 0;
																foreach ($answer_items as $item_str) {
																	$item_str = trim($item_str);
																	if ($item_str === '') continue;
																	$opt_idx++;

																	if (strpos($item_str, ':') !== false) {
																		$parts = explode(':', $item_str, 2);
																		$input_val = trim($parts[0]);
																		$opt_label = trim($parts[1] ?? '');
																		$display_html = '<strong class="text-primary">' . htmlspecialchars($input_val) . ':</strong> ' . htmlspecialchars($opt_label);
																	} else {
																		$input_val = $item_str;
																		$display_html = htmlspecialchars($item_str);
																	}
															?>
																<div class="custom-control custom-radio mb-3 p-3 rounded" style="background: #f8fafc; border: 1.5px solid #e2e8f0; transition: all 0.2s ease; cursor: pointer;">
																	<input type="radio" id="q_<?=$counter?>_opt_<?=$opt_idx?>" name="answer<?=$counter?>" value="<?=$input_val?>" class="custom-control-input" required>
																	<label class="custom-control-label font-weight-600 text-dark w-100 mb-0" for="q_<?=$counter?>_opt_<?=$opt_idx?>" style="cursor: pointer; padding-left: 8px;">
																		<?=$display_html?>
																	</label>
																</div>
															<?php } ?>
														</div>

														<input type="hidden" name="question<?=$counter?>" value="<?=$question->id?>">
														<input type="hidden" name="is_bonus<?=$counter?>" value="<?=$question->is_bonus?>">
													</div>
												</div>
								<?php
											} else {
												if($question->is_bonus == '1'){
													$display_bonus = false;
												} else {
													$display_question = false;
												}
											}
										}
									}

									if(!$display_question){
										echo '<div class="alert alert-warning border-0 shadow-sm mb-4" style="border-radius: 12px;"><i class="fas fa-info-circle mr-1"></i> Insufficient budget remaining for standard question rewards on this campaign.</div>';
									}
									if(!$display_bonus && !empty($bonuses) && $bonuses > 0){
										echo '<div class="alert alert-info border-0 shadow-sm mb-4" style="border-radius: 12px;"><i class="fas fa-info-circle mr-1"></i> Bonus rewards for this ad are currently exhausted.</div>';
									}
								?>

								<input type="hidden" value="<?=$remained_time?>" id="question_time">
								<input type="hidden" name="total_questions" value="<?=$total_questions?>" id="total_questions">
								<input type="hidden" name="bonuses" value="<?=$bonuses?>">
								<input type="hidden" name="question_time" value="<?=$question_time?>">
								<input type="hidden" name="ads" value="<?=$ads?>" id="ads">

								<div id="resultMsg" class="mb-3"></div>

								<div class="text-center mb-5">
									<button type="button" class="btn btn-primary btn-lg font-weight-800 shadow-sm px-5 py-3 turnOnProgress" onclick="submitQuestion();" style="border-radius: 12px; font-size: 16px;">
										<i class="fas fa-check-circle mr-1"></i> Submit Answers & Earn
									</button>
									<button type="button" class="btn btn-primary btn-lg font-weight-800 px-5 py-3 progressBarBtn" style="display: none; border-radius: 12px; font-size: 16px;" disabled>
										<i class="fa fa-spinner fa-spin mr-1"></i> Verifying Answers...
									</button>
								</div>
							<?php } else { ?>
								<!-- Already Answered Notice -->
								<div class="card border-0 shadow-sm text-center p-5" style="border-radius: 16px;">
									<div class="mb-3" style="width: 70px; height: 70px; border-radius: 50%; background: #e0f2fe; display: inline-flex; align-items: center; justify-content: center; color: #0284c7; font-size: 28px;">
										<i class="fas fa-check-double"></i>
									</div>
									<h4 class="font-weight-800 text-dark mb-2">Already Participated!</h4>
									<p class="text-muted small mb-4">You have already answered the questions for this advertisement campaign. Please browse other active campaigns to earn more!</p>
									<div>
										<a class="btn btn-primary font-weight-700 px-4 py-2" href="<?=base_url()?>" style="border-radius: 8px;">
											<i class="fas fa-play mr-1"></i> View More Ads
										</a>
									</div>
								</div>
							<?php } ?>
						<?php } else { ?>
							<!-- Time Expired Notice -->
							<div class="card border-0 shadow-sm text-center p-5" style="border-radius: 16px;">
								<div class="mb-3" style="width: 70px; height: 70px; border-radius: 50%; background: #fee2e2; display: inline-flex; align-items: center; justify-content: center; color: #ef4444; font-size: 28px;">
									<i class="fas fa-hourglass-end"></i>
								</div>
								<h4 class="font-weight-800 text-dark mb-2">Quiz Time Expired</h4>
								<p class="text-muted small mb-4">The allotted time to answer questions for this advertisement has elapsed. Please check out other exciting ads!</p>
								<div>
									<a class="btn btn-primary font-weight-700 px-4 py-2" href="<?=base_url()?>" style="border-radius: 8px;">
										<i class="fas fa-arrow-left mr-1"></i> Return to Ads
									</a>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var qTimeInput = document.getElementById('question_time');
	var question_time = (qTimeInput) ? qTimeInput.value : '';
	var timer;

	if(question_time !== '' && !isNaN(question_time)){
		var time = parseInt(question_time) * 60;
		var start = Date.now();
		var mins = document.getElementById('minutes');
		var secs = document.getElementById('seconds');

		function countdown() {
			var timeleft = Math.max(0, time - (Date.now() - start) / 1000);
			var m = Math.floor(timeleft / 60);
			var s = Math.floor(timeleft % 60);

			if(mins && secs){
				mins.textContent = (m < 10 ? '0' : '') + m;
				secs.textContent = (s < 10 ? '0' : '') + s;
			}

			if(timeleft <= 0){
				clearInterval(timer);
			}
		}

		$(document).ready(function(){
			countdown();
			timer = setInterval(countdown, 500);
		});
	}

	function submitQuestion(){
		var totalQEl = document.getElementById('total_questions');
		var total_questions = (totalQEl) ? parseInt(totalQEl.value) : 0;
		var ans_counter = 0;

		for (var i = 1; i <= total_questions; i++) {
			var rates = document.getElementsByName('answer' + i);
			for(var j = 0; j < rates.length; j++){
				if (rates[j].checked) {
					ans_counter++;
					break;
				}
			}
		}

		if(total_questions > 0 && ans_counter < total_questions){
			alert("Tafadhali jibu maswali yote kabla ya kuwasilisha.");
			return false;
		}

		$('.turnOnProgress').hide();
		$('.progressBarBtn').show();

		$.ajax({
			url: '<?php echo site_url("home/submit_ads_answers"); ?>',
			type: 'POST',
			data: $('#data-form').serialize(),
			success: function (data) {
				if(data.trim() === 'Success'){
					var output = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle mr-1"></i> Majibu yako yamewasilishwa kwa mafanikio!</div>'; 
					$('#resultMsg').html(output);
					document.getElementById("data-form").reset();
					var adId = $('#ads').val();
					setTimeout(function(){
						window.location = '<?php echo base_url("home/ads_answers?ads="); ?>' + adId;
					}, 800);
				} else {
					$('#resultMsg').html(data);
					$('.turnOnProgress').show();
					$('.progressBarBtn').hide();
				}
			},
			error: function (xhr, status, error) {
				$('#resultMsg').html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
				$('.turnOnProgress').show();
				$('.progressBarBtn').hide();
			}
		});
	}
</script>