<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class contract extends CI_CONTROLLER {

private $supplier_id;
private $max_image_size = '2000';
private $max_image_width = '1024';
private $max_image_height = '900';

function __construct() {
    parent :: __construct();
    $this->load->database();  
    $this->load->model('specialoffer_type'); 
    $this->load->model('specialoffer_list');  
    $this->load->model('currency'); 
    $this->load->model('sup_contract');
    $this->load->model('sup_contract_file');
    $this->load->model('sup_contract_comment');
    $this->load->model('supplier_info');
    $this->load->model('sup_contract_season');    
    $this->load->model('ace_jac_roomsxml_gta_city');
    $this->load->model('glb_hotel_facilities_type');
    $this->load->model('glb_hotel_room_type'); 
    $this->load->model('glb_hotel_property_type');
    $this->load->model('sup_contract_payment_condition'); 
    $this->load->model('country');  
    $this->load->model('supplier_hotel_list');
    $this->load->model('Upload_Model');
    $this->load->library('upload');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    $this->supplier_id = $this->session->userdata('supplier_id');
    $this->is_logged_in();
  
}
private function is_logged_in() {
    if (!$this->session->userdata('supplier_logged_in')) {
        redirect('login/supplier_login');
    }
}
public function new_contract()
{   
   
    $data['error']=''; 
    $data['action']='add_new_contract';
    $data['button']='save';  
    $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
    $data['hotel_list'] =$this->supplier_hotel_list->check($dataarray);    
    $data['sub_view'] = 'contract/add_new_contract';   
    $this->load->view('_layout_main',$data); 
}

public function getmarketlist()
{
  $data['country'] =$this->country->get(); 
  echo json_encode(array('result'=>$this->load->view('contract/load_ajax_nationality_list', $data, TRUE)));
}

public function add_contract()
{

  $this->form_validation->set_rules('hotel_id', 'Select Hotel', 'trim|required');
  $dataarray=array('supplier_hotel_list_id'=>$this->input->post('hotel_id'),'supplier_id'=>$this->supplier_id,'status'=>1);
  $hotel_details=$this->supplier_hotel_list->check($dataarray);
    if($this->form_validation->run()==FALSE) {     
        $errors_msg = validation_errors();      
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('contract/new_contract','refresh');
       
    }else if($hotel_details==''){
      $errors_msg="Try After Sometimes....";
       $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('contract/new_contract','refresh');
    }
     else {
     
        $contract_number = $this->sup_contract->get_last_contract_number();
        $contract_number = str_pad($contract_number + 1, 10, 0, STR_PAD_LEFT);  
        $data = array(
            'supplier_id' =>$this->supplier_id,
            'supplier_hotel_list_id' =>$this->input->post('hotel_id'),
            'hotel_code' =>$hotel_details[0]->hotel_code,
            'contract_number' =>$contract_number,
            'contract_desc' =>$this->input->post('contract_desc'),
            'start_date' =>date('Y-m-d',strtotime($this->input->post('start_date'))),
            'end_date' =>date('Y-m-d',strtotime($this->input->post('end_date'))),
            'signed_date' =>date('Y-m-d',strtotime($this->input->post('signed_date'))),                     
            'market_avail' =>$this->input->post('market_avail'), 
            'exclude_market' =>implode('||', $this->input->post('exclude_market')), 
             'status' =>0, 
            'status1' =>0,         
        );    
     
           $this->sup_contract->insert($data); 
        $this->session->set_flashdata('message','Contract Added Successfully!');
        redirect('contract/contract_list','refresh');        
        } 
        
 }


public function contract_list()
{   
    $data['contract_list'] =$this->sup_contract->get_only_supplier('*',$this->supplier_id); 
    $data['sub_view'] = 'contract/contract_list';   
    $this->load->view('_layout_main',$data); 
}


public function set_contract_status() {
    if(isset($_POST['id']) && isset($_POST['status'])){
    $data = array(
        'status' => $_POST['status'],          
    );
    $this->sup_contract->set_status($data,$_POST['id']);
    if( $_POST['status']==1){
        $msg = '<label class="label label-success">Active</label>';
        $statusmsg='Active';
    } else {
        $msg = '<label class="label label-warning">InActive</label>';
        $statusmsg='InActive';
    }
   echo json_encode(array('result' => $msg, 'status'=>$statusmsg));
   }
   else
   {
     echo json_encode(array('result' =>''));
   }
}

public function set_contract_status1() {
    if(isset($_POST['id']) && isset($_POST['status'])){
    $data = array(
        'status1' => $_POST['status'],          
    );
    $this->sup_contract->set_status($data,$_POST['id']);
    if( $_POST['status']==1){
        $msg = '<label class="label label-success">Completed</label>';
        $statusmsg='Completed';
    } else {
        $msg = '<label class="label label-warning">In Progress</label>';
        $statusmsg='In Progress';
    }
   echo json_encode(array('result' => $msg, 'status'=>$statusmsg));
   }
   else
   {
     echo json_encode(array('result' =>''));
   }
}

public function editcontract($id='')
{
    $data['contract_id']= $data['id'] = $contract_id = $_POST['id'];
    $dataarray=array('contract_id'=>$contract_id,'supplier_id'=>$this->supplier_id);
    $data['contract_info'] =$this->sup_contract->check($dataarray);
    $dataarray1=array('supplier_id'=>$this->supplier_id);
    $data['hotel_list'] =$this->supplier_hotel_list->check($dataarray1); 
    $data['country'] =$this->country->get();
    if(empty($data['contract_info']))
    {
     echo json_encode(array('contractcontent' => '' ));
    } 
    else
    {
       echo json_encode(array('contractcontent' =>$this->load->view('contract/load_edit_contract_ajax', $data, TRUE)));
    }
}

public function update_contract($id='')
{
    $data['contract_id']= $data['id'] = $contract_id = $id;
    $dataarray=array('contract_id'=>$contract_id,'supplier_id'=>$this->supplier_id);
    $data['contract_info'] =$this->sup_contract->check($dataarray);

     if($id=='' || empty($data['contract_info'])) {       
      echo json_encode(array('result' =>'', 'validation_error'=>'Try After Sometimes...'));
    } else {        
        $updatedata=array(            
            'contract_desc' =>$this->input->post('contract_desc'),
            'start_date' =>date('Y-m-d',strtotime($this->input->post('start_date'))),
            'end_date' =>date('Y-m-d',strtotime($this->input->post('end_date'))),
            'signed_date' =>date('Y-m-d',strtotime($this->input->post('signed_date'))),                      
             'market_avail' =>$this->input->post('market_avail'),  
            'exclude_market' =>implode(',', $this->input->post('exclude_market')),  
        );
        $this->sup_contract->update($updatedata, $id);
         echo json_encode(array('result' =>'Successfully Updated'));
       }
   

}

public function edit_contract() {
    $data['contract_id']= $data['id'] = $contract_id = $_GET['id'];
    $dataarray=array('contract_id'=>$contract_id,'supplier_id'=>$this->supplier_id);
    $data['contract_info'] =$this->sup_contract->check($dataarray);
    $dataarray=array('contract_id'=>$contract_id,'supplier_id'=>$this->supplier_id);
    $data['file_info'] =$this->sup_contract_file->check($dataarray);
    if(empty($data['contract_info']))
    {
      redirect('contract/contract_list','refresh');
    } 
    $data['sub_view'] = 'contract/edit_step1';
    $this->load->view('_layout_main',$data);
}

public function edit_step2() {
   $data['contract_id']= $data['id'] = $contract_id = $_GET['id'];
    $dataarray=array('contract_id'=>$contract_id,'supplier_id'=>$this->supplier_id);
    $data['contract_info'] =$this->sup_contract->check($dataarray);
    $dataarray=array('contract_id'=>$contract_id,'supplier_id'=>$this->supplier_id);
    $data['season_info'] =$this->sup_contract_season->check($dataarray);
    if(empty($data['contract_info']))
    {
      redirect('contract/contract_list','refresh');
    } 
    $data['sub_view'] = 'contract/edit_step2';
    $this->load->view('_layout_main',$data);
}


public function edit_step3() {
    $data['id'] = $id = $_GET['id'];
    $data['contract_id']= $data['id'] = $contract_id = $_GET['id'];
    $dataarray=array('contract_id'=>$contract_id,'supplier_id'=>$this->supplier_id);
    $data['contract_info'] =$this->sup_contract->check($dataarray);
    if(empty($data['contract_info']))
    {
      redirect('contract/contract_list','refresh');
    } 
    $data['sub_view'] = 'contract/edit_step3';
    $this->load->view('_layout_main',$data);
}


public function update_step3($id='')
{
    $data['contract_id']= $data['id'] = $contract_id = $id;
    $dataarray=array('contract_id'=>$contract_id,'supplier_id'=>$this->supplier_id);
    $data['contract_info'] =$this->sup_contract->check($dataarray);

     if($id==''|| $id!=$_POST['insert_id'] || empty($data['contract_info'])) {  
        echo json_encode(array('result' =>'Try After Sometimes...'));
    } else {        
        $updatedata=array(            
            'target_percent' =>$this->input->post('target_percent'),       
             'target_type' =>$this->input->post('target_type'),  
        );
        $this->sup_contract->update($updatedata, $id);
         echo json_encode(array('result' =>'Successfully Updated'));
       }
   

}
public function edit_step4() {
    $data['id'] = $id = $_GET['id'];
    $data['contract_id']= $data['id'] = $contract_id = $_GET['id'];
    $dataarray=array('contract_id'=>$contract_id,'supplier_id'=>$this->supplier_id);
    $data['contract_info'] =$this->sup_contract->check($dataarray);
    if(empty($data['contract_info']))
    {
      redirect('contract/contract_list','refresh');
    } 
    $data['sub_view'] = 'contract/edit_step4';
    $this->load->view('_layout_main',$data);
}


public function update_step4($id='')
{
    $data['contract_id']= $data['id'] = $contract_id = $id;
    $dataarray=array('contract_id'=>$contract_id,'supplier_id'=>$this->supplier_id);
    $data['contract_info'] =$this->sup_contract->check($dataarray);

     if($id==''|| $id!=$_POST['insert_id'] || empty($data['contract_info'])) {  
        echo json_encode(array('result' =>'Try After Sometimes...'));
    } else {        
        $updatedata=array(            
            'rate_type' =>$this->input->post('rate_type'),       
             'commission' =>$this->input->post('commission'), 
             'commissiontype' =>$this->input->post('commissiontype'),       
             'vat_applicable' =>$this->input->post('vat_applicable'), 
             'vat_percentage' =>$this->input->post('vat_percentage'),     
        );
        $this->sup_contract->update($updatedata, $id);
         echo json_encode(array('result' =>'Successfully Updated'));
       }
   

}
public function edit_step5() {
    $data['id'] = $id = $_GET['id'];
    $data['contract_id']= $data['id'] = $contract_id = $_GET['id'];
    $dataarray=array('contract_id'=>$contract_id,'supplier_id'=>$this->supplier_id);
    $data['contract_info'] =$this->sup_contract->check($dataarray);
    if(empty($data['contract_info']))
    {
      redirect('contract/contract_list','refresh');
    }   
    $data['sub_view'] = 'contract/edit_step5';
    $this->load->view('_layout_main',$data);
}

public function update_step5($id='')
{
    $data['contract_id']= $data['id'] = $contract_id = $id;
    $dataarray=array('contract_id'=>$contract_id,'supplier_id'=>$this->supplier_id);
    $data['contract_info'] =$this->sup_contract->check($dataarray);

     if($id==''|| $id!=$_POST['insert_id'] || empty($data['contract_info'])) {      
      echo json_encode(array('result' =>'Try After Sometimes...'));
    } else { 

    if($_POST['payment_type']=="PRE")
    {
      $insertdata=array( 
             'contract_id'=>$contract_id, 
             'supplier_id'=>$this->supplier_id,          
             'payment_type' =>$this->input->post('payment_type'),   
             'pre_payment_days' =>$this->input->post('pre_payment_days'),       
             'before_checkin' =>$this->input->post('before_checkin'),             
             'account_name' =>$this->input->post('account_name'),       
             'bank_name' =>$this->input->post('bank_name'), 
             'branch_office' =>$this->input->post('branch_office'),       
             'bank_address' =>stripslashes($this->input->post('bank_address')), 
             'account_number' =>$this->input->post('account_number'),  
             'swift_code' =>$this->input->post('swift_code'), 
             'iban' =>$this->input->post('iban'),            
        );
        $this->sup_contract_payment_condition->insert($insertdata);
         echo json_encode(array('result' =>'Successfully Updated'));  
    }
    else if($_POST['payment_type']=="POST")
    {
      $insertdata=array(   
             'contract_id'=>$contract_id, 
             'supplier_id'=>$this->supplier_id,           
             'payment_type' =>$this->input->post('payment_type'),       
             'single_reservation' =>$this->input->post('single_reservation'), 
             'post_payment_days' =>$this->input->post('post_payment_days'),       
             'after_checkin' =>$this->input->post('after_checkin'), 
             'period' =>$this->input->post('period'),
             'account_name' =>$this->input->post('account_name'),       
             'bank_name' =>$this->input->post('bank_name'), 
             'branch_office' =>$this->input->post('branch_office'),       
             'bank_address' =>stripslashes($this->input->post('bank_address')), 
             'account_number' =>$this->input->post('account_number'),  
             'swift_code' =>$this->input->post('swift_code'), 
             'iban' =>$this->input->post('iban'),            
        );
        $this->sup_contract_payment_condition->insert($insertdata);
         echo json_encode(array('result' =>'Successfully Updated'));  
    } 
    else{
        echo json_encode(array('result' =>'Try After Sometimes...'));
    }     
  }
}

public function edit_step6() {
     $data['id'] = $id = $_GET['id'];
    $data['contract_id']= $data['id'] = $contract_id = $_GET['id'];
    $dataarray=array('contract_id'=>$contract_id,'supplier_id'=>$this->supplier_id);
    $data['contract_info'] =$this->sup_contract->check($dataarray); 
    $data['contract_comment'] =$this->sup_contract_comment->check($dataarray);

    if(empty($data['contract_info']))
    {
      redirect('contract/contract_list','refresh');
    }    
    $data['sub_view'] = 'contract/edit_step6';
    $this->load->view('_layout_main',$data);
}


public function update_step6($id='')
{
    $data['contract_id']= $data['id'] = $contract_id = $id;     
    
     if($id==''|| $id!=$_POST['contract_id'] || empty($_POST['summary'])) {      
      echo json_encode(array('result' =>'Try After Sometimes...'));
    } else if(isset($_POST['id'])) {
      $dataarray=array('contract_id'=>$id,'supplier_id'=>$this->supplier_id,'id'=>$_POST['id']);
      $check=$this->sup_contract_comment->check($dataarray);
      if($check=='')
      { echo json_encode(array('result' =>'Try After Sometimes...'));}
      else
      {
         $updatedata=array( 
               'contract_id'=>$id,
               'supplier_id'=>$this->supplier_id, 
               'summary'=>$_POST['summary'],          
               'comment' =>$this->input->post('comment'),   
              
                       
          );
          $this->sup_contract_comment->update($updatedata,$_POST['id']);
           echo json_encode(array('result' =>'Successfully Updated')); 
      }
    }else 
    {
      $supplier_info=$this->supplier_info->get($this->supplier_id);
      $insertdata=array( 
            'contract_id'=>$id,
             'supplier_id'=>$this->supplier_id, 
             'summary'=>$_POST['summary'],          
             'comment' =>$this->input->post('comment'),   
             'user_name' =>$supplier_info->first_name.' '. $supplier_info->last_name,      
                     
        );
        $this->sup_contract_comment->insert($insertdata);
         echo json_encode(array('result' =>'Successfully Added')); 
    
   
  }
}

public function edit_contract_comment()
{
  $dataarray=array('id'=>$_POST['id'], 'supplier_id'=>$this->supplier_id,'contract_id'=>$_POST['contract_id']);
  $check=$this->sup_contract_comment->check($dataarray);

      if($check=='')
      {
        echo json_encode(array('result' =>'Try After Sometimes...'));
      }
      else
      {
         $data['contract_comment_info']=$this->sup_contract_comment->get_single($_POST['id']);
       echo json_encode(array('result' =>$this->load->view('contract/load_ajax_edit_comment', $data, TRUE)));
      }

}

public function delete_contract_comment()
{
  $this->sup_contract_comment->delete($_POST['id']);
  echo json_encode(array('result' =>'Successfully Deleted.....'));
}

public function viewcontractcomments()
{
  $dataarray=array('contract_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id);
  $data['contract_info']=$this->sup_contract->get_single($_POST['id']);
  $data['comment_info']=$this->sup_contract_comment->check($dataarray); 
  echo json_encode(array('result' =>$this->load->view('contract/load_ajax_comment_list', $data, TRUE)));
  
  
}


  public function update_contract_file()
  {
     if(isset($_POST['contract_id'])&&isset($_POST['contract_file_name'])){
      $dataarray=array('contract_id'=>$_POST['contract_id'],'supplier_id'=>$this->supplier_id);
      $check=$this->sup_contract->check($dataarray);
      if($check==''){
        redirect('contract/contract_list','refresh'); 
      }
      else{
    $insertdata=array(
                      'supplier_id'=>$this->supplier_id,
                      'contract_id'=>$_POST['contract_id'],
                      'file_name'=>$_POST['contract_file_name'],
                      'description'=>stripslashes($_POST['contractfile_desc']),
                     );
    $insert_id=$this->sup_contract_file->insert($insertdata);   
    $contract_id = $_POST['contract_id'];  
    $this->upload_contract_file($contract_id,$insert_id);
     redirect('contract/edit_contract?id='.$contract_id,'refresh');
   }
  }
  else{
    redirect('contract/contract_list','refresh');
  }
  }



      public function upload_contract_file($contract_id,$insert_id) { 

      $allowed = array('doc','docx' ,'txt','xls','xlsx','gif','jpg','png','jpeg','pdf');
      $filename = $_FILES['contract_file']['name'];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      if($_FILES['contract_file']['size'] <= 10485760 && in_array($ext,$allowed) ) {
      $uploaddir = FCPATH.'/uploads/'.$this->supplier_id.'/';
      $file_path = 'contract/' . $contract_id . '/fileupload/'.$insert_id.'/';
      $upload_path= $uploaddir.$file_path;
      if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, TRUE);
      }    
      $uploadfile = $upload_path . basename($_FILES['contract_file']['name']);
      if (move_uploaded_file($_FILES['contract_file']['tmp_name'], $uploadfile)){
      $updatedata=array('file_path'=>$file_path.$_FILES['contract_file']['name']);
        $this->sup_contract_file->update($updatedata,$insert_id);
      }     
    }   
    else
    {
        $this->sup_contract_file->delete($insert_id);
    }
  }

  public function add_contract_season() 
  {
     if(isset($_POST['contract_id'])&&isset($_POST['season_code']) &&isset($_POST['season_name'])){
      $dataarray=array('contract_id'=>$_POST['contract_id'],'supplier_id'=>$this->supplier_id);
      $check=$this->sup_contract->check($dataarray);
      if($check==''){
        redirect('contract/contract_list','refresh'); 
      }
      else{
    $insertdata=array(
                      'supplier_id'=>$this->supplier_id,
                      'contract_id'=>$_POST['contract_id'],
                      'season_code'=>$_POST['season_code'],
                      'season_name'=>$_POST['season_name'],
                      'periods'=>$_POST['periods'],
                     );
    $insert_id=$this->sup_contract_season->insert($insertdata);
    $contract_id = $_POST['contract_id'];    
     redirect('contract/edit_step2?id='.$contract_id,'refresh');
   }
  }
  else{
    redirect('contract/contract_list','refresh');
  }
  }

  public function addperiod_contract_season()
  {
      if(isset($_POST['contract_id'])&&isset($_POST['season_id']) &&isset($_POST['periods'])){
      $dataarray=array('contract_id'=>$_POST['contract_id'],'supplier_id'=>$this->supplier_id);
      $check=$this->sup_contract->check($dataarray);
      if($check==''){
        redirect('contract/contract_list','refresh'); 
      }
      else{
          $dataarray=array('id'=>$_POST['season_id'],'contract_id'=>$_POST['contract_id'],'supplier_id'=>$this->supplier_id);
      $check1=$this->sup_contract_season->check($dataarray);
       $contract_id = $_POST['contract_id'];    
       if($check1==''){
        redirect('contract/edit_step2?id='.$contract_id,'refresh');
      }
      else{
        if (strpos($check1[0]->periods, $_POST['periods']) === false) {   

    $updatedata=array(                    
                      'periods'=>$check1[0]->periods.'<br>'.$_POST['periods'],
                     );
    $this->sup_contract_season->update($updatedata,$_POST['season_id']);
    }   
     redirect('contract/edit_step2?id='.$contract_id,'refresh');
   }

  }
  }
  else{
    redirect('contract/contract_list','refresh');
  }
  }

   public function downloadcontractfile($id='',$id1='')
  {
     $dataarray=array('id'=>$id,'contract_id'=>$id1,'supplier_id'=>$this->supplier_id);
      $check=$this->sup_contract_file->check($dataarray);
      if($check=='')
      {
        if($id1!='')
        {
             redirect('contract/edit_contract?id='.$id1,'refresh');
        }
        else
        {
           redirect('contract/contract_list','refresh');
        }
      }
      else
      {      
      
    
        $file_info=$this->sup_contract_file->get_single($id);
        $url  = site_url().'uploads/'.$file_info->supplier_id.'/'.$file_info->file_path;
        $path = $file_info->file_path;
        $fp = fopen($path, 'w');
       $ch = curl_init($url);
       curl_setopt($ch, CURLOPT_FILE, $fp);
       $data = curl_exec($ch);
       curl_close($ch);
      fclose($fp);      
      redirect('contract/edit_contract?id='.$id1,'refresh');
      }

  }

