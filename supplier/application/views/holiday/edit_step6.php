<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/nestable/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Update Holiday <span></span></h2>
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
          <li><a href="<?php echo site_url() ?>holiday/edit_holiday?id=<?php echo $package_id ?>"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>Basic Tour Info</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step2?id=<?php echo $package_id ?>"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Overview/Highlights</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step3?id=<?php echo $package_id ?>"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Activities</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step4?id=<?php echo $package_id ?>"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Includes/Excludes</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step5?id=<?php echo $package_id ?>"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Important Info</small></span></a></li>
          <li class="active"><a href="<?php echo site_url() ?>holiday/edit_step6?id=<?php echo $package_id ?>"><span class="step_no wizard-step">6</span><span class="step_descr">Step 6<br><small>Meeting Points</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step7?id=<?php echo $package_id ?>"><span class="step_no wizard-step">7</span><span class="step_descr">Step 7<br><small>Images(Preview &amp; Save)</small></span></a></li>
          
        </ul>
        <div class="tab-content">
          <form action="<?php echo site_url() ?>holiday/update_all" method="post"  class="step_form step6" steps="6" name="step6" role="form" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="steps" value="6">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $package_id ?>">
            <div class="tab-pane active" id="step-6">
              <div class="row">
              <div id="clone_wrapper">
                  <div class="add_remove text-right mb-5">
                  <a class="btn btn-success add-field fa fa-plus"> Add</a>
                  <a class="btn btn-danger remove-field fa fa-times"> Remove</a>
                  <span class="i_outtext btn btn-red fa fa-minus" id="i_outtext"> Collapse All</span>
                </div>
                  <?php if(!empty($meeting_points)) { ?>
                <div id="clone_field_wrapper">
                  <?php for($i=0;$i<count($meeting_points);$i++) { ?>
                  <section class="boxs repeat-field" id="clone_field_<?php echo $i+1 ?>">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font">Meeting Points <span class="clone_count"><?php echo $i+1 ?></span></h1>
                      <input type="hidden" name="clone_count" id="clone_count" value="<?php echo $i+1 ?>">
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
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="control-label">Pickup Point *</label>
                            <input type="text" class="set_location form-control required" id="jq_from_loc<?php echo ($i+1)?>" name="pickup_location[]" value="<?php if(isset($meeting_points[$i]->pickup_location)) echo $meeting_points[$i]->pickup_location ?>" data-index="<?php echo ($i+1)?>" required>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="control-label">Pickup Type *</label>
                            <input class="form-control required" name="pickup_type[]" type="text" value="<?php echo $meeting_points[$i]->pickup_type ?>" required>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="control-label">Latitude *</label>
                            <input type="text" class="set_latitude form-control required" value="<?php echo $meeting_points[$i]->latitude ?>" name="latitude[]" id="jq_from_lat<?php echo ($i+1)?>" required>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="control-label">Longitude *</label>
                            <input type="text" class="set_longitude form-control required" value="<?php echo $meeting_points[$i]->longitude ?>" name="longitude[]" id="jq_from_long<?php echo ($i+1)?>" required>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                  <?php } ?>
                </div>
              <?php } else { ?>
                <div id="clone_field_wrapper">
                  <section class="boxs repeat-field" id="clone_field_1">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font">Meeting Points <span class="clone_count">1</span></h1>
                      <input type="hidden" name="clone_count" id="clone_count" value="1">
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
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="control-label">Pickup Point *</label>
                            <input type="text" class="set_location form-control required" id="jq_from_loc1"  name="pickup_location[]" data-index="<?php echo ($i+1)?>" value="" required>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="control-label">Pickup Type *</label>
                            <input class="form-control required" name="pickup_type[]" type="text" required>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="control-label">Latitude *</label>
                            <input type="text" class="set_latitude form-control required" name="latitude[]" id="jq_from_lat1" required>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="control-label">Longitude *</label>
                            <input type="text" class="set_longitude form-control required" name="longitude[]" id="jq_from_long1" required>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
                <?php } ?>
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
        <div class="row2">
          <?php if(!empty($meeting_points)){ ?>
          <div id="controls-polyline" style="display: none"></div>
          <div id="gmap-list" style="height:250px;margin-top: 20px;"></div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- sctipts -->
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/nestable/jquery.nestable.js"></script> 
<script src="<?php echo base_url(); ?>public/js/main.js"></script>


<script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyADPfKkRh8XYqiV5gPIzPW1CdXAbR7l9gE&libraries=places"></script>
<script src="<?php echo base_url(); ?>public/js/locationpicker.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/maplace.min.js"></script>
<!--  Custom JavaScripts  --> 
<script src="<?php echo base_url(); ?>public/js/main.js"></script>

<script type="text/javascript">
$(window).load(function(){
  var updateOutput = function(e) {
    var list = e.length ? e : $(e.target), output = list.data('output');
    // if (window.JSON) {
    //   output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
    // } else {
    //   output.val('JSON browser support required.');
    // }
    $.ajax({
      method: "POST",
      url: "<?php echo site_url() ?>holiday/order_location",
      data: {list: list.nestable('serialize')},
      dataType: 'json',
      success: function(data) {
        // console.log(data.insert_id);
        $("#output").html(data.location);
      }
    }).fail(function(jqXHR, textStatus, errorThrown){
        alert("Unable to save new list order: " + errorThrown);
    });
  };

  // activate Nestable for list 1
  $('#nestable').nestable({
    group: 1
  }).on('change', updateOutput);

  // output initial serialised data
  // updateOutput($('#nestable').data('output', $('#nestable-output')));
  // updateOutput($('#nestable').data('output', $('#output')));
});
</script> 
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

<?php if(!empty($meeting_points)){ ?>
<script type="text/javascript">
  var LocsD = [
    <?php for($j=0;$j<count($meeting_points);$j++){ ?>
    {
      lat: '<?php echo $meeting_points[$j]->latitude; ?>',
      lon: '<?php echo $meeting_points[$j]->longitude; ?>',
      title: '<?php echo $meeting_points[$j]->pickup_location; ?>',
      html: '<div style="max-width:200px;min-height:20px;"><b>'+'<?php echo $meeting_points[$j]->pickup_type.'</b><br>'.$meeting_points[$j]->pickup_location; ?>'+'</div>',
      icon:'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld='+'<?php echo $j+1 ?>'+'|f75c50|000000',
      stopover: true,
      // zoom: 1
    },
    <?php } ?>
  ];

  displayMap(LocsD);

  function displayMap(LocsD) {
      new Maplace({
        map_div:'#gmap-list',
        controls_on_map: false,
        locations: LocsD,
        controls_div: '#controls-polyline',
        controls_type: 'list',
        view_all_text: 'Start',
        map_options: {
          zoom: 5,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
        },
        type: 'polyline'
      }).Load(); 
  }
</script>
<?php } ?>

<script type="text/javascript">
  var cloneCount = '<?php echo $total_points+1 ?>';
</script>
<script type="text/javascript">
jQuery(function($) {
  $("#clone_wrapper").each(function() {
    var $wrapper = $('#clone_field_wrapper', this);
    $(".add-field", $(this)).on('click', function(e){
      e.preventDefault();
      var dy = 'clone_field_'+(cloneCount-1);
      // alert(dy);
      // alert(cloneCount);
      var clone = $('#'+dy).clone(true).attr('id', 'clone_field_'+cloneCount++).insertAfter($('[id^='+dy+']'));

      clone.find('input').val('');
      // clone.find('.remove_in_colne').remove();
      clone.find('.clone_count').html((cloneCount-1));
      clone.find('#clone_count').val((cloneCount-1));

      clone.find('.set_latitude').attr('id', 'jq_from_lat'+(cloneCount-1));
      clone.find('.set_longitude').attr('id', 'jq_from_long'+(cloneCount-1));

      clone.find('.set_location').attr('id', 'jq_from_loc'+(cloneCount-1));
      clone.find('.set_location').attr('data-index', (cloneCount-1));

    });
    $('.remove-field', $(this)).on('click',function(e) {
      e.preventDefault();
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#clone_field_'+cloneCount).remove();
      }
    });
  }); 
});
</script>
<script type="text/javascript">
function show_map(index){
  console.log(index);
  var places = new google.maps.places.Autocomplete(document.getElementById('jq_from_loc'+index));
  google.maps.event.addListener(places, 'place_changed', function () {
    var place = places.getPlace();
    var address = place.formatted_address;
    var latitude = place.geometry.location.lat();
    var longitude = place.geometry.location.lng();
    $('#jq_from_lat'+index).val(latitude);
    $('#jq_from_long'+index).val(longitude);
  });     
};

$(document).on('click', '.set_location', function(){
  var slno = $(this).attr('data-index');
  function initialize() { };
  google.maps.event.addDomListener(window, 'load', initialize);
  show_map(slno);
});
</script>

<script type="text/javascript">
$(".i_outtext").on('click', function(e){
  var _text = $(this).html();
  var _parent = $(this).parent().parent();
  // alert(_text);
  if(_text == ' Collapse All') {
    _parent.find('i.fa-minus').toggleClass('fa-minus fa-plus');
    $(this).html(' Expand All');
    $(this).removeClass('fa-minus');
    $(this).addClass('fa-plus');
    _parent.find('.boxs-body').hide('slow');
    // return false;
  }
  if(_text == ' Expand All'){
    _parent.find('i.fa-plus').toggleClass('fa-plus fa-minus');
    $(this).html(' Collapse All');
    $(this).removeClass('fa-plus');
    $(this).addClass('fa-minus');
    _parent.find('.boxs-body').show('slow');
    // return false;
  }
  
  // e.stopPropagation();
  e.preventDefault();
});
</script>

<!--/ custom javascripts -->
<script type="text/javascript">
$('.todo').on('click', function(){
  var data = $(this).val();
  $('#todo').val(data);
});
</script>