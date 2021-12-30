<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchase_return_model extends CI_Model {
	public function get_purchase_return_listings(){
		$this->db->select('a.*,b.supplier_name,c.purchase_number');
		$this->db->from('tbl_purchase_return a');
		$this->db->join('mst_suppliers b','a.purchase_return_supplier = b.supplier_id'); 
		$this->db->join('tbl_purchase c','a.purchase_return_purchase_id = c.purchase_id'); 
		$this->db->where('a.status!=',0);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}
	public function get_purchase_return_details($purchase_return_id){
		$this->db->select('*');
		$this->db->from('tbl_purchase_return a'); 
		$this->db->where('a.purchase_return_id',$purchase_return_id);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['purchase_return_details'] = $query->row_array();
		}else{
			$data['purchase_return_details'] = false;
		}
		$this->db->select('*');
		$this->db->from('tbl_purchase_return_relations a'); 
		$this->db->where('a.purchase_return_id',$purchase_return_id);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['relations'] = $query->result_array();
		}else{
			$data['relations'] = false;
		}
		$this->db->select('a.*,b.state_name');
		$this->db->from('mst_suppliers a'); 
		$this->db->join('mst_state b','a.supplier_state = b.state_code'); 
		$this->db->where('a.supplier_id',$data['purchase_return_details']['purchase_return_supplier']);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['supplier_details'] = $query->row_array();
		}else{
			$data['supplier_details'] = false;
		}
		$data['company_details'] = $this->company_details($data['purchase_return_details']['company_id']);
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
	public function get_purchase_return_relations($purchase_return_id){
		$this->db->select('a.*,a.return_quantity as return_quantity,b.quantity');
		$this->db->from('tbl_purchase_return_relations a'); 
		$this->db->join('tbl_purchase_relations b','a.purchase_relation_id = b.purchase_relation_id'); 
		$this->db->where('a.purchase_return_id',$purchase_return_id);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
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
			$this->db->update('tbl_stock',$stock_update,array('stock_id' => $oldstock['stock_id'] ));
			return true;
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
			$total_quantity = $data['quantity'] + $oldstock['quantity'];
			$stock_update =  array(
				'quantity'		=>	$total_quantity,
			);
			$this->db->update('tbl_stock',$stock_update,array('stock_id' => $oldstock['stock_id'] ));
			return true;
		}else{
			return false;
		}
	}
	public function get_product_items($product_id){
		$this->db->select('a.*,b.item_name');
		$this->db->from('mst_products_items a');
		$this->db->join('mst_items b','a.item_id = b.item_id');
		$this->db->where('a.product_id',$product_id); 
		$this->db->where('a.status',1); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}
	}
	public function check_purchase_return_product_status($purchase_relation_id){
		$this->db->select('a.quantity');
		$this->db->from('tbl_purchase_relations a');
		$this->db->where('a.purchase_relation_id',$purchase_relation_id);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$purchase_relation = $query->row_array();
			$this->db->select('sum(a.return_quantity) as total_purchase_quantity,b.purchase_id');
			$this->db->from('tbl_purchase_return_relations a');
			$this->db->join('tbl_purchase_relations b','b.purchase_relation_id = a.purchase_relation_id');
			$this->db->where('a.purchase_relation_id',$purchase_relation_id);
			$this->db->where('a.status',1);
			$this->db->group_by('a.purchase_relation_id');
			$relation_query = $this->db->get();
			if($relation_query->num_rows() > 0){
				$relations = $relation_query->row_array();
				if($purchase_relation['quantity'] == $relations['total_purchase_quantity']){
					$purchase_relation_update = array(
						'purchase_return_product_status' 	=> 2,
						'available_quantity' 			=> 0,
						'updated_on' 					=> created_on(),
						'updated_by' 					=> created_by()
					);
					$this->db->update('tbl_purchase_relations',$purchase_relation_update,array('purchase_relation_id' => $purchase_relation_id));
				}else{
					$purchase_relation_update = array(
						'available_quantity'=> $purchase_relation['quantity']-$relations['total_purchase_quantity'],
						'updated_on' 		=> created_on(),
						'updated_by' 		=> created_by()
					);
					$this->db->update('tbl_purchase_relations',$purchase_relation_update,array('purchase_relation_id' => $purchase_relation_id));
				}
			}
			return true;
		}else{
			return false;
		}
	}

	public function get_purchase_product_details($purchase_id){
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
		$this->db->select('*');
		$this->db->from('tbl_purchase_relations');
		$this->db->where('purchase_id',$purchase_id);
		$this->db->where('available_quantity = quantity');
		$this->db->where('status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['relations'] = $query->result_array();
		}else{
			$data['relations'] = false;
		}
		return $data;
	}
	public function check_purchase_return_purchase_status($purchase_id){
		$this->db->select('*');
		$this->db->from('tbl_purchase_relations a');
		$this->db->where('a.purchase_id',$purchase_id);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array();
			foreach ($results as $key => $result) {
				$this->db->select('*');
				$this->db->from('tbl_purchase_return_relations a');
				$this->db->where_not_in('a.purchase_relation_id',$result['purchase_relation_id']);
				$this->db->where('a.purchase_relation_id',$result['purchase_relation_id']);
				$this->db->where('a.status',1);
				$relations = $this->db->get();
				if($relations->num_rows() > 0){
					$purchase_update = array(
						'purchase_return_status' 	=> 2,
						'updated_on'			=> created_on(),
						'updated_by'			=> created_by()
					);
					$this->db->update('tbl_purchase',$purchase_update,array('purchase_id' => $purchase_id));
				}
			}
			return true;
		}else{
			return false;
		}
	}
}
/* End of file purchase_eturns_model.php */
/* Location: ./application/app/models/purchase_returns_model.php */