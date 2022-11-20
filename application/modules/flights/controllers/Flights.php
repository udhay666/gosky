<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');


class Flights extends MX_Controller {

  const RefPrefix = 'Etp';

  private $sess_id;
  private $payurl;
  private $merchantkey;
  private $salt;
  private $allowed_ssr_fligts = array('AK', 'G9', 'FZ', '6E');
  private $enable_email;

  public function __construct() {
    parent::__construct();
      $this->load->library('Pdf_report');
        $this->enable_email = true;
        $this->load->model('Flights_Model');        
        $this->sess_id = $this->session->session_id;
    }

    public function index() {
      $this->load->view('home/index');
    }
    
    public function results() { 
      // echo '<pre>';print_r($_POST);exit;
      $this->session->unset_userdata('search_details');
      $this->form_validation->set_rules('fromCity', 'From City', 'trim|required|min_length[3]');
      $this->form_validation->set_rules('toCity', 'To City', 'trim|required|min_length[3]');
      $this->form_validation->set_rules('departDate', 'Departure Date', 'required');

      $tripType = $this->input->post('tripType');

      if ($tripType == 'round') {
          $this->form_validation->set_rules('returnDate', 'Return Date', 'required');
        }

        if ($this->form_validation->run($this) == FALSE) {
          redirect('home');
       } else {
          $tripType = $this->input->post('tripType');            
          $fromCity = $this->input->post('fromCity');
          $toCity = $this->input->post('toCity');
          $departDate2 = $this->input->post('departDate');
          $departDate = date('Y/m/d',strtotime($departDate2));
          $returnDate2 = $this->input->post('returnDate');
          $returnDate = date('Y/m/d',strtotime($returnDate2));
          $airlines = $this->input->post('provider');
          $adults = $this->input->post('adult_count');
          $childs = $this->input->post('child_count');
          $infants = $this->input->post('infant_count');
          $cabinClass = $this->input->post('class');
          $stops = $this->input->post('direct');
          if($stops == 1){$stops="DIRECT";}else{$stops="ALL";}

          $originService = $this->Flights_Model->getAirportServiceType($this->getAirportCode($fromCity));
         $destinationService = $this->Flights_Model->getAirportServiceType($this->getAirportCode($toCity));
          // echo $this->db->last_query();exit;
         if($originService == 1 && $destinationService == 1) {
           $flightmode = 1;
         } else {
           $flightmode = 2;
         }
        //  echo $flightmode;exit;

          if (!empty($fromCity)) {
              $session_data = $this->session->flight_search_data;

              if (!empty($session_data)) {
                  $sess_tripType = $session_data['tripType'];                    
                  $sess_fromCity = $session_data['fromCity'];
                  $sess_toCity = $session_data['toCity'];
                  $sess_departDate = $session_data['departDate'];
                  $sess_returnDate = $session_data['returnDate'];
                  $sess_adults = $session_data['adult_count'];
                  $sess_childs = $session_data['child_count'];
                  $sess_infants = $session_data['infant_count'];
                  $sess_cabinClass = $session_data['class'];
                  $sess_stops = $session_data['direct'];
                  $sess_airlines = $session_data['provider'];

                  if ($sess_tripType == $tripType && $sess_fromCity == $fromCity && $sess_toCity == $toCity && $sess_departDate == $departDate && $sess_returnDate == $returnDate && $sess_adults == $adults && $sess_childs == $childs && $sess_infants == $infants && $sess_cabinClass == $cabinClass && $sess_stops == $stops && $sess_airlines==$airlines) {
                      $this->session->set_userdata('flight_search_activate', 1);
                      $sess_uniqueRefNo=$session_data['sess_uniqueRefNo'];
                    } else {
                      $sess_uniqueRefNo=$this->generateReferenceNo(8);
                      $this->session->set_userdata('flight_search_activate', '');
                    }
              }else {
                  $sess_uniqueRefNo=$this->generateReferenceNo(8);
                  $this->session->set_userdata('flight_search_activate', '');
                }
                $sess_array = array(
                  'tripType' => $tripType,
                  'fromCity' => $fromCity,
                  'toCity' => $toCity,
                  'departDate' => $departDate,
                  'returnDate' => $returnDate,
                  'adult_count' => $adults,
                  'child_count' => $childs,
                  'infant_count' => $infants,
                  'class' => $cabinClass,
                  'direct'=>$stops,
                  'provider'=>$airlines,
                  'flightmode' => $flightmode,
                  'stops'=> $stops,
                  'sess_uniqueRefNo'=>$sess_uniqueRefNo
                  );

                  $api_info = $this->Flights_Model->getActiveAPIs();
                  // echo $this->db->last_query();exit;
                  // echo"<pre>";print_r($api_info);exit;
                  $api_list = array();
                  if (!empty($api_info)) {
                    $a = 0;
                    foreach ($api_info as $api) {
                      $api_list[$a] = base64_encode($api['api_name']);
                      $a++;
                    }
                  }
                  $data['api_list'] = $api_list;
                  $data['searcharray']=$sess_array;                
           $this->load->view('search_result', $data);
           // redirect('flights/flight_search_result', 'refresh');
         } else {
           $this->load->view('home/index2/AED');
         }
       }
     }

    public function multi_results() {
      // echo"<pre>";print_r($_POST);exit;
      $fromCity = $this->input->post('fromCity');
      if (!empty($fromCity)) {
        foreach ($fromCity as $fc_id => $fc_val) {
          $this->form_validation->set_rules('fromCity[' . $fc_id . ']', 'FromCity ', 'trim|required');
        }
      }
      $toCity = $this->input->post('toCity');
      if (!empty($toCity)) {
        foreach ($toCity as $tc_id => $tc_val) {
          $this->form_validation->set_rules('toCity[' . $tc_id . ']', 'FromCity ', 'trim|required');
        }
      }
      $departDate = $this->input->post('mdepature');
      if (!empty($departDate)) {
        foreach ($departDate as $da_id => $da_val) {
          $this->form_validation->set_rules('mdepature[' . $da_id . ']', 'FromCity ', 'trim|required');
        }
      }
  
      $tripType = $this->input->post('trip_type');
      // $flightmode = $this->input->post('flightmode');
      $adults = $this->input->post('adult_count');
      $childs = $this->input->post('child_count');
      $infants = $this->input->post('infant_count');
      $cabinClass = $this->input->post('class');
      $stops = $this->input->post('stops');
       $airlines = $this->input->post('airlines');

       
  
      if ($this->form_validation->run($this) == FALSE) {
        $this->load->view('home/index');
      } else {
        $session_data = $this->session->flight_search_data;
        if (!empty($session_data)) {
          $sess_tripType = $session_data['tripType'];
          $sess_fromCity = $session_data['fromCity'];
          $sess_toCity = $session_data['toCity'];
          $sess_departDate = $session_data['departDate'];
  
          $sess_adults = $session_data['adults'];
          $sess_childs = $session_data['childs'];
          $sess_infants = $session_data['infants'];
          $sess_cabinClass = $session_data['cabinClass'];
          $sess_stops = $session_data['stops'];
             $sess_airlines = $session_data['airlines'];
  
          if ($sess_tripType == $tripType && $sess_fromCity == $fromCity && $sess_toCity == $toCity && $sess_departDate == $departDate && $sess_adults == $adults && $sess_childs == $childs && $sess_infants == $infants && $sess_cabinClass == $cabinClass && $sess_stops == $stops && $sess_airlines==$airlines) {
            $this->session->set_userdata('flight_search_activate', 1);
            $sess_uniqueRefNo=$session_data['sess_uniqueRefNo'];
          } else {
            $sess_uniqueRefNo=$this->generateReferenceNo(8);
            $this->session->set_userdata('session_key', $this->session->userdata('session_id'));
            $this->session->set_userdata('flight_search_activate', '');
          }
        } else {
          $sess_uniqueRefNo=$this->generateReferenceNo(8);
          $this->session->set_userdata('session_key', $this->session->userdata('session_id'));
          $this->session->set_userdata('flight_search_activate', '');
        }
          $returnDate = '';
          $sess_array = array(
            'tripType' => $tripType,
            'fromCity' => $fromCity,
            'toCity' => $toCity,
            'departDate' => $departDate,
            'returnDate' => $returnDate,
            'adult_count' => $adults,
            'child_count' => $childs,
            'infant_count' => $infants,
            'class' => $cabinClass,
            'flightmode' => $flightmode,
            'stops'=>$stops,
             'airlines'=>$airlines,
            'sess_uniqueRefNo'=>$sess_uniqueRefNo
            );
           
  // echo '<pre>';print_r($sess_array);exit;
         $this->session->set_userdata('flight_search_data', $sess_array);
  
          $api_info = $this->Flights_Model->getActiveAPIs();
          // echo '<pre/>';print_r($api_info);exit;
          $api_list = array();
          if (!empty($api_info)) {
            $a = 0;
            foreach ($api_info as $api) {
              $api_list[$a] = base64_encode($api['api_name']);
              $a++;
            }
          }
          $data['api_list'] = $api_list;
          $data['searcharray']=$sess_array;  
          //$this->load->view('multiway_search_result', $data);
          $this->load->view('multiway_search_result', $data);
      }
    }
    public function flight_muiltiway_search_result() {
      $api_info = $this->Flights_Model->getActiveAPIs();
            //echo '<pre/>';print_r($sess_array);exit;
      $api_list = '';
      if (!empty($api_info)) {
        $a = 0;
        foreach ($api_info as $api) {
          $api_list[$a] = base64_encode($api['api_name']);
          $a++;
        }
      }
    
      $data['api_list'] = $api_list;
    
      $this->load->view('multiway_search_result', $data);
    }

