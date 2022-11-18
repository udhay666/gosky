<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('home_template/header'); 
   // echo "<pre>21";print_r($this->session->all_userdata());
?>
<!-- ========================= SECTION INTRO ========================= -->
<style>
body{
    overflow-x:hidden;
}

@media only screen and (max-width: 768px) {
.vl{
display: none;
}
}

/* holiday blogs */
.ht_city {
width: 133px;
min-height: 165px;
float: left;
background: #fff;
box-shadow: 0 0 4px rgb(0 0 0 / 15%);
border: 1px solid #cecece;
border-radius: 4px;
margin-right: 15px;
cursor: pointer;
margin-bottom: 15px;
}
.ht_city:hover{
-webkit-transform: scale(1.3);
transform: scale(1.3);
}
.pop_city {
background: url(https://localhost/travelfreebuy.com/assets/images/holiday_blog/hotel-destination.jpg) no-repeat;
}
.city_goa {
width: 100%;
height: 90px;
display: block;
background-position: 0px 0px
px
;
}
.cityName {
font-size: 18px;
color: #000;
font-weight: 600;
padding: 6px 0 0 0;
text-align: center;
}
.avgPrice {
text-align: center;
font-size: 10px;
color: #000;
}
.city_mum {
width: 100%;
height: 90px;
display: block;
background-position: 0px -90px;
}
.city_del {
width: 100%;
height: 90px;
display: block;
background-position: 0px -180px;
}
.city_ban {
width: 100%;
height: 90px;
display: block;
background-position: 0px -270px;
}
.city_kol {
width: 100%;
height: 90px;
display: block;
background-position: -136px 0px;
}
.city_dub {
width: 100%;
height: 90px;
display: block;
background-position: -136px -90px;
}
.city_bang {
width: 100%;
height: 90px;
display: block;
background-position: -136px -180px;
}
.city_sing {
width: 100%;
height: 90px;
display: block;
background-position: -136px -270px;
}
.why{
    overflow: auto;
}

</style>
<?php $this->session->unset_userdata('hotel_search_activate'); ?>
<!-- ========================= SECTION INTRO ========================= -->
<section class="section-intro">
            <div class="container">
            <div class="tabs-wrap">
                <div class="tab-content p30">
                    <ul class="nav nav-pills">
                                    <li class="active"><a href="#flights" aria-controls="home" role="tab" data-toggle="tab"><i class="material-icons">&#xE195;</i> Flights</a></li>
                                    <li class=""><a href="#hotels" role="tab" data-toggle="tab">  <i class="material-icons">&#xE53A;</i> Hotels</a></li>
                                    <!-- <li class=""><a href="#cars" role="tab" data-toggle="tab"> <i class="material-icons">&#xE531;</i> Cars</a></li> -->
                                    <!-- <li class=""><a href="#insurance" role="tab" data-toggle="tab"> <i class="material-icons">&#xE32A;</i>  Insurance</a></li> -->
                                    <!-- <li class=""><a href="#transfer" role="tab" data-toggle="tab"> <i class="material-icons">&#xeb3c;</i>  Transfer</a></li> -->
                            </ul>
                            <article class="tab-pane fade in active" id="flights">
                <!-- -----------------  FLIGHT FORM -------------------- -->

                <div class="form-block">
<div class="trip-type">
<label class="btn-one-way active"> <input type="radio" checked="checked" value="oneway" name="trip_type_chk"> <span>One Way</span> </label>
<label class="btn-round-trip"> <input type="radio" value="round" name="trip_type_chk"> <span>Round-Trip</span> </label>
<label class="btn-multy-city"> <input type="radio" value="multicity" name="trip_type_chk"> <span>Multi-City</span> </label>
</div> <!--  trip-type //  -->
<section class="flight-tab-switcher" id="one-round-block">
<form class="flight-search-form" autocomplete="off" name="flight" id="flight" method="post" action="<?php echo base_url(); ?>flights/results">
    <div class="row-sm">
                        <div class="col-lg-10 col-md-10">                    
            <div class="row-sm">
                <div class="col-lg-6 col-md-5">
                    <div class="form-group-wrap">
                        <div class="input-wrap form-group">
                            <i class="material-icons">&#xE905;</i>
                            <input type="text" name="fromCity" value="" id="autocomplete221" placeholder="Flying from" class="autocomplete-airports ffrom" tabindex="1" required>
                            <!--                            <label class="nearby-check-wrap checkbox">
                                                            <input type="checkbox" name=""><ins></ins>
                                                            <span>Nearby Airports</span>
                                                        </label>                                -->
                        </div>
                        <div class="input-wrap form-group">
                            <i class="material-icons">&#xE904;</i>
                            <input type="text" name="toCity" value="" id="autocomplete2" tabindex="2" placeholder="Flying to" class="autocomplete-airports" required>  
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
                                <span class="month"></span>
                                <span class="day"></span>
                                <span class="dayname"></span>
                                <span class="year"></span>
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
                                <option value="1" selected='selected'> Economy</option>
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
        <input type="hidden" class="trip-type-hidden" id="tripType" name="tripType" value="oneway">
            <button type="submit" class="btn btn-search" tabindex="9"><i class="fa fa-search"></i>&nbsp;Search Flights</button>
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
        <button type="submit" class="btn btn-search" tabindex="9"><i class="fa fa-search"></i>&nbsp;Search Flights</button>
    </div><!--  col//  -->

</form>
</section>
<!--  flight-tab-switcher //  -->
<section class="flight-tab-switcher hide" id="multi-block">

<form class="flight-search-form" name="flight" id="flight" method="POST" action="<?php echo site_url() 
                                                      ?>flights/multi_results">
    <div class="row-sm">
        <div class="col-md-5 col-sm-8">
            <div class="form-group-wrap">
                <div class="input-wrap form-group">
                    <i class="material-icons">flight_takeoff</i>
                    <input type="text" name="fromCity[]" value="" id="fromCity1" class="autocomplete-airports fromCity" placeholder="Flying from" autocomplete="off" onclick="this.select();" required >
                    <!--                            <label class="nearby-check-wrap checkbox">
                                                    <input type="checkbox" name=""><ins></ins>
                                                    <span>Nearby Airports</span>
                                                </label>                                -->
                </div>
                <div class="input-wrap form-group">
                    <i class="material-icons">flight_land</i>
                    <input type="text" name="toCity[]" value="" id="toCity1" class="autocomplete-airports toCity" placeholder="Flying to" autocomplete="off" onclick="this.select();" required>
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
                    <img class="img-icon" src="<?php echo base_url(); ?>assets/images/icons/calendar-go.png">
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
                        <option value="1"> Economy</option>
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
            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i>&nbsp;Search Flights</button>
        </div><!--  col//  -->
    </div> <!-- row// -->
    <div id="flight-repeat-block">
        <div class="row-sm">
            <div class="col-sm-8 col-md-5">
                <div class="form-group-wrap">
                    <div class="input-wrap form-group">
                        <i class="material-icons">flight_takeoff</i>
                        <input type="text" name="fromCity[]" value="" id="fromCity2" class="autocomplete-airports from2" placeholder="Flying from" required>
                        <!--                                <label class="nearby-check-wrap checkbox">
                                                            <input type="checkbox" name=""><ins></ins>
                                                            <span>Nearby Airports</span>
                                                        </label>                                -->
                    </div>
                    <div class="input-wrap form-group">
                        <i class="material-icons">flight_land</i>
                        <input type="text" name="toCity[]" value="" id="toCity2" class="autocomplete-airports to2" placeholder="Flying to" required>  
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
                        <img class="img-icon" src="<?php echo base_url(); ?>assets/images/icons/calendar-go.png">
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
        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i>&nbsp;Search Flights</button>
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
        <input type="text" name="fromCity[]" value="" id="fromCity3" class="autocomplete-airports from3 clearable" placeholder="Flying from" required>
    </div>
    <div class="input-wrap form-group">
        <i class="material-icons">flight_land</i>
        <input type="text" name="toCity[]" value="" id="toCity3" class="autocomplete-airports to3 clearable" placeholder="Flying to" required>                                             
    </div>	
</div> <!--  form-group-wrap //  -->
</div><!--  col//  -->
<div class="col-md-2 col-sm-3">
<div class="form-group-wrap form-group">
    <div class="date-multi">
        <img class="img-icon" src="<?php echo base_url(); ?>assets/images/icons/calendar-go.png">
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
<script>
    $(document).ready(function(){
  if ( $('.btn-round-trip').hasClass('active') ) {   
    $("#tripType").val("round");
  }
});
</script>

                            <script type="text/javascript">
                                function changeDepartArrival() {

                                    var to = $("[name=toCity]").val();

                                    var from = $("[name=fromCity]").val();

                                    $("[name=toCity]").val(from);

                                    $("[name=fromCity]").val(to);

                                }



                                var form_valdator_el;

                                $(document).ready(function() {

                                    //One way form validator

                                    $("#one-round-block .flight-search-form").validator({

                                        disable: false,

                                        focus: false

                                    }).on('submit', function(e) {

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

                                    }).on('submit', function(e) {

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

                                        $("#multi-block input[name='mdepature[]']").each(function(i, val) {

                                            var fromData = $.datepicker.parseDate('dd-mm-yy', this.value);

                                            if (i !== 0) {

                                                if (fromData.getTime() < last_val.getTime()) {

                                                    valid = false;

                                                    show_footer_error("The departing dates must occur after the previous departing date");

                                                    return false;

                                                }

                                            }

                                            if ($("#multi-block input[name='fromCity[]']").eq(i).val() == $("#multi-block input[name='toCity[]']").eq(i).val()) {

                                                valid = false;

                                                show_footer_error("It looks like you're trying to travel to and from the same place! Please review and re-enter your origin and destination cities");

                                                return false;

                                            }

                                            last_val = fromData;

                                        });

                                        return valid;

                                    }



                                    $("#add-flight").on("click", function() {

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

                                    $(that).closest('.flight-block').hide('slow', function() {

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
                                $(window).load(function() {



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

                                        var dest_length = recentSearchMulti.fromCity.length;

                                        // create multicity blocks if more than 2

                                        if (dest_length > 2) {

                                            for (var i = 1; i <= (dest_length - 2); i++) {

                                                $("#add-flight").click();

                                            }

                                        }

                                        // Values filling in form

                                        var parent = $('#multi-block form#flight');

                                        for (var i = 0; i < dest_length; i++) {

                                            parent.find("input[name='fromCity[]']").eq(i).val(recentSearchMulti.fromCity[i]);

                                            parent.find("input[name='toCity[]']").eq(i).val(recentSearchMulti.toCity[i]); //mdepature

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
                                $(window).load(function() {



                                });
                            </script>


                <!-- -----------------  FLIGHT FORM END// -------------------- -->
            </article><!--  tab-pane //  -->
                            <article class="tab-pane fade " id="hotels">
                <!-- -----------------  HOTEL FORM -------------------- -->
                
<form class="form-validatorbt" action="<?php echo site_url(); ?>hotels/results" autocomplete="on"  role="form" method="POST">
<div class="gl__fieldset">
<div class="gl__input-group gl__search">
    <div class="input-wrap form-group ">
        <i class="flaticon-big-bed-with-one-pillow"></i>
        <input id="cityName" tabindex="1" type="text" name="cityName" value="" placeholder="Destination name/Hotel" class="hotel_autocomplete" required tabindex="1">
        <input id="target_search" name="target_search" type="hidden" value="">
        <input type="hidden" name="cityid" class="cityid" id="hotelcityid">
    </div>
</div>
<!-- <div class="gl__input-group gl__nationality">
    <div class="select-wrap form-group">
        <i class="fa fa-globe" aria-hidden="true"></i>                         
        <i class="arrow material-icons">&#xE5C5;</i>
        <select data-width="100%" data-height="100%" class="selectpicker" data-mobile="false" data-container="body" name="nationality" data-live-search="true" data-style="btn-select" tabindex="5" required title="Your Nationality">

                                    <option data-subtext="(Afghanistan)" value="AF"  >AF</option>
                                    <option data-subtext="(Åland Islands)" value="AX"  >AX</option>
                                    <option data-subtext="(Albania)" value="AL"  >AL</option>
                                    <option data-subtext="(Algeria)" value="DZ"  >DZ</option>
                                    <option data-subtext="(American Samoa)" value="AS"  >AS</option>
                                    <option data-subtext="(Andorra)" value="AD"  >AD</option>
                                    <option data-subtext="(Angola)" value="AO"  >AO</option>
                                    <option data-subtext="(Anguilla)" value="AI"  >AI</option>
                                    <option data-subtext="(Antarctica)" value="AQ"  >AQ</option>
                                    <option data-subtext="(Antigua and barbuda)" value="AG"  >AG</option>
                                    <option data-subtext="(Argentina)" value="AR"  >AR</option>
                                    <option data-subtext="(Armenia)" value="AM"  >AM</option>
                                    <option data-subtext="(Aruba)" value="AW"  >AW</option>
                                    <option data-subtext="(Aruba)" value="AA"  >AA</option>
                                    <option data-subtext="(Australia)" value="AU"  >AU</option>
                                    <option data-subtext="(Austria)" value="AT"  >AT</option>
                                    <option data-subtext="(Azerbaijan)" value="AZ"  >AZ</option>
                                    <option data-subtext="(Bahrain)" value="BH"  >BH</option>
                                    <option data-subtext="(Bangladesh)" value="BD"  >BD</option>
                                    <option data-subtext="(Barbados)" value="BB"  >BB</option>
                                    <option data-subtext="(Belarus)" value="BY"  >BY</option>
                                    <option data-subtext="(Belgium)" value="BE"  >BE</option>
                                    <option data-subtext="(Belize)" value="BZ"  >BZ</option>
                                    <option data-subtext="(Benin)" value="BJ"  >BJ</option>
                                    <option data-subtext="(Bermuda)" value="BM"  >BM</option>
                                    <option data-subtext="(Bhutan)" value="BT"  >BT</option>
                                    <option data-subtext="(Bolivia)" value="BO"  >BO</option>
                                    <option data-subtext="(Bonaire, Saint Eustatius and Saba)" value="BQ"  >BQ</option>
                                    <option data-subtext="(Bosnia and herzegovina)" value="BA"  >BA</option>
                                    <option data-subtext="(Botswana)" value="BW"  >BW</option>
                                    <option data-subtext="(Bouvet Island)" value="BV"  >BV</option>
                                    <option data-subtext="(Brazil)" value="BR"  >BR</option>
                                    <option data-subtext="(British Indian Ocean Territory)" value="IO"  >IO</option>
                                    <option data-subtext="(Brunei)" value="BN"  >BN</option>
                                    <option data-subtext="(Bulgaria)" value="BG"  >BG</option>
                                    <option data-subtext="(Burkina Faso)" value="BF"  >BF</option>
                                    <option data-subtext="(Burma/Myanmar)" value="MM"  >MM</option>
                                    <option data-subtext="(Burundi)" value="BI"  >BI</option>
                                    <option data-subtext="(Cambodia)" value="KH"  >KH</option>
                                    <option data-subtext="(Cameroon)" value="CM"  >CM</option>
                                    <option data-subtext="(Canada)" value="CA"  >CA</option>
                                    <option data-subtext="(Cape Verde)" value="CV"  >CV</option>
                                    <option data-subtext="(Cayman Islands)" value="KY"  >KY</option>
                                    <option data-subtext="(Central African Republic)" value="CF"  >CF</option>
                                    <option data-subtext="(Chad)" value="TD"  >TD</option>
                                    <option data-subtext="(Chile)" value="CL"  >CL</option>
                                    <option data-subtext="(China)" value="CN"  >CN</option>
                                    <option data-subtext="(Christmas Island)" value="CX"  >CX</option>
                                    <option data-subtext="(Cocos (Keeling) Islands)" value="CC"  >CC</option>
                                    <option data-subtext="(Colombia)" value="CO"  >CO</option>
                                    <option data-subtext="(Comores)" value="KM"  >KM</option>
                                    <option data-subtext="(Congo)" value="CG"  >CG</option>
                                    <option data-subtext="(Congo zaire)" value="CD"  >CD</option>
                                    <option data-subtext="(Cook Islands)" value="CK"  >CK</option>
                                    <option data-subtext="(Costa Rica)" value="CR"  >CR</option>
                                    <option data-subtext="(Cote d ivoire)" value="CI"  >CI</option>
                                    <option data-subtext="(Croatia)" value="HR"  >HR</option>
                                    <option data-subtext="(Cuba)" value="CU"  >CU</option>
                                    <option data-subtext="(Curaçao)" value="CW"  >CW</option>
                                    <option data-subtext="(Cyprus)" value="CY"  >CY</option>
                                    <option data-subtext="(Czech Republic)" value="CZ"  >CZ</option>
                                    <option data-subtext="(Denmark)" value="DK"  >DK</option>
                                    <option data-subtext="(Djibouti)" value="DJ"  >DJ</option>
                                    <option data-subtext="(Dominica)" value="DM"  >DM</option>
                                    <option data-subtext="(Dominican Republic)" value="DO"  >DO</option>
                                    <option data-subtext="(East Timor)" value="TL"  >TL</option>
                                    <option data-subtext="(Ecuador)" value="EC"  >EC</option>
                                    <option data-subtext="(Egypt)" value="EG"  >EG</option>
                                    <option data-subtext="(El Salvador)" value="SV"  >SV</option>
                                    <option data-subtext="(Equatorial Guinea)" value="GQ"  >GQ</option>
                                    <option data-subtext="(Eritrea)" value="ER"  >ER</option>
                                    <option data-subtext="(Estonia)" value="EE"  >EE</option>
                                    <option data-subtext="(Ethiopia)" value="ET"  >ET</option>
                                    <option data-subtext="(Falkland Islands (Malvinas))" value="FK"  >FK</option>
                                    <option data-subtext="(Faroe Islands)" value="FO"  >FO</option>
                                    <option data-subtext="(Fiji)" value="FJ"  >FJ</option>
                                    <option data-subtext="(Finland)" value="FI"  >FI</option>
                                    <option data-subtext="(France)" value="FR"  >FR</option>
                                    <option data-subtext="(France (Guadeloupe))" value="GP"  >GP</option>
                                    <option data-subtext="(France (Martinique))" value="MQ"  >MQ</option>
                                    <option data-subtext="(France (Réunion))" value="RE"  >RE</option>
                                    <option data-subtext="(French Guiana)" value="GF"  >GF</option>
                                    <option data-subtext="(French Polynesia)" value="PF"  >PF</option>
                                    <option data-subtext="(French Southern Territories)" value="TF"  >TF</option>
                                    <option data-subtext="(Gabon)" value="GA"  >GA</option>
                                    <option data-subtext="(Gambia)" value="GM"  >GM</option>
                                    <option data-subtext="(Georgia)" value="GE"  >GE</option>
                                    <option data-subtext="(Germany)" value="DE"  >DE</option>
                                    <option data-subtext="(Ghana)" value="GH"  >GH</option>
                                    <option data-subtext="(Gibraltar)" value="GI"  >GI</option>
                                    <option data-subtext="(Greece)" value="GR"  >GR</option>
                                    <option data-subtext="(Greenland)" value="GL"  >GL</option>
                                    <option data-subtext="(Grenada)" value="GD"  >GD</option>
                                    <option data-subtext="(Guam)" value="GU"  >GU</option>
                                    <option data-subtext="(Guatemala)" value="GT"  >GT</option>
                                    <option data-subtext="(Guernsey)" value="GG"  >GG</option>
                                    <option data-subtext="(Guinea)" value="GN"  >GN</option>
                                    <option data-subtext="(Guinea-bissau)" value="GW"  >GW</option>
                                    <option data-subtext="(Guyana)" value="GY"  >GY</option>
                                    <option data-subtext="(Haiti)" value="HT"  >HT</option>
                                    <option data-subtext="(Heard Island and McDonald Islands)" value="HM"  >HM</option>
                                    <option data-subtext="(Honduras)" value="HN"  >HN</option>
                                    <option data-subtext="(Hong Kong)" value="HK"  >HK</option>
                                    <option data-subtext="(Hungary)" value="HU"  >HU</option>
                                    <option data-subtext="(Iceland)" value="IS"  >IS</option>
                                    <option data-subtext="(India)" value="IN"  >IN</option>
                                    <option data-subtext="(Indonesia)" value="ID"  >ID</option>
                                    <option data-subtext="(Iran)" value="IR"  >IR</option>
                                    <option data-subtext="(Iraq)" value="IQ"  >IQ</option>
                                    <option data-subtext="(Ireland)" value="IE"  >IE</option>
                                    <option data-subtext="(Isle of Man)" value="IM"  >IM</option>
                                    <option data-subtext="(Israel)" value="IL"  >IL</option>
                                    <option data-subtext="(Italy)" value="IT"  >IT</option>
                                    <option data-subtext="(Jamaica)" value="JM"  >JM</option>
                                    <option data-subtext="(Japan)" value="JP"  >JP</option>
                                    <option data-subtext="(Jersey)" value="JE"  >JE</option>
                                    <option data-subtext="(Jordan)" value="JO"  >JO</option>
                                    <option data-subtext="(Kazakhstan)" value="KZ"  >KZ</option>
                                    <option data-subtext="(Kenya)" value="KE"  >KE</option>
                                    <option data-subtext="(Kiribati)" value="KI"  >KI</option>
                                    <option data-subtext="(Kuwait)" value="KW"  >KW</option>
                                    <option data-subtext="(Kyrgyzstan)" value="KG"  >KG</option>
                                    <option data-subtext="(Laos)" value="LA"  >LA</option>
                                    <option data-subtext="(Latvia)" value="LV"  >LV</option>
                                    <option data-subtext="(Lebanon)" value="LB"  >LB</option>
                                    <option data-subtext="(Lesotho)" value="LS"  >LS</option>
                                    <option data-subtext="(Liberia)" value="LR"  >LR</option>
                                    <option data-subtext="(Libya)" value="LY"  >LY</option>
                                    <option data-subtext="(Liechtenstein)" value="LI"  >LI</option>
                                    <option data-subtext="(Lithuania)" value="LT"  >LT</option>
                                    <option data-subtext="(Luxembourg)" value="LU"  >LU</option>
                                    <option data-subtext="(Macao)" value="MO"  >MO</option>
                                    <option data-subtext="(Macedonia)" value="MK"  >MK</option>
                                    <option data-subtext="(Madagascar)" value="MG"  >MG</option>
                                    <option data-subtext="(Malawi)" value="MW"  >MW</option>
                                    <option data-subtext="(Malaysia)" value="MY"  >MY</option>
                                    <option data-subtext="(Maldives)" value="MV"  >MV</option>
                                    <option data-subtext="(Mali)" value="ML"  >ML</option>
                                    <option data-subtext="(Malta)" value="MT"  >MT</option>
                                    <option data-subtext="(Marshall Islands)" value="MH"  >MH</option>
                                    <option data-subtext="(Mauritania)" value="MR"  >MR</option>
                                    <option data-subtext="(Mauritius)" value="MU"  >MU</option>
                                    <option data-subtext="(Mayotte)" value="YT"  >YT</option>
                                    <option data-subtext="(Mexico)" value="MX"  >MX</option>
                                    <option data-subtext="(Micronesia)" value="FM"  >FM</option>
                                    <option data-subtext="(Moldova)" value="MD"  >MD</option>
                                    <option data-subtext="(Monaco)" value="MC"  >MC</option>
                                    <option data-subtext="(Mongolia)" value="MN"  >MN</option>
                                    <option data-subtext="(Montserrat)" value="MS"  >MS</option>
                                    <option data-subtext="(Morocco)" value="MA"  >MA</option>
                                    <option data-subtext="(Mozambique)" value="MZ"  >MZ</option>
                                    <option data-subtext="(Namibia)" value="NA"  >NA</option>
                                    <option data-subtext="(Nauru)" value="NR"  >NR</option>
                                    <option data-subtext="(Nepal)" value="NP"  >NP</option>
                                    <option data-subtext="(Netherlands)" value="NL"  >NL</option>
                                    <option data-subtext="(New Caledonia)" value="NC"  >NC</option>
                                    <option data-subtext="(New Zealand)" value="NZ"  >NZ</option>
                                    <option data-subtext="(Nicaragua)" value="NI"  >NI</option>
                                    <option data-subtext="(Niger)" value="NE"  >NE</option>
                                    <option data-subtext="(Nigeria)" value="NG"  >NG</option>
                                    <option data-subtext="(Niue)" value="NU"  >NU</option>
                                    <option data-subtext="(Norfolk Island)" value="NF"  >NF</option>
                                    <option data-subtext="(North korea)" value="KP"  >KP</option>
                                    <option data-subtext="(Northern Mariana Islands)" value="MP"  >MP</option>
                                    <option data-subtext="(Norway)" value="NO"  >NO</option>
                                    <option data-subtext="(Oman)" value="OM"  >OM</option>
                                    <option data-subtext="(Pakistan)" value="PK"  >PK</option>
                                    <option data-subtext="(Palau)" value="PW"  >PW</option>
                                    <option data-subtext="(Palestinian Territory, Occupied)" value="PS"  >PS</option>
                                    <option data-subtext="(Panama)" value="PA"  >PA</option>
                                    <option data-subtext="(Papua New Guinea)" value="PG"  >PG</option>
                                    <option data-subtext="(Paraguay)" value="PY"  >PY</option>
                                    <option data-subtext="(Peru)" value="PE"  >PE</option>
                                    <option data-subtext="(Philippines)" value="PH"  >PH</option>
                                    <option data-subtext="(Pitcairn)" value="PN"  >PN</option>
                                    <option data-subtext="(Poland)" value="PL"  >PL</option>
                                    <option data-subtext="(Portugal)" value="PT"  >PT</option>
                                    <option data-subtext="(Puerto Rico)" value="PR"  >PR</option>
                                    <option data-subtext="(Qatar)" value="QA"  >QA</option>
                                    <option data-subtext="(Romania)" value="RO"  >RO</option>
                                    <option data-subtext="(Russia)" value="RU"  >RU</option>
                                    <option data-subtext="(Rwanda)" value="RW"  >RW</option>
                                    <option data-subtext="(Saint Barthélemy)" value="BL"  >BL</option>
                                    <option data-subtext="(Saint Helena, Ascension and Tristan da Cunha)" value="SH"  >SH</option>
                                    <option data-subtext="(Saint Kitts and Nevis)" value="KN"  >KN</option>
                                    <option data-subtext="(Saint Lucia)" value="LC"  >LC</option>
                                    <option data-subtext="(Saint Martin (French part))" value="MF"  >MF</option>
                                    <option data-subtext="(Saint Pierre and Miquelon)" value="PM"  >PM</option>
                                    <option data-subtext="(Saint Vincent and the Grenadines)" value="VC"  >VC</option>
                                    <option data-subtext="(Samoa)" value="WS"  >WS</option>
                                    <option data-subtext="(San Marino)" value="SM"  >SM</option>
                                    <option data-subtext="(Sao Tome and Principe)" value="ST"  >ST</option>
                                    <option data-subtext="(Saudi Arabia)" value="SA"  >SA</option>
                                    <option data-subtext="(Senegal)" value="SN"  >SN</option>
                                    <option data-subtext="(Serbia)" value="RS"  >RS</option>
                                    <option data-subtext="(Seychelles)" value="SC"  >SC</option>
                                    <option data-subtext="(Sierra Leone)" value="SL"  >SL</option>
                                    <option data-subtext="(Singapore)" value="SG"  >SG</option>
                                    <option data-subtext="(Sint Maarten (Dutch part))" value="SX"  >SX</option>
                                    <option data-subtext="(Slovakia)" value="SK"  >SK</option>
                                    <option data-subtext="(Slovenia)" value="SI"  >SI</option>
                                    <option data-subtext="(Solomon Islands)" value="SB"  >SB</option>
                                    <option data-subtext="(Somalia)" value="SO"  >SO</option>
                                    <option data-subtext="(South Africa)" value="ZA"  >ZA</option>
                                    <option data-subtext="(South Georgia and the South Sandwich Islands)" value="GS"  >GS</option>
                                    <option data-subtext="(South korea)" value="KR"  >KR</option>
                                    <option data-subtext="(Spain)" value="ES"  >ES</option>
                                    <option data-subtext="(Sri Lanka)" value="LK"  >LK</option>
                                    <option data-subtext="(Sudan)" value="SD"  >SD</option>
                                    <option data-subtext="(Suriname)" value="SR"  >SR</option>
                                    <option data-subtext="(Svalbard and Jan Mayen)" value="SJ"  >SJ</option>
                                    <option data-subtext="(Swaziland)" value="SZ"  >SZ</option>
                                    <option data-subtext="(Sweden)" value="SE"  >SE</option>
                                    <option data-subtext="(Switzerland)" value="CH"  >CH</option>
                                    <option data-subtext="(Syria)" value="SY"  >SY</option>
                                    <option data-subtext="(Taiwan)" value="TW"  >TW</option>
                                    <option data-subtext="(Tajikistan)" value="TJ"  >TJ</option>
                                    <option data-subtext="(Tanzania)" value="TZ"  >TZ</option>
                                    <option data-subtext="(Thailand)" value="TH"  >TH</option>
                                    <option data-subtext="(The Bahamas)" value="BS"  >BS</option>
                                    <option data-subtext="(Togo)" value="TG"  >TG</option>
                                    <option data-subtext="(Tokelau)" value="TK"  >TK</option>
                                    <option data-subtext="(Tonga)" value="TO"  >TO</option>
                                    <option data-subtext="(Trinidad and Tobago)" value="TT"  >TT</option>
                                    <option data-subtext="(Tunisia)" value="TN"  >TN</option>
                                    <option data-subtext="(Turkey)" value="TR"  >TR</option>
                                    <option data-subtext="(Turkmenistan)" value="TM"  >TM</option>
                                    <option data-subtext="(Turks and Caicos Islands)" value="TC"  >TC</option>
                                    <option data-subtext="(Tuvalu)" value="TV"  >TV</option>
                                    <option data-subtext="(Uganda)" value="UG"  >UG</option>
                                    <option data-subtext="(Ukraine)" value="UA"  >UA</option>
                                    <option data-subtext="(United Arab Emirates)" value="AE" Selected >AE</option>
                                    <option data-subtext="(United Kingdom)" value="GB"  >GB</option>
                                    <option data-subtext="(United States)" value="US"  >US</option>
                                    <option data-subtext="(United States minor outlying islands)" value="UM"  >UM</option>
                                    <option data-subtext="(Uruguay)" value="UY"  >UY</option>
                                    <option data-subtext="(Uzbekistan)" value="UZ"  >UZ</option>
                                    <option data-subtext="(Vanuatu)" value="VU"  >VU</option>
                                    <option data-subtext="(Vatican city)" value="VA"  >VA</option>
                                    <option data-subtext="(Venezuela)" value="VE"  >VE</option>
                                    <option data-subtext="(Vietnam)" value="VN"  >VN</option>
                                    <option data-subtext="(Virgin Islands, British)" value="VG"  >VG</option>
                                    <option data-subtext="(Virgin Islands, United States)" value="VI"  >VI</option>
                                    <option data-subtext="(Wallis and Futuna)" value="WF"  >WF</option>
                                    <option data-subtext="(Western Sahara)" value="EH"  >EH</option>
                                    <option data-subtext="(Yemen)" value="YE"  >YE</option>
                                    <option data-subtext="(Yugoslavia/Serbia And Montenegro)" value="ME"  >ME</option>
                                    <option data-subtext="(Zambia)" value="ZM"  >ZM</option>
                                    <option data-subtext="(Zimbabwe)" value="ZW"  >ZW</option>
                            </select> 
                            <span class="alert-insurance-date alert-dismiss" style="z-index: 1;">
                <span class="close">&times</span>
                Specify your nationality
            </span>
                    </div>

</div> -->
<div class="gl__input-group gl__date">
    <div class="input-wrap form-group">
        <i class="material-icons">&#xE916;</i>                 
        <input type="text" id="hotel-daterange" required="required" name="hotel_daterange" placeholder="Check in - Check out" readonly="readonly" style="cursor:pointer;" tabindex="2">
        <input type="hidden" id="hrange_checkin" required="required" name="check_in" value="">
        <input type="hidden" id="hrange_checkout" required="required" name="check_out" value="">
    </div>
</div>
<div class="gl__input-group gl__guests">
    <div class="form-single-wrap" style="margin-bottom: 0px;">
        <div class="input-wrap occupancy-change">
            <i class="material-icons">&#xE7FD;</i>
            <p class="input-static"><span id="occ-room-count" tabindex="4">1</span> Room, <span id="occ-adult-count">2</span> Adults, <span id="occ-child-count">0</span> Childs</p>
            <i class="arrow material-icons">&#xE5C5;</i>                              
        </div>
        <div class="occupancy-dropdown" style="display:none;" role="menu">
            <article class="row-sm room-count">
                <label class="col-sm-8 col-xs-6 text-primary b">Rooms</label>
                <div class="col-sm-4 col-xs-6">
                    <div class="input-group pull-right">
                        <span class="input-group-btn">
                            <button class="btn btn-default number-spinner" data-field="room_count" data-type="minus"> <i class="fa fa-minus"></i></button>
                        </span>
                        <input type="text" class="form-control text-center spinner-value" name="room_count" id="room_count" value="1" max="4" min="1" readonly="readonly">
                        <span class="input-group-btn">
                            <button class="btn btn-default number-spinner" data-field="room_count" data-type="plus"><i class="fa fa-plus"></i></button>
                        </span>
                    </div> <!--  input-group number-spinner //  -->
                </div> <!-- col// -->
            </article>
            <div id="rooms-repeat-block">
                                                <div id="room-1">
                            <h5 class="title"><i class="fa fa-hotel"></i>&nbsp;&nbsp;Room 1</h5>
                            <div class="item-occupancy cfx" id="child-age-block-1">
                                <div class="item-people">
                                    <label> <i class="fa fa-male"></i>  Adults</label>
                                    <select id='adults-1' class="form-control" onchange="countOccupancies()" name="adults1">
                                        <option  value="1">1</option>
                                        <option selected value="2">2</option>
                                        <option  value="3">3</option>
                                        <option  value="4">4</option>
                                        <option  value="5">5</option>
                                        <option  value="6">6</option>
                                    </select>
                                </div>
                                <div class="item-people">
                                    <label><i class="fa fa-child"></i> Childs</label>
                                    <select id="children-1" class="form-control" name="childs1" onchange="renderAgeDropdown(this, 1)">
                                        <option selected value="0">0</option>
                                        <option  value="1">1</option>
                                        <option  value="2">2</option>
                                        <option  value="3">3</option>
                                        <option  value="4">4</option>
                                    </select>
                                </div>                                        
                                                                    </div> <!-- children-age-wrap // -->
                        </div>

                                            </div>
            <p id="checkout-date-txt-block" class="small text-muted hide" style="margin-bottom: 5px;"><i class="fa fa-info-circle"></i>&nbsp;Age of Childs at&nbsp;<span class="b" id="checkout-date-txt"></span></p>
            <!-- children-age-wrap // -->
            <a href="javascript:;" class="btn btn-warning btn-block btn-ok text-uppercase"> ok </a>                    
        </div> <!--  occupancy-dropdown end //  -->
    </div> <!--  form-single-wrap //  -->
</div>
<div class="gl__input-group gl__submit-button"><button class="btn btn-warning" type="submit">Search Hotels</button></div>
</div>    
</form>

<span class="recent-search-txt hidden hide-xs">Recently Searched: <span id="recent-search"></span></span>

<script id="room-repeat-template" type="text/x-handlebars-template" defer="defer">
<div id="room-{{roomNumber}}">
<h5 class="title"><i class="fa fa-hotel"></i>&nbsp;&nbsp;Room {{roomNumber}}</h5>
<div class="item-occupancy cfx" id="child-age-block-{{roomNumber}}">
<div class="item-people">
    <label> <i class="fa fa-male"></i>  Adults</label>
    <select id='adults-{{roomNumber}}' class="form-control" onchange="countOccupancies()" name="adults{{roomNumber}}">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
    </select>
</div>
<div class="item-people">
    <label><i class="fa fa-child"></i> Childs</label>
    <select id="children-{{roomNumber}}" class="form-control" name="childs{{roomNumber}}" onchange="renderAgeDropdown(this, {{roomNumber}})">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>
</div>
   
</div> <!-- children-age-wrap // -->
</div>
</script>

<script id="child-age-repeat-template" type="text/x-handlebars-template" defer="defer">           
<div class="item-people age-child" id="child-{{roomNumber}}-{{childNumber}}">
        <label>Age {{childNumber}}</label>
<select id="childage-{{roomNumber}}-{{childNumber}}" class="form-control" name="child_age{{roomNumber}}_{{childNumber}}">            
    <option value="0">1</option>            
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
            </select>
</div>
</script>                        <!-- -----------------  HOTEL FORM END// -------------------- -->
            </article><!--  tab-pane //  -->
                            <article class="tab-pane fade " id="cars">
                <!-- -----------------  CARS FORM -------------------- -->
                <!-- -----------------  CAR RENT FORM -------------------- -->
<section id="car-block">
<form class="form-validatorbt" autocomplete="off" method="POST" name="car" id="car" action="#">   
<div class="row-sm">
    <div class="col-sm-12 col-md-6">
        <div class="form-group-wrap">
            <div class="input-wrap form-group">
                <i class="material-icons">&#xE55F;</i>
                <input type="text" name="pickup" value="" class="autocomplete-carlocations" placeholder="Pick-up location" required>                              
            </div>
            <div class="input-wrap form-group">
                <i class="material-icons">&#xE55F;</i>
                <input type="text" name="dropoff" value="" class="autocomplete-carlocations" placeholder="Drop-off location" required>  
                <label class="same-location-check-wrap checkbox">
                    <input type="checkbox" name="same_location" onclick="samelocation();"><ins></ins>
                    <span>Same Pick-up</span>
                </label>                             
            </div>	
        </div> <!-- form-group wrap.// -->
    </div><!--  col//  -->
    <div class="col-sm-4 col-md-2">
        <div class="form-group-wrap">
            <div class="input-wrap form-group">
                <i class="material-icons">&#xE916;</i>
                <input type="text" name="pickup_date" value="" readonly="true" autocomplete="off" class="from-date" placeholder="Pick-up Date" required>                              
            </div>
            <div class="input-wrap form-group">
                <i class="material-icons">&#xE8B5;</i>
                <input type="text" name="pickup_time" value="" id="from-timepicker" placeholder="Pick-up time" required>                            
            </div>	
        </div> <!-- form-group wrap.// -->
    </div><!--  col//  -->
    <div class="col-sm-4 col-md-2">
        <div class="form-group-wrap">
            <div class="input-wrap form-group">
                <i class="material-icons">&#xE916;</i>
                <input type="text" name="dropoff_date" value="" readonly="true" autocomplete="off" class="to-date" placeholder="Drop-off Date" required>                              
            </div>
            <div class="input-wrap form-group">
                <i class="material-icons">&#xE8B5;</i>
                <input type="text" name="dropoff_time" value="" id="to-timepicker" placeholder="Drop-off time" required>                            
            </div>	
        </div> <!-- form-group wrap.// -->
    </div><!--  col//  -->
    <div class="col-sm-4 col-md-2">
        <button type="submit" class="btn btn-search"> <i class="fa fa-search"></i> Search Cars</button>
    </div><!--  col//  -->
</div> <!-- row// -->
</form>
</section>
<!-- -----------------  CAR RENT END// -------------------- -->
<script type="text/javascript">
$(window).load(function () {
var recent = $.cookie('car-recent-search');
if (recent) {
    var recentSearch = $.parseJSON(recent);
    $("#car-block input[name=pickup]").val(recentSearch.pickup);
    $("#car-block input[name=dropoff]").val(recentSearch.dropoff);
    $("#car-block input[name=pickup_time]").val(recentSearch.pickup_time);
    $("#car-block input[name=dropoff_time]").val(recentSearch.dropoff_time);
    // cookie Departure and return date set to form
    var departure = new Date($.datepicker.parseDate("dd-mm-yy", recentSearch.pickup_date));
    if (departure > new Date()) {
        $("#car-block input[name=pickup_date]").datepicker("setDate", departure);
        $("#car-block input[name=dropoff_date]").datepicker("setDate", new Date($.datepicker.parseDate("dd-mm-yy", recentSearch.dropoff_date)));
        departure.setDate(departure.getDate() + 1);
        $("#car-block input[name=dropoff_date]").datepicker("option", "minDate", departure);
    }
}
});
function samelocation() {
var to = $("[name=pickup]").val();
$("[name=dropoff]").val(to);
}
</script>                        <!-- -----------------  CARS FORM END// -------------------- -->
            </article><!--  tab-pane //  -->
                            <article class="tab-pane fade " id="insurance">
                <!-- -----------------  INSURANCE FORM -------------------- -->                                        
                <section id="insurance-block">
<form autocomplete="off" name="insurance_form" id="insurance-form" action="#">

<div class="row-sm">
    <div class="col-md-5 col-sm-12">
        <div class="form-group-wrap ">
            <div class="input-wrap form-group">
                <i class="material-icons">&#xE905;</i>
                <input type="text" name="from" value="" id="autocomplete1" class="autocomplete-airports" placeholder="Flying from" required>                               
            </div>
            <div class="input-wrap form-group">
                <i class="material-icons">&#xE904;</i>
                <input type="text" name="to" value="" id="autocomplete2" class="autocomplete-airports" placeholder="Flying to" required>                              
            </div>	
        </div> <!--  form-group-wrap //  -->
    </div><!--  col//  -->
    <div class="col-md-3 col-sm-8">
        <div class="form-group-wrap">
            <div class="date-wrap date-from">
                <img class="img-icon" src="<?php echo base_url(); ?>assets/images/icons/calendar-go.png">
                <input type="text" name="depature"  class="from-date" readonly="true" autocomplete="off"> 
                <p class="datetime">
                    <span class="month"></span>
                    <span class="day"></span>
                    <span class="dayname"></span>
                    <span class="year"></span>
                </p>                 
            </div> <!-- date-wrap// -->
            <span class="alert-insurance-date hidden-xs alert-dismiss">
                <span class="close">&times</span>
                If you are travelling one way, then please select Return Date the next day of your travel.</span>

            <div class="date-wrap date-return">

                <img class="img-icon" src="<?php echo base_url(); ?>assets/images/icons/calendar-back.png">
                <input type="text" name="return"  class="to-date" readonly="true" autocomplete="off"> 
                <p class="datetime">
                    <span class="month"></span>
                    <span class="day"></span>
                    <span class="dayname"></span>
                    <span class="year"></span>
                </p>
            </div> <!-- date-wrap// -->
        </div> <!--  form-group-wrap //  -->
    </div><!--  col//  -->
    <div class="col-md-2 col-sm-4">
        <div class="form-group-wrap">
            <div class="select-wrap select-lg">
                <a href="#" class="passenger-change">
                    <p class="passenger-type-wrap">
                        <span class="person"><b class="icon lg fa fa-male"></b> Adults: <span id="adult-count">1</span></span>  
                        <span class="person"><b class="icon sm fa fa-child"></b> Childs: <span id="child-count">0</span></span> 
                        <span class="person"><b class="icon material-icons">&#xEB42;</b> Infants: <span id="infant_count">0</span></span> 
                    </p>
                </a>
                <div class="passenger-dropdown" role="menu">
                    <div class="row no-gutter">
                        <p class="col-sm-7"> Adults (12+) </p>
                        <div class="col-sm-5">
                            <div class="input-group input-group-sm pull-right">
                                <span class="input-group-btn">
                                    <button class="btn btn-default number-spinner-insurance" data-field="adult_count" data-type="minus"> <span class="fa fa-minus"></span></button>
                                </span>
                                <input type="text" class="form-control text-center spinner-value-insurance" name="adult_count" id="adult_count" value="1" max="9" min="1" readonly="readonly">
                                <span class="input-group-btn">
                                    <button class="btn btn-default number-spinner-insurance" data-field="adult_count" data-type="plus"><span class="fa fa-plus"></span></button>
                                </span>
                            </div> <!--  input-group number-spinner //  -->
                        </div> <!-- col// -->
                    </div> <!-- row// -->

                    <div class="row no-gutter">
                        <p class="col-sm-7"> Childs (2-12) </p>
                        <div class="col-sm-5">
                            <div class="input-group input-group-sm pull-right">
                                <span class="input-group-btn">
                                    <button class="btn btn-default number-spinner-insurance" data-field="child_count" data-type="minus"> <span class="fa fa-minus"></span></button>
                                </span>
                                <input type="text" class="form-control text-center spinner-value-insurance" name="child_count" id="child_count" value="0" max="9" min="0" readonly="readonly">
                                <span class="input-group-btn">
                                    <button class="btn btn-default number-spinner-insurance" data-field="child_count" data-type="plus"><span class="fa fa-plus"></span></button>
                                </span>
                            </div> <!--  input-group number-spinner //  -->
                        </div> <!-- col// -->
                    </div> <!-- row// -->

                    <div class="row no-gutter">
                        <p class="col-sm-7"> Infants (0-2) </p>
                        <div class="col-sm-5">
                            <div class="input-group input-group-sm pull-right">
                                <span class="input-group-btn">
                                    <button class="btn btn-default number-spinner-insurance" data-field="infant_count" data-type="minus"> <span class="fa fa-minus"></span></button>
                                </span>
                                <input type="text" class="form-control text-center spinner-value-insurance" name="infant_count" id="infant_count" value="0" max="5" min="0" readonly="readonly">
                                <span class="input-group-btn">
                                    <button class="btn btn-default number-spinner-insurance" data-field="infant_count" data-type="plus"><span class="fa fa-plus"></span></button>
                                </span>
                            </div> <!--  input-group number-spinner //  -->
                        </div> <!-- col// -->
                    </div> <!-- row// -->

                    <a href="javascript:;" class="btn btn-warning btn-block btn-ok text-uppercase"> ok </a>
                </div>   <!-- passenger-dropdown //  -->                       
            </div>
        </div>
    </div><!--  col//  -->
    <div class="col-md-2 col-sm-12">
        <button type="submit" class="btn btn-search"><i class="fa fa-chevron-right"></i>&nbsp; Get Quote </button> 
    </div><!--  col//  -->
</div> <!-- row// -->
</form>
</section>

<script type="text/javascript" defer>
$(document).ready(function () {
$("#insurance-form").validator({
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
});
$(window).load(function () {
var recent = $.cookie('insurance-recent-search');
if (recent) {
    var recentSearch = $.parseJSON(recent);

    $("#insurance-form input[name=from]").val(recentSearch.from);
    $("#insurance-form input[name=to]").val(recentSearch.to);

    $("#insurance-form input[name=adult_count]").val(recentSearch.adult_count);
    $("#insurance-form input[name=child_count]").val(recentSearch.child_count);
    $("#insurance-form input[name=infant_count]").val(recentSearch.infant_count);
    $("#insurance-form #adult-count").text(recentSearch.adult_count);
    $("#insurance-form #child-count").text(recentSearch.child_count);
    $("#insurance-form #infant_count").text(recentSearch.infant_count);

    // cookie Departure and return date set to form
    var departure = new Date($.datepicker.parseDate("dd-mm-yy", recentSearch.depature));
    if (departure > new Date()) {
        $("#insurance-form input[name=depature]").datepicker("setDate", new Date($.datepicker.parseDate("dd-mm-yy", recentSearch.depature)));
        populateDate($("#insurance-form input[name=depature]"), $("#insurance-form input[name=depature]").datepicker("getDate"));
        $("#insurance-form input[name=return]").datepicker("setDate", new Date($.datepicker.parseDate("dd-mm-yy", recentSearch.return)));
        departure.setDate(departure.getDate() + 1);
        $("#insurance-form input[name=return]").datepicker("option", "minDate", departure);
        populateDate($("#insurance-form input[name=return]"), $("#insurance-form input[name=return]").datepicker("getDate"));

    }
}
});
</script>                    
                <!-- -----------------  INSURANCE FORM END// -------------------- -->
            </article><!--  tab-pane //  -->
                            <article class="tab-pane fade " id="transfer">
                <!-- -----------------  INSURANCE FORM -------------------- -->                                        
                <!-- -----------------  CAR RENT FORM -------------------- -->
<section id="transfer-block">
<form method="get" action="#/search">
<div class="row-sm">
<div class="col-sm-6">
<div class="form-group-wrap">
  <div class="input-wrap">
    <i class="material-icons">location_on</i>
    <input type="text" name="pickup_name" class="transfer_destination_autocomplete" value="" id="autocompletetransfer1"
           placeholder="Pick-up location" required>
    <input type="hidden" name="pickup_code" id="pickup_code" value="">
    <input type="hidden" name="pickup_typecode" id="pickup_typecode" value="">

  </div>
  <div class="input-wrap">
    <i class="material-icons">location_on</i>
    <input type="text" name="dropoff_name" class="transfer_destination_autocomplete" value="" id="autocompletetransfer2"
           placeholder="Drop-off location">
    <input type="hidden" name="dropoff_code" id="dropoff_code" value="">
    <input type="hidden" name="dropoff_typecode" id="dropoff_typecode" value="">
  </div>
</div> <!-- form-group wrap.// -->
</div><!--  col//  -->
<div class="col-sm-2">
<div class="form-group-wrap">
  <div class="input-wrap">
    <i class="material-icons">date_range</i>
    <input type="text" name="pickup_date" value="" id="transfer_pickup_date" class="from-date" placeholder="Arrival date">
  </div>
  <div class="input-wrap">
    <i class="material-icons">schedule</i>
    <input type="text" name="pickup_time" value="" class="timepicker" id="transfer-from-timepicker" placeholder="Arrival time">
  </div>
</div> <!-- form-group wrap.// -->
</div><!--  col//  -->
<div class="col-sm-2">
<div class="form-group-wrap">
  <div class="input-wrap">
    <i class="material-icons">date_range</i>
    <input type="text" name="dropoff_date" id="transfer_dropoff_date" value="" class="to-date" placeholder="Departure date">
  </div>
  <div class="input-wrap">
    <i class="material-icons">schedule</i>
    <input type="text" name="dropoff_time" value="" class="timepicker" id="transfer-to-timepicker" placeholder="Departure time">
  </div>
</div> <!-- form-group wrap.// -->
</div><!--  col//  -->
<div class="col-sm-2">
<button type="submit" class="btn btn-search"><i class="fa fa-search"></i> Search</button>
</div><!--  col//  -->
</div> <!-- row// -->
<div class="row-sm m15">
<div class="col-sm-3">
<div class="switch-wrap">
  <p>Return?</p>
  <label class="switch">
    <input type="checkbox" name="return">
    <span class="slider">YES</span>
  </label>

</div>
</div>
<div class="col-sm-3">
<div class="select-wrap2">
  <select name="adults" class="form-control " data-style="btn-select">
    <option disabled selected value="1">Adults (12+)</option>
    <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option><option value="60">60</option><option value="61">61</option><option value="62">62</option><option value="63">63</option><option value="64">64</option><option value="65">65</option><option value="66">66</option><option value="67">67</option><option value="68">68</option><option value="69">69</option><option value="70">70</option><option value="71">71</option><option value="72">72</option><option value="73">73</option><option value="74">74</option><option value="75">75</option><option value="76">76</option><option value="77">77</option><option value="78">78</option><option value="79">79</option><option value="80">80</option><option value="81">81</option><option value="82">82</option><option value="83">83</option><option value="84">84</option><option value="85">85</option><option value="86">86</option><option value="87">87</option><option value="88">88</option><option value="89">89</option><option value="90">90</option><option value="91">91</option><option value="92">92</option><option value="93">93</option><option value="94">94</option><option value="95">95</option><option value="96">96</option><option value="97">97</option><option value="98">98</option><option value="99">99</option><option value="100">100</option>          </select>
</div>
</div>
<div class=" col-sm-2">
<div class="select-wrap2">
  <select name="children" class="form-control " data-style="btn-select">
    <option disabled selected value="0">Children (3-11)</option>
    <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option><option value="60">60</option><option value="61">61</option><option value="62">62</option><option value="63">63</option><option value="64">64</option><option value="65">65</option><option value="66">66</option><option value="67">67</option><option value="68">68</option><option value="69">69</option><option value="70">70</option><option value="71">71</option><option value="72">72</option><option value="73">73</option><option value="74">74</option><option value="75">75</option><option value="76">76</option><option value="77">77</option><option value="78">78</option><option value="79">79</option><option value="80">80</option><option value="81">81</option><option value="82">82</option><option value="83">83</option><option value="84">84</option><option value="85">85</option><option value="86">86</option><option value="87">87</option><option value="88">88</option><option value="89">89</option><option value="90">90</option><option value="91">91</option><option value="92">92</option><option value="93">93</option><option value="94">94</option><option value="95">95</option><option value="96">96</option><option value="97">97</option><option value="98">98</option><option value="99">99</option><option value="100">100</option>          </select>
</div>
</div>
<div class="col-sm-2">
<div class="select-wrap2">
  <select name="infants" class="form-control " data-style="btn-select">
    <option disabled selected value="0">Infants (0-2)</option>
    <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option><option value="60">60</option><option value="61">61</option><option value="62">62</option><option value="63">63</option><option value="64">64</option><option value="65">65</option><option value="66">66</option><option value="67">67</option><option value="68">68</option><option value="69">69</option><option value="70">70</option><option value="71">71</option><option value="72">72</option><option value="73">73</option><option value="74">74</option><option value="75">75</option><option value="76">76</option><option value="77">77</option><option value="78">78</option><option value="79">79</option><option value="80">80</option><option value="81">81</option><option value="82">82</option><option value="83">83</option><option value="84">84</option><option value="85">85</option><option value="86">86</option><option value="87">87</option><option value="88">88</option><option value="89">89</option><option value="90">90</option><option value="91">91</option><option value="92">92</option><option value="93">93</option><option value="94">94</option><option value="95">95</option><option value="96">96</option><option value="97">97</option><option value="98">98</option><option value="99">99</option><option value="100">100</option>          </select>
</div>
</div>
</div>

</form>
</section>
<script src="<?php echo base_url(); ?>assets/js/transfer_scripts.js"></script>                    
                <!-- -----------------  INSURANCE FORM END// -------------------- -->
            </article><!--  tab-pane //  -->
                    </div><!--  tab-content //  -->
</div><!--  tabs-wrap //  -->
</div> <!-- container //  -->
</section>
<!-- ========================= SECTION INTRO END// ========================= -->

<!-- ========================= SECTION INTRO END// ========================= -->

<br>
<div class="container">
<div class="row" style="background-color:#c9dbf2;">
<div class="col-sm-8" style="text-align:center;">
    <h2 class="title center" style="color: #13406e;text-align: center;padding: 20px;text-decoration: underline;">Travelling during COVID-19</h2>
    <p>All you need to know from booking your flight to arriving at your destination.<br> Check out the latest requirements and what's open for travel.</p><br>
    <a target="_blank" href="#" style="width: 150px;" class="btn btn-warning">Know More</a>
</div>
<div class="col-sm-4">
    <img src="<?php echo base_url(); ?>assets/images/banner/covid-19.png">
</div>
</div>
</div>


<!-- ========================= SECTION OFFERS ========================= -->
<!-- ========================= SECTION OFFERS ========================= -->
<section class="section-offers">
<div class="container">

<header class="section-heading">
    <h2 class="section-title  text-uppercase">Holiday <span>Offers</span></h2>
    <span class="separator"> <i class="material-icons">star</i> </span>
</header><!-- section-heading -->

<div class="caro1 owl-carousel owl-theme">
      
        <div class="col-sm-12 col-xs-12 element-item flight">
            <article class="card card-deal">
                <div class="card__img-wrap">                          
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/holidays/sochi.jpg" class="lazyload" alt="Sochi">
                    <h4 class="title title-overlay-bottom">Sochi</h4>
                </div>
                <div class="card__info">
                    <p>Sochi, a Russian city on the Black Sea, is known as a summer beach resort. Its parks include the palm-filled Arboretum. It's also notable for 20th-century neoclassical buildings such as the columned Winter Theatre.</p>
                    <hr>
                    <p class="pull-left valid-date"> <i class="fa fa-clock-o"></i> Valid from: Mar 05, 2020</p>
                    <a href="#/custom/sochi-5-days" class="btn btn-warning pull-right">View More</a> 
                </div>
            </article><!--  card //  -->
        </div><!-- col // -->
      
        <div class="col-sm-12 col-xs-12 element-item flight">
            <article class="card card-deal">
                <div class="card__img-wrap">                          
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/holidays/poland.jpg" class="lazyload" alt="Poland">
                    <h4 class="title title-overlay-bottom">Poland</h4>
                </div>
                <div class="card__info">
                    <p>Poland’s main big cities are not just the capitals of rapidly developing regions. They have their own districts whose special and unique character is worth exploring.</p>
                    <hr>
                    <p class="pull-left valid-date"> <i class="fa fa-clock-o"></i> Valid from: Mar 05, 2020</p>
                    <a href="#/custom/poland-6-days" class="btn btn-warning pull-right">View More</a> 
                </div>
            </article><!--  card //  -->
        </div><!-- col // -->
      
        <div class="col-sm-12 col-xs-12 element-item flight">
            <article class="card card-deal">
                <div class="card__img-wrap">                          
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/holidays/azerbaijanl.jpg" class="lazyload" alt="Azerbaijan-Baku">
                    <h4 class="title title-overlay-bottom">Azerbaijan-Baku</h4>
                </div>
                <div class="card__info">
                    <p>Baku, the capital and commercial hub of Azerbaijan, is a low-lying city with coastline along the Caspian Sea. It's famed for its medieval walled old city.</p>
                    <hr>
                    <p class="pull-left valid-date"> <i class="fa fa-clock-o"></i> Valid from: Feb 23, 2020</p>
                    <a href="#-baku-4days" class="btn btn-warning pull-right">View More</a> 
                </div>
            </article><!--  card //  -->
        </div><!-- col // -->
      
        <div class="col-sm-12 col-xs-12 element-item flight">
            <article class="card card-deal">
                <div class="card__img-wrap">                          
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/holidays/georgia2.jpg" class="lazyload" alt="Georgia-Tbilisi">
                    <h4 class="title title-overlay-bottom">Georgia-Tbilisi</h4>
                </div>
                <div class="card__info">
                    <p>Tbilisi is the capital of the country of Georgia. Its diverse architecture encompasses Eastern Orthodox churches, ornate art nouveau buildings.</p>
                    <hr>
                    <p class="pull-left valid-date"> <i class="fa fa-clock-o"></i> Valid from: Feb 23, 2020</p>
                    <a href="#-tbilisi-4days" class="btn btn-warning pull-right">View More</a> 
                </div>
            </article><!--  card //  -->
        </div><!-- col // -->
      
        <div class="col-sm-12 col-xs-12 element-item flight">
            <article class="card card-deal">
                <div class="card__img-wrap">                          
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/holidays/armenia1.jpg" class="lazyload" alt="Armenia-Yerevan">
                    <h4 class="title title-overlay-bottom">Armenia-Yerevan</h4>
                </div>
                <div class="card__info">
                    <p>Yerevan, Armenia's capital, is marked by grand Soviet-era architecture. Republic Square is the city's core, with musical water fountains and colonnaded government buildings.</p>
                    <hr>
                    <p class="pull-left valid-date"> <i class="fa fa-clock-o"></i> Valid from: Feb 23, 2020</p>
                    <a href="#/custom/armenia-yerevan" class="btn btn-warning pull-right">View More</a> 
                </div>
            </article><!--  card //  -->
        </div><!-- col // -->
      
        <div class="col-sm-12 col-xs-12 element-item flight">
            <article class="card card-deal">
                <div class="card__img-wrap">                          
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/holidays/bosnia5.jpg" class="lazyload" alt="Bosnia">
                    <h4 class="title title-overlay-bottom">Bosnia</h4>
                </div>
                <div class="card__info">
                    <p>Bosnia is a country on the Balkan Peninsula in southeastern Europe. Its countryside is home to medieval villages, rivers and lakes, plus the craggy Dinaric Alps. National capital Sarajevo has a well preserved old quarter.</p>
                    <hr>
                    <p class="pull-left valid-date"> <i class="fa fa-clock-o"></i> Valid from: Mar 25, 2020</p>
                    <a href="#/custom/bosnia" class="btn btn-warning pull-right">View More</a> 
                </div>
            </article><!--  card //  -->
        </div><!-- col // -->
      
        <div class="col-sm-12 col-xs-12 element-item flight">
            <article class="card card-deal">
                <div class="card__img-wrap">                          
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/holidays/malaysia.jpg" class="lazyload" alt="Malaysia">
                    <h4 class="title title-overlay-bottom">Malaysia</h4>
                </div>
                <div class="card__info">
                    <p>Malaysia is a Southeast Asian country occupying parts of the Malay Peninsula and the island of Borneo. It's known for its beaches, rainforests and mix of Malay, Chinese, Indian and European cultural influences. Kuala Lumpur is the capital and the largest </p>
                    <hr>
                    <p class="pull-left valid-date"> <i class="fa fa-clock-o"></i> Valid from: Apr 02, 2020</p>
                    <a href="#/custom/malaysia" class="btn btn-warning pull-right">View More</a> 
                </div>
            </article><!--  card //  -->
        </div><!-- col // -->
      
        <div class="col-sm-12 col-xs-12 element-item flight">
            <article class="card card-deal">
                <div class="card__img-wrap">                          
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/holidays/sri_lanka3.jpg" class="lazyload" alt="Sri Lanka">
                    <h4 class="title title-overlay-bottom">Sri Lanka</h4>
                </div>
                <div class="card__info">
                    <p>Explore Sri Lanka holidays and discover the best time and places to visit. | Endless beaches, timeless ruins, welcoming people, oodles of elephants, rolling surf and more.</p>
                    <hr>
                    <p class="pull-left valid-date"> <i class="fa fa-clock-o"></i> Valid from: Apr 03, 2020</p>
                    <a href="#/custom/srilanka" class="btn btn-warning pull-right">View More</a> 
                </div>
            </article><!--  card //  -->
        </div><!-- col // -->
      
        <div class="col-sm-12 col-xs-12 element-item flight">
            <article class="card card-deal">
                <div class="card__img-wrap">                          
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/holidays/azerbaijanw.jpg" class="lazyload" alt="Azerbaijan">
                    <h4 class="title title-overlay-bottom">Azerbaijan</h4>
                </div>
                <div class="card__info">
                    <p>The time is moving forward, enjoy every moment in your life and reserve your seat on a more than wonderful tour to Azerbaijan, which includes the package, a group of wonderful and most popular tourist places , Azerbaijan, the nation and former Soviet repu</p>
                    <hr>
                    <p class="pull-left valid-date"> <i class="fa fa-clock-o"></i> Valid from: Mar 27, 2020</p>
                    <a href="#" class="btn btn-warning pull-right">View More</a> 
                </div>
            </article><!--  card //  -->
        </div><!-- col // -->
      
        <div class="col-sm-12 col-xs-12 element-item flight">
            <article class="card card-deal">
                <div class="card__img-wrap">                          
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/holidays/georgia.jpg" class="lazyload" alt="Georgia">
                    <h4 class="title title-overlay-bottom">Georgia</h4>
                </div>
                <div class="card__info">
                    <p>Georgia, a country at the intersection of Europe and Asia, is a former Soviet republic that’s home to Caucasus Mountain villages and Black Sea beaches.</p>
                    <hr>
                    <p class="pull-left valid-date"> <i class="fa fa-clock-o"></i> Valid from: Mar 21, 2020</p>
                    <a href="#" class="btn btn-warning pull-right">View More</a> 
                </div>
            </article><!--  card //  -->
        </div><!-- col // -->
            </div><!-- owl-carousel // -->
</div><!-- container // -->
</section>
<!-- ========================= SECTION OFFERS END// ========================= -->

<!-- ========================= SECTION OFFERS END// ========================= -->


<!-- ========================= POPULAR TOUR ========================= -->
<section class="section-tours">
<div class="container">
<header class="section-heading">
    <h2 class="section-title text-uppercase"> Blog  <span>section </span> </h2>
    <span class="separator"> <i class="material-icons">language</i> </span>
</header><!-- section-heading -->

<div class="caro2 owl-carousel owl-theme">

                    <div>
            <article class="card card-tour">
                <div class="card__img-wrap">
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/top_tours/BCN.jpg" class="lazyload" alt="Barcelona">
                    <h4 class="title text-center title-overlay-bottom">Barcelona</h4>
                </div>
                <div class="card-bottom" style="padding:12px;">
                    <div class="card"  >Facts About Heritage Sites In India Which Will Awe You</div>
                    <p class="text-right"><i class="far fa-calendar-alt"></i> December 23, 2021</p>
                </div> <!--  card-bottom //  -->
            </article> <!--  card //  -->
        </div><!-- col // -->
                    <div>
            <article class="card card-tour">
                <div class="card__img-wrap">
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/top_tours/SIN.jpg" class="lazyload" alt="Singapore">
                    <h4 class="title text-center title-overlay-bottom">Singapore</h4>
                </div>
                <div class="card-bottom" style="padding:12px;">
                    <div class="card"  >Facts About Heritage Sites In India Which Will Awe You</div>
                    <p class="text-right"><i class="far fa-calendar-alt"></i> December 23, 2021</p>
                </div> <!--  card-bottom //  -->
            </article> <!--  card //  -->
        </div><!-- col // -->
                    <div>
            <article class="card card-tour">
                <div class="card__img-wrap">
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/top_tours/LED.jpg" class="lazyload" alt="Saint Petersburg">
                    <h4 class="title text-center title-overlay-bottom">Saint Petersburg</h4>
                </div>
                <div class="card-bottom" style="padding:12px;">
                    <div class="card"  >Facts About Heritage Sites In India Which Will Awe You</div>
                    <p class="text-right"><i class="far fa-calendar-alt"></i> December 23, 2021</p>
                </div> <!--  card-bottom //  -->
            </article> <!--  card //  -->
        </div><!-- col // -->
                    <div>
            <article class="card card-tour">
                <div class="card__img-wrap">
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/top_tours/KUL.jpg" class="lazyload" alt="Kuala Lumpur">
                    <h4 class="title text-center title-overlay-bottom">Kuala Lumpur</h4>
                </div>
                <div class="card-bottom" style="padding:12px;">
                    <div class="card"  >Facts About Heritage Sites In India Which Will Awe You</div>
                    <p class="text-right"><i class="far fa-calendar-alt"></i> December 23, 2021</p>
                </div> <!--  card-bottom //  -->
            </article> <!--  card //  -->
        </div><!-- col // -->
                    <div>
            <article class="card card-tour">
                <div class="card__img-wrap">
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/top_tours/BKK.jpg" class="lazyload" alt="Bangkok">
                    <h4 class="title text-center title-overlay-bottom">Bangkok</h4>
                </div>
                <div class="card-bottom" style="padding:12px;">
                    <div class="card"  >Facts About Heritage Sites In India Which Will Awe You</div>
                    <p class="text-right"><i class="far fa-calendar-alt"></i> December 23, 2021</p>
                </div> <!--  card-bottom //  -->
            </article> <!--  card //  -->
        </div><!-- col // -->
                    <div>
            <article class="card card-tour">
                <div class="card__img-wrap">
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/top_tours/TYO.jpg" class="lazyload" alt="Tokyo">
                    <h4 class="title text-center title-overlay-bottom">Tokyo</h4>
                </div>
                <div class="card-bottom" style="padding:12px;">
                    <div class="card"  >Facts About Heritage Sites In India Which Will Awe You</div>
                    <p class="text-right"><i class="far fa-calendar-alt"></i> December 23, 2021</p>
                </div> <!--  card-bottom //  -->
            </article> <!--  card //  -->
        </div><!-- col // -->
                    <div>
            <article class="card card-tour">
                <div class="card__img-wrap">
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/top_tours/SEL.jpg" class="lazyload" alt="Seoul">
                    <h4 class="title text-center title-overlay-bottom">Seoul</h4>
                </div>
                <div class="card-bottom" style="padding:12px;">
                    <div class="card"  >Facts About Heritage Sites In India Which Will Awe You</div>
                    <p class="text-right"><i class="far fa-calendar-alt"></i> December 23, 2021</p>
                </div> <!--  card-bottom //  -->
            </article> <!--  card //  -->
        </div><!-- col // -->
                    <div>
            <article class="card card-tour">
                <div class="card__img-wrap">
                    <img src="" data-src="<?php echo base_url(); ?>public/upload/top_tours/AMS.jpg" class="lazyload" alt="Amsterdam">
                    <h4 class="title text-center title-overlay-bottom">Amsterdam</h4>
                </div>
                <div class="card-bottom" style="padding:12px;">
                    <div class="card"  >Facts About Heritage Sites In India Which Will Awe You</div>
                    <p class="text-right"><i class="far fa-calendar-alt"></i> December 23, 2021</p>
                </div> <!--  card-bottom //  -->
            </article> <!--  card //  -->
        </div><!-- col // -->
                
</div><!-- owl-carousel // -->
<!--<p class="text-center"><a href="" class="btn btn-warning btn-round">MORE TOURS</a></p>-->
</div><!-- container // -->
</section><!-- ========================= POPULAR TOUR END// ========================= -->



<!-- ========================= TOP FLIGHT ROUTES ========================= -->
<section  >
<div class="container">
<header class="section-heading" style="margin-top: 20px;">
    <h2 class="section-title text-uppercase"> TOP FLIGHT <span>ROUTES </h2>
    <span class="separator"> <i class="material-icons">&#xE195;</i> </span>
</header><!-- section-heading -->
<div class="col-md-11 col-sm-11 border" style="margin-left: 50px">
<div class="row">
<div class="col-md-6 col-sm-6"  >
    <div style="padding-top: 20px;"></div>
    <div class="d-flex">
        <div class="col-md-6 col-sm-6" >
<a href=""> Delhi to Mumbai (DEL-BOM) </a>
</div>
    <div class="col-md-2 col-sm-2">
    <a href="" class="btn btn-warning">Search Flight</a>
    </div>
    </div>
    <div style="padding-top: 20px;"></div>
    <div class="d-flex">
        <div class="col-md-6 col-sm-6">
<a href="">  Mumbai to Delhi (BOM-DEL)</a>
</div>
    <div class="col-md-2 col-sm-2">
    <a href="" class="btn btn-warning">Search Flight</a>
    </div>
    </div>

    <div style="padding-top: 20px;"></div>
    <div class="d-flex">
        <div class="col-md-6 col-sm-6">
<a href="">  Delhi to Goa (DEL-GOI) </a>
</div>
    <div class="col-md-2 col-sm-2">
    <a href="" class="btn btn-warning">Search Flight</a>
    </div>
    </div>

    <div style="padding-top: 20px;"></div>
    <div class="d-flex">
        <div class="col-md-6 col-sm-6">
<a href=""> Delhi to Bangalore (DEL-BLR)</a>
</div>
    <div class="col-md-2 col-sm-2">
    <a href="" class="btn btn-warning">Search Flight</a>
    </div>
    </div>
    <div style="padding-top: 20px;"></div>
   <div class="d-flex">
        <div class="col-md-6 col-sm-6">
<a href="">  Mumbai to Goa (BOM-GOI)</a>
</div>
    <div class="col-md-2 col-sm-2">
    <a href="" class="btn btn-warning">Search Flight</a>
    </div>
   </div>
</div>
<div class="vl"></div>
<div class="col-sm-6 col-md-6">
    <div style="padding-top:20px;"></div>
<div class="d-flex">
    <div class="col-md-6 col-sm-6">
<a href="">  Mumbai to Goa (BOM-GOI)</a>
</div>
    <div class="col-md-2 col-sm-2">
    <a href="" class="btn btn-warning">Search Flight</a>
    </div>
</div>
    <div style="padding-top:20px;"></div>
<div class="d-flex">
    <div class="col-md-6 col-sm-6">
<a href="">  Mumbai to Goa (BOM-GOI)</a>
</div>
    <div class="col-md-2 col-sm-2">
    <a href="" class="btn btn-warning">Search Flight</a>
    </div>
</div>
    <div style="padding-top:20px;"></div>
<div class="d-flex">
    <div class="col-md-6 col-sm-6">
<a href="">  Mumbai to Goa (BOM-GOI)</a>
</div>
    <div class="col-md-2 col-sm-2">
    <a href="" class="btn btn-warning">Search Flight</a>
    </div>
</div>
    <div style="padding-top:20px;"></div>
<div class="d-flex">
    <div class="col-md-6 col-sm-6">
<a href="">  Mumbai to Goa (BOM-GOI)</a>
</div>
    <div class="col-md-2 col-sm-2">
    <a href="" class="btn btn-warning">Search Flight</a>
    </div>
</div>
    <div style="padding-top:20px;"></div>
<div class="d-flex">
    <div class="col-md-6 col-sm-6">
<a href="">  Mumbai to Goa (BOM-GOI)</a>
</div>
    <div class="col-md-2 col-sm-2">
    <a href="" class="btn btn-warning">Search Flight</a>
    </div>
</div>
    <div style="padding-top: 20px;"></div>
</div>

</div>
</div>
</div>
</section>

<!-- ========================= TOP FLIGHT ROUTES END// ========================= -->





<!-- =========================  TOP HOTEL DESTINATION START ========================= -->
<section class="section-tours">
<div class="container">
<header class="section-heading">
    <h2 class="section-title text-uppercase"> TOP HOTEL <span>DESTINATION </h2>
    <span class="separator"> <i class="material-icons">&#xE53A;</i> </span>
</header><!-- section-heading -->
<div style="margin-left: 30px;">
    <!-- 1st card start -->
<div class="ht_city">
    <a href="">
        <div class="pop_city city_goa"></div>
        <p class="cityName">Goa</p>
        <p class="avgPrice">Starting at  <i class="fas fa-rupee-sign"></i>1200</p>
    </a>
</div>
<!--1st card end -->
<!-- 2nd  card start -->
<div class="ht_city">
    <a href="">
        <div class="pop_city city_mum"></div>
        <p class="cityName">Mumbai</p>
        <p class="avgPrice">Starting at <i class="fas fa-rupee-sign"></i>1170</p>
    </a>
</div>
<!--2nd card end -->
<!-- 3rd card start -->
<div class="ht_city">
    <a href="">
        <div class="pop_city city_del"></div>
        <p class="cityName">Delhi</p>
        <p class="avgPrice">Starting at <i class="fas fa-rupee-sign"></i>900</p>
    </a>
</div>
<!--3rd card end -->
<!-- 4th card start -->
<div class="ht_city">
    <a href="">
        <div class="pop_city city_ban"></div>
        <p class="cityName">Bangalore</p>
        <p class="avgPrice">Starting at <i class="fas fa-rupee-sign"></i>1100</p>
    </a>
</div>
<!--4th card end -->
<!-- 5th card start -->
<div class="ht_city">
    <a href="">
        <div class="pop_city city_kol"></div>
        <p class="cityName">Kolkata</p>
        <p class="avgPrice">Starting at <i class="fas fa-rupee-sign"></i>1050</p>
    </a>
</div>
<!--5th card end -->
<!-- 6th card start -->
<div class="ht_city">
    <a href="">
        <div class="pop_city city_dub"></div>
        <p class="cityName">Dubai</p>
        <p class="avgPrice">Starting at <i class="fas fa-rupee-sign"></i>1500</p>
    </a>
</div>
<!--6th card end -->
<!-- 7th card start -->
<div class="ht_city">
    <a href="">
        <div class="pop_city city_bang"></div>
        <p class="cityName">Bangkok</p>
        <p class="avgPrice">Starting at <i class="fas fa-rupee-sign"></i>1400</p>
    </a>
</div>
<!--7th card end -->
<!-- 8th card start -->
<div class="ht_city">
    <a href="">
        <div class="pop_city city_sing"></div>
        <p class="cityName">Singapore</p>
        <p class="avgPrice">Starting at <i class="fas fa-rupee-sign"></i>2200</p>
    </a>
</div>
<!--8th card end -->
</div>

</div><!-- container // -->
</section>
<!-- =========================  TOP HOTEL DESTINATION END// ========================= -->



<!-- ========================= SECTION WHY ========================= -->

<section class="section-why">

    <div class="container">



        <header class="section-heading">

            <h2 class="section-title text-uppercase"> WHY <span>CHOOSE US</span> </h2>

            <span class="separator"> <i class="material-icons">favorite</i> </span>

        </header><!-- section-heading -->



        <div class="row">

            <div class="col-sm-6 col-md-3 col-xs-6 why">

                <figure class="item-why">

                    <span class="icon-wrap">

                        <img src="<?php echo base_url(); ?>public/upload/why_we/huge-savings2.png" alt="Prices with no hidden fees">

                    </span>

                    <figcaption class="text-wrap">

                        <h4 class="title">Prices with no hidden fees</h4>

                        <p>We are proud to offer every segment of service with no hidden cost. Due to direct contracts with Airlines, Hotels and Suppliers our prices are always relevant and affordable.</p>

                    </figcaption>

                </figure>

            </div> <!-- col// -->

            <div class="col-sm-6 col-md-3 col-xs-6 why">

                <figure class="item-why">

                    <span class="icon-wrap">

                        <img src="<?php echo base_url(); ?>public/upload/why_we/biggest-selection-service.png" alt="Exclusive Choice of Hotels at Affordable Prices">

                    </span>

                    <figcaption class="text-wrap">

                        <h4 class="title">Service</h4>

                        <p>We're proud to employ some of the most talented travel professionals from all around the World. They are multilingual and understand the travel industry in depth and have an abundance of experience working in the travel sector.</p>

                    </figcaption>

                </figure>

            </div> <!-- col// -->
 
            <div class="col-sm-6 col-md-3 col-xs-6 why">

                <figure class="item-why">

                    <span class="icon-wrap">

                        <img src="<?php echo base_url(); ?>public/upload/why_we/easy-use2.png" alt="Easy to Search cheap Flight, Hotel & car">

                    </span>

                    <figcaption class="text-wrap">

                        <h4 class="title">Secure and User Friendly</h4>

                        <p>Booking your customer's travel with Travelfreebuy is safe and easy to go. We accept major credit and debit cards as well as internet banking payment options to make it even easier for you to focus more on your business.</p>

                    </figcaption>

                </figure>

            </div> <!-- col// -->

            <div class="col-sm-6 col-md-3 col-xs-6 why">

                <figure class="item-why">

                    <span class="icon-wrap">

                        <img src="<?php echo base_url(); ?>public/upload/why_we/help-hand.png" alt="Book Flights & Hotels. Our Help is always On your Hand">

                    </span>

                    <figcaption class="text-wrap">

                        <h4 class="title">Approach</h4>

                        <p>Our team is available 24/7.</p>

                    </figcaption>

                </figure>

            </div> <!-- col// -->





        </div><!--  row// -->



    </div><!-- container // -->

</section><!-- ========================= SECTION WHY END// ========================= -->







<div class="widget-subscribe hidden-xs hidden-sm hide" style="display: none">

    <span id="display_days" class="hide">0</span>

    <button type="button" class="close"> <i class="material-icons">close</i></button>

    <div class="img-wrap">

        <img src="<?php echo base_url(); ?>public/upload/why_we/book.png" alt="subscribe now">

        <!-- <span class="badge">Free</span> -->

    </div>

    <div class="text-wrap">

        <h4 class="title">All popular airlines <br> Which you love at Your fingertips

        </h4>

        <p>Hurry Up Get It NOW !! <br> </p>

        <form class="form-inline " role="form" name="subscribe-form" id="subscribe-form-small">

            <div class="form-group">

                <input type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="email" placeholder="Email" required>

            </div>

            <button type="submit" class="btn btn-warning"><span class="spin-loader hide"><i class="fa fa-spinner fa-spin"></i></span>Get Now</button>

        </form>

        <p class="txt-green subscribe-success" role="alert" style="display: none;"></p>

    </div>

</div> <!-- widget-subscribe// -->


<?php $this->load->view('home_template/footer'); ?>


<script src="<?php echo base_url(); ?>assets/js/libs/handlebars-v4.0.11.js" defer="defer"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/compiled/scriptac.js"></script>

<script src="<?php echo base_url(); ?>assets/js/libs/moment.min.js" defer></script>

<link href="<?php echo base_url(); ?>assets/plugins/Lightpick/css/lightpick.css" rel="stylesheet">

<script src="<?php echo base_url(); ?>assets/plugins/Lightpick/lightpick.js" defer></script>

<!-- owl carousel plugin -->

<link href="<?php echo base_url(); ?>assets/plugins/owlcarousel/owl.carousel.min.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>assets/plugins/owlcarousel/owl.theme.default.min.css" rel="stylesheet">

<script src="<?php echo base_url(); ?>assets/plugins/owlcarousel/owl.carousel.min.js" defer></script>



<script type="text/javascript">
    /// some script



    // jquery ready start

    $(document).ready(function() {

        // jQuery code



        $('.caro1').owlCarousel({

            loop: true,

            margin: 5,

            nav: true,

            animateOut: 'fadeOut',

            animateIn: 'fadeIn',

            smartSpeed: 700,

            autoplay: true,

            autoplayTimeout: 5000,

            dots: false,

            navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],

            responsive: {

                0: {

                    items: 1

                },

                600: {

                    items: 3

                },

                1000: {

                    items: 3

                }

            }



        })



        // jQuery code



        $('.caro2').owlCarousel({

            loop: true,

            margin: 5,

            nav: true,

            animateOut: 'fadeOut',

            animateIn: 'fadeIn',

            smartSpeed: 700,

            autoplay: true,

            autoplayTimeout: 5000,

            dots: false,

            navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],

            responsive: {

                0: {

                    items: 1

                },

                600: {

                    items: 3

                },

                1000: {

                    items: 4

                }

            }



        })



    });

    // jquery end
</script>

