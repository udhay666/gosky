<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class B2c extends MX_Controller {

    public function __construct() {
        parent::__construct();      
        $this->load->model('B2c_Model');
    }

    private function user_logged(){
        if (!$this->session->has_userdata('user_logged_in')){
            redirect('home/index', 'refresh');
        }
    }

    public function my_profile() {
        $this->user_logged();
        $data['country_list'] = $this->B2c_Model->get_country_list();
        $data['user_id'] = $user_id = $this->session->user_id;
        // echo '<pre/>';print_r($data['user_id']);exit;
        
        $data['user_info'] = $this->B2c_Model->getUserInfo($user_id);
        $this->load->view('b2c/account/view_profile', $data);
    }

    function user_login() {
        // echo '<pre>';print_r($_POST);exit;
        $loginEmailId = $this->input->post('user_email');
        if(is_numeric($loginEmailId)){
            // echo is_numeric('53543');exit;
            $this->form_validation->set_rules('user_email', 'Mobile No', 'trim|required|integer|max_length[10]|min_length[10]');
        } else {
            // echo 2;exit;
            $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
        }
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required');

        $data['status'] = '';
        if ($this->form_validation->run() !== FALSE) {
            $loginPassword = md5($this->input->post('user_password'));
            $res = $this->B2c_Model->validate_credentials($loginEmailId, $loginPassword);
            // echo '<pre/>';print_r($res);exit;
            if ($res !== false) {
                $sessionUserInfo = array(
                    'user_id' => $res->user_id,
                    'user_no' => $res->user_no,
                    'user_name' => $res->first_name .' '.$res->last_name,
                    'user_email' => $res->user_email,
                    'user_mobile' => $res->mobile_no,
                    'first_name' => $res->first_name,
                    'last_name' => $res->last_name,
                    'user_logged_in' => TRUE
                );
                $this->session->set_userdata($sessionUserInfo);                
                $this->B2c_Model->insert_login_activity();
                // redirect('home/index', 'refresh');
                 redirect('', 'refresh');
            } else {
                $error = "Sorry !!! ".$loginEmailId." / Password mismatched";
                redirect('home/error_page/' . base64_encode($error));
            }
        } else {
            $error = validation_errors();
            redirect('home/error_page/' . base64_encode($error));
        }
        // redirect('home/index', $data);
    }

    function user_register() {
        // echo "fhj";print_r($_POST);exit;
        $loginEmailId = $this->input->post('user_email');
        $user_email = '';
        $mobile_no = '';
        if(is_numeric($loginEmailId)){
            $this->form_validation->set_rules('user_email', 'Mobile No', 'trim|required|integer|max_length[10]|min_length[10]');
            $mobile_no = $this->input->post('user_email');
        } else {
            $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
            $user_email = $this->input->post('user_email');
        }
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        // $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');

        $message = '';
        $insertdata = array(
            'user_email' => $user_email,
            // 'user_name' => $loginEmailId,
            // 'title' => $this->input->post('title'),
            'first_name' => $this->input->post('first_name'),
            // 'middle_name' => $this->input->post('middle_name'),
            'last_name' => $this->input->post('last_name'),
            'mobile_no' => $mobile_no,
            // 'address' => $this->input->post('address'),
            // 'pin_code' => $this->input->post('pin_code'),
            // 'city' => $this->input->post('city'),
            // 'state' => $this->input->post('state'),
            // 'country' => $this->input->post('country'),
            // 'currency_type' => 'INR',
            'status' => 1,
        );
        // echo '<pre/>';print_r($insertdata);exit;
        if ($this->form_validation->run() == FALSE) {
            $message = validation_errors();
            $status = 'fail';
        } else {
            //echo '<pre/>';print_r($_POST);exit;
            $email_check = $this->B2c_Model->check_email_availability($loginEmailId);
            // echo '<pre>';print_r($email_check);exit;
            if ($email_check != '' || !empty($email_check)) {
                // echo 1;exit;
                $message = 'Email / Mobile Already Exists. Please use different email / mobile to continue registration...';
                $status = 'fail';
            } else {
                 // echo 2;exit;
                $insertdata['user_password'] = md5($this->input->post('user_password'));
                $user_id = $this->B2c_Model->add_user($insertdata);
                 // echo $this->db->last_query();exit;
                if ($user_id) {
                    $message = "Your Registration is successful.Please login now.";
                    $status = 'success';
                } else {
                    $message = 'User Registration Not Done. Please try after some time...';
                    $status = 'fail';
                }
            }
        }

        if($status == 'success') {
            if($user_email != ''){
                $data_email = array(
                    // 'title' => $insertdata['title'],
                    'first_name' => $insertdata['first_name'],
                    'user_email' => $insertdata['user_email'],
                    'password'   => $this->input->post('user_password'),
                );
                 $this->load->module('home/sendemail');
                $this->sendemail->registration_email($data_email);
            }
            redirect('home/success_page/'.base64_encode($message));
        } else {
            redirect('home/error_page/' . base64_encode($message));
        }
    }
    
    function update_profile() {
        $this->user_logged();
        // echo '<pre/>';print_r($_POST);exit;		
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        //$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'required');

        $data = array();
        $data['message'] = '';
        $upd_data = array(
            'title' => $this->input->post('title'),
            'first_name' => $this->input->post('first_name'),
            'middle_name' => $this->input->post('middle_name'),
            'last_name' => $this->input->post('last_name'),
            'mobile_no' => $this->input->post('mobile_no'),
            'address' => $this->input->post('address'),
            'pin_code' => $this->input->post('pin_code'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'country' => $this->input->post('country'),
            // 'currency_type' => 'INR',
        );

        $data['user_id'] = $user_id = $this->input->post('user_id');
        if ($this->form_validation->run() == FALSE) {
            $data['message'] = validation_errors();
            $status = 'fail';
        } else {
            //echo '<pre/>';print_r($_POST);exit;
            if($this->B2c_Model->update_user($user_id,$upd_data)) {
                $success = 'Your Profile Updated Successfully';
                $status = 'success';
            } else {
                $data['message'] = 'Your Profile not Updated...';
                $status = 'fail';
            }      
        }

        if($status == 'success') {
            $this->session->set_flashdata('message', $success);
            redirect('b2c/my_profile', 'refresh');
        } else {
            $data['country_list'] = $this->B2c_Model->get_country_list();
            $data['user_info'] = $this->B2c_Model->getUserInfo($user_id);
            $data = array_merge($data, $upd_data);
            $this->load->view('b2c/account/view_profile', $data);
        }
    }

    function sendOtp(){
        // echo '<pre/>';print_r($_POST);exit;
        // error_reporting(-1);
        $loginEmailId = $this->input->post('otp_user');
        if(is_numeric($loginEmailId)){
            $this->form_validation->set_rules('otp_user', 'Mobile No', 'trim|required|integer|max_length[10]|min_length[10]');
        } else {
            $this->form_validation->set_rules('otp_user', 'Email', 'trim|required|valid_email');
        }

        if ($this->form_validation->run() !== FALSE) {
            $res = $this->B2c_Model->validate_credentials($loginEmailId);
             // echo '<pre/>';print_r($res);exit;
            if ($res !== false) {
                if(is_numeric($loginEmailId)){
                    $this->load->module('home/smsgateway');
                    $otpnum = $this->smsgateway->sendOtp($loginEmailId);
                    $type = 'mobile';
                } else {
                    $otpnum = $this->getOtp(6);
                    $type = 'email';
                }
                $otp = $this->B2c_Model->insertOtp($loginEmailId,$otpnum);
                // echo $this->db->last_query();
                // echo $otp;exit;
                if($otp != ''){
                    $status = 'success';
                    $meassage = 'Otp sent successfully.';
                    
                    if($type = 'email'){
                        $data_email = array(
                            // 'title' => $insertdata['title'],
                            'first_name' => $res->first_name,
                            'email' => $res->user_email,
                            'otp' => $otp,
                        );
                        $this->load->module('home/sendemail');
                        $this->sendemail->otp_login_email($data_email);
                    }
                    
                } else {
                    $status = 'fail';
                    $meassage = 'Otp sent failed. Please try again later.';
                }
            } else {
                $message = "Sorry !!! ".$loginEmailId." is not registered";
                $status = 'fail';
            }
        } else {
            $meassage = validation_errors();
            $status = 'fail';
        }

        echo json_encode(array(
            'status' => $status,
            'meassage' => $meassage,
            'otp_user' => $loginEmailId,
        ));
    }

    function otpLogin(){
        $this->form_validation->set_rules('otp_number', 'OTP No', 'trim|required|integer');

        $loginEmailId = $this->input->post('otp_user');
        $otp_number = $this->input->post('otp_number');
        if ($this->form_validation->run() !== FALSE) {
            $res = $this->B2c_Model->validate_otp($loginEmailId,$otp_number);
            // echo $this->db->last_query();
            // echo '<pre/>';print_r($res);exit;
            if ($res !== false) {
                $sessionUserInfo = array(
                    'user_id' => $res->id,
                    'user_no' => $res->user_no,
                    'user_email' => $res->user_email,
                    'user_mobile' => $res->mobile_no,
                    'first_name' => $res->first_name,
                    'last_name' => $res->last_name,
                    'user_logged_in' => TRUE
                );

                $this->session->set_userdata($sessionUserInfo);
                // print_r($this->session->all_userdata());exit;
                $this->B2c_Model->removeOTP($loginEmailId);
                $this->B2c_Model->insert_login_activity();
                // exit;
                $message = 'Login Successfull';
                $status = 'success';
                // redirect('', 'refresh');
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
            'meassage' => $message,
            'otp_user' => $loginEmailId,
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

    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_no');
        $this->session->unset_userdata('user_logged_in');
        $this->session->sess_destroy();
        redirect('', 'refresh');
    }

    public function forgot_password() {
        // echo '<pre/>';print_r($_POST);exit;
        $loginEmailId = $this->input->post('email_id');
        $status = '';
        if(is_numeric($loginEmailId)){
            $this->form_validation->set_rules('email_id', 'Mobile No', 'trim|required|integer|max_length[10]|min_length[10]');
        } else {
            $this->form_validation->set_rules('email_id', 'Email', 'trim|required|valid_email');
        }

        if ($this->form_validation->run() !== FALSE) {
            // $data = base64_encode($loginEmailId);
            $getpassword = $this->B2c_Model->get_forgot_password($loginEmailId);
            // echo $this->db->last_query();
            // echo '<pre/>';print_r($getpassword);exit;
            if($getpassword == '') {
                $status = 'fail';
                $message = "Sorry !!! ".$loginEmailId." is not registered";
            } else {
                $user_no = $getpassword->user_no;
                // $activation_key = sha1($loginEmailId . 'Mytrippatner');
                if(is_numeric($loginEmailId)){
                    // echo 1;exit;
                    $this->load->module('home/smsgateway');
                    $otp = $this->smsgateway->sendOtp($loginEmailId);
                    $type = 'mobile';
                } else {
                    // echo 2;exit;
                    $otp = $this->getOtp(6);
                    $type = 'email';
                }
                // $this->B2c_Model->update_user_activation_key($otp, $user_no);
                 // echo $this->db->last_query();exit;

                if($this->B2c_Model->update_user_activation_key($otp, $user_no)){
                    // echo $this->db->last_query();exit;
                    $message = "An OTP has been sent to your email address to reset the password.";
                    $status = 'success';
                    if($type = 'email'){
                        $data_email = array(
                            'email' => $loginEmailId,
                            // 'user_no' => $user_no,
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
        // echo json_encode(array(
        //     'status' => $status,
        //     'message' => $message,
        //     'otp_user' => $loginEmailId,
        // ));
        
        if($status=='fail'){
            redirect('home/error_page/' . base64_encode($message));
        }else{
            redirect('home/success_page/'.base64_encode($message));   
        }
        
    } 
    
    function change_otp_password() {
        $loginEmailId = $this->input->post('otp_user');
        $otp_number = $this->input->post('otp_number');
        $this->form_validation->set_rules('otp_number', 'OTP No', 'trim|required|integer');
        $message = '';
        $user_id = $this->session->user_id;
        $user_info = $this->B2c_Model->getUserInfo($user_id);
        if ($this->form_validation->run() == FALSE) {
            $message = validation_errors();
            $status = 'fail';
        } else {
            $res = $this->B2c_Model->validate_password_otp($loginEmailId,$otp_number);
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
            'otp_user' => $loginEmailId,
        ));
    }

    function change_password() {
        // print_r($_POST);
        $this->user_logged();
        $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');

        $data['message'] = '';
        $loginEmailId = $this->input->post('otp_user');
        print_r($loginEmailId);
        $user_info = $this->B2c_Model->getUserdetails($loginEmailId);
        if ($this->form_validation->run() == FALSE) {
            $message = validation_errors();
            $status = 'fail';
            } else {
                if (md5($this->input->post('current_password')) == $agent_info->agent_password) {
                    if ($this->input->post('password') == $this->input->post('passconf')) {
                        $password = md5($this->input->post('password'));
                        if ($this->B2c_Model->update_password($user_id, $password)) {
                            $success = 'Your Password Updated Successfully!';
                            $status = 'success';
                        } else {
                            $message = 'Your Password not Updated!';
                            $status = 'fail';
                        }
                    } else {
                        $message = 'New Password and Confirm Password miss-matched';
                        $status = 'fail';
                    }
                } else {
                    $message = 'Current Password is wrong. Please enter correct current password!';
                    $status = 'fail';
                }
        }
    }

    function restore_password() {
        // print_r($_POST);
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        
        $user_email = $this->input->post('user_email');;
        if ($this->form_validation->run() == FALSE) {
            $message = validation_errors();
            $status="fail";
        } else {
            $password = md5($this->input->post('password'));
            if ($this->B2c_Model->restore_password($user_email, $password)) {
                $data_email = array(
                    // 'name' => 'User',
                    'email' => $user_email,
                    // 'module' => 'b2c',
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
        $this->user_logged();
        $data['user_id'] = $user_id = $this->session->user_id;
        // echo"<pre>";print_r($data);exit;
        $module = 'hotels';
        $data['hotel_booking_summary'] = $data['holiday_booking_summary'] = '';
        if($booking_type == 'flights'){
            $module = 'flights';
            $data['flight_booking_summary'] = $this->B2c_Model->get_b2c_flight_booking_summary($user_id);
            // $data['flight_booked_passanger_details'] = $this->B2c_Model->get_b2c_flight_booked_passanger_details($user_id);
            // $module = 'flights';
        }else if($booking_type == 'hotels') {
            $data['hotel_booking_summary'] = $this->B2c_Model->get_b2c_hotel_booking_summary($user_id);
        }else if($booking_type == 'bus'){
            $module = 'bus';
            $data['bus_booking_summary'] = $this->B2c_Model->get_b2c_bus_booking_summary($user_id);
            // echo '<pre>vd';print_r($data['bus_booking_summary']);exit;
        }
        else {
            $data['hotel_booking_summary'] = $this->B2c_Model->get_b2c_hotel_booking_summary($user_id);
        }
        // echo $this->db->last_query();
        // echo '<pre>vd';print_r($data['hotel_booking_summary']);exit;
        $this->load->view('b2c/bookings/'.$module, $data);
    }

     public function deposit_management() {
        $this->user_logged();

        $data['user_id'] = $user_id = $this->session->user_id;

        $data['user_info'] = $this->B2c_Model->getUserInfo($user_id);
        $data['user_deposit_details']  =$this->B2c_Model->get_user_deposit_details($user_id);
        // echo $this->db->last_query();
        // echo '<pre/>';print_r($data);exit;
        $this->load->view('b2c/deposit/deposit_request', $data);
    }

     public function deposit_summary() {
        $this->user_logged();
        $data['user_id'] = $user_id = $this->session->user_id;
        $data['user_info'] = $this->B2c_Model->getUserInfo($user_id);
        $data['user_deposit_details']  =$this->B2c_Model->get_user_deposit_details($user_id);
         // echo '<pre/>';print_r($data);exit;
        $this->load->view('b2c/deposit/view_deposit_summary', $data);
    }

    function deposit_request() {
        // echo '<pre/>';print_r($_POST);exit;
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|integer');
        $this->form_validation->set_rules('transaction_mode', 'Transaction Mode', 'required');

        $data['user_id'] = $user_id = $this->session->user_id;
        $data['user_info'] = $this->B2c_Model->getUserInfo($user_id);

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
            $this->load->view('b2c/deposit/view_deposit_summary', $data);
        } else {
           // echo '<pre>';print_r($_POST);exit;

            $amount = $this->input->post('amount');
            $transaction_mode = $this->input->post('transaction_mode');
            if($transaction_mode=='payment'){
                // redirect('payment/paymentagent/index/'.$amount,'refresh');
            }

            $value_date = $this->input->post('value_date');
            // echo '<pre>';print_r($value_date);exit;
            $bank = $this->input->post('bank');
            $branch = $this->input->post('branch');
            $city = $this->input->post('city');
            $transaction_id = $this->input->post('transaction_id');
            $remarks = $this->input->post('remarks');

            $user_no = $data['user_info']->user_no;


            if ($this->B2c_Model->add_deposit_request($user_id,$user_no,$amount,$value_date,$transaction_mode,$bank,$branch,$city,$transaction_id,$remarks)) {
                // echo $this->db->last_query();exit;
                $message = 'Your deposit request as been submitted successfully.Further development will be mailed to your registered mail id';
            
            //sending mail after deposit
            /*$agent_info = $this->Agent_Model->getAgentInfo($this->session->userdata('agent_id'));
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
            redirect('b2c/deposit_management', 'refresh');
        }
    }


    public function checklogin() {
        // echo '<pre>vd';print_r($_POST);exit;
        $loginEmailId = $_POST['email'];
        $loginPassword = md5($_POST['pass']);
        $email_check = $this->B2c_Model->check_email_availability($loginEmailId);
        $res = $this->B2c_Model->validate_credentials($loginEmailId, $loginPassword);

        if ($email_check == '' || empty($email_check)) {
            $status = 'fail';
        } else if ($res !== false) {
            $sessionUserInfo = array(
                'user_id' => $res->id,
                'user_no' => $res->user_no,
                'user_no' => $res->user_no,
                'user_email' => $res->user_email,
                'first_name' => $res->first_name,
                'last_name' => $res->last_name,
                'user_logged_in' => TRUE
            );
            $this->session->set_userdata($sessionUserInfo);
            $this->B2c_Model->insert_login_activity();

            $status = 'success';
            $cust_arr = array(
                'user_email' => $res->user_email,
                'title' =>$res->title,
                'first_name' => $res->first_name,
                'middle_name' =>$res->middle_name,
                'last_name' => $res->last_name,
                'user_mobile' => $res->mobile_no,
                'gender' =>$res->gender,
                'address' =>$res->address,
                'user_pincode' =>$res->pin_code,
                'user_city' =>$res->city,
                'user_state' =>$res->state,
                'user_country' => $res->country,
            );
        } else {
            $status = 'fail';
        }
        $cust_arr['stat'] = $status;
        echo json_encode($cust_arr);
    }
    
    public function getPassanger_details(){
		// echo $fname;
		if(isset($_GET['term'])){
		    $this->user_logged();
		    $data['user_id'] = $user_id = $this->session->user_id;
			$result = $this->B2c_Model->get_b2c_flight_booked_passanger_details($_GET['term'], $user_id);
			if (count($result) > 0){
				foreach($result as $row){
					// $arr_result[] = $row->first_name;
					$dob = $row->date_of_birth;
					$dobdate = explode("-", $dob);
					
					 $adultDOBDate = $dobdate[2]; 
					 $adultDOBMonth = $dobdate[1];
					 $adultDOBYear = $dobdate[0];
					$arr_result[] = array(
						'label' => $row->first_name,
						'adultLName' => $row->last_name,
						'adultTitle' => $row->title,
						'user_mobile' => $row->mobile,
						'adultDOBDate' => $adultDOBDate,
						'adultDOBMonth' => $adultDOBMonth,
						'adultDOBYear' => $adultDOBYear,
						'adultPPNationality' => $row->passport_nationality,
					);
					echo json_encode($arr_result);
				}
			}
		}
	}

    

}