     public function generateReferenceNo($len, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') {
        $string = '';
        for ($i = 0; $i < $len; $i++) {
            $pos = rand(0, strlen($chars) - 1);
            $string .= $chars[$pos];
        }
        $currentdate=date('ymd');
        if ($this->session->userdata('agent_logged_in')) {
            return 'MTP'. $currentdate.$string;
        }else{
            return 'MTP'. $currentdate.$string;
        }
    }

    public function flights_availabilty() { 
      // echo 123;exit;
      if (isset($_POST['callBackId'])) {
        // $session_data=$this->session->userdata('flight_search_data');
        $session_data = unserialize($_POST['searcharray']);
        // echo '<pre>5';print_r(($session_data));exit;
        $api = base64_decode($_POST['callBackId']);
        // echo '<pre>5';print_r(($api));exit;
        // $api = "via";
        $this->load->module('flights/' . $api);        
        $sess_tripType = $session_data['tripType'];
        // echo $sess_tripType;exit;
        // $sess_flightmode = $session_data['flightmode'];    
        if ($sess_tripType == 'multicity') {
          $this->$api->flights_multiway_searchRQ($_POST['searcharray']);
        } else {
          $this->$api->flights_searchRQ($_POST['searcharray']);
        }
      } else {
        echo 'Permission denied';
      }
    }
    public function flight_farerules() {
      // echo '<pre>1322'; print_r($_POST);
      if (isset($_POST['callBackId']) && isset($_POST['searchId'])) {
        $api = base64_decode($_POST['callBackId']);
        $searchId = trim($_POST['searchId']);
        $this->load->module('flights/' . $api);
    
        $this->$api->flights_fareLLSRQ($searchId);
      } else {
        echo 'Permission denied';
      }
    }

    public function itinerary($urldata='',$urldata1='') {
      //  echo '<pre>';print_r($urldata1);exit;
      if(is_null($urldata)){
        echo 'Permission Denied';
        exit;
      }
      $urldata=base64_decode($urldata);
      $paramsarray=explode('/',$urldata);
      // echo '<pre>';print_r($paramsarray);exit;
      if (isset($paramsarray[0]) && isset($paramsarray[1]) && isset($paramsarray[2])) {
        $this->load->model('Tbo_Model');
        $callBackId = $paramsarray[0];
        $api = $paramsarray[0];
        $searchId = trim($paramsarray[1]);
        $segmentkey = trim($paramsarray[2]);
        $data['flight_result'] = $flight_result = $this->Flights_Model->get_flight_search_result($searchId, $segmentkey);
        // echo $this->db->last_query();exit;
        
        if (empty($flight_result)) {
          redirect('flights/results', 'refresh');
        }
        // echo $this->db->last_query();exit;
        $searchId1 = $segmentkey1 = '';
        if ($data['flight_result']->triptype == 'round' && $data['flight_result']->isdomestic == 'true') {
          if(is_null($urldata1)){
            echo 'Permission Denied';
            exit;
          }

          $urldata1=base64_decode($urldata1);
          $paramsarray1=explode('/',$urldata1);
          $searchId1 = trim($paramsarray1[1]);
          $segmentkey1 = trim($paramsarray1[2]);
          // echo '<pre>';print_r($paramsarray1);exit;
          $data['flight_result_r'] = $flight_result1 = $this->Flights_Model->get_flight_search_result($searchId1, $segmentkey1);
      }
        $this->flightformvalidation($flight_result);
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('user_mobile', 'Mobile', 'trim|required|integer|min_length[10]');
        if ($this->form_validation->run($this) == FALSE) {
          //echo 1; echo validation_errors();exit;
          $this->load->module('flights/' . $api);
          $data['country_list'] = $this->Flights_Model->get_country_list();
          $data['error_msg'] = '';
          //if ($data['flight_result']->islcc == 'true') {
          $this->$api->flights_fareLLSRQ($searchId);
          $this->$api->get_fareQuote($data['flight_result']);
          $data['ssrresponsex']=$this->$api->get_special_request($data['flight_result']);
          $data['flight_result'] = $flight_result = $this->Flights_Model->get_flight_search_result($searchId, $segmentkey);
          // echo $this->db->last_query();
          //echo $data['flight_result']->isdomestic; exit;
          //}
          if ($data['flight_result']->triptype == 'round' && $data['flight_result']->isdomestic == 'true') { sleep(2);
            $this->$api->flights_fareLLSRQ($searchId1);
            $this->$api->get_fareQuote($data['flight_result_r']);
            $data['ssrresponsex1']=$this->$api->get_special_request($data['flight_result_r']);
            $data['flight_result_r'] = $flight_result1 = $this->Flights_Model->get_flight_search_result($searchId1, $segmentkey1);
            // echo $this->db->last_query();exit;            
          }

          // echo '<pre>'; print_r((($data['flight_result']->fareresponse))); exit;
          // $this->load->view('flight_itinerary', $data);
          $this->load->view('travellers_details', $data);
        } else { 
          // echo '<pre>';print_r($flight_result);exit;
          $this->session->set_userdata('passenger_info', $_POST);
          $this->load->view('confirm_reservation', $data);
        }
      } else {
      echo 'Permission Denied';
    }
  }

