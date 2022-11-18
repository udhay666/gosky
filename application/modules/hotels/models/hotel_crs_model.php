<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotelcrs_Model extends CI_Model {

    const CODE_START = '10000000';

    function __construct() {
        parent::__construct();
    }

    function getApiAuthDetails($api) {
        $this->db->select('*');
        $this->db->from('api_info');
        $this->db->where('api_name', $api);
        $this->db->where('service_type', 1);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }
  

    public function checkCityCode($cityCode) {
        $this->db->select('city_name');
        $this->db->from('tbo_hotels_city_list');
        $this->db->where('city_id', $cityCode);
        $this->db->limit('1');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return array();
    }

    public function check_city($city) {
        $this->db->select('id');
        $this->db->from('glb_hotel_city_list');
        $this->db->where('city_name', $city);
        $this->db->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() == '') {
            return false;
        } else {
            return true;
        }
    }

    // BELOW IS THE CODE OF PRAVEEN FOR THE CRS FETCH
    public function get_crs_hotels_old($city, $checkin, $checkout, $adults, $childs) {

        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
        $hotel_search = array();
        $this->db->select('a.sup_hotel_id,a.hotel_code,a.hotel_name,a.hotel_title,a.hotel_rating,a.hotel_desc,a.hotel_country,a.hotel_address,a.hotel_postalcode,a.hotel_lat,a.hotel_long,a.hotel_checkin,a.hotel_checkout,a.hotel_distance_airport,a.hotel_distance_citymarket,a.hotel_distance_railway,t.room_facilities,t.room_name,t.room_code,t.room_type_id,t.room_type,t.room_details_id,t.room_fixed_rate,t.total_cost,t.room_cost, f.amenity_list_id,i.image_path,ct.city_name');
        $this->db->from('sup_hotels a');
        $this->db->join("(select hotel_code from sup_hotels s where s.hotel_city in (select id from glb_hotel_city_list where city_name = 'Bangalore') and admin_status='1' and status='1') s", 'a.hotel_code = s.hotel_code');
        $this->db->join("(select d.hotel_code,d.room_facilities,d.room_name,d.room_code,e.room_type,d.room_type_id,r.sup_room_details_id as room_details_id,r.room_fixed_rate,sum(r.room_fixed_rate) as room_cost,sum(r.room_fixed_rate) as total_cost from sup_hotel_room_details as d JOIN ( select id,room_type from glb_hotel_room_type) as e on e.id = d.room_type_id JOIN (select sup_room_details_id,room_fixed_rate from sup_hotel_room_rates  where  room_avail_date BETWEEN '" . $checkin . "' AND '" . $checkout . "' and rooms_available > 0 order by room_fixed_rate ASC) as r on r.sup_room_details_id = d.sup_room_details_id where no_of_adults >= $adults and no_of_childs >= $childs GROUP BY d.hotel_code,room_details_id)  t", "a.hotel_code = t.hotel_code");
        $this->db->join("(select id,city_name from glb_hotel_city_list) ct", 'a.hotel_city = ct.id', 'left');
        $this->db->join("sup_hotel_facilities as f", 'a.hotel_code = f.hotel_code', 'left');
        $this->db->join("sup_hotel_images as i", 'a.hotel_code = i.hotel_code and i.image_type = 1', 'left');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() == '') {
            return array();
        } else {
            $result = $query->result();
            foreach ($result as $row) {
                if (!isset($hotel_search[$row->hotel_code])) {
                    $hotel_search[$row->hotel_code] = array();
                }
                $hotel_search[$row->hotel_code][$row->room_code] = $row;
            }
            //return $query->result();
        }
        return $hotel_search;
        /*
          //$this->db->order_by('a.hotel_code,r.room_fixed_rate','ASC');
          //$where_clause = "select hotel_code from sup_hotels s where s.hotel_city in (select id from glb_hotel_city_list where city_name = '$city' and admin_status='1' and status='1')";
          if(!empty($rooms) && $rooms > 0 ) {

          $this->db->select('*');
          $this->db->from('sup_hotel_room_rates r');
          $this->db->where("r.room_avail_date BETWEEN '".$checkin."' AND '".$checkout."'");
          $this->db->join("(select hotel_code from sup_hotels s where s.hotel_city in (select id from glb_hotel_city_list where city_name = '$city' and admin_status='1' and status='1')) s",'r.hotel_code = s.hotel_code');
          //$this->db->join("(select sup_room_details_id,room_fixed_rate,hotel_code from sup_hotel_room_rates  where  room_avail_date BETWEEN '".$checkin."' AND '".$checkout."') r",'a.hotel_code = r.hotel_code');
          $this->db->join("sup_hotels a",'a.hotel_code = r.hotel_code');
          //$where_clause = "select hotel_code from sup_hotels s where s.hotel_city in (select id from glb_hotel_city_list where city_name = '$city' and admin_status='1' and status='1')";
          for($i=0; $i < $rooms;$i++) {
          $this->db->join("(select hotel_code from sup_hotel_room_details  where no_of_adults >= $adults[$i] and no_of_childs >= $childs[$i])  t".($i+1),"r.hotel_code = t".($i+1).".hotel_code");
          }
          };
          $this->db->where("s.hotel_city in (select id from glb_hotel_city_list where city_name = '$city' and admin_status='1' and status='1'");
          $this->db->from('sup_hotel_room_rates r');
          $this->db->where("r.sup_room_details_id IN ($where_clause)");
          $this->db->where("r.room_avail_date BETWEEN '".$checkin."' AND '".$checkout."'");
          $where_clause = $this->db->return_query();
          print_r($where_clause);
          exit();
          $this->db->select('*');
          $this->db->from('sup_hotels a');
          $this->db->where("a.hotel_city",$city);
          $this->db->where("a.hotel_code IN ($where_clause)"); */
    }

    
        public function get_crs_hotels_old1($city, $checkin, $checkout, $adults, $childs) {

        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
        $hotel_search = array();
        $this->db->select('a.supplier_hotel_list_id,a.hotel_code,a.hotel_name,a.hotel_star_rating,a.hotel_desc,a.hotel_country,a.address,a.latitude,a.longitude,a.currency_type,a.check_in,a.check_out,a.thumb_img,a.hotel_facilities,t.room_facilities,t.room_name,t.room_code,t.*,ct.city_name');
        $this->db->from('supplier_hotel_list a');
        $this->db->join("(select hotel_code from supplier_hotel_list s where s.cityid in (select city_id from tbo_hotels_city_list where city_id = '$city') and admin_status='1' and status='1') s", 'a.hotel_code = s.hotel_code');
        $this->db->join("(select d.room_facilities,d.room_name,e.room_type,d.hotel_room_type,r.sup_room_details_id as room_details_id, r.*,sum($adults*r.adult_rate) as adult_room_cost,sum($adults*r.adult_rate) as adult_total_cost,sum($childs*r.child_rate) as child_room_cost, sum($childs*r.child_rate) as child_total_cost, sum(r.room_rate) as room_cost,sum(r.room_rate) as total_cost 
         from supplier_room_list as d JOIN ( select id,room_type from glb_hotel_room_type) as e on e.id = d.hotel_room_type JOIN (select * from sup_hotel_room_rates  where  room_avail_date BETWEEN '" . $checkin . "' AND '" . $checkout . "' and rooms_available != 0 order by room_rate ASC, adult_rate ASC) as r on r.sup_room_details_id = d.supplier_room_list_id where ((min_adults_without_extra_bed<=$adults) AND (max_adults_without_extra_bed>=$adults)) AND ((min_child_without_extra_bed<=$childs) AND (max_child_without_extra_bed>=$childs))  GROUP BY d.hotel_code,sup_hotel_room_rates_list_id,room_details_id)  t", "a.hotel_code = t.hotel_code");
        $this->db->join("(select city_id,city_name from tbo_hotels_city_list) ct", 'a.cityid = ct.city_id', 'left');


     // d.supplier_room_list_id where ($adults BETWEEN coalesce(`min_adults_without_extra_bed`,$adults) AND coalesce(`max_adults_without_extra_bed`,$adults)) AND ($childs BETWEEN coalesce(`min_child_without_extra_bed`,$childs) AND coalesce(`max_child_without_extra_bed`,$childs))


        // $this->db->join("sup_hotel_facilities as f", 'a.hotel_code = f.hotel_code', 'left');
        // $this->db->join("sup_hotel_images as i", 'a.hotel_code = i.hotel_code and i.image_type = 1', 'left');
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return array();
        } else {
            $result = $query->result();
            foreach ($result as $row) {
                if (!isset($hotel_search[$row->hotel_code])) {
                    $hotel_search[$row->hotel_code] = array();
                }
                $hotel_search[$row->hotel_code][$row->room_code] = $row;
            }
            //return $query->result();
        }
        return $hotel_search;
        /*
          //$this->db->order_by('a.hotel_code,r.room_fixed_rate','ASC');
          //$where_clause = "select hotel_code from sup_hotels s where s.hotel_city in (select id from glb_hotel_city_list where city_name = '$city' and admin_status='1' and status='1')";
          if(!empty($rooms) && $rooms > 0 ) {

          $this->db->select('*');
          $this->db->from('sup_hotel_room_rates r');
          $this->db->where("r.room_avail_date BETWEEN '".$checkin."' AND '".$checkout."'");
          $this->db->join("(select hotel_code from sup_hotels s where s.hotel_city in (select id from glb_hotel_city_list where city_name = '$city' and admin_status='1' and status='1')) s",'r.hotel_code = s.hotel_code');
          //$this->db->join("(select sup_room_details_id,room_fixed_rate,hotel_code from sup_hotel_room_rates  where  room_avail_date BETWEEN '".$checkin."' AND '".$checkout."') r",'a.hotel_code = r.hotel_code');
          $this->db->join("sup_hotels a",'a.hotel_code = r.hotel_code');
          //$where_clause = "select hotel_code from sup_hotels s where s.hotel_city in (select id from glb_hotel_city_list where city_name = '$city' and admin_status='1' and status='1')";
          for($i=0; $i < $rooms;$i++) {
          $this->db->join("(select hotel_code from sup_hotel_room_details  where no_of_adults >= $adults[$i] and no_of_childs >= $childs[$i])  t".($i+1),"r.hotel_code = t".($i+1).".hotel_code");
          }
          };
          $this->db->where("s.hotel_city in (select id from glb_hotel_city_list where city_name = '$city' and admin_status='1' and status='1'");
          $this->db->from('sup_hotel_room_rates r');
          $this->db->where("r.sup_room_details_id IN ($where_clause)");
          $this->db->where("r.room_avail_date BETWEEN '".$checkin."' AND '".$checkout."'");
          $where_clause = $this->db->return_query();
          print_r($where_clause);
          exit();
          $this->db->select('*');
          $this->db->from('sup_hotels a');
          $this->db->where("a.hotel_city",$city);
          $this->db->where("a.hotel_code IN ($where_clause)"); */
    }

    
    public function get_facility_details($amenities) {
        $this->db->select('facility');
        $this->db->from('glb_hotel_facilities_type');
        $this->db->where_in('id', $amenities);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return array();
        } else {
            return $query->result();
        }
    }

    public function delete_temp_results($sess_id,$api) {
        $this->db->where('session_id', $sess_id);
         $this->db->where('api', $api);
        $this->db->delete('hotel_search_result');
    }

    public function insert_crs_data($insertion_data) {
      //echo "tsting";exit;
//        $this->db->insert_batch('crs_search_result', $insertion_data);
           $this->db->insert_batch('hotel_search_result_hotelcrs', $insertion_data);
    }

    public function fetch_search_result($sess_id, $api) {
        $this->db->select('*');
        $this->db->from("(select * from crs_search_result where session_id = '$sess_id' and api = '$api' order by  total_cost ASC) as t");
        /* $this->db->where('session_id', $sess_id);
          $this->db->where('api', $api); */
        $this->db->group_by('t.hotel_code');
        /* $this->db->order_by('total_cost', 'ASC'); */
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return array();
        } else {
            return $query->result();
        }
    }

    public function get_nearby_hotels($sess_id,$hotelCode, $lat, $long, $city) {
        // $this->db->select("*,(((acos(sin(($lat*pi()/180)) * sin((`Latitude`*pi()/180))+cos(($lat*pi()/180)) * cos((`Latitude`*pi()/180)) * cos((($long- `Longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance");
        $this->db->select('*, h.city_name as city_name');
        $this->db->from('hotel_search_result h');
        $this->db->join('api_permanent_hotels p', 'h.hotel_code = p.hotel_code');
        $this->db->where('p.hotel_code !=', $hotelCode);
        $this->db->where('h.session_id', $sess_id);
        $this->db->where('h.city_code', $city);
        $this->db->group_by('p.hotel_name');
        // $this->db->having('distance <', 9);
        $this->db->limit(4);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }
    /*public function get_nearby_hotels($sess_id, $hotelCode, $lat, $long, $city) {
        $this->db->select("h.search_id,p.*,h.image,(((acos(sin(($lat*pi()/180)) * sin((p.latitude*pi()/180))+cos(($lat*pi()/180)) * cos((p.latitude*pi()/180)) * cos((($long- p.longitude)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance");
        $this->db->from('hotel_search_result h');
        $this->db->join('supplier_hotel_list p', 'h.hotel_code = p.hotel_code');
        //$this->db->where('h.city_name', $city);
        $this->db->where('p.hotel_code !=', $hotelCode);
        $this->db->where('h.session_id', $sess_id);
        $this->db->group_by('p.hotel_name');
        $this->db->having('distance <', 9);
        $this->db->limit(5);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() == '') {
            return array();
        } else {
            return $query->result();
        }
    }*/

    public function get_related_hotels($sess_id, $hotelCode, $lat, $long, $city) {
        $this->db->select("h.search_id,p.*,h.image,(((acos(sin(($lat*pi()/180)) * sin((p.latitude*pi()/180))+cos(($lat*pi()/180)) * cos((p.latitude*pi()/180)) * cos((($long- p.longitude)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance");
        $this->db->from('hotel_search_result h');
        $this->db->join('supplier_hotel_list p', 'h.hotel_code = p.hotel_code');
        //$this->db->where('h.city_name', $city);
        $this->db->where('p.hotel_code !=', $hotelCode);
        $this->db->where('h.session_id', $sess_id);
        $this->db->group_by('p.hotel_name');
        $this->db->having('distance >', 5);
        $this->db->limit(4);
        $query = $this->db->get();

        if ($query->num_rows() == '') {
            return array();
        } else {
            return $query->result();
        }
    }

    public function get_cancellation_policy($hotelCode) {
        $this->db->select('*');
        $this->db->from('sup_hotel_cancellation_rates');
        $this->db->where('hotel_code', $hotelCode);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();
    }

    public function get_discount($hotelCode) {
        $this->db->select('*');
        $this->db->from('sup_hotel_discount_rates');
        $this->db->where('hotel_code', $hotelCode);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();
    }

    public function getHotelDetails($hotelCode, $searchId) {
        $this->db->select('t.*,p.*,c.city_name,t.image,t.description,t.session_id,t.xml_currency,t.api,t.search_id,t.total_cost,p.hotel_facilities as amenities');
        $this->db->from('hotel_search_result_hotelcrs t');
        $this->db->join('supplier_hotel_list p', 't.hotel_code = p.hotel_code');
        $this->db->join('tbo_hotels_city_list c', 'p.cityid = c.city_id', 'left');
        $this->db->where('t.search_id', $searchId);
        $this->db->where('t.hotel_code', $hotelCode);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->row();
        else
            return array();
    }

    public function getHotelImages($hotelCode) {
        $this->db->select('gallery_img,img_type');
        $this->db->from('supplier_hotel_images');
        $this->db->where('hotel_code', $hotelCode);       
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();
    }

     public function getRoomImages($hotelCode) {
        $this->db->select('gallery_img');
        $this->db->from('supplier_room_gallery_images');
        $this->db->where('hotel_code', $hotelCode);       
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();
    }

    public function get_hotel_facility_details($hotelCode) {
        $this->db->select('hotel_facilities');
        $this->db->from('api_permanent_hotels');
        $this->db->where('hotel_code', $hotelCode);
       // $this->db->group_by('fac_type');
        $query = $this->db->get();
         // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return '';
    }

    public function get_hotel_rooms_old($session_id, $hotelCode) {
        $this->db->select('p.*,t.image,t.total_cost,t.currency_conv_value,t.xml_currency,t.currency,t.search_id,t.cancel_policy,t.session_id,t.room_code,t.room_type,t.room_name,t.adult,t.child,t.room_count');
        $this->db->from('hotel_search_result t');
        $this->db->join('supplier_hotel_list p', 't.hotel_code = p.hotel_code');
        //$this->db->join('sup_hotel_room_details d','t.room_code = d.room_code');
        //$this->db->join('glb_hotel_room_type h','d.room_type_id = h.id','left');
        $this->db->where('t.session_id', $session_id);
        $this->db->where('t.hotel_code', $hotelCode);
        $this->db->order_by('t.total_cost', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();
    }

    public function get_hotel_result_rooms($session_id, $hotelCode) {
        $this->db->select('*');
        $this->db->from('hotel_search_result');
        $this->db->where('session_id', $session_id);
        $this->db->where('hotel_code', $hotelCode);
        $this->db->order_by('total_cost', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();
    }

    public function get_hotel_room_by_code_old($roomcode) {

        $this->db->select('*');
        $this->db->from('sup_hotel_room_details');
        $this->db->where('room_code', $roomcode);
        $query = $this->db->get();
        $this->db->limit('1');
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return array();
    }

 public function get_hotel_room_by_code($roomcode) {

        $this->db->select('*');
        $this->db->from('supplier_room_list');
        $this->db->where('room_code', $roomcode);
        $query = $this->db->get();
        $this->db->limit('1');
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return array();
    }

    public function get_hotel_room_image_by_code($roomcode) {

        $this->db->select('*');
        $this->db->from('supplier_room_gallery_images');
        $this->db->where('room_code', $roomcode);
        $query = $this->db->get();
        $this->db->limit('1');
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return array();
    }
    public function fetch_hb_temp_result_room_m2($sess_id, $hotelCode, $classVal) {
        $this->db->select('*');
        $this->db->from('hotels_search_result');
        $this->db->where('hotel_code', $hotelCode);
        $this->db->where('session_id', $sess_id);
        $this->db->where('classification', $classVal);
        $this->db->group_by('promotions');
        $this->db->order_by('search_id', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();
    }

    public function fetch_hb_temp_result_room_m3($sess_id, $hotelCode, $classVal, $prom) {
        $this->db->select('*');
        $this->db->from('hotels_search_result');
        $this->db->where('hotel_code', $hotelCode);
        $this->db->where('session_id', $sess_id);
        $this->db->where('classification', $classVal);
        $this->db->where('promotions', $prom);
        $this->db->group_by('room_type');
        $this->db->order_by('search_id', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();
    }

    public function fetch_hb_temp_result_room_m4($sess_id, $hotelCode, $classVal, $prom, $roomType) {
        $this->db->select('*');
        $this->db->from('hotels_search_result');
        $this->db->where('hotel_code', $hotelCode);
        $this->db->where('session_id', $sess_id);
        $this->db->where('classification', $classVal);
        $this->db->where('promotions', $prom);
        $this->db->where('room_type', $roomType);
        $this->db->group_by(array('inclusion', 'room_type'));
        $this->db->order_by('search_id', 'ASC');
        $this->db->order_by('room_type', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();
    }

    public function fetch_hb_temp_result_room_m5($sess_id, $hotelCode, $classVal, $prom, $roomType, $incl) {
        $this->db->select('*,min(total_cost) least_cost');
        $this->db->from('hotels_search_result');
        $this->db->where('hotel_code', $hotelCode);
        $this->db->where('session_id', $sess_id);
        $this->db->where('classification', $classVal);
        $this->db->where('promotions', $prom);
        $this->db->where('room_type', $roomType);
        $this->db->where('inclusion', $incl);
        $this->db->order_by('search_id', 'ASC');
        $this->db->order_by('total_cost', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() == '') {
            return array();
        } else {
            $res = $query->result();
            $least_cost = $res[0]->least_cost;

            $this->db->select('*');
            $this->db->from('hotels_search_result');
            $this->db->where('hotel_code', $hotelCode);
            $this->db->where('session_id', $sess_id);
            $this->db->where('classification', $classVal);
            $this->db->where('promotions', $prom);
            $this->db->where('room_type', $roomType);
            $this->db->where('inclusion', $incl);
            $this->db->where('total_cost', $least_cost);
            $this->db->order_by('search_id', 'ASC');
            $this->db->order_by('total_cost', 'ASC');
            $query1 = $this->db->get();

            if ($query1->num_rows() > 0)
                return $query1->result();
            else
                return array();
        }
    }

    public function fetch_hb_temp_result_room_m2_v1($sess_id, $hotelCode, $classVal) {
        $this->db->select('*');
        $this->db->from('hotels_search_result');
        $this->db->where('hotel_code', $hotelCode);
        $this->db->where('session_id', $sess_id);
        $this->db->where('classification', $classVal);
        $this->db->group_by('promotions');
        $this->db->order_by('total_cost', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();
    }

    public function fetch_hb_temp_result_room_m3_v1($sess_id, $hotelCode, $classVal, $prom) {
        $this->db->select('*');
        $this->db->from('hotels_search_result');
        $this->db->where('hotel_code', $hotelCode);
        $this->db->where('session_id', $sess_id);
        $this->db->where('classification', $classVal);
        $this->db->where('promotions', $prom);
        $this->db->group_by('inclusion');
        $this->db->order_by('total_cost', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();
    }

    public function fetch_hb_temp_result_room_m4_v1($sess_id, $hotelCode, $classVal, $prom, $inclusion) {
        $this->db->select('*');
        $this->db->from('hotels_search_result');
        $this->db->where('hotel_code', $hotelCode);
        $this->db->where('session_id', $sess_id);
        $this->db->where('classification', $classVal);
        $this->db->where('promotions', $prom);
        $this->db->where('inclusion', $inclusion);
        $this->db->group_by(array('adult', 'child'));
        $this->db->order_by('total_cost', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() == '') {
            return array();
        } else {
            $res = $query->result();
            $aa = array();
            for ($k = 0; $k < count($res); $k++) {
                $adult = $res[$k]->adult;
                $child = $res[$k]->child;

                $this->db->select('*,min(total_cost) least_cost');
                $this->db->from('hotels_search_result');
                $this->db->where('hotel_code', $hotelCode);
                $this->db->where('session_id', $sess_id);
                $this->db->where('classification', $classVal);
                $this->db->where('promotions', $prom);
                $this->db->where('inclusion', $inclusion);
                $this->db->where('adult', $adult);
                $this->db->where('child', $child);
                $this->db->order_by('total_cost', 'ASC');
                $query1 = $this->db->get();

                if ($query1->num_rows() == '') {
                    return array();
                } else {
                    $res1 = $query1->result();
                    $least_cost = $res1[0]->least_cost;

                    $this->db->select('*');
                    $this->db->from('hotels_search_result');
                    $this->db->where('hotel_code', $hotelCode);
                    $this->db->where('session_id', $sess_id);
                    $this->db->where('classification', $classVal);
                    $this->db->where('promotions', $prom);
                    $this->db->where('inclusion', $inclusion);
                    $this->db->where('adult', $adult);
                    $this->db->where('child', $child);
                    $this->db->where('total_cost', $least_cost);
                    $query2 = $this->db->get();

                    if ($query2->num_rows() > 0)
                        $aa[] = $query2->result();
                }
            }

            return $aa;
        }
    }

    public function insert_merged_room_data($insertion_data) {
        $this->db->insert('hotels_search_result', $insertion_data);
        return $this->db->insert_id();
    }

    public function getRoomDetails_old($api, $sess_id, $hotelCode, $searchId) {
        $this->db->select('a.cancel_policy,a.image,a.admin_markup,a.admin_agent_markup,a.di_markup,a.di_agent_markup,a.sub_agent_markup,a.payment_charge,a.total_cost,a.api,a.xml_currency,a.currency,a.currency_conv_value,a.search_id,a.session_id, b.*,a.room_type,a.room_code,a.star,a.city_name,c.supplier_no');
        $this->db->from('hotel_search_result a');
        $this->db->join('supplier_hotel_list b', 'a.hotel_code = b.hotel_code', 'left');
        $this->db->join('supplier_info c', 'c.supplier_id = b.supplier_id', 'left');
        //$this->db->join('sup_hotel_room_details d','a.room_code = d.room_code');
        //$this->db->join('glb_hotel_room_type h','d.room_type_id = h.id','left');		
        //$this->db->join('glb_hotel_city_list c', 'b.hotel_city = c.id','left');		
        $this->db->where('b.hotel_code', $hotelCode);
        $this->db->where('a.session_id', $sess_id);
        $this->db->where('a.api', $api);
        $this->db->where_in('a.search_id', $searchId);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            // return $query->row();
           return $query->result();
        } else {
            return array();
        }
    }

    public function updateCancelData($sess_id, $searchId, $purTokenVal, $serviceval, $canceldisplayValc, $dateFromValc, $dateToValc) {
        $data = array('purchase_token_val' => $purTokenVal,
            'service_val' => $serviceval,
            'cancel_amount' => $canceldisplayValc,
            'cancel_date_from' => $dateFromValc,
            'cancel_date_to' => $dateToValc
        );
        $where = "session_id = '$sess_id' AND  search_id = '$searchId'";
        $this->db->where($where);
        $this->db->update('hotels_search_result', $data);
    }

    public function updateCancelPolicy($sess_id, $searchId, $cancel_policy) {
        $data = array('cancel_policy' => mysql_real_escape_string($cancel_policy));
        $where = "session_id = '$sess_id' AND  search_id = '$searchId'";
        $this->db->where($where);
        $this->db->update('hotel_search_result', $data);
    }

    public function insert_booking_report_data($user_id, $agent_id,$agent_type,$supplier_id, $Book_reference, $AL_RefNo, $Booking_Date, $Book_Hotelcode, $Book_Nights, $Book_currency, $Book_totamnt, $total_cost, $admin_markup, $admin_agent_markup,$di_markup,$di_agent_markup,$sub_agent_markup, $payment_charge, $Book_Status, $Booking_Done_By,$payment_type) {
        $data = array(
            'user_id' => $user_id,
            'agent_id' => $agent_id,
            'supplier_id'=>$supplier_id,
            'Api_Name'=>'hotel_crs',
            'Hotel_RefNo' => '',
            'Booking_RefNo' => $Book_reference,
            'uniqueRefNo' => $AL_RefNo,
            'Booking_Status' => $Book_Status,
            'Booking_Date' => $Booking_Date,
            'Booking_Amount' => $Book_totamnt,
            'total_cost' => $total_cost,
            'Admin_Markup' => $admin_markup,
            'Admin_Agent_Markup' => $admin_agent_markup,
            'Di_Markup' => $di_markup,
              'Di_Agent_Markup' => $di_agent_markup,
               'Sub_Agent_Markup' => $sub_agent_markup,
            'Payment_Charge' => $payment_charge,
            //'Cancel_Till_Date' => $Cancel_Till_Date,
            'Currency' => $Book_currency,
            'Xml_Currency' => $Book_currency,
            'Booking_Done_By' => $Booking_Done_By,
            'payment_type'=>$payment_type,
            'agent_type'=>$agent_type,
        );
        $this->db->insert('hotel_booking_reports', $data);
        return $this->db->insert_id();
    }

    public function insert_hotel_booking_information_data($user_id, $agent_id, $AL_RefNo, $Book_Hotelcode, $Book_Roomcode, $Book_HotelName, $city, $checkIn, $checkOut, $Booking_Date, $roomcount, $Book_Nights, $api, $star, $image, $description, $address, $phone, $fax, $adultcount, $childcount, $adults, $childs, $childs_ages, $cancellation_policy, $adult_extrabed_count, $child_extrabed_count, $adult_extrabed, $child_extrabed,$inclusion,$room_type_name) {

        /*$data = array(
            'user_id' => $user_id,
            'agent_id' => $agent_id,
            'uniqueRefNo' => $AL_RefNo,
            'hotel_code' => $Book_Hotelcode,
            'room_code' => $Book_Roomcode,
            'hotel_name' => $Book_HotelName,
            'city_code' => $city,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'voucher_date' => $Booking_Date,
            'city' => $city,
            'room_type' => $room_type_name,
            'inclusion' => rtrim($inclusion,', '),
            'room_count' => $roomcount,
            'nights' => $Book_Nights,
            'api' => $api,
            'star' => $star,
            'image' => $image,
            'description' => $description,
            'address' => $address,
            'phone' => $phone,
            'fax' => $fax,
            'adult' => $adultcount,
            'child' => $childcount,
            'adult_extrabed' => $adult_extrabed_count,
            'child_extrabed' => $child_extrabed_count,
            'cancellation_policy' => $cancellation_policy
        );*/


        $data = array('uniqueRefNo' => $AL_RefNo,
            'hotel_code' => $Book_Hotelcode,
            'hotel_name' => $Book_HotelName,
            'city_code' => $city,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'voucher_date' => $Booking_Date,
            'city' => $city,
            'room_type' => $room_type_name . ' - ' . rtrim($inclusion,', '),
            'star' => $star,
            'address' => $address,
            'room_count' => $roomcount,
            'cancellation_policy' => $cancellation_policy,
            'adult' => $adultcount,
            'child' => $childcount,
            'description' => $description,
           'phone' => $phone,
            'fax' => $fax,
            'image' => $image,
            'nights' => $Book_Nights,
            'api' => $api,
            'comment_desc' => "hOTEL",
            'room_type_code' => $comp_pol,
            'rate_plan_code' => $comp_pol,
            'room_format' => $comp_pol,
        );

        print_r($data);
        $this->db->insert('hotel_booking_hotels_info', $data);
        echo $this->db->last_query();exit;	
        $insert_id = $this->db->insert_id();
        

        if ($insert_id) {
            $adt = 0;
            $chd = 0;
            $ex_adt = 0;
            $ex_chd = 0;
            for ($i = 0; $i < $roomcount; $i++) {
                $passenger_info = $this->session->userdata('passenger_info');

                $adultTitles = $passenger_info['adults_title'];
                $adultFNames = $passenger_info['adults_fname'];
                $adultLNames = $passenger_info['adults_lname'];

                if (isset($passenger_info['childs_title'])) {
                    $childTitles = $passenger_info['childs_title'];
                    $childFNames = $passenger_info['childs_fname'];
                    $childLNames = $passenger_info['childs_lname'];
                }

                $adult_extrabedTitles = $passenger_info['adult_extrabed_title'];
                $adult_extrabedFNames = $passenger_info['adult_extrabed_fname'];
                $adult_extrabedLNames = $passenger_info['adult_extrabed_lname'];

                if (isset($passenger_info['child_extrabed_title'])) {
                   $child_extrabedTitles = $passenger_info['child_extrabed_title'];
                   $child_extrabedFNames = $passenger_info['child_extrabed_fname'];
                   $child_extrabedLNames = $passenger_info['child_extrabed_lname'];
                }


              $mobile = $passenger_info['user_mobile'];
              $email = $passenger_info['user_email'];
              $user_pincode = $passenger_info['user_pincode'];
              $user_city =  $passenger_info['user_city'];
              $user_state =  $passenger_info['user_state'];
              $user_country =  $passenger_info['user_country'];
              $address = $passenger_info['address'];


                for ($a = 0; $a < $adults[$i]; $a++) {
                    $adult_data = array('uniqueRefNo' => $AL_RefNo,
                        'passenger_type' => 'adult',
                        'title' => $adultTitles[$adt],
                        'first_name' => $adultFNames[$adt],
                        'last_name' => $adultLNames[$adt],
                        'room_no' => $i + 1,
                        'mobile' => $mobile,
                        'email' => $email,
                        'city'=>$user_city,
                        'state'=>$user_state,
                        'zip_code'=>$user_pincode,
                        'address'=>$address,
                        'country'=>$user_country,
                    );

                    $this->db->insert('hotel_booking_passengers_info', $adult_data);
                    // echo $this->db->last_query();exit; 
                    $adt++;
                }

                if (array_key_exists($i, $childs) && $childs[$i] != '') {
                    for ($c = 0; $c < $childs[$i]; $c++) {
                        if (isset($childs_ages[$c]) && $childs_ages[$c] != '')
                            $age = $childs_ages[$c];
                        else
                            $age = 0;

                        $child_data = array('uniqueRefNo' => $AL_RefNo,
                            'passenger_type' => 'child',
                            'title' => $childTitles[$chd],
                            'first_name' => $childFNames[$chd],
                            'last_name' => $childLNames[$chd],
                            'room_no' => $i + 1,
                            'child_age' => $age,
                            'city'=>$user_city,
                            'state'=>$user_state,
                            'zip_code'=>$user_pincode,
                            'address'=>$address,
                            'country'=>$user_country,
                        );
                       // print_r($child_data);
                        $this->db->insert('hotel_booking_passengers_info', $child_data);
                        
                        $chd++;
                    }
                }

                for ($a = 0; $a < $adult_extrabed[$i]; $a++) {
                    $adult_extrabed_data = array('uniqueRefNo' => $AL_RefNo,
                        'passenger_type' => 'adult_extrabed',
                        'title' => $adult_extrabedTitles[$ex_adt],
                        'first_name' => $adult_extrabedFNames[$ex_adt],
                        'last_name' => $adult_extrabedLNames[$ex_adt],
                        'room_no' => $i + 1,
                        'mobile' => $mobile,
                        'email' => $email,
                        'city'=>$user_city,
                        'state'=>$user_state,
                        'zip_code'=>$user_pincode,
                        'address'=>$address,
                        'country'=>$user_country,
                    );

                    $this->db->insert('hotel_booking_passengers_info', $adult_extrabed_data);
                    $ex_adt++;
                }

                if (array_key_exists($i, $child_extrabed) && $child_extrabed[$i] != '') {
                    for ($c = 0; $c < $child_extrabed[$i]; $c++) {
                      $age = 0;

                        $child_extrabed_data = array('uniqueRefNo' => $AL_RefNo,
                            'passenger_type' => 'child_extrabed',
                            'title' => $child_extrabedTitles[$ex_chd],
                            'first_name' => $child_extrabedFNames[$ex_chd],
                            'last_name' => $child_extrabedLNames[$ex_chd],
                            'room_no' => $i + 1,
                            'child_age' => $age,
                            'city'=>$user_city,
                            'state'=>$user_state,
                            'zip_code'=>$user_pincode,
                            'address'=>$address,
                            'country'=>$user_country,
                        );

                        $this->db->insert('hotel_booking_passengers_info', $child_extrabed_data);
                        $ex_chd++;
                    }
                }

            }
        }

        return true;
    }

    function get_admin_markup($nationality) {
        $this->db->select('name');
        $this->db->from('country');
        $this->db->where('iso2', $nationality);
        $this->db->limit('1');
        $query = $this->db->get();
        $res = $query->row();
        $country = $res->name;


        $this->db->select('markup');
        $this->db->from('b2c_markup_info');
        $this->db->where('markup_type', 'specific');
        $this->db->where('country', $country);
        $this->db->where('service_type', 1);
        $this->db->where('api_name', 'hotel_crs');
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query1 = $this->db->get();
        if ($query1->num_rows > 0) {
            $res1 = $query1->row();
            $admin_markup_val = $res1->markup;
        } else {
            $this->db->select('markup');
            $this->db->from('b2c_markup_info');
            $this->db->where('markup_type', 'generic');
            $this->db->where('service_type', 1);
            $this->db->where('api_name', 'hotel_crs');
            $this->db->where('status', 1);
            $this->db->limit('1');
            $query2 = $this->db->get();
            if ($query2->num_rows > 0) {
                $res2 = $query2->row();
                $admin_markup_val = $res2->markup;
            } else {
                $admin_markup_val = 0;
            }
        }
        return $admin_markup_val;
    }

    function get_payment_charge() {
        $this->db->select('charge');
        $this->db->from('payment_gateway');
        $this->db->where('service_type', 1);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $res = $query->row();
            $payment_charge_val = $res->charge;
        } else {
            $payment_charge_val = 0;
        }
        return $payment_charge_val;
    }

//    function get_admin_agent_markup($agent_no) {
//        $this->db->select('markup');
//        $this->db->from('b2b_markup_info');
//        $this->db->where('markup_type', 'specific');
//        $this->db->where('agent_no', $agent_no);
//        $this->db->where('service_type', 1);
//        $this->db->where('api_name', 'hotel_crs');
//        $this->db->where('status', 1);
//        $this->db->limit('1');
//        $query1 = $this->db->get();
//        if ($query1->num_rows > 0) {
//            $res1 = $query1->row();
//            $agent_markup_val = $res1->markup;
//        } else {
//            $this->db->select('markup');
//            $this->db->from('b2b_markup_info');
//            $this->db->where('markup_type', 'generic');
//            $this->db->where('agent_no', $agent_no);
//            $this->db->where('service_type', 1);
//            $this->db->where('api_name', 'hotel_crs');
//            $this->db->where('status', 1);
//            $this->db->limit('1');
//            $query2 = $this->db->get();
//            if ($query2->num_rows > 0) {
//                $res2 = $query2->row();
//                $agent_markup_val = $res2->markup;
//            } else {
//                $agent_markup_val = 0;
//            }
//        }
//        return $agent_markup_val;
//    }
    function get_admin_agent_markup($agent_no) {
        $this->db->select('markup');
        $this->db->from('b2b_markup_info');
        $this->db->where('markup_type', 'specific');
        $this->db->where('agent_no', $agent_no);
        $this->db->where('service_type', 1);
        $this->db->where('api_name', 'hotel_crs');
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query1 = $this->db->get();
        if ($query1->num_rows > 0) {
            $res1 = $query1->row();
            $agent_markup_val = $res1->markup;
        } else {
            $this->db->select('markup');
            $this->db->from('b2b_markup_info');
            $this->db->where('markup_type', 'specific');
            $this->db->where('agent_no', 'all');
            $this->db->where('service_type', 1);
            $this->db->where('api_name', 'hotel_crs');
            $this->db->where('status', 1);
            $this->db->limit('1');
            $query3 = $this->db->get();
            if ($query3->num_rows > 0) {
                $res3 = $query3->row();
                $agent_markup_val = $res3->markup;
            } else {
                $this->db->select('markup');
                $this->db->from('b2b_markup_info');
                $this->db->where('markup_type', 'generic');
                $this->db->where('agent_no', $agent_no);
                $this->db->where('service_type', 1);
                $this->db->where('api_name', 'hotel_crs');
                $this->db->where('status', 1);
                $this->db->limit('1');
                $query2 = $this->db->get();
                if ($query2->num_rows > 0) {
                    $res2 = $query2->row();
                    $agent_markup_val = $res2->markup;
                } else {
                    $this->db->select('markup');
                    $this->db->from('b2b_markup_info');
                    $this->db->where('markup_type', 'generic');
                    $this->db->where('agent_no', 'all');
                    $this->db->where('service_type', 1);
                    $this->db->where('api_name', 'hotel_crs');
                    $this->db->where('status', 1);
                    $this->db->limit('1');
                    $query4 = $this->db->get();
                    if ($query4->num_rows > 0) {
                        $res4 = $query4->row();
                        $agent_markup_val = $res4->markup;
                    } else {
                        $agent_markup_val = 0;
                    }
                }
            }
        }
        return $agent_markup_val;
    }

    function get_agent_markup($agent_no) {
        $this->db->select('markup');
        $this->db->from('agent_markup_manager');
        $this->db->where('agent_no', $agent_no);
        $this->db->where('service_type', 1);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $res = $query->row();
            $agent_markup = $res->markup;
        } else {
            $agent_markup = 0;
        }
        return $agent_markup;
    }

   

    public function check_availablity_old($room_code, $checkIn, $checkOut, $adults, $childs) {
        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkOut)));
        $this->db->select('*');
        $this->db->from('sup_hotel_room_rates a');
        $this->db->join("(select * from sup_hotel_room_details where no_of_adults >= $adults and no_of_childs >= $childs)  b", 'a.room_code = b.room_code');
        $this->db->where("a.room_avail_date BETWEEN '" . $checkIn . "' AND '" . $checkOut . "'");
        $this->db->where("a.rooms_available > 0");
        $this->db->where("a.room_code", $room_code);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function room_price_old($room_code, $checkIn, $checkOut, $adults, $childs) {
        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkOut)));
        $this->db->select('sum(a.room_fixed_rate) as total_cost');
        $this->db->from('sup_hotel_room_rates a');
        $this->db->join("(select * from sup_hotel_room_details where no_of_adults >= $adults and no_of_childs >= $childs)  b", 'a.room_code = b.room_code');
        $this->db->where("a.room_avail_date BETWEEN '" . $checkIn . "' AND '" . $checkout . "'");
        $this->db->where("a.room_code", $room_code);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $res = $query->row();
            return $res->total_cost;
        } else {
            return 0;
        }
    }


     public function check_availablity($room_code, $checkIn, $checkOut, $adults, $childs) {
       $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkOut)));
        $this->db->select("sum($adults*adult_rate) as adult_room_cost,sum($adults*adult_rate) as adult_total_cost,sum($childs*child_rate) as child_room_cost, sum($childs*child_rate) as child_total_cost, sum(room_rate) as room_cost,sum(room_rate) as total_cost ");
        $this->db->from('sup_hotel_room_rates');
        // $where="($adults BETWEEN coalesce(`min_adults_without_extra_bed`,$adults) AND coalesce(`max_adults_without_extra_bed`,$adults)) AND ($childs BETWEEN coalesce(`min_child_without_extra_bed`,$childs) AND coalesce(`max_child_without_extra_bed`,$childs))";
        $where="((min_adults_without_extra_bed<=$adults) AND (max_adults_without_extra_bed>=$adults)) AND ((min_child_without_extra_bed<=$childs) AND (max_child_without_extra_bed>=$childs))";
        $this->db->where($where);
       $this->db->where("room_avail_date BETWEEN '" . $checkIn . "' AND '" . $checkout . "'");
        $this->db->where("room_code", $room_code);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $res = $query->row();
            return true;
        } else {
            return false;
        }
    }

    public function room_price($room_code, $checkIn, $checkOut, $adults, $childs) {
        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkOut)));
        $this->db->select("sum($adults*adult_rate) as adult_room_cost,sum($adults*adult_rate) as adult_total_cost,sum($childs*child_rate) as child_room_cost, sum($childs*child_rate) as child_total_cost, sum(room_rate) as room_cost,sum(room_rate) as total_cost ");
        $this->db->from('sup_hotel_room_rates');
        // $where="($adults BETWEEN coalesce(`min_adults_without_extra_bed`,$adults) AND coalesce(`max_adults_without_extra_bed`,$adults)) AND ($childs BETWEEN coalesce(`min_child_without_extra_bed`,$childs) AND coalesce(`max_child_without_extra_bed`,$childs))";
            $where="((min_adults_without_extra_bed<=$adults) AND (max_adults_without_extra_bed>=$adults)) AND ((min_child_without_extra_bed<=$childs) AND (max_child_without_extra_bed>=$childs)) ";
        $this->db->where($where);
       $this->db->where("room_avail_date BETWEEN '" . $checkIn . "' AND '" . $checkout . "'");
        $this->db->where("room_code", $room_code);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $res = $query->row();
            return $res->total_cost;
        } else {
            return 0;
        }
    }

    public function reduce_availability($room_code, $checkIn, $checkOut) {
        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkOut)));
        $daterange = $this->dateRange($checkIn, $checkout);
        $this->db->set('rooms_available', '`rooms_available` - 1', FALSE);
        $this->db->where_in('room_avail_date', $daterange);
        $this->db->update('sup_hotel_room_rates');
    }

    public function insert_crs_booking($data) {
        $insert = $this->db->insert('sup_hotel_booking', $data);
        return $insert;
    }

    public function insert_crs_booking_room($data) {
        $insert = $this->db->insert('sup_hotel_booking_room', $data);
        return $insert;
    }

        public function insert_crs_booking_room_details($data) {
        $insert = $this->db->insert('sup_hotel_booking_room_details', $data);
        return $insert;
    }

    public function insert_crs_booking_pass($booking_id, $roomcount, $adults, $childs,$adult_extrabed,$child_extrabed,$uniqueRefNo) {
        $adt = 0;
        $chd = 0;
        $ex_adt = 0;
        $ex_chd = 0;
        $passenger_info = $this->session->userdata('passenger_info');

        $adultTitles = $passenger_info['adults_title'];
        $adultFNames = $passenger_info['adults_fname'];
        $adultLNames = $passenger_info['adults_lname'];

        if (isset($passenger_info['childs_title'])) {
            $childTitles = $passenger_info['childs_title'];
            $childFNames = $passenger_info['childs_fname'];
            $childLNames = $passenger_info['childs_lname'];
        }


        $adult_extrabedTitles = isset($passenger_info['adult_extrabed_title'])?$passenger_info['adult_extrabed_title']:array();
        $adult_extrabedFNames = isset($passenger_info['adult_extrabed_fname'])?$passenger_info['adult_extrabed_fname']:array();
        $adult_extrabedLNames = isset($passenger_info['adult_extrabed_lname'])?$passenger_info['adult_extrabed_lname']:array();

        if (isset($passenger_info['child_extrabed_title'])) {
           $child_extrabedTitles = $passenger_info['child_extrabed_title'];
           $child_extrabedFNames = $passenger_info['child_extrabed_fname'];
           $child_extrabedLNames = $passenger_info['child_extrabed_lname'];
        }

        $mobile = $passenger_info['user_mobile'];
       $email = $passenger_info['user_email'];
        $user_pincode = $passenger_info['user_pincode'];
        $user_city =  $passenger_info['user_city'];
        $user_state =  $passenger_info['user_state'];
        $user_country =  $passenger_info['user_country'];
        $address = $passenger_info['address'];

        for ($i = 0; $i < $roomcount; $i++) {

          


            for ($a = 0; $a < $adults[$i]; $a++) {
                $adult_data = array(
                    'booking_id' => $booking_id,
                    'uniqueRefNo' => $uniqueRefNo,
                    'pass_type' => 'adult',
                    'title' => $adultTitles[$adt],
                    'first_name' => $adultFNames[$adt],
                    'last_name' => $adultLNames[$adt],
                    'room_no' => $i + 1,
                    'mobile' => $mobile,
                    'email' => $email,
                    'zip_code'=>$user_pincode,
                    'city'=>$user_city,
                    'state'=>$user_state,
                    'country'=>$user_country,
                    'address'=>$address,
                  
                );
                $this->db->insert('sup_hotel_booking_pass', $adult_data);

                $adt++;
            }


            if (array_key_exists($i, $childs) && $childs[$i] != '') {
                for ($c = 0; $c < $childs[$i]; $c++) {
                    if (isset($childs_ages[$c]) && $childs_ages[$c] != '')
                        $age = $childs_ages[$c];
                    else
                        $age = 0;

                    $child_data = array(
                        'booking_id' => $booking_id,
                        'uniqueRefNo' => $uniqueRefNo,
                        'pass_type' => 'child',
                        'title' => $childTitles[$chd],
                        'first_name' => $childFNames[$chd],
                        'last_name' => $childLNames[$chd],
                        'room_no' => $i + 1,
                        'child_age' => $age,
                         'zip_code'=>$user_pincode,
                         'city'=>$user_city,
                        'state'=>$user_state,
                        'country'=>$user_country,
                        'address'=>$address,
                    );
                    $this->db->insert('sup_hotel_booking_pass', $child_data);
                    $chd++;
                }
            }

               for ($a = 0; $a < $adult_extrabed[$i]; $a++) {
                    $adult_extrabed_data = array(
                        'booking_id' => $booking_id,
                        'uniqueRefNo' => $uniqueRefNo,
                        'pass_type' => 'adult_extrabed',
                        'title' => $adult_extrabedTitles[$ex_adt],
                        'first_name' => $adult_extrabedFNames[$ex_adt],
                        'last_name' => $adult_extrabedLNames[$ex_adt],
                        'room_no' => $i + 1,
                        'mobile' => $mobile,
                        'email' => $email,
                         'zip_code'=>$user_pincode,
                        'city'=>$user_city,
                        'state'=>$user_state,
                        'country'=>$user_country,
                        'address'=>$address,
                    );

                    $this->db->insert('sup_hotel_booking_pass', $adult_extrabed_data);

                    $ex_adt++;
                }


                   if (array_key_exists($i, $child_extrabed) && $child_extrabed[$i] != '') {
                    for ($c = 0; $c < $child_extrabed[$i]; $c++) {
                      $age = 0;

                        $child_extrabed_data = array(
                            'booking_id' => $booking_id,
                            'uniqueRefNo' => $uniqueRefNo,
                            'pass_type' => 'child_extrabed',
                            'title' => $child_extrabedTitles[$ex_chd],
                            'first_name' => $child_extrabedFNames[$ex_chd],
                            'last_name' => $child_extrabedLNames[$ex_chd],
                            'room_no' => $i + 1,
                            'child_age' => $age,
                            'zip_code'=>$user_pincode,
                            'city'=>$user_city,
                            'state'=>$user_state,
                            'country'=>$user_country,
                            'address'=>$address,
                        );

                        $this->db->insert('sup_hotel_booking_pass', $child_extrabed_data);

                        $ex_chd++;
                    }
                }



        }
    }

    function dateRange($first, $last, $step = '+1 day', $format = 'Y-m-d') {

        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);

        while ($current <= $last) {

            $dates[] = date($format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }

    function insert_supplier_act_summary($insertion_data) {
        $this->db->insert('sup_acc_summary', $insertion_data);
        $report = array();
        // $report['error'] = $this->db->_error_number();
        // $report['message'] = $this->db->_error_message();
        // if ($report !== 0) {
            return true;
        // } else {
        //     return false;
        // }
    }

    function get_supplier_balance($supplier_id) {
        $this->db->select('available_balance')
                ->from('sup_acc_summary')
                ->where('supplier_id', $supplier_id)
                ->order_by('acc_id', 'DESC')
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $res = $query->result();
            $balance = $res[0]->available_balance;
        } else {
            $balance = 0;
        }
        return $balance;
    }
     function get_agent_available_balance($agent_no, $agent_type) {
        if ($agent_type == 1) {
            $this->db->select('available_balance')
                    ->from('agent_acc_summary')
                    ->where('agent_no', $agent_no)
                    ->order_by('transaction_datetime', 'DESC')
                    ->limit('1');
        }
        if ($agent_type == 2) {
            $this->db->select('available_balance')
                    ->from('agent_acc_summary')
                    ->where('agent_no', $agent_no)
                    ->order_by('transaction_datetime', 'DESC')
                    ->limit('1');
        }
        if ($agent_type == 3) {
            $this->db->select('available_balance')
                    ->from('b2b2b_acc_summary')
                    ->where('agent_no', $agent_no)
                    ->order_by('transaction_datetime', 'DESC')
                    ->limit('1');
        }

        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $res = $query->result();
            $balance = $res[0]->available_balance;
        } else {
            $balance = 0;
        }

        return $balance;
    }
         public function update_crs_search($total,$payment_charge,$sessionId,$hotelCode,$searchId){
        $data=array(
            'total_cost'=>$total,
            'payment_charge'=>$payment_charge,
        );
        $this->db->where('search_id',$searchId);
        $this->db->where('session_id',$sessionId);
        $this->db->where('hotel_code',$hotelCode);
        $this->db->update('hotel_search_result',$data);
    }
     public function pay_details($payinsert) {
        $this->db->insert('pay_details', $payinsert);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function get_pay_tran_id($refno){
        $this->db->select('*');
        $this->db->from('pay_details');
        $this->db->where('uniqueRefNo',$refno);
        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
        
    }
     public function insert_withdraw_status($agent_id, $agent_no, $withdraw_amount, $total, $BOOKING_REFERENCE_NO, $agent_type) {
        $disc_tran = 'Regarding Hotel Booking Ref: ' . $BOOKING_REFERENCE_NO;
        $data['status'] = 'Accepted';
        $data['available_balance'] = $total;

        $data['agent_no'] = $agent_no;
        $data['transaction_summary'] = $disc_tran;
        $data['agent_id'] = $agent_id;
        $data['withdraw_amount'] = $withdraw_amount;
        $this->db->set('approve_date', 'NOW()', FALSE);
        $this->db->set('transaction_datetime', 'NOW()', FALSE);
        if ($agent_type == 1) {
            $this->db->insert('agent_acc_summary', $data);
        } elseif ($agent_type == 2) {
            $this->db->insert('agent_acc_summary', $data);
        } elseif ($agent_type == 3) {
            $this->db->insert('b2b2b_acc_summary', $data);
        }
    }




  public function get_new_crs_hotels($hotel_code,$room_code,$adults, $childs,$room_avail_date)
  { 

    $this->db->select('*');
    $this->db->from('sup_hotel_room_rates');
    $this->db->where("((min_adults_without_extra_bed<=$adults) AND (max_adults_without_extra_bed>=$adults))"); 
    $this->db->where("((min_child_without_extra_bed<=$childs) AND (max_child_without_extra_bed>=$childs))");     
    $this->db->where('hotel_code',$hotel_code); 
    $this->db->where('room_code',$room_code);
    $this->db->where('rooms_available !=', 0);
    $this->db->where('status', 1);
    $this->db->where('room_avail_date',$room_avail_date);  
    $this->db->order_by('room_avail_date', 'ASC');   

    $query = $this->db->get();
    if ($query->num_rows() == '') {
        return array();
    } else {
        
        return $query->result();
    }
   

 }

  public function get_crs_hotels_PRPN($hotel_code,$room_code,$city, $checkin, $checkout, $adults, $childs,$extra_bed_for_adults,$extra_bed_for_child,$room_count,$market) 
   {
      if(empty($extra_bed_for_adults)){
          $extra_bed_for_adults = 0;
          
        }

        if(empty($extra_bed_for_child)){
          $extra_bed_for_child = 0;
        }
        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
       $occupancy= $adults+$childs+$extra_bed_for_adults+$extra_bed_for_child; 
        $this->db->select('a.supplier_hotel_list_id,a.hotel_code,a.hotel_name,a.hotel_star_rating,a.hotel_desc,a.hotel_country,a.address,a.latitude,a.longitude,a.currency_type,a.check_in,a.check_out,a.thumb_img,a.hotel_facilities,t.room_desc,t.room_facilities,t.room_name,t.room_code,t.*,ct.city_name');
        $this->db->from('supplier_hotel_list a');
        $this->db->join("(select hotel_code from supplier_hotel_list s where s.cityid in (select city_id from tbo_hotels_city_list where city_id = '$city') and admin_status='1' and status='1') s", 'a.hotel_code = s.hotel_code');
        $this->db->join("(select d.room_desc,d.room_facilities,d.room_name,e.room_type,d.hotel_room_type,r.sup_room_details_id as room_details_id, r.*
         from supplier_room_list as d JOIN ( select id,room_type from glb_hotel_room_type) as e on e.id = d.hotel_room_type JOIN (select rr.*, c.exclude_market, ra.sup_hotel_room_allotment_id from sup_hotel_room_allotment ra,  sup_hotel_room_rates as rr , sup_contract c where c.contract_id=rr.contract_id AND c.hotel_code=rr.hotel_code AND c.status=1 AND c.status1=1 AND rr.status=1  AND  rr.room_avail_date BETWEEN '" . $checkin . "' AND '" . $checkout . "' and rr.room_avail_date=ra.room_avail_date  and rr.room_code=ra.room_code and (ra.room_allotment_type LIKE 'freesell' OR ra.rooms_available>=ra.total_booking +'$room_count') order by rr.room_rate ASC, rr.adult_rate ASC) as r on r.sup_room_details_id = d.supplier_room_list_id where ((min_adults_without_extra_bed<=$adults) AND (max_adults_without_extra_bed>=$adults)) AND ((min_child_without_extra_bed<=$childs) AND (max_child_without_extra_bed>=$childs) ) AND ((extra_bed_for_adults>=$extra_bed_for_adults) AND (extra_bed_for_child>=$extra_bed_for_child) ) AND ((min_room_occupancy<=$occupancy) AND (max_room_occupancy>=$occupancy))  AND market LIKE '$market' )  t", "a.hotel_code = t.hotel_code AND t.hotel_code IN ($hotel_code) AND t.room_code IN ($room_code)  AND t.rate_type='PRPN'");
        $this->db->join("(select city_id,city_name from tbo_hotels_city_list) ct", 'a.cityid = ct.city_id', 'left');    
        $query = $this->db->get();
      //echo $this->db->last_query();exit;
        if ($query->num_rows()>0)
        {
           return $query->result();
           
        } 
        else 
        {          
            return array();
        }      
      
    }
 public function get_crs_hotels_PPPN($hotel_code,$room_code,$city, $checkin, $checkout, $adults, $childs,$extra_bed_for_adults,$extra_bed_for_child,$room_count,$market) 
   {

        if(empty($extra_bed_for_adults)){
          $extra_bed_for_adults = 0;
          
        }

        if(empty($extra_bed_for_child)){
          $extra_bed_for_child = 0;
        }
        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
        // $occupancy= $adults+$childs; 
         $occupancy= $adults+$childs+$extra_bed_for_adults+$extra_bed_for_child;

        $this->db->select('a.supplier_hotel_list_id,a.hotel_code,a.hotel_name,a.hotel_star_rating,a.hotel_desc,a.hotel_country,a.address,a.latitude,a.longitude,a.currency_type,a.check_in,a.check_out,a.thumb_img,a.hotel_facilities,t.room_desc,t.room_facilities,t.room_name,t.room_code,t.*,ct.city_name');
        $this->db->from('supplier_hotel_list a');
        $this->db->join("(select hotel_code from supplier_hotel_list s where s.cityid in (select city_id from tbo_hotels_city_list where city_id = '$city') and admin_status='1' and status='1') s", 'a.hotel_code = s.hotel_code');
        $this->db->join("(select d.room_desc, d.room_facilities,d.room_name,e.room_type,d.hotel_room_type,r.sup_room_details_id as room_details_id, r.*
         from supplier_room_list as d JOIN ( select id,room_type from glb_hotel_room_type) as e on e.id = d.hotel_room_type JOIN (select rr.*, c.exclude_market, ra.sup_hotel_room_allotment_id from sup_hotel_room_allotment ra,  sup_hotel_room_rates as rr , sup_contract c where c.contract_id=rr.contract_id AND c.hotel_code=rr.hotel_code AND c.status=1 AND c.status1=1 AND rr.status=1  AND  rr.room_avail_date BETWEEN '" . $checkin . "' AND '" . $checkout . "' and rr.room_avail_date=ra.room_avail_date  and rr.room_code=ra.room_code and (ra.room_allotment_type LIKE 'freesell' OR ra.rooms_available>=ra.total_booking +'$room_count') order by rr.room_rate ASC, rr.adult_rate ASC) as r on r.sup_room_details_id = d.supplier_room_list_id where ((min_room_occupancy<=$occupancy) AND (max_room_occupancy>=$occupancy)) AND ((extra_bed_for_adults>=$extra_bed_for_adults) AND (extra_bed_for_child>=$extra_bed_for_child) )  AND market LIKE '$market')  t", "a.hotel_code = t.hotel_code AND t.hotel_code IN ($hotel_code) AND t.room_code IN ($room_code)  AND t.rate_type='PPPN'");
        $this->db->join("(select city_id,city_name from tbo_hotels_city_list) ct", 'a.cityid = ct.city_id', 'left');    
        $query = $this->db->get();
          //echo $this->db->last_query();exit;
        if ($query->num_rows()>0)
        {
           return $query->result();
           
        } 
        else 
        {          
            return array();
        }      
      
    }

  public function gethotelcodes($cityid,$start,$end){
        $this->db->select('hotel_code');
        $this->db->where('cityid',$cityid); 
        $this->db->where('admin_status','1');
        $this->db->where('status','1');
        $this->db->limit($end,$start);
        $this->db->from('supplier_hotel_list');
        $query = $this->db->get();
         //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 0;
        }

    }

      public function getroomcodes($hotel_code,$start,$end){
        $this->db->select('room_code,hotel_code');  
        $this->db->where_in('hotel_code',$hotel_code);      
        $this->db->where('status','1');
        $this->db->limit($end,$start);
        $query=$this->db->from('supplier_room_list')->get();
              // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }

    }
     public function get_hotel_rooms($session_id, $hotelCode) {
        $this->db->select('p.*,t.image,t.total_cost,t.currency_conv_value,t.xml_currency,t.currency,t.search_id,t.cancel_policy,t.session_id,t.room_code,t.room_type,t.room_name,t.adult,t.child,t.adult_extrabed,t.child_extrabed,t.room_count,t.room_runno,t.board_type,t.mandatory_supplement_cost,t.nonmandatory_supplement_cost,t.mandatory_supplement_net_fare,t.nonmandatory_supplement_net_fare,t.mandatory_supplement_discount,t.nonmandatory_supplement_discount,t.nonmandatory_supplement_check,t.mandatory_supplement_meal_plan,t.nonmandatory_supplement_meal_plan,t.conversation_id,t.net_fare,t.discount');
        $this->db->from('hotel_search_result t');
        $this->db->join('supplier_hotel_list p', 't.hotel_code = p.hotel_code');
        //$this->db->join('sup_hotel_room_details d','t.room_code = d.room_code');
        //$this->db->join('glb_hotel_room_type h','d.room_type_id = h.id','left');
        $this->db->where('t.session_id', $session_id);
        $this->db->where('t.hotel_code', $hotelCode);
        $this->db->order_by('t.total_cost', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();
    }

      public function getRoomDetails($api, $sess_id, $hotelCode, $searchId) {
        $this->db->select('a.cancel_policy,a.image,a.admin_markup,a.admin_agent_markup,a.agent_markup,a.di_agent_markup,a.sub_agent_markup,a.payment_charge,a.total_cost,a.api,a.xml_currency,a.currency,a.currency_conv_value,a.search_id,a.session_id, b.*,a.room_type,a.room_code,a.room_name,a.room_description,a.star,a.city_name,c.supplier_no,a.hotel_property_id,a.contractnameVal,a.hotel_supplier_id,a.conversation_id,a.room_details_info,a.rate_plan_code,a.board_type,a.child_age,a.adult,a.child,a.room_runno, a.room_count, a.nights, a.room_amenities,a.adult_extrabed,a.child_extrabed,,a.mandatory_supplement_cost,a.nonmandatory_supplement_cost,a.mandatory_supplement_net_fare,a.nonmandatory_supplement_net_fare,a.mandatory_supplement_discount,a.nonmandatory_supplement_discount,a.nonmandatory_supplement_check,a.mandatory_supplement_meal_plan,a.nonmandatory_supplement_meal_plan,a.crs_mandatory_supplement,a.crs_nonmandatory_supplement,a.hotel_crs_cancellation_json,a.hotel_crs_booking_code,a.hbzoneName,a.discount,a.net_fare,a.org_amt');     
        $this->db->from('hotel_search_result a'); 
        $this->db->join('supplier_hotel_list b', 'a.hotel_code = b.hotel_code', 'left');
        $this->db->join('supplier_info c', 'c.supplier_id = b.supplier_id', 'left');
        //$this->db->join('sup_hotel_room_details d','a.room_code = d.room_code');
        //$this->db->join('glb_hotel_room_type h','d.room_type_id = h.id','left');    
        //$this->db->join('glb_hotel_city_list c', 'b.hotel_city = c.id','left');   
        $this->db->where('b.hotel_code', $hotelCode);
        $this->db->where('a.session_id', $sess_id);
        $this->db->where('a.api', $api);
        $this->db->where('a.search_id', $searchId);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->row();           
        } else {
            return array();
        }
    }

     public function get_merged_rooms($api, $sess_id, $hotelCode, $searchId) {
        // echo '<pre>';print_r($searchId);
        $this->db->select('a.*,b.*');
        $this->db->from('hotel_search_result a');
        $this->db->join('supplier_hotel_list b', 'a.hotel_code = b.hotel_code', 'left');
        $this->db->where('b.hotel_code', $hotelCode);
          //$this->db->where('b.api', $api);
        $this->db->where('a.session_id', $sess_id);
        $this->db->where('a.api', $api);
        $this->db->where('a.search_id', $searchId);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {

            return $query->row();
        } else {
            return array();
        }
    }

    public function get_hotel_room_meal_plan($meal_plan)
     {     
        $this->db->select('meal_plan');
        $this->db->from('glb_hotel_meal_plan');       
        $this->db->where_in('id',$meal_plan);
        $this->db->limit('1');
        $query = $this->db->get(); 
        if ($query->num_rows() > 0)
        {
           return $query->row()->meal_plan;
           
        }
        else
        {
         return array();
        }
    }

  function check($array=NULL,$table_name) 
  {
      $this->db->select()->from($table_name)->where($array);
      $query = $this->db->get();
      if($query->num_rows() > 0)
      {
        return $query->result();
       }
       else
       {
        return array();
       }
    }

    function check_crs_hotels_price($rowarr,$checkIn,$checkout,$rate_type)
    {
       $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
       $this->db->select('*');
       $this->db->from('sup_hotel_room_rates'); 
       $this->db->where('supplier_id',$rowarr['supplier_id']);
       $this->db->where('sup_hotel_id',$rowarr['sup_hotel_id']);   
       $this->db->where('hotel_code',$rowarr['hotel_code']);   
       $this->db->where('room_code',$rowarr['room_code']);   
       $this->db->where('contract_id',$rowarr['contract_id']);   
       $this->db->where('sup_room_details_id',$rowarr['sup_room_details_id']);   
       $this->db->where('room_avail_date BETWEEN "' . $checkIn . '" and "' . $checkout . '"');     
       $this->db->where('market',$rowarr['market']);   
       $this->db->where('meal_plan',$rowarr['meal_plan']);   
       $this->db->where('rate_type',$rate_type); 
       $this->db->where('min_room_occupancy',$rowarr['min_room_occupancy']);   
       $this->db->where('max_room_occupancy',$rowarr['max_room_occupancy']);   
       $this->db->where('min_adults_without_extra_bed',$rowarr['min_adults_without_extra_bed']);   
       $this->db->where('max_adults_without_extra_bed',$rowarr['max_adults_without_extra_bed']);   
       $this->db->where('min_child_without_extra_bed',$rowarr['min_child_without_extra_bed']);   
       $this->db->where('max_child_without_extra_bed',$rowarr['max_child_without_extra_bed']);   
       $this->db->where('extra_bed_for_adults',$rowarr['extra_bed_for_adults']);   
        $this->db->where('extra_bed_for_child',$rowarr['extra_bed_for_child']); 
         $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();  
        }          
         

    function check_crs_hotels_normal_cancel_policy($rowarr,$checkIn)
    {      
       $this->db->select('days_before_checkin,per_rate_charge,cancel_rates_type');
       $this->db->from('sup_hotel_room_cancellation_rates'); 
       $this->db->where('supplier_id',$rowarr['supplier_id']);
       $this->db->where('sup_hotel_id',$rowarr['sup_hotel_id']);   
       $this->db->where('hotel_code',$rowarr['hotel_code']);   
       $this->db->where('room_code',$rowarr['room_code']);   
       $this->db->where('contract_id',$rowarr['contract_id']);   
       $this->db->where('sup_room_details_id',$rowarr['sup_room_details_id']);   
       $this->db->where('room_avail_date', $checkIn);     
       $this->db->where('market',$rowarr['market']);   
       $this->db->where('meal_plan',$rowarr['meal_plan']);   
       $this->db->where('rate_type',$rowarr['rate_type']); 
       $this->db->where('min_room_occupancy',$rowarr['min_room_occupancy']);   
       $this->db->where('max_room_occupancy',$rowarr['max_room_occupancy']);   
       $this->db->where('min_adults_without_extra_bed',$rowarr['min_adults_without_extra_bed']);   
       $this->db->where('max_adults_without_extra_bed',$rowarr['max_adults_without_extra_bed']);   
       $this->db->where('min_child_without_extra_bed',$rowarr['min_child_without_extra_bed']);   
       $this->db->where('max_child_without_extra_bed',$rowarr['max_child_without_extra_bed']);   
       $this->db->where('extra_bed_for_adults',$rowarr['extra_bed_for_adults']);   
        $this->db->where('extra_bed_for_child',$rowarr['extra_bed_for_child']); 
         $query = $this->db->get();
         // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();  
        }          

