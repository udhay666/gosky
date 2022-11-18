<?php $this->load->view('home/header'); ?>
<section class="section-padding inner-page">
  <div class="container">
    <?php //$this->load->view('booking_header'); ?>
    <div class="row">
      <div class="col-lg-12 col-md-12 mx-auto">
    <!--     <form action="<?php echo site_url();?>corporate/my_bookings/hotels" method="get" enctype="multipart/form-data" class="form-horizontal" data-parsley-validate>
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
                  <label>Booking Status:</label>
                  <select name="status" class="form-control form-group">
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
        </form> -->
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 mx-auto">
        <div class="itinerary-container box-shadow">
          <div class="searchHdr2">User Management</div>
          <div class="white-container">
            <div class="table-responsive">
              <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                 <thead>
                              <tr>
                                <th>SI.No</th> 
                                <th>Agency Logo</th>                              
                                <th>Agent No</th>
                                <th>Agent Id</th>                         
                                <th>Agency Name</th>
                                <th>Email</th>                                 
                                <th>Mobile</th>
                                <th>City</th>
                                <th>Register DateTime</th>
                                <th>Account Balance</th>
                                <th>Status</th>
                                <th>Actions</th>
                                <th>Download Bookings</th>
                              </tr>
                            </thead>
                  <tbody>
                                            <?php //echo '<pre>';print_r($agent_info);exit; 
                                            if(!empty($agent_info)) {?>
                                            <?php for($i=0;$i<count($agent_info);$i++) {?>
                                            <tr>
                                              <td><?php echo $i+1;?></td>
                                              <td class="table-image">
                                                <a class="preview fancy" href="<?php echo $agent_info[$i]->agent_logo;?>">
                                                  <img title="<?php echo $agent_info[$i]->agency_name;?>" alt="" src="<?php echo $agent_info[$i]->  agent_logo;?>" height="60" width="60">
                                                </a>
                                              </td>
                                              <td><?php echo $agent_info[$i]->agent_no;?></td>
                                              <td><?php echo $agent_info[$i]->agent_id; ?></td>
                                              <td class="center"><?php echo $agent_info[$i]->agency_name;?></td>
                                              <td class="center"><?php echo $agent_info[$i]->agent_email;?></td>             
                                              <td class="center"><?php echo $agent_info[$i]->mobile_no;?></td>
                                              <td class="center"><?php echo $agent_info[$i]->city;?></td>
                                              <td class="center"><?php echo $agent_info[$i]->register_date;?></td>
                                              <td> <?php
                                                $agent_bal = $this->Corporate_Model->get_available_balance($agent_info[$i]->agent_id);
                                                if($agent_bal != '')
                                                  echo $agent_info[$i]->currency_type.' '.$agent_bal;
                                                else
                                                  echo $agent_info[$i]->currency_type.' 0.00'
                                                ?></td>
                                                <td class="center">
                                                  <?php if($agent_info[$i]->status == 0) { ?>
                                                  <span class="label label-inactive">Inactive</span>
                                                  <?php } else if($agent_info[$i]->status == 1) {?>
                                                  <span class="label label-success">Active</span>
                                                  <?php } else if($agent_info[$i]->status == 2) { ?>
                                                  <span class="label label-important">Blocked</span>
                                                  <?php } else {?>
                                                  <span class="label label-warning">Pending</span>
                                                  <?php } ?>
                                                </td>
                                                <td class="center">
                                                  <a class=" manageStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-agent-id="<?php echo $agent_info[$i]->agent_id;?>" >
                                                    <span class="glyphicon glyphicon-ok-sign"></span>                                    
                                                  </a>
                                                  <a class=" manageStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-agent-id="<?php echo $agent_info[$i]->agent_id;?>" >                   
                                                    <img alt="" src="<?php echo base_url();?>public/img/icons/fugue/busy.png">                                    
                                                  </a>
                                                  <a class=" manageStatus" href="javascript:void(0);" title="Delete / Block" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="2" data-agent-id="<?php echo $agent_info[$i]->agent_id;?>" >
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                  </a>
                                                  <a class=" " href="<?php echo site_url(); ?>/corporate/view_agent_info/<?php echo $agent_info[$i]->agent_id;?>" title="View / Edit" data-rel="tooltip">
                                                    <span class="fa fa-pencil"></span>                                                  
                                                  </a>
                                                  <a class="tip btn btn-mini btn-small" href="<?php echo site_url(); ?>corporate/view_account_stmt/<?php echo $agent_info[$i]->agent_id;?>" title="View Account" data-rel="tooltip">
                                                   <img alt="" src="<?php echo base_url();?>admin/public/img/icons/essen/16/bank.png">
                                                 </a>
                                               </td>
                                               <td class="center">
                                                <a data-original-title="Click to download Flights reports in excel" href="<?php echo site_url(); ?>/corporate/download/flights/<?php echo $agent_info[$i]->agent_id;?>">Flights</a>
                                                <a data-original-title="Click to download hotel reports in excel" href="<?php echo site_url(); ?>/corporate/download/Hotels/<?php echo $agent_info[$i]->agent_id;?>">Hotels</a>
                                                <a data-original-title="Click to download Holidays reports in excel" href="<?php echo site_url(); ?>/corporate/download/Holidays/<?php echo $agent_info[$i]->agent_id;?>">Holidays</a>
                                              </td>
                                            </tr>
                                            <?php } ?>
                                            <?php } else { ?>
                                            <div class="alert alert-block alert-danger">
                                              <a href="#" data-dismiss="alert" class="close">×</a>
                                              <h4 class="alert-heading">Errors!</h4>
                                              No Data Found. Please try after some time...
                                            </div>                               
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