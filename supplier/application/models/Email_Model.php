<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_Model extends CI_Model {

    private $client_name;
    private $from_email;
    private $web_link;
    private $admin_email;
    private $config;

    public function __construct() {
        parent::__construct();
		 $this->client_name = 'Travellersneeds';
       // $this->from_email = 'it@travelpd.com';
	   $this->from_email = 'support@travellersneeds.com';
	   
        $this->web_link = 'www.travellersneeds.com';
        $this->admin_email = 'info@travelpd.com';
        $this->from = 'support@travellersneeds.com';
        $this->ashok = 'ashok@travelpd.com';
     

		$this->footer='Warm Regards,<br>
 		Travellersneeds Team';
		$this->special_msg='<br><br>This message is for the designated recipient only and may contain privileged, proprietary, or otherwise private information. If you have received it in error,<br> please notify the sender immediately and delete the original. Any other use of the email by you is prohibited';       
	  
       
        $this->supportemail = 'support@travellersneeds.com';
        $this->phone = '+0096-09672590';
        $this->phone1='+00974-66965444';
        $this->me = 'ashok@travelpd.com';
	  
	  	$this->head = 'Travellersneeds';
        $this->weburl = 'www.Travellersneeds.com';
	    $this->config = Array(
            'protocol' => 'telnet',
            'smtp_host' => 'mail.tpdtechnosoft.com',
            'smtp_port' => '25',
            'smtp_user' => 'it@tpdtechnosoft.com',
            'smtp_pass' => 'travelpd@2015',
            'mailtype' => 'html',
            'starttls' => true,
            'newline' => "\r\n"
        );
	    }

    public function send($to, $subject, $message) {
        //$this->load->library('email');
        $this->load->library('email', $this->config);
        $this->email->initialize($this->config);
        $this->email->from($this->from_email, $this->client_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
        //echo $this->email->print_debugger();
        //exit();
    }

    public function admin_conformation($data) {
            // echo '<pre>11';print_r($data);exit;
        $msgbody = 'Dear Admin,
					<br />
					<div align="center" style="color:#F90;">' . $data['module'] . '  has ' . $data['action'] . ' with our service</div>
					<br />
						supplier_name : ' . $data['supplier_name'] . '<br />
					<br />
					<table width="500" border="1" cellpadding="5" cellspacing="5" align="center">
					  <tr>
						<th>hotel_name</th>
						<th>hotel_city</th>
						<th>Date</th>
					  </tr>
					  <tr>
						<td>' . ucfirst($data['hotel_name']) . '</td>
						<td>' . $data['hotel_city'] . '</td>
						<td>' . date("d/m/Y") . '</td>
					  </tr>
					</table>';
        $msgbody.='Thanking You,<br>
		Travellersneeds Team<br><br>';
 
 
		$subject = '"' . $data['module'] . '" ' . $data['action'] . ' Intimation';
		$this->send('info@travellersneeds.com', $subject, $msgbody);
		// $this->send('ashok@travelpd.com', $subject, $msgbody);
    }

    public function email_testing() {
        //echo 'testing';exit;
        echo $msgbody = $this->footer;
        $subject = 'going';
        $this->send('ashok@travelpd.com', $subject, $msgbody);
        // $this->send($this->me, $subject, $msgbody); 
        echo $this->email->print_debugger();
    }

}
