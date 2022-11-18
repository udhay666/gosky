<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Tbo extends MX_Controller {

    private $ClientId;
    private $username;
    private $password;
    private $enduserip;
    private $loginurl;
    private $posturl;
    private $bookurl;
    private $logouturl;
    private $roundtrip_count;
    private $cr_count;
    private $allowed_ssr_fligts = array('AK', 'G9', 'FZ', '6E');

    private $sess_id;
    private $ip;
    private $api;
    private $mode;

    private $tripType;
    private $fromCity;
    private $toCity;
    private $fromCityCode;
    private $toCityCode;
    private $departDate;
    private $returnDate;
    private $adults;
    private $childs;
    private $infants;
    private $cabinClass;
    private $flightmode;
    private $sess_uniqueRefNo;
    private $stops;
    private $airlines;
    private $departTime;
    private $provider;


    public function __construct() {
        parent::__construct();
        $this->load->model('Tbo_Model');
        
        $this->sess_id = $this->session->session_id;
        ini_set('max_execution_time', 300); 
        // ini_set('max_execution_time', 300);
        ini_set('memory_limit','2048M');
        $this->set_credentials();
        $this->roundtrip_count = 1;
        $this->cr_count = 1;

    }
    public function set_credentials() {
        
        $credentials = $this->Tbo_Model->get_tbo_credentials();
        //echo '<pre/>';print_r($credentials);exit;       
        $this->ip='111.93.152.220';
        $this->api = $credentials->api_name;
        $this->mode = $credentials->mode;
        
        if ($this->mode == 1){ 
            
        $this->ClientId="tboprod";
        $this->username="DELT860";
        $this->password="@nline#Trv-22";
        $this->enduserip="192.168.11.120";

         $this->loginurl = 'https://api.travelboutiqueonline.com/SharedAPI/SharedData.svc/rest/Authenticate';
         $this->posturl = 'https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/';
         $this->bookurl = 'https://booking.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/';
         $this->logouturl = 'https://api.travelboutiqueonline.com/SharedAPI/SharedData.svc/rest/Logout';
         
        }else{
            
        $this->ClientId="ApiIntegrationNew";
        $this->username="Travelf";
        $this->password="Travel@124";
        $this->enduserip="192.168.11.120";

         $this->loginurl = 'http://api.tektravels.com/SharedServices/SharedData.svc/rest/Authenticate';
         $this->posturl = 'http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/';
         $this->bookurl = 'http://api.tektravels.com/BookingEngineService_AirBook/AirService.svc/rest/';
         $this->logouturl = 'http://api.tektravels.com/SharedServices/SharedData.svc/rest/Logout';

     }
}

public function set_variables($searcharray) {
    //$session_data = $this->session->userdata('flight_search_data');
    $session_data = unserialize($searcharray);
    if (empty($session_data)) {
        redirect('home/success_page/' . base64_encode('Session is Expired'), 'refresh');
    }
       // echo '<pre>';print_r($session_data);exit;
    $this->tripType = $session_data['tripType'];
    $this->fromCity = $session_data['fromCity'];
    $this->toCity = $session_data['toCity'];
    $this->fromCityCode = $this->getAirportCode($session_data['fromCity']);
    $this->toCityCode = $this->getAirportCode($session_data['toCity']);
    $this->departDate = date('Y-m-d', strtotime(str_replace('/', '-', $session_data['departDate'])));
    // $this->departDate = $session_data['departDate'];
    $this->departTime = '00:00:00';
    $this->returnDate = date('Y-m-d', strtotime(str_replace('/', '-', $session_data['returnDate'])));
    // $this->returnDate = $session_data['returnDate'];
    $this->returnTime = '00:00:00';
    $this->adults = $session_data['adult_count'];
    $this->childs = $session_data['child_count'];
    $this->infants = $session_data['infant_count'];
    $this->cabinClass = $session_data['class'];
    $this->flightmode = $session_data['flightmode'];
    $this->sess_uniqueRefNo = $session_data['sess_uniqueRefNo'];
    $this->stops = $session_data['direct'];
    $this->provider = $session_data['provider'];
    //$this->airlines = $session_data['airlines'];
    $this->airlines = array('GDS','SG','6E','G8','G9','FZ','IX','AK','LB');
    // $this->airlines = array('6E');
}

public function set_multisearch_variables($searcharray) {
    //$session_data = $this->session->userdata('flight_search_data');
    $session_data = unserialize($searcharray);
    if (empty($session_data)) {
        redirect('home/error_page/' . base64_encode('Session is Expired'), 'refresh');
    }
    // echo"<pre>";print_r($session_data);exit;
    $this->tripType = $session_data['tripType'];
    $this->fromCity = $session_data['fromCity'];
    $this->toCity = $session_data['toCity'];
    $this->departDate = $session_data['departDate'];
    $this->departTime = '00:00:00';
    $this->adults = $session_data['adult_count'];
    $this->childs = $session_data['child_count'];
    $this->infants = $session_data['infant_count'];
    $this->cabinClass = $session_data['class'];
    $this->flightmode = $session_data['flightmode'];
    $this->sess_uniqueRefNo = $session_data['sess_uniqueRefNo'];
    // $this->airlines = $session_data['airlines'];
    $this->airlines = array('GDS','SG','6E');
}

public function flights_searchRQ($searcharray) {

    $this->set_variables($searcharray);

// Getting Flight Search Results from database
// echo '12345';exit;
    if ($this->session->userdata('flight_search_activate') == 1) {

        //$this->fetch_flight_search_results_new();
    } else {

        //Delete temp search data
     $this->Tbo_Model->delete_flight_temp_result($this->sess_id, 'tbo');
    //$airlin=implode('","',$this->airlines);//exit;
    $rounseg='';
    if ($this->tripType == 'oneway') {
        $typ = 1;
        
    } else {
        $typ = 2;
        $rounseg=',{
            "Origin": "'.$this->toCityCode.'",
            "Destination": "'.$this->fromCityCode.'",
            "FlightCabinClass": "'.$this->cabinClass.'",
            "PreferredDepartureTime": "' . $this->returnDate . 'T00:00:00",
            "PreferredArrivalTime": "' . $this->returnDate . 'T00:00:00"
        }';
    }
    if($this->stops=='2'){
        $stp='"DirectFlight": "true",
        "OneStopFlight": "false",';
    }elseif($this->stops=='3'){
        $stp='"DirectFlight": "false",
        "OneStopFlight": "true",';
    }else{
        $stp='"DirectFlight": "false",
        "OneStopFlight": "false",';
    }       

    $this->login();
    $tbo_token_id= $this->session->userdata('airtoken');
    $airlin=implode('","',$this->airlines);//exit;
    $xml_search= '{
        "EndUserIp": "'.$this->ip.'",
        "TokenId": "'.$tbo_token_id.'",
        "AdultCount": "'.$this->adults.'",
        "ChildCount": "'.$this->childs.'",
        "InfantCount": "'.$this->infants.'",
        '.$stp.'
        "JourneyType": "'.$typ.'",
        "PreferredAirlines": null,
        "Segments": [
        {
            "Origin": "'.$this->fromCityCode.'",
            "Destination": "'.$this->toCityCode.'",
            "FlightCabinClass": "'.$this->cabinClass.'",
            "PreferredDepartureTime": "' . $this->departDate . 'T00:00:00",
            "PreferredArrivalTime": "' . $this->departDate . 'T00:00:00"
        }'.$rounseg.'
        ],
        "Sources": null
    }';
    // echo $xml_search;exit; //exit;
    $searchresponse = $this->processRequest($xml_search, 'Search/');
    $searchresp=$this->extractencode($xml_search,$searchresponse,'search');
    // echo '<pre>';print_r($searchresp);exit;
    $log_data = array(
        'session_id' => $this->sess_id,
        'uniqueRefNo' => $this->sess_uniqueRefNo,
        'api' => 'tbo',
        'search_request' => $xml_search,
        'search_response'=>$searchresponse
        );
    // $this->Logger->add('flights_api_logs', $log_data);
        // echo '<pre>';print_r($searchresp);exit;

    $this->extractresult($searchresp,$searcharray);
    }
    echo json_encode(array("success" => 'success', "session_id"=>$this->sess_id));
    //echo $this->db->last_query();exit;
 //   $this->fetch_flight_search_results($searcharray);
}

