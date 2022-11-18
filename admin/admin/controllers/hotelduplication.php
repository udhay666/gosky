<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotelduplication extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Cities_model');
        $this->load->model('Home_Model');
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
 public function city()
{   //echo 887;
    //exit;
    $this->load->view('cities/searchcities');
//        redirect('hotelduplication/update_view','refresh');



}
public function hotels_city_list()
{
    if (isset($_GET['term'])) {
		//print_r($_GET['term']);
        $return_arr = array();
        $search = $_GET["term"];
        $city_list = $this->Cities_model->get_all_city_list($search);
		//print_r($city_list);exit;

        if (!empty($city_list)) {
            for ($i = 0; $i < count($city_list); $i++) {
                $city = $city_list[$i]['city_name'] . ', ' . $city_list[$i]['country_name'];
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
//  redirect('hotelduplication/update_view','refresh');
}
public function hotels_city_list_new() {
    if (isset($_GET['term'])) {
		//print_r($_GET['term']);
        $return_arr = array();
        $search = $_GET["term"];
        $hotel_name = $_GET["city_name"];
        $hotel_name = explode(",",$hotel_name);
        $city_list = $this->Cities_model->get_all_city_list_new($search,$hotel_name[0]);
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
}

public function update_view()
{
$citycode=explode(',',$this->input->post('city'));
$this->session->set_userdata('citycode',$citycode[0]);
$citycode=explode('(',$this->input->post('city'));
$this->session->set_userdata('citycoderooms',$citycode[1]);
$this->load->view('cities/updateview');

}

public function updting_hotel_name($hotel_id)
{
    $hotel_name=$this->input->post('hotel');

    $this->Cities_model->updating_hotel_name($hotel_name,$hotel_id);
}
public function update_hotel_name()
{
        //echo "<pre/>";print_r($_POST);exit;
    $hotel_name=$this->input->post('hotelName');
         $cityrow=$this->Cities_model->getcitycodes();
         $roomscity=$cityrow->rooms_city_id;
        // $city[]=$cityrow->ez_city_name;
        // $city[]=$cityrow->tbo_city_id;
          //echo $this->db->last_query().'<pre>';print_r($cityrow);exit;
    $city=$this->session->userdata('citycode');
    $fullresult= $this->Cities_model->get_matching_hotel($hotel_name,$city);
    $roomresult= $this->Cities_model->get_matching_hotelrooms($roomscity);
    $data['result']=array_merge($fullresult, $roomresult);

    $this->load->view('cities/update_hotel',$data);
}

public function updateduplication()
{
//echo '<pre>';print_r($_POST);//exit;
$this->Cities_model->updatehotel($_POST['hotel_name'][0]);
redirect('hotelduplication/update_hotel_name','refresh');
}

public function hotel_view()
{
	$this->load->view('cities/hotelview');
}
/*public function edithotelname($api_hotel_id)
{
	echo $api_hotel_id;
	$data['result'] = $this->Cities_model->get_data($api_hotel_id);
	//echo $this->db->last_query();exit;
	//echo '<pre>';//print_r($data);//exit;
	$this->load->view('cities/hotelview',$data);
}*/
/*public function update($api_hotel_id)
{
	//echo $api_hotel_id;
	$hotel_name=$this->input->post('hotel_name');
	$data = array(
	'hotel_name' => $hotel_name,
	);
	$this->Cities_model->update_data($api_hotel_id,$data);
	
}*/

/*public function hotelview()
{
	$this->load->view('cities/editview');
}*/
public function edithotel($api_hotel_id)
{
	//echo $api_hotel_id;
	$data['result']=$this->Cities_model->get_datas($api_hotel_id);
	//echo $this->db->last_query();exit;
	//echo '<pre>';print_r($data);exit;
    $this->load->view('cities/editview',$data);	
}
public function update($api_hotel_id)
{
	$hotel_name=$this->input->post('hotel_name');
	$data = array(
	'hotel_name' => $hotel_name,
	);
	$this->Cities_model->update_data($api_hotel_id,$data);
}
}

