<?php $this->load->view('home/header'); ?>
<section class="section-padding inner-page">
   <div class="container">
      <?php if(!empty($message)) { ?>
      <div class="row">
         <div class="col-lg-12">
            <div class="alert alert-block alert-warning">
               <a href="#" data-dismiss="alert" class="close">×</a>
               <h5 class="mb-0 text-center text-danger"><?php echo $message; ?></h5>
            </div>
         </div>
      </div>
      <?php } ?>
      <div class="row">
         <div class="col-lg-5 col-md-5 mx-auto">
            <div class="itinerary-container box-shadow">
               <div class="bdTitle2">Login Information</div>
               <div class="white-container">
                  <form class="form-signin" action="<?php echo site_url() ?>corporatesubadmin/corporate_login" method="post" data-parsley-validate>
                     <div class="row form-group">
                        <div class="col-sm-12">
                           <label>Username*</label>
                           <input type="email" class="form-control" name="agent_email" required="">
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-sm-12">
                           <label>Password*</label>
                           <input type="password" class="form-control" name="agent_password" required="">
                           <p class="text-right mb-0"><a href="#" data-toggle="modal" data-target="#modalForgotpasswordAgent"><small><u class="close-first">Forgot Password?</u></small></a></p>
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-sm-12">
                           <button type="submit" class="btn btn-secondary btn-block">SIGN IN</button>
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-sm-12">
                           <span>By proceeding you agree to our <a href="#"><u>Terms of use</u></a> and <a href="#"><u>Privacy Policy</u>.</a></span>
                        </div>
                     </div>
                  </form>
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?php $this->load->view('home/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>