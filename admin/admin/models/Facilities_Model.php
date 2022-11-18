<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Facilities_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
    * Get product by his is
    * @param int $id 
    * @return array
    */
    public function get_facility_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('glb_hotel_facilities_type');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }	
	public function get_facilities_view($limit_start,$limit_end) {
		
		$this->db->select('id,facility,facility_type');
		$this->db->from('glb_hotel_facilities_type');		
		$this->db->limit($limit_start,$limit_end);
		$query = $this->db->get();
		if ($query->num_rows > 0) {
			return $query->result_array(); 			
        }
		return false;					
	}
	public function get_facilities($type = false) {
		
		$this->db->select('*');
		$this->db->from('glb_hotel_facilities_type');		
		if($type) {
			$this->db->where('facility_type',$type);
		}
		$query = $this->db->get();
		if ($query->num_rows > 0) {
			return $query->result(); 			
        }
		return false;					
	}	
    /**
    * Count the number of rows
    * @param int $manufacture_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_facilities()
    {
		$this->db->select('*');
		$this->db->from('glb_hotel_facilities_type');
		$query = $this->db->get();
		return $query->num_rows();        
    }
	

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function save_facility($data)
    {
	
		$insert = $this->db->insert('glb_hotel_facilities_type', $data);
	    return $insert;
	}

    /**
    * Update Facility
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_facility($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('glb_hotel_facilities_type', $data);
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
    * Delete Facility
    * @param int $id
    * @return boolean
    */
	function delete_facility($id){
		$this->db->where('id', $id);
		$this->db->delete('glb_hotel_facilities_type'); 
	}


}
