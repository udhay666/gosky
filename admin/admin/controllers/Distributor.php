<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Distributor extends CI_Controller {

    const RefPrefix = 'JT';

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Distributer_Model');
        $this->load->model('Home_Model');
        $this->load->library('admin_auth');
        $this->is_admin_logged_in();
        if (!$this->admin_auth->is_privileged('Manage Distributors Markup') && !$this->admin_auth->is_privileged('Manage Distributors Deposit')) {
            echo 'No Privilege to View the files';
            die();
        }
    }

    private function is_admin_logged_in() {

        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login/index');
        }
    }

    public function index() {
        redirect('home/dashboard');
    }

    // Add New Admin User
    function add_admin_user() {
        $data = array();
        if ($this->admin_auth->is_admin()) {
            $data['admin_pins'] = 0;
        } else {
            $data['admin_pins'] = $this->Home_Model->get_max_admin_pins();
        }
        $this->form_validation->set_rules('admin_email', 'Email', 'trim|required|valid_email|is_unique[admin_info.login_email]|xss_clean');
        $this->form_validation->set_rules('admin_password', 'Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        $this->form_validation->set_rules('admin_group', 'Admin User Group', 'required');
      //  $this->form_validation->set_rules('admin_parent', 'Admin User Parent', 'required|callback_checkpinsavailable');
       // $this->form_validation->set_rules('ad_pins', 'Admin Pins', 'required|callback_pinmaxcheck');

        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|is_unique[admin_info.mobile_no]|min_length[10]');

        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'required');

        $data['status'] = '';
        $data['errors'] = '';
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['admin_group'] = $this->Distributer_Model->get_admin_groups();
        $data['admin_list'] = $this->Distributer_Model->get_admin_list();

        if ($this->form_validation->run() == FALSE) {
            $data['admin_email'] = $this->input->post('admin_email');
            $data['first_name'] = $this->input->post('first_name');
            $data['middle_name'] = $this->input->post('middle_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['mobile_no'] = $this->input->post('mobile_no');
            $data['address'] = $this->input->post('address');
            $data['pin_code'] = $this->input->post('pin_code');
            $data['city'] = $this->input->post('city');
            $data['state'] = $this->input->post('state');
            $this->load->view('distributor/add_admin_user', $data);
        } else {

            //echo '<pre/>';print_r($_POST);exit;
            $admin_email = $this->input->post('admin_email');
            $admin_password = md5($this->input->post('admin_password'));
            $admin_group = $this->input->post('admin_group');
            $admin_parent = $this->input->post('admin_parent');

            $title = $this->input->post('title');
            $first_name = $this->input->post('first_name');
            $middle_name = $this->input->post('middle_name');
            $last_name = $this->input->post('last_name');
            $mobile_no = $this->input->post('mobile_no');
            $address = $this->input->post('address');
            $pin_code = $this->input->post('pin_code');
            $city = $this->input->post('city');
            $state = $this->input->post('state');
            $country = $this->input->post('country');
           // $adpins = $this->input->post('ad_pins');

            $email_check = $this->Distributer_Model->check_email_availability($admin_email);

            if ($email_check != '' || !empty($email_check)) {
                $data['errors'] = 'Email Already Exists. Please use different email id to continue ...';
                $this->load->view('distributor/add_admin_user', $data);
            } else {
                if ($id = $this->Distributer_Model->add_admin_user($admin_email, $admin_password, $title, $first_name, $middle_name, $last_name, $mobile_no, $address, $pin_code, $city, $state, $country, $admin_group, $admin_parent)) {
                    $this->Distributer_Model->add_privileges($id, $admin_group);
                    redirect('distributor/admin_user_manager', 'refresh');
                } else {
                    $data['errors'] = 'Admin User Registration Not Done. Please try after some time...';
                    $this->load->view('distributor/add_admin_user', $data);
                }
            }
        }
    }

    public function admin_user_manager() {
        $admin_id = $this->session->userdata('admin_id');
        $level = $this->Distributer_Model->get_admin_level($admin_id);
        if ($level == 1) {

            $data['admin_srss_info'] = $this->Distributer_Model->get_admin_user_info(1);
            $data['admin_rss_info'] = $this->Distributer_Model->get_admin_user_info(2);
            $data['admin_ss_info'] = $this->Distributer_Model->get_admin_user_info(3);
            $data['admin_di_info'] = $this->Distributer_Model->get_admin_user_info(4);
        }
        if ($level == 2) {
            $data['admin_rss_info'] = $this->Distributer_Model->get_admin_user_info(1);
            $data['admin_ss_info'] = $this->Distributer_Model->get_admin_user_info(2);
            $data['admin_di_info'] = $this->Distributer_Model->get_admin_user_info(3);
        }
        if ($level == 3) {
            $data['admin_ss_info'] = $this->Distributer_Model->get_admin_user_info(1);
            $data['admin_di_info'] = $this->Distributer_Model->get_admin_user_info(2);
        }
        if ($level == 4) {
            $data['admin_di_info'] = $this->Distributer_Model->get_admin_user_info(1);
        }
        //echo '<pre/>';print_r($data['admin_user_info']);exit;
        $this->load->view('distributor/admin_user_manager', $data);
    }

    public function view_admin_info($admin_id = '', $status = '', $errors = '') {
        $data['status'] = $status;
        $data['errors'] = $errors;
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['admin_id'] = $admin_id;
        $data['admin_info'] = $this->Distributer_Model->get_admin_info_by_id($admin_id);
        $data['admin_group'] = $this->Distributer_Model->get_admin_groups();
        $data['admin_list'] = $this->Distributer_Model->get_admin_list();
        //echo '<pre/>';print_r($data['admin_info']);exit;
        $this->load->view('distributor/view_admin_info', $data);
    }

    public function edit_privileges($admin_id, $status = '', $errors = '') {
        $data['status'] = $status;
        $data['errors'] = $errors;
        $data['admin_info'] = $this->Distributer_Model->get_admin_info_by_id($admin_id);
        $data['admin_group'] = $this->Distributer_Model->get_admin_group_privileges($data['admin_info']->admin_group);

        $result_privileges = $this->Distributer_Model->get_admin_privileges($data['admin_info']->admin_id);
        $privileges = array();
        if (!empty($result_privileges)) {
            foreach ($result_privileges as $rpr) {
                $privileges[] = $rpr->privilege_id;
            }
        }
        $data['admin_privileges'] = $privileges;
        $this->load->view('distributor/view_admin_privileges', $data);
    }

    public function update_admin_privileges($admin_id) {

        $this->Distributer_Model->delete_admin_privileges($admin_id);
        $admin_privileges = $this->input->post('admin_privilege');
        if (!empty($admin_privileges)) {
            $data['admin_info'] = $this->Distributer_Model->get_admin_info_by_id($admin_id);
            $result_privileges = $this->Distributer_Model->get_admin_group_privileges($data['admin_info']->admin_group);
            $privileges = array();
            if (!empty($result_privileges)) {
                foreach ($result_privileges as $rpr) {
                    $privileges[] = $rpr->privilege_id;
                }
            }
            foreach ($admin_privileges as $apr) {
                if (in_array($apr, $privileges)) {
                    if ($this->Distributer_Model->add_admin_privileges($admin_id, $apr)) {

                    }
                }
            }
            redirect('distributor/edit_privileges/' . $admin_id . '/1', 'refresh');
        }
    }

    public function update_admin_info() {
        $this->form_validation->set_rules('admin_group', 'Admin User Group', 'required');
        $this->form_validation->set_rules('admin_parent', 'Admin User Parent', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]|is_unique[admin_info.mobile_no]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $data['status'] = '';
        $data['errors'] = '';
        $data['country_list'] = $this->Home_Model->get_country_list();

        $data['admin_id'] = $admin_id = $this->input->post('admin_id');
        $data['admin_info'] = $this->Distributer_Model->get_admin_info_by_id($admin_id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('distributor/view_admin_info', $data);
        } else {
            //echo '<pre/>';print_r($_POST);exit;
            $admin_group = $this->input->post('admin_group');
            $admin_parent = $this->input->post('admin_parent');
            $admin_id = $this->input->post('admin_id');
            $title = $this->input->post('title');
            $first_name = $this->input->post('first_name');
            $middle_name = $this->input->post('middle_name');
            $last_name = $this->input->post('last_name');
            $mobile_no = $this->input->post('mobile_no');
            $address = $this->input->post('address');
            $pin_code = $this->input->post('pin_code');
            $city = $this->input->post('city');
            $state = $this->input->post('state');
            $country = $this->input->post('country');

            $admin_email = $this->input->post('admin_email');

            if ($this->Distributer_Model->update_admin($admin_id, $title, $first_name, $middle_name, $last_name, $mobile_no, $address, $pin_code, $city, $state, $country, $admin_group, $admin_parent)) {
                redirect('distributor/view_admin_info/' . $admin_id . '/1', 'refresh');
            } else {
                $data['errors'] = 'Sub Admin Profile Not Updated. Please try after some time...';
                $this->load->view('distributor/view_admin_info', $data);
            }
        }
    }

    function change_admin_password($admin_id = '') {
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');

        $data['status'] = '';
        $data['errors'] = '';

        $data['admin_id'] = $admin_id;
        $data['admin_info'] = $admin_info = $this->Distributer_Model->get_admin_info_by_id($admin_id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('distributor/change_admin_password', $data);
        } else {
            if ($this->input->post('password') == $this->input->post('passconf')) {
                $password = md5($this->input->post('password'));
                if ($this->Distributer_Model->update_admin_password($admin_id, $password)) {
                    $data['status'] = 1;
                } else {
                    $data['errors'] = 'Sub Admin Password not Updated. Please try after some time...';
                }
            } else {
                $data['errors'] = 'Current Password is wrong. Please enter correct current password...';
            }

            $this->load->view('distributor/change_admin_password', $data);
        }
    }

    function manage_admin_user_status() {
        if (isset($_POST['admin_id']) && isset($_POST['status'])) {
            $admin_id = $_POST['admin_id'];
            $status = $_POST['status'];
            $update = $this->Distributer_Model->manage_admin_user_status($admin_id, $status);
            echo $update;
        } else {
            return false;
        }
    }

    // B2C Hotel Markup Manager
    public function hotel_markup_manager() {
        $data['admin_list'] = $this->Distributer_Model->get_active_admin_list();

        $data['api_list'] = $this->Home_Model->get_api_list();
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['distributor_markup_list'] = $this->Distributer_Model->get_hotel_markup_list();
        //echo '<pre/>';print_r($data);exit;
        $this->load->view('distributor/hotel_markup_manager', $data);
    }

    // B2C Flight Markup Manager
    public function flight_markup_manager() {
        $data['admin_list'] = $this->Distributer_Model->get_active_admin_list();
        $data['api_list'] = $this->Home_Model->get_api_list();
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['distributor_markup_list'] = $this->Distributer_Model->get_flight_markup_list();
        //echo '<pre/>';print_r($data);exit;
        $this->load->view('distributor/flight_markup_manager', $data);
    }

    public function bus_markup_manager() {
        $data['agent_list'] = $this->Distributer_Model->get_active_admin_list();
        $data['api_list'] = $this->Home_Model->get_api_list();
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['distributor_markup_list'] = $this->Distributer_Model->get_bus_markup_list();
        //echo '<pre/>';print_r($data);exit;
        $this->load->view('distributor/bus_markup_manager', $data);
    }

    public function update_distributor_markups() {
        //echo '<pre/>';print_r($_POST);exit;
        if (isset($_POST) && isset($_POST['service_type'])) {
            $admin = $_POST['admin_no'];
            $service_type = $_POST['service_type'];
            $markup_type = $_POST['markup_type'];
            $api_name = $_POST['api_name'];
            $markup = $_POST['markup'];
            $country = $_POST['country'];

            $admin_list = $this->Distributer_Model->get_active_admin_list();
            $api_list = $this->Home_Model->get_api_list_by_service($service_type);

            if ($markup_type == 'generic') {
                if ($api_name == 'all' && $admin == 'all') {
                    $this->Distributer_Model->delete_distributor_markup($markup_type, $service_type);

                    for ($i = 0; $i < count($admin_list); $i++) {
                        for ($j = 0; $j < count($api_list); $j++) {
                            $this->Distributer_Model->add_distributor_markup($country, $admin_list[$i]->admin_no, $api_list[$j]->api_name, $markup, $markup_type, $service_type);
                        }
                    }
                } else if ($api_name != 'all' && $admin == 'all') {
                    $this->Distributer_Model->delete_distributor_markup($markup_type, $service_type, $api_name);
                    for ($i = 0; $i < count($admin_list); $i++) {
                        $this->Distributer_Model->add_distributor_markup($country, $admin_list[$i]->admin_no, $api_name, $markup, $markup_type, $service_type);
                    }
                } else if ($api_name == 'all' && $admin != 'all') {
                    $this->Distributer_Model->delete_distributor_markup_new($markup_type, $service_type, $admin, $api_name, $country);
                    for ($i = 0; $i < count($api_list); $i++) {
                        $this->Distributer_Model->add_distributor_markup($country, $admin, $api_list[$i]->api_name, $markup, $markup_type, $service_type);
                    }
                } else if ($api_name != 'all' && $admin != 'all') {
                    $this->Distributer_Model->delete_distributor_markup_new($markup_type, $service_type, $admin, $api_name, $country);
                    $this->Distributer_Model->add_distributor_markup($country, $admin, $api_name, $markup, $markup_type, $service_type);
                }
            } else if ($markup_type == 'specific') {
                if ($api_name == 'all' && $admin == 'all' && $country == 'all') {
                    $this->Distributer_Model->delete_distributor_markup($markup_type, $service_type, $admin, $api_name, $country);
                    for ($i = 0; $i < count($admin_list); $i++) {
                        for ($j = 0; $j < count($api_list); $j++) {
                            $this->Distributer_Model->add_distributor_markup($country, $admin_list[$i]->admin_no, $api_list[$j]->api_name, $markup, $markup_type, $service_type);
                        }
                    }
                } else if ($api_name != 'all' && $admin == 'all' && $country == 'all') {
                    $this->Distributer_Model->delete_distributor_markup($markup_type, $service_type, $api_name);
                    for ($i = 0; $i < count($admin_list); $i++) {
                        $this->Distributer_Model->add_distributor_markup($country, $admin_list[$i]->admin_no, $api_name, $markup, $markup_type, $service_type);
                    }
                } else if ($api_name == 'all' && $admin != 'all' && $country == 'all') {
                    $this->Distributer_Model->delete_distributor_markup_new($markup_type, $service_type, $admin, $api_name, $country);
                    for ($i = 0; $i < count($api_list); $i++) {
                        $this->Distributer_Model->add_distributor_markup($country, $admin, $api_list[$i]->api_name, $markup, $markup_type, $service_type);
                    }
                } else if ($api_name != 'all' && $admin != 'all' && $country == 'all') {
                    $this->Distributer_Model->delete_distributor_markup_new($markup_type, $service_type, $admin, $api_name, $country);
                    $this->Distributer_Model->add_distributor_markup($country, $admin, $api_name, $markup, $markup_type, $service_type);
                }


                if ($api_name == 'all' && $admin == 'all' && $country != 'all') {
                    //Modified
                    //$this->Distributer_Model->delete_distributor_markup($markup_type,$service_type,$admin,$api_name,$country);
                    $this->Distributer_Model->delete_distributor_markup($markup_type, $service_type);
                    for ($i = 0; $i < count($admin_list); $i++) {
                        for ($j = 0; $j < count($api_list); $j++) {
                            $this->Distributer_Model->add_distributor_markup($country, $admin_list[$i]->admin_no, $api_list[$j]->api_name, $markup, $markup_type, $service_type);
                        }
                    }
                } else if ($api_name != 'all' && $admin == 'all' && $country != 'all') {
                    $this->Distributer_Model->delete_distributor_markup_new($markup_type, $service_type, $admin, $api_name, $country);
                    for ($i = 0; $i < count($admin_list); $i++) {
                        $this->Distributer_Model->add_distributor_markup($country, $admin_list[$i]->admin_no, $api_name, $markup, $markup_type, $service_type);
                    }
                } else if ($api_name == 'all' && $admin != 'all' && $country != 'all') {
                    $this->Distributer_Model->delete_distributor_markup_new($markup_type, $service_type, $admin, $api_name, $country);
                    for ($i = 0; $i < count($api_list); $i++) {
                        $this->Distributer_Model->add_distributor_markup($country, $admin, $api_list[$i]->api_name, $markup, $markup_type, $service_type);
                    }
                } else if ($api_name != 'all' && $admin != 'all' && $country != 'all') {
                    $this->Distributer_Model->delete_distributor_markup_new($markup_type, $service_type, $admin, $api_name, $country);
                    $this->Distributer_Model->add_distributor_markup($country, $admin, $api_name, $markup, $markup_type, $service_type);
                }
            }

            echo '1';
        } else {
            echo '1';
        }
    }

    public function manage_distributor_markup_status() {
        if (isset($_POST['markup_id']) && isset($_POST['status'])) {
            $markup_id = $_POST['markup_id'];
            $status = $_POST['status'];
            if ($status != '2') {
                $update = $this->Distributer_Model->manage_distributor_markup_status($markup_id, $status);
            } else {
                $update = $this->Distributer_Model->delete_distributor_markup_status($markup_id);
            }
            echo $update;
        } else {
            return false;
        }
    }

    // B2C Car Markup Manager
    /* public function car_markup_manager()
      {
      $data['api_list'] = $this->Home_Model->get_api_list();
      $data['country_list'] = $this->Home_Model->get_country_list();
      $data['b2c_markup_list'] = $this->B2c_Model->get_car_markup_list();
      //echo '<pre/>';print_r($data);exit;
      $this->load->view('distributor/car_markup_manager', $data);

      } */

    public function pinmaxcheck($in) {

        $admin_pins = $this->Distributer_Model->get_max_admin_pins();
        /* if(intval($in) == 0) {
          $this->form_validation->set_message('pinmaxcheck', 'Admin Pin cannot be zero');
          return FALSE;
          } */
        if (!$this->admin_auth->is_admin() && intval($in) > $admin_pins) {
            $this->form_validation->set_message('pinmaxcheck', 'Availabe pins is ' . $admin_pins);
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function checkpinsavailable($in) {
        if (!$this->admin_auth->is_admin()) {
            $pins = $this->input->post('ad_pins');
            if ($this->Distributer_Model->check_pins_available(intval($in), $pins)) {
                return TRUE;
            } else {
                $this->form_validation->set_message('checkpinsavailable', 'Pins not available request pins.');
                return FALSE;
            }
        } else {
            return TRUE;
        }
    }

    public function admin_pins_manager() {
        $data['admin_pins'] = $this->Distributer_Model->get_admin_pins();
        $data['admin_active_pins'] = $this->Distributer_Model->get_admin_active_pins();
        $this->load->view('distributor/admin_pins_manager', $data);
    }

    public function request_admin_pins() {
        $admin_id = $this->input->post('admin_id');
        $admin_details = $this->Distributer_Model->get_admin_info_by_id($admin_id);
        if (!empty($admin_details)) {
            $data = array(
                'admin_id' => $admin_details->admin_id,
                'admin_no' => $admin_details->admin_no,
                'admin_parent' => $admin_details->admin_parent,
                'status' => 1,
            );
            $this->Distributer_Model->insert_adminpin_request($admin_details->admin_id, $data);
            echo json_encode(array('status' => '0'));
            die();
        }
        echo json_encode(array('status' => '1'));
        die();
    }

    public function add_distributor_pins($admin_id) {
        $this->form_validation->set_rules('add_pins', 'Add Pins', 'trim|required');

        $data['admin_info'] = $admin_info = $this->Distributer_Model->get_admin_info_by_id($admin_id);
        if (!empty($data['admin_info'])) {
            if ($this->form_validation->run() != FALSE) {
                $add_pins = $this->input->post('add_pins');
                $data = array(
                    //'ad_pins' =>  $add_pins + $data['admin_info']->ad_pins,
                    'available_pins' => $add_pins + $data['admin_info']->available_pins,
                );
                $this->Distributer_Model->update_admin_pins($admin_info->admin_id, $data);
                $this->Distributer_Model->update_admin_pins_request($admin_info->admin_id);
                redirect('distributor/admin_pins_manager', 'refresh');
            }
            $this->load->view('distributor/add_admin_pins', $data);
        }
    }

    public function view_admin_balance() {

        $data['distributor'] = $this->Distributer_Model->get_distributor_balance();
        $this->load->view('distributor/view_admin_balance', $data);
    }

    public function view_admin_act_summary() {
        $data['admin_act_summary'] = $this->Distributer_Model->get_admin_act_summary();
        $data['admin_active_act_summary'] = $this->Distributer_Model->get_active_admin_act_summary();
        $this->load->view('distributor/admin_act_summary_manager', $data);
    }

    /* 	public function view_admin_act_summary($admin_id) {
      if(!empty($admin_id)) {
      $data['admin_act_summary'] = $this->Distributer_Model->get_admin_act_summary($admin_id);
      //$data['admin_active_act_summary'] = $this->Distributer_Model->get_active_admin_act_summary();
      $this->load->view('distributor/view_admin_act_summary',$data);
      }
      } */

    public function admin_pay_distributor($admin_id) {
        if (!empty($admin_id)) {
            $data = array();
            $data['admin_id'] = $admin_id;

            $data['available_balance'] = $this->Distributer_Model->get_distributor_available_balance($admin_id);
            if ($this->input->server('REQUEST_METHOD') === 'POST') {
                $this->form_validation->set_rules('pay_amount', ' Pay Amount', 'required');
                if ($this->form_validation->run()) {
                    $pay_amount = $this->input->post('pay_amount');
                    $balance = $data['available_balance'] - $pay_amount;
                    $distributor = $this->Distributer_Model->get_admin_info_by_id($admin_id);
                    $insertData = array(
                        'transaction_id' => $this->generateRandomString(10),
                        'admin_id' => $distributor->admin_id,
                        'admin_no' => $distributor->admin_no,
                        'transaction_summary' => 'Paid Distributor',
                        'booked_amount' => 0,
                        'paid_amount' => $pay_amount,
                        'available_balance' => $balance,
                        'transaction_datetime' => date('Y-m-d H:i:s'),
                        'user_id' => '0',
                        'remarks' => 'Paid Distributor',
                    );
                    $data['success'] = 'Paid to supplier';
                    $this->Distributer_Model->insert_distributor_act_summary($insertData);
                    redirect('distributor/view_admin_act_summary/' . $admin_id, 'refresh');
                }
            }
            //$data['act_summary'] = $this->Billing_Model->get_supplier_summary($supplier_id);
            $this->load->view('distributor/pay_distributor', $data);
        }
    }

    public function deposit_amount($admin_id) {

        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|integer');
        $this->form_validation->set_rules('value_date', 'Date', 'trim|required');
        $this->form_validation->set_rules('transaction_mode', 'Transaction Mode', 'required');
        $this->form_validation->set_rules('branch', 'Branch', 'trim|required');
        $this->form_validation->set_rules('bank', 'Bank', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('transaction_id', 'Transaction Id', 'trim|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');
        $data['admin_info'] = $admin_info = $this->Distributer_Model->get_admin_info_by_id($admin_id);

        if ($this->form_validation->run() != FALSE) {
            $amount = $this->input->post('amount');
            $value_date = $this->input->post('value_date');
            $transaction_mode = $this->input->post('transaction_mode');
            $bank = $this->input->post('bank');
            $branch = $this->input->post('branch');
            $city = $this->input->post('city');
            $transaction_id = $this->input->post('transaction_id');
            $remarks = $this->input->post('remarks');

            $admin_no = $data['admin_info']->admin_no;
            $admin_group = $data['admin_info']->admin_group;
            $admin_parent = $data['admin_info']->admin_parent;

            if ($this->Distributer_Model->add_deposit_request($admin_id, $admin_no, $admin_group, $admin_parent, $amount, $value_date, $transaction_mode, $bank, $branch, $city, $transaction_id, $remarks)) {
                $data['status'] = 1;
            } else {
                $data['errors'] = 'Transaction is not updated. Please try after some time...';
            }
        }
        $data['admin_act_summary'] = $this->Distributer_Model->get_admin_available_balance($admin_id);
        $data['admin_id'] = $admin_id;
        $this->load->view('distributor/add_deposit', $data);
    }

    public function admin_deposit_approve($acc_id, $admin_id) {
        $available = '0';
        $deposite = '0';
        $status = 'Accepted';
        $data['admin_id'] = $admin_id;
        $data['acc_id'] = $acc_id;
        $balance = $this->Distributer_Model->get_admin_available_balance($admin_id);
        $deposite = $this->Distributer_Model->get_admin_approved_amount($acc_id);
        $balance = empty($balance) ? 0 : $balance;
        // $available = $this->Home_Model->get_available_balance($agentno);
        $curr_admin_bal = $this->Home_Model->get_admin_available_balance($this->session->userdata('admin_id'));
        $data['curr_admin_bal'] = empty($curr_admin_bal) ? 0 : $curr_admin_bal;
        $data['deposit'] = $deposite->deposit_amount;
        $data['transact_id'] = $deposite->transaction_id;
        $data['bank'] = $deposite->bank;
        $data['branch'] = $deposite->branch;
        $data['city'] = $deposite->city;

        if ($deposite->deposit_amount < $data['curr_admin_bal'] || $this->admin_auth->is_admin()) {
            $data['appr_perm'] = 1;
        } else {
            $data['appr_perm'] = 0;
        }

        $data['available_balance'] = $balance;
        $this->load->view('distributor/approve_page', $data);
    }

    public function admin_deposit_decline($acc_id, $admin_id) {
        $deposit = $this->Distributer_Model->admin_decline_deposit($acc_id, $admin_id);

        $data['available_balance'] = $deposit;
        redirect('distributor/view_admin_act_summary', 'refresh');
    }

    function admin_approve_amount($acc_id, $admin_id) {
        $dep_amt = $this->input->post('dep_amt');
        $depositno = $this->input->post('depositno');
        $curr_admin_bal = $this->Home_Model->get_admin_available_balance($this->session->userdata('admin_id'));
        // echo '<pre>'; print_r($_POST);print_r($curr_admin_bal); exit;
        //echo $this->admin_auth->is_admin();exit;
        if (!$this->admin_auth->is_admin()) {
            if ($curr_admin_bal < $dep_amt) {
                echo 'You do not have sufficient balance to approve';
                exit;
            }
        }
        //	exit;
        $available_balance = $this->Distributer_Model->get_admin_available_balance($admin_id);

        $total = $available_balance + $dep_amt;

        // DEDUCTING FROM HIS OWN ACCOUNT
        $deduct_am = $curr_admin_bal - $dep_amt;
        $below_admin_info = $this->Distributer_Model->get_admin_info_by_id($admin_id);
        $data['admin_info'] = $admin_info = $this->Distributer_Model->get_admin_info_by_id($this->session->userdata('admin_id'));
        $this->Distributer_Model->deduct_admin_amount($admin_info->admin_id, $admin_info->admin_no, $admin_info->admin_group, $admin_info->admin_parent, $dep_amt, $deduct_am, $below_admin_info->admin_id, $below_admin_info->admin_no, 'deduction for below user');
        // DEDUCTING FROM HIS OWN ACCOUNT

        $update = $this->Distributer_Model->admin_update_deposit_status($dep_amt, $acc_id, $total);

        redirect('distributor/view_admin_act_summary', 'refresh');
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return self::RefPrefix . $randomString;
    }

    public function inbox() {
        $admin_id = $this->session->userdata('admin_id');
        $data['inbox_distributor'] = $this->Distributer_Model->get_all_messages($admin_id);
        $this->load->view('distributor/inbox', $data);
    }

    public function view_message($msgId) {
        $data['message_info'] = $message_info = $this->Distributer_Model->get_email_message($msgId);
        $data['reply_message_info'] = $this->Distributer_Model->get_reply_email_message($msgId);
        //echo '<pre/>';print_r($data);exit;

        if ($message_info->message_status == 'UR') {
            $this->Distributer_Model->update_email_status($msgId, 'R');
        }

        $this->load->view('distributor/view_message', $data);
    }

    public function sent_message() {

        $this->form_validation->set_rules('admin_details', 'To Email-Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        $admin_id = $this->session->userdata('admin_id');
        $data['admins_list'] = $this->Distributer_Model->get_admins_list($admin_id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('distributor/sent_message', $data);
        } else {
            //echo '<pre/>';print_r($_POST);exit;
            $to_admin_id = 0;
            $to_email = '';
            $to_name = '';
            $admin_details = explode('&&', $this->input->post('admin_details'));

            $to_admin_id = $admin_details[0];
            $to_email = $admin_details[1];
            $to_name = $admin_details[2];
            $admin_id = $this->session->userdata('admin_id');
            if ($this->admin_auth->is_admin()) {
                $from_name = 'Admin';
            } else {
                $from_name = $this->session->userdata('admin_name');
            }
            $from_email = $this->session->userdata('admin_email');

            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            $sent_datetime = date('Y-m-d H:i:s');
            $admin_id = $this->session->userdata('admin_id');
            $send_data = array(
                'sub_id' => 0,
                'admin_id' => $admin_id,
                'to_admin_id' => $to_admin_id,
                'from_email' => $from_email,
                'from_name' => $from_name,
                'to_email' => preg_replace('/;/', '', $to_email),
                'to_name' => preg_replace('/;/', '', $to_name),
                'subject' => $subject,
                'message' => $message,
                'message_status' => 'UR',
                'sent_datetime' => $sent_datetime
            );
            $this->Distributer_Model->reply_message($send_data);

            redirect('distributor/inbox', 'refresh');
        }
    }

    public function reply_message() {
        $this->form_validation->set_rules('message', 'Message', 'required|xss_clean');

        $msg_id = $sub_id = $this->input->post('msg_id');
        $data['message_info'] = $message_info = $this->Distributer_Model->get_email_message($msg_id);
        $data['reply_message_info'] = $this->Distributer_Model->get_reply_email_message($msg_id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('distributor/view_message', $data);
        } else {
            $admin_id = $this->session->userdata('admin_id');
            //echo '<pre/>';print_r($_POST);exit;
            $subject = $this->input->post('subject');
            $to_admin_id = $this->input->post('to_admin_id');
            $message = $this->input->post('message');

            if ($message_info->admin_id == $admin_id) {
                $from_name = $message_info->from_name;
                $from_email = $message_info->from_email;
                $to_name = $message_info->to_name;
                $to_email = $message_info->to_email;
            } else {
                $from_name = $message_info->to_name;
                $from_email = $message_info->to_email;
                $to_name = $message_info->from_name;
                $to_email = $message_info->from_email;
            }

            $replyed_datetime = date('Y-m-d H:i:s');
            $reply_data = array(
                'sub_id' => $sub_id,
                'admin_id' => $admin_id,
                'to_admin_id' => $to_admin_id,
                'from_email' => $from_email,
                'from_name' => $from_name,
                'to_email' => $to_email,
                'to_name' => $to_name,
                'subject' => $subject,
                'message' => $message,
                'message_status' => 'RE',
                'replyed_datetime' => $replyed_datetime,
                'sent_datetime' => $replyed_datetime
            );

            $this->Distributer_Model->reply_message($reply_data);

            redirect('distributor/view_message/' . $msg_id, 'refresh');
        }
    }

    public function delete_message($msgId) {
        $data['message_info'] = $message_info = $this->Distributer_Model->get_email_message($msgId);

        $this->Distributer_Model->update_email_status($msgId, 'T');

        redirect('distributor/inbox', 'refresh');
    }

    public function insertadmin_privelage() {
        $query = $this->db->select('*')->from('admin_info')->order_by('admin_id', 'ASC')->get();
        //echo '<pre>';print_r($query->result());
        foreach ($query->result() as $val) {
            $this->Distributer_Model->add_privileges($val->admin_id, $val->admin_group);
        }
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */