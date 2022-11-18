<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage_age extends CI_CONTROLLER {

	public function __construct(){
		parent::__construct();
		$this->load->model('glb_holiday_travellers_age');
		$this->load->model('glb_holiday_travellers_type');

	}

	public function travellers_age(){
		$data['age_list'] = $this->glb_holiday_travellers_age->get_age();
		// echo '<pre>';print_r($data['age_list']);exit;
		$data['sub_view'] = 'manageholidays/travellers_age';
		$this->load->view('_layout_main',$data); 
    }

    public function add_age(){
    	 // print_r($_POST);//exit;
    	$data = array(
    		'age' =>  $_POST['age'],
    		'status' => 1,
    	);
    	$this->glb_holiday_travellers_age->add_age($data);
    	// echo $this->db->last_query();exit;
    	redirect('manage_age/travellers_age');
    }

    public function edit_age($id){
    	$data['age_list'] = $this->glb_holiday_travellers_age->getAgeById($id);
    	 // print_r($data['age_list']);exit;
    	$data['sub_view'] = 'manageholidays/edit_traveller_age';
    	$this->load->view('_layout_main',$data);
    }

    public function update_age(){
    	// print_r($_POST);
    	$id = $this->input->post('id');
    	$data = array(
    		'age' => $_POST['age'],
    		'date_time' => date('Y-m-d H:i:s'),
    	);
    	// print_r($data);exit;
    	$this->glb_holiday_travellers_age->updateAge($id,$data);
    	redirect('manage_age/travellers_age');
    }

    function update_Age_status(){
        if(isset($_GET['status'])){
            $up_status = $this->glb_holiday_travellers_age->update_Age_status();
            if($up_status > 0){
                $this->session->set_flashdata('message',"Age status Activated successfully");
            }else { 
                $this->session->set_flashdata('message',"Age status De-activated successfully");

            }
        }
         // $this->B2b_Model->update_status($city_id,$data);
        redirect('manage_age/travellers_age');
    }

    function travellers_type(){
    	$data['type_list'] = $this->glb_holiday_travellers_type->get_type();
          // print_r($data['type_list']);//exit;
    	$data['sub_view'] = 'manageholidays/trip_type';
		$this->load->view('_layout_main',$data); 
    }

    public function add_type(){
    	  // print_r($_POST);//exit;
    	$data = array(
            'trip_group' =>  $_POST['trip_group'],
    		'type' =>  $_POST['type'],
    		'status' => 1,
            'date_time' => date('Y-m-d H:i:s'),
    	);

        if($this->glb_holiday_travellers_type->add_type($data)){
            $this->session->set_flashdata('message',"Type added successfully");
        } else { 
            $this->session->set_flashdata('errors_msg',"Addition failed. Please try later");
        }
    	 // echo $this->db->last_query();exit;
    	redirect('manage_age/travellers_type');
    }

    public function edit_type($id){
    	$data['type_list'] = $this->glb_holiday_travellers_type->getTypeById($id);
    	 // print_r($data['age_list']);exit;
    	$data['sub_view'] = 'manageholidays/edit_traveller_type';
    	$this->load->view('_layout_main',$data);
    }

    public function update_type(){
    	// print_r($_POST);
    	$id = $this->input->post('id');
    	$data = array(
            'trip_group' => $_POST['trip_group'],
    		'type' => $_POST['type'],
    		'date_time' => date('Y-m-d H:i:s'),
    	);
    	// print_r($data);exit;
    	
        if($this->glb_holiday_travellers_type->updateType($id,$data)){
            $this->session->set_flashdata('message',"Type updated successfully");
        } else { 
            $this->session->set_flashdata('errors_msg',"Updation failed. Please try later");
        }
    	redirect('manage_age/travellers_type');
    }

    function update_type_status(){
        if(isset($_GET['status'])){
            $up_status = $this->glb_holiday_travellers_type->update_Type_status();
            if($up_status > 0){
                $this->session->set_flashdata('message',"Type status Activated successfully");
            }else { 
                $this->session->set_flashdata('message',"Type status De-activated successfully");
            }
        }
         // $this->B2b_Model->update_status($city_id,$data);
        redirect('manage_age/travellers_type');
    }

    function delete($id){
        if(!empty($id)){
            $table = 'travelers_type';
            $primaryid = 'id';
            $del_status = $this->glb_holiday_travellers_type->delete($table,$primaryid,$id);
            if($del_status){
                $this->session->set_flashdata('message',"Deleted");
            }else { 
                $this->session->set_flashdata('errors_msg',"Please try later");
            }
        } else {
            $this->session->set_flashdata('errors_msg',"Please try later");
        }
        redirect('manage_age/travellers_type');
    }


}

?>