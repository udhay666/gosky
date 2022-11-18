<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Role_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function check_email_availability($email) {
        $this->db->select('*')
                ->from('admin_info')
                ->where('login_email', $email)
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return '';
    }

    public function add_admin_user($admin_email, $admin_password, $title, $first_name, $middle_name, $last_name, $mobile_no, $address, $pin_code, $city, $state, $country, $role_id) {
        $data = array(
            'role_id' => $role_id,
            'login_email' => $admin_email,
            'login_password' => $admin_password,
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
            'status' => 1,
        );

        $this->db->set('register_date', 'NOW()', FALSE);

        $this->db->insert('admin_info', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return $id;
        } else {
            return false;
        }
    }

    public function get_admin_user_info() {
        $this->db->select('*')
                ->where('role_id', 2)
                ->from('admin_info');
        $this->db->order_by('admin_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_admin_info_by_id($admin_id) {
        $this->db->select('*')
                ->from('admin_info')
                ->where('admin_id', $admin_id)
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res[0];
        }

        return false;
    }

    public function update_sub_admin($role_id,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country) {
        $data = array(
             // 'role_id' => $role_id,
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
             'status' => 1,
        );

        $this->db->where('admin_id', $role_id);
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

    public function add_sub_admin($admin_email, $admin_password, $title, $first_name, $middle_name, $last_name, $mobile_no, $address, $pin_code, $city, $state, $country, $role_id, $adminperm) {
        $data = array(
            'role_id' => $role_id,
            'login_email' => $admin_email,
            'login_password' => $admin_password,
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
            'status' => 1,
        );

        $this->db->set('register_date', 'NOW()', FALSE);

        $this->db->insert('admin_info', $data);
        $id = $this->db->insert_id();
        $this->admin_permission($id, $adminperm);
        if (!empty($id)) {
            return true;
        } else {
            return false;
        }
    }

    function admin_permission($id, $adminperm) {
        $this->db->where('admin_id', $id);
        $this->db->delete('sub_admin_permissions');
        

        foreach ($adminperm as $adm) {
           $data=array(
               'admin_id'=>$id,
               'sub_admin_module_id'=>$adm
           );
             $this->db->insert('sub_admin_permissions', $data);
        }

 

    }

    function get_admin_modules() {
        $this->db->select('*')
                ->from('sub_admin_modules');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_admin_auth($id) {
        $this->db->select('*')
                ->from('sub_admin_permissions');
        $this->db->where('admin_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_admin_privilages(){
        $this->db->select('*')
        // ->where('role_id', 2)
        ->from('admin_privileges');
        // $this->db->order_by('admin_id', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        return $query->result();
        }
        return false;

    }


    public function fetch_admin_privilages($id){
        $this->db->select('*')
        ->where('privilege_admin_id', $id)
        ->from('admin_privilege_users');
        // $this->db->order_by('admin_id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
        return $query->result();
        }
        return false;

    }

    public function delete_subadmin_privilege($id){
        $this->db->where('privilege_admin_id',$id);
        $this->db->delete('admin_privilege_users');
    }

    public function add_subadmin_privilege($inert_id,$val){
        $data=array(
        'privilege_admin_id' => $inert_id,
        'admin_privilege_id' =>$val,
        );
        $this->db->insert('admin_privilege_users',$data);
    }

     public function get_admin_submodule_privilages($privilege_id){
        $this->db->select('*')
        // ->where('privilege_id', $privilege_id)
        ->from('admin_submodule_privileges')
        ->where('privilege_id', $privilege_id);
        // $this->db->order_by('admin_id', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        return $query->result();
        }
        return false;

    }
     public function fetch_admin_submodule_privilages($id){
        $this->db->select('*')
        ->where('submodule_privilege_admin_id', $id)
        ->from('admin_submodule_privilege_users');
        // $this->db->order_by('admin_id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
        return $query->result();
        }
        return false;

    }

     public function delete_subadmin_submodule_privilege($id){
        $this->db->where('submodule_privilege_admin_id',$id);
        $this->db->delete('admin_submodule_privilege_users');
    }

    public function add_subadmin_submodule_privilege($inert_id,$val){
        $data=array(
        'submodule_privilege_admin_id' => $inert_id,
        'submodule_admin_privilege_id' =>$val,
        );
        $this->db->insert('admin_submodule_privilege_users',$data);
    }

}
