<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Billing_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
	function get_supplier($supplier_id) {
		$this->db->select('*');
        $this->db->from('supplier_info');       
		$this->db->where('supplier_id',$supplier_id);       
	
        $query = $this->db->get();
      
        if($query->num_rows > 0) 
		{
            return $query->row();            
        }
		else
		{
			return '';
		}	
	}
	function get_supplier_summary($supplier_id) {
		$this->db->select('*');
        $this->db->from('sup_acc_summary');       
		$this->db->where('supplier_id',$supplier_id);       
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
	function get_supplier_available_balance($supplier_id) {
	    $this->db->select('available_balance')
				->from('sup_acc_summary')
				->where('supplier_id', $supplier_id)
				->order_by('acc_id', 'DESC')
				->limit('1');
		$query = $this->db->get();

		if ($query->num_rows > 0) {
			$res = $query->result();
			$balance = $res[0]->available_balance;
		} else {
			$balance = 0;
		}	
		return $balance;
	}		
	function get_supplier_balance() {
		$this->db->select('*');
        $this->db->from('(select * from sup_acc_summary order by acc_id desc) as a');       
		$this->db->group_by('a.supplier_id');       
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
	function get_hotels_booking() 
	{
        $this->db->select('*');
        $this->db->from('sup_hotel_booking');       
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
	function get_hotels_booking_unpaid() 
	{
        $this->db->select('*');
        $this->db->from('sup_hotel_booking');
        $this->db->where('paid_status',0);       
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
	
	function update_hotels_booking_status($booking_id,$data) {
		$this->db->where('hotel_booking_id', $booking_id);
		$this->db->update('sup_hotel_booking', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}		
	}
	function get_hotels_booking_by_id($id) 
	{

        $this->db->select('a.*,b.sup_hotel_id,b.supplier_id,c.supplier_no');
        $this->db->from('sup_hotel_booking a');
		$this->db->join('sup_hotels b', 'b.hotel_code = a.hotel_code', 'left');				
		$this->db->join('supplier_info c', 'c.supplier_id = b.supplier_id', 'left');				
		$this->db->where('hotel_booking_id', $id);
        $query = $this->db->get();
      
        if($query->num_rows > 0) 
		{
            return $query->row();            
        }
		else
		{
			return '';
		}
		
    }	
	function insert_supplier_act_summary($insertion_data) {
		$this->db->insert('sup_acc_summary', $insertion_data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		} else {
			return false;
		}				
	}
	function get_city_list() 
	{
        $this->db->select('*');
        $this->db->from('glb_hotel_city_list');       
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
	public function get_roomtype_by_id($id) {
		$this->db->select('*');
		$this->db->from('glb_hotel_room_type');	
		$this->db->where('id', $id);
		$query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
        return false;		
	}
	
	public function get_facility_by_id($id) {
		$this->db->select('*');
		$this->db->from('glb_hotel_facilities_type');	
		$this->db->where('id', $id);
		$query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
        return false;			
	}	
    /**
    * Get Hotel by his is
    * @param int $id 
    * @return array
    */
    public function get_hotel_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('sup_hotels');
		$this->db->where('sup_hotel_id', $id);
		$query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
	
	public function get_rooms_by_id($hotel_id)
	{
        $this->db->select('*');
        $this->db->from('sup_hotel_room_details');
        $this->db->where('sup_hotel_id',$hotel_id);
        $query=$this->db->get();
        if($query->num_rows>0)
        {
            return $query->result();
        }
        else{
            return false;
        }	
	}
	public function get_facilities_by_id($hotel_id) {
        $this->db->select('*');
        $this->db->from('sup_hotel_facilities');
        $this->db->where('sup_hotel_id',$hotel_id);
		$this->db->limit(1);		
        $query=$this->db->get();
        if($query->num_rows>0)
        {
            return $query->row();
        }
        else{
            return false;
        }	
	}
	public function get_images_by_id($hotel_id) {
        $this->db->select('*');
        $this->db->from('sup_hotel_images');
        $this->db->where('sup_hotel_id',$hotel_id);
        $query=$this->db->get();
        if($query->num_rows>0)
        {
            return $query->result();
        }
        else{
            return false;
        }	
	}	
	public function get_hotels_view($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null) {
		
		$this->db->select('a.sup_hotel_id,a.hotel_code,a.hotel_name,b.city_name as city_name,a.hotel_address,a.status');
		if($search_string){
			$this->db->like('a.hotel_name', $search_string);
		}			
		$this->db->from('sup_hotels a');
		$this->db->join('glb_hotel_city_list b', 'b.id = a.hotel_city', 'left');		
		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('a.sup_hotel_id', $order_type);
		}

		$this->db->limit($limit_start,$limit_end);		
		$this->db->group_by('sup_hotel_id');
		$query = $this->db->get();
		if ($query->num_rows > 0) {
			return $query->result_array(); 			
        }
		return false;					
	}
    public function get_hotels()
    {
        $this->db->select('*');
        $this->db->from('sup_hotels');	    

		$query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    /**
    * Count the number of rows
    * @param int $manufacture_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_hotels($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('sup_hotels');

		if($search_string){
			$this->db->like('hotel_desc', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('sup_hotel_id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }
	
    public function get_supplier_info($supplier_id) {
        $this->db->select('*')
                ->from('supplier_info')
                ->where('supplier_id', $supplier_id)
                ->where('status', 1)
                ->limit(1);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
        return false;
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function save_hotel($data)
    {
		$insert = $this->db->insert('sup_hotels', $data);
	    return $insert;
	}
	public function get_last_hotel_code() {
		$this->db->select('hotel_code');
		$this->db->from('sup_hotels');
		$this->db->limit(1);
		$this->db->order_by('hotel_code', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $row = $query->row();
			return $row->hotel_code;
        } else {
			return self::CODE_START;
		}		
	}
    /**
    * Update Hotel
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_hotel($id, $data)
    {
		$this->db->where('sup_hotel_id', $id);
		$this->db->update('sup_hotels', $data);
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
	function delete_hotel($id){
		$this->db->where('sup_hotel_id', $id);
		$this->db->delete('sup_hotels'); 
	}
    public function update_supplier_profile($supplier_id, $supplier_email, $supplier_name, $first_name, $middle_name, $last_name, $mobile_no, $off_no, $address, $pincode, $city, $state, $country) {
        $data = array(
            'supplier_email' => $supplier_email,
            'supplier_name' => $supplier_name,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'mobile_no' => $mobile_no,
            'address' => $address,
            'pin_code' => $pincode,
            'office_phone_no' => $off_no,
            'city' => $city,
            'state' => $state,
            'country' => $country
        );
        $supplier_id = $this->session->userdata('supplier_id');
        $where = "supplier_id = '$supplier_id'";
        if ($this->db->update('supplier_info', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function manage_currency_status($currency_id, $status) {
        $data['status'] = $status;
        $where = "currency_id = '$currency_id'";
        if ($this->db->update('currency', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_payment_charge($id) {
        $this->db->select('*')
                ->from('payment_gateway')
                ->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
        return false;
    }

    public function update_payment_charge($id, $charge) {
        $data['charge'] = $charge;
        $where = "id = '$id'";
        if ($this->db->update('payment_gateway', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    function add_hotel($cityname, $hotel_code, $hotel_name, $brand, $firstname, $lastname, $email, $phno, $fax, $hotel_address, $hotel_description, $hotel_policies, $nearbyarea, $nearbyattraction, $latitude, $longitude) {
        $data = array(
            'supplier_id' => $this->session->userdata('supplier_id'),
            'hotel_code' => $hotel_code,
            'city_name' => $cityname,
            'hotel_name' => $hotel_name,
            'brand' => $brand,
            'main_first_name' => $firstname,
            'main_last_name' => $lastname,
            'main_email' => $email,
            'main_phone_no' => $phno,
            'main_fax' => $fax,
            'hotel_address' => $hotel_address,
            'hotel_desc' => $hotel_description,
            'hotel_policies' => $hotel_policies,
            'near_by_area' => $nearbyarea,
            'near_by_attraction' => $nearbyattraction,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'status' => 0
        );
        $this->db->insert('sup_hotels', $data);
        $ins = $this->db->insert_id();
        return $ins;
    }

    function get_hotel() {
        $this->db->select('*');
        $this->db->from('sup_hotels');
        $this->db->where('supplier_id', $this->session->userdata('supplier_id'));
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


    function get_hotel_detail($id) {
        $query = $this->db->select('*')->from('sup_hotels')->where('sup_hotel_id', $id)->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
    }

    function get_room_category() {
        $this->db->select('*');
        $this->db->from('global_room_category_type');
        $this->db->where('status', '1');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_hotel_rooms() {
        $this->db->select('*');
        $this->db->from('sup_hotel_room_details');
        //    $this->db->where('supplier_id', $this->session->userdata('supplier_id'));
        //$this->db->where('status', '1');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function update_room($sup_hotel_id, $sup_room_details_id, $room_cat, $room_name, $room_description, $occupancy, $adults, $child, $totroom, $noofroomleft, $roomcritical, $roompolicy) {
        $data = array(
            'global_room_category_type_id' => $room_cat,
            'room_name' => $room_name,
            'room_desc' => $room_description,
            'occupancy' => $occupancy,
            'no_of_adults' => $adults,
            'no_of_childs' => $child,
            'total_no_of_rooms' => $totroom,
            'room_critical_level' => $roomcritical,
            'no_of_rooms_left' => $noofroomleft,
            'room_policies' => $roompolicy
        );
        $this->db->where('sup_room_details_id', $sup_room_details_id);
        $this->db->where('sup_hotel_id', $sup_hotel_id);

        $this->db->update('sup_hotel_room_details', $data);
        return true;
    }

    function check_rooms($sup_hotel_id, $global_room_category_type_id) {
        $this->db->select('*');

        $this->db->from('sup_hotel_room_details');
        $this->db->where('sup_hotel_id', $sup_hotel_id);
        $this->db->where('global_room_category_type_id', $global_room_category_type_id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
	function add_room($sup_hotel_id, $hotel_code,$room_type_id, $room_name)	{
		$data = array(
            'sup_hotel_id' => $sup_hotel_id,
			'supplier_id' => $this->session->userdata('supplier_id'),
            'hotel_code' => $hotel_code,
            'room_type_id' => $room_type_id,
			'room_name' => $room_name
			);

        $this->db->insert('sup_hotel_room_details', $data);
        return true;			
	}

    function get_room_details($sup_hotel_id) {
        $query = $this->db->select('*')->from('sup_hotel_room_details')->where('sup_hotel_id', $sup_hotel_id)->get();
        if ($query->num_rows > 0) {
            $query->result();
        } else {
            return false;
        }
    }


    function get_amenity() {
        $query = $this->db->select('*')->from('global_amenity_list')->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function add_amenity($sup_hotel_id, $hotel_code,$ameid) {
        $data = array(
            'supplier_id' => $this->session->userdata('supplier_id'),
            'sup_hotel_id' => $sup_hotel_id,
            'hotel_code' => $hotel_code,
            'amenity_list_id' => $ameid
        );
        $this->db->insert('sup_hotel_facilities', $data);
        return true;
    }

    function get_hotel_code($sup_hotel_id) {
        $query = $this->db->select('*')->from('sup_hotels')->where('sup_hotel_id', $sup_hotel_id)->get();
        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function check_amenity($sup_hotel_id) {
        $query = $this->db->select('*')->from('sup_hotel_facilities')->where('sup_hotel_id', $sup_hotel_id)->get();
        if ($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update_amenity($sup_hotel_id, $ameid) {
        $data = array(
            'amenity_list_id' => $ameid
        );
        $this->db->where('sup_hotel_id', $sup_hotel_id);
        $this->db->update('sup_hotel_facilities', $data);
        return true;
    }

    function upload_images($sup_hotel_id, $hotel_code, $imagepath ,$ind) {
        $data = array(
            'sup_hotel_id' => $sup_hotel_id,
			'supplier_id' => $this->session->userdata('supplier_id'),
            'hotel_code' => $hotel_code,
            'image_path' => $imagepath,
            'image_type' => $ind,
        );
        $this->db->insert('sup_hotel_images', $data);
        return true;
    }

    function get_image($sup_hotel_id) {
        $query = $this->db->select('*')->from('sup_hotel_images')->where('sup_hotel_id', $sup_hotel_id)->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_rooms($sup_hotel_id) {
        $this->db->select('*');
        $this->db->from('sup_hotel_room_details');
        $this->db->where('sup_hotel_id', $sup_hotel_id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_room_name($id) {
        $this->db->select('category_type');
        $this->db->from('global_room_category_type');
        $this->db->where('global_room_category_type_id', $id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function edit_rooms($sup_hotel_id, $sup_room_details_id) {
        $this->db->select('*');
        $this->db->from('sup_hotel_room_details');
        $this->db->where('sup_hotel_id', $sup_hotel_id);
        $this->db->where('sup_room_details_id', $sup_room_details_id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_active_hotels() {
        $this->db->select('*');
        $this->db->from('sup_hotels');
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function manage_sup_hotel_status($sup_hotel_id, $status) {
        $data['status'] = $status;
        $where = "sup_hotel_id = '$sup_hotel_id'";
        if ($this->db->update('sup_hotels', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }
   

	public function manage_room_status($sup_room_details_id, $status) {
        $data['status'] = $status;
        $where = "sup_room_details_id = '$sup_room_details_id'";
        if ($this->db->update('sup_hotel_room_details', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }
    function view_room_detail($sup_hotel_id)
    {
        $this->db->select('*');
        $this->db->from('sup_hotel_room_period_details');
        $this->db->where('sup_hotel_id',$sup_hotel_id);
        $query=$this->db->get();
        if($query->num_rows>0)
        {
            return $query->result();
        }
        else{
            return false;
        }
    }
    function get_room_name_detail($id)
    {
        $this->db->select('*');
        $this->db->from('sup_hotel_room_details');
        $this->db->where('sup_room_details_id',$id);
        $query=$this->db->get();
        if($query->num_rows>0)
        {
            return $query->result();
        }
        else{
            return false;
        }
        
        
    }
	
	function changestatus_hotel($id) {
		$this->db->select('status');
		$this->db->from('sup_hotels');
		$this->db->where('sup_hotel_id', $id);
		$query = $this->db->get();
		if($query->num_rows>0)
        {
			$row = $query->row();
			if($row->status > 0) {
				$data = array (
					'status' => 0,
				);
				
			} else {
				$data = array (
					'status' => 1,
				);			
			}
			$where = "sup_hotel_id = '$id'";
			$this->db->update('sup_hotels', $data, $where);		
		}
	}
	
	function delete_image($id) {
	
		$this->db->where('sup_hotel_images_id', $id);
		$this->db->delete('sup_hotel_images'); 	
		
	}
	
	function delete_room($ids) {
		if(!empty($ids)) {
			if(is_array($ids)) {
				$this->db->where('sup_room_details_id', $ids);
			} else {
				$this->db->where('sup_room_details_id', $ids);			
			}
			//$this->db->where('supplier_id', $this->session->userdata('supplier_id'));
			$this->db->delete('sup_hotel_room_details');
		}
	}
}
