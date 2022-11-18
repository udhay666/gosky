<?php 

class  Glb_holiday_travellers_type extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function add_type($data){
		if($this->db->insert('travelers_type',$data)){
            return true;
        }
        return false;
	}

	public function get_type(){
		$this->db->select('*');
		$this->db->from('travelers_type');
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			return $query->result();
		} else {
			return '';
		}
	}

	public function getTypeById($id){
		$this->db->select('*');
		$this->db->from('travelers_type');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		} else {
			return '';
		}
	}

	public function updateType($id,$data){
		$this->db->where('id',$id);
		if($this->db->update('travelers_type',$data)){
            return true;
        }
        return false;
	}

	public function update_Type_status(){
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
        if($this->db->update('travelers_type',$data)){
            return true;
        }
        return false;
    }

    function delete($table,$primaryid,$id) {
        $this->db->where($primaryid, $id);
        $this->db->delete($table);
        return true;
    }

}


?>