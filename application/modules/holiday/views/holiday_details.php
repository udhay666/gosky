<?php $this->load->view('home/header'); ?>
<?php //$this->load->view('home/home_header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/bootstrap.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/fonts/font-awesome-4.4.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/fonts/ss-social/css/ss-social-regular.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/grid.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/layout.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/fontello.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/myicons/css/my-icons.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/animation.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/holiday_js/layerslider/css/layerslider.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/holiday_js/flexslider/flexslider.css" />
<link href="<?php echo base_url(); ?>public/css/holiday_css/jquery.bxslider.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>public/css/holiday_css/jquery-nicelabel.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>public/css/holiday_css/addSlider.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/jquery-ui.css">
<link href="<?php echo base_url(); ?>public/css/holiday_css/datepicker.css" rel="stylesheet" />
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/style.css" /> -->
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/holiday.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/social-button-min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/result.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/megamenu/mega-menu.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/responsive.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/responsive2.css" />
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/share/dist/jquery.floating-social-share.min.css" /> -->
<style type="text/css">
   .section {
   background-color: #ffffff;
   color: #253035;
   padding: 10px 0;
   padding-left: 20px;
   padding-right: 20px;
   }
   .section.padding-off{padding: 0}
   #accommodations h1, #reviews h1 {
   margin-bottom: 10px;
   }
   #overview p, #goodtoknow p, #highlights p,#included p,#terms p {
   /* background: #253035;
   color: #fff; */
   background: #E7E7E7;
   color: #000;
   padding: 20px;
   font-size: 13px;
   /*-moz-border-radius: 4px;
   -webkit-border-radius: 4px;
   border-radius: 4px;*/
   margin-bottom: 0;
   width: 100% !important;
   }
   #overview table, #goodtoknow table, #highlights table,#included table,#terms table{
   /*background: #253035;
   color: #fff;*/
   background: #E7E7E7;
   color: #000;
   font-size: 13px;
   margin-bottom: 0;
   width: 100% !important;
   }
   #overview table td, #goodtoknow table td, #highlights table td,#included table td,#terms table td{
   padding: 8px
   }
   p:empty,ul:empty,ol:empty{display: none;}
   #overview ul,#highlights ul, #included ul, #terms ul, #goodtoknow ul{
   /*background: #253035;
   color: #fff;*/
   background: #E7E7E7;
   color: #000;
   padding: 20px;
   padding-left: 30px;
   /*-moz-border-radius: 4px;
   -webkit-border-radius: 4px;
   border-radius: 4px;*/
   font-size: 13px;
   }
   .itinerary-item {
   -moz-border-radius: 0;
   -webkit-border-radius: 0;
   border-radius: 0;
   }
   .holiday_tabs .nav-tabs {
   padding-left: 22px;
   padding-right: 22px;
   }
   .itinerary-item p{font-size: 13px;line-height: 1.5;margin-bottom: 10px;}
   .itinerary-align-left {
   padding-right: 0;
   }
   .holiday_tabs ul li a span{
   height: inherit;
   display: block;
   position: relative;
   opacity: .5;
   transition: opacity .8s;
   font-family: 'Montserrat', sans-serif;
   font-size: 14px
   }
   .holiday_tabs ul {
   height: 3pc;
   height: 3rem;
   }
   .holiday_tabs ul li {
   list-style: none;
   line-height: 3pc;
   line-height: 3rem;
   display: inline-block;
   top: 1px;
   }
   .holiday_tabs ul li a {
   color: inherit;
   height: inherit;
   display: block;
   padding: 0 20px;
   padding: 0 1.25rem;
   line-height: inherit;
   }
   .holiday_tabs ul li a:hover span{
   color: #a01d26;
   }
   .section2 ul li a span{font-size: 13px;opacity: 1;}
   .holiday_tabs ul li a span:after {
   content: "";
   display: block;
   position: absolute;
   width: 100%;
   height: 2px;
   background-color: #a01d26;
   top: 0;
   -webkit-transform: translateY(0.3125rem);
   transform: translateY(0.3125rem);
   opacity: 0;
   transition: -webkit-transform .8s,opacity .8s;
   transition: transform .8s,opacity .8s;
   }
   .holiday_tabs ul li a:hover span:after,
   .holiday_tabs ul li.active span:after {
   opacity:1;-webkit-transform:translateY(0);transform:translateY(0)
   }
   .hol_details .flex-direction-nav a {
   top: 40%;
   }
   .service-item,.client-review-paragraph,.booking-form {
   /*color: #000;*/
   /*background: #e7e7e7;*/
   }
   .client-review-paragraph p{
   color: #000;
   }
   .top-text span.top-text-duration {
   color: #ffffff;
   }
   .itinerary-item,.service-item {
   background: #E7E7E7;
   color: #000;
   }
   .client-review-paragraph,.review-text {
   background:#E7E7E7;
   color: #000;
   }
