<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common_model extends CI_Model {
	function gets($table,$where=''){
		if($where!=''){
			$this->db->where($where);
		}
		$query = $this->db->get($table);
		if( $query->num_rows() > 0 ){
			return $query->result();
		}else{
			return false;
		}
	}
	function gets_groupby($table,$where='',$group_by){
		if($where!=''){
			$this->db->where($where);
		}
		$this->db->group_by($group_by);
		$query = $this->db->get($table);
		if( $query->num_rows() > 0 ){
			return $query->result();
		}else{
			return false;
		}
	}
	function gets_array($table,$where=''){
		if($where!=''){
			$this->db->where($where);
		}
		$query = $this->db->get($table);
		if( $query->num_rows() > 0 ){
			return $query->result_array();
		}else{
			return false;
		}
	}
	function get($table,$where){
		if($where!=''){
			$this->db->where($where);
		}
		$query = $this->db->get($table);
		if( $query->num_rows() > 0 ){
			return $query->row();
		}else{
			return false;
		}
	}
	function get_array($table,$where){
		if($where!=''){
			$this->db->where($where);
		}
		$query = $this->db->get($table);
		if( $query->num_rows() > 0 ){
			return $query->row_array();
		}else{
			return false;
		}
	}
	function get_particular($table,$where,$column){
		if($where!=''){
			$this->db->where($where);
		}
		$query = $this->db->get($table);
		if( $query->num_rows() > 0 ){
			return $query->row($column);
		}else{
			return false;
		}
	}
	function insert($table,$data){
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}
	function update($table,$data,$where=''){
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		if($where!=''){
			$this->db->where($where);
		}
		$this->db->update($table,$data);
		$this->db->trans_complete(); 
		if($this->db->trans_status() === FALSE){
			return false;
		}else{
			return true;
		}
	}
	function remove($table,$where=''){
		if(($where!='')||(!empty($where))){
			$this->db->where($where);
		}
		$this->db->delete($table);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	function delete($table,$data,$where=''){
		$this->db->trans_start();
		if($where!=''){
			$this->db->where($where);
		}
		$this->db->update($table,$data);
		$this->db->trans_complete();        
		if($this->db->trans_status() === FALSE)
		{
			$response = array(
				'message' => "Unable to Delete",
				'status' => false
			);
		}else{
			if($this->db->affected_rows() > 0)
			{
				$response = array(
					'message' => "Deleted successfully",
					'status' => true
				);
			}
			else
			{
				$response = array(
					'message' => "Deleted successfully",
					'status' => true
				);
			}
		}
		return $response;
	}
	function count($table,$where=''){
		if($where!=''){
			$this->db->where($where);
		}
		$query = $this->db->get($table);
		return  $query->num_rows();
	}
	function sum($table,$where='',$field,$fieldas=''){
		$this->db->select('SUM('.$field.') as '.$fieldas);
		if($where!=''){
			$this->db->where($where);
		}
		$query = $this->db->get($table);
		return  $query->row($fieldas);
	}
	function truncate($table){
		$this->db->truncate($table);
		return true;
	}
	function exists($table,$where=''){
		if($where!=''){
			$this->db->where($where);
		}
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	function gets_array_orderby($table,$where='',$order_by_field='',$sort_type='ASC'){
		if($where!=''){
			$this->db->where($where);
		}
		if($order_by_field!=''){
			$this->db->order_by($order_by_field,$sort_type);
		}
		$query = $this->db->get($table);
		if( $query->num_rows() > 0 ){
			return $query->result_array();
		}else{
			return false;
		}
	}
	function multi_user_display($users,$field = 'name'){
		$CI =& get_instance();
		$names = array();
		if($users != ''){
			$CI->db->where('status',1);
			$query = $CI->db->get('mst_users');
			if($query->num_rows() > 0){
				$results = $query->result_array();
				foreach ($results as $key => $result) {
					if(in_array($result['user_id'],explode(',',$users))){
						array_push($names, $result[$field]);
					}
				}
			}
		}
		return implode(',', $names);
	}
}
/* End of file Common_model.php */
/* Location: ./application/models/Common_model.php */