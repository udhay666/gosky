      <form data-action='contract/update_contract_season/<?php echo $season_info->id;?>'>
       <div class="row border_row">      
         <div class="form-group col-md-6">
      <label class="strong" for="season_code">Code : <?php echo $season_info->season_code;?></label>    
      </div>
        <div class="form-group col-md-6">
      <label class="strong" for="season_name">Name : </label>
      <input type="text" class="form-control" name="season_name" value="<?php echo $season_info->season_name;?>" required="required">
      </div>

       </div>
    <?php 
        $periods=explode('<br>', $season_info->periods);
        if(!empty($periods)){
          for($i=0;$i<count($periods);$i++){
            if($i!=0){

    ?> 
   <div class="row border_row" id="period_<?php echo $i+1?>">
   <h5 style="font-weight: bold;margin-left: 10px;" >Period(s) <?php echo ($i+1);?>:</h5>
     <div class="form-group col-md-10">    
     <input type="text"  class="form-control season_period" value="<?php echo $periods[$i]; ?>" name="periods[]"  readonly required="required">
    </div> 
    <div class="form-group col-md-2">    
       <a class="btn btn-info btn-xs" data-val="contract/remove_contract_season_period" data-id="<?php echo $season_info->id;?>" onclick="return remove_contract_season_period(this)" title="Do you really want to Remove this Season Period (<?php echo $periods[$i]; ?>). ?" data-period="<?php echo $periods[$i]; ?>" data-index="<?php echo ($i+1);?>"><i class="fa fa-times"></i> Remove</a> 
    </div> 
  </div>
  <?php } else { ?>
   <div class="row border_row">
   <h5 style="font-weight: bold;margin-left: 10px;" >Period(s) <?php echo ($i+1);?>:</h5>
     <div class="form-group col-md-12">    
     <input type="text"  class="form-control season_period" value="<?php echo $periods[$i]; ?>" name="periods[]"  readonly required="required">
    </div> 
  </div>
  <?php }}} else { ?>
    <div class="row border_row">
   <h5 style="font-weight: bold;margin-left: 10px;" >Period 1:</h5>
     <div class="form-group col-md-12">    
     <input type="text"  class="form-control season_period" name="periods[]"  readonly required="required">
    </div> 
  </div>
  <?php } ?>
      <div class="row">    
      <div class="form-group col-md-12"  align="center">
         <button class="btn btn-primary" type="button" onclick="update_modalcustom(this);">Update</button>
         <button class="btn btn-primary" type="button" onclick="cancel_modalcustom();">Cancel</button>
       </div> 
     </div>
   </form>
