<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Cash Flow Report</h4>
				</div>
				<div class="card-body">
					<div class="col-md-6 mx-auto">
						<form class="row" method="GET">
							<div class="col-md-8">
								<div class="input-group">
	                                <input type="date" name="startDate" class="form-control" value="<?php if(isset($startDate)){ echo htmlspecialchars($startDate, ENT_QUOTES, 'UTF-8');} ?>" />
									<div class="input-group-prepend">
	                                	<span class="input-group-text"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                                <input type="date" name="endDate" class="form-control" value="<?php if(isset($endDate)){ echo htmlspecialchars($endDate, ENT_QUOTES, 'UTF-8');} ?>" />
								</div>
								<p><small>Filter report by start date and end date.</small></p>
							</div>
							<div class="col-md-4">
								<button class="btn btn-block btn-info">Filter</button>
							</div>
						</form>
					</div>
					<div class="col-md-6 mx-auto">
						<table class="table table-bordered">
							<tbody>
								<?php
									$budget_allocated=0; $bonus_allocated=0; $profit=0; $total_used=0;
									if(isset($record['total_budget']) && $record['total_budget']>0)
										$budget_allocated=$record['total_budget'];

									if(isset($record['total_bonus']) && $record['total_bonus']>0)
										$bonus_allocated=$record['total_bonus'];

									if(isset($record['total_commission']) && $record['total_commission']>0)
										$total_used=$record['total_commission'];

									if(isset($record['profit']) && $record['profit']>0)
										$profit=$record['profit'];

									$total_budget=$budget_allocated+$bonus_allocated;
								?>
								<tr>
									<td>Budget Allocated: </td><td> <b><?php echo number_format($budget_allocated); ?></b> TZS</td>
								</tr>
								<tr>
									<td>Bonus Allocated: </td><td> <b><?php echo number_format($bonus_allocated); ?></b> TZS</td>
								</tr>
								<tr>
									<td>Total Budget Allocated: </td><td> <b><?php echo number_format($total_budget); ?></b> TZS</td>
								</tr>
								<tr>
									<td>Total Bugget Used: </td><td> <b><?php echo number_format($total_used); ?></b> TZS</td>
								</tr>
								<tr>
									<td>24Ads Profit: </td><td> <b><?php echo number_format($profit); ?></b> TZS</td>
								</tr>
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