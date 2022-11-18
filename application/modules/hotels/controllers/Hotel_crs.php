<?php

@ini_set('mysql.connect_timeout', 3000);
@ini_set('default_socket_timeout', 3000);

ini_set('memory_limit', '-1');
//error_reporting(0);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Hotel_crs extends MX_Controller {
    /*     * ***** START SET CREDENTIAL ********* */

    private $base_currency;
    private $client_id;
    private $username;
    private $password;
    private $post_url;
    private $api_flag;
    private $mode;
    private $api;
    //  private $version;
    private $nationality;
    private $market_name;
    private $crshotelcode;
    private $hotelname;

    private $city_name;
    private $city_code;
    private $cin;
    private $cout;
    private $rooms;
    private $nights;
    private $adults;
    private $childs;
    private $adults_count;
    private $childs_count;
    private $childs_ages;
    private $sess_id;
    private $adminMarkup;
    private $agentMarkup;
    private $paymentCharge; 
    private $adult_extrabed;  
    private $child_extrabed;  
    private $adult_extrabed_count;  
    private $child_extrabed_count;

    /*     * ***** END SET VARIABLES ********* */

    function __construct() {
        parent::__construct();
        $this->load->model('hotel_crs/Hotelcrs_Model');
        $this->load->model('Email_Model');   

        $this->api = 'hotel_crs';
        $this->sess_id = $this->session->session_id;
        $this->load->database();
        $this->db->reconnect();

        $this->set_credentials();
    }

    public function set_credentials() {
        $authDetails = $this->Hotelcrs_Model->getApiAuthDetails($this->api);
        if ($authDetails != '') {
            $this->api_flag = true;
            $this->post_url = ($authDetails->mode == 0 ? $authDetails->demo_url : $authDetails->live_url);
            $this->client_id = $authDetails->client_id;
            $this->username = $authDetails->username;
            $this->password = $authDetails->password;
//            $this->version = "1.25";
        } else {
            $this->api_flag = false;
        }
    }

    public function set_variables() {
        $session_data = $this->session->userdata('hotel_search_data');
        // echo '<pre>';print_r($session_data);exit;
        $this->city_name = $session_data['cityName'];
        if(!empty($session_data['hotelname']))
        {
          $this->hotelname=trim($session_data['hotelname']);
          $cityNamedet=explode('||', trim($session_data['cityName']));
          $citydetails=explode(',', trim($cityNamedet[1]));
          $this->crshotelcode=$this->Hotelcrs_Model->get_crshotelcode($this->api,$this->hotelname,trim($citydetails[0]),trim($citydetails[1]));
        }
        else
        {
           $this->crshotelcode='';
        }

        $this->city_code = $session_data['cityCode'];
        $this->cin = $session_data['checkIn'];
        $this->cout = $session_data['checkOut'];
        $this->Sys_RefNo = $session_data['uniqueRefNo'];
        $this->rooms = $session_data['rooms'];
        $this->nights = $session_data['nights'];

        $this->adults = $session_data['adults'];
        $this->childs = $session_data['childs'];
        $this->adult_extrabed = $session_data['adult_extrabed'];
        $this->child_extrabed = $session_data['child_extrabed'];
        $this->childs_ages = $session_data['childs_ages'];
        $this->adults_count = $session_data['adults_count'];
        $this->childs_count = $session_data['childs_count'];
        $this->adult_extrabed_count = $session_data['adult_extrabed_count'];
        $this->child_extrabed_count = $session_data['child_extrabed_count'];


       $this->nationality = 'IN';
        // $this->nationality = $session_data['nationality'];
        $country_name=$this->Hotelcrs_Model->get_country_name($this->nationality);
        $this->market_name=$country_name->country_name;       
        $this->base_currency = 'USD';
    }


    public function generate_hotel_combnation($room_codes) {
        $merged_rooms = array();
        $count = count($room_codes);
        if (is_array($room_codes[0]) && $count > 1) {
            $first_room_set = $room_codes[0];
            if ($count > 2) {
                $oth_room_set = $this->get_hotel_combination(array_slice($room_codes, 1));
            } else {
                $oth_room_set = $room_codes[1];
            }
            foreach ($first_room_set as $room1) {
                foreach ($oth_room_set as $othroom) {
                    if (is_array($othroom)) {
                        $merged_rooms[] = array_merge(array($room1), $othroom);
                    } else {
                        $merged_rooms[] = array($room1, $othroom);
                    }
                }
            }
        } else {
            if ($count == 1 && is_array($room_codes[0])) {
                $temp = array();
                foreach ($room_codes[0] as $room_code) {
                    $temp[] = array($room_code);
                }
                return $temp;
            } else {
                return $room_codes;
            }
        }
        return $merged_rooms;
    }

    


 public function hotels_availabilty_search()
   {     
        $session_data = $this->session->userdata('hotel_search_data');
        $this->city_name = $session_data['cityName'];
        //print_r($session_data );
        if(!empty($session_data['hotelname']))
        {
          $this->hotelname=trim($session_data['hotelname']);
          $cityNamedet=explode('||', trim($session_data['cityName']));
          $citydetails=explode(',', trim($cityNamedet[1]));
        
          $this->crshotelcode=$this->Hotelcrs_Model->get_crshotelcode($this->api,$this->hotelname,trim($citydetails[0]),trim($citydetails[1]));
          //echo $this->db->last_query();exit;
          
        }
        else
        {
           $this->crshotelcode='';
        }

        $this->city_code = $session_data['cityCode'];
        $this->cin = $session_data['checkIn'];
        $this->cout = $session_data['checkOut'];
        $this->Sys_RefNo = $session_data['uniqueRefNo'];
        $this->rooms = $session_data['rooms'];
        $this->nights = $session_data['nights'];

        $this->adults = $session_data['adults'];
        $this->childs = $session_data['childs'];
        $this->adult_extrabed = $session_data['adult_extrabed'];
        $this->child_extrabed = $session_data['child_extrabed'];
        $this->childs_ages = $session_data['childs_ages'];
        $this->adults_count = $session_data['adults_count'];
        $this->childs_count = $session_data['childs_count'];
        $this->adult_extrabed_count = $session_data['adult_extrabed_count'];
        $this->child_extrabed_count = $session_data['child_extrabed_count'];


       $this->nationality = 'IN';
        
     //$this->set_variables();
        
     // if ($this->session->userdata('hotel_search_activate') == 1)
     //  {       
     //    echo json_encode(array('results' => 'success'));
     //  }
     // else
     //  {  

        $checkCityCode = $this->Hotelcrs_Model->checkCityCode($this->city_code);
        //echo $this->db->last_query();exit;
        $cityName = $checkCityCode->city_name;       
        $this->Hotelcrs_Model->delete_temp_results($this->sess_id, 'hotel_crs');
            if (!empty($this->childs_ages))
            {
                 $child_ages = implode(',', $this->childs_ages);
            }
            else
            { 
             $child_ages = ''; 
            }

            if ($checkCityCode != '' && $this->api_flag == 1)
            {

                $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $this->cin)));
                $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $this->cout)));
                $validation = true;
                $error_message = '';
                // if (strtotime("now") > strtotime($checkIn))
                // {
                //    $validation = false;
                //    $error_message = "Invalid Checkin Time";
                // }
                if (strtotime("now") > strtotime($checkOut))
                {

                    $validation = false;
                    $error_message = "Invalid Checkout Time";
                }
                for ($i = 0; $i < $this->rooms; $i++)
                {

                    if (empty($this->childs[$i]))
                    {
                        $this->childs[$i] = 0;
                    }
                    if ($this->adults[$i] == 0 && $this->childs[$i] == 0)
                     {
                        $validation = false;
                        $error_message = "Invalid Passenger Information;";
                        break;
                    }
                }
               if ($validation) 
               {    //print_r($i);exit;
                 $this->extracthotel_stay_pay($checkIn,$checkOut);                 
                 $this->extracthotel_early_bird($checkIn,$checkOut);
                 $this->extracthotel_discount($checkIn,$checkOut);
                 $this->extracthotel($checkIn,$checkOut); //echo $this->db->last_query();exit;

                $searchhotelcodeslist=$this->Hotelcrs_Model->getsearchhotelcodes($this->sess_id, $this->api);
                // echo '<pre>';print_r($searchhotelcodeslist);exit;

                  if(!empty($searchhotelcodeslist))
                  {
                      foreach($searchhotelcodeslist as $val)
                      {
                         for ($i = 0; $i < $this->rooms; $i++)
                         { 
                            $checkroom=$this->Hotelcrs_Model->check_hotel_search($this->api,$this->sess_id,$val->hotel_code,$i);

                            if(empty($checkroom))
                            {
                               $this->Hotelcrs_Model->delete_hotel_results($this->api,$this->sess_id,$val->hotel_code);
                               break;
                            }

                        }
                      }
                    }
                } 
            }             
        echo json_encode(array('results' => 'success'));

    // }
    }

function extracthotel_stay_pay($checkIn,$checkOut)
  {
    if(!empty($this->crshotelcode)){
        $hotelcodes=$this->crshotelcode;
    } else{
     $hotelcodes=$this->Hotelcrs_Model->gethotelcodes($this->city_code,0,500);
    }

    // if(empty($hotelcodes)){
    //   return '';
    // }

       // echo $this->db->last_query();
       // echo '<pre>';print_r($hotelcodes);exit;
     $hotelcodess=array();
     foreach($hotelcodes as $hot)
     {
        $hotelcodess[]=$hot->hotel_code;
     }

     $roomcodes=$this->Hotelcrs_Model->getroomcodes($hotelcodess,0,2000);
     // echo '<pre>';print_r($roomcodes);exit;
     $rmhotelcodes=array();
     $rmcodes=array();
     foreach($roomcodes as $rm)
     {
        $rmhotelcodes[]=$rm->hotel_code;
        $rmcodes[]=$rm->room_code;
     }
     $htcode=array_unique($rmhotelcodes);
     $to_date=strtotime($checkOut);
     $from_date=strtotime($checkIn); 
     $days=floor(($to_date - $from_date) / (60 * 60 * 24));
     $resultsarr_PRPN_stay_pay=array(); 
     $resultsarr_PPPN_stay_pay=array(); 
     $results=array();
     $room_count_arr=array();       
     $rmhotelcodess=implode(',', $rmhotelcodes); 
     $rmcodess=implode(',', $rmcodes); 
     for ($i = 0; $i < $this->rooms; $i++)
     { 
        $res_PRPN_stay_pay=array(); 
        $res_PPPN_stay_pay=array();          
        $res_PRPN_stay_pay = $this->Hotelcrs_Model->get_crs_hotels_PRPN_stay_pay($rmhotelcodess,$rmcodess,$this->city_code, $checkIn, $checkOut, $this->adults[$i], $this->childs[$i], $this->adult_extrabed[$i], $this->child_extrabed[$i],$this->nights,$this->rooms,$this->market_name);
         
         
        if(empty($res_PRPN_stay_pay))
        {
            $res_PRPN_stay_pay = $this->Hotelcrs_Model->get_crs_hotels_PRPN_stay_pay($rmhotelcodess,$rmcodess,$this->city_code, $checkIn, $checkOut, $this->adults[$i], $this->childs[$i], $this->adult_extrabed[$i], $this->child_extrabed[$i],$this->nights,$this->rooms,'All Markets');



        }

            $res_PPPN_stay_pay = $this->Hotelcrs_Model->get_crs_hotels_PPPN_stay_pay($rmhotelcodess,$rmcodess,$this->city_code, $checkIn, $checkOut, $this->adults[$i], $this->childs[$i], $this->adult_extrabed[$i], $this->child_extrabed[$i],$this->nights,$this->rooms,$this->market_name);



        if(empty($res_PPPN_stay_pay))
        {
           $res_PPPN_stay_pay = $this->Hotelcrs_Model->get_crs_hotels_PPPN_stay_pay($rmhotelcodess,$rmcodess,$this->city_code, $checkIn, $checkOut, $this->adults[$i], $this->childs[$i], $this->adult_extrabed[$i], $this->child_extrabed[$i],$this->nights,$this->rooms,'All Markets');

          // echo $this->db->last_query();exit;
        }


        if(!empty($res_PRPN_stay_pay))
           {

             $resultsarr_PRPN_stay_pay[$i]=$res_PRPN_stay_pay;

           }             
          if(!empty($res_PPPN_stay_pay))
           {
             $resultsarr_PPPN_stay_pay[$i]=$res_PPPN_stay_pay;
           }
    }
   //echo "<pre>"; print_r($resultsarr_PPPN_stay_pay); exit; 
   // echo $this->db->last_query();exit;

    for ($i = 0; $i < $this->rooms; $i++)
    {

        $index='';
        $indexarr=array();
        $roommealarr=array();
        $childsagearr=array(); 
        $child_ages = '';  
        if ($this->childs[$i] != 0)
        {  

           $child_ages=$this->childs_ages[$i];
           $ages = explode(',', $this->childs_ages[$i]);   
           for ($c = 0; $c < $this->childs[$i]; $c++)
            {  
              $childsagearr[]=$ages[$c];                  
            }
        } 
        $childsagestr='';
        if(!empty($childsagearr))
        {
           $childsagestr=implode("|", $childsagearr);
           $childsagestr="|".$childsagestr;
        }

       
           if(isset($resultsarr_PRPN_stay_pay[$i]))
           {
              
               $arr=json_decode(json_encode($resultsarr_PRPN_stay_pay[$i]),TRUE);
                  $prior_checkin_arr=(array_unique(($this->array_column($arr, 'prior_checkin'))));
                rsort($prior_checkin_arr);              
                $prior_checkin_date_arr=(array_unique($this->array_column($arr, 'prior_checkin_date')));
                 rsort($prior_checkin_date_arr);              
                $period_from_date_arr=(array_unique($this->array_column($arr, 'period_from_date'))); 
                 rsort($period_from_date_arr);              
                $prior_checkin_cnt=count($prior_checkin_arr);
                $prior_checkin_date_cnt=count($prior_checkin_date_arr);
                $period_from_date_cnt=count($period_from_date_arr);
                $prior_cnt=0;
                if(isset($prior_checkin_arr)&&($prior_checkin_cnt>=$prior_checkin_date_cnt)&&($prior_checkin_cnt>=$period_from_date_cnt))
                  {
                    $prior_cnt=$prior_checkin_cnt;
                  }
                else if(isset($prior_checkin_date_arr)&&($prior_checkin_date_cnt>=$prior_checkin_cnt)&&($prior_checkin_date_cnt>=$period_from_date_cnt))
                  {
                    $prior_cnt=$prior_checkin_date_cnt;
                  }
                else if(isset($period_from_date_arr)&&($period_from_date_cnt>=$prior_checkin_date_cnt)&&($period_from_date_cnt>=$prior_checkin_cnt))
                  {
                    $prior_cnt=$period_from_date_cnt;
                  }           
            
            for($pr=0;$pr<$prior_cnt;$pr++)           
             {   
                
              for($l=0;$l<count($resultsarr_PRPN_stay_pay[$i]);$l++)
              {
               /* if(strtotime($checkIn)==strtotime($resultsarr_PRPN_stay_pay[$i][$l]->room_avail_date)) */
                  if((strtotime($checkIn)==strtotime($resultsarr_PRPN_stay_pay[$i][$l]->room_avail_date))&&(((isset($prior_checkin_arr[$pr])&&($prior_checkin_arr[$pr]!='')&&($prior_checkin_arr[$pr]==$resultsarr_PRPN_stay_pay[$i][$l]->prior_checkin)))||(((isset($prior_checkin_date_arr[$pr])&&($prior_checkin_date_arr[$pr]!='0000-00-00')&&$prior_checkin_date_arr[$pr]==$resultsarr_PRPN_stay_pay[$i][$l]->prior_checkin_date)))||(((isset($period_from_date_arr[$pr])&&($period_from_date_arr[$pr]!='0000-00-00')&&$period_from_date_arr[$pr]==$resultsarr_PRPN_stay_pay[$i][$l]->period_from_date)))))
                  {                
                    $day=0;
                    $flag=true;
                    $total_cost=0;
                    $net_fare=0; 
                    $mandatory_supplement_net_fare=0;
                    $nonmandatory_supplement_net_fare=0;                 
                    $mandatory_supplement_cost=0;
                    $crs_mandatory_supplement=array();
                    $mandatory_supplement_meal_plan=array();  
                    $nonmandatory_supplement_cost=0;
                    $crs_nonmandatory_supplement=array();
                    $nonmandatory_supplement_meal_plan=array(); 
                    $crs_booking_code=array();                 
                    $hotel_room_allotment=array();        
                    $rt_hotel_code=$resultsarr_PRPN_stay_pay[$i][$l]->hotel_code;
                    $rt_room_code=$resultsarr_PRPN_stay_pay[$i][$l]->room_code;
                    $min_adults=$resultsarr_PRPN_stay_pay[$i][$l]->min_adults_without_extra_bed;
                    $max_adults=$resultsarr_PRPN_stay_pay[$i][$l]->max_adults_without_extra_bed;
                    $min_child=$resultsarr_PRPN_stay_pay[$i][$l]->min_child_without_extra_bed;
                    $max_child=$resultsarr_PRPN_stay_pay[$i][$l]->max_child_without_extra_bed;
                    $adults_bed=$resultsarr_PRPN_stay_pay[$i][$l]->extra_bed_for_adults;
                    $child_bed=$resultsarr_PRPN_stay_pay[$i][$l]->extra_bed_for_child;
                    $rt_contract_id=$resultsarr_PRPN_stay_pay[$i][$l]->contract_id;
                    $rt_market=$resultsarr_PRPN_stay_pay[$i][$l]->market;
                    $rt_exclude_market=explode('||',$resultsarr_PRPN_stay_pay[$i][$l]->exclude_market);
                    $rt_meal_plan=$resultsarr_PRPN_stay_pay[$i][$l]->meal_plan;
                    $rt_supplier_id=$resultsarr_PRPN_stay_pay[$i][$l]->supplier_id;

                    $rt_specialoffer_id=$resultsarr_PRPN_stay_pay[$i][$l]->specialoffer_id;
                    $rt_specialoffer_type=$resultsarr_PRPN_stay_pay[$i][$l]->specialoffer_type;
                    $rt_min_no_of_stay_day=$resultsarr_PRPN_stay_pay[$i][$l]->min_no_of_stay_day;
                    $rt_max_no_of_stay_day=$resultsarr_PRPN_stay_pay[$i][$l]->max_no_of_stay_day;
                    $rt_no_of_stay_free_nights=$resultsarr_PRPN_stay_pay[$i][$l]->no_of_stay_free_nights;
                    $rt_prior_day_type=$resultsarr_PRPN_stay_pay[$i][$l]->prior_day_type;
                    $rt_prior_checkin=$resultsarr_PRPN_stay_pay[$i][$l]->prior_checkin;
                    $rt_prior_checkin_date=$resultsarr_PRPN_stay_pay[$i][$l]->prior_checkin_date;
                    $rt_period_from_date=$resultsarr_PRPN_stay_pay[$i][$l]->period_from_date;
                    $rt_period_to_date=$resultsarr_PRPN_stay_pay[$i][$l]->period_to_date;
                    $paynight=$this->nights-$rt_no_of_stay_free_nights;

                $index1='STAYPAY_PRPN'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_contract_id.'|'.$rt_market.'|'.$rt_meal_plan.'|'.$rt_specialoffer_id.'|'.$rt_specialoffer_type.'|'.$rt_min_no_of_stay_day.'|'.$rt_max_no_of_stay_day.'|'.$rt_no_of_stay_free_nights.'|'.$rt_prior_day_type.'|'.$rt_prior_checkin.'|'.$rt_prior_checkin_date.'|'.$rt_period_from_date.'|'.$rt_period_to_date.'|'.($i+1).'|'.$min_adults.'|'.$max_adults.'|'.$min_child.'|'.$max_child.'|'.$adults_bed.'|'.$child_bed.'|'.$this->adults[$i].'|'.$this->childs[$i].'|'.$this->adult_extrabed[$i].'|'.$this->child_extrabed[$i];

                   $roommealtype1='STAYPAY_PRPN'.'|'.($i+1).'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_meal_plan;
                     
              
                    if(in_array($this->market_name, $rt_exclude_market))
                    {
                      continue;
                    }

                    if(!empty($roommealarr[$i][$roommealtype1]))
                    {
                        continue;
                    }

                    if(!empty($indexarr[$i][$index1]))
                    {
                        continue;
                    }
                    for($j=0,$s=0;$j<count($resultsarr_PRPN_stay_pay[$i])&&!empty($resultsarr_PRPN_stay_pay[$i]);$j++)
                     {
                      if($rt_hotel_code==$resultsarr_PRPN_stay_pay[$i][$j]->hotel_code&&
                        $rt_room_code==$resultsarr_PRPN_stay_pay[$i][$j]->room_code&&
                        $rt_supplier_id==$resultsarr_PRPN_stay_pay[$i][$j]->supplier_id&&
                        $rt_contract_id==$resultsarr_PRPN_stay_pay[$i][$j]->contract_id&&
                        $rt_market==$resultsarr_PRPN_stay_pay[$i][$j]->market&&
                        $rt_meal_plan==$resultsarr_PRPN_stay_pay[$i][$j]->meal_plan&&
                        $min_adults==$resultsarr_PRPN_stay_pay[$i][$j]->min_adults_without_extra_bed&&
                        $max_adults==$resultsarr_PRPN_stay_pay[$i][$j]->max_adults_without_extra_bed&&
                        $min_child==$resultsarr_PRPN_stay_pay[$i][$j]->min_child_without_extra_bed&&
                        $max_child==$resultsarr_PRPN_stay_pay[$i][$j]->max_child_without_extra_bed&&
                        $adults_bed==$resultsarr_PRPN_stay_pay[$i][$j]->extra_bed_for_adults&&
                        $child_bed==$resultsarr_PRPN_stay_pay[$i][$j]->extra_bed_for_child&&
                        $rt_specialoffer_id==$resultsarr_PRPN_stay_pay[$i][$j]->specialoffer_id&&
                        $rt_specialoffer_type==$resultsarr_PRPN_stay_pay[$i][$j]->specialoffer_type&&
                        $rt_min_no_of_stay_day==$resultsarr_PRPN_stay_pay[$i][$j]->min_no_of_stay_day&& 
                       $rt_max_no_of_stay_day==$resultsarr_PRPN_stay_pay[$i][$j]->max_no_of_stay_day&& 
                       $rt_no_of_stay_free_nights==$resultsarr_PRPN_stay_pay[$i][$j]->no_of_stay_free_nights&& 
                        $rt_prior_day_type==$resultsarr_PRPN_stay_pay[$i][$j]->prior_day_type&&
                        $rt_prior_checkin==$resultsarr_PRPN_stay_pay[$i][$j]->prior_checkin&&
                        $rt_prior_checkin_date==$resultsarr_PRPN_stay_pay[$i][$j]->prior_checkin_date&&
                         $rt_period_from_date==$resultsarr_PRPN_stay_pay[$i][$j]->period_from_date&&
                        $rt_period_to_date==$resultsarr_PRPN_stay_pay[$i][$j]->period_to_date )
                        {
                           $roommealtype='STAYPAY_PRPN'.'|'.($i+1).'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_meal_plan;
                          $index='STAYPAY_PRPN'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_contract_id.'|'.$rt_market.'|'.$rt_meal_plan.'|'.$rt_specialoffer_id.'|'.$rt_specialoffer_type.'|'.$rt_min_no_of_stay_day.'|'.$rt_max_no_of_stay_day.'|'.$rt_no_of_stay_free_nights.'|'.$rt_prior_day_type.'|'.$rt_prior_checkin.'|'.$rt_prior_checkin_date.'|'.$rt_period_from_date.'|'.$rt_period_to_date.'|'.($i+1).'|'.$min_adults.'|'.$max_adults.'|'.$min_child.'|'.$max_child.'|'.$adults_bed.'|'.$child_bed.'|'.$this->adults[$i].'|'.$this->childs[$i].'|'.$this->adult_extrabed[$i].'|'.$this->child_extrabed[$i];

                            $day=$day+1;
                            $s=$j;
                          $tot=$resultsarr_PRPN_stay_pay[$i][$j]->room_rate+($this->adult_extrabed[$i]*$resultsarr_PRPN_stay_pay[$i][$j]->extra_bed_for_adults_rate)+($this->child_extrabed[$i]*$resultsarr_PRPN_stay_pay[$i][$j]->extra_bed_for_child_rate);

                            // Supplement
                          $supplementdatacheck=array(
                               'hotel_code'=>$rt_hotel_code,
                               'room_code'=>$rt_room_code,
                               'supplier_id'=>$rt_supplier_id,
                               'contract_id'=>$rt_contract_id,
                               'market'=>$rt_market,
                               'meal_plan'=>$rt_meal_plan,
                               'avail_date'=>$resultsarr_PRPN_stay_pay[$i][$j]->room_avail_date,
                              );
                     
                       
                      // echo '<pre>';print_r($supplementdatacheck);exit;
                        $mandatory_supplements_check_arr=$this->Hotelcrs_Model->check_crs_hotels_normal_supplements_rates($supplementdatacheck,'Stay Pay','Yes');
                      foreach($mandatory_supplements_check_arr as $supplementarr)
                      {

                      list($mandatory_supplementarr,$mandatory_supp_cost,$mandatory_supplement_mealplan,$spec_offer_applicable_supplement)=$this->supplements_check($supplementarr,$i);
                        $crs_mandatory_supplement[]=$mandatory_supplementarr; 
                     
                         $mandatory_tot=$mandatory_supp_cost;


                        $mandatory_supplement_net_fare+=$mandatory_tot;
                        if($paynight>=$day&&$spec_offer_applicable_supplement=="Yes")
                          {                          
                             $mandatory_supplement_cost+=$mandatory_tot;                                                
                           }
                           else if($spec_offer_applicable_supplement!="Yes")
                           {
                              $mandatory_supplement_cost+=$mandatory_tot;
                           }
                              

                        $mandatory_suppmealplan=explode(',', $mandatory_supplement_mealplan);
                        foreach($mandatory_suppmealplan as $supp){
                        $mandatory_supplement_meal_plan[]=$supp;
                      }
                      }                  
                    $nonmandatory_supplements_check_arr=$this->Hotelcrs_Model->check_crs_hotels_normal_supplements_rates($supplementdatacheck,'Stay Pay','No');
                      foreach($nonmandatory_supplements_check_arr as $supplementarr)
                      {

                      list($nonmandatory_supplementarr,$nonmandatory_supp_cost,$nonmandatory_supplement_mealplan,$spec_offer_applicable_supplement)=$this->supplements_check($supplementarr,$i);
                        $crs_nonmandatory_supplement[]=$nonmandatory_supplementarr;

                      
                             $nonmandatory_tot=$nonmandatory_supp_cost;


                        $nonmandatory_supplement_net_fare+=$nonmandatory_tot;
                        if($paynight>=$day&&$spec_offer_applicable_supplement=="Yes")
                          {                          
                             $nonmandatory_supplement_cost+=$nonmandatory_tot;                                                
                           }
                           else if($spec_offer_applicable_supplement!="Yes")
                           {
                              $nonmandatory_supplement_cost+=$nonmandatory_tot;
                           }

                        $nonmandatory_suppmealplan=explode(',', $nonmandatory_supplement_mealplan);
                        foreach($nonmandatory_suppmealplan as $supp){
                        $nonmandatory_supplement_meal_plan[]=$supp;
                      }
                      }

                        $net_fare+=$tot;
                        if($paynight>=$day)
                          {                          
                             $total_cost+=$tot;                                                
                           }


                        $hotel_room_allotment[]=$resultsarr_PRPN_stay_pay[$i][$j]->sup_hotel_room_allotment_id;
                        $crs_booking_code[]=$resultsarr_PRPN_stay_pay[$i][$j]->booking_code;
                        }
                     }

                    if($day==$this->nights)
                    {                
                        $indexarr[$i][$index]=$index;
                        $roommealarr[$i][$roommealtype]=$roommealtype;
                        $room_count_arr[$i]=$i;

                        $crs_booking_code=array_unique($crs_booking_code);
                        $crs_booking_code_str=implode(',', $crs_booking_code);
                        $resultsarr_PRPN_stay_pay[$i][$s]->hotel_crs_booking_code=$crs_booking_code_str;

                        $resultsarr_PRPN_stay_pay[$i][$s]->total_cost=$total_cost;
                        $resultsarr_PRPN_stay_pay[$i][$s]->net_fare=$net_fare;
                        $resultsarr_PRPN_stay_pay[$i][$s]->discount=($net_fare-$total_cost);

                        $resultsarr_PRPN_stay_pay[$i][$s]->crs_mandatory_supplement=json_encode($crs_mandatory_supplement);
                        $mandatory_supplement_meal_plan=array_unique($mandatory_supplement_meal_plan);
                        $resultsarr_PRPN_stay_pay[$i][$s]->mandatory_supplement_meal_plan=implode(',',$mandatory_supplement_meal_plan);
                        $resultsarr_PRPN_stay_pay[$i][$s]->mandatory_supplement_cost=$mandatory_supplement_cost;
                        $resultsarr_PRPN_stay_pay[$i][$s]->mandatory_supplement_net_fare=$mandatory_supplement_net_fare;

                        $resultsarr_PRPN_stay_pay[$i][$s]->mandatory_supplement_discount=($mandatory_supplement_net_fare-$mandatory_supplement_cost);

                        $resultsarr_PRPN_stay_pay[$i][$s]->crs_nonmandatory_supplement=json_encode($crs_nonmandatory_supplement);
                        $nonmandatory_supplement_meal_plan=array_unique($nonmandatory_supplement_meal_plan);
                        $resultsarr_PRPN_stay_pay[$i][$s]->nonmandatory_supplement_meal_plan=implode(',',$nonmandatory_supplement_meal_plan);
                        $resultsarr_PRPN_stay_pay[$i][$s]->nonmandatory_supplement_cost=$nonmandatory_supplement_cost;
                        $resultsarr_PRPN_stay_pay[$i][$s]->nonmandatory_supplement_net_fare=$nonmandatory_supplement_net_fare;
                        $resultsarr_PRPN_stay_pay[$i][$s]->nonmandatory_supplement_discount=($nonmandatory_supplement_net_fare-$nonmandatory_supplement_cost);

                      //   $resultsarr_PRPN_stay_pay[$i][$s]->total_cost=$total_cost;
                      //  $resultsarr_PRPN_stay_pay[$i][$s]->crs_mandatory_supplement=json_encode($crs_mandatory_supplement);
                      //    $mandatory_supplement_meal_plan=array_unique($mandatory_supplement_meal_plan);
                      // $resultsarr_PRPN_stay_pay[$i][$s]->mandatory_supplement_meal_plan=implode(',',$mandatory_supplement_meal_plan);
                      //  $resultsarr_PRPN_stay_pay[$i][$s]->mandatory_supplement_cost=$mandatory_supplement_cost;
                      //   $resultsarr_PRPN_stay_pay[$i][$s]->net_fare=$net_fare;
                      //   $resultsarr_PRPN_stay_pay[$i][$s]->discount=($net_fare-$total_cost);
                        $resultsarr_PRPN_stay_pay[$i][$s]->room_index=$i;
                        $resultsarr_PRPN_stay_pay[$i][$s]->index=$index;
                        $resultsarr_PRPN_stay_pay[$i][$s]->adult=$this->adults[$i];
                        $resultsarr_PRPN_stay_pay[$i][$s]->child=$this->childs[$i];
                        $resultsarr_PRPN_stay_pay[$i][$s]->adult_extrabed=$this->adult_extrabed[$i];
                        $resultsarr_PRPN_stay_pay[$i][$s]->child_extrabed=$this->child_extrabed[$i];
                        $resultsarr_PRPN_stay_pay[$i][$s]->nights=$this->nights; 
                        $resultsarr_PRPN_stay_pay[$i][$s]->childs_ages=$child_ages;
                        $resultsarr_PRPN_stay_pay[$i][$s]->type='STAYPAY';
                        $resultsarr_PRPN_stay_pay[$i][$s]->hotel_room_allotment=implode(',', $hotel_room_allotment);                       
                        $cancelpolicy_arr=array(
                            'supplier_id'=>$resultsarr_PRPN_stay_pay[$i][$s]->supplier_id,
                            'sup_hotel_id'=>$resultsarr_PRPN_stay_pay[$i][$s]->sup_hotel_id,   
                            'hotel_code'=>$resultsarr_PRPN_stay_pay[$i][$s]->hotel_code,   
                            'room_code'=>$resultsarr_PRPN_stay_pay[$i][$s]->room_code,   
                            'contract_id'=>$resultsarr_PRPN_stay_pay[$i][$s]->contract_id,   
                            'sup_room_details_id'=>$resultsarr_PRPN_stay_pay[$i][$s]->sup_room_details_id,   
                            'market'=>$resultsarr_PRPN_stay_pay[$i][$s]->market,   
                            'meal_plan'=>$resultsarr_PRPN_stay_pay[$i][$s]->meal_plan,
                             'specialoffer_id'=>$resultsarr_PRPN_stay_pay[$i][$s]->specialoffer_id,   
                            'specialoffer_type'=>$resultsarr_PRPN_stay_pay[$i][$s]->specialoffer_type,
                            'rate_type'=>$resultsarr_PRPN_stay_pay[$i][$s]->rate_type,
                            'min_room_occupancy'=>$resultsarr_PRPN_stay_pay[$i][$s]->min_room_occupancy,   
                            'max_room_occupancy'=>$resultsarr_PRPN_stay_pay[$i][$s]->max_room_occupancy,   
                            'min_adults_without_extra_bed'=>$resultsarr_PRPN_stay_pay[$i][$s]->min_adults_without_extra_bed,   
                            'max_adults_without_extra_bed'=>$resultsarr_PRPN_stay_pay[$i][$s]->max_adults_without_extra_bed,   
                            'min_child_without_extra_bed'=>$resultsarr_PRPN_stay_pay[$i][$s]->min_child_without_extra_bed,   
                            'max_child_without_extra_bed'=>$resultsarr_PRPN_stay_pay[$i][$s]->max_child_without_extra_bed,   
                            'extra_bed_for_adults'=>$resultsarr_PRPN_stay_pay[$i][$s]->extra_bed_for_adults,   
                            'extra_bed_for_child'=>$resultsarr_PRPN_stay_pay[$i][$s]->extra_bed_for_child,   
                          );
                   $cancellation_policy=$this->Hotelcrs_Model->check_specialoffer_crs_hotels_normal_cancel_policy($cancelpolicy_arr,$checkIn);                                     

                    $cancel_policy='';
                    $hotel_crs_cancellation_json=array();
                    if(!empty($cancellation_policy[0]))
                    {
                      for($can=0,$incre=0;$can<count($cancellation_policy);$can++)
                      {
                        $last_date = $cancellation_policy[$can]->days_before_checkin;                     
                        if($last_date!=0)
                        {
                        $cancel_date = date('Y-m-d', strtotime('-' . $last_date . ' days ', strtotime($checkIn)));
                        }
                        else
                        {
                         $cancel_date = $checkIn; 
                        }
                        if($can==0 ||($can>=1&&$cancellation_policy[$can]->days_before_checkin!=$cancellation_policy[($can-1)]->days_before_checkin))
                       {                             
                         if($cancellation_policy[$can]->cancel_rates_type=='non_refundable')
                         {
                           $cancel_policy ='<p>Non Refundable</p>';
                         $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;                        
                         }
                         if($cancellation_policy[$can]->cancel_rates_type=='fullstay')
                         {
                          $cancel_policy_str='Full Stay Charge';

                           $cancel_policy .= '<p>Full Stay Charge. If cancelled on ' . $cancel_date . ' </p>';
                       $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }        
                        if($cancellation_policy[$can]->cancel_rates_type=='fixed'){
                          $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . ' '.$resultsarr_PRPN_stay_pay[$i][$s]->currency_type.' will charged. If cancelled on ' . $cancel_date . ' </p>';
                        $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }
                        if($cancellation_policy[$can]->cancel_rates_type=='percentage')
                        {
                          $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . '% will charged. If cancelled on ' . $cancel_date . ' </p>';
                        $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }
                     }                   
                    
                    }
                  }
                  $resultsarr_PRPN_stay_pay[$i][$s]->cancel_policy=$cancel_policy;
                  $resultsarr_PRPN_stay_pay[$i][$s]->hotel_crs_cancellation_json=json_encode($hotel_crs_cancellation_json);  
                   $results[$index]=$resultsarr_PRPN_stay_pay[$i][$s];           
                  
                  } 
                 }
               
               }
            
               }
             }
             
           if(isset($resultsarr_PPPN_stay_pay[$i]))
           {    
            
              $arr=json_decode(json_encode($resultsarr_PPPN_stay_pay[$i]),TRUE);
                  $prior_checkin_arr=(array_unique(($this->array_column($arr, 'prior_checkin'))));
                rsort($prior_checkin_arr);              
                $prior_checkin_date_arr=(array_unique($this->array_column($arr, 'prior_checkin_date')));
                 rsort($prior_checkin_date_arr);              
                $period_from_date_arr=(array_unique($this->array_column($arr, 'period_from_date'))); 
                 rsort($period_from_date_arr);              
                $prior_checkin_cnt=count($prior_checkin_arr);
                $prior_checkin_date_cnt=count($prior_checkin_date_arr);
                $period_from_date_cnt=count($period_from_date_arr);
                $prior_cnt=0;
                if(isset($prior_checkin_arr)&&($prior_checkin_cnt>=$prior_checkin_date_cnt)&&($prior_checkin_cnt>=$period_from_date_cnt))
                  {
                    $prior_cnt=$prior_checkin_cnt;
                  }
                else if(isset($prior_checkin_date_arr)&&($prior_checkin_date_cnt>=$prior_checkin_cnt)&&($prior_checkin_date_cnt>=$period_from_date_cnt))
                  {
                    $prior_cnt=$prior_checkin_date_cnt;
                  }
                else if(isset($period_from_date_arr)&&($period_from_date_cnt>=$prior_checkin_date_cnt)&&($period_from_date_cnt>=$prior_checkin_cnt))
                  {
                    $prior_cnt=$period_from_date_cnt;
                  }            
            
            for($pr=0;$pr<$prior_cnt;$pr++)           
             {   
                
              for($l=0;$l<count($resultsarr_PPPN_stay_pay[$i]);$l++)
              {
               /* if(strtotime($checkIn)==strtotime($resultsarr_PPPN_stay_pay[$i][$l]->room_avail_date)) */
                  if((strtotime($checkIn)==strtotime($resultsarr_PPPN_stay_pay[$i][$l]->room_avail_date))&&(((isset($prior_checkin_arr[$pr])&&($prior_checkin_arr[$pr]!='')&&($prior_checkin_arr[$pr]==$resultsarr_PPPN_stay_pay[$i][$l]->prior_checkin)))||(((isset($prior_checkin_date_arr[$pr])&&($prior_checkin_date_arr[$pr]!='0000-00-00')&&$prior_checkin_date_arr[$pr]==$resultsarr_PPPN_stay_pay[$i][$l]->prior_checkin_date)))||(((isset($period_from_date_arr[$pr])&&($period_from_date_arr[$pr]!='0000-00-00')&&$period_from_date_arr[$pr]==$resultsarr_PPPN_stay_pay[$i][$l]->period_from_date)))))            
               {
                    $day=0;
                    $flag=true;
                    $total_cost=0;
                    $mandatory_supplement_cost=0;
                    $crs_mandatory_supplement=array(); 
                    $mandatory_supplement_meal_plan=array();
                    $nonmandatory_supplement_cost=0;
                    $crs_nonmandatory_supplement=array();
                    $nonmandatory_supplement_meal_plan=array();  
                    $crs_booking_code=array();
                    $net_fare=0;
                    $mandatory_supplement_net_fare=0;
                    $nonmandatory_supplement_net_fare=0;                  
                    $hotel_room_allotment=array();     
                    $rt_hotel_code=$resultsarr_PPPN_stay_pay[$i][$l]->hotel_code;
                    $rt_room_code=$resultsarr_PPPN_stay_pay[$i][$l]->room_code;
                    $min_room_occupancy=$resultsarr_PPPN_stay_pay[$i][$l]->min_room_occupancy;
                    $max_room_occupancy=$resultsarr_PPPN_stay_pay[$i][$l]->max_room_occupancy;
                    $rt_contract_id=$resultsarr_PPPN_stay_pay[$i][$l]->contract_id;
                    $rt_market=$resultsarr_PPPN_stay_pay[$i][$l]->market;
                    $rt_exclude_market=explode('||',$resultsarr_PPPN_stay_pay[$i][$l]->exclude_market);
                    $rt_meal_plan=$resultsarr_PPPN_stay_pay[$i][$l]->meal_plan;
                    $rt_supplier_id=$resultsarr_PPPN_stay_pay[$i][$l]->supplier_id;

                    $rt_specialoffer_id=$resultsarr_PPPN_stay_pay[$i][$l]->specialoffer_id;
                    $rt_specialoffer_type=$resultsarr_PPPN_stay_pay[$i][$l]->specialoffer_type;
                    $rt_min_no_of_stay_day=$resultsarr_PPPN_stay_pay[$i][$l]->min_no_of_stay_day; 
                    $rt_max_no_of_stay_day=$resultsarr_PPPN_stay_pay[$i][$l]->max_no_of_stay_day;
                    $rt_no_of_stay_free_nights=$resultsarr_PPPN_stay_pay[$i][$l]->no_of_stay_free_nights; 
                    $rt_prior_day_type=$resultsarr_PPPN_stay_pay[$i][$l]->prior_day_type;
                    $rt_prior_checkin=$resultsarr_PPPN_stay_pay[$i][$l]->prior_checkin;
                    $rt_prior_checkin_date=$resultsarr_PPPN_stay_pay[$i][$l]->prior_checkin_date;
                    $rt_period_from_date=$resultsarr_PPPN_stay_pay[$i][$l]->period_from_date;
                    $rt_period_to_date=$resultsarr_PPPN_stay_pay[$i][$l]->period_to_date;
                   $paynight=$this->nights-$rt_no_of_stay_free_nights;
                   
                    $index1='STAYPAY_PPPN'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_contract_id.'|'.$rt_market.'|'.$rt_meal_plan.'|'.$rt_specialoffer_id.'|'.$rt_specialoffer_type.'|'.$rt_min_no_of_stay_day.'|'.$rt_max_no_of_stay_day.'|'.$rt_no_of_stay_free_nights.'|'.$rt_prior_day_type.'|'.$rt_prior_checkin.'|'.$rt_prior_checkin_date.'|'.$rt_period_from_date.'|'.$rt_period_to_date.'|'.($i+1).'|'.($i+1).'|'.$min_room_occupancy.'|'.$max_room_occupancy.'|'.$this->adults[$i].'|'.$this->childs[$i].$childsagestr.'|'.$this->adult_extrabed[$i].'|'.$this->child_extrabed[$i];

                    $roommealtype1='STAYPAY_PPPN';                   
                    
                   
                    if(in_array($this->market_name, $rt_exclude_market))
                    {
                      continue;
                    }

                    if(!empty($roommealarr[$i][$roommealtype1]))
                    {
                        continue;
                    }
                    if(!empty($indexarr[$i][$index1]))
                    {
                        continue;
                    }

                  for($j=0,$s=0;$j<count($resultsarr_PPPN_stay_pay[$i])&&!empty($resultsarr_PPPN_stay_pay[$i]);$j++)
                  {  
                      if($rt_hotel_code==$resultsarr_PPPN_stay_pay[$i][$j]->hotel_code&&
                        $rt_room_code==$resultsarr_PPPN_stay_pay[$i][$j]->room_code&&
                        $rt_supplier_id==$resultsarr_PPPN_stay_pay[$i][$j]->supplier_id&&
                        $rt_contract_id==$resultsarr_PPPN_stay_pay[$i][$j]->contract_id&&
                        $rt_market==$resultsarr_PPPN_stay_pay[$i][$j]->market&&
                        $rt_meal_plan==$resultsarr_PPPN_stay_pay[$i][$j]->meal_plan&&
                        $min_room_occupancy==$resultsarr_PPPN_stay_pay[$i][$j]->min_room_occupancy&&
                        $max_room_occupancy==$resultsarr_PPPN_stay_pay[$i][$j]->max_room_occupancy&&                        
                         $rt_specialoffer_id==$resultsarr_PPPN_stay_pay[$i][$j]->specialoffer_id&&
                        $rt_specialoffer_type==$resultsarr_PPPN_stay_pay[$i][$j]->specialoffer_type&&
                         $rt_min_no_of_stay_day==$resultsarr_PPPN_stay_pay[$i][$j]->min_no_of_stay_day&& 
                        $rt_max_no_of_stay_day==$resultsarr_PPPN_stay_pay[$i][$j]->max_no_of_stay_day&& 
                        $rt_no_of_stay_free_nights==$resultsarr_PPPN_stay_pay[$i][$j]->no_of_stay_free_nights&&                       
                        $rt_prior_day_type==$resultsarr_PPPN_stay_pay[$i][$j]->prior_day_type&&
                        $rt_prior_checkin==$resultsarr_PPPN_stay_pay[$i][$j]->prior_checkin&&
                        $rt_prior_checkin_date==$resultsarr_PPPN_stay_pay[$i][$j]->prior_checkin_date&&
                         $rt_period_from_date==$resultsarr_PPPN_stay_pay[$i][$j]->period_from_date&&
                        $rt_period_to_date==$resultsarr_PPPN_stay_pay[$i][$j]->period_to_date)
                        {
                        $roommealtype='STAYPAY_PPPN'.'|'.($i+1).'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_meal_plan;
                            
                         $index='STAYPAY_PPPN'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_contract_id.'|'.$rt_market.'|'.$rt_meal_plan.'|'.$rt_specialoffer_id.'|'.$rt_specialoffer_type.'|'.$rt_min_no_of_stay_day.'|'.$rt_max_no_of_stay_day.'|'.$rt_no_of_stay_free_nights.'|'.$rt_prior_day_type.'|'.$rt_prior_checkin.'|'.$rt_prior_checkin_date.'|'.$rt_period_from_date.'|'.$rt_period_to_date.'|'.($i+1).'|'.($i+1).'|'.$min_room_occupancy.'|'.$max_room_occupancy.'|'.$this->adults[$i].'|'.$this->childs[$i].$childsagestr.'|'.$this->adult_extrabed[$i].'|'.$this->child_extrabed[$i];

                           $day=$day+1;
                           $s=$j;
                           $child_rate=0;      
                           $child_rate_det=json_decode($resultsarr_PPPN_stay_pay[$i][$j]->child_rate,true);
                           $childagerate=array();                 
                            if(!empty($child_rate_det[0]))
                            {                    
                              foreach ($child_rate_det as $key => $value)
                              { 
                                    $val=explode('||', $value);   
                                    $val1=explode('-', $val[0]);
                                    if($val1[0]>=$val1[1])
                                    {
                                        for($chr=$val1[1];$chr<=$val1[0];$chr++)
                                        {
                                            $childagerate[$chr]=$val[1];
                                        }
                                    }
                                    else
                                    {
                                       
                                        for($chr=$val1[0];$chr<=$val1[1];$chr++)
                                        {
                                            $childagerate[$chr]=$val[1];
                                        }
                                    }
                                }
                          }           
                        
                         if ($this->childs[$i] != 0)
                            {                         
                               $ages = explode(',', $this->childs_ages[$i]);   
                               for ($c = 0; $c < $this->childs[$i]; $c++)
                                {  
                                  
                                  $child_rate+=$childagerate[$ages[$c]];                
                                }
                            }
                        $tot=($this->adults[$i]*$resultsarr_PPPN_stay_pay[$i][$j]->adult_rate)+$child_rate+($this->adult_extrabed[$i]*$resultsarr_PPPN_stay_pay[$i][$j]->extra_bed_for_adults_rate)+($this->child_extrabed[$i]*$resultsarr_PPPN_stay_pay[$i][$j]->extra_bed_for_child_rate);

                         // Supplement
                          $supplementdatacheck=array(
                               'hotel_code'=>$rt_hotel_code,
                               'room_code'=>$rt_room_code,
                               'supplier_id'=>$rt_supplier_id,
                               'contract_id'=>$rt_contract_id,
                               'market'=>$rt_market,
                               'meal_plan'=>$rt_meal_plan,
                               'avail_date'=>$resultsarr_PPPN_stay_pay[$i][$j]->room_avail_date,
                               );
             $mandatory_supplements_check_arr=$this->Hotelcrs_Model->check_crs_hotels_normal_supplements_rates($supplementdatacheck,'Stay Pay','Yes');
                      foreach($mandatory_supplements_check_arr as $supplementarr)
                      {

                      list($mandatory_supplementarr,$mandatory_supp_cost,$mandatory_supplement_mealplan,$spec_offer_applicable_supplement)=$this->supplements_check($supplementarr,$i);
                        $crs_mandatory_supplement[]=$mandatory_supplementarr; 
                     
                         $mandatory_tot=$mandatory_supp_cost;


                        $mandatory_supplement_net_fare+=$mandatory_tot;
                        if($paynight>=$day&&$spec_offer_applicable_supplement=="Yes")
                          {                          
                             $mandatory_supplement_cost+=$mandatory_tot;                                                
                           }
                           else if($spec_offer_applicable_supplement!="Yes")
                           {
                              $mandatory_supplement_cost+=$mandatory_tot;
                           }
                              
                       
                       

                        $mandatory_suppmealplan=explode(',', $mandatory_supplement_mealplan);
                        foreach($mandatory_suppmealplan as $supp){
                        $mandatory_supplement_meal_plan[]=$supp;
                      }
                      }                  
                    $nonmandatory_supplements_check_arr=$this->Hotelcrs_Model->check_crs_hotels_normal_supplements_rates($supplementdatacheck,'Stay Pay','No');
                      foreach($nonmandatory_supplements_check_arr as $supplementarr)
                      {

                      list($nonmandatory_supplementarr,$nonmandatory_supp_cost,$nonmandatory_supplement_mealplan,$spec_offer_applicable_supplement)=$this->supplements_check($supplementarr,$i);
                        $crs_nonmandatory_supplement[]=$nonmandatory_supplementarr;

                      
                             $nonmandatory_tot=$nonmandatory_supp_cost;


                        $nonmandatory_supplement_net_fare+=$nonmandatory_tot;
                        if($paynight>=$day&&$spec_offer_applicable_supplement=="Yes")
                          {                          
                             $nonmandatory_supplement_cost+=$nonmandatory_tot;                                                
                           }
                           else if($spec_offer_applicable_supplement!="Yes")
                           {
                              $nonmandatory_supplement_cost+=$nonmandatory_tot;
                           }



                        $nonmandatory_suppmealplan=explode(',', $nonmandatory_supplement_mealplan);
                        foreach($nonmandatory_suppmealplan as $supp){
                        $nonmandatory_supplement_meal_plan[]=$supp;
                      }
                      }



                           // 

                        $net_fare+=$tot;
                        if($paynight>=$day)
                          {                          
                             $total_cost+=$tot;                                                
                           }
                                                
                       $hotel_room_allotment[]=$resultsarr_PPPN_stay_pay[$i][$j]->sup_hotel_room_allotment_id;
                       $crs_booking_code[]=$resultsarr_PPPN_stay_pay[$i][$j]->booking_code;
               
                        }
                       
                    }
                    if($day==$this->nights)
                    {                                  
                        $indexarr[$i][$index]=$index; 
                        $roommealarr[$i][$roommealtype]=$roommealtype;
                        $room_count_arr[$i]=$i;

                        $crs_booking_code=array_unique($crs_booking_code);
                        $crs_booking_code_str=implode(',', $crs_booking_code);
                        $resultsarr_PPPN_stay_pay[$i][$s]->hotel_crs_booking_code=$crs_booking_code_str;

                        $resultsarr_PPPN_stay_pay[$i][$s]->total_cost=$total_cost;
                       $resultsarr_PPPN_stay_pay[$i][$s]->net_fare=$net_fare;
                       $resultsarr_PPPN_stay_pay[$i][$s]->discount=($net_fare-$total_cost);

                      $resultsarr_PPPN_stay_pay[$i][$s]->crs_mandatory_supplement=json_encode($crs_mandatory_supplement);
                        $mandatory_supplement_meal_plan=array_unique($mandatory_supplement_meal_plan);
                      $resultsarr_PPPN_stay_pay[$i][$s]->mandatory_supplement_meal_plan=implode(',',$mandatory_supplement_meal_plan);
                       $resultsarr_PPPN_stay_pay[$i][$s]->mandatory_supplement_cost=$mandatory_supplement_cost;
                       $resultsarr_PPPN_stay_pay[$i][$s]->mandatory_supplement_net_fare=$mandatory_supplement_net_fare;

                       $resultsarr_PPPN_stay_pay[$i][$s]->mandatory_supplement_discount=($mandatory_supplement_net_fare-$mandatory_supplement_cost);

                      $resultsarr_PPPN_stay_pay[$i][$s]->crs_nonmandatory_supplement=json_encode($crs_nonmandatory_supplement);
                        $nonmandatory_supplement_meal_plan=array_unique($nonmandatory_supplement_meal_plan);
                      $resultsarr_PPPN_stay_pay[$i][$s]->nonmandatory_supplement_meal_plan=implode(',',$nonmandatory_supplement_meal_plan);
                       $resultsarr_PPPN_stay_pay[$i][$s]->nonmandatory_supplement_cost=$nonmandatory_supplement_cost;
                      $resultsarr_PPPN_stay_pay[$i][$s]->nonmandatory_supplement_net_fare=$nonmandatory_supplement_net_fare;
                      $resultsarr_PPPN_stay_pay[$i][$s]->nonmandatory_supplement_discount=($nonmandatory_supplement_net_fare-$nonmandatory_supplement_cost);

                      //   $resultsarr_PPPN_stay_pay[$i][$s]->total_cost=$total_cost;
                      //   $resultsarr_PPPN_stay_pay[$i][$s]->crs_mandatory_supplement=json_encode($crs_mandatory_supplement);
                      //    $mandatory_supplement_meal_plan=array_unique($mandatory_supplement_meal_plan);
                      // $resultsarr_PPPN_stay_pay[$i][$s]->mandatory_supplement_meal_plan=implode(',',$mandatory_supplement_meal_plan);
                      //  $resultsarr_PPPN_stay_pay[$i][$s]->mandatory_supplement_cost=$mandatory_supplement_cost;
                      //   $resultsarr_PPPN_stay_pay[$i][$s]->net_fare=$net_fare;
                      //   $resultsarr_PPPN_stay_pay[$i][$s]->discount=($net_fare-$total_cost);
                        $resultsarr_PPPN_stay_pay[$i][$s]->room_index=$i;
                        $resultsarr_PPPN_stay_pay[$i][$s]->index=$index;
                        $resultsarr_PPPN_stay_pay[$i][$s]->adult=$this->adults[$i];
                        $resultsarr_PPPN_stay_pay[$i][$s]->child=$this->childs[$i];
                         $resultsarr_PPPN_stay_pay[$i][$s]->adult_extrabed=$this->adult_extrabed[$i];
                        $resultsarr_PPPN_stay_pay[$i][$s]->child_extrabed=$this->child_extrabed[$i];
                        $resultsarr_PPPN_stay_pay[$i][$s]->nights=$this->nights; 
                        $resultsarr_PPPN_stay_pay[$i][$s]->childs_ages=$child_ages;
                        $resultsarr_PPPN_stay_pay[$i][$s]->type='STAYPAY';
                        $resultsarr_PPPN_stay_pay[$i][$s]->hotel_room_allotment=implode(',', $hotel_room_allotment);                     
                         $cancelpolicy_arr=array(
                            'supplier_id'=>$resultsarr_PPPN_stay_pay[$i][$s]->supplier_id,
                            'sup_hotel_id'=>$resultsarr_PPPN_stay_pay[$i][$s]->sup_hotel_id,   
                            'hotel_code'=>$resultsarr_PPPN_stay_pay[$i][$s]->hotel_code,   
                            'room_code'=>$resultsarr_PPPN_stay_pay[$i][$s]->room_code,   
                            'contract_id'=>$resultsarr_PPPN_stay_pay[$i][$s]->contract_id,   
                            'sup_room_details_id'=>$resultsarr_PPPN_stay_pay[$i][$s]->sup_room_details_id,   
                            'market'=>$resultsarr_PPPN_stay_pay[$i][$s]->market,   
                            'meal_plan'=>$resultsarr_PPPN_stay_pay[$i][$s]->meal_plan,
                            'specialoffer_id'=>$resultsarr_PPPN_stay_pay[$i][$s]->specialoffer_id,   
                            'specialoffer_type'=>$resultsarr_PPPN_stay_pay[$i][$s]->specialoffer_type,
                            'rate_type'=>$resultsarr_PPPN_stay_pay[$i][$s]->rate_type,
                            'min_room_occupancy'=>$resultsarr_PPPN_stay_pay[$i][$s]->min_room_occupancy,   
                            'max_room_occupancy'=>$resultsarr_PPPN_stay_pay[$i][$s]->max_room_occupancy,   
                            'min_adults_without_extra_bed'=>$resultsarr_PPPN_stay_pay[$i][$s]->min_adults_without_extra_bed,   
                            'max_adults_without_extra_bed'=>$resultsarr_PPPN_stay_pay[$i][$s]->max_adults_without_extra_bed,   
                            'min_child_without_extra_bed'=>$resultsarr_PPPN_stay_pay[$i][$s]->min_child_without_extra_bed,   
                            'max_child_without_extra_bed'=>$resultsarr_PPPN_stay_pay[$i][$s]->max_child_without_extra_bed,   
                            'extra_bed_for_adults'=>$resultsarr_PPPN_stay_pay[$i][$s]->extra_bed_for_adults,   
                            'extra_bed_for_child'=>$resultsarr_PPPN_stay_pay[$i][$s]->extra_bed_for_child,   
                          );
                $cancellation_policy=$this->Hotelcrs_Model->check_specialoffer_crs_hotels_normal_cancel_policy($cancelpolicy_arr,$checkIn);                                     

                    $cancel_policy='';
                    $hotel_crs_cancellation_json=array();
                    if(!empty($cancellation_policy[0]))
                    {
                      for($can=0,$incre=0;$can<count($cancellation_policy);$can++)
                      {
                        $last_date = $cancellation_policy[$can]->days_before_checkin; 
                        $today=date("Y-m-d");                    
                        if($last_date!=0)
                        {
                        $cancel_date = date('Y-m-d', strtotime('-' . $last_date . ' days ', strtotime($checkIn)));
                        }
                        else
                        {
                         $cancel_date = $checkIn; 
                        }


                        if($can==0 ||($can>=1&&$cancellation_policy[$can]->days_before_checkin!=$cancellation_policy[($can-1)]->days_before_checkin))
                       {                              
                         if($cancellation_policy[$can]->cancel_rates_type=='non_refundable')
                         {
                           $cancel_policy ='<p>Non Refundable</p>';
                           $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;                        
                         }

                        if(strtotime($today)<=strtotime($cancel_date))
                        {     
                        if($cancellation_policy[$can]->cancel_rates_type=='fixed'){
                          $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . ' '.$resultsarr_PPPN_stay_pay[$i][$s]->currency_type.' will charged. If cancelled on ' . $cancel_date . ' </p>';
                        $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }
                        if($cancellation_policy[$can]->cancel_rates_type=='percentage')
                        {
                          $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . '% will charged. If cancelled on ' . $cancel_date . ' </p>';
                        $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }
                      
                       if($cancellation_policy[$can]->cancel_rates_type=='fullstay')
                         {
                          $cancel_policy_str='Full Stay Charge';

                           $cancel_policy .= '<p>Full Stay Charge. If cancelled on ' . $cancel_date . ' </p>';
                       $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        } 
                     }
                     }
                                     
                    
                    }
                  }
                  $resultsarr_PPPN_stay_pay[$i][$s]->cancel_policy=$cancel_policy;
                  $resultsarr_PPPN_stay_pay[$i][$s]->hotel_crs_cancellation_json=json_encode($hotel_crs_cancellation_json);  
                   $results[$index]=$resultsarr_PPPN_stay_pay[$i][$s];
                   // echo "<pre>dcd"; print_r($resultsarr_PPPN_stay_pay); exit;
                  } 
                }
               
             }
          
        
       }
   }
   }            
  
  //echo "<pre>"; print_r($results);exit;
     $insertrooms=array();
     $ro=0;
     foreach ($results as $result)
     {
      // $checkroom=$this->Hotelcrs_Model->check_hotel_room_search($this->api,$this->sess_id,$result->hotel_code,$result->room_code,$result->room_index);
      // if(empty($checkroom))
      // {
       $room_details_info=array(
           'supplier_id'=>$result->supplier_id,
           'sup_hotel_id'=>$result->sup_hotel_id,   
           'hotel_code'=>$result->hotel_code,   
           'room_code'=>$result->room_code,   
           'contract_id'=>$result->contract_id,   
           'sup_room_details_id'=>$result->sup_room_details_id,   
           'market'=>$result->market,   
           'meal_plan'=>$result->meal_plan,   
           'rate_type'=>$result->rate_type,
           'specialoffer_id'=>$result->specialoffer_id,   
           'specialoffer_type'=>$result->specialoffer_type,
           'min_room_occupancy'=>$result->min_room_occupancy,   
           'max_room_occupancy'=>$result->max_room_occupancy,   
           'min_adults_without_extra_bed'=>$result->min_adults_without_extra_bed,   
           'max_adults_without_extra_bed'=>$result->max_adults_without_extra_bed,   
           'min_child_without_extra_bed'=>$result->min_child_without_extra_bed,   
           'max_child_without_extra_bed'=>$result->max_child_without_extra_bed,   
           'extra_bed_for_adults'=>$result->extra_bed_for_adults,   
           'extra_bed_for_child'=>$result->extra_bed_for_child,   
           'min_no_of_stay_day'=>$result->min_no_of_stay_day, 
           'max_no_of_stay_day'=>$result->max_no_of_stay_day,
           'no_of_stay_free_nights'=>$result->no_of_stay_free_nights, 
           'prior_day_type'=>$result->prior_day_type,
           'prior_checkin'=>$result->prior_checkin,
           'prior_checkin_date'=>$result->prior_checkin_date,
           'period_from_date'=>$result->period_from_date,
           'period_to_date'=>$result->period_to_date,                   
         );

       $this->load->module('hotels/hotel_markup');
        $markup_array = $this->hotel_markup->markup_calculation($this->city_code,$result->net_fare, $this->nationality, $this->api);
        // echo'<pre/>';print_r($markup_array);exit;

        $insertrooms[$ro] =array(
                'session_id' => $this->sess_id,
                'uniqueRefNo' => $this->Sys_RefNo,
                'hotel_supplier_id'=>$result->supplier_id,
                'api' => $this->api,
                'city_code' => $this->city_code,
                'city_name' => $this->city_name,
                'hotel_code' => $result->hotel_code,
                'conversation_id'=>$result->type,
                'rate_plan_code'=>$result->rate_type,
                'rate_basis_id'=>$result->sup_hotel_room_rates_list_id,
                'rate_basis_desc'=>$result->index,
                'unique_cityid' => $this->city_code,
                'hotel_name' => $result->hotel_name,
                'room_name' => $result->room_name,
                'room_code' => $result->room_code,
                'room_description'=>$result->room_desc,
                'hotel_property_id'=>$result->hotel_room_allotment,
                'contractnameVal'=>$result->contract_id,
                'hbzoneName'=>$result->market,
                'room_details_info'=>json_encode($room_details_info),
                'room_type' => $result->room_type,
                'description' => $result->hotel_desc,
                'child_age' => $result->childs_ages,
                'board_type'=>$result->meal_plan,
                'adult' => $result->adult,
                'child' => $result->child,
                'adult_extrabed' => $result->adult_extrabed,
                'child_extrabed' => $result->child_extrabed,
                'room_count' => $this->rooms,
                'room_runno'=>$result->room_index,
                'nights'=>$result->nights,
                'image' => $result->thumb_img,
                'hotel_address' => $result->address,
                'amennes' => $result->hotel_facilities,
                'room_amenities' => $result->room_facilities,
                'cancel_policy'=>$result->cancel_policy,
                'star' => $result->hotel_star_rating,
                'xml_currency' => $result->currency_type,
                'currency' => $result->currency_type,


                'crs_mandatory_supplement'=>$result->crs_mandatory_supplement,
                'mandatory_supplement_cost'=>$result->mandatory_supplement_cost,
                'mandatory_supplement_meal_plan'=>$result->mandatory_supplement_meal_plan,
                'mandatory_supplement_net_fare'=>$result->mandatory_supplement_net_fare,
                'mandatory_supplement_discount'=>$result->mandatory_supplement_discount,
                'crs_nonmandatory_supplement'=>$result->crs_nonmandatory_supplement,
                'nonmandatory_supplement_cost'=>$result->nonmandatory_supplement_cost,
                'nonmandatory_supplement_meal_plan'=>$result->nonmandatory_supplement_meal_plan,
                'nonmandatory_supplement_net_fare'=>$result->nonmandatory_supplement_net_fare,
                'nonmandatory_supplement_discount'=>$result->nonmandatory_supplement_discount,
                'currency_conv_value' => $markup_array['total_cost']+$result->mandatory_supplement_cost,
                // 'total_cost' =>$result->total_cost+$result->mandatory_supplement_cost,
                'total_cost' => $markup_array['total_cost']+$result->mandatory_supplement_cost,
                'admin_markup' => $markup_array['admin_markup'],
                'agent_markup' => $markup_array['agent_markup'],
                'payment_charge' => $markup_array['payment_charge'],
                'net_fare'=>$result->net_fare+$result->mandatory_supplement_net_fare,
                'discount'=>$result->discount+$result->mandatory_supplement_discount,
                'org_amt' => $result->net_fare+$result->mandatory_supplement_net_fare,
                'ROE' => 1,
                'hotel_crs_cancellation_json'=>$result->hotel_crs_cancellation_json,
                'hotel_crs_booking_code'=>$result->hotel_crs_booking_code,
              );

             // echo '<pre>1';print_r($insertrooms[$ro]);
                $ro++;
            // }

            


     }

        if (!empty($insertrooms) && count($room_count_arr)==$this->rooms) 
        {
          $this->Hotelcrs_Model->insert_crs_data($insertrooms);
         
        } 
        // exit;

  }

function extracthotel_early_bird($checkIn,$checkOut)
  {
     if(!empty($this->crshotelcode)){
        $hotelcodes=$this->crshotelcode;
     }
     else{
     $hotelcodes=$this->Hotelcrs_Model->gethotelcodes($this->city_code,0,500);
      } 

      // if(empty($hotelcodess)){
      //   return '';
      // }
     $hotelcodess=array();

     foreach($hotelcodes as $hot)
     {
        $hotelcodess[]=$hot->hotel_code;
     }
     $roomcodes=$this->Hotelcrs_Model->getroomcodes($hotelcodess,0,2000);
     $rmhotelcodes=array();
     $rmcodes=array();
     foreach($roomcodes as $rm)
     {
        $rmhotelcodes[]=$rm->hotel_code;
        $rmcodes[]=$rm->room_code;
     }
     $htcode=array_unique($rmhotelcodes);
     $to_date=strtotime($checkOut);
     $from_date=strtotime($checkIn); 
     $days=floor(($to_date - $from_date) / (60 * 60 * 24));
     $resultsarr_PRPN_early_bird=array(); 
     $resultsarr_PPPN_early_bird=array(); 
     $results=array();
     $room_count_arr=array();       
     $rmhotelcodess=implode(',', $rmhotelcodes); 
     $rmcodess=implode(',', $rmcodes); 
     for ($i = 0; $i < $this->rooms; $i++)
     { 
          $res_PRPN_early_bird=array(); 
          $res_PPPN_early_bird=array();          
          $res_PRPN_early_bird = $this->Hotelcrs_Model->get_crs_hotels_PRPN_early_bird($rmhotelcodess,$rmcodess,$this->city_code, $checkIn, $checkOut, $this->adults[$i], $this->childs[$i], $this->adult_extrabed[$i], $this->child_extrabed[$i],$this->rooms,$this->market_name);

          if(empty($res_PRPN_early_bird))
          {
            $res_PRPN_early_bird = $this->Hotelcrs_Model->get_crs_hotels_PRPN_early_bird($rmhotelcodess,$rmcodess,$this->city_code, $checkIn, $checkOut, $this->adults[$i], $this->childs[$i], $this->adult_extrabed[$i], $this->child_extrabed[$i],$this->rooms,'All Markets');
          }
          

          $res_PPPN_early_bird = $this->Hotelcrs_Model->get_crs_hotels_PPPN_early_bird($rmhotelcodess,$rmcodess,$this->city_code, $checkIn, $checkOut, $this->adults[$i], $this->childs[$i], $this->adult_extrabed[$i], $this->child_extrabed[$i],$this->rooms,$this->market_name);
         
         if(empty($res_PPPN_early_bird))
         {
            $res_PPPN_early_bird = $this->Hotelcrs_Model->get_crs_hotels_PPPN_early_bird($rmhotelcodess,$rmcodess,$this->city_code, $checkIn, $checkOut, $this->adults[$i], $this->childs[$i], $this->adult_extrabed[$i], $this->child_extrabed[$i],$this->rooms,'All Markets');
         }

          if(!empty($res_PRPN_early_bird))
           {
             $resultsarr_PRPN_early_bird[$i]=$res_PRPN_early_bird;
           }             
          if(!empty($res_PPPN_early_bird))
           {
             $resultsarr_PPPN_early_bird[$i]=$res_PPPN_early_bird;
           }
    }
    // echo "<pre>"; print_r($resultsarr_PRPN_early_bird);  exit;
    // echo $this->db->last_query();exit;

    for ($i = 0; $i < $this->rooms; $i++)
    {
        $index='';
        $indexarr=array();
        $roommealarr=array();
        $childsagearr=array(); 
        $child_ages = '';  
        if ($this->childs[$i] != 0)
        {  
           $child_ages=$this->childs_ages[$i];
           $ages = explode(',', $this->childs_ages[$i]);   
           for ($c = 0; $c < $this->childs[$i]; $c++)
            {  
              $childsagearr[]=$ages[$c];                  
            }
        } 
        $childsagestr='';
        if(!empty($childsagearr))
        {
           $childsagestr=implode("|", $childsagearr);
           $childsagestr="|".$childsagestr;
        }

       
           if(isset($resultsarr_PRPN_early_bird[$i]))
           {
              $arr=json_decode(json_encode($resultsarr_PRPN_early_bird[$i]),TRUE);
              $room_code_arr=(array_unique(($this->array_column($arr, 'room_code')))); 
              $meal_plan_arr=(array_unique(($this->array_column($arr, 'meal_plan'))));
              $prior_checkin_arr=(array_unique(($this->array_column($arr, 'prior_checkin'))));
              rsort($prior_checkin_arr);              
              $prior_checkin_date_arr=(array_unique($this->array_column($arr, 'prior_checkin_date')));
               rsort($prior_checkin_date_arr);              
               $period_from_date_arr=(array_unique($this->array_column($arr, 'period_from_date'))); 
               rsort($period_from_date_arr);              
               $prior_checkin_cnt=count($prior_checkin_arr);
                $prior_checkin_date_cnt=count($prior_checkin_date_arr);
                $period_from_date_cnt=count($period_from_date_arr);
                $prior_cnt=0;
                if(isset($prior_checkin_arr)&&($prior_checkin_cnt>=$prior_checkin_date_cnt)&&($prior_checkin_cnt>=$period_from_date_cnt))
                  {
                    $prior_cnt=$prior_checkin_cnt;
                  }
                else if(isset($prior_checkin_date_arr)&&($prior_checkin_date_cnt>=$prior_checkin_cnt)&&($prior_checkin_date_cnt>=$period_from_date_cnt))
                  {
                    $prior_cnt=$prior_checkin_date_cnt;
                  }
                else if(isset($period_from_date_arr)&&($period_from_date_cnt>=$prior_checkin_date_cnt)&&($period_from_date_cnt>=$prior_checkin_cnt))
                  {
                    $prior_cnt=$period_from_date_cnt;
                  }                
           
            for($pr=0;$pr<$prior_cnt;$pr++)           
             {   
             
              for($l=0;$l<count($resultsarr_PRPN_early_bird[$i]);$l++)
              {
               /* if(strtotime($checkIn)==strtotime($resultsarr_PRPN_early_bird[$i][$l]->room_avail_date))   */
                  if((strtotime($checkIn)==strtotime($resultsarr_PRPN_early_bird[$i][$l]->room_avail_date))&&(((isset($prior_checkin_arr[$pr])&&($prior_checkin_arr[$pr]!='')&&($prior_checkin_arr[$pr]==$resultsarr_PRPN_early_bird[$i][$l]->prior_checkin)))||(((isset($prior_checkin_date_arr[$pr])&&($prior_checkin_date_arr[$pr]!='0000-00-00')&&$prior_checkin_date_arr[$pr]==$resultsarr_PRPN_early_bird[$i][$l]->prior_checkin_date)))||(((isset($period_from_date_arr[$pr])&&($period_from_date_arr[$pr]!='0000-00-00')&&$period_from_date_arr[$pr]==$resultsarr_PRPN_early_bird[$i][$l]->period_from_date)))))
                  {
                    $day=0;
                    $flag=true;
                    $total_cost=0;
                    $mandatory_supplement_cost=0;
                    $crs_mandatory_supplement=array(); 
                    $mandatory_supplement_meal_plan=array(); 
                    $nonmandatory_supplement_cost=0;
                    $crs_nonmandatory_supplement=array();
                    $nonmandatory_supplement_meal_plan=array();
                    $crs_booking_code=array();  
                    $net_fare=0;
                    $discount=0;
                    $mandatory_supplement_net_fare=0;
                    $nonmandatory_supplement_net_fare=0; 
                    $mandatory_discount=0; 
                    $nonmandatory_discount=0;                    
                    $hotel_room_allotment=array();        
                    $rt_hotel_code=$resultsarr_PRPN_early_bird[$i][$l]->hotel_code;
                    $rt_room_code=$resultsarr_PRPN_early_bird[$i][$l]->room_code;
                    $min_adults=$resultsarr_PRPN_early_bird[$i][$l]->min_adults_without_extra_bed;
                    $max_adults=$resultsarr_PRPN_early_bird[$i][$l]->max_adults_without_extra_bed;
                    $min_child=$resultsarr_PRPN_early_bird[$i][$l]->min_child_without_extra_bed;
                    $max_child=$resultsarr_PRPN_early_bird[$i][$l]->max_child_without_extra_bed;
                    $adults_bed=$resultsarr_PRPN_early_bird[$i][$l]->extra_bed_for_adults;
                    $child_bed=$resultsarr_PRPN_early_bird[$i][$l]->extra_bed_for_child;
                    $rt_contract_id=$resultsarr_PRPN_early_bird[$i][$l]->contract_id;
                    $rt_market=$resultsarr_PRPN_early_bird[$i][$l]->market;
                    $rt_exclude_market=explode('||',$resultsarr_PRPN_early_bird[$i][$l]->exclude_market);
                    $rt_meal_plan=$resultsarr_PRPN_early_bird[$i][$l]->meal_plan;
                    $rt_supplier_id=$resultsarr_PRPN_early_bird[$i][$l]->supplier_id;

                  $rt_specialoffer_id=$resultsarr_PRPN_early_bird[$i][$l]->specialoffer_id;
                  $rt_specialoffer_type=$resultsarr_PRPN_early_bird[$i][$l]->specialoffer_type;
                  $rt_discount_rate_type=$resultsarr_PRPN_early_bird[$i][$l]->discount_rate_type;
                  $rt_prior_day_type=$resultsarr_PRPN_early_bird[$i][$l]->prior_day_type;
                  $rt_prior_checkin=$resultsarr_PRPN_early_bird[$i][$l]->prior_checkin;
                  $rt_prior_checkin_date=$resultsarr_PRPN_early_bird[$i][$l]->prior_checkin_date;
                  $rt_period_from_date=$resultsarr_PRPN_early_bird[$i][$l]->period_from_date;
                  $rt_period_to_date=$resultsarr_PRPN_early_bird[$i][$l]->period_to_date;

                $index1='EARLYBIRD_PRPN'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_contract_id.'|'.$rt_market.'|'.$rt_meal_plan.'|'.$rt_specialoffer_id.'|'.$rt_specialoffer_type.'|'.$rt_discount_rate_type.'|'.$rt_prior_day_type.'|'.$rt_prior_checkin.'|'.$rt_prior_checkin_date.'|'.$rt_period_from_date.'|'.$rt_period_to_date.'|'.($i+1).'|'.$min_adults.'|'.$max_adults.'|'.$min_child.'|'.$max_child.'|'.$adults_bed.'|'.$child_bed.'|'.$this->adults[$i].'|'.$this->childs[$i].'|'.$this->adult_extrabed[$i].'|'.$this->child_extrabed[$i];
                  $roommealtype1='EARLYBIRD_PRPN'.'|'.($i+1).'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_meal_plan;   

                    if(in_array($this->market_name, $rt_exclude_market))
                    {
                      continue;
                    }
                    if(!empty($roommealarr[$i][$roommealtype1]))
                    {
                        continue;
                    }


                    if(!empty($indexarr[$i][$index1]))
                    {
                        continue;
                    }
                    for($j=0,$s=0;$j<count($resultsarr_PRPN_early_bird[$i])&&!empty($resultsarr_PRPN_early_bird[$i]);$j++)
                     {
                      if($rt_hotel_code==$resultsarr_PRPN_early_bird[$i][$j]->hotel_code&&
                        $rt_room_code==$resultsarr_PRPN_early_bird[$i][$j]->room_code&&
                        $rt_supplier_id==$resultsarr_PRPN_early_bird[$i][$j]->supplier_id&&
                        $rt_contract_id==$resultsarr_PRPN_early_bird[$i][$j]->contract_id&&
                        $rt_market==$resultsarr_PRPN_early_bird[$i][$j]->market&&
                        $rt_meal_plan==$resultsarr_PRPN_early_bird[$i][$j]->meal_plan&&
                        $min_adults==$resultsarr_PRPN_early_bird[$i][$j]->min_adults_without_extra_bed&&
                        $max_adults==$resultsarr_PRPN_early_bird[$i][$j]->max_adults_without_extra_bed&&
                        $min_child==$resultsarr_PRPN_early_bird[$i][$j]->min_child_without_extra_bed&&
                        $max_child==$resultsarr_PRPN_early_bird[$i][$j]->max_child_without_extra_bed&&
                        $adults_bed==$resultsarr_PRPN_early_bird[$i][$j]->extra_bed_for_adults&&
                        $child_bed==$resultsarr_PRPN_early_bird[$i][$j]->extra_bed_for_child&&
                        $rt_specialoffer_id==$resultsarr_PRPN_early_bird[$i][$j]->specialoffer_id&&
                        $rt_specialoffer_type==$resultsarr_PRPN_early_bird[$i][$j]->specialoffer_type&&
                        $rt_discount_rate_type==$resultsarr_PRPN_early_bird[$i][$j]->discount_rate_type&&
                        $rt_prior_day_type==$resultsarr_PRPN_early_bird[$i][$j]->prior_day_type&&
                        $rt_prior_checkin==$resultsarr_PRPN_early_bird[$i][$j]->prior_checkin&&
                        $rt_prior_checkin_date==$resultsarr_PRPN_early_bird[$i][$j]->prior_checkin_date&&
                         $rt_period_from_date==$resultsarr_PRPN_early_bird[$i][$j]->period_from_date&&
                        $rt_period_to_date==$resultsarr_PRPN_early_bird[$i][$j]->period_to_date )
                        {
                          $index='EARLYBIRD_PRPN'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_contract_id.'|'.$rt_market.'|'.$rt_meal_plan.'|'.$rt_specialoffer_id.'|'.$rt_specialoffer_type.'|'.$rt_discount_rate_type.'|'.$rt_prior_day_type.'|'.$rt_prior_checkin.'|'.$rt_prior_checkin_date.'|'.$rt_period_from_date.'|'.$rt_period_to_date.'|'.($i+1).'|'.$min_adults.'|'.$max_adults.'|'.$min_child.'|'.$max_child.'|'.$adults_bed.'|'.$child_bed.'|'.$this->adults[$i].'|'.$this->childs[$i].'|'.$this->adult_extrabed[$i].'|'.$this->child_extrabed[$i];
                            $roommealtype='EARLYBIRD_PRPN'.'|'.($i+1).'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_meal_plan; 
                            $day=$day+1;
                            $s=$j;
                          $tot=$resultsarr_PRPN_early_bird[$i][$j]->room_rate+($this->adult_extrabed[$i]*$resultsarr_PRPN_early_bird[$i][$j]->extra_bed_for_adults_rate)+($this->child_extrabed[$i]*$resultsarr_PRPN_early_bird[$i][$j]->extra_bed_for_child_rate);

                       // Supplement
                          $supplementdatacheck=array(
                               'hotel_code'=>$rt_hotel_code,
                               'room_code'=>$rt_room_code,
                               'supplier_id'=>$rt_supplier_id,
                               'contract_id'=>$rt_contract_id,
                               'market'=>$rt_market,
                               'meal_plan'=>$rt_meal_plan,
                               'avail_date'=>$resultsarr_PRPN_early_bird[$i][$j]->room_avail_date,
                               );

                    $mandatory_supplements_check_arr=$this->Hotelcrs_Model->check_crs_hotels_normal_supplements_rates($supplementdatacheck,'Early bird','Yes');                      
                      foreach($mandatory_supplements_check_arr as $supplementarr)
                      {

                      list($mandatory_supplementarr,$mandatory_supp_cost,$mandatory_supplement_mealplan,$spec_offer_applicable_supplement)=$this->supplements_check($supplementarr,$i);
                        $crs_mandatory_supplement[]=$mandatory_supplementarr; 
                         $mandatory_tot=$mandatory_supp_cost;

                           $mandatory_supplement_net_fare+=$mandatory_tot;
                            if($spec_offer_applicable_supplement=="Yes")
                            {
                               $mandatory_dis=($mandatory_tot*($resultsarr_PRPN_early_bird[$i][$j]->discount_percentage/100));
                                $mandatory_discount+=$mandatory_dis;
                                 $mandatory_tot=($mandatory_tot-$mandatory_dis);
                              
                            }                         
                         
                             $mandatory_supplement_cost+=$mandatory_tot;              

                       $mandatory_suppmealplan=explode(',', $mandatory_supplement_mealplan);
                        foreach($mandatory_suppmealplan as $supp){
                        $mandatory_supplement_meal_plan[]=$supp;
                      }
                      }


                      $nonmandatory_supplements_check_arr=$this->Hotelcrs_Model->check_crs_hotels_normal_supplements_rates($supplementdatacheck,'Early bird','No');
                      $nonmandatory_tot=0;
                      foreach($nonmandatory_supplements_check_arr as $supplementarr)
                      {

                      list($nonmandatory_supplementarr,$nonmandatory_supp_cost,$nonmandatory_supplement_mealplan,$spec_offer_applicable_supplement)=$this->supplements_check($supplementarr,$i);
                        $crs_nonmandatory_supplement[]=$nonmandatory_supplementarr;

                        $nonmandatory_tot+=$nonmandatory_supp_cost;


                        $nonmandatory_tot=$nonmandatory_supp_cost;

                            $nonmandatory_supplement_net_fare+=$nonmandatory_tot;
                            if($spec_offer_applicable_supplement=="Yes")
                            {
                               $nonmandatory_dis=($nonmandatory_tot*($resultsarr_PRPN_early_bird[$i][$j]->discount_percentage/100));
                                $nonmandatory_discount+=$nonmandatory_dis;
                                 $nonmandatory_tot=($nonmandatory_tot-$nonmandatory_dis);
                              
                            }
                         
                             $nonmandatory_supplement_cost+=$nonmandatory_tot;                        
                         
                             $mandatory_supplement_cost+=$mandatory_tot; 


                    
                        $nonmandatory_suppmealplan=explode(',', $nonmandatory_supplement_mealplan);
                        foreach($nonmandatory_suppmealplan as $supp){
                        $nonmandatory_supplement_meal_plan[]=$supp;
                      }
                      }

                        $net_fare+=$tot;
                        $discount_amount=($tot*($resultsarr_PRPN_early_bird[$i][$j]->discount_percentage/100));
                        $discount+=$discount_amount;  
                        $tot=($tot-$discount_amount);
                        $total_cost+=$tot; 

                        $hotel_room_allotment[]=$resultsarr_PRPN_early_bird[$i][$j]->sup_hotel_room_allotment_id;
                      $crs_booking_code[]=$resultsarr_PRPN_early_bird[$i][$j]->booking_code;
                        }
                     }

                    if($day==$this->nights)
                    {                
                        $indexarr[$i][$index]=$index;
                        $roommealarr[$i][$roommealtype]=$roommealtype;
                        $room_count_arr[$i]=$i;

                        $crs_booking_code=array_unique($crs_booking_code);
                        $crs_booking_code_str=implode(',', $crs_booking_code);
                        $resultsarr_PRPN_early_bird[$i][$s]->hotel_crs_booking_code=$crs_booking_code_str;


                        $resultsarr_PRPN_early_bird[$i][$s]->total_cost=$total_cost;
                       $resultsarr_PRPN_early_bird[$i][$s]->net_fare=$net_fare;
                       $resultsarr_PRPN_early_bird[$i][$s]->discount=$discount;

                      $resultsarr_PRPN_early_bird[$i][$s]->crs_mandatory_supplement=json_encode($crs_mandatory_supplement);
                        $mandatory_supplement_meal_plan=array_unique($mandatory_supplement_meal_plan);
                      $resultsarr_PRPN_early_bird[$i][$s]->mandatory_supplement_meal_plan=implode(',',$mandatory_supplement_meal_plan);
                       $resultsarr_PRPN_early_bird[$i][$s]->mandatory_supplement_cost=$mandatory_supplement_cost;
                       $resultsarr_PRPN_early_bird[$i][$s]->mandatory_supplement_net_fare=$mandatory_supplement_net_fare;

                       $resultsarr_PRPN_early_bird[$i][$s]->mandatory_supplement_discount=$mandatory_discount;

                      $resultsarr_PRPN_early_bird[$i][$s]->crs_nonmandatory_supplement=json_encode($crs_nonmandatory_supplement);
                        $nonmandatory_supplement_meal_plan=array_unique($nonmandatory_supplement_meal_plan);
                      $resultsarr_PRPN_early_bird[$i][$s]->nonmandatory_supplement_meal_plan=implode(',',$nonmandatory_supplement_meal_plan);
                       $resultsarr_PRPN_early_bird[$i][$s]->nonmandatory_supplement_cost=$nonmandatory_supplement_cost;
                      $resultsarr_PRPN_early_bird[$i][$s]->nonmandatory_supplement_net_fare=$nonmandatory_supplement_net_fare;
                      $resultsarr_PRPN_early_bird[$i][$s]->nonmandatory_supplement_discount=$nonmandatory_discount;
                        $resultsarr_PRPN_early_bird[$i][$s]->room_index=$i;
                        $resultsarr_PRPN_early_bird[$i][$s]->index=$index;
                        $resultsarr_PRPN_early_bird[$i][$s]->adult=$this->adults[$i];
                        $resultsarr_PRPN_early_bird[$i][$s]->child=$this->childs[$i];
                        $resultsarr_PRPN_early_bird[$i][$s]->adult_extrabed=$this->adult_extrabed[$i];
                        $resultsarr_PRPN_early_bird[$i][$s]->child_extrabed=$this->child_extrabed[$i];
                        $resultsarr_PRPN_early_bird[$i][$s]->nights=$this->nights; 
                        $resultsarr_PRPN_early_bird[$i][$s]->childs_ages=$child_ages;
                        $resultsarr_PRPN_early_bird[$i][$s]->type='EARLYBIRD';
                        $resultsarr_PRPN_early_bird[$i][$s]->hotel_room_allotment=implode(',', $hotel_room_allotment);                       
                        $cancelpolicy_arr=array(
                            'supplier_id'=>$resultsarr_PRPN_early_bird[$i][$s]->supplier_id,
                            'sup_hotel_id'=>$resultsarr_PRPN_early_bird[$i][$s]->sup_hotel_id,   
                            'hotel_code'=>$resultsarr_PRPN_early_bird[$i][$s]->hotel_code,   
                            'room_code'=>$resultsarr_PRPN_early_bird[$i][$s]->room_code,   
                            'contract_id'=>$resultsarr_PRPN_early_bird[$i][$s]->contract_id,   
                            'sup_room_details_id'=>$resultsarr_PRPN_early_bird[$i][$s]->sup_room_details_id,   
                            'market'=>$resultsarr_PRPN_early_bird[$i][$s]->market,   
                            'meal_plan'=>$resultsarr_PRPN_early_bird[$i][$s]->meal_plan,
                             'specialoffer_id'=>$resultsarr_PRPN_early_bird[$i][$s]->specialoffer_id,   
                            'specialoffer_type'=>$resultsarr_PRPN_early_bird[$i][$s]->specialoffer_type,
                            'rate_type'=>$resultsarr_PRPN_early_bird[$i][$s]->rate_type,
                            'min_room_occupancy'=>$resultsarr_PRPN_early_bird[$i][$s]->min_room_occupancy,   
                            'max_room_occupancy'=>$resultsarr_PRPN_early_bird[$i][$s]->max_room_occupancy,   
                            'min_adults_without_extra_bed'=>$resultsarr_PRPN_early_bird[$i][$s]->min_adults_without_extra_bed,   
                            'max_adults_without_extra_bed'=>$resultsarr_PRPN_early_bird[$i][$s]->max_adults_without_extra_bed,   
                            'min_child_without_extra_bed'=>$resultsarr_PRPN_early_bird[$i][$s]->min_child_without_extra_bed,   
                            'max_child_without_extra_bed'=>$resultsarr_PRPN_early_bird[$i][$s]->max_child_without_extra_bed,   
                            'extra_bed_for_adults'=>$resultsarr_PRPN_early_bird[$i][$s]->extra_bed_for_adults,   
                            'extra_bed_for_child'=>$resultsarr_PRPN_early_bird[$i][$s]->extra_bed_for_child,   
                          );
                   $cancellation_policy=$this->Hotelcrs_Model->check_specialoffer_crs_hotels_normal_cancel_policy($cancelpolicy_arr,$checkIn);                                     

                    $cancel_policy='';
                    $hotel_crs_cancellation_json=array();
                    if(!empty($cancellation_policy[0]))
                    {
                      for($can=0,$incre=0;$can<count($cancellation_policy);$can++)
                      {
                        $last_date = $cancellation_policy[$can]->days_before_checkin;                     
                        if($last_date!=0)
                        {
                        $cancel_date = date('Y-m-d', strtotime('-' . $last_date . ' days ', strtotime($checkIn)));
                        }
                        else
                        {
                         $cancel_date = $checkIn; 
                        }
                        if($can==0 ||($can>=1&&$cancellation_policy[$can]->days_before_checkin!=$cancellation_policy[($can-1)]->days_before_checkin))
                       {                            
                         if($cancellation_policy[$can]->cancel_rates_type=='non_refundable')
                         {
                           $cancel_policy ='<p>Non Refundable</p>';
                         $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;                        
                         }
                         if($cancellation_policy[$can]->cancel_rates_type=='fullstay')
                         {
                          $cancel_policy_str='Full Stay Charge';

                           $cancel_policy .= '<p>Full Stay Charge. If cancelled on ' . $cancel_date . ' </p>';
                       $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }        
                        if($cancellation_policy[$can]->cancel_rates_type=='fixed'){
                          $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . ' '.$resultsarr_PRPN_early_bird[$i][$s]->currency_type.' will charged. If cancelled on ' . $cancel_date . ' </p>';
                        $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }
                        if($cancellation_policy[$can]->cancel_rates_type=='percentage')
                        {
                          $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . '% will charged. If cancelled on ' . $cancel_date . ' </p>';
                        $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }
                     }                   
                    
                    }
                  }
                  $resultsarr_PRPN_early_bird[$i][$s]->cancel_policy=$cancel_policy;
                  $resultsarr_PRPN_early_bird[$i][$s]->hotel_crs_cancellation_json=json_encode($hotel_crs_cancellation_json);  
                   $results[$index]=$resultsarr_PRPN_early_bird[$i][$s];
                
                  } 
                 }
                
               }
             
               }
             }
             
           if(isset($resultsarr_PPPN_early_bird[$i]))
           {
                $arr=json_decode(json_encode($resultsarr_PPPN_early_bird[$i]),TRUE);
                $prior_checkin_arr=(array_unique(($this->array_column($arr, 'prior_checkin'))));
                rsort($prior_checkin_arr);              
                $prior_checkin_date_arr=(array_unique($this->array_column($arr, 'prior_checkin_date')));
                 rsort($prior_checkin_date_arr);              
                $period_from_date_arr=(array_unique($this->array_column($arr, 'period_from_date'))); 
                 rsort($period_from_date_arr);              
                $prior_checkin_cnt=count($prior_checkin_arr);
                $prior_checkin_date_cnt=count($prior_checkin_date_arr);
                $period_from_date_cnt=count($period_from_date_arr);
                $prior_cnt=0;
                if(isset($prior_checkin_arr)&&($prior_checkin_cnt>=$prior_checkin_date_cnt)&&($prior_checkin_cnt>=$period_from_date_cnt))
                  {
                    $prior_cnt=$prior_checkin_cnt;
                  }
                else if(isset($prior_checkin_date_arr)&&($prior_checkin_date_cnt>=$prior_checkin_cnt)&&($prior_checkin_date_cnt>=$period_from_date_cnt))
                  {
                    $prior_cnt=$prior_checkin_date_cnt;
                  }
                else if(isset($period_from_date_arr)&&($period_from_date_cnt>=$prior_checkin_date_cnt)&&($period_from_date_cnt>=$prior_checkin_cnt))
                  {
                    $prior_cnt=$period_from_date_cnt;
                  }                
                 
            for($pr=0;$pr<$prior_cnt;$pr++)           
             {                              
              for($l=0;$l<count($resultsarr_PPPN_early_bird[$i]);$l++)
              {
               /* if(strtotime($checkIn)==strtotime($resultsarr_PPPN_early_bird[$i][$l]->room_avail_date)) */

                   if((strtotime($checkIn)==strtotime($resultsarr_PPPN_early_bird[$i][$l]->room_avail_date))&&(((isset($prior_checkin_arr[$pr])&&($prior_checkin_arr[$pr]!='')&&($prior_checkin_arr[$pr]==$resultsarr_PPPN_early_bird[$i][$l]->prior_checkin)))||(((isset($prior_checkin_date_arr[$pr])&&($prior_checkin_date_arr[$pr]!='0000-00-00')&&$prior_checkin_date_arr[$pr]==$resultsarr_PPPN_early_bird[$i][$l]->prior_checkin_date)))||(((isset($period_from_date_arr[$pr])&&($period_from_date_arr[$pr]!='0000-00-00')&&$period_from_date_arr[$pr]==$resultsarr_PPPN_early_bird[$i][$l]->period_from_date)))))
                  {
                    $day=0;
                    $flag=true;
                    $total_cost=0;
                    $mandatory_supplement_cost=0;
                    $crs_mandatory_supplement=array();
                    $mandatory_supplement_meal_plan=array(); 
                    $nonmandatory_supplement_cost=0;
                    $crs_nonmandatory_supplement=array();
                    $nonmandatory_supplement_meal_plan=array();
                    $crs_booking_code=array();
                    $mandatory_supplement_net_fare=0;
                    $nonmandatory_supplement_net_fare=0; 
                    $mandatory_discount=0; 
                    $nonmandatory_discount=0;
                    $net_fare=0;
                    $discount=0;
                    $hotel_room_allotment=array();     
                    $rt_hotel_code=$resultsarr_PPPN_early_bird[$i][$l]->hotel_code;
                    $rt_room_code=$resultsarr_PPPN_early_bird[$i][$l]->room_code;
                    $min_room_occupancy=$resultsarr_PPPN_early_bird[$i][$l]->min_room_occupancy;
                    $max_room_occupancy=$resultsarr_PPPN_early_bird[$i][$l]->max_room_occupancy;
                    $rt_contract_id=$resultsarr_PPPN_early_bird[$i][$l]->contract_id;
                    $rt_market=$resultsarr_PPPN_early_bird[$i][$l]->market;
                    $rt_exclude_market=explode('||',$resultsarr_PPPN_early_bird[$i][$l]->exclude_market);
                    $rt_meal_plan=$resultsarr_PPPN_early_bird[$i][$l]->meal_plan;
                    $rt_supplier_id=$resultsarr_PPPN_early_bird[$i][$l]->supplier_id;

                    $rt_specialoffer_id=$resultsarr_PPPN_early_bird[$i][$l]->specialoffer_id;
                    $rt_specialoffer_type=$resultsarr_PPPN_early_bird[$i][$l]->specialoffer_type;
                    $rt_discount_rate_type=$resultsarr_PPPN_early_bird[$i][$l]->discount_rate_type;
                    $rt_prior_day_type=$resultsarr_PPPN_early_bird[$i][$l]->prior_day_type;
                    $rt_prior_checkin=$resultsarr_PPPN_early_bird[$i][$l]->prior_checkin;
                    $rt_prior_checkin_date=$resultsarr_PPPN_early_bird[$i][$l]->prior_checkin_date;
                    $rt_period_from_date=$resultsarr_PPPN_early_bird[$i][$l]->period_from_date;
                    $rt_period_to_date=$resultsarr_PPPN_early_bird[$i][$l]->period_to_date;

               
                   
                    $index1='EARLYBIRD_PPPN'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_contract_id.'|'.$rt_market.'|'.$rt_meal_plan.'|'.$rt_specialoffer_id.'|'.$rt_specialoffer_type.'|'.$rt_discount_rate_type.'|'.$rt_prior_day_type.'|'.$rt_prior_checkin.'|'.$rt_prior_checkin_date.'|'.$rt_period_from_date.'|'.$rt_period_to_date.'|'.($i+1).'|'.($i+1).'|'.$min_room_occupancy.'|'.$max_room_occupancy.'|'.$this->adults[$i].'|'.$this->childs[$i].$childsagestr.'|'.$this->adult_extrabed[$i].'|'.$this->child_extrabed[$i];

                   $roommealtype1='EARLYBIRD_PPPN'.'|'.($i+1).'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_meal_plan;        
                    
                  if(in_array($this->market_name, $rt_exclude_market))
                    {
                      continue;
                    }

                    if(!empty($roommealarr[$i][$roommealtype1]))
                    {
                        continue;
                    }

                    if(!empty($indexarr[$i][$index1]))
                    {
                        continue;
                    }

                  for($j=0,$s=0;$j<count($resultsarr_PPPN_early_bird[$i])&&!empty($resultsarr_PPPN_early_bird[$i]);$j++)
                  {
                      if($rt_hotel_code==$resultsarr_PPPN_early_bird[$i][$j]->hotel_code&&
                        $rt_room_code==$resultsarr_PPPN_early_bird[$i][$j]->room_code&&
                        $rt_supplier_id==$resultsarr_PPPN_early_bird[$i][$j]->supplier_id&&
                        $rt_contract_id==$resultsarr_PPPN_early_bird[$i][$j]->contract_id&&
                        $rt_market==$resultsarr_PPPN_early_bird[$i][$j]->market&&
                        $rt_meal_plan==$resultsarr_PPPN_early_bird[$i][$j]->meal_plan&&
                        $min_room_occupancy==$resultsarr_PPPN_early_bird[$i][$j]->min_room_occupancy&&
                        $max_room_occupancy==$resultsarr_PPPN_early_bird[$i][$j]->max_room_occupancy&&                        
                         $rt_specialoffer_id==$resultsarr_PPPN_early_bird[$i][$j]->specialoffer_id&&
                        $rt_specialoffer_type==$resultsarr_PPPN_early_bird[$i][$j]->specialoffer_type&&
                        $rt_discount_rate_type==$resultsarr_PPPN_early_bird[$i][$j]->discount_rate_type&&
                        $rt_prior_day_type==$resultsarr_PPPN_early_bird[$i][$j]->prior_day_type&&
                        $rt_prior_checkin==$resultsarr_PPPN_early_bird[$i][$j]->prior_checkin&&
                        $rt_prior_checkin_date==$resultsarr_PPPN_early_bird[$i][$j]->prior_checkin_date&&
                         $rt_period_from_date==$resultsarr_PPPN_early_bird[$i][$j]->period_from_date&&
                        $rt_period_to_date==$resultsarr_PPPN_early_bird[$i][$j]->period_to_date)
                        {
                         $roommealtype='EARLYBIRD_PPPN'.'|'.($i+1).'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_meal_plan;
                                    
                         $index='EARLYBIRD_PPPN'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_contract_id.'|'.$rt_market.'|'.$rt_meal_plan.'|'.$rt_specialoffer_id.'|'.$rt_specialoffer_type.'|'.$rt_discount_rate_type.'|'.$rt_prior_day_type.'|'.$rt_prior_checkin.'|'.$rt_prior_checkin_date.'|'.$rt_period_from_date.'|'.$rt_period_to_date.'|'.($i+1).'|'.($i+1).'|'.$min_room_occupancy.'|'.$max_room_occupancy.'|'.$this->adults[$i].'|'.$this->childs[$i].$childsagestr.'|'.$this->adult_extrabed[$i].'|'.$this->child_extrabed[$i];



                       
                           $day=$day+1;
                           $s=$j;
                           $child_rate=0;      
                           $child_rate_det=json_decode($resultsarr_PPPN_early_bird[$i][$j]->child_rate,true);
                           $childagerate=array();                 
                            if(!empty($child_rate_det[0]))
                            {                    
                              foreach ($child_rate_det as $key => $value)
                              { 
                                    $val=explode('||', $value);   
                                    $val1=explode('-', $val[0]);
                                    if($val1[0]>=$val1[1])
                                    {
                                        for($chr=$val1[1];$chr<=$val1[0];$chr++)
                                        {
                                            $childagerate[$chr]=$val[1];
                                        }
                                    }
                                    else
                                    {
                                       
                                        for($chr=$val1[0];$chr<=$val1[1];$chr++)
                                        {
                                            $childagerate[$chr]=$val[1];
                                        }
                                    }
                                }
                          }           
                        
                         if ($this->childs[$i] != 0)
                            {                         
                               $ages = explode(',', $this->childs_ages[$i]);   
                               for ($c = 0; $c < $this->childs[$i]; $c++)
                                {  
                                  
                                  $child_rate+=$childagerate[$ages[$c]];                
                                }
                            }
                            $tot=($this->adults[$i]*$resultsarr_PPPN_early_bird[$i][$j]->adult_rate)+$child_rate+($this->adult_extrabed[$i]*$resultsarr_PPPN_early_bird[$i][$j]->extra_bed_for_adults_rate)+($this->child_extrabed[$i]*$resultsarr_PPPN_early_bird[$i][$j]->extra_bed_for_child_rate);

                           // Supplement
                          $supplementdatacheck=array(
                               'hotel_code'=>$rt_hotel_code,
                               'room_code'=>$rt_room_code,
                               'supplier_id'=>$rt_supplier_id,
                               'contract_id'=>$rt_contract_id,
                               'market'=>$rt_market,
                               'meal_plan'=>$rt_meal_plan,
                               'avail_date'=>$resultsarr_PPPN_early_bird[$i][$j]->room_avail_date,
                                );

                         
                       $mandatory_supplements_check_arr=$this->Hotelcrs_Model->check_crs_hotels_normal_supplements_rates($supplementdatacheck,'Early bird','Yes');                      
                      foreach($mandatory_supplements_check_arr as $supplementarr)
                      {

                      list($mandatory_supplementarr,$mandatory_supp_cost,$mandatory_supplement_mealplan,$spec_offer_applicable_supplement)=$this->supplements_check($supplementarr,$i);
                        $crs_mandatory_supplement[]=$mandatory_supplementarr; 
                         $mandatory_tot=$mandatory_supp_cost;

                           $mandatory_supplement_net_fare+=$mandatory_tot;
                            if($spec_offer_applicable_supplement=="Yes")
                            {
                               $mandatory_dis=($mandatory_tot*($resultsarr_PPPN_early_bird[$i][$j]->discount_percentage/100));
                                $mandatory_discount+=$mandatory_dis;
                                 $mandatory_tot=($mandatory_tot-$mandatory_dis);
                              
                            }                         
                         
                             $mandatory_supplement_cost+=$mandatory_tot;              

                       $mandatory_suppmealplan=explode(',', $mandatory_supplement_mealplan);
                        foreach($mandatory_suppmealplan as $supp){
                        $mandatory_supplement_meal_plan[]=$supp;
                      }
                      }


                      $nonmandatory_supplements_check_arr=$this->Hotelcrs_Model->check_crs_hotels_normal_supplements_rates($supplementdatacheck,'Early bird','No');
                      $nonmandatory_tot=0;
                      foreach($nonmandatory_supplements_check_arr as $supplementarr)
                      {

                      list($nonmandatory_supplementarr,$nonmandatory_supp_cost,$nonmandatory_supplement_mealplan,$spec_offer_applicable_supplement)=$this->supplements_check($supplementarr,$i);
                        $crs_nonmandatory_supplement[]=$nonmandatory_supplementarr;

                        $nonmandatory_tot+=$nonmandatory_supp_cost;


                          $nonmandatory_tot=$nonmandatory_supp_cost;

                            $nonmandatory_supplement_net_fare+=$nonmandatory_tot;
                            if($spec_offer_applicable_supplement=="Yes")
                            {
                               $nonmandatory_dis=($nonmandatory_tot*($resultsarr_PPPN_early_bird[$i][$j]->discount_percentage/100));
                                $nonmandatory_discount+=$nonmandatory_dis;
                                 $nonmandatory_tot=($nonmandatory_tot-$nonmandatory_dis);
                              
                            }
                         
                             $nonmandatory_supplement_cost+=$nonmandatory_tot;                        
                         
                             $mandatory_supplement_cost+=$mandatory_tot; 


                    
                        $nonmandatory_suppmealplan=explode(',', $nonmandatory_supplement_mealplan);
                        foreach($nonmandatory_suppmealplan as $supp){
                        $nonmandatory_supplement_meal_plan[]=$supp;
                      }
                      }

                           // 



                            $net_fare+=$tot;                           
                            $discount_amount=($tot*($resultsarr_PPPN_early_bird[$i][$j]->discount_percentage/100));
                            $discount+=$discount_amount;  
                            $tot=($tot-$discount_amount);
                            $total_cost+=$tot;

                           $hotel_room_allotment[]=$resultsarr_PPPN_early_bird[$i][$j]->sup_hotel_room_allotment_id;
                        $crs_booking_code[]=$resultsarr_PPPN_early_bird[$i][$j]->booking_code;
               
                        }
                       
                    }
                    if($day==$this->nights)
                    {                                  
                        $indexarr[$i][$index]=$index;
                        $roommealarr[$i][$roommealtype]=$roommealtype;
                        $room_count_arr[$i]=$i;
                        $crs_booking_code=array_unique($crs_booking_code);
                        $crs_booking_code_str=implode(',', $crs_booking_code);
                        $resultsarr_PPPN_early_bird[$i][$s]->hotel_crs_booking_code=$crs_booking_code_str;


                        $resultsarr_PPPN_early_bird[$i][$s]->total_cost=$total_cost;
                       $resultsarr_PPPN_early_bird[$i][$s]->net_fare=$net_fare;
                       $resultsarr_PPPN_early_bird[$i][$s]->discount=$discount;

                      $resultsarr_PPPN_early_bird[$i][$s]->crs_mandatory_supplement=json_encode($crs_mandatory_supplement);
                        $mandatory_supplement_meal_plan=array_unique($mandatory_supplement_meal_plan);
                      $resultsarr_PPPN_early_bird[$i][$s]->mandatory_supplement_meal_plan=implode(',',$mandatory_supplement_meal_plan);
                       $resultsarr_PPPN_early_bird[$i][$s]->mandatory_supplement_cost=$mandatory_supplement_cost;
                       $resultsarr_PPPN_early_bird[$i][$s]->mandatory_supplement_net_fare=$mandatory_supplement_net_fare;

                       $resultsarr_PPPN_early_bird[$i][$s]->mandatory_supplement_discount=$mandatory_discount;

                      $resultsarr_PPPN_early_bird[$i][$s]->crs_nonmandatory_supplement=json_encode($crs_nonmandatory_supplement);
                        $nonmandatory_supplement_meal_plan=array_unique($nonmandatory_supplement_meal_plan);
                      $resultsarr_PPPN_early_bird[$i][$s]->nonmandatory_supplement_meal_plan=implode(',',$nonmandatory_supplement_meal_plan);
                       $resultsarr_PPPN_early_bird[$i][$s]->nonmandatory_supplement_cost=$nonmandatory_supplement_cost;
                      $resultsarr_PPPN_early_bird[$i][$s]->nonmandatory_supplement_net_fare=$nonmandatory_supplement_net_fare;
                      $resultsarr_PPPN_early_bird[$i][$s]->nonmandatory_supplement_discount=$nonmandatory_discount;

                        $resultsarr_PPPN_early_bird[$i][$s]->room_index=$i;
                        $resultsarr_PPPN_early_bird[$i][$s]->index=$index;
                        $resultsarr_PPPN_early_bird[$i][$s]->adult=$this->adults[$i];
                        $resultsarr_PPPN_early_bird[$i][$s]->child=$this->childs[$i];
                         $resultsarr_PPPN_early_bird[$i][$s]->adult_extrabed=$this->adult_extrabed[$i];
                        $resultsarr_PPPN_early_bird[$i][$s]->child_extrabed=$this->child_extrabed[$i];
                        $resultsarr_PPPN_early_bird[$i][$s]->nights=$this->nights; 
                        $resultsarr_PPPN_early_bird[$i][$s]->childs_ages=$child_ages;
                        $resultsarr_PPPN_early_bird[$i][$s]->type='EARLYBIRD';
                        $resultsarr_PPPN_early_bird[$i][$s]->hotel_room_allotment=implode(',', $hotel_room_allotment);                     
                         $cancelpolicy_arr=array(
                            'supplier_id'=>$resultsarr_PPPN_early_bird[$i][$s]->supplier_id,
                            'sup_hotel_id'=>$resultsarr_PPPN_early_bird[$i][$s]->sup_hotel_id,   
                            'hotel_code'=>$resultsarr_PPPN_early_bird[$i][$s]->hotel_code,   
                            'room_code'=>$resultsarr_PPPN_early_bird[$i][$s]->room_code,   
                            'contract_id'=>$resultsarr_PPPN_early_bird[$i][$s]->contract_id,   
                            'sup_room_details_id'=>$resultsarr_PPPN_early_bird[$i][$s]->sup_room_details_id,   
                            'market'=>$resultsarr_PPPN_early_bird[$i][$s]->market,   
                            'meal_plan'=>$resultsarr_PPPN_early_bird[$i][$s]->meal_plan,
                            'specialoffer_id'=>$resultsarr_PPPN_early_bird[$i][$s]->specialoffer_id,   
                            'specialoffer_type'=>$resultsarr_PPPN_early_bird[$i][$s]->specialoffer_type,
                            'rate_type'=>$resultsarr_PPPN_early_bird[$i][$s]->rate_type,
                            'min_room_occupancy'=>$resultsarr_PPPN_early_bird[$i][$s]->min_room_occupancy,   
                            'max_room_occupancy'=>$resultsarr_PPPN_early_bird[$i][$s]->max_room_occupancy,   
                            'min_adults_without_extra_bed'=>$resultsarr_PPPN_early_bird[$i][$s]->min_adults_without_extra_bed,   
                            'max_adults_without_extra_bed'=>$resultsarr_PPPN_early_bird[$i][$s]->max_adults_without_extra_bed,   
                            'min_child_without_extra_bed'=>$resultsarr_PPPN_early_bird[$i][$s]->min_child_without_extra_bed,   
                            'max_child_without_extra_bed'=>$resultsarr_PPPN_early_bird[$i][$s]->max_child_without_extra_bed,   
                            'extra_bed_for_adults'=>$resultsarr_PPPN_early_bird[$i][$s]->extra_bed_for_adults,   
                            'extra_bed_for_child'=>$resultsarr_PPPN_early_bird[$i][$s]->extra_bed_for_child,   
                          );
                $cancellation_policy=$this->Hotelcrs_Model->check_specialoffer_crs_hotels_normal_cancel_policy($cancelpolicy_arr,$checkIn);                                     

                    $cancel_policy='';
                    $hotel_crs_cancellation_json=array();
                    if(!empty($cancellation_policy[0]))
                    {
                      for($can=0,$incre=0;$can<count($cancellation_policy);$can++)
                      {
                        $last_date = $cancellation_policy[$can]->days_before_checkin; 
                        $today=date("Y-m-d");                    
                        if($last_date!=0)
                        {
                        $cancel_date = date('Y-m-d', strtotime('-' . $last_date . ' days ', strtotime($checkIn)));
                        }
                        else
                        {
                         $cancel_date = $checkIn; 
                        }


                      if($can==0 ||($can>=1&&$cancellation_policy[$can]->days_before_checkin!=$cancellation_policy[($can-1)]->days_before_checkin))
                       {        
                                                  
                         if($cancellation_policy[$can]->cancel_rates_type=='non_refundable')
                         {
                           $cancel_policy ='<p>Non Refundable</p>';
                           $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;                        
                         }

                        if(strtotime($today)<=strtotime($cancel_date))
                        {     
                        if($cancellation_policy[$can]->cancel_rates_type=='fixed'){
                          $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . ' '.$resultsarr_PPPN_early_bird[$i][$s]->currency_type.' will charged. If cancelled on ' . $cancel_date . ' </p>';
                        $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }
                        if($cancellation_policy[$can]->cancel_rates_type=='percentage')
                        {
                          $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . '% will charged. If cancelled on ' . $cancel_date . ' </p>';
                        $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }
                      
                       if($cancellation_policy[$can]->cancel_rates_type=='fullstay')
                         {
                          $cancel_policy_str='Full Stay Charge';

                           $cancel_policy .= '<p>Full Stay Charge. If cancelled on ' . $cancel_date . ' </p>';
                       $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        } 
                     }
                     }
                                     
                    
                    }
                  }
                  $resultsarr_PPPN_early_bird[$i][$s]->cancel_policy=$cancel_policy;
                  $resultsarr_PPPN_early_bird[$i][$s]->hotel_crs_cancellation_json=json_encode($hotel_crs_cancellation_json);  
                   $results[$index]=$resultsarr_PPPN_early_bird[$i][$s];
               

                  } 
                }
              
             }
     
        
       }
   }
   }            
  
  // exit;
    // echo "<pre>"; print_r($results);// exit;
     $insertrooms=array();
     $ro=0;
     foreach ($results as $result)
     {
    
      // $checkroom=$this->Hotelcrs_Model->check_hotel_room_search($this->api,$this->sess_id,$result->hotel_code,$result->room_code,$result->room_index);
      // if(empty($checkroom))

      // {
       $room_details_info=array(
           'supplier_id'=>$result->supplier_id,
           'sup_hotel_id'=>$result->sup_hotel_id,   
           'hotel_code'=>$result->hotel_code,   
           'room_code'=>$result->room_code,   
           'contract_id'=>$result->contract_id,   
           'sup_room_details_id'=>$result->sup_room_details_id,   
           'market'=>$result->market,   
           'meal_plan'=>$result->meal_plan,   
           'rate_type'=>$result->rate_type,
           'specialoffer_id'=>$result->specialoffer_id,   
           'specialoffer_type'=>$result->specialoffer_type,
           'min_room_occupancy'=>$result->min_room_occupancy,   
           'max_room_occupancy'=>$result->max_room_occupancy,   
           'min_adults_without_extra_bed'=>$result->min_adults_without_extra_bed,   
           'max_adults_without_extra_bed'=>$result->max_adults_without_extra_bed,   
           'min_child_without_extra_bed'=>$result->min_child_without_extra_bed,   
           'max_child_without_extra_bed'=>$result->max_child_without_extra_bed,   
           'extra_bed_for_adults'=>$result->extra_bed_for_adults,   
           'extra_bed_for_child'=>$result->extra_bed_for_child,   
           'discount_rate_type'=>$result->discount_rate_type,
           'prior_day_type'=>$result->prior_day_type,
           'prior_checkin'=>$result->prior_checkin,
           'prior_checkin_date'=>$result->prior_checkin_date,
           'period_from_date'=>$result->period_from_date,
           'period_to_date'=>$result->period_to_date,                   
         );

       $this->load->module('hotels/hotel_markup');
        $markup_array = $this->hotel_markup->markup_calculation($this->city_code,$result->net_fare, $this->nationality, $this->api);

        $insertrooms[$ro] =array(
            'session_id' => $this->sess_id,
            'uniqueRefNo' => $this->Sys_RefNo,
            'hotel_supplier_id'=>$result->supplier_id,
            'api' => $this->api,
            'city_code' => $this->city_code,
            'city_name' => $this->city_name,
            'hotel_code' => $result->hotel_code,
            'conversation_id'=>$result->type,
            'rate_plan_code'=>$result->rate_type,
            'rate_basis_id'=>$result->sup_hotel_room_rates_list_id,
            'rate_basis_desc'=>$result->index,
            'unique_cityid' => $this->city_code,
            'hotel_name' => $result->hotel_name,
            'room_name' => $result->room_name,
            'room_code' => $result->room_code,
            'room_description'=>$result->room_desc,
            'hotel_property_id'=>$result->hotel_room_allotment,
            'contractnameVal'=>$result->contract_id,
            'hbzoneName'=>$result->market,
            'room_details_info'=>json_encode($room_details_info),
            'room_type' => $result->room_type,
            'description' => $result->hotel_desc,
            'child_age' => $result->childs_ages,
            'board_type'=>$result->meal_plan,
            'adult' => $result->adult,
            'child' => $result->child,
            'adult_extrabed' => $result->adult_extrabed,
            'child_extrabed' => $result->child_extrabed,
            'room_count' => $this->rooms,
            'room_runno'=>$result->room_index,
            'nights'=>$result->nights,
            'image' => $result->thumb_img,
            'hotel_address' => $result->address,
            'amenities' => $result->hotel_facilities,
            'room_amenities' => $result->room_facilities,
            'cancel_policy'=>$result->cancel_policy,
            'star' => $result->hotel_star_rating,
            'xml_currency' => $result->currency_type,
            'currency' => $result->currency_type,
          
            'org_amt' => $result->total_cost+$result->mandatory_supplement_cost,
         
            'crs_mandatory_supplement'=>$result->crs_mandatory_supplement,
            'mandatory_supplement_cost'=>$result->mandatory_supplement_cost,
            'mandatory_supplement_meal_plan'=>$result->mandatory_supplement_meal_plan,
            'mandatory_supplement_net_fare'=>$result->mandatory_supplement_net_fare,
            'mandatory_supplement_discount'=>$result->mandatory_supplement_discount,
            'crs_nonmandatory_supplement'=>$result->crs_nonmandatory_supplement,
            'nonmandatory_supplement_cost'=>$result->nonmandatory_supplement_cost,
            'nonmandatory_supplement_meal_plan'=>$result->nonmandatory_supplement_meal_plan,
            'nonmandatory_supplement_net_fare'=>$result->nonmandatory_supplement_net_fare,
            'nonmandatory_supplement_discount'=>$result->nonmandatory_supplement_discount,
            'currency_conv_value' => $markup_array['total_cost']+$result->mandatory_supplement_cost,
            // 'total_cost' =>$result->total_cost+$result->mandatory_supplement_cost,
            'total_cost' => $markup_array['total_cost']+$result->mandatory_supplement_cost,
            'admin_markup' => $markup_array['admin_markup'],
            'agent_markup' => $markup_array['agent_markup'],
            'payment_charge' => $markup_array['payment_charge'],
            'net_fare'=>$result->net_fare+$result->mandatory_supplement_net_fare,
            'discount'=>$result->discount+$result->mandatory_supplement_discount,
            'ROE' => 1,
            'hotel_crs_cancellation_json'=>$result->hotel_crs_cancellation_json,
            'hotel_crs_booking_code'=>$result->hotel_crs_booking_code,
            );
        // echo '<pre>2';print_r($insertrooms[$ro]);
             $ro++;
     }

        if (!empty($insertrooms)&&count($room_count_arr)==$this->rooms) 
        {
          $this->Hotelcrs_Model->insert_crs_data($insertrooms);         
        } 
  }


  function extracthotel_discount($checkIn,$checkOut)
  {
     if(!empty($this->crshotelcode)){
        $hotelcodes=$this->crshotelcode;
     }
     else{
     $hotelcodes=$this->Hotelcrs_Model->gethotelcodes($this->city_code,0,500);
      }
      // if(empty($hotelcodess)){
      //   return '';
      // }
     $hotelcodess=array();
     foreach($hotelcodes as $hot)
     {
        $hotelcodess[]=$hot->hotel_code;
     }
     $roomcodes=$this->Hotelcrs_Model->getroomcodes($hotelcodess,0,2000);
     $rmhotelcodes=array();
     $rmcodes=array();
     foreach($roomcodes as $rm)
     {
        $rmhotelcodes[]=$rm->hotel_code;
        $rmcodes[]=$rm->room_code;
     }
     $htcode=array_unique($rmhotelcodes);
     $to_date=strtotime($checkOut);
     $from_date=strtotime($checkIn); 
     $days=floor(($to_date - $from_date) / (60 * 60 * 24));
     $resultsarr_PRPN_discount=array(); 
     $resultsarr_PPPN_discount=array(); 
     $results=array();
     $room_count_arr=array();       
     $rmhotelcodess=implode(',', $rmhotelcodes); 
     $rmcodess=implode(',', $rmcodes); 
     for ($i = 0; $i < $this->rooms; $i++)
     { 
          $res_PRPN_discount=array(); 
          $res_PPPN_discount=array();          
          $res_PRPN_discount = $this->Hotelcrs_Model->get_crs_hotels_PRPN_discount($rmhotelcodess,$rmcodess,$this->city_code, $checkIn, $checkOut, $this->adults[$i], $this->childs[$i], $this->adult_extrabed[$i], $this->child_extrabed[$i],$this->nights,$this->rooms,$this->market_name);

        if(empty($res_PRPN_discount))
        {
           $res_PRPN_discount = $this->Hotelcrs_Model->get_crs_hotels_PRPN_discount($rmhotelcodess,$rmcodess,$this->city_code, $checkIn, $checkOut, $this->adults[$i], $this->childs[$i], $this->adult_extrabed[$i], $this->child_extrabed[$i],$this->nights,$this->rooms,'All Markets');
        }


          $res_PPPN_discount = $this->Hotelcrs_Model->get_crs_hotels_PPPN_discount($rmhotelcodess,$rmcodess,$this->city_code, $checkIn, $checkOut, $this->adults[$i], $this->childs[$i], $this->adult_extrabed[$i], $this->child_extrabed[$i],$this->nights,$this->rooms,$this->market_name);

        if(empty($res_PPPN_discount))
        {
           $res_PPPN_discount = $this->Hotelcrs_Model->get_crs_hotels_PPPN_discount($rmhotelcodess,$rmcodess,$this->city_code, $checkIn, $checkOut, $this->adults[$i], $this->childs[$i], $this->adult_extrabed[$i], $this->child_extrabed[$i],$this->nights,$this->rooms,'All Markets');
        }


          if(!empty($res_PRPN_discount))
           {
             $resultsarr_PRPN_discount[$i]=$res_PRPN_discount;
           }             
          if(!empty($res_PPPN_discount))
           {
             $resultsarr_PPPN_discount[$i]=$res_PPPN_discount;
           }
    }
// echo "<pre>"; print_r($resultsarr_PPPN_discount);  
      // echo $this->db->last_query();exit;

    for ($i = 0; $i < $this->rooms; $i++)
    {
        $index='';
        $indexarr=array();
        $roommealarr=array();
        $childsagearr=array(); 
        $child_ages = '';  
        if ($this->childs[$i] != 0)
        {  
           $child_ages=$this->childs_ages[$i];
           $ages = explode(',', $this->childs_ages[$i]);   
           for ($c = 0; $c < $this->childs[$i]; $c++)
            {  
              $childsagearr[]=$ages[$c];                  
            }
        } 
        $childsagestr='';
        if(!empty($childsagearr))
        {
           $childsagestr=implode("|", $childsagearr);
           $childsagestr="|".$childsagestr;
        }

       
           if(isset($resultsarr_PRPN_discount[$i]))
           {                       
             
            for($l=0;$l<count($resultsarr_PRPN_discount[$i]);$l++)
              {
               
                 if(strtotime($checkIn)==strtotime($resultsarr_PRPN_discount[$i][$l]->room_avail_date))                 
                  {                
                    $day=0;
                    $flag=true;
                    $total_cost=0;
                    $discount=0;
                    $net_fare=0; 
                    $mandatory_supplement_net_fare=0;
                    $nonmandatory_supplement_net_fare=0;                 
                    $mandatory_supplement_cost=0;
                    $mandatory_discount=0;
                    $nonmandatory_discount=0;
                    $crs_mandatory_supplement=array();
                    $mandatory_supplement_meal_plan=array();  
                    $nonmandatory_supplement_cost=0;
                    $crs_nonmandatory_supplement=array();
                    $nonmandatory_supplement_meal_plan=array(); 
                    $crs_booking_code=array();                 
                    $hotel_room_allotment=array();        
                    $rt_hotel_code=$resultsarr_PRPN_discount[$i][$l]->hotel_code;
                    $rt_room_code=$resultsarr_PRPN_discount[$i][$l]->room_code;
                    $min_adults=$resultsarr_PRPN_discount[$i][$l]->min_adults_without_extra_bed;
                    $max_adults=$resultsarr_PRPN_discount[$i][$l]->max_adults_without_extra_bed;
                    $min_child=$resultsarr_PRPN_discount[$i][$l]->min_child_without_extra_bed;
                    $max_child=$resultsarr_PRPN_discount[$i][$l]->max_child_without_extra_bed;
                    $adults_bed=$resultsarr_PRPN_discount[$i][$l]->extra_bed_for_adults;
                    $child_bed=$resultsarr_PRPN_discount[$i][$l]->extra_bed_for_child;
                    $rt_contract_id=$resultsarr_PRPN_discount[$i][$l]->contract_id;
                    $rt_market=$resultsarr_PRPN_discount[$i][$l]->market;
                    $rt_exclude_market=explode('||',$resultsarr_PRPN_discount[$i][$l]->exclude_market);
                    $rt_meal_plan=$resultsarr_PRPN_discount[$i][$l]->meal_plan;
                    $rt_supplier_id=$resultsarr_PRPN_discount[$i][$l]->supplier_id;

                  $rt_specialoffer_id=$resultsarr_PRPN_discount[$i][$l]->specialoffer_id;
                  $rt_specialoffer_type=$resultsarr_PRPN_discount[$i][$l]->specialoffer_type;
                  $rt_min_no_of_stay_day=$resultsarr_PRPN_discount[$i][$l]->min_no_of_stay_day;
                  $rt_max_no_of_stay_day=$resultsarr_PRPN_discount[$i][$l]->max_no_of_stay_day;                 
                $index1='DISCOUNT_PRPN'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_contract_id.'|'.$rt_market.'|'.$rt_meal_plan.'|'.$rt_specialoffer_id.'|'.$rt_specialoffer_type.'|'.$rt_min_no_of_stay_day.'|'.$rt_max_no_of_stay_day.'|'.($i+1).'|'.$min_adults.'|'.$max_adults.'|'.$min_child.'|'.$max_child.'|'.$adults_bed.'|'.$child_bed.'|'.$this->adults[$i].'|'.$this->childs[$i].'|'.$this->adult_extrabed[$i].'|'.$this->child_extrabed[$i];

                  $roommealtype1='DISCOUNT_PRPN'.'|'.($i+1).'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_meal_plan;

                    if(in_array($this->market_name, $rt_exclude_market))
                    {
                      continue;
                    }

                    if(!empty($roommealarr[$i][$roommealtype1]))
                    {
                        continue;
                    }

                    if(!empty($indexarr[$i][$index1]))
                    {
                        continue;
                    }
                    for($j=0,$s=0;$j<count($resultsarr_PRPN_discount[$i])&&!empty($resultsarr_PRPN_discount[$i]);$j++)
                     {
                      if($rt_hotel_code==$resultsarr_PRPN_discount[$i][$j]->hotel_code&&
                        $rt_room_code==$resultsarr_PRPN_discount[$i][$j]->room_code&&
                        $rt_supplier_id==$resultsarr_PRPN_discount[$i][$j]->supplier_id&&
                        $rt_contract_id==$resultsarr_PRPN_discount[$i][$j]->contract_id&&
                        $rt_market==$resultsarr_PRPN_discount[$i][$j]->market&&
                        $rt_meal_plan==$resultsarr_PRPN_discount[$i][$j]->meal_plan&&
                        $min_adults==$resultsarr_PRPN_discount[$i][$j]->min_adults_without_extra_bed&&
                        $max_adults==$resultsarr_PRPN_discount[$i][$j]->max_adults_without_extra_bed&&
                        $min_child==$resultsarr_PRPN_discount[$i][$j]->min_child_without_extra_bed&&
                        $max_child==$resultsarr_PRPN_discount[$i][$j]->max_child_without_extra_bed&&
                        $adults_bed==$resultsarr_PRPN_discount[$i][$j]->extra_bed_for_adults&&
                        $child_bed==$resultsarr_PRPN_discount[$i][$j]->extra_bed_for_child&&
                        $rt_specialoffer_id==$resultsarr_PRPN_discount[$i][$j]->specialoffer_id&&
                        $rt_specialoffer_type==$resultsarr_PRPN_discount[$i][$j]->specialoffer_type&&
                        $rt_min_no_of_stay_day==$resultsarr_PRPN_discount[$i][$j]->min_no_of_stay_day&& 
                       $rt_max_no_of_stay_day==$resultsarr_PRPN_discount[$i][$j]->max_no_of_stay_day                      
                       )
                        {
                          $index='DISCOUNT_PRPN'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_contract_id.'|'.$rt_market.'|'.$rt_meal_plan.'|'.$rt_specialoffer_id.'|'.$rt_specialoffer_type.'|'.$rt_min_no_of_stay_day.'|'.$rt_max_no_of_stay_day.'|'.($i+1).'|'.$min_adults.'|'.$max_adults.'|'.$min_child.'|'.$max_child.'|'.$adults_bed.'|'.$child_bed.'|'.$this->adults[$i].'|'.$this->childs[$i].'|'.$this->adult_extrabed[$i].'|'.$this->child_extrabed[$i];

                            $roommealtype='DISCOUNT_PRPN'.'|'.($i+1).'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_meal_plan;


                            $day=$day+1;
                            $s=$j;
                          $tot=$resultsarr_PRPN_discount[$i][$j]->room_rate+($this->adult_extrabed[$i]*$resultsarr_PRPN_discount[$i][$j]->extra_bed_for_adults_rate)+($this->child_extrabed[$i]*$resultsarr_PRPN_discount[$i][$j]->extra_bed_for_child_rate);

                            // Supplement
                          $supplementdatacheck=array(
                               'hotel_code'=>$rt_hotel_code,
                               'room_code'=>$rt_room_code,
                               'supplier_id'=>$rt_supplier_id,
                               'contract_id'=>$rt_contract_id,
                               'market'=>$rt_market,
                               'meal_plan'=>$rt_meal_plan,
                               'avail_date'=>$resultsarr_PRPN_discount[$i][$j]->room_avail_date,
                              );
                      $mandatory_supplements_check_arr=$this->Hotelcrs_Model->check_crs_hotels_normal_supplements_rates($supplementdatacheck,'Discount','Yes');                      
                      foreach($mandatory_supplements_check_arr as $supplementarr)
                      {

                      list($mandatory_supplementarr,$mandatory_supp_cost,$mandatory_supplement_mealplan,$spec_offer_applicable_supplement)=$this->supplements_check($supplementarr,$i);
                        $crs_mandatory_supplement[]=$mandatory_supplementarr; 
                         $mandatory_tot=$mandatory_supp_cost;

                           $mandatory_supplement_net_fare+=$mandatory_tot;
                            if($spec_offer_applicable_supplement=="Yes")
                            {
                               $mandatory_dis=($mandatory_tot*($resultsarr_PRPN_discount[$i][$j]->discount_percentage/100));
                                $mandatory_discount+=$mandatory_dis;
                                 $mandatory_tot=($mandatory_tot-$mandatory_dis);
                              
                            }                         
                         
                             $mandatory_supplement_cost+=$mandatory_tot;              

                       $mandatory_suppmealplan=explode(',', $mandatory_supplement_mealplan);
                        foreach($mandatory_suppmealplan as $supp){
                        $mandatory_supplement_meal_plan[]=$supp;
                      }
                      }


                      $nonmandatory_supplements_check_arr=$this->Hotelcrs_Model->check_crs_hotels_normal_supplements_rates($supplementdatacheck,'Discount','No');
                      $nonmandatory_tot=0;
                      foreach($nonmandatory_supplements_check_arr as $supplementarr)
                      {

                      list($nonmandatory_supplementarr,$nonmandatory_supp_cost,$nonmandatory_supplement_mealplan,$spec_offer_applicable_supplement)=$this->supplements_check($supplementarr,$i);
                        $crs_nonmandatory_supplement[]=$nonmandatory_supplementarr;

                        $nonmandatory_tot+=$nonmandatory_supp_cost;


                          $nonmandatory_tot=$nonmandatory_supp_cost;

                            $nonmandatory_supplement_net_fare+=$nonmandatory_tot;
                            if($spec_offer_applicable_supplement=="Yes")
                            {
                               $nonmandatory_dis=($nonmandatory_tot*($resultsarr_PRPN_discount[$i][$j]->discount_percentage/100));
                                $nonmandatory_discount+=$nonmandatory_dis;
                                 $nonmandatory_tot=($nonmandatory_tot-$nonmandatory_dis);
                              
                            }
                         
                             $nonmandatory_supplement_cost+=$nonmandatory_tot;                        
                         
                             $mandatory_supplement_cost+=$mandatory_tot; 


                    
                        $nonmandatory_suppmealplan=explode(',', $nonmandatory_supplement_mealplan);
                        foreach($nonmandatory_suppmealplan as $supp){
                        $nonmandatory_supplement_meal_plan[]=$supp;
                      }
                      }

                           // 

                        $net_fare+=$tot;
                        $discount_amount=($tot*($resultsarr_PRPN_discount[$i][$j]->discount_percentage/100));
                        $discount+=$discount_amount;  
                        $tot=($tot-$discount_amount);
                        $total_cost+=$tot; 


                      

                        $hotel_room_allotment[]=$resultsarr_PRPN_discount[$i][$j]->sup_hotel_room_allotment_id;
                      $crs_booking_code[]=$resultsarr_PRPN_discount[$i][$j]->booking_code;
                        }
                     }

                    if($day==$this->nights)
                    {                
                        $indexarr[$i][$index]=$index;
                        $roommealarr[$i][$roommealtype]=$roommealtype;
                        $room_count_arr[$i]=$i;

                        $crs_booking_code=array_unique($crs_booking_code);
                        $crs_booking_code_str=implode(',', $crs_booking_code);
                        $resultsarr_PRPN_discount[$i][$s]->hotel_crs_booking_code=$crs_booking_code_str;

                        $resultsarr_PRPN_discount[$i][$s]->total_cost=$total_cost;
                       $resultsarr_PRPN_discount[$i][$s]->net_fare=$net_fare;
                       $resultsarr_PRPN_discount[$i][$s]->discount=$discount;

                      $resultsarr_PRPN_discount[$i][$s]->crs_mandatory_supplement=json_encode($crs_mandatory_supplement);
                        $mandatory_supplement_meal_plan=array_unique($mandatory_supplement_meal_plan);
                      $resultsarr_PRPN_discount[$i][$s]->mandatory_supplement_meal_plan=implode(',',$mandatory_supplement_meal_plan);
                       $resultsarr_PRPN_discount[$i][$s]->mandatory_supplement_cost=$mandatory_supplement_cost;
                       $resultsarr_PRPN_discount[$i][$s]->mandatory_supplement_net_fare=$mandatory_supplement_net_fare;

                       $resultsarr_PRPN_discount[$i][$s]->mandatory_supplement_discount=$mandatory_discount;

                      $resultsarr_PRPN_discount[$i][$s]->crs_nonmandatory_supplement=json_encode($crs_nonmandatory_supplement);
                        $nonmandatory_supplement_meal_plan=array_unique($nonmandatory_supplement_meal_plan);
                      $resultsarr_PRPN_discount[$i][$s]->nonmandatory_supplement_meal_plan=implode(',',$nonmandatory_supplement_meal_plan);
                       $resultsarr_PRPN_discount[$i][$s]->nonmandatory_supplement_cost=$nonmandatory_supplement_cost;
                      $resultsarr_PRPN_discount[$i][$s]->nonmandatory_supplement_net_fare=$nonmandatory_supplement_net_fare;
                      $resultsarr_PRPN_discount[$i][$s]->nonmandatory_supplement_discount=$nonmandatory_discount;

                        $resultsarr_PRPN_discount[$i][$s]->room_index=$i;
                        $resultsarr_PRPN_discount[$i][$s]->index=$index;
                        $resultsarr_PRPN_discount[$i][$s]->adult=$this->adults[$i];
                        $resultsarr_PRPN_discount[$i][$s]->child=$this->childs[$i];
                        $resultsarr_PRPN_discount[$i][$s]->adult_extrabed=$this->adult_extrabed[$i];
                        $resultsarr_PRPN_discount[$i][$s]->child_extrabed=$this->child_extrabed[$i];
                        $resultsarr_PRPN_discount[$i][$s]->nights=$this->nights; 
                        $resultsarr_PRPN_discount[$i][$s]->childs_ages=$child_ages;
                        $resultsarr_PRPN_discount[$i][$s]->type='DISCOUNT';
                        $resultsarr_PRPN_discount[$i][$s]->hotel_room_allotment=implode(',', $hotel_room_allotment);                       
                        $cancelpolicy_arr=array(
                            'supplier_id'=>$resultsarr_PRPN_discount[$i][$s]->supplier_id,
                            'sup_hotel_id'=>$resultsarr_PRPN_discount[$i][$s]->sup_hotel_id,   
                            'hotel_code'=>$resultsarr_PRPN_discount[$i][$s]->hotel_code,   
                            'room_code'=>$resultsarr_PRPN_discount[$i][$s]->room_code,   
                            'contract_id'=>$resultsarr_PRPN_discount[$i][$s]->contract_id,   
                            'sup_room_details_id'=>$resultsarr_PRPN_discount[$i][$s]->sup_room_details_id,   
                            'market'=>$resultsarr_PRPN_discount[$i][$s]->market,   
                            'meal_plan'=>$resultsarr_PRPN_discount[$i][$s]->meal_plan,
                             'specialoffer_id'=>$resultsarr_PRPN_discount[$i][$s]->specialoffer_id,   
                            'specialoffer_type'=>$resultsarr_PRPN_discount[$i][$s]->specialoffer_type,
                            'rate_type'=>$resultsarr_PRPN_discount[$i][$s]->rate_type,
                            'min_room_occupancy'=>$resultsarr_PRPN_discount[$i][$s]->min_room_occupancy,   
                            'max_room_occupancy'=>$resultsarr_PRPN_discount[$i][$s]->max_room_occupancy,   
                            'min_adults_without_extra_bed'=>$resultsarr_PRPN_discount[$i][$s]->min_adults_without_extra_bed,   
                            'max_adults_without_extra_bed'=>$resultsarr_PRPN_discount[$i][$s]->max_adults_without_extra_bed,   
                            'min_child_without_extra_bed'=>$resultsarr_PRPN_discount[$i][$s]->min_child_without_extra_bed,   
                            'max_child_without_extra_bed'=>$resultsarr_PRPN_discount[$i][$s]->max_child_without_extra_bed,   
                            'extra_bed_for_adults'=>$resultsarr_PRPN_discount[$i][$s]->extra_bed_for_adults,   
                            'extra_bed_for_child'=>$resultsarr_PRPN_discount[$i][$s]->extra_bed_for_child,   
                          );
                   $cancellation_policy=$this->Hotelcrs_Model->check_specialoffer_crs_hotels_normal_cancel_policy($cancelpolicy_arr,$checkIn);                                     

                    $cancel_policy='';
                    $hotel_crs_cancellation_json=array();
                    if(!empty($cancellation_policy[0]))
                    {
                      for($can=0,$incre=0;$can<count($cancellation_policy);$can++)
                      {
                        $last_date = $cancellation_policy[$can]->days_before_checkin;                     
                        if($last_date!=0)
                        {
                        $cancel_date = date('Y-m-d', strtotime('-' . $last_date . ' days ', strtotime($checkIn)));
                        }
                        else
                        {
                         $cancel_date = $checkIn; 
                        }
                        if($can==0 ||($can>=1&&$cancellation_policy[$can]->days_before_checkin!=$cancellation_policy[($can-1)]->days_before_checkin))
                       {                             
                         if($cancellation_policy[$can]->cancel_rates_type=='non_refundable')
                         {
                           $cancel_policy ='<p>Non Refundable</p>';
                         $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;                        
                         }
                         if($cancellation_policy[$can]->cancel_rates_type=='fullstay')
                         {
                          $cancel_policy_str='Full Stay Charge';

                           $cancel_policy .= '<p>Full Stay Charge. If cancelled on ' . $cancel_date . ' </p>';
                       $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }        
                        if($cancellation_policy[$can]->cancel_rates_type=='fixed'){
                          $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . ' '.$resultsarr_PRPN_discount[$i][$s]->currency_type.' will charged. If cancelled on ' . $cancel_date . ' </p>';
                        $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }
                        if($cancellation_policy[$can]->cancel_rates_type=='percentage')
                        {
                          $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . '% will charged. If cancelled on ' . $cancel_date . ' </p>';
                        $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }
                     }                   
                    
                    }
                  }
                  $resultsarr_PRPN_discount[$i][$s]->cancel_policy=$cancel_policy;
                  $resultsarr_PRPN_discount[$i][$s]->hotel_crs_cancellation_json=json_encode($hotel_crs_cancellation_json);  
                   $results[$index]=$resultsarr_PRPN_discount[$i][$s];             
                
                  } 
                 }
              
               }
               
               }
            
             
           if(isset($resultsarr_PPPN_discount[$i]))
           {    
             
             for($l=0;$l<count($resultsarr_PPPN_discount[$i]);$l++)
              {
              
                if(strtotime($checkIn)==strtotime($resultsarr_PPPN_discount[$i][$l]->room_avail_date))
                         
                 {

                    $day=0;
                    $flag=true;
                    $total_cost=0;
                    $discount = 0;
                    $mandatory_supplement_cost=0;
                    $mandatory_discount=0;
                    $crs_mandatory_supplement=array(); 
                    $mandatory_supplement_meal_plan=array();
                    $nonmandatory_supplement_cost=0;
                    $nonmandatory_discount=0;
                    $crs_nonmandatory_supplement=array();
                    $nonmandatory_supplement_meal_plan=array();  
                    $crs_booking_code=array();
                    $net_fare=0;
                    $mandatory_supplement_net_fare=0;
                    $nonmandatory_supplement_net_fare=0;                  
                    $hotel_room_allotment=array();     
                    $rt_hotel_code=$resultsarr_PPPN_discount[$i][$l]->hotel_code;
                    $rt_room_code=$resultsarr_PPPN_discount[$i][$l]->room_code;
                    $min_room_occupancy=$resultsarr_PPPN_discount[$i][$l]->min_room_occupancy;
                    $max_room_occupancy=$resultsarr_PPPN_discount[$i][$l]->max_room_occupancy;
                    $rt_contract_id=$resultsarr_PPPN_discount[$i][$l]->contract_id;
                    $rt_market=$resultsarr_PPPN_discount[$i][$l]->market;
                    $rt_exclude_market=explode('||',$resultsarr_PPPN_discount[$i][$l]->exclude_market);
                    $rt_meal_plan=$resultsarr_PPPN_discount[$i][$l]->meal_plan;
                    $rt_supplier_id=$resultsarr_PPPN_discount[$i][$l]->supplier_id;

                    $rt_specialoffer_id=$resultsarr_PPPN_discount[$i][$l]->specialoffer_id;
                    $rt_specialoffer_type=$resultsarr_PPPN_discount[$i][$l]->specialoffer_type;
                    $rt_min_no_of_stay_day=$resultsarr_PPPN_discount[$i][$l]->min_no_of_stay_day; 
                    $rt_max_no_of_stay_day=$resultsarr_PPPN_discount[$i][$l]->max_no_of_stay_day;                 
                    $index1='DISCOUNT_PPPN'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_contract_id.'|'.$rt_market.'|'.$rt_meal_plan.'|'.$rt_specialoffer_id.'|'.$rt_specialoffer_type.'|'.$rt_min_no_of_stay_day.'|'.$rt_max_no_of_stay_day.'|'.($i+1).'|'.($i+1).'|'.$min_room_occupancy.'|'.$max_room_occupancy.'|'.$this->adults[$i].'|'.$this->childs[$i].$childsagestr.'|'.$this->adult_extrabed[$i].'|'.$this->child_extrabed[$i];

                     $roommealtype1='DISCOUNT_PPPN'.'|'.($i+1).'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_meal_plan;
                
                   
                    if(in_array($this->market_name, $rt_exclude_market))
                    {
                      continue;
                    }

                      if(!empty($roommealarr[$i][$roommealtype1]))
                    {
                        continue;
                    }
                    if(!empty($indexarr[$i][$index1]))
                    {
                        continue;
                    }

                  for($j=0,$s=0;$j<count($resultsarr_PPPN_discount[$i])&&!empty($resultsarr_PPPN_discount[$i]);$j++)
                  {  
                      if($rt_hotel_code==$resultsarr_PPPN_discount[$i][$j]->hotel_code&&
                        $rt_room_code==$resultsarr_PPPN_discount[$i][$j]->room_code&&
                        $rt_supplier_id==$resultsarr_PPPN_discount[$i][$j]->supplier_id&&
                        $rt_contract_id==$resultsarr_PPPN_discount[$i][$j]->contract_id&&
                        $rt_market==$resultsarr_PPPN_discount[$i][$j]->market&&
                        $rt_meal_plan==$resultsarr_PPPN_discount[$i][$j]->meal_plan&&
                        $min_room_occupancy==$resultsarr_PPPN_discount[$i][$j]->min_room_occupancy&&
                        $max_room_occupancy==$resultsarr_PPPN_discount[$i][$j]->max_room_occupancy&&                        
                         $rt_specialoffer_id==$resultsarr_PPPN_discount[$i][$j]->specialoffer_id&&
                        $rt_specialoffer_type==$resultsarr_PPPN_discount[$i][$j]->specialoffer_type&&
                         $rt_min_no_of_stay_day==$resultsarr_PPPN_discount[$i][$j]->min_no_of_stay_day&& 
                        $rt_max_no_of_stay_day==$resultsarr_PPPN_discount[$i][$j]->max_no_of_stay_day)
                        {
                            
                         $index='DISCOUNT_PPPN'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_contract_id.'|'.$rt_market.'|'.$rt_meal_plan.'|'.$rt_specialoffer_id.'|'.$rt_specialoffer_type.'|'.$rt_min_no_of_stay_day.'|'.$rt_max_no_of_stay_day.'|'.($i+1).'|'.($i+1).'|'.$min_room_occupancy.'|'.$max_room_occupancy.'|'.$this->adults[$i].'|'.$this->childs[$i].$childsagestr.'|'.$this->adult_extrabed[$i].'|'.$this->child_extrabed[$i];
                          $roommealtype='DISCOUNT_PPPN'.'|'.($i+1).'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_meal_plan;

                           $day=$day+1;
                           $s=$j;
                           $child_rate=0;      
                           $child_rate_det=json_decode($resultsarr_PPPN_discount[$i][$j]->child_rate,true);
                           $childagerate=array();                 
                            if(!empty($child_rate_det[0]))
                            {                    
                              foreach ($child_rate_det as $key => $value)
                              { 
                                    $val=explode('||', $value);   
                                    $val1=explode('-', $val[0]);
                                    if($val1[0]>=$val1[1])
                                    {
                                        for($chr=$val1[1];$chr<=$val1[0];$chr++)
                                        {
                                            $childagerate[$chr]=$val[1];
                                        }
                                    }
                                    else
                                    {
                                       
                                        for($chr=$val1[0];$chr<=$val1[1];$chr++)
                                        {
                                            $childagerate[$chr]=$val[1];
                                        }
                                    }
                                }
                          }           
                        
                         if ($this->childs[$i] != 0)
                            {                         
                               $ages = explode(',', $this->childs_ages[$i]);   
                               for ($c = 0; $c < $this->childs[$i]; $c++)
                                {  
                                  
                                  $child_rate+=$childagerate[$ages[$c]];                
                                }
                            }
                        $tot=($this->adults[$i]*$resultsarr_PPPN_discount[$i][$j]->adult_rate)+$child_rate+($this->adult_extrabed[$i]*$resultsarr_PPPN_discount[$i][$j]->extra_bed_for_adults_rate)+($this->child_extrabed[$i]*$resultsarr_PPPN_discount[$i][$j]->extra_bed_for_child_rate);

                         // Supplement
                          $supplementdatacheck=array(
                               'hotel_code'=>$rt_hotel_code,
                               'room_code'=>$rt_room_code,
                               'supplier_id'=>$rt_supplier_id,
                               'contract_id'=>$rt_contract_id,
                               'market'=>$rt_market,
                               'meal_plan'=>$rt_meal_plan,
                               'avail_date'=>$resultsarr_PPPN_discount[$i][$j]->room_avail_date,
                               );

                   $mandatory_supplements_check_arr=$this->Hotelcrs_Model->check_crs_hotels_normal_supplements_rates($supplementdatacheck,'Discount','Yes');                      
                      foreach($mandatory_supplements_check_arr as $supplementarr)
                      {

                      list($mandatory_supplementarr,$mandatory_supp_cost,$mandatory_supplement_mealplan,$spec_offer_applicable_supplement)=$this->supplements_check($supplementarr,$i);
                        $crs_mandatory_supplement[]=$mandatory_supplementarr; 
                         $mandatory_tot=$mandatory_supp_cost;

                           $mandatory_supplement_net_fare+=$mandatory_tot;
                            if($spec_offer_applicable_supplement=="Yes")
                            {
                               $mandatory_dis=($mandatory_tot*($resultsarr_PPPN_discount[$i][$j]->discount_percentage/100));
                                $mandatory_discount+=$mandatory_dis;
                                 $mandatory_tot=($mandatory_tot-$mandatory_dis);
                              
                            }                         
                         
                             $mandatory_supplement_cost+=$mandatory_tot;              

                       $mandatory_suppmealplan=explode(',', $mandatory_supplement_mealplan);
                        foreach($mandatory_suppmealplan as $supp){
                        $mandatory_supplement_meal_plan[]=$supp;
                      }
                      }


                      $nonmandatory_supplements_check_arr=$this->Hotelcrs_Model->check_crs_hotels_normal_supplements_rates($supplementdatacheck,'Discount','No');
                      $nonmandatory_tot=0;
                      foreach($nonmandatory_supplements_check_arr as $supplementarr)
                      {

                      list($nonmandatory_supplementarr,$nonmandatory_supp_cost,$nonmandatory_supplement_mealplan,$spec_offer_applicable_supplement)=$this->supplements_check($supplementarr,$i);
                        $crs_nonmandatory_supplement[]=$nonmandatory_supplementarr;

                        $nonmandatory_tot+=$nonmandatory_supp_cost;


                          $nonmandatory_tot=$nonmandatory_supp_cost;

                            $nonmandatory_supplement_net_fare+=$nonmandatory_tot;
                            if($spec_offer_applicable_supplement=="Yes")
                            {
                               $nonmandatory_dis=($nonmandatory_tot*($resultsarr_PPPN_discount[$i][$j]->discount_percentage/100));
                                $nonmandatory_discount+=$nonmandatory_dis;
                                 $nonmandatory_tot=($nonmandatory_tot-$nonmandatory_dis);
                              
                            }
                         
                             $nonmandatory_supplement_cost+=$nonmandatory_tot;                        
                         
                             $mandatory_supplement_cost+=$mandatory_tot; 


                    
                        $nonmandatory_suppmealplan=explode(',', $nonmandatory_supplement_mealplan);
                        foreach($nonmandatory_suppmealplan as $supp){
                        $nonmandatory_supplement_meal_plan[]=$supp;
                      }
                      }


                           // 

                        $net_fare+=$tot;
                        $discount_amount=($tot*($resultsarr_PPPN_discount[$i][$j]->discount_percentage/100));
                        $discount+=$discount_amount;  
                        $tot=($tot-$discount_amount);
                        $total_cost+=$tot; 


                       

                        $hotel_room_allotment[]=$resultsarr_PPPN_discount[$i][$j]->sup_hotel_room_allotment_id;
                      $crs_booking_code[]=$resultsarr_PPPN_discount[$i][$j]->booking_code;
               
                        }
                       
                    }
                    if($day==$this->nights)
                    {                                  
                        $indexarr[$i][$index]=$index; 
                        $roommealarr[$i][$roommealtype]=$roommealtype;
                        $room_count_arr[$i]=$i;

                        $crs_booking_code=array_unique($crs_booking_code);
                        $crs_booking_code_str=implode(',', $crs_booking_code);
                        $resultsarr_PPPN_discount[$i][$s]->hotel_crs_booking_code=$crs_booking_code_str;

                        $resultsarr_PPPN_discount[$i][$s]->total_cost=$total_cost;
                       $resultsarr_PPPN_discount[$i][$s]->net_fare=$net_fare;
                       $resultsarr_PPPN_discount[$i][$s]->discount=$discount;

                      $resultsarr_PPPN_discount[$i][$s]->crs_mandatory_supplement=json_encode($crs_mandatory_supplement);
                        $mandatory_supplement_meal_plan=array_unique($mandatory_supplement_meal_plan);
                      $resultsarr_PPPN_discount[$i][$s]->mandatory_supplement_meal_plan=implode(',',$mandatory_supplement_meal_plan);
                       $resultsarr_PPPN_discount[$i][$s]->mandatory_supplement_cost=$mandatory_supplement_cost;
                       $resultsarr_PPPN_discount[$i][$s]->mandatory_supplement_net_fare=$mandatory_supplement_net_fare;

                       $resultsarr_PPPN_discount[$i][$s]->mandatory_supplement_discount=$mandatory_discount;

                      $resultsarr_PPPN_discount[$i][$s]->crs_nonmandatory_supplement=json_encode($crs_nonmandatory_supplement);
                        $nonmandatory_supplement_meal_plan=array_unique($nonmandatory_supplement_meal_plan);
                      $resultsarr_PPPN_discount[$i][$s]->nonmandatory_supplement_meal_plan=implode(',',$nonmandatory_supplement_meal_plan);
                       $resultsarr_PPPN_discount[$i][$s]->nonmandatory_supplement_cost=$nonmandatory_supplement_cost;
                      $resultsarr_PPPN_discount[$i][$s]->nonmandatory_supplement_net_fare=$nonmandatory_supplement_net_fare;
                      $resultsarr_PPPN_discount[$i][$s]->nonmandatory_supplement_discount=$nonmandatory_discount;

                        $resultsarr_PPPN_discount[$i][$s]->room_index=$i;
                        $resultsarr_PPPN_discount[$i][$s]->index=$index;
                        $resultsarr_PPPN_discount[$i][$s]->adult=$this->adults[$i];
                        $resultsarr_PPPN_discount[$i][$s]->child=$this->childs[$i];
                         $resultsarr_PPPN_discount[$i][$s]->adult_extrabed=$this->adult_extrabed[$i];
                        $resultsarr_PPPN_discount[$i][$s]->child_extrabed=$this->child_extrabed[$i];
                        $resultsarr_PPPN_discount[$i][$s]->nights=$this->nights; 
                        $resultsarr_PPPN_discount[$i][$s]->childs_ages=$child_ages;
                        $resultsarr_PPPN_discount[$i][$s]->type='DISCOUNT';
                        $resultsarr_PPPN_discount[$i][$s]->hotel_room_allotment=implode(',', $hotel_room_allotment);                     
                         $cancelpolicy_arr=array(
                            'supplier_id'=>$resultsarr_PPPN_discount[$i][$s]->supplier_id,
                            'sup_hotel_id'=>$resultsarr_PPPN_discount[$i][$s]->sup_hotel_id,   
                            'hotel_code'=>$resultsarr_PPPN_discount[$i][$s]->hotel_code,   
                            'room_code'=>$resultsarr_PPPN_discount[$i][$s]->room_code,   
                            'contract_id'=>$resultsarr_PPPN_discount[$i][$s]->contract_id,   
                            'sup_room_details_id'=>$resultsarr_PPPN_discount[$i][$s]->sup_room_details_id,   
                            'market'=>$resultsarr_PPPN_discount[$i][$s]->market,   
                            'meal_plan'=>$resultsarr_PPPN_discount[$i][$s]->meal_plan,
                            'specialoffer_id'=>$resultsarr_PPPN_discount[$i][$s]->specialoffer_id,   
                            'specialoffer_type'=>$resultsarr_PPPN_discount[$i][$s]->specialoffer_type,
                            'rate_type'=>$resultsarr_PPPN_discount[$i][$s]->rate_type,
                            'min_room_occupancy'=>$resultsarr_PPPN_discount[$i][$s]->min_room_occupancy,   
                            'max_room_occupancy'=>$resultsarr_PPPN_discount[$i][$s]->max_room_occupancy,   
                            'min_adults_without_extra_bed'=>$resultsarr_PPPN_discount[$i][$s]->min_adults_without_extra_bed,   
                            'max_adults_without_extra_bed'=>$resultsarr_PPPN_discount[$i][$s]->max_adults_without_extra_bed,   
                            'min_child_without_extra_bed'=>$resultsarr_PPPN_discount[$i][$s]->min_child_without_extra_bed,   
                            'max_child_without_extra_bed'=>$resultsarr_PPPN_discount[$i][$s]->max_child_without_extra_bed,   
                            'extra_bed_for_adults'=>$resultsarr_PPPN_discount[$i][$s]->extra_bed_for_adults,   
                            'extra_bed_for_child'=>$resultsarr_PPPN_discount[$i][$s]->extra_bed_for_child,   
                          );
                $cancellation_policy=$this->Hotelcrs_Model->check_specialoffer_crs_hotels_normal_cancel_policy($cancelpolicy_arr,$checkIn);                                     

                    $cancel_policy='';
                    $hotel_crs_cancellation_json=array();
                    if(!empty($cancellation_policy[0]))
                    {
                      for($can=0,$incre=0;$can<count($cancellation_policy);$can++)
                      {
                        $last_date = $cancellation_policy[$can]->days_before_checkin; 
                        $today=date("Y-m-d");                    
                        if($last_date!=0)
                        {
                        $cancel_date = date('Y-m-d', strtotime('-' . $last_date . ' days ', strtotime($checkIn)));
                        }
                        else
                        {
                         $cancel_date = $checkIn; 
                        }


                        if($can==0 ||($can>=1&&$cancellation_policy[$can]->days_before_checkin!=$cancellation_policy[($can-1)]->days_before_checkin))
                       {                              
                         if($cancellation_policy[$can]->cancel_rates_type=='non_refundable')
                         {
                           $cancel_policy ='<p>Non Refundable</p>';
                           $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;                        
                         }

                        if(strtotime($today)<=strtotime($cancel_date))
                        {     
                        if($cancellation_policy[$can]->cancel_rates_type=='fixed'){
                          $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . ' '.$resultsarr_PPPN_discount[$i][$s]->currency_type.' will charged. If cancelled on ' . $cancel_date . ' </p>';
                        $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }
                        if($cancellation_policy[$can]->cancel_rates_type=='percentage')
                        {
                          $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . '% will charged. If cancelled on ' . $cancel_date . ' </p>';
                        $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }
                      
                       if($cancellation_policy[$can]->cancel_rates_type=='fullstay')
                         {
                          $cancel_policy_str='Full Stay Charge';

                           $cancel_policy .= '<p>Full Stay Charge. If cancelled on ' . $cancel_date . ' </p>';
                       $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        } 
                     }
                     }
                                     
                    
                    }
                  }
                  $resultsarr_PPPN_discount[$i][$s]->cancel_policy=$cancel_policy;
                  $resultsarr_PPPN_discount[$i][$s]->hotel_crs_cancellation_json=json_encode($hotel_crs_cancellation_json);  
                   $results[$index]=$resultsarr_PPPN_discount[$i][$s];   
              

                  } 
                }
               
             }
          
   }
   }            
  
  // echo "<pre>"; print_r($results); //exit;
     $insertrooms=array();
     $ro=0;
     foreach ($results as $result)
     {
      // $checkroom=$this->Hotelcrs_Model->check_hotel_room_search($this->api,$this->sess_id,$result->hotel_code,$result->room_code,$result->room_index);
      // if(empty($checkroom))
      // {
       $room_details_info=array(
           'supplier_id'=>$result->supplier_id,
           'sup_hotel_id'=>$result->sup_hotel_id,   
           'hotel_code'=>$result->hotel_code,   
           'room_code'=>$result->room_code,   
           'contract_id'=>$result->contract_id,   
           'sup_room_details_id'=>$result->sup_room_details_id,   
           'market'=>$result->market,   
           'meal_plan'=>$result->meal_plan,   
           'rate_type'=>$result->rate_type,
           'specialoffer_id'=>$result->specialoffer_id,   
           'specialoffer_type'=>$result->specialoffer_type,
           'min_room_occupancy'=>$result->min_room_occupancy,   
           'max_room_occupancy'=>$result->max_room_occupancy,   
           'min_adults_without_extra_bed'=>$result->min_adults_without_extra_bed,   
           'max_adults_without_extra_bed'=>$result->max_adults_without_extra_bed,   
           'min_child_without_extra_bed'=>$result->min_child_without_extra_bed,   
           'max_child_without_extra_bed'=>$result->max_child_without_extra_bed,   
           'extra_bed_for_adults'=>$result->extra_bed_for_adults,   
           'extra_bed_for_child'=>$result->extra_bed_for_child,   
           'min_no_of_stay_day'=>$result->min_no_of_stay_day, 
           'max_no_of_stay_day'=>$result->max_no_of_stay_day,
           'no_of_stay_free_nights'=>$result->no_of_stay_free_nights, 
           'prior_day_type'=>$result->prior_day_type,
           'prior_checkin'=>$result->prior_checkin,
           'prior_checkin_date'=>$result->prior_checkin_date,
           'period_from_date'=>$result->period_from_date,
           'period_to_date'=>$result->period_to_date,                   
         );

       $this->load->module('hotels/hotel_markup');
       $markup_array = $this->hotel_markup->markup_calculation($this->city_code,$result->net_fare, $this->nationality, $this->api);

        $insertrooms[$ro] =array(
            'session_id' => $this->sess_id,
            'uniqueRefNo' => $this->Sys_RefNo,
            'hotel_supplier_id'=>$result->supplier_id,
            'api' => $this->api,
            'city_code' => $this->city_code,
            'city_name' => $this->city_name,
            'hotel_code' => $result->hotel_code,
            'conversation_id'=>$result->type,
            'rate_plan_code'=>$result->rate_type,
            'rate_basis_id'=>$result->sup_hotel_room_rates_list_id,
            'rate_basis_desc'=>$result->index,
            'unique_cityid' => $this->city_code,
            'hotel_name' => $result->hotel_name,
            'room_name' => $result->room_name,
            'room_code' => $result->room_code,
            'room_description'=>$result->room_desc,
            'hotel_property_id'=>$result->hotel_room_allotment,
            'contractnameVal'=>$result->contract_id,
            'hbzoneName'=>$result->market,
            'room_details_info'=>json_encode($room_details_info),
            'room_type' => $result->room_type,
            'description' => $result->hotel_desc,
            'child_age' => $result->childs_ages,
            'board_type'=>$result->meal_plan,
            'adult' => $result->adult,
            'child' => $result->child,
            'adult_extrabed' => $result->adult_extrabed,
            'child_extrabed' => $result->child_extrabed,
            'room_count' => $this->rooms,
            'room_runno'=>$result->room_index,
            'nights'=>$result->nights,
            'image' => $result->thumb_img,
            'hotel_address' => $result->address,
            'amenities' => $result->hotel_facilities,
            'room_amenities' => $result->room_facilities,
            'cancel_policy'=>$result->cancel_policy,
            'star' => $result->hotel_star_rating,
            'xml_currency' => $result->currency_type,
            'currency' => $result->currency_type,


            'crs_mandatory_supplement'=>$result->crs_mandatory_supplement,
            'mandatory_supplement_cost'=>$result->mandatory_supplement_cost,
            'mandatory_supplement_meal_plan'=>$result->mandatory_supplement_meal_plan,
            'mandatory_supplement_net_fare'=>$result->mandatory_supplement_net_fare,
            'mandatory_supplement_discount'=>$result->mandatory_supplement_discount,
            'crs_nonmandatory_supplement'=>$result->crs_nonmandatory_supplement,
            'nonmandatory_supplement_cost'=>$result->nonmandatory_supplement_cost,
            'nonmandatory_supplement_meal_plan'=>$result->nonmandatory_supplement_meal_plan,
            'nonmandatory_supplement_net_fare'=>$result->nonmandatory_supplement_net_fare,
            'nonmandatory_supplement_discount'=>$result->nonmandatory_supplement_discount,
            'currency_conv_value' => $markup_array['total_cost']+$result->mandatory_supplement_cost,
            // 'total_cost' =>$result->total_cost+$result->mandatory_supplement_cost,
            'total_cost' => $markup_array['total_cost']+$result->mandatory_supplement_cost,
            'admin_markup' => $markup_array['admin_markup'],
            'agent_markup' => $markup_array['agent_markup'],
            'payment_charge' => $markup_array['payment_charge'],
            'net_fare'=>$result->net_fare+$result->mandatory_supplement_net_fare,
            'discount'=>$result->discount+$result->mandatory_supplement_discount,
            'org_amt' => $result->total_cost+$result->mandatory_supplement_cost,
            'ROE' => 1,
            'hotel_crs_cancellation_json'=>$result->hotel_crs_cancellation_json,
            'hotel_crs_booking_code'=>$result->hotel_crs_booking_code,
            );
        // echo '<pre>3';print_r( $insertrooms[$ro]);
            $ro++;
     }

        if (!empty($insertrooms)&&count($room_count_arr)==$this->rooms) 
        {
          $this->Hotelcrs_Model->insert_crs_data($insertrooms);
         
        } 
  }

 function extracthotel($checkIn,$checkOut)
  {
    if(!empty($this->crshotelcode)){
        $hotelcodes=$this->crshotelcode;
     }
     else{
     $hotelcodes=$this->Hotelcrs_Model->gethotelcodes($this->city_code,0,500);

      } 

      // if(empty($hotelcodess)){
      //   return '';
      // } 
     $hotelcodess=array();
     foreach($hotelcodes as $hot)
     {
        $hotelcodess[]=$hot->hotel_code;
     }
     $roomcodes=$this->Hotelcrs_Model->getroomcodes($hotelcodess,0,2000);

     $rmhotelcodes=array();
     $rmcodes=array();
     foreach($roomcodes as $rm)
     {
        $rmhotelcodes[]=$rm->hotel_code;
        $rmcodes[]=$rm->room_code;
     }
     $htcode=array_unique($rmhotelcodes);    
     $to_date=strtotime($checkOut);
     $from_date=strtotime($checkIn); 
     $days=floor(($to_date - $from_date) / (60 * 60 * 24));
     $resultsarr_PRPN=array(); 
     $resultsarr_PPPN=array(); 
     $results=array();
     $room_count_arr=array();       
     $rmhotelcodess=implode(',', $rmhotelcodes); 
     $rmcodess=implode(',', $rmcodes); 
     for ($i = 0; $i < $this->rooms; $i++)
     { 
          $res_PRPN=array(); 
          $res_PPPN=array();         
          $res_PRPN = $this->Hotelcrs_Model->get_crs_hotels_PRPN($rmhotelcodess,$rmcodess,$this->city_code, $checkIn, $checkOut, $this->adults[$i], $this->childs[$i], $this->adult_extrabed[$i], $this->child_extrabed[$i],$this->rooms,$this->market_name);


          if(empty($res_PRPN))
          {

              $res_PRPN = $this->Hotelcrs_Model->get_crs_hotels_PRPN($rmhotelcodess,$rmcodess,$this->city_code, $checkIn, $checkOut, $this->adults[$i], $this->childs[$i], $this->adult_extrabed[$i], $this->child_extrabed[$i],$this->rooms,'All Markets');

          }

          $res_PPPN = $this->Hotelcrs_Model->get_crs_hotels_PPPN($rmhotelcodess,$rmcodess,$this->city_code, $checkIn, $checkOut, $this->adults[$i], $this->childs[$i], $this->adult_extrabed[$i], $this->child_extrabed[$i],$this->rooms,'All Markets');
                //echo $this->db->last_query();exit;

          if(empty($res_PPPN))
          {
                $res_PPPN = $this->Hotelcrs_Model->get_crs_hotels_PPPN($rmhotelcodess,$rmcodess,$this->city_code, $checkIn, $checkOut, $this->adults[$i], $this->childs[$i], $this->adult_extrabed[$i], $this->child_extrabed[$i],$this->rooms,'All Markets');
                   //print_r($res_PPPN );exit;
          }

          if(!empty($res_PRPN))
           {
             $resultsarr_PRPN[$i]=$res_PRPN;
           }             
          if(!empty($res_PPPN))
           {
             $resultsarr_PPPN[$i]=$res_PPPN;
           }
    }

     // print_r($resultsarr_PPPN);
     // echo "<pre>";  print_r($resultsarr_PPPN);
     // exit;
    //print_r($this->rooms);exit;
    for ($i = 0; $i < $this->rooms; $i++)
    {



        $index='';
        $indexarr=array();
        $roommealarr=array();
        $childsagearr=array(); 
        $child_ages = '';  
        if ($this->childs[$i] != 0)
        {  
           $child_ages=$this->childs_ages[$i];
           $ages = explode(',', $this->childs_ages[$i]);   
           for ($c = 0; $c < $this->childs[$i]; $c++)
            {  
              $childsagearr[]=$ages[$c];                  
            }
        } 
        $childsagestr='';
        if(!empty($childsagearr))
        {
           $childsagestr=implode("|", $childsagearr);
           $childsagestr="|".$childsagestr;
        }

       
           if(isset($resultsarr_PRPN[$i]))
           {
              for($l=0;$l<count($resultsarr_PRPN[$i]);$l++)
              {
                if(strtotime($checkIn)==strtotime($resultsarr_PRPN[$i][$l]->room_avail_date))
                  {
                    //print_r($resultsarr_PRPN);exit;
                    $day=0;
                    $flag=true;
                    $total_cost=0;
                    $mandatory_supplement_cost=0;
                    $crs_mandatory_supplement=array();
                    $mandatory_supplement_meal_plan=array();
                    $nonmandatory_supplement_cost=0;
                    $crs_nonmandatory_supplement=array();
                    $nonmandatory_supplement_meal_plan=array();  
                    $hotel_room_allotment=array();        
                    $rt_hotel_code=$resultsarr_PRPN[$i][$l]->hotel_code;
                    $rt_room_code=$resultsarr_PRPN[$i][$l]->room_code;
                    $min_adults=$resultsarr_PRPN[$i][$l]->min_adults_without_extra_bed;
                    $max_adults=$resultsarr_PRPN[$i][$l]->max_adults_without_extra_bed;
                    $min_child=$resultsarr_PRPN[$i][$l]->min_child_without_extra_bed;
                    $max_child=$resultsarr_PRPN[$i][$l]->max_child_without_extra_bed;
                    $adults_bed=$resultsarr_PRPN[$i][$l]->extra_bed_for_adults;
                    $child_bed=$resultsarr_PRPN[$i][$l]->extra_bed_for_child;
                    $rt_contract_id=$resultsarr_PRPN[$i][$l]->contract_id;
                    $rt_market=$resultsarr_PRPN[$i][$l]->market;
                    $rt_exclude_market=explode('||',$resultsarr_PRPN[$i][$l]->exclude_market);
                    $rt_meal_plan=$resultsarr_PRPN[$i][$l]->meal_plan;
                    $rt_supplier_id=$resultsarr_PRPN[$i][$l]->supplier_id;
                    $index1='PRPN'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_contract_id.'|'.$rt_market.'|'.$rt_meal_plan.'|'.($i+1).'|'.$min_adults.'|'.$max_adults.'|'.$min_child.'|'.$max_child.'|'.$adults_bed.'|'.$child_bed.'|'.$this->adults[$i].'|'.$this->childs[$i].'|'.$this->adult_extrabed[$i].'|'.$this->child_extrabed[$i];

                    $roommealtype1='PRPN'.'|'.($i+1).'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_meal_plan;                   

                    
                    if(in_array($this->market_name, $rt_exclude_market))
                    {
                      continue;
                    }

                   if(!empty($roommealarr[$i][$roommealtype1]))
                    {
                        continue;
                    }
                    if(!empty($indexarr[$i][$index1]))
                    {
                        continue;
                    }
                    for($j=0,$s=0;$j<count($resultsarr_PRPN[$i])&&!empty($resultsarr_PRPN[$i]);$j++)
                     {
                      if($rt_hotel_code==$resultsarr_PRPN[$i][$j]->hotel_code&&
                        $rt_room_code==$resultsarr_PRPN[$i][$j]->room_code&&
                        $rt_supplier_id==$resultsarr_PRPN[$i][$j]->supplier_id&&
                        $rt_contract_id==$resultsarr_PRPN[$i][$j]->contract_id&&
                        $rt_market==$resultsarr_PRPN[$i][$j]->market&&
                        $rt_meal_plan==$resultsarr_PRPN[$i][$j]->meal_plan&&
                        $min_adults==$resultsarr_PRPN[$i][$j]->min_adults_without_extra_bed&&
                        $max_adults==$resultsarr_PRPN[$i][$j]->max_adults_without_extra_bed&&
                        $min_child==$resultsarr_PRPN[$i][$j]->min_child_without_extra_bed&&
                        $max_child==$resultsarr_PRPN[$i][$j]->max_child_without_extra_bed&&
                        $adults_bed==$resultsarr_PRPN[$i][$j]->extra_bed_for_adults&&
                        $child_bed==$resultsarr_PRPN[$i][$j]->extra_bed_for_child)
                        {
                             $index='PRPN'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_contract_id.'|'.$rt_market.'|'.$rt_meal_plan.'|'.($i+1).'|'.$min_adults.'|'.$max_adults.'|'.$min_child.'|'.$max_child.'|'.$adults_bed.'|'.$child_bed.'|'.$this->adults[$i].'|'.$this->childs[$i].'|'.$this->adult_extrabed[$i].'|'.$this->child_extrabed[$i];
                            $roommealtype='PRPN'.'|'.($i+1).'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_meal_plan;  
                             $day=$day+1;
                             $s=$j;
                        

                       $total_cost+=$resultsarr_PRPN[$i][$j]->room_rate+($this->adult_extrabed[$i]*$resultsarr_PRPN[$i][$j]->extra_bed_for_adults_rate)+($this->child_extrabed[$i]*$resultsarr_PRPN[$i][$j]->extra_bed_for_child_rate);

                             $hotel_room_allotment[]=$resultsarr_PRPN[$i][$j]->sup_hotel_room_allotment_id;
                             // Supplement
                          $supplementdatacheck=array(
                               'hotel_code'=>$rt_hotel_code,
                               'room_code'=>$rt_room_code,
                               'supplier_id'=>$rt_supplier_id,
                               'contract_id'=>$rt_contract_id,
                               'market'=>$rt_market,
                               'meal_plan'=>$rt_meal_plan,
                               'avail_date'=>$resultsarr_PRPN[$i][$j]->room_avail_date,
                               );
                      $mandatory_supplements_check_arr=$this->Hotelcrs_Model->check_crs_hotels_normal_supplements_rates($supplementdatacheck,'other','Yes');
                      foreach($mandatory_supplements_check_arr as $supplementarr)
                      {

                      list($mandatory_supplementarr,$mandatory_supp_cost,$mandatory_supplement_mealplan,$spec_offer_applicable_supplement)=$this->supplements_check($supplementarr,$i);
                        $crs_mandatory_supplement[]=$mandatory_supplementarr;                          
                        $mandatory_supplement_cost+=$mandatory_supp_cost; 
                        $mandatory_suppmealplan=explode(',', $mandatory_supplement_mealplan);
                        foreach($mandatory_suppmealplan as $supp){
                        $mandatory_supplement_meal_plan[]=$supp;
                      }
                      }

                         $nonmandatory_supplements_check_arr=$this->Hotelcrs_Model->check_crs_hotels_normal_supplements_rates($supplementdatacheck,'other','No');
                      foreach($nonmandatory_supplements_check_arr as $supplementarr)
                      {

                      list($nonmandatory_supplementarr,$nonmandatory_supp_cost,$nonmandatory_supplement_mealplan,$spec_offer_applicable_supplement)=$this->supplements_check($supplementarr,$i);
                        $crs_nonmandatory_supplement[]=$nonmandatory_supplementarr;                                                
                       $nonmandatory_supplement_cost+=$nonmandatory_supp_cost;
                        $nonmandatory_suppmealplan=explode(',', $nonmandatory_supplement_mealplan);
                        foreach($nonmandatory_suppmealplan as $supp){
                        $nonmandatory_supplement_meal_plan[]=$supp;
                      }
                      }
                           // 

                        }
                     }

                    if($day==$this->nights)
                    {                
                        $indexarr[$i][$index]=$index;
                        $roommealarr[$i][$roommealtype]=$roommealtype;
                        $room_count_arr[$i]=$i;
                        $resultsarr_PRPN[$i][$s]->total_cost=$total_cost;
                       $resultsarr_PRPN[$i][$s]->net_fare=$total_cost;
                       $resultsarr_PRPN[$i][$s]->crs_mandatory_supplement=json_encode($crs_mandatory_supplement);
                        $mandatory_supplement_meal_plan=array_unique($mandatory_supplement_meal_plan);
                      $resultsarr_PRPN[$i][$s]->mandatory_supplement_meal_plan=implode(',',$mandatory_supplement_meal_plan);
                       $resultsarr_PRPN[$i][$s]->mandatory_supplement_cost=$mandatory_supplement_cost;
                       $resultsarr_PRPN[$i][$s]->mandatory_supplement_net_fare=$mandatory_supplement_cost;

                      $resultsarr_PRPN[$i][$s]->crs_nonmandatory_supplement=json_encode($crs_nonmandatory_supplement);
                        $nonmandatory_supplement_meal_plan=array_unique($nonmandatory_supplement_meal_plan);
                      $resultsarr_PRPN[$i][$s]->nonmandatory_supplement_meal_plan=implode(',',$nonmandatory_supplement_meal_plan);
                       $resultsarr_PRPN[$i][$s]->nonmandatory_supplement_cost=$nonmandatory_supplement_cost;
                      $resultsarr_PRPN[$i][$s]->nonmandatory_supplement_net_fare=$nonmandatory_supplement_cost;
                        $resultsarr_PRPN[$i][$s]->room_index=$i;
                        $resultsarr_PRPN[$i][$s]->index=$index;
                        $resultsarr_PRPN[$i][$s]->adult=$this->adults[$i];
                        $resultsarr_PRPN[$i][$s]->child=$this->childs[$i];
                        $resultsarr_PRPN[$i][$s]->adult_extrabed=$this->adult_extrabed[$i];
                        $resultsarr_PRPN[$i][$s]->child_extrabed=$this->child_extrabed[$i];
                        $resultsarr_PRPN[$i][$s]->nights=$this->nights; 
                        $resultsarr_PRPN[$i][$s]->childs_ages=$child_ages;
                        $resultsarr_PRPN[$i][$s]->type='Normal';
                        $resultsarr_PRPN[$i][$s]->hotel_room_allotment=implode(',', $hotel_room_allotment);                       
                        $cancelpolicy_arr=array(
                            'supplier_id'=>$resultsarr_PRPN[$i][$s]->supplier_id,
                            'sup_hotel_id'=>$resultsarr_PRPN[$i][$s]->sup_hotel_id,   
                            'hotel_code'=>$resultsarr_PRPN[$i][$s]->hotel_code,   
                            'room_code'=>$resultsarr_PRPN[$i][$s]->room_code,   
                            'contract_id'=>$resultsarr_PRPN[$i][$s]->contract_id,   
                            'sup_room_details_id'=>$resultsarr_PRPN[$i][$s]->sup_room_details_id,   
                            'market'=>$resultsarr_PRPN[$i][$s]->market,   
                            'meal_plan'=>$resultsarr_PRPN[$i][$s]->meal_plan,   
                            'rate_type'=>$resultsarr_PRPN[$i][$s]->rate_type,
                            'min_room_occupancy'=>$resultsarr_PRPN[$i][$s]->min_room_occupancy,   
                            'max_room_occupancy'=>$resultsarr_PRPN[$i][$s]->max_room_occupancy,   
                            'min_adults_without_extra_bed'=>$resultsarr_PRPN[$i][$s]->min_adults_without_extra_bed,   
                            'max_adults_without_extra_bed'=>$resultsarr_PRPN[$i][$s]->max_adults_without_extra_bed,   
                            'min_child_without_extra_bed'=>$resultsarr_PRPN[$i][$s]->min_child_without_extra_bed,   
                            'max_child_without_extra_bed'=>$resultsarr_PRPN[$i][$s]->max_child_without_extra_bed,   
                            'extra_bed_for_adults'=>$resultsarr_PRPN[$i][$s]->extra_bed_for_adults,   
                            'extra_bed_for_child'=>$resultsarr_PRPN[$i][$s]->extra_bed_for_child,   
                          );              
                   $cancellation_policy=$this->Hotelcrs_Model->check_crs_hotels_normal_cancel_policy($cancelpolicy_arr,$checkIn);                                     

                    $cancel_policy='';
                    $hotel_crs_cancellation_json=array();
                    if(!empty($cancellation_policy[0]))
                    {
                      for($can=0,$incre=0;$can<count($cancellation_policy);$can++)
                      {
                        $last_date = $cancellation_policy[$can]->days_before_checkin;                     
                        if($last_date!=0)
                        {
                        $cancel_date = date('Y-m-d', strtotime('-' . $last_date . ' days ', strtotime($checkIn)));
                        }
                        else
                        {
                         $cancel_date = $checkIn; 
                        }
                       if($can==0 ||($can>=1&&$cancellation_policy[$can]->days_before_checkin!=$cancellation_policy[($can-1)]->days_before_checkin))
                       {                                
                         if($cancellation_policy[$can]->cancel_rates_type=='non_refundable')
                         {
                           $cancel_policy ='<p>Non Refundable</p>';
                         $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;                        
                         }
                         if($cancellation_policy[$can]->cancel_rates_type=='fullstay')
                         {
                          $cancel_policy_str='Full Stay Charge';

                           $cancel_policy .= '<p>Full Stay Charge. If cancelled on ' . $cancel_date . ' </p>';
                       $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }        
                        if($cancellation_policy[$can]->cancel_rates_type=='fixed'){
                          $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . ' '.$resultsarr_PRPN[$i][$s]->currency_type.' will charged. If cancelled on ' . $cancel_date . ' </p>';
                        $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }
                        if($cancellation_policy[$can]->cancel_rates_type=='percentage')
                        {
                          $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . '% will charged. If cancelled on ' . $cancel_date . ' </p>';
                        $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }
                     }                   
                    
                    }
                  }
                  $resultsarr_PRPN[$i][$s]->cancel_policy=$cancel_policy;
                  $resultsarr_PRPN[$i][$s]->hotel_crs_cancellation_json=json_encode($hotel_crs_cancellation_json);  
                   $results[$index]=$resultsarr_PRPN[$i][$s]; 
                  } 
                 }
               }
             }
             
           if(isset($resultsarr_PPPN[$i]))
           {
             for($l=0;$l<count($resultsarr_PPPN[$i]);$l++)
             {
              if(strtotime($checkIn)==strtotime($resultsarr_PPPN[$i][$l]->room_avail_date))
               {

                    $day=0;
                    $flag=true;
                    $total_cost=0; 
                    $mandatory_supplement_cost=0;
                    $crs_mandatory_supplement=array();
                    $mandatory_supplement_meal_plan=array();
                    $nonmandatory_supplement_cost=0;
                    $crs_nonmandatory_supplement=array();
                    $nonmandatory_supplement_meal_plan=array();  
                    $hotel_room_allotment=array();     
                    $rt_hotel_code=$resultsarr_PPPN[$i][$l]->hotel_code;
                    $rt_room_code=$resultsarr_PPPN[$i][$l]->room_code;
                    $min_room_occupancy=$resultsarr_PPPN[$i][$l]->min_room_occupancy;
                    $max_room_occupancy=$resultsarr_PPPN[$i][$l]->max_room_occupancy;
                    $rt_contract_id=$resultsarr_PPPN[$i][$l]->contract_id;
                    $rt_market=$resultsarr_PPPN[$i][$l]->market;
                    $rt_exclude_market=explode('||',$resultsarr_PPPN[$i][$l]->exclude_market);
                    $rt_meal_plan=$resultsarr_PPPN[$i][$l]->meal_plan;
                    $rt_supplier_id=$resultsarr_PPPN[$i][$l]->supplier_id;
                   
                    $index1='PPPN'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_contract_id.'|'.$rt_market.'|'.$rt_meal_plan.'|'.($i+1).'|'.$min_room_occupancy.'|'.$max_room_occupancy.'|'.$this->adults[$i].'|'.$this->childs[$i].$childsagestr.'|'.$this->adult_extrabed[$i].'|'.$this->child_extrabed[$i];  

                    $roommealtype1='PPPN'.'|'.($i+1).'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_meal_plan;                   

                   /*if(in_array($this->market_name, $rt_exclude_market))
                    {
                      continue;
                    }

                    if(!empty($roommealarr[$i][$roommealtype1]))
                    {
                        continue;
                    }        
                    if(!empty($indexarr[$i][$index1]))
                    {
                        continue;
                    }*/

                  for($j=0,$s=0;$j<count($resultsarr_PPPN[$i])&&!empty($resultsarr_PPPN[$i]);$j++)
                  { 
                      if($rt_hotel_code==$resultsarr_PPPN[$i][$j]->hotel_code&&
                        $rt_room_code==$resultsarr_PPPN[$i][$j]->room_code&&
                        $rt_supplier_id==$resultsarr_PPPN[$i][$j]->supplier_id&&
                        $rt_contract_id==$resultsarr_PPPN[$i][$j]->contract_id&&
                        $rt_market==$resultsarr_PPPN[$i][$j]->market&&
                        $rt_meal_plan==$resultsarr_PPPN[$i][$j]->meal_plan&&
                        $min_room_occupancy==$resultsarr_PPPN[$i][$j]->min_room_occupancy&&
                        $max_room_occupancy==$resultsarr_PPPN[$i][$j]->max_room_occupancy)
                        {
                                    
                           $index='PPPN'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_contract_id.'|'.$rt_market.'|'.$rt_meal_plan.'|'.($i+1).'|'.$min_room_occupancy.'|'.$max_room_occupancy.'|'.$this->adults[$i].'|'.$this->childs[$i].$childsagestr.'|'.$this->adult_extrabed[$i].'|'.$this->child_extrabed[$i];
                          $roommealtype='PPPN'.'|'.($i+1).'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_meal_plan;   
                           $day=$day+1;
                           $s=$j;
                           $child_rate=0;      
                           $child_rate_det=json_decode($resultsarr_PPPN[$i][$j]->child_rate,true);
                           $childagerate=array();                 
                            if(!empty($child_rate_det[0]))
                            {                    
                              foreach ($child_rate_det as $key => $value)
                              { 
                                    $val=explode('||', $value);   
                                    $val1=explode('-', $val[0]);
                                    if($val1[0]>=$val1[1])
                                    {
                                        for($chr=$val1[1];$chr<=$val1[0];$chr++)
                                        {
                                            $childagerate[$chr]=$val[1];
                                        }
                                    }
                                    else
                                    {
                                       
                                        for($chr=$val1[0];$chr<=$val1[1];$chr++)
                                        {
                                            $childagerate[$chr]=$val[1];
                                        }
                                    }
                                }
                          }           
                        
                         if ($this->childs[$i] != 0)
                            {                         
                               $ages = explode(',', $this->childs_ages[$i]);   
                               for ($c = 0; $c < $this->childs[$i]; $c++)
                                {  
                                  
                                  $child_rate+=$childagerate[$ages[$c]];                
                                }
                            } 
                           $total_cost+=($this->adults[$i]*$resultsarr_PPPN[$i][$j]->adult_rate)+$child_rate+($this->adult_extrabed[$i]*$resultsarr_PPPN[$i][$j]->extra_bed_for_adults_rate)+($this->child_extrabed[$i]*$resultsarr_PPPN[$i][$j]->extra_bed_for_child_rate);;
                           $hotel_room_allotment[]=$resultsarr_PPPN[$i][$j]->sup_hotel_room_allotment_id;

                           // print_r($resultsarr_PPPN[$i]); echo "tsing";exit;  
                               // Supplement
                          $supplementdatacheck=array(
                               'hotel_code'=>$rt_hotel_code,
                               'room_code'=>$rt_room_code,
                               'supplier_id'=>$rt_supplier_id,
                               'contract_id'=>$rt_contract_id,
                               'market'=>$rt_market,
                               'meal_plan'=>$rt_meal_plan,
                               'avail_date'=>$resultsarr_PPPN[$i][$j]->room_avail_date,
                               );                    
                       $mandatory_supplements_check_arr=$this->Hotelcrs_Model->check_crs_hotels_normal_supplements_rates($supplementdatacheck,'other','Yes');

                     /* foreach($mandatory_supplements_check_arr as $supplementarr)
                      {

                      list($mandatory_supplementarr,$mandatory_supp_cost,$mandatory_supplement_mealplan,$spec_offer_applicable_supplement)=$this->supplements_check($supplementarr,$i);
                        $crs_mandatory_supplement[]=$mandatory_supplementarr;                          
                        $mandatory_supplement_cost+=$mandatory_supp_cost; 
                        $mandatory_suppmealplan=explode(',', $mandatory_supplement_mealplan);
                        foreach($mandatory_suppmealplan as $supp){
                        $mandatory_supplement_meal_plan[]=$supp;
                      }
                      }

                      $nonmandatory_supplements_check_arr=$this->Hotelcrs_Model->check_crs_hotels_normal_supplements_rates($supplementdatacheck,'other','No');
                      foreach($nonmandatory_supplements_check_arr as $supplementarr)
                      {

                      list($nonmandatory_supplementarr,$nonmandatory_supp_cost,$nonmandatory_supplement_mealplan,$spec_offer_applicable_supplement)=$this->supplements_check($supplementarr,$i);
                        $crs_nonmandatory_supplement[]=$nonmandatory_supplementarr;                                                
                       $nonmandatory_supplement_cost+=$nonmandatory_supp_cost;
                        $nonmandatory_suppmealplan=explode(',', $nonmandatory_supplement_mealplan);
                        foreach($nonmandatory_suppmealplan as $supp){
                        $nonmandatory_supplement_meal_plan[]=$supp;
                      }
                      }*/
                    }
                       
                    }
                    if($day==$this->nights)
                    {                                  
                        $indexarr[$i][$index]=$index;
                        $roommealarr[$i][$roommealtype]=$roommealtype;
                        $room_count_arr[$i]=$i;                       
                        $resultsarr_PPPN[$i][$s]->total_cost=$total_cost;
                        $resultsarr_PPPN[$i][$s]->net_fare=$total_cost;                      
                        $resultsarr_PPPN[$i][$s]->crs_mandatory_supplement=json_encode($crs_mandatory_supplement);
                        $mandatory_supplement_meal_plan=array_unique($mandatory_supplement_meal_plan);
                        $resultsarr_PPPN[$i][$s]->mandatory_supplement_meal_plan=implode(',',$mandatory_supplement_meal_plan);
                        $resultsarr_PPPN[$i][$s]->mandatory_supplement_cost=$mandatory_supplement_cost;
                        $resultsarr_PPPN[$i][$s]->mandatory_supplement_net_fare=$mandatory_supplement_cost;

                        $resultsarr_PPPN[$i][$s]->crs_nonmandatory_supplement=json_encode($crs_nonmandatory_supplement);
                        $nonmandatory_supplement_meal_plan=array_unique($nonmandatory_supplement_meal_plan);
                        $resultsarr_PPPN[$i][$s]->nonmandatory_supplement_meal_plan=implode(',',$nonmandatory_supplement_meal_plan);
                        $resultsarr_PPPN[$i][$s]->nonmandatory_supplement_cost=$nonmandatory_supplement_cost;
                        $resultsarr_PPPN[$i][$s]->nonmandatory_supplement_net_fare=$nonmandatory_supplement_cost;



                        $resultsarr_PPPN[$i][$s]->room_index=$i;
                        $resultsarr_PPPN[$i][$s]->index=$index;
                        $resultsarr_PPPN[$i][$s]->adult=$this->adults[$i];
                        $resultsarr_PPPN[$i][$s]->child=$this->childs[$i];
                         $resultsarr_PPPN[$i][$s]->adult_extrabed=$this->adult_extrabed[$i];
                        $resultsarr_PPPN[$i][$s]->child_extrabed=$this->child_extrabed[$i];
                        $resultsarr_PPPN[$i][$s]->nights=$this->nights; 
                        $resultsarr_PPPN[$i][$s]->childs_ages=$child_ages;
                        $resultsarr_PPPN[$i][$s]->type='Normal';
                        $resultsarr_PPPN[$i][$s]->hotel_room_allotment=implode(',', $hotel_room_allotment);                     
                         $cancelpolicy_arr=array(
                            'supplier_id'=>$resultsarr_PPPN[$i][$s]->supplier_id,
                            'sup_hotel_id'=>$resultsarr_PPPN[$i][$s]->sup_hotel_id,   
                            'hotel_code'=>$resultsarr_PPPN[$i][$s]->hotel_code,   
                            'room_code'=>$resultsarr_PPPN[$i][$s]->room_code,   
                            'contract_id'=>$resultsarr_PPPN[$i][$s]->contract_id,   
                            'sup_room_details_id'=>$resultsarr_PPPN[$i][$s]->sup_room_details_id,   
                            'market'=>$resultsarr_PPPN[$i][$s]->market,   
                            'meal_plan'=>$resultsarr_PPPN[$i][$s]->meal_plan,   
                            'rate_type'=>$resultsarr_PPPN[$i][$s]->rate_type,
                            'min_room_occupancy'=>$resultsarr_PPPN[$i][$s]->min_room_occupancy,   
                            'max_room_occupancy'=>$resultsarr_PPPN[$i][$s]->max_room_occupancy,   
                            'min_adults_without_extra_bed'=>$resultsarr_PPPN[$i][$s]->min_adults_without_extra_bed,   
                            'max_adults_without_extra_bed'=>$resultsarr_PPPN[$i][$s]->max_adults_without_extra_bed,   
                            'min_child_without_extra_bed'=>$resultsarr_PPPN[$i][$s]->min_child_without_extra_bed,   
                            'max_child_without_extra_bed'=>$resultsarr_PPPN[$i][$s]->max_child_without_extra_bed,   
                            'extra_bed_for_adults'=>$resultsarr_PPPN[$i][$s]->extra_bed_for_adults,   
                            'extra_bed_for_child'=>$resultsarr_PPPN[$i][$s]->extra_bed_for_child,   
                          );
                $cancellation_policy=$this->Hotelcrs_Model->check_crs_hotels_normal_cancel_policy($cancelpolicy_arr,$checkIn);                                     

                    $cancel_policy='';
                    $hotel_crs_cancellation_json=array();
                    if(!empty($cancellation_policy[0]))
                    {
                      for($can=0,$incre=0;$can<count($cancellation_policy);$can++)
                      {
                        $last_date = $cancellation_policy[$can]->days_before_checkin;                     
                        if($last_date!=0)
                        {
                        $cancel_date = date('Y-m-d', strtotime('-' . $last_date . ' days ', strtotime($checkIn)));
                        }
                        else
                        {
                         $cancel_date = $checkIn; 
                        }
                       if($can==0 ||($can>=1&&$cancellation_policy[$can]->days_before_checkin!=$cancellation_policy[($can-1)]->days_before_checkin))
                       {                               
                         if($cancellation_policy[$can]->cancel_rates_type=='non_refundable')
                         {
                           $cancel_policy ='<p>Non Refundable</p>';
                           $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;                        
                         }
                         if($cancellation_policy[$can]->cancel_rates_type=='fullstay')
                         {
                          $cancel_policy_str='Full Stay Charge';

                           $cancel_policy .= '<p>Full Stay Charge. If cancelled on ' . $cancel_date . ' </p>';
                       $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }        
                        if($cancellation_policy[$can]->cancel_rates_type=='fixed'){
                          $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . ' '.$resultsarr_PPPN[$i][$s]->currency_type.' will charged. If cancelled on ' . $cancel_date . ' </p>';
                        $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }
                        if($cancellation_policy[$can]->cancel_rates_type=='percentage')
                        {
                          $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . '% will charged. If cancelled on ' . $cancel_date . ' </p>';
                        $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                        }
                     }                   
                    
                    }
                  }
                  $resultsarr_PPPN[$i][$s]->cancel_policy=$cancel_policy;
                  $resultsarr_PPPN[$i][$s]->hotel_crs_cancellation_json=json_encode($hotel_crs_cancellation_json);  
                   $results[$index]=$resultsarr_PPPN[$i][$s]; 

                  } 
                }
             }
         
       }
   }            
  
   //echo "<pre>"; print_r($results); exit;
     $insertrooms=array();
     $ro=0;
     foreach ($results as $result)
     {
      // $checkroom=$this->Hotelcrs_Model->check_hotel_room_search($this->api,$this->sess_id,$result->hotel_code,$result->room_code);
    $checkroom=$this->Hotelcrs_Model->check_hotel_room_search($this->api,$this->sess_id,$result->hotel_code,$result->room_code,$result->room_index);
     //echo $this->db->last_query();exit;
      if(empty($checkroom))
      {
       $room_details_info=array(
          'supplier_id'=>$result->supplier_id,
          'sup_hotel_id'=>$result->sup_hotel_id,   
          'hotel_code'=>$result->hotel_code,   
          'room_code'=>$result->room_code,   
          'contract_id'=>$result->contract_id,   
          'sup_room_details_id'=>$result->sup_room_details_id,   
          'market'=>$result->market,   
          'meal_plan'=>$result->meal_plan,   
          'rate_type'=>$result->rate_type,
          'min_room_occupancy'=>$result->min_room_occupancy,   
          'max_room_occupancy'=>$result->max_room_occupancy,   
          'min_adults_without_extra_bed'=>$result->min_adults_without_extra_bed,   
          'max_adults_without_extra_bed'=>$result->max_adults_without_extra_bed,   
          'min_child_without_extra_bed'=>$result->min_child_without_extra_bed,   
          'max_child_without_extra_bed'=>$result->max_child_without_extra_bed,   
          'extra_bed_for_adults'=>$result->extra_bed_for_adults,   
          'extra_bed_for_child'=>$result->extra_bed_for_child,   
         );
       
        $this->load->module('hotels/hotel_markup');
        $markup_array = $this->hotel_markup->markup_calculation($this->city_code,$result->net_fare, $this->nationality, $this->api,$result->hotel_code);



        $insertrooms[$ro] =array(
            'session_id' => $this->sess_id,
            'uniqueRefNo' => $this->Sys_RefNo,
            'hotel_supplier_id'=>$result->supplier_id,
            'api' => $this->api,
            'city_code' => $this->city_code,
            'city_name' => $this->city_name,
            'hotel_code' => $result->hotel_code,
            'conversation_id'=>$result->type,
            'rate_plan_code'=>$result->rate_type,
            'rate_basis_id'=>$result->sup_hotel_room_rates_list_id,
            'rate_basis_desc'=>$result->index,
            'unique_cityid' => $this->city_code,
            'hotel_name' => $result->hotel_name,
            'room_name' => $result->room_name,
            'room_code' => $result->room_code,
            'room_description'=>$result->room_desc,
            'hotel_property_id'=>$result->hotel_room_allotment,
            'contractnameVal'=>$result->contract_id,
            'hbzoneName'=>$result->market,
            'room_details_info'=>json_encode($room_details_info),
            'room_type' => $result->room_type,
            'description' => $result->hotel_desc,
            'child_age' => $result->childs_ages,
            'board_type'=>$result->meal_plan,
            'adult' => $result->adult,
            'child' => $result->child,
            'adult_extrabed' => isset($result->adult_extrabed)?$result->adult_extrabed:0,
            'child_extrabed' => isset($result->child_extrabed)?$result->child_extrabed:0,
            'room_count' => $this->rooms,
            'room_runno'=>$result->room_index,
            'nights'=>$result->nights,
            'image' => $result->thumb_img,
            'hotel_address' => $result->address,
            'amenities' => $result->hotel_facilities,
            'room_amenities' => $result->room_facilities,
            'cancel_policy'=>$result->cancel_policy,
            'star' => $result->hotel_star_rating,
            'xml_currency' => $result->currency_type,
            'currency' => $result->currency_type,
            'org_amt' => $result->total_cost+$result->mandatory_supplement_cost,
            'crs_mandatory_supplement'=>$result->crs_mandatory_supplement,
            'mandatory_supplement_cost'=>$result->mandatory_supplement_cost,
            'mandatory_supplement_meal_plan'=>$result->mandatory_supplement_meal_plan,
            'mandatory_supplement_net_fare'=>$result->mandatory_supplement_net_fare,
            'crs_nonmandatory_supplement'=>$result->crs_nonmandatory_supplement,
            'nonmandatory_supplement_cost'=>$result->nonmandatory_supplement_cost,
            'nonmandatory_supplement_meal_plan'=>$result->nonmandatory_supplement_meal_plan,
            'nonmandatory_supplement_net_fare'=>$result->nonmandatory_supplement_net_fare,
            'currency_conv_value' => $markup_array['total_cost']+$result->mandatory_supplement_cost,
            // 'total_cost' =>$result->total_cost+$result->mandatory_supplement_cost,
            'total_cost' => $markup_array['total_cost']+$result->mandatory_supplement_cost,
            'admin_markup' => $markup_array['admin_markup'],
            'agent_markup' => $markup_array['agent_markup'],
            'payment_charge' => $markup_array['payment_charge'],
            'net_fare'=>$result->net_fare+$result->mandatory_supplement_net_fare,
            'ROE' => 1,
            'hotel_crs_cancellation_json'=>$result->hotel_crs_cancellation_json,
            );
        // echo '<pre>4';print_r($insertrooms[$ro]);exit;

            $insert_permanent = array(
                                'api' => $this->api,
                                'hotel_code' => $result->hotel_code,
                                'hotel_name' => $result->hotel_name,
                                'hotel_name_unique'=>str_replace(" ","",$result->hotel_name),
                                'star' => $result->hotel_star_rating,
                                'city_code'=>$this->city_code,
                                'city_name' => $this->city_name,
                                'address' => $result->address,
                                'phone'=>$result->mobile,
                                'description'=>$result->hotel_desc,
                                'latitude'=>$result->latitude,
                                'longitude'=>$result->longitude,
                                );
            $this->db->insert('api_permanent_hotels', $insert_permanent);
            $ro++;
        }
     }

        if (!empty($insertrooms)&&count($room_count_arr)==$this->rooms) 
        {
          $this->Hotelcrs_Model->insert_crs_data($insertrooms);
          //echo $this->db->last_query();exit;

        } 
  }

