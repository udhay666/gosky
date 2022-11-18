<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Flights_Model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    function getAirportServiceType($airport_code) 
    {
        $this->db->select('service');
        $this->db->from('airport_list_old');
        $this->db->where('airport_code', $airport_code);  
        $this->db->limit(1);
              
        $query = $this->db->get();
        if ($query->num_rows() > 0) 
        {
            $res = $query->row();
            return $res->service;
        }

    }

    function getActiveAPIs() {

        $this->db->select('api_name');
        $this->db->from('api_info');
        $this->db->where('service_type', 2);
        $this->db->where('status', 1);
        $this->db->order_by('order_no', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
    function get_flight_search_result($searchId, $segmentkey='') {
        $this->db->select('*');
        $this->db->from('flight_search_result');
        $this->db->where('search_id', $searchId);
        if($segmentkey!=''){
            $this->db->where('segmentkey', $segmentkey);
        }
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }
    function get_country_list() {
        $this->db->select('*');
        $this->db->from('country');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }
    function get_airport_name($airport_code) {
        $this->db->select('city_name');
        $this->db->from('tbo_flight_city');
        $this->db->where('city_code', $airport_code);
        $this->db->limit('1');
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $res = $query->row();
            $airport_name = $res->city_name;
        } else {
            $airport_name = '';
        }    
        return $airport_name;
    }
    
    function get_origin_airport($airport_code) {
        $this->db->select('airport_name');
        $this->db->from('airport_list');
        $this->db->where('airport_city', $airport_code);
        $this->db->limit('1');
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $res = $query->row();
            $airport_name = $res->airport_name;
        } else {
            $airport_name = '';
        }    
        return $airport_name;
    }
     function get_desti_airport($airport_code) {
        $this->db->select('airport_name');
        $this->db->from('airport_list');
        $this->db->where('airport_city', $airport_code);
        $this->db->limit('1');
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $res = $query->row();
            $airport_name = $res->airport_name;
        } else {
            $airport_name = '';
        }    
        return $airport_name;
    }
    function get_flight_booking_info($RefId, $mode) {
        $this->db->select('*');
        $this->db->from('flight_booking_reports');
        $this->db->where('uniqueRefNo', $RefId);
        // $this->db->where('BookingRefId', $book_id);
        $this->db->where('Mode', $mode);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }
    function get_passengers_info($RefId) {
        $this->db->select('*');
        $this->db->from('flight_booking_passengers');
        $this->db->where('uniqueRefNo', $RefId);
        $this->db->order_by('pass_id', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    public function getPassengerData($postData)
    {
        $agent_id = $this->session->agent_id;
        $agent_no = $this->session->agent_no;
        $response = array();

        if ($postData['search']) {
            $this->db->select('*')
            ->from('flight_booking_reports fr')
            ->join('flight_booking_passengers fp', 'fr.uniqueRefNo = fp.uniqueRefNo');
            $this->db->where('first_name like "%'.$postData['search'].'%" ');
            $this->db->where('agent_id', $agent_id);
            // $this->db->where('agent_no', $agent_no);
            
            $this->db->limit(20);
            $this->db->order_by('pass_id');
            $records = $this->db->get()->result();

            if(!empty($records)){
            foreach($records as $row){
                $first_name = $row->first_name;
                $last_name = $row->last_name;
                // $airport_code = $row->airport_code;
                // $airport_country = $row->airport_country;
                $response[] = array(
                    "value" => $first_name .', '.$last_name .' ',
                    "label" => first_name .', '.$last_name .' ',
                    'id' => $row->pass_id,
                    'category' => ''
                    
                );
            }
        }else {
            $response[] = array(
                'label' => "No Results Found",
                'value' => "",
                'id' => "",
                'category' => "",
            );
        }
        }

        return $response;
    } 
    
    
    public function get_promotional_code($promo_code) {
        $this->db->select('*')
        ->from('promotion_manager')
        ->where('promo_code', $promo_code)
        ->where('status', 1)
        ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
            // $balance = $res[0]->available_balance;
        } else {
            return '';
        }
    }
    
    public function get_promo_code() {
        $this->db->select('*')
        ->from('promotion_manager')
        ->where('service_type', 2)
        ->where('status', 1)
        ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
            // $balance = $res[0]->available_balance;
        } else {
            return '';
        }
    }

    function get_booking_report($RefNo) {
        $this->db->select('*');
        $this->db->from('flight_booking_reports');
        $this->db->where('uniqueRefNo', $RefNo);
        $this->db->order_by('DirectionInd', 'ASC');
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    


   

}