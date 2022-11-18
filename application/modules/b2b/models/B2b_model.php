<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class B2b_Model extends CI_Model {
    private $agent_id;
    private $agent_no;

    function __construct() {
        parent::__construct();
        $this->agent_id=$this->session->agent_id;
        $this->agent_no=$this->session->agent_no;        
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
    public function getAgentInfo() {
        $this->db->select('*')
                ->from('agent_info')
                ->where('agent_id', $this->agent_id)
                ->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }

    public function getAgentInfoByID($agent_id) {
        $this->db->select('*')
                ->from('agent_info')
                ->where('agent_id', $agent_id)
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
    }
    public function check_email_availability($email) {
        $this->db->select('*')
                ->from('agent_info')
                ->where('agent_email', $email)
                ->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    public function add_agent($data) {
        // echo '<pre>';print_r($data);exit;
        $this->db->set('register_date', 'NOW()', FALSE);
        $this->db->insert('agent_info', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            $agent_no = 'TFB'.rand(0000,1111).'C'.date('ymd');
            $data1 = array('agent_no' => $agent_no);
            $this->db->where('agent_id', $id);
            $this->db->update('agent_info', $data1);
            return $id;
        } else {
            return false;
        }
    }

    public function update_agent($agent_id, $data) {
        $this->db->where('agent_id', $agent_id);
        if ($this->db->update('agent_info', $data)) {
            return true;
        }
        return false;
    }

    public function validate_credentials($loginEmailId, $loginPassword,$user_type='') {
        $this->db->select('*');
        $this->db->from('agent_info');
        if(is_numeric($loginEmailId)){
            $this->db->where('mobile_no', $loginEmailId);
        } else {
            $this->db->where('agent_email', $loginEmailId);
        }
        // $this->db->where('agent_email', $loginEmailId);
        $this->db->where('agent_password', md5($loginPassword));
        $this->db->where('status', 1);
        $this->db->where('agent_type', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }

    public function validate_credentials_otp($loginEmailId, $loginPassword='') {
        $this->db->select('*');
        $this->db->from('agent_info');
        // $this->db->where('user_name', $loginEmailId);
        // $this->db->where('user_email', $loginEmailId);
        if(is_numeric($loginEmailId)){
            $this->db->where('mobile_no', $loginEmailId);
        } else {
            $this->db->where('agent_email', $loginEmailId);
        }
        if($loginPassword != ''){
            $this->db->where('agent_password', $loginPassword);
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
        $this->db->from('agent_info');
        $this->db->where('otp', $otp);
        // $this->db->where('user_name', $loginEmailId);
        if(is_numeric($loginEmailId)){
            $this->db->where('mobile_no', $loginEmailId);
        } else {
            $this->db->where('agent_email', $loginEmailId);
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

    public function insert_login_activity() {
        $agent_id=$this->session->agent_id;
        $session_id = $this->session->session_id;
        $user_agent = $this->session->all_userdata();
        $remote_ip = $_SERVER['REMOTE_ADDR'];
        $data = array('session_id' => $session_id,
            'agent_id' => $agent_id,
            'ip_address' => $remote_ip,
            'remote_ip' => $remote_ip,
            'user_agent' => serialize($user_agent)
        );
        if ($this->db->insert('agent_login_history', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertOtp($loginEmailId,$otpnum){
        $data = array('otp' => $otpnum);
        // $this->db->where('agent_email', $loginEmailId);
        if(is_numeric($loginEmailId)){
            $this->db->where('mobile_no', $loginEmailId);
        } else {
            $this->db->where('agent_email', $loginEmailId);
        }
        if ($this->db->update('agent_info', $data)) {
            return $otpnum;
        }
        return '';
    }

    public function removeOTP($loginEmailId){
        $data = array('otp' => '');
        if(is_numeric($loginEmailId)){
            $this->db->where('mobile_no', $loginEmailId);
        } else {
            $this->db->where('agent_email', $loginEmailId);
        }
        if ($this->db->update('agent_info', $data)) {
            return 1;
        }
        return '';
    }

    public function corporate_validate_otp($loginEmailId, $otp) {
        $this->db->select('*');
        $this->db->from('agent_info');
        $this->db->where('otp', $otp);
        // $this->db->where('user_name', $loginEmailId);
        if(is_numeric($loginEmailId)){
            $this->db->where('mobile_no', $loginEmailId);
        } else {
            $this->db->where('agent_email', $loginEmailId);
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

    public function get_b2b_flight_booking_summary($fromdate='',$todate='',$uniqueRefNo='',$status='',$email='',$mobile='') {
        $this->db->select('fr.*,fp.*,fr.BookingReferenceId as fr_BookingRefId, ,fr.uniqueRefNo as fr_uniqueRefNo')
                ->from('flight_booking_reports fr')
                ->join('flight_booking_passengers fp', 'fr.uniqueRefNo = fp.uniqueRefNo')
                ->where('fr.agent_id', $this->agent_id);


        if($fromdate != ''){
          $this->db->where('fr.updated_datetime >=', $fromdate.' 00:00:00');
        }
        if($todate != ''){
          $this->db->where('fr.updated_datetime <=', $todate.' 00:00:00');
        }
        if($uniqueRefNo != ''){
          $this->db->where('fr.uniqueRefNo', $uniqueRefNo);
        }
        if($status != ''){
          $this->db->where('fr.BookingStatus', $status);
        }
        if($email != ''){
          $this->db->where('fp.email', $email);
        }
        if($mobile != ''){
          $this->db->where('fp.mobile', $mobile);
        }
        $this->db->order_by('fr.report_id', 'DESC');
        $this->db->group_by('fp.uniqueRefNo');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function get_b2b_hotel_booking_summary($fromdate='',$todate='',$uniqueRefNo='',$status='',$email='',$mobile='') {
        $this->db->select('hr.*,hh.city as hotel_city,hh.*,hp.*');
        $this->db->from('hotel_booking_reports hr');
        $this->db->join('hotel_booking_hotels_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo','LEFT');
        $this->db->join('hotel_booking_passengers_info hp', 'hr.uniqueRefNo = hp.uniqueRefNo','LEFT');
        $this->db->where('hr.agent_id', $this->agent_id);
        
        if($fromdate != ''){
          $this->db->where('hr.Booking_Date >=', $fromdate);
        }
        if($todate != ''){
          $this->db->where('hr.Booking_Date <=', $todate);
        }
        if($uniqueRefNo != ''){
          $this->db->where('hr.uniqueRefNo', $uniqueRefNo);
        }
        if($status != ''){
          $this->db->where('hr.Booking_Status', $status);
        }
        if($email != ''){
          $this->db->where('hp.email', $email);
        }
        if($mobile != ''){
          $this->db->where('hp.mobile', $mobile);
        }
        $this->db->group_by('hr.uniqueRefNo');
        $query = $this->db->get();      
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_b2b_bus_booking_summary($fromdate='',$todate='',$uniqueRefNo='',$status='',$email='',$mobile='') {
        $this->db->select('br.*,bp.*');
        $this->db->from('bus_booking_reports br');
       
        $this->db->join('bus_booking_pass_info bp', 'br.booking_unique_reference_no  = bp.uniqueRefNo','LEFT');
        $this->db->where('br.agent_id', $this->agent_id);
        
        if($fromdate != ''){
          $this->db->where('br.booking_date >=', $fromdate);
        }
        if($todate != ''){
          $this->db->where('br.booking_date <=', $todate);
        }
        if($uniqueRefNo != ''){
          $this->db->where('br.uniqueRefNo', $uniqueRefNo);
        }
        if($status != ''){
          $this->db->where('br.booking_status', $status);
        }
        if($email != ''){
          $this->db->where('br.email', $email);
        }
        if($mobile != ''){
          $this->db->where('br.mobile', $mobile);
        }
        $this->db->group_by('br.booking_unique_reference_no');
        $query = $this->db->get();    
        
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_b2b_car_booking_summary($fromdate='',$todate='',$uniqueRefNo='',$status='',$email='',$mobile='') {
        $this->db->select('cr.*,cp.*');
        $this->db->from('car_booking_reports cr');
       
        $this->db->join('car_booking_passengers cp', 'cr.uniqueRefNo  = cp.uniqueRefNo','LEFT');
        $this->db->where('cr.agent_id', $this->agent_id);
        
        if($fromdate != ''){
          $this->db->where('cr.Booking_Date >=', $fromdate);
        }
        if($todate != ''){
          $this->db->where('cr.Booking_Date <=', $todate);
        }
        if($uniqueRefNo != ''){
          $this->db->where('cr.uniqueRefNo', $uniqueRefNo);
        }
        if($status != ''){
          $this->db->where('cr.BookingStatus', $status);
        }
        if($email != ''){
          $this->db->where('cp.email', $email);
        }
        if($mobile != ''){
          $this->db->where('cp.mobile', $mobile);
        }
        $this->db->group_by('cp.uniqueRefNo');
        $query = $this->db->get();    
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_b2b_transfer_booking_summary($fromdate='',$todate='',$uniqueRefNo='',$status='',$email='',$mobile='') {
        $this->db->select('tr.*,tp.*');
        $this->db->from('transfer_booking_reports tr');
       
        $this->db->join(' transfer_booking_passengers tp', 'tr.uniqueRefNo  = tp.uniqueRefNo','LEFT');
        $this->db->where('tr.agent_id', $this->agent_id);
        
        if($fromdate != ''){
          $this->db->where('tr.TransferDate >=', $fromdate);
        }
        if($todate != ''){
          $this->db->where('tr.TransferDate <=', $todate);
        }
        if($uniqueRefNo != ''){
          $this->db->where('tr.uniqueRefNo', $uniqueRefNo);
        }
        if($status != ''){
          $this->db->where('tr.BookingStatus', $status);
        }
        if($email != ''){
          $this->db->where('tp.email', $email);
        }
        if($mobile != ''){
          $this->db->where('tp.mobile', $mobile);
        }
        $this->db->group_by('tp.uniqueRefNo');
        $query = $this->db->get();    
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function get_b2b_activity_booking_summary($fromdate='',$todate='',$uniqueRefNo='',$status='',$email='',$mobile='') {
        $this->db->select('ar.*,ap.*');
        $this->db->from('activity_booking_reports ar');
       
        $this->db->join(' activity_booking_passengers ap', 'ar.uniqueRefNo  = ap.uniqueRefNo','LEFT');
        $this->db->where('ar.agent_id', $this->agent_id);
        
        /*if($fromdate != ''){
          $this->db->where('ar.InvoiceCreatedOn >=', $fromdate);
        }
        if($todate != ''){
          $this->db->where('ar.InvoiceCreatedOn <=', $todate);
        }*/
        if($uniqueRefNo != ''){
          $this->db->where('ar.uniqueRefNo', $uniqueRefNo);
        }
        if($status != ''){
          $this->db->where('ar.BookingStatus', $status);
        }
        if($email != ''){
          $this->db->where('ap.email', $email);
        }
        if($mobile != ''){
          $this->db->where('ap.mobile', $mobile);
        }
        $this->db->group_by('ap.uniqueRefNo');
        $query = $this->db->get();    
        
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function get_agent_markup_manager($agent_no) {
        $this->db->select('*')
                ->from('agent_markup_manager')
                ->where('agent_no', $agent_no)
                ->order_by('markup_id', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function add_markup($agent_no, $service_type, $markup,$markup_process) {
        $this->db->where('agent_no', $agent_no)
                ->where('service_type', $service_type)
                // ->where('markup_process', $markup_process)
                ->delete('agent_markup_manager');
        $data = array(
            'agent_no' => $agent_no,
            'service_type' => $service_type,
            'markup_process' => $markup_process,
            'markup' => $markup,
            'status' => 1,
        );

        $this->db->insert('agent_markup_manager', $data);
        $id = $this->db->insert_id();
        // echo $id;exit;
        if ($id != '') {
            return true;
        }
        return false;
    }
    public function add_deposit_request($agent_id, $agent_no, $amount, $value_date, $transaction_mode, $bank, $branch, $city, $transaction_id, $remarks, $reference_id) {
        $this->db->select('*')
                ->from('agent_acc_summary')
                ->where('agent_id', $this->agent_id)
                ->where('status', 'Pending')
                ->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
           return false;
        }
        $desc = $transaction_mode . '-' . $transaction_id . ', ' . $bank;
        $value_date = date('Y-m-d', strtotime($value_date));
        $this->db->select('available_balance')
				->from('agent_acc_summary')
				->where('agent_no', $agent_no)
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
            'agent_id' => $agent_id,
            'agent_no' => $agent_no,
            'agent_parent'=>$this->session->userdata('agent_parent'),
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
            'reference_id' => $reference_id
        );
        $this->db->set('transaction_datetime', 'NOW()', FALSE);
        $this->db->insert('agent_acc_summary', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return true;
        } else {
            return false;
        }
    }

    public function add_deposit_payment($agent_id, $agent_no, $amount, $value_date, $transaction_mode, $transaction_id, $remarks) {
        $this->db->select('*')
                ->from('agent_acc_summary')
                ->where('agent_id', $this->agent_id)
                ->where('status', 'Pending')
                ->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
           return false;
        }
        $desc = $transaction_mode . '-' . $transaction_id;
        $value_date = date('Y-m-d', strtotime($value_date));
        $this->db->select('available_balance')
				->from('agent_acc_summary')
				->where('agent_no', $agent_no)
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
            'agent_id' => $agent_id,
            'agent_no' => $agent_no,
            'agent_parent'=>$this->session->userdata('agent_parent'),
            'transaction_summary' => $desc,
            'deposit_amount' => $amount,
            'transaction_id' => $transaction_id,
            'value_date' => $value_date,
            'remarks' => $remarks,
			'available_balance' => $balance+$amount,
            'status' => 'Accepted',
        );
        $this->db->set('transaction_datetime', 'NOW()', FALSE);
        $this->db->set('approve_date', 'NOW()', FALSE);
        $this->db->insert('agent_acc_summary', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return true;
        } else {
            return false;
        }
    }


    public function get_agent_deposit_details() {
        
        $this->db->select('*')
                ->from('agent_acc_summary')
                ->where('agent_id', $this->agent_id)
                ->order_by('transaction_datetime','DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function get_agent_acc_summary($agent_id) {   
        $this->db->select('*')
        ->from('agent_acc_summary')
        ->where('agent_id',$agent_id)
        ->order_by('acc_id','DESC')
        ->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0) {      
            return $query->row();
        }
        return false;
    }
    
    public function get_forgot_password($loginEmailId) {
        $this->db->select('*');
        $this->db->from('agent_info');
        if(is_numeric($loginEmailId)){
            $this->db->where('mobile_no', $loginEmailId);
        } else {
            $this->db->where('agent_email', $loginEmailId);
        }
        $this->db->where('agent_email', $loginEmailId);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function update_agent_activation_key($activation_key,$agent_no) {
		$data = array('otp' => $activation_key,);
		$this->db->where('agent_no',$agent_no);
        if ($this->db->update('agent_info', $data)) {
            return true;
        }
        return false;
    }

    public function update_password($agent_id, $password='') {
        if (!empty($password)) {
            $data['agent_password'] = $password;
            $this->db->where('agent_id', $agent_id);
            if ($this->db->update('agent_info', $data)) {
                return true;
            }
        }
        return false;
    }

    public function restore_password($loginEmailId, $password='') {
        if (!empty($password)) {
            $data['agent_password'] = $password;
            if(is_numeric($loginEmailId)){
                $this->db->where('mobile_no', $loginEmailId);
            } else {
                $this->db->where('agent_email', $loginEmailId);
            }
            // $this->db->where('agent_email', $loginEmailId);
            if ($this->db->update('agent_info', $data)) {
                return true;
            }
        }
        return false;
    }

    function get_agent_available_balance() {	 
        $this->db->select('available_balance')
                 ->from('agent_acc_summary')
                 ->where('agent_no', $this->agent_no)
                 ->where('agent_id', $this->agent_id)
                 ->order_by('transaction_datetime', 'DESC')
                 ->limit('1');
         $query = $this->db->get(); 
         if ($query->num_rows() > 0) {
             $res = $query->result();
             $balance = $res[0]->available_balance;
         } else {
             $balance = 0;
         }         
         return  $balance;	
     }

     // Notification
     public function notification() {
        $this->db->select('*')
                ->from('Notification')
                ->where('agent_type', 'b2b')
                ->limit(1);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }

    public function get_agentDeposit_charge()
    {
        $this->db->where('service_type', '8');
        $this->db->where('status', '1');        
        $this->db->from('payment_gateway');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $res = $query->result();
            $charge = $res[0]->charge;
        } else {
            $charge = 0;
        }         
        return  $charge;
        
    }
}