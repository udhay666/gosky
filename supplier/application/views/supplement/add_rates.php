<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">
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
                <li><a>Manage Special Offer Room Rates</a></li>
                <li><a class="active">Add Special Offer Room Rates</a></li>
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
            <h1 class="custom-font">Add Special Offer Room Rates</h1>
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
                        echo '<strong>Well done!</strong> new Special Offer Room Rates added with success.';
                        echo '</div>';       
                     }
                  ?>
               </div>
             </div> 
            <form data-action="specialoffer/update_room_rates/<?php echo $hotel_id.'/'; ?>">
            <div id="loadroomratedetails"> 
             <div class="row">  
             <div class="form-group col-md-4">
              <label class="strong" for="room_id">Hotel: <?php echo $hotel_name;?></label>         
                </div>
              <div class="form-group col-md-3">
                <label class="strong" for="contract">Contract Number: <?php echo $contract_list[0]->contract_number;?></label>
                <input type="hidden" name="contract" value="<?php echo $contract_list[0]->contract_id ?>">               
                <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
                <input type="hidden" name="room_id" value="<?php echo $room_list[0]->supplier_room_list_id; ?>">
                 <input type="hidden" name="market" value="<?php echo $market; ?>">
             <input type="hidden" name="meal_plan" value="<?php echo $meal_planstr; ?>">             
              <input type="hidden" name="specialoffer_id" value="<?php echo $specialoffer_type[0]->id; ?>">
              <input type="hidden" name="specialoffer_type" value="<?php echo $specialoffer_type[0]->type; ?>">             
               </div>              
               <div class="form-group col-md-5">
              <label class="strong" for="meal_plan">Contract Period: <?php echo ' From '.date('d-M-Y',strtotime($contract_list[0]->start_date)).' to '.date('d-M-Y',strtotime($contract_list[0]->end_date)); ?></label>
             </div>
                              
             </div>
              <div class="row">           
               
                <div class="form-group col-md-4">
              <label class="strong" for="market">Market: <?php echo $market; ?></label> 
               </div> 
                 <div class="form-group col-md-4">
                <label class="strong" for="room_id">Room: <?php echo $room_list[0]->room_name.' ('.$this->glb_hotel_room_type->get_single($room_list[0]->hotel_room_type)->room_type.')';?></label>         
                </div> 
                  <div class="form-group col-md-4">
              <label class="strong" for="meal_plan">Meal Plan: <?php echo $mealplan; ?></label>
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
         
            <div class="form-group col-md-6">
            <div class="row">
                <h5 style="margin-left:10px;font-weight: bold;">Select Rate Type</h5>           
              <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                  <input type="radio" class="flat rate_type" data-val="specialoffer/add_rate_type" data-room-id="<?php echo $room_list[0]->supplier_room_list_id; ?>" data-hotel-id="<?php echo $hotel_id; ?>" onclick="add_rate_type(this)"  name="rate_type" value="PPPN" checked="checked">
              <i></i> Per Person Per Night (PPPN)
              </label> 
             </div>   
              <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                  <input type="radio" class="flat rate_type" data-room-id="<?php echo $room_list[0]->supplier_room_list_id; ?>" data-hotel-id="<?php echo $hotel_id; ?>" data-val="specialoffer/add_rate_type" onclick="add_rate_type(this)"  name="rate_type" value="PRPN">
              <i></i> Per Room Per Night (PRPN)
              </label> 
             </div>
             </div> 
             </div>              
             </div>
           <div id="add_rate_type">
           <div class="row">
             <div class="form-group col-md-3">
              <label class="strong" for="adult_rate">Adult Rate: </label>  
             <input name="adult_rate" id="adult_rate" type="text"  class="form-control checkzero deciNum" placeholder="Adult Rate" required="required" />
               </div> 
          <!--       <div class="form-group col-md-3">
              <label class="strong" for="child_rate">Child Rate: </label>  
             <input name="child_rate" id="child_rate" type="text"  class="form-control checkzero deciNum" placeholder="Child Rate" required="required" />
               </div>  -->
             <?php 
                $child_agerange=json_decode($room_list[0]->child_agerange,true);                 
                if(!empty($child_agerange[0]))
                {                    
                  foreach ($child_agerange as $key => $value)
                  { 
                    $val=explode('||', $value);   
              ?>  
                <div class="form-group col-md-3">
              <label class="strong" for="child_rate">Child Rate ( Age : <?php echo $val[0].' - '.$val[1]; ?> ) </label>  
             <input name="child_rate[]" id="child_rate" type="text"  class="form-control checkzero deciNum" placeholder="Child Rate" required="required" />
               </div>
               <?php } } else { ?>
                  <div class="form-group col-md-3">
              <label class="strong" for="child_rate">Child Rate ( Age : 0 - 11 ) </label>  
             <input name="child_rate[]" id="child_rate" type="text"  class="form-control checkzero deciNum" placeholder="Child Rate" required="required" />
               </div>
               <?php  } ?>
               </div>
               <div class="row">
               <div class="form-group col-md-3">
                  <label class="strong" for="min_room_occupancy">Min room occupancy for this rate: </label>            
                 <select name="min_room_occupancy" id="min_room_occupancy" class="form-control select2" required="required">
                    <option value="">Select Min room occupancy for this rate</option>
                    <option value="1">1</option>
                     <?php for($i=2;$i<=$room_list[0]->minperson;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
                <div class="form-group col-md-3">
                    <label class="strong" for="max_room_occupancy">Max room occupancy for this rate: </label>               
                    <select name="max_room_occupancy" id="max_room_occupancy" class="form-control select2" required="required">
                    <option value="">Select Max room occupancy for this rate</option>
                     <option value="1">1</option>
                     <?php for($i=2;$i<=$room_list[0]->maxperson;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?> 
                  </select>                 
               </div> 
           </div>
              <div class="row">
                <div class="form-group col-md-3">
                  <label class="strong" for="extra_bed_for_adults">Extra bed for Adults: </label> 
                  <input type="hidden" id="total_extrabed" value="<?php echo $room_list[0]->total_extrabed;?>">      
                <select name="extra_bed_for_adults" id="extra_bed_for_adults" class="form-control select3" required="required"> 
                    <option value="">Select Extra bed for Adults</option>
                    <?php for($i=0;$i<=$room_list[0]->extrabed_adults;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
                <div class="form-group col-md-3">
                    <label class="strong" for="extra_bed_for_child">Extra bed for Child: </label>           
                  <select name="extra_bed_for_child" id="extra_bed_for_child" class="form-control select3" required="required"> 
                    <option value="">Select Extra bed for Child</option>
                    <?php for($i=0;$i<=$room_list[0]->extrabed_child;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
               <div class="form-group col-md-3">
                  <label class="strong" for="extra_bed_for_adults_rate">Adults rate for Extra bed: </label>  
                <input name="extra_bed_for_adults_rate" id="extra_bed_for_adults_rate" type="text"  placeholder="Adults rate for Extra bed" class="form-control" required="required" />
               </div> 
                <div class="form-group col-md-3">
                    <label class="strong" for="extra_bed_for_child_rate">Child rate for Extra bed: </label>  
                  <input name="extra_bed_for_child_rate" id="extra_bed_for_child_rate" type="text"  placeholder="Child rate for Extra bed" class="form-control" required="required" />
               </div> 
              </div>
           </div>
            <div class="row  border_row"></div>
              <div class="row border_row">
              <div class="form-group col-md-6">
             <label class="strong">Cancellation Policy (Days Before and Rates)</label>  
            </div> 
            <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="checkbox" class="flat"  id="non_refundable"  name="non_refundable" value="non_refundable">
              <i></i> Non Refundable
              </label>               
              </div> 
             
             </div>
            <div id="add_policy_group">
            <div class="row  border_row policy_row">
             <div class="form-group col-md-6"></div>
            <div class="form-group col-md-6">
                <a href="#"  onclick="addPolicy(event);" class="btn btn-success btn-xs" data-original-title="Add Policy"><i class="fa fa-check"></i> Add Policy</a>
                <a href="#"  onclick="removePolicy(event);" class="btn btn-danger btn-xs" data-original-title="Delete Policy"><i class="fa fa-times"></i> Delete Policy</a>
              </div>
              </div>
           <div class="row  border_row policy_row">
            <div class="form-group col-md-3">
               <label class="strong">Cancellation Rate Type</label>  
               </div> 
              <div class="form-group col-md-3">
            <label class="strong">No of Days(Note : <span style="color: red;">Unique</span>)</label>  
            </div>
              <div class="form-group col-md-4">
                <label class="strong">Percentage / Individual Night Charge</label>  
              </div> 
              
              
            </div> 
           <div class="row  border_row policy_row">
              <div class="form-group col-md-3">
               <select name="cancel_rates_type[]" class="form-control cancel_rates_type" onchange="cancel_rates_type(this)" required="required">
                <option value="">Select</option>
                 <option value="percentage">Percentage</option> 
                 <option value="fixed">Individual Night Charge</option>
                 <option value="fullstay">Full Stay Charge</option>
               </select>
               </div> 
              <div class="form-group col-md-3">
          
                <input type="text" name="days_before[]"  class="form-control days_before"  placeholder="No of Days" required="required"/>
                
              </div>
              <div class="form-group col-md-3">
                <input type="text" name="cancel_rates[]"  class="form-control cancel_rates" placeholder="Percentage / Individual Night Charge" required="required"/>
              </div> 
                         
            </div>          
             </div>
         


            <?php if($specialoffer_type[0]->id==1 && $specialoffer_type[0]->type=="Discount"){ ?> 
             <div class="row border_row">
               <div class="form-group col-md-6"> 
                <label class="strong">Special Offer Type : Discount</label> 
               </div>
               </div>
               <div class="row border_row">
               <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat discount_rate_type"   name="discount_rate_type" value="net" checked="checked">
              <i></i> NET Discount 
              </label>               
              </div> 
              <div class="form-group col-md-6 check_icon">                 
            <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat discount_rate_type"   name="discount_rate_type" value="gross">
              <i></i> GROSS Discount 
              </label>
               </div>                 
                </div>
              <div class="row  border_row">
                <div class="form-group col-md-3"> 
                <label class="strong">Enter Discount Percentage(%)</label> 
                 </div>
                <div class="form-group col-md-3">
                <input type="text" name="discount_percentage"  class="form-control deciNum"  placeholder="Discount Percentage" required="required"/>
               </div>
             </div> 
            <?php }  else if($specialoffer_type[0]->id==2 && $specialoffer_type[0]->type=="Early bird"){ ?> 
                <div class="row border_row">
                   <div class="form-group col-md-6"> 
                      <label class="strong">Special Offer Type : Early Bird</label> 
                   </div>
                </div> 

                <div class="row border_row">
                  <div class="form-group col-md-3"></div> 
                  <div class="form-group col-md-3" id="prior_checkin">
                       <input type="text" name="prior_checkin"  class="form-control Num"  placeholder="No of Prior Checkin Days" required="required"/>
                  </div>
                  <div class="form-group col-md-6 check_icon">                 
                    <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                      <input type="radio" class="flat prior_day_type"   name="prior_day_type" value="prior_checkin" checked="checked">
                      <i></i> Prior Checkin Days
                  </label> 
                  </div>
                </div>

                <div class="row border_row">
                 <div class="form-group col-md-3"></div> 
                 <div class="form-group col-md-3" id="prior_checkin_date"></div> 
                 <div class="form-group col-md-6 check_icon">                 
                   <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                           <input type="radio" class="flat prior_day_type" name="prior_day_type" value="prior_checkin_date">
                           <i></i> Select Prior Booking Date
                      </label>
                </div>
               </div>

              <div class="row border_row">
                <div class="form-group col-md-6" id="period"></div>  
                <div class="form-group col-md-6 check_icon">                 
                   <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                       <input type="radio" class="flat prior_day_type"   name="prior_day_type" value="period">
                         <i></i> Select Prior Booking Period
                 </label>
                </div> 
              </div>

              <div class="row border_row">
                <div class="form-group col-md-3 check_icon">                 
                    <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                          <input type="radio" class="flat discount_rate_type"   name="discount_rate_type" value="net" checked="checked">
                          <i></i> NET Discount 
                  </label>               
              </div> 
              <div class="form-group col-md-3 check_icon">                 
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                        <input type="radio" class="flat discount_rate_type"   name="discount_rate_type" value="gross">
                        <i></i> GROSS Discount 
                    </label>
               </div>               
               <div class="form-group col-md-3"> 
                     <label class="strong">Enter Discount Percentage(%)</label> 
                </div>
                <div class="form-group col-md-2">
                     <input type="text" name="discount_percentage"  class="form-control deciNum"  placeholder="Discount Percentage" required="required"/>
                </div>
                <div class="form-group col-md-1"></div>
              </div> 

            <?php } else if($specialoffer_type[0]->id==3 && $specialoffer_type[0]->type=="Stay Pay"){ ?> 
               <div class="row border_row">
               <div class="form-group col-md-6"> 
                <label class="strong">Special Offer Type : Stay Pay</label> 
               </div>
               </div>
              <!--   <div class="row  border_row policy_row">
                <div class="form-group col-md-4"> 
                <label class="strong">Enter Number of Prior Checkin Days</label> 
                 </div>
                <div class="form-group col-md-3">
                <input type="text" name="prior_checkin"  class="form-control Num"  placeholder="No of Prior Checkin Days" required="required"/>
               </div>
             </div> -->
               <div class="row border_row">
                  <div class="form-group col-md-3"></div> 
                  <div class="form-group col-md-3" id="prior_checkin">
                       <input type="text" name="prior_checkin"  class="form-control Num"  placeholder="No of Prior Checkin Days" required="required"/>
                  </div>
                  <div class="form-group col-md-6 check_icon">                 
                    <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                      <input type="radio" class="flat prior_day_type"   name="prior_day_type" value="prior_checkin" checked="checked">
                      <i></i> Prior Checkin Days
                  </label> 
                  </div>
                </div>

                <div class="row border_row">
                 <div class="form-group col-md-3"></div> 
                 <div class="form-group col-md-3" id="prior_checkin_date"></div> 
                 <div class="form-group col-md-6 check_icon">                 
                      <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                           <input type="radio" class="flat prior_day_type" name="prior_day_type" value="prior_checkin_date">
                           <i></i> Select Prior Booking Date
                      </label>
                </div>
               </div>

              <div class="row border_row">
                <div class="form-group col-md-6" id="period"></div>  
                <div class="form-group col-md-6 check_icon">                 
                   <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                       <input type="radio" class="flat prior_day_type"   name="prior_day_type" value="period">
                         <i></i> Select Prior Booking Period
                 </label>
                </div> 
              </div>

               <div class="row  border_row">
                <div class="form-group col-md-4"> 
                <label class="strong">Min number of stay days</label> 
               
                <input type="text" name="min_no_of_stay_day"  class="form-control Num"  placeholder="Min number of stay days" required="required"/>
               </div>
             
                <div class="form-group col-md-4"> 
                <label class="strong">Max number of stay days</label> 
                
                <input type="text" name="max_no_of_stay_day"  class="form-control Num"  placeholder="Max number of stay days" required="required"/>
               </div>             
                <div class="form-group col-md-4"> 
                <label class="strong">No of free nights</label> 
               
                <input type="text" name="no_of_stay_free_nights"  class="form-control Num"  placeholder="No of free nights" required="required"/>
               </div>
             </div>

              
            <?php }  else if($specialoffer_type[0]->id==4 && $specialoffer_type[0]->type=="Supplement"){ ?> 
               <div class="row border_row">
               <div class="form-group col-md-6"> 
                <label class="strong">Special Offer Type : Supplement</label> 
               </div>
               </div>
              <div class="row border_row">
               <div class="form-group col-md-2">
                <label class="strong">Compulsory</label> 
               </div>
               <div class="form-group col-md-5 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat supplement_compulsory"   name="supplement_compulsory" value="Yes"  checked="checked">
              <i></i> Yes
              </label>               
              </div> 
              <div class="form-group col-md-5 check_icon">                 
            <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat supplement_compulsory"   name="supplement_compulsory" value="No">
              <i></i> No 
              </label> 

          </div>                 
                </div>
                <div class="row  border_row">
                <div class="form-group col-md-3"> 
                <label class="strong">Type of Supplement</label> 
                 </div>
                <div class="form-group col-md-3">
                <select name="type_of_supplement" class="form-control select2" required="required">
                <option value="">Select Type of Supplement</option>
              <option value="extra_charge"> Extra Charges (on top of rate)</option>
              <option value="full_charge">Full Charge</option>
                </select>
               </div>              
             </div>
               <div class="row  border_row">
                <div class="form-group col-md-4"> 
                <label class="strong">Age limits for Supplement</label> 
               
                <input type="text" name="age_limit_for_supplement"  class="form-control Num"  placeholder="Age limits for supplement" required="required"/>
               </div>
             
                <div class="form-group col-md-4"> 
                <label class="strong">Supplement Rate</label>
                
                <input type="text" name="supplement_rate"  class="form-control deciNum"  placeholder="Supplement Rate" required="required"/>
               </div>   
               </div>
               <div class="row  border_row">          
                <div class="form-group col-md-12"> 
                <label class="strong">Decription of Supplement</label> 
                <textarea name="supplement_desc" class="form-control" rows="5"  placeholder="Decription of Supplement" required="required"></textarea>
               </div>
             </div>

              
            <?php } ?> 
    
              <div class="row">  
              <div class="form-group col-md-4"></div> 
              <div class="form-group col-md-2" style="padding-top: 23px;">
                 <input  class="btn btn-success" type="button"  onclick="add_rates(this);" value="Add Rates" /><a href="<?php echo site_url()?>specialoffer/add" class="btn btn-primary">Back</a>
               </div>
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
 <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/wysihtml5-0.3.0.min.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/bootstrap-wysihtml5.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/adapters/jquery.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/custom/specialoffercustomize.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<script>
  $(document).ready(function() {
    $(".select2").select2({});  
  });
</script>
<script type="text/javascript"> 
$(".prior_day_type").on('change',function(){
  $prior_day_type=$(this).val();

   $.ajax({
                    url: site_url + 'specialoffer/prior_day_type',
                    data: {prior_day_type:$prior_day_type},
                    dataType: 'json',
                    type: 'POST',                   
                    success: function(data)
                    {      
                          if(data.result != '') 
                          {  
                           if($prior_day_type=="prior_checkin")
                            {                              
                              $("#prior_checkin").html(data.result); 
                              $("#prior_checkin_date").html('');
                              $("#period").html(''); 
                            }
                            if($prior_day_type=="prior_checkin_date")
                            {
                              $("#prior_checkin").html(''); 
                              $("#prior_checkin_date").html(data.result);
                              $("#period").html('');  
                            }
                            if($prior_day_type=="period")
                            {
                              $("#prior_checkin").html(''); 
                              $("#prior_checkin_date").html('');
                              $("#period").html(data.result);
                            }     
                          
                          } 
                          else
                          {

                          }
                                               
                    }
               });  
 
});




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
  function addPolicy(e) {
    e.preventDefault();
    if($('#add_policy_group').find('.policy_row').length < 11) {
      $('#add_policy_group').append('<div class="row  border_row policy_row">'+
          '<div class="form-group col-md-3">'+
               '<select name="cancel_rates_type[]" class="form-control cancel_rates_type" onchange="cancel_rates_type(this)" required="required">'+
               '<option value="">Select</option>'+
                 '<option value="percentage">Percentage</option>'+ 
                 '<option value="fixed">Individual Night Charge</option>'+
                 '<option value="fullstay">Full Stay Charge</option>'+
               '</select>'+
               '</div>'+  
              '<div class="form-group col-md-3">'+          
                '<input type="text" name="days_before[]" class="form-control days_before"  placeholder="No of Days" required="required"/>'+
              '</div>'+
              '<div class="form-group col-md-3">'+
            '<input type="text" name="cancel_rates[]"  class="form-control cancel_rates"   placeholder="Percentage / Individual Night Charge" required="required"/>'+
              '</div>'+                                       
            '</div>');
    }
    return false;
  }
  
  function removePolicy(e) {
    e.preventDefault();
    if($('#add_policy_group').find('.policy_row').length > 3) {
      $('#add_policy_group').find('.policy_row:last').remove();
    }
    return false;
  }
</script>

 <script type="text/javascript">  
 $(document).ready( function() { 
 $("#non_refundable").on('click', function(){
    if($("#non_refundable:checked").length!=0)
    {
       $("#add_policy_group").css('display','none');
       $(".cancel_rates").prop("required",false);
       $(".days_before").prop("required",false);
       $(".cancel_rates_type").prop("required",false);
   
    }
    else
    {
       $(".cancel_rates").prop("required",true);
       $(".days_before").prop("required",true);
       $(".cancel_rates_type").prop("required",true);
       $("#add_policy_group").css('display','block');
    }
 });
});

  function cancel_rates_type(t)
  {
    // alert("Hi "+$(t).val());
    var Num=/^(0|[1-9][0-9]*)$/;   
    var deciNum= /^[0-9]+(\.\d{1,3})?$/; 
    $cancel_rates=$(t).closest('.policy_row').find(".cancel_rates");
    $days_before=$(t).closest('.policy_row').find(".days_before");

    if($(t).val()=="percentage")
    { 
          
          $cancel_rates.prop('type','text'); 
          if(parseFloat($cancel_rates.val())>100)
          {
              // alert("Percentage Cann't be Greater Than 100 !!!!")
              $cancel_rates.val('');              
              $cancel_rates.focus();
          }
         if(!Num.test($days_before.val()))
         {
                // alert("Enter Numberic  Value for "+$days_before.attr('placeholder'));
                $days_before.val('');
                $days_before.focus();
                return false;
         }
         if(!deciNum.test($cancel_rates.val()))
         {
                // alert("Enter Either Numberic  or Decimal Value for "+$cancel_rates.attr('placeholder'));
                $cancel_rates.val('');
                $cancel_rates.focus();
                return false;
         }
      
    }
    else  if($(t).val()=="fixed")
    {
       
        $cancel_rates.prop('type','text');  
         if(!Num.test($days_before.val()))
         {
                // alert("Enter Numberic  Value for "+$days_before.attr('placeholder'));
                $days_before.val('');
                $days_before.focus();
                return false;
          }
         if(!deciNum.test($cancel_rates.val()))
         {
                // alert("Enter Either Numberic  or Decimal Value for "+$cancel_rates.attr('placeholder'));
                $cancel_rates.val('');
                $cancel_rates.focus();
                return false;
         }   
    }
    else  if($(t).val()=="fullstay")
    {
       $cancel_rates.val('0');
       $cancel_rates.prop('type','hidden');  
       if(!Num.test($days_before.val()))
       {
              // alert("Enter Numberic  Value for "+$days_before.attr('placeholder'));
              $days_before.val('');
              $days_before.focus();
              return false;
        }   
    }    
  }
</script>

