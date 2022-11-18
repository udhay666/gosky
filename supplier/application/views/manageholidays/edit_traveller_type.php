<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
  var siteUrl='<?php echo site_url();?>';
</script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit Trip Type</h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a class="active" href="<?php echo site_url() ?>manage_age/edit_type/<?php echo $id; ?>">Edit Trip Type/a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font"><!-- <strong>Advanced</strong> Table --></h1>
            <ul class="controls">
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>
          <div class="boxs-body">
            <?php
            $sess_msg = $this->session->flashdata('message');
            $errors_msg=$this->session->flashdata('errors_msg');
            if(!empty($sess_msg)){
            $message = $sess_msg;
            $class = 'success';
            }else if(!empty($errors_msg)){
            $message = $errors_msg;
            $class = 'danger';
            }
            else {
            $message = $error;
            $class = 'danger';
            }
            ?>
            <?php if($message){ ?>
            <br>
            <div class="alert alert-<?php echo $class ?>">
              <button class="close" data-dismiss="alert" type="button">×</button>
              <strong><?php echo ucfirst($class) ?>....!</strong>
              <?php echo $message; ?>
            </div>
            <?php } ?>
          </div>
          <div class="boxs-body">
            <form id="basicForm" class="form-horizontal" action="<?php echo site_url() ?>manage_age/update_type" enctype="multipart/form-data" method="post">
              <input type="hidden" name="id" value="<?php echo $type_list->id;?>">
              <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">
                  <label class="control-label">Trip Type(Group)</label>
                  <select class="form-control" name="trip_group" required="">
                    <option value="">Select Trip Type</option>
                    <option value="Group Tours" <?php if($type_list->trip_group == 'Group Tours') echo 'selected' ?>>Group Tours</option>
                    <option value="Independent Tours" <?php if($type_list->trip_group == 'Independent Tours') echo 'selected' ?>>Independent Tours</option>
                    <option value="Private Guided & Custom" <?php if($type_list->trip_group == 'Private Guided & Custom') echo 'selected' ?>>Private Guided &amp; Custom</option>
                    <option value="Cruises" <?php if($type_list->trip_group == 'Cruises') echo 'selected' ?>>Cruises</option>
                  </select>
                </div>
                <div class="col-sm-3">
                  <label class="control-label">Trip Type(Subgroup)</label>
                  <input class="form-control" type="text" name="type" value="<?php echo $type_list->type;?>" required="">
                </div>
                <div class="col-md-2">
                  <label class="control-label"><br></label><br>
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a  href="<?php echo site_url(); ?>manage_age/travellers_type" class="btn btn-primary">Back</a>
                </div>
              </div>
            </form>
          </div>
        </section>
      </div>
    </div>
  </div>
</section>
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>