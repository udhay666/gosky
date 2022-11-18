<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css" />

<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Add Activities<span></span></h2>
          <div class="page-bar  br-5">
            <div class="form-group">
              <a href="<?php echo site_url() ?>home/change_password" class="btn btn-success" type="button"><i class="fa fa-list m-right-xs"></i> Change Password</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="pagecontent">
      <div class="row">
        <div class="col-md-12">
          <section class="boxs">
            <div class="boxs-header dvd dvd-btm">
              <h1 class="custom-font"><!-- <strong>Advanced</strong> Table --></h1>
              <ul class="controls">
                <li> <a role="button" tabindex="0" class="boxs-refresh"> <i class="fa fa-refresh"></i> </a> </li>
                <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
                <!-- <li> <a role="button" tabindex="0" class="boxs-fullscreen"> <i class="fa fa-expand"></i> </a> </li> -->
              </ul>
            </div>
            <div class="boxs-body">
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
              <div class="row">
                <div class="col-md-6">
                  <div id="tableTools"></div>
                </div>
                <div class="col-md-6">
                  <div id="colVis"></div>
                </div>
              </div>
              <form action="<?php echo site_url(); ?>home/add_activity" method="post" class="" role="form" data-parsley-validate enctype="multipart/form-data">
                <div class="row border_row">
                  <div class="form-group col-md-4">
                    <label><strong>Package Title:</strong></label>
                     <input class="form-control" name="package_title" id="package_title" type="text" class="required"  style="width:275px;" required/>
                  </div>
                  <div class="form-group col-md-4">
                    <label><strong>Destination</strong></label>
                    <select class="select2_multiple form-control"  name="desti"  required>
                            <?php if(!empty($holicitylist)){ for($i=0;$i<count($holicitylist);$i++) { ?>
                            <option value="<?php echo $holicitylist[$i]->city_name;?>">
                            <?php echo $holicitylist[$i]->city_name.' , '.$holicitylist[$i]->country_name;?>
                            </option>
                            <?php }} ?>
                        </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label><strong>Package Rating:</strong></label>
                    <select  class="select2_rating form-control"  name="package_rating" tabindex="-1" required>
                            <option value="">Select Package Rating</option>
                            <optgroup label="Package Rating">     
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            </optgroup>
                           </select>
                  </div>
                </div>
                <div class="row border_row">
				  <div class="form-group col-md-4">
					<label><strong>Start Date:</strong></label>
                     <input class="form-control" type="text" class="form-control"  id="dph1" name="checkIn" autocomplete= "off"  required />
				  </div>
				  <div class="form-group col-md-4">
                     <label><strong>End Date:</strong></label>
                    <input class="form-control" type="text" class="form-control"  id="dph2" name="checkOut" autocomplete= "off"   required />
                  </div>
                  <div class="form-group col-md-4">
                     <label><strong>Package Price/Adult</strong></label>
                    <input class="form-control"  name="price_ad" id="price_ad" type="text" class="required" required/>
                        
                  </div>
                  <div class="form-group col-md-4">
                     <label><strong>Time</strong></label>
                    <select class="select2_multiple form-control"   name="time" required>
                        <option>Hours</option>
                        <option value="12:00 AM">12:00 AM</option>
                        <option value="12:15 AM">12:15 AM</option>
                        <option value="12:30 AM">12:30 AM</option>
                        <option value="12:45 AM">12:45 AM</option>
                        <option value="1:00 AM">1:00 AM</option>
                        <option value="1:15 AM">1:15 AM</option>
                        <option value="1:30 AM">1:30 AM</option>
                        <option value="1:45 AM">1:45 AM</option>
                        <option value="2:00 AM">2:00 AM</option>
                        <option value="2:15 AM">2:15 AM</option>
                        <option value="2:30 AM">2:30 AM</option>
                        <option value="2:45 AM">2:45 AM</option>
                        <option value="3:00 AM">3:00 AM</option>
                        <option value="3:15 AM">3:15 AM</option>
                        <option value="3:30 AM">3:30 AM</option>
                        <option value="3:45 AM">3:45 AM</option>
                        <option value="4:00 AM">4:00 AM</option>
                        <option value="4:15 AM">4:15 AM</option>
                        <option value="4:30 AM">4:30 AM</option>
                        <option value="4:45 AM">4:45 AM</option>
                        <option value="5:00 AM">5:00 AM</option>
                        <option value="5:15 AM">5:15 AM</option>
                        <option value="5:30 AM">5:30 AM</option>
                        <option value="5:45 AM">5:45 AM</option>
                        <option value="6:00 AM">6:00 AM</option>
                        <option value="6:15 AM">6:15 AM</option>
                        <option value="6:30 AM">6:30 AM</option>
                        <option value="6:45 AM">6:45 AM</option>
                        <option value="7:00 AM">7:00 AM</option>
                        <option value="7:15 AM">7:15 AM</option>
                        <option value="7:30 AM">7:30 AM</option>
                        <option value="7:45 AM">7:45 AM</option>
                        <option value="8:00 AM">8:00 AM</option>
                        <option value="8:15 AM">8:15 AM</option>
                        <option value="8:30 AM">8:30 AM</option>
                        <option value="8:45 AM">8:45 AM</option>
                        <option value="9:00 AM">9:00 AM</option>
                        <option value="9:15 AM">9:15 AM</option>
                        <option value="9:30 AM">9:30 AM</option>
                        <option value="9:45 AM">9:45 AM</option>
                        <option value="10:00 AM">10:00 AM</option>
                        <option value="10:15 AM">10:15 AM</option>
                        <option value="10:30 AM">10:30 AM</option>
                        <option value="10:45 AM">10:45 AM</option>
                        <option value="11:00 AM">11:00 AM</option>
                        <option value="11:15 AM">11:15 AM</option>
                        <option value="11:30 AM">11:30 AM</option>
                        <option value="11:45 AM">11:45 AM</option>
                        <option value="12:00 PM">12:00 PM</option>
                        <option value="12:15 PM">12:15 PM</option>
                        <option value="12:30 PM">12:30 PM</option>
                        <option value="12:45 PM">12:45 PM</option>
                        <option value="1:00 PM">1:00 PM</option>
                        <option value="1:15 PM">1:15 PM</option>
                        <option value="1:30 PM">1:30 PM</option>
                        <option value="1:45 PM">1:45 PM</option>
                        <option value="2:00 PM">2:00 PM</option>
                        <option value="2:15 PM">2:15 PM</option>
                        <option value="2:30 PM">2:30 PM</option>
                        <option value="2:45 PM">2:45 PM</option>
                        <option value="3:00 PM">3:00 PM</option>
                        <option value="3:15 PM">3:15 PM</option>
                        <option value="3:30 PM">3:30 PM</option>
                        <option value="3:45 PM">3:45 PM</option>
                        <option value="4:00 PM">4:00 PM</option>
                        <option value="4:15 PM">4:15 PM</option>
                        <option value="4:30 PM">4:30 PM</option>
                        <option value="4:45 PM">4:45 PM</option>
                        <option value="5:00 PM">5:00 PM</option>
                        <option value="5:15 PM">5:15 PM</option>
                        <option value="5:30 PM">5:30 PM</option>
                        <option value="5:45 PM">5:45 PM</option>
                        <option value="6:00 PM">6:00 PM</option>
                        <option value="6:15 PM">6:15 PM</option>
                        <option value="6:30 PM">6:30 PM</option>
                        <option value="6:45 PM">6:45 PM</option>
                        <option value="7:00 PM">7:00 PM</option>
                        <option value="7:15 PM">7:15 PM</option>
                        <option value="7:30 PM">7:30 PM</option>
                        <option value="7:45 PM">7:45 PM</option>
                        <option value="8:00 PM">8:00 PM</option>
                        <option value="8:15 PM">8:15 PM</option>
                        <option value="8:30 PM">8:30 PM</option>
                        <option value="8:45 PM">8:45 PM</option>
                        <option value="9:00 PM">9:00 PM</option>
                        <option value="9:15 PM">9:15 PM</option>
                        <option value="9:30 PM">9:30 PM</option>
                        <option value="9:45 PM">9:45 PM</option>
                        <option value="10:00 PM">10:00 PM</option>
                        <option value="10:15 PM">10:15 PM</option>
                        <option value="10:30 PM">10:30 PM</option>
                        <option value="10:45 PM">10:45 PM</option>
                        <option value="11:00 PM">11:00 PM</option>
                        <option value="11:15 PM">11:15 PM</option>
                        <option value="11:30 PM">11:30 PM</option>
                        <option value="11:45 PM">11:45 PM</option>
                     </select>
                        
                  </div>
                  <div class="form-group col-md-12">
                    <label><strong>Package Overview</strong></label>
                     <textarea class="form-control ckeditor" id="" placeholder="Enter text here..."  rows="5" name="package_desc"></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="holiday_city"><strong>Whats Included</strong></label>
                    <textarea class="form-control ckeditor" id="" placeholder="Enter text here..."  rows="5" name="included"></textarea>
                  </div>
                </div>
                 <div class="row border_row">
                    <div class="form-group col-md-12">
                    <label><strong>Thumbnail Image</strong></label>
                               <input class="form-control" type="file" name="thumb_image" required>
                    </div>
                    <div class="form-group col-md-12">
                    <label><strong>Gallery Images</strong></label>
                               <input class="form-control"  type="file" name="files[]" multiple required>
                    </div>
                   <!--  <div class="form-group col-md-4">
                     <label><strong>Gallery Images</strong></label>
                    
                                    <input class="form-control" type="file" name="holiday_gallery_image[]" multiple required>
                      </div> -->
                 
                 <!--  <div class="form-group col-md-4">
                     <label><strong>Package Price/Adult</strong></label>
                    <input class="form-control"  name="price_ad" id="price_ad" type="text" class="required" required/>
                        
                  </div> -->
                  
                 
                  
                </div>
                 <div class="row border_row">
                  
                  <div class="form-group col-md-12">
                    <label for="holiday_city"><strong>Departure and Return:</strong></label>
                    <textarea class="form-control ckeditor" id="" rows="10" name="departure" placeholder="Enter text here..." ></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="pin_code"><strong>What to Expect</strong></label>
                     <textarea class="form-control ckeditor" id="" rows="10" name="expected" placeholder="Enter text here..." ></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="pin_code"><strong>Hotel Pickup</strong></label>
                     <textarea class="form-control ckeditor" id="" rows="10" name="pickup" placeholder="Enter text here..." ></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label><strong>Additional Info:</strong></label>
                     <textarea class="form-control ckeditor" id="" rows="10" name="additional" placeholder="Enter text here..." ></textarea>
                  </div>
                </div> 
                 <div class="row border_row">
                  
                  <div class="form-group col-md-12">
                    <label><strong>Cancellation Policy:</strong></label>
                    <textarea class="form-control ckeditor" id="" rows="10" name="cancel" placeholder="Enter text here..." ></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label><strong>Reviews:</strong></label>
                    <textarea class="form-control ckeditor" id="" rows="10" name="reviews" placeholder="Enter text here..." ></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label><strong>Terms and Conditions</strong></label>
                    <textarea  name="terms" class="form-control ckeditor" id="" rows="10" placeholder="Enter text here..."></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-offset-11">
					  <button type="submit" class="btn btn-ef btn-ef-1 btn-ef-1-primary btn-ef-1a">Add</button>
					</div>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</section>
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

