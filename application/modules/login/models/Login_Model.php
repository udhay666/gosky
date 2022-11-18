<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {

    public function getlogindata($username, $password)
	{
		$this->db->select('*');
		$this->db->where('agent_email', $username);
		$this->db->where('agent_password', md5($password));
		$query = $this->db->get('agent_info');
		if($query->num_rows() == 1)
		{
			return TRUE;
		}else
		{
			return FALSE;
		}
	}
	
public function getagent_no($username, $password)
	{
		$this->db->select('*');
		$this->db->where('agent_email', $username);
		$this->db->where('agent_password', md5($password));
		$query = $this->db->get('agent_info');
		if($query==true){
		return $query->row();    
		}else{
		    return false;
		}
		
	}
	
	public function getAgentinfo($email){
	    $this->db->select('*');
		$this->db->where('agent_email', $email);
		$query = $this->db->get('agent_info');
		if($query==true){
		return $query->row_array();    
		}else{
		    return false;
		}
	}
	
	public function forgot_password_addtoken($postdata){
	    $email = $postdata['email'];
	    $token = $postdata['token'];
	    
	    $this->db->where('agent_email', $email);
	    $this->db->set('token', $token);
	    $query = $this->db->update('agent_info');
	    if($query == true){
	        return true;    
	    }else{
	        return false;
	    }
	    
	}
	
	public function check_pwdchange_email($data){
	    $email = $data['email'];
	    $token = $data['token'];
	    $this->db->where('agent_email',$email);
	    $this->db->where('token',$token);
	    $query = $this->db->get('agent_info');
	    if($query->num_rows() == 1){
	        return true;
	    }else{
	        return false;
	    }
	}
	
	public function update_pwd($data){
	    $token = $data['token'];
	    $password = $data['agent_password'];
	    $email = $data['email'];
	    $this->db->where('token', $token);
	    $this->db->where('agent_email', $email);
	    $this->db->set('agent_password', $password);
	    $query = $this->db->update('agent_info');
	    if($query==TRUE){
	        return true;
	    }else{
	      return false;  
	    }
	}


	public function reg($user)
	{
		$this->db->insert('register',$user);
	}

}

/* End of file Home_Model.php */


?>