<?php $this->load->view('home_template/header'); ?>
<section class="section-padding inner-page" style="margin-top: 35px;">
   <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 mx-auto">
          <div class="itinerary-container box-shadow">
              <div class="bg-white jumbotron text-xs-center mb-0">
                <h1 class="display-5">Something went wrong!</h1>
                <p class="lead text-danger"><?php echo $error; ?></p>
                <hr>
                <p>
                  Having trouble? <a href="#"><b>Contact Us</b></a>
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
<?php $this->load->view('home_template/footer'); ?>