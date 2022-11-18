    <?php $this->load->view('header'); ?>
    <?php echo $this->load->view('left_panel'); ?>
    <?php echo $this->load->view('top_panel'); ?>
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css" />
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Holiday Booking Payment Report</h3>
        </div>
    </div>
    <div class="clearfix"></div>     
    <div class="row">
     <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
          <form action="<?php echo site_url(); ?>/holiday/holiday_booking_payment_report/" class="" method="Get">
                <table  class="table">
                    <tbody>
                         <tr>
                                    <td>Unique Ref No.</td>
                                    <td>
                                        <input type="text" class="form-control" name="uniqueRefNo"  value="<?php if(isset($uniqueRefNo) && $uniqueRefNo!='') echo $uniqueRefNo; ?>"></td>
                                        <td align="center">RazorPay Id</td>
                                        <td align="center">
                                            <input type="text" class="form-control" name="razorpay_id"  value="<?php if(isset($razorpay_id) && $razorpay_id!='') echo $razorpay_id; ?>"></td>
                                </tr>                 
                        <tr>                                         
                            <td>Card Id:</td>
                            <td>
                                <input type="text" class="form-control" name="card_id"  value="<?php if(isset($card_id) && $card_id!='') echo $card_id; ?>"></td>
                                <td align="center">Paid Amount:</td>
                                <td align="center">
                                    <input type="text" class="form-control" name="paid_amount"  value="<?php if(isset($paid_amount) && $paid_amount!='') echo $paid_amount; ?>"></td>
                                </tr>
                              
                                <tr>
                                    <td>Email</td>
                                    <td>
                                        <input type="text" class="form-control" name="email"  value="<?php if(isset($email) && $email!='') echo $email; ?>"></td>
                                         <td align="center">Contact No:</td>
                                   <td align="center">
                                    <input type="text" class="form-control" name="contact"  value="<?php if(isset($contact) && $contact!='') echo $contact; ?>"></td>
                                </tr>
                                <tr>
                                <td>Status:</td>
                                        <td align="center">
                                        <select name="status" class="form-control">
                                            <option value="">Select</option>
                                            <option value="captured" <?php if($status=='captured') echo 'Selected'; ?>>captured</option>
                                           <option value="Failed" <?php if($status=='Failed') echo 'Selected'; ?>>Failed</option>
                                    </tr>
                          
                                        <tr>
                                           <!--  <td>Enter Date:</td>
                                            <td>
                                                <input type="text" class="form-control" name="from_date" data-date-format="MMM DD, YYYY" class="datepick" placeholder="From date" id="dpfd" value="<?php if(isset($from_date) && $from_date!='') echo $from_date; ?>" autocomplete="off">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"  name="to_date" data-date-format="MMM DD, YYYY" class="datepick" placeholder="To date" id="dptd" value="<?php if(isset($to_date) && $to_date!='') echo $to_date; ?>" autocomplete="off">
                                            </td> -->
                                            <td colspan="4"> <input type="submit" class="btn btn-success btn btn-primary btn-register" value="SUBMIT" ></td>
                                        </tr>                                      
                                                        </tbody>
                                                    </table>
                                                </form>
                                                <ul class="nav nav-tabs navbar-left nav-dark">
                                                    <li class="active"><a href="#home2" data-toggle="tab"><strong>Holiday Booking Payment Report</strong></a></li>
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
                                                <?php if (!empty($holi_booking_payment_report)) { ?>
                                                <div class="table-responsive">
                                                    <div class="double-scroll">
                                                      <table  id="datatable1" class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                               <th>SI.No</th>
                                                               <th>Unique Ref No.</th> 
                                                               <th>razorpay_id</th>
                                                               <th>card_id</th>
                                                                <th>Amount</th>
                                                               <!-- <th>paid_amount</th> -->
                                                               <th>status</th>
                                                               <th>currency</th>
                                                               <th>Email</th>
                                                               <th>Contact No.</th>
                                                               <th>Method</th>
                                                               <th>Bank</th>
                                                             <!--   <th>created_at</th> -->        
                                                            </tr>
                                                       </thead>
                                                       <tbody>
                                                         <?php for ($i = 0; $i < count($holi_booking_payment_report); $i++) { ?>
                                                         <tr>
                                                            <td><?php echo $i + 1; ?></td>
                                                            <td><?php echo $holi_booking_payment_report[$i]->uniqueRefNo; ?></td>
                                                            <td><?php echo $holi_booking_payment_report[$i]->razorpay_id; ?></td>
                                                            <td><?php echo $holi_booking_payment_report[$i]->card_id; ?></td>
                                                            <td><?php echo $holi_booking_payment_report[$i]->amount; ?></td>
                                                            <!-- <td><?php echo $holi_booking_payment_report[$i]->paid_amount; ?></td> -->
                                                            <td><?php echo $holi_booking_payment_report[$i]->status; ?></td>
                                                            <td><?php echo $holi_booking_payment_report[$i]->currency; ?></td>
                                                            <td><?php echo $holi_booking_payment_report[$i]->email; ?></td>
                                                            <td><?php echo $holi_booking_payment_report[$i]->contact; ?></td>
                                                            <td><?php echo $holi_booking_payment_report[$i]->method; ?></td>
                                                            <td><?php echo $holi_booking_payment_report[$i]->bank; ?></td>
                                                        <!--     <td><?php
                                                            echo date("M d, Y H:i:s A", $holi_booking_payment_report[$i]->created_at); ?></td>   --> 
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
                                                               <th>Unique Ref No.</th> 
                                                               <th>razorpay_id</th>
                                                               <th>card_id</th>
                                                                <th>Amount</th>
                                                               <th>paid_amount</th>
                                                               <th>status</th>
                                                               <th>currency</th>
                                                               <th>Email</th>
                                                               <th>Contact No.</th>
                                                               <th>Method</th>
                                                               <th>Bank</th>
                                                             <!--   <th>created_at</th> -->        
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
</body>
</html>
<!-- My Custom JS-->
<script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>
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
        format: 'MMM DD, YYYY',
        calender_style: "picker_3"
    });
    $('#dptd').daterangepicker({
        singleDatePicker: true,
        format: 'MMM DD, YYYY',
        calender_style: "picker_3"
    });
</script>
</body>
</html>