public function flights_calenderFareRQ($searcharray) {

        $this->set_variables($searcharray);
        $tbo_token_id= $this->session->userdata('airtoken');
        $airlin=implode('","',$this->airlines);//exit;
        $rounseg='';
        if ($this->tripType == 'S') {
            $typ = 1;

        } else {
            $typ = 2;
            $rounseg=',{
            "Origin": "'.$this->toCityCode.'",
            "Destination": "'.$this->fromCityCode.'",
            "FlightCabinClass": "'.$this->cabinClass.'",
            "PreferredDepartureTime": "' . $this->returnDate . 'T00:00:00",
            "PreferredArrivalTime": "' . $this->returnDate . 'T00:00:00"
            }';
        }
        if($this->stops=='2'){
            $stp='"DirectFlight": "true",
            "OneStopFlight": "false",';
        }elseif($this->stops=='3'){
            $stp='"DirectFlight": "false",
            "OneStopFlight": "true",';
        }else{
            $stp='"DirectFlight": "false",
            "OneStopFlight": "false",';
        } 
        $xml_search= '{
            "EndUserIp": "'.$this->ip.'",
            "TokenId": "'.$tbo_token_id.'",
            "JourneyType": "'.$typ.'",
            "PreferredAirlines": null,
            "Segments": [
            {
            "Origin": "'.$this->fromCityCode.'",
            "Destination": "'.$this->toCityCode.'",
            "FlightCabinClass": "'.$this->cabinClass.'",
            "PreferredDepartureTime": "' . $this->departDate . 'T00:00:00",
            "PreferredArrivalTime": "' . $this->departDate . 'T00:00:00"
            }'.$rounseg.'
            ],
            "Sources": null
        }';
        // echo $xml_search;exit; //exit;
        $searchresponse = $this->processRequest($xml_search, 'GetCalendarFare/');
        $searchresp=$this->extractencode($xml_search,$searchresponse,'GetCalendarFare');

        // echo json_encode(array("success" => 'success'));
}
public function extractresult($searchresp,$searcharray){
    if($this->flightmode==1){
        $IsDomestic='true';
    }else{
        $IsDomestic='false';
     } 
    //  echo $this->flightmode.' '.$IsDomestic;exit;
    //  echo '<pre>';print_r($searchresp);exit;
        $this->load->module('flights/flight_markup');
    if (isset($searchresp->Response) && ($searchresp->Response->Error->ErrorCode==0)) {
        $Results=$searchresp->Response->Results;
        $TraceId=$searchresp->Response->TraceId;
        $Origin=$searchresp->Response->Origin;
        $Destination=$searchresp->Response->Destination;
            // echo '<pre>';print_r($Results);exit;
        $insert_info=array();$l=0;
        foreach($Results as $key=>$Result){
            if($key==0){
                $RoundTrip=1;
            }else{
                $RoundTrip=2;
            }
            foreach($Result as $val){
    // echo '<pre>';print_r($val);exit;
                $ResultIndex=$val->ResultIndex;
                $Source=$val->Source;
                $IsLCC=$val->IsLCC;
                //echo '<pre>';print_r($val);exit;
                $IsRefundable=$val->IsRefundable;
                $AirlineRemark=$val->AirlineRemark;
                $AirlineCodem=$val->AirlineCode;
                $BaseFare=$val->Fare->BaseFare;
                $Tax=($val->Fare->Tax)+($val->Fare->OtherCharges);
                $OtherCharges=$val->Fare->OtherCharges;
                $PublishedFare=$val->Fare->PublishedFare;
                $OfferedFare=$val->Fare->OfferedFare;
                $Segments=$val->Segments;
                $FareClassification=$val->FareClassification;
                $farecolor=$FareClassification->Color;
                $faretype=$FareClassification->Type;
    
                $Baggage=$TripIndicator=$SegmentIndicator=$AirlineCode=$AirlineName=$FlightNumber=$FareClass=$OperatingCarrier=$AirportCode_o=$AirportName_o=$Terminal_o=$CityCode_o=$CityName_o=$CountryCode_o=$CountryName_o=$DepTime=$AirportCode_d=$AirportName_d=$Terminal_d=$CityCode_d=$CityName_d=$CountryCode_d=$CountryName_d=$ArrTime=$StopOver=$Duration=$seats=array();
    
                foreach($Segments as $Segment){ 
    
                    foreach($Segment as $val1){
                            //print_r($val1);exit;
                        $Baggage[]=$val1->Baggage;
                        $TripIndicator[]=$val1->TripIndicator;
                        //$SegmentIndicator[]=$val1->SegmentIndicator;
                        $SegmentIndicator[]=$val1->TripIndicator;
                        if(isset($val1->NoOfSeatAvailable)){ $seats[]= $val1->NoOfSeatAvailable; }
                        
    
                        $AirlineCode[]=$val1->Airline->AirlineCode;
                        $AirlineName[]=$val1->Airline->AirlineName;
                        $FlightNumber[]=$val1->Airline->FlightNumber;
                        $flightcount = (count($FlightNumber)-1);
                        $FareClass[]=$val1->Airline->FareClass;
                        $OperatingCarrier[]=$val1->Airline->OperatingCarrier;
    
                        $AirportCode_o[]=$val1->Origin->Airport->AirportCode;
                        $AirportName_o[]=$val1->Origin->Airport->AirportName;
                        $Terminal_o[]=$val1->Origin->Airport->Terminal;
                        $CityCode_o[]=$val1->Origin->Airport->CityCode;
                        $CityName_o[]=$val1->Origin->Airport->CityName;
                        $CountryCode_o[]=$val1->Origin->Airport->CountryCode;
                        $CountryName_o[]=$val1->Origin->Airport->CountryName;
                        $DepTime[]=$val1->Origin->DepTime;
    
                        $AirportCode_d[]=$val1->Destination->Airport->AirportCode;
                        $AirportName_d[]=$val1->Destination->Airport->AirportName;
                        $Terminal_d[]=$val1->Destination->Airport->Terminal;
                        $CityCode_d[]=$val1->Destination->Airport->CityCode;
                        $CityName_d[]=$val1->Destination->Airport->CityName;
                        $CountryCode_d[]=$val1->Destination->Airport->CountryCode;
                        $CountryName_d[]=$val1->Destination->Airport->CountryName;
                        $ArrTime[]=$val1->Destination->ArrTime;
    
                        if(isset($val1->AccumulatedDuration)){
                            $AccumulatedDuration= $val1->AccumulatedDuration;
                        }
                        $Duration[]= $val1->Duration;
                        $StopOver[]= $val1->StopOver;
                    }
                }
    
                $Baggage=implode(',',$Baggage);
                $TripIndicator=implode(',',$TripIndicator);
                $SegmentIndicator=implode(',',$SegmentIndicator);
                $AirlineCode=implode(',',$AirlineCode);
                $AirlineName=implode(',',$AirlineName);
                $FlightNumber=implode(',',$FlightNumber);
                $FareClass=implode(',',$FareClass);
                $OperatingCarrier=implode(',',$OperatingCarrier);
                $AirportCode_o=implode(',',$AirportCode_o);
                $AirportName_o=implode(',',$AirportName_o);
                $Terminal_o=implode(',',$Terminal_o);
                $CityCode_o=implode(',',$CityCode_o);
                $CityName_o=implode(',',$CityName_o);
                $CountryCode_o=implode(',',$CountryCode_o);
                $CountryName_o=implode(',',$CountryName_o);
                $DepTime=implode(',',$DepTime);
                $AirportCode_d=implode(',',$AirportCode_d);
                $AirportName_d=implode(',',$AirportName_d);
                $Terminal_d=implode(',',$Terminal_d);
                $CityCode_d=implode(',',$CityCode_d);
                $CityName_d=implode(',',$CityName_d);
                $CountryCode_d=implode(',',$CountryCode_d);
                $CountryName_d=implode(',',$CountryName_d);
                $ArrTime=implode(',',$ArrTime);
                $seats=implode(',',$seats);
                
                if(isset($AccumulatedDuration) && !empty($AccumulatedDuration)){
                 $Duration= $AccumulatedDuration;
             }else{
                 $Duration=array_sum($Duration);
             }
             $fro=explode(',',$AirportCode_o);
             $des=explode(',',$AirportCode_d);
             $StopOver=implode(',',$StopOver);
    
             $markup_array = $this->flight_markup->markup_calculation($PublishedFare,$this->fromCityCode,'tbo');
            //  echo $this->db->last_query();exit;
             
    //$keyexist = array_search('2', explode(',',$TripIndicator));
             $insert_info[$l]=array(
                'session_id' => $this->sess_id,
                'uniquerefno' => $this->sess_uniqueRefNo,
                'tbo_unique_id' => $ResultIndex,
                'api' => $this->api,
                'triptype' => $this->tripType,
                'origin' => $Origin,
                'destination' => $Destination,
                'adults' => $this->adults,
                'childs' => $this->childs,
                'infants' => $this->infants,
                'isdomestic' => $IsDomestic,
                'roundtrip' => $RoundTrip,
                'tripindicator' => $TripIndicator,
                'duration' => $Duration,
                'source' => $Source,
                'segment_indicator' => $SegmentIndicator,
                'operating_airlinecode' => $AirlineCode,
                'operating_airlinename' => $AirlineName,
                'operating_flightno' => $FlightNumber,
                'operating_fareclass' => $FareClass,
                'operating_airportname_o' => $AirportCode_o,
                'operating_terminal_o' => $Terminal_o,
                'operating_cityname_o' => $CityName_o,
                'operating_country_o' => $CountryName_o,
                'operating_airportname_d' => $AirportCode_d,
                'operating_terminal_d' => $Terminal_d,
                'operating_cityname_d' => $CityName_d,
                'operating_country_d' => $CountryName_d,
                'operating_deptime' => $DepTime,
                'operating_arritime' => $ArrTime,
                'islcc' => $IsLCC,
                'baggageinformation' => $Baggage,
                'nonrefundable' => $IsRefundable,
                'segmentkey' => $ResultIndex,
                'stops' => $StopOver,
                'stops2' => $flightcount,
                'basefare' => $BaseFare,
                'tax' => $Tax,
                'net_amount' => $PublishedFare,
                'admin_markup' => $markup_array['admin_markup'],
                'agent_markup' => $markup_array['agent_markup'],
                'payment_charge' => $markup_array['payment_charge'],
                'total_amount' => $markup_array['total_cost'],
                'currency' => 'INR',
                'tbo_session'=>$TraceId,
                'seats'=>$seats,
                'searcharray'=>$searcharray,
                'farecolor'=>$farecolor,
                'faretype'=>$faretype,
                'fareClassification'=>json_encode($FareClassification)
                );                
             $l++;
         }
               // exit;
     }
            //  echo '<pre>';print_r($insert_info);exit;
     if(!empty($insert_info)){
        $this->Tbo_Model->insert_flight_temp_results($insert_info);
        // echo $this->db->last_query();exit;
    }        
                    // --------------------------------------------------
    }
}

