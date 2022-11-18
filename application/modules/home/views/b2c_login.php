<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('home_template/header'); 
   // echo "<pre>21";print_r($this->session->all_userdata());
?>
<section class="section-pagetop">
    <div class="container">

        <h2 class="title-page">Login Or Register</h2>

    </div> <!-- container // -->
</section> 
<!-- ========================= SECTION PAGETOP END // ========================= -->
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-login">
    <div class="container">
        <message>
                    </message>
        <div class="panel-login-wrap">
            <div class="row no-gutter">
                <aside class="col-sm-5 col-md-4">
                    <div class="login-register-wrap">
                        <ul class="nav nav-justified">
                            <li class="active"><a href="#signin" data-toggle="tab">Sign in</a></li>
                            <li><a href="#register" data-toggle="tab">Register</a></li>
                        </ul>
                        <div class="tab-content">
                            <article class="tab-pane fade in active" id="signin">
                                <div class="flip-wrap" style="height:300px;">
                                    <form id="forgot-password" name="forgot_password" role="form" class="flip-item flip-back flip-turn">
    <p class="alert-fadeout"></p>
    <br> <br>
    <p class="b text-center"> Enter the email address associated with your account, and we'll email you a link to reset your password. </p>
    <div class="form-group input-icon">
        <i class="fa fa-user"></i>
        <input type="email" name="email" class="form-control" placeholder="Email ID" required>
    </div> <!-- form-group// -->
    <div class="form-group">
        <button type="submit" id="send-forget-req" class="btn btn-block btn-warning"> Send Reset Link  </button>
    </div> <!-- form-group// -->
    <p class="text-center"><a href="javascript:;" class="btn-flip">Did you remember your password?</a></p>
	<p class="text-center text-muted">Don't have an account?  <a href="#register" class="target-tab">Register Now</a></p>
</form>

<script type="text/javascript">
    $(document).ready(function () {
        $('#forgot-password').validator({
            disable: false,
            focus: false,
        }).on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
                return false;
            } else {
                // everything looks good!
                forget_password(this);
                return false;
            }
        });

        function forget_password(that) {
            $('#send-forget-req').prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: 'https://asfartrip.com/en/forgot-password',
                data: $('form[name="forgot_password"]').serializeArray(),
                dataType: 'json',
                success: function (data) {
                    if (!$.isEmptyObject(data.msg)) {
                        var msgDiv = $(that).find('.alert-fadeout');
                        msgDiv.text(data.msg).show();
                        if (data.status === true) {
                            msgDiv.addClass('alert alert-success').delay(1500).slideUp({duration: 2000});
                        } else {
                            msgDiv.addClass('alert alert-danger').delay(1500).slideUp({duration: 2000});
                        }
                    }
                },
                complete: function () {
                    $('#send-forget-req').prop('disabled', false);
                }
            });
        }

    });
</script>                                    <form class="flip-item flip-front" role="form" id="login-form" action="https://asfartrip.com/en/login/authenticate" method="POST">
    <p class="login-via">
        <strong>Login Via</strong>
        <br>
        <a href="https://asfartrip.com/twitter" class="btn btn-twitter"> <i class="fa fa-twitter"></i>  <span class="hidden-sm hidden-xs">Twitter</span></a>
        <a href="javascript:;" class="btn btn-facebook"> <i class="fa fa-facebook"></i>  <span class="hidden-sm hidden-xs">Facebook</span></a>
        <a href="javascript:;" id="google-login" class="btn btn-google"> <i class="fa fa-google"></i>  <span class="hidden-sm hidden-xs">Google+</span></a>
        <!--<div class="g-signin2" data-onsuccess="onSignIn"></div>-->
    </p>
    <p class="line-center-text">
        <span>Or</span>
    </p>

    <div class="form-group input-icon">
        <i class="fa fa-user"></i>
        <input type="email" name="email" class="form-control" placeholder="Email ID" minlength="6" required>
    </div> <!-- form-group// -->
    <div class="form-group input-icon">
        <i class="fa fa-lock"></i>
        <input type="password" name="password" class="form-control" placeholder="Password" minlength="6" required>
    </div> <!-- form-group// -->
    <div class="form-group">
        <button type="submit" class="btn btn-block btn-warning"> Login  </button>        
    </div> <!-- form-group// -->
    <p class="text-center"><a href="javascript:;" class="btn-flip">Forgot Password?</a></p>   
	
	<p class="text-center text-muted">Don't have an account?  <a href="#register" class="target-tab">Register Now</a></p>
</form>    
<script type="text/javascript">
    $(document).ready(function () {
        $('#login-form').validator({
            disable: false,
            focus: false,
        }).on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
                return false;
            } else {
                // everything looks good!               
                return true;
            }
        });
    });
