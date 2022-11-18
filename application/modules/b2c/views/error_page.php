<?php $this->load->view('home/header'); ?>
<section class="section-padding inner-page">
   <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 mx-auto">
          <div class="itinerary-container box-shadow">
              <div class="bg-white jumbotron text-xs-center mb-0">
                <h1 class="display-3">Thank You!</h1>
                <p class="lead"><?php echo $message; ?></p>
                <hr>
                <p>
                  Having trouble? <a href="#">Contact us</a>
                </p>
                <p class="lead">
                  <a class="btn btn-primary btn-sm" href="<?php echo site_url() ?>" role="button">Continue to homepage</a>
                </p>
              </div>
          </div>
        </div>
      </div>
   </div>
</section>
<?php $this->load->view('home/footer'); ?>