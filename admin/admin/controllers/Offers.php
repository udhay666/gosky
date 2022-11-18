<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Offers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('offer_model');
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
        // $this->load->view('offers/add_offers');
        redirect('home/dashboard');
    }
    public function best_hotel_images(){
       $data['best_hotel_list'] =  $this->offer_model->get_best_hotel();
        
       // echo '<pre/>';print_r($data['country_list']);exit;
        $this->load->view('offers/best_hotel_images',$data);
    }
    
    public function best_offers_images(){
       $data['best_offers_list'] =  $this->offer_model->get_best_offers();
        
       // echo '<pre/>';print_r($data['country_list']);exit;
        $this->load->view('offers/best_offers_images',$data);
    }
    
    public function holiday_images(){
        // echo 123;exit;
        $data['holiday_list'] =  $this->offer_model->get_holiday();
        $data['country_list'] =  $this->offer_model->get_country();
        //$data['trending_image_list'] =  $this->popular_model->get_country();
       // echo '<pre/>';print_r($data['country_list']);exit;
        $this->load->view('offers/holiday_images',$data);
    }
    
    public function insert_offers_images(){
         // echo '<pre/>';print_r($_FILES);exit;
         //echo '<pre/>';print_r($_POST);exit;
        $data = array(
            'status' => '1'
        );
        $this->offer_model->add_best_offers($data);
        //echo $this->db->last_query();exit;
        $id = $this->db->insert_id();
        $this->offers_upload_images($id);
        $this->session->set_flashdata('message','Best Offers Images Added Successfully!');
        // echo $this->db->last_query();exit;
        //echo '<pre/>';print_r($id);exit;
        redirect('offers/best_offers_images');
        
    }
   
   
    public function insert_best_hotel_images(){
         // echo '<pre/>';print_r($_FILES);exit;
         //echo '<pre/>';print_r($_POST);exit;
        $data = array(
            'status' => '1'
        );
        $this->offer_model->add_best_hotel($data);
        //echo $this->db->last_query();exit;
        $id = $this->db->insert_id();
        $this->hotel_upload_images($id);
        $this->session->set_flashdata('message','Best Hotel Images Added Successfully!');
        // echo $this->db->last_query();exit;
        //echo '<pre/>';print_r($id);exit;
        redirect('offers/best_hotel_images');
        
    }
    
    public function insert_best_offers_images(){
         // echo '<pre/>';print_r($_FILES);exit;
         //echo '<pre/>';print_r($_POST);exit;
        $data = array(
            'status' => '1'
        );
        $this->offer_model->add_best_offers($data);
        //echo $this->db->last_query();exit;
        $id = $this->db->insert_id();
        $this->offers_upload_images($id);
        $this->session->set_flashdata('message','Best Offers Images Added Successfully!');
        // echo $this->db->last_query();exit;
        //echo '<pre/>';print_r($id);exit;
        redirect('offers/best_offers_images');
        
    }
      public function insert_holiday_images(){
         // echo '<pre/>';print_r($_FILES);exit;
         // echo '<pre/>';print_r($_POST);exit;
        $country = $_POST['country'];
        $data = array(
            'country'=> $country,
            'status' => '1'
        );
        $this->offer_model->add_holiday_images($data);
        //echo $this->db->last_query();exit;
        $id = $this->db->insert_id();
        $this->holiday_upload_images($id);
        //$this->upload_multiple_images($id);
        $this->session->set_flashdata('message','Holiday Image Added Successfully!');
        // echo $this->db->last_query();exit;
        //echo '<pre/>';print_r($id);exit;
        redirect('offers/holiday_images');
        
    }
    public function hotel_upload_images($id) {

        //Image Size    
        //$image_size = $this->config->item('image_sizes');

        //Upload Configuration Image
        $config['upload_path'] = './besthotelimages/' . $id . '/thumbnail/';
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
        $imagepath = 'besthotelimages/' . $id . '/thumbnail/' . $fileData['file_name'];          
        $this->offer_model->upload_trending_img($id, $imagepath);
    }
      public function holiday_upload_images($id) {

        //Image Size    
        //$image_size = $this->config->item('image_sizes');

        //Upload Configuration Image
        $config['upload_path'] = './holidayimages/' . $id . '/thumbnail/';
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
        $imagepath = 'holidayimages/' . $id . '/thumbnail/' . $fileData['file_name'];          
        $this->offer_model->upload_holiday_images($id, $imagepath);
    }
    
    public function offers_upload_images($id) {

        //Image Size    
        //$image_size = $this->config->item('image_sizes');

        //Upload Configuration Image
        $config['upload_path'] = './bestoffersimages/' . $id . '/thumbnail/';
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
        $imagepath = 'bestoffersimages/' . $id . '/thumbnail/' . $fileData['file_name'];          
        $this->offer_model->upload_offers_img($id, $imagepath);
    }
   
    public function upload_images($id) {
        // echo '<pre/>';print_r($_FILES);exit;
        //Image Size    
        $image_size = $this->config->item('image_sizes');

        //Upload Configuration Image
        $config['upload_path'] = './bookedhotelimages/' . $id . '/thumbnail/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        // $config['max_size'] =  $this->max_image_size;
        // $config['max_width'] =  $this->max_image_width;
        // $config['max_height'] = $this->max_image_height;      
        // $config['resize'] = true;
        $config['rename'] = true;
        $config['image_sizes'] = $image_size;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        $this->load->library("Multifile_Upload", $config);
        $this->Multifile_Upload = new Multifile_Upload;
        $this->Multifile_Upload->initialize($config);
        $this->Multifile_Upload->set_allowed_types('gif|jpg|png|jpeg');
        $this->Multifile_Upload->do_upload('thumb_image');

        //Insert Image Path into table
        foreach ($this->Multifile_Upload->saved_filename as $imgfile) {
            $imagepath = 'bookedhotelimages/' . $id . '/thumbnail/' . $imgfile;

            $this->popular_model->upload_images($id, $imagepath, 1);
        }

        //Upload Configuration Gallery
        $config1['upload_path'] = './bookedhotelimages/' . $id . '/gallery/';
        $config1['allowed_types'] = 'gif|jpg|png|jpeg';
        // $config1['max_size'] = $this->max_image_size;
        // $config1['max_width'] = $this->max_image_width;
        //$config1['max_height'] = $this->max_image_height;
        // $config1['resize'] = true;
        $config1['rename'] = true;
        $config1['image_sizes'] = $image_size;

        if (!is_dir($config1['upload_path'])) {
            mkdir($config1['upload_path'], 0755, TRUE);
        }


        $this->Multifile_Upload->initialize($config1);
        $this->Multifile_Upload->set_allowed_types('gif|jpg|png|jpeg');
        $this->Multifile_Upload->do_multi_upload('gallery');

        //Insert Image Path into table       
        foreach ($this->Multifile_Upload->saved_filename as $imgfile) {
            $imagepath = 'bookedhotelimages/' . $id . '/gallery/' . $imgfile;

            $this->popular_model->upload_images($id, $imagepath, 2);
        }
       
    }
    public function holiday_active($hol_id,$id){
        $this->offer_model->package_active($hol_id,$id);
        redirect('offers/holiday_images','refresh');
    }
      public function hotel_active($hol_id,$id){
        $this->offer_model->hotel_active($hol_id,$id);
        redirect('offers/best_hotel_images','refresh');
    }
     public function offers_active($hol_id,$id){
        $this->offer_model->offers_active($hol_id,$id);
        redirect('offers/best_offers_images','refresh');
    }
    public function edit_popular($id){
        $data['country_list'] =  $this->popular_model->get_country();
        $data['popular'] = $this->popular_model->get_popular_by_id($id);
         //echo '<pre/>';print_r($data['popular']);exit;
        $this->load->view('popular/edit_popular', $data);
       

    }
    public function update_popular(){
        // echo '<pre/>';print_r($_POST);exit;
        $id = $_POST['id'];
        $country = $_POST['country'];
        $properties = $_POST['properties'];
        $data = array(
            'country'=> $country,
            'properties'=> $properties,
        );
        $this->popular_model->update_popular($id,$data);
          // echo $this->db->last_query();exit;
        $this->popular_upload_images($id);
        $this->session->set_flashdata('message','Offer Updated Successfully!');
      
        // echo '<pre/>';print_r($id);exit;
        redirect('popular/add_popular');
        
    }
     public function edit_mostly_booked($id){
        $data['hotel_list'] = $this->popular_model->get_mostly_booked_id($id);
         // echo '<pre/>';print_r($data['hotel_list']);exit;
        $this->load->view('popular/edit_mostly_booked', $data);
       

    }
    public function update_mostly_booked(){
        // echo '<pre/>';print_r($_POST);exit;
        $id = $_POST['id'];
        $description = $_POST['description'];
        $properties = $_POST['properties'];
        $data = array(
            'hotel_desc'=> $description,
            'properties'=> $properties,
        );
        $this->popular_model->update_mostly_booked($id,$data);
          // echo $this->db->last_query();exit;
        $this->upload_images($id);
        $this->session->set_flashdata('message','Offer Updated Successfully!');
      
        // echo '<pre/>';print_r($id);exit;
        redirect('popular/add_mostly_booked');
        
    }

   
}