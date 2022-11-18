<?php $this->load->view('home/header'); ?>
<?php
$this->load->database();
$this->load->model('Holiday_Model');
?>
<?php if(!empty($map['html'])) { echo $map['js']; }?> 
<!-- Popup Loader Css-->
<style type="text/css">
    #rapid_fire_draft_loading {
        background-color: #40A1D3;
        border-radius: 6px;
        box-shadow: 0 3px 5px 0 #202020;
        color: #FBD72B;
        font-size: 11px;
        font-weight: bold;
        left: 50%;
        margin-left: -125px;
        padding: 15px;
        position: absolute;
        top: 45%;
        z-index: 0;
        margin-top: 75px;
    }
    #rapid_fire_draft_loading img {
        margin-left: 8px;
    }
</style>
<div class="holidayCntr">
    <div class="container"> 

        <!--car search section-->
        <div class="row">

            <div class="col-md-12">
                <div class="holidayResults">
                    <div class="row">
                        <?php if ($holiday_details) { ?>
                            <div class="col-md-3">
                                <?php if ($holiday_details->thumb_image != '' && $holiday_details->thumb_image != '--None--') { ?> 
                                    <img src="<?php echo base_url(); ?>admin/holidayimages/<?php echo $holiday_details->thumb_image; ?>"  alt="<?php echo $holiday_details->package_title; ?>" title="<?php echo $holiday_details->package_title; ?>" border="0" />
                                <?php } else { ?> 
                                    <img src="<?php echo base_url(); ?>admin/holidayimages/default-htl-img.jpg"  alt="No Image" border="0" />
                                <?php } ?>

                            </div>
                            <div class="col-md-6">
                                <h3><?php echo $holiday_details->package_title; ?></h3>
                                <div class="visits">
                                    <strong>Visit:</strong>
                                    <?php
                                    $city = $holiday_details->destination;
                                    $city_name = explode(',', $city);
                                    $cityname = $this->Holiday_Model->getvisitcity($city_name);
                                    $visit_name = '';
                                    foreach ($cityname as $visit) {
                                        $visit_name.=$visit->city_name . ',';
                                    }
									$visit=rtrim($visit_name,',');
                                    echo $visit;
                                    ?>
                                </div><br>
								<?php if(!empty($holiday_details->special_offers)) {  ?>
                                <div class="holidayPrice">
                                    <strong style="color:red;">Special Offer:</strong><br> <?php echo $holiday_details->special_offers;?>
                                </div><br>
								<?php } ?>
                                
								<div class="holidayPrice">
                                    <strong>Validity:</strong>&nbsp;<span><?php echo $holiday_details->start_date;?> - <?php echo $holiday_details->end_date;?></span>
                                </div><br>
                               <!-- <div><strong>Includes :</strong><?php
                                //$inclusion = $holiday_details->inclusion;
                                //$inclusion_text = substr($inclusion, 0, 150);
                                //echo $inclusion_text . '....more';
                                ?></div>-->

                            </div>
							<div class="col-md-3" style="position: relative;right: 22px;width: 25%;">
							<div class="holidayPrice">
                                    <strong style="left: 179px;position: relative;">Starting From</strong>&nbsp;<span style=" left: 205px;
    position: relative;"class="priceOffer"><i class="fa fa-rupee"></i><?php echo $holiday_details->adult_price; ?></span> 
	<span style="left: 96px;
    position: relative;"><label style="color:red;">*</label>&nbsp;per person on twin sharing</span>
                                </div> <br><br>
								<div style="background-color: hsl(0, 0%, 96%);
    border: 1px solid hsl(0, 0%, 0%);
    border-radius: 10px;
    height: 103px;
    margin: -31px 0 0 38px;
    width: 227px;">
								<ul style="list-style:none;">
								<li><a style="text-decoration:none;" href="<?php echo site_url();?>/home/user_enq"><img style="width:20px;height:20px;" src="<?php echo base_url();?>public/img/enq.jpg"/>&nbsp;&nbsp;Send Enquiry</a></li>
								<li><a style="text-decoration:none;" data-toggle="modal" data-target="#modalshare" href="#"><img style="width:20px;height:20px;" src="<?php echo base_url();?>public/img/frnd.jpg"/>&nbsp;&nbsp;Send To Friend</a></li>
								<li><a style="text-decoration:none;" id="print" href="#"><img style="width:20px;height:20px;" src="<?php echo base_url();?>public/img/print_Icon.png"/>&nbsp;&nbsp;Print</a></li>
								<li><a style="text-decoration:none;"  href=""><img style="width:20px;height:20px;" src="<?php echo base_url();?>public/img/share.jpg"/>&nbsp;&nbsp;Share</a></li>
								</ul>
								
								</div>
							
							</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="holidayResults">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li><a href="#checkAvailability" role="tab" data-toggle="tab">1.CHECK AVAILABILITY</a></li>
                            <li class="active"><a href="#passengerInfo" role="tab" data-toggle="tab">2. PROVIDE PASSENGER INFO</a></li>
                            <li><a href="#proceedPayment" role="tab" data-toggle="tab">3. PROCEED TO PAYMENT</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <!--end of check avail -->  

                        <!--Passenger info -->
                        <div class="tab-pane" id="passengerInfo">
                            <div class="padding10">
                                <form method="POST" id="passenger_info" action="<?php echo site_url();?>/holiday/holi_payment" name="passenger_info" >
                                    <input type="hidden" name="id" value="<?php echo $holiday_details->holiday_id;?>"/>
									<input type="hidden" name="dept-date" value="<?php echo $s_date ;?>"/>
                                    <div class="row">
                                        <div class="col-md-12"><h3>Please Enter your Details.</h3></div>
                                    </div>
                                                                   <div class="row">
                                                                        <div class="col-md-12"><div class="blHeader">Room 1</div></div>
                                                                    </div>
                                    <div class="row marginTop15">
                                        <div class="col-md-12"><h4>Passenger 1</h4></div>
                                    </div>
                                    <div class="row marginTop15">
                                        <div class="col-md-2"><label>Title *</label></div>
                                        <div class="col-md-3 form-group">
                                            <select name="title[]" class="form-control ptitle ignore_val"  id="title" >
                                                <option value="0">-- select --</option>
                                                <option value="Mr">Mr.</option>
                                                <option value="Mrs">Mrs.</option>
                                                <option value="Mst">Mst.</option>
                                                <option value="Ms">Ms.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><label>First Name *</label></div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" name="firstname[]" class="form-control first-name ignore_val" placeholder="first name" id="fn" reqiured>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2"><label>Last name *</label></div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" name="lastname[]" class="form-control last-name ignore_val" id="ln" reqiured>
                                        </div>

                                        <div class="col-md-2"><label>Address Line 1 *</label></div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" name="add1" class="form-control" id="add1" reqiured>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2"><label>Address Line 2 *</label></div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" name="add2"class="form-control" id="add2" reqiured>
                                        </div>

                                        <div class="col-md-2"><label>City *</label></div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control" name="city" id="city" reqiured>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2"><label>State *</label></div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control" name="state" id="state" reqiured>
                                        </div>

                                        <div class="col-md-2"><label>Pin Code *</label></div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control" name="pincode" id="pincode"reqiured>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2"><label>Country *</label></div>
                                        <div class="col-md-3 form-group">
                                            <select class="form-control" name="country" id="country"reqiured>
										<option value="">Select Your Country</option>
										<optgroup label="Country List">                                       
                                        <?php
											for($i=0;$i<count($country_list);$i++) {?>
											<option value="<?php echo $country_list[$i]->name; ?>"><?php echo $country_list[$i]->name; ?></option>
										<?php }	?>										
										</optgroup>
                                            </select>
                                        </div>

                                        <div class="col-md-2"><label>Telephone *</label></div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" name="mobile" class="form-control" id="mobile" reqiured>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2"><label>Email *</label></div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" name="email" class="form-control" id="email" reqiured>
                                        </div>

                                        <div class="col-md-2"><label>Meal Type *</label></div>
                                        <div class="col-md-3 form-group">
                                            <select name="meal[]" class="form-control meal-type ignore_val" id="meal" reqiured>
                                                <option value="0">-- select --</option>
                                                <option value="veg">Veg</option>
                                                <option value="non veg">Non Veg</option>
                                                <option value="jain">Jain</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2"><label>Nationalilty *</label></div>
                                        <div class="col-md-3 form-group">
                                             <input type="text" class="form-control nationality ignore_val" id="nation" name="nationality[]" reqiured>
                                        </div>
                                    </div>
                                    <?php
									//echo $room_count;exit;
									$pass_room_count = array();

									for($i = 0;$i < $room_count ;$i++) {
										$pass_room_count[] = $adults[$i] + $childs[$i]  + $childs1[$i];
									}
									$room_index = 0;
									$pass_count = 1;
									//echo $pass_info;
										//	exit();
                                    for ($i = 1; $i < $pass_no; $i++) {
                                        ?>
                                        <div class="row">
										<?php //for($r=2;$r>=$room_count;$r++) ?>
										<?php if($pass_room_count[$room_index] == $pass_count) { 
												 $pass_count =1;
												 $room_index++;
									    ?>
											<div class="row">
                                            <div class="col-md-12"><div style="margin: 0 0 0 13px;
    width: 97.3%;" class="blHeader">Room <?php echo ($room_index+1); ?></div></div>
                                             </div>
												<!--<h4><strong>Room <?php// echo ($room_index+1); ?></strong></h4>-->
										<?php
											  } else {
												$pass_count++;
											  }
										?>
                                                  
                                            <div class="col-md-12"><h4>Passenger <?php echo ($i + 1); ?></h4></div>
                                            <div class="row marginTop15">
                                                <div class="col-md-2"><label style=" margin: 0 0 0 17px;">Title *</label></div>
                                                <div class="col-md-3 form-group">
                                                    <select style="margin: 0 0 0 8px;" name="title[]" class="form-control ptitle ignore_val" id="title" data-val="true" reqiured>
                                                        <option value="0">-- select --</option>
                                                        <option value="Mr">Mr.</option>
                                                        <option value="Mrs">Mrs.</option>
                                                        <option value="Mst">Mst.</option>
                                                        <option value="Ms">Ms.</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2"><label>First Name *</label></div>
                                            <div class="col-md-3 form-group">
                                                <input type="text" name="firstname[]"  id="fn" class="form-control first-name ignore_val" data-val="true" reqiured>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-2"><label>Last name *</label></div>
                                            <div class="col-md-3 form-group">
                                                <input type="text" name="lastname[]" id="ln" class="form-control last-name ignore_val" data-val="true" reqiured>
                                            </div>
                                            <div class="col-md-2"><label>Meal Type *</label></div>
                                            <div class="col-md-3 form-group">
                                                <select  name="meal[]" class="form-control meal-type ignore_val" id="meal" reqiured>
                                                    <option value="0">-- select --</option>
                                                    <option value="veg">Veg</option>
                                                    <option value="non veg">Non Veg</option>
                                                    <option value="jain">Jain</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-2"><label>Nationalilty *</label></div>
                                            <div class="col-md-3 form-group">
                                                <input type="text" class="form-control nationality ignore_val" id="nation" name="nationality[]" reqiured>
                                            </div>


                                        </div>

                                    <?php } ?><br>
									<div class="row">
									<label style="margin:0 0 0 19px;">JP Member - (YES/NO):</label>&nbsp;&nbsp;<input class="jp_no" type="checkbox" name="jp"  onchange="valueChanged()"/><br>
		 <div class="row">   <div class="col-md-4">	 <input type="text" style=" bottom: 25px;
    display: block;
    left: 207px;
    position: relative;
    width: 72%;" id="jpno" class="form-control form-group" placeholder="Enter the JP Number" name="user_jp"  autofocus=""></div></div>
										</div>
										<div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Special Request</label>
                                            <div class="controls" >
                                                <textarea style="margin:0px 0px 0px 192px;width:74%;"  name="spcl" ></textarea>
                                            </div>
                                        </div>

                                  <div class="row">
									<input type="hidden" value="<?php echo $holiday_details->adult_price;?> " name="peramt" />
    							<input type="hidden" value="<?php echo $total_price;?>" name="totalpr"/>
<div class="col-md-12 marginTop15" style="font-size:20px;">Token Amount Payable:
<span class="amountPayable"><h3><strong><i class="fa fa-rupee"></i>
<?php  if(!$total_price) echo $holiday_details->adult_price ; else echo $total_price; ?></strong></h3>&nbsp;
<em style=" bottom: 41px;left: 112px;position: relative;"class="days"><label style="color:Red;">*</label>per person</em>
</span>
</div>
                                        <strong style="color:red;">Token Amount Payable:Rs.5000</strong>
										<div class="col-md-12">
                                            <a href="<?php echo site_url(); ?>holiday/holiday_book/<?php echo $holiday_details->holiday_id; ?>" class="btn btn-success pull-left marginTop15"><i class ="fa fa-chevron-left"></i> &nbsp;&nbsp; PREVIOUS</a>
							<a href="#" class="btn btn-primary pull-right marginTop15" data-toggle="modal" data-target="#modalenquery">Send Enquiry</a>
											<!--<a href="<?php echo site_url();?>/holiday/send_hol_enq/" class="btn btn-primary pull-right marginTop15" >Send Enquiry</a>-->
                                            <input style="margin: 15px 17px 0 0;" type="submit" class="btn btn-primary pull-right marginTop15" value="CONTINUE"/>
                                        </div>
                                    </div>

                                </form>

                            </div>

                            <!--end og pass info -->
                            <!-- paymant ifo -->

                            <!-- paymant ifo -->
                        </div><!-- end of tabs div -->


                    </div>
                </div><!-- second div  -->
				<div class="htl-tabs-cntr marginTop15"> 
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" style="width:108%;margin:0 0 0 0px;">
								                                
								   <li id="inc" class="active"><a href="#htl-am" data-toggle="tab" style="font-size: 12px;"><strong>Highlights</strong></a></li>
                                    <li><a href="#di" data-toggle="tab" style="font-size: 12px;"><strong>Itinerary</strong></a></li>
                                    <!--<li><a href="#gm" data-toggle="tab" style="font-size: 12px;"><strong>Hotel Description</strong></a></li>-->
									 <li ><a href="#htl-overview" data-toggle="tab" style="font-size: 12px;"><strong>Inclusion</strong></a></li>
                                    <li><a href="#tc" data-toggle="tab" style="font-size: 12px;"><strong>Exclusion</strong></a></li>
                                    <!--<li><a href="#price" data-toggle="tab" style="font-size: 12px;"><strong>Comments</strong></a></li>
									<li><a href="#gal" data-toggle="tab" style="font-size: 12px;"><strong>Gallery</strong></a></li>-->
									<li><a href="#term" data-toggle="tab" style="font-size: 12px;"><strong>Terms & Conditions</strong></a></li>
    <!--<li><a href="" id="print" data-toggle="tab" style="font-size: 12px;"><strong>Print</strong></a></li>-->
	<!--<li><a href="#" style="background-color: hsl(214, 41%, 78%);
    font-size: 12px;" data-toggle="modal" data-target="#modalshare"><strong>Share</strong></a>
	</li>-->
									<?php if(!empty($map['html'])) { ?>
									<li><a class="mapDiv" href="#htl-map" data-toggle="tab" style="font-size: 12px;"><strong>Map & Attractions</strong></a></li>
									<?php } ?>
                                </ul>
                                <div class="white-container" style="background: none repeat scroll 0 0 hsl(182, 25%, 50%);width:103%;">
                                    <div class="tab-content">
                                        <div class="tab-pane  htl-dtls-amen" id="htl-overview">
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-12" style="width: 99%;">
													<div class="hotel-dtls-amenities">
                                            <span class="font20" style=" font-size: 14px;line-height:8px;text-align: left;"><?php echo nl2br($holiday_details->inclusion); ?></span>
</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										 <div class="tab-pane htl-dtls-amen" id="htl-over">
                                            <div class="row">
                                                <div class="col-md-12" style="width: 99%;">
                                                    <div class="hotel-dtls-amenities">
                                                         <span class="font20" style=" font-size: 14px;line-height:8px;text-align: left;"><?php echo nl2br($holiday_details->description); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane htl-dtls-amen active" id="htl-am">
                                            <div class="row">
                                                <div class="col-md-12" style="width: 99%;">
                                                    <div class="hotel-dtls-amenities">
                                                         <span class="font20" style=" font-size: 14px;line-height:8px;text-align: left;"><?php echo nl2br($holiday_details->highlights); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										
										<div class="tab-pane htl-dtls-amen" id="di">
                                            <div class="row">
                                                <div class="col-md-12" style="width: 99%;">
                                                    <div class="hotel-dtls-amenities">
                                                         <span class="font20" style=" font-size: 14px;line-height:15px;text-align: left;"><?php echo nl2br($holiday_details->itenery); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										
										<div class="tab-pane htl-dtls-amen" id="gm">
                                            <div class="row">
                                                <div class="col-md-12" style="width: 99%;">
                                                    <div class="hotel-dtls-amenities">
														<span class="font20" style=" font-size: 14px;line-height:8px;text-align: left;"><?php echo nl2br($holiday_details->hotel_desc); ?></span>
													</div>
												</div>
											</div>
                                        </div>
										
										<div class="tab-pane htl-dtls-amen" id="tc">
                                            <div class="row">
                                                <div class="col-md-12" style="width: 99%;">
                                                    <div class="hotel-dtls-amenities">
                                                         <span class="font20" style=" font-size: 14px;line-height:8px;text-align: left;"><?php echo nl2br($holiday_details->exclusion); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										
										<div class="tab-pane htl-dtls-amen" id="price">
                                            <div class="row">
                                                <div class="col-md-12" style="width: 99%;">
                                                    <div class="hotel-dtls-amenities">
                                                         <span class="font20" style=" font-size: 14px;line-height:8px;text-align: left;"><?php echo nl2br($holiday_details->comments); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="tab-pane" id="gal">
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-12" style="width: 99%;">
													<div class="hotel-dtls-amenities">
			<?php if($hol_img_id) foreach($hol_img_id as $gal_img) { ?>
			<img src="<?php echo base_url();?>admin/holidayimages/<?php echo $gal_img->holiday_images; ?>" width="200" height="200" />
			
			<?php } else { ?> 
                        <img src="<?php echo base_url(); ?>admin/holidayimages/default-htl-img.jpg" width="100" height="100" alt="No Image" border="0" />
                    <?php } ?>
 <?php /*if ($holiday_details->thumb_image != '' && $holiday_details->thumb_image != '--None--') { ?> 
                        <img src="<?php echo base_url();?>admin/holidayimages/<?php echo $holiday_details->large_img; ?>" width="200" height="200" alt="<?php echo $holiday_details->package_title; ?>" title="<?php echo $holiday_details->package_title; ?>" border="0" />
						<img src="<?php echo base_url();?>admin/holidayimages/<?php echo $holiday_details->thumb_image; ?>" width="200" height="200" alt="<?php echo $holiday_details->package_title; ?>" title="<?php echo $holiday_details->package_title; ?>" border="0" />
						
						
                    <?php } else { ?> 
                        <img src="<?php echo base_url(); ?>admin/holidayimages/default-htl-img.jpg" width="100" height="100" alt="No Image" border="0" />
                    <?php } */?>
</div>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
										<div class="tab-pane" id="term">
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-12" style="width: 99%;">
													<div class="hotel-dtls-amenities">
                                            <span class="font20" style=" font-size: 14px;line-height:8px;text-align: left;"><?php echo nl2br($holiday_details->terms); ?></span>
</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<?php if(!empty($map['html'])) { ?>
											<div class="tab-pane" id="htl-map">
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-12" style="width: 99%;">
													<div class="hotel-dtls-amenities">
                                            <?php echo $map['html']; ?>
</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<?php } ?>
										
										
                                    </div>
                                </div>
                                <!-- Tab panes -->
                            </div>
							
			
				
				
				<!-- -->
				<?php // if(!empty($holiday_details->inclusion)) { ?>
                <!--<div class="col-md-12">
                    <div class="holidayResults">
                        <div style=" font-size: 14px;line-height:8px;text-align: left;" class="padding10">
                            <h4><strong>Inclusions :</strong></h4>


                            <p><?php //echo nl2br($holiday_details->inclusion); ?></p>
                        </div>
                    </div>
                </div>
				<?php //} ?>
				<?php //if(!empty($holiday_details->highlights)) { ?>
				 <div class="col-md-12">
                    <div class="holidayResults">
                        <div style=" font-size: 14px;line-height:8px;text-align: left;" class="padding10">
                            <h4><strong>Highlights :</strong></h4>


                            <p><?php //echo nl2br($holiday_details->highlights); ?></p>
                        </div>
                    </div>
                </div>
				<?php //} ?>
				<?php //if(!empty($holiday_details->itenery)) { ?>
				<div class="col-md-12">
                    <div class="holidayResults">
                        <div style=" font-size: 14px;line-height:15px;text-align: left;" class="padding10">
                            <h4><strong>Itenary :</strong></h4>


                            <p><?php  //echo nl2br($holiday_details->itenery); ?></p>
                        </div>
                    </div>
                </div>
				<?php// } ?>
				<?php //if(!empty($holiday_details->hotel_desc)) { ?>
				<div class="col-md-12">
                    <div class="holidayResults">
                        <div  style=" font-size: 14px;line-height:8px;text-align: left;"class="padding10">
                            <h4><strong>Hotels Provided :</strong></h4>
                            <p><?php // echo nl2br($holiday_details->hotel_desc); ?></p>
                        </div>
                    </div>
                </div>
				<?php // } ?>
				<?php // if(!empty($holiday_details->exclusion)) { ?>
                <div class="col-md-12">
                    <div class="holidayResults">
                        <div style=" font-size: 14px;line-height:8px;text-align: left;" class="padding10">
                            <h4><strong>Exclusions :</strong></h4>


                            <p><?php // echo nl2br($holiday_details->exclusion); ?></p>
                        </div>
                    </div>
                </div>
<?php // } ?>
                <?php  //if(!empty($holiday_details->comments)) { ?>
				<div class="col-md-12">
                    <div class="holidayResults">
                        <div style=" font-size: 14px;line-height:8px;text-align: left;" class="padding10">
                            <h4><strong>Comments :</strong></h4>


                            <p><?php // echo nl2br($holiday_details->comments); ?></p>
                        </div>
                    </div>
                </div>
				<?php //} ?>
                <!---- end of inclusion and all -->
            </div>
        </div>
    </div> <!-- first div --> 
	<div class="modal fade" id="modalshare" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title" id="myModalLabel">Share To a Friend</h3>
                    </div>
                    <div class="modal-body">
                        <form class="form-signin" role="form" action="<?php echo site_url(); ?>holiday/share_hol" method="post">
		<input type="hidden" name="url" value="<?php echo site_url(); ?>holiday/holiday_book/<?php echo $holiday_details->holiday_id ;?>"	/>			  
        <input type="text" class="form-control form-group" placeholder="Enter the Your Name" name="user_name" required="" autofocus="">
		<input type="email" class="form-control form-group" placeholder="Enter the Email Address" name="user_email" required="" autofocus="">
		<br>	 
		<label>Enter Your Message:<textarea name="user_msg" rows="3" cols="40" placeholder="Enter Your Query"></textarea><br><br>
           <button class="btn btn-lg btn-primary btn-block" type="submit">SHARE</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
<?php } ?>
<div class="modal fade" id="modalenquery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title" id="myModalLabel">Send Enquiry</h3>
                    </div>
                    <div class="modal-body">
                        <form class="form-signin" role="form" action="<?php echo site_url(); ?>holiday/send_hol_enq" method="post">
		<div class="row">
		<div class="col-md-5">				  
        <input type="text" class="form-control form-group" placeholder="Enter the Your First Name" name="user_fname" required="" autofocus=""></div>
		<div class="col-md-5">
		<input type="text" class="form-control form-group" placeholder="Enter the Your  Last Name" name="user_lname" required="" autofocus="">
		</div>
		</div>
		<div class="row">
		<div class="col-md-5">
		<input type="text" class="form-control form-group" placeholder="Enter the Contact Number" name="user_number" required="" autofocus=""></div>
		<div class="col-md-5">
		<input type="email" class="form-control form-group" placeholder="Enter the Email Address" name="user_email" required="" autofocus="">
		</div>
		</div>
		<div class="row">
		<div class="col-md-5">
		<input type="text" class="form-control form-group" placeholder="Enter the JP Number" name="user_jp"  autofocus="">
		</div>
		<div class="col-md-5">
		<input type="text" class="form-control form-group" placeholder="Enter the Package Name" name="package_name"  autofocus="">
		</div>
		</div>
		<div class="row">
		<div class="col-md-5">
		<input type="text" class="form-control form-group" placeholder="No. Of Adults" name="no_ad"  autofocus="">
		</div>
		<div class="col-md-5">
		<input type="text" class="form-control form-group" placeholder="No. Of Child" name="no_ch"  autofocus="">
		</div>
		</div>
		<div class="row">
		<div class="col-md-10">
		<input type="text" class="form-control form-group" placeholder="Intersted Destination" name="dest"  autofocus="">
		</div>
		</div>
		<div class="row">
		<div class="col-md-6">
		<select required="" class="form-control form-group" autofocus=""  style="color: activeborder;" name="user_city">
        <option  value="Your City *">Select City</option>
		<?php
                                            $qry2 = mysql_query("SELECT DISTINCT(city_name),city_id FROM city_list WHERE city_type='Domestic'  order by city_name asc");
                                            while ($res2 = mysql_fetch_array($qry2)) {
                                                echo '<option value="' . $res2['city_name'] . '">' . $res2['city_name'] . '</option>';
                                            }
                                            ?>
		<select>
		</div>
		<div class="col-md-5">
		<select  class="form-control form-group"  style="color: activeborder;" name="user_loc">
        <option>Closest Location</option>
		<select>
		</div>
         </div> <br> 
			<div class="row">
                                        
                                        <div class="col-md-6 ">
                     <input type="text" class="form-control" placeholder="Travel Date" id="datepicker" name="departdate" autocomplete= "off"  data-date-format="dd/mm/yyyy" style="margin: 0 0 0 5px;"required />	
                                        </div>
                                    </div>	<br>	 
		<label>Enter Your Message:<textarea name="user_msg" rows="3" cols="40" placeholder="Enter Your Query"></textarea><br><br>
           <button class="btn btn-lg btn-primary btn-block" type="submit">Send Enquiry</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
