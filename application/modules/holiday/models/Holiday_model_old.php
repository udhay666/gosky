<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Holiday_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function search_holiday_package($holiday_type='',$holiday_city='',$tour_type='',$budget='',$theme='',$duration='',$pickUpDate='',$dest_type='',$theme='') {
	//echo '<pre>';print_r($holiday_city);exit;
		$where='';
		if($holiday_type !='')
		{
		$where.=" and holiday_type='$holiday_type'";
		}
		if($holiday_city !='')
		{
            if($dest_type==2){
		$where.=" and FIND_IN_SET('".$holiday_city."',destination)>0 ";
    }elseif($dest_type==1){
     $where.=" and FIND_IN_SET('".$holiday_city."',country)>0 ";   
    }
		}
		if($theme !='')
		{
		$where.=" and FIND_IN_SET('".$theme."',theme_id)>0 ";
		}
        if ($tour_type != '') {

            $dur = $tour_type;
            // if ($dur == 1) {
            //     $where.=" and duration <='3' ";
            // }
            // if ($dur == 2) {
            //     $where.=" and duration between  '4' and '7'";
            // }
            // if ($dur == 3) {
            //     $where.=" and duration between  '8' and '12'";
            // }
            // if ($dur == 4) {
            //     $where.=" and duration > '12' ";
            // }
$where.=" and duration='$dur'";
        }
        if ($budget != '') {


            if ($budget == 1) {


                $where.=" and price  between  '10000' and '20000' ";
            }
            if ($budget == 2) {


                $where.=" and price  between  '20001' and '30000' ";
            }
            if ($budget == 3) {


                $where.=" and price  between  '30001' and '40000' ";
            }
            if ($budget == 4) {


                $where.=" and price  between  '40001' and '50000' ";
            }
            if ($budget == 5) {


                $where.=" and price > '50000' ";
            }
        }
        if($duration !=''){
            $where.="and duration='".$duration."'";}
           
		if($pickUpDate !=''){
			$date= explode("/",$pickUpDate);
			$newDate = $date[2].'-'.$date[1].'-'.$date[0];
           $where.="and start_date <= '".$newDate."'";
            $where.="and end_date >= '".$newDate."'";
		}
			

        $SelQuery = "select * from holiday_list
		                  where status='1' " . $where ." ORDER BY rates ASC";
						 //echo $SelQuery;
        $query = $this->db->query($SelQuery);
        $_SESSION['nopack'] = $query->num_rows();
		//$this->db->limit(0,5);
		//echo $this->db->last_query($query); exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
	function search_holiday_package_fetch($holiday_type,$holiday_city,$tour_type,$budget,$theme,$minPrice, $maxPrice) {
	//echo '<pre>';print_r($holiday_city);exit;
		$where='';
		if($holiday_type !='')
		{
		$where.=" and holiday_type='$holiday_type'";
		}
		if($holiday_city !='')
		{
		$where.=" and FIND_IN_SET('".$holiday_city."',destination)>0 ";
		}
		if($theme !='')
		{
		$where.=" and FIND_IN_SET('".$theme."',theme_id)>0 ";
		}
        if ($tour_type != '') {

            $dur = $tour_type;
            if ($dur == 1) {
                $where.=" and a.duration <='3' ";
            }
            if ($dur == 2) {
                $where.=" and a.duration between  '4' and '7'";
            }
            if ($dur == 3) {
                $where.=" and a.duration between  '8' and '12'";
            }
            if ($dur == 4) {
                $where.=" and a.duration > '12' ";
            }

        }
        if ($budget != '') {


            if ($budget == 1) {


                $where.=" and a.price  between  '100' and '500' ";
            }
            if ($budget == 2) {


                $where.=" and a.price  between  '501' and '1000' ";
            }
            if ($budget == 3) {


                $where.=" and a.price  between  '1001' and '5000' ";
            }
            if ($budget == 4) {
				

                $where.=" and a.price  between  '5001' and '10000' ";
            }
            if ($budget == 5) {


                $where.=" and a.price > '10000' ";
            }
        }


        $SelQuery = "select * from holiday_list a
		                 where a.status='1' " . $where ."";

        //$SelQuery. = "where  a.price BETWEEN '" . $minPrice . "'";
						 //echo $SelQuery;
        $query = $this->db->query($SelQuery);
        $_SESSION['nopack'] = $query->num_rows();
		//$this->db->limit(0,5);
//echo $this->db->last_query($query); exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
	function search_holiday_package_result($holiday_type,$holiday_city,$tour_type,$budget,$theme,$duration,$pickUpDate,$dest_type) {
	//echo '<pre>';print_r($holiday_city);exit;
		$where='';
		if($holiday_type !='')
		{
		
        $this->db->where('holiday_type',$holiday_type);
		}
		if($holiday_city !='')
		{
            if($dest_type==2){
		$where.=" and FIND_IN_SET('".$holiday_city."',destination)>0 ";
    }elseif($dest_type==1){
       $where.=" and FIND_IN_SET('".$holiday_city."',country)>0 "; 
    }
		}
		if($theme !='')
		{
		$where.=" and FIND_IN_SET('".$theme."',theme_id)>0 ";
		}
        if ($tour_type != '') {

            $dur = $tour_type;
            if ($dur == 1) {
                $where.=" and a.duration <='3' ";
            }
            if ($dur == 2) {
                $where.=" and a.duration between  '4' and '7'";
            }
            if ($dur == 3) {
                $where.=" and a.duration between  '8' and '12'";
            }
            if ($dur == 4) {
                $where.=" and a.duration > '12' ";
            }

        }
        if ($budget != '') {


            if ($budget == 1) {


                $where.=" and a.price  between  '10000' and '20000' ";
            }
            if ($budget == 2) {


                $where.=" and a.price  between  '20001' and '30000' ";
            }
            if ($budget == 3) {


                $where.=" and a.price  between  '30001' and '40000' ";
            }
            if ($budget == 4) {


                $where.=" and a.price  between  '40001' and '50000' ";
            }
            if ($budget == 5) {


                $where.=" and a.price > '50000' ";
            }
        }if($duration !=''){
            $where.="and a.duration='".$duration."'";}
			
		if($pickUpDate !=''){
			$date= explode("/",$pickUpDate);

			$newDate = $date[2].'-'.$date[1].'-'.$date[0];
            $where.="and a.start_date <= '".$newDate."'";
            $where.="and a.end_date >= '".$newDate."'";
			
		}
           
        $SelQuery = "select * from holiday_list a
		                 where a.status='1' " . $where ." ";
						 //echo $SelQuery;
        $query = $this->db->query($SelQuery);
        $_SESSION['nopack'] = $query->num_rows();
		//$this->db->limit(0,5);
//echo $this->db->last_query($query); exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

	public function get_all_city_list($search) {
        $where = "city_name LIKE '%" . $search . "%' OR country LIKE '%".$search."%'";
        $this->db->select('*');
        $this->db->from('city_list');
        $this->db->where($where);
        //s$this->db->where('status',1);
        $this->db->order_by('city_name');
        $query = $this->db->get();
//echo $this->db->last_query();
        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }
  public function get_country($search) {
        $where = "city_name LIKE '%" . $search . "%' OR country LIKE '%".$search."%'";
        $this->db->select('*');
        $this->db->from('city_list');
        $this->db->where($where);
        //s$this->db->where('status',1);
        $this->db->order_by('city_name');
        $query = $this->db->get();
//echo $this->db->last_query();
        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

//  public function get_country_for_int_page($search,$continent) {
   
//         $where = "country LIKE '%".$search."%'";
//         $this->db->select('*');
//         $this->db->from('city_list');
//         $this->db->where($where);
//          $this->db->where('continent',$continent);
//         //s$this->db->where('status',1);
     
//         $this->db->order_by('country');
//            $this->db->group_by('country');
//         $query = $this->db->get();
// //echo $this->db->last_query();
//         if ($query->num_rows == '') {
//             return '';
//         } else {
//             return $query->result_array();
//         }
//     }

     public function get_country_for_int_page($continent) {
   
       
        $this->db->select('*');
        $this->db->from('city_list');
        
         $this->db->where('continent',$continent);
        //s$this->db->where('status',1);
     
        $this->db->order_by('country');
           $this->db->group_by('country');
        $query = $this->db->get();
//echo $this->db->last_query();
        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }


    public function get_typebased_city_list($search,$type) {
        $where = "city_name LIKE '%" . $search . "%' OR country LIKE '%".$search."%'";
        $this->db->select('*');
        $this->db->from('city_list');
        $this->db->where($where);
         $this->db->where('city_type',$type);

        //s$this->db->where('status',1);
        $this->db->order_by('city_name');
        $query = $this->db->get();
//echo $this->db->last_query();
        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

  
public function get_typebased_country($search,$type) {
        $where = "city_name LIKE '%" . $search . "%' OR country LIKE '%".$search."%'";
        $this->db->select('*');
        $this->db->from('city_list');
        $this->db->where($where);
        $this->db->where('city_type',$type);
        //s$this->db->where('status',1);
        $this->db->order_by('city_name');
        $query = $this->db->get();
//echo $this->db->last_query();
        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }


	function search_holiday_package1($holiday_type,$holiday_city,$tour_type,$budget,$theme,$perPage,$offset,$dest_type) {
	//echo '<pre>';print_r($holiday_city);exit;
		$where='';
		if($holiday_type !='')
		{
		$where.=" and holiday_type='$holiday_type'";
		}
		if($holiday_city !='')
		{
            if($dest_type==2){
		$where.=" and FIND_IN_SET('".$holiday_city."',destination)>0 ";
    }elseif($dest_type==1){
        $where.=" and FIND_IN_SET('".$holiday_city."',country)>0 ";
       
    }
		}
		if($theme !='')
		{
		$where.=" and FIND_IN_SET('".$theme."',theme_id)>0 ";
		}
        if ($tour_type != '') {

            $dur = $tour_type;
            if ($dur == 1) {
                $where.=" and a.duration <='3' ";
            }
            if ($dur == 2) {
                $where.=" and a.duration between  '4' and '7'";
            }
            if ($dur == 3) {
                $where.=" and a.duration between  '8' and '12'";
            }
            if ($dur == 4) {
                $where.=" and a.duration > '12' ";
            }

        }
        if ($budget != '') {


            if ($budget == 1) {


                $where.=" and a.price  between  '100' and '500' ";
            }
            if ($budget == 2) {


                $where.=" and a.price  between  '501' and '1000' ";
            }
            if ($budget == 3) {


                $where.=" and a.price  between  '1001' and '5000' ";
            }
            if ($budget == 4) {


                $where.=" and a.price  between  '5001' and '10000' ";
            }
            if ($budget == 5) {


                $where.=" and a.price > '10000' ";
            }
        }


        $SelQuery = "select * from holiday_list a
		                 where a.status='1' ".$where."";
						 //echo $SelQuery;
						 //$this->db->limit($perPage, $offset);
						// $this->db->get_where('holiday_list',5, $offset);
        $query = $this->db->query($SelQuery);
        $_SESSION['nopack'] = $query->num_rows();

echo $this->db->last_query($query); exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


	public function get_details($id)
	{
		$this->db->select('*');
		$this->db->from('holiday_list');
		$this->db->where('holiday_id',$id);
		$this->db->where('status',1);
		$query=$this->db->get();
		return $query->row();

	}

	public function get_theme_details($id,$id1)
	{
		$this->db->select('*');
		$this->db->from('holiday_list');
		$this->db->where('theme_id',$id);
		$this->db->where('status',1);
		//$this->db->where("FIND_IN_SET('$id',theme_id) !=", 0);
		$this->db->where('holiday_type',$id1);
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();

	}

	public function get_all_themes($id){
	//echo $id;
		$this->db->select('*');
	$this->db->from('holiday_list');
	$this->db->where('theme_id',$id);
	$this->db->where('status',1);
	$this->db->order_by('priority','ASC');
		$query=$this->db->get();
		if ($query->num_rows > 0) {
		return $query->result();
	}else{
	return false;
	}
	//echo $this->db->last_query();exit;

	}



	function holidaypackages($id,$status) {

        $this->db->select('*')
                ->from('holiday_package')
                ->where('package_type', $id)
                ->where('status',$status);

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

	public function get_city_name($holiday_city)
	{
		 $this->db->select('*');
         $this->db->from('city_list');
         $this->db->where('city_id',$holiday_city);
		 $query=$this->db->get();// echo $this->db->last_query();exit;
		 return $query->row();

	}

	public function imgtumb($id){

	$this->db->select('*');
	$this->db->from('holiday_images');
	$this->db->where('holiday_list_id',$id);
	//$query=$this->db->get('holiday_list',3);
	$this->db->where('img_type',1);
	//$this->db->where('status',1);
	//echo $this->db->last_query();exit;
	$query = $this->db->get();
	if($query->num_rows>0){
		$im=$query->row();
		$url=base_url().'admin/'.$im->holiday_images;
	}else{
	$url=base_url().'public/img/noimage.jpg';
	}
	return $url;
	}
	public function imggell($id){

	$this->db->select('*');
	$this->db->from('holiday_images');
	$this->db->where('holiday_list_id',$id);
	//$query=$this->db->get('holiday_list',3);
	//$this->db->where('status',1);
	$this->db->where('img_type',2);
	//echo $this->db->last_query();exit;
	$query = $this->db->get();
	if($query->num_rows>0){
		$im=$query->result();
		$url=base_url().'admin/'.$im->holiday_images;
	}else{
	$url=base_url().'public/img/noimage.jpg';
	}
	return $url;
	}


	public function get_pack_name($holi_id)
	{
		 $this->db->select('*');
         $this->db->from('holiday_list');
         $this->db->where('holiday_id',$holi_id);
		 $this->db->where('status',1);
		 $this->db->order_by('priority','ASC');
		 $query=$this->db->get();//echo $this->db->last_query();exit;
		 return $query->row();


	}

        public function get_cityname($cityname)
        {

		 $this->db->select('*');
                 $this->db->from('city_list');
                 $this->db->where('city_id',$cityname);
		 $query=$this->db->get();
		 //echo $this->db->last_query();exit;
		 return $query->row();


        }

        public function get_catgname($holiday_category)
        {

		 $this->db->select('*');
                 $this->db->from('holiday_package');
                 $this->db->where('holi_id',$holiday_category);
		 $query=$this->db->get();//echo $this->db->last_query();exit;
		 return $query->row();


        }

		public function gal_images($id){
		//echo $id;exit;
		$this->db->select('*');
                 $this->db->from('holiday_images');
                 $this->db->where('holiday_list_id',$id);
				 $this->db->where('img_type',2);
	//			 $this->db->where('status',1);

		 $query=$this->db->get();//echo $this->db->last_query();exit;
		 if($query->num_rows>0){
		 return $query->result();
		 }else{
		 return false;
		 }

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
	   public function getvisitcity1($desval)
       {
            $this->db->select('*');
            $this->db->from('city_list');
            $this->db->where('city_id',$desval);
			//$this->db->group_by('country');
            $query=$this->db->get();//echo $this->db->last_query();exit;
            return $query->row();
       }

	     public function getcountry($cityid)
       {
            $this->db->select('*');
            $this->db->from('city_list');
            $this->db->where_in('city_id',$cityid);
			$this->db->group_by('country');
            $query=$this->db->get();//echo $this->db->last_query();exit;
            return $query->result();
       }
/// Holiday book
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

		public function get_long_lati($id){
			          $this->db->select('latitude,longitude,city_name');
          $this->db->from('city_list');
		//  $id1=implode(',',$id);
          $this->db->where('city_id',$id);

          $query=$this->db->get();
		  if($query->num_rows > 0){
          return $query->row();
		}else{
		return '';
		}
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

public function holiday_passinfo_report($passinsertdata)
{
	$this->db->insert('holiday_passenger_info',$passinsertdata);
}
public function holiday_booking_report($holibookreport)
{
$this->db->insert('holiday_booking_reports',$holibookreport);
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

public function get_int_hol($id)
{
	$this->db->select('*');
	$this->db->from('holiday_list');
	$this->db->where('holiday_type',$id);
	$this->db->where('status',1);

	$this->db->order_by('priority','ASC');

	$query=$this->db->get();
	//echo $this->db->last_query();exit;
	return $query->result();
}

public function get_dom_hol($id)
{
	$this->db->select('*');
	$this->db->from('holiday_list');
	$this->db->where('holiday_type',$id);
	$this->db->where('status',1);
	$this->db->order_by('priority','ASC');
	$query=$this->db->get();
	return $query->result();
}
public function get_country_name($dest)
{
	$this->db->select('*');
	$this->db->from('city_list');
	$this->db->where_IN('city_id',$dest);
	$q=$this->db->get();
	//echo $this->db->last_query();exit;
	return $q->result();
}
public function get_escort($cname)
{
    $this->db->select('*');
	$this->db->from('holiday_list');
	$this->db->where('country',$cname);
	$this->db->where('status',1);
	$this->db->order_by('priority','ASC');
	$query=$this->db->get();
	return $query->result();

}
public function get_theme_week($id)
{
    $this->db->select('*');
	$this->db->from('holiday_package');
	$this->db->where('package_type',$id);
	$query=$this->db->get();
	return $query->result();

}
public function get_indian_holiday($cid)
{
	$this->db->select('*');
	$this->db->from('holiday_list');
	$this->db->where("FIND_IN_SET('$cid',destination) !=", 0);
	$this->db->where('status',1);
	$this->db->order_by('priority','ASC');
	$query=$this->db->get();
	return $query->result();

}
public function get_hotel_details($hotid)
{
	$this->db->select('*');
	$this->db->from('holiday_hotel_list');
	$this->db->where_in('holiday_hotel_list_id',$hotid);
	//$this->db->where("FIND_IN_SET('$hotid',holiday_hotel_list_id)!=", 0);
	$query=$this->db->get();
	//echo $this->db->last_query();exit;
	return $query->result();



}
public function get_all_hol()
{
	$this->db->select('*');
		$this->db->from('holiday_package');
		$this->db->where('package_type','1');
		$this->db->where('status','1');
		$query=$this->db->get();
		return $query->result();
}
public function get_img($holimgid)
{
	    $this->db->select('*');
		$this->db->from('holiday_images');
		$this->db->where('holiday_list_id',$holimgid);
		$this->db->where('img_type',1);
//		$this->db->where('status',1);
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		  if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';



}
public function get_latlog($dest)
{
	$this->db->select('*');
	$this->db->from('city_list');
	$this->db->where_in('city_id',$dest);
	$this->db->limit('1');

	$query=$this->db->get();
	//echo $this->db->last_query();exit;
	if ($query->num_rows() > 0) {
        $row = $query->row();
		return array('lat' => $row->latitude, 'lng' => $row->longitude);
	} else {
		return array('lat' => 0, 'lng' => 0);
	}


}
public function get_theme_hol($id)
{
    $this->db->select('*');
	$this->db->from('holiday_list');
	$this->db->where("FIND_IN_SET('$id',theme_id) !=", 0);
	$this->db->where('status',1);
	$this->db->order_by('priority','ASC');
	$query=$this->db->get();
	return $query->result();


}
public function get_north()
{
    $this->db->select('*');
	$this->db->from('holiday_list');
	$this->db->where('direction','north');
	$this->db->where('status',1);
	$this->db->order_by('priority','ASC');
	$query=$this->db->get();
	return $query->result();
}
public function get_south()
{
    $this->db->select('*');
	$this->db->from('holiday_list');
	$this->db->where('status',1);
	$this->db->where('direction','south');
	$this->db->order_by('priority','ASC');
	$query=$this->db->get();
	return $query->result();
}
public function get_east()
{
    $this->db->select('*');
	$this->db->from('holiday_list');
	$this->db->where('status',1);
	$this->db->where('direction','east');
	$this->db->order_by('priority','ASC');
	$query=$this->db->get();
	return $query->result();
}
public function get_west()
{
    $this->db->select('*');
	$this->db->from('holiday_list');
	$this->db->where('direction','west');
	$this->db->where('status',1);
	$this->db->order_by('priority','ASC');
	$query=$this->db->get();
	return $query->result();
}
public function get_inter()
{
    $this->db->select('*');
	$this->db->from('holiday_list');
	$this->db->where('holiday_type','1');
	$this->db->where('status',1);
	$this->db->order_by('priority','ASC');
	$query=$this->db->get();
	return $query->result();
}

public function all_holiday()
{
    $this->db->select('*');
	$this->db->from('holiday_list');
	//$this->db->where('Subpage_reccomandation',1);
	$this->db->where('status','1');

	$this->db->order_by('adult_price','ASC');
	//$this->db->limit('4');
	$query=$this->db->get();
	return $query->result();


}
public function get_cruises()
{
    $this->db->select('*');
	$this->db->from('holiday_cruises');
	$this->db->where('status',1);
	//$this->db->limit('4');
	$query=$this->db->get();
	return $query->result();

}
public function get_cruises_dtls($id)
{
    $this->db->select('*');
	$this->db->from('holiday_cruises');
	$this->db->where('cruise_id',$id);
	$this->db->where('status',1);
	$query=$this->db->get();
	return $query->row();


}
public function get_india_cruises()
{
    $this->db->select('*');
	$this->db->from('holiday_cruises');
	$this->db->where('cruise_type',$id);
	$this->db->where('status',1);
	$query=$this->db->get();
	return $query->result();

}
public function get_cr_city($city)
{
    $this->db->select('*');
	$this->db->from('city_list');
	$this->db->where('city_id',$city);
	$query=$this->db->get();
	return $query->row();



}
public function holidaypackages_dest($id)
{
	$this->db->distinct('holiday_id');
    $this->db->select('*');
	$this->db->from('holiday_list');
	$this->db->where('holiday_type',$id);
	$this->db->where('status',1);
	$query=$this->db->get();
	//echo $this->db->last_query();exit;
	return $query->result();
}
public function get_hol_dest($id)
{
	$this->db->distinct('city_id');
    $this->db->select('*');
	$this->db->from('city_list');
	$this->db->where_in('city_id',$id);
	//$this->db->order_by('city_name', 'ASC');
	$query=$this->db->get();
	//echo $this->db->last_query();exit;
	return $query->result();
}
public function holidaypackages_dest_int($id)
{
    $this->db->select('*');
	$this->db->from('holiday_list');
	$this->db->where('holiday_type',$id);
	$this->db->where('status','1');
	$query=$this->db->get();
	//echo $this->db->last_query();exit;
	return $query->result();
}

public function get_hol_dest_int($id)
{
    $this->db->select('*');
	$this->db->from('city_list');
	$this->db->where_in('city_id',$id);
	$query=$this->db->get();
	//echo $this->db->last_query();exit;
	return $query->result();
}

public function get_theme_holiday($id,$id1)
{
    $this->db->select('*');
	$this->db->from('holiday_list');
	$this->db->where('holiday_type',$id1);
	$this->db->where('status',1);
	//$this->db->where('theme_id',$id);
	$this->db->where("FIND_IN_SET('$id',theme_id) !=", 0);
	$query=$this->db->get();
	//echo $this->db->last_query();exit;
	return $query->result();

}

	public function hol_pac_req($pck_ins){
//echo '<pre>';print_r($pck_ins['triptype']);exit;
$this->db->insert('holiday_pac_req', $pck_ins);
$ins = $this->db->insert_id();
//echo '<pre>';print_r($pck_ins['triptype']);exit;
		if($ins){

if($pck_ins['triptype'] == 'Domestic'){
//echo '1';exit;
		$lastboookingid=$ins-1;
		$query=$this->db->select('invoice_number')->from('holiday_pac_req')->where('id',$lastboookingid)->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows>0){
		$bookdata=$query->row();
		$lastinvoice=$bookdata->invoice_number;
		}else{
		$lastinvoice='00000/OD/HOL';
		}
		$re=explode('/',$lastinvoice);

		$re1 = str_pad($re[0]+1, 6, 0, STR_PAD_LEFT);
		$invoice_number=$re1.'/OD/HOL';

		$this->db->where('id',$ins);
		$dataupdate=array('invoice_number' => $invoice_number);
		$this->db->update('holiday_pac_req',$dataupdate);
		//echo $this->db->last_query();exit;
		}else{

		$lastboookingid=$ins-1;
		$query=$this->db->select('invoice_number')->from('holiday_pac_req')->where('id',$lastboookingid)->get();
		if($query->num_rows>0){
		$bookdata=$query->row();
		$lastinvoice=$bookdata->invoice_number;
		}else{
		$lastinvoice='00000/OI/HOL';
		}
		$re=explode('/',$lastinvoice);

		$re1 = str_pad($re[0]+1, 6, 0, STR_PAD_LEFT);
		$invoice_number=$re1.'/OI/HOL';

		$this->db->where('id',$ins);
		$dataupdate=array('invoice_number' => $invoice_number);
		$this->db->update('holiday_pac_req',$dataupdate);
		}
		}
        return $ins;

}

public function enq_holiday_insert($snd_hol_enq){
//print_r($flight_post);exit;
$this->db->insert('enq_holi_enq_request', $snd_hol_enq);
return;

	}
public function flight_pac_req($flight_post){
//print_r($flight_post);exit;
$this->db->insert('flight_enq_request', $flight_post);
return;
}
public function hotel_pac_req($pk_hotel){
//print_r($flight_post);exit;
$this->db->insert('hotel_enq_request', $pk_hotel);
return;
}

public function bus_pac_req($bus_enq){
//print_r($flight_post);exit;
$this->db->insert('bus_enq_request', $bus_enq);
return;
}
public function forex_pac_req($forex_enq){
//print_r($flight_post);exit;
$this->db->insert('forex_pac_req', $forex_enq);
return;
}
public function cruise_pac_req($cruises_enq){
//print_r($flight_post);exit;
$this->db->insert('cruise_pac_req', $cruises_enq);
return;
}
public function mice_pac_req($send_mice_enq){
//print_r($flight_post);exit;
$this->db->insert('mice_pac_req', $send_mice_enq);
return;
}
public function train_pac_req($send_train_enq){
//print_r($flight_post);exit;
$this->db->insert('train_pac_req', $send_train_enq);
return;
}
public function visa_pac_req($send_visa_enq){
//print_r($flight_post);exit;
$this->db->insert('visa_pac_req', $send_visa_enq);
return;
}
public function insurance_pac_req($send_ins_enq){
//print_r($flight_post);exit;
$this->db->insert('insurance_pac_req', $send_ins_enq);
return;
}
public function corporate_pac_req($send_corpt_enq){
//print_r($flight_post);exit;
$this->db->insert('corporate_pac_req', $send_corpt_enq);
return;
}
public function feedback($feedback_details){
//print_r($feedback_details);exit;
$this->db->insert('feedback_pac_req', $feedback_details);
return;
}
public function all_fetch_search_result_old($sess_id,$holiday_category,$holiday_city,$holiday_type='', $offset, $perPage, $minPrice, $maxPrice , $starRating = '', $holidayname = '', $location = '', $sortBy = '', $order = '',$budget,$duration,$pickUpDate) {


		//print_r($holiday_category);exit;
		if($holiday_category == "select Destination"){
		$this->db->select('t.*');
        $this->db->from('holiday_list t');
 if ($budget != '') {


            if ($budget == 1) {


                $where.=" and a.price  between  '10000' and '20000' ";
            }
            if ($budget == 2) {


                $where.=" and a.price  between  '20001' and '30000' ";
            }
            if ($budget == 3) {


                $where.=" and a.price  between  '30001' and '40000' ";
            }
            if ($budget == 4) {


                $where.=" and a.price  between  '40001' and '50000' ";
            }
            if ($budget == 5) {


                $where.=" and a.price > '50000' ";
            }
        }
        if($duration !=''){
            $where.="t.duration = '".$duration."' ";}
           $date= explode("/",$pickUpDate);

$newDate = $date[2].'-'.$date[1].'-'.$date[0];
            $where.=" AND t.start_date <= '".$newDate."'";
            $where.=" AND t.end_date >= '".$newDate."'";




		$this->db->where("t.holiday_type",$holiday_type);
		$this->db->like("t.package_title",$holidayname);
		//$where = "FIND_IN_SET('".$holiday_city."', t.destination)";

                $this->db->where( $where );
       if ($minPrice != '' && $maxPrice != '') {
           $this->db->where('t.price BETWEEN ' . $minPrice . ' AND ' . $maxPrice);
           //$where.="AND a.start_date='".$newDate."' ";
        }
    // echo  $this->db->last_query();exit;
	if ($sortBy != '' && $order != '') {
            if ($sortBy == 'data-price') {
                $this->db->order_by('t.price', strtoupper($order));
            }
             else if ($sortBy == 'data-hotel-name') {
                $this->db->order_by('t.package_title', strtoupper($order));
            } else {
                $this->db->order_by('t.price', 'ASC');
            }
        } else {
            $this->db->order_by('t.price', 'ASC');
        }
        $this->db->limit($perPage, $offset);//echo  $this->db->last_query();exit;
        $query = $this->db->get();


		}
		else{
		$this->db->select('t.*');
        $this->db->from('holiday_list t');
 if ($budget != '') {


            if ($budget == 1) {


                $where.=" and a.price  between  '10000' and '20000' ";
            }
            if ($budget == 2) {


                $where.=" and a.price  between  '20001' and '30000' ";
            }
            if ($budget == 3) {


                $where.=" and a.price  between  '30001' and '40000' ";
            }
            if ($budget == 4) {


                $where.=" and a.price  between  '40001' and '50000' ";
            }
            if ($budget == 5) {


                $where.=" and a.price > '50000' ";
            }
        }
        if($duration !=''){
            $where.="t.duration = '".$duration."' ";}
           $date= explode("/",$pickUpDate);

$newDate = $date[2].'-'.$date[1].'-'.$date[0];
            $where.="and t.start_date <= '".$newDate."'";
            $where.="and t.end_date >= '".$newDate."'";




		$this->db->where("t.holiday_type",$holiday_type);
		$this->db->like("t.package_title",$holidayname);
		//$where = "FIND_IN_SET('".$holiday_city."', t.destination)";

                $this->db->where( $where );
       if ($minPrice != '' && $maxPrice != '') {
           $this->db->where('t.price BETWEEN ' . $minPrice . ' AND ' . $maxPrice);
           //$where.="AND a.start_date='".$newDate."' ";
        }
    // echo  $this->db->last_query();exit;
	if ($sortBy != '' && $order != '') {
            if ($sortBy == 'data-price') {
                $this->db->order_by('t.price', strtoupper($order));
            }
             else if ($sortBy == 'data-hotel-name') {
                $this->db->order_by('t.package_title', strtoupper($order));
            } else {
                $this->db->order_by('t.price', 'ASC');
            }
        } else {
            $this->db->order_by('t.price', 'ASC');
        }
        $this->db->limit($perPage, $offset);//echo  $this->db->last_query();exit;
        $query = $this->db->get();}


        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }

    }
	
	
public function all_fetch_search_result_count($sess_id,$holiday_city,$holiday_category,$holiday_type='', $offset, $perPage, $minPrice = '', $maxPrice = '', $starRating = '', $hotelName = '', $location = '', $sortBy = '', $order = '',$holiday_budget,$holiday_duration,$pickUpDate) {
        if($holiday_category == "select Destination"){
		$this->db->select('t.*');
        $this->db->from('holiday_list t');


 if($duration !=''){
            $where.="t.duration = '".$duration."' ";}
           $date= explode("/",$pickUpDate);

$newDate = $date[2].'-'.$date[1].'-'.$date[0];

             $where.="t.start_date <= '".$newDate."'";
            $where.="and t.end_date >= '".$newDate."'";


		$this->db->where("t.holiday_type",$holiday_type);
		$this->db->like("t.package_title",$holidayname);
		//$where = "FIND_IN_SET('".$holiday_city."', t.destination)";
		 $this->db->where( $where );
        if ($minPrice != '' && $maxPrice != '') {
           $this->db->where('t.price BETWEEN ' . $minPrice . ' AND ' . $maxPrice);
        }
    // echo  $this->db->last_query();exit;
	if ($sortBy != '' && $order != '') {
            if ($sortBy == 'data-price') {
                $this->db->order_by('t.price', strtoupper($order));
            }
             else if ($sortBy == 'data-hotel-name') {
                $this->db->order_by('t.package_title', strtoupper($order));
            } else {
                $this->db->order_by('t.price', 'ASC');
            }
        } else {
            $this->db->order_by('t.price', 'ASC');
        }
        //$this->db->limit($perPage, $offset);//echo  $this->db->last_query();exit;
        $query = $this->db->get();


		}
		else{
		$this->db->select('t.*');
        $this->db->from('holiday_list t');


 if($duration !=''){
            $where.="t.duration = '".$duration."' ";}
           $date= explode("/",$pickUpDate);

$newDate = $date[2].'-'.$date[1].'-'.$date[0];

             $where.="t.start_date <= '".$newDate."'";
            $where.="and t.end_date >= '".$newDate."'";


		$this->db->where("t.holiday_type",$holiday_type);
		$this->db->like("t.package_title",$holidayname);
		$where = "FIND_IN_SET('".$holiday_city."', t.destination)";
		 $this->db->where( $where );
        if ($minPrice != '' && $maxPrice != '') {
           $this->db->where('t.price BETWEEN ' . $minPrice . ' AND ' . $maxPrice);
        }
    // echo  $this->db->last_query();exit;
	if ($sortBy != '' && $order != '') {
            if ($sortBy == 'data-price') {
                $this->db->order_by('t.price', strtoupper($order));
            }
             else if ($sortBy == 'data-hotel-name') {
                $this->db->order_by('t.package_title', strtoupper($order));
            } else {
                $this->db->order_by('t.price', 'ASC');
            }
        } else {
            $this->db->order_by('t.price', 'ASC');
        }
        //$this->db->limit($perPage, $offset);//echo  $this->db->last_query();exit;
        $query = $this->db->get();}


        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }
    }


	public function get_filter_option_details($sess_id) {
	 $hotel_search_data = $this->session->userdata('holiday_search_data');
	//$holiday_type = $hotel_search_data['holiday_type'];
     //   $holiday_city = $hotel_search_data['destination'];
	//	$holiday_duration = $hotel_search_data['duration'];
    //    $holiday_budget = $hotel_search_data['price'];
	//	$holiday_theme = $hotel_search_data['theme_id'];
        $this->db->select('MIN(t.price) as min_price, MAX(t.price) as max_price');
        $this->db->from('holiday_list t');
        //$this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.api=p.api');
     //   $this->db->where('t.holiday_type', $holiday_type);



        $query = $this->db->get();
//echo $this->db->last_query();exit;
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }
   	 public function get_popular_destination() {
        $this->db->select('l.* ,i.*');
        $this->db->from('holiday_list l');
		 $this->db->where('img_type', 1);
        $this->db->join('holiday_images i', 'i.holiday_list_id = l.holiday_id');
		$this->db->group_by('l.holiday_id');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';
    }
	public function get_package_details_prices_type($id,$type,$depart_date, $s_date, $e_date){
	
	//echo $id;exit;
	if($type =='1'){
		$this->db->select('currency,start_date,end_date,standard_single,standard_twin,standard_triple,standard_quad,standard_infant,standard_cwb,standard_cwithoutbed');
		}else if($type=='2'){
		$this->db->select('currency,deluxe_single,deluxe_twin,deluxe_triple,deluxe_quad,deluxe_infant,deluxe_cwb,deluxe_cwithoutbed');
		}else if($type =='3'){
		$this->db->select('currency,premium_single,premium_twin,premium_triple,premium_quad,premium_infant,premium_cwb,premium_cwithoutbed');
		}
                 $this->db->from('holiday_pass_rates');
                 $this->db->where('holiday_id',$id);
                 // $this->db->where($depart_date.' BETWEEN start_date AND end_date', NULL, FALSE);
                 $this->db->where('start_date ',$s_date);
                 $this->db->where('end_date ',$e_date);

		 $query=$this->db->get();
		 // echo $this->db->last_query();
   //       echo '<pre>'; print_r($query->result());
   //       exit;
		 if($query->num_rows>0){
		 return $query->result();
		 }else{
		 return false;
		 }
		 
	}

    public function get_passrate_date($id){
        $this->db->select('start_date,end_date');
        $this->db->from('holiday_pass_rates');
        $this->db->where('holiday_id', $id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        //  return true;
        }else{
            return false;
        }
    }

	 public function get_converted_price($from, $to, $amount) {
        $this->db->select('value as from_val');
        $this->db->from('currency');
        $this->db->where('currency_code', $from);
        $this->db->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $res = $query->row();
            $from_curr = $res->from_val;
        } else {
            $from_curr = 0;
        }

        $this->db->select('value as to_val');
        $this->db->from('currency');
        $this->db->where('currency_code', $to);
        $this->db->limit('1');
        $query1 = $this->db->get();

        if ($query1->num_rows > 0) {
            $res1 = $query1->row();
            $to_curr = $res1->to_val;
        } else {
            $to_curr = 0;
        }

        $currency_val = ($to_curr / $from_curr) * $amount;

        return $currency_val;
    }
	public function insert_rate_currency($session_id,$holiday_id,$package_type,$currency,$convertedprice,$single_price,$twin_price,$triple_price,$quad_price,$infant_price,$cwithbed_price,$cwithoutbed_price,$startdate,$enddate){
	$data=array(
	'session_id'=>$session_id,
	'holiday_id'=>$holiday_id,
    'startdate'=>$startdate,
    'enddate'=>$enddate,	
	'package_type'=>$package_type,
	'currency'=>$currency,
	'convertedprice'=>$convertedprice,
	'single_price'=>$single_price,
	'twin_price'=>$twin_price,
	'triple_price'=>$triple_price,
	'quad_price'=>$quad_price,
	'infant_price'=>$infant_price,
	'cwithbed_price'=>$cwithbed_price,
	'cwithoutbed_price'=>$cwithoutbed_price,	
	);
	$this->db->insert('insert_rate_currency_converted_values',$data);
	
	}
	public function get_conv_prices($session_id,$holiday_id,$startdate,$enddate){
	$this->db->select('*');
	$this->db->from('insert_rate_currency_converted_values');
	$this->db->where('session_id',$session_id);
	$this->db->where('holiday_id',$holiday_id);
    $this->db->where('startdate',$startdate);
    $this->db->where('enddate',$enddate);
	$query=$this->db->get();
	return $query->result();
	}
	public function get_conv_prices_rates($session_id,$holiday_id,$pac_type,$startdate,$enddate){
	$this->db->select('*');
	$this->db->from('insert_rate_currency_converted_values');
	$this->db->where('session_id',$session_id);
	$this->db->where('holiday_id',$holiday_id);
	$this->db->where('package_type',$pac_type);
    $this->db->where('startdate',$startdate);
    $this->db->where('enddate',$enddate);
	
	$query=$this->db->get();
	return $query->result();
	}
	public function check_insert_values($session_id,$holiday_id,$package_type,$currency,$startdate,$enddate){
	$this->db->select('*');
	$this->db->from('insert_rate_currency_converted_values');
	$this->db->where('session_id',$session_id);
	$this->db->where('holiday_id',$holiday_id);
	$this->db->where('package_type',$package_type);
	$this->db->where('currency',$currency);
    $this->db->where('startdate',$startdate);
    $this->db->where('enddate',$enddate);
	
	
	$query=$this->db->get();
	 if ($query->num_rows > 0) {
            return $query->result();
		//	return true;
        }else{
		return false;
		}
	}
	public function check_delete_values($session_id,$holiday_id,$package_type,$currency){
	
	$this->db->where('session_id',$session_id);
	$this->db->where('holiday_id',$holiday_id);
	$this->db->where('package_type',$package_type);
	//$this->db->where('currency',$currency);
	$this->db->delete('insert_rate_currency_converted_values');
	
	}
	
	public function axis_details($payinsert) {
        $this->db->insert('axis_details', $payinsert);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
	public function update_axis_details($Sys_RefNo,$status,$amount,$locale,$batchNo,$command,$message,$cardType,$orderInfo,$receiptNo,$merchantID,$authorizeID,$merchTxnRef,$transactionNo,$acqResponseCode,$txnResponseCode,$verType,$verStatus,$token,$verSecurLevel,$enrolled,$xid,$acqECI,$authStatus){
	$this->db->where('uniqueRefNo',$Sys_RefNo);
	$data=array(
	'status'=>$status,
	'Amount'=>$amount,
	'locale'=>$locale,
	'batchNo'=>$batchNo,
	'command'=>$command,
	'message'=>$message,
	'cardType'=>$cardType,
	'orderInfo'=>$orderInfo,
	'receiptNo'=>$receiptNo,
	'merchantID'=>$merchantID,
	'authorizeID'=>$authorizeID,
	'merchTxnRef'=>$merchTxnRef,
	'transactionNo'=>$transactionNo,
	'acqResponseCode'=>$acqResponseCode,
	'txnResponseCode'=>$txnResponseCode,
	'verType'=>$verType,
	'verStatus'=>$verStatus,
	'token'=>$token,
	'verSecurLevel'=>$verSecurLevel,
	'enrolled'=>$enrolled,
	'xid'=>$xid,
	'acqECI'=>$acqECI,
	'authStatus'=>$authStatus,	 
	);
	$this->db->update('axis_details',$data);
	}
	public function final_report_insert($data){
	
	$this->db->insert('holiday_booking_report',$data);
	return true;
	}
	public function get_availa($id){
			$this->db->select('*');
			$this->db->from('check_holiday_avail');
			$this->db->where('holiday_id',$id);
			$q1 = $this->db->get();
			return $q1->row();
		
		}
	public function get_voucher($id){
			$this->db->select('*');
			$this->db->from('holiday_booking_report');
			$this->db->where('uniqueRefNo',$id);
			$q1 = $this->db->get();
			return $q1->row();
		
		}
	public function holiday_img($id){
			$this->db->select('*');
			$this->db->from('holiday_images');
			$this->db->where('holiday_list_id',$id);
			$q1 = $this->db->get();
			return $q1->result();
		
		}
		public function package_pac_req($send_visa_enq){
			//print_r($flight_post);exit;
			$this->db->insert('holiday_pac_req', $send_visa_enq);
			return;
		}
		
		public function package_call_req($send_visa_enq){
			//print_r($flight_post);exit;
			$this->db->insert('holiday_call_request', $send_visa_enq);
			return;
		}
		public function get_branch(){
			$this->db->select('*');
			$this->db->from('branch_details');
			$q1 = $this->db->get();
			//echo $this->db->last_query();exit;
			return $q1->result();
		}
		
		public function getcity($id)
		{ 
		  
         $this->db->select('*');
         $this->db->from('branch_details');
         $this->db->where('id',$id);
         $query=$this->db->get();
		 //echo $this->db->last_query();
         $res=$query->row();
         return $res;
		}
		
		
	//New sorting query		
	public function all_fetch_search_result($sess_id,$holiday_category,$holiday_city,$holiday_type='', $offset, $perPage, $minPrice, $maxPrice , $sortBy = '', $order = '',$budget,$duration,$pickUpDate,$dest_type,$theme) {
		//echo 123;
		$this->db->select('*');
            $this->db->from('holiday_list');      
            $this->db->where('holiday_type',$holiday_type);
            if($holiday_city !='')
        {
            if($dest_type==2){
        $where="FIND_IN_SET('".$holiday_city."',destination)>0 ";
        $this->db->where($where);
    }elseif($dest_type==1){
     $where="FIND_IN_SET('".$holiday_city."',country)>0 "; 
     $this->db->where($where);  
    }
    
        }

        if($theme !='')
        {
        $where1="FIND_IN_SET('".$theme."',theme_id)>0 ";
        $this->db->where($where1); 
        }

		
		if($minPrice != '' && $maxPrice != '')
			{
				//$this->db->where('price BETWEEN '.$minPrice.' AND '.$maxPrice);
            }
		if($sortBy != '' && $order != '')
            {
                if($sortBy == 'data-hotel-name') 
                {
                    $this->db->order_by('package_title', strtoupper($order));
                }
                else if($sortBy == 'data-price') 
                {
                    $this->db->order_by('rates', strtoupper($order));
                }
                else if($sortBy == 'data-duration') 
                {
                    $this->db->order_by('duration_prior', strtoupper($order));
                }
				else
                {
                    $this->db->order_by('rates','ASC');   
                }
            }
            else
            {
                $this->db->order_by('rates','ASC');   
            }
		//$this->db->limit($perPage,$offset);
            $this->db->where('status','1');
		 $query = $this->db->get();
           // echo $this->db->last_query();exit;
		//print_r($holiday_category);exit;
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }

    }
    public function get_all_duration($city_id='',$country=''){
        $this->db->select('duration');
        $this->db->from('holiday_list');
     
        if(!empty($city_id)){
          
            $where = "FIND_IN_SET('".$city_id."', destination)";   
            $this->db->where($where);
        }
       if(!empty($country)){
       
            $where = "FIND_IN_SET('".$country."', country)"; 
            $this->db->where($where);  
        }
      
        $this->db->distinct('duration');
        $this->db->order_by('duration_prior','ASC');
      $query=$this->db->get();
      
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }
    }
    public function get_theme_by_id($theme_id){
        $this->db->select('*');
        $this->db->from('holiday_theme');
        $this->db->where('theme_id',$theme_id);
        $query=$this->db->get();
        if($query->num_rows()==0){
            return '';
        }else{
            return $query->row();
        }
    }
    public function get_indain_duration(){
        $where = "FIND_IN_SET('India', country)";  
        $this->db->select('duration');
        $this->db->from('holiday_list');
        $this->db->where($where);
        $this->db->distinct('duration');
        $this->db->order_by('duration_prior','ASC');
        $query=$this->db->get();
        if($query->num_rows()==0){
            return '';
        }else{
            return $query->result();
        }
    }
    public function get_holiday_theme($type){

        $this->db->select('*');
        $this->db->from('holiday_theme');
      //  $this->db->where('theme_type',$type);
        $query=$this->db->get();
        if($query->num_rows()==0){
            return '';
        }else{
            return $query->result();
        }
    }
public function get_all_continents(){
      $this->db->select('continent');
        $this->db->from('country');
        $this->db->where('continent !=','NULL');
     $this->db->distinct('continent');
     $this->db->order_by('continent','ASC');
        $query=$this->db->get();
        if($query->num_rows()==0){
            return '';
        }else{
            return $query->result();
        } 
}
    public function get_banners(){

        $this->db->select('*');
        $this->db->from('holiday_banners');
        $query=$this->db->get();
        if($query->num_rows()==0){
            return '';
        }else{
            return $query->result();
        }
    }


    public function get_package_details_prices_type2($id,$depart_date, $s_date, $e_date){

        $this->db->select('currency,start_date,end_date,standard_single,standard_twin,standard_triple,deluxe_single,deluxe_twin,deluxe_triple,premium_single,premium_twin,premium_triple');

        $this->db->from('holiday_pass_rates');
        $this->db->where('holiday_id',$id);
        $this->db->where('start_date ',$s_date);
        $this->db->where('end_date ',$e_date);
        $query=$this->db->get();
        if($query->num_rows>0){
            return $query->result();
        }else{
            return false;
        }
         
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




////////////////////////////////New////////////////////////////////////////////////////
function search_holiday_package_results_old($destiId='',$linktype='',$holiday_duration='',
                                         $themeVal='',$minPrice='', $maxPrice='',$minDur='',$maxDur='',
                                        $minRating='',$maxRating='',$minTemp='',$maxTemp='',
                                        $categoryVal='',$regionVal='',$sortBy='', $order='') {
    //echo '<pre>';print_r($holiday_city);exit;
        $where='';
        $queryStr='';
        $queryStr.=' select * from  holiday_list where ';
         if($destiId==''&& $linktype==''&& $holiday_duration==''&& $themeVal)
        {
             $themequery="";
          $themeVal_arr=explode(',', $themeVal);
          for ($i=0; $i <count($themeVal_arr) ; $i++) { 
         if($i==0 && count($themeVal_arr)==1)
             $themequery.="   ( FIND_IN_SET('".$themeVal_arr[$i]."',theme_id)>0 ) ";
         else{
           if($i==0)
             $themequery.="   ( FIND_IN_SET('".$themeVal_arr[$i]."',theme_id)>0  or ";
           else if(($i+1)==count($themeVal_arr)) 
                 $themequery.="FIND_IN_SET('".$themeVal_arr[$i]."',theme_id)>0 ) ";
             else
            $themequery.="FIND_IN_SET('".$themeVal_arr[$i]."',theme_id)>0 or ";
         }
          }
          // $this->db->where($themequery);
           $queryStr.=$themequery;
        }
        if($linktype==1)
        {
        $queryStr.=" ( FIND_IN_SET('".$destiId."',destination)>0 ) and ";
       
        }
         if($linktype==2)
        {
       $queryStr.=" ( FIND_IN_SET('".$destiId."',state)>0 ) and ";
       
        }
         if($linktype==3)
        {
       $queryStr.=" ( FIND_IN_SET('".$destiId."',country)>0 ) and ";
       
        }
         if($linktype==4 && empty($regionVal))
        {
            $queryStr.=" ( FIND_IN_SET('".$destiId."',continent)>0 ) and ";
           
        }
       if($linktype==4 && !empty($regionVal))
        {
         $regquery="";
          $regionVal_arr=explode(',', $regionVal);
          for ($i=0; $i <count($regionVal_arr) ; $i++) { 
            if($i==0 && count($regionVal_arr)==1){
             $regquery.="  ( FIND_IN_SET('".$regionVal_arr[$i]."',continent)>0 ) and ";
            }
         else{
           if($i==0)
             $regquery.="  ( FIND_IN_SET('".$regionVal_arr[$i]."',continent)>0  or ";
           else if(($i+1)==count($regionVal_arr)) 
                 $regquery.="  FIND_IN_SET('".$regionVal_arr[$i]."',continent)>0 ) and ";
             else
            $regquery.="FIND_IN_SET('".$regionVal_arr[$i]."',continent)>0 or ";
           }
            // $this->db->where($regquery);
           
         
        }
        $queryStr.=$regquery;
        }
        if($linktype==5 && $destiId=='dom')
        {
            $queryStr.=" ( FIND_IN_SET('12',country)>0 ) and ";  
        }
        if($linktype==5 && $destiId=='int')
        {
             $queryStr.=" ( FIND_IN_SET('12',country)=0 ) and ";  
        }
         if(!empty($holiday_duration))
        {
            $durquery="";
          $holiday_duration_arr=explode(',', $holiday_duration);
          for ($i=0; $i <count($holiday_duration_arr) ; $i++) { 
            if($i==0 && count($holiday_duration_arr)==1)
             $durquery.=" ( FIND_IN_SET('".$holiday_duration_arr[$i]."',month_dur)>0 )";
         else{
           if($i==0)
             $durquery.="  ( FIND_IN_SET('".$holiday_duration_arr[$i]."',month_dur)>0  or ";
           else if(($i+1)==count($holiday_duration_arr)) 
                 $durquery.="FIND_IN_SET('".$holiday_duration_arr[$i]."',month_dur)>0 ) ";
             else
            $durquery.="FIND_IN_SET('".$holiday_duration_arr[$i]."',month_dur)>0 or ";
           }
           // $this->db->where($durquery);  
          
        }
         $queryStr.=$durquery;
    }  
       
           
        

     if($linktype!=4 && !empty($regionVal))
        {
         $regquery=" ";
          $regionVal_arr=explode(',', $regionVal);
          for ($i=0; $i <count($regionVal_arr) ; $i++) { 
            if($i==0 && count($regionVal_arr)==1)
             $regquery.=" and ( FIND_IN_SET('".$regionVal_arr[$i]."',continent)>0 ) ";
         else{
           if($i==0)
             $regquery.=" and ( FIND_IN_SET('".$regionVal_arr[$i]."',continent)>0  or ";
           else if(($i+1)==count($regionVal_arr)) 
                 $regquery.="FIND_IN_SET('".$regionVal_arr[$i]."',continent)>0 ) ";
             else
            $regquery.="FIND_IN_SET('".$regionVal_arr[$i]."',continent)>0 or ";
           }
            // $this->db->where($regquery);
          
         
        }
         $queryStr.=$regquery;
    }  
       
         if ($minPrice != '' && $maxPrice != '' && $maxPrice>0) {
           $queryStr.= " and (" .'price BETWEEN ' . $minPrice . ' AND ' . $maxPrice. " ) ";
          
         
        }
        if ($minDur != '' && $maxDur != '' && $maxDur>0) {
         $queryStr.=" and (" .'duration BETWEEN ' . $minDur . ' AND ' . $maxDur." ) ";
         
          }
         if ($minTemp != '' && $maxTemp != '') {
         $queryStr.=" and (" .'temperature BETWEEN ' . $minTemp . ' AND ' . $maxTemp." ) ";
       
          
        }
        if($categoryVal)
        {
             $catquery="";
        $categoryVal_arr=explode(',', $categoryVal);        
         for ($i=0; $i <count($categoryVal_arr) ; $i++) { 
          if($i==0 && count($categoryVal_arr)==1)
             $catquery.=" and ( FIND_IN_SET('".$categoryVal_arr[$i]."',category)>0 ) ";
         else{
           if($i==0)
             $catquery.=" and  ( FIND_IN_SET('".$categoryVal_arr[$i]."',category)>0 or ";
           else if(($i+1)==count($categoryVal_arr)) 
                 $catquery.="FIND_IN_SET('".$categoryVal_arr[$i]."',category)>0 ) ";
             else
            $catquery.="FIND_IN_SET('".$categoryVal_arr[$i]."',category)>0 or ";
    }
    }
    // $this->db->where($catquery);
    $queryStr.=$catquery;
      
        }
       
      if($destiId!=''&& $linktype!=''&& $holiday_duration!=''&& $themeVal)
              {
            $themequery="";
          $themeVal_arr=explode(',', $themeVal);
          for ($i=0; $i <count($themeVal_arr) ; $i++) { 
         if($i==0 && count($themeVal_arr)==1)
             $themequery.=" and  ( FIND_IN_SET('".$themeVal_arr[$i]."',theme_id)>0 ) ";
         else{
           if($i==0)
             $themequery.=" and  ( FIND_IN_SET('".$themeVal_arr[$i]."',theme_id)>0  or ";
           else if(($i+1)==count($themeVal_arr)) 
                 $themequery.="FIND_IN_SET('".$themeVal_arr[$i]."',theme_id)>0 ) ";
             else
            $themequery.="FIND_IN_SET('".$themeVal_arr[$i]."',theme_id)>0 or ";
         }
          }
          // $this->db->where($themequery);
           $queryStr.=$themequery;
                    
        }
      $queryStr.= " and " .'status = 1 ';
       
        if($sortBy&&$order)
        {
            if($sortBy=='data-price')
            {
                 // $this->db->order_by('price',strtoupper($order));
                 $queryStr.= " order by " .'price '.strtoupper($order);
             }
            if($sortBy=='data-duration')
            {
                 // $this->db->order_by('duration',strtoupper($order));
                 $queryStr.= " order by " .'duration '.strtoupper($order);
             }
            if($sortBy=='data-recent'){
                 // $this->db->order_by('start_date',strtoupper($order));
              $queryStr.= " order by " .'start_date '.strtoupper($order);
          }

        }
        else
        {
           $this->db->order_by('price','ASC');   
            $queryStr.= " order by " .'price '.' ASC';
        }
   
       $query = $this->db->query($queryStr);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }
function search_holiday_package_results($destiId='',$linktype='',$holiday_duration='',
                                         $themeid='',$searchheader='') {
        $this->db->select('*');
        $this->db->from('holiday_list');
        if(!empty($searchheader))
        {
            $where = "(package_title LIKE '%".mysql_real_escape_string($searchheader)."%')";
             $this->db->where($where);
        }
         if(!empty($themeid))
        {
             $this->db->where("FIND_IN_SET('".$themeid."',theme_id)>",0); 
        }
        if($linktype==1)
        {
             $this->db->where("FIND_IN_SET('".$destiId."', destination)>",0); 
        }
         if($linktype==2)
        {
             $this->db->where("FIND_IN_SET('".$destiId."', state)>",0);              
        }
         if($linktype==3)
        {
             $this->db->where("FIND_IN_SET('".$destiId."', country)>",0);            
        }
         if($linktype==4)
        {
             $this->db->where("FIND_IN_SET('".$destiId."',continent)>",0);
         }
         if($linktype==5 && $destiId=='dom')
        {
            $this->db->where("FIND_IN_SET('12',country)>",0);     
        }
        if($linktype==5 && $destiId=='int')
        {
            $this->db->where("FIND_IN_SET('12',country)=",0);
         }
         if(!empty($holiday_duration))
        {
             $this->db->where("FIND_IN_SET('".$holiday_duration."',month_dur)>",0);  
         } 
         $this->db->where('status',1);
        $this->db->order_by('price','ASC');         
        $query = $this->db->get(); 
        // echo $this->db->last_query();
        // // // // echo "<br>limit=".$limit." "." upto=".$upto;
        // exit;
         if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }
    public function search_holiday_package_filter_results($destiId='',$linktype='',$holiday_duration='',$themeVal='',$minPrice='', $maxPrice='',$minDur='',$maxDur='',$minRating='',$maxRating='',$categoryVal='',$regionVal='',$sortBy='', $order='',$searchheader)
    {
        $this->db->select('*');
        $this->db->from('holiday_list');
         if(!empty($searchheader))
        {
            $where = "(package_title LIKE '%".mysql_real_escape_string($searchheader)."%')";
             $this->db->where($where);
        }
         if(!empty($themeVal))
         {  
            $where='';
             $themeVal_arr=explode(',', $themeVal);
             if(count($themeVal_arr)>1)
             {
               $where.="( FIND_IN_SET('".$themeVal_arr[0]."',theme_id)>0";           
              for ($i=1; $i <(count($themeVal_arr)-1) ; $i++) 
             {
                $where.=" or FIND_IN_SET('".$themeVal_arr[$i]."',theme_id)>0";
             }
              $where.=" or FIND_IN_SET('".$themeVal_arr[$i]."',theme_id)>0 )";
              $this->db->where($where);
             }
             else{
              $this->db->where("FIND_IN_SET('".$themeVal_arr[0]."',theme_id)>",0); 
              }  
         }       
         if($linktype==1)
         {
             $this->db->where("FIND_IN_SET('".$destiId."', destination)>",0); 
         }
         if($linktype==2)
         {
             $this->db->where("FIND_IN_SET('".$destiId."', state)>",0);              
         }
         if($linktype==3)
         {
             $this->db->where("FIND_IN_SET('".$destiId."', country)>",0);            
         }
          if($linktype==4 && empty($regionVal))
         {
             $this->db->where("FIND_IN_SET('".$destiId."',continent)>",0);
         }
         if($linktype==5 && $destiId=='dom')
         {
            $this->db->where("FIND_IN_SET('12',country)>",0);     
         }
         if($linktype==5 && $destiId=='int')
         {
            $this->db->where("FIND_IN_SET('12',country)=",0);
         }
        if($linktype==4 && !empty($regionVal))
        {   
            $where='';
            $regionVal_arr=explode(',', $regionVal); 
            if(count($regionVal_arr)>1)
             {
               $where.="( FIND_IN_SET('".$regionVal_arr[0]."',continent)>0";           
              for ($i=1; $i <(count($regionVal_arr)-1) ; $i++) 
             {
                $where.=" or FIND_IN_SET('".$regionVal_arr[$i]."',continent)>0";
             }
              $where.=" or FIND_IN_SET('".$regionVal_arr[$i]."',continent)>0 )";
              $this->db->where($where);
             }
             else{
              $this->db->where("FIND_IN_SET('".$regionVal_arr[0]."',continent)>",0); 
              }                
         
        }
         if($linktype!=4 && !empty($regionVal))
        {
            $where='';
            $regionVal_arr=explode(',', $regionVal); 
            if(count($regionVal_arr)>1)
             {
               $where.="( FIND_IN_SET('".$regionVal_arr[0]."',continent)>0";           
              for ($i=1; $i <(count($regionVal_arr)-1) ; $i++) 
             {
                $where.=" or FIND_IN_SET('".$regionVal_arr[$i]."',continent)>0";
             }
              $where.=" or FIND_IN_SET('".$regionVal_arr[$i]."',continent)>0 )";
              $this->db->where($where);
             }
             else{
              $this->db->where("FIND_IN_SET('".$regionVal_arr[0]."',continent)>",0); 
              }
        }
        if(!empty($holiday_duration))
        {
            $where='';
            $holiday_duration_arr=explode(',', $holiday_duration); 
            if(count($holiday_duration_arr)>1)
             {
               $where.="( FIND_IN_SET('".$holiday_duration_arr[0]."',month_dur)>0";           
              for ($i=1; $i <(count($holiday_duration_arr)-1) ; $i++) 
             {
                $where.=" or FIND_IN_SET('".$holiday_duration_arr[$i]."',month_dur)>0";
             }
              $where.=" or FIND_IN_SET('".$holiday_duration_arr[$i]."',month_dur)>0 )";
              $this->db->where($where);
             }
             else{
              $this->db->where("FIND_IN_SET('".$holiday_duration_arr[0]."',month_dur)>",0); 
              }
         }
         if(!empty($categoryVal))
        {
            $where='';
            $categoryVal_arr=explode(',', $categoryVal); 
            if(count($categoryVal_arr)>1)
             {
               $where.="( FIND_IN_SET('".$categoryVal_arr[0]."',category)>0";           
              for ($i=1; $i <(count($categoryVal_arr)-1) ; $i++) 
             {
                $where.=" or FIND_IN_SET('".$categoryVal_arr[$i]."',category)>0";
             }
              $where.=" or FIND_IN_SET('".$categoryVal_arr[$i]."',category)>0 )";
              $this->db->where($where);
             }
             else{
              $this->db->where("FIND_IN_SET('".$categoryVal_arr[0]."',category)>",0); 
              }
          }
                 
       if ($minPrice != '' && $maxPrice != '' && $maxPrice>0) {
            $this->db->where("price BETWEEN $minPrice AND $maxPrice");
       }
        if ($minDur != '' && $maxDur != '' && $maxDur>0) {
             $this->db->where("duration BETWEEN $minDur AND $maxDur");
          } 
           if ($minRating != '' && $maxRating != '' && $maxRating>0) {
             $this->db->where("package_rating BETWEEN $minRating AND $maxRating");
          }       
        $this->db->where('status',1);       
        if($sortBy&&$order)
        {
            if($sortBy=='data-price')
            {
                 $this->db->order_by('price',strtoupper($order)); 
            }
            if($sortBy=='data-duration')
            {
                 $this->db->order_by('duration',strtoupper($order)); 
            }
            if($sortBy=='data-recent'){
                 $this->db->order_by('start_date',strtoupper($order));   
              }
          if($sortBy=='data-pol'){
                 $this->db->order_by('package_popularity',strtoupper($order));   
              }
          if($sortBy=='data-rating'){
                 $this->db->order_by('package_rating',strtoupper($order));   
              }
         }
        else
        {
            $this->db->order_by('price','ASC');   
        }  
        $query = $this->db->get(); 
         // echo $this->db->last_query();
        // // echo "<br>limit=".$limit." "." upto=".$upto;
        // exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function get_min_max_price($destiId='',$linktype='',$holiday_duration='',$theme_id='',$searchheader='') {

      $this->db->select('MIN(t.price) as min_price, MAX(t.price) as max_price');
      $where='';
      if(!empty($searchheader))
        {
            $where = "(package_title LIKE '%".mysql_real_escape_string($searchheader)."%')";
             $this->db->where($where);
        }
        if($linktype==1)
        {
        $where="FIND_IN_SET('".$destiId."',t.destination)>0";
        $this->db->where($where);
        }
         if($linktype==2)
        {
        $where="FIND_IN_SET('".$destiId."',t.state)>0";
        $this->db->where($where);
        }
         if($linktype==3)
        {
        $where="FIND_IN_SET('".$destiId."',t.country)>0";
        $this->db->where($where);
        }
         if($linktype==4)
        {
        $where="FIND_IN_SET('".$destiId."',t.continent)>0";
        $this->db->where($where);
        }
         if($linktype==5 && $destiId=='dom')
        {
            $where="FIND_IN_SET('12',country)>0"; 
             $this->db->where($where); 
        }
        if($linktype==5 && $destiId=='int')
        {
             $where="FIND_IN_SET('12',country)=0";
             $this->db->where($where);   
        }
        if($holiday_duration)
        {
          $where="FIND_IN_SET('".$holiday_duration."',t.month_dur)>0 "; 
          $this->db->where($where);  
        }
        if($theme_id)
        {
          $where="FIND_IN_SET('".$theme_id."',t.theme_id)>0 "; 
          $this->db->where($where);    
        }
      $this->db->where('status',1);
      $this->db->from('holiday_list t');
      $query = $this->db->get();
      if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }
    public function get_min_max_duration($destiId='',$linktype='',$holiday_duration='',$theme_id='',$searchheader='') {

      $this->db->select('MIN(t.duration) as min_dur, MAX(t.duration) as max_dur');
      $where='';
      if(!empty($searchheader))
        {
            $where = "(package_title LIKE '%".mysql_real_escape_string($searchheader)."%')";
             $this->db->where($where);
        }
        if($linktype==1)
        {
        $where="FIND_IN_SET('".$destiId."',t.destination)>0";
        $this->db->where($where);
        }
         if($linktype==2)
        {
        $where="FIND_IN_SET('".$destiId."',t.state)>0";
        $this->db->where($where);
        }
         if($linktype==3)
        {
        $where="FIND_IN_SET('".$destiId."',t.country)>0";
        $this->db->where($where);
        }
         if($linktype==4)
        {
        $where="FIND_IN_SET('".$destiId."',t.continent)>0";
        $this->db->where($where);
        }
         if($linktype==5 && $destiId=='dom')
        {
            $where="FIND_IN_SET('12',country)>0"; 
             $this->db->where($where); 
        }
        if($linktype==5 && $destiId=='int')
        {
             $where="FIND_IN_SET('12',country)=0";
             $this->db->where($where);   
        }
        if($holiday_duration)
        {
          $where="FIND_IN_SET('".$holiday_duration."',t.month_dur)>0 "; 
          $this->db->where($where);  
        }
         if($theme_id)
        {
          $where="FIND_IN_SET('".$theme_id."',t.theme_id)>0 "; 
          $this->db->where($where);    
        }
        $this->db->where('status',1);
      $this->db->from('holiday_list t');

      $query = $this->db->get();
      if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    } 

   

    
    public function get_continent_name($id)
    {
         $this->db->select('*');
          $this->db->from('holi_continent');
          $this->db->where('continent_id',$id); 
         $query = $this->db->get();
      if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }

    } 
     public function get_continentlist()
    {
         $this->db->select('*');
          $this->db->from('holi_continent');
          $query = $this->db->get();
      if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }

    } 
     public function get_holiday_theme_list()
    {
         $this->db->select('*');
          $this->db->from('holiday_theme');
           $this->db->where_in('isActive', 1);
          $query = $this->db->get();
      if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }

    }
    public function get_itinerary($id,$duration)
 {
       
   $this->db->select('*');
        $this->db->from('holiday_itinerary_daywise');
        $this->db->where_in('holiday_id', $id);
       // $this->db->where('day_no <=', $duration);
         $this->db->order_by('day_no','ASC');
        $query = $this->db->get();
        return $query->result(); 
}

function insert_holiday_enquiry($data)
{
   $this->db->insert('holiday_enquiry',$data); 
    return $this->db->insert_id();
} 

public function check_holiday_enquiry_id($id) {
    $this->db->select('holiday_enquiry_id');
    $this->db->from('holiday_enquiry');
    $this->db->where('holiday_enquiry_id', $id);
    $query = $this->db->get();
    // echo $this->db->last_query();exit;
    if ($query->num_rows() == 0) {
        return ''; 
    } else {
       return $query->row();
    }
}

function insert_holiday_subscribe($data)
{
   $this->db->insert('holiday_subscribe',$data); 
   return true;
}
function check_holiday_subscriber($email)
{
   $where = "(user_email LIKE '%".$email."%')";
   $this->db->select('*');
   $this->db->from('holiday_subscribe');            
   $this->db->where($where);
   $query=$this->db->get();
    if ($query->num_rows() == 0) {
            return false;
        } else {
            return true;
        }  
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

      public function get_holiday_review_list($id)
        {
        $this->db->select('*');
        $this->db->from('holiday_review');      
        $this->db->where('holiday_id',$id);
        $this->db->where('isActive',1);
        $this->db->order_by('created_at','DESC');
        $this->db->limit(4);
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
       public function get_holiday_pass_rate($holiday_id)
       {
            $this->db->select('*');
            $this->db->from('holiday_pass_rates');
            $this->db->where_in('holiday_id',$holiday_id);
            $query=$this->db->get();
             if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }
       }
 public function get_country_fulllist() {
    $where = "(name NOT LIKE 'India')";
        $this->db->select('*');
         $this->db->from('country');
         $this->db->where($where);
        $query = $this->db->get();
        //$this->db->limit(0,5);
        // echo $this->db->last_query($query); exit;
        if ($query->num_rows > 0) {
            return $query->result();
        }
        
        return false;
    }
    public function get_package_list($search)
    {       
        $where = "(package_title LIKE '%".$search."%')";

        $this->db->select('*');

        $this->db->from('holiday_list');            

        $this->db->where($where);
        $this->db->where('status',1);
        $this->db->order_by('package_title');   
        // $this->db->limit(5);             
         $query = $this->db->get();        

        if($query->num_rows =='')

        {

            return '';

        }

        else

        {

            return $query->result_array();

        }

    }

    public function get_img_holi_details($holidayid,$img_type,$lt)
    {
         $this->db->select('*');
        $this->db->from('holiday_images');
        $this->db->where('holiday_list_id', $holidayid);
        $this->db->where('img_type', $img_type);
        $this->db->limit($lt);   
        $query=$this->db->get(); 
         // echo $this->db->last_query();exit;     
          if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';

    }


public function update_holiday_pre_booking_report($uniqueRefNo,$user_email,$data)
    {
     $this->db->where('uniqueRefNo', $uniqueRefNo);
     $this->db->where('user_email', $user_email);
     $this->db->update('holiday_pre_booking_report',$data);
    }

    public function insert_holiday_mice_enquiry($data)
    {
       $this->db->insert('holiday_mice_enquiry',$data); 
       return true;
    } 
}
