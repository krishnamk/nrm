<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Purchase_model extends CI_Model{
	//PURCHASE DC DETAILS
	public function get_purchase_dc_details($purchase_dc_id){
		$this->db->select('a.purchase_dc_id,a.purchase_dc_number,a.purchase_dc_date,a.purchase_dc_supplier,a.purchase_dc_no as dc_no,a.dc_status,sum(c.quantity) as quantity');
		$this->db->from('tbl_purchase_dc a');
		$this->db->join('mst_suppliers b','a.purchase_dc_supplier = b.supplier_id'); 
		$this->db->join('tbl_purchase_dc_relations c','c.purchase_dc_id = a.purchase_dc_id');
		$this->db->where('a.purchase_dc_id',$purchase_dc_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['purchase_dc_details'] = $query->row_array();
		}else{
			$data['purchase_dc_details'] = false;
		}
		$this->db->select('a.company_name,a.company_gst,a.company_city,a.company_pincode,b.state_name');
		$this->db->from('company_details a');
		$this->db->join('mst_state b','a.company_state = b.state_code');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['company_details'] = $query->row_array();
		}else{
			$data['company_details'] = false;
		}
		$this->db->select('a.supplier_name,a.supplier_gst,a.supplier_city,a.supplier_pincode,b.state_name');
		$this->db->from('mst_suppliers a');
		$this->db->join('mst_state b','a.supplier_state = b.state_code');
		$this->db->where('a.supplier_id',$data['purchase_dc_details']['purchase_dc_supplier']);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['supplier_details'] = $query->row_array();
		}else{
			$data['supplier_details'] = false;
		}
		$this->db->select('a.*');
		$this->db->from('tbl_purchase_dc_relations a');
		$this->db->where('purchase_dc_id',$purchase_dc_id);
		$this->db->where('status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['relations'] = $query->result_array();
		}else{
			$data['relations'] = false;
		}
		return $data;
	}

	//PURCHASE DC LIST
	public function get_purchase_dc_lists($per_page_limit,$page){
		$this->db->select('a.purchase_dc_id,c.supplier_name,a.purchase_dc_number,a.purchase_dc_date,sum(b.quantity) as quantity,sum(b.total) as total_amount');
		$this->db->from('tbl_purchase_dc a');
		$this->db->join('tbl_purchase_dc_relations b','b.purchase_dc_id = a.purchase_dc_id');
		$this->db->join('mst_suppliers c','a.purchase_dc_supplier = c.supplier_id');
		$this->db->where('a.status',1);
		$this->db->where('b.status',1);
		$this->db->where('c.status',1);
		$this->db->group_by('a.purchase_dc_id');
		$this->db->limit($per_page_limit, $page);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}
	}
	
	//PURCHASE RETURN DETAILS
	public function get_purchase_return_details($purchase_return_id){
		$this->db->select('a.purchase_return_id,a.purchase_return_number,a.purchase_return_date,a.purchase_return_supplier,a.purchase_return_purchase_id as purchase_no,sum(c.return_quantity) as quantity');
		$this->db->from('tbl_purchase_return a');
		$this->db->join('mst_suppliers b','a.purchase_return_supplier = b.supplier_id'); 
		$this->db->join('tbl_purchase_return_relations c','c.purchase_return_id = a.purchase_return_id');
		$this->db->where('a.purchase_return_id',$purchase_return_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['purchase_return_details'] = $query->row_array();
		}else{
			$data['purchase_return_details'] = false;
		}
		$this->db->select('a.company_name,a.company_gst,a.company_city,a.company_pincode,b.state_name');
		$this->db->from('company_details a');
		$this->db->join('mst_state b','a.company_state = b.state_code');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['company_details'] = $query->row_array();
		}else{
			$data['company_details'] = false;
		}
		$this->db->select('a.supplier_name,a.supplier_gst,a.supplier_city,a.supplier_pincode,b.state_name');
		$this->db->from('mst_suppliers a');
		$this->db->join('mst_state b','a.supplier_state = b.state_code');
		$this->db->where('a.supplier_id',$data['purchase_return_details']['purchase_return_supplier']);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['supplier_details'] = $query->row_array();
		}else{
			$data['supplier_details'] = false;
		}
		$this->db->select('a.*');
		$this->db->from('tbl_purchase_return_relations a');
		$this->db->where('purchase_return_id',$purchase_return_id);
		$this->db->where('status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['relations'] = $query->result_array();
		}else{
			$data['relations'] = false;
		}
		return $data;
	}

	//PURCHASE DETAILS
	public function get_purchase_details($purchase_id){
		$this->db->select('a.purchase_id,a.purchase_number,a.purchase_date,a.purchase_supplier,a.purchase_bill_no,a.status,a.tax_included,sum(c.quantity) as quantity,sum(c.quantity * c.rate) as amount,sum(c.tax_total) as tax_total,sum(c.total) as total_amount');
		$this->db->from('tbl_purchase a');
		$this->db->join('mst_suppliers b','a.purchase_supplier = b.supplier_id'); 
		$this->db->join('tbl_purchase_relations c','c.purchase_id=a.purchase_id');
		$this->db->where('a.purchase_id',$purchase_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['purchase_details'] = $query->row_array();
		}else{
			$data['purchase_details'] = false;
		}
		$this->db->select('a.company_name,a.company_gst,a.company_city,a.company_pincode,b.state_name');
		$this->db->from('company_details a');
		$this->db->join('mst_state b','a.company_state = b.state_code');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['company_details'] = $query->row_array();
		}else{
			$data['company_details'] = false;
		}
		$this->db->select('a.supplier_name,a.supplier_gst,a.supplier_city,a.supplier_pincode,b.state_name');
		$this->db->from('mst_suppliers a');
		$this->db->join('mst_state b','a.supplier_state = b.state_code');
		$this->db->where('a.supplier_id',$data['purchase_details']['purchase_supplier']);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['supplier_details'] = $query->row_array();
		}else{
			$data['supplier_details'] = false;
		}
		$this->db->select('a.*,(a.rate * a.quantity) as amount,a.total as total_amount');
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

	//PURCHASE LIST
	public function get_purchase_lists($per_page_limit,$page){
		$this->db->select('a.purchase_id,c.supplier_name,a.purchase_number,a.purchase_date,sum(b.quantity) as quantity,sum(b.total) as total_amount');
		$this->db->from('tbl_purchase a');
		$this->db->join('tbl_purchase_relations b','b.purchase_id = a.purchase_id');
		$this->db->join('mst_suppliers c','a.purchase_supplier = c.supplier_id');
		$this->db->where('a.status',1);
		$this->db->where('b.status',1);
		$this->db->where('c.status',1);
		$this->db->group_by('a.purchase_id');
		$this->db->limit($per_page_limit, $page);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}
	}

	//PURCHASE RETURN LIST
	public function get_purchase_return_lists($per_page_limit,$page){
		$this->db->select('a.purchase_return_id,c.supplier_name,a.purchase_return_number,a.purchase_return_date,sum(b.return_quantity) as quantity');
		$this->db->from('tbl_purchase_return a');
		$this->db->join('tbl_purchase_return_relations b','b.purchase_return_id = a.purchase_return_id');
		$this->db->join('mst_suppliers c','a.purchase_return_supplier = c.supplier_id');
		$this->db->where('a.status',1);
		$this->db->where('b.status',1);
		$this->db->where('c.status',1);
		$this->db->group_by('a.purchase_return_id');
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