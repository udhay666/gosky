		 <div class="row  border_row agerange_row">
		    <div class="form-group col-md-3">             
		     <select name="childageminlimit[]" class="form-control select2" required="true">
		        <option value="">Select</option>
		        <?php for($i=0;$i<=12;$i++){ ?>
		        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		       <?php } ?>
		   </select>
		 </div>
		 <div class="form-group col-md-3">
		  <select name="childagemaxlimit[]" class="form-control select2" required="true">
		        <option value="">Select</option>
		        <?php for($i=1;$i<=12;$i++){ ?>
		        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		       <?php } ?>
		  </select>
		 </div>
		 <div class="form-group col-md-3">
		 	 <input type="text" class="form-control" name="childminheightlimit[]" placeholder="Enter Height In Cm" required="true">			
		     </div>
		       <div class="form-group col-md-3">
		 	 <input type="text" class="form-control" name="childmaxheightlimit[]" placeholder="Enter Height In Cm" required="true">			
		     </div>
		</div>
<script>
$(document).ready(function() {
  $(".select2").select2({  
  });
});
</script>