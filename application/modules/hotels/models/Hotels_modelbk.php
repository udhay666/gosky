<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotels_Model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }    

    public function getActiveAPIs() 
    {
       $this->db->select('api_name');
       $this->db->from('api_info');
       $this->db->where('service_type', 1);
       $this->db->where('status', 1);
       $this->db->order_by('order_no', 'ASC');
       $query = $this->db->get();

       if($query->num_rows > 0) 
       {
        return $query->result_array();            
    }
    else
    {
        return '';
    }
}

public function delete_temp_results($sess_id)
{         
    $this->db->where('session_id',$sess_id);
    $this->db->delete('hotel_search_result');
}

public function TotalSearchResults($sess_id,$minPrice='',$maxPrice='',$starRating='',$hotelName='',$location='',$amenity='')
{      
    $this->db->select('t.hotel_code');
    $this->db->from('hotel_search_result t');
    $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code','right');            
    $this->db->where('t.session_id',$sess_id); 

    if($minPrice != '' && $maxPrice != '')
    {
        $this->db->where('t.total_cost BETWEEN '.$minPrice.' AND '.$maxPrice);
    }
    if($starRating != '')
    {  
        $stars = explode(',',$starRating);
        $this->db->where_in('p.star', $stars);
    }
    if($location != '')
    {               
        $loc_list = explode(',',$location);
        $this->db->where_in('p.location', $loc_list);
    }
    if(!empty($amenity))
    {
        $where='';
        $amenity_arr=explode(',', $amenity); 
        if(count($amenity_arr)>1)
        {
            $where.="( FIND_IN_SET('".$amenity_arr[0]."',p.facility_list)>0";           
            for ($i=1; $i <(count($amenity_arr)-1) ; $i++) 
            {
                $where.=" or FIND_IN_SET('".$amenity_arr[$i]."',p.facility_list)>0";
            }
            $where.=" or FIND_IN_SET('".$amenity_arr[$i]."',p.facility_list)>0 )";
            $this->db->where($where);
        }else{
          $this->db->where("FIND_IN_SET('".$amenity_arr[0]."',p.facility_list)>",0); 
      }
  }

 if($hotelName != '')
  {                
    $this->db->like('p.hotel_name', $hotelName);
}

$this->db->group_by('t.hotel_code');
$query = $this->db->get();

if($query->num_rows() == 0 )
{
    return 0;   
}
else
{           
 return $query->num_rows();
}



}

public function get_filter_option_details($sess_id)
{      
    //$this->db->select('MIN(t.total_cost) as min_price, MAX(t.total_cost) as max_price');
    $this->db->select('MIN(t.pricecomp) as min_price, MAX(t.pricecomp) as max_price');
    $this->db->from('hotel_search_result t');
        //$this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code AND t.api = p.api');
    $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code');            
    $this->db->where('t.session_id',$sess_id);  
    $this->db->where('t.lowest',1); 
    $this->db->where('p.star !=',0); 
    $this->db->where('t.pricecomp !=',0); 
    // $this->db->group_by('t.hotel_code');    
    $query = $this->db->get();
    if($query->num_rows() == 0 )
    {
        return 0;   
    }
    else
    {           
     return $query->row();
 }
}

public function get_locations_list($sess_id)
{      
    $this->db->select('p.location');
    $this->db->from('hotel_search_result t');
    $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code');
    $this->db->where('t.session_id',$sess_id);    
    $this->db->distinct();
    $query = $this->db->get();
    if($query->num_rows() == 0 )
    {
        return '';   
    }
    else
    {           
     return $query->result();
 }
}