  public function flightformvalidation($flight_result){
    $adultTitle = $this->input->post('adultTitle');
    if (!empty($adultTitle)) {
     foreach ($adultTitle as $at_id => $at_val) {
       $this->form_validation->set_rules('adultTitle[' . $at_id . ']', 'Adult-' . $at_id . ' Title', 'trim|required');
     }
   }
   $adultFName = $this->input->post('adultFName');
   if (!empty($adultFName)) {
     foreach ($adultFName as $af_id => $af_val) {
       $this->form_validation->set_rules('adultFName[' . $af_id . ']', 'Adult-' . $af_id . ' First Name', 'trim|required|min_length[3]');
     }
   }
   $adultLName = $this->input->post('adultLName');
   if (!empty($adultLName)) {
     foreach ($adultLName as $al_id => $al_val) {
       $this->form_validation->set_rules('adultLName[' . $al_id . ']', 'Adult-' . $al_id . ' Last Name', 'trim|required|min_length[1]');
     }
   }
   $adultDOBDate = $this->input->post('adultDOBDate');
   if (!empty($adultDOBDate)) {
     foreach ($adultDOBDate as $add_id => $add_val) {
       $this->form_validation->set_rules('adultDOBDate[' . $add_id . ']', 'Adult-' . $add_id . ' DOB Date', 'trim|required');
     }
   }
   $adultDOBMonth = $this->input->post('adultDOBMonth');
   if (!empty($adultDOBMonth)) {
     foreach ($adultDOBMonth as $adm_id => $adm_val) {
       $this->form_validation->set_rules('adultDOBMonth[' . $adm_id . ']', 'Adult-' . $adm_id . ' DOB Month', 'trim|required');
     }
   }
   $adultDOBYear = $this->input->post('adultDOBYear');
   if (!empty($adultDOBYear)) {
     foreach ($adultDOBYear as $ady_id => $ady_val) {
       $this->form_validation->set_rules('adultDOBYear[' . $ady_id . ']', 'Adult-' . $ady_id . ' DOB Year', 'trim|required');
     }
   }

   $adultPPNo = $this->input->post('adultPPNo');
   if (!empty($adultPPNo)) {
     foreach ($adultPPNo as $appn_id => $appn_val) {
       $this->form_validation->set_rules('adultPPNo[' . $appn_id . ']', 'Adult-' . $appn_id . ' Passport Number', 'trim|required|min_length[4]');
     }
   }
   $adultPPNationality = $this->input->post('adultPPNationality');
   if (!empty($adultPPNationality)) {
     foreach ($adultPPNationality as $an_id => $an_val) {
       $this->form_validation->set_rules('adultPPNationality[' . $an_id . ']', 'Adult-' . $an_id . ' Passport Nationality', 'trim|required');
     }
   }
   $adultPPIDate = $this->input->post('adultPPIDate');
   if (!empty($adultPPIDate)) {
     foreach ($adultPPIDate as $appid_id => $appid_val) {
       $this->form_validation->set_rules('adultPPIDate[' . $appid_id . ']', 'Adult-' . $appid_id . ' Passport Issue Date', 'trim|required');
     }
   }
   $adultPPIMonth = $this->input->post('adultPPIMonth');
   if (!empty($adultPPIMonth)) {
     foreach ($adultPPIMonth as $appim_id => $appim_val) {
       $this->form_validation->set_rules('adultPPIMonth[' . $appim_id . ']', 'Adult-' . $appim_id . ' Passport Issue Month', 'trim|required');
     }
   }
   $adultPPIYear = $this->input->post('adultPPIYear');
   if (!empty($adultPPIYear)) {
     foreach ($adultPPIYear as $appiy_id => $appiy_val) {
       $this->form_validation->set_rules('adultPPIYear[' . $appiy_id . ']', 'Adult-' . $appiy_id . ' Passport Issue Year', 'trim|required');
     }
   }

   $adultPPEDate = $this->input->post('adultPPEDate');
   if (!empty($adultPPEDate)) {
     foreach ($adultPPEDate as $apped_id => $apped_val) {
       $this->form_validation->set_rules('adultPPEDate[' . $apped_id . ']', 'Adult-' . $apped_id . ' Passport Expiry Date', 'trim|required');
     }
   }
   $adultPPEMonth = $this->input->post('adultPPEMonth');
   if (!empty($adultPPEMonth)) {
     foreach ($adultPPEMonth as $appem_id => $appem_val) {
       $this->form_validation->set_rules('adultPPEMonth[' . $appem_id . ']', 'Adult-' . $appem_id . ' Passport Expiry Month', 'trim|required');
     }
   }
   $adultPPEYear = $this->input->post('adultPPEYear');
   if (!empty($adultPPEYear)) {
     foreach ($adultPPEYear as $appey_id => $appey_val) {
       $this->form_validation->set_rules('adultPPEYear[' . $appey_id . ']', 'Adult-' . $appey_id . ' Passport Expiry Year', 'trim|required');
     }
   }
   $adultPPICountry = $this->input->post('adultPPICountry');
   if (!empty($adultPPICountry)) {
     foreach ($adultPPICountry as $appic_id => $appic_val) {
       $this->form_validation->set_rules('adultPPICountry[' . $appic_id . ']', 'Adult-' . $appic_id . ' Passport Issue Country', 'trim|required');
     }
   }

   $Childs = $flight_result->childs;
   if ($Childs != 0 && $Childs != '') {
     $childTitle = $this->input->post('childTitle');
     if (!empty($childTitle)) {
       foreach ($childTitle as $ct_id => $ct_val) {
         $this->form_validation->set_rules('childTitle[' . $ct_id . ']', 'Child-' . $ct_id . ' Title', 'trim|required');
       }
     }
     $childFName = $this->input->post('childFName');
     if (!empty($childFName)) {
       foreach ($childFName as $cf_id => $cf_val) {
         $this->form_validation->set_rules('childFName[' . $cf_id . ']', 'Child-' . $cf_id . ' First Name', 'trim|required|min_length[3]');
       }
     }
     $childLName = $this->input->post('childLName');
     if (!empty($childLName)) {
       foreach ($childLName as $cl_id => $cl_val) {
         $this->form_validation->set_rules('childLName[' . $cl_id . ']', 'Child-' . $cl_id . ' Last Name', 'trim|required|min_length[1]');
       }
     }
     $childDOBDate = $this->input->post('childDOBDate');
     if (!empty($childDOBDate)) {
       foreach ($childDOBDate as $cdd_id => $cdd_val) {
         $this->form_validation->set_rules('childDOBDate[' . $cdd_id . ']', 'Child-' . $cdd_id . ' DOB Date', 'trim|required');
       }
     }
     $childDOBMonth = $this->input->post('childDOBMonth');
     if (!empty($childDOBMonth)) {
       foreach ($childDOBMonth as $cdm_id => $cdm_val) {
         $this->form_validation->set_rules('childDOBMonth[' . $cdm_id . ']', 'Child-' . $cdm_id . ' DOB Month', 'trim|required');
       }
     }
     $childDOBYear = $this->input->post('childDOBYear');
     if (!empty($childDOBYear)) {
       foreach ($childDOBYear as $cdy_id => $cdy_val) {
         $this->form_validation->set_rules('childDOBYear[' . $cdy_id . ']', 'Child-' . $cdy_id . ' DOB Year', 'trim|required');
       }
     }

     $childPPNo = $this->input->post('childPPNo');
     if (!empty($childPPNo)) {
       foreach ($childPPNo as $cppn_id => $cppn_val) {
         $this->form_validation->set_rules('childPPNo[' . $cppn_id . ']', 'Child-' . $cppn_id . ' Passport Number', 'trim|required|min_length[4]');
       }
     }
     $childPPNationality = $this->input->post('childPPNationality');
     if (!empty($childPPNationality)) {
       foreach ($childPPNationality as $cn_id => $cn_val) {
         $this->form_validation->set_rules('childPPNationality[' . $cn_id . ']', 'Child-' . $cn_id . ' Passport Nationality', 'trim|required');
       }
     }
     $childPPIDate = $this->input->post('childPPIDate');
     if (!empty($childPPIDate)) {
       foreach ($childPPIDate as $cppid_id => $cppid_val) {
         $this->form_validation->set_rules('childPPIDate[' . $cppid_id . ']', 'Child-' . $cppid_id . ' Passport Issue Date', 'trim|required');
       }
     }
     $childPPIMonth = $this->input->post('childPPIMonth');
     if (!empty($childPPIMonth)) {
       foreach ($childPPIMonth as $cppim_id => $cppim_val) {
         $this->form_validation->set_rules('childPPIMonth[' . $cppim_id . ']', 'Child-' . $cppim_id . ' Passport Issue Month', 'trim|required');
       }
     }
     $childPPIYear = $this->input->post('childPPIYear');
     if (!empty($childPPIYear)) {
       foreach ($childPPIYear as $cppiy_id => $cppiy_val) {
         $this->form_validation->set_rules('childPPIYear[' . $cppiy_id . ']', 'Child-' . $cppiy_id . ' Passport Issue Year', 'trim|required');
       }
     }

     $childPPEDate = $this->input->post('childPPEDate');
     if (!empty($childPPEDate)) {
       foreach ($childPPEDate as $cpped_id => $cpped_val) {
         $this->form_validation->set_rules('childPPEDate[' . $cpped_id . ']', 'Child-' . $cpped_id . ' Passport Expiry Date', 'trim|required');
       }
     }
     $childPPEMonth = $this->input->post('childPPEMonth');
     if (!empty($childPPEMonth)) {
       foreach ($childPPEMonth as $cppem_id => $cppem_val) {
         $this->form_validation->set_rules('childPPEMonth[' . $cppem_id . ']', 'Child-' . $cppem_id . ' Passport Expiry Month', 'trim|required');
       }
     }
     $childPPEYear = $this->input->post('childPPEYear');
     if (!empty($childPPEYear)) {
       foreach ($childPPEYear as $cppey_id => $cppey_val) {
         $this->form_validation->set_rules('childPPEYear[' . $cppey_id . ']', 'Child-' . $cppey_id . ' Passport Expiry Year', 'trim|required');
       }
     }
     $childPPICountry = $this->input->post('childPPICountry');
     if (!empty($childPPICountry)) {
       foreach ($childPPICountry as $cppic_id => $appic_val) {
         $this->form_validation->set_rules('childPPICountry[' . $cppic_id . ']', 'Child-' . $cppic_id . ' Passport Issue Country', 'trim|required');
       }
     }
   }

   $Infants = $flight_result->infants;
   if ($Infants != 0 && $Infants != '') {
     $infantTitle = $this->input->post('infantTitle');
     if (!empty($infantTitle)) {
       foreach ($infantTitle as $it_id => $it_val) {
         $this->form_validation->set_rules('infantTitle[' . $it_id . ']', 'Infant-' . $it_id . ' Title', 'trim|required');
       }
     }
     $infantFName = $this->input->post('infantFName');
     if (!empty($infantFName)) {
       foreach ($infantFName as $if_id => $if_val) {
         $this->form_validation->set_rules('infantFName[' . $if_id . ']', 'Infant-' . $if_id . ' First Name', 'trim|required|min_length[3]');
       }
     }
     $infantLName = $this->input->post('infantLName');
     if (!empty($infantLName)) {
       foreach ($infantLName as $il_id => $il_val) {
         $this->form_validation->set_rules('infantLName[' . $il_id . ']', 'Infant-' . $il_id . ' Last Name', 'trim|required|min_length[1]');
       }
     }
     $infantDOBDate = $this->input->post('infantDOBDate');
     if (!empty($infantDOBDate)) {
       foreach ($infantDOBDate as $idd_id => $idd_val) {
         $this->form_validation->set_rules('infantDOBDate[' . $idd_id . ']', 'Infant-' . $idd_id . ' DOB Date', 'trim|required');
       }
     }
     $infantDOBMonth = $this->input->post('infantDOBMonth');
     if (!empty($infantDOBMonth)) {
       foreach ($infantDOBMonth as $idm_id => $idm_val) {
         $this->form_validation->set_rules('infantDOBMonth[' . $idm_id . ']', 'Infant-' . $idm_id . ' DOB Month', 'trim|required');
       }
     }
     $infantDOBYear = $this->input->post('infantDOBYear');
     if (!empty($infantDOBYear)) {
       foreach ($infantDOBYear as $idy_id => $idy_val) {
         $this->form_validation->set_rules('infantDOBYear[' . $idy_id . ']', 'Infant-' . $idy_id . ' DOB Year', 'trim|required');
       }
     }

     $childPPNo = $this->input->post('infantPPNo');
     if (!empty($infantPPNo)) {
       foreach ($infantPPNo as $ippn_id => $ippn_val) {
         $this->form_validation->set_rules('infantPPNo[' . $ippn_id . ']', 'Infant-' . $ippn_id . ' Passport Number', 'trim|required|min_length[4]');
       }
     }
     $infantPPNationality = $this->input->post('infantPPNationality');
     if (!empty($infantPPNationality)) {
       foreach ($infantPPNationality as $in_id => $in_val) {
         $this->form_validation->set_rules('infantPPNationality[' . $in_id . ']', 'Infant-' . $in_id . ' Passport Nationality', 'trim|required');
       }
     }
     $infantPPIDate = $this->input->post('infantPPIDate');
     if (!empty($infantPPIDate)) {
       foreach ($infantPPIDate as $ippid_id => $ippid_val) {
         $this->form_validation->set_rules('infantPPIDate[' . $ippid_id . ']', 'Infant-' . $ippid_id . ' Passport Issue Date', 'trim|required');
       }
     }
     $infantPPIMonth = $this->input->post('infantPPIMonth');
     if (!empty($infantPPIMonth)) {
       foreach ($infantPPIMonth as $ippim_id => $ippim_val) {
         $this->form_validation->set_rules('infantPPIMonth[' . $ippim_id . ']', 'Infant-' . $ippim_id . ' Passport Issue Month', 'trim|required');
       }
     }
     $infantPPIYear = $this->input->post('infantPPIYear');
     if (!empty($infantPPIYear)) {
       foreach ($infantPPIYear as $ippiy_id => $ippiy_val) {
         $this->form_validation->set_rules('infantPPIYear[' . $ippiy_id . ']', 'Infant-' . $ippiy_id . ' Passport Issue Year', 'trim|required');
       }
     }

     $infantPPEDate = $this->input->post('infantPPEDate');
     if (!empty($infantPPEDate)) {
       foreach ($infantPPEDate as $ipped_id => $ipped_val) {
         $this->form_validation->set_rules('infantPPEDate[' . $ipped_id . ']', 'Infant-' . $ipped_id . ' Passport Expiry Date', 'trim|required');
       }
     }
     $infantPPEMonth = $this->input->post('infantPPEMonth');
     if (!empty($infantPPEMonth)) {
       foreach ($infantPPEMonth as $ippem_id => $ippem_val) {
         $this->form_validation->set_rules('infantPPEMonth[' . $ippem_id . ']', 'Infant-' . $ippem_id . ' Passport Expiry Month', 'trim|required');
       }
     }
     $infantPPEYear = $this->input->post('infantPPEYear');
     if (!empty($infantPPEYear)) {
       foreach ($infantPPEYear as $ippey_id => $ippey_val) {
         $this->form_validation->set_rules('infantPPEYear[' . $ippey_id . ']', 'Infant-' . $ippey_id . ' Passport Expiry Year', 'trim|required');
       }
     }
     $infantPPICountry = $this->input->post('infantPPICountry');
     if (!empty($infantPPICountry)) {
       foreach ($infantPPICountry as $ippic_id => $appic_val) {
         $this->form_validation->set_rules('infantPPICountry[' . $ippic_id . ']', 'Infant-' . $ippic_id . ' Passport Issue Country', 'trim|required');
       }
     }
   }

 }
 public function getAirportCode($city) {
  preg_match_all('/\(([A-Za-z ]+?)\)/', $city, $out);
  $airportCode = $out[1];
  if (!empty($airportCode))
      return $airportCode[0];
}

public function select_flight() {
  // if (isset($_POST['searchId']) && !empty(trim($_POST['searchId']))) {
  if (isset($_POST['searchId'])) {
      $searchId = trim($_POST['searchId']);
      $data['result'] = $flight_result = $this->Flights_Model->get_flight_search_result($searchId);
          // echo '<pre/>';print_r($data);exit;
      $api=$flight_result->api;
      $selected_flight = $this->load->view($api.'/selected_flight', $data, TRUE);     

      echo json_encode(array("selected_flight" => $selected_flight));
  } else {
      echo 'Permission denied';
  }
}

