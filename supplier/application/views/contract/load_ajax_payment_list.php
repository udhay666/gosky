 <?php $this->load->view('data_tables_css'); ?>
   <div class="row border_row">
            <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table3">
             <thead>           
              <tr> 
                <th>SL. No.</th>               
                <th>Payment Mode</th>
                <th>Days</th>
                <th>Period</th>
                <th>Account Name</th>                        
                <th>Bank Name</th>                        
                <th class="none">Branch Office</th>                        
                <th class="none">Bank Address</th>                        
                <th class="none">Account Number</th>                        
                <th class="none">Swift Code</th>                        
                <th class="none">IBAN</th>                   
               </tr>             
            </thead>
            <tbody>
              <?php if(!empty($payment_list)){
              for($i=0;$i<count($payment_list);$i++){ ?>
              <tr>             
                <td><?php echo ($i+1); ?></td>
                <td><?php  if($payment_list[$i]->payment_type=='PRE'){echo 'PRE PAYMENT';}else if($payment_list[$i]->payment_type=='POST'){echo 'POST PAYMENT';} ?></td>
                <td><?php if(!empty($payment_list[$i]->pre_payment_days)){
                  echo $payment_list[$i]->pre_payment_days.' days '.$payment_list[$i]->before_checkin.' CheckIn'; }
                  else if(!empty($payment_list[$i]->post_payment_days)){
                    echo $payment_list[$i]->post_payment_days.' days '.$payment_list[$i]->after_checkin.' CheckIn'; } ?></td>
                <td><?php echo $payment_list[$i]->period; ?></td>
                <td><?php echo $payment_list[$i]->account_name; ?></td>
                <td><?php echo $payment_list[$i]->bank_name; ?></td>
                <td class="none"><?php echo $payment_list[$i]->branch_office; ?></td>
                <td class="none"><?php echo $payment_list[$i]->bank_address; ?></td>
                <td class="none"><?php echo $payment_list[$i]->account_number; ?></td>         
                <td class="none"><?php echo $payment_list[$i]->swift_code; ?></td>
                <td class="none"><?php echo $payment_list[$i]->iban; ?></td>
              </tr>
              <?php }} ?>
            </tbody>
          </table>            
        </div> 
<?php echo $this->load->view('data_tables_js'); ?>

