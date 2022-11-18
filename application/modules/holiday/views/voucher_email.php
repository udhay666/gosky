<!DOCTYPE html>
<!-- [if lte IE 8]>               <html class="ie8 no-js" lang="en">    <![endif] -->
<!-- [if lte IE 10]>              <html class="ie10 no-js" lang="en">   <![endif] -->
<!-- [if !IE]> -->
<html class="not-ie no-js" lang="en">
    <!-- <![endif] -->
    <head>
        <!-- Google Web Fonts
        ================================================== -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:100,300,300italic,400,700|Julius+Sans+One|Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <!-- Basic Page Needs
        ================================================== -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Akbar Holidays</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicons
        ================================================== -->
        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- CSS======== -->      
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/fonts/font-awesome-4.4.0/css/font-awesome.min.css" />   
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/fonts/ss-social/css/ss-social-regular.css" />       
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/grid.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/layout.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/fontello.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/myicons/css/my-icons.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/animation.css" />
        <link href="<?php echo base_url(); ?>public/css/nanoscroller.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/js/layerslider/css/layerslider.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/js/flexslider/flexslider.css" />
        <link href="<?php echo base_url(); ?>public/css/jquery.bxslider.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>public/css/jquery-nicelabel.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>public/css/addSlider.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css">
        <link href="<?php echo base_url(); ?>public/css/datepicker.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/result.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/social-button-min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/responsive.css" />
        <!-- HTML5 Shiv
         ================================================== -->
        <script src="<?php echo base_url(); ?>public/js/jquery.modernizr.js"></script>
     <script type = "text/javascript" >
  function changeHashOnLoad() {
  window.location.href += "#";
  setTimeout("changeHashAgain()", "50");
  }
  function changeHashAgain() {
  window.location.href += "1";
  }
  var storedHash = window.location.hash;
  window.setInterval(function () {
  if (window.location.hash != storedHash) {
  window.location.hash = storedHash;
  }
  }, 50);
</script>
<script>
  function coderHakan() {
  // alert("hi");
  var sayfa = window.open($(this).attr("href"), "popupWindow", "width=800,height=800,scrollbars=yes");
  sayfa.document.open("text/html");
  sayfa.document.write(document.getElementById('printArea').innerHTML);
  //sayfa.document.close();
  sayfa.print();
  //sayfa.close();
  }
