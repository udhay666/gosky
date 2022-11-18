<?php $this->load->view('home/home_template/header'); ?>
<section class="section-padding inner-page">
   <div class="container" style="margin-top:40px;">
      <div class="row">
        <div class="col-lg-12 col-md-12 mx-auto">
          <div class="itinerary-container box-shadow">
              <div class="bg-white jumbotron text-xs-center mb-0">
                <h1 class="display-5">Cancellation Confirmation!</h1>
                <div class="tab-content">
                      <div class="tab-pane active" id="htl_bkngs" style="overflow: auto">
                        
                          <fieldset>
                            <div class="control-group warning">
                                  <label class="control-label" for="focusedInput">Booking ID :   <?php echo $booking_detail->uniqueRefNo ?></label>
                              </div>
                               <div class="control-group warning">
                                  <label class="control-label" for="focusedInput">PNR :   <?php echo $booking_detail->AirlinePNR ?></label>
                              </div>
                              <div class="control-group warning">
                                  <label class="control-label" for="focusedInput">Booking ID :   <?php echo $booking_detail->BookingReferenceId ?></label>
                              </div>
                              <div class="control-group warning">
                                  <label class="control-label" for="focusedInput">Name: <?php echo $booking_pass->first_name .' '. $booking_pass->last_name; ?></label>
                              </div>
                              <div class="control-group warning">
                                  <label class="control-label" for="focusedInput">Email: <?php echo $booking_pass->email ?></label>
                              </div>
                             <!--  <div class="control-group warning">
                                  <label class="control-label" for="focusedInput">Cancellation: <?php //echo $note; ?></label>
                              </div> -->
                              <div class="form-actions">
                                  <a href="<?php echo  site_url();  ?>flights/flightConfirmcancellation/<?php echo $booking_detail->uniqueRefNo; ?>"> <button type="submit" class="btn btn-primary">Continue Cancellation</button></a>
                                  <a href="<?php echo  base_url();  ?>"> <button type="submit" class="btn btn-primary">Home page</button></a>
                              </div>
                          </fieldset>
                      </div>
                  </div>
              
              </div>
          </div>
        </div>
      </div>
   </div>
</section>
<?php $this->load->view('home/home_template/footer'); ?>