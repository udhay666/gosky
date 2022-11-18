         <label class="strong" for="exclude_market">Select Exclude Market: </label> 
           <select class="form-control" name="exclude_market[]" id="exclude_market" multiple="multiple" style="width: 75%">       
            <?php foreach($country as $val){?>
           <option value="<?php echo $val->name;?>">
             <?php echo $val->name;?>
           </option>
           <?php } ?>
         </select>
 

<script>
$(document).ready(function() {
  $.fn.select2.amd.require(['select2/selection/search'], function (Search) {
    var oldRemoveChoice = Search.prototype.searchRemoveChoice;    
    Search.prototype.searchRemoveChoice = function () {
        oldRemoveChoice.apply(this, arguments);
        this.$search.val('');
    };
  $("#exclude_market").select2({  
  	placeholder: "Select Exclude Market"
  });
});
});
</script>