<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model {
	public function get_user_list($user_id){
		$this->db->select('a.*');
		$this->db->from('mst_users a');
		//$this->db->where('a.access_level',2);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array(); 
			return $results;
		}else{
			return false;
		}
	}
	function get_company_list(){
		$this->db->select('a.company_name');
		$this->db->from('company_details a');
		$this->db->where('a.company_status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array(); 
			return $results;
		}else{
			return false;
		}
	}
	function get_user_details(){
		if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){
			$this->db->select('a.*');
			$this->db->from('mst_users a');
			$this->db->where('a.status',1);
			$query = $this->db->get();
			if($query->num_rows() > 0 ){
				return $query->result_array();
			}else{
				return false;
			}
		}else{
			$this->db->select('a.*,b.company_name,b.company_location');
			$this->db->from('mst_users a');
			$this->db->join('company_details b','b.company_id = a.company_id');
			$this->db->where('a.status',1);
			$this->db->where('b.company_status',1);
			$query = $this->db->get();
			if($query->num_rows() > 0 ){
				return $query->result_array();
			}else{
				return false;
			}
		}
		
	}
	function get_invoice_payments_details(){
		$this->db->select('sum(invoice_amount) as invoice_total');
		$this->db->from('tbl_invoice_payments');
		$this->db->where('status!=',0);
		$this->db->where('company_id',$this->session->userdata('company_id'));
		$this->db->group_by('company_id');
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			return implode($query->row_array());
		}else{
			return false;
		}
	}
	function get_invoice_pending_payments_details(){
		$this->db->select('sum(b.invoice_amount) as invoice_total');
		$this->db->from('tbl_invoice_payments a');
		$this->db->join('tbl_invoice_payments_history b','b.invoice_payments_id = a.invoice_payments_id');
		$this->db->where('b.status!=',0);
		$this->db->where('b.company_id',$this->session->userdata('company_id'));
		$this->db->group_by('b.company_id');
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			return implode($query->row_array());
		}else{
			return false;
		}
	}
	function get_invoice_payments_detail($date_from,$date_to){
		$this->db->select('sum(invoice_amount) as invoice_total');
		$this->db->from('tbl_invoice_payments');
		$this->db->where('status!=',0);
		if(isset($date_from)){
			if(($date_from !='')&&($date_to !='')){
				$this->db->where('created_on >=',$date_from);
				$this->db->where('created_on <=',$date_to);
			}
		}
		$this->db->where('company_id',$this->session->userdata('company_id'));
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			return implode($query->row_array());
		}else{
			return 0;
		}
	}
	function get_invoice_pending_payments_detail($date_from,$date_to){
		$this->db->select('sum(b.invoice_amount) as invoice_total');
		$this->db->from('tbl_invoice_payments a');
		$this->db->join('tbl_invoice_payments_history b','b.invoice_payments_id = a.invoice_payments_id');
		$this->db->where('b.status!=',0);
		$this->db->where('b.company_id',$this->session->userdata('company_id'));
		if(isset($date_from)){
			if(($date_from !='')&&($date_to !='')){
				$this->db->where('b.created_on >=',$date_from);
				$this->db->where('b.created_on <=',$date_to);
			}
		}
		$this->db->where('a.company_id',$this->session->userdata('company_id'));
		$this->db->group_by('b.company_id');
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			return implode($query->row_array());
		}else{
			return 0;
		}
	}
	function get_invoice_list(){
		$this->db->select('a.invoice_id,a.invoice_number,a.invoice_date,b.customer_name');
		$this->db->from('tbl_invoices a');
		$this->db->join('mst_customers b','a.invoice_customer = b.customer_id');
		$this->db->where('a.invoice_approved',1);
		$this->db->order_by('a.invoice_id','desc');
		if($this->session->userdata('access_level') != 1){
			$this->db->where('a.company_id',$this->session->userdata('company_id'));
		}
		$this->db->limit('5');
		$query = $this->db->get();
		if ($query->num_rows() > 0 ) {
			$results = $query->result_array();
			foreach ($results as $key => $result) {
				$this->db->select('SUM(a.total) as invoice_total,b.invoice_status');
				$this->db->from('tbl_invoices_relation a'); 
				$this->db->join('tbl_invoice_payments b','a.invoice_id = b.invoice_id');
				$this->db->where('a.invoice_id',$result['invoice_id']);
				$this->db->where('a.status',1);
				$relation_query = $this->db->get();
				if($relation_query->num_rows() > 0){
					$invoice_relation = $relation_query->row_array();
					if($invoice_relation['invoice_total']!=""){
						$results[$key]['invoice_total'] = $invoice_relation['invoice_total'];
						$results[$key]['payment_status'] = $invoice_relation['invoice_status'];
					}else{
						$results[$key]['invoice_total'] = 0;
						$results[$key]['payment_status'] = $invoice_relation['invoice_status'];
					}
				}else{
					$results[$key]['invoice_total'] = 0;
				}
				$this->db->select('b.payment_type,b.balance_amount');
				$this->db->from('tbl_invoice_payments a'); 
				$this->db->join('tbl_invoice_payments_history b','a.invoice_payments_id = b.invoice_payments_id');
				$this->db->where('a.invoice_id',$result['invoice_id']);
				$this->db->where('a.status',1);
				$payment_query = $this->db->get();
				if($payment_query->num_rows() > 0){
					$payment_history = $payment_query->row_array();
					if($payment_history['payment_type']!=""){
						$results[$key]['payment_type'] = $payment_history['payment_type'];
					}
				}else{
					$results[$key]['payment_type'] = 0;
				}
			}
			return $results;
		} else {
			return false;
		}
	}

	function get_invoice_lists($date_from,$date_to){
		$this->db->select('a.invoice_id,a.invoice_number,a.invoice_date,b.customer_name');
		$this->db->from('tbl_invoices a');
		$this->db->join('mst_customers b','a.invoice_customer = b.customer_id');
		$this->db->where('a.invoice_approved',1);
		$this->db->order_by('a.invoice_id','desc');
		if(isset($date_from)){
			if(($date_from !='')&&($date_to !='')){
				$this->db->where('a.invoice_date >=',$date_from);
				$this->db->where('a.invoice_date <=',$date_to);
			}
		}
		if($this->session->userdata('access_level') != 1){
			$this->db->where('a.company_id',$this->session->userdata('company_id'));
		}
		$this->db->limit('5');
		$query = $this->db->get();
		if ($query->num_rows() > 0 ) {
			$results = $query->result_array();
			foreach ($results as $key => $result) {
				$this->db->select('SUM(a.total) as invoice_total,b.invoice_status');
				$this->db->from('tbl_invoices_relation a'); 
				$this->db->join('tbl_invoice_payments b','a.invoice_id = b.invoice_id');
				$this->db->where('a.invoice_id',$result['invoice_id']);
				$this->db->where('a.status',1);
				$relation_query = $this->db->get();
				if($relation_query->num_rows() > 0){
					$invoice_relation = $relation_query->row_array();
					//echo '<pre>';print_r($relation_query->result_array());exit;
					if($invoice_relation['invoice_total']!=""){
						$results[$key]['invoice_total'] = $invoice_relation['invoice_total'];
						$results[$key]['payment_status'] = $invoice_relation['invoice_status'];
					}else{
						$results[$key]['invoice_total'] = 0;
						$results[$key]['payment_status'] = $invoice_relation['invoice_status'];
					}
				}else{
					$results[$key]['invoice_total'] = 0;
				}
				$this->db->select('b.payment_type,b.balance_amount');
				$this->db->from('tbl_invoice_payments a'); 
				$this->db->join('tbl_invoice_payments_history b','a.invoice_payments_id = b.invoice_payments_id');
				$this->db->where('a.invoice_id',$result['invoice_id']);
				$this->db->where('a.status',1);
				$payment_query = $this->db->get();
				if($payment_query->num_rows() > 0){
					$payment_history = $payment_query->row_array();
					if($payment_history['payment_type']!=""){
						$results[$key]['payment_type'] = $payment_history['payment_type'];
					}
				}else{
					$results[$key]['payment_type'] = 0;
				}
			}
			return $results;
		} else {
			return false;
		}
	}

	function invoice_count($date_from,$date_to){
		$this->db->select('count(a.invoice_id) as total_invoice');
		$this->db->from('tbl_invoices a');
		$this->db->where('a.status!=',0);
		$this->db->order_by('a.invoice_id','desc');
		if(isset($date_from)){
			if(($date_from !='')&&($date_to !='')){
				$this->db->where('a.invoice_date >=',$date_from);
				$this->db->where('a.invoice_date <=',$date_to);
			}
		}
		if($this->session->userdata('access_level') != 1){
			$this->db->where('a.company_id',$this->session->userdata('company_id'));
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0 ) {
			return implode($query->row_array());
		}else{
			return 0;		 
		}
	}
	function dc_count($date_from,$date_to){
		$this->db->select('count(a.dc_id) as total_dcs');
		$this->db->from('tbl_dcs a');
		$this->db->where('a.status!=',0);
		$this->db->order_by('a.dc_id','desc');
		if(isset($date_from)){
			if(($date_from !='')&&($date_to !='')){
				$this->db->where('a.dc_date >=',$date_from);
				$this->db->where('a.dc_date <=',$date_to);
			}
		}
		if($this->session->userdata('access_level') != 1){
			$this->db->where('a.company_id',$this->session->userdata('company_id'));
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0 ) {
			return implode($query->row_array());
		}else{
			return 0;		 
		}
	}
	function estimate_count($date_from,$date_to){
		$this->db->select('count(a.estimate_id) as total_estimates');
		$this->db->from('tbl_estimates a');
		$this->db->where('a.status!=',0);
		$this->db->order_by('a.estimate_id','desc');
		if(isset($date_from)){
			if(($date_from !='')&&($date_to !='')){
				$this->db->where('a.estimate_date >=',$date_from);
				$this->db->where('a.estimate_date <=',$date_to);
			}
		}
		if($this->session->userdata('access_level') != 1){
			$this->db->where('a.company_id',$this->session->userdata('company_id'));
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0 ) {
			return implode($query->row_array());
		}else{
			return 0;		 
		}
	}
	function purchase_count($date_from,$date_to){
		$this->db->select('count(a.purchase_id) as total_purchases');
		$this->db->from('tbl_purchase a');
		$this->db->where('a.status!=',0);
		$this->db->order_by('a.purchase_id','desc');
		if(isset($date_from)){
			if(($date_from !='')&&($date_to !='')){
				$this->db->where('a.purchase_date >=',$date_from);
				$this->db->where('a.purchase_date <=',$date_to);
			}
		}
		if($this->session->userdata('access_level') != 1){
			$this->db->where('a.company_id',$this->session->userdata('company_id'));
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0 ) {
			return implode($query->row_array());
		}else{
			return 0;		 
		}
	}
	function quotation_count($date_from,$date_to){
		$this->db->select('count(a.quotation_id) as total_quotations');
		$this->db->from('tbl_quotations a');
		$this->db->where('a.status!=',0);
		$this->db->order_by('a.quotation_id','desc');
		if(isset($date_from)){
			if(($date_from !='')&&($date_to !='')){
				$this->db->where('a.quotation_date >=',$date_from);
				$this->db->where('a.quotation_date <=',$date_to);
			}
		}
		if($this->session->userdata('access_level') != 1){
			$this->db->where('a.company_id',$this->session->userdata('company_id'));
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0 ) {
			return implode($query->row_array());
		}else{
			return 0;		 
		}
	}
	function product_count($date_from,$date_to){
		$this->db->select('count(a.product_id) as total_products');
		$this->db->from('mst_products a');
		$this->db->where('a.status!=',0);
		$this->db->order_by('a.product_id','desc');
		if(isset($date_from)){
			if(($date_from !='')&&($date_to !='')){
				$this->db->where('a.created_on >=',$date_from);
				$this->db->where('a.created_on <=',$date_to);
			}
		}
		if($this->session->userdata('access_level') != 1){
			$this->db->where('a.company_id',$this->session->userdata('company_id'));
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0 ) {
			return implode($query->row_array());
		}else{
			return 0;		 
		}
	}
	function customer_count($date_from,$date_to){
		$this->db->select('count(a.customer_id) as total_customers');
		$this->db->from('mst_customers a');
		$this->db->where('a.status!=',0);
		$this->db->order_by('a.customer_id','desc');
		if(isset($date_from)){
			if(($date_from !='')&&($date_to !='')){
				$this->db->where('a.created_on >=',$date_from);
				$this->db->where('a.created_on <=',$date_to);
			}
		}
		if($this->session->userdata('access_level') != 1){
			$this->db->where('a.company_id',$this->session->userdata('company_id'));
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0 ) {
			return implode($query->row_array());
		}else{
			return 0;		 
		}
	}
	function supplier_count($date_from,$date_to){
		$this->db->select('count(a.supplier_id) as total_suppliers');
		$this->db->from('mst_suppliers a');
		$this->db->where('a.status!=',0);
		$this->db->order_by('a.supplier_id','desc');
		if(isset($date_from)){
			if(($date_from !='')&&($date_to !='')){
				$this->db->where('a.created_on >=',$date_from);
				$this->db->where('a.created_on <=',$date_to);
			}
		}
		if($this->session->userdata('access_level') != 1){
			$this->db->where('a.company_id',$this->session->userdata('company_id'));
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0 ) {
			return implode($query->row_array());
		}else{
			return 0;		 
		}
	}

	//PURCHASE
	function get_purchase_payments_details(){
		$this->db->select('sum(purchase_amount) as purchase_total');
		$this->db->from('tbl_purchase_payments');
		$this->db->where('status!=',0);
		$this->db->where('company_id',$this->session->userdata('company_id'));
		$this->db->group_by('company_id');
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			return implode($query->row_array());
		}else{
			return false;
		}
	}
	function get_purchase_pending_payments_details(){
		$this->db->select('sum(b.purchase_amount) as purchase_total');
		$this->db->from('tbl_purchase_payments a');
		$this->db->join('tbl_purchase_payments_history b','b.purchase_payments_id = a.purchase_payments_id');
		$this->db->where('b.status!=',0);
		$this->db->where('b.company_id',$this->session->userdata('company_id'));
		$this->db->group_by('b.company_id');
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			return implode($query->row_array());
		}else{
			return false;
		}
	}
	function get_purchase_payments_detail($date_from,$date_to){
		$this->db->select('sum(purchase_amount) as purchase_total');
		$this->db->from('tbl_purchase_payments');
		$this->db->where('status!=',0);
		if(isset($date_from)){
			if(($date_from !='')&&($date_to !='')){
				$this->db->where('created_on >=',$date_from);
				$this->db->where('created_on <=',$date_to);
			}
		}
		$this->db->where('company_id',$this->session->userdata('company_id'));
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			return implode($query->row_array());
		}else{
			return 0;
		}
	}
	function get_purchase_pending_payments_detail($date_from,$date_to){
		$this->db->select('sum(b.purchase_amount) as purchase_total');
		$this->db->from('tbl_purchase_payments a');
		$this->db->join('tbl_purchase_payments_history b','b.purchase_payments_id = a.purchase_payments_id');
		$this->db->where('b.status!=',0);
		$this->db->where('b.company_id',$this->session->userdata('company_id'));
		if(isset($date_from)){
			if(($date_from !='')&&($date_to !='')){
				$this->db->where('b.created_on >=',$date_from);
				$this->db->where('b.created_on <=',$date_to);
			}
		}
		$this->db->where('a.company_id',$this->session->userdata('company_id'));
		$this->db->group_by('b.company_id');
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			return implode($query->row_array());
		}else{
			return 0;
		}
	}
	function get_purchase_order_details(){
		$this->db->select('a.purchase_order_id,a.purchase_order_date,b.supplier_name,sum(c.amount) as total,a.purchase_order_mail_status');
		$this->db->from('tbl_purchase_orders a');
		$this->db->join('mst_suppliers b','a.purchase_order_supplier = b.supplier_id');
		$this->db->join('tbl_purchase_orders_relations c','c.purchase_order_id = a.purchase_order_id');
		$this->db->where('a.status',1);
		$this->db->order_by('a.purchase_order_id','desc');
		$this->db->where('a.company_id',$this->session->userdata('company_id'));
		$this->db->limit('5');
		$query = $this->db->get();
		if ($query->num_rows() > 0 ) {
			$results = $query->result_array();
			return $results;
		} else {
			return false;
		}
	}

	function get_current_user_companies(){
		$this->db->select('access_company');
		if($this->session->userdata('access_level') > 1){
			$this->db->where('user_id',$this->session->userdata('user_id'));
		}
		$query = $this->db->get('mst_users');
		if($query->num_rows() > 0){
			$companies = $query->row_array()['access_company'];
			$this->db->select('company_name');
			$this->db->where_in('company_id ', array_filter(explode(',',$companies)));
			$query = $this->db->get('company_details');
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			} 
		}else{
			return false;
		}
	}

}
/* End of file User_model.php */
/* Location: ./application/models/User_model.php */