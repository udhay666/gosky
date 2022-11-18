<script src="<?php echo base_url(); ?>public/js/vendor/custom/contractcustomize.js
"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/datepicker3.css">
<script src="<?php echo base_url();?>public/js/bootstrap-datepicker.js"></script>
<div class="modal fade" id="editcontract" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 70px;">
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" onclick="cancel_editcontract();" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel" style="font-weight: 900;">Edit Contract Details</h3>
        <p id="validation_error" style="color: red;"></p>
      </div>
      <div class="modal-body" id="contractcontent">   
     
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addfile" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ADD File</h4>
        <p id="validation_error" style="color: red;"></p>
      </div>
      <div class="modal-body" id="contractfile">
       <form  action='<?php echo site_url(); ?>contract/update_contract_file' method="post" enctype="multipart/form-data">
       <div class="row border_row">
        <div class="form-group col-md-12">
         <label class="btn btn-primary btn-file">
          <i class="fa fa-plus"></i>Add file <input type="file" name="contract_file"  required="required" style="display: none;"></label>&nbsp;&nbsp;  <input type="hidden"  name="contract_file_name" required="required"  id="filnamedesc">         
       <span   id="filnamedescspan"></span> 
      </div>
     </div> 
      <div class="row border_row">
        <div class="form-group col-md-12">
        <p>Note <span  style="color:red;">*</span><p>
          <h5 style="margin-top:5px;">File Should have either of following type <span style="color:red;">[ doc , docx , txt , pdf , xls , xlsx , gif , jpg , png , jpeg ]</span></h5>  
        </div>
      </div>
   
   <div class="row border_row">
     <div class="form-group col-md-12">
      <label class="strong" for="specialoffer_type">Description : </label>
     <textarea name="contractfile_desc" class="form-control" rows="5" required="required"></textarea>
    </div>
  </div>
  <div class="row">
      <div class="form-group col-md-12" align="center">  
         <input type="hidden" name="contract_id" value="<?php echo $contract_id;?>">
         <button class="btn btn-primary" type="button" onclick="update_contractfile(this);">Update</button>
         <button class="btn btn-primary" type="button" onclick="cancel_contractfile();">Cancel</button>
          </div>
       </div>
  </form>
</div>

</div>
</div>
</div>



<div class="modal fade" id="addnewseason" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ADD New Season</h4>
      </div>
      <div class="modal-body">
  <form  action='<?php echo site_url(); ?>contract/add_contract_season' method="post" enctype="multipart/form-data">
       <div class="row border_row">    
     
        <div class="form-group col-md-6">
      <label class="strong" for="season_name">Name : </label>
      <input type="text" class="form-control" name="season_name" required="required">
      </div>

       </div>
     
   <div class="row border_row">
   <h5 style="font-weight: bold;margin-left: 10px;" >Periods:</h5>
     <div class="form-group col-md-12">    
     <input type="text"  class="form-control season_period" name="periods"  readonly required="required">
    </div> 
  </div>
   <div class="row">
      <div class="form-group col-md-12" align="center">  
         <input type="hidden" name="contract_id" value="<?php echo $contract_id;?>">
         <button class="btn btn-primary" type="button" onclick="update_contractseason(this);">Update</button>
         <button class="btn btn-primary" type="button" onclick="cancel_contractseason();">Cancel</button>
          </div>
       </div>
  </form>
</div>

</div>
</div>
</div>

<div class="modal fade" id="addperiod" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ADD Period</h4>
      </div>
      <div class="modal-body">
  <form  action='<?php echo site_url(); ?>contract/addperiod_contract_season' method="post" enctype="multipart/form-data">
        
   <div class="row border_row">
   <h5 style="font-weight: bold;margin-left: 10px;" >Periods:</h5>
     <div class="form-group col-md-12">    
     <input type="text"  class="form-control season_period" name="periods"  readonly required="required">
    </div> 
  </div>
   <div class="row">
      <div class="form-group col-md-12" align="center">  
         <input type="hidden" name="contract_id" value="<?php echo $contract_id;?>">
          <input type="hidden" id="season_id" name="season_id">
         <button class="btn btn-primary" type="button" onclick="addperiod_contract_season(this);">Update</button>
         <button class="btn btn-primary" type="button" onclick="cancelperiod_contract_season();">Cancel</button>
          </div>
       </div>
  </form>
</div>

</div>
</div>
</div>


<div class="modal fade" id="modalcustom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 70px;">
  <div class="modal-dialog" style="width: 650px;">
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" onclick="cancel_modalcustom();" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel_modal" style="font-weight: 900;"></h3>
        <h4 id="validation_error" style="color: red" align="center"></h4>
      </div>
      <div class="modal-body" id="customcontent">   
     
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="viewpaymentconditionlist" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="close_viewpaymentconditionlist();">&times;</button>
        <h4 class="modal-title">View Payment Condition List</h4>
        <p id="validation_error" style="color: red;"></p>
      </div>
      <div class="modal-body" id="viewpaymentlist">    
     </div>
      <!-- footer -->
      <div class="modal-footer">
        <button class="btn btn-warning"
                data-dismiss="modal" onclick="close_viewpaymentconditionlist();">
          close
        </button>
       
      </div>
      <!-- footer -->
</div>
</div>
</div>

<style>
.daterangepicker{z-index:1151 !important;}
</style>

<script type="text/javascript">
  $(document).on('change', ':file', function() {
    $("#filnamedescspan").html('');
    $("#filnamedesc").val('');  
    var size= this.files[0].size/1024/1024;
    var filesize=Number(Math.round(size+'e2')+'e-2');  
    var ext = $(this).val().split('.').pop().toLowerCase();
    if($.inArray(ext, ['doc','docx' ,'txt','xls','xlsx','gif','jpg','png','jpeg','pdf']) == -1) {
     $(this).val('');
       alert('Kindly Select Mention Files....');
    }
   else if(filesize>10){
     $(this).val('');
     alert("File Size Should Be less 10 MB ");
    return false;
    }
    else
     {  
      var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [numFiles, label]);
     }
   });

  $(document).ready( function() {
    $(':file').on('fileselect', function(event, numFiles, label) {    
      $("#filnamedescspan").html(label);
      $("#filnamedesc").val(label);     
    });
  });
</script> 
<script type="text/javascript">
$(function() {
    $('.season_period').daterangepicker({       
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
});
</script>

