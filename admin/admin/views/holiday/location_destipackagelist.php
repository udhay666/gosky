    <?php $this->load->view('header'); ?>
    <?php echo $this->load->view('left_panel'); ?>
    <?php echo $this->load->view('top_panel'); ?>
    <style type="text/css">
  .btn-file {
    position: relative;
    overflow: hidden;
  }
  .btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
  }
</style>
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css" />      
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>HOME SEARCH DESTINATIONS</h3>
          </div>
        </div>
        <div class="clearfix"></div>     
        <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <ul class="nav nav-tabs navbar-left nav-dark">
                <li class="active"><a href="#home2" data-toggle="tab"><strong>Holiday Package List</strong></a></li>
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
              <br />
              <div class="tab-content mb30" style="overflow:hidden"> 
               <a style="margin: 0 0 0 8px;cursor: not-allowed;" class="btn btn-danger">
                  Total Number of HOME SEARCH DESTINATIONS Package :  <?php if(!empty($location_destipackagelist)){ echo count($location_destipackagelist);} else { echo "0";} ?> 
              </a>                  
                <a id="location_dest_id" href="" style="margin: 0 0 0 8px;" class="btn btn-warning">(Select Package & Click Here)</a>
                       
                <br><br>            
                <?php if (!empty($package)) { ?>
                <div class="table-responsive">
                  <div class="double-scroll">
                    <table  id="datatable1" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>SI.No</th>
                          <th>HOME SEARCH DESTINATIONS</th>                     
                          <th>Image</th>
                          <th>Package Name</th>
                          <th>Package Status</th> 
                          <th>Price</th>                                       
                          <th>Start Date</th>
                          <th>End date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php for ($i = 0; $i < count($package); $i++) { ?>
                        <tr>
                          <td><?php echo $i + 1; ?></td>
                          <td align="center">
                          <?php  
                           $country = $package[$i]->country;
                          $country_name = explode(',', $country);
                          $visit_country_name = '';
                          foreach ($country_name as $visit) {
                            $countryname=$this->holiday_model->getholivisitcountry($visit);
                            $visit_country_name=$countryname->country_name;
                             break;
                          } ?>
                          <input type="checkbox" class="location_dest" value="<?php echo $package[$i]->holiday_id; ?>" name="location_dest[]" <?php if(trim($package[$i]->location_dest) == 1){ echo 'checked'; } ?>/> <?php echo strtoupper($visit_country_name); ?></td>
                          <td>                   
              
                      <img style="width:200px;height:100px;"src="<?php echo base_url(); echo $package[$i]->location_img; ?>"/>            
               
                            <br/><br/>
                        <form class="form-horizontal" action="<?php echo site_url(); ?>/holiday/update_location_img/<?php echo $package[$i]->holiday_id; ?>" enctype="multipart/form-data" name="locationupload" method="post"> 
                     <?php $location_img_id="location_img_".$package[$i]->holiday_id; ?> 
                              <label class="btn btn-primary btn-file">
                                <i class="fa fa-plus"></i> Choose Image <input type="file" name="location_img" id="<?php echo $location_img_id; ?>" required="required"></label>&nbsp;&nbsp; 
                              <input type="button" class="btn btn-primary" onclick=" return validate_location_img(this,'<?php echo $location_img_id; ?>');"  value="Upload Image">         
                          </form> 
                          </td>
                          <td><?php echo $package[$i]->package_title; ?></td>
                          <td><?php if($package[$i]->status == 1){ echo 'Active';    }else{ echo 'Inactive';   } ?></td>
                          <td><?php echo $package[$i]->price; ?></td>
                          <td><?php echo $package[$i]->start_date; ?></td>
                          <td><?php echo $package[$i]->end_date; ?></td>
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
                        <th>HOME SEARCH DESTINATIONS</th>
                        <th>Package Name</th>
                        <th>Package Status</th> 
                        <th>Price</th>                                       
                        <th>Start Date</th>
                        <th>End date</th>
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
      <?php echo $this->load->view('footer'); ?>
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
<!-- My Custom JS-->
<!-- <script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script> -->
<script>
  $(document).ready(function() {

    $('#location_dest_id').click(function(e) {
      e.preventDefault();
      var location_destcheck = new Array();
      var location_destuncheck = new Array();
      var locationchecked_count = $( ".location_dest:checked" ).length;
      if(locationchecked_count>=10){
        $('.location_dest:checked').each(function() {
          location_destcheck.push($(this).val());
        });            
        $('.location_dest:checkbox:not(:checked)').each(function() {
         location_destuncheck.push($(this).val());
       });
        $.ajax({
          type: "POST",
          url: "<?php echo site_url(); ?>/holiday/location_dest",
          dataType: 'html',
          data: {message: location_destcheck,message1: location_destuncheck},
          success: function(data) {
            new PNotify({
              title: 'success',
              text: 'Featured Holiday Added Successfully',
              type: 'success',
              styling: 'bootstrap3'
            });
            window.location.reload();
          }
        });
      }else{
       new PNotify({
        title: 'Alert',
        text: 'Select Atleast 10 Packages for HOME SEARCH DESTINATIONS',
        type: 'error',
        styling: 'bootstrap3'
      });
     }
   });    


   


 




  });
</script>
<!-- PNotify -->
<script>
    /*
      $(document).ready(function() { 
         
          if($( ".location_dest:checked" ).length<8){        
          new PNotify({
                                  title: 'Alert HOME SEARCH DESTINATIONS',
                                  text:'<h5> Select Only Active Packages</h5>'+ 
                                  '<h5><b>HOME SEARCH DESTINATIONS</b> Should have Minimum 4 Packages.</h5>',
                                  type: 'error',
                                   nonblock: {
                                         nonblock: false
                                      },
                                  hide: false,
                                   addclass: 'dark',
                                  styling: 'bootstrap3'
                              });
        }          
      }); */
    </script>
    <!-- /PNotify -->
  <script type="text/javascript">
    function validate_location_img(t,id)
    {   
      if($("#"+id).val()=='')
      {
        alert("Kindly Select Image...");
        return false;
      }
      else
      {
        t.form.submit();
      }
    }

    function check_location_section(t,classname)
    {
      $('.'+classname).not(t).prop('checked', false);     
    }
  </script>
  </body>
  </html>