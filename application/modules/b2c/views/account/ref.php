<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item active"> <a id="login-tab" class="nav-link active text-4" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">User Login</a> </li>
          <!-- <li class="nav-item"> <a id="agent-login-tab" class="nav-link  text-4" data-toggle="tab" href="#agent-login" role="tab" aria-controls="login" aria-selected="true">Agent Login</a> </li> -->
          <li class="nav-item"> <a id="signup-tab" class="nav-link text-4" data-toggle="tab" href="#signup" role="tab" aria-controls="signup" aria-selected="false">User Register </a> </li>
          <li class="nav-item"> <a id="forgot_password-tab" class="nav-link text-4" data-toggle="tab" href="#modalForgotpassword" role="tab" aria-controls="forgot_password" aria-selected="false">Forgot Password </a> </li>
        </ul>
        <div class="tab-content pt-4">
        <!-- User Login -->
          <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
            <form class="form-signin"  name="validate_create_account" role="form" action="<?php echo site_url(); ?>b2c/user_login" data-parsley-validate  method="post">
              <div class="form-group">
                <label>Email / Mobile <span class="text-danger">*</span></label>
                <p style="margin-top:-12px;" id="email_userlogin2"></p>
                <input type="text" class="form-control form-group" name="user_email" data-parsley-trigger="change" id="sign_user_email2" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Password <span class="text-danger">*</span></label>
                <p style="margin-top:-12px;" id="pass_userlogin2"></p>
                <input type="password" class="form-control" name="user_password" autocomplete="off" id="sign_user_password2" required>
              </div>
              <div class="row mb-4">
                <!-- <div class="col-sm text-right"> <a class="justify-content-end" href="#">Forgot Password ?</a> </div> -->
              </div>
              <button class="btn btn-primary btn-block" type="submit">Login</button>
            </form>
          </div>
        
          <!-- Forgot password Agent-->
          <div class="tab-pane fade" id="modalForgotpasswordAgent" tabindex="-1" role="dialog" aria-labelledby="modalForgotpasswordAgent-tab" aria-hidden="true">
            <form class="forgot_password_agent" action="<?php echo site_url(); ?>agent/forgot_password" method="post" method="post">
              <div class="form-group">
                <label>Registered Email / Mobile <span class="text-danger">*</span></label>
                <input type="email" data-parsley-trigger="change" class="form-control form-group" name="email_id" required>
              </div>
              <p class="show-message red"></p>
            <input type="button" id="forgot_password_agent" class="btn btn-secondary btn-block btn-lg" value="RESET PASSWORD">
            </form>
          </div>
           <!-- Agent Forget Password OTP  -->
          <!-- <div class="tab-pane fade" id="modalOTPAgentforgotPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6OTp" aria-hidden="true">
            <form class="form-corporatechangepwd" method="post">
              <div class="form-group">
                <label>Enter OTP<span class="text-danger">*</span></label>
                <input type="text" class="form-control form-group" name="otp_number" required>
                <input type="hidden" id="otp_corporate2" name="otp_corporate" required>
                <p><small>An OTP (valid for next 15 mins.) has been sent to you on your Mobile / Email</small></p>
              </div>
              <p class="show-message red"></p>
            <input type="button" id="validate_otp1" class="btn btn-secondary btn-block btn-lg" value="Submit OTP">
            </form>
          </div> -->
        <!--forgot password user-->
          <div class="tab-pane fade" id="modalForgotpassword" role="tabpanel" aria-labelledby="myModalLabel22" aria-hidden="true">
             <form class="forgot_password" action="<?php echo site_url(); ?>b2c/forgot_password" method="post" >
                  <div class="form-group">
                    <label>Registered Email <span class="text-danger">*</span></label>
                    <input type="text"  class="form-control"  data-parsley-trigger="change"  name="email_id" required />
                  </div>
                  <!-- <button type="submit" id="forgot_password" class="btn btn-primary btn-block">Send OTP</button> -->
                  <input type="button" id="forgot_password" class="btn btn-primary btn-block" value="Send OTP">
                </form>
           <!--    <div>By proceeding you agree to ours <a href="<?php echo site_url() ?>cms/termsandconditions" target="_blank">Terms of use</a> and <a href="<?php echo site_url() ?>cms/privacypolicy" target="_blank">Privacy Policy.</a></div> -->
          </div>
           <div class="tab-pane fade" id="modalOTPUserforgotPassword" role="tabpanel" aria-labelledby="modalOTPUserLogin-tab">
             <form class="form-changepwd" action="<?php echo site_url(); ?>b2c/change_otp_password" method="post" method="post">
                  <div class="form-group">
                    <label>Enter OTP<span class="text-danger">*</span></label>
                    <input type="text"  class="form-control"  data-parsley-trigger="change"  name="otp_number" required />
                    <input type="hidden" id="otp_user2" name="otp_user" required>
                     <p><small>An OTP (valid for next 15 mins) has been sent to you on your Mobile / Email</small></p>
                  </div>
                 <!--  <button type="submit" id="validate_otp" class="btn btn-primary btn-block">Submit OTP</button> -->
                 <input type="button" id="validate_otp" class="btn btn-primary btn-block" value="Submit OTP">
                </form>
          </div>
          <!--Change pass-->
           <div class="tab-pane fade" id="modalChangePassword" tabindex="-1" role="tabpanel" aria-labelledby="myModalLabel3">
             <form class="form-updateped"  name="validate_update_password" role="form" action="<?php echo site_url(); ?>b2c/restore_password" data-parsley-validate  method="post">
                  <div class="form-group">
                    <label>Email/Phone <span class="text-danger">*</span></label>
                    <input type="text" id="otp_user3" class="form-control"  data-parsley-trigger="change"   name="user_email" value="" readonly="" required />
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
                    <input type="button" id="update_password" class="btn btn-secondary btn-block btn-lg" value="UPDATE">
                  </div>
                <!--   <button type="submit" id="validate_otp" class="btn btn-primary btn-block">Submit OTP</button> -->
                </form>
          </div>
          <!-- User Sign Up -->
          <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">
            <form  class="form-signin"  name="validate_create_account" id="signupForm" action="<?php echo site_url(); ?>b2c/user_register" data-parsley-validate  method="post">
              <div class="form-group">
                <label>Email <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="user_email" data-parsley-trigger="change" id="acc_user_email" required>
              </div>
              <div class="form-group">
                <label>Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control form-group" name="user_password" id="acc_user_password" required>
              </div>
              <div class="form-group">
                 <label>Confirm Password <span class="text-danger">*</span></label>
                 <input type="password" class="form-control form-group" name="passconf" id="acc_user_passconf" data-parsley-equalto="#acc_user_password" required>
              </div>
              <div class="form-group">
                <label>First Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-group" name="first_name" id="acc_first_name" required>
              </div>
              <div class="form-group">
               <label>Last Name <span class="text-danger">*</span></label>
               <input type="text" class="form-control form-group" name="last_name" id="acc_last_name" required>
              </div>
              <div class="form-group">
                <label>Mobile Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="mobile_no" id="acc_mobile_no"  required>
              </div> 
              <button class="btn btn-primary btn-block" type="submit">Register</button>
            </form>
            <div>By proceeding you agree to ours <a href="<?php echo site_url() ?>cms/termsandconditions" target="_blank">Terms of use</a> and <a href="<?php echo site_url() ?>cms/privacypolicy" target="_blank">Privacy Policy.</a></div>
          </div>
          <div class="d-flex align-items-center my-4">
            <hr class="flex-grow-1">
            <span class="mx-2">OR</span>
            <hr class="flex-grow-1">
          </div>
          <div class="row">
            <div class="col-12 mb-3">
              <button type="button" class="btn btn-block btn-outline-primary" onclick="facebookLogin()">Login with Facebook</button>
            </div>
            <div class="col-12">
              <?php include(APPPATH.'libraries/googlelogin/login.php'); ?>
              
              <button type="button" class="btn btn-block btn-outline-danger" onclick="googleLogin('<?php echo filter_var($authUrl, FILTER_SANITIZE_URL); ?>','Google Login','450','600');">Login with Google</button>
              </div>
          </div>
        </div>