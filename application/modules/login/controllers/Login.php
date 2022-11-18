<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Login extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Login_Model');
	}

	public function index()
    {
        $this->load->view('login');
    }

    public function user_login()
    {       
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('password','Password','required');

        // $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');


        if($this->form_validation->run() == FALSE)
        {
            
            $this->session->set_flashdata('error', 'Please Enter Username and Password');   
            $this->index();

        }else{
            
            $username= $this->input->post('email');
            $password= $this->input->post('password');
            $this->session->set_userdata('user',$username);
            $check = $this->Login_Model->getlogindata($username, $password);
            $agent_info = $this->Login_Model->getagent_no($username, $password);           
            
            // 
            if($check == FALSE)
            {
                $this->session->set_flashdata('error', 'Username/Password is Wrong!');
                $this->index();
            }else{
            
               
                $this->session->set_userdata('agent_no',$agent_info->agent_no);
                $this->session->set_userdata('agent_id',$agent_info->agent_id);
             // print_r($agent_info->agent_no);exit;
            redirect(base_url('Home/index2/AED'));            

            }
        }

    }
    
    public function forgot_password(){
        
        $this->load->view('forgot_password');
    }
    
    public function forget_password(){
        $email = $this->input->post('email');
        $token = md5(rand());
        $postdata = array(
            'email' => $email,
            'token'=> $token
            );
        $this->Login_Model->forgot_password_addtoken($postdata);
        // echo $this->db->last_query();exit;
        $data = $this->Login_Model->getAgentinfo($email);
        // print_r($data['token']);
        if($data == TRUE){
            $this->session->set_flashdata('forgotpwd','<div class="alert alert-success"><h5>We e-mailed you a pasword reset link</h5></div>');
            $this->send_reset_password_mail($data);
            // $this->test($data);
            $this->index();
        }else{
            $this->session->set_flashdata('forgotpwd','<div class="alert alert-danger"><h5>The account does not exist</h5></div>');
        }
        
       
         
    }
    
    public function test($data){
        // $data['token'] = $token;
        $this->load->view('mail_rest_password',$data);
        // $this->load->view('new_password');
    }
    
    
    public function send_reset_password_mail($data)
    {
        // $token = $data['token'];
        $email = $data['agent_email'];
        
        
        $config= Array(
            'protocol'  =>'telnet',
            'smtp_host' => 'mail.tpdtechnosoft.com',
            'smtp_port' => '25',
            'smtp_user'=>  'it@tpdtechnosoft.com',
            'smtp_pass' =>'travelpd@2015',
            'charset' => 'utf-8',
            'wordwrap' => 'TRUE',
            'mailtype' => 'html'
            );
            
        // $to_email = "info@travelkitb2b.com";
        // $to_email = "udayaraj@travelpd.com";
        $from_email = "noreply@travelkitb2b.com";
        // $to_email = "info@travelkitb2b.com";
        
        // $data['token']=$token;
        $message = $this->load->view('mail_rest_password',$data,TRUE);
        // "https://tpdtechnosoft.com/TPD_Projects/travelkitB2B/travelkit/Register_controller/agreement_pdf/".$id_encode;
        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->from($from_email,'Travelkitb2b');
        $this->email->to($email);
        $this->email->subject('Travelkitb2b Login Password Reset Request');
        $this->email->message($message);
        $this->email->send();
        // if($this->email->send())
        // {
        //     // $this->send_agent_reg_success_mail();
        //     $this->success_reg_page();             
            
        // }else
        // {
        //     $this->session->set_flashdata('email_send', 'Something Went Worng!');
        //     $this->index();
            
        // }
    }
    
    public function change_password($token){
        $data['token']=$token;
        $this->load->view('new_password',$data);
    }
    
    public function update_password(){
        // print_r($_POST);
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $token = $this->input->post('token');
        $postdata = array(
            'email'=>$email,
            'agent_password'=>$password,
            'token'=>$token
            );
            // echo"<pre>";print_r($postdata);exit;
        $check_email = $this->Login_Model->check_pwdchange_email($postdata);
        // echo $this->db->last_query();exit;
        if($check_email == TRUE){
            $update_pwd = $this->Login_Model->update_pwd($postdata);
            // echo $this->db->last_query();exit;
            if($update_pwd == TRUE){
            $this->session->set_flashdata('update_password_login','<div class="alert alert-success"><h5>New Password Successfully Updated!</h5></div>');
            $this->index();
            }else{
                $this->session->set_flashdata('update_password_login','<div class="alert alert-danger"><h5>Session Expired!</h5></div>');
            $this->index();
            }
        }else{
            $this->session->set_flashdata('update_password', '<div class="alert alert-danger"><h5>Email-id does not exist</h5></div>');
            $this->change_password($token);
        }
        
    }

    public function logout()
    {
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('agent_no');
        $this->session->unset_userdata('agent_id');
        $this->index();
    }


}

/* End of file Home.php */
/* Location: ./application/modules/Home.php */					