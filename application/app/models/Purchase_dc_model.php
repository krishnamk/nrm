<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_dc_model extends CI_Model { 
	public function get_temp_listings(){
		$this->db->select('a.*,b.product_name,b.product_brand,b.product_description');
		$this->db->from('tbl_purchase_dc_relation_temp a');
		$this->db->join('mst_products b','a.product_id = b.product_id');
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
			}
			return $results;
		}else{
			return false;
		}
	}
	public function get_purchase_dc_details($purchase_dc_id){
		$this->db->select('a.*');
		$this->db->from('tbl_purchase_dc a');
		$this->db->join('mst_suppliers b','a.purchase_dc_supplier = b.supplier_id');
		$this->db->where('purchase_dc_id',$purchase_dc_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['purchase_dc_details'] = $query->row_array();
		}else{
			$data['purchase_dc_details'] = false;
		}
		$data['company_details'] = $this->company_details($data['purchase_dc_details']['company_id']);
		$this->db->select('a.*,b.state_name');
		$this->db->from('mst_suppliers a');
		$this->db->join('mst_state b','a.supplier_state = b.state_code'); 
		$this->db->where('a.supplier_id',$data['purchase_dc_details']['purchase_dc_supplier']);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['supplier_details'] = $query->row_array();
		}else{
			$data['supplier_details'] = false;
		}
		$this->db->select('a.*,b.product_description');
		$this->db->from('tbl_purchase_dc_relations a');
		$this->db->join('mst_products b','a.product_id = b.product_id');
		$this->db->where('purchase_dc_id',$purchase_dc_id);
		$this->db->where('a.status',1);
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
	public function get_purchase_dc_lists($data = array()){
		$this->db->select('a.*,b.supplier_name');
		$this->db->from('tbl_purchase_dc a');
		$this->db->join('mst_suppliers b','a.purchase_dc_supplier = b.supplier_id');
		if(isset($data['supplier_id'])){
			if($data['supplier_id'] !=''){
				$this->db->where('b.supplier_id',$data['supplier_id']);
			}
		}
		if(isset($data['date_from'])){
			if(($data['date_from'] !='')&&($data['date_to'] !='')){
				$this->db->where('a.purchase_dc_date >=',$data['date_from']);
				$this->db->where('a.purchase_dc_date <=',$data['date_to']);
			}
		}
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array();
			foreach ($results as $key => $result) {
				$this->db->select('SUM(a.quantity) as quantity');
				$this->db->from('tbl_purchase_dc_relations a'); 
				$this->db->where('a.purchase_dc_id',$result['purchase_dc_id']);
				$this->db->where('a.status',1);
				$relation_query = $this->db->get();
				if($relation_query->num_rows() > 0){
					$purchase_dc_relation = $relation_query->row_array();
					//echo '<pre>';print_r($relation_query->result_array());exit;
					if($purchase_dc_relation['quantity']!=""){
						$results[$key]['quantity'] = $purchase_dc_relation['quantity'];
					}else{
						$results[$key]['quantity'] = 0;
					}
				}else{
					$results[$key]['quantity'] = 0;
				}
			}
			return $results;
		}else{
			return false;
		}
	}
	

}

/* End of file Purchase_dc_model.php */
/* Location: ./application/models/Purchase_dc_model.php */