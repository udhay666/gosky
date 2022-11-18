<?php $this->load->view('home/header'); ?>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<section class="section-padding inner-page">
  <div class="container">
    <?php  if(!empty($agent_info)) {?>
         <h2>Deposit/Withdraw <small>Account Balance</small></h2>
          <?php } ?>
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

    <?php if(!empty($agent_info)) {?>
        <form action="<?php echo site_url();?>/b2b/add_transaction_info" method="post"  enctype="multipart/form-data" class="" data-parsley-validate>
         <?php if(validation_errors() != ""){ ?>
        <div class="alert alert-error" style="background:red;color:#fff">
          <button class="close" data-dismiss="alert" type="button">×</button>
          <?php echo validation_errors();?>
        </div>
        <?php } ?> 
          <input type="hidden" name="agent_id" value="<?php echo $agent_info->agent_id; ?>" />
          <input type="hidden" name="agent_email" value="<?php echo $agent_info->agent_email; ?>" />
          <input type="hidden" name="agent_logo" value="<?php echo $agent_info->agent_logo; ?>" />
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2">Agent Information :</div>
            <div class="white-container">
              <div class="">
                <div class="row form-group">
                  <div class="col-md-3"><label>Agent Number:</label></div>
                  <div class="col-md-4">
                    <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $agent_info->agent_no; ?>" disabled="">
              <input type="hidden" name="agent_id" value="<?php echo $agent_id; ?>" />
                    
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3"><label>Available Balance:</label></div>
                  <div class="col-md-4">
                    <input class="form-control" id="disabledInput" type="text" placeholder="<?php if(!empty($agent_acc_summary)) echo $agent_info->currency_type.' '.$agent_acc_summary[0]->available_balance; else echo $agent_info->currency_type.' 0.00'; ?>" disabled="">
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2">Payment Information :</div>
            <div class="white-container">
              <div class="row form-group">
                <div class="col-md-3"><label>Transaction Type<span class="red">*</span></label></div>
                <div class="col-md-4">
                  <label class="radio">
              <div class="uniRadio" id="uniform-radio2">
                <span class="checked">
                  <input type="radio" id="radio1" checked="" value="deposit" class="uniform" name="transaction_type" style="opacity: 0;">
                </span>
              </div>
              Deposit Amount
            </label>  <div style="clear:both"></div>
             <label class="radio">
              <div class="uniRadio" id="uniform-radio2">
                <span class="checked">
                  <input type="radio" id="radio2" value="withdraw" class="uniform" name="transaction_type" style="opacity: 0;">
                </span>
              </div>
              Withdraw Amount
            </label>
                </div>

              </div>
              <div class="row form-group">
                <div class="col-md-3"><label>Amount Deposit/Withdraw *<span class="red">*</span></label></div>
                <div class="col-md-4">
                  <input class="form-control" id="focusedInput" type="text" name="amount" value="<?php if(isset($amount))echo $amount; ?>" required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3"><label>Date of Deposit/Withdraw *</label></div>
                <div class="col-md-4">
                 <input type="text" class="datepick" id="datepicker" value="<?php if(isset($value_date))echo $value_date; ?>" name="value_date" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3"><label>Transaction Modes<span class="red">*</span></label></div>
                <div class="col-md-4">
                 <select id="selectError2" class="form-control" name="transaction_mode" required>
              <option value="">Select Transaction Mode</option>
              <optgroup label="Transaction Modes">
                <option value="cash">Cash</option>
                <option value="NEFT">NEFT</option>
                <option value="RTGS">RTGS</option>
                <option value="cheque">Cheque/DD</option>
              </optgroup>
            </select>
                </div>
              </div>
            </div>
          </div>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2">Bank Information :</div>
            <div class="white-container">
              <div class="row form-group">
                <div class="col-md-3"><label>Bank<span class="red">*</span></label></div>
                <div class="col-md-4">
                 <input class="form-control" id="focusedInput" type="text" name="bank" value="<?php if(isset($bank))echo $bank; ?>" required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3"><label>Branch<span class="red">*</span></label></div>
                <div class="col-md-4">
                  <input class="form-control" id="focusedInput" type="text" name="branch" value="<?php if(isset($branch))echo $branch; ?>" required>
                </div>
              </div>
              
              
              <div class="row form-group">
                <div class="col-md-3"><label>City<span class="red">*</span></label></div>
                <div class="col-md-4">
                 <input class="form-control" id="focusedInput" type="text" name="city" value="<?php if(isset($city))echo $city; ?>" required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3"><label>Transaction Id/Cheque No *<span class="red">*</span></label></div>
                <div class="col-md-4">
               <input class="form-control" id="focusedInput" type="text" name="transaction_id" value="<?php if(isset($transaction_id))echo $transaction_id; ?>" required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3"><label>Remarks<span class="red">*</span></label></div>
                <div class="col-md-4">
                <input class="form-control" id="focusedInput" type="text" name="remarks" value="<?php if(isset($remarks))echo $remarks; ?>" required>
                </div>
              </div>
              
              
            </div>
          </div>
          <div class="itinerary-container box-shadow">
          
            <div class="white-container">
              
              </div>
              
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                  <button type="submit" class="btn btn-secondary"><i class="mdi mdi-send"></i> Add Sub Admin</button>
                  <a href="<?php echo site_url() ?>corporate/dashboard" title="Click here to go back" class="btn btn-danger"><i class="mdi mdi-undo"></i> Go Back</a>
                </div>
              </div>
            </div>
          </div>
        </form>
         <?php } ?>
         <div class="row">
      <div class="col-lg-12 col-md-12 mx-auto">
        <div class="itinerary-container box-shadow">
          <div class="searchHdr2">Agent List</div>
          <div class="white-container">
            <?php if(!empty($agent_acc_summary)) {?>
            <div class="table-responsive">
              <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                 <thead>
            <tr>
              <th>SI.No</th>
              <th>Value Date</th>
              <th>Narration</th>
              <th>Transaction DateTime</th>
              <th>Deposit</th>
              <th>Withdraw</th>
              <th>Available_balance</th>
              <th>Status</th>
              <th>Remarks</th>
              <th>Actions</th>
            </tr>
          </thead>
                  <tbody>
            <?php //print_r($agent_acc_summary); 
            for($i=0;$i<count($agent_acc_summary);$i++) {?>
            <tr>
              <td><?php echo $i+1;?></td>
              <td><?php echo $agent_acc_summary[$i]->value_date;?></td>
              <td class="center"><?php echo $agent_acc_summary[$i]->transaction_summary;?></td>
              <td class="center"><?php echo $agent_acc_summary[$i]->transaction_datetime;?></td>
              <td class="center"><?php echo $agent_acc_summary[$i]->deposit_amount;?></td>
              <td class="center"><?php echo $agent_acc_summary[$i]->withdraw_amount;?></td>
              <td class="center"><?php echo $agent_acc_summary[$i]->available_balance; ?></td>
              <td class="center"><?php echo $agent_acc_summary[$i]->status; ?></td>
              <td class="center"><?php echo $agent_acc_summary[$i]->remarks; ?></td>
              <td class="center">
                <?php
                if ($agent_acc_summary[$i]->status == 'Accepted' || $agent_acc_summary[$i]->status == 'Declined' ) {
                ?>
                <a class="tip btn btn-mini " href="javascript:void(0)" >
                </a>
                <?php
                } else {
                ?>
                <a class="tip btn btn-mini " href="<?php echo site_url(); ?>corporate/deposit_approve/<?php echo $agent_acc_summary[$i]->corporate_agent_id; ?>/<?php echo $agent_acc_summary[$i]->agent_no; ?>" title="Approve" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="1" data-agent-id="<?php echo $agent_acc_summary[$i]->agent_id; ?>" >
                  <i class="glyphicon glyphicon-ok-sign"></i>
                </a>
                <a class="tip btn btn-mini " href="<?php echo site_url(); ?>corporate/deposit_decline/<?php echo $agent_acc_summary[$i]->corporate_agent_id; ?>/<?php echo $agent_acc_summary[$i]->agent_no; ?>" title="Decline" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="1" data-agent-id="<?php echo $agent_acc_summary[$i]->agent_id; ?>" >
                  <i class="glyphicon glyphicon-minus-sign"></i>
                </a>
                <?php
                }
                ?>
              </td>
            </tr>
        
            <?php } ?>
      </tbody>
              </table>
            </div>
           <?php } else { ?>
            <div class="alert alert-error">
              <button class="close" data-dismiss="alert" type="button">×</button>
              <strong>Error!</strong>
              No Account Summary Found...
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
      </div>
    </div>

  </div>

</section>
<?php $this->load->view('home/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>