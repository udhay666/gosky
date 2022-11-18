<?php

class Sup_specialoffer_hotel_room_rates extends MY_Model {

    protected $_table_name = 'sup_specialoffer_hotel_room_rates';
    protected $_primary_key = 'sup_hotel_room_rates_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "sup_hotel_room_rates_id Desc";

    function __construct() {
        parent :: __construct();
    }

    function insert($data) {
        $error = parent::insert($data);
        return $error;
    }
      
    function update($data, $id = NULL) {
        $error = parent::update($data, $id);
        return $error;
    }
    function get($fields=NULL,$id=NULL,$single=FALSE) {
        $query = parent::get($id, $single, $fields);
        return $query;
    }
    function get_only_supplier($fields=NULL,$supplier_id, $id=NULL,$single=FALSE) {
        $query = parent::get_supplier($id, $single, $fields,$supplier_id);
        return $query;
    }
    function get_active($fields=NULL) {
        $column = 'status';
        $query = parent::get_active($column,1,$fields);
        return $query;
    }
    function set_status($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }
   
    function get_single($id, $signal=TRUE) {
        $query = parent::get($id, $signal);
        return $query;
    }

      function check($array=NULL) {
        $this->db->select()->from($this->_table_name)->where($array);
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


     public function get_roomrates_by_date($room_id, $startdate, $enddate,$contract_id,$specialoffer_id="") {
        $this->db->select('*');
        $this->db->from('sup_specialoffer_hotel_room_rates');
        $this->db->where('sup_room_details_id', $room_id);
        $this->db->where('contract_id', $contract_id);  
        if($specialoffer_id!=''){
        $this->db->where('specialoffer_id', $specialoffer_id);   
        }     
              
        $this->db->where('room_avail_date BETWEEN "' . $startdate . '" and "' . $enddate . '"');
        $this->db->where('supplier_id',$this->session->userdata('supplier_id'));
        $query = $this->db->get();
        // echo $this->db->last_query($query); exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


    function delete_room_rates_old($hotel_id, $room_id, $startdate,$enddate,$contract_id,$market,$meal_plan,$specialoffer_id,$specialoffer_type) {
        $this->db->where('room_avail_date BETWEEN "' . $startdate . '" and "' . $enddate . '"');      
        $this->db->where('sup_room_details_id', $room_id);      
        $this->db->where('sup_hotel_id', $hotel_id);
        $this->db->where('contract_id', $contract_id);
        $this->db->where('market', $market);
        $this->db->where('meal_plan', $meal_plan);
        $this->db->where('specialoffer_id', $specialoffer_id);
        $this->db->where('specialoffer_type', $specialoffer_type);
        $this->db->delete('sup_specialoffer_hotel_room_rates');
    }

     public function new_cal_get_roomrates_by_date($supplier_id,$hotel_id, $hotel_code, $room_id,$room_code,$contract_id='',$market='',$specialoffer_id='',$meal_plan='',$from_date='',$to_date='') {
        $this->db->select('*');
        $this->db->from('sup_specialoffer_hotel_room_rates');
        $this->db->where('sup_room_details_id', $room_id);        
        $this->db->where('sup_hotel_id', $hotel_id);        
        $this->db->where('hotel_code', $hotel_code);        
        $this->db->where('room_code', $room_code);  
        if($contract_id!='')
        {
           $this->db->where('contract_id', $contract_id);    
        }  
        if($market!='')
        {
           $this->db->where('market', $market);    
        }  
        if($specialoffer_id!='')
        {
           $this->db->where('specialoffer_id', $specialoffer_id);    
        }   
         if($meal_plan!='')
        {
           $this->db->where('meal_plan', $meal_plan);    
        }
        if($from_date!=''){
            $this->db->where('room_avail_date >=', date('Y-m-d',strtotime($from_date)));
         }
        if($to_date !=''){
                $this->db->where('room_avail_date <=', date('Y-m-d',strtotime($to_date)));          
        }
        $this->db->where('supplier_id',$supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


public function get_roomrates($sup_hotel_room_rates_id, $room_code, $hotel_code,$supplier_id,$sup_room_details_id,$contract_id,$specialoffer_id,$specialoffer_type){
     $this->db->select('*');
        $this->db->from('sup_specialoffer_hotel_room_rates');
    $this->db->where('sup_hotel_room_rates_id',$sup_hotel_room_rates_id);
    $this->db->where('room_code',$room_code);
    $this->db->where('hotel_code',$hotel_code);
    $this->db->where('supplier_id',$supplier_id);
    $this->db->where('sup_room_details_id',$sup_room_details_id);
    $this->db->where('contract_id',$contract_id);
    $this->db->where('specialoffer_id',$specialoffer_id);
    $this->db->where('specialoffer_type',$specialoffer_type);

 $query=$this->db->get();
         if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }     
    }

 public function get_roomrates_edit($sup_hotel_id,$sup_hotel_room_rates_list_id,$sup_hotel_room_rates_id, $room_code, $hotel_code,$supplier_id,$sup_room_details_id,$contract_id,$specialoffer_id,$specialoffer_type,$market,$meal_plan){
     $this->db->select('*');
    $this->db->from('sup_specialoffer_hotel_room_rates');
    $this->db->where('sup_hotel_room_rates_id',$sup_hotel_room_rates_id);
    $this->db->where('sup_hotel_room_rates_list_id',$sup_hotel_room_rates_list_id);
    $this->db->where('room_code',$room_code);
    $this->db->where('sup_hotel_id',$sup_hotel_id);
    $this->db->where('hotel_code',$hotel_code);
    $this->db->where('supplier_id',$supplier_id);
    $this->db->where('sup_room_details_id',$sup_room_details_id);
    $this->db->where('contract_id',$contract_id);
    $this->db->where('specialoffer_id',$specialoffer_id);
    $this->db->where('specialoffer_type',$specialoffer_type);
    $this->db->where('supplier_id',$supplier_id);
    $this->db->where('market',$market);
    $this->db->where('meal_plan',$meal_plan);
    $query=$this->db->get();
         if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }     
    }

public function get_roomrates_update($hotel_id,$sup_hotel_room_rates_list_id,$sup_hotel_room_rates_id, $room_code, $hotel_code,$supplier_id,$sup_room_details_id,$contract_id,$specialoffer_id,$specialoffer_type,$market,$meal_plan,$data){
    $this->db->where('sup_hotel_room_rates_id',$sup_hotel_room_rates_id);
    $this->db->where('sup_hotel_room_rates_list_id',$sup_hotel_room_rates_list_id);
    $this->db->where('room_code',$room_code);
    $this->db->where('sup_hotel_id',$hotel_id);
    $this->db->where('hotel_code',$hotel_code);
    $this->db->where('supplier_id',$supplier_id);
    $this->db->where('sup_room_details_id',$sup_room_details_id);
    $this->db->where('contract_id',$contract_id);
    $this->db->where('specialoffer_id',$specialoffer_id);
    $this->db->where('specialoffer_type',$specialoffer_type);
    $this->db->where('supplier_id',$supplier_id);
    $this->db->where('market',$market);
    $this->db->where('meal_plan',$meal_plan);  
    $this->db->update('sup_specialoffer_hotel_room_rates',$data);
}

function update_specailoffer_room_allotment($supplier_id,$hotel_id,$hotel_code,$room_code,$contract_id,$sup_room_details_id,$room_avail_date,$updatadata) 
 {
    $this->db->where('room_code',$room_code);
    $this->db->where('sup_hotel_id',$hotel_id);
    $this->db->where('hotel_code',$hotel_code);
    $this->db->where('supplier_id',$supplier_id);
    $this->db->where('sup_room_details_id',$sup_room_details_id);
    $this->db->where('contract_id',$contract_id); 
    $this->db->where('room_avail_date',$room_avail_date);   
    $this->db->update('sup_specialoffer_hotel_room_rates',$updatadata);
 }


     function delete_room_rates($rowarr)
    {
       $this->db->where('supplier_id',$rowarr['supplier_id']);
       $this->db->where('sup_hotel_id',$rowarr['sup_hotel_id']);   
       $this->db->where('hotel_code',$rowarr['hotel_code']);   
       $this->db->where('room_code',$rowarr['room_code']);   
       $this->db->where('contract_id',$rowarr['contract_id']);   
       $this->db->where('sup_room_details_id',$rowarr['sup_room_details_id']);   
       $this->db->where('room_avail_date BETWEEN "' . $rowarr['from_date'] . '" and "' . $rowarr['to_date'] . '"');     
       $this->db->where('market',$rowarr['market']);   
       $this->db->where('meal_plan',$rowarr['meal_plan']);   
       $this->db->where('rate_type',$rowarr['rate_type']);  
       $this->db->where('specialoffer_id',$rowarr['specialoffer_id']);  
       $this->db->where('specialoffer_type',$rowarr['specialoffer_type']);  
       $this->db->where('min_room_occupancy',$rowarr['min_room_occupancy']);   
       $this->db->where('max_room_occupancy',$rowarr['max_room_occupancy']);   
       if($rowarr['min_adults_without_extra_bed']!='')
        {
           $this->db->where('min_adults_without_extra_bed',$rowarr['min_adults_without_extra_bed']);   
        }
        if($rowarr['max_adults_without_extra_bed']!='')
        {
           $this->db->where('max_adults_without_extra_bed',$rowarr['max_adults_without_extra_bed']);   
        }
        if($rowarr['min_child_without_extra_bed']!='')
        {
           $this->db->where('min_child_without_extra_bed',$rowarr['min_child_without_extra_bed']);   
        }
        if($rowarr['max_child_without_extra_bed']!='')
        {
           $this->db->where('max_child_without_extra_bed',$rowarr['max_child_without_extra_bed']);   
        }
        if($rowarr['extra_bed_for_adults']!='')
        {
           $this->db->where('extra_bed_for_adults',$rowarr['extra_bed_for_adults']);   
        }
        if($rowarr['extra_bed_for_child']!='')
        {
           $this->db->where('extra_bed_for_child',$rowarr['extra_bed_for_child']);   
        } 
        if($rowarr['prior_day_type']!='')
        {
           $this->db->where('prior_day_type',$rowarr['prior_day_type']);   
        } 
        if($rowarr['prior_checkin']!='')
        {
           $this->db->where('prior_checkin',$rowarr['prior_checkin']);   
        }  

        if($rowarr['prior_checkin_date']!='')
        {
           $this->db->where('prior_checkin_date',$rowarr['prior_checkin_date']);   
        } 

        if($rowarr['period_from_date']!='')
        {
           $this->db->where('period_from_date',$rowarr['period_from_date']);
        } 

        if($rowarr['period_to_date']!='')
        {
            $this->db->where('period_to_date',$rowarr['period_to_date']);   
        }
        if($rowarr['min_no_of_stay_day']!='')
        {
           $this->db->where('min_no_of_stay_day',$rowarr['min_no_of_stay_day']);   
        } 

        if($rowarr['max_no_of_stay_day']!='')
        {
           $this->db->where('max_no_of_stay_day',$rowarr['max_no_of_stay_day']);   
        } 
               

          
        $this->db->delete($this->_table_name); 
         
    }

     public function get_roomallotment_by_date($room_id,$hotel_code,$startdate, $enddate,$contract_id,$room_allotment_type='',$specialoffer_id='') {
        $this->db->select('*');
        $this->db->from('sup_specialoffer_hotel_room_rates');
        $this->db->where('sup_room_details_id', $room_id);
        $this->db->where('hotel_code', $hotel_code);
        if($room_allotment_type!='')
        {
        $this->db->where('room_allotment_type', $room_allotment_type);
        } 
        if($specialoffer_id!='')
        {
        $this->db->where('specialoffer_id', $specialoffer_id);
        }             
        $this->db->where('contract_id', $contract_id);        
        $this->db->where('room_avail_date BETWEEN "' . $startdate . '" and "' . $enddate . '"');
        $this->db->where('supplier_id',$this->session->userdata('supplier_id'));
        $query = $this->db->get();
        // echo $this->db->last_query($query); exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


     function delete_room_rates_type($rowarr)
    {
       $this->db->where('supplier_id',$rowarr['supplier_id']);
       $this->db->where('sup_hotel_id',$rowarr['sup_hotel_id']);   
       $this->db->where('hotel_code',$rowarr['hotel_code']);   
       $this->db->where('room_code',$rowarr['room_code']);   
       $this->db->where('contract_id',$rowarr['contract_id']);   
       $this->db->where('sup_room_details_id',$rowarr['sup_room_details_id']);   
       $this->db->where('room_avail_date BETWEEN "' . $rowarr['from_date'] . '" and "' . $rowarr['to_date'] . '"');   
      $this->db->where('rate_type !=',$rowarr['rate_type']);      
      $this->db->delete($this->_table_name); 
         
    }
    
    function update_set_status($data,$id)
    {
        $this->db->where('sup_hotel_room_rates_list_id',$id);
        $this->db->update($this->_table_name,$data); 
    }

}