function supplements_check($supplementarr,$i)
  {     
  
       $supplement_child_rate=0;      
       $supplement_child_rate_det=json_decode($supplementarr->supplement_child_agerange_rate,true);
         $supplement_childagerate=array();                 
          if(!empty($supplement_child_rate_det[0]))
          {                    
            foreach ($supplement_child_rate_det as $key => $value)
            { 
                  $val=explode(':', $value);   
                  $val1=explode('||', $val[1]);
                  if($val1[0]>=$val1[1])
                  {
                      for($chr=$val1[1];$chr<=$val1[0];$chr++)
                      {
                          $supplement_childagerate[$chr]=$val[0];
                      }
                  }
                  else
                  {
                     
                      for($chr=$val1[0];$chr<=$val1[1];$chr++)
                      {
                          $supplement_childagerate[$chr]=$val[0];
                      }
                  }
              }
        }           
      
       if ($this->childs[$i] != 0)
          {                         
             $ages = explode(',', $this->childs_ages[$i]);   
             for ($c = 0; $c < $this->childs[$i]; $c++)
              {  
                
                $supplement_child_rate+=$supplement_childagerate[$ages[$c]];                
              }
          }            
         
          $supp_childrate=0;        
          foreach($supplement_childagerate as $key=>$val)
          {           
            if($val>$supp_childrate)
            {
              $supp_childrate=$val; 
            }
          }

          $supp_cost=(($this->adults[$i]+$this->adult_extrabed[$i])*$supplementarr->supplement_adult_rate)+$supplement_child_rate+($supp_childrate*$this->child_extrabed[$i]);
        return array($supplementarr,$supp_cost,$supplementarr->supplement_meal_plan,$supplementarr->spec_offer_applicable_supplement);


  }

   public function fetch_search_result() {
        $temp_data = $this->Hotelcrs_Model->fetch_search_result($this->sess_id, $this->api);
        // echo '<pre/>';print_r($temp_data);exit;
        if (empty($temp_data)) {
            $this->session->unset_userdata('hotel_search_activate');
        }

        $data['result'] = $temp_data;
        $hotels_search_result = $this->load->view('hotel_crs/search_result_ajax', $data, true);

        echo json_encode(array(
            'hotels_search_result' => $hotels_search_result
        ));
    }

 public function hotel_details($hotelCode, $searchId)
  {

        $data['searchId'] = $searchId;
        $data['hotelDetails'] = $hotelDetails = $this->Hotelcrs_Model->getHotelDetails($hotelCode, $searchId); 
        $data['hotelImages'] = $this->Hotelcrs_Model->getHotelImages($hotelCode);
        // $data['facilities'] = $this->Hotelcrs_Model->get_facility_details($amenities);
        // $data['hotelDescriptions'] = $this->Hotelcrs_Model->getHotelDescriptions($hotelCode);
         $data['hotelFacilities'] = $this->Hotelcrs_Model->get_hotel_facility_details($hotelCode);
        // $data['countries'] = $this->Hotelcrs_Model-> ();
         // echo '<pre/>';print_r($data['hotelFacilities']);exit;
        $data['latitude'] = $hotelDetails->latitude;
        $data['longitude'] = $hotelDetails->longitude;

        // echo '<pre/>';print_r($data['hotelDetails']);exit;

        // $this->load->library('googlemaps');
        // $config['center'] = "$hotelDetails->latitude, $hotelDetails->longitude";
        // $config['zoom'] = '11';
        // $this->googlemaps->initialize($config);

        // $marker = array();
        // $marker['position'] = "$hotelDetails->latitude, $hotelDetails->longitude";
        // $marker['infowindow_content'] = "$hotelDetails->hotel_name <br/> $hotelDetails->city_name <br /> $hotelDetails->address";
        // $this->googlemaps->add_marker($marker);
        // $data['map'] = $this->googlemaps->create_map();

        $this->load->view('hotel_crs/hotel_details', $data);
    }

