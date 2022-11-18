
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Add Rates <span></span></h2>
          <div class="page-bar br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Holidays</a></li>
              <li><a class="active" href="#">Add Rates</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <?php
      $acc_type = explode(',', $rates_info->accomodation_type);
      // echo '<pre>';print_r($currency);
    ?>
    <div class="pagecontent">
      <div class="row">
        <div class="col-md-12">
          <section class="bg-white repated_section">
            <form action="#" enctype="multipart/form-data" method="post">
              <input type="hidden" value="<?php echo $package_id ?>" name="package_id"/>
              <input type="hidden" name="hidden_i_prev" id="hidden_i_prev" value="0">
              <div id="rates_wrapper">
                <div class="add_remove text-right mb-5">
                  <div class="pull-left" style="font-size: 20px;font-weight: 700;"><?php echo $rates_info->holiday_name ?> ( <?php echo $rates_info->holiday_code ?> )</div>
                  <a class="btn btn-success add-field fa fa-plus"> Add</a>
                  <a class="btn btn-danger remove-field fa fa-times"> Remove</a>
                </div>
                <div id="rates_field_wrapper">
                  <section class="boxs repeat-field" id="rates_1">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font"># <span class="counter">1</span></h1>
                      <input type="hidden" name="counter" id="counter" value="1">
                      <ul class="controls custom_cntrl">
                        <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
                      </ul>
                    </div>
                    <div class="boxs-body">
                      <div class="row2">
                        <div class="table-responsive">
                          <table class="table table1" width="50%" style="width: 50%;">
                            <tr>
                              <td>
                                <label>Currency</label>
                                <select name="currency[]" class="form-control">
                                  <?php foreach($currency as $curr){ ?>
                                  <option value="<?php echo $curr->currency_id ?>"><?php echo $curr->currency_code ?></option>
                                  <?php } ?>
                                </select>
                              </td>
                              <td>
                                <label>Validaty Period (from and to)</label>
                                <input type="text" name="start_date[]" class="date_range form-control" placeholder="Start Date - End Date">
                                <input type="hidden" name="hidden_i" id="hidden_i" value="hidden_i">
                              </td>
                            </tr>
                          </table>
                          <table class="table table2">
                            <thead>
                              <tr class="active">
                                <th>Package Type</th>
                                <th>2 Adults</th>
                                <th>4 Adults</th>
                                <th>6 Adults</th>
                                <th>8 Adults</th>
                                <th>10 Adults</th>
                                <th>Single Suppliment</th>
                                <th>Triple Sharing</th>
                                <th>Child With Bed</th>
                                <th>Child Without Bed</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($acc_type as $acc) { ?>
                              <tr>
                                <td width="9%"><span><?php echo $acc ?></span><input type="hidden" value="<?php echo $acc ?>" name="package_type" class="form-control"/></td>
                                <td><input type="text" name="" value="0" class="form-control"></td>
                                <td><input type="text" name="" value="0" class="form-control"></td>
                                <td><input type="text" name="" value="0" class="form-control"></td>
                                <td><input type="text" name="" value="0" class="form-control"></td>
                                <td><input type="text" name="" value="0" class="form-control"></td>
                                <td><input type="text" name="" value="0" class="form-control"></td>
                                <td><input type="text" name="" value="0" class="form-control"></td>
                                <td><input type="text" name="" value="0" class="form-control"></td>
                                <td><input type="text" name="" value="0" class="form-control"></td>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
                <div class="col-md-offset-11">
                  <button type="submit" class="btn btn-ef btn-ef-1 btn-ef-1-primary btn-ef-1a">Update</button>
                </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>

<script src="<?php echo base_url(); ?>public/js/main.js"></script>

<script type="text/javascript">
jQuery(function($) {
  var cloneCount = 2;
  $("#rates_wrapper").each(function() {
    // e.preventDefault();
    var $wrapper = $('#rates_field_wrapper', this);
    $(".add-field", $(this)).click(function(e){
      var clone = $('#rates_1:first').clone(true).attr('id', 'rates_1'+ cloneCount++).insertAfter($('[id^=rates_1]:last'));

      clone.find('input[type="text"]').val('0');
      clone.find('.counter').html((cloneCount-1));
      clone.find('#counter').val((cloneCount-1));
      // clone.find('.date_range').val('Start Date - End Date');

      clone.find(".date_range").each(function() {
        $(this).attr("id", "").removeData().off();
        $(this).find('.add-on').removeData().off();
        $(this).find('input').removeData().off();
        $(this).daterangepicker({
          autoApply: true,
          stepMonths: false,
          timePickerIncrement: 30,
          locale: {
              format: 'DD/MM/YYYY'
          }
        });
      });

    });
    $('.remove-field', $(this)).click(function(e) {
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#rates_1'+cloneCount).remove();
      }
    });
  }); 
});
</script>
<script type="text/javascript"> 
$(function() {
  var dateToday = new Date();
  $('.date_range').daterangepicker({
    minDate: dateToday,
    autoApply: true,
    stepMonths: false,
    timePickerIncrement: 30,
    locale: {
        format: 'DD/MM/YYYY'
    }
  });
  // $('.date_range').val('Start Date - End Date');
});
</script>