public function fetch_flight_search_results($searcharray) {
    $this->set_variables($searcharray);
    $flight_search_result1='';

    if ($this->flightmode==1) {
        if ($this->tripType == 'oneway') {
            $flight_result = $this->Tbo_Model->fetch_search_result($this->sess_id, $this->sess_uniqueRefNo, '1');
            
                $data['result'] = $flight_result; 
                 //echo '<pre>';print_r($data);exit;
                $flight_search_result = $this->load->view('tbo/search_result_oneway_ajax', $data, TRUE);
            } else {
                $flight_result = $this->Tbo_Model->fetch_search_result($this->sess_id, $this->sess_uniqueRefNo, 1);
                // echo $this->db->last_query();
                $flight_result1 = $this->Tbo_Model->fetch_search_result($this->sess_id, $this->sess_uniqueRefNo, 2);
                $data['result'] = $flight_result;
                $data['result1'] = $flight_result1;
                 // echo $triptype.'<pre>';print_r($flight_result);print_r($flight_result1);exit;
                $flight_search_result = $this->load->view('tbo/search_result_round_onward', $data, TRUE);
                
                // echo '<pre>';print_r($data1);exit;
                // $flight_search_result1 = $this->load->view('Tbo/search_result_round_return', $data1, TRUE);
            }
        } else {
            if ($this->tripType == 'S') {
                $flight_result = $this->Tbo_Model->fetch_search_result($this->sess_id, $this->sess_uniqueRefNo, 1);
                $data['result'] = $flight_result; //echo '';print_r($flight_result);exit;
                $flight_search_result = $this->load->view('tbo/search_result_oneway_ajax', $data, TRUE);
            } else {
                $flight_result = $this->Tbo_Model->fetch_search_result($this->sess_id, $this->sess_uniqueRefNo, 1);
                // $flight_result1 = $this->Tbo_Model->fetch_search_result($this->sess_id, '2');
                $data['result'] = $flight_result; //echo '<pre>';print_r($flight_result);exit;
                //  $data['result1'] = $flight_result1; //echo $triptype.'<pre>';print_r($data);exit;
                $flight_search_result = $this->load->view('tbo/search_result_int_round_ajax', $data, TRUE);
            }
        }
        if (empty($flight_result)) {
            $flight_search_result=$flight_search_result1= '<div class="col-lg-12 col-md-12 searchflight_box1">
            <div class="results-row card card-list card-list-view FlightInfoBox" >
                <div class="card-body d-flex justify-content-between flex-wrap align-content-around">
                No Flights Found.. Please try after some time...
                </div>
                </div>
                </div>';
            $this->session->unset_userdata('flight_search_activate');
        }
        
        echo json_encode(array("flight_search_result" => $flight_search_result,"flight_search_result1"=>$flight_search_result1));
    }

public function login(){
    // echo 123;exit;
    $query=$this->db->select('token')->from('tbotoken')->where('datetime >',date('Y-m-d').' 00:00:00')->get();
    if($query->num_rows() > 0){
        $result=$query->row();
        $token=$result->token;
        $this->session->set_userdata('airtoken',$token);
        return true;
    }
    $login = '{
         "ClientId": "'.$this->ClientId.'",
         "UserName": "'.$this->username.'",
         "Password": "'.$this->password.'",
         "EndUserIp": "'.$this->enduserip.'"
     }';
     $ch = curl_init();
     //curl_setopt($ch, CURLOPT_INTERFACE, '49.50.68.247');
     curl_setopt($ch, CURLOPT_HEADER, 0);
     curl_setopt($ch, CURLOPT_TIMEOUT, 30);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_URL, $this->loginurl);
     curl_setopt($ch, CURLOPT_POST, 1);
     curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
     curl_setopt($ch, CURLOPT_POSTFIELDS, $login);
     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
         'Content-Type: application/json',
         'Content-Length: ' . strlen($login))
     );
     $result = curl_exec($ch);
     curl_close($ch);//echo $this->loginurl;echo $result;exit;
     $res=$this->extractencode($login,$result,'login'); 
     $this->session->set_userdata('airtoken',$res->TokenId);
     if(!empty($res->TokenId)){
     $datainsert=array('token'=>$res->TokenId);
     $this->db->insert('tbotoken',$datainsert);
     }
     
 }
 public function extractencode($request,$response,$type){
    $res=json_decode($response);
    file_put_contents(FCPATH . 'dump/flights/'.$type.'rq.xml', $request);
    file_put_contents(FCPATH . 'dump/flights/'.$type.'rs.json', $response);
    return $res;
}

public function flights_fareLLSRQ($searchId) {
    // $this->set_variables();
    $flight_result = $this->Tbo_Model->get_flight_search_result($searchId);


    $tbo_token_id= $this->session->userdata('airtoken');
    $fare_xml='{
        "EndUserIp": "'.$this->ip.'",
        "TokenId": "'.$tbo_token_id.'",
        "TraceId": "'.$flight_result->tbo_session.'",
        "ResultIndex": "'.$flight_result->segmentkey.'"
    }';
    //  echo $fare_xml;
    //file_put_contents(FCPATH . 'dump/flights/tbo_air_farerules' . $this->roundtrip_count . '_request.xml', $fare_xml);
    $farequoteresponse = $this->processRequest($fare_xml, 'FareRule/');
    //$this->db->set('farequote_request', " CONCAT_WS('',farequote_request,'" . mysqli_real_escape_string($fare_xml) . "')", FALSE);
    //$this->db->set('farequote_response', " CONCAT_WS('',farequote_response,'" . mysqli_real_escape_string($farequoteresponse) . "')", FALSE);
    //$this->Logger->append_by_ref('flights_api_logs', $this->session->userdata('sess_uniqueRefNo'), $this->api, array());
    $farequoteresp=$this->extractencode($fare_xml,$farequoteresponse,'FareRule'.$flight_result->roundtrip);
    //file_put_contents(FCPATH . 'dump/flights/tbo_air_farerules' . $this->roundtrip_count. '_response.xml', $farequoteresp);
    $FareRule = $farequoteresp->Response->FareRules[0]->FareRuleDetail;
    //  echo '<pre>1322'; print_r($farequoteresp); //exit;
    if(!empty($FareRule)){
        //echo json_encode(array("flight_farerules" => $FareRule));
    } else {
        //echo json_encode(array("flight_farerules" => '<b style="font-size: 22px;">No Fare Rules Available</b>'));
    }

    
}



public function processRequest($request, $type) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 180);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $this->posturl.$type);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($request))
    );
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

public function getAirportCode($city) {
    if(!is_null($city)){
        preg_match_all('/\(([A-Za-z ]+?)\)/', $city, $out);
        $airportCode = $out[1];
        if (!empty($airportCode))
            return $airportCode[0];
    }
   
}

public function get_fareQuote($flight_result) {
    // $this->set_variables($flight_result->searcharray);
    // echo "<pre>";print_r($flight_result);exit;
    $tbo_token_id= $this->session->airtoken;
    $fare_xml='{
        "EndUserIp": "'.$this->ip.'",
        "TokenId": "'.$tbo_token_id.'",
        "TraceId": "'.$flight_result->tbo_session.'",
        "ResultIndex": "'.$flight_result->segmentkey.'"
    }';
      // echo $fare_xml;
//file_put_contents(FCPATH . 'dump/flights/tbo_air_farequote' . $this->roundtrip_count . '_request.xml', $fare_xml);
    $farequoteresponse = $this->processRequest($fare_xml, 'FareQuote/');
//    $this->db->set('farequote_request', " CONCAT_WS('',farequote_request,'" . mysqli_real_escape_string($fare_xml) . "')", FALSE);
//    $this->db->set('farequote_response', " CONCAT_WS('',farequote_response,'" . mysqli_real_escape_string($farequoteresponse) . "')", FALSE);
//    $this->Logger->append_by_ref('flights_api_logs', $this->sess_uniqueRefNo, $this->api, array());
    $farequoteresp=$this->extractencode($fare_xml,$farequoteresponse,'farequote'.$flight_result->roundtrip);
     //echo '<pre>';print_r($farequoteresp);exit;
//file_put_contents(FCPATH . 'dump/flights/tbo_air_farequote' . $this->roundtrip_count . '_response.xml', $farequoteresponse);
// echo '<pre>';print_r($farequoteresp->Response->ResponseStatus);exit;
$this->roundtrip_count++;
//exit;

    if (isset($farequoteresp->Response)) {

        if ($farequoteresp->Response->ResponseStatus != '1') {
            $this->unset_session_search_data();
            $data = array();
            $error = 'Your booking session is expired please start a new search.';
            // redirect('home/error_page/' . base64_encode($error));
        }

    } else {
        $error = 'No result in fare quote response';
        // redirect('home/error_page/' . base64_encode($error));
    }
// echo '<pre>';print_r($farequoteresp);exit;
    $Results=$farequoteresp->Response->Results;
    $ResultIndex=$Results->ResultIndex;
    $IsRefundable=$Results->IsRefundable;
    $GSTAllowed=$Results->GSTAllowed;
    $IsGSTMandatory=$Results->IsGSTMandatory;

    $Currency=$Results->Fare->Currency;
    $BaseFare=$Results->Fare->BaseFare;
    $Tax=($Results->Fare->Tax)+($Results->Fare->OtherCharges);
    $PublishedFare=$Results->Fare->PublishedFare;
     //echo '<pre>';print_r(($Results));exit;
    //$NET_PRICE = $TOTAL_PRICE;
    $this->load->module('flights/flight_markup');
    $markup_array = $this->flight_markup->markup_calculation($PublishedFare, 'BLR', $this->api);

    $insertfarequoteData = array(
        'basefare' => $BaseFare,
        'tax' => $Tax,
        'net_amount' => $PublishedFare,
        'admin_markup' => $markup_array['admin_markup'],
        'agent_markup' => $markup_array['agent_markup'],
        'payment_charge' => $markup_array['payment_charge'],
        'total_amount' => $markup_array['total_cost'],
        'currency' => $Currency,
        'gstallowed' => $GSTAllowed,
        'gstmandatory' => $IsGSTMandatory,
        'fareresponse' => json_encode($Results->FareBreakdown)
        );

    $this->Tbo_Model->updatefare_quote($insertfarequoteData, $flight_result->search_id);


}
public function get_special_request($flight_result) {
    // $this->set_variables($flight_result->searcharray);
    // echo '<pre>'; print_r($flight_result);
    $tbo_token_id= $this->session->userdata('airtoken');
    $ssr_xml='{
        "EndUserIp": "'.$this->ip.'",
        "TokenId": "'.$tbo_token_id.'",
        "TraceId": "'.$flight_result->tbo_session.'",
        "ResultIndex": "'.$flight_result->segmentkey.'"
    }';
    $ssrresponse = $this->processRequest($ssr_xml, 'SSR/');
    $ssrresponsex=$this->extractencode($ssr_xml,$ssrresponse,'ssr'.$flight_result->roundtrip);

