<?php if (!defined('BASEPATH'))    exit('No direct script access allowed');class Travelguru_Model extends CI_Model {    function __construct() {        parent::__construct();    }    function getApiAuthDetails($api) {        $this->db->select('*');        $this->db->from('api_info');        $this->db->where('api_name', $api);        $this->db->where('service_type', 1);        $this->db->where('status', 1);        $this->db->limit('1');        $query = $this->db->get();        if ($query->num_rows() > 0) {            return $query->row();        } else {            return '';        }    }    public function delete_temp_results($sess_id,$api) {        $this->db->where('session_id', $sess_id);        $this->db->where('api', $api);        $this->db->delete('hotel_search_result');    }    function detail_calculate_rate($amountbeforetax = 0, $discount = 0, $tax = 0, $additionalguest, $addguestdiscout) {        $amnt = 0;        for ($a = 0; $a < count($additionalguest); $a++) {            if (isset($additionalguest[$a])) {                $gues = $additionalguest[$a];            } else {                $gues = 0;            }            if (isset($addguestdiscout[$a])) {                $disc = $addguestdiscout[$a];            } else {                $disc = 0;            }            $amnt+= ($gues - $disc);        }        // $hotelsearch_data = $this->session->userdata('hotel_search_data');        // $netrate = (($amountbeforetax - $discount) + ($amnt) + ($tax)) * ($hotelsearch_data['nights']);        $netrate = (($amountbeforetax - $discount) + ($amnt) + ($tax));        $amnttosend=(($amountbeforetax - $discount) + ($amnt));        return array($netrate,$amnttosend);    }    public function insert_hotels_avail_data($insertrooms) {        $this->db->insert_batch('hotel_search_result', $insertrooms);    }    public function getHotelDetails($hotelCode, $searchId) {        $this->db->select('*');        $this->db->from('hotel_search_result t');        $this->db->join('tg_permanent_hotels p', 't.hotel_code = p.hotel_code');        $this->db->where('t.search_id', $searchId);        $this->db->where('t.hotel_code', $hotelCode);        $query = $this->db->get();        //echo $this->db->last_query();exit;        if ($query->num_rows() > 0){            return $query->row();        } else {            return '';        }    }    public function getHotelImagesyatra($hotelCode) {        $this->db->select('*');        $this->db->from('tg_hotel_images_yatra');        $this->db->where('hotel_code', $hotelCode);        $query = $this->db->get();        // echo $this->db->last_query();exit;        if ($query->num_rows() > 0){            return $query->result();        } else {             $this->db->select('*');            $this->db->from('tg_hotel_images');            $this->db->where('hotel_code', $hotelCode);            $query = $this->db->get();            return $query->result();        }    }    function getHotel_facilities($HotelCode,$amenity_type='') {        $this->db->select('*');        $this->db->from('tg_hotel_facilities');        $this->db->where('hotel_code', $HotelCode);        if($amenity_type != '') {            $this->db->where('amenity_type', $amenity_type);        }        $this->db->order_by('amenity_type', 'ASC');        $query = $this->db->get();        // echo $this->db->last_query();exit;        if ($query->num_rows() > 0) {            return $query->result();        } else {            return false;        }    }    public function getHotelReviews($hotelCode) {        $this->db->select('*');        $this->db->from('tg_hotel_reviews');        $this->db->where('hotel_code', $hotelCode);        $query = $this->db->get();        if ($query->num_rows() > 0){            return $query->result();        }else{            return '';        }    }    function delete_multiple_rooms($session_id,$uniqueRefNo, $hotel_code, $id) {        $this->db->where('uniqueRefNo',$uniqueRefNo);        $this->db->where('session_id', $session_id);        $this->db->where('hotel_code', $hotel_code);        $this->db->where('search_id !=', $id);        $this->db->delete('hotel_search_result');    }    function insert_hotel_temp_results($sess_id,$uniqueRefNo, $api_name, $RoomID, $RatePlanCode, $AmountBeforeTax, $Taxesval, $Discountval, $netrate,$amttosend,$taxtosend, $RoomTypename, $NonSmoking, $adultMaxOccupancy, $childMaxOccupancy, $NonRefundable, $RatePlanDescriptionval, $RatePlanInclusionDesciptionval, $DiscountCouponDisplayIndicatorval, $HotelCode, $HotelType, $DeepLinkInformationval, $admin_markup,$agent_markup,  $payment_charge, $total_amount, $Roomdescription, $Cancelpolicyval, $Roomimage,$percent) {        $this->db->set('curr_date_time', 'NOW()', FALSE);        $data = array(            'session_id' => $sess_id,            'uniqueRefNo' => $uniqueRefNo,            'api' => $api_name,            'hotel_code' => $HotelCode,            'room_code' => $RoomID,            'room_type' => ucwords(strtolower($RoomTypename)),            'adult_max_occ' => $adultMaxOccupancy,            'child_max_occ' => $childMaxOccupancy,            'non_smoking' => $NonSmoking,            'rate_plan_code' => $RatePlanCode,            'non_refundable' => $NonRefundable,            'rate_plan_description' => $RatePlanDescriptionval,            'inclusion' => $RatePlanInclusionDesciptionval,            // 'discount_coupon_indicator' => $DiscountCouponDisplayIndicatorval,            'amount_before_tax' => $AmountBeforeTax,            'tax' => $Taxesval,            'discount_coupon' => $Discountval,            'net_amount' => $netrate,            'amount_to_send' => $amttosend,            'tax_to_send' => $taxtosend,            'admin_markup' => $admin_markup,            'agent_markup' => $agent_markup,            'payment_charge' => $payment_charge,            'hotel_type' => $HotelType,            // 'deep_link_information' => $DeepLinkInformationval,            'total_cost'=>$total_amount,            // 'room_description' => $Roomdescription,            'cancellation_policy' => $Cancelpolicyval,            'cancel_policy' => $Cancelpolicyval,            'room_image' => $Roomimage,            'discount'=>$percent        );        $this->db->insert('hotel_search_result', $data);    }    public function get_hotel_rooms($session_id,$uniqueRefNo, $hotelCode,$hotel_id) {        $this->db->select('t.*,p.*');        $this->db->from('hotel_search_result t');        $this->db->join('tg_permanent_hotels p', 't.hotel_code = p.hotel_code');        $this->db->where('t.uniqueRefNo',$uniqueRefNo);        $this->db->where('t.session_id', $session_id);        $this->db->where('t.hotel_code', $hotelCode);        $this->db->where('search_id !=', $hotel_id);        $this->db->order_by('t.total_cost');        $query = $this->db->get();        if ($query->num_rows() > 0) {            return $query->result();        } else {            return '';        }    }    public function get_nearby_hotels($sess_id,$uniqueRefNo,  $hotelCode, $lat, $long, $city) {        // $this->db->select("*,(((acos(sin(($lat*pi()/180)) * sin((`Latitude`*pi()/180))+cos(($lat*pi()/180)) * cos((`Latitude`*pi()/180)) * cos((($long- `Longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance");        $this->db->select('*');        $this->db->from('hotel_search_result h');        $this->db->join('api_permanent_hotels p', 'h.hotel_code = p.hotel_code');        $this->db->where('p.hotel_code !=', $hotelCode);        $this->db->where('h.session_id', $sess_id);        $this->db->group_by('p.hotel_name');        // $this->db->having('distance <', 9);        $this->db->limit(3);        $query = $this->db->get();        if ($query->num_rows() > 0) {            return $query->result();        } else {            return '';        }    }    public function getRoomDetails($api, $sess_id, $hotelCode, $searchId) {        $this->db->select('a.*,b.*');        $this->db->from('hotel_search_result a');        $this->db->join('tg_permanent_hotels b', 'a.hotel_code = b.hotel_code', 'left');        $this->db->where('b.hotel_code', $hotelCode);        $this->db->where('a.session_id', $sess_id);        $this->db->where('a.api', $api);        $this->db->where('a.search_id', $searchId);        $query = $this->db->get();        //echo $this->db->last_query();exit;        if ($query->num_rows() > 0) {            return $query->row();        } else {            return '';        }    }    function getCountries() {        $this->db->select('name');        $this->db->from('country');        $query = $this->db->get();        if ($query->num_rows() > 0) {            return $query->result();        } else {            return '';        }    }    function get_agent_available_balance( $agent_no) {        $this->db->select('available_balance')        ->from('agent_acc_summary')        ->where('agent_no', $agent_no)        ->order_by('transaction_datetime', 'DESC')        ->limit('1');        $query = $this->db->get();        if ($query->num_rows() > 0) {            $res = $query->result();            $balance = $res[0]->available_balance;        } else {            $balance = 0;        }        return  $balance;    }    public function insert_booking_report_data($book_refno, $uniqueRefNo, $booking_status, $Booking_Date, $Deducted_Amount,$Net_Amount,$Booking_Amount, $Admin_Markup, $Payment_Charge, $Currecy, $Xml_Currency, $Cancel_Till_Date,$agent_markup,$promotional_discount,$payment_type,$dealsval) {        if ($this->session->userdata('user_logged_in')) {            $user_id = $this->session->userdata('user_id');            $Booking_Done_By = 'user';            $agent_id = 0;        } else if ($this->session->userdata('agent_logged_in')) {            $agent_id = $this->session->userdata('agent_id');            $Booking_Done_By = 'agent';            $user_id = 0;        } else {            $agent_id = 0;            $user_id = 0;            $Booking_Done_By = 'guest';        }        $passenger_info = $this->session->userdata('passenger_info');               $session_data = $this->session->userdata('hotel_search_data');        $data = array(            'user_id' => $user_id,            'agent_id' => $agent_id,            'Api_Name' => 'travelguru',            'Hotel_RefNo' => $book_refno,            'Booking_RefNo' => $book_refno,            'uniqueRefNo' => $uniqueRefNo,            'Booking_Status' => $booking_status,            'Booking_Date' => $Booking_Date,            // 'Net_Amount' => $Net_Amount,            'Deducted_Amount' => $Net_Amount,            'Booking_Amount' => $Net_Amount,            'deals'=>$dealsval,            'total_cost' => ($Booking_Amount+$Payment_Charge),            'Admin_Markup' => $Admin_Markup,            'Payment_Charge' => $Payment_Charge,            'Agent_Markup' => $agent_markup,            'currency_conv_value' => $Net_Amount,            'Currecy' => $Currecy,            'ROE'=>1,            'Xml_Currency' => $Xml_Currency,            'Cancel_Till_Date' => $Cancel_Till_Date,            'Booking_Done_By' => $Booking_Done_By,            'payment_type'=>$payment_type,            'search_array' => serialize($session_data),            //'promotional_discount' => $promotional_discount,                      //'Promotional_Code' => $promotional_code,                              //'Payment_Method' => $passenger_info['payment_type'],                   );        $this->db->insert('hotel_booking_reports', $data);        //echo $this->db->last_query();exit;            return $this->db->insert_id();    }    public function insert_hotel_booking_information_data($uniqueRefNo, $hotel_code, $hotel_name, $city_code, $check_in, $check_out, $voucher_date, $city, $room_type, $inclusion, $star, $address, $room_count, $cancellation_policy, $adults_count, $childs_count, $description, $phone, $fax, $image, $nights, $api, $adults, $childs, $childs_ages) {        $room_type1=$inclusion1=array();        for($r=0;$r<$room_count;$r++){            $room_type1[]= $room_type;            $inclusion1[]= $inclusion;        }        $room_type=implode(',', $room_type1);        if(!empty($inclusion)){            $inclusion=implode(',', $inclusion1);        }        // $queryh=$this->db->select('time_checkin,time_checkout')->where('hotel_code',$hotel_code)->from('tg_hotel_overview')->get();        $resho = $this->checkincheckout($hotel_code);        // echo '<pre>'; print_r($room_type);exit;        $data = array(            'uniqueRefNo' => $uniqueRefNo,            'hotel_code' => $hotel_code,            'hotel_name' => $hotel_name,            'city_code' => $city_code,            'check_in' => $check_in,            'check_out' => $check_out,            'voucher_date' => $voucher_date,            'city' => $city,            'room_type' => ucwords(strtolower($room_type)),            'inclusion'=>$inclusion,            //'star' => $star,            'address' => $address,            'room_count' => $room_count,            'cancellation_policy' => $cancellation_policy,            'adult' => $adults_count,            'child' => $childs_count,            'description' => $description,            'phone' => $phone,            'fax' => $fax,            'image' => $image,            'nights' => $nights,            'api' => $api,            'checkintime'=>$resho->time_checkin,            'checkouttime'=>$resho->time_checkout            // 'comment_desc' => $comp_pol        );        $passenger_info = $this->session->userdata('passenger_info');        // echo '<pre>'; print_r($passenger_info);//exit;        $this->db->insert('hotel_booking_hotels_info', $data);        //echo $this->db->last_query();exit;        $insert_id = $this->db->insert_id();        if ($insert_id) {            $adt = 0;            $chd = 0;            for ($i = 0; $i < $room_count; $i++) {                $adultTitles = $passenger_info['adults_title'];                $adultFNames = $passenger_info['adults_fname'];                $adultLNames = $passenger_info['adults_lname'];                // $adultDOBDate = $passenger_info['adultDOBDate'];                if (isset($passenger_info['childs_title'])) {                    $childTitles = $passenger_info['childs_title'];                    $childFNames = $passenger_info['childs_fname'];                    $childLNames = $passenger_info['childs_lname'];                    // $childDOBDate = $passenger_info['childDOBDate'];                }                $city   = $passenger_info['user_city'];                $mobile = $passenger_info['user_mobile'];                $email = $passenger_info['user_email'];                $address = $passenger_info['address'];                $country = $passenger_info['user_country'];                // for ($a = 0; $a < $adults[$i]; $a++) {                    $adult_data = array(                        'uniqueRefNo' => $uniqueRefNo,                        'passenger_type' => 'adult',                        'title' => $adultTitles[$adt],                        'first_name' => $adultFNames[$adt],                        'last_name' => $adultLNames[$adt],                        // 'dob'=>$adultDOBDate[$adt],                        'room_no' => $i + 1,                        'mobile' => $mobile,                        'email' => $email,                        'city' => $city,                        'country' => $country,                        'address' => $address,                    );                    $this->db->insert('hotel_booking_passengers_info', $adult_data);                    $adt++;                // }                /*if (array_key_exists($i, $childs) && $childs[$i] != '') {                    if (isset($childs_ages[$i]) && $childs_ages[$i] != '') {                        $age = $childs_ages[$i];                        $cage = explode(',', $age);                    } else {                        $cage = 0;                    }                    for ($c = 0; $c < $childs[$i]; $c++) {                        $child_data = array(                            'uniqueRefNo' => $uniqueRefNo,                            'passenger_type' => 'child',                            'title' => $childTitles[$chd],                            'first_name' => $childFNames[$chd],                            'last_name' => $childLNames[$chd],                            // 'dob'=>$childDOBDate[$chd],                            'room_no' => $i + 1,                            'child_age' => $cage[$c]                        );                        $this->db->insert('hotel_booking_passengers_info', $child_data);                        $chd++;                    }                }*/            }        }        return true;    }    public function hotelBookingSummary($uniqueRefNo, $Booking_RefNo='') {        $this->db->select('hr.*,hh.city as hotel_city,hh.*,hp.*');        $this->db->from('hotel_booking_reports hr');        $this->db->join('hotel_booking_hotels_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo','LEFT');        $this->db->join('hotel_booking_passengers_info hp', 'hr.uniqueRefNo = hp.uniqueRefNo','LEFT');        if(!empty($Booking_RefNo)){          $this->db->where('hr.Booking_RefNo', $Booking_RefNo);        }        $this->db->where('hr.uniqueRefNo', $uniqueRefNo);        $this->db->group_by('hr.uniqueRefNo');        $this->db->limit('1');        $query = $this->db->get();              if ($query->num_rows() > 0) {            return $query->row();        }        return false;    }    public function updateCancelStatus($Booking_RefNo,$Amount) {        $data['Cancellation_Status'] = 'Cancelled';        $data['Cancellation_Charge'] = $Amount;        $data['Cancel_Till_Date'] = date('Y-m-d');        $where = "Booking_RefNo = '$Booking_RefNo'";        if ($this->db->update('hotel_booking_reports', $data, $where)) {            return true;        } else {            return false;        }    }    public function checkincheckout($hotel_code){        $queryh=$this->db->select('time_checkin,time_checkout')->where('hotel_code',$hotel_code)->from('tg_hotel_overview')->get();        return $queryh->row();    }}