function rooms_availability($session_id, $hotelCode) 
{

    $this->set_variables();
    $room_info = $this->Hotelcrs_Model->get_hotel_rooms($session_id, $hotelCode);
    //echo $this->db->last_query();exit;
    $set_currency = $this->session->userdata('default_currency');
    $set_curr_val = $this->session->userdata('currency_value');
    $showRoom = '';
    $dataroom['room_info']=$room_info;
    $showRoom .= $this->load->view('hotel_crs/rooms_available', $dataroom, TRUE);
    echo json_encode(array('rooms_result' => $showRoom));    
}

    public function nearby_hotels($session_id, $hotelCode, $latitude, $longitude, $city) {
        $nearby_hotels = $this->Hotelcrs_Model->get_nearby_hotels($session_id, $hotelCode, $latitude, $longitude, $city);
              // echo '<pre/>';print_r($nearby_hotels);exit;    
        $showHotels = '';
        if (!empty($nearby_hotels)) {
            for ($t = 0; $t < count($nearby_hotels); $t++) {
                $review = rand(100, 500);
                $rating = rand(1, 5);
                // $showHotels .='<div class="col-md-12 htl-type">';
                // echo '<pre/>';print_r($nearby_hotels);exit;
                if (!empty($nearby_hotels[$t]->image) && isset($nearby_hotels[$t]->image)) { 

                  if($nearby_hotels[$t]->api == 'hotel_crs') {
                    $gttd = base_url().'supplier/'.$nearby_hotels[$t]->image;
                  } else {
                    $gttdarr = explode(',', $nearby_hotels[$t]->image);
                    $gttd = $gttdarr[0];
                    // $gttd = base_url().'public/images/hotels/1.jpg';
                  }

                  $image ='<img src="'.$gttd.'" alt="'.$nearby_hotels[$t]->hotel_name.'" title="'.$nearby_hotels[$t]->hotel_name .'" class="img-responsive img-full" style="height:250px">';
                } else {
                    $image ='<img src="'.base_url().'public/img/noimage.jpg" alt="No Image" class="img-responsive img-full" style="height:250px" />';
                }

            $star = '';
             // echo '<pre>';print_r($nearby_hotels);
              for($s=0;$s<$nearby_hotels[$t]->star;$s++){
              $star .= '<i class="fa fa-star"></i>';
            }

          $showHotels .= '<div class="col-xs-12 col-sm6 col-md-3">
                  <div class="item">
                    <div class="featured-image">
                      <a href="#">
                        '.$image.'
                      </a>
                      <div class="st-stars ">
                        '.$star.'
                      </div>
                    </div>
                    <h4 class="title"><a href="#" class="st-link c-main">'.$nearby_hotels[$t]->hotel_name.'</a></h4>
                    <div class="sub-title">
                    <i class="input-icon field-icon fa"><img src="'.base_url().'public/images/svg/ico_map.svg"></i>'.$nearby_hotels[$t]->city_name.'</div>
                    <div class="reviews">
                      <span class="rate">1.4/5 Poor</span><span class="summary">1 review</span>
                    </div>
                    <div class="price-wrapper">from <span class="price">$'.$nearby_hotels[$t]->org_amt.'</span><span class="unit">/night</span></div>
                  </div>
                  </div>';
                /*$showHotels .='<div class="htl-type-dtls">
                <div class="row"> 
                  <div class="col-md-12 htlDetailsCntr">
                    <div class="htlname">' . $nearby_hotels[$t]->hotel_name . '</div>
                    
                    <div class="htllocation"> <i class="fa fa-map-marker"></i> Area: ' . $nearby_hotels[$t]->hotel_city . ', ' . $nearby_hotels[$t]->hotel_country . ' </div>
                    <form name="frmHotelDetails" method="post" action="' . site_url() . '/hotels/details">
                      <input type="hidden" name="callBackId" value="' . base64_encode('hotel_crs') . '" />
                      <input type="hidden" name="hotelCode" value="' . $nearby_hotels[$t]->hotel_code . '" />
                      <input type="hidden" name="searchId" value=' . $nearby_hotels[$t]->search_id . ' />
                      <div class="row"><button class="btn btn-primary modify-search-btn">VIEW DETAILS </button></div>
                    </form>
                  </div>
                </div>
						</div>
					  </div>';*/
            }
        }

        $related_hotels = $this->Hotelcrs_Model->get_related_hotels($session_id, $hotelCode, $latitude, $longitude, $city);
        //$related_hotels = $this->Hotelcrs_Model->get_nearby_hotels($session_id,$hotelCode,$latitude,$longitude,$city);	
        //echo '<pre/>';print_r($related_hotels);exit;	
        $showRelatedHotels = '';
        if (!empty($related_hotels)) {
            for ($t = 0; $t < count($related_hotels); $t++) {
                $review = rand(100, 500);
                $rating = rand(1, 5);
                $showRelatedHotels .='<div class="col-md-12 htl-type">';
                if (!empty($related_hotels[$t]->image) && isset($related_hotels[$t]->image)) {

                    $image_name = explode(',', $related_hotels[$t]->image);
                    if (strpos($image_name[0], "http") !== false) {
                        $gttd = $image_name[0];
                    } else {
                        $gttd = 'http://www.roomsxml.com' . $image_name[0];
                    }

                    $showRelatedHotels .='<img src="' . $gttd . '" width="100" height="100" alt="' . $related_hotels[$t]->hotel_name . '" title="' . $related_hotels[$t]->hotel_name . '" border="0" />';
                } else {
                    $showRelatedHotels .='<img src="' . base_url() . 'public/img/default-htl-img.jpg" width="100" height="100" alt="No Image" border="0" />';
                }

                $showRelatedHotels .='<div class="htl-type-dtls">
                  <div class="row">
                    <div class="col-md-12 htlDetailsCntr">
                      <div class="htlname">' . $related_hotels[$t]->hotel_name . '</div>
                      
                      <div class="htllocation"> <i class="fa fa-map-marker"></i> Area: ' . $related_hotels[$t]->hotel_city . ', ' . $related_hotels[$t]->hotel_country . ' </div>
                      <form name="frmHotelDetails" method="post" action="' . site_url() . '/hotels/details">
                        <input type="hidden" name="callBackId" value="' . base64_encode('hotel_crs') . '" />
                        <input type="hidden" name="hotelCode" value="' . $related_hotels[$t]->hotel_code . '" />
                        <input type="hidden" name="searchId" value=' . $related_hotels[$t]->search_id . ' />
                        <div class="row"><button class="btn btn-primary modify-search-btn">VIEW DETAILS </button></div>
                      </form>
                    </div>
                  </div>
                  </div>
                  </div>';
            }
        }

        //return $showHotels;
        echo json_encode(array(
            'nearby_hotels' => $showHotels,
            'related_hotels' => $showRelatedHotels
        ));
    }

