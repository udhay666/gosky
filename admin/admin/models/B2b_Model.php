<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class B2B_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
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
        return '';
    }
/*  public function add_agent($data) {

        // echo '<pre/>';print_r($data);exit;
        $this->db->set('register_date', 'NOW()', FALSE);
        $this->db->insert('agent_info', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            $agent_no = 'GRG' . date('ym') . rand(1000, 9999);
            $data1 = array('agent_no' => $agent_no);
            $this->db->where('agent_id', $id);
            $this->db->update('agent_info', $data1);
            return $agent_no;
        } else {
            return false;
        }
    }*/

        public function add_agent($agent_email, $agent_password, $agency_name, $currency_type, $title, $first_name, $middle_name, $last_name, $mobile_no, $office_phone_no, $address, $pin_code, $city, $state, $country, $image_path, $tan_no, $pan_no,$agent_type) {
        $data = array(
            'agent_email' => $agent_email,
            'agent_password' => $agent_password,
            'agency_name' => $agency_name,
            'currency_type' => $currency_type,
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
            'agent_logo' => $image_path,
            'status' => 1,
            'agent_type' => $agent_type,
            'PAN_no' => $pan_no,
            'TAN_no' => "123"
            );

        $this->db->set('register_date', 'NOW()', FALSE);

        $this->db->insert('agent_info', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            $agent_no = 'BIZZ' . $id . rand(1000, 9999);

            $data1 = array('agent_no' => $agent_no);
            $this->db->where('agent_id', $id);
            $this->db->update('agent_info', $data1);

            return true;
        } else {
            return false;
        }
    }
    public function get_agent_manage_list() {
        
        $this->db->select('*')
        ->from('agent_info');
        $this->db->order_by('agent_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }
    public function get_agent_list($city = '', $state = '', $fromdate = '', $todate = '', $creditbalance = '', $agentname = '') {
        $showtoday = true;
        $this->db->select('*')
            ->from('agent_info');
        // ->join('group_info gr', 'af.assign_agent_flight = gr.group_id');
        if ($city != '') {
            $where1 = "city LIKE '%" . $city . "%'";
            $this->db->where($where1);
            $showtoday = false;
        }
        if ($state != '') {
            $where2 = "city LIKE '%" . $state . "%'";
            $this->db->where($where2);
            $showtoday = false;
        }
        if ($fromdate != '') {
            $this->db->where('register_date >=', $fromdate);
            $showtoday = false;
        }
        if ($todate != '') {
            $this->db->where('register_date <=', $todate);
            $showtoday = false;
        }
        /*if ($creditbalance != '') {
            $this->db->where('creditbalance >', $creditbalance);
            $showtoday = false;
        }*/
        if ($agentname != '') {
            $this->db->where('agent_no', $agentname);
            $showtoday = false;
        }
        // if ($showtoday == 1) {
        //     $last_month = date('Y-m-d', strtotime('-7 days'));
        //     $this->db->where('register_date >=', $last_month . ' 00:00:00');
        // }
        $this->db->order_by('agent_id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function get_agent_list1() {
        $showtoday = true;
        $this->db->select('agent_no,agency_name')
            ->from('agent_info');

        $this->db->order_by('agent_id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_agent_group($id) {
        $this->db->select('group_name')
            ->from('group_info')
            ->where('group_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $obj = $query->row();
            return $obj->group_name;
        }
    }
    public function get_agent_markups() {
        $this->db->select('*');
        $this->db->from('agent_markup_manager');
        $this->db->order_by('markup_id', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function get_agent_info_by_id($agent_id) {
        $this->db->select('*')
            ->from('agent_info')
            ->where('agent_id', $agent_id)
            ->limit('1');
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res[0];
        }
        return false;
    }

    public function flightbookingcount($agent_id, $type, $from = '', $to = '') {
        $this->db->select_sum('totalfare')
            ->from('flight_booking_reports')
            ->where('agentid', $agent_id);
        $this->db->where('servicetype', $type);
        if (!empty($from)) {
            $this->db->where('bookingdate >=', $from);
        }
        if (!empty($to)) {
            $this->db->where('bookingdate <=', $to);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    public function busbookingcount($agent_id, $from, $to) {
        $from = str_replace(' 00:00:00', '', $from);
        $to = str_replace(' 00:00:00', '', $to);

        $this->db->select_sum('total_fare')
            ->from('bus_booking_reports')
            ->where('agent_id', $agent_id);
        if (!empty($from)) {
            $this->db->where('booking_date >=', $from);
        }
        if (!empty($to)) {
            $this->db->where('booking_date <=', $to);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
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
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res[0]->available_balance;
        }
        return false;
    }

    public function get_holi_query_reports($agent_id = '', $from_date = '', $to_date = '') {
        $this->db->select('*');
        $this->db->from('holiday_pac_req');
        if ($agent_id == '') {
            $this->db->where('agent_id !=', 0);
        } else {
            $this->db->where('agent_id', $agent_id);
        }
        if ($from_date) {
            $this->db->where('booking_date >=', $from_date);
        }
        if ($to_date != '') {
            $this->db->where('booking_date >=', $to_date);
        }
        $query = $this->db->get();
        //$this->dd_ex($query);
        if ($query->num_rows() > 0) {
            return array($query->result(), $query);
        } else {
            return array('', '');
        }
    }
    public function update_agent($data, $agent_id) {
        $this->db->where('agent_id', $agent_id);
        $this->db->update('agent_info', $data);
    }

    public function update_agent_password($agent_id, $password = '') {
        if (!empty($password)) {
            $data['agent_password'] = $password;
            $where = "agent_id = '$agent_id'";
            if ($this->db->update('agent_info', $data, $where)) {
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
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function get_acc_summary($agent_id) {
        $this->db->select('*')
            ->from('agent_acc_summary')
            ->where('agent_id', $agent_id)
            ->order_by('transaction_datetime', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function add_transaction($agent_id, $agent_no, $transaction_type, $amount, $value_date, $transaction_mode, $bank, $branch, $city, $transaction_id, $remarks) {
        $dep_amount = 0;
        if ($transaction_type == 'deposit') {
            $dep_amount = $amount;
        }
        $with_amount = 0;
        if ($transaction_type == 'withdraw') {
            $with_amount = $amount;
        }
        $desc = $transaction_mode . '-' . $transaction_id . ', ' . $bank;
        $value_date = date('Y-m-d', strtotime($value_date));
        $balance = $this->get_agent_available_balance($agent_no);
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
        if ($transaction_type == 'deposit') {
            $this->db->set('available_balance', $balance + $amount, FALSE);
        } else {
            $this->db->set('available_balance', $balance - $amount, FALSE);
        }

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
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function get_discount_markup_list() {
        $this->db->select('*')
            ->from('b2b_incentives');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function get_flight_markup_list() {
        $this->db->select('*')
            ->from('b2b_markup_info')
            ->where('service_type', 2);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
     public function get_transfer_markup_list() {
        $this->db->select('*')
            ->from('b2b_markup_info')
            ->where('service_type', 5);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function get_car_markup_list() {
        $this->db->select('*')
            ->from('b2b_markup_info')
            ->where('service_type', 4);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function get_bus_markup_list() {
        $this->db->select('*')
            ->from('b2b_bus_markup');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_bus_markup_b2blist() {
        $this->db->select('*')
            ->from('b2b_markup_info')
            ->where('service_type', 3);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_hotel_markup_list() {
        $this->db->select('*')
            ->from('b2b_markup_info')
            ->where('service_type', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function get_activity_markup_list() {
        $this->db->select('*')
            ->from('b2b_markup_info')
            ->where('service_type', 7);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function get_holiday_markup_list() {
        $this->db->select('*')
            ->from('b2b_markup_info')
            ->where('service_type', 8);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function get_apart_markup_list() {
        $this->db->select('*')
            ->from('b2b_markup_info')
            ->where('service_type', 5);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
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
    function add_b2b_markup($country, $agent_no, $api_name, $markup_process, $markup, $markup_type, $service_type) {
        $data = array(
            'country' => $country,
            'agent_no' => $agent_no,
            'api_name' => $api_name,
            'airline' => $airline_name,
            'markup_process' => $markup_process,
            'markup' => $markup,
            // 'transaction_mode'=> $transaction_mode,
            'markup_type' => $markup_type,
            'service_type' => $service_type,
            'status' => 1,
        );
        // echo '<pre/>';print_r($data);exit;
        $this->db->insert('b2b_markup_info', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return true;
        } else {
            return false;
        }
    }
    function add_b2b_markup_hotel($hotel, $country, $agent_no, $api_name, $markup_process, $markup, $markup_type, $service_type) {
        $data = array(
            'country' => $country,
            'agent_no' => $agent_no,
            'api_name' => $api_name,
            'markup_process' => $markup_process,
            'markup' => $markup,
            'markup_type' => $markup_type,
            'service_type' => $service_type,
            'status' => 1,
            'hotel' => $hotel,
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
        if ($hotel != '') {
            $where .= "AND hotel = '$hotel'";
        }
        if ($this->db->delete('b2b_markup_info', $where)) {
            return true;
        } else {
            return false;
        }
    }
    function delete_b2b_markup_new_hotel($markup_type, $service_type, $agent, $api_name, $country, $hotel) {
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
        if ($hotel != '') {
            $where .= "AND hotel = '$hotel'";
        }
        if ($this->db->delete('b2b_markup_info', $where)) {
//echo $this->db->last_query();exit;
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
    // public function get_b2b_flight_booking_summary($agent_id = '', $status = '', $fromdate = '', $todate = '', $bookingdate = '', $uniquerefno = '', $pnr = '', $first_name = '') {
    //     //print_r($agent_id);exit;
    //     $showtoday = true;
    //     $this->db->select('fr.*,fp.*,agi.*,fr.BookingStatus as flightstatus')
    //         ->from('flight_booking_reports fr')
    //         ->where('fr.mode', 'onward')
    //         ->join('flight_booking_passengers fp', 'fr.uniquerefno = fp.uniqueRefNo')
    //         ->join("(select agent_email,agent_no,agency_name,agent_id from agent_info) agi", 'fr.agent_id = agi.agent_id');
    //     // ->join('agent_info a', 'fr.agentid = a.agent_id');
    //     if ($agent_id == '') {
    //         $this->db->where('fr.agent_id !=', 0);
    //     } else {
    //         $this->db->where('fr.agent_id', $agent_id);
    //     }
    //     if ($status != '') {
    //         $this->db->where('fr.status', $status);
    //         $showtoday = false;
    //     }
    //     if ($fromdate != '') {
    //         $this->db->where('fr.Booking_Date >=', $fromdate . ' 00:00:00');
    //         $showtoday = false;
    //     }
    //     if ($todate != '') {
    //         $this->db->where('fr.Booking_Date <=', $todate . ' 23:59:00');
    //         $showtoday = false;
    //     }
    //     if ($bookingdate != '') {
    //         // $this->db->where('fr.bookingdate <=', $bookingdate);$showtoday=false;
    //         $this->db->where("FIND_IN_SET('$Booking_Date',fr.departuredate) !=", 0);
    //         $showtoday = false;
    //     }
    //     if ($uniquerefno != '') {
    //         $this->db->where('fr.uniquerefno', $uniquerefno);
    //         $showtoday = false;
    //     }
    //     if ($pnr != '') {
    //         $this->db->where('fr.pnr', $pnr);
    //         $showtoday = false;
    //     }
    //     if ($first_name != '') {
    //         $this->db->where('fp.first_name', $first_name);
    //         $showtoday = false;
    //     }

    //     if ($showtoday == true) {
    //         $this->db->where('fr.Booking_Date >=', date("Y-m-d") . ' 00:00:00');
    //     }
    //     // $this->db->order_by('fr.report_id', 'DESC')
    //         // ->group_by('fp.uniqueRefNo');
    //     $query = $this->db->get();
    //     // echo $this->db->last_query();
    //     if ($query->num_rows() > 0) {
    //         return array($query->result(), $query);
    //     }
    //     return false;
    // }
     public function get_b2b_flight_booking_summary($agent_id = '', $status = '', $fromdate =null, $todate =null, $bookingdate = '', $uniquerefno = '', $pnr = '', $first_name = ''){
        $this->db->select('cr.*,cp.*,a.agent_no,a.agency_name')
            ->from('flight_booking_reports cr')
            ->join('flight_booking_passengers cp', 'cr.uniqueRefNo = cp.uniqueRefNo')
            ->join('agent_info a', 'cr.agent_id = a.agent_id');
        if ($agent_id == '') {
            $this->db->where('cr.agent_id !=', 0);
        } else {
            $this->db->where('cr.agent_id', $agent_id);
        }
        if ($fromdate != '') {
            $this->db->where('cr.Booking_Date >=', $from_date);
        }
        if ($todate != '') {
            $this->db->where('cr.Booking_Date <=', $to_date);
        }
        // $this_db->order_by('cr.report_id', 'DESC')
        //     ->group_by('cp.uniqueRefNo');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return array($query->result(),$query);
        }
        return false;
    }
    public function get_b2b_hotel_booking_summary($to_date=null, $from_date=null, $agent_id = '') {
        // print_r($Status);
        $this->db->select('hr.*,hh.city as hotel_city,hh.*,hp.*,hr.agent_id,hh.address as address,hh.city as city')
            ->from('hotel_booking_reports hr')
            ->join('hotel_booking_hotels_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo')
            ->join('hotel_booking_passengers_info hp', 'hr.uniqueRefNo = hp.uniqueRefNo')
            ->where('hr.agent_id !=', 0);
        if ($agent_id == '') {
            $this->db->where('hr.agent_id !=', 0);
        } else {
            $this->db->where('hr.agent_id', $agent_id);
        }
        if ($from_date!="") {
            $this->db->where('hr.Booking_Date >=', $from_date);
        }
        if ($to_date != '') {
            $this->db->where('hr.Booking_Date <=', $to_date);
        }
        $this->db->order_by('hr.report_id', 'DESC')
            ->group_by('hp.uniqueRefNo');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return array($query->result(), $query);
            //return $query;
        }
        return false;
    }
    public function get_b2c_bus_booking_summary($agent_id='',$from_date='',$to_date='')
    {

        $this->db->select('br.*,bp.*')
        ->from('bus_booking_reports br')
        ->join('bus_booking_pass_info bp', 'br.uniqueRefNo = bp.uniqueRefNo')   ;
                    //->where('br.agent_id !=', 0);
                    //->where($agent_cond)

        if($agent_id == ''){
            $this->db->where('agent_id !=', 0);
        }else{
            $this->db->where('agent_id',$agent_id);
        }
        if($from_date){
         $this->db->where('booking_date >=', $from_date);
         }
         if($to_date !=''){
            $this->db->where('booking_date >=', $to_date);
        }

        $this->db->order_by('br.report_id', 'DESC')
        ->group_by('bp.uniqueRefNo');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
        {
            return array($query->result(),$query);
        }

        return array('','');

    }

    public function get_b2b_car_booking_summary($agent_id = '', $from_date = '', $to_date = '') {
        $this->db->select('cr.*,cp.*,a.agent_no,a.agency_name')
            ->from('car_booking_reports cr')
            ->join('car_booking_passengers cp', 'cr.uniqueRefNo = cp.uniqueRefNo')
            ->join('agent_info a', 'cr.agent_id = a.agent_id');
        if ($agent_id == '') {
            $this->db->where('cr.agent_id !=', 0);
        } else {
            $this->db->where('cr.agent_id', $agent_id);
        }
        if ($from_date != '') {
            $this->db->where('cr.Booking_Date >=', $from_date);
        }
        if ($to_date != '') {
            $this->db->where('cr.Booking_Date <=', $to_date);
        }
        // $this_db->order_by('cr.report_id', 'DESC')
        //     ->group_by('cp.uniqueRefNo');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return array($query->result(),$query);
        }
        return false;
    }

    public function get_b2b_holiday_booking_summary($agent_id = '', $from_date = '', $to_date = '') {
        $this->db->select('*');
        $this->db->from('holiday_pac_req');
        if ($agent_id == '') {
            $this->db->where('agent_id !=', 0);
        } else {
            $this->db->where('agent_id', $agent_id);
        }
        if ($from_date != '') {
            $this->db->where('booking_date >=', $from_date);
        }
        if ($to_date != '') {
            $this->db->where('booking_date <=', $to_date);
        }
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
             return array($query->result(),$query);
        }
        return false;
    }

    public function get_b2b_transfer_booking_summary($agent_id = '', $from_date = '', $to_date = '') {
        $this->db->select('*');
        $this->db->from('transfer_booking_reports');
        if ($agent_id == '') {
            $this->db->where('agent_id !=', 0);
        } else {
            $this->db->where('agent_id', $agent_id);
        }
        // if ($from_date != '') {
        //     $this->db->where('booking_date >=', $from_date);
        // }
        // if ($to_date != '') {
        //     $this->db->where('booking_date <=', $to_date);
        // }
        // $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
             return array($query->result(),$query);
        }
        return false;
    }

    public function get_agent_available_balance($agent_no) {
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
        return $balance;
    }
    public function update_deposit_status($dep_amt, $depositno, $total) {
        $timestamp = date("Y-m-d h:m:s", strtotime("now"));
        $data['status'] = 'Accepted';
        $data['approve_date'] = $timestamp;
        $data['available_balance'] = $total;
        $where = "acc_id = '$depositno'";
        // echo $timestamp;exit;
        if ($this->db->update('agent_acc_summary', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }
    public function agent_decline_deposit($acc_id) {
        $data['status'] = 'Declined';
        $where = "acc_id = '$acc_id'";
        if ($this->db->update('agent_acc_summary', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }
    public function get_sum_of_deposits($agent_no) {
        $this->db->select('deposit_amount')->from('agent_deposit_summary')->where('status', 'Accepted')->where('agent_no', $agent_no);
        $query = $this->db->get();
        $period_array = array();
        foreach ($query->result_array() as $row) {
            $period_array[] = ($row['deposit_amount']);
        }
        $total = array_sum($period_array);
        if ($query->num_rows() > 0) {
            return $total;
        }
        return false;
    }
    public function get_approved_amount($id) {
        $this->db->select('*')
            ->from('agent_acc_summary')
            ->where('acc_id', $id)
        // ->order_by('available_balance', 'DESC')
            ->where('status', 'Pending');
        $query = $this->db->get();
        // echo $this-db->last_query();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
    public function get_b2b_bus_booking_summary($Booking_Status1, $booking_reference_no1 = '', $pass_name = '', $booking_date = '', $uniqueRefNo = '', $to_date = '', $from_date = '', $Booking_Status = '', $agent_id = '') {
        $this->db->select('br.*,agi.agency_name, bp.*');
        $this->db->from('bus_booking_reports br');
        // $this->db->join("(select * from bus_booking_reports brs where brs.agent_id in (select agent_id from agent_info where agent_id !=0')) ai", 'br.agent_id = brs.agent_id');
        $this->db->join('(select * from bus_booking_pass_info) bp', 'br.booking_unique_reference_no = bp.uniqueRefNo');
        $this->db->join('agent_info agi', 'br.agent_id = agi.agent_id');
        // ->where($agent_cond)
        if ($agent_id == '') {
            $this->db->where('br.agent_id !=', 0);
        } else {
            $this->db->where('br.agent_id', $agent_id);
        }
        if ($Booking_Status != '') {
            $this->db->where('br.Booking_Status', $Booking_Status);
        }
        if ($Booking_Status1 != '') {
            $this->db->where('br.Booking_Status1', $Booking_Status1);
        }
        if ($from_date != '') {
            $this->db->where('br.booking_date >=', $from_date);
        }
        if ($to_date != '') {
            $this->db->where('br.booking_date <=', $to_date);
        }
        if ($booking_date != '') {
            $this->db->where('br.departure_date1', $booking_date);
        }
        if ($uniqueRefNo != '') {
            $this->db->where('br.uniqueRefNo', $uniqueRefNo);
        }
        if ($booking_reference_no1 != '') {
            $this->db->where('br.booking_reference_no1', $booking_reference_no1);
        }
        if ($pass_name != '') {
            $this->db->LIKE('bp.pass_name', $pass_name);
        }

        $this->db->order_by('br.report_id', 'DESC');

        $this->db->group_by('bp.uniqueRefNo');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return array($query->result(), $query);
        }
        return array('', '');
    }
    public function get_b2b_activity_booking_summary($agent_id='', $from_date = '', $to_date = '')
    {
        $this->db->select('ar.*,ap.*')
        ->from('activity_booking_reports ar')
        ->join('activity_booking_passengers ap', 'ar.uniqueRefNo = ap.uniqueRefNo');
         if ($agent_id == '') {
            $this->db->where('ar.agent_id !=', 0);
        } else {
            $this->db->where('ar.agent_id', $agent_id);
        }
        // ->where('ar.agent_id', $agent_id);
        // ->order_by('ar.id', 'DESC')
        // ->group_by('ap.uniqueRefNo');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return array($query->result(),$query);
        }

        return false;

    }
    public function get_b2c_apartment_booking_summary($agent_id = '', $from_date = '', $to_date = '') {
        $this->db->select('br.*,bp.*')
            ->from('apartment_booking_reports br')
            ->join('apartment_pass_info bp', 'br.uniqueRefNo = bp.uniqueRefNo');
        //->where('br.agent_id !=', 0);
        //->where($agent_cond)
        if ($agent_id == '') {
            $this->db->where('agent_id !=', 0);
        } else {
            $this->db->where('agent_id', $agent_id);
        }
        if ($from_date) {
            $this->db->where('booking_date >=', $from_date);
        }
        if ($to_date != '') {
            $this->db->where('booking_date >=', $to_date);
        }
        $this->db->order_by('br.report_id', 'DESC')
            ->group_by('bp.uniqueRefNo');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return array($query->result(), $query);
        }
        return array('', '');
    }
    //cancellation report
    public function b2b_hotel_cancel() {
        $this->db->select('*');
        $this->db->from('hotel_booking_reports');
        $this->db->where('Booking_Status', 'Fail');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }
    //minimum credit value
    function get_thr_value() {
        $this->db->select('amount');
        $this->db->from('mini_credit_value');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }
    function insert_mini_amount($amt) {
        $this->db->truncate('mini_credit_value');
        $ins = array(
            'amount' => $amt,
        );
        $this->db->insert('mini_credit_value', $ins);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return true;
        } else {
            return false;
        }
    }
    //Discount manage
    function delete_discount_markup($markup_type, $service_type) {
        $where = "markup_type = '$markup_type' AND service_type = '$service_type'";
        if ($this->db->delete('b2b_incentives', $where)) {
            return true;
        } else {
            return false;
        }
    }
    function delete_discount_markup_all($markup_type, $service_type) {
        //echo 'del';exit;
        $where = "type='$service_type'";
        if ($this->db->delete('b2b_incentives', $where)) {
            //echo '1';
            return true;
        } else {
            //echo '2';
            return false;
        }
    }
    function add_discount_markup($agent_no, $markup_process, $markup, $markup_type, $service_type) {
        $data = array(
            // 'country' => $country,
            'agent_no' => $agent_no,
            //    'api_name' => $api_name,
            'markup_process' => $markup_process,
            'markup' => $markup,
            'markup_type' => $markup_type,
            'service_type' => $service_type,
            'status' => 1,
        );
        $this->db->insert('b2b_incentives', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return true;
        } else {
            return false;
        }
    }
    function delete_b2b_discount_new($markup_type, $service_type, $agent) {
        $where = "markup_type = '$markup_type'";
        if ($service_type != '') {
            $where .= "AND service_type = '$service_type'";
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
    //eticket
    function get_booking_details($booking_reference_no, $tfvRefNo) {
        $query = $this->db->select('*')->from('bus_booking_reports')->where('booking_reference_no1', $booking_reference_no)->where('uniqueRefNo', $tfvRefNo)->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_booking_pass_details($booking_reference_no, $tfvRefNo) {
        $query = $this->db->select('*')->from('bus_booking_pass_info')->where('booking_reference_no', $booking_reference_no)->where('uniqueRefNo', $tfvRefNo)->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function flight_get_booking_details($booking_reference_no, $tfvRefNo) {
        $query = $this->db->select('*')->from('bus_booking_reports')->where('booking_reference_no1', $booking_reference_no)->where('uniqueRefNo', $tfvRefNo)->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function flight_get_booking_pass_details($booking_reference_no, $tfvRefNo) {
        $query = $this->db->select('*')->from('flight_booking_pass_info')->where('booking_reference_no', $booking_reference_no)->where('uniqueRefNo', $tfvRefNo)->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_flight_booking_info($flyNStayRefNo, $SequenceNumber) {
        $this->db->select('*');
        $this->db->from('flight_booking_reports');
        $this->db->where('uniqueRefNo', $flyNStayRefNo);
        // $this->db->where('SequenceNumber', $SequenceNumber);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }
    function get_passengers_info($RefId) {
        $this->db->select('*');
        $this->db->from('flight_booking_passengers');
        $this->db->where('uniqueRefNo', $RefId);
        $this->db->order_by('pass_id', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }
    //
    public function hol_pac_req($pck_ins) {
        //print_r($pck_ins);exit;
        $this->db->insert('holiday_pac_req', $pck_ins);
        return;
    }
    public function flight_pac_req($flight_post) {
        //print_r($flight_post);exit;
        $this->db->insert('flight_enq_request', $flight_post);
        return;
    }
    public function hotel_pac_req($pk_hotel) {
        //print_r($flight_post);exit;
        $this->db->insert('hotel_enq_request', $pk_hotel);
        return;
    }
    public function get_agent_mini_value($val) {
        $this->db->select('*');
        $this->db->from('agent_acc_summary');
        $this->db->where('available_balance <=', $val);
        $this->db->order_by('transaction_datetime', 'DESC');
        $this->db->limit('1');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $res = $query->result();
            $balance = $res->agent_id;
            //echo '<pre>';print_r($res);exit;
        } else {
            return '';
        }
        return $balance;
    }
    public function get_agency_name($agent_no) {
        $this->db->select('*');
        $this->db->from('agent_info');
        $this->db->where('agent_no', $agent_no);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return '';
        }
    }
    public function get_hotel_booking_agent_info($agent_id) {
        $this->db->select('*');
        $this->db->from('agent_info');
        $this->db->where('agent_id', $agent_id);
        //$this->db->order_by('pass_id','ASC');
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }
    }
    public function delete_old_discount($airline, $origin = '', $destination = '') {
        // if($basefare){
        //  $this->db->where('basefare',$basefare);
        // }
        // if($yqfare){
        //  $this->db->where('yqfare',$yqfare);
        // }
        $this->db->where('airline', $airline);
        if ($origin) {
            $this->db->where('origin', $origin);
        }
        if ($destination) {
            $this->db->where('destination', $destination);
        }
        $this->db->delete('b2b_discount_info');
    }
    public function insert_discount($data) {
        $this->db->insert('b2b_discount_info', $data);
    }
    public function get_airlines_list() {
        $this->db->select('*')
            ->from('airlines_list')
            ->group_by('airline_name');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function get_airline_discount_list() {
        $this->db->select('*');
        $this->db->from('b2b_discount_info');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function get_airport_list() {
        $this->db->select('*');
        $this->db->from('airport_list');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function update_discount_status($id, $status) {
        $data = array(
            'status' => $status,
        );
        $this->db->where('markup_id', $id);
        $this->db->update('b2b_discount_info', $data);
        return true;
    }
    public function delete_discount($id) {

        $this->db->where('markup_id', $id);
        $this->db->delete('b2b_discount_info');
        return true;
    }
    public function get_active_agent_list2($id) {
        $this->db->select('*')
            ->from('agent_info')
            ->where('status', 1)
            ->where('agent_no', $id);
        $this->db->order_by('agent_id', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    public function get_b2b_passenger_list_bus($uniquerefno) {
        $this->db->select('*')
            ->from('bus_booking_pass_info')
            ->where('uniqueRefNo', $uniquerefno);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_b2b_passenger_list($uniquerefno) {
        $this->db->select('*')
            ->from('flight_booking_passengers')
            ->where('uniqueRefNo', $uniquerefno)
            ->where('mode', 'onward');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_b2b_flight_booking_summary_r($uniquemo) {
        $this->db->select('fr.*')
            ->from('flight_booking_reports fr')
            ->where('fr.mode', 'RETURN')
            ->where('fr.uniqueRefNo', $uniquemo)
            ->where('fr.Trip_Type', 'R')
            ->order_by('fr.report_id', 'DESC');

        // ->group_by('fp.uniqueRefNo');
        $query = $this->db->get();
        // print_r($data['query']);
        //  die();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_bank_details() {
        $this->db->select('*')
            ->from('bank_info');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

}