</style>
<div id="wrapper" class="holi-details">
     <section class="section-menu">
      <div class="top-mega-menu" style="background-color:#203FB3;margin-top: 0px !important" >
         <div class="container">
            <!-- mega menu -->
            <ul class="travel-mega-menu travel-mega-menu-anim-scale travel-mega-menu-response-to-icons">
               <li>
                  <a class="top-menu-txt" href="#">Where to go</a>
                  <div class="grid-container5 destination blue-link">
                     <form>
                        <fieldset>
                           <div class="row">
                              <div class="col col-md-12">
                                 <div class="row grid-view">
                                    <section class="col col-md-6">
                                       <h3>Domestic Holidays</h3>
                                       <ul>
                                          <li class="current-menu-item"><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'6'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(6);
                                             echo $statedet->state_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'19'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(19);
                                             echo $statedet->state_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'18'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(18);
                                             echo $statedet->state_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'21'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(21);
                                             echo $statedet->state_name;?></a></li>
                                          <!-- <li><a href="#">Golden Triangle</a></li> -->
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'16'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(16);
                                             echo $statedet->state_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'30'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(30);
                                             echo $statedet->state_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'3563'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(3563);
                                             echo $statedet->state_name;?></a></li>
                                          <!-- <li><a href="#">Ladakh</a></li> -->
                                       </ul>
                                    </section>
                                    <section class="col col-md-6" style="background: #eaece9">
                                       <h3>International Holidays</h3>
                                       <ul>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'40'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(40);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'488'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(488);
                                             echo $citydet->city_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'36'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(36);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'25'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(25);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'37'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(37);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'697'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(697);
                                             echo $citydet->city_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'164'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(164);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'26'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(26);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'59'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(59);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'219'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(219);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'58'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(58);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'6'.'COT5674243334'); ?>"><?php   $continentname=$this->Home_Model->getholivisitcontinent(6);
                                             echo $continentname->continent_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'3'.'COT5674243334'); ?>"><?php   $continentname=$this->Home_Model->getholivisitcontinent(3);
                                             echo $continentname->continent_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'4'.'COT5674243334'); ?>"><?php   $continentname=$this->Home_Model->getholivisitcontinent(4);
                                             echo $continentname->continent_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'2'.'COT5674243334'); ?>"><?php   $continentname=$this->Home_Model->getholivisitcontinent(2);
                                             echo $continentname->continent_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'48'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(48);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'49'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(49);
                                             echo $countryname->country_name;?></a></li>
                                       </ul>
                                    </section>
                                 </div>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </li>
               <li>
                  <a class="top-menu-txt" href="#">Weekend Getaways</a>
                  <div class="grid-container5 destination blue-link">
                     <form>
                        <fieldset>
                           <div class="row">
                              <div class="col col-md-12">
                                 <div class="row grid-view">
                                    <section class="col col-md-4">
                                       <h3>From Mumbai</h3>
                                       <ul>
                                          <li><a href="#">Malshet Ghat</a></li>
                                          <li><a href="#">Mahabaleshwar</a></li>
                                          <li><a href="#">Lonawala</a></li>
                                          <li><a href="#">Kajrat</a></li>
                                          <li><a href="#">Matheran</a></li>
                                          <li><a href="#">Dapoli</a></li>
                                          <li><a href="#">Sawantwadi</a></li>
                                          <li><a href="#">Nashik</a></li>
                                          <li><a href="#">Bhandardara-Purushawadi</a></li>
                                          <li><a href="#">Palghar</a></li>
                                          <li><a href="#">Daman</a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'602'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(602);
                                             echo $citydet->city_name;?></a></li>
                                          <li><a href="#">Igatpuri</a></li>
                                          <li><a href="#">Kolad</a></li>
                                       </ul>
                                    </section>
                                    <section class="col col-md-4"  style="background: #eaece9">
                                       <h3>From Delhi</h3>
                                       <ul>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'219'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(219);
                                             echo $citydet->city_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'608'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(608);
                                             echo $citydet->city_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'566'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(566);
                                             echo $citydet->city_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'598'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(598);
                                             echo $citydet->city_name;?></a></li>
                                          <li><a href="#">Corbett</a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'597'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(597);
                                             echo $citydet->city_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'643'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(643);
                                             echo $citydet->city_name;?></a></li>
                                          <!-- <li><a href="#">Mussorie</a></li> -->
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'349'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(349);
                                             echo $citydet->city_name;?></a></li>
                                          <!-- <li><a href="#">Dausa</a></li> -->
                                       </ul>
                                    </section>
                                    <section class="col col-md-4">
                                       <h3>From Pune</h3>
                                       <ul>
                                          <li><a href="#">Lavasa</a></li>
                                          <li><a href="#">Lonawala</a></li>
                                          <li><a href="#">Rajmachi</a></li>
                                          <li><a href="#">Panchgani</a></li>
                                          <li><a href="#">Bhimashkar</a></li>
                                          <li><a href="#">Malshej Ghat</a></li>
                                       </ul>
                                    </section>
                                 </div>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </li>
               <li>
                  <a class="top-menu-txt" href="#">Holiday Types</a>
                  <?php if(!empty($theme)) { ?>
                  <div class="grid-container5 destination blue-link">
                     <form>
                        <fieldset>
                           <div class="row grid-view">
                              <section class="col col-md-4">
                                 <ul>
                                    <?php for($i=0;$i<10 && !empty($theme[$i]);$i++) { ?>
                                    <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('AKBARHOLIDAYSCATEGORY1000034230'.$theme[$i]->theme_id.'EXBYCATE5674243334'); ?>"><?php echo $theme[$i]->theme_name; ?></a></li>
                                    <?php } ?>
                                 </ul>
                              </section>
                              <section class="col col-md-4" style="background: #eaece9">
                                 <ul>
                                    <?php for($i=10;$i<20 && !empty($theme[$i]);$i++) { ?>
                                    <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('AKBARHOLIDAYSCATEGORY1000034230'.$theme[$i]->theme_id.'EXBYCATE5674243334'); ?>"><?php echo $theme[$i]->theme_name; ?></a></li>
                                    <?php } ?>
                                 </ul>
                              </section>
                              <section class="col col-md-4">
                                 <ul>
                                    <?php for($i=20;$i<21 && !empty($theme[$i]);$i++) { ?>
                                    <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('AKBARHOLIDAYSCATEGORY1000034230'.$theme[$i]->theme_id.'EXBYCATE5674243334'); ?>"><?php echo $theme[$i]->theme_name; ?></a></li>
                                    <?php } ?>
                                 </ul>
                              </section>
                           </div>
                        </fieldset>
                     </form>
                  </div>
                  <?php }?>
               </li>
               <li>
                  <a class="top-menu-txt" href="<?php echo site_url() ?>home/deals">Offers</a>
               </li>
               <li>
                  <a class="top-menu-txt" href="<?php echo site_url() ?>home/mice">Mice</a>
               </li>
               <li>
                  <a class="top-menu-txt" href="<?php echo site_url() ?>home/travel_essentials">Travel Essentials</a>
               </li>
               <li>
                  <a class="top-menu-txt" href="<?php echo site_url() ?>home/aboutus">About Us</a>
               </li>
            </ul>
         </div>
         <nav id="mobile-menu-01" class="mobile-menu">
            <!-- <div class="line-logo">
               <i class="fa fa-bars"></i>
               </div> -->
            <!-- <div class="line-logo">
               <a class="logo" href="#"><img src="images/logo.jpg" alt="" /></a><i class="fa fa-bars"></i>
               </div> -->
            <div class="clear"></div>
            <ul class="travel-mega-menu-mobile">
               <li class="line-mini-menu k-opn">
                  <a class="top-menu-txt" href="#">Where to go</a>
                  <div class="grid-container12 destination collapse blue-link">
                     <form>
                        <fieldset>
                           <div class="row">
                              <div class="col col-md-12">
                                 <div class="row">
                                    <section class="col col-md-6">
                                       <h3>Domestic Holidays</h3>
                                       <ul>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'6'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(6);
                                             echo $statedet->state_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'19'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(19);
                                             echo $statedet->state_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'18'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(18);
                                             echo $statedet->state_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'21'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(21);
                                             echo $statedet->state_name;?></a></li>
                                          <!-- <li><a href="#">Golden Triangle</a></li> -->
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'16'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(16);
                                             echo $statedet->state_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'30'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(30);
                                             echo $statedet->state_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'3563'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(3563);
                                             echo $statedet->state_name;?></a></li>
                                          <!-- <li><a href="#">Ladakh</a></li> -->
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'29'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(29);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'6'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(6);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'23'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(23);
                                             echo $statedet->state_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'35'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(35);
                                             echo $statedet->state_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'3'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(3);
                                             echo $statedet->state_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'1'.'ST5674243334'); ?>"><?php $statedet=$this->Home_Model->getholivisitstate(1);
                                             echo $statedet->state_name;?></a></li>
                                          <!-- <li><a href="<?php //echo site_url(); ?>holiday/holidaysearch/<?php //echo base64_encode('1000034230'.'671'.'CT5674243334'); ?>"><?php //$citydet=$this->Home_Model->getholivisitcity(671); echo $citydet->city_name;?></a></li> -->
                                       </ul>
                                    </section>
                                    <section class="col col-md-6" style="background: #eaece9">
                                       <h3>International Holidays</h3>
                                       <ul>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'40'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(40);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'488'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(488);
                                             echo $citydet->city_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'36'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(36);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'25'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(25);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'37'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(37);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'697'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(697);
                                             echo $citydet->city_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'164'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(164);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'26'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(26);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'59'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(59);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'219'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(219);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'58'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(58);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'6'.'COT5674243334'); ?>"><?php   $continentname=$this->Home_Model->getholivisitcontinent(6);
                                             echo $continentname->continent_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'3'.'COT5674243334'); ?>"><?php   $continentname=$this->Home_Model->getholivisitcontinent(3);
                                             echo $continentname->continent_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'4'.'COT5674243334'); ?>"><?php   $continentname=$this->Home_Model->getholivisitcontinent(4);
                                             echo $continentname->continent_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'2'.'COT5674243334'); ?>"><?php   $continentname=$this->Home_Model->getholivisitcontinent(2);
                                             echo $continentname->continent_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'48'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(48);
                                             echo $countryname->country_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'49'.'T5674243334'); ?>"><?php   $countryname=$this->Home_Model->getholivisitcountry(49);
                                             echo $countryname->country_name;?></a></li>
                                       </ul>
                                    </section>
                                 </div>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </li>
               <li class="line-mini-menu k-opn">
                  <a class="top-menu-txt" href="#">Weekend Getaways</a>
                  <div class="grid-container12 destination collapse blue-link">
                     <form>
                        <fieldset>
                           <div class="row">
                              <div class="col col-md-12">
                                 <div class="row">
                                    <section class="col col-md-4">
                                       <h3>From Mumbai</h3>
                                       <ul>
                                          <li><a href="#">Malshet Ghat</a></li>
                                          <li><a href="#">Mahabaleshwar</a></li>
                                          <li><a href="#">Lonawala</a></li>
                                          <li><a href="#">Kajrat</a></li>
                                          <li><a href="#">Matheran</a></li>
                                          <li><a href="#">Dapoli</a></li>
                                          <li><a href="#">Sawantwadi</a></li>
                                          <li><a href="#">Nashik</a></li>
                                          <li><a href="#">Bhandardara-Purushawadi</a></li>
                                          <li><a href="#">Palghar</a></li>
                                          <li><a href="#">Daman</a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'602'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(602);
                                             echo $citydet->city_name;?></a></li>
                                          <li><a href="#">Igatpuri</a></li>
                                          <li><a href="#">Kolad</a></li>
                                       </ul>
                                    </section>
                                    <section class="col col-md-4"  style="background: #eaece9">
                                       <h3>From Delhi</h3>
                                       <ul>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'219'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(219);
                                             echo $citydet->city_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'608'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(608);
                                             echo $citydet->city_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'566'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(566);
                                             echo $citydet->city_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'598'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(598);
                                             echo $citydet->city_name;?></a></li>
                                          <li><a href="#">Corbett</a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'597'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(597);
                                             echo $citydet->city_name;?></a></li>
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'643'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(643);
                                             echo $citydet->city_name;?></a></li>
                                          <!-- <li><a href="#">Mussorie</a></li> -->
                                          <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('1000034230'.'349'.'CT5674243334'); ?>"><?php $citydet=$this->Home_Model->getholivisitcity(349);
                                             echo $citydet->city_name;?></a></li>
                                       </ul>
                                    </section>
                                    <section class="col col-md-4">
                                       <h3>From Pune</h3>
                                       <ul>
                                          <li><a href="#">Lavasa</a></li>
                                          <li><a href="#">Lonawala</a></li>
                                          <li><a href="#">Rajmachi</a></li>
                                          <li><a href="#">Panchgani</a></li>
                                          <li><a href="#">Bhimashkar</a></li>
                                          <li><a href="#">Malshej Ghat</a></li>
                                       </ul>
                                    </section>
                                 </div>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </li>
               <li class="line-mini-menu k-opn">
                  <a class="top-menu-txt" href="#">Holiday Types</a>
                  <?php if(!empty($theme)) { ?>
                  <div class="grid-container7 destination collapse blue-link">
                     <form>
                        <fieldset>
                           <div class="row">
                              <section class="col">
                                 <ul>
                                    <?php for($i=0;$i<10 && !empty($theme[$i]);$i++) { ?>
                                    <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('AKBARHOLIDAYSCATEGORY1000034230'.$theme[$i]->theme_id.'EXBYCATE5674243334'); ?>"><?php echo $theme[$i]->theme_name; ?></a></li>
                                    <?php } ?>
                                 </ul>
                              </section>
                              <section class="col">
                                 <ul>
                                    <?php for($i=10;$i<20 && !empty($theme[$i]);$i++) { ?>
                                    <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('AKBARHOLIDAYSCATEGORY1000034230'.$theme[$i]->theme_id.'EXBYCATE5674243334'); ?>"><?php echo $theme[$i]->theme_name; ?></a></li>
                                    <?php } ?>
                                 </ul>
                              </section>
                              <section class="col">
                                 <ul>
                                    <?php for($i=20;$i<21 && !empty($theme[$i]);$i++) { ?>
                                    <li><a href="<?php echo site_url(); ?>holiday/holidaysearch/<?php echo base64_encode('AKBARHOLIDAYSCATEGORY1000034230'.$theme[$i]->theme_id.'EXBYCATE5674243334'); ?>"><?php echo $theme[$i]->theme_name; ?></a></li>
                                    <?php } ?>
                                 </ul>
                              </section>
                           </div>
                        </fieldset>
                     </form>
                  </div>
                  <?php }?>
               </li>
               <li class="k-opn">
                  <a class="top-menu-txt" href="<?php echo site_url() ?>home/deals">Offers</a>
               </li>
               <li class="k-opn">
                  <a class="top-menu-txt" href="<?php echo site_url() ?>home/mice">Mice</a>
               </li>
               <li class="k-opn">
                  <a class="top-menu-txt" href="<?php echo site_url() ?>home/travel_essentials">Travel Essentials</a>
               </li>
               <li class="k-opn">
                  <a class="top-menu-txt" href="<?php echo site_url() ?>home/aboutus">About Us</a>
               </li>
            </ul>
            <!--/ mega menu -->
         </nav>
      </div>
   </section>
