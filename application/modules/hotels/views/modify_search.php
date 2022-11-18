<!-- <div class="tab-pane fade show active" id="flights" role="tabpanel" aria-labelledby="flights-tab">
   <div class="modify-search pt-0"> -->
      <!-- <span class="mod-search-close" id="mod-search-close"><i class="mdi mdi-close-circle"></i></span> -->
      <!-- <div class="border-dashed clearfix"></div> -->
      <form class="" action="<?php echo site_url() ?>hotels/results" method="post">
         <div class="row no-gutters">
            <div class="col-sm-3">
               <div class="input-group">
                  <label for="destination2" class="input-group-addon"><i class="mdi mdi-map-marker-multiple"></i></label>
                  <input type="text" name="cityName" class="form-control autocity" id="destination2" placeholder="Enter a City or Airport" value="<?php echo $cityName ?>" autocomplete="off" onclick="this.select();" pop-type="hotels-tab" required="">
                  <input type="hidden" name="cityid" value="<?php echo $cityCode ?>" class="cityid" id="hotelcityid">
               </div>
            </div>
            <div class="col-sm-2">
               <div class="input-group">
                  <label for="dph1" class="input-group-addon"><i class="mdi mdi-calendar"></i></label>
                  <input name="checkIn" value="<?php echo $checkIn ?>" type="text" value="" class="form-control calendar autodate" placeholder="Check-in" id="dph1" autocomplete="off" onclick="this.select();" required>
               </div>
            </div>
            <div class="col-sm-2">
               <div class="input-group">
                  <label for="dph2" class="input-group-addon"><i class="mdi mdi-calendar"></i></label>
                  <input name="checkOut" value="<?php echo $checkOut ?>" type="text" value="" class="form-control calendar" placeholder="Check-out"  id="dph2" autocomplete="off" onclick="this.select();" required>
               </div>
            </div>
            <div class="col-sm-3 pax_drop">
               <div class="input-group">
                  <label class="input-group-addon travellers-icon"><i class="mdi mdi-account"></i></label>
                  <span class="form-control c-round c-theme travellers-input text-truncate" id="travellers-hotel">
                     <span class="adultsF travellers-input"><?php echo $adults_count ?></span> adult,
                     <span class="childsF travellers-input"><?php echo $childs_count ?></span> child,
                     <span class="room_countF travellers-input"><?php echo $rooms ?></span> Room
                  </span>
               </div>
               <div class="travellers-input-popup" id="travellers-hotel-popup">
                  <i class="mdi mdi-close-circle fa fa-times"></i>
                  <div class="trip-options">
                     <p>Room - <span>1</span></p>
                     <div class="numstepper small-btns">
                        <button type="button" class="quantity-btn quantity-left-minus btn-number-rooms"  data-type="minus" data-field="room_count"></button>
                        <input type="text" name="room_count" class="quantity-input input-number multi" value="<?php echo $rooms;?>" min="1" max="4">
                        <button type="button" class="quantity-btn quantity-right-plus btn-number-rooms" data-type="plus" data-field="room_count"></button>
                     </div>
                     <div class="clone-room">
                        <p class="rooms" style="display: none;">Room - <span>2</span></p>
                        <div class="numstepper small-btns">
                           <p>Adults</p>
                           <button type="button" class="quantity-btn quantity-left-minus btn-number-arr" data-type="minus" data-field="adults"></button>
                           <input type="text" name="adults[]" class="quantity-input input-number adults" value="<?php echo $adults[0] ?>" min="1" max="3">
                           <button type="button" class="quantity-btn quantity-right-plus btn-number-arr" data-type="plus" data-field="adults"></button>
                        </div>
                        <div class="clone-item roomage">
                           <input type="hidden" class="roomsno" value="1">
                           <p style="display: none;">Child Age - <span>1</span></p>
                           <div class="numstepper small-btns">
                              <p>Children</p>
                              <button type="button" class="quantity-btn quantity-left-minus btn-number-multi roomAge" data-type="minus" data-field="childs"></button>
                              <input type="text" name="childs[]" class="quantity-input input-number multi childs" value="<?php echo $childs[0] ?>" min="0" max="3">
                              <button type="button" class="quantity-btn quantity-right-plus btn-number-multi roomAge" data-type="plus" data-field="childs"></button>
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
                                 <button type="button" class="quantity-btn quantity-left-minus btn-number-arr2" data-type="minus" data-field="input-array"></button>
                                 <input type="text" name="childs_ages_room1[]" class="quantity-input input-number input-array" value="<?php echo $chAge[$ch] ?>" min="2" max="18" data-field="input-array">
                                 <button type="button" class="quantity-btn quantity-right-plus btn-number-arr2" data-type="plus" data-field="input-array"></button>
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
                            <button type="button" class="quantity-btn quantity-left-minus btn-number-arr" data-type="minus" data-field="adults"></button>
                            <input type="text" name="adults[]" class="quantity-input input-number adults" value="<?php echo $adults[$r] ?>" min="1" max="3">
                            <button type="button" class="quantity-btn quantity-right-plus btn-number-arr" data-type="plus" data-field="adults"></button>
                          </div> 
                          <div class="clone-item roomage">
                            <input type="hidden" class="roomsno" value="<?php echo $r+1 ?>">
                            <p style="display: none;">Child Age - <span>1</span></p>
                            <div class="numstepper small-btns">
                              <p>Children</p>
                              <button type="button" class="quantity-btn quantity-left-minus btn-number-multi roomAge" data-type="minus" data-field="childs"></button>
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
                                <button type="button" class="quantity-btn quantity-left-minus btn-number-arr2" data-type="minus" data-field="input-array"></button>
                                <input type="text" name="childs_ages_room<?php echo $r+1 ?>[]" class="quantity-input input-number input-array" value="<?php echo $chAge2[$ch2] ?>" min="2" max="18" data-field="input-array">
                                <button type="button" class="quantity-btn quantity-right-plus btn-number-arr2" data-type="plus" data-field="input-array"></button>
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
            <div class="col-md-2">
               <button type="submit" class="btn btn-secondary btn-block no-radius font-weight-bold">SEARCH</button>
            </div>
            <div class="clearfix"></div>
         </div>
      </form>
  <!--  </div>
</div> -->