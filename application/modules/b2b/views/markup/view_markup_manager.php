
<?php $this->load->view('home/home_template/header'); ?>

<style>
   .add_markup{
      padding-left: 240px;
   }
   
</style>
<section class="section-padding inner-page">
   <div class="container">
      <?php $message = isset($message) ? $message : $this->session->flashdata('message'); ?>
       <?php if(!empty($message)) { ?>
       <div class="row">
         <div class="col-lg-12">
           <div class="alert alert-block alert-warning">
             <a href="#" data-dismiss="alert" class="close">×</a>
             <h5 class="mb-0 text-center text-danger"><?php echo $message; ?></h5>
           </div>
         </div>
       </div>
       <?php } ?>
      <div class="row">
         <div class="col-lg-12 col-md-12 mx-auto">
            <div class="itinerary-container box-shadow add_markup">
            <hr>
               <div ><h3>Add/Update Markup</h3></div>
               <hr>
               <div>&nbsp;</div>
               <div class="white-container">
                  <form class="form-horizontal" action="<?php echo site_url(); ?>b2b/add_markup" method="post"  data-parsley-validate>
                     <div class="row">
                        <div class="col-md-3">b2b Number:</div>
                        <div class="col-md-4">
                           <input type="text" class="form-control form-group" placeholder="<?php echo $this->session->agent_no;?>" readonly disabled="">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-3">Service Type:<span class="red">*</span></div>
                        <div class="col-md-4">
                           <select class="form-control form-group" name="service_type" required>
                              <option value="">Select</option>
                              <option value="1">Hotels</option>
                              <option value="2">Flight</option>
                              <!-- <option value="5">Holidays</option> -->
                           </select>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-3">Markup Process:<span class="red">*</span></div>
                        <div class="col-md-4">
                           <select class="form-control form-group" name="markup_process" id="markup_process" required>
                              <option value="">Select Markup Process</option>
                              <option value="1">Percentage</option>
                              <option value="2">Fixed</option>
                           </select>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-3">Markup Value:<span class="red">*</span> </div>
                        <div class="col-md-4 markup_p">
                           <input type="text" name="markup" class="form-control form-group" value="<?php if(isset($markup))echo $markup; ?>" placeholder="Markup Value" required>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-4">
                           <input type="submit" class="btn btn-secondary" value="Add/Edit Markup">
                        </div>
                     </div>
                  </form>
               </div>
            </div>
           
            <div class="itinerary-container box-shadow">
               <hr>
               <div class="searchHdr2">Markup Reports</div>
               <hr>
               <div class="white-container">
                  <div class="table-responsive">
                     <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>SI.No</th>
                              <th>Service Type</th>
                              <th>Markup Process</th>
                              <th>Markup Value</th>
                              <th>Status</th>
                              <th>Created DateTime</th>
                              <!-- <th>Action</th> -->
                           </tr>
                        </thead>
                        <tbody>
                           <?php  //echo '<pre>';print_r($agent_markup_manager);exit; ?>
                           <?php if (!empty($agent_markup_manager)) { ?>
                           <?php for ($i = 0; $i < count($agent_markup_manager); $i++) { ?>
                           <tr>
                              <td><?php echo $i + 1; ?></td>
                              <td><?php if($agent_markup_manager[$i]->service_type == 1) echo 'Hotels'; elseif($agent_markup_manager[$i]->service_type == 2) echo 'Flights'; ?></td>
                              <td><?php if($agent_markup_manager[$i]->markup_process==1) echo 'Percentage'; else echo 'Fixed'; ?></td>
                              <td><?php echo $agent_markup_manager[$i]->markup; ?></td>
                              <td><?php if($agent_markup_manager[$i]->status == 1) echo 'Active'; else echo 'In-active' ?></td>
                              <td><?php echo $agent_markup_manager[$i]->updated_datetime; ?></td>
                            <!--  <td>
                                  <a href="<?php //echo site_url() ?>/b2b/markup_status/<?php //echo $agent_markup_manager[$i]->markup_id; ?>/<?php //echo $agent_markup_manager[$i]->status; ?>">
                                    <?php //if($agent_markup_manager[$i]->status == 1) echo 'De-activate'; else echo 'Activate' ?>
                                 </a> 
                              </td> -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>

<!-- Data table strart -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/datatables/datatables.min.css"/>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/datatables/datatablesInit.js"></script>