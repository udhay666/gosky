<?php $this->load->view('header'); ?>
<?php  $this->load->view('left_panel'); ?>
<!-- <div class="mainpanel">-->
<?php  $this->load->view('top_panel'); ?>
<!--
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
   </style> -->
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>Add Notification</h3>
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
                  <br />
                  <?php if(isset($error)){ ?>
                  <div class="alert alert-error">
                     <button class="close" data-dismiss="alert" type="button">×</button>
                     <strong>Error....!</strong>
                     <?php echo $error; ?>
                  </div>
                  <?php } ?>
                  <form id="basicForm" class="form-horizontal" action="<?php echo site_url(); ?>/cms/add_notification" enctype="multipart/form-data" method="post">
                     <div class="form-group">
                        <label class="col-sm-3 control-label">Select User Type </label>
                        <div class="col-sm-6">
                           <select  name="user_type" class="select2_single form-control" tabindex="-1" required>
                              <option value="">Select User Type</option>
                              <optgroup label="User List">
                                 <option value="all">ALL</option>			
                                 <option value="b2b">B2B</option>			
                                 <option value="corporate_user">corporate User</option>			
                                 <option value="b2c">B2C</option>			
                              </optgroup>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-3 control-label" for="focusedInput">Notification</label>
                        <div class="col-sm-6">
                           <textarea class="form-control" id="focusedInput" type="text" name="notification"  value="" required></textarea>                  
                        </div>
                     </div>
                     <div class="ln_solid"></div>
                     <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button type="submit" class="btn btn-primary">ADD</button>
                           <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                        </div>
                     </div>
                     <!-- <div class="form-group" >
                        <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary">ADD</button>
                        <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                        </div>
                     </div>     -->                
                  </form>
                  <br/>
                  <ul class="nav nav-tabs nav-dark">
                     <li class="active"><a href="#home2" data-toggle="tab"><strong>Notification List</strong></a></li>
                  </ul>
                  <div class="tab-content mb30">
                     <div class="tab-pane active" id="home2" style="overflow:auto">
                        <div class="table-responsive">
                           <table  id="datatable1" class="table table-striped table-bordered">
                              <!--  <table class='table' id="table2">-->
                              <thead>
                                 <tr>
                                    <th>SI.No</th>
                                    <th>User Type</th>
                                    <th>Notification </th>
                                    <th>Actions</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php if (!empty($result)) { ?>
                                 <?php for ($i = 0; $i < count($result); $i++) { ?>
                                 <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td class="center"><?php echo $result[$i]->user_type; ?></td>
                                    <td class="center"><?php echo $result[$i]->notification; ?></td>
                                    <td>
                                       <a href="<?php echo site_url(); ?>/cms/delete_notification/<?php echo $result[$i]->id;  ?>" onclick="return confirm('Do you really want to delete this notification...?')">Delete</a>
                                    </td>
                                 </tr>
                                 <?php } ?>
                                 <?php } else { ?>
                                 <div class="alert alert-error">
                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                    <strong>Error!</strong>
                                    No Data Found. Please try after some time...
                                 </div>
                                 <?php } ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- contentpanel -->
               <!-- end of content -->
            </div>
         </div>
      </div>
   </div>
</div>
<?php  $this->load->view('footer'); ?>