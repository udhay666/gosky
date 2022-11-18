<?php $this->load->view('header'); ?>
<?php  $this->load->view('left_panel'); ?>
<?php  $this->load->view('top_panel'); ?>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css" />
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>Holiday Booking Report</h3>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <form action="<?php echo site_url(); ?>/holiday/holiday_booking_report/" class="" method="Get">
                     <table  class="table">
                        <tbody>
                           <tr>
                              <td>Package Name:</td>
                              <td >
                                 <input type="text" class="form-control" name="package_title"  value="<?php if(isset($package_title) && $package_title!='') echo $package_title; ?>">
                              </td>
                              <td>User Id:</td>
                              <td >
                                 <input type="text" class="form-control" name="user_id"  value="<?php if(isset($user_id) && $user_id!='') echo $package_title; ?>">
                              </td>
                              <td>Agent Id:</td>
                              <td >
                                 <input type="text" class="form-control" name="agent_id"  value="<?php if(isset($agent_id) && $agent_id!='') echo $package_title; ?>">
                              </td>
                           </tr>
                           <tr>
                              <!--  <td>Package Code:</td>
                                 <td align="center">
                                     <input type="text" class="form-control" name="package_code"  value="<?php if(isset($package_code) && $package_code!='') echo $package_code; ?>">
                                 </td> -->  
                              <!--  <td align="center">Promotional Code:</td>
                                 <td align="center">
                                     <input type="text" class="form-control" name="promo_code"  value="<?php if(isset($promo_code) && $promo_code!='') echo $promo_code; ?>">
                                 </td>  -->                              
                           </tr>
                           <tr>
                              <td>Passenger First Name:</td>
                              <td>
                                 <input type="text" class="form-control" name="first_name"  value="<?php if(isset($first_name) && $first_name!='') echo $first_name; ?>">
                              </td>
                              <td align="center">Passenger Last Name:</td>
                              <td align="center">
                                 <input type="text" class="form-control" name="last_name"  value="<?php if(isset($last_name) && $last_name!='') echo $last_name; ?>">
                              </td>
                           </tr>
                           <tr>
                              <td>Unique Ref No.</td>
                              <td>
                                 <input type="text" class="form-control" name="uniqueRefNo"  value="<?php if(isset($uniqueRefNo) && $uniqueRefNo!='') echo $uniqueRefNo; ?>">
                              </td>
                              <td align="center">Mobile No:</td>
                              <td align="center">
                                 <input type="text" class="form-control" name="user_mobile"  value="<?php if(isset($user_mobile) && $user_mobile!='') echo $user_mobile; ?>">
                              </td>
                           </tr>
                           <tr>
                              <td>Email</td>
                              <td>
                                 <input type="text" class="form-control" name="user_email"  value="<?php if(isset($user_email) && $user_email!='') echo $user_email; ?>">
                              </td>
                              <td align="center">Booking Status:</td>
                              <td align="center">
                                 <select name="booking_status" class="form-control">
                                    <option value="">Select</option>
                                    <option value="1" <?php if($booking_status=='Success') echo 'Selected'; ?>>Success</option>
                                    <option value="Cancelled" <?php if($booking_status=='Cancelled') echo 'Selected'; ?>>Cancelled</option>
                                 </select>
                              </td>
                           </tr>
                           <!--  <?php if ($this->admin_auth->is_admin()) { ?>
                              <tr>
                              <td>Assign To</td>
                                <td colspan="3">
                                <select  name="assignto" class="assignto form-control">
                                <option value="">Select</option>
                                <?php for($k=0;$k<count($subadmin);$k++){?>
                                 <option value="<?php echo $subadmin[$k]->admin_id; ?>" <?php if($subadmin[$k]->admin_id==$assignto){ echo 'selected'; }?>><?php echo $subadmin[$k]->login_email; ?></option>
                                <?php } ?>               
                              </select></td>
                              </tr>
                              <?php } ?>  -->
                           <tr>
                              <!-- <td>Enter Date:</td>
                                 <td>
                                     <input type="text" class="form-control" name="from_date" data-date-format="YYYY-MM-DD" class="datepick" placeholder="From date" id="dpfd" value="<?php if(isset($from_date) && $from_date!='') echo $from_date; ?>" autocomplete="off">
                                 </td>
                                 <td>
                                     <input type="text" class="form-control"  name="to_date" data-date-format="YYYY-MM-DD" class="datepick" placeholder="To date" id="dptd" value="<?php if(isset($to_date) && $to_date!='') echo $to_date; ?>" autocomplete="off">
                                 </td> -->
                              <td> <input type="submit" class="btn btn-success btn btn-primary btn-register" value="SUBMIT" ></td>
                           </tr>
                        </tbody>
                     </table>
                  </form>
                  <ul class="nav nav-tabs navbar-left nav-dark">
                     <li class="active"><a href="#home2" data-toggle="tab"><strong>Holiday Booking Report</strong></a></li>
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
                  <div class="tab-content mb30" style="overflow:hidden">
                     <?php if (!empty($holi_booking_report)) { ?>
                     <div class="table-responsive">
                        <div class="double-scroll">
                           <table  id="datatable1" class="table table-striped table-bordered">
                              <thead>
                                 <tr>
                                    <th>SI.No</th>
                                    <th>User Id</th>
                                    <th>Agent Id</th>
                                    <th>Unique Ref No.</th>
                                    <th>Package Name</th>
                                    <th>Invoice Number</th>
                                    <th>Package Duration</th>
                                    <th>Title</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Mobile No</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Postel Code</th>
                                    <th>No of Adults</th>
                                    <th>No of Childs</th>
                                    <th>No of Infants</th>
                                    <th>Arrival Date</th>
                                    <th>Departure Date</th>
                                    <!-- <th>Promotional Code</th> -->
                                    <!-- <th>Net Package Amount</th> -->
                                    <!-- <th>Discount Amount</th> -->
                                    <th>Total Package Amount</th>
                                    <th>Received Amount</th>
                                    <th>Balance Amount</th>
                                    <th>Pending Amount</th>
                                    <th>Booking Date & Time</th>
                                    <th>Booking Voucher</th>
                                    <th>Booking Status</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php for ($i = 0; $i < count($holi_booking_report); $i++) { ?>
                                 <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->user_id; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->agent_id; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->uniqueRefNo; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->package_title; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->invoice_number; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->holiday_duration; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->title; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->first_name; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->middle_name; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->last_name; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->user_email; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->user_mobile; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->address; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->user_city; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->user_pincode; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->adults_no; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->childs_no; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->infants_no; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->arrival_date; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->depart_date; ?></td>
                                    <!-- <td><?php echo $holi_booking_report[$i]->promo_code; ?></td> -->
                                    <td><?php echo $holi_booking_report[$i]->package_cost; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->received_amount; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->balance_amount; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->pending; ?></td>
                                    <!-- <td><?php echo $holi_booking_report[$i]->discount_amount; ?></td> -->
                                    <!-- <td><?php echo $holi_booking_report[$i]->package_amount; ?></td> -->
                                    <td><?php echo $holi_booking_report[$i]->booking_datetime; ?></td>
                                    <td><a href="<?php echo site_url(); ?>/holiday/voucher?referId=<?php echo $holi_booking_report[$i]->uniqueRefNo; ?>" title="Click here to go Voucher" data-rel="tooltip" class="btn btn-success" target="_blank">Voucher</a>
                                    </td>
                                    <td><?php if($holi_booking_report[$i]->booking_status == 1){
                                       echo 'Success';}else{ echo 'Cancelled';} ?> </td>
                                    <td><?php if($holi_booking_report[$i]->booking_status=='1'){ ?>
                                       <a href="<?php echo site_url(); ?>/holiday/cancelholidaybooking/<?php echo $holi_booking_report[$i]->holiday_booking_id; ?>" title="Click here to Cancel the Booking" data-rel="tooltip" onclick="return confirm('Do you really want to Cancel the Booking .?\nKindly confirm Below Details.....\nPackage Name : <?php echo $holi_booking_report[$i]->package_title; ?>\nUser Full Name : <?php echo $holi_booking_report[$i]->title.' '.$holi_booking_report[$i]->first_name.' '.$holi_booking_report[$i]->middle_name.' '.$holi_booking_report[$i]->last_name; ?>\nUser Mobile No : <?php echo $holi_booking_report[$i]->user_mobile; ?>\nUser Email : <?php echo $holi_booking_report[$i]->user_email; ?>\nBooking Amount : <?php echo $holi_booking_report[$i]->package_amount; ?>\nBooking Date : <?php echo $holi_booking_report[$i]->booking_datetime; ?>')" class="btn btn-danger" >Cancel</a>
                                       <?php } ?>
                                    </td>
                                 </tr>
                                 <?php } ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <?php } else { ?>
                     <div class="table-responsive">
                        <div class="double-scroll">
                           <table  id="datatable2" class="table table-striped table-bordered">
                              <thead>
                                 <tr>
                                    <th>SI.No</th>
                                    <?php if ($this->admin_auth->is_admin()) { ?>
                                    <th>Assign to </th>
                                    <?php } ?>
                                    <th>Unique Ref No.</th>
                                    <th>Package Name</th>
                                    <th>Package Code</th>
                                    <th>Package Duration</th>
                                    <th>Title</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Mobile No</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Postel Code</th>
                                    <th>No of Adults</th>
                                    <th>No of Childs</th>
                                    <th>No of Infants</th>
                                    <th>Accommodation Type</th>
                                    <th>No of Single Sharing</th>
                                    <th>No of Twin Sharing</th>
                                    <th>No of Triple Sharing</th>
                                    <th>Total Room</th>
                                    <th>Arrival Date</th>
                                    <th>Promotional Code</th>
                                    <th>Net Package Amount</th>
                                    <th>Discount Amount</th>
                                    <th>Total Package Amount</th>
                                    <th>Booking Date & Time</th>
                                    <th>Booking Voucher</th>
                                    <th>Booking Status</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <div class="alert alert-error">
                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                    <strong>Error!</strong>
                                    No Data Found. Please try after some time...
                                 </div>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <?php } ?>
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
<?php  $this->load->view('footer'); ?>
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
</body>
</html>
<!-- My Custom JS-->
<!-- <script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script> -->
<script>
   $(document).ready(function() {
   $('#promo_id').click(function(e) {
   e.preventDefault();
   var promocheck = new Array();
   var promouncheck = new Array();
   $('.promo:checked').each(function() {
   promocheck.push($(this).val());
   });
   $('.promo:checkbox:not(:checked)').each(function() {
   //var  check=$(this).val();
   promouncheck.push($(this).val());
   //console.log($(this).val());
   //alert(check);
   });
   alert(promouncheck);
   $.ajax({
   type: "POST",
   url: "<?php echo site_url(); ?>/holiday/promo_hol",
   dataType: 'html',
   data: {message: promocheck,message1: promouncheck},
   success: function(data) {
   alert('Promotional Holiday Added Successfully');
   // window.location.reload();
   }
   });
   });
   });
