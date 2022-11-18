<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Glogin_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
      public function insert_login_activity() {        
        $user_no = $this->session->userdata('user_no');
        $session_id = $this->session->session_id;
        $ip_address = $this->input->ip_address();     
        $remote_ip = $_SERVER['REMOTE_ADDR'];

        $data = array('session_id' => $session_id,
            'user_no' => $user_no,
            'ip_address' => $ip_address,
            'remote_ip' => $remote_ip,            
        );
       $this->db->insert('user_login_history', $data);
      }

      public function addb2cuser($data)
      {
      	  $this->db->set('created_at', 'NOW()', FALSE);
          $this->db->insert('user_info', $data);
          $id = $this->db->insert_id();
          if (!empty($id)) {
            $user_no = 'GT'.rand(0000,1111).'U'.date('ymd');
            $data1 = array('user_no' => $user_no);
            $this->db->where('id', $id);
            $this->db->update('user_info', $data1);
            return $user_no;
      }
      else
      {
        return '';
      }
   
 	 }
  public function validateuser($email)
  {
  	 $this->db->select('*')
                ->from('user_info')
                ->where('user_email', $email)
                ->where('status', 1)
                ->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        else
            return '';          
  }

   public function getUserInfo($user_no) 
   {
          $this->db->select('*');
          $this->db->from('user_info');
          $this->db->where('user_no', $user_no);
          $this->db->limit(1);
          $query = $this->db->get();

          if ($query->num_rows() > 0) {
              return $query->row();
          }

          return array();
   }

}
