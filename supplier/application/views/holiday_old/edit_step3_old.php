<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">

<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<section id="content">
  <div class="tab-content">
          <form action="<?php echo site_url() ?>holiday/update_all" method="post" class="step_form step3" steps="3" name="step3" method="POST" enctype="multipart/form-data" role="form" novalidate>
            <input type="hidden" name="steps" value="3">
            <input type="hidden" name="activity_code" value="<?php echo $package_info->package_code ?>">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $package_id ?>">
            <div class="tab-pane active" id="step-3">
              <div id="activity_wrapper">
                <div class="add_remove text-right mb-5">
                  <a class="btn btn-success add-field fa fa-plus"> Add</a>
                  <a class="btn btn-danger remove-field fa fa-times"> Remove</a>
                  <span class="i_outtext btn btn-red fa fa-minus" id="i_outtext"> Collapse All</span>
                </div>
                <?php if(!empty($holiday_activity)) { ?>
                <div id="activity_field_wrapper">
                  <?php for($i=0;$i<count($holiday_activity);$i++) { ?>
                  <section class="boxs repeat-field" id="activity_<?php echo $i+1 ?>">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font">Activity <span class="activity_count"><?php echo $i+1 ?></span></h1>
                      <input type="hidden" name="activity_count" id="activity_count" value="<?php echo $i+1 ?>">
                      <ul class="controls custom_cntrl">
                        <li>
                          <a role="button" tabindex="0" class="boxs-toggle">
                            <span class="minimize"><i class="fa fa-minus"></i></span>
                            <span class="expand"><i class="fa fa-plus"></i></span>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="boxs-body">
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Activity Title</label>
                          <input type="text" name="activity_name[]" value="<?php echo $holiday_activity[$i]->activity_title ?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Opening/Operating Hours</label>
                          <input type="text" name="operating_hours[]" class="form-control" value="<?php echo $holiday_activity[$i]->operating_hours ?>">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Duration</label>
                          <input type="text" name="duration[]" class="form-control" value="<?php echo $holiday_activity[$i]->duration ?>">
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Activity Location</label>
                          <input type="text" name="pickup_location[]" class="form-control" value="<?php echo $holiday_activity[$i]->pickup_location ?>">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Pickup Time</label>
                          <input type="text" name="pickup_time[]" class="form-control" value="<?php echo $holiday_activity[$i]->pickup_time ?>">
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-12">
                          <label class="strong">Short Description</label>
                          <textarea name="activity_description[]" id="activity_description<?php echo $i+1 ?>" class="form-control" rows="3" cols="100"><?php echo $holiday_activity[$i]->activity_desc ?></textarea>
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-12">
                          <label class="strong">Cancellation Policy</label>
                          <!-- <textarea name="cancel_policy[]" id="cancel_policy<?php //echo $i+1 ?>" class="form-control ckeditor" rows="3" cols="100"><?php //echo $holiday_activity[$i]->cancel_policy ?></textarea> -->
                          <textarea name="cancel_policy[]" class="form-control" rows="3" cols="100"><?php echo $holiday_activity[$i]->cancel_policy ?></textarea>
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Package Price/Adult</label>
                          <input type="text" name="activity_adult_cost[]" value="<?php echo $holiday_activity[$i]->price_adt ?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Package Price/Child</label>
                          <input type="text" name="activity_child_cost[]" value="<?php echo $holiday_activity[$i]->price_chd ?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Package Price/Senior</label>
                          <input type="text" name="activity_senior_cost[]" value="<?php echo $holiday_activity[$i]->price_sen ?>" class="form-control">
                        </div>
                      </div>
                    </div>
                  </section>
                  <?php } ?>
                </div>
                <?php } else { ?>
                <div id="activity_field_wrapper">
                  <section class="boxs repeat-field" id="activity_1">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font">Activity <span class="activity_count">1</span></h1>
                      <input type="hidden" name="activity_count" id="activity_count" value="1">
                      <ul class="controls custom_cntrl">
                        <li>
                          <a role="button" tabindex="0" class="boxs-toggle">
                            <span class="minimize"><i class="fa fa-minus"></i></span>
                            <span class="expand"><i class="fa fa-plus"></i></span>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="boxs-body">
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Activity Title</label>
                          <input type="text" name="activity_name[]" value="" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Operating Hours</label>
                          <input type="text" name="operating_hours[]" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Duration</label>
                          <input type="text" name="duration[]" class="form-control">
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Activity Location</label>
                          <input type="text" name="pickup_location[]" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Pickup Time</label>
                          <input type="text" name="pickup_time[]" class="form-control">
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Package Price/Adult</label>
                          <input type="text" name="activity_adult_cost[]" value="" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Package Price/Child</label>
                          <input type="text" name="activity_child_cost[]" value="" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Package Price/Senior</label>
                          <input type="text" name="activity_senior_cost[]" value="" class="form-control">
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-12">
                          <label class="strong">Description</label>
                          <textarea name="activity_description[]" id="activity_description" class="form-control" rows="3" cols="100"></textarea>
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-12">
                          <label class="strong">Cancellation Policy</label>
                          <textarea name="cancel_policy[]" id="cancel_policy" class="form-control" rows="3" cols="100"></textarea>
                        </div>
                      </div>
                      
                    </div>
                  </section>
                </div>
                <?php } ?>
              </div>
            </div>
            <ul class="pager wizard">
              <input id="todo" type="hidden" name="todo">
              <li class="next">
                <button class="btn btn-success todo" value="1">Save and Continue</button>
              </li>
              <li class="first">
                <button class="btn btn-success todo" value="0" style="float: right;margin-right: 20px;">Save</button>
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
  var cloneCount = '<?php echo $total_iti+1 ?>';
