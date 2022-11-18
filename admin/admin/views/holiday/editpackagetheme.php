<?php $this->load->view('header'); ?>
 <?php  $this->load->view('left_panel'); ?>
 <?php  $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Package Category</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                       <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br/>
                        <?php if(isset($error)){ ?>
                    <div class="alert alert-error">
                        <button class="close" data-dismiss="alert" type="button">×</button>
                        <strong>Error....!</strong>
                      <?php echo $error; ?>
                    </div>
                    <?php } ?>
                    <?php if(!empty($theme)){ ?>
						<form class="form-horizontal" action="<?php echo site_url(); ?>/holiday/update_holiday_package_themes/<?php echo $theme[0]->theme_id; ?>" enctype="multipart/form-data" method="post">						    
							    <div class="form-group">
                <label class="col-sm-3 control-label" for="focusedInput">Theme Name</label>
                <div class="col-sm-6">
                  <input class="form-control" id="focusedInput" type="text" name="theme_name"  value="<?php if(isset($theme[0]->theme_name)) echo $theme[0]->theme_name; ?>" required>                                 
                </div>
                </div>
                <?php if(!empty($theme[0]->home_category_image)) { ?>
							   <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Current Home Page Category Image</label>
								<div class="col-sm-6">
								 <img style="width:200px;height:100px;"src="<?php echo base_url(); echo $theme[0]->home_category_image; ?>"/>                                   
								</div>
							  </div>
                <?php } ?>
							   <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Update New Home Page Category  Image</label>
								<div class="col-sm-6">								 
              <input class="form-control" type="file" name="home_category_image">                         
								</div>
							  </div>
                  <?php if(!empty($theme[0]->category_image)) { ?>
                <div class="form-group">
                <label class="col-sm-3 control-label" for="focusedInput">Current Category Page Image</label>
                <div class="col-sm-6">
                 <img style="width:200px;height:100px;"src="<?php echo base_url(); echo $theme[0]->category_image; ?>"/>                                   
                </div>
                </div>
                <?php } ?>
                 <div class="form-group">
                <label class="col-sm-3 control-label" for="focusedInput">Update New Category Page Image</label>
                <div class="col-sm-6">                 
                <input class="form-control" type="file" name="category_image">
                 </div>
                </div>
							 <div class="ln_solid"></div>
			                <div class="form-group">
			                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
			               <button type="submit" class="btn btn-primary">UPDATE</button>
			                <a href="<?php echo site_url(); ?>/holiday/holidaypackagethemelist" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
			                </div>
			                </div>
							   </form>
                  <?php } ?>
						</div>
					
					</div>
				</div>
			</div>
			
		</div>	
	</div>
</div>	
 <?php  $this->load->view('footer'); ?>
