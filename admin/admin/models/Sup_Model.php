<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sup_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function check_email_availability($email) {
        $this->db->select('*')
                ->from('supplier_info')
                ->where('supplier_email', $email)
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return '';
    }

    public function add_sup($supplier_email, $supplier_password, $supplier_name, $title, $first_name, $middle_name, $last_name, $mobile_no, $office_phone_no, $address, $pin_code, $city, $state, $country) {
        $data = array(
            'supplier_email' => $supplier_email,
            'supplier_password' => $supplier_password,
            'supplier_name' => $supplier_name,
//            'currency_type' => $currency_type,
            'title' => $title,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'mobile_no' => $mobile_no,
            'office_phone_no' => $office_phone_no,
            'address' => $address,
            'pin_code' => $pin_code,
            'city' => $city,
            'state' => $state,
            'country' => $country,
//            'agent_logo' => $image_path,
            'status' => 1,
//            'supplier_type' => 1,
        );

        $this->db->set('register_date', 'NOW()', FALSE);

        $this->db->insert('supplier_info', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            $supplier_no = 'UTTSP' . $id . rand(1000, 9999);

            $data1 = array('supplier_no' => $supplier_no);
            $this->db->where('supplier_id', $id);
            $this->db->update('supplier_info', $data1);

            return true;
        } else {
            return false;
        }
    }
    public function get_sup_hotels() {
        $this->db->select('a.*,b.supplier_name,b.supplier_no,c.city_name')
                ->from('sup_hotels a')
			   ->join('supplier_info b', 'a.supplier_id = b.supplier_id','left')
			   ->join('glb_hotel_city_list c', 'a.hotel_city = c.id','left');
        $this->db->order_by('supplier_id', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }
	public function  get_sup_hotels_active() {
        $this->db->select('a.*,b.supplier_name,b.supplier_no,c.city_name')
                ->from('sup_hotels a')
			   ->join('supplier_info b', 'a.supplier_id = b.supplier_id','left')
			   ->join('glb_hotel_city_list c', 'a.hotel_city = c.id','left');
        $this->db->where('a.status', '1');				
        $this->db->order_by('a.supplier_id', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;	
	}
    public function get_sup_list() {
        $this->db->select('*')
                ->from('supplier_info');
        $this->db->order_by('supplier_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }
	
	public function sup_hotels_changestatus($id) {
		$this->db->select('admin_status');
		$this->db->from('sup_hotels');
		$this->db->where('sup_hotel_id', $id);
		$query = $this->db->get();
		if($query->num_rows>0)
        {
			$row = $query->row();
			if($row->admin_status > 0) {
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
    public function get_sup_list_active() {
        $this->db->select('*')
                ->from('supplier_info')
                ->where('status', 1);
        $this->db->order_by('supplier_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_sup_info_by_id($supplier_id) {
        $this->db->select('*')
                ->from('supplier_info')
                ->where('supplier_id', $supplier_id)
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $res = $query->result();
            return $res[0];
        }

        return false;
    }

    public function get_available_balance($agent_id) {
        $this->db->select('available_balance')
                ->from('agent_acc_summary')
                ->where('agent_id', $agent_id)
                ->order_by('acc_id', 'DESC')
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $res = $query->result();
            return $res[0]->available_balance;
        }

        return false;
    }

    public function update_sup($supplier_id, $supplier_email, $supplier_name, $title, $first_name, $middle_name, $last_name, $mobile_no, $office_phone_no, $address, $pin_code, $city, $state, $country) {
        $data = array(
            'supplier_name' => $supplier_name,
//            'currency_type' => $currency_type,
            'title' => $title,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'mobile_no' => $mobile_no,
            'office_phone_no' => $office_phone_no,
            'address' => $address,
            'pin_code' => $pin_code,
            'city' => $city,
            'state' => $state,
            'country' => $country,
//            'agent_logo' => $image_path,
        );

        $this->db->where('supplier_id', $supplier_id);
        //$this->db->update('agent_info', $data);
        $this->db->update('supplier_info', $data);
        return true;
    }

//      public function get_agent_info_by_id($supplier_id) {
//        $this->db->select('*')
//                ->from('supplier_info')
//                ->where('supplier_id', $supplier_id)
//                ->limit('1');
//        $query = $this->db->get();
//
//        if ($query->num_rows > 0) {
//            $res = $query->result();
//            return $res[0];
//        }
//
//        return false;
//    }

    public function update_sup_password($supplier_id, $password = '') {
        if (!empty($password)) {
            $data['supplier_password'] = $password;
            $where = "supplier_id = '$supplier_id'";
            if ($this->db->update('supplier_info', $data, $where)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function manage_agent_status($agent_id, $status) {
        $data['status'] = $status;
        $where = "agent_id = '$agent_id'";
        if ($this->db->update('agent_info', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_agent_acc_summary($agent_id) {
        $this->db->select('*')
                ->from('agent_acc_summary')
                ->where('agent_id', $agent_id)
                ->order_by('acc_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function add_transaction($agent_id, $agent_no, $transaction_type, $amount, $value_date, $transaction_mode, $bank, $branch, $city, $transaction_id, $remarks) {
        $dep_amount = '';
        if ($transaction_type == 'deposit') {
            $dep_amount = $amount;
        }

        $with_amount = '';
        if ($transaction_type == 'withdraw') {
            $with_amount = $amount;
        }

        $desc = $transaction_mode . '-' . $transaction_id . ', ' . $bank;

        $value_date = date('Y-m-d', strtotime($value_date));

        $this->db->select('available_balance')
                ->from('agent_acc_summary')
                ->where('agent_id', $agent_id)
                ->order_by('acc_id', 'DESC')
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $res = $query->result();
            $balance = $res[0]->available_balance;
        } else {
            $balance = 0;
        }

        $data = array(
            'agent_id' => $agent_id,
            'agent_no' => $agent_no,
            'transaction_summary' => $desc,
            'deposit_amount' => $dep_amount,
            'withdraw_amount' => $with_amount,
            'transaction_id' => $transaction_id,
            'bank' => $bank,
            'branch' => $branch,
            'city' => $city,
            'value_date' => $value_date,
            'remarks' => $remarks,
        );

        $this->db->set('transaction_datetime', 'NOW()', FALSE);
        if ($transaction_type == 'deposit')
            $this->db->set('available_balance', $balance + $amount, FALSE);
        else
            $this->db->set('available_balance', $balance - $amount, FALSE);

        $this->db->insert('agent_acc_summary', $data);
        //echo $this->db->last_query();exit;
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_active_agent_list() {
        $this->db->select('*')
                ->from('agent_info')
                ->where('status', 1);
        $this->db->order_by('agent_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_hotel_markup_list() {
        $this->db->select('*')
                ->from('b2b_markup_info')
                ->where('service_type', 1);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_flight_markup_list() {
        $this->db->select('*')
                ->from('b2b_markup_info')
                ->where('service_type', 2);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_car_markup_list() {
        $this->db->select('*')
                ->from('b2b_markup_info')
                ->where('service_type', 3);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    function delete_b2b_markup($markup_type, $service_type) {
        $where = "markup_type = '$markup_type' AND service_type = '$service_type'";
        if ($this->db->delete('b2b_markup_info', $where)) {
            return true;
        } else {
            return false;
        }
    }

    function add_b2b_markup($country, $agent_no, $api_name, $markup, $markup_type, $service_type) {
        $data = array(
            'country' => $country,
            'agent_no' => $agent_no,
            'api_name' => $api_name,
            'markup' => $markup,
            'markup_type' => $markup_type,
            'service_type' => $service_type,
            'status' => 1
        );

        $this->db->insert('b2b_markup_info', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return true;
        } else {
            return false;
        }
    }

    function delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country) {
        $where = "markup_type = '$markup_type'";
        if ($service_type != '') {
            $where .= "AND service_type = '$service_type'";
        }
        if ($country != '') {
            $where .= "AND country = '$country'";
        }
        if ($api_name != '') {
            $where .= "AND api_name = '$api_name'";
        }
        if ($agent != '') {
            $where .= "AND agent_no = '$agent'";
        }

        if ($this->db->delete('b2b_markup_info', $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function manage_b2b_markup_status($markup_id, $status) {
        $data['status'] = $status;
        $where = "markup_id = '$markup_id'";
        if ($this->db->update('b2b_markup_info', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    function delete_b2b_markup_status($markup_id) {
        $where = "markup_id = '$markup_id'";
        if ($this->db->delete('b2b_markup_info', $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_b2b_flight_booking_summary() {
        $this->db->select('fr.*,fp.*,a.agent_no,a.agency_name')
                ->from('flight_booking_reports fr')
                ->join('flight_booking_passengers fp', 'fr.AirlinersRefNo = fp.AirlinersRefNo')
                ->join('agent_info a', 'fr.agent_id = a.agent_id')
                ->where('fr.agent_id !=', 0)
                ->order_by('fr.report_id', 'DESC')
                ->group_by('fp.AirlinersRefNo');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_b2b_hotel_booking_summary() {
        $this->db->select('hr.*,hh.city as hotel_city,hh.*,hp.*,a.agent_no,a.agency_name')
                ->from('hotel_booking_reports hr')
                ->join('hotel_booking_hotels_info hh', 'hr.RefNo = hh.RefNo')
                ->join('hotel_booking_passengers_info hp', 'hr.RefNo = hp.RefNo')
                ->join('agent_info a', 'hr.agent_id = a.agent_id')
                ->where('hr.agent_id !=', 0)
                ->order_by('hr.hotel_booking_id', 'DESC')
                ->group_by('hp.RefNo');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_b2b_car_booking_summary() {
        $this->db->select('cr.*,cp.*,a.agent_no,a.agency_name')
                ->from('car_booking_reports cr')
                ->join('car_booking_passengers cp', 'cr.AirlinersRefNo = cp.AirlinersRefNo')
                ->join('agent_info a', 'cr.agent_id = a.agent_id')
                ->where('cr.agent_id !=', 0)
                ->order_by('cr.report_id', 'DESC')
                ->group_by('cp.AirlinersRefNo');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

}
