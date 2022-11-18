<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class B2c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('B2c_Model');
		$this->load->model('Home_Model');
		$this->load->model('Email_Model');
		$this->load->library('admin_auth');
		$this->is_admin_logged_in();
	}

	private function is_admin_logged_in()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
			redirect('login/index');
		}
	}

	function create_user()
	{
		$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|is_unique[user_info.user_email]');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
		//$this->form_validation->set_rules('user_logo', 'User Picture', 'trim|required');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		//$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('country', 'Country', 'required');

		$data['status']='';
		$data['errors']='';
		$data['country_list'] = $this->Home_Model->get_country_list();

		if($this->form_validation->run()==FALSE)
		{
			$data['user_email'] = $this->input->post('user_email');
			$data['first_name'] = $this->input->post('first_name');
			$data['middle_name'] = $this->input->post('middle_name');
			$data['last_name'] = $this->input->post('last_name');
			$data['mobile_no'] = $this->input->post('mobile_no');
			$data['address'] = $this->input->post('address');
			$data['pin_code'] = $this->input->post('pin_code');
			$data['city'] = $this->input->post('city');
			$data['state'] = $this->input->post('state');

			$this->load->view('b2c/create_user',$data);
		}
		else
		{
			//echo '<pre/>';print_r($_POST);exit;
			$user_email = $this->input->post('user_email');
			$user_password = md5($this->input->post('user_password'));
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

			$email_check = $this->B2c_Model->check_email_availability($user_email);

			if($email_check != '' || !empty($email_check))
			{
				$data['errors'] = 'Email Already Exists. Please use different email id to continue registration...';
				$this->load->view('b2c/create_user',$data);
			}
			else
			{
				/*$config['upload_path'] = './public/upload_files/b2c/images/'.$user_email.'/logos/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['overwrite'] = TRUE;
				$config['max_size'] = '0';
				$config['max_width']  = '0';
				$config['max_height']  = '0';
				$this->load->library('upload', $config);

				if(!is_dir($config['upload_path'])){
    				mkdir($config['upload_path'], 0755, TRUE);
				}

				if(!$this->upload->do_upload('user_logo'))
				{
					$error = $this->upload->display_errors();
					$data['errors'] =$error;

					$this->load->view('b2c/create_user',$data);

				}
				else
				{
					$upload_data = $this->upload->data();
					$image_config["image_library"] = "gd2";
					$image_config["source_image"] = $upload_data["full_path"];
					$image_config['create_thumb'] = FALSE;
					$image_config['maintain_ratio'] = TRUE;
					$image_config['new_image'] = $upload_data["file_path"] . 'user_logo.png';
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

						$this->load->view('b2c/create_user',$data); //If error, redirect to an error page
					}
					else
					{
						unlink($upload_data["full_path"]);

						$image_path = WEB_DIR.'upload_files/b2c/images/'.$user_email.'/logos/user_logo.png';

						if($this->B2c_Model->add_user($user_email,$user_password,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$image_path))
						{
							redirect('b2c/user_manager','refresh');
						}
						else
						{
							$data['errors'] = 'User Registration Not Done. Please try after some time...';
							$this->load->view('b2c/user_manager',$data);

						}
					}

				}
				*/

				$image_path = '';

				if($this->B2c_Model->add_user($user_email,$user_password,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$image_path))
				{
					$email_data = array(
						'agent_email' => $user_email,
						'title' => $title,
						'first_name' => $first_name,
						'password' => $this->input->post('user_password')
						);
					$this->Email_Model->registration_conformation($email_data);
					redirect('b2c/user_manager','refresh');
				}
				else
				{
					$data['errors'] = 'User Registration Not Done. Please try after some time...';
					$this->load->view('b2c/user_manager',$data);

				}

			}
		}
	}

	public function user_manager()
	{
		$data['user_info'] = $this->B2c_Model->get_user_list();
		//echo '<pre/>';print_r($data['user_info']);exit;
		$this->load->view('b2c/user_manager',$data);
	}

	function manage_user_status()
	{
		if(isset($_POST['user_id']) && isset($_POST['status']))
		{
			$user_id = $_POST['user_id'];
			$status = $_POST['status'];
			$update = $this->B2c_Model->manage_user_status($user_id,$status);
			$data['user_info'] = $user_info = $this->B2c_Model->get_user_info_by_id($user_id);
           // echo '<pre>';print_r($user_info);exit;
			if ($status == 1) {
				$stat_msg = 'Activated';
			} elseif ($status == 0) {
				$stat_msg = 'De-activated';
			} else {
				$stat_msg = 'Blocked/Deleted';
			}
			$info = array(
				'user_email' => $user_info->user_email,
				'title' => $user_info->title,
				'first_name' => $user_info->first_name,
				'status' => $stat_msg
				);
			//echo '<pre>';print_r($info);exit;
			$this->Email_Model->status_email_user($info);
			echo $update;
		}
		else
		{
			return false;
		}

	}

	public function view_user_info($user_id='',$status='',$errors='')
	{
		$data['status']= $status;
		$data['errors']= $errors;
		$data['country_list'] = $this->Home_Model->get_country_list();

		$data['user_id']= $user_id;
		$data['user_info'] = $this->B2c_Model->get_user_info_by_id($user_id);

		$this->load->view('b2c/view_user_info',$data);
	}

	function update_user_info()
	{
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		//$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('country', 'Country', 'required');


		$data['status']='';
		$data['errors']='';
		$data['country_list'] = $this->Home_Model->get_country_list();

		$data['user_id'] = $user_id = $this->input->post('user_id');
		$data['user_info'] = $this->B2c_Model->get_user_info_by_id($user_id);

		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('b2c/view_user_info',$data);
		}
		else
		{
			//echo '<pre/>';print_r($_POST);exit;
			$user_id = $this->input->post('user_id');
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

			$user_email = $this->input->post('user_email');
			$user_logo = $this->input->post('user_logo');

			/*$file_name = $_FILES['user_logo']['tmp_name'];

			if(!empty($file_name))
			{
				$config['upload_path'] = './upload_files/b2c/images/'.$user_email.'/logos/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['overwrite'] = TRUE;
				$config['max_size'] = '0';
				$config['max_width']  = '0';
				$config['max_height']  = '0';
				$this->load->library('upload', $config);

				if(!is_dir($config['upload_path'])){
    				mkdir($config['upload_path'], 0755, TRUE);
				}

				if(!$this->upload->do_upload('user_logo'))
				{
					$error = $this->upload->display_errors();
					$data['errors'] =$error;

					$this->load->view('b2c/view_user_info',$data);

				}
				else
				{
					$upload_data = $this->upload->data();
					$image_config["image_library"] = "gd2";
					$image_config["source_image"] = $upload_data["full_path"];
					$image_config['create_thumb'] = FALSE;
					$image_config['maintain_ratio'] = TRUE;
					$image_config['new_image'] = $upload_data["file_path"] . 'user_logo.png';
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

						$this->load->view('b2c/view_user_info',$data); //If error, redirect to an error page
					}
					else
					{
						unlink($upload_data["full_path"]);

						$image_path = WEB_DIR.'upload_files/b2c/images/'.$agent_email.'/logos/user_logo.png';

						if($this->B2c_Model->update_user($user_id,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$image_path))
						{
							redirect('b2c/view_user_info/'.$user_id.'/1','refresh');
						}
						else
						{
							$data['errors'] = 'User Profile Not Updated. Please try after some time...';
							$this->load->view('b2c/view_user_info',$data);

						}
					}

				}


			}
			else
			{
				if($this->B2c_Model->update_user($user_id,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$user_logo))
				{
					redirect('b2c/view_user_info/'.$user_id.'/1','refresh');
				}
				else
				{
					$data['errors'] = 'User Profile Not Updated. Please try after some time...';
					$this->load->view('b2c/view_user_info',$data);

				}
			}
			*/

			if($this->B2c_Model->update_user($user_id,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$user_logo))
			{
				redirect('b2c/view_user_info/'.$user_id.'/1','refresh');
			}
			else
			{
				$data['errors'] = 'User Profile Not Updated. Please try after some time...';
				$this->load->view('b2c/view_user_info',$data);

			}

		}
	}

	function change_user_password($user_id='')
	{
		$this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');

		$data['status']='';
		$data['errors']='';

		$data['user_id'] = $user_id;
		$data['user_info'] = $user_info = $this->B2c_Model->get_user_info_by_id($user_id);

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('b2c/change_user_password', $data);
		}
		else
		{
			if($this->input->post('password') == $this->input->post('passconf'))
			{
				$password = md5($this->input->post('password'));
				if($this->B2c_Model->update_user_password($user_id,$password))
				{
					$data['status']=1;
				}
				else
				{
					$data['errors']='User Password not Updated. Please try after some time...';
				}
			}
			else
			{
				$data['errors']='Current Password is wrong. Please enter correct current password...';
			}

			$this->load->view('b2c/change_user_password', $data);
		}

	}

	// B2C Hotel Markup Manager
	public function hotel_markup_manager()
	{
		$data['api_list'] = $this->Home_Model->get_api_list();
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['b2c_markup_list'] = $this->B2c_Model->get_hotel_markup_list();
		//echo '<pre/>';print_r($data);exit;
		$this->load->view('b2c/hotel_markup_manager', $data);

	}

	// B2C activity Markup Manager
	public function activity_markup_manager()
	{
		$data['api_list'] = $this->Home_Model->get_api_list();
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['b2c_markup_list'] = $this->B2c_Model->get_activity_markup_list();
		//echo '<pre/>';print_r($data);exit;
		$this->load->view('b2c/actvity_markup_manager', $data);

	}

	// B2C holiday Markup Manager
	public function holiday_markup_manager()
	{
		$data['api_list'] = $this->Home_Model->get_api_list();
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['b2c_markup_list'] = $this->B2c_Model->get_holiday_markup_list();
		//echo '<pre/>';print_r($data);exit;
		$this->load->view('b2c/holiday_markup_manager', $data);

	}
	public function apart_markup_manager()
	{
		$data['api_list'] = $this->Home_Model->get_api_list();
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['b2c_markup_list'] = $this->B2c_Model->get_apart_markup_list();
		//echo '<pre/>';print_r($data);exit;
		$this->load->view('b2c/apart_markup_manager', $data);

	}

	// B2C Flight Markup Manager
	public function flight_markup_manager()
	{
		$data['api_list'] = $this->Home_Model->get_api_list();
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['b2c_markup_list'] = $this->B2c_Model->get_flight_markup_list();
		$data['airlines_list'] = $this->B2c_Model->get_airlines_list();
		//echo '<pre/>';print_r($data['b2c_markup_list']);exit;
		$this->load->view('b2c/flight_markup_manager', $data);

	}



	// B2C Car Markup Manager
	public function car_markup_manager()
	{
		$data['api_list'] = $this->Home_Model->get_api_list();
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['b2c_markup_list'] = $this->B2c_Model->get_car_markup_list();
		//echo '<pre/>';print_r($data);exit;
		$this->load->view('b2c/car_markup_manager', $data);

	}
	public function bus_markup_manager()
	{
		$data['api_list'] = $this->Home_Model->get_api_list();
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['b2c_markup_list'] = $this->B2c_Model->get_bus_markup_list();
		//echo '<pre/>';print_r($data['b2c_markup_list']);exit;
		$this->load->view('b2c/bus_markup_manager', $data);

	}
	public function transfer_markup_manager()
	{
		$data['api_list'] = $this->Home_Model->get_api_list();
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['b2c_markup_list'] = $this->B2c_Model->get_transfer_markup_list();
		//echo '<pre/>';print_r($data['b2c_markup_list']);exit;
		$this->load->view('b2c/transfer_markup_manager', $data);

	}
	public function mobile_markup_manager()
	{
		$data['api_list'] = $this->Home_Model->get_api_list();
		$data['country_list'] = $this->Home_Model->get_country_list();
		$data['b2c_markup_list'] = $this->B2c_Model->get_mobile_markup_list();
		//echo '<pre/>';print_r($data);exit;
		$this->load->view('b2c/mobile_markup_manager', $data);

	}
	

	function update_b2c_markups1()
	{
		error_reporting(E_ALL);
	echo '<pre/>';	print_r($_POST);
		if(isset($_POST) && isset($_POST['service_type']))
		{ //echo 123;exit;
			$service_type = $_POST['service_type'];
			$markup_type = $_POST['markup_type'];
			$api_name = $_POST['api_name'];
			$markup_process = $_POST['process'];
			$markup = $_POST['markup'];
			$country = $_POST['country'];
			if($markup_type == 'specific_airline')
			{
				$city = 'airline';
				$airline = $_POST['airline'];
			}


			if($api_name == 'all')
			{
				if($markup_type == 'generic')
				{
					$this->B2c_Model->delete_b2c_markup($markup_type,$service_type);
				}

				$api_list = $this->Home_Model->get_api_list();
				//print_r($api_list);exit;
				for($i=0; $i<count($api_list);$i++)
				{
					if($api_list[$i]->service_type == $service_type)
					{
						$check = $this->B2c_Model->b2c_markup_checking($country, $api_list[$i]->api_name, $markup_type, $service_type,$airline);
							//print_r($check);exit;
						if($check == '')
						{
							$this->B2c_Model->add_b2c_markup($country, $api_list[$i]->api_name,$markup_process, $markup,$markup_type, $service_type,$airline);

						}
						else
						{
							$this->B2c_Model->delete_id_b2c_markup($country, $api_list[$i]->api_name, $markup_type, $service_type,$airline);

							$this->B2c_Model->add_b2c_markup($country, $api_list[$i]->api_name,$markup_process, $markup,$markup_type, $service_type,$airline);
						}
					}
				}

			}
			else
			{
				$check = $this->B2c_Model->b2c_markup_checking($country, $api_name, $markup_type, $service_type,$airline);
				if($check == '')
				{
					$this->B2c_Model->add_b2c_markup($country, $api_name,$markup_process, $markup, $markup_type, $service_type,$airline);
				}
				else
				{
					$this->B2c_Model->delete_id_b2c_markup($country, $api_name, $markup_type, $service_type,$airline);
					$this->B2c_Model->add_b2c_markup($country, $api_name,$markup_process, $markup, $markup_type, $service_type,$airline);
				}
			}

			echo '1';

		}
		else
		{
			echo '1';
		}

	}
	function update_b2c_markups()
	{		
	// echo '<pre>';print_r($_POST);exit;
	if(isset($_POST) && isset($_POST['service_type']))
	{
		$service_type = $_POST['service_type'];
		$markup_type = $_POST['markup_type'];
		$api_name = $_POST['api_name'];
		$markup = $_POST['markup'];
		$country = $_POST['country'];
		$currency = $_POST['currency'];
		$process = $_POST['markup_process'];
//echo '<pre>';print_r($_POST);
		$city = NULL;$hotel = NULL;$airline = NULL;

		if($markup_type == 'specific_city')
		{
			$city = $_POST['city'];
		}

		if($markup_type == 'specific_hotel')
		{
			$city = 'hotel';
			$hotel = $_POST['hotel'];
		}

		if($markup_type == 'specific_airline')
		{
			$city = 'airline';
			$airline = $_POST['airline_name'];
		}


		if($api_name == 'all')
			{//echo 123;
				if($markup_type == 'generic')
				{
					$this->B2c_Model->delete_b2c_markup($markup_type,$service_type);
				}

				$api_list = $this->Home_Model->get_api_list();
				// echo '<pre/>';print_r($api_list);exit;
				for($i=0; $i<count($api_list);$i++)
				{
					if($api_list[$i]->service_type == $service_type)
					{ //echo 123;exit;
						$check = $this->B2c_Model->b2c_markup_checking($country, $city, $hotel, $airline, $api_name, $markup_type, $service_type,$currency);

						if($check == '')
						{
							$this->B2c_Model->add_b2c_markup($country, $city, $hotel, $airline, $api_name, $markup,$markup_type, $service_type, $currency,$process);
						}
						else
						{
							$this->B2c_Model->delete_id_b2c_markup($country, $city, $hotel, $airline, $api_name, $markup_type, $service_type, $currency);

							$this->B2c_Model->add_b2c_markup($country, $city, $hotel, $airline, $api_name, $markup,$markup_type, $service_type, $currency,$process);
						}
					}
				}

			}
			else
			{
				$check = $this->B2c_Model->b2c_markup_checking($country, $city, $hotel, $airline, $api_name, $markup_type, $service_type, $currency);
				if($check == '')
				{
					$this->B2c_Model->add_b2c_markup($country, $city, $hotel, $airline, $api_name, $markup, $markup_type, $service_type, $currency,$process);
				}
				else
				{
					$this->B2c_Model->delete_id_b2c_markup($country, $city, $hotel, $airline, $api_name, $markup_type, $service_type, $currency);
					$this->B2c_Model->add_b2c_markup($country, $city, $hotel, $airline, $api_name, $markup, $markup_type, $service_type, $currency,$process);
				}
			}

			//echo '1';
			$this->session->set_flashdata('message', $data['message']);
			if($service_type == 5){
					redirect('b2c/bus_markup_manager');
				}elseif ($service_type == 4) {
					redirect('b2c/car_markup_manager');
				}elseif ($service_type == 3) {
					redirect('b2c/transfer_markup_manager');
				}
				elseif ($service_type == 2) {
					redirect('b2c/flight_markup_manager');
				}elseif ($service_type == 1) {
					redirect('b2c/hotel_markup_manager');
				}elseif ($service_type == 7) {
					redirect('b2c/activity_markup_manager');
				}elseif ($service_type == 8) {
					redirect('b2c/holiday_markup_manager');
				}
			//redirect('b2c/hotel_markup_manager');

		}
		else
		{
			//echo '1';

			$this->session->set_flashdata('message', $data['message']);
			if($service_type == 5){
					redirect('b2c/bus_markup_manager');
				}elseif ($service_type == 4) {
					redirect('b2c/car_markup_manager');
				}elseif ($service_type == 3) {
					redirect('b2c/transfer_markup_manager');
				}elseif ($service_type == 2) {
					redirect('b2c/flight_markup_manager');
				}elseif ($service_type == 1) {
					redirect('b2c/hotel_markup_manager');
				}elseif ($service_type == 7) {
					redirect('b2c/activity_markup_manager');
				}elseif ($service_type == 8) {
					redirect('b2c/holiday_markup_manager');
				}
			
		}

	}
