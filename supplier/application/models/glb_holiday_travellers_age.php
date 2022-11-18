<?php 

class glb_holiday_travellers_age extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function add_age($data){
		$this->db->insert('travelers_age',$data);
	}

	public function get_age(){
		$this->db->select('*');
		$this->db->from('travelers_age');
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			return $query->result();
		} else {
			return '';
		}
	}

	public function getAgeById($id){
		$this->db->select('*');
		$this->db->from('travelers_age');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		} else {
			return '';
		}
	}

	public function updateAge($id,$data){
		$this->db->where('id',$id);
		$this->db->update('travelers_age',$data);
	}

	public function update_Age_status(){
        $id = $_GET['id'];
        $status = $_GET['status'];
        // print_r($status);exit;
        if($status == 1){
            $status = 0;
        } else {
            $status = 1;
        }
        $data = array(
            'status' => $status
        );
        $this->db->where('id',$id);
        if($this->db->update('travelers_age',$data)){
            return true;
        }
        return false;
    }

}


?>