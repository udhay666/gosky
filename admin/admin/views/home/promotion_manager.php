<?php
$this->load->view('header');
?>
<?php
 $this->load->view('left_panel');
?>
<!-- <div class="mainpanel">-->
<?php
 $this->load->view('top_panel');
?>
 <!--   <style>
        .paging_full_numbers {
            line-height: 22px;
            margin-top: 22px;
        }
        .mb30 {
            margin-bottom: 30px;
            /* height: 398px; */
            min-height: 400px;
        }
        .label-inactive {
            background-color: grey !important;
        }
    </style>-->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Promotion Manager</h3>
        </div>
    </div>
    <div class="clearfix"></div>     
    <div class="row">
     <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <ul class="nav nav-tabs navbar-left nav-dark">                           
                <li class="active">
                    <a data-toggle="tab" href="#promotion-list">Promotion Manager</a>
                </li>
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
        <br />
        <div class="tab-content mb30">
            <div class="tab-pane active" id="promotion-list" >
                <div class="table-responsive">
                    <legend>Add New Promotion</legend>
                    <form class="form-horizontal" action="<?php echo site_url(); ?>/home/add_promotion" method="post">
                        <fieldset>
                            <?php if (validation_errors() != "") { ?>
                            <div class="alert alert-error">
                                <button class="close" data-dismiss="alert" type="button">�</button>
                                <?php echo validation_errors(); ?>
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="selectError1">Service Type</label>
                                <div class="col-sm-6">
                                        <!--<select id="selectError1" name="service_type" required>
                                        <option value=""></option>
                                        <optgroup label="Service Types">
                                         <option value="1">Hotel</option>
        <option value="2">Flight</option>
        <option value="3">Car</option>
    </optgroup>
</select>-->
<!--HOLIDAYS &nbsp;<input class="input-xlarge focused" id="selectError1" type="checkbox" name="service_type[]" value="6" checked="checked">-->
                                    HOTELS &nbsp;<input class="input-xlarge focused" id="selectError1" type="checkbox" name="service_type[]" value="1" checked="checked">
                                    FLIGHTS &nbsp;<input class="input-xlarge focused" id="selectError1" type="checkbox" name="service_type[]" value="2" checked="checked">
                                 <!--CARS &nbsp;<input class="form-control" id="selectError1" type="checkbox" name="service_type[]" value="3" checked="checked"> -->
                                 <!--Bus &nbsp;<input class="input-xlarge focused" id="selectError1" type="checkbox" name="service_type[]" value="4" checked="checked">-->
                             </div>
                         </div>
                         <div class="form-group">
                            <label class="col-sm-3 control-label" for="disabledInput">Promotion Name </label>
                            <div class="col-sm-6">
                                <input class="form-control" id="focusedInput" type="text" name="promo_name" value="<?php if (isset($promo_name)) echo $promo_name; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="disabledInput">Promotion Code </label>
                            <div class="col-sm-6">
                                <input class="form-control" id="focusedInput" type="text" name="promo_code" value="<?php if (isset($promo_code)) echo $promo_code; ?>" required> (Ex:- ALPROMO400)
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="disabledInput">Type of Discount</label>
                            <div class="col-sm-6">
                                <select name="type_discount" class="form-control" required>
                                    <option value="">Select Discount Type</option>
                                    <option value="1"  <?php echo ((isset($type_discount) && $type_discount == 1) ? 'selected="selected"' : ''); ?>>Percent</option>
                                    <option value="2" <?php ((isset($type_discount) && $type_discount == 2) ? 'selected="selected"' : ''); ?>>Fixed</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="disabledInput">Discount </label>
                            <div class="col-sm-6">
                                <input class="form-control" id="focusedInput" type="number" name="discount" value="<?php if (isset($discount)) echo $discount; ?>" required> (% Only if Percent type or Fixed amount)
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="disabledInput">Valid Upto</label>
                            <div class="col-sm-6">
                                <input id="pr_expire" placeholder="click to show date" class="form-control input-xlarge datepicker" type="text" value="<?php if (isset($promo_expire)) echo $promo_expire; ?>" name="promo_expire" required>
                            </div>
                        </div>
                            <!--<div class="form-actions">
                                <button type="submit" class="btn btn-primary">Add Promotion</button>
                                <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                            </div>-->
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">Add Promotion</button>
                                    <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <br/>
                </div>
            </div> </div>
            <ul class="nav nav-tabs nav-dark">
                <li class="active"><a href="#home2" data-toggle="tab"><strong>Promotion Manager</strong></a></li>
            </ul>
            <div class="tab-content mb30">
                <div class="tab-pane active" id="home2" style="">
                    <div class="table-responsive">
                        <table  id="datatable1" class="table table-striped table-bordered">
                         <!-- <table class="table" id="table2">-->
                         <thead>
                            <tr>
                                <th>SI.No</th>
                                <th>Service Type</th>
                                <th>Promo Name</th>
                                <th>Promo Code</th>
                                <th>Discount (%)</th>
                                <th>Valid Upto</th>
                                <th>Created DateTime</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
//echo "<pre/>"; print_r($promotion_list);
                            if (!empty($promotion_list)) {
                          for ($i = 0; $i < count($promotion_list); $i++) {

                          $servicetype=explode(',', $promotion_list[$i]->service_type);
                              
                                $servicename='';
                                for($k=0;$k<count($servicetype);$k++)
                                {
                                    if(($k+1)==count($servicetype)){
                                    //    print_r($service_type_name);
                                     $servicename.=$service_type_name[$k];
                                 }
                                 else{
                                  $servicename.=$service_type_name[$servicetype[$k]].', ';
                              }
                          }


                           ?>
                          <tr>
                            <td><?php echo $i + 1; ?></td>
                            <td>
                            <?php echo $servicename;  ?>
                            </td>
                            <td class="center"><?php echo $promotion_list[$i]->promo_name; ?></td>
                            <td class="center"><?php echo $promotion_list[$i]->promo_code; ?></td>
                            <td class="center"><?php echo $promotion_list[$i]->discount; ?></td>
                            <td class="center"><?php echo $promotion_list[$i]->promo_expire; ?></td>
                            <td class="center"><?php echo $promotion_list[$i]->created_datetime; ?></td>
                            <td class="center">
                                <?php if ($promotion_list[$i]->status == 0) { ?>
                                <span class="label label-inactive">Inactive</span>
                                <?php } else if ($promotion_list[$i]->status == 1) { ?>
                                <span class="label label-success">Active</span>
                                <?php } else { ?>
                                <span class="label label-important">Blocked</span>
                                <?php } ?>
                            </td>
                            <td class="center">
                                <a class=" managePromoStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="1" data-promo-id="<?php echo $promotion_list[$i]->promo_id; ?>" >
                                    <i class="glyphicon glyphicon-ok-sign"></i>
                                </a>
                                <a class=" managePromoStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="0" data-promo-id="<?php echo $promotion_list[$i]->promo_id; ?>" >
                                    <i class="glyphicon glyphicon-minus-sign"></i>
                                </a>
                                <a class=" managePromoStatus" href="javascript:void(0);" title="Block" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="2" data-promo-id="<?php echo $promotion_list[$i]->promo_id; ?>" >
                                    <i class="fa fa-trash-o"></i>
                                </a>
                                <a class="btn" data-rel="tooltip" href="<?php echo site_url(); ?>/home/edit_promotion/<?php echo $promotion_list[$i]->promo_id; ?>" data-original-title="View / Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
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
</div>
</div>
</div>
</div>
</div>
<?php  $this->load->view('footer'); ?>
<script type="text/javascript">
 $('#pr_expire').daterangepicker({
    singleDatePicker: true,
    format: 'YYYY-MM-DD',
    calender_style: "picker_3"
});
</script>