public function all_fetch_search_result($sess_id,$offset,$perPage,$minPrice='',$maxPrice='',$starRating='',$hotelName='',$location='',$sortBy='',$order='',$amenity='')
{             
    $this->db->select('t.*,p.hotel_name,p.image,p.star,p.city_name,p.location,p.hotel_facilities as amenities,p.address as address,p.category_desc,t.pricecomp,p.facility_list');
    $this->db->from('hotel_search_result t');
    $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code');
    $this->db->where('t.lowest',1);     
    $this->db->where('t.session_id',$sess_id);            
    if($minPrice != '' && $maxPrice != '')
    {
        //$this->db->where('t.total_cost BETWEEN '.$minPrice.' AND '.$maxPrice);
        $this->db->where('t.pricecomp BETWEEN '.$minPrice.' AND '.$maxPrice);        
    }
    if($starRating != '')
    {               
     $stars = explode(',',$starRating);
     $this->db->where_in('p.star', $stars);
 }

 if($location!='')
 {  
    // $loc_list = explode(',',$location);
  // $this->db->where_in('p.location', $loc_list);
    $where='';
    $location_arr=explode(',', $location);
    if(count($location_arr)>1)
    {
       $where.="( FIND_IN_SET('".$location_arr[0]."',p.location)>0";           
       for ($i=1; $i <(count($location_arr)-1) ; $i++) 
       {
        $where.=" or FIND_IN_SET('".$location_arr[$i]."',p.location)>0";
    }
    $where.=" or FIND_IN_SET('".$location_arr[$i]."',p.location)>0 )";
    $this->db->where($where);
}
else{
  $this->db->where("FIND_IN_SET('".$location_arr[0]."',p.location)>",0); 
}  
}

if(!empty($amenity))
{
    $where='';
    $amenity_arr=explode(',', $amenity); 
    if(count($amenity_arr)>1)
    {
        $where.="( FIND_IN_SET('".$amenity_arr[0]."',p.facility_list)>0";           
        for ($i=1; $i <(count($amenity_arr)-1) ; $i++) 
        {
            $where.=" AND FIND_IN_SET('".$amenity_arr[$i]."',p.facility_list)>0";
        }
        $where.=" AND FIND_IN_SET('".$amenity_arr[$i]."',p.facility_list)>0 )";
        $this->db->where($where);
    }else{
      $this->db->where("FIND_IN_SET('".$amenity_arr[0]."',p.facility_list)>",0); 
  }
}


if($hotelName != '')
{                
 $this->db->like('p.hotel_name', $hotelName);
}
 $this->db->group_by('t.hotel_code');
$this->db->where('p.star !=',0); 
 $this->db->where('t.pricecomp !=',0);
if($sortBy != '' && $order != '')
{
    if($sortBy == 'data-price') 
    {
        $this->db->order_by('t.total_cost', strtoupper($order));
    }
    else if($sortBy == 'data-star')
    {
        $this->db->order_by('p.star', strtoupper($order));
    }
    else if($sortBy == 'data-hotel-name')
    {
        $this->db->order_by('p.hotel_name', strtoupper($order));
    }
    else
    {
        $this->db->order_by('t.pricecomp','ASC');   
    }
}
else
{
    $this->db->order_by('t.pricecomp','ASC');   
}

$this->db->limit($perPage,$offset);
$query = $this->db->get();

            //echo $this->db->last_query();exit;
if($query->num_rows() == 0 )
{
    return '';   
}
else
{
    return $query->result();            
}
}



public function get_gta_amenities($hotel_code)
{       
    $this->db->select("GROUP_CONCAT(DISTINCT fac_type SEPARATOR ';')  as h_amenities");           
    $this->db->from("gta_hotel_facilities");          
    $this->db->where("hotel_code",$hotel_code);          
    $query = $this->db->get();

   if($query->num_rows() == 0)
    {
        return '';   
    }
    else
    {
        $res = $query->row();       
        $ha = $res->h_amenities;

        $this->db->select("GROUP_CONCAT(DISTINCT fac_type SEPARATOR ';')  as r_amenities");           
        $this->db->from("gta_room_facilities");          
        $this->db->where("hotel_code",$hotel_code);          
        $query1 = $this->db->get();
        if($query1->num_rows() == 0)
        {
            return $ha;   
        }
        else
        {
            $res1 = $query1->row();         
            $ra = $res1->r_amenities;
            return $ha.';'.$ra;                    
        }
    }
}

public function get_hotel_booking_information($sysRefNo,$hotelRefNo)
{       
    $this->db->select('r.*,h.*,r.agent_id as agentid');
    $this->db->from('hotel_booking_reports r');
    $this->db->join('hotel_booking_hotels_info h', 'r.uniqueRefNo = h.uniqueRefNo');
        //$this->db->where('r.Hotel_RefNo',$hotelRefNo);
    $this->db->where('h.uniqueRefNo',$sysRefNo);
    $this->db->limit('1');
    $query = $this->db->get();
  // echo $this->db->last_query();exit;
    if($query->num_rows() == 0 )
    {
       return '';   
   }
   else
   {
    return $query->row();           
}
}

public function get_hotel_booking_passenger_info($sysRefNo)
{       
    $this->db->select('*');
    $this->db->from('hotel_booking_passengers_info');       
    $this->db->where('uniqueRefNo',$sysRefNo);  
    $this->db->order_by('pass_id','ASC');
    $query = $this->db->get();
    if($query->num_rows() == 0 )
    {
       return '';   
   }
   else
   {
    return $query->result();            
}
}

public function get_booking_report($RefNo,$Booking_ID) {
    $this->db->select('hb.*,hh.api as Api_Name');
    $this->db->from('hotel_booking_reports hb');
    $this->db->join('hotel_booking_hotels_info hh','hb.AL_RefNo=hh.AL_RefNo');
    $this->db->where('hb.Booking_RefNo', $Booking_ID);
    $this->db->where('hb.AL_RefNo', $RefNo);
    $this->db->limit('1');
    $query = $this->db->get();
    if ($query->num_rows > 0) {
        return $query->row();
    } else {
        return '';
    }   
}   


