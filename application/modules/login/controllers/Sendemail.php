<?php

//	error_reporting(E_ALL);
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Sendemail extends MX_Controller {
	
	private $from;
	private $to;
	private $config;
	private $subject;
	private $message;
	private $head;
	private $weburl;
	private $prasanna, $abhishek;
	private $footer;
	private $support;
	private $admin;
	
	public function __construct() {
		parent::__construct();
	// $this->prasanna = 'prasanna@travelpd.com';
		// $this->abhishek = 'abhishek@travelpd.com';
		$this->footer = '<br><br><b>Sarvtoday Pvt. Ltd,<br>dgsd<br>ffsd, India<br>Tel: 1-234-567-890, Email: support@sarvtoday.com</b>'; 
		$this->head = 'Sarvtoday';
		// $this->support = 'support@sarvtoday.com';
		// $this->query_email = 'support@sarvtoday.com';
		// $this->admin = 'support@sarvtoday.com';
		$this->support = 'udayaraj@travelpd.com';
		$this->query_email = 'udayaraj@travelpd.com';
		$this->admin = 'udayaraj@travelpd.com';
		$this->weburl = 'https://www.sarvtoday.com';
	
	
		$this->from = 'it@tpdtechnosoft.com';
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
		// echo $this->email->print_debugger();
		// exit();
	}

	public function ticketing_mail($data) {
		$msgbody = $data['voucher_content'];
		// $subject = 'Thank You for Booking With Us!';
		$subject = $data['subject'];
		// echo $msgbody;exit;
		$this->send($data['user_email'],$subject,$msgbody);
		sleep(2);
		$this->send($this->abhishek,$data['subject'],$msgbody);
		// sleep(2);
		// $this->send('akgupta.nit@gmail.com',$subject,$msgbody);
	}

	function refund_cancelled_email($data) {
		$msgbody = '';
		$msgbody.= '
		<div>
			<div>
				<h2> Cancellation Details for ::  ' . $data['cancelof'] . ' :: ' . $this->head . '.com </h2>
				<table border="1">
					<tr>
						<td>Booking Ref</td>
						<td>' . $data['Ref_No'] . '</td>
					</tr>
					<tr>
						<td>User Name</td>
						<td>' . $data['surname'] . '</td>
					</tr>
					<tr>
						<td>Email_id</td>
						<td>' . $data['email'] . '</td>
					</tr>
					<tr>
						<td>PNR</td>
						<td>' . $data['pnr'] . '</td>
					</tr>
				</table>
			</div>
		</div>';

		$this->send($data['email'],$data['subject'],$msgbody);
		sleep(2);
		$this->send($this->support,$data['subject'],$msgbody);
		// sleep(2);
		$this->send($this->abhishek,$data['subject'],$msgbody);
	}

	public function send_enquiry($data) {
		$subject = $data["subject"];    
		$msgbody = 'Dear Admin,<br>
		One of your customer has requested for <b>'.$data["subject"].'</b>, below are the details: <br>
		<table width="100%" border="1" cellspacing="5" cellpadding="5" style="text-align: left;border-collapse:collapse">
			<tr>
				<td width="30%"><strong>Package Reference</strong></td>
				<td>'.$data["uniqueRefNo"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Name</strong></td>
				<td>'.$data["user_name"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Email</strong></td>
				<td>'.$data["user_email"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Mobile</strong></td>
				<td>'.$data["user_mobile"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Package Details</strong></td>
				<td>'.$data["package_details"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Subject</strong></td>
				<td>'.$data["subject"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Comments</strong></td>
				<td>'.$data["user_message"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Email Subscription</strong></td>
				<td>'.$data["email_subscription"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Request Date</strong></td>
				<td>'.$data["request_date"].'</td>
			</tr>
		</table>';
		// echo $msgbody;exit;
		// $this->send($data['user_email'],$subject,$msgbody);
		$this->send($this->support, $subject, $msgbody);
	}
	public function send_holi_enquiry($data) {
		// echo 12;exit;
		$subject = $data["subject"];    
		$msgbody = 'Dear Admin,<br>
		One of your customer has requested for <b>'.$data["subject"].'</b>, below are the details: <br>
		<table width="100%" border="1" cellspacing="5" cellpadding="5" style="text-align: left;border-collapse:collapse">
			<tr>
				<td width="30%"><strong>First name</strong></td>
				<td>'.$data["name"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Last Name</strong></td>
				<td>'.$data["email"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Email</strong></td>
				<td>'.$data["contact_number"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Mobile</strong></td>
				<td>'.$data["city"].'</td>
			</tr>
		</table>';
		// echo $msgbody;exit;
		// $this->send($data['user_email'],$subject,$msgbody);
		$this->send($data["to"], $subject, $msgbody);
		// $this->email->bcc('info@forvoltravel.com');
		return true;
	}

	public function send_subscription($data) {
		$subject = $data["subject"];    
		$msgbody = 'Thank You for Subscrition!! We Will get back to you soon...';
		// echo $msgbody;exit;
		$this->send($data['email'],$subject,$msgbody);
		$adminmsgbody = 'Dear admin,<br>'.$data['email'].' has just now subscribed to you';
		// $this->send($this->support, $subject, $adminmsgbody);
	}

	// public function contact_enquiry($data) {
	// 	$subject = 'Contact Enquiry';    
	// 	$msgbody = 'Dear Admin,<br>
	// 	One of your customer has requested for <b>'.$subject.'</b>, below are the details: <br>
	// 	<table width="100%" border="1" cellspacing="5" cellpadding="5" style="text-align: left;border-collapse:collapse">
	// 		<tr>
	// 			<td width="30%"><strong>Name</strong></td>
	// 			<td>'.$data["username"].'</td>
	// 		</tr>
	// 		<tr>
	// 			<td width="30%"><strong>Email</strong></td>
	// 			<td>'.$data["useremail"].'</td>
	// 		</tr>
	// 		<tr>
	// 			<td width="30%"><strong>Subject</strong></td>
	// 			<td>'.$data["usersubject"].'</td>
	// 		</tr>
	// 		<tr>
	// 			<td width="30%"><strong>Message</strong></td>
	// 			<td>'.$data["usermessage"].'</td>
	// 		</tr>
	// 	</table>';
	// 	// echo $msgbody;exit;
	// 	// $this->send($data['useremail'], $subject, $msgbody);
	// 	$this->send($this->support, $subject, $msgbody);
	// 	$this->send($this->abhishek, $subject, $msgbody);
	// }

public function contact_enquiry($data) {
		// echo '<pre>2';print_r($data);exit;
		$subject = 'Contact Enquiry';    
		$msgbody = 'Dear Admin,<br>
		One of your customer has requested for <b>'.$subject.'</b>, below are the details: <br>
		<table width="100%" border="1" cellspacing="5" cellpadding="5" style="text-align: left;border-collapse:collapse">
			<tr>
				<td width="30%"><strong>Name</strong></td>
				<td>'.$data["username"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Email</strong></td>
				<td>'.$data["useremail"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Mobile Number</strong></td>
				<td>'.$data["usermobile"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Message</strong></td>
				<td>'.$data["usermessage"].'</td>
			</tr>
		</table>';
		// echo $msgbody;exit;
		// $this->send($data['useremail'], $subject, $msgbody);
		// $this->send($this->support, $subject, $msgbody);
		$this->send('ann@travelpd.com', $subject, $msgbody);
	}

	public function registration_email($data_email) {
		if($data_email['module'] == 'b2c'){
			$module = 'Agent';
		} else {
			$module = 'User';
		}
		$msgbody = 'Dear, '.ucfirst($data_email['name']).'<br>
		Thank You for Registering with <a href="'.site_url().'">'.$this->head.'</a>,<br><br>
		<div align="center" style="color:#F90;">Registration request details from <a href="'.site_url().'">'.$this->head.'</a></div>
		<table width="500" border="1" cellpadding="5" cellspacing="5" align="center">
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Password</th>
				<th>Date</th>
			</tr>
			<tr>
				<td>' . ucfirst($data_email['name']) . '</td>
				<td>' . $data_email['email'] . '</td>
				<td>' . $data_email['password'] . '</td>
				<td>' . date("d/m/Y") . '</td>
			</tr>
		</table><br>
		<p>Please login to our website and explore your dashboard. Also, please share the word about <a href="'.site_url().'">'.$this->head.'</a> with your friends and neighbours!</p>
		<p>Please do not hesitate to contact us on '.$this->query_email.' for all your Urgent Queries / Reservation or Requirements.</p><br>
		<div>'.$this->footer.'</div>';
		$subject = $module.' Registration';
		$this->send($data_email['email'], $subject, $msgbody);
		// $this->send($this->abhishek, $subject, $msgbody);

		$admin_msgbody = 'Dear Admin,<br><br>
		New '.$data_email['module'].' customer has registered with our services,<br><br>
		<div align="center" style="color:#F90;">Registration request details from <a href="'.site_url().'">'.$this->head.'</a></div>
		<table width="500" border="1" cellpadding="5" cellspacing="5" align="center">
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Date</th>
			</tr>
			<tr>
				<td>' . ucfirst($data_email['name']) . '</td>
				<td>' . $data_email['email'] . '</td>
				<td>' . date("d/m/Y") . '</td>
			</tr>
		</table><br>
		<div>'.$this->footer.'</div>';
		$this->send($this->support, $subject, $admin_msgbody);
		// $this->send($this->abhishek, $subject, $admin_msgbody);
	}

	public function forgot_password($data) {
		$message = $data['otp'].' is the OTP for your email verification on '.$this->head.'. This OTP will be valid for 15 minutes';
		$msgbody = 'Dear User,<br>
		<p>Greetings From '.$this->head.',</p>
		<div>'.$message.'</div>
		<div>
			<p>Please do not hesitate to contact us on '.$this->query_email.' for all your Urgent Queries / Reservation or Requirements.</p></div>
		<div>'.$this->footer.'</div>';
		$subject = 'Forgot Password';
		$this->send($data['email'], $subject, $msgbody);
	}

	public function password_change_email($data) {
		$msgbody = '<p>Greetings From '.$this->head.',</p>
		<div>Recently, you updated the password for this account :<br>
			<p>UserName : '.$data['email'].'</p>
		</div>
		<div>
			<p>If you do not requested to change the password, please inform us immediately.</p>
			<p>Please do not hesitate to contact us on '.$this->query_email.' for all your Urgent Queries / Reservation or Requirements.</p>
		</div>
		<div>'.$this->footer.'</div>';
		$subject = 'Password Update';
		$this->send($data['email'], $subject, $msgbody);
	}

	public function deposit_email($data) {
		$msgbody = 'Dear '.$data['name'].',<br>
			<p>Thank you for amount deposit.</p><br>
			<div><p>Please do not hesitate to contact us on '.$this->query_email.' for all your Urgent Queries / Reservation or Requirements.</p></div>
			<div>'.$this->footer.'</div>';
		$subject = 'Amount Deposit';
		$this->send($data['email'], $subject, $msgbody);

		$admin_msgbody = 'Dear Admin,<br>Agent has Deposited Amount:<br><br>
		<table width="500" border="1" cellpadding="5" cellspacing="5" align="center">
			<tr>
				<th>Agency Name</th>
				<th>Transaction Mode</th>
				<th>Date</th>
				<th>Amount</th>
				<th>Agent Email</th>
				<th>Mobile Number</th>
			</tr>
			<tr>
				<td>' . ucfirst($data['name']) . '</td>
				<td>' . $data['transaction_mode'] . '</td>
				<td>' . $data['date'] . '</td>
				<td>' . $data['amount'] . '</td>
				<td>' . $data['email'] . '</td>
				<td>' . $data['mobile'] . '</td>
			</tr>
		</table>
		<div>'.$this->footer.'</div>';

		$this->send($this->support, $subject, $admin_msgbody);
		// $this->send($this->abhishek, $subject, $admin_msgbody);
	}

	public function otp_login_email($data){
		$message = $data['otp'].' is the OTP for your email verification on '.$this->head.'. This OTP will be valid for 15 minutes';

		$msgbody = '<div>Dear '.$data['first_name'].',<br>
		<p>Greetings From '.$this->head.',</p>
		<div>'.$message.'</div>
		<div>
			<p>Please do not hesitate to contact us on '.$this->query_email.' for all your Urgent Queries / Reservation or Requirements.</p></div>
		<div>'.$this->footer.'</div></div>';
		$subject = 'Login OTP - '.$this->head;
		$this->send($data['email'], $subject, $msgbody);
	}

	public function emailtest(){
		$this->send('abhishek@travelpd.com', 'Test: Please Confirm Subscription', 'tesfdf');
		$this->send('akgupta.nit@gmail.com', 'Test: Please Confirm Subscription', 'tesfdf');
	}

}	