public function set_season_status() {
    if(isset($_POST['id']) && isset($_POST['status'])){
    $data = array(
        'status' => $_POST['status'],          
    );
    $this->sup_contract_season->set_status($data,$_POST['id']);
    if( $_POST['status']==1){
        $msg = '<label class="label label-success">Active</label>';
        $statusmsg='Active';
    } else {
        $msg = '<label class="label label-warning">Inactive</label>';
        $statusmsg='Inactive';
    }
   echo json_encode(array('result' => $msg, 'status'=>$statusmsg));
   }
   else
   {
     echo json_encode(array('result' =>''));
   }
}



public function update_contract_season($id='')
{

  $this->form_validation->set_rules('season_code', 'Season Code', 'trim|required');
  $this->form_validation->set_rules('season_name', 'Season Name', 'trim|required');
    if($this->form_validation->run()==FALSE) {       
      echo json_encode(array('result' =>'', 'header'=>'Edit Season','validation_error'=>validation_errors()));
    } else {
       $dataarray=array('id'=>$id,'supplier_id'=>$this->supplier_id);
      $check=$this->sup_contract_season->check($dataarray);
        if($check==''){  
        
             echo json_encode(array('result' =>'', 'header'=>'Edit Season','validation_error'=>'Try After Sometimes...'));
           }
        
         else{       
        
        $updatedata=array(           
            'season_code' =>$this->input->post('season_code'),
            'season_name' =>$this->input->post('season_name'),
            'periods' => implode('<br>', $this->input->post('periods')),
        );
       $this->sup_contract_season->update($updatedata,$id);
         echo json_encode(array('result' =>'Successfully Updated', 'header'=>'Edit Season'));
     }
   }
  

}

