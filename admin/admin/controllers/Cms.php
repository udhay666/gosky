<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Cms_Model');
        $this->load->model('Home_Model');
 $this->load->library('admin_auth');
        $this->is_admin_logged_in();
    }

    private function is_admin_logged_in() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login/index');
        }
    }

    public function index() {
        redirect('home/dashboard');
    }

    public function about_us() {
        $data['result'] = $this->Cms_Model->getcms('1');
        $this->load->view('cms/about_us', $data);
    }

    public function update_about_us() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '1'); 
        //echo $this->db->last_query();exit;
        redirect('cms/about_us');
    }

    public function contact_us() {
        $data['result'] = $this->Cms_Model->getcms('6');
        $this->load->view('cms/contact_us', $data);
    }

    public function update_contact_us() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '6'); //echo $this->db->last_query();exit;
        redirect('cms/contact_us');
    }

    public function privacy_statement() {
        $data['result'] = $this->Cms_Model->getcms('10');
        $this->load->view('cms/privacy_statement', $data);
    }

    public function update_privacy_statement() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '10'); //echo $this->db->last_query();exit;
        redirect('cms/privacy_statement');
    }
    
    public function price_details() {
        $data['result'] = $this->Cms_Model->getcms('23');
        $this->load->view('cms/price_details', $data);
    }

    public function update_price_details() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '23'); //echo $this->db->last_query();exit;
        redirect('cms/price_details');
    }

    public function career() {
        $data['result'] = $this->Cms_Model->getcms('2');
        $this->load->view('cms/career', $data);
    }

    public function update_career() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '2'); //echo $this->db->last_query();exit;
        redirect('cms/career');
    }

    public function secured_payment() {
        $data['result'] = $this->Cms_Model->getcms('5');
        $this->load->view('cms/secured_payment', $data);
    }

    public function update_secured_payment() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '5'); //echo $this->db->last_query();exit;
        redirect('cms/secured_payment');
    }

    public function terms_condition() {
        $data['result'] = $this->Cms_Model->getcms('11');
        $this->load->view('cms/termscondition', $data);
    }

    public function update_terms_condition() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '11'); //echo $this->db->last_query();exit;
        redirect('cms/terms_condition');
    }

    public function useragreement() {
        $data['result'] = $this->Cms_Model->getcms('7');
        $this->load->view('cms/useragreement', $data);
    }

    public function update_useragreement() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '7'); //echo $this->db->last_query();exit;
        redirect('cms/useragreement');
    }

    public function faq() {
        $data['result'] = $this->Cms_Model->getcms('8');
        $this->load->view('cms/faq', $data);
    }

    public function update_faq() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '8'); //echo $this->db->last_query();exit;
        redirect('cms/faq');
    }
    public function support() {
        $data['result'] = $this->Cms_Model->getcms('7');
        $this->load->view('cms/support', $data);
    }

    public function update_support() {
        // $name = 'Support';
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '7'); //echo $this->db->last_query();exit;
        redirect('cms/support');
    }

    public function BoardofDirectors() {
        $data['result'] = $this->Cms_Model->getcms('9');
        $this->load->view('cms/boardofdirectors', $data);
    }

    public function update_BoardofDirectors() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '9'); //echo $this->db->last_query();exit;
        redirect('cms/BoardofDirectors');
    }

    public function security_policy() {
        $data['result'] = $this->Cms_Model->getcms('10');
        $this->load->view('cms/security_policy', $data);
    }

    public function update_security_policy() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '10'); //echo $this->db->last_query();exit;
        redirect('cms/security_policy');
    }

    public function fare_rules() {
        $data['result'] = $this->Cms_Model->getcms('11');
        $this->load->view('cms/fare_rules', $data);
    }

    public function update_fare_rules() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '11'); //echo $this->db->last_query();exit;
        redirect('cms/fare_rules');
    }

    //blogs
    public function blogs(){
    $data['result']=$this->Cms_Model->getblogs('12');
    //print_r($data['result']);exit;
    $this->load->view('cms/blogs',$data);
    }

    public function update_blogs($id) {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '12'); //echo $this->db->last_query();exit;
        redirect('cms/blogs');
    }

    //pressRooms
    public function press_rooms(){
        $data['result']=$this->Cms_Model->getblogs('13');
        //print_r($data['result']);exit;
        $this->load->view('cms/press_rooms',$data);
    }

    public function update_press_rooms($id) {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '13'); //echo $this->db->last_query();exit;
        redirect('cms/press_rooms');
    }

    public function services() {
        $data['result'] = $this->Cms_Model->getcms('14');
        $this->load->view('cms/services', $data);
    }

    public function update_services() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '14'); //echo $this->db->last_query();exit;
        redirect('cms/services');
    }

    public function special_offers() {
        $data['result'] = $this->Cms_Model->getcms('15');
        $this->load->view('cms/special_offers', $data);
    }
    
    public function update_offers() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '15'); //echo $this->db->last_query();exit;
        redirect('cms/special_offers');
    }

    public function akbars_services() {
        $data['result'] = $this->Cms_Model->getcms('16');
        $this->load->view('cms/akbars_services', $data);
    }
    
    public function update_akbars_services() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '16'); //echo $this->db->last_query();exit;
        redirect('cms/akbars_services');
    }

    public function why_akbars() {
        $data['result'] = $this->Cms_Model->getcms('17');
        $this->load->view('cms/why_akbars', $data);
    }
    
    public function update_why_akbars() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '17'); //echo $this->db->last_query();exit;
        redirect('cms/why_akbars');
    }

    public function baggage_allowance() {
        $data['result'] = $this->Cms_Model->getcms('18');
        $this->load->view('cms/baggage_allowance', $data);
    }
    
    public function update_baggage_allowance() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '18'); //echo $this->db->last_query();exit;
        redirect('cms/baggage_allowance');
    }

    public function nearby_places() {
        $data['result'] = $this->Cms_Model->getcms('19');
        $this->load->view('cms/nearby_places', $data);
    }
    
    public function update_nearby_places() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '19'); //echo $this->db->last_query();exit;
        redirect('cms/nearby_places');
    }

    public function travel_insurance() {
        $data['result'] = $this->Cms_Model->getcms('20');
        $this->load->view('cms/travel_insurance', $data);
    }
    
    public function update_travel_insurance() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '20'); //echo $this->db->last_query();exit;
        redirect('cms/travel_insurance');
    }

    public function travel_tips() {
        $data['result'] = $this->Cms_Model->getcms('21');
        $this->load->view('cms/travel_tips', $data);
    }
    
    public function update_travel_tips() {
        $this->Cms_Model->updatecms(addslashes($this->input->post('content')), '21'); //echo $this->db->last_query();exit;
        redirect('cms/travel_tips');
    }


    public function add_image() {
        $data['get_images'] = $this->Cms_Model->get_banner_images();
//    echo '<pre/>';print_r($data['get_images']);exit;
        $this->load->view('cms/add_image', $data);
    }

    function upload_img() {

        $data['file'] = $this->input->post('file');
        $file_name = $_FILES['file']['tmp_name'];

        if (!empty($file_name)) {
            $config['upload_path'] = './banner_images/';
            $config['allowed_types'] = 'gif|jpg|png';
            //$config['overwrite'] = TRUE;
            $config['max_size'] = '0';
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $this->load->library('upload', $config);



            if (!$this->upload->do_upload('file')) {
                $error = $this->upload->display_errors();
                $data['errors'] = $error;
//echo '<pre>';print_r($data['errors']);exit;
                $this->load->view('cms/add_image', $data);
            } else {
                $upload_data = $this->upload->data();
                $image_config["image_library"] = "gd2";
                $image_config["source_image"] = $upload_data["full_path"];

                //$image_config['create_thumb'] = FALSE;
                $image_config['maintain_ratio'] = TRUE;

                $image_config['quality'] = "100%";
                $image_config['width'] = 1400;
                $image_config['height'] = 753;
                $dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
                $image_config['master_dim'] = ($dim > 0) ? "height" : "width";

                $this->load->library('image_lib');
                $this->image_lib->initialize($image_config);

                if (!$this->image_lib->resize()) {  //Resize image
                    $error = $this->upload->display_errors();
                    $data['errors'] = $error;

                    $this->load->view('cms/add_image', $data); //If error, redirect to an error page
                } else {
//                        unlink($upload_data["full_path"]);
//
//                        $image_path = base_url() . 'public/upload_files/b2b/images/' . $agent_email . '/logos/agent_logo.png';
                    $data = array('upload_data' => $this->upload->data());
                    $imagename = base_url() . 'banner_images/' . $data['upload_data']['file_name'];
//            //echo '<pre>';print_r($data['upload_data']['file_name']);exit;
                    $data['upload_data'];
                    $this->Cms_Model->add_image($imagename);
                    redirect('cms/add_image');
                }
            }
        }
    }

    public function update_img_status($img_id, $status = '') {
        //echo '<pre>';print_r($status);exit;
        $this->Cms_Model->update_status($img_id, $status);
        redirect('cms/add_image');
    }

    public function edit_banner_img($id) {
        $data['image'] = $this->Cms_Model->get_banner_img_by_id($id);
        $this->load->view('cms/edit_banner_img', $data);
    }

    function update_banner_img($id) {
        $data['image'] = $image = $this->Cms_Model->get_banner_img_by_id($id);

        $data['file'] = $this->input->post('file');
        $file_name = $_FILES['file']['tmp_name'];

        if (!empty($file_name)) {
            $config['upload_path'] = './banner_images/';
            $config['allowed_types'] = 'gif|jpg|png';
            //$config['overwrite'] = TRUE;
            $config['max_size'] = '0';
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $this->load->library('upload', $config);



            if (!$this->upload->do_upload('file')) {
                $error = $this->upload->display_errors();
                $data['errors'] = $error;
//echo '<pre>';print_r($data['errors']);exit;
                $this->load->view('cms/add_image', $data);
            } else {
                $upload_data = $this->upload->data();
                $image_config["image_library"] = "gd2";
                $image_config["source_image"] = $upload_data["full_path"];
//echo '<pre>';print_r($upload_data);exit;
                //$image_config['create_thumb'] = FALSE;
                $image_config['maintain_ratio'] = TRUE;

                $image_config['quality'] = "100%";
                $image_config['width'] = 1400;
                $image_config['height'] = 753;
                $dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
                $image_config['master_dim'] = ($dim > 0) ? "height" : "width";

                $this->load->library('image_lib');
                $this->image_lib->initialize($image_config);

                if (!$this->image_lib->resize()) {  //Resize image
                    $error = $this->upload->display_errors();
                    $data['errors'] = $error;

                    $this->load->view('cms/add_image', $data); //If error, redirect to an error page
                } else {
//                        unlink($upload_data["full_path"]);
//
//                        $image_path = base_url() . 'public/upload_files/b2b/images/' . $agent_email . '/logos/agent_logo.png';
                    $data = array('upload_data' => $this->upload->data());
                    $imagename = base_url() . 'banner_images/' . $data['upload_data']['file_name'];
//            //echo '<pre>';print_r($data['upload_data']['file_name']);exit;
                    $data['upload_data'];
                }
            }
        } else {
            $imagename = $image->image_path;
        }
        $this->Cms_Model->update_img($imagename, $id);
        redirect('cms/add_image');
    }

    function imageup() {
        $this->load->library('upload'); // Load Library
        $this->upload->initialize(array(
            "upload_path" => "/path/to/upload/to/"
        ));

        //Perform upload.
        if ($this->upload->do_multi_upload('files')) {

            echo 'sadsadsd';
            //Code to run upon successful upload.
        }
    }

    public function testimonials() {
        $data['result'] = $this->Cms_Model->getcms_test(); //echo $this->db->last_query();exit;
        //echo '<pre>00000';print_r($data['result']);exit;
        $this->load->view('cms/testimonials', $data);
    }
    public function reviews() {
        $data['result'] = $this->Cms_Model->getcms_reviews(); //echo $this->db->last_query();exit;
        //echo '<pre>00000';print_r($data['result']);exit;
        $this->load->view('cms/reviews', $data);
    }


	//feed back
	public function feedback(){
	$data['result']=$this->Cms_Model->getcms_feedback();
	$this->load->view('cms/feedback',$data);
	}
	public function add_feedback() {

        $author = addslashes($this->input->post('Author'));
		$content = addslashes($this->input->post('test'));


        $this->Cms_Model->addcmsfeedback($content,$author); //echo $this->db->last_query();exit;
        redirect('cms/feedback');
    }
	public function del_feedback($id) {
        $this->Cms_Model->del_cms_test($id);
        redirect('cms/feedback');
    }
	//Blogs


