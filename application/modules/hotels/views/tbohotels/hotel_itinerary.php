<?php $this->load->view('home/home_template/header'); ?>

<?php
// $session_data = $this->session->userdata('hotel_search_data');
$session_data = unserialize($roomDetails->searcharray);
$city_arr = explode(',', $session_data['cityName']);
$cityName = $city_arr[0];

$adults = $session_data['adults'];
$childs = $session_data['childs'];
// $childs_ages = $session_data['childs_ages'];
// $adults_count = $session_data['adults_count'];
// $childs_count = $session_data['childs_count'];

$rooms = $session_data['rooms'];
$nights = $session_data['nights'];

$checkinStrTime = strtotime(str_replace('/', '-', $session_data['checkIn']));
$checkoutStrTime = strtotime(str_replace('/', '-', $session_data['checkOut']));

if (!empty($roomDetails->hotel_image)) {
    $image_name = explode(',', $roomDetails->hotel_image);
} else {
    $image_name = '';
}
$gttd = $image_name[0];

$user_mobile = '';
$user_email = '';
$user_city = '';
$user_pincode = '';
$address = '';
$user_country = '';
if ($this->session->userdata('user_no')) {
    $user_id = $this->session->userdata('user_id');
    $this->load->model('b2c/B2c_Model');
    $user_info = $this->B2c_Model->getUserInfo($user_id);
    $user_mobile = $user_info->mobile_no;
    $user_email = $user_info->user_email;
    $user_city = $user_info->city;
    $user_pincode = $user_info->pin_code;
    $address = $user_info->address;
    $user_country = $user_info->country;
}
// echo number_format($total_cost - ($roomDetails->admin_markup + $roomDetails->payment_charge)); 
// echo "tottal".$total_cost;
// echo"<pre>";print_r($roomDetails);exit;
?>
<!-- ========================= SECTION PAGETOP  ========================= -->
<section class="section-pagetop">
    <div class="container">
        <div class="timer-block pull-right">
            <i class="material-icons">&#xE425;</i>
            <small>Prices may change after</small>
            <big class="timer" id="booking-countdown"></big>
        </div>
        <h2 class="title-page">Just two simple steps to book!</h2>
    </div> <!-- container // -->
