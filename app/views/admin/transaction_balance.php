<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Account Balance</h4>
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
									<th>Total Commission (TZS)</th>
									<th>Total Withdraw (TZS)</th>
									<th>Total Charges (TZS)</th>
									<th>Business (TZS)</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$counter=0;
									foreach ($balances as $balance) {
										$counter++;
										$avatar="default.png";
										$total_charge=""; $total_commission=""; $total_withdraw=""; $balace="";
										if($balance['total_commission']!=""){
											$total_commission=number_format($balance['total_commission']);
										}
										if($balance['total_withdraw']!=""){
											$total_withdraw=number_format($balance['total_withdraw']);
										}
										if($balance['total_charge']!=""){
											$total_charge=number_format($balance['total_charge']);
										}
										if($balance['balance']!=""){
											$balace=number_format($balance['balance']);
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
										echo '<td>'.$total_commission.'</td>';
										echo '<td>'.$total_withdraw.'</td>';
										echo '<td>'.$total_charge.'</td>';
										echo '<td>'.$balace.'</td>';
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