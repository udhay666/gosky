<?php
(defined('BASEPATH')) or exit('No direct script access allowed');

class Tbohotels extends MX_Controller
{

    private $sess_id;
    private $is_domestic;
    private $city_name;
    private $country_code;
    private $city_code;
    private $nationality;
    private $cin;
    private $cout;
    private $rooms;
    private $nights;
    private $uniqueRefNo;
    private $adults;
    private $childs;
    private $childs_ages;
    private $adults_count;
    private $childs_count;
    private $api_flag;
    private $api;
    private $mode;
    private $post_url;
    private $book_url;
    private $username;
    private $password;
    private $authen;
    private $post_urla;

    function __construct()
    {
        parent::__construct();
        $this->load->model('TboHotels_Model');
        $this->sess_id = $this->session->session_id;
        $this->api = 'tbohotels';
        $this->set_credentials();
    }
    public function set_credentials()
    {
        $authDetails = $this->TboHotels_Model->getApiAuthDetails($this->api);
        // echo '<pre>';print_r($authDetails);exit;
        if ($authDetails != '') {
            $this->api_flag = true;

            $this->userIP = '192.168.11.120';
            $this->mode = $authDetails->mode;
            if ($authDetails->mode == 0) {
                $this->username = 'Travelf';
                $this->password = 'Travel@124';
                $this->authen = 'ApiIntegrationNew';
                $this->post_url = 'http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/';
                $this->book_url = 'http://api.tektravels.com/BookingEngineService_HotelBook/hotelservice.svc/rest/';
                $this->post_urla = 'http://api.tektravels.com/SharedServices/SharedData.svc/rest/';
            } else {
                $this->username = 'DELT860';
                $this->password = '@nline#Trv-22';
                $this->authen = 'tboprod';
                $this->post_url='https://api.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/';
                $this->book_url = 'https://booking.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/';
                $this->post_urla='https://api.travelboutiqueonline.com/SharedAPI/SharedData.svc/rest/';
           
            }
        } else {
            $this->api_flag = false;
        }
    }

    public function set_variables($searcharray)
    {
        // $session_data = $this->session->userdata('hotel_search_data');
        $session_data = unserialize($searcharray);
        if (empty($session_data)) { //echo 'session data missing';
            redirect('home/error_page/' . base64_encode('Session is Expired'), 'refresh');
            // exit;
        }
        // echo $session_data['cityCode']; //exit;
        $this->city_name = $session_data['cityName'];
        $tbo_city_details = $this->TboHotels_Model->checkCityCode($session_data['cityCode']);
        $this->country_code = $tbo_city_details->country_code;
        $this->city_name = $tbo_city_details->city_name;
        $this->city_code = $tbo_city_details->city_id;
        $this->nationality = 'IN';
        $this->cin = date('d/m/Y', strtotime(str_replace('/', '-', $session_data['checkIn'])));
        $this->cout = date('d/m/Y', strtotime(str_replace('/', '-', $session_data['checkOut'])));
        $this->rooms = $session_data['rooms'];
        $this->nights = $session_data['nights'];
        $this->uniqueRefNo = $session_data['uniqueRefNo'];
        $this->adults = $session_data['adults'];
        $this->childs = $session_data['childs'];
        $this->childs_ages = $session_data['childs_ages'];
        $this->adults_count = $session_data['adults_count'];
        $this->childs_count = $session_data['childs_count'];
    }
    public function hotels_availabilty_search($searcharray)
    {
        // echo $this->session->userdata('hotel_search_activate');exit;
        $this->set_variables($searcharray);
        if ($this->session->userdata('hotel_search_activate') == 1) {
            // echo json_encode(array('results' => 'success'));
            $this->session->unset_userdata('hotel_search_activate');
            $this->session->unset_userdata('hotel_search_data');
        } else {
            // ini_set('memory_limit', -1);
            ini_set('max_execution_time', 300);
            // echo $this->city_code; echo $this->api_flag;
            if (trim(!empty($this->city_code)) && trim($this->api_flag) == 1) {
                // list($HotelValuedAvailRS, $tokenid) = $this->HotelValuedAvailRQ();
                $returndata = $this->HotelValuedAvailRQ();
                $HotelValuedAvailRS = $returndata['response'];
                $tokenid = $returndata['token'];

                $this->load->module('hotels/hotel_markup');
                $searchresp = json_decode($HotelValuedAvailRS);
                // echo '<pre>';print_r($searchresp);exit;
                $this->TboHotels_Model->delete_temp_results($this->sess_id, $this->api);
                if (is_object($searchresp)) {
                    $inx = 0;
                    $insert_data = array();
                    $HotelSearchResult = $searchresp->HotelSearchResult;
                    if ($HotelSearchResult->ResponseStatus == 1) {
                        $city_id = $HotelSearchResult->CityId;
                        $tbo_session = $HotelSearchResult->TraceId;
                        $PreferredCurrency = $HotelSearchResult->PreferredCurrency;
                        foreach ($HotelSearchResult->HotelResults as $val) {
                            $ResultIndex = $val->ResultIndex;
                            $HotelCode = $val->HotelCode;
                            $HotelName = $val->HotelName;
                            $HotelCategory = $val->HotelCategory;
                            $StarRating = $val->StarRating;
                            $HotelDescription = $val->HotelDescription;
                            $HotelPromotion = $val->HotelPromotion;
                            $HotelPolicy = $val->HotelPolicy;
                            $HotelPicture = $val->HotelPicture;
                            //  $session_id = $val->ResultIndex;
                            $HotelAddress = $val->HotelAddress;
                            $HotelContactNo = $val->HotelContactNo;
                            $Latitude = $val->Latitude;
                            $Longitude = $val->Longitude;
                            $HotelLocation = $val->HotelLocation;
                            $CurrencyCode = $val->Price->CurrencyCode;
                            $RoomPrice = $val->Price->RoomPrice;
                            $Tax = $val->Price->Tax;
                            $ExtraGuestCharge = $val->Price->ExtraGuestCharge;
                            $ChildCharge = $val->Price->ChildCharge;
                            $OtherCharges = $val->Price->OtherCharges;
                            $Discount = $val->Price->Discount;
                            $PublishedPrice = $val->Price->PublishedPrice;
                            $PublishedPriceRoundedOff = $val->Price->PublishedPriceRoundedOff;
                            $OfferedPrice = $val->Price->OfferedPrice;
                            $OfferedPriceRoundedOff = $val->Price->OfferedPriceRoundedOff;
                            $AgentCommission = $val->Price->AgentCommission;
                            $AgentMarkUp = $val->Price->AgentMarkUp;
                            $ServiceTax = $val->Price->ServiceTax;
                            $TDS = $val->Price->TDS;

                            $markup_array = $this->hotel_markup->markup_calculation($OfferedPriceRoundedOff, $this->nationality, $this->api, $HotelName);
                            // echo '<pre/>123';print_r($markup_array);exit;
                            $insert_data[$inx] = array(
                                'tokenid' => $tokenid,
                                'traceid' => $tbo_session,
                                'tbo_session_index' => $ResultIndex,
                                'session_id' => $this->sess_id,
                                'api' => $this->api,
                                'uniqueRefNo' => $this->uniqueRefNo,
                                'city_code' => $this->city_code,
                                'city_id' => $this->city_code,
                                'hotel_code' => $HotelCode,
                                'star' => $StarRating,
                                'hotel_name' => $HotelName,
                                'hotel_image' => $HotelPicture,
                                'location' => $this->city_name,
                                'address' => $HotelAddress,
                                'contact' => $HotelContactNo,
                                'room_rate' => $RoomPrice,
                                'room_tax' => $Tax,
                                'room_guest_charge' => $ExtraGuestCharge,
                                'discount' => $Discount,
                                'room_other_charge' => $OtherCharges,
                                'service_tax' => $ServiceTax,
                                'currency' => $CurrencyCode,
                                'payment_charge' => $markup_array['payment_charge'],
                                'total_cost' => $markup_array['total_cost'],
                                'admin_markup' => $markup_array['admin_markup'],
                                'agent_markup' => $markup_array['agent_markup'],
                                'orginal_cost' => $OfferedPriceRoundedOff,
                                'room_detail' => serialize($val),
                                'hotel_name' => $HotelName,
                                'searcharray' => $searcharray,
                                'room_count' => $this->rooms
                            );
                            $permanent_hotels = $this->TboHotels_Model->check_in_permanent($this->api, $HotelCode);
                            // echo '<pre>';print_r($insert_data);exit;
                            if ($permanent_hotels == '') {
                                $insert_permanent = array(
                                    'api' => $this->api,
                                    'hotel_code' => $HotelCode,
                                    'hotel_name' => $HotelName,
                                    'hotel_name_unique' => str_replace(" ", "", $HotelName),
                                    'star' => $StarRating,
                                    'city_name' => $this->city_name,
                                    'address' => $HotelAddress,
                                    'phone' => $HotelContactNo,
                                    'description' => $HotelDescription,
                                    'latitude' => $Latitude,
                                    'longitude' => $Longitude,
                                );
                                $this->db->insert('api_permanent_hotels', $insert_permanent);
                            }
                            $inx++;
                        }
                    }
                    if (!empty($insert_data)) {
                        // echo '<pre/>';print_r($insert_data);
                        $this->TboHotels_Model->insert_temp_results($insert_data);
                        // echo $this->db->last_query();exit;
                    }
                }
            } else {
                echo 'fail';
            }
            echo json_encode(array('results' => 'success'));
        }
    }


