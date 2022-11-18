<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Holidaypackage_model extends CI_Model {

    function __construct() {
        parent :: __construct();
    }

 			  /////////////////////////////////////////////////
             ///////////////HOLIDAY PACKAGES//////////////////
            /////////////////////////////////////////////////

              //Holiday_package
     public function check_continent_avail($continent) {
         $this->db->select('*')
                ->from('holi_continent')               
                ->where('continent_name', $continent);
         $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }
    public function add_continent($data) {       
        $this->db->insert('holi_continent', $data);
    }
    public function get_continent_list($id='') {
         
          if(!empty($id)){
           $this->db->select('*');
                $this->db->from('holi_continent');           
                $this->db->where('continent_id', $id);
                 $this->db->where('isActive', 1);  
                 }
                 else{
                 $this->db->select('*');
                $this->db->from('holi_continent') ;              
                $this->db->where('isActive', 1);     
                 }         
         $query = $this->db->get();
         
        // 
        if ($query->num_rows() > 0) {
          //  echo $this->db->last_query();
            
            return $query->result();
           // print_r($m);
        }
else{
        return false;
}
    }
     function delete_continent($id) {
        $data = array('isActive' => 0);
        $this->db->where('continent_id', $id);
         $this->db->update('holi_continent', $data);
        return true;
    }
     public function update_continent($id, $continent) {
         $data = array(
            'continent_name' => $continent,
            );
        $this->db->where('continent_id',$id);
        $this->db->update('holi_continent', $data);
       return true;
    }
  
    //country
     public function check_country_avail($country) {
         $this->db->select('*')
                ->from('holi_country')               
                ->where('country_name', $country);
         $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }
      public function add_holi_country($data) {
            $this->db->insert('holi_country', $data);
    }
      public function get_holi_country_list($id='') {
        if(!empty($id)){
    
         $this->db->select('*');
        $this->db->from('holi_country');
        $this->db->join('holi_continent', 'holi_country.continent_id= holi_continent.continent_id');
        $this->db->where('holi_country.country_id',$id);
        $this->db->where('holi_country.isActive', 1);
    }
    else
    {

         $this->db->select('*');
        $this->db->from('holi_country');
        $this->db->join('holi_continent', 'holi_country.continent_id= holi_continent.continent_id');
       $this->db->where('holi_country.isActive', 1);
    }
   
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }
    function update_holi_country($id,$country,$continent)
    {
       
     $data = array(
               
                'country_name' => $country,
                'continent_id' => $continent,
               );
        $this->db->where('country_id',$id);
        $this->db->update('holi_country', $data);
       return true;
   }
   function delete_holi_country($id) {
         $data = array('isActive' => 0);
        $this->db->where('country_id', $id);
         $this->db->update('holi_country', $data);
        return true;
    }
    //State
    function get_holi_state_list($id=''){
    if(!empty($id)){
    
         $this->db->select('*');
        $this->db->from('holi_state');
        $this->db->join('holi_country', 'holi_country.country_id= holi_state.country_id');
        $this->db->where('holi_state.state_id',$id);
        $this->db->where('holi_state.isActive', 1);
    }
    else
    {
        $this->db->select('*');
        $this->db->from('holi_state');
        $this->db->join('holi_country', 'holi_country.country_id= holi_state.country_id');
        $this->db->where('holi_state.isActive', 1);
    }
   
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }
    function get_holi_state_list_by_country_id($id){
          $this->db->select('*');
        $this->db->from('holi_state');
        $this->db->where('country_id',$id);
        $this->db->where('isActive', 1);
         $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }
     public function add_holi_state($data) {      
        $this->db->insert('holi_state', $data);
    }
     public function check_state_avail($state) {
        $this->db->select('*')
                ->from('holi_state')               
                ->where('state_name', $state);
         $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }
    function update_holi_state($id,$state,$country)
    {
        $data = array(
                'state_name' => $state,
                'country_id' => $country,
               );
         $this->db->where('state_id', $id);
         $this->db->update('holi_state', $data);
        return true;
   }
   function delete_holi_state($id) {
         $data = array('isActive' => 0);
        $this->db->where('state_id', $id);
         $this->db->update('holi_state', $data);
        return true;
    }
    //City
     function get_holi_city_list($id=''){
    if(!empty($id)){
    
         $this->db->select('*');
        $this->db->from('holi_city');
        $this->db->join('holi_state', 'holi_state.state_id= holi_city.state_id');
        $this->db->join('holi_country', 'holi_country.country_id= holi_city.country_id');
        $this->db->where('holi_city.city_id',$id);
       // $this->db->where('holi_city.isActive', 1);
    }
    else
    {
         $this->db->select('holi_city.city_id,holi_city.city_name,holi_city.state_id,holi_city.country_id,holi_city.isActive,holi_city.status,holi_state.state_name,holi_country.country_name');
        $this->db->from('holi_city');
        $this->db->join('holi_state', 'holi_state.state_id= holi_city.state_id');
        $this->db->join('holi_country', 'holi_country.country_id= holi_city.country_id');
     //   $this->db->where('holi_city.isActive', 1);
    }
   
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }
     public function add_holi_city($city,$state,$country) {
        $data = array(
            'city_id' => '',
            'city_name' => $city,
            'state_id'=>$state,
            'country_id' => $country,
            'isActive'=>1 ,
             'status'=>1                    
        );
        $this->db->insert('holi_city', $data);
    }
     public function check_holi_city_avail($city) {
         $this->db->select('*')
                ->from('holi_city')               
                ->where('city_name', $city)
                ->where('isActive', 1);
         $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }
    function update_holi_city($id,$city,$state,$country)
    {
        $data = array(
                'city_name' => $city,
                'state_id'=>$state,
                'country_id' => $country,
               );
         $this->db->where('city_id', $id);
         $this->db->update('holi_city', $data);
        return true;
   }
   function delete_holi_city($id) {
         $data = array('isActive' => 0);
        $this->db->where('city_id', $id);
         $this->db->update('holi_city', $data);
        return true;
    }
   function set_active_status_holi_city($id,$active)
   {
     $data = array('isActive' => $active,'status'=>$active);
    $this->db->where('city_id', $id);
    $this->db->update('holi_city', $data);
        return true;
   }

 
public function update_inspiration($id)
{
   $data = array(
            'active_inspiration' => 1,
            );
        $this->db->where('continent_id',$id);
        $this->db->update('holi_continent', $data); 
         $data = array(
            'active_inspiration' => 0,
            );
        $this->db->where('continent_id != ',$id);
        $this->db->update('holi_continent', $data); 
        return true;
}

 public function get_inspiration_country_list($id='') {
       
    
         $this->db->select('*');
        $this->db->from('holi_country');
        $this->db->join('holi_continent', 'holi_country.continent_id= holi_continent.continent_id');
        $this->db->where('holi_country.continent_id',$id);      
        //$this->db->order_by('holi_country.country_inspiration_image','DESC');
         $this->db->order_by('holi_country.active_inspiration_country','DESC');
        $query = $this->db->get();
      // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else
            return '';

        
    }

    public function update_inspiration_country($id,$isActive){      
         $data = array(
            'active_inspiration_country' => $isActive,          
            );   
        $this->db->where('country_id',$id);
        $this->db->update('holi_country', $data);        
        return true;
    }

     public function getcontinentbycountryid($id)
    {
        $this->db->select('*');
        $this->db->from('holi_continent');      
        $this->db->where('continent_id',$id);    
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        else
            return '';
         
    }

}