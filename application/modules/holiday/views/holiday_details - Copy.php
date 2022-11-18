<?php $this->load->view('home/holidaydetailsheader'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/share/dist/jquery.floating-social-share.min.css" />
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
        background: #253035;
        color: #fff;
        padding: 20px;
        font-size: 13px;
        /*-moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;*/
        margin-bottom: 0;
        width: 100% !important;
    }
    #overview table, #goodtoknow table, #highlights table,#included table,#terms table{
        background: #253035;
        color: #fff;
        font-size: 13px;
        margin-bottom: 0;
        width: 100% !important;
    }
    #overview table td, #goodtoknow table td, #highlights table td,#included table td,#terms table td{
        padding: 8px
    }
    p:empty,ul:empty,ol:empty{display: none;}
    #overview ul,#highlights ul, #included ul, #terms ul, #goodtoknow ul{
        background: #253035;
        color: #fff;
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
    
</style>
<div id="wrapper" class="holi-details">
<section class="h-details page margintop97" id="home">
    <section class="section padding-off imgbanner" >
        <div class="hol_details" id="layerslider-container3" >
            <div class="flexslider opacity" id="layerslider3" >
                <ul class="slides">
                    <?php
                    $images=$this->Holiday_Model->get_img_holi_details($holidaydetails->holiday_id,1,1);
                    if(!empty($images)){
                    for($im=0;$im<count($images);$im++){
                    $str=base_url().'admin/'.$images[$im]->holiday_images;
                    if(getimagesize($str) !== false) {  ?>
                    <li>
                        <img alt="" class="ls-bg" src="<?php echo $str; ?>" >
                    </li>
                    <?php } } } ?>
                    <?php
                    $images=$this->Holiday_Model->get_img_holi_details($holidaydetails->holiday_id,2,3);
                    if(!empty($images)){
                    for($im=0;$im<count($images);$im++){
                    $str=base_url().'admin/'.$images[$im]->holiday_images;
                    if(getimagesize($str) !== false) {  ?>
                    <li>
                        <img alt="" class="ls-bg" src="<?php echo $str; ?>" >
                    </li>
                    <?php } } } ?>
                </ul>
            </div>
        </div>
        <div class="top-text">
            <span class="top-text-name"><?php echo strtoupper($holidaydetails->package_title); ?></span>
            <span class="top-text-duration">(<?php echo ($holidaydetails->duration)." Nights / ".($holidaydetails->duration+1)." Days";?>)</span>        
        </div>
    </section>
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
                            <li><a id="jump_accommodations" href="#accommodations"><span>Accommodation</a></li>
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

<section class="mobile-view">
    <div id="booking-flibber" class="col-lg-4 col-md-3 col-sm-3 col-xs-12 container-booking container-booking-sticky package-booking sticktop" data-spy="affix" data-offset-top="400">
        <div class="booking-form">
            <header>
                <div class="price">
                    <span><span style="font-size: 11px;color:#e5e2e2">Price on Twin sharing from</span><span id="priceheader" style="font-size: 22px;"> <i class="fa fa-rupee"></i> <?php echo moneyFormatIndia($holidaydetails->price); ?></span></span>
                </div>
            </header>
            <form id="booking-side-form" method="post" action="<?php echo site_url(); ?>holiday/holiday_package_booking" data-min="0" data-max="0">
                <input type="hidden"  name="holiday_id" id="holiday_id" value="<?php echo $holidaydetails->holiday_id; ?>">
                <input type="hidden"  name="accom_type" id="accom_type" value="Comfort">
                <input type="hidden" name="total_cost" id="total_cost" value="<?php echo $holidaydetails->price; ?>">
                <a href="<?php echo site_url(); ?>holiday/holidaydetails/<?php echo  base64_encode('AKBARHOLIDAYSPACKAGECODE'.$holidaydetails->holiday_id); ?>" class="booking-find-link"><h1><?php echo strtoupper($holidaydetails->package_title); ?></h1></a>
                <span style="position: relative;top: -5px">
                    <?php echo ($holidaydetails->duration)." Nights / ".($holidaydetails->duration+1)." Days";?>
                </span>
                <div class="row">
                    <input class="button-link" type="submit" value="PROCEED TO BOOKING" onclick=" return go_to_traveller();"/>
                </div>
                <br>
                <div class="row">
                    <a href="#enquiry" class="button-link" id="jump_touch">TO CUSTOMIZE</a>
                </div>
            </form>
        </div>
    </div>   
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

<?php if(!empty($itinerary)) { ?>
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
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
            <?php if($holidaydetails->duration > 3){ ?>
            <div class="col-md-12 text-center">
                <a id="btn-full-itinerary" class="button-link">VIEW FULL ITINERARY</a>
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
                        <div class="service-item accommodation-selectfull" style="cursor: pointer;"">
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
                                {  echo $holidaydetails->quality; } ?></p>
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
$('.hol_details .flexslider .slides img').css('height', imgheight-97);
// alert(imgheight);
});
</script>
<!-- PNotify CSS -->
<link href="<?php echo base_url(); ?>public/pnotify/pnotify.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/pnotify/pnotify.buttons.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/pnotify/pnotify.nonblock.css" rel="stylesheet">
<!-- PNotify  js-->
<script src="<?php echo base_url(); ?>public/pnotify/pnotify.js"></script>
<script src="<?php echo base_url(); ?>public/pnotify/pnotify.buttons.js"></script>
<script src="<?php echo base_url(); ?>public/pnotify/pnotify.nonblock.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/holiday/holidaydetails_accom_type.js"></script>
<style type="text/css">
#overview ul, #goodtoknow ul, #highlights ul, #included ul, #accommodations ul, #reviews ul, #terms ul {
list-style-type: inherit;
/*margin-left: 20px;*/
}

</style>
<!-- <script src="<?php echo base_url(); ?>public/shareplugin/src/jquery.sharebox.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/share/dist/jquery.floating-social-share.js"></script>
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
 