<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 $this->load->view('home/home_template/header'); 
// echo"<pre>";print_r($session_data['departDate']);exit;
$session_data = $searcharray;
$journeyDate = date('Y-M-d',strtotime(str_replace('/','-',$session_data['departDate'])));
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
if(empty($return_date)){
    $return_date = date("d/m/Y");
}else
{
    $return_date = $session_data['returnDate'];
}
// $journeyDate = $departDate = date('D, j M Y', strtotime(str_replace('/', '-', $return_date)));
$adults = $session_data['adult_count'];
$childs = $session_data['child_count'];
$infants = $session_data['infant_count'];
$cabinClass = $session_data['class'];
$returnDate = $return_date;
?>

<!DOCTYPE HTML>
<html lang="en" dir="ltr">
<body>
    <style>
.bg-custom {
	background: #d2d2d2 !important;
}
.d-none{
    display: none;
}


    <?php if($tripType=="round"){?>
.dummy {
  display: flex;
  gap: 10px;
}
.col-sm-12.col-lg-6.fd_rt_fx {
  width: 100%;
}
.selectedButton {
  padding: 0;
  margin-right: 10px;
}


/* roundtrip align */

.info-stops .code {
    display: none;
}
span.all_hr_fx i {
    font-size: 16px;
    margin-top: 8px;
}

.col-md-3 .col-sm-4.rd_price{
        margin-top: 20px;
}
aside.col-md-7.col-sm-6.res_width {
        margin-left: -26px;
    margin-top: 20px;
}

/* trip description */
.info-airline img{
    width:30px;
    height:30px;
}
    
div.roundtrip-result {
    display: flex;
    gap: 10px;
}
.item-flight_r{
margin-bottom: 15px;
    border-radius: 7px;}
.gp_lt {
    padding: 0px;
    width: 50%;
    margin-right: 0px;
    margin-left: 0px;
    cursor: pointer;
}
.gp_rt {
    width: 50%;
    cursor: pointer;
}
section.flight-elem-parent.searchflight_box1 {
    margin-bottom: 25px;
    background: white;
   border: 1px solid lightgray;
      border-radius: 10px;
       transition:0.5s ease-in-out;
}

section.flight-elem-parent.searchflight_box1:hover {
    transform:translate(0,-6px);
transition:0.5s ease-in-out;
    border: 1px solid rgba(0, 0, 0, .2);
    box-shadow: 0 0 8px 0 rgb(0 0 0 / 20%);
    z-index: 1;
}
.city_fx {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
}
.info-airline {
    padding: 43px 7px;
    text-align: center;
    color: #8B8B8B;
    font-size: 12px;
}
.info-duration {
    margin: 30px 0px 15px;
    position: relative;
    padding-left: 0px;
}

/* fixed book */
.row.dis_fd_bk {
    position: fixed;
    bottom: 0;
    z-index: 999;
    width: 90%;
    padding: 11px 0;
    background: #fff;
    box-shadow: 0 -2px 5px #484848;
}
.col-lg-6.fd_lt_fx,.col-lg-6.fd_rt_fx {
    display: flex;
    justify-content: space-between;
    border-right: 1px solid lightgrey;
}
.fd_img_fx {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}
.fd_img_fx p {
    color: grey;
    font-size: 18px;
}span.timer_fx {
    display: flex;
    gap: 5px;
    align-items: center;
}
span.timer_fx p {
    margin-top: 10px;
}
p.grey_clr {
    color: lightgray;
    font-size: 16px;
}
a.btn.btn_color {
    background: #26AE7A;
    color: white;
    padding: 11px;
        height: 40px;
    margin-top: 15px;
}
span.fd_price {
    font-size: 28px;
}
span.fd_clr {
    color: #25C2DA;
    font-size: 20px;
}   


span.all_hr_fx {
    display: flex;
    align-items: center;
    width: 150px;
    margin-top: 11px;
}
span.ruppe {
    font-size: 26px;
}
.info-icons {
    margin: 7px 7px 7px 28px;
}
.info-stops .city{
    max-width: 100% !important;
}
.FlightInfoBox {
  flex-direction: row;
  display: flex;
  justify-content: space-between;
  gap: 20px;
  align-items: center;
}

 @media only screen and (max-width: 1024px) {
.info-stops .txt-stops {
    padding-top: 7px;
    display: inline-block;
    cursor: pointer;
    font-size: 11px;
}
span.ruppe {
    font-size: 18px;
}
.info-icons {
    margin: 7px 7px 7px 7px;
}
.city_fx {
    
    font-size: 12px;
}
.row.dis_fd_bk{
    display: flex;
    width: 95%;
}

span.fd_clr {
    font-size: 16px;
}
.priceInfoOnward.fd_lt_fx {
    width: 50% !important;
}
.dummy {
    width: 100%;
    display: flex;
    gap: 19px;
}
    
}

 @media only screen and (max-width: 768px) {
    span.fd_price {
    font-size: 20px;
}
.row.dis_fd_bk {
    display: flex;
    width: 100%;
}
a.btn.btn_color {

    padding: 0px;
    height: 40px;
    margin-top: 15px;
    width: 100%;
}
span.timer_fx {
    
    font-size: 11px;
}
.row.dis_fd_bk {
    display: flex;
    width: 98%;
    flex-direction: column;
}


 }
 @media only screen and (max-width: 425px) {
.res_d_none{
    display: none !important;
}
div.roundtrip-result {
    display: flex;
    gap: 0px;
    align-items: baseline;
    padding: 0;
    margin-left: -30px;
    margin-right: -3px;
}
    .gp_lt{
        width: 100%;
        padding-top: 11px;
    }
    .gp_rt{   
   width: 100%;
    margin-left: 4px;
    margin-top: 12px;
    padding-top: 11px;
}

.dummy {
    display: flex;
    gap: 10px;
    flex-direction: column;
    align-items: center;
}

.selectedButton {
    padding: 0;
    margin-right: 10px;
    width: 200px;
}


    .info-airline {
    padding: 0;
    text-align: center;
    color: #8B8B8B;
    font-size: 12px;
}
.info-duration {
    /* margin: 10px 1px 10px 98px;    */
     position: relative;
    /* padding-left: 28px; */
    margin: 0;
    padding: 0;
}
.col-lg-6.fd_lt_fx, .col-lg-6.fd_rt_fx {
    width: 100%;
    border-bottom: 1px solid lightgrey;
    margin-bottom: -8px;
}
.row.dis_fd_bk {
    display: flex;
    width: 100%;
    flex-direction: column;
    gap:8px;
}
aside.col-md-7.col-sm-6 {
    width: 100%;
}

.row.row-trip.no-gutter.res_dis_col_6_fx {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2px;
    flex-direction: column;
    padding: 3px 0px;
}

.text-dots {
    display: inline-block;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    width: 101.5%;
    line-height: inherit;
}
.info-stops .city{
    max-width: 100% !important;
}
span.all_hr_fx {
    display: flex;
    align-items: center;
    margin-left: -10px;
}
.fd_img_fx p {
    color: grey;
    font-size: 10px !important;
}
.col-lg-6.fd_lt_fx, .col-lg-6.fd_rt_fx {
    border: none;
}
.dummy {
    width: 85%;
}

 }
 @media only screen and (max-width: 375px){
span.all_hr_fx {
    display: flex;
    align-items: center;
    margin-left: -17px;
}
}
  @media only screen and (max-width: 320px) {
    .city_fx {
    font-size: 10px;
}
/* span.all_hr_fx i{
    display: none;
} */
span.fd_price {
    font-size: 16px;
}
a.btn.btn_color {
   
    padding: 2px;
    height: 27px;
    
    width: 13%;
}
span.fd_clr {
    font-size: 12px;
}
.gp_rt {
    width: 100%;
    margin-left: 10px;
    margin-top: 12px;
    padding-top: 11px;
}

  }
    <?php } ?>