 public function confirm_itinerary() {
    //echo '<pre/>';print_r($_POST);exit;
    if(@$_POST['callBackId'] && @$_POST['searchId']){

    $this->session->set_userdata('passenger_info', $_POST);
    $api = trim($_POST['callBackId']);
    $searchId = trim($_POST['searchId']);
    $segmentkey = trim($_POST['segmentkey']);

    if(isset($_POST['searchId1'])){$searchId1=trim($_POST['searchId1']);}else{$searchId1='';}
    if(isset($_POST['segmentkey1'])){$segmentkey1=$_POST['segmentkey1'];}else{$segmentkey1='';};
    
    $pass_info = $this->session->passenger_info;  
    $agent_markup=0;
    $total_cost = 0;
    
    $meal = array();
    $baggage = array();
    for ($i=0; $i < count($_POST['meal']); $i++) { 
      $meal =explode('@^@',$_POST['meal'][$i]);
    }
    for ($i=0; $i < count($_POST['baggage']); $i++) { 
      $baggage =explode('@^@',$_POST['baggage'][$i]);
    }
    
  
    $meal_code = $meal[0];
    $meal_desc = $meal[1];
    $meal_quantity = $meal[2];
    $meal_price = $meal[3];
    $meal_WayType = $meal[4];
    $Origin_ssr = $meal[5];
    $Destination_ssr = $meal[6];

    $baggage_code = $baggage[0];
    $baggage_weight = $baggage[1];
    $baggage_price = $baggage[2];
    $baggage_WayType = $baggage[3];
  
    $adtcount = count($pass_info['first_name']);

    // echo '<pre>';print_r($meal_code);exit;
    $Total_fare = trim($_POST['total_cost']+($adtcount * ($meal_price+$baggage_price))); 
    $update_meal = array(
      'meal_code' => $meal_code,
      'meal_price' => $meal_price,
      'meal_desc' => $meal_desc,
      'meal_quantity' => $meal_quantity,
      'meal_WayType' => $meal_WayType,
      'Origin_ssr' => $Origin_ssr,
      'Destination_ssr' => $Destination_ssr,
      'baggage_code' => $baggage_code,
      'baggage_weight' => $baggage_weight,
      'baggage_price' => $baggage_price,
      'baggage_WayType' => $baggage_WayType,

       );
    //echo '<pre>';print_r($update_meal);exit;
    $this->db->where('search_id', $searchId);
    $this->db->update('flight_search_result', $update_meal);

    $data['flight_result'] = $flight_result = $this->Flights_Model->get_flight_search_result($searchId, $segmentkey);    
      

    if(!empty($searchId1)){

      $data['flight_result_r'] = $flight_result1 = $this->Flights_Model->get_flight_search_result($searchId1, $segmentkey1);

      $total_cost=($flight_result->total_amount+$flight_result1->total_amount)+($flight_result->baggage_price+$flight_result1->meal_price)+($flight_result->baggage_price+$flight_result1->meal_price); 

      $agent_markup=$flight_result->agent_markup+$flight_result1->agent_markup;   
    } else{
      $total_cost=($flight_result->total_amount)+($flight_result->baggage_price+$flight_result->meal_price);
      $agent_markup=$flight_result->agent_markup; 
    }

    
    if($_POST['insurance'] == 'Yes'){
      $insurance_amount = 241;
    } else{
      $insurance_amount = 0;
    }
    $search_details = array(
      'callBackId' => $api,
      'searchId' => $searchId,
      'segmentkey' => $segmentkey,
      'searchId1' => $searchId1,
      'segmentkey1' => $segmentkey1,
      'cost' => 1,  
      'total_cost'=>$total_cost,    
      'uniqueRefNo' => $flight_result->uniquerefno,
      'service_type'=>2,
      'name'=>$pass_info['first_name'][0].' '.$pass_info['last_name'][0],
      'city'=>'',
      'phone'=> $pass_info['phone'],
      'email'=>$pass_info['email'],
      'desc'=>'Flight Booking',
      'tripType'=>$flight_result->triptype,
      'whatsapp'=>$pass_info['whatsapp'],
      'insurance_amount' => $insurance_amount,
      'Total_fare' => $Total_fare
    );
    

    $this->session->set_userdata('search_details', $search_details);
    // echo"<pre>sd";print_r($this->session->search_details);exit;    
    if($this->session->agent_logged_in || $this->session->corporate_sub_logged_in){
      $this->deposit_withdraw($total_cost, $agent_markup, $flight_result->uniquerefno);
    }else{
      //  echo '<pre/>';print_r($data);exit;      
      // $this->load->view('confirm_reservation', $data);
      echo json_encode($data);
    }
  }else{
    echo 'Permission Denied';
  }  

  }


public function payment_process($sessionId='', $hotelCode='', $searchId='') {
  // echo '<pre>';print_r($_GET);exit;
  // if(@$_POST['callBackId'] && @$_POST['searchId']){
  if(@$_GET['callBackId'] && @$_GET['searchId']){
    // $this->session->set_userdata('passenger_info', $_POST);
    // $api = trim($_POST['callBackId']);
    // $searchId = trim($_POST['searchId']);
    // $segmentkey = trim($_POST['segmentkey']);
    $api = trim($_GET['callBackId']);
    $searchId = trim($_GET['searchId']);
    $segmentkey = trim($_GET['segmentkey']);
    // if(isset($_POST['searchId1'])){$searchId1=trim($_POST['searchId1']);}else{$searchId1='';}
    // if(isset($_POST['segmentkey1'])){$segmentkey1=$_POST['segmentkey1'];}else{$segmentkey1='';}; 
    if(isset($_GET['searchId1'])){$searchId1=trim($_GET['searchId1']);}else{$searchId1='';}
    if(isset($_GET['segmentkey1'])){$segmentkey1=$_GET['segmentkey1'];}else{$segmentkey1='';};
    // echo '<pre>';print_r($room_comd_detail);
    // $total_cost=1;
    $pass_info = $this->session->passenger_info;
    // echo $this->session->all_userdata();
    $total_cost = 0;
    $agent_markup = 0;
    // $meal =explode('@^@',$_POST['meal']);
    // $baggage =explode('@^@',$_POST['baggage']);
    //   // echo '<pre>';print_r($_POST['baggage']);exit;
    // $meal_code = $meal[0];
    // $meal_desc = $meal[1];
    // $meal_quantity = $meal[2];
    // $meal_price = $meal[3];
    // $meal_WayType = $meal[4];
    // $Origin_ssr = $meal[5];
    // $Destination_ssr = $meal[6];

    // $baggage_code = $baggage[0];
    // $baggage_weight = $baggage[1];
    // $baggage_price = $baggage[2];
    // $baggage_WayType = $baggage[3];
  

    // $update_meal = array(
    //   'meal_code' => $meal_code,
    //   'meal_price' => $meal_price,
    //   'meal_desc' => $meal_desc,
    //   'meal_quantity' => $meal_quantity,
    //   'meal_WayType' => $meal_WayType,
    //   'Origin_ssr' => $Origin_ssr,
    //   'Destination_ssr' => $Destination_ssr,
    //   'baggage_code' => $baggage_code,
    //   'baggage_weight' => $baggage_weight,
    //   'baggage_price' => $baggage_price,
    //   'baggage_WayType' => $baggage_WayType,

    //    );
    // // echo '<pre>';print_r($update_meal);exit;
    // $this->db->where('search_id', $searchId);
    // $this->db->update('flight_search_result', $update_meal);



    $data['flight_result'] = $flight_result = $this->Flights_Model->get_flight_search_result($searchId, $segmentkey);
    if(!empty($searchId1)){
      $data['flight_result_r'] = $flight_result1 = $this->Flights_Model->get_flight_search_result($searchId1, $segmentkey1);
      $total_cost=($flight_result->total_amount+$flight_result1->total_amount)+($flight_result->baggage_price+$flight_result1->meal_price)+($flight_result->baggage_price+$flight_result1->meal_price); 
      $agent_markup = $flight_result->agent_markup+$flight_result1->agent_markup;   
    }else{
      $total_cost = ($flight_result->total_amount)+($flight_result->baggage_price+$flight_result->meal_price);
      $agent_markup = $flight_result->agent_markup; 
    }

    if($this->session->agent_logged_in){
      $modulename = 'b2b';
    }else{
      $modulename = 'b2c';
    }

    $search_details = array(
      'callBackId' => $api,
      'searchId' => $searchId,
      'segmentkey' => $segmentkey,
      'searchId1' => $searchId1,
      'segmentkey1' => $segmentkey1,
      // 'cost' => $total_cost,
      'cost' => 2,
      'grand_total'=>$total_cost,
      'uniqueRefNo' => $flight_result->uniquerefno,
      'service_type'=>2,
      'service'=>'Flight',
      'module'=>$modulename,
      'name'=>$pass_info['first_name'][0].' '.$pass_info['last_name'][0],
      'city'=>'',
      'phone'=> $pass_info['phone'],
      'email'=>$pass_info['email'],
      'desc'=>'Flight Booking',
      'triptype'=>$flight_result->triptype,
      'whatsapp'=>$pass_info['whatsapp'],

    );
    // echo '<pre>';print_r($search_details);exit;
    $this->session->set_userdata('search_details', $search_details);
    if($this->session->agent_logged_in){
      $this->deposit_withdraw($total_cost, $agent_markup, $flight_result->uniquerefno);
    }else{
      // redirect('payment/index');
      redirect('flights/confirm_book','refresh');
    }
  }else{
    echo 'Permission Denied';
  }
}


function deposit_withdraw($total_price, $agent_markup, $bookingRefNo) {
  $this->load->model('Tbo_Model');
  $search_details = $this->session->search_details;
      $agent_id = $this->session->agent_id;
      $agent_no = $this->session->agent_no;
      $available_balance = $this->Tbo_Model->get_agent_available_balance($agent_no);
      $available_balance = empty($available_balance) ? 0 : $available_balance;
      $agent_markup = empty($agent_markup) ? 0 : $agent_markup;
      $withdraw_amount = $total_price - $agent_markup;
      if ($available_balance < $withdraw_amount) {
        $error = 'Your balance is too low for booking this flight';
        redirect('home/error_page/' . base64_encode($error));
      } else {
        $closing_balance = $available_balance - $withdraw_amount;
        $this->Tbo_Model->insert_withdraw_status($agent_id, $agent_no, $withdraw_amount, $closing_balance, $bookingRefNo);
      }
      if($search_details['tripType']=='M'){
       redirect('flights/multi_flight_booking','refresh');
     }else{
      redirect('flights/confirm_book','refresh');
    }
      //redirect('flights/confirm_book','refresh');
    }