// echo '<pre>';print_r($ssrresponsex);exit;
//    $this->db->set('special_request', " CONCAT_WS('',special_request,'" . mysql_real_escape_string($ssr_xml) . "')", FALSE);
//    $this->db->set('special_response', " CONCAT_WS('',special_response,'" . mysql_real_escape_string($ssrresponse) . "')", FALSE);
//    $this->Logger->append_by_ref('flights_api_logs', $this->sess_uniqueRefNo, $this->api, array());

    return $ssrresponsex;
    // echo '<pre>'; print_r($ssrresponse); exit;
}
function unset_session_search_data() {
    $this->session->unset_userdata('sess_uniqueRefNo');
    $this->session->unset_userdata('flight_search_data');
}

public function flight_book($searchId) {
   
    // echo 1;exit;
    $data['flight_result'] = $flight_result = $this->Tbo_Model->get_flight_search_result($searchId);
    //  echo '<pre>'; print_r($data['flight_result']); exit;
        //  $data['country_list'] = $this->Tbo_Model->get_country_list();
    $this->set_variables($flight_result->searcharray);
    $ezeeRefNo = $this->sess_uniqueRefNo;

    $pass_xml = $this->passenger_details($data['flight_result']);

    $Persons = $pass_xml['Person'];
    //$payment_inform = $pass_xml['pay_information'];

        // PASSENGER DETAILS
    
    $tbo_token_id= $this->session->airtoken;
    $nonlccbook='{
        "EndUserIp": "'.$this->ip.'",
        "TokenId": "'.$tbo_token_id.'",
        "TraceId": "'.$flight_result->tbo_session.'",
        "ResultIndex": "'.$flight_result->segmentkey.'",
        "Passengers": ['.$Persons.']
      }';

        // echo $nonlccbook;exit;
//file_put_contents(FCPATH . 'dump/flights/tbo_air_booking' . $this->roundtrip_count . '_request.xml', $nonlccbook);
    $bookresponse = $this->processRequest($nonlccbook, 'Book/');
    $bookresp=$this->extractencode($nonlccbook,$bookresponse,'Book'.$flight_result->roundtrip);
   // $this->db->set('booking_request', " CONCAT_WS('',booking_request,'" . mysql_real_escape_string($nonlccbook) . "')", FALSE);
   // $this->db->set('booking_response', " CONCAT_WS('',booking_response,'" . mysql_real_escape_string($bookresponse) . "')", FALSE);
//    $this->Logger->append_by_ref('flights_api_logs', $this->sess_uniqueRefNo, $this->api, ar   ray());
//file_put_contents(FCPATH . 'dump/flights/tbo_air_booking' . $this->roundtrip_count . '_response.xml', $bookresponse);
        //echo $bookresponse;
    return $bookresp;
}

