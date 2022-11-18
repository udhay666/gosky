<?php $this->load->view('header'); ?>
 <?php  $this->load->view('left_panel'); ?>
 <?php  $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Edit Room Type</h3>
			</div>

		</div>

		<div class="clearfix"></div>      
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">

					<div class="x_title">

						<ul class="nav nav-tabs navbar-left nav-dark">



						</ul>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
							<li><a class="close-link"><i class="fa fa-close"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
				
			    	<?php 
								  if($this->session->flashdata('flash_message')){
									if($this->session->flashdata('flash_message') == 'updated')
									{
									  echo '<div class="alert alert-success">';
										echo '<a class="close" data-dismiss="alert">×</a>';
										echo 'Room Type is updated with success.';
									  echo '</div>';       
									}else{
									  echo '<div class="alert alert-error">';
										echo '<a class="close" data-dismiss="alert">×</a>';
										echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
									  echo '</div>';          
									}
								  }
							?>
							<?php
								  //form data
								  $attributes = array('class' => 'form-horizontal', 'id' => '');

								  //form validation
								  echo validation_errors();
								  
								    echo form_open('supplier/roomtype_update/'.$roomtype[0]['id'], $attributes);
								  ?>	
								  <div class="control-group"> 
									 
									<div class="form-group">
										<label for="req" class="col-sm-3  control-label">Room Type</label>
										 <div class="col-sm-6">
										  <input class='form-control'  type="text" id="" name="room_type" value="<?php echo $roomtype[0]['room_type']; ?>">
										</div>
									  </div>
									 <div class="ln_solid"></div>
                       					 <div class="form-group">
                        				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
											<input type="submit" class="btn btn-primary" value="Save">
											<a href="<?php echo site_url() ?>/supplier/roomtype/" class="btn btn-primary">Cancel</a>
										</div>
										</div>
									  
									 
								  </div>  
							</form>
						</div>
					</div>
				</div>
			</div>
	</div>
	</div>
<?php  $this->load->view('footer'); ?>