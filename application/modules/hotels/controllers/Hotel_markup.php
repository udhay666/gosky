<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Hotel_markup extends MX_Controller {
	private $adminMarkup;
	private $agentMarkup;
	private $sub_agent_Markup;
	private $Di_Markup;
	private $paymentCharge;
	private $country;
	private $markupProcess;

	function __construct() {
		parent::__construct();
		$this->load->model('Markup_Model');
		$this->sess_id = $this->session->userdata('session_id');
		$this->nationality = 'IN';
	}

	public function setup_customer_markup($nationality,$api) {
		//print_r($api);exit;
		list($admin_markup, $markup_process) = $this->Markup_Model->get_admin_markup($nationality,$api);
		// echo $this->db->last_query();
		// print_r($markup_process);exit;
		//payment charge
		// $session_data = $this->session->userdata('hotel_search_data');
		// $this->db->select('*')->from('ace_jac_roomsxml_gta_city')->where('id', $session_data["cityCode"]);
		// $query = $this->db->get();
		// $city_code = $query->row();
		// $country=trim($city_code->country_name);
		// $payment_charge = $this->Markup_Model->get_payment_charge();
		$this->adminMarkup = $admin_markup;
		$this->markupProcess=$markup_process;
		$this->agentMarkup = 0;
		$this->paymentCharge=0;
		// print_r($this->paymentCharge);exit;
		//$this->paymentCharge = $payment_charge;
	}

	public function set_admin_agent_markup($agent_no, $nationality,$api) {
		list($admin_markup, $markup_process) = $this->Markup_Model->get_admin_agent_markup($agent_no,$nationality,$api);
		list($agent_markup, $agentmarkup_process) = $this->Markup_Model->get_agent_markup($agent_no);
		$this->paymentCharge=0;
		$this->adminMarkup = $admin_markup;
		$this->agentMarkup = $agent_markup;
		$this->markupProcess=$markup_process;
		$this->agentmarkupProcess=$agentmarkup_process;
	}

	public function set_agent_markup($agent_no) {
		$agent_markup = $this->Markup_Model->get_agent_markup($agent_no);
		$this->agentMarkup = $agent_markup;
	}

	public function markup_calculation($totalPrice,$nationality,$api) {
		// $this->setup_markup();
		// print_r($totalPrice);exit;
		$convertedprice1 = $totalPrice;
		if ($this->session->has_userdata('agent_logged_in')) {
			$this->set_admin_agent_markup($this->session->agent_no, $nationality,$api);
			if ($this->markupProcess == 2) {
				$admin_markup = $this->adminMarkup;
			} else {
				$admin_markup = round(($convertedprice1 * ($this->adminMarkup / 100)), 2);
			}
			if($this->agentmarkupProcess == 2){
				$agent_markup = $this->agentMarkup;
			}else{
				$agent_markup = round((($convertedprice1 + $admin_markup) * ($this->agentMarkup / 100)), 2);
			}
			$payment_charge = round((($convertedprice1 + $admin_markup) * ($this->paymentCharge / 100)), 2);
			$total_cost = $admin_markup + $agent_markup + $convertedprice1;
		} else {
			// calculating b2c markup
			$this->setup_customer_markup($nationality,$api);
			if ($this->markupProcess == 2) {
				// echo 1;exit;
				$admin_markup = $this->adminMarkup;
			} else {
				// echo 2;exit;
				// echo $this->adminMarkup;exit;
				$admin_markup = round(($convertedprice1 * ($this->adminMarkup / 100)), 2);
			}
			// print_r($admin_markup);exit;
			$payment_charge = round((($convertedprice1 + $admin_markup) * ($this->paymentCharge / 100)), 2);
			$agent_markup = 0;
			// calculating price
			// $total_cost = $admin_markup + $payment_charge + $convertedprice1;
			$total_cost = $admin_markup + $convertedprice1;
		}
		if ($this->session->has_userdata('agent_logged_in')) {
			$markup_info = array(
				'admin_markup' => $admin_markup,
				'payment_charge' => $payment_charge,
				'agent_markup' =>$agent_markup,
				'total_cost' => round($total_cost),
			);
		} else {
			$markup_info = array(
				'admin_markup' => $admin_markup,
				'payment_charge' => $payment_charge,
				'agent_markup' =>0,
				'total_cost' => round($total_cost)
			);
		}
		// print_r($markup_info);exit;
		return $markup_info;
	}
}