<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class B2c_Model extends CI_Model {
    private $user_id;
    private $user_no;

    function __construct() {
        parent::__construct();
        $this->user_id=$this->session->user_id;
        $this->user_no=$this->session->user_no;        
    }
    public function check_email_availability($loginEmailId) {
        $this->db->select('*');
        $this->db->from('user_info');
        // $this->db->where('user_name', $loginEmailId);
        // $this->db->where('user_email', $loginEmailId);
        if(is_numeric($loginEmailId)){
            $this->db->where('mobile_no', $loginEmailId);
        } else {
            $this->db->where('user_email', $loginEmailId);
        }
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return '';
    }

    public function insert_login_activity() {
        $user_no = $this->session->userdata('user_no');
        $session_id = $this->session->session_id;
        $ip_address = $this->input->ip_address();     
        $remote_ip = $_SERVER['REMOTE_ADDR'];

        $data = array('session_id' => $session_id,
            'user_no' => $user_no,
            'ip_address' => $ip_address,
            'remote_ip' => $remote_ip,            
        );

        if ($this->db->insert('user_login_history', $data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function add_user($data) {
        $this->db->insert('user_info', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            // echo 1;exit;
            $user_no = 'ETP'.rand(0000,1111).'U'.date('ymd');
            $data1 = array('user_no' => $user_no);
            $this->db->where('user_id', $id);
            $this->db->update('user_info', $data1);
            // echo $this->db->last_query();exit;
           return true;
        } else {
            return false;
        }
    }

    public function validate_credentials($loginEmailId, $loginPassword='') {
        $this->db->select('*');
        $this->db->from('user_info');
        // $this->db->where('user_name', $loginEmailId);
        // $this->db->where('user_email', $loginEmailId);
        if(is_numeric($loginEmailId)){
            $this->db->where('mobile_no', $loginEmailId);
        } else {
            $this->db->where('user_email', $loginEmailId);
        }
        if($loginPassword != ''){
            $this->db->where('user_password', $loginPassword);
        }
        $this->db->where('status', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    }

    public function insertOtp($loginEmailId,$otpnum){
        $data = array('otp' => $otpnum);
        if(is_numeric($loginEmailId)){
            $this->db->where('mobile_no', $loginEmailId);
        } else {
            $this->db->where('user_email', $loginEmailId);
        }
        if ($this->db->update('user_info', $data)) {
            return $otpnum;
        }
        return '';
    }

    public function validate_otp($loginEmailId, $otp) {
        $this->db->select('*');
        $this->db->from('user_info');
        $this->db->where('otp', $otp);
        // $this->db->where('user_name', $loginEmailId);
        if(is_numeric($loginEmailId)){
            $this->db->where('mobile_no', $loginEmailId);
        } else {
            $this->db->where('user_email', $loginEmailId);
        }
        
        $this->db->where('status', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    }

    public function validate_password_otp($loginEmailId, $otp) {
        $this->db->select('*');
        $this->db->from('user_info');
        $this->db->where('otp', $otp);
        // $this->db->where('user_name', $loginEmailId);
        if(is_numeric($loginEmailId)){
            $this->db->where('mobile_no', $loginEmailId);
        } else {
            $this->db->where('user_email', $loginEmailId);
        }
        
        $this->db->where('status', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    }

    public function removeOTP($loginEmailId){
        $data = array('otp' => '');
        if(is_numeric($loginEmailId)){
            $this->db->where('mobile_no', $loginEmailId);
        } else {
            $this->db->where('user_email', $loginEmailId);
        }
        if ($this->db->update('user_info', $data)) {
            return 1;
        }
        return '';
    }

    public function getUserInfo($user_id) {
        $this->db->select('*')
                ->from('user_info')
                ->where('user_id', $user_id)
                ->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    public function get_country_list() {
        $this->db->select('*')
                ->from('country');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function update_user($user_id, $data) {
        $this->db->where('user_id', $user_id);
        if ($this->db->update('user_info', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function update_password($user_id, $password='') {
        if (!empty($password)) {
            $data['user_password'] = $password;
            $this->db->where('user_id', $user_id);
            if ($this->db->update('user_info', $data)) {
                return true;
            }
        }
        return false;
    }

     public function restore_password($loginEmailId, $password='') {
        if (!empty($password)) {
            $data['user_password'] = $password;
            // $this->db->where('user_email', $loginEmailId);
            if(is_numeric($loginEmailId)){
                $this->db->where('mobile_no', $loginEmailId);
            } else {
                $this->db->where('user_email', $loginEmailId);
            }
            if ($this->db->update('user_info', $data)) {
                return true;
            }
        }
        return false;
    }

    public function get_forgot_password($loginEmailId) {
        $this->db->select('*');
        $this->db->from('user_info');
        if(is_numeric($loginEmailId)){
            $this->db->where('mobile_no', $loginEmailId);
        } else {
            $this->db->where('user_email', $loginEmailId);
        }
        // $this->db->where('user_email', $loginEmailId);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    public function update_user_activation_key($activation_key,$user_no) {
        $data = array('otp' => $activation_key,);
        // $data = array('activation_key' => $activation_key,);
        $this->db->where('user_no',$user_no);
        if ($this->db->update('user_info', $data)) {
            return true;
        }
        return false;
    }

    public function get_b2c_flight_booking_summary($user_id) {
        $this->db->select('fr.*,fp.*')
                ->from('flight_booking_reports fr')
                ->join('flight_booking_passengers fp', 'fr.uniqueRefNo = fp.uniqueRefNo')
                ->where('fr.user_id', $user_id)
                ->order_by('fr.report_id', 'DESC')
                ->group_by('fp.uniqueRefNo');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_b2c_hotel_booking_summary($user_id) {
        $this->db->select('hr.*,hh.city as hotel_city,hh.*,hp.*');
        $this->db->from('hotel_booking_reports hr');
        $this->db->join('hotel_booking_hotels_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo','LEFT');
        $this->db->join('hotel_booking_passengers_info hp', 'hr.uniqueRefNo = hp.uniqueRefNo','LEFT');
        $this->db->where('hr.user_id', $user_id);
        
        $this->db->group_by('hr.uniqueRefNo');
        $query = $this->db->get();      
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
     public function get_b2c_bus_booking_summary($user_id) {
        $this->db->select('hr.*,hp.*');
        // $this->db->select('hr.*,hh.*,hp.*');
        $this->db->from('bus_booking_reports hr');
        // $this->db->join('holiday_booking_hotels_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo','LEFT');
        $this->db->join('bus_booking_pass_info hp', 'hr.booking_unique_reference_no = hp.uniqueRefNo','LEFT');
        $this->db->where('hr.user_id', $user_id);
        $this->db->group_by('hr.booking_unique_reference_no');
        $query = $this->db->get();      
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function add_deposit_request($user_id, $user_no, $amount, $value_date, $transaction_mode, $bank, $branch, $city, $transaction_id, $remarks) {
        $this->db->select('*')
                ->from('user_acc_summary')
                ->where('user_id', $this->user_id)
                ->where('status', 'Pending')
                ->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
           return false;
        }
        $desc = $transaction_mode . '-' . $transaction_id . ', ' . $bank;
        $value_date = date('Y-m-d', strtotime(str_replace('/', '-', $value_date)));
        // echo $value_date;exit;
        $this->db->select('available_balance')
                ->from('user_acc_summary')
                ->where('user_no', $user_no)
                 ->order_by('transaction_datetime', 'DESC')
                ->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $res = $query->result();
            $balance = $res[0]->available_balance;
        } else {
            $balance = 0;
        }
        $data = array(
            'user_id' => $user_id,
            'user_no' => $user_no,
            'user_parent'=>$this->session->userdata('user_parent'),
            'transaction_summary' => $desc,
            'deposit_amount' => $amount,
            'transaction_id' => $transaction_id,
            'bank' => $bank,
            'branch' => $branch,
            'city' => $city,
            'value_date' => $value_date,
            'remarks' => $remarks,
            'available_balance' => $balance,
            'status' => 'Pending',
        );
        $this->db->set('transaction_datetime', 'NOW()', FALSE);
        $this->db->insert('user_acc_summary', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_user_deposit_details() {
        
        $this->db->select('*')
                ->from('user_acc_summary')
                ->where('user_id', $this->user_id)
                ->order_by('transaction_datetime','ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function get_user_acc_summary($user_id) {   
        $this->db->select('*')
        ->from('user_acc_summary')
        ->where('user_id',$user_id)
        ->order_by('acc_id','DESC')
        ->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0) {      
            return $query->row();
        }
        return false;
    }
    
    public function get_b2c_flight_booked_passanger_details($title, $user_id){
        // $user_id=19;
        $this->db->select('fr.*,fp.*')
                ->from('flight_booking_reports fr')
                ->join('flight_booking_passengers fp', 'fr.uniqueRefNo = fp.uniqueRefNo')
                ->where('fr.user_id', $user_id)
                ->order_by('fr.report_id', 'DESC')
                ->group_by('fp.uniqueRefNo');
                $this->db->like('first_name', $title);
                $this->db->limit(10);
        return $this->db->get()->result();
        
    }
    
}