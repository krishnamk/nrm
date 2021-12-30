<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Buyers_po_model extends CI_Model{
	function get_buyers_po_excel_list(){
		$this->db->select('a.*,b.customer_name');
		$this->db->from('tbl_buyers_po a');
		$this->db->join('mst_customers b','b.customer_id = a.customer_id');
		$this->db->where('a.status!=',0);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}
	function buyers_po_excel_view($buyers_po_id){
		$this->db->select('*');
		$this->db->from('tbl_buyers_po a');
		$this->db->where('a.buyers_po_id',$buyers_po_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['buyers_po_details'] = $query->row_array();
			$this->db->select('a.*,b.state_name');
			$this->db->from('mst_customers a');
			$this->db->join('mst_state b','b.state_code = a.customer_state');
			$this->db->where('a.customer_id',$data['buyers_po_details']['customer_id']);
			$customer_query = $this->db->get();
			$data['customer_details'] = $customer_query->row_array();
			$this->db->select('*');
			$this->db->from('tbl_buyers_po_relation a');
			$this->db->where('a.buyers_po_id',$buyers_po_id);
			$this->db->where('a.status!=',0);
			$relation_query = $this->db->get();
			$data['relations'] = $relation_query->result_array();
			return $data;
		}else{
			return false;
		}
	}
	
}