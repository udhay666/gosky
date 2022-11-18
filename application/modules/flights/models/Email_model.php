<?php
	
//	error_reporting(E_ALL);
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Email_Model extends CI_Model {
		
		private $from;
		private $to;
		private $subject;
		private $message;
		private $head;
		private $weburl;
		private $config;
		private $prasanna, $basanth;
		private $footer;
		
		public function __construct() {
			parent::__construct();
			$this->prasanna = 'info@bizzholidays.com';
			$this->basanth = 'info@bizzholidays.com';
			$this->query='';
			$this->footer='';
			$this->special_msg='';       
			$this->head = 'BizzHolidays';
			$this->weburl = 'www.bizzholidays.com';
		
		
			// $this->from = 'it@tpdtechnosoft.com';
			$this->from = 'bookings@bizzholidays.com';
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
			$this->load->library('email', $this->config);
			//$this->load->library('email');
			$this->email->initialize($this->config);
			$this->email->from($this->from, $this->head);
			$this->email->to($to);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send();
			//echo $this->email->print_debugger();
			//exit();
		}

		
		
	
		

		

	public function ticketing_mail($data, $voucher_content) {
		//print_r($data); exit;
		// $msgbody = '<div>Dear '.$data['name'].',<br/>
		// 			<p>Please kindly review your voucher.</p></div><br/><br/>';
		$msgbody .= '<br>'.$voucher_content; 
		//print $data['user_email'] ;print $msgbody; exit;
		
		$subject = 'Thank You for Booking With Us!';
		// echo $msgbody;exit;
		$email = $data['user_email'];
		/*print $email;
		print $subject;
		print $msgbody; exit;*/
		$this->send($email,$subject,$msgbody);
		//$this->send('shijisaraswathy@gmail.com', 'TravelTank: Please HOTEL Subscription1', 'HOTEL1');
		sleep(2);
		//$this->send('bookings@traveltank.com',$subject,$msgbody);
		//$this->send('bookings@traveltank.com',$subject,$msgbody);
		$this->send('shiji@travelpd.com', 'BizzHolidays: Please Flight Subscription2', 'Flight');
		// $this->send('shijisaraswathy@gmail.com',$subject,$msgbody);

		// sleep(2);
		// $this->send('akgupta.nit@gmail.com',$subject,$msgbody);
	}

	public function send_email($to, $subject, $message_body) {
	
		$this->send($to,$subject,$message_body);
		sleep(2);
		//$this->send('info@traveltank.com',$subject,$msgbody);
		 $this->send('ann@travelpd.com',$subject,$message_body);

		// sleep(2);
		// $this->send('akgupta.nit@gmail.com',$subject,$msgbody);
	}





}	