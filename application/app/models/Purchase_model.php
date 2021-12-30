<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class Purchase_model extends CI_Model{
	public function get_temp_listings(){
		$this->db->select('a.*,b.product_name,b.product_brand,b.product_category,b.product_subcategory,b.product_description,b.product_type,b.product_type_base_value');
		$this->db->from('tbl_purchase_relation_temp a');
		$this->db->join('mst_products b','a.product_id = b.product_id');
		//$this->db->join('mst_taxs f','b.product_tax = f.tax_id');
		//$this->db->where('a.created_by',$this->session->userdata('user_id'));
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array();
			//echo "<pre>";print_r($results);exit;
			foreach ($results as $result_key => $result) {
				if($result['product_brand']!="0"){
					$this->db->select('a.brand_id,a.brand_name');
					$this->db->from('mst_brands a');
					$this->db->where('a.brand_id',$result['product_brand']);
					$result = $this->db->get();
					if($result->num_rows() > 0){
						$results[$result_key]['brand_name'] = $result_query->row('brand_name');
						$results[$result_key]['brand_id'] = $result_query->row('brand_id');
					}
				}else{
					$results[$result_key]['brand_name'] = "";
					$results[$result_key]['brand_id'] = "";
				}
				if($result['product_category']!="0"){
					$this->db->select('a.category_id,a.category_name');
					$this->db->from('mst_category a');
					$this->db->where('a.category_id',$result['product_category']);
					$category_query = $this->db->get();
					if($category_query->num_rows() > 0){
						$results[$result_key]['category_name'] = $category_query->row('category_name');
						$results[$result_key]['category_id'] = $category_query->row('category_id');
					}
				}else{
					$results[$result_key]['category_name'] = "";
					$results[$result_key]['category_id'] = "";
				}
				if($result['product_category']!="0"){
					$this->db->select('a.sub_category_id,a.sub_category_name');
					$this->db->from('mst_subcategory a');
					$this->db->where('a.sub_category_id',$result['product_subcategory']);
					$subcategory_query = $this->db->get();
					if($subcategory_query->num_rows() > 0){
						$results[$result_key]['sub_category_name'] = $subcategory_query->row('sub_category_name');
						$results[$result_key]['sub_category_id'] = $subcategory_query->row('sub_category_id');
					}
				}else{
					$results[$result_key]['sub_category_name'] = "";
					$results[$result_key]['sub_category_id'] = "";
				}
			}
			//echo "<pre>";print_r($results);exit;
			return $results;
		}else{
			return false;
		}
	}
	public function get_purchase_details($purchase_id){
		$this->db->select('a.*');
		$this->db->from('tbl_purchase a');
		$this->db->join('mst_suppliers b','a.purchase_supplier = b.supplier_id');
		$this->db->where('purchase_id',$purchase_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['purchase_details'] = $query->row_array();
		}else{
			$data['purchase_details'] = false;
		}
		$data['company_details'] = $this->company_details($data['purchase_details']['company_id']);
		$this->db->select('a.*,b.state_name');
		$this->db->from('mst_suppliers a');
		$this->db->join('mst_state b','a.supplier_state = b.state_code'); 
		$this->db->where('a.supplier_id',$data['purchase_details']['purchase_supplier']);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['supplier_details'] = $query->row_array();
		}else{
			$data['supplier_details'] = false;
		}
		$this->db->select('a.*');
		$this->db->from('tbl_purchase_relations a');
		$this->db->where('purchase_id',$purchase_id);
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
	public function get_purchase_lists($data = array()){
		$this->db->select('a.*,b.supplier_name,c.purchase_status');
		$this->db->from('tbl_purchase a');
		$this->db->join('mst_suppliers b','a.purchase_supplier = b.supplier_id');
		$this->db->join('tbl_purchase_payments c','c.purchase_id = a.purchase_id');
		if(isset($data['supplier_id'])){
			if($data['supplier_id'] !=''){
				$this->db->where('b.supplier_id',$data['supplier_id']);
			}
		}
		if(isset($data['date_from'])){
			if(($data['date_from'] !='')&&($data['date_to'] !='')){
				$this->db->where('a.purchase_date >=',$data['date_from']);
				$this->db->where('a.purchase_date <=',$data['date_to']);
			}
		}
		$this->db->where('a.status!=',0);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array();
			foreach ($results as $key => $result) {
				$this->db->select('sum(a.total) as purchase_total');
				$this->db->from('tbl_purchase_relations a'); 
				$this->db->where('a.purchase_id',$result['purchase_id']);
				$this->db->where('a.status',1);
				$this->db->group_by('a.purchase_id');
				$relation_query = $this->db->get();
				if($relation_query->num_rows() > 0){
					$purchase_relation = $relation_query->row_array();
				    //echo '<pre>';print_r($relation_query->result_array());exit;
					if($purchase_relation['purchase_total']!=""){
						$results[$key]['purchase_total'] = $purchase_relation['purchase_total'];
					}else{
						$results[$key]['purchase_total'] = 0;
					}
				}else{
					$results[$key]['purchase_total'] = 0;
				}
			}
			return $results;
		}else{
			return false;
		}
	}
	public function get_purchase_products($purchase_dc_id){
		$this->db->select('*');
		$this->db->from('tbl_purchase_dc_relations');
		$this->db->where('purchase_dc_id',$purchase_dc_id);
		$this->db->where('status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}
	function reduce_product_stock($data){
		$this->db->select('a.*');
		$this->db->from('tbl_stock a');
		$this->db->where('a.product_id',$data['product_id']);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row();
			if($result->quantity == $data['quantity']){
				$update['quantity'] = 0;
			}elseif($result->quantity > $data['quantity']){
				$update['quantity'] = $result->quantity - $data['quantity'];
			}else{
				return false;
			}
			$this->db->update('tbl_stock',$update,array('stock_id' => $result->stock_id ));
			return true;
		}else{
			return false;
		}
	}
}