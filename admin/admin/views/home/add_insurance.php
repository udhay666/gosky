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
            <h3>Add Insurance</h3>
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
                  <form action="<?php echo site_url(); ?>/home/insert_insurance" method="post" class="" role="form" data-parsley-validate enctype="multipart/form-data">
      
                     <div class=" border_row">
                       <div class="form-group col-md-4">
                           <label><strong>Plan Name:</strong></label>
                           <input class="form-control" name="plan_name" id="plan_name" type="text" class="required" required/>
                        </div>
                        <div class="form-group col-md-4">
                           <label><strong>Base fare</strong></label>
                           <input class="form-control" name="base_fare" id="base_fare" type="text"  />
                        </div>
                        <div class="form-group col-md-4">
                           <label><strong>Tax fare</strong></label>
                           <input class="form-control" name="tax_fare" id="tax_fare" type="text"  />
                        </div>
                        <div class="form-group col-md-4">
                           <label><strong>TDS fare</strong></label>
                           <input class="form-control" name="tds_fare" id="tax_fare" type="text"  />
                        </div>
                        <div class="form-group col-md-4">
                           <strong>Trip type</strong></label>
                           <select class="form-control" name="trip_type" >
                              <option value="Domestic">Domestic</option>
                              <option value="International">International</option>
                           </select>
                        </div>
                     </div>
                     <!-- <div class="border_row">
                        <div class="form-group col-md-4">
                           <label><strong>Start Date:</strong></label>
                           <input class="form-control" type="text" class="form-control"  id="dph1" name="checkIn" autocomplete= "off"  required />
                        </div>
                        <div class="form-group col-md-4">
                           <label><strong>End Date:</strong></label>
                           <input class="form-control" type="text" class="form-control"  id="dph2" name="checkOut" autocomplete= "off"   required />
                        </div>
                     </div> -->
                     <div class="border_row">
                        
                     </div>
                       </div>
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-offset-4">
                              <!--  <button type="submit" class="btn btn-ef btn-ef-1 btn-ef-1-primary btn-ef-1a">Add</button> -->
                              <button class="btn btn-primary" value="Update">Add</button>
                              <button type="reset" class="btn btn-default">Reset</button>
                           </div>
                        </div>
                     </div>
                  </form>
                  <ul class="nav nav-tabs nav-dark">
                     <li class="active"><a href="#home2" data-toggle="tab"><strong>Insurance List</strong></a></li>
                  </ul>
                  <div class="tab-content mb30">
                     <div class="table-responsive">
                        <table  id="datatable1" class="table table-striped table-bordered">
                           <thead>
                              <tr>
                                 <th>SI.No</th>
                                 <th>Plan Name</th>
                                 <th>Base Fare </th>
                                 <th>Tax</th>
                                 <th>Tds fare</th>
                                 <th>Trip type</th>
                                 <th>Created on</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php if (!empty($insurance_list)) { ?>
                              <?php for ($i = 0; $i < count($insurance_list); $i++) { ?>
                              <tr>
                                 <td><?php echo $i + 1; ?></td>
                                 <td class="center"><?php echo $insurance_list[$i]->plan_name; ?></td>
                                 <td class="center"><?php echo $insurance_list[$i]->total_fare; ?></td>
                                 <td class="center"><?php echo $insurance_list[$i]->tax; ?></td>
                                 <td class="center"><?php echo $insurance_list[$i]->tds_fare; ?></td>
                                 <td class="center"><?php echo $insurance_list[$i]->trip_type; ?></td>
                                 <td class="center"><?php echo $insurance_list[$i]->created_date; ?></td>
                                 <td><?php if($insurance_list[$i]->status == 1){ echo 'Active';    }else{ echo 'Inactive';   } ?></td>
                                 <td>
                                   <a href="<?php echo site_url(); ?>/home/edit_insurance/<?php echo $insurance_list[$i]->s_no; ?>" target="_blank">Edit</a><br/>
                                    <a href="<?php echo site_url() ?>/home/insurance_active/<?php echo $insurance_list[$i]->s_no; ?>/1">Active</a>&nbsp;|&nbsp;
                                    <a href="<?php echo site_url() ?>/home/insurance_active/<?php echo $insurance_list[$i]->s_no; ?>/0">Inactive</a>
                                 </td> 
                              </tr>
                              <?php } ?>
                              <?php } else { ?>
                              <div class="alert alert-error">
                                 <button class="close" data-dismiss="alert" type="button">×</button>
                                 <strong>Error!</strong>
                                 No Data Found. Please try after some time...
                              </div>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
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

