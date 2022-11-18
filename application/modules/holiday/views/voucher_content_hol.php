<script>
function coderHakan()
{  // alert("hi");
var sayfa = window.open($(this).attr("href"), "popupWindow", "width=800,height=800,scrollbars=yes");
sayfa.document.open("text/html");
sayfa.document.write(document.getElementById('printArea').innerHTML);
//sayfa.document.close();
sayfa.print();
//sayfa.close();
}
</script>
<div id="printArea">
  <div>
    <div>
      <div class="bgcolor_gray" style="background-color:#f7f7f4;">
        <div>
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td class="bgcolor_gray1" align="center">
                <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url(); ?>public/images/logo.jpg" style="float:left;width:100px;background:#a01d26;    height: 40px; " /></a><b>Holiday Voucher</b>
              </td>
            </tr>
            <tr>
              <td style="background: #a01d26;color: white;"><strong>Holiday Package</strong></td>
            </tr>
            <tr>
              <td bgcolor="#f7f7f7">
                <table width="70%" border="0" cellspacing="0" cellpadding="5" class="font_size13 color_gray1" align="left">
                  <tr>
                    <td>
                      Tittle : <?php echo $holiday_booking_info->pcakage_title; ?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Duration : <?php echo $holiday_booking_info->holiday_duration; ?>
                      
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Countries : <?php
                      $country = $holidaydetails->country;
                      $country_name = explode(',', $country);
                      $visit_country_name = '';
                      foreach ($country_name as $visit) {
                      $countryname=$this->Holiday_Model->getholivisitcountry($visit);
                      $visit_country_name.=$countryname->country_name . ' ,';
                      }
                      $visit_country=rtrim($visit_country_name,',');
                      echo $visit_country;
                      ?>
                      
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Cities : <?php
                      $city = $holidaydetails->destination;
                      $city_name = explode(',', $city);
                      $visit_name = '';
                      foreach ($city_name as $visit) {
                      $cityname=$this->Holiday_Model->getholivisitcity($visit);
                      $visit_name.=$cityname->city_name . ' ,';
                      }
                      $visit=rtrim($visit_name,',');
                      echo $visit;
                      ?>
                      
                    </td>
                  </tr>
                </table>
                <table width="30%" border="0" cellspacing="0" cellpadding="5" class="font_size13 color_gray1" align="left">
                  <tr>
                    <td>
                      Arrival Date : <?php echo $holiday_booking_info->arrival_date; ?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Issued on Date :  <?php echo $holiday_booking_info->booking_datetime; ?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Booking Reference : <?php echo $holiday_booking_info->uniqueRefNo; ?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Booking Contact : <?php echo $holiday_booking_info->user_mobile; ?>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>Booking Status:</strong>
                      <?php
                      if ($holiday_booking_info->booking_status == 'Success' )
                      echo '<span style="color:green">Success</span>';
                    ?></td>
                  </tr>
                  
                  <tr>
                    <?php
                    $tprice=$pay_info->amount;
                    $trprice=round($tprice/100);
                    
                    ?>
                    <td class="color_black font_size15">
                      <strong>Total Price : </strong><?php
                      echo '<i class="fa fa-rupee"><strong>'.$trprice.'</strong></i>';
                    ?> </td>
                    
                    
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="background: #a01d26;color: white;"><strong>Accommodation</strong></td>
            </tr>
            <tr>
              <td bgcolor="#f7f7f7">
                <table width="70%" border="0" cellspacing="0" cellpadding="5" class="font_size13 color_gray1" align="left">
                  <tr>
                    <td>
                      Accommodation Type :  <?php echo $holiday_booking_info->accommodation_type; ?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Number of Room :  <?php echo $holiday_booking_info->room_count; ?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <?php
                      $room_arr=json_decode($holiday_booking_info->room_details,true);
                      if(!empty($room_arr)){ ?>
                      <div class="row" style="margin-top:10px"></div>
                      <table align="left" style="width:72%;" class="table table-striped table-bordered">
                        <tr>
                          <th>Room No</th>
                          <th>Room Type</th>
                          <th>No of Adults</th>
                          <th>No of Childs</th>
                          <th>No of Infants</th>
                        </tr>
                        <?php for($i=0;$i<count($room_arr);$i++){ ?>
                        <tr>
                          <td>Room <?php echo ($i+1);?></td>
                          <td><?php echo ucfirst($room_arr[$i]['type']).' '.'Sharing';?></td>
                          <td><?php echo $room_arr[$i]['adults'];?></td>
                          <td><?php echo $room_arr[$i]['childs'];?></td>
                          <td><?php echo $room_arr[$i]['infants'];?></td>
                        </tr>
                        <?php } ?>
                        
                      </table>
                      
                      <?php } ?>
                    </td>
                  </tr>
                </table>
                <table width="30%" border="0" cellspacing="0" cellpadding="5" class="font_size13 color_gray1" align="left">
                  <tr>
                    <td>
                      No of Adults : <?php echo $holiday_booking_info->adults_no; ?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      No of Childs :  <?php echo $holiday_booking_info->childs_no; ?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      No of Infants : <?php echo $holiday_booking_info->infants_no; ?>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="background: #a01d26;color: white;"><strong>Passengers</strong></td>
            </tr>
            <tr>
              <td bgcolor="#f7f7f7">
                <table width="60%" border="0" cellspacing="0" cellpadding="5" class="font_size13 color_gray1" align="left">
                  <?php if(!empty($passenger_info)){ ?>
                  <?php for($i=0;$i<count($passenger_info);$i++){ ?>
                  <tr>
                    <td>
                      Passenger <?php echo ($i+1); ?> : <?php echo $passenger_info[$i]->title.' '.$passenger_info[$i]->first_name.' '.$passenger_info[$i]->middle_name.' '.$passenger_info[$i]->last_name; ?>
                    </td>
                    <td>
                      Age :  <?php
                      $dob = explode('/', $passenger_info[$i]->dob);
                      $dobStr=$dob[2].'-'.$dob[1].'-'.$dob[0];
                      $from = new DateTime($dobStr);
                      $to   = new DateTime('today');
                      echo $from->diff($to)->y;
                      ?>
                    </td>
                  </tr>
                  <?php }  } ?>
                </table>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clear"></div>