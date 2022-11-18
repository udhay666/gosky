<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
  exit('No direct script access allowed');
class roomsallotment extends CI_CONTROLLER {
  function __construct() {
    parent :: __construct();
    $this->load->database();     
    $this->load->model('glb_hotel_room_type');  
    $this->load->model('glb_hotel_meal_plan');  
    $this->load->model('supplier_hotel_list');  
    $this->load->model('supplier_room_list');
    $this->load->model('sup_hotel_room_rates_list'); 
    $this->load->model('sup_hotel_room_cancellation_rates');
    $this->load->model('sup_contract');
    $this->load->model('country');
    $this->load->model('sup_specialoffer_hotel_room_rates_list'); 
    $this->load->model('sup_specialoffer_hotel_room_cancellation_rates');
    $this->load->model('Roomrates_Model');
    $this->load->model('sup_specialoffer_hotel_room_rates');
    $this->load->model('sup_hotel_room_rates'); 
    $this->load->model('specialoffer_type');
    $this->load->model('sup_specialoffer_hotel_room_rates'); 
    $this->load->model('sup_hotel_room_allotment_list');  
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    $this->supplier_id = $this->session->userdata('supplier_id');
    $this->is_logged_in();
  }
 private function is_logged_in() {
    if (!$this->session->userdata('supplier_logged_in')) {
        redirect('login/supplier_login');
    }
}

public function assign()
{
  $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
  $data['hotel_list'] =$this->supplier_hotel_list->check($dataarray);  
  $data['sub_view'] = 'roomsallotment/assign';
  $this->load->view('_layout_main',$data); 
}
public function add_rooms_allotment()
 {  
  // echo '<pre>'; print_r($_POST); exit;  
  $dataarray=array('supplier_hotel_list_id'=>$_POST['hotel_id'],'supplier_id'=>$this->supplier_id,'status'=>1);
  $data['room_list'] =$this->supplier_room_list->check($dataarray); 

  $hotel_detail =$this->supplier_hotel_list->get_single($_POST['hotel_id']);
 
  $data['contract_list'] =$this->sup_contract->check($dataarray);
 
   // echo '<pre>'; print_r($_POST); exit; 
    if(!isset($_POST['hotel_id']) || empty($data['room_list'])){ 
   
     echo json_encode(array('result' => ''));
  }
  else if($this->input->server('REQUEST_METHOD') === 'POST') {    

      $this->form_validation->set_rules('hotel_id', ' Hotel ', 'required');
      $this->form_validation->set_rules('room_id', ' Room ', 'required');
       $this->form_validation->set_rules('contract', 'Contract ', 'required');
      if($this->form_validation->run()) {
      $hotel_id = $this->input->post('hotel_id');
      $room_id = $this->input->post('room_id');     
      $contract_id = $this->input->post('contract');             
      $get_selected_room_code =$this->supplier_room_list->get_single($room_id);
      $from_date=strtotime($_POST['from_date']);
      $to_date=strtotime($_POST['to_date']);
      $startdate= date("Y-m-d", $from_date);
      $enddate= date("Y-m-d", $to_date);
      $room_allotment_type=$_POST['room_allotment_type'];
      $rooms_available=$_POST['rooms_available'];
    

    $days=floor(($to_date - $from_date) / (60 * 60 * 24));
    
    $contract_dataarray=array('contract_id'=>$contract_id,'supplier_id'=>$this->supplier_id,'supplier_hotel_list_id'=>$hotel_id);
    $contact_details=$this->sup_contract->check($contract_dataarray); 
    $contact_start_date = strtotime($contact_details[0]->start_date);
    $contact_end_date = strtotime($contact_details[0]->end_date);

          if ($from_date < $contact_start_date || $to_date>$contact_end_date||$to_date < $contact_start_date || $from_date>$contact_end_date || $from_date>$to_date) { 

          echo json_encode(array('result' =>'Period Should be within Contract Period'));
           }    

         else if($room_allotment_type=='freesell' ||$room_allotment_type=='stopsell' || $room_allotment_type=='quantity')
         {
            $this->sup_hotel_room_allotment_list->delete_room_room_allotment_list($hotel_id, $room_id, $startdate,$enddate,$contract_id); 
            $insert_room_allotment_list=array(    
            'supplier_id' =>$this->supplier_id,
            'sup_hotel_id' => $hotel_id,
            'hotel_code' => $hotel_detail->hotel_code,
            'room_code'=>$get_selected_room_code->room_code,
            'contract_id' => $contract_id,
            'sup_room_details_id'=> $room_id,                 
            'from_date'=> $startdate,
            'to_date'=>$enddate, 
             'room_allotment_type'=> $room_allotment_type,
            'rooms_available'=> $rooms_available,
            'status' => '1'
          );
 // echo '<pre>'; print_r($insert_room_allotment_list); exit; 
      $sup_hotel_room_allotment_list_id=$this->sup_hotel_room_allotment_list->insert($insert_room_allotment_list);
    
            for($i=0;$i<=$days;$i++)
            {  
              $incr_date = strtotime("+".$i." days", $from_date);
              $room_avail_date=date("Y-m-d", $incr_date);             
              $update_data=array(
                  'sup_hotel_room_allotment_list_id'=>$sup_hotel_room_allotment_list_id,                  
                  'room_allotment_type'=> $room_allotment_type,
                  'rooms_available'=> $rooms_available,
                ); 
                 // echo 12; exit;     
 $this->sup_hotel_room_rates->update_room_allotment($this->supplier_id,$hotel_id,$hotel_detail->hotel_code,$get_selected_room_code->room_code,$contract_id,$room_id,$room_avail_date,$update_data);
 
 $this->sup_specialoffer_hotel_room_rates->update_specailoffer_room_allotment($this->supplier_id,$hotel_id,$hotel_detail->hotel_code,$get_selected_room_code->room_code,$contract_id,$room_id,$room_avail_date,$update_data);

 
            }       
        
    echo json_encode(array('result' => "Successfully Updated"));
 
          }         
        else
        { 
           echo json_encode(array('result' => "Try after sometimes..."));
        }
      }
      else
        {  
       
           echo json_encode(array('result' => "Try after sometimes..."));
        }
    }
    else
        {    
       
           echo json_encode(array('result' => "Try after sometimes..."));
        }
       
 }
public function view_room_allotment()
{
  $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
  $data['hotel_list'] =$this->supplier_hotel_list->check($dataarray); 
  $data['sub_view'] = 'roomsallotment/view';
  $this->load->view('_layout_main',$data);
}

