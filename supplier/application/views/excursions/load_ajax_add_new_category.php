      <form data-action='excursions/update_category/<?php echo $category->category_id;?>'>
      <div class="row">   
              <div class="form-group col-md-3">   
               <label class="strong" for="supplier_room_list_id">Enter Category : </label> 
             </div>        
             <div class="form-group col-md-9">   
           <input type="text" class="form-control" name="add_category" value="<?php echo $category->category;?>" required="required">
            </div> 
          </div>
      <div class="row">    
      <div class="form-group col-md-12"  align="center">
         <button class="btn btn-primary" type="button" onclick="update_modalcustom(this);">Add</button>
         <button class="btn btn-primary" type="button" onclick="cancel_modalcustom();">Cancel</button>
       </div> 
     </div>
   </form>