    // public function fetch_results(){

    //    if (isset($_POST['searcharray'])) {
    //     // $session_data=$this->session->userdata('flight_search_data');
    //     $session_data = unserialize($_POST['searcharray']);
    //     //  echo '<pre>';print_r(($session_data));exit;
    //     $api = 'tbo';
    //     $this->load->module('flights/' . $api);        
    //     $sess_tripType = $session_data['tripType'];
    //     $sess_flightmode = $session_data['flightmode'];    
    //     if ($sess_tripType == 'M') {
    //       $this->$api->fetch_flight_multiway_search_results($_POST['searcharray']);
    //     } else {
    //       $this->$api->fetch_flight_search_results($_POST['searcharray']);
    //     }
    //   } else {
    //     echo 'Permission denied';
    //   }

    // }

    public function fetch_results()
    {
        if (isset($_POST['searcharray'])) {        

          
            // $session_data=$this->session->userdata('flight_search_data');
            $session_data = unserialize($_POST['searcharray']);

            $fares=$this->input->post('fares');
            $stops=$this->input->post('stops');
            $brands=$this->input->post('brands');
            $minimum_price=$this->input->post('minimum_price');
            $maximum_price=$this->input->post('maximum_price');
            $min_depart=$this->input->post('min_depart');
            $max_depart=$this->input->post('max_depart');
            $min_arrive=$this->input->post('min_arrive');
            $max_arrive=$this->input->post('max_arrive');
            $minDuration=$this->input->post('minDuration');
            $maxDuration=$this->input->post('maxDuration');


           // $result_string="'" . implode("','",$brands)."'" ;
            //$result_string="'" . implode("','",$stops)."'" ;
             //echo '<pre>';
           // echo $result_string;
          //  echo"<pre>";print_r($maxDuration);exit;
            // echo '<pre>';
            
            // print_r($this->session->userdata('session_id'));exit;
            $api_info = $this->Flights_Model->getActiveAPIs();
            $api_list = array();
            if (!empty($api_info)) {
                $a = 0;
                foreach ($api_info as $api) {
                    $api_list[$a] = base64_encode($api['api_name']);
                    $a++;
                }
            }
            $data['api_list'] = $api_list;
            // $api = base64_decode($api_list[0]);
            // echo '<pre>';print_r($api);exit;
            for ($i = 0; $i < count($api_list); $i++) {
                $api = base64_decode($api_list[$i]);
                $this->load->module('flights/' . $api);
                $sess_tripType   = $session_data['tripType'];
                $sess_flightmode = $session_data['flightmode'];
                if (isset($_REQUEST['session_id'])) {
                    $sess_id = $_REQUEST['session_id'];
                    // echo '<pre>sandy';print_r($sess_id);exit;
                } else {
                    $sess_id = $this->sess_id;
                   // echo '<pre>sandy';print_r($sess_id);exit;
                }
                // $sess_id = session_id();
                // echo"<pre>";print_r($_REQUEST['session_id']);exit;
                // if ($sess_tripType == 'M') {
                //   $this->$api->fetch_flight_multiway_search_results($_POST['searcharray']);
                // } else {
                //   $this->$api->fetch_flight_search_results($_POST['searcharray']);
                // }
                // echo"<pre>3";print_r($session_data);exit;
                $session_data['flightmode'] = 1;
                if($session_data['tripType'] == "oneway"){$session_data['tripType']="oneway";}
                $flight_search_result="";
                $flight_search_result1="";
                
                if ($api == 'tbo') {
                  if ($session_data['tripType'] == 'multicity') {
                        $flight_result1 = $this->Tbo_Model->fetch_search_result($sess_id, $session_data['sess_uniqueRefNo'], 2);
                        // ,$brands,$fares,$min_depart,$max_depart,$min_arrive,$max_arrive,$minimum_price, $maximum_price,$brands
                       //echo $this->db->last_query();exit;
                        // $data['result'] = $flight_result;
                        $data['result1'] = $flight_result1;
                        $flight_search_result .= $this->load->view('tbo/search_result_mulitway_round_ajax', $data, TRUE);
                                                
                    }else{
                  
                    if ($session_data['flightmode'] == 1) {
                        if ($session_data['tripType'] == 'oneway') { //echo "tbooneway";exit;
                            $flight_result  = $this->Tbo_Model->fetch_search_result($sess_id, $session_data['sess_uniqueRefNo'], '1');
                            // echo print_r($flight_result);exit;
                            //  echo $this->db->last_query();
                            //echo $this->db->last_query();exit;
                            // $Cheapest_flight_result = $this->Tbo_Model->fetch_cheapest_search_result($sess_id, $session_data['sess_uniqueRefNo'], '1');
                            // $data['cheapest_flight'] = $Cheapest_flight_result;  echo $this->db->last_query();
                            $data['result'] = $flight_result;
                            $flight_search_result .= $this->load->view('tbo/search_result_oneway_ajax', $data, TRUE);
                            // echo print_r($flight_search_result);exit;
                          } else { //echo "viaround";exit;
                            $flight_result  = $this->Tbo_Model->fetch_search_result($sess_id, $session_data['sess_uniqueRefNo'], 1);
                          // echo $this->db->last_query();
                            $flight_result2 = $this->Tbo_Model->fetch_search_result($sess_id, $session_data['sess_uniqueRefNo'], 2);
                        //  echo $this->db->last_query();
                            // $data['result'] = $flight_result;
                            $data['result1'] = $flight_result;
                            $flight_search_result .= $this->load->view('tbo/search_result_round_onward', $data, TRUE);                            
                            $data1['result2'] = $flight_result2;
                            
                          //echo $this->db->last_query();
                            $flight_search_result1 .= $this->load->view('tbo/search_result_round_return', $data1, TRUE);
                        }
                    } else {
                        if ($this->tripType == 'oneway') {
                            // echo 2;exit;
                            $flight_result  = $this->Tbo_Model->fetch_search_result($sess_id, $session_data['sess_uniqueRefNo'], 1);
                          // echo $this->db->last_query();
                            $data['result'] = $flight_result;
                            $flight_search_result .= $this->load->view('tbo/search_result_oneway_ajax', $data, TRUE);
                         
                          } else {
                        //echo "viamulti";exit;
                            $flight_result  = $this->Tbo_Model->fetch_search_result($sess_id, $session_data['sess_uniqueRefNo'], 1);
                          //echo $this->db->last_query();
                            $data['result'] = $flight_result;
                             //echo '<pre>';print_r($flight_result);exit;
                            // $flight_search_result .= $this->load->view('via/search_result_int_round_ajax', $data, TRUE);
                            $flight_search_result .= $this->load->view('tbo/search_result_mulitway_round_ajax', $data, TRUE);
                        
                           //echo $this->db->last_query();
                          }
                    }
                }
            }
            if (empty($flight_result )) {
                  $flight_search_result .= $flight_search_result1 = '<div class="col-lg-12 col-md-12 searchflight_box11">
            <div class="results-row card card-list card-list-view FlightInfoBox" >
                <div class="card-body d-flex justify-content-between flex-wrap align-content-around">
                No Flights Found.. Please try after some time...
                </div>
                </div>
                </div>';
                  $this->session->unset_userdata('flight_search_activate');
              }
            }
            //  echo '<pre>';print_r($data);exit;
                echo json_encode(array("flights_search_result" => $flight_search_result,"flights_search_result1"=>$flight_search_result1));
        }
        // } else {
        //   echo 'Permission denied';
        // }
        
    }
    
    
       public function searchresult_ajax()
    {
        
        //echo"<pre>";print_r($_POST);exit;
        if (isset($_POST['searcharray'])) {        

          
            // $session_data=$this->session->userdata('flight_search_data');
            $session_data = unserialize($_POST['searcharray']);

            $sess_id=$this->input->post('sessionId');
            $minPrice=$this->input->post('minPrice');
            $maxPrice=$this->input->post('maxPrice');
            $AirLine=$this->input->post('AirLine');
            $refund=$this->input->post('refund');
            $departCheck=$this->input->post('departCheck');
            $arrivCheck=$this->input->post('arrivCheck');
            $stops=$this->input->post('stops');
            $maxDuration=$this->input->post('maxDuration');
            $minDuration=$this->input->post('minDuration');
            $searcharray=$this->input->post('searcharray');

           $session=$session_data;
            
            
            // print_r($session);exit;
            $api_info = $this->Flights_Model->getActiveAPIs();
            $api_list = array();
            if (!empty($api_info)) {
                $a = 0;
                foreach ($api_info as $api) {
                    $api_list[$a] = base64_encode($api['api_name']);
                    $a++;
                }
            }
            $data['api_list'] = $api_list;
            // $api = base64_decode($api_list[0]);
            // echo '<pre>';print_r($api);exit;
            for ($i = 0; $i < count($api_list); $i++) {
                $api = base64_decode($api_list[$i]);
                $this->load->module('flights/' . $api);
            
               
               
                $flight_search_result="";
                $flight_search_result1="";
                
                if ($api == 'tbo') {
                
                  
                  
                        if ($session['tripType'] == 'oneway') { 
                           // echo '<pre>';print_r($api);exit;
                            $flight_result  = $this->Tbo_Model->fetch_search_result_page($sess_id, $session['sess_uniqueRefNo'],1,$minPrice,$maxPrice,$AirLine,$refund,$departCheck,$arrivCheck,$stops,$maxDuration,$minDuration,$searcharray);
                         
                            $data['result'] = $flight_result;
                            $flight_search_result .= $this->load->view('tbo/search_result_oneway_ajax', $data, TRUE);
                           
                          } else { //echo "viaround";exit;
                              $flight_result = $this->Tbo_Model->fetch_search_result_page($sess_id, $session['sess_uniqueRefNo'],2,$minPrice,$maxPrice,$AirLine,$refund,$departCheck,$arrivCheck,$stops,$maxDuration,$minDuration,$searcharray);;
                       
                            $data['result1'] = $flight_result;
                            $flight_search_result .= $this->load->view('tbo/search_result_round_onward', $data, TRUE);
                         
                        }
                  
                
            }
            if (empty($flight_result )) {
                  $flight_search_result .= $flight_search_result1 = '<div class="col-lg-12 col-md-12 searchflight_box11">
            <div class="results-row card card-list card-list-view FlightInfoBox" >
                <div class="card-body d-flex justify-content-between flex-wrap align-content-around">
                No Flights Found.. Please try after some time...
                </div>
                </div>
                </div>';
                  $this->session->unset_userdata('flight_search_activate');
              }
            }
            //  echo '<pre>';print_r($data);exit;
                echo json_encode(array("flights_search_result" => $flight_search_result,"flights_search_result1"=>$flight_search_result1));
        }
        // } else {
        //   echo 'Permission denied';
        // }
        
    }
    
    

public function confirm_book(){

     $this->load->model('Tbo_Model');
     $search_details = $this->session->search_details;
     if(empty($search_details)){
       redirect('home/error_page/'.base64_encode('Session expired'),'refresh');
     }

     $callBackId = $search_details['callBackId'];
     $api = base64_decode($search_details['callBackId']);
     $searchId = trim($search_details['searchId']);
     $segmentkey = trim($search_details['segmentkey']);

     $data['flight_result'] = $flight_result = $this->Flights_Model->get_flight_search_result($searchId, $segmentkey);
   
     
     $this->load->module('flights/' . $api);
     $PNR=$BookingId='';
     
     if($data['flight_result']->triptype == 'round' && $data['flight_result']->isdomestic == 'true'){
      
       if($flight_result->islcc!=1){
         $bookresp=$this->$api->flight_book($searchId);
         $bookresp->Response->Error->ErrorCode;       
         if((int)$bookresp->Response->Error->ErrorCode==0){ 
           $PNR=$bookresp->Response->Response->PNR;
           $BookingId=$bookresp->Response->Response->BookingId; 
         }
       }
       
     //ticketing
       list($ezeeRefNo,$BookingIdf)=$this->$api->ticketing($searchId, $PNR, $BookingId);
       $searchId1 = $segmentkey1 = '';

       $searchId1 = trim($search_details['searchId1']);
       $segmentkey1 = trim($search_details['segmentkey1']);
       $data['flight_result_r'] = $flight_result1 = $this->Flights_Model->get_flight_search_result($searchId1, $segmentkey1);  
       $PNR1=$BookingId1='';

       if($flight_result1->islcc!=1){
         $bookresp1=$this->$api->flight_book($searchId1);
         $bookresp1->Response->Error->ErrorCode;       
         if((int)$bookresp1->Response->Error->ErrorCode==0){ 
           $PNR1=$bookresp1->Response->Response->PNR;
           $BookingId1=$bookresp1->Response->Response->BookingId; 
         }
       }
     //ticketing
       list($ezeeRefNo,$BookingIdf1)=$this->$api->ticketing($searchId1, $PNR1, $BookingId1,1);

       $this->$api->unset_session_search_data();
       redirect('flights/flight_eticket/' . $ezeeRefNo . '/' . $BookingIdf.'/'.$BookingIdf1, 'refresh');

     }else{
       if($flight_result->islcc!=1){
         $bookresp=$this->$api->flight_book($searchId);
         $bookresp->Response->Error->ErrorCode;       
         if((int)$bookresp->Response->Error->ErrorCode==0){ 
           $PNR=$bookresp->Response->Response->PNR;
           $BookingId=$bookresp->Response->Response->BookingId; 
         }
       }
     //ticketing
       list($ezeeRefNo,$BookingIdf)=$this->$api->ticketing($searchId, $PNR, $BookingId);

       $this->$api->unset_session_search_data();
       redirect('flights/flight_eticket/' . $ezeeRefNo . '/' . $BookingIdf, 'refresh');
     }

   }

