<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Paymentagent extends MX_Controller {
  private $sess_id;
  private $merchantid;
  private $securityid;
  private $secretkey;
  private $returnurl;
  private $agent_id;
  private $agent_no;

  function __construct() {
    parent::__construct();
    $this->load->model('Payment_Model');
    $this->load->model('agent/Agent_Model');
    $this->agent_id=$this->session->agent_id;
    $this->agent_no=$this->session->agent_no;
    // test credentials
    $this->merchantid='GLIDETRIP';
    $this->securityid='glidetrip';
    $this->secretkey='SfFyr02FS5tJ';
    $this->returnurl= site_url().'payment/paymentagent/paymentReturn';

    if ($this->session->session_id == '')
      redirect('home/index', 'refresh');

    $this->sess_id = $this->session->session_id;
  }

  public function index($amount){
    $amount=trim($amount);
    if(empty($amount) || $amount < 1) {
      $msg = 'Session expired';
      redirect('home/error_page/'.base64_encode($msg),'refresh');
    }

    $ip = $_SERVER['REMOTE_ADDR'];
    $uniquenumb='R'.$this->agent_id.rand('00000','1111111');
    $agentinfo=$this->Agent_Model->getAgentInfo();

    $service = 'Recharge';
    $module = 'b2b';
    
    // $totaamount = $amount;
    $totaamount = 2;
    $str = $this->merchantid.'|'.$uniquenumb.'|NA|'.$totaamount.'|NA|NA|NA|INR|NA|R|'.$this->securityid.'|NA|NA|F|'.$service.'|'.$module.'|'.$agentinfo->agent_email.'|NA|NA|NA|NA|'.$this->returnurl;
    $checksum = hash_hmac('sha256',$str,$this->secretkey, false); 
    $checksum = strtoupper($checksum);

    $payinsert= array(
      'uniqueRefNo' => $uniquenumb,
      'amount' => $amount,
      'name' => $agentinfo->first_name,
      'email' => $agentinfo->agent_email,
      'mobile' => $agentinfo->mobile_no,
      'servicetype' => 7,
      'ip' => $_SERVER['REMOTE_ADDR'],
      // 'api'=> 'Recharge',
      'checksum' => $str.'|'.$checksum
      // 'created_at'=> date('Y-m-d G:i:s'),
    );

    if(!empty($payinsert)){
      $payinsert_id = $this->Payment_Model->pay_details($payinsert);
    }
    $this->session->set_userdata('payinsert_id', $payinsert_id);
    $this->session->set_userdata('reuniquenumb', $uniquenumb);
    $this->session->set_userdata('amount', $amount);

    $data['MerchantID']=$this->merchantid;
    $data['CustomerID']=$uniquenumb;
    $data['TxnAmount']=$totaamount;
    $data['SecurityID']=$this->securityid;
    $data['checksum']=$str.'|'.$checksum;
    $data['RU']=$this->returnurl;
    $this->load->view('payment_load', $data);
    exit;
  }

  function paymentReturn(){
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
      $this->Payment_Model->updatedetails($dataupdate,$uniquenumb);
      redirect('payment/paymentagent/paymentfailed','refresh');
      exit;
    }
    // validate responend
    if($AuthStatus=='0300'){
      $status='Success';
    }else{
      $status='Failed';
    }
    $uniqueRefNo = $this->session->reuniquenumb;
    $paid_amount = $this->session->amount;
    $dataupdate=array(
      'authstatus'=>$AuthStatus,
      'status'=>$status,
      'returnchecksum'=>$paymentresponse
    );
    $this->Payment_Model->updatedetails($dataupdate,$uniqueRefNo);

    if($AuthStatus=='0300'){
        $balance = $this->Agent_Model->get_agent_available_balance();
        $data = array(
            'agent_id' => $this->agent_id,
            'agent_no' => $this->agent_no,
            'transaction_summary' => 'Recharge',
            'deposit_amount' => $paid_amount,
            'transaction_id' => $uniqueRefNo,
            'value_date' => date('Y-m-d'),
            'remarks' => 'Payment Recharge',
            'available_balance' => $balance+$paid_amount,
            'status' => 'Accepted',
        );
        //echo '<pre>';print_r($data);exit;
        $this->db->set('transaction_datetime', 'NOW()', FALSE);
        $this->db->insert('agent_acc_summary', $data);
        $id = $this->db->insert_id();

      redirect('agent/deposit_management', 'refresh');
    }else{
      redirect('payment/paymentagent/paymentfailed','refresh');
    }
  }

  public function paymentfailed(){ //echo 1;exit;
    $cost = $this->session->amount;
    $data['totaamount']=number_format($cost);
    $this->load->view('payment_failed',$data);
  }

  
}