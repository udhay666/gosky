<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
	<div class="page">
		<div class="row">
			<div class="col-md-12">
				<div class="pageheader">
					<div class="page-bar  br-5">
						<ul class="page-breadcrumb">
							<li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
							<li><a href="#">Excursions</a></li>
							<li><a class="active" href="<?php echo site_url()?>excursions/excursion_gallery?id=<?php echo $excursion_id;?>">Add Gallery Image</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php
		$sess_msg = $this->session->flashdata('message');
		$errors_msg = $this->session->flashdata('errors_msg');
		if(!empty($sess_msg)){
			$message = $sess_msg;
			$class = 'success';
		} else  if(!empty($errors_msg)){
			$message = $errors_msg;
			$class = 'danger';
		} else {
			$message = $error;
			$class = 'danger';
		}
		?>
		<?php if($message){ ?>
		<br>
		<div class="alert alert-<?php echo $class ?>">
			<button class="close" data-dismiss="alert" type="button">×</button>
			<strong><?php echo ucfirst($class) ?>....!</strong>
			<?php echo $message; ?>
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-md-12">
				<section class="boxs">
					<div class="boxs-header dvd dvd-btm">
						<h1 class="custom-font">Add Gallery Image</h1>
						<ul class="controls">
							<li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
						</ul>
					</div>
					<div class="boxs-body">
						<div class="pagecontent">
							<div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
								<div class="tab-content2">
									<form action="<?php echo site_url()?>excursions/update_excursion_image" method="post" class="step_form step1" steps="1" name="step1" role="form" enctype="multipart/form-data">
										<div class="tab-pane active" id="step-1">
								<div class="row border_row min_height200">
												<div class="col-md-12">
													<label><strong>Gallery Image</strong></label><br>
													<div class="messages2"></div>
													<span class="btn btn-success fileinput-button">
														<i class="glyphicon glyphicon-plus"></i>
														<span>Add Multiple image...</span>
														<input type="file" multiple="multiple" accept="image/*" class="form-control imageupload" name="uploadfile[]" /><br/>
													</span>
														<input type="hidden" name="id" value="<?php echo $excursion_info->excursion_id; ?>">
													<input type="hidden" name="controller" value="sup_excursion_images">
													<input type="hidden" name="unique_id_column" class="unique_id_column" value="sup_excursion_images_id">
													<input type="hidden" name="foreign_id_column" value="sup_excursion_id">
													<input type="hidden" name="foreign_id_value" class="foreign_id_value">
													<input type="hidden" name="table_name" value="sup_excursion_images">
													<input type="hidden" name="column_name" value="image_path">
													<input type="hidden" name="img_type" value="gallery">
													<input type="hidden" name="upload_type" value="update">
													<!-- <input type="button" name="submit" value="Upload" class="btn btn-primary upload_now1"> -->
													<div class="row2" style="margin-top: 15px">
														<?php foreach($gallery_img as $gal) { ?>
														<div class="priv_div" style="position:relative;display:inline-block" img_id="<?php echo $gal->sup_excursion_images_id ?>">
															<img src="<?php echo base_url().$gal->image_path ?>" img_url="<?php echo $gal->image_path ?>" title="" class="thumbimage" /><i class="fa fa-close delete_img"></i>
														</div>
														<?php } ?>
													</div>
													<div class="row2 preview-image"></div>
												</div>
											</div>
										</div>
										<ul class="pager wizard">
											<li class="first">
												<button type="submit" class="btn btn-success todo" style="float: right;margin-right: 20px">Save</button>
											</li>
											<li><a href="<?php echo site_url() ?>excursions/excursion_list">Back To Excursion List</a></li> 
										</ul>
									</form>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
</section>
<!-- sctipts -->
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>

<!--  Custom JavaScripts  -->
<script src="<?php echo base_url(); ?>public/js/main.js"></script>

<script type="text/javascript">
$('.todo').on('click', function(){
var data = $(this).val();
$('#todo').val(data);
var form = $('form');
form.parsley().validate();
if (!form.parsley().isValid()) {
return false;
}
});
</script>

<!-- Required for images upload -->
<script type = "text/javascript" src = "//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script>
<script type="text/javascript">
if (window.File && window.FileList && window.FileReader) {
  $(".imageupload").on('change', function () {
       var countFiles = $(this)[0].files.length;
       var imgPath = $(this)[0].value;
       var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
       var image_holder = $(this).parent().parent().find(".preview-image");
       image_holder.empty();

      var files = !!this.files ? this.files : [];
      if (!files.length || !window.FileReader) return false; // no file selected, or no FileReader support

       if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
           if (typeof (FileReader) != "undefined") {
   
               for (var i = 0; i < countFiles; i++) {
   
                   var reader = new FileReader();
                   reader.onload = function (e) {
                      var file = e.target;
                       $("<img />", { "src": e.target.result, "class": "thumbimage" }).appendTo(image_holder);
                   }
   
                   image_holder.show();
                   reader.readAsDataURL($(this)[0].files[i]);
               }
   
           } else {
               alert("It doesn't supports");
           }
       } else {
           alert("Select Only images");
       }
  });
} else {
  alert("Your browser doesn't support to File API")
}
</script>
<script>
jQuery(document).ready(function($) {
    var options = {
        beforeSend: function(){
            // Replace this with your loading gif image
            // alert(this);
            $(".messages").html('<p><img src = "<?php echo base_url() ?>public/images/load.gif" class = "loader" /></p>');
        },
        complete: function(response){
            // Output AJAX response to the div container
            $(".messages").html(response.responseText);
            $('html, body').animate({scrollTop: $(".messages").offset().top-100}, 150);
            
        }
    };  
    // Submit the form
    $(".upload-image-form").ajaxForm(options);  
    return false; 
});
</script>

<script>
$(".delete_img").on('click',function(e){
  var _parent = $(this).parent().parent().parent();
  var table_name = _parent.find('input[name="table_name"]').val();
  var unique_id_column = _parent.find('input[name="unique_id_column"]').val();
  e.preventDefault();
  var img_id = $(this).parent('.priv_div').attr('img_id');
  if (confirm('You are about to delete on saved image... Are you sure?')) {
    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>excursions/delete_img',
      data: 'img_id='+img_id+'&table_name='+table_name+'&unique_id_column='+unique_id_column,
      dataType: 'json',
      beforeSend: function(){
        _parent.find(".messages2").html('<p><img src = "<?php echo base_url() ?>public/images/load.gif" class = "loader" /></p>');
      },
      error: function(){
        _parent.find(".messages2").html('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>');
        document.location.reload();
      },
      complete: function(response){
        _parent.find(".messages2").html('<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>File Deleted Successfully.</div>');
            $('html, body').animate({scrollTop: _parent.find(".messages2").offset().top-100}, 150);
        document.location.reload();
      }
    });
  } else {
      return false;
  }
});
</script>