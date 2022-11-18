<?php

class Hp_city_list extends MY_Model {

    protected $_table_name = 'hp_city_list';
    protected $_primary_key = 'city_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "city_name asc";

    function __construct() {
        parent :: __construct();
    }

  function get($fields=NULL, $id=NULL, $signal=FALSE) {
        $query = parent::get($id, $signal,$fields);
        return $query;
    }

    public function get_hotel_city_list($search) {
      $where = "city_name LIKE '%".$search."%'";
      // $where = "city_name LIKE '%" . $search . "%' OR country_name LIKE '%" . $search . "%'";
      $this->db->select('*');
      $this->db->from('hp_city_list');
      $this->db->where($where);
      $this->db->where('status',1);
      $this->db->order_by('city_name');
      $this->db->limit(20);
      $query = $this->db->get();
      // echo $this->db->last_query();exit;
      if($query->num_rows() =='') {
        return '';
      } else {
        return $query->result_array();
      }
    }
                     
}