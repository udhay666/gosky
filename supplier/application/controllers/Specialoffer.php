<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class specialoffer extends CI_CONTROLLER {

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
    $this->load->model('sup_specialoffer_hotel_room_rates_list');
    $this->load->model('sup_specialoffer_hotel_room_rates'); 
    $this->load->model('sup_specialoffer_hotel_room_cancellation_rates');
    $this->load->model('Roomrates_Model');
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
    $data['sub_view'] = 'specialoffer/add';
    $this->load->view('_layout_main',$data);  
}

public function get_hotel_details()
{
  $dataarray=array('supplier_hotel_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id,'status'=>1,'status1'=>1);
  $data['contract_list']=$this->sup_contract->check($dataarray);
  // echo '<pre>'; print_r($data); 
  $dataarray=array('supplier_hotel_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id,'status'=>1);
  $data['room_list']=$this->supplier_room_list->check($dataarray);
   // echo '<pre>'; print_r($data);  exit;
  echo json_encode(array('contract_list'=>$this->load->view('specialoffer/load_ajax_specialoffer_contract_list', $data, TRUE),'room_list'=>$this->load->view('specialoffer/load_ajax_specialoffer_room_list', $data, TRUE)));
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
  echo json_encode(array('market_list'=>$this->load->view('specialoffer/load_ajax_specialoffer_market_list', $data, TRUE),'contract_duration'=>$contract_duration));
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
  echo json_encode(array('meal_list'=>$this->load->view('specialoffer/load_ajax_specialoffer_meal_list', $data, TRUE)));
}


public function get_selected_mealplan_details()
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
  $data['sel_meal_plan']=isset($_POST['sel_meal_plan'])?$_POST['sel_meal_plan']:'';
  $data['mealplan'] =$mealplanarr; 
  // print_r($data); exit;
 echo json_encode(array('meal_list'=>$this->load->view('specialoffer/load_ajax_specialoffer_meal_list', $data, TRUE)));
}


 
 /* View The Existing Rate */
   public function view_existing_rate()
   {

     $hotel_id=$_POST['hotel_id'];
     $room_id=$_POST['room_id'];
     $market=$_POST['market'];
     $contract=$_POST['contract'];
     $specialoffer_id=$_POST['specialoffer_type'];
     // $meal_plan=implode(',',$_POST['meal_plan']);
      $meal_plan='';
     $data['existing_rate']= $this->sup_specialoffer_hotel_room_rates_list
->get_roomrates_duplicate($this->supplier_id, $hotel_id, $contract,$room_id,$meal_plan,$market,$specialoffer_id);
     if(!empty($data['existing_rate']))
     {
          echo json_encode(array('result' =>$this->load->view('specialoffer/view_existing_rate', $data, TRUE)));
     }
     else
     {
           echo json_encode(array('result' =>''));
     }
   }

 public function add_room_rates()
  {  
    // print_r($_POST); exit;
    $dataarray=array(
                    'supplier_room_list_id'=>$_POST['room_id'],
                    'supplier_hotel_list_id'=>$_POST['hotel_id'],
                    'supplier_id'=>$this->supplier_id,
                    'status'=>1
                    );
    $data['room_list'] =$this->supplier_room_list->check($dataarray); 
    $hotel_detail =$this->supplier_hotel_list->get_single($_POST['hotel_id']); 
    $meal_plan=array();
    $data['meal_planstr']=implode(',', $_POST['meal_plan']);
    $meal_planarr=$_POST['meal_plan']; 
    for ($i=0;$i <count($meal_planarr)&&!empty($meal_planarr[0]) ; $i++)
    { 
       $meal_plan[$i] =$this->glb_hotel_meal_plan->get_single($meal_planarr[$i])->meal_plan;
    }  
    $data['mealplan']=implode(',', $meal_plan); 
    $dataarray1=array(
                      'contract_id'=>$_POST['contract'],
                      'supplier_hotel_list_id'=>$_POST['hotel_id'],
                      'supplier_id'=>$this->supplier_id,
                      'status'=>1,
                      'status1'=>1
                    ); 
    $data['contract_list'] =$this->sup_contract->check($dataarray1);
    $data['market'] =$_POST['market'];      
    $data['hotel_id']=$_POST['hotel_id'];
    $data['hotel_code']=$hotel_detail->hotel_code;
    $data['hotel_name']=$hotel_detail->hotel_name; 
    $dataarray2=array('id'=>$_POST['specialoffer_type'],'status'=>1);
    $data['specialoffer_type'] =$this->specialoffer_type->check($dataarray2);
    // echo "<pre>"; print_r($data); exit;
    if(!isset($_POST['hotel_id']) || empty($data['room_list']) || empty($data['specialoffer_type'])){
      redirect('specialoffer/add','refresh');
    }
    else
    {
       $data['sub_view'] = 'specialoffer/add_rates';
    }
       $this->load->view('_layout_main',$data);   
  }

    /* Add Duplicates Rate */

  public function add_duplicates_rates()
  {
     $data['duplicateroomrates']=$duplicateroomrates=$this->sup_specialoffer_hotel_room_rates_list->get_roomrate_duplicate($this->supplier_id, $_POST['rate_list']); 
     $dataarray=array(
                    'supplier_room_list_id'=>$duplicateroomrates->sup_room_details_id,
                    'supplier_hotel_list_id'=>$duplicateroomrates->sup_hotel_id,
                    'supplier_id'=>$this->supplier_id,
                    'status'=>1
                    );
    $data['room_list'] =$this->supplier_room_list->check($dataarray); 
    $hotel_detail =$this->supplier_hotel_list->get_single($duplicateroomrates->sup_hotel_id);
    $meal_plan=array();
    $meal_planarr=explode(',',$duplicateroomrates->meal_plan); 
    for ($i=0;$i <count($meal_planarr)&&!empty($meal_planarr[0]) ; $i++)
    { 
       $meal_plan[$i] =$this->glb_hotel_meal_plan->get_single($meal_planarr[$i])->meal_plan;
    }  
    $data['mealplan']=implode(',', $meal_plan); 
    $dataarray1=array(
                      'contract_id'=>$duplicateroomrates->contract_id,
                      'supplier_hotel_list_id'=>$duplicateroomrates->sup_hotel_id,
                      'supplier_id'=>$this->supplier_id,
                      'status'=>1,
                      'status1'=>1
                    ); 
    $data['contract_list'] =$this->sup_contract->check($dataarray1);
    $data['market'] =$duplicateroomrates->market;      
    $data['hotel_id']=$duplicateroomrates->sup_hotel_id;
    $data['hotel_code']=$hotel_detail->hotel_code;
    $data['hotel_name']=$hotel_detail->hotel_name;
     if(empty($duplicateroomrates)||empty($data['room_list'])||empty($data['contract_list'])||empty($hotel_detail))
     {
         $errors_msg="No Rates Exist!!! Kindly add fresh rates....";
         $this->session->set_flashdata('errors_msg',$errors_msg);
          redirect('specialoffer/add','refresh');
     }
     else
     {
         $data['sub_view'] = 'specialoffer/add_duplicates_rates'; 
     }
    $this->load->view('_layout_main',$data);  
  }
public function update_room_rates($id='')
 { 
  // echo '<pre>'; print_r($_POST); exit;
  $supplier_id=$this->supplier_id; 
  $hotel_id=isset($_POST['hotel_id'])?$_POST['hotel_id']:'';
  $room_id=isset($_POST['room_id'])?$_POST['room_id']:'';
  $contract_id=isset($_POST['contract'])?$_POST['contract']:'';
  $market=isset($_POST['market'])?$_POST['market']:'';
  $meal_plan=isset($_POST['meal_plan'])?implode(',',$_POST['meal_plan']):'';
  $rate_type=isset($_POST['rate_type'])?$_POST['rate_type']:'';
  $adult_rate=isset($_POST['adult_rate'])?$_POST['adult_rate']:'';
  $room_rate=isset($_POST['room_rate'])?$_POST['room_rate']:'';
  $specialoffer_id=isset($_POST['specialoffer_id'])?$_POST['specialoffer_id']:'';
  $specialoffer_type=isset($_POST['specialoffer_type'])?$_POST['specialoffer_type']:'';
  $min_adults_without_extra_bed=isset($_POST['min_adults_without_extra_bed'])?$_POST['min_adults_without_extra_bed']:'';
  $max_adults_without_extra_bed=isset($_POST['max_adults_without_extra_bed'])?$_POST['max_adults_without_extra_bed']:'';
  $min_child_without_extra_bed=isset($_POST['min_child_without_extra_bed'])?$_POST['min_child_without_extra_bed']:''; 
  $max_child_without_extra_bed=isset($_POST['max_child_without_extra_bed'])?$_POST['max_child_without_extra_bed']:'';
  $extra_bed_for_adults=isset($_POST['extra_bed_for_adults'])?$_POST['extra_bed_for_adults']:'';
  $extra_bed_for_child=isset($_POST['extra_bed_for_child'])?$_POST['extra_bed_for_child']:'';
  $extra_bed_for_adults_rate=isset($_POST['extra_bed_for_adults_rate'])?$_POST['extra_bed_for_adults_rate']:'';
  $extra_bed_for_child_rate=isset($_POST['extra_bed_for_child_rate'])?$_POST['extra_bed_for_child_rate']:'';
  $min_room_occupancy=isset($_POST['min_room_occupancy'])?$_POST['min_room_occupancy']:'';
  $max_room_occupancy=isset($_POST['max_room_occupancy'])?$_POST['max_room_occupancy']:'';

  $discount_rate_type=isset($_POST['discount_rate_type'])?$_POST['discount_rate_type']:'';
  $discount_percentage=isset($_POST['discount_percentage'])?$_POST['discount_percentage']:''; 
  $min_no_of_stay_day=isset($_POST['min_no_of_stay_day'])?$_POST['min_no_of_stay_day']:''; 
   $booking_code=isset($_POST['booking_code'])?$_POST['booking_code']:'';
  $max_no_of_stay_day=isset($_POST['max_no_of_stay_day'])?$_POST['max_no_of_stay_day']:'';
  $no_of_stay_free_nights=isset($_POST['no_of_stay_free_nights'])?$_POST['no_of_stay_free_nights']:'';
  // $supplement_compulsory=isset($_POST['supplement_compulsory'])?$_POST['supplement_compulsory']:'';
  $type_of_supplement=isset($_POST['type_of_supplement'])?$_POST['type_of_supplement']:'';
  $age_limit_for_supplement=isset($_POST['age_limit_for_supplement'])?$_POST['age_limit_for_supplement']:'';
  $supplement_rate=isset($_POST['supplement_rate'])?$_POST['supplement_rate']:'';
  $supplement_desc=isset($_POST['supplement_desc'])?$_POST['supplement_desc']:'';
  $prior_day_type=isset($_POST['prior_day_type'])?$_POST['prior_day_type']:'';  
  $prior_checkin=isset($_POST['prior_checkin'])?$_POST['prior_checkin']:'';
  $prior_checkin_date=isset($_POST['prior_checkin_date'])?date("Y-m-d",strtotime($_POST['prior_checkin_date'])):'';
  $period_from_date=isset($_POST['period_from_date'])?date("Y-m-d",strtotime($_POST['period_from_date'])):'';
  $period_to_date=isset($_POST['period_to_date'])?date("Y-m-d",strtotime($_POST['period_to_date'])):'';

  $dataarray=array(
                  'supplier_hotel_list_id'=>$id,
                  'supplier_id'=>$this->supplier_id,
                  'status'=>1
                 );
  $data['room_list'] =$this->supplier_room_list->check($dataarray);
  if($id=='' ||$id!=$hotel_id || empty($data['room_list']))
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
        $hotel_code =$this->supplier_hotel_list->get_single($id)->hotel_code; 
        $room_detail=$this->supplier_room_list->get_single($room_id);    
        $room_code =$room_detail->room_code;
        $from_date=strtotime($_POST['from_date']);
        $to_date=strtotime($_POST['to_date']);
        $startdate= date("Y-m-d", $from_date);
        $enddate= date("Y-m-d", $to_date);
        $cancellation_policy=array();
        if(isset($_POST['non_refundable']))
        {
           $cancellation_policy[0]='0||'.$_POST['non_refundable'];
        }
        else
        {
          for($i=0;$i<count($_POST['days_before'])&&isset($_POST['days_before'])&&isset($_POST['cancel_rates']);$i++)
          {
             $cancellation_policy[$_POST['days_before'][$i]]=$_POST['cancel_rates'][$i].'||'.$_POST['cancel_rates_type'][$i];
          } 
        }

       
        if(isset($_POST['child_rate']))
        {
           $child_rate=array();
           $child_agerange=json_decode($room_detail->child_agerange,true); 
           $ch=0;       
           foreach ($child_agerange as $key => $value)
            { 
               $val=explode('||', $value);
               $child_rate[$ch]=$val[0].'-'.$val[1].'||'.$_POST['child_rate'][$ch];
               $ch++;
            }     
        }
        else
        {
           $child_rate='';
        }



        $days=floor(($to_date - $from_date) / (60 * 60 * 24));    
        $contract_dataarray=array('contract_id'=>$contract_id,'supplier_id'=>$this->supplier_id,'supplier_hotel_list_id'=>$hotel_id);
       $contact_details=$this->sup_contract->check($contract_dataarray); 
       $contact_start_date = strtotime($contact_details[0]->start_date);
       $contact_end_date = strtotime($contact_details[0]->end_date);
       if ($from_date < $contact_start_date || $to_date>$contact_end_date||$to_date < $contact_start_date || $from_date>$contact_end_date || $from_date>$to_date)
       { 
            echo json_encode(array('result' =>'', 'result1'=>'Period Should be within Contract Period'));
       }    
       else if(($rate_type=='PPPN' && !empty($_POST['adult_rate']))||($rate_type=='PRPN' && !empty($_POST['room_rate'])))
       {
        $insert_room_rates_list=array(    
                  'supplier_id' =>$supplier_id,
                  'sup_hotel_id' => $hotel_id,
                  'hotel_code' => $hotel_code,
                  'room_code'=>$room_code,
                  'contract_id' => $contract_id,
                  'sup_room_details_id'=> $room_id,                 
                  'from_date'=> $startdate,
                  'to_date'=>$enddate,     
                  'market'=> $market,
                  'specialoffer_id'=>$specialoffer_id,
                  'specialoffer_type'=>$specialoffer_type,
                  'meal_plan'=> $meal_plan,
                  'rate_type'=> $rate_type,
                  'adult_rate'=> $adult_rate,
                  'child_rate'=> json_encode($child_rate),    
                  'room_rate'=> $room_rate,
                  'min_adults_without_extra_bed'=> $min_adults_without_extra_bed,
                  'max_adults_without_extra_bed'=> $max_adults_without_extra_bed,
                  'min_child_without_extra_bed'=> $min_child_without_extra_bed,
                  'max_child_without_extra_bed'=> $max_child_without_extra_bed,
                  'extra_bed_for_adults'=> $extra_bed_for_adults,
                  'extra_bed_for_child'=> $extra_bed_for_child,
                  'extra_bed_for_adults_rate'=> $extra_bed_for_adults_rate,
                  'extra_bed_for_child_rate'=> $extra_bed_for_child_rate,
                  'min_room_occupancy'=> $min_room_occupancy,
                  'max_room_occupancy'=> $max_room_occupancy,
                  'cancellation_policy'=> json_encode($cancellation_policy),
                  'discount_rate_type'=>$discount_rate_type,
                  'discount_percentage'=>$discount_percentage,         
                  'prior_day_type'=>$prior_day_type,
                  'prior_checkin'=>$prior_checkin,
                  'prior_checkin_date'=>$prior_checkin_date,
                  'period_from_date'=>$period_from_date,
                  'period_to_date'=>$period_to_date, 
                  'min_no_of_stay_day'=>$min_no_of_stay_day,
                  'booking_code'=>$booking_code,
                  'max_no_of_stay_day'=>$max_no_of_stay_day,
                  'no_of_stay_free_nights'=>$no_of_stay_free_nights,
                  // 'supplement_compulsory'=>$supplement_compulsory,
                  'type_of_supplement'=>$type_of_supplement,
                  'age_limit_for_supplement'=>$age_limit_for_supplement,
                  'supplement_rate'=>$supplement_rate,
                  'supplement_desc'=>stripslashes($supplement_desc),
                  'status' => '1',
                );


          // $this->sup_specialoffer_hotel_room_rates_list->delete_room_rates_type_list($insert_room_rates_list);  
           $this->sup_specialoffer_hotel_room_rates->delete_room_rates_type($insert_room_rates_list);
           $this->sup_specialoffer_hotel_room_cancellation_rates->delete_room_cancellation_rates_type($insert_room_rates_list);



           // $this->sup_specialoffer_hotel_room_rates_list->delete_room_rates_list($insert_room_rates_list);  

            $this->sup_specialoffer_hotel_room_rates_list->update_delete_room_rates_list($insert_room_rates_list);  
           $this->sup_specialoffer_hotel_room_rates->delete_room_rates($insert_room_rates_list);
           $this->sup_specialoffer_hotel_room_cancellation_rates->delete_room_cancellation_rates($insert_room_rates_list);
         
             $sup_hotel_room_rates_list_id=$this->sup_specialoffer_hotel_room_rates_list->insert($insert_room_rates_list);
          

            for($i=0;$i<=$days;$i++)
            {  
              $incr_date = strtotime("+".$i." days", $from_date);
              $room_avail_date=date("Y-m-d", $incr_date);     
              $insertdata=array(
                  'sup_hotel_room_rates_list_id'=>$sup_hotel_room_rates_list_id,    
                  'supplier_id' => $supplier_id,
                  'sup_hotel_id' => $hotel_id,
                  'hotel_code' => $hotel_code,
                  'room_code'=>$room_code,
                  'contract_id' => $contract_id,
                  'sup_room_details_id'=> $room_id,                 
                  'room_avail_date'=> $room_avail_date,   
                  'market'=> $market,
                  'specialoffer_id'=>$specialoffer_id,
                  'specialoffer_type'=>$specialoffer_type,
                  'meal_plan'=> $meal_plan,
                  'rate_type'=> $rate_type,
                  'adult_rate'=> $adult_rate,
                  'child_rate'=> json_encode($child_rate),    
                  'room_rate'=> $room_rate,
                  'min_adults_without_extra_bed'=> $min_adults_without_extra_bed,
                  'max_adults_without_extra_bed'=> $max_adults_without_extra_bed,
                  'min_child_without_extra_bed'=> $min_child_without_extra_bed,
                  'max_child_without_extra_bed'=> $max_child_without_extra_bed,
                  'extra_bed_for_adults'=> $extra_bed_for_adults,
                  'extra_bed_for_child'=> $extra_bed_for_child,
                  'extra_bed_for_adults_rate'=> $extra_bed_for_adults_rate,
                  'extra_bed_for_child_rate'=> $extra_bed_for_child_rate,
                  'min_room_occupancy'=> $min_room_occupancy,
                  'max_room_occupancy'=> $max_room_occupancy,
                  'discount_rate_type'=>$discount_rate_type,
                  'discount_percentage'=>$discount_percentage,                 
                  'prior_day_type'=>$prior_day_type,
                  'prior_checkin'=>$prior_checkin,
                  'prior_checkin_date'=>$prior_checkin_date,
                  'period_from_date'=>$period_from_date,
                  'period_to_date'=>$period_to_date,
                  'min_no_of_stay_day'=>$min_no_of_stay_day,
                  'booking_code'=>$booking_code,
                  'max_no_of_stay_day'=>$max_no_of_stay_day,
                  'no_of_stay_free_nights'=>$no_of_stay_free_nights,
                  // 'supplement_compulsory'=>$supplement_compulsory,
                  'type_of_supplement'=>$type_of_supplement,
                  'age_limit_for_supplement'=>$age_limit_for_supplement,
                  'supplement_rate'=>$supplement_rate,
                  'supplement_desc'=>stripslashes($supplement_desc),                 
                  'status' => '1',
                );
                $this->sup_specialoffer_hotel_room_rates->insert($insertdata);
              
              
             
              if(isset($_POST['non_refundable']))
              {
                   $insertcancellationdata=array(    
                        'sup_hotel_room_rates_list_id'=>$sup_hotel_room_rates_list_id,    
                        'supplier_id' => $supplier_id,
                       'sup_hotel_id' => $hotel_id,
                        'hotel_code' => $hotel_code,
                        'room_code'=>$room_code,
                        'contract_id' => $contract_id,
                        'sup_room_details_id'=> $room_id,                 
                        'room_avail_date'=> $room_avail_date,
                        'specialoffer_id'=>$specialoffer_id,
                        'specialoffer_type'=>$specialoffer_type,   
                        'market'=> $market,
                        'meal_plan'=> $meal_plan,
                        'rate_type'=> $rate_type,
                        'min_adults_without_extra_bed'=> $min_adults_without_extra_bed,
                        'max_adults_without_extra_bed'=> $max_adults_without_extra_bed,
                        'min_child_without_extra_bed'=> $min_child_without_extra_bed,
                        'max_child_without_extra_bed'=> $max_child_without_extra_bed,
                        'extra_bed_for_adults'=> $extra_bed_for_adults,
                        'extra_bed_for_child'=> $extra_bed_for_child,
                        'min_room_occupancy'=> $min_room_occupancy,
                        'max_room_occupancy'=> $max_room_occupancy,             
                        'prior_day_type'=>$prior_day_type,
                        'prior_checkin'=>$prior_checkin,
                        'prior_checkin_date'=>$prior_checkin_date,
                        'period_from_date'=>$period_from_date,
                        'period_to_date'=>$period_to_date,
                        'min_no_of_stay_day'=>$min_no_of_stay_day,      
                        'max_no_of_stay_day'=>$max_no_of_stay_day,      
                        'days_before_checkin'=>0,
                        'per_rate_charge'=> 0,
                        'cancel_rates_type'=>$_POST['non_refundable'],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_specialoffer_hotel_room_cancellation_rates->insert($insertcancellationdata);
              }
              else
              {
                  $k=0;
                  $insertcancellationdata=array();
                  foreach ($_POST['cancel_rates'] as $cancel_rate)
                  { 
                    $insertcancellationdata[$k]=array(    
                        'sup_hotel_room_rates_list_id'=>$sup_hotel_room_rates_list_id,    
                        'supplier_id' => $supplier_id,
                       'sup_hotel_id' => $hotel_id,
                        'hotel_code' => $hotel_code,
                        'room_code'=>$room_code,
                        'contract_id' => $contract_id,
                        'sup_room_details_id'=> $room_id,                 
                        'room_avail_date'=> $room_avail_date, 
                        'specialoffer_id'=>$specialoffer_id,
                        'specialoffer_type'=>$specialoffer_type,  
                        'market'=> $market,
                        'meal_plan'=> $meal_plan,
                        'rate_type'=> $rate_type,
                        'min_adults_without_extra_bed'=> $min_adults_without_extra_bed,
                        'max_adults_without_extra_bed'=> $max_adults_without_extra_bed,
                        'min_child_without_extra_bed'=> $min_child_without_extra_bed,
                        'max_child_without_extra_bed'=> $max_child_without_extra_bed,
                        'extra_bed_for_adults'=> $extra_bed_for_adults,
                        'extra_bed_for_child'=> $extra_bed_for_child,
                        'min_room_occupancy'=> $min_room_occupancy,
                        'max_room_occupancy'=> $max_room_occupancy,
                        'prior_day_type'=>$prior_day_type,
                        'prior_checkin'=>$prior_checkin,
                        'prior_checkin_date'=>$prior_checkin_date,
                        'period_from_date'=>$period_from_date,
                        'period_to_date'=>$period_to_date,
                        'min_no_of_stay_day'=>$min_no_of_stay_day,      
                        'max_no_of_stay_day'=>$max_no_of_stay_day, 
                        'days_before_checkin'=> $_POST['days_before'][$k],
                        'per_rate_charge'=> $_POST['cancel_rates'][$k],
                        'cancel_rates_type'=>$_POST['cancel_rates_type'][$k],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_specialoffer_hotel_room_cancellation_rates->insert($insertcancellationdata[$k]);
                   $k++;
                }
            }
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
    else
    {    
      echo json_encode(array('result' => ''));
    }   
 }

 public function view_room_rates()
 {
  $dataarray=array('status'=>1);
  $data['specialoffer_type'] =$this->specialoffer_type->check($dataarray); 
  $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
  $data['hotel_list'] =$this->supplier_hotel_list->check($dataarray);  
  $data['sub_view'] = 'specialoffer/view_room_rate';
  $this->load->view('_layout_main',$data);   
 }

 public function view_cal_room_rates()
 { 
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
  $data['specialoffer_id']=$_POST['specialoffer_type'];
   if(!isset($_POST['hotel_id']) || empty($data['rooms'])){
    redirect('specialoffer/view_room_rates','refresh');
    }
    $data['sub_view'] = 'specialoffer/calendar';
    $this->load->view('_layout_main',$data);
}

public function get_room_rate_monthlist()
{   
     
    $room_id = $_POST['room_id'];
    $hotel_code = $_POST['hotel_code']; 
    $contract_id = $_POST['contract_id']; 
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $specialoffer_id=isset($_POST['specialoffer_id'])?($_POST['specialoffer_id']):'';
    $calender_data = $this->sup_specialoffer_hotel_room_rates->get_roomrates_by_date($room_id, $startdate, $enddate,$contract_id,$specialoffer_id);  
   $calendar=array();
   $calendar_date=array(); 
    list($calendar,$calendar_date)=$this->roomrates_specialoffer_calendar($calender_data);
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
    $specialoffer_id=isset($_POST['specialoffer_id'])?($_POST['specialoffer_id']):'';
    $startdate = date('Y-m-d', strtotime($year . '-' .$month. '-1'));
    $enddate = date('Y-m-d', strtotime($yearend . '-' . $monthend. '-1'));  
    $calender_data = $this->sup_specialoffer_hotel_room_rates->get_roomrates_by_date($room_id, $startdate, $enddate,$contract_id,$specialoffer_id);  
   $calendar=array();
   $calendar_date=array(); 
    list($calendar,$calendar_date)=$this->roomrates_specialoffer_calendar($calender_data); 
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
    $specialoffer_id=isset($_POST['specialoffer_id'])?($_POST['specialoffer_id']):'';
    $calender_data =$this->sup_specialoffer_hotel_room_rates->get_roomallotment_by_date($room_id,$hotel_code,$startdate, $enddate,$contract_id,"",$specialoffer_id);    
   $calendar=array();
   $calendar_date=array();  
    list($calendar,$calendar_date)=$this->roomrates_specialoffer_calendar($calender_data);   
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
    $specialoffer_id=$_POST['specialoffer_id']; 
    $startdate = date('Y-m-d', strtotime($year . '-' .'1'. '-1'));
    $enddate = date('Y-m-t', strtotime($year . '-' . '12'. '-1'));
    $calender_data = $this->sup_specialoffer_hotel_room_rates->get_roomrates_by_date($room_id, $startdate, $enddate,$contract_id,$specialoffer_id); 
   $calendar=array();
   $calendar_date=array();
    list($calendar,$calendar_date)=$this->roomrates_specialoffer_calendar($calender_data);
  
    if (!empty($calender_data)) {     
      
          echo json_encode(array('success' => 1, 'result' => $calendar,'result1' => $calendar_date));
               
         } else {
                echo json_encode(array('success' => 1, 'result' => array(),'result1' => array()));
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
             $special_str.="<br>Booking Code :".$calender_data[$i]->booking_code;
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
             $special_str.="<br>Min Nights :".$calender_data[$i]->min_no_of_stay_day;
              $special_str.="<br>Max Nights :".$calender_data[$i]->max_no_of_stay_day;
              $special_str.="<br>Discount (%) :".$calender_data[$i]->discount_percentage;
            }
            else if($calender_data[$i]->specialoffer_id==2 && $calender_data[$i]->specialoffer_type=="Early bird")
            { 

              if($calender_data[$i]->prior_day_type=="prior_checkin")
               {
                  $special_str.="<br> Prior Checkin Days :".$calender_data[$i]->prior_checkin;
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
                  $special_str.="<br> Prior Checkin Days :".$calender_data[$i]->prior_checkin;
               }
               if($calender_data[$i]->prior_day_type=="prior_checkin_date")
               {
                  $special_str.="<br>Prior Booking Date :".date('d-m-Y',strtotime($calender_data[$i]->prior_checkin_date));
               }
               if($calender_data[$i]->prior_day_type=="period")
               {
                  $special_str.="<br>Prior Booking Period : From ".date('d-m-Y',strtotime($calender_data[$i]->period_from_date)).' to '.date('d-m-Y',strtotime($calender_data[$i]->period_to_date));
               }  
              $special_str.="<br>Min stay :".$calender_data[$i]->min_no_of_stay_day;
              $special_str.="<br>Max stay :".$calender_data[$i]->max_no_of_stay_day;
              $special_str.="<br> free nights :".$calender_data[$i]->no_of_stay_free_nights;
            }  
            else if($calender_data[$i]->specialoffer_id==4 && $calender_data[$i]->specialoffer_type=="Supplement")
            { 
                // $special_str.="<br>Compulsory :".$calender_data[$i]->supplement_compulsory;
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
                    $child_rate_str.="Age( ".$val[0]." ) ".$val[1]."<br>"; 
                  }
                }
          $status='';
          if($calender_data[$i]->status==0)
          {
            $status="<br>Rate Status : InActive";
          }
          else if($calender_data[$i]->status==1)
          {
            $status="<br>Rate Status : Active";
          }
           else if($calender_data[$i]->status==2)
          {
            $status="<br>Rate Status : Blocked";
          }
          // $special_str.=$status."<br>Special Offer Applicable On Supplement : ".$calender_data[$i]->supplement_compulsory;
          $calendar[$k]="<small>Rate Type  : PPPN ".
          "<br>Adult Rate : ".$calender_data[$i]->adult_rate.
          "<br>Child Rate : <br>".$child_rate_str.
          "Adult Rate(Extra Bed) : ".$calender_data[$i]->extra_bed_for_adults_rate.
          "<br>Child Rate(Extra Bed) : ".$calender_data[$i]->extra_bed_for_child_rate. 
          "<br>Adults(Extra Bed) : ".$calender_data[$i]->extra_bed_for_adults.
          "<br>Child(Extra Bed) : ".$calender_data[$i]->extra_bed_for_child.      
          "<br>Min Occupancy : ".$calender_data[$i]->min_room_occupancy.
          "<br>Max Occupancy : ".$calender_data[$i]->max_room_occupancy.
          "<br>Meal Plan : ".$meal_plan_str.
          "<br>Market : ".$calender_data[$i]->market.$special_str."</small>";
          $calendar_date[$k]=$calender_data[$i]->room_avail_date;

      }
      else  if($calender_data[$i]->rate_type=='PRPN')
      {         
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
             $special_str.="<br>Booking Code :".$calender_data[$i]->booking_code;
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
              $special_str.="<br>Min Nights :".$calender_data[$i]->min_no_of_stay_day;
              $special_str.="<br>Max Nights :".$calender_data[$i]->max_no_of_stay_day;
              $special_str.="<br>Discount (%) :".$calender_data[$i]->discount_percentage;
            }
            else if($calender_data[$i]->specialoffer_id==2 && $calender_data[$i]->specialoffer_type=="Early bird")
            { 
              if($calender_data[$i]->prior_day_type=="prior_checkin")
               {
                  $special_str.="<br>Prior Checkin Days :".$calender_data[$i]->prior_checkin;
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
                  $special_str.="<br>Prior Checkin Days :".$calender_data[$i]->prior_checkin;
               }
               if($calender_data[$i]->prior_day_type=="prior_checkin_date")
               {
                  $special_str.="<br>Prior Booking Date :".date('d-m-Y',strtotime($calender_data[$i]->prior_checkin_date));
               }
               if($calender_data[$i]->prior_day_type=="period")
               {
                  $special_str.="<br>Prior Booking Period : From ".date('d-m-Y',strtotime($calender_data[$i]->period_from_date)).' to '.date('d-m-Y',strtotime($calender_data[$i]->period_to_date));
               }
              $special_str.="<br>Min stay :".$calender_data[$i]->min_no_of_stay_day;
              $special_str.="<br>Max stay :".$calender_data[$i]->max_no_of_stay_day;
              $special_str.="<br>free nights :".$calender_data[$i]->no_of_stay_free_nights;
            }  
            else if($calender_data[$i]->specialoffer_id==4 && $calender_data[$i]->specialoffer_type=="Supplement")
            { 
                // $special_str.="<br>Compulsory :".$calender_data[$i]->supplement_compulsory;
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

          $status='';
          if($calender_data[$i]->status==0)
          {
            $status="<br>Rate Status : InActive";
          }
          else if($calender_data[$i]->status==1)
          {
            $status="<br>Rate Status : Active";
          }
           else if($calender_data[$i]->status==2)
          {
            $status="<br>Rate Status : Blocked";
          }
          // $special_str.=$status."<br>Special Offer Applicable On Supplement : ".$calender_data[$i]->supplement_compulsory;

            $calendar[$k]="<small>Rate Type  : PRPN ".
            "<br>Room Rate : ".$calender_data[$i]->room_rate.      
            "<br>Adult Rate(Extra Bed) : ".$calender_data[$i]->extra_bed_for_adults_rate.
            "<br>Child Rate(Extra Bed) : ".$calender_data[$i]->extra_bed_for_child_rate. 
            "<br>Adults(Extra Bed) : ".$calender_data[$i]->extra_bed_for_adults.
            "<br>Child(Extra Bed) : ".$calender_data[$i]->extra_bed_for_child. 
            "<br>Min Adults : ".$calender_data[$i]->min_adults_without_extra_bed.
            "<br>Max Adults : ".$calender_data[$i]->max_adults_without_extra_bed. 
            "<br>Min Child : ".$calender_data[$i]->min_child_without_extra_bed.
            "<br>Max Child : ".$calender_data[$i]->max_child_without_extra_bed. 
            "<br>Min Occupancy : ".$calender_data[$i]->min_room_occupancy.
            "<br>Max Occupancy : ".$calender_data[$i]->max_room_occupancy. 
            "<br>Meal Plan : ".$meal_plan_str.   
            "<br>Market : ".$calender_data[$i]->market.$special_str."</small>";
              $calendar_date[$k]=$calender_data[$i]->room_avail_date;
      }
    }
     return array($calendar,$calendar_date);   
}

 public function edit_rates_room()
 {
   $dataarray=array('status'=>1);
    $data['specialoffer_type'] =$this->specialoffer_type->check($dataarray); 
    $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
    $data['hotel_list'] =$this->supplier_hotel_list->check($dataarray);  
   $data['sub_view'] = 'specialoffer/editrates';
  $this->load->view('_layout_main',$data);   
 } 

  public function get_hotel_room_rates_def(){
         // echo '<pre>';print_r($_POST);exit;

    $data['hotel_id']=$hotel_id=isset($_POST['hotel_id'])?$_POST['hotel_id']:'';
    $data['room_id']=$room_id=isset($_POST['room_id'])?$_POST['room_id']:'';
    $data['contract_id']= $contract_id=isset($_POST['contract'])?$_POST['contract']:'';
    $data['market']=$market=isset($_POST['market'])?$_POST['market']:'';
    $data['meal_plan']=$meal_plan=isset($_POST['meal_plan'])?implode(',', $_POST['meal_plan']):'';
    $data['from_date']=$from_date=isset($_POST['from_date'])?$_POST['from_date']:'';
    $data['to_date']=$to_date=isset($_POST['to_date'])?$_POST['to_date']:'';
    $data['specialoffer_id']=$specialoffer_id=isset($_POST['specialoffer_type'])?$_POST['specialoffer_type']:'';
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
          redirect('specialoffer/edit_rates_room','refresh');
      }
      if(empty($room_detail)||empty($hotel_detail))
      {  
         redirect('specialoffer/edit_rates_room','refresh');
      }   

$roomrates=$data['roomrates'] = $this->sup_specialoffer_hotel_room_rates->new_cal_get_roomrates_by_date($supplier_id,$hotel_id, $hotel_code, $room_id,$room_code,$contract_id,$market,$specialoffer_id,$meal_plan,$from_date,$to_date);
         // echo '<pre>';print_r($roomrates); echo $this->db->last_query(); exit;
          $data['sub_view'] = 'specialoffer/view_rate_definition';
          $this->load->view('_layout_main',$data);  
     }

public function edit_room_rates(){
   $sup_hotel_room_rates_id=$_POST['rateid'];
   $data['hotel_id']=$hotel_id=$_POST['hotel_id'];
   $data['room_code']=$room_code=$_POST['room_code'];
   $data['hotel_code']=$hotel_code=$_POST['hotel_code'];  
   $data['sup_room_details_id']=$room_id=$_POST['room_id'];
   $data['contract_id']=$contract_id=$_POST['contract_id'];
   $data['specialoffer_id']=$specialoffer_id=$_POST['offer_id'];
   $data['specialoffer_type']=$specialoffer_type=$_POST['offer_type']; 
 $dataarray=array('supplier_room_list_id'=>$room_id,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
  $data['room_list'] =$this->supplier_room_list->check($dataarray);


    $data['result']=$this->sup_specialoffer_hotel_room_rates->get_roomrates($sup_hotel_room_rates_id, $room_code, $hotel_code,$this->supplier_id,$room_id,$contract_id,$specialoffer_id,$specialoffer_type);   
    // echo '<pre>'; print_r($data); exit;    
    $edit_room_rates='';
         if (!empty($data['result'])&&!empty($data['room_list'])) {

           $edit_room_rates.= $this->load->view('specialoffer/load_ajax_specialoffer_room_rate', $data, TRUE);
             echo json_encode(array('edit_room_rates' => $edit_room_rates));
            } else {
                echo json_encode(array('edit_room_rates'=>''));
            }     



    // $data['sub_view'] = 'roomrate/edit_room_rate_view_file';
    // $this->load->view('_layout_main',$data); 
 }

  public function update_room_rates_ind_old(){  

      $hotel_id =$_POST['hotel_id'];
      $sup_room_details_id = $_POST['sup_room_details_id'];    
      $sup_hotel_room_rates_list_id = $_POST['sup_hotel_room_rates_list_id'];    
      $rate_type = $_POST['rate_type'];  
      $sup_hotel_room_rates_id=$_POST['sup_hotel_room_rates_id'];
      $market =$_POST['market'];
      $hotel_code =$_POST['hotel_code'];
      $room_code =$_POST['room_code'];
      $meal_plan = $_POST['meal_plan'];           
      $room_avail_date=$_POST['room_avail_date'];  
      $cancel_rates=$_POST['cancel_rates']; 
      $days_before=$_POST['days_before'];  
      $cancel_rates_type=$_POST['cancel_rates_type'];
      $specialoffer_id=$_POST['specialoffer_id'];
      $specialoffer_type=$_POST['specialoffer_type'];
      $contract_id=$_POST['contract'];
      $rate_type=isset($_POST['rate_type'])?$_POST['rate_type']:'';
      $min_adults_without_extra_bed=isset($_POST['min_adults_without_extra_bed'])?$_POST['min_adults_without_extra_bed']:'';
     $max_adults_without_extra_bed=isset($_POST['max_adults_without_extra_bed'])?$_POST['max_adults_without_extra_bed']:'';
     $min_child_without_extra_bed=isset($_POST['min_child_without_extra_bed'])?$_POST['min_child_without_extra_bed']:''; 
     $max_child_without_extra_bed=isset($_POST['max_child_without_extra_bed'])?$_POST['max_child_without_extra_bed']:'';
     $extra_bed_for_adults=isset($_POST['extra_bed_for_adults'])?$_POST['extra_bed_for_adults']:'';
     $extra_bed_for_child=isset($_POST['extra_bed_for_child'])?$_POST['extra_bed_for_child']:'';  
     $min_room_occupancy=isset($_POST['min_room_occupancy'])?$_POST['min_room_occupancy']:'';
     $max_room_occupancy=isset($_POST['max_room_occupancy'])?$_POST['max_room_occupancy']:''; 
     $discount_rate_type=isset($_POST['discount_rate_type'])?$_POST['discount_rate_type']:'';
      $discount_percentage=isset($_POST['discount_percentage'])?$_POST['discount_percentage']:'';     
      $min_no_of_stay_day=isset($_POST['min_no_of_stay_day'])?$_POST['min_no_of_stay_day']:'';
      $booking_code=isset($_POST['booking_code'])?$_POST['booking_code']:'';      
      $max_no_of_stay_day=isset($_POST['max_no_of_stay_day'])?$_POST['max_no_of_stay_day']:'';
      $no_of_stay_free_nights=isset($_POST['no_of_stay_free_nights'])?$_POST['no_of_stay_free_nights']:'';
      // $supplement_compulsory=isset($_POST['supplement_compulsory'])?$_POST['supplement_compulsory']:'';
      $type_of_supplement=isset($_POST['type_of_supplement'])?$_POST['type_of_supplement']:'';
      $age_limit_for_supplement=isset($_POST['age_limit_for_supplement'])?$_POST['age_limit_for_supplement']:'';
      $supplement_rate=isset($_POST['supplement_rate'])?$_POST['supplement_rate']:'';
      $supplement_desc=isset($_POST['supplement_desc'])?$_POST['supplement_desc']:'';     

   $prior_day_type=isset($_POST['prior_day_type'])?$_POST['prior_day_type']:'';  
  $prior_checkin=isset($_POST['prior_checkin'])?$_POST['prior_checkin']:'';
  $prior_checkin_date=isset($_POST['prior_checkin_date'])?date("Y-m-d",strtotime($_POST['prior_checkin_date'])):'';
  $period_from_date=isset($_POST['period_from_date'])?date("Y-m-d",strtotime($_POST['period_from_date'])):'';
  $period_to_date=isset($_POST['period_to_date'])?date("Y-m-d",strtotime($_POST['period_to_date'])):'';


  $this->sup_specialoffer_hotel_room_cancellation_rates->delete_room_cancellation_data($this->supplier_id,$hotel_id,$hotel_code,$sup_room_details_id,$room_code,$contract_id,$specialoffer_id,$specialoffer_type,$meal_plan,$market,$room_avail_date,$sup_hotel_room_rates_list_id);
 if(isset($_POST['non_refundable']))
   { 
   $insertcancellationdata=array(    
        'sup_hotel_room_rates_list_id'=>$sup_hotel_room_rates_list_id,    
        'supplier_id' => $this->supplier_id,
        'sup_hotel_id' => $hotel_id,
        'hotel_code' => $hotel_code,
        'room_code'=>$room_code,
        'contract_id' => $contract_id,
        'sup_room_details_id'=> $sup_room_details_id,  
        'specialoffer_id'=>$specialoffer_id,
        'specialoffer_type'=>$specialoffer_type,                  
        'room_avail_date'=> $room_avail_date,   
        'market'=> $market,
        'meal_plan'=> $meal_plan,
        'rate_type'=> $rate_type,
        'min_adults_without_extra_bed'=> $min_adults_without_extra_bed,
        'max_adults_without_extra_bed'=> $max_adults_without_extra_bed,
        'min_child_without_extra_bed'=> $min_child_without_extra_bed,
        'max_child_without_extra_bed'=> $max_child_without_extra_bed,
        'extra_bed_for_adults'=> $extra_bed_for_adults,
        'extra_bed_for_child'=> $extra_bed_for_child,
        'min_room_occupancy'=> $min_room_occupancy,
        'max_room_occupancy'=> $max_room_occupancy,  
        'days_before_checkin'=>0,
        'per_rate_charge'=>0,
        'cancel_rates_type'=>$_POST['non_refundable'],
        'date_time' => date('Y-m-d H:i:s'),
       );   
       $this->sup_specialoffer_hotel_room_cancellation_rates->insert($insertcancellationdata);
  }
  else
  {
     $k=0; 
     $insertcancellationdata=array();
    foreach ($_POST['cancel_rates'] as $cancel_rate)
    { 
    $insertcancellationdata[$k]=array(    
        'sup_hotel_room_rates_list_id'=>$sup_hotel_room_rates_list_id,    
        'supplier_id' => $this->supplier_id,
        'sup_hotel_id' => $hotel_id,
        'hotel_code' => $hotel_code,
        'room_code'=>$room_code,
        'contract_id' => $contract_id,
        'sup_room_details_id'=> $sup_room_details_id,  
        'specialoffer_id'=>$specialoffer_id,
        'specialoffer_type'=>$specialoffer_type,                  
        'room_avail_date'=> $room_avail_date,   
        'market'=> $market,
        'meal_plan'=> $meal_plan,
        'rate_type'=> $rate_type,
        'min_adults_without_extra_bed'=> $min_adults_without_extra_bed,
        'max_adults_without_extra_bed'=> $max_adults_without_extra_bed,
        'min_child_without_extra_bed'=> $min_child_without_extra_bed,
        'max_child_without_extra_bed'=> $max_child_without_extra_bed,
        'extra_bed_for_adults'=> $extra_bed_for_adults,
        'extra_bed_for_child'=> $extra_bed_for_child,
        'min_room_occupancy'=> $min_room_occupancy,
        'max_room_occupancy'=> $max_room_occupancy,  
        'days_before_checkin'=>$_POST['days_before'][$k],
        'per_rate_charge'=>$_POST['cancel_rates'][$k],
        'cancel_rates_type'=>$_POST['cancel_rates_type'][$k],
        'date_time' => date('Y-m-d H:i:s'),
       );
      $this->sup_specialoffer_hotel_room_cancellation_rates->insert($insertcancellationdata[$k]);
         $k++;
      }
    }



 
 $check=$this->sup_specialoffer_hotel_room_rates->get_roomrates_edit($hotel_id,$sup_hotel_room_rates_list_id,$sup_hotel_room_rates_id, $room_code, $hotel_code,$this->supplier_id,$sup_room_details_id,$contract_id,$specialoffer_id,$specialoffer_type,$market,$meal_plan);
if($check!=''){
 if($_POST['rate_type']=='PRPN'){ 
    $updatadata=array(        
            'room_rate'=> $_POST['room_rate'],
            'min_adults_without_extra_bed'=> $_POST['min_adults_without_extra_bed'],
            'max_adults_without_extra_bed'=> $_POST['max_adults_without_extra_bed'],
            'min_child_without_extra_bed'=> $_POST['min_child_without_extra_bed'],
            'max_child_without_extra_bed'=> $_POST['max_child_without_extra_bed'],
            'extra_bed_for_adults'=> $_POST['extra_bed_for_adults'],
            'extra_bed_for_child'=> $_POST['extra_bed_for_child'],
            'extra_bed_for_adults_rate'=> $_POST['extra_bed_for_adults_rate'],
            'extra_bed_for_child_rate'=> $_POST['extra_bed_for_child_rate'],
            'min_room_occupancy'=> $_POST['min_room_occupancy'],
            'max_room_occupancy'=> $_POST['max_room_occupancy'],
            'discount_rate_type'=>$discount_rate_type,
            'discount_percentage'=>$discount_percentage,
            'prior_day_type'=>$prior_day_type,
            'prior_checkin'=>$prior_checkin,
            'prior_checkin_date'=>$prior_checkin_date,
            'period_from_date'=>$period_from_date,
            'period_to_date'=>$period_to_date, 
            'min_no_of_stay_day'=>$min_no_of_stay_day,
            'booking_code'=>$booking_code,
            'max_no_of_stay_day'=>$max_no_of_stay_day,
            'no_of_stay_free_nights'=>$no_of_stay_free_nights,
            // 'supplement_compulsory'=>$supplement_compulsory,
            'type_of_supplement'=>$type_of_supplement,
            'age_limit_for_supplement'=>$age_limit_for_supplement,
            'supplement_rate'=>$supplement_rate,
            'supplement_desc'=>stripslashes($supplement_desc),          
          
            );
          $this->sup_specialoffer_hotel_room_rates->get_roomrates_update($hotel_id,$sup_hotel_room_rates_list_id,$sup_hotel_room_rates_id, $room_code, $hotel_code,$this->supplier_id,$sup_room_details_id,$contract_id,$specialoffer_id,$specialoffer_type,$market,$meal_plan,$updatadata);
          echo json_encode(array('success' => 'true'));
      }
  else if($_POST['rate_type']=='PPPN'){ 

     $room_detail=$this->supplier_room_list->get_single($sup_room_details_id);   
     
      if(isset($_POST['child_rate']))
      {
         $child_rate=array();
         $child_agerange=json_decode($room_detail->child_agerange,true); 
         $ch=0;       
         foreach ($child_agerange as $key => $value)
          { 
             $val=explode('||', $value);
             $child_rate[$ch]=$val[0].'-'.$val[1].'||'.$_POST['child_rate'][$ch];
             $ch++;
          }     
      }
      else
      {
         $child_rate='';
      }
    $updatadata=array(        
            'adult_rate'=> $_POST['adult_rate'],
            'child_rate'=> json_encode($child_rate), 
            'extra_bed_for_adults'=> $_POST['extra_bed_for_adults'],
            'extra_bed_for_child'=> $_POST['extra_bed_for_child'],
            'extra_bed_for_adults_rate'=> $_POST['extra_bed_for_adults_rate'],
          'extra_bed_for_child_rate'=> $_POST['extra_bed_for_child_rate'],             
            'min_room_occupancy'=> $_POST['min_room_occupancy'],
            'max_room_occupancy'=> $_POST['max_room_occupancy'],
            'discount_rate_type'=>$discount_rate_type,
            'discount_percentage'=>$discount_percentage,
            'prior_day_type'=>$prior_day_type,
            'prior_checkin'=>$prior_checkin,
            'prior_checkin_date'=>$prior_checkin_date,
            'period_from_date'=>$period_from_date,
            'period_to_date'=>$period_to_date,
            'min_no_of_stay_day'=>$min_no_of_stay_day,
            'booking_code'=>$booking_code,
            'max_no_of_stay_day'=>$max_no_of_stay_day,
            'no_of_stay_free_nights'=>$no_of_stay_free_nights,
            // 'supplement_compulsory'=>$supplement_compulsory,
            'type_of_supplement'=>$type_of_supplement,
            'age_limit_for_supplement'=>$age_limit_for_supplement,
            'supplement_rate'=>$supplement_rate,
            'supplement_desc'=>stripslashes($supplement_desc),         
          
            );
          $this->sup_specialoffer_hotel_room_rates->get_roomrates_update($hotel_id,$sup_hotel_room_rates_list_id,$sup_hotel_room_rates_id, $room_code, $hotel_code,$this->supplier_id,$sup_room_details_id,$contract_id,$specialoffer_id,$specialoffer_type,$market,$meal_plan,$updatadata);
           echo json_encode(array('success' => 'true'));
      }
      else
      {
         echo json_encode(array('success' => ''));
      }
    }
   else
      {
         echo json_encode(array('success' => ''));
      }  
}


 public function update_room_rates_ind(){  

      $hotel_id =$_POST['hotel_id'];
      $sup_room_details_id = $_POST['sup_room_details_id'];    
      $sup_hotel_room_rates_list_id = $_POST['sup_hotel_room_rates_list_id'];    
      $rate_type = $_POST['rate_type'];  
      $sup_hotel_room_rates_id=$_POST['sup_hotel_room_rates_id'];
      $market =$_POST['market'];
      $hotel_code =$_POST['hotel_code'];
      $room_code =$_POST['room_code'];
      $meal_plan = $_POST['meal_plan'];           
      $room_avail_date=$_POST['room_avail_date'];     
      $specialoffer_id=$_POST['specialoffer_id'];
      $specialoffer_type=$_POST['specialoffer_type'];
      $contract_id=$_POST['contract'];
      $rate_type=isset($_POST['rate_type'])?$_POST['rate_type']:'';
      $discount_percentage=isset($_POST['discount_percentage'])?$_POST['discount_percentage']:'';
     $extra_bed_for_adults_rate=isset($_POST['extra_bed_for_adults_rate'])?$_POST['extra_bed_for_adults_rate']:'0';
    $extra_bed_for_child_rate=isset($_POST['extra_bed_for_child_rate'])?$_POST['extra_bed_for_child_rate']:'0';

$check=$this->sup_specialoffer_hotel_room_rates->get_roomrates_edit($hotel_id,$sup_hotel_room_rates_list_id,$sup_hotel_room_rates_id, $room_code, $hotel_code,$this->supplier_id,$sup_room_details_id,$contract_id,$specialoffer_id,$specialoffer_type,$market,$meal_plan);
if($check!=''){
 if($_POST['rate_type']=='PRPN'){ 
    $updatadata=array(        
            'room_rate'=> $_POST['room_rate'],        
            'extra_bed_for_adults_rate'=> $extra_bed_for_adults_rate,
            'extra_bed_for_child_rate'=> $extra_bed_for_child_rate,
            'discount_percentage'=>$discount_percentage,
            );
          $this->sup_specialoffer_hotel_room_rates->get_roomrates_update($hotel_id,$sup_hotel_room_rates_list_id,$sup_hotel_room_rates_id, $room_code, $hotel_code,$this->supplier_id,$sup_room_details_id,$contract_id,$specialoffer_id,$specialoffer_type,$market,$meal_plan,$updatadata);
          echo json_encode(array('success' => 'true'));
      }
  else if($_POST['rate_type']=='PPPN'){ 

     $room_detail=$this->supplier_room_list->get_single($sup_room_details_id);   
     
      if(isset($_POST['child_rate']))
      {
         $child_rate=array();
         $child_agerange=json_decode($room_detail->child_agerange,true); 
         $ch=0;       
         foreach ($child_agerange as $key => $value)
          { 
             $val=explode('||', $value);
             $child_rate[$ch]=$val[0].'-'.$val[1].'||'.$_POST['child_rate'][$ch];
             $ch++;
          }     
      }
      else
      {
         $child_rate='';
      }
    $updatadata=array(        
   'adult_rate'=> $_POST['adult_rate'],
   'child_rate'=> json_encode($child_rate), 
   'extra_bed_for_adults_rate'=> $extra_bed_for_adults_rate,
   'extra_bed_for_child_rate'=> $extra_bed_for_child_rate,          
   'discount_percentage'=>$discount_percentage,           
            );
          $this->sup_specialoffer_hotel_room_rates->get_roomrates_update($hotel_id,$sup_hotel_room_rates_list_id,$sup_hotel_room_rates_id, $room_code, $hotel_code,$this->supplier_id,$sup_room_details_id,$contract_id,$specialoffer_id,$specialoffer_type,$market,$meal_plan,$updatadata);
           echo json_encode(array('success' => 'true'));
      }
      else
      {
         echo json_encode(array('success' => ''));
      }
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
  echo json_encode(array('result' =>$this->load->view('specialoffer/load_specialoffer_rate_type_ajax', $data, TRUE),'result1'=>''));
}
}
public function prior_day_type()
{
  $data['prior_day_type']=$_POST['prior_day_type'];
  if(isset($_POST['prior_day_type']))
  {
  echo json_encode(array('result' =>$this->load->view('specialoffer/load_ajax_prior_days_type', $data, TRUE)));
  }
  else
  {
   echo json_encode(array('result' =>'')); 
  }

}

}

