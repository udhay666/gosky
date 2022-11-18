<?php $this->load->view('home/header'); ?>
<section class="section-padding inner-page">
  <div class="container">
    <?php $this->load->view('booking_header'); ?>
    <div class="row">
      <div class="col-lg-12 col-md-12 mx-auto">
        <form action="<?php echo site_url();?>corporatesubadmin/my_bookings/cabs" method="get" enctype="multipart/form-data" class="form-horizontal" data-parsley-validate>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2">Filter Reports</div>
            <div class="white-container">
              <div class="row">
                <div class="col-md-3">
                  <label>From Date:</label>
                  <input type="text" value="<?php if(isset($_GET['fromdate'])) echo $_GET['fromdate'] ?>" class="form-control form-group past_dp1" name="fromdate" placeholder="" autocomplete="off">
                </div>
                <div class="col-md-3">
                  <label>To Date:</label>
                  <input type="text" value="<?php if(isset($_GET['todate'])) echo $_GET['todate'] ?>" class="form-control past_dp2" name="todate" placeholder="" autocomplete="off">
                </div>
                <div class="col-md-3">
                  <label>Booking Status:</label>
                  <select name="status" class="form-control">
                    <option value="">Select</option>
                    <option value="Confirmed" <?php if(isset($_GET['status']) && $_GET['status'] == 'Confirmed') echo 'selected' ?>>Confirmed</option>
                    <option value="Failed" <?php if(isset($_GET['status']) && $_GET['status'] == 'Failed') echo 'selected' ?>>Failed</option>
                    <option value="Cancel" <?php if(isset($_GET['status']) && $_GET['status'] == 'Cancel') echo 'selected' ?>>Cancelled</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label>Booking ID:</label>
                  <input type="text" value="<?php if(isset($_GET['bookingid'])) echo $_GET['bookingid'] ?>" class="form-control form-group " name="bookingid" placeholder="" >
                </div>
                <div class="col-md-3">
                  <label>Email:</label>
                  <input type="email" value="<?php if(isset($_GET['email'])) echo $_GET['email'] ?>" class="form-control form-group " name="email" placeholder="" >
                </div>
                <div class="col-md-3">
                  <label>Mobile:</label>
                  <input type="text" value="<?php if(isset($_GET['mobile'])) echo $_GET['mobile'] ?>" class="form-control form-group " name="mobile" placeholder="" >
                </div>
                <div class="col-md-3" style="border:0;">
                  <label class="d-block invisible">Submit</label>
                  <button type="submit" class="btn btn-secondary">Filter Search <i class="mdi mdi-filter-outline"></i></button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 mx-auto">
        <div class="itinerary-container box-shadow">
          <div class="searchHdr2">Booking Reports</div>
          <div class="white-container">
            <div class="table-responsive">
              <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <th>#</th>
                  <th>Booking Date</th>
                  
                  <th>UniqueRefNo</th>
                  <th>BookingRefId</th>
                  <th>Ticket Number</th>
                  <th>Booking Status</th>
                  <th>Booking Date</th>
                  <th>PickUp Location</th>
                  <th>DropOff Location</th>
                  <th>PickUpDate</th>
                  <th>PickUpTime</th>
                  <th>#Days</th>
                  <th> TravelType</th>
                  <th>TripType</th>
                  <th>Source City</th>

                  <th>Destination City</th>
                  <th>Night Halt</th>
                  <th>DriverCharges</th>

                  <th>Oneway perkmrate</th>
                  <th>Approx Distance</th>
                  <th>Perkm</th>
                  <th>Vehicle</th>



                  <th>Total Price</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php if (!empty($car_booking_summary)) { 
                    //print_r($car_booking_summary) ;?>
                  <?php for ($j = 0; $j < count($car_booking_summary); $j++) { ?>
                  <tr>
                    <td><?php echo $j + 1; ?></td>
                    <td><?php echo $car_booking_summary[$j]->Booking_Date; ?></td>
                    <td><?php echo $car_booking_summary[$j]->uniqueRefNo; ?></td>
                    <td><?php echo $car_booking_summary[$j]->BookingRefId; ?></td>
                    <td><?php echo $car_booking_summary[$j]->Ticket_Number; ?></td>

                    <td><?php echo $car_booking_summary[$j]->BookingStatus; ?></td>
                    <td><?php echo $car_booking_summary[$j]->Booking_Date; ?></td>
                    <td><?php echo $car_booking_summary[$j]->PickUp_Location; ?></td>
                    <td><?php echo $car_booking_summary[$j]->DropOff_Location; ?>
                      
                    </td>
                    <td><?php echo $car_booking_summary[$j]->PickUpDate; ?>
                      
                    </td>
                    <td><?php echo $car_booking_summary[$j]->PickUpTime; ?>
                      
                    </td>
                    <td><?php echo $car_booking_summary[$j]->noDays; ?>
                      
                    </td>
                    <td><?php echo $car_booking_summary[$j]->travelType; ?>
                      
                    </td>
                    <td><?php echo $car_booking_summary[$j]->trip_type; ?>
                      
                    </td>
                    <td><?php echo $car_booking_summary[$j]->source_city; ?>
                      
                    </td>
                    <td><?php echo $car_booking_summary[$j]->destination_city; ?>
                      
                    </td>
                    <td><?php echo $car_booking_summary[$j]->night_halt; ?>
                      
                    </td>
                    <td><?php echo $car_booking_summary[$j]->driver_charges; ?>
                      
                    </td>
                    <td><?php echo $car_booking_summary[$j]->oneway_perkmrate; ?>
                      
                    </td>
                    <td><?php echo $car_booking_summary[$j]->approx_distance; ?>
                      
                    </td>
                    <td><?php echo $car_booking_summary[$j]->perkm; ?>
                      
                    </td>
                    
                    
                    <td><?php echo $car_booking_summary[$j]->vehicle; ?>
                      
                    </td>
                    <td><?php echo $car_booking_summary[$j]->total_amount; ?>
                      
                    <td>
                             <?php $RefIDs = array_filter(explode(',',$car_booking_summary[$j]->BookingRefId)); ?>
                            <a class="badge badge-success" target="_blank" href="<?php echo site_url(); ?>car/car_eticket/<?php echo $car_booking_summary[$j]->uniqueRefNo; ?>/<?php  if(!empty($RefIDs)) { echo implode('/',$RefIDs); } else { echo ''; }   ; ?>"><i class="mdi mdi-ticket"></i>E-Ticket</a>
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
<?php $this->load->view('home/footer'); ?>

<!-- Data table strart -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/datatables/datatables.min.css"/>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/datatables/datatablesInit.js"></script>