</script>
<script>
   $(document).ready(function() {
   $('#rec_id').click(function(e) {
   //alert('fhj');
   e.preventDefault();
   var reccheck = new Array();
   var recuncheck = new Array();
   $('.rec:checked').each(function() {
   reccheck.push($(this).val());
   });
   $('.rec:checkbox:not(:checked)').each(function() {
   recuncheck.push($(this).val());
   });
   //console.log(reccheck);
   $.ajax({
   type: "POST",
   url: "<?php echo site_url(); ?>/holiday/rec_hol",
   dataType: 'html',
   data: {message: reccheck,message1: recuncheck},
   success: function(data) {
   alert('Recommended Holiday Added Successfully');
   window.location.reload();
   }
   });
   });
   });
</script>
<script>
   $(document).ready(function() {
   $('#dome').click(function(e) {
   //alert('fhj');
   e.preventDefault();
   var domcheck = new Array();
   var domuncheck= new Array();
   $('.dome:checked').each(function() {
   //var  check=$(this).val();
   domcheck.push($(this).val());
   //console.log($(this).val());
   //alert(check);
   });
   $('.dome:checkbox:not(:checked)').each(function() {
   domuncheck.push($(this).val());
   });
   //console.log(reccheck);
   alert(domuncheck);
   $.ajax({
   type: "POST",
   url: "<?php echo site_url(); ?>/holiday/dome_hol",
   dataType: 'html',
   data: {message: domcheck,message1:domuncheck},
   success: function(data) {
   alert('Domestic Holiday Added Successfully');
   window.location.reload();
   }
   });
   });
   });
