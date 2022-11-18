<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_Model extends CI_Model {

	public function __construct()
    {
      parent::__construct();

    }

    public function validate_credentials($loginEmailId, $loginPassword) {
        $this->db->select('*');
        $this->db->from('admin_info a');
        $this->db->join('admin_groups b', 'a.admin_group = b.admin_grp_id', 'left');
        $this->db->where("(login_email = '$loginEmailId')");
        $this->db->where('login_password', md5($loginPassword));
        $this->db->where('status', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {

            return $query->row();
        } else {
        	return false;
        }

        
    }

   public function insert_login_activity()
   {
	   $admin_id = $this->session->userdata('admin_id');
	   $session_id = time();
	   $ip_address = $_SERVER['REMOTE_ADDR'];
	   $user_agent = time();
	   $remote_ip = $_SERVER['REMOTE_ADDR'];

	   $data = array('session_id' => $session_id,
	   				 'admin_id' => $admin_id,
					 'ip_address' => $ip_address,
					 'remote_ip' => $remote_ip,
					 'user_agent' => $user_agent
					 );


	   if($this->db->insert('admin_login_history', $data))
	   {
		  return true;
	   }
	   else
	   {
		  return false;
	   }

	}

	public function get_admin_info($admin_id)
    {
		$this->db->select('*');
		$this->db->from('admin_info');
		$this->db->where('admin_id', $admin_id);
		$this->db->where('status', 1);
		$this->db->limit(1);
		$query = $this->db->get();

	  if ($query->num_rows() > 0)
	  {
		
		 return $query->row();
	  }
	  
	  return false;

    }

     public function get_admin_act_summary() {
        $admin_id = $this->session->userdata('admin_id');
        $this->db->select('a.*,b.admin_grp_name')
                ->from('admin_distributor_acc_summary a')
                ->join('admin_groups b', 'b.admin_grp_id = a.admin_group')
                ->where('a.admin_id', $admin_id)
                ->order_by('acc_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }
	public function update_admin_profile($login_email, $title, $first_name, $middle_name, $last_name, $mobile_no, $address, $pin_code, $city, $state)
	{

		$data = array(
			'login_email' => $login_email,
			'title' => $title,
			'first_name' => $first_name,
			'middle_name' => $middle_name,
			'last_name' => $last_name,
			'mobile_no' => $mobile_no,
			'address' => $address,
			'pin_code' => $pin_code,
			'city' => $city,
			'state' => $state
			);

		$admin_id = $this->session->userdata('admin_id');
		$where = "admin_id = '$admin_id'";

		if($this->db->update('admin_info', $data, $where)){
			return true;
		}else{
			return false;
		}

	}

	public function update_admin_password($admin_id,$password='')
	{
		if(!empty($password))
		{
			$data['login_password'] = $password;
			$where = "admin_id = '$admin_id'";
			if($this->db->update('admin_info', $data, $where))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}

	}

	public function get_country_list()
   	{
		$this->db->select('*')
				->from('country');
		$query = $this->db->get();

      	if($query->num_rows() > 0 )
		{
         	return $query->result();
      	}

      	return false;
   }

   public function get_currency_list()
   	{
		$this->db->select('*')
				->from('currency');
		$query = $this->db->get();

      	if($query->num_rows() > 0 )
		{
         	return $query->result();
      	}

      	return false;
   }

   public function manage_currency_status($currency_id,$status)
   {
		$data['status'] = $status;
		$where = "currency_id = '$currency_id'";
		if($this->db->update('currency', $data, $where))
		{
			return true;
		}
		else
		{
			return false;
		}

   }

   public function update_currency_values($currency_id,$currency_val)
   {
		$data['value'] = $currency_val;
		$where = "currency_id = '$currency_id'";
		$this->db->set('updated_datetime', 'Now()', FALSE);
		if($this->db->update('currency', $data, $where))
		{
			return true;
		}
		else
		{
			return false;
		}

   }

   public function get_hotel_apis()
   {
		$this->db->select('*')
				->from('api_info')
				->where('service_type',1);
		$query = $this->db->get();

      	if($query->num_rows() > 0 )
		{
         	return $query->result();

      	}

      	return false;
   }

   public function get_flight_apis()
   {
		$this->db->select('*')
				->from('api_info')
				->where('service_type',2);
		$query = $this->db->get();

      	if($query->num_rows() > 0 )
		{
         	return $query->result();
      	}

      	return false;
   }

   public function get_car_apis()
   {
		$this->db->select('*')
				->from('api_info')
				->where('service_type',4);
		$query = $this->db->get();

      	if($query->num_rows() > 0 )
		{
         	return $query->result();
      	}

      	return false;
   }
    public function get_bus_apis()
   {
		$this->db->select('*')
				->from('api_info')
				->where('service_type',5);
		$query = $this->db->get();

      	if($query->num_rows() > 0 )
		{
         	return $query->result();
      	}

      	return false;
   }
    public function get_apartment_apis()
   {
		$this->db->select('*')
				->from('api_info')
				->where('service_type',3);
		$query = $this->db->get();

      	if($query->num_rows() > 0 )
		{
         	return $query->result();
      	}

      	return false;
   }

   public function manage_api_status($api_id,$status)
   {
		$data['status'] = $status;
		//$where = "api_id = '$api_id'";
		$where = "api_id = '$api_id'";
		//print $this->db->update('api_info', $data, $where));exit;
		if($this->db->update('api_info', $data, $where))
		{
			return true;
		}
		else
		{
			return false;
		}

   }

   public function get_payment_gateway_charges()
   {
		$this->db->select('*')
				->from('payment_gateway');
		$query = $this->db->get();

      	if($query->num_rows() > 0 )
		{
         	return $query->result();
      	}

      	return false;
   }

   public function manage_payment_charge_status($id,$status)
   {
		$data['status'] = $status;
		$where = "id = '$id'";
		if($this->db->update('payment_gateway', $data, $where))
		{
			return true;
		}
		else
		{
			return false;
		}

   }

   public function get_payment_charge($id)
   {
		$this->db->select('*')
				 ->from('payment_gateway')
				 ->where('id', $id);
		$query = $this->db->get();

	  if ($query->num_rows() > 0)
	  {
		 return $query->row();

	  }
	  return false;

   }

   public function update_payment_charge($id,$charge)
   {
		$data['charge'] = $charge;
		$where = "id = '$id'";
		if($this->db->update('payment_gateway', $data, $where))
		{
			return true;
		}
		else
		{
			return false;
		}

   }

   public function get_api_list($id='')
   { // print_r($type);
	   $this->db->select('*');
          $this->db->from('api_info');
          //$this->db->where('service_type',$id);
          $query=$this->db->get();
		  //echo $this->db->last_query();exit;
          return $query->result();
   }

   //cancellation markup process

   function delete_canc_markup($markup_type,$service_type)
	{
		$where = "markup_type = '$markup_type' AND service_type = '$service_type'";
		if ($this->db->delete('cancellation_markup_info', $where))
		{
			return true;
		}
		else
		{
			return false;
		}

	}

		function can_markup_checking($country, $api_name, $markup_type, $service_type)
	{
		$this->db->select('*');
		$this->db->from('cancellation_markup_info');
		$this->db->where('country',$country);
		$this->db->where('api_name',$api_name);
		$this->db->where('markup_type',$markup_type);
		$this->db->where('service_type',$service_type);

		$query = $this->db->get();

		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
			return $query->row();
		}

	}

	function update_id_canc_markup($country, $api_name, $markup_type, $service_type)
	{
		$where = "country = '$country' AND api_name = '$api_name' AND markup_type = '$markup_type' AND service_type = '$service_type'";
		if($this->db->update('cancellation_markup_info', $where))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

		function add_canc_markup($country, $api_name,$markup_process, $markup, $markup_type, $service_type)
	{
	//print_r($data);exit;
		$data = array(
			'country' => $country,
			'api_name' => $api_name,
            'markup_process' => $markup_process,
			'markup' => $markup,
			'markup_type' => $markup_type,
			'service_type' => $service_type,
			'status' => 1
			);

		//$this->db->set('register_date', 'NOW()', FALSE);
		$this->db->insert('cancellation_markup_info', $data);
		$id = $this->db->insert_id();
		if(!empty($id))
		{
			return true;
		}
		else
		{
			return false;
		}

	}


	    public function get_canc_markup_list()
   	{
		$this->db->select('*')
				->from('cancellation_markup_info')
				->where('service_type',1);
		$query = $this->db->get();

      	if($query->num_rows() > 0 )
		{
         	return $query->result();
      	}

      	return false;
   }
	    public function get_canc_markup_list_apartment()
   	{
		$this->db->select('*')
				->from('cancellation_markup_info')
				->where('service_type',5);
		$query = $this->db->get();

      	if($query->num_rows() > 0 )
		{
         	return $query->result();
      	}

      	return false;
   }

	    public function get_canc_markup_list_flights()
   	{
		$this->db->select('*')
				->from('cancellation_markup_info')
				->where('service_type',5);
		$query = $this->db->get();

      	if($query->num_rows() > 0 )
		{
         	return $query->result();
      	}

      	return false;
   }

      public function get_canc_markup_list_bus()
   	{
		$this->db->select('*')
				->from('cancellation_markup_info')
				->where('service_type',4);
		$query = $this->db->get();

      	if($query->num_rows() > 0 )
		{
         	return $query->result();
      	}

      	return false;
   }


   public function canc_markup_checking($country, $api_name, $markup_type, $service_type){
   $this->db->select('*')
	->from('cancellation_markup_info')
	->where('country',$country)
   ->where('api_name',$api_name)
   ->where('markup_type',$markup_type)
   ->where('service_type',$service_type);
   $query=$this->db->get();
  // echo $this->db->last_query();
   if($query->num_rows() > 0){
   return $query->result;
   }else{
   return false;

   }
   }


	function delete_id_canc_markup($country, $api_name, $markup_type, $service_type)
	{
		$where = "country = '$country' AND api_name = '$api_name' AND markup_type = '$markup_type' AND service_type = '$service_type'";
		if($this->db->delete('cancellation_markup_info', $where))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function manage_canc_markup_status($markup_id,$status)
   {
		$data['status'] = $status;
		$where = "markup_id = '$markup_id'";
		if($this->db->update('cancellation_markup_info', $data, $where))
		{
			return true;
		}
		else
		{
			return false;
		}

   }
   function delete_canc_markup_status($markup_id)
	{
		$where = "markup_id = '$markup_id'";
		if ($this->db->delete('cancellation_markup_info', $where))
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	//
   public function get_api_list_by_service($service_type)
   {
		$this->db->select('*');
		$this->db->from('api_info');
		$this->db->where('service_type',$service_type);
		$this->db->where('status',1);
		$query = $this->db->get();

		//echo $this->db->last_query();
      	if($query->num_rows() > 0 )
		{
         	return $query->result();
      	}

		

      	return false;
   }

   public function get_promotion_list()
   {
		$this->db->select('*')
				->from('promotion_manager')
				->order_by('promo_id','DESC');
		$query = $this->db->get();

      	if($query->num_rows() > 0 )
		{
         	return $query->result();
      	}

      	return false;
   }

   public function add_promotion($service_type,$promo_name,$promo_code,$discount_type,$discount,$promo_expire)
   {
	   // $valid_upto = date('Y-m-d',strtotime($promo_expire));

	   	$data = array(
		'service_type' => $service_type,
		'promo_name' => $promo_name,
		'promo_code' => $promo_code,
		'discount_type' => $discount_type,
		'discount' => $discount,
		'promo_expire' => $promo_expire,
		'status' => 1,
		);

		$this->db->set('created_datetime', 'NOW()', FALSE);

		$this->db->insert('promotion_manager', $data);
		$id = $this->db->insert_id();
		if(!empty($id))
		{
			return true;
		}
		else
		{
			return false;
		}

   }
   ///promotional emails
   	public function get_emails(){
	$this->db->select('user_email')
			 ->from('user_info');
			 $query=$this->db->get();

	if($query->num_rows() > 0 ){
	return $query->result_array();
	}else{
	return '';
	}

	}

   public function manage_promotion_status($promo_id,$status)
   {
		$data['status'] = $status;
		$where = "promo_id = '$promo_id'";
		if($this->db->update('promotion_manager', $data, $where))
		{
			return true;
		}
		else
		{
			return false;
		}

   }

   public function get_promotion_by_promo_id($promo_id)
   {
		$this->db->select('*')
				->from('promotion_manager')
				->where('promo_id',$promo_id)
				->limit('1');
		$query = $this->db->get();

      	if($query->num_rows() > 0 )
		{
         	$res = $query->result();
			return $res[0];
      	}

      	return false;
   }

   public function update_promotion($promo_id,$ser_type,$promo_name,$discount_type,$discount,$promo_expire)
   {
	   //$valid_upto = date('Y-m-d',strtotime($promo_expire));

		$data = array(
		'service_type' => $ser_type,
		'promo_name' => $promo_name,		
		'discount_type' => $discount_type,
		'discount' => $discount,
		'promo_expire' => $promo_expire,
		);

		$where = "promo_id = '$promo_id'";
		$this->db->set('created_datetime', 'NOW()', FALSE);
		if($this->db->update('promotion_manager', $data, $where))
		{
			return true;
		}
		else
		{
			return false;
		}

   }
    public function get_hotel_logs() {

        $this->db->select('*')
                ->from('hotels_api_logs')
                ->order_by('log_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
	public function get_flight_logs() {

        $this->db->select('*')
                ->from('flights_api_logs')
                ->order_by('log_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
		{
            return $query->result();
        }
		return false;
	}
	public function get_bus_logs() {

        $this->db->select('*')
                ->from('bus_api_logs')
                ->order_by('log_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
		{
            return $query->result();
        }
		return false;
	}
     public function get_bus_logs_by_id($id) {
        $this->db->select('*')
                ->from('bus_api_logs')
                ->where('log_id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
     public function get_hotel_logs_by_id($id) {
        $this->db->select('*')
                ->from('hotels_api_logs_ez')
                ->where('log_id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
      public function delete_logs($id){
        $this->db->where('log_id',$id);
        $this->db->delete('hotels_api_logs_ez');
    }
	public function get_dot_hotel_logs() {

        $this->db->select('*')
                ->from('hotels_api_logs_dotw')
                ->order_by('log_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function delete_logs_dot($id){
        $this->db->where('log_id',$id);
        $this->db->delete('hotels_api_logs_dotw');
    }

	public function get_hp_hotel_logs() {

        $this->db->select('*')
                ->from('hotels_api_logs_hp')
                ->order_by('log_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function delete_logs_hp($id){
        $this->db->where('log_id',$id);
        $this->db->delete('hotels_api_logs_hp');
    }
	public function get_roomsxml_hotel_logs() {

        $this->db->select('*')
                ->from('hotels_api_logs_rx')
                ->order_by('log_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function get_rooms_xml_hotel_logs($id) {

        $this->db->select('*')
                ->from('hotels_api_logs_rx')
                ->where('log_id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
     public function delete_logs_roomsxml($id){
        $this->db->where('log_id',$id);
        $this->db->delete('hotels_api_logs_rx');
    }
    public function get_travelguru_hotel_logs() {

        $this->db->select('*')
                ->from('hotels_api_logs_tr')
                ->order_by('log_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function get_ezeego_hotel_logs() {

        $this->db->select('*')
                ->from('hotels_api_logs_ez')
                ->order_by('log_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
     public function delete_logs_travelguru($id){
        $this->db->where('log_id',$id);
        $this->db->delete('hotels_api_logs_tr');
    }



    public function flightcount($fetchcre){
	if($_GET['b2cuser'] != '' || $_GET['b2buser'] != ''){$fetchcre['b2c']=0;$fetchcre['b2c']=0;}
		$this->db->select('SUM(Admin_Markup) as admark,SUM(Payment_Charge) as pay,SUM(TotalFare) as total,COUNT(TotalFare) as coun');
		$this->db->from('flight_booking_reports');
		$this->db->where('Booking_Date >=', $fetchcre['startdate']);
		$this->db->where('Booking_Date <=', $fetchcre['enddate']);
		if($fetchcre['b2c']==1 && $fetchcre['b2b']==2){
		}else{
		if($fetchcre['b2c']==1){$this->db->where('agent_id', 0);}
		if($fetchcre['b2b']==2){$this->db->where('agent_id !=', 0);}
		}
		if($fetchcre['b2cuser']!=''){$this->db->where('user_id', $fetchcre['b2cuser']);}
		if($fetchcre['b2buser']!=''){$this->db->where('agent_id', $fetchcre['b2buser']);}
		$query=$this->db->get();
		if($query->num_rows()>0){
		$result=$query->row();
		return array($result->admark, $result->pay, $result->total,$result->coun);
		}else{
		return array(0, 0, 0,0);
		}
	}
	public function hotelcount($fetchcre){
	if($_GET['b2cuser'] != '' || $_GET['b2buser'] != ''){$fetchcre['b2c']=0;$fetchcre['b2c']=0;}
		$this->db->select('SUM(Admin_Markup) as admark,SUM(Payment_Charge) as pay,SUM(Booking_Amount) as total,COUNT(Booking_Amount) as coun');
		$this->db->from('hotel_booking_reports');
		$this->db->where('Booking_Date >=', $fetchcre['startdate']);
		$this->db->where('Booking_Date <=', $fetchcre['enddate']);
		if($fetchcre['b2c']==1 && $fetchcre['b2b']==2){
		}else{
		if($fetchcre['b2c']==1){$this->db->where('agent_id', 0);}
		if($fetchcre['b2b']==2){$this->db->where('agent_id !=', 0);}
		}
		if($fetchcre['b2cuser']!=''){$this->db->where('user_id', $fetchcre['b2cuser']);}
		if($fetchcre['b2buser']!=''){$this->db->where('agent_id', $fetchcre['b2buser']);}
		$query=$this->db->get();
		if($query->num_rows()>0){
		$result=$query->row();
		return array($result->admark, $result->pay, $result->total,$result->coun);
		}else{
		return array(0, 0, 0,0);
		}
	}
	public function buscount($fetchcre){
	if($_GET['b2cuser'] != '' || $_GET['b2buser'] != ''){$fetchcre['b2c']=0;$fetchcre['b2c']=0;}
		$this->db->select('SUM(admin_markup) as admark,SUM(payment_charge) as pay,SUM(total_fare) as total,COUNT(total_fare) as coun');
		$this->db->from('bus_booking_reports');
		$this->db->where('booking_date >=', $fetchcre['startdate']);
		$this->db->where('booking_date <=', $fetchcre['enddate']);
		if($fetchcre['b2c']==1 && $fetchcre['b2b']==2){
		}else{
		if($fetchcre['b2c']==1){$this->db->where('agent_id', 0);}
		if($fetchcre['b2b']==2){$this->db->where('agent_id !=', 0);}
		}
		if($fetchcre['b2cuser']!=''){$this->db->where('user_id', $fetchcre['b2cuser']);}
		if($fetchcre['b2buser']!=''){$this->db->where('agent_id', $fetchcre['b2buser']);}
		$query=$this->db->get();
		if($query->num_rows()>0){
		$result=$query->row();
		return array($result->admark, $result->pay, $result->total,$result->coun);
		}else{
		return array(0, 0, 0,0);
		}
	}
		public function carcount($fetchcre){
		if($_GET['b2cuser'] != '' || $_GET['b2buser'] != ''){$fetchcre['b2c']=0;$fetchcre['b2c']=0;}
		$this->db->select('SUM(total_amount) as total,COUNT(total_amount) as coun');
		$this->db->from('car_booking_reports');
		$this->db->where('Booking_Date >=', $fetchcre['startdate']);
		$this->db->where('Booking_Date <=', $fetchcre['enddate']);
		if($fetchcre['b2c']==1 && $fetchcre['b2b']==2){
		}else{
		if($fetchcre['b2c']==1){$this->db->where('agent_id', 0);}
		if($fetchcre['b2b']==2){$this->db->where('agent_id !=', 0);}
		}
		if($fetchcre['b2cuser']!=''){$this->db->where('user_id', $fetchcre['b2cuser']);}
		if($fetchcre['b2buser']!=''){$this->db->where('agent_id', $fetchcre['b2buser']);}
		$query=$this->db->get();
		if($query->num_rows()>0){
		$result=$query->row();
		return array(0,0, $result->total,$result->coun);
		}else{
		return array(0, 0, 0,0);
		}
	}


	   public function get_user_info_by_id($user_id)
   	{
		$this->db->select('*')
				->from('user_info')
				->where('user_no',$user_id)
				->limit('1');
		$query = $this->db->get();

		  if($query->num_rows() > 0)
		  {
			 $res = $query->result();
			 //return $res[0];
			 return $res[0]->user_id;
		  }

		  return false;

  	}

	   public function get_agent_info_by_id($user_id)
   	{
		$this->db->select('*')
				->from('agent_info')
				->where('agent_no',$user_id)
				->limit('1');
		$query = $this->db->get();

		  if($query->num_rows() > 0)
		  {
			 $res = $query->result();
			 //return $res[0];
			 return $res[0]->agent_id;
		  }

		  return false;

  	}

	function current_url1()
{
    $CI =& get_instance();

   $url = $CI->config->site_url($CI->uri->uri_string()).'/1';
    return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
}



	function dd_ex($query)
    {
      //  $query = $this->db->get('holiday_pac_req');
 //echo '<pre>';print_r($query);exit;
        if(!$query)
            return false;

        // Starting the PHPExcel library
        $this->load->library('Excel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

        $objPHPExcel->setActiveSheetIndex(0);

        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }

        // Fetching the table data
        $row = 2;
        foreach($query->result() as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }

            $row++;
        }

        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Products_'.date('dMy').'.xls"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');
    }

	public function get_holiday_pac_req_pass($from_date,$to_date){
		$this->db->select('*');
		$this->db->from('holiday_pac_req');
		if($from_date){
			$this->db->where('booking_date >=', $from_date);
				}
				if($to_date !=''){
				$this->db->where('booking_date <=', $to_date);
				}

	$query=$this->db->get();
	//echo $this->db->last_query();
	if($query->num_rows() > 0){
	return $query->result();
	}else{
	return '';
	}
}

	public function get_holiday_pac_req($from_date,$to_date){
		$this->db->select('*');
		$this->db->from('enq_holi_enq_request');
		if($from_date){
			$this->db->where('booking_date >=', $from_date);
				}
				if($to_date !=''){
				$this->db->where('booking_date <=', $to_date);
				}

	$query=$this->db->get();
	//echo $this->db->last_query();
	if($query->num_rows() > 0){
	return $query->result();
	}else{
	return '';
	}
}
	public function get_flights_pac_req($from_date,$to_date){
		$this->db->select('*');
		$this->db->from('flight_enq_request');
		if($from_date){
			$this->db->where('booking_date >=', $from_date);
				}
				if($to_date !=''){
				$this->db->where('booking_date <=', $to_date);
				}
	$query=$this->db->get();
	//echo $this->db->last_query();
	if($query->num_rows() > 0){
	return $query->result();
	}else{
	return '';
	}

}
	public function get_hotel_pac_req($from_date,$to_date){
		$this->db->select('*');
		$this->db->from('hotel_enq_request');
		if($from_date){
			$this->db->where('booking_date >=', $from_date);
				}
				if($to_date !=''){
				$this->db->where('booking_date <=', $to_date);
				}
	$query=$this->db->get();
	//echo $this->db->last_query();
	if($query->num_rows() > 0){
	return $query->result();
	}else{
	return '';
	}
	}
	public function get_bus_pac_req($from_date,$to_date){
		$this->db->select('*');
		$this->db->from('bus_enq_request');
		if($from_date){
			$this->db->where('booking_date >=', $from_date);
				}
				if($to_date !=''){
				$this->db->where('booking_date <=', $to_date);
				}
	$query=$this->db->get();
	//echo $this->db->last_query();
	if($query->num_rows() > 0){
	return $query->result();
	}else{
	return '';
	}
	}
		public function get_forex_pac_req($from_date,$to_date){
		$this->db->select('*');
		$this->db->from('forex_pac_req');
		if($from_date){
			$this->db->where('booking_date >=', $from_date);
				}
				if($to_date !=''){
				$this->db->where('booking_date <=', $to_date);
				}
	$query=$this->db->get();
	//echo $this->db->last_query();
	if($query->num_rows() > 0){
	return $query->result();
	}else{
	return '';
	}
	}
		public function get_cruis_pac_req($from_date,$to_date){
		$this->db->select('*');
		$this->db->from('cruise_pac_req');
		if($from_date){
			$this->db->where('booking_date >=', $from_date);
				}
				if($to_date !=''){
				$this->db->where('booking_date <=', $to_date);
				}
	$query=$this->db->get();
	//echo $this->db->last_query();
	if($query->num_rows() > 0){
	return $query->result();
	}else{
	return '';
	}
	}
		public function get_mice_pac_req($from_date,$to_date){
		$this->db->select('*');
		$this->db->from('mice_pac_req');
		if($from_date){
			$this->db->where('booking_date >=', $from_date);
				}
				if($to_date !=''){
				$this->db->where('booking_date <=', $to_date);
				}
	$query=$this->db->get();
	//echo $this->db->last_query();
	if($query->num_rows() > 0){
	return $query->result();
	}else{
	return '';
	}
	}
		public function get_train_pac_req($from_date,$to_date){
		$this->db->select('*');
		$this->db->from('train_pac_req');
		if($from_date){
			$this->db->where('booking_date >=', $from_date);
				}
				if($to_date !=''){
				$this->db->where('booking_date <=', $to_date);
				}
	$query=$this->db->get();
	//echo $this->db->last_query();
	if($query->num_rows() > 0){
	return $query->result();
	}else{
	return '';
	}
	}
		public function get_visa_pac_req($from_date,$to_date){
		$this->db->select('*');
		$this->db->from('visa_pac_req');
		if($from_date){
			$this->db->where('booking_date >=', $from_date);
				}
				if($to_date !=''){
				$this->db->where('booking_date <=', $to_date);
				}
	$query=$this->db->get();
	//echo $this->db->last_query();
	if($query->num_rows() > 0){
	return $query->result();
	}else{
	return '';
	}
	}

		public function get_ins_pac_req($from_date,$to_date){
		$this->db->select('*');
		$this->db->from('insurance_pac_req');
		if($from_date){
			$this->db->where('booking_date >=', $from_date);
				}
				if($to_date !=''){
				$this->db->where('booking_date <=', $to_date);
				}
	$query=$this->db->get();
	//echo $this->db->last_query();
	if($query->num_rows() > 0){
	return $query->result();
	}else{
	return '';
	}
	}

		public function get_corporate_pac_req($from_date,$to_date){
		$this->db->select('*');
		$this->db->from('corporate_pac_req');
		if($from_date){
			$this->db->where('booking_date >=', $from_date);
				}
				if($to_date !=''){
				$this->db->where('booking_date <=', $to_date);
				}
	$query=$this->db->get();
	//echo $this->db->last_query();
	if($query->num_rows() > 0){
	return $query->result();
	}else{
	return '';
	}
	}

		public function get_feeedback_pac_req(){
		$this->db->select('*');
		$this->db->from('feedback_pac_req');

	$query=$this->db->get();
	//echo $this->db->last_query();
	if($query->num_rows() > 0){
	return $query->result();
	}else{
	return '';
	}
	}


public function get_menu_desc($id){
$this->db->select('*')
				->from('menu_desc')
				->where('type',$id);
		$query = $this->db->get();
//echo $this->db->last_query();
      	if($query->num_rows() > 0 )
		{
         	return $query->result();

      	}

      	return false;


}
public function update_menu_desc($content,$id){
$data=array(
'content' => $content,
);
$this->db->where('type',$id);
$this->db->update('menu_desc',$data);

}
public function update_site_tax($type,$amount){

$data=array(
'tax_amount' => $amount,
);
$this->db->where('type',$type);
$this->db->update('site_tax',$data);
echo $this->db->last_query();exit;
}

public function get_all_tax(){
$this->db->select('*')
				->from('site_tax');
				//->where('type',$id);
		$query = $this->db->get();
//echo $this->db->last_query();
      	if($query->num_rows() > 0 )
		{
         	return $query->result();

      	}

      	return false;

}
public function get_admin_auth($id){

$this->db->select('*')
				->from('admin_privilege_users')
				->where('privilege_admin_id',$id);
		$query = $this->db->get();
//echo $this->db->last_query();
      	if($query->num_rows() > 0 )
		{
         	return $query->result();

      	}

      	return false;

}
 public function get_user_privileges_old($admin_id) {
        $this->db->select('*');
        $this->db->from('admin_privilege_users a ');
        $this->db->join('admin_privileges b', 'b.privilege_id = a.admin_privilege_id', 'left');
        $this->db->where('a.privilege_admin_id', $admin_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
  /*   public function get_user_privileges($admin_id) {
        $this->db->select('*');
        $this->db->from('sub_admin_permissions ');
       // $this->db->join('sub_admin_modules b', 'b.sub_admin_module_id = a.admin_privilege_id', 'left');
        $this->db->where('admin_id', $admin_id);
		//$this->db->group_by('admin_id');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    } */

     
public function get_pay_details($id){
$this->db->select('*')
				->from('pay_details')
				->where('uniqueRefNo',$id);
		$query = $this->db->get();
//echo $this->db->last_query();
      	if($query->num_rows() > 0 )
		{
         	return $query->result();

      	}

      	return false;

}
 public function get_group($id) {
        $query = $this->db->select('*')->from('admin_groups')->where('admin_grp_id', $id)->get();
        if ($query->num_rows() > 0) {
            $res = $query->row();
            return $res->admin_grp_name;
        } else {
            return '';
        }
    }
       public function get_admin_available_balance($admin_id) {

        $this->db->select('available_balance')
                ->from('admin_distributor_acc_summary')
                ->where('admin_id', $admin_id)
                ->order_by('transaction_datetime', 'DESC')
                ->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $res = $query->result();
            $balance = $res[0]->available_balance;
        } else {
            $balance = 0;
        }

        return $balance;
    }
    public function add_promo_group()
   {
       $this->db->select('*');
       $this->db->from('promotion_manager');
      $query= $this->db->get();
       return $query->result();
   }
   public function update_discount($pid,$dis_type,$dis)
        {
            $data=array('discount'=>$dis,'discount_type' => $dis_type);
            $this->db->where_in('promo_id',$pid);
            $this->db->update('promotion_manager',$data);
          //  echo $this->db->last_query();exit;
            return TRUE;
        }
		
	public function get_fac_info($id=''){
		
	$this->db->select('*');
	$this->db->from('hotel_facilities');
	if($id!=''){
		$this->db->where('id',$id);
	}
	$query=$this->db->get();
	//echo $this->db->last_query();exit;
	if ($query->num_rows() > 0){
		return $query->result();
	}else{
        return '';
	}
	
	}
	
	public function add_fac_info($data){
	$this->db->insert('hotel_facilities', $data);
	return true;
	}
	
	public function update_fac_info($data, $id){
		$this->db->where('id', $id);
        $this->db->update('hotel_facilities', $data);
	return true;
	}
	
	
	public function get_offer_info(){
	$this->db->select('*');
	$this->db->from('offer');
	$query=$this->db->get();
	//echo $this->db->last_query();exit;
	if ($query->num_rows() > 0){
		return $query->result();
	}else{
        return '';
	}
	
	}
	
	public function insert_offer($offer_name){
	
	$data=array(
	'offer_name'=>$offer_name,
	);
	
	$this->db->insert('offer',$data);
	
	//echo $this->db->last_query();exit;
	return $this->db->insert_id();
	}
	
	public function get_offer_id($id) {
        $this->db->select('*')
                ->from('offer')
                ->where('id', $id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        //echo $id;

        return false;
    }
	public function update_offer_img($id, $source_image) {

        $data = array(
            'offer_img' => $source_image,
        );

        $this->db->where('id', $id);
        $this->db->update('offer', $data);
    }
	public function status_change($id, $status) {

        $data = array(
            'status' => $status,
        );

        $this->db->where('id', $id);
        $this->db->update('offer', $data);
    }
     public function get_airport_list($exclude,$search)
	{
            $where = '';
            if( $exclude != '' )
                $where .= "airport_code != '".$exclude."' AND";

            $where .= "( airport_code LIKE '".$search."%')";

            $this->db->select('airport_code,airport_name,airport_city,airport_country');
            $this->db->from('airport_list');
            $this->db->where($where);
            $this->db->group_by('airport_code');
            $this->db->order_by('airport_code ASC');

            $query = $this->db->get();
//echo $query->num_rows();
            if($query->num_rows() =='')
            {
                
                $where = '';
                if( $exclude != '' )
                    $where .= "airport_city != '%".$exclude."' AND";

                $where .= "( airport_city LIKE '%".$search."%')";

                $this->db->select('airport_code,airport_name,airport_city,airport_country');
                $this->db->from('airport_list');
                $this->db->where($where);
                $this->db->group_by('airport_city');
                $this->db->order_by('airport_city ASC');

                $query = $this->db->get();

                return $query->result();
                   //echo $this->db->last_query();exit; 
            }
            else
            {
                return $query->result();
            }
	}
	public function get_user_privileges($admin_id) {
        $this->db->select('b.privilege_name,b.privilege_id');
        $this->db->from('admin_privilege_users a');
        $this->db->join('admin_privileges b', 'b.privilege_id = a.admin_privilege_id');
        $this->db->where('a.privilege_admin_id', $admin_id);
		//$this->db->group_by('admin_id');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

 public function get_user_submodule_privileges($admin_id,$privilege_id) {
        $this->db->select('b.submodule_privilege_name');
		$this->db->from('admin_submodule_privilege_users a');
        $this->db->join('admin_submodule_privileges b', 'b.submodule_privilege_id = a.submodule_admin_privilege_id');
        $this->db->where('a.submodule_privilege_admin_id', $admin_id);
        $this->db->where('b.privilege_id', $privilege_id);

		//$this->db->group_by('admin_id');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

//DashBoard Report

    public function gettodayAccountsummary()
{
    $today=date("Y-m-d", strtotime("now")); 
    $where = "(booking_status LIKE '%Success%')";  
   $this->db->select('SUM(package_amount) as net_total');
    $this->db->where('booking_datetime ="'.$today.'"');
    $this->db->from('holiday_booking_reports');
    // $this->db->where('user_id != ',0);
    $this->db->where($where);
    $query = $this->db->get(); 
     if($query->num_rows()>0){    
      return $query->row();
   }else{
      return NULL;
   }
}
public function getlastsevendaysAccountsummary()
{
    $today=date("Y-m-d", strtotime("now")); 
    $lastsevendays=date_create($today);
     $where = "(booking_status LIKE '%Success%')";       
     date_sub($lastsevendays,date_interval_create_from_date_string((7)." days"));
     $lastsevendate=date_format($lastsevendays,"Y-m-d");
   $this->db->select('SUM(package_amount) as net_total');
    $this->db->where('booking_datetime BETWEEN "'. $lastsevendate. '" and "'.$today.'"');
    $this->db->from('holiday_booking_reports');
    // $this->db->where('user_id != ',0);
    $this->db->where($where);
    $query = $this->db->get(); 
     if($query->num_rows()>0){    
      return $query->row();
   }else{
      return NULL;
   }
}
public function getlastthirtydaysAccountsummary()
{
   $today=date("Y-m-d", strtotime("now")); 
   $lastthirtydays=date_create($today);
     $where = "(booking_status LIKE '%Success%')";       
     date_sub($lastthirtydays,date_interval_create_from_date_string((30)." days"));
     $lastthirtydate=date_format($lastthirtydays,"Y-m-d");
   $this->db->select('SUM(package_amount) as net_total');
    $this->db->where('booking_datetime BETWEEN "'. $lastthirtydate. '" and "'.$today.'"');
    $this->db->from('holiday_booking_reports');
    // $this->db->where('user_id != ',0);
    $this->db->where($where);
    $query = $this->db->get(); 
     if($query->num_rows()>0){    
      return $query->row();
   }else{
      return NULL;
   }
}
public function getlastsixmonthsAccountsummary()
{
    $today=date("Y-m-d", strtotime("now"));
     $lastsixmonths=date_create($today);
     $where = "(booking_status LIKE '%Success%')";       
     date_sub($lastsixmonths,date_interval_create_from_date_string((6)." months"));
     $lastsixmonthsdate=date_format($lastsixmonths,"Y-m-d");
   $this->db->select('SUM(package_amount) as net_total');
    $this->db->where('booking_datetime BETWEEN "'. $lastsixmonthsdate. '" and "'.$today.'"');
    $this->db->from('holiday_booking_reports');
    // $this->db->where('user_id != ',0);
    $this->db->where($where);
    $query = $this->db->get(); 
     if($query->num_rows()>0){    
      return $query->row();
   }else{
      return NULL;
   }
}
public function getlastninetydaysAccountsummary()
{
   $today=date("Y-m-d", strtotime("now")); 
     $lastninetydays=date_create($today);
     $where = "(booking_status LIKE '%Success%')";       
     date_sub($lastninetydays,date_interval_create_from_date_string((90)." days"));
     $lastninetydate=date_format($lastninetydays,"Y-m-d");
   $this->db->select('SUM(package_amount) as net_total');
    $this->db->where('booking_datetime BETWEEN "'. $lastninetydate. '" and "'.$today.'"');
    $this->db->from('holiday_booking_reports');
    // $this->db->where('user_id != ',0);
    $this->db->where($where);
    $query = $this->db->get(); 
     if($query->num_rows()>0){    
      return $query->row();
   }else{
      return NULL;
   }
}
public function getlastoneyearAccountsummary()
{
     $today=date("Y-m-d", strtotime("now")); 
      $lastoneyear=date_create($today);
     $where = "(booking_status LIKE '%Success%')";       
     date_sub($lastoneyear,date_interval_create_from_date_string((1)." year"));
     $lastoneyeardate=date_format($lastoneyear,"Y-m-d");
   $this->db->select('SUM(package_amount) as net_total');
    $this->db->where('booking_datetime BETWEEN "'. $lastoneyeardate. '" and "'.$today.'"');
    $this->db->from('holiday_booking_reports');
    // $this->db->where('user_id != ',0);
    $this->db->where($where);
    $query = $this->db->get(); 
     if($query->num_rows()>0){    
      return $query->row();
   }else{
      return NULL;
   }
  
}
public function gettodaybooking()
{
     $today=date("Y-m-d", strtotime("now")); 
     $where = "(booking_status LIKE '%Success%')";    
     $this->db->select('*');
     $this->db->where('booking_datetime ="'.$today.'"');  
     $this->db->from('holiday_booking_reports');
     // $this->db->where('user_id != ',0);
     $this->db->where($where);
     $query = $this->db->get();
     if($query->num_rows()>0){    
      return $query->result();
   }else{
      return NULL;
   }
}

public function getlastsevendaysbooking()
{
     $today=date("Y-m-d", strtotime("now"));
     $lastsevendays=date_create($today);
     $where = "(booking_status LIKE '%Success%')";       
     date_sub($lastsevendays,date_interval_create_from_date_string((7)." days"));
     $lastsevendate=date_format($lastsevendays,"Y-m-d");
     $this->db->select('*');
     $this->db->where('booking_datetime BETWEEN "'. $lastsevendate. '" and "'.$today.'"');
     $this->db->from('holiday_booking_reports');
     // $this->db->where('user_id != ',0);
     $this->db->where($where);
     $query = $this->db->get();
     if($query->num_rows()>0){    
      return $query->result();
   }else{
      return NULL;
   } 

}
public function getlastthirtydaysbooking()
{
     $today=date("Y-m-d", strtotime("now"));
     $lastthirtydays=date_create($today);
     $where = "(booking_status LIKE '%Success%')";       
     date_sub($lastthirtydays,date_interval_create_from_date_string((30)." days"));
     $lastthirtydate=date_format($lastthirtydays,"Y-m-d");
     $this->db->select('*');
     $this->db->where('booking_datetime BETWEEN "'. $lastthirtydate. '" and "'.$today.'"');
     $this->db->from('holiday_booking_reports');
     // $this->db->where('user_id != ',0);
     $this->db->where($where);
     $query = $this->db->get();
     if($query->num_rows()>0){    
      return $query->result();
   }else{
      return NULL;
   } 

}
public function getlastsixmonthsbooking()
{
     $today=date("Y-m-d", strtotime("now"));
     $lastsixmonths=date_create($today);
     $where = "(booking_status LIKE '%Success%')";       
     date_sub($lastsixmonths,date_interval_create_from_date_string((6)." months"));
     $lastsixmonthsdate=date_format($lastsixmonths,"Y-m-d");
     $this->db->select('*');
     $this->db->where('booking_datetime BETWEEN "'. $lastsixmonthsdate. '" and "'.$today.'"');
     $this->db->from('holiday_booking_reports');
     // $this->db->where('user_id != ',0);
     $this->db->where($where);
     $query = $this->db->get();
     if($query->num_rows()>0){    
      return $query->result();
   }else{
      return NULL;
   } 

}
public function getlastninetydaysbooking()
{
     $today=date("Y-m-d", strtotime("now"));
     $lastninetydays=date_create($today);
     $where = "(booking_status LIKE '%Success%')";       
     date_sub($lastninetydays,date_interval_create_from_date_string((90)." days"));
     $lastninetydate=date_format($lastninetydays,"Y-m-d");
     $this->db->select('*');
     $this->db->where('booking_datetime BETWEEN "'. $lastninetydate. '" and "'.$today.'"');
     $this->db->from('holiday_booking_reports');
     // $this->db->where('user_id != ',0);
     $this->db->where($where);
     $query = $this->db->get();
     if($query->num_rows()>0){    
      return $query->result();
   }else{
      return NULL;
   } 

}

public function getlastoneyearbooking()
{
     $today=date("Y-m-d", strtotime("now"));
     $lastoneyear=date_create($today);
     $where = "(booking_status LIKE '%Success%')";       
     date_sub($lastoneyear,date_interval_create_from_date_string((1)." year"));
     $lastoneyeardate=date_format($lastoneyear,"Y-m-d");
     $this->db->select('*');
     $this->db->where('booking_datetime BETWEEN "'. $lastoneyeardate. '" and "'.$today.'"');
     $this->db->from('holiday_booking_reports');
     // $this->db->where('user_id != ',0);
     $this->db->where($where);
     $query = $this->db->get();
     if($query->num_rows()>0){    
      return $query->result();
   }else{
      return NULL;
   } 

}



public function getdaterangeAccountsummary($fromdate,$todate)
{
   
     $where = "(booking_status LIKE '%Success%')";       
   
   $this->db->select('SUM(package_amount) as net_total');
    $this->db->where('booking_datetime BETWEEN "'. $fromdate. '" and "'.$todate.'"');
    $this->db->from('holiday_booking_reports');
    // $this->db->where('user_id != ',0);
    $this->db->where($where);
    $query = $this->db->get();   
     if($query->num_rows()>0){    
      return $query->row();
   }else{
      return NULL;
   }
}
public function getdaterangebooking($fromdate,$todate)
{
   
     $where = "(booking_status LIKE '%Success%')";     
     $this->db->select('*');
     $this->db->where('booking_datetime BETWEEN "'. $fromdate. '" and "'.$todate.'"');
     $this->db->from('holiday_booking_reports');
     // $this->db->where('user_id != ',0);
     $this->db->where($where);
     $query = $this->db->get();
     if($query->num_rows()>0){    
      return $query->result();
   }else{
      return NULL;
   } 

}

function add_insurance($data) {
        $this->db->insert('insurance', $data);
        return $this->db->insert_id();
    }

	public function get_insurance() {
        $this->db->select('*');
        $this->db->from('insurance');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows()>0) 
            return $query->result();
         else         
            return '';      
        
    }
    
    public function package_active($hol_id,$id){
    //print_r($hol_id);print_r($id);
        $upd_pkg= array(
                'status' => $id
                );
        $this->db->where('s_no',$hol_id);
        $this->db->update('insurance',$upd_pkg);
    }
    
    public function get_insurance_by_id($id) {
        $this->db->select('*');
        $this->db->from('insurance');
        $this->db->where('s_no',$id);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows()>0) 
            return $query->row();
         else         
            return '';      
        
    }
     public function update_insurance($id,$data){
        $this->db->where('s_no',$id);
        $this->db->update('insurance',$data);
    }
	
}

