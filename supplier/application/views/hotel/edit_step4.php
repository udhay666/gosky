
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit <?php echo $hotel_details[0]->hotel_name;?> Hotel ( Code : <?php echo $hotel_details[0]->hotel_code;?>)<span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Hotels</a></li>
              <li><a class="active" href="<?php echo site_url() ?>hotel/edit_step4?id=<?php echo $hotel_id ?>">Edit Hotel</a></li>
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
        <?php
          $data['steps'] = '4';
          echo $this->load->view('hotel/steps', $data);
        ?>
        <div class="tab-content">      
            <input type="hidden" name="steps" value="4">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $hotel_id ?>">
            <div class="tab-pane active" id="step-4">
              <div class="row border_row min_height200">
                <div class="col-md-12">
                  <?php echo form_open_multipart('upload/do_upload', array('class' => 'upload-image-form'));?>
                  <label><strong>Thumbnail Image (jpg | png | gif)</strong></label><br>
                  <div class="messages"></div>
                  <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add image...</span>
                    <input type="file" accept="image/*" class="form-control imageupload" name="uploadfile[]" size="20" /><br/>
                  </span>
                  <input type="hidden" name="controller" value="hotel">
                  <input type="hidden" name="id" value="<?php echo $hotel_id ?>">
                  <input type="hidden" name="id_column" value="supplier_hotel_list_id">
                  <input type="hidden" name="table_name" value="supplier_hotel_list">
                  <input type="hidden" name="column_name" value="thumb_img">
                  <input type="hidden" name="img_type" value="thumbnail">
                  <input type="hidden" name="upload_type" value="update">
                  <input type="submit" name="submit" value="Upload" class="btn btn-primary" />
                  <div class="row2 preview-image">
                  <?php if(!empty($hotel_details[0]->thumb_img)){ ?>
                    <div class="priv_div" style="position:relative;display:inline-block">
                      <img src="<?php echo base_url().$hotel_details[0]->thumb_img; ?>" title="" class="thumbimage" />
                    </div>
                    <?php } ?>
                  </div>
                  <?php echo '</form>' ?>
                </div>
              </div>
              <div class="row border_row min_height200">
                <div class="col-md-12">
                  <label><strong>Gallery Image (jpg | png | gif)</strong></label><br>
                  <div class="messages2"></div>
                  <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add Multiple image...</span>
                    <input type="file" multiple="multiple" accept="image/*" class="form-control imageupload" name="uploadfile[]" /><br/>
                  </span>
            <input type="hidden" name="table_name" value="supplier_hotel_images">
                  <input name="submit" value="Upload" class="btn btn-primary upload_now" />
                  <div class="row2" style="margin-top: 15px">
                    <?php foreach($gallery_img as $gal) {
                        if($gal->img_type=='1'){
                     ?>
                    <div class="priv_div" style="position:relative;display:inline-block" img_id="<?php echo $gal->id ?>">
                      <img src="<?php echo base_url().$gal->gallery_img ?>" img_url="<?php echo $gal->gallery_img ?>" title="" class="thumbimage" /><i class="fa fa-close delete_img" style="color: #337ab7;"></i>
                    </div>
                    <?php }} ?>
                  </div>
                  <div class="row2 preview-image"></div>
                </div>
              </div>


              <div class="row border_row min_height200">
                <div class="col-md-12">
                  <label><strong>Food and Drink Gallery Image</strong></label><br>
                  <div class="messages2"></div>
                  <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add Multiple image...</span>
                    <input type="file" multiple="multiple" accept="image/*" class="form-control imageupload1" name="uploadfile1[]" /><br/>
                  </span>
            <input type="hidden" name="table_name" value="supplier_hotel_images">
                  <input name="submit" value="Upload" class="btn btn-primary upload_now1" />
                  <div class="row2" style="margin-top: 15px">
                    <?php foreach($gallery_img as $gal) {
                       if($gal->img_type=='2'){
                     ?>
                    <div class="priv_div" style="position:relative;display:inline-block" img_id="<?php echo $gal->id ?>">
                      <img src="<?php echo base_url().$gal->gallery_img ?>" img_url="<?php echo $gal->gallery_img ?>" title="" class="thumbimage" /><i class="fa fa-close delete_img" style="color: #337ab7;"></i>
                    </div>
                    <?php } } ?>
                  </div>
                  <div class="row2 preview-image1"></div>
                </div>
              </div>
              
              <ul class="pager wizard">
                <input id="todo" type="hidden" name="todo">
                <li class="next">
                 <!--  <button class="btn btn-success todo" value="1">Save and Continue</button> -->
                 <a  class="btn btn-success todo" class="active" href="<?php echo site_url() ?>hotel/edit_step5?id=<?php echo $hotel_id ?>">Go To Step 5</a>
                </li>
                <li class="first">
                 <!--  <button class="btn btn-success todo" value="0" style="float: right;margin-right: 20px">Save</button> -->
                </li>
              </ul>
            </div>
          <!-- </form> -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- sctipts -->
  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->


