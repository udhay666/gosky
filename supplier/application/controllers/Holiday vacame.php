<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class holiday extends CI_CONTROLLER {

    private $supplier_id;
    private $upload_path;
    private $max_image_size = '4000';
    private $max_image_width = '2024';
    private $max_image_height = '2000';
    // private $base_url_fc;

function __construct() {
    parent :: __construct();
    $this->load->database();
    $this->load->model('Currency');
    $this->load->model('holiday_packages');
    $this->load->model('glb_holiday_travellers_type');
    $this->load->model('glb_holiday_travellers_age');
    $this->load->model('holiday_theme');
    $this->load->model('holiday_activity');
    $this->load->model('holiday_attraction');
    $this->load->model('holiday_itinerary');
    $this->load->model('holiday_city');
    $this->load->model('holiday_country');
    $this->load->model('Upload_Model');
    $this->load->model('holiday_accomodation');
    $this->load->library('upload');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    // $this->load->library('admin_auth');
    $this->supplier_id = $this->session->userdata('supplier_id');

    // $url=str_replace('/admin/','',FCPATH);
    $url= FCPATH;
    // $url_save=str_replace('/admin/','',base_url());//exit; 
    $this->upload_path = $url. 'uploads/';
    // $this->base_url_fc = $url_save.'/'; //exit;
    $this->is_logged_in();
}
private function is_logged_in() {
    if (!$this->session->userdata('supplier_logged_in')) {
        redirect('login/supplier_login');
    }
}
public function holiday_list() {
    $fields = 'id,supplier_id,holiday_type,package_title,package_code,destination,status,start_date,end_date,trip_type,trip_group';
    $data['packages'] = $packages = $this->holiday_packages->get_only_supplier($fields,$this->supplier_id);
     // echo '<pre>';print_r($data['packages']);exit;
    $data['sub_view'] = 'holiday/holiday_list';
    $this->load->view('_layout_main',$data);
}
public function get_active_packages(){
    $packages = $this->holiday_packages->get_active_packages();
    // echo '{"data":'.json_encode($packages).'}';
}
public function add_holiday() {
    $data['theme'] = $this->holiday_theme->get_active_themes();
    $city_fields = 'city_id,city_name,country_id,continent_id';
    // $data['holiday_city'] = $this->holiday_city->get_active($city_fields);
    $data['holiday_city'] = $this->holiday_packages->city_list($city_fields);
    // echo $this->db->last_query();exit;
    $data['currency'] = $this->Currency->get('*');
    $data['trip'] = $this->glb_holiday_travellers_type->get_type();
    $data['age'] = $this->glb_holiday_travellers_age->get_age();
      // echo '<pre>';print_r($data['holiday_city']);exit;
    $data['holiday_packages'] = $this->holiday_packages->get_active_supplier('id,package_title,status',$this->supplier_id);
    $data['sub_view'] = 'holiday/add_holiday';
    $this->load->view('_layout_main',$data);
}

public function save_holiday_step1() {
     // echo '<pre>';print_r($_POST);exit;
    $this->form_validation->set_rules('holiday_name', 'Holiday Name', 'trim|required');
    $this->form_validation->set_rules('holiday_code', 'Holiday ID', 'trim|required');

    if($this->form_validation->run()==FALSE) {
        echo json_encode(array(
            'validation_error' => '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>'.validation_errors().'</div>',
            'validation_status' => true,
            'insert_id' => $check_insert,
        ));
    } else {
        $dates = explode('-', $this->input->post('package_validity'));
        $destination = $_POST['desti'];
        $city_id = array();$county_id = array();$continent_id = array();
        foreach ($destination as $value) {
            $desti = explode('|', $value);
            $city_id[] = $desti[0];
            $county_id[] = $desti[1];
            $continent_id[] = $desti[2];
            // echo '<pre>';print_r($desti);
        }
        $cityId = array_unique($city_id);
        $countryId = array_unique($county_id);
        $continentId = array_unique($continent_id);
        $trip_type = explode('||', $this->input->post('trip_type'));
        $data = array(
            'supplier_id' =>$this->supplier_id,
            'package_title' =>$this->input->post('holiday_name'),
            'package_code' =>$this->input->post('holiday_code'),
            'destination' =>implode(',', $cityId),
            'country'=>implode(',', $countryId),
            'continent'=>implode(',', $continentId),
            'theme_id' =>implode(',', $this->input->post('themes')),
            'short_desc' =>$this->input->post('short_desc'),
            'package_rating' =>$this->input->post('star_rating'),
            'start_date' =>str_replace('/', '-', $dates[0]),
            'end_date' =>str_replace('/', '-', $dates[1]),
            'minChildAge' =>$this->input->post('minChildAge'),
            'maxChildAge' =>$this->input->post('maxChildAge'),
            'minAdultAge' =>$this->input->post('minAdultAge'),
            'minPaxOperating' =>$this->input->post('minPaxOperating'),
            'maxPaxOperating' =>$this->input->post('maxPaxOperating'),
            'child_allowed' =>$this->input->post('child_allowed'),
            'discount_type' =>$this->input->post('discount_type'),
            'discount_price' =>$this->input->post('discount_price'),
            'currency_code' =>$this->input->post('currency_code'),
            'price' =>$this->input->post('pp_price'),
            'operated_by' =>$this->input->post('operated_by'),
            'operator_no' =>$this->input->post('operator_no'),
            'emergency_no' =>$this->input->post('emergency_no'),
            'duration' =>$this->input->post('duration'),
            'age_limit' =>$this->input->post('age'),
            'trip_type' =>$trip_type[0],
            'trip_group' =>$trip_type[1],
            'tax_percentage' =>$this->input->post('tax_amount'),

        );
               echo '<pre>';print_r($data);exit;
        // $check_insert = $this->input->post('insert_id');
        if($check_insert == ''){
            // $insert_id = $this->holiday_packages->insert_holiday_packages($data);
            echo json_encode(array('insert_id' => $insert_id));
        } else{
            $insert_id = $check_insert;
            $this->holiday_packages->update($data, $insert_id);
            echo json_encode(array('insert_id' => $insert_id));
        }
        $this->session->set_flashdata('message','Step 1 Completed!');
        // echo '<pre>';print_r($insert_id);exit;
    }
}

public function quick_add() {
    $data['sub_view'] = 'holiday/quick_add';
    $this->load->view('_layout_main',$data);
}
public function set_package_status($id,$status) {
    $data = array(
        'status' => $status,          
    );
    $this->holiday_packages->set_status($data,$id);
    if($status == 0){
        $msg = '<b style="color:#607d8b">Inactive</b>';
    } else {
        $msg = '<b style="color:#607d8b">Active</b>';
    }
    $this->session->set_flashdata('message','Package is now '.$msg);
    redirect('holiday/holiday_list', 'refresh'); 
}
public function edit_holiday() {
    $data['package_id'] = $package_id = $_GET['id'];
    $data['theme'] = $this->holiday_theme->get_active_themes();
    // echo '<pre>';print_r($data['theme']);exit;
    $city_fields = 'city_id,city_name,country_id';
    // $data['holiday_city'] = $this->holiday_city->get_active($city_fields);
    $data['holiday_city'] = $this->holiday_packages->city_list($city_fields);
    // echo '<pre>';print_r($data['holiday_city']);exit;
    $data['currency'] = $this->Currency->get('*');
    $data['age'] = $this->glb_holiday_travellers_age->get_age();
    $data['trip'] = $this->glb_holiday_travellers_type->get_type();
    $data['package_info'] = $package_info = $this->holiday_packages->get('*',$package_id);
    // echo '<pre>';print_r($data['package_info']);exit;
    $data['sub_view'] = 'holiday/edit_holiday';
    $this->load->view('_layout_main',$data);
}


public function edit_step2() {
     // print_r($_POST);exit;
     $data['package_id'] = $package_id = $_GET['id'];
     // print_r($package_id);exit;
    $fields = 'overview,highlights,package_title,package_code';
    $data['package_info'] = $this->holiday_packages->get($fields,$package_id);

    $data['sub_view'] = 'holiday/edit_step2';
    $this->load->view('_layout_main',$data);
}
public function edit_step3() {
    $data['package_id'] = $package_id = $_GET['id'];
    // print_r($data);exit;
    $data['holiday_activity'] = $holiday_activity = $this->holiday_activity->get_activity('*',$package_id);
    // echo '<pre>';print_r($data['holiday_activity']);exit;
    if(!empty($holiday_activity)){
        $data['total_acti'] = count($holiday_activity);
    } else {
         $data['total_acti'] = 1;
    }
    $data['package_info'] = $this->holiday_packages->get('package_title,package_code,duration',$package_id);
    // print_r($data['package_info']);exit;

    $data['sub_view'] = 'holiday/edit_step3';
    $this->load->view('_layout_main',$data);
}
public function edit_step4() {
    $data['package_id'] = $package_id = $_GET['id'];
    $fields = 'inclusion,exclusion,package_title,package_code';
    $data['package_info'] = $this->holiday_packages->get($fields,$package_id);
    $data['holiday_packages'] = $this->holiday_packages->get_active_supplier('id,package_title,status',$this->supplier_id);
    // echo '<pre>';print_r($data['holiday_packages']);exit;
    $data['sub_view'] = 'holiday/edit_step4';
    $this->load->view('_layout_main',$data);
}
public function edit_step5() {
    $data['package_id'] = $package_id = $_GET['id'];
    $fields = 'terms,package_good,package_title,package_code,policy,child_policy,cancellation_policy';
    $data['package_info'] = $package_info = $this->holiday_packages->get($fields,$package_id);
    // $data['currency'] = $this->currency->get('currency_id,currency_code');
    $data['sub_view'] = 'holiday/edit_step5';
    $this->load->view('_layout_main',$data);
}
public function edit_step6() {
    $data['package_id'] = $package_id = $_GET['id'];
    $data['package_info'] = $this->holiday_packages->get('duration,package_title,package_code',$package_id);

    $this->load->model('meeting_points');
    $data['meeting_points'] = $this->meeting_points->get_meeting_points($package_id);
    if(!empty($data['meeting_points'])){
        $data['total_points'] = count($data['meeting_points']);
    } else{
         $data['total_points'] = 1;
    }
    $data['sub_view'] = 'holiday/edit_step6';
    $this->load->view('_layout_main',$data);
}
public function edit_step7() {
    $data['package_id'] = $package_id = $_GET['id'];
    
    $data['thumb_img'] = $this->holiday_packages->get('thumb_img',$package_id);
    $data['gallery_img'] = $this->Upload_Model->get_images($package_id,'holiday_images','*');
    $data['sub_view'] = 'holiday/edit_step7';
    $this->load->view('_layout_main',$data);
}


public function update_all() { 
    //error_reporting(E_ALL);
    // echo '<pre>';print_r($_POST);exit;
    $step_no = $this->input->post('steps');
    $package_id = $this->input->post('insert_id');
    $todo = $this->input->post('todo');
    if($step_no == 1){
    // echo '<pre>';print_r($_POST);exit;
        $this->update_step1($package_id);
        if($todo == 1){
            redirect('holiday/edit_step2?id='.$package_id, 'refresh');
        } else {
            redirect('holiday/edit_holiday?id='.$package_id, 'refresh');
        }
    } elseif ($step_no == 2) {
        // print_r($_POST);exit;
        $this->update_step2($package_id);
        if($todo == 1){
            redirect('holiday/edit_step3?id='.$package_id, 'refresh');
        } else {
            redirect('holiday/edit_step2?id='.$package_id, 'refresh');
        }
    } elseif ($step_no == 3) {
        // echo '<pre>';print_r($_POST);exit;
        $this->update_step3($package_id);
        if($todo == 1){
            redirect('holiday/edit_step4?id='.$package_id, 'refresh');
        } else {
            redirect('holiday/edit_step3?id='.$package_id, 'refresh');
        }
    } elseif ($step_no == 4) {
        $this->update_step4($package_id);
         if($todo == 1){
            redirect('holiday/edit_step5?id='.$package_id, 'refresh');
        } else {
            redirect('holiday/edit_step4?id='.$package_id, 'refresh');
        }
    } elseif ($step_no == 5) {
        $this->update_step5($package_id);
         if($todo == 1){
            redirect('holiday/edit_step6?id='.$package_id, 'refresh');
        } else {
            redirect('holiday/edit_step5?id='.$package_id, 'refresh');
        }
    } elseif ($step_no == 6) {
        $this->update_step6($package_id);
        if($todo == 1){
            redirect('holiday/edit_step7?id='.$package_id, 'refresh');
        } else {
            redirect('holiday/edit_step6?id='.$package_id, 'refresh');
        }
    } else {
        $this->update_step7($package_id);
        redirect('holiday/holiday_list', 'refresh');
    } 
}

public function update_step1($package_id){
         // echo '<pre>';print_r($_POST);exit;
    $this->form_validation->set_rules('holiday_name', 'Holiday Name', 'trim|required');
    // $this->form_validation->set_rules('holiday_code', 'Holiday ID', 'trim|required|is_unique[holiday_packages.holiday_code]');
    if($this->form_validation->run()==FALSE) {
        $data['sub_view'] = 'holiday/edit_holiday';
        $data['error'] = validation_errors();
        $this->load->view('_layout_main',$data);
    } else {
        $dates = explode('-', $this->input->post('package_validity'));
          // print_r($dates);exit;
        $destination = $_POST['desti'];
        $city_id = array();$county_id = array();$continent_id = array();
        foreach ($destination as $value) {
            $desti = explode('|', $value);
            $city_id[] = $desti[0];
            $county_id[] = $desti[1];
            $continent_id[] = $desti[2];
            // echo '<pre>';print_r($desti);
        }
        $cityId = array_unique($city_id);
        $countryId = array_unique($county_id);
        $continentId = array_unique($continent_id);
        $trip_type = explode('||', $this->input->post('trip_type'));
        $data = array(
            'supplier_id' =>$this->supplier_id,
            'package_title' =>$this->input->post('holiday_name'),
            'package_code' =>$this->input->post('holiday_code'),
            'destination' =>implode(',', $cityId),
            'country' => implode(',', $countryId),
            'continent' => implode(',', $continentId),
            'theme_id' =>implode(',', $this->input->post('themes')),
            'short_desc' =>$this->input->post('short_desc'),
            'package_rating' =>$this->input->post('star_rating'),
            'start_date' =>str_replace('/', '-', $dates[0]),
            'end_date' =>str_replace('/', '-', $dates[1]),
            // 'minChildAge' =>$this->input->post('minChildAge'),
            // 'maxChildAge' =>$this->input->post('maxChildAge'),
            // 'minAdultAge' =>$this->input->post('minAdultAge'),
            'minPaxOperating' =>$this->input->post('minPaxOperating'),
            'maxPaxOperating' =>$this->input->post('maxPaxOperating'),
            'child_allowed' =>$this->input->post('child_allowed'),
            'discount_type' =>$this->input->post('discount_type'),
            'discount_price' =>$this->input->post('discount_price'),
            // 'operation_day' =>implode(',', $this->input->post('operation_day')),
            // 'closed_dates' =>implode('|', $this->input->post('closed_dates')),
            // 'closed_reason' =>implode('||', $this->input->post('closed_reason')),
            'currency_code' =>$this->input->post('currency_code'),
            'price' =>$this->input->post('pp_price'),
            'operated_by' =>$this->input->post('operated_by'),
            'operator_no' =>$this->input->post('operator_no'),
            'emergency_no' =>$this->input->post('emergency_no'),
            'duration' =>$this->input->post('duration'),
            'age_limit' =>$this->input->post('age'),
            'trip_type' =>$trip_type[0],
            'trip_group' =>$trip_type[1],
            'tax_percentage' =>$this->input->post('tax_amount'),
        );
          // echo '<pre>';print_r($data);exit;
        $this->holiday_packages->update($data, $package_id);
        // echo '<pre>';print_r($this->db->last_query());exit;
        $this->session->set_flashdata('message','Step 1 Completed!');
        // redirect('holiday/edit_step2?id='.$package_id, 'refresh');   
    }
}

public function update_step2($package_id){
    $data = array(
        'overview' =>$this->input->post('overview'),
        'highlights' =>$this->input->post('highlights'),
    );
    $this->holiday_packages->update($data, $package_id);
    $this->session->set_flashdata('message','Step 2 Completed!');
    // redirect('holiday/edit_step3?id='.$package_id, 'refresh');
}

public function update_step3($package_id){
    // echo '<pre>';print_r($_POST);exit;
    $activity_code = $this->input->post('activity_code');
    $activity_name = $this->input->post('activity_name');
    $duration = $this->input->post('duration');
    $operating_hours = $this->input->post('operating_hours');
    $pickup_location = $this->input->post('pickup_location');
    $pickup_time = $this->input->post('pickup_time');
    $activity_description = $this->input->post('activity_description');
    $cancel_policy = $this->input->post('cancel_policy');
    $activity_child_cost = $this->input->post('activity_child_cost');
    $activity_adult_cost = $this->input->post('activity_adult_cost');
    $activity_senior_cost = $this->input->post('activity_senior_cost');
    $day_count = $this->input->post('activity_count');
    $this->holiday_activity->delete_activity($package_id);
    // echo '<pre>';print_r($this->db->last_query());exit;
    for($a=0;$a<count($activity_name);$a++){
        $data = array(
            'package_id' =>$package_id,
            'activity_code' =>$activity_code,
            'activity_title' =>$activity_name[$a],
            'duration' =>$duration[$a],
            'operating_hours' =>$operating_hours[$a],
            'pickup_location' =>$pickup_location[$a],
            'pickup_time' =>$pickup_time[$a],
            'activity_desc' =>$activity_description[$a],
            'cancel_policy' =>$cancel_policy[$a],
            'price_chd' =>$activity_child_cost[$a],
            'price_adt' =>$activity_adult_cost[$a],
            'price_sen' =>$activity_senior_cost[$a]
        );
         // echo '<pre>';print_r($data);exit;
        $this->holiday_activity->add_holiday_activity($data);
        // echo $this->db->last_query();//exit;
    }
    // exit;
    $this->session->set_flashdata('message','Step 3 Completed!');
    // redirect('holiday/edit_step4?id='.$package_id, 'refresh');
}
public function update_step4($package_id){
    $data = array(
       'inclusion' =>$this->input->post('includes'),
        'exclusion' =>$this->input->post('excludes'),
    );
    // print_r($data);exit;
    $this->holiday_packages->update($data, $package_id);
    $this->session->set_flashdata('message','Step 4 Completed!');
    // redirect('holiday/edit_step5?id='.$package_id, 'refresh');
}

public function update_step5($package_id){
    $data = array(
        'package_good' =>$this->input->post('package_good'),
        'policy' =>$this->input->post('policy'),
        'child_policy' =>$this->input->post('child_policy'),
        'cancellation_policy' =>$this->input->post('cancellation_policy'),
        'terms' =>$this->input->post('terms_and_condition'),
    );
    // print_r($data);exit;
    $this->holiday_packages->update($data, $package_id);
    // echo $this->db->last_query();exit;

    $this->session->set_flashdata('message','Step 5 Completed!');
    // redirect('holiday/edit_step6?id='.$package_id, 'refresh');
}
public function update_step6($package_id){
     // echo '<pre>';print_r($_POST);
    $pickup_location = $this->input->post('pickup_location');
    $latitude = $this->input->post('latitude');
    $longitude = $this->input->post('longitude');
    $pickup_type = $this->input->post('pickup_type');

    $this->load->model('meeting_points');
    $this->meeting_points->delete_meeting_points($package_id);
    for($a=0;$a<count($pickup_location);$a++){
        $data = array(
            'holiday_id' =>$package_id,
            'pickup_type' => $pickup_type[$a],
            'pickup_location' => $pickup_location[$a],
            'latitude' => $latitude[$a],
            'longitude' => $longitude[$a],
        );
        // echo 2;exit;
        // echo '<pre>';print_r($data);exit;
        $this->meeting_points->add_meeting_points($data);
    }
    $this->session->set_flashdata('message','Step 6 Completed!');
    // redirect('holiday/edit_step7?id='.$package_id, 'refresh');
}
public function update_step7($package_id){
    // echo '<pre>';print_r($_POST);exit;
       $this->session->set_flashdata('message','Package Completed Successfully!');

}

// public function update_step8($package_id){
//     $attraction_name = $this->input->post('attraction_name');
//     $attraction_description = $this->input->post('attraction_description');
//     $attraction_child_cost = $this->input->post('attraction_child_cost');
//     $attraction_adult_cost = $this->input->post('attraction_adult_cost');
//     $attraction_family_cost = $this->input->post('attraction_family_cost');
//     $day_count = $this->input->post('attraction_count');
//     $this->holiday_attraction->delete_attraction($package_id);
//     $this->Upload_Model->delete_count_images($package_id,$day_count,'holiday_attraction_images');
//     for($a=0;$a<count($attraction_name);$a++){
//         $data = array(
//                 'package_id' =>$package_id,
//                 'attraction_name' =>$attraction_name[$a],
//                 'attraction_count' =>$a+1,
//                 'attraction_description' =>$attraction_description[$a],
//                 'attraction_child_cost' =>$attraction_child_cost[$a],
//                 'attraction_adult_cost' =>$attraction_adult_cost[$a],
//                 'attraction_family_cost' =>$attraction_family_cost[$a]
//             );
//         $this->holiday_attraction->add_holiday_attraction($data);
//     }
//     $this->session->set_flashdata('message','Package Updated Successfully!');
//     redirect('holiday/edit_step8?id='.$package_id, 'refresh');
// }
// public function update_step9($package_id){
//     $this->session->set_flashdata('message','Package Updated Successfully!');
//     redirect('holiday/edit_step9?id='.$package_id, 'refresh');
// }

public function add_theme() {
    $this->form_validation->set_rules('theme_name', 'Theme Name', 'trim|required|is_unique[holiday_theme.theme_name]');
    if($this->form_validation->run()==FALSE) {
        $data['theme_info'] = $this->holiday_theme->get_themes();
        $data['action'] = 'add_theme';
        $data['button'] = 'Add Theme';
        // Load common things here
        $data['sub_view'] = 'holiday/holiday_theme';
        $data['error'] = 'It seems the theme you were adding is already present. Plese add another one.';
        $this->load->view('_layout_main',$data);
    } else {
        $data = array(
            'theme_name' =>$this->input->post('theme_name'),           
        );
        $this->holiday_theme->insert_theme($data);
        $this->session->set_flashdata('message','Theme added successfully!');
        redirect('holiday/holiday_theme', 'refresh');
    }
}

public function edit_theme() {
    $theme_id = $_GET['theme_id'];
    $this->form_validation->set_rules('theme_name', 'Theme Name', 'trim|required|is_unique[holiday_theme.theme_name]');
    if($this->form_validation->run()==FALSE) {
        $data['theme_info'] = $this->holiday_theme->get_themes();
        $data['single_theme'] = $this->holiday_theme->get_single_theme($theme_id);
        $data['action'] = 'edit_theme?theme_id='.$theme_id;
        $data['button'] = 'Update Theme';
        // Load common things here
        $data['sub_view'] = 'holiday/holiday_theme';
        $data['error'] = 'It seems the theme you were updating is already present. Plese update to another one.';
        $this->load->view('_layout_main',$data);
    } else {
        $data = array(
            'theme_name' =>$this->input->post('theme_name'),           
        );
        $this->holiday_theme->update_theme($data, $theme_id);
        $this->session->set_flashdata('message','Theme updated successfully!');
        redirect('holiday/holiday_theme', 'refresh');
    }
}

public function holiday_theme() {
    // error_reporting(E_ALL);
    $data['theme_info'] = $this->holiday_theme->get_themes();
    if(!empty($_GET['theme_id'])){
        $theme_id = $_GET['theme_id'];
        $data['single_theme'] = $this->holiday_theme->get_single_theme($theme_id);
        $data['action'] = 'edit_theme?theme_id='.$theme_id;
        $data['button'] = 'Update Theme';
    } else {
        $data['action'] = 'add_theme';
        $data['button'] = 'Add Theme';
    }
    // Load common things here
    $data['sub_view'] = 'holiday/holiday_theme';
    //print_r($data['sub_view']);exit;
    $this->load->view('_layout_main',$data);
}

public function set_theme_status($id,$status) {
    $data = array(
        'status' => $status,          
    );
    $this->holiday_theme->set_theme_status($data,$id);
    if($status == 0){
        $msg = '<b style="color:#607d8b">Inactive</b>';
    } else {
        $msg = '<b style="color:#607d8b">Active</b>';
    }
    $this->session->set_flashdata('message','Theme is now '.$msg);
    redirect('holiday/holiday_theme', 'refresh'); 
}

public function do_upload_old(){
    // echo '<pre>';print_r($_POST);exit;
    $id = $this->input->post('id');
    $id_column = $this->input->post('id_column');
    $table_name = $this->input->post('table_name');
    $column_name = $this->input->post('column_name');
    $img_type = $this->input->post('img_type');
    $upload_type = $this->input->post('upload_type');
    $day_count = $this->input->post('day_count');
    if(!empty($day_count)){
        // if($table_name=='holiday_itinerary_images'){
        //     $city_id = $this->input->post('city_id');
        //     $imgpath = 'uploads/supp_id/holiday/'.$city_id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';
        //     $uploadpath = $this->upload_path.'supp_id/holiday/'.$city_id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';
        // } else {
            $imgpath = 'uploads/holiday/'.$id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';
            $uploadpath = $this->upload_path.'holiday/'.$id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';
        // }
        
    } else {
        if($table_name=='holiday_packages' || $table_name=='holiday_package_images'){
            $tablepath = 'holiday_package_images';
        } else{
            $tablepath = $table_name;
        }
        $imgpath = 'uploads/holiday/'.$id.'/'.$tablepath.'/'.$img_type.'/';
        $uploadpath = $this->upload_path.'holiday/'.$id.'/'.$tablepath.'/'.$img_type.'/';
    }
    // echo '<pre>';print_r($uploadpath);
    // if($this->input->post('submit')){
        $config['upload_path'] = $uploadpath;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = TRUE;
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        
        if($this->upload->do_multi_upload("uploadfile")){
            $data['upload_data'] = $this->upload->get_multi_upload_data();
            // echo '<pre>';print_r($data['upload_data']);exit;
            // $success_msg = '<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>' . count($data['upload_data']) . 'File(s) successfully uploaded.</div>';
            $total_files = count($data['upload_data']);

            if($upload_type == 'insert'){
                $this->Upload_Model->delete_first($id,$id_column,$table_name,$day_count);
            }
            $temp_images = array();
            foreach($data['upload_data'] as $imgfile) {
                //echo '<pre>11 ';print_r($imgfile['file_name']);//exit;
                if($upload_type == 'custom_insert'){
                    $temp_images[] = $imgpath.$imgfile['file_name'];
                } else {
                    $this->Upload_Model->upload_images($id,$id_column,$table_name,$column_name,$upload_type,$imgpath.$imgfile['file_name'],$day_count);
                }
            }
            if($upload_type == 'custom_insert'){
                $images = implode(',', $temp_images);
                $insert_id = $this->Upload_Model->special_upload_images($table_name,$column_name,$upload_type,$images);
                echo json_encode(array(
                    'total_files' => 1,
                    'insert_id' => $insert_id
                ));
            } else{
                echo json_encode(array('total_files' => $total_files));
            }
            // echo '<pre>kk';print_r($insert_id);exit;
        } else {
            $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
            // foreach($errors as $k => $error){
            //     echo $error;
            // }
        }
    // } else {
    //     echo '<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>An error occured, please try again later.</div>';
    // }
    // Exit to avoid further execution
    exit();
}

public function do_upload(){
    // echo '<pre>';print_r($_POST);exit;
    $id = $this->input->post('id');
    $id_column = $this->input->post('id_column');
    $table_name = $this->input->post('table_name');
    $column_name = $this->input->post('column_name');
    $img_type = $this->input->post('img_type');
    $upload_type = $this->input->post('upload_type');
    $day_count = $this->input->post('day_count');
    if(!empty($day_count)){
            $imgpath = 'uploads/holiday/'.$id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';
            $uploadpath = $this->upload_path.'holiday/'.$id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';     
    } else {
        if($table_name=='holiday_packages' || $table_name=='holiday_images'){
            $tablepath = 'holiday_images';
        } else{
            $tablepath = $table_name;
        }
        $imgpath = 'uploads/holiday/'.$id.'/'.$tablepath.'/'.$img_type.'/';
        $uploadpath = $this->upload_path.'holiday/'.$id.'/'.$tablepath.'/'.$img_type.'/';
    }
    $config['upload_path'] = $uploadpath;
    $config['allowed_types'] = 'gif|jpg|png';
    $config['overwrite'] = TRUE;
    $config['max_size'] = '0';
    $config['max_width'] = '0';
    $config['max_height'] = '0';
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if (!is_dir($config['upload_path'])) {
        mkdir($config['upload_path'], 0755, TRUE);
    }
    
    if($this->upload->do_multi_upload("uploadfile")){
        $data['upload_data'] = $this->upload->get_multi_upload_data();
        $success_msg = '<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>' . count($data['upload_data']) . 'File(s) successfully uploaded.</div>';
        // $total_files = count($data['upload_data']);

        if($upload_type == 'insert'){
            $this->Upload_Model->delete_first($id,$id_column,$table_name,$day_count);
        }
        $temp_images = array();
        foreach($data['upload_data'] as $imgfile) {
            //echo '<pre>11 ';print_r($imgfile['file_name']);//exit;
            $this->Upload_Model->upload_images($id,$id_column,$table_name,$column_name,$upload_type,$imgpath.$imgfile['file_name'],$day_count);
        }
        // echo json_encode(array('total_files' => $total_files));
        echo $success_msg;
        
        // echo '<pre>kk';print_r($insert_id);exit;
    } else {
        $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
        foreach($errors as $k => $error){
            echo $error;
        }
    }
    exit();
}

public function custom_upload($insert_id,$post,$to_do){
    // echo '<pre>';print_r($post);exit;
    $supplier_id = $this->supplier_id;
    $id = $insert_id;
    $unique_id = $post['unique_id'];
    $table_name = $post['table_name'];
    $column_name = $post['column_name'];
    $img_type = $post['img_type'];
    $upload_type = $post['upload_type'];

    $tablepath = $table_name;
     $imgpath = 'uploads/'.$supplier_id.'/'.$controller.'/'.$id.'/'.$tablepath.'/'.$img_type.'/';
    $uploadpath = $this->upload_path.$controller.'/'.$id.'/'.$tablepath.'/'.$img_type.'/';

    $config['upload_path'] = $uploadpath;
    $config['allowed_types'] = 'gif|jpg|png';
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
            $this->Upload_Model->delete_first($id,$unique_id,$table_name);
        }
        foreach($data['upload_data'] as $imgfile) {
            // echo '<pre>11 ';print_r($imgfile['file_name']);exit;
            $this->Upload_Model->special_upload_images($id,$unique_id,$table_name,$column_name,$upload_type,$imgpath.$imgfile['file_name']);

        }
        // echo '<pre>kk';print_r($insert_id);exit;
    } else {
        $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
    }
    if($to_do == 'update'){
        $this->session->set_flashdata('message','Updated successfully!');
        redirect('holiday/add_accomodation?id='.$id, 'refresh');
    } else{
        $this->session->set_flashdata('message','Added successfully!');
        redirect('holiday/add_accomodation', 'refresh');
    }
}


