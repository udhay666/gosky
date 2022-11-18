<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_Model extends CI_Model {
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function get_cms($type)
	{
		$query = $this->db->select('*')->from('cms')->where('type', $type)->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
}