<?php

class Holiday_packages extends MY_Model {

    protected $_table_name = 'holiday_packages';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "id desc";

    function __construct() {
        parent :: __construct();
    }

    function insert_holiday_packages($data) {
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
    function get_active_supplier($fields=NULL,$supplier_id) {
        $column = 'status';
        $query = parent::get_active_supplier($column, 1,$fields,$supplier_id);
        return $query;
    }
    function set_status($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    function check_unique($fields, $id) {
        $query = parent::get_unique($id,$fields);
        return $query;
    } 

    function city_list($fields=NULL){
        $this->db->select('holiday_city.*,holiday_country.*');
        $this->db->from('holiday_city');
        $this->db->join('holiday_country','holiday_city.country_id = holiday_country.country_id');
        $this->db->where('status',1);
        $query = $this->db->get();
        if($query->num_rows() >0){
            return $query->result();
        } else {
            return '';
        }
    } 

    public function deleteHolidaypackage($id) {
        $this->db->where('id',$id);
        $this->db->delete('holiday_packages');
    }
    public function deleteHolidayactivity($id) {
        $this->db->where('package_id',$id);
        $this->db->delete('holiday_activity');
    }
    public function deleteHolidaymeeting($id) {
        $this->db->where('holiday_id',$id);
        $this->db->delete('meeting_points');
    }

}


