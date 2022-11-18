<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier extends CI_Controller {

    const RefPrefix = 'XMT';

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Sup_Model');
        $this->load->model('Home_Model');
        $this->load->model('SupplierHotels_Model');
        $this->load->model('Businesstype_Model');
        $this->load->model('Citylist_Model');
        $this->load->model('Facilities_Model');
        $this->load->model('Roomtype_Model');
        $this->load->model('Billing_Model');
          $this->load->model('Email_Model');
             $this->load->library('admin_auth');
        $this->is_admin_logged_in();
    }

    private function is_admin_logged_in() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login/index');
        }
    }

//    function create() {
//        $this->load->view('supplier/create_sup');
//    }

    public function sup_hotels() {
        $data['supplier_hotels'] = $this->Sup_Model->get_sup_hotels();
        $data['supplier_hotels_active'] = $this->Sup_Model->get_sup_hotels_active();
        $this->load->view('supplier/sup_hotels', $data);
    }

    public function manageHotelStatus($hotel_id) {
        $this->Sup_Model->sup_hotels_changestatus($hotel_id);
        redirect('supplier/sup_hotels');
    }

    public function create_sup() {
        $this->form_validation->set_rules('supplier_email', 'Email', 'trim|required|valid_email|is_unique[supplier_info.supplier_email]');
        $this->form_validation->set_rules('supplier_password', 'Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        $this->form_validation->set_rules('supplier_name', 'Supplier Name', 'trim|required');
        //$this->form_validation->set_rules('agency_logo', 'Agency Logo', 'trim|required');
//        $this->form_validation->set_rules('currency_type', 'Currency', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
        $this->form_validation->set_rules('office_phone_no', 'Office Phone No', 'trim|required|integer|min_length[10]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        //  $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'required');

        $data['status'] = '';
        $data['errors'] = '';
        $data['country_list'] = $this->Home_Model->get_country_list();
//        $data['currency_list'] = $this->Home_Model->get_currency_list();

        if ($this->form_validation->run() == FALSE) {
            $data['supplier_email'] = $this->input->post('supplier_email');
            $data['supplier_name'] = $this->input->post('supplier_name');
            $data['first_name'] = $this->input->post('first_name');
            $data['middle_name'] = $this->input->post('middle_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['mobile_no'] = $this->input->post('mobile_no');
            $data['office_phone_no'] = $this->input->post('office_phone_no');
            $data['address'] = $this->input->post('address');
            $data['pin_code'] = $this->input->post('pin_code');
            $data['city'] = $this->input->post('city');
            $data['state'] = $this->input->post('state');

            $this->load->view('supplier/create_sup', $data);
        } else {
            //echo '<pre/>';print_r($_POST);exit;			
            $supplier_email = $this->input->post('supplier_email');
            $supplier_password = md5($this->input->post('supplier_password'));
            $supplier_name = $this->input->post('supplier_name');
//            $currency_type = $this->input->post('currency_type');
            $title = $this->input->post('title');
            $first_name = $this->input->post('first_name');
            $middle_name = $this->input->post('middle_name');
            $last_name = $this->input->post('last_name');
            $mobile_no = $this->input->post('mobile_no');
            $office_phone_no = $this->input->post('office_phone_no');
            $address = $this->input->post('address');
            $pin_code = $this->input->post('pin_code');
            $city = $this->input->post('city');
            $state = $this->input->post('state');
            $country = $this->input->post('country');

            $email_check = $this->Sup_Model->check_email_availability($supplier_email);

            if ($email_check != '' || !empty($email_check)) {
                $data['errors'] = 'Email Already Exists. Please use different email id to continue registration...';
                $this->load->view('supplier/create_sup', $data);
            } else {
                if ($this->Sup_Model->add_sup($supplier_email, $supplier_password, $supplier_name, $title, $first_name, $middle_name, $last_name, $mobile_no, $office_phone_no, $address, $pin_code, $city, $state, $country)) {
                     $email_data = array(
                                'email' => $supplier_email,
                                'title' => $title,
                                'first_name' => $first_name,
                         'password'=>$this->input->post('supplier_password'),
                            );
                            //$this->Email_Model->create_sup_mail($email_data);
                    redirect('supplier/sup_manager', 'refresh');
                } else {
                    $data['errors'] = 'Supplier Registration Not Done. Please try after some time...';
                    $this->load->view('supplier/create_sup', $data);
                }
            }
        }
    }

    // Call Back validation 
    public function emailid_check($str) {
        if ($str == 'test') {
            $this->form_validation->set_message('emailid_check', 'The %s field can not be the word "test"');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function sup_manager() {
        $data['supplier_info'] = $this->Sup_Model->get_sup_list();
        $data['supplier_info_active'] = $this->Sup_Model->get_sup_list_active();
//        echo '<pre/>';print_r($data['supplier_info_active']);exit;	
        $this->load->view('supplier/sup_manager', $data);
    }

    public function view_sup_info($supplier_id = '', $status = '', $errors = '') {
        $data['status'] = $status;
        $data['errors'] = $errors;
        $data['country_list'] = $this->Home_Model->get_country_list();
//        $data['currency_list'] = $this->Home_Model->get_currency_list();

        $data['supplier_id'] = $supplier_id;
        $data['supplier_info'] = $this->Sup_Model->get_sup_info_by_id($supplier_id);
//        echo '<pre/>';print_r($data['supplier_info']);exit;	
        $this->load->view('supplier/view_sup_info', $data);
    }

    function update_sup_info() {
        $this->form_validation->set_rules('supplier_name', 'Supplier Name', 'trim|required');
//        $this->form_validation->set_rules('currency_type', 'Currency', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
        $this->form_validation->set_rules('office_phone_no', 'Office Phone No', 'trim|required|integer|min_length[10]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        //$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'required');


        $data['status'] = '';
        $data['errors'] = '';
        $data['country_list'] = $this->Home_Model->get_country_list();
//        $data['currency_list'] = $this->Home_Model->get_currency_list();

        $data['supplier_id'] = $supplier_id = $this->input->post('supplier_id');
        $data['supplier_info'] = $this->Sup_Model->get_sup_info_by_id($supplier_id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('supplier/view_sup_info', $data);
        } else {
//            echo '<pre/>';print_r($_POST);exit;			
            $supplier_id = $this->input->post('supplier_id');
            $supplier_name = $this->input->post('supplier_name');

//            $currency_type = $this->input->post('currency_type');
            $title = $this->input->post('title');
            $first_name = $this->input->post('first_name');
            $middle_name = $this->input->post('middle_name');
            $last_name = $this->input->post('last_name');
            $mobile_no = $this->input->post('mobile_no');
            $office_phone_no = $this->input->post('office_phone_no');
            $address = $this->input->post('address');
            $pin_code = $this->input->post('pin_code');
            $city = $this->input->post('city');
            $state = $this->input->post('state');
            $country = $this->input->post('country');

            $supplier_email = $this->input->post('supplier_email');

//        
            if ($this->Sup_Model->update_sup($supplier_id, $supplier_email, $supplier_name, $title, $first_name, $middle_name, $last_name, $mobile_no, $office_phone_no, $address, $pin_code, $city, $state, $country)) {
                redirect('supplier/view_sup_info/' . $supplier_id . '/1', 'refresh');
            } else {
                $data['errors'] = 'Supplier Profile Not Updated. Please try after some time...';
                $this->load->view('supplier/view_sup_info', $data);
            }
        }
    }

    function change_sup_password($supplier_id = '') {
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');

        $data['status'] = '';
        $data['errors'] = '';

        $data['supplier_id'] = $supplier_id;
        $data['supplier_info'] = $supplier_info = $this->Sup_Model->get_sup_info_by_id($supplier_id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('supplier/change_sup_password', $data);
        } else {
            if ($this->input->post('password') == $this->input->post('passconf')) {
                $password = md5($this->input->post('password'));
                if ($this->Sup_Model->update_sup_password($supplier_id, $password)) {
                    $data['status'] = 1;
                } else {
                    $data['errors'] = 'Supplier Password not Updated. Please try after some time...';
                }
            } else {
                $data['errors'] = 'Current Password is wrong. Please enter correct current password...';
            }

            $this->load->view('supplier/change_sup_password', $data);
        }
    }

    public function businesstype() {

        //fetch sql data into arrays
        $data['businesstype'] = $this->Businesstype_Model->get_businesstype();


        $this->load->view('supplier/managebusinesstype/view', $data);
    }

//index

    public function businesstype_add() {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            //form validation
            $this->form_validation->set_rules('business_type', ' Business Type', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $insertinfo = array(
                    'business_type' => $this->input->post('business_type'),
                    'date_time' => date('Y-m-d H:i:s'),
                );
                //if the insert has returned true then we show the flash message
                if ($this->Businesstype_Model->save_businesstype($insertinfo)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
                  $data['businesstype'] = $this->Businesstype_Model->get_businesstype();


        $this->load->view('supplier/managebusinesstype/view', $data);
            }
        }

        $this->load->view('supplier/managebusinesstype/add');
    }

    /**
     * Update item by his id
     * @return void
     */
    public function businesstype_update($id) {


        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('business_type', ' Business Type', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                $updateinfo = array(
                    'business_type' => $this->input->post('business_type'),
                    'date_time' => date('Y-m-d H:i:s'),
                );
                //if the insert has returned true then we show the flash message
                if ($this->Businesstype_Model->update_businesstype($id, $updateinfo) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('supplier/businesstype_update/' . $id . '');
            }//validation run
        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
        //data 
        $data['businesstype'] = $this->Businesstype_Model->get_business_by_id($id);

        $this->load->view('supplier/managebusinesstype/edit', $data);
    }

//update

    /**
     * Delete Business Type by his id
     * @return void
     */
    public function businesstype_delete($id) {

        $this->Businesstype_Model->delete_businesstype($id);
        redirect('supplier/businesstype');
    }

//edit		

    public function citylist() {

        $data['count_citylist'] = $this->Citylist_Model->count_citylist();
        $data['citylist'] = $this->Citylist_Model->get_citylist();
        $this->load->view('supplier/managecitylist/view', $data);
    }

//index

    public function citylist_add() {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            //form validation
            $this->form_validation->set_rules('city_name', ' City Name', 'required');
            $this->form_validation->set_rules('country_name', ' Country Name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $insertinfo = array(
                    'city_name' => $this->input->post('city_name'),
                    'country_name' => $this->input->post('country_name'),
                    'date_time' => date('Y-m-d H:i:s'),
                );
                //if the insert has returned true then we show the flash message
                if ($this->Citylist_Model->save_citylist($insertinfo)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
            }
        }
        $data['country_list'] = $this->Citylist_Model->get_country_list();
        //load the view
        $this->load->view('supplier/managecitylist/add', $data);
    }

    /**
     * Update item by his id
     * @return void
     */
    public function citylist_update($id) {


        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('city_name', ' City Name', 'required');
            $this->form_validation->set_rules('country_name', ' Country Name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                $updateinfo = array(
                    'city_name' => $this->input->post('city_name'),
                    'country_name' => $this->input->post('country_name'),
                    'date_time' => date('Y-m-d H:i:s'),
                );
                //if the insert has returned true then we show the flash message
                if ($this->Citylist_Model->update_citylist($id, $updateinfo) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('supplier/citylist_update/' . $id . '');
            }//validation run
        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
        //data 
        $data['citylist'] = $this->Citylist_Model->get_citylist_by_id($id);
        $data['country_list'] = $this->Citylist_Model->get_country_list();
        //fetch manufactures data to populate the select field

        $this->load->view('supplier/managecitylist/edit', $data);
    }

//update

    /**
     * Delete Business Type by his id
     * @return void
     */
    public function citylist_delete($id) {

        $this->Citylist_Model->delete_citylist($id);
        redirect('supplier/citylist');
    }

//edit	

    public function facilities() {

        //fetch sql data into arrays

        $data['facilities'] = $this->Facilities_Model->get_facilities();

        $this->load->view('supplier/managefacilities/view', $data);
    }

//index

    public function facilities_add() {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            //form validation
            $this->form_validation->set_rules('facility', ' Facility', 'required');
            $this->form_validation->set_rules('facility_type', ' Facility Type', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $insertinfo = array(
                    'facility' => $this->input->post('facility'),
                    'facility_type' => $this->input->post('facility_type'),
                    'date_time' => date('Y-m-d H:i:s'),
                );
                //if the insert has returned true then we show the flash message
                if ($this->Facilities_Model->save_facility($insertinfo)) {
                    $data['flash_message'] = TRUE;
                     $data['facilities'] = $this->Facilities_Model->get_facilities();

        $this->load->view('supplier/managefacilities/view', $data);
                   
                } else {
                    $data['flash_message'] = FALSE;
                     redirect('supplier/facilities_add/', 'refresh');
                }
            }
        }
        $this->load->view('supplier/managefacilities/add');
    }

    /**
     * Update item by his id
     * @return void
     */
    public function facilities_update($id) {


        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('facility', ' Facility', 'required');
            $this->form_validation->set_rules('facility_type', ' Facility Type', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                $updateinfo = array(
                    'facility' => $this->input->post('facility'),
                    'facility_type' => $this->input->post('facility_type'),
                    'date_time' => date('Y-m-d H:i:s'),
                );
                //if the insert has returned true then we show the flash message
                if ($this->Facilities_Model->update_facility($id, $updateinfo) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('supplier/facilities_update/' . $id . '');
            }//validation run
        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
        //data 
        $data['facility'] = $this->Facilities_Model->get_facility_by_id($id);

        $this->load->view('supplier/managefacilities/edit', $data);
    }

//update

    /**
     * Delete Business Type by his id
     * @return void
     */
    public function facilities_delete($id) {

        $this->Facilities_Model->delete_facility($id);
        redirect('supplier/facilities');
    }

//edit	

    public function roomtype() {

        $data['roomtype'] = $this->Roomtype_Model->get_roomtype();

        $this->load->view('supplier/manageroomtype/view', $data);
    }

//index

    public function roomtype_add() {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            //form validation
            $this->form_validation->set_rules('room_type', 'Room Type', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $insertinfo = array(
                    'room_type' => $this->input->post('room_type'),
                    'date_time' => date('Y-m-d H:i:s'),
                );
                //if the insert has returned true then we show the flash message
                if ($this->Roomtype_Model->save_roomtype($insertinfo)) {
                    $data['flash_message'] = TRUE;
                     $data['roomtype'] = $this->Roomtype_Model->get_roomtype();

        $this->load->view('supplier/manageroomtype/view', $data);
                } else {
                    $data['flash_message'] = FALSE;
                }
            }
        }
        $this->load->view('supplier/manageroomtype/add');
    }

    /**
     * Update item by his id
     * @return void
     */
    public function roomtype_update($id) {


        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('room_type', ' Room Type', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                $updateinfo = array(
                    'room_type' => $this->input->post('room_type'),
                    'date_time' => date('Y-m-d H:i:s'),
                );
                //if the insert has returned true then we show the flash message
                if ($this->Roomtype_Model->update_roomtype($id, $updateinfo) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('supplier/roomtype_update/' . $id . '');
            }//validation run
        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
        //data 
        $data['roomtype'] = $this->Roomtype_Model->get_roomtype_by_id($id);

        $this->load->view('supplier/manageroomtype/edit', $data);
    }

//update

    /**
     * Delete Business Type by his id
     * @return void
     */
    public function supplier_delete($id) {

        $this->Roomtype_Model->delete_roomtype($id);
        redirect('supplier/roomtype');
    }

//edit	

    public function supplier_hotels() {
         
        $data['hotels'] = $this->SupplierHotels_Model->get_hotels();
        $data['active_hotels'] = $this->SupplierHotels_Model->get_active_hotels();
        $this->load->view('supplier/managesuphotels/view', $data);
    }
    public function get_hotels_by_supplier($supplier_id){
         $data['hotels'] = $this->SupplierHotels_Model->get_hotels_by_supplier($supplier_id);
       /* if($supplier_id == 0){
            $data['supplier_name'] = 'All';
            $data['supplier_no'] = '';
            $data['hotel_info'] = $this->SupplierHotels_Model->list_hotel();
             // echo $this->db->last_query();exit;
        } else {
            $supplier_info = $this->SupplierHotels_Model->getSupplierById($supplier_id);
            // echo $this->db->last_query();exit;
            $data['supplier_name'] = $supplier_info->supplier_name;
            $data['supplier_no'] = $supplier_info->supplier_no;
            $data['hotel_info'] = $this->SupplierHotels_Model->list_hotel($supplier_id);
        }*/
         $this->load->view('supplier/view_hotel_by_supplier',$data);
    }

    public function suphotels_changestatus($id) {
        $this->SupplierHotels_Model->changestatus_hotel($id);
        redirect('supplier/supplier_hotels', 'refresh');
    }

    public function billing() {
        $data['suppliers'] = $this->Billing_Model->get_supplier_balance();
        //$data['hotels_unpaid'] = $this->Billing_Model->get_hotels_booking_unpaid(); 
        //load the view

        $this->load->view('supplier/managebilling/view', $data);
    }

    public function view_supplier_summary($supplier_id) {
        if (!empty($supplier_id)) {
            $data = array();
            $data['act_summary'] = $this->Billing_Model->get_supplier_summary($supplier_id);
            $this->load->view('supplier/managebilling/view_summary', $data);
        }
    }

    public function billing_pay_supplier($supplier_id) {
        if (!empty($supplier_id)) {
            $data = array();
            $data['supplier_id'] = $supplier_id;

            $data['available_balance'] = $this->Billing_Model->get_supplier_available_balance($supplier_id);
            if ($this->input->server('REQUEST_METHOD') === 'POST') {
                $this->form_validation->set_rules('pay_amount', ' Pay Amount', 'required');
                if ($this->form_validation->run()) {
                    $pay_amount = $this->input->post('pay_amount');
                    $balance = $data['available_balance'] - $pay_amount;
                    $supplier = $this->Billing_Model->get_supplier($supplier_id);
                    $insertData = array(
                        'transaction_id' => $this->generateRandomString(10),
                        'supplier_id' => $supplier->supplier_id,
                        'supplier_no' => $supplier->supplier_no,
                        'transaction_summary' => 'Paid Supplier',
                        'booked_amount' => 0,
                        'paid_amount' => $pay_amount,
                        'available_balance' => $balance,
                        'transaction_datetime' => date('Y-m-d H:i:s'),
                        'user_id' => '0',
                        'remarks' => 'Paid Supplier',
                    );
                    $data['success'] = 'Paid to supplier';
                    $this->Billing_Model->insert_supplier_act_summary($insertData);
                    redirect('supplier/view_supplier_summary/' . $supplier_id, 'refresh');
                }
            }
            //$data['act_summary'] = $this->Billing_Model->get_supplier_summary($supplier_id); 
            $this->load->view('supplier/managebilling/pay_supplier', $data);
        }
    }

    public function billing_mark_status_paid($booking_id) {
        if (!empty($booking_id)) {
            $data = array(
                'paid_status' => 1,
            );
            $this->Billing_Model->update_hotels_booking_status($booking_id, $data);
            $booking_detail = $this->Billing_Model->get_hotels_booking_by_id($booking_id);

            //Add to account summary
            $insertData = array(
                'transaction_id' => $this->generateRandomString(10),
                'supplier_id' => $booking_detail->supplier_id,
                'supplier_no' => $booking_detail->supplier_no,
                'booking_id' => $booking_detail->booking_id,
                'hotel_id' => $booking_detail->sup_hotel_id,
                'hotel_code' => $booking_detail->hotel_code,
                'transaction_summary' => 'Paid Supplier',
                'paid_amount' => $booking_detail->total_amount,
                'city' => $booking_detail->city,
                'booking_date' => $booking_detail->booking_date,
                'transaction_datetime' => date('Y-m-d'),
                'user_id' => $this->session->userdata('admin_id'),
                'remarks' => 'Paid Supplier',
            );
            $this->Billing_Model->insert_supplier_act_summary($insertData);
        }
        redirect('supplier/billing');
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return self::RefPrefix . $randomString;
    }
     public function manage_sup_status($supplier_id,$status){
        $data=array(
            'status'=>$status,
        );
       
       $this->SupplierHotels_Model->update_supplier_status($data,$supplier_id); 
         $data['supplier_info']=$supplier_info = $this->Sup_Model->get_sup_info_by_id($supplier_id);
          if($status==1){
            $sup_status='Active';
        }elseif($status==0){
            $sup_status='De-Active'; 
        }else{
             $sup_status='Blocked'; 
        }
         $info = array(
                'supplier_no' => $supplier_info->supplier_no,
                'email' => $supplier_info->supplier_email,
                'status' => $sup_status
            );
           // $this->Email_Model->status_email_sup($info);
       redirect('supplier/sup_manager','refresh');
    }
    public function refresh_hotels($supplier_id){
       $sup_hotels=$this->SupplierHotels_Model->get_sup_activated_hotels($supplier_id);
      //   echo $this->db->last_query();
       $this->SupplierHotels_Model->delete_sup_old_hotels($supplier_id);
     
       //echo '<pre>';print_r($sup_hotels);exit;
       foreach($sup_hotels as $val){
           $data=array(
               'supplier_id'=>$supplier_id,
               'api'=>'hotel_crs',
               'city_code'=>$val->city_id,
               'hotel_code'=>$val->hotel_code,
               'hotel_name'=>$val->hotel_name,
               'star'=>$val->hotel_rating,
               'location'=>$val->hotel_address,
               'latitude'=>$val->hotel_lat,
               'longitude'=>$val->hotel_long,
               'address'=>$val->hotel_address,
               'phone'=>$val->hotel_phone,
               'fax'=>$val->hotel_fax,
               'postal'=>$val->hotel_postalcode,
               'email'=>$val->hotel_email,
           );
         //  echo '<pre>';print_r($data);exit;
           $this->SupplierHotels_Model->insert_sup_to_perm_hotel($data);
       }
        redirect('supplier/sup_manager', 'refresh');
    }

}

/* End of file b2b.php */
/* Location: ./admin/controllers/b2b.php */