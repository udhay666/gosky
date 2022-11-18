    <?php $this->load->view('header'); ?>
    <?php  $this->load->view('left_panel'); ?>
     <?php  $this->load->view('top_panel'); ?>
        <link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css" />      
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Holiday List</h3>
              </div>
            </div>
            <div class="clearfix"></div>     
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav nav-tabs navbar-left nav-dark">
                        <li class="active"><a href="#home2" data-toggle="tab"><strong>Holiday List          </strong></a></li>
                    </ul>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a href="<?php echo $linkall;?>" class="btn btn-success" style="color: white;"><strong>ALL</strong></a></li>
                      <li><a href="<?php echo $linkpre;?>" class="btn btn-success" style="color: white;"><strong>Previous</strong></a></li>
                      <li><a href="<?php echo $linknext;?>" class="btn btn-success" style="color: white;"><strong>Next</strong></a></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>         
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
               <div class="tab-content mb30" style="overflow:hidden"> 
               <a style="margin: 0 0 0 8px;cursor: not-allowed;" class="btn btn-info">
                  Total Number Package :  <?php if(!empty($package)){echo count($package);}else{ echo "0"; } ?>
                </a>
                <a style="margin: 0 0 0 8px;cursor: not-allowed;" class="btn btn-success">
                  Total Number of Active Package :  <?php if(!empty($activepackage)){echo count($activepackage);}else{ echo "0"; }?>
                </a>  
                <a style="margin: 0 0 0 8px;cursor: not-allowed;" class="btn btn-danger">
                  Total Number of InActive Package :  <?php 
                  if(!empty($package)&&!empty($activepackage)){echo (count($package)-count($activepackage));}else if(!empty($package)){echo (count($package));}else{ echo "0"; }?>
                </a> 
                <br/><br/>     
                <a id="active_package" href="" style="margin: 0 0 0 8px;" class="btn btn-warning">(Select Package & Click Here)</a>              
                <br/><br/><br/> 
                <form method="Get">
                    <div class="row">
                    <div class="col-md-3">
                      <div class="item form-group">
                        <label class="control-label" for="from_date">Package From Date</label>
                     <input type="text" name="from_date" class="form-control selectdate" id="from_date" value="<?php if($from_date!=''){ echo $from_date; }?>" />
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="item form-group">
                        <label class="control-label" for="to_date">Package To Date</label>
                     <input type="text"  name="to_date" class="form-control selectdate" id="to_date" value="<?php if($to_date!=''){ echo $to_date; }?>"/>
                      </div>
                    </div>
                    <div class="col-md-3">
                    <div class="item form-group">
                      <label class="control-label" for="status">Package Status</label>
                      <select class="form-control" name="status" id="status">
                        <option value="all">Select Package Status</option>
                        <option value="1" <?php if($status=="1"){ echo "Selected"; }?>>Active</option>
                        <option value="0" <?php if($status=="0"){ echo "Selected"; }?>>InActive</option>
                                      
                      </select>
                    </div>
                  </div>
                     <div class="col-md-3" style="margin-top:22px;">
                      <div class="item form-group">
                    <input type="submit" name="submitform" class="btn btn-success" value="Submit"/>                   
                      </div>
                    </div>
                  </div>
                </form>
            
              <?php if (!empty($package)) { ?>
                <div class="table-responsive">
                    <div class="double-scroll">
                      <table  id="datatable1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SI.No</th>
                                    <!-- <th>Image</th> -->
                                    <th>Package Name</th>
                                    <th>Package Type</th>
                                    <th>Package Code</th>
                                    <th>Destination</th>
                                    <th>Start Date</th>
                                    <th>End date</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>                                
                                    <th>Add/Edit Review</th>
                                    <th>Add/Edit Itinerary</th>
                                    <th>Add/Edit Rate Calulcations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($package); $i++) { ?>
                                <tr>
                                    <td align="center"><?php echo $i + 1; ?>
                                     <input type="checkbox"  <?php if(trim($package[$i]->status) == 1){ echo 'checked'; } ?>  class="pacstatus" value="<?php echo $package[$i]->holiday_id; ?>" name="pacstatus[]"/></td>
                                  <!--  <td><?php  $images[$i]=$this->holiday_model->get_img_by_type($package[$i]->holiday_id,1); ?>
                                        <img style="width:200px;height:100px;"src="<?php echo base_url(); echo $images[$i]->holiday_images; ?>"/>
                                    </td> -->
                                    <td><?php echo $package[$i]->package_title; ?></td>
                                    <td><?php 
                                    $countryids=explode(',', $package[$i]->country);
                                     if(in_array('12',$countryids))
                                      {echo "Domestic"; }
                                    else{ echo "International";}
                                      ?>                                       
                                     </td>
                                    <td><?php echo $package[$i]->package_code; ?></td>
                                    <td align="center">
                                        <?php
                                        $city = $package[$i]->destination;
                                        $city_name = explode(',', $city);
                                        $cityname = $this->holiday_model->getdesticity($city_name);
                                        $visit_name = '';
                                        foreach ($cityname as $visit) {
                                            $visit_name.=$visit->city_name . ',';
                                        }
                                        $visit=rtrim($visit_name,',');
                                        echo $visit;
                                        ?>
                                    </td>
                                    <td><?php echo $package[$i]->start_date; ?></td>
                                    <td><?php echo $package[$i]->end_date; ?></td>
                                    <td><?php echo $package[$i]->price; ?></td>
                                     <td><?php if($package[$i]->status == 1){ echo 'Active';    }else{ echo 'Inactive';   } ?></td>
                                    <td>
                                    <a href="<?php echo site_url(); ?>/holiday/edit_package/<?php echo $package[$i]->holiday_id; ?>">Edit |</a>
                                    <a href="<?php echo site_url() ?>/holiday/holiday_active/<?php echo $package[$i]->holiday_id; ?>/1">Active</a>&nbsp;|&nbsp;
                                        <a href="<?php echo site_url() ?>/holiday/holiday_active/<?php echo $package[$i]->holiday_id; ?>/0">Inactive</a>
                                    </td>                                  
                                    <td class="center"><a href="<?php echo site_url(); ?>/holiday/holiday_review/<?php echo $package[$i]->holiday_id; ?>">Add/Edit review</a></td>
                                    <td class="center"><a href="<?php echo site_url(); ?>/holiday/itinerary/<?php echo $package[$i]->holiday_id; ?>">Add/Edit itinerary</a></td>
                                    <td><a href="<?php echo site_url() ?>/holiday/holiday_rates/<?php echo $package[$i]->holiday_id; ?>">Add/Edit Rates</a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } else { ?>
                <div class="table-responsive">
                    <div class="double-scroll">
                        <table  id="datatable2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SI.No</th>
                                    <!-- <th>Image</th> -->
                                    <th>Package Name</th>
                                    <th>Package Type</th>
                                    <th>Package Code</th>
                                    <th>Destination</th>
                                    <th>Start Date</th>
                                    <th>End date</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>                                 
                                    <th>Add/Edit Review</th>
                                    <th>Add/Edit Itinerary</th>
                                    <th>Add/Edit Rate Calulcations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <div class="alert alert-error">
                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                    <strong>Error!</strong>
                                    No Data Found. Please try after some time...
                                </div>
                            </tbody>
                        </table>
                         </div>
                          </div>
                        <?php } ?>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>