<section class="h-details page" id="home">
   <section class="section padding-off imgbanner" >
      <div class="hol_details" id="layerslider-container3" style="margin-bottom: -5px;margin-top: -6px;" >
         <div class="flexslider opacityRun" id="layerslider3" >
            <div class="flex-wrap-viewport">
               <div class="flex-viewport" style="overflow: hidden; position: relative;">
                  <ul class="slides" style="width: 800%; transition-duration: 0s; transform: translate3d(-4px, 0px, 0px);">
                     <?php
                        $images=$this->Holiday_Model->get_img_holi_details($holidaydetails->holiday_id,1,1);
                        
                        if(!empty($images)){
                        for($im=0;$im<count($images);$im++){
                        $str=base_url().'admin/'.$images[$im]->holiday_images;
                           // echo '<pre/>';print_r($str);exit;
                        if(getimagesize($str) !== false) {  ?>
                     <li class="clone" aria-hidden="true" style="width: 1349px; float: left; display: block;">
                        <img alt="yhyhh" class="ls-bg" src="<?php echo $str; ?>" style="height: 528px;" draggable="false"/>
                     </li>
                     <?php } } } ?>
                     <?php
                        $images=$this->Holiday_Model->get_img_holi_details($holidaydetails->holiday_id,2,3);
                        if(!empty($images)){
                        for($im=0;$im<count($images);$im++){
                        $str=base_url().'admin/'.$images[$im]->holiday_images;
                        if(getimagesize($str) !== false) {  ?>
                     <li style="width: 1349px; float: left; display: block;" class="flex-active-slide">
                        <img alt="" class="ls-bg" src="<?php echo $str; ?>" style="height: 528px;" draggable="false" >
                     </li>
                     <?php } } } ?>
                  </ul>
               </div>
            </div>
         </div>
         <div class="top-text">
            <span class="top-text-name"><?php echo strtoupper($holidaydetails->package_title); ?></span>
            <span class="top-text-duration"><?php echo $result[$i]->duration." Nights / ".($result[$i]->duration+1)." Days";?></span>        
         </div>
      </div>
   </section>
   <section class="mobile-view row2" style="background: #fff;">
      <div id="booking-flibber" style="margin-top: 0px;position: fixed;top: 150px;left: auto;right: 0;max-width: 320px;z-index: 99;" class="col-lg-4 col-md-3 col-sm-3 col-xs-12 container-booking container-booking-sticky package-booking sticktop" data-spy="affix" data-offset-top="400">
         <div class="booking-form">
            <header style="height: 63px;">
               <div class="price" style="margin-top: -10px;">
                  <span><span style="font-size: 11px;color:#FFBF00">Price on Twin sharing from</span><span id="priceheader" style="font-size: 22px;color:#FFBF00"> <i class="fa fa-rupee"></i> <?php echo $holidaydetails->price; ?></span></span>
               </div>
            </header>
            <?php //if($holidaydetails->bookable==1){?>
            <form id="booking-side-form" method="post" action="<?php echo site_url(); ?>holiday/holiday_package_enquiry" data-min="0" data-max="0">
               <input type="hidden"  name="holiday_id" id="holiday_id" value="<?php echo $holidaydetails->holiday_id; ?>">
               <input type="hidden"  name="holiday_name" id="holiday_name" value="<?php echo $holidaydetails->package_title; ?>">
                <input type="hidden"  name="accom_type" id="accom_type" value="Comfort">
               <input type="hidden" name="total_cost" id="total_cost" value="<?php echo $holidaydetails->price; ?>">
               <!-- <input type="hidden" value="<?php echo $holiday_details->total_cost; ?>" name="price"/> -->
               <input type="hidden" value="<?php echo $holiday_details->tax; ?>" name="tax"/>
               <input type="hidden" value="<?php echo date('jS F Y',strtotime($holiday_details->start_date));?> - <?php echo date('jS F Y',strtotime($holiday_details->end_date));?>" name="validity"/>
               <input type="hidden" value="<?php echo date('jS F Y',strtotime($holiday_details->start_date));?> - <?php echo date('jS F Y',strtotime($holiday_details->end_date));?>" name="p_validity"/>
               <input type="hidden" value="<?php echo $visit; ?>" name="p_visit"/>
               <!-- <input type="hidden" value="<?php echo $holiday_details->holiday_id; ?>" name="h_id"/> -->
               <!-- <input type="hidden" value="<?php echo $holiday_details->package_title; ?>" name="p_title"/> -->
               <a href="<?php echo site_url(); ?>holiday/holidaydetails/<?php echo  base64_encode('AKBARHOLIDAYSPACKAGECODE'.$holidaydetails->holiday_id); ?>" style="font-size: 36px;margin-top: 20px;" class="booking-find-link">
                  <h1><?php echo strtoupper($holidaydetails->package_title); ?></h1>
               </a>
               <span style="position: relative;top: -10px">
               <?php echo ($holidaydetails->duration)." Nights / ".($holidaydetails->duration+1)." Days";?>
               </span>
               <div class="row">
                  <!-- <a href="#enquiry" class="button-link" id="jump_touch">ENQUIRE NOW</a> -->
                 <!--  <a style="background-color: #FFBF00;color:#203FB3;margin-left:103px;" class="button-link" onclick="resultEnquiry(this)" data-val='<?php echo $holidaydetails->package_title; ?>' data-code="<?php echo $holidaydetails->holiday_id; ?>">ENQUIRE NOW</a> -->
                  <button type="button" style="background-color: #FFBF00;color:#203FB3;margin-left:103px;"  data-val='<?php echo $holidaydetails->package_title; ?>' data-code="<?php echo $holidaydetails->holiday_id; ?>"  data-toggle="modal" data-target="#myModal">ENQUIRE NOW</a>
               </div>
               <br>
               <!-- <div class="row">
                  <input class="button-link"  style="margin-left:73px;background-color: #FFBF00;color:#203FB3" type="submit" value="PROCEED TO BOOKING" onclick=" return go_to_traveller();"/>
               </div> -->
            </form>
            <?php//} else { ?>  
            <!--  <form id="booking-side-form"  data-min="0" data-max="0">   
               <input type="hidden"  name="holiday_id" id="holiday_id" value="<?php //echo $holidaydetails->holiday_id; ?>">
                <input type="hidden"  name="accom_type" id="accom_type" value="Comfort">
                <input type="hidden" name="total_cost" id="total_cost" value="<?php //echo $holidaydetails->price; ?>">         
               
                <a href="<?php //echo site_url(); ?>holiday/holidaydetails/<?php //echo  base64_encode('AKBARHOLIDAYSPACKAGECODE'.$holidaydetails->holiday_id); ?>" class="booking-find-link"><h1><?php //echo strtoupper($holidaydetails->package_title); ?></h1></a>
                <span style="position: relative;top: -10px">
                    <?php //echo ($holidaydetails->duration)." Nights / ".($holidaydetails->duration+1)." Days";?>
                </span>
                 <div class="row">
                     <a href="#enquiry" class="button-link" id="jump_touch">ENQUIRE NOW</a> 
                  <a  class="button-link" onclick="resultEnquiry(this)" data-val='<?php //echo $holidaydetails->package_title; ?>' data-code="<?php //echo $holidaydetails->holiday_id; ?>">ENQUIRE NOW</a>
                </div>                    
                <br>                 
               </form>  -->
            <?php //}?>
         </div>
      </div>
   </section>
   <div class="modal fade custom-modal"  id="myModal" tabindex="-1" role="dialog"  aria-hidden="true" style="margin-top: 130px;opacity: 1;top:10px">
         <div class="modal-dialog" style="max-width: 430px">
            <div class="modal-content">
               <div class="modal-header" style="background: #203FB3;line-height: 17;padding: 49px 8px;">
                  <h6 class="modal-title" id="myModalLabel" style="color:#FFBF00;font-weight: 200;">
                     Our expert will get in touch with you shortly
                  </h6>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-top: 49px;margin-bottom: -47px;color:#FFBF00;">&times;</button>
               </div>
               <div class="modal-body">
                  <form action="" method="post">
                     <input type="hidden" id="holiday_id1">
                     <div class="row">
                        <div class="col-sm-12 text-center">
                           <span id="resultenquirypackname" style="font-weight: 600;"></span>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" placeholder="Name *" name="name" id="travel_contact_name1" class="form-control form-group">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" placeholder="Email Address *" name="email" id="travel_contact_email1" class="form-control form-group">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" id="travel_contact_number1" placeholder="Mobile Number *" name="contact_number" class="form-control form-group">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" placeholder="Your City (Optional)" name="city" id="travel_contact_city1" class="form-control form-group">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <label class="checkbox-inline checkbox-custom checkbox-custom-sm">
                              <input type="checkbox" name="authorize" value="Yes" id="travel_contact_authorize1" checked required=""><i></i> I authorize Bizzmirth holidays to contact me and have read the Terms and Conditions.
                              <div class="red" id="travel_contact_authorize1_error"></div>
                           </label>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <label class="checkbox-inline checkbox-custom checkbox-custom-sm form-group">
                              <input type="checkbox" name="agree" value="Yes" id="travel_contact_agree1" checked required=""><i></i> I agree to receive updates &amp; offers from Bizzmirth Holidays
                              <div class="red" id="travel_contact_agree1_error"></div>
                           </label>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="submit" class="btn2" value="CALL ME BACK" name="travel-contact-button" style="background-color:#FFBF00;padding: 8px 50px;height: 40px;border: 0;text-transform: uppercase; margin-left: 81px;" id="travel-contact-button1">
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
   </div>
     <div class="modal" id="myModal1" role="dialog">
          <div class="modal-dialog" style="width: 431px;">
            <div class="modal-content" style="padding: 20px;">
              <button type="button" id="modalClose" class="close" data-dismiss="modal">&times;</button>
              <p>Dear <span id="name"></span> ,</p>
              <p id="success"></p>
              <p>Regards,</p>
              <p>Bizzmirth Holidays</p>
              </p>
            </div>
          </div>
        </div>
   
   <section id="holiday-section" class="holiday-section page2" style="background: #f5f5f5;">
      <section class="row2 section2" id="holiday-menu">
         <div class="col-xs-12 padd0">
            <div class="holiday-details holiday_tabs"  data-spy="affix" data-offset-top="520">
               <nav class="submenu">
                  <ul class="nav nav-tabs">
                     <?php if(!empty($holidaydetails->package_desc)) { ?>
                     <li class=""><a id="jump_overview" href="#overview"><span>Overview</span></a></li>
                     <?php } ?>
                     <?php if(!empty($holidaydetails->package_good)) { ?>
                     <li><a id="jump_goodtoknow" href="#goodtoknow"><span>Good to know</span></a></li>
                     <?php } ?>
                     <?php if(!empty($holidaydetails->highlights)) { ?>
                     <li><a id="jump_highlights" href="#highlights"><span>Highlights</span></a></li>
                     <?php } ?>
                     <?php if(!empty($itinerary)) { ?>
                     <li><a id="jump_itineraries" href="#itineraries"><span>Itinerary</span></a></li>
                     <?php } ?>
                     <?php if(!empty($holidaydetails->inclusion) || !empty($holidaydetails->exclusion)) { ?>
                     <li><a id="jump_included" href="#included"><span>Inclusions / Exclusions</span></a></li>
                     <?php } ?>
                     <li><a id="jump_accommodations" href="#accommodations"><span>Accommodation</span></a></li>
                     <?php if(!empty($review_list)){ ?>
                     <li><a id="jump_reviews" href="#reviews"><span>Reviews</span></a></li>
                     <?php } ?>
                     <?php if(!empty($holidaydetails->terms)) { ?>
                     <li><a id="jump_terms" href="#terms"><span>Terms</span></a></li>
                     <?php } ?>
                  </ul>
               </nav>
            </div>
         </div>
      </section>
   </section>
