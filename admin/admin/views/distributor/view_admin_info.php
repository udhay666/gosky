
<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
 <div class="mainpanel">
  <?php echo $this->load->view('top_panel'); ?>

<style>
.paging_full_numbers {
line-height: 22px;
margin-top: 22px;
}
.mb30 {
margin-bottom: 30px;
/* height: 398px; */
min-height: 400px;
}
</style>
      <div class="contentpanel">     
		<?php if(!$this->admin_auth->is_admin()) { ?>
			<?php $this->load->view('account_balance'); ?>
		<?php } ?>				

	
							<h3>View/Edit Admin Info</h3>
						                      
						<div class="box-content">
                    <?php if(!empty($admin_info)) {?>
						
                        <form class="form-horizontal" action="<?php echo site_url(); ?>/distributor/update_admin_info" enctype="multipart/form-data" method="post">
							<fieldset>
                            
                           <?php if(validation_errors() != ""){ ?>
                                <div class="alert alert-error">
                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                    <?php echo validation_errors();?>
                                </div>
                            <?php } ?>
                                                       
                            <?php
							  	if($status == '1')
								{
								?>
								<div class="alert alert-success">
								<button class="close" data-dismiss="alert" type="button">×</button>
									<strong>Success!</strong>
									Sub Admin Profile Updated Successfully Done.
								</div>
								<?php 
								}
								else if($status == '2')
								{
								?>
                                <div class="alert alert-error">
								<button class="close" data-dismiss="alert" type="button">×</button>
									<strong>Error!</strong>
									Sub Admin Not Updated. Please try after some time...
								</div>
								 <?php
								}
								?>
                               
                                <?php
							  	if(!empty($errors))
								{
								?>
								<div class="alert alert-error">
								<button class="close" data-dismiss="alert" type="button">×</button>
									<strong>Error!</strong>
									 <?php echo $errors;?>
								</div>
								<?php 
								}
								?>
                                
                                <legend>Login Information</legend>
                                                                                           
                              <div class="form-group warning">
								<label class="col-sm-3 control-label" for="focusedInput">Email-Id</label>
								<div class="col-sm-6">
                                <div class="input-append">
								  <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $admin_info->login_email; ?>" disabled="">	
                                  <input type="hidden" name="admin_id" value="<?php echo $admin_info->admin_id; ?>" /> 
                                  <input type="hidden" name="admin_email" value="<?php echo $admin_info->login_email; ?>" />					
                                  					 
                                   <span class="help-inline">(No permission to update Login Email-Id)</span>
								</div>
                                </div>
							  </div>
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Mobile Number</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="mobile_no" value="<?php echo $admin_info->mobile_no; ?>" required maxlength="10">                                   
								  <span class="help-inline">Login Mobile Number</span>
								</div>
							  </div>
							  
                              <div class="form-group warning">
								<label class="col-sm-3 control-label" for="disabledInput">Password</label>
								<div class="col-sm-6">
                                 <div class="input-append">
								  <input class="form-control" id="disabledInput" type="text" placeholder="********" disabled="">
                                  <a href="<?php echo site_url(); ?>/role/change_admin_password/<?php echo $admin_info->admin_id; ?>" title="Click here to Reset Sub Admin password" data-rel="tooltip" class="btn btn-warning">Reset Password</a>
                                  <span class="help-inline">The password is hidden for security</span>
								</div>
                                </div>
							  </div>          
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="selectError2">Admin Group</label>
								<div class="col-sm-6">
									<select data-placeholder="Select Admin Group" id="selectError4" data-rel="chosen" name="admin_group" class="cho" data-group="<?php echo $admin_info->admin_group; ?>" required>
										<?php if($this->admin_auth->is_admin()) {?>
											<optgroup label="SuperAdmin">
												<option value="0">Super Admin</option>
											</optgroup>
										<?php } ?>
                                        <?php
											for($i=0;$i<count($admin_group);$i++) {?>
											<option value="<?php echo $admin_group[$i]->admin_grp_id; ?>" <?php echo (($admin_group[$i]->admin_grp_id == $admin_info->admin_group) ? 'selected="selected"' : ''); ?>><?php echo $admin_group[$i]->admin_grp_name; ?></option>
										<?php }	?>																	
								  </select>
								</div>
							  </div> 							  
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="selectError2">Admin Parent</label>							  
								  <div class="col-sm-6">
									<select data-placeholder="Select Parent Admin" id="selectError5" data-rel="chosen" name="admin_parent" data-parent="<?php echo $admin_info->admin_parent; ?>" class="" required>
										<option value=""></option>
										
										<?php
											$admin_group = '';
											for($i=0;$i<count($admin_list);$i++) {
											  if($admin_group != $admin_list[$i]->admin_group) {
												if($admin_group != '') {
													echo '</optgroup>';
												}
												echo '<optgroup label="'.$admin_list[$i]->admin_grp_name.'">';
												$admin_group = $admin_list[$i]->admin_group;
											  }											  
												
											?>
											
											<option value="<?php echo $admin_list[$i]->admin_id; ?>" <?php echo (($admin_list[$i]->admin_id == $admin_info->admin_parent) ? 'selected="selected"' : ''); ?>><?php echo $admin_list[$i]->first_name . ' ' . $admin_list[$i]->last_name ; ?></option>
										
										<?php }	?>										
										</optgroup>										
								  </select>
								</div>
							  </div>                                                                                                                  
							<legend>Personal Information</legend>
                            
							  <div class="form-group">
								<label class="col-sm-3 control-label" for="selectError3">Title</label>
								<div class="col-sm-6">
								  <select id="selectError3" name="title" required>
									<option value="Mr" <?php if($admin_info->title == 'Mr') echo 'selected'; ?>>Mr.</option>
									<option value="Mrs" <?php if($admin_info->title == 'Mrs') echo 'selected'; ?>>Mrs.</option>
									<option value="Dr" <?php if($admin_info->title == 'Dr') echo 'selected'; ?>>Dr.</option>
								 </select>
								</div>
							  </div>
                              
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">First Name</label>

								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="first_name" value="<?php echo $admin_info->first_name; ?>" required>                                   
								</div>
							  </div>
                              
                              <div class="form-group warning">
								<label class="col-sm-3 control-label" for="focusedInput">Middle Name</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="middle_name" value="<?php echo $admin_info->middle_name; ?>" />
                                   <span class="help-inline">(Optional)</span>
								</div>
							  </div>
                              
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Last Name</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="last_name" value="<?php echo $admin_info->last_name; ?>" required>                                   
								</div>
							  </div>
                              
                              
                               <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Address</label>
								<div class="col-sm-6">
								  <textarea class="form-control" id="focusedInput" type="text" name="address" required><?php echo $admin_info->address; ?></textarea>                                   
								</div>
							  </div>
                              
                               <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Pin Code</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="pin_code" value="<?php echo $admin_info->pin_code; ?>" required>                                   
								</div>
							  </div>
                              
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">City</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="city" value="<?php echo $admin_info->city; ?>" required>                                   
								</div>
							  </div>
                              
                               <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">State</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="state"  value="<?php echo $admin_info->state; ?>" required>                                   
								</div>
							  </div>
                              
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="selectError2">Country</label>
								<div class="col-sm-6">
									<select data-placeholder="Select Your Country" id="selectError3" data-rel="chosen" name="country" required>
										<option value=""></option>
										<optgroup label="Country List">                                       
								<?php
                                    for($i=0;$i<count($country_list);$i++) {?>
                                      <?php if($admin_info->country == $country_list[$i]->name) {?>
                                    <option value="<?php echo $country_list[$i]->name; ?>" selected><?php echo $country_list[$i]->name; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $country_list[$i]->name; ?>"><?php echo $country_list[$i]->name; ?></option>
                                    <?php } ?>
                                <?php }	?>										
										</optgroup>										
								  </select>
								</div>
							  </div>  
                             
							 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Update Profile</button>
								<a href="<?php echo site_url(); ?>/role/admin_user_manager" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
							  </div>
                               
							</fieldset>
						  </form>
					
					<?php }else{ ?>
                     	<div class="alert alert-error">
                            <button class="close" data-dismiss="alert" type="button">×</button>
                                <strong>Error!</strong>
                                No Data Found. Please try after some time...
						</div>
                    <?php } ?>
					</div>
					
