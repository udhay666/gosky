<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Home_Model');
        $this->load->model('B2b_Model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('admin_auth');
        $this->load->library("Configs");
        $this->is_logged_in();
    }

//     public function index() {
// //        $this->load->library('ckeditor', base_url() . 'system/plugins/ckeditor/');
// //        $this->ckeditor->basePath = base_url() . 'system/plugins/ckeditor/';
// //        $this->ckeditor->ToolbarSet = 'Basic';
//         $this->load->view('dashboard');
//     }

     public function index() {
        $data['today']=$this->Home_Model->gettodaybooking();
        $data['lastsevendays']=$this->Home_Model->getlastsevendaysbooking();
        $data['lastthirtydays']=$this->Home_Model->getlastthirtydaysbooking();
        $data['lastsixmonthsdays']=$this->Home_Model->getlastsixmonthsbooking();
        $data['lastninetydays']=$this->Home_Model->getlastninetydaysbooking();
        $data['lastoneyear']=$this->Home_Model->getlastoneyearbooking();
        // Today Account Summary
        $data['accountsummary']=$this->Home_Model->gettodayAccountsummary(); 
        // echo '<pre>'; print_r($data);  exit; 
        $this->load->view('dashboard',$data);
    }


    private function is_logged_in() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login/admin_login');
        }
    }

    // function dashboard() {

    //     $this->load->view('dashboard');
    // }

     function dashboard() {
        $data['today']=$this->Home_Model->gettodaybooking();
       // echo  $data['today'];
        $data['lastsevendays']=$this->Home_Model->getlastsevendaysbooking();
        $data['lastthirtydays']=$this->Home_Model->getlastthirtydaysbooking();
        $data['lastsixmonthsdays']=$this->Home_Model->getlastsixmonthsbooking();
        $data['lastninetydays']=$this->Home_Model->getlastninetydaysbooking();
        $data['lastoneyear']=$this->Home_Model->getlastoneyearbooking();
        $data['accountsummary']=$this->Home_Model->gettodayAccountsummary();  
        $this->load->view('dashboard',$data);
    }
     function changereport()
    {
        $duration=$_POST['duration'];
        $daterangeval=$_POST['daterangeval'];
        if(($duration=='1' || !isset($_POST['duration']))&&empty($daterangeval))
        {
             $data['accountsummary']=$this->Home_Model->gettodayAccountsummary();
             $data['durationtype']='Today';
             $data['booking_counts']=count($this->Home_Model->gettodaybooking());
        }
        else if($duration=='7')
        {
             $data['accountsummary']=$this->Home_Model->getlastsevendaysAccountsummary();
             $data['durationtype']='Last 7 days';
             $data['booking_counts']=count($this->Home_Model->getlastsevendaysbooking());
        }
        else if($duration=='30')
        {
             $data['accountsummary']=$this->Home_Model->getlastthirtydaysAccountsummary();
             $data['durationtype']='Last 30 days';
             $data['booking_counts']=count($this->Home_Model->getlastthirtydaysbooking());
        }
        else if($duration=='90')
        {
             $data['accountsummary']=$this->Home_Model->getlastninetydaysAccountsummary();
             $data['durationtype']='Last 90 days';
            $data['booking_counts']=count($this->Home_Model->getlastninetydaysbooking());
        }
        else if($duration=='6M')
        {
             $data['accountsummary']=$this->Home_Model->getlastsixmonthsAccountsummary();
             $data['durationtype']='Last 6 Months';
             $data['booking_counts']=count($this->Home_Model->getlastsixmonthsbooking());
        }
        else if($duration=='1y')
        {
             $data['accountsummary']=$this->Home_Model->getlastoneyearAccountsummary();
             $data['durationtype']='Last 1 Year';
             $data['booking_counts']=count($this->Home_Model->getlastoneyearbooking());
        }
        else if(!empty($daterangeval))
        {
           $val=explode("-",$daterangeval);                
           $fromdate=date("Y-m-d", strtotime(trim($val[0])));
           $todate=date("Y-m-d", strtotime(trim($val[1])));         
             $data['accountsummary']=$this->Home_Model->getdaterangeAccountsummary($fromdate,$todate);
             $data['durationtype']=$daterangeval;
             $data['booking_counts']=count($this->Home_Model->getdaterangebooking($fromdate,$todate));
        }

    $accountsummary_result = $this->load->view('accountsummary_result_ajax', $data, TRUE); 
    $bookingsummary = $this->load->view('bookingsummary_ajax', $data, TRUE); 

    echo json_encode(array(
        'accountsummary_result' => $accountsummary_result,
         'bookingsummary' => $bookingsummary,       
        ));
    }
	function dashboard1() {

        $this->load->view('dashboard1');
    }


    function my_profile($status = '') {
        $data['status'] = $status;
        $admin_id = $this->session->userdata('admin_id');
        $data['admin_info'] =$n= $this->Home_Model->get_admin_info($admin_id);
       // echo $this->db->last_query();
       //echo $n;exit();
        $this->load->view('account/my_profile', $data);
    }

    function my_act_summary() {
        //  echo 'entered';exit;
        $data['admin_act_summary'] = $this->Home_Model->get_admin_act_summary();
        $this->load->view('account/my_act_summary', $data);
    }

    public function hotel_logs() {
        // $data['flight_logs'] = $this->Home_Model->get_flight_logs();
        $data['hotel_logs'] = $this->Home_Model->get_hotel_logs();
        $data['dot_hotel_logs'] = $this->Home_Model->get_dot_hotel_logs();
        $data['hp_hotel_logs'] = $this->Home_Model->get_hp_hotel_logs();
        $data['roomsxml_hotel_logs'] = $this->Home_Model->get_roomsxml_hotel_logs();
        $data['ezeego_hotel_logs'] = $this->Home_Model->get_ezeego_hotel_logs();

        //echo '<pre/>';print_r($data);exit;
        $this->load->view('home/hotel_logs_manager', $data);
    }

    function update_profile() {
        $this->form_validation->set_rules('login_email', 'Email-Id', 'trim|required|valid_email');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
        $this->form_validation->set_rules('address', 'Address', 'required');
        //$this->form_validation->set_rules('pin_code', 'Pin Code', 'trim|required|integer|min_length[6]');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');

        $errors = 1;
        if ($this->form_validation->run() == FALSE) {
            redirect('home/my_profile/' . $errors, 'refresh');
        } else {
            //echo '<pre/>';print_r($_POST);exit;
            $login_email = $this->input->post('login_email');
            $title = $this->input->post('title');
            $first_name = $this->input->post('first_name');
            $middle_name = $this->input->post('middle_name');
            $last_name = $this->input->post('last_name');
            $mobile_no = $this->input->post('mobile_no');
            $address = $this->input->post('address');
            $pin_code = $this->input->post('pin_code');
            $city = $this->input->post('city');
            $state = $this->input->post('state');

            if ($this->Home_Model->update_admin_profile($login_email, $title, $first_name, $middle_name, $last_name, $mobile_no, $address, $pin_code, $city, $state))
                $errors = 0;
        }

        redirect('home/my_profile/' . $errors, 'refresh');
    }

    function change_password() {
        // echo"<pre>";print_r($_POST);
        $this->form_validation->set_rules('cpassword', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');

        $data['status'] = '';
        $data['errors'] = '';

        $admin_id = $this->session->userdata('admin_id');
        $data['admin_info'] = $admin_info = $this->Home_Model->get_admin_info($admin_id);
        // echo"<pre>";print_r($admin_info);exit;
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('account/change_password', $data);
        } else {
            if ($admin_info->login_password == md5($this->input->post('cpassword')) && $this->input->post('password') == $this->input->post('passconf')) {
                $password = md5($this->input->post('password'));
                if ($this->Home_Model->update_admin_password($admin_id, $password)) {
                    $data['status'] = 1;
                } else {
                    $data['errors'] = 1;
                }
            } else {
                $data['errors'] = 2;
            }

            $this->load->view('account/change_password', $data);
        }
    }

    public function currency_manager() {
        $data['currency_list'] = $this->Home_Model->get_currency_list();
        //echo '<pre/>';print_r($data['currency_list']);exit;
        $this->load->view('home/currency_manager', $data);
    }

    public function manage_currency_status() {
        if (isset($_POST['currency_id']) && isset($_POST['status'])) {
            $currency_id = $_POST['currency_id'];
            $status = $_POST['status'];
            $update = $this->Home_Model->manage_currency_status($currency_id, $status);
            echo $update;
        } else {
            return false;
        }
    }

    public function get_currency_value($from_Currency, $to_Currency, $amount) {
        $amount = urlencode($amount);
        $from_Currency = urlencode($from_Currency);
        $to_Currency = urlencode($to_Currency);
        $url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency";
        $ch = curl_init();
        $timeout = 0;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $rawdata = curl_exec($ch);
        curl_close($ch);
        //print '<pre/>';print_r($rawdata);exit;
        $data = explode('"', $rawdata);
        $data = explode(' ', $data['3']);
        $var = $data['0'];
        return round($var, 3);
    }

    function currencyImport($from_Currency, $to_Currency) {
        $url = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=' . $from_Currency . $to_Currency . '=X';
        $handle = @fopen($url, 'r');

        if ($handle) {
            $result = fgets($handle, 4096);
            fclose($handle);
        }

        $currencyData = explode(',', $result);
        return $currencyData[1];
    }

    public function update_currency_values() {
        $currency_list = $this->Home_Model->get_currency_list();
        //print '<pre/>';print_r($currency_list);

        for ($i = 0; $i < count($currency_list); $i++) {
            $from_Currency = 'USD';
            $to_Currency = $currency_list[$i]->currency_code;
            //$amount = 1;

            $currency_val = $this->currencyImport($from_Currency, $to_Currency);

            $currency_id = $currency_list[$i]->currency_id;
            $updated = $this->Home_Model->update_currency_values($currency_id, $currency_val);
        }

        echo $updated;
    }

    public function api_manager() {
        $data['hotel_api_list'] = $this->Home_Model->get_hotel_apis();
        $data['flight_api_list'] = $this->Home_Model->get_flight_apis();
        $data['car_api_list'] = $this->Home_Model->get_car_apis();
        $data['bus_api_list'] = $this->Home_Model->get_bus_apis();
        $data['apartment_api_list'] = $this->Home_Model->get_apartment_apis();
        //echo '<pre/>';print_r($data);exit;
        $this->load->view('home/api_manager', $data);
    }

    public function manage_api_status() {
        if (isset($_POST['api_id']) && isset($_POST['status'])) {
            $api_id = $_POST['api_id'];
            $status = $_POST['status'];
            $update = $this->Home_Model->manage_api_status($api_id, $status);
            echo $update;
        } else {
            return false;
        }
    }

    public function payment_manager() {
        $data['payment_charge_list'] = $this->Home_Model->get_payment_gateway_charges();
        //echo '<pre/>';print_r($data);exit;
        $this->load->view('home/payment_gateway_manager', $data);
    }

    public function manage_payment_charge_status() {
        if (isset($_POST['id']) && isset($_POST['status'])) {
            $id = $_POST['id'];
            $status = $_POST['status'];
            $update = $this->Home_Model->manage_payment_charge_status($id, $status);
            echo $update;
        } else {
            return false;
        }
    }

    public function edit_payment_charge($id = '') {
        $this->form_validation->set_rules('charge', 'Payment Charge', 'trim|required|integer|max_length[2]');

        $data['status'] = '';
        $data['errors'] = '';

        $data['id'] = $id;
        $data['payment_info'] = $payment_info = $this->Home_Model->get_payment_charge($id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/edit_payment_charge', $data);
        } else {
            $charge = $this->input->post('charge');
            if ($this->Home_Model->update_payment_charge($id, $charge)) {
                redirect('home/payment_manager', 'refresh');
            } else {
                $data['errors'] = 'Payment charge not updated...';
                $this->load->view('home/edit_payment_charge', $data);
            }
        }
    }

    // Promotion Manager
    public function promotion_manager() {
          $data['service_type_name']=array(
                                        '1' =>'Hotel',
                                        '2'=>'Flight',
                                        '6'=>'Holiday' 
                                        );      
        $data['promotion_list'] = $this->Home_Model->get_promotion_list();
        //echo '<pre/>';print_r($data);exit;
        $this->load->view('home/promotion_manager', $data);
    }

   public function add_promotion()
	{
		$this->form_validation->set_rules('service_type', 'Service Type', 'required');
		$this->form_validation->set_rules('promo_name', 'Promotion Name', 'trim|required');
		$this->form_validation->set_rules('promo_code', 'Promotion Code', 'trim|required|is_unique[promotion_manager.promo_code]');
		$this->form_validation->set_rules('type_discount', 'Discount Type', 'trim|required|integer');
		$this->form_validation->set_rules('discount', 'Discount', 'trim|required|integer');
		$this->form_validation->set_rules('promo_expire', 'Valid Upto', 'required');

		$data['promotion_list'] = $this->Home_Model->get_promotion_list();
			//echo '<pre>';print_r($data['promotion_list']);exit;
		if($this->form_validation->run() == FALSE)
		{
			$data['promo_name'] = $this->input->post('promo_name');
			$data['promo_code'] = $this->input->post('promo_code');
			$data['type_discount']  = $this->input->post('type_discount');
			$data['discount']  = $this->input->post('discount');
			$data['promo_expire']  = $this->input->post('promo_expire');

			$this->load->view('home/promotion_manager', $data);
		}
		else
		{
			//echo '<pre/>';print_r($_POST);exit;
		   $service_type = $this->input->post('service_type');
                  // echo '<pre>';print_r($service_type);exit;
                   $ser_type=implode(",",$service_type);

                  // echo '<pre>';print_r($ser_type);exit;
		   $promo_name = $this->input->post('promo_name');
		   $promo_code = $this->input->post('promo_code');
		   $discount_type = $this->input->post('type_discount');
		   $discount = $this->input->post('discount');
		   $promo_expire = $this->input->post('promo_expire');

		   $this->Home_Model->add_promotion($ser_type,$promo_name,$promo_code,$discount_type,$discount,$promo_expire);

			redirect('home/promotion_manager','refresh');

		}

	}

    public function manage_promotion_status() {
        if (isset($_POST['promo_id']) && isset($_POST['status'])) {
            $promo_id = $_POST['promo_id'];
            $status = $_POST['status'];
            $update = $this->Home_Model->manage_promotion_status($promo_id, $status);
            echo $update;
        } else {
            return false;
        }
    }

    public function promotinal_email() {

        $this->load->view('home/promtotional_mails');
    }

    public function send_grid() {
        //echo 'hii';
        $config['upload_path'] = 'public/upload_files/promotional_emails/';
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

        if (!$this->upload->do_upload('upload')) {
            $error = $this->upload->display_errors();
            $data['errors'] = $error;
//print_r($data['errors']);exit;
            //   $this->load->view('home/promtotional_mails', $data);
            redirect('home/promotinal_email/', 'refersh');
        } else {
            $up_e = array('upload_data' => $this->upload->data());

            //		$this->load->view('home/promtotional_mails', $data);
            redirect('home/promotinal_email', 'refersh');
        }

        $email = $this->Home_Model->get_emails();


        foreach ($email as $email_sg) {
            $email_send[] = $email_sg['user_email'];
        }
        $imp_mails = implode(',', $email_send);
        //echo '<pre>';print_r(implode(',',$email_send));
        $this->load->library('email');

        $this->email->initialize(array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.sendgrid.net',
            'smtp_user' => 'Basanth',
            'smtp_pass' => 'basanththedon123',
            'smtp_port' => 587,
            'crlf' => "\r\n",
            'newline' => "\r\n"
        ));

        /* $this->email->initialize(array(
          'protocol' => 'smtp',
          'smtp_host' => 'mail.travelpd.com',
          'smtp_user' => 'it@travelpd.com',
          'smtp_pass' => 'We11c0me',
          'smtp_port' => 587,
          'crlf' => "\r\n",
          'newline' => "\r\n"
          )); */