/*$this->session->set_flashdata('message', $data['message']);
				if($service_type == 3){
					redirect('b2c/hotel_markup_manager');
				}else {
					redirect('b2c/tour_markup_manager');
				}*/
	public function b2c_bus_markup_status($markup_id,$status) {
		
			if ($status != '2') {
				$update = $this->B2c_Model->manage_b2c_markup_status($markup_id,$status);

			} else {
				$update = $this->B2c_Model->delete_b2c_markup_status($markup_id);
			}
				redirect('b2c/bus_markup_manager', 'refresh'); 
	}
	public function b2c_car_markup_status($markup_id,$status) {
		
			if ($status != '2') {
				$update = $this->B2c_Model->manage_b2c_markup_status($markup_id,$status);

			} else {
				$update = $this->B2c_Model->delete_b2c_markup_status($markup_id);
			}
				redirect('b2c/car_markup_manager', 'refresh'); 
	}
	public function b2c_transfer_markup_status($markup_id,$status) {
		
			if ($status != '2') {
				$update = $this->B2c_Model->manage_b2c_markup_status($markup_id,$status);

			} else {
				$update = $this->B2c_Model->delete_b2c_markup_status($markup_id);
			}
				redirect('b2c/transfer_markup_manager', 'refresh'); 
	}
	function manage_b2c_markup_status()
	{
		if(isset($_POST['markup_id']) && isset($_POST['status']))
		{
			$markup_id = $_POST['markup_id'];
			$status = $_POST['status'];
			if($status != '2')
			{
				$update = $this->B2c_Model->manage_b2c_markup_status($markup_id,$status);
			}
			else
			{
				$update = $this->B2c_Model->delete_b2c_markup_status($markup_id);
			}
			echo $update;
		}
		else
		{
			return false;
		}

	}
	public function flight_discount_manager()
	{
		$data['airlines_list'] = $this->B2c_Model->get_airlines_list();
		
		$data['b2c_discount_list'] = $this->B2c_Model->get_airline_discount_list();
		$data['airport_list']=$this->B2c_Model->get_airport_list();
		//echo '<pre/>';print_r($data);exit;
		$this->load->view('b2c/flight_discount_manager', $data);

	}
	public function update_discount(){
		// echo '<pre>';print_r($_POST);exit;
		if(isset($_POST)){
			
			$basefare=0;
			$yqfare=0;
			$origin='';
			$destination='';
			$discount=$_POST['discount'];
			$airline=$_POST['airline'];

			if(isset($_POST['basefare']) && $_POST['basefare']!=''){
				$basefare=$_POST['basefare'];
			}
			if(isset($_POST['yqfare']) && $_POST['yqfare']!=''){
				$yqfare=$_POST['yqfare'];	
			}

			if(isset($_POST['origin'])){
				$origin=$_POST['origin'];
			}
			if(isset($_POST['destination'])){
				$destination=$_POST['destination'];	
			}

			if($origin=='all' && $destination=='all'){
				$this->B2c_Model->delete_old_discount($airline);
			}elseif($origin!='all' && $destination!='all'){
				$this->B2c_Model->delete_old_discount($airline,$origin,$destination);
			}

			$insert=false;
			if($origin=='all' && $destination=='all'){
				$insert=true;
			}elseif($origin!='all' && $destination!='all'){
				$insert=true;
			}

			if($insert){
				$data=array(
					'airline'=>$airline,
					'discount'=>$discount,
					'basefare'=>$basefare,
					'yqfare'=>$yqfare,
					'origin'=>$origin,
					'destination'=>$destination,
					'status'=>1,
					);
//echo '<pre>';print_r($data);exit;
				$this->B2c_Model->insert_discount($data);
			}
		}else{
			echo '1';
		}
	}
	public function b2c_reports_manager_hotel($download_excel='')
	{
		$data['status']=$status=isset($_GET['Status']) ? $_GET['Status'] : '';
		$data['supplier']=$supplier=isset($_GET['supplier']) ? $_GET['supplier'] : '';
		$data['from_date']=$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$data['to_date']=$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$data['type']=$type=isset($_GET['type']) ? $_GET['type'] : '';
	//print_r($type);
		$id='1';
     //   $data['flight_booking_summary'] = $this->B2c_Model->get_b2c_flight_booking_summary();

		list($data['hotel_booking_summary'],$result) = $this->B2c_Model->get_b2c_hotel_booking_summary($status,$supplier,$from_date,$to_date,$type);

		//$data['car_booking_summary'] = $this->B2c_Model->get_b2c_car_booking_summary();
		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale']=$id;
		//echo '<pre/>';print_r($data['hotel_booking_summary']);exit;
	//$data['holiday_query_summary']=$this->B2c_Model->get_holi_query_reports($status,$supplier,$from_date,$to_date,$type);

		if($download_excel!=''){
			$this->B2c_Model->dd_ex($result);
		}
		$this->load->view('b2c/b2c_reports_manager',$data);
	}



	public function b2c_reports_manager_flights($download_excel='')
	{
		$data['status']=$status=isset($_GET['Status']) ? $_GET['Status'] : '';
		$data['supplier']=$supplier=isset($_GET['supplier']) ? $_GET['supplier'] : '';
		$data['from_date']=$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$data['to_date']=$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$data['type']=$type=isset($_GET['type']) ? $_GET['type'] : '';
	//print_r($type);
		$id='2';
		list($data['flight_booking_summary'],$result) = $this->B2c_Model->get_b2c_flight_booking_summary($status,$supplier,$from_date,$to_date,$type);
		//echo $this->db->last_query();exit;
     // echo'<pre>';print_r($data['flight_booking_summary']);exit;
		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale']=$id;
		//echo '<pre/>';print_r($data);exit;
	//$data['holiday_query_summary']=$this->B2c_Model->get_holi_query_reports($status,$supplier,$from_date,$to_date,$type);

		if($download_excel!=''){
			$this->B2c_Model->dd_ex($result);
		}
		$this->load->view('b2c/b2c_reports_manager',$data);
	}

	public function b2c_reports_manager_holiday($download_excel='')
	{
		$status=isset($_GET['Status']) ? $_GET['Status'] : '';
		$supplier=isset($_GET['supplier']) ? $_GET['supplier'] : '';
		$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$type=isset($_GET['type']) ? $_GET['type'] : '';
		$id='4';
		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale']=$id;
		//echo '<pre/>';print_r($data);exit;
		list($data['holiday_query_summary'],$result)=$this->B2c_Model->get_holi_query_reports($status,$supplier,$from_date,$to_date,$type);
		if($download_excel!=''){
			$this->B2c_Model->dd_ex($result);
		}
		$this->load->view('b2c/b2c_reports_manager',$data);
	}

	public function b2c_reports_manager_bus($download_excel='')
	{
		$status=isset($_GET['Status']) ? $_GET['Status'] : '';
		$supplier=isset($_GET['supplier']) ? $_GET['supplier'] : '';
		$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$type=isset($_GET['type']) ? $_GET['type'] : '';
		$id='3';

		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale']=$id;
		list($data['bus_booking_summary'],$result) = $this->B2c_Model->get_b2c_bus_booking_summary($status,$supplier,$from_date,$to_date,$type);
//print_r($result);
		if($download_excel!=''){
			$this->B2c_Model->dd_ex($result);
		}
		$this->load->view('b2c/b2c_reports_manager', $data);
	}


	public function b2c_reports_manager_transfer($download_excel='')
	{
		$status=isset($_GET['Status']) ? $_GET['Status'] : '';
		$supplier=isset($_GET['supplier']) ? $_GET['supplier'] : '';
		$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$type=isset($_GET['type']) ? $_GET['type'] : '';
		$id='7';

		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale']=$id;
		list($data['transfer_booking_summary'],$result) = $this->B2c_Model->get_b2c_transfer_booking_summary($status,$supplier,$from_date,$to_date,$type);
// print_r($result);exit;
		if($download_excel!=''){
			$this->B2c_Model->dd_ex($result);
		}
		$this->load->view('b2c/b2c_reports_manager', $data);
	}


	public function b2c_reports_manager_activity($download_excel='')
	{
		$status=isset($_GET['Status']) ? $_GET['Status'] : '';
		$supplier=isset($_GET['supplier']) ? $_GET['supplier'] : '';
		$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$type=isset($_GET['type']) ? $_GET['type'] : '';
		$id='8';

		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale']=$id;
		list($data['activity_booking_summary'],$result) = $this->B2c_Model->get_b2c_activity_booking_summary($status,$supplier,$from_date,$to_date,$type);
//print_r($result);
		if($download_excel!=''){
			$this->B2c_Model->dd_ex($result);
		}
		$this->load->view('b2c/b2c_reports_manager', $data);
	}

	public function b2c_reports_manager_car($download_excel='')
	{
		$status=isset($_GET['Status']) ? $_GET['Status'] : '';
		$supplier=isset($_GET['supplier']) ? $_GET['supplier'] : '';
		$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$type=isset($_GET['type']) ? $_GET['type'] : '';
		$id='5';

		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale']=$id;
		list($data['car_booking_summary'],$result) = $this->B2c_Model->get_b2c_car_booking_summary($status,$supplier,$from_date,$to_date,$type);
	//print_r($result);
		if($download_excel!=''){
			$this->B2c_Model->dd_ex($result);
		}
		$this->load->view('b2c/b2c_reports_manager', $data);
	}


	public function voucher($hol_unique)
	{
	//echo '<pre>';print_r($hol_unique);exit;
		$data['holiday_booking_info'] = $this->B2c_Model->get_holiday_booking_information($hol_unique);
		$hol_id=$data['holiday_booking_info']->holiday_id;
		$data['holidaydetails']=$this->B2c_Model->get_holiday($hol_id);
		$data['passenger_info'] = $this->B2c_Model->get_holiday_booking_passenger_info($hol_unique);
		$this->load->view('holiday/voucher_hol',$data);
	}
	public function b2c_reports_manager_hotel_cancel($download_excel='')
	{
		$data['status']=$status=isset($_GET['Status']) ? $_GET['Status'] : '';
		$data['supplier']=$supplier=isset($_GET['supplier']) ? $_GET['supplier'] : '';
		$data['from_date']=$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$data['to_date']=$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$data['type']=$type=isset($_GET['type']) ? $_GET['type'] : '';
	//print_r($type);
		$id='1';
     //   $data['flight_booking_summary'] = $this->B2c_Model->get_b2c_flight_booking_summary();

		list($data['hotel_booking_summary'],$result) = $this->B2c_Model->get_b2c_hotel_booking_summary($status,$supplier,$from_date,$to_date,$type);

		//$data['car_booking_summary'] = $this->B2c_Model->get_b2c_car_booking_summary();
		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale']=$id;
		//echo '<pre/>';print_r($data);exit;
	//$data['holiday_query_summary']=$this->B2c_Model->get_holi_query_reports($status,$supplier,$from_date,$to_date,$type);

		if($download_excel!=''){
			$this->B2c_Model->dd_ex($result);
		}
		$this->load->view('b2c/b2c_reports_manager_cancel',$data);
	}
	public function b2c_reports_manager_flights_cancel($download_excel='')
	{
		$data['status']=$status=isset($_GET['Status']) ? $_GET['Status'] : '';
		$data['supplier']=$supplier=isset($_GET['supplier']) ? $_GET['supplier'] : '';
		$data['from_date']=$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$data['to_date']=$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$data['type']=$type=isset($_GET['type']) ? $_GET['type'] : '';
	//print_r($type);
		$id='2';
		list($data['flight_booking_summary'],$result) = $this->B2c_Model->get_b2c_flight_booking_summary($status,$supplier,$from_date,$to_date,$type);
      //print_r($data['flight_booking_summary']);exit;
		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale']=$id;
		//echo '<pre/>';print_r($data);exit;
	//$data['holiday_query_summary']=$this->B2c_Model->get_holi_query_reports($status,$supplier,$from_date,$to_date,$type);

		if($download_excel!=''){
			$this->B2c_Model->dd_ex($result);
		}
		$this->load->view('b2c/b2c_reports_manager_cancel',$data);
	}
	public function b2c_reports_manager_bus_cancel($download_excel='')
	{
		$status=isset($_GET['Status']) ? $_GET['Status'] : '';
		$supplier=isset($_GET['supplier']) ? $_GET['supplier'] : '';
		$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$type=isset($_GET['type']) ? $_GET['type'] : '';
		$id='3';

		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale']=$id;
		list($data['bus_booking_summary'],$result) = $this->B2c_Model->get_b2c_bus_booking_summary($status,$supplier,$from_date,$to_date,$type);
		if($download_excel!=''){
			$this->B2c_Model->dd_ex($result);
		}
		$this->load->view('b2c/b2c_reports_manager_cancel', $data);
	}

	public function b2c_reports_manager_apartment_cancel($download_excel='')
	{
		$status=isset($_GET['Status']) ? $_GET['Status'] : '';
		$supplier=isset($_GET['supplier']) ? $_GET['supplier'] : '';
		$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$type=isset($_GET['type']) ? $_GET['type'] : '';
		$id='5';

		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale']=$id;
		list($data['apartment_booking_summary'],$result) = $this->B2c_Model->get_b2c_apartment_booking_summary($status,$supplier,$from_date,$to_date,$type);

		$this->load->view('b2c/b2c_reports_manager_cancel', $data);
	}
	public function b2c_reports_manager_apartment($download_excel='')
	{
		$status=isset($_GET['Status']) ? $_GET['Status'] : '';
		$supplier=isset($_GET['supplier']) ? $_GET['supplier'] : '';
		$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
		$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
		$type=isset($_GET['type']) ? $_GET['type'] : '';
		$id='6';

		$data['api_list'] = $this->B2c_Model->get_api_list();
		$data['vale']=$id;
		list($data['apartment_booking_summary'],$result) = $this->B2c_Model->get_b2c_apartment_booking_summary($status,$supplier,$from_date,$to_date,$type);
//echo '<pre>';print_r($data['apartment_booking_summary']);exit;
		if($download_excel!=''){
			$this->B2c_Model->dd_ex($result);
		}
		$this->load->view('b2c/b2c_reports_manager', $data);
	}

	public function get_b2c_holiday_report($id){

		$data['holiday_query_summary']=$this->B2c_Model->get_holiday_reports($id);
		$this->load->view('b2b/holiday_invoicer', $data);
	}
	public function get_agent_holiday_report($id){

		$data['holiday_query_summary']=$this->B2c_Model->get_holiday_reports($id);
	//echo '<pre>';print_r($data['holiday_query_summary']->agent_id);exit;
		$data['agent_summary']=$this->B2c_Model->get_holiday_agent_reports($data['holiday_query_summary']->agent_id);
		$this->load->view('b2b/agent_holiday_invoicer', $data);
	}
	public function update_B2C_hotel_ref_amt($uniqueRefNo){
	//echo '<pre>';print_r($this->session->all_userdata());exit;
		if($this->session->userdata('admin_logged_in')){
			$admin_email=$this->session->userdata('admin_email');
			$admin_id=$this->session->userdata('admin_id');
			$amt=$this->input->post('refund_amt');
			$this->B2c_Model->update_B2Chotel_ref_amt($amt,$uniqueRefNo,$admin_email,$admin_id);
//	echo '<pre>';print_r($info);exit;
//echo $this->db->last_query();exit;

			redirect('b2c/b2c_reports_manager_hotel_cancel','refresh');
		}
	}
	public function update_B2B_hotel_ref_amt($uniqueRefNo){
	//echo '<pre>';print_r($this->session->all_userdata());exit;
		if($this->session->userdata('admin_logged_in')){
			$admin_email=$this->session->userdata('admin_email');
			$admin_id=$this->session->userdata('admin_id');
			$amt=$this->input->post('refund_amt');
			$this->B2c_Model->update_B2Chotel_ref_amt($amt,$uniqueRefNo,$admin_email,$admin_id);
//	echo '<pre>';print_r($info);exit;
//echo $this->db->last_query();exit;

			redirect('b2b/b2b_reports_manager_hotel_cancel','refresh');
		}
	}

	public function update_B2C_apart_ref_amt($uniqueRefNo){
	//echo '<pre>';print_r($this->session->all_userdata());exit;
		if($this->session->userdata('admin_logged_in')){
			$admin_email=$this->session->userdata('admin_email');
			$admin_id=$this->session->userdata('admin_id');
			$amt=$this->input->post('refund_amt');
			$this->B2c_Model->update_B2Capart_ref_amt($amt,$uniqueRefNo,$admin_email,$admin_id);
//	echo '<pre>';print_r($info);exit;
//echo $this->db->last_query();exit;

			redirect('b2c/b2c_reports_manager_apartment_cancel','refresh');
		}
	}

	public function update_B2B_apart_ref_amt($uniqueRefNo){
	//echo '<pre>';print_r($this->session->all_userdata());exit;
		if($this->session->userdata('admin_logged_in')){
			$admin_email=$this->session->userdata('admin_email');
			$admin_id=$this->session->userdata('admin_id');
			$amt=$this->input->post('refund_amt');
			$this->B2c_Model->update_B2Capart_ref_amt($amt,$uniqueRefNo,$admin_email,$admin_id);
//	echo '<pre>';print_r($info);exit;
//echo $this->db->last_query();exit;

			redirect('b2b/b2b_reports_manager_apartment_cancel','refresh');
		}
	}

	public function update_B2C_flights_ref_amt($uniqueRefNo){
	//echo '<pre>';print_r($this->session->all_userdata());exit;
		if($this->session->userdata('admin_logged_in')){
			$admin_email=$this->session->userdata('admin_email');
			$admin_id=$this->session->userdata('admin_id');
			$amt=$this->input->post('refund_amt');
			$this->B2c_Model->update_B2Cflight_ref_amt($amt,$uniqueRefNo,$admin_email,$admin_id);
//	echo '<pre>';print_r($info);exit;
//echo $this->db->last_query();exit;

			redirect('b2c/b2c_reports_manager_flights_cancel','refresh');
		}
	}
	public function update_B2B_flights_ref_amt($uniqueRefNo){
	//echo '<pre>';print_r($this->session->all_userdata());exit;
		if($this->session->userdata('admin_logged_in')){
			$admin_email=$this->session->userdata('admin_email');
			$admin_id=$this->session->userdata('admin_id');
			$amt=$this->input->post('refund_amt');
			$this->B2c_Model->update_B2Cflight_ref_amt($amt,$uniqueRefNo,$admin_email,$admin_id);
//	echo '<pre>';print_r($info);exit;
//echo $this->db->last_query();exit;

			redirect('b2b/b2b_reports_manager_flights_cancel','refresh');
		}
	}
	public function update_B2C_bus_ref_amt($uniqueRefNo){
	//echo '<pre>';print_r($this->session->all_userdata());exit;
		if($this->session->userdata('admin_logged_in')){
			$admin_email=$this->session->userdata('admin_email');
			$admin_id=$this->session->userdata('admin_id');
			$amt=$this->input->post('refund_amt');
			$this->B2c_Model->update_B2Cbus_ref_amt($amt,$uniqueRefNo,$admin_email,$admin_id);
//	echo '<pre>';print_r($info);exit;
//echo $this->db->last_query();exit;

			redirect('b2c/b2c_reports_manager_bus_cancel','refresh');
		}
	}
	public function update_B2B_bus_ref_amt($uniqueRefNo){
	//echo '<pre>';print_r($this->session->all_userdata());exit;
		if($this->session->userdata('admin_logged_in')){
			$admin_email=$this->session->userdata('admin_email');
			$admin_id=$this->session->userdata('admin_id');
			$amt=$this->input->post('refund_amt');
			$this->B2c_Model->update_B2Cbus_ref_amt($amt,$uniqueRefNo,$admin_email,$admin_id);
//	echo '<pre>';print_r($info);exit;
//echo $this->db->last_query();exit;

			redirect('b2b/b2b_reports_manager_bus_cancel','refresh');
		}
	}
	public function hotels_city_list() {
		if (isset($_GET['term'])) {
		//print_r($_GET['term']);
			$return_arr = array();
			$search = $_GET["term"];
			$city_list = $this->B2c_Model->get_all_city_list($search);
		//print_r($city_list);exit;
			if (!empty($city_list)) {
				for ($i = 0; $i < count($city_list); $i++) {
					$city = $city_list[$i]['hotel_name'];


					$return_arr[] = array(
						'label' => ucfirst($city),
						'value' => ucfirst($city)
						);
				}
			} else {
				$return_arr[] = array(
					'label' => "No Results Found",
					'value' => ""
					);
			}
		} else {
			$return_arr[] = array(
				'label' => "No Results Found",
				'value' => ""
				);
		}

		/* Toss back results as json encoded array. */
		echo json_encode($return_arr);
	}

	public function manage_discount_status($id,$status=""){
		if($status==1 || $status==0){
			$this->B2c_Model->update_discount_status($id,$status);
		}elseif($status==2){
			$this->B2c_Model->delete_discount($id);	
		}
		redirect('b2c/flight_discount_manager','refresh');
	}

	public function update_flight_ticket(){

		$data = array(
			'Ticket_Number' => $this->input->post('ticket_no'),
			'report_id' => $this->input->post('report_id')
			);
		$this->db->where('report_id', $this->input->post('report_id'));
		$this->db->update('flight_booking_reports', $data);
		// echo $this->db->last_query();exit;
		redirect('b2c/b2c_reports_manager_flights','refresh');
	}

}

/* End of file b2c.php */
/* Location: ./admin/controllers/b2c.php */