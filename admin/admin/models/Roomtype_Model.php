<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Roomtype_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
    * Get product by his is
    * @param int $id 
    * @return array
    */
    public function get_roomtype_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('glb_hotel_room_type');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }	
	public function get_roomtype_view($limit_start,$limit_end) {
		
		$this->db->select('id,room_type');
		$this->db->from('glb_hotel_room_type');		
		$this->db->limit($limit_start,$limit_end);
		$query = $this->db->get();
		if ($query->num_rows > 0) {
			return $query->result_array(); 			
        }
		return false;					
	}
	public function get_roomtype() {
		
		$this->db->select('*');
		$this->db->from('glb_hotel_room_type');		
		$query = $this->db->get();

        if($query->num_rows > 0) 
		{
            return $query->result();            
        }
		else
		{
			return '';
		}
	}	
    /**
    * Count the number of rows
    * @return int
    */
    function count_roomtype()
    {
		$this->db->select('*');
		$this->db->from('glb_hotel_room_type');
		$query = $this->db->get();
		return $query->num_rows();        
    }
	

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function save_roomtype($data)
    {
	
		$insert = $this->db->insert('glb_hotel_room_type', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_roomtype($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('glb_hotel_room_type', $data);
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
    * Delete hotel
    * @param int $hotel_id
    * @return boolean
    */
	function delete_roomtype($id){
		$this->db->where('id', $id);
		$this->db->delete('glb_hotel_room_type'); 
	}


}
