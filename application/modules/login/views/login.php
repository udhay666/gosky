<!DOCTYPE html>
<html>

<head>
    <title>TravelkitB2B</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
   <!--====== Favicon Icon ======-->
     <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/flight.png" />

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <style type="text/css">
        .margin {
            margin-top: 81px;
        }
        .agent{
        background-color: transparent;
        margin-top: 35px;
        border: 2px solid gray;
        margin-left: 700px;
    }
    .pr{
        margin-left: 750px;
    }

    footer{

        padding: 0;

    }

    .fu{

        color: white;

        margin-left: 60px;

        margin-top: 5px;

    }

    header{
        padding: 0;
    }

     @media screen and (max-width: 600px){

        .social{

            margin-left: 160px;

        }

        .fu{

            margin-left: 60px;
            color: white;

        }

    .agent{
        margin-top: 35px;
        background-color: transparent;
        margin-left: 20px;
        border: 2px solid gray; 
        position: relative;        
    }

    .pr{
        margin-left: 20px;
    }   
    }
        @media only screen and (max-width: 768px) {
    .agent{
        margin-top: 35px;
        background-color: transparent;
        margin-left: 20px;
        border: 2px solid gray; 
        position: relative;        
    }

    .pr{
        margin-left: 20px;
    }   
    .fu{

            margin-left: 60px;
            color: white;

    }
    .social{

        margin-left: 100px;

    }
    /*.responsive{
        background-image: url(<?php echo base_url(); ?>assets/images/bgpara.png);
        background-repeat: no-repeat; 
        
        background-size:cover;
        background-size: auto 1500px;
    }*/
    }
    .forgotpwd:hover{
        color: black;
        font-weight: bold;
    }
    </style>
</head>

<body>
    <header class="responsive" style="background-image: url(<?php echo base_url(); ?>assets/images/bgpara.png);background-repeat: no-repeat; 