public function hotel_itinerary($session_id, $hotelCode, $searchId,$supplement_check='') {

    $this->session_check();
    $this->set_variables();
    $roomDetails=array();
    $supplement_cost=0;
    $net_cost=0;
    $total_cost=0;
    // $discount = 0;
    $cancel_policy='';
    $supp_check=array();
    
    foreach ($supplement_check as $supchk) {
        $val1=explode('_', $supchk);
        $this->Hotelcrs_Model->update_nonmandatory_supplement_check($this->api, $session_id, $hotelCode, $val1[0],$val1[1]); 
        $supp_check[]=$val1[0];     
       
    }
    
     foreach ($searchId as $val) { 
          if(!in_array($val, $supp_check)) {
            $this->Hotelcrs_Model->update_nonmandatory_supplement_check($this->api, $session_id, $hotelCode, $val,"No");  

          }
          // echo 1;
         $roomDetails[]= $searchrooms = $this->Hotelcrs_Model->get_merged_rooms($this->api, $session_id, $hotelCode, $val);
        // echo $this->db->last_query();
        // echo '<pre>';print_r($searchrooms);exit;
        $discount = $searchrooms->discount;
        $total_cost +=$searchrooms->total_cost;
        $net_cost +=$searchrooms->org_amt;

         if($searchrooms->nonmandatory_supplement_check=="Yes") {
          $supplement_cost+=$searchrooms->nonmandatory_supplement_cost;
         }
         if(!empty($searchrooms->cancel_policy)){
          $cancel_policy.='Room'.($searchrooms->room_runno+1).'<br>'.$searchrooms->cancel_policy; 
        }
      }
      // echo 2;exit;
    $data['tempSearchId'] =implode(',',$searchId);
    $data['total_cost'] = $total_cost;
    $data['org_amt'] = $net_cost;
    $data['discount'] = $discount;
    $data['supplement_cost'] = $supplement_cost;
    $data['roomDetails']=$roomDetails[0];
    $data['countries'] = $this->Hotelcrs_Model->get_country_list();
     // echo '<pre>';print_r($discount);exit;
    if($discount == '0'){
         $data['message'] = "Your Promo is Expired";
    }
    $data['cancel_policy']=$cancel_policy;
    if (!empty($roomDetails)) { //print_r($roomDetails);exit;
        $this->load->view('hotel_crs/hotel_itinerary', $data);
    }else {
        $error = 'One of the selected room type is not available. Please search again';
        redirect('home/error_page/' . base64_encode($error));
        exit;
    }
}

