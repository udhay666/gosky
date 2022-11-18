<?php 

ini_set('memory_limit', '-1');

if (!defined('BASEPATH'))

    exit('No direct script access allowed');

class Holiday extends MX_Controller {

    const RefPrefix = 'MT';

    private $sess_id;

    private $result_hol;

    public function __construct() {

        parent::__construct();

        $this->load->model('Holiday_Model');

        $this->load->library('form_validation');

        $this->load->model('home/Home_Model');

       }

    function index() {

      $this->load->view('home/index');

    }



    public function holidaysearch() 

    {

      // echo 123;print_r($_POST);exit;

      $fromCity = $_POST['fromCity'];

      $toCity = $_POST['toCity']; 

      $monthOfTravel = $_POST['monthOfTravel']; 

        if($fromCity != '') {

        $sess_array = array(        

          'fromCity'=>$fromCity,

          'toCity'=>$toCity,

          'monthOfTravel'=>$monthOfTravel,

        );

        $this->session->set_userdata('holiday_search_data', $sess_array);

        } 

      $sess_data = $this->session->userdata('holiday_search_data');

      $data['result']  = $this->Holiday_Model->search_holiday_package_result($sess_data['fromCity'],$sess_data['monthOfTravel']);

      // echo $this->db->last_query();

      // echo '<pre>123';print_r($data['result']);exit;

      $this->load->view('holiday/search_result',$data);

    }



    public function hoteldetails($holiday_id='',$itinerary_id='') {



      $data['result']  = $this->Holiday_Model->search_holiday_details($holiday_id,$itinerary_id);

      $this->load->view('holiday/hotel_details',$data);





    }

    public function cabdetails($holiday_id='',$itinerary_id='') {



      $data['result']  = $this->Holiday_Model->search_holiday_details($holiday_id,$itinerary_id);

      $this->load->view('holiday/cab_details',$data);





    }

    public function fetch_results() {

      $holiday_search_data = $this->session->userdata('holiday_search_data');

      $fromCity = $holiday_search_data['fromCity'];

      $monthOfTravel = $holiday_search_data['monthOfTravel'];

      if($fromCity !== ''){

        $result = $this->Holiday_Model->search_holiday_package_result($fromCity,$monthOfTravel);

      } else {

        $result = $this->Holiday_Model->search_holiday_package_result($fromCity,$monthOfTravel);

      }

      $subdata['result'] = $result;

      $holiday_search_result = '';   

      if (!empty($result)) {

          $holiday_search_result .= $this->load->view('search_result_ajax', $subdata, TRUE);

           // echo '<pre/>';print_r($holiday_search_result);exit;

          $cnt=count($result);

      } else {

        $holiday_search_result = $this->load->view('no_result_ajax', $subdata, TRUE);

        $cnt=0;

      }

        echo json_encode(array(

          'holiday_search_result' => $holiday_search_result,

          'search_count'=> $cnt,

        ));

  }

      public function holidaydetails($id='') {

        // echo $id;exit;

        $holiday_id = base64_decode($id);

           // echo $holiday_id;exit;

        if(empty($holiday_id))

        {

            redirect('','refresh');

        }

        $data['holidaydetails'] = $this->Holiday_Model->get_details($holiday_id);

         if(empty($data['holidaydetails']))

        {

            redirect('','refresh');

        }

        $data['itinerary'] = $this->Holiday_Model->get_itinerary($holiday_id,$data['holidaydetails']->duration);

        $data['review_list'] = $this->Holiday_Model->get_holiday_review_list($holiday_id);

        // echo '<pre/>';print_r($data['holidaydetails']);exit;

        // echo $this->db->last_query();

        // echo '<pre/>';print_r($data['review_list'] );exit;

        $this->load->view('holiday_details', $data);

    }



