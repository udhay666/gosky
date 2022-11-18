<?php

class Sup_excursions extends MY_Model {

    protected $_table_name = 'sup_excursions';
    protected $_primary_key = 'excursion_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "excursion_name asc";
    const CODE_START = '0000100000';

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

    public function special_upload_images($insert_id,$unique_id_column,$foreign_id_column,$table_name,$column_name,$upload_type,$file_name,$supplier_id,$excursion_code){
        $data = array(
            $foreign_id_column => $insert_id,
            'supplier_id' => $supplier_id,
            $column_name => $file_name,
            'image_type' => $upload_type,
            'excursion_code'=>$excursion_code,
            'status' => 1,
        );
        // $this->db->where($unique_id_column, $insert_id);
        // $this->db->update($table_name, $data);
        $this->db->insert($table_name, $data);
        return true;
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

    public function get_gallery_images($foreign_id,$table_name,$column_name,$foreign_id_column){
        $this->db->where($foreign_id_column, $foreign_id);
        $this->db->select($column_name);
        $this->db->from($table_name);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function delete_exerc_images($img_id){
        $this->db->where('sup_excursion_id',$img_id);
        $this->db->delete('sup_excursion_images');
        return true;
    }

      public function get_last_excursion_code() {
        $this->db->select('excursion_code');
        $this->db->from($this->_table_name);
        $this->db->limit(1);
        $this->db->order_by('excursion_code', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->excursion_code;
        } else {
            return self::CODE_START;
        }
    }


}