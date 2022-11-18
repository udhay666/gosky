<?php $this->load->view('header'); ?>
 <?php  $this->load->view('left_panel'); ?>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css" />

<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
 <div class="mainpanel">
  <?php  $this->load->view('top_panel'); ?>

<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>Add Best offers</h3>
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
                  <h2>Destinations</small></h2>
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
                  <form action="<?php echo site_url(); ?>/offers/insert_best_offers_images" method="post" class="" role="form" data-parsley-validate enctype="multipart/form-data">
                  <!--   <div class=" border_row">
                      <div class="form-group col-md-4">
                           <label><strong>Country:</strong></label>
                           <select  class="select2_rating form-control"  name="country" tabindex="-1" required>
                              <option value="">Select Country</option>
                              <optgroup label="Country List">
                                 <?php for($i = 0;$i <count($country_list);$i++){ ?>
                                    <option value="<?php echo $country_list[$i]->name?>"><?php echo $country_list[$i]->name?></option>
                                 <?php }?>
                              </optgroup>
                           </select>
                        </div>
                      </div>  -->
                   
                    <!--  <div class=" border_row">
                       <div class="form-group col-md-4">
                           <label><strong>Properties No</strong></label>
                           <input class="form-control" name="properties" id="offer_name" type="text" class="required" required/>
                        </div>
                     </div> -->
                     <div class="border_row">
                        <div class="form-group col-md-12">
                           <label><strong>Thumbnail Image</strong></label>
                           <input class="form-control" type="file" name="thumb_image" multiple required>
                        </div>
                       
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
                     <li class="active"><a href="#home2" data-toggle="tab"><strong>Offers Image List</strong></a></li>
                  </ul>
                  <div class="tab-content mb30">
                     <div class="table-responsive">
                        <table  id="datatable1" class="table table-striped table-bordered">
                           <thead>
                              <tr>
                                 <th>SI.No</th>
                                 <th>Image</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                            <?php if (!empty($best_offers_list)) { ?>
                              <?php for ($i = 0; $i < count($best_offers_list); $i++) { ?>
                              <tr>
                                 <td><?php echo $i + 1; ?></td>
                                 <td class="center"><img style="width:200px;height:100px;"src="<?php echo base_url(); echo $best_offers_list[$i]->offers_image; ?>"/>
                                 </td>
                                 <td><?php if($best_offers_list[$i]->status == 1){ echo 'Active';    }else{ echo 'Inactive';   } ?></td>
                                 <td>
                                   <!-- <a href="<?php echo site_url(); ?>/popular/edit_popular/<?php echo $popular_list[$i]->id; ?>" target="_blank">Edit</a><br/> -->
                                    <a href="<?php echo site_url() ?>/offers/offers_active/<?php echo $best_offers_list[$i]->id; ?>/1">Active</a>&nbsp;|&nbsp;
                                    <a href="<?php echo site_url() ?>/offers/offers_active/<?php echo $best_offers_list[$i]->id; ?>/0">Inactive</a>
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
</div> <?php  $this->load->view('footer'); ?>
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

