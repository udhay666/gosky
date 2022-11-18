<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('home/home_template/header'); 
   // echo "<pre>21";print_r($this->session->all_userdata());
?>
<style>



.itinerary_style{

}

</style>
<section class="section-pagetop">
    <div class="container">

        <h2 class="title-page">Login Or Register</h2>

    </div> <!-- container // -->
</section> 
<!-- ========================= SECTION PAGETOP END // ========================= -->
<!-- ========================= SECTION CONTENT ========================= -->

    <section class="section-agent">
        <div class="container">
            <message>
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
            </message>
            <div class="panel-login-wrap">
                <div class="row no-gutter">
                    <aside class="col-md-4 col-sm-5">
                        <div class="login-register-wrap">
                            <ul class="nav nav-justified">
                                <li class="active"><a href="#signin" data-toggle="tab">Sign in</a></li>
                                <li><a href="<?php echo site_url() ?>b2b/register" >Register</a></li>
                            </ul>
                            <div class="tab-content">
                                <article class="tab-pane fade in active" id="signin">
                                    <p class="line-center-text">
                                        <span><i class="fa fa-sign-in"></i> &nbsp Agent Login</span>
                                    </p>

                                    <br>
                                    <form role="form" id="login-form" action="<?php echo site_url() ?>b2b/b2b_login" method="POST">
                                    <div class="form-group input-icon">
                                        <i class="fa fa-user"></i>
                                        <input type="email" name="agent_email" class="form-control" placeholder="Email ID" minlength="6" required>
                                    </div> <!-- form-group// -->
                                    <div class="form-group input-icon">
                                        <i class="fa fa-lock"></i>
                                        <input type="password" name="agent_password" class="form-control" placeholder="Password" required>
                                    </div> <!-- form-group// -->
                                    <div class="form-group input-icon">
                                        <!--<label class="checkbox"> <input name="remember" checked="checked" type="checkbox"> <ins></ins>Remember me</label>-->
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-warning"> Login  </button>        
                                    </div> <!-- form-group// -->    
                                </form>
                            <div>
                        <div>
                <div>
            <div>        
        <div>

    
    </section> 
<div>
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

<?php $this->load->view('home/home_template/footer');
?>