.depature-list{
    display:flex;
    border:1px solid #e6e6e6;
    border-radius:10px;}

.depature-list li{
    list-style:none;
    border-right:1px solid #e6e6e6;
    padding:6px 0;
    width:25%;
    text-align:center;
    display:inline-block;}

.depature-list li.active{
    background:#2196f3;}

.depature-list li.active a{
    color:#fff;}

.depature-list li.active label{
    color:#fff;}

.depature-list li:last-of-type{
    border:none;
    border-radius:0 5px 5px 0;}

.depature-list li:first-child{
    border-radius:5px 0 0 5px;}

.depature-list li a{
    font-size:10px;
    color: #a6a5a5;}

.depature-list li label{
    font-size:10px;
    color: #a6a5a5;}

.depature-list li a .fa{
    font-size:20px;
    margin:0 0 8px 0;}

.depature-list li label .fa{
    font-size:20px;
    margin:0 0 8px 0;}

.depature-list li span{
    display:block;}
    
@media only screen and (max-width: 768px) {
 table {
   width: 30em;
    white-space: nowrap;
    display: flex;
     overflow-x: hidden;
}
}

.badge-lists {
  text-align: center;
  background: #efefef;
  border-radius: 10px;
  width: 61px;
  font-size: 13px;
  line-height: 20px;
  color: #0e0e0e;
  right: 0px;
  top: 0;
  position: absolute;
}

</style>      
<!-- ========================= SECTION PAGETOP  ========================= -->
<section class="section-pagetop">
    <div class="container">
    <div class="row no-gutter">
                            <div class="col-sm-3 col-xs-12">
                    <div class="item-info-destination no-gutter">
                        <p class="col-xs-5"> 
                            <span class="title">From</span>
                            <span class="val"><?php echo $session_data['fromCity']; ?></span>
                        </p>
                        <p class="col-xs-2">
                            <img class="img-icon" src="<?php echo base_url('assets/icons/flights_icon/icon-plane1.png'); ?>">
                                                    </p>
                        <p class="col-xs-5">
                            <span class="title">Destination</span>
                            <span class="val"><?php echo $session_data['toCity']; ?></span>
                        </p>
                    </div> <!-- destination// -->
                </div> <!-- col // --> 
                <div class="col-sm-2 col-xs-6">
                    <p class="item-info">
                        <img class="img-icon" src="<?php echo base_url('assets/icons/flights_icon/depart.png') ;?>">
                        <span class="title">Departure</span>
                        <?php $departure = explode("-",$journeyDate); $depart_year = $departure[0]; $depart_month = $departure[1]; $depart_day = $departure[2];?>
                        <span class="val"><?php echo $depart_day."<sup>th</sup> ".$depart_month." ".$depart_year;?> </span>
                    </p> 
                </div> <!-- col // --> 
                                    <div class="col-sm-2 col-xs-6">
                <p class="item-info">
                    <i class="material-icons">airline_seat_recline_extra</i>
                    <span class="title">Class</span>
                    <span class="val"><?php if($cabinClass==1){echo "Economy";} ?></span>
                </p>
            </div> <!-- col // --> 
            <div class="col-sm-3 col-xs-12">
                <p class="item-info">
                    <i class="material-icons">&#xE7FD;</i>
                    <span class="title">Passenger(s)</span>
                    <span class="val"><?php echo $adults." Adult, ".$childs." Child, ".$infants." Infant";  ?></span>
                </p>
            </div> <!-- col // --> 
            <div class="col-sm-1 col-sm-offset-1 col-xs-12">
                <a href="#" data-toggle="collapse" class="btn btn-block btn-warning btn-modify"> <span class="visible-sm"><i class="fa fa-edit"></i></span><span class="hidden-sm">Modify</span> </a>
            </div> <!-- col // --> 
        </div> <!-- row// -->
    </div> <!-- container // -->
</section> 
<!-- ========================= SECTION PAGETOP END // ========================= -->
<section class="section-modify" style="display: none;">
    <div class="container">
        <div class="inner-block">
            <!-- -------- modify block -------- -->
            <div class="form-block">
    <div class="trip-type">
        <label class="btn-one-way active"> <input type="radio" checked="checked" value="oneway" name="trip_type_chk"> <span>One Way</span> </label>
        <label class="btn-round-trip"> <input type="radio" value="round" name="trip_type_chk"> <span>Round-Trip</span> </label>
        <label class="btn-multy-city"> <input type="radio" value="multicity" name="trip_type_chk"> <span>Multi-City</span> </label>
    </div> <!--  trip-type //  -->
    <section class="flight-tab-switcher" id="one-round-block">
        <form class="flight-search-form" autocomplete="off" method="post" name="flight" id="flight" action="<?php echo base_url(); ?>flights/results">  
            <div class="row-sm">
                                <div class="col-lg-10 col-md-10">                    
                    <div class="row-sm">
                        <div class="col-lg-6 col-md-5">
                            <div class="form-group-wrap">
                                <div class="input-wrap form-group">
                                    <i class="material-icons">&#xE905;</i>
                                    <input type="text" name="fromCity" value="<?php echo $session_data['fromCity']; ?>" id="fromCity" placeholder="Flying from" class="autocomplete-airports" tabindex="1" required>
                                    <!--                            <label class="nearby-check-wrap checkbox">
                                                                    <input type="checkbox" name=""><ins></ins>
                                                                    <span>Nearby Airports</span>
                                                                </label>                                -->
                                </div>
                                <div class="input-wrap form-group">
                                    <i class="material-icons">&#xE904;</i>
                                    <input type="text" name="toCity" value="<?php echo $session_data['toCity']; ?>" id="toCity" tabindex="2" placeholder="Flying to" class="autocomplete-airports" required>  
                                    <!--                            <label class="nearby-check-wrap checkbox">
                                                                    <input type="checkbox" name=""><ins></ins>
                                                                    <span>Nearby Airports</span>
                                                                </label>                              -->
                                </div>	
                                <a href="javascript:void(0);" class="btn-way-switch" onclick="changeDepartArrival();"> <i class="material-icons">&#xE8D5;</i> </a>
                            </div> <!--  form-group-wrap //  -->
                        </div><!--  col//  -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="form-group-wrap">
                        <div class="date-wrap date-from form-group">
                            <img class="img-icon" src="<?php echo base_url(); ?>assets/images/icons/calendar-go.png">
                            <input type="text" name="departDate" id="datepicker" value="" class="from-date" readonly="true" autocomplete="off" required tabindex="3"> 
                            <p class="datetime">
                                <span class="month"><?php echo $depart_month; ?></span>
                                <span class="day"><?php echo $depart_day; ?></span>
                                <span class="dayname"><?php echo $dayname = date('D', strtotime($depart_day.'-'.$depart_month.'-'.$depart_year)); ?></span>
                                <span class="year"><?php echo $depart_year; ?></span>
                            </p>                    
                        </div> <!-- date-wrap// -->
                        <div class="date-wrap date-return-empty" style="">     
                            <p class="add-return">
                                <span><i><img src="<?php echo base_url(); ?>assets/images/icons/calendar-return.png"></i></span>
                                <span class="btn-return">ADD RETURN</span>
                            </p>                
                        </div> <!-- date-wrap// -->
                        <div class="date-wrap date-return-active form-group" style="">    
                            <img class="img-icon" src="<?php echo base_url(); ?>assets/images/icons/calendar-back.png">
                            <input type="text" id="datepicker" name="returnDate"  value="" class="to-date" readonly="true" autocomplete="off" required tabindex="4"> 
                            <p class="datetime">
                                <span class="month"></span>
                                <span class="day"></span>
                                <span class="dayname"></span>
                                <span class="year"></span>
                            </p>  
                            <span class="btn-remove-return"><i class="fa fa-minus"></i></span>
                        </div> <!-- date-wrap// -->
                    </div> <!--  form-group-wrap //  -->
                </div><!--  col//  -->
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group-wrap">
                                <div class="select-wrap">
                                    <i class="material-icons">&#xE636;</i>                                    
                                    <i class="arrow material-icons">&#xE5C5;</i>
                                    <select class="form-control selectpicker" name="class" data-style="btn-select" tabindex="5" required>
                                        <option value="Economy" selected='selected'> Economy</option>
                                        <option value="PremiumEconomy" > Premium economy</option>
                                        <option value="Business" > Business</option>
                                        <option value="First" > First</option>
                                    </select>
                                </div>
                                <div class="select-wrap">
                                    <a href="#" class="passenger-change">
                                        <i class="material-icons">&#xE7FD;</i>
                                        <i class="arrow material-icons">&#xE5C5;</i>
                                        <p class="myval"><span class="passenger-count">1</span> Passenger(s)</p>  
                                    </a>
                                    <div class="passenger-dropdown" role="menu">
                                        <div class="row no-gutter">
                                            <p class="col-xs-7">Adults (12+) </p>
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-sm pull-right">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default number-spinner-flight" data-field="adult_count" data-type="minus"> <span class="fa fa-minus"></span></button>
                                                    </span>
                                                    <input type="text" class="form-control text-center spinner-value-flight" name="adult_count" id="adult_count" value="1" max="9" min="1" readonly="readonly">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default number-spinner-flight" data-field="adult_count" data-type="plus"><span class="fa fa-plus"></span></button>
                                                    </span>
                                                </div> <!--  input-group number-spinner //  -->
                                            </div> <!-- col// -->
                                        </div> <!-- row// -->

                                        <div class="row no-gutter">
                                            <p class="col-xs-7"> Children (2-12) </p>
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-sm pull-right">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default number-spinner-flight" data-field="child_count" data-type="minus"> <span class="fa fa-minus"></span></button>
                                                    </span>
                                                    <input type="text" class="form-control text-center spinner-value-flight" name="child_count" id="child_count" value="0" max="8" min="0" readonly="readonly">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default number-spinner-flight" data-field="child_count" data-type="plus"><span class="fa fa-plus"></span></button>
                                                    </span>
                                                </div> <!--  input-group number-spinner //  -->
                                            </div> <!-- col// -->
                                        </div> <!-- row// -->

                                        <div class="row no-gutter">
                                            <p class="col-xs-7"> Infant (0-2) </p>
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-sm pull-right">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default number-spinner-flight" data-field="infant_count" data-type="minus"> <span class="fa fa-minus"></span></button>
                                                    </span>
                                                    <input type="text" class="form-control text-center spinner-value-flight" name="infant_count" id="infant_count" value="0" max="4" min="0" readonly="readonly">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default number-spinner-flight" data-field="infant_count" data-type="plus"><span class="fa fa-plus"></span></button>
                                                    </span>
                                                </div> <!--  input-group number-spinner //  -->
                                            </div> <!-- col// -->
                                        </div> <!-- row// -->                                
                                        <a href="javascript:;" class="btn btn-warning btn-block btn-ok text-uppercase"> ok </a>
                                    </div>   <!-- passenger-dropdown //  -->                       
                                </div>
                            </div>
                        </div><!--  col//  -->
                    </div> <!-- row.// -->
                </div> <!-- col.// -->

                
                <div class="col-md-2 hidden-sm hidden-xs">
                    <input type="hidden" class="trip-type-hidden" name="trip_type" value="oneway">
                    <button type="submit" class="btn btn-search" tabindex="9"><i class="fa fa-search"></i>&nbsp;Modify search</button>
                </div><!--  col//  -->
            </div> <!-- row// -->
            <div class="row-sm mt15">
                <div class="col-md-5 col-sm-6">
                    <div class="form-single-wrap">
                        <div class="input-wrap">
                            <i class="material-icons">&#xE195;</i>
                            <input type="text" class="autocomplete-provider" name="provider" id="autocomplete3" tabindex="6" value="" placeholder="Preferred airline: All">                              
                        </div>	
                    </div> <!--  form-single-wrap //  -->
                </div> <!--  col//  -->
                <div class="col-md-5 col-sm-6">
                    <p class="advanced-check">
                        <label class="checkbox checkbox-inline"><input type="checkbox" name="direct"  tabindex="7" value="1"><ins></ins> Direct flights only</label>
                        <!-- <label class="checkbox checkbox-inline"><input type="checkbox"  name="days" tabindex="8" value="1"><ins></ins> +/- 3 Days</label> -->
                    </p>
                </div>

            </div>
            <div class="visible-sm visible-xs">
                <button type="submit" class="btn btn-search" tabindex="9"><i class="fa fa-search"></i>&nbsp;Modify search</button>
            </div><!--  col//  -->

        </form>
    </section>
    <!--  flight-tab-switcher //  -->
    <section class="flight-tab-switcher hide" id="multi-block">
        <form class="flight-search-form" name="flight" id="flight" action="<?php echo base_url('flight/search');?>">   
            <div class="row-sm">
                <div class="col-md-5 col-sm-8">
                    <div class="form-group-wrap">
                        <div class="input-wrap form-group">
                            <i class="material-icons">flight_takeoff</i>
                            <input type="text" name="mfrom[]" value="" id="autocomplete1" class="autocomplete-airports from1" placeholder="Flying from" required>
                            <!--                            <label class="nearby-check-wrap checkbox">
                                                            <input type="checkbox" name=""><ins></ins>
                                                            <span>Nearby Airports</span>
                                                        </label>                                -->
                        </div>
                        <div class="input-wrap form-group">
                            <i class="material-icons">flight_land</i>
                            <input type="text" name="mto[]" value="" id="autocomplete2" class="autocomplete-airports to1" placeholder="Flying to" required>  
                            <!--                            <label class="nearby-check-wrap checkbox">
                                                            <input type="checkbox" name=""><ins></ins>
                                                            <span>Nearby Airports</span>
                                                        </label>                              -->
                        </div>	
                        <!--<a href="" class="btn-way-switch"> <i class="material-icons">swap_vert</i> </a>-->
                    </div> <!--  form-group-wrap //  -->
                </div><!--  col//  -->
                <div class="col-md-2 col-sm-3">
                    <div class="form-group-wrap form-group">
                        <div class="date-multi">
                            <img class="img-icon" src="<?php echo base_url('assets/icons/flights_icon/calendar-go.png');?>">
                            <input type="text" name="mdepature[]" class="from-date mdepature1" value="" readonly="true" autocomplete="off" required> 
                            <p class="datetime">
                                <span class="month"></span>
                                <span class="day"></span>
                                <span class="dayname"></span>
                                <span class="year"></span>
                            </p>                      
                        </div> <!-- date-wrap// -->
                    </div> <!--  form-group-wrap //  -->
                </div><!--  col//  -->
                <div class="col-md-3 col-sm-11">
                    <div class="form-group-wrap form-group">
                        <div class="select-wrap">
                            <i class="material-icons">airline_seat_recline_extra</i>
                            <i class="arrow material-icons">arrow_drop_down</i>
                            <select class="form-control selectpicker" name='class' data-style="btn-select" required>                            
                                <option value="Economy"> Economy</option>
                                <option value="PremiumEconomy"> Premium economy</option>
                                <option value="Business"> Business</option>
                                <option value="First"> First</option>
                            </select>
                        </div>
                        <div class="select-wrap">
                            <a href="#" class="passenger-change">
                                <i class="material-icons">&#xE7FD;</i>
                                <i class="arrow material-icons">arrow_drop_down</i> 
                                <p class="myval"><span class="passenger-count">1</span> Passenger(s)</p>   
                            </a>
                            <div class="passenger-dropdown" role="menu">
                                <div class="row no-gutter">
                                    <p class="col-xs-7"> Adults (12+) </p>
                                    <div class="col-xs-5">
                                        <div class="input-group input-group-sm pull-right">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default number-spinner-flight" data-field="adult_count" data-type="minus"> <span class="fa fa-minus"></span></button>
                                            </span>
                                            <input type="text" class="form-control text-center spinner-value-flight" name="adult_count" id="adult_count" value="1" max="9" min="1" readonly="readonly">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default number-spinner-flight" data-field="adult_count" data-type="plus"><span class="fa fa-plus"></span></button>
                                            </span>
                                        </div> <!--  input-group number-spinner //  -->
                                    </div> <!-- col// -->
                                </div> <!-- row// -->

                                <div class="row no-gutter">
                                    <p class="col-xs-7"> Children (2-12) </p>
                                    <div class="col-xs-5">
                                        <div class="input-group input-group-sm pull-right">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default number-spinner-flight" data-field="child_count" data-type="minus"> <span class="fa fa-minus"></span></button>
                                            </span>
                                            <input type="text" class="form-control text-center spinner-value-flight" name="child_count" id="child_count" value="0" max="8" min="0" readonly="readonly">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default number-spinner-flight" data-field="child_count" data-type="plus"><span class="fa fa-plus"></span></button>
                                            </span>
                                        </div> <!--  input-group number-spinner //  -->
                                    </div> <!-- col// -->
                                </div> <!-- row// -->

                                <div class="row no-gutter">
                                    <p class="col-xs-7"> Infant (0-2) </p>
                                    <div class="col-xs-5">
                                        <div class="input-group input-group-sm pull-right">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default number-spinner-flight" data-field="infant_count" data-type="minus"> <span class="fa fa-minus"></span></button>
                                            </span>
                                            <input type="text" class="form-control text-center spinner-value-flight" name="infant_count" id="infant_count" value="0" max="4" min="0" readonly="readonly">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default number-spinner-flight" data-field="infant_count" data-type="plus"><span class="fa fa-plus"></span></button>
                                            </span>
                                        </div> <!--  input-group number-spinner //  -->
                                    </div> <!-- col// -->
                                </div> <!-- row// -->

                                <a href="javascript:;" class="btn btn-warning btn-block btn-ok text-uppercase"> ok </a>
                            </div>   <!-- passenger-dropdown //  -->                    
                        </div>
                    </div>
                </div><!--  col//  -->
                <div class="col-md-2 hidden-sm hidden-xs">
                    <input type="hidden" class="trip-type-hidden" name="trip_type" value="oneway">
                    <button type="submit" class="btn btn-search"><i class="fa fa-search"></i>&nbsp;Modify search</button>
                </div><!--  col//  -->
            </div> <!-- row// -->
            <div id="flight-repeat-block">
                <div class="row-sm">
                    <div class="col-sm-8 col-md-5">
                        <div class="form-group-wrap">
                            <div class="input-wrap form-group">
                                <i class="material-icons">flight_takeoff</i>
                                <input type="text" name="mfrom[]" value="" id="autocomplete1" class="autocomplete-airports from2" placeholder="Flying from" required>
                                <!--                                <label class="nearby-check-wrap checkbox">
                                                                    <input type="checkbox" name=""><ins></ins>
                                                                    <span>Nearby Airports</span>
                                                                </label>                                -->
                            </div>
                            <div class="input-wrap form-group">
                                <i class="material-icons">flight_land</i>
                                <input type="text" name="mto[]" value="" id="autocomplete2" class="autocomplete-airports to2" placeholder="Flying to" required>  
                                <!--                                <label class="nearby-check-wrap checkbox">
                                                                    <input type="checkbox" name=""><ins></ins>
                                                                    <span>Nearby Airports</span>
                                                                </label>                              -->
                            </div>	
                            <!--<a href="" class="btn-way-switch"> <i class="material-icons">swap_vert</i> </a>-->
                        </div> <!--  form-group-wrap //  -->
                    </div><!--  col//  -->
                    <div class="col-sm-3 col-md-2">
                        <div class="form-group-wrap form-group">
                            <div class="date-multi">
                                <img class="img-icon" src="<?php echo base_url('assets/icons/flights_icon/calendar-go.png');?>">
                                <input type="text" name="mdepature[]"  class="from-date mdepature2" value="" readonly="true" autocomplete="off" required> 
                                <p class="datetime">
                                    <span class="month"></span>
                                    <span class="day"></span>
                                    <span class="dayname"></span>
                                    <span class="year"></span>
                                </p>                   
                            </div> <!-- date-wrap// -->
                        </div> <!--  form-group-wrap //  -->
                    </div><!--  col//  -->
                </div> <!-- row// -->  
            </div>
            <div class="row-sm">
                <div class="col-md-7"><a href="javascript:;" class="btn-add-trip pull-right" id="add-flight">  Add flight <i class="fa fa-plus-circle"></i></a></div>
            </div>
            <div class="visible-sm visible-xs">
                <button type="submit" class="btn btn-search"><i class="fa fa-search"></i>&nbsp;Modify search</button>
            </div><!--  col//  -->
        </form>
    </section> <!--  flight-tab-switcher //  -->       
</div>

<script id="flight-block-tmpl" type="text/x-handlebars-template">
<div class="row-sm flight-block" style="display:none">
    <div class="col-md-5 col-sm-8">
        <div class="form-group-wrap">
            <div class="input-wrap form-group">
                <i class="material-icons">flight_takeoff</i>
                <input type="text" name="mfrom[]" value="" id="autocomplete1" class="autocomplete-airports from3 clearable" placeholder="Flying from" required>
            </div>
            <div class="input-wrap form-group">
                <i class="material-icons">flight_land</i>
                <input type="text" name="mto[]" value="" id="autocomplete2" class="autocomplete-airports to3 clearable" placeholder="Flying to" required>                                             
            </div>	
        </div> <!--  form-group-wrap //  -->
    </div><!--  col//  -->
    <div class="col-md-2 col-sm-3">
        <div class="form-group-wrap form-group">
            <div class="date-multi">
                <img class="img-icon" src="<?php echo base_url('assets/icons/flights_icon/calendar-go.png');?>">
                <input type="text" name="mdepature[]"  class="from-date mdepature3" required> 
                <p class="datetime">
                    <span class="month"></span>
                    <span class="day"></span>
                    <span class="dayname"></span>
                    <span class="year"></span>
                </p>                    
            </div> <!-- date-wrap// -->
        </div> <!--  form-group-wrap //  -->
    </div><!--  col//  -->
    <div class="col-md-2 col-sm-1">            
        <a href="javascript:;" class="btn-close-trip" onclick="remove_flight(this)">&times</a> 
    </div><!--  col//  -->
</div> <!-- row// -->  
</script>
<script type="text/javascript">
    function changeDepartArrival() {
        var to = $("[name=toCity]").val();
        var from = $("[name=fromCity]").val();
        $("[name=toCity]").val(from);
        $("[name=fromCity]").val(to);
    }

    var form_valdator_el;
    $(document).ready(function () {
        //One way form validator
        $("#one-round-block .flight-search-form").validator({
            disable: false,
            focus: false
        }).on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...            
                return false;
            } else {
                // everything looks good!                
                if ($(this).find("input[name='fromCity']").val() == $(this).find("input[name='toCity']").val()) {
                    show_footer_error("It looks like you're trying to travel to and from the same place! Please review and re-enter your origin and destination cities");
                    return false;
                }
                return true;
            }
        });
        //MultiCity form Validator
        form_valdator_el = $("#multi-block .flight-search-form");
        form_valdator_el.validator({
            disable: false,
            focus: false
        }).on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...            
                return false;
            } else {
                // everything looks good!
                return check_dates_sequence();
            }
        });

        function check_dates_sequence() {
            var last_val = false;
            var valid = true;
            $("#multi-block input[name='mdepature[]']").each(function (i, val) {
                var fromData = $.datepicker.parseDate('dd-mm-yy', this.value);
                if (i !== 0) {
                    if (fromData.getTime() < last_val.getTime()) {
                        valid = false;
                        show_footer_error("The departing dates must occur after the previous departing date");
                        return false;
                    }
                }
                if ($("#multi-block input[name='mfrom[]']").eq(i).val() == $("#multi-block input[name='mto[]']").eq(i).val()) {
                    valid = false;
                    show_footer_error("It looks like you're trying to travel to and from the same place! Please review and re-enter your origin and destination cities");
                    return false;
                }
                last_val = fromData;
            });
            return valid;
        }

        $("#add-flight").on("click", function () {
            var count = $('#flight-repeat-block').children().length;
            if (count > 0 && count < 3) {
                var source = $.parseHTML($("#flight-block-tmpl").html());
                $(source).appendTo('#flight-repeat-block').show('slow');
                //Intializing datepickers
                var fromFlightSelector = $("#multi-block .from-date");
                initialize_fancydatepicker_multi(fromFlightSelector);
                count++;
            }

            if (count >= 3) {
                $(this).hide();
            }
            //Added new input fields, update validator
            form_valdator_el.validator('update');
        });

    });

    function remove_flight(that) {
        $(that).closest('.flight-block').hide('slow', function () {
            $(this).remove();
            //Removed input fields, update validator
            form_valdator_el.validator('update');
        });
        var count = $('#flight-repeat-block').children().length;
        if (count <= 5) {
            $('#add-flight').show();
        }
    }
