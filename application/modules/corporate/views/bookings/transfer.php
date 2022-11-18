<?php $this->load->view('home/header'); ?>
<section class="section-padding inner-page">
  <div class="container">
    <?php $this->load->view('booking_header'); ?>
    <div class="row">
      <div class="col-lg-12 col-md-12 mx-auto">
        <form action="<?php echo site_url();?>corporate/my_bookings/transfer" method="get" enctype="multipart/form-data" class="form-horizontal" data-parsley-validate>
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
                  <th>Booking ID</th>
                  <th>UniqueRefNo</th>
                  <th>BookingRefNo</th>
                  <th>BookingStatus</th>
                  <th>CityName</th>
                  <th>ConfirmationNo</th>
                  <th>InvoiceCreatedOn</th>
                  <th>PickUpName</th>
                  <th>  PickUpDetailName</th>
                  <th>  PickUpDate</th>
                  <th>DropOffName</th>
                  <th>DropOffDetailName</th>
                  <th>AdultCount</th>
                  <th>ChildCount</th>
                  <th>InvoiceNo</th>
                  <th>VehicalName</th>
                  <th>VehicleCode</th>
                  <th>BasePrice</th>
                  <th>CurrencyCode</th>

                  <th>TotalFare</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php if (!empty($transfer_booking_summary)) { //print_r($get_b2b_transfer_booking_summary) ;?>
                  <?php for ($j = 0; $j < count($transfer_booking_summary); $j++) { ?>
                  <tr>
                    <td><?php echo $j + 1; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->TransferDate; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->BookingId; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->uniqueRefNo; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->BookingRefNo; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->BookingStatus; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->CityName; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->ConfirmationNo; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->InvoiceCreatedOn; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->PickUpName; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->PickUpDetailName; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->PickUpDate; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->DropOffName; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->DropOffDetailName; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->AdultCount; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->ChildCount; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->InvoiceNo; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->VehicalName; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->VehicleCode; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->BasePrice; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->CurrencyCode; ?></td>
                    <td><?php echo $transfer_booking_summary[$j]->TotalFare; ?></td>
                     <?php $RefIDs = array_filter(explode(',',
                      $transfer_booking_summary[$j]->BookingId)); 


                     ?>
                        <td>
                            
                            <a class="badge badge-success" target="_blank" href="<?php echo site_url(); ?>transfer/transfer_eticket/<?php echo $transfer_booking_summary[$j]->uniqueRefNo; ?>/<?php  if(!empty($RefIDs)) { echo implode('/',$RefIDs); } else { echo ''; }   ; ?>"><i class="mdi mdi-ticket"></i>E-Ticket</a>
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