</script>                      
                                
								
								</div>
                                <hr>
                                
                            </article> <!-- tab-pane.// -->
                            <article class="tab-pane fade" id="register">                                
                                <p class="login-via">
    <strong>Register via</strong>
    <br>
    <a href="https://asfartrip.com/twitter" class="btn btn-twitter"> <i class="fa fa-twitter"></i> <span class="hidden-sm hidden-xs">Twitter</span></a>
    <a href="javascript:;" class="btn btn-facebook"> <i class="fa fa-facebook"></i>  <span class="hidden-sm hidden-xs">Facebook</span></a>
    <a href="javascript:;" id="google-register" class="btn btn-google"> <i class="fa fa-google"></i>  <span class="hidden-sm hidden-xs">Google+</span></a>
</p>
<p class="line-center-text">
    <span>or fill the form</span>
</p>
<form id="signup-form" role="form" action="https://asfartrip.com/en/users/register/register_b2c" method="POST">
    <div class="form-group input-icon">
        <i class="fa fa-user"></i>
        <input type="text" pattern="[a-zA-Z\s]+" minlength="2" maxlength="30" name="fname" class="form-control" placeholder="First Name" required>
    </div> <!-- form-group// -->
    <div class="form-group input-icon">
        <i class="fa fa-user"></i>
        <input type="text" pattern="[a-zA-Z\s]+" minlength="2" maxlength="30" name="lname" class="form-control" placeholder="Last Name" required>
    </div> <!-- form-group// -->
    <div class="form-group input-icon">
        <i class="fa fa-envelope"></i>
        <input type="email" name="email" class="form-control" placeholder="Email ID" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
    </div> <!-- form-group// -->
    <div class="form-group input-icon" data-toggle="tooltip" title="Min 8 Characters required">
        <i class="fa fa-lock"></i>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" minlength="8" required>
    </div> <!-- form-group// -->
    <div class="form-group input-icon">
        <i class="fa fa-lock"></i>
        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password" data-match="#password" required>
    </div> <!-- form-group// -->
    <!-- <div class="form-group  input-icon">
        <label class="checkbox"> <input type="checkbox" name="newsletter" checked="checked"> <ins></ins>Send me deals and offers</label>
    </div>  -->
    <!-- form-group// -->

	<!-- <div class="form-group  input-icon">
        <div class="g-recaptcha" data-sitekey=""></div> -->
    <!-- </div>  -->
    <!-- form-group// -->

    <div class="form-group">
        <button type="submit" class="btn btn-block btn-warning"> Register  </button>
    </div> <!-- form-group// -->    
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('#signup-form').validator({
            disable: false,
            focus: false,
        }).on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
                return false;
            } else {
                // everything looks good!               
                return true;
            }
        });
    });
</script>                                <hr>
                                <p class="text-center text-muted">Already an travelfreebuy.com member?  <a href="#signin" class="target-tab">Sign in</a></p>
                            </article> <!-- tab-pane.// -->
                        </div> <!-- tab-content.// -->
                    </div> <!-- login-register-wrap.// -->
                </aside>
                <aside class="col-sm-7 col-md-8 hidden-xs">
                    <article class="login-info-panel">
                        <h3 class="title">Why have account?</h3>
                        <p class="lead">
                            1. Fast booking by auto-filling traveller details <br>
                            2. Cancel your trip online anytime with a click of a button without having to wait in line <br>
                            3. View your booking(Flight and Hotel) for (upcoming and completed) or to see the latest updates from our travel experts <br>
                            4. Earn points for every booking <br>
                            5. Redeem your earned points <br>
                        </p>
                        <hr>
						<!--
                        <div class="info-wrap">
                            <img src="https://asfartrip.com/public/assets/images//misc/agency.png" class="pull-left m15">
                            <p class="p15">
                                <strong>Are you an agency?</strong> <br>
                                Register as a B2B customer <br>and get more cheaper options                                <br>
                                <a href="https://asfartrip.com/agent/login#register"> <i class="fa fa-user"></i> Register as B2B</a> &nbsp; | &nbsp; 
                                <a href="https://asfartrip.com/agent/login"> <i class="fa fa-lock"></i> Login as B2B</a>
                            </p>
                        </div>
						-->
                    </article>
                </aside>
            </div><!--  row.// -->
        </div> <!-- panel-login-wrap.// -->


    </div> <!-- container // -->

    <br><br><br>
</section>
<!-- ========================= SECTION CONTENT END // ========================= -->
<script src="https://apis.google.com/js/api:client.js"></script>
<script src="https://asfartrip.com/public/assets/js/libs/social-login.js"></script>
<script type="text/javascript">
/// some script

// jquery ready start
    $(document).ready(function () {
        // jQuery code
        $('.btn-flip').on('click', function (e) {
            $('.flip-wrap').toggleClass('flipped');
        });

    });
// jquery end
</script>

<?php $this->load->view('home_template/footer');
?>