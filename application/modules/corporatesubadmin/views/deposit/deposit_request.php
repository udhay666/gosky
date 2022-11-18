<?php $this->load->view('home/header'); ?>
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
        <form action="<?php echo site_url();?>corporatesubadmin/deposit_request" method="post" enctype="multipart/form-data" class="form-horizontal" data-parsley-validate>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2">Deposit Request</div>
            <div class="white-container">
              <div class="row">
                <div class="col-md-3">
                  <label>Corporate Number:</label>
                  <input type="text" class="form-control form-group " placeholder="<?php echo $agent_info->agent_no; ?>" readonly disabled="">
                </div>
                <div class="col-md-3">
                  <label>Available</label>
                  <input type="text" class="form-control form-group " placeholder="<?php if(!empty($agent_deposit_details)) echo $agent_deposit_details[0]->available_balance; else echo '0.00'; ?>" disabled="" readonly>
                </div>
                <div class="col-md-3">
                  <label>Deposit Amount:<span class="red">*</span></label>
                  <input type="text" class="form-control form-group " name="amount" value="<?php if(isset($amount))echo $amount; ?>" required />
                </div>
                <div class="col-md-3">
                  <label>Transaction Modes:<span class="red">*</span></label>
                  <select class="form-control form-group" name="transaction_mode" required onchange="paymenttype(this.value)">
                    <option value="">Select Transaction Mode</option>
                    <option value="cash">Cash</option>
                    <option value="payment">Credit / Debit Card</option>
                    <option value="cheque">Cheque/DD</option>
                  </select>
                </div>
              </div>
              <div class="showinghide">
                <div class="row ">
                  <div class="col-md-3">
                    <label>Date of Deposit:<span class="red">*</span></label>
                    <input type="text" class="form-control form-group past_dp required" value="<?php if(isset($value_date)) echo $value_date; ?>" name="value_date" autocomplete="off" required>
                  </div>
                  <div class="col-md-3">
                    <label>Bank:<span class="red">*</span></label>
                    <input type="text" class="form-control form-group required" name="bank" value="<?php if(isset($bank)) echo $bank; ?>" required>
                  </div>
                  <div class="col-md-3">
                    <label>Branch:<span class="red">*</span></label>
                    <input type="text" class="form-control form-group required" name="branch" value="<?php if(isset($branch)) echo $branch; ?>" required>
                  </div>
                  <div class="col-md-3">
                    <label>City:<span class="red">*</span></label>
                    <input type="text" class="form-control form-group required" name="city" value="<?php if(isset($city)) echo $city; ?>" required>
                  </div>
                  <div class="col-md-3">
                    <label>Transaction Id/Cheque No:<span class="red">*</span></label>
                    <input type="text" class="form-control form-group required" name="transaction_id" value="<?php if(isset($transaction_id)) echo $transaction_id; ?>" required>
                  </div>
                  <div class="col-md-3">
                    <label>Remarks:</label>
                    <input type="text" class="form-control form-group" name="remarks" value="<?php if(isset($remarks)) echo $remarks; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary">Send Request <i class="mdi mdi-send"></i></button>
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
          <div class="searchHdr2">Deposit / Transaction Summary</div>
          <div class="white-container">
            <div class="table-responsive">
              <table id="datatable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>SI.No</th>
                    <th>Narration</th>
                    <th>Transfer Date</th>
                    <th>Deposit Amount</th>
                    <th>Withdraw Amount</th>
                    <th>Balance</th>
                    <th>Bank</th>
                    <th>Branch</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($agent_deposit_details)) { ?>
                  <?php for ($i = 0; $i < count($agent_deposit_details); $i++) { ?>
                  <tr>
                    <td><?php echo $i + 1; ?></td>
                    <td><?php echo $agent_deposit_details[$i]->transaction_summary ; ?></td>
                    <td><?php echo date("d-m-Y", strtotime($agent_deposit_details[$i]->value_date)); ?></td>
                    <td><?php echo $agent_deposit_details[$i]->deposit_amount; ?></td>
                    <td><?php echo $agent_deposit_details[$i]->withdraw_amount; ?></td>
                    <td><?php echo $agent_deposit_details[$i]->available_balance; ?></td>
                    <td><?php echo $agent_deposit_details[$i]->bank; ?></td>
                    <td><?php echo $agent_deposit_details[$i]->branch; ?></td>
                    <td class="text-danger"><?php echo $agent_deposit_details[$i]->status ; ?></td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>
<!-- Data table strart -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/datatables/datatables.min.css"/>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/datatables/datatablesInit.js"></script>
<script>
  function paymenttype($select){
    if($select=='payment'){
      $('.showinghide').hide();
      $('.required').removeAttr('required');
    }else{
      $('.showinghide').show();
      $('.required').attr('required');
    }
  }
</script>