<!-- Image upload -->
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
                      // $('<div class="priv_div" style="position:relative;display:inline-block"><img src="'+e.target.result+'" title="'+file.name+'" class="thumbimage" /><i class="fa fa-close delete_img"></i></div>').appendTo(image_holder);
                      // $(".delete_img").click(function(){
                      //   countFiles -= 1;
                      //   $(this).parent(".priv_div").remove();
                      //   $('.imageupload').val(countFiles);
                      // });
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
   $(".imageupload1").on('change', function () {
       var countFiles = $(this)[0].files.length;
       var imgPath = $(this)[0].value;
       var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
       var image_holder = $(this).parent().parent().find(".preview-image1");
       image_holder.empty();

      var files = !!this.files ? this.files : [];
      if (!files.length || !window.FileReader) return false; // no file selected, or no FileReader support

       if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
           if (typeof (FileReader) != "undefined") {
   
               for (var i = 0; i < countFiles; i++) {
   
                   var reader = new FileReader();
                   reader.onload = function (e) {
                      var file = e.target;
                      // $('<div class="priv_div" style="position:relative;display:inline-block"><img src="'+e.target.result+'" title="'+file.name+'" class="thumbimage" /><i class="fa fa-close delete_img"></i></div>').appendTo(image_holder);
                      // $(".delete_img").click(function(){
                      //   countFiles -= 1;
                      //   $(this).parent(".priv_div").remove();
                      //   $('.imageupload').val(countFiles);
                      // });
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
$('.upload_now').on('click', function(){
    var _parent = $(this).parent();
    // var day_count = _parent.find('#day_count').val();
    var files = _parent.find('.imageupload').prop('files');
    var data = new FormData();
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        data.append('uploadfile[]', file, file.name);
    }
    data.append('controller', 'hotel');
    data.append('id', '<?php echo $hotel_id ?>');
    data.append('id_column', 'supplier_hotel_list_id');
    data.append('table_name', 'supplier_hotel_images');
    data.append('column_name', 'gallery_img');
    data.append('img_type', 'gallery');
    data.append('img_type1', '1');
    data.append('upload_type', 'edit');
    data.append('hotel_code', '<?php echo $hotel_details[0]->hotel_code; ?>');

    $.ajax({
        type: 'POST',               
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: data,
        url: '<?php echo site_url(); ?>hotel/do_upload_hotel_img',
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

$('.upload_now1').on('click', function(){
    var _parent = $(this).parent();
    // var day_count = _parent.find('#day_count').val();
    var files = _parent.find('.imageupload1').prop('files');
    var data = new FormData();
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        data.append('uploadfile[]', file, file.name);
    }
    data.append('controller', 'hotel');
    data.append('id', '<?php echo $hotel_id ?>');
    data.append('id_column', 'supplier_hotel_list_id');
    data.append('table_name', 'supplier_hotel_images');
    data.append('column_name', 'gallery_img');
    data.append('img_type', 'foodanddrink');
    data.append('img_type1', '2');
    data.append('upload_type', 'edit');
    data.append('hotel_code', '<?php echo $hotel_details[0]->hotel_code; ?>');

    $.ajax({
        type: 'POST',               
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: data,
        url: '<?php echo site_url(); ?>hotel/do_upload_hotel_img',
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
      url: '<?php echo site_url(); ?>hotel/delete_img',
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
  <script type="text/javascript">
  $(document).ready(function(e) {
    var $input = $('#refresh');  
    if($input.val() == 'yes'){
      location.reload(true);
    }else{
         $input.val('yes');
    }
  });
</script>