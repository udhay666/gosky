<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class promotions extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Promotion_Model');
        $this->load->database();
        $this->load->library('admin_auth');
        $this->load->library('upload');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
    }

    public function create_promo() {
        $this->form_validation->set_rules('promo_name', 'promo_name', 'trim|required');
        $this->form_validation->set_rules('promo_url', 'promo_url', 'trim|required');
        $this->form_validation->set_rules('promo_img', 'promo_img');
		$this->form_validation->set_rules('promo_description', 'promo_description', 'trim|required');
		$this->form_validation->set_rules('promo_type', 'promo_type');

        $promo_name = $this->input->post('promo_name');
        $promo_url = $this->input->post('promo_url');
        $promo_img = $this->input->post('promo_img');
		$promo_description = $this->input->post('promo_description');
		$promo_type = $this->input->post('promo_type');


        if ($this->form_validation->run() == FALSE) {
            $data['promo_name'] = $this->input->post('promo_name');
            $data['promo_url'] = $this->input->post('promo_url');
            $data['promo_img'] = $this->input->post('promo_img');
			$data['promo_description'] = $this->input->post('promo_description');
			$data['promo_type'] = $this->input->post('promo_type');

            $this->load->view('promotions/promotions', $data);
        } else {

            $insert_id = $this->Promotion_Model->create_promotion($promo_name, $promo_url, $promo_description, $promo_type );

            $this->upload_image($insert_id);
            redirect('promotions/promo_list', 'refresh');
        }
    }

    public function upload_image($insert_id) { //echo $insert_id;
        $config['upload_path'] = 'public/upload_files/promotion/' . $insert_id . '/';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }

        if (!$this->upload->do_upload('promo_img')) {
            $error = $this->upload->display_errors();
            $data['errors'] = $error;

            $this->load->view('promotions/promotions', $data);
        } else {
            $promotion = $this->Promotion_Model->get_promo_info_by_id($insert_id);
            if (!empty($promotion->promo_img)) {
                unlink($promotion->promo_img);
            }

            $upload_data = $this->upload->data();
            $file_name = $upload_data["file_name"];
            $source_image = 'public/upload_files/promotion/' . $insert_id . '/' . $file_name;

            $this->Promotion_Model->update_promo_img($insert_id, $source_image);
//            echo $this->db->last_query();exit;
        }
    }

    public function promotions_list() {

        $this->load->view('promotions/promotions', $data);
    }

    public function promo_list() {

        $data['promotion'] = $this->Promotion_Model->get_promo_list();
        $this->load->view('promotions/promotion_list', $data);
    }

    //edit promotion details
    public function edit_promo($id) {
        $data['promotion'] = $this->Promotion_Model->get_promo_listid($id);
        $this->load->view('promotions/edit_promotion', $data);
    }

    function update_promo_info() {
        $this->form_validation->set_rules('promo_name', 'promo_name');
        $this->form_validation->set_rules('promo_url', 'promo_url');

        $data['id'] = $id = $this->input->post('id');
        $data['promotion'] = $this->Promotion_Model->get_promo_info_by_id($id);

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('promotion/promo_list', $data);
        } else {
            $id = $this->input->post('id');
            $promo_name = $this->input->post('promo_name');
            $promo_url = $this->input->post('promo_url');
            $this->upload_image($id);

            $update = array(
                'promo_name' => $promo_name,
                'promo_url' => $promo_url,
            );
            $this->db->where('id', $id);
            $this->db->update('promotion', $update);
            redirect('promotions/promo_list/', 'refresh');
        }
    }

    function delete_promo_id($id) {
        $promotion = $this->Promotion_Model->get_promo_info_by_id($id);
        if (!empty($promotion->promo_img)) {
            unlink($promotion->promo_img);
            $path = 'public/upload_files/promotion/' . $id . '/';
            if (!rmdir($path)) {
                echo ("Could not remove" . $path);
            }
        }
        $data = $this->Promotion_Model->delete_promo_id($id);
        redirect('promotions/promo_list/' . $data . '');
    }



  function create_offer() {//echo 11;exit;
        $this->form_validation->set_rules('about_offers', 'about_offers', 'trim|required');
        $this->form_validation->set_rules('terms_conditions', 'terms_conditions', 'trim|required');
        $this->form_validation->set_rules('service_type', 'service_type');
		
		$about_offers = $this->input->post('about_offers');
        $terms_conditions = $this->input->post('terms_conditions');
        $service_type = $this->input->post('service_type');
		
		
		if ($this->form_validation->run() == FALSE) {
            $data['about_offers'] = $this->input->post('about_offers');
            $data['terms_conditions'] = $this->input->post('terms_conditions');
            $data['service_type'] = $this->input->post('service_type');//echo 1;exit;
		
            $this->load->view('promotions/add_offer_details', $data);
        } else {
		$about_offers = $this->input->post('about_offers');
        $terms_conditions = $this->input->post('terms_conditions');
        $service_type = $this->input->post('service_type');
		
		$this->Promotion_Model->add_offer();
		
	//	echo '<pre/>';print_r($_POST);exit;	

           $this->Promotion_Model->create_offer($about_offers, $terms_conditions, $service_type);

            redirect('promotions/add_offer_details', 'refresh');
        }
  }
		
		function add_offer_details()
		{	
		$about_offers = $this->input->post('about_offers');
        $terms_conditions = $this->input->post('terms_conditions');
        $service_type = $this->input->post('service_type');
			//echo '<pre/>';print_r($_POST);exit;	
			
			
			$this->Promotion_Model->add_offers($about_offers, $terms_conditions, $service_type);
			redirect('promotions/offer_list', 'refresh');
		
		}
			
		function offer_list(){
			//$data['about_offers'] = $this->Promotion_Model->get_promo_list();
			$this->load->view('promotions/add_offer_details', $data);
		}

	
	  function add_offer_list() {echo 1;

      //  $data['about_offers'] = $this->Promotion_Model->get_promo_list();
        $this->load->view('promotions/add_offer_details', $data);
    }
	
	 public function offers_details() {

        $data['about_offers'] = $this->Promotion_Model->get_offer_list();
        $this->load->view('promotions/offers_details', $data);
    }
	
	
	
	 //edit offers details
    public function edit_offers($id) {
        $data['about_offers'] = $this->Promotion_Model->get_offer_list_id($id);
	//echo "<pre/>";	print_r($data);exit;
        $this->load->view('promotions/edit_offers', $data);
    }
	
	function update_offers() {
		$this->form_validation->set_rules('id', 'id');
        $this->form_validation->set_rules('about_offers', 'about_offers');
        $this->form_validation->set_rules('terms_conditions', 'terms_conditions');
		$this->form_validation->set_rules('service_type', 'service_type');

        $id = $this->input->post('id');
        $data['about_offers'] = $this->Promotion_Model->get_offer_info_by_id($id);

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('promotion/offers_details', $data);
        } else {
            $id = $this->input->post('id');
            $about_offers = $this->input->post('about_offers');
            $terms_conditions = $this->input->post('terms_conditions');
			$service_type = $this->input->post('service_type');
            //echo '<pre/>';print_r($_POST);exit;

            $update = array(
                'about_offers' => $about_offers,
                'terms_conditions' => $terms_conditions,
				'service_type' => $service_type,
            );
            $this->db->where('id', $id);
            $this->db->update('about_offers', $update);
            redirect('promotions/offers_details/', 'refresh');
        }
    }
	
	function delete_offer_id($id) {
        $promotion = $this->Promotion_Model->get_offer_info_by_id($id);
       $data = $this->Promotion_Model->delete_offer_id($id);
        redirect('promotions/offers_details/' . $data . '');
    }
}

?>