    function HotelValuedAvailRQ()
    {
        // echo 'yes';exit;

        $query = $this->db->select('token')->from('tbotoken_hotel')->where('datetime >', date('Y-m-d') . ' 00:00:00')->where('mode', $this->mode)->get();

        // $result = $query->row();
        // echo $this->db->last_query();
        // echo '<pre>';print_r($result);exit;

        if ($query->num_rows() > 0) {
            $result = $query->row();
            $tokenid = $result->token;
        } else {

            $loginrequest = '{
            "ClientId": "' . $this->authen . '",
            "UserName": "' . $this->username . '",
            "Password": "' . $this->password . '",
            "LoginType": 2,
            "EndUserIp": "' . $this->userIP . '"
            }';

            $authenticateresponse = $this->executeRequestjson($loginrequest, 'Authenticate');
            file_put_contents(FCPATH . 'dump/hotels/tbo_hotels/auth_req.json', $loginrequest);
            file_put_contents(FCPATH . 'dump/hotels/tbo_hotels/auth_resp.json', $authenticateresponse);
            $response = json_decode($authenticateresponse);

            $error_code = $response->Error->ErrorCode;
            $statuslogin = $response->Status;
            if ($statuslogin == 1) {
                $tokenid = $response->TokenId;
                $datainsert = array('token' => $tokenid, 'mode' => $this->mode);
                $this->db->insert('tbotoken_hotel', $datainsert);
                // echo $this->db->last_query();
                // echo '<pre>';print_r($datainsert);exit;
            } else {
                return false;
            }
        }

        $roomsdata = '';
        for ($i = 0; $i < $this->rooms; $i++) {
            $roomsdata .= '{
                "NoOfAdults": ' . $this->adults[$i] . ',
                "NoOfChild": ' . $this->childs[$i] . '';
            $age = '';
            if ($this->childs[$i] != 0) {
                $age .= ',"ChildAge":[';
                //    for ($k = 0; $k < count($this->childs[$i]); $k++) {
                if (isset($this->childs_ages[$i])) {
                    $child_age = $this->childs_ages[$i];
                } else {
                    $child_age = "";
                }
                $age .= $child_age . ',';
                //    }
                $age = rtrim($age, ',');
                $age .= ']';
            } else {
                $age .= ',"ChildAge":""';
            }

            $roomsdata .= $age;
            $roomsdata .= '},';
            // echo $roomsdata;exit;
        }
        $roomsdata = rtrim($roomsdata, ',');

