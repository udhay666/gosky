<?php $this->load->view('home/header'); ?>

<link rel="stylesheet" href="<?= base_url() ?>assets_gosky/css/flight/flight_paymentdetails.css">
<?php
// $session_data = $this->session->userdata('hotel_search_data');
$session_data = unserialize($roomDetails->searcharray);
$city_arr = explode(',', $session_data['cityName']);
$cityName = $city_arr[0];

//print_r($roomDetails);
//print_r( $roomDetails["hotel_name"]);
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

<main>
    <!-- breadcrumb start -->
    <section class="res_bc">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Hotel</a></li>
                <li class="breadcrumb-item"><a href="#">HotelFaredetails</a></li>
            </ol>
        </nav>
    </section>
    <!-- breadcrumb  end -->

    <!-- paymentdetail start -->
    <section class="mt-5">
        <div class="container ">
            <div class="row">
                <div class="col-md-12 col-lg-8 ">
                    <div class="htlInfoContainer appendBottom20">
                        <div class="accordHead">
                            <div>
                                <p class="accordHead__text">
                                    <span class="capText">Hotel Information</span>
                                </p>
                            </div>
                            <div>
                                <span class="accordBtn appendLeft20 up"></span>
                            </div>
                        </div>
                        <div class="htlInfo__wrapper">
                            <div class="htlInfo__dtl">
                                <div class="htlInfo__dtlLeft">

                                    <div class="makeFlex appendBottom5">
                                        <h3 class="latoBlack font22 blackText">
                                            <?php echo $roomDetails->hotel_name; ?>
                                        </h3>
                                        <span class="sRating" style="
                        display: inline-flex;
                        margin-top: 5px;
                        margin-left: 10px;
                      ">
                                            <span class="sRating__row sRating__row--active" style="width: 65px">
                                                <?php for ($s = 0; $s < $roomDetails->star; $s++) { ?>
                                                    <img width="12" height="12" src="<?php echo base_url(); ?>images/hotel/hotel-booking/icon/ic_star_selected.png" alt="star<?= $s ?>" />
                                                <?php } ?>

                                            </span>

                                        </span>
                                    </div>
                                    <p class="font12 grayText">
                                        <?php echo $roomDetails->address; ?>
                                    </p>
                                </div>
                                <div class="htlInfo__dtlRight">
                                    <div class="htlInfo__dtlRightImg">
                                        <img src=" <?php echo $roomDetails->hotel_image; ?>" alt="hotelimg" />

                                    </div>
                                </div>
                            </div>
                            <div class="chkCont">
                                <div class="chkCont__col">
                                    <div class="makeFlex column">
                                        <span class="font10 grayText appendBottom3">CHECK IN</span>
                                        <span class="latoBlack font18 blackText appendBottom3"><?php echo $session_data['checkIn']; ?></span>

                                    </div>
                                    <div class="chkCont__night">
                                        <span><?php echo $session_data['nights']; ?> Night</span>
                                    </div>
                                    <div class="makeFlex column">
                                        <span class="font10 grayText appendBottom3">CHECK OUT</span>
                                        <span class="latoBlack font18 blackText appendBottom3"><?php echo $session_data['checkOut']; ?></span>
                                    </div>
                                </div>
                                <div class="chkCont__col">
                                    <p class="font16 blackText">
                                        <span class="latoBlack"><?php echo $session_data['adults_count']; ?></span>&nbsp;Adults&nbsp;|
                                        <?php if ($session_data['childs'] != "") { ?>
                                            <span class="latoBlack"><?php echo $session_data['childs_count']; ?></span>&nbsp;Childs
                                        <?php } ?>
                                        <span><?php echo $session_data['rooms']; ?> Room</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="htlInfo__content">
                            <div class="rmDtl appendBottom15 d-none">
                                <div class="roomDtlCard">
                                    <div class="roomDtlCard__head">
                                        <div class="makeFlex column" style="width: 80%">
                                            <div class="makeFlex">
                                                <p class="latoBlack font14 blackText capText makeFlex" style="max-width: 82%; line-height: 1.2">
                                                    Garden view Room
                                                </p>
                                            </div>
                                            <p class="grayText appendTop5"><?php echo $session_data['adults']; ?> Adults</p>
                                            <?php if ($session_data['childs'] != "") { ?> <p class="grayText appendTop5">
                                                    <?php echo $session_data['childs']; ?> Childs</p><?php  }  ?>
                                        </div>
                                        <a class="latoBlack font11 pointer anchor" data-bs-toggle="modal" data-bs-target="#allroomInclusionModal">View All Room Inclusions</a>
                                        <div class="modal fade" id="allroomInclusionModal" tabindex="-1" role="dialog" aria-labelledby="allroomInclusionModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="allroomInclusionModalLabel">
                                                            Garden view Room
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="cm__modalContent">
                                                            <p class="latoBold font16 appendBottom15 roomDtlCard__heading">
                                                                Room Inclusions
                                                            </p>
                                                            <ul class="roomDtlCard__list">
                                                                <li class="roomDtlCard__listItem">
                                                                    <span class="roomDtlCard__listIcon">
                                                                        <span class="blackDot"></span></span>
                                                                    <div class="makeFlex column">
                                                                        <p class="font14 latoBlack blackText">
                                                                            Free Breakfast
                                                                        </p>
                                                                        <p class="appendTop3 lineHight20">
                                                                            Complimentary Breakfast is available.
                                                                        </p>
                                                                    </div>
                                                                </li>
                                                                <li class="roomDtlCard__listItem">
                                                                    <span class="roomDtlCard__listIcon"><span class="blackDot"></span></span>
                                                                    <div class="makeFlex column">
                                                                        <p class="font14 latoBlack blackText">
                                                                            15 % Discount On F&amp;B Services
                                                                        </p>
                                                                        <p class="appendTop3 lineHight20">
                                                                            15% discount on F&amp;B Services is
                                                                            available.
                                                                        </p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="roomDtlCard__content">
                                        <p class="font16 latoBold blackText appendBottom10">
                                            Price Includes
                                        </p>
                                        <ul class="roomDtlCard__list">
                                            <li class="roomDtlCard__listItem">
                                                <span class="roomDtlCard__listIcon">
                                                    <span class="blackDot"></span>
                                                </span>
                                                <div class="makeFlex column">
                                                    <p class="">Free Breakfast</p>
                                                </div>
                                            </li>
                                            <li class="roomDtlCard__listItem">
                                                <span class="roomDtlCard__listIcon">
                                                    <span class="blackDot"> </span>
                                                </span>
                                                <div class="makeFlex column">
                                                    <p class="">15 % Discount On F&amp;B Services</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="appendTop10 appendBottom10">
                                            <div class="makeFlex hrtlCenter">
                                                <span class="roomDtlCard__listIcon">
                                                    <span class="sprite blackDot"></span>
                                                </span>
                                                <div>
                                                    <span class="redText">Non-Refundable</span>
                                                    <span class="font12">
                                                        | On Cancellation, You will not get any refund</span>
                                                    <a class="latoBlack font12 pointer appendLeft10 cancelPolicy anchor" data-bs-toggle="modal" data-bs-target="#cancellationModal">Cancellation policy details</a>
                                                    <div class="modal fade" id="cancellationModal" tabindex="-1" role="dialog" aria-labelledby="cancellationModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="cancellationModalLabel">
                                                                        Cancellations Policy
                                                                    </h5>
                                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="cm__modalContent">
                                                                        <div>
                                                                            <div>
                                                                                <div class="latoRegular font16 appendBottom15">
                                                                                    <b>This booking is non-refundable and
                                                                                        the tariff cannot be cancelled with
                                                                                        zero fee.</b>
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
                                    </div>
                                </div>
                            </div>
                            <div class="impInfoCard appendTop15">
                                <div class="impInfoCard__head">Important information</div>
                                <div class="impInfoCard__details">
                                    <p class="latoBlack font14 blackText appendBottom12">
                                        Resort Rules
                                    </p>
                                    <ul class="impInfoCard__list">
                                        <li>
                                            <span class="impInfoCard__listIcon">
                                                <span class="appendLeft3 blackDot"></span>
                                            </span>
                                            <span class="font12">Guests with fever are not allowed</span>
                                        </li>
                                        <li>
                                            <span class="impInfoCard__listIcon">
                                                <span class="appendLeft3 blackDot"></span>
                                            </span>
                                            <span class="font12">Office ID, PAN Card and Non-Govt IDs are not accepted
                                                as ID proof(s)</span>
                                        </li>
                                        <li>
                                            <span class="impInfoCard__listIcon">
                                                <span class="appendLeft3 blackDot"></span></span>
                                            <span class="font12">Passport, Aadhar, Driving License and Govt. ID are
                                                accepted as ID proof(s)</span>
                                        </li>
                                        <li>
                                            <span class="impInfoCard__listIcon">
                                                <span class="appendLeft3 blackDot"></span></span>
                                            <span class="font12">Property staff is trained on hygiene guidelines</span>
                                        </li>
                                    </ul>
                                    <p>
                                        <!-- <a
                      class="impInfoCard__btn latoBold font12 anchor"
                      data-bs-toggle="modal"
                      data-bs-target="#readAllRulesModalLong"
                      >Read All Resort Rules </a
                    > -->
                                    <div class="modal fade" id="readAllRulesModalLong" tabindex="-1" role="dialog" aria-labelledby="readAllRulesModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="readAllRulesModalLongTitle">Modal title</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="cm__modalContent">
                                                        <div class="rsrtRules">
                                                            <div class="rsrtRules__row">
                                                                <h4>Must read</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="">Guests with fever are not allowed</li>
                                                                    <li class="">Office ID, PAN Card and Non-Govt IDs are
                                                                        not accepted as ID proof(s)</li>
                                                                    <li class="">Passport, Aadhar, Driving License and Govt.
                                                                        ID are accepted as ID proof(s)</li>
                                                                    <li class="">Property staff is trained on hygiene
                                                                        guidelines</li>
                                                                    <li class="">Pets are not allowed.</li>
                                                                    <li class="">Outside food is not allowed</li>
                                                                    <li class="">Does not allow private parties or events
                                                                    </li>
                                                                    <li class="">Quarantine protocols are being followed as
                                                                        per local government authorities</li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>Safety and Hygiene</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="">Quarantine protocols are being followed as
                                                                        per local government authorities</li>
                                                                    <li class="">Guests from containment zones are allowed
                                                                    </li>
                                                                    <li class="">Shared resources in common areas are
                                                                        properly sanitized</li>
                                                                    <li class="">Property staff is trained on hygiene
                                                                        guidelines</li>
                                                                    <li class="">Guests with fever are not allowed</li>
                                                                    <li class="">Only those guests with safe status on
                                                                        Aarogya Setu app are allowed</li>
                                                                    <li class="">Hand sanitizer is provided in guest
                                                                        accommodation and common areas</li>
                                                                    <li class="">Thermal screening is done at entry and exit
                                                                        points</li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>Guest Profile</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="">Unmarried couples allowed</li>
                                                                    <li class="">Bachelors allowed</li>
                                                                    <li class="">Guests below 18 years of age are allowed
                                                                    </li>
                                                                    <li class="">Suitable for children</li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>Room Safety and Hygiene</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="">All rooms are disinfected using bleach or
                                                                        other disinfectant</li>
                                                                    <li class="">Linens, towels, and laundry are washed as
                                                                        per local guidelines</li>
                                                                    <li class="">Rooms are properly sanitized between stays
                                                                    </li>
                                                                    <li class="">Hand sanitizers are available in the rooms.
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>Payment Related</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="">Credit/debit cards are accepted</li>
                                                                    <li class="">Master Card, Visa and American Express
                                                                        cards are accepted</li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>Food Arrangement</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="">Non veg food is allowed</li>
                                                                    <li class="">Outside food is not allowed</li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>Food and Drinks Hygiene</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="">COVID-19 guidelines for Food Hygiene is
                                                                        followed as per government guidelines</li>
                                                                    <li class="">Social distancing is followed in
                                                                        restaurants</li>
                                                                    <li class="">Serveware and supplies are sanitized before
                                                                        they are brought to the kitchen</li>
                                                                    <li class="">Masks and hairnets are mandatory for staff
                                                                        in restaurants</li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>Smoking/Alcohol consumption Rules</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="">Smoking within the premises is allowed</li>
                                                                    <li class="">There are no restrictions on alcohol
                                                                        consumption.</li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>Property Accessibility</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="">Not suitable for Elderly/Disabled</li>
                                                                    <li class="">Bed height is accessible</li>
                                                                    <li class="">The entire unit is not accessible by
                                                                        wheelchair</li>
                                                                    <li class="">The property has a wide entryway</li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>Pet(s) Related</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="">Pets are not allowed.</li>
                                                                    <li class="">There are no pets living on the property
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>Physical Distancing</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="">Social distancing protocols are followed
                                                                    </li>
                                                                    <li class="">Contactless Check-In and Checkout service
                                                                        is available</li>
                                                                    <li class="">Contactless Room service is available</li>
                                                                    <li class="">Physical Barriers are deployed at
                                                                        appropriate places</li>
                                                                    <li class="">Cashless Payment is available</li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>ID Proof Related</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="">Passport, Aadhar, Driving License and Govt.
                                                                        ID are accepted as ID proof(s)</li>
                                                                    <li class="">Office ID, PAN Card and Non-Govt IDs are
                                                                        not accepted as ID proof(s)</li>
                                                                    <li class="">Local ids are allowed</li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>Other Rules</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="">Does not allow private parties or events
                                                                    </li>
                                                                    <li class="">Visitors are not allowed</li>
                                                                    <li class="">Birth proof of child mandatory at check in.

                                                                        The Credit Card Holder must be one of the travelers.

                                                                        Early check-in or late check-out is subject to
                                                                        availability and may be chargeable by the hotel
                                                                        directly
                                                                        We reserve the right to cancel or modify
                                                                        reservations where it appears that a customer has
                                                                        engaged in fraudulent or inappropriate activity or
                                                                        under other circumstances where it appears that the
                                                                        reservations contain or resulted from a mistake or
                                                                        error.

                                                                        All guests checking in at the resort need to carry a
                                                                        government approved photo identification which has
                                                                        to be produced at the Reception in original at the
                                                                        time of check-in. Guests failing to produce the
                                                                        above will not be allowed to check in at the resort.

                                                                        Any increases in the taxes applicable on the booking
                                                                        will be charged extra at the time of check-in.

                                                                        Offers extended by the Hotel are at its own sole
                                                                        discretion. Hotel may modify/remove offers without
                                                                        prior notice.

                                                                        Compulsory Gala Dinner: Mandatory X-Mas Gala Dinner
                                                                        charges - Payable at the hotel price per adult
                                                                        Inclusive of taxes INR 4,800 and Child (6-12 years)
                                                                        INR 2,400 Inclusive of taxes per child, price per
                                                                        infant: 0 INR available on 24th December.

                                                                        Mandatory New Year Gala Dinner charges - Payable at
                                                                        the hotel price per adult Inclusive of taxes INR
                                                                        9,500 and Child (6-12 year) INR 4,750 Inclusive of
                                                                        taxes per child, price per infant: 0 INR available
                                                                        on 31st December.. </li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>child extra bed policy</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="noDot">An extra bed will be provided to
                                                                        accommodate any child included in the booking for a
                                                                        charge mentioned below.</li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>adult extra bed policy</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="">An extra bed will be provided to
                                                                        accommodate any additional guest included in the
                                                                        booking for a charge mentioned below.</li>
                                                                    <li class="">INR 2000 will be charged for an extra
                                                                        mattress per guest. (To be paid at the property)
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>Hotel Policy</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="">According to government regulations, a
                                                                        valid Photo ID has to be carried by every person
                                                                        above the age of 18 staying at Caravela Beach
                                                                        Resort. The identification proofs accepted are
                                                                        Drivers License, Voters Card, Passport, Ration Card.
                                                                        Without valid ID the guest will not be allowed to
                                                                        check in.</li>
                                                                    <li class="">The primary guest checking in to the hotel
                                                                        must be at least 18 years of age.</li>
                                                                    <li class="">Early check-in or late check-out is subject
                                                                        to availability and may be chargeable by Caravela
                                                                        Beach Resort. The standard check-in time is 2 PM and
                                                                        the standard check-out time is 11 AM. After booking
                                                                        you will be sent an email confirmation with hotel
                                                                        phone number. You can contact the hotel directly for
                                                                        early check-in or late check-out.</li>
                                                                    <li class="">The room tariff includes all taxes. The
                                                                        amount paid for the room does not include charges
                                                                        for optional services and facilities (such as room
                                                                        service, mini bar, snacks or telephone calls). These
                                                                        will be charged at the time of check-out from the
                                                                        Resort.</li>
                                                                    <li class="">Gowynk will not be responsible for any
                                                                        check-in denied by the Resort due to the aforesaid
                                                                        reason.</li>
                                                                    <li class="">Caravela Beach Resort reserves the right of
                                                                        admission. Accommodation can be denied to guests
                                                                        posing as a 'couple' if suitable proof of
                                                                        identification is not presented at check-in.Gowynk
                                                                        will not be responsible for any check-in denied by
                                                                        the Resort due to the aforesaid reason.</li>
                                                                    <li class="">Caravela Beach Resort reserves the right of
                                                                        admission for local residents. Accommodation can be
                                                                        denied to guests residing in the same city. Gowynk
                                                                        will not be responsible for any check-in denied by
                                                                        the Resort due to the aforesaid reason.</li>
                                                                    <li class="">For any update, User shall pay applicable
                                                                        cancellation/modification charges.</li>
                                                                    <li class="">For any concerns or clarifications related
                                                                        to your booking, you can contact the property on
                                                                        08326695000.</li>
                                                                    <li class="">Modified bookings will be subject to
                                                                        availability and revised booking policy of the
                                                                        Resort.</li>
                                                                    <li class="">The cancellation/modification charges are
                                                                        standard and any waiver is on the hotel's
                                                                        discretion.</li>
                                                                    <li class="">Number of modifications possible on a
                                                                        booking will be on the discretion of Gowynk.</li>
                                                                    <li class="">Selective offers of Gowynk will not be
                                                                        valid on a cancellation or modification of booking.
                                                                    </li>
                                                                    <li class="">Any e-coupon discount on the original
                                                                        booking shall be forfeited in the event of
                                                                        cancellation or modification.</li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>Cancellation Policy</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="noDot">Cancellation and prepayment policies
                                                                        vary according to room type. Please check the Fare
                                                                        policy associatedr room.</li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>Payment Mode</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="noDot">You can pay now or you can pay at the
                                                                        hotel if your selected room type has this option.
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="rsrtRules__row">
                                                                <h4>Check In/out</h4>
                                                                <ul class="rsrtRules__list">
                                                                    <li class="noDot">Hotel Check-in Time is 2 PM, Check-out
                                                                        Time is 11 AM.</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div>
                        <div class="guestDtls appendBottom20">
                            <div class="accordHead">
                                <div>
                                    <p class="accordHead__text">
                                        <span class="capText">GUEST DETAILS</span>
                                    </p>
                                </div>
                                <div>
                                    <span class="accordBtn appendLeft20 up"></span>
                                </div>
                            </div>
                            <div class="guestDtls__content">
                                <!--<div class="guestDtls__login">
                  <p class="latoBlack font16">
                    <a class="anchor">Login</a>&nbsp;to prefill traveler details
                    and get access to secret deals
                  </p>
                </div>-->
                                <form method="POST" action="<?php echo site_url(); ?>hotels/reservation?callBackId=<?php echo base64_encode($roomDetails->api); ?>&hotelCode=<?php echo $roomDetails->hotel_code; ?>&searchId=<?php echo $search_id; ?>&sessionId=<?php echo $roomDetails->session_id; ?>">
                                    <div class="guestDtls__row">
                                        <div class="makeFlex">
                                            <input type="hidden" name="callBackId" value="<?php echo base64_encode($roomDetails->api); ?>" required />
                                            <input type="hidden" name="hotelCode" value="<?php echo $roomDetails->hotel_code; ?>" required />
                                            <input type="hidden" name="searchId" value="<?php echo $roomDetails->search_id; ?>" required />
                                            <input type="hidden" name="sessionId" value="<?php echo $roomDetails->session_id; ?>" required />

                                            <div class="guestDtls__col width70 appendRight10">
                                                <p class="font11 capText appendBottom10">Title</p>
                                                <div class="frmSelectCont">
                                                    <select id="title" class="frmSelect" name="adults_title[]">
                                                        <option value="Mr">Mr</option>
                                                        <option value="Mrs">Mrs</option>
                                                        <option value="Ms">Ms</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="makeFlex column flexOne">
                                                <div class="makeFlex res_form_flex">
                                                    <div class="guestDtls__col width247 appendRight10">
                                                        <div class="textFieldCol">
                                                            <p class="font11 appendBottom10 guestDtlsTextLbl">
                                                                <span class="capText">FULL NAME</span>
                                                            </p>
                                                            <input type="text" id="fName" name="adults_fname[]" pattern="^[a-zA-Z]+( [a-zA-Z]+)*$" class="frmTextInput" placeholder="First Name" value="" />
                                                        </div>
                                                    </div>
                                                    <div class="guestDtls__col width247">
                                                        <div class="textFieldCol">
                                                            <p class="font11 appendBottom10 guestDtlsTextLbl">
                                                                <span class="capText"></span>
                                                            </p>
                                                            <input type="text" id="lName" name="adults_lname[]" pattern="^[a-zA-Z]+( [a-zA-Z]+)*$" class="frmTextInput" placeholder="Last Name" value="" />
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if ($PANMandatory = 'true') { ?>
                                        <div class="guestDtls__row">
                                            <div class="makeFlex res_form_flex">
                                                <div class="guestDtls__col width327 appendRight10">
                                                    <div class="textFieldCol">
                                                        <p class="font11 appendBottom10 guestDtlsTextLbl">
                                                            <span class="capText">Pan</span>

                                                        </p>
                                                        <input pattern="^[a-zA-Z]+[0-9]+( [a-zA-Z]+)*$" minlength="4" maxlength="30" type="text" class="form-control pan_no" id="tpan" value="" name="user_pan[]" placeholder="PAN Number" data-error="Valid PAN Number is required" required>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    <?php } ?>






                                    <div class="guestDtls__row">
                                        <div class="makeFlex res_form_flex">
                                            <div class="guestDtls__col width327 appendRight10">
                                                <div class="textFieldCol">
                                                    <p class="font11 appendBottom10 guestDtlsTextLbl">
                                                        <span class="capText">Email Address</span>
                                                        <span class="grayText appendLeft3 font9">(Booking voucher will be
                                                            sent to this email
                                                            ID)</span>
                                                    </p>
                                                    <input type="text" id="email" name="email" class="frmTextInput" placeholder="Email ID" value="" />
                                                </div>
                                            </div>
                                            <div class="guestDtls__col width327">
                                                <p class="font11 capText appendBottom10">
                                                    Mobile Number
                                                </p>
                                                <div class="makeFlex textLtr">
                                                    <div class="guestDtls__contact">
                                                        <label for="mCode" class="frmSelectCont__contact">
                                                            <select name="countryCode" id="mCode" class="frmSelect frmSelectContact">
                                                                <option value="+93">Afghanistan (+93)</option>
                                                                <option value="+355">Albania (+355)</option>
                                                                <option value="+213">Algeria (+213)</option>
                                                                <option value="+1684">
                                                                    American Samoa (+1684)
                                                                </option>
                                                                <option value="+376">Andorra (+376)</option>
                                                                <option value="+244">Angola (+244)</option>
                                                                <option value="+1264">Anguilla (+1264)</option>
                                                                <option value="+672">Antarctica (+672)</option>
                                                                <option value="+1268">
                                                                    Antigua and Barbuda (+1268)
                                                                </option>
                                                                <option value="+54">Argentina (+54)</option>
                                                                <option value="+374">Armenia (+374)</option>
                                                                <option value="+297">Aruba (+297)</option>
                                                                <option value="+61">Australia (+61)</option>
                                                                <option value="+43">Austria (+43)</option>
                                                                <option value="+994">Azerbaijan (+994)</option>
                                                                <option value="+1242">Bahamas (+1242)</option>
                                                                <option value="+973">Bahrain (+973)</option>
                                                                <option value="+880">Bangladesh (+880)</option>
                                                                <option value="+1246">Barbados (+1246)</option>
                                                                <option value="+32">Belgium (+32)</option>
                                                                <option value="+501">Belize (+501)</option>
                                                                <option value="+229">Benin (+229)</option>
                                                                <option value="+1441">Bermuda (+1441)</option>
                                                                <option value="+975">Bhutan (+975)</option>
                                                                <option value="+591">Bolivia (+591)</option>
                                                                <option value="+267">Botswana (+267)</option>
                                                                <option value="+55">Brazil (+55)</option>
                                                                <option value="+246">
                                                                    British Indian Ocean Territory (+246)
                                                                </option>
                                                                <option value="+1284">
                                                                    British Virgin Islands (+1284)
                                                                </option>
                                                                <option value="+673">Brunei (+673)</option>
                                                                <option value="+226">
                                                                    Burkina Faso (+226)
                                                                </option>
                                                                <option value="+257">Burundi (+257)</option>
                                                                <option value="+855">Cambodia (+855)</option>
                                                                <option value="+237">Cameroon (+237)</option>
                                                                <option value="+1">Canada (+1)</option>
                                                                <option value="+238">Cape Verde (+238)</option>
                                                                <option value="+1345">
                                                                    Cayman Islands (+1345)
                                                                </option>
                                                                <option value="+236">
                                                                    Central African Republic (+236)
                                                                </option>
                                                                <option value="+235">Chad (+235)</option>
                                                                <option value="+56">Chile (+56)</option>
                                                                <option value="+86">China (+86)</option>
                                                                <option value="+61">
                                                                    Christmas Island (+61)
                                                                </option>
                                                                <option value="+61">Cocos Islands (+61)</option>
                                                                <option value="+57">Colombia (+57)</option>
                                                                <option value="+269">Comoros (+269)</option>
                                                                <option value="+682">
                                                                    Cook Islands (+682)
                                                                </option>
                                                                <option value="+506">Costa Rica (+506)</option>
                                                                <option value="+599">Curacao (+599)</option>
                                                                <option value="+357">Cyprus (+357)</option>
                                                                <option value="+420">
                                                                    Czech Republic (+420)
                                                                </option>
                                                                <option value="+45">Denmark (+45)</option>
                                                                <option value="+253">Djibouti (+253)</option>
                                                                <option value="+1767">Dominica (+1767)</option>
                                                                <option value="+18">
                                                                    Dominican Republic (+18)
                                                                </option>
                                                                <option value="+670">East Timor (+670)</option>
                                                                <option value="+593">Ecuador (+593)</option>
                                                                <option value="+20">Egypt (+20)</option>
                                                                <option value="+503">El Salvador (+503)</option>
                                                                <option value="+240">
                                                                    Equatorial Guinea (+240)
                                                                </option>
                                                                <option value="+291">Eritrea (+291)</option>
                                                                <option value="+372">Estonia (+372)</option>
                                                                <option value="+251">Ethiopia (+251)</option>
                                                                <option value="+500">
                                                                    Falkland Islands (+500)
                                                                </option>
                                                                <option value="+298">
                                                                    Faroe Islands (+298)
                                                                </option>
                                                                <option value="+679">Fiji (+679)</option>
                                                                <option value="+358">Finland (+358)</option>
                                                                <option value="+33">France (+33)</option>
                                                                <option value="+689">
                                                                    French Polynesia (+689)
                                                                </option>
                                                                <option value="+241">Gabon (+241)</option>
                                                                <option value="+220">Gambia (+220)</option>
                                                                <option value="+995">Georgia (+995)</option>
                                                                <option value="+49">Germany (+49)</option>
                                                                <option value="+233">Ghana (+233)</option>
                                                                <option value="+350">Gibraltar (+350)</option>
                                                                <option value="+30">Greece (+30)</option>
                                                                <option value="+299">Greenland (+299)</option>
                                                                <option value="+1473">Grenada (+1473)</option>
                                                                <option value="+1671">Guam (+1671)</option>
                                                                <option value="+502">Guatemala (+502)</option>
                                                                <option value="+441481">
                                                                    Guernsey (+441481)
                                                                </option>
                                                                <option value="+224">Guinea (+224)</option>
                                                                <option value="+245">
                                                                    Guinea-Bissau (+245)
                                                                </option>
                                                                <option value="+592">Guyana (+592)</option>
                                                                <option value="+509">Haiti (+509)</option>
                                                                <option value="+504">Honduras (+504)</option>
                                                                <option value="+852">Hong Kong (+852)</option>
                                                                <option value="+36">Hungary (+36)</option>
                                                                <option value="+354">Iceland (+354)</option>
                                                                <option value="+91" selected>India (+91)</option>
                                                                <option value="+62">Indonesia (+62)</option>
                                                                <option value="+353">Ireland (+353)</option>
                                                                <option value="+441624">
                                                                    Isle of Man (+441624)
                                                                </option>
                                                                <option value="+972">Israel (+972)</option>
                                                                <option value="+39">Italy (+39)</option>
                                                                <option value="+1876">Jamaica (+1876)</option>
                                                                <option value="+81">Japan (+81)</option>
                                                                <option value="+441534">
                                                                    Jersey (+441534)
                                                                </option>
                                                                <option value="+962">Jordan (+962)</option>
                                                                <option value="+7">Kazakhstan (+7)</option>
                                                                <option value="+254">Kenya (+254)</option>
                                                                <option value="+686">Kiribati (+686)</option>
                                                                <option value="+965">Kuwait (+965)</option>
                                                                <option value="+996">Kyrgyzstan (+996)</option>
                                                                <option value="+856">Laos (+856)</option>
                                                                <option value="+371">Latvia (+371)</option>
                                                                <option value="+266">Lesotho (+266)</option>
                                                                <option value="+423">
                                                                    Liechtenstein (+423)
                                                                </option>
                                                                <option value="+370">Lithuania (+370)</option>
                                                                <option value="+352">Luxembourg (+352)</option>
                                                                <option value="+853">Macau (+853)</option>
                                                                <option value="+389">Macedonia (+389)</option>
                                                                <option value="+261">Madagascar (+261)</option>
                                                                <option value="+265">Malawi (+265)</option>
                                                                <option value="+60">Malaysia (+60)</option>
                                                                <option value="+960">Maldives (+960)</option>
                                                                <option value="+223">Mali (+223)</option>
                                                                <option value="+356">Malta (+356)</option>
                                                                <option value="+692">
                                                                    Marshall Islands (+692)
                                                                </option>
                                                                <option value="+222">Mauritania (+222)</option>
                                                                <option value="+230">Mauritius (+230)</option>
                                                                <option value="+262">Mayotte (+262)</option>
                                                                <option value="+52">Mexico (+52)</option>
                                                                <option value="+691">Micronesia (+691)</option>
                                                                <option value="+377">Monaco (+377)</option>
                                                                <option value="+976">Mongolia (+976)</option>
                                                                <option value="+1664">
                                                                    Montserrat (+1664)
                                                                </option>
                                                                <option value="+212">Morocco (+212)</option>
                                                                <option value="+258">Mozambique (+258)</option>
                                                                <option value="+95">Myanmar (+95)</option>
                                                                <option value="+264">Namibia (+264)</option>
                                                                <option value="+674">Nauru (+674)</option>
                                                                <option value="+977">Nepal (+977)</option>
                                                                <option value="+31">Netherlands (+31)</option>
                                                                <option value="+599">
                                                                    Netherlands Antilles (+599)
                                                                </option>
                                                                <option value="+687">
                                                                    New Caledonia (+687)
                                                                </option>
                                                                <option value="+64">New Zealand (+64)</option>
                                                                <option value="+505">Nicaragua (+505)</option>
                                                                <option value="+227">Niger (+227)</option>
                                                                <option value="+234">Nigeria (+234)</option>
                                                                <option value="+683">Niue (+683)</option>
                                                                <option value="+1670">
                                                                    Northern Mariana Islands (+1670)
                                                                </option>
                                                                <option value="+47">Norway (+47)</option>
                                                                <option value="+968">Oman (+968)</option>
                                                                <option value="+92">Pakistan (+92)</option>
                                                                <option value="+680">Palau (+680)</option>
                                                                <option value="+970">Palestine (+970)</option>
                                                                <option value="+507">Panama (+507)</option>
                                                                <option value="+675">
                                                                    Papua New Guinea (+675)
                                                                </option>
                                                                <option value="+595">Paraguay (+595)</option>
                                                                <option value="+51">Peru (+51)</option>
                                                                <option value="+63">Philippines (+63)</option>
                                                                <option value="+64">Pitcairn (+64)</option>
                                                                <option value="+48">Poland (+48)</option>
                                                                <option value="+351">Portugal (+351)</option>
                                                                <option value="+1">Puerto Rico (+1)</option>
                                                                <option value="+974">Qatar (+974)</option>
                                                                <option value="+262">Reunion (+262)</option>
                                                                <option value="+7">Russia (+7)</option>
                                                                <option value="+250">Rwanda (+250)</option>
                                                                <option value="+590">
                                                                    Saint Barthelemy (+590)
                                                                </option>
                                                                <option value="+290">
                                                                    Saint Helena (+290)
                                                                </option>
                                                                <option value="+1869">
                                                                    Saint Kitts and Nevis (+1869)
                                                                </option>
                                                                <option value="+1758">
                                                                    Saint Lucia (+1758)
                                                                </option>
                                                                <option value="+590">
                                                                    Saint Martin (+590)
                                                                </option>
                                                                <option value="+508">
                                                                    Saint Pierre and Miquelon (+508)
                                                                </option>
                                                                <option value="+1784">
                                                                    Saint Vincent and the Grenadines (+1784)
                                                                </option>
                                                                <option value="+685">Samoa (+685)</option>
                                                                <option value="+378">San Marino (+378)</option>
                                                                <option value="+239">
                                                                    Sao Tome and Principe (+239)
                                                                </option>
                                                                <option value="+966">
                                                                    Saudi Arabia (+966)
                                                                </option>
                                                                <option value="+221">Senegal (+221)</option>
                                                                <option value="+248">Seychelles (+248)</option>
                                                                <option value="+232">
                                                                    Sierra Leone (+232)
                                                                </option>
                                                                <option value="+65">Singapore (+65)</option>
                                                                <option value="+1721">
                                                                    Sint Maarten (+1721)
                                                                </option>
                                                                <option value="+421">Slovakia (+421)</option>
                                                                <option value="+677">
                                                                    Solomon Islands (+677)
                                                                </option>
                                                                <option value="+252">Somalia (+252)</option>
                                                                <option value="+82">South Korea (+82)</option>
                                                                <option value="+211">South Sudan (+211)</option>
                                                                <option value="+94">Sri Lanka (+94)</option>
                                                                <option value="+47">
                                                                    Svalbard and Jan Mayen (+47)
                                                                </option>
                                                                <option value="+268">Swaziland (+268)</option>
                                                                <option value="+46">Sweden (+46)</option>
                                                                <option value="+41">Switzerland (+41)</option>
                                                                <option value="+886">Taiwan (+886)</option>
                                                                <option value="+992">Tajikistan (+992)</option>
                                                                <option value="+255">Tanzania (+255)</option>
                                                                <option value="+66">Thailand (+66)</option>
                                                                <option value="+228">Togo (+228)</option>
                                                                <option value="+690">Tokelau (+690)</option>
                                                                <option value="+676">Tonga (+676)</option>
                                                                <option value="+1868">
                                                                    Trinidad and Tobago (+1868)
                                                                </option>
                                                                <option value="+216">Tunisia (+216)</option>
                                                                <option value="+90">Turkey (+90)</option>
                                                                <option value="+993">
                                                                    Turkmenistan (+993)
                                                                </option>
                                                                <option value="+1649">
                                                                    Turks and Caicos Islands (+1649)
                                                                </option>
                                                                <option value="+688">Tuvalu (+688)</option>
                                                                <option value="+1340">
                                                                    U.S. Virgin Islands (+1340)
                                                                </option>
                                                                <option value="+256">Uganda (+256)</option>
                                                                <option value="+380">Ukraine (+380)</option>
                                                                <option value="+971">
                                                                    United Arab Emirates (+971)
                                                                </option>
                                                                <option value="+44">
                                                                    United Kingdom (+44)
                                                                </option>
                                                                <option value="+1">United States (+1)</option>
                                                                <option value="+598">Uruguay (+598)</option>
                                                                <option value="+998">Uzbekistan (+998)</option>
                                                                <option value="+678">Vanuatu (+678)</option>
                                                                <option value="+379">Vatican (+379)</option>
                                                                <option value="+58">Venezuela (+58)</option>
                                                                <option value="+84">Vietnam (+84)</option>
                                                                <option value="+681">
                                                                    Wallis and Futuna (+681)
                                                                </option>
                                                                <option value="+212">
                                                                    Western Sahara (+212)
                                                                </option>
                                                                <option value="+967">Yemen (+967)</option>
                                                                <option value="+260">Zambia (+260)</option>
                                                                <option value="+387">
                                                                    Bosnia and Herzegovina (+387)
                                                                </option>
                                                                <option value="+359">Bulgaria (+359)</option>
                                                                <option value="+385">Croatia (+385)</option>
                                                                <option value="+383">Kosovo (+383)</option>
                                                                <option value="+373">Moldova (+373)</option>
                                                                <option value="+382">Montenegro (+382)</option>
                                                                <option value="+389">
                                                                    North Macedonia (+389)
                                                                </option>
                                                                <option value="+40">Romania (+40)</option>
                                                                <option value="+381">Serbia (+381)</option>
                                                                <option value="+386">Slovenia (+386)</option>
                                                                <option value="+375">Belarus (+375)</option>
                                                                <option value="+95">Burma (+95)</option>
                                                                <option value="+225">
                                                                    Cote D`Ivoire (Ivory Coast) (+225)
                                                                </option>
                                                                <option value="+243">
                                                                    Democratic Republic of Congo (+243)
                                                                </option>
                                                                <option value="+964">Iraq (+964)</option>
                                                                <option value="+231">Liberia (+231)</option>
                                                                <option value="+249">Sudan (+249)</option>
                                                                <option value="+263">Zimbabwe (+263)</option>
                                                            </select>
                                                        </label>
                                                        <span class="selectedCode">+91</span>
                                                    </div>
                                                    <div class="flexOne">
                                                        <div class="textFieldCol">
                                                            <input type="text" id="mNo" name="tpnumber" class="frmTextInput noLeftBorder" placeholder="Contact Number" value="" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="guestDtls__row">

                                        <div class="makeFlex res_form_flex">
                                            <div class="guestDtls__col width220 appendRight10">
                                                <div class="textFieldCol">
                                                    <p class="font11 appendBottom10 guestDtlsTextLbl">
                                                        <span class="capText">Address</span>
                                                    </p>
                                                    <input type="text" class="form-control" id="taddress" value="" name="taddress" placeholder="Address" data-error="Valid Address is required" pattern="[a-zA-Z0-9,\s]+" required>

                                                </div>
                                            </div>
                                            <div class="guestDtls__col width220 appendRight10">
                                                <div class="textFieldCol">
                                                    <p class="font11 appendBottom10 guestDtlsTextLbl">
                                                        <span class="capText">Country</span>
                                                    </p>
                                                    <select class="selectpicker form-control country" name="country" data-live-search="true" id="country" required title="Select country" data-error="Please select country">
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
                                                        <option data-subtext="(BQ)" value="BQ">Bonaire, Saint Eustatius and
                                                            Saba</option>
                                                        <option data-subtext="(BA)" value="BA">Bosnia and herzegovina
                                                        </option>
                                                        <option data-subtext="(BW)" value="BW">Botswana</option>
                                                        <option data-subtext="(BV)" value="BV">Bouvet Island</option>
                                                        <option data-subtext="(BR)" value="BR">Brazil</option>
                                                        <option data-subtext="(IO)" value="IO">British Indian Ocean
                                                            Territory</option>
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
                                                        <option data-subtext="(CF)" value="CF">Central African Republic
                                                        </option>
                                                        <option data-subtext="(TD)" value="TD">Chad</option>
                                                        <option data-subtext="(CL)" value="CL">Chile</option>
                                                        <option data-subtext="(CN)" value="CN">China</option>
                                                        <option data-subtext="(CX)" value="CX">Christmas Island</option>
                                                        <option data-subtext="(CC)" value="CC">Cocos (Keeling) Islands
                                                        </option>
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
                                                        <option data-subtext="(FK)" value="FK">Falkland Islands (Malvinas)
                                                        </option>
                                                        <option data-subtext="(FO)" value="FO">Faroe Islands</option>
                                                        <option data-subtext="(FJ)" value="FJ">Fiji</option>
                                                        <option data-subtext="(FI)" value="FI">Finland</option>
                                                        <option data-subtext="(FR)" value="FR">France</option>
                                                        <option data-subtext="(GP)" value="GP">France (Guadeloupe)</option>
                                                        <option data-subtext="(MQ)" value="MQ">France (Martinique)</option>
                                                        <option data-subtext="(RE)" value="RE">France (Réunion)</option>
                                                        <option data-subtext="(GF)" value="GF">French Guiana</option>
                                                        <option data-subtext="(PF)" value="PF">French Polynesia</option>
                                                        <option data-subtext="(TF)" value="TF">French Southern Territories
                                                        </option>
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
                                                        <option data-subtext="(HM)" value="HM">Heard Island and McDonald
                                                            Islands</option>
                                                        <option data-subtext="(HN)" value="HN">Honduras</option>
                                                        <option data-subtext="(HK)" value="HK">Hong Kong</option>
                                                        <option data-subtext="(HU)" value="HU">Hungary</option>
                                                        <option data-subtext="(IS)" value="IS">Iceland</option>
                                                        <option data-subtext="(IN)" value="IN" selected>India</option>
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
                                                        <option data-subtext="(MP)" value="MP">Northern Mariana Islands
                                                        </option>
                                                        <option data-subtext="(NO)" value="NO">Norway</option>
                                                        <option data-subtext="(OM)" value="OM">Oman</option>
                                                        <option data-subtext="(PK)" value="PK">Pakistan</option>
                                                        <option data-subtext="(PW)" value="PW">Palau</option>
                                                        <option data-subtext="(PS)" value="PS">Palestinian Territory,
                                                            Occupied</option>
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
                                                        <option data-subtext="(SH)" value="SH">Saint Helena, Ascension and
                                                            Tristan da Cunha</option>
                                                        <option data-subtext="(KN)" value="KN">Saint Kitts and Nevis
                                                        </option>
                                                        <option data-subtext="(LC)" value="LC">Saint Lucia</option>
                                                        <option data-subtext="(MF)" value="MF">Saint Martin (French part)
                                                        </option>
                                                        <option data-subtext="(PM)" value="PM">Saint Pierre and Miquelon
                                                        </option>
                                                        <option data-subtext="(VC)" value="VC">Saint Vincent and the
                                                            Grenadines</option>
                                                        <option data-subtext="(WS)" value="WS">Samoa</option>
                                                        <option data-subtext="(SM)" value="SM">San Marino</option>
                                                        <option data-subtext="(ST)" value="ST">Sao Tome and Principe
                                                        </option>
                                                        <option data-subtext="(SA)" value="SA">Saudi Arabia</option>
                                                        <option data-subtext="(SN)" value="SN">Senegal</option>
                                                        <option data-subtext="(RS)" value="RS">Serbia</option>
                                                        <option data-subtext="(SC)" value="SC">Seychelles</option>
                                                        <option data-subtext="(SL)" value="SL">Sierra Leone</option>
                                                        <option data-subtext="(SG)" value="SG">Singapore</option>
                                                        <option data-subtext="(SX)" value="SX">Sint Maarten (Dutch part)
                                                        </option>
                                                        <option data-subtext="(SK)" value="SK">Slovakia</option>
                                                        <option data-subtext="(SI)" value="SI">Slovenia</option>
                                                        <option data-subtext="(SB)" value="SB">Solomon Islands</option>
                                                        <option data-subtext="(SO)" value="SO">Somalia</option>
                                                        <option data-subtext="(ZA)" value="ZA">South Africa</option>
                                                        <option data-subtext="(GS)" value="GS">South Georgia and the South
                                                            Sandwich Islands</option>
                                                        <option data-subtext="(KR)" value="KR">South korea</option>
                                                        <option data-subtext="(ES)" value="ES">Spain</option>
                                                        <option data-subtext="(LK)" value="LK">Sri Lanka</option>
                                                        <option data-subtext="(SD)" value="SD">Sudan</option>
                                                        <option data-subtext="(SR)" value="SR">Suriname</option>
                                                        <option data-subtext="(SJ)" value="SJ">Svalbard and Jan Mayen
                                                        </option>
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
                                                        <option data-subtext="(TC)" value="TC">Turks and Caicos Islands
                                                        </option>
                                                        <option data-subtext="(TV)" value="TV">Tuvalu</option>
                                                        <option data-subtext="(UG)" value="UG">Uganda</option>
                                                        <option data-subtext="(UA)" value="UA">Ukraine</option>
                                                        <option data-subtext="(AE)" value="AE">United Arab Emirates</option>
                                                        <option data-subtext="(GB)" value="GB">United Kingdom</option>
                                                        <option data-subtext="(US)" value="US">United States</option>
                                                        <option data-subtext="(UM)" value="UM">United States minor outlying
                                                            islands</option>
                                                        <option data-subtext="(UY)" value="UY">Uruguay</option>
                                                        <option data-subtext="(UZ)" value="UZ">Uzbekistan</option>
                                                        <option data-subtext="(VU)" value="VU">Vanuatu</option>
                                                        <option data-subtext="(VA)" value="VA">Vatican city</option>
                                                        <option data-subtext="(VE)" value="VE">Venezuela</option>
                                                        <option data-subtext="(VN)" value="VN">Vietnam</option>
                                                        <option data-subtext="(VG)" value="VG">Virgin Islands, British
                                                        </option>
                                                        <option data-subtext="(VI)" value="VI">Virgin Islands, United States
                                                        </option>
                                                        <option data-subtext="(WF)" value="WF">Wallis and Futuna</option>
                                                        <option data-subtext="(EH)" value="EH">Western Sahara</option>
                                                        <option data-subtext="(YE)" value="YE">Yemen</option>
                                                        <option data-subtext="(ME)" value="ME">Yugoslavia/Serbia And
                                                            Montenegro</option>
                                                        <option data-subtext="(ZM)" value="ZM">Zambia</option>
                                                        <option data-subtext="(ZW)" value="ZW">Zimbabwe</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="guestDtls__add">
                                        <!-- <a class="guestDtls__addBtn appendRight5 anchor"
                     data-bs-toggle="modal" data-bs-target="#addGuestModal"
                      >+ Add Guest</a
                    >-->
                                        <div class="modal fade" id="addGuestModal" tabindex="-1" role="dialog" aria-labelledby="addGuestModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addGuestModalLabel">Saved Guests</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="cm__modalContent">
                                                            <div class="addEditGuest">
                                                                <div class="addEditGuestScrollSection">
                                                                    <div class="addGuestForm add">
                                                                        <div class="makeFlex spaceBetween appendBottom5">
                                                                            <p class="latoBlack font16">Add Guests</p>
                                                                        </div>
                                                                        <p class="font12 lineHight16 appendBottom15">Name
                                                                            should be as per official govt. ID &amp;
                                                                            travelers below 18 years of age cannot travel
                                                                            alone</p>

                                                                        <div class="addGuestForm__cont appendBottom15">
                                                                            <div class="makeFlex">
                                                                                <div class="addGuestForm__col addGuestForm__col--small">
                                                                                    <label class="font11 capText appendBottom10">Title</label>
                                                                                    <div class="frmSelectCont">
                                                                                        <select class="frmSelect">
                                                                                            <option value="Mr">Mr</option>
                                                                                            <option value="Mrs">Mrs</option>
                                                                                            <option value="Ms">Ms</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="makeFlex column flexOne">
                                                                                    <label class="font11 capText appendBottom10">FULL
                                                                                        NAME</label>
                                                                                    <div class="makeFlex">
                                                                                        <div class="addGuestForm__col">
                                                                                            <input type="text" class="frmTextInput " name="firstName" data-testid="editFname" value="">
                                                                                        </div>
                                                                                        <div class="addGuestForm__col">
                                                                                            <input type="text" class="frmTextInput " name="lastName" data-testid="editLname" value="">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="appendTop10">
                                                                                <span class="checkmarkOuter">
                                                                                    <input type="checkbox" id="ageFieldANG">
                                                                                    <label class="makeFlex hrtlCenter" for="ageFieldANG">
                                                                                        <span class="font12 latoBold blackText appendRight5">Below
                                                                                            12 years of age</span>
                                                                                    </label>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <a class="addGuestForm__submit" data-testid="saveGuests">ADD TO SAVED GUESTS</a>

                                                                    </div>
                                                                </div>
                                                                <div class="addEditGuest__btnCont">
                                                                    <a class="addEditGuest__done " data-testid="doneBtn">Done</a>
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
                </div>


                <div class=" col-md-12 col-lg-4">
                    <div class="makeRelative">
                        <div class="prcBreakup appendBottom30" style="
                background-position-x: calc(100% + 20px);
                background-repeat-x: no-repeat;
              ">
                            <div class="prcBreakup__hdr">PRICE BREAK-UP</div>
                            <div class="prcBreakup__cont">
                                <div class="prcBreakup__row">
                                    <div class="makeFlex flexOne spaceBetween">
                                        <div class="prcBreakup__lft">
                                            <p class="latoBold blackText makeFlex">
                                                <span><?php echo $rooms; ?> Room</span> <span> x </span>
                                                <span><?php echo $nights; ?> Night</span>
                                            </p>
                                            <p class="font12 grayText appendTop3">Base Price</p>
                                        </div>
                                        <div class="prcBreakup__rht">
                                            <p class="latoBold">₹ <?php echo $roomDetails->orginal_cost; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="prcBreakup__row">
                                    <div class="makeFlex flexOne spaceBetween">
                                        <div class="prcBreakup__lft">
                                            <div class="latoBold blackText makeFlex hrtlCenter">
                                                Taxes & Fee
                                                <div class="ttlDscTooltip appendLeft5">
                                                    <span class="sprite infoIconBlue pointer"><i class="fa fa-exclamation-circle"></i></span>
                                                    <div class="ttlDiscount">
                                                        <ul class="ttlDiscount__list">
                                                            <li class="ttlDiscount__listItem">
                                                                <div class="flexOne">
                                                                    <div class="makeFlex spaceBetween whiteText">
                                                                        <p class=" ">Hotel GST + SERVICE CHARGE</p>
                                                                        <p class="noShrink">₹
                                                                            <?php echo round(number_format($roomDetails->admin_markup + $roomDetails->payment_charge)); ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="prcBreakup__rht">
                                            <p class="latoBold">₹
                                                <?php echo round(number_format($roomDetails->admin_markup + $roomDetails->payment_charge)); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prcBreakup__total">
                                <div class="makeFlex flexOne spaceBetween">
                                    <div class="prcBreakup__lft">
                                        <p class="latoBlack blackText">Total Amount to be paid</p>
                                    </div>
                                    <div class="prcBreakup__rht">
                                        <p class="latoBlack redText">₹ <?php echo $roomDetails->total_cost; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="makeRelative">
                        <div class="dlCodes appendBottom20">
                            <p class="latoBlack font14 capText appendBottom15 blackText">
                                Deal Codes
                            </p>
                            <p class="blackText font12 appendBottom10">
                                No coupon codes applicable for this property.
                            </p>
                            <div class="cpnCont">
                                <div class="cpnInput">
                                    <input type="text" placeholder="Have a Coupon Code" value="" /><a class="cpnInput__btn" data-testid="applyCpnBtn"><span class="sprite icWhiteArrow">
                                            <i class="fas fa-arrow-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="whySignIn appendBottom20">
                        <p class="latoBlack font14 capText blackText appendBottom7">
                            Why <a class="anchor">Sign up</a> or <a class="anchor">Login</a>
                        </p>
                        <ul class="whySignIn__list">
                            <li class="whySignIn__listItem">
                                <span class="whySignIn__listIcon"><span class="sprite icGreenTick"></span></span><span>Get
                                    access to
                                    <span class="latoBold blackText">Secret Deals</span></span>
                            </li>
                            <li class="whySignIn__listItem">
                                <span class="whySignIn__listIcon"><span class="sprite icGreenTick"></span></span><span><span class="latoBold blackText">Book Faster</span> - we’ll
                                    save &amp; pre-enter your details</span>
                            </li>
                            <li class="whySignIn__listItem">
                                <span class="whySignIn__listIcon"><span class="sprite icGreenTick"></span></span><span><span class="latoBold blackText">Manage your bookings</span>
                                    from one place</span>
                            </li>
                        </ul>
                    </div>
                    <!-- responsive -->

                </div>
            </div>
            <!--  -->
        </div>



        <div class="row pb-5">
            <div class="tncCard appendBottom15 justify-content-center">
                <p class="font12 lineHight16">
                    By proceeding, I agree to Gosky’s
                    <a rel="noopener noreferrer" target="_blank" href="#">User Agreement</a>,

                    <a rel="noopener noreferrer" target="_blank" href="#">Terms of Service</a>and

                    <a href="#">Cancellation &amp; Property Booking Policies</a>.
                </p>
            </div>
            <div class="makeFlex hrtlCenter res_btn justify-content-center">
                <div class="">
                    <a class="btnContinuePayment primaryBtn capText">Pay Now</a>
                    <div class="cstmTooltip top" style="
                      width: 200px;
                      height: auto;
                      position: absolute;
                      background-color: rgb(0, 0, 0);
                      border-radius: 4px;
                      padding: 16px;
                      border-width: 0px;
                      border-style: initial;
                      border-image: initial;
                      top: 40px;
                      left: 55px;
                      z-index: 2;
                    ">
                        <p class="whiteText lineHeight18">
                            Your organisation does not allow to book out of policy
                            bookings.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!--End-Hotel-Bookingpage-->

    </section>

    <!--payment end

    <script src="<?php echo base_url(); ?>js/flight.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/jquery/jquery.ui.js"></script>-->

    <script>
        $(function() {
            $(".datepicker").datepicker({
                numberOfMonths: 1,
                minDate: 0
            });
            $("#anim").on("change", function() {
                $(".datepicker").datepicker("option", "showAnim", $(this).val());
            });
        });
    </script>

    <script>
        var xhr;

        function saveTravelerInfor() {

            $('#traveler-submit-btn').prop('disabled', true);
            $("#name-view-div").text($("#salutation").find(":selected").val() + ' ' + $("#tfirsttname").val() + ' ' + $(
                "#tlastname").val());
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
                data: $('form[name="traveler-form"]').serializeArray(),
                url: 'https://localhost/go_wynk/hotels/reservation',
                beforeSend: function() {
                    $(".loading-content text-center ").fadeIn();
                },
                success: function(response) {
                    if (typeof response.success !== 'undefined' && response.success === 1) {
                        $("#traveler-submit-btn").text('Continue');
                        //payment button Text Change
                        var paynow = 'Pay Now' + ' ' + response.total;
                        $('#checkin,#payButton').val(paynow);
                        if (typeof response.service_charge !== 'undefined') {
                            $('#service_charge_rate').removeClass('hide').find('span').text(response
                                .service_charge);
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
                                            window.location.href = "https://asfartrip.com/en/payby/confirm/" +
                                                response.pnr_no + "/success";
                                        } else {
                                            window.location.href = "https://asfartrip.com/en/payby/confirm/" +
                                                response.pnr_no + "/failed";
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
                    $(".loading-content text-center ").fadeOut();
                    $('#traveler-submit-btn').prop('disabled', false);
                }
            });
        }
    </script>

    <?php $this->load->view('home/footer'); ?>
    </body>

    </html>