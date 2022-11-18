<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link href="<?php echo base_url(); ?>public/css/buttons.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
  var site_url="<?php echo site_url(); ?>";
</script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">        
          <div class="page-bar br-5">
            <div class="form-group">
              <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Excursions</a></li>
              <li><a class="active" href="<?php echo site_url() ?>excursions/categories">Category list</a></li>
            </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font">Excursion list</h1>
            <ul class="controls">           
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>
          <div class="boxs-body">
            <?php 
            $sess_msg = $this->session->flashdata('message');
            if(!empty($sess_msg)){
              $message = $sess_msg;
              $class = 'success';
            } else {
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
            <div class="row">
             <div class="col-md-4">
               <a class="btn btn-success" onclick="modalcustom(this)" data-val="excursions/add_new_category" type="button"><i class="fa fa-edit m-right-xs"></i> Add New Category</a>
               </div>
            </div>
            <br/>
        <div class="row">
         <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table1">
              <thead>
                <tr>                
                  <th>Category Name</th>                 
                  <th>Status</th>
                  <th>Action</th>  
                  <th>Edit</th>
                  <th class="none">Last Updated Time</th>
                </tr>
              </thead>
              <tbody>
              <?php
              if(!empty($categories)){
               for($i=0;$i<count($categories);$i++){?>
                <tr>
                  <td><?php echo $categories[$i]->category; ?></td>                 
                  <td id="status<?php echo ($i+1);?>"><?php echo ($categories[$i]->status=='1'?'<label class="label label-success">Active</label>':'<label class="label label-warning">Inactive</label>'); ?></td>
                 <td id="action<?php echo ($i+1);?>"> 
                   <?php if($categories[$i]->status==1){ ?>                  
                     <a class="btn btn-warning btn-xs" data-name="<?php echo $categories[$i]->category; ?>" data-id="<?php echo $categories[$i]->category_id;?>"  data-status="0" data-val="excursions/set_category_status"  onclick="return set_category_status(this)" data-index="<?php echo ($i+1); ?>"  title="Do you really want to Inactive this Category (<?php echo $categories[$i]->category; ?>). ?"><i class="fa fa-times"></i> Inactive</a>
                      <?php } else { ?>
                      <a class="btn btn-success btn-xs" data-name="<?php echo $categories[$i]->category; ?>"  data-id="<?php echo $categories[$i]->category_id;?>"  data-status="1" data-val="excursions/set_category_status"  onclick="return set_category_status(this)" data-index="<?php echo ($i+1); ?>" title="Do you really want to Active this Category (<?php echo $categories[$i]->category; ?>). ?"><i class="fa fa-check"></i> Active</a>          
                    <?php } ?>
                  </td>
                  <td><a class="btn btn-info btn-xs" data-val="excursions/edit_category" data-id="<?php echo $categories[$i]->category_id;?>" onclick="editmodalcustom(this)"><i class="fa fa-pencil"></i> Edit</a></td>
                   <td class="none"><?php echo $categories[$i]->last_updated_time; ?></td>
               </tr>
              <?php } }?>
              </tbody>
            </table>
          </div>
        </section>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="modalcustom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 70px;">
  <div class="modal-dialog" style="width: 650px;">
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" onclick="cancel_modalcustom();" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel" style="font-weight: 900;"></h3>
        <h4 id="validation_error" style="color: red" align="center"></h4>
      </div>
      <div class="modal-body" id="customcontent">   
     
      </div>
    </div>
  </div>
</div>
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/custom/customize.js"></script>