<script>
    function __doPostBack(elm) {
        var val = elm.options[elm.selectedIndex].value;
        if (val == "1")
        {
            $('#inter').show();
            //$('#inter').addClass('required');
            $('#dome').hide();
        }
        if (val == "2")
        {
            $('#inter').hide();
            $('#dome').show();
            //$('#dome').addClass('required');
        }
    }
</script>
<?php  $this->load->view('footer'); ?>
<!--<script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>-->
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>
<!--<script src="<?php echo base_url(); ?>public/js/jquery.datatables.min.js"></script>-->
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.doubleScroll.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.double-scroll').doubleScroll();
    });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
<!--<script src="<?php echo base_url(); ?>public/js/custom.js"></script>-->
<script>
    function __doPostBack(elm) {
        var val = elm.options[elm.selectedIndex].value;
        if(val == "1")
        {
            $('#inter').show();
//$('#inter').addClass('required');
$('#dome').hide();
}
if(val == "2")
    {$('#inter').hide();
$('#dome').show();
//$('#dome').addClass('required');
}
}
</script>
<script>
  $(document).ready(function() {
    $('#active_package').click(function(e) {
      e.preventDefault();
      var pacstatuscheck = new Array();
      var pacstatusuncheck = new Array();
      var checked_count = $( ".pacstatus:checked" ).length;     
        $('.pacstatus:checked').each(function() {
          pacstatuscheck.push($(this).val());
        });            
        $('.pacstatus:checkbox:not(:checked)').each(function() {
         pacstatusuncheck.push($(this).val());
       });
        $.ajax({
          type: "POST",
          url: "<?php echo site_url(); ?>/holiday/change_package_status",
          dataType: 'html',
          data: {message: pacstatuscheck,message1: pacstatusuncheck},
          success: function(data) {
            new PNotify({
              title: 'success',
              text: checked_count+' Package Successfully Active',
              type: 'success',
              styling: 'bootstrap3'
            });
            window.location.reload();
          }
        });    
    });       
  });
</script>
<script type="text/javascript"> 
$(function() { 
   // var dateToday = new Date();
  $('.selectdate').daterangepicker({  
    autoUpdateInput: false,
    showDropdowns: true,
   // "minDate": dateToday,
    daysOfWeek: [
            "Su",
            "Mo",
            "Tu",
            "We",
            "Th",
            "Fr",
            "Sa"
        ],
     monthNames: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ],  
      locale: {
          cancelLabel: 'Clear',
           format: 'DD-MM-YYYY'
      }
  });

  $('.selectdate').on('apply.daterangepicker', function(ev, picker) {
      $('input[name="from_date"]').val(picker.startDate.format('DD-MM-YYYY'));
      $('input[name="to_date"]').val(picker.endDate.format('DD-MM-YYYY'));
  });

  $('.selectdate').on('cancel.daterangepicker', function(ev, picker) {
       $('input[name="from_date"]').val('');
      $('input[name="to_date"]').val('');
  });
});

</script>


