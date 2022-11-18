<?php

//	error_reporting(E_ALL);
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Smsgateway extends MX_Controller {
	
	private $post_url;
	private $username;
	private $password;
	private $sender_id;
	
	public function __construct() {
		parent::__construct();
		$this->post_url = 'http://182.18.163.39';
		$this->username = 'BizzMirth Holidays';
		$this->password = 'BizzMirth Holidays';
		$this->sender_id = 'BizzMirth Holidays';	 
	}

	/*public function flightbooking($booking_info,$mobile,$booking_info_r){
		// echo $mobile;exit;
		$DepartureDateTime=explode(',',$booking_info->DepartureDateTime);
		$DepartureDateex=explode('T',$DepartureDateTime[0]);		
		$airlinename= $booking_info->OperatingAirline_FlightNumber;
		$pnr = $booking_info->pnr;
		$flightnumber = $booking_info->FlightNumber;
		$departdate = date('d-M-Y',strtotime($DepartureDateex[0]));
		$departtime = $DepartureDateex[1];
		$origin = $booking_info->Departure_LocationCode;
		$destination = $booking_info->Arrival_LocationCode;
		

		$post_data = array(
	    // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
	    // For promotional, this will be ignored by the SMS gateway
	    'From'   => '08033946052',
	    'To'    => $mobile,
	    'Body'  => 'Dear Smart Flyer ,'.$airlinename.' is delighted to confirm your booking.Your PNR is '.$pnr.' for your flight '.$flightnumber.' departing on '.$departdate.' at '.$departtime.' from '.$origin.' to '.$destination.' .Pls report 2 hrs prior to departure for check-in.',   
		);

		if ($booking_info->Trip_Type == 'R' && $booking_info->DirectionInd == 1) {
			$DepartureDateTimer=explode(',',$booking_info_r->DepartureDateTime);
			$DepartureDateexr=explode('T',$DepartureDateTimer[0]);		
			$airlinenamer= $booking_info_r->OperatingAirline_FlightNumber;
			$pnrr = $booking_info_r->pnr;
			$flightnumberr = $booking_info_r->FlightNumber;
			$departdater = date('d-M-Y',strtotime($DepartureDateexr[0]));
			$departtimer = $DepartureDateexr[1];
			$originr = $booking_info_r->Departure_LocationCode;
			$destinationr = $booking_info_r->Arrival_LocationCode;

			$post_data = array(
		    // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
		    // For promotional, this will be ignored by the SMS gateway
		    'From'   => '08033946052',
		    'To'    => $mobile,
		    'Body'  => 'Dear Smart Flyer ,'.$airlinename.' is delighted to confirm your booking.Your PNR is '.$pnr.' for your flight '.$flightnumber.' departing on '.$departdate.' at '.$departtime.' from '.$origin.' to '.$destination.' .Your return details are, '.$airlinenamer.' is delighted to confirm your booking.Your PNR is '.$pnrr.' for your flight '.$flightnumberr.' departing on '.$departdater.' at '.$departtimer.' from '.$originr.' to '.$destinationr.' .Pls report 2 hrs prior to departure for check-in',   
			);
		}


		  // echo '<pre>';print_r($post_data);exit;
		$this->executerequest($post_data);
	}*/

	public function sendOtp($username){
		$setOtp = $this->getOtp(6);
		$data = array(
			'user_mobile' => $username,
			'message' => $setOtp.' is the OTP for your mobile verification on MyTripPartner. This OTP will be valid for 15 minutes'
		);
		$otp = $this->executerequest($data);

		if($otp != '')
			return $setOtp;
		else
			return '';
	}

	function getOtp($n=6){
        $generator = "1357902468"; 
        $result = ""; 
        for ($i = 1; $i <= $n; $i++) { 
            $result .= substr($generator, (rand()%(strlen($generator))), 1); 
        } 
        // Return result 
        return $result; 
    }

	public function executerequest($post_data){
		$url = $this->post_url.'/spanelv2/api.php?username='.$this->username.'&password='.$this->password.'&to='.$post_data['user_mobile'].'&from='.$this->sender_id.'&message='.urlencode($post_data['message']);

		$ret = file($url);

		// echo '<pre>';print_r($ret);
		return $ret[0];
	}

	function sendSMS($post_data){  
	 	// echo 1;exit;
	 $user = "O1y4qz6QvEirxbrmPubk0g";  
	 $url = 'http://login.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$user.'&senderid=BIZLTD&channel=INT&DCS=0&flashsms=0&number='.$postdata['mobile'].'&text='.$postdata['message'].'&route=16;';  
	 // https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=yourapicode&senderid=TESTIN&channel=2&DCS=0&flashsms=0&number=91989xxxxxxx&text=test message&route=clickhere

	 $ch=curl_init($url);  
	 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
	 curl_setopt($ch,CURLOPT_POST,1);  
	 curl_setopt($ch,CURLOPT_POSTFIELDS,"");  
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);  
	 $data = curl_exec($ch);  
	 // print($data); /* result of API call*/ 
	 if($data){
	 	return true;
	 } else {
	 	return false;
	 }
	 
	 }  


}	