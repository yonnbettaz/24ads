<?php
$ad = (!empty($info) && is_array($info)) ? $info[0] : null;
$earned = isset($answers['earned']) ? (float)$answers['earned'] : 0;
$ans_list = isset($answers['answers']) ? $answers['answers'] : array();

$correct_count = 0;
$total_answered = count($ans_list);
foreach ($ans_list as $a) {
	if ($a->is_correct == "1") {
		$correct_count++;
	}
}
?>

<div class="content py-5" style="min-height: 70vh;">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-10">
				<!-- Completion Voucher & Score Card -->
				<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
					<!-- Top Banner -->
					<div class="card-header p-4 text-center" style="background: linear-gradient(135deg, #0f2942 0%, #1e3a8a 100%); color: #ffffff;">
						<div class="mb-2" style="width: 60px; height: 60px; border-radius: 50%; background: rgba(16,185,129,0.2); color: #10b981; display: inline-flex; align-items: center; justify-content: center; font-size: 26px; border: 2px solid #10b981;">
							<i class="fas fa-check"></i>
						</div>
						<h3 class="font-weight-800 text-white mb-1">Quiz Completed!</h3>
						<p class="text-white-50 small mb-2"><?=!empty($ad['title']) ? htmlspecialchars($ad['title']) : 'Verification Results'?></p>
						<div class="d-inline-block bg-warning px-4 py-2 rounded-pill text-dark font-weight-800 shadow-sm mt-1" style="font-size: 20px;">
							<i class="fas fa-coins mr-1"></i> +<?=number_format($earned)?> TZS Earned
						</div>
					</div>

					<div class="card-body p-4">
						<!-- Performance Stats Row -->
						<div class="row text-center border-bottom pb-4 mb-4">
							<div class="col-4 border-right">
								<span class="text-muted small text-uppercase font-weight-600 d-block">Score</span>
								<h4 class="font-weight-800 text-primary mb-0 mt-1"><?=$correct_count?> / <?=$total_questions?></h4>
							</div>
							<div class="col-4 border-right">
								<span class="text-muted small text-uppercase font-weight-600 d-block">Accuracy</span>
								<h4 class="font-weight-800 text-dark mb-0 mt-1">
									<?=$total_questions > 0 ? round(($correct_count / $total_questions) * 100) : 0?>%
								</h4>
							</div>
							<div class="col-4">
								<span class="text-muted small text-uppercase font-weight-600 d-block">Cash Added</span>
								<h4 class="font-weight-800 text-success mb-0 mt-1"><?=number_format($earned)?> TZS</h4>
							</div>
						</div>

						<!-- Answers Breakdown -->
						<h5 class="font-weight-700 text-dark mb-3" style="font-size: 16px;">
							<i class="fas fa-list-check text-primary mr-2"></i> Question Breakdown
						</h5>

						<div class="table-responsive mb-4">
							<table class="table table-hover table-center align-middle mb-0">
								<thead class="bg-light text-muted" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
									<tr>
										<th class="text-center" style="width: 50px;">#</th>
										<th>Verification Question</th>
										<th>Your Answer</th>
										<th class="text-center" style="width: 100px;">Result</th>
									</tr>
								</thead>
								<tbody style="font-size: 13.5px;">
									<?php 
									if(!empty($ans_list)){
										$q_counter = 0;
										foreach ($ans_list as $data) {
											$q_counter++;
											$is_correct = ($data->is_correct == "1");
									?>
										<tr>
											<td class="text-center font-weight-600 text-muted"><?=$q_counter?></td>
											<td>
												<span class="font-weight-600 text-dark"><?=htmlspecialchars($data->question)?></span>
											</td>
											<td>
												<span class="badge badge-light font-weight-600 px-2 py-1" style="background: #f1f5f9;">
													<?=htmlspecialchars($data->answer)?>
												</span>
											</td>
											<td class="text-center">
												<?php if($is_correct){ ?>
													<span class="badge badge-pill badge-success-light font-weight-700 px-2 py-1" style="color: #10b981; background: rgba(16,185,129,0.12);">
														<i class="fas fa-check mr-1"></i> Correct
													</span>
												<?php } else { ?>
													<span class="badge badge-pill badge-danger-light font-weight-700 px-2 py-1" style="color: #ef4444; background: rgba(239,68,68,0.12);">
														<i class="fas fa-times mr-1"></i> Wrong
													</span>
												<?php } ?>
											</td>
										</tr>
									<?php 
										}
									} else { ?>
										<tr>
											<td colspan="4" class="text-center py-3 text-muted">No answer records found.</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>

						<!-- Action Buttons -->
						<div class="d-flex flex-wrap justify-content-center gap-2 pt-2">
							<a href="<?=base_url()?>" class="btn btn-primary font-weight-700 px-4 py-2 mr-2 mb-2" style="border-radius: 8px;">
								<i class="fas fa-play mr-1"></i> View More Ads
							</a>
							<a href="<?=base_url('personal')?>" class="btn btn-outline-secondary font-weight-600 px-4 py-2 mb-2" style="border-radius: 8px;">
								<i class="fas fa-wallet mr-1"></i> Check Balance
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>