   public function eticket($ezeeRefNo)
   {
      $data['booking_info'] = $booking_info = $this->Flights_Model->get_flight_booking_info($ezeeRefNo, 'Onward');
      // echo $this->db->last_query();echo '<pre>';print_r($booking_info);exit;
      $data['passenger_info'] =$passenger_info=  $this->Flights_Model->get_passengers_info($ezeeRefNo);
      // echo $this->db->last_query();
      // echo '<pre>12';print_r($passenger_info);exit;
      if (!empty($booking_info)) {
        $data['booking_info_r'] = '';
        if ($booking_info->Trip_Type == 'round' && $booking_info->DirectionInd == 1) {
          $data['booking_info_r'] = $this->Flights_Model->get_flight_booking_info($ezeeRefNo, 'Return');
        }
        if ($booking_info->DirectionInd == 2) {
          $data['booking_info_r'] = $data['booking_info'];
          $data['booking_info'] = '';
        }
        $this->load->model('Tbo_Model');
        $this->load->view('flightticket_freebuy', $data);
      }
   }

   public function flight_eticket($ezeeRefNo, $BookingId = '', $BookingId1 = '') {

    $data['booking_info'] = $booking_info = $this->Flights_Model->get_flight_booking_info($ezeeRefNo, 'Onward');
    // echo $this->db->last_query();echo '<pre>';print_r($booking_info);exit;
    $data['passenger_info'] =$passenger_info=  $this->Flights_Model->get_passengers_info($ezeeRefNo);
    // echo $this->db->last_query();
    // echo '<pre>12';print_r($passenger_info);exit;
    if (!empty($booking_info)) {
      $data['booking_info_r'] = '';
      if ($booking_info->Trip_Type == 'round' && $booking_info->DirectionInd == 1) {
        $data['booking_info_r'] = $this->Flights_Model->get_flight_booking_info($ezeeRefNo, 'Return');
      }
      if ($booking_info->DirectionInd == 2) {
        $data['booking_info_r'] = $data['booking_info'];
        $data['booking_info'] = '';
      }
      

      // $voucher_content = $this->load->view('flightinvoice_content', $data,TRUE);
      $voucher_content = $this->load->view('tes', $data);
      // $voucher_content = $this->load->view('flightticket', $data,TRUE);
      $this->load->module('home/sendemail');
      $data_email = array(
        'user_email' => $data['passenger_info'][0]->email,
        'subject' => 'Flight Booking - '.$ezeeRefNo,
        'voucher_content' => $voucher_content,
      );
      // echo '<pre/>';print_r($passenger_info[0]->whatsapp_itinerary);exit;  
      //$this->sendemail->ticketing_mail($data_email);
      $DepartureDateTime=explode(',',$booking_info->DepartureDateTime);
      $DepartureDateex=explode('T',$DepartureDateTime[0]);    
      $airlinename= $booking_info->OperatingAirline_FlightNumber;
      $pnr = $booking_info->pnr;
      $flightnumber = $booking_info->FlightNumber;
      $departdate = date('d-M-Y',strtotime($DepartureDateex[0]));
      $departtime = $DepartureDateex[1];
      $origin = $booking_info->Departure_LocationCode;
      $destination = $booking_info->Arrival_LocationCode;
      $origin_airport = $this->load->Flights_Model->get_origin_airport($booking_info->Departure_LocationCode);
      //echo $this->db->last_query();
       //echo '<pre/>123';print_r($origin_airport);exit; 
      $desti_airport = $this->load->Flights_Model->get_desti_airport($booking_info->Arrival_LocationCode);
      $BookingStatus = $booking_info->BookingStatus;
      $mobile = $passenger_info[0]->mobile;
      $whatsapp_itinerary = $passenger_info[0]->whatsapp_itinerary;
       // echo '<pre/>';print_r($whatsapp_itinerary);exit; 
      if($whatsapp_itinerary != '' && $BookingStatus == 'Ticketed'){
        // echo 1;exit;
      //$this->load->module('home/smsgateway');
      $post_data = array(
      // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
      // For promotional, this will be ignored by the SMS gateway
      'mobile'    => $mobile,
     // 'message'  => 'Dear '.$passenger_info[0]->first_name.' ,'.$airlinename.' is delighted to confirm your booking.Your PNR is '.$pnr.' for your flight '.$flightnumber.' departing on '.$departdate.' at '.$departtime.' from '.$origin.' to '.$destination.' .Pls report 2 hrs prior to departure for check-in,http://tpdtechnosoft.com/TPD_Projects/Etrippo/flights/flight_eticket1/' . $ezeeRefNo . '/' . $BookingId.'/'.$BookingId1
      'message'  => 'Booking Details: '.$origin.'-('.$booking_info->Origin.' )-'.$origin_airport.' To '.$destination.' -('.$booking_info->Destination.' )-'.$desti_airport.',DOJ:'.$departdate.' ,RefNo: '.$flightnumber.' ,PNR Number: '.$pnr.' ,TripType:Single,Adults:' . $booking_info->Adults . ',Child:' . $booking_info->Childs .',Infant:'.$booking_info->Infants 
        );
      //$this->smsgateway->sendSMS($post_data);
      }
      else{
        // echo 2;exit;
        //$this->load->module('home/smsgateway');
        $post_data = array(
        // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
        // For promotional, this will be ignored by the SMS gateway
        'mobile'    => $mobile,
        'message'  => 'Dear '.$passenger_info[0]->first_name.' ,Sorry to inform you that your booking is failed. Please try again later.'
          );
        //$this->smsgateway->sendSMS($post_data);
      }
      redirect('flights/flight_eticket1/' . $ezeeRefNo . '/' . $BookingId.'/'.$BookingId1, 'refresh');
    } else {
      echo 'Permission Denied';
    }
  }

