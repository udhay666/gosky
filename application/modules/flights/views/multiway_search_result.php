<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<?php $this->load->view('home/home_template/header'); ?>

<?php
$session_data = $searcharray;
// echo '<pre>';print_r($session_data);exit;
$fromCity_arr = explode(',', $session_data['fromCity'][0]);
$toCity_arr = explode(',', $session_data['toCity'][0]);
$tripType = $session_data['tripType']; 
$fromCityName = $fromCity_arr[0];
$toCityName = $toCity_arr[0];

$journeyDate=$departDate = date('D, j M Y', strtotime(str_replace('/', '-', $session_data['departDate'][0])));
$adults = $session_data['adults'];
$childs = $session_data['childs'];
$infants = $session_data['infants'];
$flightmode=$session_data['flightmode'];
$returnDate = date('D, j M', strtotime(str_replace('/', '-', $session_data['returnDate']))); 
?>

<?php 
  // $journeyDate = date('Y-m-d',strtotime(str_replace('/','-','27/12/2018')));
   function addAndRemoveDate($date,$day,$action) {
      $sum = strtotime(date("Y-m-d", strtotime("$date")) . " $action$day days");
      $dateTo=date('Y-m-d',$sum);
      return $dateTo;
   }
?>

<body>
<!-- ========================= SECTION PAGETOP  ========================= -->
<section class="section-pagetop">
    <div class="container">
        <div class="row no-gutter">
                            <div class="col-sm-7 no-gutter">
                    			
                        <div class="col-sm-6 col-xs-6">
                            <p class="item-info-multi text-center">
                                <span class="title"> DEL <img class="img-icon" src="<?php echo base_url('assets/icons/flights_icon/icon-plane1.png');?>">  BOM </span>
                                <span class="val">20<sup>th</sup> Jan 2022</span>
                            </p> 
                        </div> <!-- col // --> 

                    			
                        <div class="col-sm-6 col-xs-6">
                            <p class="item-info-multi text-center">
                                <span class="title"> BOM <img class="img-icon" src="<?php echo base_url('assets/icons/flights_icon/icon-plane1.png');?>">  DEL </span>
                                <span class="val">20<sup>th</sup> Jan 2022</span>
                            </p> 
                        </div> <!-- col // --> 

                                    </div>
                                    <div class="col-sm-2 col-xs-6">
                <p class="item-info">
                    <i class="material-icons">airline_seat_recline_extra</i>
                    <span class="title">Class</span>
                    <span class="val">Economy</span>
                </p>
            </div> <!-- col // --> 
            <div class="col-sm-2 col-xs-6">
                <p class="item-info">
                    <i class="material-icons">&#xE7FD;</i>
                    <span class="title">Passenger(s)</span>
                    <span class="val">1 Adult, 0 Child, 0 Infant</span>
                </p>
            </div> <!-- col // --> 
            <div class="col-sm-1 col-sm-offset-0 col-xs-12">
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
        <form class="flight-search-form" autocomplete="off" name="flight" id="flight" action="<?php echo base_url('flight/search');?>">   
            <div class="row-sm">
                                <div class="col-lg-10 col-md-10">                    
                    <div class="row-sm">
                        <div class="col-lg-6 col-md-5">
                            <div class="form-group-wrap">
                                <div class="input-wrap form-group">
                                    <i class="material-icons">&#xE905;</i>
                                    <input type="text" name="from" value="New Delhi, Delhi Indira Gandhi international, IN (DEL)" id="autocomplete1" placeholder="Flying from" class="autocomplete-airports" tabindex="1" required>
                                    <!--                            <label class="nearby-check-wrap checkbox">
                                                                    <input type="checkbox" name=""><ins></ins>
                                                                    <span>Nearby Airports</span>
                                                                </label>                                -->
                                </div>
                                <div class="input-wrap form-group">
                                    <i class="material-icons">&#xE904;</i>
                                    <input type="text" name="to" value="New Delhi, Delhi Indira Gandhi international, IN (DEL)" id="autocomplete2" tabindex="2" placeholder="Flying to" class="autocomplete-airports" required>  
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
                                    <img class="img-icon" src="<?php echo base_url('assets/icons/flights_icon/calendar-go.png');?>">
                                    <input type="text" name="depature" value="20-01-2022" class="from-date" readonly="true" autocomplete="off" required tabindex="3"> 
                                    <p class="datetime">
                                        <span class="month"></span>
                                        <span class="day"></span>
                                        <span class="dayname"></span>
                                        <span class="year"></span>
                                    </p>                    
                                </div> <!-- date-wrap// -->
                                <div class="date-wrap date-return-empty" style="">     
                                    <p class="add-return">
                                        <span><i><img src="<?php echo base_url('assets/icons/flights_icon/calendar-return.png');?>"></i></span>
                                        <span class="btn-return">ADD RETURN</span>
                                    </p>                
                                </div> <!-- date-wrap// -->
                                <div class="date-wrap date-return-active form-group" style="">    
                                    <img class="img-icon" src="<?php echo base_url('assets/icons/flights_icon/calendar-back.png');?>">
                                    <input type="text" name="return" value="" class="to-date" readonly="true" autocomplete="off" required tabindex="4"> 
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
        <form class="flight-search-form" name="flight" id="flight" action="<?php echo base_url();?>">   
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
                            <input type="text" name="mdepature[]" class="from-date mdepature1" value="20-01-2022" readonly="true" autocomplete="off" required> 
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
                                <input type="text" name="mdepature[]"  class="from-date mdepature2" value="20-01-2022" readonly="true" autocomplete="off" required> 
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
        var to = $("[name=to]").val();
        var from = $("[name=from]").val();
        $("[name=to]").val(from);
        $("[name=from]").val(to);
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
                if ($(this).find("input[name='from']").val() == $(this).find("input[name='to']").val()) {
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

    <script type="text/javascript" defer>
        $(window).load(function () {

            var recent = $.cookie('flight-recent-search');
            if (recent) { // Oneway and return cookies
                var recentSearch = $.parseJSON(recent);
                //document.write(recentSearch.from);
                var parent = $('#one-round-block form#flight');
                parent.find("input[name=from]").val(recentSearch.from);
                parent.find("input[name=to]").val(recentSearch.to);
                parent.find("input[name=provider]").val(recentSearch.provider);
                // cookie Departure and return date set to form
                var departure = new Date($.datepicker.parseDate("dd-mm-yy", recentSearch.depature));
                if (departure > new Date()) {
                    var departureEl = parent.find("input[name=depature]");
                    departureEl.datepicker("setDate", new Date($.datepicker.parseDate("dd-mm-yy", recentSearch.depature)));
                    populateDate(departureEl, departureEl.datepicker("getDate"));
                    var returnEl = parent.find("input[name=return]");
                    if (recentSearch.trip_type == 'round') {
                        returnEl.datepicker("setDate", new Date($.datepicker.parseDate("dd-mm-yy", recentSearch.return)));
                    }
                    returnEl.datepicker("option", "minDate", departure);
                    populateDate(returnEl, returnEl.datepicker("getDate"));
                }
                parent.find("input[name=adult_count]").val(recentSearch.adult_count);
                parent.find("input[name=child_count]").val(recentSearch.child_count);
                parent.find("input[name=infant_count]").val(recentSearch.infant_count);
                parent.find("select[name=class]").val(recentSearch.class).change();
                parent.find("input[name=days]").prop('checked', (recentSearch.days == 1)).change();
                parent.find("input[name=direct]").prop('checked', (recentSearch.direct == 1)).change();
            }
            //MultiCity Cookies
            var recent_multi = $.cookie('flight-recent-search-multi');
            if (recent_multi) {
                //parse to json
                var recentSearchMulti = $.parseJSON(recent_multi);
                var dest_length = recentSearchMulti.mfrom.length;
                // create multicity blocks if more than 2
                if (dest_length > 2) {
                    for (var i = 1; i <= (dest_length - 2); i++) {
                        $("#add-flight").click();
                    }
                }
                // Values filling in form
                var parent = $('#multi-block form#flight');
                for (var i = 0; i < dest_length; i++) {
                    parent.find("input[name='mfrom[]']").eq(i).val(recentSearchMulti.mfrom[i]);
                    parent.find("input[name='mto[]']").eq(i).val(recentSearchMulti.mto[i]); //mdepature
                    //Departure Datepicker
                    var departureEl = parent.find("input[name='mdepature[]']").eq(i);
                    departureEl.datepicker("setDate", new Date($.datepicker.parseDate("dd-mm-yy", recentSearchMulti.mdepature[i])));
                    populateDate(departureEl, departureEl.datepicker("getDate"));
                }
                parent.find("input[name=adult_count]").val(recentSearchMulti.adult_count);
                parent.find("input[name=child_count]").val(recentSearchMulti.child_count);
                parent.find("input[name=infant_count]").val(recentSearchMulti.infant_count);
                parent.find("select[name=class]").val(recentSearchMulti.class).change();
                parent.find("input[name=days]").prop('checked', (parseInt(recentSearchMulti.days) === 1)).change();
                parent.find("input[name=direct]").prop('checked', (parseInt(recentSearchMulti.direct) === 1)).change();
            }
            //Last Search
            var recent_search_type = $.cookie('flight-recent-search-type');
            if (recent_search_type) {
                switch (recent_search_type) {
                    case 'oneway':
                        $(".form-block .btn-one-way").click();
                        break;
                    case 'round':
                        $(".form-block .btn-round-trip").click();
                        break;
                    case 'multicity':
                        $(".form-block .btn-multy-city").click();
                        break;
                }
                $(".spinner-value-flight").change();
            }
        });


    </script>

<script type="text/javascript">
    $(window).load(function () {
            $(".section-modify .btn-multy-city").click();

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
        <!--left panel-->
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
            <input type="hidden" id="price-min" value="680">
            <input type="hidden" id="price-max" value="3870">
            <div id="setMinPrice" class="pull-left">AED 680</div>  
            <div id="setMaxPrice" class="pull-right">AED 3870</div>            
        </div>
    </div> <!-- panel-body // -->
</article> <!-- panel// -->

<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title"> Stops</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body">        
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default">
                <input type="checkbox" name="stop" value="Direct" id="stop0" onchange="flightFilteration();"> Direct
            </label>
            <label class="btn btn-default">
                <input type="checkbox" name="stop" value="1  Stop" id="stop1" onchange="flightFilteration();"> 1  Stop
            </label>

        </div>
    </div> <!-- panel-body // -->
</article> <!-- panel// -->

<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title">Fare type</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body">

        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default">
                <input name="faretype" type="checkbox" id="faretype0" value="Refundable" onchange="flightFilteration();"> Refundable
            </label>
        </div>
    </div> <!-- panel-body// -->
</article> <!-- panel// -->

<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title">Departure Time</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body">        
        <div id="departure-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span></div>
        <div class="slider-numbers-wrap">           
            <input type="hidden" id="min-depart" value="90">
            <input type="hidden" id="max-depart" value="1410">
            <div id="set-max-depart" class="pull-right">23:30</div>
            <div id="set-min-depart" class="pull-left">01:30</div>            
        </div>
    </div> <!-- panel-body// -->
</article> <!-- panel// -->

<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title">Arrival Time</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body">       
        <div id="arrive-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span></div>
        <div class="slider-numbers-wrap">           
            <input type="hidden" id="min-arrive" value="55">
            <input type="hidden" id="max-arrive" value="1410">
            <div id="set-max-arrive" class="pull-right">23:30</div>
            <div id="set-min-arrive" class="pull-left">00:55</div>            
        </div>        
    </div>
</article> <!-- panel// -->

<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title">Flight duration</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body">
        <br>
        <div id="duration-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span></div>
        <div class="slider-numbers-wrap">           
            <input type="hidden" id="minDuration" value="120">
            <input type="hidden" id="maxDuration" value="1570">
            <div id="setMaxDuration" class="pull-right">26h 10m</div>
            <div id="setMinDuration" class="pull-left">2h 0m</div>            
        </div>
    </div> <!-- panel-body// -->
</article> <!-- panel// -->


<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title">Airlines</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body filter-airlines-wrap">
        <a class="show-all" href="javascript:;">Show all</a>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="airline" id="airline0" value="AI" onchange="flightFilteration();"><ins></ins>  
                <span class="img-wrap"><img src="<?php echo base_url('assets/icons/flights_icon/AI.png');?>"></span>
                <span class="text-wrap"> Air India</span>            
            </label>
            <span class="badge-list">
                <a href="javascript:;" class="only" onclick="checkOnly(this, 'airline');">Only</a>               
            </span>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="airline" id="airline1" value="UK" onchange="flightFilteration();"><ins></ins>  
                <span class="img-wrap"><img src="<?php echo base_url('assets/icons/flights_icon/UK.png');?>"></span>
                <span class="text-wrap"> Vistara </span>            
            </label>
            <span class="badge-list">
                <a href="javascript:;" class="only" onclick="checkOnly(this, 'airline');">Only</a>               
            </span>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="airline" id="airline2" value="W2" onchange="flightFilteration();"><ins></ins>  
                <span class="img-wrap"><img src="<?php echo base_url('assets/icons/flights_icon/W2.png');?>"></span>
                <span class="text-wrap"> FlexFlight </span>            
            </label>
            <span class="badge-list">
                <a href="javascript:;" class="only" onclick="checkOnly(this, 'airline');">Only</a>               
            </span>
        </div>
    </div>
</article> <!-- panel// -->	


<script type="text/javascript">
/// some script    

    $(function () {
        $("#price-min1").val('680');
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
            var site_currency = 'AED';
            $("#setMinPrice").text(site_currency + " " + ui.values[ 0 ]);
            $("#setMaxPrice").text(site_currency + " " + ui.values[ 1 ]);
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
</script></div> <!-- filter-wrap// -->
                </div>                
            </aside>
        <!--Left Panel end-->

            <main class="col-md-9 col-sm-12">
                <header class="blok-header">
                    <div class="col-md-4">
                        <h4 class="title pull-left"><span id="total-search-flights">0</span> Flights</h4>
                                            </div>

                    
                    <div class="col-md-4 mob-display-none">
                        <div class="pull-right select-filter-wrap">
                            <label>Sort By: </label>
                            <!--<select id="sort-box" class="selectpicker show-tick" data-style="btn-filter" disabled>-->
                             <select id="sort-box" class="selectpicker show-tick" data-style="btn-filter" disable>
                                <option value="price" data-order="ASC">Price (Lowest)</option>
                                <option value="price" data-order="DESC">Price (Highest)</option>
                                <option data-divider="true"></option>
                                <option value="name" data-order="ASC" >Airline ASC</option>
                                <option value="name" data-order="DESC">Airline DESC</option>
                                <option data-divider="true"></option>
                                <option value="departure" data-order="ASC">Departure ASC</option>
                                <option value="departure" data-order="DESC">Departure DESC</option>
                                <option data-divider="true"></option>
                                <option value="arrival" data-order="ASC">Arrival ASC</option>
                                <option value="arrival" data-order="DESC">Arrival DESC</option>
                                <option data-divider="true"></option>
                                <option value="duration" data-order="ASC" >Duration ASC</option>
                                <option value="duration" data-order="DESC">Duration DESC</option>
                            </select>
                        </div>
                    </div>

                </header> <!-- blok-header// -->

                <!-- loading state start -->
                <!-- <div class="progress" id="progress-bar">
                    <div class="progress-bar progress-bar-default  progress-bar-striped">
                    </div>
                </div> -->
                <!-- loading state end// -->

                <!-- loading state start -->
                <article class="loading-content">
                    <br/><br/><br/>
                    <img src="<?php echo base_url('assets/icons/flights_icon/loading.gif');?>">
                    <h3 class="text1">Searching for your flight</h3>
                    <h5 class="text2">One moment, please ... <br/> Comparing great rates from over 1000 airlines in more than 195 countries ...</h5>
                </article>
                <!-- loading state end// -->
                
                <!--Result content start-->
				<div class="flights" id="flightsresults" >
              
			  </div>


                
                
                <!-- ---------- email totication block ---------- -->
                <article class="panel panel-default panel-notify" id="block_email_notify" style="display: none">
                    <div class="panel-body envelope-style">
                        <a href="#" class="btn-close"> <i class="fa fa-close"></i> </a>
                        <div class="row">
                            <div class="col-sm-6">	
                                <h4 class="title">
                                    <i class="fa fa-envelope"></i> &nbsp We will alert you if fare is changed                                </h4>
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
                                    <input type="hidden" name="alert_modify_search" value="eyJ0eXBlIjoiTSIsIm9yaWdpbiI6WyJERUwiLCJCT00iXSwiZGVzdGluYXRpb24iOlsiQk9NIiwiREVMIl0sImRlcGFydF9kYXRlIjpbIjIwLTAxLTIwMjIiLCIyMC0wMS0yMDIyIl0sImRheXMiOiIiLCJtZXRob2QiOiJTeW5jaCIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiRWNvbm9teSJ9">
                                    <input type="hidden" name="alert_price" id="price-min1" value="0">
                                    <p class="alert alert-info text-center b"> Multi-City</p>
                                    <table class="table-round">
                                        <tr>
                                            <td><strong>From</strong>: Mumbai (BOM)</td>
                                            <td><strong>To</strong>: New Delhi (DEL)</td>
                                        </tr>
                                        <tr>
                                            <td ><strong>Trip Start</strong>: 20-01-2022</td>
                                            
                                                                                            <td><strong>Trip End</strong>: 20-01-2022</td>
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
                    <h4 class="h4">We found more airports near Mumbai (BOM)</h4>
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


<script src="<?php echo base_url('assets/js/libs/handlebars-v4.0.11.js');?>" defer="defer"></script>
<script src="<?php echo base_url(); ?>assets/js/flight-listing.js" ></script>
<!-- Template : Flight Listing -->
<script id="flight-list-block-tmpl" type="text/x-handlebars-template">
{{#each flights}}
<section class="flight-elem-parent" data-price="{{TotalPrice}}">
<section class="item-result-wrap flight-elem" id="ticketid0123{{index_value}}" data-airlinecode="{{onward_Carrier}}" data-price="{{TotalPrice}}" data-faretype="{{FareType}}" data-stops="{{onward_stops}}" data-arivaltime="{{onward_ArrivalTimeFilter}}" data-departtime="{{onward_DepartureTimeFilter}}" data-flightduration="{{onward_flightDuration}}" >

    <article id="{{TotalPrice}}" class="item-flight {{#if Advertisement}}ticket-offer{{/if}}">
        <p class="ticket-highlight-info hide" id="z-{{TotalPrice}}"><i class="fa fa-check"></i> &nbsp THIS IS THE CHEAPEST FLIGHT FOR THESE DATES!</p>
        {{#if Advertisement}}
        <p class="ticket-offer-info"><i class="fa fa-bell" aria-hidden="true"></i> {{Advertisement}}</p>
        {{/if}}
        <div class="row no-gutter">
            <main class="col-md-9 col-sm-12 item-flight-left"><br/>
                {{#each shortsegments}}
                <div class="row row-trip no-gutter" style="border-bottom:1px solid #D1D1D1;">
                    <aside class="col-sm-2 col-xs-3">
                        <div class="info-airline">
                            <img src="https://asfartrip.com/public/assets/images/airline_logo/{{Carrier}}.png">
                            <br><span class="text-dots" data-toggle="tooltip" title="{{CarrierName}}">{{CarrierName}}</span>
                        </div>
                    </aside> <!-- col // -->
                    <aside class="col-sm-7 col-xs-9">
                        <div class="info-stops">
                            <p class="place-wrap"><strong class="city" data-toggle="tooltip" title="{{OriginName}}">{{OriginName}}</strong> <span class="code {{outwardnearby_origin}}" data-toggle="tooltip" title="{{outwardnearby_origin_text}}">({{Origin}})</span> <br>{{onward_DepartureDate}} <strong>{{onward_DepartureTime}}</strong></p>
                            <p class="way-wrap">
                                <br>
                                <span class="travel-stops">
                                    <span class="start"></span>
                                    {{#if onward_stop_1}}
                                    <span class="stop"></span>
                                    {{/if}}
                                    {{#if onward_stop_2}}
                                    <span class="stop"></span>
                                    <span class="stop"></span>
                                    {{/if}}
                                    <span class="end"></span>
                                </span>
                                <span class="txt-stops txt-{{onward_color}}" data-toggle="tooltip" data-placement="bottom" title="{{onward_stop_Origin}}">{{onward_stops}}</span>
                            </p>
                            <p class="place-wrap"><span class="code {{outwardnearby_destination}}" data-toggle="tooltip" title="{{outwardnearby_destination_text}}">({{Destination}})</span> <strong class="city" data-toggle="tooltip" title="{{DestinationName}}">{{DestinationName}}</strong>  <br><strong>{{onward_ArrivalTime}}</strong> {{onward_ArrivalDate}}
                                {{#if onward_nextday}}
                                <span data-toggle="tooltip" title="Arrival next day" class="badge">+{{onward_nextday}}</span>
                                {{/if}}							
                            </p>
                        </div>
                    </aside> <!-- col // -->
                    <aside class="col-sm-3  col-xs-12">
                        <div class="info-duration">
                            <i class="material-icons">&#xE192;</i>
                            <span class="time">{{onward_segment_dur}}</span>
                            <!--<small class="title">Duration</small>-->
                        </div>
                        <div class="info-icons">
                            <span class="icon icon-layover" data-toggle="tooltip" title="Baggage"><img src="<?php echo base_url('assets/icons/flights_icon/baggage.png');?>"></span>
                            {{#if isRefundable}}
                            <span class="icon icon-layover" data-toggle="tooltip" title="Refundable"><img src="<?php echo base_url('assets/icons/flights_icon/refund.png');?>"></span>
                            {{/if}}

                            {{^if isRefundable}}
                            <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Non Refundable" aria-describedby="tooltip108990"><img src="<?php echo base_url('assets/icons/flights_icon/norefund.png');?>"></span>
                            {{/if}}

                            {{#if short_Layover}}
                            <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Short Layover"><img src="<?php echo base_url('assets/icons/flights_icon/run.png');?>"></span>
                            {{/if}}

                            {{#if long_Layover}}
                            <span class="icon icon-layover" data-toggle="tooltip" title="Long Layover"><img src="<?php echo base_url('assets/icons/flights_icon/wait.png');?>"></span>
                            {{/if}}

                            {{#if redeye}}
                            <span class="icon icon-layover" data-toggle="tooltip" title="Night fly"><img src="<?php echo base_url('assets/icons/flights_icon/redeye.png');?>"></span>
                            {{/if}}

                        </div> <!-- info icons // -->
                    </aside> <!-- col // -->
                </div> <!-- row-trip // -->
                {{/each}}

            </main> <!-- col // -->
            <aside class="col-sm-3">
                <div class="info-buy">
                    {{#if BookingSeats}}
                    <p class="txt-seat">{{BookingSeats}} Seats left {{#if Hold_Ticket}} <span class="label label-success pull-right">Hold Fare</span>{{/if}}</p>
                    {{/if}}

                    <p class="ticket-price-wrap"><span class="currency">{{website_currency}}</span> {{TotalPrice_format}}</p>
                    <form name="flight_segmentform_{{index_value}}" id="flight_segmentform_{{index_value}}">
                        <input type="hidden" name="temp_d" value="{{encoded_response}}" required>
                        <input type="hidden" name="temp_r" value="{{encoded_request}}" required>
                        <input type="hidden" name="api" value="" required>
                        <input type="hidden" name="temp_price" value="{{Original_TotalPrice}}">
                        <p>
                            <input class="btn btn-block btn-warning" onclick="getAirpricing_multi('{{index_value}}','{{request_origin}}','{{request_destination}}','{{request_originName}}','{{request_destinationName}}','{{request_depart_date}}','{{request_depart_lastdate}}', 'Multi-City')" type="button" id="simple-post_{{index_value}}" name="button" value="Book Now">
                        </p>
                    </form>
                    <p><a onclick="ShowItinerary('ticketid0123{{index_value}}')" class="btn btn-block btn-info btn-details">Details <b class="caret"></b></a></p>
                </div>
            </aside> <!-- col // -->


        </div> <!-- row // -->
    </article> <!--  item-flight //  -->

    <div class="item-details" style="display: none">
        <nav class="heading-tab-details">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#flight_menu-{{index_value}}" aria-controls="flight" data-toggle="tab"><span class="hidden-xs">Flight details</span> <span class="visible-xs">Flight</span></a></li>
                <li><a href="#baggage_menu-{{index_value}}" aria-controls="fare" data-toggle="tab" {{#if checkBaggage}} onclick="getAirpricing_baggage('{{index_value}}','{{onward_Origin}}','{{onward_Destination}}','{{onward_fromCityName}}','{{onward_toCityName}}','{{onward_DepartureDate}}','{{onward_ArrivalDate}}')" {{/if}}><span class="hidden-xs">Baggage information</span> <span class="visible-xs">Baggage</span></a></li>
                <li><a href="#fare_menu-{{index_value}}" aria-controls="fare" data-toggle="tab" {{#if checkBaggage}} onclick="getAirpricing_baggage('{{index_value}}','{{onward_Origin}}','{{onward_Destination}}','{{onward_fromCityName}}','{{onward_toCityName}}','{{onward_DepartureDate}}','{{onward_ArrivalDate}}')" {{/if}}><span class="hidden-xs">Fare Details</span> <span class="visible-xs">Fare</span></a></li>
            </ul>
        </nav><!--  tab-heading//  -->

        <div class="tab-content">
            <section class="tab-pane fade in active" id="flight_menu-{{index_value}}">
                <article class="ticket-detail">
                    {{#each segments}}
                    {{#if CarrierName}}

                    <header class="heading-ticket">
                        <i class="material-icons rotate-right">&#xE195;</i> 
                        <span class="alert-stops"> <span class="fa fa-clock-o fa-lg"></span> &nbsp {{onward_stops}}</span>
                        <h4 class="title">Flight from <strong>{{OriginName}}</strong> To <strong>{{DestinationName}}</strong> On <strong>{{Depart_ShortDestinationDate}}</strong></h4>
                    </header>

                    <div class="row row-trip no-gutter">
                        <aside class="col-sm-2 col-xs-12">
                            <div class="info-airline">
                                <img src="https://asfartrip.com/public/assets/images/airline_logo/{{Carrier}}.png">
                                <br> {{CarrierName}} <br> {{Carrier}} - {{FlightNumber}}
                                {{#if OperatingCarrierName}}<br><b>Operated By</b><br> {{OperatingCarrierName}} {{/if}}
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-7 col-xs-12">
                            <div class="info-flight-way">
                                <p class="place-wrap-from">{{OriginName}} <strong>({{Origin}})</strong>
                                    <br>{{onward_DepartureDate}} <strong>{{onward_DepartureTime}}</strong>
                                    <br>{{OriginAirport}}
                                    <br>{{OriginTerminal}}</p>
                                <p class="way-wrap">
                                    <span class="txt-time">{{onward_segment_dur}}</span>
                                    <span class="travel-stops">
                                        <span class="start"></span>
                                        <span class="end"></span>
                                    </span>
                                </p>
                                <p class="place-wrap-to">({{Destination}}) <strong>{{DestinationName}}</strong>
                                    <br><strong>{{onward_ArrivalTime}}</strong> {{onward_ArrivalDate}} {{#if next_day}}<span data-toggle="tooltip" title="Arrival next day" class="badge">+1</span>{{/if}}
                                    <br> {{DestinationAirport}}
                                    <br> {{DestinationTerminal}}</p>
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-3 col-xs-12 hidden-xs"> 
                            <ul class="list-default">
                                {{#if Equipment}}
                                <li>Aircraft Type: <span>{{onward_segment_Equipment}}</span></li>
                                {{/if}}
                                {{#if BookingCode}}
                                <li>Booking class: <span>{{BookingCode}}</span></li>
                                {{/if}}                               
                                <li>Cabin Class: <span> {{CabinClass}}</span></li>
                            </ul>
                        </aside><!-- col // -->
                    </div> <!-- row-trip // -->


                    {{#if onward_Layover}}
                    <span class="layover">  <strong><img src="https://asfartrip.com/public/assets/images/icons/layover.png"> Layover {{onward_Layover}} in {{onward_LayoverName}}</strong> </span>
                    {{/if}}

                    {{/if}}


                    {{^if CarrierName}}
                    <!-- Start -->

                    {{#each this}}
                    {{#if Depart_OriginName}}
                    <header class="heading-ticket">
                        <i class="material-icons rotate-right">&#xE195;</i> 
                        <span class="alert-stops"> <span class="fa fa-clock-o fa-lg"></span> &nbsp {{onward_stops}}</span>
                        <h4 class="title">Flight from <strong>{{Depart_OriginName}}</strong> To <strong>{{Depart_DestinationName}}</strong> On <strong>{{Depart_ShortDestinationDate}}</strong></h4>
                    </header>
                    {{/if}}
                    {{/each}}

                    <!-- END -->

                    {{#each this}}

                    <div class="row row-trip no-gutter">
                        <aside class="col-sm-2 col-xs-12">
                            <div class="info-airline">
                                <img src="https://asfartrip.com/public/assets/images/airline_logo/{{Carrier}}.png">
                                <br> {{CarrierName}} <br> {{Carrier}} - {{FlightNumber}}
                                {{#if OperatingCarrierName}}<br><b>Operated By</b><br> {{OperatingCarrierName}} {{/if}}
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-7 col-xs-12">
                            <div class="info-flight-way">
                                <p class="place-wrap-from"><strong>{{OriginName}}</strong> ({{Origin}})
                                    <br>{{onward_DepartureDate}} <strong>{{onward_DepartureTime}}</strong>
                                    <br>{{OriginAirport}}
                                    <br>{{OriginTerminal}}</p>
                                <p class="way-wrap">
                                    <span class="txt-time">{{onward_segment_dur}}</span>
                                    <span class="travel-stops">
                                        <span class="start"></span>
                                        <span class="end"></span>
                                    </span>
                                </p>
                                <p class="place-wrap-to">({{Destination}}) <strong>{{DestinationName}}</strong>
                                    <br><strong>{{onward_ArrivalTime}}</strong> {{onward_ArrivalDate}} {{#if next_day}}<span data-toggle="tooltip" title="Arrival next day" class="badge">+1</span>{{/if}}
                                    <br> {{DestinationAirport}}
                                    <br> {{DestinationTerminal}}</p>
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-3 col-xs-12 hidden-xs"> 
                            <ul class="list-default">
                                {{#if Equipment}}
                                <li>Aircraft Type: <span>{{onward_segment_Equipment}}</span></li>
                                {{/if}}
                                {{#if BookingCode}}
                                <li>Booking class: <span>{{BookingCode}}</span></li>
                                {{/if}}                               
                                <li>Cabin Class: <span> {{CabinClass}}</span></li>
                            </ul>
                        </aside><!-- col // -->
                    </div> <!-- row-trip // -->


                    {{#if onward_Layover}}
                    <span class="layover">  <strong><img src="https://asfartrip.com/public/assets/images/icons/layover.png"> Layover {{onward_Layover}} in {{onward_LayoverName}}</strong> </span>
                    {{/if}}


                    {{/each}}
                    {{/if}}


                    {{/each}}

                </article> <!-- ticket-detail// -->                                       
            </section> <!--  tab-pane //  -->
            <section class="tab-pane fade" id="fare_menu-{{index_value}}">
                <article class="ticket-detail panel-body">

                    <table class="table-round">	
                        <tr class="bg-info">
                            <td>Fare Details                                {{#if isRefundable}}
                                <span class="label-green pull-right">Refundable</span>
                                {{/if}}

                                {{^if isRefundable}}
                                <span class="label-red pull-right">Non-Refundable</span>
                                {{/if}}
                            </td>
                            {{#if isRefundable}}
                            <td>Change flight</td>
                            <td>Cancel flight</td>
                            {{/if}}
                        </tr>
                        <tr>
                            <td>
                                <p class="key-val"> <span>Base Fare:</span> <var>{{website_currency}} {{BasePrice}}</var></p>
                                <p class="key-val"> <span>Taxes & Fees <i class="fa fa-question-circle" aria-hidden="true"  data-toggle="tooltip" title="Taxes & Fees include service fee, as well as third party taxes and surcharges such as airport tax, fuel surcharges, and airline fees. For more info, please view our FAQs"></i>:</span> <var>{{website_currency}} {{Taxes}}</var></p>
                                <p class="key-val"> <span>Total (incl. VAT):</span> <var>{{website_currency}} {{TotalPrice}}</var></p>							 
                            </td>
                            {{#if isRefundable}}
                            <td>
                                <p class="key-val"> <span>Airlines charges <small class="change_penalty_{{index_value}}" style="color: red;"></small>:</span> <var class="change_{{index_value}}">AED 0</var></p>
                                <p class="key-val"> <span>Other charges:</span> <var> AED 20</var></p>							  
                            </td>
                            <td>
                                <p class="key-val"> <span>Airlines charges <small class="cancel_penalty_{{index_value}}" style="color: red;"></small>:</span> <var class="cancel_{{index_value}}">AED 0</var></p>
                                <p class="key-val"> <span> Other charges:</span> <var>AED 20</var></p>							   
                            </td>
                            {{/if}}
                        </tr>
                    </table>

                    {{#if isRefundable}}
                    <p class="alert alert-warning">Note: The airline fee may, at times, be calculated on a per-flight basis. Cancellation/Flight change charges are indicative. Airlines stop accepting cancellation/change requests 4 - 72 hours before departure of the flight, depending on the airline. 
Change and refund fees and charges may change anytime and the price shown is not the final price as the airline has the right to change it anytime.</p>
                    {{/if}}
                    <p class="alert alert-info">Note: travelkit.com applies VAT as per the UAE law. For more info, please view our <a href='/en/faq' target='_blank'>FAQs</a></p>
                </article> <!-- ticket-detail// -->
            </section> <!--  tab-pane //  -->

            <section class="tab-pane fade" id="baggage_menu-{{index_value}}">
                <article class="ticket-detail">                  

                    <table class="table table-baggage">
                        {{#each segments}}
                        {{#if CarrierName}}

                        <tr><td colspan="3"><header class="heading-ticket" style="border: 0px;">
                                    <i class="material-icons rotate-right">&#xE195;</i> 
                                    <span class="alert-stops"> <span class="fa fa-clock-o fa-lg"></span> &nbsp {{onward_stops}}</span>
                                    <h4 class="title">Flight from <strong>{{OriginName}}</strong> To <strong>{{DestinationName}}</strong> On <strong>{{Depart_ShortDestinationDate}}</strong></h4>
                                </header></td></tr>
                        <tr>
                            <td class="info-airline"> <img src="https://asfartrip.com/public/assets/images/airline_logo/{{Carrier}}.png"><br><small>{{CarrierName}}</small></td>

                            <td width="300">
                                <p><strong class="text-primary">Carry-on:</strong> 7 kg/person</p>
                                <p><strong class="text-primary">Check-in:</strong> <span class="outward_baggage_{{index_value}}">
                                        {{#if onward_Baggage.Adult}}
                                        Adult: {{onward_Baggage.Adult}}                                    
                                        {{/if}}
                                        {{#if onward_Baggage.Child}}
                                        , Child: {{onward_Baggage.Child}}                                    
                                        {{/if}}
                                        {{#if onward_Baggage.Infant}}
                                        , Infant: {{onward_Baggage.Infant}}                                    
                                        {{/if}}

                                        {{^if onward_Baggage.Adult}}
                                        No Free Baggage is available
                                        {{/if}}
                                    </span>

                                </p>
                            </td>
                            <td>  
                                <p class="txt-green">Free</p>
                                <p class="txt-green">Free</p> 
                            </td>
                        </tr>
                        {{/if}}

                        {{^if CarrierName}}
                        <!-- Start -->

                        {{#each this}}
                        {{#if Depart_OriginName}}
                        <tr><td colspan="3"><header class="heading-ticket" style="border: 0px;">
                                    <i class="material-icons rotate-right">&#xE195;</i> 
                                    <span class="alert-stops"> <span class="fa fa-clock-o fa-lg"></span> &nbsp {{onward_stops}}</span>
                                    <h4 class="title">Flight from <strong>{{Depart_OriginName}}</strong> To <strong>{{Depart_DestinationName}}</strong> On <strong>{{Depart_ShortDestinationDate}}</strong></h4>
                                </header></td></tr>
                        {{/if}}
                        {{/each}}

                        <!-- END -->


                        {{#each this}}
                        <tr>
                            <td class="info-airline"> <img src="https://asfartrip.com/public/assets/images/airline_logo/{{Carrier}}.png"><br><small>{{CarrierName}}</small></td>

                            <td width="300">
                                <p><strong class="text-primary">Carry-on:</strong> 7 kg / person</p>
                                <p><strong class="text-primary">Check-in:</strong><span class="outward_baggage_{{index_value}}"> 
                                        {{#if onward_Baggage.Adult}}
                                        Adult: {{onward_Baggage.Adult}}                                    
                                        {{/if}}
                                        {{#if onward_Baggage.Child}}
                                        , Child: {{onward_Baggage.Child}}                                    
                                        {{/if}}
                                        {{#if onward_Baggage.Infant}}
                                        , Infant: {{onward_Baggage.Infant}}                                    
                                        {{/if}}

                                        {{^if onward_Baggage.Adult}}
                                        No Free Baggage is available
                                        {{/if}}
                                    </span>
                                </p>
                            </td>
                            <td>  
                                <p class="txt-green">Free</p>
                                <p class="txt-green">Free</p>
                            </td>
                        </tr>

                        {{/each}}
                        {{/if}}

                        {{/each}}						      
                    </table>				

                    <span class="text-center col-sm-12 hide" id="pieces_baggage_icon_{{index_value}}"><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i></span>
                    <p class="alert alert-warning m15 hide" id="pieces_baggage_{{index_value}}" style="text-align:center;"> Sorry! Baggage information will be available at the next step.  </p>

                </article> <!-- ticket-detail// -->
            </section> <!--  tab-pane //  -->


        </div> <!-- tab-content // -->	
    </div> <!-- item-details-wrap // -->

</section> <!-- ====== item-result-wrap ====== // --></section>
{{/each}}



<!--<script>
    var xhr;
    function getAirpricing(id) {
        if (xhr && xhr.readyState !== 4) {

            xhr.abort();
        }
        $('#faremodel').modal({backdrop: 'static', keyboard: false, show: true, });
        xhr = $.ajax(
                {
                    url: 'https://asfartrip.com/flights/flight/AddToCart',
                    type: "POST",
                    data: $('form[name="flight_segmentform_' + id + '"]').serializeArray(),
                    success: function (data, textStatus, jqXHR)
                    {
                        //window.open(data);
                        //$('.imgLoader').fadeOut();

                        window.location = data;
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        $("#simple-msg").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus=' + textStatus + ', errorThrown=' + errorThrown + '</code></pre>');
                    }
                });
        return false;
    }
</script>-->
</script>
<script id="flight-filter-block-tmpl" type="text/x-handlebars-template">
<!--<a href="#" class="btn-filter-close rotate-left btn btn-danger visible-xs" style="position: fixed; right:-30px; top:50%"> &times Close  filter</a>-->
{{#if nearby_airports}}
<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title">Nearby airports</h4>
    </header> 
    <div class="panel-body">
        <h4 class="panel-title">Outward</h4>
        {{#each nearby_airports.onward_nearby}}	
        <span class="hide" id="nerby_result">Yes</span>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="outward_nearby" type="checkbox" id="nearby{{@index}}" value="{{Code}}" onchange="flightFilteration();" checked><ins></ins> 
                <span class="text-wrap">{{Code}}: {{Name}}</span>            
            </label>
        </div>
        {{/each}}

        {{#if nearby_airports.return_nearby}}
        <h4 class="panel-title">Return</h4>
        {{/if}}
        {{#each nearby_airports.return_nearby}}
        <div class="checkbox">
            <label>
                <input type="checkbox" name="return_nearby" type="checkbox" id="nearby{{@index}}" value="{{Code}}" onchange="flightFilteration();" checked><ins></ins> 
                <span class="text-wrap">{{Code}}: {{Name}}</span>            
            </label>
        </div>
        {{/each}}
    </div>
</article>
{{/if}}

<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title">Price range</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body">
        <br />
        <div id="price-range"></div>
        <div class="slider-numbers-wrap">          
            <input type="hidden" id="price-min" value="{{Price.MinPrice}}" />
            <input type="hidden" id="price-max" value="{{Price.MaxPrice}}" />
            <div id="setMinPrice" class="pull-left">AED {{Price.MinPrice}}</div>  
            <div id="setMaxPrice" class="pull-right">AED {{Price.MaxPrice}}</div>            
        </div>
    </div> <!-- panel-body // -->
</article> <!-- panel// -->

<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title"> Stops</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body">        
        <div class="btn-group" data-toggle="buttons">
            {{#each Stops}}
            <label class="btn btn-default">
                <input type="checkbox" name="stop" value="{{this}}" id="stop{{@index}}" onchange="flightFilteration();"> {{this}}
            </label>
            {{/each}} 

        </div>
    </div> <!-- panel-body // -->
</article> <!-- panel// -->

<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title">Fare type</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body">

        <div class="btn-group" data-toggle="buttons">
            {{#each FareType}}
            <label class="btn btn-default">
                <input name="faretype" type="checkbox" id="faretype{{@index}}" value="{{this}}" onchange="flightFilteration();"> {{this}}
            </label>
            {{/each}}
        </div>
    </div> <!-- panel-body// -->
</article> <!-- panel// -->

<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title">Departure Time</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body">        
        <div id="departure-range"></div>
        <div class="slider-numbers-wrap">           
            <input type="hidden" id="min-depart" value="{{DepartureTime.MinDepartureTime}}" />
            <input type="hidden" id="max-depart" value="{{DepartureTime.MaxDepartureTime}}" />
            <div id="set-max-depart" class="pull-right"></div>
            <div id="set-min-depart" class="pull-left"></div>            
        </div>
    </div> <!-- panel-body// -->
</article> <!-- panel// -->

<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title">Arrival Time</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body">       
        <div id="arrive-range"></div>
        <div class="slider-numbers-wrap">           
            <input type="hidden" id="min-arrive" value="{{ArrivalTime.MinArrivalTime}}" />
            <input type="hidden" id="max-arrive" value="{{ArrivalTime.MaxArrivalTime}}" />
            <div id="set-max-arrive" class="pull-right"></div>
            <div id="set-min-arrive" class="pull-left"></div>            
        </div>        
    </div>
</article> <!-- panel// -->
{{#if Layover.MinLayover}}
<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title">Layover</h4>
    </header> <!-- panel-heading// -->
    <!--    <div class="panel-body">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-default"> 
                    <input type="radio" name="layover" id="option1" value="0-6" autocomplete="off" onchange="flightFilteration();"> 1h - 6h
                </label> 
                <label class="btn btn-default">
                    <input type="radio" name="layover" id="option2" value="7-12" autocomplete="off" onchange="flightFilteration();"> 7h - 12h
                </label> 
                <label class="btn btn-default">
                    <input type="radio" name="layover" id="option3" value="13-100" autocomplete="off" onchange="flightFilteration();"> 13+ h
                </label> 
            </div> 
        </div>  panel-body// -->
    <div class="panel-body">        
        <div id="layover-range"></div>
        <div class="slider-numbers-wrap">           
            <input type="hidden" id="min-layover" value="{{Layover.MinLayover}}" />
            <input type="hidden" id="max-layover" value="{{Layover.MaxLayover}}" />
            <div id="set-max-layover" class="pull-right"></div>
            <div id="set-min-layover" class="pull-left"></div>            
        </div>
    </div> <!-- panel-body// -->
</article> <!-- panel// -->
{{/if}}

<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title">Flight duration</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body">
        <br>
        <div id="duration-range"></div>
        <div class="slider-numbers-wrap">           
            <input type="hidden" id="minDuration" value="{{FlightDurations.MinTime}}" />
            <input type="hidden" id="maxDuration" value="{{FlightDurations.MaxTime}}" />
            <div id="setMaxDuration" class="pull-right"></div>
            <div id="setMinDuration" class="pull-left"></div>            
        </div>
    </div> <!-- panel-body// -->
</article> <!-- panel// -->

<!--
panel// 	

<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title">Airports</h4>
    </header>  panel-heading// 
    <div class="panel-body">
        <p class="text-primary">From Dubai</p>
        <div class="checkbox"> <label><input type="checkbox" checked value=""><ins></ins> DXB: Dubai International Airport</label> 
            <a href="#" class="btn-only-check pull-right">Only</a>
        </div>

        <div class="checkbox"> <label><input type="checkbox" checked value=""> <ins></ins> DWC: Dubai World Central</label> 
            <a href="#" class="btn-only-check pull-right">Only</a>
        </div>

        <div class="checkbox"> <label><input type="checkbox" checked value=""><ins></ins>  XNB: Dubai, United Arab Emirates</label> 
            <a href="#" class="btn-only-check pull-right">Only</a>
        </div>

        <div class="checkbox"> <label><input type="checkbox" checked value=""><ins></ins>  SHJ: Sharjah International Airport</label> 
            <a href="#" class="btn-only-check pull-right">Only</a>
        </div>
        <p class="text-primary">To Istanbul</p>
        <div class="checkbox"> <label><input type="checkbox" checked value=""><ins></ins>  IST Ataturk Airport</label> 
            <a href="#" class="btn-only-check pull-right">Only</a>
        </div>

        <div class="checkbox"> <label><input type="checkbox" checked value=""><ins></ins>  SAB Sabiha Goccen</label> 
            <a href="#" class="btn-only-check pull-right">Only</a>
        </div>

    </div>
</article>  panel// 	-->

<article class="panel panel-default">
    <header class="panel-heading"> 
        <h4 class="panel-title">Airlines</h4>
    </header> <!-- panel-heading// -->
    <div class="panel-body filter-airlines-wrap">
        <a class="show-all" href="javascript:;">Show all</a>
        {{#each Airlines}}
        <div class="checkbox">
            <label>
                <input type="checkbox" name="airline" type="checkbox" id="airline{{@index}}" value="{{Code}}" onchange="flightFilteration();"><ins></ins>  
                <span class="img-wrap"><img src="https://asfartrip.com/public/assets/images/airline_logo/{{Code}}.png"></span>
                <span class="text-wrap"> {{Name}}</span>            
            </label>
            <span class="badge-list">
                <a href="javascript:;" class="only" onclick="checkOnly(this, 'airline');">Only</a>               
            </span>
        </div>
        {{/each}}
    </div>
</article> <!-- panel// -->	


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
            var site_currency = 'AED';
            $("#setMinPrice").text(site_currency + " " + ui.values[ 0 ]);
            $("#setMaxPrice").text(site_currency + " " + ui.values[ 1 ]);
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


<!--
<div class="find-hotel-popup hidden-xs hidden-sm hidden-md alert-dismiss">
    <div class="title"> Need a Hotel? <span class="close"> &times </span> </div>
    <div class="content">
        <img src="https://asfartrip.com/public/assets/images/icons/hotel-popup.png" style="width: 30px;" class="pull-left">
        <div class="text-wrap pull-left">
            <a href="/en/hotel/list?dest_code=DEL&country_code=IN&dest_name=New+Delhi&room_count=1&adult_count=2&child_count=0&adults1=2&childs1=0&city=New+Delhi&check_in=20-01-2022&check_out=20-01-2022&nights=0&SSID=g32n2dfg4kk6kohgvdh3g33rog6s5uak" target="_blank">
                <div class="subtitle text-dots" style=""> New Delhi Hotels</div>
                <span>20 Jan, 2022 <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i></span> <br>
                <span>20 Jan, 2022</span>
            </a>
        </div>
    </div>     
</div>-->
<style>
    .dot {
        height: 12px;
        width: 12px;
        background-color: rgba(255, 255, 255, 0.75);
        border-radius: 50%;
        display: inline-block;
    }
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
<?php $this->load->view('home/home_template/footer'); ?>

<script type="text/javascript">
	var api_array = <?php echo json_encode($api_list); ?>    
</script>
<script src="<?php echo base_url(); ?>assets/js/flight-listing.js" ></script>