background-position: center;
  background-attachment: fixed;       
  webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  height: 100%;
  width: 100%; ">
    <!-- height: 751px; background-size:cover;"> -->
        <div class="container">
            <div class="col-lg-5">

                        <div class="action-item mt-10 pr">

                            <img class="flogo" src="<?php echo base_url(); ?>assets/images/logo.png" width="260px">

                        </div> <!-- action item -->

                    </div>
            <div class="col-md-12  ">
                <div class="row ">
                    <div class="ml-5  ">
                    </div>

                    <div class="agent">
                        <div class="row text-center">
                            <div class="col">
                                <form class="" method="post" action="<?php echo site_url('Login/user_login');?>">
                                    <div class="card-body">
                                        <div class=" text-center mt-4">
                                        <div class="col-sm mt-4 text-dark">
                                                            <?php if(!empty($this->session->flashdata('forgotpwd')) ){ echo $this->session->flashdata('forgotpwd'); }else{ ?>
                                                            <?php if(!empty($this->session->flashdata('update_password_login')) ){ echo $this->session->flashdata('update_password_login'); }else{?> 
                                                            <?php if(!empty($this->session->flashdata('error')) ){ ?> 
                                                            <div class="alert alert-success mt-15">
                                                                <?php echo $this->session->flashdata('error'); ?>
                                                            </div><?php } } }?>
                                        <strong style="color: #003366;">AGENT LOGIN</strong>
                                            </div>
                                            <!-- <div><img src="<?php echo base_url(); ?>assets/images/logo.png" style="width:160px; height: 60px;"></div> -->
                                        <div class="row">
                                            <div class="col-sm mb-4 ">
                                                <label class="col-sm text-left" style="color: black;">User Email</label>
                                                <input type="email" name="email" required id="email" class="form-control" <?php echo set_value('email');?>" placeholder="User Email">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm mb-4">
                                                 <label class="col-sm text-left" style="color: black;">Enter Password</label>
                                                <input type="password" name="password" required id="password" class="form-control" value="<?php echo set_value('password');?>" placeholder="Enter Password">
                                            </div>
                                        </div>
                                        <div class="custom-control mb-3">
                                            <label class="form-check-label" for="defaultCheck1">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" required>
                                            <small style="color:#003366;">You have read and agree to our <a href="<?php echo base_url(); ?>Regcms_controller/termsandcondition">Terms of Conditions</a> and <a href="<?php echo base_url(); ?>Regcms_controller/privacypolicy">Privacy Policy?</a></small>
                                            </label>
                                          </div>
                                        <div class="row">
                                        <div class="col-12 mb-3"> 
                                        <a href="<?php echo base_url();?>Login_controller/forgot_password" class="forgotpwd">Forgot Password?</a>
                                        </div>
                                            <div class="col-sm">
                                                <button class="btn btn-block btn-primary mb-3 text-light" type="submit style="background-color: #003366;">LOGIN</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm text-center ">
                                                <label class="text-primary">
                                                    <span style="color: #1F4788; font-weight: bold;">or sign Up with</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm">
                                                <a href="<?php echo base_url('Register_controller'); ?>" class="btn btn-block btn-danger text-light mb-3 text-light" >CREATE NEW ACCOUNT</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm">
                                                <a href="https://visa.travelkitb2b.com" class="btn btn-block btn-success" style="color: yellow; text-decoration: none; text-shadow: 0 0 5px #FF0000;" >TravelKit UAE Visas</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        

        <footer class="footer-area  bg_cover" style="background-color: transparent;">

        <div class="action-2-area bg_cover ">

        <div class="action-overlay">

            <div class="container">

                <div class="row align-items-center">

                    <div class="col-lg-5">

                        <div class="action-item mt-10">

                            <img class="flogo" src="<?php echo base_url(); ?>assets/images/logo.png" width="160px">

                        </div> <!-- action item -->

                    </div>

                    <div class="col-lg-7 social"><div class="fu">Follow Us</div>

                        <div class=" mt-10 ">

                            <div class=" ">

                                <div class="row text-center">

                                    <!-- <h1><img src="assets/images/Facebook.png" width="80px"></h1> -->

                                    <a class="facebook text-center mr-2" target="_blank" href="https://www.facebook.com/profile.php?id=100071105026772" data-toggle="tooltip" title="Facebook" style=" background-color:#405D9D; border-radius: 10px; width: 50px; height: 50px; font-size: 30px;"><i class="fab fa-facebook-f mt-2 text-light"></i></a>



                                    <a class="facebook text-center mr-2" target="_blank" href="https://www.twitter.com/travekitb2b" data-toggle="tooltip" title="Twitter" style=" background-color:#2C99D7; border-radius: 10px; width: 50px; height: 50px; font-size: 30px;"><i class="fab fa-twitter text-light mt-2"></i></a>

                                    <a class="facebook text-center mr-2" target="_blank" href="https://instagram.com/travelkitb2b?utm_medium=copy_link" data-toggle="tooltip" title="Instragram" style=" background-color:#C8046C; border-radius: 10px; width: 50px; height: 50px; font-size: 30px;"><i class="fab fa-instagram text-light mt-2"></i></a>

                                    <a class="facebook text-center mr-2" target="_blank" href="https://www.linkedin.com/in/al-faraj-travels-8b0951218" data-toggle="tooltip" title="Linkedin" style=" background-color:#0e76a8; border-radius: 10px; width: 50px; height: 50px; font-size: 30px;"><i class="fab fa-linkedin-in text-light mt-2"></i></a>

                                </div>

                            </div>

                        </div> <!-- action support -->

                    </div>

                </div> <!-- row -->

            </div> <!-- container -->

        </div>

    </div> 

                <div class="row mt-2">

                    <div class="col-lg-12">

                        <div class="footer-copyright text-center ml-5">

                            <p class="text-light">@<small>2021 travelkit.All rights reserved.</small><small class="text-mute font-italic"> Powered by Travelpd </small></p>

                        </div> <!-- footer copyright -->

                    </div>

                </div> <!-- row -->

                <!-- <div class="shape-1"></div> -->

                <div class="shape-2"></div>

                <div class="shape-3"></div>

            </div> <!-- container -->

        </div>

    </footer> </div>
    </header>
    
</body>

<!-- JS here -->

<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

</html>