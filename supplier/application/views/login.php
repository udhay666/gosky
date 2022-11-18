<!doctype html><!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]--><!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]--><!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]--><!--[if gt IE 8]><!--><html class="no-js" lang=""><!--<![endif]--><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><title>Supplier Login</title><link rel="icon" type="image/ico" href="<?php echo base_url(); ?>public/images/favicon.ico" /><meta name="description" content=""><meta name="viewport" content="width=device-width, initial-scale=1"><!--  Stylesheets --><!-- vendor css files --><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/vendor/bootstrap.min.css"><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/vendor/animate.css"><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/vendor/font-awesome.min.css"><link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/animsition/css/animsition.min.css"><link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/magnific-popup/magnific-popup.css"><!-- project main css files --><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/main.css"><!--/ stylesheets --><!-- Modernizr  --><script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script><!--/ modernizr --></head><body id="yatriv1" class="appWrapper"><!--[if lt IE 8]>        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p> <![endif]--> <!-- Application Content --><div id="wrap" class="animsition">  <div class="page page-core page-login">    <div class="text-center">      <h3 class="text-white">WELCOME<span class="text-dutch"> SUPPLIER</span></h3>    </div>    <div class="container w-360 p-20 bg-white mt-40 text-center br-5">      <h4>Sign In With Your Supplier Account</h4>      <!-- <h2 class="text-light text-greensea">Log In</h2>-->      <form method="post" action="<?php echo site_url(); ?>login/supplier_login" name="form" class="form-validation mt-20" novalidate>        <div class="form-group">          <input type="email" name="loginEmailId" class="form-control underline-input" placeholder="Email">        </div>        <div class="form-group">          <input name="loginPassword" type="password" placeholder="Password" class="form-control underline-input">        </div>        <!-- <div class="form-group text-left">          <label class="checkbox checkbox-custom-alt checkbox-custom-sm inline-block">            <input type="checkbox">            <i></i> Remember me </label>        </div> -->        <?php if(validation_errors() != '' || !empty($status)) {?>        <div class="alert alert-danger">          <button class="close" data-dismiss="alert" type="button">×</button>          <?php echo validation_errors(); ?>          <?php if(!empty($status)) echo $status;?>        </div>        <?php } ?>        <div class="form-group text-center mt-20">          <!-- <a href="index.html" class="btn btn-full btn-dutch b-0 br-5 text-uppercase">Login</a> -->          <button class="btn btn-full btn-dutch b-0 br-5 text-uppercase">Login</button>        </div>      </form>      <!-- <h5><a href="forgotpass.html" >Forgot Password?</a></h5> -->    </div>    <div class="container">      <div class="row">        <div class="col-md-12 text-center">           <!--<hr class="b-1x">-->          <!-- <h6 class="mt-30 text-of-white">Don't have an account ?</h6> -->          <!-- <a href="signup.html" class="text-uppercase text-white">Create an account</a> </div> -->      </div>    </div>  </div></div><!--/ Application Content --> <!--JavaScripts --> <script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script> <script type="text/javascript">window.jQuery || document.write('<script src="<?php echo base_url(); ?>public/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script> <script src="<?php echo base_url(); ?>public/js/vendor/bootstrap/bootstrap.min.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/jRespond/jRespond.min.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/sparkline/jquery.sparkline.min.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/slimscroll/jquery.slimscroll.min.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/animsition/js/jquery.animsition.min.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/screenfull/screenfull.min.js"></script> <!--/ javascripts --> <!--Custom JavaScripts --> <script src="<?php echo base_url(); ?>public/js/main.js"></script> <!--/ custom javascripts --> <!-- Page Specific Scripts  --> <script type="text/javascript">  $(window).load(function(){  });</script> <!--/ Page Specific Scripts --> <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. --> <script type="text/javascript">  (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=  function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;  e=o.createElement(i);r=o.getElementsByTagName(i)[0];  e.src='<?php echo base_url(); ?>public/js/analytics.js';  r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));  ga('create','UA-XXXXX-X','auto');ga('send','pageview');</script></body></html>