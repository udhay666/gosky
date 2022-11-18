 <?php 
 for($i=0;$i<count($result);$i++) {
$images=$this->Holiday_Model->get_img_by_type($result[$i]['holiday_id'],2);
// echo $this->db->last_query(); 
// echo '<pre/>123';print_r($images);exit;
$str=base_url().'admin/'.$images->holiday_images;
if(getimagesize($str) !== false) {  ?>
<div class="col-sm-4 col-xs-12" style="padding: 0px 5px 0px 5px;">
    
    <div class="result-item">
        <a href="<?php echo site_url(); ?>holiday/holidaydetails/<?php echo base64_encode('BIZZMIRTHOLIDAYS'.$result[$i]['holiday_id']); ?>">
            <img src="<?php echo base_url();echo 'admin/'.$images->holiday_images; ?>" alt="<?php echo $result[$i]['package_title'];?>" class="img-responsive" style="height:220px;width:100%;">
        </a>
        <div class="result-package">
            <p class="tittle"><?php echo $result[$i]['package_title'];?></p>
            <p class="desc"><?php echo $result[$i]['duration']." Nights / ".($result[$i]->duration+1)." Days";?>
                <span> - <i class="fa fa-rupee"></i><?php echo $result[$i]['price']; ?></span>
            </p>
            <?php if(!empty($result[$i]->taggingservices)){ ?>
            <?php $taggingservices=str_replace(',', ', ', $result[$i]['taggingservices']);?>
            <p class="desc" style="font-size: 12px;font-weight: 900;"> <?php echo $taggingservices;?></p>
            <?php } ?>
            <div class="text-left">
                <?php if(!empty($result[$i]['taggingservices'])) { ?>
                <?php $taggingservices = explode(',', $result[$i]['taggingservices']);?>
                <ul class="pack-icons">
                    <?php foreach($taggingservices as $tags){ ?>
                    <?php if($tags == 'Flights') { ?>
                    <li title="Flights"><i class="fa fa-plane"></i></li>
                    <?php } elseif($tags == 'Hotels') { ?>
                    <li title="Hotels"><i class="fa fa-hotel"></i></li>
                    <?php } elseif($tags == 'Sightseeing') { ?>
                    <li title="Sightseeing"><i class="fa fa-eye"></i></li>
                    <?php } elseif($tags == 'Transfer') { ?>
                    <li title="Transfer"><i class="fa fa-truck"></i></li>
                    <?php } elseif($tags == 'Visa') { ?>
                    <li title="Visa"><i class="fa fa-globe"></i></li>
                    <?php } elseif($tags == 'Insurance') { ?>
                    <li title="Insurance"><i class="fa fa-medkit"></i></li>
                    <?php } ?>
                    <?php } ?>
                </ul>
                <?php } ?>
                <a class="btn btn-success btn-xs" onclick="resultEnquiry(this)" data-val='<?php echo $result[$i]['package_title']; ?>' data-code="<?php echo $result[$i]['holiday_id']; ?>"  style="float: right;background-color: #FFBF00;border-color: #FFBF00;margin-right: 0;color:##203FB3" data-toggle="modal" data-target="#myModal">Enquire now</a>
                <a href="<?php echo site_url(); ?>holiday/holidaydetails/<?php echo base64_encode($result[$i]['holiday_id']); ?>" class="btn btn-success btn-xs" style="float: right;background-color: #203FB3;border-color: #203FB3;margin-right: 1px;color:#FFBF00">View Details</a>
            </div>
        </div>
    </div>
</div>
<?php } } ?>
<div class="modal fade custom-modal"  id="myModal" tabindex="-1" role="dialog"  aria-hidden="true" style="margin-top: 130px;opacity: 1;top:10px">
         <div class="modal-dialog" style="max-width: 430px">
            <div class="modal-content">
               <div class="modal-header" style="background: #203FB3;line-height: 17;padding: 49px 8px;">
                  <h6 class="modal-title" id="myModalLabel" style="color:#FFBF00;font-weight: 200;">
                     Our expert will get in touch with you shortly
                  </h6>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-top: 49px;margin-bottom: -47px;color:#FFBF00;">&times;</button>
               </div>
               <div class="modal-body">
                  <form action="" method="post">
                     <input type="hidden" id="holiday_id1">
                     <div class="row">
                        <div class="col-sm-12 text-center">
                           <span id="resultenquirypackname" style="font-weight: 600;"></span>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" placeholder="Name *" name="name" id="travel_contact_name1" class="form-control form-group">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" placeholder="Email Address *" name="email" id="travel_contact_email1" class="form-control form-group">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" id="travel_contact_number1" placeholder="Mobile Number *" name="contact_number" class="form-control form-group">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" placeholder="Your City (Optional)" name="city" id="travel_contact_city1" class="form-control form-group">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <label class="checkbox-inline checkbox-custom checkbox-custom-sm">
                              <input type="checkbox" name="authorize" value="Yes" id="travel_contact_authorize1" checked required=""><i></i> I authorize Bizzmirth holidays to contact me and have read the Terms and Conditions.
                              <div class="red" id="travel_contact_authorize1_error"></div>
                           </label>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <label class="checkbox-inline checkbox-custom checkbox-custom-sm form-group">
                              <input type="checkbox" name="agree" value="Yes" id="travel_contact_agree1" checked required=""><i></i> I agree to receive updates &amp; offers from Bizzmirth Holidays
                              <div class="red" id="travel_contact_agree1_error"></div>
                           </label>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="submit" class="btn2" value="CALL ME BACK" name="travel-contact-button" style="background-color:#FFBF00;padding: 8px 50px;height: 40px;border: 0;text-transform: uppercase; margin-left: 81px;" id="travel-contact-button1">
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
   </div>
     <div class="modal" id="myModal1" role="dialog">
          <div class="modal-dialog" style="width: 431px;">
            <div class="modal-content" style="padding: 20px;">
              <button type="button" id="modalClose" class="close" data-dismiss="modal">&times;</button>
              <p>Dear <span id="name"></span> ,</p>
              <p id="success"></p>
              <p>Regards,</p>
              <p>Bizzmirth Holidays</p>
              </p>
            </div>
          </div>
        </div>
<script type="text/javascript">
   $(document).ready(function() {
    var modal = document.getElementById("myModal");
    // var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];
      $('form').on('submit',function (e){
        e.preventDefault();

        $.ajax({
          method : 'post',
          dataType : 'json',
          url : '<?php echo site_url(); ?>holiday/holiday_package_enquiry',
          data : $('form').serialize(),

          success: function(data){
           // console.log(data.message);
            $('#name').html(data.name);
            $('#success').html(data.message);
            $('#myModal').hide();
            $('#myModal1').show();
          }
        });       
      });
      $('#modalClose').on('click', function () {
            $('#myModal1').hide();
            location.reload();
        });
   });
</script>