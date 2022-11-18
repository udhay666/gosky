<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Glogin extends MX_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Glogin_Model');
  }

  public function login() {
    include(APPPATH.'libraries/googlelogin/login.php');
    if(isset($_GET['code'])){
      $gClient->authenticate($_GET['code']);
      $_SESSION['token'] = $gClient->getAccessToken();
      header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
    }
    if (isset($_SESSION['token'])) {
      $gClient->setAccessToken($_SESSION['token']);
    }
    if ($gClient->getAccessToken()) {
      $user = $google_oauthV2->userinfo->get();
      $res=$this->Glogin_Model->validateuser($user['email']);
      if ($res !== ''|| !empty($res))  {
        $sessionUserInfo = array(
          'user_id' => $res->id,
          'user_no' => $res->user_no,
          'user_email' => $res->user_email,
          'first_name' => $res->first_name,
          'last_name' => $res->last_name,
          'user_logged_in' => TRUE,
          'guser_login'=>TRUE,
          'gpicurl'=>$user['picture']
        );
        $this->session->set_userdata($sessionUserInfo);
        $this->Glogin_Model->insert_login_activity();
        ?>
        <script type="text/javascript">
          window.close();
          function checkprelogin()
          {
            var testpremodalLogin = window.opener.document.getElementById("premodalLogin");
            var testpremodalRegister = window.opener.document.getElementById("premodalRegister");
            var classes=['in'];
            if(testpremodalLogin && checkhasClass(testpremodalLogin, classes[0]))
            {
              return 1;
            }
            else if(testpremodalRegister && checkhasClass(testpremodalRegister, classes[0]))
            {
              return 1;
            }
            else
            {
              return 0;
            }
          }
          function checkhasClass(element, classn)
          {
            return (' ' + element.className + ' ').indexOf(' ' + classn+ ' ') > -1;
          }
          if(checkprelogin())
          {
            window.opener.pregAjaxlogin();
          }
          else
          {
            window.opener.gAjaxlogin();
          }
        </script>
        <?php
      }
      else
      {
        $data = array(
          'user_email' => $user['email'],
          'user_password' => '',
          'title' => '',
          'first_name' => $user['given_name'],
          'last_name' => $user['family_name'],
          'mobile_no' => '',
          'address'=>'',
          'state'=>'',
          'country'=>'',
          'pin_code'=>'',
          'gender'=>$user['gender'],
          'DOB'=>'',
          'status' => 1
        );
        $user_no=$this->Glogin_Model->addb2cuser($data);
        if($user_no!=='')
        {
          $res=$this->Glogin_Model->getUserInfo($user_no);
          $this->load->module('b2c/zoho');
          $this->zoho->insertRecordsIntoZohoB2C($user_no, $user['email'], $user['given_name'], $user['family_name'], $mobile_no='');
          $sessionUserInfo = array(
            'user_id' => $res->id,
            'user_no' => $user_no,
            'user_email' => $user['email'],
            'first_name' => $user['given_name'],
            'last_name' => $user['family_name'],
            'user_logged_in' => TRUE,
            'guser_login'=>TRUE,
            'gpicurl'=>$user['picture']
          );
          $this->session->set_userdata($sessionUserInfo);
          $this->Glogin_Model->insert_login_activity();
        }
        ?>
        <script type="text/javascript">
          window.close();
          function checkprelogin()
          {
            var testpremodalLogin = window.opener.document.getElementById("premodalLogin");
            var testpremodalRegister = window.opener.document.getElementById("premodalRegister");
            var classes=['in'];
            if(testpremodalLogin && checkhasClass(testpremodalLogin, classes[0]))
            {
              return 1;
            }
            else if(testpremodalRegister && checkhasClass(testpremodalRegister, classes[0]))
            {
              return 1;
            }
            else
            {
              return 0;
            }
          }
          function checkhasClass(element, classn)
          {
            return (' ' + element.className + ' ').indexOf(' ' + classn+ ' ') > -1;
          }
          if(checkprelogin())
          {
            window.opener.pregAjaxlogin();
          }
          else
          {
            window.opener.gAjaxlogin();
          }
        </script>
        <?php
      }
    }
    else
    {
      ?>
      <script type="text/javascript">
        window.close();
        function checkprelogin()
        {
          var testpremodalLogin = window.opener.document.getElementById("premodalLogin");
          var testpremodalRegister = window.opener.document.getElementById("premodalRegister");
          var classes=['in'];
          if(testpremodalLogin && checkhasClass(testpremodalLogin, classes[0]))
          {
            return 1;
          }
          else if(testpremodalRegister && checkhasClass(testpremodalRegister, classes[0]))
          {
            return 1;
          }
          else
          {
            return 0;
          }
        }
        function checkhasClass(element, classn)
        {
          return (' ' + element.className + ' ').indexOf(' ' + classn+ ' ') > -1;
        }
        if(checkprelogin())
        {
          window.opener.pregAjaxlogin();
        }
        else
        {
          window.opener.gAjaxlogin();
        }
      </script>
      <?php
    }
  }
  public function logout() {
    $this->session->unset_userdata('user_id');
    $this->session->unset_userdata('user_logged_in');
    $this->session->unset_userdata('guser_login');
    $this->session->sess_destroy();
    redirect('', 'refresh');
  }
  
  public function trigerGAjax() {
    $results=$this->load->view('home/user_menu','', TRUE);
    if($this->session->userdata('user_no'))
    {
      $userInfo=$this->Glogin_Model->getUserInfo($this->session->userdata('user_no'));
      if(!empty($userInfo))
      {
        $title= $userInfo->title;
        $user_email= $userInfo->user_email;
        $first_name= $userInfo->first_name;
        $middle_name= $userInfo->middle_name;
        $last_name= $userInfo->last_name;
        $gender= $userInfo->gender;
        $user_mobile= $userInfo->mobile_no;
        $address= $userInfo->address;
        $user_pincode= $userInfo->pin_code;
        $user_city= $userInfo->city;
        $user_state= $userInfo->state;
        $user_country= $userInfo->country;
      }
      else
      {
        $title= '';
        $user_email='';
        $first_name= '';
        $middle_name= '';
        $last_name='';
        $gender='';
        $user_mobile= '';
        $address= '';
        $user_pincode= '';
        $user_city= '';
        $user_state= '';
        $user_country= '';
      }
    }
    else
    {
      $title= '';
      $user_email='';
      $first_name= '';
      $middle_name= '';
      $last_name='';
      $gender='';
      $user_mobile= '';
      $address= '';
      $user_pincode= '';
      $user_city= '';
      $user_state= '';
      $user_country= '';
    }
    echo json_encode(array(
      'results'=>$results,
      'email'=>$user_email,
      'user_email' =>$user_email,
      'title' =>$title,
      'first_name' =>$first_name,
      'middle_name' =>$middle_name,
      'last_name' =>$last_name,
      'user_mobile' =>$user_mobile,
      'gender' =>$gender,
      'address' =>$address,
      'user_pincode' =>$user_pincode,
      'user_city' =>$user_city,
      'user_state' =>$user_state,
      'user_country' =>$user_country,
    ));
  }
}