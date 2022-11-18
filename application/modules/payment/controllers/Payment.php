<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
include(APPPATH.'razorpay/config.php');
include(APPPATH.'razorpay/razorpay-php/Razorpay.php');
use Razorpay\Api\Api as RazorpayApi;

class Payment extends MX_Controller {
  private $sess_id;
  private $merchantid;
  private $securityid;
  private $secretkey;
  private $returnurl;

  function __construct() {
    parent::__construct();
    $this->load->model('Payment_Model');
    // test credentials
    // $this->merchantid='GLIDETRIP';
    // $this->securityid='glidetrip';
    // $this->secretkey='SfFyr02FS5tJ';
    //$this->returnurl= site_url().'payment/returnpga';

    if ($this->session->session_id == '')
      redirect('home/index', 'refresh');

    $this->sess_id = $this->session->session_id;
  }

  public function index(){
 
      redirect('razorpay/index.php');      
      
  }

  public function returnpga(){ 
    
    $paymentresponse=$_REQUEST['msg'];
    $responsearray=explode('|',$paymentresponse);
    // echo '<pre>';print_r($responsearray);exit;
    $AuthStatus=trim($responsearray[14]);
    $failedmessage=trim($responsearray[24]);
    // validatresponstart
    $validresp=$paymentresponse;
    $vparesparray=explode('|',$validresp);
    $vcheckresp=end($vparesparray);
    array_pop($vparesparray);
    $vhashstr=implode('|',$vparesparray);
    $vchecksum = hash_hmac('sha256',$vhashstr,$this->secretkey, false); 
    $vchecksum = strtoupper($vchecksum);
    if($vchecksum != $vcheckresp){
      $dataupdate=array(
        'authstatus'=>$AuthStatus,
        'status'=>'FRAUD',
        'returnchecksum'=>$paymentresponse
      );
      $this->Payment_Model->updatedetails($dataupdate,$search_details['uniqueRefNo']);
      redirect('payment/paymentfailed','refresh');
      exit;
    }
    // validate responend
    if($AuthStatus=='0300'){
      $status='Success';
    }else{
      $status='Failed';
    }
    $search_details = $this->session->userdata('search_details');
    $totaamount=$search_details['cost'];
    $servicetype=$search_details['service_type'];
    $dataupdate=array(
      'authstatus'=>$AuthStatus,
      'status'=>$status,
      'returnchecksum'=>$paymentresponse
    );
    $this->Payment_Model->updatedetails($dataupdate,$search_details['uniqueRefNo']);

    if($AuthStatus=='0300'){ 
      if($servicetype==1){
        
      }elseif($servicetype==2){
        redirect('flights/confirm_book', 'refresh');
      }
    }else{
      redirect('payment/paymentfailed','refresh');
    }
  }

  public function paymentfailed(){ //echo 1;exit;
    $search_details = $this->session->userdata('search_details');
    $data['totaamount']=number_format($search_details['cost']);
    $this->load->view('payment_failed',$data);
  }

  
}