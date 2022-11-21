<?php $this->load->view('home/header'); ?>
<link rel="stylesheet" href="<?=base_url();?>assets_gosky/css/hotel/hotel.css">
<?php
// $session_data = $this->session->userdata('hotel_search_data');
$session_data = $searcharray;

$city_arr = explode(',', $session_data['cityName']);
$cityName = $city_arr[0];
$cityCode = $session_data['cityCode'];
$cityName2 = ucwords($session_data['cityName']);
$adults_count = $session_data['adults_count'];
$childs_count = $session_data['childs_count'];
$rooms = $session_data['rooms'];
$nights = $session_data['nights'];
//   $checkIn = date('j M, Y',strtotime(str_replace('/','-',$session_data['checkIn'])));
$checkIn = date("D, d M'y", strtotime(str_replace('/', '-', $session_data['checkIn'])));
$checkOut = date('j M, Y', strtotime(str_replace('/', '-', $session_data['checkOut'])));
?>
<style>
    .tsc_pagination {
        display: inline-flex;
        list-style-type: none;
        text-align: center;
    }

    .tsc_pagination li:first-child {
        margin: 10px;
    }

    /* .tsc_pagination .current a{
    background-color: #26ae7a;
    border-radius: 50px;
    color: white;
} */
    .clearIcon {
        cursor: pointer;
        font-size: 18px;
        color: #555;
        position: absolute;
        right: 0;
        top: 0;
        line-height: 38px;
        z-index: 99;
    }

    #grid-view {
        width: 300px;
    }

    @media only screen and (max-width: 991px) {
        #grid-view {
            width: 719px;
        }

    }
</style>
<main>
    <!-- breadcrumb start -->
    <section class="res_bc">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Hotel</a></li>
            </ol>
        </nav>
    </section>
    <!-- breadcrumb  end -->


    <?php $this->load->view('modify'); ?>

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
                                        <h4 class="panel-title"> Hotel Name</h4>
                                    </header> <!-- panel-heading// -->
                                    <div class="panel-body pb-3">
                                        <div class="hotel_nme_input ">
                                            <input type="text" class="" placeholder="Search by hotel name">
                                        </div>
                                    </div> <!-- panel-body // -->
                                </article> <!-- panel// -->

                                <article class="panel panel-default">
                                    <header class="panel-heading">
                                        <h4 class="panel-title">Star Rating</h4>
                                    </header> <!-- panel-heading// -->
                                    <div class="panel-body">
                                        <div class="str_main_fx">
                                            <span class="str_fx"><input type="checkbox" name="" id=""> <span class="start_icon"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            </span>
                                            <span class="str_fx"><input type="checkbox" name="" id=""> <span class="start_icon"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span></span>
                                            <span class="str_fx"><input type="checkbox" name="" id=""> <span class="start_icon"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span></span>
                                        </div>

                                    </div> <!-- panel-body// -->
                                </article> <!-- panel// -->

                                <article class="panel panel-default">
                                    <header class="panel-heading">
                                        <h4 class="panel-title">Price Range</h4>
                                    </header> <!-- panel-heading// -->
                                    <div class="panel-body">
                                        <div class="str_main_fx">
                                            <span class="str_fx"><input type="checkbox" name="" id=""> <span class="ht_prce">Upto &#8377; 7000</span></span>
                                            <span class="str_fx"><input type="checkbox" name="" id=""> <span class="ht_prce"> &#8377; 7000 to &#8377;12000</span></span> <span class="str_fx"><input type="checkbox" name="" id=""> <span class="ht_prce">Upto &#8377; 12000 to &#8377;28000 </span></span> <span class="str_fx"><input type="checkbox" name="" id=""> <span class="ht_prce"> &#8377; 28000 & more</span></span>
                                        </div>

                                    </div> <!-- panel-body// -->
                                </article>

                                <article class="panel panel-default">
                                    <header class="panel-heading">
                                        <h4 class="panel-title">Property Type</h4>
                                    </header> <!-- panel-heading// -->
                                    <div class="panel-body">
                                        <div class="str_main_fx">
                                            <span class="str_fx"><input type="checkbox" name="" id=""> <span class="ht_prce">Resort</span></span>
                                            <span class="str_fx"><input type="checkbox" name="" id=""> <span class="ht_prce">Hotel</span></span> <span class="str_fx"><input type="checkbox" name="" id=""> <span class="ht_prce">Country house </span></span> <span class="str_fx"><input type="checkbox" name="" id=""> <span class="ht_prce">Villa</span></span>
                                        </div>
                                    </div>
                                </article>




                                <!-- panel// -->
                                <article class="panel panel-default">
                                    <header class="panel-heading">
                                        <h4 class="panel-title">Distance from City Center</h4>
                                    </header> <!-- panel-heading// -->
                                    <div class="panel-body">
                                        <br>

                                        <div class="pricerange">
                                            <div class="slider_range">
                                                <input type="range" min="1" value="" class="slider_input">
                                            </div>
                                            <div class="mnmx_prce">
                                                <span class="min">0.84 Km</span>
                                                <span class="max">29.92 Km</span>
                                            </div>
                                        </div>
                                    </div> <!-- panel-body // -->
                                </article> <!-- panel// -->



                            </div> <!-- filter-wrap// -->
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-9">
                    <!-- <div class="row res_d_none">
                        <div class="col-3">
                            <div>
                                <span class="flt_hd_font">HOTEL NAME</span>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="flt_hd_fx">

                                <span class="flt_hd_font">FEATURED</span>


                            </div>
                        </div>
                        <div class="col-1"></div>


                        <div class="col-3">
                            <div class="prce_fx">
                                <span class="flt_hd_font">PRICE</span>

                            </div>
                        </div>

                    </div> -->

                    <div id="avail_hotels">
                        

                    </div>

                </div>
            </div>
        </div>

    </section>

    <!-- search result end -->

</main>

<input type="hidden" id="setMinPrice" value="0">
<input type="hidden" id="setMaxPrice" value="41324">
<input type="hidden" id="setCurrency" value="INR">
<input type="hidden" id="sessionId" value="<?php echo $this->session->session_id; ?>">
<!-- for auto scroll -->
<input type="hidden" id="totalnohotels">
<input type="hidden" id="scrollajax" value="0">
<input type="hidden" id="siteUrl" value="<?php echo site_url(); ?>">

<input type="hidden" id="searcharray" value='<?php echo serialize($searcharray); ?>'>

<?php $this->load->view('home/footer'); ?>

<script type="text/javascript">
    var api_array = <?php echo json_encode($api_list); ?>
</script>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/hwebservices.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/webservices.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/jqueryui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/autocomplete/hotels_city_list.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/hotel/filter.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/hotel/sorting.js"></script>


<!-- <script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/webservices.js"></script> -->

<script type="text/javascript">
    $('.filter-button').on('click', function() {
        $('.filter-button, .searchFiltersSection').toggleClass('open');
    });
    $('#mod-search-close, #modify-search-btn').click(function() {
        $('.modify-search').slideToggle('fast');
    });

    $(window).on('load', function(e) {
        // $('#myModal').modal('show');
    });
</script>
<script>
    .tsc_pagination li
    $(".tsc_pagination li a").on('click', function(e) {
        $(".tsc_pagination li .current").removeClass('current');
        $(this).parent().addClass('current');
        e.preventDefault();
    });
</script>
