<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Transaction History</h4>
				</div>
				<div class="card-body">
					<div class="tbl-responsive">
						<table class="datatable1 table table-hover table-bordered table-center w-break">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th></th>
									<th>Contacts</th>
									<th>Transaction Type</th>
									<th>Amount (TZS)</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$counter=0;
									foreach ($balances as $balance) {
										$counter++;
										$avatar="default.png";
										$amount="---";
										if($balance['credit']!=""){
											$amount=number_format($balance['credit']);
										}
										if($balance['debit']!=""){
											$amount=number_format($balance['debit']);
										}
										if($balance['avatar']!=""){
											$avatar=$balance['avatar'];
										}
										echo '<tr>';
										echo '<td>'.$counter.'</td>';
										echo '<td>'.ucwords($balance['name']).'</td>';
										echo '<td class="no-break">
												<div class="table-avatar">
													<a href="javascript:void(0);" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="'.base_url('media/avatar/').$avatar.'" alt=""></a>
												</div>
											</td>';
										echo '<td>'.$balance['phone'].' - '.$balance['email'].'</td>';
										echo '<td>'.ucwords($balance['transaction_type']).'</td>';
										echo '<td>'.$amount.'</td>';
										echo '<td>'.date("d-m-Y H:i:s", strtotime($balance['createdDate'])).'</td>';
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