<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class B2b extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('B2b_Model');
		$this->load->model('B2c_Model');
		$this->load->model('Home_Model');
		$this->load->model('Email_Model');
		$this->load->library('admin_auth');
		$this->is_admin_logged_in();

	}

	private function is_admin_logged_in() {
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('login/index');
		}

	}
	/*public function create_agent() {
		$data['group_info_flight'] = $this->Home_Model->get_group_list_flight('2', '1');
		$data['group_info_bus'] = $this->Home_Model->get_group_list_flight('2', '2');
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['currency_list'] = $this->Home_Model->get_currency_list();
		// $data['group_list']=$this->Home_Model->get_group_name();
		$this->load->view('b2b/create_agent', $data);
	}*/
	function create_agent()
	{
		$this->form_validation->set_rules('agent_email', 'Email', 'trim|required|valid_email|is_unique[agent_info.agent_email]');
		$this->form_validation->set_rules('agent_password', 'Password', 'trim|required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
		$this->form_validation->set_rules('agency_name', 'Agency/Company Name', 'trim|required');
		//$this->form_validation->set_rules('agency_logo', 'Agency Logo', 'trim|required');
		$this->form_validation->set_rules('currency_type', 'Currency', 'required');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
		$this->form_validation->set_rules('office_phone_no', 'Office Phone No', 'trim|required|integer|min_length[10]');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		//$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('country', 'Country', 'required');

		$data['status']='';
		$data['errors']='';
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['currency_list'] = $this->Home_Model->get_currency_list();

		if($this->form_validation->run()==FALSE)
		{
			$data['agent_email'] = $this->input->post('agent_email');
		   	$data['agency_name'] = $this->input->post('agency_name');
		   	$data['first_name'] = $this->input->post('first_name');
			$data['middle_name'] = $this->input->post('middle_name');
		   	$data['last_name'] = $this->input->post('last_name');
		   	$data['mobile_no'] = $this->input->post('mobile_no');
		   	$data['office_phone_no'] = $this->input->post('office_phone_no');
		   	$data['address'] = $this->input->post('address');
		   	$data['pin_code'] = $this->input->post('pin_code');
		   	$data['city'] = $this->input->post('city');
		   	$data['state'] = $this->input->post('state');
            $data['tan_no'] = $this->input->post('tan_no');
            $data['pan_no'] = $this->input->post('pan_no');

			$this->load->view('b2b/create_agent',$data);
		}
		else
		{
			// echo '<pre/>';print_r($_POST);exit;
			$agent_email = $this->input->post('agent_email');
			$agent_password = md5($this->input->post('agent_password'));
		   	$agency_name = $this->input->post('agency_name');
			$currency_type = $this->input->post('currency_type');
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
            $tan_no = $this->input->post('tan_no');
            $pan_no = $this->input->post('pan_no');
            $agent_type = $this->input->post('agent_type');

			$email_check = $this->B2b_Model->check_email_availability($agent_email);

			if($email_check != '' || !empty($email_check))
			{
				$data['errors'] = 'Email Already Exists. Please use different email id to continue registration...';
				$this->load->view('b2b/create_agent',$data);
			}
			else
			{
				 $config['upload_path'] = 'public/upload_files/b2b/images/' . $agent_email . '/logos/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite'] = TRUE;
				$config['max_size'] = '0';
				$config['max_width']  = '0';
				$config['max_height']  = '0';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if(!is_dir($config['upload_path'])){
    				mkdir($config['upload_path'], 0755, TRUE);
				}

				if(!$this->upload->do_upload('agency_logo'))
				{
					$error = $this->upload->display_errors();
					$data['errors'] =$error;
					$this->load->view('b2b/create_agent',$data);

				}
				else
				{
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
					$image_config['master_dim'] = ($dim > 0)? "height" : "width";

					$this->load->library('image_lib');
					$this->image_lib->initialize($image_config);

					if(!$this->image_lib->resize())  //Resize image
					{
    					$error = $this->upload->display_errors();
						$data['errors'] =$error;

						$this->load->view('b2b/create_agent',$data); //If error, redirect to an error page
					}
					else
					{
						unlink($upload_data["full_path"]);

						$image_path = base_url().'public/upload_files/b2b/images/'.$agent_email.'/logos/agent_logo.png';

						if($this->B2b_Model->add_agent($agent_email,$agent_password,$agency_name,$currency_type,$title,$first_name,$middle_name,$last_name,$mobile_no,$office_phone_no,$address,$pin_code,$city,$state,$country,$image_path,$tan_no,$pan_no,$agent_type)){
						 $email_data = array(
                                'agent_email' => $agent_email,
                                'title' => $title,
                                'first_name' => $first_name,
                                'password' => $this->input->post('agent_password')
                            );
                            $this->Email_Model->registration_conformation($email_data);
                            redirect('b2b/agent_manager', 'refresh');
						}
						else
						{
							$data['errors'] = 'Agent Registration Not Done. Please try after some time...';
							$this->load->view('b2b/create_agent',$data);

						}
					}


				}


			}
		}
	}

	public function save_agent() {
		$this->form_validation->set_rules('agent_email', 'Email', 'trim|required|valid_email|is_unique[agent_info.agent_email]');
		$this->form_validation->set_rules('agent_password', 'Password', 'trim|required|matches[passconf]');
		$this->form_validation->set_rules('agency_name', 'Agency/Company Name', 'trim|required');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');

		$agent_email = $this->input->post('agent_email');
		$agent_password = md5($this->input->post('agent_password'));
		$agency_name = $this->input->post('agency_name');
		$agency_logo = $this->input->post('agency_logo');
		$agency_id_proof = $this->input->post('agency_id_proof');
		$agency_address_proof = $this->input->post('agency_address_proof');
		$title = $this->input->post('title');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$mobile_no = $this->input->post('mobile_no');
		$office_phone_no = $this->input->post('office_phone_no');
		$address = $this->input->post('address');
		$pin_code = $this->input->post('pin_code');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$country = $this->input->post('country');
		$tan_no = $this->input->post('tan_no');
		$pan_no = $this->input->post('pan_no');
		$name_pan_card = $this->input->post('name_pan_card');
		$designation = $this->input->post('designation');
		$aadhar_no = $this->input->post('aadhar_no');
		$website = $this->input->post('website');
		$remarks = $this->input->post('remarks');
		$assign_agent_flight = $this->input->post('assign_agent_flight');
		$assign_agent_bus = $this->input->post('assign_agent_bus');
		$gst_number = $this->input->post('gst_number');

		$data['status'] = '';
		$data['errors'] = '';

		if ($this->form_validation->run() == FALSE) {
			$data['errors'] = validation_errors();
			$this->load->view('b2b/create_agent');
		} else {
			$document_path = $this->document_upload_idproof($agent_email);
			$document_address_path = $this->document_upload_address($agent_email);
			$agent_logopath = $this->agent_logo_upload($agent_email);
			$gst_upload_path = $this->gst_document_upload($agent_email);
			$data = array(
				'agent_email' => $agent_email,
				'agent_password' => $agent_password,
				'agency_name' => $agency_name,
				'title' => $title,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'mobile_no' => $mobile_no,
				'office_phone_no' => $office_phone_no,
				'address' => $address,
				'pin_code' => $pin_code,
				'city' => $city,
				'state' => $state,
				'country' => $country,
				'designation' => $designation,
				'aadhar_no' => $aadhar_no,
				'website' => $website,
				'remarks' => $remarks,
				'assign_agent_flight' => $assign_agent_flight,
				'assign_agent_bus' => $assign_agent_bus,
				'agent_logo' => $agent_logopath,
				'agency_id_proof' => $document_path,
				'agency_address_proof' => $document_address_path,
				'gst_upload' => $gst_upload_path,
				'status' => 1,
				'agent_type' => 1,
				'PAN_no' => $pan_no,
				'name_pan_card' => $name_pan_card,
				'company_type' => $company_type,
				'gst_number' => $gst_number,
			);
			$agent_no = $this->B2b_Model->add_agent($data);
			$bank_info = $this->B2b_Model->get_bank_details();
			// echo '<pre/>';print_r($bank_info);exit;
			if ($agent_no) {
				$email_data = array(
					'agent_no' => $agent_no,
					'title' => $this->input->post('title'),
					'first_name' => $first_name,
					'agent_email' => $agent_email,
					'register_date' => date('Y-m-d'),
					'bank_name' => $bank_info[1]->bank_name,
					'account_no' => $bank_info[1]->account_no,
					'ifsc_code' => $bank_info[1]->ifsc_code,
					'branch' => $bank_info[1]->branch,
					'status' => 'Disabled',
					'agency_name' => $agency_name,
					'mobile_no' => $mobile_no,
					'address' => $address,
					'city' => $city,
					'state' => $state,
					'pin_code' => $pin_code,
					'subject' => 'Your Agent Application - [' . $agent_no . ']',
					'agent_password' => $this->input->post('agent_password'),
				);
				// echo '<pre/>';print_r($email_data);exit;
				$this->Email_Model->registration_conformation($email_data);
				redirect('b2b/agent_manager', 'refresh');
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

	public function agent_manager_list()
	{
		$data['agent_info'] = $this->B2b_Model->get_agent_manage_list();
		//echo '<pre/>';print_r($data['agent_info']);exit;
		$this->load->view('b2b/agent_manager_list',$data);
	}
	public function agent_manager() {

		$data['city'] = $city = isset($_GET['city']) ? $_GET['city'] : '';
		$data['state'] = $state = isset($_GET['state']) ? $_GET['state'] : '';
		$data['fromdate'] = $fromdate = isset($_GET['fromdate']) ? $_GET['fromdate'] : '';
		$data['todate'] = $todate = isset($_GET['todate']) ? $_GET['todate'] : '';
		$data['creditbalance'] = $creditbalance = isset($_GET['creditbalance']) ? $_GET['creditbalance'] : '';
		$data['agentname'] = $agentname = isset($_GET['agentname']) ? $_GET['agentname'] : '';

		$agent_info = $data['agent_info'] = $this->B2b_Model->get_agent_list($city, $state, $fromdate, $todate, $creditbalance, $agentname);
		$agent_info1 = $data['agent_info1'] = $this->B2b_Model->get_agent_list1();

		/*$agent_state = array();
			$agent_city = array();
			foreach ($agent_info as $key => $value) {
				$agent_state[$key] = $value->state;
				$agent_city[$key] = $value->city;
			}
			$data['agent_state'] = $agent_state;
		*/

		// echo '<pre/>';print_r($data['agent_state']);exit;
		$this->load->view('b2b/agent_manager', $data);
	}

	public function view_agent_markups() {

		$data['agent_markups'] = $this->B2b_Model->get_agent_markups();
		$this->load->view('b2b/agent_markups', $data);
	}

	public function view_agent_info($agent_id = '', $status = '', $errors = '') {
		$data['status'] = $status;
		$data['errors'] = $errors;
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['currency_list'] = $this->Home_Model->get_currency_list();
		// $data['group_info_flight'] = $this->Home_Model->get_group_list_flight('2', '1');
		// $data['group_info_bus'] = $this->Home_Model->get_group_list_flight('2', '2');
		// $agent_id = base64_decode($agent_id);
		$data['agent_id'] = $agent_id;
		$data['agent_info'] = $agent_info = $this->B2b_Model->get_agent_info_by_id($agent_id);
		// $data['group_list']=$this->Home_Model->get_group_name();
		// $agent_info['register_date']=$register_date;
		// echo $register_date;exit;
		// echo '<pre/>';print_r($agent_info['register_date']);exit;
// 		$currentmonthf = date('Y-m') . '-01 00:00:00';
// 		$currentmonthto = date('Y-m') . '-31 00:00:00';
// 		$lastmonthf = date(('Y-m') . '-01 00:00:00', strtotime('-1 months'));
// 		$lastmonthhto = date(('Y-m') . '-31 00:00:00', strtotime('-1 months'));
// 		$last3monthf = date(('Y-m') . '-01 00:00:00', strtotime('-3 month'));
// 		$last3monthto = date(('Y-m') . '-31 00:00:00', strtotime('-3 month'));
// 		//below is for flightbooking domestic
// 		$data['curr_monthfd'] = $this->B2b_Model->flightbookingcount($agent_id, $currentmonthf, $currentmonthto, 1);
// 		$data['lastmonthfd'] = $this->B2b_Model->flightbookingcount($agent_id, $lastmonthf, $lastmonthhto, 1);
// 		$data['last3monthfd'] = $this->B2b_Model->flightbookingcount($agent_id, $last3monthf, $last3monthto, 1);
// 		$data['lifetimefd'] = $this->B2b_Model->flightbookingcount($agent_id, '', '', 1);
// // belos is for flightbooking international
// 		$data['curr_monthfi'] = $this->B2b_Model->flightbookingcount($agent_id, $currentmonthf, $currentmonthto, 2);
// 		$data['lastmonthfi'] = $this->B2b_Model->flightbookingcount($agent_id, $lastmonthf, $lastmonthhto, 2);
// 		$data['last3monthfi'] = $this->B2b_Model->flightbookingcount($agent_id, $last3monthf, $last3monthto, 2);
// 		$data['lifetimefi'] = $this->B2b_Model->flightbookingcount($agent_id, '', '', 2);
// // below is for bus
// 		$data['curr_monthb'] = $this->B2b_Model->busbookingcount($agent_id, $currentmonthf, $currentmonthto);
// 		$data['lastmonthb'] = $this->B2b_Model->busbookingcount($agent_id, $lastmonthf, $lastmonthhto);
// 		$data['last3monthb'] = $this->B2b_Model->busbookingcount($agent_id, $last3monthf, $last3monthto);
// 		$data['lifetimeb'] = $this->B2b_Model->busbookingcount($agent_id);
		// echo $data['curr_month'];
		// echo '<pre/>';print_r($data['curr_month']);exit;

		$this->load->view('b2b/view_agent_info', $data);
	}

	function update_agent_info() {
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('pin_code', 'Pin Code', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('pan_no', 'Pan Number', 'trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
		$data['status'] = '';
		$data['errors'] = '';

		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['currency_list'] = $this->Home_Model->get_currency_list();

		$data['agent_id'] = $agent_id = $this->input->post('agent_id');
		$data['agent_info'] = $this->B2b_Model->get_agent_info_by_id($agent_id);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('b2b/view_agent_info', $data);
		} else {
			$agent_email = $this->input->post('agent_email');
			$document_path = $this->document_upload_idproof($agent_email);
			$document_address_path = $this->document_upload_address($agent_email);
			//$agent_logopath = $this->agent_logo_upload($agent_email);
			$gst_upload_path = $this->gst_document_upload($agent_email);
				$config['upload_path'] = 'public/upload_files/b2b/images/' . $agent_email . '/logos/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite'] = TRUE;
				$config['max_size'] = '0';
				$config['max_width']  = '0';
				$config['max_height']  = '0';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if(!is_dir($config['upload_path'])){
    				mkdir($config['upload_path'], 0755, TRUE);
				}

				if(!$this->upload->do_upload('agency_logo'))
				{
					$error = $this->upload->display_errors();
					$data['errors'] =$error;

					$this->load->view('b2b/create_agent',$data);

				}
				else
				{
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
					$image_config['master_dim'] = ($dim > 0)? "height" : "width";

					$this->load->library('image_lib');
					$this->image_lib->initialize($image_config);

					if(!$this->image_lib->resize())  //Resize image
					{
    					$error = $this->upload->display_errors();
						$data['errors'] =$error;

						$this->load->view('b2b/create_agent',$data); //If error, redirect to an error page
					}
					else
					{
						unlink($upload_data["full_path"]);

						$image_path = base_url().'public/upload_files/b2b/images/'.$agent_email.'/logos/agent_logo.png';
					}
				}
			$data = array(
				'agency_name' => $this->input->post('agency_name'),
				'title' => $this->input->post('title'),
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				// 'designation' => $this->input->post('designation'),
				'mobile_no' => $this->input->post('mobile_no'),
				'office_phone_no' => $this->input->post('office_phone_no'),
				'address' => $this->input->post('address'),
				'pin_code' => $this->input->post('pin_code'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state'),
				'country' => $this->input->post('country'),
				'PAN_no' => $this->input->post('pan_no'),
				// 'agent_logo' => $image_path,
				// 'name_pan_card' => $this->input->post('name_pan_card'),
				// 'aadhar_no' => $this->input->post('aadhar_no'),
				// 'service_tax_no' => $this->input->post('service_tax_no'),
				'website' => $this->input->post('website'),
				// 'assign_agent_flight' => $this->input->post('assign_agent_flight'),
				// 'assign_agent_bus' => $this->input->post('assign_agent_bus'),
				'gstnumber' => $this->input->post('gst_number'),
				// 'company_type' => $this->input->post('company_type'),
				// 'remarks' => $this->input->post('remarks'),
			);
			$this->B2b_Model->update_agent($data, $agent_id);
			if (!empty($image_path)) {
				$dataup = array(
					'agent_logo' => $image_path,
				);
				$this->B2b_Model->update_agent($dataup, $agent_id);
			}

			if (!empty($document_path)) {
				$dataup2 = array(
					'agency_id_proof' => $document_path,
				);
				$this->B2b_Model->update_agent($dataup2, $agent_id);
			}
			if (!empty($document_address_path)) {
				$dataup3 = array(
					'agency_address_proof' => $document_address_path,
				);
				$this->B2b_Model->update_agent($dataup3, $agent_id);
			}
			if (!empty($gst_upload_path)) {
				$dataup3 = array(
					'gst_upload' => $gst_upload_path,
				);
				$this->B2b_Model->update_agent($dataup3, $agent_id);
			}
			// echo '<pre>ds';print_r($data);exit;
			redirect('b2b/agent_manager', 'refresh');
			// redirect('b2b/view_agent_info/'.$agent_id.'/1','refresh');

		}
	}

	public function hotel_markup_manager()
	{
		$data['agent_list'] = $this->B2b_Model->get_active_agent_list();
		$data['api_list'] = $this->Home_Model->get_api_list();
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['b2b_markup_list'] = $this->B2b_Model->get_hotel_markup_list();
		 //echo '<pre/>';print_r($data['b2b_markup_list']);exit;
		$this->load->view('b2b/hotel_markup_manager', $data);

	}

	public function activity_markup_manager()
	{
		$data['agent_list'] = $this->B2b_Model->get_active_agent_list();
		$data['api_list'] = $this->Home_Model->get_api_list();
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['b2b_markup_list'] = $this->B2b_Model->get_activity_markup_list();
		// echo '<pre/>';print_r($data);exit;
		$this->load->view('b2b/activity_markup_manager', $data);

	}

	public function holiday_markup_manager()
	{
		$data['agent_list'] = $this->B2b_Model->get_active_agent_list();
		$data['api_list'] = $this->Home_Model->get_api_list();
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['b2b_markup_list'] = $this->B2b_Model->get_holiday_markup_list();
		// echo '<pre/>';print_r($data);exit;
		$this->load->view('b2b/holiday_markup_manager', $data);

	}
	function change_agent_password($agent_id = '') {
		$this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');

		$data['status'] = '';
		$data['errors'] = '';

		$data['agent_id'] = $agent_id;
		$data['agent_info'] = $agent_info = $this->B2b_Model->get_agent_info_by_id($agent_id);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('b2b/change_agent_password', $data);
		} else {
			if ($this->input->post('password') == $this->input->post('passconf')) {
				$password = md5($this->input->post('password'));
				if ($this->B2b_Model->update_agent_password($agent_id, $password)) {
					$data['status'] = 1;
				} else {
					$data['errors'] = 'Agent Password not Updated. Please try after some time...';
				}
			} else {
				$data['errors'] = 'Current Password is wrong. Please enter correct current password...';
			}

			$this->load->view('b2b/change_agent_password', $data);
		}

	}

	function manage_agent_status() {

		// echo '<pre/>';print_r($_POST);exit;
		if (isset($_POST['agent_id']) && isset($_POST['status'])) {
			// echo '<pre/>';print_r($_POST);exit;
			$agent_id = $_POST['agent_id'];
			// echo $agent_id;
			$status = $_POST['status'];
			// echo $status;exit;
			$update = $this->B2b_Model->manage_agent_status($agent_id, $status);
			$data['agent_info'] = $agent_info = $this->B2b_Model->get_agent_info_by_id($agent_id);
			// echo '<pre/>';print_r($data['agent_info']);exit;
			$bank_info = $this->B2b_Model->get_bank_details();
			if ($status == 1) {
				$stat_msg = 'Activated';
				$info = array(
					'agent_no' => $agent_id,
					'agent_id' => $agent_info->agent_no,
					'bank_name' => $bank_info[0]->bank_name,
					'account_no' => $bank_info[0]->account_no,
					'ifsc_code' => $bank_info[0]->ifsc_code,
					'branch' => $bank_info[0]->branch,
					'agency_name' => $agent_info->agency_name,
					'email' => $agent_info->agent_email,
					'register_date' => date('Y-m-d'),
					'first_name' => $agent_info->first_name,
					'mobile_no' => $agent_info->mobile_no,
					'address' => $agent_info->address,
					'city' => $agent_info->city,
					'state' => $agent_info->state,
					'pin_code' => $agent_info->pin_code,
					'status' => $stat_msg,
				);
				// echo '123<pre>';print_r($info);exit;
				$this->Email_Model->agent_activation_email($info);
				// echo $update;
			} elseif ($status == 0) {

				$stat_msg = 'De-activated';
				$data_info = array(
					'agent_no' => $agent_id,
					'agent_id' => $agent_info->agent_no,
					'agency_name' => $agent_info->agency_name,
					'email' => $agent_info->agent_email,
					'first_name' => $agent_info->first_name,
					'status' => $stat_msg,
				);
				// echo '<pre>';print_r($data_info);exit;
				$this->Email_Model->agent_deactivation_email($data_info);
			}

		} else {
			return false;
		}

	}

	public function view_account_stmt($agent_id = '') {
		$data['agent_id'] = $agent_id;
		$data['agent_info'] = $this->B2b_Model->get_agent_info_by_id($agent_id);
		$data['agent_acc_summary'] = $this->B2b_Model->get_acc_summary($agent_id);
		$this->load->view('b2b/view_account_stmt', $data);
	}

	function add_transaction_info() {
		$this->form_validation->set_rules('amount', 'Amount', 'trim|required|integer');
		$this->form_validation->set_rules('value_date', 'Date', 'trim|required');
		$this->form_validation->set_rules('transaction_mode', 'Transaction Mode', 'required');
		$this->form_validation->set_rules('branch', 'Branch', 'trim|required');
		$this->form_validation->set_rules('bank', 'Bank', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('transaction_id', 'Transaction Id', 'trim|required');
		$this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');

		$data['status'] = '';
		$data['errors'] = '';

		$data['agent_id'] = $agent_id = $this->input->post('agent_id');
		$data['agent_info'] = $this->B2b_Model->get_agent_info_by_id($agent_id);
		$data['agent_acc_summary'] = $this->B2b_Model->get_agent_acc_summary($agent_id);

		if ($this->form_validation->run() == FALSE) {
			$data['amount'] = $this->input->post('amount');
			$data['value_date'] = $this->input->post('value_date');
			$data['bank'] = $this->input->post('bank');
			$data['branch'] = $this->input->post('branch');
			$data['city'] = $this->input->post('city');
			$data['transaction_id'] = $this->input->post('transaction_id');
			$data['remarks'] = $this->input->post('remarks');
			$this->load->view('b2b/view_account_stmt', $data);
		} else {
			//echo '<pre/>';print_r($_POST);exit;
			$transaction_type = $this->input->post('transaction_type');
			$amount = $this->input->post('amount');
			$value_date = $this->input->post('value_date');
			$transaction_mode = $this->input->post('transaction_mode');
			$bank = $this->input->post('bank');
			$branch = $this->input->post('branch');
			$city = $this->input->post('city');
			$transaction_id = $this->input->post('transaction_id');
			$remarks = $this->input->post('remarks');

			$agent_no = $data['agent_info']->agent_no;

			if ($this->B2b_Model->add_transaction($agent_id, $agent_no, $transaction_type, $amount, $value_date, $transaction_mode, $bank, $branch, $city, $transaction_id, $remarks)) {
				$data['status'] = 1;
				$email_info = array(
					'agent_no' => $agent_no,
					'trans_type' => $transaction_type,
					'agency_name' => $agent_info->agency_name,
					'email' => $agent_info->agent_email,
					'amount' => $amount,
				);
				$this->Email_Model->admin_transaction_mail($email_info);
			} else {
				$data['errors'] = 'Transaction is not done. Please try after some time...';
			}

			redirect('b2b/view_account_stmt/' . $agent_id, 'refresh');
		}

	}

	// B2B Flight Markup Manager
	public function flight_markup_manager() {
		$data['agent_list'] = $this->B2b_Model->get_active_agent_list();
		$data['api_list'] = $this->Home_Model->get_api_list();
		$data['airlines_list'] = $this->B2b_Model->get_airlines_list();
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['b2b_markup_list'] = $this->B2b_Model->get_flight_markup_list();
		// echo '<pre/>';print_r($data);exit;
		$this->load->view('b2b/flight_markup_manager', $data);

	}

	public function bus_markup_manager() {
		
		$data['agent_list'] = $this->B2b_Model->get_active_agent_list();
		$data['api_list'] = $this->Home_Model->get_api_list();
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['b2b_markup_list'] = $this->B2b_Model->get_bus_markup_b2blist();
		//echo '<pre/>';print_r($data['b2b_markup_list']);exit;
		$this->load->view('b2b/bus_markup_manager', $data);
		/*$data['group_info_b2b'] = $this->Home_Model->get_group_list_b2b('2', '2');		
		$data['b2b_bus_markup_list'] = $this->B2b_Model->get_bus_markup_list();		
		if ($data['b2b_bus_markup_list'] == '') {
			$data['b2b_bus_markup_list'] = $data['group_info_b2b'];
		} else {
			$data['b2b_bus_markup_list'] = $data['b2b_bus_markup_list'];
		}
		$this->load->view('b2b/bus_markup_manager', $data);*/

	}

	public function b2b_save_bus_markup() {
		// echo '<pre>';print_r($_POST);exit;
		if ($_POST['markup_id'][0] == '') {
			for ($i = 0; $i < count($_POST['group_name']); $i++) {
				$data_insert_bus = array(
					'group_id' => $_POST['group_id'][$i],
					'group_name' => $_POST['group_name'][$i],
					'markup_type' => $_POST['markup_type'][$i],
					'markup_value' => $_POST['markup_value'][$i],
				);
				$this->db->insert('b2b_bus_markup', $data_insert_bus);
			}
		} else {
			for ($i = 0; $i < count($_POST['group_name']); $i++) {
				$data_update_bus = array(
					'markup_type' => $_POST['markup_type'][$i],
					'markup_value' => $_POST['markup_value'][$i],
				);
				// echo '<pre>';print_r($data_update_bus);exit;
				$this->db->where('markup_id', $_POST['markup_id'][$i]);
				$this->db->update('b2b_bus_markup', $data_update_bus);
			}
		}
		redirect('b2b/bus_markup_manager', 'refresh');
	}

	public function update_b2b_markups() {
		// echo '<pre/>';print_r($_POST);exit;
		if (isset($_POST) && isset($_POST['service_type'])) {
			$agent = $_POST['agent_no'];
			$service_type = $_POST['service_type'];
			$markup_type = $_POST['markup_type'];
			$api_name = $_POST['api_name'];
			$markup_process = $_POST['markup_process'];
			$markup = $_POST['markup'];
			$country = $_POST['country'];
			if(isset($_POST['hotel'])) { 
			$hotel = $_POST['hotel'];

			}
			else{
				$hotel = "";	
			}
			$airline = NULL;

			$agent_list = $this->B2b_Model->get_active_agent_list();
			$airlines_list = $this->B2b_Model->get_airlines_list();
			$api_list = $this->Home_Model->get_api_list_by_service($service_type);
			//echo '<pre/>';print_r($api_list);exit;
			if ($markup_type == 'generic') {
				if ($api_name == 'all' && $agent == 'all') {
					// echo '1';
					$this->B2b_Model->delete_b2b_markup($markup_type, $service_type);
					//echo $this->db->last_query();exit;
					//for($i=0;$i<count($agent_list);$i++)
					//{
						if($api_list!=""){
					for ($j = 0; $j < count($api_list); $j++) {
						//echo '2';
						$this->B2b_Model->add_b2b_markup($country, 'all', $api_name, $markup_process, $markup, $markup_type, $service_type);
						//echo $this->db->last_query();exit;
					}
				}
					//}
					//	exit;
				} else if ($api_name != 'all' && $agent == 'all') {
					// echo 2;exit;
					$this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
					//for($i=0;$i<count($agent_list);$i++)
					//{
					$this->B2b_Model->add_b2b_markup($country, 'all', $api_name, $markup_process, $markup, $markup_type, $service_type);

					//}
				} else if ($api_name == 'all' && $agent != 'all') {
					// echo 3;exit;
					//echo $markup_type;echo $service_type;echo $agent;echo $api_name;echo $country;

					$this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
					//echo $this->db->last_query();exit;
					for ($i = 0; $i < count($api_list); $i++) {
						$this->B2b_Model->add_b2b_markup($country, $agent, $api_name, $markup_process, $markup, $markup_type, $service_type);

					}
				} else if ($api_name != 'all' && $agent != 'all') {
					// echo 4;exit;
					// echo $service_type;exit;
					$this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
					$this->B2b_Model->add_b2b_markup($country, $agent, $api_name, $markup_process, $markup, $markup_type, $service_type);
				}

			} else if ($markup_type == 'specific') {
				if ($api_name == 'all' && $agent == 'all' && $country == 'all') {
					//$this->B2b_Model->delete_b2b_markup($markup_type,$service_type,$agent,$api_name,$country);
					//echo $this->db->last_query();exit;
					//for($i=0;$i<count($agent_list);$i++)
					//{
					for ($j = 0; $j < count($api_list); $j++) {
						// $this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent_list[$i]->agent_no, $api_list[$j]->api_name, $country);
						$this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
						$this->B2b_Model->add_b2b_markup($country, 'all', $api_name, $markup_process, $markup, $markup_type, $service_type);
					}
					//}

				} else if ($api_name != 'all' && $agent == 'all' && $country == 'all') {

					//for($i=0;$i<count($agent_list);$i++)
					//{
					$this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent_list[$i]->agent_no, $api_name, $country);
					$this->B2b_Model->add_b2b_markup($country, 'all', $api_name, $markup_process, $markup, $markup_type, $service_type);
					//}

				} else if ($api_name == 'all' && $agent != 'all' && $country == 'all') {
					$this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
					for ($i = 0; $i < count($api_list); $i++) {
						$this->B2b_Model->add_b2b_markup($country, $agent, $api_name, $markup_process, $markup, $markup_type, $service_type);

					}
				} else if ($api_name != 'all' && $agent != 'all' && $country == 'all') {
					$this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
					$this->B2b_Model->add_b2b_markup($country, $agent, $api_name, $markup_process, $markup, $markup_type, $service_type);

				}

				if ($api_name == 'all' && $agent == 'all' && $country != 'all') {

					//for($i=0;$i<count($agent_list);$i++)
					//{
					for ($j = 0; $j < count($api_list); $j++) {
						$this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_list[$j]->api_name, $country);
						$this->B2b_Model->add_b2b_markup($country, 'all', $api_name, $markup_process, $markup, $markup_type, $service_type);

					}
					//}

				} else if ($api_name != 'all' && $agent == 'all' && $country != 'all') {

					//for($i=0;$i<count($agent_list);$i++)
					//{
					$this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
					$this->B2b_Model->add_b2b_markup($country, 'all', $api_name, $markup_process, $markup, $markup_type, $service_type);

					//}

				} else if ($api_name == 'all' && $agent != 'all' && $country != 'all') {

					for ($i = 0; $i < count($api_list); $i++) {
						$this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_list[$i]->api_name, $country);
						$this->B2b_Model->add_b2b_markup($country, $agent, $api_name, $markup_process, $markup, $markup_type, $service_type);

					}
				} else if ($api_name != 'all' && $agent != 'all' && $country != 'all') {
					$this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
					$this->B2b_Model->add_b2b_markup($country, $agent, $api_name, $markup_process, $markup, $markup_type, $service_type);

				}

			} elseif ($markup_type == 'specific_hotel') {
				if ($api_name == 'all' && $agent == 'all') {
					//echo '1';
					//$this->B2b_Model->delete_b2b_markup($markup_type,$service_type);
					//echo $this->db->last_query();exit;
					//for($i=0;$i<count($agent_list);$i++)
					//{
					for ($j = 0; $j < count($api_list); $j++) {
						//echo '2';
						$this->B2b_Model->delete_b2b_markup_new_hotel($markup_type, $service_type, $agent, $api_list[$j]->api_name, $country, $hotel);
						$this->B2b_Model->add_b2b_markup_hotel($hotel, $country, 'all', $api_name, $markup_process, $markup, $markup_type, $service_type);
						//echo $this->db->last_query();exit;
					}
					//}
					//	exit;
				} else if ($api_name != 'all' && $agent == 'all') {
					//echo 123;

					//for($i=0;$i<count($agent_list);$i++)
					//{
					$this->B2b_Model->delete_b2b_markup_new_hotel($markup_type, $service_type, $agent, $api_name, $country, $hotel);
					$this->B2b_Model->add_b2b_markup_hotel($hotel, $country, 'all', $api_name, $markup_process, $markup, $markup_type, $service_type);

					//}
				} else if ($api_name == 'all' && $agent != 'all') {
					//echo $markup_type;echo $service_type;echo $agent;echo $api_name;echo $country;

					//echo $this->db->last_query();exit;
					for ($i = 0; $i < count($api_list); $i++) {
						$this->B2b_Model->delete_b2b_markup_new_hotel($markup_type, $service_type, $agent, $api_list[$i]->api_name, $country, $hotel);
						$this->B2b_Model->add_b2b_markup_hotel($hotel, $country, $agent, $api_name, $markup_process, $markup, $markup_type, $service_type);

					}
				} else if ($api_name != 'all' && $agent != 'all') {
					// echo $api_name;exit;
					$this->B2b_Model->delete_b2b_markup_new_hotel($markup_type, $service_type, $agent, $api_name, $country, $hotel);
					$this->B2b_Model->add_b2b_markup_hotel($hotel, $country, $agent, $api_name, $markup_process, $markup, $markup_type, $service_type);
				}

			}
			//echo '1';
			$this->session->set_flashdata('message', $data['message']);
			if($service_type == 3){
					redirect('b2b/bus_markup_manager');
				}elseif ($service_type == 4) {
					redirect('b2b/car_markup_manager');
				}elseif ($service_type == 5) {
					redirect('b2b/transfer_markup_manager');
				}
				elseif ($service_type == 2) {
					redirect('b2b/flight_markup_manager');
				}elseif ($service_type == 1) {
					redirect('b2b/hotel_markup_manager');
				}elseif ($service_type == 7) {
					redirect('b2b/activity_markup_manager');
				}elseif ($service_type == 8) {
					redirect('b2b/holiday_markup_manager');
				}

		} else {
			//echo '2';
			$this->session->set_flashdata('message', $data['message']);
			if($service_type == 3){
					redirect('b2b/bus_markup_manager');
				}elseif ($service_type == 4) {
					redirect('b2b/car_markup_manager');
				}elseif ($service_type == 5) {
					redirect('b2b/transfer_markup_manager');
				}elseif ($service_type == 2) {
					redirect('b2b/flight_markup_manager');
				}elseif ($service_type == 1) {
					redirect('b2b/hotel_markup_manager');
				}elseif ($service_type == 7) {
					redirect('b2b/activity_markup_manager');
				}elseif ($service_type == 8) {
					redirect('b2b/holiday_markup_manager');
				}
		}
	}

	public function update_discount() {
		// echo '<pre>';print_r($_POST);exit;
		if (isset($_POST)) {

			$basefare = 0;
			$yqfare = 0;
			$origin = '';
			$destination = '';
			$discount = $_POST['discount'];
			$airline = $_POST['airline'];

			if (isset($_POST['basefare']) && $_POST['basefare'] != '') {
				$basefare = $_POST['basefare'];
			}
			if (isset($_POST['yqfare']) && $_POST['yqfare'] != '') {
				$yqfare = $_POST['yqfare'];
			}

			if (isset($_POST['origin'])) {
				$origin = $_POST['origin'];
			}
			if (isset($_POST['destination'])) {
				$destination = $_POST['destination'];
			}

			if ($origin == 'all' && $destination == 'all') {
				$this->B2b_Model->delete_old_discount($airline);
			} elseif ($origin != 'all' && $destination != 'all') {
				$this->B2b_Model->delete_old_discount($airline, $origin, $destination);
			}

			$insert = false;
			if ($origin == 'all' && $destination == 'all') {
				$insert = true;
			} elseif ($origin != 'all' && $destination != 'all') {
				$insert = true;
			}

			if ($insert) {
				$data = array(
					'airline' => $airline,
					'discount' => $discount,
					'basefare' => $basefare,
					'yqfare' => $yqfare,
					'origin' => $origin,
					'destination' => $destination,
					'status' => 1,
				);
//echo '<pre>';print_r($data);exit;
				$this->B2b_Model->insert_discount($data);
			}
		} else {
			echo '1';
		}
	}

	public function datefilter($type) {
		if ($type = "hotels") {
			//print_r($_POST);exit;
			$agentid = $this->input->post('agentid');
			$from = $this->input->post('fromhoteldate');
			$to = $this->input->post('tohoteldate');
			$data['hotel_booking_summary'] = $this->B2b_Model->get_hotels_bydate($agentid, $from, $to);
			$this->load->view('b2b/b2b_reports_manager');
		}
	}
	public function manage_b2b_markup_status() {
		if (isset($_POST['markup_id']) && isset($_POST['status'])) {
			$markup_id = $_POST['markup_id'];
			$status = $_POST['status'];
			if ($status != '2') {
				$update = $this->B2b_Model->manage_b2b_markup_status($markup_id, $status);
			} else {
				$update = $this->B2b_Model->delete_b2b_markup_status($markup_id);
			}
			echo $update;
		} else {
			return false;
		}

	}
	public function b2b_bus_markup_status($id,$status) {
		
			if ($status != '2') {
				$update = $this->B2b_Model->manage_b2b_markup_status($id,$status);

			} else {
				$update = $this->B2b_Model->delete_b2b_markup_status($id);
			}
				redirect('b2b/bus_markup_manager', 'refresh'); 
	}
	public function b2b_transfer_markup_status($id,$status) {
		
			if ($status != '2') {
				$update = $this->B2b_Model->manage_b2b_markup_status($id,$status);

			} else {
				$update = $this->B2b_Model->delete_b2b_markup_status($id);
			}
				redirect('b2b/transfer_markup_manager', 'refresh'); 
	}


	public function b2b_reports_manager() {
		$data['flight_booking_summary'] = $this->B2b_Model->get_b2b_flight_booking_summary();
		
		$data['hotel_booking_summary'] = $this->B2b_Model->get_b2b_hotel_booking_summary();
		//print_r($data['hotel_booking_summary']);exit;
			$data['car_booking_summary'] = $this->B2b_Model->get_b2b_car_booking_summary();
		list($data['bus_booking_summary'], $query) = $this->B2b_Model->get_b2b_bus_booking_summary();
		$data['holiday_query_summary'] = $this->B2b_Model->get_holi_query_reports();
		//echo '<pre/>';print_r($data);exit;
		$this->load->view('b2b/b2b_reports_manager', $data);
	}
	public function car_markup_manager()
	{
		$data['agent_list'] = $this->B2b_Model->get_active_agent_list();
		$data['api_list'] = $this->Home_Model->get_api_list();
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['b2b_markup_list'] = $this->B2b_Model->get_car_markup_list();
		//echo '<pre/>';print_r($data);exit;
		$this->load->view('b2b/car_markup_manager', $data);

	}
	public function transfer_markup_manager()
	{
		$data['agent_list'] = $this->B2b_Model->get_active_agent_list();
		$data['api_list'] = $this->Home_Model->get_api_list();
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['b2b_markup_list'] = $this->B2b_Model->get_transfer_markup_list();
		//echo '<pre/>';print_r($data);exit;
		$this->load->view('b2b/transfer_markup_manager', $data);

	}

	public function b2b_reports_manager_flights($download_excel = '') {
		// echo'<pre>';print_r($_GET);exit;
		$data['agentid'] = $agent_id = isset($_GET['agentid']) ? $_GET['agentid'] : '';
		$data['status'] = $status = isset($_GET['status']) ? $_GET['status'] : '';
		$data['fromdate'] = $fromdate = isset($_GET['fromdate']) ? $_GET['fromdate'] : '';
		$data['todate'] = $todate = isset($_GET['todate']) ? $_GET['todate'] : '';
		$data['bookingdate'] = $bookingdate = isset($_GET['bookingdate']) ? $_GET['bookingdate'] : '';
		// $data['arrivaldate']=$arrivaldate=isset($_GET['arrivaldate']) ? $_GET['arrivaldate'] : '';
		$data['uniquerefno'] = $uniquerefno = isset($_GET['uniquerefno']) ? $_GET['uniquerefno'] : '';
		$data['pnr'] = $pnr = isset($_GET['pnr']) ? $_GET['pnr'] : '';
		$data['first_name'] = $first_name = isset($_GET['first_name']) ? $_GET['first_name'] : '';
		$data['airlines_list'] = $this->B2c_Model->get_airlines_list();
		$data['agent_list'] = $this->B2b_Model->get_agent_list();
		$id = '2';
		list($data['flight_booking_summary'], $result) = $this->B2b_Model->get_b2b_flight_booking_summary($agent_id, $status, $fromdate, $todate, $bookingdate, $uniquerefno, $pnr, $first_name);
		// echo $this->db->last_query();
		// echo '<pre/>';print_r($data['flight_booking_summary']);exit;

		if($data['flight_booking_summary']!=""){
		    if(isset($data['flight_booking_summary'][0]->uniquerefno)) { 
		$uniqueRef = $data['flight_booking_summary'][0]->uniquerefno;
		    }

		}
		else{
			$uniqueRef = "";	
		}

		//$data['flight_booking_summary_r'] = $this->B2b_Model->get_b2b_flight_booking_summary_r($uniqueRef);

		// echo $this->db->last_query();
		// echo '<pre/>'; print_r($data['flight_booking_summary']);exit;
		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale'] = $id;
		// echo '<pre/>'; print_r($data['flight_booking_summary']);exit;
		if ($download_excel != '') {
			$this->Home_Model->dd_ex($result);
		}

		$this->load->view('b2b/b2b_reports_manager', $data);
	}

	public function admin_reports_manager_flights($download_excel = '') {
		//echo '<pre>';print_r($_REQUEST);//exit;
		$data['agentid'] = $agent_id = isset($_GET['agentid']) ? $_GET['agentid'] : '';
		$data['status'] = $status = isset($_GET['status']) ? $_GET['status'] : '';
		$data['fromdate'] = $fromdate = isset($_GET['fromdate']) ? $_GET['fromdate'] : '';
		$data['todate'] = $todate = isset($_GET['todate']) ? $_GET['todate'] : '';
		$data['bookingdate'] = $bookingdate = isset($_GET['bookingdate']) ? $_GET['bookingdate'] : '';
		// $data['arrivaldate']=$arrivaldate=isset($_GET['arrivaldate']) ? $_GET['arrivaldate'] : '';
		$data['uniquerefno'] = $uniquerefno = isset($_GET['uniquerefno']) ? $_GET['uniquerefno'] : '';
		$data['pnr'] = $pnr = isset($_GET['pnr']) ? $_GET['pnr'] : '';
		$data['first_name'] = $first_name = isset($_GET['first_name']) ? $_GET['first_name'] : '';
		$data['airlines_list'] = $this->B2c_Model->get_airlines_list();
		$data['agent_list'] = $this->B2b_Model->get_agent_list();
		$id = '2';
		list($data['flight_booking_summary'], $result) = $this->B2b_Model->get_b2b_flight_booking_summary($agent_id, $status, $fromdate, $todate, $bookingdate, $uniquerefno, $pnr, $first_name);

		$uniqueRef = $data['flight_booking_summary'][0]->uniquerefno;
		$data['flight_booking_summary_r'] = $this->B2b_Model->get_b2b_flight_booking_summary_r($uniqueRef);
		//echo $this->db->last_query(); echo '<pre/>'; print_r($data['flight_booking_summary']);exit;
		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale'] = $id;

		$this->load->view('b2b/admin_reports_manager', $data);
	}

	// public function b2b_reports_manager_bus($download_excel = '') {
	// 	echo'<pre>';print_r($_GET);exit;
	// 	$data['agentid'] = $agent_id = isset($_GET['agentid']) ? $_GET['agentid'] : '';
	// 	$data['Booking_Status'] = $Booking_Status = isset($_GET['Booking_Status']) ? $_GET['Booking_Status'] : '';
	// 	$data['from_date'] = $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
	// 	$data['to_date'] = $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
	// 	$data['booking_date'] = $booking_date = isset($_GET['booking_date']) ? $_GET['booking_date'] : '';
	// 	$data['uniqueRefNo'] = $uniqueRefNo = isset($_GET['uniqueRefNo']) ? $_GET['uniqueRefNo'] : '';
	// 	$data['booking_reference_no1'] = $booking_reference_no1 = isset($_GET['booking_reference_no1']) ? $_GET['booking_reference_no1'] : '';
	// 	$data['pass_name'] = $pass_name = isset($_GET['pass_name']) ? $_GET['pass_name'] : '';
	// 	$id = '3';
	// 	$data['api_list'] = $this->B2c_Model->get_api_list();
	// 	$data['agent_list'] = $this->B2b_Model->get_agent_list();
	// 	$data['vale'] = $id;
	// 	list($data['bus_booking_summary'], $result) = $this->B2b_Model->get_b2b_bus_booking_summary($agent_id, $Booking_Status, $from_date, $to_date, $booking_date, $uniqueRefNo, $booking_reference_no1, $pass_name);
	// 	// echo '<pre/>'; print_r($data['bus_booking_summary']);exit;
	// 	//	if($download_excel!=''){
	// 	//$this->Home_Model->dd_ex($result);
	// 	//}
	// 	$this->load->view('b2b/b2b_reports_manager', $data);

	// }

	public function admin_reports_manager_bus($download_excel = '') {
		//echo 'fd';
		$data['agentid'] = $agent_id = isset($_GET['agentid']) ? $_GET['agentid'] : '';
		$data['Booking_Status'] = $Booking_Status = isset($_GET['Booking_Status']) ? $_GET['Booking_Status'] : '';
		$data['Booking_Status1'] = $Booking_Status1 = isset($_GET['Booking_Status1']) ? $_GET['Booking_Status1'] : '';
		$data['from_date'] = $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$data['to_date'] = $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$data['booking_date'] = $booking_date = isset($_GET['booking_date']) ? $_GET['booking_date'] : '';
		$data['uniqueRefNo'] = $uniqueRefNo = isset($_GET['uniqueRefNo']) ? $_GET['uniqueRefNo'] : '';
		$data['booking_reference_no1'] = $booking_reference_no1 = isset($_GET['booking_reference_no1']) ? $_GET['booking_reference_no1'] : '';
		$data['pass_name'] = $pass_name = isset($_GET['pass_name']) ? $_GET['pass_name'] : '';
		$id = '3';
		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['agent_list'] = $this->B2b_Model->get_agent_list();
		$data['vale'] = $id;
		list($data['bus_booking_summary'], $result) = $this->B2b_Model->get_b2b_bus_booking_summary($agent_id, $Booking_Status, $from_date, $to_date, $booking_date, $uniqueRefNo, $booking_reference_no1, $pass_name, $Booking_Status1);
		//print_r($data['bus_booking_summary']);exit;
		//	if($download_excel!=''){
		//$this->Home_Model->dd_ex($result);
		//}
		$this->load->view('b2b/admin_reports_manager_bus', $data);

	}

	public function deposit_approve($acc_id, $agent_no) {
		$available = '0';
		$deposite = '0';
		$status = 'Accepted';
		$data['agentno'] = $agent_no;
		$data['depositno'] = $acc_id;
		$balance = $this->B2b_Model->get_agent_available_balance($agent_no);
		$deposite = $this->B2b_Model->get_approved_amount($acc_id);
		$balance = empty($balance) ? 0 : $balance;
		//$available = $this->Home_Model->get_available_balance($agentno);
		$data['deposit'] = $deposite->deposit_amount;
		$data['transact_id'] = $deposite->transaction_id;
		$data['bank'] = $deposite->bank;
		$data['branch'] = $deposite->branch;
		$data['city'] = $deposite->city;

		$data['available_balance'] = $balance;
		$this->load->view('b2b/approve_page', $data);
	}
	public function deposit_decline($acc_id, $agent_no) {
		$deposit = $this->B2b_Model->agent_decline_deposit($acc_id, $agent_no);
		$agent_info = $this->B2b_Model->get_agency_name($agent_no);
		$this->Email_Model->deposit_decline_mail($agent_no, $agent_info->agency_name, $agent_info->agent_email);
		$data['available_balance'] = $deposit;
		redirect('b2b/view_account_stmt', 'refresh');
	}
	/*function approve_amount() {
		//echo '<pre>'; print(; exit;
		if (isset($_POST['agent_no'])) {
			$agent_no = $_POST['agent_no'];
			$available_balance = empty($_POST['available_balance']) ? 0 : $_POST['available_balance'];
			$dep_amt = $_POST['dep_amt'];
			$depositno = $_POST['depositno'];
			$total = $available_balance + $dep_amt;

			//$get_sum_of_credits = $this->B2b_Model->get_sum_of_credits($agent_no);

			$update = $this->B2b_Model->update_deposit_status($dep_amt, $depositno, $total);
			$agent_info = $this->B2b_Model->get_agency_name($agent_no);
			//$get_sum_of_deposits = $this->B2b_Model->get_sum_of_deposits($agent_no);
			//$deposit_amount = $get_sum_of_deposits;
			$this->Email_Model->deposit_approve_mail($agent_no, $total, $dep_amt, $agent_info->agency_name, $agent_info->agent_email);
			//$update1 = $this->B2b_Model->update_deposit_request($agent_no, $total, $deposit_amount);
			redirect('b2b/view_account_stmt', 'refresh');
		} else {
			echo 'Permission Denied';
		}
	}*/


	 function approve_amount() {
       // echo '<pre>'; print_r($_POST); exit;
        $agent_no = $_POST['agent_no'];
        $available_balance = empty($_POST['available_balance']) ? 0 : $_POST['available_balance'];
        $dep_amt = $_POST['dep_amt'];
        $depositno = $_POST['depositno'];
        $total = $available_balance + $dep_amt;

        //$get_sum_of_credits = $this->B2b_Model->get_sum_of_credits($agent_no);

        $update = $this->B2b_Model->update_deposit_status($dep_amt, $depositno, $total);
$agent_info = $this->B2b_Model->get_agency_name($agent_no);

        //$get_sum_of_deposits = $this->B2b_Model->get_sum_of_deposits($agent_no);
        //$deposit_amount = $get_sum_of_deposits;
	 /*$this->Email_Model->deposit_approve_mail($agent_no, $total, $dep_amt, $agent_info->agency_name, $agent_info->agent_email);*/
        //$update1 = $this->B2b_Model->update_deposit_request($agent_no, $total, $deposit_amount);
        redirect('b2b/view_account_stmt', 'refresh');
    }

	function credit_amt() {
		$mini_value = $data['mini'] = $this->B2b_Model->get_thr_value();
		//print_r($mini_value->amount);exit;
		$agt_mini_value = $this->B2b_Model->get_agent_mini_value($mini_value->amount);
		//echo '<pre>';print_r($agt_mini_value);exit;
		$this->load->view('b2b/credit_value', $data);
	}

	function credit_value() {
		//print_r();
		$amt = $this->input->post('credit_value');
		//print_r($this->input->post('credit_value'));exit;
		$this->B2b_Model->insert_mini_amount($amt);
		redirect('b2b/credit_amt', 'refresh');

	}
	public function b2b_reports_manager_holiday($download_excel=''){


	$data['agentid']=$agent_id=isset($_GET['agentid']) ? $_GET['agentid'] : '';
	$data['from_date']=$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
	$data['to_date']=$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
	$id='4';
	$data['api_list'] = $this->B2c_Model->get_api_list();
	$data['vale']=$id;
	list($data['holiday_query_summary'],$result) = $this->B2b_Model->get_holi_query_reports($agent_id,$from_date,$to_date);

	if($download_excel!=''){
	$this->Home_Model->dd_ex($result);
	}
	 $this->load->view('b2b/b2b_reports_manager', $data);
	}

	public function b2b_reports_manager_bus($download_excel=''){
	//echo 'fd';
	$data['agentid']=$agent_id=isset($_GET['agentid']) ? $_GET['agentid'] : '';
	$data['from_date']=$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
	$data['to_date']=$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
	$id='3';
	$data['api_list'] = $this->B2c_Model->get_api_list();
	$data['vale']=$id;
	list($data['bus_booking_summary'],$result) = $this->B2b_Model->get_b2b_bus_booking_summary($agent_id,$from_date,$to_date);
	//print_r($data['bus_booking_summary']);exit;
//	if($download_excel!=''){
	//$this->Home_Model->dd_ex($result);
	//}
	 $this->load->view('b2b/b2b_reports_manager', $data);

	}
	public function b2b_reports_manager_hotel($download_excel=''){
	//echo '<pre>';print_r($this->session->all_userdata());
		// echo '<pre>';print_r($_GET);exit;
	$data['agentid']=$agent_id=isset($_GET['agentid']) ? $_GET['agentid'] : '';
	$data['from_date']=$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
	$data['to_date']=$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
	$id='1';
	//$data['api_list'] = $this->B2c_Model->get_api_list();
	$data['vale']=$id;
	list($data['hotel_booking_summary'],$result) = $this->B2b_Model->get_b2b_hotel_booking_summary($agent_id,$from_date,$to_date);
	//echo '<pre>';print_r($data['hotel_booking_summary'][0]);exit;
	if($download_excel!=''){
	$this->Home_Model->dd_ex($result);
	}
	//echo '<pre>';print_r($data);
	 $this->load->view('b2b/b2b_reports_manager', $data);
	}
	public function b2b_reports_manager_car($download_excel=''){
	// echo '<pre>';print_r($_GET);exit;
		$data['agentid']=$agent_id=isset($_GET['agentid']) ? $_GET['agentid'] : '';
		$data['from_date']=$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$data['to_date']=$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$id='7';
		//$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale']=$id;
		list($data['car_booking_summary'],$result) = $this->B2b_Model->get_b2b_car_booking_summary($agent_id,$from_date,$to_date);
		// echo $this->db->last_query();exit;
		// echo '<pre>';print_r($data['car_booking_summary']);exit;
		if($download_excel!=''){
		$this->Home_Model->dd_ex($result);
		}

		 $this->load->view('b2b/b2b_reports_manager', $data);
	}
	public function b2b_reports_manager_transfer($download_excel=''){
		// echo '<pre>';print_r($_GET);exit;
		$data['agentid']=$agent_id=isset($_GET['agentid']) ? $_GET['agentid'] : '';
		$data['from_date']=$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$data['to_date']=$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$id='8';
		//$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale']=$id;
		list($data['transfer_booking_summary'],$result) = $this->B2b_Model->get_b2b_transfer_booking_summary($agent_id,$from_date,$to_date);
		// echo $this->db->last_query();
		// echo '<pre>13';print_r($data['transfer_booking_summary']);exit;
		if($download_excel!=''){
		$this->Home_Model->dd_ex($result);
		}

		 $this->load->view('b2b/b2b_reports_manager', $data);
	}
	public function b2b_reports_manager_activity($download_excel=''){
		// echo '<pre>';print_r($_GET);exit;
		$data['agentid']=$agent_id=isset($_GET['agentid']) ? $_GET['agentid'] : '';
		$data['from_date']=$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$data['to_date']=$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$id='9';
		//$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale']=$id;
		list($data['activity_booking_summary'],$result) = $this->B2b_Model->get_b2b_activity_booking_summary($agent_id,$from_date,$to_date);
		// echo $this->db->last_query();exit;
		// echo '<pre>';print_r($data['car_booking_summary']);exit;
		if($download_excel!=''){
		$this->Home_Model->dd_ex($result);
		}

		 $this->load->view('b2b/b2b_reports_manager', $data);
	}

	//cancellation report
	public function b2b_reports_manager_hotel_cancel($download_excel = '') {
		$data['agentid'] = $agent_id = isset($_GET['agentid']) ? $_GET['agentid'] : '';
		$data['from_date'] = $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$data['to_date'] = $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$id = '1';
		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale'] = $id;

		list($data['hotel_booking_summary'], $result) = $this->B2b_Model->get_b2b_hotel_booking_summary($agent_id, $from_date, $to_date);

		if ($download_excel != '') {
			$this->Home_Model->dd_ex($result);
		}
		$this->load->view('b2b/booking_cancel_report', $data);
	}
	public function b2b_reports_manager_flights_cancel($download_excel = '') {
		// echo'<pre>';print_r($_GET);exit;
		$data['status'] = $status = isset($_GET['Status']) ? $_GET['Status'] : '';
		$data['bookingdate'] = $bookingdate = isset($_GET['bookingdate']) ? $_GET['bookingdate'] : '';
		$data['bookingdate'] = $bookingdate = isset($_GET['bookingdate']) ? $_GET['bookingdate'] : '';
		$data['departuredate'] = $departuredate = isset($_GET['departuredate']) ? $_GET['departuredate'] : '';
		// $data['arrivaldate']=$arrivaldate=isset($_GET['arrivaldate']) ? $_GET['arrivaldate'] : '';
		$data['uniquerefno'] = $uniquerefno = isset($_GET['uniquerefno']) ? $_GET['uniquerefno'] : '';
		$data['pnr'] = $pnr = isset($_GET['pnr']) ? $_GET['pnr'] : '';
		$data['first_name'] = $first_name = isset($_GET['first_name']) ? $_GET['first_name'] : '';
		$data['airlines_list'] = $this->B2c_Model->get_airlines_list();
		$data['vale'] = $id;

		list($data['flight_booking_summary'], $result) = $this->B2b_Model->get_b2b_flight_booking_summary($status, $bookingdate, $bookingdate, $departuredate, $uniquerefno, $pnr, $first_name);

		if ($download_excel != '') {
			$this->Home_Model->dd_ex($result);
		}

		$this->load->view('b2b/booking_cancel_report', $data);
	}

	public function b2b_reports_manager_holiday_cancel($download_excel = '') {

		$data['agentid'] = $agent_id = isset($_GET['agentid']) ? $_GET['agentid'] : '';
		$data['from_date'] = $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$data['to_date'] = $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$id = '4';
		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale'] = $id;
		list($data['holiday_query_summary'], $result) = $this->B2b_Model->get_holi_query_reports($agent_id, $from_date, $to_date);

		if ($download_excel != '') {
			$this->Home_Model->dd_ex($result);
		}
		$this->load->view('b2b/booking_cancel_report', $data);
	}

	public function b2b_reports_manager_bus_cancel($download_excel = '') {

		$data['agentid'] = $agent_id = isset($_GET['agentid']) ? $_GET['agentid'] : '';
		$data['from_date'] = $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$data['to_date'] = $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$id = '3';
		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale'] = $id;
		list($data['bus_booking_summary'], $result) = $this->B2b_Model->get_b2b_bus_booking_summary($agent_id, $from_date, $to_date);

		if ($download_excel != '') {
			$this->Home_Model->dd_ex($result);
		}
		$this->load->view('b2b/booking_cancel_report', $data);

	}

	public function bus_eticket($sysRefNo, $busRefNo = '') {

		$data['booking_details'] = $this->B2b_Model->get_booking_details($busRefNo, $sysRefNo);
		$data['pass_details'] = $this->B2b_Model->get_booking_pass_details($busRefNo, $sysRefNo);
		//echo '<pre/>';print_r($data);exit;
		$this->load->view('b2b/bus_admin_voch', $data);

	}
	public function bus_eticket1($sysRefNo, $busRefNo = '') {

		$data['booking_details'] = $this->B2b_Model->get_booking_details($busRefNo, $sysRefNo);
		$data['pass_details'] = $this->B2b_Model->get_booking_pass_details($busRefNo, $sysRefNo);
		//echo '<pre/>';print_r($data);exit;
		$this->load->view('b2b/bus_admin_voch', $data);

	}

	public function bus_eticket_invoice($sysRefNo, $busRefNo = '') {

		$data['booking_details'] = $this->B2b_Model->get_booking_details($busRefNo, $sysRefNo);
		$data['pass_details'] = $this->B2b_Model->get_booking_pass_details($busRefNo, $sysRefNo);
		//echo '<pre/>';print_r($data);exit;
		$this->load->view('b2b/bus_invoicer', $data);

	}

	public function bus_eticket_cancel($sysRefNo, $busRefNo = '') {

		$data['booking_details'] = $this->B2b_Model->get_booking_details($busRefNo, $sysRefNo);
		$data['pass_details'] = $this->B2b_Model->get_booking_pass_details($busRefNo, $sysRefNo);
		//echo '<pre/>';print_r($data);exit;
		$this->load->view('b2b/bus_can_voch', $data);

	}

	function flight_eticket($flyNStayRefNo, $bookingRefId = '', $returnbBookingRefId = '') {
		//echo '123';
		$SequenceNumber = 1;
		$data['booking_info'] = '';
		$data['booking_info'] = $booking_info = $this->B2b_Model->get_flight_booking_info($flyNStayRefNo, $SequenceNumber);
		// print_r($data['booking_info']);exit;
		$data['passenger_info'] = $passenger_info = $this->B2b_Model->get_passengers_info($flyNStayRefNo);

		if (!empty($booking_info)) {
			$data['booking_info_return'] = '';
			if ($booking_info->Trip_Type == 'R') {
				$SequenceNumber = 2;
				$data['booking_info_return'] = $booking_info_return = $this->B2b_Model->get_flight_booking_info($flyNStayRefNo, $SequenceNumber);

				$passenger_info_return = $this->B2b_Model->get_passengers_info($flyNStayRefNo);
				$data['passenger_info_return'] = $passenger_info_return;
			}

			//echo '<pre/>';print_r($data);exit;
			$this->load->view('b2b/flight_eticket_voch', $data);
		} else {
			echo 'Permission Denied';
		}
	}

	function flight_eticket_invoice($flyNStayRefNo, $bookingRefId = '', $returnbBookingRefId = '') {
		//echo '123';
		$SequenceNumber = 1;
		$data['booking_info'] = '';
		$data['booking_info'] = $booking_info = $this->B2b_Model->get_flight_booking_info($flyNStayRefNo, $SequenceNumber);
		// print_r($data['booking_info']);exit;
		$data['passenger_info'] = $passenger_info = $this->B2b_Model->get_passengers_info($flyNStayRefNo);

		if (!empty($booking_info)) {
			$data['booking_info_return'] = '';
			if ($booking_info->Trip_Type == 'R') {
				$SequenceNumber = 2;
				$data['booking_info_return'] = $booking_info_return = $this->B2b_Model->get_flight_booking_info($flyNStayRefNo, $SequenceNumber);

				$passenger_info_return = $this->B2b_Model->get_passengers_info($flyNStayRefNo);
				$data['passenger_info_return'] = $passenger_info_return;
			}

			//echo '<pre/>';print_r($data);exit;
			$this->load->view('b2b/flight_invoicer', $data);
		} else {
			echo 'Permission Denied';
		}
	}
	function agent_flight_invoice($flyNStayRefNo, $bookingRefId = '', $returnbBookingRefId = '') {
		//echo '123';
		$SequenceNumber = 1;
		$data['booking_info'] = '';
		$data['booking_info'] = $booking_info = $this->B2b_Model->get_flight_booking_info($flyNStayRefNo, $SequenceNumber);
		//echo '<pre>';print_r($data['booking_info']);exit;
		$data['agent_info'] = $this->B2b_Model->get_hotel_booking_agent_info($data['booking_info'][0]->agent_id);
		//echo $this->db->last_query();
		// print_r($data['agent_info']);exit;
		$data['passenger_info'] = $passenger_info = $this->B2b_Model->get_passengers_info($flyNStayRefNo);

		if (!empty($booking_info)) {
			$data['booking_info_return'] = '';
			if ($booking_info->Trip_Type == 'R') {
				$SequenceNumber = 2;
				$data['booking_info_return'] = $booking_info_return = $this->B2b_Model->get_flight_booking_info($flyNStayRefNo, $SequenceNumber);

				$passenger_info_return = $this->B2b_Model->get_passengers_info($flyNStayRefNo);
				$data['passenger_info_return'] = $passenger_info_return;
			}

			//echo '<pre/>';print_r($data);exit;
			$this->load->view('b2b/agent_flight_invoicer', $data);
		} else {
			echo 'Permission Denied';
		}
	}

	public function view_flights_page() {

		$data['holiday_query_summary'] = $this->B2B_Model->get_flight_pac_req();
//print_r($data['holiday_query_summary']);exit;
		//$data['id']='1';
		$this->load->view('home/view_enquiry_details', $data);
	}

	public function b2b_incentive_manager() {

		$data['agent_list'] = $this->B2b_Model->get_active_agent_list();

		$data['b2b_markup_list'] = $this->B2b_Model->get_discount_markup_list();
		//echo '<pre/>';print_r($data);exit;
		$this->load->view('b2b/incentive_markup_manager', $data);
	}
	public function update_incentive_markups() {

		// echo '<pre/>';print_r($_POST);exit;
		if (isset($_POST) && isset($_POST['service_type'])) {
			$agent = $_POST['agent_no'];
			$service_type = $_POST['service_type'];
			$markup_type = $_POST['markup_type'];
			//	$api_name = $_POST['api_name'];
			$markup_process = $_POST['process'];
			$markup = $_POST['markup'];
			//	$country = $_POST['country'];

			$agent_list = $this->B2b_Model->get_active_agent_list();
			//	$api_list = $this->Home_Model->get_api_list_by_service($service_type);
			//echo '<pre/>';print_r($api_list);exit;
			if ($markup_type == 'generic') {
				if ($agent == 'all') {
					echo '1';
					$this->B2b_Model->delete_discount_markup($markup_type, $service_type);
					//echo $this->db->last_query();exit;
					for ($i = 0; $i < count($agent_list); $i++) {
						//	for($j=0;$j<count($api_list);$j++)
						//{   //echo '2';
						$this->B2b_Model->add_discount_markup($agent_list[$i]->agent_no, $markup_process, $markup, $markup_type, $service_type);
						//echo $this->db->last_query();exit;
						//	}
					}
					exit;
				} else if ($agent != 'all') {
					//echo 'NT';	exit;
					// echo $api_name;exit;
					$this->B2b_Model->delete_b2b_discount_new($markup_type, $service_type, $agent, $api_name, $country);
					$this->B2b_Model->add_discount_markup($agent, $markup_process, $markup, $markup_type, $service_type);
				}

			}

		} else {
			echo '1';
		}

	}
	public function manage_discount_status($id, $status = "") {
		if ($status == 1 || $status == 0) {
			$this->B2b_Model->update_discount_status($id, $status);
		} elseif ($status == 2) {
			$this->B2b_Model->delete_discount($id);
		}
		redirect('b2b/flight_discount_manager', 'refresh');
	}

	public function update_flight_ticket() {

		$data = array(
			'Ticket_Number' => $this->input->post('ticket_no'),
			'report_id' => $this->input->post('report_id'),
		);
		$this->db->where('report_id', $this->input->post('report_id'));
		$this->db->update('flight_booking_reports', $data);
		redirect('b2b/b2b_reports_manager_flights', 'refresh');
	}

	public function document_upload_idproof($agent_email) {
		$agent_email = $this->input->post('agent_email');
		$config['upload_path'] = '../public/upload_files/b2b/images/' . $agent_email . '/idproof/';
		$config['allowed_types'] = 'pdf|jpg|png|jpeg';
		$config['overwrite'] = TRUE;
		$config['max_size'] = '0';
		$config['max_width'] = '0';
		$config['max_height'] = '0';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0755, TRUE);
		}

		if (!$this->upload->do_upload('agency_id_proof')) {
			$error = $this->upload->display_errors();
			$data['errors'] = $error;
			// echo '<pre/>';print_r($error);exit;
			$this->load->view('b2b/create_agent', $data);

		} else {

			$data = array('upload_data' => $this->upload->data());

			// echo '<pre/>';print_r($data);exit;

			$document_path = 'public/upload_files/b2b/images/' . $agent_email . '/idproof/' . $data['upload_data']['file_name'];
			return $document_path;
			// echo '<pre/>';print_r($document_path);exit;

		}

	}

	public function document_upload_address($agent_email) {
		$agent_email = $this->input->post('agent_email');
		$config['upload_path'] = '../public/upload_files/b2b/images/' . $agent_email . '/addressproof/';
		$config['allowed_types'] = 'pdf|jpg|png|jpeg';
		$config['overwrite'] = TRUE;
		$config['max_size'] = '0';
		$config['max_width'] = '0';
		$config['max_height'] = '0';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0755, TRUE);
		}

		if (!$this->upload->do_upload('agency_address_proof')) {
			$error = $this->upload->display_errors();
			$data['errors'] = $error;

			$this->load->view('b2b/create_agent', $data);

		} else {

			$data = array('upload_data' => $this->upload->data());

			// echo '<pre/>';print_r($data);exit;

			$document_address_path = 'public/upload_files/b2b/images/' . $agent_email . '/addressproof/' . $data['upload_data']['file_name'];
			// echo '<pre/>';print_r($config['upload_path']);exit;
			return $document_address_path;

		}

	}

	public function gst_document_upload($agent_email) {
		$agent_email = $this->input->post('agent_email');
		$config['upload_path'] = '../public/upload_files/b2b/images/' . $agent_email . '/gstdocuments/';
		$config['allowed_types'] = 'pdf|jpg|png|jpeg';
		$config['overwrite'] = TRUE;
		$config['max_size'] = '0';
		$config['max_width'] = '0';
		$config['max_height'] = '0';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0755, TRUE);
		}

		if (!$this->upload->do_upload('gst_upload')) {
			$error = $this->upload->display_errors();
			$data['errors'] = $error;

			$this->load->view('b2b/create_agent', $data);

		} else {

			$data = array('upload_data' => $this->upload->data());

			// echo '<pre/>';print_r($data);exit;

			$gst_upload_path = 'public/upload_files/b2b/images/' . $agent_email . '/gstdocuments/' . $data['upload_data']['file_name'];
			return $gst_upload_path;
			// echo '<pre/>';print_r($document_path);exit;

		}

	}

	public function agent_logo_upload($agent_email) {

		$agent_email = $this->input->post('agent_email');
		$config['upload_path'] = '../public/upload_files/b2b/images/' . $agent_email . '/logos/';
		$config['allowed_types'] = 'pdf|jpg|png|jpeg';
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
			$error = $this->upload->display_errors();
			$data['errors'] = $error;
			// echo '<pre/>';print_r($data['errors']);exit;
			$this->load->view('b2b/create_agent', $data);

		} else {

			$data = array('upload_data' => $this->upload->data());

			// echo '<pre/>';print_r($data);exit;

			$agent_logopath = 'public/upload_files/b2b/images/' . $agent_email . '/logos/' . $data['upload_data']['file_name'];
			return $agent_logopath;
			// echo '<pre/>';print_r($agent_logopath);exit;

		}

	}

}

/* End of file b2b.php */
/* Location: ./admin/controllers/b2b.php */