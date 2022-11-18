<?php $this->load->view('home/home_template/header'); ?>
<section class="section-padding inner-page">
   <div class="container">
      <?php if (validation_errors() && validation_errors() != "") { ?>
      <div class="row mb-5">
         <div class="col-lg-12 col-md-12">
            <div class="alert alert-danger">
               <button class="close" data-dismiss="alert" type="button">X</button>
               <?php echo validation_errors() ?>
            </div>
         </div>
      </div>
      <?php } ?>
      <?php if(!empty($hotel_booking_summary)) { ?>
      <div class="row mb-5">
         <div class="col-md-12">
            <div class="itinerary-container box-shadow">
               <div class="searchHdr2">Ticket Summary</div>
               <div class="white-container">
                  <div class="table-responsive">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th>SI.No</th>
                              <th>Booking No</th>
                              <th>Hotel Reference Id</th>
                              <th>Hotel Name</th>
                              <th>City</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Ph No</th>
                              <th>Booking Date</th>
                              <th>Total Price</th>
                              <th>Status</th>
                              <th>Ticket</th>
                              <th>Cancel Ticket</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php for ($i = 0; $i < count($hotel_booking_summary); $i++) { ?>
                           <tr>
                              <td><?php echo $i + 1; ?></td>
                              <td><?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?></td>
                              <td><?php echo $hotel_booking_summary[$i]->Booking_RefNo; ?></td>
                              <td><?php echo $hotel_booking_summary[$i]->hotel_name; ?></td>
                              <td><?php echo $hotel_booking_summary[$i]->hotel_city; ?></td>
                              <td><?php echo $hotel_booking_summary[$i]->title . ' ' . $hotel_booking_summary[$i]->first_name. ' ' . $hotel_booking_summary[$i]->last_name; ?></td>
                              <td><?php echo $hotel_booking_summary[$i]->email; ?></td>
                              <td><?php echo $hotel_booking_summary[$i]->mobile; ?></td>
                              <td><?php echo $hotel_booking_summary[$i]->Booking_Date; ?></td>
                              <td><?php echo number_format($hotel_booking_summary[$i]->total_cost); ?></td>
                              <td><?php echo $hotel_booking_summary[$i]->Booking_Status; ?></td>
                              <td>
                                 <a href="<?php echo site_url(); ?>hotels/voucher?voucherId=<?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?>&hotelRefId=<?php echo $hotel_booking_summary[$i]->Booking_RefNo; ?>" target="_blank">E-Ticket</a>
                              </td>
                              <td>
                                 <?php if( $hotel_booking_summary[$i]->Cancellation_Status == 'Cancelled') { ?>
                                 <span>Ticket Already Cancelled</span>
                                 <?php } ?>
                                 <?php if( $hotel_booking_summary[$i]->Cancellation_Status == 'Initiated') { ?>
                                 <span>Cancellation In Progress</span>
                                 <?php } ?>
                                 <?php if( $hotel_booking_summary[$i]->Cancellation_Status == 'Failed') { ?>
                                 <span>Cancellation Failed</span>
                                 <?php } ?>
                                 <?php
                                    if(
                                       ($hotel_booking_summary[$i]->Cancellation_Status == '' 
                                       && $hotel_booking_summary[$i]->Cancellation_Status != 'Cancelled' 
                                       && $hotel_booking_summary[$i]->Cancellation_Status != 'Failed' 
                                       && $hotel_booking_summary[$i]->Cancellation_Status != 'Initiated')

                                       && ($hotel_booking_summary[$i]->Booking_Status == 'Success' 
                                       || $hotel_booking_summary[$i]->Booking_Status == 'Confirmed' 
                                       || $hotel_booking_summary[$i]->Booking_Status == 'CONFIRMED')
                                    ) {
                                 ?>
                                 <?php if($hotel_booking_summary[$i]->Api_Name=="travelguru") { ?>
                                 <a class="hotel_cancel" href="<?php echo site_url(); ?>hotels/beforeCancelVoucher/<?php echo base64_encode($hotel_booking_summary[$i]->Api_Name); ?>/<?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?>/<?php  echo $hotel_booking_summary[$i]->Booking_RefNo; ?>">Initiate Cancellation</a>
                                 <?php } ?>
                                 <?php } ?>
                              </td>
                           </tr>
                           <?php } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php } ?>
      <?php if(!empty($no_records)) { ?>
      <div class="row mb-5">
         <div class="col-lg-12 col-md-12 text-center">
            <div class="alert alert-danger">
               <h5>Sorry,No bookings found for this Booking Id. <a href="<?php echo base_url(); ?>home/ticket_support">Go Back</a></h5>
            </div>
         </div>
      </div>
      <?php } ?>
      <?php if(empty($hotel_booking_summary)) { ?>
      <div class="row">
         <div class="col-lg-5 col-md-5 mx-auto">
            <div class="itinerary-container box-shadow">
               <div class="searchHdr2">Print / Cancel Ticket</div>
               <div class="white-container">
                  <form class="form-signin" action="<?php echo site_url() ?>home/print_ticket" method="post" data-parsley-validate>
                     <div class="row form-group">
                        <div class="col-sm-12 text-center">
                           <label class="radio-custom checkbox-custom-sm">
                              <input type="radio" name="service_type" value="1" checked required><i></i>
                              <span>Hotel</span>
                           </label>
                           <!-- <label class="radio-custom checkbox-custom-sm">
                              <input type="radio" name="service_type" value="2"><i></i>
                              <span>Flight</span>
                           </label> -->
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-sm-12">
                           <label>Booking Id</label>
                           <input type="text" value="<?php if(isset($uniqueRefNo)) echo $uniqueRefNo ?>" class="form-control" name="uniqueRefNo" required>
                           <small class="text-info">Our booking unique reference id</small>
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-sm-12">
                           <label>Email</label>
                           <input type="email" value="<?php if(isset($user_email)) echo $user_email ?>" class="form-control" name="user_email" required>
                           <small class="text-info">Your booking email</small>
                        </div>
                     </div>
                     
                     <div class="row form-group">
                        <div class="col-sm-12">
                           <label>Mobile No</label>
                           <input type="text" value="<?php if(isset($user_mobile)) echo $user_mobile ?>" class="form-control" name="user_mobile" required>
                           <small class="text-info">Your booking mobile no</small>
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-sm-12">
                           <button type="submit" class="btn btn-secondary btn-block">SUBMIT</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <?php } ?>
   </div>
</section>
<?php $this->load->view('home/home_template/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>