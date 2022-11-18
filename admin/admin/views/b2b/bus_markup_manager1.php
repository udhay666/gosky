<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Bus Markup Manager</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <ul class="nav nav-tabs navbar-left nav-dark">
              <li class="active"><a href="#dom-markup" data-toggle="tab"><strong>Bus Markup Master</strong></a></li>
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
        <form class="form-horizontal" action="<?php echo site_url(); ?>/b2b/b2b_save_bus_markup" enctype="multipart/form-data" method="post">
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th style="text-align: center;">S No</th>
                  <th>Group Name</th>
                  <th>Markup Type</th>
                  <th>Markup Value</th>
                </tr>
              </thead>
              <tbody>
                
                <?php for ($i=0;$i<count($b2b_bus_markup_list);$i++) { ?>
                <input type="hidden" name="markup_id[]" value="<?php echo $b2b_bus_markup_list[$i]->markup_id; ?>">
                <tr>
                  <td style="text-align: center;"><?php echo $i + 1; ?></td>
                  <td>
                    <input type="text" class="form-control" readonly name="group_name[]" value="<?php echo $b2b_bus_markup_list[$i]->group_name; ?>">
                    <input type="hidden" class="form-control" name="group_id[]" value="<?php echo $b2b_bus_markup_list[$i]->group_id; ?>">
                  </td>
                  <td>
                    <select class="form-control markup_type" type="text" name="markup_type[]" value="<?php echo $b2b_bus_markup_list[$i]->markup_type; ?>">
                      <option value="2" <?php if($b2b_bus_markup_list[$i]->markup_type=='2')echo 'selected'; ?>>Fixed</option>
                      <option value="1" <?php if($b2b_bus_markup_list[$i]->markup_type=='1')echo 'selected'; ?>>Percentage</option>
                    </select>
                  </td>
                  <td><input type="text" class="form-control" name="markup_value[]" value="<?php echo $b2b_bus_markup_list[$i]->markup_value; ?>"></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <div class="form-group">
              <div class="pull-right">
                <button type="submit" class="btn btn-success">Save Markup</button>
                <a href="<?php echo site_url();?>/b2b/bus_markup_manager"  title="Click here to go back" data-rel="tooltip" class="btn btn-primary btn-register" style="">CANCEL</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    </div><!-- panel -->
    <!-- end of panel body 2 -->
    </div><!-- panel Defualt-->
    </div><!-- col-md-6 -->
  </div>
<?php echo $this->load->view('footer'); ?>
