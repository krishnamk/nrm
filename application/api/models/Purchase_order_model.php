<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Purchase_order_model extends CI_Model{
	public function get_purchase_order_details($purchase_order_id){
		$this->db->select('a.purchase_order_id,a.purchase_order_number,a.purchase_order_date,a.purchase_order_supplier,sum(c.amount) as total_amount,count(c.purchase_order_relation_id) as total_product_count');
		$this->db->from('tbl_purchase_orders a');
		$this->db->join('mst_suppliers b','a.purchase_order_supplier = b.supplier_id'); 
		$this->db->join('tbl_purchase_orders_relations c','c.purchase_order_id = a.purchase_order_id');
		$this->db->where('a.purchase_order_id',$purchase_order_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['purchase_order_details'] = $query->row_array();
		}else{
			$data['purchase_order_details'] = false;
		}
		$this->db->select('a.company_name,a.company_gst,a.company_city,a.company_pincode,b.state_name');
		$this->db->from('company_details a');
		$this->db->join('mst_state b','a.company_state = b.state_code');
		//$this->db->where('a.supplier_id',$data['purchase_order_details']['purchase_order_supplier']);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['company_details'] = $query->row_array();
		}else{
			$data['company_details'] = false;
		}
		$this->db->select('a.supplier_name,a.supplier_gst,a.supplier_city,a.supplier_pincode,b.state_name');
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
	public function get_purchase_order_lists($per_page_limit,$page){
		$this->db->select('a.purchase_order_id,c.supplier_name,a.purchase_order_number,a.purchase_order_date,sum(b.quantity) as quantity,sum(b.amount) as total_amount');
		$this->db->from('tbl_purchase_orders a');
		$this->db->join('tbl_purchase_orders_relations b','b.purchase_order_id = a.purchase_order_id');
		$this->db->join('mst_suppliers c','a.purchase_order_supplier = c.supplier_id');
		$this->db->where('a.status',1);
		$this->db->where('b.status',1);
		$this->db->where('c.status',1);
		$this->db->group_by('a.purchase_order_id');
		//$this->db->order_by('a.purchase_order_id');
		$this->db->limit($per_page_limit, $page);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}
	}
	
}