</section>
<?php if(!empty($holidaydetails->package_desc)) { ?>
<section class="page" id="overview">
   <section class="section" id="overview2">
      <div class="col-sm-9 col-xs-12">
         <h1>Overview</h1>
         <p><?php echo $holidaydetails->package_desc; ?></p>
      </div>
   </section>
</section>
<?php } ?>
<?php if(!empty($holidaydetails->package_good)) { ?>
<section class="page" id="goodtoknow">
   <section class="section" id="goodtoknow2">
      <div class="col-sm-9 col-xs-12">
         <h1>Good to know</h1>
         <p><?php echo $holidaydetails->package_good; ?></p>
      </div>
   </section>
</section>
<?php } ?>
<?php if(!empty($holidaydetails->highlights)) { ?>
<section class="page" id="highlights">
   <section class="section" id="highlights2">
      <div class="col-sm-9 col-xs-12">
         <h1>Highlights</h1>
         <p><?php echo $holidaydetails->highlights; ?></p>
      </div>
   </section>
</section>
<?php } ?>
<?php if(!empty($itinerary)) {
    //echo '<pre/>';print_r($itinerary);exit; ?>
<section class="page" id="itineraries">
   <section class="section" id="itineraries2">
      <div class="col-sm-9 col-xs-12">
         <h1>Itinerary</h1>
         <ul id="package-itinerary" class="itinerary itinerary-align-left">
            <?php for($i=0;$i<=($holidaydetails->duration);$i++) {?>
            <li>
               <div class="itinerary-item">
                  <h1>Day <?php echo $itinerary[$i]->day_no; ?> <span style="position: relative;top: -1px;font-size: 30px;font-weight: 400;color: #dcdcdc">:</span> <?php echo $itinerary[$i]->itineraryheader; ?> </h1>
                  <div class="itinerary-text visible">
                     <p><?php echo $itinerary[$i]->itinerary; ?></p>
                     <label>
                         <a href="<?php echo site_url(); ?>holiday/cabdetails/<?php echo $itinerary[$i]->holiday_id; ?>/<?php 
                          echo $itinerary[$i]->itinerary_id; ?>" class="btn btn-success btn-xs" style="float: right;background-color: #203FB3;border-color: #203FB3;margin-right: 1px;color:#FFBF00;" ><?php echo $itinerary[$i]->itinerarycab; ?></a>
                         <a href="<?php echo site_url(); ?>holiday/hoteldetails/<?php 
                          echo $itinerary[$i]->holiday_id; ?>/<?php 
                          echo $itinerary[$i]->itinerary_id; ?>" class="btn btn-success btn-xs" style="float: right;background-color: #203FB3;border-color: #203FB3;margin-right: 1px;color:#FFBF00;" ><?php echo $itinerary[$i]->itineraryhotel; ?></a>
                        
                          </label>

                  </div>
               </div>
            </li>
            <?php } ?>
         </ul>
         <?php  if($holidaydetails->duration >= 3){ ?>
         <div class="col-md-12 text-center">
            <a id="btn-full-itinerary" style="color:#fff;"class="button-link">VIEW FULL ITINERARY</a>
         </div>
         <?php } ?>
      </div>
   </section>
</section>
<?php } ?>
<?php if(!empty($holidaydetails->inclusion) || !empty($holidaydetails->exclusion)) { ?>
<section class="page" id="included">
   <section class="section" id="included2">
      <?php if(!empty($holidaydetails->inclusion)) { ?>
      <div class="col-sm-4 col-xs-12">
         <h1>Inclusions</h1>
         <p><?php echo $holidaydetails->inclusion; ?></p>
      </div>
      <?php } ?>
      <?php if(!empty($holidaydetails->exclusion)) { ?>
      <div class="col-sm-5 col-xs-12">
         <h1>Exclusions</h1>
         <p><?php echo $holidaydetails->exclusion; ?></p>
      </div>
      <?php } ?>
   </section>
</section>
<?php } ?>
<section class="page" id="accommodations">
   <section class="section" id="accommodations22">
      <div class="col-sm-9 col-xs-12">
         <h1>Accommodation</h1>
         <div class="mobile-horizontal-container" id="accommodations">
            <div class="row mobile-horizontal-row">
               <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="max-width: 295px;">
                  <div class="service-item accommodation-selectfull" style="cursor: pointer;">
                     <div class="service-icon">
                        <div id="service-inner">
                           <div class="service-r">
                              <span>3 STAR</span>
                           </div>
                        </div>
                     </div>
                     <h3>COMFORT</h3>
                     <p>
                        <?php if(!empty($holidaydetails->comfort)) 
                           { echo $holidaydetails->comfort; } ?>
                     </p>
                     <div class="card-bottom">
                        <div class="button-toggle">
                           <input type="radio" class="accommodation-select" id="accommodation-card-1" value="Comfort" checked="true" >
                           <label for="accommodation-card-1"></label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="max-width: 295px;">
                  <div class="service-item accommodation-selectfull" style="cursor: pointer;">
                     <div class="service-icon">
                        <div id="service-inner">
                           <div class="service-r">
                              <span>4 STAR</span>
                           </div>
                        </div>
                     </div>
                     <h3>QUALITY</h3>
                     <p>
                        <?php if(!empty($holidaydetails->quality))
                           {  echo $holidaydetails->quality; } ?>
                     </p>
                     <div class="card-bottom">
                        <div class="button-toggle">
                           <input type="radio" class="accommodation-select" id="accommodation-card-2" value="Quality">
                           <label for="accommodation-card-2"></label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="max-width: 295px;">
                  <div class="service-item accommodation-selectfull" style="cursor: pointer;">
                     <div class="service-icon">
                        <div id="service-inner">
                           <div class="service-r">
                              <span>5 STAR</span>
                           </div>
                        </div>
                     </div>
                     <h3>LUXURY</h3>
                     <p> <?php if(!empty($holidaydetails->luxury))
                        { echo $holidaydetails->luxury; } ?>
                     </p>
                     <div class="card-bottom">
                        <div class="button-toggle">
                           <input type="radio" class="accommodation-select" id="accommodation-card-3" value="Luxury">
                           <label for="accommodation-card-3"></label>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</section>
