      <div class="row">
        <div class="col-md-12">
          <section class="boxs">
            <div class="boxs-header dvd dvd-btm">
          <h1 class="custom-font">Edit Contract Details</h1>
          <ul class="controls">
            <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
          </ul>
        </div>
           <div class="boxs-body">    
            <div class="row">            
              <div class="form-group col-md-4">
                <label class="strong" for="contract_number">Contract Number : <span><?php echo $contract_info[0]->contract_number;?></span>  </label>
              </div>
               <div class="form-group col-md-4">
                <label class="strong" for="contract_number">Hotel Name : <span><?php echo $this->supplier_hotel_list->check(array('supplier_hotel_list_id'=>$contract_info[0]->supplier_hotel_list_id))[0]->hotel_name;?></span>  </label>
              </div>
              <div class="form-group col-md-4">
                <label class="strong" for="contract_desc">Description : <span><?php echo $contract_info[0]->contract_desc;?></span>  </label>
              </div>              
            </div>
            <div class="row">
              <div class="form-group col-md-4">
                <label class="strong" for="start_date">Start Date :  <span><?php echo date('d-m-Y',strtotime($contract_info[0]->start_date));?></span>    </label>
              </div>
              <div class="form-group col-md-4">
                <label class="strong" for="end_date">End Date : <span><?php echo  date('d-m-Y',strtotime($contract_info[0]->end_date));?></span></label>
              </div>
              <div class="form-group col-md-4">
                <label class="strong" for="signed_date">Signed Date : <span><?php echo  date('d-m-Y',strtotime($contract_info[0]->signed_date));?></span></label>
              </div>
            </div>             
            <div class="row">
             <div class="form-group col-md-4">
              <label class="strong" for="status">Status is :  <span style="color:red;"><?php echo ($contract_info[0]->status1==1)?'<label class="label label-success">Completed</label>':'<label class="label label-warning">In Progress</label>';?></span> </label>
            </div>
            </div>
            

              <div class="row border_row">
                <div class="form-group col-md-10">
                  <label class="strong">Market Availability : </label>
                  <ul class="check_width check_icon"> 
                  <?php 
                  $market_avail=explode('||',$contract_info[0]->market_avail);
                        if(!empty($market_avail[0])){                      
                         for($i=0;$i<count($market_avail);$i++){                   
                       ?>            
                  <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox"  class="flat" checked="checked" disabled="disabled"><i></i> <?php echo $market_avail[$i]; ?></label></li>
                     <?php } } ?> 
                  </ul>
                </div>
              </div> 

             <div class="row border_row">
                <div class="form-group col-md-10">
                  <label class="strong">Exclude Market: </label>
                  <ul class="check_width check_icon"> 
                  <?php 
                  $exclude_market=explode('||',$contract_info[0]->exclude_market);
                        if(!empty($exclude_market[0])){                      
                         for($i=0;$i<count($exclude_market);$i++){                   
                       ?>            
                  <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox"  class="flat" checked="checked" disabled="disabled"><i></i> <?php echo $exclude_market[$i]; ?></label></li>
                     <?php } } ?> 
                  </ul>
                </div>
              </div> 



          <div class="row">
            <div class="form-group col-md-4">
            </div>

            <div class="form-group col-md-8">
             <a data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#editcontract" class="btn btn-success" data-val="<?php echo $contract_info[0]->contract_id;?>" onclick="editcontract(this)" style="float: right;margin-right: 20px">Edit</a>
           </div>
          </div> 




