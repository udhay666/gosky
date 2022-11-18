<?php $this->load->view('home/header'); ?>
<section class="section-padding inner-page">
   <div class="container">
      <div class="row mt-5">
         <div class="col-md-12">
            <div class="itinerary-container box-shadow">
               <div class="searchHdr2">Confirm Cancellation</div>
               <div class="white-container">
                  <div class="table-responsive">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th>Booking Id</th>
                              <th>Hotel Reference Id</th>
                              <th>Total Amount</th>
                              <th>Cancellation Amount</th>
                              <th>Refund Amount</th>
                              <th>Message</th>
                              <th>Cancel Confirm</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td><?php echo $uniqueRefNo; ?></td>
                              <td><?php echo $Booking_RefNo; ?></td>
                              <td><?php echo number_format($total_cost); ?></td>
                              <td><?php echo number_format($cancellation_charge); ?></td>
                              <td><?php echo number_format($refund_amount); ?></td>
                              <td><?php echo $message; ?></td>
                              <td>
                                 <?php if($message != 'Failed') { ?>
                                 <a class="hotel_cancel" href="<?php echo site_url(); ?>hotels/confrimCancelVoucher/<?php echo base64_encode($Api_Name); ?>/<?php echo $uniqueRefNo; ?>/<?php  echo $Booking_RefNo; ?>">Confirm Cancel</a>
                                 <?php } else { ?>
                                    Cancellation not applicable
                                 <?php } ?>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?php $this->load->view('home/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>

<script class="secret-source">
$(document).ready(function($) {
 $('.hotel_cancel').on('click',function() {
   if(confirm("Are you sure you want to cancel the booking.")) {
     // window.open($(this).attr('data-val'), 'mywin','left=20,top=20,width=1000,height=800,toolbar=1,resizable=0');  
     return true;
   } else {
     return false;
   }
 });   
});
</script>