</script>


<script type="text/javascript">
    $(window).load(function () {
            $(".section-modify .btn-one-way").click();

    });
</script>             <!-- -----------------  FLIGHT FORM END// -------------------- -->
        </div> <!-- inner-block// -->
    </div> <!-- container // -->
</section>
<!-- ========================= SECTION MODIFY END // ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content">
    <div class="container">
        <div class="row-sm" id="flight-content">

           <!--Side panel-->
           <aside class="col-md-3 col-sm-12">
                <a href="javascript:;" class="btn-price-alert">
                    <i class="fa fa-bullhorn pull-right" aria-hidden="true"></i>
                    Get price alerts                </a>


                <a href="#" class="btn-filter blok-header visible-sm visible-xs"> <i class="fa fa-filter pull-right"></i> Filter</a>


                <!-- blok-header// -->
                <div class="filter-wrap" id="filter-area">
                    <a href="javascript:;" class="btn-filter-close rotate-left btn btn-danger visible-sm visible-xs" style="position: fixed; right:-30px; top:50%"> × Close  filter</a>
                    <div id="filters-block">
<!--<a href="#" class="btn-filter-close rotate-left btn btn-danger visible-xs" style="position: fixed; right:-30px; top:50%"> &times Close  filter</a>-->

<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title">Price range</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body">
        <br>
        <div id="price-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span></div>
        <div class="slider-numbers-wrap">          
            
            <div id="setMinPrice2" class="pull-left"> </div>  
            <div id="setMaxPrice2" class="pull-right"> </div>            
        </div>
        <input type="hidden" name="minPrice" id="minPrice" class="autoSubmit">
        <input type="hidden" name="maxPrice" id="maxPrice" class="autoSubmit">
    </div> <!-- panel-body // -->
