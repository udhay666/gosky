<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class cronjob extends CI_CONTROLLER {
    function __construct() {
        parent :: __construct();
        $this->load->database();       
        $this->load->model('holiday_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('admin_auth');
        $this->is_logged_in();
    }
    private function is_logged_in() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login/admin_login');
        }
    }
 
public function update_holiday_account()
{
 exit;
    // error_reporting(E_ALL);
    $holiday_booking_data=$this->holiday_model->holiday_booking_data();    
    if(!empty($holiday_booking_data))
    {
     for($i=0;$i<count($holiday_booking_data);$i++)
     {
        $holiday_details=$this->holiday_model->get_holiday_list_by_id($holiday_booking_data[$i]->holiday_id);
        $destination=explode(',', $holiday_details->destination);
        $city=$this->holiday_model->getdesticity($destination[0]);
         $xml_request='<x:Envelope xmlns:x="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/" xmlns:ati="http://schemas.datacontract.org/2004/07/ATibilling.BenzyPlus.WCConnect.Application.MainBoundedContext.WCPlusSystem.RemoteDTOs">
    <x:Header/>
    <x:Body>
        <tem:ProcessMiscSales>
            <tem:objMisInvoice>
                <ati:BasicAmt>'.round($holiday_booking_data[$i]->package_amount).'</ati:BasicAmt>
                <ati:BookingNumber>testRFD</ati:BookingNumber>
                <ati:CheckIn>'.date("Y-m-d", strtotime($holiday_booking_data[$i]->arrival_date)).'T00:00:00</ati:CheckIn>
                <ati:CheckOut>'.date("Y-m-d", strtotime($holiday_booking_data[$i]->depart_date)).'T00:00:00</ati:CheckOut>
                <ati:ClientCode>AHB2C</ati:ClientCode>
                <ati:CommPaid>0</ati:CommPaid>
                <ati:CommRcvd>'.round($holiday_booking_data[$i]->discount_amount).'</ati:CommRcvd>
                <ati:ContactNo>'.$holiday_booking_data[$i]->user_mobile.'</ati:ContactNo>
                <ati:Destination>'.$city[0]->city_name.'</ati:Destination>
                <ati:DocDate>'.str_replace(' ','T',$holiday_booking_data[$i]->booking_datetime).'</ati:DocDate>
                <ati:FileReference></ati:FileReference>
                <ati:HotelName>'.$holiday_booking_data[$i]->package_title.'</ati:HotelName>
                <ati:HotelRoomCount>0</ati:HotelRoomCount>
                <ati:NetClientAmount>'.round($holiday_booking_data[$i]->package_amount).'</ati:NetClientAmount>
                <ati:NetSuppAmount>'.round($holiday_booking_data[$i]->package_amount).'</ati:NetSuppAmount>
                <ati:NoOfPax>1</ati:NoOfPax>
                <ati:PaxName>TEST</ati:PaxName>
                <ati:Reference>'.$holiday_booking_data[$i]->uniqueRefNo.'</ati:Reference>
                <ati:Remark1></ati:Remark1>
                <ati:Remark2></ati:Remark2>
                <ati:Remark3></ati:Remark3>
                <ati:Remark4></ati:Remark4>
                <ati:Remark5></ati:Remark5>
                <ati:Remarks></ati:Remarks>
                <ati:ServChgsCollected>0</ati:ServChgsCollected>
                <ati:ServChgsPayable>0</ati:ServChgsPayable>
                <ati:ServiceCode>IN</ati:ServiceCode>
                <ati:StaxCollected>0</ati:StaxCollected>
                <ati:StaxPayable>0</ati:StaxPayable>
                <ati:SupplierCode>28160</ati:SupplierCode>
                <ati:TaxAmt>0</ati:TaxAmt>
                <ati:TransType>S</ati:TransType>
                <ati:TransactionId>'.$holiday_booking_data[$i]->holiday_booking_id.'</ati:TransactionId>
                <ati:TravelDate>'.date("Y-m-d", strtotime($holiday_booking_data[$i]->arrival_date)).'T00:00:00</ati:TravelDate>
            </tem:objMisInvoice>
        </tem:ProcessMiscSales>
    </x:Body>
</x:Envelope>';
$soap='http://tempuri.org/IWCATIService/ProcessMiscSales';
$url = 'http://test.benzyinfotech.com:8067/Iboss/WCB2BService.svc';
 $httpHeader = array(//"POST HTTP/1.1",
           "SOAPAction: {$soap}",
            "Content-Type: text/xml; charset=utf-8",
            "Content-Length: " . strlen($xml_request)
        );
// echo $xml_request; 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 360);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_request);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);

        // Execute request, store response and HTTP response code
          $response = curl_exec($ch);
         $error = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch); 
        // echo $response;
        $accounting_response=$response;
        $this->holiday_model->holiday_booking_accounting_response($holiday_booking_data[$i]->holiday_booking_id,$accounting_response);
         // exit;

    }
    echo 'SuccessFully Updated'; exit;
 }
 else
 {
     echo 'Already Updated'; exit;
 }
}

}


