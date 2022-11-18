<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
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
         <!--  <h2></h2> -->
         <div class="page-bar  br-5">
          <ul class="page-breadcrumb">
            <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>             
            <li><a class="in Progress" href="<?php echo site_url() ?>contract/contract_list">Contract List</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <section class="boxs">
        <div class="boxs-header dvd dvd-btm">
          <h1 class="custom-font">Contracts Information</h1>
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
               <div class="alert alert-<?php echo $class ?>">
            <button class="close" data-dismiss="alert" type="button">×</button>
            <strong><?php echo ucfirst($class) ?>....!</strong>
            <?php echo $message; ?>
          </div>
          <?php } ?>      
        </div>
        <div class="boxs-body">    
          <button type="button" class="btn btn-primary" title="Add Contract"><i class="fa fa-plus"></i>Add Contract</button>
        
          <div class="row">
            <div class="col-md-6">
              <div id="tableTools"></div>
            </div>
            <div class="col-md-6">
              <div id="colVis"></div>
            </div>
          </div>
          <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" id="table1">
           <thead>
            <tr>                
              <th>SL. No.</th>
              <th>Contract_Number</th>
              <th>Description</th>
              <th>Signed_Date</th>
              <th>Start_Date</th>
              <th>End_Date</th>  
              <th>Markets</th>              
              <th>Status</th>
              <th>Action</th>
              <th>Edit</th>               
            </tr>
          </thead>
          <tbody>
            <tr>                
              <td>1</td>
              <td>32443</td>
              <td>Contract Summer1</td>
              <td>04-03-2017</td>
              <td>04-03-2017</td>
              <td>01-4-2017</td>  
              <td>All</td>                 
              <td>in Progress</td>                
              <td>                   
               <a class="btn btn-success btn-xs"  onclick="return confirm('Do you really want to in Sale this Contract. ?')" href="<?php echo site_url(); ?>contract/set_status/1/1"><i class="fa fa-times"></i> in Sale</a>             
             </td>
             <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>contract/edit_contract?id=1"><i class="fa fa-pencil"></i> Edit</a></td>      
           </tr>
           <tr>                
            <td>2</td>
            <td>32444</td>
            <td>Contract Summer2</td>
            <td>04-04-2017</td>
            <td>04-04-2017</td>
            <td>01-6-2017</td>  
            <td>All</td>                 
            <td>in Progress</td>                
            <td>              
             <a class="btn btn-success btn-xs"  onclick="return confirm('Do you really want to in Sale this Contract. ?')" href="<?php echo site_url(); ?>contract/set_status/1/1"><i class="fa fa-check"></i> in Sale</a>
           </td>
           <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>contract/edit_contract?id=1"><i class="fa fa-pencil"></i> Edit</a></td>      
         </tr>
         <tr>                
          <td>3</td>
          <td>32445</td>
          <td>Contract Monsoon1</td>
          <td>04-07-2017</td>
          <td>04-07-2017</td>
          <td>01-08-2017</td>  
          <td>All</td>                 
          <td>in Sale</td>                
          <td>                   
           <a class="btn btn-danger btn-xs"  onclick="return confirm('Do you really want to in Progress this Contract. ?')" href="<?php echo site_url(); ?>contract/set_status/1/0"><i class="fa fa-check"></i> in Progress</a>          
         </td>
         <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>contract/edit_contract?id=1"><i class="fa fa-pencil"></i> Edit</a></td>      
       </tr>
       <tr>                
        <td>4</td>
        <td>32443</td>
        <td>Contract Winter1</td>
        <td>04-07-2017</td>
        <td>04-10-2017</td>
        <td>01-12-2017</td>  
        <td>All</td>                 
        <td>in Progress</td>                
        <td>                   
         <a class="btn btn-success btn-xs"  onclick="return confirm('Do you really want to in Progress this Contract. ?')" href="<?php echo site_url(); ?>contract/set_status/1/1"><i class="fa fa-times"></i> in Sale</a>
       </td>
       <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>contract/edit_contract?id=1"><i class="fa fa-pencil"></i> Edit</a></td>      
     </tr>
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
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.js"></script> 



