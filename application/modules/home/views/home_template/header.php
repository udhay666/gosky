<?php if (!empty($this->session->userdata('user'))) {
    $username = $this->session->userdata('user');
} else {
    //redirect(base_url('Login/index'));
    $this->session->set_flashdata('error', 'Login First');
} ?>
<!DOCTYPE HTML>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">        
        <meta name="viewport" content="width=device-width,user-scalable=no"/>
        <title>Book Cheap Flights, Book Cheap Hotels, Cheap Holiday Packages, Rent Luxury car & Insurance online at tripfreebuy.com</title>
        <meta name="keywords" content="Book Cheap Flights, Book Cheap Hotels, Cheap" />
        <meta name="description" content="Book Cheap flight tickets and you can Book Cheap Hotels in all cities and save money, all this you can do it off through one site tripfreebuy Trip" />  
        <meta name="author" content="tripfreebuy.com">
        <meta name="ROBOTS" content="INDEX,FOLLOW" />        
        <!-- COMMON TAGS -->
        <meta charset="utf-8">
        
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/flight.png" />
        
        <!-- material font icons -->
        <link href="<?php echo base_url(); ?>assets/fonts/material-icons/material-icons.min.css" rel="stylesheet" type="text/css"/>  
        <!-- Font icons -->
        <link href="<?php echo base_url(); ?>assets/fonts/ficons/flaticon.css" rel="stylesheet" type="text/css"/>  
        <!-- custom style -->                        
        <link href="<?php echo base_url(); ?>assets/compiled/ltr_styles.min.css" rel="stylesheet" type="text/css" />   

        <link href="<?php echo base_url(); ?>assets/css/mobile/mobile.css" rel="stylesheet" type="text/css"/>    

        <!--google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700|Material+Icons" rel="stylesheet">
        <!-- font awesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link href="<?php echo base_url(); ?>assets/plugins/jqueryui/jquery-ui.min.css" rel="stylesheet" type="text/css">  
        <link href="<?php echo base_url(); ?>assets/plugins/bs-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"> 
        <link href="<?php echo base_url(); ?>assets/plugins/timepicker/jquery.timepicker.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        
        <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/css/print.css" media="print">
        <script src="<?php echo base_url(); ?>assets/js/libs/jquery-2.2.4.min.js" type="text/javascript" ></script>        
        <script src="<?php echo base_url(); ?>assets/script/app2.js" type="text/javascript" ></script>        
        <!-- Library Styles -->
         
            
            <!-- Google Tag Manager -->
            
            <!-- End Google Tag Manager -->
                <script>
            var myconfig = {
                site_url: 'http://www.tripfreebuycom/',
                mobile: 0,
            };
        </script>
        
    </head>
    
    <style>
              /* header */
        .nav>li>a{
            position:relative;
            display:block;
            padding:10px 7px
        }
        .navbar-top .navbar-nav>li>a:hover{
            color:#f7941d ;
            display:inline-block;
            border-bottom:4px solid #26b16d  ;
            padding-bottom:2px;
        }
        .navbar-top .navbar-nav>li>a{
                padding-top: 15px;
                color: #01579B;
                padding-bottom: 40px;
                text-transform: capitalize;
                font-size: 14px;
                font-weight: 400;
        }
        .vl {
  border-left: 1px solid gray;
  height: 290px;
  position: absolute;
  left: 50%;
  /* margin-left: -3px; */
  top: 0;
}
.logo {
    float: left;
    height: 40px;
}
.space{
    margin-top:10px;
}
 .title {
  margin-bottom: 7px;
  color: #25C2DA;
  font-size: 18px;
}
.list-footer li a {
  color: #9ABCD7;
}
.list-footer {
  list-style: none;
  margin-bottom: 20px;
}
.list-footer li {
  line-height: 1.7;
  font-weight: 300;
  color: #9ABCD7;
}
.tx span{
    color: #9ABCD7;
}
.mob_menu li a{
    color: white;
}
        </style>
