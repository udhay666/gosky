<?php $this->load->view('home/header'); ?>
<?php $holiday_search_data = $this->session->userdata('holiday_search_data');
$months = array(' ','January','February', 'March', 'April','May', 'June',  'July',  'August', 'September', 'October',  'November',  'December'); ?>
<head>
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/holiday_css/inspiration.css">
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/bootstrap.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/bootstrap-responsive.min.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/fonts/font-awesome-4.4.0/css/font-awesome.min.css" />
   <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/fonts/ss-social/css/ss-social-regular.css" />
   <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>public/fonts/ss-social/js/ss-social.js" /> -->
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/grid.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/layout.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/fontello.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/myicons/css/my-icons.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/animation.css" />
   <link href="<?php echo base_url(); ?>public/css/holiday_css/nanoscroller.css" rel="stylesheet" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/js/holiday_js/layerslider/css/layerslider.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/js/holiday_js/flexslider/flexslider.css" />
   <link href="<?php echo base_url(); ?>public/css/holiday_css/jquery.bxslider.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>public/css/holiday_css/jquery-nicelabel.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>public/css/holiday_css/addSlider.css" rel="stylesheet" />
   <!--Owl Carousel-->
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/holiday_css/owl.theme.css">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/holiday_css/owl.carousel.css">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/holiday_css/owl.transitions.css">
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/jquery-ui.css">
   <link href="<?php echo base_url(); ?>public/css/holiday_css/datepicker.css" rel="stylesheet" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/style.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/social-button-min.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/responsive.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/holiday_css/responsive2.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/megamenu/mega-menu.css" />
   <script src="<?php echo base_url(); ?>public/js/holiday_js/jquery.modernizr.js"></script>
   <script type="text/javascript">
      var baseUrl = "<?php echo base_url(); ?>";
      var siteUrl = "<?php echo site_url(); ?>";
   </script>
   <style>
      body{
      text-transform: uppercase !important;
      }
      /*::-webkit-input-placeholder {
      text-transform: uppercase !important;
      }*/
      .buttonSubmit {
      text-transform: uppercase;
      }
      a.content-box figure figcaption h2 {
      font-size: 50px;
      }
      /*Carousel css*/
      .owl-carousel .item {
      margin-right: 0px;
      padding: 8px 4px;
      }
      .topflight-imgcontainert {
      width: 100%;
      height: 190px;
      /*margin-bottom: 8px;*/
      position: relative;
      cursor: pointer;
      background: #010e27;
      }
      .topflight-imgcontainert img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 0.7;
      -moz-opacity: all 300ms ease 0s;
      -webkit-transition: all 300ms ease 0s;
      -moz-transition: all 300ms ease 0s;
      -o-transition: all 300ms ease 0s;
      transition: all 300ms ease 0s;
      }
      .home-carousel .owl-theme .owl-controls {
      margin: 0;
      }
      .home-carousel .owl-buttons {
      display: none;
      }
      .home-carousel .owl-pagination {
      display: none;
      }
      .home-carousel{
      position: absolute;
      top: 60%;
      left: 0;
      z-index: 9;
      width: 100%;
      background: #eaeaea
      }
      .home-carousel figure.effect-marley h2.offer-heading {
      font-size: 10px;
      margin: 0;
      padding: 0;
      top: 0;
      left: 15px;
      -webkit-transition: -webkit-transform 0.35s;
      transition: transform 0.35s;
      -webkit-transform: translate3d(0,20px,0);
      transform: translate3d(0,20px,0);
      }
      .home-carousel figure.effect-marley:hover h2.offer-heading {
      -webkit-transform: translate3d(0,12px,0);
      transform: translate3d(0,12px,0);
      }
      .home-carousel figure.effect-marley h2.offer-heading span {
      font-size: 14px;
      top: 3px;
      }
      .home-carousel figure.effect-marley h2.offer-heading::after {
      height: 2px;
      -webkit-transform: translate3d(0,30px,0);
      transform: translate3d(0,30px,0);
      }
      .home-carousel figure.effect-marley:hover h2.offer-heading::after,
      .home-carousel figure.effect-marley:hover .pack-details {
      -webkit-transform: translate3d(0,10px,0);
      transform: translate3d(0,10px,0);
      }
      .home-carousel figure.effect-marley .pack-details p {
      margin: 0;
      font-size: 10px;
      }
      .home-carousel figure.effect-marley .pack-details {
      bottom: 20px;
      line-height: 1.2;
      padding: 0;
      margin: 0;
      left: 0;
      right: 0;
      text-align: center;
      }
      .home-carousel figure.effect-marley .pack-details h2 {
      margin: 0;
      font-size: 18px;
      }
      .home-carousel figure.effect-marley .pack-details h2 i {
      font-size: 18px;
      }
      /*Style updated css*/
      .tab-search-area {
      top: inherit;
      bottom: 0%;
      }
      .ls-accio .ls-nav-prev, .ls-accio .ls-nav-next {
      top: 47%;
      }
      .ls-accio .ls-bottom-slidebuttons {
      display: none;
      }
      @media screen and (min-width: 992px){
      }
      @media screen and (max-width: 1366px){
      .social-medias-banner {
      bottom: 12px;
      }
      }
      @media screen and (max-width: 1030px){
      .owl-carousel .item {
      padding: 8px 4px;
      }
      .tab-search-area {
      /*top: 30%;*/
      }
      .home-carousel{
      top: 50%;
      }
      .social-medias-banner {
      bottom: 45px;
      }
      }
      @media only screen and (max-width: 992px) and (min-width: 768px){
      .tab-search-area {
      /*top: 35%;*/
      }
      .home-carousel{
      top: 50%;
      }
      .search-area .tab-content .form-group {
      margin-bottom: 0;
      }
      }
      @media only screen and (max-width: 768px){
      .home-carousel,.tab-search-area {
      position: relative;
      top: 0;
      left: 0;
      clear: both;
      margin-top: 10px;
      }
      .owl-carousel .item {
      margin-right: 0px;
      padding: 10px 5px;
      }
      .social-medias-banner.mobile-hide {
      bottom: 140px;
      top: auto;
      }
      .layerslider-container{
      /*height: auto !important;*/
      }
      }
      @media screen and (max-width: 425px){
      .owl-carousel .item {
      padding: 8px 4px;
      }
      }


     
   </style>
