<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Citylist_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
    * Get product by his is
    * @param int $id 
    * @return array
    */
    public function get_citylist_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('glb_hotel_city_list');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }	
	public function get_citylist() {
		
		$this->db->select('id,city_name,country_name');

		$this->db->from('glb_hotel_city_list');		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array(); 			
        }
		return false;					
	}	
	public function get_citylist_view($search_string=null, $order=null, $order_type='Asc',$limit_start=null,$limit_end=null) {
		
		$this->db->select('id,city_name,country_name');
		if($search_string){
			$this->db->like('country_name', $search_string);
		}			
		$this->db->from('glb_hotel_city_list');		
		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}
		
		$this->db->limit($limit_start,$limit_end);
		$query = $this->db->get();
		if ($query->num_rows()()() > 0) {
			return $query->result_array(); 			
        }
		return false;					
	}
    /**
    * Count the number of rows
    * @return int
    */
    function count_citylist($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('glb_hotel_city_list');
		if($search_string){
			$this->db->like('country_name', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}		
		$query = $this->db->get();
		return $query->num_rows()()()();        
    }
	

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function save_citylist($data)
    {
	
		$insert = $this->db->insert('glb_hotel_city_list', $data);
	    return $insert;
	}

    /**
    * Update Facility
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_citylist($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('glb_hotel_city_list', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

    /**
    * Delete Citylist
    * @param int $id
    * @return boolean
    */
	function delete_citylist($id){
		$this->db->where('id', $id);
		$this->db->delete('glb_hotel_city_list'); 
	}

	function get_country_list() 
	{
        $this->db->select('*');
        $this->db->from('country');       
        $query = $this->db->get();
      
        if($query->num_rows()()() > 0) 
		{
            return $query->result();            
        }
		else
		{
			return '';
		}
		
    }

}