<?php if(!empty($review_list)){ ?>
<section class="page" id="reviews">
   <section class="section" id="reviews22">
      <div class="col-sm-9 col-xs-12">
         <h1>Reviews</h1>
         <div class="row">
            <?php  for($i=0;$i<count($review_list);$i++){?>
            <div class="col-md-6 col-lg-6 review_row">
               <article class="client-review-paragraph default-review" style="min-height: 250px; max-height: 250px">
                  <header>
                     <div class="client-review-paragraph-img">
                        <div class="client-review-paragraph-social glyphicon-envelope"></div>
                     </div>
                     <div>
                        <h2><?php echo $review_list[$i]->user_name;?></h2>
                        <h2><?php echo $review_list[$i]->location;?>, <?php echo date('F Y', strtotime($review_list[$i]->created_at));?></h2>
                        <h1><?php echo $review_list[$i]->review_title;?></h1>
                     </div>
                  </header>
                  <div class="review-text tour-review-text">
                     <p><?php echo $review_list[$i]->review_desc;?></p>
                  </div>
               </article>
            </div>
            <?php }  ?>
         </div>
      </div>
   </section>
</section>
<?php } ?>
<?php if(!empty($holidaydetails->terms)) { ?>
<section class="page" id="terms">
   <section class="section" id="terms22">
      <div class="col-sm-9 col-xs-12">
         <h1>Terms</h1>
         <p><?php echo $holidaydetails->terms; ?></p>
      </div>
   </section>
</section>
<?php } ?>
<?php if(count($review_list) > 2){ ?>
<style type="text/css">
   .review_row{margin-bottom: 10px}
</style>
<?php } ?>
<?php $this->load->view('home/footer'); ?>
<style type="text/css">
   #footerbar{
   background: #fff url(<?php echo base_url(); ?>public/images/footerbar.png) no-repeat bottom center;
   }
   label{
   font-weight: normal;
   }
