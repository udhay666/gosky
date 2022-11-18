<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fblogin extends MX_Controller {

  public function __construct() {
  parent::__construct();
  $this->load->model('Fblogin_model');

  }
  public function login()
  { 
    $user = $_POST;
    // echo '<pre>'; print_r($_POST); exit;
    // $pic=json_decode($user['picture'], true);
    // $fbpicurl=$pic['data']['url'];
    $res=$this->Fblogin_model->validateuser($user['email']);

    if ($res !== ''|| !empty($res))  {
      // echo '<pre>123'; print_r($res); exit;
        $sessionUserInfo = array(  
        'user_id' => $res->id,                  
        'user_no' => $res->user_no,
        'user_email' => $res->user_email,
        'first_name' => $res->first_name,
        'last_name' => $res->last_name,
        'user_logged_in' => TRUE,
        'fbuser_login'=>TRUE,
        // 'fbpicurl'=> $fbpicurl
        ); 
        $this->session->set_userdata($sessionUserInfo);       
        $this->Fblogin_model->insert_login_activity();
        // echo 'true';
        // echo json_encode(array(                   
        //            'results'=>$this->load->view('home/user_menu','', TRUE),
        //         ));
        //$results=$this->load->view('home/user_menu','', TRUE);
        echo json_encode(array(                    
        //'results'=>$results,                   
        'user_email' => $res->user_email,
        'title' =>$res->title,    
        'first_name' => $res->first_name,
        'middle_name' =>$res->middle_name,
        'last_name' => $res->last_name,
        'user_mobile' => $res->mobile_no,                  
        'gender' =>$res->gender,                 
        'address' =>$res->address,
        'user_pincode' =>$res->pin_code,
        'user_city' =>$res->city,
        'user_state' =>$res->state,
        'user_country' => $res->country,        

        ));

    }else{
          $data = array(
          'user_email' => $user['email'],
          //'user_password' => '',
          //'title' => '',
          'first_name' => $user['first_name'],
          // 'middle_name'=>$user['middle_name'],
          'last_name' => $user['last_name'],
          //'mobile_no' => '',
          //'address'=>'',
          //'state'=>'',
          //'country'=>'',
          //'pin_code'=>'',
          //'gender'=>$user['gender'],
          //'DOB'=>'',
          'status' => 1
          );
          $user_no=$this->Fblogin_model->addb2cuser($data);  
          if($user_no!=='')
          {
              $res=$this->Fblogin_model->getUserInfo($user_no);
              //$this->load->module('b2c/zoho');
              //$this->zoho->insertRecordsIntoZohoB2C($user_no, $user['email'], $user['first_name'], $user['last_name'], $mobile_no='');  
              $sessionUserInfo = array(   
              'user_id' => $res->id,                 
              'user_no' => $user_no,
              'user_email' => $user['email'],
              'first_name' => $user['first_name'],
              'last_name' => $user['last_name'],
              //'name'=> $user['name'],
              'user_logged_in' => TRUE,
              'fbuser_login'=>TRUE,
              // 'fbpicurl'=>$fbpicurl
              );
              $this->session->set_userdata($sessionUserInfo);
              $this->Fblogin_model->insert_login_activity();
              //$results=$this->load->view('home/user_menu','', TRUE);
              echo json_encode(array(                    
              // 'results'=>$results,                   
              'user_email' => $res->user_email,
              'title' =>$res->title,    
              'first_name' => $res->first_name,
              'middle_name' =>$res->middle_name,
              'last_name' => $res->last_name,
              'user_mobile' => $res->mobile_no,                  
              'gender' =>$res->gender,                 
              'address' =>$res->address,
              'user_pincode' =>$res->pin_code,
              'user_city' =>$res->city,
              'user_state' =>$res->state,
              'user_country' => $res->country,        

              ));
          }else{
              // echo 'true';
              echo json_encode(array(                   
              //'results'=>$this->load->view('home/user_menu','', TRUE),
              'user_email' => '',
              'title' =>'',    
              'first_name' => '',
              'middle_name' =>'',
              'last_name' => '',
              'user_mobile' => '',                  
              'gender' =>'',                 
              'address' =>'',
              'user_pincode' =>'',
              'user_city' =>'',
              'user_state' =>'',
              'user_country' => '',   
              ));

          }
    }     

  }
  public function logout() {
    $this->session->unset_userdata('user_id');
    $this->session->unset_userdata('user_no');
    $this->session->unset_userdata('user_logged_in');
    $this->session->unset_userdata('fbuser_login');
    $this->session->unset_userdata('guser_login');
    $this->session->sess_destroy();

    redirect('', 'refresh');
  }
}