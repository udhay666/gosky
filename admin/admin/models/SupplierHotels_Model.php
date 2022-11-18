<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SupplierHotels_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function get_hotels()
    {
        /*$this->db->select('*');
        $this->db->from('sup_hotels');	
        $this->db->where('status',1);

		$query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }*/
         $this->db->select('*');
        /*if($supplier_id != ''){
            $this->db->where('supplier_id', $supplier_id);
        }*/
        $this->db->from('supplier_hotel_list');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result(); 
        }
        return false;
    }
     public function get_hotels_by_supplier($supplier_id)
    {
        /*$this->db->select('*');
        $this->db->from('sup_hotels');	
        $this->db->where('supplier_id',$supplier_id);
$this->db->where('status',1);
		$query = $this->db->get();
      // echo $this->db->last_query();exit;
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }*/

        $this->db->select('*');
        if($supplier_id != ''){
            $this->db->where('supplier_id', $supplier_id);
        }
        $this->db->from('supplier_hotel_list');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result(); 
        }
        return false;
        
    }
    public function update_supplier_status($status,$supplier_id){
        $this->db->where('supplier_id',$supplier_id);
        $this->db->update('supplier_info',$status);
        return true;
    }
	function changestatus_hotel($id) {
		$this->db->select('admin_status');
		$this->db->from('sup_hotels');
		$this->db->where('sup_hotel_id', $id);
		$query = $this->db->get();
		if($query->num_rows()>0)
        {	
			$row = $query->row();
			if($row->admin_status > 0 && $row->admin_status  != 2) {
				$data = array (
					'admin_status' => 0,
				);
				
			} else {
				$data = array (
					'admin_status' => 1,
				);			
			}
			
			$where = "sup_hotel_id = '$id'";
			$this->db->update('sup_hotels', $data, $where);		
		}
	}	
    function get_active_hotels() {
        $this->db->select('*');
        $this->db->from('sup_hotels');
        $this->db->where('admin_status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function get_sup_activated_hotels($supplier_id){
        $this->db->select('*');
        $this->db->from('sup_hotels');
        $this->db->where('supplier_id',$supplier_id);
               $this->db->where('admin_status',1);
                $query=$this->db->get();
           if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
        
    }
    public function delete_sup_old_hotels($supplier_id){
        $this->db->where('supplier_id',$supplier_id);
        $this->db->where('api','hotel_crs');
        $this->db->delete('api_permanent_hotels');
        
    }
    public function insert_sup_to_perm_hotel($data){
        $this->db->insert('api_permanent_hotels',$data);
        return true;
    }

    public function list_hotel($supplier_id=''){
        $this->db->select('*');
        if($supplier_id != ''){
            $this->db->where('supplier_id', $supplier_id);
        }
        $this->db->from('supplier_hotel_list');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result(); 
        }
        return false;
    }


}