 public function room_allotment_list_old() {  
  $dataarray=array('supplier_hotel_list_id'=>$_POST['hotel_id'],'supplier_id'=>$this->supplier_id,'status'=>1);
  $data['rooms'] =$this->supplier_room_list->check($dataarray);

  $data['hotel_detail'] =$this->supplier_hotel_list->get_single($_POST['hotel_id']);  
  $data['contract_id']=$_POST['contract'];
   if(!isset($_POST['hotel_id']) || empty($data['rooms'])){
    redirect('roomsallotment/view_room_allotment','refresh');
    }
    $data['sub_view'] = 'roomsallotment/calendar';
    $this->load->view('_layout_main',$data);
}


 public function room_allotment_list() {  
  // echo '<pre>'; print_r($_POST); exit;
  $dataarray=array('supplier_hotel_list_id'=>$_POST['hotel_id'],'supplier_id'=>$this->supplier_id,'status'=>1);
  $data['rooms'] =$this->supplier_room_list->check($dataarray);
  $data['hotel_detail'] =$this->supplier_hotel_list->get_single($_POST['hotel_id']);
  $data['rooms_detail'] =$this->supplier_room_list->get_single($_POST['room_id']);
  $data['contract_id']=$_POST['contract'];
  $data['room_id']=$_POST['room_id'];
  $data['hotel_code']= $data['hotel_detail']->hotel_code;
  $data['hotel_id']=$_POST['hotel_id'];
  $from_date=$_POST['from_date'];
  $to_date=$_POST['to_date'];
  $data['startdate'] = date('Y-m-d', strtotime($from_date));
  $data['enddate'] = date('Y-m-d', strtotime($to_date));
   if(!isset($_POST['hotel_id']) || empty($data['rooms'])){
    redirect('roomsallotment/view_room_allotment','refresh');
    }
    $data['sub_view'] = 'roomsallotment/calendar';
    $this->load->view('_layout_main',$data);
}

public function get_room_allotment_list()
{   
     
    $yearend=$year=$_POST['year'];
    $month=$_POST['month'];
    $monthend=$month+1;
    if($month==12)
    { 
      $monthend=1;
      $yearend=$year+1;
    }   
    $room_id = $_POST['room_id'];
    $hotel_code = $_POST['hotel_code']; 
    $contract_id = $_POST['contract_id']; 
    $startdate = date('Y-m-d', strtotime($year . '-' .$month. '-1'));
    $enddate = date('Y-m-d', strtotime($yearend . '-' . $monthend. '-1'));
    $calender_data = $this->sup_hotel_room_rates->get_roomrates_by_date($room_id, $startdate, $enddate,$contract_id); 
    $calender_data1 = $this->sup_specialoffer_hotel_room_rates->get_roomrates_by_date($room_id, $startdate, $enddate,$contract_id,'');  
   $calendar=array();
   $calendar_date=array();
   $calendar1=array();
   $calendar_date1=array();
    list($calendar,$calendar_date)=$this->roomrates_calendar($calender_data);
    list($calendar1,$calendar_date1)=$this->roomrates_specialoffer_calendar($calender_data1); 
    if (!empty($calender_data)) {     
      
          echo json_encode(array('success' => 1, 'result' => array_merge($calendar,$calendar1),'result1' => array_merge($calendar_date,$calendar_date1)));
               
         } else {
                echo json_encode(array('success' => 1, 'result' => array(),'result1' => array()));
            }
}
public function get_room_allotment_monthlist()
{   
     
    $room_id = $_POST['room_id'];
    $hotel_code = $_POST['hotel_code']; 
    $contract_id = $_POST['contract_id']; 
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $calender_data = $this->sup_hotel_room_rates->get_roomrates_by_date($room_id, $startdate, $enddate,$contract_id); 
    $calender_data1 = $this->sup_specialoffer_hotel_room_rates->get_roomrates_by_date($room_id, $startdate, $enddate,$contract_id,'');  
   $calendar=array();
   $calendar_date=array();
   $calendar1=array();
   $calendar_date1=array();
    list($calendar,$calendar_date)=$this->roomrates_calendar($calender_data);
    list($calendar1,$calendar_date1)=$this->roomrates_specialoffer_calendar($calender_data1); 
    if (!empty($calender_data)) {     
      
          echo json_encode(array('success' => 1, 'result' => array_merge($calendar,$calendar1),'result1' => array_merge($calendar_date,$calendar_date1)));
               
         } else {
                echo json_encode(array('success' => 1, 'result' => array(),'result1' => array()));
            }
}
public function get_room_allotment_monthcalender()
{   
     
    $room_id = $_POST['room_id'];
    $hotel_code = $_POST['hotel_code']; 
    $contract_id = $_POST['contract_id']; 
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $startdate = date('Y-m-d', strtotime($from_date));
    $enddate = date('Y-m-d', strtotime($to_date));
    $room_allotment_type=$_POST['room_allotment_type'];
    $calender_data = $this->sup_hotel_room_rates->get_roomallotment_by_date($room_id,$hotel_code,$startdate, $enddate,$contract_id,$room_allotment_type); 
    $calender_data1 = $this->sup_specialoffer_hotel_room_rates->get_roomallotment_by_date($room_id,$hotel_code,$startdate, $enddate,$contract_id,$room_allotment_type);   
   $calendar=array();
   $calendar_date=array();
   $calendar1=array();
   $calendar_date1=array();
    list($calendar,$calendar_date)=$this->roomrates_calendar($calender_data);
    list($calendar1,$calendar_date1)=$this->roomrates_specialoffer_calendar($calender_data1); 
    if (!empty($calender_data)) {     
      
          echo json_encode(array('success' => 1, 'result' => array_merge($calendar,$calendar1),'result1' => array_merge($calendar_date,$calendar_date1),'startdate'=>$startdate));
               
         } else {
                echo json_encode(array('success' => 1, 'result' => array(),'result1' => array(),'startdate'=>$startdate));
            }
}
public function roomrates_specialoffer_calendar($calender_data)
{
  $calendar=array();
  $calendar_date=array();
   $k=0;
   for($i=0;$i<count($calender_data)&&!empty($calender_data[0]);$i++,$k++)
  {
       if($calender_data[$i]->rate_type=='PPPN')
       { 
           $room_allotment='';          
            if($calender_data[$i]->room_allotment_type=='freesell')
            {
                $room_allotment="No Limit";
            }
             if($calender_data[$i]->room_allotment_type=='stopsell')
            {
               $room_allotment="NA";
            }
             if($calender_data[$i]->room_allotment_type=='quantity')
            {
                $room_allotment=$calender_data[$i]->rooms_available.' Rooms Allocated';
            }
            $contract_number=$this->sup_contract->get_single($calender_data[$i]->contract_id)->contract_number;
          $meal_arrr=explode(',',$calender_data[$i]->meal_plan);
           $meal_plan=array();
            for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
            {
              $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
            }
            $meal_plan_str=implode(',', $meal_plan); 
            $special_str='';
            $special_str.="\nSpecial Offer Type : ".$calender_data[$i]->specialoffer_type;
            if($calender_data[$i]->specialoffer_id==1 && $calender_data[$i]->specialoffer_type=="Discount")
            {
              if($calender_data[$i]->discount_rate_type=='net')
              {
                $special_str.="\nDiscount Type : NET";
              } 
              else if($calender_data[$i]->discount_rate_type=='gross')
              {
                $special_str.="\nDiscount Type : GROSS";
              }
              $special_str.="\nDiscount (%) :".$calender_data[$i]->discount_percentage;
            }
            else if($calender_data[$i]->specialoffer_id==2 && $calender_data[$i]->specialoffer_type=="Early bird")
            { 
              if($calender_data[$i]->prior_day_type=="prior_checkin")
               {
                  $special_str.="\nNumber of Prior Checkin Days :".$calender_data[$i]->prior_checkin;
               }
               if($calender_data[$i]->prior_day_type=="prior_checkin_date")
               {
                  $special_str.="\nPrior Booking Date :".date('d-m-Y',strtotime($calender_data[$i]->prior_checkin_date));
               }
               if($calender_data[$i]->prior_day_type=="period")
               {
                  $special_str.="\nPrior Booking Period : From ".date('d-m-Y',strtotime($calender_data[$i]->period_from_date)).' to '.date('d-m-Y',strtotime($calender_data[$i]->period_to_date));
               }
            if($calender_data[$i]->discount_rate_type=='net')
            {
              $special_str.="\nDiscount Type : NET";
            }
            else if($calender_data[$i]->discount_rate_type=='gross')
            {
              $special_str.="\nDiscount Type : GROSS";
            }
            $special_str.="\nDiscount (%) :".$calender_data[$i]->discount_percentage;
            }
            else if($calender_data[$i]->specialoffer_id==3 && $calender_data[$i]->specialoffer_type=="Stay Pay")
            { 
               if($calender_data[$i]->prior_day_type=="prior_checkin")
               {
                  $special_str.="\nNumber of Prior Checkin Days :".$calender_data[$i]->prior_checkin;
               }
               if($calender_data[$i]->prior_day_type=="prior_checkin_date")
               {
                  $special_str.="\nPrior Booking Date :".date('d-m-Y',strtotime($calender_data[$i]->prior_checkin_date));
               }
               if($calender_data[$i]->prior_day_type=="period")
               {
                  $special_str.="\nPrior Booking Period : From ".date('d-m-Y',strtotime($calender_data[$i]->period_from_date)).' to '.date('d-m-Y',strtotime($calender_data[$i]->period_to_date));
               }
              $special_str.="\nMin number of stay days :".$calender_data[$i]->min_no_of_stay_day;
              $special_str.="\nMax number of stay days :".$calender_data[$i]->max_no_of_stay_day;
              $special_str.="\nNumber of free nights :".$calender_data[$i]->no_of_stay_free_nights;
            }  
            else if($calender_data[$i]->specialoffer_id==4 && $calender_data[$i]->specialoffer_type=="Supplement")
            { 
                $special_str.="\nCompulsory :".$calender_data[$i]->supplement_compulsory;
              if($calender_data[$i]->type_of_supplement=='extra_charge')
              {
                $special_str.="\nType of Supplement : Extra Charges (on top of rate)";
              }
              else if($calender_data[$i]->type_of_supplement=='full_charge')
              {
                $special_str.="\nType of Supplement : Full Charge";
              }
                $special_str.="\nAge limits for Supplement :".$calender_data[$i]->age_limit_for_supplement;
                $special_str.="\nSupplement Rate :".$calender_data[$i]->supplement_rate;
                $special_str.="\nDecription of Supplement :".$calender_data[$i]->supplement_desc;
            }

              $child_rate_str='';
              $child_rate=json_decode($calender_data[$i]->child_rate,true);
              if(!empty($child_rate[0]))
                {                    
                  foreach ($child_rate as $key => $value)
                  { 
                    $val=explode('||', $value);   
                    $val1=explode('-', $val[0]);   
                    $child_rate_str.=" \nAge( ".$val[0]." ) ".$val[1]; 
                  }
                }

          $calendar[$k]= "\nRoom Allotment : ".$room_allotment.   
          " \nRate Type  : PPPN ".
          "\nAdult Rate : ".$calender_data[$i]->adult_rate.
          "\nChild Rate : ".$child_rate_str.$special_str;
          $calendar_date[$k]=$calender_data[$i]->room_avail_date;

      }
      else  if($calender_data[$i]->rate_type=='PRPN')
      {
           $room_allotment='';          
            if($calender_data[$i]->room_allotment_type=='freesell')
            {
                $room_allotment="No Limit";
            }
             if($calender_data[$i]->room_allotment_type=='stopsell')
            {
               $room_allotment="NA";
            }
             if($calender_data[$i]->room_allotment_type=='quantity')
            {
                $room_allotment=$calender_data[$i]->rooms_available.' Rooms Allocated';
            }
            $contract_number=$this->sup_contract->get_single($calender_data[$i]->contract_id)->contract_number;
           $meal_arrr=explode(',',$calender_data[$i]->meal_plan);
           $meal_plan=array();
            for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
            {
              $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
            }
            $meal_plan_str=implode(',', $meal_plan); 
             $special_str='';
            $special_str.="\nSpecial Offer Type : ".$calender_data[$i]->specialoffer_type;
            if($calender_data[$i]->specialoffer_id==1 && $calender_data[$i]->specialoffer_type=="Discount")
            {
              if($calender_data[$i]->discount_rate_type=='net')
              {
                $special_str.="\nDiscount Type : NET";
              } 
              else if($calender_data[$i]->discount_rate_type=='gross')
              {
                $special_str.="\nDiscount Type : GROSS";
              }
              $special_str.="\nDiscount (%) :".$calender_data[$i]->discount_percentage;
            }
            else if($calender_data[$i]->specialoffer_id==2 && $calender_data[$i]->specialoffer_type=="Early bird")
            { 
               if($calender_data[$i]->prior_day_type=="prior_checkin")
               {
                  $special_str.="\nNumber of Prior Checkin Days :".$calender_data[$i]->prior_checkin;
               }
               if($calender_data[$i]->prior_day_type=="prior_checkin_date")
               {
                  $special_str.="\nPrior Booking Date :".date('d-m-Y',strtotime($calender_data[$i]->prior_checkin_date));
               }
               if($calender_data[$i]->prior_day_type=="period")
               {
                  $special_str.="\nPrior Booking Period : From ".date('d-m-Y',strtotime($calender_data[$i]->period_from_date)).' to '.date('d-m-Y',strtotime($calender_data[$i]->period_to_date));
               }
              if($calender_data[$i]->discount_rate_type=='net')
              {
                $special_str.="\nDiscount Type : NET";
              }
              else if($calender_data[$i]->discount_rate_type=='gross')
              {
                $special_str.="\nDiscount Type : GROSS";
              }
              $special_str.="\nDiscount (%) :".$calender_data[$i]->discount_percentage;
            }
            else if($calender_data[$i]->specialoffer_id==3 && $calender_data[$i]->specialoffer_type=="Stay Pay")
            { 
               if($calender_data[$i]->prior_day_type=="prior_checkin")
               {
                  $special_str.="\nNumber of Prior Checkin Days :".$calender_data[$i]->prior_checkin;
               }
               if($calender_data[$i]->prior_day_type=="prior_checkin_date")
               {
                  $special_str.="\nPrior Booking Date :".date('d-m-Y',strtotime($calender_data[$i]->prior_checkin_date));
               }
               if($calender_data[$i]->prior_day_type=="period")
               {
                  $special_str.="\nPrior Booking Period : From ".date('d-m-Y',strtotime($calender_data[$i]->period_from_date)).' to '.date('d-m-Y',strtotime($calender_data[$i]->period_to_date));
               }
              $special_str.="\nMin number of stay days :".$calender_data[$i]->min_no_of_stay_day;
              $special_str.="\nMax number of stay days :".$calender_data[$i]->max_no_of_stay_day;
              $special_str.="\nNumber of free nights :".$calender_data[$i]->no_of_stay_free_nights;
            }  
            else if($calender_data[$i]->specialoffer_id==4 && $calender_data[$i]->specialoffer_type=="Supplement")
            { 
                $special_str.="\nCompulsory :".$calender_data[$i]->supplement_compulsory;
              if($calender_data[$i]->type_of_supplement=='extra_charge')
              {
                $special_str.="\nType of Supplement : Extra Charges (on top of rate)";
              }
              else if($calender_data[$i]->type_of_supplement=='full_charge')
              {
                $special_str.="\nType of Supplement : Full Charge";
              }
                $special_str.="\nAge limits for Supplement :".$calender_data[$i]->age_limit_for_supplement;
                $special_str.="\nSupplement Rate :".$calender_data[$i]->supplement_rate;
                $special_str.="\nDecription of Supplement :".$calender_data[$i]->supplement_desc;
            }

            $calendar[$k]= "\nRoom Allotment : ".$room_allotment.    
            " \nRate Type  : PRPN ".
            "\nRoom Rate : ".$calender_data[$i]->room_rate.$special_str;
              $calendar_date[$k]=$calender_data[$i]->room_avail_date;
      }
    }
     return array($calendar,$calendar_date);   
}
public function roomrates_calendar($calender_data)
{
  $calendar=array();
  $calendar_date=array();
   $k=0;
   for($i=0;$i<count($calender_data)&&!empty($calender_data[0]);$i++,$k++)
  {
       if($calender_data[$i]->rate_type=='PPPN')
       { 
           $room_allotment='';          
            if($calender_data[$i]->room_allotment_type=='freesell')
            {
                $room_allotment="No Limit";
            }
             if($calender_data[$i]->room_allotment_type=='stopsell')
            {
               $room_allotment="NA";
            }
             if($calender_data[$i]->room_allotment_type=='quantity')
            {
                $room_allotment=$calender_data[$i]->rooms_available.' Rooms Allocated';
            }
            $contract_number=$this->sup_contract->get_single($calender_data[$i]->contract_id)->contract_number;
           $meal_arrr=explode(',',$calender_data[$i]->meal_plan);
           $meal_plan=array();
            for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
            {
              $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
            }
            $meal_plan_str=implode(',', $meal_plan); 

              $child_rate_str='';
              $child_rate=json_decode($calender_data[$i]->child_rate,true);
              if(!empty($child_rate[0]))
                {                    
                  foreach ($child_rate as $key => $value)
                  { 
                    $val=explode('||', $value);   
                    $val1=explode('-', $val[0]);   
                    $child_rate_str.=" \nAge( ".$val[0]." ) ".$val[1]; 
                  }
                }
          $calendar[$k]= "\nRoom Allotment : ".$room_allotment. 
          " \nRate Type  : PPPN ".
          "\nAdult Rate : ".$calender_data[$i]->adult_rate.
          "\nChild Rate : ".$child_rate_str;        
            $calendar_date[$k]=$calender_data[$i]->room_avail_date;

      }
      else  if($calender_data[$i]->rate_type=='PRPN')
      {
           $room_allotment='';          
            if($calender_data[$i]->room_allotment_type=='freesell')
            {
                $room_allotment="No Limit";
            }
             if($calender_data[$i]->room_allotment_type=='stopsell')
            {
               $room_allotment="NA";
            }
             if($calender_data[$i]->room_allotment_type=='quantity')
            {
                $room_allotment=$calender_data[$i]->rooms_available.' Rooms Allocated';
            }
            $contract_number=$this->sup_contract->get_single($calender_data[$i]->contract_id)->contract_number;
           $meal_arrr=explode(',',$calender_data[$i]->meal_plan);
           $meal_plan=array();
            for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
            {
              $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
            }
            $meal_plan_str=implode(',', $meal_plan); 
            $calendar[$k]= "\nRoom Allotment : ".$room_allotment.   
            " \nRate Type  : PRPN ".
            "\nRoom Rate : ".$calender_data[$i]->room_rate;                 
          
              $calendar_date[$k]=$calender_data[$i]->room_avail_date;
      }
    }
      return array($calendar,$calendar_date); 
}




public function get_hotel_details()
{
  $dataarray=array('supplier_hotel_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id,'status'=>1,'status1'=>1);
  $data['contract_list']=$this->sup_contract->check($dataarray);
  // echo '<pre>'; print_r($data); 
  $dataarray=array('supplier_hotel_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id,'status'=>1);
  $data['room_list']=$this->supplier_room_list->check($dataarray);
   // echo '<pre>'; print_r($data);  exit;
  echo json_encode(array('contract_list'=>$this->load->view('roomrate/load_ajax_contract_list', $data, TRUE),'room_list'=>$this->load->view('roomrate/load_ajax_room_list', $data, TRUE)));
}

public function get_market_details()
{
  $dataarray=array('contract_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id,'status'=>1,'status1'=>1);
  $data['contract_info']=$this->sup_contract->check($dataarray);
  $dataarray=array('supplier_hotel_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id,'status'=>1);
  $countryarr=array();
  $data['country']=$this->country->get();  
  $contract_duration='';
  if(!empty($data['contract_info'][0]))
  {

  $contract_duration='contract Period : From '.date('d-M-Y',strtotime($data['contract_info'][0]->start_date)).' to '.date('d-M-Y',strtotime($data['contract_info'][0]->end_date));
  }
  echo json_encode(array('market_list'=>$this->load->view('roomrate/load_ajax_market_list', $data, TRUE),'contract_duration'=>$contract_duration));
}

public function get_mealplan_details()
{
  $dataarray=array('supplier_room_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id,'status'=>1);
  $room_mealplan_list=$this->supplier_room_list->check($dataarray)[0]->mealplan; 
  $data['room_mealplan_list']=explode(',', $room_mealplan_list);
  $mealplan=$this->glb_hotel_meal_plan->get(); 
  $mealplanarr=array();
  for($i=0;$i<count($mealplan)&&!empty($mealplan);$i++)
  {
     $mealplanarr[$mealplan[$i]->id]=$mealplan[$i]->meal_plan;
  }
  $data['mealplan'] =$mealplanarr; 
  // print_r($data); exit;
  echo json_encode(array('meal_list'=>$this->load->view('roomrate/load_ajax_meal_list', $data, TRUE)));
}

}