<body>
<header class="section-header" style="background-color: white;">
    <section class="header-top visible-xs">
        <div class="container">
            <ul class="list-inline pull-right ">
                <li class="dropdown" id="currency-dropdown"><a href="<?php echo base_url()?>home/ticket_support" class="dropdown-toggle" >Manage Booking</a></i>
                            <li class="dropdown" id="currency-dropdown"><a href="<?php echo base_url()?>b2b" class="dropdown-toggle" > Corporate</a></i>
                                    <li class="dropdown"  ><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">My Account<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li class="text-center"><a href="#"><i class="fas fa-user-alt"></i></a></li>                        
                                        
                                        
                                        <?php if($this->session->has_userdata('user_logged_in')){ ?>
                                            <li class="active"><a href="<?php echo base_url() ?>b2c/my_profile">Profile</a></li>
                                            <li class=""><a href="<?php echo base_url() ?>b2c/my_bookings">My Booking</a></li>
                                            <li class=""><a href="<?php echo site_url() ?>b2c/logout">Logout</a></li>
                                        <?php }else{  ?> 
                                        
                                        
                                        <li><a data-toggle="modal" data-target="#login-signup" href="#" title="Login / Sign up" >Login / Sign up</a></li>
                                        <?php } ?>
                                    </ul>
                                </li>                            
                      
        </div> <!-- container //  -->
    </section> <!--  header-top //  -->

    <section class="header-nav">
        <div class="container">
            <nav class="navbar navbar-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>"><img class="logo" alt="tripfreebuy Logo" src="<?php echo base_url(); ?>assets/images/logo.png" width="150" ></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav nav-pills navbar-nav navbar-left">
                        <!--<li class="active"><a href="">Home</a></li>-->
                                                    <li><a href="#flights" aria-controls="home"  data-toggle="tab">FLIGHTS  | </a></li>
                                                    <li><a href="#hotels"  role="tab"data-toggle="tab">HOTELS </a></li>
                                                   
                        <ul class="dropdown-menu">
                           
                            <li class=""><a rel="nofollow" href="#" title="OFFERS">OFFERS</a></li>
                            
                            <li class=""><a rel="nofollow" href="<?php echo base_url(); ?>b2b" title="AGENT LOGIN">AGENT LOGIN</a></li>
                            </ul>
                    </li>

                        
                    </ul>

                        <ul class="nav navbar-nav pull-right hidden-xs" style="padding-right: 45px;">                                
                           
                                    <li class="dropdown" id="currency-dropdown"><a href="#" class="dropdown-toggle" style="color:black; " data-toggle="dropdown">24X7 Helpline<i class="caret"></i></a>
                                    <ul class="dropdown-menu" style="margin-right: 20px;">
                                        <li class="active"><a href="#/AED" title="tel">Tel: +91-9999360524</a></li><hr>
                                        <li class=""><a href="#/USD" title="care@tripfreebuy.com">Care@tripfreebuy.com</a></li>
                                        </ul>
                                </li>                               
                            
                                <li class="dropdown"  ><a href="javascript:;" class="dropdown-toggle" style="color:black;"  data-toggle="dropdown">My Account<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li class="text-center"><a href="#"><i class="fas fa-user-alt"></i></a></li>                        
                                        
                                        
                                        <?php if($this->session->has_userdata('user_logged_in')){ ?>
                                            <li class="active"><a href="<?php echo base_url() ?>b2c/my_profile">Profile</a></li>
                                            <li class=""><a href="<?php echo base_url() ?>b2c/my_bookings">My Booking</a></li>
                                            <li class=""><a href="<?php echo site_url() ?>b2c/logout">Logout</a></li>
                                        <?php }else{  ?> 
                                        
                                        
                                        <li><a data-toggle="modal" data-target="#login-signup" href="#" title="Login / Sign up" >Login / Sign up</a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <li class="dropdown" id="currency-dropdown"><a href="<?php echo base_url()?>home/ticket_support" class="dropdown-toggle" style="color:black; " >Manage Booking</i></a>
                            <li class="dropdown" id="currency-dropdown"><a href="<?php echo base_url()?>b2b" class="dropdown-toggle" style="color:black; " >TFB For Corporate</i></a>
                    </ul>
                                            
                </div><!-- /.navbar-collapse -->



            </nav><!-- navbar // -->

        </div><!-- container // -->
    </section> <!-- header nav // -->
</header>        <!-- ========================= SECTION HEADER END // ========================= -->
<style>
    .tab-view{
        margin-top: 100px;
        background: #158a5d;
    }
  
    .tab-view .nav-item .nav-link {
        color: white;   
        font-size: 14px;
        font-weight: bold;     
    }
    .nav2{
        display: flex;
        line-height: 1em;
        flex-direction: row;
        gap: 56px;
    }
    .dt-buttons{
        margin-bottom: 15px;
    }
    .nav-item{
        text-align: center;
    }
</style>

<?php if($this->session->has_userdata('agent_logged_in')){
         $this->load->view('home/b2bheader');
         } ?>
      <?php if($this->session->has_userdata('user_logged_in')){
         $this->load->view('home/b2cheader');
         } ?>
         <?php if($this->session->has_userdata('corporate_logged_in')){
         $this->load->view('corporateheader');
         } ?>
         <?php if($this->session->has_userdata('corporate_sub_logged_in')){
         $this->load->view('corporatesubheader');
         }?>
      <?php  
        //  function getAirportCode($city) {
        //  $varcity = explode(',', $city);
         
        //  return $varcity[0];
        //  }
         ?>

<script>

</script>