//Testimonials
    public function add_test() {

        $author = addslashes($this->input->post('Author'));
		$content = addslashes($this->input->post('test'));

        $thumbfileTime = '';
        if ($_FILES['file']['name'] != "") {

            $dir = "../admin/test_profile_img/";
            $thumbfileTime = time() . $_FILES['file']['name'];
            copy($_FILES['file']['tmp_name'], $dir . $thumbfileTime);
        }
        $this->Cms_Model->addcmstest($content, $thumbfileTime,$author); //echo $this->db->last_query();exit;
        redirect('cms/testimonials');
    }

    public function edit_test($id) {
        $data['result'] = $this->Cms_Model->edit_cms_test($id); //echo $this->db->last_query();exit;
        //echo '<pre>00000';print_r($data['result']);exit;
        $this->load->view('cms/edit_test', $data);
    }

    public function update_test() {
        $id = $_POST['cms_id'];
        $result = $this->Cms_Model->edit_cms_test($id);
        $content = addslashes($this->input->post('test'));
		$author = addslashes($this->input->post('Author'));

        $thumbfileTime = '';
        if ($_FILES['file']['name'] != "") {
            $dir = "test_profile_img/";
            $thumbfileTime = time() . $_FILES['file']['name'];
            copy($_FILES['file']['tmp_name'], $dir . $thumbfileTime);
        } else {
            $thumbfileTime = $result->profile_img;
            // echo '<pre>'; print_r($thumbfiletime);
        }
        $this->Cms_Model->updatecmstest($id, $content,$author,$thumbfileTime); //echo $this->db->last_query();exit;
        redirect('cms/testimonials');
    }

    public function del_test($id) {
        $this->Cms_Model->del_cms_test($id);
        redirect('cms/testimonials');
    }
 public function del_reviews($id) {
        $this->Cms_Model->del_cms_test($id);
        redirect('cms/reviews');
    }



    public function view_notice_page() {
        $data['notice'] = $this->Cms_Model->get_notice();
        $data['agent'] = $this->Cms_Model->get_active_agents();
        $this->load->view('cms/notice', $data);
    }

    public function add_notice() {
       //echo '<pre>';
        //print_r($_POST);
        //exit;
        $agent_list = $this->input->post('agent_list');

        $notice = addslashes($this->input->post('notice_msg'));

        if ($agent_list[0] == 'all') {

            $this->Cms_Model->delete_notice();
			$agent = $this->Cms_Model->get_active_agents();
			//echo '<pre>';print_r($agent);exit;
            for ($i = 0; $i < count($agent); $i++) {
                $this->Cms_Model->add_notice($agent[$i]->agent_no, $notice);
            }
        } elseif ($agent_list[0] != 'all') {
	//echo '<pre>';print_r('entere');
	//echo '<pre>';print_r($agent_list);exit;
            for ($i = 0; $i < count($agent_list); $i++) {
                $this->Cms_Model->delete_by_agent($agent_list[$i]);
                $this->Cms_Model->add_notice($agent_list[$i], $notice);
            }
        }
        //echo $this->db->last_query();exit;
        redirect('cms/view_notice_page');
    }
    public function update_notice_status($agent_no,$status){
        $this->Cms_Model->update_notice_status($agent_no,$status);
         redirect('cms/view_notice_page');
    }

    function manage_review_status()
	{echo "<pre/>";print_r($_POST);
		if(isset($_POST['user_id']) && isset($_POST['status']))
		{
			$user_id = $_POST['user_id'];
			$status = $_POST['status'];
			$update = $this->Cms_Model->manage_review_status($user_id,$status);
                          $data['user_info'] = $user_info = $this->B2c_Model->get_user_info_by_id($user_id);
           // echo '<pre>';print_r($user_info);exit;
            if ($status == 1) {
                $stat_msg = 'Activated';
            } elseif ($status == 0) {
                $stat_msg = 'De-activated';
            } else {
                $stat_msg = 'Blocked/Deleted';
            }

			echo $update;
		}
		else
		{
			return false;
		}

	}
        public function edit_hotels(){
        //echo 889;exit;
            $this->load->view('cms/edit_hotels');

        }
       public function hotels_city_list() {
        if (isset($_GET['term'])) {
		//print_r($_GET['term']);
            $return_arr = array();
            $search = $_GET["term"];
            $city_list = $this->Cms_Model->get_all_city_list($search);
		//print_r($city_list);exit;

            if (!empty($city_list)) {
                for ($i = 0; $i < count($city_list); $i++) {
                    $city = $city_list[$i]['city_name'] . ', ' . $city_list[$i]['country_name'].'('.$city_list[$i]['id'];
                    $cityid = $city_list[$i]['id'];

                    $return_arr[] = array(
                        'label' => ucfirst($city),
                        'value' => ucfirst($city),
                        'id'=> $cityid
                    );
                }
            } else {
                $return_arr[] = array(
                    'label' => "No Results Found",
                    'value' => ""
                );//echo "<script>alert('Valid Destination');</script>";
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
     public function hotels_city_list_new() {
        if (isset($_GET['term'])) {
		//print_r($_GET['term']);
            $return_arr = array();
            $search = $_GET["term"];
            $hotel_name = $_GET["city_name"];
            $hotel_name = explode(",",$hotel_name);
            $city_list = $this->Cms_Model->get_all_city_list_new($search,$hotel_name[0]);
		//print_r($city_list);exit;

            if (!empty($city_list)) {
                for ($i = 0; $i < count($city_list); $i++) {
                    $city = $city_list[$i]['hotel_name'];
                    $cityid = $city_list[$i]['api_hotel_id'];
                     $api_name = $city_list[$i]['api'];
                      $address = $city_list[$i]['address'];

                    $return_arr[] = array(
                        'label' => ucfirst($city),
                        'value' => ucfirst($city),
                        'id'=> $cityid,
                        'api'=> $api_name,
                        'adress'=> $address
                    );
                }
            } else {
                $return_arr[] = array(
                    'label' => "No Results Found",
                    'value' => ""
                );//echo "<script>alert('Valid Destination');</script>";
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
    public function update_hotel_name(){
       // echo "<pre/>";print_r($_POST);exit;
        $hotel_name=$this->input->post('hotelName');
        $data['result']= $this->Cms_Model->get_matching_hotel($hotel_name);
        $this->load->view('cms/update_hotel',$data);
       /* if(!empty($_POST)){
            $hotel_name=$this->input->post('hotelName');
            $id=$this->input->post('id');
$data=array(
    'api_hotel_id' => $id,
    'hotel_name' =>$hotel_name



);
//$this->Cms_Model->update_all_city_list_new($data);

        }*/

    }
 public function edit_hotel_name($hotel_id){

        $data['result']= $this->Cms_Model->get_matching_hotel_name($hotel_id);
        $this->load->view('cms/update_hotel_name',$data);

    }
    public function updting_hotel_name($hotel_id){
        $hotel_name=$this->input->post('hotel');
        $this->Cms_Model->updating_hotel_name($hotel_name,$hotel_id);
    }

    public function notification(){
    $data['result']=$this->Cms_Model->get_notification();
    //print_r($data['result']);exit;
    $this->load->view('cms/notification',$data);
    } 

    public function add_notification(){
        // echo '<pre>';print_r($_POST);exit;
        $user_type = $_POST['user_type'];
        $notification = $_POST['notification'];
        $insert_data = array(
            'user_type' => $user_type,
            'notification' => $notification,
        );
        $this->Cms_Model->add_notification($insert_data);
        // echo $this->db->last_query();exit;
        redirect('cms/notification');
    }  

    public function delete_notification($id){
        $this->Cms_Model->delete_notification($id);
        echo $this->db->last_query();exit;
        redirect('cms/notification');
    }



}