</section>
<!-- ========================= SECTION PAGETOP END // ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content">
    <div class="container">
        <message>
        </message>
        <div class="row-sm">
            <main class="col-sm-9">

                <section class="panel panel-active panel-booking" id="policy-block">
                    <header class="panel-heading">
                        <span class="num-step">1</span>
                        <h4 class="panel-title">Hotel Policies</h4>
                    </header>
                    <!-- ============== (traveller) compact view ============== -->
                    <div class="compact-view" style="display: none" data-tooltip="Click to edit">
                        <article class="panel-body">
                            <div class="alert alert-warning">
                                <p><strong class="text-capitalize">Cancellation policy </strong> <br>
                                    <?php echo $roomDetails->cancellation_policy; ?>
                                </p>

                            </div>

                        </article> <!-- panel-body// -->
                    </div>
                    <!-- ============== (traveller) compact view .end// ============== -->
                    <!-- ============== (traveller) full view ============== -->
                    <div class="full-view" style="display: block">

                        <article class="panel-body">
                            <div class="alert alert-warning">
                                <p><strong class="text-capitalize">Cancellation policy </strong> <br>
                                    <?php echo $roomDetails->cancellation_policy; ?>
                                </p>




                            </div>
                        </article>
                        <div class="panel-footer text-right">
                            <button type="submit" class="btn btn-warning btn-lg" onclick="activate_block('policy-block');">Continue</button>
                        </div>
                    </div>
                    <!-- ============== (traveller) full view .end// ============== -->
                </section> <!-- panel// -->



                <section class="panel panel-disable panel-booking" id="guest-block">
                    <header class="panel-heading">
                        <span class="num-step">2</span>
                        <h4 class="panel-title">Guest Details</h4>
                    </header>
                    <!-- ============== (traveller) compact view ============== -->
                    <div class="compact-view" style="display: none" data-tooltip="Click to edit">
                        <article class="panel-body">
                            <div class="row">
                                <div class="col-sm-5 item-user-overview">
                                    <p>
                                        <i class="fa fa-user"></i>
                                        <span id="name-view-div"></span><br />
                                        <span class="text-muted" id="address-view-div"></span>
                                    </p>
                                </div> <!-- col //  -->
                                <div class="col-sm-5 item-user-overview">
                                    <p>
                                        <i class="fa fa-phone"></i>
                                        <span id="phone-view-div"></span> <br />
                                        <span class="text-muted" id="email-view-div"></span>
                                    </p>
                                </div> <!-- col //  -->
                            </div> <!-- row//  -->
                        </article> <!-- panel-body// -->
                    </div>
                    <!-- ============== (traveller) compact view .end// ============== -->
                    <!-- ============== (traveller) full view ============== -->
                    <div class="full-view guest-fullview" style="display: none">
                        <article class="alert-login-booking">
                            <div class="form-wrap" style="display: none;">
                                <p class="p10 alert alert-danger small clearfix" role="alert" style="display: none;"></p>
                                <form role="form" name="traveler-login-form" id="traveler-login-form" data-toggle="validator" class="row-sm" method="POST">
                                    <div class="col-sm-4 col-md-4 col-xs-12 form-group">
                                        <input class="form-control" name="email" placeholder="Email ID" type="text" required>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-xs-12 form-group">
                                        <input class="form-control" name="password" placeholder="password" type="password" minlength="6" required>
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-xs-6 form-group">
                                        <button type="submit" class="btn btn-warning"> Sign in <span class="spin-loader hide"><i class="fa fa-spinner fa-spin"></i></span></button>
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-xs-6 text-right form-group">
                                        <button type="button" onclick="$('.alert-login-booking .form-wrap').hide(); $('.alert-login-booking .text-wrap').slideDown()" class="btn btn-link"> × Cancel </button>
                                    </div>
                                </form>
                            </div> <!-- form wrap.// -->
                            <div class="text-wrap" style="display: block;">
                                <button onclick="$(this).parent().hide(); $('.alert-login-booking .form-wrap').slideDown()" class="btn btn-lg btn-default pull-right"> Sign in <i class="fa fa-chevron-right"></i></button>
                                <h4 class="title">Sign in now and speed up your booking!</h4>
                                <ul class="list-inline list-check">
                                    <li>Quick fill in your details</li>
                                    <li>Save new travellers</li>
                                    <li>Manage your bookings</li>
                                </ul>
                            </div> <!-- text-wrap.// -->
                        </article>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#traveler-login-form').validator({
                                    disable: false,
                                    focus: false,
                                }).on('submit', function(e) {
                                    if (e.isDefaultPrevented()) {
                                        // handle the invalid form...
                                        return false;
                                    } else {
                                        // everything looks good!
                                        loginTraveler(this);
                                        return false;
                                    }
                                });
                                var xhr;

                                function loginTraveler(that) {
                                    if (xhr && xhr.readyState !== 4) {
                                        xhr.abort();
                                    }
                                    xhr = $.ajax({
                                        type: 'POST',
                                        async: true,
                                        dataType: 'json',
                                        data: $(that).serializeArray(),
                                        url: 'https://travelfreebuy.com/login/authenticate-ajax',
                                        beforeSend: function() {
                                            $(that).find('.spin-loader').removeClass('hide');
                                        },
                                        success: function(response) {
                                            if (typeof response.error_message !== 'undefined') {
                                                $(that).siblings('p.alert-danger').text(response.error_message).fadeTo(2000, 500).slideUp(2000);
                                            } else if (typeof response.success !== 'undefined' && response.success === 1) {
                                                location.reload();
                                            }
                                        },
                                        complete: function() {
                                            $(that).find('.spin-loader').addClass('hide');
                                        }
                                    });

                                }
                            });
                        </script>
                        <!-- <form method="POST" action="<?php //echo site_url(); 
                                                            ?>hotels/confirm_reservation?callBackId=<?php echo base64_encode($roomDetails->api); ?>&hotelCode=<?php echo $roomDetails->hotel_code; ?>&searchId=<?php echo $search_id; ?>&sessionId=<?php echo $roomDetails->session_id; ?>"  -->
                        <form method="POST" action="#" class="form" role="form" name="traveler-form" id="traveler-form2" data-toggle="validator">
                            <input type="hidden" name="callBackId" value="<?php echo base64_encode($roomDetails->api); ?>" required />
                            <input type="hidden" name="hotelCode" value="<?php echo $roomDetails->hotel_code; ?>" required />
                            <input type="hidden" name="searchId" value="<?php echo $roomDetails->search_id; ?>" required />
                            <input type="hidden" name="sessionId" value="<?php echo $roomDetails->session_id; ?>" required />

                            <div class="subheading">
                                <h4 class="title"><strong> Room 1 (Main Guest) <span id="printtitle"></span> <span id="printfirstname"></span> <span id="printlastname"></span></strong></h4>
                            </div>

                            <article class="panel-body">
                                <div id="traveler-1">
                                    <div class="row-sm">
                                        <label class="col-sm-2 control-label">Full Name</label>
                                        <div class="col-sm-2 form-group">
                                            <select class="form-control selectpicker title" name="adults_title[]" id="salutation" required title="Title" data-error="Please select title">
                                                <option value="Mr">Mr</option>
                                                <option value="Ms">Ms</option>
                                                <option value="Mrs">Mrs</option>
                                            </select>
                                            <small class="help-block with-errors"></small>
                                        </div>
                                        <div class="col-sm-3 form-group">
                                            <input pattern="^[a-zA-Z]+( [a-zA-Z]+)*$" minlength="2" maxlength="30" type="text" class="form-control first_name" id="tfirsttname" value="" name="adults_fname[]" placeholder="First Name" data-error="Valid First Name is required" required>
                                            <small class="help-block with-errors"></small>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <input pattern="^[a-zA-Z]+( [a-zA-Z]+)*$" minlength="2" maxlength="30" type="text" class="form-control last_name" id="tlastname" value="" name="adults_lname[]" placeholder="Last Name" data-error="Valid Last Name is required" required>
                                            <small class="help-block with-errors"></small>
                                        </div>
                                    </div> <!-- form-group// -->
                                    <?php if ($PANMandatory = 'true') { ?>
                                        <div class="row-sm">
                                            <label class="col-sm-2 control-label">PAN Number</label>
                                            <div class="col-sm-3 form-group">
                                                <input minlength="4" maxlength="30" type="text" class="form-control pan_no" id="tpan" value="" name="user_pan[]" placeholder="PAN Number" data-error="Valid PAN Number is required" required>
                                                <small class="help-block with-errors"></small>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="mb20 row-sm">
                                        <label class="col-sm-2 control-label">Contact details</label>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                <div class="form-group">
                                                    <select class="selectpicker form-control" name="mobilecountryCode" id="countryCode" data-live-search="true" title="Code" style="width:150px" required data-error="Please select code">
                                                        <option value="+93">AF (+93) </option>
                                                        <option value="+358">AX (+358) </option>
                                                        <option value="+355">AL (+355) </option>
                                                        <option value="+213">DZ (+213) </option>
                                                        <option value="+1">AS (+1) </option>
                                                        <option value="+376">AD (+376) </option>
                                                        <option value="+244">AO (+244) </option>
                                                        <option value="+1">AI (+1) </option>
                                                        <option value="672">AQ (672) </option>
                                                        <option value="+1268">AG (+1268) </option>
                                                        <option value="+54">AR (+54) </option>
                                                        <option value="+374">AM (+374) </option>
                                                        <option value="+297">AW (+297) </option>
                                                        <option value="+297">AA (+297) </option>
                                                        <option value="+61">AU (+61) </option>
                                                        <option value="+43">AT (+43) </option>
                                                        <option value="+994">AZ (+994) </option>
                                                        <option value="+973">BH (+973) </option>
                                                        <option value="+880">BD (+880) </option>
                                                        <option value="+1">BB (+1) </option>
                                                        <option value="+375">BY (+375) </option>
                                                        <option value="+32">BE (+32) </option>
                                                        <option value="+501">BZ (+501) </option>
                                                        <option value="+229">BJ (+229) </option>
                                                        <option value="+1">BM (+1) </option>
                                                        <option value="+975">BT (+975) </option>
                                                        <option value="+591">BO (+591) </option>
                                                        <option value="+599">BQ (+599) </option>
                                                        <option value="+387">BA (+387) </option>
                                                        <option value="+267">BW (+267) </option>
                                                        <option value="+599">BV (+599) </option>
                                                        <option value="+55">BR (+55) </option>
                                                        <option value="+246">IO (+246) </option>
                                                        <option value="+673">BN (+673) </option>
                                                        <option value="+359">BG (+359) </option>
                                                        <option value="+226">BF (+226) </option>
                                                        <option value="+95">MM (+95) </option>
                                                        <option value="+257">BI (+257) </option>
                                                        <option value="+855">KH (+855) </option>
                                                        <option value="+237">CM (+237) </option>
                                                        <option value="+1">CA (+1) </option>
                                                        <option value="+238">CV (+238) </option>
                                                        <option value="+1">KY (+1) </option>
                                                        <option value="+236">CF (+236) </option>
                                                        <option value="+235">TD (+235) </option>
                                                        <option value="+56">CL (+56) </option>
                                                        <option value="+86">CN (+86) </option>
                                                        <option value="+61">CX (+61) </option>
                                                        <option value="+891">CC (+891) </option>
                                                        <option value="+855">CO (+855) </option>
                                                        <option value="+269">KM (+269) </option>
                                                        <option value="+242">CG (+242) </option>
                                                        <option value="+243">CD (+243) </option>
                                                        <option value="+682">CK (+682) </option>
                                                        <option value="+506">CR (+506) </option>
                                                        <option value="+225">CI (+225) </option>
                                                        <option value="+385">HR (+385) </option>
                                                        <option value="+53">CU (+53) </option>
                                                        <option value="+599">CW (+599) </option>
                                                        <option value="+357">CY (+357) </option>
                                                        <option value="+420">CZ (+420) </option>
                                                        <option value="+45">DK (+45) </option>
                                                        <option value="+253">DJ (+253) </option>
                                                        <option value="+1767">DM (+1767) </option>
                                                        <option value="+1">DO (+1) </option>
                                                        <option value="+670">TL (+670) </option>
                                                        <option value="+593">EC (+593) </option>
                                                        <option value="+20">EG (+20) </option>
                                                        <option value="+503">SV (+503) </option>
                                                        <option value="+240">GQ (+240) </option>
                                                        <option value="+291">ER (+291) </option>
                                                        <option value="+372">EE (+372) </option>
                                                        <option value="+251">ET (+251) </option>
                                                        <option value="+500">FK (+500) </option>
                                                        <option value="+298">FO (+298) </option>
                                                        <option value="+679">FJ (+679) </option>
                                                        <option value="+358">FI (+358) </option>
                                                        <option value="+33">FR (+33) </option>
                                                        <option value="+594">GF (+594) </option>
                                                        <option value="+689">PF (+689) </option>
                                                        <option value="+241">GA (+241) </option>
                                                        <option value="+220">GM (+220) </option>
                                                        <option value="+995">GE (+995) </option>
                                                        <option value="+49">DE (+49) </option>
                                                        <option value="+233">GH (+233) </option>
                                                        <option value="+350">GI (+350) </option>
                                                        <option value="+30">GR (+30) </option>
                                                        <option value="+299">GL (+299) </option>
                                                        <option value="+1473">GD (+1473) </option>
                                                        <option value="+1">GU (+1) </option>
                                                        <option value="+502">GT (+502) </option>
                                                        <option value="+44">GG (+44) </option>
                                                        <option value="+224">GN (+224) </option>
                                                        <option value="+245">GW (+245) </option>
                                                        <option value="+592">GY (+592) </option>
                                                        <option value="+509">HT (+509) </option>
                                                        <option value="+504">HN (+504) </option>
                                                        <option value="+852">HK (+852) </option>
                                                        <option value="+36">HU (+36) </option>
                                                        <option value="+354">IS (+354) </option>
                                                        <option value="+91">IN (+91) </option>
                                                        <option value="+62">ID (+62) </option>
                                                        <option value="+98">IR (+98) </option>
                                                        <option value="+964">IQ (+964) </option>
                                                        <option value="+353">IE (+353) </option>
                                                        <option value="+44">IM (+44) </option>
                                                        <option value="+972">IL (+972) </option>
                                                        <option value="+39">IT (+39) </option>
                                                        <option value="+1876">JM (+1876) </option>
                                                        <option value="+81">JP (+81) </option>
                                                        <option value="+44">JE (+44) </option>
                                                        <option value="+962">JO (+962) </option>
                                                        <option value="+7">KZ (+7) </option>
                                                        <option value="+254">KE (+254) </option>
                                                        <option value="+686">KI (+686) </option>
                                                        <option value="+965">KW (+965) </option>
                                                        <option value="+996">KG (+996) </option>
                                                        <option value="+856">LA (+856) </option>
                                                        <option value="+371">LV (+371) </option>
                                                        <option value="+961">LB (+961) </option>
                                                        <option value="+266">LS (+266) </option>
                                                        <option value="+231">LR (+231) </option>
                                                        <option value="+218">LY (+218) </option>
                                                        <option value="+423">LI (+423) </option>
                                                        <option value="+370">LT (+370) </option>
                                                        <option value="+352">LU (+352) </option>
                                                        <option value="+853">MO (+853) </option>
                                                        <option value="+389">MK (+389) </option>
                                                        <option value="+261">MG (+261) </option>
                                                        <option value="+265">MW (+265) </option>
                                                        <option value="+60">MY (+60) </option>
                                                        <option value="+960">MV (+960) </option>
                                                        <option value="+223">ML (+223) </option>
                                                        <option value="+356">MT (+356) </option>
                                                        <option value="+692">MH (+692) </option>
                                                        <option value="+222">MR (+222) </option>
                                                        <option value="+230">MU (+230) </option>
                                                        <option value="+262">YT (+262) </option>
                                                        <option value="+52">MX (+52) </option>
                                                        <option value="+691">FM (+691) </option>
                                                        <option value="+373">MD (+373) </option>
                                                        <option value="+377">MC (+377) </option>
                                                        <option value="+976">MN (+976) </option>
                                                        <option value="+1">MS (+1) </option>
                                                        <option value="+212">MA (+212) </option>
                                                        <option value="+258">MZ (+258) </option>
                                                        <option value="+264">NA (+264) </option>
                                                        <option value="+674">NR (+674) </option>
                                                        <option value="+977">NP (+977) </option>
                                                        <option value="+31">NL (+31) </option>
                                                        <option value="+687">NC (+687) </option>
                                                        <option value="+64">NZ (+64) </option>
                                                        <option value="+505">NI (+505) </option>
                                                        <option value="+227">NE (+227) </option>
                                                        <option value="+234">NG (+234) </option>
                                                        <option value="+683">NU (+683) </option>
                                                        <option value="+672">NF (+672) </option>
                                                        <option value="+850">KP (+850) </option>
                                                        <option value="+1">MP (+1) </option>
                                                        <option value="+47">NO (+47) </option>
                                                        <option value="+968">OM (+968) </option>
                                                        <option value="+92">PK (+92) </option>
                                                        <option value="+680">PW (+680) </option>
                                                        <option value="+970">PS (+970) </option>
                                                        <option value="+507">PA (+507) </option>
                                                        <option value="+675">PG (+675) </option>
                                                        <option value="+595">PY (+595) </option>
                                                        <option value="+51">PE (+51) </option>
                                                        <option value="+63">PH (+63) </option>
                                                        <option value="+870">PN (+870) </option>
                                                        <option value="+48">PL (+48) </option>
                                                        <option value="+351">PT (+351) </option>
                                                        <option value="+1">PR (+1) </option>
                                                        <option value="+974">QA (+974) </option>
                                                        <option value="+40">RO (+40) </option>
                                                        <option value="+7">RU (+7) </option>
                                                        <option value="+250">RW (+250) </option>
                                                        <option value="+590">BL (+590) </option>
                                                        <option value="+1">KN (+1) </option>
                                                        <option value="+1">LC (+1) </option>
                                                        <option value="+590">MF (+590) </option>
                                                        <option value="+508">PM (+508) </option>
                                                        <option value="+1">VC (+1) </option>
                                                        <option value="+685">WS (+685) </option>
                                                        <option value="+378">SM (+378) </option>
                                                        <option value="+239">ST (+239) </option>
                                                        <option value="+966">SA (+966) </option>
                                                        <option value="+221">SN (+221) </option>
                                                        <option value="+381">RS (+381) </option>
                                                        <option value="+248">SC (+248) </option>
                                                        <option value="+232">SL (+232) </option>
                                                        <option value="+65">SG (+65) </option>
                                                        <option value="+1">SX (+1) </option>
                                                        <option value="+421">SK (+421) </option>
                                                        <option value="+386">SI (+386) </option>
                                                        <option value="+677">SB (+677) </option>
                                                        <option value="+252">SO (+252) </option>
                                                        <option value="+27">ZA (+27) </option>
                                                        <option value="+82">KR (+82) </option>
                                                        <option value="+34">ES (+34) </option>
                                                        <option value="+94">LK (+94) </option>
                                                        <option value="+249">SD (+249) </option>
                                                        <option value="+597">SR (+597) </option>
                                                        <option value="+47">SJ (+47) </option>
                                                        <option value="+268">SZ (+268) </option>
                                                        <option value="+46">SE (+46) </option>
                                                        <option value="+41">CH (+41) </option>
                                                        <option value="+963">SY (+963) </option>
                                                        <option value="+886">TW (+886) </option>
                                                        <option value="+992">TJ (+992) </option>
                                                        <option value="+255">TZ (+255) </option>
                                                        <option value="+66">TH (+66) </option>
                                                        <option value="+1">BS (+1) </option>
                                                        <option value="+228">TG (+228) </option>
                                                        <option value="+690">TK (+690) </option>
                                                        <option value="+676">TO (+676) </option>
                                                        <option value="+1">TT (+1) </option>
                                                        <option value="+216">TN (+216) </option>
                                                        <option value="+90">TR (+90) </option>
                                                        <option value="+993">TM (+993) </option>
                                                        <option value="+1">TC (+1) </option>
                                                        <option value="+688">TV (+688) </option>
                                                        <option value="+256">UG (+256) </option>
                                                        <option value="+380">UA (+380) </option>
                                                        <option value="+971">AE (+971) </option>
                                                        <option value="+44">GB (+44) </option>
                                                        <option value="+1">US (+1) </option>
                                                        <option value="+598">UY (+598) </option>
                                                        <option value="+998">UZ (+998) </option>
                                                        <option value="+678">VU (+678) </option>
                                                        <option value="+39">VA (+39) </option>
                                                        <option value="+58">VE (+58) </option>
                                                        <option value="+84">VN (+84) </option>
                                                        <option value="+1">VG (+1) </option>
                                                        <option value="+1">VI (+1) </option>
                                                        <option value="+681">WF (+681) </option>
                                                        <option value="+212">EH (+212) </option>
                                                        <option value="+967">YE (+967) </option>
                                                        <option value="+382">ME (+382) </option>
                                                        <option value="+260">ZM (+260) </option>
                                                        <option value="+263">ZW (+263) </option>
                                                    </select>
                                                    <small class="help-block with-errors"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                <div class="form-group">
                                                    <input pattern="[0-9]+" type="tel" class="form-control" id="tpnumber" value="" name="user_mobile" minlength="8" maxlength="11" placeholder="Mobile no." data-error="Please enter a valid number." required>
                                                    <small class="help-block with-errors"></small>
                                                </div>
                                            </div>

                                        </div> <!-- col// -->
                                        <div class="col-sm-4 form-group" data-toggle="tooltip" title="Your booking details will be sent to this email address">
                                            <input type="email" class="form-control" id="email" name="user_email" value="" placeholder="Email" data-error="Please enter a valid email address." pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                                            <small class="help-block with-errors"></small>
                                        </div>
                                    </div> <!-- form-group// -->
                                    <div class="row-sm">
                                        <label class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-5 form-group">
                                            <input type="text" class="form-control" id="taddress" value="" name="address" placeholder="Address" data-error="Valid Address is required" pattern="[a-zA-Z0-9,\s]+" required>
                                            <small class="help-block with-errors"></small>
                                        </div> <!-- col// -->
                                        <div class="col-sm-4 form-group">
                                            <select class="selectpicker form-control country" name="user_country" data-live-search="true" id="country" required title="Select country" data-error="Please select country">
                                                <option data-subtext="(AF)" value="AF">Afghanistan</option>
                                                <option data-subtext="(AX)" value="AX">Åland Islands</option>
                                                <option data-subtext="(AL)" value="AL">Albania</option>
                                                <option data-subtext="(DZ)" value="DZ">Algeria</option>
                                                <option data-subtext="(AS)" value="AS">American Samoa</option>
                                                <option data-subtext="(AD)" value="AD">Andorra</option>
                                                <option data-subtext="(AO)" value="AO">Angola</option>
                                                <option data-subtext="(AI)" value="AI">Anguilla</option>
                                                <option data-subtext="(AQ)" value="AQ">Antarctica</option>
                                                <option data-subtext="(AG)" value="AG">Antigua and barbuda</option>
                                                <option data-subtext="(AR)" value="AR">Argentina</option>
                                                <option data-subtext="(AM)" value="AM">Armenia</option>
                                                <option data-subtext="(AW)" value="AW">Aruba</option>
                                                <option data-subtext="(AA)" value="AA">Aruba</option>
                                                <option data-subtext="(AU)" value="AU">Australia</option>
                                                <option data-subtext="(AT)" value="AT">Austria</option>
                                                <option data-subtext="(AZ)" value="AZ">Azerbaijan</option>
                                                <option data-subtext="(BH)" value="BH">Bahrain</option>
                                                <option data-subtext="(BD)" value="BD">Bangladesh</option>
                                                <option data-subtext="(BB)" value="BB">Barbados</option>
                                                <option data-subtext="(BY)" value="BY">Belarus</option>
                                                <option data-subtext="(BE)" value="BE">Belgium</option>
                                                <option data-subtext="(BZ)" value="BZ">Belize</option>
                                                <option data-subtext="(BJ)" value="BJ">Benin</option>
                                                <option data-subtext="(BM)" value="BM">Bermuda</option>
                                                <option data-subtext="(BT)" value="BT">Bhutan</option>
                                                <option data-subtext="(BO)" value="BO">Bolivia</option>
                                                <option data-subtext="(BQ)" value="BQ">Bonaire, Saint Eustatius and Saba</option>
                                                <option data-subtext="(BA)" value="BA">Bosnia and herzegovina</option>
                                                <option data-subtext="(BW)" value="BW">Botswana</option>
                                                <option data-subtext="(BV)" value="BV">Bouvet Island</option>
                                                <option data-subtext="(BR)" value="BR">Brazil</option>
                                                <option data-subtext="(IO)" value="IO">British Indian Ocean Territory</option>
                                                <option data-subtext="(BN)" value="BN">Brunei</option>
                                                <option data-subtext="(BG)" value="BG">Bulgaria</option>
                                                <option data-subtext="(BF)" value="BF">Burkina Faso</option>
                                                <option data-subtext="(MM)" value="MM">Burma/Myanmar</option>
                                                <option data-subtext="(BI)" value="BI">Burundi</option>
                                                <option data-subtext="(KH)" value="KH">Cambodia</option>
                                                <option data-subtext="(CM)" value="CM">Cameroon</option>
                                                <option data-subtext="(CA)" value="CA">Canada</option>
                                                <option data-subtext="(CV)" value="CV">Cape Verde</option>
                                                <option data-subtext="(KY)" value="KY">Cayman Islands</option>
                                                <option data-subtext="(CF)" value="CF">Central African Republic</option>
                                                <option data-subtext="(TD)" value="TD">Chad</option>
                                                <option data-subtext="(CL)" value="CL">Chile</option>
                                                <option data-subtext="(CN)" value="CN">China</option>
                                                <option data-subtext="(CX)" value="CX">Christmas Island</option>
                                                <option data-subtext="(CC)" value="CC">Cocos (Keeling) Islands</option>
                                                <option data-subtext="(CO)" value="CO">Colombia</option>
                                                <option data-subtext="(KM)" value="KM">Comores</option>
                                                <option data-subtext="(CG)" value="CG">Congo</option>
                                                <option data-subtext="(CD)" value="CD">Congo zaire</option>
                                                <option data-subtext="(CK)" value="CK">Cook Islands</option>
                                                <option data-subtext="(CR)" value="CR">Costa Rica</option>
                                                <option data-subtext="(CI)" value="CI">Cote d ivoire</option>
                                                <option data-subtext="(HR)" value="HR">Croatia</option>
                                                <option data-subtext="(CU)" value="CU">Cuba</option>
                                                <option data-subtext="(CW)" value="CW">Curaçao</option>
                                                <option data-subtext="(CY)" value="CY">Cyprus</option>
                                                <option data-subtext="(CZ)" value="CZ">Czech Republic</option>
                                                <option data-subtext="(DK)" value="DK">Denmark</option>
                                                <option data-subtext="(DJ)" value="DJ">Djibouti</option>
                                                <option data-subtext="(DM)" value="DM">Dominica</option>
                                                <option data-subtext="(DO)" value="DO">Dominican Republic</option>
                                                <option data-subtext="(TL)" value="TL">East Timor</option>
                                                <option data-subtext="(EC)" value="EC">Ecuador</option>
                                                <option data-subtext="(EG)" value="EG">Egypt</option>
                                                <option data-subtext="(SV)" value="SV">El Salvador</option>
                                                <option data-subtext="(GQ)" value="GQ">Equatorial Guinea</option>
                                                <option data-subtext="(ER)" value="ER">Eritrea</option>
                                                <option data-subtext="(EE)" value="EE">Estonia</option>
                                                <option data-subtext="(ET)" value="ET">Ethiopia</option>
                                                <option data-subtext="(FK)" value="FK">Falkland Islands (Malvinas)</option>
                                                <option data-subtext="(FO)" value="FO">Faroe Islands</option>
                                                <option data-subtext="(FJ)" value="FJ">Fiji</option>
                                                <option data-subtext="(FI)" value="FI">Finland</option>
                                                <option data-subtext="(FR)" value="FR">France</option>
                                                <option data-subtext="(GP)" value="GP">France (Guadeloupe)</option>
                                                <option data-subtext="(MQ)" value="MQ">France (Martinique)</option>
                                                <option data-subtext="(RE)" value="RE">France (Réunion)</option>
                                                <option data-subtext="(GF)" value="GF">French Guiana</option>
                                                <option data-subtext="(PF)" value="PF">French Polynesia</option>
                                                <option data-subtext="(TF)" value="TF">French Southern Territories</option>
                                                <option data-subtext="(GA)" value="GA">Gabon</option>
                                                <option data-subtext="(GM)" value="GM">Gambia</option>
                                                <option data-subtext="(GE)" value="GE">Georgia</option>
                                                <option data-subtext="(DE)" value="DE">Germany</option>
                                                <option data-subtext="(GH)" value="GH">Ghana</option>
                                                <option data-subtext="(GI)" value="GI">Gibraltar</option>
                                                <option data-subtext="(GR)" value="GR">Greece</option>
                                                <option data-subtext="(GL)" value="GL">Greenland</option>
                                                <option data-subtext="(GD)" value="GD">Grenada</option>
                                                <option data-subtext="(GU)" value="GU">Guam</option>
                                                <option data-subtext="(GT)" value="GT">Guatemala</option>
                                                <option data-subtext="(GG)" value="GG">Guernsey</option>
                                                <option data-subtext="(GN)" value="GN">Guinea</option>
                                                <option data-subtext="(GW)" value="GW">Guinea-bissau</option>
                                                <option data-subtext="(GY)" value="GY">Guyana</option>
                                                <option data-subtext="(HT)" value="HT">Haiti</option>
                                                <option data-subtext="(HM)" value="HM">Heard Island and McDonald Islands</option>
                                                <option data-subtext="(HN)" value="HN">Honduras</option>
                                                <option data-subtext="(HK)" value="HK">Hong Kong</option>
                                                <option data-subtext="(HU)" value="HU">Hungary</option>
                                                <option data-subtext="(IS)" value="IS">Iceland</option>
                                                <option data-subtext="(IN)" value="IN">India</option>
                                                <option data-subtext="(ID)" value="ID">Indonesia</option>
                                                <option data-subtext="(IR)" value="IR">Iran</option>
                                                <option data-subtext="(IQ)" value="IQ">Iraq</option>
                                                <option data-subtext="(IE)" value="IE">Ireland</option>
                                                <option data-subtext="(IM)" value="IM">Isle of Man</option>
                                                <option data-subtext="(IL)" value="IL">Israel</option>
                                                <option data-subtext="(IT)" value="IT">Italy</option>
                                                <option data-subtext="(JM)" value="JM">Jamaica</option>
                                                <option data-subtext="(JP)" value="JP">Japan</option>
                                                <option data-subtext="(JE)" value="JE">Jersey</option>
                                                <option data-subtext="(JO)" value="JO">Jordan</option>
                                                <option data-subtext="(KZ)" value="KZ">Kazakhstan</option>
                                                <option data-subtext="(KE)" value="KE">Kenya</option>
                                                <option data-subtext="(KI)" value="KI">Kiribati</option>
                                                <option data-subtext="(KW)" value="KW">Kuwait</option>
                                                <option data-subtext="(KG)" value="KG">Kyrgyzstan</option>
                                                <option data-subtext="(LA)" value="LA">Laos</option>
                                                <option data-subtext="(LV)" value="LV">Latvia</option>
                                                <option data-subtext="(LB)" value="LB">Lebanon</option>
                                                <option data-subtext="(LS)" value="LS">Lesotho</option>
                                                <option data-subtext="(LR)" value="LR">Liberia</option>
                                                <option data-subtext="(LY)" value="LY">Libya</option>
                                                <option data-subtext="(LI)" value="LI">Liechtenstein</option>
                                                <option data-subtext="(LT)" value="LT">Lithuania</option>
                                                <option data-subtext="(LU)" value="LU">Luxembourg</option>
                                                <option data-subtext="(MO)" value="MO">Macao</option>
                                                <option data-subtext="(MK)" value="MK">Macedonia</option>
                                                <option data-subtext="(MG)" value="MG">Madagascar</option>
                                                <option data-subtext="(MW)" value="MW">Malawi</option>
                                                <option data-subtext="(MY)" value="MY">Malaysia</option>
                                                <option data-subtext="(MV)" value="MV">Maldives</option>
                                                <option data-subtext="(ML)" value="ML">Mali</option>
                                                <option data-subtext="(MT)" value="MT">Malta</option>
                                                <option data-subtext="(MH)" value="MH">Marshall Islands</option>
                                                <option data-subtext="(MR)" value="MR">Mauritania</option>
                                                <option data-subtext="(MU)" value="MU">Mauritius</option>
                                                <option data-subtext="(YT)" value="YT">Mayotte</option>
                                                <option data-subtext="(MX)" value="MX">Mexico</option>
                                                <option data-subtext="(FM)" value="FM">Micronesia</option>
                                                <option data-subtext="(MD)" value="MD">Moldova</option>
                                                <option data-subtext="(MC)" value="MC">Monaco</option>
                                                <option data-subtext="(MN)" value="MN">Mongolia</option>
                                                <option data-subtext="(MS)" value="MS">Montserrat</option>
                                                <option data-subtext="(MA)" value="MA">Morocco</option>
                                                <option data-subtext="(MZ)" value="MZ">Mozambique</option>
                                                <option data-subtext="(NA)" value="NA">Namibia</option>
                                                <option data-subtext="(NR)" value="NR">Nauru</option>
                                                <option data-subtext="(NP)" value="NP">Nepal</option>
                                                <option data-subtext="(NL)" value="NL">Netherlands</option>
                                                <option data-subtext="(NC)" value="NC">New Caledonia</option>
                                                <option data-subtext="(NZ)" value="NZ">New Zealand</option>
                                                <option data-subtext="(NI)" value="NI">Nicaragua</option>
                                                <option data-subtext="(NE)" value="NE">Niger</option>
                                                <option data-subtext="(NG)" value="NG">Nigeria</option>
                                                <option data-subtext="(NU)" value="NU">Niue</option>
                                                <option data-subtext="(NF)" value="NF">Norfolk Island</option>
                                                <option data-subtext="(KP)" value="KP">North korea</option>
                                                <option data-subtext="(MP)" value="MP">Northern Mariana Islands</option>
                                                <option data-subtext="(NO)" value="NO">Norway</option>
                                                <option data-subtext="(OM)" value="OM">Oman</option>
                                                <option data-subtext="(PK)" value="PK">Pakistan</option>
                                                <option data-subtext="(PW)" value="PW">Palau</option>
                                                <option data-subtext="(PS)" value="PS">Palestinian Territory, Occupied</option>
                                                <option data-subtext="(PA)" value="PA">Panama</option>
                                                <option data-subtext="(PG)" value="PG">Papua New Guinea</option>
                                                <option data-subtext="(PY)" value="PY">Paraguay</option>
                                                <option data-subtext="(PE)" value="PE">Peru</option>
                                                <option data-subtext="(PH)" value="PH">Philippines</option>
                                                <option data-subtext="(PN)" value="PN">Pitcairn</option>
                                                <option data-subtext="(PL)" value="PL">Poland</option>
                                                <option data-subtext="(PT)" value="PT">Portugal</option>
                                                <option data-subtext="(PR)" value="PR">Puerto Rico</option>
                                                <option data-subtext="(QA)" value="QA">Qatar</option>
                                                <option data-subtext="(RO)" value="RO">Romania</option>
                                                <option data-subtext="(RU)" value="RU">Russia</option>
                                                <option data-subtext="(RW)" value="RW">Rwanda</option>
                                                <option data-subtext="(BL)" value="BL">Saint Barthélemy</option>
                                                <option data-subtext="(SH)" value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                                <option data-subtext="(KN)" value="KN">Saint Kitts and Nevis</option>
                                                <option data-subtext="(LC)" value="LC">Saint Lucia</option>
                                                <option data-subtext="(MF)" value="MF">Saint Martin (French part)</option>
                                                <option data-subtext="(PM)" value="PM">Saint Pierre and Miquelon</option>
                                                <option data-subtext="(VC)" value="VC">Saint Vincent and the Grenadines</option>
                                                <option data-subtext="(WS)" value="WS">Samoa</option>
                                                <option data-subtext="(SM)" value="SM">San Marino</option>
                                                <option data-subtext="(ST)" value="ST">Sao Tome and Principe</option>
                                                <option data-subtext="(SA)" value="SA">Saudi Arabia</option>
                                                <option data-subtext="(SN)" value="SN">Senegal</option>
                                                <option data-subtext="(RS)" value="RS">Serbia</option>
                                                <option data-subtext="(SC)" value="SC">Seychelles</option>
                                                <option data-subtext="(SL)" value="SL">Sierra Leone</option>
                                                <option data-subtext="(SG)" value="SG">Singapore</option>
                                                <option data-subtext="(SX)" value="SX">Sint Maarten (Dutch part)</option>
                                                <option data-subtext="(SK)" value="SK">Slovakia</option>
                                                <option data-subtext="(SI)" value="SI">Slovenia</option>
                                                <option data-subtext="(SB)" value="SB">Solomon Islands</option>
                                                <option data-subtext="(SO)" value="SO">Somalia</option>
                                                <option data-subtext="(ZA)" value="ZA">South Africa</option>
                                                <option data-subtext="(GS)" value="GS">South Georgia and the South Sandwich Islands</option>
                                                <option data-subtext="(KR)" value="KR">South korea</option>
                                                <option data-subtext="(ES)" value="ES">Spain</option>
                                                <option data-subtext="(LK)" value="LK">Sri Lanka</option>
                                                <option data-subtext="(SD)" value="SD">Sudan</option>
                                                <option data-subtext="(SR)" value="SR">Suriname</option>
                                                <option data-subtext="(SJ)" value="SJ">Svalbard and Jan Mayen</option>
                                                <option data-subtext="(SZ)" value="SZ">Swaziland</option>
                                                <option data-subtext="(SE)" value="SE">Sweden</option>
                                                <option data-subtext="(CH)" value="CH">Switzerland</option>
                                                <option data-subtext="(SY)" value="SY">Syria</option>
                                                <option data-subtext="(TW)" value="TW">Taiwan</option>
                                                <option data-subtext="(TJ)" value="TJ">Tajikistan</option>
                                                <option data-subtext="(TZ)" value="TZ">Tanzania</option>
                                                <option data-subtext="(TH)" value="TH">Thailand</option>
                                                <option data-subtext="(BS)" value="BS">The Bahamas</option>
                                                <option data-subtext="(TG)" value="TG">Togo</option>
                                                <option data-subtext="(TK)" value="TK">Tokelau</option>
                                                <option data-subtext="(TO)" value="TO">Tonga</option>
                                                <option data-subtext="(TT)" value="TT">Trinidad and Tobago</option>
                                                <option data-subtext="(TN)" value="TN">Tunisia</option>
                                                <option data-subtext="(TR)" value="TR">Turkey</option>
                                                <option data-subtext="(TM)" value="TM">Turkmenistan</option>
                                                <option data-subtext="(TC)" value="TC">Turks and Caicos Islands</option>
                                                <option data-subtext="(TV)" value="TV">Tuvalu</option>
                                                <option data-subtext="(UG)" value="UG">Uganda</option>
                                                <option data-subtext="(UA)" value="UA">Ukraine</option>
                                                <option data-subtext="(AE)" value="AE">United Arab Emirates</option>
                                                <option data-subtext="(GB)" value="GB">United Kingdom</option>
                                                <option data-subtext="(US)" value="US">United States</option>
                                                <option data-subtext="(UM)" value="UM">United States minor outlying islands</option>
                                                <option data-subtext="(UY)" value="UY">Uruguay</option>
                                                <option data-subtext="(UZ)" value="UZ">Uzbekistan</option>
                                                <option data-subtext="(VU)" value="VU">Vanuatu</option>
                                                <option data-subtext="(VA)" value="VA">Vatican city</option>
                                                <option data-subtext="(VE)" value="VE">Venezuela</option>
                                                <option data-subtext="(VN)" value="VN">Vietnam</option>
                                                <option data-subtext="(VG)" value="VG">Virgin Islands, British</option>
                                                <option data-subtext="(VI)" value="VI">Virgin Islands, United States</option>
                                                <option data-subtext="(WF)" value="WF">Wallis and Futuna</option>
                                                <option data-subtext="(EH)" value="EH">Western Sahara</option>
                                                <option data-subtext="(YE)" value="YE">Yemen</option>
                                                <option data-subtext="(ME)" value="ME">Yugoslavia/Serbia And Montenegro</option>
                                                <option data-subtext="(ZM)" value="ZM">Zambia</option>
                                                <option data-subtext="(ZW)" value="ZW">Zimbabwe</option>
                                            </select>
                                            <small class="help-block with-errors"></small>
                                        </div>
                                    </div> <!-- form-group// -->
                                    <br>
                                    <?php for ($i = 0; $i < $rooms; $i++) { ?>
                                        <?php for ($a = 0; $a < $adults[$i] - 1; $a++) {
                                            $adult_count = $a + 2; ?>
                                            <div class="traveller-<?php echo $adult_count; ?>">
                                                <div class="subheading col-md-12" style="margin-bottom: 10px;">
                                                    <h4 class="title"><strong> <?php echo "Room " . $rooms . " : Adult " . $adult_count; ?> <span id="printtitle"></span> <span id="printfirstname"></span> <span id="printlastname"></span></strong></h4>
                                                </div>
                                                <div id="traveler-1">
                                                    <label class="col-sm-2 control-label">Full Name</label>
                                                    <div class="col-sm-2 form-group">
                                                        <select class="form-control selectpicker title" name="adults_title[]" id="salutation" required title="Title" data-error="Please select title">
                                                            <option value="Mr">Mr</option>
                                                            <option value="Ms">Ms</option>
                                                            <option value="Mrs">Mrs</option>
                                                        </select>
                                                        <small class="help-block with-errors"></small>
                                                    </div>
                                                    <div class="col-sm-3 form-group">
                                                        <input pattern="^[a-zA-Z]+( [a-zA-Z]+)*$" minlength="2" maxlength="30" type="text" class="form-control first_name" id="tfirsttname" value="" name="adults_fname[]" placeholder="First Name" data-error="Valid First Name is required" required>
                                                        <small class="help-block with-errors"></small>
                                                    </div>
                                                    <div class="col-sm-4 form-group">
                                                        <input pattern="^[a-zA-Z]+( [a-zA-Z]+)*$" minlength="2" maxlength="30" type="text" class="form-control last_name" id="tlastname" value="" name="adults_lname[]" placeholder="Last Name" data-error="Valid Last Name is required" required>
                                                        <small class="help-block with-errors"></small>
                                                    </div>
                                                </div> <!-- form-group// -->
                                                <?php if ($PANMandatory = 'true') { ?>
                                                    <div class="">
                                                        <label class="col-sm-2 control-label">PAN Number</label>
                                                        <div class="col-sm-3 form-group">
                                                            <input minlength="4" maxlength="30" type="text" class="form-control pan_no" id="tpan" value="" name="user_pan[]" placeholder="PAN Number" data-error="Valid PAN Number is required" required>
                                                            <small class="help-block with-errors"></small>
                                                        </div>
                                                    </div>
                                            </div>
                                            <br>
                                <?php }
                                            }
                                        } ?>
                                </div>

                            </article><!-- panel-body// -->
                            <div class="panel-footer text-right">
                                <button id="traveler-submit-btn2" class="btn btn-warning btn-lg">Continue</button>
                                <input type="hidden" value="64a49e65f090ef45950eff8fc0d91d8f" name="cart_id">
                                <input type="hidden" id="pnr_no" name="pnr_no">
                            </div>
                        </form>
                        <script>
                            $("#traveler-submit-btn2").click(function(e) {
                                e.preventDefault();
                                var datas = $('.form').serialize();
                                var url = "<?php echo base_url(); ?>hotels/confirm_reservation";
                                // console.log(datas);
                                $.ajax({
                                    type: "POST",
                                    url: url,
                                    data: $('.form').serialize(),
                                    dataType: 'json',
                                    cache: false,
                                    success: function(data) {
                                        console.log(data.results);
                                        //$("#detailss").show();
                                        //    activate_block('payment-block');
                                        $('.guest-fullview').css("display", "none");
                                        $('.payment-fullview').css("display", "block");
                                        $('#guest-block').addClass('panel-disable');
                                        $('#guest-block').removeClass('panel-active');

                                        $('#payment-block').addClass('panel-active');
                                        $('#payment-block').removeClass('panel-disable');
                                        //    $('#hotel_results2').html(data);
                                    }
                                });
                                return false;
                            });
                        </script>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('.panel.panel-booking').on('blockActive', function() {
                                    if ($(this).hasClass('panel-active') && $(this).attr('id') == 'payment-block') {
                                        $("#coupon-block").hide();
                                    } else {
                                        $("#coupon-block").show();
                                    }
                                });
                                $("#salutation").on("change", function() {
                                    $("#printtitle").text($(this).val());
                                });
                                $("#tfirsttname").on("keyup", function() {
                                    $("#printfirstname").text($(this).val());
                                });
                                $("#tlastname").on("keyup", function() {
                                    $("#printlastname").text($(this).val() + ' - ');
                                });
                                $('#traveler-form22').validator({
                                    disable: true,
                                    focus: false,
                                }).on('submit', function(e) {
                                    if (e.isDefaultPrevented()) {
                                        // handle the invalid form...
                                        return false;
                                    } else {
                                        // everything looks good!
                                        saveTravelerInfor();
                                        return false;
                                    }
                                });
                            }); //onclick="saveTravelerInfor()"

                            var xhr;

                            function saveTravelerInfor() {

                                $('#traveler-submit-btn2').prop('disabled', true);
                                $("#name-view-div").text($("#salutation").find(":selected").val() + ' ' + $("#tfirsttname").val() + ' ' + $("#tlastname").val());
                                $("#email-view-div").text($("#email").val());
                                $("#phone-view-div").text($("#countryCode").val() + ' ' + $("#tpnumber").val());
                                $("#address-view-div").text($("#taddress").val());
                                //        $("#city-view-div").text($("#tcity").val());
                                //        $("#country-view-div").text($("#country").find(":selected").text() + ' (' + $("#country").find(":selected").val() + ')');

                                if (xhr && xhr.readyState !== 4) {
                                    xhr.abort();
                                }
                                xhr = $.ajax({
                                    type: 'POST',
                                    async: true,
                                    dataType: 'json',
                                    data: $('form[name="traveler-form2"]').serializeArray(),
                                    url: 'https://localhost/travelfreebuy.com/hotels/confirm_reservation',
                                    beforeSend: function() {
                                        $(".loading-content").fadeIn();
                                    },
                                    success: function(response) {
                                        if (typeof response.success !== 'undefined' && response.success === 1) {
                                            $("#traveler-submit-btn").text('Continue');
                                            //payment button Text Change
                                            var paynow = 'Pay Now' + ' ' + response.total;
                                            $('#checkin,#payButton').val(paynow);
                                            if (typeof response.service_charge !== 'undefined') {
                                                $('#service_charge_rate').removeClass('hide').find('span').text(response.service_charge);
                                            }

                                            if (!$.isEmptyObject(response.html)) {
                                                $("#payment-data").html(response.html);
                                            }
                                            if (typeof response.qr_code_url !== 'undefined' && response.qr_code_url != '') {
                                                if (navigator.userAgent.toLowerCase().indexOf('payby') !== -1) {
                                                    $('#payby_token').val(response.payby_token);
                                                    if (typeof ToPayJSBridge === 'undefined') {
                                                        document.addEventListener('ToPayJSBridgeReady', onBridgeReady, false)
                                                    } else {
                                                        onBridgeReady();
                                                    }
                                                    // call PayBy API
                                                    window.ToPayJSBridge.invoke(
                                                        'ToPayRequest', {
                                                            appId: '200006765142', // partnerId
                                                            token: response.payby_token, // token
                                                        },
                                                        function(data) {
                                                            const res = JSON.parse(data);
                                                            console.log('ToPayJSBridge:res', res);
                                                            $('#pnr_no').val(response.pnr_no);
                                                            if (res.status === 'success') {
                                                                // Success Callback
                                                                window.location.href = "https://travelfreebuy.com/payby/confirm/" + response.pnr_no + "/success";
                                                            } else {
                                                                window.location.href = "https://travelfreebuy.com/payby/confirm/" + response.pnr_no + "/failed";
                                                            }
                                                        }
                                                    )
                                                }
                                                $("#qr_code_img").html(response.qr_code_url);
                                                $(".payby").removeClass("hide");
                                            } else {
                                                $(".payby").addClass("hide");
                                            }
                                            activate_block('guest-block');
                                        } else {
                                            window.location = '';
                                        }
                                    },
                                    complete: function() {
                                        $(".loading-content").fadeOut();
                                        $('#traveler-submit-btn').prop('disabled', false);
                                    }
                                });
                            }

                            function savepassagerdetails() {
                                $.ajax({
                                    url: "https://localhost/travelfreebuy.com/hotels/confirm_reservation",
                                    type: "post",
                                    data: $('form[name="traveler-form"]').serializeArray(),
                                    success: function(d) {
                                        alert(d);
                                    }
                                });
                            }

                            function onBridgeReady() {
                                console.log('ToPayJSBridge:start');
                                window.ToPayJSBridge.init(function(message, responseCallback) {})
                            }

                            function paybyRestartJSAPI() {
                                if (navigator.userAgent.toLowerCase().indexOf('payby') !== -1) {
                                    // call PayBy API
                                    var payby_token = $("#payby_token").val();
                                    window.ToPayJSBridge.invoke(
                                        'ToPayRequest', {
                                            appId: '200006765142', // partnerId
                                            token: payby_token, // token
                                        },
                                        function(data) {
                                            const res = JSON.parse(data);
                                            console.log('ToPayJSBridge:res', res);
                                            var pnr_no = $('#pnr_no').val();
                                            if (res.status === 'success') {
                                                // Success Callback
                                                window.location.href = "https://travelfreebuy.com/payby/confirm/" + pnr_no + "/success";
                                            } else {
                                                window.location.href = "https://travelfreebuy.com/payby/confirm/" + pnr_no + "/failed";
                                            }
                                        }
                                    )
                                }
                            }
                        </script>
                        <article class="loading-content" style="display: none;">
                            <img src="https://asfartrip.com/public/assets/images/misc/loading.gif">
                            <h3 class="text1">Saving your information</h3>
                            <h5 class="text2">One moment please ...</h5>
                            <h5 class="text2"> </h5>
                        </article>
                    </div>
                    <!-- ============== (traveller) full view .end// ============== -->
                </section> <!-- panel// -->

                <section class="panel panel-disable panel-booking" id="payment-block">
                    <header class="panel-heading">
                        <span class="num-step">3</span>
                        <h4 class="panel-title">Payment</h4>
                    </header>
                    <!-- ============== (payment) compact view ============== -->
                    <div class="wrap-disable compact-view" style="display: none">
                        <article class="blok-body">
                            <h2 class="text-center">Thank you for payment. </h2>
                        </article>
                    </div>
                    <!-- ============== (payment) compact view  .end// ============== -->

                    <!-- ============== (payment) full view ============== -->
                    <div class="wrap-active full-view payment-fullview" style="display: none" id="paymentsec">
                        <article class="panel-body">
                            <div class="row-sm">

                                <p class="alert alert-warning"> By completing this booking. I acknowledge and agree to the <a href="/en/booking-policy" target="_blank">booking policy</a>, the <a href="/en/privacy-policy" target="_blank">privacy policy</a> and the <a href="/en/terms-of-service" target="_blank">terms & conditions</a> that are applicable to this itinerary. </p>

                                <aside class="col-sm-3">
                                    <ul class="nav nav-payment-type">
                                        <li class=" active"><a href="#credit" data-toggle="tab" onclick="activepaymenttab(this);"> <i class="fa fa-credit-card"></i> Payment</a></li>

                                        <!-- <li class=" payby"><a href="#payby" data-toggle="tab" style="background-color: #f2f2f2;"> <img src="<?php echo base_url('assets/icons/flights_icon/payby_logo.png'); ?>"></a></li> -->
                                    </ul>
                                </aside><!-- col // -->
                                <div class="col-sm-9 tab-content">
                                    <article class="tab-pane border radius p20 mb15  in active" id="credit">
                                        <div class="row no-padding">
                                            <div class="col-md-12 col-lg-12 font12">
                                                <label class="checkbox-custom checkbox-custom-sm">
                                                    <input name="terms" type="checkbox" class="required" value="" required /><i></i>
                                                    <span>Yes, I accept the terms and conditions of the policy</span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php //echo"<pre>";print_r($this->session->search_details);
                                        $searchdata = $this->session->search_details;
                                        $pass_info = $this->session->passenger_info;
                                        ?>
                                        <form name="booking" method="POST" action="<?php echo site_url() ?>razorpay/pay.php" id="continueform2">
                                            <input type="hidden" name="callBackId" value="<?php echo $pass_info['callBackId']; ?>" required />
                                            <input type="hidden" name="hotelCode" value="<?php echo $pass_info['hotelCode']; ?>" required />
                                            <input type="hidden" name="searchId" value="<?php echo $pass_info['searchId']; ?>" required />
                                            <input type="hidden" name="sessionId" value="<?php echo $pass_info['sessionId']; ?>" required />
                                            <input type="hidden" name="email" value="<?php echo $pass_info['user_email']; ?>" />
                                            <input type="hidden" name="phone" value="<?php echo $pass_info['mobilecountryCode'] . $pass_info['user_mobile']; ?>" />
                                            <input type="hidden" name="service_type" value="1" />

                                            <input type="hidden" name="amount" id="amount" value="<?php echo round($total_cost); ?>" />
                                            <input type="hidden" name="date" id="date" value="<?php echo date('Y-m-d'); ?>">

                                            <input type="hidden" name="payment_type" value="deposit" checked="checked">
                                            <input type="hidden" name="payment_type" value="payment" checked="checked">


                                            <div class="panel-footer text-right">
                                                <button type="submit" value="submit" id="traveler-submit-btn3" class="btn btn-warning btn-lg"><span class="spin-loader hide"><i class="fa fa-spinner fa-spin"></i></span> Continue to Payment</button>
                                            </div>

                                        </form>
                                        <div id="service_charge_rate" class="alert text-warning hide"><i class="fa fa-info-circle"></i> Amount of INR <span> </span> is added as a service charges for card payment booking.</div>
                                        <p style="font-weight:bold;font-size:14px;text-align:center;padding: 0px;" id="bookingfailed"></p>
                                        <br>

                                        <article class="well m0 p0">
                                            <div class="row-sm">
                                                <aside class="col-sm-4">
                                                    <figure class="iconbox iconbox-center">
                                                        <span class="icon-shape icon-sm round"><i class="fa fa-lock  fa-lg"></i></span>
                                                        <div class="small text-wrap">
                                                            <strong>Trusted</strong>
                                                            <p>We do not store or view your card data.</p>
                                                        </div>
                                                    </figure>
                                                </aside> <!-- col.// -->
                                                <aside class="col-sm-4">
                                                    <figure class="iconbox iconbox-center">
                                                        <span class="icon-shape icon-sm round"><i class="fa fa-shield fa-lg"></i></span>
                                                        <div class="small text-wrap">
                                                            <strong>100% Secure</strong>
                                                            <p>We use 128-bit SSL encryption.</p>
                                                        </div>
                                                    </figure>
                                                </aside> <!-- col.// -->
                                                <aside class="col-sm-4">
                                                    <figure class="iconbox iconbox-center">
                                                        <span class="icon-shape icon-sm round"><i class="fa fa-credit-card  fa-lg"></i></span>
                                                        <div class="small text-wrap">
                                                            <strong>Various payment</strong>
                                                            <p>We accept all major credit and debit cards.</p>
                                                        </div>
                                                    </figure>
                                                </aside> <!-- col.// -->
                                            </div> <!-- row.// -->
                                        </article> <!-- well.// -->
                                        <script type="text/javascript">
                                            $(function() {
                                                /* json object contains
                                                 1) payOptType - Will contain payment options allocated to the merchant. Options may include Credit Card, Net Banking, Debit Card, Cash Cards or Mobile Payments.
                                                 2) cardType - Will contain card type allocated to the merchant. Options may include Credit Card, Net Banking, Debit Card, Cash Cards or Mobile Payments.
                                                 3) cardName - Will contain name of card. E.g. Visa, MasterCard, American Express or and bank name in case of Net banking. 
                                                 4) status - Will help in identifying the status of the payment mode. Options may include Active or Down.
                                                 5) dataAcceptedAt - It tell data accept at CCAvenue or Service provider
                                                 6)error -  This parameter will enable you to troubleshoot any configuration related issues. It will provide error description.
                                                 */
                                                $('[data-toggle="popover"]').popover();
                                                $(".payOption").click(function() {
                                                    var paymentOption = "";
                                                    paymentOption = $(this).val();
                                                    $("#card_type").val(paymentOption.replace("OPT", ""));
                                                });

                                            });

                                            $(document).ready(function() {
                                                // jQuery code

                                                $('#customerData').validator({
                                                    disable: true,
                                                    focus: false,
                                                }).on('submit', function(e) {
                                                    if (e.isDefaultPrevented()) {
                                                        // handle the invalid form...
                                                    } else {
                                                        return true;
                                                    }
                                                });

                                            });
                                        </script>

                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('.cardNumberC').focusout(function() {
                                                    var c_length = $('.cardNumberC').val().length;
                                                    if (c_length > 0) {
                                                        if (!validAlgorithm) {
                                                            $("span.creditCardError").text("Please enter valid card number.");
                                                            $(".cardfield").hide();
                                                        }
                                                    }
                                                });
                                                $('.cardNumberC').bind("keydown", function(event) {
                                                    $('.cardNumberC').validateCreditCard(function(result) {
                                                        if (result.card_type != null) {
                                                            // $('.cardNumberC').removeClass("creditcard");
                                                            cardType = result.card_type.name;
                                                            cardLegnth = result.length_valid;
                                                            $("#card-code").text(cardType);
                                                            $('.cardNumberC').attr("maxlength", result.card_type.valid_length)
                                                            validAlgorithm = result.luhn_valid;
                                                            if ($('.cardNumberC').val().length == result.card_type.valid_length) {
                                                                //alert(result.card_type.valid_length);
                                                                if (!validAlgorithm) {
                                                                    $("span.creditCardError").text("Please enter valid card number.");
                                                                    $("#card-code").text('none');
                                                                    $(".cardfield").hide();
                                                                } else {
                                                                    $("span.creditCardError").text("");
                                                                }
                                                            }

                                                        } else {
                                                            cardType = "";
                                                            cardLegnth = "";
                                                            validAlgorithm = "";
                                                        }

                                                        if ($('.cardNumberC').val() == "") {
                                                            $("span.cards").find("span").each(function() {
                                                                $(this).show();
                                                            });

                                                        } else {
                                                            switch (cardType) {
                                                                case "MasterCard":
                                                                    $(".cvvnumber").attr("maxlength", "3");
                                                                    break;
                                                                case "Visa":
                                                                    $(".cvvnumber").attr("maxlength", "3");
                                                                    break;

                                                                case "Amex":
                                                                    $(".cvvnumber").attr("maxlength", "4");
                                                                    // show American Express icon
                                                                    break;
                                                                case "JCB":
                                                                    $(".cvvnumber").attr("maxlength", "3");
                                                                    // show American Express icon
                                                                    break;
                                                                case "Diners Club":
                                                                    $(".cvvnumber").attr("maxlength", "3");
                                                                    // show American Express icon
                                                                    break;
                                                                case "Maestro":
                                                                    break;
                                                                default:
                                                                    $("#card-code").text('none');
                                                                    $("img.selectCard").removeClass("cardshow");
                                                            }
                                                        }
                                                    });
                                                });

                                            });

                                            function validCharacters(kbEvent) {
                                                if (window.event) {
                                                    keyCode = kbEvent.keyCode;
                                                } else {
                                                    keyCode = kbEvent.which;
                                                }

                                                var ch = String.fromCharCode(keyCode);
                                                numcheck = /^[a-zA-Z ]*$/;
                                                return numcheck.test(ch);

                                            }

                                            function validNo(input, kbEvent) {
                                                var keyCode, keyChar;
                                                keyCode = kbEvent.keyCode;
                                                if (window.event)
                                                    keyCode = kbEvent.keyCode;
                                                else
                                                    keyCode = kbEvent.which;
                                                if (keyCode == null)
                                                    return true;
                                                keyChar = String.fromCharCode(keyCode);
                                                var charSet = "0123456789";
                                                if (charSet.indexOf(keyChar) != -1)
                                                    return true;
                                                if (keyCode == null || keyCode == 0 || keyCode == 8 || keyCode == 9 || keyCode == 13 || keyCode == 27)
                                                    return true;
                                                return false;
                                            }
                                        </script>

                                        <script src="https://asfartrip.com/public/assets/js/jquery.jcryption1.js"></script>
                                        <script src="https://asfartrip.com/public/assets/js/ccavRequestHandler.js"></script>
                                        <script src="https://asfartrip.com/public/assets/js/jquery.creditCardValidator.js"></script>
                                    </article><!--  tab-pane //  -->


                                    <article class="tab-pane well fade payby hide" id="payby">
                                        <h5 class="title"><b>PayBy</b></h5><br>
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <p>PayBy is a leading contactless and cashless mobile payment provider in UAE. PayBy is available for IOS and Android devices, and also integrated into ToTok and BOTIM.</p>
                                                <b>To make the payment:</b>
                                                <ul class="list-mobile list-bullet list-inline cfx">
                                                    <li>Scan the QR code</li>
                                                    <li>Confirm the amount</li>
                                                    <li>Make the payment</li>
                                                </ul>
                                                <p><b>Note:</b> The QR Code is valid upto 2 hours</p>
                                            </div>
                                            <div class="col-sm-5">
                                                <p id='qr_code_img' style="text-align: right;"></p>
                                            </div>
                                        </div>
                                    </article><!--  tab-pane //  -->

                                    <p class="wrap-secure text-center">
                                        <img src="https://asfartrip.com/public/assets/images/misc/secure-pay.png">
                                        <img src="https://asfartrip.com/public/assets/images/logos-payment/pay-visa.png">
                                        <img src="https://asfartrip.com/public/assets/images/logos-payment/pay-mastercard.png">
                                        <img src="https://asfartrip.com/public/assets/images/logos-payment/pay-american-ex.png">
                                    </p>
                                </div><!-- col // -->
                            </div> <!-- row// -->
                        </article> <!-- panel-body// -->
                    </div>
                    <!-- ============== (payment) full view .end// ============== -->
                </section> <!-- panel// -->
            </main><!-- col // -->
            <aside class="col-sm-3">

                <p class="alert alert-info alert-points"> <i class="material-icons">&#xE263;</i> <span>Complete your order and earn Points for a discount on a future purchase.</span></p>
                <article class="panel panel-default" id="sticker">
                    <header class="panel-heading">
                        <h4 class="panel-title text-uppercase">ROOM CHARGES</h4>
                    </header> <!-- panel-heading// -->
                    <div class="panel-body price-wrap">
                        <p><span class="text-dots" data-toggle="tooltip" title="" data-original-title="<?php echo $roomDetails->room_type ?>" style="width:65%;"><?php echo $rooms ?> x <?php echo $roomDetails->room_type ?>:</span> <span class="val"> INR <num class="count"><?php echo $total_cost - ($roomDetails->admin_markup + $roomDetails->payment_charge); ?></num></span></p>
                        <p>Service & Fees: <span class="val">INR <num class="count"><?php echo number_format($roomDetails->admin_markup + $roomDetails->payment_charge); ?></num></span></p>
                        <p id="coupon-info-block" style="display: none">Discount <span class="val txt-green"> INR <num class="count" id="coupon-discount">0</num></span></p>
                        <hr>
                        <p> <strong class="h4">Total (incl. VAT) <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="" data-original-title="Value-added tax (VAT) is a tax on the consumption or use of goods and services levied at the point of sale. Please check our FAQ's"></i> </strong>
                            <span class="val"> <strong class="h4">INR <num id="price-txt" class="count"><?php echo $total_cost; ?></num></strong> <br>
                            </span>
                        </p>
                        <p>
                            <small style="color: #888;"><i class="fa fa-info-circle"></i> <strong>Prices do not include city tax</strong></small>
                        </p>
                    </div><!-- panel-body // -->
                </article>
                <article class="panel panel-default">
                    <header class="panel-heading">
                        <h4 class="panel-title">Booking Details</h4>
                    </header> <!-- panel-heading// -->
                    <div class="panel-body hotel-pricing-wrap">
                        <article class="hotel-overview-aside">
                            <?php //if ($gttd) { 
                            ?>
                            <div class="img-wrap">
                                <img alt="" src="<?php echo $gttd; ?>" onerror="this.onerror=null;this.src='<?php echo base_url(); ?>assets/images/noimage-hotel.jpg';">

                            </div>
                            <div class="info-wrap">
                                <small class="type">
                                    <img class="img-rating" src="<?php echo base_url(); ?>assets/images/stars/rating-<?php echo $roomDetails->star; ?>.png">

                                </small>
                                <h4 class="title"><?php echo ucwords(strtolower($roomDetails->hotel_name)); ?></h4>
                                <small class="area text-dots"> <i class="fa fa-map-marker"></i> <?php echo ucwords(strtolower($roomDetails->address)); ?></small>
                            </div>
                        </article>
                        <hr>
                        <div class="dates-wrap clearfix">
                            <p class="col-date-in">
                                <i class="fa fa-calendar" aria-hidden="true"></i> Check in <br> <span class="val"> <?php echo date('d', $checkinStrTime) ?> <?php echo date('M, Y', $checkinStrTime) ?></span>
                            </p>
                            <p class="col-nights text-center">
                                <!-- Nights <br>  -->
                                <span class="val"> > </span>
                            </p>
                            <p class="col-date-out text-right">
                                Check out <i class="fa fa-calendar" aria-hidden="true"></i><br> <span class="val"> <?php echo date('d', $checkoutStrTime) ?> <?php echo date('M, Y', $checkoutStrTime) ?></span>
                            </p>
                        </div>
                        <hr>
                        <div class="guest-wrap">
                            <!-- <p><i class="fa fa-user" aria-hidden="true"></i> Guests: <span class="val">2 Adult, 0 Children</span></p> -->
                            <p><i class="fa fa-bed" aria-hidden="true"></i> Room: <span class="val"><?php echo $rooms ?> x <?php echo $roomDetails->room_type ?> </span></p>
                        </div>
                        <!-- <a  href="https://travelfreebuy.com/en/hotel/details/TVRVd05EVXc=/eyJjaXR5IjoiRHViYWksIEFFIiwidGFyZ2V0X3NlYXJjaCI6Ikx8NDA2MDEiLCJuYXRpb25hbGl0eSI6IkFFIiwicmVzaWRlbmN5IjoiQUUiLCJjaGVja19pbiI6IjA5LTA0LTIwMjIiLCJjaGVja19vdXQiOiIxMC0wNC0yMDIyIiwibmlnaHRzIjoxLCJTU0lEIjoicmltYmFtbjEzZzRva3FrNm01bGJ1bmM0bGlsc2FraGEiLCJyb29tX2NvdW50IjoiMSIsImFkdWx0czEiOiIyIiwiY2hpbGRzMSI6IjAiLCJhZHVsdF9jb3VudCI6MiwiY2hpbGRfY291bnQiOjAsImJvb2tScUhvdGVsSWQiOiIxNTA0NTAiLCJib29rUnFHaWF0YUlkIjoiMjE3NTE4In0" class="link"><i class="fa fa-edit"></i> Change booking</a> -->
                    </div> <!-- panel-body // -->
                </article> <!-- panel// -->
                <article class="panel panel-default hidden-sm hidden-xs">
                    <header class="panel-heading">
                        <h4 class="panel-title">Need a help?</h4>
                    </header> <!-- panel-heading// -->
                    <div class="panel-body">
                        <p>Got any questions or need some help? <br /> Our team is available <strong>24/7</strong> </p>
                        <p>Travelfreebuy</p>
                        <p> support@travelfreebuy.com</p>
                    </div> <!-- panel-body // -->
                </article> <!-- panel// -->
                <script type="text/javascript">
                    function check_coupon() {
                        $('#check-coupon').prop('disabled', true);
                        $.ajax({
                            type: 'POST',
                            url: 'https://travelfreebuy.com/discount/validateCoupon',
                            data: $('form[name="coupon_form"]').serializeArray(),
                            async: true,
                            dataType: 'json',
                            success: function(data) {
                                if (!$.isEmptyObject(data.discount) && data.discount > 0) {
                                    $("#coupon-info-block").fadeIn(1000).find('#coupon-discount').text(data.discount); // SHow information
                                    $("#coupon-block").fadeOut(1000, function() {
                                        $(this).remove();
                                    });
                                    var price_new = parseFloat($("#price-txt").text()) - parseFloat(data.discount);
                                    $("#price-txt").text(price_new);
                                } else { //Not valid or not applied

                                }
                            },
                            complete: function() {
                                $('#check-coupon').prop('disabled', false);
                            }
                        });
                    }

                    function check_points() {
                        $('#check-points').prop('disabled', true);
                        $.ajax({
                            type: 'POST',
                            url: 'https://travelfreebuy.com/discount/validatePoints',
                            data: $('form[name="points_form"]').serializeArray(),
                            async: true,
                            dataType: 'json',
                            success: function(data) {
                                if (data.discount > 0) {
                                    $("#coupon-info-block").find('#coupon-discount').text(data.discount).fadeIn(1000); // SHow information
                                    $("#coupon-block").fadeOut(1000, function() {
                                        $(this).remove();
                                    });
                                    var price_new = parseFloat($("#price-txt").text()) - parseFloat(data.discount);
                                    $("#price-txt").text(price_new);
                                } else { //Not valid or not applied
                                    $('#check-points').prop('disabled', false);
                                }
                            }
                            //            ,
                            //            complete: function () {
                            //                $('#check-points').prop('disabled', false);
                            //            }
                        });
                    }

                    $(document).ready(function() {
                        $("#check-coupon").on("click", function() {
                            check_coupon();
                        });
                        $("#check-points").on("click", function() {
                            check_points();
                        });
                    });
                </script>
            </aside><!-- col // -->
        </div><!--  row// -->
    </div> <!-- container // -->

    <br><br>
