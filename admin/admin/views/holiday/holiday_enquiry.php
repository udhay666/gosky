<?php $this->load->view('header'); ?>
<?php  $this->load->view('left_panel'); ?>
<?php  $this->load->view('top_panel'); ?>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css" />
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Holiday Enquiry & Subscriber List</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <ul class="nav nav-tabs navbar-left nav-dark">
              <li class="active"><a href="#enquiry" data-toggle="tab"><strong>Holiday Enquiry Report</strong></a></li>
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
            <br>
            <div class="tab-pane active" id="enquiry">
              <?php if (!empty($holiday_enquiry)) { ?>
              <div class="table-responsive">
                <div class="double-scroll">
                  <table id="datatable1" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>SI.No</th>
                        <th>Agent Id</th>
                        <th>Request ID</th>
                        <th>Package Name</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Contact No</th>
                        <!-- <th>Message</th> -->
                        <th>Enquiry Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php for ($i = 0; $i < count($holiday_enquiry); $i++) { ?>
                      <tr>
                        <td><?php echo $i + 1; ?></td>
                        <td><?php echo $holiday_enquiry[$i]->agent_id; ?></td>
                        <td><?php echo $holiday_enquiry[$i]->id; ?></td>
                        <td><?php echo $holiday_enquiry[$i]->package_title; ?></td>
                        <td><?php echo $holiday_enquiry[$i]->fname; ?></td>
                        <td><?php echo $holiday_enquiry[$i]->email; ?></td>
                        <td><?php echo $holiday_enquiry[$i]->phone; ?></td>
                        <!-- <td><?php echo $holiday_enquiry[$i]->user_message; ?></td> -->
                        <td><?php echo $holiday_enquiry[$i]->booking_date; ?></td>
                        <td><?php if($holiday_enquiry[$i]->status == 1){ ?>
                           <a class="" href="" title="View / Edit" data-rel="tooltip" style="color: green">
                           Approved
                           <?php }else{?>
                           <a class="" href="<?php echo site_url();?>/holiday/update_holiday_enquiry_status/<?php echo $holiday_enquiry[$i]->id;?>" data-rel="tooltip" style="color: red">
                           <span class="fa fa-pencil"></span>&nbsp;Approve Booking</a>
                        </td>
                        <?php }?>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <?php } else { ?>
                <div class="table-responsive">
                  <div class="double-scroll">
                     <table   class="table table-striped table-bordered">
                        <thead>
                           <tr>
                              <th>SI.No</th>
                              <th>User Name</th>
                              <th>Email</th>
                              <th>Message</th>
                              <th>Enquiry Date</th>
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
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <ul class="nav nav-tabs navbar-left nav-dark">
              <li class="active"><a href="#miceenquiry" data-toggle="tab"><strong>Corporate Travel Booking / Enquiry </strong></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br>
            <div class="tab-pane active" id="miceenquiry">
              <div class="table-responsive">
                <div class="double-scroll">
                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>SI.No</th>
                        <th>User_Name</th>
                        <th>Company_Name</th>
                        <th>Email</th>
                        <th>Contact_No</th>
                        <!--  <th>Purpose</th>
                        <th>Destination</th>
                        <th>Month_Of_Travel</th>
                        <th>No_Of_Days</th>
                        <th>No_Of_Persons</th> -->
                        <th>Additional Information</th>
                        <th>Enquiry Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($holiday_mice_enquiry)) { ?>
                      <?php for ($i = 0; $i < count($holiday_mice_enquiry); $i++) { ?>
                      <tr>
                        <td><?php echo $i + 1; ?></td>
                        <td><?php echo $holiday_mice_enquiry[$i]->user_name; ?></td>
                        <td><?php echo $holiday_mice_enquiry[$i]->companyname; ?></td>
                        <td><?php echo $holiday_mice_enquiry[$i]->user_email; ?></td>
                        <td><?php echo $holiday_mice_enquiry[$i]->mobileno; ?></td>
                        <!--   <td><?php echo $holiday_mice_enquiry[$i]->purpose; ?></td>
                        <td><?php echo $holiday_mice_enquiry[$i]->destination; ?></td>
                        <td><?php echo $holiday_mice_enquiry[$i]->duration; ?></td>
                        <td><?php echo $holiday_mice_enquiry[$i]->noofdays; ?></td>
                        <td><?php echo $holiday_mice_enquiry[$i]->noofperson; ?></td> -->
                        <td><?php echo $holiday_mice_enquiry[$i]->addtionalinfo; ?></td>
                        <td><?php echo $holiday_mice_enquiry[$i]->enquiry__datetime; ?></td>
                      </tr>
                      <?php } ?>
                      <?php } else { ?>
                      <tr class="alert alert-error">
                        <td colspan="100%">
                          <button class="close" data-dismiss="alert" type="button">×</button>
                          <strong>Error!</strong>
                          No Data Found. Please try after some time...
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
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <ul class="nav nav-tabs navbar-left nav-dark">
              <li class="active"><a href="#subscribe" data-toggle="tab"><strong>Holiday Subscriber List</strong></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br>
            <!-- <div class="tab-pane active" id="subscribe"> -->
              <div class="table-responsive">
                <table id="datatable2" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>SI.No</th>
                      <th>Email Id</th>
                      <th>Date & Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($holiday_subcribe)) {?>
                    <?php for($i=0;$i<count($holiday_subcribe);$i++) {?>
                    <tr>
                      <td><?php echo $i+1;?></td>
                      <td><?php echo $holiday_subcribe[$i]->user_email;?></td>
                      <td><?php echo $holiday_subcribe[$i]->created;?></td>
                    </tr>
                    <?php } ?>
                    <?php } else { ?>
                    <tr class="alert alert-error">
                      <td colspan="100%">
                        <button class="close" data-dismiss="alert" type="button">×</button>
                        <strong>Error!</strong>
                        No Data Found. Please try after some time...
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php  $this->load->view('footer'); ?>