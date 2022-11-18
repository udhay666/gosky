<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Multilink_Model extends CI_Model {
  function __construct() {

        parent::__construct();
    }

    function get_Multilink_credentials() {
        $this->db->select('*');
        $this->db->from('api_info');
        $this->db->where('api_name', 'multilink');
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
    function delete_flight_temp_result($sess_id,$api) {
        $this->db->where('session_id', $sess_id);
        $this->db->where('api', $api);
        $this->db->delete('flight_search_result');
    }
    function insert_flight_temp_results($flightResultsData) {
        $this->db->insert_batch('flight_search_result', $flightResultsData);
        return $this->db->insert_id();
    }

    function fetch_search_result($ses_id,$unique_id, $triptype) {
       
        $this->db->select('isdomestic,operating_airlinecode,operating_airlinename,operating_flightno,operating_airportname_o,
            operating_airportname_d,operating_deptime,operating_arritime,operating_deptdate,operating_arrdate,operating_cityname_o,operating_cityname_d,operating_terminal_o,nonrefundable,operating_fareclass,operating_terminal_d,duration,origin,stops,destination,search_id,segmentkey,basefare,
            tax,total_amount,net_amount,currency,admin_markup,agent_markup,payment_charge,tripindicator,seats,baggageinformation,roundtrip,segment_indicator,segment_duration,CabinBaggage,farearray,connect_time,api');
       // $this->db->from('tbo_flight_search_result');
        $this->db->from('flight_search_result');
        $this->db->where('session_id', $ses_id);
        $this->db->where('uniquerefno', $unique_id);
        $this->db->where('api', 'multilink');
        //$this->db->where('tripindicator', $triptype);
        // $this->db->limit('100');
        $this->db->where('roundtrip', $triptype);
        $this->db->order_by('basefare', 'ASC');
        $this->db->order_by('total_amount', 'ASC');
        $query = $this->db->get();

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
        $this->db->where('search_id', $searchId);
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

    function insert_booking_report($ezeeRefNo, $BookingId, $PNR, $BookingStatus, $flight_result, $Ticket_Number,$pass,$total_amount,$earneddata) {

        $this->db->select('*');
        $this->db->from('flight_booking_reports');
        $this->db->order_by('report_id', 'DESC');
        $this->db->limit('1');
        $query = $this->db->get();
        $invoice_no = 0;
        if ($query->num_rows() > 0) {
            $res = $query->row();
            $invoice_no = $res->invoice_no;
            $uniqueno = $res->uniqueRefNo;
        }
        // echo 'res'.$flight_result->uniqueno.'<br>inv'.$uniqueno;
        if(trim($flight_result->uniqueRefNo)==trim($uniqueno)){ 
            $n=substr($invoice_no,8,12);
        }else{ 
            $n=substr($invoice_no,8,12) +1;
        }
        $invoice_no = 'INVF'.date('ym').str_pad($n,6,0,STR_PAD_LEFT);

        if ($flight_result->triptype == 'S')
            $Mode = 'Onward';
        else if ($flight_result->triptype == 'R')
            $Mode = 'Return';


        if ($this->session->userdata('user_logged_in')) {
            $user_id = $this->session->userdata('user_id');
            $agent_id = 0;
        } else {
            $user_id = 0;
            if ($this->session->userdata('agent_logged_in')) {
                $agent_id = $this->session->userdata('agent_id');
                ;
            } else {
                $agent_id = 0;
            }
        }
        $passenger_info = $this->session->userdata('passenger_info');
        // echo '<pre>';print_r($passenger_info);exit;
        $promotional_discount = $flight_result->promo_discount;
        $promotional_code = $flight_result->promo_code;
        
        if($flight_result->roundtrip==2){
            $MODE='Return';
        }else{
            $MODE='Onward';
        }

        $gstallowed=$gstmandatory=false;
        if($flight_result->gstallowed=='1'){
            $gstallowed=true;
        }
        if($flight_result->gstmandatory=='1'){
            $gstmandatory=true;
        }
        if($gstmandatory==true) {
            $gst_arr = array(
                'GstNumber' => $passenger_info['GstNumber'],
                'GstCompanyName' => $passenger_info['GstCompanyName'],
                'GstContactNumber' => $passenger_info['GstContactNumber'],
                'GstEmail' => $passenger_info['GstEmail'],
                'GstAddress' => $passenger_info['GstAddress'],
            );
            $gst_info = serialize($gst_arr);
        } else {
            $gst_info = '';
        }


        $insertdata = array(
            'user_id' => $user_id,
            'agent_id' => $agent_id,
            'uniqueRefNo' => $ezeeRefNo,
            'BookingRefId' => $BookingId,
            'BookingStatus' => $BookingStatus,
            'Ticket_Number' => $Ticket_Number,
            'pnr' => $PNR,
            'api' => 'multilink',
            'isdomestic'=>$flight_result->isdomestic,
            'Origin' => $flight_result->origin,
            'Destination' => $flight_result->destination,
            'Adults' => $flight_result->adults,
            'Childs' => $flight_result->childs,
            'Infants' => $flight_result->infants,
            'DirectionInd' => $flight_result->tripindicator,
            'Booking_Date' => date("Y-m-d"),
            'Total_Duration' => $flight_result->duration,
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
            'baggage_price' => $flight_result->baggage_price, 
            'segment_indicator' => $flight_result->segment_indicator,
            'Departure_LocationCode' => $flight_result->operating_cityname_o,
            'Arrival_LocationCode' => $flight_result->operating_cityname_d,
            //'AirEquipType' => '',
            'OperatingAirline_Code' => $flight_result->operating_airlinecode,
            'OperatingAirline_FlightNumber' => $flight_result->operating_airlinename,
            'StopQuantity' => '',
            'Stops' => $flight_result->stops,
            'BaseFare' => $flight_result->basefare,
            'BaseFare_CurrencyCode' => $flight_result->currency,
            'EquivFare' => $flight_result->basefare,
            'CurrencyCode' => $flight_result->currency,
            'Tax_Amount' => $flight_result->tax,
            'Tax_Code' => '',
            'NetRate' => $flight_result->net_amount,
            'TotalFare' => $total_amount,
            // 'PassengerType' => '',
            // 'PassengerQuantity' => '',
            // 'PassengerBaseFare' => '',
            // 'PassengerEquivFare' => '',
            // 'PassengerTotalTax' => '',
            // 'PassengerTotalFare' => '',
            'departureterminal' => $flight_result->operating_terminal_o,
            'Payment_Charge' => $flight_result->payment_charge,
            'Admin_Markup' => $flight_result->admin_markup,
            'Agent_Markup' => $flight_result->agent_markup,
            'Distributors' => $flight_result->distributors,
            'Trip_Type' => $flight_result->triptype,
            'Mode' => $MODE,
            // 'Promotional_Discount' => $promotional_discount,            
            // 'Promotional_Code' => $passenger_info['user_promotional'],   
            'Promotional_Discount' => $flight_result->promo_discount,            
            'Promotional_Code' =>$flight_result->promo_code,            
            'earneddata' => $earneddata,
            //'Remarks' => '',
            'invoice_no' => $invoice_no,
            'baggage'=> 'Cabin - '.$flight_result->CabinBaggage.', Check-in - '.$flight_result->baggageinformation,
            'gst_info' => $gst_info,
        );

        $this->db->insert('flight_booking_reports', $insertdata);
        //echo $this->db->last_query(); exit;
        $booking_id = $this->db->insert_id();

        return $booking_id;
    }

    function insert_booking_passenger_info($ezeeRefNo, $BookingId ,$isdomestic,$flight_result) {
        $passenger_info = $this->session->passenger_info;
        $pax_ticket = $this->session->flight_pax_tickets;

        if($flight_result->roundtrip==2){
            $MODE='Return';
        }else{
            $MODE='Onward';
        }
        $adultTitle = $passenger_info['adultTitle'];
        $adultFName = $passenger_info['adultFName'];
        $adultLName = $passenger_info['adultLName'];
        //$adultGender = $passenger_info['adultGender'];        

        $adultDOBDate = $passenger_info['adultDOBDate'];
        $adultDOBMonth = $passenger_info['adultDOBMonth'];
        $adultDOBYear = $passenger_info['adultDOBYear'];
        $adultPPNationality = $passenger_info['adultPPNationality'];        
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
            $adultPPNo = $passenger_info['adultPPNo'];
            $adultPPICountry = $passenger_info['adultPPICountry'];

            $adultPPIDate = $passenger_info['adultPPIDate'];
            $adultPPIMonth = $passenger_info['adultPPIMonth'];
            $adultPPIYear = $passenger_info['adultPPIYear'];

            $adultPPEDate = $passenger_info['adultPPEDate'];
            $adultPPEMonth = $passenger_info['adultPPEMonth'];
            $adultPPEYear = $passenger_info['adultPPEYear'];
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

        $user_email = $passenger_info['user_email'];
        $user_mobile = $passenger_info['user_mobile'];
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
            } else {
                $TicketId = $TicketNo = '';
            }
            $adult_data = array(
                'uniqueRefNo' => $ezeeRefNo,
                'BookingRefId' => $BookingId,
                'TicketId' => $TicketId,
                'TicketNo' => $TicketNo,                
                'title' => $adultTitle[$i],
                'first_name' => $adultFName[$i],
                'last_name' => $adultLName[$i],
                'passenger_type' => 'ADT',
                'date_of_birth' => $adultDOB,
                //'gender' => $adultGender[$i],
                'whatsapp_itinerary' => $passenger_info['whatsapp'],
                'mobile' => $user_mobile,
                'email' => $user_email,
                'passport_no' => $adultpno,
                'passport_nationality' => $adultPPNationality[$i],
                'passport_issue_country' => $adultpCountry,
                'passport_issue_date' => $ADT_PPI_Date,
                'passport_expiry_date' => $ADT_PPE_Date,
                'mode' => $MODE,
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
                    $childpno   = $childpCountry = '';
                } else {
                    $CNN_PPI_Date = $childPPIYear[$i] . '-' . $childPPIMonth[$i] . '-' . $childPPIDate[$i];
                    $CNN_PPE_Date = $childPPEYear[$i] . '-' . $childPPEMonth[$i] . '-' . $childPPEDate[$i];
                    $childpno = $childPPNo[$i];
                    $childpCountry = $childPPICountry[$i];
                }
                if(isset($pax_ticket[$ind])) {
                    $TicketId = $pax_ticket[$ind]['ticketid'];
                    $TicketNo = $pax_ticket[$ind]['ticketNo'];
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
                    'mode' => $MODE,
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
                    'mode' => $MODE,
                );

                $this->db->insert('flight_booking_passengers', $infant_data);
                $ind++;
            }
        }
    }
    function get_agent_available_balance() { 
        $agent_id=$this->session->agent_id;
        $agent_no=$this->session->agent_no;    
        $this->db->select('available_balance')
                 ->from('agent_acc_summary')
                 ->where('agent_no', $agent_no)
                 ->where('agent_id', $agent_id)
                 ->order_by('transaction_datetime', 'DESC')
                 ->limit('1');
         $query = $this->db->get(); 
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
            $res = $datesDiff['days'] . " day " . $datesDiff['hours'] . " hr " . $datesDiff['minuts'] . " min";
        else
            $res = $datesDiff['hours'] . " hr " . $datesDiff['minuts'] . " min";
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
    public function update_passenger_cancellation_status($pass_id, $Amount,$cancel_status,$CRID) {
        $data['Cancellation_Status'] =  $cancel_status;
        $data['Cancellation_Amount'] = $Amount;
        if(!empty($CRID)) {
            $data['Cancellation_ID'] = $CRID;
        }
        $where = "pass_id = '$pass_id'";
        if ($this->db->update('flight_booking_passengers', $data, $where)) {
            return true;
        } else {
            return false;
        }   
    }
    public function update_passenger_cancellation_statusnew($tketid, $RefNo, $status, $changeReqID,$mode) {
        $data=array('Cancellation_Status'=>$status,'Cancellation_ID'=>$changeReqID);

        $this->db->where('TicketId',$tketid);
        $this->db->where('uniqueRefNo',$RefNo);
        $this->db->where('mode',$mode);
        $this->db->update('flight_booking_passengers',$data);
        return false;  
    }
    public function update_booking_status($Booking_Ref_ID,$Amount,$status = 'Cancelled') {
        $data['Cancellation_Status'] =  $status;
        $data['Cancellation_Charge'] = $Amount;
        $data['Cancellation_Date'] = date('Y-m-d');

        $where = "BookingRefId = '$Booking_Ref_ID'";
        if ($this->db->update('flight_booking_reports', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }
    function get_booking_report($RefNo,$mode) {
        $this->db->select('*');
        $this->db->from('flight_booking_reports');
        $this->db->where('uniqueRefNo', $RefNo);
        $this->db->where('Mode', $mode);
        $this->db->order_by('DirectionInd', 'ASC');
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }
}
?>