// public function passenger_details($flightresult,$meal) {
public function passenger_details($flightresult) {
    $airlinecode = array_intersect($this->allowed_ssr_fligts, explode(',', $flightresult->operating_airlinecode));
    $adults = $flightresult->adults;
   // echo '<pre>12';print_r($flightresult);exit;
        // CREATING FARE, SEGMENTS, FARERULE XML ELEMENTS
        // PASSENGER DETAILS
    $passenger_info = $this->session->passenger_info;
    // echo"<pre>jk";print_r($this->session->passenger_info);exit;
    $adultTitle = $passenger_info['selTitle'];
    $adultFName = $passenger_info['first_name'];
    $adultLName = $passenger_info['last_name'];
    $adultdobyear = $passenger_info['txtdobY'];
    $adultdobmon = $passenger_info['txtdobM'];
    $adultdobdate = $passenger_info['txtdobD'];
    //$adultGender = $passenger_info['adultGender'];
    $adultPPNationality = $passenger_info['nationality'][0];

    // echo '<pre/>';print_r($passenger_info['adultPPNationality'][0]);exit;
    if ($flightresult->isdomestic == 'true') {
        $adultPPNo = '';
        $adultPPEDate = '';
        $adultPPEMonth = '';
        $adultPPEYear = '';
        $adultPPICountry = '';
        $adultPPExpire = '';
    } else {
        $adultPPNo = $passenger_info['passport_no'];
        $adultPPEDate = $passenger_info['txtpedD'];
        $adultPPEMonth = $passenger_info['txtpedM'];
        $adultPPEYear = $passenger_info['txtpedY'];
        $adultPPICountry = $passenger_info['issued_country'];
    }

    if ($this->childs != 0) {
        $childTitle = $passenger_info['childTitle'];
        $childFName = $passenger_info['childFName'];
        $childLName = $passenger_info['childLName'];
        $childdobyear = $passenger_info['childDOBYear'];
        $childdobmon = $passenger_info['childDOBMonth'];
        $childdobdate = $passenger_info['childDOBDate'];
        $childPPNationality = $passenger_info['childPPNationality'][0];
        //$childGender = $passenger_info['childGender'];
        if ($flightresult->isdomestic == 'true') {
            $childPPNo = '';
            $childPPEDate = '';
            $childPPEMonth = '';
            $childPPEYear = '';
            $childPPICountry = '';
        } else {
            $childPPNo = $passenger_info['childPPNo'];
            $childPPEDate = $passenger_info['childPPEDate'];
            $childPPEMonth = $passenger_info['childPPEMonth'];
            $childPPEYear = $passenger_info['childPPEYear'];
            $childPPICountry = $passenger_info['childPPICountry'];
        }
    }

    if ($this->infants != 0) {
        // echo 45;exit;
        $infantTitle = $passenger_info['infantTitle'];
        $infantFName = $passenger_info['infantFName'];
        $infantLName = $passenger_info['infantLName'];
        $infantdobyear = $passenger_info['infantDOBYear'];
        $infantdobmon = $passenger_info['infantDOBMonth'];
        $infantdobdate = $passenger_info['infantDOBDate'];
        //$infantGender = $passenger_info['infantGender'];
        $infantPPNationality = $passenger_info['infantPPNationality'][0];
        if ($flightresult->isdomestic == 'true') {
            $infantPPNo = '';
            $infantPPEDate = '';
            $infantPPEMonth = '';
            $infantPPEYear = '';
            $infantPPICountry = '';
        } else {
            $infantPPNo = $passenger_info['infantPPNo'];
            $infantPPEDate = $passenger_info['infantPPEDate'];
            $infantPPEMonth = $passenger_info['infantPPEMonth'];
            $infantPPEYear = $passenger_info['infantPPEYear'];
            $infantPPICountry = $passenger_info['infantPPICountry'];
        }
    }

    $user_email = $passenger_info['email'];
    $user_mobile = $passenger_info['phone'];
    $origin=explode(',',$flightresult->operating_airportname_o);
    $destination=explode(',',$flightresult->operating_airportname_d);
    $gstinformation='"GSTCompanyAddress": "'.$passenger_info['GstAddress'].'",
    "GSTCompanyContactNumber": "'.$passenger_info['GstContactNumber'].'",
    "GSTCompanyName": "'.$passenger_info['GstCompanyName'].'",
    "GSTNumber": "'.$passenger_info['GstNumber'].'",
    "GSTCompanyEmail": "'.$passenger_info['GstEmail'].'",
    
    ';
    $meal=''; $baggage='';
    if($flightresult->meal_code!=''){
        // echo '<pre>1522';print_r($flightresult);exit;
        // $tripindicator = explode(',', $flightresult->tripindicator);
        // $WayType = array_unique(implode(',',$tripindicator));
        // $WayType = implode(',',array_unique(explode(',', $flightresult->tripindicator)));
       // if($flightresult->triptype == 'R'){
       //  $WayType = 2;
       // }else{
       //   $WayType = 1;
       // }
        // echo '<pre>';print_r($WayType);exit;
        $meal.='
            "MealDynamic": [{
            "WayType": "'.$flightresult->meal_WayType.'",
            "Code": "'.$flightresult->meal_code.'",
            "Description": 2,
            "AirlineDescription": "'.$flightresult->meal_desc.'",
            "Quantity": "'.$flightresult->meal_quantity.'",
            "BaseCurrency": "INR",
            "BaseCurrencyPrice": "'.$flightresult->meal_price.'",
            "Currency": "INR",
            "Price": "'.$flightresult->meal_price.'",
            "Origin": "'.$flightresult->Origin_ssr.'",
            "Destination": "'.$flightresult->Destination_ssr.'"
        }]';
    }else{
        $meal.='"MealDynamic":[]';
    }
    if($flightresult->baggage_code != ''){
    // $WayType = implode(',',array_unique(explode(',', $flightresult->tripindicator)));
    // if($flightresult->triptype == 'R'){
    //     $WayType = 2;
    // }else{
    //      $WayType = 1;
    // }
    $baggage.='
        "Baggage": [{
        "WayType":"'.$flightresult->baggage_WayType.'",
        "Code": "'.$flightresult->baggage_code.'",
        "Description": 2,
        "Weight": "'.$flightresult->baggage_weight.'",
        "BaseCurrencyPrice": "'.$flightresult->baggage_price.'",
        "BaseCurrency": "INR",
        "Currency": "INR",
        "Price": "'.$flightresult->baggage_price.'",
        "Origin": "'.$flightresult->Origin_ssr.'",
        "Destination": "'.$flightresult->Destination_ssr.'"
      }]';
    }else{
        $baggage.=' "Baggage":[]';
    }

   // $this->getfaredata($flightresult->fareresponse);
    $fareresparray=json_decode($flightresult->fareresponse);

    $Persons = '';
    $ind = 0;   

    for ($adt = 0; $adt < count($adultFName); $adt++) {
        // echo 1;exit;
        // $AdultFare = '';//$Fare;
        // $AdultFare['BaseFare'] = $pass_farequote[$ind]['BaseFare'];
        // $AdultFare['Tax'] = $pass_farequote[$ind]['Tax'];
        // $AdultFare['AdditionalTxnFee'] = $pass_farequote[$ind]['AdditionalTxnFee'];
        // $AdultFare['FuelSurcharge'] = $pass_farequote[$ind]['FuelSurcharge'];
        // $AdultFare['AgentConvienceCharges'] = $pass_farequote[$ind]['AgentConvienceCharges'];

        if ($flightresult->isdomestic == 'true') {
            $passportDetails = '';
            //$datoba='';
        } else {
            $passportDetails = '"PassportNo": "' . $adultPPNo[$adt] . '",
            "PassportExpiry": "' . $adultPPEYear[$adt] . '-' . $adultPPEMonth[$adt] . '-' . $adultPPEDate[$adt] . 'T00:00:00' . '",';
           
        }
        $datoba='"DateOfBirth": "' . $adultdobyear[$adt] . '-' . $adultdobmon[$adt] . '-' . $adultdobdate[$adt] . 'T00:00:00",';

        $PassengerCount=$fareresparray[0]->PassengerCount;
        $BaseFare=$fareresparray[0]->BaseFare / $PassengerCount;
        $Tax=$fareresparray[0]->Tax / $PassengerCount;
        $YQTax=$fareresparray[0]->YQTax / $PassengerCount;
        $AdditionalTxnFeeOfrd=$fareresparray[0]->AdditionalTxnFeeOfrd / $PassengerCount;
        $AdditionalTxnFeePub=$fareresparray[0]->AdditionalTxnFeePub / $PassengerCount;
        $PGCharge=$fareresparray[0]->PGCharge / $PassengerCount;


        $adultfare='{"BaseFare":'.$BaseFare.',"Tax":'.$Tax.',"TransactionFee":0,"YQTax":'.$YQTax.',"AdditionalTxnFeeOfrd":'.$AdditionalTxnFeeOfrd.',"AdditionalTxnFeePub":'.$AdditionalTxnFeePub.',"AirTransFee":0}';

            if($adultTitle[$adt] == 'Mr'){
                $GenderA = 1;
            } else {
                $GenderA = 2;
            }
            
          if($ind == 0) {
            $IsLeadPax = 'true';
          }
           else
          {
            $IsLeadPax = 'false';
          }
 
           $Persons.='{
                "Title": "'.$adultTitle[$adt].'",
                "FirstName": "'.$adultFName[$adt].'",
                "LastName": "'.$adultLName[$adt].'",
                "PaxType": 1,
                '.$datoba.'
                "Gender": "'.$GenderA.'",
                '.$passportDetails.'
                "AddressLine1": "string",
                "AddressLine2": "",
                "City": "Gurgaon",
                "CountryCode": "IN",
                "CountryName": "India",
                "Nationality": "'.$adultPPNationality.'",
                "ContactNo": "'.$user_mobile.'",
                "Email": "'.$user_email.'",
                "IsLeadPax": '.$IsLeadPax.',
                "FFAirline": null,
                "FFNumber": "",
                '.$meal.',
                '.$baggage.',
                '.$gstinformation.'
                "Fare": '.$adultfare.'
            },';
            $ind++;
        }


    // echo '<pre>1';print_r($Persons);exit;
    if ($this->childs != 0 && !empty($childFName)) {
        for ($chd = 0; $chd < count($childFName); $chd++) {
            // echo 34;exit;
            // $ChildFare = '';//$Fare;
            // $ChildFare['BaseFare'] = $pass_farequote[$ind]['BaseFare'];
            // $ChildFare['Tax'] = $pass_farequote[$ind]['Tax'];
            // $ChildFare['AdditionalTxnFee'] = $pass_farequote[$ind]['AdditionalTxnFee'];
            // $ChildFare['FuelSurcharge'] = $pass_farequote[$ind]['FuelSurcharge'];
            // $ChildFare['AgentConvienceCharges'] = $pass_farequote[$ind]['AgentConvienceCharges'];
          //  $xmlObj = Array2XML_TBO::createXML('Fare', $ChildFare);
            
            if ($flightresult->isdomestic == 'true') {
                $passportDetailsc = '';
                //$dateofc='';
            } else {
                $passportDetailsc = '
                "PassportNo": "' . $childPPNo[$chd] . '",
                "PassportExpiry": "' . $childPPEYear[$chd] . '-' . $childPPEMonth[$chd] . '-' . $childPPEDate[$chd] . 'T00:00:00' . '",';
                
            }
            $dateofc='"DateOfBirth": "' . $childdobyear[$chd] . '-' . $childdobmon[$chd] . '-' . $childdobdate[$chd] . 'T00:00:00",';

            $PassengerCount=$fareresparray[1]->PassengerCount;
            $BaseFare=$fareresparray[1]->BaseFare / $PassengerCount;
            $Tax=$fareresparray[1]->Tax / $PassengerCount;
            $YQTax=$fareresparray[1]->YQTax / $PassengerCount;
            $AdditionalTxnFeeOfrd=$fareresparray[1]->AdditionalTxnFeeOfrd / $PassengerCount;
            $AdditionalTxnFeePub=$fareresparray[1]->AdditionalTxnFeePub / $PassengerCount;
            $PGCharge=$fareresparray[1]->PGCharge / $PassengerCount;

            $childfare='{"BaseFare":'.$BaseFare.',"Tax":'.$Tax.',"TransactionFee":0,"YQTax":'.$YQTax.',"AdditionalTxnFeeOfrd":'.$AdditionalTxnFeeOfrd.',"AdditionalTxnFeePub":'.$AdditionalTxnFeePub.',"AirTransFee":0}';

            if($childTitle[$chd] == 'Mstr'){
                $GenderC = 1;
            } else {
                $GenderC = 2;
            }

                    $Persons.='{
                        "Title": "'.$childTitle[$chd].'",
                        "FirstName": "'.$childFName[$chd].'",
                        "LastName": "'.$childLName[$chd].'",
                        "PaxType": 2,
                        '.$dateofc.'
                        "Gender": "'.$GenderC.'",
                        '.$passportDetailsc.'
                        "AddressLine1": "string",
                        "AddressLine2": "",
                        "City": "Gurgaon",
                        "CountryCode": "IN",
                        "CountryName": "India",
                        "Nationality": "'.$childPPNationality.'",
                        "ContactNo": "'.$user_mobile.'",
                        "Email": "'.$user_email.'",
                        "IsLeadPax": false,
                        "FFAirline": null,
                        "FFNumber": "",
                        '.$gstinformation.'
                        "Fare": '.$childfare.'
                    },';
                    $ind++;
                }
            }
     // echo '<pre>2';print_r($Persons)exit;
    if ($this->infants != 0 && !empty($infantFName)) {
        for ($inf = 0; $inf < count($infantFName); $inf++) {
            // echo 96;exit;
            // $InfantFare = '';//$Fare;
            // $InfantFare['BaseFare'] = $pass_farequote[$ind]['BaseFare'];
            // $InfantFare['Tax'] = $pass_farequote[$ind]['Tax'];
            // $InfantFare['AdditionalTxnFee'] = $pass_farequote[$ind]['AdditionalTxnFee'];
            // $InfantFare['FuelSurcharge'] = $pass_farequote[$ind]['FuelSurcharge'];
            // $InfantFare['AgentConvienceCharges'] = $pass_farequote[$ind]['AgentConvienceCharges'];
           // $xmlObj = Array2XML_TBO::createXML('Fare', $InfantFare);
            
            if ($flightresult->isdomestic == 'true') {
                $passportDetailsi = '';
               // $dateofi='';
            } else {

                $passportDetailsi = '"PassportNo": "' . $infantPPNo[$inf] . '",
                "PassportExpiry": "' . $infantPPEYear[$inf] . '-' . $infantPPEMonth[$inf] . '-' . $infantPPEDate[$inf] . 'T00:00:00' . '",';
               
            }
            $dateofi='"DateOfBirth": "' . $infantdobyear[$inf] . '-' . $infantdobmon[$inf] . '-' . $infantdobdate[$inf] . 'T00:00:00",';

        $PassengerCount=$fareresparray[2]->PassengerCount;
        $BaseFare=$fareresparray[2]->BaseFare / $PassengerCount;
        $Tax=$fareresparray[2]->Tax / $PassengerCount;
        $YQTax=$fareresparray[2]->YQTax / $PassengerCount;
        $AdditionalTxnFeeOfrd=$fareresparray[2]->AdditionalTxnFeeOfrd / $PassengerCount;
        $AdditionalTxnFeePub=$fareresparray[2]->AdditionalTxnFeePub / $PassengerCount;
        $PGCharge=$fareresparray[2]->PGCharge / $PassengerCount;

        $infantfare='{"BaseFare":'.$BaseFare.',"Tax":'.$Tax.',"TransactionFee":0,"YQTax":'.$YQTax.',"AdditionalTxnFeeOfrd":'.$AdditionalTxnFeeOfrd.',"AdditionalTxnFeePub":'.$AdditionalTxnFeePub.',"AirTransFee":0}';

        if($infantTitle[$inf] == 'Mstr'){
            $GenderI = 1;
        } else {
            $GenderI = 2;
        }

            $Persons.='{
                "Title": "'.$infantTitle[$inf].'",
                "FirstName": "'.$infantFName[$inf].'",
                "LastName": "'.$infantLName[$inf].'",
                "PaxType": 3,
                '.$dateofi.'
                "Gender": "'.$GenderI.'",
                '.$passportDetailsi.'
                "AddressLine1": "string",
                "AddressLine2": "",
                "City": "Gurgaon",
                "CountryCode": "IN",
                "CountryName": "India",
                "Nationality": "'.$infantPPNationality.'",
                "ContactNo": "'.$user_mobile.'",
                "Email": "'.$user_email . '",
                "IsLeadPax": false,
                "FFAirline": null,
                "FFNumber": "",
                '.$gstinformation.'
                "Fare": '.$infantfare.'
            },';
            $ind++;
         // echo '<pre>1';print_r($Persons)exit;
        }
    }

    $dataxml['Person'] = $Persons;
    // echo '<pre>1';print_r($dataxml['Person'] )exit;

    return $dataxml;
    }

