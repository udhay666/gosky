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
          <h2>Travellers age</h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>             
              <li><a class="active" href="<?php echo site_url() ?>manage_holidays/travellers_age">Traveller age</a></li>
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
              <li> <a role="button" tabindex="0" class="boxs-refresh"> <i class="fa fa-refresh"></i> </a> </li>
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
              <!-- <li> <a role="button" tabindex="0" class="boxs-fullscreen"> <i class="fa fa-expand"></i> </a> </li> -->
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
        <form id="basicForm" class="form-horizontal" action="<?php echo site_url() ?>manage_age/add_age" enctype="multipart/form-data" method="post">
        	<input type="hidden" name="id" value="<?php echo $age_list->id; ?>">
           <div class="form-group">                     
             <label class="col-sm-2 control-label" for="focusedInput"><strong>Travellers age</strong></label>
             <div class="col-sm-2">
              <input class="form-control" id="focusedInput" type="text" name="age" value="<?php echo $age_list->age; ?>" required="">
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary">ADD</button>
            </div>
          </div>   
        </form>
        <br/>
        <div class="row">
          <div class="col-md-6">
            <div id="tableTools"></div>
          </div>
          <div class="col-md-6">
            <div id="colVis"></div>
          </div>
        </div>
        <table class="table table-custom" id="advanced-usage">
          <thead>
            <tr>
              <th>SI.No</th>
              <th>Age</th>        
              <th>Updated DateTime</th>
              <th>Status</th>
              <th>Active/InActive</th>
              <th>Edit</th>
            </tr>
          </thead>
          <tbody>
           <?php 
           if(!empty($age_list)) {?>
           <?php $j=0;
           for($i=0;$i<count($age_list);$i++) {?>         
           <tr>
            <td><?php echo $i+1;?></td>
            <td><?php echo $age_list[$i]->age;?></td>            
            <td><?php echo $age_list[$i]->date_time;?></td>         
            <td>
              <?php if($age_list[$i]->status == 0) { ?>
              <label class="label label-danger">Inactive</label>
              <?php } else if($age_list[$i]->status == 1) {?>
              <label class="label label-success">Active</label>
              <?php } ?>
              </td>
            <td class="center">
             <?php if($age_list[$i]->status==0){ ?>
				<a href="<?php echo site_url()?>/manage_age/update_Age_status?id=<?php echo $age_list[$i]->id; ?>&status=<?php echo $age_list[$i]->status; ?>" class="label label-success"  title="re-activate" onclick="return confirm('You are about to re-activate this Age');"><i class="fa fa-check"></i> Re-activate</a>
				<?php } elseif($age_list[$i]->status==1){ ?>
				<a href="<?php echo site_url()?>/manage_age/update_Age_status?id=<?php echo $age_list[$i]->id; ?>&status=<?php echo $age_list[$i]->status; ?>" class="label label-danger" title="de-activate" onclick="return confirm('You are about to de-activate this Age');"><i class="fa fa-remove"></i> De-activate</a>
				<?php  } ?>
				</td>
				<td>
                  <a class="btn btn-info btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a" href="<?php echo site_url(); ?>manage_age/edit_age/<?php echo $age_list[$i]->id;?>" title="Edit" ><i class="fa fa-times"></i> <span>Edit</span></a>                                 
                </td>                 
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
    //*initialize responsive datatable
    // $(".manage_property_type_status").click(function(){ 
    //  $siteUrl=$(this).attr('data-url');     
    //  $id=$(this).attr('data-id');
    //  $status=$(this).attr('data-status');
    //  $message=$(this).attr('title');
    //  if(confirm('Are you sure you want to '+ $message+' this Property Type?')) {
    //    $.ajax({
    //     url: $siteUrl + 'property_type/set_property_type_status/',
    //     data: 'id='+$id+'&status='+$status,
    //     dataType: 'json',
    //     type: 'POST',
    //     success: function(data)
    //     { window.location.href=$siteUrl + 'property_type/propertytype/'; }
    //   });
    //  }
   // });
 
    });
  </script> 