</article> <!-- panel// -->

<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title"> Stops</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body">        
        <div class="btn-group stop-end d-flex" >
            <div class="form-group">
            <label class="btn btn-default">
                <input type="checkbox" class="Stop" value="0" checked="checked"> Direct
            </label>
</div>

        <div class="form-group">
            <label class="btn btn-default">
                <input type="checkbox" class="Stop" value="1" checked="checked"> 1  Stop
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
                <input class="faretype" type="checkbox" value="0" checked="checked"> Non Refundable
            </label>
            <label class="btn btn-default">
                <input class="faretype" type="checkbox" value="1" checked="checked"> Refundable
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
                <label><input class="DepartTime" type="checkbox" value="0-6" checked="checked" />
                <i class="fa fa-sunset"></i><span>Before<br> 6 AM</span></label></li>
            <li><label><input class="DepartTime" type="checkbox" value="6-12" checked="checked" />
            <i class="fa fa-sun-cloud"></i><span>6 AM - <br> 12 PM</span></label></li>
            <li><label><input class="DepartTime" type="checkbox" value="12-18" checked="checked" />
            <i class="fa fa-sun-haze"></i><span>12 PM -<br> 6 PM</span></label></li>
            <li><label><input class="DepartTime" type="checkbox" value="18-0" checked="checked" />
            <i class="fa fa-moon"></i><span>After<br> 6 PM</span></label></li>

        </ul>
    </div> <!-- panel-body// -->
