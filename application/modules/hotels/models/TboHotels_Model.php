<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TboHotels_Model extends CI_Model {

  public function __construct() {
    parent::__construct();
  } 
  
    public function checkCityCode($cityCode) {
        $this->db->select('*');
        $this->db->from('tbo_hotels_city_list');
        $this->db->where('city_id', $cityCode);
        $this->db->limit('1');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return '';
    }
    function getApiAuthDetails($api) {
        $this->db->select('*');
        $this->db->from('api_info');
        $this->db->where('api_name', $api);
        $this->db->where('service_type', 1);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query = $this->db->get();
// echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }
    public function delete_temp_results($sess_id, $api) {
        $this->db->where('session_id', $sess_id);
        $this->db->where('api', $api);
        $this->db->delete('hotel_search_result');
    }
    public function check_in_permanent($api,$hotelcode){
        $this->db->select('*');
        $this->db->from('api_permanent_hotels');
        $this->db->where('api',$api);
        $this->db->where('hotel_code',$hotelcode);
        $query=$this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return '';
        }
    }
    public function insert_temp_results($insertion_data) {
        $this->db->insert_batch('hotel_search_result', $insertion_data);
    }
    public function getHotelDetails($hotelCode, $searchId) {
        $this->db->select('*');
        $this->db->from('hotel_search_result');
        $this->db->where('search_id', $searchId);
        $this->db->where('hotel_code', $hotelCode);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->row();
        else
            return '';
    }
    public function update_hotel_policy($sess_id,$hotelCode, $searchId,$hotel_policy){
        $data=array(
            'tariff_notes'=>$hotel_policy,
        );
        $this->db->where('session_id',$sess_id);
        $this->db->where('search_id',$searchId);
        $this->db->where('hotel_code',$hotelCode);
        $this->db->update('hotel_search_result',$data);
    }
    public function fetch_temp_result_room($sess_id, $uniquekey, $hotelCode) {
        $this->db->select('*');
        $this->db->from('hotel_search_result');
        $this->db->where('hotel_code', $hotelCode);
        $this->db->where('uniqueRefNo', $uniquekey);
        $this->db->where('session_id', $sess_id);
        //$this->db->order_by('sequence_no', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';
    }
    public function delete_temp_rooms($hotelCode, $search_id, $session_id, $uniqueRefNo) {
        $this->db->where('hotel_code', $hotelCode);
        $this->db->where('session_id', $session_id);
        $this->db->where('uniqueRefNo', $uniqueRefNo);
        $this->db->where('search_id !=', $search_id);
        $this->db->delete('hotel_search_result');
    }
    public function insert_rooms($data) {
        $this->db->insert('hotel_search_result', $data);
        return true;
    }
    public function fetch_hotel_rooms($hotelCode, $search_id, $session_id, $uniqueRefNo) {
        $this->db->select('*');
        $this->db->from('hotel_search_result');
        $this->db->where('hotel_code', $hotelCode);
        $this->db->where('session_id', $session_id);
        $this->db->where('search_id !=', $search_id);
        $this->db->where('uniqueRefNo', $uniqueRefNo);
        $this->db->order_by('total_cost', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }
    public function get_selected_comb_detail($hotelCode, $id, $session_id, $uniqueRefNo) {
        $this->db->select('t.*,p.*');
        $this->db->from('hotel_search_result t');
        $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.api = p.api','right');
        $this->db->where('t.hotel_code', $hotelCode);
        $this->db->where('t.session_id', $session_id);
        $this->db->where('t.search_id', $id);
        // $this->db->where('t.uniqueRefNo', $uniqueRefNo);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }
    public function updated_reprice_details($update_info, $search_id, $sessionId, $hotelCode, $uniqueRefNo) {
        $this->db->where('hotel_code', $hotelCode);
        $this->db->where('session_id', $sessionId);
        $this->db->where('search_id', $search_id);
        $this->db->where('uniqueRefNo', $uniqueRefNo);
        $this->db->update('hotel_search_result', $update_info);
    }
    public function get_country_list() {
        $this->db->select('name');
        $this->db->from('country');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';
    }
    public function insert_booking_report_data($bookingItemCodeval, $book_noval, $uniqueRef, $ConfirmationNo, $InvoiceNumber, $booking_status, $Booking_Date, $Net_Amount, $Deducted_Amount, $Booking_Amount, $Admin_Markup, $Agent_Markup, $Payment_Charge, $Currecy, $Xml_Currency, $Booking_Done_By, $agent_id, $user_id, $cancel_policy,$tokenid,$payment_type,$promotional_discount,$hotel_policy,$searcharray) {
        $data = array('user_id' => $user_id,
            'agent_id' => $agent_id,
            'Api_Name' => 'tbohotels',
            //'api_log_id' => $this->session->userdata('sess_uniqueRefNo'),
            'Booking_RefNo' => $bookingItemCodeval,
            'Hotel_RefNo' => $book_noval,
            'uniqueRefNo' => $uniqueRef,
            'tbo_confirm_no' => $ConfirmationNo,
            'tbo_invoice_no' => $InvoiceNumber,
            'Booking_Status' => $booking_status,
            'Booking_Date' => $Booking_Date,
            'Net_Amount' => $Net_Amount,
            'Deducted_Amount' => $Deducted_Amount,
            'Booking_Amount' => $Booking_Amount,
             'total_cost' => $Booking_Amount,
            'Admin_Markup' => $Admin_Markup,
            'Agent_Markup' => $Agent_Markup,
            'Payment_Charge' => $Payment_Charge,
            'Currecy' => $Currecy,
            'Xml_Currency' => $Xml_Currency,
            'Booking_Done_By' => $Booking_Done_By,
            'user_id' => $user_id,
            'agent_id' => $agent_id,
            'cancel_policy' => $cancel_policy,
            'tbo_token_id'=>$tokenid,
            'payment_type'=>$payment_type,
            'promotional_discount'=>$promotional_discount,
            'tbo_hotel_policy'=>$hotel_policy,
            'searcharray'=>$searcharray,
            );

        $this->db->insert('hotel_booking_reports', $data);
        //echo $this->db->last_query();exit;
        return $this->db->insert_id();
    }
    public function insert_hotel_booking_information_data($uniqueRefNo, $hotel_code, $hotel_name, $city_code, $check_in, $check_out, $voucher_date, $city, $room_type, $inclusion, $star, $room_count, $cancellation_policy, $adults_count, $childs_count, $description, $fax, $image, $nights, $api, $adults, $childs, $childs_ages, $comp_pol, $room_type_code, $rate_plan_code,$address,$phone) {
        $data = array('uniqueRefNo' => $uniqueRefNo,
            'hotel_code' => $hotel_code,
            'hotel_name' => $hotel_name,
            'city_code' => $city_code,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'voucher_date' => $voucher_date,
            'city' => $city,
            'room_type' => $room_type . ' - ' . $inclusion,
            'star' => $star,
            'address' => $address,
            'room_count' => $room_count,
            'cancellation_policy' => $cancellation_policy,
            'adult' => $adults_count,
            'child' => $childs_count,
            'description' => $description,
           'phone' => $phone,
            'fax' => $fax,
            'image' => $image,
            'nights' => $nights,
            'api' => $api,
            'comment_desc' => $comp_pol,
            'room_type_code' => $comp_pol,
            'rate_plan_code' => $comp_pol,
            'room_format' => $comp_pol,
        );

        $this->db->insert('hotel_booking_hotels_info', $data);
        //echo $this->db->last_query();exit;
        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            $adt = 0;
            $chd = 0;
            $passenger_info = $this->session->userdata('passenger_info');

            $adultTitles = $passenger_info['adults_title'];
            $adultFNames = $passenger_info['adults_fname'];
            $adultLNames = $passenger_info['adults_lname'];

            if (isset($passenger_info['childs_title'])) {
                $childTitles = $passenger_info['childs_title'];
                $childFNames = $passenger_info['childs_fname'];
                $childLNames = $passenger_info['childs_lname'];
            }

            $user_email = $passenger_info['user_email'];
            $user_mobile = $passenger_info['user_mobile'];

            $zip_code = $passenger_info['user_zipcode'];
            $city = $passenger_info['user_city'];
            $state = $passenger_info['user_state'];
            $mobile = $passenger_info['user_mobile'];
            $email = $passenger_info['user_email'];
            $address = $passenger_info['user_address'];
            $country = $passenger_info['user_country'];
            for ($i = 0; $i < $room_count; $i++) {
                for ($a = 0; $a < $adults[$i]; $a++) {

                    $adult_data = array('uniqueRefNo' => $uniqueRefNo,
                        'passenger_type' => 'adult',
                        'title' => $adultTitles[$adt],
                        'first_name' => $adultFNames[$adt],
                        'last_name' => $adultLNames[$adt],
                        'room_no' => $i + 1,
                        'mobile' => $mobile,
                        'email' => $email,
                        'address' => $address,
                        'country' => $country,
                        'city' => $city,
                        'state' => $state,
                        'zip_code' => $zip_code,
                    );
                    $this->db->insert('hotel_booking_passengers_info', $adult_data);
                    $adt++;
                }
                if (array_key_exists($i, $childs) && $childs[$i] != '') {
                    for ($c = 0; $c < $childs[$i]; $c++) {
                        if (isset($childs_ages[$chd]) && $childs_ages[$chd] != '')
                            $age = $childs_ages[$chd];
                        else
                            $age = 0;

                        $child_data = array('uniqueRefNo' => $uniqueRefNo,
                            'passenger_type' => 'child',
                            'title' => $childTitles[$chd],
                            'first_name' => $childFNames[$chd],
                            'last_name' => $childLNames[$chd],
                            'room_no' => $i + 1,
                            'child_age' => $age
                        );
                        $this->db->insert('hotel_booking_passengers_info', $child_data);
                        $chd++;
                    }
                }
            }
        }
        return true;
    }
}