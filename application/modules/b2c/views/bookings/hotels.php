<?php $this->load->view('home/home_template/header'); ?>
<section class="section-padding inner-page">
  <div class="container">
    <?php $this->load->view('booking_header'); ?>
    <div class="row">
      <div class="col-lg-12 col-md-12 mx-auto">
        <div class="itinerary-container box-shadow">
        <hr>
          <div ><h4>Booking Reports<h4></div>
          <hr>
          <div class="white-container">
            <div class="table-responsive">
              <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <th>#</th>
                  <th>Booking Date</th>
                  <th>Booking ID</th>
                  <th>Hotel PNR</th>
                  <th>Hotel Name</th>
                  <th>Hotel City</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>CheckIn</th>
                  <th>CheckOut</th>
                  <th>Guests</th>
                  <th>Rooms</th>
                  <th>Status</th>
                  <th>Total Price</th>
                  <th>Days Left</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php if (!empty($hotel_booking_summary)) { ?>
                  <?php for ($j = 0; $j < count($hotel_booking_summary); $j++) { ?>
                  <?php
                    $now = time();
                    $then = strtotime($hotel_booking_summary[$j]->check_in);
                    $difference = $then - $now;
                    $days = (floor($difference / (60*60*24) ) + 1);
                    if($hotel_booking_summary[$j]->Booking_Status == 'Confirmed') {
                      if($days > 0){
                        $left_day = $days.' days left';
                        $cancellation = 1;
                        $class = 'warning';
                      } elseif($days == 0){
                        $left_day = 'Check-in today';
                        $cancellation = 1;
                        $class = 'danger';
                      } else {
                        $left_day = 'Completed';
                        $cancellation = 2;
                        $class = 'success';
                      }
                    } else {
                      $left_day = 'Cancelled';
                      $class = 'danger';
                      $cancellation = 0;
                    }

                    if($hotel_booking_summary[$j]->Cancellation_Status == 'Cancelled'){
                      $cancellation = 0;
                      $left_day = 'Cancelled';
                      $class = 'danger';
                    }
                  ?>
                  <tr>
                    <td><?php echo $j + 1; ?></td>
                    <td><?php echo date('d M, Y',strtotime($hotel_booking_summary[$j]->Booking_Date)) ?></td>
                    <td><?php echo $hotel_booking_summary[$j]->uniqueRefNo; ?></td>
                    <td><?php echo $hotel_booking_summary[$j]->Booking_RefNo; ?></td>
                    <td><?php echo $hotel_booking_summary[$j]->hotel_name; ?></td>
                    <td><?php echo $hotel_booking_summary[$j]->hotel_city; ?></td>
                    <td><?php echo $hotel_booking_summary[$j]->title.' '.$hotel_booking_summary[$j]->first_name.' '.$hotel_booking_summary[$j]->last_name; ?></td>
                    <td><?php echo $hotel_booking_summary[$j]->email; ?></td>
                    <td><?php echo $hotel_booking_summary[$j]->mobile; ?></td>
                    <td><?php echo date('d M, Y',strtotime($hotel_booking_summary[$j]->check_in)) ?></td>
                    <td><?php echo date('d m, Y',strtotime($hotel_booking_summary[$j]->check_out)) ?></td>
                    <td><?php echo $hotel_booking_summary[$j]->adult.' Adult' ?><?php if($hotel_booking_summary[$j]->child > 0) echo '<br>'.$hotel_booking_summary[$j]->child.' Child' ?></td>
                    <td><?php echo $hotel_booking_summary[$j]->room_count; ?></td>
                    <td class="text-danger"><?php echo $hotel_booking_summary[$j]->Booking_Status; ?></td>
                    <td><i class="mdi mdi-currency-inr"></i><?php echo number_format($hotel_booking_summary[$j]->total_cost); ?></td>
                    <td class="text-<?php echo $class ?>"><b><?php echo $left_day; ?></b></td>
                    <td>
                      <a class="badge badge-success" target="_blank" href="<?php echo site_url(); ?>hotels/voucher?voucherId=<?php echo $hotel_booking_summary[$j]->uniqueRefNo; ?>&hotelRefId=<?php echo $hotel_booking_summary[$j]->Booking_RefNo; ?>"><i class="mdi mdi-ticket"></i> E-Ticket</a><br>
                      <!-- <?php
                      if($cancellation == 0){
                        echo '<b><span class="text-warning">Already Cancelled</span></b>';
                      } elseif($cancellation == 1) { ?>
                      <form action="<?php echo site_url(); ?>home/print_ticket" method="post" target="_blank">
                        <input type="hidden" name="service_type" value="1">
                        <input type="hidden" name="uniqueRefNo" value="<?php echo $hotel_booking_summary[$j]->uniqueRefNo; ?>">
                        <input type="hidden" name="user_email" value="<?php echo $hotel_booking_summary[$j]->email; ?>">
                        <input type="hidden" name="user_mobile" value="<?php echo $hotel_booking_summary[$j]->mobile; ?>">
                        <button class="badge badge-danger border-0" title="Ticket Cancellation" style="cursor: pointer;"><i class="mdi mdi-close-circle"></i> Cancel Booking</button>
                      </form>
                      <?php } elseif($cancellation == 2) { echo '<b class="text-info">Cancel NA</b>'; } ?> -->
                    </td>
                  </tr>
                  <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $this->load->view('home/home_template/footer'); ?>

<!-- Data table strart -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/datatables/datatables.min.css"/>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/datatables/datatablesInit.js"></script>