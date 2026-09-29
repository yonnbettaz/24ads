<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Business Accounts Report</h4>
				</div>
				<div class="card-body">
					<div class="col-md-6 mx-auto">
						<form class="row" method="GET">
							<div class="col-md-8">
								<div class="input-group">
	                                <input type="date" name="startDate" class="form-control" value="<?php if(isset($startDate)){ echo $startDate;} ?>" />
									<div class="input-group-prepend">
	                                	<span class="input-group-text"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                                <input type="date" name="endDate" class="form-control" value="<?php if(isset($endDate)){ echo $endDate;} ?>" />
								</div>
								<p><small>Filter report by start date and end date.</small></p>
							</div>
							<div class="col-md-4">
								<button class="btn btn-info">Filter</button>
							</div>
						</form>
					</div>
					<hr>
					<div class="tbl-responsive">
						<table class="datatable1 table table-hover table-bordered table-center w-break">
							<thead>
								<tr>
									<th>#</th>
									<th></th>
									<th>Name</th>
									<th>Gender</th>
									<th>Business</th>
									<th>Contacts</th>
									<th>Username</th>
									<th>Location</th>
									<th>Registered Date</th>
									<th class="text-center">Status</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$counter=0;
									foreach ($accounts as $account) {
										$counter++;
										$status="";
										if($account->status=="0"){
											$status='<span class="badge badge-pill bg-success inv-badge">Active</span>';
										}else{
											$status='<span class="badge badge-pill bg-danger inv-badge">Disabled</span>';
										}
										$logo="default.png";
										if($account->logo!=""){
											$logo=$account->logo;
										}

										echo '<tr>';
										echo '<td>'.$counter.'</td>';
										echo '<td>
												<div class="table-avatar">
													<a href="javascript:void(0);" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="'.base_url('media/logo/').$logo.'" alt=""></a>
												</div>
											</td>';
										echo '<td>'.ucwords($account->name).'</td>';
										echo '<td>'.ucwords($account->gender).'</td>';
										echo '<td>'.ucwords($account->business_name).' - '.$account->TIN.'</td>';
										echo '<td>'.$account->business_phone.' - '.$account->business_email.' - '.$account->business_address.'</td>';
										echo '<td>'.$account->username.'</td>';
										echo '<td>'.$account->country.' - '.$account->region.' - '.$account->district.'</td>';
										echo '<td>'.date("d-m-Y H:i", strtotime($account->createdDate)).'</td>';
										echo '<td class="text-center">'.$status.'</td>';
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