//print_r($up_e['upload_data']['full_path']);exit;
        $this->email->from('basanthboss@gmail.com', 'Your Name');
        $this->email->to($imp_mails);
//$this->email->cc('another@another-example.com');
//$this->email->bcc('them@their-example.com');
        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');
        $this->email->attach($up_e['upload_data']['full_path']);
        if ($this->email->send()) {
            $this->load->view('home/promtotional_mails', $data);
        }

        echo $this->email->print_debugger();
    }

    public function canc_markup_manager() {

        $data['api_list'] = $this->Home_Model->get_api_list();
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['canc_markup_list'] = $this->Home_Model->get_canc_markup_list();
        //echo '<pre/>';print_r($data);exit;
        $this->load->view('home/canc_markup_manager', $data);
    }

    public function canc_markup_manager_apartment() {

        $data['api_list'] = $this->Home_Model->get_api_list();
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['canc_markup_list'] = $this->Home_Model->get_canc_markup_list_apartment();
        //echo '<pre/>';print_r($data);exit;
        $this->load->view('home/canc_markup_manager_apartment', $data);
    }

    function update_canc_markups() {
        //echo $_POST['service_type'];exit;
        if (isset($_POST) && isset($_POST['service_type'])) {
            $service_type = $_POST['service_type'];
            $markup_type = $_POST['markup_type'];
            $api_name = $_POST['api_name'];
            $markup_process = $_POST['process'];
            $markup = $_POST['markup'];
            $country = $_POST['country'];

            $api_list = $this->Home_Model->get_api_list_by_service($service_type);
            if ($api_name == 'all') {
                if ($markup_type == 'generic') {
                    $this->Home_Model->delete_canc_markup($markup_type, $service_type);
                    //echo $this->db->last_query();
                }
                //	exit;
                $api_list = $this->Home_Model->get_api_list();

                for ($i = 0; $i < count($api_list); $i++) {
                    //echo $api_list[$i]->service_type;exit;
                    if ($api_list[$i]->service_type == $service_type) {
                        $check = $this->Home_Model->canc_markup_checking($country, $api_list[$i]->api_name, $markup_type, $service_type);
                        //exit;
                        if ($check == '') {
                            $this->Home_Model->add_canc_markup($country, $api_list[$i]->api_name, $markup_process, $markup, $markup_type, $service_type);
                        } else {
                            $this->Home_Model->delete_id_canc_markup($country, $api_list[$i]->api_name, $markup_type, $service_type);
                        }
                    }
                }
            } else {
                $check = $this->Home_Model->can_markup_checking($country, $api_name, $markup_type, $service_type);
                if ($check == '') {
                    $this->Home_Model->add_canc_markup($country, $api_name, $markup_process, $markup, $markup_type, $service_type);
                } else {
                    $this->Home_Model->delete_id_canc_markup($country, $api_name, $markup_type, $service_type);
                    $this->Home_Model->add_canc_markup($country, $api_name, $markup_process, $markup, $markup_type, $service_type);
                }
            }

            echo '1';
        } else {
            echo '2';
        }
    }

    function manage_canc_markup_status() {
        if (isset($_POST['markup_id']) && isset($_POST['status'])) {
            $markup_id = $_POST['markup_id'];
            $status = $_POST['status'];
            if ($status != '2') {
                $update = $this->Home_Model->manage_canc_markup_status($markup_id, $status);
            } else {
                $update = $this->Home_Model->delete_canc_markup_status($markup_id);
            }
            echo $update;
        } else {
            return false;
        }
    }

    public function canc_markup_manager_flights() {
        //echo 'casd';
        $data['api_list'] = $this->Home_Model->get_api_list();
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['canc_markup_list'] = $this->Home_Model->get_canc_markup_list_flights();
        //echo '<pre/>';print_r($data);exit;
        $this->load->view('home/canc_markup_manager_flights', $data);
    }

    public function canc_markup_manager_bus() {
        //echo 'casd';
        $data['api_list'] = $this->Home_Model->get_api_list(4);
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['canc_markup_list'] = $this->Home_Model->get_canc_markup_list_bus();
        //echo '<pre/>';print_r($data);exit;
        $this->load->view('home/canc_markup_manager_bus', $data);
    }

    public function update_bus_canc_markups() {
        if (isset($_POST) && isset($_POST['service_type'])) {
            $service_type = $_POST['service_type'];
            $markup_type = $_POST['markup_type'];
            $api_name = $_POST['api_name'];
            $markup_process = $_POST['process'];
            $markup = $_POST['markup'];
            $country = $_POST['country'];

            if ($api_name == 'all') {
                if ($markup_type == 'generic') {
                    $this->Home_Model->delete_canc_markup($markup_type, $service_type);
                }

                $api_list = $this->Home_Model->get_api_list(1);

                for ($i = 0; $i < count($api_list); $i++) {
                    if ($api_list[$i]->service_type == $service_type) {
                        $check = $this->Home_Model->canc_markup_checking($country, $api_list[$i]->api_name, $markup_type, $service_type);

                        if ($check == '') {
                            $this->Home_Model->add_canc_markup($country, $api_list[$i]->api_name, $markup_process, $markup, $markup_type, $service_type);
                        } else {
                            $this->Home_Model->delete_id_canc_markup($country, $api_list[$i]->api_name, $markup_type, $service_type);
                        }
                    }
                }
            } else {
                $check = $this->Home_Model->canc_markup_checking($country, $api_list[$i]->api_name, $markup_type, $service_type);

                if ($check == '') {
                    $this->Home_Model->add_canc_markup($country, $api_list[$i]->api_name, $markup_process, $markup, $markup_type, $service_type);
                } else {
                    $this->Home_Model->delete_id_canc_markup($country, $api_list[$i]->api_name, $markup_type, $service_type);
                }
            }

            echo '1';
        } else {
            echo '1';
        }
    }

    function update_canc_markups_flights() {  //echo $data;exit;
        if (isset($_POST) && isset($_POST['service_type'])) {
            //print_r($_POST);exit;
            $service_type = $_POST['service_type'];
            $markup_type = $_POST['markup_type'];
            $api_name = $_POST['api_name'];
            $markup_process = $_POST['process'];
            $markup = $_POST['markup'];
            $country = $_POST['country'];

            if ($api_name == 'all') {  //echo '1';exit;
                if ($markup_type == 'generic') {
                    $this->Home_Model->delete_canc_markup($markup_type, $service_type);
                }

                $api_list = $this->Home_Model->get_api_list();

                for ($i = 0; $i < count($api_list); $i++) {
                    if ($api_list[$i]->service_type == $service_type) {
                        $check = $this->Home_Model->canc_markup_checking($country, $api_list[$i]->api_name, $markup_type, $service_type);

                        if ($check == '') {
                            $this->Home_Model->add_canc_markup($country, $api_list[$i]->api_name, $markup_process, $markup, $markup_type, $service_type);
                        } else {
                            $this->Home_Model->delete_id_canc_markup($country, $api_list[$i]->api_name, $markup_type, $service_type);
                        }
                    }
                }
            } else {
                $check = $this->Home_Model->canc_markup_checking($country, $api_list[$i]->api_name, $markup_type, $service_type);

                if ($check == '') {
                    $this->Home_Model->add_canc_markup($country, $api_list[$i]->api_name, $markup_process, $markup, $markup_type, $service_type);
                } else {
                    $this->Home_Model->delete_id_canc_markup($country, $api_list[$i]->api_name, $markup_type, $service_type);
                }
            }

            echo '1';
        } else {
            echo '1';
        }
    }
    public function add_promo_group()
	{
		$data='';
		$data['group']=$this->Home_Model->add_promo_group();
		$this->load->view('home/add_promo_group',$data);
	}
    public function edit_promotion($promo_id='')
	{
		$this->form_validation->set_rules('service_type', 'Service Type', 'required');
		$this->form_validation->set_rules('promo_name', 'Promotion Name', 'trim|required');		
		$this->form_validation->set_rules('type_discount', 'Discount Type', 'trim|required|integer|');
		$this->form_validation->set_rules('discount', 'Discount', 'trim|required|integer');
		$this->form_validation->set_rules('promo_expire', 'Valid Upto', 'required');

		$data['status']='';
		$data['errors']='';

		$data['promo_id'] = $promo_id;
		$data['promotion_list'] = $this->Home_Model->get_promotion_by_promo_id($promo_id);

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('home/edit_promotion', $data);
		}
		else
		{
		   $service_type = $this->input->post('service_type');
		   $ser_type=implode(",",$service_type);
		   $promo_name = $this->input->post('promo_name');
		   $promo_code = $this->input->post('promo_code');
		   $discount_type = $this->input->post('type_discount');
		   $discount = $this->input->post('discount');
		   $promo_expire = $this->input->post('promo_expire');

		   if($this->Home_Model->update_promotion($promo_id,$ser_type,$promo_name,$discount_type,$discount,$promo_expire))
		   {//echo $this->db->last_query();exit;
			   redirect('home/promotion_manager','refresh');
		   }
		   else
		   {
			   $data['errors']='Promotion values not updated...';
			   $this->load->view('home/edit_promotion', $data);
		   }

		}

	}

    public function api_logs() {
        $data['flight_logs'] = $this->Home_Model->get_flight_logs();
        $data['hotel_logs'] = $this->Home_Model->get_hotel_logs();
        $data['bus_logs'] = $this->Home_Model->get_bus_logs();
        //echo '<pre/>';print_r($data['bus_logs']);exit;
        $this->load->view('home/api_logs_manager', $data);
    }

    public function download_logs_xml($type, $id, $col) {
        header("Content-type: application/xml");
        if ($type == 'hotels') {
            $hotel_details = $this->Home_Model->get_hotel_logs_by_id($id);
             //echo '<pre>';print_r($hotel_details);exit;
            if ($col == 1) {
                print_r(($hotel_details->search_request));
            } else if ($col == 2) {
                print_r(($hotel_details->search_response));
            } else if ($col == 3) {
                print_r(($hotel_details->reprice_request));
            } else if ($col == 4) {
                print_r(($hotel_details->reprice_response));
            } else if ($col == 5) {
                print_r(($hotel_details->Provisionalbooking_request));
            } else if ($col == 6) {
                print_r(($hotel_details->Provisionalbooking_response));
            } else if ($col == 7) {
                print_r(($hotel_details->getcancel_policyRQ));
            } else if ($col == 8) {
                print_r(($hotel_details->getcancel_policyRS));
            } else if ($col == 9) {
                print_r(($hotel_details->hotelbooking_request));
            } else if ($col == 10) {
                print_r(($hotel_details->hotelbooking_response));
            }
            else if ($col == 11) {
                print_r(($hotel_details->cancel_request));
            } else if ($col == 12) {
                print_r(($hotel_details->cancel_response));
            }
        } else if ($type == 'bus') {
            $bus_details = $this->Home_Model->get_bus_logs_by_id($id);
            //echo '<pre>';print_r($bus_details);exit;
            if ($col == 1) {
                print_r($bus_details->availabletrips_response);
            } else if ($col == 2) {
                print_r($bus_details->tripdetails_response);
            } else if ($col == 3) {
                print_r($bus_details->blockticket_response);
            } else if ($col == 4) {
                print_r($bus_details->confirmticket_response);
            } else if ($col == 5) {
                print_r($bus_details->bookingcancel_request);
            } else if ($col == 6) {
                print_r($bus_details->bookingcancel_response);
            }
        }
    }
    public function download_logs_xml_rx($type, $id, $col) {
        header("Content-type: application/xml");
        if ($type == 'hotels') {
            $hotel_details = $this->Home_Model->get_rooms_xml_hotel_logs($id);
             //echo '<pre>';print_r($hotel_details);exit;
            if ($col == 1) {
                print_r(($hotel_details->search_request));
            } else if ($col == 2) {
                print_r(($hotel_details->search_response));
            } else if ($col == 3) {
                print_r(($hotel_details->reprice_request));
            } else if ($col == 4) {
                print_r(($hotel_details->reprice_response));
            } else if ($col == 5) {
                print_r(($hotel_details->Provisionalbooking_request));
            } else if ($col == 6) {
                print_r(($hotel_details->Provisionalbooking_response));
            } else if ($col == 7) {
                print_r(($hotel_details->addhotelbooking_request));
            } else if ($col == 8) {
                print_r(($hotel_details->addhotelbooking_response));
            } else if ($col == 9) {
                print_r(($hotel_details->hotelbooking_request));
            } else if ($col == 10) {
                print_r(($hotel_details->hotelbooking_response));
            }
           else if ($col == 11) {
                print_r(($hotel_details->change_request));
            } else if ($col == 12) {
                print_r(($hotel_details->change_response));
            }
        } else if ($type == 'bus') {
            $bus_details = $this->Home_Model->get_bus_logs_by_id($id);
            //echo '<pre>';print_r($bus_details);exit;
            if ($col == 1) {
                print_r($bus_details->availabletrips_response);
            } else if ($col == 2) {
                print_r($bus_details->tripdetails_response);
            } else if ($col == 3) {
                print_r($bus_details->blockticket_response);
            } else if ($col == 4) {
                print_r($bus_details->confirmticket_response);
            } else if ($col == 5) {
                print_r($bus_details->bookingcancel_request);
            } else if ($col == 6) {
                print_r($bus_details->bookingcancel_response);
            }
        }
    }

    public function delete_logs($id) {
        $this->Home_Model->delete_logs($id);
        redirect('home/api_logs');
    }

    public function booking_counts() {
//echo '<pre>';print_r($_REQUEST);//exit;
        $startdate = isset($_GET['datepicker']) ? $_GET['datepicker'] : '';
        $enddate = isset($_GET['datepicker1']) ? $_GET['datepicker1'] : '';
        $flight = isset($_GET['flight']) ? $_GET['flight'] : '';
        $hotel = isset($_GET['hotel']) ? $_GET['hotel'] : '';
        $b2c = isset($_GET['b2c']) ? $_GET['b2c'] : '';
        $b2b = isset($_GET['b2b']) ? $_GET['b2b'] : '';
        $b2cuser = isset($_GET['b2cuser']) ? $_GET['b2cuser'] : '';
        $b2buser = isset($_GET['b2buser']) ? $_GET['b2buser'] : '';
        $bus = isset($_GET['bus']) ? $_GET['bus'] : '';
        $car = isset($_GET['car']) ? $_GET['car'] : '';

        if (isset($startdate) && $startdate != '') {
            $std = explode('/', $startdate);
            $startdate1 = $std[2] . '-' . $std[1] . '-' . $std[0];
        }
        if (isset($enddate) && $enddate != '') {
            $end = explode('/', $enddate);
            $enddate1 = $end[2] . '-' . $end[1] . '-' . $end[0];
        }

        $fetchcre = array('startdate' => $startdate1, 'enddate' => $enddate1, 'b2c' => $b2c, 'b2b' => $b2b, 'b2cuser' => $this->Home_Model->get_user_info_by_id($_GET['b2cuser']), 'b2buser' => $this->Home_Model->get_agent_info_by_id($_GET['b2buser'])); // print_r($fetchcre);//exit;
        $fadminmarkup = 0;
        $fpay = 0;
        $ftotal = 0;
        $fcount = 0;
        if ($flight != '') {
            list($adminmarkupf, $payf, $totalf, $countf) = $this->Home_Model->flightcount($fetchcre);
            $fadminmarkup+=$adminmarkupf;
            $fpay+=$payf;
            $ftotal+=$totalf;
            $fcount+=$countf;
        }
        if ($hotel != '') {
            list($adminmarkuph, $payh, $totalh, $counth) = $this->Home_Model->hotelcount($fetchcre);
            $fadminmarkup+=$adminmarkuph;
            $fpay+=$payh;
            $ftotal+=$totalh;
            $fcount+=$counth;
        }//echo $this->db->last_query();exit;
        if ($bus != '') {
            list($adminmarkupb, $payb, $totalb, $countb) = $this->Home_Model->buscount($fetchcre);
            $fadminmarkup+=$adminmarkupb;
            $fpay+=$payb;
            $ftotal+=$totalb;
            $fcount+=$countb;
        }
        if ($car != '') {
            list($adminmarkupc, $payc, $totalc, $countc) = $this->Home_Model->carcount($fetchcre);
            $fadminmarkup+=$adminmarkupc;
            $fpay+=$payc;
            $ftotal+=$totalc;
            $fcount+=$countc;
        }
        $data['b2c'] = $b2c;
        $data['b2b'] = $b2b;
        $data['b2cuser'] = $b2cuser;
        $data['b2buser'] = $b2buser;
        $data['startdate'] = $startdate;
        $data['enddate'] = $enddate;
        $data['flight'] = $flight;
        $data['hotel'] = $hotel;
        $data['bus'] = $bus;
        $data['car'] = $car;
        $data['totalbookings'] = $fcount;
        $data['adminprofit'] = $fadminmarkup;
        $data['payment'] = $fpay;
        $data['totalamount'] = $ftotal;
        $this->load->view('booking_counts', $data);
    }

    public function holiday_request_pass($from_date = '', $to_date = '') {
        $data['from_date'] = $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
        $data['to_date'] = $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
        $data['holiday_query_summary'] = $this->Home_Model->get_holiday_pac_req_pass($from_date, $to_date);
        $this->load->view('home/view_enquiry_holiday_pass', $data);
    }

    public function view_Holiday_page() {

        $data['from_date'] = $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
        $data['to_date'] = $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';

        $data['holiday_query_summary'] = $this->Home_Model->get_holiday_pac_req($from_date, $to_date);
        $data['flight_query_summary'] = $this->Home_Model->get_flights_pac_req($from_date, $to_date);
        $data['hotel_query_summary'] = $this->Home_Model->get_hotel_pac_req($from_date, $to_date);
        $data['bus_query_summary'] = $this->Home_Model->get_bus_pac_req($from_date, $to_date);
        $data['forex_query_summary'] = $this->Home_Model->get_forex_pac_req($from_date, $to_date);
        $data['cruise_query_summary'] = $this->Home_Model->get_cruis_pac_req($from_date, $to_date);
        $data['mice_query_summary'] = $this->Home_Model->get_mice_pac_req($from_date, $to_date);
        $data['train_query_summary'] = $this->Home_Model->get_train_pac_req($from_date, $to_date);
        $data['visa_query_summary'] = $this->Home_Model->get_visa_pac_req($from_date, $to_date);
        $data['insurance_query_summary'] = $this->Home_Model->get_ins_pac_req($from_date, $to_date);
        $data['corporate_query_summary'] = $this->Home_Model->get_corporate_pac_req($from_date, $to_date);

        $this->load->view('home/view_enquiry_details', $data);
    }

    public function view_flights_page($from_date = '', $to_date = '') {
        $data['from_date'] = $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
        $data['to_date'] = $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
        $data['flight_query_summary'] = $this->Home_Model->get_flights_pac_req($from_date, $to_date);

        $this->load->view('home/view_enquiry_details_flight', $data);
    }

    public function view_hotels_page($from_date, $to_date) {
        $data['from_date'] = $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
        $data['to_date'] = $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
        $data['hotel_query_summary'] = $this->Home_Model->get_hotel_pac_req($from_date, $to_date);

        $this->load->view('home/view_enquiry_details_hotel', $data);
    }

    public function view_bus_page($from_date, $to_date) {
        $data['from_date'] = $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
        $data['to_date'] = $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
        $data['bus_query_summary'] = $this->Home_Model->get_bus_pac_req($from_date, $to_date);

        $this->load->view('home/view_enquiry_details_bus', $data);
    }

    public function view_forex_page($from_date, $to_date) {
        $data['from_date'] = $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
        $data['to_date'] = $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
        $data['forex_query_summary'] = $this->Home_Model->get_forex_pac_req($from_date, $to_date);

        $this->load->view('home/view_enquiry_details_forex', $data);
    }

    public function view_cruise_page($from_date, $to_date) {
        $data['from_date'] = $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
        $data['to_date'] = $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
        $data['flight_query_summary'] = $this->Home_Model->get_cruis_pac_req($from_date, $to_date);

        $this->load->view('home/view_enquiry_details_cruise', $data);
    }

    public function view_mice_page($from_date, $to_date) {
        $data['from_date'] = $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
        $data['to_date'] = $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
        $data['flight_query_summary'] = $this->Home_Model->get_mice_pac_req($from_date, $to_date);

        $this->load->view('home/view_enquiry_details_mice', $data);
    }

    public function view_train_page($from_date = '', $to_date = '') {
        $data['from_date'] = $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
        $data['to_date'] = $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
        $data['flight_query_summary'] = $this->Home_Model->get_train_pac_req($from_date, $to_date);

        $this->load->view('home/view_enquiry_details_train', $data);
    }

    public function view_visa_page($from_date, $to_date) {
        $data['from_date'] = $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
        $data['to_date'] = $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
        $data['flight_query_summary'] = $this->Home_Model->get_visa_pac_req($from_date, $to_date);

        $this->load->view('home/view_enquiry_details_visa', $data);
    }

    public function view_insurance_page($from_date, $to_date) {
        $data['from_date'] = $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
        $data['to_date'] = $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
        $data['flight_query_summary'] = $this->Home_Model->get_ins_pac_req($from_date, $to_date);

        $this->load->view('home/view_enquiry_details_insurance', $data);
    }

    public function view_corporate_page($from_date, $to_date) {
        $data['from_date'] = $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
        $data['to_date'] = $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
        $data['flight_query_summary'] = $this->Home_Model->get_corporate_pac_req($from_date, $to_date);

        $this->load->view('home/view_enquiry_details_corporate', $data);
    }

    public function view_feedback_page() {

        $data['feedback_query_summary'] = $this->Home_Model->get_feeedback_pac_req();

        $this->load->view('home/view_enquiry_details_feedback', $data);
    }

    public function view_header_page($id) {

        $data['id'] = $id;
        $data['result'] = $this->Home_Model->get_menu_desc($id);
//print_r($data['result']);exit;
        $this->load->view('home/header_mice', $data);
    }

    public function view_header_page_update($id) {
        $content = $this->input->post('content');
        $this->Home_Model->update_menu_desc($content, $id);
        redirect('home/view_header_page/' . $id);
    }

    public function jtpl_tax_charge() {
        $data['get_site_tax'] = $this->Home_Model->get_all_tax();
//echo '<pre>';print_r($data['get_site_tax']);exit;
//$data['get_site_tax']=$this->Home_Model->get_site_tax();
        $this->load->view('home/jtpl_tax_charge', $data);
    }

    public function update_tax() {
//print_r($_POST['service_type']);exit;

        $this->Home_Model->update_site_tax($_POST['service_type'], $_POST['tax']);


        $this->load->view('home/jtpl_tax_charge');
    }

    public function pay_details($uniqueRefNo, $bookRefNo) {

        $data['pay_details'] = $this->Home_Model->get_pay_details($uniqueRefNo);
        $this->load->view('home/pay_details', $data);
    }
    public function update_discount_promo() {
        //echo '<pre>';print_r($_POST);exit;
        $promo_name = $this->input->post('promoname');
        $discount_type = $this->input->post('type_discount');
        $discount = $this->input->post('discount');
        //echo '<pre>';print_r($promo_name);exit;
        // $promo_id=implode(",",$promo_name);
        // echo '<pre>';print_r($promo_id);exit;
        foreach ($promo_name as $pid) {
            $update_dis = $this->Home_Model->update_discount($pid, $discount_type, $discount);
        }
        if ($update_dis) {
            redirect('home/promotion_manager', 'refresh');
        }
    }
	
	
	public function addfacilities() {
		$id='';
        $data['facilities_info'] = $this->Home_Model->get_fac_info($id);
        //echo '<pre>';print_r($data);exit;
        $this->load->view('home/add_facilities', $data);
    }
	
	public function add_fac_data() {
		$star = $this->input->post('star');
        $facilities = $this->input->post('fac');
        $facilities = implode(',',$facilities);
		
		$data = array(
		'star' => $star,
		'facilities' => $facilities
		);
        $this->Home_Model->add_fac_info($data);
       // echo '<pre>';print_r($_POST);exit;
	    redirect('home/addfacilities', 'refresh');
    }
	
	public function update_fac_data($id) {
		//echo $id;exit;
		$star = $this->input->post('star');
        $facilities = $this->input->post('fac');
        $facilities = implode(',',$facilities);
		
		$data = array(
		'star' => $star,
		'facilities' => $facilities
		);
        $this->Home_Model->update_fac_info($data, $id);
       // echo '<pre>';print_r($_POST);exit;
	    redirect('home/addfacilities', 'refresh');
    }
		
	public function edit_facilities($id) {
		
        $data['facilities_info'] = $this->Home_Model->get_fac_info($id);
        //echo '<pre>';print_r($data);exit;
        $this->load->view('home/edit_facilities', $data);
    }
	
	public function addoffer() {
        $data['offer'] = $this->Home_Model->get_offer_info();
        //echo '<pre>';print_r($data);exit;
        $this->load->view('home/add_offer', $data);
    }
	
	public function add_offer_data() {
		//echo '<pre/>';print_r($_POST);exit;
        $offer_name = $this->input->post('offer_name');
		$offer_img = $this->input->post('offer_img');
		
		$data['offer_img'] = $this->input->post('offer_img');
		
            $insert_id = $this->Home_Model->insert_offer($offer_name);
			//echo $insert_id;exit;
			$this->upload_offer_image($insert_id);
			
        redirect('home/addoffer');
    }
	
	public function upload_offer_image($insert_id) { //echo $insert_id;exit;
        $config['upload_path'] = './public/upload_files/offer/' . $insert_id . '/';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }

        if (!$this->upload->do_upload('offer_img')) {
            $error = $this->upload->display_errors();
            $data['errors'] = $error;
			//echo $error;exit;
            $this->load->view('home/add_offer', $data);
        } else {
			//echo $insert_id;exit;
            $offer = $this->Home_Model->get_offer_id($insert_id);
            if (!empty($offer->offer_img)) {
                unlink($offer->offer_img);
            }

            $upload_data = $this->upload->data();
			//print_r($upload_data);
            $file_name = $upload_data["file_name"];
			//echo $file_name;exit;
            $source_image = '/public/upload_files/offer/' . $insert_id . '/' . $file_name;

            $this->Home_Model->update_offer_img($insert_id, $source_image);
        }
    }
	
	public function action($id, $status){
		// echo 1;
		// echo $status;exit;
		$this->Home_Model->status_change($id, $status);
		redirect('home/addoffer');
	}