</script>
<script type="text/javascript">
jQuery(function($) {
  $("#itinerary_wrapper").each(function() {
    var $wrapper = $('#itinerary_field_wrapper', this);
    $(".add-field", $(this)).on('click', function(e){
      e.preventDefault();
      var dy = 'itinerary_'+(cloneCount-1);
      // alert(dy);
      // alert(cloneCount);
      var clone = $('#'+dy).clone(true).attr('id', 'itinerary_'+cloneCount++).insertAfter($('[id^='+dy+']'));

      clone.find('textarea').val('');
      // clone.find('.remove_in_colne').remove();
      clone.find('.day_count').html((cloneCount-1));
      clone.find('#day_count').val((cloneCount-1));
      clone.find('textarea.ckeditor').attr('id', 'itinerary_description'+(cloneCount-1));

      var editor = CKEDITOR.instances[name];
      if (editor) { editor.destroy(true); }
      CKEDITOR.replace('itinerary_description'+(cloneCount-1));

      $(this).parent().parent().find('#itinerary_'+(cloneCount-1)).find('#cke_itinerary_description').css('display', 'none');
      $(this).parent().parent().find('#itinerary_'+(cloneCount-1)).find('#cke_itinerary_description'+(cloneCount-2)).css('display', 'none');

      clone.find('.itinerary_destination_1').find('.checkbox-custom2').find('input').attr('name', 'itinerary_destination_'+(cloneCount-1)+'[]');
      clone.find('.itinerary_meals_1').find('.checkbox-custom2').find('input').attr('name', 'itinerary_meals_'+(cloneCount-1)+'[]');

    });
    $('.remove-field', $(this)).on('click',function(e) {
      e.preventDefault();
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#itinerary_'+cloneCount).remove();
      }
    });
  }); 
});
</script>
<!--/ Page Specific Scripts -->
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
    var day_count = _parent.find('#day_count').val();
    var files = _parent.find('.imageupload').prop('files');
    var data = new FormData();
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        data.append('uploadfile[]', file, file.name);
    }
    data.append('controller', 'holiday');
    data.append('id', '<?php echo $package_id ?>');
    data.append('id_column', 'package_id');
    data.append('table_name', 'holiday_itinerary_images');
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
          _parent.find(".messages2").html('<p><img src="<?php echo base_url() ?>public/images/load.gif" class = "loader" /></p>');
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
  // alert(img_url);
  // return false;
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