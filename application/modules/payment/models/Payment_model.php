<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Payment_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function pay_details($payinsert){
     $this->db->insert('billdesk', $payinsert);
     $payinsert_id = $this->db->insert_id();
     return $payinsert_id;
 }

public function updatedetails($dataupdate,$uniqueRefNo){
    if($uniqueRefNo!=''){
        $payinsert_id = $this->session->userdata('payinsert_id');
        $this->db->where('payment_id',$payinsert_id);   
        $this->db->where('uniqueRefNo',$uniqueRefNo);   
        $this->db->update('billdesk',$dataupdate);
    }
    return;
}


}
?>