    public function holiday_package_enquiry(){

       // echo '<pre/>';print_r($_POST);exit;

      $h_id=$this->input->post('holiday_id');

      $uniqueRefNo = $this->generateRandomString(8);

      if ($this->session->userdata('user_logged_in')) {

            $user_id = $this->session->userdata('user_id');

            $agent_id = 0;

        } else {

            $user_id = 0;

            if ($this->session->userdata('agent_logged_in')) {

                $agent_id = $this->session->userdata('agent_id');                

            } else {

                $agent_id = 0;

            }

        }

      $name = $_POST['name'];

      $email = $_POST['email'];

      $contact_number = $_POST['contact_number'];

      $city = $_POST['city'];

      $holiday_name = $_POST['holiday_name'];

      $total_cost = $_POST['total_cost'];

      $pck_ins=array(

        // 'city_name' => $this->input->post('p_visit'),

        'package_title' => $holiday_name,

        // 'triptype' => $this->input->post('triptype'),

        'package_validity' => $this->input->post('p_validity'),

        // 'package_cisit' => $this->input->post('p_visit'),

        'title' => $this->input->post('tit'),

        'fname' => $this->input->post('name'),

        // 'lname' => $this->input->post('lname'),

        // 'country' => $this->input->post('country'),

        'pass_city' => $city,

        'phone' => $contact_number,

        'email' => $email,

        // 'telephone' => $this->input->post('tphoneopt'),

        // 'departuredate' => $this->input->post('departdate'),

        // 'Adults' => $this->input->post('Adults'),

        // 'Child' => $this->input->post('Child'),

        // 'Infant' => $this->input->post('Infant'),

        // 'comments' => $this->input->post('comments'),

        // 'mtype' => $this->input->post('mtype'),

        // 'nationality' => $this->input->post('nationalilty'),

        // 'Jpno' =>$this->input->post('user_jp'),

        'user_id' => $user_id,

        'agent_id' => $agent_id,

        // 'booking_date' => $this->input->post('booking_date'),

        'uniqueRefNo' => $uniqueRefNo,

        'price' =>  $total_cost,

        'tax' =>  $this->input->post('tax'),

        // 'booking_date' => $this->input->post('booking_date'),

        // 'numofpass' => $this->input->post('Adults') + $this->input->post('Child') + $this->input->post('Infant'),

        // 'Adults' => $this->input->post('Adults') ,

        // 'Child' => $this->input->post('Child') ,

        // 'Infant' => $this->input->post('Infant') ,



        );

        $this->Holiday_Model->hol_pac_req($pck_ins);  

      // $sent_to = 'holidays@forvoltravel.com';

      $sent_to = 'ann@travelpd.com';

      $subject = 'Bizzmirth Holiday Enquiry';

      $data = array(

        'holiday_id'=> $h_id,

        'holiday_name'=> $holiday_name,

        'user_name'=> $name,

        'user_email'=> $email,

        'user_mobileno'=> $contact_number,

        'user_city'=> $city,

        'status' => 0

      );

       // echo '<pre/>';print_r($data);exit;

      $this->Holiday_Model->insert_holiday_enquiry($data);

      $data_enquiry = array(

        'subject'  =>  $subject,

        'name' => $this->input->post('name'),

        'email' => $this->input->post('email'),

        'contact_number' => $this->input->post('contact_number'),

        'city' => $this->input->post('city'),

        'to'=> $sent_to

      );

      // echo '<pre/>';print_r($data_enquiry);exit;



      $this->load->module('home/sendemail');

      if($this->sendemail->send_holi_enquiry($data_enquiry)==true) {

     

          echo json_encode( array('message' => "Thank you for your interest in our holiday packages. Our expert will get in touch with you shortly.",'name' => $this->input->post('name')));

   

        }else{

          echo json_encode( array('message' => "Thank you for your interest in our Corporate Travel solutions. Our travel expert will get in touch with you shortly.",'name' => $this->input->post('name')));

        }

    } 

     function generateRandomString($length = 10) {

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210ZYXWVUTSRQPONMLKJIHGFEDCBA';

        $randomString = '';

        for ($i = 0; $i < $length; $i++) {

            $randomString .= $characters[rand(0, strlen($characters) - 1)];

        }

        return 'SVDAA' . $randomString;

    }    

}