<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Accounts_model extends CI_Model {	
	public function get_sales_receipt_list($data = array()){
		$this->db->select('a.*,b.customer_name,b.customer_phone');
		$this->db->from('tbl_receipts a');
		$this->db->join('mst_customers b','a.customer_id = b.customer_id');
		if(!empty($data)){
			if($data['customer_id'] != ""){
				$this->db->where('a.customer_id',$data['customer_id']);
			}
			if(isset($data['date_from'])){
				if(($data['date_from'] !='')&&($data['date_to'] !='')){
					$this->db->where('a.receipt_date >=',$data['date_from']);
					$this->db->where('a.receipt_date <=',$data['date_to']);
				}
			}
		}
		$this->db->where('a.status',1);
		$list_query = $this->db->get();
		if($list_query->num_rows() > 0 ){
			$results = $list_query->result_array();
			return $results;
		}else{
			return false;
		}
	}
	public function get_sales_receipt_details($receipt_id){
		$this->db->select('a.*,b.customer_name');
		$this->db->from('tbl_receipts a');
		$this->db->join('mst_customers b','a.customer_id = b.customer_id');
		$this->db->where('a.receipt_id',$receipt_id);
		$this->db->where('a.status',1);
		$receipt_view_query = $this->db->get();
		if($receipt_view_query->num_rows() > 0){
			$result = $receipt_view_query->row_array();
			return $result;
		}else{
			return false;
		}
	}

	//Purchase Payment
	public function get_purchase_payment_list($data = array()){
		$this->db->select('a.*,b.supplier_name,b.supplier_phone');
		$this->db->from('tbl_payments a');
		$this->db->join('mst_suppliers b','a.supplier_id = b.supplier_id');
		if(!empty($data)){
			if($data['supplier_id'] != ""){
				$this->db->where('a.supplier_id',$data['supplier_id']);
			}
			if(isset($data['date_from'])){
				if(($data['date_from'] !='')&&($data['date_to'] !='')){
					$this->db->where('a.payment_date >=',$data['date_from']);
					$this->db->where('a.payment_date <=',$data['date_to']);
				}
			}
		}
		$this->db->where('a.status',1);
		$list_query = $this->db->get();
		if($list_query->num_rows() > 0 ){
			$results = $list_query->result_array();
			return $results;
		}else{
			return false;
		}
	}
	public function get_purchase_payment_details($payment_id){
		$this->db->select('a.*,b.supplier_name');
		$this->db->from('tbl_payments a');
		$this->db->join('mst_suppliers b','a.supplier_id = b.supplier_id');
		$this->db->where('a.payment_id',$payment_id);
		$this->db->where('a.status',1);
		$payment_view_query = $this->db->get();
		if($payment_view_query->num_rows() > 0){
			$result = $payment_view_query->row_array();
			return $result;
		}else{
			return false;
		}
	}
	//JOURNAL
	public function get_journal_details($journal_id){
		$this->db->select('a.*');
		$this->db->from('tbl_journals a');
		$this->db->where('a.journal_id',$journal_id);
		$this->db->where('a.status',1);
		$receipt_view_query = $this->db->get();
		if($receipt_view_query->num_rows() > 0){
			$result = $receipt_view_query->row_array();
			if($result['supplier_id'] != 0){
					$result['supplier_name'] = $this->common->get_particular('mst_suppliers',array('supplier_id' => $result['supplier_id'] ),'supplier_name');
				}
				if($result['customer_id'] != 0){
					$result['customer_name'] = $this->common->get_particular('mst_customers',array('customer_id' => $result['customer_id'] ),'customer_name');
				}
			return $result;
		}else{
			return false;
		}
	}
	public function get_journal_list($data = array()){
		//echo "<pre>";print_r($data);exit;
		$this->db->select('a.*');
		$this->db->from('tbl_journals a');
		if(!empty($data)){
			if(($data['journal_type'] != "")){
				$this->db->where('a.journal_type',$data['journal_type']);
			}
			if(($data['journal_type'] == "customer")&&($data['customer_id'] != "")){
				$this->db->where('a.customer_id',$data['customer_id']);
			}
			if(($data['journal_type'] == "supplier")&&($data['supplier_id'] != "")){
				//echo "<pre>";print_r($data);exit;
				$this->db->where('a.supplier_id',$data['supplier_id']);
			}
			if(isset($data['date_from'])){
				if(($data['date_from'] !='')&&($data['date_to'] !='')){
					$this->db->where('a.journal_date >=',$data['date_from']);
					$this->db->where('a.journal_date <=',$data['date_to']);
				}
			}
		}
		$this->db->where('a.status',1);
		$list_query = $this->db->get();
		if( $list_query->num_rows() > 0 ){
			$results = $list_query->result_array();
			//echo "<pre>";print_r($results);exit;
			foreach ($results as $key => $result) {
				if($result['supplier_id'] != 0){
					$results[$key]['supplier_name'] = $this->common->get_particular('mst_suppliers',array('supplier_id' => $result['supplier_id'] ),'supplier_name');
					$results[$key]['supplier_mobile'] = $this->common->get_particular('mst_suppliers',array('supplier_id' => $result['supplier_id'] ),'supplier_mobile');
				}
				if($result['customer_id'] != 0){
					$results[$key]['customer_name'] = $this->common->get_particular('mst_customers',array('customer_id' => $result['customer_id'] ),'customer_name');
					$results[$key]['customers_mobile'] = $this->common->get_particular('mst_customers',array('customer_id' => $result['customer_id'] ),'customers_mobile');
				}
			}
			return $results;
		}else{
			return false;
		}
	}
}
