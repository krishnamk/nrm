<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Quotation_model extends CI_Model {
	public function get_quotation_lists($data = array()){
		$this->db->select('a.quotation_id,a.quotation_number,a.quotation_customer,a.quotation_type,a.quotation_date,a.status,b.customer_name,a.created_by,a.quotation_cancel');
		$this->db->from('tbl_quotations a');
		$this->db->join('mst_customers b','a.quotation_customer = b.customer_id');
		$this->db->where('a.quotation_approved',1);
		$this->db->order_by('a.quotation_id','desc');
		if(isset($data['customer_id'])){
			if($data['customer_id'] !=''){
				$this->db->where('b.customer_id',$data['customer_id']);
			}
		}
		if(isset($data['date_from'])){
			if(($data['date_from'] !='')&&($data['date_to'] !='')){
				$this->db->where('a.quotation_date >=',$data['date_from']);
				$this->db->where('a.quotation_date <=',$data['date_to']);
			}
		}

		// if($this->session->userdata('access_level') != 1){
		// 	$this->db->where('a.company_id',$this->session->userdata('company_id'));
		// }
		$query = $this->db->get();
		if ($query->num_rows() > 0 ) {
			$results = $query->result_array();
			foreach ($results as $key => $result) {
				$this->db->select('SUM(a.total) as quotation_total');
				$this->db->from('tbl_quotations_relation a'); 
				$this->db->where('a.quotation_id',$result['quotation_id']);
				$this->db->where('a.status',1);
				$relation_query = $this->db->get();
				if($relation_query->num_rows() > 0){
					$estimate_relation = $relation_query->row_array();
					//echo '<pre>';print_r($relation_query->result_array());exit;
					if($estimate_relation['quotation_total']!=""){
						$results[$key]['quotation_total'] = $estimate_relation['quotation_total'];
					}else{
						$results[$key]['quotation_total'] = 0;
					}
				}else{
					$results[$key]['quotation_total'] = 0;
				}
			}
			return $results;
		} else {
			return false;
		}
	}
	public function get_temp_listings(){
		$this->db->select('a.*,b.product_name,b.product_brand,b.product_category,b.product_subcategory,b.product_description,b.product_tax,f.tax_percentage,f.tax_name');
		$this->db->from('tbl_quotations_relation_temp a');
		$this->db->join('mst_products b','a.product_id = b.product_id');
		$this->db->join('mst_taxs f','b.product_tax = f.tax_id');
		$this->db->where('a.created_by',$this->session->userdata('user_id'));
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array();
			foreach ($results as $key => $result) {
				if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
					$results[$key]['brand_name'] = "";
					if($result['product_brand']!=0){
						$results[$key]['brand_name'] = $this->common->get_particular('mst_brands',array('brand_id' => $result['product_brand']),'brand_name');
					}
				}
				if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
					$results[$key]['category_name'] = "";
					if($result['product_category']!=0){
						$results[$key]['category_name'] = $this->common->get_particular('mst_category',array('category_id' => $result['product_category']),'category_name');
					}
				}
				if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){
					$results[$key]['sub_category_name'] = "";
					if($result['product_subcategory']!=0){
						$results[$key]['sub_category_name'] = $this->common->get_particular('mst_subcategory',array('sub_category_id' => $result['product_subcategory']),'sub_category_name');
					}
				}
			}
			return $results;
		}else{
			return false;
		}
	}
	public function reduce_stock($data){
		$this->db->select('a.*');
		$this->db->from('tbl_stock a');
		$this->db->where('a.product_id',$data['product_id']);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$oldstock = $query->row_array();
			$total_quantity = $oldstock['quantity'] - $data['quantity'];
			$stock_update = array(
				'quantity'		=>	$total_quantity,
			);
			$this->db->update('tbl_stock',$stock_update,array('stock_id' => $oldstock['stock_id']));
			return true;
		}else{
			return false;
		}
	}
	public function get_quotation_details($quotation_id){
		$this->db->select('a.*');
		$this->db->from('tbl_quotations a');
		$this->db->join('mst_customers b','a.quotation_customer = b.customer_id');
		$this->db->where('quotation_id',$quotation_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['quotation_details'] = $query->row_array();
		//IF MULTIPLE COMPANY ENABLE
			if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){
				foreach ($data['quotation_details'] as $key => $quotation_details) {
					$this->db->select('a.*,b.state_name');
					$this->db->from('company_details a');
					$this->db->join('mst_state b','a.company_state = b.state_code');
					$this->db->join('tbl_quotations c','c.company_id = a.company_id');
					$this->db->where('a.company_id',$data['quotation_details']['company_id']);
					$company_query = $this->db->get();
					if($company_query->num_rows() > 0){
						$data['company_details'] = $company_query->row_array();
					}else{
						$data['company_details'] = false;
					}
				}
			}else{
				$this->db->select('a.*,b.state_name');
				$this->db->from('company_details a');
				$this->db->join('mst_state b','a.company_state = b.state_code');
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$data['company_details'] = $query->row_array();
				}else{
					$data['company_details'] = false;
				}
			}
		}else{
			$data['quotation_details'] = false;
		}
		$this->db->select('a.*,b.state_name');
		$this->db->from('mst_customers a');
		$this->db->join('mst_state b','a.customer_state = b.state_code'); 
		$this->db->where('a.customer_id',$data['quotation_details']['quotation_customer']);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['customer_details'] = $query->row_array();
		}else{
			$data['customer_details'] = false;
		}
		$this->db->select('*');
		$this->db->from('tbl_quotations_relation');
		$this->db->where('quotation_id',$quotation_id);
		$this->db->where('status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['relations'] = $query->result_array();
		}else{
			$data['relations'] = false;
		}
		return $data;
	}
	//QUOTATION PAYMENT LISTS
	function get_quotation_payment_list(){
		$this->db->select('a.*,b.quotation_number,b.quotation_date,c.customer_name');
		$this->db->from('tbl_quotation_payments a');
		$this->db->join('tbl_quotations b','b.quotation_id = a.quotation_id');
		$this->db->join('mst_customers c','c.customer_id = a.customer_id');
		$this->db->where('a.status',1);
		$this->db->where('b.status',1);
		$this->db->order_by('a.created_on','desc');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results =  $query->result_array();
			foreach ($results as $key => $result) {
				$this->db->select('sum(paid_amount) as paid_amount');
				$this->db->from('tbl_quotation_payments_history');
				$this->db->where('quotation_payments_id',$result['quotation_payments_id']); 
				$this->db->where('status',1); 
				$history_query = $this->db->get();
				if($history_query->num_rows() > 0){
					$history = $history_query->row_array();
					$history['paid_amount'] = ($history['paid_amount']!='') ? $history['paid_amount'] : 0 ;
					$balance_amount = $result['quotation_amount'] - $history['paid_amount'];
					$results[$key]['paid_amount'] = $history['paid_amount'];
					$results[$key]['balance_amount'] = $balance_amount;
				}else{
					$results[$key]['paid_amount'] = 0;
					$results[$key]['balance_amount'] = $result['quotation_amount'];
				}
			}
			return $results;
		}
	}
	function get_quotation_detail_bills($payments_id){
		$this->db->select('a.*,b.quotation_number,b.quotation_date,c.customer_id,c.customer_name');
		$this->db->from('tbl_quotation_payments a');
		$this->db->join('tbl_quotations b','b.quotation_id = a.quotation_id');
		$this->db->join('mst_customers c','c.customer_id = a.customer_id');
		$this->db->where('a.quotation_payments_id',$payments_id); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result =  $query->row_array();
			$this->db->select('*');
			$this->db->from('tbl_quotation_payments_history');
			$this->db->where('quotation_payments_id',$payments_id); 
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
	function check_product_qty($product_id,$product_qty){
		$this->db->select('a.*');
		$this->db->from('tbl_stock a');
		$this->db->where('a.product_id',$product_id);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row_array();
			if($result['quantity'] > $product_qty){
				return true;
			}elseif($result['quantity'] == $product_qty){
				return true;
			}elseif($result['quantity'] < $product_qty){
				return false;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function get_quotation_temp_listings(){
		$this->db->select('a.*,c.product_name,c.product_brand,c.product_tax,g.tax_name,g.tax_percentage');
		$this->db->from('tbl_quotations_relation_temp a');
		$this->db->join('mst_products c','a.product_id = c.product_id');
		$this->db->join('mst_taxs g','c.product_tax = g.tax_id');
		$this->db->where('a.status', 1);
		$this->db->where('a.company_id', $this->session->userdata('company_id'));
		$this->db->where('a.created_by',$this->session->userdata('user_id'));
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			$results = $query->result_array();
			foreach ($results as $key => $result) {
				if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
					$results[$key]['brand_name'] = "";
					if($result['product_brand']!=0){
						$results[$key]['brand_name'] = $this->common->get_particular('mst_brands',array('brand_id' => $result['product_brand']),'brand_name');
					}
				}
				if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
					$results[$key]['category_name'] = "";
					if($result['product_category']!=0){
						$results[$key]['category_name'] = $this->common->get_particular('mst_category',array('category_id' => $result['product_category']),'category_name');
					}
				}
				if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){
					$results[$key]['sub_category_name'] = "";
					if($result['product_subcategory']!=0){
						$results[$key]['sub_category_name'] = $this->common->get_particular('mst_subcategory',array('sub_category_id' => $result['product_subcategory']),'sub_category_name');
					}
				}
			}
			return $results;
		}else{
			return false;
		}
	}
	public function get_quotation_products(){
		$this->db->select('a.product_id,b.product_name,f.tax_name,f.tax_percentage,a.stock_id,a.quantity,a.rate,a.total');
		$this->db->from('tbl_quotations_relation_temp a');
		$this->db->join('mst_products b','a.product_id = b.product_id');
		$this->db->join('mst_taxs f','b.product_tax = f.tax_id');
		$this->db->where('a.status',1);
		$this->db->where('a.company_id',$this->session->userdata('company_id'));
		$this->db->where('a.created_by',$this->session->userdata('user_id'));
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array();
			foreach ($results as $key => $result) {
				if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
					$results[$key]['brand_name'] = "";
					if($result['product_brand']!=0){
						$results[$key]['brand_name'] = $this->common->get_particular('mst_brands',array('brand_id' => $result['product_brand']),'brand_name');
					}
				}
				if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
					$results[$key]['category_name'] = "";
					if($result['product_category']!=0){
						$results[$key]['category_name'] = $this->common->get_particular('mst_category',array('category_id' => $result['product_category']),'category_name');
					}
				}
				if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){
					$results[$key]['sub_category_name'] = "";
					if($result['product_subcategory']!=0){
						$results[$key]['sub_category_name'] = $this->common->get_particular('mst_subcategory',array('sub_category_id' => $result['product_subcategory']),'sub_category_name');
					}
				}
			}
			return $results;
		}else{
			return false;
		}
	}
	function increase_stock($data){
		$this->db->select('a.*');
		$this->db->from('tbl_stock a');
		$this->db->where('a.product_id',$data['product_id']);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$oldstock = $query->row_array();
			//echo "<pre>";print_r($oldstock['quantity']);//exit;
			$total_quantity = $data['quantity'] + $oldstock['quantity'];
			//echo "<pre>";print_r($data['quantity']);//exit;
			$stock_update =  array(
				'quantity'		=>	$total_quantity,
			);
			//echo "<pre>";print_r($stock_update);exit;
			$this->db->update('tbl_stock',$stock_update,array('stock_id' => $oldstock['stock_id'],'product_id' => $data['product_id']));
			return true;
		}else{
			return false;
		}
	}
}
/* End of file Quotation_model.php */
/* Location: ./application/app/models/Quotation_model.php */