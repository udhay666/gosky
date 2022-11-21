<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Hotels extends MX_Controller {

	private $sess_id;

	function __construct() {
		parent::__construct();
		$this->load->model('Hotels_Model');
		$this->sess_id = $this->session->session_id;
	}

	public function index() {
		$this->load->view('home/home');
	}

	function results() {
	//    echo '<pre>'; print_r($_POST);exit;
	   $this->form_validation->set_rules('cityName', 'City Name', 'trim|required|min_length[3]');
	   $this->form_validation->set_rules('cityid', 'City Name', 'trim|required');
		$this->form_validation->set_rules('check_in', 'Check-In Date', 'required');
	   $this->form_validation->set_rules('check_out', 'Check-Out Date', 'required');
	   //$this->form_validation->set_rules('nationality', 'Nationality', 'required|xss_clean');
	   if ($this->form_validation->run($this) == FALSE) {
		   $this->load->view('home/home');
		   //return false;
		 // echo validation_errors(); exit;
		   //redirect("home");
	   } else {

		   $cityName = $this->input->post('cityName');
		   preg_match_all('/\(([A-Za-z0-9 ]+?)\)/', $cityName, $out);
		   //$cityCode = $out[1][0];
			//echo '<pre>';print_r($cityName);exit;
		   $cityCode=$this->input->post('cityid');
		   $checkIn = $this->input->post('check_in');
		   $checkOut = $this->input->post('check_out');
		   $nationality = $this->input->post('nationality');
		   $res_nationality = $this->input->post('res_nationality');
		   $room_count = $this->input->post('room_count');
		   $adults = $this->input->post('adults1');
		   $childs = $this->input->post('childs1');
		   $childs_ages = $this->input->post('child_age1_1');

		   $adults_count = $this->input->post('adults1');
		   $childs_count = $this->input->post('childs1');
		
		//    echo '<pre/>';print_r($childs_ages);exit;
		   if (!empty($cityName)) {
			   $session_data = $this->session->userdata('hotel_search_data');
			//    print_r($session_data);exit;
			   /*                 * ******** set session variables  ************** */
			   if (!empty($session_data)) {
				   $sess_cityName = $session_data['cityName'];

				   $sess_checkIn = $session_data['checkIn'];
				   $sess_checkOut = $session_data['checkOut'];
				   $sess_nationality = $session_data['nationality'];
				   $sess_rooms = $session_data['rooms'];
				   $sess_adults = $session_data['adults'];
				   $sess_childs = $session_data['childs'];

				   $sess_childs_ages = $session_data['childs_ages'];


				   if ($sess_cityName == $cityName && $sess_checkIn == $checkIn && $sess_checkOut == $checkOut && $sess_nationality == $nationality && $sess_rooms == $room_count && $sess_adults == $adults && $sess_childs == $childs && $sess_childs_ages == $childs_ages) {
					   $this->session->set_userdata('hotel_search_activate', '1');
					   $uniqueRefNo = $session_data['uniqueRefNo'];
					//    echo $uniqueRefNo;exit;
				   } else {

					   $this->session->set_userdata('hotel_search_activate', '');
					   $uniqueRefNo = $this->generateRandomString(8);
					   // echo  $uniqueRefNo;exit;
				   }
			   } else {

				   $this->session->set_userdata('hotel_search_activate', '');
				   $uniqueRefNo = $this->generateRandomString(8);
				   // echo '3'; $uniqueRefNo;exit;
			   }

			   $cin = date('Y-m-d', strtotime(str_replace('/', '-', $checkIn)));
			   $cout = date('Y-m-d', strtotime(str_replace('/', '-', $checkOut)));
			   $nights = $this->dateDiff($cin, $cout);

			   $sess_array = array(
				   'cityName' => $cityName,
				   'cityCode' => $cityCode,
				   'checkIn' => $checkIn,
				   'checkOut' => $checkOut,
				   'nationality' => $nationality,
				   'res_nationality' => $res_nationality,
				   'rooms' => $room_count,
				   'adults' => $adults,
				   'childs' => $childs,
				   'adults_count' => $adults_count,
				   'childs_count' => $childs_count,
				   'childs_ages' => $childs_ages,
				   'nights' => $nights,
				   'uniqueRefNo' => $uniqueRefNo
			   );

			   $this->session->set_userdata('hotel_search_data', $sess_array);
			    // echo '<pre>';print_r($sess_array);exit;
			   $api_info = $this->Hotels_Model->getActiveAPIs();
				// echo '<pre>';print_r($api_info);exit;
			   $api_list = array();
			   foreach ($api_info as $api) {
				   $api_list[] = base64_encode($api['api_name']);
			   }
			  //  echo '<pre/>'; print_r($api_info);exit;
			   $data['api_list'] = $api_list;
			   $data['searcharray']=$sess_array;

			   $this->load->view('search_result', $data);
		   } else {
			   $this->load->view('home/home');
		   }
	   }
	}

	// function hotels_availability() {
	// 	$post_data = $this->input->post(NULL, TRUE);
	// 	// echo"hjk"; print_r($post_data);exit;
	// 	if ($post_data != '') {
	// 		if (isset($post_data['callBackId']) && $post_data['callBackId'] != '') {
	// 			$api = base64_decode($post_data['callBackId']);
	// 			// print_r($api);exit();
	// 			$this->load->module('hotels/' . $api);
	// 			$this->$api->hotels_availabilty_search($_POST['searcharray']);
	// 		} else {
	// 			redirect('home/home', 'refresh');
	// 		}
	// 	} else {
	// 		redirect('home/home', 'refresh');
	// 	}
	// }

	function hotels_availability() {
		$post_data = $this->input->post(NULL, TRUE);
		//print_r($post_data);exit;
		if ($post_data != '') {
			if (isset($post_data['callBackId']) && $post_data['callBackId'] != '') {
				$api = base64_decode($post_data['callBackId']);
				// print_r($api);exit();
				$this->load->module('hotels/' . $api);
				$this->$api->hotels_availabilty_search($_POST['searcharray']);
			} else {
				redirect('home/home', 'refresh');
			}
		} else {
			redirect('home/home', 'refresh');
		}
	}

	public function fetch_results() {
		// echo"<pre>";print_r($_POST);exit;
		$this->load->library('Ajax_pagination');
		$count = $_POST['count'];//exit;
        // $hotel_search_data = $this->session->userdata('hotel_search_data');
        $hotel_search_data = unserialize($_POST['searcharray']);
        // $rooms = $hotel_search_data['rooms'];
        // $nights = $hotel_search_data['nights'];
      
        $pdata['TotalRec'] = $this->Hotels_Model->TotalSearchResults($this->sess_id);
        $pdata['perPage'] = $this->perPage();
        $pdata['ajax_function'] = 'searchresult_ajax';
        $pdata['sessionId'] = $this->sess_id;
        // echo "<pre/>";print_r($pdata);exit;
        $subdata['paging'] = $paging = $this->load->view('paging', $pdata, TRUE);

        $filter_details = $this->Hotels_Model->get_filter_option_details($this->sess_id);
        //	echo '<pre>';print_r($filter_details);exit;
//        $min_price = round((($filter_details->min_price / $rooms) / $nights),2);
//        $max_price = round((($filter_details->max_price / $rooms) / $nights),2);
//echo $this->db->last_query();echo '<pre>';print_r($filter_details);
        $min_price = round($filter_details->min_price) . '</br>';
        $max_price = round($filter_details->max_price);
        //$loc_data['locations'] = $this->Hotels_Model->get_locations_list($this->sess_id);

        $location_result = '';
        if (!empty($loc_data['locations'])) {
           // $location_result = $this->load->view('location_list_ajax', $loc_data, TRUE);
        }
//print_r($this->session->all_userdata());//exit;
        $temp_data = $this->Hotels_Model->all_fetch_search_result($this->sess_id, $offset = 0, $this->perPage());
        // echo $this->db->last_query().'<pre/>';print_r($temp_data);exit;
        $api_info = $this->Hotels_Model->getActiveAPIs();
        if (!empty($temp_data)) {
            $hotels_search_result = '';
			$hotels_search_location = '';
			$hotelcode="";
			
            for ($i = 0; $i < count($temp_data); $i++) {
               //if ($temp_data[$i]->api == 'tbohotels') {
                    $subdata['detailroomdata'] = $this->Hotels_Model->get_hotel_result_rooms($temp_data[$i]->session_id, $temp_data[$i]->hotel_code, $temp_data[$i]->api);                    
					// $amenities = $this->Hotels_Model->get_gta_amenities($temp_data[$i]->hotel_code);
                    // $temp_data[$i]->amenities = $amenities;
                    //$subdata['result'] = $temp_data[$i];
                   $ri= $subdata['result'] = $subdata['detailroomdata'][0];

                    $hotels_search_result .= $this->load->view('tbohotels/search_result_ajax', $subdata, TRUE);
                     $hj[]=$ri->hotel_code;
					//$hotelcode.='.$ri->hotel_code.'.",";
                    

                //}
            }
		$hil=	implode(",",$hj);
						$q="Select DISTINCT  LocationCategoryCode  from hotel_city where TBOHotelCode IN(".$hil.")";
					
			$ti=  $this->db->query($q)->result_array();
			// echo $this->db->last_query();exit;
			
			foreach($ti as $loc){
			 if($loc["LocationCategoryCode"]!=NULL){
                 //echo "select * from hotel_location where TagId='".$loc["LocationCategoryCode"]."'";
                 
				//  echo trim($loc["LocationCategoryCode"]);
                   $m= $subdata["tid"]=  $this->db->query("select * from hotel_location where TagId='".$loc["LocationCategoryCode"]."'")->row(); 
				//    echo $this->db->last_query();
			if($m){	 
				$subdata["tbolistc"]="";
				$m1=   $this->db->query("select * from hotel_city where LocationCategoryCode='".$loc["LocationCategoryCode"]."'")->result_array(); 
                foreach( $m1 as $m11){
                 $pl[]=$m11["TBOHotelCode"];
                
				}
				$im=implode(",",$pl);
                  
				 $subdata["totals"]=  $this->db->query("select count(*) as total from hotel_search_result where hotel_code IN($im)")->row();
				 $hotels_search_location .= $this->load->view('tbohotels/search_result_location',  $subdata, TRUE);
			  }
			}
            
			}//exit;
			
		
        } else {

            //if (count($api_info)+1 == $count) {
                $hotels_search_result = $this->load->view('no_result_ajax', $subdata, TRUE);
           // }
        }

        echo json_encode(array(
            'hotels_search_result' => $hotels_search_result,
			'hotels_search_location' => $hotels_search_location,
            'paging' => $paging,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'locations' => $location_result
        ));
	}

	public function searchresult_ajax($offset = 0, $scro = 0) {
	    $this->load->library('Ajax_pagination');
        // $hotel_search_data = $this->session->userdata('hotel_search_data');
        $hotel_search_data = unserialize($_POST['searcharray']);
        //  $rooms = $hotel_search_data['rooms'];
        //  $nights = $hotel_search_data['nights'];
// echo '<pre>';print_r($_POST);exit;
        $pdata['minPrice'] = $minPrice = '';
        $pdata['maxPrice'] = $maxPrice = '';
        if (isset($_POST['minPrice']) && @$_POST['maxPrice']) {
            $pdata['minPrice'] = $_POST['minPrice'];
            $pdata['maxPrice'] = $_POST['maxPrice'];
//            $minPrice    = round(($_POST['minPrice'] * $rooms * $nights),2);
//            $maxPrice    = round(($_POST['maxPrice'] * $rooms * $nights),2);

            $minPrice = round($_POST['minPrice'], 2);
            $maxPrice = round($_POST['maxPrice'], 2);
        }

        $pdata['starRating'] = '';

        if (isset($_POST['starRating']) && $_POST['starRating'] != '') {
            $pdata['starRating'] = $_POST['starRating'];
        }

        $pdata['tbolistc'] = '';

		if (isset($_POST['tbolistc']) && $_POST['tbolistc'] != '') {
            $pdata['tbolistc'] = $_POST['tbolistc'];
        }
		//print_r($pdata['tbolistc']);
      //exit;
        $pdata['hotelName'] = '';
        if (@$_POST['hotelName'] && $_POST['hotelName'] != '') {
            $pdata['hotelName'] = $_POST['hotelName'];
        }

        $pdata['location'] = '';
        if (@$_POST['location'] && $_POST['location'] != '') {
            $pdata['location'] = $_POST['location'];
        }

        $sortBy = $order = '';
        if (@$_POST['sortBy'] && $_POST['sortBy'] != '') {
            $pdata['sortBy']=$sortBy = $_POST['sortBy'];
            $pdata['order']=$order = $_POST['order'];
        }

        $pdata['sessionId'] = $_POST['sessionId'];

        $pdata['TotalRec'] = $this->Hotels_Model->TotalSearchResults($pdata['sessionId'], $minPrice, $maxPrice,$pdata['tbolistc'], $pdata['starRating'], $pdata['hotelName'], $pdata['location']);
        $pdata['perPage'] = $this->perPage();
        $pdata['perPage'] = 100;
        $pdata['ajax_function'] = 'searchresult_ajax';
        //echo $this->db->last_query();exit;
        $subdata['paging'] = $paging = $this->load->view('paging', $pdata, TRUE);
        // print_r($paging);exit;
        $temp_data = $this->Hotels_Model->all_fetch_search_result($pdata['sessionId'], $offset, $pdata['perPage'], $minPrice, $maxPrice,$pdata['tbolistc'], $pdata['starRating'], $pdata['hotelName'], $pdata['location'], $sortBy, $order);

         //echo $this->db->last_query()."<pre>";print_r($temp_data);exit;
        if (!empty($temp_data)) {
            $hotels_search_result = '';
			$hotels_search_location = '';
            //$hotels_search_result .= $this->load->view('showhide',TRUE);
            for ($i = 0; $i < count($temp_data); $i++) {

              // if ($temp_data[$i]->api == 'tbohotels') {
                    $subdata['detailroomdata'] = $this->Hotels_Model->get_hotel_result_rooms($temp_data[$i]->session_id, $temp_data[$i]->hotel_code, $temp_data[$i]->api);
                    // $amenities = $this->Hotels_Model->get_gta_amenities($temp_data[$i]->hotel_code);
                    // $temp_data[$i]->amenities = $amenities;
                    //$subdata['result'] = $temp_data[$i];
					$ri= $subdata['result'] = $subdata['detailroomdata'][0];
                    // echo '<pre>';
                    // print_r($subdata['result']);
                    // exit;
                    $hotels_search_result .= $this->load->view('tbohotels/search_result_ajax', $subdata, TRUE);
					$hji[]=$ri->hotel_code;
                //}
            }


			$temp_datas = $this->Hotels_Model->all_fetch_search_result($this->sess_id, $offset = 0, $this->perPage());
			//echo $this->db->last_query()."<pre>";print_r($temp_data);exit;
			for ($i = 0; $i < count($temp_datas); $i++) {

				// if ($temp_data[$i]->api == 'tbohotels') {
					  $subdata['detailroomdata'] = $this->Hotels_Model->get_hotel_result_rooms($temp_datas[$i]->session_id, $temp_datas[$i]->hotel_code, $temp_datas[$i]->api);
					  
					  $ri= $subdata['result'] = $subdata['detailroomdata'][0];
					   $hj[]=$ri->hotel_code;
				  //}
			  }
             

			  $hil=	implode(",",$hj);
			  $hili=	implode(",",$hji);
						$q="Select DISTINCT  LocationCategoryCode  from hotel_city where TBOHotelCode IN(".$hil.")";
					
			$ti=  $this->db->query($q)->result_array();
			foreach($ti as $loc){
			 if($loc["LocationCategoryCode"]!=NULL){
                   $m= $subdata["tid"]=  $this->db->query("select * from hotel_location where TagId='".$loc["LocationCategoryCode"]."'")->row(); 
			if($m){	 
				//$subdata["tbolistc"]="";
				$subdata["tbolistc"]=$pdata['tbolistc'];
                //$subdata["tbolistc"]= $lists=explode(",",$tbolistc);
				 $co=0;$cot=0;
				 $tp=$subdata["tot"]=  $this->db->query("select * from hotel_city where LocationCategoryCode='".$loc["LocationCategoryCode"]."'")->result_array();
               foreach($tp as $tps) {
                $mp[]=$tps["TBOHotelCode"];
				
				
			    }
			
			$mps=	implode(",",$mp);
				 $subdata["totals"]=  $this->db->query("select count(*) as total from hotel_search_result where hotel_code IN (".$hili.") and session_id='".$this->sess_id."'")->row();
                 
				 $hotels_search_location .= $this->load->view('tbohotels/search_result_location_data',  $subdata, TRUE);
			  }
			}
			}

			



        } else {
            $hotels_search_result = $this->load->view('no_result_ajax', $subdata, TRUE);
			$this->session->unset_userdata('hotel_search_activate');
        }

        echo json_encode(array(
            'hotels_search_result' => $hotels_search_result,
			'hotels_search_location' => $hotels_search_location,
            'paging' => $paging
        ));
	}

	public function details($params) {
		$this->session->set_userdata('hotel_search_activate', '1');
		// echo '<pre/>';print_r($_POST);exit;
		$params=explode('/',base64_decode($params));
		if (isset($params[0]) && isset($params[1]) && isset($params[2])) {
			$api = trim($params[0]);
			$hotelCode = trim($params[1]);
			$searchId = trim($params[2]);
			//echo $hotelCode;exit;
			$this->load->module('hotels/' . $api);
			$errorMsg = '';
			if (isset($params[3])) {
				$errorMsg = $params[3];
			}
			// echo '<pre/>';print_r($params);exit;
			$this->$api->hotel_details($hotelCode, $searchId, $errorMsg);
		} else {
			echo 'Permission Denied';
		}
	}

	public function rooms_availability() {
		  // echo '<pre/>';print_r($_POST);
		//  $this->session_check();
		 if (isset($_POST['callBackId']) && isset($_POST['hotelCode'])) {
		 	// echo 1;
			 $api = base64_decode($_POST['callBackId']);
			 $hotelCode = trim($_POST['hotelCode']);
			 $session_id = trim($_POST['sessionId']);
 
			 $this->load->module('hotels/' . $api);
			 if ($api == 'tbohotels') {
				 $searchId = trim($_POST['searchId']);
				 $this->$api->rooms_availability($session_id, $hotelCode, $searchId);
			 }
		 } else {
			 echo 'Permission Denied';
		 }
	}

	public function nearby_hotels() { echo 1;exit;
		//echo '<pre/>';print_r($_POST);exit;
		if (isset($_POST['callBackId']) && isset($_POST['hotelCode'])) {
			$api = base64_decode($_POST['callBackId']);
			$session_id = trim($_POST['sessionId']);
			$hotelCode = trim($_POST['hotelCode']);
			$latitude = trim($_POST['latitude']);
			$longitude = trim($_POST['longitude']);
			$city = trim($_POST['city']);

			$this->load->module('hotels/' . $api);
			$this->$api->nearby_hotels($session_id, $hotelCode, $latitude, $longitude, $city);
		} else {
			echo 'Permission Denied';
		}
	}

	public function itinerary() {
		    // echo '<pre/>';print_r($_REQUEST);exit;
		 
		 if (isset($_REQUEST['callBackId']) && isset($_REQUEST['hotelCode']) && isset($_REQUEST['sessionId'])) {
			 $api = base64_decode($_REQUEST['callBackId']);
			 //echo '<pre/>';print_r($api);exit;
			 $sessionId = trim($_REQUEST['sessionId']);
			 $hotelCode = trim($_REQUEST['hotelCode']);
			 $combo_type = trim($_POST['combo_type']);
			 $room_count = trim($_POST['room_count']);
 
			//  $session_data = $this->session->userdata('hotel_search_data');
			 //echo '<pre/>';print_r($session_data['uniqueRefNo']);exit;
			 //	echo $_SERVER['REMOTE_ADDR'];

			 if ($api == 'tbohotels') {
				 //echo 'in';
				//  $session_data = $this->session->userdata('hotel_search_data');
				 //echo '<pre>';print_r($session_data);exit;
				 if ($combo_type == 1) {
					 //echo 'in';
					 $searchId = '';
					 for ($i = 0; $i < $room_count; $i++) {
						 //echo 'in';
						 $search = trim($_POST['searchId' . $i]);
						 $searchId.=$search . ',';
						 //echo '<pre/>';print_r($_POST['searchId']);exit;
					 }
				 } else {
					 $search = trim($_POST['searchId']);
					 $searchId = $search;
				 }
			 } else {
				 $searchId = trim($_REQUEST['searchId']);
			 }
			 $this->load->module('hotels/' . $api);
			 $this->$api->hotel_itinerary($sessionId, $hotelCode, $searchId);
		 } else {
			 echo 'Permission Denied';
		 }
	}

	public function reservation() {
	//  echo '<pre/>';print_r($_GET);exit;
	 
	if (isset($_REQUEST['callBackId']) && isset($_REQUEST['hotelCode']) && isset($_REQUEST['searchId'])) {
		/* $this->form_validation->set_rules('user_email', 'Email Address', 'trim|required|valid_email');
		 $this->form_validation->set_rules('user_mobile', 'Mobile No', 'trim|required|integer|min_length[10]');
		 
		 if ($this->form_validation->run($this) == FALSE) { echo 'validation fail';
			
		 } else {
			 $this->session->set_userdata('passenger_info', $_POST);*/
			 //  echo '<pre>';print_r($this->session->userdata('passenger_info'));exit;
			 $pass_info    = $this->session->passenger_info;

			 //$api = base64_decode($_REQUEST['callBackId']);	
			 $api = base64_decode($pass_info['callBackId']);			 			
			 $hotelCode = $pass_info['hotelCode'];
			 $searchId = $pass_info['searchId'];
			 $sessionId = $pass_info['sessionId'];
			 $payment_type = $pass_info['payment_type'];
			 //print_r($pass_info);
			 //print_r($api);
			 /*$api = base64_decode($_GET['callBackId']);
			 $hotelCode = trim($_GET['hotelCode']);
			 $searchId = $_GET['searchId'];
			 $sessionId = $_GET['sessionId'];
			 $payment_type = $this->input->post('payment_type');*/		
			 if ($api == 'tbohotels') {
			 
			 $this->load->module('hotels/' . $api);
			 $this->$api->hotel_reservation($sessionId, $hotelCode, $searchId);
			}elseif ($api == 'hotel_crs') {
			 
			 $this->load->module('hotels/' . $api);
			 $this->$api->hotel_reservation($sessionId, $hotelCode, $searchId);
			}elseif($api == 'travelguru'){
			 $this->load->module('hotels/' . $api);
			 $this->$api->provision_booking($sessionId, $hotelCode, $searchId);
			/* if ($payment_type == 'deposit') {
					$this->$api->payment_process($sessionId, $hotelCode, $searchId);
				 } */
			 //$this->$api->hotel_reservation($sessionId, $hotelCode, $searchId);
			}
			 exit;

				 if ($payment_type == 'deposit') {
					$this->$api->hotel_reservation($sessionId, $hotelCode, $searchId);
				 } else {
					// $this->$api->payment_process($sessionId, $hotelCode, $searchId);
				 }
		  /* }*/

	  }
	
	}

	public function confirm_reservation() {
		// print_r($_POST);exit;
   if (isset($_POST['callBackId']) && isset($_POST['hotelCode']) && isset($_POST['searchId'])) {


	   $this->form_validation->set_rules('user_email', 'Email Address', 'trim|required|valid_email');
	   $this->form_validation->set_rules('user_mobile', 'Mobile No', 'trim|required|integer|min_length[10]');
	   
	   if ($this->form_validation->run($this) == FALSE) { echo 'validation fail';
		  
	   } else {
		   $this->session->set_userdata('passenger_info', $_POST);
			 /*echo '<pre>';print_r($this->session->userdata('passenger_info'));
			 exit;*/
		   $api = base64_decode($_REQUEST['callBackId']);
		   $hotelCode  = trim($_REQUEST['hotelCode']);
		   $searchId = $_REQUEST['searchId'];
		   $sessionId = $_REQUEST['sessionId'];
		   $payment_type = $this->input->post('payment_type');
		  /* $data['room_data'] = $this->Hotels_Model->get_selected_hotel($hotelCode, $id, $sessionId, $searchId);
			echo $this->db->last_query();exit;*/
		   //echo '<pre>sss';print_r($data['room_data']);exit;
		   if ($api == 'tbohotels') {
			   $data['room_data'] = $this->Hotels_Model->get_selected_hotel($hotelCode, $sessionId, $searchId);
			//    echo $this->db->last_query();exit;
			   if($this->session->agent_logged_in || 
				   $this->session->corporate_sub_logged_in ){

					redirect('hotels/reservation?callBackId=' . $api . '&hotelCode=' . $hotelCode . '&searchId=' . $searchId . '&sessionId=' . $sessionId);
			   }else{
				//    echo '<pre>sss';print_r($data);exit;
				// $this->load->view('confirm_reservation', $data);
				 echo json_encode(array('results' => 'success'));
			   }
		   /*$this->load->module('hotels/' . $api);
		   $this->$api->hotel_reservation($sessionId, $hotelCode, $searchId);*/
		  }if($api == 'travelguru'){
			  $data['room_data'] = $this->Hotels_Model->get_selected_hotel($hotelCode, $id, $sessionId, $searchId);
			  $this->load->view('confirm_reservation', $data);
		   /*$this->load->module('hotels/' . $api);
		   $this->$api->provision_booking($sessionId, $hotelCode, $searchId);*/
		  
		   }if($api == 'hotel_crs'){
			  $data['room_data'] = $this->Hotels_Model->get_selected_hotel_crs($hotelCode, $id, $sessionId, $searchId);	
			  if($this->session->agent_logged_in || 
				   $this->session->corporate_sub_logged_in ){

					redirect('hotels/reservation?callBackId=' . $api . '&hotelCode=' . $hotelCode . '&searchId=' . $searchId . '&sessionId=' . $sessionId);
			   }else{

				$this->load->view('confirm_reservation', $data);	 
			  }
		  }
		   exit;

			   
		 }

	}
  }

	public function voucher1() {
		if (isset($_GET['voucherId'])) {
            $sysRefNo = $_GET['voucherId'];
            //echo '<pre>';print_r($sysRefNo);exit;
            $data['hotel_booking_info'] = $this->Hotels_Model->get_hotel_booking_information($sysRefNo);
            $data['passenger_info'] = $this->Hotels_Model->get_hotel_booking_passenger_info($sysRefNo);
            //sms gateway
            // echo "<pre/>";print_r($data);
            // echo $this->db->last_query();exit;
            $this->load->view('voucher', $data);
        } else {
            echo 'Permission Denied';
        }
	}

	public function voucher() {
		if (isset($_GET['voucherId'])) {
            $sysRefNo = $_GET['voucherId'];
            //echo '<pre>';print_r($sysRefNo);exit;
            $data['hotel_booking_info'] = $this->Hotels_Model->get_hotel_booking_information($sysRefNo);
            $data['passenger_info'] = $this->Hotels_Model->get_hotel_booking_passenger_info($sysRefNo);
            $ref_no = $data['hotel_booking_info']->uniqueRefNo;
            $status = $data['hotel_booking_info']->Booking_Status;
            //echo $data['passenger_info'][0]->title;
            $name = $data['passenger_info'][0]->first_name;
            $mobnumber = $data['passenger_info'][0]->mobile;
            $ins = $data['hotel_booking_info']->report_id;
            //	print_r($ins);exit;
            //	exit;
            // echo $this->db->last_query();exit;
            $voucher = $this->load->view('voucher_content', $data,'TRUE');
            //$this->load->view('voucher', $data); //echo 123;exit;
//email
            //$pass_info=$this->session->userdata('pass_info');print_r($pass_info);exit;
            $usermail = $data['passenger_info'][0]->email;
            $name = $data['passenger_info'][0]->first_name;
//$title=$data['passenger_info'][0]->Title;
            // $this->load->module('home/email');
            // $data_email = array(
            //     'ticket_url' => site_url() . 'hotels/voucher1?voucherId=' . $sysRefNo . '&hotelRefId=' . $hotelRefNo,
            //     'user_email' => $usermail,
            //     'name' => $name,
            //     'subject' => 'Hotel Booking',
            //     'title' => 'Mr/Ms',
            //     'voucher' => $voucher
            // );
            // // print_r($data_email);
            // $this->email->ticket_email($data_email);
        } else {
            echo 'Permission Denied';
        }
        redirect('hotels/voucher1?voucherId=' . $sysRefNo);
	}

	public function beforeCancelVoucher($callBackId,$uniqueRefNo,$Booking_RefNo='') {
		// echo $Booking_RefNo;exit;
		$api = base64_decode($callBackId);
		// $hotel_booking_info = $this->Hotels_Model->hotelBookingSummary($uniqueRefNo, $Booking_RefNo);
		if ($api == 'travelguru') {
			$this->load->module('hotels/' . $api);
			$returndata = $this->$api->initiateCancellation($uniqueRefNo, $Booking_RefNo);
		}
		if(!empty($returndata)){
			// $data['hotel_booking_summary'] = $hotel_booking_info;
			$returndata['uniqueRefNo'] = $uniqueRefNo;
			$returndata['Booking_RefNo'] = $Booking_RefNo;
			$this->load->view('hotel_cancel/booking_cancel_confirm', $returndata);
		} else {
			echo 'Permission Denied';
		}
	}

	public function confrimCancelVoucher($callBackId,$uniqueRefNo,$Booking_RefNo='') {
		$api = base64_decode($callBackId);
		if ($api == 'travelguru') {
			$this->load->module('hotels/' . $api);
			$returndata = $this->$api->confirmCancellation($uniqueRefNo, $Booking_RefNo);
		}
		if(!empty($returndata) && $returndata['message'] != 'Failed'){
			$msg = 'Cancellation completed';
			redirect('home/success_page/'.base64_encode($msg), 'refresh');
		} else {
			$msg = 'Cancellation failed';
			redirect('home/error_page/'.base64_encode($msg), 'refresh');
		}
	}

	public function generateRandomString($len=8) {
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $string = '';
        for ($i = 0; $i < $len; $i++) {
            $pos = rand(0, strlen($chars) - 1);
         //   $string .= $chars{$pos};
        }
        $currentdate=date('ymd');
        if ($this->session->userdata('agent_logged_in')) {
            return 'MTP'. $currentdate.$string;
        }else{
            return 'MTP'. $currentdate.$string;
        }
    }

	public function perPage() {
		return 15;
	}

	public function dateDiff($start, $end) {
		$start_ts = strtotime($start);
		$end_ts = strtotime($end);
		$diff = $end_ts - $start_ts;

		return round($diff / 86400);
	}
	
	public function auto_hotel_name(){
		if (isset($_GET['term'])) {
			$session_data = $this->session->userdata('hotel_search_data');
			$search = $_GET["term"];
			$sess_id = $this->sess_id;
			$uniqueRefNo = $session_data['uniqueRefNo'];
			$hotel_lists = $this->Hotels_Model->getHotelByCity($sess_id,$uniqueRefNo,$search);
			// echo $this->db->last_query();
			// echo '<pre>';print_r($hotel_lists);exit;
			if (!empty($hotel_lists)) {
				for ($i = 0; $i < count($hotel_lists); $i++) {
					$hotel_name = strtolower($hotel_lists[$i]['hotel_name']);
					$return_arr[] = array(
						'label' => ucwords($hotel_name),
						'value' => ucwords($hotel_name),
						'id'=> ucwords($hotel_name)
					);
				}
			} else {
				$return_arr[] = array(
					'label' => "No Results Found",
					'value' => "",
					'id'=> ''
				);
			}
		} else {
			$return_arr[] = array(
				'label' => "No Results Found",
				'value' => "",
				'id'=> ''
			);
		}
		echo json_encode($return_arr);
	}

	public function static_hotel_city()
	{
		
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://api.tektravels.com/SharedServices/StaticData.svc/rest/GetHotelStaticData',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "CityId": "111124",
  "ClientId": "ApiIntegrationNew",
  "EndUserIp": "49.206.33.42",
  "TokenId": "aabd9013-98bd-49f9-9ac2-e5bb3aac13b2",
  "IsCompactData": "true"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$result = curl_exec($curl);

curl_close($curl);
$response = json_decode($result, true);
// echo"<pre>";print_r($response['HotelData']);exit;

$xml = simplexml_load_string(preg_replace('/(<\?xml[^?]+?)utf-16/i', '$1utf-8', $response['HotelData'])); 							
$array = json_decode(json_encode((array) $xml), true);	
// echo"<pre>";print_r($array['BasicPropertyInfo']);exit;

foreach($array['BasicPropertyInfo'] as $basicpropertyinfo){
	$basicpropertyinfo2 = $basicpropertyinfo['@attributes'];
	// echo"<pre>";print_r($basicpropertyinfo2);
	if(!empty($basicpropertyinfo2['BrandCode'])){ $BrandCode = $basicpropertyinfo2['BrandCode']; }else{ $BrandCode =''; }
	if(!empty($basicpropertyinfo2['HotelCityCode'])){$HotelCityCode = $basicpropertyinfo2['HotelCityCode']; }else{$HotelCityCode ='';}
	if(!empty($basicpropertyinfo2['HotelName'])){$HotelName = $basicpropertyinfo2['HotelName']; }else{$HotelName ='';}
	if(!empty($basicpropertyinfo2['LocationCategoryCode'])){$LocationCategoryCode = $basicpropertyinfo2['LocationCategoryCode']; }else{$LocationCategoryCode ='';}
	if(!empty($basicpropertyinfo2['IsHalal'])){$IsHalal = $basicpropertyinfo2['IsHalal']; }else{$IsHalal ='';}
	if(!empty($basicpropertyinfo2['TBOHotelCode'])){$TBOHotelCode = $basicpropertyinfo2['TBOHotelCode']; }else{$TBOHotelCode ='';}
		
	$data = array(
		"BrandCode" => $BrandCode,
		"HotelCityCode" => $HotelCityCode,
		"HotelName" => $HotelName,
		"LocationCategoryCode" => $LocationCategoryCode,
		"IsHalal" => $IsHalal,
		"TBOHotelCode" => $TBOHotelCode
	);

	// echo"<pre>";print_r($data);
	$this->Hotels_Model->insert_tbostaticcity($data);

	}
}
}
