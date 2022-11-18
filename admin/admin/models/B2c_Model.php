<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class B2c_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function check_email_availability($email)
	{
		$this->db->select('*')
		->from('user_info')
		->where('user_email',$email)
		->limit('1');
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result();
		}

		return '';

	}

	public function add_user($user_email,$user_password,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$image_path)
	{
		$data = array(
			'user_email' => $user_email,
			'user_password' => $user_password,
			'title' => $title,
			'first_name' => $first_name,
			'middle_name' => $middle_name,
			'last_name' => $last_name,
			'mobile_no' => $mobile_no,
			'address' => $address,
			'pin_code' => $pin_code,
			'city' => $city,
			'state' => $state,
			'country' => $country,
			'user_logo' => $image_path,
			'status' => 1,

			);

		$this->db->set('register_date', 'NOW()', FALSE);

		$this->db->insert('user_info', $data);
		$id = $this->db->insert_id();
		if(!empty($id))
		{
			$user_no = 'SKPL'.$id.rand(1000,9999);

			$data1 = array('user_no' => $user_no);
			$this->db->where('user_id',$id);
			$this->db->update('user_info', $data1);

			return true;
		}
		else
		{
			return false;
		}

	}

	public function get_user_list()
	{
		$this->db->select('*')
		->from('user_info');
		$this->db->order_by('user_id', 'DESC');
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result();
		}

		return false;
	}

	public function manage_user_status($user_id,$status)
	{
		$data['status'] = $status;
		$where = "user_id = '$user_id'";
		if($this->db->update('user_info', $data, $where))
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	public function get_user_info_by_id($user_id)
	{
		$this->db->select('*')
		->from('user_info')
		->where('user_id',$user_id)
		->limit('1');
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			$res = $query->result();
			return $res[0];
		}

		return false;

	}

	public function update_user($user_id,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$user_logo)
	{
		$data = array(
			'title' => $title,
			'first_name' => $first_name,
			'middle_name' => $middle_name,
			'last_name' => $last_name,
			'mobile_no' => $mobile_no,
			'address' => $address,
			'pin_code' => $pin_code,
			'city' => $city,
			'state' => $state,
			'country' => $country,
			'user_logo' => $user_logo,
			);

		$this->db->where('user_id',$user_id);

		if($this->db->update('user_info', $data))
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	public function update_user_password($user_id,$password='')
	{
		if(!empty($password))
		{
			$data['user_password'] = $password;
			$where = "user_id = '$user_id'";
			if($this->db->update('user_info', $data, $where))
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

	public function get_hotel_markup_list()
	{
		$this->db->select('*')
		->from('b2c_markup_info')
		->where('service_type',1);
		$query = $this->db->get();

		if($query->num_rows() > 0 )
		{
			return $query->result();
		}

		return false;
	}

	public function get_flight_markup_list()
	{
		$this->db->select('*')
		->from('b2c_markup_info')
		->where('service_type',2);
		$query = $this->db->get();

		if($query->num_rows() > 0 )
		{
			return $query->result();
		}

		return false;
	}

	public function get_car_markup_list()
	{
		$this->db->select('*')
		->from('b2c_markup_info')
		->where('service_type',4);
		$query = $this->db->get();

		if($query->num_rows() > 0 )
		{
			return $query->result();
		}

		return false;
	}
	public function get_bus_markup_list()
	{
		$this->db->select('*')
		->from('b2c_markup_info')
		->where('service_type',5);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() > 0 )
		{
			return $query->result();
		}

		return false;
	}
	public function get_transfer_markup_list() {
    $this->db->select('*')
    ->from('b2c_markup_info')
    ->where('service_type', 3);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->result();
    }

    return false;
	}
	public function get_mobile_markup_list()
	{
		$this->db->select('*')
		->from('b2c_markup_info')
		->where('service_type',5);
		$query = $this->db->get();

		if($query->num_rows() > 0 )
		{
			return $query->result();
		}

		return false;
	}

	function delete_b2c_markup($markup_type,$service_type)
	{
		$where = "markup_type = '$markup_type' AND service_type = '$service_type'";
		if ($this->db->delete('b2c_markup_info', $where))
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	function b2c_markup_checking($country, $city, $hotel, $airline, $api_name, $markup_type, $service_type, $currency)
	{
		$this->db->select('*');
		$this->db->from('b2c_markup_info');
		$this->db->where('country',$country);
		if($city != NULL)
		{
			$this->db->where('city',$city);
		}
		if($hotel != NULL)
		{
			$this->db->where('hotel',$hotel);
		}
		if($airline != NULL)
		{
			$this->db->where('airline',$airline);
		}
		$this->db->where('api_name',$api_name);
		$this->db->where('markup_type',$markup_type);
		$this->db->where('service_type',$service_type);
		$this->db->where('currency',$currency);

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

	function add_b2c_markup($country, $city, $hotel, $airline, $api_name, $markup, $markup_type, $service_type, $currency,$process)
	{
		$data = array(
			'country' => $country,
			'city' => $city,
			'hotel' => $hotel,
			'airline' => $airline,
			'api_name' => $api_name,
			'currency' => $currency,
			'markup' => $markup,
			'markup_type' => $markup_type,
			'service_type' => $service_type,
			'markup_process' =>$process,
			'status' => 1
			);
		// echo '<pre/>';print_r($data);exit;
		//$this->db->set('register_date', 'NOW()', FALSE);
		$this->db->insert('b2c_markup_info', $data);
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


	function delete_id_b2c_markup($country, $city, $hotel, $airline, $api_name, $markup_type, $service_type, $currency)
	{
		$this->db->where('country',$country);
		if($city != NULL)
		{
			$this->db->where('city',$city);
		}
		if($hotel != NULL)
		{
			$this->db->where('hotel',$hotel);
		}
		if($airline != NULL)
		{
			$this->db->where('airline',$airline);
		}
		$this->db->where('api_name',$api_name);
		$this->db->where('markup_type',$markup_type);
		$this->db->where('service_type',$service_type);
		$this->db->where('currency',$currency);

		if($this->db->delete('b2c_markup_info'))
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	public function manage_b2c_markup_status($markup_id,$status)
	{
		$data['status'] = $status;
		$where = "markup_id = '$markup_id'";
		if($this->db->update('b2c_markup_info', $data, $where))
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	function delete_b2c_markup_status($markup_id)
	{
		$where = "markup_id = '$markup_id'";
		if ($this->db->delete('b2c_markup_info', $where))
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	public function get_b2c_flight_booking_summary($status=null,$supplier=null,$from_date=null,$to_date=null,$type=null)
	{
		$this->db->select('fr.*,fp.*')
		->from('flight_booking_reports fr')
		->join('flight_booking_passengers fp', 'fr.uniqueRefNo = fp.uniqueRefNo')
		->where('fr.agent_id', 0);
		if($status !=''){
			$this->db->where('fr.BookingStatus',$status);
		}
		if($supplier !=''){
			$this->db->where('fr.api',$supplier);
		}
		if($from_date){
			$this->db->where('fr.Booking_Date >=', $from_date);
		}
		if($to_date !=''){
			$this->db->where('fr.Booking_Date <=', $to_date);
		}

		$this->db->order_by('fr.report_id', 'DESC');
			//	->group_by('fp.uniqueRefNo');
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return array($query->result(),$query);
		}

		return false;

	}

	public function get_b2c_bus_booking_summary($status=null,$supplier=null,$from_date=null,$to_date=null,$type=null)
	{

		$this->db->select('br.*,bp.*')
		->from('bus_booking_reports br')
		->join('bus_booking_pass_info bp', 'br.booking_unique_reference_no = bp.uniqueRefNo')
		->where('br.agent_id', 0);
				//->where($agent_cond)
		if($status !=''){
			$this->db->where('br.Booking_Status',$status);
		}
		if($supplier !=''){
			$this->db->where('br.api',$supplier);
		}
		if($from_date){
			$this->db->where('br.booking_date >=', $from_date);
		}
		if($to_date !=''){
			$this->db->where('br.booking_date <=', $to_date);
		}
		$this->db->order_by('br.report_id', 'DESC')
		->group_by('bp.uniqueRefNo');
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return array($query->result(),$query);
		}

		return false;

	}
	public function get_b2c_apartment_booking_summary($status=null,$supplier=null,$from_date=null,$to_date=null,$type=null)
	{

		$this->db->select('br.*,bp.*')
		->from('apartment_booking_reports br')
		->join('apartment_pass_info bp', 'br.uniqueRefNo = bp.uniqueRefNo')
		->where('br.agent_id', 0);
				//->where($agent_cond)
		if($status !=''){
			$this->db->where('br.Booking_Status',$status);
		}
		if($supplier !=''){
			$this->db->where('br.api',$supplier);
		}
		if($from_date){
			$this->db->where('br.Booking_Date >=', $from_date);
		}
		if($to_date !=''){
			$this->db->where('br.Booking_Date <=', $to_date);
		}
		$this->db->order_by('br.report_id', 'DESC')
		->group_by('bp.uniqueRefNo');
		$query = $this->db->get();
//echo $this->db->last_query();exit;
		if ($query->num_rows() > 0)
		{
			return array($query->result(),$query);
		}

		return false;

	}

	public function get_apart_markup_list()
	{
		$this->db->select('*')
		->from('b2c_markup_info')
		->where('service_type',5);
		$query = $this->db->get();

		if($query->num_rows() > 0 )
		{
			return $query->result();
		}

		return false;
	}


	public function get_b2c_hotel_booking_summary($status=null,$supplier=null,$from_date=null,$to_date=null,$type=null)
	{
	// print_r($Status);
		$this->db->select('hr.*,hh.city as hotel_city,hh.*,hp.*,hh.address,hr.Api_Name')
		->from('hotel_booking_reports hr')
		->join('hotel_booking_hotels_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo')
		->join('hotel_booking_passengers_info hp', 'hr.uniqueRefNo = hp.uniqueRefNo')
		->where('hr.agent_id',0);

		if($status !=''){
			$this->db->where('hr.Booking_Status',$status);
		}
		if($supplier !=''){
			$this->db->where('hr.Api_name',$supplier);
		}
		if($from_date){
			$this->db->where('hr.Booking_Date >=', $from_date);
		}
		if($to_date !=''){
			$this->db->where('hr.Booking_Date <=', $to_date);
		}

		$this->db->order_by('hr.report_id', 'DESC')
		->group_by('hp.uniqueRefNo');
		$query = $this->db->get();
//echo $this->db->last_query();
		if ($query->num_rows() > 0)
		{
			return array($query->result(),$query);
            //return $query;
		}

		return false;
	}

	public function get_b2c_car_booking_summary($agent_id='',$from_date='',$to_date='')
	{
		$this->db->select('cr.*,cp.*')
		->from('car_booking_reports cr')
		->join('car_booking_passengers cp', 'cr.uniqueRefNo = cp.uniqueRefNo')
		->where('cr.agent_id', 0)
		->order_by('cr.report_id', 'DESC')
		->group_by('cp.uniqueRefNo');
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return array($query->result(),$query);
		}

		return false;

	}
	public function get_b2c_transfer_booking_summary()
	{
		$this->db->select('tr.*,tp.*')
		->from('transfer_booking_reports tr')
		->join('transfer_booking_passengers tp', 'tr.uniqueRefNo = tp.uniqueRefNo')
		->where('tr.agent_id', 0)
		->order_by('tr.id', 'DESC')
		->group_by('tp.uniqueRefNo');
		// $this->db->select('*')
		// ->from('transfer_booking_reports')
		//  ->where('agent_id', 0);
		$query = $this->db->get();
		// echo $this->db->last_query();exit;
		if ($query->num_rows() > 0)
		{
			return array($query->result(),$query);
		}

		return false;

	}

	public function get_b2c_activity_booking_summary()
	{
		$this->db->select('ar.*,ap.*')
		->from('activity_booking_reports ar')
		->join('activity_booking_passengers ap', 'ar.uniqueRefNo = ap.uniqueRefNo')
		->where('ar.agent_id', 0)
		->order_by('ar.id', 'DESC')
		->group_by('ap.uniqueRefNo');
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return array($query->result(),$query);
		}

		return false;

	}
	public function get_holi_query_reports($status='',$supplier='',$from_date='',$to_date='',$type=''){
		$this->db->select('*');
		$this->db->from('holiday_pac_req');

		if($status !=''){
			$this->db->where('Booking_Status',$status);
		}
		if($supplier !=''){
			$this->db->where('Api_name',$supplier);
		}
		if($from_date){
			$this->db->where('booking_date >=', $from_date);
		}
		if($to_date !=''){
			$this->db->where('booking_date >=', $to_date);
		}


		$query=$this->db->get();
	//$this->dd_ex($query);
		if ($query->num_rows() > 0)
		{
			return array($query->result(),$query);
		}else{
			return '';
		}

	}

	public function get_holiday_booking_information($hol_unique)
	{
		$this->db->select('r.*,h.*');
		$this->db->from('holiday_booking_reports r');
		$this->db->join('holiday_passenger_info h', 'r.uniqueRefNo = h.uniqueRefNo');
		$this->db->where('h.uniqueRefNo',$hol_unique);
		$this->db->limit('1');

		$query = $this->db->get();

		if($query->num_rows() == 0 )
		{
			return '';
		}
		else
		{
			return $query->row();
		}

	}
	public function get_holiday_booking_passenger_info($hol_unique)
	{
		$this->db->select('*');
		$this->db->from('holiday_passenger_info');
		$this->db->where('uniqueRefNo',$hol_unique);
		$this->db->order_by('holiday_pass_id','ASC');

		$query = $this->db->get();

		if($query->num_rows() == 0 )
		{
			return '';
		}
		else
		{
			return $query->result();
		}
	}

	public function get_holiday($holiday_id)
	{
		$this->db->select('*');
		$this->db->from('holiday_list');
		$this->db->where('holiday_id',$holiday_id);
		$query=$this->db->get();
		return $query->row();
	}
	public function getvisitcity($cityid)
	{
		$this->db->select('*');
		$this->db->from('city_list');
		$this->db->where_in('city_id',$cityid);
			//$this->db->group_by('country');
            $query=$this->db->get();//echo $this->db->last_query();exit;
            return $query->result();
        }
        public function get_api_list(){
	  // print_r($type);
        	$this->db->select('*');
        	$this->db->from('api_info');
         // $this->db->where('service_type',$type);
        	$query=$this->db->get();
		  //echo $this->db->last_query();exit;
        	return $query->result();
        }

        public function get_holiday_reports($id)
        {
        	$this->db->select('*');
        	$this->db->from('holiday_pac_req');
        	$this->db->where('uniqueRefNo',$id);
        	$query=$this->db->get();
        	return $query->row();
        }
        public function get_holiday_agent_reports($id){
        	$this->db->select('*');
        	$this->db->from('agent_info');
        	$this->db->where('agent_id',$id);
        	$query=$this->db->get();
        	if($query->num_rows() > 0){
        		return $query->result();
        	}else{
        		return '';
        	}

        }
        public function update_B2Chotel_ref_amt($amt,$id,$ad_email,$ad_id){
        	$data=array(
        		'Conv_Refund_Amt'=>$amt,
        		'cancelled_by_email'=>$ad_email,
        		'cancelled_by_id'=>$ad_id
        		);
        	$this->db->where('uniqueRefNo',$id);
        	$this->db->update('hotel_booking_reports',$data);
        }
        public function update_B2Capart_ref_amt($amt,$id,$ad_email,$ad_id){
        	$data=array(
        		'Refund_Amt'=>$amt,
        		'cancelled_by_email'=>$ad_email,
        		'cancelled_by_id'=>$ad_id
        		);
        	$this->db->where('uniqueRefNo',$id);
        	$this->db->update('apartment_booking_reports',$data);
        }

        public function update_B2Cflight_ref_amt($amt,$id,$ad_email,$ad_id){
        	$data=array(
        		'Conv_Refund_Amt'=>$amt,
        		'cancelled_by_email'=>$ad_email,
        		'cancelled_by_id'=>$ad_id
        		);
        	$this->db->where('uniqueRefNo',$id);
        	$this->db->update('flight_booking_reports',$data);
        }
        public function update_B2Cbus_ref_amt($amt,$id,$ad_email,$ad_id){
        	$data=array(
        		'Conv_Refund_Amt'=>$amt,
        		'cancelled_by_email'=>$ad_email,
        		'cancelled_by_id'=>$ad_id
        		);
        	$this->db->where('uniqueRefNo',$id);
        	$this->db->update('bus_booking_reports',$data);
        }
        public function get_all_city_list($search) {
        	$where = "hotel_name LIKE '%" . $search . "%'";
        	$this->db->select('*');
        	$this->db->from('api_permanent_hotels');
        	$this->db->where($where);
        	$this->db->group_by('hotel_name');
        	$this->db->order_by('hotel_name');
        	$query = $this->db->get();
//echo $this->db->last_query();
        	if ($query->num_rows() == '') {
        		return '';
        	} else {
        		return $query->result_array();
        	}
        }

        public function delete_old_discount($airline,$origin='',$destination=''){
        	// if($basefare){
        	// 	$this->db->where('basefare',$basefare);

        	// }

        	// if($yqfare){
        	// 	$this->db->where('yqfare',$yqfare);
        	// }

        	$this->db->where('airline',$airline);
        	if($origin){
        		$this->db->where('origin',$origin);
        	}
        	if($destination){
        		$this->db->where('destination',$destination);
        	}
        	$this->db->delete('b2c_discount_info');
        }




        public function insert_discount($data){

        	$this->db->insert('b2c_discount_info',$data);
        }
        public function get_airlines_list()
        {   
        	$this->db->select('*')
        	->from('airlines_list')
        	->group_by('airline_name');
        	$query = $this->db->get();

        	if($query->num_rows() > 0 ) 
        	{      
        		return $query->result();
        	}

        	return false;
        }
        public function get_airline_discount_list(){
        	$this->db->select('*');
        	$this->db->from('b2c_discount_info');
        	$query=$this->db->get();
        	if($query->num_rows() > 0 ) 
        	{      
        		return $query->result();
        	}

        	return false;
        }
        public function get_airport_list(){
        	$this->db->select('*');
        	$this->db->from('airport_list');
        	$query=$this->db->get();
        	if($query->num_rows() > 0 ) 
        	{      
        		return $query->result();
        	}

        	return false;
        }
        public function update_discount_status($id,$status){
            $data=array(
'status'=>$status,
                );
$this->db->where('markup_id',$id);
$this->db->update('b2c_discount_info',$data);
return true;

        }
         public function delete_discount($id){
           
$this->db->where('markup_id',$id);
$this->db->delete('b2c_discount_info');
return true;

        }
    }