</script>
<script>
   $(document).ready(function() {
   $('#inter').click(function(e) {
   //alert('fhj');
   e.preventDefault();
   var intcheck = new Array();
   var interuncheck = new Array();
   $('.inter:checked').each(function() {
   //var  check=$(this).val();
   intcheck.push($(this).val());
   });
   $('.inter:checkbox:not(:checked)').each(function() {
   interuncheck.push($(this).val());
   });
   //console.log(reccheck);
   $.ajax({
   type: "POST",
   url: "<?php echo site_url(); ?>/holiday/inter_hol",
   dataType: 'html',
   data: {message: intcheck,message1: interuncheck},
   success: function(data) {
   alert('International Holidays Added Successfully');
   window.location.reload();
   }
   });
   });
   });
</script>
<script>
   $(document).ready(function() {
   $('#subpage_rec').click(function(e) {
   // alert('subpage_rec');
   e.preventDefault();
   var intcheck = new Array();
   var interuncheck = new Array();
   $('.subpage_rec:checked').each(function() {
   //var  check=$(this).val();
   intcheck.push($(this).val());
   });
   $('.subpage_rec:checkbox:not(:checked)').each(function() {
   interuncheck.push($(this).val());
   });
   //console.log(reccheck);
   $.ajax({
   type: "POST",
   url: "<?php echo site_url(); ?>/holiday/subpage_rec",
   dataType: 'html',
   data: {message: intcheck,message1: interuncheck},
   success: function(data) {
   alert('SubPage Recommended Holidays Successfully');
   window.location.reload();
   }
   });
   });
   });