// World Wide Airport Auto List
    public function airport_autolist()
    {   
        
        $result_arr = array();                  
                if(isset($_GET['term']) && isset($_GET['exclude']))
        {
                    $search = trim($this->input->get('term'));
                    $exclude = trim($this->input->get('exclude'));
                    
                    $airport_list = $this->Home_Model->get_airport_list($exclude,$search);
                    
                    if(!empty($airport_list))
                    {
                        foreach($airport_list as $res)
                        {
                            $airport_code = $res->airport_code;         
                            $airport_city = $res->airport_city;
                            $airport_country = $res->airport_country;
                            $airport_name = $res->airport_name;
                            
                            $result_arr[] = array(
                                'id' => ucfirst($airport_code),
                                'value' =>  ucfirst($airport_name).', '.ucfirst($airport_city).' - '.ucfirst($airport_country)." ($airport_code)"
                            );
                            
                        }
                    }
                    else
                    {
                        $result_arr[] =  array(
                            'id' => '',
                            'value' => 'No matching records'
                        );
                    }
                                      
                }
                else
                {
                    $result_arr[] =  array(
                        'id' => '',
                        'value' => 'No matching records'
                    );
                }
                
                /* Toss back results as json encoded array. */
                 echo json_encode($result_arr);                    
    
    }
