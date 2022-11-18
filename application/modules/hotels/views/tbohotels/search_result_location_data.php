<?php
	// echo '<pre>';print_r($session_data);exit;
if ($tid != '') {
    $lists=explode(",",$tbolistc);
?>


    <div class="checkbox"> 
                    <label>
                        <input class="tbolistc" type="checkbox" name="tbolist" value="<?php echo $tid->TagId;?>" id="loc-type-Hotel"  <?php if(in_array($tid->TagId,$lists)){  echo "checked"; } ?>   ><ins></ins><?php echo $tid->TagName;?>   
                    </label>
                    <span class="badge-list">                                                
                        
                        <span class="num"><?php echo $totals->total;?></span>       
                    </span>
                </div>


<?php 




} ?>