<?php echo $this->load->view('footer'); ?>
 <script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>

<script src="<?php echo base_url(); ?>public/js/custom.js"></script>
<script>
  jQuery(document).ready(function(){
    
    jQuery("a[rel^='prettyPhoto']").prettyPhoto();
    
    //Replaces data-rel attribute to rel.
    //We use data-rel because of w3c validation issue
    jQuery('a[data-rel]').each(function() {
        jQuery(this).attr('rel', jQuery(this).data('rel'));
    });
    
  });
</script>



<script src="<?php echo base_url(); ?>public/js/jquery.datatables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>

<script src="js/custom.js"></script>
<script>
  jQuery(document).ready(function() {
    
    jQuery('#table1').dataTable();
    
    jQuery('#table2').dataTable({
      "sPaginationType": "full_numbers"
    });
    jQuery('#table3').dataTable({
      "sPaginationType": "full_numbers"
    });
	jQuery('#table4').dataTable({
      "sPaginationType": "full_numbers"
    });
	jQuery('#table5').dataTable({
      "sPaginationType": "full_numbers"
    });
    // Chosen Select
    jQuery("select").chosen({
      'min-width': '100px',
      'white-space': 'nowrap',
      disable_search_threshold: 10
    });
    
    // Delete row in a table
    jQuery('.delete-row').click(function(){
      var c = confirm("Continue delete?");
      if(c)
        jQuery(this).closest('tr').fadeOut(function(){
          jQuery(this).remove();
        });
        
        return false;
    });
    
    // Show aciton upon row hover
    jQuery('.table-hidaction tbody tr').hover(function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 1});
    },function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 0});
    });
  
  
  });