</article>

<article class="panel panel-default">
    <header class="panel-heading">
        <h4 class="panel-title">Arrival Time</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body">
    <ul class="depature-list">
            <!-- <li class="active"><a ><i class="fa fa-sunset"></i><span>Before<br> 6 AM</span></a></li>
            <li><a ><i class="fa fa-sun-cloud"></i><span>6 AM - <br> 12 PM</span></a></li>
            <li><a ><i class="fa fa-sun-haze"></i><span>12 PM -<br> 6 PM</span></a></li>
            <li><a ><i class="fa fa-moon"></i><span>After<br> 6 PM</span></a></li> -->
            <li class="active">
                <label><input class="ArrivTime" type="checkbox" value="0-6" checked="checked" />
                <i class="fa fa-sunset"></i><span>Before<br> 6 AM</span></label></li>
            <li><label><input class="ArrivTime" type="checkbox" value="6-12" checked="checked" />
            <i class="fa fa-sun-cloud"></i><span>6 AM - <br> 12 PM</span></label></li>
            <li><label><input class="ArrivTime" type="checkbox" value="12-18" checked="checked" />
            <i class="fa fa-sun-haze"></i><span>12 PM -<br> 6 PM</span></label></li>
            <li><label><input class="ArrivTime" type="checkbox" value="18-0" checked="checked" />
            <i class="fa fa-moon"></i><span>After<br> 6 PM</span></label></li>

        </ul>
    </div>
