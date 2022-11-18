<?php

class Transportation_mode extends MY_Model {

    protected $_table_name = 'transportation_mode';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "day_count asc";

    function __construct() {
        parent :: __construct();
    }

    function get($fields=NULL,$id=NULL,$single=FALSE) {
        $query = parent::get($id, $single, $fields);
        return $query;
    }
    function get_transportation_mode($id) {
        $this->db->where('package_id', $id);
        $this->db->select('*');
        $this->db->order_by('day_count');
        $query = $this->db->get('transportation_mode');
        return $query->result();
    }

    function get_city_covering($id) {
        $this->db->where('package_id', $id);
        $this->db->select('location_from,location_to');
        $this->db->group_by('location_from');
        $this->db->group_by('location_to');
        $this->db->order_by('day_count');
        $query = $this->db->get('transportation_mode');
        return $query->result();
    }


    function add_transportation_mode($data) {
        $error = parent::insert($data);
        return $error;
    }
    function delete_transportation_mode($id) {
        $this->db->where('package_id', $id);
        $this->db->delete('transportation_mode');
        return true;
    }
    // function get_activity($fields=NULL,$id) {
    //     $this->db->where('package_id', $id);
    //     $this->db->select($fields);
    //     $query = $this->db->get('holiday_activity');
    //     return $query->result();
    // }
}


