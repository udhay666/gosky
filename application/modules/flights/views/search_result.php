<?php defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('home/header');
// echo"<pre>";print_r($session_data['departDate']);exit;
$session_data = $searcharray;
$journeyDate = date('Y-M-d', strtotime(str_replace('/', '-', $session_data['departDate'])));
//$departure = explode("/",$departDate); $depart_year = $departure[0]; $depart_month = $departure[1]; $depart_day = $departure[2];

// echo '<pre>';print_r($session_data);exit;
$fromCity_arr = explode(',', $session_data['fromCity']);
$toCity_arr = explode(',', $session_data['toCity']);
$tripType = $session_data['tripType'];
$fromCityName = explode('(', $fromCity_arr[1]);
$toCityName = explode('(', $toCity_arr[1]);
// $journeyDate = date('Y-m-d',strtotime(str_replace('/','-',$session_data['departDate'])));
$departDate = $session_data['departDate'];
$return_date = $session_data['returnDate'];
if (empty($return_date)) {
    $return_date = date("d/m/Y");
} else {
    $return_date = $session_data['returnDate'];
}
// $journeyDate = $departDate = date('D, j M Y', strtotime(str_replace('/', '-', $return_date)));
$adults = $session_data['adult_count'];
$childs = $session_data['child_count'];
$infants = $session_data['infant_count'];
$cabinClass = $session_data['class'];
$returnDate = $return_date;
?>
<?php if ($tripType == 'round') { ?>
    <link rel="stylesheet" href="<?= base_url() ?>assets_gosky/css/flight/flight_roundtripresponsive.css">
    <style>
        .flightchange {
            flex-direction: column;
            width: 100%;
        }

        .flight1,
        .flight2 {
            width: 100% !important;
        }

        .fc_layover {
            text-align: center;
        }

        .flight1 {
            border-bottom: 1px solid lightgray;
            border-right: unset !important;
        }

        .flight2 {
            border-left: unset !important;
            border-top: 1px solid lightgray;

            border-bottom: 1px solid lightgray;
        }

        .prce_fx {
            display: flex;
            align-items: center;
            gap: 85px;
            justify-content: end;
        }

        .card_style {
            background: #fff;
            border: 1px solid rgba(156, 170, 179, 0.28);
            box-shadow: 0 0 9px 0 rgb(0 0 0 / 10%);
            border-radius: 5px;
            transition: box-shadow 0.3s ease;
            padding: 10px;
        }
    </style>
<?php } ?>
<main>
    <!-- breadcrumb start -->
    <section class="res_bc">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Flight</a></li>
            </ol>
        </nav>
    </section>
    <!-- breadcrumb  end -->


    <?php $this->load->view('modify_search2'); ?>

    <!-- search result start -->
    <section class="mt-5">
        <div class="container">
            <div class="row">
                <!-- responsive filter -->
                <div class="filter_btn card_style2" id="filterBtn">
                    <span>Filter <span><i class="fa fa-filter"></i></span></span>
                </div>
                <!-- responsive filter -->
                <div class="col-md-12 col-lg-3 " id="filterBtn_show">
                    <div class=" filter_border card_style2">
                        <div class="filter-wrap" id="filter-area">
                            <a href="#" class="btn-filter-close rotate-left btn btn-danger visible-sm visible-xs d-none" style="position: fixed; right:-30px; top:50%"> × Close filter</a>
                            <div id="filters-block">
                                <!--<a href="#" class="btn-filter-close rotate-left btn btn-danger visible-xs" style="position: fixed; right:-30px; top:50%"> &times Close  filter</a>-->


                                <article class="panel panel-default">
                                    <header class="panel-heading">
                                        <h4 class="panel-title"> Stops</h4>
                                    </header> <!-- panel-heading// -->
                                    <div class="panel-body">
                                        <div class="btn-group stop-end d-flex stop_main_gap">
                                            <div class="form-group stop_btn">
                                                <label class="btn btn-default">
                                                    <input type="checkbox" class="Stop d-none" value="0" checked="checked"> 0
                                                </label>
                                            </div>

                                            <div class="form-group stop_btn">
                                                <label class="btn btn-default">
                                                    <input type="checkbox" class="Stop d-none" value="1" checked="checked"> 1
                                                </label>
                                            </div>
                                            <div class="form-group stop_btn">
                                                <label class="btn btn-default">
                                                    <input type="checkbox" class="Stop d-none" value="2" checked="checked"> 1 +
                                                </label>
                                            </div>


                                        </div>
                                    </div> <!-- panel-body // -->
                                </article> <!-- panel// -->

                                <article class="panel panel-default">
                                    <header class="panel-heading">
                                        <h4 class="panel-title">Fare type</h4>
                                    </header> <!-- panel-heading// -->
                                    <div class="panel-body">

                                        <!-- <div class="btn-group" data-toggle="buttons"> -->

                                        <label class="btn btn-default">
                                            <input class="faretype" type="checkbox" value="1" checked="checked">
                                            Refundable
                                        </label>
                                        <label class="btn btn-default">
                                            <input class="faretype" type="checkbox" value="0" checked="checked">
                                            Non-Refundable
                                        </label>
                                        <!-- </div> -->
                                    </div> <!-- panel-body// -->
                                </article> <!-- panel// -->

                                <article class="panel panel-default">
                                    <header class="panel-heading">
                                        <h4 class="panel-title">Departure Time</h4>
                                    </header> <!-- panel-heading// -->
                                    <div class="panel-body">
                                        <ul class="depature-list">
                                            <li class="active">
                                                <label><input class="DepartTime d-none" type="checkbox" value="0-6" checked="checked">
                                                    <i class="fa fa-sunset"></i><span>Before<br> 6 AM</span></label>
                                            </li>
                                            <li><label><input class="DepartTime d-none" type="checkbox" value="6-12" checked="checked">
                                                    <i class="fa fa-sun-cloud"></i><span>6 AM - <br> 12
                                                        PM</span></label></li>
                                            <li><label><input class="DepartTime d-none" type="checkbox" value="12-18" checked="checked">
                                                    <i class="fa fa-sun-haze"></i><span>12 PM -<br> 6
                                                        PM</span></label></li>
                                            <li><label><input class="DepartTime d-none" type="checkbox" value="18-0" checked="checked">
                                                    <i class="fa fa-moon"></i><span>After<br> 6 PM</span></label>
                                            </li>

                                        </ul>
                                    </div> <!-- panel-body// -->
                                </article>

                                <article class="panel panel-default">
                                    <header class="panel-heading">
                                        <h4 class="panel-title">Arrival Time</h4>
                                    </header> <!-- panel-heading// -->
                                    <div class="panel-body">
                                        <ul class="depature-list">

                                            <li class="active">
                                                <label><input class="ArrivTime d-none" type="checkbox" value="0-6" checked="checked">
                                                    <i class="fa fa-sunset"></i><span>Before<br> 6 AM</span></label>
                                            </li>
                                            <li><label><input class="ArrivTime d-none" type="checkbox" value="6-12" checked="checked">
                                                    <i class="fa fa-sun-cloud"></i><span>6 AM - <br> 12
                                                        PM</span></label></li>
                                            <li><label><input class="ArrivTime d-none" type="checkbox" value="12-18" checked="checked">
                                                    <i class="fa fa-sun-haze"></i><span>12 PM -<br> 6
                                                        PM</span></label></li>
                                            <li><label><input class="ArrivTime d-none" type="checkbox" value="18-0" checked="checked">
                                                    <i class="fa fa-moon"></i><span>After<br> 6 PM</span></label>
                                            </li>

                                        </ul>
                                    </div>
                                </article>




                                <article class="panel panel-default">
                                    <header class="panel-heading">
                                        <h4 class="panel-title">Airlines</h4>
                                    </header> <!-- panel-heading// -->
                                    <div class="panel-body filter-airlines-wrap">
                                        <label><a><input type="checkbox" name="" id="show_all" style="vertical-align: top; display:none;" checked="">Show
                                                all</a></label>

                                        <div class="airlines">

                                        </div>
                                    </div>
                                </article> <!-- panel// -->
                                <article class="panel panel-default">
                                    <header class="panel-heading">
                                        <h4 class="panel-title">Price range</h4>
                                    </header> <!-- panel-heading// -->
                                    <div class="panel-body">
                                        <br>

                                        <div class="pricerange">
                                            <div class="slider_range">
                                                <input type="range" min="1" value="" class="slider_input">
                                            </div>
                                            <div class="mnmx_prce">
                                                <span class="min">₹9,419</span>
                                                <span class="max">₹19,419</span>
                                            </div>
                                        </div>
                                    </div> <!-- panel-body // -->
                                </article> <!-- panel// -->

                                <input type="hidden" id="setMinPrice" value="0">
                                <input type="hidden" id="setMaxPrice" value="41324">
                                <input type="hidden" id="setMinTime" value="0">
                                <input type="hidden" id="setMaxTime" value="1440">
                                <input type="hidden" id="setMinDuration" value="0">
                                <input type="hidden" id="setMaxDuration" value="1440">
                                <input type="hidden" id="setCurrency" value="INR">

                            </div> <!-- filter-wrap// -->
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-9">
                    <div class="row res_d_none">
                        <div class="col-3">
                            <div>
                                <span class="flt_hd_font">AIRLINE</span>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="flt_hd_fx">

                                <span class="flt_hd_font">DEPARTURE</span>


                                <span class="flt_hd_font">DURATION</span>


                                <span class="flt_hd_font">ARRIVAL</span>
                            </div>
                        </div>
                        <div class="col-1"></div>


                        <div class="col-3">
                            <div class="prce_fx">
                                <span class="flt_hd_font">PRICE</span>

                                <span class="flt_hd_font">BEST VALUE</span>
                            </div>
                        </div>

                    </div>
                    <?php if ($tripType == 'oneway') { ?>
                        <div class="flights" id="flightsresults">

                        </div>
                    <?php } ?>

                    <?php if ($tripType == 'round') {  ?>
                        <div class="row flights roundtrip-result">
                            <div class="col-6 gp_lt onward-trip" id="flightsresults_22">
                                <div class=" border_card mb-3 card_style r_card">

                                    <div class="r_flt_name">

                                        <span class="flight_fxR"><span class="flight_name">IndiGo</span><span class="flight_id">SG-1234</span></span>

                                        <div class="seat_left_fx">
                                            <span><img src="<?= base_url(); ?>assets_gosky/images/seat_airline.png" style="width:20px;"></span>
                                            <span>9 left</span>
                                        </div>
                                    </div>
                                    <div class="row  ">
                                        <div class="col-sm-12 col-md-1">
                                            <div class="">
                                                <span class="logofx"><span><img src="<?= base_url(); ?>assets_gosky/images/flight/6E.jpg" alt="logo"></span>

                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 res_margin">
                                            <div class="res_jc">
                                                <div class="flight-list-item-btm">
                                                    <ul class="item-btmR">
                                                        <li>18:20
                                                            <span>Mumbai</span>
                                                        </li>
                                                        <li>
                                                            <h6 class="lay_time">5h:40m</h6>
                                                            <div class="flt_1stop">
                                                                <span class="line"></span>
                                                                <span><i class="fa fa-plane rotate_icon "></i></span>
                                                            </div>
                                                        </li>
                                                        <li class="seat_fx">
                                                            <div>
                                                                00:00
                                                                <span>Delhi</span>
                                                            </div>

                                                        </li>


                                                    </ul>



                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>

                                        <div class="col-lg-12 col-xl-3">
                                            <div class="price_btn_fx_round">
                                                <h4 class="price">₹ 6428</h4>
                                                <span class="btn_det_fx">

                                                    <a class="flt_det_font" id="Flight_details"> +Details</a>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- fare details start -->
                                        <div class="row" id="Flight_details_Desc" style="display: none;">
                                            <div class="row">
                                                <div class="tab">
                                                    <button class="tablinks active" onclick="openCity(event, 'London')">Fligh Details</button>
                                                    <button class="tablinks" onclick="openCity(event, 'Paris')">Fare
                                                        Details</button>
                                                    <button class="tablinks" onclick="openCity(event, 'Tokyo')">Fare
                                                        Summary</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="stop_details tabcontent1" id="London" style="display: block;">
                                                    <div class="flightchange yes">
                                                        <div class=" flight1">
                                                            <div class="fc_name">
                                                                <img src="https://7htours.com/assets/imgs/flights/indigo.png">
                                                                <span>Indigo
                                                                    (6E-6597)</span>
                                                            </div>
                                                            <div class="airport-part">
                                                                <div class="airport-name">
                                                                    <h5>17.00</h5>
                                                                    <h6>Hyderabad</h6>
                                                                </div>
                                                                <div class="airport-progress">

                                                                    <i class="fas fa-plane-departure float-start"></i>
                                                                    <i class="fas fa-plane-arrival float-end"></i>
                                                                    <span class="fliStopsDisc"></span>


                                                                </div>
                                                                <div class="airport-name arrival">
                                                                    <h5>22.20</h5>
                                                                    <h6>Mumbai</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="fc_layover">
                                                            <small><i class="fa fa-clock"></i>Layover</small>
                                                            <p>4h 35m</p>
                                                        </div>
                                                        <div class=" flight2">
                                                            <div class="fc_name">
                                                                <img src="https://7htours.com/assets/imgs/flights/indigo.png">
                                                                <span>Indigo
                                                                    (6E-7066)</span>
                                                            </div>
                                                            <div class="airport-part">
                                                                <div class="airport-name">
                                                                    <h5>17.00</h5>
                                                                    <h6>Mumbai</h6>
                                                                </div>
                                                                <div class="airport-progress">

                                                                    <i class="fas fa-plane-departure float-start"></i>
                                                                    <i class="fas fa-plane-arrival float-end"></i>
                                                                    <span class="fliStopsDisc"></span>


                                                                </div>
                                                                <div class="airport-name arrival">
                                                                    <h5>22.20</h5>
                                                                    <h6>Hyderabad</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 pt-4">
                                                <div class="review_box tabcontent1" id="Paris">
                                                    <div class="title-top">
                                                        <h5>Fare details</h5>
                                                    </div>
                                                    <div class="flight_detail">
                                                        <div class="summery_box">
                                                            <table class="table table-borderless">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>adults (3 X &#8377; 25801)</td>
                                                                        <td> &#8377; 2590</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>total taxes</td>
                                                                        <td> &#8377; 2995</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Insurance</td>
                                                                        <td> &#8377; 1995</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Convenience fee</td>
                                                                        <td> &#8377; 1888</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="grand_total">
                                                                <h5>grand total: <span> &#8377; 20500</span></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 pt-2">
                                                <div class="review_box tabcontent1" id="Tokyo">
                                                    <div class="title-top">
                                                        <h5>HYD <span><i class="fas fa-plane-arrival"></i></span> TRI
                                                        </h5>
                                                    </div>
                                                    <div class="flight_detail">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="boxes">
                                                                    <h6>
                                                                        Airline Cancellation Fee</h6>
                                                                    <table class="table table-borderless">
                                                                        <tbody>
                                                                            <tr class="title">
                                                                                <td>Duration*</td>
                                                                                <td>Per Passenger</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>0 hour to 2 hours</td>
                                                                                <td>Non-Refundable</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>2 hours to 3 days before</td>
                                                                                <td> ₹ 3500</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>4 days and above</td>
                                                                                <td> ₹ 3000</td>
                                                                            </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="boxes">
                                                                    <h6>
                                                                        Airline Date Change Fee</h6>
                                                                    <table class="table table-borderless">
                                                                        <tbody>
                                                                            <tr class="title">
                                                                                <td>Duration*</td>
                                                                                <td>Per Passenger</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>0 hour to 2 hours</td>
                                                                                <td>Non-Refundable</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>2 hours to 3 days before</td>
                                                                                <td> ₹ 3250</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>4 days and above</td>
                                                                                <td> ₹ 2750</td>
                                                                            </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="boxes">
                                                                    <div class="faresummry_recomendation">
                                                                        We would recommend that you reschedule/cancel
                                                                        your
                                                                        tickets atleast 72 hours prior to the flight
                                                                        departure
                                                                    </div>
                                                                </div>
                                                                <div class="boxes">
                                                                    <h6>
                                                                        Gosky Service Fee **
                                                                    </h6>
                                                                    <h6>(charged per passenger in addition to airline
                                                                        fee as
                                                                        applicable)</h6>
                                                                    <table class="table table-borderless w-80">
                                                                        <tbody>

                                                                            <tr>
                                                                                <td>Cancellation service fee</td>
                                                                                <td>₹ 400</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Reschedule service fee</td>
                                                                                <td> ₹ 300</td>
                                                                            </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="boxes">
                                                                    <div class="faresummry_recomendation">
                                                                        <span>* Prior to the date/time of
                                                                            departure.</span>
                                                                        <br>
                                                                        <span>**Please note: Yatra service fee is over
                                                                            and
                                                                            above the airline cancellation fee due to
                                                                            which
                                                                            refund type may vary.</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- fare details end -->

                                        <!--  -->
                                    </div>
                                </div>

                            </div>
                            <div class="col-6 gp_rt return-trip" id="flightsresults1_22">
                                <div class="border_card mb-3 card_style r_card">

                                    <div class="r_flt_name">

                                        <span class="flight_fxR"><span class="flight_name">IndiGo</span><span class="flight_id">SG-1234</span></span>

                                        <div class="seat_left_fx">
                                            <span><img src="<?= base_url(); ?>assets_gosky/images/seat_airline.png" style="width:20px;"></span>
                                            <span>9 left</span>
                                        </div>
                                    </div>
                                    <div class="row  ">
                                        <div class="col-sm-12 col-md-1">
                                            <div class="">
                                                <span class="logofx"><span><img src="<?= base_url() ?>assets_gosky/images/flight/6E.jpg" alt="logo"></span>

                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 res_margin">
                                            <div class="res_jc">
                                                <div class="flight-list-item-btm">
                                                    <ul class="item-btmR">
                                                        <li>18:20
                                                            <span>Mumbai</span>
                                                        </li>
                                                        <li>
                                                            <h6 class="lay_time">5h:40m</h6>
                                                            <div class="flt_1stop">
                                                                <span class="line"></span>
                                                                <span><i class="fa fa-plane rotate_icon "></i></span>
                                                            </div>
                                                        </li>
                                                        <li class="seat_fx">
                                                            <div>
                                                                00:00
                                                                <span>Delhi</span>
                                                            </div>

                                                        </li>


                                                    </ul>



                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>

                                        <div class="col-lg-12 col-xl-3">
                                            <div class="price_btn_fx_round">
                                                <h4 class="price">₹ 6428</h4>
                                                <span class="btn_det_fx">

                                                    <a class="flt_det_font" id="Flight_details"> +Details</a>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- fare details start -->
                                        <div class="row" id="Flight_details_Desc" style="display: none;">
                                            <div class="row">
                                                <div class="tab">
                                                    <button class="tablinks active" onclick="openCity(event, 'London')">Fligh Details</button>
                                                    <button class="tablinks" onclick="openCity(event, 'Paris')">Fare
                                                        Details</button>
                                                    <button class="tablinks" onclick="openCity(event, 'Tokyo')">Fare
                                                        Summary</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="stop_details tabcontent1" id="London" style="display: block;">
                                                    <div class="flightchange yes">
                                                        <div class=" flight1">
                                                            <div class="fc_name">
                                                                <img src="https://7htours.com/assets/imgs/flights/indigo.png">
                                                                <span>Indigo
                                                                    (6E-6597)</span>
                                                            </div>
                                                            <div class="airport-part">
                                                                <div class="airport-name">
                                                                    <h5>17.00</h5>
                                                                    <h6>Hyderabad</h6>
                                                                </div>
                                                                <div class="airport-progress">

                                                                    <i class="fas fa-plane-departure float-start"></i>
                                                                    <i class="fas fa-plane-arrival float-end"></i>
                                                                    <span class="fliStopsDisc"></span>


                                                                </div>
                                                                <div class="airport-name arrival">
                                                                    <h5>22.20</h5>
                                                                    <h6>Mumbai</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="fc_layover">
                                                            <small><i class="fa fa-clock"></i>Layover</small>
                                                            <p>4h 35m</p>
                                                        </div>
                                                        <div class=" flight2">
                                                            <div class="fc_name">
                                                                <img src="https://7htours.com/assets/imgs/flights/indigo.png">
                                                                <span>Indigo
                                                                    (6E-7066)</span>
                                                            </div>
                                                            <div class="airport-part">
                                                                <div class="airport-name">
                                                                    <h5>17.00</h5>
                                                                    <h6>Mumbai</h6>
                                                                </div>
                                                                <div class="airport-progress">

                                                                    <i class="fas fa-plane-departure float-start"></i>
                                                                    <i class="fas fa-plane-arrival float-end"></i>
                                                                    <span class="fliStopsDisc"></span>


                                                                </div>
                                                                <div class="airport-name arrival">
                                                                    <h5>22.20</h5>
                                                                    <h6>Hyderabad</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 pt-4">
                                                <div class="review_box tabcontent1" id="Paris">
                                                    <div class="title-top">
                                                        <h5>Fare details</h5>
                                                    </div>
                                                    <div class="flight_detail">
                                                        <div class="summery_box">
                                                            <table class="table table-borderless">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>adults (3 X &#8377; 25801)</td>
                                                                        <td> &#8377; 2590</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>total taxes</td>
                                                                        <td> &#8377; 2995</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Insurance</td>
                                                                        <td> &#8377; 1995</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Convenience fee</td>
                                                                        <td> &#8377; 1888</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="grand_total">
                                                                <h5>grand total: <span> &#8377; 20500</span></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 pt-2">
                                                <div class="review_box tabcontent1" id="Tokyo">
                                                    <div class="title-top">
                                                        <h5>HYD <span><i class="fas fa-plane-arrival"></i></span> TRI
                                                        </h5>
                                                    </div>
                                                    <div class="flight_detail">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="boxes">
                                                                    <h6>
                                                                        Airline Cancellation Fee</h6>
                                                                    <table class="table table-borderless">
                                                                        <tbody>
                                                                            <tr class="title">
                                                                                <td>Duration*</td>
                                                                                <td>Per Passenger</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>0 hour to 2 hours</td>
                                                                                <td>Non-Refundable</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>2 hours to 3 days before</td>
                                                                                <td> ₹ 3500</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>4 days and above</td>
                                                                                <td> ₹ 3000</td>
                                                                            </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="boxes">
                                                                    <h6>
                                                                        Airline Date Change Fee</h6>
                                                                    <table class="table table-borderless">
                                                                        <tbody>
                                                                            <tr class="title">
                                                                                <td>Duration*</td>
                                                                                <td>Per Passenger</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>0 hour to 2 hours</td>
                                                                                <td>Non-Refundable</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>2 hours to 3 days before</td>
                                                                                <td> ₹ 3250</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>4 days and above</td>
                                                                                <td> ₹ 2750</td>
                                                                            </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="boxes">
                                                                    <div class="faresummry_recomendation">
                                                                        We would recommend that you reschedule/cancel
                                                                        your
                                                                        tickets atleast 72 hours prior to the flight
                                                                        departure
                                                                    </div>
                                                                </div>
                                                                <div class="boxes">
                                                                    <h6>
                                                                        Gosky Service Fee **
                                                                    </h6>
                                                                    <h6>(charged per passenger in addition to airline
                                                                        fee as
                                                                        applicable)</h6>
                                                                    <table class="table table-borderless w-80">
                                                                        <tbody>

                                                                            <tr>
                                                                                <td>Cancellation service fee</td>
                                                                                <td>₹ 400</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Reschedule service fee</td>
                                                                                <td> ₹ 300</td>
                                                                            </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="boxes">
                                                                    <div class="faresummry_recomendation">
                                                                        <span>* Prior to the date/time of
                                                                            departure.</span>
                                                                        <br>
                                                                        <span>**Please note: Yatra service fee is over
                                                                            and
                                                                            above the airline cancellation fee due to
                                                                            which
                                                                            refund type may vary.</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- fare details end -->

                                        <!--  -->
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- fixed flight details start -->
                        <div class="selectedRoundFlights">
                            <form action="<?php echo site_url(); ?>flights/itinerary" method="POST">
                                <input type="hidden" name="callBackId" value="<?php echo base64_encode('tbo'); ?>" />

                                <div class="row display_fixed">
                                    <div class="col-4 priceInfoOnward">
                                        <div class="stcy_dpr_fx">
                                            <p>Onward :</p>
                                            <span>Vistara</span>
                                        </div>
                                        <div class="fd_img_rp_fx">
                                            <span class="img_fd_desc"><img src="<?= base_url() ?>assets_gosky/images/flight/6E.jpg" alt="flight-logo" class="icon_img_fd">
                                                <div class="stcy_desc_fx">
                                                    <span>09:05</span><span class="st_icon"><i class="fa fa-arrow-right"></i></span><span>11:05</span>
                                                </div>
                                            </span>
                                            <span class="fd_rupee">
                                                <span> ₹</span> 12,138</span>
                                        </div>

                                    </div>
                                    <div class="col-4 priceInfoReturn">
                                        <div class="stcy_dpr_fx">
                                            <p>Return :</p>
                                            <span>Vistara</span>
                                        </div>
                                        <div class="fd_img_rp_fx">
                                            <span class="img_fd_desc"><img src="<?= base_url() ?>assets_gosky/images/flight/6E.jpg" alt="flight-logo" class="icon_img_fd">
                                                <div class="stcy_desc_fx">
                                                    <span>08:05</span><span class="st_icon"><i class="fa fa-arrow-right"></i></span><span>10:10</span>
                                                </div>
                                            </span>
                                            <span class="fd_rupee">
                                                <span> ₹</span> 11,138</span>
                                        </div>
                                    </div>
                                    <div class="col-4 book_nw_btn_fx selectedButton">
                                        <div><span class="priceInfoTotal"> ₹ 23,775</span> </div>
                                        <span class="bookroundtrip"></span>
                                        <button class="btn btn_color">Book Now</button>
                                    </div>
                            </form>
                        </div>
                </div>
                <!--  fixed flight details end -->
            <?php } ?>

            </div>


        </div>
        </div>

    </section>

    <!-- search result end -->

</main>

<?php $this->load->view('footer'); ?>

<input type="hidden" id="searcharray" value='<?php echo serialize($searcharray); ?>'>
<input type="hidden" id="sessionId" value=''>
<input type="hidden" id="siteUrl" value='<?php echo site_url(); ?>'>


<script type="text/javascript">
    var api_array = <?php echo json_encode($api_list); ?>
</script>
<script src="<?php echo base_url(); ?>assets/js/flight-listing.js"></script>
<script src="<?php echo base_url(); ?>assets/js/filtersnew.js"></script>
<!--<script src="<?php echo base_url(); ?>public/js/flight/filter.js" ></script>
<script src="<?php echo base_url(); ?>public/js/flight/webservices.js" ></script>-->
<script>
    $(document).on('click', '.stop-end .form-group label', function() {
        $(this).toggleClass('active').siblings().removeClass('active')
    })
</script>
<script>
    var siteUrl = "<?= site_url(); ?>";
</script>
<script type="text/javascript">
    $(document).on("click", '.onwardRadio', function($e) {
        $this = $(this);
        console.log('onward');
        $(".onwardRadio").addClass()
        $(".selectItem").removeClass("bg-custom");
        $(this).parent().parent().parent().parent().parent().parent().parent().parent().addClass("bg-custom");
        $searchId = $(this).attr('data-searchId');
        $(".priceInfoTotal").html(doTotal());
        $.ajax({
            url: siteUrl + 'flights/select_flight',
            data: 'searchId=' + $searchId,
            dataType: 'json',
            type: 'POST',
            beforeSend: function() {},
            success: function(data) {
                $('.priceInfoOnward').html(data.selected_flight);
                addbutton();
            }
        });
    });
    $(document).on("click", '.returnRadio', function($e) {
        $this = $(this);
        $(".selectItem2").removeClass("bg-custom");
        $(this).parent().parent().parent().parent().parent().parent().parent().parent().addClass("bg-custom");
        $searchId = $(this).attr('data-searchId');
        $(".priceInfoTotal").html(doTotal());
        $.ajax({
            url: siteUrl + 'flights/select_flight',
            data: 'searchId=' + $searchId,
            dataType: 'json',
            type: 'POST',
            beforeSend: function() {},
            success: function(data) {
                $('.priceInfoReturn').html(data.selected_flight);
                addbutton();
            }

        });
    });

    function addbutton() {
        $url = $('input[name=url]').val();
        $url1 = $('input[name=url1]').val();
        if ($url != undefined && $url1 != undefined) {
            $('.bookroundtrip').html('<a href="' + siteUrl + 'flights/itinerary/' + $url + '/' + $url1 + '" class="btn btn_color">Book Now</a>');
        }
    }

    function doTotal() {
        var TotalPriceOnSelection = 0;
        TotalPriceOnSelection += parseFloat($(".onwardRadio:checked").parents('.FlightInfoBox').attr('data-price'));
        TotalPriceOnSelection += parseFloat($(".returnRadio:checked").parents('.FlightInfoBox').attr('data-price'));
        return '₹ ' + TotalPriceOnSelection.toLocaleString();
    }
</script>