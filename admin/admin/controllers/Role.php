<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
	  $this->load->database(); 
	  $this->load->model('Role_Model');
	  $this->load->model('Home_Model');
	  $this->load->model('Email_Model');
	  $this->load->library('Admin_auth');
	  
	  $this->is_admin_logged_in();   	
	  
    }
	
	private function is_admin_logged_in()
	{		
		if(!$this->session->userdata('admin_logged_in'))
	   	{
		   redirect('login/index');
       	}		
		
    }
		
	public function index()
	{
		redirect('home/dashboard');
			
	}
	
	// Add New Admin User	
	function add_admin_user()
	{		
		$this->form_validation->set_rules('admin_email', 'Email', 'trim|required|valid_email|is_unique[admin_info.login_email]|xss_clean');
		$this->form_validation->set_rules('admin_password', 'Password', 'trim|required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
		$this->form_validation->set_rules('role_id', 'Admin User Level', 'required');
		
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
	
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('country', 'Country', 'required');
		
		$data['status']='';
		$data['errors']='';
		$data['country_list'] = $this->Home_Model->get_country_list(); 		
		$data['admin_priviliges']=$this->Role_Model->get_admin_privilages();

		if($this->form_validation->run()==FALSE)
		{			
			$data['admin_email'] = $this->input->post('admin_email');		   
		   	$data['first_name'] = $this->input->post('first_name');
			$data['middle_name'] = $this->input->post('middle_name');
		   	$data['last_name'] = $this->input->post('last_name');
		   	$data['mobile_no'] = $this->input->post('mobile_no');		
		   	$data['address'] = $this->input->post('address');
		   	$data['pin_code'] = $this->input->post('pin_code');		   
		   	$data['city'] = $this->input->post('city');
		   	$data['state'] = $this->input->post('state');
			$privilages=$this->input->post('privilages');
			$subprivilages=$this->input->post('subprivilages');

			$this->load->view('role/add_admin_user',$data);
		}
		else
		{
			//echo '<pre/>';print_r($_POST);exit;			
			$admin_email = $this->input->post('admin_email');
			$admin_password = md5($this->input->post('admin_password'));
		   	$role_id = $this->input->post('role_id');
			
			$title = $this->input->post('title');
		   	$first_name = $this->input->post('first_name');
			$middle_name = $this->input->post('middle_name');
		   	$last_name = $this->input->post('last_name');
		   	$mobile_no = $this->input->post('mobile_no');		  
		   	$address = $this->input->post('address');
		   	$pin_code = $this->input->post('pin_code');		   
		   	$city = $this->input->post('city');
		   	$state = $this->input->post('state');
			$country = $this->input->post('country');
			$privilages=$this->input->post('privilages');
			$subprivilages=$this->input->post('subprivilages');
            
			$email_check = $this->Role_Model->check_email_availability($admin_email);
				
			if($email_check != '' || !empty($email_check))
			{				
				$data['errors'] = 'Email Already Exists. Please use different email id to continue ...';
				$this->load->view('role/add_admin_user',$data);
			}
			else
			{
				if($inert_id=$this->Role_Model->add_admin_user($admin_email,$admin_password,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$role_id))
				{
					$email_data = array(
                        'agent_email' => $admin_email,
                        'title' => $title,
                        'first_name' => $first_name,
                        'password' => $this->input->post('admin_password')
                    );
                    $this->Email_Model->registration_conformation($email_data);

                    foreach($privilages as $val){
                        $this->Role_Model->add_subadmin_privilege($inert_id,$val);
                    }

                     foreach($subprivilages as $value){
                        $this->Role_Model->add_subadmin_submodule_privilege($inert_id,$value);
                    }

					redirect('role/admin_user_manager','refresh');
				}
				else
				{
					$data['errors'] = 'Admin User Registration Not Done. Please try after some time...';
					$this->load->view('role/add_admin_user',$data);
				
				}
			}
		}
	}
	
	public function admin_user_manager()
	{
		$data['admin_user_info'] = $this->Role_Model->get_admin_user_info(); 
		//echo '<pre/>';print_r($data['admin_user_info']);exit;	
		$this->load->view('role/admin_user_manager',$data);
	}
	
	public function view_admin_info($admin_id='',$status='',$errors='')
	{
		$data['status']= $status;
		$data['errors']= $errors;
		$data['country_list'] = $this->Home_Model->get_country_list(); 
		
		$data['admin_id']= $admin_id;
		$data['admin_priviliges']=$this->Role_Model->get_admin_privilages();
        $data['get_admin_priviliges']=$this->Role_Model->fetch_admin_privilages($admin_id);
		$data['admin_info'] = $this->Role_Model->get_admin_info_by_id($admin_id); 
		//echo '<pre/>';print_r($data['admin_info']);exit;	
		$this->load->view('role/view_admin_info',$data);
	}
	
	public function update_admin_info()
	{		
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');	
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('country', 'Country', 'required');
		
		
		$data['status']='';
		$data['errors']='';
		$data['country_list'] = $this->Home_Model->get_country_list(); 
			
		$data['admin_id'] = $admin_id = $this->input->post('admin_id');
		$data['admin_info'] = $this->Role_Model->get_admin_info_by_id($admin_id); 
		
		if($this->form_validation->run()==FALSE)
		{			
			$this->load->view('role/view_admin_info',$data);
		}
		else
		{
			// echo '<pre/>';print_r($_POST);exit;			
			$admin_id = $this->input->post('admin_id');			
			$title = $this->input->post('title');
		   	$first_name = $this->input->post('first_name');
			$middle_name = $this->input->post('middle_name');
		   	$last_name = $this->input->post('last_name');
		   	$mobile_no = $this->input->post('mobile_no');		  
		   	$address = $this->input->post('address');
		   	$pin_code = $this->input->post('pin_code');		   
		   	$city = $this->input->post('city');
		   	$state = $this->input->post('state');
			$country = $this->input->post('country');
			
			$admin_email = $this->input->post('admin_email');
			$privilages=$this->input->post('privilages');
			$subprivilages=$this->input->post('subprivilages');

			if($this->Role_Model->update_sub_admin($admin_id,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country))
			{
				$this->Role_Model->delete_subadmin_privilege($admin_id);
		        foreach($privilages as $val){
		        	$this->Role_Model->add_subadmin_privilege($admin_id,$val);
		        }
		        $this->Role_Model->delete_subadmin_submodule_privilege($admin_id);

		        foreach($subprivilages as $value){
		        	$this->Role_Model->add_subadmin_submodule_privilege($admin_id,$value);
		        }
				redirect('role/view_admin_info/'.$admin_id.'/1','refresh');
			}
			else
			{
				$data['errors'] = 'Sub Admin Profile Not Updated. Please try after some time...';
				$this->load->view('role/view_admin_info',$data);
			
			}
			
		}
	}
	
	function change_admin_password($admin_id='')
	{
		$this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
		
		$data['status']='';
		$data['errors']='';
		
		$data['admin_id']=$admin_id;
		$data['admin_info'] = $admin_info = $this->Role_Model->get_admin_info_by_id($admin_id); 
		
		if($this->form_validation->run() == FALSE)
		{			
			$this->load->view('role/change_admin_password', $data);
		}
		else
		{			
			if($this->input->post('password') == $this->input->post('passconf'))
			{			
			   $password = md5($this->input->post('password'));			   
			   if($this->Role_Model->update_admin_password($admin_id,$password)) 
			   {				   
				   $data['status']=1;
			   }
			   else
			   {				 
				   $data['errors']='Sub Admin Password not Updated. Please try after some time...';
			   }
			}
			else
			{
			   $data['errors']='Current Password is wrong. Please enter correct current password...';				
			}
			
			$this->load->view('role/change_admin_password', $data);
		}		
				
	}
   
	
	function manage_admin_user_status()
	{
		if(isset($_POST['admin_id']) && isset($_POST['status']))
		{
			$admin_id = $_POST['admin_id'];
			$status = $_POST['status'];		
			$update = $this->Role_Model->manage_admin_user_status($admin_id,$status);

			$data['admin_info'] = $admin_info = $this->Role_Model->get_admin_info_by_id($admin_id);
            if ($status == 1) {
                $stat_msg = 'Activated';
            } elseif ($status == 0) {
                $stat_msg = 'De-activated';
            } else {
                $stat_msg = 'Blocked/Deleted';
            }
            $info = array(
                'admin_no' => $admin_info->admin_no,
                //'agency_name' => $admin_info->agency_name,
                'email' => $admin_info->login_email,
                'status' => $stat_msg
            );
			//echo '<pre>';print_r($info);exit;
            $this->Email_Model->status_email_agent($info);

			echo $update;
		}
		else
		{
			return false;
		}		
					
	}
        function add_sub_admin()
	{		
		$this->form_validation->set_rules('admin_email', 'Email', 'trim|required|valid_email|is_unique[admin_info.login_email]|xss_clean');
		$this->form_validation->set_rules('admin_password', 'Password', 'trim|required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
		$this->form_validation->set_rules('role_id', 'Admin User Level', 'required');
		
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
	
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('country', 'Country', 'required');
		
		$data['status']='';
		$data['errors']='';
		$data['country_list'] = $this->Home_Model->get_country_list(); 		
		   $data['admin_models'] = $this->Role_Model->get_admin_modules();
		 // echo "<pre/>"; print_r($data['admin_models']);exit;
		if($this->form_validation->run()==FALSE)
		{			
			$data['admin_email'] = $this->input->post('admin_email');		   
		   	$data['first_name'] = $this->input->post('first_name');
			$data['middle_name'] = $this->input->post('middle_name');
		   	$data['last_name'] = $this->input->post('last_name');
		   	$data['mobile_no'] = $this->input->post('mobile_no');		
		   	$data['address'] = $this->input->post('address');
		   	$data['pin_code'] = $this->input->post('pin_code');		   
		   	$data['city'] = $this->input->post('city');
		   	$data['state'] = $this->input->post('state');
			
			$this->load->view('sub_admin/add_sub_admin',$data);
		}
		else
		{
		//echo '<pre/>';print_r($_POST);exit;			
			$admin_email = $this->input->post('admin_email');
			$admin_password = md5($this->input->post('admin_password'));
		   	$role_id = $this->input->post('role_id');
			
			$title = $this->input->post('title');
		   	$first_name = $this->input->post('first_name');
			$middle_name = $this->input->post('middle_name');
		   	$last_name = $this->input->post('last_name');
		   	$mobile_no = $this->input->post('mobile_no');		  
		   	$address = $this->input->post('address');
		   	$pin_code = $this->input->post('pin_code');		   
		   	$city = $this->input->post('city');
		   	$state = $this->input->post('state');
			$country = $this->input->post('country');
						 $adminperm = $this->input->post('admin');
			$email_check = $this->Role_Model->check_email_availability($admin_email);
				
			if($email_check != '' || !empty($email_check))
			{				
				$data['errors'] = 'Email Already Exists. Please use different email id to continue ...';
				$this->load->view('sub_admin/add_sub_admin',$data);
			}
			else
			{
				if($this->Role_Model->add_sub_admin($admin_email,$admin_password,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$role_id,$adminperm))
				{
					$email_data = array(
                        'agent_email' => $admin_email,
                        'title' => $title,
                        'first_name' => $first_name,
                        'password' => $this->input->post('admin_password')
                    );
                    $this->Email_Model->registration_conformation($email_data);
					redirect('role/sub_admin_manager','refresh');
				}
				else
				{
					$data['errors'] = 'Admin User Registration Not Done. Please try after some time...';
					$this->load->view('sub_admin/add_sub_admin',$data);
				
				}
			}
		}
	}
        public function sub_admin_manager()
	{
		$data['admin_user_info'] = $this->Role_Model->get_admin_user_info(); 
		//echo '<pre/>';print_r($data['admin_user_info']);exit;	
		$this->load->view('sub_admin/sub_admin_manager',$data);
	}
        	public function update_sub_admin_info()
	{		
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');	
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('country', 'Country', 'required');
		
		
		$data['status']='';
		$data['errors']='';
		$data['country_list'] = $this->Home_Model->get_country_list(); 
			
		$data['admin_id'] = $admin_id = $this->input->post('admin_id');
		$data['admin_info'] = $this->Role_Model->get_admin_info_by_id($admin_id); 
		   $data['admin_models'] = $this->Role_Model->get_admin_modules();
		if($this->form_validation->run()==FALSE)
		{			
			$this->load->view('sub_admin/view_sub_admin_info',$data);
		}
		else
		{
			//echo '<pre/>';print_r($_POST);exit;
                      //$role_id = $this->input->post('role_id');
                      $role_id=2;
			$id = $this->input->post('admin_id');			
			$title = $this->input->post('title');
		   	$first_name = $this->input->post('first_name');
			$middle_name = $this->input->post('middle_name');
		   	$last_name = $this->input->post('last_name');
		   	$mobile_no = $this->input->post('mobile_no');		  
		   	$address = $this->input->post('address');
		   	$pin_code = $this->input->post('pin_code');		   
		   	$city = $this->input->post('city');
		   	$state = $this->input->post('state');
			$country = $this->input->post('country');
			
			$admin_email = $this->input->post('admin_email');
                          $adminperm = $this->input->post('admin');
						
			if($this->Role_Model->update_sub_admin($role_id,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$adminperm,$id))
			{
				redirect('role/view_sub_admin_info/'.$id,'refresh');
			}
			else
			{
				$data['errors'] = 'Sub Admin Profile Not Updated. Please try after some time...';
				$this->load->view('sub_admin/view_sub_admin_info',$data);
			
			}
			
		}
	}
        public function view_sub_admin_info($admin_id='',$status='',$errors='')
	{
		$data['status']= $status;
		$data['errors']= $errors;
		$data['country_list'] = $this->Home_Model->get_country_list(); 
		  $data['admin_models'] = $this->Role_Model->get_admin_modules();
                   $data['admin_auth'] = $this->Role_Model->get_admin_auth($admin_id);
		$data['admin_id']= $admin_id;
		$data['admin_info'] = $this->Role_Model->get_admin_info_by_id($admin_id); 
		//echo '<pre/>';print_r($data['admin_info']);exit;	
		$this->load->view('sub_admin/view_sub_admin_info',$data);
	}
        function change_sub_admin_password($admin_id='')
	{
		$this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
		
		$data['status']='';
		$data['errors']='';
		
		$data['admin_id']=$admin_id;
		$data['admin_info'] = $admin_info = $this->Role_Model->get_admin_info_by_id($admin_id); 
		
		if($this->form_validation->run() == FALSE)
		{			
			$this->load->view('sub_admin/change_admin_password', $data);
		}
		else
		{			
			if($this->input->post('password') == $this->input->post('passconf'))
			{			
			   $password = md5($this->input->post('password'));			   
			   if($this->Role_Model->update_admin_password($admin_id,$password)) 
			   {				   
				   $data['status']=1;
			   }
			   else
			   {				 
				   $data['errors']='Sub Admin Password not Updated. Please try after some time...';
			   }
			}
			else
			{
			   $data['errors']='Current Password is wrong. Please enter correct current password...';				
			}
			
			$this->load->view('sub_admin/change_admin_password', $data);
		}		
				
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */