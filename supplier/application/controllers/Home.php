<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    private $supplier_id;
    /*private $max_image_size = '2000';
    private $max_image_width = '1024';
    private $max_image_height = '900';*/

    public function __construct() {
        parent::__construct();
        $this->load->database();   
        $this->load->model('supplier_info');
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        

        // $this->load->library('admin_auth');
        $this->supplier_id = $this->session->userdata('supplier_id');
        $this->is_logged_in();
    }

    public function index() {
        $data['supplier_info'] = $this->supplier_info->get($this->supplier_id);
        // echo '<pre>';print_r($data['supplier_info']);exit;
        $this->load->view('dashboard', $data);
    }

    private function is_logged_in() {
        if (!$this->session->userdata('supplier_logged_in')) {
            redirect('login/supplier_login');
        }
    }

    function dashboard() {
        $data['supplier_info'] = $this->supplier_info->get($this->supplier_id);
        // echo '<pre>';print_r($data['supplier_info']);exit;
        $this->load->view('dashboard', $data);
    }

    function my_profile() {
        $data['sub_view'] = 'account/my_profile';
        $this->load->view('_layout_main', $data);
    }

    function add_Itinerary() {
        $data['holicitylist'] = $this->supplier_info->get_all_holi_citylist();       
        
        //echo '<pre>';print_r($data['holicitylist']);exit;
        $data['sub_view'] = 'account/Itinerary';

        $this->load->view('_layout_main', $data);
    }


      function activity_list() {
        $data['activitylist'] = $this->supplier_info->get_activitylist();       
        
        //echo '<pre>';print_r($data['holicitylist']);exit;
        $data['sub_view'] = 'account/activity_list';

        $this->load->view('_layout_main', $data);
    }


    public function set_status($id,$status) {
        $data = array(
            'status' => $status,          
        );
        $this->supplier_info->set_status($data,$id);
       if($status == 1){
            $msg = '<label class="label label-success">Active</label>';
        } else {
            $msg = '<label class="label label-danger">Inactive</label>';
        }
        $this->session->set_flashdata('message','Activity is now '.$msg);
        redirect('home/activity_list', 'refresh'); 
    }
    
     public function upload_images($id) {

        //Image Size    
        //$image_size = $this->config->item('image_sizes');

        //Upload Configuration Image
        $config['upload_path'] = './activityimages/' . $id . '/thumbnail/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        
        $config['rename'] = true;
        $config['image_sizes'] = $image_size;

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }

       
        $this->upload->initialize($config);         

        $this->upload->set_allowed_types('gif|jpg|png|jpeg');

        $this->upload->do_upload('thumb_image');
        $fileData = $this->upload->data();
        $imagepath = 'activityimages/' . $id . '/thumbnail/' . $fileData['file_name'];          
        $this->supplier_info->upload_trending_img($id, $imagepath);

      
       /* if(!empty($_FILES['upload_Files'])){

            $config['upload_path'] = './activityimages/' . $id . '/gallery/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $config['rename'] = true;
            $config['image_sizes'] = $image_size;

            if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
            }


            $this->upload->initialize($config);       

            $this->upload->set_allowed_types('gif|jpg|png|jpeg');

            $this->upload->do_upload('upload_Files');
            $fileData = $this->upload->data();
          
       
            $filesCount = count($_FILES['upload_Files']['name']);
            for($i = 0; $i < $filesCount; $i++){ 
                $fileData[] = $this->upload->data();             
            
                 $imagepath = 'activityimages/' . $id . '/gallery/' . $_FILES['upload_Files']['name'][$i];
            
                  $this->supplier_info->upload_images($id, $imagepath, 2);
            
            } 
            
        }*/
        
     
    }

    public function upload_multiple_images($id) {

       
       if(!empty($_FILES['files'])){


       $data = [];

      $count = count($_FILES['files']['name']);
 
      for($i=0;$i<$count;$i++){
 
        if(!empty($_FILES['files']['name'][$i])){
 
          $_FILES['file']['name'] = $_FILES['files']['name'][$i];
          $_FILES['file']['type'] = $_FILES['files']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['files']['error'][$i];
          $_FILES['file']['size'] = $_FILES['files']['size'][$i];

          $config['upload_path'] = './activityimages/' . $id . '/gallery/'; 
         
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
         //$config['max_size'] = '5000'; // max_size in kb
          $config['file_name'] = $_FILES['files']['name'][$i];

            if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
            }
             $this->upload->initialize($config); 
            $this->load->library('upload',$config); 
 
          if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];

            $data['totalFiles'][] = $filename;
            $imagepath = 'activityimages/' . $id . '/gallery/' . $_FILES['files']['name'][$i];
            $this->supplier_info->upload_images($id, $imagepath, 2);
          }
        }
 
      }

      
   }

    }


    function edit_profile() {
        $data['sub_view'] = 'account/my_profile';
        $this->load->view('_layout_main',$data);
    }
    function my_act_summary() {
        //  echo 'entered';exit;
        // $data['admin_act_summary'] = $this->Home_Model->get_admin_act_summary();
        $this->load->view('account/my_act_summary', $data);
    }

    function update_profile() {
        $this->form_validation->set_rules('login_email', 'Email-Id', 'trim|required|valid_email');
        $this->form_validation->set_rules('supplier_no', 'Supplier No', 'trim|required');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('pin_code', 'Pin Code', 'trim|required|integer|min_length[6]');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
           $data['sub_view'] = 'account/my_profile';
           $data['error'] = validation_errors();
           $this->load->view('_layout_main', $data);
        } else {
            // echo '<pre/>';print_r($_POST);exit;
            $update_data = array(
                'supplier_email' => $this->input->post('login_email'),
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
            );
            if ($this->supplier_info->update($update_data, $this->supplier_id)) {
                $this->session->set_flashdata('message','Profile Updated successfully!');
                redirect('home/my_profile/' . $this->supplier_id, 'refresh');
            } else {
                $this->session->set_flashdata('message','Profile info not updated!');
                redirect('home/my_profile/' . $this->supplier_id, $data);
            }
        }
    }

    function add_activity() {
            $pickupdate=  $this->input->post('checkIn');
            $dropdate = $this->input->post('checkOut');
            $date = explode("/", $pickupdate);
            $e_date = explode("/", $dropdate);
            $new_date = $date[2]."-".$date[0]."-".$date[1];
            $new_end_date = $e_date[2]."-".$e_date[0]."-".$e_date[1];
        
            $insert_data = array(
                'package_title' => $this->input->post('package_title'),
                'destination' => $this->input->post('desti'),
                'package_rating' => $this->input->post('package_rating'),
                'start_date' => $new_date,
                'end_date' => $new_end_date,
                'price_ad' => $this->input->post('price_ad'),
                'hotel_pickup' => $this->input->post('pickup'),
                'package_desc' => $this->input->post('package_desc'),
                'included' => $this->input->post('included'),
                'departure' => $this->input->post('departure'),
                'expected' => $this->input->post('expected'),
                'additional' => $this->input->post('additional'),

                'cancel' => $this->input->post('cancel'),
                'reviews' => $this->input->post('reviews'),
                'terms' => $this->input->post('terms'),
                
            );
            //print_r($insert_data);
            if (!empty($insert_data)) {
                $this->supplier_info->add_activity($insert_data);
                $id = $this->db->insert_id();
                
                $this->upload_images($id);
                $this->upload_multiple_images($id);
                $this->session->set_flashdata('message','Activity Added Successfully!');
                redirect('home/add_Itinerary/', 'refresh');
            } else {
               $this->session->set_flashdata('message','Profile info not updated!');
                redirect('home/add_Itinerary/', $data);
            }
        
    }

    function change_password() {
        $this->form_validation->set_rules('cpassword', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        $data['supplier_info'] = $supplier_info = $this->supplier_info->get($this->supplier_id);

        if ($this->form_validation->run() == FALSE) {
           $data['sub_view'] = 'account/change_password';
           $data['error'] = validation_errors();
           $this->load->view('_layout_main',$data);
        } else {
            if ($supplier_info->supplier_password == md5($this->input->post('cpassword')) && $this->input->post('password') == $this->input->post('passconf')) {
                $password = md5($this->input->post('password'));

                $updata = array(
                    'supplier_password' => $password
                );
             
                if ($this->supplier_info->update($updata, $this->supplier_id)) {
                    $this->session->set_flashdata('message','Your Password Successfully Updated...!');
                } else {
                    $data['error'] = 'Your Password not Updated. Please try after some time...!';
                }
            } else {
                $data['error'] = 'Current Password is wrong. Please enter correct current password...!';
            }
            // redirect('home/update_password/' . $this->supplier_id, $data);
            $data['sub_view'] = 'account/change_password';
            $this->load->view('_layout_main',$data);
        }

       
    }

    // function update_password() {
    //     $data['sub_view'] = 'account/change_password';
    //     $this->load->view('_layout_main',$data);

    // }





}
