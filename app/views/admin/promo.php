<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Promos</h4>
					<p><a href="<?=base_url('admin/ads/add_promo')?>" class="btn btn-sm btn-info">Add New Promo</a></p>
				</div>
				<div class="card-body">
					<div class="tbl-responsive">
						<table class="datatable1 table table-hover table-bordered table-center w-break">
							<thead>
								<tr>
									<th>#</th>
									<th></th>
									<th>Title</th>
									<th>Url</th>
									<th>View Location</th>
									<th>Expire Date</th>
									<th>Charge (TZS)</th>
									<th>Uploaded Date</th>
									<th class="text-center">Status</th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$counter=0;
									foreach ($promos as $promo) {
										$counter++;
										$status="";
										$action="";
										$action='<a href="'.base_url('admin/ads/add_promo').'?promo='.$promo->id.'" class="btn btn-xs bg-info-light m-r-10"><i class="fa fa-edit"></i></a>';
										if($promo->status=="0"){
											$status='<span class="badge badge-pill bg-success inv-badge">Active</span>';
											$action.='<a href="javascript:void(0);" onclick="diactivate_row('.$promo->id.', \'promo\', \'promo\');" class="btn btn-xs bg-warning-light">Diactivate</a>';
										}else{
											$status='<span class="badge badge-pill bg-danger inv-badge">Disabled</span>';
											$action.='<a href="javascript:void(0);" onclick="activate_row('.$promo->id.', \'promo\', \'promo\');" class="btn btn-xs bg-success-light">Activate</a>';
										}
										$action.='<a href="javascript:void(0);" onclick="delete_row('.$promo->id.', \'promo\', \'promo\');" class="btn btn-xs bg-danger-light m-l-10"><i class="fa fa-trash"></i></a>';
										$cost=0;
										if($promo->cost!=""){
											$cost=$promo->cost;
										}
										echo '<tr>';
										echo '<td>'.$counter.'</td>';
										echo '<td>
												<div class="table-avatar">
													<a href="javascript:void(0);" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="'.base_url('media/promo/').$promo->banner.'" alt=""></a>
												</div>
											</td>';
										echo '<td>'.ucwords($promo->title).'</td>';
										echo '<td><a href="'.$promo->url.'" target="_blank">'.$promo->url.'</a></td>';
										echo '<td>'.$promo->view_location.'</td>';
										echo '<td>'.$promo->expire_date.'</td>';
										echo '<td>'.number_format($cost).'</td>';
										echo '<td>'.date("d-m-Y H:i", strtotime($promo->createdDate)).'</td>';
										echo '<td class="text-center">'.$status.'</td>';
										echo '<td class="text-right">'.$action.'</td>';
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