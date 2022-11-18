<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Markup_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


public function get_parent_info($parent_id){
    $this->db->select('*');
    $this->db->from('agent_info');
    $this->db->where('agent_id',$parent_id);
   
    $query=$this->db->get();
    if($query->num_rows>0){
        return $query->row();
    }else{
        return '';
    }
}

    function get_admin_markup($nationality,$api) {
		$admin_markup_process = 1;	
        $this->db->select('name');
        $this->db->from('country');
        $this->db->where('iso2', $nationality);
        $this->db->limit('1');
        $query = $this->db->get();
        $res = $query->row();
        $country = $res->name;


        $this->db->select('markup,markup_process');
        $this->db->from('b2c_markup_info');
        $this->db->where('markup_type', 'specific');
        $this->db->where('country', $country);
        $this->db->where('service_type', 1);
        $this->db->where('api_name', $api);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query1 = $this->db->get();
        if ($query1->num_rows > 0) {
            $res1 = $query1->row();
            $admin_markup_val = $res1->markup;
			$admin_markup_process = $res1->markup_process;			
        } else {
            $this->db->select('markup,markup_process');
            $this->db->from('b2c_markup_info');
            $this->db->where('markup_type', 'generic');
            $this->db->where('service_type', 1);
            $this->db->where('api_name', $api);
            $this->db->where('status', 1);
            $this->db->limit('1');
            $query2 = $this->db->get();
            if ($query2->num_rows > 0) {
                $res2 = $query2->row();
                $admin_markup_val = $res2->markup;
				$admin_markup_process = $res2->markup_process;
            } else {
                $admin_markup_val = 0;
            }
        }
		return array($admin_markup_val,$admin_markup_process);
    }

     function get_payment_charge() {
        $this->db->select('charge');
        $this->db->from('payment_gateway');
        $this->db->where('service_type', 1);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $res = $query->row();
            $payment_charge_val = $res->charge;
        } else {
            $payment_charge_val = 0;
        }
        return $payment_charge_val;
    }

