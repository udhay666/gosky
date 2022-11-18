<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">

<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">

<!-- <base href="<?php echo base_url(); ?>"> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit Packages <span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Holidays</a></li>
              <li><a class="active" href="#">Edit Holiday</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <?php 
    $sess_msg = $this->session->flashdata('message');
    if(!empty($sess_msg)){
      $message = $sess_msg;
      $class = 'success';
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
    <!-- page content -->
    <div class="pagecontent">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <ul class="wizard_steps nav nav-pills">
          <li><a href="<?php echo site_url() ?>holiday/edit_holiday?id=<?php echo $package_id ?>"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>Basic Package Info</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step2?id=<?php echo $package_id ?>"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Overview/Highlights</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step3?id=<?php echo $package_id ?>"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Itinerary</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step4?id=<?php echo $package_id ?>"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Includes/Excludes</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step5?id=<?php echo $package_id ?>"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Important Info</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step6?id=<?php echo $package_id ?>"><span class="step_no wizard-step">6</span><span class="step_descr">Step 6<br><small>Routing(Map)</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step7?id=<?php echo $package_id ?>"><span class="step_no wizard-step">7</span><span class="step_descr">Step 7<br><small>Activities(Optional)</small></span></a></li>
          <li class="active"><a href="<?php echo site_url() ?>holiday/edit_step8?id=<?php echo $package_id ?>"><span class="step_no wizard-step">8</span><span class="step_descr">Step 8<br><small>Attraction(Optional)</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step9?id=<?php echo $package_id ?>"><span class="step_no wizard-step">9</span><span class="step_descr">Step 9<br><small>Images(Preview &amp; Save)</small></span></a></li>
        </ul>
        <div class="tab-content">
          <form action="<?php echo site_url() ?>holiday/update_all" method="post" class="step_form step8" steps="8" name="step8" method="POST" enctype="multipart/form-data" role="form" novalidate>
            <input type="hidden" name="steps" value="8">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $package_id ?>">
            <div class="tab-pane active" id="step-8">
              <div id="attraction_wrapper">
                <div class="add_remove text-right mb-5">
                  <a class="btn btn-success add-field fa fa-plus"> Add</a>
                  <a class="btn btn-danger remove-field fa fa-times"> Remove</a>
                </div>
                <?php if(!empty($holiday_attraction)) { ?>
                <div id="attraction_field_wrapper">
                  <?php for($i=0;$i<count($holiday_attraction);$i++) { ?>
                  <section class="boxs repeat-field" id="attraction_<?php echo $i+1 ?>">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font">Attraction <span class="attraction_count"><?php echo $i+1 ?></span></h1>
                      <input type="hidden" name="attraction_count" id="attraction_count" value="<?php echo $i+1 ?>">
                      <ul class="controls custom_cntrl">
                        <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
                      </ul>
                    </div>
                    <div class="boxs-body">
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Attraction Name</label>
                          <input type="text" name="attraction_name[]" value="<?php echo $holiday_attraction[$i]->attraction_name ?>" class="form-control">
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-12">
                          <label class="strong">Description</label>
                          <textarea name="attraction_description[]" id="attraction_description" class="form-control ckeditor" rows="3" cols="100"><?php echo $holiday_attraction[$i]->attraction_description ?></textarea>
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Adult Cost</label>
                          <input type="text" name="attraction_adult_cost[]" value="<?php echo $holiday_attraction[$i]->attraction_adult_cost ?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Child Cost(Below 12 years)</label>
                          <input type="text" name="attraction_child_cost[]" value="<?php echo $holiday_attraction[$i]->attraction_child_cost ?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Family Cost(2 Adults + 2 Children)</label>
                          <input type="text" name="attraction_family_cost[]" value="<?php echo $holiday_attraction[$i]->attraction_family_cost ?>" class="form-control">
                        </div>
                      </div>
                      <div class="row border_row min_height200">
                        <div class="col-md-12">
                          <label><strong>Gallery Image</strong></label><br>
                          <div class="messages2"></div>
                          <span class="btn btn-success fileinput-button">
                              <i class="glyphicon glyphicon-plus"></i>
                              <span>Add Multiple image...</span>
                              <input type="file" multiple="multiple" accept="image/*" class="form-control imageupload" name="uploadfile[]" /><br/>
                          </span>
                          <input type="hidden" name="table_name" value="holiday_attraction_images">
                          <input name="submit" value="Upload" class="btn btn-primary upload_now" />
                          <div class="row2 remove_in_colne" style="margin-top: 15px">
                            <?php foreach($gallery_img as $gal) { ?>
                            <?php if($gal->day_count==$i+1){  ?>
                            <div class="priv_div" style="position:relative;display:inline-block" img_id="<?php echo $gal->id ?>">
                              <img src="<?php echo base_url().$gal->gallery_img ?>" img_url="<?php echo $gal->gallery_img ?>" title="" class="thumbimage" /><i class="fa fa-close delete_img"></i>
                            </div>
                            <?php } ?>
                            <?php } ?>
                          </div>
                          <div class="row2 preview-image"></div>
                        </div>
                      </div>
                    </div>
                  </section>
                  <?php } ?>
                </div>
                <?php } else { ?>
                <div id="attraction_field_wrapper">
                  <section class="boxs repeat-field" id="attraction_1">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font">Attraction <span class="attraction_count">1</span></h1>
                      <input type="hidden" name="attraction_count" id="attraction_count" value="1">
                      <ul class="controls custom_cntrl">
                        <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
                      </ul>
                    </div>
                    <div class="boxs-body">
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Attraction Name</label>
                          <input type="text" name="attraction_name[]" value="" class="form-control">
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-12">
                          <label class="strong">Description</label>
                          <textarea name="attraction_description[]" id="attraction_description" class="form-control ckeditor" rows="3" cols="100"></textarea>
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Child Cost</label>
                          <input type="text" name="attraction_child_cost[]" value="" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Adult Cost</label>
                          <input type="text" name="attraction_adult_cost[]" value="" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Family Cost</label>
                          <input type="text" name="attraction_family_cost[]" value="" class="form-control">
                        </div>
                      </div>
                      <div class="row border_row min_height200">
                        <div class="col-md-12">
                          <label><strong>Gallery Image</strong></label><br>
                          <div class="messages2"></div>
                          <span class="btn btn-success fileinput-button">
                              <i class="glyphicon glyphicon-plus"></i>
                              <span>Add Multiple image...</span>
                              <input type="file" multiple="multiple" accept="image/*" class="form-control imageupload" name="uploadfile[]" /><br/>
                          </span>
                          <input type="hidden" name="table_name" value="holiday_attraction_images">
                          <input name="submit" value="Upload" class="btn btn-primary upload_now" />
                          <div class="row2 preview-image"></div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
                <?php } ?>
              </div>
            </div>
            <ul class="pager wizard">
              <li class="next finish">
                <button type="submit" class="btn btn-success">Update</button>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- sctipts -->
  <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>

  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/wysihtml5-0.3.0.min.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/bootstrap-wysihtml5.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/adapters/jquery.js"></script>

  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->

<!--  Page Specific Scripts  --> 
<script type="text/javascript">
  var cloneCount = '<?php echo $total_actr+1 ?>';
</script>
<script type="text/javascript">
jQuery(function($) {
  $("#attraction_wrapper").each(function() {
    var $wrapper = $('#attraction_field_wrapper', this);
    $(".add-field", $(this)).on('click', function(e){
      e.preventDefault();
      var dy = 'attraction_'+(cloneCount-1);
      // alert(dy);
      // alert(cloneCount);
      var clone = $('#'+dy).clone(true).attr('id', 'attraction_'+cloneCount++).insertAfter($('[id^='+dy+']'));

      clone.find('textarea').val('');
      clone.find('.remove_in_colne').remove();
      clone.find('.attraction_count').html((cloneCount-1));
      clone.find('#attraction_count').val((cloneCount-1));
      clone.find('textarea.ckeditor').attr('id', 'attraction_description'+(cloneCount-1));

      var editor = CKEDITOR.instances[name];
      if (editor) { editor.destroy(true); }
      CKEDITOR.replace('attraction_description'+(cloneCount-1));

      $(this).parent().parent().find('#attraction_'+(cloneCount-1)).find('#cke_attraction_description').css('display', 'none');
      $(this).parent().parent().find('#attraction_'+(cloneCount-1)).find('#cke_attraction_description'+(cloneCount-2)).css('display', 'none');

    });
    $('.remove-field', $(this)).on('click',function(e) {
      e.preventDefault();
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#attraction_'+cloneCount).remove();
      }
    });
  }); 
});
</script>
<!--/ Page Specific Scripts -->
<script type="text/javascript">
if (window.File && window.FileList && window.FileReader) {
  $(".imageupload").on('change', function () {
       var countFiles = $(this)[0].files.length;
       var imgPath = $(this)[0].value;
       var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
       var image_holder = $(this).parent().parent().find(".preview-image");
       image_holder.empty();

      var files = !!this.files ? this.files : [];
      if (!files.length || !window.FileReader) return false;

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
$('.upload_now').on('click', function(){
    var _parent = $(this).parent().parent().parent().parent();
    var day_count = _parent.find('.attraction_count').html();
    var files = _parent.find('.imageupload').prop('files');
    var data = new FormData();
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        data.append('uploadfile[]', file, file.name);
    }
    data.append('controller', 'holiday');
    data.append('id', '<?php echo $package_id ?>');
    data.append('id_column', 'package_id');
    data.append('table_name', 'holiday_attraction_images');
    data.append('column_name', 'gallery_img');
    data.append('img_type', 'gallery');
    data.append('upload_type', 'edit');
    data.append('day_count', day_count);

    $.ajax({
        type: 'POST',               
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: data,
        url: '<?php echo site_url(); ?>upload/do_upload',
        dataType : 'json',
        beforeSend: function(){
          _parent.find(".messages2").html('<p><img src = "<?php echo base_url() ?>public/images/load.gif" class = "loader" /></p>');
        },
        complete: function(response){
            _parent.find(".messages2").html(response.responseText);
            $('html, body').animate({scrollTop: _parent.find(".messages2").offset().top-100}, 150);
            document.location.reload();
        }
    }); 
});

$(".delete_img").on('click',function(e){
  var _parent = $(this).parent().parent().parent();
  var table_name = _parent.find('input[name="table_name"]').val();
  var img_url = $(this).parent().find('img').attr('img_url');
  e.preventDefault();
  var img_id = $(this).parent('.priv_div').attr('img_id');
  if (confirm('You are about to delete on saved image... Are you sure?')) {
    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>holiday/delete_img',
      data: 'img_id='+img_id+'&table_name='+table_name+'&img_url='+img_url,
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