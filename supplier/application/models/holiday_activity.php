<?php

class holiday_activity extends MY_Model {

    protected $_table_name = 'holiday_activity';
    protected $_primary_key = 'activity_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "activity_name asc";

    function __construct() {
        parent :: __construct();
    }

    function get($fields=NULL,$id=NULL,$single=FALSE) {
        $query = parent::get($id, $single, $fields);
        return $query;
    }

    function add_holiday_activity($data) {
        $error = parent::insert($data);
        return $error;
    }
    function delete_activity($id) {
        $this->db->where('package_id', $id);
        $this->db->delete('holiday_activity');
        return true;
    }
    function get_activity($fields=NULL,$id) {
        
        $this->db->select($fields);
        $this->db->from('holiday_activity');
        $this->db->where('package_id', $id);
        $this->db->order_by('activity_id','ASC');
        $query = $this->db->get();
        return $query->result();
    }
}


