<!-- modify section start -->
<section class="mt-4">
    <div class="container border_sec  card_style2">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-6">
                <div class="row res_Modify_gap ">
                    <div class="col-sm-6 col-md-5">
                        <div class="flight_det_fx border_rt">
                            <span class="from_fx"><span class="frmCode"> <?=$fromCity?></span> <span>Mumbai</span></span>
                            <span><i class="fa fa-arrow-right"></i></span>
                            <span class="from_fx"><span class="frmCode"> <?=$toCity?></span> <span>Delhi</span></span>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="from_fx border_rt">
                            <span class="dep_font">Departure</span>
                            <span> <span class="font_bold"> 07</span> oct'22,friday</span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="from_fx border_rt">
                            <span class="dep_font">Traveller</span>
                            <span class="font_bold">01</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-12 col-md-4 col-lg-6 res_md_btn">
                <div class="row md_align">
                    <div class="col-7">
                        <div class="from_fx">
                            <span class="dep_font">Travel class</span>
                            <span class="font_bold">Economy</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="modify" id="modify_show">
                            Modify Search
                        </div>
                    </div>
                </div>
            </div>
            <div id="modify_show_desc" class="pt-4" style="display: none;">
                <div class="tab-pane in active" id="flights">
                    <div class="flight-top">
                        <ul class="nav nav-tabs">
                            <li class="res_font">
                                <a href="#one-way" class="active" data-bs-toggle="tab">One Way</a>
                            </li>
                            <li class="res_font"><a href="#round" data-bs-toggle="tab">Round Trip</a></li>
                            <li class="res_font"><a href="#city" data-bs-toggle="tab">Multi City</a></li>
                        </ul>
                        <p class="bookPara res_font d-none">Book International and Domestic Flights</p>
                    </div>

                    <div class="tab-content sub-content">
                        <div class="container tab-pane in active" id="one-way">
                            <div class="row one-way-info">
                                <div class="col-md-6 col-lg-3 border_rt">
                                    <div class="form-group ">
                                        <label class="from_form"><span>From</span></label>
                                        <div class="location_icon">

                                            <div class="dropdown drp_class">
                                                <input type="text" value="Delhi" type="button" class="form_input" readonly />
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
                                                <input type="text" value="Delhi" type="button" class="form_input" readonly />
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
                                        <input type="text" class="datepicker form_date" id="datepicker" autocomplete="off" placeholder="08-17-2022" readonly>
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
                                                <label>adult</label>
                                                <div class="input-group">
                                                    <button type="button" class="btn quantity-left-minus  shadow-none" data-type="minus" data-field="">
                                                        - </button>
                                                    <input type="text" name="quantity" class="form-control qty-input input-number" value="1">
                                                    <button type="button" class="btn quantity-right-plus  shadow-none" data-type="plus" data-field="">+</button>
                                                </div>
                                            </div>
                                            <div class="qty-box">
                                                <label>children</label>
                                                <div class="input-group">
                                                    <button type="button" class="btn quantity-left-minus shadow-none" data-type="minus" data-field="">
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

                            <div class="row">
                                <div class="col text-center mt-4 hot_deal_fx">

                                    <div class="search-btn">
                                        <button>Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container tab-pane" id="round">
                            <div class="row one-way-info">
                                <div class="col-md-6 col-lg-3 border_rt">
                                    <div class="form-group ">
                                        <label class="from_form"><span>From</span></label>
                                        <div class="location_icon">

                                            <div class="dropdown drp_class">
                                                <input type="text" value="Delhi" type="button" class="form_input" readonly />
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
                                        <input type="text" class="datepicker form_date" autocomplete="off" placeholder="08-17-2022">
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-2 border_rt">
                                    <div class="form-group">
                                        <label class="from_form"><span><span><i class="fa-solid fa-calendar-days"></i></span> Return</span></label>
                                        <input type="text" class="datepicker form_date" autocomplete="off" placeholder="08-17-2022" readonly>
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
                                                <label>adult</label>
                                                <div class="input-group">
                                                    <button type="button" class="btn quantity-left-minus  shadow-none" data-type="minus" data-field="">
                                                        - </button>
                                                    <input type="text" name="quantity" class="form-control qty-input input-number" value="1">
                                                    <button type="button" class="btn quantity-right-plus shadow-none" data-type="plus" data-field="">+</button>
                                                </div>
                                            </div>
                                            <div class="qty-box">
                                                <label>children</label>
                                                <div class="input-group">
                                                    <button type="button" class="btn quantity-left-minus shadow-none" data-type="minus" data-field="">
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

                            <div class="row">
                                <div class="col text-center mt-4 hot_deal_fx">

                                    <div class="search-btn">
                                        <button>Search</button>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="container tab-pane multiact" id="city">
                            <div class="row one-way-info">
                                <div class="col-md-6 col-lg-3 border_rt">
                                    <div class="form-group ">
                                        <label class="from_form"><span>From</span></label>
                                        <div class="location_icon">

                                            <div class="dropdown drp_class">
                                                <input type="text" value="Delhi" type="button" class="form_input" readonly />
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
                                                <input type="text" value="Delhi" type="button" class="form_input" readonly />
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
                                                        <input type="text" value="Delhi" type="button" class="form_input" readonly />
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
    </div>
</section>

<!-- modify section end -->