<?php $this->load->view('home/home_template/header'); ?>
<section class="section-padding inner-page" style="margin-top:35px;">
   <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 mx-auto">
          <div class="itinerary-container box-shadow">
              <div class="bg-white jumbotron text-xs-center mb-0">
                 <h1 class="display-5"> <?php  echo $bread; ?></h1> 
              <hr> 
                <p>
                    <?php  echo $content->content; ?>
                </p>
              </div>
          </div>
        </div>
      </div>
   </div>
</section>
<?php $this->load->view('home/home_template/footer'); ?>
<style type="text/css">
  ul, ol {
    list-style: inside disc;
  }
</style>