<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
 <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
  var site_url='<?php echo site_url(); ?>';
</script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2><span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Contract</a></li>
              <li><a class="active" href="<?php echo site_url() ?>contract/edit_step5?id=<?php echo $id ?>">Edit Contract Details</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
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
    <!-- page content -->
    <div class="pagecontent">
      <?php $this->load->view('contract/contract_summary');?>
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
       <?php
       $data['steps'] = '5';
       echo $this->load->view('contract/steps', $data);
       ?>
       <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $contract_id; ?>">
       <div class="tab-content">
         <div class="tab-pane active" id="step-5"> 
          <div class="row border_row">         
            <div class="form-group col-md-6">            
            <a data-toggle="modal" data-target="#addnewcomment" class="btn btn-info" name="add"><i class="fa fa-plus"></i> New Comment</a>                
           </div> 
         </div>         
         <div class="row border_row">
          <table class="display nowrap" cellspacing="0" width="100%" id="table1">
           <thead>
            <tr>                
              <th>Summary</th>
              <th>Comment</th>
              <th>Username</th> 
              <th>Date</th>
              <th>Action</th>                        
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($contract_comment)){
              for($i=0;$i<count($contract_comment);$i++){ ?>
              <tr>                
                <td><?php echo $contract_comment[$i]->summary; ?></td>
                <td><?php echo $contract_comment[$i]->comment; ?></td>
                <td><?php echo $contract_comment[$i]->user_name; ?></td>
                <td><?php echo $contract_comment[$i]->last_updated; ?></td>
                <td> <a class="btn btn-info btn-xs" data-val="contract/edit_contract_comment" data-id="<?php echo $contract_comment[$i]->id;?>" data-contract_id="<?php echo $contract_id;?>" onclick="editcontractcomment(this)" ><i class="fa fa-pencil" title="Edit this Comment"></i> Edit</a> 
                 <a class="btn btn-info btn-xs" data-val="contract/delete_contract_comment" data-id="<?php echo $contract_comment[$i]->id;?>" onclick="deletecontractcomment(this)" ><i class="fa fa-pencil" title="Delete this Comment"></i> Delete</a> 
                 </td>
              </tr>
              <?php }} ?>          
          </tbody>
        </table>            
      </div>        
    </div>
    <ul class="pager wizard">
      <li class="next">
        <button class="btn btn-success todo">Save and Continue</button>
      </li>       
    </ul>
  </div> 
</div>
</div>
</div>
</section>
</div>
</div>
</section>
<div class="modal fade" id="addnewcomment" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="cancel_edit_contract_comment();">&times;</button>
        <h4 class="modal-title">ADD New Comment</h4>
      </div>
      <div class="modal-body" id="comment_content">
      <form  name="form_comment">
       <div class="row border_row">      
         <div class="form-group col-md-6">
          <label class="strong" for="summary">Summary : </label>
          <textarea  name="summary"  class="form-control" rows="5" required="required"></textarea>
        </div>
        <div class="form-group col-md-6">
          <label class="strong" for="comment">Comment : </label>
          <textarea  name="comment"  class="form-control" rows="5" required="required"></textarea>
        </div>
      </div>   
       <div class="row">
        
         <div class="form-group col-md-12" align="center">
          <input type="hidden" name="contract_id" value="<?php echo $contract_id; ?>"/>
       <a class="btn btn-primary" type="button" data-action='contract/update_step5/<?php echo $contract_id; ?>' onclick="add_contract_comment(this);">Add</a>
         <a class="btn btn-primary" type="button" onclick="cancel_contract_comment();">Cancel</a>
          </div>
       </div>
     </form> 
  </div>
 
</div>
</div>
</div>

<div class="modal fade" id="editcomment" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit New Comment</h4>
      </div>
      <div class="modal-body" id="editcommentcontent"></div>
 </div>
</div>
</div>

<div class="modal fade" id="deletecontractcomment" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Comment</h4>
      </div>
      <div class="modal-body" id="deletecontractcommentcontent"></div>
 </div>
</div>
</div>

<!-- sctipts -->
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
<?php echo $this->load->view('data_tables_js'); ?>
<!--  Custom JavaScripts  --> 
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript">
// $('.todo').on('click', function(){
//   var data = $(this).val();
//   $('#todo').val(data);
//   var form = $('form');   
//       form.parsley().validate();
//       if (!form.parsley().isValid()) {
//           return false;
//       }
// });
$('.todo').on('click', function(){
 $ins_id = $("#insert_id").val();   
 window.location.replace('<?php echo site_url();?>contract/contract_list');
});
</script>

<?php $this->load->view('contract/contract_footer'); ?>