//      function get_admin_agent_markup($agent_no,$nationality,$api) {
//		$agent_markup_process = 1;	 
//        $this->db->select('name');
//        $this->db->from('country');
//        $this->db->where('iso2', $nationality);
//        $this->db->limit('1');
//        $query = $this->db->get();
//        $res = $query->row();
//        $country = $res->name;	 
//        $this->db->select('markup,markup_process');
//        $this->db->from('b2b_markup_info');
//        $this->db->where('markup_type', 'specific');
//        $this->db->where('country', $country);		
//        $this->db->where('agent_no', $agent_no);
//        $this->db->where('service_type', 1);
//        $this->db->where('api_name', $api);
//        $this->db->where('status', 1);
//        $this->db->limit('1');
//        $query1 = $this->db->get();
//        if ($query1->num_rows > 0) {
//            $res1 = $query1->row();
//            $agent_markup_val = $res1->markup;
//            $agent_markup_process = $res1->markup_process;
//        } else {
//            $this->db->select('markup,markup_process');
//            $this->db->from('b2b_markup_info');
//            $this->db->where('markup_type', 'generic');
//            $this->db->where('agent_no', $agent_no);
//            $this->db->where('service_type', 1);
//            $this->db->where('api_name', $api);
//            $this->db->where('status', 1);
//            $this->db->limit('1');
//            $query2 = $this->db->get();
//            if ($query2->num_rows > 0) {
//                $res2 = $query2->row();
//                $agent_markup_val = $res2->markup;
//				$agent_markup_process = $res2->markup_process;
//            } else {
//                $agent_markup_val = 0;
//            }
//        }
//        return array($agent_markup_val,$agent_markup_process);
//    }
 
    function get_admin_di_markup($agent_no,$nationality,$api) {
        $this->db->select('markup');
        $this->db->from('admin_distributor_markup_info');
        $this->db->where('markup_type', 'specific');
        $this->db->where('agent_no', $agent_no);
        $this->db->where('service_type', 1);
        $this->db->where('api_name', $api);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query1 = $this->db->get();
        if ($query1->num_rows > 0) {
            $res1 = $query1->row();
            $agent_markup_val = $res1->markup;
        } else {
            $this->db->select('markup');
            $this->db->from('admin_distributor_markup_info');
            $this->db->where('markup_type', 'specific');
            $this->db->where('agent_no', 'all');
            $this->db->where('service_type', 1);
            $this->db->where('api_name', $api);
            $this->db->where('status', 1);
            $this->db->limit('1');
            $query3 = $this->db->get();
            if ($query3->num_rows > 0) {
                $res3 = $query3->row();
                $agent_markup_val = $res3->markup;
            } else {
                $this->db->select('markup');
                $this->db->from('admin_distributor_markup_info');
                $this->db->where('markup_type', 'generic');
                $this->db->where('agent_no', $agent_no);
                $this->db->where('service_type', 1);
                $this->db->where('api_name', $api);
                $this->db->where('status', 1);
                $this->db->limit('1');
                $query2 = $this->db->get();
                if ($query2->num_rows > 0) {
                    $res2 = $query2->row();
                    $agent_markup_val = $res2->markup;
                } else {
                    $this->db->select('markup');
                    $this->db->from('admin_distributor_markup_info');
                    $this->db->where('markup_type', 'generic');
                    $this->db->where('agent_no', 'all');
                    $this->db->where('service_type', 1);
                    $this->db->where('api_name', $api);
                    $this->db->where('status', 1);
                    $this->db->limit('1');
                    $query4 = $this->db->get();
                    if ($query4->num_rows > 0) {
                        $res4 = $query4->row();
                        $agent_markup_val = $res4->markup;
                    } else {
                        $agent_markup_val = 0;
                    }
                }
            }
        }
        return $agent_markup_val;
    }
    
     function get_admin_agent_markup($agent_no,$nationality,$api) {
           $this->db->select('name');
        $this->db->from('country');
        $this->db->where('iso2', $nationality);
        $this->db->limit('1');
        $query = $this->db->get();
        $res = $query->row();
        $country = $res->name;
         
         
         
        $this->db->select('markup,markup_process');
        $this->db->from('b2b_markup_info');
        $this->db->where('markup_type', 'specific');
        $this->db->where('agent_no', $agent_no);
         $this->db->where('country', $country);
        $this->db->where('service_type', 1);
        $this->db->where('api_name', $api);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query1 = $this->db->get();
        if ($query1->num_rows > 0) {
            $res1 = $query1->row();
            $agent_markup_val = $res1->markup;
            $admin_markup_process = $res1->markup_process;
        } else {
            $this->db->select('markup,markup_process');
            $this->db->from('b2b_markup_info');
            $this->db->where('markup_type', 'specific');
            $this->db->where('agent_no', 'all');
             $this->db->where('country', $country);
            $this->db->where('service_type', 1);
            $this->db->where('api_name', $api);
            $this->db->where('status', 1);
            $this->db->limit('1');
            $query3 = $this->db->get();
            if ($query3->num_rows > 0) {
                $res3 = $query3->row();
                $agent_markup_val = $res3->markup;
                $admin_markup_process = $res3->markup_process;
            } else {
                $this->db->select('markup,markup_process');
                $this->db->from('b2b_markup_info');
                $this->db->where('markup_type', 'generic');
                $this->db->where('agent_no', $agent_no);
                $this->db->where('service_type', 1);
                $this->db->where('api_name', $api);
                $this->db->where('status', 1);
                $this->db->limit('1');
                $query2 = $this->db->get();
                if ($query2->num_rows > 0) {
                    $res2 = $query2->row();
                    $agent_markup_val = $res2->markup;
                     $admin_markup_process = $res2->markup_process;
                } else {
                    $this->db->select('markup,markup_process');
                    $this->db->from('b2b_markup_info');
                    $this->db->where('markup_type', 'generic');
                    $this->db->where('agent_no', 'all');
                    $this->db->where('service_type', 1);
                    $this->db->where('api_name', $api);
                    $this->db->where('status', 1);
                    $this->db->limit('1');
                    $query4 = $this->db->get();
                    if ($query4->num_rows > 0) {
                        $res4 = $query4->row();
                        $agent_markup_val = $res4->markup;
                        $admin_markup_process = $res4->markup_process;
                    } else {
                        $agent_markup_val = 0;
                    }
                }
            }
        }
        //return $agent_markup_val;
        return array($agent_markup_val,$admin_markup_process);
    }
    
   function get_agent_markup($agent_no) {
        $this->db->select('markup,markup_process');
        $this->db->from('agent_markup_manager');
        $this->db->where('agent_no', $agent_no);
        $this->db->where('service_type', 1);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $res = $query->row();
            $agent_markup = $res->markup;
            $markupprocess = $res->markup_process;
        } else {
            $agent_markup = 0;
        }
        // return $agent_markup;
         return array($agent_markup,$markupprocess);
    }
     function get_sub_agent_markup($agent_no) {
        $this->db->select('markup');
        $this->db->from('b2b2b_markup_manager');
        $this->db->where('agent_no', $agent_no);
        $this->db->where('service_type', 1);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $res = $query->row();
            $agent_markup = $res->markup;
        } else {
            $agent_markup = 0;
        }
        return $agent_markup;
    }
    
     function get_distributor_markup($agent_no) {
        $this->db->select('markup');
        $this->db->from('distributor_markup_manager');
        $this->db->where('agent_no', $agent_no);
        $this->db->where('service_type', 1);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $res = $query->row();
            $agent_markup = $res->markup;
        } else {
            $agent_markup = 0;
        }
        return $agent_markup;
    }
      
        
}

?>