public function updatePaytype($session_id, $hotelCode, $searchId){
    $searchIds =explode(',',$searchId);
    
    $org_amt = 0;$total_cost = 0;
    foreach ($searchIds as $val) {
        $res = $this->Hotelcrs_Model->getRoomDetails('hotel_crs', $sessionId, $hotelCode, $val);
        $payhotel = 0;
        if($_POST['paytype'] == 'hotelpay'){
            $payhotel = $res->total_cost-$res->org_amt;
        }
        
        $data = array(
            'payhotel' => $payhotel
        );
        $this->db->where('search_id',$val);
        $this->db->where('session_id',$sessionId);
        $this->db->where('hotel_code',$hotelCode);
        $this->db->update('hotel_search_result',$data);
    }

}

public function updatepromovalue($session_id, $hotelCode, $searchId){
    $searchIds =explode(',',$searchId);
    
    $org_amt = 0;$total_cost = 0;
    foreach ($searchIds as $val) {
        $res = $this->Hotelcrs_Model->getRoomDetails('hotel_crs', $session_id, $hotelCode, $val);
        $payhotel = 0;
        // echo '<pre>';print_r($res);exit;

        $coupon = $this->input->post('coupon_code');
        $date = $this->input->post('date');
        // echo '<pre>';print_r($date);exit;
        $promo_result = $this->Hotels_Model->get_promo_details($coupon,$date);
        // echo '<pre>';print_r($promo_result);exit;

        if($promo_result[0]->discount_type == 2){
            $discount = $promo_result[0]->discount;
        } else {
            $discount = $res->total_cost * ($promo_result[0]->discount/100);

        }

        // $total_cost = $res->total_cost - $discount;
        $data = array(
            'discount_coupon' => $coupon,
            'without_discount' => $res->total_cost,
            'discount' => $discount,
            // 'total_cost' => $total_cost,
            // 'payhotel' => $payhotel,
        );
      
        $this->db->where('search_id',$val);
        $this->db->where('session_id',$session_id);
        $this->db->where('hotel_code',$hotelCode);
        $this->db->update('hotel_search_result',$data);
        // echo $this->db->last_query();exit;
    }

    $this->hotel_itinerary($session_id, $hotelCode, $searchIds);

}



