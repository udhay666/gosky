<?php if (!empty($result)) { 
  //echo '<pre>';print_r($result);exit;
  //echo $im;exit;
  // $im=0;
  $session_data = $this->session->userdata('hotel_search_data');
  $city_arr = explode(',',$session_data['cityName']);
  $cityName = $city_arr[0];
  $rooms = $session_data['rooms'];
  $nights = $session_data['nights'];
  $per_room_cost = round((($result->total_cost / $rooms) / $nights), 2);
?>
<div class="row rooms_loop">
    <div class="htl-rm-detail">
      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 htl-type2 trim-right">
          <?php if(!empty($rimage)){ ?>
          <img src="<?php echo $rimage ?>" width="170" height="100" alt="<?php echo $rimage; ?>" title="<?php echo $result->room_type ?>" border="0" />
          <?php }else{ ?>
          <img src="<?php echo base_url() ?>public/img/noimage.jpg" width="100" height="100" alt="No Image" border="0" />
          <?php } ?>
          <!-- <?php //if(!empty($result->room_image)){ ?>
           <img src="<?php //echo $result->room_image ?>" width="170" height="100" alt="<?php //echo $result->room_type ?>" title="<?php //echo $result->room_type ?>" border="0" />
          <?php // } else { ?>
           <img src="<?php //echo base_url() ?>public/img/noimage.jpg" width="100" height="100" alt="No Image" border="0" />
          <?php //} ?> -->
        </div>
        <div class="col-lg-3 col-md-2 col-sm-2 col-xs-6 htl-type2 trim-right">
          <div class="htl-type-dtls2">
            <span>Room Type</span>
          </div>
          <span><?php  echo $result->room_type ?></span>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 htl-type2 trim-right">
          <div class="htl-type-dtls2">
            <span>Inclusion</span>
          </div>
          <p style="text-align: left;"><?php if($result->inclusion=='None' || empty($result->inclusion)){ echo 'Room Only';}else{ $inc=explode(',',$result->inclusion); foreach($inc as $val){echo trim($val).'<br>';} } ?></p>
        </div>
        <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 htl-type2 canc_policy trim-right">
        <div class="htl-type-dtls2">
        <span>Cancellation policy <i class="fa fa-info-circle"></i></span>
        </div>
        <div class="can_p"><b><?php //echo $result->room_type ?></b>
        <?php //echo $result->cancel_policy; ?></div>
        </div> -->
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 htl-type2 trim-right">
          <div class="htl-type-dtls2">
            <span>Per Room Per Night</span>
          </div>
          <span class="htlprice"><i class="fa fa-rupee"></i><?php echo number_format(round($per_room_cost)) ?></span>
          <!--  <span class="htl-cncel"><a href="#" data-toggle="modal" data-target="#modalcancelpolicy">Cancellation Policy <span class="fa fa-info-circle" aria-hidden="true" style="font-size: 18px;opacity: .7;"></span></a></span> -->
        </div>
        <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12 trim-right">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 trim-right">
            <div class="htl-type-dtls2">
              <span>Total Price</span>
            </div>
            <span class="htls-rm-price" style="display: block;"><i class="fa fa-rupee"></i> <?php echo number_format($result->total_cost) ?>
              <!-- <br><?php echo  $result->xml_currency.' '.number_format($result->org_amt); ?> -->
            </span>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 trim-right htlbtnn"  style="margin-top: 20px;">
            <a href="<?php echo site_url() ?>hotels/itinerary?callBackId=<?php echo  base64_encode('travelguru') ?>&hotelCode=<?php echo $result->hotel_code ?>&searchId=<?php echo $result->search_id ?>&sessionId=<?php echo $result->session_id ?>" ><button class="btn btn-primary">BOOK NOW</button></a>
          </div>
        </div>
      </div>
      <div class="row htl-ind-details" id="htl-ind-details">
        <div class="col-md-12">
          <p> </p>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript">
  $('.htl-rm-detail .canc_policy i, .htl-rm-detail .canc_policy div.can_p').mouseover(function() {
    $(this).parents('.htl-rm-detail').find('.canc_policy div.can_p').show();
  });
  $('.canc_policy i').mouseleave(function() {
    $(this).parents('.htl-rm-detail').find('.canc_policy div.can_p').hide();
  });
  $('.rooms_loop+.rooms_loop').css('display', 'none');
  var _length = $('.rooms_loop').length;
  if(_length<2){
    $('.hide-more-rooms').css('display', 'none');
  }
</script>
<?php } ?>