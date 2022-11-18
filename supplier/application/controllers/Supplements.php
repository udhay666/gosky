<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class supplements extends CI_CONTROLLER {

private $supplier_id;
private $max_image_size = '2000';
private $max_image_width = '1024';
private $max_image_height = '900';

function __construct() {
    parent :: __construct();
    $this->load->database();  
    $this->load->model('specialoffer_type'); 
    $this->load->model('specialoffer_list');  
    $this->load->model('currency');
    $this->load->model('ace_jac_roomsxml_gta_city');
    $this->load->model('glb_hotel_facilities_type');
    $this->load->model('glb_hotel_property_type');
    $this->load->model('glb_hotel_room_type');  
    $this->load->model('glb_hotel_meal_plan');  
    $this->load->model('supplier_hotel_list');  
    $this->load->model('supplier_room_list');    
    $this->load->model('sup_hotel_room_supplement_rates_list'); 
    $this->load->model('sup_hotel_room_supplement_rates'); 
    $this->load->model('sup_contract');
    $this->load->model('country');
    $this->load->model('Upload_Model');
    $this->load->library('upload');
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

public function add() {
    $dataarray=array('status'=>1);
    $data['specialoffer_type'] =$this->specialoffer_type->check($dataarray); 
    $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
    $data['hotel_list'] =$this->supplier_hotel_list->check($dataarray);  
    // echo '<pre>';print_r($data['hotel_list']);exit;
    $data['sub_view'] = 'supplement/add';
    $this->load->view('_layout_main',$data);  
}

public function addagerange()
{
    echo json_encode(array('result' =>$this->load->view('supplement/load_ajax_addagerange', '', TRUE)));
}

public function add_supplement_roomrate()
{
	// echo "<pre>"; print_r($_POST); exit;
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
        $supplement_roomrate_type_id=$_POST['supplement_roomrate_type'];
        if($supplement_roomrate_type_id!="other")
        {
        	$specialoffer_type=$this->specialoffer_type->check(array("id"=>$supplement_roomrate_type_id));
        	$supplement_roomrate_type=$specialoffer_type[0]->type;        	
        }
        else
        {
            $supplement_roomrate_type="other";
        }        
        $meal_plan=implode(',',  $_POST['meal_plan']); 
        $supplement_meal_plan=$_POST['supplement_meal_plan'];
        $market=$this->input->post('market');
        $supplement_adult_rate=$this->input->post('supplement_adult_rate');
        $room_detail =$this->supplier_room_list->get_single($room_id);

        $spec_offer_applicable_supplement=isset($_POST['spec_offer_applicable_supplement'])?$_POST['spec_offer_applicable_supplement']:'';
	   //  $supplement_child_rate=$this->input->post('supplement_child_rate');
	  	// $supplement_child_min_age=$this->input->post('supplement_child_min_age');
	   //  $supplement_child_max_age=$this->input->post('supplement_child_max_age');

         
        $supplement_child_agerange_rate=array();

        if(isset($_POST['supplement_child_rate']))
          {
            
             $child_agerange=json_decode($room_detail->child_agerange,true); 
             $ch=0;       
             foreach ($child_agerange as $key => $value)
              { 
                 $val=explode('||', $value);              
               $supplement_child_agerange_rate[$ch]=$_POST['supplement_child_rate'][$ch].':'.$val[0].'||'.$val[1];
                 $ch++;
              }     
          }
        

      // $supplement_child_agerange_rate=array();
      // for($i=0;$i<count($_POST['childageminlimit'])&&isset($_POST['childagemaxlimit'])&&isset($_POST['supplement_child_rate']);$i++)
      //     {
      //        $supplement_child_agerange_rate[$i]=$_POST['supplement_child_rate'][$i].':'.$_POST['childageminlimit'][$i].'||'.$_POST['childagemaxlimit'][$i];
      //     }   

	    $supplement_compulsory=$this->input->post('supplement_compulsory');

        $hotel_detail =$this->supplier_hotel_list->get_single($hotel_id);      
        $days=floor(($to_date - $from_date) / (60 * 60 * 24));
        $contract_dataarray=array('contract_id'=>$contract_id,'supplier_id'=>$this->supplier_id,'supplier_hotel_list_id'=>$hotel_id);
        $contact_details=$this->sup_contract->check($contract_dataarray); 
        $contact_start_date = strtotime($contact_details[0]->start_date);
        $contact_end_date = strtotime($contact_details[0]->end_date);

       if ($from_date < $contact_start_date || $to_date>$contact_end_date||$to_date < $contact_start_date || $from_date>$contact_end_date || $from_date>$to_date) { 
              echo json_encode(array('result' =>'Period Should be within Contract Period'));
          }    
      else 
        {
        	$hotel_code=$hotel_detail->hotel_code;
        	$room_code=$room_detail->room_code;
            $insert_room_rates_list=array(    
                  'supplier_id' =>$this->supplier_id,
                  'sup_hotel_id' => $hotel_id,
                  'hotel_code' => $hotel_code,
                  'room_code'=>$room_code,
                  'contract_id' => $contract_id,
                  'sup_room_details_id'=> $room_id,                 
                  'from_date'=> $startdate,
                  'to_date'=>$enddate,     
                  'meal_plan'=> $meal_plan,
                  'supplement_meal_plan'=>$supplement_meal_plan,
                  'market'=>$market,
                  'supplement_roomrate_type_id'=> $supplement_roomrate_type_id,
                  'supplement_roomrate_type'=> $supplement_roomrate_type,
                  'supplement_adult_rate'=> $supplement_adult_rate,
                  'supplement_child_agerange_rate'=> json_encode($supplement_child_agerange_rate),
                  // 'supplement_child_min_age'=> $supplement_child_min_age,
                  // 'supplement_child_max_age'=> $supplement_child_max_age,
                  'supplement_compulsory'=> $supplement_compulsory,  
                  'spec_offer_applicable_supplement'=>$spec_offer_applicable_supplement,
      'supplement_remarks'=>addslashes($_POST['supplement_remarks']),               
                  'status' => '1',
                );

             $this->sup_hotel_room_supplement_rates_list->update_delete_room_supplement_rates_list($insert_room_rates_list);  
   
           $this->sup_hotel_room_supplement_rates->delete_room_supplement_rates($insert_room_rates_list); 
          $sup_hotel_room_supplement_rates_list_id=$this->sup_hotel_room_supplement_rates_list->insert($insert_room_rates_list);
          

            for($i=0;$i<=$days;$i++)
            {  
              $incr_date = strtotime("+".$i." days", $from_date);
              $avail_date=date("Y-m-d", $incr_date);     
              $insertdata=array(
                  'sup_hotel_room_supplement_rates_list_id'=>$sup_hotel_room_supplement_rates_list_id,    
                  'supplier_id' => $this->supplier_id,
                  'sup_hotel_id' => $hotel_id,
                  'hotel_code' => $hotel_code,
                  'room_code'=>$room_code,
                  'contract_id' => $contract_id,
                  'sup_room_details_id'=> $room_id,                 
                  'avail_date'=> $avail_date, 
                  'meal_plan'=> $meal_plan,
                  'supplement_meal_plan'=>$supplement_meal_plan,
                  'market'=>$market,
                  'supplement_roomrate_type_id'=> $supplement_roomrate_type_id,
                  'supplement_roomrate_type'=> $supplement_roomrate_type,
                  'supplement_adult_rate'=> $supplement_adult_rate,
                  'supplement_child_agerange_rate'=> json_encode($supplement_child_agerange_rate),
                  // 'supplement_child_rate'=> $supplement_child_rate,
                  // 'supplement_child_min_age'=> $supplement_child_min_age,
                  // 'supplement_child_max_age'=> $supplement_child_max_age,
                  'supplement_compulsory'=> $supplement_compulsory, 
                  'spec_offer_applicable_supplement'=>$spec_offer_applicable_supplement,
      'supplement_remarks'=>addslashes($_POST['supplement_remarks']),             
                 'status' => '1',
                );
                $this->sup_hotel_room_supplement_rates->insert($insertdata);
              }   
          echo json_encode(array('result' => "Successfully Updated"));
             
    
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

 public function view_room_rates()
 {
  $dataarray=array('status'=>1);
  $data['specialoffer_type'] =$this->specialoffer_type->check($dataarray); 
  $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
  $data['hotel_list'] =$this->supplier_hotel_list->check($dataarray);  
  $data['sub_view'] = 'supplement/view_room_rate';
  $this->load->view('_layout_main',$data);   
 }

  public function view_cal_room_rates()
 { 
  $dataarray=array('status'=>1);
    $data['specialoffer_type'] =$this->specialoffer_type->check($dataarray); 
  $dataarray=array('supplier_hotel_list_id'=>$_POST['hotel_id'],'supplier_id'=>$this->supplier_id,'status'=>1);
  $data['rooms'] =$this->supplier_room_list->check($dataarray);
  $data['hotel_detail'] =$this->supplier_hotel_list->get_single($_POST['hotel_id']);
  $data['rooms_detail'] =$this->supplier_room_list->get_single($_POST['room_id']);
  $data['contract_id']=$_POST['contract']; 
  $data['contract_details']=$this->sup_contract->get_single($_POST['contract']);
  $data['room_id']=$_POST['room_id'];
  $data['hotel_code']= $data['hotel_detail']->hotel_code;
  $data['hotel_id']=$_POST['hotel_id'];
  $from_date=$_POST['from_date'];
  $to_date=$_POST['to_date'];
  $data['startdate'] = date('Y-m-d', strtotime($from_date));
  $data['enddate'] = date('Y-m-d', strtotime($to_date));
  $data['supplement_roomrate_type_id']=$_POST['supplement_roomrate_type'];
   if(!isset($_POST['hotel_id']) || empty($data['rooms'])){
    redirect('supplements/view_room_rates','refresh');
    }
    $data['sub_view'] = 'supplement/calendar';
    $this->load->view('_layout_main',$data);
}

public function get_room_rate_monthlist()
{   
     
    $room_id = $_POST['room_id'];
    $hotel_code = $_POST['hotel_code']; 
    $contract_id = $_POST['contract_id']; 
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $supplement_roomrate_type_id=isset($_POST['supplement_roomrate_type_id'])?($_POST['supplement_roomrate_type_id']):'';
    $calender_data = $this->sup_hotel_room_supplement_rates->get_roomrates_by_date($room_id, $startdate, $enddate,$contract_id,$supplement_roomrate_type_id);  
   $calendar=array();
   $calendar_date=array(); 
    list($calendar,$calendar_date)=$this->roomrates_supplements_calendar($calender_data);
    if (!empty($calender_data)) {     
      
          echo json_encode(array('success' => 1, 'result' => $calendar,'result1' => $calendar_date));
               
         } else {
                echo json_encode(array('success' => 1, 'result' => array(),'result1' => array()));
            }
}

public function get_room_rate_list()
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
    $supplement_roomrate_type_id=isset($_POST['supplement_roomrate_type_id'])?($_POST['supplement_roomrate_type_id']):'';
    $startdate = date('Y-m-d', strtotime($year . '-' .$month. '-1'));
    $enddate = date('Y-m-d', strtotime($yearend . '-' . $monthend. '-1'));  
    $calender_data = $this->sup_hotel_room_supplement_rates->get_roomrates_by_date($room_id, $startdate, $enddate,$contract_id,$supplement_roomrate_type_id);  
   $calendar=array();
   $calendar_date=array(); 
    list($calendar,$calendar_date)=$this->roomrates_supplements_calendar($calender_data); 
    if (!empty($calender_data)) {     
      
          echo json_encode(array('success' => 1, 'result' => $calendar,'result1' => $calendar_date));
               
         } else {
                echo json_encode(array('success' => 1, 'result' => array(),'result1' => array()));
            }
}

public function get_room_rate_monthcalender()
{   
     
    $room_id = $_POST['room_id'];
    $hotel_code = $_POST['hotel_code']; 
    $contract_id = $_POST['contract_id']; 
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $startdate = date('Y-m-d', strtotime($from_date));
    $enddate = date('Y-m-d', strtotime($to_date));
    $supplement_roomrate_type_id=isset($_POST['supplement_roomrate_type_id'])?($_POST['supplement_roomrate_type_id']):'';
    $calender_data =$this->sup_hotel_room_supplement_rates->get_roomallotment_by_date($room_id,$hotel_code,$startdate, $enddate,$contract_id,$supplement_roomrate_type_id);    
   $calendar=array();
   $calendar_date=array();  
    list($calendar,$calendar_date)=$this->roomrates_supplements_calendar($calender_data);   
    if (!empty($calender_data)) {     
      
          echo json_encode(array('success' => 1, 'result' => $calendar,'result1' => $calendar_date,'startdate'=>$startdate));
               
         } else {
                echo json_encode(array('success' => 1, 'result' => array(),'result1' => array(),'startdate'=>$startdate));
            }
}

public function get_available_rates()
{   
    $year=$_POST['year'];
    $room_id = $_POST['room_id'];
    $hotel_code = $_POST['hotel_code']; 
    $contract_id = $_POST['contract_id'];
    $supplement_roomrate_type_id=$_POST['supplement_roomrate_type_id']; 
    $startdate = date('Y-m-d', strtotime($year . '-' .'1'. '-1'));
    $enddate = date('Y-m-t', strtotime($year . '-' . '12'. '-1'));
    $calender_data = $this->sup_hotel_room_supplement_rates->get_roomrates_by_date($room_id, $startdate, $enddate,$contract_id,$supplement_roomrate_type_id); 
   $calendar=array();
   $calendar_date=array();
    list($calendar,$calendar_date)=$this->roomrates_supplements_calendar($calender_data);
  
    if (!empty($calender_data)) {     
      
          echo json_encode(array('success' => 1, 'result' => $calendar,'result1' => $calendar_date));
               
         } else {
                echo json_encode(array('success' => 1, 'result' => array(),'result1' => array()));
            }
}

public function roomrates_supplements_calendar($calender_data)
{
  $calendar=array();
  $calendar_date=array();
   $k=0;
   for($i=0;$i<count($calender_data)&&!empty($calender_data[0]);$i++,$k++)
  {
             
          $contract_number=$this->sup_contract->get_single($calender_data[$i]->contract_id)->contract_number;
          $meal_arrr=explode(',',$calender_data[$i]->meal_plan);
           $meal_plan=array();
            for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
            {
              $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
            }
            $meal_plan_str=implode(',', $meal_plan); 

            $supplement_meal_arrr=explode(',',$calender_data[$i]->supplement_meal_plan);
           $supplement_meal_plan=array();
            for($l=0;$l<count($supplement_meal_arrr)&&!empty($supplement_meal_arrr[0]);$l++)
            {
              $supplement_meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($supplement_meal_arrr[$l])->meal_plan;
            }
            $supplement_meal_plan_str=implode(',', $supplement_meal_plan);

            $special_str='';
            $special_str.="<br>Supplement Room Rate Type : ".$calender_data[$i]->supplement_roomrate_type;
            $special_str.="<br>Special Offer Applicable On Supplement Rates : ".$calender_data[$i]->spec_offer_applicable_supplement;

             $child_rate_str='';
              $child_rate=json_decode($calender_data[$i]->supplement_child_agerange_rate,true);
              if(!empty($child_rate[0]))
                {                    
                  foreach ($child_rate as $key => $value)
                  { 
                    $val=explode(':', $value);   
                    $val1=explode('||', $val[1]);   
                    $child_rate_str.="Age( ".$val1[0]." - ".$val1[1]." ) : ".$val[0].'<br>'; 
                  }
                }

        
          $calendar[$k]="<small>Per Adult Rate : ".$calender_data[$i]->supplement_adult_rate.
          "<br>Per Child Rate :  <br>".$child_rate_str.  
          "Madatory : ".$calender_data[$i]->supplement_compulsory.
          "<br>Supplements Applicable on Meal Plan : ".$meal_plan_str.
          "<br>Supplements Meal Plan : ".$supplement_meal_plan_str.        
          "<br>Market : ".$calender_data[$i]->market.$special_str."</small>";
          $calendar_date[$k]=$calender_data[$i]->avail_date;

      }

     return array($calendar,$calendar_date);   
}

public function get_hotel_details()
{
  $dataarray=array('supplier_hotel_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id,'status'=>1,'status1'=>1);
  $data['contract_list']=$this->sup_contract->check($dataarray);
  // echo $this->db->last_query();
  // echo '<pre>'; print_r($data); 
  $dataarray=array('supplier_hotel_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id,'status'=>1);
  $data['room_list']=$this->supplier_room_list->check($dataarray);
   // echo '<pre>'; print_r($data);  exit;
  echo json_encode(array('contract_list'=>$this->load->view('supplement/load_ajax_supplement_contract_list', $data, TRUE),'room_list'=>$this->load->view('supplement/load_ajax_supplement_room_list', $data, TRUE)));
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
  echo json_encode(array('market_list'=>$this->load->view('supplement/load_ajax_supplement_market_list', $data, TRUE),'contract_duration'=>$contract_duration));
}

public function get_mealplan_details()
{
  $dataarray=array('supplier_room_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id,'status'=>1);
  $room_list=$this->supplier_room_list->check($dataarray); 
  $data['room_mealplan_list']=explode(',', $room_list[0]->mealplan);
  $data['room_list']=$room_list[0];
  $mealplan=$this->glb_hotel_meal_plan->get(); 
  $mealplanarr=array();
  for($i=0;$i<count($mealplan)&&!empty($mealplan);$i++)
  {
     $mealplanarr[$mealplan[$i]->id]=$mealplan[$i]->meal_plan;
  }
  $data['mealplan'] =$mealplanarr; 
  // print_r($data); exit;
  echo json_encode(array('meal_list'=>$this->load->view('supplement/load_ajax_meal_list', $data, TRUE),'supplement_meal_list'=>$this->load->view('supplement/load_ajax_supplement_meal_list', $data, TRUE),'childagerateslist'=>$this->load->view('supplement/load_ajax_supplement_childagerateslist', $data, TRUE)));
}







 public function edit_rates_room()
 {
   $dataarray=array('status'=>1);
    $data['specialoffer_type'] =$this->specialoffer_type->check($dataarray); 
    $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
    $data['hotel_list'] =$this->supplier_hotel_list->check($dataarray);  
   $data['sub_view'] = 'supplement/editrates';
  $this->load->view('_layout_main',$data);   
 } 

  public function get_hotel_room_rates_def(){
         // echo '<pre>';print_r($_POST);exit;

    $data['hotel_id']=$hotel_id=isset($_POST['hotel_id'])?$_POST['hotel_id']:'';
    $data['room_id']=$room_id=isset($_POST['room_id'])?$_POST['room_id']:'';
    $data['contract_id']= $contract_id=isset($_POST['contract'])?$_POST['contract']:''; 
    $data['supplement_meal_plan']=$supplement_meal_plan=isset($_POST['supplement_meal_plan'])?$_POST['supplement_meal_plan']:'';
     $data['market']=$market=isset($_POST['market'])?implode(',', $_POST['market']):'';
    $data['from_date']=$from_date=isset($_POST['from_date'])?$_POST['from_date']:'';
    $data['to_date']=$to_date=isset($_POST['to_date'])?$_POST['to_date']:'';
    $data['supplement_roomrate_type_id']=$supplement_roomrate_type_id=isset($_POST['supplement_roomrate_type'])?$_POST['supplement_roomrate_type']:'';
  $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
  $data['hotel_detail']=$hotel_detail =$this->supplier_hotel_list->check($dataarray); 
  $data['hotel_name']=$hotel_detail[0]->hotel_name;
  $dataarray=array('supplier_room_list_id'=>$room_id,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
  $data['room_detail']=$room_detail =$this->supplier_room_list->check($dataarray);
  $data['roomtype']=$roomtype =$this->glb_hotel_room_type->get_single($room_detail[0]->hotel_room_type);
  $data['room_name']=$room_detail[0]->room_name.' ('.$roomtype->room_type.')';
  $data['contract_info']=$this->sup_contract->get();
  $hotel_code=$hotel_detail[0]->hotel_code;
  $room_code=$room_detail[0]->room_code;
  $data['currency_type']=$hotel_detail[0]->currency_type;
  $supplier_id=$this->supplier_id;
    // echo '<pre>';print_r($data);exit;

      if(empty($hotel_id)||$hotel_id==''||empty($room_id)||$room_id=='')
      { 
          redirect('supplements/edit_rates_room','refresh');
      }
      if(empty($room_detail)||empty($hotel_detail))
      {  
         redirect('supplements/edit_rates_room','refresh');
      }   

$roomrates=$data['roomrates'] = $this->sup_hotel_room_supplement_rates->new_cal_get_roomrates_by_date($supplier_id,$hotel_id, $hotel_code, $room_id,$room_code,$contract_id,$supplement_roomrate_type_id,$supplement_meal_plan,$market,$from_date,$to_date);
          $data['sub_view'] = 'supplement/view_rate_definition';
          $this->load->view('_layout_main',$data);  
     }


public function edit_room_rates(){
   $id=$_POST['rateid'];
   $data['hotel_id']=$hotel_id=$_POST['hotel_id'];
   $data['room_code']=$room_code=$_POST['room_code'];
   $data['hotel_code']=$hotel_code=$_POST['hotel_code'];  
   $data['sup_room_details_id']=$room_id=$_POST['room_id'];
   $data['contract_id']=$contract_id=$_POST['contract_id'];
   $data['supplement_roomrate_type_id']=$supplement_roomrate_type_id=$_POST['supplement_roomrate_type_id'];
  $dataarray=array('supplier_room_list_id'=>$room_id,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
  $data['room_list'] =$this->supplier_room_list->check($dataarray);


  $dataarray=array('supplier_room_list_id'=>$room_id,'supplier_id'=>$this->supplier_id,'status'=>1);
  $room_mealplan_list=$this->supplier_room_list->check($dataarray)[0]->mealplan; 
  $data['room_mealplan_list']=explode(',', $room_mealplan_list);
  $mealplan=$this->glb_hotel_meal_plan->get(); 
  $mealplanarr=array();
  for($i=0;$i<count($mealplan)&&!empty($mealplan);$i++)
  {
     $mealplanarr[$mealplan[$i]->id]=$mealplan[$i]->meal_plan;
  }
  $data['mealplan'] =$mealplanarr; 


    $data['result']=$this->sup_hotel_room_supplement_rates->get_roomrates($id, $room_code, $hotel_code,$this->supplier_id,$room_id,$contract_id,$supplement_roomrate_type_id);
         // echo $this->db->last_query(); exit;   
    // echo '<pre>'; print_r($data['result']); exit;    
    $edit_room_rates='';
         if (!empty($data['result'])&&!empty($data['room_list'])) {
           $edit_room_rates.= $this->load->view('supplement/load_ajax_supplement_room_rate', $data, TRUE);
         
             echo json_encode(array('edit_room_rates' => $edit_room_rates));
            } else {
                echo json_encode(array('edit_room_rates'=>''));
            }     



    // $data['sub_view'] = 'roomrate/edit_room_rate_view_file';
    // $this->load->view('_layout_main',$data); 
 }

  public function update_room_rates_ind()
  {  
    $supplement_adult_rate=$_POST['supplement_adult_rate'];
    // $supplement_child_rate=$_POST['supplement_child_rate'];
    // $supplement_child_min_age=$_POST['supplement_child_min_age'];
    // $supplement_child_max_age=$_POST['supplement_child_max_age'];
    $supplement_compulsory=$_POST['supplement_compulsory'];
    $hotel_code=$_POST['hotel_code'];
    $room_code=$_POST['room_code'];
    $id=$_POST['id'];
    $sup_room_details_id=$_POST['sup_room_details_id'];
    $contract_id=$_POST['contract'];
    $hotel_id=$_POST['hotel_id'];
    $supplement_roomrate_type_id=$_POST['supplement_roomrate_type_id'];
    $supplement_roomrate_type=$_POST['supplement_roomrate_type'];
    $avail_date=$_POST['avail_date'];  
    $meal_plan = $_POST['meal_plan']; 
 
 $check=$this->sup_hotel_room_supplement_rates->get_roomrates_edit($hotel_id,$id,$room_code, $hotel_code,$this->supplier_id,$sup_room_details_id,$contract_id,$supplement_roomrate_type_id,$supplement_roomrate_type);
if($check!=''){

       $child_rate=array();
       if(isset($_POST['supplement_child_rate']))
              {                  
                $child_agerange=json_decode($check->supplement_child_agerange_rate,true); 
                 $ch=0;       
                 foreach ($child_agerange as $key => $value)
                  { 
                    $val=explode(':', $value);   
                    $val1=explode('||', $val[1]);
                     $child_rate[$ch]=$_POST['supplement_child_rate'][$ch].':'.$val1[0].'||'.$val1[1];                   
                     $ch++;
                  }     
              }
             

     $updatadata=array(        
                    'supplement_adult_rate'=>$_POST['supplement_adult_rate'],
                    'supplement_child_agerange_rate'=>json_encode($child_rate),
                    'supplement_compulsory'=>$_POST['supplement_compulsory'],
      'supplement_remarks'=>addslashes($_POST['supplement_remarks']),           
                     );
          $this->sup_hotel_room_supplement_rates->get_roomrates_update($hotel_id,$id,$room_code, $hotel_code,$this->supplier_id,$sup_room_details_id,$contract_id,$supplement_roomrate_type_id,$supplement_roomrate_type,$updatadata);
          echo json_encode(array('success' => 'true'));
      }  
   else
      {
         echo json_encode(array('success' => ''));
      }  
}

public function add_rate_type()
{
  $dataarray=array('supplier_room_list_id'=>$_POST['room_id'],'supplier_hotel_list_id'=>$_POST['hotel_id'],'supplier_id'=>$this->supplier_id,'status'=>1);
  $data['room_list'] =$this->supplier_room_list->check($dataarray); 

  $data['rate_type']=$_POST['rate_type'];
  if(empty($data['room_list']))
  {
    echo json_encode(array('result' =>'','result1'=>'Check Room Status.....')); 
  }
  else{
  echo json_encode(array('result' =>$this->load->view('supplement/load_specialoffer_rate_type_ajax', $data, TRUE),'result1'=>''));
}
}
public function prior_day_type()
{
  $data['prior_day_type']=$_POST['prior_day_type'];
  if(isset($_POST['prior_day_type']))
  {
  echo json_encode(array('result' =>$this->load->view('supplement/load_ajax_prior_days_type', $data, TRUE)));
  }
  else
  {
   echo json_encode(array('result' =>'')); 
  }

}

public function set_status() {
  $id=$_POST['id'];
  $status=$_POST['status'];
  if(!isset($_POST['id'])||!isset($_POST['status']))
  {
     echo json_encode(array('result'=>"Try After Sometimes"));
  }
  else
  {
    $data = array(
        'status' => $status,          
    );
    $this->sup_hotel_room_supplement_rates->set_status($data,$id);
   if($status == 1){
        $msg = 'SuccessFully Active';
    } else {
        $msg = 'SuccessFully Inactive';
    }
    echo json_encode(array('result'=>$msg));
  }
  
}


}

