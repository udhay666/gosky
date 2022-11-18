<?php $this->load->view('home/home_template/header'); ?>
<section class="section-padding inner-page">
   <div class="container" style="margin-top:40px;">
      <div class="row">
        <div class="col-lg-12 col-md-12 mx-auto">
          <div class="itinerary-container box-shadow">
              <div class="bg-white jumbotron text-xs-center mb-0">
                <h2 class="display-5">Your Flight Ticket Successfully Cancelled</h2>
                <div class="tab-content" style="margin-top:10px;">
                      <div class="tab-pane active" id="htl_bkngs" style="overflow: auto">                        
                          <fieldset>
                            <div class="control-group warning">
                                  <label class="control-label" for="focusedInput">Request ID :   <?php echo $cancelinfo['ChangeRequestId'] ?></label>
                              </div>
                               <div class="control-group warning">
                                  <label class="control-label" for="focusedInput">Ticket No :   <?php echo $cancelinfo['TicketId'] ?></label>
                              </div>                              
                             <!--  <div class="control-group warning">
                                  <label class="control-label" for="focusedInput">Cancellation: <?php //echo $note; ?></label>
                              </div> -->
                              <div class="form-actions">                                  
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