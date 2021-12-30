<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dc_model extends CI_Model {
	function get_dc_details($dc_id){
		$this->db->select('*');
		$this->db->from('tbl_dcs a');
		$this->db->where('a.dc_id',$dc_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['dc_details'] = $query->row_array();
			$this->db->select('a.*,b.state_name');
			$this->db->from('mst_customers a');
			$this->db->join('mst_state b','b.state_code = a.customer_state');
			$this->db->where('a.customer_id',$data['dc_details']['dc_customer']);
			$customer_query = $this->db->get();
			$data['customer_details'] = $customer_query->row_array();
			$this->db->select('*');
			$this->db->from('tbl_dcs_relation a');
			$this->db->where('a.dc_id',$dc_id);
			$this->db->where('a.status!=',0);
			$relation_query = $this->db->get();
			$data['relations'] = $relation_query->result_array();
			$data['company_details'] = $this->company_details($data['dc_details']['company_id']);
			return $data;
		}else{
			return false;
		}
	}
	function company_details($data = array()){
		$this->db->select('a.*,b.state_name');
		$this->db->from('company_details a');
		$this->db->join('mst_state b','b.state_code = a.company_state');
		if(isset($data)){
			$this->db->where('a.company_id',$data);
		}
		$this->db->where('a.company_status!=',0);
		$company_query = $this->db->get();
		if($company_query->num_rows() > 0){
			return $company_query->row_array();
		}else{
			return false;
		}
	}
	public function get_dc_lists($data = array()){
		$this->db->select('a.dc_id,a.dc_number,a.dc_customer,a.dc_date,a.status,a.dc_status,b.customer_name,a.created_by,a.dc_cancel');
		$this->db->from('tbl_dcs a');
		$this->db->join('mst_customers b','a.dc_customer = b.customer_id');
		$this->db->where('a.dc_approved',1);
		if(isset($data['customer_id'])){
			if($data['customer_id'] !=''){
				$this->db->where('b.customer_id',$data['customer_id']);
			}
		}
		if(isset($data['date_from'])){
			if(($data['date_from'] !='')&&($data['date_to'] !='')){
				$this->db->where('a.dc_date >=',$data['date_from']);
				$this->db->where('a.dc_date <=',$data['date_to']);
			}
		}
		// if(isset($data['status'])){
		// 	if($data['status'] !=''){
		// 		$this->db->where('b.status',$data['status']);
		// 	}
		// }else{
		// 	$this->db->where('a.status != ',0);
		// }
		
		// if($this->session->userdata('access_level')!=1){
		// 	$this->db->where('a.company_id',$this->session->userdata('company_id'));
		// }
		$this->db->order_by('a.dc_id','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0 ) {
			$results = $query->result_array();
			return $results;
		} else {
			return false;
		}
	}
	public function get_dc_products(){
		$this->db->select('a.*,a.product_id,b.product_brand,b.product_category,b.product_subcategory,b.product_name,f.tax_name,
			f.tax_percentage,a.stock_id,a.quantity');
		$this->db->from('tbl_dcs_relation_temp a');
		$this->db->join('mst_products b','a.product_id = b.product_id');
		$this->db->join('mst_taxs f','b.product_tax = f.tax_id');
		$this->db->where('a.status',1);
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
	public function get_temp_listings(){ 
		$this->db->select('a.*,b.product_name,b.product_brand,b.product_category,b.product_subcategory,b.product_description,b.product_tax,f.tax_percentage,f.tax_name');
		$this->db->from('tbl_dcs_relation_temp a');
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
}
/* End of file Dc_model.php */
/* Location: ./application/models/Dc_model.php */