public function delete_img(){
    $img_id = $this->input->post('img_id');
    $table_name = $this->input->post('table_name');
    $img_url = $this->input->post('img_url');
    unlink($img_url);
    $this->Upload_Model->delete_images($img_id,$table_name);
    // echo '<pre>kk';print_r($this->db->last_query());exit;
}

public function order_location(){
    $list = $this->input->post('list');
    // echo '<pre>';print_r($list);//exit;
    $loc = '';
    for($i=0;$i<count($list)-1;$i++){
        $loc .= '<div class="row trans_row"><div class="col-sm-12"><div class="col-sm-3">';
        $loc .= '<div class="col-sm-5">'.$list[$i]['location'].'<input type="hidden" name="location_from[]" value="'.$list[$i]['id'].'"></div><div class="col-sm-2">→</div><div class="col-sm-5"><input type="hidden" name="location_to[]" value="'.$list[$i+1]['id'].'">'.$list[$i+1]['location'].'</div>';
        $loc .= '</div><div class="col-sm-3"><select name="transport_type[]" class="form-control">
                    <option value="Flight">Flight</option>
                    <option value="Bus">Bus</option>
                    <option value="Train">Train</option>
                    <option value="Ship">Ship</option>
                </select>';
        $loc .= '</div></div></div>';
        // echo '<pre>';print_r($li->location);
    }
    // print_r($li['location']);

    echo json_encode(array('location' => $loc));
}

