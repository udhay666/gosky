 <?php  if($prior_day_type=="prior_checkin") { ?>

  <input type="text" name="prior_checkin"  class="form-control Num"  placeholder="No of Prior Checkin Days" required="required"/> 
 <?php } if($prior_day_type=="prior_checkin_date"){ ?>
   <input type="text" name="prior_checkin_date"  class="form-control"  placeholder="Select Prior Booking Date" required="required"/>
     
  <?php } if($prior_day_type=="period") { ?>
      <label class="strong">Period : </label>
                 <div class="row" style="margin-left:1px;">
                <div class="form-group col-md-6">
                <input type="text" class="form-control period_selectdate"  id="period_from_date" name="period_from_date" placeholder="Select From Date" required="required">
                </div>
                 <div class="form-group col-md-6">
                 <input type="text" class="form-control period_selectdate"  id="period_to_date" name="period_to_date" placeholder="Select To Date" required="required">
               </div>
              </div>
 
      
<?php   }     ?>
<script type="text/javascript">
$(function() { 
 $('input[name="prior_checkin_date"]').daterangepicker({  
    autoUpdateInput: false,
    showDropdowns: false, 
    singleDatePicker: true, 
    daysOfWeek: [
            "Su",
            "Mo",
            "Tu",
            "We",
            "Th",
            "Fr",
            "Sa"
        ],
     monthNames: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ],  
      locale: {
          cancelLabel: 'Clear',
           format: 'DD-MM-YYYY'
      }
  });


  $('input[name="prior_checkin_date"]').on('apply.daterangepicker', function(ev, picker) {
      $('input[name="prior_checkin_date"]').val(picker.startDate.format('DD-MM-YYYY'));    
  });

  $('.period_selectdate').on('cancel.daterangepicker', function(ev, picker) {
       $('input[name="prior_checkin_date"]').val('');
    
  });

 $(".period_selectdate").daterangepicker({  
    autoUpdateInput: false,
    showDropdowns: true,  
    daysOfWeek: [
            "Su",
            "Mo",
            "Tu",
            "We",
            "Th",
            "Fr",
            "Sa"
        ],
     monthNames: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ],  
      locale: {
          cancelLabel: 'Clear',
           format: 'DD-MM-YYYY'
      }
  });


  $('.period_selectdate').on('apply.daterangepicker', function(ev, picker) {
      $('input[name="period_from_date"]').val(picker.startDate.format('DD-MM-YYYY'));
      $('input[name="period_to_date"]').val(picker.endDate.format('DD-MM-YYYY'));
  });

  $('.period_selectdate').on('cancel.daterangepicker', function(ev, picker) {
       $('input[name="period_from_date"]').val('');
      $('input[name="period_to_date"]').val('');
  });
});

</script>