//    public function insert_admin(){
//        $data=array(
//            'admin_group_id'=>'3',
//            'admin_privilege_id'=>'9',
//        );
//        $this->db->insert('admin_privilege_groups',$data);
//    }


 public function add_insurance(){
        $data['insurance_list'] =  $this->Home_Model->get_insurance();
       // echo '<pre/>';print_r($data['offer_list']);exit;
        $this->load->view('home/add_insurance',$data);
    }
   
    public function insert_insurance(){
         // echo '<pre/>';print_r($_FILES);exit;
        $plan_name = $_POST['plan_name'];
        $base_fare = $_POST['base_fare'];
        $tax_fare = $_POST['tax_fare'];
        $tds_fare = $_POST['tds_fare'];
        $trip_type = $_POST['trip_type'];
        $data = array(
            'plan_name'=> $plan_name,
            'total_fare'=> $base_fare,
            'tax'=> $tax_fare,
            'tds_fare'=> $tds_fare,
            'trip_type'=> $trip_type,
            'status'=> 1,
        );
        $this->Home_Model->add_insurance($data);
        
        redirect('home/add_insurance');
        
    }

    public function edit_insurance($id){
        $data['insurance'] = $this->Home_Model->get_insurance_by_id($id);
         // echo '<pre/>';print_r($data['offers']);exit;
        $this->load->view('home/edit_insurance', $data);
    }
    public function insurance_active($hol_id,$id){
        $this->Home_Model->package_active($hol_id,$id);
        redirect('home/add_insurance', 'refresh');
    }
    public function update_insurance(){
        // echo '<pre/>';print_r($_POST);exit;
        $id = $_POST['id'];
        $plan_name = $_POST['plan_name'];
        $base_fare = $_POST['base_fare'];
        $tax_fare = $_POST['tax_fare'];
        $tds_fare = $_POST['tds_fare'];
        $trip_type = $_POST['trip_type'];
        $data = array(
            'plan_name'=> $plan_name,
            'total_fare'=> $base_fare,
            'tax'=> $tax_fare,
            'trip_type'=> $trip_type,
            'status'=> 1,
        );
        $this->Home_Model->update_insurance($id,$data);
          // echo $this->db->last_query();exit;
        $this->session->set_flashdata('message','Offer Updated Successfully!');
      
        // echo '<pre/>';print_r($id);exit;
        redirect('home/add_insurance');
    }   


}
