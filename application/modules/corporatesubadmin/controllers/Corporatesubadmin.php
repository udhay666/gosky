<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Corporatesubadmin extends MX_Controller {

    // private $agent_id;
    // private $agent_no;

    public function __construct() {
        parent::__construct();
      
        $this->load->model('Corporatesubadmin_Model');
        // $this->agent_id = $this->session->agent_id;
        // $this->agent_no = $this->session->agent_no;  
    }

    private function agent_logged(){
        if (!$this->session->has_userdata('corporate_sub_logged_in') && !$this->session->has_userdata('user_logged_in')){
            // redirect('agent/login', 'refresh');
            redirect('home/index', 'refresh');
        } else {
            // redirect('home/index', 'refresh');
        }
    }
    public function index(){
        // echo 123;exit;
        $this->load->view('corporatesubadmin/account/login');
    }
    public function login() {
      
        if ($this->session->has_userdata('corporate_sub_logged_in')){
            redirect('corporatesubadmin/dashboard', 'refresh');
        }            
        // $this->load->view('corporate/account/login');
        redirect('home/index', 'refresh');
    }

    public function dashboard() {
        $this->unset_all();
        $this->agent_logged();
        $agent_info = $this->Corporatesubadmin_Model->getAgentInfo();
        $data['agent_info'] = $agent_info;
        $data['search'] = '';
        $this->load->view('home/index', $data);
    }


    public function corporate_register(){
        $this->form_validation->set_rules('agent_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('agent_password', 'Password', 'trim|required');
        $this->form_validation->set_rules('passconf', 'Password', 'trim|required|matches[agent_password]');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer');
        $this->form_validation->set_rules('city', 'City', 'trim|required');

        $data = array();
        $data['message'] = '';
        $insertdata = array(
            'agent_email' => $this->input->post('agent_email'),
            'agency_name' => $this->input->post('agency_name'),
            'website' => $this->input->post('website'),
            'title' => $this->input->post('title'),
            'first_name' => $this->input->post('first_name'),
            'middle_name' => $this->input->post('middle_name'),
            'last_name' => $this->input->post('last_name'),
            'mobile_no' => $this->input->post('mobile_no'),
            'office_phone_no' => $this->input->post('office_phone_no'),
            'fax' => $this->input->post('fax'),
            'address' => $this->input->post('address'),
            'pin_code' => $this->input->post('pin_code'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'country' => $this->input->post('country'),
            'gstnumber'=>trim($this->input->post('gstnumber')),
            'gstcompany'=>trim($this->input->post('gstcompany')),
            'gstcontact'=>trim($this->input->post('gstmobile')),
            'gstemail'=>trim($this->input->post('gstemail')),
           // 'gstaddress'=>trim($this->input->post('gstaddress')),
            'currency_type' => 'INR',
            'agent_type' => 2,
            'status' => 0,
        );

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = validation_errors();
            $status = 'fail';
        } else {
            // echo '<pre/>';print_r($_POST);exit;
            $email_check = $this->Corporatesubadmin_Model->check_email_availability($insertdata['agent_email']);
            if ($email_check != '' || !empty($email_check)) {
                $data['message'] = 'This Email Already Exists. Please use different email id to continue registration...';
                $status = 'fail';
            } else {
                $insertdata['agent_password'] = md5($this->input->post('agent_password'));
                if($_FILES["agency_logo"]["error"] == 4) {
                    // means there is no file uploaded
                    $upd_data['agent_logo'] = '';
                } else {
                    $image_path = $this->uploadImage($insertdata['agent_email']);
                    if($image_path['image_path'] != '') {
                        $upd_data['agent_logo'] = $image_path['image_path'];
                    } else{
                        $upd_data['agent_logo'] = '';
                    }
                }
                // print_r($data['message']);exit;
                $agent_id = $this->Corporatesubadmin_Model->add_agent($insertdata);
                if($agent_id) {
                    $this->Corporatesubadmin_Model->update_agent($agent_id,$upd_data);
                    $success = 'We have received your request. You will receive a confirmation email on your registered email-id once your account has been approved by us.';
                    $status = 'success';
                } else {
                    $data['message'] = 'Corporate Registration Not Done. Please try after some time...';
                    $status = 'fail';
                }
            }
        }
        // print_r($data['message']);exit;
        if($status == 'success') {
            $data_agent = array(
                'title' => $insertdata['title'],
                'first_name' => $insertdata['first_name'],
                'agency_name' => $insertdata['agency_name'],
                'agent_email' => $insertdata['agent_email'],
                'password' => $this->input->post('agent_password'),
            );
            $this->load->module('home/email');
            $this->email->b2b_registration($data_agent);
            redirect('home/success_page/' . base64_encode($success));
        } else {
            $data['country_list'] = $this->Corporatesubadmin_Model->get_country_list();
            // $data['currency_list'] = $this->Corporatesubadmin_Model->get_currency_list();
            $data = array_merge($data, $insertdata);
            $this->load->view('corporatesubadmin/account/corporate_register', $data);
        }
    }

    function update_profile() {
        // echo '<pre/>';print_r($_POST);exit;
        $this->form_validation->set_rules('agency_name', 'Company Name', 'trim|required');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer');
        $this->form_validation->set_rules('city', 'City', 'trim|required');

        $data = array();
        $data['message'] = '';
        $upd_data = array(
            'agency_name' => $this->input->post('agency_name'),
            'website' => $this->input->post('website'),
            'title' => $this->input->post('title'),
            'first_name' => $this->input->post('first_name'),
            'middle_name' => $this->input->post('middle_name'),
            'last_name' => $this->input->post('last_name'),
            'mobile_no' => $this->input->post('mobile_no'),
            'office_phone_no' => $this->input->post('office_phone_no'),
            'fax' => $this->input->post('fax'),
            'address' => $this->input->post('address'),
            'pin_code' => $this->input->post('pin_code'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'country' => $this->input->post('country'),
            'gstnumber'=>trim($this->input->post('gstnumber')),
            'gstcompany'=>trim($this->input->post('gstcompany')),
            'gstcontact'=>trim($this->input->post('gstmobile')),
            'gstemail'=>trim($this->input->post('gstemail')),
            'gstaddress'=>trim($this->input->post('gstaddress')),
            // 'currency_type' => 'INR',
            // 'agent_type' => 1,
        );
        // echo '<pre/>';print_r($upd_data);exit;
        $data['agent_id'] = $agent_id = $this->input->post('agent_id');
        if ($this->form_validation->run() == FALSE) {
            $data['message'] = validation_errors();
            $status = 'fail';
        } else {
            $file_name = $_FILES['agency_logo']['tmp_name'];
            if (!empty($file_name)) {
                $agent_email = $this->input->post('agent_email');
                $image_path = $this->uploadImage($agent_email);
                if($image_path['image_path'] != '') {
                    $upd_data['agent_logo'] = $image_path['image_path'];
                }
            }
            if($this->Corporatesubadmin_Model->update_agent($agent_id,$upd_data)) {
                $success = 'Your Profile Updated Successfully';
                $status = 'success';
            } else {
                $data['message'] = 'Your Profile not Updated...';
                $status = 'fail';
            }
        }
        if($status == 'success') {
            $this->session->set_flashdata('message', $success);
            redirect('corporate/my_profile', 'refresh');
        } else {
            $data['country_list'] = $this->Corporatesubadmin_Model->get_country_list();
            $data['agent_info'] = $this->Corporatesubadmin_Model->getAgentInfo($agent_id);
            // $data['currency_list'] = $this->Corporatesubadmin_Model->get_currency_list();
            $data = array_merge($data, $upd_data);
            $this->load->view('corporatesubadmin/account/view_profile', $data);
        }
    }

    function uploadImage($agent_email) {
        $imagefolder = str_replace('.', '_', str_replace('@', '_', $corporate_email));
        $config['upload_path'] = 'admin/public/uploads/b2b/'.$imagefolder;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = TRUE;
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        if (!$this->upload->do_upload('agency_logo')) {
            $return_arr = array(
                'message' => $this->upload->display_errors(),
                'image_path' => '',
            );
        } else {
            $upload_data = $this->upload->data();
            $image_config["image_library"] = "gd2";
            $image_config["source_image"] = $upload_data["full_path"];
            $image_config['create_thumb'] = FALSE;
            $image_config['maintain_ratio'] = TRUE;
            $image_config['new_image'] = $upload_data["file_path"] . 'agent_logo.png';
            $image_config['quality'] = "100%";
            $image_config['width'] = 320;
            $image_config['height'] = 80;
            $dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
            $image_config['master_dim'] = ($dim > 0) ? "height" : "width";

            $this->load->library('image_lib');
            $this->image_lib->initialize($image_config);

            if (!$this->image_lib->resize()) {
                $return_arr = array(
                    'message' => $this->upload->display_errors(),
                    'image_path' => '',
                );
            } else {
                unlink($upload_data["full_path"]);
                $image_path = 'public/uploads/b2b/' . $imagefolder . '/agent_logo.png'; //working code in admin
                $return_arr = array(
                    'message' => '',
                    'image_path' => $image_path,
                );
            }
            return $return_arr;
        }
    }

    function corporate_login() {

        $loginEmailId = $this->input->post('agent_email');
        if(is_numeric($loginEmailId)){
            $this->form_validation->set_rules('agent_email', 'Mobile No', 'trim|required|integer|max_length[10]|min_length[10]');
        } else {
            $this->form_validation->set_rules('agent_email', 'Email', 'trim|required|valid_email');
        }
        $this->form_validation->set_rules('agent_password', 'Password', 'trim|required');

        if ($this->form_validation->run() !== FALSE) { 
            $loginPassword = $this->input->post('agent_password');
            // $user_type = $this->input->post('user_type');
            $res = $this->Corporatesubadmin_Model->validate_credentials($loginEmailId, $loginPassword);
           /* echo $this->db->last_query();
            echo '<pre/>';print_r($res);exit;*/
            if ($res != '') {
                $sessionAgentInfo = array(
                    'agent_id' => $res->agent_id,
                    'agent_no' => $res->agent_no,
                    'agent_email' => $res->agent_email,
                    'agent_mobile' => $res->mobile_no,
                    'agency_name' => $res->agency_name,
                    'agent_first_name' => $res->first_name,
                    'agent_last_name' => $res->last_name,
                    'agent_type' => $res->agent_type,
                   // 'agent_parent' => $res->agent_parent,
                    'corporate_sub_logged_in' => TRUE
                );
                $this->session->set_userdata($sessionAgentInfo);

                $this->Corporatesubadmin_Model->insert_login_activity();
                //redirect('corporatesubadmin/dashboard', 'refresh');
                redirect('corporatesubadmin/dashboard', 'refresh');
            } else {
                $error = "Sorry !!! ".$loginEmailId." / Password mismatched";
                redirect('home/error_page/' . base64_encode($error));
            }
        } else{
            $error = validation_errors();
            redirect('home/error_page/' . base64_encode($error));
        }
        // $this->load->view('corporate/account/login', $data);
        redirect('home/index', 'refresh');
    }

    public function my_profile() {
        $this->agent_logged();
        $data['country_list'] = $this->Corporatesubadmin_Model->get_country_list();
        $data['agent_id'] = $agent_id = $this->session->userdata('agent_id');

        $data['status'] = '';
        $data['errors'] = '';
        $data['agent_info'] = $this->Corporatesubadmin_Model->getAgentInfo($agent_id);
        // echo '<pre/>';print_r($data['agent_info']);exit;
        $this->load->view('corporatesubadmin/account/view_profile', $data);
    }

     public function add_users() {

        $this->agent_logged();
        $data['country_list'] = $this->Corporatesubadmin_Model->get_country_list();
        $data['agent_id'] = $agent_id = $this->session->userdata('agent_id');
        $data['message'] = '';
         $this->session->set_flashdata('message', $success);
/*
        $data['status'] = '';
        $data['errors'] = '';
        $this->form_validation->set_rules('admin_email', 'Email', 'trim|required|valid_email|is_unique[admin_info.login_email]|xss_clean');
        $this->form_validation->set_rules('admin_password', 'Password', 'trim|required|matches[passconf]');
     
        
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
    
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'required');
       
              
        $data['admin_priviliges']=$this->Corporatesubadmin_Model->get_admin_privilages();

        if($this->form_validation->run()==FALSE)
        {        
            $data['admin_email'] = $this->input->post('admin_email');          
            $data['first_name'] = $this->input->post('first_name');
            
            $data['last_name'] = $this->input->post('last_name');
            $data['mobile_no'] = $this->input->post('mobile_no');       
            $data['address'] = $this->input->post('address');
            $data['pin_code'] = $this->input->post('pin_code');        
            $data['city'] = $this->input->post('city');
            $data['state'] = $this->input->post('state');
           

            $this->load->view('corporate/account/add_users',$data);
        }
        else
        {*/
            
                      
            $admin_email = $this->input->post('admin_email');
            $admin_password = md5($this->input->post('admin_password'));
            
            $first_name = $this->input->post('first_name');
            $middle_name = $this->input->post('middle_name');
            $last_name = $this->input->post('last_name');
            $mobile_no = $this->input->post('mobile_no');         
            $address = $this->input->post('address');
            $pin_code = $this->input->post('pin_code');        
            $city = $this->input->post('city');
            $state = $this->input->post('state');
            $country = $this->input->post('country');
            /*$privilages=$this->input->post('privilages');
            $subprivilages=$this->input->post('subprivilages')*/;
            
            $email_check = $this->Corporatesubadmin_Model->check_subemail_availability($admin_email);
                
            if($email_check != '' || !empty($email_check))
            {               
                $data['errors'] = 'Email Already Exists. Please use different email id to continue ...';
                $this->load->view('corporatesubadmin/account/add_users',$data);
            }
            else
            {
                if($inert_id=$this->Corporatesubadmin_Model->add_admin_user($admin_email,$admin_password,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$role_id))
                {
                    $email_data = array(
                        'agent_email' => $admin_email,
                        'title' => $title,
                        'first_name' => $first_name,
                        'password' => $this->input->post('admin_password')
                    );
                   

                    foreach($privilages as $val){
                        $this->Role_Model->add_subadmin_privilege($inert_id,$val);
                    }

                     foreach($subprivilages as $value){
                        $this->Role_Model->add_subadmin_submodule_privilege($inert_id,$value);
                    }
                    $success = 'Your User Added Successfully';
                    $status = 'success';
                    $data['message'] = 'Your User Added Successfully...';
                    //$status = 'fail';
                    $this->session->set_flashdata('message', $success);
                    $this->load->view('corporatesubadmin/account/add_users', $data);
                    //redirect('corporate/add_users', $data);
                    //$this->load->view('corporate/account/add_users',$data);
                }
                else
                {
                    $data['errors'] = 'Admin User Registration Not Done. Please try after some time...';
                    $this->load->view('corporatesubadmin/account/add_users',$data);
                
                }
            }
        /*}*/
        
    }

    public function logout() {
        $this->session->unset_userdata('agent_id');
        $this->session->unset_userdata('agent_no');
        $this->session->unset_userdata('corporate_sub_logged_in');
        $this->session->sess_destroy();
        redirect('corporatesubadmin/login', 'refresh');
    }

    function corporatesendOtp(){
        // echo '<pre/>';print_r($_POST);exit;
        // error_reporting(-1);
        $loginEmailId = $this->input->post('otp_corporate');
        if(is_numeric($loginEmailId)){
            $this->form_validation->set_rules('otp_corporate', 'Mobile No', 'trim|required|integer|max_length[10]|min_length[10]');
        } else {
            $this->form_validation->set_rules('otp_corporate', 'Email', 'trim|required|valid_email');
        }

        if ($this->form_validation->run() !== FALSE) {
            $res = $this->Corporatesubadmin_Model->validate_credentials_otp($loginEmailId);
            // echo $this->db->last_query();
              // echo '<pre>';print_r($res);exit;
            if ($res !== false) {
                if(is_numeric($loginEmailId)){
                    $this->load->module('home/smsgateway');
                    $otpnum = $this->smsgateway->sendOtp($loginEmailId);
                    $type = 'mobile';
                } else {
                    $otpnum = $this->getOtp(6);
                    $type = 'email';
                }
                // echo $otpnum;//exit;
                $otp = $this->Corporatesubadmin_Model->insertOtp($loginEmailId,$otpnum);
                // echo $this->db->last_query();
                // echo $otp;exit;
                if($otp != ''){
                    $status = 'success';
                    $message = 'Otp sent successfully.';
                    if($type = 'email'){
                        $data_email = array(
                            // 'title' => $insertdata['title'],
                            'first_name' => $res->first_name,
                            'email' => $res->agent_email,
                            'otp' => $otp,
                        );
                        $this->load->module('home/sendemail');
                        $this->sendemail->otp_login_email($data_email);
                    }
                } else {
                    $status = 'fail';
                    $message = 'Otp sent failed. Please try again later.';
                }
            } else {
                $message = "Sorry !!! ".$loginEmailId." is not registered";
                $status = 'fail';
            }
        } else {
            $message = validation_errors();
            $status = 'fail';
        }

        echo json_encode(array(
            'status' => $status,
            'message' => $message,
            'otp_corporate' => $loginEmailId,
        ));
    }
    
    function getOtp($n){
        $generator = "1357902468"; 
        $result = ""; 
        for ($i = 1; $i <= $n; $i++) { 
            $result .= substr($generator, (rand()%(strlen($generator))), 1); 
        } 
        // Return result 
        return $result; 
    }

    function corporateotpLogin(){
        // print_r($_POST);
        $loginEmailId = $this->input->post('otp_corporate');
        $otp_number = $this->input->post('otp_number');
        $this->form_validation->set_rules('otp_number', 'OTP No', 'trim|required|integer');

        if ($this->form_validation->run() !== FALSE) {
            $res = $this->Corporatesubadmin_Model->corporate_validate_otp($loginEmailId,$otp_number);
            // echo $this->db->last_query();
             // echo '<pre/>';print_r($res);exit;
            if ($res !== false) {
                $message = 'Otp matched!';
                $status = 'success';
                $sessionUserInfo = array(
                    'agent_id' => $res->agent_id,
                    'agent_no' => $res->agent_no,
                    'agent_email' => $res->agent_email,
                    'agency_name' => $res->agency_name,
                    'agent_first_name' => $res->first_name,
                    'agent_last_name' => $res->last_name,
                    'agent_type' => $res->agent_type,
                   // 'agent_parent' => $res->agent_parent,
                    'corporate_sub_logged_in' => TRUE
                );

                $this->session->set_userdata($sessionUserInfo);
                $this->Corporatesubadmin_Model->removeOTP($loginEmailId);
                $this->Corporatesubadmin_Model->insert_login_activity();
                // exit;
                $message = 'Login Successfull';
                $status = 'success';
            } else {
                $message = 'Invalid OTP.';
                $status = 'fail';
                // redirect('' . base64_encode($message));
            }
        } else {
            $message = validation_errors();
            $status = 'fail';
            // redirect('' . base64_encode($message));
        }
         echo json_encode(array(
            'status' => $status,
            'message' => $message,
            'otp_corporate' => $loginEmailId,
        ));   
    }

    public function forgot_password() {
        $loginEmailId = $this->input->post('email_id');
        $status = '';
        if(is_numeric($loginEmailId)){
            $this->form_validation->set_rules('email_id', 'Mobile No', 'trim|required|integer|max_length[10]|min_length[10]');
        } else {
            $this->form_validation->set_rules('email_id', 'Email', 'trim|required|valid_email');
        }

        if ($this->form_validation->run() !== FALSE) {
            // $data = base64_encode($loginEmailId);
            $getpassword = $this->Corporatesubadmin_Model->get_forgot_password($loginEmailId);
            if($getpassword == '') {
                $status = 'fail';
                $message = "Sorry !!! ".$loginEmailId." is not registered";
            } else {
                $agent_no = $getpassword->agent_no;
                // $activation_key = sha1($loginEmailId . 'Mytrippatner');
                if(is_numeric($loginEmailId)){
                    $this->load->module('home/smsgateway');
                    $otp = $this->smsgateway->sendOtp($loginEmailId);
                    $type = 'mobile';
                } else {
                    $otp = $this->getOtp(6);
                    $type = 'email';
                }
                if($this->Corporatesubadmin_Model->update_agent_activation_key($otp, $agent_no)){
                    // echo $this->db->last_query();exit;
                    $message = "An OTP has been sent to your email address to reset the password.";
                    $status = 'success';
                    if($type = 'email'){
                        $data_email = array(
                            'email' => $loginEmailId,
                            // 'agent_no' => $agent_no,
                            'otp' => $otp,
                        );
                        $this->load->module('home/sendemail');
                        $this->sendemail->forgot_password($data_email);
                    }
                } else {
                    $message = "Something went wrong please try again!";
                    $status = 'fail';
                }
            }
        } else {
            $message = validation_errors();
            $status = 'fail';
        }
        echo json_encode(array(
            'status' => $status,
            'message' => $message,
            'otp_corporate' => $loginEmailId,
        ));
    } 

    function change_password() {
        $this->agent_logged();
        $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');

        $data['message'] = '';
        $agent_id = $this->session->agent_id;
        $agent_info = $this->Corporatesubadmin_Model->getAgentInfo($agent_id);
        if ($this->form_validation->run() == FALSE) {
            $data['message'] = validation_errors();
            $status = 'fail';
        } else {
            if (md5($this->input->post('current_password')) == $agent_info->agent_password) {
                if ($this->input->post('password') == $this->input->post('passconf')) {
                    $password = md5($this->input->post('password'));
                    if ($this->Corporatesubadmin_Model->update_password($agent_id, $password)) {
                        $success = 'Your Password Updated Successfully!';
                        $status = 'success';
                    } else {
                        $data['message'] = 'Your Password not Updated!';
                        $status = 'fail';
                    }
                } else {
                    $data['message'] = 'New Password and Confirm Password miss-matched';
                    $status = 'fail';
                }
            } else {
                $data['message'] = 'Current Password is wrong. Please enter correct current password!';
                $status = 'fail';
            }
        }

        if($status == 'success') {
            $data_email = array(
                'first_name' => $agent_info->first_name,
                'user_email' => $agent_info->agent_email,
            );
            $this->load->module('home/email');
            $this->email->password_upd($data_email);
            $this->session->set_flashdata('message', $success);
            redirect('corporate/my_profile', 'refresh');
        } else {
            $data['agent_info'] = $agent_info;
            $this->load->view('corporate/account/change_password', $data);
        }
    }

    function change_otp_password() {
        // print_r($_POST);
        $loginEmailId = $this->input->post('otp_corporate');
        $otp_number = $this->input->post('otp_number');
        $this->form_validation->set_rules('otp_number', 'OTP No', 'trim|required|integer');
        $message = '';
        $agent_id = $this->session->agent_id;
        $agent_info = $this->Corporatesubadmin_Model->getAgentInfoByID($agent_id);
        // print_r($agent_info);
        if ($this->form_validation->run() == FALSE) {
            $message = validation_errors();
            $status = 'fail';
        } else {
            $res = $this->Corporatesubadmin_Model->corporate_validate_otp($loginEmailId,$otp_number);
            if ($res !='') {
                $message = 'Otp matched!';
                $status = 'success';
            } else {
                $message = 'OTP is wrong. Please enter correct OTP!';
                $status = 'fail';
            }
        }

        echo json_encode(array(
            'status' => $status,
            'message' => $message,
            'otp_corporate' => $loginEmailId,
        ));
    }

    function restore_password() {
         // print_r($_POST);
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf1]');
        $this->form_validation->set_rules('passconf1', 'Password Confirmation', 'trim|required');
        
        $agent_email = $this->input->post('otp_corporate');
        if ($this->form_validation->run() == FALSE) {
            $message = validation_errors();
            $status="fail";
        } else {
            $password = md5($this->input->post('password'));
            if ($this->Corporatesubadmin_Model->restore_password($agent_email, $password)) {
                // echo $this->db->last_query();
                $data_email = array(
                    // 'name' => 'Corporate',
                    'email' => $agent_email,
                    // 'module' => 'corporate',
                );
                $this->load->module('home/sendemail');
                $this->sendemail->password_change_email($data_email);
                $message = 'Your Password Updated Successfully. Please login to cotinue';
                $status = "success";
            } else {
                $status="fail";
                $message = 'Your Password not Updated. Please try after some time...';
            }
        }

        echo json_encode(array(
            'status' => $status,
            'message' => $message,
        ));
    }

    public function my_bookings($booking_type='') {
         $this->agent_logged();
        $data['agent_id'] = $agent_id = $this->session->agent_id;
        // echo '<pre>';print_r($_GET);
        $fromdate = isset($_GET['fromdate']) && !empty($_GET['fromdate']) ? Date('Y-m-d', strtotime(str_replace('/', '-', $_GET['fromdate']))) : '';
        $todate = isset($_GET['todate']) && !empty($_GET['todate']) ? Date('Y-m-d', strtotime(str_replace('/', '-', $_GET['todate']))) : '';
        $uniqueRefNo = isset($_GET['bookingid']) ? $_GET['bookingid'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $email = isset($_GET['email']) ? $_GET['email'] : '';
        $mobile = isset($_GET['mobile']) ? $_GET['mobile'] : '';

        $module = 'hotels';
        $data['hotel_booking_summary'] = $data['flight_booking_summary'] = $data['holiday_booking_summary'] = '';
        
        if($booking_type == 'flights'){
            $module = 'flights';
            $data['flight_booking_summary'] = $this->Corporatesubadmin_Model->get_b2b_flight_booking_summary($fromdate,$todate,$uniqueRefNo,$status,$email,$mobile);

        }else if($booking_type == 'hotels') {
            $data['hotel_booking_summary'] = $this->Corporatesubadmin_Model->get_b2b_hotel_booking_summary($fromdate,$todate,$uniqueRefNo,$status,$email,$mobile);
        }else if($booking_type == 'bus') {
             $module = 'bus';
             $data['bus_booking_summary'] = $this->Corporatesubadmin_Model->get_b2b_bus_booking_summary($fromdate,$todate,$uniqueRefNo,$status,$email,$mobile);
           
        }else if($booking_type == 'cabs') {
              $module = 'cabs';

            $data['car_booking_summary'] = $this->Corporatesubadmin_Model->get_b2b_car_booking_summary($fromdate,$todate,$uniqueRefNo,$status,$email,$mobile);
            //echo $this->db->last_query();exit;
           
        }else if($booking_type == 'transfer') {
              $module = 'transfer';
            $data['transfer_booking_summary'] = $this->Corporatesubadmin_Model->get_b2b_transfer_booking_summary($fromdate,$todate,$uniqueRefNo,$status,$email,$mobile);
            //echo $this->db->last_query();exit;
        }else if($booking_type == 'activity') {
              $module = 'activity';
            $data['activity_booking_summary'] = $this->Corporatesubadmin_Model->get_b2b_activity_booking_summary($fromdate,$todate,$uniqueRefNo,$status,$email,$mobile);
            //echo $this->db->last_query();exit;
        }else{
            $data['hotel_booking_summary'] = $this->Corporatesubadmin_Model->get_b2b_hotel_booking_summary($fromdate,$todate,$uniqueRefNo,$status,$email,$mobile);
        }
        $this->load->view('corporatesubadmin/bookings/'.$module, $data);
    }

    public function markup_management() {
        $this->agent_logged();
        $data['agent_no'] = $agent_no = $this->session->agent_no;
        $data['agent_markup_manager'] = $this->Corporatesubadmin_Model->get_agent_markup_manager($agent_no);
        //echo '<pre>';print_r($data['agent_markup_manager']);exit;
        $this->load->view('corporatesubadmin/markup/view_markup_manager', $data);
    }

    public function deposit_management() {

        $this->agent_logged();

        $data['agent_id'] = $agent_id = $this->session->userdata('corporate_sub_logged_in');
       
        $data['agent_info'] = $this->Corporatesubadmin_Model->getAgentInfo($agent_id);
        $data['agent_deposit_details']  =$this->Corporatesubadmin_Model->get_agent_deposit_details($agent_id);

       // echo '<pre/>';print_r($data);exit;
        $this->load->view('corporatesubadmin/deposit/deposit_request', $data);
    }

    public function deposit_summary() {
        $this->agent_logged();

        $data['agent_id'] = $agent_id = $this->session->agent_id;
        $data['agent_info'] = $this->Corporatesubadmin_Model->getAgentInfo($agent_id);
        $data['agent_deposit_details']  =$this->Corporatesubadmin_Model->get_agent_deposit_details($agent_id);

        //echo '<pre/>';print_r($data);exit;
        $this->load->view('corporatesubadmin/deposit/view_deposit_summary', $data);
    }

    function add_markup() {
        $this->form_validation->set_rules('service_type', 'Service Type', 'required');
        $this->form_validation->set_rules('markup', 'Markup', 'trim|required|integer');

        $data['agent_no'] = $agent_no = $this->session->agent_no;
        $data['agent_markup_manager'] = $this->Corporatesubadmin_Model->get_agent_markup_manager($agent_no);
        if ($this->form_validation->run() == FALSE) {
            $data['markup'] = $this->input->post('markup');
            $data['message'] = validation_errors();
            $this->load->view('corporate/markup/view_markup_manager', $data);
        } else {
            //echo '<pre/>';print_r($_POST);exit;			
            $service_type = $this->input->post('service_type');
            $markup = $this->input->post('markup');
            $markup_process = $this->input->post('markup_process');

            if ($this->Corporatesubadmin_Model->add_markup($agent_no,$service_type,$markup,$markup_process)) {
                $message = 'Markup is updated.';
            } else {
                $message = 'Markup is not added. Please try after some time...';
            }
            $this->session->set_flashdata('message', $message);
            redirect('corporate/markup_management', 'refresh');
        }
    }

    function deposit_request() {
        //echo '<pre/>';print_r($_POST);exit;
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|integer');
        $this->form_validation->set_rules('transaction_mode', 'Transaction Mode', 'required');

        $data['agent_id'] = $agent_id = $this->session->agent_id;
        $data['agent_info'] = $this->Corporatesubadmin_Model->getAgentInfo($agent_id);

        if ($this->form_validation->run() == FALSE) {
            // echo validation_errors();exit;
            $data['amount'] = $this->input->post('amount');
            $data['value_date'] = $this->input->post('value_date');
            $data['bank'] = $this->input->post('bank');
            $data['branch'] = $this->input->post('branch');
            $data['city'] = $this->input->post('city');
            $data['transaction_id'] = $this->input->post('transaction_id');
            $data['remarks'] = $this->input->post('remarks');
            $data['message'] = validation_errors();
            $this->load->view('corporatesubadmin/deposit/view_deposit_summary', $data);
        } else {
            // echo '<pre>';print_r($_POST);exit;

            $amount = $this->input->post('amount');
            $transaction_mode = $this->input->post('transaction_mode');
            if($transaction_mode=='payment'){
                // redirect('payment/paymentagent/index/'.$amount,'refresh');
            }

            $value_date = $this->input->post('value_date');
            $bank = $this->input->post('bank');
            $branch = $this->input->post('branch');
            $city = $this->input->post('city');
            $transaction_id = $this->input->post('transaction_id');
            $remarks = $this->input->post('remarks');

            $agent_no = $data['agent_info']->agent_no;


            if ($this->Corporatesubadmin_Model->add_deposit_request($agent_id,$agent_no,$amount,$value_date,$transaction_mode,$bank,$branch,$city,$transaction_id,$remarks)) {
                // echo $this->db->last_query();exit;
                $message = 'Your deposit request as been submitted successfully.Further development will be mailed to your registered mail id';
            
            //sending mail after deposit
            /*$agent_info = $this->Corporatesubadmin_Model->getAgentInfo($this->session->userdata('agent_id'));
            $agent_email=$agent_info->agent_email;
            $agency_name=$agent_info->agency_name;
            $mobile=$agent_info->mobile_no;
            $data_email = array(
                'agency_name' => $agency_name,
                'transaction_mode' =>$this->input->post('transaction_mode'),
                'date'=>$this->input->post('value_date'),
                'amount'=>$this->input->post('amount'),
                'agent_email'=>$agent_email,
                'mobile'=>$mobile,
                'subject' => 'Amount Deposit'
            );
            $this->load->module('home/email');
            $this->email->deposit_email($data_email);*/
		   } else {
               $message = 'Transaction is already requested or please try after some time...';
            }
            $this->session->set_flashdata('message', $message);          
            redirect('corporatesubadmin/deposit_management', 'refresh');
        }
    }
    
    public function unset_all() {
        $this->session->unset_userdata('pass_room_info');
        $this->session->unset_userdata('total_cost_sess');
        $this->session->unset_userdata('uniqueRefNo');
        $this->session->unset_userdata('Smf_session_id');
        $this->session->unset_userdata('Rmf_session_id');
        $this->session->unset_userdata('flight_search_activate');
        $this->session->unset_userdata('flight_search_data');
        $this->session->unset_userdata('hotel_search_activate');
        $this->session->unset_userdata('hotel_search_data');
        $this->session->unset_userdata('car_search_activate');
        $this->session->unset_userdata('car_search_data');
        $this->session->unset_userdata('passenger_info');
        $this->session->unset_userdata('security_token');
    }
    
}