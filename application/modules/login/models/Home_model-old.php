<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Home_Model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	 public function get_best_hotel_list() {
      $this->db->select('*');
      $this->db->from('best_hotel_images');
      $query = $this->db->get();
      //echo $this->db->last_query();
      if ($query->num_rows() == '') {
          return '';
      } else {
          return $query->result();
      }
    }
    public function get_holiday_list() {
      $this->db->select('*');
      $this->db->from('home_holiday_images');
      $query = $this->db->get();
      //echo $this->db->last_query();
      if ($query->num_rows() == '') {
          return '';
      } else {
          return $query->result();
      }
    }
    public function get_all_city_list($search) {
    $where = "city_name LIKE '" . $search . "%'";
        $this->db->select('*');
        $this->db->from('tbo_hotels_city_list');
        $this->db->where($where);
        $this->db->limit('10');
        $this->db->order_by('city_name');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result_array();
        }
  }


  public function get_start_picklocation($search) {
    $where = "city_name LIKE '" . $search . "%'";
        $this->db->select('*');
        $this->db->from('car_rent_city');
        $this->db->where($where);
        $this->db->limit('10');
        $this->db->order_by('city_name');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result_array();
        }
  }
  public function get_start_droplocation($search) {
    $where = "destination_name LIKE '" . $search . "%'";
        $this->db->select('*');
        $this->db->from('car_rent_destination');
        $this->db->where($where);
        $this->db->limit('10');
        $this->db->order_by('destination_name');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result_array();
        }
  }

    public function get_start_location(){
        $this->db->select('*');
        $this->db->from('car_rent_city');        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
            //echo $this->db->last_query();
        } else {
            return '';
        }


    }

    public function get_dropoff_location(){
        $this->db->select('*');
        $this->db->from('car_rent_destination');        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
            //echo $this->db->last_query();
        } else {
            return '';
        }


    }


	  public function get_transfer_city_list($search) {
        $where = "CityName LIKE '" . $search . "%'";
        $this->db->select('*');
        $this->db->from('transfer_destinationcity_list');
        $this->db->where($where);
        $this->db->limit('10');
        $this->db->order_by('CityName');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

    public function get_car_city_list($search) {
        $where = "destination_name LIKE '" . $search . "%'";
        $this->db->select('*');
        $this->db->from('car_rent_destination');
        $this->db->where($where);
        $this->db->limit('10');
        $this->db->order_by('destination_name');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }
	public function get_airport_list($search) {
         // echo $search;exit;
        // $where = "(airport_code LIKE '".$search."%' OR airport_city  LIKE '".$search."%')";
        $where = "(airport_code LIKE '".$search."%')";
        $this->db->select('*');
        $this->db->from('airport_list');            
        $this->db->where($where);
        $this->db->limit(20);
        $this->db->order_by('airport_city');                    
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            $where = "(airport_city  LIKE '".$search."%')";
            $this->db->select('*');
            $this->db->from('airport_list');            
            $this->db->where($where);
            $this->db->limit(20);
            $this->db->order_by('airport_city');                    
            $query1 = $this->db->get();
            if($query1->num_rows() > 0) {
             return $query1->result_array();
            }

        }
    }

    public function getPopularCities($module_type) {
        $this->db->select('*');
        $this->db->from('popularcities');            
        $this->db->where('module_type', $module_type); //1=hotel,2=flight
        $this->db->where('status', 1);
        $this->db->limit(20);
        $this->db->order_by('name');                    
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();
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

    public function check_emailSubs($email){
        $this->db->select('user_email');
        $this->db->from('holiday_subscribe');
        $this->db->where('user_email', $email);
        // $this->db->select('email');
        // $this->db->from('email_subscribers');
        // $this->db->where('email', $email);
        // $this->db->where('status',1);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->email;
        }
        return '';
    }

    public function getBanners($module_type) {
        $this->db->select('*');
        $this->db->from('banners');
        $this->db->where('module_type',$module_type);
        // $this->db->where('status',1);
        $this->db->limit(1);
        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->banner_path;
        }
        return '';
    }

    public function top_deals() {
        $this->db->select('*');
        $this->db->from('top_deals');
        $this->db->where('status',1);
        // $this->db->limit(1);
        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return '';
    }

    public function popular_destination() {
        $this->db->select('*');
        $this->db->from('popular_destination');
        $this->db->where('status',1);
        // $this->db->limit(1);
        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return '';
    }


     /*
    *Holiday models
    */

    public function get_offerpackage_list()
    {
        $this->db->select('*');
        $this->db->from('holiday_list');
        $this->db->where('status','1');
        $this->db->where('hot_offer','1');
        $this->db->order_by('rand()');
        $this->db->limit('9');
        $query=$this->db->get();
        if ($query->num_rows == '') {
            return '';
        } else {      
            return $query->result();
        }
    }

     public function get_trending_list()
    {
        $this->db->select('*');
        $this->db->from('holiday_list');
        $this->db->where('status','1');
        $this->db->where('trending_dest','1');
        $this->db->order_by('rand()');
        $this->db->limit('9');
        $query=$this->db->get();
        if ($query->num_rows == '') {
            return '';
        } else {      
            return $query->result();
        }
    }

     public function get_location_list()
    {
        $this->db->select('*');
        $this->db->from('holiday_list');
        $this->db->where('status','1');
        $this->db->where('location_dest','1');
        $this->db->order_by('rand()');
        $this->db->limit('15');
        $query=$this->db->get();
        if ($query->num_rows == '') {
            return '';
        } else {      
            return $query->result();
        }
    }

    public function get_offbeat_list()
    {
        $this->db->select('*');
        $this->db->from('holiday_list');
        $this->db->where('status','1');
        $this->db->where('offbeat_place','1');
        $this->db->order_by('rand()');
        $this->db->limit('8');
        $query=$this->db->get();
        if ($query->num_rows == '') {
            return '';
        } else {      
            return $query->result();
        }
    }

    public function get_inspiration_continent()
    {
        $this->db->select('*');
        $this->db->from('holi_continent');
        $this->db->where('active_inspiration','1');      
        $query=$this->db->get();
        if ($query->num_rows == '') {
            return '';
        } else {      
            return $query->row();
        }
    }   

    public function get_home_category_image_list()
    { 
        $this->db->select('*');
        $this->db->from('holiday_theme');
        $this->db->where('home_category_image IS NOT NULL', null, false);      
        $this->db->where('isActive',1); 
        $this->db->order_by('theme_name','ASC');
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

    public function get_home_banner_images()
    { 
        $this->db->select('*');
        $this->db->from('home_banner');
        $this->db->where('img_path IS NOT NULL', null, false);
        $this->db->where('isActive',1);    
        $this->db->order_by('banner_id','DESC');
        $query = $this->db->get();
        $this->db->limit('5');
        if($query->num_rows() == 0 )
        {
         return '';
     }
     else{
        return $query->result();
        }
    }


    public function getholivisitstate($id)
    {
        $this->db->select('*');
        $this->db->from('holi_state');
        $this->db->where_in('state_id',$id);
        $query=$this->db->get();
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }
        
    }
      public function get_all_holi_city_fulllist($search,$limit,$upto) {
            if(!empty($search))
            {
              $where = "(holi_city.city_name LIKE '" . $search . "%' OR holi_state.state_name LIKE '" . $search . "%' 
              OR holi_country.country_name LIKE '" . $search . "%'  OR holi_continent.continent_name LIKE '" . $search . "%')";
          }
          $this->db->select('*');
          $this->db->from('holi_city');
          $this->db->join('holi_state', 'holi_state.state_id= holi_city.state_id');
          $this->db->join('holi_country', 'holi_country.country_id= holi_city.country_id');
          $this->db->join('holi_continent', 'holi_continent.continent_id= holi_country.continent_id');
         $this->db->where('holi_city.status',1);
          if(!empty($search))
          {
              $this->db->where($where);
              $this->db->order_by('holi_city.city_name');
          }
        // $this->db->limit($limit,$upto);
          $query = $this->db->get();
          // echo $query->num_rows(); exit;
          if ($query->num_rows() == '') {
            // echo 12;exit;
            return '';
        } else {
        /*  if(!empty($search)){
                return $query->result_array();
            }
            else */
                return $query->result();
        }
        
    }

       public function get_all_holi_state_fulllist($search,$limit,$upto) {
      if(!empty($search))
      {
          $where = "holi_state.state_name LIKE '" . $search . "%' OR 
          holi_country.country_name LIKE '" . $search . "%'  OR
          holi_continent.continent_name LIKE '" . $search . "%'";
      }
      
      $this->db->select('*');
      $this->db->from('holi_state');
      $this->db->join('holi_country', 'holi_country.country_id= holi_state.country_id');
      $this->db->join('holi_continent', 'holi_continent.continent_id= holi_country.continent_id');
      if(!empty($search))
      {
          $this->db->where($where);
          $this->db->order_by('holi_state.state_name');
      }
        // $this->db->limit($limit,$upto);
      $query = $this->db->get();
      if ($query->num_rows() == '') {
        return '';
    } else {
            /*if(!empty($search)){
                return $query->result_array();
            }
            else*/
                return $query->result();
        }
        
    }
    public function get_all_holi_country_fulllist($search,$limit,$upto) {
        if(!empty($search))
        {
          $where = "holi_country.country_name LIKE '" . $search . "%'  OR
          holi_continent.continent_name LIKE '" . $search . "%'";
      }
      $this->db->select('*');
      $this->db->from('holi_country');
      $this->db->join('holi_continent', 'holi_continent.continent_id= holi_country.continent_id');
      if(!empty($search))
      {
          $this->db->where($where);
       // $this->db->order_by('holi_country.country_name');
      }
        // $this->db->limit($limit,$upto);
      $query = $this->db->get();
      if ($query->num_rows() == '') {
        return '';
    } else {
     
        return $query->result();
    }
    
}
    public function get_all_holi_continent_fulllist($search,$limit,$upto) {
        if(!empty($search))
        {
          $where = "continent_name LIKE '" . $search . "%'";
      }
      $this->db->select('*');
      $this->db->from('holi_continent');
      if(!empty($search))
      {
          $this->db->where($where);
      }
            // $this->db->limit($limit,$upto);
      $query = $this->db->get();
      if ($query->num_rows() == '') {
        return '';
    } else {
     return $query->result();
    }

    }


    public function get_all_holi_packages_fulllist($search,$limit,$upto) {
      if(!empty($search))
       {
           $where = "(package_title LIKE '".mysql_real_escape_string($search)."%')";
      }
      $this->db->select('*');
      $this->db->from('holiday_list');
      if(!empty($search))
      {
          $this->db->where($where);
      }
       $this->db->where('status',1);
            // $this->db->limit($limit,$upto);
      $query = $this->db->get();
      if ($query->num_rows() == '') {
        return '';
    } else {
     return $query->result();
    }

    }


    public function get_all_holi_theme_fulllist($search,$limit,$upto) {
      if(!empty($search))
       {
           $where = "(theme_name LIKE '%".mysql_real_escape_string($search)."%')";
      }
      $this->db->select('*');
      $this->db->from('holiday_theme');
      if(!empty($search))
      {
          $this->db->where($where);
      }
       $this->db->where('isActive',1);
            // $this->db->limit($limit,$upto);
      $query = $this->db->get();
      if ($query->num_rows() == '') {
        return '';
    } else {
     return $query->result();
    }

    }

    public function getholivisitcity($id)
    {
        $this->db->select('*');
        $this->db->from('holi_city');
        $this->db->where_in('city_id',$id);
        $query=$this->db->get();
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }
        
    }

    public function getholivisitcontinent($continent_id)
    {
        $this->db->select('*');
        $this->db->from('holi_continent');
        $this->db->where_in('continent_id',$continent_id);
        $query=$this->db->get();
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }
        
    }

    public function get_img_by_type($holidayid,$img_type) {
    $this->db->select('*');
    $this->db->from('holiday_images');
    $this->db->where('holiday_list_id', $holidayid);
    $this->db->where('img_type', $img_type);
    $query = $this->db->get();
        //echo $this->db->last_query();exit;
    if ($query->num_rows() > 0)
        return $query->row();
    else
        return '';
    }

    public function getholivisitcountry($countryid)
    {
        $this->db->select('*');
        $this->db->from('holi_country');
        $this->db->where_in('country_id',$countryid);
        $query=$this->db->get();
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }
        
    }

    public function get_active_citylist($search) {
        // echo $search;exit;
        $where = "(city_name  LIKE '".$search."%')";
        $this->db->select('*');
        $this->db->from('holi_city');            
        $this->db->where($where);
        //$this->db->limit(20);
        $this->db->order_by('city_name');                    
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    //Bus
    public function get_bus_list($search) {
        // echo $search;exit;
        $where = "(city_name  LIKE '".$search."%')";
        $this->db->select('*');
        $this->db->from('bus_destination_list');            
        $this->db->where($where);
        $this->db->limit(20);
        $this->db->order_by('city_name');                    
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
     public function getholicity_list()
    {
        $this->db->select('*');
        $this->db->from('holi_city');
        // $this->db->where_in('city_id',$id);
        $query=$this->db->get();
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }
        
    }
}