</style>
<script type="text/javascript">
   $(document).ready(function() {
    var modal = document.getElementById("myModal");
    // var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];
      $('form').on('submit',function (e){
        e.preventDefault();

        $.ajax({
          method : 'post',
          dataType : 'json',
          url : '<?php echo site_url(); ?>holiday/holiday_package_enquiry',
          data : $('form').serialize(),

          success: function(data){
           // console.log(data.message);
            $('#name').html(data.name);
            $('#success').html(data.message);
            $('#myModal').hide();
            $('#myModal1').show();
          }
        });       
      });
      $('#modalClose').on('click', function () {
            $('#myModal1').hide();
            location.reload();
        });
   });
</script>
<script>
   function sendholienquiry(){
       $user_email=$('#user_email').val();
       $user_number = $('#user_number').val();
       $user_name = $('#user_name').val();
       $user_msg = $('#user_msg').val();
       $package_title = $('#package_title').val();
       $price = $('#price').val();
       $holidayId = $('#holidayId').val();
       $regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
       if($user_name=='')
       {
           $('#user_name').attr("placeholder", "Enter Name");
           $( "#user_name" ).focus();
           return false;
       }
       else if($user_email=='')
       {
           $('#user_email').attr("placeholder", "Enter Email Address");
           $( "#user_email" ).focus();
           return false;
       }
       else if(!$regex.test($user_email))
       {
           $('#user_email').val('');
           $('#user_email').attr("placeholder", "Enter valid Email Address");
           $( "#user_email" ).focus();
           return false;
       }
       else  if($user_number=='')
       {
           $('#user_number').attr("placeholder", "Enter Moblie No.");
           $( "#user_number" ).focus();
           return false;
       }
       else  if($user_msg=='')
       {
           $('#user_msg').attr("placeholder", "Enter Message");
           $( "#user_msg" ).focus();
           return false;
       }
       $.post(siteUrl+'holiday/holidayenqiry', { user_email: ""+$user_email, user_number: ""+$user_number, user_msg: ""+$user_msg, user_name: ""+$user_name, package_title: ""+$package_title, price: ""+$price, holiday_id: ""+$holidayId },
           function(data){
               alert(data.results);
               $('#user_email').val('');
               $('#user_number').val('');
               $('#user_name').val('');
               $('#user_msg').val('');
           }, 'json');
   }
