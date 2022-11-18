<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pnr extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
	  $this->load->database(); 	  
	  $this->load->model('B2b_Model');
	  $this->load->model('B2c_Model');	  
	  $this->load->model('Home_Model');
	  $this->load->model('Email_Model');
	  	     $this->load->library('admin_auth');
	  $this->is_admin_logged_in();   		
	  
    }
	
	private function is_admin_logged_in()
	{		
		if(!$this->session->userdata('admin_logged_in'))
	   	{
		   redirect('login/index');
       	}		
		
    }
	public function pnr_confirm(){
		
		$this->load->view('pnr/pnr_confirm');
		
	}
	public function pnr_cancel(){
		
		$this->load->view('pnr/pnr_cancel');
		
	}
}
?>	