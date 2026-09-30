<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div class="row">
		<div class="col-md-6 mx-auto">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Add/Update Promo</h4>
				</div>
				<div class="card-body">
					<form method="POST" id="data-form" class="row">
						<div class="form-group col-md-12">
							<label>Title:</label>
							<textarea name="title" class="form-control"><?php if(isset($info['title']) && $info['title']!=""){ echo htmlspecialchars($info['title'], ENT_QUOTES, 'UTF-8');} ?></textarea>
							<input type="hidden" name="promo" value="<?php if(isset($promo) && $promo!=""){ echo htmlspecialchars($promo, ENT_QUOTES, 'UTF-8');} ?>">
						</div>
						<div class="form-group col-md-12">
							<label>Link/Url:</label>
							<input type="text" name="url" value="<?php if(isset($info['url']) && $info['url']!=""){ echo htmlspecialchars($info['url'], ENT_QUOTES, 'UTF-8');} ?>" class="form-control" placeholder="http://">
						</div>
						<div class="form-group col-md-4">
							<label>View Location:</label>
							<input type="text" name="view_location" value="<?php if(isset($info['view_location']) && $info['view_location']!=""){ echo htmlspecialchars($info['view_location'], ENT_QUOTES, 'UTF-8');} ?>" class="form-control">
						</div>
						<div class="form-group col-md-4">
							<label>Expire Date:</label>
							<input type="date" name="expire_date" value="<?php if(isset($info['expire_date']) && $info['expire_date']!=""){ echo htmlspecialchars($info['expire_date'], ENT_QUOTES, 'UTF-8');} ?>" class="form-control">
						</div>
						<div class="form-group col-md-4">
							<label>Cost:</label>
							<input type="number" name="cost" value="<?php if(isset($info['cost']) && $info['cost']!=""){ echo htmlspecialchars($info['cost'], ENT_QUOTES, 'UTF-8');} ?>" class="form-control">
						</div>
						<div class="form-group col-md-12">
							<label>Banner:</label>
							<div class="promo_banner_upload text-center">
								<?php if(isset($info['banner']) && $info['banner']!=""){ $banner=$info['banner'];}else{ $banner="default.jpg";} ?>
								<img src="<?=base_url('media/promo/'.$banner)?>"  id="img-current-holder1">
							</div>
							<div class="text-center">
								<label for="banner" class="btn btn-xs btn-success"><i class="fa fa-upload"></i> Upload Photo</label>
								<input type="file" class="upload" name="banner" id="banner" accept="image/*" style="display: none;">
								<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 25MB</small>
							</div>
						</div>
						<p class="col-md-12"><small>Note: View location is the place where promo ad is going to be.</small></p>
						<div class="col-md-12" id="resultMsg"></div>
                        <div class="form-group col-md-12">
                        	<?php if(isset($promo) && $promo!=""){ ?>
                            	<a href="javascript:void(0);" class="btn btn-primary btn-block btn-sm turnOnProgress" id="updateBtn">Update</a>
                        	<?php }else{ ?>
                            	<a href="javascript:void(0);" class="btn btn-primary btn-block btn-sm turnOnProgress" id="saveBtn">Submit</a>
                        	<?php } ?>
                            <a href="javascript:void(0);" class="btn btn-primary btn-block btn-sm progressBarBtn"><i class="fa fa-spinner fa-spin"></i> Processing...</a>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#banner").change(function(){
            readURL(this);
        });

        function readURL(input) {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            reader.onload = function (e) {
	                $('#img-current-holder1').attr('src', e.target.result);
	            }
	            reader.readAsDataURL(input.files[0]);
	        }
	    }

        $('#saveBtn').click(function(){
           $('.turnOnProgress').css('display','none');
           $('.progressBarBtn').css('display','inline-block');
           var formData = new FormData($('#data-form')[0]);
           $.ajax({
               url: '<?php echo base_url(); ?>admin/ads/save_promo',
               type: 'POST',
               data: formData,
               async: true,
               cache: false,
               contentType: false,
               enctype: 'multipart/form-data',
               processData: false,
               success: function (data) {
                    if(data.trim()=='Success'){
                        var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button> Success </div>'; 
                        $('#resultMsg').html(output);
                        document.getElementById("data-form").reset();
                        window.location="";
                    }else{
                        $('#resultMsg').html(data);
                    }
                    $('.turnOnProgress').css('display','inline-block');
                    $('.progressBarBtn').css('display','none');
                },
                complete: function() {
                    $('.turnOnProgress').css('display','inline-block');
                    $('.progressBarBtn').css('display','none');
                },
                error: function( xhr, status, error ) {
                    $('#resultMsg').html(error);
                    console.log('ajax loading error...');
                    console.log(error);
                    $('.turnOnProgress').css('display','inline-block');
                    $('.progressBarBtn').css('display','none');
                    return false;
                }
           });
        });

        $('#updateBtn').click(function(){
           $('.turnOnProgress').css('display','none');
           $('.progressBarBtn').css('display','inline-block');
           var formData = new FormData($('#data-form')[0]);
           $.ajax({
               url: '<?php echo base_url(); ?>admin/ads/update_promo',
               type: 'POST',
               data: formData,
               async: true,
               cache: false,
               contentType: false,
               enctype: 'multipart/form-data',
               processData: false,
               success: function (data) {
                    if(data.trim()=='Success'){
                        var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button> Success </div>'; 
                        $('#resultMsg').html(output);
                        document.getElementById("data-form").reset();
                        window.location="<?=base_url('admin/ads/promo')?>";
                    }else{
                        $('#resultMsg').html(data);
                    }
                    $('.turnOnProgress').css('display','inline-block');
                    $('.progressBarBtn').css('display','none');
                },
                complete: function() {
                    $('.turnOnProgress').css('display','inline-block');
                    $('.progressBarBtn').css('display','none');
                },
                error: function( xhr, status, error ) {
                    $('#resultMsg').html(error);
                    console.log('ajax loading error...');
                    console.log(error);
                    $('.turnOnProgress').css('display','inline-block');
                    $('.progressBarBtn').css('display','none');
                    return false;
                }
           });
        });

	});
</script>