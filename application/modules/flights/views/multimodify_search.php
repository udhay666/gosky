<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<div class="tab-pane fade show active" id="flights" role="tabpanel" aria-labelledby="flights-tab">
   <div class="modify-search pt-4" style="display: none;">
      <span class="mod-search-close" id="mod-search-close"><i class="mdi mdi-close-circle"></i></span>
      <div class="border-dashed clearfix"></div>
      <div class="row" id="flight_dom">
         <div class="col-sm-12">
            <!-- <h2 class="text-left mb-4">Find Your Destination</h2> -->
            <form id="M-Trip" method="POST" action="<?php echo site_url(); ?>flights/multi_results">
                     <input type="hidden" name="tripType" value="M">
                     <div class="clone-section">
                     <?php for($i=0;$i< count($fromCity);$i++) { ?>
                     <?php if($i==0){ ?><div class="clone-item"> <?php } ?>
                        <div class="row no-gutters">
                           <div class="col-sm-4">
                              <label>From</label>
                              <div class="input-group">
                                 <div class="input-group-addon"><i class="mdi mdi-map-marker-multiple"></i></div>
                                 <input type="text" class="form-control" placeholder="City, region" name="fromCity[]" value="<?php echo $fromCity[$i];?>">
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <label>To</label>
                              <div class="input-group">
                                 <div class="input-group-addon"><i class="mdi mdi-map-marker-multiple"></i></div>
                                 <input type="text" class="form-control" placeholder="City, region" name="toCity[]" value="<?php echo $toCity[$i];?>">
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <label>Depart on</label>
                              <div class="input-group">
                                 <div class="input-group-addon"><i class="mdi mdi-calendar"></i></div>
                                 <input name="departDate[]" data-date-format="dd/mm/yyyy" type="text" class="form-control dp" placeholder="Depart Date" value="<?php echo $departDate[$i];?>" id="datepicker<?php echo $i+1 ?>" />
                              </div>
                           </div>
                        </div>
                     <?php if($i==0){ ?></div> <?php } ?>
                        <?php } ?>
                      
                        <div class="clonediv-m"></div>
                        <div class="row no-gutters">
                           <div class="col-sm-12">
                              <div class="numstepper small-btns multi-count-btn">
                                 <label>Add / Remove</label>
                                 <button type="button" class="quantity-btn quantity-left-minus btn-number-multicity" data-type="minus" data-field="multicity-field">
                                 </button>
                                 <input type="text" name="multicity-field" class="quantity-input input-number-multicity" value="<?php echo count($fromCity); ?>" min="1" max="4" data-field="multicity-field" disabled="">
                                 <button type="button" class="quantity-btn quantity-right-plus btn-number-multicity" data-type="plus" data-field="multicity-field">
                                 </button>
                              </div>
                           </div>
                        </div>
                        <div class="row form-group">
                           <div class="col-sm-3">
                              <label>Adults</label>
                              <div class="input-group">
                                 <div class="input-group-addon"><i class="mdi mdi-human"></i></div>
                                 <select class="form-control select2" name="adults">
                                    <option value="1" selected>1 Adult</option>
                                    <option value="2">2 Adult</option>
                                    <option value="3">3 Adult</option>
                                    <option value="4">4 Adult</option>
                                    <option value="5">5 Adult</option>
                                    <option value="6">6 Adult</option>
                                    <option value="7">7 Adult</option>
                                    <option value="8">8 Adult</option>
                                    <option value="9">9 Adult</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <label>Children <small>(2-11 yrs)</small></label>
                              <div class="input-group">
                                 <div class="input-group-addon"><i class="mdi mdi-human-child"></i></div>
                                 <select class="form-control select2" name="childs">
                                    <option value="0" selected>0 Child</option>
                                    <option value="1">1 Child</option>
                                    <option value="2">2 Child</option>
                                    <option value="3">3 Child</option>
                                    <option value="4">4 Child</option>
                                    <option value="5">5 Child</option>
                                    <option value="6">6 Child</option>
                                    <option value="7">7 Child</option>
                                    <option value="8">8 Child</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <label>Infants <small>(Below 2 yrs)</small></label>
                              <div class="input-group">
                                 <div class="input-group-addon"><i class="mdi mdi-baby"></i></div>
                                 <select class="form-control select2" name="infants">
                                    <option value="0" selected>0 Infant</option>
                                    <option value="1">1 Infant</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <label>Cabin Class</label>
                              <div class="input-group">
                                 <div class="input-group-addon"><i class="mdi mdi-briefcase-check"></i></div>
                                 <select class="form-control select2" name="cabinClass" required>
                                    <option value="">Cabin Class</option>
                                    <option value="Y" selected="">Economy</option>
                                    <option value="C">Business Class</option>
                                    <option value="F">First Class</option>
                                    <option value="S">Premium Economy</option>
                                    <option value="J">Premium Business</option>
                                    <option value="P">Premium First Class</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12 text-right">
                              <div class="border-dashed clearfix"></div>
                              <div class="row">
                                 <div class="col-md-8 text-right">
                                    <h4 class="mb-0 text-secondary" style="font-family: cursive;line-height: 1.8;">Big or Small Flight Mantra is for All!</h4>
                                 </div>
                                 <div class="col-md-4 text-right">
                                    <button type="submit" class="btn btn-secondary font-weight-bold">SEARCH</button>
                                 </div>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </form>
         </div>
      </div>
   </div>
</div>