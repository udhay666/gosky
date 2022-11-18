<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload_Model extends CI_Model {

    public function __construct() {
      parent::__construct();
    }

    public function upload_images($id,$unique_id,$table_name,$column_name,$upload_type,$file_name,$day_count=NULL){
        if($upload_type == 'update'){
            $data=array(
                $column_name => $file_name,
            );
            $this->db->where($unique_id, $id);
            $this->db->update($table_name, $data);
            return true;
        } else if($upload_type == 'edit' || $upload_type == 'insert') {
            if(!empty($day_count)){
                $data=array(
                    $unique_id => $id,
                    $column_name => $file_name,
                    'day_count' => $day_count,
                );
            } else{
                $data=array(
                    $unique_id => $id,
                    $column_name => $file_name
                );
            }
            $this->db->insert($table_name, $data);
            return true;
        } else {
            $data = array(
                $unique_id => $id,
                $column_name => $file_name,
            );
            $this->db->insert($table_name, $data);
            return true;
        }
    }
    public function special_upload_images($id,$unique_id,$table_name,$column_name,$upload_type,$file_name){
        $data = array(
            $column_name => $file_name,
        );
        $this->db->where($unique_id, $id);
        $this->db->update($table_name, $data);
        return true;
    }
    public function delete_first($id,$unique_id,$table_name,$day_count=NULL){
        $this->db->where($unique_id, $id);
        if(!empty($day_count)){
            $this->db->where('day_count',$day_count);
        }
        $this->db->delete($table_name);
        return true;
    }

    public function get_images($id,$table_name,$column_name){
        $this->db->where('package_id', $id);
        $this->db->select($column_name);
        $this->db->from($table_name);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

      public function get_supplier_hotel_images($id,$table_name,$column_name){
        $this->db->where('supplier_hotel_list_id', $id);
        $this->db->select($column_name);
        $this->db->from($table_name);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function delete_images($img_id,$table_name){
        $this->db->where('id', $img_id);
        $this->db->delete($table_name);
        return true;
    }
    function delete_count_images($id,$day_count,$table_name) {
        $this->db->where('package_id', $id);
        $this->db->where('day_count >', $day_count);
        $this->db->delete($table_name);
        return true;
    }


     public function supplier_room_images($id,$table_name,$column_name){
        $this->db->where('supplier_room_list_id', $id);
        $this->db->select($column_name);
        $this->db->from($table_name);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
  
    
}