function check_crs_hotels_room_allotment($id)
    {
       $this->db->select('*');
       $this->db->from('sup_hotel_room_allotment'); 
       $this->db->where('sup_hotel_room_allotment_id',$id);
       $this->db->where('rooms_available !=',0);
       $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            return array();  
        } 
      }
  function update_crs_hotels_room_allotment($id,$total_booking)
    {
        $this->db->set('total_booking', '`total_booking` + '.$total_booking, FALSE);
        $this->db->where('sup_hotel_room_allotment_id',$id);
        $this->db->where('sup_hotel_room_allotment_id',$id);       
        $this->db->update('sup_hotel_room_allotment');
    }   

  function update_crs_hotels_room_total_cost($searchId,$sessionId,$hotelCode,$total_cost)
    {
        $data=array('total_cost'=>$total_cost);
        $this->db->where('search_id',$searchId);
        $this->db->where('session_id',$sessionId);
        $this->db->where('hotel_code',$hotelCode);
        $this->db->update('hotel_search_result',$data);
    }

   function update_crs_hotels_room_net_fare($searchId,$sessionId,$hotelCode,$net_fare)
    {
        $data=array('net_fare'=>$net_fare);
        $this->db->where('search_id',$searchId);
        $this->db->where('session_id',$sessionId);
        $this->db->where('hotel_code',$hotelCode);
        $this->db->update('hotel_search_result',$data);
    }

   function update_crs_hotels_room_discount($searchId,$sessionId,$hotelCode,$discount)
    {
        $data=array('discount'=>$discount);
        $this->db->where('search_id',$searchId);
        $this->db->where('session_id',$sessionId);
        $this->db->where('hotel_code',$hotelCode);
        $this->db->update('hotel_search_result',$data);
    }

     function get_last_booking_code() {
        $this->db->select('b.booking_id');
        $this->db->from('(select booking_id from sup_hotel_booking order by booking_id DESC) as b');
        $this->db->limit(1);
      //  $this->db->group_by('b.booking_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->booking_id;
        } else {
            return self::CODE_START;
        }
    }


     public function get_crs_hotels_PRPN_early_bird($hotel_code,$room_code,$city, $checkin, $checkout, $adults, $childs,$extra_bed_for_adults,$extra_bed_for_child,$room_count,$market) 
   {              
      if(empty($extra_bed_for_adults)){
          $extra_bed_for_adults = 0;
          
        }

        if(empty($extra_bed_for_child)){
          $extra_bed_for_child = 0;
        }
        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
        $today=date("Y-m-d");
        $prior_checkin=floor((strtotime($checkin) - strtotime($today)) / (60 * 60 * 24));
       $occupancy= $adults+$childs+$extra_bed_for_adults+$extra_bed_for_child; 
        $this->db->select('a.supplier_hotel_list_id,a.hotel_code,a.hotel_name,a.hotel_star_rating,a.hotel_desc,a.hotel_country,a.address,a.latitude,a.longitude,a.currency_type,a.check_in,a.check_out,a.thumb_img,a.hotel_facilities,t.room_desc,t.room_facilities,t.room_name,t.room_code,t.*,ct.city_name');
        $this->db->from('supplier_hotel_list a');
        $this->db->join("(select hotel_code from supplier_hotel_list s where s.cityid in (select city_id from tbo_hotels_city_list where city_id = '$city') and admin_status='1' and status='1') s", 'a.hotel_code = s.hotel_code');
        $this->db->join("(select d.room_desc,d.room_facilities,d.room_name,e.room_type,d.hotel_room_type,r.sup_room_details_id as room_details_id, r.*
         from supplier_room_list as d JOIN ( select id,room_type from glb_hotel_room_type) as e on e.id = d.hotel_room_type JOIN (select rr.*, c.exclude_market, ra.sup_hotel_room_allotment_id from sup_hotel_room_allotment ra,  sup_specialoffer_hotel_room_rates as rr , sup_contract c where c.contract_id=rr.contract_id AND c.hotel_code=rr.hotel_code AND c.status=1 AND c.status1=1 AND rr.status=1  AND  rr.room_avail_date BETWEEN '" . $checkin . "' AND '" . $checkout . "' and rr.room_avail_date=ra.room_avail_date  and rr.room_code=ra.room_code and (ra.room_allotment_type LIKE 'freesell' OR ra.rooms_available>=ra.total_booking +'$room_count') order by rr.room_rate ASC, rr.adult_rate ASC) as r on r.sup_room_details_id = d.supplier_room_list_id where ((min_adults_without_extra_bed<=$adults) AND (max_adults_without_extra_bed>=$adults)) AND ((min_child_without_extra_bed<=$childs) AND (max_child_without_extra_bed>=$childs) ) AND ((extra_bed_for_adults>=$extra_bed_for_adults) AND (extra_bed_for_child>=$extra_bed_for_child) ) AND ((prior_checkin<=$prior_checkin AND prior_checkin IS NOT NULL) OR (prior_checkin_date<='$checkin' AND CAST(prior_checkin_date AS CHAR(10)) != '0000-00-00') OR (period_from_date<='$checkin' AND period_to_date>='$checkin')) AND ((min_room_occupancy<=$occupancy) AND (max_room_occupancy>=$occupancy))  AND specialoffer_type LIKE 'Early bird'  AND market LIKE '$market' )  t", "a.hotel_code = t.hotel_code AND t.hotel_code IN ($hotel_code) AND t.room_code IN ($room_code)  AND t.rate_type='PRPN'");
        $this->db->join("(select city_id,city_name from tbo_hotels_city_list) ct", 'a.cityid = ct.city_id', 'left');    
        $query = $this->db->get();
           /// echo $this->db->last_query();exit;
        if ($query->num_rows()>0)
        {
           return $query->result();
           
        } 
        else 
        {          
            return array();
        }      
      
    }

    public function get_crs_hotels_PPPN_early_bird($hotel_code,$room_code,$city, $checkin, $checkout, $adults, $childs,$extra_bed_for_adults,$extra_bed_for_child,$room_count,$market) 
   {

        if(empty($extra_bed_for_adults)){
          $extra_bed_for_adults = 0;
          
        }

        if(empty($extra_bed_for_child)){
          $extra_bed_for_child = 0;
        }
        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
        $today=date("Y-m-d");
        $prior_checkin=floor((strtotime($checkin) - strtotime($today)) / (60 * 60 * 24)); 
        // $occupancy= $adults+$childs; 
         $occupancy= $adults+$childs+$extra_bed_for_adults+$extra_bed_for_child;       
        $this->db->select('a.supplier_hotel_list_id,a.hotel_code,a.hotel_name,a.hotel_star_rating,a.hotel_desc,a.hotel_country,a.address,a.latitude,a.longitude,a.currency_type,a.check_in,a.check_out,a.thumb_img,a.hotel_facilities,t.room_desc,t.room_facilities,t.room_name,t.room_code,t.*,ct.city_name');
        $this->db->from('supplier_hotel_list a');
        $this->db->join("(select hotel_code from supplier_hotel_list s where s.cityid in (select city_id from tbo_hotels_city_list where city_id = '$city') and admin_status='1' and status='1') s", 'a.hotel_code = s.hotel_code');
        $this->db->join("(select d.room_desc, d.room_facilities,d.room_name,e.room_type,d.hotel_room_type,r.sup_room_details_id as room_details_id, r.*
         from supplier_room_list as d JOIN ( select id,room_type from glb_hotel_room_type) as e on e.id = d.hotel_room_type JOIN (select rr.*, c.exclude_market, ra.sup_hotel_room_allotment_id from sup_hotel_room_allotment ra,  sup_specialoffer_hotel_room_rates as rr , sup_contract c where c.contract_id=rr.contract_id AND c.hotel_code=rr.hotel_code AND c.status=1 AND c.status1=1 AND rr.status=1  AND  rr.room_avail_date BETWEEN '" . $checkin . "' AND '" . $checkout . "' and rr.room_avail_date=ra.room_avail_date  and rr.room_code=ra.room_code and (ra.room_allotment_type LIKE 'freesell' OR ra.rooms_available>=ra.total_booking +'$room_count') order by rr.room_rate ASC, rr.adult_rate ASC) as r on r.sup_room_details_id = d.supplier_room_list_id where  ((extra_bed_for_adults>=$extra_bed_for_adults) AND (extra_bed_for_child>=$extra_bed_for_child) ) AND ((prior_checkin<=$prior_checkin AND prior_checkin IS NOT NULL) OR (prior_checkin_date<='$checkin' AND CAST(prior_checkin_date AS CHAR(10)) != '0000-00-00') OR (period_from_date<='$checkin' AND period_to_date>='$checkin')) AND ((min_room_occupancy<=$occupancy) AND (max_room_occupancy>=$occupancy)) AND specialoffer_type LIKE 'Early bird'  AND market LIKE '$market')  t", "a.hotel_code = t.hotel_code AND t.hotel_code IN ($hotel_code) AND t.room_code IN ($room_code)  AND t.rate_type='PPPN'");
        $this->db->join("(select city_id,city_name from tbo_hotels_city_list) ct", 'a.cityid = ct.city_id', 'left');    
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows()>0)
        {
           return $query->result();
           
        } 
        else 
        {          
            return array();
        }      
      
    }

      function check_specialoffer_crs_hotels_normal_cancel_policy($rowarr,$checkIn)
    {      
       $this->db->select('days_before_checkin,per_rate_charge,cancel_rates_type');
       $this->db->from('sup_specialoffer_hotel_room_cancellation_rates'); 
       $this->db->where('supplier_id',$rowarr['supplier_id']);
       $this->db->where('sup_hotel_id',$rowarr['sup_hotel_id']);   
       $this->db->where('hotel_code',$rowarr['hotel_code']);   
       $this->db->where('room_code',$rowarr['room_code']);   
       $this->db->where('contract_id',$rowarr['contract_id']);   
       $this->db->where('sup_room_details_id',$rowarr['sup_room_details_id']);   
       $this->db->where('room_avail_date', $checkIn);     
       $this->db->where('market',$rowarr['market']);   
       $this->db->where('meal_plan',$rowarr['meal_plan']);
       $this->db->where('specialoffer_id',$rowarr['specialoffer_id']);   
       $this->db->where('specialoffer_type',$rowarr['specialoffer_type']); 
       $this->db->where('rate_type',$rowarr['rate_type']); 
       $this->db->where('min_room_occupancy',$rowarr['min_room_occupancy']);   
       $this->db->where('max_room_occupancy',$rowarr['max_room_occupancy']);   
       $this->db->where('min_adults_without_extra_bed',$rowarr['min_adults_without_extra_bed']);   
       $this->db->where('max_adults_without_extra_bed',$rowarr['max_adults_without_extra_bed']);   
       $this->db->where('min_child_without_extra_bed',$rowarr['min_child_without_extra_bed']);   
       $this->db->where('max_child_without_extra_bed',$rowarr['max_child_without_extra_bed']);   
       $this->db->where('extra_bed_for_adults',$rowarr['extra_bed_for_adults']);   
        $this->db->where('extra_bed_for_child',$rowarr['extra_bed_for_child']); 
         $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();  
        } 




  function check_crs_hotels_price_early_bird($rowarr,$checkIn,$checkout,$rate_type)
    {
       $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
       $this->db->select('*');
       $this->db->from('sup_specialoffer_hotel_room_rates'); 
       $this->db->where('supplier_id',$rowarr['supplier_id']);
       $this->db->where('sup_hotel_id',$rowarr['sup_hotel_id']);   
       $this->db->where('hotel_code',$rowarr['hotel_code']);   
       $this->db->where('room_code',$rowarr['room_code']);   
       $this->db->where('contract_id',$rowarr['contract_id']);   
       $this->db->where('sup_room_details_id',$rowarr['sup_room_details_id']);   
       $this->db->where('room_avail_date BETWEEN "' . $checkIn . '" and "' . $checkout . '"'); 
       $this->db->where('specialoffer_id',$rowarr['specialoffer_id']);   
       $this->db->where('specialoffer_type',$rowarr['specialoffer_type']);  

       $this->db->where('market',$rowarr['market']);   
       $this->db->where('meal_plan',$rowarr['meal_plan']);   
       $this->db->where('rate_type',$rate_type); 
       $this->db->where('min_room_occupancy',$rowarr['min_room_occupancy']);   
       $this->db->where('max_room_occupancy',$rowarr['max_room_occupancy']);   
       $this->db->where('min_adults_without_extra_bed',$rowarr['min_adults_without_extra_bed']);   
       $this->db->where('max_adults_without_extra_bed',$rowarr['max_adults_without_extra_bed']);   
       $this->db->where('min_child_without_extra_bed',$rowarr['min_child_without_extra_bed']);   
        $this->db->where('max_child_without_extra_bed',$rowarr['max_child_without_extra_bed']);   
        $this->db->where('extra_bed_for_adults',$rowarr['extra_bed_for_adults']);   
        $this->db->where('extra_bed_for_child',$rowarr['extra_bed_for_child']); 
        $this->db->where('discount_rate_type',$rowarr['discount_rate_type']); 
        $this->db->where('prior_day_type',$rowarr['prior_day_type']); 
        $this->db->where('prior_checkin',$rowarr['prior_checkin']); 
        $this->db->where('prior_checkin_date',$rowarr['prior_checkin_date']); 
        $this->db->where('period_from_date',$rowarr['period_from_date']); 
        $this->db->where('period_to_date',$rowarr['period_to_date']); 
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();  
        }          
         

  public function get_crs_hotels_PRPN_stay_pay($hotel_code,$room_code,$city, $checkin, $checkout, $adults, $childs,$extra_bed_for_adults,$extra_bed_for_child,$nights,$room_count,$market) 
   {              

        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
        $today=date("Y-m-d");
        $prior_checkin=floor((strtotime($checkin) - strtotime($today)) / (60 * 60 * 24));
        $occupancy= $adults+$childs+$extra_bed_for_adults+$extra_bed_for_child; 

        if(empty($extra_bed_for_adults)){
          $extra_bed_for_adults = 0;

        }

        if(empty($extra_bed_for_child)){
          $extra_bed_for_child = 0;
        }


     

        $this->db->select('a.supplier_hotel_list_id,a.hotel_code,a.hotel_name,a.hotel_star_rating,a.hotel_desc,a.hotel_country,a.address,a.latitude,a.longitude,a.currency_type,a.check_in,a.check_out,a.thumb_img,a.hotel_facilities,t.room_desc,t.room_facilities,t.room_name,t.room_code,t.*,ct.city_name');
        $this->db->from('supplier_hotel_list a');
        $this->db->join("(select hotel_code from supplier_hotel_list s where s.cityid in (select city_id from tbo_hotels_city_list where city_id = '$city') and admin_status='1' and status='1') s", 'a.hotel_code = s.hotel_code');
        $this->db->join("(select d.room_desc,d.room_facilities,d.room_name,e.room_type,d.hotel_room_type,r.sup_room_details_id as room_details_id, r.*
         from supplier_room_list as d JOIN ( select id,room_type from glb_hotel_room_type) as e on e.id = d.hotel_room_type JOIN (select rr.*, c.exclude_market, ra.sup_hotel_room_allotment_id from sup_hotel_room_allotment ra,  sup_specialoffer_hotel_room_rates as rr, sup_contract c where c.contract_id=rr.contract_id AND c.hotel_code=rr.hotel_code AND c.status=1 AND c.status1=1 AND rr.status=1  AND rr.room_avail_date BETWEEN '" . $checkin . "' AND '" . $checkout . "' and rr.room_avail_date=ra.room_avail_date  and rr.room_code=ra.room_code and (ra.room_allotment_type LIKE 'freesell' OR ra.rooms_available>=ra.total_booking +'$room_count') order by rr.room_rate ASC, rr.adult_rate ASC) as r on r.sup_room_details_id = d.supplier_room_list_id where ((min_adults_without_extra_bed<=$adults) AND (max_adults_without_extra_bed>=$adults)) AND ((min_child_without_extra_bed<=$childs) AND (max_child_without_extra_bed>=$childs) ) AND ((extra_bed_for_adults>=$extra_bed_for_adults) AND (extra_bed_for_child>=$extra_bed_for_child) ) AND ((prior_checkin<=$prior_checkin AND prior_checkin IS NOT NULL) OR (prior_checkin_date<='$checkin' AND CAST(prior_checkin_date AS CHAR(10)) != '0000-00-00') OR (period_from_date<='$checkin' AND period_to_date>='$checkin')) AND ((min_room_occupancy<=$occupancy) AND (max_room_occupancy>=$occupancy))  AND ((min_no_of_stay_day<=$nights) AND (max_no_of_stay_day>=$nights))  AND specialoffer_type LIKE 'Stay Pay' AND market LIKE '$market' )  t", "a.hotel_code = t.hotel_code AND t.hotel_code IN ($hotel_code) AND t.room_code IN ($room_code)  AND t.rate_type='PRPN'");
        $this->db->join("(select city_id,city_name from tbo_hotels_city_list) ct", 'a.cityid = ct.city_id', 'left');    
        $query = $this->db->get();
           // echo $this->db->last_query();exit;
        if ($query->num_rows()>0)
        {
           return $query->result();
           
        } 
        else 
        {          
            return array();
        }      
      
    }

    public function get_crs_hotels_PPPN_stay_pay($hotel_code,$room_code,$city, $checkin, $checkout, $adults, $childs,$extra_bed_for_adults,$extra_bed_for_child, $nights,$room_count,$market) 
   {
        if(empty($extra_bed_for_adults)){
          $extra_bed_for_adults = 0;
          
        }

        if(empty($extra_bed_for_child)){
          $extra_bed_for_child = 0;
        }
        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
        $today=date("Y-m-d");
        $prior_checkin=floor((strtotime($checkin) - strtotime($today)) / (60 * 60 * 24)); 
        // $occupancy= $adults+$childs; 
         $occupancy= $adults+$childs+$extra_bed_for_adults+$extra_bed_for_child;
        $this->db->select('a.supplier_hotel_list_id,a.hotel_code,a.hotel_name,a.hotel_star_rating,a.hotel_desc,a.hotel_country,a.address,a.latitude,a.longitude,a.currency_type,a.check_in,a.check_out,a.thumb_img,a.hotel_facilities,t.room_desc,t.room_facilities,t.room_name,t.room_code,t.*,ct.city_name');
        $this->db->from('supplier_hotel_list a');
        $this->db->join("(select hotel_code from supplier_hotel_list s where s.cityid in (select city_id from tbo_hotels_city_list where city_id = '$city') and admin_status='1' and status='1') s", 'a.hotel_code = s.hotel_code');
        $this->db->join("(select d.room_desc, d.room_facilities,d.room_name,e.room_type,d.hotel_room_type,r.sup_room_details_id as room_details_id, r.*
         from supplier_room_list as d JOIN ( select id,room_type from glb_hotel_room_type) as e on e.id = d.hotel_room_type JOIN (select rr.*, c.exclude_market, ra.sup_hotel_room_allotment_id from sup_hotel_room_allotment ra,  sup_specialoffer_hotel_room_rates as rr , sup_contract c where c.contract_id=rr.contract_id AND c.hotel_code=rr.hotel_code AND c.status=1 AND c.status1=1 AND rr.status=1  AND  rr.room_avail_date BETWEEN '" . $checkin . "' AND '" . $checkout . "' and rr.room_avail_date=ra.room_avail_date  and rr.room_code=ra.room_code and (ra.room_allotment_type LIKE 'freesell' OR ra.rooms_available>=ra.total_booking +'$room_count') order by rr.room_rate ASC, rr.adult_rate ASC) as r on r.sup_room_details_id = d.supplier_room_list_id where  ((extra_bed_for_adults>=$extra_bed_for_adults) AND (extra_bed_for_child>=$extra_bed_for_child) ) AND ((prior_checkin<=$prior_checkin AND prior_checkin IS NOT NULL) OR (prior_checkin_date<='$checkin' AND CAST(prior_checkin_date AS CHAR(10)) != '0000-00-00') OR (period_from_date<='$checkin' AND period_to_date>='$checkin')) AND ((min_room_occupancy<=$occupancy) AND (max_room_occupancy>=$occupancy))  AND ((min_no_of_stay_day<=$nights) AND (max_no_of_stay_day>=$nights)) AND specialoffer_type LIKE 'Stay Pay' AND market LIKE '$market')  t", "a.hotel_code = t.hotel_code AND t.hotel_code IN ($hotel_code) AND t.room_code IN ($room_code)  AND t.rate_type='PPPN'");
        $this->db->join("(select city_id,city_name from tbo_hotels_city_list) ct", 'a.cityid = ct.city_id', 'left');    
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows()>0)
        {
           return $query->result();
           
        } 
        else 
        {          
            return array();
        }      
      
    }

    public function get_crs_hotels_PRPN_discount($hotel_code,$room_code,$city, $checkin, $checkout, $adults, $childs,$extra_bed_for_adults,$extra_bed_for_child,$nights,$room_count,$market) 
   {              
      if(empty($extra_bed_for_adults)){
          $extra_bed_for_adults = 0;
          
        }

        if(empty($extra_bed_for_child)){
          $extra_bed_for_child = 0;
        }
        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
        $today=date("Y-m-d");
        $prior_checkin=floor((strtotime($checkin) - strtotime($today)) / (60 * 60 * 24));
       $occupancy= $adults+$childs+$extra_bed_for_adults+$extra_bed_for_child; 

     

        $this->db->select('a.supplier_hotel_list_id,a.hotel_code,a.hotel_name,a.hotel_star_rating,a.hotel_desc,a.hotel_country,a.address,a.latitude,a.longitude,a.currency_type,a.check_in,a.check_out,a.thumb_img,a.hotel_facilities,t.room_desc,t.room_facilities,t.room_name,t.room_code,t.*,ct.city_name');
        $this->db->from('supplier_hotel_list a');
        $this->db->join("(select hotel_code from supplier_hotel_list s where s.cityid in (select city_id from tbo_hotels_city_list where city_id = '$city') and admin_status='1' and status='1') s", 'a.hotel_code = s.hotel_code');
        $this->db->join("(select d.room_desc,d.room_facilities,d.room_name,e.room_type,d.hotel_room_type,r.sup_room_details_id as room_details_id, r.*
         from supplier_room_list as d JOIN ( select id,room_type from glb_hotel_room_type) as e on e.id = d.hotel_room_type JOIN (select rr.*, c.exclude_market, ra.sup_hotel_room_allotment_id from sup_hotel_room_allotment ra,  sup_specialoffer_hotel_room_rates as rr, sup_contract c where c.contract_id=rr.contract_id AND c.hotel_code=rr.hotel_code AND c.status=1 AND c.status1=1 AND rr.status=1  AND rr.room_avail_date BETWEEN '" . $checkin . "' AND '" . $checkout . "' and rr.room_avail_date=ra.room_avail_date  and rr.room_code=ra.room_code and (ra.room_allotment_type LIKE 'freesell' OR ra.rooms_available>=ra.total_booking +'$room_count') order by rr.room_rate ASC, rr.adult_rate ASC) as r on r.sup_room_details_id = d.supplier_room_list_id where ((min_adults_without_extra_bed<=$adults) AND (max_adults_without_extra_bed>=$adults)) AND ((min_child_without_extra_bed<=$childs) AND (max_child_without_extra_bed>=$childs) ) AND ((extra_bed_for_adults>=$extra_bed_for_adults) AND (extra_bed_for_child>=$extra_bed_for_child) )  AND ((min_room_occupancy<=$occupancy) AND (max_room_occupancy>=$occupancy))  AND ((min_no_of_stay_day<=$nights) AND (max_no_of_stay_day>=$nights))  AND specialoffer_type LIKE 'Discount' AND market LIKE '$market' )  t", "a.hotel_code = t.hotel_code AND t.hotel_code IN ($hotel_code) AND t.room_code IN ($room_code)  AND t.rate_type='PRPN'");
        $this->db->join("(select city_id,city_name from tbo_hotels_city_list) ct", 'a.cityid = ct.city_id', 'left');    
        $query = $this->db->get();
            // echo $this->db->last_query();exit;
        if ($query->num_rows()>0)
        {
           return $query->result();
           
        } 
        else 
        {          
            return array();
        }      
      
    }

    public function get_crs_hotels_PPPN_discount($hotel_code,$room_code,$city, $checkin, $checkout, $adults, $childs,$extra_bed_for_adults,$extra_bed_for_child, $nights,$room_count,$market) 
   {
        if(empty($extra_bed_for_adults)){
          $extra_bed_for_adults = 0;
          
        }

        if(empty($extra_bed_for_child)){
          $extra_bed_for_child = 0;
        }
        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
        $today=date("Y-m-d");
        $prior_checkin=floor((strtotime($checkin) - strtotime($today)) / (60 * 60 * 24)); 
        // $occupancy= $adults+$childs; 
         $occupancy= $adults+$childs+$extra_bed_for_adults+$extra_bed_for_child;
        $this->db->select('a.supplier_hotel_list_id,a.hotel_code,a.hotel_name,a.hotel_star_rating,a.hotel_desc,a.hotel_country,a.address,a.latitude,a.longitude,a.currency_type,a.check_in,a.check_out,a.thumb_img,a.hotel_facilities,t.room_desc,t.room_facilities,t.room_name,t.room_code,t.*,ct.city_name');
        $this->db->from('supplier_hotel_list a');
        $this->db->join("(select hotel_code from supplier_hotel_list s where s.cityid in (select city_id from tbo_hotels_city_list where city_id = '$city') and admin_status='1' and status='1') s", 'a.hotel_code = s.hotel_code');
        $this->db->join("(select d.room_desc, d.room_facilities,d.room_name,e.room_type,d.hotel_room_type,r.sup_room_details_id as room_details_id, r.*
         from supplier_room_list as d JOIN ( select id,room_type from glb_hotel_room_type) as e on e.id = d.hotel_room_type JOIN (select rr.*, c.exclude_market, ra.sup_hotel_room_allotment_id from sup_hotel_room_allotment ra,  sup_specialoffer_hotel_room_rates as rr , sup_contract c where c.contract_id=rr.contract_id AND c.hotel_code=rr.hotel_code AND c.status=1 AND c.status1=1 AND rr.status=1  AND  rr.room_avail_date BETWEEN '" . $checkin . "' AND '" . $checkout . "' and rr.room_avail_date=ra.room_avail_date  and rr.room_code=ra.room_code and (ra.room_allotment_type LIKE 'freesell' OR ra.rooms_available>=ra.total_booking +'$room_count') order by rr.room_rate ASC, rr.adult_rate ASC) as r on r.sup_room_details_id = d.supplier_room_list_id where  ((extra_bed_for_adults>=$extra_bed_for_adults) AND (extra_bed_for_child>=$extra_bed_for_child) )  AND ((min_room_occupancy<=$occupancy) AND (max_room_occupancy>=$occupancy))  AND ((min_no_of_stay_day<=$nights) AND (max_no_of_stay_day>=$nights)) AND specialoffer_type LIKE 'Discount' AND market LIKE '$market')  t", "a.hotel_code = t.hotel_code AND t.hotel_code IN ($hotel_code) AND t.room_code IN ($room_code)  AND t.rate_type='PPPN'");
        $this->db->join("(select city_id,city_name from tbo_hotels_city_list) ct", 'a.cityid = ct.city_id', 'left');    
        $query = $this->db->get();
          // echo $this->db->last_query();exit;
        if ($query->num_rows()>0)
        {
           return $query->result();
           
        } 
        else 
        {          
            return array();
        }      
      
    }

     function check_crs_hotels_price_stay_pay($rowarr,$checkIn,$checkout,$rate_type)
    {
       $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
       $this->db->select('*');
       $this->db->from('sup_specialoffer_hotel_room_rates'); 
       $this->db->where('supplier_id',$rowarr['supplier_id']);
       $this->db->where('sup_hotel_id',$rowarr['sup_hotel_id']);   
       $this->db->where('hotel_code',$rowarr['hotel_code']);   
       $this->db->where('room_code',$rowarr['room_code']);   
       $this->db->where('contract_id',$rowarr['contract_id']);   
       $this->db->where('sup_room_details_id',$rowarr['sup_room_details_id']);   
       $this->db->where('room_avail_date BETWEEN "' . $checkIn . '" and "' . $checkout . '"'); 
       $this->db->where('specialoffer_id',$rowarr['specialoffer_id']);   
       $this->db->where('specialoffer_type',$rowarr['specialoffer_type']);  

       $this->db->where('market',$rowarr['market']);   
       $this->db->where('meal_plan',$rowarr['meal_plan']);   
       $this->db->where('rate_type',$rate_type); 
       $this->db->where('min_room_occupancy',$rowarr['min_room_occupancy']);   
       $this->db->where('max_room_occupancy',$rowarr['max_room_occupancy']);   
       $this->db->where('min_adults_without_extra_bed',$rowarr['min_adults_without_extra_bed']);   
       $this->db->where('max_adults_without_extra_bed',$rowarr['max_adults_without_extra_bed']);   
       $this->db->where('min_child_without_extra_bed',$rowarr['min_child_without_extra_bed']);   
        $this->db->where('max_child_without_extra_bed',$rowarr['max_child_without_extra_bed']);   
        $this->db->where('extra_bed_for_adults',$rowarr['extra_bed_for_adults']);   
        $this->db->where('extra_bed_for_child',$rowarr['extra_bed_for_child']); 
        $this->db->where('min_no_of_stay_day',$rowarr['min_no_of_stay_day']); 
        $this->db->where('max_no_of_stay_day',$rowarr['max_no_of_stay_day']); 
        $this->db->where('no_of_stay_free_nights',$rowarr['no_of_stay_free_nights']); 
        $this->db->where('prior_day_type',$rowarr['prior_day_type']); 
        $this->db->where('prior_checkin',$rowarr['prior_checkin']); 
        $this->db->where('prior_checkin_date',$rowarr['prior_checkin_date']); 
        $this->db->where('period_from_date',$rowarr['period_from_date']); 
        $this->db->where('period_to_date',$rowarr['period_to_date']); 
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();  
        }     

  function check_crs_hotels_price_discount($rowarr,$checkIn,$checkout,$rate_type)
    {
       $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
       $this->db->select('*');
       $this->db->from('sup_specialoffer_hotel_room_rates'); 
       $this->db->where('supplier_id',$rowarr['supplier_id']);
       $this->db->where('sup_hotel_id',$rowarr['sup_hotel_id']);   
       $this->db->where('hotel_code',$rowarr['hotel_code']);   
       $this->db->where('room_code',$rowarr['room_code']);   
       $this->db->where('contract_id',$rowarr['contract_id']);   
       $this->db->where('sup_room_details_id',$rowarr['sup_room_details_id']);   
       $this->db->where('room_avail_date BETWEEN "' . $checkIn . '" and "' . $checkout . '"'); 
       $this->db->where('specialoffer_id',$rowarr['specialoffer_id']);   
       $this->db->where('specialoffer_type',$rowarr['specialoffer_type']);  

       $this->db->where('market',$rowarr['market']);   
       $this->db->where('meal_plan',$rowarr['meal_plan']);   
       $this->db->where('rate_type',$rate_type); 
       $this->db->where('min_room_occupancy',$rowarr['min_room_occupancy']);   
       $this->db->where('max_room_occupancy',$rowarr['max_room_occupancy']);   
       $this->db->where('min_adults_without_extra_bed',$rowarr['min_adults_without_extra_bed']);   
       $this->db->where('max_adults_without_extra_bed',$rowarr['max_adults_without_extra_bed']);   
       $this->db->where('min_child_without_extra_bed',$rowarr['min_child_without_extra_bed']);   
        $this->db->where('max_child_without_extra_bed',$rowarr['max_child_without_extra_bed']);   
        $this->db->where('extra_bed_for_adults',$rowarr['extra_bed_for_adults']);   
        $this->db->where('extra_bed_for_child',$rowarr['extra_bed_for_child']); 
        $this->db->where('min_no_of_stay_day',$rowarr['min_no_of_stay_day']); 
        $this->db->where('max_no_of_stay_day',$rowarr['max_no_of_stay_day']); 
        $this->db->where('no_of_stay_free_nights',$rowarr['no_of_stay_free_nights']); 
        $this->db->where('prior_day_type',$rowarr['prior_day_type']); 
        $this->db->where('prior_checkin',$rowarr['prior_checkin']); 
        $this->db->where('prior_checkin_date',$rowarr['prior_checkin_date']); 
        $this->db->where('period_from_date',$rowarr['period_from_date']); 
        $this->db->where('period_to_date',$rowarr['period_to_date']); 
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();  
        }    
             

   function check_hotel_room_search($api,$sess_id,$hotel_code,$room_code,$room_runno)
  {
          $this->db->select('*');
          $this->db->from('hotel_search_result'); 
          $this->db->where('session_id', $sess_id);
          $this->db->where('api', $api);
          $this->db->where('hotel_code', $hotel_code);
          $this->db->where('room_code', $room_code);
          $this->db->where('room_runno', $room_runno);
           $query = $this->db->get();
            // echo $this->db->last_query();exit;
          if ($query->num_rows() > 0)
          {
              return $query->result();
          }
          else
          {
              return array();  
          }
        
  }

  function check_crs_hotels_normal_supplements_rates($rowarr,$supplement_roomrate_type,$supplement_compulsory)
  {  
     
      $this->db->select('*');
      $this->db->from('sup_hotel_room_supplement_rates'); 
      $this->db->where('supplier_id',$rowarr['supplier_id']);       
      $this->db->where('hotel_code',$rowarr['hotel_code']);   
      $this->db->where('room_code',$rowarr['room_code']);   
      $this->db->where('contract_id',$rowarr['contract_id']); 
      $this->db->where('market',$rowarr['market']);   
      $this->db->where('meal_plan',$rowarr['meal_plan']); 
      $this->db->where('avail_date',$rowarr['avail_date']);
      $this->db->where('supplement_roomrate_type',$supplement_roomrate_type); 
      $this->db->where('supplement_compulsory',$supplement_compulsory); 
      $this->db->where('status',1);
      $query = $this->db->get();
       // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();  
  }