</article>

<!-- <article class="panel panel-default">
    <header class="panel-heading">  -->
        <!-- <h4 class="panel-title">Layover</h4> -->
    <!-- </header>  -->
    <!-- panel-heading// -->
       <!-- <div class="panel-body"> -->
    <!--        <div class="btn-group" data-toggle="buttons">-->
    <!--            <label class="btn btn-default"> -->
    <!--                <input type="radio" name="layover" id="option1" value="0-6" autocomplete="off" onchange="flightFilteration();"> 1h - 6h-->
    <!--            </label> -->
    <!--            <label class="btn btn-default">-->
    <!--                <input type="radio" name="layover" id="option2" value="7-12" autocomplete="off" onchange="flightFilteration();"> 7h - 12h-->
    <!--            </label> -->
    <!--            <label class="btn btn-default">-->
    <!--                <input type="radio" name="layover" id="option3" value="13-100" autocomplete="off" onchange="flightFilteration();"> 13+ h-->
    <!--            </label> -->
    <!--        </div> -->
    <!--    </div>-->
        <!-- panel-body//  -->
    <!-- <div class="panel-body">        
        <div id="layover-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span></div>
        <div class="slider-numbers-wrap">           
            <input type="hidden" id="min-layover" value="60">
            <input type="hidden" id="max-layover" value="1365">
            <div id="set-max-layover" class="pull-right">22h 45m</div>
            <div id="set-min-layover" class="pull-left">1h 0m</div>            
        </div> -->
    <!-- </div> -->
     <!-- panel-body// -->
<!-- </article> -->
 <!-- panel// -->

<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title">Flight duration</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body">
        <br>
        <div id="duration-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span></div>
        <div class="slider-numbers-wrap">           
            <input type="hidden" id="minDuration" class="autoSubmit">
            <input type="hidden" id="maxDuration" class="autoSubmit">
            <div id="setMaxDuration2" class="pull-right"></div>
            <div id="setMinDuration2" class="pull-left"></div>            
        </div>
    </div> <!-- panel-body// -->
</article> <!-- panel// -->



