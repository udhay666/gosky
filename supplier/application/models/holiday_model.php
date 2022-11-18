<?php

class Holiday_model extends CI_MODEL {

    function __construct() {
        parent :: __construct();
    }

    function addpackage($holiday_type, $holidayname, $destination) {

        $data = array(
            'package_type' => $holiday_type,
            'package_name' => trim($holidayname),
            'city_list_id' => $destination,
            'status' => 'InActive'
        );
        $this->db->insert('holiday_package', $data);
        return true;
    }

    public function add_hotel($hotel) {

        $this->db->insert('holiday_hotel_list', $hotel);
        return true;
    }

    function getholidaypackages() {
        $this->db->select('*')
                ->from('holiday_package')
                ->order_by('package_name');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }
   function get_expiry_report() {
        $this->db->select('*')
                ->from('holiday_list');
               // ->order_by('package_name');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

	
	
    public function get_currency() {
        $this->db->select('*')
                ->from('currency');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    function holidaypackages($id, $status) {

        $this->db->select('*')
                ->from('holiday_package')
                ->where('package_type', $id)
                ->where('status', $status);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }


    function holidaypackagecity($id) {


        $query1 = "select city_list_id from holiday_package where holi_id='$id'";
        $sel = mysql_query($query1);
        $rowCity = mysql_fetch_array($sel); //echo '<pre>';print_r($rowCity);exit;
        $select = "select * from city_list where city_id in (" . $rowCity['city_list_id'] . ")";
        $query = $this->db->query($select);
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            //echo 'fgfh';
            return $query->result();
        } else {
            return '';
        }
    }
     function destinationCityList($str) 
	 {
		 $selectquery="SELECT DISTINCT(city_name),city_id FROM city_list WHERE city_type='".$str."'  order by city_name asc";
		 $query = $this->db->query($selectquery);
        if ($query->num_rows() > 0) {
            //echo 'fgfh';
            return $query->result();
        } else {
            return '';
        }
    }
    function update_package($id) {
        $this->db->where('holi_id', $id);
        $this->db->delete('holiday_package');
        $where2 = "holi_id = $id";
        return true;
    }

    function update_package_del($id) {
        $this->db->where('holiday_id', $id);
        $this->db->delete('holiday_list');
        return true;
    }

    function update_package1($id) {
        $this->db->where('holidayid', $id);
        $this->db->delete('holidays_theme_week');
        $where2 = "holidayid = $id";
        return true;
    }

    public function edit_package($id) {
        $this->db->select('*');
        $this->db->from('holiday_list');
        $this->db->where('holiday_id', $id);
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        return $query->row();
    }

    public function getpname($id1) {
        $this->db->select('*');
        $this->db->from('holiday_package');
        $this->db->where('holi_id', $id1);
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        return $query->row();
    }

    public function getdestination($cityid) {
        $this->db->select('*');
        $this->db->from('city_list');
        $this->db->where('city_id', $cityid);
        $q = $this->db->get(); //echo $this->db->last_query();exit;
        $res = $q->row();
        return $res->city_name;
    }

    public function getdest($selcityid) {
        //echo '<pre>';
        //print_r($selcityid);
        //exit;
        $this->db->select('*');
        $this->db->from('city_list');
        $this->db->where('city_id', $selcityid);
        $q = $this->db->get(); //echo $this->db->last_query();exit;
        $res = $q->row();
        return $res->city_name;
    }

    public function updateholidaylist_old($holidayid, $holiday_type, $holiday_category, $package_title, $package_type, $transport, $destination, $duration, $tourtags, $start_date, $end_date, $description, $highlight, $inclusion, $exclusion, $hotel_desc, $offer, $tax, $pptype, $email, $IMAGE, $status, $yvideo, $comments, $hotel_nm, $hol_hot_id, $price1, $price2, $price3, $cur, $price, $term,$hol_theme,$price4,$priority,$package_desc,$longitude,$Lattitude,$price_desc,$montharray,$categoryarray,$temperature,$continentStr,$countryStr,$stateStr) {
        $data = array(
            'holiday_type' => stripslashes($holiday_type),
            'holiday_category' => stripslashes($holiday_category),
            'holiday_category' => stripslashes($holiday_category),
            'pcakage_title' => stripslashes($package_title),
            'package_type' => stripslashes($package_type),
            'tags' => stripslashes($tourtags),
            'destination' => stripslashes($destination),
            'transportation' => stripslashes($transport),
            'duration' => stripslashes($duration),
            'start_date' => $start_date,
            'end_date' =>$end_date,
            'description' => stripslashes($description),
            'fax_no' => '',
            'website' => '',
            'hotel_desc' => stripslashes($hotel_desc),
            'inclusion' => stripslashes($inclusion),
            'exclusion' => stripslashes($exclusion),
            'highlights' => stripslashes($highlight),
            'pptype' => stripslashes($pptype),
            'offer' => stripslashes($offer),
            'tax' => stripslashes($tax),
            'email' => stripslashes($email),
            'images' => stripslashes($IMAGE),
            'status' => stripslashes($status),
            'thumb_image' => stripslashes($thumbfileTime),
            'large_img' => stripslashes($largefileTime),
            'holiday_hotel_name' => stripslashes($hotel_nm),
            'holiday_hotel_list_id' => stripslashes($hol_hot_id),
            'special_offers' => stripslashes($offer),
            'comments' => stripslashes($comments),
            'adult_price' => stripslashes($price1),
            'child_price' => stripslashes($price2),
            'infant_price' => stripslashes($price3),
            'currency' => stripslashes($cur),
            'price' => stripslashes($price),
            'terms' => stripslashes($term),
            'theme_id' => stripslashes($hol_theme),
             'yvideo' => $yvideo,
            'child_no_bed' => stripslashes($price4),
			'priority'=>$priority,
			'package_desc'=>stripslashes($package_desc),
			'longitude'=>$longitude,
			'Lattitude'=>$Lattitude,
			'price_desc'=>$price_desc,
            'month_dur'=>$montharray,
            'category'=>$categoryarray,
            'temperature'=>$temperature,
            'continent'=>$continentStr,
            'country'=>$countryStr,
            'state'=>$stateStr,
			
        );
        $this->db->where('holiday_id', $holidayid);
        $this->db->update('holiday_list', $data); //echo $this->db->last_query();exit;
        return true;
    }

    function getholidaylist_sve($from_date='',$to_date='') {
		
	
	$this->db->select('L.*,P.*');
		$this->db->from('holiday_list L');
		$this->db->join('holiday_package P','L.holiday_category=P.holi_id');
		$this->db->where('L.holiday_id !=',0);
		
			
				if($from_date){
			$this->db->where('L.start_date >=', $from_date);
				}
				if($to_date !=''){
				$this->db->where('L.end_date <=', $to_date);			
				}
		$this->db->order_by('L.holiday_id','DESC');
		$query=$this->db->get();
		//echo $this->db->last_query();
		 if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
		
       /* $select = "SELECT * FROM `holiday_list` AS L left join holiday_package AS P on L.holiday_category=P.holi_id WHERE L.holiday_id is not null ORDER BY `holiday_id` DESC ";
        $query = $this->db->query($select);
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }*/
    }

    public function update_img($maxno, $tmp) {
        $data = array('holiday_images' => $tmp);
        $this->db->where('holiday_list_id', $maxno);
        $this->db->update('holiday_images', $data);
        //echo $this->db->last_query();exit;
    }

    public function edit_img($id) {
        $this->db->select('*');
        $this->db->from('holiday_images');
        $this->db->where('holiday_list_id', $id);
        $q = $this->db->get();
        return $q->result();
    }
	function delete_image($id) {
	
		$this->db->where('holi_image_id', $id);
		$this->db->delete('holiday_images'); 	
		
	}
   function select_image($id) {
    
        $this->db->select('*');
        $this->db->from('holiday_images');
        $this->db->where('holi_image_id', $id);
        $q = $this->db->get();
        return $q->result(); 
        
    }
    public function get_hotel_name_int() {
        $this->db->select('*');
        $this->db->from('holiday_hotel_list');
        $this->db->where('holiday_hotel_type', '1');
        $this->db->group_by('hotel_name');
        $q1 = $this->db->get();
        return $q1->result();
    }

    public function get_hotel_name_dom() {
        $this->db->select('*');
        $this->db->from('holiday_hotel_list');
        $this->db->where('holiday_hotel_type', '2');
        $this->db->group_by('hotel_name');
        $q1 = $this->db->get();
        return $q1->result();
    }

    public function get_name($hotel_id) {
        $this->db->select('*');
        $this->db->from('holiday_hotel_list');
        $this->db->where_in('holiday_hotel_list_id', $hotel_id);
        $q1 = $this->db->get(); //echo $this->db->last_query();exit;
        return $q1->result();


        /* $q="SELECT * FROM  `holiday_hotel_list` where holiday_hotel_list_id in ($hotel_id)";
          $q1=$this->db->query($q);
          //echo $this->db->last_query();exit;
          return $q1->result(); */
    }

    public function get_country_list() {
        $this->db->select('*')
                ->from('country');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function add_country($city, $country, $city_type,$latitude,$longitude) {
        $date = date('Y-m-d H:i:s');
        $data = array(
            'city_name' => $city,
            'country' => $country,
            'city_type' => $city_type,
            'entry_date' => $date,
			'latitude' => $latitude,
			'longitude' => $longitude,
			
        );
        $this->db->insert('city_list', $data);
    }

    public function getcountry($dest) {
        $this->db->select('*');
        $this->db->from('city_list');
        $this->db->where_in('city_id', $dest);
        $q = $this->db->get();
        //echo $this->db->last_query();exit;
        return $q->result();
    }

    public function get_city_l($dest) {
        $this->db->select('*');
        $this->db->from('city_list');
        $this->db->where_in('city_id', $dest);
        $q = $this->db->get();
        //echo $this->db->last_query();exit;
        return $q->result();
    }

    public function add_th_wk_package($holiday_type, $holidayname, $destination, $description) {

        $data = array(
            'package_type' => $holiday_type,
            'package_name' => trim($holidayname),
            'city_list_id' => $destination,
            'description' => trim($description)
        );
        $this->db->insert('holidays_theme_week', $data);
        return true;
    }

    public function getholidaypackages_th_wk() {
        $this->db->select('*')
                ->from('holidays_theme_week')
                ->order_by('package_name');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function check_hol($id) {
        $date = date('Y-m-d H:i:s');
        //echo $date;exit;
        $this->db->select('r.*,h.*');
        $this->db->from('holiday_booking_reports r');
        $this->db->join('holiday_list h', 'r.holiday_id = h.holiday_id');
        $this->db->where('h.holiday_id', $id);
        $this->db->where('now() <= h.end_date ');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }
    }

    public function get_cclist() {
        $q = "SELECT *
FROM `city_list`
WHERE `country` != ''
";
        $query = $this->db->query($q);
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function get_hotel() {
        $this->db->select('*');
        $this->db->from('holiday_hotel_list');
        $q = $this->db->get();
        return $q->result();
    }

    public function ins_lat($latitude, $longitude, $destination) {
        $data = array(
            'latitude' => $latitude,
            'longitude' => $longitude,
        );
        $this->db->where("FIND_IN_SET('$destination',city_id) !=", 0);
        $this->db->update('city_list', $data);
//	echo $this->db->last_query();exit;
        return true;
    }
  public function update_dom($pr,$status) {
        $data = array(
            'domestic_hol' => $status
        );
        $this->db->where('holiday_id', $pr);
        $this->db->update('holiday_list', $data);
	//	echo $this->db->last_query();exit;
    }
	
    public function update_promo($pr,$status) {
        $data = array(
            'promotional_hol' => $status
        );
        $this->db->where('holiday_id', $pr);
        $this->db->update('holiday_list', $data);
    }

		
    public function update_rec($pr,$status) {
        $data = array(
            'recommended_hol' => $status
        );
        $this->db->where('holiday_id', $pr);
        $this->db->update('holiday_list', $data);
    }

    public function update_int($pr,$status) {
        $data = array(
            'international_hol' => $status
        );
        $this->db->where('holiday_id', $pr);
        $this->db->update('holiday_list', $data);
    }
	
	
	public function subpage_rec($sb,$status){
	
	$data=array(
	'Subpage_reccomandation' => $status
	);
	$this->db->where('holiday_id',$sb);
	$this->db->update('holiday_list',$data);
	}
	
	public function holiday_thm($sb,$status){
	
	$data=array(
	'holiday_theme' => $status
	);
	$this->db->where('holiday_id',$sb);
	$this->db->update('holiday_list',$data);
	}
	
	

    public function get_theme() {
        $this->db->select('*');
        $this->db->from('holiday_theme');
        $this->db->where('isActive',1);
        $q = $this->db->get();
        return $q->result();
    }

	
    function getholidaylist() {
        $select = "SELECT *,L.status as hol_stat FROM `holiday_list` AS L left join holiday_package AS P on L.holiday_category=P.holi_id WHERE L.holiday_id is not null  ORDER BY `holiday_id` DESC ";
        $query = $this->db->query($select);
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }
	
	function holidaylist_status($hol_id,$id){
	$update=array( 'status' => $id );
	
	$this->db->where('holiday_id',$hol_id);
	$this->db->update('holiday_list',$update);
	}
	//
	public function get_status($hol_id){
	$this->db->select('status');
		 $this->db->from('holiday_list');
		 $this->db->where('holiday_id',$hol_id);
			$query=$this->db->get();
			  return $query->row();
	
	}
	public function package_active($hol_id,$id){
	//print_r($hol_id);print_r($id);
	$upd_pkg=array(
	'status' => $id
	);
	$this->db->where('holiday_id',$hol_id);
	$this->db->update('holiday_list',$upd_pkg);
		}
    public function get_cruise_dest() {
        $this->db->select('*');
        $this->db->from('city_list');
        $q = $this->db->get();
        return $q->result();
    }
//clone holiday list
public function clone_holiday($id){

$select="select holiday_id FROM holiday_list ORDER BY holiday_id DESC Limit 1";
//echo $select;
$query=$this->db->query($select);
$hol_id=$query->row();
//print_r($hol_id->holiday_id);exit;
$select="CREATE TEMPORARY TABLE temp_holiday2 SELECT * FROM holiday_list WHERE holiday_id = $id";
//echo $select;exit;
$query=$this->db->query($select);
$select="UPDATE temp_holiday2 SET holiday_id = $hol_id->holiday_id + 1";
$query=$this->db->query($select);
$select="INSERT INTO holiday_list SELECT * FROM temp_holiday2";
$query=$this->db->query($select);
//$select="if object_id('tempdb..##temp_holiday2') is not null";
//$query=$this->db->query($select);
$select="DROP TEMPORARY TABLE temp_holiday2";
$query=$this->db->query($select);


  /*if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }*/
}
    public function insert_cruise($data) {
        $this->db->insert('holiday_cruises', $data);
        return true;
    }

    public function get_cr_dtls() {

        $this->db->select('*');
        $this->db->from('holiday_cruises');
        $q = $this->db->get();
        return $q->result();
    }

    public function edit_cr_package($id) {
        $this->db->select('*');
        $this->db->from('holiday_cruises');
        $this->db->where('cruise_id', $id);
        $q = $this->db->get();
        return $q->row();
    }

    public function update_cruise($cruise_id, $cruise_name, $cruise_from, $cruise_to, $cruise_shipname, $cruise_duration, $s_date, $e_date, $cruise_shipdtls, $cruise_iternery, $cruise_price, $thumbfileTime, $cruise_cabin, $cruise_country, $shipimage, $cruise_desc) {
        $data = array(
            'cruise_name' => $cruise_name,
            'embarkation' => $cruise_from,
            'disembarkation' => $cruise_to,
            'ship_name' => $cruise_shipname,
            'duration' => $cruise_duration,
            'start_date' => $s_date,
            'end_date' => $e_date,
            'ship_details' => $cruise_shipdtls,
            'itinerary' => $cruise_iternery,
            'price' => $cruise_price,
            'cr_image' => $thumbfileTime,
            'cabin_category' => $cruise_cabin,
            'country' => $cruise_country,
            'ship_image' => $shipimage,
            'description' => $cruise_desc
        );
        $this->db->where('cruise_id', $cruise_id);
        $this->db->update('holiday_cruises', $data);
    }

    public function delete_cruise($id) {
        $this->db->where('cruise_id', $id);
        $this->db->delete('holiday_cruises');
        return true;
    }

    public function edit_hotel($id) {
        $this->db->select('*');
        $this->db->from('holiday_hotel_list');
        $this->db->where('holiday_hotel_list_id', $id);
        $q = $this->db->get();
//echo $this->db->last_query();exit;
        return $q->row();
    }

    public function del_hotel($id) {
        $this->db->where('holiday_hotel_list_id', $id);
        $this->db->delete('holiday_hotel_list');
        return true;
    }

    public function update_hotel($hid, $hol_hotel_type, $hotel_nm, $hotel_typ, $hotel_rate, $hotel_single, $hotel_double, $hotel_triple, $thumbfileTime, $hotel_add) {
        $hotel = array
            (
            'holiday_hotel_type' => $hol_hotel_type,
            'hotel_name' => $hotel_nm,
            'hotel_type' => $hotel_typ,
            'star_rating' => $hotel_rate,
            'price_per_single_room' => $hotel_single,
            'price_per_double_room' => $hotel_double,
            'price_per_triple_room' => $hotel_triple,
            'hotel_images' => $thumbfileTime,
            'additional_price_per_night' => $hotel_add
                //'child_bed'=>$hotel_bed,
                //'child_no_bed'=>$hotel_nobed
        );
        $this->db->where('holiday_hotel_list_id', $hid);
//echo $this->db->last_query();exit;
        $this->db->update('holiday_hotel_list', $hotel);
//echo $this->db->last_query();exit;
    }

    public function check_pack($pack_name) {
        $this->db->select('*');
        $this->db->from('holiday_list');
        $this->db->where('pcakage_title', $pack_name);
        $q = $this->db->get();
//echo $this->db->last_query();exit;
        return $q->row();
    }

    public function getvisitcity($cityid) {
        $this->db->select('*');
        $this->db->from('city_list');
        $this->db->where_in('city_id', $cityid);
        //$this->db->group_by('country');
        $query = $this->db->get();
          
		//echo "<pre>";print_r($query->result());exit;
        return $query->result();
    }

    public function get_prev($id) {
        $this->db->select('*');
        $this->db->from('holiday_list');
        $this->db->where('holiday_id', $id);
        $q = $this->db->get();
        return $q->row();
    }

    public function get_img($holimgid,$img_type) {
        $this->db->select('*');
        $this->db->from('holiday_images');
        $this->db->where('holiday_list_id', $holimgid);
		  $this->db->where('img_type', $img_type);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';
    }
	public function get_img_by_type($holidayid,$img_type) {
        $this->db->select('*');
        $this->db->from('holiday_images');
        $this->db->where('holiday_list_id', $holidayid);
		  $this->db->where('img_type', $img_type);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return '';
    }

    public function get_hol_package_by_id($id) {
        $this->db->select('*');
        $this->db->from('holiday_package');
        $this->db->where('holi_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    function update_holiday_package($holiday_type, $holidayname, $destination, $id) {

        $data = array(
            'package_type' => $holiday_type,
            'package_name' => trim($holidayname),
            'city_list_id' => $destination,
            'status' => 'InActive'
        );
        $this->db->where('holi_id', $id);
        $this->db->update('holiday_package', $data);
        return true;
    }

    public function check_city_avail($city) {

        $q = "SELECT * FROM `city_list` WHERE (`country` != '') AND (city_name='$city')";
        $query = $this->db->query($q);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }
    public function get_city_by_id($id){
          $this->db->select('*');
        $this->db->from('city_list');
        $this->db->where('city_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }
       public function update_country($city, $country, $city_type,$id,$latitude,$longitude) {
        $date = date('Y-m-d H:i:s');
        $data = array(
            'city_name' => $city,
            'country' => $country,
            'city_type' => $city_type,
            'entry_date' => $date,
			'latitude' => $latitude,
			'longitude' => $longitude,
			
        );
        $this->db->where('city_id',$id);
        $this->db->update('city_list', $data);
        //echo $this->db->last_query();exit;
        return true;
    }
    function delete_country($id) {
        $this->db->where('city_id', $id);
        $this->db->delete('city_list');
        return true;
    }
    public function upload_images($id,$img,$img_type){
        $data=array(
            'holiday_list_id'=>$id,
            'holiday_images'=>$img,
			'img_type'=>$img_type
        );
        $this->db->insert('holiday_images',$data);
        return true;
    }
	
	public function insert_theme($theme_name,$theme_desc,$price,$id=''){
	
	$data=array(
	'theme_name'=>$theme_name,
	'theme_desc'=>$theme_desc,
	'price'=>$price
	);
	if($id==''){
	$this->db->insert('holiday_theme',$data);
	}else{
	$this->db->where('theme_id',$id);
	$this->db->update('holiday_theme',$data);
	} 
	//echo $this->db->last_query();exit;
	return $this->db->insert_id();
	}
	
	public function get_theme_id($id) {
        $this->db->select('*')
                ->from('holiday_theme')
                ->where('theme_id', $id);

        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }
        //echo $id;

        return false;
    }
	public function update_theme_img($id, $source_image) {

        $data = array(
            'theme_img' => $source_image,
        );

        $this->db->where('theme_id', $id);
        $this->db->update('holiday_theme', $data);
    }
	
	public function get_theme_info(){
$this->db->select('*');
$this->db->from('holiday_theme');
$query=$this->db->get();
//echo $this->db->last_query();exit;
if ($query->num_rows() > 0){

            return $query->result();
}        else{
            return '';
			}
			}
			public function get_theme_info_by_id($id){
			$this->db->select('*');
			$this->db->from('holiday_theme');
			$this->db->where('theme_id',$id);
			$q=$this->db->get();
			if ($q->num_rows() > 0){

            return $q->row();
}        else{
            return '';
			}
			}
			public function delete_theme($id){
			$this->db->where('theme_id',$id);
			$this->db->delete('holiday_theme');
			//echo $this->db->last_query();exit;
return true;
			}
			public function get_selected_id(){
			$this->db->select('holiday_id,domestic_hol,promotional_hol,recommended_hol,international_hol,Subpage_reccomandation,theme_id');
			$this->db->from('holiday_list');
			$this->db->where('promotional_hol',1);
			$query=$this->db->get();
			if ($query->num_rows() > 0){

            return $query->result();
}        else{
            return '';
			}
			
			}
			public function get_gallery_themes($id){
			$this->db->select('*');
			$this->db->from('gallery_theme');
			if($id != ''){
			$this->db->where('id',$id);
			}
			//$this->db->where('promotional_hol',1);
			$query=$this->db->get();
			if ($query->num_rows() > 0){

            return $query->result();
}        else{
            return '';
			}	
			
			}
			public function edit_gallery_theme($id){
			
			$this->db->select('*');
			$this->db->from('gallery_theme');
			
			$this->db->where('id',$id);
			$query=$this->db->get();
			if ($query->num_rows() > 0){

            return $query->result();
			} else {
            return '';
			}			
			
			}
			
			public function add_gallery_theme($package_name,$package_price,$package_link,$package_desc){
			$data=array(
			'package_name' =>$package_name ,
			'package_desc' => $package_desc,
			'package_price' => $package_price,
			'package_link' => $package_link,
			);
			//$this->db->where('id',$id);
			$this->db->insert('gallery_theme',$data);
			}
			
			public function update_gallery_themes($id,$package_name,$package_price,$package_link,$package_desc){
			$data=array(
			'package_name' =>$package_name ,
			'package_desc' =>$package_desc ,			
			'package_price' => $package_price,
			'package_link' => $package_link,
			);
			$this->db->where('id',$id);
			$this->db->update('gallery_theme',$data);
			}
			
			public function delete_gallery_theme($id){
		//	$data=array();
			$this->db->where('id',$id);
			$this->db->delete('gallery_theme');
			
			}

public function get_all_holi_citylist() {
       
        $this->db->select('*');
        $this->db->from('holi_city');
        $this->db->join('holi_country', 'holi_country.country_id= holi_city.country_id');
        $this->db->where('holi_city.status',1);
        $query = $this->db->get();
        if ($query->num_rows>0) 
            return $query->result();
         else         
            return '';      
        
    }
public function getcontinentId($destcityid)
{
        $this->db->select('holi_continent.continent_id');
        $this->db->from('holi_city');
        $this->db->join('holi_country', 'holi_country.country_id= holi_city.country_id');
        $this->db->join('holi_continent', 'holi_continent.continent_id= holi_country.continent_id');
        $this->db->where('holi_city.city_id',$destcityid);
        $query = $this->db->get();
        if ($query->num_rows>0) 
            return $query->row();
         else         
            return '';   
}
public function getcountryId($destcityid)
{
        $this->db->select('country_id');
        $this->db->from('holi_city');
        $this->db->where('city_id',$destcityid);
        $query = $this->db->get();
        if ($query->num_rows>0) 
            return $query->row();
         else         
            return '';   
}
public function getstateId($destcityid)
{
        $this->db->select('state_id');
        $this->db->from('holi_city');
        $this->db->where('city_id',$destcityid);
        $query = $this->db->get();
        if ($query->num_rows>0) 
            return $query->row();
         else         
            return '';   
}  
public function getdesticity($cityid) {
        $this->db->select('*');
        $this->db->from('holi_city');
        $this->db->where_in('city_id', $cityid);
        //$this->db->group_by('country');
        $query = $this->db->get();
          
        //echo "<pre>";print_r($query->result());exit;
        return $query->result();
    } 
public function get_itinerary($id)
{
   $this->db->select('*');
        $this->db->from('holiday_itinerary_daywise');
        $this->db->where_in('holiday_id', $id);
        $query = $this->db->get();
        return $query->result(); 
} 
public function del_itinerary($id)
{
         $this->db->where('holiday_id', $id);
        $this->db->delete('holiday_itinerary_daywise');
         return true;
}
public function insert_itinerary($data)
{
        $this->db->insert('holiday_itinerary_daywise', $data);
        return true;   
}
public function get_holiday_list_by_id($hol_id){
    $this->db->select('*');
         $this->db->from('holiday_list');
         $this->db->where('holiday_id',$hol_id);
            $query=$this->db->get();
              return $query->row();
    
    }   
    public function holi_booking_report()
    {
       $this->db->select('*');
       $this->db->from('holiday_booking_reports');
        $query=$this->db->get();
         if ($query->num_rows>0) 
            return $query->result();
         else         
            return '';        
    } 

     public function holiday_enquiry_report()
    {
       $this->db->select('*');
       $this->db->from('holiday_enquiry');
       $this->db->order_by('holiday_enquiry_id','desc');
        $query=$this->db->get();
         if ($query->num_rows>0) 
            return $query->result();
         else         
            return '';        
    }
     public function holiday_subscriber()
    {
       $this->db->select('*');
       $this->db->from('holiday_subscribe');
       $this->db->order_by('holiday_subscribe_id','desc');
        $query=$this->db->get();
         if ($query->num_rows>0) 
            return $query->result();
         else         
            return '';        
    }
    public function insert_rates($data){
            $this->db->insert('holiday_pass_rates',$data);
            //return true;
        } 
        public function update_rates($data,$id){
             $this->db->where('holiday_id',$id);
            $this->db->update('holiday_pass_rates',$data);
            
        }
        public function get_holiday_rates($id){
            
            $this->db->select('*');
            $this->db->from('holiday_pass_rates');
            $this->db->where('holiday_id',$id);
            $query=$this->db->get();
            if ($query->num_rows() > 0){
                
                return $query->result();
            } else {
                return '';
            }       
        }


        ///Holiday review 
        public function insert_review_list($data)
        {
             $this->db->insert('holiday_review',$data);     
        }
         public function update_review_list($id,$data){
            $this->db->where('review_id',$id);
            $this->db->update('holiday_review',$data);
            
        }
        public function get_review_list($review_id='',$holiday_id='')
        {
           $this->db->select('*');
            $this->db->from('holiday_review');
            if(!empty($review_id)){
            $this->db->where('review_id',$review_id);
             }
             else if(!empty($holiday_id))
             {
                 $this->db->where('holiday_id',$holiday_id);
             }
            $query=$this->db->get();
            if ($query->num_rows() > 0){
                
                return $query->result();
            } else {
                return '';
            } 
        }
         function set_active_status_holiday_review($id,$active)
           {
             $data = array('isActive' => $active);
            $this->db->where('review_id', $id);
            $this->db->update('holiday_review', $data);
                return true;
           }


    public function update_hotoffer($pr,$status) {
        $data = array(
            'hot_offer' => $status
        );
        $this->db->where('holiday_id', $pr);
        $this->db->update('holiday_list', $data);
    }

        
    public function update_trending_dest($pr,$status) {
        $data = array(
            'trending_dest' => $status
        );
        $this->db->where('holiday_id', $pr);
        $this->db->update('holiday_list', $data);
    }
      public function update_location_dest($pr,$status) {
        $data = array(
            'location_dest' => $status
        );
        $this->db->where('holiday_id', $pr);
        $this->db->update('holiday_list', $data);
    }

    public function update_offbeat_place($pr,$status) {
        $data = array(
            'offbeat_place' => $status
        );
        $this->db->where('holiday_id', $pr);
        $this->db->update('holiday_list', $data);
    }

      public function update_deals($pr,$status) {
        $data = array(
            'deals' => $status
        );
        $this->db->where('holiday_id', $pr);
        $this->db->update('holiday_list', $data);
    }
     public function update_inspiration_place($pr,$status) {
        $data = array(
            'inspiration_place' => $status
        );
        $this->db->where('holiday_id', $pr);
        $this->db->update('holiday_list', $data);
    }
    public function insert_holiday_list($data)
        {
        $this->db->insert('holiday_list', $data);
        return $this->db->insert_id();
        } 
    public  function get_all_holiday_list($status='all',$from_date='',$to_date='',$limit='',$upto='',$linktype='') {
        $this->db->select('*');
         $this->db->from('holiday_list');
          if($status!="all")
        {
          $this->db->where('status', $status);
        }
         if($from_date !=''){
            $this->db->where('start_date >=',date("Y-m-d",strtotime($from_date)));
        }
        if($to_date!=''){
            $this->db->where('start_date <=', date("Y-m-d",strtotime($to_date)));
         }
          if($linktype!="all")
        {
             $this->db->limit($limit,$upto);
        } 
       

      $query = $this->db->get();
    // echo $this->db->last_query();exit;

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }
    public function get_all_activeholiday_list($from_date='',$to_date='',$limit='',$upto='',$linktype=''){
        $this->db->select('*')
                ->from('holiday_list');
        $this->db->where('status', 1);
       if($from_date !=''){
            $this->db->where('start_date >=',date("Y-m-d",strtotime($from_date)));
        }
        if($to_date!=''){
            $this->db->where('start_date <=', date("Y-m-d",strtotime($to_date)));
         }
         if($linktype!="all")
        {
             $this->db->limit($limit,$upto);
        } 
      $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }
    public function updateholidaylist($id,$data)
    {
    $this->db->where('holiday_id', $id);
    $this->db->update('holiday_list', $data); 
    //echo $this->db->last_query();exit;
    return true;  
    }

    //////////
     public function get_holiday_booking($hol_unique)
        {
        $this->db->select('*');
        $this->db->from('holiday_booking_reports');      
        $this->db->where('uniqueRefNo',$hol_unique);
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
        public function get_holiday_pass_info($hol_unique)
        {
        $this->db->select('*');
        $this->db->from('holiday_booking_passenger_info');      
        $this->db->where('uniqueRefNo',$hol_unique);
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
        public function get_holiday_pay_info($hol_unique)
        {
        $this->db->select('*');
        $this->db->from('pay_details_razorpay');      
        $this->db->where('uniqueRefNo',$hol_unique);
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
       public function get_holiday($holiday_id)
      {
          $this->db->select('*');
          $this->db->from('holiday_list');
          $this->db->where('holiday_id',$holiday_id);
          $this->db->where('status','1');
          // $this->db->order_by('priority','ASC');
          $query=$this->db->get();
          return $query->row();
      }

      public function upload_inspiration_images($id,$img){      
         $data = array(
            'inspiration_img_path' => $img,           
            );
        $this->db->where('continent_id',$id);
        $this->db->update('holi_continent', $data);
       return true;
    }
     public function update_inspiration_text($id,$inspiration_header_text,$inspiration_text,$promotional_name=''){      
         $data = array(           
            'inspiration_header_text' => $inspiration_header_text,
            'inspiration_text' => $inspiration_text,
            'promotional_name' => $promotional_name,
            );
        $this->db->where('continent_id',$id);
        $this->db->update('holi_continent', $data);
       return true;
    }
    function insert_banner($bannerurl) { 

        $data = array(
            'banner_id' => '',
            'bannerurl' => $bannerurl,            
            'img_path' => '',            
        );
        $this->db->insert('home_banner', $data);
        return $this->db->insert_id();
    }

     function update_banner_country($data,$id) { 
        $this->db->where('banner_id', $id);
        $this->db->update('home_banner', $data);       
    }

    public function get_banner_images($id='')
    {
        $this->db->select('*');
        $this->db->from('home_banner'); 
        if(!empty($id)){
        $this->db->where('banner_id',$id);    
        }
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
      public function upload_banner_images($id,$img_path){      
         $data = array(
            'img_path' => $img_path,          
            );
        $this->db->where('banner_id',$id);
        $this->db->update('home_banner', $data);
       return true;
    }

     public function set_active_status_home_banner($id,$isActive){      
         $data = array(
            'isActive' => $isActive,          
            );
        $this->db->where('banner_id',$id);
        $this->db->update('home_banner', $data);
       return true;
    }
     /*       Holiday Theme 01/02/2017   */
     public function get_theme_list($id='') {
        $this->db->select('*');
        $this->db->from('holiday_theme');
         if(!empty($id)){
        $this->db->where('theme_id',$id);    
        }
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

    function insert_new_package_theme($data) {
    
        $this->db->insert('holiday_theme', $data);
        return $this->db->insert_id();
    }

public function upload_package_home_category_theme_images($id,$home_category_image)
    {
        $data = array(
            'home_category_image' => $home_category_image,          
            );
        $this->db->where('theme_id',$id);
        $this->db->update('holiday_theme', $data);
       return true;
    }

    public function upload_package_category_theme_images($id,$category_image)
    {
        $data = array(
            'category_image' => $category_image,          
            );
        $this->db->where('theme_id',$id);
        $this->db->update('holiday_theme', $data);
       return true;
    }
    public function update_holiday_package_theme($id,$theme_name)
    {
         $data = array(
            'theme_name' => $theme_name,          
            );
        $this->db->where('theme_id',$id);
        $this->db->update('holiday_theme', $data);
       return true;
    }

     public function set_package_theme_status($id,$isActive){      
         $data = array(
            'isActive' => $isActive,          
            );
        $this->db->where('theme_id',$id);
        $this->db->update('holiday_theme', $data);
       return true;
    }

      public function upload_inspiration_country_images($id,$img){      
         $data = array(
            'country_inspiration_image' => $img,           
            );
        $this->db->where('country_id',$id);
        $this->db->update('holi_country', $data);
       return true;
    }

    public function getcontinentbyID($id)
    {
        $this->db->select('*');
        $this->db->from('holi_country');      
        $this->db->where('country_id',$id);    
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
        else
            return '';
         
    }

      public  function get_hotofferpackagelist() {
          $this->db->select('*');
        $this->db->from('holiday_list');      
        $this->db->where('hot_offer',1);  
            $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public  function get_all_holiday_list_by_order($orderby) {
          $this->db->select('*');
        $this->db->from('holiday_list');      
       $this->db->order_by($orderby,'DESC');
            $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

       public  function get_location_destipackagelist() {
          $this->db->select('*');
        $this->db->from('holiday_list');      
        $this->db->where('location_dest',1);  
            $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public  function get_trenddestipackagelist() {
          $this->db->select('*');
        $this->db->from('holiday_list');      
        $this->db->where('trending_dest',1);  
            $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public  function get_offbeatpackagelist() {
          $this->db->select('*');
        $this->db->from('holiday_list');      
        $this->db->where('offbeat_place',1);  
            $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public  function get_dealspackagelist() {
          $this->db->select('*');
        $this->db->from('holiday_list');      
        $this->db->where('deals',1);  
            $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }


    public function holi_booking_report_details($first_name='',$last_name='',$uniqueRefNo='',$user_mobile='',$from_date='',$to_date='',$package_title='',$user_email='',$booking_status='',$package_code='',$assignto='',$promo_code)
    {
       $this->db->select('*');
       $this->db->from('holiday_booking_reports');
       if($package_title !=''){
        $where = "package_title LIKE '%" . $package_title . "%'";
            $this->db->where($where);
        }
        if($package_code !=''){       
             $this->db->where('package_code',$package_code);
        }
       if($first_name !=''){
            $this->db->where('first_name',$first_name);
        }
        if($last_name !=''){
            $this->db->where('last_name',$last_name);
        }
        if($uniqueRefNo !=''){
            $this->db->where('uniqueRefNo',$uniqueRefNo);
        }
        if($user_mobile !=''){
            $where = "user_mobile LIKE '%" . $user_mobile . "%'";
            $this->db->where($where);
            // $this->db->where('user_mobile',$user_mobile);
        }
         if($user_email !=''){
            $this->db->where('user_email',$user_email);
        }
         if($booking_status !=''){
            $this->db->where('booking_status',$booking_status);
        }
       if($from_date){
            $this->db->where('booking_datetime >=', $from_date);
        }
        if($to_date !=''){
            $this->db->where('booking_datetime <=', $to_date);
        }
        if($assignto !=''){
            $this->db->where('assignto', $assignto);
        }
          if($promo_code !=''){       
            $where = "promo_code LIKE '%" . $promo_code . "%'";
            $this->db->where($where);
        }
        $this->db->order_by('holiday_booking_id','DESC');
        $this->db->limit(100);
        $query=$this->db->get();
         if ($query->num_rows>0) 
            return $query->result();
         else         
            return '';        
    } 

 public function holi_pre_booking_report_details($first_name='',$last_name='',$uniqueRefNo='',$user_mobile='',$from_date='',$to_date='',$package_title='',$user_email='',$booking_status='',$package_code='')
    {
       $this->db->select('*');
       $this->db->from('holiday_pre_booking_report');
       if($package_title !=''){
        $where = "package_title LIKE '%" . $package_title . "%'";
            $this->db->where($where);
        }
        if($package_code !=''){       
             $this->db->where('package_code',$package_code);
        }
       if($first_name !=''){
            $this->db->where('first_name',$first_name);
        }
        if($last_name !=''){
            $this->db->where('last_name',$last_name);
        }
        if($uniqueRefNo !=''){
            $this->db->where('uniqueRefNo',$uniqueRefNo);
        }
        if($user_mobile !=''){
            $this->db->where('user_mobile',$user_mobile);
        }
         if($user_email !=''){
            $this->db->where('user_email',$user_email);
        }
         if($booking_status !=''){
            $this->db->where('booking_status',$booking_status);
        }
       if($from_date){
            $this->db->where('booking_datetime >=', $from_date);
        }
        if($to_date !=''){
            $this->db->where('booking_datetime <=', $to_date);
        }
        $query=$this->db->get();
         if ($query->num_rows>0) 
            return $query->result();
         else         
            return '';        
    } 
    public function cancelholidaybooking($data,$id)
    {
        $this->db->where('holiday_booking_id', $id);
        $this->db->update('holiday_booking_reports', $data);
        return true;
    }

   public function holiday_booking_payment_report($status='',$contact='',$email='',$razorpay_id='',$paid_amount='',$uniqueRefNo='',$card_id='',$from_date='',$to_date='')
    {
        $this->db->select('*');
       $this->db->from('pay_details_razorpay');
       if($status !=''){
        $where = "status LIKE '%" . $status . "%'";
            $this->db->where($where);
        }
       if($contact !=''){
         $where = "contact LIKE '%" . $contact . "%'";
            $this->db->where($where);          
        }
        if($email !=''){
            $this->db->where('email',$email);
        }
        if($razorpay_id !=''){
            $this->db->where('razorpay_id',$razorpay_id);
        }
        if($paid_amount !=''){
            $this->db->where('paid_amount',$paid_amount);
        }
         if($uniqueRefNo !=''){
            $this->db->where('uniqueRefNo',$uniqueRefNo);
        }
         if($card_id !=''){
            $this->db->where('card_id',$card_id);
        }      
       if($from_date){
         $this->db->where('payment_datetime >=', $from_date);
            // $this->db->where('created_at >=', strtotime($from_date));
        }         
        if($to_date !=''){
             $this->db->where('payment_datetime >=', $to_date);
            // $this->db->where('created_at <', strtotime($to_date." +1 day"));
        }
        $this->db->where('service_type',6);
        $this->db->order_by('payment_id','DESC');
        $query=$this->db->get();    
         // echo $this->db->last_query();exit;   
         if ($query->num_rows>0) 
            return $query->result();
         else         
            return '';        
    } 

      public  function get_subadmin() {
          $this->db->select('*');
        $this->db->from('admin_info');      
        $this->db->where('admin_group !=',1);
        $this->db->where('status', 1);  
            $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function update_holiday_booking_report($id,$uniqueRefNo,$data)
    {
        $this->db->where('holiday_booking_id',$id);  
        $this->db->where('uniqueRefNo',$uniqueRefNo);
        $this->db->update('holiday_booking_reports',$data);  
    }

     public function holiday_booking_data()
    {
       $this->db->select('*');
       $this->db->from('holiday_booking_reports');
       $this->db->where('accounting_response',NULL);
        $query=$this->db->get();
         if ($query->num_rows>0) 
            return $query->result();
         else         
            return '';        
    } 
    public function holiday_booking_accounting_response($id,$response)
    {
        $data=array('accounting_response'=>$response);
        $this->db->where('holiday_booking_id',$id);
        $this->db->update('holiday_booking_reports',$data);
    }


    public function holiday_mice_enquiry_report()
    {
       $this->db->select('*');
       $this->db->from('holiday_mice_enquiry');
       $this->db->order_by('holiday_mice_enquiry_id','desc');
        $query=$this->db->get();
         if ($query->num_rows>0) 
            return $query->result();
         else         
            return '';        
    }

     public function get_holiday_list_package_by_id($id) {
        $this->db->select('*');
        $this->db->from('holiday_list');
        $this->db->where('holiday_id', $id);
         $query=$this->db->get();
         if ($query->num_rows>0) 
            return $query->row();
         else         
            return '';   
    }

    public function get_holiday_deals_offer($id){
          $this->db->select('*');
        $this->db->from('deals_offer');
        $this->db->where('holiday_id', $id);
        $this->db->limit(1);
         $query=$this->db->get();
         if ($query->num_rows>0) 
            return $query->row();
         else         
            return '';   
        }

         public function updatedeals_offer($data, $id) {

        $query = $this->db->select('*')->from('deals_offer')->where('holiday_id', $id)->get();

        if ($query->num_rows > 0) {
            $this->db->set('created_datetime', 'NOW()', FALSE);
            $this->db->where('holiday_id', $id);
            $this->db->update('deals_offer', $data);  
            return 1;          
        } else {         
              $data['holiday_id']=$id;
              $this->db->set('created_datetime', 'NOW()', FALSE);
            $this->db->insert('deals_offer', $data);
          return 1;
        }

        

    }


    public function getholivisitcountry($countryid)
    {
        $this->db->select('*');
        $this->db->from('holi_country');
        $this->db->where_in('country_id',$countryid);
        $query=$this->db->get();
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }
        
    }


    public function upload_trending_img($id,$img_path){      
         $data = array(
            'trending_img' => $img_path,          
            );
        $this->db->where('holiday_id',$id);
        $this->db->update('holiday_list', $data);
       return true;
    }


     public function update_trending_section($id,$trending_section) {
        $data = array(
            'trending_section' => $trending_section
        );
        $this->db->where('holiday_id', $id);
        $this->db->update('holiday_list', $data);
    }

     public function upload_location_img($id,$img_path){      
         $data = array(
            'location_img' => $img_path,          
            );
        $this->db->where('holiday_id',$id);
        $this->db->update('holiday_list', $data);
       return true;
    }

      public function getholivisitcity($cityid)
    {
        $this->db->select('*');
        $this->db->from('holi_city');
        $this->db->where_in('city_id',$cityid);
        $query=$this->db->get();
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }
        
    }

                     
}