</head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/left_filter.css">
<div id="wrapper">
   <section class="section-menu">
      <div class="top-mega-menu" style="background-color:#203FB3;" >
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
              <!--  <li>
                  <a class="top-menu-txt" href="<?php echo site_url() ?>home/deals">Offers</a>
               </li>
               <li>
                  <a class="top-menu-txt" href="<?php echo site_url() ?>home/mice">Mice</a>
               </li>
               <li>
                  <a class="top-menu-txt" href="<?php echo site_url() ?>home/travel_essentials">Travel Essentials</a>
               </li> -->
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
  <section id="search-result">
    <div class="col-sm-12 search-result-container">
      <div class="container-fluid">
        <div id="search-area" class="search-area" style="margin-top: 30px;">
          <div class="tab-content clearfix">
            <!-- Holiday Tab -->
            <div class="tab-pane active" id="holiday" style="text-transform: uppercase !important;">
              <!--Holiday Packages -->
              <input type="hidden" id="refresh" value="no">
              <form action="<?php echo site_url(); ?>holiday/holidaysearch" id="holiday-tab" class="form" method="post" name="reservationform">
                <div class="row">
                  <div class="col-sm-6" >
                    <div class="form-group input-icon">
                      <input type="hidden" value="<?php echo $holiday_search_data['searchheader']; ?>" name="searchheader" id="packagesearchnew">
                       <input type="hidden" value="<?php echo $holiday_search_data['theme_id']; ?>" name="theme_id" id="themesearchnew">
                      <input title="Search for your Holiday Destination" value="" type="text" class="form-control search-field" placeholder="<?php  if(!empty($holiday_search_data['destiName'])){   echo $holiday_search_data['destiName'];} else { echo "Holidays"; } ?>" id="holiCityName" name="holiCityName" autocomplete="off" style="cursor: pointer;" required />
                      <label for="holiCityName" style="display: inherit;"><i class="fa fa fa-map-marker"></i></label>
                      <input type="hidden" class="form-control" name="destiId" id="destiId" value="<?php echo $holiday_search_data['destiId']; ?>"  />
                      <input type="hidden" class="form-control" name="linktype" id="linktype" value="<?php echo $holiday_search_data['linktype']; ?>"  />
                      <input type="hidden" id="sessionId" value="<?php echo $this->session->userdata('session_id');?>" />
                      <input type="hidden" class="form-control" name="alllinktype" id="alllinktype" value="<?php echo $holiday_search_data['alllinktype']; ?>"  />
                    </div>
                    <div class="dropdown-search" data-toggle="dropdown" id="distdropdownsearch" style="z-index: 999;">
                      <div class="arrow-up"></div>
                      <div class="tabs-left" id="distdropdown">
                        <ul class="nav nav-tabs" id="holidaytab">
                          <li class="<?php if($holiday_search_data['linktype']==5){echo 'active';}else if(!isset($holiday_search_data['linktype'])){ echo 'active';}?>"><a href="#all" link-type="All" data-toggle="tab"><i class="fa fa-map-marker gi-lx" title="ALL"></i><i class="fa fa-map-marker gi-5x" title="ALL"></i><i class="fa fa-map-marker gi-rx" title="ALL"></i> All</a></li>
                          <li class="<?php if($holiday_search_data['linktype']==1){ echo 'active';} ?>"><a href="#holiCities"  link-type="Cities" data-toggle="tab"><i class="fa fa-target gi-5x" title="Cities"></i> Cities</a></li>
                          <li class="<?php if($holiday_search_data['linktype']==2){ echo 'active';} ?>"><a href="#holistates" link-type="States" data-toggle="tab"><i class="fa fa-map gi-5x" title="States"></i> States</a></li>
                          <li class="<?php if($holiday_search_data['linktype']==3){ echo 'active';} ?>"><a href="#holicountries" link-type="Countries" data-toggle="tab"><i class="fa fa-flag gi-5x" title="Countries"></i> Countries</a></li>
                          <li class="<?php if($holiday_search_data['linktype']==4){ echo 'active';} ?>"><a href="#holicontinents" link-type="Continents" data-toggle="tab"><i class="fa fa-globe gi-5x" title="Continents"></i> Continents</a></li>
                          <li  class="<?php if($holiday_search_data['linktype']==6){ echo 'active';} ?>"><a href="#holipackages" link-type="Packages" data-toggle="tab"><i class="fa fa-group gi-5x" title="Packages"></i> Packages</a></li>
                          <li class="<?php if($holiday_search_data['linktype']==7){ echo 'active';} ?>"><a href="#holitheme" link-type="Theme" data-toggle="tab"><i class="fa fa-heart gi-5x" title="Theme"></i> Theme</a></li>
                        </ul>
                        <div class="tab-content pre-scrollable" id="holiinfo">
                          <div class="tab-pane active" id="all"></div>
                          <div class="tab-pane active" id="holiCities"></div>
                          <div class="tab-pane active" id="holistates"></div>
                          <div class="tab-pane active" id="holicountries"></div>
                          <div class="tab-pane active" id="holicontinents"></div>
                          <div class="tab-pane active" id="holipackages"></div>
                          <div class="tab-pane active" id="holitheme"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 padding-8">
                    <div class="input-group input-icon">
                      <span class="input-group2">
                        <input type="text" title="Intended Time of Travel"  class="form-control search-field" placeholder="Month of travel (Any)" name="mon_dur" id="mon_dur" autocomplete="off" readonly="readonly" style="background:#FFF;" value="<?php if(!empty($holiday_search_data['holiday_duration'])){echo "in ".$months[$holiday_search_data['holiday_duration']];}  ?>" required />
                        <i class="fa fa-calendar"></i>
                        <input type="hidden" class="form-control" name="holiduration" id="holiduration" value="<?php echo $holiday_search_data['holiday_duration']; ?>"  />
                      </span>
                      <span class="input-group-btn">
                        <input class="btn btn-default" type="submit" id="modifyholisearch" data-original-title="" title="Modify Search" value="MODIFY SEARCH"/>
                      </span>
                    </div>
                    <div class="dropdown-search" data-toggle="dropdown" id="holidistmonthtab" style="max-width:500px;max-height:250px;border-radius: 5px;background: transparent;z-index: 999;" >
                      <div class="arrow-up"></div>
                      <div class="tabs-left" id="distmonthtab" style="z-index: 999;">
                        
                        <?php
                        $curr_month=date("F");
                        $curr_year=date("Y");
                        $year=$curr_year;
                        $index = array_search($curr_month, $months);
                        ?>
                        <table id="datatable1" class="table" style="max-width:500px;height: 225px; max-height:250px;overflow: hidden;border-radius: 5px;background: transparent;">
                          <tr class="monthsdurtr" style="height: 18px;">
                            <!-- <td  colspan="2" class="monthsheaddur" data-monthidex="" data-monthyear="" style="border-top: 0px;">Specific Month</td> -->
                            <td  colspan="4" class="monthsdur <?php if($holiday_search_data['holiday_duration']==0){echo 'active';}?>" data-monthidex="" data-monthyear="" style="padding-bottom: 0px;"><p style="padding-top: 8px;font-weight: bold;font-size: 14px !important;">Any Time</p></td>
                          </tr>
                          <?php for($i=1;$i<=12;$i++)
                          {
                          if($i==1)
                          { ?>
                          <tr class="monthsdurtr">
                            <td class="monthsdur <?php if($holiday_search_data['holiday_duration']==$index){echo 'active';}?>" data-monthidex="<?php echo $index;?>" data-monthyear="<?php echo "in " .$months[$index]; ?>"><?php echo substr($months[$index++],0,3)."<br/>".$year;  ?></td>
                            <?php
                            }
                            if($index>12)
                            {
                            $index=1;
                            $year=$curr_year+1;
                            }
                            if($i!=1)
                            { ?>
                            <td class="monthsdur <?php if($holiday_search_data['holiday_duration']==$index){echo 'active';}?>" data-monthidex="<?php echo $index;?>" data-monthyear="<?php echo "in " .$months[$index]; ?>"><?php echo substr($months[$index++],0,3)."<br/>".$year;  ?></td>
                            <?php }
                            if($i%4==0&&$i!=12) { ?>
                          </tr>
                          <tr class="monthsdurtr">
                            <?php }
                            if($i==12) { ?>
                          </tr>
                          <?php } } ?>
                        </table>
                        <!-- /tab-content -->
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!-- End Holiday Tab -->
          </div>
        </div>
        
        <div class="row flightResultsSection">
          <!-- <div class="col-sm-3 leftBg hidden-xs"></div> -->
          <div class="col-sm-12">
            <div class="header-search-result" style="color:#fff">
              <h4 class="result-label">Holiday Search Results</h4>
              <h5 class="result-count" id='search_count'>Packages</h5>
            </div>
          </div>
          <div class="visible-xs filter-button"><i class="fa fa-filter"></i></div>
          <div class="col-sm-3">
            <div class="filter-section searchFiltersSection">
              <div class="accordion-area">
                <h5>Refine Search Results<a class="btn btn-success btn-xs reset_filter" 
                style="float: right;background-color: #203FB3;border-color: #203FB3;">Reset</a></h5>                
                <h5 class='accordion-heading'>Price Budget <span class="fa fa-angle-right pull-right"></span></h5>
                <div class='accordion-content' style="display:none;">
                  <div class="holiday-search-cntr" style="display:none;">
                    <div class="minmax_opt">
                      <span id="minPrice2"></span>
                      <span id="maxPrice2" class="pull-right"></span>
                    </div>
                    <!-- <span id="priceSliderOutput" style=""></span> -->
                    <br><br>
                    <div style="padding:0px; margin: 0px;">
                      <div id="priceSlider"  style="z-index:0;"></div>
                      <input type="hidden" name="minPrice" id="minPrice" class="autoSubmit"  />
                      <input type="hidden" name="maxPrice" id="maxPrice" class="autoSubmit"  />
                    </div>
                  </div>
                </div>
                <h5 class='accordion-heading'>Accommodation<span class="fa fa-angle-right pull-right"></span></h5>
                <div class='accordion-content' style="display:none;">
                  <div>
                    <div id="text-radio" class="custom-radio category">
                      <?php for($k=0;$k<count($category);$k++) { ?>
                      <input class="text-nicelabel" data-nicelabel='{"position_class": "text_radio", "checked_text": "<?php echo $category[$k];?>","category_val":"<?php echo ($k+1);?>", "unchecked_text": "<?php echo $category[$k];?>"}'  type="checkbox" name="category[]" value="<?php echo ($k+1);?>" />
                      <?php }?>
                      
                    </div>
                  </div>
                </div>
                <h5 class='accordion-heading'>Duration<span class="fa fa-angle-right pull-right"></span></h5>
                <div class='accordion-content' style="display:none;">
                  <div class="holiday-search-cntr" style="display:none;">
                    <div class="minmax_opt">
                      <span id="mindur2"></span>
                      <span id="maxdur2" class="pull-right"></span>
                    </div>
                    <!-- <span id="durSliderOutput" style="font-weight: normal;color: #E90218;"></span> -->
                    <br><br>
                    <div style="padding:0px; margin: 0px;">
                      <div id="durSlider"  style="z-index:0;"></div>
                      <input type="hidden" name="mindur" id="mindur" class="autoSubmit"  />
                      <input type="hidden" name="maxdur" id="maxdur" class="autoSubmit"  />
                    </div>
                  </div>
                </div>
                <h5 class='accordion-heading'>Region<span class="fa fa-angle-right pull-right"></span></h5>
                <div class='accordion-content' style="display:none;">
                  <div>
                    <div id="text-radio" class="custom-radio region">
                      <?php for($i=0;$i<count($continentlist);$i++){?>
                      <input class="text-nicelabel" data-nicelabel='{"position_class": "text_radio", "checked_text": "<?php echo $continentlist[$i]->continent_name; ?>", "reg_val":"<?php echo $continentlist[$i]->continent_id; ?>", "unchecked_text": "<?php echo $continentlist[$i]->continent_name; ?>"}'  type="checkbox" name="region[]"  value="<?php echo $continentlist[$i]->continent_id;?>"/>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <h5 class='accordion-heading'>Experience<span class="fa fa-angle-right pull-right"></span></h5>
                <div class='accordion-content' style="display:none;">
                  <div>
                    <div id="text-radio" class="custom-radio theme">
                      <?php
                      for($i=0;$i<count($holiday_theme_list);$i++){?>
                      <input class="text-nicelabel" data-nicelabel='{"position_class": "text_radio", "checked_text": "<?php echo $holiday_theme_list[$i]->theme_name; ?>","theme_val":"<?php echo $holiday_theme_list[$i]->theme_id; ?>", "unchecked_text": "<?php echo $holiday_theme_list[$i]->theme_name; ?>"}'  type="checkbox" name="theme[]" value="<?php echo $holiday_theme_list[$i]->theme_id;?>" />
                      <?php }?>
                    </div>
                  </div>
                </div>
                <h5 class='accordion-heading'>Best Time to Visit <span class="fa fa-angle-right pull-right"></span></h5>
                <div class='accordion-content' style="display:none;">
                  <div>
                    <div id="text-radio" class="custom-radio month">
                      <?php  for($j=1;$j<count($months);$j++) { ?>
                      <input class="text-nicelabel" data-nicelabel='{"position_class": "text_radio", "checked_text": "<?php echo $months[$j];?>","mon_val":"<?php echo ($j+1);?>", "unchecked_text": "<?php echo $months[$j];?>" }'  type="checkbox" name="month[]"
                      value="<?php echo ($j+1);?>" />
                      <?php   }?>
                      
                    </div>
                  </div>
                </div>
                <h5 class='accordion-heading'>Guest Rating <span class="fa fa-angle-right pull-right"></span></h5>
                
                <div class='accordion-content' style="display:none;">
                  <div class="holiday-search-cntr" style="display:none;">
                    <div class="minmax_opt">
                      <span id="minrating2"></span>
                      <span id="maxrating2" class="pull-right"></span>
                    </div>
                    <!-- <span id="ratingSliderOutput" style="font-weight: normal;color: #E90218;"></span> -->
                    <br> <br>
                    <div style="padding:0px; margin: 0px;">
                      <div id="ratingSlider"  style="z-index:0;"></div>
                      <input type="hidden" name="minrating" id="minrating" class="autoSubmit"  />
                      <input type="hidden" name="maxrating" id="maxrating" class="autoSubmit"  />
                    </div>
                  </div>
                </div>
                <!--      <h5 class='accordion-heading' >Temperature <span class="fa fa-angle-down pull-right"></span></h5>
                
                <div class='accordion-content'>
                  <div class="holiday-search-cntr" style="display:none;">
                    <span id="tempSliderOutput" style="font-weight: normal;color: #E90218;"></span>
                    <br/> <br/>
                    <div style="padding:0px; margin: 0px;">
                      <div id="tempSlider"  style="z-index:0;"></div>
                      <input type="hidden" name="mintemp" id="mintemp" class="autoSubmit"  />
                      <input type="hidden" name="maxtemp" id="maxtemp" class="autoSubmit"  />
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-9">
            <div class="row">
              <div class="col-sm-12">
                <div class="sorting-tab">
                  <div class="row">
                    <div class="col-sm-2 col-xs-12" id="sortbythis">
                      <p style="cursor: default;"><b>Sort By : </b></p>
                    </div>
                    <div class="col-sm-2 col-xs-6 trim-left HolidaySorting" rel="data-pol" data-order="asc">
                      <p>Popularity <i class="fa fa-long-arrow-down pull-right fa-custom" style="display: none;"></i></p>
                    </div>
                    <div class="col-sm-2 col-xs-6 trim-left HolidaySorting" rel="data-price" data-order="asc">
                      <p>Price <i class="fa fa-long-arrow-down pull-right fa-custom" style="display: block;"></i></p>
                    </div>
                    <div class="col-sm-2 col-xs-6 trim-left HolidaySorting" rel="data-duration" data-order="asc">
                      <p>Duration <i class="fa fa-long-arrow-down pull-right fa-custom" style="display: none;"></i></p>
                    </div>
                    <div class="col-sm-2 col-xs-6 trim-left HolidaySorting" rel="data-rating" data-order="asc">
                      <p>Rating <i class="fa fa-long-arrow-down pull-right fa-custom" style="display: none;"></i></p>
                    </div>
                    <div class="col-sm-2 col-xs-6 trim-left last-item HolidaySorting" rel="data-recent" data-order="asc">
                      <p>Recently Added <i class="fa fa-long-arrow-down pull-right fa-custom" style="display: none;"></i></p>
                    </div>
                  </div>
                </div>
              </div>
              
              <?php if(empty($result)){ ?>
              <div class="col-sm-12">
                <div class="search-result2 nano2">
                  <div class="col-sm-12 search-content2 nano-content2">
                    <div id="holidaypackagesearch" style="background-color: white;border-radius: 6px;box-shadow: 0 3px 5px 0 #202020;color: #a01d26;font-size: 20px;font-weight: bold;padding-top:50px;padding-bottom: 50px" align="center">
                      <span class="red">Please Wait...</span><br>
                      <img align="top" alt="loading.. Please wait.." src="<?php echo base_url();?>public/images/ajax-loader-bar.gif" >
                    </div>
                    <div class="row" id="avail_holidays">
                    </div>
                  </div>
                </div>
              </div>
               <?php }else{ ?>
                  <?php foreach($result as $row): ?> 

                  <div class="col-sm-12 h-200">
 <div class="search-result21 nano2">
   <div class="col-sm-12 search-content2 nano-content2">
     <div id="holidaypackagesearch" style="background-color: white;border-radius: 6px;box-shadow: 0 3px 5px 0 #202020;color: #a01d26;font-size: 20px;font-weight: bold;padding-top:50px;padding-bottom: 50px" align="center">
     <img align="center" class="thumb"  alt="img" width="200px" src="<?php echo base_url('admin/'.$row->trending_img); ?>" >  
     <span class="gray" style="color: black;"><?php echo $row->package_title; ?></span>
     <span class="gray" style="margin-top: 10px; color: gray; text-transform:capitalize; font-size:medium;"><?php echo $row->destination.' Bangalore'; ?></span><br>
     <h3 class="price"><?php echo $row->price; ?></h3><br>
     <button class="btn btn-primary bn">Book Now</button>

       
     </div>
     <div class="row" id="avail_holidays">
     </div>
   </div>
 </div>
</div>

<?php endforeach; ?>  
                  <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
     <div class="bottom-footer2 clearfix" id="footerbar"></div>
    <div class="clearfix"></div>
    <input type="hidden" id="setMinPrice" value="<?php echo $min_price;?>"/>
    <input type="hidden" id="setMaxPrice" value="<?php echo $max_price;?>"/>
    <input type="hidden" id="setMindur" value="<?php echo $min_dur;?>"/>
    <input type="hidden" id="setMaxdur" value="<?php echo $max_dur;?>"/>
    <!--      <input type="hidden" id="setMintemp" value="0"/>
    <input type="hidden" id="setMaxtemp" value="50"/> -->
    <input type="hidden" id="setMinrating" value="1"/>
    <input type="hidden" id="setMaxrating" value="5"/>
    <input type="hidden" id="setMaxPrice" value="0"/>
  </section>


  <style type="text/css">
  #footerbar{
  background: #1c1d22 url(<?php echo base_url(); ?>public/images/footerbar.png) no-repeat bottom center;
  }
  .filter-section.affix{
  width: 21.5%;
  top: 85px;
  }
  </style>
  <?php echo $this->load->view('home/footer'); ?>
  <!-- <script src="<?php echo base_url(); ?>public/js/jquery.nanoscroller.min.js"></script> -->
  <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.nicelabel.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>public/js/holiday/webservices.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>public/js/holiday/filter.js"></script>

  <!-- <script type="text/javascript" src="<?php echo base_url(); ?>public/js/left_filter.js" ></script> -->
  <!--  <script type="text/javascript">
  $(function () {
  $(document).bind('contextmenu', function (e) {
  e.preventDefault();
  alert('Right Click is not allowed');
  });
  });
  </script> -->
  <script type="text/javascript">
$(document).ready(function(){    
    //Check if the current URL contains '#'
    if(document.URL.indexOf("#")==-1){
        // Set the URL to whatever it was plus "#".
        url = document.URL+"#";
        location = "#";

        //Reload the page
        location.reload(true);
    }
});
</script>
  <script type="text/javascript">
  // $(document).ready(function(e) {
  //   var $input = $('#refresh');  
  //   if($input.val() == 'yes'){
  //     location.reload(true);
  //   }else{
  //        $input.val('yes');
  //   }
  // });
// $(document).ready(function() {
//     if (window.location.href.indexOf('reload')==-1) {
//          window.location.href=window.location.href+'?reload';
//               window.location.reload(true);
//        location.reload(true);
//     }
// });
</script>
  <script>
  function betterParseFloat(x) {
  if (isNaN(parseFloat(x)) && x.length > 0)
  return betterParseFloat(x.substr(1));
  return parseFloat(x);
  }
  function usd(x) {
  x = betterParseFloat(x);
  if (isNaN(x))
  return "$0.00";
  var dollars = Math.floor(x);
  var cents = Math.round((x - dollars) * 100) + "";
  if (cents.length == 1) cents = "0" + cents;
  return "$" + dollars + "." + cents;
  }
  $(function () {
  "use strict";
  $('.bxslider').bxSlider({
  auto: true
  });
  $('.accordion').accordion({
  defaultOpen: 'some_id'
  });
  //some_id section1 in demo
  // var tabsFn = (function () {
  //     function init() {
  //         setHeight();
  //     }
  //     // function setHeight() {
  //     //     var $tabPane = $('.tab-pane'),
  //     //         tabsHeight = $('.nav-tabs').height();
  //     //     $tabPane.css({
  //     //         height: tabsHeight
  //     //     });
  //     // }
  //     $(init);
  // })();
  });
  $(document).ready(function () {   
  $('.accordion-heading').each(function () {
  var $this = $(this);
  $this.click(function () {
  if ($this.next('.accordion-content').is(':visible')) {
  $this.next('.accordion-content').slideUp('slow');
  $this.find('span').removeClass('fa-angle-down').addClass('fa-angle-right');
  } else {
  $this.next('.accordion-content').slideDown('slow');
  $this.find('span').removeClass('fa-angle-right').addClass('fa-angle-down');
  }
  });
  });
  $('.custom-radio > input').nicelabel();
  // $(".nano").nanoScroller();
  });
  $(window).load(function(){
  $('.tab-pane.active').css('height', 'initial');
  });
  // $(window).scroll(function () {
  //     footertotop = ($('#contact').position().top);
  //     scrolltop = $(document).scrollTop()+570;
  //     difference = scrolltop-footertotop;
  //     if (scrolltop > footertotop) {
  //         $('.filter-section').css('margin-top',  0-difference);
  //     }
  //     else  {
  //         $('.filter-section').css('margin-top', 0);
  //     }
  // });
  </script>