public function get_promotional_code($promo_code) {
   $this->db->select('*')
   ->from('promotion_manager')
   ->where('promo_code', $promo_code)
   ->where('status', 1)
   ->limit('1');
   $query = $this->db->get();

   if ($query->num_rows > 0) {
    return $query->row();

} else {
    return '';
}   
}

public function getAgentInfo($agent_id)
{       
    $this->db->select('*')
    ->from('agent_info')
    ->where('agent_id', $agent_id)          
    ->limit(1);
    $query = $this->db->get();

    if($query->num_rows > 0)
    {      
        return $query->row();
    }
   return false;       
}

function getAgentAvailableBalance($agent_id)
{
    $this->db->select('available_balance')
    ->from('agent_acc_summary')             
    ->where('agent_id',$agent_id)
    ->order_by('acc_id','DESC')
    ->limit('1');
    $query = $this->db->get();

    if($query->num_rows > 0) 
    {      
     $res = $query->row();
     $balance = $res->available_balance;
 }  
 else
 {
     $balance = 0;
 }

 return $balance;

}   

function currency_converter($From,$To,$Amount)
{
    $from_cur_val = $this->currency_value($From);
    $to_cur_val = $this->currency_value($To);            

    $con_amount = ($to_cur_val / $from_cur_val) * $Amount;      
    return round($con_amount,2);

}

function currency_value($currencyCode)
{
    $this->db->select('value');
    $this->db->from('currency');        
    $this->db->where('currency_code', $currencyCode);               
    $this->db->limit('1');
    $query = $this->db->get();

    if($query->num_rows > 0) 
    {
        $res = $query->row();   
        $from_value = $res->value;            
    }
    else
    {
        $from_value = 0;
    }

    return $from_value;
    
}

public function getRoomDetails($api,$sess_id,$hotelCode,$searchId)

{

    $this->db->select('a.*,b.*');

    $this->db->from('hotel_search_result a');

    $this->db->join('hb_permanent_hotels b','a.hotel_code = b.hotel_code','left');

    $this->db->where('b.hotel_code',$hotelCode);

    $this->db->where('a.session_id',$sess_id);  

    $this->db->where('a.api',$api);     

    $this->db->where('a.search_id',$searchId);                  

    $query = $this->db->get();

        //echo $this->db->last_query();exit;

    if($query->num_rows() > 0)

    {

        return $query->row();

    }

    else 

    {

        return '';

    }

}

public function paypal_details($payinsert) {
    $this->db->insert('paypal_details', $payinsert);
    $insert_id = $this->db->insert_id();
    return $insert_id;  
}

public function update_paypal_details($updatpay,$uniqueRefNo){
    $this->db->where('CMHRefNo',$uniqueRefNo);
    if($this->db->update('paypal_details',$updatpay)){
        return true;
    }else{
        return false;
    }
}

public function get_hotel_result_rooms($session_id, $hotelCode, $api,$star) {
    $this->db->select('t.*,p.*');
    $this->db->from('hotel_search_result t');
    $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code');
    $this->db->where('t.session_id', $session_id);
    $this->db->where('t.hotel_code', $hotelCode);
    $this->db->where('t.api', $api);
    $this->db->where('p.star', $star);
    $this->db->where('t.lowest', 1);
    $this->db->order_by('t.total_cost', 'ASC');
        //$this->db->limit(2);
    $query = $this->db->get();
    if ($query->num_rows() > 0)
        return $query->result();
    else
        return '';
}

