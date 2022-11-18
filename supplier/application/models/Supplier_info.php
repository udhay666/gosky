<?php

class supplier_info extends MY_Model {

    protected $_table_name = 'supplier_info';
    protected $_primary_key = ' supplier_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "supplier_id asc";

    function __construct() {
        parent :: __construct();
    }

    function get($id=NULL, $signal=TRUE, $fields=NULL) { //echo 3;exit;
        $query = parent::get($id, $signal, $fields);
        return $query;
    }
   function update($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }
    public function get_all_holi_citylist() {
       
        $this->db->select('*');
        $this->db->from('holi_city');
        $this->db->join('holi_country', 'holi_country.country_id= holi_city.country_id');
        $this->db->where('holi_city.status',1);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows()>0) 
            return $query->result();
         else         
            return '';      
        
    }
     public function add_activity($data)
        {
               $query =  $this->db->insert('holiday_activity', $data);
               //echo $this->db->last_query();

                return true;   
        }

    public function upload_images($id,$img,$img_type){
        
        $data=array(
            'activity_list_id'=>$id,
            'activity_images'=>$img,
            'img_type'=>$img_type
        );
        $this->db->insert('activity_images',$data);
        //echo $this->db->last_query();
        return true;
    }

     public function upload_trending_img($id,$img_path){   
     //print_r($img_path);   
         $data = array(
            'trending_img' => $img_path,          
            );
        $this->db->where('holiday_id',$id);
        $query = $this->db->update('holiday_activity', $data);
        //
       return true;
    }

    function get_activitylist()
    {
        $this->db->select('*');
        $this->db->from('holiday_activity');      

        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows()>0) 
        return $query->result();
        else         
        return '';  
            
    }

    function set_status($data, $id = NULL) {
   
        $holi_data=array(
            'holiday_id'=>$id,
            'status'=>$data['status']
        );
        $this->db->update('holiday_activity',$holi_data);
        //echo $this->db->last_query();exit;
         return true;
       /* parent::update($data, $id);
        return $id;*/
    }


}
