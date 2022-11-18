<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promotion_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function create_promotion($promo_name, $promo_url, $promo_description, $promo_type ) {

        $data = array(
            'promo_name' => $promo_name,
            'promo_url' => $promo_url,
			'promo_description' => $promo_description,
			'promo_type' => $promo_type,
        );

        $this->db->insert('promotion', $data);
        return $this->db->insert_id();
    }

    public function update_promo_img($id, $source_image) {

        $data = array(
            'promo_img' => $source_image,
        );

        $this->db->where('id', $id);
        $this->db->update('promotion', $data);
    }

    public function get_promo_list() {
        $this->db->select('*')
                ->from('promotion');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_promo_listid($id) {
        $this->db->select('*')
                ->from('promotion')->where('id', $id);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }

        return false;
    }

    public function get_promo_info_by_id($id) {
        $this->db->select('*')
                ->from('promotion')
                ->where('id', $id);

        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }
        echo $id;

        return false;
    }

    public function update_promo($id, $promo_name, $promo_img) {
        $data = array(
            'promo_name' => $promo_name,
            'promo_url' => $promo_url,
        );


        $this->db->where('id', $id);
        $this->db->update('promotion', $data);

        return true;
    }

    public function update_image($id, $promo_name, $promo_url, $promo_img) {
        $data = array(
            'promo_name' => $promo_name,
            'promo_url' => $promo_url,
        );

        $this->db->where('id', $id);
        $this->db->update('promotion', $data);

        return true;
    }

    function delete_promo_id($id) {
        $this->db->where('id', $id);
        $this->db->delete('promotion');
    }

    function get_image($id) {

        $this->db->select('*');
        $this->db->from('promotion');
        $this->db->where('id', $id);
        //$this->db->where('img_type',1);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $im = $query->row();
            $url = base_url() . 'admin/' . $im->promo_images;
        } else {
            $url = base_url() . 'public/img/noimage.jpg';
        }
        return $url;
    }
	
	 function add_offers($about_offers, $terms_conditions, $service_type) {

       $data = array(
			'about_offers' => $about_offers,
			'terms_conditions' => $terms_conditions,
			'service_type' => $service_type,
		);

        $this->db->insert('about_offers', $data);
        return true;
    }
	
	  function get_offer_list() {
        $this->db->select('*')
                ->from(' about_offers');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }
	
	public function get_offer_list_id($id) {
        $this->db->select('*')
                ->from('about_offers')->where('id', $id);
				
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }

        return false;
    }
	
	public function get_offer_listid($id) {
        $this->db->select('*')
                ->from('about_offers')->where('id', $id);
				 $data = array(
			'about_offers' => $about_offers,
			'terms_conditions' => $terms_conditions,
			'service_type' => $service_type,
		);
		$this->db->update('about_offers', $data);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }

        return false;
    }
	
	 public function get_offer_info_by_id($id) {
        $this->db->select('*')
                ->from('about_offers')
                ->where('id', $id);

        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }
        //echo $id;

        return false;
    }
	
	 function delete_offer_id($id) {
        $this->db->where('id', $id);
        $this->db->delete('about_offers');
    }

}