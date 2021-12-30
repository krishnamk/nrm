<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Payment_model extends CI_Model{
	//PURCHASE PAYMENT LISTS
	function get_purchase_payment_list(){
		$this->db->select('a.*,b.purchase_number,b.purchase_date,c.supplier_name');
		$this->db->from('tbl_purchase_payments a');
		$this->db->join('tbl_purchase b','b.purchase_id = a.purchase_id');
		$this->db->join('mst_suppliers c','c.supplier_id = a.supplier_id');
		$this->db->where('a.status',1);
		$this->db->where('b.status',1);
		$this->db->order_by('a.created_on','desc');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results =  $query->result_array();
			foreach ($results as $key => $result) {
				$this->db->select('sum(paid_amount) as paid_amount');
				$this->db->from('tbl_purchase_payments_history');
				$this->db->where('purchase_payments_id',$result['purchase_payments_id']); 
				$this->db->where('status',1); 
				$history_query = $this->db->get();
				if($history_query->num_rows() > 0){
					$history = $history_query->row_array();
					$history['paid_amount'] = ($history['paid_amount']!='') ? $history['paid_amount'] : 0 ;
					$balance_amount = $result['purchase_amount'] - $history['paid_amount'];
					$results[$key]['paid_amount'] = $history['paid_amount'];
					$results[$key]['balance_amount'] = $balance_amount;
				}else{
					$results[$key]['paid_amount'] = 0;
					$results[$key]['balance_amount'] = $result['purchase_amount'];
				}
				
			}
			return $results;
		}
	}

	function get_purchase_detail_bills($payments_id){
		$this->db->select('a.*,b.purchase_number,b.purchase_date,c.supplier_id,c.supplier_name');
		$this->db->from('tbl_purchase_payments a');
		$this->db->join('tbl_purchase b','b.purchase_id = a.purchase_id');
		$this->db->join('mst_suppliers c','c.supplier_id = a.supplier_id');
		$this->db->where('a.purchase_payments_id',$payments_id); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result =  $query->row_array();
			$this->db->select('*');
			$this->db->from('tbl_purchase_payments_history');
			$this->db->where('purchase_payments_id',$payments_id); 
			$this->db->where('status',1); 
			$history_query = $this->db->get();
			if($history_query->num_rows() > 0){
				$histories = $history_query->result_array();
				$paid_amount = 0;
				foreach ($histories as $key => $history) { 
					$paid_amount = $paid_amount + $history['paid_amount'];
				}
				$result['paid_amount'] = $paid_amount;
				$result['history'] = $histories;
			}else{
				$result['history'] = array();
				$result['paid_amount'] = 0;
			}
			return $result;
		}else{
			return false;
		}
	}
}