public function hotel_reservation($sessionId, $hotelCode, $searchId) {
    // echo '<pre>';print_r($_POST);exit;
    // $this->session_check();
    $this->set_variables();
    $searchIds =explode(',',$searchId);
    $roomDetailsdata=array();
    foreach ($searchIds as $val) {
       $roomDetailsdata[]= $this->Hotelcrs_Model->getRoomDetails($this->api, $sessionId, $hotelCode, $val);
    }

    if (!empty($roomDetailsdata)) {
        list($booking_id,$roomDetails)= $this->crs_booking($sessionId, $hotelCode,$searchId,$roomDetailsdata);
        // echo '<pre>';print_r($roomDetails);exit;
        if (!empty($booking_id)) {
            $Book_Status = 'Confirmed';
        }else {
            $Book_Status = 'Fail';
        }

        $payhotel=0;
        $org_amt=0;
        $total_cost=0;
        $admin_markup=0;
        $admin_agent_markup=0;
        $di_markup= 0;
        $di_agent_markup= 0;
        $sub_agent_markup= 0;
        $payment_charge= 0;
        $user_id=0;
        $agent_id=0;
        $Booking_Date = date('Y-m-d');
        $Sys_RefNo = $this->Sys_RefNo;
        $room_type_name='';
        $cancel_policy='';
        foreach ($roomDetails as $res) {
          //  print_r($res);exit;
          $org_amt+= $res->org_amt;
          $total_cost+= $res->total_cost;
          $payhotel+= $res->payhotel;
          $admin_markup+= $res->admin_markup;
          $admin_agent_markup+= $res->admin_markup+$res->agent_markup;
          $agent_markup+= $res->agent_markup;
          // $di_markup+= $res->di_markup;
          // $di_agent_markup+= $res->di_agent_markup;
          // $sub_agent_markup+= $res->sub_agent_markup;
          $payment_charge+= $res->payment_charge; 
          $board_type=$this->Hotelcrs_Model->get_supplement_meal_plan($res->board_type);
          $supplement_meal_plan_str=$this->Hotelcrs_Model->get_supplement_meal_plan($res->nonmandatory_supplement_meal_plan);
          $supp_meal_plan_str='';

          if(!empty($supplement_meal_plan_str)) {
            $supp_meal_plan_str='  | Supplement ( '.$supplement_meal_plan_str.' )';
          }
          $booking_code_str='';
          if(!empty($res->hotel_crs_booking_code)) {
            $booking_code_str=' | Booking Code ( '.$res->hotel_crs_booking_code.' )';
          }
          $inclusion .= $board_type.', ';
          $room_type_name.=$res->room_name.' '.$res->room_type.' | Inclusion ( '.$board_type.' ) '.$supp_meal_plan_str.$booking_code_str.'<br>';
          $cancel_policy.='Room'.($res->room_runno+1).'<br>'.$res->cancel_policy;
        }

        if ($this->session->userdata('user_logged_in')) {
            $user_id = $this->session->userdata('user_id');
            $Booking_Done_By = 'user';
            $agent_type = '0';
            $agent_id = 0;
            $deposit_withdraw_markup = '0';
        } else if ($this->session->userdata('agent_logged_in')) {
            $agent_id = $this->session->userdata('agent_id');
            $Booking_Done_By = 'Admin Agent';
            $agent_type = '1';
            $user_id = 0;
            $totsend = $total_cost;
            $deposit_withdraw_markup = $admin_agent_markup;
        } else if ($this->session->userdata('corporate_sub_logged_in')) {
            $agent_id = $this->session->userdata('agent_id');
            $Booking_Done_By = 'Admin Agent';
            $agent_type = '3';
            $user_id = 0;
            $totsend = $total_cost;
            $deposit_withdraw_markup = $admin_agent_markup;
        }else {
            $agent_id = 0;
            $user_id = 0;
            $agent_type = 0;
            $Booking_Done_By = 'guest';
            $deposit_withdraw_markup = '0';
        }
        
        if ($this->session->userdata('agent_logged_in') || 
                $this->session->userdata('corporate_sub_logged_in')) {
            $pay_type = 'deposit';
            $deposit_check_status = $this->deposit_check($roomDetails);
            //print $deposit_check_status."".$this->uniqueRefNo;exit;
            if ($deposit_check_status == 1) {
                $error = 'Your Balance is too low to make this booking';
                redirect('home/error_page/' . base64_encode($error), 'refresh');
                exit;
            } elseif ($deposit_check_status == 0) {
                $this->deposit_withdraw($totsend, $deposit_withdraw_markup, $this->uniqueRefNo);
            }
        } else {
          $pay_type = 'payment_gateway';
        } 

        $bookingDetails = $this->Hotelcrs_Model->getBookingDetails();
        // echo '<pre>';print_r($bookingDetails);exit;
        $invoice_no = 0;$uniqueno='';
        if (!empty($bookingDetails)) {
            $invoice_no = $bookingDetails->invoice_no;
            $uniqueno = $bookingDetails->uniqueRefNo;
        }
        if(trim($Sys_RefNo) == trim($uniqueno)){
            $n = substr($invoice_no, 8,12);
        } else {
            $n = substr($invoice_no, 8,12)+1;
        }
        $invoice_no = 'TVN'.date('ym').str_pad($n,6,0,STR_PAD_LEFT);

        $insertbookingdata = array(
            'user_id' => $user_id,
            'agent_id' => $agent_id,
           // 'supplier_id'=>$roomDetails[0]->supplier_id,
            'Api_Name'=>'hotel_crs',
            'Hotel_RefNo' => '',
            'Booking_RefNo' => $booking_id,
            'uniqueRefNo' => $Sys_RefNo,
            'Booking_Status' => $Book_Status,
            'Booking_Date' => $Booking_Date,
            'Booking_Amount' => $total_cost-$payhotel,
            'Net_Amount' => $org_amt,
            'Deducted_Amount' => $org_amt,
            'total_cost' => $total_cost,           
            'Admin_Markup' => $admin_markup,
            'Agent_Markup' => $admin_agent_markup,            
            'Payment_Charge' => $payment_charge, 
            'cancel_policy' =>$cancel_policy,          
            'Currecy' => $roomDetails[0]->xml_currency,
            'Xml_Currency' => $roomDetails[0]->xml_currency,            
            'payment_type'=>$pay_type,   
            'tbo_invoice_no'=>$invoice_no,
        );
        // echo '<pre>';print_r($insertbookingdata);exit;
        $this->db->insert('hotel_booking_reports', $insertbookingdata);
        //echo  $this->db->last_query();exit;
   
        $hotel_search_data = $this->session->userdata('hotel_search_data');
        $user_email = $hotel_search_data['user_email'];
        // Hotel Booking Hotels Information Data
        $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $hotel_search_data['checkIn'])));
        $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $hotel_search_data['checkOut'])));

        $this->Hotelcrs_Model->insert_hotel_booking_information_data($user_id, $agent_id, $Sys_RefNo, $roomDetails[0]->hotel_code, $roomDetails[0]->room_code, $roomDetails[0]->hotel_name, $hotel_search_data['cityName'], $checkIn, $checkOut, $Booking_Date, $hotel_search_data['rooms'], $this->nights, 'hotel_crs', $roomDetails[0]->hotel_star_rating, $roomDetails[0]->image, $roomDetails[0]->hotel_desc, $roomDetails[0]->address, $roomDetails[0]->hotel_phone, $roomDetails[0]->hotel_fax, $hotel_search_data['adults_count'], $hotel_search_data['childs_count'], $hotel_search_data['adults'], $hotel_search_data['childs'], $hotel_search_data['childs_ages'], $roomDetails[0]->cancel_policy,$hotel_search_data['adult_extrabed_count'], $hotel_search_data['child_extrabed_count'], $hotel_search_data['adult_extrabed'], $hotel_search_data['child_extrabed'],$inclusion,$room_type_name);


        // echo $this->db->last_query();exit;
        $voucher_content = $this->load->view('voucher_content', $data, true);
        $data_email = array(
        'ticket_url' => site_url().'/hotels/voucher?voucherId='.$Sys_RefNo.'&bookId='.$booking_id,
        'user_email' => $user_email,             
        'subject' => 'Hotel Booking - ( '.$Sys_RefNo.' )'

        );
        $this->Email_Model->ticketing_mail($data_email,$voucher_content);
        redirect('hotels/voucher?voucherId=' . $Sys_RefNo . '&hotelRefId=' . $booking_id, 'refresh');

    } else {
        $this->hotel_itinerary($sessionId, $hotelCode, $searchId);
    }
}

    public function check_rates_and_room_availability($sessionId, $hotelCode,$roomDetails) {
          // echo "<pre>"; print_r($roomDetails);exit;
          $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $this->cin)));
          $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $this->cout)));
          $allotment_arr=array();
          $check_availiablity = true;
          $check_rates = true;
          $tot_cost = 0;
          $dis_cost = 0;
          $net_cost=0;
          $total_cost_arr=array();
          $net_fare_arr=array();
          $discount_arr=array();
          for($i=0;$i<count($roomDetails);$i++)
          {
            $allotment_id=explode(',',$roomDetails[$i]->hotel_property_id);
            // print_r($allotment_id);
            foreach ($allotment_id as $val)
            {
              if(isset($allotment_arr[$val]))
              {
                $allotment_arr[$val]=($allotment_arr[$val]+1);
              }
              else
              {
                $allotment_arr[$val]=1;
              }
            }
          }
          
          for($i=0;$i<count($roomDetails);$i++)
          {
            if($roomDetails[$i]->conversation_id=="Normal")
            {
              $room_details_info=json_decode($roomDetails[$i]->room_details_info,true);
              // echo "<pre>"; print_r($room_details_info);
              $dataarray=array(
                      'sup_hotel_id'=>$room_details_info['sup_hotel_id'], 
                      'supplier_id'=>$room_details_info['supplier_id'],  
                      'hotel_code'=>$room_details_info['hotel_code'],   
                      'room_code'=>$room_details_info['room_code'],   
                      'contract_id'=>$room_details_info['contract_id'],   
                      'sup_room_details_id'=>$room_details_info['sup_room_details_id'],   
                      'market'=>$room_details_info['market'],   
                      'meal_plan'=>$room_details_info['meal_plan'],   
                      'rate_type'=>$room_details_info['rate_type'],
                      'min_room_occupancy'=>$room_details_info['min_room_occupancy'],   
                      'max_room_occupancy'=>$room_details_info['max_room_occupancy'],   
                      'min_adults_without_extra_bed'=>$room_details_info['min_adults_without_extra_bed'],   
                      'max_adults_without_extra_bed'=>$room_details_info['max_adults_without_extra_bed'],   
                      'min_child_without_extra_bed'=>$room_details_info['min_child_without_extra_bed'],   
                      'max_child_without_extra_bed'=>$room_details_info['max_child_without_extra_bed'],   
                      'extra_bed_for_adults'=>$room_details_info['extra_bed_for_adults'],   
                      'extra_bed_for_child'=>$room_details_info['extra_bed_for_child'],   
                       );

            if($roomDetails[$i]->rate_plan_code=="PRPN")
            {      
             $check_prices = $this->Hotelcrs_Model->check_crs_hotels_price($dataarray,$checkIn,$checkOut,$roomDetails[$i]->rate_plan_code);    
             $cp=0;
             if(!empty($check_prices))
             {
             foreach($check_prices as $chp)
             {  
              if($chp->room_rate==0)
               { 
                $check_rates=false; break; 
               }
               if(isset($total_cost_arr[$roomDetails[$i]->search_id]))
               {      
                  $total_cost_arr[$roomDetails[$i]->search_id]=$total_cost_arr[$roomDetails[$i]->search_id]+($chp->room_rate+($roomDetails[$i]->adult_extrabed*$chp->extra_bed_for_adults_rate)+($roomDetails[$i]->child_extrabed*$chp->extra_bed_for_child_rate));
                 $cp=$cp+1;       
               }
               else
               {        
                 $total_cost_arr[$roomDetails[$i]->search_id]=$chp->room_rate+($roomDetails[$i]->adult_extrabed*$chp->extra_bed_for_adults_rate)+($roomDetails[$i]->child_extrabed*$chp->extra_bed_for_child_rate);
                 $cp=$cp+1;
                }  
             }

                    $nonmandatory_supp_cost=0;          
                    if($roomDetails[$i]->nonmandatory_supplement_check=="Yes")
                    {
                      $nonmandatory_supp_cost=$roomDetails[$i]->nonmandatory_supplement_cost;  
                    }


                   $total_cost_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_cost+$nonmandatory_supp_cost;
                $net_fare_arr[$roomDetails[$i]->search_id]=$total_cost_arr[$roomDetails[$i]->search_id];
                 $discount_arr[$roomDetails[$i]->search_id]=0;

           }
              if($cp!=$roomDetails[$i]->nights)
               { 
                $check_rates=false; break; 
              }
                  
            }
           if($roomDetails[$i]->rate_plan_code=="PPPN")
            {
             $check_prices= $this->Hotelcrs_Model->check_crs_hotels_price($dataarray,$checkIn,$checkOut,$roomDetails[$i]->rate_plan_code);
               $cp=0;
                if(!empty($check_prices))
               {
               foreach($check_prices as $chp)
               {  
                  $child_rate=0; 
                  $child_rate_det=json_decode($chp->child_rate,true);
                  $childagerate=array();  
                  if($chp->adult_rate==0)
                   { 
                    $check_rates=false; break; 
                   }
                  if(!empty($child_rate_det[0]))
                  {                    
                    foreach ($child_rate_det as $key => $value)
                    { 
                          $val=explode('||', $value);   
                          $val1=explode('-', $val[0]);
                          if($val1[0]>=$val1[1])
                          {
                              for($chr=$val1[1];$chr<=$val1[0];$chr++)
                              {
                                  $childagerate[$chr]=$val[1];
                              }
                          }
                          else
                          {
                             
                              for($chr=$val1[0];$chr<=$val1[1];$chr++)
                              {
                                  $childagerate[$chr]=$val[1];
                              }
                          }
                      }
                }           
          
                if($roomDetails[$i]->child!=0)
                {                   
                 $ages = explode(',', $roomDetails[$i]->child_age);   
                 for ($c = 0; $c < $roomDetails[$i]->child; $c++)
                  {  
                    
                    $child_rate+=$childagerate[$ages[$c]];                
                  }
                }

            
              
               if(isset($total_cost_arr[$roomDetails[$i]->search_id]))
               {       
                     $total_cost_arr[$roomDetails[$i]->search_id]=$total_cost_arr[$roomDetails[$i]->search_id]+($roomDetails[$i]->adult*$chp->adult_rate)+$child_rate+($roomDetails[$i]->adult_extrabed*$chp->extra_bed_for_adults_rate)+($roomDetails[$i]->child_extrabed*$chp->extra_bed_for_child_rate);
                     $cp=$cp+1; 
               }
               else
               {
                
                  $total_cost_arr[$roomDetails[$i]->search_id]=($roomDetails[$i]->adult*$chp->adult_rate)+$child_rate+($roomDetails[$i]->adult_extrabed*$chp->extra_bed_for_adults_rate)+($roomDetails[$i]->child_extrabed*$chp->extra_bed_for_child_rate);
                  $cp=$cp+1; 
               }  
            
                                  
               }

                   $nonmandatory_supp_cost=0;          
                    if($roomDetails[$i]->nonmandatory_supplement_check=="Yes")
                    {
                      $nonmandatory_supp_cost=$roomDetails[$i]->nonmandatory_supplement_cost;  
                    }
                 

                   $total_cost_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_cost+$nonmandatory_supp_cost;

                  $net_fare_arr[$roomDetails[$i]->search_id]=$total_cost_arr[$roomDetails[$i]->search_id];
                   $discount_arr[$roomDetails[$i]->search_id]=0;

             }
               if($cp!=$roomDetails[$i]->nights)
               { 
                $check_rates=false; break; 
               } 
             
            }
          }
           
           else if($roomDetails[$i]->conversation_id=="EARLYBIRD")
            {
              $room_details_info=json_decode($roomDetails[$i]->room_details_info,true);
              $dataarray=array(
                        'supplier_id'=>$room_details_info['supplier_id'],
                        'sup_hotel_id'=>$room_details_info['sup_hotel_id'],   
                        'hotel_code'=>$room_details_info['hotel_code'],   
                        'room_code'=>$room_details_info['room_code'],   
                        'contract_id'=>$room_details_info['contract_id'],   
                        'sup_room_details_id'=>$room_details_info['sup_room_details_id'],   
                        'market'=>$room_details_info['market'],   
                        'meal_plan'=>$room_details_info['meal_plan'],   
                        'rate_type'=>$room_details_info['rate_type'],
                        'specialoffer_id'=>$room_details_info['specialoffer_id'],   
                        'specialoffer_type'=>$room_details_info['specialoffer_type'],
                        'min_room_occupancy'=>$room_details_info['min_room_occupancy'],   
                        'max_room_occupancy'=>$room_details_info['max_room_occupancy'],   
                        'min_adults_without_extra_bed'=>$room_details_info['min_adults_without_extra_bed'],   
                        'max_adults_without_extra_bed'=>$room_details_info['max_adults_without_extra_bed'],   
                        'min_child_without_extra_bed'=>$room_details_info['min_child_without_extra_bed'],   
                        'max_child_without_extra_bed'=>$room_details_info['max_child_without_extra_bed'],   
                        'extra_bed_for_adults'=>$room_details_info['extra_bed_for_adults'],  'extra_bed_for_child'=>$room_details_info['extra_bed_for_child'],   
                        'discount_rate_type'=>$room_details_info['discount_rate_type'],
                        'prior_day_type'=>$room_details_info['prior_day_type'],
                        'prior_checkin'=>$room_details_info['prior_checkin'],
                        'prior_checkin_date'=>$room_details_info['prior_checkin_date'],
                        'period_from_date'=>$room_details_info['period_from_date'],
                        'period_to_date'=>$room_details_info['period_to_date'],              
                       );

            if($roomDetails[$i]->rate_plan_code=="PRPN")
            {      
             $check_prices = $this->Hotelcrs_Model->check_crs_hotels_price_early_bird($dataarray,$checkIn,$checkOut,$roomDetails[$i]->rate_plan_code);    
             $cp=0;
             if(!empty($check_prices))
             {
             foreach($check_prices as $chp)
             {  
              if($chp->room_rate==0)
               { 
                $check_rates=false; break; 
               }
               if(isset($total_cost_arr[$roomDetails[$i]->search_id]))
               {
                   $tot=$chp->room_rate+($roomDetails[$i]->adult_extrabed*$chp->extra_bed_for_adults_rate)+($roomDetails[$i]->child_extrabed*$chp->extra_bed_for_child_rate);
                   $net_fare_arr[$roomDetails[$i]->search_id]+=$tot;
                   $discount_amount=($tot*($chp->discount_percentage/100));
                   $discount_arr[$roomDetails[$i]->search_id]+=$discount_amount;
                   $tot=($tot-$discount_amount);
                   $total_cost_arr[$roomDetails[$i]->search_id]+=$tot;
                   $cp=$cp+1;       
               }
               else
               { 
                         
                  $tot=$chp->room_rate+($roomDetails[$i]->adult_extrabed*$chp->extra_bed_for_adults_rate)+($roomDetails[$i]->child_extrabed*$chp->extra_bed_for_child_rate);
                   $net_fare_arr[$roomDetails[$i]->search_id]=$tot;
                   $discount_amount=($tot*($chp->discount_percentage/100));
                   $discount_arr[$roomDetails[$i]->search_id]=$discount_amount;
                   $tot=($tot-$discount_amount);
                   $total_cost_arr[$roomDetails[$i]->search_id]=$tot;
                   $cp=$cp+1;
                }  
             }

                $nonmandatory_supp_cost=0;
                    $nonmandatory_discount=0;
                    if($roomDetails[$i]->nonmandatory_supplement_check=="Yes"){
                      $nonmandatory_supp_cost=$roomDetails[$i]->nonmandatory_supplement_cost;
                      $nonmandatory_discount=$roomDetails[$i]->nonmandatory_supplement_discount;

                    }
            $net_fare_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_cost+$nonmandatory_supp_cost;

              $total_cost_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_cost+$nonmandatory_supp_cost;

                $discount_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_discount+$nonmandatory_discount;

           }
              if($cp!=$roomDetails[$i]->nights)
               { 
                $check_rates=false; break; 
              }
                  
            }
           if($roomDetails[$i]->rate_plan_code=="PPPN")
            {
              $check_prices = $this->Hotelcrs_Model->check_crs_hotels_price_early_bird($dataarray,$checkIn,$checkOut,$roomDetails[$i]->rate_plan_code); 
               $cp=0;
                if(!empty($check_prices))
               {
               foreach($check_prices as $chp)
               {  
                  $child_rate=0; 
                  $child_rate_det=json_decode($chp->child_rate,true);
                  $childagerate=array();  
                  if($chp->adult_rate==0)
                   { 
                    $check_rates=false; break; 
                   }
                  if(!empty($child_rate_det[0]))
                  {                    
                    foreach ($child_rate_det as $key => $value)
                    { 
                          $val=explode('||', $value);   
                          $val1=explode('-', $val[0]);
                          if($val1[0]>=$val1[1])
                          {
                              for($chr=$val1[1];$chr<=$val1[0];$chr++)
                              {
                                  $childagerate[$chr]=$val[1];
                              }
                          }
                          else
                          {
                             
                              for($chr=$val1[0];$chr<=$val1[1];$chr++)
                              {
                                  $childagerate[$chr]=$val[1];
                              }
                          }
                      }
                }           
          
                if($roomDetails[$i]->child!=0)
                {                   
                 $ages = explode(',', $roomDetails[$i]->child_age);   
                 for ($c = 0; $c < $roomDetails[$i]->child; $c++)
                  {  
                    
                    $child_rate+=$childagerate[$ages[$c]];                
                  }
                }

            
              
               if(isset($total_cost_arr[$roomDetails[$i]->search_id]))
               {     

                   $tot=($roomDetails[$i]->adult*$chp->adult_rate)+$child_rate+($roomDetails[$i]->adult_extrabed*$chp->extra_bed_for_adults_rate)+($roomDetails[$i]->child_extrabed*$chp->extra_bed_for_child_rate);
                   $net_fare_arr[$roomDetails[$i]->search_id]+=$tot;
                   $discount_amount=($tot*($chp->discount_percentage/100));
                   $discount_arr[$roomDetails[$i]->search_id]+=$discount_amount;
                   $tot=($tot-$discount_amount);
                   $total_cost_arr[$roomDetails[$i]->search_id]+=$tot;
                   $cp=$cp+1; 
               }
               else
               {
                  $tot=($roomDetails[$i]->adult*$chp->adult_rate)+$child_rate+($roomDetails[$i]->adult_extrabed*$chp->extra_bed_for_adults_rate)+($roomDetails[$i]->child_extrabed*$chp->extra_bed_for_child_rate);
                   $net_fare_arr[$roomDetails[$i]->search_id]=$tot;
                   $discount_amount=($tot*($chp->discount_percentage/100));
                   $discount_arr[$roomDetails[$i]->search_id]=$discount_amount;
                   $tot=($tot-$discount_amount);
                   $total_cost_arr[$roomDetails[$i]->search_id]=$tot;
                  $cp=$cp+1; 
               }  
            
                                  
               }

               $nonmandatory_supp_cost=0;
                    $nonmandatory_discount=0;
                    if($roomDetails[$i]->nonmandatory_supplement_check=="Yes"){
                      $nonmandatory_supp_cost=$roomDetails[$i]->nonmandatory_supplement_cost;
                      $nonmandatory_discount=$roomDetails[$i]->nonmandatory_supplement_discount;

                    }
                $net_fare_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_cost+$nonmandatory_supp_cost;

              $total_cost_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_cost+$nonmandatory_supp_cost;

                $discount_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_discount+$nonmandatory_discount;

             }
               if($cp!=$roomDetails[$i]->nights)
               { 
                $check_rates=false; break; 
               } 
             
            }
          }

           else if($roomDetails[$i]->conversation_id=="DISCOUNT")
            {
              $room_details_info=json_decode($roomDetails[$i]->room_details_info,true);
              $dataarray=array(
                      'supplier_id'=>$room_details_info['supplier_id'],
                      'sup_hotel_id'=>$room_details_info['sup_hotel_id'],   
                      'hotel_code'=>$room_details_info['hotel_code'],   
                      'room_code'=>$room_details_info['room_code'],   
                      'contract_id'=>$room_details_info['contract_id'],   
                      'sup_room_details_id'=>$room_details_info['sup_room_details_id'],   
                      'market'=>$room_details_info['market'],   
                      'meal_plan'=>$room_details_info['meal_plan'],   
                      'rate_type'=>$room_details_info['rate_type'],
                      'specialoffer_id'=>$room_details_info['specialoffer_id'],   
                      'specialoffer_type'=>$room_details_info['specialoffer_type'],
                      'min_room_occupancy'=>$room_details_info['min_room_occupancy'],   
                      'max_room_occupancy'=>$room_details_info['max_room_occupancy'],   
                      'min_adults_without_extra_bed'=>$room_details_info['min_adults_without_extra_bed'],   
                      'max_adults_without_extra_bed'=>$room_details_info['max_adults_without_extra_bed'],   
                      'min_child_without_extra_bed'=>$room_details_info['min_child_without_extra_bed'],   
                      'max_child_without_extra_bed'=>$room_details_info['max_child_without_extra_bed'],   
                      'extra_bed_for_adults'=>$room_details_info['extra_bed_for_adults'],  'extra_bed_for_child'=>$room_details_info['extra_bed_for_child'],   
                      'min_no_of_stay_day'=>$room_details_info['min_no_of_stay_day'], 
                      'max_no_of_stay_day'=>$room_details_info['max_no_of_stay_day'],
                      'no_of_stay_free_nights'=>$room_details_info['no_of_stay_free_nights'], 
                      'prior_day_type'=>$room_details_info['prior_day_type'],
                      'prior_checkin'=>$room_details_info['prior_checkin'],
                      'prior_checkin_date'=>$room_details_info['prior_checkin_date'],
                      'period_from_date'=>$room_details_info['period_from_date'],
                      'period_to_date'=>$room_details_info['period_to_date'],              
                       );

            if($roomDetails[$i]->rate_plan_code=="PRPN")
            {      
             $check_prices = $this->Hotelcrs_Model->check_crs_hotels_price_discount($dataarray,$checkIn,$checkOut,$roomDetails[$i]->rate_plan_code);    
             $cp=0;
             if(!empty($check_prices))
             {
             foreach($check_prices as $chp)
             {  
              if($chp->room_rate==0)
               { 
                $check_rates=false; break; 
               }
               if(isset($total_cost_arr[$roomDetails[$i]->search_id]))
               {
                   $tot=$chp->room_rate+($roomDetails[$i]->adult_extrabed*$chp->extra_bed_for_adults_rate)+($roomDetails[$i]->child_extrabed*$chp->extra_bed_for_child_rate);
                   $net_fare_arr[$roomDetails[$i]->search_id]+=$tot;
                   $discount_amount=($tot*($chp->discount_percentage/100));
                   $discount_arr[$roomDetails[$i]->search_id]+=$discount_amount;
                   $tot=($tot-$discount_amount);
                   $total_cost_arr[$roomDetails[$i]->search_id]+=$tot;
                   $cp=$cp+1;       
               }
               else
               { 
                         
                  $tot=$chp->room_rate+($roomDetails[$i]->adult_extrabed*$chp->extra_bed_for_adults_rate)+($roomDetails[$i]->child_extrabed*$chp->extra_bed_for_child_rate);
                   $net_fare_arr[$roomDetails[$i]->search_id]=$tot;
                   $discount_amount=($tot*($chp->discount_percentage/100));
                   $discount_arr[$roomDetails[$i]->search_id]=$discount_amount;
                   $tot=($tot-$discount_amount);
                   $total_cost_arr[$roomDetails[$i]->search_id]=$tot;
                   $cp=$cp+1;
                }  
             }

                $nonmandatory_supp_cost=0;
                    $nonmandatory_discount=0;
                    if($roomDetails[$i]->nonmandatory_supplement_check=="Yes"){
                      $nonmandatory_supp_cost=$roomDetails[$i]->nonmandatory_supplement_cost;
                      $nonmandatory_discount=$roomDetails[$i]->nonmandatory_supplement_discount;

                    }
            $net_fare_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_cost+$nonmandatory_supp_cost;

              $total_cost_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_cost+$nonmandatory_supp_cost;

                $discount_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_discount+$nonmandatory_discount;

           }
              if($cp!=$roomDetails[$i]->nights)
               { 
                $check_rates=false; break; 
              }
                  
            }
           if($roomDetails[$i]->rate_plan_code=="PPPN")
            {
              $check_prices = $this->Hotelcrs_Model->check_crs_hotels_price_discount($dataarray,$checkIn,$checkOut,$roomDetails[$i]->rate_plan_code); 
                $cp=0;
                if(!empty($check_prices))
               {
               foreach($check_prices as $chp)
               {  
                  $child_rate=0; 
                  $child_rate_det=json_decode($chp->child_rate,true);
                  $childagerate=array();  
                  if($chp->adult_rate==0)
                   { 
                    $check_rates=false; break; 
                   }
                  if(!empty($child_rate_det[0]))
                  {                    
                    foreach ($child_rate_det as $key => $value)
                    { 
                          $val=explode('||', $value);   
                          $val1=explode('-', $val[0]);
                          if($val1[0]>=$val1[1])
                          {
                              for($chr=$val1[1];$chr<=$val1[0];$chr++)
                              {
                                  $childagerate[$chr]=$val[1];
                              }
                          }
                          else
                          {
                             
                              for($chr=$val1[0];$chr<=$val1[1];$chr++)
                              {
                                  $childagerate[$chr]=$val[1];
                              }
                          }
                      }
                }           
          
                if($roomDetails[$i]->child!=0)
                {                   
                 $ages = explode(',', $roomDetails[$i]->child_age);   
                 for ($c = 0; $c < $roomDetails[$i]->child; $c++)
                  {  
                    
                    $child_rate+=$childagerate[$ages[$c]];                
                  }
                }

            
              
               if(isset($total_cost_arr[$roomDetails[$i]->search_id]))
               {     

                   $tot=($roomDetails[$i]->adult*$chp->adult_rate)+$child_rate+($roomDetails[$i]->adult_extrabed*$chp->extra_bed_for_adults_rate)+($roomDetails[$i]->child_extrabed*$chp->extra_bed_for_child_rate);
                   $net_fare_arr[$roomDetails[$i]->search_id]+=$tot;
                   $discount_amount=($tot*($chp->discount_percentage/100));
                   $discount_arr[$roomDetails[$i]->search_id]+=$discount_amount;
                   $tot=($tot-$discount_amount);
                   $total_cost_arr[$roomDetails[$i]->search_id]+=$tot;
                   $cp=$cp+1; 
               }
               else
               {
                  $tot=($roomDetails[$i]->adult*$chp->adult_rate)+$child_rate+($roomDetails[$i]->adult_extrabed*$chp->extra_bed_for_adults_rate)+($roomDetails[$i]->child_extrabed*$chp->extra_bed_for_child_rate);
                   $net_fare_arr[$roomDetails[$i]->search_id]=$tot;
                   $discount_amount=($tot*($chp->discount_percentage/100));
                   $discount_arr[$roomDetails[$i]->search_id]=$discount_amount;
                   $tot=($tot-$discount_amount);
                   $total_cost_arr[$roomDetails[$i]->search_id]=$tot;
                  $cp=$cp+1; 
               }  
            
                                  
               }

               $nonmandatory_supp_cost=0;
                    $nonmandatory_discount=0;
                    if($roomDetails[$i]->nonmandatory_supplement_check=="Yes"){
                      $nonmandatory_supp_cost=$roomDetails[$i]->nonmandatory_supplement_cost;
                      $nonmandatory_discount=$roomDetails[$i]->nonmandatory_supplement_discount;

                    }
                $net_fare_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_cost+$nonmandatory_supp_cost;

              $total_cost_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_cost+$nonmandatory_supp_cost;

                $discount_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_discount+$nonmandatory_discount;

             }
               if($cp!=$roomDetails[$i]->nights)
               { 
                $check_rates=false; break; 
               } 
             
            }
          }

           else if($roomDetails[$i]->conversation_id=="STAYPAY")
            {
              $room_details_info=json_decode($roomDetails[$i]->room_details_info,true);
              $dataarray=array(
                      'supplier_id'=>$room_details_info['supplier_id'],
                      'sup_hotel_id'=>$room_details_info['sup_hotel_id'],   
                      'hotel_code'=>$room_details_info['hotel_code'],   
                      'room_code'=>$room_details_info['room_code'],   
                      'contract_id'=>$room_details_info['contract_id'],   
                      'sup_room_details_id'=>$room_details_info['sup_room_details_id'],   
                      'market'=>$room_details_info['market'],   
                      'meal_plan'=>$room_details_info['meal_plan'],   
                      'rate_type'=>$room_details_info['rate_type'],
                      'specialoffer_id'=>$room_details_info['specialoffer_id'],   
                      'specialoffer_type'=>$room_details_info['specialoffer_type'],
                      'min_room_occupancy'=>$room_details_info['min_room_occupancy'],   
                      'max_room_occupancy'=>$room_details_info['max_room_occupancy'],   
                      'min_adults_without_extra_bed'=>$room_details_info['min_adults_without_extra_bed'],   
                      'max_adults_without_extra_bed'=>$room_details_info['max_adults_without_extra_bed'],   
                      'min_child_without_extra_bed'=>$room_details_info['min_child_without_extra_bed'],   
                      'max_child_without_extra_bed'=>$room_details_info['max_child_without_extra_bed'],   
                      'extra_bed_for_adults'=>$room_details_info['extra_bed_for_adults'],  'extra_bed_for_child'=>$room_details_info['extra_bed_for_child'],   
                      'min_no_of_stay_day'=>$room_details_info['min_no_of_stay_day'], 
                      'max_no_of_stay_day'=>$room_details_info['max_no_of_stay_day'],
                      'no_of_stay_free_nights'=>$room_details_info['no_of_stay_free_nights'], 
                      'prior_day_type'=>$room_details_info['prior_day_type'],
                      'prior_checkin'=>$room_details_info['prior_checkin'],
                      'prior_checkin_date'=>$room_details_info['prior_checkin_date'],
                      'period_from_date'=>$room_details_info['period_from_date'],
                      'period_to_date'=>$room_details_info['period_to_date'],              
                       );

            if($roomDetails[$i]->rate_plan_code=="PRPN")
            {      
             $check_prices = $this->Hotelcrs_Model->check_crs_hotels_price_stay_pay($dataarray,$checkIn,$checkOut,$roomDetails[$i]->rate_plan_code);    
             $cp=0;
            $paynights=$roomDetails[$i]->nights-$room_details_info['no_of_stay_free_nights'];
            // echo '<br>'.$paynights.'<br>';
             if(!empty($check_prices))
             {       
               foreach($check_prices as $chp)
               {  
                if($chp->room_rate==0)
                 { 
                  $check_rates=false; break; 
                 }
                 if(isset($total_cost_arr[$roomDetails[$i]->search_id]))
                 {          

                  $cp=$cp+1;
                  $tot=$chp->room_rate+($roomDetails[$i]->adult_extrabed*$chp->extra_bed_for_adults_rate)+($roomDetails[$i]->child_extrabed*$chp->extra_bed_for_child_rate);    
                   $net_fare_arr[$roomDetails[$i]->search_id]+=$tot;     
                    if($paynights>=$cp)
                      {                    
                        $total_cost_arr[$roomDetails[$i]->search_id]+=$tot;
                      }
                      
                 }
                 else
                 {
                   
                      $cp=$cp+1; 
                      $tot=$chp->room_rate+($roomDetails[$i]->adult_extrabed*$chp->extra_bed_for_adults_rate)+($roomDetails[$i]->child_extrabed*$chp->extra_bed_for_child_rate); 
                       $net_fare_arr[$roomDetails[$i]->search_id]=$tot;                
                       $total_cost_arr[$roomDetails[$i]->search_id]=$tot;
                    
                  }  
               }

               $nonmandatory_supp_cost=0;
                    $nonmandatory_discount=0;
                    if($roomDetails[$i]->nonmandatory_supplement_check=="Yes"){
                      $nonmandatory_supp_cost=$roomDetails[$i]->nonmandatory_supplement_cost;
                      $nonmandatory_discount=$roomDetails[$i]->nonmandatory_supplement_discount;

                    }
                $net_fare_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_cost+$nonmandatory_supp_cost;

              $total_cost_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_cost+$nonmandatory_supp_cost;

              $discount_amount=($net_fare_arr[$roomDetails[$i]->search_id]-$total_cost_arr[$roomDetails[$i]->search_id]);
              $discount_arr[$roomDetails[$i]->search_id]=$discount_amount+$roomDetails[$i]->mandatory_supplement_discount+$nonmandatory_discount;

           }
              if($cp!=$roomDetails[$i]->nights)
               { 
                $check_rates=false; break; 
              }
                  
            }
           if($roomDetails[$i]->rate_plan_code=="PPPN")
            {
               $check_prices = $this->Hotelcrs_Model->check_crs_hotels_price_stay_pay($dataarray,$checkIn,$checkOut,$roomDetails[$i]->rate_plan_code); 
               $cp=0;      
              $paynights=$roomDetails[$i]->nights-$room_details_info['no_of_stay_free_nights'];
               // echo '<br>'.$paynights.'<br>';     
                if(!empty($check_prices))
               {
               foreach($check_prices as $chp)
               {  
                  $child_rate=0; 
                  $child_rate_det=json_decode($chp->child_rate,true);
                  $childagerate=array();  
                  if($chp->adult_rate==0)
                   { 
                    $check_rates=false; break; 
                   }
                  if(!empty($child_rate_det[0]))
                  {                    
                    foreach ($child_rate_det as $key => $value)
                    { 
                          $val=explode('||', $value);   
                          $val1=explode('-', $val[0]);
                          if($val1[0]>=$val1[1])
                          {
                              for($chr=$val1[1];$chr<=$val1[0];$chr++)
                              {
                                  $childagerate[$chr]=$val[1];
                              }
                          }
                          else
                          {
                             
                              for($chr=$val1[0];$chr<=$val1[1];$chr++)
                              {
                                  $childagerate[$chr]=$val[1];
                              }
                          }
                      }
                }           
          
                if($roomDetails[$i]->child!=0)
                {                   
                 $ages = explode(',', $roomDetails[$i]->child_age);   
                 for ($c = 0; $c < $roomDetails[$i]->child; $c++)
                  {  
                    
                    $child_rate+=$childagerate[$ages[$c]];                
                  }
                }

            
              
               if(isset($total_cost_arr[$roomDetails[$i]->search_id]))
               {
               
                  $cp=$cp+1; 
                  $tot=($roomDetails[$i]->adult*$chp->adult_rate)+$child_rate+($roomDetails[$i]->adult_extrabed*$chp->extra_bed_for_adults_rate)+($roomDetails[$i]->child_extrabed*$chp->extra_bed_for_child_rate); 
                   $net_fare_arr[$roomDetails[$i]->search_id] +=$tot;     
                  if($paynights>=$cp)
                  {                         
                      $total_cost_arr[$roomDetails[$i]->search_id]+=$tot;
                  } 
               }
               else
               {
                 
                  $tot=($roomDetails[$i]->adult*$chp->adult_rate)+$child_rate+($roomDetails[$i]->adult_extrabed*$chp->extra_bed_for_adults_rate)+($roomDetails[$i]->child_extrabed*$chp->extra_bed_for_child_rate);
                  $net_fare_arr[$roomDetails[$i]->search_id]=$tot;        
                  $total_cost_arr[$roomDetails[$i]->search_id]=$tot;
                  $cp=$cp+1; 
               }  
            
                                  
               }

               $nonmandatory_supp_cost=0;
                    $nonmandatory_discount=0;
                    if($roomDetails[$i]->nonmandatory_supplement_check=="Yes"){
                      $nonmandatory_supp_cost=$roomDetails[$i]->nonmandatory_supplement_cost;
                      $nonmandatory_discount=$roomDetails[$i]->nonmandatory_supplement_discount;

                    }
               $net_fare_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_cost+$nonmandatory_supp_cost;

              $total_cost_arr[$roomDetails[$i]->search_id]+=$roomDetails[$i]->mandatory_supplement_cost+$nonmandatory_supp_cost;


              $discount_amount=($net_fare_arr[$roomDetails[$i]->search_id]-$total_cost_arr[$roomDetails[$i]->search_id]);
              $discount_arr[$roomDetails[$i]->search_id]=$discount_amount+$roomDetails[$i]->mandatory_supplement_discount+$nonmandatory_discount;
             }
               if($cp!=$roomDetails[$i]->nights)
               {   
                $check_rates=false; break; 
               } 
             
            }
          }
        }

        foreach ($allotment_arr as $key=>$val)
        {
         $check_allotment= $this->Hotelcrs_Model->check_crs_hotels_room_allotment($key);
         if(empty($check_allotment))
         {
          $check_availiablity=false; break;
         }
         if($check_allotment->rooms_available!=-1)
         { 
            if(($check_allotment->total_booking+$val)>$check_allotment->rooms_available)
            {
               $check_availiablity=false; break;
            }
         }
        }

          if($check_availiablity&&$check_rates)
          {
              foreach($total_cost_arr as $key=>$val)
              {     
                 $tot_cost+=$val;
                 $this->Hotelcrs_Model->update_crs_hotels_room_total_cost($key,$sessionId,$hotelCode,$val);   
              }
              if(!empty($net_fare_arr))
              {
                foreach($net_fare_arr as $key=>$val)
                {
                   $net_cost+=$val;
                   $this->Hotelcrs_Model->update_crs_hotels_room_net_fare($key,$sessionId,$hotelCode,$val);   
                }
              }
              if(!empty($discount_arr))
              {
                foreach($discount_arr as $key=>$val)
                {  
                    $dis_cost+=$val;   
                   $this->Hotelcrs_Model->update_crs_hotels_room_discount($key,$sessionId,$hotelCode,$val);   
                }
              }
          }


        return array($check_availiablity,$check_rates,$net_cost,$tot_cost,$dis_cost,$allotment_arr); 

    }

    public function crs_booking($sessionId, $hotelCode,$searchId,$roomDetailsdata)
    {

        $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $this->cin)));
        $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $this->cout)));
         list($check_availiablity,$check_rates,$net_amount,$total_cost,$discount,$allotment_arr)=$this->check_rates_and_room_availability($sessionId, $hotelCode,$roomDetailsdata);
        // echo $check_availiablity.'<br>';
        // echo $check_rates.'<br>';
        // echo $net_amount.'<br>';
        // echo $total_cost.'<br>';
        // echo $discount.'<br>';
        // $allotment_arr
        // exit;
          $searchIds =explode(',',$searchId);
          $roomDetails=array();
         foreach ($searchIds as $val) 
         {
             $roomDetails[]= $this->Hotelcrs_Model->getRoomDetails($this->api,$sessionId, $hotelCode, $val);
             // echo '<pre>';print_r($roomDetails);exit;
          }  
        if ($check_availiablity && $check_rates)
         {     
               $pass_info = $this->session->userdata('passenger_info');
                // echo '<pre>';print_r($pass_info);exit;
               $booking_id = $this->Hotelcrs_Model->get_last_booking_code();
                $booking_id +=1;
                $this->db->trans_begin();
                $insert_hotel = array(
                    'booking_id' => $booking_id,
                    'hotel_code' => $roomDetails[0]->hotel_code,
                    'hotel_name' => $roomDetails[0]->hotel_name,
                    'supplier_id' => $roomDetails[0]->supplier_id,
                    'uniqueRefNo' => $this->Sys_RefNo,
                    'check_in' => $checkIn,
                    'check_out' => $checkOut,
                    'booking_date' => date('Y-m-d'),
                   // 'city' => $roomDetails->city_name,
                    'city' => $this->city_name,
                    'room_count' => $this->rooms, 
                    'adult' => $this->adults_count,
                    'child' => $this->childs_count,
                    'adult_extrabed' => $this->adult_extrabed_count,
                    'child_extrabed' => $this->child_extrabed_count,
                    'net_amount' => $net_amount,
                    'total_amount' => $total_cost,
                    'discount' => $discount,
                    'tax' => '0.0',
                    // 'comment_desc'=>$pass_info['comment'],
                );

                $this->Hotelcrs_Model->insert_crs_booking($insert_hotel);
                $i = 0;
                foreach ($roomDetails as $res) {
               
                    // $insert_hotel_room = array(
                    //     'booking_id' => $booking_id,
                    //     'hotel_code' => $res->hotel_code,
                    //     'room_code' => $res->room_code,
                    //     'check_in' => $checkIn,
                    //     'check_out' => $checkOut,
                    //     'room_type' => $res->room_type,
                    //     'room_price' => $res->total_cost,
                    //     'adult' => $this->adults[$i],
                    //     'child' => $this->childs[$i],
                    //     'adult_extrabed'=>$this->adult_extrabed[$i],
                    //     'child_extrabed'=>$this->child_extrabed[$i],
                    //     'childs_ages'=> $this->childs_ages[$i],
                    //     'hotel_crs_booking_code'=>$res->hotel_crs_booking_code,
                        
                    // );
                    // $this->Hotelcrs_Model->insert_crs_booking_room($insert_hotel_room);


                $insert_hotel_room_details = array(
                    'booking_id' => $booking_id,
                    'uniqueRefNo' => $this->Sys_RefNo,
                    'mobile' => $pass_info['user_mobile'],
                    'email' => $pass_info['user_email'],
                    'hotel_code' => $res->hotel_code,
                    'room_code' => $res->room_code,
                    'supplier_id'=>$res->hotel_supplier_id,
                    'contract_id'=>$res->contractnameVal,
                    'market'=>$res->hbzoneName,
                    'meal_plan'=>$res->board_type,
                    'rate_type'=>$res->rate_plan_code,
                    'rate_plan_code'=>$res->conversation_id,
                    'room_no'=>($res->room_runno+1),
                    'check_in' => $checkIn,
                    'check_out' => $checkOut,
                    'room_type' => $res->room_type,
                    'room_price' => $res->total_cost,
                    'net_fare'=>$res->net_fare,
                    'discount'=>isset($res->discount)?$res->discount:0,
                    'adult' => $this->adults[$i],
                    'child' => $this->childs[$i], 
                    'adult_extrabed'=>$this->adult_extrabed[$i],
                    'child_extrabed'=>$this->child_extrabed[$i],
                    'childs_ages'=> isset($this->childs_ages[$i])?$this->childs_ages[$i]:'',
                    'nights'=>$this->nights,       
                    'hotel_crs_booking_code'=>$res->hotel_crs_booking_code,
                    'crs_mandatory_supplement'=>$res->crs_mandatory_supplement,
                    'mandatory_supplement_cost'=>$res->mandatory_supplement_cost,
                    'mandatory_supplement_meal_plan'=>$res->mandatory_supplement_meal_plan,
                    'mandatory_supplement_net_fare'=>$res->mandatory_supplement_net_fare,
                    'mandatory_supplement_discount'=>$res->mandatory_supplement_discount,
                    'crs_nonmandatory_supplement'=>$res->crs_nonmandatory_supplement,
                    'nonmandatory_supplement_cost'=>$res->nonmandatory_supplement_cost,
                    'nonmandatory_supplement_meal_plan'=>$res->nonmandatory_supplement_meal_plan,
                    'nonmandatory_supplement_net_fare'=>$res->nonmandatory_supplement_net_fare,
                    'nonmandatory_supplement_discount'=>$res->nonmandatory_supplement_discount,
                    'nonmandatory_supplement_check'=>$res->nonmandatory_supplement_check,
                    'hotel_crs_cancellation_json'=>$res->hotel_crs_cancellation_json,         
                );
                $this->Hotelcrs_Model->insert_crs_booking_room_details($insert_hotel_room_details);
                    $i++;
                }
                $this->Hotelcrs_Model->insert_crs_booking_pass($booking_id, $this->rooms, $this->adults, $this->childs,$this->adult_extrabed,$this->child_extrabed,$this->Sys_RefNo);
                $balance = $total_cost + $this->Hotelcrs_Model->get_supplier_balance($roomDetails[0]->supplier_id);

                $insertData = array(
                   // 'transaction_id' => $this->generateRandomString(10),
                    'transaction_id' => $this->Sys_RefNo,
                    'supplier_id' => $roomDetails[0]->supplier_id,
                    'supplier_no' => $roomDetails[0]->supplier_no,
                    'booking_id' => $booking_id,
                    'hotel_id' => $roomDetails[0]->supplier_hotel_list_id,
                    'hotel_code' =>$roomDetails[0]->hotel_code,
                    'transaction_summary' => 'Pay Supplier',
                    'booked_amount' => $total_cost,
                    'paid_amount' => 0,
                    'available_balance' => $balance,
                   // 'city' => $roomDetails->city_name,
                    'city' => $this->city_name,
                    'booking_date' => date('Y-m-d'),
                    'transaction_datetime' => date('Y-m-d H:i:s'),
                    'user_id' => '0',
                    'remarks' => 'Pay Supplier',
                );
                $this->Hotelcrs_Model->insert_supplier_act_summary($insertData);
                foreach ($allotment_arr as $key=>$val)
                {
                   $this->Hotelcrs_Model->update_crs_hotels_room_allotment($key,$val);
                 } 
                 return array($booking_id,$roomDetails); 
            } else {
                $error = 'Rooms Not Available';
                redirect('home/error_page/' . base64_encode($error));
                exit();
                return '';
            }
    }

    public function payment_gateway_old($sessionId, $hotelCode, $searchId) {
        $this->set_variables();

        $data['roomDetails'] = $roomDetails = $this->Hotelcrs_Model->getRoomDetails($this->active_api, $sessionId, $hotelCode, $searchId);

        $pass_info = $this->session->userdata('passenger_info');
        //	if($passenger_info['payment_type'] == 'icici'){ $pay_type='PG';  }else{ $pay_type='deposit';  }
        $totsend = 0;


        $totsend = $roomDetails->total_cost;


        $ip = $_SERVER['REMOTE_ADDR'];
        // $payinsert = array('uniqueRefNo' => $this->Sys_RefNo, 'amount' => $totsend, 'passenger_email' => $pass_info['user_email'], 'passenger_mobile' => $pass_info['user_mobile'], 'service_type' => 1, 'ip' => $_SERVER['REMOTE_ADDR']);
        // $payinsert_id = $this->Hotelcrs_Model->pay_details($payinsert);
        $pay_details = array(
            'callBackId' => 'hotelcrs',
            'searchId' => $searchId,
            'hotelCode' => $hotelCode,
            'sessionId' => $sessionId,
            //  'payinsert_id' => $payinsert_id,
            'uniqueRefNo' => $this->Sys_RefNo,
            'total_cost' => round($totsend),
            'desc' => 'NorthTours Hotel Booking : ' . $this->uniqueRefNo,
            'paytype' => $pass_info['paytype'],
            'passenger_email' => $pass_info['user_email'],
            'passenger_mobile' => $pass_info['user_mobile'],
            'service_type' => 1,
            'ip' => $ip,
            'currency' => 'USD',
            'return_url' => site_url() . "hotels/payment_return",
        );
        $this->session->set_userdata('pay_details', $pay_details);
        redirect('payment/index', 'refresh');


        exit;
    }

    public function payment_process($sessionId, $hotelCode, $searchId) {
        $this->set_variables();
        // echo '<pre>';print_r($_POST);exit;
        $search_temp = explode(',', $searchId);
        foreach ($search_temp as $sid) {
            $roomDetails[] = $this->Hotelcrs_Model->getRoomDetails($this->api, $sessionId, $hotelCode, $sid);
        }
        $pass_info = $this->session->userdata('passenger_info');
        // echo '<pre>';print_r($roomDetails);exit;
        $fname = implode('', $pass_info['adults_fname']);
        $lname = implode('', $pass_info['adults_lname']);
        $name = $fname.''.$lname;
        // print_r($fname);exit;
        $net_cost = 0;$total_cost = 0;$agent_markup = 0;$payhotel = 0; $discount = 0;
        foreach ($roomDetails as $gett) {
            $net_cost +=$gett->org_amt;
            $dis_cost +=$gett->discount;
            $total_cost +=$gett->total_cost ;
            $agent_markup +=$gett->agent_markup;
            $payhotel +=$gett->payhotel;
            // $totsend +=$gett->admin_markup+$gett->agent_markup+$gett->payment_charge;
        }

        if($pass_info['pay_type'] == 'hotelpay')
            $totsend = $total_cost - $net_cost;
        elseif($pass_info['pay_type'] == 'agentpay')
            $totsend = $total_cost - $agent_markup;
        else
            $totsend = $total_cost - $dis_cost;

        $search_details = array(
            'callBackId' => 'hotel_crs',
            'searchId' => $searchId,
            'hotelCode' => $hotelCode,
            'sessionId' => $sessionId,
            // 'payinsert_id' => $payinsert_id,
            'uniqueRefNo' => $this->Sys_RefNo,
            'total_cost' => $totsend,
            'desc' => 'Hotel Booking ',
            'paytype' => 'payment_gateway',
            'first_name' =>$fname,
            'last_name' =>$lname,
            'name' =>$name,
            'email' => $pass_info['user_email'],
            'contact' => $pass_info['user_mobile'],
            'payment_gateway_id' => $pass_info['st_payment_gateway'],
            'service_type' => 1,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'currency' => 'USD',
            'address'=> $pass_info['address'].', '.$pass_info['address2'].', '.$pass_info['user_city'].', '.$pass_info['user_state'].', '.$pass_info['user_country'].', '.$pass_info['user_pincode'],
            // 'return_url' => site_url() . "hotels/payment_return",
        );
        // echo '<pre>';print_r($search_details);exit;
        $this->session->set_userdata('search_details', $search_details);
        redirect('payment/index', 'refresh');
        exit;
    }

    public function deposit_check($roomDetails) {
        // echo '<pre>';print_r($roomDetails);exit;
        $deposit_check_status = 1;
        if ($this->session->userdata('agent_logged_in') || $this->session->userdata('corporate_sub_logged_in')) {
            $agent_no = $this->session->userdata('agent_no');
            $agent_type = $this->session->userdata('agent_type');
            $available_balance = $this->Hotelcrs_Model->get_agent_available_balance($agent_no, $agent_type);

            $total_cost = $roomDetails[0]->total_cost;
             // echo '<pre>d';print_r($total_cost);exit;
            if ($agent_type == 1) {
                $agent_markup = $roomDetails->admin_markup+$roomDetails->agent_markup;
            } elseif ($agent_type == 2) {
                $agent_markup = $roomDetails->sub_agent_markup;
            }
            $withdraw_amount = $total_cost - $agent_markup;
            if ($available_balance < $withdraw_amount) {
                $deposit_check_status = 1;
            } else {
                $deposit_check_status = 0;
            }
        }
        return $deposit_check_status;
    }

    function deposit_withdraw($total_price, $agent_markup, $Sys_RefNo) {
        // echo '<pre>';print_r($total_price);exit;
        $agent_id = $this->session->userdata('agent_id');
        $agent_no = $this->session->userdata('agent_no');

        $agent_type = $this->session->userdata('agent_type');
        $agent_parent = $this->session->userdata('agent_parent');

        $available_balance = $this->Hotelcrs_Model->get_agent_available_balance($agent_no, $agent_type);
        //print_r($available_balance);exit;
        $available_balance = empty($available_balance) ? 0 : $available_balance;
        $withdraw_amount = $total_price - $agent_markup;
        //print_r($withdraw_amount);exit;
        if ($available_balance < $withdraw_amount) {
          
            $error = 'Your balance is too low for booking this hotel';
            redirect('home/error_page/' . base64_encode($error));
        } else {
            $closing_balance = $available_balance - $withdraw_amount;
            //print $closing_balance."test"; exit;
            $this->Hotelcrs_Model->insert_withdraw_status($agent_id, $agent_no, $withdraw_amount, $closing_balance, $Sys_RefNo, $agent_type);
            //echo $this->db->last_query();exit;
        }
    }

    public function initiateCancellation($unique_refno, $Booking_RefNo='') {
        $hotel_booking_info = $this->Hotelcrs_Model->get_hotel_booking_details($unique_refno);
        // echo '<pre>433';print_r($hotel_booking_info);exit;
        $data = array();
        $data['message'] = 'Cancellation Failed';
        $data['total_cost'] = 0;
        $data['note'] = '';
        $data['currency'] = '';
        $data['check_in'] = '';
        if (!empty($hotel_booking_info)) {
             // echo '<pre>123';print_r($cancel_rs);exit;
            $data['total_cost'] = $hotel_booking_info->total_cost;
            $data['Api_Name'] = $hotel_booking_info->Api_Name;
            $data['note'] = $hotel_booking_info->cancel_policy;
            $data['currency'] = $hotel_booking_info->Xml_Currency;
            $data['check_in'] = $hotel_booking_info->check_in;
            $data['message'] = 'Cancellation Initiated';
        }
        return $data;
    }

    function confirmCancellation($unique_refno, $Booking_RefNo='') {
        $hotel_booking_info = $this->Hotelcrs_Model->get_hotel_booking_details($unique_refno);
        // echo $this->db->last_query();
        // echo '<pre>';print_r($hotel_booking_info);exit;
        $data = array();
        $data['message'] = 'Cancellation Failed';
        $data['total_cost'] = 0;
        $data['note'] = '';
        $data['currency'] = '';
        $data['check_in'] = '';
        if (!empty($hotel_booking_info)) {

            $param_string = $hotel_booking_info->Booking_RefNo;
            $request_type = 'cancel/';
            $cancel_rs = $this->processRequest_provision($request_type,$param_string);

            // echo '<pre>';print_r($cancel_rs);exit;
            $data['total_cost'] = $hotel_booking_info->total_cost;
            $data['Api_Name'] = $hotel_booking_info->Api_Name;
            
            if(isset($cancel_rs->error_code) && $cancel_rs->error_code!='') {
              $data['message']= $cancel_rs->detail;
            } else {
              $CancellationCharge = $cancel_rs->charge_amount;
              $data['message'] = 'Cancellation Successfull';
              $cancel_status = 'Successfull';
              $booking_status = 'Cancelled';
              $this->Hotelcrs_Model->update_hotel_cancel_status($unique_refno,$cancel_status,$CancellationCharge,$booking_status);
              // echo $this->db->last_query();exit;
              $booking_info = $this->Hotelcrs_Model->get_hotel_booking_pass_info($unique_refno);
            // echo '<pre>';print_r($booking_info);exit;
              $cancel_ticket = array(
                  'cancelof' => 'Hotels',
                  'Ref_No' => $unique_refno,
                  'pnr' => $Booking_RefNo,
                  'booking_date' => $hotel_booking_info->Booking_Date,
                  'subject' => 'Hotel Cancellation',
                  'status' => $data['message'],
                  'surname' => $booking_info->first_name.' '.$booking_info->last_name,
                  'email' => $booking_info->email
              );
               // echo '<pre>';print_r($cancel_ticket);exit;

              $this->load->module('home/sendemail');
              $this->sendemail->refund_cancelled_email($cancel_ticket); 
            }
        }
        return $data;
    }

    public function processRequest_provision($request_type,$request) {
      $submit_url = $this->post_url.$request_type.$request;
      $credential=$this->username.':'.$this->password;
      $headers = array(  
       "Authorization : Basic ".base64_encode("$credential"),
       // "Content-Type: application/json",
       "Content-Type: application/x-www-form-urlencoded",
       'Content-Length: ' . strlen($request)
      );  

     
     //echo $submit_url;
     $rest = curl_init();  
     curl_setopt($rest, CURLOPT_URL,$submit_url);
     curl_setopt($rest, CURLOPT_TIMEOUT, 180); 
     curl_setopt($rest, CURLOPT_HEADER, 0);
     // curl_setopt($rest, CURLOPT_CUSTOMREQUEST,'GET');
     curl_setopt($rest, CURLOPT_CUSTOMREQUEST,'POST');
     curl_setopt($rest, CURLOPT_POSTFIELDS,$request);
     curl_setopt($rest, CURLOPT_HTTPHEADER,$headers);  
     curl_setopt($rest, CURLOPT_SSL_VERIFYPEER, false);  
     curl_setopt($rest, CURLOPT_RETURNTRANSFER, true); 
     // $error2 = curl_getinfo($rest, CURLINFO_HTTP_CODE);
     $response = curl_exec($rest);
     $res1=json_decode($response);
     curl_close($rest);

     $type=rtrim($request_type,'/');
     file_put_contents(FCPATH . 'dump/hotelspro/'.$type.'_rq.txt', $submit_url); //CREATING LOGS
     file_put_contents(FCPATH . 'dump/hotelspro/'.$type.'_rs.txt', $response); //CREATING LOGS

      // print_r($error2);
      // print_r($response);exit; 
      return $res1;
    }

    public function executeRequest($request) {
        $httpHeader = array(
            "Content-Type: text/xml; charset=UTF-8",
            "Content-Encoding: UTF-8",
            "Accept-Encoding: gzip,deflate"
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->post_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        //Adding HttpHeader
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");

        $response = curl_exec($ch);
        $errors = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $response;
    }

    //    error page
    function error_page($error) {
        $data['error'] = $error;
        $this->load->view('home/error_page', $data);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210ZYXWVUTSRQPONMLKJIHGFEDCBA';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return 'UTT' . $randomString;
    }


      public function session_check() {
        $session_data = $this->session->userdata('hotel_search_data');
        if ($this->session->userdata('hotel_search_data') == '') {
            $error = 'Session expired.Please search again.';
            redirect('home/error_page/' . base64_encode($error));
        }
    }

    function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( !array_key_exists($columnKey, $value)) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( !array_key_exists($indexKey, $value)) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }

}
