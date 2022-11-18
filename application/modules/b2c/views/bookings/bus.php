<?php $this->load->view('home/header');
       // echo '<pre/>';print_r($data);exit;
 ?>

<section class="section-padding inner-page">
   <div class="container">
      <?php $this->load->view('booking_header'); ?>
      <div class="row">
          <div class="col-lg-12 col-md-12 mx-auto">
            <!-- <form action="<?php echo site_url();?>b2b/my_bookings/bus" method="get" enctype="multipart/form-data" class="form-horizontal" data-parsley-validate>
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
                      <input type="text" value="<?php if(isset($_GET['todate'])) echo $_GET['todate'] ?>" class="form-control form-group past_dp2" name="todate" placeholder="" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                      <label>PNR:</label>
                      <input type="text" value="<?php if(isset($_GET['pnr'])) echo $_GET['pnr'] ?>" class="form-control form-group" name="pnr" placeholder="" >
                    </div>
                    <div class="col-md-3">
                      <label>Booking Status:</label>
                      <select name="status" class="form-control form-group">
                        <option value="">Select</option>
                        <option value="ticketed" <?php if(isset($_GET['status']) && $_GET['status'] == 'ticketed') echo 'selected' ?>>Ticketed</option>
                        <option value="failed" <?php if(isset($_GET['status']) && $_GET['status'] == 'failed') echo 'selected' ?>>Failed</option>
                        <option value="cancel" <?php if(isset($_GET['status']) && $_GET['status'] == 'cancel') echo 'selected' ?>>Cancelled</option>
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
                    <div class="col-md-2">
                      <label>Mobile:</label>
                      <input type="text" value="<?php if(isset($_GET['mobile'])) echo $_GET['mobile'] ?>" class="form-control form-group " name="mobile" placeholder="" >
                    </div>
                     <div class="col-md-2">
                      <label>referal Code:</label>
                      <input type="text" value="<?php if(isset($_GET['promotional_code'])) echo $_GET['promotional_code'] ?>" class="form-control form-group " name="mobile" placeholder="" >
                    </div>
                    <div class="col-md-2" style="border:0;">
                      <label class="d-block invisible">Submit</label>
                      <button type="submit" class="btn btn-secondary">Filter Search <i class="mdi mdi-filter-outline"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </form> -->
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
                    <th>SI.No</th>
                    <th>Unique RefNo</th>
                    <!-- <th>PNR #</th>  -->
                    <th>Ticket Number</th>
                    <th>Status</th>
                    <th>Booking Date</th>
                    <th>Boarding PointName</th>
                    <th>Departure PointName</th>
                    <th>Boarding DateTime</th>
                    <th>Departure DateTime</th>   
                    <!-- <th>Promotional Code</th>   
                    <th>Promotional Discount</th>   
                    <th>Referal Code</th>   
                    <th>Referal Discount</th>   --> 
                    <!-- <th>Adults</th>
                    <th>Childs</th>
                    <th>Infants</th>
                    <th>TravelName</th>        --> 
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Email</th>                                           
                    <th>Seats</th>                                                   
                    <th>TotalFare</th>
                    <th>E-Ticket</th>
                    </thead>
                    <tbody>

                       <?php //echo '<pre>vd';print_r($bus_booking_summary);exit;
        
                       if (!empty($bus_booking_summary)) { ?>
                        <?php for ($j = 0; $j < count($bus_booking_summary); $j++) { ?>
                       <tr>
                       <td><?php echo $j + 1; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->booking_unique_reference_no; ?></td>
                        <!-- <td><?php //echo $bus_booking_summary[$j]->pnr; ?></td> -->
                        <td><?php echo $bus_booking_summary[$j]->Ticket_no; ?></td> 
                        <td><?php echo $bus_booking_summary[$j]->booking_status; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->booking_date; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->BCityPointName; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->DCityPointName; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->BCityPointTime; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->DCityPointTime; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->pass_name; ?></td>
                        <td><?php if($bus_booking_summary[$j]->pass_title == 'Mr'){
                          echo 'Male';}else{'Female';} ?></td>
                        <td><?php echo $bus_booking_summary[$j]->pass_age; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->pass_address; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->phone; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->email; ?></td>
                        <!-- <td><?php echo $bus_booking_summary[$j]->promotional_Code; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->promotional_discount; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->referal_code; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->referal_discount; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->Adults; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->Childs; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->Infants; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->TravelName; ?></td> -->
                        <td><?php echo $bus_booking_summary[$j]->seat_no; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->total_fare; ?></td>
                        <?php $RefIDs = array_filter(explode(',',$bus_booking_summary[$j]->booking_unique_reference_no)); ?>
                        <td>
                            <a target="_blank" href="<?php echo site_url(); ?>bus/bus_eticket/<?php echo $bus_booking_summary[$j]->booking_unique_reference_no; ?>/<?php  if(!empty($RefIDs)) { echo implode('/',$RefIDs); } else { echo ''; }   ; ?>">E-Ticket</a>
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