public function edit_contract_season()
{
    $data['season_info']=$this->sup_contract_season->get_single($_POST['id']);
   if(!isset($_POST['id']) || empty($data['season_info']))
   {
     echo json_encode(array('result' =>'', 'header'=>'Edit Season','validation_error'=>'Try after Sometimes'));
   }
   else{ 

    $result = $this->load->view('contract/load_edit_contract_season_ajax',  $data, TRUE);
    echo json_encode(array('result' => $result, 'header'=>'Edit Season'));
     }

}

public function remove_contract_season_period()
{
   if(isset($_POST['id']) && isset($_POST['period'])){

  $dataarray=array('id'=>$_POST['id'],'supplier_id'=>$this->supplier_id);
      $check=$this->sup_contract_season->check($dataarray);
    if($check!=''){
      $periodstr1=$_POST['period'].'<br>';
    if (strpos($periodstr1,$check[0]->periods) !== false) { 
    $periodsreplace=str_replace($periodstr1,"",$check[0]->periods);  

    $updatedata=array(                    
                      'periods'=>$periodsreplace,
                     );
    $this->sup_contract_season->update($updatedata,$_POST['id']);
     echo json_encode(array('result' => 'success'));
   }
   else if(strpos($_POST['period'],$check[0]->periods) !== false){
     $periodsreplace=str_replace($_POST['period'],"",$check[0]->periods); 
    $updatedata=array(                    
                      'periods'=>$periodsreplace,
                     );
    $this->sup_contract_season->update($updatedata,$_POST['id']);
    
   }
   echo json_encode(array('result' => 'success'));
   }
  else
   {
     echo json_encode(array('result' =>''));
   }
  }
   else
   {
     echo json_encode(array('result' =>''));
   }
}

public function viewpaymentlist()
{
  $data['contract_id']=$contract_id=$_POST['id'];
  $dataarray=array('supplier_id'=>$this->supplier_id,'contract_id'=>$contract_id);
  $payment_list=$this->sup_contract_payment_condition->check($dataarray);
  $data['payment_list']=$payment_list;
  if(!isset($_POST['id']) || $payment_list=='')
  {
    echo json_encode(array('result'=>'','validation_error'=>'Sorry No Record'));
  }
  else{
    echo json_encode(array('result'=>$this->load->view('contract/load_ajax_payment_list', $data, TRUE)));
  }
}

}