public function getfaredata($flightresult){

    $passengercount=$flightresult->adults + $flightresult->childs + $flightresult->infants;   
    $fareresparray=json_decode($flightresult->fareresponse);


$PassengerCount=$fareresparray[0]->PassengerCount;
$BaseFare=$fareresparray[0]->BaseFare / $PassengerCount;
$Tax=$fareresparray[0]->Tax / $PassengerCount;
$YQTax=$fareresparray[0]->YQTax / $PassengerCount;
$AdditionalTxnFeeOfrd=$fareresparray[0]->AdditionalTxnFeeOfrd / $PassengerCount;
$AdditionalTxnFeePub=$fareresparray[0]->AdditionalTxnFeePub / $PassengerCount;
$PGCharge=$fareresparray[0]->PGCharge / $PassengerCount;

$adultfare='{"BaseFare":'.$BaseFare.',"Tax":'.$Tax.',"TransactionFee":0,"YQTax":'.$YQTax.',"AdditionalTxnFeeOfrd":'.$AdditionalTxnFeeOfrd.',"AdditionalTxnFeePub":'.$AdditionalTxnFeePub.',"AirTransFee":0}';

$childfare='{"BaseFare":'.$BaseFare.',"Tax":'.$Tax.',"TransactionFee":0,"YQTax":'.$YQTax.',"AdditionalTxnFeeOfrd":'.$AdditionalTxnFeeOfrd.',"AdditionalTxnFeePub":'.$AdditionalTxnFeePub.',"AirTransFee":0}';

$infantfare='{"BaseFare":'.$BaseFare.',"Tax":'.$Tax.',"TransactionFee":0,"YQTax":'.$YQTax.',"AdditionalTxnFeeOfrd":'.$AdditionalTxnFeeOfrd.',"AdditionalTxnFeePub":'.$AdditionalTxnFeePub.',"AirTransFee":0}';


    $BaseFare=$fareresparray->BaseFare / $passengercount;
    $Tax=$fareresparray->Tax / $passengercount;

    $YQTax=$fareresparray->YQTax / $passengercount;
    $AdditionalTxnFeeOfrd=$fareresparray->AdditionalTxnFeeOfrd / $passengercount;
    $AdditionalTxnFeePub=$fareresparray->AdditionalTxnFeePub / $passengercount;
    $PGCharge=$fareresparray->PGCharge / $passengercount;
    $OtherCharges=$fareresparray->OtherCharges / $passengercount;

    $Discount=$fareresparray->Discount / $passengercount;
    $PublishedFare=$fareresparray->PublishedFare / $passengercount;
    $CommissionEarned=$fareresparray->CommissionEarned / $passengercount;
    $PLBEarned=$fareresparray->PLBEarned / $passengercount;
    $IncentiveEarned=$fareresparray->IncentiveEarned / $passengercount;
    $OfferedFare=$fareresparray->OfferedFare / $passengercount;
    $TdsOnCommission=$fareresparray->TdsOnCommission / $passengercount;
    $TdsOnPLB=$fareresparray->TdsOnPLB / $passengercount;
    $TdsOnIncentive=$fareresparray->TdsOnIncentive / $passengercount;
    $ServiceFee=$fareresparray->ServiceFee / $passengercount;
    $TotalBaggageCharges=$fareresparray->TotalBaggageCharges / $passengercount;
    $TotalMealCharges=$fareresparray->TotalMealCharges / $passengercount;
    $TotalSpecialServiceCharges=$fareresparray->TotalSpecialServiceCharges / $passengercount;

    $taxbre=array();
    foreach($fareresparray->TaxBreakup as $val){
        $taxbre[$val->key]=$val->value / $passengercount;
    }
    $charge=array();
    foreach($fareresparray->ChargeBU as $val1){
        $charge[$val1->key]=$val1->value / $passengercount;
    }
// echo '<pre>';print_r($taxbre);print_r($charge);exit;
    $faredata='{"Currency":"INR","BaseFare":'.$BaseFare.',"Tax":'.$Tax.',"TaxBreakup":[{"key":"K3","value":'.$taxbre["K3"].'},{"key":"YQTax","value":'.$taxbre["YQTax"].'},{"key":"YR","value":'.$taxbre["YR"].'},{"key":"PSF","value":'.$taxbre["PSF"].'},{"key":"UDF","value":'.$taxbre["UDF"].'},{"key":"INTax","value":'.$taxbre["INTax"].'},{"key":"TransactionFee","value":'.$taxbre["TransactionFee"].'},{"key":"OtherTaxes","value":'.$taxbre["OtherTaxes"].'}],"YQTax":'.$YQTax.',"AdditionalTxnFeeOfrd":'.$AdditionalTxnFeeOfrd.',"AdditionalTxnFeePub":'.$AdditionalTxnFeePub.',"PGCharge":'.$PGCharge.',"OtherCharges":'.$OtherCharges.',"ChargeBU":[{"key":"TBOMARKUP","value":'.$charge["TBOMARKUP"].'},{"key":"CONVENIENCECHARGE","value":'.$charge["CONVENIENCECHARGE"].'},{"key":"OTHERCHARGE","value":'.$charge["OTHERCHARGE"].'}],"Discount":'.$Discount.',"PublishedFare":'.$PublishedFare.',"CommissionEarned":'.$CommissionEarned.',"PLBEarned":'.$PLBEarned.',"IncentiveEarned":'.$IncentiveEarned.',"OfferedFare":'.$OfferedFare.',"TdsOnCommission":'.$TdsOnCommission.',"TdsOnPLB":'.$TdsOnPLB.',"TdsOnIncentive":'.$TdsOnIncentive.',"ServiceFee":'.$ServiceFee.',"TotalBaggageCharges":'.$TotalBaggageCharges.',"TotalMealCharges":'.$TotalMealCharges.',"TotalSpecialServiceCharges":'.$TotalSpecialServiceCharges.'}';
return $faredata;
}

