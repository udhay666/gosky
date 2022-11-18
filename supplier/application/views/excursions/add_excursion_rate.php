<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<script type="text/javascript">
  var site_url='<?php echo site_url();?>';
  var base_url='<?php echo base_url();?>';  
</script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <div class="page-bar br-5">
            <div class="form-group">
              <ul class="page-breadcrumb">
                <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a href="">Manage Excursion Rates</a></li>
                <li><a class="active" href="<?php echo site_url()?>excursions/add_excursion_rate/<?php echo $excursions_rate_types_id;?>/<?php echo $excursion_id;?>">Add Excursion Rates</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font">Add Excursion Rates</h1>
            <ul class="controls">              
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>
          <div class="boxs-body">  
           <div class="row"> 
             <div class="form-group col-md-12">
               <?php if($message==TRUE) 
               {
                echo '<div class="alert alert-success">';
                echo '<a class="close" data-dismiss="alert">×</a>';
                echo '<strong>Well done!</strong> new Excursion Rates added with success.';
                echo '</div>';       
              }
              ?>
            </div>
          </div> 
          <form data-action="<?php echo 'excursions/add_excursion_rate/'.$excursions_rate_types_id.'/'.$excursion_id?>" >   
            <div class="row">  
              <div class="form-group col-md-6">
                <label class="strong">Excursion Name: </label>
                <?php echo $excursion_info[0]->excursion_name; ?>
              </div>              
              <div class="form-group col-md-6">
                <label class="strong">Excursion Rate Type: </label>
                <?php echo $rate_types[0]->rate_types_name; ?>
              </div>              
            </div>
            <div class="row">  
              <div class="form-group col-md-6">
                <label class="strong">Period : </label>
                <div class="row" style="margin-left:1px;"> 
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control selectdate" id="from_date" name="from_date" placeholder="Select From Date" required="required">
                  </div>
                  <div class="form-group col-md-6">
                   <input type="text" class="form-control selectdate" id="to_date" name="to_date" placeholder="Select To Date" required="required">
                 </div>
               </div>
             </div>  
             <div class="form-group col-md-3">
              <label class="strong">Available Booking</label>
              <input type="text" name="available_booking" id="available_booking"  class="form-control Num" placeholder="Available Booking" required="required"/>
            </div>
            <div class="form-group col-md-3">
              <label class="strong">Price(Per Adult):</label> 
              <input type="text"  name="adult_price" id="adult_price" placeholder="Adult Price" class="form-control deciNum checkzero" required="required"/>
            </div>
          </div>
          <div class="row border_row">
            <div class="form-group col-md-12">
              <label class="strong">Price(Per Child):</label> 
            </div>
          </div>
          <div class="row border_row">
            <?php $child_age_range_and_height=json_decode($excursion_info[0]->child_age_range_and_height,true); 
            $i=1;
            if(!empty($child_age_range_and_height[0])){
              foreach ($child_age_range_and_height as $key => $value) { 
                $val=explode('||', $value);
                $val1=explode('-', $val[0]);
                $val2=explode('-', $val[1]);
                ?>
                <div class="form-group col-md-3">
                  <label class="strong">Child Age( <?php echo $val1[0].' - '.$val1[1];?> ) 
                    <br/>Height( <?php echo $val2[0].' Cm  - '.$val2[1];?> Cm )</label>
                    <input type="text" name="child_price[]"  placeholder="Child Rates"  class="form-control deciNum checkzero" required="required" />
                  </div>
                  <?php  }} else { ?>
                  <div class="form-group col-md-3">
                    <label class="strong">Child Age( 0 -12 ) 
                    <br/>Height( 20 - 140 Cm )</label>
                      <input type="text" name="child_price[]"  placeholder="Child Rates"  class="form-control deciNum checkzero" required="required" />
                    </div>
                    <?php } ?>
                  </div>
                  <div class="row border_row">
                    <div class="form-group col-md-12"  align="center" style="padding-top: 23px;">
                     <input type="hidden" name="excursion_code" value="<?php echo $excursion_info[0]->excursion_code; ?>"/>
                     <input type="hidden" name="excursion_id" value="<?php echo $excursion_id; ?>"/>
                      <input type="hidden" name="excursions_rate_types_id" value="<?php echo $excursions_rate_types_id; ?>"/>
                    <input  class="btn btn-success" type="button"  onclick="add_rates(this);" value="Add Rates" /><a href="<?php echo site_url()?>excursions/excursion_rate_type_list?id=<?php echo $excursion_id; ?>" class="btn btn-primary">Back</a>
                   </div> 
                 </div> 
               </form>          
             </div>
           </section>
         </div>
       </div>
     </div>
   </section>
   <?php echo $this->load->view('data_tables_js'); ?>
   <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
   <script src="<?php echo base_url(); ?>public/js/main.js"></script>
   <script src="<?php echo base_url(); ?>public/js/vendor/custom/excursioncustomize.js"></script>
   <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
   <script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
   <script>
    $(document).ready(function() {
      $(".select2").select2({});  
    });
  </script>
  <script type="text/javascript"> 
    $(function() { 
     var dateToday = new Date();
     $('.selectdate').daterangepicker({  
      autoUpdateInput: false,
      showDropdowns: true,
      "minDate": dateToday,
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
     $('.selectdate').on('apply.daterangepicker', function(ev, picker) {
      $('input[name="from_date"]').val(picker.startDate.format('DD-MM-YYYY'));
      $('input[name="to_date"]').val(picker.endDate.format('DD-MM-YYYY'));
    });
     $('.selectdate').on('cancel.daterangepicker', function(ev, picker) {
       $('input[name="from_date"]').val('');
       $('input[name="to_date"]').val('');
     });
   });
 </script>
 <script type="text/javascript">
 function add_rates(t)
 {
    var Num=/^(0|[1-9][0-9]*)$/;   
    var deciNum= /^[0-9]+(\.\d{1,3})?$/; 
    var form =$(t.form);
    $val=t.form.getAttribute('data-action');   
    $(".deciNum").each(function()
    { 
        if($(this).val()=='')
        {
           alert("Enter The Value for "+$(this).attr('placeholder'));
           $(this).focus();
           return false;
         }
         else if(!deciNum.test($(this).val()))
         {
            alert("Enter Either Numberic  or Decimal Value for "+$(this).attr('placeholder'));
            $(this).val('');
            $(this).focus();
            return false;
         }
    }); 
    $(".Num").each(function()
      {     
          if($(this).val()=='')
          {
            alert("Enter The Value for "+$(this).attr('placeholder'));
            $(this).focus();
            return false;
           }
           else if(!Num.test($(this).val()))
           {
              alert("Enter Numberic  Value for "+$(this).attr('placeholder'));
              $(this).val('');
              $(this).focus();
              return false;
           }
      });
      $(".checkzero").each(function()
      {     
          if(parseFloat($(this).val())==0)
          {
             alert("Value Should be Greater than Zero for "+$(this).attr('placeholder'));
             $(this).val('');
             $(this).focus();
             return false;
           }        
      });
    form.parsley().validate();
    if (!form.parsley().isValid())
    {
        return false;
    } 
    else
    {  
     $.ajax({
        type: "POST",
        url: site_url + $val,
        data :form.serialize(),
        dataType : 'json', 
        success: function(data)
        { 
           if(data.result !='')
           {       
               alert("Successfully Added");          
               $title="Are You Want Add More Excursion Rates";
               if(confirm($title))
               { }
               else
               {
                  window.location.reload();
               }
          } 
          else
          {   
             alert("Try After Sometimes....");
             window.location.reload();    
          }    
       }
      });  
    }
  }
 </script>