</script>
<style type="text/css">
  @font-face {
    font-family: 'Montserrat';
    src: url('../public/fonts/Montserrat-Bold.otf');
    src: url('../public/fonts/Montserrat-Bold.otf') format('embedded-opentype'),
         url('../public/fonts/fontello.woff') format('woff'),
         url('../public/fonts/fontello.ttf') format('truetype'),
         url('../public/fonts/fontello.svg#fontello') format('svg');
    font-weight: normal;
    font-style: normal;
  }
  *, body{
    /*font-family: 'Montserrat', sans-serif;*/
    font-family: 'Open Sans', sans-serif;
  }
  h1,h2,h3,h4,h5,h6{
    font-family: 'Montserrat', sans-serif;
  }
  table.content-table,table.content-table td{border: 1px solid #eee;}
  table.content-table td{padding-left: 5px;}
</style>
 </head>
  <body onload="changeHashOnLoad();" style="margin: 0; padding: 0; background-color: #e5e5e5;" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
    <div class="flightsContainer margintop97">
      <div class="container"  style="  line-height: 45px;">
        <?php if(!empty($holiday_booking_info)) {?>
        <div id="printArea" >       
          <table width="900" border="0" cellspacing="0" cellpadding="0" style="background: #fff;margin: 0 auto;">
            <tr>
              <td>              
                <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td valign="middle" width="11px" height="100"></td>
                    <td valign="middle" height="100px">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr bgcolor="#FFFFFF">
                          <td width="100%" height="100px">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td>
                                  <h1  style="padding: 0; color: #fff;text-align: right;">
                                    <a href="<?php echo base_url(); ?>">
                                    <img src="<?php echo base_url(); ?>public/images/Akbar_Holidays_Logo.png"  style=" max-height: 28%;max-width: 28%;-webkit-transform-style: preserve-3d;    color: #000;will-change: width;text-align: center;"/></a>
                                  </h1>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>                      
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" style=" margin-top: -100px">
                        <tr>
                          <td valign="top"></td>
                          <td bgcolor="#FFFFFF" valign="top">
                            <table style="width: 600px;
                                margin-left: 17px;" border="0" align="left"  cellpadding="0" cellspacing="0" >
                              <tr>
                                <td valign="top">
                                  <p style="color: #333333; margin: 0; padding: 0;line-height: 1.7;"><br><strong>Dear <?php echo $holiday_booking_info->title.' '.$holiday_booking_info->first_name.' '.$holiday_booking_info->middle_name.' '.$holiday_booking_info->last_name; ?>,</strong><br>
                                    Thank you for booking with Akbar Holidays.<br><br>
                                    We are currently processing your booking request. Please note that this is not a confirmation of your travel arrangements.<br><br>
                                    You will receive another email within two working days from your designated travel consultant. It will include more details about your travel arrangements. (We recommend waiting to book flights until you receive this.)<br><br>
                                    Below is a copy of your booking request for this tour: <a href="<?php echo site_url();?>holiday/holidaydetails/<?php echo base64_encode('AKBARHOLIDAYSPACKAGECODE'.$holiday_booking_info->holiday_id);?>" target="_blank"><?php echo $holiday_booking_info->package_title; ?></a><br>
                                  Please save this for your records.</p>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>                   
                    </td>
                  </tr>
                </table>             
                <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="62" width="11" valign="middle"></td>
                    <td height="62" bgcolor="#FFFFFF" valign="middle" style="vertical-align: middle;">
                      <table width="878" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" height="37" bgcolor="#A01D26" style="background: #A01D26;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>                             
                                <td width="15" height="37"></td>
                                <td>
                                  <h2 style="color: #fff !important; font-size: 21px;  margin: 0; padding: 0; "> CUSTOMER DETAILS</h2>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top"></td>
                    <td bgcolor="#FFFFFF" valign="top">
                      <table width="878" border="1" align="center" cellpadding="5" cellspacing="0"  class="content-table">
                        <tr>
                          <td valign="top" width="30%" >Name:</td>
                          <td valign="top" ><?php echo $holiday_booking_info->title.' '.$holiday_booking_info->first_name.' '.$holiday_booking_info->middle_name.' '.$holiday_booking_info->last_name; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%" >Customer order ID:</td>
                          <td valign="top" ><?php echo $holiday_booking_info->uniqueRefNo; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%" >Email:</td>
                          <td valign="top" ><?php echo $holiday_booking_info->user_email; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%" >Phone Number:</td>
                          <td valign="top" ><?php echo $holiday_booking_info->user_mobile; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%" >Address:</td>
                          <td valign="top" ><?php echo $holiday_booking_info->address; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%" >City:</td>
                          <td valign="top" ><?php echo $holiday_booking_info->user_city; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%" >State:</td>
                          <td valign="top" ><?php echo $holiday_booking_info->user_state; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%" >Postal Code:</td>
                          <td valign="top" ><?php echo $holiday_booking_info->user_pincode; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%" >Country:</td>
                          <td valign="top" ><?php echo $holiday_booking_info->user_country; ?></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>              
                <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="62" width="11" valign="middle"></td>
                    <td height="62" bgcolor="#FFFFFF" valign="middle" style="vertical-align: middle;">
                      <table width="878" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" height="37" bgcolor="#A01D26" style="background: #a01d26;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>                                
                                <td width="15" height="37"></td>
                                <td>
                                  <h2 style="color: #fff !important; font-size: 21px;  margin: 0; padding: 0; "> BOOKING DETAILS</h2>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top"></td>
                    <td bgcolor="#FFFFFF" valign="top">
                      <table width="878" border="1" align="center" cellpadding="5" cellspacing="0"  class="content-table">
                        <tr>
                          <td valign="top" width="30%" >Package Name:</td>
                          <td valign="top" ><?php echo $holiday_booking_info->package_title; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%" >Date of Arrival</td>
                          <td valign="top" ><?php echo $holiday_booking_info->arrival_date; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%" >Date of Departure</td>
                          <td valign="top" ><?php echo $holiday_booking_info->depart_date; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%" >Adult(s):</td>
                          <td valign="top" ><?php echo $holiday_booking_info->adults_no; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%" >Child(ren):</td>
                          <td valign="top" ><?php echo $holiday_booking_info->childs_no; ?></td>
                        </tr>
                         <tr>
                          <td valign="top" width="30%" >Child(ren) Without Bed:</td>
                          <td valign="top" ><?php echo $holiday_booking_info->childswithoutbed_no; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%" >Infant(s):</td>
                          <td valign="top" ><?php echo $holiday_booking_info->infants_no; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%" >Duration:</td>
                          <td valign="top" ><?php echo $holiday_booking_info->holiday_duration; ?></td>
                        </tr>                      
                        <tr>
                          <td valign="top" width="30%" >Accommodation:</td>
                          <td valign="top" ><?php echo $holiday_booking_info->accommodation_type; ?></td>
                        </tr>                      
                       <!--  <tr>
                          <td valign="top" width="30%" >Total Price:</td>
                          <td valign="top" ><?php  echo '<i class="fa fa-rupee"></i> '.moneyFormatIndia(round($holiday_booking_info->package_amount));?></td>
                        </tr> -->
                         <?php if($holiday_booking_info->discount_amount==0) { ?>
                        <tr>
                          <td valign="top" width="30%">Total Price:</td>
                          <td valign="top"><?php  echo '<i class="fa fa-rupee"></i> '.moneyFormatIndia(round($holiday_booking_info->package_amount));?></td>
                        </tr>
                        <?php } else { ?>
                         <tr>
                          <td valign="top" width="30%">Promotional Code:</td>
                          <td valign="top"><?php  echo $holiday_booking_info->promo_code;?></td>
                        </tr>
                         <tr>
                          <td valign="top" width="30%">Total Price:</td>
                          <td valign="top"><?php  echo '<i class="fa fa-rupee"></i> '.moneyFormatIndia(round($holiday_booking_info->package_cost));?></td>
                        </tr>
                         <tr>
                          <td valign="top" width="30%">Discount Price:</td>
                          <td valign="top"><?php  echo '<i class="fa fa-rupee"></i> '.moneyFormatIndia(round($holiday_booking_info->discount_amount));?></td>
                        </tr>
                         <tr>
                          <td valign="top" width="30%">Grand Total Price:</td>
                          <td valign="top"><?php  echo '<i class="fa fa-rupee"></i> '.moneyFormatIndia(round($holiday_booking_info->package_amount));?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                          <td valign="top" width="30%" >Payment made:</td>
                          <td valign="top" >   <?php
                            $tprice=$pay_info->amount;
                            // $trprice=round($tprice/100);
                            echo '<i class="fa fa-rupee"></i> '.moneyFormatIndia($tprice);
                          ?></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>               
                <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="62" width="11" valign="middle"></td>
                    <td height="62" bgcolor="#FFFFFF" valign="middle" style="vertical-align: middle;">
                      <table width="878" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" height="37" bgcolor="#A01D26" style="background: #A01D26">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="15" height="37"></td>
                                <td>
                                  <h2 style="color: #fff !important; font-size: 21px;  margin: 0; padding: 0; "> DETAILS OF ALL PASSENGERS TRAVELLING</h2>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top"></td>
                    <td bgcolor="#FFFFFF" valign="top">
                      <table width="878" border="1" align="center" cellpadding="5" cellspacing="0"  class="content-table">
                        <?php if(!empty($passenger_info)){ ?>
                        <?php for($i=0;$i<count($passenger_info);$i++){ ?>
                        <tr>
                          <td valign="top" width="30%" ><?php echo $passenger_info[$i]->title.' '.$passenger_info[$i]->first_name.' '.$passenger_info[$i]->middle_name.' '.$passenger_info[$i]->last_name; ?></td>
                          <td valign="top" ><?php echo $passenger_info[$i]->dob;?></td>                     
                        </tr>
                        <?php }  } ?>
                      </table>
                    </td>
                  </tr>
                </table>
                <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="62" width="11" valign="middle"></td>
                    <td height="62" bgcolor="#FFFFFF" valign="middle" style="vertical-align: middle;">
                      <table width="878" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" height="37" bgcolor="#A01D26" style="background: #A01D26">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="15" height="37"></td>
                                <td>
                                  <h2 style="color: #fff !important; font-size: 21px;  margin: 0; padding: 0; "> ADDITIONAL INFORMATION</h2>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top"></td>
                    <td bgcolor="#FFFFFF" valign="top">
                      <table width="878" border="1" align="center" cellpadding="5" cellspacing="0"  class="content-table">
                        <tr>
                          <td valign="top" width="30%" >Comment:</td>
                          <td valign="top" ><?php echo $holiday_booking_info->user_comment; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%" >Travel consultant:</td>
                          <td valign="top" >info@akbarholidays.com</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td valign="middle" width="11" height="70"></td>
                    <td valign="top"></td>
                    <td bgcolor="#FFFFFF" valign="top" style="vertical-align: middle;">
                      <table width="878" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td valign="top">
                            <p style="color: #333333; margin: 0; padding: 0;line-height: 1.7;">If any of the above details are incorrect, or if you have any questions about your booking request, please email us at info@akbarholidays.com. Please indicate your booking reference number in the message.</p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="middle" width="11" height="70"></td>
                    <td valign="top"></td>
                    <td bgcolor="#FFFFFF" valign="top">
                      <table width="878" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td valign="top">
                            <p style="color: #333333; margin: 0; padding: 0;line-height: 1.7;">Best wishes,</p>
                            <p style="color: #333333; margin: 0; padding: 0;line-height: 1.7;">Akbar Holidays.</p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </div>
        <div class="clear"></div>
        <?php }else{ ?>
        <table align="center" width="100%">
          <tr>
            <td bgcolor="#e7e7e7" align="center">
              <h3>Sorry, No Voucher is Availbale.. Please try for another voucher...</h3>
            </td>
          </tr>
        </table>
        <?php } ?>
      </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
 </body>
 </html>
<?php
function moneyFormatIndia($num){
$explrestunits = "" ;
if(strlen($num)>3){
$lastthree = substr($num, strlen($num)-3, strlen($num));
$restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
$restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
$expunit = str_split($restunits, 2);
for($i=0; $i<sizeof($expunit); $i++){
// creates each of the 2's group and adds a comma to the end
if($i==0)
{
$explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
}else{
$explrestunits .= $expunit[$i].",";
}
}
$thecash = $explrestunits.$lastthree;
} else {
$thecash = $num;
}
return $thecash; // writes the final format where $currency is the currency symbol.
}
?>