</script>
<script>
   $(document).ready(function() {
   $('#holiday_thm').click(function(e) {
   // alert('subpage_rec');
   e.preventDefault();
   var intcheck = new Array();
   var interuncheck = new Array();
   $('.holiday_thm:checked').each(function() {
   //var  check=$(this).val();
   intcheck.push($(this).val());
   //console.log($(this).val());
   });
   $('.holiday_thm:checkbox:not(:checked)').each(function() {
   interuncheck.push($(this).val());
   });
   //console.log(reccheck);
   alert(interuncheck);
   $.ajax({
   type: "POST",
   url: "<?php echo site_url(); ?>/holiday/holiday_thm",
   dataType: 'html',
   data: {message: intcheck,message1: interuncheck},
   success: function(data) {
   alert('Holidays Themes added Successfully');
   window.location.reload();
   }
   });
   });
   });
</script>
<script type="text/javascript">
   $(document).ready(function() {
   $('#reservation').daterangepicker(null, function(start, end, label) {
   console.log(start.toISOString(), end.toISOString(), label);
   });
   });
</script>
<script type="text/javascript">
   $('#dpfd').daterangepicker({
   singleDatePicker: true,
   format: 'YYYY-MM-DD',
   calender_style: "picker_3"
   });
   $('#dptd').daterangepicker({
   singleDatePicker: true,
   format: 'YYYY-MM-DD',
   calender_style: "picker_3"
   });
   
   function assignto(t,id,uniqueRefNo)
   {
   
   var email=t.options[t.selectedIndex].innerHTML;
   if(email=='Select'){
   if(confirm("Are you sure ? You don't want assign to any one")) {
   $.ajax({
   url: '<?php echo site_url();?>' + '/holiday/assignto',
   data: 'assignto='+t.value+'&id='+id+'&uniqueRefNo='+uniqueRefNo+'&email='+'',
   dataType: 'json',
   type: 'POST',
   success: function(data)
   {                
   
   window.location.href=location.href;
   
   }
   });
   }
   }
   else if(confirm('Are you sure ? You want assign to '+email+' for this Booking('+uniqueRefNo+')')) {
   $.ajax({
   url: '<?php echo site_url();?>' + '/holiday/assignto',
   data: 'assignto='+t.value+'&id='+id+'&uniqueRefNo='+uniqueRefNo+'&email='+email,
   dataType: 'json',
   type: 'POST',
   success: function(data)
   {                
   
   window.location.href=location.href;
   
   }
   });
   }
   }
   
   $(document).ready(function() {
   $(".assignto").select2({
   placeholder: "Select Assign To",
   allowClear: true
   });
   });
</script>
</body>
</html>