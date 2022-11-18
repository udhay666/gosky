<div class="tab-pane fade show active" id="flights" role="tabpanel" aria-labelledby="flights-tab" style="position: relative;">
   <div class="modify-search pt-4" style="display: none;">
      <span class="mod-search-close" id="mod-search-close"><i class="mdi mdi-close-circle"></i></span>
      <div class="border-dashed clearfix"></div>
      <div class="row">
         <div class="col-sm-12">
            <!-- <h2 class="text-left mb-4">Find Your Destination</h2> -->
           <!--  <div class="row">
               <div class="col-sm-12">
                  <div class="tripcheckbox">
                     <label class="radio-custom checkbox-custom-sm">
                        <input type="radio" name="tripType" value="S" checked=""><i></i>
                        <span>One Way</span>
                     </label>
                     <label class="radio-custom checkbox-custom-sm">
                        <input type="radio" name="tripType" value="R"><i></i>
                        <span>Round Trip</span>
                     </label>
                  </div>
               </div>
            </div> -->
            <form id="searchFlights" action="<?php echo site_url(); ?>flights/results" method="post">


               <input type="hidden" name="tripType" value="S" id="tripTypeVal">
               <div class="row no-padding">
                  <div class="col-sm-2 col-6">
                     <label class="sr-only">From</label>
                     <div class="input-group">
                        <!-- <div class="input-group-addon"><i class="mdi mdi-map-marker-multiple"></i></div> -->
                        <input type="text" value="<?php echo $fromCity;?>" name="fromCity" id="fromCity" class="form-control text-truncate" placeholder="Origin" autocomplete="off" onclick="this.select();">
                     </div>
                  </div>
                  <div style="position: relative;">
                     <div class="swap-img">
                        <i class="mdi mdi-swap-horizontal"></i>
                     </div>
                  </div>
                  <div class="col-sm-2 col-6">
                     <label class="sr-only">To</label>
                     <div class="input-group">
                        <!-- <div class="input-group-addon"><i class="mdi mdi-map-marker-multiple"></i></div> -->
                        <input type="text" value="<?php echo $toCity;?>" name="toCity" id="toCity" class="form-control pl-4 text-truncate" placeholder="Destination" autocomplete="off" onclick="this.select();">
                     </div>
                  </div>
                  <div class="col-sm-2 col-6">
                     <label class="sr-only">Depart on</label>
                     <div class="input-group">
                        <div class="input-group-addon"><i class="mdi mdi-calendar"></i></div>
                        <input name="departDate" type="text" value="<?php echo $departDate;?>" class="form-control calendar" placeholder="Departure Date" id="dpf1" autocomplete="off" onclick="this.select();" readonly>
                     </div>
                  </div>
                  <div class="col-sm-2 col-6" id="dpf2Cntr">
                     <label class="sr-only">Return on</label>
                     <div class="input-group">
                        <div class="input-group-addon"><i class="mdi mdi-calendar"></i></div>
                        <input name="returnDate" type="text" value="<?php echo $returnDate;?>" class="form-control calendar" placeholder="Return Date" id="dpf2" autocomplete="off" onclick="this.select();">
                     </div>
                  </div>
                  <div class="col-sm-2 pax_drop flight">
                     <div class="input-group">
                        <div class="input-group-addon"><i class="mdi mdi-account"></i></div>
                        <span class="form-control c-round c-theme travellers-input text-truncate" id="travellers-flight">
                           <!-- <span class="adultsF">1</span> adult,
                           <span class="childsF">0</span> child,
                           <span class="infantsF">0</span> infant, -->
                           <span class="travellerF">1</span> Traveller,
                           <span class="flightclassF">Economy</span>
                        </span>
                     </div>
                     <div class="travellers-input-popup" id="flights-travellers">
                        <i class="mdi mdi-close-circle fa fa-times"></i>
                        <div class="cabin-options">
                           <label class="radio-custom checkbox-custom-sm">
                              <input type="radio" name="flightclass" value="1" <?php if($cabinClass == '1') echo 'checked';?>><i></i>
                              <span>Any</span>
                           </label>
                            <label class="radio-custom checkbox-custom-sm">
                              <input type="radio" name="flightclass" value="2" <?php if($cabinClass == '2') echo 'checked';?>><i></i>
                              <span>Economy</span>
                           </label>
                           <label class="radio-custom checkbox-custom-sm">
                              <input type="radio" name="flightclass" value="3" <?php if($cabinClass == '3') echo 'checked';?>><i></i>
                              <span>Premium Economy</span>
                           </label>
                           <label class="radio-custom checkbox-custom-sm">
                              <input type="radio" name="flightclass" value="4" <?php if($cabinClass == '4') echo 'checked';?>><i></i>
                              <span>Business</span>
                           </label>
                           <label class="radio-custom checkbox-custom-sm">
                              <input type="radio" name="flightclass" value="5" <?php if($cabinClass == '5') echo 'checked';?>><i></i>
                              <span>PremiumBusiness</span>
                           </label>
                           <label class="radio-custom checkbox-custom-sm">
                              <input type="radio" name="flightclass" value="6" <?php if($cabinClass == '6') echo 'checked';?>><i></i>
                              <span>First</span>
                           </label>
                        </div>
                        <hr>
                        <div class="trip-options d-flex justify-content-between">
                           <div class="numstepper small-btns">
                              <p>Adults</p>
                              <button type="button" class="quantity-btn quantity-left-minus btn-number" data-type="minus" data-field="adults">
                              </button>
                              <input type="text" name="adults" class="quantity-input input-number" value="<?php echo $adults;?>" min="1" max="9" data-field="adults">
                              <button type="button" class="quantity-btn quantity-right-plus btn-number" data-type="plus" data-field="adults">
                              </button>
                           </div>
                           <div class="numstepper small-btns">
                              <p>Children</p>
                              <button type="button" class="quantity-btn quantity-left-minus btn-number" data-type="minus" data-field="childs">
                              </button>
                              <input type="text" name="childs" class="quantity-input input-number" value="<?php echo $childs; ?>" min="0" max="9" data-field="childs">
                              <button type="button" class="quantity-btn quantity-right-plus btn-number" data-type="plus" data-field="childs">
                              </button>
                           </div>
                           <div class="numstepper small-btns">
                              <p>Infants</p>
                              <button type="button" class="quantity-btn quantity-left-minus btn-number" data-type="minus" data-field="infants">
                              </button>
                              <input type="text" name="infants" class="quantity-input input-number" value="<?= $infants  ?>" min="0" max="2" data-field="infants">
                              <button type="button" class="quantity-btn quantity-right-plus btn-number" data-type="plus" data-field="infants">
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-2 col-12 text-right">
                     <!-- <label class="invisible clearfix" style="width: 100%;">SEARCH</label> -->
                     <button type="submit" class="btn btn-secondary btn-block no-radius font-weight-bold">SEARCH</button>
                  </div>
               </div>

            </form>
         </div>
      </div>
   </div>
</div>