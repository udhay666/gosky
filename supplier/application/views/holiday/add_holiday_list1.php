<?php $this->load->view('header'); ?>
<?php //echo $this->load->view('left_panel'); ?>
<?php //echo $this->load->view('top_panel'); ?>
 <link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css">
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/admin/bootstrap.datepicker.css">
    <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Holiday</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
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
        <form class="form-horizontal" action="<?php echo site_url(); ?>/holiday/holidaylist"  method="post" enctype="multipart/form-data">
            
                <?php
                if ($status == '0') {
                ?>
                <div class="alert alert-success">
                    <button class="close" data-dismiss="alert" type="button"></button>
                    <strong>Success!</strong`                    Your Package Successfully Updated.
                </div>
                <?php
                } else if ($status == '1') {
                ?>
                <div class="alert alert-error">
                    <button class="close" data-dismiss="alert" type="button"></button>
                    <strong>Error!</strong>
                    Your Package Not Updated. Please provide correct information
                </div>
                <?php
                }
                ?>
               <div class="form-group">
                    <label class="col-sm-3  control-label">Bookable Online</label>
                    <div class="col-sm-6 ">
                        Yes
                        <input   name="bookable" id="bookable" type="radio" class="required" value="1" required/>
                        &nbsp;|&nbsp;No
                        <input   name="bookable" id="bookable" type="radio" class="required" value="0" checked="checked" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3  control-label">Package Title</label>
                    <div class="col-sm-6 ">
                        <input class="form-control" name="package_title" id="package_title" type="text" class="required"  style="width:275px;" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3  control-label">Package Code</label>
                    <div class="col-sm-6 ">
                        <input class="form-control" name="package_code" id="package_code" type="text" class="required"  style="width:275px;" required/>
                   </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-3  control-label">Tagging services</label>
                    <div class="col-sm-6 ">
                    <input type="checkbox" name="taggingservices[]" value="Flights"> Flights 
                    <input type="checkbox" name="taggingservices[]" value="Hotels"> Hotels 
                    <input type="checkbox" name="taggingservices[]" value="Sightseeing"> Sightseeing  
                    <input type="checkbox" name="taggingservices[]" value="Transfer">Transfer
                    <input type="checkbox" name="taggingservices[]" value="Visa">Visa <input type="checkbox" name="taggingservices[]" value="Insurance">Insurance
                   </div>
                </div>
             
                 <div class="form-group">
                    <label class="col-sm-3  control-label">Destination</label>
                    <div class="col-sm-6 ">
                        <select class="select2_multiple form-control"  name="desti[]"  multiple="multiple" required>
                            <?php if(!empty($holicitylist)){ for($i=0;$i<count($holicitylist);$i++) { ?>
                            <option value="<?php echo $holicitylist[$i]->city_id;?>">
                            <?php echo $holicitylist[$i]->city_name.' , '.$holicitylist[$i]->country_name;?>
                            </option>
                            <?php }} ?>
                        </select>
                    </div>
                </div>
             <div class="form-group">
                    <label class="col-sm-3  control-label">Package Popularity</label>
                    <div class="col-sm-6 ">
                <input class="form-control" name="package_popularity" id="package_popularity" type="number" class="required"  style="width:275px;" required/>
                (Package Popularity Should be Digit only.&nbsp;Example:- 1000)
                    </div>
                </div>
               <div class="form-group">
                    <label class="col-sm-3  control-label">Package Rating</label>
                    <div class="col-sm-6 ">
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
                <div class="form-group">
                    <label class="col-sm-3  control-label">Select Theme</label>
                    <div class="col-sm-6 ">
                        <select class="select2_multiple form-control"  name="holiday_theme[]"  multiple="multiple" required>
                            <?php if($theme) foreach($theme as $th) { ?>
                            <option value="<?php echo $th->theme_id;?>"><?php echo $th->theme_name;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-3  control-label">Category</label>
                    <div class="col-sm-6 ">
                        <select  class="select2_multiple form-control" id="selectallcategory" name="category[]"  multiple="multiple" required >
                            <option value="1">Comfort</option>
                            <option value="2">Quality</option>
                            <option value="3">Luxury</option>
                           </select>
                           <input type="checkbox" id="categorycheckbox" >Select All Category
                    </div>
                </div>
             
                <div class="form-group">
                    <label class="col-sm-3  control-label">Duration</label>
                    <div class="col-sm-6 ">
                        <select class="form-control"  name="duration" class="required" id="duration" style="width:275px;" required>
                            <option value="">--Select Tour Type--</option>
                            <option value="1">1Nights+2Days</option>
                            <option value="2">2Nights+3Days</option>
                            <option value="3">3Nights+4Days</option>
                            <option value="4">4Nights+5Days</option>
                            <option value="5">5Nights+6Days</option>
                            <option value="6">6Nights+7Days</option>
                            <option value="7">7Nights+8Days</option>
                            <option value="8">8Nights+9Days</option>
                            <option value="9">9Nights+10Days</option>
                        <option value="10" selected="selected">10Nights+11Days</option>
                            <option value="11">11Nights+12Days</option>
                            <option value="12">12Nights+13Days</option>
                            <option value="13">13Nights+14Days</option>
                            <option value="14">14Nights+15Days</option>
                            <option value="15" >15Nights+16Days</option>
                            <option value="16">16Nights+17Days</option>
                            <option value="17">17Nights+18Days</option>
                            <option value="18">18Nights+19Days</option>
                            <option value="19">19Nights+20Days</option>
                            <option value="20">20Nights+21Days</option>
                            <option value="21" >21Nights+22Days</option>
                            <option value="22">22Nights+23Days</option>
                            <option value="23">23Nights+24Days</option>
                            <option value="24">24Nights+25Days</option>
                            <option value="25">25Nights+26Days</option>
                            <option value="26">26Nights+27Days</option>
                            <option value="27">27Nights+28Days</option>
                            <option value="28">28Nights+29Days</option>
                            <option value="29">29Nights+30Days</option>
                            <option value="30">30Nights+31Days</option>
                            <option value="31">31Nights+32Days</option>
                            <option value="32">32Nights+33Days</option>
                            <option value="33" >33Nights+34Days</option>
                            <option value="34">34Nights+35Days</option>
                            <option value="35">35Nights+36Days</option>
                            <option value="36">36Nights+37Days</option>
                            <option value="37">37Nights+38Days</option>
                            <option value="38">38Nights+39Days</option>
                            <option value="39">39Nights+40Days</option>
                        </select>
                    </div>
                </div>
               <div class="form-group">
                    <label class="col-sm-3  control-label">Months</label>
                    <div class="col-sm-6 ">
                        <select  class="select2_multiple form-control"  name="month[]" id="selectallmonth"  multiple="multiple" required>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5" >May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <input type="checkbox" id="monthcheckbox" >Select All Months
                        (Note : Months Should be between Start date & End Date only)
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3  control-label">Start Date</label>
                    <div class="col-sm-6 ">
                        <input class="form-control" type="text" class="form-control"  id="dph1" name="checkIn" autocomplete= "off"  required />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3  control-label">End Date</label>
                    <div class="col-sm-6 " >
                        <input class="form-control" type="text" class="form-control"  id="dph2" name="checkOut" autocomplete= "off"   required />
                    </div>
                </div>
              
       
                <div class="form-group">
                    <label class="col-sm-3  control-label">Package Overview</label>
                    <div class="col-sm-9 ">
                        <textarea class="form-control ckeditor" id="" placeholder="Enter text here..."  rows="5" name="package_desc"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3  control-label">Good to know</label>
                    <div class="col-sm-9 " >
                        <textarea class="form-control ckeditor" id="" placeholder="Enter text here..."  rows="5" name="package_good"></textarea>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-3  control-label">Highlights</label>
                    <div class="col-sm-9 " >
                        <textarea class="form-control ckeditor" id="" rows="10" name="highlight" placeholder="Enter text here..." ></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3  control-label">Inclusions</label>
                    <div class="col-sm-9 " >
                        <textarea class="form-control ckeditor" id="" rows="10" name="inclusion" placeholder="Enter text here..."></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3  control-label">Exclusions</label>
                    <div class="col-sm-9 " >
                        <textarea class="form-control ckeditor" id="" rows="10" name="exclusion" placeholder="Enter text here..."></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3  control-label">Comfort</label>
                    <div class="col-sm-9 " >
                        <textarea class="form-control ckeditor" id="" placeholder="Enter Comfort Accommodation Description here..."  rows="5" name="comfort" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3  control-label">Quality</label>
                    <div class="col-sm-9 " >
                        <textarea class="form-control ckeditor" id="" placeholder="Enter Quality Accommodation Description here..."  rows="5" name="quality" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3  control-label">Luxury</label>
                    <div class="col-sm-9 " >
                        <textarea class="form-control ckeditor" id="" placeholder="Enter Luxury Accommodation Description here..."  rows="5" name="luxury" required></textarea>
                    </div>
                </div>
               
               
                
               
                <div class="form-group">
                    <label class="col-sm-3  control-label">Package Price/Adult</label>
                    <div class="col-sm-6" >
                        <input class="form-control"  name="price_ad" id="price_ad" type="text" class="required" required/>
                        (Package Price/Adult Should be Comfort Twin sharing Room Price only)
                    </div>
                </div>
               <br>
            
                    
                            <div class="form-group">
                                <label for="inputError" class="col-sm-3  control-label">Thumbnail Image</label>
                                <div class="col-sm-6 ">
                                     <input class="form-control" type="file" name="thumb_image" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3  control-label">Gallery Images</label>
                                <div class="col-sm-6 ">
                                    <input class="form-control" type="file" name="holiday_gallery_image[]" multiple required>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3  control-label">Map Images</label>
                                <div class="col-sm-6 ">
                                    <input class="form-control" type="file" name="holiday_map_image">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3  control-label">Terms & Conditions</label>
                                <div class="col-sm-9 " >
                                    <textarea  name="terms" class="form-control ckeditor" id="" rows="10" placeholder="Enter text here..."></textarea>
                                </div>
                            </div>
                       
                              <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                 <input type="submit" class="btn btn-primary" name="Pub" value="Publish" />
                    
                                <a href="<?php echo site_url('home/dashboard'); ?>" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                </div>
                              </div>
                           
                        
                        </form>
                </div>
            </div>
          

        </div>
        </div>
        </div>
        </div>
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Developed by <a href="http://www.travelpd.com" target="_blank" style="color:blue;">TravelPD</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
  <!--  -->
  <script src="<?php echo base_url(); ?>public/js/jquery-1.10.2.min.js"></script>

  <!--<script src="<?php echo base_url(); ?>public/js/admin/jquery.jsss"></script>-->
<script src="<?php echo base_url(); ?>public/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/modernizr.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/toggles.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/retina.min.js"></script>

<script src="<?php echo base_url(); ?>public/js/jquery.cookies.js"></script>
    <!-- -->
<script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/admin/jquery.js"></script>
<script src="<?php echo base_url();?>public/js/admin/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>public/js/admin/jquery.uniform.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/admin/bootstrap-datepicker.js"></script>
 <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>public/themetemplate/build/js/custom.min.js"></script>
<!-- Select2 -->
    <script src="<?php echo base_url(); ?>public/themetemplate/vendors/select2/dist/js/select2.full.min.js"></script>
 <script>
      $(document).ready(function() {
         $(".select2_single").select2({
          placeholder: "Select a Country",
          allowClear: true
        });
        $(".select2_group").select2({});

      
      });
      $.fn.select2.amd.require(['select2/selection/search'], function (Search) {
    var oldRemoveChoice = Search.prototype.searchRemoveChoice;
    
    Search.prototype.searchRemoveChoice = function () {
        oldRemoveChoice.apply(this, arguments);
        this.$search.val('');
    };
    
    $(".select2_multiple").select2({           
          placeholder: "Select option"        
        });
});


      $("#monthcheckbox").click(function(){
    if($("#monthcheckbox").is(':checked') ){
        $("#selectallmonth > option").prop("selected","selected");
        $("#selectallmonth").trigger("change");
    }else{
        $("#selectallmonth > option").removeAttr("selected");
         $("#selectallmonth").trigger("change");
     }
});

 $("#categorycheckbox").click(function(){
    if($("#categorycheckbox").is(':checked') ){
        $("#selectallcategory > option").prop("selected","selected");
        $("#selectallcategory").trigger("change");
    }else{
        $("#selectallcategory > option").removeAttr("selected");
         $("#selectallcategory").trigger("change");
     }
});
    </script>
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
<script src="<?php echo base_url(); ?>public/js/jquery.datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>validation/validation.js"></script>
<!-- <script src="<?php echo base_url(); ?>public/js/custom.js"></script> -->

<script src="<?php echo base_url(); ?>public/js/jquery.validate.min.js"></script>

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

    </body>
</html>