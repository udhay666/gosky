<?php

if (!defined('BASEPATH'))

    exit('No direct script access allowed');





class Holiday_Model extends CI_Model {



    public function __construct() {

        parent::__construct();

    }



   

        //$this->db->where('month_dur',$monthOfTravel);

    function search_holiday_package_result($fromCity,$monthOfTravel) {

        

        $this->db->select('*');

        $this->db->from('holiday_list');

        $this->db->where('destination',$fromCity);       

         $this->db->where("FIND_IN_SET('$monthOfTravel',month_dur) !=", 0);        

        $this->db->where('status',1);        

        $query = $this->db->get();

       

         if ($query->num_rows() == '') {

            return '';

        } else {

            return $query->result();

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

    public function search_holiday_details($holiday_id,$itinerary_id)

    {

        $this->db->select('*');

        $this->db->from('holiday_itinerary_daywise');

        $this->db->where('holiday_id',$holiday_id);

        $this->db->where('itinerary_id',$itinerary_id);        

        $query=$this->db->get();

        return $query->row();



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



    public function insert_holiday_enquiry($data){

    //print_r($flight_post);exit;

    $this->db->insert(' holiday_enquiry', $data);

    // echo $this->db->last_query();exit;     

    return;

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

        if($query->num_rows()>0){

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

        if($query->num_rows()>0){

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

}

