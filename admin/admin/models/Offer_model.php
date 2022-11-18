<?php

class offer_model extends CI_MODEL {

    function __construct() {
        parent :: __construct();
    }
      public function get_country() {
        $this->db->select('*');
        $this->db->from('country');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows()>0) 
            return $query->result();
         else         
            return '';      
        
    }
    function add_best_hotel($data) {
        $this->db->insert('best_hotel_images', $data);
        return $this->db->insert_id();
    }
    function add_best_offers($data) {
        $this->db->insert('best_offers_images', $data);
        return $this->db->insert_id();
    }
    function add_holiday_images($data) {
        $this->db->insert('home_holiday_images', $data);
        return $this->db->insert_id();
    }
    public function upload_images($id,$img,$img_type){
        
        $data=array(
            'hotel_id'=>$id,
            'hotel_image'=>$img,
            'image_type'=>$img_type
        );
        $this->db->insert('trending_hotel_images',$data);
        //echo $this->db->last_query();exit;
        return true;
    }
    public function upload_trending_img($id,$img_path){   
     //print_r($img_path);   
         $data = array(
            'hotel_image' => $img_path,          
            );
        $this->db->where('id',$id);
        $query = $this->db->update('best_hotel_images', $data);
        //
       return true;
    }
    
     public function upload_offers_img($id,$img_path){   
     //print_r($img_path);   
         $data = array(
            'offers_image' => $img_path,          
            );
        $this->db->where('id',$id);
        $query = $this->db->update('best_offers_images', $data);
        //
       return true;
    }
   public function upload_holiday_images($id,$img_path){   
     //print_r($img_path);   
         $data = array(
            'image_path' => $img_path,          
            );
        $this->db->where('id',$id);
        $query = $this->db->update('home_holiday_images', $data);
        //
       return true;
    }
    public function get_best_hotel() {
        $this->db->select('*');
        $this->db->from('best_hotel_images');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows()>0) 
            return $query->result();
         else         
            return '';      
        
    }
    public function get_best_offers() {
        $this->db->select('*');
        $this->db->from('best_offers_images');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows()>0) 
            return $query->result();
         else         
            return '';      
        
    }
     public function get_holiday() {
        $this->db->select('*');
        $this->db->from('home_holiday_images');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows()>0) 
            return $query->result();
         else         
            return '';      
        
    }
     public function hotel_active($hol_id,$id){
    //print_r($hol_id);print_r($id);
        $upd_pkg= array(
                'status' => $id
                );
        $this->db->where('id',$hol_id);
        $this->db->update('best_hotel_images',$upd_pkg);
    }
    public function package_active($hol_id,$id){
    //print_r($hol_id);print_r($id);
        $upd_pkg= array(
                'status' => $id
                );
        $this->db->where('id',$hol_id);
        $this->db->update('home_holiday_images',$upd_pkg);
    }
    public function get_popular_by_id($id) {
        $this->db->select('*');
        $this->db->from('destinations');
        $this->db->where('id',$id);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows()>0) 
            return $query->row();
         else         
            return '';      
        
    }
    public function update_popular($id,$data){
        $this->db->where('id',$id);
        $this->db->update('destinations',$data);
    }
     public function get_mostly_booked_id($id) {
        $this->db->select('*');
        $this->db->from('trending_hotels');
        $this->db->where('id',$id);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows()>0) 
            return $query->row();
         else         
            return '';      
        
    }
    public function update_mostly_booked($id,$data){
        $this->db->where('id',$id);
        $this->db->update('trending_hotels',$data);
    }

}