<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title">Airlines</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body filter-airlines-wrap">
    <label><a><input type="checkbox" name="" id="show_all" style="vertical-align: top; display:none;" checked>Show all</a></label>
        
        <div class="airlines">
       
        </div>
    </div>
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
            </aside>
           <!--side panel end-->
           <?php //$this->load->view('filter'); ?>
            <main class="col-md-9 col-sm-12">
                <header class="blok-header">
                    <div class="col-md-4">
                        <h4 class="title pull-left"><span id="flightCount">0</span> Flights</h4>
                                            </div>

                                            <div class="col-md-4" style="text-align:center;margin-top: -5px;">
                            <a href="" title="Previous Day" style="font-size: 15px;color:#fff;">&laquo; Previous</a>
                            <span class="dot" style="margin:5px 5px 0px 5px;"></span> 
                            <a href="" title="Next Day" style="font-size: 15px;color:#fff;">Next &raquo;</a>
                        </div>
                    
                    <div class="col-md-4 mob-display-none">
                       
                    </div>

                </header> <!-- blok-header// -->

              

                <!-- loading state start -->
                <article class="loading-content">
                    <br/><br/><br/>
                    <img src="<?php echo base_url('assets/icons/flights_icon/loading.gif');?>">
                    <h3 class="text1">Searching for your flight</h3>
                    <h5 class="text2">One moment, please ... <br/> Comparing great rates from over 1000 airlines in more than 195 countries ...</h5>
                </article>
                <!-- loading state end// -->
                
               <!--Search result Content-->
               <?php if($tripType=='oneway'){ ?>
               <div class="flights" id="flightsresults" >
              
                </div>
                <?php } ?>

                <?php if($tripType=='round'){  ?>
                <div class="row flights roundtrip-result">
                <style>
                .travel-stops
                .end{right:0;top:-6px;background-image:url("../assets/images/icons/plane-listing.png");background-size:cover;width:15px;height:14px}
                </style>
                <div class="col-6 gp_lt onward-trip" id="flightsresults">              
                </div>
                <div class="col-6 gp_rt return-trip" id="flightsresults1">  
                </div>
                </div>
                <?php }?>

               <!--Search result Content end-->
                
                
                <!-- ---------- email totication block ---------- -->
                <article class="panel panel-default panel-notify" id="block_email_notify" style="display: none">
                    <div class="panel-body envelope-style">
                        <a href="#" class="btn-close"> <i class="fa fa-close"></i> </a>
                        <div class="row">
                            <div class="col-sm-6">	
                                <h4 class="title">
                                    <i class="fa fa-envelope"></i> &nbsp We will alert you if fare is changed </h4>
                                <img src="<?php echo base_url('assets/icons/flights_icon/envelope-fly.jpg');?>" style="opacity:.3; max-height: 70px; margin:7px;">
                                <ul class="list-simple">
                                    <li>Track fare history on rising and dropping fares</li>
                                    <li>Know when to book and get recommendations for when to book depending on the price you want to pay</li>
                                    <li>Plan your holidays and know flight fares on public holidays in advance and save more</li>
                                    <li>Get notifications of fare changes right in your inbox</li>
                                </ul>
                            </div> <!-- col// -->
                            <div class="col-sm-6">
                                <form action="javascript:void(0);" id="frmalertmodal">
                                    <input type="hidden" name="alert_modify_search" value="">
                                    <input type="hidden" name="alert_price" id="price-min1" value="0">
                                    <p class="alert alert-info text-center b"> One Way</p>
                                    <table class="table-round">
                                        <tr>
                                            <td><strong>From</strong>: New Delhi (DEL)</td>
                                            <td><strong>To</strong>: Mumbai (BOM)</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><strong>Departure</strong>: 19-01-2022</td>
                                            
                                        </tr>
                                    </table>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"> <i class="fa fa-user"></i></span>
                                            <input type="text" name="alert_name" class="form-control" required="required" pattern="[a-zA-Z\s]+" placeholder="Your name">                                            
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <div class="input-group">
                                            <span class="input-group-addon"> <i class="fa fa-envelope"></i></span>
                                            <input class='form-control' size='4' type="email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="alert_email" placeholder="Your Email" required="required">
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <button type="submit" class="btn btn-block btn-warning">Submit</button>
                                    </div>
                                </form>	

                                <p class="alert alert-success hide" id="alert_msg"></p>
                            </div> <!-- col// -->
                        </div> <!-- row// -->

                    </div> <!-- panel-body .end// -->
                </article> <!-- panel// -->
                <!-- ---------- email totication block .end// ---------- -->
                <div class="clearfix"></div>
                <article class="alert alert-primary alert-dismiss hide" id="nearby_airportsBlock">
                    <button type="button" class="close">&times;</button>
                    <h4 class="h4">We found more airports near New Delhi (DEL)</h4>
                    <p>Please uncheck the airports that do not work for you</p>
                </article>
                <div class="clearfix"></div>

                <article class="noresult hide" id="noresult">
                    <p><span><i class="fa fa-frown-o" aria-hidden="true"></i></span>
                    <big>Unfortunately, we did not find any flights for your search.</big>
                    <p> Please select different dates or a new origin or destination and search again.</p>
                    <span><a href="/flights" class="btn btn-warning">Search Again</a></span>
                    </p>
                </article>

                <div class="clearfix"></div>



                <div class="loader3"></div>
                <!-- FLIGHT TICKET-->
                <!-- Normal trip-->
                <div id="flights" class="flights">                                
                    <!-- Flights Listing-->
                </div>                
                <!-- Normal trip End-->
                <div class="clearfix"></div>
            </main><!-- col // -->
        </div><!--  row// -->
    </div> <!-- container // -->
    <?php if($tripType=="round"){?>
        <div class="container selectedRoundFlights d-none">
        <!-- fixed book now start -->
        <form action="<?php echo site_url();?>flights/itinerary" method="POST">
			<input type="hidden" name="callBackId" value="<?php echo base64_encode('tbo'); ?>" />
<div class="row dis_fd_bk">
<div class="col-sm-12 col-lg-6 priceInfoOnward fd_lt_fx">
       
</div>
<div class="dummy">
<div class="col-sm-12 col-lg-6 priceInfoReturn fd_rt_fx">
    

</div>
<div class="selectedButton">    
    <h4> <i class="mdi mdi-currency-inr text-secondary"></i><span class="priceInfoTotal text-secondary"></span></h4>
    <span class="bookroundtrip"></span>
    <!-- <button class="btn btn_color">Book now</button> -->
</div>
</div>
</div>
    </form>
<!-- fixed book now end -->

    </div>
    <?php } ?>
    <br><br>
</section>
<!-- ========================= SECTION CONTENT END // ========================= -->
<!-- Modal price alert -->
<div class="modal fade" id="faremodel" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-confirming">
            <div class="modal-body p30">
                <div class="loader-wrap text-center">
                    <img src="<?php echo base_url('assets/icons/flights_icon/loading.gif');?>">
                    <h4 class="b">Confirming your fare</h4>
                    <span class="text-muted">One moment, please ...</span>
                </div> <!-- loader-wrap.// -->
                <br>
                <img src="<?php echo base_url('assets/icons/flights_icon/plane-fly.png');?>" class="flip-h plane plane-to-right">
                <br><br>
                <div class="row">
                    <div class="col-xs-4 text-left">
                        <h4 id="origin">DXB</h4>
                        <p class="text-muted">
                            <i class="material-icons txt-orange">&#xE0C8;</i> <br>
                            <strong id="onward_CityName">DUBAI</strong><br>
                            <span class="label-blue"><i class="fa fa-calendar"></i> <span id="DepartureTime">12 july, Wed</span></span> Depart                        </p>
                    </div>
                    <div class="col-xs-4"> 
                        <p class="text-center"><br><span class="txt-orange b"><i class="fa fa-plane"></i> <span id="trip_type_loader"></span></span></p>
                    </div>
                    <div class="col-xs-4 text-right">
                        <h4 id="destination">TAS</h4>
                        <p class="text-muted">
                            <i class="material-icons txt-orange">&#xE0C8;</i> <br>
                            <strong id="onward_toCityName">TASHKENT</strong><br>
                            <span class="label-blue"><i class="fa fa-calendar"></i> <span id="ArrivalTime">12 july, Wed</span></span> Arrive                        </p>
                    </div>
                </div>
            </div> <!-- modal-body// -->
        </div>  <!-- Modal content end//-->
    </div> <!-- Modal dialog end//-->
</div>
<!-- Modal price alert// -->

<script>
  

    
</script>
<script src="<?php echo base_url('assets/js/libs/handlebars-v4.0.11.js');?>" defer="defer"></script>
<!-- Template : Flight Listing -->
<script id="flight-list-block-tmpl" type="text/x-handlebars-template">


<script>

</script></script>
<script id="flight-filter-block-tmpl" type="text/x-handlebars-template">



<script type="text/javascript">
/// some script    

    $(function () {
        $("#price-min1").val('{{Price.MinPrice}}');
        var nearby_result = $('#nerby_result').text();
        if (nearby_result == 'Yes') {
            $("#nearby_airportsBlock").removeClass('hide');
        }
    });

