<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Personal Records</h4>
				</div>
				<div class="card-body">
					<div class="tbl-responsive">
						<table class="datatable1 table table-hover table-bordered table-center w-break">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th></th>
									<th>Title</th>
									<th>Publisher</th>
									<th>Total Questions</th>
									<th class="text-center">Correct Answers</th>
									<th>Cash Earned</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$counter=0;
									foreach ($records as $record) {
										$counter++;
										$cash_earned="";
										if($record->total_cash!=""){
											$cash_earned='<b>'.$record->total_cash.'</b> TZS';
										}
										echo '<tr>';
										echo '<td>'.$counter.'</td>';
										echo '<td>'.ucwords($record->name).'</td>';
										echo '<td class="no-break">
												<div class="table-avatar">
													<a href="javascript:void(0);" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="'.base_url('media/banner/').$record->banner.'" alt=""></a>
												</div>
											</td>';
										echo '<td>'.$record->title.'</td>';
										echo '<td>'.$record->business_name.'</td>';
										echo '<td>'.$record->total_question.'</td>';
										echo '<td>'.$record->correct_answer.'</td>';
										echo '<td>'.$cash_earned.'</td>';
										echo '</tr>';
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>			
	</div>

</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		if ($('.datatable1').length > 0) {
	        $('.datatable1').DataTable({
	            "bFilter": false,
	            "searching": true
	        });
	    }

	});
</script>