<?php $this->load->view('home/footer');?>
<!-- if loop ends               --> 
<script src="<?php echo base_url(); ?>public/js/jquery-1.10.2.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/validation.js"></script>
<script src="<?php echo base_url(); ?>public/js/datepickerScript.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap-datepicker.js"></script> 
<script src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.nicescroll.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/jquery.jcarousel.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/bjqs-1.3.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/customize.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.validate.min.js"></script>
<style type="text/css">
.error {
    border-color: #cd0a0a !important;
    background: #fef1ec !important;
}
</style>
<script type="text/javascript">

$(document).ready(function() {
  	$('#passenger_info').validate({ 
		errorPlacement: $.noop,
		ignore: ".ignore_val",
		rules: {
				/* 'firstname[]': {
					required: true,
					minlength: 1
				}, 
				'title[]':{
					required: true,
					//minlength: 1
				},
				'lastname[]':
				{
				    required: true,
					minlength: 1
				}, */ 
				'add1':
				{
				 required: true,
					minlength: 1
				
				},
				'add2':
				{
				 required: true,
					minlength: 1
				
				},
				'city':
				{
				 required: true,
					minlength: 1
				
				},
				'state':
				{
				 required: true,
					minlength: 1
				
				},
				'pincode':
				{
				 required: true,
					minlength: 6,
					maxlength:6
				
				},
				'country':
				{
				 required: true,
					minlength: 1
				
				},
				/* 'meal[]':
				{
				 required: true,
				minlength: 0
				
				},  */
				'mobile':
				{
				 required: true,
					minlength: 10
				
				},
 				/* 'nationality[]':
				{
				 required: true,
				minlength: 1
				
				}, */ 
				'email':
				{
				 required: true,
				email:true
				
				}
			},
	invalidHandler: function(form, validator) {
        var errors = validator.numberOfInvalids();
        if (errors) {                    
            validator.errorList[0].element.focus();
        }
		$("input.first-name").each(function() {
			if($(this).val() == "" && $(this).val().length < 1) {
				$(this).addClass('error');
			} else {
				$(this).removeClass('error');
			}
		});		
		$("input.last-name").each(function() {
			if($(this).val() == "" && $(this).val().length < 1) {
				$(this).addClass('error');
			} else {
				$(this).removeClass('error');
			}
		});		
		$("select.ptitle").each(function() {
			if($(this).val() == "0" && $(this).val().length < 2) {
				$(this).addClass('error');
			
			} else {
				$(this).removeClass('error');
			}
		});		
		$("input.nationality").each(function() {
			if($(this).val() == "" && $(this).val().length < 1 ) {
				$(this).addClass('error');
			
			} else {
				$(this).removeClass('error');
			}
		});		
		$("select.meal-type").each(function() {
			if($(this).val() == "0" && $(this).val().length < 2 ) {
				$(this).addClass('error');
			
			} else {
				$(this).removeClass('error');
			}
		});		
    },
    submitHandler:function(form) {
		var isValid = true;
	
		$("input.first-name").each(function() {
			if($(this).val() == "" && $(this).val().length < 1) {
				$(this).addClass('error');
				//console.log('asd');
				isValid = false;
				/* var rules = $(this).rules();
				var element = $(this);
				var message = $('#passenger_info').validate().defaultMessage(element,rule.method);
				$('#passenger_info').validate().errorList.push({
					message: message,
					element: element,
					method: rule.method
				   });				 */
				//console.log($('#passenger_info').validate().errorList);				   
			} else {
				$(this).removeClass('error');
			}
		});		
		$("input.last-name").each(function() {
			if($(this).val() == "" && $(this).val().length < 1) {
				$(this).addClass('error');
				isValid = false;			
				/* var rules = $(this).rules();
				var element = $(this);
				var message = $('#passenger_info').validate().defaultMessage(element,rule.method);
				$('#passenger_info').validate().errorList.push({
					message: message,
					element: element,
					method: rule.method
				   });				 */
			} else {
				$(this).removeClass('error');
			}
		});		
		$("select.ptitle").each(function() {
			if($(this).val() == "0" && $(this).val().length < 2) {
				$(this).addClass('error');
				isValid = false;
			} else {
				$(this).removeClass('error');
			}
		});		
		$("input.nationality").each(function() {
			if($(this).val() == "" && $(this).val().length < 1 ) {
				$(this).addClass('error');
				isValid = false;
			} else {
				$(this).removeClass('error');
			}
		});		
		$("select.meal-type").each(function() {
			if($(this).val() == "0" && $(this).val().length < 2 ) {
				$(this).addClass('error');
				isValid = false;
			} else {
				$(this).removeClass('error');
			}
		});		
		//alert('asd');
		if(isValid) {
			form.submit();
		}
	}	
	});
	/* $("input.first-name").each(function() {
		$(this).rules("add",{
			required: true,
			minlength: 1		
		});
	}); */
});
</script>
<script>
$(document).ready(function(){
$("#print").click(function(){
//alert("jh");
window.print();

});
});
</script>
<script>
$(document).on("click", '.mapDiv', function ($e) 
{  		
	lastCenter=map.getCenter();	
	google.maps.event.trigger(map, 'resize');
	map.setCenter(lastCenter);
});

</script>
<script type="text/javascript">
$(document).ready(function() { 
$("#jpno").hide();
});
function valueChanged()
{
if($('.jp_no').is(":checked"))   
  $("#jpno").show();
else
  $("#jpno").hide();
}
</script>
<style>
.nav > li > a {
 line-height: 18px;
    min-height: 33px;
    min-width: 103px;
    padding: 6px;
    text-align: center;
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {

    background-color: hsl(180, 100%, 25%);
    

}
</style>