// jquery ready start    
    function renderDuration(ctime) {
        var data = minutesToHours(ctime)
        return data[0] + "h " + data[1] + "m";
    }
    // Duration Slider Initialize
    var st_values = [parseInt($("#minDuration").val()), parseInt($("#maxDuration").val())];
    $("#setMinDuration").text(renderDuration(st_values[0]));
    $("#setMaxDuration").text(renderDuration(st_values[1]));
    $("#duration-range").slider({
        range: true,
        min: st_values[0],
        max: st_values[1],
        step: 1,
        values: st_values,
        slide: function (event, ui) {
            //Hidden Values            
            $("#minDuration").val(ui.values[0]);
            $("#maxDuration").val(ui.values[1]);
            // Visual Values            
            $("#setMinDuration").text(renderDuration(ui.values[0]));
            $("#setMaxDuration").text(renderDuration(ui.values[1]));
        },
        stop: flightFilteration
    });

    function renderTime(ctime) {
        var data = minutesToHours(ctime)
        var hours = (data[0] < 10 ? "0" + data[0] : data[0]);
        var minutes = (data[1] < 10 ? "0" + data[1] : data[1]);
        return hours + ":" + minutes;
    }
    // Arival Slider Initialize
    var st_values = [parseInt($("#min-arrive").val()), parseInt($("#max-arrive").val())];
    $("#set-min-arrive").text(renderTime(st_values[0]));
    $("#set-max-arrive").text(renderTime(st_values[1]));
    $("#arrive-range").slider({
        range: true,
        min: st_values[0],
        max: st_values[1],
        step: 1,
        values: st_values,
        slide: function (event, ui) {
            //Hidden Values            
            $("#min-arrive").val(ui.values[0]);
            $("#max-arrive").val(ui.values[1]);
            // Visual Values            
            $("#set-min-arrive").text(renderTime(ui.values[0]));
            $("#set-max-arrive").text(renderTime(ui.values[1]));
        },
        stop: flightFilteration
    });

    // Depart Slider Initialize
    var st_values = [parseInt($("#min-depart").val()), parseInt($("#max-depart").val())];
    $("#set-min-depart").text(renderTime(st_values[0]));
    $("#set-max-depart").text(renderTime(st_values[1]));
    $("#departure-range").slider({
        range: true,
        min: st_values[0],
        max: st_values[1],
        step: 1,
        values: st_values,
        slide: function (event, ui) {
            //Hidden Values            
            $("#min-depart").val(ui.values[0]);
            $("#max-depart").val(ui.values[1]);
            // Visual Values            
            $("#set-min-depart").text(renderTime(ui.values[0]));
            $("#set-max-depart").text(renderTime(ui.values[1]));
        },
        stop: flightFilteration
    });

    // Price Slider Initialization
    var price_range = [parseFloat($("#price-min").val()), parseFloat($("#price-max").val())];
    $("#price-range").slider({
        range: true,
        min: price_range[0],
        max: price_range[1],
        values: price_range,
        slide: function (event, ui) {
            //Setting Hidden Values
            $("#price-min").val(ui.values[0]);
            $("#price-max").val(ui.values[1]);
            //Setting Visual Values
            var site_currency = 'INR';
            $("#").text(site_currency + " " + ui.values[ 0 ]);
            $("#").text(site_currency + " " + ui.values[ 1 ]);
        },
        stop: flightFilteration
    });

    // Layover Slider Initialize
    function renderDays(minute) {
        var data = timeConvert(minute);
        return ((data[0] > 0) ? data[0] + "d " : '') + ((data[1] > 0) ? data[1] + "h " : '') + data[2] + "m";
    }
    var st_values = [parseInt($("#min-layover").val()), parseInt($("#max-layover").val())];
    $("#set-min-layover").text(renderDays(st_values[0]));
    $("#set-max-layover").text(renderDays(st_values[1]));
    $("#layover-range").slider({
        range: true,
        min: st_values[0],
        max: st_values[1],
        step: 1,
        values: st_values,
        slide: function (event, ui) {
            //Hidden Values            
            $("#min-layover").val(ui.values[0]);
            $("#max-layover").val(ui.values[1]);
            // Visual Values
            $("#set-min-layover").text(renderDays(ui.values[0]));
            $("#set-max-layover").text(renderDays(ui.values[1]));
        },
        stop: flightFilteration
    });
    //uncheck checkboxes from section and show all
    $(".show-all").on('click', function () {
        $(this).closest(".panel-body").find('input:checkbox').prop('checked', false);
        flightFilteration();
    });
// jquery end
</script>

<script type="text/javascript">
    $("#sort-box").change(function () {
        sortFlights(true);
    });
</script></script>





<style>
    .dot {
        height: 12px;
        width: 12px;
        background-color: rgba(255, 255, 255, 0.75);
        border-radius: 50%;
        display: inline-block;
    }

    .stop-end .form-group label.active{
        background:#2196f3;
    }

  
    .btn-default input:checked ~ label{
        background:#2196f3;

    }

/* input[type="checkbox"], input[type="radio"] {
 
  line-height: normal;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: none;
  z-index: 1;
} */


</style>


<!-- Modal -->
<div id="modal_changebookingcode" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content ">
            <div class="modal-body envelope-style panel-notify">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p class="alert alert-info text-center b"> Change Booking Class</p>
                <div id="review_content"></div>
                <div id="AirpricingNewBookingCode"></div>
                <p><b>Note:</b> <small>If you are not able to get the booking codes above then please click SHIFT+F5 keys on your keyboard or clear your browser cache.</small></p>
            </div> <!-- modal-body.// -->
        </div> <!-- modal-content.// -->
    </div> <!-- modal-dialog.// -->
</div>

<input type="hidden" id="searcharray" value='<?php echo serialize($searcharray); ?>'>
<input type="hidden" id="sessionId" value=''>
<input type="hidden" id="siteUrl" value='<?php echo site_url(); ?>'>
<?php $this->load->view('home/home_template/footer'); ?>

<script type="text/javascript">
	var api_array = <?php echo json_encode($api_list); ?>  
    var siteUrl = "<?php echo site_url(); ?>";  
</script>
<script src="<?php echo base_url(); ?>assets/js/flight-listing.js" ></script>
<script src="<?php echo base_url(); ?>assets/js/filtersnew.js" ></script>
<!--<script src="<?php echo base_url(); ?>public/js/flight/filter.js" ></script>
<script src="<?php echo base_url(); ?>public/js/flight/webservices.js" ></script>-->
<script>
$(document).on('click','.stop-end .form-group label', function(){
    $(this).toggleClass('active').siblings().removeClass('active')
})
</script>
<script type="text/javascript">
	$(document).on("click", '.onwardRadio', function ($e) {
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
			beforeSend: function () {
			},
			success: function (data) {
				$('.priceInfoOnward').html(data.selected_flight);
				addbutton();
			}
		});
	});
	$(document).on("click", '.returnRadio', function ($e) {
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
			beforeSend: function () {},
			success: function (data) {
				$('.priceInfoReturn').html(data.selected_flight);
				addbutton();
			}

		});
	});
	function addbutton(){
		$url=$('input[name=url]').val();
		$url1=$('input[name=url1]').val();
		if($url!=undefined && $url1!=undefined){
			$('.bookroundtrip').html('<a href="'+siteUrl+'flights/itinerary/'+$url+'/'+$url1+'" class="btn btn_color">Book Now</a>');
		}
	}
	function doTotal() {
		var TotalPriceOnSelection = 0;
		TotalPriceOnSelection += parseFloat($(".onwardRadio:checked").parents('.FlightInfoBox').attr('data-price'));
		TotalPriceOnSelection += parseFloat($(".returnRadio:checked").parents('.FlightInfoBox').attr('data-price'));
		return '₹ '+TotalPriceOnSelection.toLocaleString();
	}

</script>