public function update_axis_details($Sys_RefNo,$status,$amount,$locale,$batchNo,$command,$message,$cardType,$orderInfo,$receiptNo,$merchantID,$authorizeID,$merchTxnRef,$transactionNo,$acqResponseCode,$txnResponseCode,$verType,$verStatus,$token,$verSecurLevel,$enrolled,$xid,$acqECI,$authStatus){
    $this->db->where('uniqueRefNo',$Sys_RefNo);
    $data=array(
        'status'=>$status,
        'Amount'=>$amount,
        'locale'=>$locale,
        'batchNo'=>$batchNo,
        'command'=>$command,
        'message'=>$message,
        'cardType'=>$cardType,
        'orderInfo'=>$orderInfo,
        'receiptNo'=>$receiptNo,
        'merchantID'=>$merchantID,
        'authorizeID'=>$authorizeID,
        'merchTxnRef'=>$merchTxnRef,
        'transactionNo'=>$transactionNo,
        'acqResponseCode'=>$acqResponseCode,
        'txnResponseCode'=>$txnResponseCode,
        'verType'=>$verType,
        'verStatus'=>$verStatus,
        'token'=>$token,
        'verSecurLevel'=>$verSecurLevel,
        'enrolled'=>$enrolled,
        'xid'=>$xid,
        'acqECI'=>$acqECI,
        'authStatus'=>$authStatus,   
        );
    $this->db->update('axis_details',$data);
}
public function get_hotel_fac_list($hotel_code){
    $this->db->select('*');
    $this->db->from('gta_hotel_facilities');
    $this->db->where('hotel_code',$hotel_code);
    $query = $this->db->get();

        //echo $this->db->last_query();exit;

    if($query->num_rows() > 0)
    {
        return $query->result();
    }
    else 
    {
        return '';
    }
}
public function get_room_fac_list($hotel_code){
    $this->db->select('*');
    $this->db->from('gta_room_facilities');
    $this->db->where('hotel_code',$hotel_code);
    $query = $this->db->get();

        //echo $this->db->last_query();exit;

    if($query->num_rows() > 0)
    {
        return $query->result();
    }
    else 
    {
        return '';
    }
}
public function get_gta_hotels($start){
    $this->db->select('*');
    $this->db->from('api_permanent_hotels');
    $this->db->where('api','gta');
    $this->db->limit(3000,$start);
        //$this->db->limit(10000,50000);
    $query = $this->db->get();

        //echo $this->db->last_query();exit;

    if($query->num_rows() > 0)
    {
        return $query->result();
    }
    else 
    {
        return '';
    }
}
public function update_fac($fac_list,$hotel_code,$city_code){
    $data=array(
        'facility_list'=>$fac_list,
        );
    $this->db->where('hotel_code',$hotel_code);
    $this->db->where('city_code',$city_code);
    $this->db->where('api','gta');
    $this->db->update('api_permanent_hotels',$data);

}
public function get_hotel_facility_details($hotelCode) {
    $this->db->select('hfd.*,hf.*');
    $this->db->from('hb_hotel_facilities hf');
    $this->db->join('hb_facility_descriptions hfd', 'hf.CODE = hfd.Code AND hf.GROUP = hfd.Group');
    $this->db->where('hf.HOTELCODE',$hotelCode);
    $this->db->where_in('hf.GROUP', array(70, 71, 72, 73, 74, 80, 90));
    $query = $this->db->get();

    if ($query->num_rows() > 0){
        return $query->result();
    }else{
        return '';
    }
}
public function get_hb_hotels(){
    $this->db->select('*');
    $this->db->from('api_permanent_hotels');
    $this->db->where('api','hotelbeds');
       //  $this->db->limit(10);
    $this->db->limit(10000,70000);
    $query = $this->db->get();

        //echo $this->db->last_query();exit;

    if($query->num_rows() > 0)
    {
        return $query->result();
    }
    else 
    {
        return '';
    }
}
public function update_fac_hb($fac_list,$hotel_code,$city_code){
    $data=array(
        'facility_list'=>$fac_list,
        );
    $this->db->where('hotel_code',$hotel_code);
    $this->db->where('city_code',$city_code);
    $this->db->where('api','hotelbeds');
    $this->db->update('api_permanent_hotels',$data);

}
public function get_hb_images($hotel_code){

    $this->db->select('*');
    $this->db->from('hb_hotel_images');
    $this->db->where('HOTELCODE',$hotel_code);
    $query = $this->db->get();
    if($query->num_rows() > 0)
    {
        return $query->result();
    }
    else 
    {
        return '';
    }

}

public function get_travelguru_hotels(){
    $this->db->select('*');
    $this->db->from('api_permanent_hotels');
    $this->db->where('api','travelguru');
       //  $this->db->limit(10);
    $this->db->limit(5000,51000);
        // $this->db->limit(45000);
    $query = $this->db->get();

        // echo $this->db->last_query();exit;

    if($query->num_rows() > 0)
    {
        return $query->result();
    }
    else 
    {
        return '';
    }
} 

public function get_travelguru_hotel_facility_details($hotelCode) {
    $this->db->select('*');
    $this->db->from('tg_hotel_facilities');
    $this->db->where('hotel_code',$hotelCode);       
    $this->db->where('amenity_type','property');      
    $query = $this->db->get();
    if ($query->num_rows() > 0)
        return $query->result();
    else
        return '';
}

public function update_fac_travelguru($fac_list,$hotel_code,$city_code){
    $data=array(
        'facility_list'=>$fac_list,
        );
    $this->db->where('hotel_code',$hotel_code);
    $this->db->where('city_code',$city_code);
    $this->db->where('api','travelguru');
    $this->db->update('api_permanent_hotels',$data);

}      

}
?>