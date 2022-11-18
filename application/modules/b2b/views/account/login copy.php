<?php $this->load->view('home/home_template/header'); ?>
<style>

.inner-page{
  margin-top: 140px;
}
.lbox{
  
}

</style>





<section class="section-padding inner-page">
   <div class="container lbox">
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
  <div id="content" style="margin-top: 20px;">    
    <div class="container">
      <div id="login-signup-page" class="bg-light shadow-md rounded mx-auto p-4">
        <ul class="nav nav-tabs nav-justified" role="tablist">
          <li class="nav-item"> <a id="login-page-tab" class="nav-link active text-4" data-toggle="tab" href="#loginPage" role="tab" aria-controls="login" aria-selected="true">Login</a> </li>
          <li class="nav-item"> <a id="signup-page-tab" class="nav-link text-4" data-toggle="tab" href="#signupPage" role="tab" aria-controls="signup" aria-selected="false">Forgot Password</a> </li>
        </ul>
        <div class="tab-content pt-4">
          <div class="tab-pane show active" id="loginPage" role="tabpanel" aria-labelledby="login-page-tab">
            <form id="loginForm" class="form-signin" action="<?php echo site_url() ?>b2b/b2b_login" method="post" data-parsley-validate>
              <div class="form-group">
            <label for="loginMobile">Email ID *</label>
                <input type="email" class="form-control" name="agent_email" required="">
              </div>
              <div class="form-group">
                 <label for="loginPassword">Password</label>
                 <input type="password" class="form-control" name="agent_password" required="">
              </div>
              <button class="btn btn-primary btn-block" type="submit">Login</button>
               <div class="row form-group">
                  <div class="col-sm-12">
                     <span>By proceeding you agree to our <a href="#"><u>Terms of use</u></a> and <a href="#"><u>Privacy Policy</u>.</a></span>
                  </div>
               </div>
            </form>
            <div class="modal-footer">
               <div>Don't have an account?</div>
               <div>
                  <a href="<?php echo site_url() ?>b2b/register">SIGN UP</a>
               </div>
            </div>
          </div>
          <div class="tab-pane fade" id="signupPage" role="tabpanel" aria-labelledby="signup-page-tab" aria-hidden="true">
            <form class="forgot_pas" method="post" method="post">
              <div class="form-group">
                <label for="signupEmail">Registered Email Address</label>
                <input type="text" data-parsley-trigger="change" class="form-control form-group" name="email_id" required>
              </div>
              <!-- <button class="btn btn-primary btn-block" type="submit">Reset Password</button> -->
              <input type="button" id="forgot_password_agent" class="btn btn-secondary btn-block btn-lg" value="RESET PASSWORD">
            </form>
          </div>
          <!-- Agent Forget Password OTP  -->
          <div class="tab-pane" id="modalOTPAgentforgotPassword" tabindex="-1" role="tabpanel" aria-labelledby="Labeli" aria-hidden="true">
            <form class="form-b2bchangepwd" method="post">
              <div class="form-group">
                <label>Enter OTP<span class="text-danger">*</span></label>
                <input type="text" class="form-control form-group" name="otp_number" required>
                <input type="hidden" id="otp_user" name="otp_user" required>
                <p><small>An OTP (valid for next 15 mins.) has been sent to you on your Mobile / Email</small></p>
              </div>
              <!-- <p class="show-message red"></p> -->
            <input type="button" id="validate_otp1" class="btn btn-secondary btn-block btn-lg" value="Submit OTP">
            </form>
          </div>
        
          <!--Change pass-->
           <div class="tab-pane" id="modalChangePassword" tabindex="-1" role="tabpanel" aria-labelledby="myModalLabel3">
             <form class="form-updateped1" method="post">
                  <div class="form-group">
                    <label>Email/Phone <span class="text-danger">*</span></label>
                    <input type="text" id="otp_b2b3" class="form-control"  data-parsley-trigger="change" name="user_email" value="" readonly="" required />
                    <input type="hidden" id="otp_user2" name="otp_user" required>
                  </div>
                  <div class="form-group">
                    <label>New Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control form-group" name="password" id="acc_user_new_password" data-parsley-equalto="#acc_user_password" required>
                  </div>
                  <div class="form-group">
                    <label>Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control form-group" name="passconf" id="passconform" required>
                  </div>
                  <p class="show-message red"></p>
                  <div class="form-group">
                    <input type="button" id="update_password1" class="btn btn-secondary btn-block btn-lg" value="UPDATE">
                  </div>
                <!--   <button type="submit" id="validate_otp" class="btn btn-primary btn-block">Submit OTP</button> -->
                </form>
          </div>
          </div>
        </div>
      </div>
    </div>
    
  </div><!-- Content end -->
   </div>
</section>





<?php $this->load->view('home/home_template/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>