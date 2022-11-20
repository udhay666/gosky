<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Home extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Home_Model');
		
		$this->load->helper('cookie');

	}

	public function index()
    {      
        $data['holiday'] = $this->Home_Model->getHolidaypackage();        
        // $this->load->view('home/home_template/header'); 
        $this->load->view('home', $data);       
        
    }

    public function b2c_login()
    {
        $this->load->view('b2c_login');
        
    }

    public function index2()
    {      
        $agent_no = $this->session->userdata('agent_no');
    
        // $data['agent_ac_summary'] = $this->Home_Model->agent_acc_summary($agent_no);
        // echo $this->db->last_query();exit;
        $data['holiday'] = $this->Home_Model->getHolidaypackage();
        // echo $this->db->last_query();exit;
        // $data['currency'] = $this->Home_Model->getCurrency($id);
        $data['banner']=$this->Home_Model->get_homebanner_images();
        $data['footer_content']=$this->Home_Model->getcms_footer();
        // $data['idv'] = $id;        
        $this->load->view('home', $data);       
        //$this->load->view('home/home_template/footer'); 
    }
    
    public function send_feedback_mail()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $message = $this->input->post('message');
        
        // print_r($_POST);exit;
        $config= Array(
            'protocol'  =>'telnet',
            'smtp_host' => 'mail.tpdtechnosoft.com',
            'smtp_port' => '25',
            'smtp_user'=>  'it@tpdtechnosoft.com',
            'smtp_pass' =>'travelpd@2015'
            );
            
        // $from_email = "info@travelkitb2b.com";
        // $to_email = "sales@travelkitb2b.com";
        $from_email = "noreply@travelkitb2b.com";
        $to_email = "director@travelkitb2b.com";
        
        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->from($from_email,'');
        $this->email->to($to_email);
        $this->email->subject('Feedback');
        $this->email->message(' Message: '.$message.' Name: '.$name.' Contact No: '.$phone.' Email: '.$email);

        if($this->email->send())
        {
            $this->session->set_flashdata('email_send', 'Feedback Sent Successfully');
            $this->index();            
            
        }else
        {
            $this->session->set_flashdata('email_send', 'Something Went Worng!');
            $this->index();
            
        }
    }
    
    
    

    public function about()
    {
        $data['about'] = $this->Home_Model->getAbout();
        $this->load->view('home_template/header'); 
        $this->load->view('home/about', $data);       
        $this->load->view('home_template/footer'); 
    }

    public function contactus()
    {
        $data['about'] = $this->Home_Model->getcontact();
        $this->load->view('home_template/header'); 
        $this->load->view('home/about', $data);       
        $this->load->view('home_template/footer'); 
    }

    public function privacypolicy()
    {
        $data['about'] = $this->Home_Model->getprivacy();
        $this->load->view('home_template/header'); 
        $this->load->view('home/about', $data);       
        $this->load->view('home_template/footer'); 
    }

    public function termsandcondition()
    {
        $data['about'] = $this->Home_Model->getterms();
        $this->load->view('home_template/header'); 
        $this->load->view('home/about', $data);       
        $this->load->view('home_template/footer'); 
    }   
    

    public function refundpolicy()
    {
        $data['about'] = $this->Home_Model->getrefund();
        $this->load->view('home_template/header'); 
        $this->load->view('home/about', $data);       
        $this->load->view('home_template/footer'); 
    }

    public function faq()
    {
        $data['about'] = $this->Home_Model->getfaq();
        $this->load->view('home_template/header'); 
        $this->load->view('home/about', $data);       
        $this->load->view('home_template/footer'); 
    }

    public function affiliate()
    {
        $data['about'] = $this->Home_Model->getaffiliate();
        $this->load->view('home_template/header'); 
        $this->load->view('home/about', $data);       
        $this->load->view('home_template/footer'); 
    }

    public function holiday()
    {
        $data['image'] = $this->Home_Model->getHolidayImage();
    }
    
     public function airportList()
    {
        $postData = $this->input->post();

        $data = $this->Home_Model->getAirportlist($postData);
               

        echo json_encode($data);
    }
    
   public function holiday_itenerary($id)
    {
        $data['holiday_list']=$this->Home_Model->get_holiday_list_by_id($id);
        $data['hholiday_list'] = $this->Home_Model->get_hholiday_list_by_id($id);
        $data['hol_id']=$id;
        $data['hol_thumb_images']=$this->Home_Model->get_holi_images($id);
        $data['hol_gall_images']=$this->Home_Model->get_gall_images($id);
        // echo $this->db->last_query();exit;
        $this->load->view('holiday_itenerary',$data);
    }
    
    public function holiday_autolist() {
		if (isset($_GET['term'])) {
            print_r($_GET['term']);
            $return_arr = array();
            $search = $_GET["term"];
            if(!empty($_GET["term"])) {
				$city_list = $this->Home_Model->get_holiday_city_list($search);
				//echo $this->db->last_query(); 
			} else {
				$module_type = 1;
				$city_list = $this->Home_Model->getPopularCities($module_type);
			}
            //print_r($city_list);exit;
            if (!empty($city_list)) {
            	if(!empty($_GET["term"])) {
	                for ($i = 0; $i < count($city_list); $i++) {
	                    $city = $city_list[$i]['city_name'] . ', ' . $city_list[$i]['city_name'];
	                    $cityid = $city_list[$i]['city_name'];
	                    $return_arr[] = array(
	                        'label' => ucfirst($city),
	                        'value' => ucfirst($city),
	                        'id' => $cityid,
	                        'category' => ''
	                    );
	                }
                } else {
					for ($i = 0; $i < count($city_list); $i++) {
						$city = $city_list[$i]['name'] . ', ' . $city_list[$i]['country'];
	                    $cityid = $city_list[$i]['code'];
						$return_arr[] = array(
							'label' => ucfirst($city),
	                        'value' => ucfirst($city),
	                        'id' => $cityid,
	                        'category' => 'Popular Cities'
						);
					}
				}
            } else {
                $return_arr[] = array(
                    'label' => "No Results Found",
                    'value' => "",
                    'id' => "",
                    'category' => ''
                );
            }
        } else {
            $return_arr[] = array(
                'label' => "No Results Found",
                'value' => "",
                'id' => "",
                'category' => ''
            );
        }

        /* Toss back results as json encoded array. */
        echo json_encode($return_arr);
	}

    public function hotelCityList()
	{
		$postData = $this->input->post();

        $data = $this->Home_Model->getHotelCitylist($postData);

        echo json_encode($data);
	}
	
	public function holidayCityList()
    {
        $postData = $this->input->post();

        $data = $this->Home_Model->getHolidayCitylist($postData);

        echo json_encode($data);
    }
    
    public function travellerCityList(){
        $postData = $this->input->post();

        $data = $this->Home_Model->getTravellerCitylist($postData);

        echo json_encode($data);
    } 



	public function error404(){
		$this->load->view('home/page_not_found');
	}

	function success_page($success) {
		$data['success'] = base64_decode($success);
		$this->load->view('success', $data);
	}

	function error_page($error) {
		$data['error'] = base64_decode($error);
		$this->load->view('error', $data);
	}

	function warning_page($error) {
		$data['error'] = base64_decode($error);
		$this->load->view('error', $data);
	}

	public function aboutus(){
		$this->load->view('aboutus');
	}
	public function privaypolicy(){
		$this->load->view('privacypolicy');
	}
	public function termsncondition(){
		$this->load->view('termsncondition');
	}

    public function ticket_support() {
        // echo '<pre>'; print_r($_POST);
        // $this->form_validation->set_rules('service_type', 'Type', 'trim|required');
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('uniqueRefNo', 'Booking Id', 'trim|required');
        $this->form_validation->set_rules('user_name', 'User Name', 'trim|required');
        $this->form_validation->set_rules('user_mobile', 'Mobile No', 'trim|required|integer|min_length[10]');
  
        $data['service_type'] = $service_type = $this->input->post('service_type');
        $data['user_email'] = $user_email = $this->input->post('user_email');
        $data['uniqueRefNo'] = $uniqueRefNo = $this->input->post('uniqueRefNo');
        $data['user_mobile'] = $user_mobile = $this->input->post('user_mobile');
        $data['user_name'] = $user_mobile = $this->input->post('user_name');
        $data['hotel_booking_summary'] = '';
        $data['no_records'] = '';
        if ($this->form_validation->run() == FALSE) {
          $this->load->view('cancellation/cancellation_index', $data);
        } else {
          $service_type = $this->input->post('service_type');
          $user_email = $this->input->post('user_email');
          $uniqueRefNo = $this->input->post('uniqueRefNo');
          $user_mobile = $this->input->post('user_mobile');
          $user_name = $this->input->post('user_name');
          if($service_type == '1'){
            $data['hotel_booking_summary'] = $this->Home_Model->hotelBookingSummary($uniqueRefNo,$user_email,$user_mobile);
            // echo $this->db->last_query();exit;
             // echo '<pre>';print_r($data['hotel_booking_summary']);exit;
            if(empty($data['hotel_booking_summary'])){
              $data['no_records'] = 'Yes';
            }
            $this->load->view('cancellation/hotel_cancellation', $data);
          } /*else if($service_type == '5'){
            $data['tour_booking_summary'] = $this->Home_Model->get_holiday_booking_info($user_email,$user_mobile,$uniqueRefNo);
            
            if(empty($data['tour_booking_summary'])){
              $data['no_records'] = 'yes';
            }
            $this->load->view('cancellation/hotel_cancellation.php', $data);
          }*/
          
        }
      }

      public function print_ticket() {
		// $this->form_validation->set_rules('service_type', 'Type', 'trim|required');
		$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('uniqueRefNo', 'Booking Id', 'trim|required');
		$this->form_validation->set_rules('user_mobile', 'Mobile No', 'trim|required|integer|min_length[10]');

		$data['service_type'] = $service_type = $this->input->post('service_type');
		$data['user_email'] = $user_email = $this->input->post('user_email');
		$data['uniqueRefNo'] = $uniqueRefNo = $this->input->post('uniqueRefNo');
		$data['user_mobile'] = $user_mobile = $this->input->post('user_mobile');
		$data['hotel_booking_summary'] = '';
		$data['no_records'] = '';
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('cancellation/cancellation_index', $data);
		} else {
			$service_type = $this->input->post('service_type');
			$user_email = $this->input->post('user_email');
			$uniqueRefNo = $this->input->post('uniqueRefNo');
			$user_mobile = $this->input->post('user_mobile');
			if($service_type == '1'){
				$data['hotel_booking_summary'] = $this->Home_Model->hotelBookingSummary($user_email,$user_mobile,$uniqueRefNo);

				if(empty($data['hotel_booking_summary'])){
					$data['no_records'] = 'Yes';
				}
				$this->load->view('cancellation/hotel_cancellation', $data);
			} else if($service_type == '2'){
				$data['flight_booking_summary'] = $this->Home_Model->get_flight_booking_info($user_email,$user_mobile,$uniqueRefNo);
				// echo '<pre>';print_r($data['flight_booking_summary']);exit;
				if(empty($data['flight_booking_summary'])){
					$data['no_records'] = 'yes';
				}
				$this->load->view('cancellation/flight_cancellation', $data);
			}
			
		}
	}
	
      public function phpinfo(){
		echo ENVIRONMENT;
		echo CI_VERSION;
		echo phpinfo();
	}


}

/* End of file Home.php */
/* Location: ./application/modules/Home.php */					