// public function ticketing($searchId, $PNR='', $BookingId='',$pass='',$meal) {
public function ticketing($searchId, $PNR='', $BookingId='',$pass='') {

    // echo '<pre/>123';print_r($meal);exit;
    $data['flight_result'] = $this->Tbo_Model->get_flight_search_result($searchId);
    // echo $this->db->last_query();exit;
    sleep(1);
    
    $this->set_variables($data['flight_result']->searcharray);
    $ezeeRefNo=$this->sess_uniqueRefNo;
    

    if($data['flight_result']->islcc=='1'){
        // $ticketRS = $this->flight_ticketinglccRQ($data['flight_result'], $BookingId,$meal);
        // echo"<pre>";print_r($this->session->passenger_info);exit;
        $ticketRS = $this->flight_ticketinglccRQ($data['flight_result'], $BookingId); 
        // echo"<pre>";print_r($ticketRS);exit;
        $ticketRS->Response->Error->ErrorCode;       
        if((int)$ticketRS->Response->Error->ErrorCode==0){ 
          $PNR=$ticketRS->Response->Response->PNR;
          $BookingId=$ticketRS->Response->Response->BookingId; 
      }
  }else{
    if(!empty($PNR)){
        $ticketRS = $this->flight_ticketingnonlccRQ($data['flight_result'],$PNR, $BookingId);
        //echo"<pre>";print_r($ticketRS);exit;
    }
}
$status = 'Pending';
$RefId = 0;
        /* echo 'SUCCESSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS';        print_r($ticketresponse);
        exit; */
    // GETBOOKING DETAILS
        if(!empty($PNR)){
            $getbookdetails = $this->flight_getBooking($data['flight_result'],$PNR, $BookingId);
            $ticket_details = array();
            $Passenger=$getbookdetails->Response->FlightItinerary->Passenger;
            if(!empty($Passenger)){
                foreach($Passenger as $val5){
                    $pax_ticket = array();
                    $pax_ticket['ticketid']=$val5->Ticket->TicketId ? $val5->Ticket->TicketId : 0;
                    $pax_ticket['ticketNo']=$val5->Ticket->TicketNumber ? $val5->Ticket->TicketNumber : 0;
                    $pax_ticket['status']=$val5->Ticket->Status ? $val5->Ticket->Status : 0;
                    $pax_ticket['fname']=$val5->FirstName ? $val5->FirstName : 0;
                    $pax_ticket['lname']=$val5->LastName ? $val5->LastName :0;

                    $Baggage=$val5->SegmentAdditionalInfo? $val5->SegmentAdditionalInfo :0; 
                    $pax_ticket['Baggage'] = $Baggage[0]->Baggage;
                    $ticket_details[] = $pax_ticket;
                }
                $this->session->set_userdata('flight_pax_tickets', $ticket_details);

                $status = 'Ticketed';

            }
        }

        $this->Tbo_Model->insert_booking_report($ezeeRefNo, $BookingId, $PNR, $status, $data['flight_result'], $RefId, '1', $data['flight_result']->total_amount);
        // echo '<pre/>';print_r($data['flight_result']);exit;
        //echo $this->db->last_query();exit;
       // if($pass!=1){
            $this->Tbo_Model->insert_booking_passenger_info($ezeeRefNo, $BookingId, $data['flight_result']->isdomestic);
        //}
        //echo $this->db->last_query();exit;
        
        return array($ezeeRefNo,$BookingId);             
    }

    // public function flight_ticketinglccRQ($flight_result, $BookingId,$meal) {
    public function flight_ticketinglccRQ($flight_result, $BookingId) {


        // $pass_xml = $this->passenger_details($flight_result,$meal);
        $pass_xml = $this->passenger_details($flight_result);

        //$fare = $pass_xml['fare'];
        //$segment = $pass_xml['segment'];
        //$farerule = $pass_xml['farerule'];
        $Persons = $pass_xml['Person'];
        // echo $Persons;exit;
        //$payment_inform = $pass_xml['pay_information'];
   
           // PASSENGER DETAILS
   
        $tbo_token_id= $this->session->airtoken;
        $xmlticket='{
           "PreferredCurrency":"INR",
           "IsBaseCurrencyRequired":"true",
           "EndUserIp": "'.$this->ip.'",
           "TokenId": "'.$tbo_token_id.'",
           "TraceId": "'.$flight_result->tbo_session.'",
           "ResultIndex": "'.$flight_result->segmentkey.'",
           "Passengers": ['.$Persons.']
       }';
   
           //echo $xmlticket;
   //file_put_contents(FCPATH . 'dump/flights/tbo_air_ticketing' . $this->roundtrip_count . '_request.xml', $xmlticket);
       $ticketRS = $this->processRequest($xmlticket, 'Ticket/');
       $ticketresp = $this->extractencode($xmlticket,$ticketRS,'Ticket'.$flight_result->roundtrip);
    //   $this->db->set('ticket_request', " CONCAT_WS('',ticket_request,'" . mysql_real_escape_string($xmlticket) . "')", FALSE);
    //   $this->db->set('ticket_response', " CONCAT_WS('',ticket_response,'" . mysql_real_escape_string($ticketRS) . "')", FALSE);
    //   $this->Logger->append_by_ref('flights_api_logs', $this->sess_uniqueRefNo, $this->api, array());
   
   //file_put_contents(FCPATH . 'dump/flights/tbo_air_ticketing' . $this->roundtrip_count . '_response.xml', $ticketRS);
       return $ticketresp;
   }

   public function flight_ticketingnonlccRQ($flight_result,$pnr, $BookingId) {

    $pass_xml = $this->passenger_details($flight_result);
//    $fare = $pass_xml['fare'];
   // $segment = $pass_xml['segment'];
   // $farerule = $pass_xml['farerule'];
    $Persons = $pass_xml['Person'];
   // $payment_inform = $pass_xml['pay_information'];
   
           // PASSENGER DETAILS
   
    $tbo_token_id= $this->session->airtoken;
    $nonlccticket='{
       "EndUserIp": "'.$this->ip.'",
       "TokenId": "'.$tbo_token_id.'",
       "TraceId": "'.$flight_result->tbo_session.'",
       "PNR": "'.$pnr.'",
       "BookingId": "'.$BookingId.'"
   }';
   
           //echo $xmlticket;
   $ticketRS = $this->processRequest($nonlccticket, 'Ticket/');
   $ticketresp=$this->extractencode($nonlccticket,$ticketRS,'Ticket'.$flight_result->roundtrip);
   
 //  $this->db->set('ticket_request', " CONCAT_WS('',ticket_request,'" . mysql_real_escape_string($nonlccticket) . "')", FALSE);
 //  $this->db->set('ticket_response', " CONCAT_WS('',ticket_response,'" . mysql_real_escape_string($ticketRS) . "')", FALSE);
 //  $this->Logger->append_by_ref('flights_api_logs', $this->sess_uniqueRefNo, $this->api, array());
   
   //file_put_contents(FCPATH . 'dump/flights/tbo_air_ticketing' . $this->roundtrip_count . '_request.xml', $nonlccticket);
   //file_put_contents(FCPATH . 'dump/flights/tbo_air_ticketing' . $this->roundtrip_count . '_response.xml', $ticketRS);
   return $ticketresp;
   }

   public function flight_getBooking($flight_result,$pnr='',$BookingId='') {

    $tbo_token_id= $this->session->airtoken;
    $xmlgetbook='{
        "EndUserIp": "'.$this->ip.'",
        "TokenId": "'.$tbo_token_id.'",
        "PNR": "'.$pnr.'",
        "BookingId": "'.$BookingId.'"
    }';

    // echo $xmladdbook;
    //file_put_contents(FCPATH . 'dump/flights/tbo_air_getBooking' . $this->roundtrip_count . '_request.xml', $xmlgetbook);
    $getBookingRS = $this->processRequest($xmlgetbook, 'GetBookingDetails/');
    $getBookingResp=$this->extractencode($xmlgetbook,$getBookingRS,'getbookdetails'.$flight_result->roundtrip);
  //  $this->db->set('getbooking_request', " CONCAT_WS('',getbooking_request,'" . mysql_real_escape_string($xmlgetbook) . "')", FALSE);
  //  $this->db->set('getbooking_response', " CONCAT_WS('',getbooking_response,'" . mysql_real_escape_string($getBookingRS) . "')", FALSE);
  //  $this->Logger->append_by_ref('flights_api_logs', $this->sess_uniqueRefNo, $this->api, array());
    //file_put_contents(FCPATH . 'dump/flights/tbo_air_getBooking' . $this->roundtrip_count . '_response.xml', $getBookingRS);
    return $getBookingResp;
}
public function flights_multiway_searchRQ($searcharray) {
    @ini_set('mysql.connect_timeout', 3000);
    @ini_set('default_socket_timeout', 3000);
    $this->set_multisearch_variables($searcharray);
      //  $this->setup_multisearch_markup();
    if ($this->session->userdata('flight_search_activate') == 1) {
        //$this->fetch_flight_multiway_search_results();
    } else {
       //Delete temp search data
        $this->Tbo_Model->delete_flight_temp_result($this->sess_id, 'tbo');
        if ($this->tripType == 'S') {
            $typ = "OneWay";
        } else {
            $typ = "Return";
        }
        $flight_segments = '';
        $fromCity = $this->fromCity;
        $toCity = $this->toCity;
        $departDate = $this->departDate;
        $OrginCity = $this->getAirportCode($fromCity[0]);
        $DestinationCity = $this->getAirportCode($toCity[0]);
        $DepartDate = date('Y-m-d', strtotime(str_replace('/', '-', $departDate[0])));
        for ($i = 0; $i < count($fromCity); $i++) {

            $Origincode = $this->getAirportCode($fromCity[$i]);
            $Desticode = $this->getAirportCode($toCity[$i]);
            $DepartureDate = date('Y-m-d', strtotime(str_replace('/', '-', $departDate[$i])));
            if($i!=0){
            $flight_segments .=',';
        }
        $flight_segments .='{
            "Origin": "'.$Origincode.'",
            "Destination": "'.$Desticode.'",
            "FlightCabinClass": "'.$this->cabinClass.'",
            "PreferredDepartureTime": "' . $DepartureDate . 'T00:00:00",
            "PreferredArrivalTime": "' . $DepartureDate . 'T00:00:00"
        }';
    }


$this->login();
$tbo_token_id= $this->session->airtoken;
$xml_search= '{
    "EndUserIp": "'.$this->ip.'",
    "TokenId": "'.$tbo_token_id.'",
    "AdultCount": "'.$this->adults.'",
    "ChildCount": "'.$this->childs.'",
    "InfantCount": "'.$this->infants.'",
    "DirectFlight": "false",
    "OneStopFlight": "false",
    "JourneyType": "3",
    "PreferredAirlines": null,
    "Segments": [
    '.$flight_segments.'
    ],
    "Sources": [
    "SG","AI","6E","9W","GDS"
    ]
}';
    // echo $xml_search;exit;
$searchresponse = $this->processRequest($xml_search, 'Search/');
$searchresp=$this->extractencode($xml_search,$searchresponse,'search');
   // echo '<pre>';print_r($searchresponse);exit;
// $log_data = array(
//     'session_id' => $this->sess_id,
//     'uniqueRefNo' => $this->sess_uniqueRefNo,
//     'api' => 'tbo',
//     'search_request' => $xml_search,
//                     //'search_response'=>$searchresponse
//     );
// $this->Logger->add('flights_api_logs', $log_data);

if($this->flightmode==1){
    $IsDomestic='true';
}else{
    $IsDomestic='false';
}