  public function flight_eticket1($ezeeRefNo, $BookingId = '', $BookingId1 = '') {
    $search_details = $this->session->search_details;
     if(empty($search_details)){
       redirect('home/error_page/'.base64_encode('Session expired'),'refresh');
     }

     $callBackId = $search_details['callBackId'];
     $api = base64_decode($search_details['callBackId']);
     $searchId = trim($search_details['searchId']);
     $segmentkey = trim($search_details['segmentkey']);

    $data['flight_result'] = $flight_result = $this->Flights_Model->get_flight_search_result($searchId, $segmentkey);
    $data['booking_info'] = $booking_info = $this->Flights_Model->get_flight_booking_info($ezeeRefNo, 'Onward');
       
    $data['passenger_info'] = $this->Flights_Model->get_passengers_info($ezeeRefNo);
    // echo $this->db->last_query();exit;
    if (!empty($booking_info)) {
      $data['booking_info_r'] = '';
      if ($booking_info->Trip_Type == 'R' && $booking_info->DirectionInd == 1) {
        $data['booking_info_r'] = $this->Flights_Model->get_flight_booking_info($ezeeRefNo, "Return");
      }
      if ($booking_info->DirectionInd == 2) {
        $data['booking_info_r'] = $data['booking_info'];
        $data['booking_info'] = '';
      }
      $data['invoice'] = 'no';
      // echo '<pre/>';print_r($data);exit;    
    //   $this->load->view('flightticket', $data);
    $this->load->model('Tbo_Model');
    $this->load->view('flightticket_freebuy', $data);
    } else {
      echo 'Permission Denied';
    }
  }

