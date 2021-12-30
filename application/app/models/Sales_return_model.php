<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class sales_return_model extends CI_Model {
	public function get_sales_return_listings(){
		$this->db->select('a.*,b.customer_name,c.invoice_number');
		$this->db->from('tbl_sales_return a');
		$this->db->join('mst_customers b','a.sales_return_customer = b.customer_id'); 
		$this->db->join('tbl_invoices c','a.sales_return_invoice_id = c.invoice_id'); 
		$this->db->where('a.status!=',0);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}
	public function get_sales_return_details($sales_return_id){
		$this->db->select('*');
		$this->db->from('tbl_sales_return a'); 
		$this->db->where('a.sales_return_id',$sales_return_id);
		$this->db->where('a.status!=',0);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['sales_return_details'] = $query->row_array();
		}else{
			$data['sales_return_details'] = false;
		}
		$this->db->select('*');
		$this->db->from('tbl_sales_return_relations a'); 
		$this->db->where('a.sales_return_id',$sales_return_id);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['relations'] = $query->result_array();
		}else{
			$data['relations'] = false;
		}
		$this->db->select('a.*,b.state_name');
		$this->db->from('mst_customers a'); 
		$this->db->join('mst_state b','a.customer_state = b.state_code'); 
		$this->db->where('a.customer_id',$data['sales_return_details']['sales_return_customer']);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['customer_details'] = $query->row_array();
		}else{
			$data['customer_details'] = false;
		}
		$data['company_details'] = $this->company_details($data['sales_return_details']['company_id']);
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
	public function get_sales_return_relations($sales_return_id){
		$this->db->select('a.*,a.return_quantity as return_quantity,b.quantity');
		$this->db->from('tbl_sales_return_relations a'); 
		$this->db->join('tbl_invoices_relation b','a.invoice_relation_id = b.invoice_relation_id'); 
		$this->db->where('a.sales_return_id',$sales_return_id);
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
	public function check_sales_return_product_status($invoice_relation_id){
		$this->db->select('a.quantity');
		$this->db->from('tbl_invoices_relation a');
		$this->db->where('a.invoice_relation_id',$invoice_relation_id);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$invoice_relation = $query->row_array();
			$this->db->select('sum(a.return_quantity) as total_invoice_quantity,b.invoice_id');
			$this->db->from('tbl_sales_return_relations a');
			$this->db->join('tbl_invoices_relation b','b.invoice_relation_id = a.invoice_relation_id');
			$this->db->where('a.invoice_relation_id',$invoice_relation_id);
			$this->db->where('a.status',1);
			$this->db->group_by('a.invoice_relation_id');
			$relation_query = $this->db->get();
			if($relation_query->num_rows() > 0){
				$relations = $relation_query->row_array();
				if($invoice_relation['quantity'] == $relations['total_invoice_quantity']){
					$invoice_relation_update = array(
						'sales_return_product_status' 	=> 2,
						'available_quantity' 			=> 0,
						'updated_on' 					=> created_on(),
						'updated_by' 					=> created_by()
					);
					$this->db->update('tbl_invoices_relation',$invoice_relation_update,array('invoice_relation_id' => $invoice_relation_id));
				}else{
					$invoice_relation_update = array(
						'available_quantity'=> $invoice_relation['quantity']-$relations['total_invoice_quantity'],
						'updated_on' 		=> created_on(),
						'updated_by' 		=> created_by()
					);
					$this->db->update('tbl_invoices_relation',$invoice_relation_update,array('invoice_relation_id' => $invoice_relation_id));
				}
			}
			return true;
		}else{
			return false;
		}
	}

	public function get_invoice_product_details($invoice_id){
		$this->db->select('a.*');
		$this->db->from('tbl_invoices a');
		$this->db->join('mst_customers b','a.invoice_customer = b.customer_id');
		$this->db->where('invoice_id',$invoice_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['invoice_details'] = $query->row_array();
		}else{
			$data['invoice_details'] = false;
		}
		$this->db->select('*');
		$this->db->from('tbl_invoices_relation');
		$this->db->where('invoice_id',$invoice_id);
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
	public function check_sales_return_invoice_status($invoice_id){
		$this->db->select('*');
		$this->db->from('tbl_invoices_relation a');
		$this->db->where('a.invoice_id',$invoice_id);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array();
			foreach ($results as $key => $result) {
				$this->db->select('*');
				$this->db->from('tbl_sales_return_relations a');
				$this->db->where_not_in('a.invoice_relation_id',$result['invoice_relation_id']);
				$this->db->where('a.invoice_relation_id',$result['invoice_relation_id']);
				$this->db->where('a.status',1);
				$relations = $this->db->get();
				if($relations->num_rows() > 0){
					$invoice_update = array(
						'sales_return_status' 	=> 2,
						'updated_on'			=> created_on(),
						'updated_by'			=> created_by()
					);
					$this->db->update('tbl_invoices',$invoice_update,array('invoice_id' => $invoice_id));
				}
			}
			return true;
		}else{
			return false;
		}
	}
}
/* End of file sales_eturns_model.php */
/* Location: ./application/app/models/sales_returns_model.php */