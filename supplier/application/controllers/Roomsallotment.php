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
    $this->load->model('sup_hotel_room_allotment');
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
  
  $dataarray=array('supplier_hotel_list_id'=>$_POST['hotel_id'],'supplier_id'=>$this->supplier_id,'status'=>1);
  $data['room_list'] =$this->supplier_room_list->check($dataarray); 
  if(!isset($_POST['hotel_id']) || empty($data['room_list']))
  { 
   
     echo json_encode(array('result' => ''));
  }
  else if($this->input->server('REQUEST_METHOD') === 'POST')
   {    

      $this->form_validation->set_rules('hotel_id', ' Hotel ', 'required');
      $this->form_validation->set_rules('room_id', ' Room ', 'required');
       $this->form_validation->set_rules('contract', 'Contract ', 'required');
      if($this->form_validation->run())
      {
        $hotel_id = $this->input->post('hotel_id');
        $room_id = $this->input->post('room_id');     
        $contract_id = $this->input->post('contract');             
        $from_date=strtotime($_POST['from_date']);
        $to_date=strtotime($_POST['to_date']);
        $startdate= date("Y-m-d", $from_date);
        $enddate= date("Y-m-d", $to_date);
        $room_allotment_type=$_POST['room_allotment_type'];
        $rooms_available=$_POST['rooms_available'];
        $hotel_detail =$this->supplier_hotel_list->get_single($hotel_id);
        $get_selected_room_code =$this->supplier_room_list->get_single($room_id);
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
          $hotel_code=$hotel_detail->hotel_code;
          $room_code=$get_selected_room_code->room_code;
          $insert_room_allotment_list=array(    
            'supplier_id' =>$this->supplier_id,
            'sup_hotel_id' => $hotel_id,
            'hotel_code' => $hotel_code,
            'room_code'=>$room_code,
            'contract_id' => $contract_id,
            'sup_room_details_id'=> $room_id,                 
            'from_date'=> $startdate,
            'to_date'=>$enddate, 
             'room_allotment_type'=> $room_allotment_type,
            'rooms_available'=> $rooms_available,
            'status' => '1'
          );
          $sup_hotel_room_allotment_list_id=$this->sup_hotel_room_allotment_list->insert($insert_room_allotment_list);

          for($i=0;$i<=$days;$i++)
            {  
              $incr_date = strtotime("+".$i." days", $from_date);
              $room_avail_date=date("Y-m-d", $incr_date);
              $dataarray=array('supplier_id' =>$this->supplier_id,
                              'sup_hotel_id' => $hotel_id,
                              'hotel_code' => $hotel_code,
                              'room_code'=>$room_code,
                              'contract_id' => $contract_id,
                              'sup_room_details_id'=> $room_id,
                              'room_avail_date'=>$room_avail_date);
              $check=$this->sup_hotel_room_allotment->check($dataarray);
               if(!empty($check))
                {
                  if($room_allotment_type=="quantity")
                  {
                   $updatedata=array(
                                  'sup_hotel_room_allotment_list_id'=>$sup_hotel_room_allotment_list_id,   
                                 'room_allotment_type'=> $room_allotment_type,
                                 'rooms_available'=> $rooms_available+$check[0]->total_booking,
                                  );
                   }
                   else
                   {
                    $updatedata=array(
                                  'sup_hotel_room_allotment_list_id'=>$sup_hotel_room_allotment_list_id,   
                                 'room_allotment_type'=> $room_allotment_type,
                                 'rooms_available'=> $rooms_available,
                                  );
                   }
                  $this->sup_hotel_room_allotment->update($updatedata,$check[0]->sup_hotel_room_allotment_id);
                }
              else
              {
                  $insert_room_allotment=array( 
                  'sup_hotel_room_allotment_list_id'=>$sup_hotel_room_allotment_list_id,   
                  'supplier_id' =>$this->supplier_id,
                  'sup_hotel_id' => $hotel_id,
                  'hotel_code' => $hotel_code,
                  'room_code'=>$room_code,
                  'contract_id' => $contract_id,
                  'sup_room_details_id'=> $room_id,              
                 'room_allotment_type'=> $room_allotment_type,
                  'rooms_available'=> $rooms_available,
                  'room_avail_date'=>$room_avail_date,           
                );
                $this->sup_hotel_room_allotment->insert($insert_room_allotment);
               }
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
  // $data['rooms_detail'] =$this->supplier_room_list->get_single($_POST['room_id']);
  $data['contract_id']=$_POST['contract'];
  // $data['room_id']=$_POST['room_id'];
  $data['hotel_code']= $data['hotel_detail']->hotel_code;
  $data['hotel_id']=$_POST['hotel_id'];
  $data['contract_detail']=$this->sup_contract->get_single($_POST['contract']);
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
    $hotel_id = $_POST['hotel_id'];
    $hotel_code = $_POST['hotel_code']; 
    $contract_id = $_POST['contract_id']; 
    $startdate = date('Y-m-d', strtotime($year . '-' .$month. '-1'));
    $enddate = date('Y-m-d', strtotime($yearend . '-' . $monthend. '-1'));
    $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'hotel_code'=>$hotel_code,'supplier_id'=>$this->supplier_id,'status'=>1);
    $room_list=$this->supplier_room_list->check($dataarray);
    $calendar=array();
    $calendar_room_name=array();
    $calendar_date=array();
    if(!empty($room_list[0]))
    {
      $k=0;
      for($i=0;$i<count($room_list);$i++)
      {          
               $days=floor((strtotime($enddate) - strtotime($startdate)) / (60 * 60 * 24)); 
                for($l=0;$l<=$days;$l++)
                {  
                 $incr_date = strtotime("+".$l." days", strtotime($startdate));
                 $room_avail_date=date("Y-m-d", $incr_date); 
                 $dataarray1=array('sup_hotel_id'=>$hotel_id,'sup_room_details_id'=>$room_list[$i]->supplier_room_list_id,'contract_id'=>$contract_id,'room_avail_date'=>$room_avail_date,'hotel_code'=>$hotel_code,'supplier_id'=>$this->supplier_id);
                 $room_allotment_list=$this->sup_hotel_room_allotment->check($dataarray1);
                  $room_allotment_list1=$this->sup_specialoffer_hotel_room_rates->check($dataarray1);
                 if($room_allotment_list!='')
                 {
                   if($room_allotment_list[0]->room_allotment_type=='freesell')
                    {
                        $room_allotment="No Limit";
                    }
                     if($room_allotment_list[0]->room_allotment_type=='stopsell')
                    {
                       $room_allotment="NA";
                    }
                     if($room_allotment_list[0]->room_allotment_type=='quantity')
                    {
                          $room_allotment=$room_allotment_list[0]->rooms_available;
                    }
                   $calendar[$k]= "<small>".$room_list[$i]->room_name." (".$this->glb_hotel_room_type->get_single($room_list[$i]->hotel_room_type)->room_type.") : <span style='color:red'>".$room_allotment."</span></small>"; 
                   $calendar_date[$k]=$room_avail_date;
                   $k++;
                } 
                else if($room_allotment_list1!='')
                 {
                   if($room_allotment_list1[0]->room_allotment_type=='freesell')
                    {
                        $room_allotment="No Limit";
                    }
                     if($room_allotment_list1[0]->room_allotment_type=='stopsell')
                    {
                       $room_allotment="NA";
                    }
                     if($room_allotment_list1[0]->room_allotment_type=='quantity')
                    {
                            $room_allotment=$room_allotment_list1[0]->rooms_available;
                    }
                    $calendar[$k]= "<small>".$room_list[$i]->room_name." (".$this->glb_hotel_room_type->get_single($room_list[$i]->hotel_room_type)->room_type.") : <span style='color:red'>".$room_allotment."</span></small>"; 
                   $calendar_date[$k]=$room_avail_date;
                   $k++;
                }
                else
                {
                    $calendar[$k]= "<small>".$room_list[$i]->room_name." (".$this->glb_hotel_room_type->get_single($room_list[$i]->hotel_room_type)->room_type.") : <span style='color:red'>NA</span></small>"; 
                   $calendar_date[$k]=$room_avail_date;
                   $k++;
                }
              }
            }
      }
  
    if (!empty($calendar)) {     
      
          echo json_encode(array('success' => 1, 'result' =>$calendar,'result1' => $calendar_date));
               
         } else {
                echo json_encode(array('success' => 1, 'result' => array(),'result1' => array()));
            }
}
public function get_room_allotment_monthlist()
{   
     
    $hotel_id = $_POST['hotel_id'];
    $hotel_code = $_POST['hotel_code']; 
    $contract_id = $_POST['contract_id']; 
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'hotel_code'=>$hotel_code,'supplier_id'=>$this->supplier_id,'status'=>1);
    $room_list=$this->supplier_room_list->check($dataarray);
    $calendar=array();
    $calendar_room_name=array();
    $calendar_date=array();
    if(!empty($room_list[0]))
    {
      $k=0;
      for($i=0;$i<count($room_list);$i++)
      {
         
               $days=floor((strtotime($enddate) - strtotime($startdate)) / (60 * 60 * 24)); 
                for($l=0;$l<=$days;$l++)
                {  
                 $incr_date = strtotime("+".$l." days", strtotime($startdate));
                 $room_avail_date=date("Y-m-d", $incr_date); 
                 $dataarray1=array('sup_hotel_id'=>$hotel_id,'sup_room_details_id'=>$room_list[$i]->supplier_room_list_id,'contract_id'=>$contract_id,'room_avail_date'=>$room_avail_date,'hotel_code'=>$hotel_code,'supplier_id'=>$this->supplier_id);
                 $room_allotment_list=$this->sup_hotel_room_allotment->check($dataarray1);
                  $room_allotment_list1=$this->sup_specialoffer_hotel_room_rates->check($dataarray1);
                 if($room_allotment_list!='')
                 {
                   if($room_allotment_list[0]->room_allotment_type=='freesell')
                    {
                        $room_allotment="No Limit";
                    }
                     if($room_allotment_list[0]->room_allotment_type=='stopsell')
                    {
                       $room_allotment="NA";
                    }
                     if($room_allotment_list[0]->room_allotment_type=='quantity')
                    {
                          $room_allotment=$room_allotment_list[0]->rooms_available;
                    }
                    $calendar[$k]= "<small>".$room_list[$i]->room_name." (".$this->glb_hotel_room_type->get_single($room_list[$i]->hotel_room_type)->room_type.") : <span style='color:red'>".$room_allotment."</span></small>"; 
                   $calendar_date[$k]=$room_avail_date;
                   $k++;
                } 
                else if($room_allotment_list1!='')
                 {
                   if($room_allotment_list1[0]->room_allotment_type=='freesell')
                    {
                        $room_allotment="No Limit";
                    }
                     if($room_allotment_list1[0]->room_allotment_type=='stopsell')
                    {
                       $room_allotment="NA";
                    }
                     if($room_allotment_list1[0]->room_allotment_type=='quantity')
                    {
                            $room_allotment=$room_allotment_list1[0]->rooms_available;
                    }
                    $calendar[$k]= "<small>".$room_list[$i]->room_name." (".$this->glb_hotel_room_type->get_single($room_list[$i]->hotel_room_type)->room_type.") : <span style='color:red'>".$room_allotment."</span></small>"; 
                   $calendar_date[$k]=$room_avail_date;
                   $k++;
                }
                else
                {
                    $calendar[$k]= "<small>".$room_list[$i]->room_name." (".$this->glb_hotel_room_type->get_single($room_list[$i]->hotel_room_type)->room_type.") : <span style='color:red'>NA</span></small>"; 
                   $calendar_date[$k]=$room_avail_date;
                   $k++;
                }
              }
            }
      }
    if (!empty($calendar)) {     
      
          echo json_encode(array('success' => 1, 'result' => $calendar,'result1' => $calendar_date));
               
         } else {
                echo json_encode(array('success' => 1, 'result' => array(),'result1' => array()));
            }
}
public function get_room_allotment_monthcalender()
{   
     
    $hotel_id = $_POST['hotel_id'];
    $hotel_code = $_POST['hotel_code']; 
    $contract_id = $_POST['contract_id']; 
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $startdate = date('Y-m-d', strtotime($from_date));
    $enddate = date('Y-m-d', strtotime($to_date));
    $room_allotment_type=$_POST['room_allotment_type'];
   $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'hotel_code'=>$hotel_code,'supplier_id'=>$this->supplier_id,'status'=>1);
    $room_list=$this->supplier_room_list->check($dataarray);
    $calendar=array();
    $calendar_room_name=array();
    $calendar_date=array();
    if(!empty($room_list[0]))
    {
      $k=0;
      for($i=0;$i<count($room_list);$i++)
      {   
         
               $days=floor((strtotime($to_date) - strtotime($from_date)) / (60 * 60 * 24)); 
                // echo $days.'123'; exit;
                for($l=0;$l<=$days;$l++)
                {  

                 $incr_date = strtotime("+".$l." days", strtotime($from_date));
                 $room_avail_date=date("Y-m-d", $incr_date); 
                 if(!empty($room_allotment_type)){ 
                 $dataarray1=array('sup_hotel_id'=>$hotel_id,'sup_room_details_id'=>$room_list[$i]->supplier_room_list_id,'contract_id'=>$contract_id,'room_avail_date'=>$room_avail_date,'hotel_code'=>$hotel_code,'supplier_id'=>$this->supplier_id, 'room_allotment_type'=>$room_allotment_type);
                 }
                 else
                 {
                    $dataarray1=array('sup_hotel_id'=>$hotel_id,'sup_room_details_id'=>$room_list[$i]->supplier_room_list_id,'contract_id'=>$contract_id,'room_avail_date'=>$room_avail_date,'hotel_code'=>$hotel_code,'supplier_id'=>$this->supplier_id);
                 }
                 $room_allotment_list=$this->sup_hotel_room_allotment->check($dataarray1);
                  $room_allotment_list1=$this->sup_specialoffer_hotel_room_rates->check($dataarray1);
                 if($room_allotment_list!='')
                 {
                   if($room_allotment_list[0]->room_allotment_type=='freesell')
                    {
                        $room_allotment="No Limit";
                    }
                     if($room_allotment_list[0]->room_allotment_type=='stopsell')
                    {
                       $room_allotment="NA";
                    }
                     if($room_allotment_list[0]->room_allotment_type=='quantity')
                    {
                          $room_allotment=$room_allotment_list[0]->rooms_available;
                    }
                    $calendar[$k]= "<small>".$room_list[$i]->room_name." (".$this->glb_hotel_room_type->get_single($room_list[$i]->hotel_room_type)->room_type.") : <span style='color:red'>".$room_allotment."</span></small>"; 
                   $calendar_date[$k]=$room_avail_date;
                   $k++;
                } 
                else if($room_allotment_list1!='')
                 {
                   if($room_allotment_list1[0]->room_allotment_type=='freesell')
                    {
                        $room_allotment="No Limit";
                    }
                     if($room_allotment_list1[0]->room_allotment_type=='stopsell')
                    {
                       $room_allotment="NA";
                    }
                     if($room_allotment_list1[0]->room_allotment_type=='quantity')
                    {
                            $room_allotment=$room_allotment_list1[0]->rooms_available;
                    }
                    $calendar[$k]= "<small>".$room_list[$i]->room_name." (".$this->glb_hotel_room_type->get_single($room_list[$i]->hotel_room_type)->room_type.") : <span style='color:red'>".$room_allotment."</span></small>"; 
                   $calendar_date[$k]=$room_avail_date;
                   $k++;
                }
                else
                {
                   if(empty($room_allotment_type)){ 
                    $calendar[$k]= "<small>".$room_list[$i]->room_name." (".$this->glb_hotel_room_type->get_single($room_list[$i]->hotel_room_type)->room_type.") : <span style='color:red'>NA</span></small>"; 
                   $calendar_date[$k]=$room_avail_date;
                   $k++;
                 }
                }
              }
            }
      }
         

    if (!empty($calendar)) {     
      
          echo json_encode(array('success' => 1, 'result' => $calendar,'result1' => $calendar_date,'startdate'=>$startdate));
               
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
            $special_str.="<br>Special Offer Type : ".$calender_data[$i]->specialoffer_type;
            if($calender_data[$i]->specialoffer_id==1 && $calender_data[$i]->specialoffer_type=="Discount")
            {
              if($calender_data[$i]->discount_rate_type=='net')
              {
                $special_str.="<br>Discount Type : NET";
              } 
              else if($calender_data[$i]->discount_rate_type=='gross')
              {
                $special_str.="<br>Discount Type : GROSS";
              }
              $special_str.="<br>Discount (%) :".$calender_data[$i]->discount_percentage;
            }
            else if($calender_data[$i]->specialoffer_id==2 && $calender_data[$i]->specialoffer_type=="Early bird")
            { 
              if($calender_data[$i]->prior_day_type=="prior_checkin")
               {
                  $special_str.="<br>Number of Prior Checkin Days :".$calender_data[$i]->prior_checkin;
               }
               if($calender_data[$i]->prior_day_type=="prior_checkin_date")
               {
                  $special_str.="<br>Prior Booking Date :".date('d-m-Y',strtotime($calender_data[$i]->prior_checkin_date));
               }
               if($calender_data[$i]->prior_day_type=="period")
               {
                  $special_str.="<br>Prior Booking Period : From ".date('d-m-Y',strtotime($calender_data[$i]->period_from_date)).' to '.date('d-m-Y',strtotime($calender_data[$i]->period_to_date));
               }
            if($calender_data[$i]->discount_rate_type=='net')
            {
              $special_str.="<br>Discount Type : NET";
            }
            else if($calender_data[$i]->discount_rate_type=='gross')
            {
              $special_str.="<br>Discount Type : GROSS";
            }
            $special_str.="<br>Discount (%) :".$calender_data[$i]->discount_percentage;
            }
            else if($calender_data[$i]->specialoffer_id==3 && $calender_data[$i]->specialoffer_type=="Stay Pay")
            { 
               if($calender_data[$i]->prior_day_type=="prior_checkin")
               {
                  $special_str.="<br>Number of Prior Checkin Days :".$calender_data[$i]->prior_checkin;
               }
               if($calender_data[$i]->prior_day_type=="prior_checkin_date")
               {
                  $special_str.="<br>Prior Booking Date :".date('d-m-Y',strtotime($calender_data[$i]->prior_checkin_date));
               }
               if($calender_data[$i]->prior_day_type=="period")
               {
                  $special_str.="<br>Prior Booking Period : From ".date('d-m-Y',strtotime($calender_data[$i]->period_from_date)).' to '.date('d-m-Y',strtotime($calender_data[$i]->period_to_date));
               }
              $special_str.="<br>Min number of stay days :".$calender_data[$i]->min_no_of_stay_day;
              $special_str.="<br>Max number of stay days :".$calender_data[$i]->max_no_of_stay_day;
              $special_str.="<br>Number of free nights :".$calender_data[$i]->no_of_stay_free_nights;
            }  
            else if($calender_data[$i]->specialoffer_id==4 && $calender_data[$i]->specialoffer_type=="Supplement")
            { 
                $special_str.="<br>Compulsory :".$calender_data[$i]->supplement_compulsory;
              if($calender_data[$i]->type_of_supplement=='extra_charge')
              {
                $special_str.="<br>Type of Supplement : Extra Charges (on top of rate)";
              }
              else if($calender_data[$i]->type_of_supplement=='full_charge')
              {
                $special_str.="<br>Type of Supplement : Full Charge";
              }
                $special_str.="<br>Age limits for Supplement :".$calender_data[$i]->age_limit_for_supplement;
                $special_str.="<br>Supplement Rate :".$calender_data[$i]->supplement_rate;
                $special_str.="<br>Decription of Supplement :".$calender_data[$i]->supplement_desc;
            }

              $child_rate_str='';
              $child_rate=json_decode($calender_data[$i]->child_rate,true);
              if(!empty($child_rate[0]))
                {                    
                  foreach ($child_rate as $key => $value)
                  { 
                    $val=explode('||', $value);   
                    $val1=explode('-', $val[0]);   
                    $child_rate_str.=" <br>Age( ".$val[0]." ) ".$val[1]; 
                  }
                }

          $calendar[$k]="<br>".$room_list[$i]->room_name." : ".$room_allotment;  
          " <br>Rate Type  : PPPN ".
          "<br>Adult Rate : ".$calender_data[$i]->adult_rate.
          "<br>Child Rate : ".$child_rate_str.$special_str;
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
            $special_str.="<br>Special Offer Type : ".$calender_data[$i]->specialoffer_type;
            if($calender_data[$i]->specialoffer_id==1 && $calender_data[$i]->specialoffer_type=="Discount")
            {
              if($calender_data[$i]->discount_rate_type=='net')
              {
                $special_str.="<br>Discount Type : NET";
              } 
              else if($calender_data[$i]->discount_rate_type=='gross')
              {
                $special_str.="<br>Discount Type : GROSS";
              }
              $special_str.="<br>Discount (%) :".$calender_data[$i]->discount_percentage;
            }
            else if($calender_data[$i]->specialoffer_id==2 && $calender_data[$i]->specialoffer_type=="Early bird")
            { 
               if($calender_data[$i]->prior_day_type=="prior_checkin")
               {
                  $special_str.="<br>Number of Prior Checkin Days :".$calender_data[$i]->prior_checkin;
               }
               if($calender_data[$i]->prior_day_type=="prior_checkin_date")
               {
                  $special_str.="<br>Prior Booking Date :".date('d-m-Y',strtotime($calender_data[$i]->prior_checkin_date));
               }
               if($calender_data[$i]->prior_day_type=="period")
               {
                  $special_str.="<br>Prior Booking Period : From ".date('d-m-Y',strtotime($calender_data[$i]->period_from_date)).' to '.date('d-m-Y',strtotime($calender_data[$i]->period_to_date));
               }
              if($calender_data[$i]->discount_rate_type=='net')
              {
                $special_str.="<br>Discount Type : NET";
              }
              else if($calender_data[$i]->discount_rate_type=='gross')
              {
                $special_str.="<br>Discount Type : GROSS";
              }
              $special_str.="<br>Discount (%) :".$calender_data[$i]->discount_percentage;
            }
            else if($calender_data[$i]->specialoffer_id==3 && $calender_data[$i]->specialoffer_type=="Stay Pay")
            { 
               if($calender_data[$i]->prior_day_type=="prior_checkin")
               {
                  $special_str.="<br>Number of Prior Checkin Days :".$calender_data[$i]->prior_checkin;
               }
               if($calender_data[$i]->prior_day_type=="prior_checkin_date")
               {
                  $special_str.="<br>Prior Booking Date :".date('d-m-Y',strtotime($calender_data[$i]->prior_checkin_date));
               }
               if($calender_data[$i]->prior_day_type=="period")
               {
                  $special_str.="<br>Prior Booking Period : From ".date('d-m-Y',strtotime($calender_data[$i]->period_from_date)).' to '.date('d-m-Y',strtotime($calender_data[$i]->period_to_date));
               }
              $special_str.="<br>Min number of stay days :".$calender_data[$i]->min_no_of_stay_day;
              $special_str.="<br>Max number of stay days :".$calender_data[$i]->max_no_of_stay_day;
              $special_str.="<br>Number of free nights :".$calender_data[$i]->no_of_stay_free_nights;
            }  
            else if($calender_data[$i]->specialoffer_id==4 && $calender_data[$i]->specialoffer_type=="Supplement")
            { 
                $special_str.="<br>Compulsory :".$calender_data[$i]->supplement_compulsory;
              if($calender_data[$i]->type_of_supplement=='extra_charge')
              {
                $special_str.="<br>Type of Supplement : Extra Charges (on top of rate)";
              }
              else if($calender_data[$i]->type_of_supplement=='full_charge')
              {
                $special_str.="<br>Type of Supplement : Full Charge";
              }
                $special_str.="<br>Age limits for Supplement :".$calender_data[$i]->age_limit_for_supplement;
                $special_str.="<br>Supplement Rate :".$calender_data[$i]->supplement_rate;
                $special_str.="<br>Decription of Supplement :".$calender_data[$i]->supplement_desc;
            }

            $calendar[$k]="<br>".$room_list[$i]->room_name." : ".$room_allotment;   
            " <br>Rate Type  : PRPN ".
            "<br>Room Rate : ".$calender_data[$i]->room_rate.$special_str;
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
                    $child_rate_str.=" <br>Age( ".$val[0]." ) ".$val[1]; 
                  }
                }
          $calendar[$k]="<br>".$room_list[$i]->room_name." : ".$room_allotment;
          " <br>Rate Type  : PPPN ".
          "<br>Adult Rate : ".$calender_data[$i]->adult_rate.
          "<br>Child Rate : ".$child_rate_str;        
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
            $calendar[$k]="<br>".$room_list[$i]->room_name." : ".$room_allotment;  
            " <br>Rate Type  : PRPN ".
            "<br>Room Rate : ".$calender_data[$i]->room_rate;                 
          
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
