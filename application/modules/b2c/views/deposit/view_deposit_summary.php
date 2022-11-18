<?php $this->load->view('home/home_template/header'); ?>
<section class="section-padding inner-page">
  <div class="container">
  <?php $this->load->view('booking_header'); ?>
    <div class="itinerary-container box-shadow mt-3">
      <div class="searchHdr2">Account Summary</div>
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
              <?php  //echo '<pre>';print_r($agent_markup_manager);exit; ?>
              <?php if (!empty($user_deposit_details)) { ?>
              <?php for ($i = 0; $i < count($user_deposit_details); $i++) { ?>
              <tr>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $user_deposit_details[$i]->transaction_summary ; ?></td>
                <td><?php echo date("d-m-Y", strtotime($user_deposit_details[$i]->value_date)); ?></td>
                <td><?php echo $user_deposit_details[$i]->deposit_amount; ?></td>
                <td><?php echo $user_deposit_details[$i]->withdraw_amount; ?></td>
                <td><?php echo $user_deposit_details[$i]->available_balance; ?></td>
                <td><?php echo $user_deposit_details[$i]->bank; ?></td>
                <td><?php echo $user_deposit_details[$i]->branch; ?></td>
                <td><?php echo $user_deposit_details[$i]->status ; ?></td>
              </tr>
              <?php } ?>
              <?php } ?>
            </tbody>
          </table>
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