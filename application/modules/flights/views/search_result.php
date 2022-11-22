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
        .bg-custom {
            background: #d2d2d2 !important;
        }

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
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/blank_result.css">
<style>
    .airline_fx {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .badge-lists.filter_only {
        color: black;
        border: 1px solid lightgray;
        padding: 1px 7px;
        border-radius: 20px;
        font-size: 12px;
        opacity: 0;
    }

    .badge-lists.filter_only:hover {
        opacity: 1;
    }
</style>
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

                        <div id="rapid_fire_draft_loading">
                            <?php $this->load->view('blank_result'); ?>
                        </div>

                    <?php } ?>

                    <?php if ($tripType == 'round') {  ?>
                        <div id="rapid_fire_draft_loading">
                            <?php $this->load->view('blank_result'); ?>
                        </div>
                        <div class="row flights roundtrip-result">
                            <div class="col-6 gp_lt onward-trip" id="flightsresults">

                            </div>

                            <div class="col-6 gp_rt return-trip" id="flightsresults1">

                            </div>
                        </div>


                        <!-- fixed flight details start -->
                        <div class="selectedRoundFlights d-none">
                            <form action="<?php echo site_url(); ?>flights/itinerary" method="POST">
                                <input type="hidden" name="callBackId" value="<?php echo base64_encode('tbo'); ?>" />

                                <div class="row display_fixed">
                                    <div class="col-4 priceInfoOnward">


                                    </div>
                                    <div class="col-4 priceInfoReturn">

                                    </div>
                                    <div class="col-4 book_nw_btn_fx selectedButton">
                                        <div><span class="priceInfoTotal"> </span> </div>
                                        <span class="bookroundtrip"></span>
                                        <!-- <button class="btn btn_color">Book Now</button> -->
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
        // console.log('onward');
        $(".onwardRadio").addClass()
        $(".selectItem").removeClass("bg-custom");
        $(this).parent().parent().parent().parent().addClass("bg-custom");
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
        $(this).parent().parent().parent().parent().addClass("bg-custom");
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