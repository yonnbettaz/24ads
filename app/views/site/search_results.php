<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row row-grid">
		<?php if(isset($results) && sizeof($results)>0){ ?>
			<?php foreach ($results as $ads){ ?>
				<div class="col-md-6 col-lg-4 col-xl-3">
					<div class="profile-widget">
						<div class="doc-img">
							<a href="<?php echo base_url('home/ads_content?ads=').$ads->id; ?>">
								<img class="img-fluid" alt="User Image" src="<?php echo base_url('media/banner/').$ads->banner; ?>">
							</a>
							<!-- <a href="javascript:void(0)" class="fav-btn">
								<i class="far fa-bookmark"></i>
							</a> -->
						</div>
						<div class="pro-content">
							<h3 class="title">
								<a href="<?php echo base_url('home/ads_content?ads=').$ads->id; ?>"><?php echo ucwords($ads->business_name)?></a> 
							</h3>
							<p class="speciality"><?php echo ucwords(get_words($ads->title, '10'))?></p>
							<ul class="available-info">
								<li>
									<i class="far fa-money-bill-alt"></i> <?php echo ucwords($ads->cost_per_click)?> TZS <i class="fas fa-info-circle" data-toggle="tooltip" title=""></i>
								</li>
							</ul>
							<div class="row row-sm">
								<div class="col-12">
									<a href="<?php echo base_url('home/ads_content?ads=').$ads->id; ?>" class="btn book-btn">Read Ads</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		<?php }else{ ?>
			<div class="col-md-12"><div class="alert alert-info">Ooooooops! No results found...</div></div>
		<?php } ?>
	</div>
</body>
</html>