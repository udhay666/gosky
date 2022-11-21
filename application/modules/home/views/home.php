<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gosky</title>

    <!-- fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>assets_gosky/css/bootstrap.min.css">
    <!-- datepicker -->
    <link rel="stylesheet" href="<?= base_url() ?>assets_gosky/css/jquery-ui.css">
    <!-- slick -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">

    <!-- custom style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets_gosky/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets_gosky/css/responsive.css">


    <link href="<?php echo base_url(); ?>assets/plugins/jqueryui/jquery-ui.min.css" rel="stylesheet" type="text/css">

</head>

<body>
    <!-- heaader start -->
    <header class="bg_color header_padding">
        <nav class="navbar navbar-expand-lg navbar-dark ">
            <div class="container nav_display">
                <a class="navbar-brand" href="<?= base_url() ?>">Gosky-Logo</a>
                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav  mb-2 mb-lg-0">



                        <li class="nav-item dropdown nav_border">
                            <a class="nav-link " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" data-bs-offset="10,20" aria-expanded="false">
                                B2B
                            </a>

                        </li>
                        <li class="nav-item dropdown nav_border">
                            <a class="nav-link " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" data-bs-offset="10,20" aria-expanded="false">
                                B2C
                            </a>

                        </li>

                        <li class="nav-item dropdown nav_border2">
                            <a class="nav-link " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" data-bs-offset="10,20" aria-expanded="false">
                                Request a callback
                            </a>

                        </li>
                    </ul>

                </div>

            </div>
        </nav>
    </header>
    <!-- header end -->
    <!-- main start -->
    <main>
        <!-- search form start -->
        <section class="bg_color pb-5">
            <div class="categories-info">
                <div class="container relative ">

                    <div class="categories-details ">
                        <div class="categories-details-top">
                            <ul class="search_tab_ul">
                                <li class="mainlinks active" onclick="openhomeForm(event,'flight_form')">
                                    <a class="main_icon_anchor"><span class="Main_icon"><i class="fa-solid fa-plane-up rotate_icon "></i></span>Flights</a>
                                </li>
                                <li class="mainlinks" onclick="openhomeForm(event,'hotel_form')">
                                    <a class="main_icon_anchor"><span class="Main_icon"><i class="fa-solid fa-bed"></i></span>Hotels</a>
                                </li>



                            </ul>
                        </div>
                        <!-- flight form start -->
                        <!-- flight form start -->

                        <div class="tab-content main-content" id="flight_form" style="display: block">
                            <div>
                                <div class="tab-pane in active" id="flights">
                                    <div class="flight-top">
                                        <ul class="nav nav-tabs">
                                            <li class="res_font">
                                                <a href="#one-way" class="active" data-bs-toggle="tab">One Way</a>
                                            </li>
                                            <li class="res_font"><a href="#round" data-bs-toggle="tab">Round Trip</a></li>
                                            <li class="res_font"><a href="#city" data-bs-toggle="tab">Multi City</a></li>
                                        </ul>
                                        <p class="bookPara res_font">Book International and Domestic Flights</p>
                                    </div>

                                    <div class="tab-content sub-content">

                                        <div class="container tab-pane in active" id="one-way">
                                            <form class="flight-search-form" autocomplete="off" name="flight" id="flight" method="post" action="<?php echo site_url(); ?>flights/results">
                                                <div class="row one-way-info">
                                                    <div class="col-md-6 col-lg-3 border_rt">
                                                        <div class="form-group ">
                                                            <label class="from_form"><span>From</span></label>
                                                            <div class="location_icon">

                                                                <div class="dropdown drp_class">
                                                                    <input type="text" placeholder="Delhi" name="fromCity" class="form_input" />
                                                                </div>
                                                                <span class="location_span_icon"><i class="fa-solid fa-location-crosshairs"></i></span>

                                                            </div>
                                                            <p class="form_P">DEL, Delhi Airport India</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-3 border_rt">
                                                        <div class="form-group ">
                                                            <label class="from_form"><span>To</span></label>
                                                            <div class="location_icon">

                                                                <div class="dropdown drp_class">
                                                                    <input type="text" placeholder="Delhi" name="toCity" class="form_input" />
                                                                </div>
                                                                <span class="location_span_icon"><i class="fa-solid fa-location-crosshairs"></i></span>

                                                            </div>
                                                            <p class="form_P">BOM, Mumbai Airport India</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-2 border_rt">
                                                        <div class="form-group">
                                                            <label class="from_form"><span><span><i class="fa-solid fa-calendar-days"></i></span>
                                                                    Departure</span></label>
                                                            <input type="text" class="datepicker form_date" name="departDate" id="datepicker" autocomplete="off" placeholder="08-17-2022" readonly>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-2 border_rt">
                                                        <div class="form-group">
                                                            <label class="from_form"><span><span><i class="fa-solid fa-calendar-days"></i></span>
                                                                    Return</span></label>
                                                            <span class="oneway_return">Book a Roundtrip</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-lg-2 border_rt res_traveller">
                                                        <div class="form-group" id="searchBoxOpen" aria-expanded="false" data-bs-offset="-20,20">
                                                            <label class="from_form"><span>Traveller & class</span></label>
                                                            <div class="traveller_count_div">
                                                                <span id="traveller_count" class="traveller_count">1</span>&nbsp;<span id="traveller_txt" class="traveller_txt"> Traveller</span>
                                                                <span id="traveller_class" class="traveller_class">Economy</span>
                                                            </div>
                                                            </span>
                                                        </div>
                                                        <div class="selector-box-flight dropdown-menu" id="searchboxDesc" aria-labelledby="dropdownMenuOffset">
                                                            <div class="room-cls">
                                                                <div class="qty-box">
                                                                    <label>Adult</label>
                                                                    <div class="input-group">
                                                                        <button type="button" class="btn quantity-left-minus  shadow-none" data-type="minus" data-field="">
                                                                            - </button>
                                                                        <input type="text" name="adult_count" class="form-control qty-input input-number" value="1">
                                                                        <button type="button" class="btn quantity-right-plus  shadow-none" data-type="plus" data-field="">+</button>
                                                                    </div>
                                                                </div>
                                                                <div class="qty-box">
                                                                    <label>Children</label>
                                                                    <div class="input-group">
                                                                        <button type="button" class="btn quantity-left-minus shadow-none" data-type="minus" data-field="">
                                                                            - </button>
                                                                        <input type="text" name="child_count" class="form-control qty-input input-number" value="0">
                                                                        <button type="button" class="btn quantity-right-plus shadow-none" data-type="plus" data-field="">
                                                                            + </button>
                                                                    </div>
                                                                </div>
                                                                <div class="qty-box">
                                                                    <label>Infants</label>
                                                                    <div class="input-group">
                                                                        <button type="button" class="btn quantity-left-minus shadow-none" data-type="minus" data-field="">
                                                                            - </button>
                                                                        <input type="text" name="infant_count" class="form-control qty-input input-number" value="0">
                                                                        <button type="button" class="btn quantity-right-plus shadow-none" data-type="plus" data-field="">
                                                                            + </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flight-class pt-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input radio_animated shadow-none" type="radio" name="class" id="exampleRadios1" value="1" checked>
                                                                    <label class="form-check-label" for="exampleRadios1">
                                                                        Economy
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input radio_animated shadow-none" type="radio" name="class" id="exampleRadios2" value="2">
                                                                    <label class="form-check-label" for="exampleRadios2">
                                                                        Premium
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input radio_animated shadow-none" type="radio" name="class" id="exampleRadios3" value="3">
                                                                    <label class="form-check-label" for="exampleRadios3">
                                                                        Business
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="bottom-part text-center p-3">
                                                                <a href="#" class="btn apply_btn">Apply</a>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <input type="hidden" class="trip-type-hidden" id="tripType" name="tripType" value="oneway">
                                                <div class="row">
                                                    <div class="col text-center mt-4 hot_deal_fx">
                                                        <div class="search-btn">
                                                            <button>Hot Deal</button>
                                                        </div>
                                                        <div class="search-btn">
                                                            <button type="sumbit">Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>


                                        <div class="container tab-pane" id="round">
                                            <form method="post" action="<?php echo base_url(); ?>flights/results">
                                                <input type="hidden" class="trip-type-hidden" id="tripType" name="tripType" value="round">
                                                <div class="row one-way-info">
                                                    <div class="col-md-6 col-lg-3 border_rt">
                                                        <div class="form-group ">
                                                            <label class="from_form"><span>From</span></label>
                                                            <div class="location_icon">

                                                                <div class="dropdown drp_class">
                                                                    <input type="text" name="fromCity" placeholder="Delhi" class="form_input" />
                                                                </div>
                                                                <span class="location_span_icon"><i class="fa-solid fa-location-crosshairs"></i></span>

                                                            </div>
                                                            <!-- <p class="form_P">DEL, Delhi Airport India</p> -->
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-3 border_rt">
                                                        <div class="form-group ">
                                                            <label class="from_form"><span>To</span></label>
                                                            <div class="location_icon">

                                                                <div class="dropdown drp_class">
                                                                    <input type="text" name="toCity" placeholder="Mumbai" class="form_input" />
                                                                </div>
                                                                <span class="location_span_icon"><i class="fa-solid fa-location-crosshairs"></i></span>

                                                            </div>
                                                            <!-- <p class="form_P">BOM, Mumbai Airport India</p> -->
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-2 border_rt">
                                                        <div class="form-group">
                                                            <label class="from_form"><span><span><i class="fa-solid fa-calendar-days"></i></span> Departure</span></label>
                                                            <input type="text" name="departDate" class="datepicker form_date" autocomplete="off" value="<?= date('d-m-Y'); ?>">
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-2 border_rt">
                                                        <div class="form-group">
                                                            <label class="from_form"><span><span><i class="fa-solid fa-calendar-days"></i></span> Return</span></label>
                                                            <input type="text" name="returnDate" class="datepicker form_date" autocomplete="off" value="<?= date('d-m-Y', strtotime(' +1 day')); ?>">
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-lg-2 border_rt res_traveller">
                                                        <div class="form-group" id="searchBoxOpen2" aria-expanded="false" data-bs-offset="-20,20">
                                                            <label class="from_form"><span>Traveller & class</span></label>
                                                            <div class="traveller_count_div">
                                                                <span id="traveller_count" class="traveller_count">1</span>&nbsp;<span id="traveller_txt" class="traveller_txt"> Traveller</span>
                                                                <span id="traveller_class" class="traveller_class">Economy</span>
                                                            </div>
                                                            </span>
                                                        </div>
                                                        <div class="selector-box-flight dropdown-menu" id="searchboxDesc2" aria-labelledby="dropdownMenuOffset">
                                                            <div class="room-cls">
                                                                <div class="qty-box">
                                                                    <label>Adult</label>
                                                                    <div class="input-group">
                                                                        <button type="button" class="btn quantity-left-minus  shadow-none" data-type="minus" data-field="">
                                                                            - </button>
                                                                        <input type="text" name="adult_count" class="form-control qty-input input-number" value="1">
                                                                        <button type="button" class="btn quantity-right-plus shadow-none" data-type="plus" data-field="">+</button>
                                                                    </div>
                                                                </div>
                                                                <div class="qty-box">
                                                                    <label>Children</label>
                                                                    <div class="input-group">
                                                                        <button type="button" class="btn quantity-left-minus shadow-none" data-type="minus" data-field="">
                                                                            - </button>
                                                                        <input type="text" name="child_count" class="form-control qty-input input-number" value="0">
                                                                        <button type="button" class="btn quantity-right-plus shadow-none" data-type="plus" data-field="">
                                                                            + </button>
                                                                    </div>
                                                                </div>
                                                                <div class="qty-box">
                                                                    <label>Infants</label>
                                                                    <div class="input-group">
                                                                        <button type="button" class="btn quantity-left-minus shadow-none" data-type="minus" data-field="">
                                                                            - </button>
                                                                        <input type="text" name="infant_count" class="form-control qty-input input-number" value="0">
                                                                        <button type="button" class="btn quantity-right-plus shadow-none" data-type="plus" data-field="">
                                                                            + </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flight-class pt-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input radio_animated shadow-none" type="radio" name="class" id="exampleRadios1" value="1" checked>
                                                                    <label class="form-check-label" for="exampleRadios1">
                                                                        Economy
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input radio_animated shadow-none" type="radio" name="class" id="exampleRadios2" value="2">
                                                                    <label class="form-check-label" for="exampleRadios2">
                                                                        Premium
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input radio_animated shadow-none" type="radio" name="class" id="exampleRadios3" value="3">
                                                                    <label class="form-check-label" for="exampleRadios3">
                                                                        Business
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="bottom-part text-center p-3">
                                                                <a href="#" class="btn apply_btn">Apply</a>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="row">
                                                    <div class="col text-center mt-4 hot_deal_fx">
                                                        <div class="search-btn">
                                                            <button>Hot Deal</button>
                                                        </div>
                                                        <div class="search-btn">
                                                            <button type="submit">Search</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>

                                        </div>
                                        <div class="container tab-pane multiact" id="city">
                                            <div class="row one-way-info">
                                                <div class="col-md-6 col-lg-3 border_rt">
                                                    <div class="form-group ">
                                                        <label class="from_form"><span>From</span></label>
                                                        <div class="location_icon">

                                                            <div class="dropdown drp_class">
                                                                <input type="text" placeholder="Delhi" type="button" class="form_input" readonly />
                                                            </div>
                                                            <span class="location_span_icon"><i class="fa-solid fa-location-crosshairs"></i></span>

                                                        </div>
                                                        <p class="form_P">DEL, Delhi Airport India</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-3 border_rt">
                                                    <div class="form-group ">
                                                        <label class="from_form"><span>To</span></label>
                                                        <div class="location_icon">

                                                            <div class="dropdown drp_class">
                                                                <input type="text" value="Mumbai" type="button" class="form_input" readonly />
                                                            </div>
                                                            <span class="location_span_icon"><i class="fa-solid fa-location-crosshairs"></i></span>

                                                        </div>
                                                        <p class="form_P">BOM, Mumbai Airport India</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-2 border_rt">
                                                    <div class="form-group">
                                                        <label class="from_form"><span><span><i class="fa-solid fa-calendar-days"></i></span> Departure</span></label>
                                                        <input type="text" class="datepicker form_date" autocomplete="off" placeholder="08-17-2022" readonly>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 border_rt">
                                                    <div class="form-group" id="searchBoxOpen3" aria-expanded="false" data-bs-offset="-20,20">
                                                        <label class="from_form"><span>Traveller & class</span></label>
                                                        <div class="traveller_count_div">
                                                            <span id="traveller_count" class="traveller_count">1</span>&nbsp;<span id="traveller_txt" class="traveller_txt"> Traveller</span>
                                                            <span id="traveller_class" class="traveller_class">Economy</span>
                                                        </div>
                                                        </span>
                                                    </div>
                                                    <div class="selector-box-flight dropdown-menu" id="searchboxDesc3" aria-labelledby="dropdownMenuOffset">
                                                        <div class="room-cls">
                                                            <div class="qty-box">
                                                                <label>adult</label>
                                                                <div class="input-group">
                                                                    <button type="button" class="btn quantity-left-minus shadow-none" data-type="minus" data-field="">
                                                                        - </button>
                                                                    <input type="text" name="quantity" class="form-control qty-input input-number" value="1">
                                                                    <button type="button" class="btn quantity-right-plus  shadow-none" data-type="plus" data-field="">+</button>
                                                                </div>
                                                            </div>
                                                            <div class="qty-box">
                                                                <label>children</label>
                                                                <div class="input-group">
                                                                    <button type="button" class="btn quantity-left-minus shadow-none " data-type="minus" data-field="">
                                                                        - </button>
                                                                    <input type="text" name="quantity" class="form-control qty-input input-number" value="1">
                                                                    <button type="button" class="btn quantity-right-plus shadow-none" data-type="plus" data-field="">
                                                                        + </button>
                                                                </div>
                                                            </div>
                                                            <div class="qty-box">
                                                                <label>Infants</label>
                                                                <div class="input-group">
                                                                    <button type="button" class="btn quantity-left-minus shadow-none" data-type="minus" data-field="">
                                                                        - </button>
                                                                    <input type="text" name="quantity" class="form-control qty-input input-number" value="1">
                                                                    <button type="button" class="btn quantity-right-plus shadow-none" data-type="plus" data-field="">
                                                                        + </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flight-class pt-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input radio_animated shadow-none" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                                <label class="form-check-label" for="exampleRadios1">
                                                                    economy
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input radio_animated shadow-none" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                                                <label class="form-check-label" for="exampleRadios2">
                                                                    premium
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input radio_animated shadow-none" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                                                <label class="form-check-label" for="exampleRadios3">
                                                                    business
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="bottom-part text-center p-3">
                                                            <a href="#" class="btn apply_btn">apply</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- clone here -->
                                            <div id="clonehere">

                                            </div>


                                            <div class="row one-way-info mt-3">
                                                <div class="col-md-6 col-lg-3 border_rt">
                                                    <div class="form-group ">
                                                        <label class="from_form"><span>From</span></label>
                                                        <div class="location_icon">

                                                            <div class="dropdown drp_class">
                                                                <input type="text" placeholder="Delhi" type="button" class="form_input" readonly />
                                                            </div>
                                                            <span class="location_span_icon"><i class="fa-solid fa-location-crosshairs"></i></span>

                                                        </div>
                                                        <p class="form_P">DEL, Delhi Airport India</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-3 border_rt">
                                                    <div class="form-group ">
                                                        <label class="from_form"><span>To</span></label>
                                                        <div class="location_icon">

                                                            <div class="dropdown drp_class">
                                                                <input type="text" value="Mumbai" type="button" class="form_input" readonly />
                                                            </div>
                                                            <span class="location_span_icon"><i class="fa-solid fa-location-crosshairs"></i></span>

                                                        </div>
                                                        <p class="form_P">BOM, Mumbai Airport India</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-2 border_rt">
                                                    <div class="form-group">
                                                        <label class="from_form"><span><span><i class="fa-solid fa-calendar-days"></i></span> Departure</span></label>
                                                        <input type="text" class="datepicker form_date" autocomplete="off" placeholder="08-17-2022" readonly>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 form-group align-items-start justify-content-center">
                                                    <button class="btn add_btn shadow-none" id="add_room">
                                                        <span>+ Add City</span>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col text-center mt-4">
                                                    <div class="search-btn">
                                                        <button>Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- clone -->
                                            <div id="cty_clone_orgnl" class="template" style="display: none;">
                                                <div class="container mt-3">
                                                    <div class="row one-way-info  ">
                                                        <div class="col-md-6 col-lg-3 border_rt">
                                                            <div class="form-group ">
                                                                <label class="from_form"><span>From</span></label>
                                                                <div class="location_icon">

                                                                    <div class="dropdown drp_class">
                                                                        <input type="text" placeholder="Delhi" type="button" class="form_input" readonly />
                                                                    </div>
                                                                    <span class="location_span_icon"><i class="fa-solid fa-location-crosshairs"></i></span>

                                                                </div>
                                                                <p class="form_P">DEL, Delhi Airport India</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-3 border_rt">
                                                            <div class="form-group ">
                                                                <label class="from_form"><span>To</span></label>
                                                                <div class="location_icon">

                                                                    <div class="dropdown drp_class">
                                                                        <input type="text" value="Mumbai" type="button" class="form_input" readonly />
                                                                    </div>
                                                                    <span class="location_span_icon"><i class="fa-solid fa-location-crosshairs"></i></span>

                                                                </div>
                                                                <p class="form_P">BOM, Mumbai Airport India</p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-lg-2 border_rt remove_icon_fl d-flex">
                                                            <div class="form-group">
                                                                <label class="from_form"><span><span><i class="fa-solid fa-calendar-days"></i></span> Departure</span></label>
                                                                <input type="text" class="datepicker form_date" autocomplete="off" placeholder="08-17-2022" readonly>
                                                                </span>
                                                            </div>
                                                            <div class="remove_icon">
                                                                <span class="remove_btn" id="remove_anthr_city">
                                                                    <span><i class="fas fa-times"></i></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-2 border_rt remove_icon_fl d-none">
                                                            <div class="form-group">
                                                                <label class="from_form"><span><span><i class="fa-solid fa-calendar-days"></i></span> Departure</span></label>
                                                                <input type="text" class="datepicker form_date" autocomplete="off" placeholder="08-17-2022" readonly>
                                                                </span>
                                                            </div>
                                                            <div class="remove_icon">
                                                                <span class="remove_btn" id="remove_anthr_city">
                                                                    <span><i class="fa-solid fa-times fa-beat-fade"></i></span>
                                                                </span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>



                                </div>
                            </div>
                        </div>
                        <!-- flight form end -->
                        <!-- flight form end -->
                        <!-- hotel form start -->
                        <div class="tab-content main-content ht_res_maincontent" id="hotel_form">
                            <div class="tab-pane in active" id="hotel-homepage">
                                <p class="bookPara res_font text-center">
                                    Book Domestic and International hotels Online.
                                </p>
                                <form action="<?php echo site_url(); ?>hotels/results" autocomplete="on" role="form" method="POST">
                                    <div class="container tab-pane in active" id="one-way">
                                        <div class="row one-way-info">
                                            <div class="col-md-6 col-lg-3 border_rt">
                                                <div class="form-group ">
                                                    <label class="from_form"><span>ENTER YOUR DESTINATION OR PROPERTY</span></label>
                                                    <div class="location_icon">

                                                        <div class="dropdown drp_class">
                                                            <input type="text" name="cityName" placeholder="Delhi" class="form_input" />
                                                            <input id="target_search" name="target_search" type="hidden" value="">
                                                            <input type="hidden" name="cityid" class="cityid" id="hotelcityid">
                                                        </div>
                                                        <span class="location_span_icon"><i class="fa-solid fa-location-crosshairs"></i></span>

                                                    </div>
                                                    <p class="form_P"> Delhi Airport India</p>
                                                </div>
                                            </div>



                                            <div class="col-md-6 col-lg-3 border_rt">
                                                <div class="form-group">
                                                    <label class="from_form"><span><span><i class="fa-solid fa-calendar-days"></i></span>
                                                            Check-in</span></label>
                                                    <input type="text" name="check_in" class="datepicker form_date" autocomplete="off" placeholder="08-17-2022">
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-3 border_rt">
                                                <div class="form-group">
                                                    <label class="from_form"><span><span><i class="fa-solid fa-calendar-days"></i></span>
                                                            Check-out</span></label>
                                                    <input type="text" name="check_out" class="datepicker form_date" autocomplete="off" placeholder="09-17-2022">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3 border_rt res_traveller">
                                                <div class="form-group" id="searchBoxOpenHT" aria-expanded="false" data-bs-offset="-20,20">
                                                    <label class="from_form"><span>Traveller & Class</span></label>
                                                    <div class="traveller_count_div">
                                                        <span id="traveller_count" class="traveller_count">1</span>&nbsp;
                                                        <span id="traveller_txt" class="traveller_txt"> Room</span>
                                                        <span id="traveller_count" class="traveller_count">1</span>
                                                        <span id="traveller_txt" class="traveller_txt"> Guest</span>
                                                    </div>
                                                    </span>
                                                </div>
                                                <div class="selector-box-flight dropdown-menu ht_selectorbox" id="searchboxHTDesc" aria-labelledby="dropdownMenuOffset">
                                                    <div class="room-cls">
                                                        <div class="qty-box">
                                                            <label>Adult</label>
                                                            <div class="input-group">
                                                                <button type="button" class="btn quantity-left-minus  shadow-none" data-type="minus" data-field="">
                                                                    - </button>
                                                                <input type="text" name="adults1" class="form-control qty-input input-number" value="1">
                                                                <button type="button" class="btn quantity-right-plus  shadow-none" data-type="plus" data-field="">+</button>
                                                            </div>
                                                        </div>
                                                        <div class="qty-box ht_child_fx">
                                                            <label class="ht_child_fx">Children <span class="ht_child">(2 - 12 Years)</span>
                                                            </label>
                                                            <div class="input-group">
                                                                <button type="button" class="btn quantity-left-minus shadow-none" data-type="minus" data-field="">
                                                                    - </button>
                                                                <input type="text" name="childs1" class="form-control qty-input input-number" value="0">
                                                                <button type="button" class="btn quantity-right-plus shadow-none" data-type="plus" data-field="">
                                                                    + </button>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="bottom-part p-3 apply_btn_ht">
                                                        <input type="hidden" name="room_count" id="room_count" value="1">
                                                        <span class="ht_Add_btn"> + Add Another Room</span>
                                                        <button class="btn apply_btn">Apply</button>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row">
                                            <div class="col text-center mt-4 ">

                                                <div class="search-btn">
                                                    <button type="submit">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <!-- hotel form end -->



                    </div>
                </div>
            </div>
        </section>
        <!-- seaerch form end -->
        <!-- exclusive deals start -->
        <section class="mt-5 ">
            <div class="container">
                <div class="container popular-destinations">
                    <h4>Top <span>Sectors</span></h4>

                </div>
                <div class="exclusivedeal">
                    <div class="tourBox">
                        <div class="tourImg ">
                            <img src="<?= base_url() ?>assets_gosky/images/exclusivedeal/1.png" class="img-fluid " alt="">
                        </div>
                    </div>
                    <div class="tourBox">
                        <div class="tourImg">
                            <img src="<?= base_url() ?>assets_gosky/images/exclusivedeal/2.png" class="img-fluid " alt="">
                        </div>
                    </div>
                    <div class="tourBox">
                        <div class="tourImg ">
                            <img src="<?= base_url() ?>assets_gosky/images/exclusivedeal/3.png" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="tourBox">
                        <div class="tourImg ">
                            <img src="<?= base_url() ?>assets_gosky/images/exclusivedeal/4.png" class="img-fluid " alt="">
                        </div>
                    </div>
                    <div class="tourBox">
                        <div class="tourImg ">
                            <img src="<?= base_url() ?>assets_gosky/images/exclusivedeal/5.png" class="img-fluid " alt="">
                        </div>
                    </div>
                    <div class="tourBox">
                        <div class="tourImg ">
                            <img src="<?= base_url() ?>assets_gosky/images/exclusivedeal/1.png" class="img-fluid " alt="">
                        </div>
                    </div>
                    <div class="tourBox">
                        <div class="tourImg ">
                            <img src="<?= base_url() ?>assets_gosky/images/exclusivedeal/5.png" class="img-fluid " alt="">
                        </div>
                    </div>
                    <div class="tourBox">
                        <div class="tourImg  ">
                            <img src="<?= base_url() ?>assets_gosky/images/exclusivedeal/2.png" class="img-fluid " alt="">
                        </div>
                    </div>
                    <div class="tourBox">
                        <div class="tourImg ">
                            <img src="<?= base_url() ?>assets_gosky/images/exclusivedeal/5.png" class="img-fluid " alt="">
                        </div>
                    </div>
                    <div class="tourBox">
                        <div class="tourImg ">
                            <img src="<?= base_url() ?>assets_gosky/images/exclusivedeal/3.png" class="img-fluid " alt="">
                        </div>
                    </div>
                    <div class="tourBox">
                        <div class="tourImg ">
                            <img src="<?= base_url() ?>assets_gosky/images/exclusivedeal/4.png" class="img-fluid " alt="">
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- exclusive details end -->
        <!-- popular destination start -->
        <section class="mt-5">
            <div class="container main_popular_border">
                <div class="container popular-destinations">
                    <h4>Popular <span>Destinations</span></h4>

                    <ul>
                        <li>
                            <a href="#all" data-toggle="tab" class="active">All Destinations</a>
                        </li>
                        <li>
                            <a href="#international" data-toggle="tab">International</a>
                        </li>
                        <li>
                            <a href="#domestic" data-toggle="tab">Domestic</a>
                        </li>
                    </ul>

                    <div class="view-deals">
                        <a href="#">View All Destinations</a>
                    </div>
                </div>
                <div class="container tab-content">

                    <div class="row popular-destination-features">
                        <div class="col-lg-6 ">
                            <div class="popular-destination-features-lt">
                                <div class="popular-destination-features-item">
                                    <a href="#">
                                        <img src="<?= base_url() ?>assets_gosky/images/europe/Europe.jpg" alt="popular-desination-pic">
                                        <span>Maldives</span>
                                    </a>
                                </div>

                                <div class="popular-destination-features-item">
                                    <a href="#">
                                        <img src="<?= base_url() ?>assets_gosky/images/europe/Greece-8f2ba51a8ba482afcd2c1cb783ae1bc3e800ddf6f5350cfef8c417ec72653fc9.jpg" alt="popular-desination-pic">
                                        <span>Turkey</span>
                                    </a>
                                </div>

                                <div class="popular-destination-features-item">
                                    <a href="#">
                                        <img src="<?= base_url() ?>assets_gosky/images/europe/Iceland.jpg" alt="popular-desination-pic">
                                        <span>Dubai</span>
                                    </a>
                                </div>

                                <div class="popular-destination-features-item">
                                    <a href="#">
                                        <img src="<?= base_url() ?>assets_gosky/images/europe/London-b7eeae22e8d68d2f8ef2be53a73ae59f1f15dd3c3a6a5e97a833ce4aad2faa10.jpg" alt="popular-desination-pic">
                                        <span>Kashmir</span>
                                    </a>
                                </div>

                                <div class="popular-destination-features-item">
                                    <a href="#">
                                        <img src="<?= base_url() ?>assets_gosky/images/europe//Norway.jpg" alt="popular-desination-pic">
                                        <span>Ladakh</span>
                                    </a>
                                </div>

                                <div class="popular-destination-features-item">
                                    <a href="#">
                                        <img src="<?= base_url() ?>assets_gosky/images/europe/Paris.jpg" alt="popular-desination-pic">
                                        <span>Cordelia Cruises</span>
                                    </a>
                                </div>

                                <div class="popular-destination-features-item">
                                    <a href="#">
                                        <img src="<?= base_url() ?>assets_gosky/images/europe/Switzerland.jpg" alt="popular-desination-pic">
                                        <span>Sri-Lanka</span>
                                    </a>
                                </div>

                                <div class="popular-destination-features-item">
                                    <a href="#">
                                        <img src="<?= base_url() ?>assets_gosky/images/europe/Turkey.jpg" alt="popular-desination-pic">
                                        <span>Switzerland</span>
                                    </a>
                                </div>

                                <div class="popular-destination-features-item">
                                    <a href="#">
                                        <img src="<?= base_url() ?>assets_gosky/images/europe/Europe.jpg" alt="popular-desination-pic">
                                        <span>Andaman</span>
                                    </a>
                                </div>

                                <div class="popular-destination-features-item">
                                    <a href="#">
                                        <img src="<?= base_url() ?>assets_gosky/images/europe/Greece-8f2ba51a8ba482afcd2c1cb783ae1bc3e800ddf6f5350cfef8c417ec72653fc9.jpg" alt="popular-desination-pic">
                                        <span>Himachal</span>
                                    </a>
                                </div>

                                <div class="popular-destination-features-item">
                                    <a href="#">
                                        <img src="<?= base_url() ?>assets_gosky/images/europe/Iceland.jpg" alt="popular-desination-pic">
                                        <span>Sri-Lanka</span>
                                    </a>
                                </div>

                                <div class="popular-destination-features-item">
                                    <a href="#">
                                        <img src="<?= base_url() ?>assets_gosky/images/europe/Norway.jpg" alt="popular-desination-pic">
                                        <span>Maldives</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="popular-destination-features-rt">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 res_col">
                                        <div class="popular-destination-rt-item">
                                            <a href="#">
                                                <img src="<?= base_url() ?>assets_gosky/images/europe/Europe.jpg" alt="popular-destination-item-pic">
                                                <h6>Europe</h6>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 res_col">
                                        <div class="popular-destination-rt-item">
                                            <a href="#">
                                                <img src="<?= base_url() ?>assets_gosky/images/europe/Iceland.jpg" alt="popular-destination-item-pic">
                                                <h6>Thailand</h6>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 res_col">
                                        <div class="popular-destination-rt-item">
                                            <img src="<?= base_url() ?>assets_gosky/images/europe/Norway.jpg" alt="popular-destination-item-pic">
                                            <h6>Himachal</h6>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 res_col">
                                        <div class="popular-destination-rt-item">
                                            <img src="<?= base_url() ?>assets_gosky/images/europe/Turkey.jpg" alt="popular-destination-item-pic">
                                            <h6>Ladakh</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- popular destination end -->
        <!-- top hotel destination start -->
        <section class="mt-5">
            <div class="container">
                <div class="container popular-destinations">
                    <h4>Top <span>Hotel estination</span></h4>

                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12 travel-stories-info">
                        <div class="flightDestination_card">
                            <div class="fld_img_sec">
                                <img src="https://tpdtechnosoft.com/TPD_Projects/go_wykin/images/south_east_asia/Bali.jpg" alt="">
                            </div>
                            <div class="fldtextarea">
                                <div class="fldtextarea1">
                                    <div class="fldtextarea_con">
                                        <p>Dubai</p>
                                        <span>UAE</span>
                                    </div>
                                    <span><i class="fa-solid fa-bed"></i></span>
                                    <div class="fldtextarea_con">
                                        <p>550+</p>
                                        <span>Hotels</span>
                                    </div>
                                </div>
                                <div class="fldtextarea2">
                                    <div class="fldtextarea_con">
                                        <p class="fldr_hot_str_icon">
                                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                        </p>
                                        <span>Luxury Hotel</span>
                                    </div>
                                    <div class="fldtextarea_con fldtxtalign">
                                        <p class="fld_inr">INR ₹ 2022</p>
                                        <span><button>View all</button></span>
                                    </div>
                                </div>
                                <div class="fldtextarea2">
                                    <div class="fldtextarea_con">
                                        <p class="fldr_hot_str_icon">
                                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                        </p>
                                        <span>Budget Hotel</span>
                                    </div>
                                    <div class="fldtextarea_con fldtxtalign">
                                        <p class="fld_inr">INR ₹ 2022</p>
                                        <span><button>View all</button></span>
                                    </div>
                                </div>
                                <div class="fldtextarea2">
                                    <div class="fldtextarea_con">
                                        <p class="fldr_hot_str_icon">
                                            <i class="fa-solid fa-star"></i>
                                        </p>
                                        <span>Cheapest Hotel</span>
                                    </div>
                                    <div class="fldtextarea_con fldtxtalign">
                                        <p class="fld_inr">INR ₹ 2022</p>
                                        <span><button>Viewall</button></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 col-12 travel-stories-info">
                        <div class="flightDestination_card">
                            <div class="fld_img_sec">
                                <img src="https://tpdtechnosoft.com/TPD_Projects/go_wykin/images/south_east_asia/Cambodia.jpg" alt="">
                            </div>
                            <div class="fldtextarea">
                                <div class="fldtextarea1">
                                    <div class="fldtextarea_con">
                                        <p>Dubai</p>
                                        <span>UAE</span>
                                    </div>
                                    <span><i class="fa-solid fa-bed"></i></span>
                                    <div class="fldtextarea_con">
                                        <p>550+</p>
                                        <span>Hotels</span>
                                    </div>
                                </div>
                                <div class="fldtextarea2">
                                    <div class="fldtextarea_con">
                                        <p class="fldr_hot_str_icon">
                                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                        </p>
                                        <span>Luxury Hotel</span>
                                    </div>
                                    <div class="fldtextarea_con fldtxtalign">
                                        <p class="fld_inr">INR ₹ 2022</p>
                                        <span><button>View all</button></span>
                                    </div>
                                </div>
                                <div class="fldtextarea2">
                                    <div class="fldtextarea_con">
                                        <p class="fldr_hot_str_icon">
                                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                        </p>
                                        <span>Budget Hotel</span>
                                    </div>
                                    <div class="fldtextarea_con fldtxtalign">
                                        <p class="fld_inr">INR ₹ 2022</p>
                                        <span><button>View all</button></span>
                                    </div>
                                </div>
                                <div class="fldtextarea2">
                                    <div class="fldtextarea_con">
                                        <p class="fldr_hot_str_icon">
                                            <i class="fa-solid fa-star"></i>
                                        </p>
                                        <span>Cheapest Hotel</span>
                                    </div>
                                    <div class="fldtextarea_con fldtxtalign">
                                        <p class="fld_inr">INR ₹ 2022</p>
                                        <span><button>Viewall</button></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12 travel-stories-info">
                        <div class="flightDestination_card">
                            <div class="fld_img_sec">
                                <img src="https://tpdtechnosoft.com/TPD_Projects/go_wykin/images/south_east_asia/Malaysia.jpg" alt="">
                            </div>
                            <div class="fldtextarea">
                                <div class="fldtextarea1">
                                    <div class="fldtextarea_con">
                                        <p>Dubai</p>
                                        <span>UAE</span>
                                    </div>
                                    <span><i class="fa-solid fa-bed"></i></span>
                                    <div class="fldtextarea_con">
                                        <p>550+</p>
                                        <span>Hotels</span>
                                    </div>
                                </div>
                                <div class="fldtextarea2">
                                    <div class="fldtextarea_con">
                                        <p class="fldr_hot_str_icon">
                                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                        </p>
                                        <span>Luxury Hotel</span>
                                    </div>
                                    <div class="fldtextarea_con fldtxtalign">
                                        <p class="fld_inr">INR ₹ 2022</p>
                                        <span><button>View all</button></span>
                                    </div>
                                </div>
                                <div class="fldtextarea2">
                                    <div class="fldtextarea_con">
                                        <p class="fldr_hot_str_icon">
                                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                        </p>
                                        <span>Budget Hotel</span>
                                    </div>
                                    <div class="fldtextarea_con fldtxtalign">
                                        <p class="fld_inr">INR ₹ 2022</p>
                                        <span><button>View all</button></span>
                                    </div>
                                </div>
                                <div class="fldtextarea2">
                                    <div class="fldtextarea_con">
                                        <p class="fldr_hot_str_icon">
                                            <i class="fa-solid fa-star"></i>
                                        </p>
                                        <span>Cheapest Hotel</span>
                                    </div>
                                    <div class="fldtextarea_con fldtxtalign">
                                        <p class="fld_inr">INR ₹ 2022</p>
                                        <span><button>Viewall</button></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12 travel-stories-info">
                        <div class="flightDestination_card">
                            <div class="fld_img_sec">
                                <img src="https://tpdtechnosoft.com/TPD_Projects/go_wykin/images/south_east_asia/Singapore.jpg" alt="">
                            </div>
                            <div class="fldtextarea">
                                <div class="fldtextarea1">
                                    <div class="fldtextarea_con">
                                        <p>Dubai</p>
                                        <span>UAE</span>
                                    </div>
                                    <span><i class="fa-solid fa-bed"></i></span>
                                    <div class="fldtextarea_con">
                                        <p>550+</p>
                                        <span>Hotels</span>
                                    </div>
                                </div>
                                <div class="fldtextarea2">
                                    <div class="fldtextarea_con">
                                        <p class="fldr_hot_str_icon">
                                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                        </p>
                                        <span>Luxury Hotel</span>
                                    </div>
                                    <div class="fldtextarea_con fldtxtalign">
                                        <p class="fld_inr">INR ₹ 2022</p>
                                        <span><button>View all</button></span>
                                    </div>
                                </div>
                                <div class="fldtextarea2">
                                    <div class="fldtextarea_con">
                                        <p class="fldr_hot_str_icon">
                                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                        </p>
                                        <span>Budget Hotel</span>
                                    </div>
                                    <div class="fldtextarea_con fldtxtalign">
                                        <p class="fld_inr">INR ₹ 2022</p>
                                        <span><button>View all</button></span>
                                    </div>
                                </div>
                                <div class="fldtextarea2">
                                    <div class="fldtextarea_con">
                                        <p class="fldr_hot_str_icon">
                                            <i class="fa-solid fa-star"></i>
                                        </p>
                                        <span>Cheapest Hotel</span>
                                    </div>
                                    <div class="fldtextarea_con fldtxtalign">
                                        <p class="fld_inr">INR ₹ 2022</p>
                                        <span><button>Viewall</button></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>





                </div>
            </div>
        </section>
        <!-- top hotel destination end -->
        <!-- newsletter section start -->
        <section class="mt-5 ">
            <div class="container newsletterSection">
                <div class="row res_row">
                    <div class="col-sm-10 col-md-4 res_newslettermargin">
                        <div class="news_imgfx">
                            <img src="<?= base_url() ?>assets_gosky/images/newsletter-image.jpg" alt="email" class="newsletterImage">
                            <div class="stay_update_fx">
                                <h2>Stay up <span>to Date</span></h2>
                                <p>Scbscribe now and receive the latest travel news.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10 col-md-3 res_newslettermargin">
                        <input type="text" placeholder="Your Name" class="newsletter_input">
                    </div>
                    <div class="col-sm-10 col-md-3 res_newslettermargin">
                        <input type="email" placeholder="Email ID" class="newsletter_input">
                    </div>
                    <div class="col-sm-10 col-md-2 res_newslettermarginBTN ">
                        <input type="submit" value="Subscribe" class="subscribe_btn">
                    </div>
                </div>
            </div>

        </section>
        <!-- newsletter section end -->
        <!-- why Gosky  start-->
        <section class="mt-5">
            <div class="container-fluid bg_color">
                <div class="container">
                    <ul class="aboutus_ul">
                        <li class="about_link active" onclick="openAbout(event,'about_info')">Why Gosky travels? <span class="iconrotate"><i class="fa-solid fa-chevron-down" class="rotateIcon"></i></span></li>

                        <li class="about_link" onclick="openAbout(event,'company_info')">Company Information <span class="iconrotate"><i class="fa-solid fa-chevron-down" class="rotateIcon"></i></span></span> </li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="about_link_content" id="about_info" style="display: block;">
                    <div class="about_desc">
                        <h3>Why Gosky travels ?</h3>
                        <p class="about_p">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non enim quasi provident praesentium dolorem velit, eaque cum laborum ut maxime itaque minima dolor unde neque vero quia amet corporis omnis.Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non enim quasi provident praesentium dolorem velit, eaque cum laborum ut maxime itaque minima dolor unde neque vero quia amet corporis omnis.
                        </p>
                        <p class="about_p">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non enim quasi provident praesentium dolorem velit, eaque cum laborum ut maxime itaque minima dolor unde neque vero quia amet corporis omnis.
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non enim quasi provident praesentium dolorem velit, eaque cum laborum ut maxime itaque minima dolor unde neque vero quia amet corporis omnis.Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non enim quasi provident praesent
                        </p>
                        <p class="about_p">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non enim quasi provident praesentium dolorem velit, eaque cum laborum ut maxime itaque minima dolor unde neque vero quia amet corporis omnis.
                        </p>
                    </div>
                </div>
                <div class="about_link_content" id="company_info">
                    <div class="about_desc">
                        <h3>Company Information</h3>
                        <p class="about_p">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non enim quasi provident praesentium dolorem velit, eaque cum laborum ut maxime itaque minima dolor unde neque vero quia amet corporis omnis.Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non enim quasi provident praesentium dolorem velit, eaque cum laborum ut maxime itaque minima dolor unde neque vero quia amet corporis omnis.
                        </p>
                        <p class="about_p">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non enim quasi provident praesentium dolorem velit, eaque cum laborum ut maxime itaque minima dolor unde neque vero quia amet corporis omnis.
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non enim quasi provident praesentium dolorem velit, eaque cum laborum ut maxime itaque minima dolor unde neque vero quia amet corporis omnis.Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non enim quasi provident praesent
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- why Gosky end -->
    </main>
    <!-- main end -->
    <!-- footer start -->
    <footer class="mt-5">
        <div class="footer section-b-space section-t-space pt-3">
            <div class="container">
                <div class="row order-row">
                    <div class="col-xl-2 col-md-6 order-cls">
                        <div class="footer-title mobile-title">
                            <h5>contact us</h5>
                        </div>
                        <div class="footer-content">
                            <div class="contact-detail">
                                <div class="footer-logo">
                                    <img src="" alt="footer-logo" class="img-fluid blur-up lazyloaded">
                                </div>
                                <p>Gosky</p>
                                <ul class="contact-list">
                                    <li><i class="fas fa-map-marker-alt"></i> GS Road, Bhangagarh, Guwahati - 599999, Assam</li>
                                    <li><i class="fas fa-phone-alt"></i>+91-999999999 <br><i class="fas fa-phone-alt"></i>+91-9999999999</li>
                                    <li><i class="fas fa-envelope"></i> support@Gosky.in</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-3 ">
                        <div class="footer-space">
                            <div class="footer-title">
                                <h5>about</h5>
                            </div>
                            <div class="footer-content">
                                <div class="footer-links">
                                    <ul>
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">FAQ</a></li>
                                        <li><a href="#">Login</a></li>
                                        <li><a href="#">Register</a></li>
                                        <li><a href="#">terms &amp; co.</a></li>
                                        <li><a href="#">privacy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="footer-title">
                            <h5>top airlines</h5>
                        </div>
                        <div class="footer-content">
                            <div class="footer-place">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="place rounded5">
                                            <a href="#">
                                                <img src="<?= base_url() ?>assets_gosky/images/footer/1.png" class="img-fluid blur-up lazyloaded" alt="">
                                                <div class="overlay">
                                                    <h6>SpiceJet</h6>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="place rounded5">
                                            <a href="#">
                                                <img src="<?= base_url() ?>assets_gosky/images/footer/2.png" class="img-fluid blur-up lazyloaded" alt="">
                                                <div class="overlay">
                                                    <h6>Vistara</h6>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="place rounded5">
                                            <a href="#">
                                                <img src="<?= base_url() ?>assets_gosky/images/footer/3.png" class="img-fluid blur-up lazyloaded" alt="">
                                                <div class="overlay">
                                                    <h6>AirAsia</h6>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="place rounded5">
                                            <a href="#">
                                                <img src="<?= base_url() ?>assets_gosky/images/footer/4.png" class="img-fluid blur-up lazyloaded" alt="">
                                                <div class="overlay">
                                                    <h6>GoFirst</h6>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="place rounded5">
                                            <a href="#">
                                                <img src="<?= base_url() ?>assets_gosky/images/footer/5.png" class="img-fluid blur-up lazyloaded" alt="">
                                                <div class="overlay">
                                                    <h6>AirIndia</h6>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="place rounded5">
                                            <a href="#">
                                                <img src="<?= base_url() ?>assets_gosky/images/footer/6.png" class="img-fluid blur-up lazyloaded" alt="">
                                                <div class="overlay">
                                                    <h6>IndiGo</h6>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-3 order-cls">
                        <div class="footer-space">
                            <div class="footer-title">
                                <h5>useful links</h5>
                            </div>
                            <div class="footer-content">
                                <div class="footer-links">
                                    <ul>
                                        <li><a href="#">home</a></li>
                                        <!--  <li><a href="#">our vehical</a></li> -->
                                        <li><a href="#">training video</a></li>
                                        <!-- <li><a href="#">services</a></li> -->
                                        <li><a href="#">booking deal</a></li>
                                        <li><a href="#">emergency call</a></li>
                                        <li><a href="#">mobile app</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="footer-title">
                            <h5>We accept</h5>
                        </div>
                        <div class="footer-content">
                            <div class="row weaccept_items align-items-center">
                                <div class="col-4"><img src="<?= base_url() ?>assets_gosky/images/footer/visa.jpg" alt="" class="weaccept_img"></div>
                                <div class="col-4"><img src="<?= base_url() ?>assets_gosky/images/footer/Mastercard.png" alt="" class="weaccept_img"></div>
                                <div class="col-4"><img src="<?= base_url() ?>assets_gosky/images/footer/americanexpress.png" alt="" class="weaccept_img"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-footer">
            <div class="container">
                <div class="row ">
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="footer-social">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="copy-right">
                            <p>copyright © 2022 Gosky travels <span>Developed by <a href="http://travelPd.com" target="_blank"> TrvelPD</a></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->
    <!-- script -->

    <!-- bootstrap -->
    <script src="<?= base_url() ?>assets_gosky/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets_gosky/js/bootstrap.min.js"></script>
    <!-- slickjs -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"></script>

    <script src="<?= base_url() ?>assets_gosky/js/script.js"></script>
    <script>
        var site_url = "<?= site_url(); ?>";
    </script>
    <script src="<?= base_url(); ?>assets/js/autocomplete/airport_list.js"></script>

    <script>
        $('.exclusivedeal').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 4000,
            prevArrow: "display:none",
            nextArrow: 'display:none',
            responsive: [{
                    breakpoint: 1030,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 780,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 350,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    </script>
    <!-- datepicker -->
    <script src="<?= base_url() ?>assets_gosky/js/jquery-ui.js"></script>
    <script>
        $(function() {
            $(".datepicker").datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: 'today'

            });
        });
    </script>

</body>

</html>