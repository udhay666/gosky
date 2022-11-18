<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css" />

<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
 <div class="mainpanel">
  <?php echo $this->load->view('top_panel'); ?>

<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>Edit insurance</h3>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
         <?php
            //print_r($edit_accomodation);exit;
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
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Insurance</small></h2>
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
                  <form action="<?php echo site_url(); ?>/home/update_insurance" method="post" class="" role="form" data-parsley-validate enctype="multipart/form-data">
                    <?php// echo '<pre/>';print_r($insurance);exit;?>
                     <input class="form-control" type="hidden" name="id" value="<?php echo $insurance->s_no; ?>"/>
                    
                     <div class=" border_row">
                       <div class="form-group col-md-4">
                           <label><strong>Plan Name:</strong></label>
                           <input class="form-control" name="plan_name" id="plan_name" type="text" class="required" value="<?php echo $insurance->plan_name ?>" required/>
                        </div>
                        <div class="form-group col-md-4">
                           <label><strong>Base fare</strong></label>
                           <input class="form-control"  value="<?php echo $insurance->total_fare ?>" name="base_fare" id="base_fare" type="text"  />
                        </div>
                        <div class="form-group col-md-4">
                           <label><strong>Tax fare</strong></label>
                           <input class="form-control"  value="<?php echo $insurance->tax?>" name="tax_fare" id="tax_fare" type="text"  />
                        </div>
                        <div class="form-group col-md-4">
                           <label><strong>Tds fare</strong></label>
                           <input class="form-control"  value="<?php echo $insurance->tds_fare ?>" name="tds_fare" id="tds_fare" type="text"  />
                        </div>
                        <div class="form-group col-md-4">
                           <strong>Trip type</strong></label>
                           <select class="form-control" name="trip_type" >
                              <option value="Domestic">Domestic</option>
                              <option value="International">International</option>
                           </select>
                        </div>
                     </div>
                     <div class="border_row">
                     </div>
                    </div>
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-offset-4">
                              <!--  <button type="submit" class="btn btn-ef btn-ef-1 btn-ef-1-primary btn-ef-1a">Add</button> -->
                              <button class="btn btn-primary" value="Update">Update</button>
                              <button type="reset" class="btn btn-default">Reset</button>
                           </div>
                        </div>
                     </div>
                  </form>
                  </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div> <?php echo $this->load->view('footer'); ?>
<script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>

<script src="<?php echo base_url(); ?>public/js/bootstrap-datepicker.js"></script>
<script>
$(function(){
var nowTemp = new Date();
//alert(nowTemp);
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
var checkinH = $('#dph1').datepicker({
minDate: 0,
maxDate: '+12M',
numberOfMonths: 2,
dateFormat: 'dd/mm/yy',
//  onRender: function(date) {
//      return date.valueOf() < now.valueOf() ? 'disabled' : '';
///  }
}).on('changeDate', function(ev) {
if (ev.date.valueOf() > checkoutH.date.valueOf()) {
var newDate = new Date(ev.date)
newDate.setDate(newDate.getDate() + 1);
checkoutH.setValue(newDate);
}
checkinH.hide();
$('#dph2')[0].focus();
}).data('datepicker');
var checkoutH = $('#dph2').datepicker({
minDate: 1,
maxDate: '+12M',
numberOfMonths: 2,
dateFormat: 'dd/mm/yy',
//        onRender: function(date) {
//            return date.valueOf() <= checkinH.date.valueOf() ? 'disabled' : '';
//        }
}).on('changeDate', function(ev) {
checkoutH.hide();
}).data('datepicker');
});
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/wysihtml5-0.3.0.min.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url();?>public/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/ckeditor/adapters/jquery.js"></script>
<script>
jQuery(document).ready(function(){
// HTML5 WYSIWYG Editor
jQuery('#wysiwyg').wysihtml5({color: true,html:true});
jQuery('#wysiwyg1').wysihtml5({color: true,html:true});
jQuery('#wysiwyg2').wysihtml5({color: true,html:true});
jQuery('#wysiwyg3').wysihtml5({color: true,html:true});
jQuery('#wysiwyg4').wysihtml5({color: true,html:true});
jQuery('#wysiwyg5').wysihtml5({color: true,html:true});
jQuery('#wysiwyg6').wysihtml5({color: true,html:true});
// CKEditor
jQuery('#ckeditor').ckeditor();
});
</script>

