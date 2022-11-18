<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * akbar
 * @project		akbar
 * @author		PRAVEEN
 * @copyright	Copyright (c) 2013 - 2014, PRASANNA
 * @license		http://www.travelpd.com/contactus.html
 * @link		http://www.travelpd.com
 *
 */

class Email extends CI_Controller {

	public $from;
	public $to;
	public $subject;
	public $message;
	public $head;
	public $weburl;
	public $config;
	public $company;
	public $Phone;
	public $contact;
	public $booking;
	public $enquiry;
	public $support;
	public $admin_email;
	public $me;
  
    public function __construct() {
			parent::__construct();
			$this->head = 'Akbar Holidays';
			$this->weburl = 'www.akbarholidays.com';
			$this->company = 'Akbar Holidays';
			$this->Phone = '1800 102 3636';
			$this->admin_email = 'prasanna@travelpd.com';
			// $this->me = 'prasanna@travelpd.com, abhishek@travelpd.com, ashish@travelpd.com, support@akbarholidays.com';
			$this->me = 'ashish@travelpd.com';
			$this->contact='contact@akbarholidays.com';
			$this->booking='booking@akbarholidays.com';
			$this->enquiry='enquiry@akbarholidays.com';
			$this->support='support@akbarholidays.com';
			$this->to='incoming@akbarholidays.com';

			// $this->from = 'it@tpdtechnosoft.com';
   //       $this->config = Array(
   //          'protocol' => 'telnet',
   //          'smtp_host' => 'mail.tpdtechnosoft.com',
   //          'smtp_port' => '25',
   //          'smtp_user' => 'it@tpdtechnosoft.com',
   //          'smtp_pass' => 'travelpd@2015',
   //          'mailtype' => 'html',
   //          'starttls' => true,
   //          'newline' => "\r\n"
   //      );

			$this->from = 'booking@akbarholidays.com';	   
         $this->config = Array(
            'protocol' => 'telnet',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => '587',
            'smtp_user' => 'information@akbarholidays.com',
            'smtp_pass' => 'bookings@tpd',
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

  
 public function voucher_email($data) {          
        $subject = $data['subject'];
        $msgbody='<p>Hi '.$data['user_name'].',</p><br/><p>Admin has assign this booking to you. Please proceed further.</p><br/>';
        $this->send($data['assigntoemail'], $subject, $msgbody.$data['voucher']);
        $this->send($this->booking, $subject, $msgbody.$data['voucher']);
		$this->send($this->me, $data['subject'], $msgbody.$data['voucher']);
    $this->send('ashish@travelpd.com', $data['subject'], $msgbody.$data['voucher']);
		return true;
    }
  
}

/* End of file Home.php */
/* Location: ./application/modules/Home.php */