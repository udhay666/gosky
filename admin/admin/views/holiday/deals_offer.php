    <?php $this->load->view('header'); ?>
    <?php echo $this->load->view('left_panel'); ?>
    <?php echo $this->load->view('top_panel'); ?>
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css" />      
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
           <!--  <h3>Add/Edit Deal offers</h3> -->
          </div>
        </div>
        <div class="clearfix"></div>     
        <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
            <ul class="nav  navbar-left">
                <li class="active"><h4>Add/Edit <?php echo $dealspackage->package_title.' ('.$dealspackage->package_code.')'; ?> Package Deal offers</h4></li>
              </ul> 
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <div class="tab-content mb30">                                      
              <form id="basicForm" action="<?php echo site_url();?>/holiday/add_deals_offer/<?php echo $holiday_id; ?>" method="post" class="form-horizontal">
              <div class="form-group">
                <label class="col-sm-3 control-label" for="disabledInput">Deals Amount Should be Greater than <?php echo $dealspackage->price; ?></label>
                <div class="col-sm-6">
                  <input class="form-control" id="focusedInput" type="number" name="deals_amount" value="<?php echo $deals_offer->deals_amount; ?>" placeholder="Enter Deals Amount"  min="<?php echo $dealspackage->price; ?>" required> 
                </div>
                </div>
                <div class="form-group">
                <label class="col-sm-3 control-label" for="disabledInput">Valid Upto</label>
                 <div class="controls">
                  <div class="col-sm-6 xdisplay_inputx form-group has-feedback">
                
                  <input id="pr_expire" class="form-control has-feedback-left" type="text" value="<?php echo $deals_offer->deals_expire; ?>" name="deals_expire"  aria-describedby="inputSuccess2Status3" required >
                   <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                  <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                </div>
                </div>
                </div>
                <div class="ln_solid"></div>
               <div class="form-actions">
               <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-primary">Update Deals</button>
                <a href="<?php echo site_url();?>/holiday/dealspackagelist" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                </div>
                </div>
              </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      function __doPostBack(elm) {
        var val = elm.options[elm.selectedIndex].value;
        if (val == "1")
        {
          $('#inter').show();
            //$('#inter').addClass('required');
            $('#dome').hide();
          }
          if (val == "2")
          {
            $('#inter').hide();
            $('#dome').show();
            //$('#dome').addClass('required');
          }
        }
      </script>
      <?php echo $this->load->view('footer'); ?>
      <!--<script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>-->
      <script src="<?php echo base_url(); ?>public/js/holder.js"></script>
      <!--<script src="<?php echo base_url(); ?>public/js/jquery.datatables.min.js"></script>-->
      <script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>
      <script src="<?php echo base_url(); ?>public/js/jquery.doubleScroll.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
          $('.double-scroll').doubleScroll();
        });
      </script>
      <script type="text/javascript" src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
      <!--<script src="<?php echo base_url(); ?>public/js/custom.js"></script>-->
      <script>
        function __doPostBack(elm) {
          var val = elm.options[elm.selectedIndex].value;
          if(val == "1")
          {
            $('#inter').show();
//$('#inter').addClass('required');
$('#dome').hide();
}
if(val == "2")
  {$('#inter').hide();
$('#dome').show();
//$('#dome').addClass('required');
}
}
</script>
<!-- My Custom JS-->
<!-- <script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script> -->
<script type="text/javascript">
$(function() {
   var dateToday = new Date(); 
   dateToday.setDate(dateToday.getDate() + 1);       
    $('#pr_expire').daterangepicker({
        singleDatePicker: true,
        format: 'YYYY-MM-DD',
         minDate: dateToday,
        calender_style: "picker_3"
    });
 });
</script>