        $searchrequestrequest = '{
            "CheckInDate": "' . $this->cin . '",
            "NoOfNights": ' . $this->nights . ',
            "CountryCode": "' . $this->country_code . '",
            "CityId":' . $this->city_code . ',
            "ResultCount": null,
            "PreferredCurrency": "INR",
            "GuestNationality": "IN",
            "NoOfRooms": ' . $this->rooms . ',
            "RoomGuests":[' . $roomsdata . '],
            "PreferredHotel": "",
            "MaxRating": 5,
            "MinRating": 0,
            "ReviewScore":null,
            "IsNearBySearchAllowed":false,
            "EndUserIp":"' . $this->userIP . '",
            "TokenId":"' . $tokenid . '"
        }';

        // echo '<pre>';print_r($searchrequestrequest);exit;
        file_put_contents(FCPATH . 'dump/hotels/tbo_hotels/tbo_hotel_search_request.json', $searchrequestrequest);
        $seearchresponse = $this->executeRequestjson($searchrequestrequest, 'GetHotelResult/');
        // $xml_resp=json_decode($seearchresponse);
        file_put_contents(FCPATH . 'dump/hotels/tbo_hotels/tbo_hotel_search_response.json', $seearchresponse);

        // $log_data = array(
        //     'session_id' => $this->sess_id,
        //     'uniqueRefNo' => $this->uniqueRefNo,
        //     'api' => 'tbohotels',
        //     'search_request' => $searchrequestrequest,
        //         //'search_response'=>$searchresponse
        //     );
        // $this->Logger->add('hotels_api_logs', $log_data);
        $datareturn = array('response' => $seearchresponse, 'token' => $tokenid);

        // return array($seearchresponse, $tokenid);
        return $datareturn;
    }


    public function executeRequestjson($request, $soapac)
    {

        if ($soapac == 'Authenticate') {
            $url = $this->post_urla . $soapac;
        } else {
            $url = $this->post_url . $soapac;
        }
        // echo $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($request)
            )
        );
        $result = curl_exec($ch);
        $error2 = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        //        echo '<pre>';
        //        print_r($result);
        //        exit;
        return $result;
    }
    function HotelDetailsRQ($hotel_details)
    {
        $xml_request = '{
            "ResultIndex": "' . $hotel_details->tbo_session_index . '",
            "HotelCode": "' . $hotel_details->hotel_code . '",
            "EndUserIp": "' . $this->userIP . '",
            "TokenId": "' . $hotel_details->tokenid . '",
            "TraceId": "' . $hotel_details->traceid . '"
        }';
        $detailresponse = $this->executeRequestjson($xml_request, 'GetHotelInfo/');
        //   echo '<pre>';
        //  print_r($xml_request);
        //   print_r($detailresponse);
        // $this->db->set('hoteldetail_request', " CONCAT_WS('<endofxml>End Of XML</endofxml>',hoteldetail_request,'" . mysql_real_escape_string($xml_request) . "')", FALSE);
        // $this->db->set('hoteldetail_response', " CONCAT_WS('<endofxml>End Of XML</endofxml>',hoteldetail_response,'" . mysql_real_escape_string($detailresponse) . "')", FALSE);
        // $this->Logger->append_by_ref('hotels_api_logs', $this->uniqueRefNo, $this->api, array());
        //$xml_resp=json_decode($detailresponse);
        //echo $this->db->last_query();exit;
        sleep(1);
        file_put_contents(FCPATH . 'dump/hotels/tbo_hotels/tbo_hotel_detail_req.json', $xml_request);

        file_put_contents(FCPATH . 'dump/hotels/tbo_hotels/tbo_hotel_detail_resp.json', $detailresponse);
        // print_r($detailresponse);
        return $detailresponse;
    }

    public function hotel_details($hotelCode, $searchId, $errorMsg = '')
    {
        $data['errorMsg'] = $errorMsg;
        $data['searchId'] = $searchId;
        //echo $data['searchId']=$searchId;exit;
        $hotel_details = $this->TboHotels_Model->getHotelDetails($hotelCode, $searchId);
        //echo $this->db->last_query();     echo '<pre>';   print_r($hotel_details); exit;
        $HotelDetailsRS = $this->HotelDetailsRQ($hotel_details);
        if (empty($hotel_details)) {
            redirect('home/error_page/' . base64_encode('Session is Expired'), 'refresh');
        }

        $HotelDetailsRS = json_decode($HotelDetailsRS);
        //echo '<pre>';
        //print_r($HotelDetailsRS);
        //exit;
        $HotelDetailsRSin = $HotelDetailsRS->HotelInfoResult;
        $ResponseStatus = $HotelDetailsRSin->ResponseStatus;
        if ($ResponseStatus != '1') {
            //    $this->unset_session_search_data();
            //   redirect('home/error_page/' . base64_encode('Session is Expired'), 'refresh');
        }
        $hoteldetail = new stdClass();
        $hoteldetail->TraceId = $HotelDetailsRSin->TraceId;
        $hoteldetail->HotelCode = $HotelDetailsRSin->HotelDetails->HotelCode;
        $hoteldetail->HotelName = $HotelDetailsRSin->HotelDetails->HotelName;
        $hoteldetail->StarRating = $HotelDetailsRSin->HotelDetails->StarRating;
        $hoteldetail->HotelURL = $HotelDetailsRSin->HotelDetails->HotelURL;
        $hoteldetail->Description = $HotelDetailsRSin->HotelDetails->Description;
        $hoteldetail->facilities = $HotelDetailsRSin->HotelDetails->HotelFacilities;
        $hoteldetail->HotelPolicy = $HotelDetailsRSin->HotelDetails->HotelPolicy;
        $hoteldetail->SpecialInstructions = $HotelDetailsRSin->HotelDetails->SpecialInstructions;
        $hoteldetail->Address = $HotelDetailsRSin->HotelDetails->Address;
        $hoteldetail->CountryName = $HotelDetailsRSin->HotelDetails->CountryName;
        $hoteldetail->PinCode = $HotelDetailsRSin->HotelDetails->PinCode;
        $hoteldetail->HotelContactNo = $HotelDetailsRSin->HotelDetails->HotelContactNo;
        $hoteldetail->lat = $HotelDetailsRSin->HotelDetails->Latitude;
        $hoteldetail->long = $HotelDetailsRSin->HotelDetails->Longitude;

        $hoteldetailimages = $HotelDetailsRSin->HotelDetails->Images;
        //echo "<pre/>";print_r($hoteldetailimages);exit;
        $this->TboHotels_Model->update_hotel_policy($this->sess_id, $hotelCode, $searchId, $hoteldetail->HotelPolicy);

        foreach ($hoteldetailimages as $ims) {
            $images[] = $ims;
        }
        $hoteldetail->images = $images;

        $data['hotelDetails'] = $hoteldetail;
        $data['hotel_temp_detail'] = $hotel_details;

        $this->load->library('googlemaps');
        $config['center'] = "$hoteldetail->lat, $hoteldetail->long";
        $config['zoom'] = '11';
        $this->googlemaps->initialize($config);

        $marker = array();
        $marker['position'] = "$hoteldetail->lat, $hoteldetail->long";
        $marker['infowindow_content'] = "$hoteldetail->HotelName <br/> $hoteldetail->Address";
        $this->googlemaps->add_marker($marker);
        $data['map'] = $this->googlemaps->create_map();
        //echo '<pre>';print_r($hoteldetail);exit;

        $this->load->view('tbohotels/hotel_details2', $data);
    }
    function rooms_availability($session_id, $hotelCode, $search_id)
    { //echo 123;
        //    echo 123;exit;
        //  $this->set_markup();
        //print_r($search_id);exit;
        $hotel_details = $this->TboHotels_Model->getHotelDetails($hotelCode, $search_id);
        $this->set_variables($hotel_details->searcharray);
        //echo $this->db->last_query();
        //echo '<pre>123'; print_r($hotel_details);exit;
        $room_info = $this->TboHotels_Model->fetch_temp_result_room($session_id, $this->uniqueRefNo, $hotelCode);
        $room_resp = $this->get_rooms_RQ($hotel_details->tbo_session_index, $hotel_details->traceid, $hotel_details->tokenid, $hotel_details->hotel_code);

        //    echo '<pre>';
        //    print_r($room_resp);
        //      exit;
        $this->load->module('hotels/hotel_markup');
        if (is_object($room_resp)) {
            $room_detail = $room_resp->GetHotelRoomResult;
            $ResponseStatus = $room_detail->ResponseStatus;
            $traceid = $room_detail->TraceId;
            //  echo $ResponseStatus;exit;
            if (trim($ResponseStatus) != 1) {
                // echo 9;exit;
            } else {
                $this->TboHotels_Model->delete_temp_rooms($hotelCode, $search_id, $session_id, $this->uniqueRefNo);
                $room_res = $room_detail->HotelRoomsDetails;
                // echo 456;exit;
                $RoomIndex_comb = array();
                $room_index_no = array();
                //  $price_array = array();
                // $room_dyn_details = array();
                foreach ($room_res as $val) {

                    $room_index = $val->RoomIndex;
                    $RoomTypeCode = $val->RoomTypeCode;
                    $RoomTypeName = $val->RoomTypeName;
                    $RatePlanCode = $val->RatePlanCode;
                    $room_price = $val->Price->RoomPrice;
                    $xml_currency = $val->Price->CurrencyCode;
                    $PublishedPrice = $val->Price->PublishedPrice;
                    $room_published_price = $val->Price->PublishedPriceRoundedOff;
                    $Tax = $val->Price->Tax;
                    $OfferedPrice = $val->Price->OfferedPrice;
                    $OfferedPriceRoundedOff = $val->Price->OfferedPriceRoundedOff;
                    $ServiceTax = $val->Price->ServiceTax;
                    $Discount = $val->Price->Discount;
                    $price_array = array(
                        'PublishedPrice' => $PublishedPrice,
                        'PublishedPriceRoundedOff' => $room_published_price,
                        'OfferedPrice' => $OfferedPrice,
                        'OfferedPriceRoundedOff' => $OfferedPriceRoundedOff,
                    );
                    //                    echo '<pre>';
                    //                    print_r($price_array);
                    //                    exit;
                    $Amenities = $val->Amenities;
                    $amenity_name = '';
                    foreach ($Amenities as $val2) {
                        $amenity_name .= $val2 . ',';
                        //  $i++;
                    }
                    //echo '<pre>';print_r($amenity_name);exit;
                    $CancellationPolicies = $val->CancellationPolicies;
                    foreach ($CancellationPolicies as $val3) {
                        $Charge = $val3->Charge;
                        $ChargeType = $val3->ChargeType;
                        $Currency = $val3->Currency;
                        $FromDate = $val3->FromDate;
                        $ToDate = $val3->ToDate;
                    }
                    $cancel_desc = $val->CancellationPolicy;
                    // $room_dyn_details[] = array(
                    //     'room_index' => $room_index,
                    //     'RoomTypeCode' => $RoomTypeCode,
                    //     'RoomTypeName' => $RoomTypeName,
                    //     'RoomPlanCode' => $RoomPlanCode,
                    //     'room_price' => $room_price,
                    //     'xml_currency' => $xml_currency
                    // );

                    $markup_array = $this->hotel_markup->markup_calculation($OfferedPriceRoundedOff, $this->nationality, $this->api, $hotel_details->hotel_name);
                    $RoomTypeName_new = str_replace("b2b", "", $RoomTypeName);
                    $cancellation_policy_new = str_replace("b2b", "", $cancel_desc);
                    $insert_data = array(
                        'tokenid' => $hotel_details->tokenid,
                        'traceid' => $traceid,
                        'tbo_session_index' => $hotel_details->tbo_session_index,
                        'session_id' => $session_id,
                        'api' => $this->api,
                        'uniqueRefNo' => $this->uniqueRefNo,
                        'city_code' => $this->city_code,
                        'hotel_code' => $hotelCode,
                        'star' => $hotel_details->star,
                        'hotel_name' => $hotel_details->hotel_name,
                        'hotel_image' => $hotel_details->hotel_image,
                        // 'loc_lat' => $hotel_details->loc_lat,
                        // 'loc_long' => $hotel_details->loc_long,
                        'location' => $hotel_details->location,
                        'address' => $hotel_details->address,
                        'contact' => $hotel_details->contact,
                        // 'room_rate' => $hotel_details->room_rate,
                        'room_tax' => $Tax,
                        'room_type_code' => $RoomTypeCode,
                        'room_type' => $RoomTypeName_new,
                        'rate_plan_code' => $RatePlanCode,
                        'sequence_no' => $room_index,
                        // 'room_guest_charge' => $ExtraGuestCharge,
                        'discount' => $Discount,
                        //  'room_other_charge' => $OtherCharges,
                        'service_tax' => $ServiceTax,
                        'currency' => $xml_currency,
                        'payment_charge' => $markup_array['payment_charge'],
                        'total_cost' => $markup_array['total_cost'],
                        'admin_markup' => $markup_array['admin_markup'],
                        'agent_markup' => $markup_array['agent_markup'],
                        'orginal_cost' => $OfferedPriceRoundedOff,
                        'room_formats' => serialize($val->Price),
                        'cancellation_policy' => $cancellation_policy_new,
                        // 'room_detail' => serialize($val),
                        'amenity_code' => $amenity_name,
                        'tariff_notes' => $room_info[0]->tariff_notes,
                        'searcharray' => $hotel_details->searcharray,
                        'room_count' => $hotel_details->room_count
                    );
                    //  echo '<pre>';print_r($insert_data);exit;
                    $this->TboHotels_Model->insert_rooms($insert_data);
                    //echo $this->db->last_query();exit;
                }
                $RoomCombinations = $room_detail->RoomCombinations;
                $room_comb_type = $RoomCombinations->InfoSource;
                $RoomCombination = $RoomCombinations->RoomCombination;

                // echo count($RoomCombination);
                //                if (count($RoomCombination) == 1) {
                //                    foreach ($RoomCombination as $val5) {
                //                        $RoomIndex_comb = $val5->RoomIndex;
                //                        foreach ($RoomIndex_comb as $val6) {
                //                            $room_index_no = $val6;
                //                        }
                //                    }
                //                } else {
                //
                //                }
                if (trim($room_comb_type) == 'OpenCombination') {
                    foreach ($RoomCombination as $val5) {
                        $RoomIndex_comb[] = $val5->RoomIndex;
                        foreach ($RoomIndex_comb as $val6) {
                            $room_index_no[] = $val6;
                        }
                    }
                } else {
                    foreach ($RoomCombination as $val5) {
                        $RoomIndex_comb[] = $val5->RoomIndex;
                        foreach ($RoomIndex_comb as $val6) {
                            $room_index_no[] = $val6;
                        }
                    }
                }
            }
        }
        $room_dyn_details = $this->TboHotels_Model->fetch_hotel_rooms($hotelCode, $search_id, $session_id, $this->uniqueRefNo);
        //  echo '<pre>';print_r($room_dyn_details);exit;
        //    echo '<pre>';print_r($RoomIndex_comb);
        //   exit;
        $roomsdata['room_dyn_details'] = $room_dyn_details;
        $roomsdata['room_comb_type'] = $room_comb_type;
        $roomsdata['RoomIndex_comb'] = $RoomIndex_comb;
        $roomsdata['hotel_details'] = $hotel_details;

        $showRoom = $this->load->view('tbohotels/rooms_available', $roomsdata, true);

        //return $showRoom;
        echo json_encode(array(
            'rooms_result' => $showRoom
        ));
        //exit;
    }
    public function get_rooms_RQ($tbo_sess_id, $trace_id, $token_id, $hotel_code)
    {
        $room_req = '{
            "ResultIndex": "' . $tbo_sess_id . '",
            "HotelCode": "' . $hotel_code . '",
            "EndUserIp": "' . $this->userIP . '",
            "TokenId": "' . $token_id . '",
            "TraceId": "' . $trace_id . '"
        }';
        $room_detail = $this->executeRequestjson($room_req, 'GetHotelRoom/');
        $room_resp = json_decode($room_detail);
        //echo '<pre>';
        //print_r($room_req);
        //print_r($room_detail); 
        // exit;
        // $this->db->set('getroom_request', " CONCAT_WS('<endofxml>End Of XML</endofxml>',hoteldetail_request,'" . mysql_real_escape_string($room_req) . "')", FALSE);
        // $this->db->set('getroom_response', " CONCAT_WS('<endofxml>End Of XML</endofxml>',hoteldetail_response,'" . mysql_real_escape_string($room_detail) . "')", FALSE);
        // $this->Logger->append_by_ref('hotels_api_logs', $this->uniqueRefNo, $this->api, array());
        file_put_contents(FCPATH . 'dump/hotels/tbo_hotels/tbo_room_req.json', $room_req);
        file_put_contents(FCPATH . 'dump/hotels/tbo_hotels/tbo_room_resp.json', $room_detail);
        return $room_resp;
    }
    public function hotel_itinerary($sessionId, $hotelCode, $searchId)
    {
        // echo '<pre>start';print_r($searchId);exit;

        $comd_id_trim = rtrim($searchId, ',');
        $combo_id = explode(',', $comd_id_trim);

        $room_comd_detail = array();
        foreach ($combo_id as $id) {
            $room_comd_detail[] = $this->TboHotels_Model->get_selected_comb_detail($hotelCode, $id, $sessionId, $this->uniqueRefNo);
        }
        // echo '<pre>';print_r($room_comd_detail);exit;
        // echo $room_comd_detail[0]->searcharray;exit;
        $this->set_variables($room_comd_detail[0]->searcharray);
        // echo $this->db->last_query();
        //echo '<pre>';print_r($room_comd_detail);exit;
        $room_bloc_rs = $this->room_bloc_rq($room_comd_detail);
        //    echo '<pre>';
        //    print_r($room_bloc_rs);
        //    exit;
        $block_room = $room_bloc_rs->BlockRoomResult;
        $HotelRoomsDetails = $block_room->HotelRoomsDetails;
        // echo '<pre>';print_r($HotelRoomsDetails);
        // if(empty($HotelRoomsDetails)){ 
        //     // redirect('home/error_page/' . base64_encode('Session is Expired'), 'refresh');
        //     //exit;
        // }
        $AvailabilityType = $block_room->AvailabilityType;
        $traceid = $block_room->TraceId;
        $ResponseStatus = $block_room->ResponseStatus;
        $Error = $block_room->Error;
        $ErrorCode = $Error->ErrorCode;
        $IsPriceChanged = $block_room->IsPriceChanged;
        $IsCancellationPolicyChanged = $block_room->IsCancellationPolicyChanged;
        $IsHotelPolicyChanged = $block_room->IsHotelPolicyChanged;
        $IsPANMandatory = $block_room->IsPANMandatory;
        $IsPassportMandatory = $block_room->IsPassportMandatory;
        // echo '<pre>';print_r($HotelRoomsDetails);

        // $HotelNorms = $block_room->HotelNorms;

        if (trim($ErrorCode) != 0) {
            $ErrorCode = $Error->ErrorMessage;
            // echo $ErrorCode;exit;
        } else {
            $HotelRoomsDetails = $block_room->HotelRoomsDetails;

            foreach ($HotelRoomsDetails as $val) {
                $RoomIndex = $val->RoomIndex;
                $Price = $val->Price;
                $OfferedPriceRoundedOff = $Price->OfferedPriceRoundedOff;
                $cancel_desc = $val->CancellationPolicy;
                $cancellation_policy_new = str_replace("b2b", "", $cancel_desc);
                //exit;
                $this->load->module('hotels/hotel_markup');
                $markup_array = $this->hotel_markup->markup_calculation($OfferedPriceRoundedOff, $this->nationality, $this->api, $room_comd_detail[0]->hotel_name);

                $update_info = array(
                    'payment_charge' => $markup_array['payment_charge'],
                    'total_cost' => $markup_array['total_cost'],
                    'admin_markup' => $markup_array['admin_markup'],
                    'agent_markup' => $markup_array['agent_markup'],
                    'orginal_cost' => $OfferedPriceRoundedOff,
                    'room_formats' => serialize($val->Price),
                    'cancellation_policy' => $cancellation_policy_new,
                );
                // echo '<pre>';print_r($room_comd_detail);
                foreach ($room_comd_detail as $vale) {
                    if ($vale->sequence_no == $RoomIndex) {
                        $update = $this->TboHotels_Model->updated_reprice_details($update_info, $vale->search_id, $sessionId, $hotelCode, $this->uniqueRefNo);
                    }
                }
            }
        }
        // exit;

        $total_cost = 0;
        //echo '<pre>';print_r($combo_id);exit;
        foreach ($combo_id as $id) {
            $calculate_total_cost = $this->TboHotels_Model->get_selected_comb_detail($hotelCode, $id, $sessionId, $this->uniqueRefNo);
            $total_cost += $calculate_total_cost->total_cost;
        }
        $data['roomDetails'] = $roomDetails = $this->TboHotels_Model->get_selected_comb_detail($hotelCode, $combo_id[0], $sessionId, $this->uniqueRefNo);
        $data['PANMandatory'] =  $IsPANMandatory;
        //echo $this->db->last_query();echo '<pre>';print_r($roomDetails);exit;
        $data['total_cost'] = $total_cost;
        $data['search_id'] = implode(',', $combo_id);
        $data['countries'] = $this->TboHotels_Model->get_country_list();

        // echo '<pre>';print_r($data);exit;
        $errorMsg = 'Selected room is not available. Please choose another one.';
        $params = base64_encode('tbohotels/' . $hotelCode . '/' . $searchId . '/' . $errorMsg);
        if (empty($HotelRoomsDetails)) {

            // $this->hotel_details($hotelCode, $searchId, $errorMsg);
            redirect('hotels/details/' . $params, 'refresh');
        }
        if (!empty($roomDetails)) {
            $this->load->view('tbohotels/hotel_itinerary', $data);
        } else {
            // $this->hotel_details($hotelCode, $searchId);
            redirect('hotels/details/' . $params, 'refresh');
        }
    }

    public function room_bloc_rq($room_comd_detail)
    {

        $this->set_variables($room_comd_detail[0]->searcharray);
        $room_loop = '';
        for ($i = 0; $i < count($room_comd_detail); $i++) {
            $room_loop .= '
    {
    "RoomIndex":"' . $room_comd_detail[$i]->sequence_no . '",
    "RoomTypeCode": "' . $room_comd_detail[$i]->room_type_code . '",
    "RoomTypeName": "' . $room_comd_detail[$i]->room_type . '",
    "RatePlanCode": "' . $room_comd_detail[$i]->rate_plan_code . '",
    "BedTypeCode": "",
    "SmokingPreference": 0,
    "Supplements": "",
    ';
            $price = unserialize($room_comd_detail[$i]->room_formats);
            $room_loop .= '"Price":{';
            //if ($i == 0) {
            $room_loop .= '
        "CurrencyCode": "' . trim($price->CurrencyCode) . '",';
            //}
            $room_loop .= '
    "RoomPrice": "' . $price->RoomPrice . '",
    "Tax": "' . $price->Tax . '",
    "ExtraGuestCharge": "' . $price->ExtraGuestCharge . '",
    "ChildCharge": "' . $price->ChildCharge . '",
    "OtherCharges": "' . $price->OtherCharges . '",
    "Discount": "' . $price->Discount . '",
    "PublishedPrice": "' . $price->PublishedPrice . '",
    "PublishedPriceRoundedOff": "' . $price->PublishedPriceRoundedOff . '",
    "OfferedPrice": "' . $price->OfferedPrice . '",
    "OfferedPriceRoundedOff": "' . $price->OfferedPriceRoundedOff . '",
    "AgentCommission": "' . $price->AgentCommission . '",
    "AgentMarkUp": "' . $price->AgentMarkUp . '",
    "ServiceTax": "' . $price->ServiceTax . '",
    "TDS": "' . $price->TDS . '"';
            $room_loop .= '
    },
    }';
        }
        $room_bloc = '{
    "ResultIndex": "' . $room_comd_detail[0]->tbo_session_index . '",
    "HotelCode": "' . $room_comd_detail[0]->hotel_code . '",
    "HotelName": "' . $room_comd_detail[0]->hotel_name . '",
    "GuestNationality": "IN",
    "NoOfRooms":' . $this->rooms . ',
    "ClientReferenceNo": 0,
    "IsVoucherBooking":true,
    "HotelRoomsDetails":[' . $room_loop . '],
    "EndUserIp": "' . $this->userIP . '",
    "TokenId": "' . $room_comd_detail[0]->tokenid . '",
    "TraceId": "' . $room_comd_detail[0]->traceid . '"
    }';
        //    echo '<pre>';
        //    print_r($room_bloc);

        $room_bloc_rs = $this->executeRequestjson($room_bloc, 'BlockRoom/');
        $room_resp = json_decode($room_bloc_rs);
        // $this->db->set('roomblock_request', " CONCAT_WS('<endofxml>End Of XML</endofxml>',hoteldetail_request,'" . mysql_real_escape_string($room_bloc) . "')", FALSE);
        // $this->db->set('roomblock_response', " CONCAT_WS('<endofxml>End Of XML</endofxml>',hoteldetail_response,'" . mysql_real_escape_string($room_bloc_rs) . "')", FALSE);
        // $this->Logger->append_by_ref('hotels_api_logs', $this->uniqueRefNo, $this->api, array());
        file_put_contents(FCPATH . 'dump/hotels/tbo_hotels/tbo_room_bloc_req.json', $room_bloc);
        file_put_contents(FCPATH . 'dump/hotels/tbo_hotels/tbo_room_bloc_resp.json', $room_bloc_rs);

        return $room_resp;
    }
    public function hotel_reservation($sessionId, $hotelCode, $searchId)
    {
        // echo '<pre>';print_r($searchId);exit;

        $pass_info = $this->session->userdata('passenger_info');
        $comd_id_trim = rtrim($searchId, ',');
        $combo_id = explode(',', $comd_id_trim);
        //    echo '<pre>';print_r($combo_id);exit;
        $room_comd_detail = array();
        foreach ($combo_id as $id) {
            $room_comd_detail[] = $this->TboHotels_Model->get_selected_comb_detail($hotelCode, $id, $sessionId, $this->uniqueRefNo);
            // echo $this->db->last_query();exit;

        }

        $this->set_variables($room_comd_detail[0]->searcharray);

        $total_cost = 0;
        $agent_markup = 0;
        for ($i = 0; $i < count($room_comd_detail); $i++) {
            $total_cost += $room_comd_detail[$i]->total_cost;
            $agent_markup += $room_comd_detail[$i]->agent_markup;
        }
        $payment_type = $pass_info['payment_type'];

        if ($this->session->userdata('agent_logged_in') && $payment_type == 'deposit') {
            $this->deposit_withdraw($total_cost, $agent_markup, $this->uniqueRefNo);
        }
        //echo $this->db->last_query();
        // echo '<pre>';print_r($room_comd_detail);exit;
        // echo '<pre>';print_r($pass_info);exit;
        if (!empty($room_comd_detail)) {
            $book_RS = $this->book_RQ($room_comd_detail);
            // echo '<pre>';
            // print_r($book_RS);
            // exit;
            $BookResult = $book_RS->BookResult;
            $ResponseStatus = $BookResult->ResponseStatus;
            $HotelBookingStatus = $BookResult->HotelBookingStatus;
            $ConfirmationNo = $BookResult->ConfirmationNo;
            $BookingRefNo = $BookResult->BookingRefNo;
            $BookingId = $BookResult->BookingId;
            $InvoiceNumber = $BookResult->InvoiceNumber;
            if ($HotelBookingStatus == 'Vouchered' || $HotelBookingStatus == 'Confirmed') {

                //            $voucher_rs = $this->generate_voucher_RQ($BookingId, $room_comd_detail[0]->tokenid);
                $book_detail_rs = $this->get_book_detail($ConfirmationNo, $BookingId, $room_comd_detail[0]->tokenid);
                //echo '<pre>';print_r($voucher_rs);
                if ($this->session->userdata('user_logged_in')) {
                    $user_id = $this->session->userdata('user_id');
                    $Booking_Done_By = 'user';
                    $agent_id = 0;
                } else if ($this->session->userdata('agent_logged_in')) {
                    $agent_id = $this->session->userdata('agent_id');
                    $Booking_Done_By = 'agent';
                    $user_id = 0;
                } else {
                    $agent_id = 0;
                    $user_id = 0;
                    $Booking_Done_By = 'guest';
                }
                $Booking_Date = date('Y-m-d');
                $uniqueRefNo = $this->uniqueRefNo;
                $total_cost = 0;
                $admin_markup = 0;
                $agent_markup = 0;
                $payment_charge = 0;
                $org_amt = 0;
                $cancel_policy = '';
                $room_type = '';
                for ($i = 0; $i < count($room_comd_detail); $i++) {
                    $total_cost += $room_comd_detail[$i]->total_cost;
                    $admin_markup += $room_comd_detail[$i]->admin_markup;
                    $agent_markup += $room_comd_detail[$i]->agent_markup;
                    $payment_charge += $room_comd_detail[$i]->payment_charge;
                    $org_amt += $room_comd_detail[$i]->orginal_cost;
                    $star = $room_comd_detail[$i]->star;
                    $image = $room_comd_detail[$i]->hotel_image;
                    $room_type .= $room_comd_detail[$i]->room_type . ',';

                    //                    $address = $room_comd_detail[$i]->address;
                    //  $phone = $room_comd_detail[$i]->phone;
                    //                    $fax = $room_comd_detail[$i]->fax;
                    $cancel_policy .= $room_comd_detail[$i]->room_type . '::' . $room_comd_detail[$i]->cancellation_policy . '||';
                }

                $promotional_discount = 0;
                if (!$this->session->userdata('agent_logged_in') && !empty($pass_info['user_promotional'])) {
                    $this->load->module('promotional/promo');
                    $promo_array = $this->promo->calculate_promo(1, $total_cost, $pass_info['user_promotional']);
                    $promotional_discount = $promo_array['discount'];
                }

                // Hotel Booking Reports Data
                $this->TboHotels_Model->insert_booking_report_data($BookingId, $BookingRefNo, $this->uniqueRefNo, $ConfirmationNo, $InvoiceNumber, $HotelBookingStatus, $Booking_Date, $org_amt, $org_amt, $total_cost, $admin_markup, $agent_markup, $payment_charge, $room_comd_detail[0]->currency, $room_comd_detail[0]->currency, $Booking_Done_By, $agent_id, $user_id, $cancel_policy, $room_comd_detail[0]->tokenid, $payment_type, $promotional_discount, $room_comd_detail[0]->tariff_notes, $room_comd_detail[0]->searcharray);

                // Hotel Booking Hotels Information Data
                $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $this->cin)));
                $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $this->cout)));
                //echo $checkIn.$checkOut;exit;
                //Update reference no to log
                /*          $this->db->set('unique_ref_id',$unique_RefNo);
                $this->Logger->append('hotels_api_logs',$this->sess_id,$this->session->userdata('sess_uniqueRefNo'),$this->api,array()); */

                $this->TboHotels_Model->insert_hotel_booking_information_data($uniqueRefNo, $room_comd_detail[0]->hotel_code, $room_comd_detail[0]->hotel_name, $room_comd_detail[0]->city_code, $checkIn, $checkOut, $Booking_Date, $room_comd_detail[0]->city_name, $room_type, '', $room_comd_detail[0]->star, $this->rooms, $room_comd_detail[0]->cancellation_policy, $this->adults_count, $this->childs_count, $room_comd_detail[0]->description, '', $room_comd_detail[0]->hotel_image, $this->nights, $this->api, $this->adults, $this->childs, $this->childs_ages, '', $room_comd_detail[0]->room_type_code, $room_comd_detail[0]->rate_plan_code, $room_comd_detail[0]->address, $room_comd_detail[0]->contact);
                //$this->unset_session_search_data();
                //exit;

                // if ($this->enable_email) {
                //     $pass_info = $this->session->userdata('passenger_info');
                //     //   echo '<pre>';print_r($pass_info);exit;
                //     $user_email = $pass_info['user_email'];
                //     $user_mobile = $pass_info['user_mobile'];
                //     $this->load->module('home/email');
                //     $data_email = array(
                //         'ticket_url' => site_url() . 'hotels/voucher1?voucherId=' . $uniqueRefNo . '&hotelRefId=' . $BookingId,
                //         'user_email' => $user_email,
                //         'referenceno' => $uniqueRefNo,
                //         'mobile' => $user_mobile,
                //         'pnr' => $BookingId,
                //         'subject' => 'Hotel Booking',
                //     );
                //     $this->email->ticket_email($data_email);
                // }
                redirect('hotels/voucher?voucherId=' . $uniqueRefNo, 'refresh');
            } else {
                $error = 'Booking failed or the price may be changed .Please Contact Admin';
                redirect('home/error_page/' . base64_encode($error));
            }
        } else {
            //$this->hotel_itinerary($sessionId, $hotelCode, $searchId);
        }
    }
    function deposit_withdraw($total_cost, $agent_markup, $uniqueRefNo)
    {

        $agent_id = $this->session->agent_id;
        $agent_no = $this->session->agent_no;

        $api = $pass_info['callBackId'];
        $hotelCode = $pass_info['hotelCode'];
        $searchId = $pass_info['searchId'];
        $sessionId = $pass_info['sessionId'];

        $available_balance = $this->TboHotels_Model->get_agent_available_balance($agent_no);
        $available_balance = empty($available_balance) ? 0 : $available_balance;
        $agent_markup = empty($agent_markup) ? 0 : $agent_markup;
        $withdraw_amount = $total_cost - $agent_markup;
        if ($available_balance < $withdraw_amount) {
            $error = 'Your balance is too low for booking this hotel';
            redirect('b2b/error_page/' . base64_encode($error));
        } else {
            $closing_balance = $available_balance - $withdraw_amount;

            $this->TboHotels_Model->insert_withdraw_status($agent_id, $agent_no, $withdraw_amount, $closing_balance, $uniqueRefNo);
            // echo $this->db->last_query();exit;
        }
    }
    public function book_RQ($room_comd_detail)
    {
        //echo '<pre>';print_r($room_comd_detail);//exit;
        $pass_info = $this->session->userdata('passenger_info');
        //    echo $this->rooms;
        //  echo '<pre>';print_r($pass_info);//exit;

        $hote_search = $this->session->userdata('hotel_search_data');
        // echo '<pre>';
        // print_r($this->adults);exit;

        $room_loop = '';
        $ad = 0;
        $cd = 0;
        for ($r = 0; $r < $this->rooms; $r++) {
            //foreach ($room_comd_detail as $val) {
            //   echo '<pre>';print_r($val);exit;
            //for ($p = 0; $p < count($room_comd_detail); $p++) {
            $val = $room_comd_detail[$r];
            //$room_no = $r + 1;
            // if ($room_no == $val->sequence_no) {
            $room_loop .= '{"RoomIndex": "' . $val->sequence_no . '",
            "RoomTypeCode": "' . $val->room_type_code . '",
            "RoomTypeName": "' . $val->room_type . '",
            "RatePlanCode": "' . $val->rate_plan_code . '",
            "BedTypeCode": "",
            "SmokingPreference": 0,
            "Supplements": "",';

            $price = unserialize($val->room_formats);
            //    echo '<pre>';print_r($price);exit;
            $room_loop .= '"Price": {
                "CurrencyCode": "' . trim($price->CurrencyCode) . '",
                "RoomPrice": "' . $price->RoomPrice . '",
                "Tax": "' . $price->Tax . '",
                "ExtraGuestCharge": "' . $price->ExtraGuestCharge . '",
                "ChildCharge": "' . $price->ChildCharge . '",
                "OtherCharges": "' . $price->OtherCharges . '",
                "Discount": "' . $price->Discount . '",
                "PublishedPrice": "' . $price->PublishedPrice . '",
                "PublishedPriceRoundedOff": "' . $price->PublishedPriceRoundedOff . '",
                "OfferedPrice": "' . $price->OfferedPrice . '",
                "OfferedPriceRoundedOff": "' . $price->OfferedPriceRoundedOff . '",
                "AgentCommission": "' . $price->AgentCommission . '",
                "AgentMarkUp": "' . $price->AgentMarkUp . '",
                "ServiceTax": "' . $price->ServiceTax . '",
                "TDS": "' . $price->TDS . '"
            },';
            // }
            //}
            $room_loop .= '
            "HotelPassenger": [';
            for ($j = 0; $j < $this->adults[$r]; $j++) {

                $room_loop .= '
                {
                    "Title": "' . $pass_info['adults_title'][$ad] . '",
                    "FirstName": "' . $pass_info['adults_fname'][$ad] . '",
                    "MiddleName" : "",
                    "LastName": "' . $pass_info['adults_lname'][$ad] . '",
                    "Phoneno":  "' . $pass_info['user_mobile'] . '",
                    "Email":  "' . $pass_info['user_email'] . '",
                    "PaxType": 1,';
                if (!empty($pass_info['user_pan'][$ad])) {
                    $room_loop .=  '
                        "PAN":  "' . $pass_info['user_pan'][$ad] . '",';
                }
                if ($j == 0) {
                    $room_loop .= '
                        "LeadPassenger": "true",';
                } else {
                    $room_loop .= '
                        "LeadPassenger": "false",';
                }
                $room_loop .= '
                    "Age":0';
                if ($j == $this->adults[$r] - 1 && $this->childs[$r] == 0) {
                    $room_loop .= '
                    }';
                } else {
                    $room_loop .= '
                },';
                }
                $ad++;
            }

            if ($this->childs[$r] != 0) {
                for ($k = 0; $k < $this->childs[$r]; $k++) {
                    // echo '<pre>';print_r($this->childs[$r]);exit;
                    $room_loop .= '
                {
                    "Title": "' . $pass_info['childs_title'][$cd] . '",
                    "FirstName": "' . $pass_info['childs_fname'][$cd] . '",
                    "MiddleName" : "",
                    "LastName": "' . $pass_info['childs_lname'][$cd] . '",
                    "Phoneno": "",
                    "Email": "",
                    "PaxType": 2,

                    "LeadPassenger": "false",';
                    if (!empty($pass_info['child_pan'][$cd])) {
                        $room_loop .=  '
                        "PAN":  "' . $pass_info['child_pan'][$cd] . '",';
                    }
                    $child_ages = explode(',', $this->childs_ages[$r]);
                    $room_loop .= '
                    "Age":' . $child_ages[$k] . '';

                    if ($k == $this->childs[$r] - 1) {
                        $room_loop .= '
                    }';
                    } else {
                        $room_loop .= '
                },';
                    }


                    $cd++;
                }
            }
            $room_loop .= '
    ]';
            if ($r == $this->rooms - 1) {
                $room_loop .= '
    }';
            } else {
                $room_loop .= '
    },';
            }
        }
        $date = str_replace('/', '-', $this->cin);
        $date_time = date('Y-m-d', strtotime($date));
        $book_rq = '{
    "ResultIndex": "' . $room_comd_detail[0]->tbo_session_index . '",
    "HotelCode": "' . $room_comd_detail[0]->hotel_code . '",
    "HotelName": "' . $room_comd_detail[0]->hotel_name . '",
    "GuestNationality": "' . $this->nationality . '",
    "NoOfRooms":' . $this->rooms . ',
    "ClientReferenceNo": 0,
    "IsVoucherBooking":true,
    "HotelRoomsDetails": [
    ' . $room_loop . '
    ],
    "ArrivalTransport": {
    "ArrivalTransportType": 0,
    "TransportInfoId": "Ab 777",
    "Time": "' . $date_time . 'T00:00:00' . '"
    },
    "FlightInfo": null,
    "OnlinePaymentId": 0,
    "TransactionId": null,
    "CancelAtPriceChangeAfterBooking": true,
    "IsAmountDeduct": false,
    "IsHotelImport": false,
    "MakePaymentInfo": null,
    "IsPackageFare": true,
    "EndUserIp": "' . $this->userIP . '",
    "TokenId": "' . $room_comd_detail[0]->tokenid . '",
    "TraceId": "' . $room_comd_detail[0]->traceid . '"
    }';
        //echo '<pre>';
        //print_r($book_rq);
        // exit;
        $book_rs = $this->executeRequestjson($book_rq, 'Book/');
        $book_resp = json_decode($book_rs);
        // echo '<pre>';
        //print_r($book_resp);
        //exit;
        // $this->db->set('hotelbooking_request', " CONCAT_WS('<endofxml>End Of XML</endofxml>',hoteldetail_request,'" . mysql_real_escape_string($book_rq) . "')", FALSE);
        // $this->db->set('hotelbooking_response', " CONCAT_WS('<endofxml>End Of XML</endofxml>',hoteldetail_response,'" . mysql_real_escape_string($book_rs) . "')", FALSE);
        // $this->Logger->append_by_ref('hotels_api_logs', $this->uniqueRefNo, $this->api, array());
        file_put_contents(FCPATH . 'dump/hotels/tbo_hotels/tbo_room_book_req.json', $book_rq);
        file_put_contents(FCPATH . 'dump/hotels/tbo_hotels/tbo_room_book_resp.json', $book_rs);
        //
        //  echo '<prE>';print_r($book_rs);
        //  echo '<pre>';print_r($book_resp);
        // exit;

        return $book_resp;
    }
    public function get_book_detail($ConfirmationNo, $BookingId, $tokenid)
    {
        $book_detail = '{
            "BookingId": "' . $BookingId . '",
            "EndUserIp": "' . $this->userIP . '",
            "TokenId": "' . $tokenid . '"
        }';
        //echo '<pre>';print_r($book_detail);
        $book_detail_rs = $this->executeRequestjson($book_detail, 'GetBookingDetail/');
        $detail_resp = json_decode($book_detail_rs);
        // echo '<pre>';print_r($detail_resp);exit;
        // $this->db->set('hotelbookdetail_request', " CONCAT_WS('<endofxml>End Of XML</endofxml>',hoteldetail_request,'" . mysql_real_escape_string($book_detail) . "')", FALSE);
        // $this->db->set('hotelbookdetail_response', " CONCAT_WS('<endofxml>End Of XML</endofxml>',hoteldetail_response,'" . mysql_real_escape_string($book_detail_rs) . "')", FALSE);
        // $this->Logger->append_by_ref('hotels_api_logs', $this->uniqueRefNo, $this->api, array());

        //echo $this->db->last_query();exit;
        file_put_contents(FCPATH . 'dump/hotels/tbo_hotels/tbo_getbookdetail_rq.json', $book_detail);
        file_put_contents(FCPATH . 'dump/hotels/tbo_hotels/tbo_getbookdetail_rs.json', $book_detail_rs);
        return $detail_resp;
    }
}
