<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model {
	public function user_available($data){
		$this->db->select('a.*');
		$this->db->from('mst_users a');
		$this->db->where('a.user_name',$data['user_name']);
		$this->db->where('a.user_pwd',$data['user_pwd']); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function get_user_details($data){
		$this->db->select('a.*');
		$this->db->from('mst_users a');
		$this->db->where('a.user_name',$data['user_name']);
		$this->db->where('a.user_name',$data['user_pwd']); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row_array();
			return $result;
		}else{
			return false;
		}
	}
	public function user_details($user_id){
		$this->db->select('*');
		$this->db->from('mst_users');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row_array();
			return $result;
		}else{
			return false;
		}

	}
}
/* End of file User_model.php */
/* Location: ./application/models/User_model.php */