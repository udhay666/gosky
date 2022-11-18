 <form  name="form_editcomment">
       <div class="row border_row">      
         <div class="form-group col-md-6">
          <label class="strong" for="summary">Summary : </label>
          <textarea  name="summary"  class="form-control"  rows="5" required="required"><?php echo $contract_comment_info->summary; ?></textarea>
        </div>
        <div class="form-group col-md-6">
          <label class="strong" for="comment">Comment : </label>
          <textarea  name="comment"  class="form-control"  rows="5" required="required"><?php echo $contract_comment_info->comment; ?></textarea>
        </div>
      </div>
      <div class="row border_row">      
       <div class="form-group col-md-6">
        <label class="strong" for="user_name">Username : </label>
        <input type="text" class="form-control" name="user_name" value="<?php echo $contract_comment_info->user_name; ?>" required="required">
      </div>
    </div>
       <div class="row">
        
         <div class="form-group col-md-12" align="center">
          <input type="hidden" name="id" value="<?php echo $contract_comment_info->id; ?>"/>
          <input type="hidden" name="contract_id" value="<?php echo $contract_comment_info->contract_id; ?>"/>
       <a class="btn btn-primary" type="button" data-action='contract/update_step5/<?php echo $contract_comment_info->contract_id; ?>' onclick="update_contract_comment(this);">Update</a>
         <a class="btn btn-primary" type="button" onclick="cancel_edit_contract_comment();">Cancel</a>
          </div>
       </div>
     </form> 