<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Sendemail extends MX_Controller {
	private $from;
	private $to;
	private $subject;
	private $message;
	private $head;
	private $weburl;
	private $config;
	private $company;
	private $Phone;
	private $Customer_email;
	private $admin_email;
	private $me;
	private $footer;
	public function __construct() {
		parent::__construct();
		$this->from = 'bookings@travelfreeby.com';
		$this->head = 'Travelfreeby';
		$this->weburl = 'www.travelfreeby.com';
		$this->company = 'Travelfreeby';
		$this->Phone = 'Enquiry @ 91 8861 186977<br>Support @ 8861 186977 ';
		$this->customer_email = 'info@travelfreeby.com';
		$this->admin_email = 'bookings@travelfreeby.com';
		$this->me = 'ankita@travelpd.com';
		$this->footer='Warm Regards,<br>
		Travelfreeby Team<br><br><br>';
		$this->from = 'info@travelfreeby.com';
		$this->config = Array(
			'protocol' => 'telnet',
			'smtp_host' => 'smtp.sendgrid.net',
			'smtp_port' => '25',
			'smtp_user' => 'apikey',
			'smtp_pass' => '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',
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
		//exit();
	}
	public function send_attach($to, $subject, $message, $path) {
		$this->load->library('email', $this->config);
		//$this->load->library('email');
		
		$this->email->initialize($this->config);
		$this->email->from($this->from, $this->head);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->attach($path);
		$this->email->send();
		// echo $this->email->print_debugger();
		//exit();
	}
	public function b2c_registration($data_email) {
	// echo '<pre>';print_r($data);
		$this->from = 'info@travelfreeby.com';
		$msgbody = 'Dear <b>' . ucfirst($data_email['first_name']) . ',</b>
		<br />
		Welcome to the world of Travelfreeby!<br />
		<p>Your registration on travelfreeby.com was completed successfully.</p>
		<div><a target="_blank" href="'.site_url().'b2c/traveller-sign-in">Login into your account</a> to get <b>Special Prices</b> and <b>Discounts
		</b> on
		<ol>
		<li>Flight Tickets – Domestic or International</li>
		<li>Bus Tickets</li>
		<li>Travel Insurance</li>
		<li>Convenience Fees</li>
		</ol>
		</div>
		<p><div>Happy Travelling!</div><div>Travelfreeby</div><div><a target="_blank" href="'.base_url().'">https://www.travelfreeby.com</a></div></p><br>';
		$msgbody .= '<div style="font-size:14px;">Book yourself on <a target="_blank" href="'.base_url().'">www.travelfreeby.com</a> at the Best Prices</div>
		<a target="_blank" href="'.base_url().'"><img src="'.base_url().'public/img/mail/image001.png"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="'.base_url().'"><img src="'.base_url().'public/img/mail/image002.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="http://www.travelfreeby.com/book-hotels/"><img src="'.base_url().'public/img/mail/image003.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="'.site_url().'bus/"><img src="'.base_url().'public/img/mail/image004.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="http://www.travelfreeby.com/book-cabs/"><img src="'.base_url().'public/img/mail/image005.jpg"></a><br>
		<a target="_blank" href="'.base_url().'"><img src="'.base_url().'public/img/mail/image006.jpg"></a> &nbsp;&nbsp;&nbsp;
		<img src="'.base_url().'public/img/mail/image007.png"><br><br>
		<div style="background:#000;display: table;width: 100%;"><a target="_blank" href="'.base_url().'" style="display: table-cell;vertical-align: middle;color: #fff;font-size: 14px;padding: 0 10px;">www.travelfreeby.com</a> <img src="http://www.travelfreeby.com/images/social.png" usemap="#socialmap" height="39" width="423" align="right" alt="fun-travel-deals-social-connections" title="Fun Travel Deals Social connections" style="display: table-cell;vertical-align: middle;padding: 0 10px;">
		<map name="socialmap">
		<area shape="rect" coords="0,0,38,39" href="https://play.google.com/store/apps/details?id=com.funtraveldeals" alt="Download Fun Travel Deals Android app" title="Download Fun Travel Deals Android app">
		<area shape="rect" coords="36,0,72,39" href="https://appworld.blackberry.com/webstore/content/27193878/?countrycode=IN" alt="Download Fun Travel Deals Blackberry app" title="Download Fun Travel Deals Blackberry app">
		<area shape="rect" coords="70,0,107,39" href="https://www.windowsphone.com/en-us/store/app/funtraveldeals/314eb54a-050a-4c5f-92e8-2e4be39742d2" alt="Download Fun Travel Deals Windows app" title="Download Fun Travel Deals Windows app">
		<area shape="rect" coords="100,0,140,39" href="https://www.facebook.com/travelfreeby" alt="Like us on Facebook" title="Like us on Facebook">
		<area shape="rect" coords="138,0,175,39" href="https://twitter.com/travelfreeby" alt="Follow us on Twitter" title="Follow us on Twitter">
		<area shape="rect" coords="173,0,210,39" href="https://plus.google.com/+Funtraveldeals/posts" alt="Follow us on Google+" title="Follow us on Google+">
		<area shape="rect" coords="208,0,245,39" href="https://www.linkedin.com/in/travelfreeby" alt="Follow us on LinkedIn" title="Follow us on LinkedIn">
		<area shape="rect" coords="243,0,281,39" href="https://www.travelfreeby.com/blog/" alt="Fun Travel Deals Blog" title="Fun Travel Deals Blog">
		<area shape="rect" coords="279,0,313,39" href="https://www.flickr.com/photos/funtraveldeals/" alt="Follow us on Flickr" title="Follow us on Flickr">
		<area shape="rect" coords="311,0,350,39" href="https://www.youtube.com/channel/UCn2kH_xLaBFmM-tDXBY3r5g" alt="Follow us on YouTube" title="Follow us on YouTube">
		<area shape="rect" coords="348,0,385,39" href="https://www.travelfreeby.com/blog/feed/" alt="Subscribe RSS Feeds of Fun Travel Deals" title="Subscribe RSS Feeds of Fun Travel Deals">
		<area shape="rect" coords="383,0,423,39" href="https://www.pinterest.com/funtraveldeals/" alt="Follow us on Pinterest" title="Follow us on Pinterest">
		</map>
		</div>';
		$subject = 'Welcome to your Travelfreeby Account!';

		$this->sendgrid($data_email['user_email'],$subject,$msgbody,'info@travelfreeby.com',NULL,NULL,
			'info@travelfreeby.com');
	}
	public function b2b_registration($data_email) {
		// echo '<pre>';print_r($data);
		// echo 1;exit;
		$this->from = 'info@travelfreeby.com';
		$msgbody = 'Dear ' . $data_email['title'] . ' ' . ucfirst($data_email['first_name']) . ',
		<br />
		<br />
		Welcome to Travelfreeby B2B Account!<br />
		<br />
		<div>Thank you for registering with us. To serve you better, we bring to you a wide range of travel related products including cheapest airfares, bus bookings and much more from various consolidators across the world, providing you the benefit to boost your sales and customer satisfaction. </div><br/>
		Your account details are as follows:<br /><br />
		<table width="500" border="1" cellpadding="5" cellspacing="5">
		<tr>
		<td>Applied On</td>
		<td>' . ucfirst($data_email['register_date']) . '</td>
		</tr>
		<tr>
		<td>Agent ID</td>
		<td>' . ucfirst($data_email['agent_no']) . '</td>
		</tr>
		<tr>
		<td>Account Status</td>
		<td>' . ucfirst($data_email['status']) . '</td>
		</tr>
		<tr>
		<td>Company Name</td>
		<td>' . ucfirst($data_email['agency_name']) . '</td>
		</tr>
		<tr>
		<td>Agent Name</td>
		<td>' . $data_email['first_name'] . '</td>
		</tr>
		<tr>
		<td>Phone</td>
		<td>' . $data_email['mobile_no'] . '</td>
		</tr>
		<tr>
		<td>Address</td>
		<td>' . $data_email['address'] . '</td>
		</tr>
		<tr>
		<td>City</td>
		<td>' . $data_email['city'] . '</td>
		</tr>
		<tr>
		<td>State</td>
		<td>' . $data_email['state'] . '</td>
		</tr>
		<tr>
		<td>Pin Code</td>
		<td>' . $data_email['pin_code'] . '</td>
		</tr>
		<tr>
		<td>Email</td>
		<td>' . $data_email['agent_email'] . '</td>
		</tr>
		<tr>
		<td>Password</td>
		<td>' . $data_email['agent_password'] . '</td>
		</tr>
		</table><br>
		<div>Please provide the following documents ASAP for us to activate your account
		<ol>
		<li>PAN Card</li>
		<li>Address Proof</li>
		<li>GSTIN (optional)</li>
		<li>Aadhar No (optional)</li>
		</ol><br>
		<p>You will receive an email once your account is activated. Use your Agent ID for any future reference.</p>
		<p>Thank you again for your interest in Travelfreeby B2B Account. We look forward to working with you.</p></div>
		<p>Regards,<br>
		<a target="_blank" href="https://www.travelfreeby.com">https://www.travelfreeby.com</a></p>
		<p>Travelfreeby</p>
		<p>Our Bank Account Details are as follows:</p>
		<p>Account Name: Travelfreeby</p>
		<p>PAN: AAWCS4469E</p>
		<p>GSTIN: 29AAWCS4469E1ZL</p><br>
		<table width="80%" border="1" cellpadding="5" cellspacing="5">
		<tr>
		<th>Bank Name</th>
		<th>Current Account No</th>
		<th>IFSC Code</th>
		<th>Branch Name</th>
		</tr>
		<tr>
		<td>' . $data_email['bank_name'] . '</td>
    	<td>' . $data_email['account_no'] . '</td>
    	<td>' . $data_email['ifsc_code'] . '</td>
    	<td>' . $data_email['branch'] . '</td>
		</tr>
		</table>';
		// echo 'fs'.$msgbody;exit;
		// $subject = $data_email['subject'];

		$this->sendgrid($data_email['agent_email'],$data_email['subject'],$msgbody,
			'info@travelfreeby.com',NULL,NULL,'info@travelfreeby.com');
	}

	public function cancellationemail($dataemail){
// echo '<pre>';print_r($data);
		// echo 1;exit;

		$url='https://www.travelfreeby.com/book/';
		$this->from = 'info@travelfreeby.com';
		$msgbody = $dataemail['message'];
		$msgbody .= '<div style="font-size:14px;">Book yourself on <a target="_blank" href="'.$url.'">www.travelfreeby.com</a> at the Best Prices</div>
		<a target="_blank" href="'.$url.'"><img src="'.$url.'public/img/mail/image001.png"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="'.$url.'"><img src="'.$url.'public/img/mail/image002.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="http://www.travelfreeby.com/book-hotels/"><img src="'.$url.'public/img/mail/image003.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="'.$url.'bus/"><img src="'.$url.'public/img/mail/image004.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="http://www.travelfreeby.com/book-cabs/"><img src="'.base_url().'public/img/mail/image005.jpg"></a><br>
		<a target="_blank" href="'.$url.'"><img src="'.$url.'public/img/mail/image006.jpg"></a> &nbsp;&nbsp;&nbsp;
		<img src="'.$url.'public/img/mail/image007.png"><br><br>
		<div style="background:#000;display: table;width: 100%;"><a target="_blank" href="'.$url.'" style="display: table-cell;vertical-align: middle;color: #fff;font-size: 14px;padding: 0 10px;">www.travelfreeby.com</a> <img src="http://www.travelfreeby.com/images/social.png" usemap="#socialmap" height="39" width="423" align="right" alt="fun-travel-deals-social-connections" title="Fun Travel Deals Social connections" style="display: table-cell;vertical-align: middle;padding: 0 10px;">
		<map name="socialmap">
		<area shape="rect" coords="0,0,38,39" href="https://play.google.com/store/apps/details?id=com.funtraveldeals" alt="Download Fun Travel Deals Android app" title="Download Fun Travel Deals Android app">
		<area shape="rect" coords="36,0,72,39" href="https://appworld.blackberry.com/webstore/content/27193878/?countrycode=IN" alt="Download Fun Travel Deals Blackberry app" title="Download Fun Travel Deals Blackberry app">
		<area shape="rect" coords="70,0,107,39" href="https://www.windowsphone.com/en-us/store/app/funtraveldeals/314eb54a-050a-4c5f-92e8-2e4be39742d2" alt="Download Fun Travel Deals Windows app" title="Download Fun Travel Deals Windows app">
		<area shape="rect" coords="100,0,140,39" href="https://www.facebook.com/travelfreeby" alt="Like us on Facebook" title="Like us on Facebook">
		<area shape="rect" coords="138,0,175,39" href="https://twitter.com/travelfreeby" alt="Follow us on Twitter" title="Follow us on Twitter">
		<area shape="rect" coords="173,0,210,39" href="https://plus.google.com/+Funtraveldeals/posts" alt="Follow us on Google+" title="Follow us on Google+">
		<area shape="rect" coords="208,0,245,39" href="https://www.linkedin.com/in/travelfreeby" alt="Follow us on LinkedIn" title="Follow us on LinkedIn">
		<area shape="rect" coords="243,0,281,39" href="https://www.travelfreeby.com/blog/" alt="Fun Travel Deals Blog" title="Fun Travel Deals Blog">
		<area shape="rect" coords="279,0,313,39" href="https://www.flickr.com/photos/funtraveldeals/" alt="Follow us on Flickr" title="Follow us on Flickr">
		<area shape="rect" coords="311,0,350,39" href="https://www.youtube.com/channel/UCn2kH_xLaBFmM-tDXBY3r5g" alt="Follow us on YouTube" title="Follow us on YouTube">
		<area shape="rect" coords="348,0,385,39" href="https://www.travelfreeby.com/blog/feed/" alt="Subscribe RSS Feeds of Fun Travel Deals" title="Subscribe RSS Feeds of Fun Travel Deals">
		<area shape="rect" coords="383,0,423,39" href="https://www.pinterest.com/funtraveldeals/" alt="Follow us on Pinterest" title="Follow us on Pinterest">
		</map>
		</div>';

		$this->sendgrid($dataemail['email'],$dataemail['subject'],$msgbody,$dataemail['from'],NULL,NULL,$dataemail['cc']);
	}
	public function deposit_request_email($deposit_email) {
		// echo '<pre>';print_r($data);
		$this->from = 'info@travelfreeby.com';
		$msgbody = 'Dear ' . $deposit_email['first_name'] . ' (' . ucfirst($deposit_email['agency_name']). '),
		<br />
		<br />
		We have received your request of ' .$deposit_email['transaction_mode'] . ' as follows:<br />
		<br />
		<table width="500" border="1" cellpadding="5" cellspacing="5">
		<tr>';
		if($deposit_email['transaction_mode']=='Online Transfer'){
			$msgbody .= '<th>Transfer Amount</th>';
			$msgbody .= '<th>Transaction ID</th>';
			$msgbody .= '<th>Bank Name</th>';
			$msgbody .= '<th>Transfer Date</th>';
			$msgbody .= '<th>Remarks</th>';
		}
		if($deposit_email['transaction_mode']=='Cash'){
			$msgbody .= '<th>Cash Amount</th>';
			$msgbody .= '<th>Transaction ID</th>';
			$msgbody .= '<th>Bank Name</th>';
			$msgbody .= '<th>Transfer Date</th>';
			$msgbody .= '<th>Remarks</th>';
		}
		if($deposit_email['transaction_mode']=='Cheque'){
			$msgbody .= '<th>Cheque Amount</th>';
			$msgbody .= '<th>Cheque No.</th>';
			$msgbody .= '<th>Bank Name</th>';
			$msgbody .= '<th>Transfer Date</th>';
			$msgbody .= '<th>Cheque Drawn Bank</th>';
			$msgbody .= '<th>Remarks</th>';
		}
		if($deposit_email['transaction_mode']=='Credit Request'){
			$msgbody .= '<th>Credit Amount</th>';
			$msgbody .= '<th>Credit Pending</th>';
			$msgbody .= '<th>Remarks</th>';
		}
		if($deposit_email['transaction_mode']=='Recharge'){
			$msgbody .= '<th>Credit Amount</th>';
			$msgbody .= '<th>Payment Gateway Status</th>';
		}
		$msgbody .= '<th>Request Date</th>';
		$msgbody .= '<th>Reference ID</th>
		</tr>
		<tr>';
		if($deposit_email['transaction_mode']=='Online Transfer'){
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['transfer_amount'] . '</td>';
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['transaction_id'] . '</td>';
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['bank_name'] . '</td>';
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['transfer_date'] . '</td>';
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['customer_remarks'] . '</td>';
		}
		if($deposit_email['transaction_mode']=='Cash'){
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['transfer_amount'] . '</td>';
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['transaction_id'] . '</td>';
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['bank_name'] . '</td>';
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['transfer_date'] . '</td>';
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['customer_remarks'] . '</td>';
		}
		if($deposit_email['transaction_mode']=='Cheque'){
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['transfer_amount'] . 
			'</td>';
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['cheque_no'] . '</td>';
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['bank_name'] . '</td>';
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['transfer_date'] . '</td>';
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['cheque_drawn_bank'] . '
			</td>';
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['customer_remarks'] . '</td>';
		}
		if($deposit_email['transaction_mode']=='Credit Request'){
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['transfer_amount'] . '</td>';
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['credit_pending'] . '</td>';
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['customer_remarks'] . '</td>';
		}
		if($deposit_email['transaction_mode']=='Recharge'){
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['transfer_amount'] . '</td>';
			$msgbody .= '<td style="text-align:center;">' . $deposit_email['payment_gateway'] . '</td>';

		}
		$msgbody .= '<td style="text-align:center;">' . $deposit_email['request_date'] . '</td>
		<td style="text-align:center;">' . $deposit_email['reference_no'] . '</td>
		</tr>
		</table><br>
		<p>Your request will be reviewed and updated soon.</p>
		<p>Best Regards<br>
		<a target="_blank" href="https://www.travelfreeby.com">https://www.travelfreeby.com</a></p>
		<p>Travelfreeby</p>
		';
		$subject = 'Registration';
		$allmsgdata = $deposit_email;
		$from = 'udayaraj@travelpd.com';		
		$request = '{
			"from":{
			   "email":"'.$from.'"
			},
			"personalizations":[
			   {
				  "to":[
					 {
						"email":"'.$deposit_email['agent_email'].'"
					 }
				  ],
				  "dynamic_template_data":{
					 "first_name":"'.$deposit_email['first_name'].'",            
					 "agency_name":"'.$deposit_email['agency_name'].'",
					 "request_date":"'.$deposit_email['transfer_date'].'",
					 "reference_no":"'.$deposit_email['reference_no'].'"
				   }
			   }
			],
			"template_id":"d-fbb623f4548e4035bff36ea78a483c65"
		 }';

		
		$this->sendgrid($deposit_email['agent_email'],$deposit_email['subject'],$request,'info@travelfreeby.com',NULL,NULL,'info@travelfreeby.com');
	}

	public function agentStatementEmail($statement_email) {
        // echo '<pre>';print_r($data);
        // echo 1;exit;
        $this->from = 'info@travelfreeby.com';
        $msgbody = 'Dear ' . ucfirst($statement_email['first_name']) . ',
        <br /><br />
        Your Account ' . $statement_email['trasactiontype'] . ' has been done.<br />
        <br />
        Your account details are as follows:<br /><br />
        <table width="500" border="1" cellpadding="5" cellspacing="5">
        <tr>
        <td>Agency Name</td>
        <td>' . ucfirst($statement_email['agency_name']) . '</td>
        </tr>
        <tr>
        <td>Amount Added</td>
        <td>' . round($statement_email['addbooking_balace']) . '</td>
        </tr>
        <tr>
        <td>Payment Gateway Status</td>
        <td>' . $statement_email['status'] . '</td>
        </tr>
        <tr>
        <td>Reference ID</td>
        <td>' . $statement_email['reference_no'] . '</td>
        </tr>
        <tr>
        <td>Request Date</td>
        <td>' . $statement_email['request_date'] . '</td>
        </tr>';
        $msgbody .= '</table>
        <p>Regards,<br>
        <a target="_blank" href="https://www.travelfreeby.com">https://www.travelfreeby.com</a></p>
        <p>Travelfreeby</p>';

        // echo 'fs'.$msgbody;exit;
        // $subject = $data_email['subject'];
		$this->sendgrid($statement_email['email'],$statement_email['subject'],$msgbody,'info@travelfreeby.com',NULL,NULL,'info@travelfreeby.com');
    }


	public function testing_email(){
		//echo 'mail_testing';
		$msg= 'Travelpd ';
		$this->sendgrid('udayaraj@travelpd.com','travelfreebyemailtest','testingemail','info@travelfreeby.com','','','','','');
		$this->sendgrid('vinitj@travelfreeby.com','travelfreebyemailtest','testingemail','info@travelfreeby.com','','','','','');
	}
	public function busbooking($data_email){
		$this->sendgrid($data_email['user_email'], $data_email['subject'], $data_email['content'],'info@travelfreeby.com',$data_email['filename'],$data_email['pdfpath'],$data_email['cc'],$data_email['replyto'],$data_email['bcc']);
		//$this->sendgrid('udayaraj@travelpd.com', $data_email['subject'], $data_email['content'],'info@travelfreeby.com',$data_email['filename'],$data_email['pdfpath'],'','','');
	}
	public function flightbooking($data_email){
		$this->sendgrid($data_email['user_email'], $data_email['subject'], $data_email['content'],'flight@travelfreeby.com',$data_email['filename'],$data_email['pdfpath'],$data_email['cc'],$data_email['replyto'],$data_email['bcc']);
		//$this->sendgrid('udayaraj@travelpd.com', $data_email['subject'], $data_email['content'],'info@travelfreeby.com',$data_email['filename'],$data_email['pdfpath'],$data_email['cc'],$data_email['replyto'],$data_email['bcc']);
	}
	public function billdesk($data_email){
		$emails=explode(',',$data_email['user_email']);
		foreach($emails as $val){
		$asdsad=$this->sendgrid($val, $data_email['subject'], $data_email['content'],'info@travelfreeby.com',$data_email['filename'],$data_email['pdfpath'],'','','');
	}
	//echo $asdsad=$this->sendgrid('udayaraj@travelpd.com', $data_email['subject'], $data_email['content'],'info@travelfreeby.com',$data_email['filename'],$data_email['pdfpath'],'','','');
	return $asdsad;
	}
	public function sendgrid($to,$subjest,$voucher_content,$from,$filename='',$pdf_path='',$cc='',$replyto='',$bcc=''){
 
		$url = 'https://api.sendgrid.com/';
		$user = 'Travelfreeby';
		$from = 'udayaraj@travelpd.com';
		$pass = 'sendgrid@1234';
		if($filename!=null){
			$datapost = array(
				'api_user' => $user,
				'api_key' => $pass,
				'to' => $to,
				'cc' => $cc,
				'bcc' => $bcc,
				'subject' => $subjest,
				'html' => $voucher_content,
				//'text' => $htmldata,
				'from' => $from,
				'reply_to' => $replyto,
				//'files['.$filename.']' => '@'.file_get_contents($pdf_path)
				'files['.$filename.']' => file_get_contents($pdf_path)
			);
			

		}else{
			$datapost = array(
				'api_user' => $user,
				'api_key' => $pass,
				'to' => $to,
				'cc' => $cc,
				'bcc' => $bcc,
				'subject' => $subjest,
				'html' => $voucher_content,
				'reply_to' => $replyto,
				//'text' => $htmldata,
				'from' => $from
				
			);

	

		}
		
		
		//echo '<pre/>11';print_r($sendrequest);exit;
		// $url1 = $url.'v3/mail/send';
		// $ch = curl_init($url1);
		// curl_setopt ($ch, CURLOPT_POST, true);
		// curl_setopt ($ch, CURLOPT_POSTFIELDS, $sendrequest);
		// curl_setopt($ch, CURLOPT_HEADER, $header);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// $response = curl_exec($ch);
		// curl_close($ch);
		//  return $response;
		//   echo"<pre>11";print_r($response);exit;
		file_put_contents(FCPATH . 'dump/mail/sendgrid_request.xml', $voucher_content);
		 
		
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.sendgrid.com/v3/mail/send',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>$voucher_content,
		  CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer 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',
			'Content-Type: application/json'
		  ),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);
