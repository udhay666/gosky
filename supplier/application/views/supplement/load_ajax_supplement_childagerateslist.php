    <div class="row">
    <?php 
                     $child_agerange=json_decode($room_list->child_agerange,true);                 
                      if(!empty($child_agerange[0]))
                      {                    
                        foreach ($child_agerange as $key => $value)
                        { 
                          $val=explode('||', $value);   
                    ?>  
                <div class="form-group col-md-3">
              <label class="strong" for="child_rate">Per Child Rate ( Age : <?php echo $val[0].' - '.$val[1]; ?> ) </label>  
          <input type="text" name="supplement_child_rate[]"  class="form-control supplement_child_rate[]" placeholder="Enter Per Child Rates" required="required"/>
               </div>
               <?php } } else{ ?>
                  <div class="form-group col-md-3">
              <label class="strong" for="child_rate">Per Child Rate ( Age : 0 - 11 ) </label>  
            <input type="text" name="supplement_child_rate[]"  class="form-control supplement_child_rate[]" placeholder="Enter Per Child Rates" required="required"/>
               </div>
               <?php  } ?>  
      </div> 

                   