// echo $xml_search;
//  echo '<pre>';print_r($searchresp);exit;
if (!empty($searchresp)) { 
    $this->load->module('flights/flight_markup');
    $Results=$searchresp->Response->Results;
    $TraceId=$searchresp->Response->TraceId;
        //echo '<pre>';print_r($Results);exit;
    $insert_info=array();$l=0;
    foreach($Results as $key=>$Result){ 
        if($key==0){
            $RoundTrip=1;
        }else{
            $RoundTrip=2;
        }
        foreach($Result as $val){ 
//echo '<pre>';print_r($val);exit;
            $ResultIndex=$val->ResultIndex;
            $Source=$val->Source;
            $IsLCC=$val->IsLCC;
            $IsRefundable=$val->IsRefundable;
            $AirlineRemark=$val->AirlineRemark;
            $AirlineCodem=$val->AirlineCode;
            $BaseFare=$val->Fare->BaseFare;
            $Tax=($val->Fare->Tax)+($val->Fare->OtherCharges);
            $OtherCharges=$val->Fare->OtherCharges;
            $PublishedFare=$val->Fare->PublishedFare;
            $OfferedFare=$val->Fare->OfferedFare;
            $Segments=$val->Segments;
            $TripIndicator=$SegmentIndicator=$AirlineCode=$AirlineName=$FlightNumber=$FareClass=$OperatingCarrier=$AirportCode_o=$AirportName_o=$Terminal_o=$CityCode_o=$CityName_o=$CountryCode_o=$CountryName_o=$DepTime=$AirportCode_d=$AirportName_d=$Terminal_d=$CityCode_d=$CityName_d=$CountryCode_d=$CountryName_d=$ArrTime=$StopOver=$Duration=array();
            foreach($Segments as $Segment){ 

                foreach($Segment as $val1){
                        //print_r($val1);exit;
                    $TripIndicator[]=$val1->TripIndicator;
                    $SegmentIndicator[]=$val1->SegmentIndicator;

                    $AirlineCode[]=$val1->Airline->AirlineCode;
                    $AirlineName[]=$val1->Airline->AirlineName;
                    $FlightNumber[]=$val1->Airline->FlightNumber;
                    $FareClass[]=$val1->Airline->FareClass;
                    $OperatingCarrier[]=$val1->Airline->OperatingCarrier;

                    $AirportCode_o[]=$val1->Origin->Airport->AirportCode;
                    $AirportName_o[]=$val1->Origin->Airport->AirportName;
                    $Terminal_o[]=$val1->Origin->Airport->Terminal;
                    $CityCode_o[]=$val1->Origin->Airport->CityCode;
                    $CityName_o[]=$val1->Origin->Airport->CityName;
                    $CountryCode_o[]=$val1->Origin->Airport->CountryCode;
                    $CountryName_o[]=$val1->Origin->Airport->CountryName;
                    $DepTime[]=$val1->Origin->DepTime;

                    $AirportCode_d[]=$val1->Destination->Airport->AirportCode;
                    $AirportName_d[]=$val1->Destination->Airport->AirportName;
                    $Terminal_d[]=$val1->Destination->Airport->Terminal;
                    $CityCode_d[]=$val1->Destination->Airport->CityCode;
                    $CityName_d[]=$val1->Destination->Airport->CityName;
                    $CountryCode_d[]=$val1->Destination->Airport->CountryCode;
                    $CountryName_d[]=$val1->Destination->Airport->CountryName;
                    $ArrTime[]=$val1->Destination->ArrTime;

                    $Duration[]= $val1->Duration;
                    $StopOver[]= $val1->StopOver;
                }
            }
            $TripIndicator=implode(',',$TripIndicator);
            $SegmentIndicator=implode(',',$SegmentIndicator);
            $AirlineCode=implode(',',$AirlineCode);
            $AirlineName=implode(',',$AirlineName);
            $FlightNumber=implode(',',$FlightNumber);
            $FareClass=implode(',',$FareClass);
            $OperatingCarrier=implode(',',$OperatingCarrier);
            $AirportCode_o=implode(',',$AirportCode_o);
            $AirportName_o=implode(',',$AirportName_o);
            $Terminal_o=implode(',',$Terminal_o);
            $CityCode_o=implode(',',$CityCode_o);
            $CityName_o=implode(',',$CityName_o);
            $CountryCode_o=implode(',',$CountryCode_o);
            $CountryName_o=implode(',',$CountryName_o);
            $DepTime=implode(',',$DepTime);
            $AirportCode_d=implode(',',$AirportCode_d);
            $AirportName_d=implode(',',$AirportName_d);
            $Terminal_d=implode(',',$Terminal_d);
            $CityCode_d=implode(',',$CityCode_d);
            $CityName_d=implode(',',$CityName_d);
            $CountryCode_d=implode(',',$CountryCode_d);
            $CountryName_d=implode(',',$CountryName_d);
            $ArrTime=implode(',',$ArrTime);
            $Duration=implode(',',$Duration);
            //$Duration=array_sum($Duration);
            $StopOver=implode(',',$StopOver);
           
            $origin = $this->getAirportCode(current($fromCity));
            $destination = $this->getAirportCode(end($toCity));

            $markup_array = $this->flight_markup->markup_calculation($PublishedFare,$origin,$this->api);
            $insert_info[$l]=array(
                'session_id' => $this->sess_id,
                'uniquerefno' => $this->sess_uniqueRefNo,
                'tbo_unique_id' => $ResultIndex,
                'api' => $this->api,
                'triptype' => $this->tripType,
                'origin' => $origin,
                'destination' => $destination,
                'adults' => $this->adults,
                'childs' => $this->childs,
                'infants' => $this->infants,
                'isdomestic' => $IsDomestic,
                'roundtrip' => $RoundTrip,
                'tripindicator' => $TripIndicator,
                'duration' => $Duration,
                'source' => $Source,
                'segment_indicator' => $SegmentIndicator,
                'operating_airlinecode' => $AirlineCode,
                'operating_airlinename' => $AirlineName,
                'operating_flightno' => $FlightNumber,
                'operating_fareclass' => $FareClass,
                'operating_airportname_o' => $AirportName_o,
                'operating_terminal_o' => $Terminal_o,
                'operating_cityname_o' => $CityName_o,
                'operating_country_o' => $CountryName_o,
                'operating_airportname_d' => $AirportName_d,
                'operating_terminal_d' => $Terminal_d,
                'operating_cityname_d' => $CityName_d,
                'operating_country_d' => $CountryName_d,
                'operating_deptime' => $DepTime,
                'operating_arritime' => $ArrTime,
                'islcc' => $IsLCC,
                'nonrefundable' => $IsRefundable,
                'segmentkey' => $ResultIndex,
                'stops' => $StopOver,
                'basefare' => $BaseFare,
                'tax' => $Tax,
                'net_amount' => $PublishedFare,
                'admin_markup' => $markup_array['admin_markup'],
                'agent_markup' => $markup_array['agent_markup'],
                'payment_charge' => $markup_array['payment_charge'],
                'total_amount' => $markup_array['total_cost'],
                'currency' => 'INR',
                'tbo_session'=>$TraceId,
                'searcharray'=>$searcharray
                );                
            $l++;
            //echo '<pre>';print_r($insert_info);exit;
        }
           // exit;
    }
        // echo '<pre>';print_r($insert_info);exit;
    if(!empty($insert_info)){
        $this->Tbo_Model->insert_flight_temp_results($insert_info);
    }    
}
}
echo json_encode(array("success" => 'success'));
// echo $this->db->last_query();exit;
//$this->fetch_flight_multiway_search_results($searcharray);
}
public function fetch_flight_multiway_search_results($searcharray) {
    $this->set_multisearch_variables($searcharray);

    $flight_result = $this->Tbo_Model->fetch_search_result($this->sess_id, $this->sess_uniqueRefNo, '1');
    if (empty($flight_result)) {
        $this->session->unset_userdata('flight_search_activate');
    }

        // $flight_result1 = $this->Tbo_Model->fetch_search_result($this->sess_id, '2');
    $data['result'] = $flight_result;
        //  $data['result1'] = $flight_result1; //echo $triptype.'<pre>';print_r($data);exit;
    $flight_search_result = $this->load->view('tbo/search_result_mulitway_round_ajax', $data, TRUE);
    echo json_encode(array("flight_search_result" => $flight_search_result));
}

public function cancel_ticketing($RefNo, $booking_detail)
{
    $type="Cancellation";
    // $booking_det = unserialize($booking_detail);
    $passenger_info = $this->Tbo_Model->get_passenger_info($RefNo);
    // echo "<pre>";print_r($passenger_info[0]);
    $bookingid=$booking_detail->BookingReferenceId;
    $origin=$booking_detail->Origin;
    $destination=$booking_detail->Destination;
    $bookingid=$booking_detail->BookingReferenceId;

    $ticketid=$passenger_info[0]->TicketId;

    $this->login();
$tbo_token_id= $this->session->airtoken;

$request = '{
    "BookingId": '.$bookingid.',
    "RequestType": 2,
    "CancellationType": 3,
    "Sectors": [
      {
        "Origin": "'.$origin.'",
        "Destination": "'.$destination.'"
      }
    ],
    "TicketId": [
      '.$ticketid.'
    ],
    "Remarks": "Test remarks",
    "EndUserIp": "192.168.11.23",
    "TokenId": "'.$tbo_token_id.'"
  }';
    // exit;
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/SendChangeRequest',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$request,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$result = json_decode($response, true);
// echo"<pre>";print_r($result['Response']);exit;


    file_put_contents(FCPATH . 'dump/flights/'.$type.'rq.xml', $request);
    file_put_contents(FCPATH . 'dump/flights/'.$type.'rs.json', $response);
//Cancelled

$ChangeRequestId=$result['Response']['TicketCRInfo'][0]['ChangeRequestId'];
$TicketId=$result['Response']['TicketCRInfo'][0]['TicketId'];
$Status=$result['Response']['TicketCRInfo'][0]['Status'];
$Remarks=$result['Response']['TicketCRInfo'][0]['Remarks'];

if($Status==1){
    $cancelinfo = $this->Tbo_Model->update_cancelinfo_bookingpassenger($TicketId, $ChangeRequestId);
    $this->Tbo_Model->update_cancelinfo_bookingreport($RefNo, $TicketId);
$data['cancelinfo'] = array(
    "ChangeRequestId"=>$ChangeRequestId,
    "TicketId"=>$TicketId
);
    // if($cancelinfo==true){
        $this->load->view('tbo/cancelled', $data);
        
    // }
}
}
    

}               