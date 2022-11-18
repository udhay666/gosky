<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class excursions extends CI_CONTROLLER {

private $supplier_id;
private $upload_path;
private $max_image_size = '4000';
private $max_image_width = '2024';
private $max_image_height = '2000';

function __construct() {
    parent :: __construct();
    $this->load->database();  
    $this->load->model('sup_excursions'); 
    $this->load->model('sup_excursions_category');  
    $this->load->model('sup_excursions_rate_types'); 
    $this->load->model('sup_excursion_rate');     
    $this->load->model('currency'); 
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    $url= FCPATH;
    // $url_save=str_replace('/admin/','',base_url());//exit;
    $this->supplier_id = $supplier_id = $this->session->userdata('supplier_id');
    $this->upload_path = $url.'uploads/'.$supplier_id.'/';
    $this->is_logged_in();
}
private function is_logged_in() {
    if (!$this->session->userdata('supplier_logged_in')) {
        redirect('login/supplier_login');
    }
}
public function add_excursion() {
    // $data['sub_view'] = 'excursions/add_excursion';
      $data['categories'] =$this->sup_excursions_category->get_only_supplier('*',$this->supplier_id);
      $data['currency']=$this->currency->get();
     $data['sub_view'] = 'excursions/addexcursion';
    $this->load->view('_layout_main',$data);
}

public function insert_excursion() {
    $this->form_validation->set_rules('excursion_name', 'Excursion Name', 'trim|required');
    // echo '<pre>';print_r($_POST);exit;
    if($this->form_validation->run()==FALSE) {       
        $errors_msg = validation_errors();      
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('excursions/add_excursion','refresh');
    } else {     
     $childageminlimit=$_POST['childageminlimit'];  
     $childagemaxlimit=$_POST['childagemaxlimit'];      
     $childminheightlimit=$_POST['childminheightlimit']; 
     $childmaxheightlimit=$_POST['childmaxheightlimit']; 
      for($i=0;$i<count($_POST['childageminlimit'])&&isset($_POST['childagemaxlimit'])&&isset($_POST['childminheightlimit'])&&isset($_POST['childmaxheightlimit']);$i++)
      {
        $child_age_range_and_height[$i]=$_POST['childageminlimit'][$i].'-'.$_POST['childagemaxlimit'][$i].'||'.$_POST['childminheightlimit'][$i].'-'.$_POST['childmaxheightlimit'][$i];
      } 

        $excursion_code = $this->sup_excursions->get_last_excursion_code();
        $excursion_code = str_pad($excursion_code + 1, 10, 0, STR_PAD_LEFT);   
        $insertdata=array(
            'supplier_id' =>$this->supplier_id,
            'excursion_code'=>$excursion_code,
            'excursion_name' => $this->input->post('excursion_name'),
            'excursion_category' => $this->input->post('excursion_category'),
            'country' => $this->input->post('country'),
            'cityName' => $this->input->post('cityName'),
             'city' => $this->input->post('city'),
            'cityid' => $this->input->post('cityid'),
            'star_rating' => $this->input->post('star_rating'),
            'currency' => $this->input->post('currency'),
            'child_age_range_and_height'=>json_encode($child_age_range_and_height),
            // 'child_type' => $this->input->post('child_type'),
            // 'childheightlimit' => $this->input->post('childheightlimit'),
            // 'childageminlimit' => $this->input->post('childageminlimit'),
            // 'childagemaxlimit' => $this->input->post('childagemaxlimit'),
            'excursion_type' => $this->input->post('excursion_type'),            
            'maxperson' => $this->input->post('maxperson'),
            'no_of_booking' => $this->input->post('no_of_booking'),
            'email' => stripslashes($this->input->post('email')),
            'address' => stripslashes($this->input->post('address')),
            'nearby' => stripslashes($this->input->post('nearby')),
            'contact_no' => stripslashes($this->input->post('contact_no')),       
            'overview' => stripslashes($this->input->post('overview')),
            'highlight' => stripslashes($this->input->post('highlight')),
            'inclusions' => stripslashes($this->input->post('inclusions')),
            'exclusions' => stripslashes($this->input->post('exclusions')),
            'important_info' => stripslashes($this->input->post('important_info')),
            'additional_info' => stripslashes($this->input->post('additional_info')),
            'cancellation_policy' => stripslashes($this->input->post('cancellation_policy')),
            'schedule' => stripslashes($this->input->post('schedule')),

        );
        $insert_id = $this->sup_excursions->insert($insertdata);     
        $this->session->set_flashdata('message','Excursion Added Successfully!');
        redirect('excursions/excursion_list','refresh');      

    }
}
public function insert_excursion_old() {
    $this->form_validation->set_rules('excursion_name', 'Excursion Name', 'trim|required');
    // echo '<pre>';print_r($_POST);exit;
    if($this->form_validation->run()==FALSE) {       
        $errors_msg = validation_errors();      
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('excursions/add_excursion','refresh');
    } else {   
        $insertdata=array(
            'supplier_id' =>$this->supplier_id,
            'excursion_name' => $this->input->post('excursion_name'),
            'excursion_category' => $this->input->post('excursion_category'),
            'excursion_promo' => $this->input->post('excursion_promo'),
            'excursion_desc' => $this->input->post('excursion_desc'),
            'no_of_days' => $this->input->post('no_of_days'),
            'country' => $this->input->post('country'),
        );
        $insert_id = $this->sup_excursions->insert($insertdata);
        if(!empty($insert_id)){
            $this->special_upload($insert_id, $_POST, 'insert');
        }
        $this->session->set_flashdata('message','Excursion Added Successfully!');
        redirect('excursions/excursion_list','refresh');
    }
}

public function excursion_gallery()
{
    $excursion_id=$_GET['id'];
    $data['excursion_id'] = $excursion_id = $_GET['id'];
    $data['excursion_info'] = $this->sup_excursions->get('*',$excursion_id);
    $data['gallery_img'] = $this->sup_excursions->get_gallery_images($excursion_id,'sup_excursion_images','*','sup_excursion_id');
    $data['sub_view'] = 'excursions/excursion_gallery';
    $this->load->view('_layout_main',$data);
}

public function update_excursion_image() {
    $data['excursion_id'] = $excursion_id = $_POST['id'];
    $data['excursion_info'] = $this->sup_excursions->get('*',$excursion_id);
    if(!isset($_POST['id'])) {
        redirect('excursions/excursion_list','refresh');
    }    
    if(empty($data['excursion_info'])){
        redirect('excursions/excursion_list','refresh');
    }
     if($_POST['upload_type'] == 'update'){
            $this->special_upload($excursion_id, $_POST, 'update');
        }
        $this->session->set_flashdata('message','Excursion  Gallery Updated Successfully!');
        redirect('excursions/excursion_gallery?id='.$excursion_id,'refresh');
 
}

public function edit_excursion_old() {
    $data['excursion_id'] = $excursion_id = $_GET['id'];
    $data['excursion_info'] = $this->sup_excursions->get('*',$excursion_id);
    if(!isset($_GET['id'])) {
        redirect('excursions/excursion_list','refresh');
    }    
    if(empty($data['excursion_info'])){ 
        redirect('excursions/excursion_list','refresh');
    }
    $data['gallery_img'] = $this->sup_excursions->get_gallery_images($excursion_id,'sup_excursion_images','*','sup_excursion_id');
    // echo '<pre>11';print_r($data['gallery_img']);exit;
    $data['sub_view'] = 'excursions/edit_excursion';
    $this->load->view('_layout_main',$data);
}

public function edit_excursion() {
    $data['excursion_id'] = $excursion_id = $_GET['id'];
    $data['currency']=$this->currency->get();
    $data['excursion_info'] = $this->sup_excursions->get('*',$excursion_id);
    $data['categories'] =$this->sup_excursions_category->get_only_supplier('*',$this->supplier_id);
    if(!isset($_GET['id'])) {
        redirect('excursions/excursion_list','refresh');
    }    
    if(empty($data['excursion_info'])){ 
        redirect('excursions/excursion_list','refresh');
    }   
    $data['sub_view'] = 'excursions/edit_excursion';
    $this->load->view('_layout_main',$data);
}


public function update_excursion_old() {
    $data['excursion_id'] = $excursion_id = $_POST['id'];
    $data['excursion_info'] = $this->sup_excursions->get('*',$excursion_id);
    if(!isset($_POST['id'])) {
        redirect('excursions/excursion_list','refresh');
    }    
    if(empty($data['excursion_info'])){
        redirect('excursions/excursion_list','refresh');
    }
    $this->form_validation->set_rules('excursion_name', 'Excursion Name', 'trim|required');
    // echo '<pre>111';print_r($_POST);exit;
    if($this->form_validation->run()==FALSE) {  
        $errors_msg = validation_errors();      
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('excursions/add_excursion','refresh');
    } else {     
        $updatedata = array(
            'supplier_id' =>$this->supplier_id,
            'excursion_name' => $this->input->post('excursion_name'),
            'excursion_category' => $this->input->post('excursion_category'),
            'excursion_promo' => $this->input->post('excursion_promo'),
            'excursion_desc' => $this->input->post('excursion_desc'),
            'no_of_days' => $this->input->post('no_of_days'),
            'country' => $this->input->post('country'),
        );
        $this->sup_excursions->update($updatedata, $excursion_id);
        if($_POST['upload_type'] == 'update'){
            $this->special_upload($excursion_id, $_POST, 'update');
        }
        $this->session->set_flashdata('message','Excursion Updated Successfully!');
        redirect('excursions/excursion_list','refresh');
    }
}
public function update_excursion() {
    $data['excursion_id'] = $excursion_id = $_POST['id'];
     $dataarray=array('supplier_id'=>$this->supplier_id,'excursion_id'=>$excursion_id);
    $data['excursion_info']=$this->sup_excursions->check($dataarray);
    // $data['excursion_info'] = $this->sup_excursions->get('*',$excursion_id);
    if(!isset($_POST['id'])) {
        redirect('excursions/excursion_list','refresh');
    }    
    if(empty($data['excursion_info'])){
        redirect('excursions/excursion_list','refresh');
    }
    $this->form_validation->set_rules('excursion_name', 'Excursion Name', 'trim|required');
    // echo '<pre>111';print_r($_POST);exit;
    if($this->form_validation->run()==FALSE) {  
        $errors_msg = validation_errors();      
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('excursions/add_excursion','refresh');
    } else {   
     $childageminlimit=$_POST['childageminlimit'];  
     $childagemaxlimit=$_POST['childagemaxlimit'];      
     $childminheightlimit=$_POST['childminheightlimit']; 
     $childmaxheightlimit=$_POST['childmaxheightlimit']; 
      for($i=0;$i<count($_POST['childageminlimit'])&&isset($_POST['childagemaxlimit'])&&isset($_POST['childminheightlimit'])&&isset($_POST['childmaxheightlimit']);$i++)
      {
        $child_age_range_and_height[$i]=$_POST['childageminlimit'][$i].'-'.$_POST['childagemaxlimit'][$i].'||'.$_POST['childminheightlimit'][$i].'-'.$_POST['childmaxheightlimit'][$i];
      }   
        $updatedata = array(           
            'excursion_name' => $this->input->post('excursion_name'),
            'excursion_category' => $this->input->post('excursion_category'),
            'country' => $this->input->post('country'),
            'cityName' => $this->input->post('cityName'),
             'city' => $this->input->post('city'),
            'cityid' => $this->input->post('cityid'),
            'star_rating' => $this->input->post('star_rating'),
            'currency' => $this->input->post('currency'),
            'child_age_range_and_height'=>json_encode($child_age_range_and_height),
            // 'child_type' => $this->input->post('child_type'),
            // 'childheightlimit' => $this->input->post('childheightlimit'),
            // 'childageminlimit' => $this->input->post('childageminlimit'),
            // 'childagemaxlimit' => $this->input->post('childagemaxlimit'),
            'excursion_type' => $this->input->post('excursion_type'),
            'maxperson' => $this->input->post('maxperson'),
            'no_of_booking' => $this->input->post('no_of_booking'),
            'email' => stripslashes($this->input->post('email')),
            'address' => stripslashes($this->input->post('address')),
            'nearby' => stripslashes($this->input->post('nearby')),
            'contact_no' => stripslashes($this->input->post('contact_no')),  
            'overview' => stripslashes($this->input->post('overview')),
            'highlight' => stripslashes($this->input->post('highlight')),
            'inclusions' => stripslashes($this->input->post('inclusions')),
            'exclusions' => stripslashes($this->input->post('exclusions')),
            'important_info' => stripslashes($this->input->post('important_info')),
            'additional_info' => stripslashes($this->input->post('additional_info')),
            'cancellation_policy' => stripslashes($this->input->post('cancellation_policy')),
            'schedule' => stripslashes($this->input->post('schedule')),
        );       
        $this->sup_excursions->update($updatedata, $excursion_id);
        $this->session->set_flashdata('message','Excursion Updated Successfully!');
        redirect('excursions/excursion_list','refresh');
    }
}
public function excursion_list() {
    $categories =$this->sup_excursions_category->get_only_supplier('*',$this->supplier_id);
    $categories_arr=array();
    for($i=0;$i<count($categories);$i++)
    {
       $categories_arr[$categories[$i]->category_id]=$categories[$i]->category;
    }
    $data['categories']=$categories_arr;
    $data['excursion_info'] =$this->sup_excursions->get_only_supplier('*',$this->supplier_id);
    $data['sub_view'] = 'excursions/excursion_list';
    // echo '<pre>';print_r($data['excursion_info']);exit;
    $this->load->view('_layout_main',$data);
}

public function set_status($id,$status) {
    $data = array(
        'status' => $status,          
    );
    $this->sup_excursions->set_status($data,$id);
    if($status == 1){
        $msg = '<label class="label label-success">Active</label>';
    } else {
        $msg = '<label class="label label-danger">Inactive</label>';
    }
    $this->session->set_flashdata('message','Excursion is now '.$msg);
    redirect('excursions/excursion_list', 'refresh'); 
}



public function excursion_rates() {
    $data['excursion_id'] = $excursion_id = $_GET['id'];
    $data['excursion_info'] = $this->sup_excursions->get('*',$excursion_id);
    // echo '<pre>';print_r($data['excursion_info']->excursion_name);exit;
    $data['sub_view'] = 'excursions/excursion_rates';
    $this->load->view('_layout_main',$data);
}

public function excursion_rate_type_list() {
    $data['excursion_id'] = $excursion_id = $_GET['id'];
      $dataarray=array('supplier_id'=>$this->supplier_id,'excursion_id'=>$excursion_id);
    // $data['excursion_info'] = $this->sup_excursions->get('*',$excursion_id);   
    $data['excursion_info'] = $this->sup_excursions->check($dataarray);
     if(empty($_GET['id'])||!isset($_GET['id']))
    {
         redirect('excursions/excursion_list','refresh'); 
    }
    if(empty($data['excursion_info']))
    {
         redirect('excursions/excursion_list','refresh'); 
    }
    $dataarray1=array('supplier_id'=>$this->supplier_id,'excursion_id'=>$excursion_id);
    $data['rate_types']=$this->sup_excursions_rate_types->check($dataarray1);  
    $data['sub_view'] = 'excursions/excursion_rate_type_list';
    $this->load->view('_layout_main',$data);
}

public function add_rate_types()
{   
     $this->form_validation->set_rules('rate_types_name', 'Rate Types Name', 'trim|required');
    if($_POST['id']=='')
    {
        redirect('excursions/excursion_list','refresh');
    }
    else if($this->form_validation->run()==FALSE) {       
        $errors_msg = validation_errors();      
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('excursions/excursion_rate_type_list?id='.$_POST['id'],'refresh');
    }else {  
       $rate_code = $this->sup_excursions_rate_types->get_last_rate_code();
        $rate_code = str_pad($rate_code + 1, 10, 0, STR_PAD_LEFT);   
        $excursion_detail =$this->sup_excursions->get_single($_POST['id']); 
        $insertdata=array(
            'excursion_id'=>$_POST['id'],
            'supplier_id' =>$this->supplier_id,
            'excursion_code'=>$excursion_detail->excursion_code,
            'rate_code'=>$rate_code,
            'rate_types_name' => $this->input->post('rate_types_name'),
            'duration_type' => $this->input->post('duration_type'),
            'duration' => $this->input->post('duration'),
            'description' => $this->input->post('description'),
            'check_in' => $this->input->post('check_in'),
            'check_out' => $this->input->post('check_out'),
        );
        $insert_id = $this->sup_excursions_rate_types->insert($insertdata);
      
        $this->session->set_flashdata('message','Excursion Rate Type Added Successfully!');
        redirect('excursions/excursion_rate_type_list?id='.$_POST['id'],'refresh');
    }
}
public function edit_rate_type_excursion($id='',$id1='')
{
    $data['excursions_rate_types_id'] = $excursions_rate_types_id = $id;
    $data['excursion_id'] = $excursion_id = $id1;
     $dataarray1=array('supplier_id'=>$this->supplier_id,'excursion_id'=>$excursion_id);
    // $data['excursion_info'] = $this->sup_excursions->get('*',$excursion_id);   
    $data['excursion_info'] = $this->sup_excursions->check($dataarray1);
    // $data['rate_types'] = $this->sup_excursions->get('*',$excursion_id);
    $dataarray=array('excursions_rate_types_id'=>$excursions_rate_types_id, 'supplier_id'=>$this->supplier_id,'excursion_id'=>$excursion_id);
    $data['rate_types']=$this->sup_excursions_rate_types->check($dataarray); 
    if($id=='' || $id1=='') {
        redirect('excursions/excursion_list','refresh');
    }    
    if(empty($data['rate_types'])){
        redirect('excursions/excursion_list','refresh');
    }   
    $data['sub_view'] = 'excursions/edit_rate_type_excursion';
    $this->load->view('_layout_main',$data);

}
public function update_rate_types() {
    $data['excursions_rate_types_id'] = $excursions_rate_types_id = $_POST['id'];
    $data['excursion_id'] = $excursion_id = $_POST['id1'];
    // $data['rate_types'] = $this->sup_excursions->get('*',$excursion_id);
    $dataarray=array('excursions_rate_types_id'=>$excursions_rate_types_id, 'supplier_id'=>$this->supplier_id,'excursion_id'=>$excursion_id);
    $data['rate_types']=$this->sup_excursions_rate_types->check($dataarray); 
    if(!isset($_POST['id'])||!isset($_POST['id1'])) {
        redirect('excursions/excursion_list','refresh');
    }    
    if(empty($data['rate_types'])){
        redirect('excursions/excursion_list','refresh');
    }
    $this->form_validation->set_rules('rate_types_name', 'Rate Types Name', 'trim|required');
    // echo '<pre>111';print_r($_POST);exit;
    if($this->form_validation->run()==FALSE) {  
        $errors_msg = validation_errors();      
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('excursions/excursion_rate_type_list?id='.$excursion_id,'refresh');
    } else {          
        $updatedata = array(           
           'rate_types_name' => $this->input->post('rate_types_name'),
            'duration_type' => $this->input->post('duration_type'),
            'duration' => $this->input->post('duration'),
            'description' => $this->input->post('description'),
            'check_in' => $this->input->post('check_in'),
            'check_out' => $this->input->post('check_out'),);       
        $this->sup_excursions_rate_types->update($updatedata, $excursions_rate_types_id);
        $this->session->set_flashdata('message','Excursion Rate Type Updated Successfully!');
        redirect('excursions/excursion_rate_type_list?id='.$excursion_id,'refresh');
    }
}
public function set_rate_type_status($id,$status,$id1='') {
    if($id1=='')
    {
        redirect('excursions/excursion_list','refresh');
    }
    $data = array(
        'status' => $status,          
    );
    $this->sup_excursions_rate_types->set_status($data,$id);
    if($status == 1){
        $msg = '<label class="label label-success">Active</label>';
    } else {
        $msg = '<label class="label label-danger">Inactive</label>';
    }
    $this->session->set_flashdata('message','Excursion Rate Type is now '.$msg);
    redirect('excursions/excursion_rate_type_list?id='.$id1,'refresh'); 
}

public function add_rate($id='',$id1='')
{
    $data['excursions_rate_types_id'] = $excursions_rate_types_id = $id;
    $data['excursion_id'] = $excursion_id = $id1;
    $dataarray1=array('supplier_id'=>$this->supplier_id,'excursion_id'=>$excursion_id);   
    $data['excursion_info'] = $this->sup_excursions->check($dataarray1);
    $dataarray=array('excursions_rate_types_id'=>$excursions_rate_types_id, 'supplier_id'=>$this->supplier_id,'excursion_id'=>$excursion_id);
    $data['rate_types']=$this->sup_excursions_rate_types->check($dataarray); 
    if($id=='' || $id1=='') {
        redirect('excursions/excursion_list','refresh');
    }    
    if(empty($data['rate_types'])){
        redirect('excursions/excursion_list','refresh');
    }   
    $data['sub_view'] = 'excursions/add_excursion_rate';
    $this->load->view('_layout_main',$data);

}

public function add_excursion_rate($id='',$id1='')
{
   
    $from_date=isset($_POST['from_date'])?$_POST['from_date']:'';
    $to_date=isset($_POST['to_date'])?$_POST['to_date']:'';
    $available_booking=isset($_POST['available_booking'])?$_POST['available_booking']:'';
    $adult_price=isset($_POST['adult_price'])?$_POST['adult_price']:'';
    $child_rates=isset($_POST['child_rates'])?$_POST['child_rates']:'';
    $excursion_code=isset($_POST['excursion_code'])?$_POST['excursion_code']:'';
    $excursion_id=isset($_POST['excursion_id'])?$_POST['excursion_id']:'';
    $excursions_rate_types_id=isset($_POST['excursions_rate_types_id'])?$_POST['excursions_rate_types_id']:'';
    $dataarray=array('excursions_rate_types_id'=>$excursions_rate_types_id, 'supplier_id'=>$this->supplier_id,'excursion_id'=>$excursion_id);
    $data['rate_types']=$this->sup_excursions_rate_types->check($dataarray);
    if($id=='' || $id1=='')
    {
        redirect('excursions/excursion_list','refresh');
    }    
    if($id!=$excursions_rate_types_id || $id1!=$excursion_id || empty($data['rate_types']))
    {
        redirect('excursions/excursion_list','refresh');
    }
   
    if ($this->input->server('REQUEST_METHOD') === 'POST')
    {
      $this->form_validation->set_rules('excursion_id', ' Excursion ', 'required');
      $this->form_validation->set_rules('excursions_rate_types_id', ' Excursion Rate Type ', 'required');
      if ($this->form_validation->run())
      {
       $get_selected_rate_code =$this->sup_excursions_rate_types->get_single($excursions_rate_types_id);
        $excursion_detail =$this->sup_excursions->get_single($id1);  
        $from_date=strtotime($_POST['from_date']);
        $to_date=strtotime($_POST['to_date']);
        $startdate= date("Y-m-d", $from_date);
        $enddate= date("Y-m-d", $to_date);  

          if(isset($_POST['child_price']))
          {
             $child_price=array();
             $child_age_range_and_height=json_decode($excursion_detail->child_age_range_and_height,true); 
             $ch=0;       
             foreach ($child_age_range_and_height as $key => $value)
              { 
                    $val=explode('||', $value);
                    $val1=explode('-', $val[0]);
                    $val2=explode('-', $val[1]);
                    $child_price[$ch]=$val1[0].'-'.$val1[1].'||'.$val2[0].'-'.$val2[1].':'.$_POST['child_price'][$ch];
                 $ch++;
              }     
          }
          else
          {
             $child_price='';
          } 
         $this->sup_excursion_rate->delete_excursions_rates($excursion_id, $excursions_rate_types_id,$startdate,$enddate);   
        $days=floor(($to_date - $from_date) / (60 * 60 * 24)); 
        for($i=0;$i<=$days;$i++)
        {  
          $incr_date = strtotime("+".$i." days", $from_date);
          $room_avail_date=date("Y-m-d", $incr_date);
          $insertinfo = array(
                          'supplier_id' => $this->supplier_id,
                          'excursion_id' => $excursion_id,
                          'excursion_code' => $excursion_detail->excursion_code,
                          'rate_code'=>$get_selected_rate_code->rate_code,
                          'excursions_rate_types_id' => $excursions_rate_types_id,
                          'excursion_avail_date' => $room_avail_date,
                          'available_booking' => $available_booking,
                          'adult_price' => $adult_price,
                          'child_price'=> json_encode($child_price),
                          'status' => '1',
                       );
        $this->sup_excursion_rate->insert($insertinfo);
        }
           echo json_encode(array('result' => '1'));
        }
         else
        { 
           echo json_encode(array('result' => ''));
        }
        }
         else
        { 
           echo json_encode(array('result' => ''));
        }       


         
}


public function edit_rate($id='',$id1='')
 {
   $data['excursions_rate_types_id'] = $excursions_rate_types_id = $id;
    $data['excursion_id'] = $excursion_id = $id1;
    $dataarray1=array('supplier_id'=>$this->supplier_id,'excursion_id'=>$excursion_id);   
    $data['excursion_info'] = $this->sup_excursions->check($dataarray1);
    $dataarray=array('excursions_rate_types_id'=>$excursions_rate_types_id, 'supplier_id'=>$this->supplier_id,'excursion_id'=>$excursion_id);
    $data['rate_types']=$this->sup_excursions_rate_types->check($dataarray); 
    if($id=='' || $id1=='') {
        redirect('excursions/excursion_list','refresh');
    }    
    if(empty($data['rate_types'])){
        redirect('excursions/excursion_list','refresh');
    }   
  $data['sub_view'] = 'excursions/edit_rate';
  $this->load->view('_layout_main',$data);  

 }

 public function get_excursion_rates_def()
 {
   // echo '<pre>'; print_r($_POST); exit;

    $data['excursions_rate_types_id'] = $excursions_rate_types_id = $_POST['id'];
    $data['excursion_id'] = $excursion_id =  $_POST['id1'];
    $dataarray1=array('supplier_id'=>$this->supplier_id,'excursion_id'=>$excursion_id);   
    $data['excursion_info'] = $this->sup_excursions->check($dataarray1);
    $dataarray=array('excursions_rate_types_id'=>$excursions_rate_types_id, 'supplier_id'=>$this->supplier_id,'excursion_id'=>$excursion_id);
    $data['rate_types']=$this->sup_excursions_rate_types->check($dataarray); 
    if(!isset($_POST['id']) || !isset($_POST['id1'])) {
        redirect('excursions/excursion_list','refresh');
    }    
    if(empty($data['rate_types'])){
        redirect('excursions/excursion_list','refresh');
    }        
         $supplier_id=$this->supplier_id;
         $excursion_id=$_POST['excursion_id'];
         $excursion_code=$_POST['excursion_code'];
         $rate_code=$data['rate_types'][0]->rate_code;
         $from_date=$_POST['from_date'];
         $to_date=$_POST['to_date'];
         
         $excursion_rates=$data['excursion_rates'] = $this->sup_excursion_rate->new_cal_get_excursionrates_by_date($excursions_rate_types_id, $excursion_id, $excursion_code,$rate_code,$from_date,$to_date,$this->supplier_id);
         // echo $this->db->last_query(); exit;
          $data['sub_view'] = 'excursions/view_rate_definition';
          $this->load->view('_layout_main',$data);    
 }


public function edit_excursion_rates($sup_excursion_rate_id, $rate_code, $excursion_code,$supplier_id,$excursions_rate_types_id,$index){
 
    $data['result']=$this->sup_excursion_rate->get_excursionrates_edit($sup_excursion_rate_id, $rate_code, $excursion_code,$supplier_id,$excursions_rate_types_id);
    $data['index']=$index;
    $edit_excursion_rates='';
         if (!empty($data['result'])) {

           $edit_excursion_rates.= $this->load->view('excursions/load_ajax_excursion_rate', $data, TRUE);
             echo json_encode(array('edit_excursion_rates' => $edit_excursion_rates));
            } else {
                echo json_encode(array());
            }     



    // $data['sub_view'] = 'roomrate/edit_room_rate_view_file';
    // $this->load->view('_layout_main',$data); 
 }


  public function update_excursion_rates(){
    // echo "<pre>"; print_r($_POST); 
 $supplier_id=$this->supplier_id;
 $adult_price = $this->input->post('adult_price');
  $excursion_detail =$this->sup_excursions->get_single($_POST['excursion_id']);  
  if(isset($_POST['child_price']))
          {
             $child_price=array();
             $child_age_range_and_height=json_decode($excursion_detail->child_age_range_and_height,true); 
             $ch=0;       
             foreach ($child_age_range_and_height as $key => $value)
              { 
                    $val=explode('||', $value);
                    $val1=explode('-', $val[0]);
                    $val2=explode('-', $val[1]);
                    $child_price[$ch]=$val1[0].'-'.$val1[1].'||'.$val2[0].'-'.$val2[1].':'.$_POST['child_price'][$ch];
                 $ch++;
              }     
          }
          else
          {
             $child_price='';
          } 
 $excursion_code=$this->input->post('excursion_code');
 $rate_code=$this->input->post('rate_code');
 $excursions_rate_types_id=$this->input->post('excursions_rate_types_id');
 $sup_excursion_rate_id=$this->input->post('sup_excursion_rate_id');
 $this->sup_excursion_rate->get_excursionrates_update($sup_excursion_rate_id, $rate_code, $excursion_code,$excursions_rate_types_id,$adult_price,json_encode($child_price));
 // redirect('excursionsrates/edit_rates_room','refresh');
  $result=$this->sup_excursion_rate->get_excursionrates_edit($sup_excursion_rate_id, $rate_code, $excursion_code,$supplier_id,$excursions_rate_types_id);

 echo json_encode(array('result'=>1));
 }

public function set_excursionrate_status() {
    if(isset($_POST['id']) && isset($_POST['status'])){
    $data = array(
        'status' => $_POST['status'],          
    );
    $this->sup_excursion_rate->set_status($data,$_POST['id']);
    if( $_POST['status']==1){
        $msg = '<label class="label label-success">Active</label>';
        $statusmsg='Active';
    } else {
        $msg = '<label class="label label-warning">Inactive</label>';
        $statusmsg='Inactive';
    }
   echo json_encode(array('result' => $msg, 'status'=>$statusmsg));
   }
   else
   {
     echo json_encode(array('result' =>''));
   }
}


public function excursion_rate_list($id='') {  
 $dataarray=array('excursion_id'=>$id,'supplier_id'=>$this->supplier_id);
 $data['rate_types'] =$this->sup_excursions_rate_types->check($dataarray);
 $dataarray1=array('excursion_id'=>$id,'supplier_id'=>$this->supplier_id);
  $data['excursion_detail'] =$this->sup_excursions->check($dataarray1); 
  

       if($id=='' || empty($data['rate_types'])){
    redirect('excursions/excursion_list','refresh');
  } 
    $data['sub_view'] = 'excursions/calendar';
    $this->load->view('_layout_main',$data);
}
 public function available_rates() {
       // print '<pre />';print_r($_GET);exit;
        if (isset($_GET['month']) && isset($_GET['year']) && isset($_GET['excursion_code']) && isset($_GET['excursions_rate_types_id'])) {

            $month = $_GET['month'];
            $year = $_GET['year'];
            $excursion_code = $_GET['excursion_code'];
            $excursions_rate_types_id = $_GET['excursions_rate_types_id'];
            $startdate = date('Y-m-d', strtotime($year . '-' . $month . '-1'));
            $enddate = date('Y-m-t', strtotime($year . '-' . $month . '-1'));
            $excursion_rates = $this->sup_excursion_rate->get_excursionrates_by_date($excursions_rate_types_id, $startdate, $enddate,$this->supplier_id);
            $result = array();
            if (!empty($excursion_rates)) {
                foreach ($excursion_rates as $row) {
                    $result[] = array( 
                        'available_booking' => $row->available_booking,
                        'adult_price' => $row->adult_price,
                        'child_price' => $row->child_price,                        
                        'date' => $row->excursion_avail_date,
                    );
                }
                echo json_encode(array('success' => 1, 'result' => $result));
            } else {
                echo json_encode(array('success' => 1, 'result' => array()));
            }
        }
        $sd = $this->input->post('sd');
        $ed = $this->input->post('ed');
        $excursions_rate_types_id = $this->input->post('excursions_rate_types_id');
        if (!empty($sd) && !empty($ed) && !empty($excursions_rate_types_id)) {

            $startdate = date('Y-m-d', strtotime($sd));
            $enddate = date('Y-m-t', strtotime($ed));
            $excursion_rates = $this->sup_excursion_rate->get_excursionrates_by_date($excursions_rate_types_id, $startdate, $enddate);
            $result = array();
            if (!empty($excursion_rates)) {
                foreach ($excursion_rates as $row) {
                    $result[] = array(
                       'available_booking' => $row->available_booking,
                        'adult_price' => $row->adult_price,
                        'child_price' => $row->child_price,                        
                        'date' => $row->excursion_avail_date,
                    );
                }
                echo json_encode(array('success' => 1, 'result' => $result));
            } else {
                echo json_encode(array('success' => 1, 'result' => array()));
            }
        }
        die();
 }

 public function get_available_rates()
{   
     
    $year=$_POST['year'];
    $excursions_rate_types_id = $_POST['excursions_rate_types_id'];
    $excursions_code = $_POST['excursions_code']; 
    $startdate = date('Y-m-d', strtotime($year . '-' .'1'. '-1'));
    $enddate = date('Y-m-t', strtotime($year . '-' . '12'. '-1'));
    $excursionsrates = $this->sup_excursion_rate->get_excursionrates_by_date($excursions_rate_types_id, $startdate, $enddate,$this->supplier_id);
    $calendar = array();
    $calendar_date = array();
    $k=0;
    if (!empty($excursionsrates))
    {
         foreach ($excursionsrates as $row)
         {
            $child_price=json_decode($row->child_price,true);
            $child_price_str='';
            if(!empty($child_price[0]))
            {
              foreach ($child_price as $key => $value)
              { 
                  $val=explode('||', $value);
                  $val1=explode('-', $val[0]);
                  $val2=explode(':', $val[1]);
                  $val3=explode('-', $val2[0]);
                  $child_price_str.="<small> Age (".$val1[0]."-".$val1[1].") & Height( ".$val3[0]." Cm -".$val3[1]." Cm ) : </small>".$val2[1].'<br>';
                    
             } 
            }            
             $calendar[$k]="<p style='color:red'>Available Booking : ".$row->available_booking.
                           "</p><p style='color:green;font-weigth:bold;'>Adult Price : ".$row->adult_price.        
                           "</p>Child Price : ".$child_price_str;
             $calendar_date[$k]=$row->excursion_avail_date;
             $k++;

        }
        echo json_encode(array('success' => 1, 'result' => $calendar,'result1'=>$calendar_date));
     } 
     else
     {
       echo json_encode(array('success' => 1, 'result' => array(), 'result1' => array()));
     }
}

public function get_excursion_rate_monthcalender()
{      
   
    $excursions_rate_types_id = $_POST['excursions_rate_types_id'];
    $excursions_code = $_POST['excursions_code']; 
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $startdate = date('Y-m-d', strtotime($from_date));
    $enddate = date('Y-m-d', strtotime($to_date));
     $excursionsrates = $this->sup_excursion_rate->get_excursionrates_by_date($excursions_rate_types_id, $startdate, $enddate,$this->supplier_id);
    $calendar = array();
    $calendar_date = array();
    $k=0;
    if (!empty($excursionsrates))
    {
         foreach ($excursionsrates as $row)
         {
            $child_price=json_decode($row->child_price,true);
            $child_price_str='';
            if(!empty($child_price[0]))
            {
              foreach ($child_price as $key => $value)
              { 
                  $val=explode('||', $value);
                  $val1=explode('-', $val[0]);
                  $val2=explode(':', $val[1]);
                  $val3=explode('-', $val2[0]);
                  $child_price_str.="<small> Age (".$val1[0]."-".$val1[1].") & Height( ".$val3[0]." Cm -".$val3[1]." Cm ) : </small>".$val2[1].'<br>';
                    
             } 
            }            
             $calendar[$k]="<p style='color:red'>Available Booking : ".$row->available_booking.
                           "</p><p style='color:green;font-weigth:bold;'>Adult Price : ".$row->adult_price.        
                           "</p>Child Price : ".$child_price_str;
             $calendar_date[$k]=$row->excursion_avail_date;
             $k++;

        }
        echo json_encode(array('success' => 1, 'result' => $calendar,'result1'=>$calendar_date,'startdate'=>$startdate));
     } 
     else
     {
       echo json_encode(array('success' => 1, 'result' => array(), 'result1' => array(),'startdate'=>$startdate));
     }
}

public function special_upload($insert_id, $post, $to_do){
    // echo '<pre>';print_r($post);exit;
    $id = $insert_id;
    $dataarray=array('excursion_id'=>$insert_id,'supplier_id'=>$this->supplier_id);
    $excursions_details=$this->sup_excursions->check($dataarray);
      // echo '<pre>';print_r($excursions_details);exit;
    $excursion_code=$excursions_details[0]->excursion_code;
    $unique_id_column = $post['unique_id_column'];
    $foreign_id_column = $post['foreign_id_column'];
    $controller = $post['controller'];
    $table_name = $post['table_name'];
    $column_name = $post['column_name'];
    $img_type = $post['img_type'];
    $upload_type = $post['upload_type'];

    $tablepath = $table_name;
        
    $imgpath = 'uploads/'.$this->supplier_id.'/'.$controller.'/'.$excursion_code.'/'.$tablepath.'/'.$img_type.'/';
    $uploadpath = $this->upload_path.$controller.'/'.$excursion_code.'/'.$tablepath.'/'.$img_type.'/';
    
    $config['upload_path'] = $uploadpath;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['overwrite'] = TRUE;
    $config['max_size'] = '0';
    $config['max_width'] = '0';
    $config['max_height'] = '0';
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if (!is_dir($config['upload_path'])) {
        mkdir($config['upload_path'], 0755, TRUE);
    }
    // echo '<pre>11 ';print_r($post);exit;
    if($this->upload->do_multi_upload("uploadfile")){
        // echo '<pre>11 ';print_r($post);exit;
        $data['upload_data'] = $this->upload->get_multi_upload_data();
        $total_files = count($data['upload_data']);

        // echo '<pre>11 ';print_r($data['upload_data']);exit;

        if($upload_type == 'insert'){
            $this->sup_excursions->delete_first($insert_id,$foreign_id_column,$table_name);
        }
        foreach($data['upload_data'] as $imgfile) {
            // echo '<pre>11 ';print_r($imgfile['file_name']);exit;
            $this->sup_excursions->special_upload_images($insert_id,$unique_id_column,$foreign_id_column,$table_name,$column_name,$upload_type,$imgpath.$imgfile['file_name'],$this->supplier_id,$excursion_code);

        }
        // echo '<pre>kk';print_r($insert_id);exit;
    } else {
        $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
    }
}


public function delete_img(){
    $img_id = $this->input->post('img_id');
    $table_name = $this->input->post('table_name');
    $img_url = $this->input->post('img_url');
    $unique_id_column = $this->input->post('unique_id_column');
    unlink($img_url);
    $this->sup_excursions->delete_images($img_id,$table_name,$unique_id_column);
    // echo '<pre>kk';print_r($this->db->last_query());exit;
}

public function categories()
{
    $data['categories'] =$this->sup_excursions_category->get_only_supplier('*',$this->supplier_id);
    $data['sub_view'] = 'excursions/categories_list';
    $this->load->view('_layout_main',$data);
}
public function add_new_category()
{
    $data['category']=array();
    $result = $this->load->view('excursions/load_ajax_add_new_category', $data, TRUE);
    echo json_encode(array('result' => $result, 'header'=>'Add New Category'));
}
public function update_category($id='')
{

    $this->form_validation->set_rules('add_category', 'Category', 'trim|required');
    if($this->form_validation->run()==FALSE) {       
      echo json_encode(array('result' =>'', 'header'=>'','validation_error'=>validation_errors()));
    } else {
       
        if($id==''){  
         $dataarray=array('category'=>$this->input->post('add_category'));
         $check = $this->sup_excursions_category->check($dataarray);       
         if(!empty($check))
         {
             echo json_encode(array('result' =>'', 'header'=>'Add New Category','validation_error'=>'Already Exist'));
         }
         else{
        $insertdata=array(
            'supplier_id' =>$this->supplier_id,
            'category' => $this->input->post('add_category'),
            'status'=>1,
        );
        $insert_id = $this->sup_excursions_category->insert($insertdata);
         echo json_encode(array('result' =>'Successfully Inserted', 'header'=>'Add New Category'));
     }
    }
    else
    {
         $dataarray=array('category'=>$this->input->post('add_category'));
         $check = $this->sup_excursions_category->check($dataarray);  
       if(!empty($check))
         {
             echo json_encode(array('result' =>'', 'header'=>'Add New Category','validation_error'=>'Already Exist'));
         }
         else{
        $data=array(           
            'category' => $this->input->post('add_category'),           
        );
      $this->sup_excursions_category->update($data,$id);
         echo json_encode(array('result' =>'Successfully Updated', 'header'=>'Edit Category'));
     }
    }
    }

}

public function edit_category()
{
    $data['category']=$this->sup_excursions_category->get_single($_POST['id']);
   if(!isset($_POST['id']) || empty($data['category']))
   {
     echo json_encode(array('result' =>'', 'header'=>'Edit Category','validation_error'=>'Try after Sometimes'));
   }
   else{ 

    $result = $this->load->view('excursions/load_ajax_add_new_category',  $data, TRUE);
    echo json_encode(array('result' => $result, 'header'=>'Edit Category'));
     }

}

public function set_category_status() {
    if(isset($_POST['id']) && isset($_POST['status'])){
    $data = array(
        'status' => $_POST['status'],          
    );
    $this->sup_excursions_category->set_status($data,$_POST['id']);
    if( $_POST['status']==1){
        $msg = '<label class="label label-success">Active</label>';
        $statusmsg='Active';
    } else {
        $msg = '<label class="label label-warning">Inactive</label>';
        $statusmsg='Inactive';
    }
   echo json_encode(array('result' => $msg, 'status'=>$statusmsg));
   }
   else
   {
     echo json_encode(array('result' =>''));
   }
}

public function addagerange()
{
    echo json_encode(array('result' =>$this->load->view('excursions/load_ajax_child_agerange', '', TRUE)));
}

}

