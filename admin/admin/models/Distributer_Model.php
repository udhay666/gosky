<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Distributer_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function reply_message($reply_data) {
        $this->db->insert('admin_inbox', $reply_data);
        return true;
    }

    public function get_email_message($msgId) {
        $this->db->select('*')
                ->from('admin_inbox')
                ->where('id', $msgId)
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }

        return '';
    }

    public function update_email_status($msgId, $status) {
        $data['message_status'] = $status;
        $where = "id = '$msgId'";
        if ($this->db->update('admin_inbox', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_reply_email_message($msgId) {
        $this->db->select('*')
                ->from('admin_inbox')
                ->where('sub_id', $msgId)
                ->order_by('id', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return '';
    }

    public function get_admins_list($admin_id) {
        $this->db->select('*');
        $this->db->from('admin_info');
        $this->db->where('admin_id', $admin_id);
        $this->db->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $res = $query->row();
            $result = array();
            if ($res->admin_parent) {
                $this->db->select('*')
                        ->from('admin_info')
                        ->where('admin_id', $res->admin_parent)
                        ->where('status', 1);
                $this->db->order_by('admin_id', 'DESC');
                $query = $this->db->get();

                if ($query->num_rows > 0) {
                    $result = $query->result();
                }
            }
            $this->db->select('*')
                    ->from('admin_info')
                    ->where('admin_parent', $res->admin_id)
                    ->where('status', 1);
            $this->db->order_by('admin_id', 'DESC');

            $query = $this->db->get();
            if ($query->num_rows > 0) {
                $result = array_merge($result, $query->result());
            }
            return $result;
        }
        return false;
    }

    public function get_all_messages($admin_id) {
        $this->db->select('*')
                ->from('admin_inbox')
                ->where("admin_id = $admin_id or to_admin_id = $admin_id");
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function check_email_availability($email) {
        $this->db->select('*')
                ->from('admin_info')
                ->where('login_email', $email)
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return '';
    }

    public function check_pins_available($admin_id, $adpins) {
        $this->db->select('*')
                ->from('admin_info')
                ->where('admin_id', $admin_id)
                ->where('available_pins >=', $adpins);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_admin_pins() {
        $admin_id = $this->session->userdata('admin_id');
        $this->db->select('a.status as pin_status,a.required_pins,b.*')
                ->from('admin_pins_request a')
                ->join('admin_info b', 'b.admin_id = a.admin_id')
                ->where('a.admin_parent', $admin_id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function get_admin_active_pins() {
        $admin_id = $this->session->userdata('admin_id');
        $this->db->select('a.status as pin_status,a.required_pins,b.*')
                ->from('admin_pins_request a')
                ->join('admin_info b', 'b.admin_id = a.admin_id')
                ->where('a.status', 1)
                ->where('a.admin_parent', $admin_id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function add_admin_user($admin_email, $admin_password, $title, $first_name, $middle_name, $last_name, $mobile_no, $address, $pin_code, $city, $state, $country, $admin_group, $admin_parent) {
        $data = array(
            'admin_group' => $admin_group,
            'admin_parent' => $admin_parent,
            'role_id'=>'3',
            'login_email' => $admin_email,
            'login_password' => $admin_password,
            'currency_type' => 'INR',
            'title' => $title,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'mobile_no' => $mobile_no,
            'address' => $address,
            'pin_code' => $pin_code,
            'city' => $city,
            'state' => $state,
            'country' => $country,
        //    'ad_pins' => $adpins,
          //  'available_pins' => $adpins,
            'status' => 1,
        );
        $this->db->set('register_date', 'NOW()', FALSE);

        $this->db->insert('admin_info', $data);
        $id = $this->db->insert_id();

        if (!empty($id)) {
            $this->db->select('*');
            $this->db->from('admin_groups');
            $this->db->where('admin_grp_id', $admin_group);
            $this->db->limit('1');
            $query = $this->db->get();
            if ($query->num_rows > 0) {
                $row = $query->row();
                $group_name = $row->admin_grp_name;
                if ($group_name == 'Admin') {
                    $group_name = 'AD';
                }
            } else {
                $group_name = '';
            }
            $admin_no = 'XM' . $group_name . $id . rand(1000, 9999);

            $data1 = array('admin_no' => $admin_no);
            $this->db->where('admin_id', $id);
            $this->db->update('admin_info', $data1);

            //Decrement available pins'
//            $this->db->where('admin_id', $admin_parent);
//            $this->db->set('available_pins', "available_pins - $adpins", FALSE);
//            $this->db->update('admin_info');


            return $id;
        } else {
            return false;
        }
    }

    public function add_privileges($id, $admin_group) {
        $this->db->select('*')
                ->from('admin_privilege_groups')
                ->where('admin_group_id', $admin_group);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $result = $query->result();
            foreach ($result as $row) {
                $data = array(
                    'privilege_admin_id' => $id,
                    'admin_privilege_id' => $row->admin_privilege_id,
                );
                $this->db->insert('admin_privilege_users', $data);
            }
        }
    }

    public function get_admin_top_parent($level) {
        if ($level == 1) {
            $agent_cond = 'admin_parent = "' . $admin_id . '"';
        } else if ($level == 2) {
            $agent_cond = 'admin_parent IN (select admin_id from admin_info where admin_parent = "' . $admin_id . '")';
        } else if ($level == 3) {
            $agent_cond = 'admin_parent  IN (select admin_id from admin_info where admin_parent IN (select admin_id from admin_info where admin_parent = "' . $admin_id . '"))';
        } else if ($level == 4) {
            $agent_cond = 'admin_parent in (select admin_id from admin_info where admin_parent  IN (select admin_id from admin_info where admin_parent IN (select admin_id from admin_info where admin_parent = "' . $admin_id . '")))';
        }
        $this->db->select('*');
        $this->db->from('admin_info');
        $this->db->where($agent_cond);

        //$this->db->where('admin_parent',$admin_id);
        //$this->db->where('b.admin_grp_level', $level);
        $this->db->order_by('first_name', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_admin_user_info($level = 2) {
        $grpname = $this->session->userdata('admin_group_name');
        $admin_id = $this->session->userdata('admin_id');
        if ($level == 1) {
            $agent_cond = 'admin_parent = "' . $admin_id . '"';
        } else if ($level == 2) {
            $agent_cond = 'admin_parent IN (select admin_id from admin_info where admin_parent = "' . $admin_id . '")';
        } else if ($level == 3) {
            $agent_cond = 'admin_parent  IN (select admin_id from admin_info where admin_parent IN (select admin_id from admin_info where admin_parent = "' . $admin_id . '"))';
        } else if ($level == 4) {
            $agent_cond = 'admin_parent in (select admin_id from admin_info where admin_parent  IN (select admin_id from admin_info where admin_parent IN (select admin_id from admin_info where admin_parent = "' . $admin_id . '")))';
        }
        $this->db->select('*');
        $this->db->from('admin_info');
        $this->db->where($agent_cond);

        //$this->db->where('admin_parent',$admin_id);
        //$this->db->where('b.admin_grp_level', $level);
        $this->db->order_by('first_name', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_admin_info_by_id($admin_id) {
        $this->db->select('*');
        $this->db->from('admin_info a');
        $this->db->join('admin_groups b', 'b.admin_grp_id = a.admin_group');
        $this->db->where('admin_id', $admin_id);
        $this->db->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $res = $query->result();
            return $res[0];
        }

        return false;
    }

    public function update_admin($admin_id, $title, $first_name, $middle_name, $last_name, $mobile_no, $address, $pin_code, $city, $state, $country, $admin_group, $admin_parent) {
        $data = array(
            'admin_group' => $admin_group,
            'admin_parent' => $admin_parent,
            'title' => $title,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'mobile_no' => $mobile_no,
            'address' => $address,
            'pin_code' => $pin_code,
            'city' => $city,
            'state' => $state,
            'country' => $country,
        );

        $this->db->where('admin_id', $admin_id);
        if ($this->db->update('admin_info', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function update_admin_password($admin_id, $password = '') {
        if (!empty($password)) {
            $data['login_password'] = $password;
            $where = "admin_id = '$admin_id'";
            if ($this->db->update('admin_info', $data, $where)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function manage_admin_user_status($admin_id, $status) {

        $data['status'] = $status;
        $where = "admin_id = '$admin_id'";
        if ($this->db->update('admin_info', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_admin_groups() {

        $admin_id = $this->session->userdata('admin_id');
        $this->db->select('admin_grp_id,admin_grp_name,admin_grp_level');
        $this->db->from('admin_groups');
        /* if(!$this->admin_auth->is_admin()) {
          $this->db->where('admin_grp_level > (select admin_grp_level from admin_groups where admin_grp_id IN ( select admin_group from admin_info where admin_id = '.$admin_id.' ) order by admin_grp_level ASC LIMIT 1)');
          } else {
          $this->db->where('admin_grp_level >= (select admin_grp_level from admin_groups where admin_grp_id IN ( select admin_group from admin_info where admin_id = '.$admin_id.' ) order by admin_grp_level ASC LIMIT 1)');
          } */
        $this->db->where('admin_grp_level > (select admin_grp_level from admin_groups where admin_grp_id IN ( select admin_group from admin_info where admin_id = ' . $admin_id . ' ) order by admin_grp_level ASC LIMIT 1)');
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function get_admin_list() {
        $grpname = $this->session->userdata('admin_group_name');
        $admin_id = $this->session->userdata('admin_id');

        $this->db->select('a.admin_id,a.first_name,a.last_name,a.admin_group,b.admin_grp_name,b.admin_grp_level');
        $this->db->from('admin_info a');
        $this->db->join('admin_groups b', 'a.admin_group = b.admin_grp_id', 'left');
        $this->db->where('(a.admin_id in (select admin_id from admin_info where admin_parent  IN (select admin_id from admin_info where admin_parent IN (select admin_id from admin_info where admin_parent = "' . $admin_id . '"))) or a.admin_id in (select admin_id from admin_info where admin_parent IN (select admin_id from admin_info where admin_parent = "' . $admin_id . '")) or a.admin_id in (select admin_id from admin_info where admin_parent = "' . $admin_id . '") or  a.admin_id = "' . $admin_id . '")');
        $this->db->where('b.admin_grp_level >= (select admin_grp_level from admin_groups where admin_grp_id IN ( select admin_group from admin_info where admin_id = ' . $admin_id . ' ) order by admin_grp_level ASC LIMIT 1)');
        $this->db->where('status', 1);
        $this->db->order_by('b.admin_grp_level,a.first_name', 'ASC');
        $this->db->where('b.admin_grp_name !=', 'DI');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            echo 'asd';
            exit();
            return '';
        }
    }

    public function get_active_admin_list() {
        $admin_id = $this->session->userdata('admin_id');
        $this->db->select('*');
        $this->db->from('admin_info');
        $this->db->where('admin_parent', $admin_id);
        $this->db->where('status', 1);
        $this->db->order_by('first_name', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_hotel_markup_list() {
        $admin_id = $this->session->userdata('admin_id');
        $this->db->select('*');
        $this->db->from('admin_distributer_markup_info');
        $this->db->where('service_type', 1);
        $this->db->where('admin_parent', $admin_id);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_flight_markup_list() {
        $admin_id = $this->session->userdata('admin_id');
        $this->db->select('*');
        $this->db->from('admin_distributer_markup_info');
        $this->db->where('service_type', 2);
        $this->db->where('admin_parent', $admin_id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_bus_markup_list() {
        $admin_id = $this->session->userdata('admin_id');
        $this->db->select('*');
        $this->db->from('admin_distributer_markup_info');
        $this->db->where('service_type', 4);
        $this->db->where('admin_parent', $admin_id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    function delete_distributor_markup($markup_type, $service_type, $api_name = false) {
        $admin_id = $this->session->userdata('admin_id');
        $this->db->where('markup_type', $markup_type);
        $this->db->where('service_type', $service_type);
        $this->db->where('admin_parent', $admin_id);
        if ($api_name) {
            $this->db->where('api_name', $api_name);
        }
        if ($this->db->delete('admin_distributer_markup_info', $where)) {
            return true;
        } else {
            return false;
        }
    }

    function add_distributor_markup($country, $admin_no, $api_name, $markup, $markup_type, $service_type) {
        $admin_id = $this->session->userdata('admin_id');
        $this->db->select('admin_id,admin_no,admin_group');
        $this->db->from('admin_info');
        $this->db->where('admin_no', $admin_no);
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $admin_details = $query->row();
            $data = array(
                'country' => $country,
                'admin_id' => $admin_details->admin_id,
                'admin_no' => $admin_details->admin_no,
                'admin_group' => $admin_details->admin_group,
                'admin_parent' => $admin_id,
                'api_name' => $api_name,
                'markup' => $markup,
                'markup_type' => $markup_type,
                'service_type' => $service_type,
                'status' => 1
            );
            $this->db->insert('admin_distributer_markup_info', $data);
            $id = $this->db->insert_id();
            if (!empty($id)) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }

    function delete_distributor_markup_new($markup_type, $service_type, $admin_no, $api_name, $country) {

        $admin_id = $this->session->userdata('admin_id');
        $where = "markup_type = '$markup_type'";
        if ($service_type != '') {
            $where .= "AND service_type = '$service_type'";
        }
        if ($country != '') {
            $where .= "AND country = '$country'";
        }
        if ($api_name != '') {
            if ($api_name != 'all') {
                $where .= "AND api_name = '$api_name'";
            }
            if ($admin_no != '') {
                $where .= "AND admin_no = '$admin_no'";
                $where .= "AND admin_parent = '$admin_id'";
                if ($this->db->delete('admin_distributer_markup_info', $where)) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return false;
    }

    public function manage_distributor_markup_status($markup_id, $status) {
        $data['status'] = $status;
        $where = "markup_id = '$markup_id'";
        if ($this->db->update('admin_distributer_markup_info', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    function delete_distributor_markup_status($markup_id) {
        $where = "markup_id = '$markup_id'";
        if ($this->db->delete('admin_distributer_markup_info', $where)) {
            return true;
        } else {
            return false;
        }
    }

    function get_admin_level($admin_id) {
        if (!empty($admin_id)) {
            $this->db->select('admin_group');
            $this->db->from('admin_info');
            $this->db->where('admin_id', $admin_id);
            $query = $this->db->get();
            if ($query->num_rows > 0) {
                $row = $query->row();
                $admin_group = $row->admin_group;
            }
        } else {
            $admin_group = $this->session->userdata('admin_group');
        }
        $this->db->select('admin_grp_level');
        $this->db->from('admin_groups');
        $this->db->where('admin_grp_id', $admin_group);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $row = $query->row();
            return $row->admin_grp_level;
        } else {
            return '';
        }
    }

    public function get_admin_privileges($admin_id) {
        $this->db->select('*');
        $this->db->from('admin_privilege_users a ');
        $this->db->join('admin_privileges b', 'b.privilege_id = a.admin_privilege_id', 'left');
        $this->db->where('privilege_admin_id', $admin_id);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function get_admin_group_privileges($group_id) {
        $this->db->select('*');
        $this->db->from('admin_privilege_groups a ');
        $this->db->join('admin_privileges b', 'b.privilege_id = a.admin_privilege_id', 'left');
        $this->db->where('admin_group_id', $group_id);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function delete_admin_privileges($admin_id) {
        $where = "privilege_admin_id = $admin_id";
        if ($this->db->delete('admin_privilege_users', $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function add_admin_privileges($admin_id, $privilege_id) {
        $data = array(
            'privilege_admin_id' => $admin_id,
            'admin_privilege_id' => $privilege_id,
        );

        if ($this->db->insert('admin_privilege_users', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_max_admin_pins() {
        $admin_id = $this->session->userdata('admin_id');
        $this->db->select('*');
        $this->db->from('admin_info');
        $this->db->where('admin_id', $admin_id);
        $this->db->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $row = $query->row();
            $admin_pins = $row->available_pins;
            return $admin_pins;
        } else {
            return 0;
        }
    }

    public function insert_adminpin_request($admin_id, $data) {
        $this->db->select('*');
        $this->db->from('admin_pins_request');
        $this->db->where('admin_id', $admin_id);
        $this->db->where('status', 1);
        $query = $this->db->get();

        if ($query->num_rows > 0) {

        } else {
            $this->db->insert('admin_pins_request', $data);
            return true;
        }
    }

    public function update_admin_pins($admin_id, $data) {
        $this->db->where('admin_id', $admin_id);
        $this->db->update('admin_info', $data);
        return true;
    }

    public function update_admin_pins_request($admin_id) {
        $data = array(
            'status' => 0,
        );
        $this->db->where('status', 1);
        $this->db->where('admin_id', $admin_id);
        $this->db->update('admin_pins_request', $data);
        return true;
    }

    public function get_distributor_available_balance($admin_id) {
        $this->db->select('available_balance')
                ->from('admin_distributor_acc_summary')
                ->where('admin_id', $admin_id)
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

    public function get_distributor_balance() {
        $this->db->select('*');
        $this->db->from('(select * from admin_distributor_acc_summary order by acc_id desc) as a');
        $this->db->group_by('a.admin_id');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function insert_distributor_act_summary($insertion_data) {
        $this->db->insert('admin_distributor_acc_summary', $insertion_data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_admin_act_summary() {
        $admin_id = $this->session->userdata('admin_id');
        $this->db->select('a.*,b.admin_grp_name')
                ->from('admin_distributor_acc_summary a')
                ->join('admin_groups b', 'b.admin_grp_id = a.admin_group')
                ->where('a.admin_parent', $admin_id)
                ->order_by('acc_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    /*    public function get_admin_act_summary($admin_id)
      {
      $this->db->select('*')
      ->from('admin_distributor_acc_summary')
      ->where('admin_id',$admin_id)
      ->order_by('acc_id','DESC');
      $query = $this->db->get();

      if($query->num_rows > 0)
      {
      return $query->result();

      }

      return false;

      } */

    public function get_active_admin_act_summary() {
        $admin_id = $this->session->userdata('admin_id');
        $this->db->select('*')
                ->from('admin_distributor_acc_summary a')
                ->join('admin_groups b', 'b.admin_grp_id = a.admin_group')
                ->where('a.admin_parent', $admin_id)
                ->where('a.status', 'Pending')
                ->order_by('a.acc_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function add_deposit_request($admin_id, $admin_no, $admin_group, $admin_parent, $amount, $value_date, $transaction_mode, $bank, $branch, $city, $transaction_id, $remarks) {
        $this->db->select('*')
                ->from('admin_distributor_acc_summary')
                ->where('admin_id', $admin_id)
                ->where('status', 'Pending')
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return false;
        }

        $desc = $transaction_mode . '-' . $transaction_id . ', ' . $bank;

        $value_date = date('Y-m-d', strtotime($value_date));
        $this->db->select('available_balance')
                ->from('admin_distributor_acc_summary')
                ->where('admin_no', $admin_no)
                ->order_by('transaction_datetime', 'DESC')
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $res = $query->result();
            $balance = $res[0]->available_balance;
        } else {
            $balance = 0;
        }
        $data = array(
            'admin_id' => $admin_id,
            'admin_no' => $admin_no,
            'admin_group' => $admin_group,
            'admin_parent' => $admin_parent,
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

        $this->db->insert('admin_distributor_acc_summary', $data);
        //echo $this->db->last_query();exit;
        $id = $this->db->insert_id();
        if (!empty($id)) {
            $transaction_no = 'XMT' . $id . rand(1000, 9999);
            $data1 = array('admin_transaction_id' => $transaction_no);
            $this->db->where('acc_id', $id);
            $this->db->update('admin_distributor_acc_summary', $data1);
            return true;
        } else {
            return false;
        }
    }

    public function get_admin_available_balance($admin_id) {

        $this->db->select('available_balance')
                ->from('admin_distributor_acc_summary')
                ->where('admin_id', $admin_id)
                ->order_by('transaction_datetime', 'DESC')
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

    public function get_admin_approved_amount($id) {
        $this->db->select('*')
                ->from('admin_distributor_acc_summary')
                ->where('acc_id', $id)
                ->where('status', 'Pending');
        $query = $this->db->get();
        // echo $this-db->last_query();

        if ($query->num_rows > 0) {
            return $query->row();
        }
        return false;
    }

    public function admin_decline_deposit($acc_id) {
        $data['status'] = 'Declined';
        $where = "acc_id = '$acc_id'";
        if ($this->db->update('admin_distributor_acc_summary', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function admin_update_deposit_status($dep_amt, $acc_id, $total) {
        $timestamp = date("Y-d-m h:m:s", strtotime("now"));
        $data['status'] = 'Accepted';
        $data['approve_date'] = $timestamp;
        $data['available_balance'] = $total;
        $where = "acc_id = '$acc_id'";

        if ($this->db->update('admin_distributor_acc_summary', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function deduct_admin_amount($admin_id, $admin_no, $admin_group, $admin_parent, $dep_amt, $deduct_am, $transaction_mode, $transaction_id, $remarks) {

        $desc = "Amount deducted for the distributor approved amount - '$transaction_id'";

        //     $value_date = date('Y-m-d', strtotime($value_date));

        $data = array(
            'admin_id' => $admin_id,
            'admin_no' => $admin_no,
            'admin_group' => $admin_group,
            'admin_parent' => $admin_parent,
            'transaction_summary' => $desc,
            //   'deposit_amount' => $amount,
            'withdraw_amount' => $dep_amt,
            'transaction_id' => $transaction_id,
            // 'bank' => $bank,
            //  'branch' => $branch,
            //   'city' => $city,
            //   'value_date' => $value_date,
            'remarks' => $remarks,
            'available_balance' => $deduct_am,
            'status' => 'Accepted',
        );


        $this->db->set('transaction_datetime', 'NOW()', FALSE);

        $this->db->insert('admin_distributor_acc_summary', $data);
        //echo $this->db->last_query();exit;
        $id = $this->db->insert_id();
        if (!empty($id)) {
            $transaction_no = 'JPT' . $id . rand(1000, 9999);
            $data1 = array('admin_transaction_id' => $transaction_no);
            $this->db->where('acc_id', $id);
            $this->db->update('admin_distributor_acc_summary', $data1);
            return true;
        } else {
            return false;
        }
    }

}

