<?php $this->load->view('home/header'); ?>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<section class="section-padding inner-page">
  <div class="container">
     <h3>Approve Deposited Amount</h3>
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

    
        <form action="<?php echo site_url(); ?>corporate/approve_amount" method="post"  enctype="multipart/form-data" class="" data-parsley-validate>
         <?php if(validation_errors() != ""){ ?>
        <div class="alert alert-error" style="background:red;color:#fff">
          <button class="close" data-dismiss="alert" type="button">×</button>
          <?php echo validation_errors();?>
        </div>
        <?php } ?> 
        <?php if($errors){ ?>
        <div class="alert alert-error" style="background:red;color:#fff">
          <button class="close" data-dismiss="alert" type="button">×</button>
          <?php echo $errors; ?> Error
        </div>
        <?php } ?> 
          <input class="form-control" id="" type="hidden" name="agent_no" value="<?php echo $agentno ?>" required desabled>

                                       <input class="form-control" id="" type="hidden" name="depositno" value="<?php echo $depositno ?>" required desabled>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2">Agent Information :</div>
            <div class="white-container">
              <div class="col-md-12">
                <div class="row form-group">
                  <div class="col-md-3"><label>Available Balance:</label></div>
                  <div class="col-md-4">
                    <input class="form-control" type="text" name="available_balance" value="<?php echo $available_balance; ?>" required readonly>
              
                    
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3"><label>Deposited Amount:</label></div>
                  <div class="col-md-4">
                    <input class="form-control"  type="text" name="dep_amt" value="<?php echo $deposit ?>" required readonly>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2">Transaction Information :</div>
            <div class="white-container">
              <div class="row form-group">
                <div class="col-md-3"><label>Transaction Id<span class="red">*</span></label></div>
                <div class="col-md-4">
                  <?php echo $transact_id ?>

            
                </div>

              </div>
              <div class="row form-group">
                <div class="col-md-3"><label>Bank<span class="red">*</span></label></div>
                <div class="col-md-4">
                   <?php echo $bank ?>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3"><label>Branch</label></div>
                <div class="col-md-4">
                <?php echo $branch ?>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3"><label>City</label></div>
                <div class="col-md-4">
                 <?php echo $city ?>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="itinerary-container box-shadow">
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
               <input class="form-control" id="focusedInput" type="text" name="transaction_id" value="<?php if(isset($transact_id))echo $transact_id; ?>">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3"><label>Remarks<span class="red">*</span></label></div>
                <div class="col-md-4">
                <input class="form-control" id="focusedInput" type="text" name="remarks" value="<?php if(isset($remarks))echo $remarks; ?>" required>
                </div>
              </div>
              
              
            </div>
          </div> -->
          <div class="itinerary-container box-shadow">
          
            <div class="white-container">
              
              </div>
              
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                  <button type="submit" class="btn btn-secondary"><i class="mdi mdi-send"></i> Approve Amount</button>
                  <a href="<?php echo site_url() ?>corporate/dashboard" title="Click here to go back" class="btn btn-danger"><i class="mdi mdi-undo"></i> Go Back</a>
                </div>
              </div>
            </div>
          </div>
        </form>
        
         
      </div>
    </div>

  </div>

</section>
<?php $this->load->view('home/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>