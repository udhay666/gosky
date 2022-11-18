<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link href="<?php echo base_url(); ?>public/css/buttons.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">        
          <div class="page-bar br-5">
            <div class="form-group">
              <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Activity</a></li>
              <li><a class="active" href="<?php echo site_url() ?>home/activity_list">Activity list</a></li>
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
            <h1 class="custom-font">Activity list</h1>
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
           
           
            <br/>
            <div class="row">        
          <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table1">
              <thead>
                <tr>                
                  <th>SL. No.</th>
                  <th>Package Title</th>
                  <th>Destination</th>
                  <th>Price</th>
                  <th>Start /End Date</th>
                  <th>Status</th>
                  <th>Action</th>
                 <!--  <th>Edit</th>  -->

                  <th class="none">Package Description</th>
                  <th class="none">Star Rating</th>
                  <th class="none">Package Included</th> 
                  <th class="none">Departure</th>  
                  <th class="none">Expected</th> 
                  <th class="none">Hotel Pickup</th> 
                  <th class="none">Additional</th> 
                  <th class="none">Cancel</th> 
                  <th class="none">Reviews</th> 
                  <th class="none">Terms</th>


                </tr>
              </thead>
              <tbody>
              <?php
              if(!empty($activitylist)){
               for($i=0;$i<count($activitylist);$i++){?>
                <tr>
                  <td><?php echo $i+1; ?></td>
                  <td><?php echo $activitylist[$i]->package_title; ?></td>
                  <td><?php echo $activitylist[$i]->destination; ?></td>
                  <td><?php echo $activitylist[$i]->price_ad; ?></td>
                  <td><?php echo $activitylist[$i]->start_date; ?>/<?php echo $activitylist[$i]->end_date; ?></td>
                 <td>    
                  <?php if($activitylist[$i]->status==1){ ?>  
                  <label class="label label-success">Active</label>
                    <?php } else { ?>
                     <label class="label label-danger">Inactive</label>
                    <?php } ?>
                  </td>
             <td> 
                   <?php if($activitylist[$i]->status==1){ ?>                  
                     <a class="btn btn-danger btn-xs"  onclick="return confirm('Do you really want to InActive this Activity. ?')" href="<?php echo site_url(); ?>home/set_status/<?php echo $activitylist[$i]->holiday_id;?>/0"><i class="fa fa-times"></i> Inactive</a>
                      <?php } else { ?>
                      <a class="btn btn-success btn-xs"  onclick="return confirm('Do you really want to Active this Activity. ?')" href="<?php echo site_url(); ?>home/set_status/<?php echo $activitylist[$i]->holiday_id;?>/1"><i class="fa fa-check"></i> Active</a>          
                    <?php } ?>
                  </td>
                  <!-- <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>activity/edit_hotel?id=<?php echo $activitylist[$i]->holiday_id;?>"><i class="fa fa-pencil"></i> Edit</a></td> -->
                 <td class="none">
                 <?php echo $propertytypeall[$activitylist[$i]->package_desc]; ?></td>
                  <td class="none">
                  <?php echo $activitylist[$i]->package_rating; ?></td>
                  <td class="none">
                  <?php echo $activitylist[$i]->included; ?></td>
                  <td class="none">
                  <?php echo $activitylist[$i]->departure; ?></td>
                   <td class="none">
                   <?php echo $activitylist[$i]->expected; ?></td>
                   <td class="none">
                   <?php echo $activitylist[$i]->hotel_pickup; ?></td>
                   <td class="none">
                   <?php echo $activitylist[$i]->additional; ?></td>
                    <td class="none">
                   <?php echo $activitylist[$i]->cancel; ?></td>
                   <td class="none">
                   <?php echo $activitylist[$i]->reviews; ?></td>
                   <td class="none">
                   <?php echo $activitylist[$i]->terms; ?></td>
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
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.js"></script>


  <script src="<?php echo base_url(); ?>public/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/buttons.flash.min.js
  "></script>
  <script src="<?php echo base_url(); ?>public/js/jszip.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/pdfmake.min.js
  "></script>
  <script src="<?php echo base_url(); ?>public/js/vfs_fonts.js"></script>
  <script src="<?php echo base_url(); ?>public/js/buttons.html5.min.js
  "></script>
  <script src="<?php echo base_url(); ?>public/js/buttons.print.min.js
  "></script>

<script type="text/javascript">
jQuery(document).ready(function() {

  $('#advanced-usage').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [{extend:'pageLength', className: "btn-primary"},{       
                      extend: 'excel',
                      text: 'Export Excel',
                      exportOptions: {
                        rows: { selected: true }                                                
                      },
                      className: "btn-success"
                    }],
                    lengthMenu: [
                    [5, 10, 25, 50, -1 ],
                    ['5 rows','10 rows', '25 rows', '50 rows', 'Show all' ]
                    ]
                  });
  });
  $(window).load(function(){
    //initialize responsive datatable
    // function stateChange(iColumn, bVisible) {
    //   console.log('The column', iColumn, ' has changed its status to', bVisible);
    // }






    // var table4 = $('#advanced-usage').DataTable({
    //   "aoColumnDefs": [
    //     { 'bSortable': false, 'aTargets': [ "no-sort" ] }
    //   ]
    // });
    // var colvis = new $.fn.dataTable.ColVis(table4);
    // $(colvis.button()).insertAfter('#colVis');
    // $(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button');
    // var tt = new $.fn.dataTable.TableTools(table4, {
    //   sRowSelect: 'single',
    //   "aButtons": [
    //     // 'copy',
    //     // 'print', 
    //     {
    //       'sExtends': 'collection',
    //       'sButtonText': 'Save',
    //       'aButtons': ['csv']
    //       // 'aButtons': ['csv', 'xls', 'pdf']
    //     }
    //   ],
    //   "sSwfPath": "<?php echo base_url(); ?>public/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
    // });
    // $(tt.fnContainer()).insertAfter('#tableTools');




    //*initialize responsive datatable
  });
</script> 
<!-- <script>
$(document).ready(function() {
  $(".select2").select2({
    // maximumSelectionLength: 4,
    // placeholder: "With Max Selection limit 4",
    // allowClear: true
  });
   $(".stars").starrr();
    // $('.stars-existing').starrr({
    //   rating: 4
    // });
    $('.stars').on('starrr:change', function (e, value) {
      $(this).parent().find('.stars-count').html(value);
    });
    $('.stars').on('starrr:change', function (e, value) {
      $(this).parent().find('.stars_input').val(value);
    });
     $("#resetbutton").click(function(){ 
      $("input[type='text']").val('');
       $("input[type='hidden']").val('');
      $(".select2").val('');
      $(".select2").change();
      location.href='<?php echo site_url() ?>hotel/hotel_list';
    });
});
</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css">
<script src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
  $("#cityName").autocomplete({
       source: "<?php echo site_url(); ?>hotel/citylist/",
       minLength: 2,
       autoFocus: true,
          select: function( event, ui ) {     
      $("input[name='hotel_city']").val(''); 
      $("input[name='hotel_country']").val('');  
      $("input[name='hotel_city']").val(ui.item.city_name);
      $("input[name='hotel_country']").val(ui.item.country_name);        
    }
   });
    });
</script> -->