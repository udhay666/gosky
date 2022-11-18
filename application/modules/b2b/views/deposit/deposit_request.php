<?php $this->load->view('home/home_template/header'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
  .payment_method {
    display: flex;
    position: relative;
  }

  .payment_method h3 {
    margin-right: 40px;
  }

  .payment_method h3 input {
    margin-right: 10px;
  }

  .deposit_request_container {
    margin-top: 40px;
  }

  .payment_gateway_container h4 {
    margin-left: 20px;
  }

  .payment_gateway_container .choose_payment_gateway {
    margin-right: 10px;
  }

  .payment_logo {
    max-width: 120px;
  }

  .payment_gateway_container .payment_form {
    margin-top: 10px;
    display: flex;
    /* align-items: center; */
    text-align: center;
  }

  .payment_gateway_container .payment_form label {
    margin-right: 20px;

  }

  .payment_gateway_container .payment_form input {
    max-width: 280px;

  }

  .mainpayment_form {
    max-width: 500px;
  }

  .payment_gateway_container .pay_btn {
    align-items: center;
    text-align: center;
    flex-flow: column;
    margin-top: 40px;
    margin-bottom: 20px;
  }
</style>

<section class="section-padding inner-page">
  <div class="container">
    <?php $message = isset($message) ? $message : $this->session->flashdata('message'); ?>
    <?php if (!empty($message)) { ?>
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
        <form action="<?php echo site_url(); ?>b2b/deposit_request" method="post" enctype="multipart/form-data" class="form-horizontal" data-parsley-validate>
          <div class="itinerary-container box-shadow">
            <hr>
            <div>
              <div class="col-12 payment_method">
                <form>
                  <h3><input type="radio" onclick="payment_mode(this.id);" id="deposit_request" name="payment_method_choose"><label for="deposit_request">Deposit Request</label></h3>
                  <h3><input type="radio" onclick="payment_mode(this.id);" id="payment_gateway" name="payment_method_choose"><label for="payment_gateway">Payment Gateway</label></h3>
                </form>
              </div>
            </div>
            <hr>
            <div class="white-container deposit_request_container" style="display: none;">
              <div class="row">
                <div class="col-md-12">
                  <h4>Enter Payment Details</h4>
                  <hr>
                </div>
                <div class="col-md-3">
                  <label>b2b Number:</label>
                  <input type="text" class="form-control form-group " placeholder="<?php echo $agent_info->agent_no; ?>" readonly disabled="">
                </div>
                <div class="col-md-3">
                  <label>Available</label>
                  <input type="text" class="form-control form-group " placeholder="<?php if (!empty($agent_deposit_details)) echo $agent_deposit_details[0]->available_balance;
                                                                                    else echo '0.00'; ?>" disabled="" readonly>
                </div>
                <div class="col-md-3">
                  <label>Deposit Amount:<span class="red">*</span></label>
                  <input type="text" class="form-control form-group " name="amount" value="<?php if (isset($amount)) echo $amount; ?>" required />
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
                    <input type="text" id="past_dp" class="form-control form-group past_dp required" value="<?php if (isset($value_date)) echo $value_date; ?>" name="value_date" autocomplete="off" required>
                  </div>
                  <div class="col-md-3">
                    <label>Bank:<span class="red">*</span></label>
                    <input type="text" class="form-control form-group required" name="bank" value="<?php if (isset($bank)) echo $bank; ?>" required>
                  </div>
                  <div class="col-md-3">
                    <label>Branch:<span class="red">*</span></label>
                    <input type="text" class="form-control form-group required" name="branch" value="<?php if (isset($branch)) echo $branch; ?>" required>
                  </div>
                  <div class="col-md-3">
                    <label>City:<span class="red">*</span></label>
                    <input type="text" class="form-control form-group required" name="city" value="<?php if (isset($city)) echo $city; ?>" required>
                  </div>
                  <div class="col-md-3">
                    <label>Transaction Id/Cheque No:<span class="red">*</span></label>
                    <input type="text" class="form-control form-group required" name="transaction_id" value="<?php if (isset($transaction_id)) echo $transaction_id; ?>" required>
                  </div>
                  <div class="col-md-3">
                    <label>Remarks:</label>
                    <input type="text" class="form-control form-group" name="remarks" value="<?php if (isset($remarks)) echo $remarks; ?>">
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
    <div class="row payment_gateway">
      <div class="itinerary-container box-shadow payment_gateway_container" style="display: none;">
        <hr>
        <div>
          <h4>Payment Gateway</h4>
        </div>
        <hr>
        <div class="col-md-12">
          <input type="radio" class="choose_payment_gateway" name="pay" checked id="">
          <img class="payment_logo" src="<?php echo base_url(); ?>assets/images/logo/Razorpay_logo.svg" alt="">
        </div>
        <div class="container mainpayment_form">
          <form action="<?php echo site_url(); ?>razorpay/pay.php" method="post">
            <input type="hidden" name="agent_deposit_charge" value="<?php echo $agent_deposit_charge; ?>" id="agent_deposit_charge">

            <div class="col-md-12 payment_form">
              <label for="">Amount : </label>
              <input type="number" id="pay_amount" name="pay_amount" class="form-control form-group" required>
            </div>

            <div class="col-md-12 payment_form">
              <label for="">Convenience Charge : </label>
              <p class="convenince_charge"><b>Rs 0 (<?php echo $agent_deposit_charge; ?>% of net amount)</b></p>
            </div>

            <div class="col-md-12 payment_form">
              <label for="">Amount to be charged : </label>
              <h4 id="total_amount"><b>Rs 0</b></h4>
              <input type="hidden" name="total_amount" id="net_amount">
            </div>

            <div class="col-md-12 payment_form">
              <label for="">Remarks <span style="color: red;">*</span>: </label>
              <textarea name="remarks" cols="20" rows="2" style="width: 280px;"></textarea>
            </div>

            <input type="hidden" name="service_type" value="8">
            <input type="hidden" name="email" value="<?php echo $this->session->agent_email; ?>">
            <input type="hidden" name="phone" value="<?php echo $this->session->agent_mobile; ?>">

            <div class="col-md-12 payment_form pay_btn">
              <button class="btn btn-primary">Make Payment</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 mx-auto">
        <div class="itinerary-container box-shadow">
          <hr>
          <div>
            <h3>Deposit / Transaction Summary</h3>
          </div>
          </hr>
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
                  <?php //echo $this->db->last_query(); 
                  // echo '<pre>';print_r($agent_deposit_details);exit;  
                  ?>
                  <?php if (!empty($agent_deposit_details)) { ?>
                    <?php for ($i = 0; $i < count($agent_deposit_details); $i++) { ?>
                      <tr>
                        <td><?php echo $i + 1; ?></td>
                        <td><?php echo $agent_deposit_details[$i]->transaction_summary; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($agent_deposit_details[$i]->value_date)); ?></td>
                        <td><?php echo $agent_deposit_details[$i]->deposit_amount; ?></td>
                        <td><?php echo $agent_deposit_details[$i]->withdraw_amount; ?></td>
                        <td><?php echo $agent_deposit_details[$i]->available_balance; ?></td>
                        <td><?php echo $agent_deposit_details[$i]->bank; ?></td>
                        <td><?php echo $agent_deposit_details[$i]->branch; ?></td>
                        <td class="text-danger"><?php echo $agent_deposit_details[$i]->status; ?></td>
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/datatables/datatables.min.css" />
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/datatables/datatablesInit.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  function paymenttype($select) {
    if ($select == 'payment') {
      $('.showinghide').hide();
      $('.required').removeAttr('required');
    } else {
      $('.showinghide').show();
      $('.required').attr('required');
    }
  }
</script>
<script>
  function payment_mode(value) {
    if (value == 'deposit_request') {
      $('.deposit_request_container').show();
      $('.payment_gateway_container').hide();
    } else if (value == 'payment_gateway') {
      $('.payment_gateway_container').show();
      $('.deposit_request_container').hide();
    }


  }

  $("#pay_amount").keyup(function() {

    var pay_amount = $('#pay_amount').val();
    var agent_deposit_charge = $('#agent_deposit_charge').val();

    var convenince_charge = (parseFloat(pay_amount) / 100 + parseFloat(agent_deposit_charge)).toFixed(2);
    $('.convenince_charge').html('<b>Rs ' + convenince_charge + ' (' + parseFloat(agent_deposit_charge) + '% of net amount)</b>');
    var total_amount = parseFloat(convenince_charge) + parseFloat(pay_amount);
    $('#total_amount').html('<b>Rs ' + total_amount + '</b>');
    $('input[name="total_amount"]').val(total_amount);
    console.log(convenince_charge);
  });

  flatpickr("#past_dp", {
    maxDate: "today"
  });
</script>