  public function vouchersample()
  {
    $this->load->view('flightticket_freebuy');
    
  }

  public function invoice_ticket($ezeeRefNo) {
    $data['booking_info'] = $booking_info = $this->Flights_Model->get_flight_booking_info($ezeeRefNo, 'Onward');
   // echo $this->db->last_query();echo '<pre>';print_r($booking_info);exit;
    $data['passenger_info'] = $this->Flights_Model->get_passengers_info($ezeeRefNo);
    if (!empty($booking_info)) {
      $data['booking_info_r'] = '';
      if ($booking_info->Trip_Type == 'round' && $booking_info->DirectionInd == 1) {
        $data['booking_info_r'] = $this->Flights_Model->get_flight_booking_info($ezeeRefNo, "Return");
      }
      if ($booking_info->DirectionInd == 2) {
        $data['booking_info_r'] = $data['booking_info'];
        $data['booking_info'] = '';
      }

    $data['invoice'] = 'yes';
    //echo '<pre/>';print_r($data);exit;    
    $this->load->view('flightticket', $data);
    } else {
      echo 'Permission Denied';
    }
  }

  public function modifyeticket1() {
    // echo '<pre/>';print_r($_POST);exit;
    if(!empty($_POST)){
      $modifyprice = $this->input->post('modify');
      $uniqueRefNo = $this->input->post('uniqueRefNo');
      redirect('flights/modifyeticket/'.$uniqueRefNo.'/'.base64_encode($modifyprice), 'refresh');
    } else {
      echo 'Permission Denied';
    }
    
  }

  public function modifyeticket($ezeeRefNo, $modifyprice) {

    $data['modifyprice']=base64_decode($modifyprice);
    $data['booking_info'] = $booking_info = $this->Flights_Model->get_flight_booking_info($ezeeRefNo, 'Onward');
    $data['passenger_info'] = $this->Flights_Model->get_passengers_info($ezeeRefNo);
    if (!empty($booking_info)) {
      $data['booking_info_r'] = '';
      if ($booking_info->Trip_Type == 'R' && $booking_info->DirectionInd == 1) {
        $data['booking_info_r'] = $this->Flights_Model->get_flight_booking_info($ezeeRefNo, "Return");
      }
      if ($booking_info->DirectionInd == 2) {
        $data['booking_info_r'] = $data['booking_info'];
        $data['booking_info'] = '';
      }

    $this->load->view('flightticket', $data);
    } else {
      echo 'Permission Denied';
    }
  }

public function muiti_itinerary() {
    //echo '<pre/>';        print_r($_REQUEST);        exit;

if (isset($_REQUEST['callBackId']) && isset($_REQUEST['searchId']) && isset($_REQUEST['segmentkey'])) {
        //Loading Sabre API Model
  $this->load->model('Tbo_Model');
  $callBackId = $_REQUEST['callBackId'];
  $api = base64_decode($_REQUEST['callBackId']);
  $searchId = trim($_REQUEST['searchId']);
  $segmentkey = trim($_REQUEST['segmentkey']);

  $data['flight_result'] = $flight_result = $this->Flights_Model->get_flight_search_result($searchId, $segmentkey);

        //  print_r($data['flight_result']);exit;
        // print_r($data['flight_result_r']);exit;
        //echo '<pre/>';print_r($flight_result);exit;
      if (empty($flight_result)) {
        redirect('flights/results', 'refresh');
      }
        $this->flightformvalidation($flight_result);
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('user_mobile', 'Mobile', 'trim|required|integer|min_length[10]');

        if ($this->form_validation->run($this) == FALSE) {

          $this->load->module('flights/' . $api);
          $data['country_list'] = $this->Flights_Model->get_country_list();
          $data['error_msg'] = '';

            // **  for the LCC FLIGHTS ** //
            //Get Fare Quote 'S'
          $this->$api->flights_fareLLSRQ($searchId);
          $this->$api->get_fareQuote($data['flight_result']);
          $this->$api->get_special_request($data['flight_result']);
          $data['flight_result'] = $flight_result = $this->Flights_Model->get_flight_search_result($searchId, $segmentkey);

         // $data['flight_baggage'] = $this->get_baggage_info($data['flight_result']);
            //  **  for the LCC FLIGHTS **  //

          $this->load->view('flight_multi_itinerary', $data);
        } else {

         $this->session->set_userdata('passenger_info', $_POST);
         $this->load->view('confirm_multi_reservation', $data);
       }
     } else {
      echo 'Permission Denied';
    }
  }

  function flight_cancellation($RefNo, $BookingId='', $BookingId1 = '') {
    // echo 123;exit;
    if(!empty($RefNo)){
      $booking_detail = $this->Flights_Model->get_booking_report($RefNo);
      //echo '<pre>'; print_r($booking_detail);//exit;
      if (!empty($booking_detail)) {
        // $api = $booking_detail->api;
        // $this->load->module('flights/' . $api);
        // $this->$api->cancel_ticketing($RefNo, $booking_detail);
        $this->load->model('Tbo_Model');
         $passenger_info = $this->Tbo_Model->get_passenger_info($RefNo);
         // echo '<pre>';print_r($passenger_info);exit;
        $data['booking_detail']=$booking_detail;
        $data['booking_pass']=$passenger_info[0];
         $this->load->view('flights/tbo/cancelprepare', $data);
      }
    }else{
      echo 'Permission Denied';
    }    
  }
  function flightConfirmcancellation($RefNo, $BookingId='', $BookingId1 = '') { //error_reporting(E_ALL);
    
    if(!empty($RefNo)){
      $booking_detail = $this->Flights_Model->get_booking_report($RefNo);
      // echo '<pre>'; print_r($booking_detail);//exit;
      if (!empty($booking_detail)) {  
        $api = $booking_detail->api;
        $this->load->module('flights/' . $api);
        $this->$api->cancel_ticketing($RefNo, $booking_detail);
      }
    }else{
      echo 'Permission Denied';
    }    
  }

  public function get_promotional_offer() {
    $this->form_validation->set_rules('type', 'Type ', 'trim|required');
    $this->form_validation->set_rules('promo_code', 'PromoCode ', 'trim|required');
    if ($this->form_validation->run($this) == FALSE) {
    } else {
      $promotional_code = $this->input->post('promo_code');
      $type = $this->input->post('type');
      $tot_amnt = $this->input->post('tot_amnt');
      $promtional = $this->Flights_Model->get_promotional_code($promotional_code);
      // echo '<pre>';print_r($promtional);exit;
      if (empty($promtional)) {
        echo json_encode(array('offer' => 'Promotional Code is not valid', 'tot_amnt' => $tot_amnt, 'disc' => 0));
      } else {
        $service = explode(',', $promtional->service_type);
        if (in_array($type, $service)) {
          $expire = $promtional->promo_expire;
          if (strtotime($expire) >= strtotime(date('Y-m-d'))) {
            if ($promtional->discount_type == 1) {
              $distot_amnt = round(($tot_amnt * ($promtional->discount / 100)), 2);
              $tot_amnt = $tot_amnt - $distot_amnt;
              echo json_encode(array('offer' => sprintf('Avail %s percentage discount on the booking', $promtional->discount), 'tot_amnt' => $tot_amnt, 'disc' => $distot_amnt));
            } else {
              $tot_amnt = $tot_amnt - $promtional->discount;
              echo json_encode(array('offer' => sprintf('Avail %s discount on the booking', $promtional->discount), 'tot_amnt' => $tot_amnt, 'disc' => $promtional->discount));
            }
          } else {
            echo json_encode(array('offer' => 'Offer is expired', 'tot_amnt' => $tot_amnt, 'disc' => 0));
          }
        } else {
          echo json_encode(array('offer' => 'No Discount Available', 'tot_amnt' => $tot_amnt, 'disc' => 0));
        }
      }
    }
  }

// full calendar
    // public function calendarFare() {
    //     $chdate = date('F Y')."<br>";
    //     $fromCity = $this->input->post('fromCity');
    //     $toCity  =$this->input->post('toCity');
    //     $departDate  =$this->input->post('departDate');
    //     $from = substr($fromCity, 6, 3);
    //     $to = substr($toCity, 8, 3);
    //     if($departDate == $chdate){
    //         $depDate = date('Y-m-d')."T00:00:00";
    //     }else{
    //       $newDate = date("Y-m-d", strtotime($departDate));
    //         $depDate = $newDate."T00:00:00";
    //     }
    //     // echo "<pre>";
    //     // print_r($departDate);
    // }

    public function passenger_data()
    {
      $postData = $this->input->post();

        $data = $this->Flights_Model->getPassengerData($postData);

        echo json_encode($data);
    }
    
     
    public function AirportCode($city) {
        if(!is_null($city)){
            preg_match_all('/\(([A-Za-z ]+?)\)/', $city, $out);
            $airportCode = $out[1];
            if (!empty($airportCode))
                return $airportCode[0];
        }
       
    }
    
   

}       