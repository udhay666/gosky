<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotels_Model extends CI_Model {

  public function __construct() {
    parent::__construct();
  }    

  public function getActiveAPIs() {
    $this->db->select('api_name');
    $this->db->from('api_info');
    $this->db->where('service_type', 1);
    $this->db->where('status', 1);
    $this->db->order_by('order_no', 'ASC');
    $query = $this->db->get();
    if($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return '';
    }
  }

  public function getHotelByCity($sess_id,$uniqueRefNo,$search) {
    $where = "p.hotel_name LIKE '%" . $search . "%'";
    $this->db->select('p.hotel_name,t.hotel_code,t.city_code,t.city_name');
    $this->db->from('hotel_search_result t');
    $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code');
    $this->db->where('t.session_id',$sess_id);
    $this->db->where('t.uniqueRefNo',$uniqueRefNo);
    $this->db->where($where);
    // $this->db->where('status', 1);
    $this->db->limit(20);
    $this->db->group_by('p.hotel_code');
    $this->db->order_by('p.hotel_name');
    $query = $this->db->get();
     // echo $this->db->last_query();
    if ($query->num_rows() == '') {
      return '';
    } else {
      return $query->result_array();
    }
  }

  public function TotalSearchResults($sess_id, $minPrice = '', $maxPrice = '', $starRating = '', $hotelName = '', $location = '') {
    //$this->db->group_by('p.hotel_name_unique');
    $this->db->group_by('t.hotel_code');
    $this->db->select('t.hotel_code');
    $this->db->from('hotel_search_result t');
    //$this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code AND t.api = p.api');
    //$this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.api = p.api','right');
    $this->db->where('t.session_id', $sess_id);
    //$this->db->join('api_permanent_hotels p');


 // $session_data = $this->session->userdata('hotel_search_data');
  //$cityid = $session_data['cityCode'];
   // $this->db->where('t.uniqueRefNo', $session_data['uniqueRefNo']);
  // $this->db->where('city_id',$cityid);

    if ($minPrice != '' && $maxPrice != '') {
        $this->db->where('t.total_cost BETWEEN ' . $minPrice . ' AND ' . $maxPrice);
    }
    if ($starRating != '') {
        $stars = explode(',', $starRating);
        $this->db->where_in('t.star', $stars);
    }
    if ($location != '') {
        $loc_list = explode(',', $location);
        $this->db->where_in('t.location', $loc_list);
    }
    if ($hotelName != '') {
        $this->db->like('t.hotel_name', $hotelName);
    }
    //$this->db->group_by('t.hotel_code');
    $query = $this->db->get();
  //echo $this->db->last_query();exit;
    if ($query->num_rows() == 0) {
        return 0;
    } else {
        return $query->num_rows();
    }
  }

  public function get_filter_option_details($sess_id) {
    //   $this->db->group_by('p.hotel_name');
    $this->db->select('MIN(t.total_cost) as min_price, MAX(t.total_cost) as max_price');
    $this->db->from('hotel_search_result t');
    //$this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.api = p.api','right');
    $this->db->where('t.session_id', $sess_id);
    //$this->db->join('api_permanent_hotels p', 't.api = p.api');
  //  $session_data = $this->session->userdata('hotel_search_data');
    //$cityid = $session_data['cityCode'];
  //  $this->db->where('t.uniqueRefNo', $session_data['uniqueRefNo']);
    //$this->db->where('city_id',$cityid);
    $query = $this->db->get();
    //echo $this->db->last_query();exit;
    if ($query->num_rows() == 0) {
        return 0;
    } else {
        return $query->row();
    }
  }

  public function get_locations_list($sess_id) {
    $this->db->select('p.location');
    $this->db->from('hotel_search_result t');
    // $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code');
    $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code');
    $this->db->where('t.session_id',$sess_id);
    $this->db->distinct();
    $query = $this->db->get();

    if($query->num_rows() > 0 ) {
      return $query->result();
    } else {
      return '';
    }
  }


  public function all_fetch_search_result($sess_id, $offset, $perPage, $minPrice = '', $maxPrice = '', $starRating = '', $hotelName = '', $location = '', $sortBy = '', $order = '') {
    $this->db->group_by('t.hotel_code');
 //$this->db->group_by('p.hotel_name_unique');
    //$this->db->select_min('t.total_cost','maxtotal_cost');
    $this->db->select('t.*, t.hotel_name,t.hotel_image asimage,t.star,t.city_name,t.location,t.address as address');
     $this->db->from('hotel_search_result t');
  //   $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code');
  //$this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.api = p.api','right');
         //$this->db->join('api_permanent_hotels p', 't.api = p.api');
     $this->db->where('t.session_id', $sess_id);
//$this->db->where('t.ez_supplier_name', 'dotw');

 //$session_data = $this->session->userdata('hotel_search_data');
  //$cityid = $session_data['cityCode'];
     // $this->db->where('t.uniqueRefNo', $session_data['uniqueRefNo']);
 // $this->db->where('city_id',$cityid);

     if ($minPrice != '' && $maxPrice != '') {
         $this->db->where('t.total_cost BETWEEN ' . $minPrice . ' AND ' . $maxPrice);
     }
     //echo $starRating;exit;
     if ($starRating != '') {
         $stars = explode(',', $starRating);
         $this->db->where_in('t.star', $stars);
     }
     if ($location != '') {
         $loc_list = explode(',', $location);
         $this->db->where_in('t.location', $loc_list);
     }
     if ($hotelName != '') {
         $this->db->like('t.hotel_name', $hotelName);
     }
     //$this->db->group_by('t.hotel_code');
     if ($sortBy != '' && $order != '') {
         if ($sortBy == 'data-price') {
             $this->db->order_by('t.total_cost', strtoupper($order));
         } else if ($sortBy == 'data-star') {
             $this->db->order_by('t.star', strtoupper($order));
         } else if ($sortBy == 'data-hotel-name') {
             $this->db->order_by('t.hotel_name', strtoupper($order));
         } else {
             $this->db->order_by('t.total_cost', 'ASC');
         }
     } else {
         $this->db->order_by('t.total_cost', 'ASC');
     }

     $this->db->limit($perPage, $offset);
     $query = $this->db->get();
    //echo $this->db->last_query();exit;
     if ($query->num_rows() > 0) {
      return $query->result();
     } else {
      return '';
     }
 }

  public function get_hotel_booking_information($uniqueRefNo,$hotelRefNo='') {
    $this->db->select('r.*,h.*,r.agent_id as agentid');
    $this->db->from('hotel_booking_reports r');
    $this->db->join('hotel_booking_hotels_info h', 'r.uniqueRefNo = h.uniqueRefNo');
    // $this->db->where('r.Hotel_RefNo',$hotelRefNo);
    $this->db->where('h.uniqueRefNo',$uniqueRefNo);
    $this->db->limit('1');
    $query = $this->db->get();
    // echo $this->db->last_query();exit;
    if($query->num_rows() > 0 ) {
      return $query->row();
    } else {
      return '';
    }
  }

  public function get_hotel_booking_passenger_info($uniqueRefNo) {
    $this->db->select('*');
    $this->db->from('hotel_booking_passengers_info');
    $this->db->where('uniqueRefNo',$uniqueRefNo);
    $this->db->order_by('pass_id','ASC');
    $query = $this->db->get();
    if($query->num_rows() > 0 ) {
      
      return $query->result();
    } else {
      return '';
    }
  }

  public function hotelBookingSummary($uniqueRefNo, $Booking_RefNo='') {
    $this->db->select('hr.*,hh.city as hotel_city,hh.*,hp.*');
    $this->db->from('hotel_booking_reports hr');
    $this->db->join('hotel_booking_hotels_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo','LEFT');
    $this->db->join('hotel_booking_passengers_info hp', 'hr.uniqueRefNo = hp.uniqueRefNo','LEFT');
    if(!empty($Booking_RefNo)){
      $this->db->where('hr.Booking_RefNo', $Booking_RefNo);
    }
    $this->db->where('hr.uniqueRefNo', $uniqueRefNo);
    $this->db->group_by('hr.uniqueRefNo');
    $query = $this->db->get();      
    if ($query->num_rows() > 0) {
        return $query->result();
    }
    return false;
  }
  public function get_hotel_result_rooms($session_id, $hotelCode, $api) {
    $this->db->select('t.*,t.hotel_name,t.hotel_image as image,t.star,t.city_name,t.location,t.address as address');
    $this->db->from('hotel_search_result t');
    //$this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code');
    //$this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.api = p.api');
    $this->db->where('t.session_id', $session_id);
    $this->db->where('t.hotel_code', $hotelCode);
    $this->db->where('t.api', $api);
    $this->db->order_by('t.total_cost', 'ASC');
    //$this->db->limit(2);

    $query = $this->db->get(); //echo $this->db->last_query();exit;
    if ($query->num_rows() > 0){
        return $query->result();
    }else{
        return '';
    }
}
}