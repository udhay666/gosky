<?php $this->load->view('home/header'); ?>
<section class="section-padding inner-page">
  <div class="container">
    <?php $this->load->view('booking_header'); ?>
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
                  <th>Holiday PNR</th>
                  <th>Holiday Name</th>
                  <th>Holiday City</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>CheckIn</th>
                  <th>CheckOut</th>
                  <th>Guests</th>
                  <th>Rooms</th>
                  <th>Status</th>
                  <th>Total Price</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php if (!empty($holiday_booking_summary)) { ?>
                  <?php for ($j = 0; $j < count($holiday_booking_summary); $j++) { ?>
                  <tr>
                    <td><?php echo $j + 1; ?></td>
                    
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