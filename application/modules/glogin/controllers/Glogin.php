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
      $res = $this->Glogin_Model->validateuser($user['email']);
      if ($res !== '' || !empty($res)) {
        $sessionUserInfo = array(  
          'user_id' => $res->id,                  
          'user_no' => $res->user_no,
          'user_email' => $res->user_email,
          'first_name' => $res->first_name,
          'last_name' => $res->last_name,
          'user_logged_in' => TRUE,
          'guser_login'=>TRUE,
        );
        $datastat['status'] = 1;
      } else {
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
        $user_no = $this->Glogin_Model->addb2cuser($data);  
        if($user_no !=='') {
          $res=$this->Glogin_Model->getUserInfo($user_no); 
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
          $datastat['status'] = 1;
        } else {
          $datastat['status'] = 1;
        }
      }
      // $this->load->view('glogin/scripts', $datastat, TRUE);
      $this->scriptLoad();
      $this->session->set_userdata($sessionUserInfo);
      $this->Glogin_Model->insert_login_activity();
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

  public function scriptLoad() { ?>
  <script type="text/javascript">
    window.opener.location.reload();
    window.close();
  </script>
  <?php }


}

