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
          <h2>Trip Type</h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a class="active" href="<?php echo site_url() ?>manage_age/travellers_type">Trip Type</a></li>
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
            <form id="basicForm" class="form-horizontal" action="<?php echo site_url() ?>manage_age/add_type" enctype="multipart/form-data" method="post">
              <input type="hidden" name="id" value="<?php echo $type_list->id; ?>">
              <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">
                  <label class="control-label">Trip Type(Group)</label>
                  <select class="form-control" name="trip_group" required="">
                    <option value="">Select Trip Type</option>
                    <option value="Group Tours">Group Tours</option>
                    <option value="Independent Tours">Independent Tours</option>
                    <option value="Private Guided & Custom">Private Guided &amp; Custom</option>
                    <option value="Cruises">Cruises</option>
                  </select>
                </div>
                <div class="col-sm-3">
                  <label class="control-label">Trip Type(Subgroup)</label>
                  <input class="form-control" type="text" name="type" required="">
                </div>
                <div class="col-md-2">
                  <label class="control-label" style="opacity: 0"><br></label><br>
                  <button type="submit" class="btn btn-primary">ADD</button>
                </div>
              </div>
            </form>
            <hr>
            <table class="table table-custom" id="advanced-usage">
              <thead>
                <tr>
                  <th>SI.No</th>
                  <th>Trip Type</th>
                  <th>Trip Type(Group)</th>
                  <th>Status</th>
                  <th>Active/InActive</th>
                  <th>Action</th>
                  <th>Updated DateTime</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(!empty($type_list)) {?>
                <?php $j=0;
                for($i=0;$i<count($type_list);$i++) {?>
                <tr>
                  <td><?php echo $i+1;?></td>
                  <td><?php echo $type_list[$i]->type;?></td>
                  <td><?php echo $type_list[$i]->trip_group;?></td>
                  <td>
                    <?php if($type_list[$i]->status == 0) { ?>
                    <label class="text text-danger">Inactive</label>
                    <?php } else if($type_list[$i]->status == 1) {?>
                    <label class="text text-success">Active</label>
                    <?php } ?>
                  </td>
                  <td class="center">
                    <?php if($type_list[$i]->status==0){ ?>
                    <a href="<?php echo site_url()?>/manage_age/update_Type_status?id=<?php echo $type_list[$i]->id; ?>&status=<?php echo $type_list[$i]->status; ?>" class="label label-success"  title="re-activate" onclick="return confirm('You are about to re-activate this Type');"><i class="fa fa-check"></i> Re-activate</a>
                    <?php } elseif($type_list[$i]->status==1){ ?>
                    <a href="<?php echo site_url()?>/manage_age/update_Type_status?id=<?php echo $type_list[$i]->id; ?>&status=<?php echo $type_list[$i]->status; ?>" class="label label-warning" title="de-activate" onclick="return confirm('You are about to de-activate this Type');"><i class="fa fa-remove"></i> De-activate</a>
                    <?php  } ?>
                  </td>
                  <td>
                    <a class="btn btn-info btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a mb-5" href="<?php echo site_url(); ?>manage_age/edit_type/<?php echo $type_list[$i]->id;?>" title="Edit" ><i class="fa fa-edit"></i> <span>Edit</span></a><br>

                    <a class="btn btn-danger btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a mb-5" href="<?php echo site_url(); ?>manage_age/delete/<?php echo $type_list[$i]->id;?>" title="Delete" onclick="return confirm('You are about to delete the group')"><i class="fa fa-times"></i> <span>Delete</span></a><br>
                  </td>
                  <td><?php echo $type_list[$i]->date_time;?></td>
                </tr>
                <?php } ?>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </section>
      </div>
    </div>
  </div>
</section>
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script type="text/javascript">
  $(window).load(function(){
    //initialize responsive datatable
    function stateChange(iColumn, bVisible) {
      console.log('The column', iColumn, ' has changed its status to', bVisible);
    }
    var table4 = $('#advanced-usage').DataTable({    
      "aoColumnDefs": [
      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
      ]
    });
    var colvis = new $.fn.dataTable.ColVis(table4);
    $(colvis.button()).insertAfter('#colVis');
    $(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button');
    var tt = new $.fn.dataTable.TableTools(table4, {
      sRowSelect: 'single',
      "aButtons": [
      // 'copy',
      // 'print', 
      {
        'sExtends': 'collection',
        'sButtonText': 'Save',
        // 'aButtons': ['csv', 'xls', 'pdf']
         'aButtons': ['csv']
      }
      ],
      "sSwfPath": "<?php echo base_url(); ?>public/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
    });
    $(tt.fnContainer()).insertAfter('#tableTools');    
 
    });
  </script> 