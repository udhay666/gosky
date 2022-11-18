<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Model extends CI_Model {

    public function getAbout()
    {
        $this->db->select('*');
        $this->db->where('type', 1);
        $query = $this->db->get('cms');
        
        return $query;
        
    }

    public function getcontact()
    {
        $this->db->select('*');
        $this->db->where('type', 6);
        $query = $this->db->get('cms');
        
        return $query;
        
    }

    public function getprivacy()
    {
        $this->db->select('*');
        $this->db->where('type', 10);
        $query = $this->db->get('cms');
        
        return $query;
        
    }

    public function getterms()
    {
        $this->db->select('*');
        $this->db->where('type', 11);
        $query = $this->db->get('cms');
        
        return $query;
        
    }

    public function getrefund()
    {
        $this->db->select('*');
        $this->db->where('type', 12);
        $query = $this->db->get('cms');
        
        return $query;
        
    }

    public function getfaq()
    {
        $this->db->select('*');
        $this->db->where('type', 8);
        $query = $this->db->get('cms');
        
        return $query;
        
    }

    public function getaffiliate()
    {
        $this->db->select('*');
        $this->db->where('type', 3);
        $query = $this->db->get('cms');
        
        return $query;
        
    }
    
    public function getcms_footer()
    {
        $this->db->select('*');
        $this->db->where('type', 22);
        $query = $this->db->get('cms');
        
        return $query->row();
        
    }

    // public function getHolidaypackage()
    // {
    //     $this->db->select('holiday_list.holiday_id, holiday_list.package_title, holiday_list.package_desc, holiday_list.price, holiday_images.holiday_images');
    //     $this->db->where('holiday_list.status', '1');
    //     $this->db->from('holiday_list');
    //     $this->db->join('holiday_images', 'holiday_list.holiday_id = holiday_images.holiday_list_id', 'left');
    //     $this->db->where('holiday_images.img_type', '1');   
    //     $query = $this->db->get();
    //     return $query->result();
    // }
    
    public function getHolidaypackage()
    {
       $this->db->select('holiday_list.holiday_id, holiday_list.package_title, holiday_list.package_desc, holiday_list.package_code, holiday_list.price, holiday_images.holiday_images');
        $this->db->where('holiday_list.status', '1');
        $this->db->from('holiday_list');
        $this->db->join('holiday_images', 'holiday_list.holiday_id = holiday_images.holiday_list_id', 'left');
        $this->db->where('holiday_images.img_type', '1');        
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getAirportlist($postData)
    {
        $response = array();

        if ($postData['search']) {
            $this->db->select('*');
            $this->db->where('airport_code like "%'.$postData['search'].'%" ');
            $this->db->limit(20);
            $this->db->order_by('airport_city');
            $records = $this->db->get('airport_list')->result();

            if(!empty($records)){
            foreach($records as $row){
                $airport_city = $row->airport_city;
                $airport_name = $row->airport_name;
                $airport_code = $row->airport_code;
                $airport_country = $row->airport_country;
                $response[] = array(
                    "value" => $airport_city .', '.$airport_country .' ('.$airport_code.')',
                    "label" => $airport_city .', '.$airport_country .' ('.$airport_code.')',
                    'id' => $airport_code,
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
    
    public function getCurrency($id)
    {
        $this->db->select('*');
        $this->db->where('currency_code', $id);
        $this->db->limit(1);
        $query = $this->db->get('currency');
        return $query->row();
    }
    
     public function get_holiday_list_by_id($hol_id){
        $this->db->select('*');
             $this->db->from('holiday_itinerary_daywise');
             $this->db->where('holiday_id',$hol_id);
                $query=$this->db->get();
                  return $query->result();
        
        } 
        
    public function get_hholiday_list_by_id($hol_id){
        $this->db->select('*');
             $this->db->from('holiday_list');
             $this->db->where('holiday_id',$hol_id);
                $query=$this->db->get();
                  return $query->result();
    }

    public function get_holi_images($id) {
            $array = array('holiday_list_id'=>$id, 'img_type'=>1);
            $this->db->select('*');
            $this->db->from('holiday_images');
            $this->db->where($array); 
            $this->db->limit(1); 
            $q = $this->db->get();
            return $q->result(); 
            
        }
        
    public function get_gall_images($id) {
            $array = array('holiday_list_id'=>$id, 'img_type'=>2);
            $this->db->select('*');
            $this->db->from('holiday_images');
            $this->db->where($array); 
            // $this->db->limit(1); 
            $q = $this->db->get();
            return $q->result(); 
            
        }
        
     public function get_homebanner_images()
    {
        $this->db->select('*');
        $this->db->from('home_banner'); 
        $this->db->where('isActive',1);   
        
        $query = $this->db->get();
        if($query->num_rows() == 0 )
        {
           return '';
        }
        else
        {
            return $query->result();
        }
    }
    
    
    public function get_holiday_city_list($search) {
        $where = "(city_name LIKE '%" . $search . "%')";
        $this->db->select('*');
        $this->db->from('holi_city'); 
        $this->db->where($where);  
        $this->db->limit('10');     
        $this->db->order_by('city_name');
        $query = $this->db->get(); // echo $this->db->last_query();  
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }
    
    public function getHolidayCitylist($postData)
    {
        $response = array();

        if ($postData['search']) {
            $this->db->select('*');
            $this->db->where('city_name like "%'.$postData['search'].'%" ');
            $records = $this->db->get('holi_city')->result();

            foreach($records as $row){
                $response[] = array(
                    "value" => $row->city_id,
                    "label" => $row->city_name 
                );
            }
        }

        return $response;
    }
    
    public function getTravellerCitylist($postData){
        $response = array();

        if ($postData['search']) {
            $this->db->select('*');
            $this->db->where('country_name like "%'.$postData['search'].'%" ');
            $records = $this->db->get('holi_country')->result();

            foreach($records as $row){
                $response[] = array(
                    "value" => $row->country_id,
                    "label" => $row->country_name 
                );
            }
        }

        return $response;
    }
    
    	public function agent_acc_summary($agent_no){
	    $this->db->select('*');
		$this->db->where('agent_no', $agent_no);
		$this->db->where('status','Accepted');
		$this->db->order_by('created_at','desc');
        $this->db->limit(1);  
		$query = $this->db->get('agent_acc_summary');
		if ($query->num_rows() > 0) {
            $res = $query->result();
            $balance = $res[0]->available_balance;
        } else {
            $balance = 0;
        }         
        return  $balance;
	}

    public function getHotelCitylist($postData)
    {
        $response = array();

        if ($postData['search']) {
            $this->db->select('*');
            $this->db->where('city_name like "%'.$postData['search'].'%" ');
            $this->db->limit(20);
            $this->db->order_by('city_name');
            $records = $this->db->get('tbo_hotels_city_list')->result();

            if(!empty($records)){
            foreach($records as $row){
                $city_name = $row->city_name;
                $country_name = $row->country_name;
                $city_id = $row->city_id;
                // $airport_country = $row->airport_country;
                $response[] = array(
                    "label" => $city_name .', '.$country_name,
                    "value" => $city_name .', '.$country_name,
                    'id' => $city_id,
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

    function get_flight_booking_info($user_email,$user_mobile,$uniqueRefNo) {
        $this->db->select('a.*,b.*');
        $this->db->from('flight_booking_reports a');
        $this->db->join('flight_booking_passengers b','a.uniqueRefNo=b.uniqueRefNo');
        $this->db->where('a.uniqueRefNo', $uniqueRefNo);
        $this->db->where('b.email', $user_email);
        $this->db->where('b.mobile', $user_mobile);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {           
            return $query->result();
        } else {
            return '';
        }
    }

    public function hotelBookingSummary($user_email, $user_mobile, $uniqueRefNo) {
        $this->db->select('hr.*,hh.city as hotel_city,hh.*,hp.*');
        $this->db->from('hotel_booking_reports hr');
        $this->db->join('hotel_booking_hotels_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo','LEFT');
        $this->db->join('hotel_booking_passengers_info hp', 'hr.uniqueRefNo = hp.uniqueRefNo','LEFT');
        $this->db->where('hp.email', $user_email);
        $this->db->where('hp.mobile', $user_mobile);
        $this->db->where('hr.uniqueRefNo', $uniqueRefNo);
        $this->db->group_by('hr.uniqueRefNo');
        $query = $this->db->get();      
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

}

/* End of file Home_Model.php */


?>