</script>





    <!-- My Custom JS-->
        <script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>

    </body>
</html>

<script type="text/javascript">
	$(document).ready(function() {
		$('#selectError5').children("optgroup").hide();
		groplevel = $('#selectError4 option:first').next().html();		
		if(groplevel == 'SRSS') {
			level1 = 'Admin';
			level2 = 'SRSS';
		} else if(groplevel == 'RSS') {
			level1 = 'SRSS';
			level2 = 'RSS';		
		} else if(groplevel ==	'SS') {
			level1 = 'RSS';
			level2 = 'SS';		
		}  else if(groplevel == 'DI') {
			level1 = 'SS';
			level2 = 'DI`';		
		}		
		$('#selectError4').change(function() {
			grp = $("option:not(:selected)",$(this));
			grpsel = $("option:selected",$(this));
			grpsel = $("option:selected",$(this)).html();
			$('#selectError5').children("optgroup[label="+level1+"]").hide();			
			$.each(grp,function(i,val) {
				if(val.value != '') {
					$('#selectError5').children("optgroup[label="+val.text+"]").hide();
				}
			});
/* 			$.each(grpsel,function(i,val) {
				if(val.value != '') {
					$('#selectError5').children("optgroup[label="+val.text+"]").show();
				}
			}); */
			if(grpsel == level2) {
				$('#selectError5').children("optgroup[label="+level1+"]").show();
				$('#selectError5').children("optgroup[label="+level2+"]").hide();
			} else {
				grpprev = $("option:selected",$(this)).prev();
				$.each(grpprev,function(i,val) {
					if(val.value != '') {
						$('#selectError5').children("optgroup[label="+val.text+"]").show();
					}
				});		
			}			
			
		});
		$('#selectError4').val($('#selectError4').attr('data-group'));
		$("#selectError4").trigger("chosen:updated");
		$('#selectError5').val($('#selectError5').attr('data-parent'));
		$('#selectError4').trigger('change');
		/* $('#selectError5').change(function() {
		}); */
	});
</script>
</body>
</html>