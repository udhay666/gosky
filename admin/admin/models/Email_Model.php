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
		 $this->client_name = 'bizzholidays';
        
	   //$this->from_email = 'webinfo@bizzholidays.com';
	   
        $this->web_link = 'www.bizzholidays.com';
        $this->admin_email = 'Ann@travelpd.com';
        //$this->from = 'webinfo@bizzholidays.com';
        $this->ashok = 'ashok@travelpd.com';
        $this->basanth = 'basanth@travelpd.com';
	//	$this->query='web.query@bizzholidays.com';
		$this->footer='Warm Regards,<br>
Customer Care – bizzholidays<br><br><br>
<a href="#"><img src="' . $this->web_link . '/public/img/logo.png" height="60" width="150" /></a><br><br><br>Follow us ::<a href="https://www.facebook.com/bizzholidays"><img width="38" src="' . $this->web_link . '/public/img/fbshare.png"></a>&nbsp;<a href="https://twitter.com/akbar_Tours"><img width="38" src="' . $this->web_link . '/public/img/twittershare.png"></a>&nbsp;<a href="https://www.linkedin.com/company/1072406"><img width="38" src="' . $this->web_link . '/public/img/lnshare.png"></a>';
$this->special_msg='<br><br>This message is for the designated recipient only and may contain privileged, proprietary, or otherwise private information. If you have received it in error,<br> please notify the sender immediately and delete the original. Any other use of the email by you is prohibited';       
	  
       
        $this->supportemail = 'webinfo@bizzholidays.com';
        $this->phone = '+91 8552826699';
        $this->phone1='+91 8552826699';
        $this->me = 'ashok@travelpd.com';
	  
	       $this->head = 'bizzholidays';
        $this->weburl = 'www.bizzholidays.com';

        $this->from = 'noreply@bizzholidays.com';
        $this->config = Array(
            'protocol' => 'sendemail',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => '465',
            'smtp_user' => 'noreply@bizzholidays.com',
            'smtp_pass' => 'Hond@1234',
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


public function registration_conformation($data) {

       //echo "hi";exit;
        $msgbody = 'Dear, ' . $data['title'] . ' ' . ucfirst($data['first_name']) . '

        <p>
           Congratulations on registering with bizzholidays as an Agent<br>
           Your Account will be activated in 24 hours and you will be notified about the same through an email.<br>

       </p>
       <div>Login Details :
          <p>UserName : ' . $data['agent_email'] . '</p>
          <p>Password : ' . $data['password'] . '</p> 
      </div>
      <div>If you want login, Please  <a href="http://' . $this->weburl . '/b2b/">click here</a>
      </div>
      <div>';

        $msgbody.='<br />A bizzholidays Account will give you the following benefits<br/>
        •	Keep track of all your past and current booking details, schedules and more <br>
        •	Print/email vouchers & invoices <br>
        •	Cancel bookings online <br>
        •	Know your refund details before you cancel <br>
        •	And more... <br><br />
        For any For any further assistance and urgent queries please contact our customer support at +91 8552826699 
        <br>or email us at enquiry@bizzholidays.com<br>
        Warm Regards,<br>
        Customer Care – bizzholidays<br><br>
        <img src="' . $this->web_link . '/public/img/logo.png" height="100" width="200" /><br /><br />
        ';
        $msgbody.='<br>Follow us ::<img width="38" src="' . $this->web_link . '/public/img/fbshare.png">&nbsp;
        <img width="38" src="' . $this->web_link . '/public/img/twittershare.png">&nbsp;
        <img width="38" src="' . $this->web_link . '/public/img/lnshare.png"><br>';
        $msgbody.='This message is for the designated recipient only and may contain privileged, proprietary,<br>
        or otherwise private information. If you have received it in error, please notify the sender immediately and delete the original. <br>
        Any other use of the email by you is prohibited. www.bizzholidays.com<br><br>';


        $subject = 'Agent Registration Confirmation';
        $this->send($data['agent_email'], $subject, $msgbody);

        $this->send('ashok@travelpd.com', $subject, $msgbody);
        //$this->send('Ann@travelpd.com', $subject, $msgbody);


        $subject = 'Agent Account Confirmation';
        //$this->send($data['user_email'], $subject, $msgbody);
        //$this->send('Ann@travelpd.com', $subject, $msgbody);
        $this->send('ashok@travelpd.com', $subject, $msgbody);

        $msgbody = 'Dear Admin,
        <br />

        <div align="center" style="color:#F90;">New Agency  has registered with our service</div>
        <br />
        Email Id : ' . $data['agent_email'] . '<br />
        <br />
        <table width="500" border="1" cellpadding="5" cellspacing="5" align="center">
         <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Date</th>
      </tr>
      <tr>
          <td>' . ucfirst($data['first_name']) . '</td>
          <td>' . $data['agent_email'] . '</td>
          <td>' . date("d/m/Y") . '</td>
      </tr>
          </table>';
          $msgbody.='Thanking You,<br>
          Customer Care – bizzholidays<br><br>
          <img src="' . $this->web_link . '/public/img/logo.png" height="100" width="200" /><br /><br />
          ';
          $msgbody.='<br>Follow us ::<img width="38" src="' . $this->web_link . '/public/img/fbshare.png">&nbsp;
          <img width="38" src="' . $this->web_link . '/public/img/twittershare.png">&nbsp;
          <img width="38" src="' . $this->web_link . '/public/img/lnshare.png"><br>';

          $msgbody.='This message is for the designated recipient only and may contain privileged, proprietary,<br>
          or otherwise private information. If you have received it in error, please notify the sender immediately and delete the original. <br>
          Any other use of the email by you is prohibited. www.bizzholidays.com<br><br>';

        $subject = 'New Agent Registration Intimation';
        $this->send('Ann@travelpd.com', $subject, $msgbody);
        $this->send('ashok@travelpd.com', $subject, $msgbody);
        //echo $msgbody;exit;

}





    public function deposit_approve_mail($agent_no, $available_balance, $dep_amt, $agency_name, $agent_email) {
        $curr_date = date("d/m/Y");

        $mess = '<h3>Deposit Approval for &nbsp;' . $agency_name . '(Agent No : ' . $agent_no . '):: ' . $this->client_name . ' </h3>

            <br />
            <br />

            Your deposit request as been approved <br />
            <br />

            <div align="center" style="color:#F90;">Deposit approval :: <a href="' . $this->web_link . '">' . $this->client_name . '</a></div>
            <table width="500" border="1" cellpadding="5" cellspacing="5" align="center">
              <tr>
                <th>Agency Name</th>
                <th>Agency Number</th>
                <th>Approved Amount</th>
                <th>Available Balance</th>
                <th>Approved Date</th>
              </tr>
              <tr>
                <td>' . $agency_name . '</td>
                <td>' . $agent_no . '</td>
                      <td>' . $dep_amt . '</td>
                <td>' . $available_balance . '</td>
                       <td>' . $curr_date . '</td>
              </tr>
            </table>
            <br>

            ' . $this->footer;
                    $mess_admin = '<h3>Deposit Approval for &nbsp;' . $agency_name . '(Agent No : ' . $agent_no . '):: ' . $this->client_name . ' </h3>

            <br />
            <br />
            Dear Admin,<br>
            Deposit request as been approved for ' . $agency_name . ' <br />
            <br />

            <div align="center" style="color:#F90;">Deposit approval :: <a href="' . $this->web_link . '">' . $this->client_name . '</a></div>
            <table width="500" border="1" cellpadding="5" cellspacing="5" align="center">
              <tr>
                <th>Agency Name</th>
                <th>Agency Number</th>
                <th>Approved Amount</th>
                <th>Available Balance</th>
                <th>Approved Date</th>
              </tr>
              <tr>
                <td>' . $agency_name . '</td>
                <td>' . $agent_no . '</td>
                <td>' . $dep_amt . '</td>
                <td>' . $available_balance . '</td>
                <td>' . $curr_date . '</td>
              </tr>
            </table>
            <br>

            ' . $this->footer;


                    $subject = 'Deposit Approval';
                    $this->send($agent_email, $subject, $mess);
                    $this->send($this->admin_email, $subject, $mess_admin);
                    $this->send($this->me, $subject, $mess_admin); 
                    $this->send('Ann@travelpd.com', $subject, $mess_admin); 
                }

                public function deposit_decline_mail($agent_no, $agency_name, $agent_email) {
                    $curr_date = date("d/m/Y");

                    $mess = '<h3>Deposit Request from &nbsp;' . $agency_name . '(Agent No : ' . $agent_no . '):: ' . $this->client_name . ' </h3>

            <br />
            <br />

            Your deposit request as been declined <br />
            <br />

            Regards,<br>
            ' . $this->client_name;
                    $mess_admin = '<h3>Deposit Request from &nbsp;' . $agency_name . '(Agent No : ' . $agent_no . '):: ' . $this->client_name . ' </h3>

            <br />
            <br />
            Dear Admin,<br>
            Deposit request as been declined for ' . $agency_name . '<br />
            <br />


            ' . $this->footer;

                    $subject = 'Deposit Decline';
                    $this->send($agent_email, $subject, $mess);
                    $this->send($this->admin_email, $subject, $mess_admin);
                    $this->send($this->me, $subject, $mess_admin); 
                    $this->send('Ann@travelpd.com', $subject, $mess_admin); 
                }

                public function admin_transaction_mail($email_info) {
                    $curr_date = date("d/m/Y");

                    $mess = '<h3>Admin Transaction for &nbsp;' . $email_info['agency_name'] . '(Agent No : ' . $email_info['agent_no'] . '):: ' . $this->client_name . ' </h3>

            <br />
            <br />


            <br />

            <div align="center" style="color:#F90;">Admin Transaction :: <a href="' . $this->web_link . '">' . $this->client_name . '</a></div>
            <table width="500" border="1" cellpadding="5" cellspacing="5" align="center">
              <tr>
                <th>Agency Name</th>
                <th>Agency Number</th>
                <th>Transaction type</th>
                <th>Amount</th>
                <th>Date</th>
              </tr>
              <tr>
                <td>' . $email_info['agency_name'] . '</td>
                <td>' . $email_info['agent_no'] . '</td>
                      <td>' . $email_info['trans_type'] . '</td>
                <td>' . $email_info['amount'] . '</td>
                       <td>' . $curr_date . '</td>
              </tr>
            </table>
            <br>

            ' . $this->footer;

        $subject = 'Admin Transaction';
        $this->send($email_info['email'], $subject, $mess);
        $this->send($this->admin_email, $subject, $mess);
        $this->send($this->me, $subject, $mess_admin); 
}




public function status_email_agent($info) {
	//echo 'email in';exit;
        $curr_date = date("d/m/Y");

        $mess = 'Dear '.$this->client_name.'<br><br>
		Your bizzholidays account with the below mentioned credentials is deactivated.<br>
<br /><br />
Login Details<br><br>

<table width="500" border="1" cellpadding="5" cellspacing="5" align="center">
  <tr>
    <th>Agency Name</th>
    <th>Agency Number</th>
    <th>Status</th>
  
    <th>Date</th>
  </tr>
  <tr>
    <td>' . $info['agency_name'] . '</td>
    <td>' . $info['agent_no'] . '</td>
          <td>' . $info['status'] . '</td>
  
           <td>' . $curr_date . '</td>
  </tr>
</table>
<br>

';
 $mess.='<br />A bizzholidays Account will give you the following benefits<br/>
								•	Keep track of all your past and current booking details, schedules and more <br>
								•	Print/email vouchers & invoices <br>
								•	Cancel bookings online <br>
								•	Know your refund details before you cancel <br>
								•	And more... <br><br />
	For any For any further assistance and urgent queries please contact our customer support at +91 8552826699 
	<br>or email us at enquiry@bizzholidays.com<br>
			Warm Regards,<br>
			Customer Care – bizzholidays<br><br>
<img src="' . $this->web_link . '/public/img/logo.png" height="100" width="200" /><br /><br />
';

 $mess.='<br>Follow us ::<img width="38" src="' . $this->web_link . '/public/img/fbshare.png">&nbsp;
		<img width="38" src="' . $this->web_link . '/public/img/twittershare.png">&nbsp;
		<img width="38" src="' . $this->web_link . '/public/img/lnshare.png"><br>';
	   $mess.='This message is for the designated recipient only and may contain privileged, proprietary,<br>
 or otherwise private information. If you have received it in error, please notify the sender immediately and delete the original. <br>
 Any other use of the email by you is prohibited. www.bizzholidays.com<br><br>';
 
        $subject = 'Agent Account Status';
        $this->send($info['email'], $subject, $mess);
        $this->send($this->admin_email, $subject, $mess);
        $this->send($this->me, $subject, $mess); 
		$this->send('Ann@travelpd.com', $subject, $mess); 
		$this->send('ashok@travelpd.com', $subject, $mess); 
		 
		//echo $this->email->print_debugger();
		
    }

    public function status_email_user($info) {
      //  echo '<pre>';print_r($info);exit;
        $curr_date = date("d/m/Y");

        $mess = '<h3>Registration Status of &nbsp;' . $info['title'] . '.' . $info['first_name'] . '&nbsp;:: ' . $this->client_name . ' </h3>

<div align="center" style="color:#F90;">Registration Status :: <a href="' . $this->web_link . '">' . $this->client_name . '</a></div>
<table width="500" border="1" cellpadding="5" cellspacing="5" align="center">
  <tr>
    <th>User Name</th>
    <th>User Email</th>
    <th>Status</th>
  
    <th>Date</th>
  </tr>
  <tr>
    <td>' . $info['title'] . '.' . $info['first_name'] . '</td>
    <td>' . $info['user_email'] . '</td>
          <td>' . $info['status'] . '</td>
           <td>' . $curr_date . '</td>
  </tr>
</table>
<br>

' . $this->footer;

        $subject = 'Registration_Status';
        $this->send($info['user_email'], $subject, $mess);
        $this->send($this->admin_email, $subject, $mess);
        $this->send($this->me, $subject, $mess); 
		$this->send('ashok@travelpd.com', $subject, $mess); 
		 
    }

    function ticket_cancel_email($Book_reference, $Book_CreationDate, $Status, $email) {
        $msgbody.= '
            <div>
    <div>
        <h2>Hotel Cancellation Details :: ' . $this->client_name . ' </h2>
        <table width="500" border="1" cellpadding="5" cellspacing="5" align="center">
          
            <tr>
                <td>Booking Reference</td>
                <td>' . $Book_reference . '</td>
            </tr>
                     <tr>
                <td>BookingDate</td>
                <td>' . $Book_CreationDate . '</td>
            </tr>
                <tr>
                <td>Email</td>
                <td>' . $email . '</td>
            </tr>
            
                         <tr>
                <td>Status</td>
                <td>' . $Status . '</td>
            </tr>
            </tr>
                
        </table>
    </div>
</div>

' . $this->footer;
        $subject = 'Ticket Cancellation';
        $this->send($email, $subject, $mess);
        $this->send($this->admin_email, $subject, $mess);
        $this->send($this->me, $subject, $mess_admin); 
		$this->send('ashok@travelpd.com', $subject, $mess_admin); 
		 

        //echo $this->email->print_debugger();
        //exit;
    }

    public function email_testing() {
        //echo 'testing';exit;
        echo $msgbody = $this->footer;
        $subject = 'going';
        $this->send($this->me, $subject, $msgbody);
        echo $this->email->print_debugger();
    }

}
