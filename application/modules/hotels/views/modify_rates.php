<form action="<?php //echo site_url().'hotels/hotelroomdetails/'.base64_encode($ses_id.'/'.$refNo.'/'.$searchId.'/'.$hotelDetails->hotel_code.'/'. base64_encode('hotel_crs')); ?>" class="room-rates"  method="post" name="reservationform">
   <div class="row no-gutters">
      <div class="col-sm-2">
         <div class="form-group">
            <label for="dph5">Check-In</label>
            <input name="checkIn" type="text" value="<?php echo $checkIn;?>" class="form-control" placeholder="Check-In" id="dph5" autocomplete="off" readonly style="background: #fff;cursor: pointer;">
         </div>
      </div>
      <div class="col-sm-3">
         <div class="row no-gutters">
            <div class="col-md-9">
               <div class="form-group">
                  <label for="dph6">Check-Out</label>
                  <input name="checkOut" type="text" value="<?php echo $checkOut;?>" class="form-control" placeholder="Check-Out" id="dph6" autocomplete="off" readonly style="background: #fff;cursor: pointer;">
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label class="invisible" id="datadiffnight" data-val="Night"> <?php echo $nights; ?> Night</label>
                  <input name="night" id="datadiff" type="text" value="<?php echo $nights; ?> Night" class="form-control" autocomplete="off" style="background: transparent;border: none;box-shadow: none;cursor: default;padding: 0;margin: 0;text-align: center;" readonly="">
                  <input type="hidden" name="results_id" value="<?php //echo base64_encode($this->session->session_id.'/'.$newuniqueRefNo.'/'.''.'/'.$hotelDetails->hotel_code.'/'. base64_encode('hotel_crs').'/'.$city_code); ?>">
                  <input type="hidden" name="nationality" value="<?php //echo $nationality; ?>">
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-3 col-sm-4 pax_drop">
         <div class="form-group">
            <label class="control-label pax_label">No of Guests</label>
            <span class="form-control c-round c-theme travellers-input" id="travellers-hotel" style="line-height: 24px;">
               <span class="adultsF travellers-input"><?php echo $adults_count ?></span> adult,
               <span class="childsF travellers-input"><?php echo $childs_count ?></span> child,
               <span class="room_countF travellers-input"><?php echo $rooms ?></span> room
            </span>
         </div>
         <div class="travellers-input-popup" id="travellers-hotel-popup">
            <i class="mdi mdi-close-circle fa fa-times" aria-hidden="true"></i>
            <div class="trip-options">
               <p>Room - <span>1</span></p>
               <div class="numstepper small-btns">
                  <button type="button" class="quantity-btn quantity-left-minus btn-number-rooms"  data-type="minus" data-field="room_count"></button>
                  <input type="text" name="room_count" class="quantity-input input-number multi" value="<?php echo $rooms ?>" min="1" max="4">
                  <button type="button" class="quantity-btn quantity-right-plus btn-number-rooms" data-type="plus" data-field="room_count"></button>
               </div>
               <div class="clone-room">
                  <p class="rooms" style="display: none;">Room - <span>2</span></p>
                  <div class="numstepper small-btns">
                     <p>Adults</p>
                     <button type="button" class="quantity-btn quantity-left-minus btn-number-arr" data-type="minus" data-field="adults">
                     </button>
                     <input type="text" name="adults[]" class="quantity-input input-number adults" value="<?php echo $adults[0] ?>" min="1" max="3">
                     <button type="button" class="quantity-btn quantity-right-plus btn-number-arr" data-type="plus" data-field="adults">
                     </button>
                  </div>
                  <div class="clone-item roomage">
                     <input type="hidden" class="roomsno" value="1">
                     <p style="display: none;">Child Age - <span>1</span></p>
                     <div class="numstepper small-btns">
                        <p>Children</p>
                        <button type="button" class="quantity-btn quantity-left-minus btn-number-multi roomAge" data-type="minus" data-field="childs">
                        </button>
                        <input type="text" name="childs[]" class="quantity-input input-number multi childs" value="<?php echo $childs[0] ?>" min="0" max="3">
                        <button type="button" class="quantity-btn quantity-right-plus btn-number-multi roomAge" data-type="plus" data-field="childs">
                        </button>
                     </div>
                  </div>
                  <div class="clonediv">
                     <?php if($childs[0] > 0){ ?>
                     <?php $chAge = explode(',', $childs_ages[0]) ?>
                        <?php for($ch=0;$ch<count($chAge);$ch++){ ?>
                        <div class="clone-item roomage" id="clone-<?php echo $ch+1 ?>">
                           <input type="hidden" class="roomsno" value="1">
                           <p style="display: block;">Child Age - <span><?php echo $ch+1 ?></span></p>
                           <div class="numstepper small-btns">
                              <p style="display: none;">Children</p>
                              <button type="button" class="quantity-btn quantity-left-minus btn-number-arr2" data-type="minus" data-field="input-array">
                              </button>
                              <input type="text" name="childs_ages_room1[]" class="quantity-input input-number input-array" value="<?php echo $chAge[$ch] ?>" min="2" max="11" data-field="input-array">
                              <button type="button" class="quantity-btn quantity-right-plus btn-number-arr2" data-type="plus" data-field="input-array">
                              </button>
                           </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                     </div>
                  </div>
                  <div class="clonediv-room">
                     <?php if($rooms > 1){ ?>
                     <?php for($r=1;$r<$rooms;$r++){ ?>
                     <div class="clone-room" id="clone-room-<?php echo $r+1 ?>">
                        <p class="rooms" style="display: block;">Room - <span><?php echo $r+1 ?></span></p>
                        <div class="numstepper small-btns">
                           <p>Adults</p>
                           <button type="button" class="quantity-btn quantity-left-minus btn-number-arr" data-type="minus" data-field="adults">
                           </button>
                           <input type="text" name="adults[]" class="quantity-input input-number adults" value="<?php echo $adults[$r] ?>" min="1" max="3">
                           <button type="button" class="quantity-btn quantity-right-plus btn-number-arr" data-type="plus" data-field="adults">
                           </button>
                        </div> 
                        <div class="clone-item roomage">
                           <input type="hidden" class="roomsno" value="<?php echo $r+1 ?>">
                           <p style="display: none;">Child Age - <span>1</span></p>
                           <div class="numstepper small-btns">
                              <p>Children</p>
                              <button type="button" class="quantity-btn quantity-left-minus btn-number-multi roomAge" data-type="minus" data-field="childs">
                              </button>
                              <input type="text" name="childs[]" class="quantity-input input-number multi childs" value="<?php echo $childs[$r] ?>" min="0" max="3">
                              <button type="button" class="quantity-btn quantity-right-plus btn-number-multi roomAge" data-type="plus" data-field="childs">
                              </button>
                           </div>
                        </div>
                        <div class="clonediv">
                           <?php if($childs[$r] > 0){ ?>
                           <?php $chAge2 = explode(',', $childs_ages[$r]) ?>
                           <?php for($ch2=0;$ch2<count($chAge2);$ch2++){ ?>
                           <div class="clone-item roomage" id="clone-<?php echo $ch2+1 ?>">
                              <input type="hidden" class="roomsno" value="2">
                              <p style="display: block;">Child Age - <span><?php echo $ch2+1 ?></span></p>
                              <div class="numstepper small-btns">
                                 <p style="display: none;">Children</p>
                                 <button type="button" class="quantity-btn quantity-left-minus btn-number-arr2" data-type="minus" data-field="input-array">
                                 </button>
                                 <input type="text" name="childs_ages_room<?php echo $r+1 ?>[]" class="quantity-input input-number input-array" value="<?php echo $chAge2[$ch2] ?>" min="2" max="11" data-field="input-array">
                                 <button type="button" class="quantity-btn quantity-right-plus btn-number-arr2" data-type="plus" data-field="input-array">
                                 </button>
                              </div>
                           </div>
                           <?php } ?>
                           <?php } ?>
                        </div>
                     </div>
                     <?php } ?>
                     <?php } ?>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-1">
            <div class="form-group">
               <label class="invisible" style="width: 100%">Update</label>
               <button class="btn btn-custom">Update</button>
            </div>
         </div>
      </div>
   </form>