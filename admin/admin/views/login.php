<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>public/themetemplate/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>public/themetemplate/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>public/themetemplate/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url(); ?>public/themetemplate/vendors/animate.css/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>public/themetemplate/build/css/custom.min.css" rel="stylesheet">
  </head>
  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="<?php echo site_url(); ?>/login/admin_login">
              <h1>Admin Login</h1>
              <div>
                <input type="email" class="form-control uname" name="loginEmailId" id="login_emailid" placeholder="Username" required/>
              </div>
              <div>
                <input type="password" class="form-control pword"  id="pword_id"  name="loginPassword" placeholder="Password" required />
              </div>
              <div>
                <!-- <a href="#"><small>Forgot Your Password?</small></a>
                <label class="checkbox">
                  <input type="checkbox"  value="1" name="remember"> Remember me on this computer
                </label> -->
                <button class="btn btn-success btn-block">Sign In</button>
              </div>
              <?php if($status!=""){ echo $status; }?>
              <div class="clearfix"></div>
              <div class="separator">
                <div class="clearfix"></div>
                <br />
                <div>
                  <!--<h1><i class="fa fa-paw"></i>TravelPd</h1>
                  <p>©2016 All Rights Reserved. TravelPd Privacy and Terms</p>-->
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>