</script>
<script>
   $(function () {
       "use strict";
       $('.bxslider').bxSlider({
           auto: true
       });
       $('.accordion').accordion({
           defaultOpen: 'some_id'
       });
       var tabsFn = (function () {
           function init() {
               setHeight();
           }
           function setHeight() {
               var $tabPane = $('.tab-pane'),
               tabsHeight = $('.nav-tabs').height();
               $tabPane.css({
                   height: tabsHeight
               });
           }
           $(init);
       })();
   });
</script>
<script>
   $("#jump_overview,#jump_goodtoknow,#jump_highlights,#jump_itineraries,#jump_included,#jump_accommodations,#jump_reviews,#jump_terms,#jump_touch").bind("click",function(a){
   var _this=$(this);
   var headtotop = ($('.holiday_tabs').position().top);
   // alert(headtotop);
   if(headtotop > 0){
   $("body, html").stop().animate({
   scrollTop: $(_this.attr('href')).offset().top - 122
   }, 1000,"easeInOutExpo");
   } else {
   $("body, html").stop().animate({
   scrollTop: $(_this.attr('href')).offset().top - 150
   }, 2000,"easeInOutExpo");
   }
   a.preventDefault()
   });
   // $("#jump_overview,#jump_highlights,#jump_itineraries,#jump_included,#jump_accommodations,#jump_reviews,#jump_terms").one("click", function( e ) {
   //     var headtotop = ($('.holiday_tabs').position().top);
   //     // alert(headtotop);
   //     e.preventDefault();
   //     if(headtotop > 0){
   //         $("body, html").animate({
   //             scrollTop: $($(this).attr('href')).offset().top - 122
   //         }, 1000);
   //     } else {
   //         $("body, html").animate({
   //             scrollTop: $($(this).attr('href')).offset().top - 160
   //         }, 2000);
   //     }
   //     // return false;
   // });
   $('#btn-full-itinerary').on('click', function() {
   $('.itinerary').toggleClass('itinerary-full');
   var el = $(this);
   // alert(el);
   el.html(el.text() == "VIEW FULL ITINERARY" ? 'SHOW LESS': 'VIEW FULL ITINERARY');
   // if(el.text() == "VIEW FULL ITINERARY"){
   //     $('itinerary-item::before').css('display', 'block');
   // } else{
   //     $('itinerary-item::before').css('display', 'none');
   // }
   });
   $('#circle').on('click', function() {
   $('#get_in').toggleClass('hide');
   });
   $(window).scroll(function () {
   // distance from top of footer to top of document
   footertotop = ($('#contact').position().top);
   // distance user has scrolled from top, adjusted to take in height of sidebar (570 pixels inc. padding)
   scrolltop = $(document).scrollTop()+570;
   // difference between the two
   difference = scrolltop-footertotop;
   // if user has scrolled further than footer,
   // pull sidebar up using a negative margin
   if (scrolltop > footertotop) {
   $('#booking-flibber').css('margin-top',  0-difference);
   }
   else  {
   $('#booking-flibber').css('margin-top', 0);
   }
   });
   $(document).ready(function(){
   var imgheight = jQuery(window).height();
   // $('.hol_details .flexslider .slides img').css('height', imgheight-97);
   // alert(imgheight);
   });