// 		echo $response;
		

	}
	public function error_email_to_admin($data) {
		//echo "<pre/>";  print_r($data);exit;
		// $this->from = 'bookings@travelfreeby.com';
		$msgbody = '<table border="1">           
		<tr><td>Error Module:</td><td>'.$data['error_module'].'</td></tr>
		<tr><td>Error Text</td><td>'.$data['error_text'].'</td></tr>
		<tr><td>Booking Date</td><td>'.$data['booking_date'].'</td></tr>
		<tr><td>Travel Query</td><td>'.$data['travel_query'].'</td></tr>
		<tr><td>No of PAX</td><td>'.$data['pax_count'].'</td></tr>
		<tr><td>Selected Bus</td><td>'.$data['selectedbus'].'</td></tr>
		<tr><td>Total Amount</td><td>'.$data['total_cost'].'</td></tr>
		<tr><td>Traveller Email</td><td>'.$data['traveller_email'].'</td></tr>
		<tr><td>Traveller Mobile</td><td>'.$data['traveller_mobile'].'</td></tr>
		</table>';
		$subject = $data['subject'];
		$this->sendgrid('info@travelfreeby.com', $data['subject'], $msgbody);
			// $this->send($this->me, $data['subject'], $msgbody, $path);
	}
	public function user_activate_password($data) {
			// $this->from = 'info@mercury.com';
		$msgbody = 'Hi ' . $data['first_name'] . ' ' . ucfirst($data['last_name']) .',
		<p>Welcome to travelfreeby.com family.</p>
		<p>An account has been created for you at travelfreeby.com. An account helps you in tracking your order status. You can also easily view your order history and other order related information.</p>
		<p>Please visit the url below to activate your account and set your password.</p>
		<p>URL: <a href="' . site_url() . 'home/login/set_password/' . $data['user_id'] . '/' . $data['activation_key'] . '">click here</a></p>
		<p><div>Happy Travelling!</div><div>Travelfreeby</div><div><a target="_blank" href="'.base_url().'">https://www.travelfreeby.com</a></div></p><br>';
		$msgbody .= '<div style="font-size:14px;">Book yourself on <a target="_blank" href="'.base_url().'">www.travelfreeby.com</a> at the Best Prices</div>
		<a target="_blank" href="'.base_url().'"><img src="'.base_url().'public/img/mail/image001.png"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="'.base_url().'"><img src="'.base_url().'public/img/mail/image002.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="http://www.travelfreeby.com/book-hotels/"><img src="'.base_url().'public/img/mail/image003.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="'.site_url().'bus/"><img src="'.base_url().'public/img/mail/image004.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="http://www.travelfreeby.com/book-cabs/"><img src="'.base_url().'public/img/mail/image005.jpg"></a><br>
		<a target="_blank" href="'.base_url().'"><img src="'.base_url().'public/img/mail/image006.jpg"></a> &nbsp;&nbsp;&nbsp;
		<img src="'.base_url().'public/img/mail/image007.png"><br><br>
		<div style="background:#000;display: table;width: 100%;"><a target="_blank" href="'.base_url().'" style="display: table-cell;vertical-align: middle;color: #fff;font-size: 14px;padding: 0 10px;">www.travelfreeby.com</a> <img src="http://www.travelfreeby.com/images/social.png" usemap="#socialmap" height="39" width="423" align="right" alt="fun-travel-deals-social-connections" title="Fun Travel Deals Social connections" style="display: table-cell;vertical-align: middle;padding: 0 10px;">
		<map name="socialmap">
		<area shape="rect" coords="0,0,38,39" href="https://play.google.com/store/apps/details?id=com.funtraveldeals" alt="Download Fun Travel Deals Android app" title="Download Fun Travel Deals Android app">
		<area shape="rect" coords="36,0,72,39" href="https://appworld.blackberry.com/webstore/content/27193878/?countrycode=IN" alt="Download Fun Travel Deals Blackberry app" title="Download Fun Travel Deals Blackberry app">
		<area shape="rect" coords="70,0,107,39" href="https://www.windowsphone.com/en-us/store/app/funtraveldeals/314eb54a-050a-4c5f-92e8-2e4be39742d2" alt="Download Fun Travel Deals Windows app" title="Download Fun Travel Deals Windows app">
		<area shape="rect" coords="100,0,140,39" href="https://www.facebook.com/travelfreeby" alt="Like us on Facebook" title="Like us on Facebook">
		<area shape="rect" coords="138,0,175,39" href="https://twitter.com/travelfreeby" alt="Follow us on Twitter" title="Follow us on Twitter">
		<area shape="rect" coords="173,0,210,39" href="https://plus.google.com/+Funtraveldeals/posts" alt="Follow us on Google+" title="Follow us on Google+">
		<area shape="rect" coords="208,0,245,39" href="https://www.linkedin.com/in/travelfreeby" alt="Follow us on LinkedIn" title="Follow us on LinkedIn">
		<area shape="rect" coords="243,0,281,39" href="https://www.travelfreeby.com/blog/" alt="Fun Travel Deals Blog" title="Fun Travel Deals Blog">
		<area shape="rect" coords="279,0,313,39" href="https://www.flickr.com/photos/funtraveldeals/" alt="Follow us on Flickr" title="Follow us on Flickr">
		<area shape="rect" coords="311,0,350,39" href="https://www.youtube.com/channel/UCn2kH_xLaBFmM-tDXBY3r5g" alt="Follow us on YouTube" title="Follow us on YouTube">
		<area shape="rect" coords="348,0,385,39" href="https://www.travelfreeby.com/blog/feed/" alt="Subscribe RSS Feeds of Fun Travel Deals" title="Subscribe RSS Feeds of Fun Travel Deals">
		<area shape="rect" coords="383,0,423,39" href="https://www.pinterest.com/funtraveldeals/" alt="Follow us on Pinterest" title="Follow us on Pinterest">
		</map>
		</div>';
	
		$subject = 'Set Password - travelfreeby.com';
		$this->sendgrid($data['emailid'],$subject,$msgbody,'info@travelfreeby.com',NULL,NULL,'info@travelfreeby.com');
	}
	public function b2b_forgot_password($data) {
		$this->from = 'info@travelfreeby.com';
		$msgbody = 'Greetings From Travelfreeby,<br />
		<div>Login Details : </div>
		<p>UserName : ' . $data['agent_email'] . '</p>
		<div>Please Reset you password from here <a href="' . site_url() . 'b2b/load_forgot_password/' . $data['agent_no'] . '/">click here</a>
		<p>Please do not hesitate to contact us on info@travelfreeby.com for all your Urgent Queries / Reservation or Requirements.</p></div>
		<div>Thanking you,</div>
		<a target="_blank" href="https://www.travelfreeby.com">https://www.travelfreeby.com</a></p>
		<p>Travelfreeby</p>';

		$this->sendgrid($data['agent_email'],$data['subject'],$msgbody,'info@travelfreeby.com',NULL,NULL,'info@travelfreeby.com');
	}
	public function b2c_forgot_password($data) {
		$this->from = 'info@travelfreeby.com';
		$msgbody = 'Greetings From Travelfreeby,<br />
		<div>Login Details : </div>
		<p>UserName : ' . $data['user_email'] . '</p>
		<div>Please Reset you password from here <a href="' . site_url() . 'b2c/load_forgot_password/' . $data['user_id'] . '/' . $data['activation_key'] . '">
		click here</a>
		<p>Please do not hesitate to contact us on info@travelfreeby.com for all your Urgent Queries / Reservation or Requirements.</p></div>
		<div>Thanking you,</div>
		<a target="_blank" href="https://www.travelfreeby.com">https://www.travelfreeby.com</a></p>
		<p>Travelfreeby</p>';
		$subject = 'Forgot password';
		$this->sendgrid($data['user_email'],$subject,$msgbody,'info@travelfreeby.com',NULL,NULL,'info@travelfreeby.com');
	}

	public function payment_failed_flight($emaildata){
		$msgbody ='Dear Sir / Madam,<br />
		<div>Your Flight Ticket booking has been failed due to your Payment Failure of Rs '.$emaildata['total_fare'].'. Please complete the payment to get your flight ticket.</div><br/>
		<div>Payment Failure Reason from the Bank : '.$emaildata['failedmessage'].'.</div><br/>
		<div>Kindly book again your Flight Ticket <a target="_blank" href="https://www.travelfreeby.com/book/flights/">here</a></div><br/>
		<div>Thanks</div>
		<p>Shubh Mani Solutions Pvt Ltd</p>
		<p><a target="_blank" href="'.base_url().'">https://www.travelfreeby.com</a></p><br/>';
		$msgbody .= '<div style="font-size:14px;">Book yourself on <a target="_blank" href="'.base_url().'">www.travelfreeby.com</a> at the Best Prices</div>
		<a target="_blank" href="'.base_url().'"><img src="'.base_url().'public/img/mail/image001.png"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="'.base_url().'"><img src="'.base_url().'public/img/mail/image002.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="http://www.travelfreeby.com/book-hotels/"><img src="'.base_url().'public/img/mail/image003.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="'.site_url().'bus/"><img src="'.base_url().'public/img/mail/image004.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="http://www.travelfreeby.com/book-cabs/"><img src="'.base_url().'public/img/mail/image005.jpg"></a><br>
		<a target="_blank" href="'.base_url().'"><img src="'.base_url().'public/img/mail/image006.jpg"></a> &nbsp;&nbsp;&nbsp;
		<img src="'.base_url().'public/img/mail/image007.png"><br><br>
		<div style="background:#000;display: table;width: 100%;"><a target="_blank" href="'.base_url().'" style="display: table-cell;vertical-align: middle;color: #fff;font-size: 14px;padding: 0 10px;">www.travelfreeby.com</a> <img src="http://www.travelfreeby.com/images/social.png" usemap="#socialmap" height="39" width="423" align="right" alt="fun-travel-deals-social-connections" title="Fun Travel Deals Social connections" style="display: table-cell;vertical-align: middle;padding: 0 10px;">
		<map name="socialmap">
		<area shape="rect" coords="0,0,38,39" href="https://play.google.com/store/apps/details?id=com.funtraveldeals" alt="Download Fun Travel Deals Android app" title="Download Fun Travel Deals Android app">
		<area shape="rect" coords="36,0,72,39" href="https://appworld.blackberry.com/webstore/content/27193878/?countrycode=IN" alt="Download Fun Travel Deals Blackberry app" title="Download Fun Travel Deals Blackberry app">
		<area shape="rect" coords="70,0,107,39" href="https://www.windowsphone.com/en-us/store/app/funtraveldeals/314eb54a-050a-4c5f-92e8-2e4be39742d2" alt="Download Fun Travel Deals Windows app" title="Download Fun Travel Deals Windows app">
		<area shape="rect" coords="100,0,140,39" href="https://www.facebook.com/travelfreeby" alt="Like us on Facebook" title="Like us on Facebook">
		<area shape="rect" coords="138,0,175,39" href="https://twitter.com/travelfreeby" alt="Follow us on Twitter" title="Follow us on Twitter">
		<area shape="rect" coords="173,0,210,39" href="https://plus.google.com/+Funtraveldeals/posts" alt="Follow us on Google+" title="Follow us on Google+">
		<area shape="rect" coords="208,0,245,39" href="https://www.linkedin.com/in/travelfreeby" alt="Follow us on LinkedIn" title="Follow us on LinkedIn">
		<area shape="rect" coords="243,0,281,39" href="https://www.travelfreeby.com/blog/" alt="Fun Travel Deals Blog" title="Fun Travel Deals Blog">
		<area shape="rect" coords="279,0,313,39" href="https://www.flickr.com/photos/funtraveldeals/" alt="Follow us on Flickr" title="Follow us on Flickr">
		<area shape="rect" coords="311,0,350,39" href="https://www.youtube.com/channel/UCn2kH_xLaBFmM-tDXBY3r5g" alt="Follow us on YouTube" title="Follow us on YouTube">
		<area shape="rect" coords="348,0,385,39" href="https://www.travelfreeby.com/blog/feed/" alt="Subscribe RSS Feeds of Fun Travel Deals" title="Subscribe RSS Feeds of Fun Travel Deals">
		<area shape="rect" coords="383,0,423,39" href="https://www.pinterest.com/funtraveldeals/" alt="Follow us on Pinterest" title="Follow us on Pinterest">
		</map>';
		$subject = 'Travelfreeby Flight Booking Payment Failure ' .$emaildata['uniqueRefNo']. ' ';
		$this->sendgrid($emaildata['email'],$subject,$msgbody,'info@travelfreeby.com',NULL,NULL,'flight@travelfreeby.com');
	}

	public function payment_failed_bus($emaildata){
		$msgbody ='Dear Sir / Madam,<br />
		<div>Your Bus Ticket booking has been failed due to your Payment Failure of Rs '.$emaildata['total_fare'].'. Please complete the payment to get your bus ticket.</div><br/>
		<div>Payment Failure Reason from the Bank : '.$emaildata['failedmessage'].'.</div><br/>
		<div>Kindly book again your Bus Ticket <a target="_blank" href="https://www.travelfreeby.com/book/bus/">here</a></div><br/>
		<div>Thanks</div>
		<p>Shubh Mani Solutions Pvt Ltd</p>
		<p><a target="_blank" href="'.base_url().'/bus/">https://www.travelfreeby.com</a></p><br/>';
		$msgbody .= '<div style="font-size:14px;">Book yourself on <a target="_blank" href="'.base_url().'">www.travelfreeby.com</a> at the Best Prices</div>
		<a target="_blank" href="'.base_url().'"><img src="'.base_url().'public/img/mail/image001.png"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="'.base_url().'"><img src="'.base_url().'public/img/mail/image002.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="http://www.travelfreeby.com/book-hotels/"><img src="'.base_url().'public/img/mail/image003.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="'.site_url().'bus/"><img src="'.base_url().'public/img/mail/image004.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="http://www.travelfreeby.com/book-cabs/"><img src="'.base_url().'public/img/mail/image005.jpg"></a><br>
		<a target="_blank" href="'.base_url().'"><img src="'.base_url().'public/img/mail/image006.jpg"></a> &nbsp;&nbsp;&nbsp;
		<img src="'.base_url().'public/img/mail/image007.png"><br><br>
		<div style="background:#000;display: table;width: 100%;"><a target="_blank" href="'.base_url().'" style="display: table-cell;vertical-align: middle;color: #fff;font-size: 14px;padding: 0 10px;">www.travelfreeby.com</a> <img src="http://www.travelfreeby.com/images/social.png" usemap="#socialmap" height="39" width="423" align="right" alt="fun-travel-deals-social-connections" title="Fun Travel Deals Social connections" style="display: table-cell;vertical-align: middle;padding: 0 10px;">
		<map name="socialmap">
		<area shape="rect" coords="0,0,38,39" href="https://play.google.com/store/apps/details?id=com.funtraveldeals" alt="Download Fun Travel Deals Android app" title="Download Fun Travel Deals Android app">
		<area shape="rect" coords="36,0,72,39" href="https://appworld.blackberry.com/webstore/content/27193878/?countrycode=IN" alt="Download Fun Travel Deals Blackberry app" title="Download Fun Travel Deals Blackberry app">
		<area shape="rect" coords="70,0,107,39" href="https://www.windowsphone.com/en-us/store/app/funtraveldeals/314eb54a-050a-4c5f-92e8-2e4be39742d2" alt="Download Fun Travel Deals Windows app" title="Download Fun Travel Deals Windows app">
		<area shape="rect" coords="100,0,140,39" href="https://www.facebook.com/travelfreeby" alt="Like us on Facebook" title="Like us on Facebook">
		<area shape="rect" coords="138,0,175,39" href="https://twitter.com/travelfreeby" alt="Follow us on Twitter" title="Follow us on Twitter">
		<area shape="rect" coords="173,0,210,39" href="https://plus.google.com/+Funtraveldeals/posts" alt="Follow us on Google+" title="Follow us on Google+">
		<area shape="rect" coords="208,0,245,39" href="https://www.linkedin.com/in/travelfreeby" alt="Follow us on LinkedIn" title="Follow us on LinkedIn">
		<area shape="rect" coords="243,0,281,39" href="https://www.travelfreeby.com/blog/" alt="Fun Travel Deals Blog" title="Fun Travel Deals Blog">
		<area shape="rect" coords="279,0,313,39" href="https://www.flickr.com/photos/funtraveldeals/" alt="Follow us on Flickr" title="Follow us on Flickr">
		<area shape="rect" coords="311,0,350,39" href="https://www.youtube.com/channel/UCn2kH_xLaBFmM-tDXBY3r5g" alt="Follow us on YouTube" title="Follow us on YouTube">
		<area shape="rect" coords="348,0,385,39" href="https://www.travelfreeby.com/blog/feed/" alt="Subscribe RSS Feeds of Fun Travel Deals" title="Subscribe RSS Feeds of Fun Travel Deals">
		<area shape="rect" coords="383,0,423,39" href="https://www.pinterest.com/funtraveldeals/" alt="Follow us on Pinterest" title="Follow us on Pinterest">
		</map>';
		$subject = 'Travelfreeby Bus Booking Payment Failure '  . $emaildata['uniqueRefNo'] . '';
		$this->sendgrid($emaildata['email'],$subject,$msgbody,'info@travelfreeby.com',NULL,NULL,'bus@travelfreeby.com');
	}

	public function insurance_details_email($service_emails,$insdata,$insbus){
		$url='https://www.travelfreeby.com/book/';
		$msgbody ='Dear Sir,<br /><br/>
		<div>Please find the list of the customers purchased Insurance for the booking date: ' .date('d-M-Y',strtotime("-1 days")). '</div><br/><br/>';
		$msgbody.=$insdata. '<br/><br/>';
		$msgbody.=$insbus;
		$msgbody.='<p>Do let us know the update of these requests.</p></div>
		<div>Thanks</div>
		<p>Shubh Mani Solutions Pvt Ltd</p>
		<p><a target="_blank" href="https://www.travelfreeby.com">https://www.travelfreeby.com</a></p>';
		$msgbody .= '<div style="font-size:14px;">Book yourself on <a target="_blank" href="'.base_url().'">www.travelfreeby.com</a> at the Best Prices</div>
		<a target="_blank" href="'.$url.'"><img src="'.$url.'public/img/mail/image001.png"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="'.$url.'"><img src="'.$url.'public/img/mail/image002.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="http://www.travelfreeby.com/book-hotels/"><img src="'.$url.'public/img/mail/image003.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="'.$url.'bus/"><img src="'.$url.'public/img/mail/image004.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="http://www.travelfreeby.com/book-cabs/"><img src="'.$url.'public/img/mail/image005.jpg"></a><br>
		<a target="_blank" href="'.$url.'"><img src="'.$url.'public/img/mail/image006.jpg"></a> &nbsp;&nbsp;&nbsp;
		<img src="'.$url.'public/img/mail/image007.png"><br><br>
		<div style="background:#000;display: table;width: 100%;"><a target="_blank" href="'.$url.'" style="display: table-cell;vertical-align: middle;color: #fff;font-size: 14px;padding: 0 10px;">www.travelfreeby.com</a> <img src="http://www.travelfreeby.com/images/social.png" usemap="#socialmap" height="39" width="423" align="right" alt="fun-travel-deals-social-connections" title="Fun Travel Deals Social connections" style="display: table-cell;vertical-align: middle;padding: 0 10px;">
		<map name="socialmap">
		<area shape="rect" coords="0,0,38,39" href="https://play.google.com/store/apps/details?id=com.funtraveldeals" alt="Download Fun Travel Deals Android app" title="Download Fun Travel Deals Android app">
		<area shape="rect" coords="36,0,72,39" href="https://appworld.blackberry.com/webstore/content/27193878/?countrycode=IN" alt="Download Fun Travel Deals Blackberry app" title="Download Fun Travel Deals Blackberry app">
		<area shape="rect" coords="70,0,107,39" href="https://www.windowsphone.com/en-us/store/app/funtraveldeals/314eb54a-050a-4c5f-92e8-2e4be39742d2" alt="Download Fun Travel Deals Windows app" title="Download Fun Travel Deals Windows app">
		<area shape="rect" coords="100,0,140,39" href="https://www.facebook.com/travelfreeby" alt="Like us on Facebook" title="Like us on Facebook">
		<area shape="rect" coords="138,0,175,39" href="https://twitter.com/travelfreeby" alt="Follow us on Twitter" title="Follow us on Twitter">
		<area shape="rect" coords="173,0,210,39" href="https://plus.google.com/+Funtraveldeals/posts" alt="Follow us on Google+" title="Follow us on Google+">
		<area shape="rect" coords="208,0,245,39" href="https://www.linkedin.com/in/travelfreeby" alt="Follow us on LinkedIn" title="Follow us on LinkedIn">
		<area shape="rect" coords="243,0,281,39" href="https://www.travelfreeby.com/blog/" alt="Fun Travel Deals Blog" title="Fun Travel Deals Blog">
		<area shape="rect" coords="279,0,313,39" href="https://www.flickr.com/photos/funtraveldeals/" alt="Follow us on Flickr" title="Follow us on Flickr">
		<area shape="rect" coords="311,0,350,39" href="https://www.youtube.com/channel/UCn2kH_xLaBFmM-tDXBY3r5g" alt="Follow us on YouTube" title="Follow us on YouTube">
		<area shape="rect" coords="348,0,385,39" href="https://www.travelfreeby.com/blog/feed/" alt="Subscribe RSS Feeds of Fun Travel Deals" title="Subscribe RSS Feeds of Fun Travel Deals">
		<area shape="rect" coords="383,0,423,39" href="https://www.pinterest.com/funtraveldeals/" alt="Follow us on Pinterest" title="Follow us on Pinterest">
		</map>
		</div>';
		$subject = 'Travel Insurance for '.date('d-M-Y',strtotime("-1 days")). ' from Travelfreeby';
		$emails=explode(',', $service_emails[0]->customer_email);
		foreach ($emails as $key => $value) {
		 $this->sendgrid($value,$subject,$msgbody,$service_emails[0]->from_email,NULL,NULL,NULL,$service_emails[0]->reply_email);
	} 
		//$this->sendgrid('udayaraj@travelpd.com',$subject,$msgbody,'info@travelfreeby.com',NULL,NULL,NULL);
	}
	public function visa_details_email($service_emails,$visadata){
		// echo 1;exit;
		$msgbody ='Dear Sir,<br /><br/>
		<div>Please find the list of the customers inquiring about (Visa) for the booking date: ' .date('d-M-Y',strtotime("-1 days")). '</div><br/><br/>';
		$msgbody.=$visadata;
		$msgbody.='<p>Do let us know the update of these requests.</p></div>
		<div>Thanks</div>
		<p>Shubh Mani Solutions Pvt Ltd</p>
		<p><a target="_blank" href="https://www.travelfreeby.com">https://www.travelfreeby.com</a></p><br/>';
		$subject = 'Visa Inquiries for '.date('d-M-Y',strtotime("-1 days")). ' from Travelfreeby';
		$this->sendgrid($service_emails[0]->reply_email,$subject,$msgbody,'info@travelfreeby.com',NULL,NULL,'info@travelfreeby.com');
	}
	public function sim_details_email($service_emails,$simdata){
		//echo '<pre>';print_r($service_emails);//exit;
		$msgbody ='Dear Sir,<br /><br/>
		<div>Please find the list of the customers inquiring about (SIM) for the booking date: ' .date('d-M-Y',strtotime("-1 days")). '</div><br/><br/>';
		$msgbody.=$simdata;
		$msgbody.='<p>Do let us know the update of these requests.</p></div>
		<div>Thanks</div>
		<p>Shubh Mani Solutions Pvt Ltd</p>
		<p><a target="_blank" href="https://www.travelfreeby.com">https://www.travelfreeby.com</a></p>';
		$msgbody.= '<div style="font-size:14px;">Book yourself on <a target="_blank" href="'.base_url().'">www.travelfreeby.com</a> at the Best Prices</div>
		<a target="_blank" href="https://www.travelfreeby.com/book/"><img src="https://www.travelfreeby.com/book/public/img/mail/image001.png"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="https://www.travelfreeby.com/book/"><img src="https://www.travelfreeby.com/book/public/img/mail/image002.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="http://www.travelfreeby.com/book-hotels/"><img src="https://www.travelfreeby.com/book/public/img/mail/image003.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="https://www.travelfreeby.com/book/bus/"><img src="https://www.travelfreeby.com/book/public/img/mail/image004.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="http://www.travelfreeby.com/book-cabs/"><img src="https://www.travelfreeby.com/book/public/img/mail/image005.jpg"></a><br>
		<a target="_blank" href="https://www.travelfreeby.com/book/"><img src="https://www.travelfreeby.com/book/public/img/mail/image006.jpg"></a> &nbsp;&nbsp;&nbsp;
		<img src="https://www.travelfreeby.com/book/public/img/mail/image007.png"><br><br>
		<div style="background:#000;display: table;width: 100%;"><a target="_blank" href="https://www.travelfreeby.com/book/" style="display: table-cell;vertical-align: middle;color: #fff;font-size: 14px;padding: 0 10px;">www.travelfreeby.com</a> <img src="http://www.travelfreeby.com/images/social.png" usemap="#socialmap" height="39" width="423" align="right" alt="fun-travel-deals-social-connections" title="Fun Travel Deals Social connections" style="display: table-cell;vertical-align: middle;padding: 0 10px;">
		<map name="socialmap">
		<area shape="rect" coords="0,0,38,39" href="https://play.google.com/store/apps/details?id=com.funtraveldeals" alt="Download Fun Travel Deals Android app" title="Download Fun Travel Deals Android app">
		<area shape="rect" coords="36,0,72,39" href="https://appworld.blackberry.com/webstore/content/27193878/?countrycode=IN" alt="Download Fun Travel Deals Blackberry app" title="Download Fun Travel Deals Blackberry app">
		<area shape="rect" coords="70,0,107,39" href="https://www.windowsphone.com/en-us/store/app/funtraveldeals/314eb54a-050a-4c5f-92e8-2e4be39742d2" alt="Download Fun Travel Deals Windows app" title="Download Fun Travel Deals Windows app">
		<area shape="rect" coords="100,0,140,39" href="https://www.facebook.com/travelfreeby" alt="Like us on Facebook" title="Like us on Facebook">
		<area shape="rect" coords="138,0,175,39" href="https://twitter.com/travelfreeby" alt="Follow us on Twitter" title="Follow us on Twitter">
		<area shape="rect" coords="173,0,210,39" href="https://plus.google.com/+Funtraveldeals/posts" alt="Follow us on Google+" title="Follow us on Google+">
		<area shape="rect" coords="208,0,245,39" href="https://www.linkedin.com/in/travelfreeby" alt="Follow us on LinkedIn" title="Follow us on LinkedIn">
		<area shape="rect" coords="243,0,281,39" href="https://www.travelfreeby.com/blog/" alt="Fun Travel Deals Blog" title="Fun Travel Deals Blog">
		<area shape="rect" coords="279,0,313,39" href="https://www.flickr.com/photos/funtraveldeals/" alt="Follow us on Flickr" title="Follow us on Flickr">
		<area shape="rect" coords="311,0,350,39" href="https://www.youtube.com/channel/UCn2kH_xLaBFmM-tDXBY3r5g" alt="Follow us on YouTube" title="Follow us on YouTube">
		<area shape="rect" coords="348,0,385,39" href="https://www.travelfreeby.com/blog/feed/" alt="Subscribe RSS Feeds of Fun Travel Deals" title="Subscribe RSS Feeds of Fun Travel Deals">
		<area shape="rect" coords="383,0,423,39" href="https://www.pinterest.com/funtraveldeals/" alt="Follow us on Pinterest" title="Follow us on Pinterest">
		</map>
		</div>';
		$subject ='SIM Inquiries for '.date('d-M-Y',strtotime("-1 days")). ' from Travelfreeby';
		$emails=explode(',', $service_emails[0]->customer_email);
		//echo '<pre>';print_r($emails);exit;
		foreach ($emails as $key => $value) {
			$this->sendgrid($value,$subject,$msgbody,$service_emails[0]->from_email,NULL,NULL,NULL,$service_emails[0]->reply_email);
		}
		
		// $this->sendgrid('udayaraj@travelpd.com',$subject,$msgbody,'info@travelfreeby.com',NULL,NULL);
	}

	public function forex_details_email($service_emails,$forexdata){
		// echo 1;exit;
		$url='https://www.travelfreeby/book/';
		$msgbody ='Dear Sir,<br /><br/>
		<div>Please find the list of the customers inquiring about (Forex) for the booking date: ' .date('d-M-Y',strtotime("-1 days")). '</div><br/><br/>';
		$msgbody.=$forexdata;
		$msgbody.='<p>Do let us know the update of these requests.</p></div>
		<div>Thanks</div>
		<p>Shubh Mani Solutions Pvt Ltd</p>
		<p><a target="_blank" href="https://www.travelfreeby">https://www.travelfreeby</a></p>';
		$subject = 'Forex Inquiries for '.date('d-M-Y',strtotime("-1 days")). ' from Travelfreeby';
		$msgbody.= '<div style="font-size:14px;">Book yourself on <a target="_blank" href="'.base_url().'">www.travelfreeby</a> at the Best Prices</div>
		<a target="_blank" href="'.$url.'"><img src="'.$url.'public/img/mail/image001.png"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="'.$url.'"><img src="'.$url.'public/img/mail/image002.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="http://www.travelfreeby/book-hotels/"><img src="'.$url.'public/img/mail/image003.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="'.$url.'bus/"><img src="'.$url.'public/img/mail/image004.jpg"></a> &nbsp;&nbsp;&nbsp;
		<a target="_blank" href="http://www.travelfreeby/book-cabs/"><img src="'.$url.'public/img/mail/image005.jpg"></a><br>
		<a target="_blank" href="'.$url.'"><img src="'.$url.'public/img/mail/image006.jpg"></a> &nbsp;&nbsp;&nbsp;
		<img src="'.$url.'public/img/mail/image007.png"><br><br>
		<div style="background:#000;display: table;width: 100%;"><a target="_blank" href="'.$url.'" style="display: table-cell;vertical-align: middle;color: #fff;font-size: 14px;padding: 0 10px;">www.travelfreeby</a> <img src="http://www.travelfreeby/images/social.png" usemap="#socialmap" height="39" width="423" align="right" alt="fun-travel-deals-social-connections" title="Fun Travel Deals Social connections" style="display: table-cell;vertical-align: middle;padding: 0 10px;">
		<map name="socialmap">
		<area shape="rect" coords="0,0,38,39" href="https://play.google.com/store/apps/details?id=com.funtraveldeals" alt="Download Fun Travel Deals Android app" title="Download Fun Travel Deals Android app">
		<area shape="rect" coords="36,0,72,39" href="https://appworld.blackberry.com/webstore/content/27193878/?countrycode=IN" alt="Download Fun Travel Deals Blackberry app" title="Download Fun Travel Deals Blackberry app">
		<area shape="rect" coords="70,0,107,39" href="https://www.windowsphone.com/en-us/store/app/funtraveldeals/314eb54a-050a-4c5f-92e8-2e4be39742d2" alt="Download Fun Travel Deals Windows app" title="Download Fun Travel Deals Windows app">
		<area shape="rect" coords="100,0,140,39" href="https://www.facebook.com/travelfreeby" alt="Like us on Facebook" title="Like us on Facebook">
		<area shape="rect" coords="138,0,175,39" href="https://twitter.com/travelfreeby" alt="Follow us on Twitter" title="Follow us on Twitter">
		<area shape="rect" coords="173,0,210,39" href="https://plus.google.com/+Funtraveldeals/posts" alt="Follow us on Google+" title="Follow us on Google+">
		<area shape="rect" coords="208,0,245,39" href="https://www.linkedin.com/in/travelfreeby" alt="Follow us on LinkedIn" title="Follow us on LinkedIn">
		<area shape="rect" coords="243,0,281,39" href="https://www.travelfreeby/blog/" alt="Fun Travel Deals Blog" title="Fun Travel Deals Blog">
		<area shape="rect" coords="279,0,313,39" href="https://www.flickr.com/photos/funtraveldeals/" alt="Follow us on Flickr" title="Follow us on Flickr">
		<area shape="rect" coords="311,0,350,39" href="https://www.youtube.com/channel/UCn2kH_xLaBFmM-tDXBY3r5g" alt="Follow us on YouTube" title="Follow us on YouTube">
		<area shape="rect" coords="348,0,385,39" href="https://www.travelfreeby/blog/feed/" alt="Subscribe RSS Feeds of Fun Travel Deals" title="Subscribe RSS Feeds of Fun Travel Deals">
		<area shape="rect" coords="383,0,423,39" href="https://www.pinterest.com/funtraveldeals/" alt="Follow us on Pinterest" title="Follow us on Pinterest">
		</map>
		</div>';
		$emails=explode(',', $service_emails[0]->customer_email);
		foreach ($emails as $key => $value) {
		$this->sendgrid($value,$subject,$msgbody,$service_emails[0]->from_email,NULL,NULL,NULL,$service_emails[0]->reply_email);
	}
		// $this->sendgrid('udayaraj@travelpd.com',$subject,$msgbody,'admin@travelfreeby',NULL,NULL);
	}
}
/* End of file Home.php */
																		/* Location: ./application/modules/Home.php */