</section>

<div class="modal fade" id="session_expire" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" oncontextmenu="return false;" onkeydown="return false;" onmousedown="return false;">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="https://asfartrip.com/public/assets/images/misc/session2.png">
                <h4 class="h4 text-primary">Page is not active during 30 minutes</h4>
                <p class="text-muted">Please click the search button,<br> we will give you new fresh information</p>
                <p><button type="button" id="search_again" class="btn btn-warning"><i class="fa fa-search"></i> Search again</button></p>

            </div>
        </div>
    </div> <!-- modal-body// -->
</div><!-- ========================= SECTION CONTENT END // ========================= -->
<script type="text/javascript">
    function reloadIframeSource(url) {
        console.log(url);
        var iframe = $("#paymentFrame");
        iframe.attr("src", url);
    }
    $(document).ready(function() {
        $("#search_again").on("click", function() {
            window.location = "http://localhost/travelfreebuy.com/hotels/results";
        });

        $("#deposit-form").submit(function() {
            $btn = $(this).find('button[type=submit]');
            $btn.find("i").removeClass("hide");
            $btn.prop("disabled", true);
        });
        if ($("#booking-countdown").length > 0) {
            var time = 1738;
            loadCounter(time);
        }
    });

    function loadCounter(time) {
        if (time === 0) {
            reloadWindowPopup(0);
            return;
        }
        var minutes = Math.floor(time / 60);
        var seconds = time % 60;
        var counter = new Date();
        counter.setMinutes(counter.getMinutes() + minutes);
        counter.setSeconds(counter.getSeconds() + seconds);
        $('#booking-countdown').countdown(counter, function(event) {
            $(this).html(event.strftime('%N:%S'));
        }).on('finish.countdown', function(event) {
            reloadWindowPopup(0);
        });
    }
</script>
<script src="https://asfartrip.com/public/assets/plugins/jquery.countdown.min.js" defer></script>
<!-- jquery sticky -->
<script src="https://asfartrip.com/public/assets/plugins/sticky/jquery.sticky-kit.min.js" defer="defer"></script>
<?php $this->load->view('home/home_template/footer2'); ?>