public function add_rates() {
    $data['package_id'] = $package_id = $_GET['id'];
    $data['rates_info'] = $this->holiday_packages->get('holiday_code,holiday_name,accomodation_type',$package_id);

    $data['currency'] = $this->currency->get('currency_id,currency_code');  
    $data['sub_view'] = 'holiday/add_rates';
    $this->load->view('_layout_main',$data);
}

public function add_accomodation() {
    // echo '<pre>';print_r($_GET);exit;
    $accomodation_id = $_GET['id'];
    if(!empty($accomodation_id)){
        $data['accomodation_id'] = $accomodation_id;
        $data['edit_accomodation'] = $this->holiday_accomodation->get_single($accomodation_id);
    }
    $data['accomodation_info'] = $this->holiday_accomodation->get_only_supplier('*',$this->supplier_id);
    $data['holiday_city'] = $this->holiday_city->get_active('city_id,city_name');
    $data['sub_view'] = 'holiday/add_accomodation';
    $this->load->view('_layout_main',$data);
}

public function submit_accomodation() {
    // echo '<pre>';print_r($_POST);exit;
    $accomodation_id = $this->input->post('accomodation_id');
    $this->form_validation->set_rules('hotel_name', 'Hotel Name', 'trim|required');
    $this->form_validation->set_rules('hotel_city', 'Hotel City', 'trim|required');
    if($this->form_validation->run()==FALSE) {
        $data['holiday_city'] = $this->holiday_city->get_active('city_id,city_name');
        $data['sub_view'] = 'holiday/add_accomodation';
        $data['error'] = validation_errors();
        $this->load->view('_layout_main',$data);
    } else {
        $data = array(
            'supplier_id' =>$this->supplier_id,
            'hotel_name' =>$this->input->post('hotel_name'),
            'hotel_city' =>$this->input->post('hotel_city'),
        );
        if(!empty($accomodation_id)){
            $this->holiday_accomodation->update($data, $accomodation_id);
            $insert_id = $accomodation_id;
            $to_do = 'update';
        } else {
            $insert_id = $this->holiday_accomodation->insert($data);
            $to_do = 'insert';
        }
        // echo '<pre>';print_r($insert_id);exit;
        $this->custom_upload($insert_id,$_POST,$to_do);

        $this->session->set_flashdata('message','Hotel Added successfully!');
        redirect('holiday/add_accomodation', 'refresh');
    }
}

}


