<?php
defined('BASEPATH') or exit('No direct script access allowed');
class logs_model extends CI_Model{
	public function get_all_logs_notification(){
		$this->db->select('*');
		$this->db->from('tbl_log_category a');
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$categories =  $query->result_array();
			foreach ($categories as $key => $category) {
				$this->db->select('*');
				$this->db->from('tbl_logs a');
				$this->db->where('a.log_category_id',$category['log_category_id']);
				if($this->session->userdata('access_level') > 1){
					$this->db->where('user_id',$this->session->userdata('user_id'));
				}
				$this->db->where('a.logs_status',0);
				$this->db->where('a.status',1);
				$log_notification = $this->db->get();
				if($log_notification->num_rows() > 0){
					$categories[$key]['log_notification'] =  $log_notification->result_array();
				}else{
					$categories[$key]['log_notification'] =  false;
				}
			}
			return $categories;
		}else{
			return false;
		}
	}
	function get_logs_details($log_category_id){
		$this->db->select('*');
		$this->db->from('tbl_logs a');
		$this->db->where('a.log_category_id',$log_category_id);
		//$this->db->where('a.logs_status',0);
		$this->db->where('a.status',1);
		$logs = $this->db->get();
		if($logs->num_rows() > 0){
			$log_details =  $logs->result_array();
		}else{
			$log_details = false;
		}
		return $log_details;
	}
	function get_log_counts($log_category_id){
		$this->db->select('count(log_category_id) as count');
		$this->db->from('tbl_logs a');
		$this->db->where('a.log_category_id',$log_category_id);
		$this->db->where('a.logs_status',0);
		if($this->session->userdata('access_level') > 1){
			$this->db->where('a.user_id',$this->session->userdata('user_id'));
		}
		$this->db->where('a.status',1);
		$logs = $this->db->get();
		if($logs->num_rows() > 0){
			$count =  $logs->row_array();
		}else{
			$count = "0";
		}
		return $count;
	}
	
}
