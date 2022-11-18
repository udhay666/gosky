<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Tbo_Model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    function get_tbo_credentials() {
        $this->db->select('*');
        $this->db->from('api_info');
        $this->db->where('api_name', 'tbo');
        $this->db->where('service_type', 2);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }
    function delete_flight_temp_result($sess_id) {
        $this->db->where('session_id', $sess_id);
        $this->db->delete('flight_search_result');
    }
    function insert_flight_temp_results($flightResultsData) {
        $this->db->insert_batch('flight_search_result', $flightResultsData);
        return $this->db->insert_id();
    }

    function fetch_search_result($ses_id,$unique_id,$triptype) {
        // ,$min_depart,$max_depart,$min_arrive, $max_arrive,$minDuration,$maxDuration,$minimum_price, $maximum_price
        // $resultdata=$this->fetch_search_resultprocedure($ses_id,$unique_id, $triptype,$stops);
        // return $resultdata;
        // exit;
        // $this->db->select('*');
         $this->db->select('operating_airlinecode,operating_airlinename,operating_flightno,operating_airportname_o,
            operating_airportname_d,operating_deptime,operating_arritime,operating_cityname_o,operating_cityname_d,
            operating_terminal_o,nonrefundable,operating_fareclass,operating_terminal_d,isdomestic,duration,origin,stops,stops2,destination,search_id,segmentkey,basefare,
            tax,total_amount,session_id,uniquerefno,net_amount,currency,faretype,admin_markup,agent_markup,payment_charge,tripindicator,seats,baggageinformation,roundtrip,segment_indicator');
       // $this->db->from('tbo_flight_search_result');
        $this->db->from('flight_search_result');
        $this->db->where('session_id', $ses_id);
        $this->db->where('uniquerefno', $unique_id);       
        
       
       $this->db->limit('100');
       $this->db->where('roundtrip', $triptype);
       $this->db->order_by('total_amount', 'ASC');
          //$this->db->order_by('total_amount', 'ASC');
         
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function morefare($flightno,$session_id,$uniquerefno)
    {
        $where = ['faretype IS NOT NULL'];
        $this->db->select('*');        
        $this->db->from('flight_search_result');
        $this->db->where('session_id', $session_id);
        $this->db->where('uniquerefno', $uniquerefno);
        $this->db->where('operating_flightno', $flightno);
        $this->db->where(array('faretype !=' => ''));

        $this->db->order_by('total_amount', 'ASC');

        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() == 3) {
            return $query->result();
        }

    
    }

    function fetch_search_result_filter($ses_id,$unique_id,$triptype,$stops,$fares,$minDuration,$maxDuration,
    $min_depart,$max_depart,$min_arrive, $max_arrive,$brands,$minimum_price, $maximum_price) {
        // ,$min_depart,$max_depart,$min_arrive, $max_arrive,$minDuration,$maxDuration,$minimum_price, $maximum_price
        // $resultdata=$this->fetch_search_resultprocedure($ses_id,$unique_id, $triptype,$stops);
        // return $resultdata;
        // exit;
        // $this->db->select('*');
         $this->db->select('operating_airlinecode,operating_airlinename,operating_flightno,operating_airportname_o,
            operating_airportname_d,operating_deptime,operating_arritime,operating_cityname_o,operating_cityname_d,
            operating_terminal_o,nonrefundable,operating_fareclass,operating_terminal_d,isdomestic,duration,origin,stops,destination,search_id,segmentkey,basefare,
            tax,total_amount,net_amount,currency,admin_markup,agent_markup,payment_charge,tripindicator,seats,baggageinformation,roundtrip,segment_indicator');
       // $this->db->from('tbo_flight_search_result');
        $this->db->from('flight_search_result');
        $this->db->where('session_id', $ses_id);
        $this->db->where('uniquerefno', $unique_id);
        
        //$this->db->where('tripindicator', $triptype);

        if(!empty($stops) && isset($stops)){
            $result_string =$stops;   
            $stop_filter = implode("','", $stops);
            $str1 = str_replace("\'", "'", $stops);
            $this->db->where_in('stops2', $str1);
       }

       
 //$this->db->where("duration BETWEEN '$minDuration' AND '$maxDuration'");
        //$this->db->where('tripindicator', $triptype);
        if(isset($minimum_price, $maximum_price) && !empty($minimum_price) &&  !empty($maximum_price))
        {     
            $this->db->where("net_amount BETWEEN $minimum_price AND $maximum_price");
        }
        if(isset($minDuration, $maxDuration) && !empty($minDuration) &&  !empty($maxDuration))
        {       
          $this->db->where("duration BETWEEN $minDuration AND $maxDuration");
        }

        if(!empty($fares)&&isset($fares)){
            $fare_filter = implode("','", $fares);
            $str = str_replace("\'", "'", $fares);
            $this->db->where_in('nonrefundable', $str);

        }

     
       if(!empty($brands) && isset($brands)){        
        //$result_string =$brands;       
        $brands_filter = implode("','", $brands);
        $strs = str_replace("\'", "'", $brands);
        $this->db->where_in('operating_airlinecode', $strs);
        }
     
       if(isset($min_depart, $max_depart) && !empty($min_depart) &&  !empty($max_depart))
       {
         
         $this->db->where("DATE_FORMAT(operating_deptime,'%H:%i') BETWEEN '$min_depart' AND '$max_depart'");
       }
       if(isset($min_arrive, $max_arrive) && !empty($min_arrive) &&  !empty($max_arrive))
       {
       
         $this->db->where("DATE_FORMAT(operating_arritime,'%H:%i') BETWEEN '$min_arrive' AND '$max_arrive'");
       }
       
       
       $this->db->limit('100');
       $this->db->where('roundtrip', $triptype);
       $this->db->order_by('total_amount', 'ASC');
          //$this->db->order_by('total_amount', 'ASC');
         
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function fetch_search_resultprocedure($ses_id,$unique_id, $triptype) {
       $sql="CALL GetFlightResult('$ses_id','$unique_id','$triptype')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $resultdata=$query->result();
        }else{
            $resultdata='';
        }
        $query->next_result(); 
        $query->free_result(); 
        return $resultdata;
    }

    function get_flight_search_result($searchId) {
        $this->db->select('*');
        $this->db->from('flight_search_result');
        //$this->db->where('session_id', $sess_id);
        $this->db->where('search_id', $searchId);
        // $this->db->where('DirectionInd', 'OneWay');
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }
    function updatefare_quote($insertfarequoteData, $search_id) {
        $this->db->where('search_id', $search_id);
        $this->db->update('flight_search_result', $insertfarequoteData);
//echo $this->db->last_query();exit;
    }
    function get_airport_cityname($airport_code) {
        $this->db->select('city_name');
        $this->db->from('tbo_flight_city');
        $this->db->where('city_code', $airport_code);
        $this->db->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $res = $query->row();
            $airport_city = $res->city_name;
        } else {
            $airport_city = '';
        }

        return $airport_city;
    }
    function getDate_TimeFromDateTime($DateTime, $type) {
        $DateTime_string = preg_replace("/[T]/", " ", $DateTime);
        list($Date, $Time) = explode(" ", $DateTime_string);

        if ($type == 'date') {
            return $Date;
        } else if ($type == 'time') {
            return date('h:i A', strtotime($Time));
        } else if ($type == 'mins') {
            list($h, $m, $s) = explode(":", $Time);
            return ($h * 60) + $m;
        }
    }

    function insert_booking_report($ezeeRefNo, $BookingId, $PNR, $BookingStatus, $flight_result, $Ticket_Number,$pass,$total_amount=0) {
        if ($flight_result->triptype == 'oneway')
            $MODE = 'Onward';
        else if ($flight_result->triptype == 'round')
            $MODE = 'Return';

        /*$agent_id=$this->session->agent_id;
        $agent_no=$this->session->agent_no;   */

        if($this->session->userdata('user_logged_in'))
        {
            $user_id = $this->session->userdata('user_id');            
            $agent_id=0;
        }elseif(empty($this->session->userdata('user_logged_in'))){
           $user_id = 0;
            $agent_id=0;
        }
        else
        {
            $user_id = 0;
            $agent_id=$this->session->agent_id;           
            
        } 
        // echo 1;
        // print_r($this->session->all_userdata());exit;
  //      print $agent_id."test".$user_id;
        if ($this->session->userdata('user_logged_in')) {
            $user_id = $this->session->userdata('user_id');
            $agent_id = 0;
        }elseif (empty($this->session->userdata('user_logged_in') && $this->session->userdata('agent_logged_in'))) {
            if ($this->session->userdata('corporate_sub_logged_in')) {
                $corporate_user_id = $this->session->userdata('corporate_sub_logged_in');
            }else{
                $corporate_user_id = 0;
            }
            $agent_id = 0;
            $user_id = 0;
        } else {
            $user_id = 0;
        }
        if ($this->session->userdata('agent_logged_in') ) {
                // echo 1;exit;
            $user_id = 0;
            $agent_id = $this->session->userdata('agent_id');
            } else {
                $agent_id = 0;
            }
        // echo $agent_id;exit;
        $passenger_info = $this->session->userdata('passenger_info');
		$promotional_discount = 0;
		$promotional_code = '';
		// if(!empty($passenger_info['user_promotional']) && $pass == '1' && !$this->session->userdata('agent_logged_in')) {
		// 	$promotional_code = $passenger_info['user_promotional'];
		// 	$promtional = $this->get_promotional_code($promotional_code);
		// 	if(empty($promtional)) {
		// 	} else {
		// 		$service = explode(',',$promtional->service_type);
		// 		if(in_array(2,$service)) {
		// 			$expire = $promtional->promo_expire;
		// 			if(strtotime($expire) >= strtotime(date('Y-m-d'))) {
		// 				//$promotional_discount = ($flight_result->total_amount * ($promtional->discount / 100));
		// 				//$promotional_discount = ($total_amount * ($promtional->discount / 100));
		// 				if($promtional->amount_min > 0 && $promtional->amount_max > 0) {						
		// 					if($total_amount >= $promtional->amount_min && $total_amount <= $promtional->amount_max) {
		// 						$promotional_discount = $promtional->discount;
		// 					}
		// 				} else {
		// 					$promotional_discount = $promtional->discount;
		// 				}
		// 			} 
		// 		} 
		// 	}					
		// }		
        if($flight_result->roundtrip==2){
            $MODE='Return';
        }else{
            $MODE='Onward';
        }
        $insertdata = array('user_id' => $user_id,
            'agent_id' => $agent_id,
            'corporate_subadmin_id'=> $corporate_user_id,
            'uniqueRefNo' => $ezeeRefNo,
            'BookingReferenceId' => $BookingId,
            'BookingStatus' => $BookingStatus,
            'Ticket_Number' => $Ticket_Number,
            'AirlinePNR' => $PNR,
            'api' => 'tbo',
            'isdomestic'=>$flight_result->isdomestic,
            'Origin' => $flight_result->origin,
            'Destination' => $flight_result->destination,
            'Adults' => $flight_result->adults,
            'Childs' => $flight_result->childs,
            'Infants' => $flight_result->infants,
            'DirectionInd' => $flight_result->tripindicator,
            'Booking_Date' => date("Y-m-d"),
            'Duration' => $flight_result->duration,
            'DepartureDateTime' => $flight_result->operating_deptime,
            'ArrivalDateTime' => $flight_result->operating_arritime,
            'Duration' => $flight_result->duration,
            'FlightNumber' => $flight_result->operating_flightno,
            'FareType' => $flight_result->nonrefundable,
            'ResBookDesigCode' => '',
            // 'Cabin' => '',
            // 'Meal' => '', 
            'meal_code' => $flight_result->nonrefundable, 
            'meal_price' => $flight_result->meal_price, 
            'meal_desc' => $flight_result->meal_desc, 
            'baggage_code' => $flight_result->baggage_code, 
            'baggage_weight' => $flight_result->baggage_weight, 
            'Baggage' => $flight_result->baggageinformation, 
            'baggage_price' => $flight_result->baggage_price, 
            'segment_indicator' => $flight_result->segment_indicator,
            'Departure_LocationCode' => $flight_result->operating_cityname_o,
            'Arrival_LocationCode' => $flight_result->operating_cityname_d,
            //'AirEquipType' => '',
            'OperatingAirline_Code' => $flight_result->operating_airlinecode,
            'OperatingAirline_FlightNumber' => $flight_result->operating_airlinename,
            // 'StopQuantity' => '',
            'Stops' => $flight_result->stops2,
            'BaseFare' => $flight_result->basefare,
            // 'CurrencyCode' => $flight_result->currency,
            // 'EquivFare' => $flight_result->basefare,
            'CurrencyCode' => $flight_result->currency,
            'TotalTax' => $flight_result->tax,
            // 'Tax_Code' => '',
			'netfare' => $flight_result->net_amount,
            'TotalFare' => $flight_result->total_amount,
            // 'PassengerType' => '',
            // 'PassengerQuantity' => '',
            // 'PassengerBaseFare' => '',
            // 'PassengerEquivFare' => '',
            // 'PassengerTotalTax' => '',
            // 'PassengerTotalFare' => '',
            'OriginTerminal' => $flight_result->operating_terminal_o,
            'DestinationTerminal' => $flight_result->operating_terminal_d,
            'Payment_Charge' => $flight_result->payment_charge,
            'Admin_Markup' => $flight_result->admin_markup,
            'Agent_Markup' => $flight_result->agent_markup,
            'Distributors' => $flight_result->distributors,
            'Trip_Type' => $flight_result->triptype,
            'mode' => $MODE,
			// 'Promotional_Discount' => $promotional_discount,			
			// 'Promotional_Code' => $promotional_code,	
            'Promotional_Discount' => $flight_result->promo_discount,            
            'Promotional_Code' =>$flight_result->promo_code,        		
            //'Remarks' => '',
        );

        $this->db->insert('flight_booking_reports', $insertdata);
      //echo $this->db->last_query(); exit;
        $booking_id = $this->db->insert_id();

        return $booking_id;
    }

    function insert_booking_passenger_info($ezeeRefNo, $BookingId ,$isdomestic) {
        $passenger_info = $this->session->passenger_info;
        $pax_ticket = $this->session->flight_pax_tickets;
        // echo '<pre/>';print_r($passenger_info);exit;
        $adultTitle = $passenger_info['selTitle'];
        $adultFName = $passenger_info['first_name'];
        $adultLName = $passenger_info['last_name'];
        //$adultGender = $passenger_info['adultGender'];		

        $adultDOBDate = $passenger_info['txtdobD'];
        $adultDOBMonth = $passenger_info['txtdobM'];
        $adultDOBYear = $passenger_info['txtdobY'];
		$adultPPNationality = $passenger_info['nationality'];		
		if($isdomestic == 'true') {
			$adultPPNo = '';
			$adultPPEDate = '';
			$adultPPEMonth = '';
			$adultPPEYear = '';
			$adultPPIDate = '';
			$adultPPIMonth = '';
			$adultPPIYear = '';
			$adultPPICountry = '';
			$adultPPExpire = '';		
		} else {
			$adultPPNo = $passenger_info['passport_no'];
			$adultPPICountry = $passenger_info['issued_country'];

			$adultPPIDate = $passenger_info['adultPPIDate'];
			$adultPPIMonth = $passenger_info['adultPPIMonth'];
			$adultPPIYear = $passenger_info['adultPPIYear'];

			$adultPPEDate = $passenger_info['txtpedD'];
			$adultPPEMonth = $passenger_info['txtpedM'];
			$adultPPEYear = $passenger_info['txtpedY'];
		}
        if (array_key_exists('childFName', $passenger_info) && !empty($passenger_info['childFName'])) {
            $childTitle = $passenger_info['childTitle'];
            $childFName = $passenger_info['childFName'];
            $childLName = $passenger_info['childLName'];
			//$childGender = $passenger_info['childGender'];			

            $childDOBDate = $passenger_info['childDOBDate'];
            $childDOBMonth = $passenger_info['childDOBMonth'];
            $childDOBYear = $passenger_info['childDOBYear'];
            $childPPNationality = $passenger_info['childPPNationality'];			
			if($isdomestic == 'true') {
				$childPPNo = '';
				$childPPEDate = '';
				$childPPEMonth = '';
				$childPPEYear = '';
				$childPPIDate = '';
				$childPPIMonth = '';
				$childPPIYear = '';				
				$childPPICountry = '';			
			} else {
				$childPPNo = $passenger_info['childPPNo'];
				$childPPICountry = $passenger_info['childPPICountry'];

				$childPPIDate = $passenger_info['childPPIDate'];
				$childPPIMonth = $passenger_info['childPPIMonth'];
				$childPPIYear = $passenger_info['childPPIYear'];

				$childPPEDate = $passenger_info['childPPEDate'];
				$childPPEMonth = $passenger_info['childPPEMonth'];
				$childPPEYear = $passenger_info['childPPEYear'];
			}
        }

        if (array_key_exists('infantFName', $passenger_info) && !empty($passenger_info['infantFName'])) {
            $infantTitle = $passenger_info['infantTitle'];
            $infantFName = $passenger_info['infantFName'];
            $infantLName = $passenger_info['infantLName'];
			//$infantGender = $passenger_info['infantGender'];			
			
            $infantDOBDate = $passenger_info['infantDOBDate'];
            $infantDOBMonth = $passenger_info['infantDOBMonth'];
            $infantDOBYear = $passenger_info['infantDOBYear'];
			$infantPPNationality = $passenger_info['infantPPNationality'];						
			if($isdomestic == 'true') {		
				$infantPPNo = '';
				$infantPPEDate = '';
				$infantPPEMonth = '';
				$infantPPEYear = '';
				$infantPPIDate = '';
				$infantPPIMonth = '';
				$infantPPIYear = '';				
				$infantPPICountry = '';						
			} else {
				$infantPPNo = $passenger_info['infantPPNo'];
				$infantPPICountry = $passenger_info['infantPPICountry'];

				$infantPPIDate = $passenger_info['infantPPIDate'];
				$infantPPIMonth = $passenger_info['infantPPIMonth'];
				$infantPPIYear = $passenger_info['infantPPIYear'];

				$infantPPEDate = $passenger_info['infantPPEDate'];
				$infantPPEMonth = $passenger_info['infantPPEMonth'];
				$infantPPEYear = $passenger_info['infantPPEYear'];
			}
        }

        $user_email = $passenger_info['email'];
        $user_mobile = $passenger_info['phone'];
		$ind = 0;
        for ($i = 0; $i < count($adultFName); $i++) {
            /* if ($adultTitle[$i] == 'Mr')
                $adultGender = 'Male';
            else if ($adultTitle[$i] == 'Mrs')
                $adultGender = 'Female';
            else
                $adultGender = 'Female'; */

            $adultDOB = $adultDOBYear[$i] . '-' . $adultDOBMonth[$i] . '-' . $adultDOBDate[$i];
			if($isdomestic == 'true') {		
				$ADT_PPI_Date = '';
				$ADT_PPE_Date = '';
				$adultpno = $adultpCountry = '';
			} else {
				$ADT_PPI_Date = $adultPPIYear[$i] . '-' . $adultPPIMonth[$i] . '-' . $adultPPIDate[$i];
				$ADT_PPE_Date = $adultPPEYear[$i] . '-' . $adultPPEMonth[$i] . '-' . $adultPPEDate[$i];
				$adultpno = $adultPPNo[$i];
				$adultpCountry = $adultPPICountry[$i];
			}
			if(isset($pax_ticket[$ind])) {
				$TicketId = $pax_ticket[$ind]['ticketid'];
                $TicketNo = $pax_ticket[$ind]['ticketNo'];
				$Adt_Baggage = $pax_ticket[$ind]['Baggage'];
			} else {
				$TicketId = $TicketNo = '';
			}
            $adult_data = array('uniqueRefNo' => $ezeeRefNo,
                'BookingRefId' => $BookingId,
				'TicketId' => $TicketId,
				'TicketNo' => $TicketNo,				
                'title' => $adultTitle[$i],
                'first_name' => $adultFName[$i],
                'last_name' => $adultLName[$i],
                'passenger_type' => 'ADT',
                'date_of_birth' => $adultDOB,
                //'gender' => $adultGender[$i],
                'mobile' => $user_mobile,
                'email' => $user_email,
                'passport_no' => $adultpno,
                'passport_nationality' => $adultPPNationality[$i],
                'passport_issue_country' => $adultpCountry,
                'passport_issue_date' => $ADT_PPI_Date,
                'passport_expiry_date' => $ADT_PPE_Date,
                'baggage' => $Adt_Baggage,

            );

            $this->db->insert('flight_booking_passengers', $adult_data);
			$ind++;
        }

        if (array_key_exists('childFName', $passenger_info) && !empty($passenger_info['childFName'])) {
            for ($i = 0; $i < count($childFName); $i++) {
                /* if ($childTitle[$i] == 'Mstr')
                    $childGender = 'Master';
                else if ($childTitle[$i] == 'Miss')
                    $childGender = 'Miss'; */

                $childDOB = $childDOBYear[$i] . '-' . $childDOBMonth[$i] . '-' . $childDOBDate[$i];
				if($isdomestic == 'true') {		
					$CNN_PPI_Date= '';
					$CNN_PPE_Date= '';
					$childpno	= $childpCountry = '';
				} else {
					$CNN_PPI_Date = $childPPIYear[$i] . '-' . $childPPIMonth[$i] . '-' . $childPPIDate[$i];
					$CNN_PPE_Date = $childPPEYear[$i] . '-' . $childPPEMonth[$i] . '-' . $childPPEDate[$i];
					$childpno = $childPPNo[$i];
					$childpCountry = $childPPICountry[$i];
				}
				if(isset($pax_ticket[$ind])) {
					$TicketId = $pax_ticket[$ind]['ticketid'];
					$TicketNo = $pax_ticket[$ind]['ticketNo'];
                    $CNN_Baggage = $pax_ticket[$ind]['Baggage'];

				} else {
					$TicketId = $TicketNo = '';
				}
                $child_data = array('uniqueRefNo' => $ezeeRefNo,
                    'BookingRefId' => $BookingId,
                    'TicketId' => $TicketId,
                    'TicketNo' => $TicketNo,
                    'title' => $childTitle[$i],
                    'first_name' => $childFName[$i],
                    'last_name' => $childLName[$i],
                    //'gender' => $childGender[$i],
                    'date_of_birth' => $childDOB,
                    'passenger_type' => 'CNN',
                    'passport_no' => $childpno,
                    'passport_nationality' => $childPPNationality[$i],
                    'passport_issue_country' => $childpCountry,
                    'passport_issue_date' => $CNN_PPI_Date,
                    'passport_expiry_date' => $CNN_PPE_Date,
                    'baggage' => $CNN_Baggage,
                );

                $this->db->insert('flight_booking_passengers', $child_data);
				$ind++;
            }
			
        }

        if (array_key_exists('infantFName', $passenger_info) && !empty($passenger_info['infantFName'])) {
            for ($i = 0; $i < count($infantFName); $i++) {
                /* if ($infantTitle[$i] == 'Mstr')
                    $infantGender = 'Master';
                else if ($infantTitle[$i] == 'Miss')
                    $infantGender = 'Miss'; */

                $infantDOB = $infantDOBYear[$i] . '-' . $infantDOBMonth[$i] . '-' . $infantDOBDate[$i];
				if($isdomestic == 'true') {		
					$INF_PPI_Date = '';
					$INF_PPE_Date = '';
					$infantpno = $infantpCountry = '';
				} else {
					$INF_PPI_Date = $infantPPIYear[$i] . '-' . $infantPPIMonth[$i] . '-' . $infantPPIDate[$i];
					$INF_PPE_Date = $infantPPEYear[$i] . '-' . $infantPPEMonth[$i] . '-' . $infantPPEDate[$i];
					$infantpno = $infantPPNo[$i];
					$infantpCountry = $infantPPICountry[$i];
				}
				if(isset($pax_ticket[$ind])) {
					$TicketId = $pax_ticket[$ind]['ticketid'];
					$TicketNo = $pax_ticket[$ind]['ticketNo'];
                    $INF_Baggage = $pax_ticket[$ind]['Baggage'];

				} else {
					$TicketId = $TicketNo = '';
				}
                $infant_data = array('uniqueRefNo' => $ezeeRefNo,
                    'BookingRefId' => $BookingId,
                    'TicketId' => $TicketId,
                    'TicketNo' => $TicketNo,					
                    'title' => $infantTitle[$i],
                    'first_name' => $infantFName[$i],
                    'last_name' => $infantLName[$i],
                    //'gender' => $infantGender[$i],
                    'date_of_birth' => $infantDOB,
                    'passenger_type' => 'INF',
                    'passport_no' => $infantpno,
                    'passport_nationality' => $infantPPNationality[$i],
                    'passport_issue_country' => $infantpCountry,
                    'passport_issue_date' => $INF_PPI_Date,
                    'passport_expiry_date' => $INF_PPE_Date,
                    'baggage' => $INF_Baggage,
                    
                );

                $this->db->insert('flight_booking_passengers', $infant_data);
				$ind++;
            }
        }
    }
    function get_agent_available_balance() { 
        $agent_id=$this->session->agent_id;
        $agent_no=$this->session->agent_no; 
        
            $where = 'agent_id = '.$agent_id.'';
       
        
        
        $this->db->select('available_balance')
                 ->from('agent_acc_summary')
                 ->where('agent_no', $agent_no)
                 ->where($where)                 
                 //->where('agent_id', $agent_id)
                 ->order_by('transaction_datetime', 'DESC')
                 ->limit('1');
         $query = $this->db->get(); //echo $this->db->last_query(); exit;
         if ($query->num_rows() > 0) {
             $res = $query->result();
             $balance = $res[0]->available_balance;
         } else {
             $balance = 0;
         }         
         return  $balance;  
     }
     public function insert_withdraw_status($agent_id, $agent_no, $withdraw_amount, $total, $BOOKING_REFERENCE_NO) {
        $disc_tran = 'Regarding Flight Booking Ref: ' . $BOOKING_REFERENCE_NO;
        $data['status'] = 'Accepted';
        $data['available_balance'] = $total;
        $data['agent_no'] = $agent_no;
        $data['transaction_summary'] = $disc_tran;
        
            
            $data['agent_id'] = $agent_id;
       
        
        //$data['agent_id'] = $agent_id;
        $data['withdraw_amount'] = $withdraw_amount;
        $data['agent_transaction_id'] = $BOOKING_REFERENCE_NO;
        $data['value_date'] = date('Y-m-d');
        $this->db->set('approve_date', 'NOW()', FALSE);
        $this->db->set('transaction_datetime', 'NOW()', FALSE);
        $this->db->insert('agent_acc_summary', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {                
            return true;
        } else {
            return false;
        }
    }

     function journeyDuration($datetime1, $datetime2, $format = "regular") {
    $datesDiff = $this->datesDiff($datetime1, $datetime2);

    if ($format == "regular") {
        if ($datesDiff['days'] > 0)
            $res = $datesDiff['days'] . " day " . $datesDiff['hours'] . "h " . $datesDiff['minuts'] . "m";
        else
            $res = $datesDiff['hours'] . "h " . $datesDiff['minuts'] . "m";
    }
    else
        $res = ($datesDiff['days'] * 24 * 60) + ($datesDiff['hours'] * 60) + $datesDiff['minuts'];

    return $res;
    }

    function datesDiff($date1, $date2) {
        $diff = abs(strtotime($date2) - strtotime($date1));
        $years = floor($diff / (365 * 60 * 60 * 24));

        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
        $minuts = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
        return array("years" => $years, "months" => $months, "days" => $days, "hours" => $hours, "minuts" => $minuts, "seconds" => $seconds);
    }
    
    public function airportname($citycode)
    {
        $this->db->select('airport_name');
        $this->db->from('airport_list_old');
        $this->db->where('airport_code', $citycode);
        $this->db->limit(1);
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $res = $query->result();
            $airport_name = $res[0]->airport_name;
        } else {
            $airport_name = 0;
        }         
        return  $airport_name;
        
        
        
    }
    
    public function get_insurance() {
        $this->db->select('*');
        $this->db->from('insurance');
        $this->db->where('trip_type', 'Domestic');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }   
    }

    public function get_international_insurance() {
        $this->db->select('*');
        $this->db->from('insurance');
        $this->db->where('trip_type', 'International');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }   
    }

    public function get_passenger_info($RefNo) {
        $this->db->select('*');
        $this->db->from('flight_booking_passengers');
        $this->db->where('uniqueRefNo', $RefNo);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }   
    }

    public function update_cancelinfo_bookingpassenger($TicketId, $ChangeRequestId)
    {
        $data=array(
            "Cancellation_Status"=>"Cancelled",
            "Cancellation_ID"=>$ChangeRequestId
        );
        $this->db->where('TicketId', $TicketId);        
        $this->db->update('flight_booking_passengers', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_cancelinfo_bookingreport($RefNo, $TicketId)
    {
        $data=array(
            "BookingStatus"=>"Cancelled",
            "Ticket_Number"=>$TicketId
        );
        $this->db->where('uniqueRefNo', $RefNo);        
        $this->db->update('flight_booking_reports', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
       
    }

}