</script>
<!-- PNotify CSS -->
<!-- <link href="<?php echo base_url(); ?>public/pnotify/pnotify.css" rel="stylesheet"> -->
<!-- <link href="<?php echo base_url(); ?>public/pnotify/pnotify.buttons.css" rel="stylesheet"> -->
<!-- <link href="<?php echo base_url(); ?>public/pnotify/pnotify.nonblock.css" rel="stylesheet"> -->
<!-- PNotify  js-->
<!-- <script src="<?php echo base_url(); ?>public/pnotify/pnotify.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>public/pnotify/pnotify.buttons.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>public/pnotify/pnotify.nonblock.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/holiday/holidaydetails_accom_type.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/holidayPackage_list.js"></script>

<style type="text/css">
   #overview ul, #goodtoknow ul, #highlights ul, #included ul, #accommodations ul, #reviews ul, #terms ul {
   list-style-type: inherit;
   /*margin-left: 20px;*/
   }
</style>
<!-- <script src="<?php echo base_url(); ?>public/shareplugin/src/jquery.sharebox.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>public/share/dist/jquery.floating-social-share.js"></script> -->
<script>
   $(".top-text").floatingSocialShare({
       buttons: [
         "facebook", "google-plus", "twitter","envelope","share-alt"
       ],
       title: "<?php echo $holidaydetails->package_title; ?>",
       twitter_counter: true,
       text: "Share With: ",
       url: location.href
   });
   $('.pop-upper').on('mouseover', function(){
     $(this).parent().addClass('is-hover');
   }).on('mouseout', function(){
     $(this).parent().removeClass('is-hover');
   })
   $('.share-alt').removeClass('pop-upper');
   $('.share-alt').removeAttr('href');
   $('.share-alt').on("click", function() {
       return false;
   });
</script>