<?php

class Sup_excursion_rate extends MY_Model {

    protected $_table_name = 'sup_excursion_rate';
    protected $_primary_key = 'sup_excursion_rate_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "sup_excursion_rate_id asc";
  

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

    function delete($id) {
        $error = parent::delete($id);
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

     function get_single($id, $signal=TRUE) {
        $query = parent::get($id, $signal);
        return $query;
    }

   

    public function delete_first($insert_id,$foreign_id_column,$table_name){
        $this->db->where($foreign_id_column, $insert_id);
        $this->db->delete($table_name);
        return true;
    }
    public function delete_images($img_id,$table_name,$unique_id_column){
        $this->db->where($unique_id_column, $img_id);
        $this->db->delete($table_name);
        return true;
    }

  
  public function get_excursionrates_by_date($excursions_rate_types_id, $startdate, $enddate,$supplier_id) {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->where('excursions_rate_types_id', $excursions_rate_types_id);
        $this->db->where('excursion_avail_date BETWEEN "' . $startdate . '" and "' . $enddate . '"');
        $this->db->where('supplier_id',$supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
   function delete_excursions_rates($excursion_id, $excursions_rate_types_id,$startdate,$enddate) {    
        $this->db->where('excursion_avail_date BETWEEN "' . $startdate . '" and "' . $enddate . '"'); 
        $this->db->where('excursions_rate_types_id', $excursions_rate_types_id);
        $this->db->where('excursion_id', $excursion_id);
        $this->db->delete($this->_table_name);
    }


     public function new_cal_get_excursionrates_by_date($excursions_rate_types_id, $excursion_id, $excursion_code,$rate_code,$from_date,$to_date,$supplier_id) {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->where('excursions_rate_types_id', $excursions_rate_types_id);
        $this->db->where('excursion_id', $excursion_id);        
        $this->db->where('excursion_code', $excursion_code);      
       if($from_date){
            $this->db->where('excursion_avail_date >=', date('Y-m-d',strtotime($from_date)));
                }
                if($to_date !=''){
                $this->db->where('excursion_avail_date <=', date('Y-m-d',strtotime($to_date)));          
                }
        $this->db->where('supplier_id',$supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


public function get_excursionrates_edit($sup_excursion_rate_id, $rate_code, $excursion_code,$supplier_id,$excursions_rate_types_id){

    $this->db->select('*');
    $this->db->from($this->_table_name);
    $this->db->where('sup_excursion_rate_id',$sup_excursion_rate_id);
    $this->db->where('rate_code',$rate_code);
    $this->db->where('excursion_code',$excursion_code);
    $this->db->where('supplier_id',$supplier_id);
    $this->db->where('excursions_rate_types_id',$excursions_rate_types_id);
    $query=$this->db->get();
         if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }     
    }

public function get_excursionrates_update($sup_excursion_rate_id, $rate_code, $excursion_code,$excursions_rate_types_id,$adult_price,$child_price){
    $this->db->where('sup_excursion_rate_id',$sup_excursion_rate_id);
    $this->db->where('rate_code',$rate_code);
    $this->db->where('excursion_code',$excursion_code);
    $this->db->where('excursions_rate_types_id',$excursions_rate_types_id);
    $data=array(
    'adult_price'=>$adult_price,
    'child_price'=>$child_price,       
    );
    $this->db->update($this->_table_name,$data);
}


}