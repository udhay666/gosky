<?php $this->load->view('home/header'); ?>
<!-- slick -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">

<?php
if (!empty($map['html'])) {
    echo $map['js'];
}
// $session_data = $this->session->userdata('hotel_search_data');
$session_data = unserialize($hotel_temp_detail->searcharray);
$city_arr = explode(',', $session_data['cityName']);
// echo '<pre>';print_r($hotel_temp_detail);exit;
$cityName = $city_arr[0];
$adults_count = $session_data['adults_count'];
$childs_count = $session_data['childs_count'];
$rooms = $session_data['rooms'];
$nights = $session_data['nights'];
$checkIn = date('D, j M', strtotime(str_replace('/', '-', $session_data['checkIn'])));
$checkOut = date('D, j M', strtotime(str_replace('/', '-', $session_data['checkOut'])));
//echo '<pre/>';print_r($session_data['childs_ages']);exit;
if (empty($hotelDetails->HotelName)) {
    $error = 'Booking failed or the price may be changed .Please Contact Admin';
    redirect('home/error_page/' . base64_encode($error));
}
?>
<style>
    .hotel-dtls-amenities ul li {
        padding-bottom: 5px;
        min-width: 33%;
        display: inline-block;
    }

    .room-type-wrap {
        background: white;
        padding: 10px;
        box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .room-select-wrap {
        display: flex;
        flex-direction: column;
        align-items: center;
    }


    @media (min-width: 1400px) {

        .container,
        .container-lg,
        .container-md,
        .container-sm,
        .container-xl,
        .container-xxl {
            max-width: 1140px;
        }
    }

    @media only screen and (max-width:576px) {
        .from_fx {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 10px;
        }

        .res_align {
            text-align: center;
            margin: 10px 0;
        }
    }
</style>
<link rel="stylesheet" href="<?= base_url(); ?>assets_gosky/css/hotel/hotel.css">
<main data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example" tabindex="0">
    <!-- breadcrumb start -->
    <section class="res_bc">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Hotel</a></li>
                <li class="breadcrumb-item"><a href="#">Hotel review</a></li>

            </ol>
        </nav>
    </section>
    <!-- breadcrumb  end -->


    <!-- modify section start -->
    <section class="mt-4">
        <div class="container ">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <div class="row res_Modify_gap ">
                        <div class="col-sm-12 col-md-8">
                            <div class="">
                                <h3 class="ht_name_fx"><span class="ht_name_span"><?php echo $hotelDetails->HotelName . ', ' . $cityName;  ?></span>
                                    <span class="start_icon2">
                                        <?php for ($i = 0; $i < $hotelDetails->StarRating; $i++) { ?>
                                            <i class="fa fa-star"></i>
                                        <?php } ?>
                                    </span>
                                </h3>
                                <h6 class="ht_name_fx ht_location"><span><i class="fa fa-map-marker"></i></span><span><?= $hotelDetails->Address ?></span>
                                </h6>

                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 res_md_btn">
                    <div class="row md_align">

                        <div class="col-6">
                            <div class="modify p-0" id="modify_show">
                                Modify Search
                            </div>
                        </div>
                    </div>
                </div>
                <div id="modify_show_desc" class="pt-4" style="display: none;">
                    <div class="tab-content main-content ht_res_maincontent" id="hotel_form" style="display: block;">
                        <div class="tab-pane in active" id="hotel-homepage">
                            <div class="container tab-pane in active" id="one-way">
                                <div class="row one-way-info">
                                    <div class="col-md-6 col-lg-3 border_rt">
                                        <div class="form-group ">
                                            <label class="from_form"><span class="ht_span">ENTER YOUR DESTINATION OR
                                                    PROPERTY</span></label>
                                            <div class="location_icon">

                                                <div class="dropdown drp_class">
                                                    <input type="text" value="Delhi" class="form_input" readonly="">
                                                </div>
                                                <span class="location_span_icon"><i class="fa-solid fa-location-crosshairs"></i></span>

                                            </div>
                                            <p class="form_P"> Delhi Airport India</p>
                                        </div>
                                    </div>



                                    <div class="col-md-6 col-lg-3 border_rt">
                                        <div class="form-group">
                                            <label class="from_form"><span class="ht_span"><span><i class="fa-solid fa-calendar-days"></i></span>
                                                    Check-in</span></label>
                                            <input type="text" class="datepicker form_date " autocomplete="off" placeholder="08-17-2022" readonly="">

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-3 border_rt">
                                        <div class="form-group">
                                            <label class="from_form"><span class="ht_span"><span><i class="fa-solid fa-calendar-days"></i></span>
                                                    Check-out</span></label>
                                            <input type="text" class="datepicker form_date " autocomplete="off" placeholder="09-17-2022" readonly="">

                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3 border_rt res_traveller">
                                        <div class="form-group" id="searchBoxOpenHT" aria-expanded="false" data-bs-offset="-20,20">
                                            <label class="from_form"><span class="ht_span">Traveller &amp;
                                                    class</span></label>
                                            <div class="traveller_count_div">
                                                <span id="traveller_count" class="traveller_count">1</span>&nbsp;
                                                <span id="traveller_txt" class="traveller_txt"> Room</span>
                                                <span id="traveller_count" class="traveller_count">1</span>
                                                <span id="traveller_txt" class="traveller_txt"> Guest</span>
                                            </div>

                                        </div>
                                        <div class="selector-box-flight dropdown-menu ht_selectorbox" id="searchboxHTDesc" aria-labelledby="dropdownMenuOffset">
                                            <div class="room-cls">
                                                <div class="qty-box">
                                                    <label>adult</label>
                                                    <div class="input-group">
                                                        <button type="button" class="btn quantity-left-minus  shadow-none" data-type="minus" data-field="">
                                                            - </button>
                                                        <input type="text" name="quantity" class="form-control qty-input input-number" value="1">
                                                        <button type="button" class="btn quantity-right-plus  shadow-none" data-type="plus" data-field="">+</button>
                                                    </div>
                                                </div>
                                                <div class="qty-box ht_child_fx">
                                                    <label class="ht_child_fx">children <span class="ht_child">(2 -
                                                            12 Years)</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <button type="button" class="btn quantity-left-minus shadow-none" data-type="minus" data-field="">
                                                            - </button>
                                                        <input type="text" name="quantity" class="form-control qty-input input-number" value="1">
                                                        <button type="button" class="btn quantity-right-plus shadow-none" data-type="plus" data-field="">
                                                            + </button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="bottom-part p-3 apply_btn_ht">
                                                <span class="ht_Add_btn"> + Add Another Room</span>
                                                <a href="#" class="btn apply_btn">apply</a>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col text-center mt-4 ">

                                        <div class="search-btn">
                                            <button>Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- modify section end -->

    <!-- gallery start -->
    <section>
        <div class="container">
            <div id="navbar">
                <a href="#scrollspyHeading1">Photos</a>
                <a href="#scrollspyHeading2">Room & Rates</a>
                <a href="#scrollspyHeading3">Hotel amenities</a>
            </div>
        </div>
    </section>
    <section class="mt-5" id="scrollspyHeading1">
        <div class="container relative">

            <div class="ht_nav_main">
                <ul class="ht_nav_ul">
                    <li> <a href="#scrollspyHeading1">Photos</a>
                    </li>
                    <li> <a href="#scrollspyHeading2">Room & Rates</a>
                    </li>
                    <li> <a href="#scrollspyHeading3">Hotel Amenities</a>
                    </li>
                    <li> <a href="#scrollspyHeading4">Hotel Description</a>
                    </li>


                </ul>
            </div>

            <div class="container ht_img_bg">
                <div class="row ht">
                    <div class="col-sm-12 col-md-8">
                        <div class="row ht" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <div class="col-sm-12 col-md-7 ht2">
                                <img src="<?= $hotelDetails->images[0]; ?>" alt="" class="sd_imgm">
                            </div>
                            <div class="col-sm-12 col-md-5 ht">
                                <div class="row">
                                    <div class="col-6"><img src="<?= $hotelDetails->images[0]; ?>" alt="" class="sd_img"></div>
                                    <div class="col-6"><img src="<?= $hotelDetails->images[1]; ?>" alt="" class="sd_img"></div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><img src="<?= $hotelDetails->images[2]; ?>" alt="" class="sd_img"></div>
                                    <div class="col-6"><img src="<?= $hotelDetails->images[3]; ?>" alt="" class="sd_img"></div>

                                </div>
                                <div class="row">
                                    <div class="col-6"><img src="<?= $hotelDetails->images[4]; ?>" alt="" class="sd_img"></div>
                                    <div class="col-6"><img src="<?= $hotelDetails->images[5]; ?>" alt="" class="sd_img"></div>

                                </div>
                            </div>
                        </div>
                        <!--modal imgslider start  -->
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <div class="relative">
                                                <div class="hotelgallery">
                                                    <img src="<?= $hotelDetails->images[0]; ?>" alt="" class="slide_img">
                                                    <img src="<?= $hotelDetails->images[1]; ?>" alt="" class="slide_img">
                                                    <img src="<?= $hotelDetails->images[2]; ?>" alt="" class="slide_img">
                                                    <img src="<?= $hotelDetails->images[3]; ?>" alt="" class="slide_img">
                                                    <img src="<?= $hotelDetails->images[4]; ?>" alt="" class="slide_img">
                                                    <img src="<?= $hotelDetails->images[5]; ?>" alt="" class="slide_img">
                                                    <img src="<?= $hotelDetails->images[6]; ?>" alt="" class="slide_img">
                                                    <img src="<?= $hotelDetails->images[7]; ?>" alt="" class="slide_img">

                                                </div>
                                                <div class="nextArrow"><i class="fa fa-chevron-right"></i></div>
                                                <div class="prevArrow"><i class="fa fa-chevron-left"></i></div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- modal imgslider end -->
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-lg-4">
                                <div class="from_fx ">
                                    <span class="dep_font">Check-In</span>
                                    <span> <span class="font_bold"> </span> <?= $checkIn ?></span>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="res_align">
                                    <span class="font_bold"><?= $nights ?></span>
                                    <span class="">Nights</span>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="from_fx ">
                                    <span class="dep_font">Check-Out</span>
                                    <span> <span class="font_bold"> </span> <?= $checkOut ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="from_fx">
                                    <span class="dep_font">Rooms & Guests</span>
                                    <div>
                                        <span class="font_bold"><?= $rooms ?> </span> <span> Room</span>
                                        <span class="font_bold"><?= $adults_count + $childs_count ?> </span><span> Guests</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-12">
                                <div class="ht_name_fx_g mb-3"> <span class="amnities_g"><i class="fa fa-broom"></i>
                                        Room service</span>
                                    <span class="amnities_g"><i class="fa fa-swimmer"></i> Pool</span><span class="amnities_g"><i class="fa fa-utensils"></i> Restaurent</span>
                                    <span class="amnities_g"><i class="fa fa-wifi"></i> Wifi</span>
                                    <span class="amnities_g"><i class="fa fa-dumbbell"></i> Gym</span>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- gallery end -->
    <!-- rooms & rates start -->
    <section class="mt-4" id="scrollspyHeading2">

        <div class="container">
            <h2 class="amn_hd">Rooms & Rates</h2>

            <div class="row">
                <div class="col-12" id="rooms_info">
                    <?php $this->load->view('hotels/blank'); ?>
                    <!-- <div class="row border_card mb-3 mainbg_color card_style">

                        <div class="col-sm-12 col-md-8 res_margin">
                            <div>
                                <h3 class="ht_name_fx"><span class="ht_name_span"> Standard Room, City View, 1 FullBed, Non Refundable </span>
                                </h3>
                                <p class="amn_p_fx"><span class="amn_p_ic"><i class="fas fa-check"></i></span> Room only</p>
                                <p class="amn_p_fx"><span class="amn_p_ic"><i class="fas fa-check"></i></span> Free Parking</p>
                                <h6 class="ht_name_fx ht_location" style="color: #000;">More Inclusion</h6>

                                <div class="ht_name_fx mb-3"> <span class="amnities"><i class="fa fa-broom"></i> Room service</span>
                                    <span class="amnities"><i class="fa fa-swimmer"></i> Pool</span><span class="amnities"><i class="fa fa-utensils"></i> Restaurent</span>
                                    <span class="amnities"><i class="fa fa-wifi"></i> Wifi</span>
                                    <span class="amnities"><i class="fa fa-dumbbell"></i> Gym</span>
                                </div>
                                <span class="freebf mt-3"><i class="fas fa-mug-hot"></i> Free breakfast</span>
                            </div>
                        </div>
                        <div class="col-1">
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="ht_price_btnfx">
                                <h4 class="price">₹ 64280 <span class="tax">+ ₹ 30200 </span></h4>

                                <span class="btn_det_fx">
                                    <button class="btn-sm  btn_font">Book Now</button>


                                </span>
                            </div>
                        </div>


                    </div>                     -->
                </div>
            </div>
        </div>
    </section>

    <!-- rooms & rates end -->

    <!-- amenites start -->
    <section class="mt-5" id="scrollspyHeading3">
        <div class="container htbg_clr">
            <h2 class="amn_hd">Amenities & Info</h2>
            <?php if (!empty($hotelDetails->facilities)) { ?>
                <div class="mb-3">
                    <!-- <h3 class="amn_h3">General</h3> -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 hotel-dtls-amenities">
                            <ul>
                                <?php foreach ($hotelDetails->facilities as $fac) { ?>
                                    <li><span>»</span> <?php echo $fac; ?></li>
                                <?php } ?>
                            </ul>
                        </div>

                    </div>
                </div>
            <?php } ?>

        </div>
    </section>
    <!-- amenities end -->

    <!-- description start -->
    <section class="mt-5" id="scrollspyHeading4">
        <div class="container htbg_clr">
            <h2 class="amn_hd">Hotel Description</h2>
            <?php if (!empty($hotelDetails->Description)) { ?>
                <div class="mb-3">
                    <!-- <h3 class="amn_h3">Description</h3> -->
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <p class="mb-0"><?php echo strip_tags(html_entity_decode($hotelDetails->Description)); ?></p>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <iframe src="https://maps.google.com/maps?q=<?php echo $hotelDetails->lat; ?>,<?php echo $hotelDetails->long; ?>&hl=es;z=14&amp;output=embed" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>

                    </div>
                </div>
            <?php } ?>

        </div>
    </section>
    <!-- description end -->

</main>
<!-- end -->

<input type="hidden" id="siteUrl" value="<?= site_url(); ?>">
<?php $this->load->view('home/footer'); ?>
<!-- slick js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"></script>


<script>
    $('.hotelgallery').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: ".nextArrow",
        nextArrow: '.prevArrow',
    });
</script>
<script type="text/javascript">
    var callbackId = '<?php echo base64_encode($hotel_temp_detail->api); ?>';
    var sessionId = '<?php echo $hotel_temp_detail->session_id; ?>';
    var hotelId = '<?php echo $hotel_temp_detail->hotel_code; ?>';
    var latitude = '<?php echo $hotelDetails->lat; ?>';
    var longitude = '<?php echo $hotelDetails->long; ?>';
    var searchId = '<?php echo $hotel_temp_detail->search_id; ?>';
    var city = '<?php echo $cityName; ?>';
    var contract = '';
</script>

<script src="<?php echo base_url(); ?>assets/js/availrooms.js"></script>