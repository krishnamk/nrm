<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class Purchase_order_model extends CI_Model{
	public function get_temp_listings(){
		$this->db->select('a.*,b.product_name,b.product_brand,b.product_category,b.product_subcategory,b.product_description,b.product_tax,f.tax_percentage,f.tax_name');
		$this->db->from('tbl_purchase_orders_relation_temp a');
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
	public function get_purchase_order_details($purchase_order_id){
		$this->db->select('a.*');
		$this->db->from('tbl_purchase_orders a');
		$this->db->join('mst_suppliers b','a.purchase_order_supplier = b.supplier_id'); 
		$this->db->where('a.purchase_order_id',$purchase_order_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['purchase_order_details'] = $query->row_array();
		}else{
			$data['purchase_order_details'] = false;
		}
		$data['company_details'] = $this->company_details($data['purchase_order_details']['company_id']);
		$this->db->select('a.*,b.state_name');
		$this->db->from('mst_suppliers a');
		$this->db->join('mst_state b','a.supplier_state = b.state_code');
		$this->db->where('a.supplier_id',$data['purchase_order_details']['purchase_order_supplier']);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['supplier_details'] = $query->row_array();
		}else{
			$data['supplier_details'] = false;
		}
		$this->db->select('a.*');
		$this->db->from('tbl_purchase_orders_relations a');
		$this->db->where('purchase_order_id',$purchase_order_id);
		$this->db->where('status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['relations'] = $query->result_array();
		}else{
			$data['relations'] = false;
		}
		return $data;
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
	public function get_purchase_order_lists($data = array()){
		$this->db->select('a.*,b.supplier_name');
		$this->db->from('tbl_purchase_orders a');
		$this->db->join('mst_suppliers b','a.purchase_order_supplier = b.supplier_id');
		if(isset($data['supplier_id'])){
			if($data['supplier_id'] !=''){
				$this->db->where('b.supplier_id',$data['supplier_id']);
			}
		}
		if(isset($data['date_from'])){
			if(($data['date_from'] !='')&&($data['date_to'] !='')){
				$this->db->where('a.purchase_order_date >=',$data['date_from']);
				$this->db->where('a.purchase_order_date <=',$data['date_to']);
			}
		}
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}
	}
	
}