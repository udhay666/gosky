<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Flight_markup extends MX_Controller {
    /*     * ***** START SET CREDENTIAL ********* */


    /*     * ***** START SET CREDENTIAL ********* */
    /*     * ***** START SET VARIABLES ********* */

    private $adminMarkup;
    private $agentMarkup;

    private $paymentCharge;
    private $Logger;
    private $country;
    private $markupProcess;

    /*     * ***** END SET VARIABLES ********* */

    function __construct() {
        parent::__construct();
        $this->load->model('Markup_Model');
        $this->sess_id = $this->session->session_id;
       
    }

    //markup function



    public function setup_customer_markup($nationality, $api) {
        //print_r($api);exit;
        list($admin_markup, $markup_process) = $this->Markup_Model->get_admin_markup($nationality, $api);
        // echo $this->db->last_query();
        // print_r($admin_markup);exit;
        $payment_charge = $this->Markup_Model->get_payment_charge();
        $this->adminMarkup = $admin_markup;
        $this->markupProcess = $markup_process;
        $this->agentMarkup = 0;
        $this->paymentCharge = $payment_charge;
    }

    public function set_admin_agent_markup($agent_no, $nationality, $api) {

//          $admin_markup = $this->Markup_Model->get_admin_agent_markup($agent_no, $nationality,$api);
        list($admin_markup, $markup_process) = $this->Markup_Model->get_admin_agent_markup($agent_no, $nationality, $api);

        list($agent_markup, $agent_markup_process) = $this->Markup_Model->get_agent_markup($agent_no);

        $this->adminMarkup = $admin_markup;
        $this->agentMarkup = $agent_markup;
        $this->markupProcess = $markup_process;
        $this->agent_markupProcess = $agent_markup_process;
        $this->paymentCharge = 0;
    }

    public function set_agent_markup($agent_no) {
        $agent_markup = $this->Markup_Model->get_agent_markup($agent_no);
        $this->agentMarkup6 = $agent_markup;
        $this->markupProcess6 = $markup_process;
    }



    public function markup_calculation($totalPrice, $nationality, $api) {
 // echo '<pre>';print_r($totalPrice);exit;
//          $this->setup_markup();
        $convertedprice1 = $totalPrice;

        if ($this->session->has_userdata('agent_logged_in')) {

            $this->set_admin_agent_markup($this->session->agent_no, $nationality, $api);
            if ($this->markupProcess == 2) {
                $admin_markup = $this->adminMarkup;
            } else {
                $admin_markup = round(($convertedprice1 * ($this->adminMarkup / 100)), 2);
            }
//              if ($this->agent_markup_process == 2) {
//                  $agent_discount = $this->agent_discount;
//                  } else {
//                  $agent_discount = ($convertedprice1 * ($this->agent_discount / 100));
//              }

            if($this->agent_markupProcess == 2){
                $agent_markup = $this->agentMarkup;
            }else{
                $agent_markup = round((($convertedprice1 + $admin_markup) * ($this->agentMarkup / 100)), 2);
            }
            
            $payment_charge = 0;
            $total_cost = $admin_markup + $agent_markup + $convertedprice1;
        } else {
            //calculating b2c markup
            $this->setup_customer_markup($nationality, $api);
            if ($this->markupProcess == 2) {
                $admin_markup = $this->adminMarkup;
            } else {
                //  echo $this->adminMarkup;exit;
                $admin_markup = round(($convertedprice1 * ($this->adminMarkup / 100)), 2);
            }
            //print_r($admin_markup);exit
            $payment_charge = round((($convertedprice1 + $admin_markup) * ($this->paymentCharge / 100)), 2);
            $agent_markup = 0;

            // calculating price
            $total_cost = $admin_markup + $payment_charge + $convertedprice1;
        }
        //discount calculation
     
        $final_tot=$total_cost;
         

        if ($this->session->userdata('agent_logged_in')) {
            $markup_info = array(
                'admin_markup' => $admin_markup,
                'payment_charge' => 0,
                'agent_markup' => $agent_markup,
                'total_cost' => $final_tot
                );
        } else {

            $markup_info = array(
                'admin_markup' => $admin_markup,
                'payment_charge' => $payment_charge,
                'agent_markup' => 0,
                'total_cost' => $final_tot
                );
        }
        // echo '<pre>';print_r($markup_info);exit;
        return $markup_info;
    }

    

}