// function getCountries() {
//         $this->db->select('name');
//         $this->db->from('country');
//         $query = $this->db->get();
//         if ($query->num_rows > 0) {
//             return $query->result();
//         } else {
//             return '';
//         }
//     }
    public function get_country_name($code) {
        $this->db->select('name as country_name');
        $this->db->from('country');
        $this->db->where('iso2',$code);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return array();
   } else {
            return $query->row();
        }
    }

     public function update_nonmandatory_supplement_check($api, $sess_id, $hotelCode, $searchId,$nonmandatory_supplement_check) {     
      $data=array('nonmandatory_supplement_check'=>$nonmandatory_supplement_check);
        $this->db->where('hotel_code', $hotelCode);      
        $this->db->where('session_id', $sess_id);
        $this->db->where('api', $api);
        $this->db->where('search_id', $searchId);
        $this->db->update('hotel_search_result',$data);

       
    }


     public function getsearchhotelcodes($session_id, $api) {
        $this->db->select('hotel_code');
        $this->db->from('hotel_search_result');     
        $this->db->where('session_id', $session_id);
        $this->db->where('api', $api);
        $this->db->group_by('hotel_code');
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();
    }

      function check_hotel_search($api,$sess_id,$hotel_code,$room_runno)
      {
          $this->db->select('*');
          $this->db->from('hotel_search_result'); 
          $this->db->where('session_id', $sess_id);
          $this->db->where('api', $api);
          $this->db->where('hotel_code', $hotel_code);          
          $this->db->where('room_runno', $room_runno);
           $query = $this->db->get();
          if ($query->num_rows() > 0)
          {
              return $query->result();
          }
          else
          {
              return array();  
          }
        
    }

      public function delete_hotel_results($api,$sess_id,$hotel_code) {
        $this->db->where('session_id', $sess_id);
        $this->db->where('api', $api);
        $this->db->where('hotel_code', $hotel_code);  
        $this->db->delete('hotel_search_result');
    }

     function get_supplement_meal_plan($id)
      {
          $this->db->select('meal_plan');
          $this->db->from('glb_hotel_meal_plan'); 
          $this->db->where_in('id', $id);      
           $query = $this->db->get();
          if ($query->num_rows() > 0)
          {
              $res=$query->result();
              $meal_plan=array();
              foreach ($res as $val) {
                $meal_plan[]=$val->meal_plan;                
              }
              $mealstr=implode(',', $meal_plan);
              return $mealstr;

          }
          else
          {
              return array();  
          }
        
    }


    public function get_crshotelcode($api,$hotel_name,$city_name,$country_name){
        $this->db->select('hotel_code');
        $this->db->where('hotel_name',$hotel_name); 
        $this->db->where('api',$api);
        $this->db->where('city_name',$city_name); 
        $this->db->where('country_name',$country_name); 
        $this->db->where('status','1');
         $this->db->from('api_permanent_hotels');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 0;
        }

    }

    public function get_hotel_booking_details($sysRefno) {
        $this->db->select('hr.*,hh.*,hp.*')
                ->from('hotel_booking_reports hr')
                ->join('hotel_booking_hotels_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo')
                ->join('hotel_booking_passengers_info hp', 'hr.uniqueRefNo = hp.uniqueRefNo')
               // ->join('agent_info a', 'hr.agent_id = a.agent_id')
                ->where('hr.uniqueRefNo', $sysRefno);
               // ->order_by('hh.hotel_booking_id', 'DESC')
               // ->group_by('hp.uniqueRefNo');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return false;
    }

    public function update_hotel_cancel_status($Book_reference,$status,$CancellationCharge,$booking_status) {
        $update_info = array(
            'Cancellation_Status' => $status,
            'Cancellation_Charge' => $CancellationCharge,
            'Booking_Status' => $booking_status,
        );
        $this->db->where('uniqueRefNo', $Book_reference);
        $this->db->update('hotel_booking_reports', $update_info);
    }

    public function get_hotel_booking_pass_info($unique_ref){
     $this->db->select('hr.*')
            ->from('hotel_booking_passengers_info hr')
            ->where('hr.uniqueRefNo', $unique_ref);
                      
           // ->where('hr.agent_id',0);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return false;
  
  }

    public function getBookingDetails(){
       $this->db->select('*');
        $this->db->from('hotel_booking_reports');
        $this->db->order_by('report_id', 'DESC');
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $res = $query->row();
            return $res;
        } else {
          return '';
        }
    } 
    

}


