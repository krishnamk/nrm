<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports_model extends CI_Model {
	function get_sales_gst_details($data = array()){
		$this->db->select('a.*,b.invoice_date,b.invoice_number,c.customer_id,c.customer_name,
			c.customer_gst,c.customer_address1,c.customer_address2,c.customer_city,c.customer_state,customer_pincode,d.tax_percentage,sum(a.tax_total)as new_tax,sum(a.total)as new_total,e.company_state,c.customer_state');
		$this->db->from('tbl_invoices_relation a');
		$this->db->join('tbl_invoices b','b.invoice_id=a.invoice_id');
		$this->db->join('mst_customers c','c.customer_id=b.invoice_customer');
		$this->db->join('mst_taxs d','d.tax_percentage=a.tax_percent');
		$this->db->join('company_details e','e.company_id = b.company_id');
		$this->db->group_by('a.invoice_id,a.tax_percent');
		if(!empty($data)){
			if($data['customer_id'] != ''){
				$this->db->where('c.customer_id',$data['customer_id']);
			}
			if($data['tax_id'] != ''){
				$this->db->where('d.tax_id',$data['tax_id']);
			}
			if(isset($data['company_id'])){
				$this->db->where('e.company_id',$data['company_id']);
			}
			if(($data['date_from'] != '') && ($data['date_to'] != '')){
				$this->db->where('b.invoice_date >=',$data['date_from']);
				$this->db->where('b.invoice_date <=',$data['date_to']);
			}
		} 
		$this->db->where('a.status',1);
		//$this->db->where('b.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}

	function get_sales_detail_excel($data = array()){
		$this->db->select('b.invoice_date as DATE,c.customer_name as CUSTOMER_NAME,c.customer_gst as CUSTOMER_GST,
			b.invoice_number as INVOICE_NUMBER,d.tax_percentage as TAX,sum(a.total)as TOTAL_AMOUNT,sum(a.tax_total)as TAX_VALUE,e.company_state,c.customer_state');
		$this->db->from('tbl_invoices_relation a');
		$this->db->join('tbl_invoices b','b.invoice_id=a.invoice_id');
		$this->db->join('mst_customers c','c.customer_id=b.invoice_customer');
		$this->db->join('mst_taxs d','d.tax_percentage=a.tax_percent');
		$this->db->join('company_details e','e.company_id = b.company_id');
		$this->db->group_by('a.invoice_id,a.tax_percent');
		if(!empty($data)){
			if($data['customer_id'] != ''){
				$this->db->where('c.customer_id',$data['customer_id']);
			}
			if($data['tax_id'] != ''){
				$this->db->where('d.tax_id',$data['tax_id']);
			}
			if(isset($data['company_id'])){
				$this->db->where('e.company_id',$data['company_id']);
			}
			if(($data['date_from'] != '') && ($data['date_to'] != '')){
				$this->db->where('b.invoice_date >=',$data['date_from']);
				$this->db->where('b.invoice_date <=',$data['date_to']);
			}
		} 
		$this->db->where('a.status',1);
		//$this->db->where('b.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}

	public function get_sales_summary_list($where = ''){
		$this->db->select('a.*,b.invoice_date,b.invoice_number,c.customer_name,c.customer_id,c.customer_gst,d.tax_percentage,sum(a.tax_total)as new_tax,sum(a.total)as new_total,e.company_state,c.customer_state');
		$this->db->from('tbl_invoices_relation a');
		$this->db->join('tbl_invoices b','b.invoice_id=a.invoice_id');
		$this->db->join('mst_customers c','c.customer_id=b.invoice_customer');
		$this->db->join('mst_taxs d','d.tax_percentage=a.tax_percent');
		$this->db->join('company_details e','e.company_id = b.company_id');
		$this->db->group_by('a.invoice_id,a.tax_percent');
		if($where != ''){
			$this->db->where($where);
		}
		$this->db->where('a.status',1); 
		//$this->db->where('b.status',1); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array(); 
			return $results;
		}else{
			return false;
		}
	}

	public function get_sales_person_summary_list($where = ''){
		$this->db->select('a.*,b.invoice_date,b.invoice_number,c.customer_name,c.customer_id,c.customer_gst,d.tax_percentage,sum(a.tax_total)as new_tax,sum(a.total)as new_total,b.invoice_loading_charges,b.invoice_transportaion_charges,b.invoice_other_expenses,b.invoice_cash_discount,b.company_id,e.company_state,c.customer_state');
		$this->db->from('tbl_invoices_relation a');
		$this->db->join('tbl_invoices b','b.invoice_id = a.invoice_id');
		$this->db->join('mst_customers c','c.customer_id = b.invoice_customer');
		$this->db->join('mst_taxs d','d.tax_percentage = a.tax_percent');
		$this->db->join('company_details e','e.company_id = b.company_id');
		$this->db->group_by('a.invoice_id');
		if(!empty($data)){
			if($data['customer_id'] != ''){
				$this->db->where('c.customer_id',$data['customer_id']);
			}
			if(isset($data['company_id'])){
				$this->db->where('e.company_id',$data['company_id']);
			}
			if(($data['date_from'] != '') && ($data['date_to'] != '')){
				$this->db->where('b.invoice_date >=',$data['date_from']);
				$this->db->where('b.invoice_date <=',$data['date_to']);
			}
		} 
		$this->db->where('a.status',1); 
		//$this->db->where('b.status',1); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}
	}

	function get_purchase_gst_details($data = array()){
		$this->db->select('a.*,b.purchase_date,b.purchase_number,c.supplier_id,c.supplier_name,c.supplier_gst,
			c.supplier_address1,c.supplier_address2,c.supplier_city,c.supplier_state,supplier_pincode,
			d.tax_percentage,sum(a.tax_total)as new_tax,sum(a.total)as new_total,e.company_state,c.supplier_state');
		$this->db->from('tbl_purchase_relations a');
		$this->db->join('tbl_purchase b','b.purchase_id=a.purchase_id');
		$this->db->join('mst_suppliers c','c.supplier_id=b.purchase_supplier');
		$this->db->join('mst_taxs d','d.tax_percentage=a.tax_percent');
		$this->db->join('company_details e','e.company_id = b.company_id');
		$this->db->group_by('a.purchase_id,a.tax_percent');
		if(!empty($data)){
			if($data['supplier_id'] != ''){
				$this->db->where('c.supplier_id',$data['supplier_id']);
			}
			if($data['tax_id'] != ''){
				$this->db->where('d.tax_id',$data['tax_id']);
			}
			if(isset($data['company_id'])){
				$this->db->where('e.company_id',$data['company_id']);
			}
			if(($data['date_from'] != '') && ($data['date_to'] != '')){
				$this->db->where('b.purchase_date >=',$data['date_from']);
				$this->db->where('b.purchase_date <=',$data['date_to']);
			}
		} 
		$this->db->where('a.status',1);
		$this->db->where('b.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result;
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

	function get_purchase_detail_excel($data = array()){
		$this->db->select('b.purchase_date as DATE,c.supplier_name as SUPPLIER_NAME,c.supplier_gst as SUPPLIER_GST,
			b.purchase_number as PURCHASE_NUMBER,d.tax_percentage as TAX,sum(a.total)as TOTAL_AMOUNT,sum(a.tax_total)as TAX_VALUE,e.company_state,c.supplier_state');
		$this->db->from('tbl_purchase_relations a');
		$this->db->join('tbl_purchase b','b.purchase_id=a.purchase_id');
		$this->db->join('mst_suppliers c','c.supplier_id=b.purchase_supplier');
		$this->db->join('mst_taxs d','d.tax_percentage=a.tax_percent');
		$this->db->join('company_details e','e.company_id = b.company_id');
		$this->db->group_by('a.purchase_id,a.tax_percent');
		if(!empty($data)){
			if($data['supplier_id'] != ''){
				$this->db->where('c.supplier_id',$data['supplier_id']);
			}
			if($data['tax_id'] != ''){
				$this->db->where('d.tax_id',$data['tax_id']);
			}
			if(isset($data['company_id'])){
				$this->db->where('e.company_id',$data['company_id']);
			}
			if(($data['date_from'] != '') && ($data['date_to'] != '')){
				$this->db->where('b.purchase_date >=',$data['date_from']);
				$this->db->where('b.purchase_date <=',$data['date_to']);
			}
		} 
		$this->db->where('a.status',1);
		//$this->db->where('b.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}

	public function get_purchase_summary_list($where = ''){
		$this->db->select('a.*,b.purchase_date,b.purchase_number,c.supplier_name,c.supplier_id,c.supplier_gst,d.tax_percentage,sum(a.tax_total)as new_tax,sum(a.total)as new_total,e.company_state,c.supplier_state');
		$this->db->from('tbl_purchase_relations a');
		$this->db->join('tbl_purchase b','b.purchase_id=a.purchase_id');
		$this->db->join('mst_suppliers c','c.supplier_id=b.purchase_supplier');
		$this->db->join('mst_taxs d','d.tax_percentage=a.tax_percent');
		$this->db->join('company_details e','e.company_id = b.company_id');
		$this->db->group_by('a.purchase_id,a.tax_percent');
		if($where != ''){
			$this->db->where($where);
		}
		$this->db->where('a.status',1); 
		//$this->db->where('b.status',1); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array(); 
			return $results;
		}else{
			return false;
		}
	}

	function get_customers_detail_excel($data = array()){
		$this->db->select('b.invoice_date as DATE,c.customer_name as CUSTOMER_NAME,c.customer_gst as CUSTOMER_GST,b.invoice_number as INVOICE_NUMBER,
			sum(a.total)as TOTAL_AMOUNT,sum(a.tax_total)as TAX_VALUE,b.invoice_loading_charges,b.invoice_transportaion_charges,b.invoice_other_expenses,b.invoice_cash_discount');
		$this->db->from('tbl_invoices_relation a');
		$this->db->join('tbl_invoices b','b.invoice_id=a.invoice_id');
		$this->db->join('mst_customers c','c.customer_id=b.invoice_customer');
		$this->db->join('mst_taxs d','d.tax_percentage=a.tax_percent');
		$this->db->join('company_details e','e.company_id = b.company_id');
		$this->db->group_by('a.invoice_id');
		if(!empty($data)){
			if($data['customer_id'] != ''){
				$this->db->where('c.customer_id',$data['customer_id']);
			}
			if(isset($data['company_id'])){
				$this->db->where('e.company_id',$data['company_id']);
			}
			if(($data['date_from'] != '') && ($data['date_to'] != '')){
				$this->db->where('b.invoice_date >=',$data['date_from']);
				$this->db->where('b.invoice_date <=',$data['date_to']);
			}
		} 
		$this->db->where('a.status',1);
		//$this->db->where('b.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}

	public function get_customers_summary_list($data = array()){
		$this->db->select('a.*,b.invoice_date,b.invoice_number,c.customer_name,c.customer_id,c.customer_gst,d.tax_percentage,sum(a.tax_total)as new_tax,sum(a.total)as new_total,b.invoice_loading_charges,b.invoice_transportaion_charges,b.invoice_other_expenses,b.invoice_cash_discount,b.company_id,e.company_state,c.customer_state');
		$this->db->from('tbl_invoices_relation a');
		$this->db->join('tbl_invoices b','b.invoice_id = a.invoice_id');
		$this->db->join('mst_customers c','c.customer_id = b.invoice_customer');
		$this->db->join('mst_taxs d','d.tax_percentage = a.tax_percent');
		$this->db->join('company_details e','e.company_id = b.company_id');
		$this->db->group_by('a.invoice_id');
		if(!empty($data)){
			if($data['customer_id'] != ''){
				$this->db->where('c.customer_id',$data['customer_id']);
			}
			if(isset($data['company_id'])){
				$this->db->where('e.company_id',$data['company_id']);
			}
			if(($data['date_from'] != '') && ($data['date_to'] != '')){
				$this->db->where('b.invoice_date >=',$data['date_from']);
				$this->db->where('b.invoice_date <=',$data['date_to']);
			}
		} 
		$this->db->where('a.status',1); 
		//$this->db->where('b.status',1); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}
	}

	public function get_customers_estimate_summary_list($data = array()){
		$this->db->select('a.*,b.estimate_date,b.estimate_number,c.customer_name,c.customer_id,sum(a.total)as new_total,b.estimate_loading_charges,b.estimate_transportaion_charges,b.estimate_other_expenses,b.estimate_cash_discount,b.company_id,e.company_state,c.customer_state');
		$this->db->from('tbl_estimates_relation a');
		$this->db->join('tbl_estimates b','b.estimate_id = a.estimate_id');
		$this->db->join('mst_customers c','c.customer_id = b.estimate_customer');
		$this->db->join('company_details e','e.company_id = b.company_id');
		$this->db->group_by('a.estimate_id');
		if(!empty($data)){
			if($data['customer_id'] != ''){
				$this->db->where('c.customer_id',$data['customer_id']);
			}
			if(isset($data['company_id'])){
				$this->db->where('e.company_id',$data['company_id']);
			}
			if(($data['date_from'] != '') && ($data['date_to'] != '')){
				$this->db->where('b.estimate_date >=',$data['date_from']);
				$this->db->where('b.estimate_date <=',$data['date_to']);
			}
		} 
		$this->db->where('a.status',1); 
		//$this->db->where('b.status',1); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}
	}

	function get_suppliers_detail_excel($data = array()){
		$this->db->select('b.purchase_date as DATE,c.supplier_name as SUPPLIER_NAME,c.supplier_gst as SUPPLIER_GST,b.purchase_number as PURCHASE_NUMBER,
			sum(a.total)as TOTAL_AMOUNT,sum(a.tax_total)as TAX_VALUE');
		$this->db->from('tbl_purchase_relations a');
		$this->db->join('tbl_purchase b','b.purchase_id=a.purchase_id');
		$this->db->join('mst_suppliers c','c.supplier_id=b.purchase_supplier');
		$this->db->join('mst_taxs d','d.tax_percentage=a.tax_percent');
		$this->db->join('company_details e','e.company_id = b.company_id');
		$this->db->group_by('a.purchase_id');
		if(!empty($data)){
			if($data['supplier_id'] != ''){
				$this->db->where('c.supplier_id',$data['supplier_id']);
			}
			if(isset($data['company_id'])){
				$this->db->where('e.company_id',$data['company_id']);
			}
			if(($data['date_from'] != '') && ($data['date_to'] != '')){
				$this->db->where('b.purchase_date >=',$data['date_from']);
				$this->db->where('b.purchase_date <=',$data['date_to']);
			}
		} 
		$this->db->where('a.status',1);
		//$this->db->where('b.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}

	function get_sales_person_details($data = array()){
		$this->db->select('a.*,b.invoice_date,b.invoice_number,c.customer_name,c.customer_id,c.customer_gst,d.tax_percentage,sum(a.tax_total)as new_tax,sum(a.total)as new_total,b.invoice_loading_charges,b.invoice_transportaion_charges,b.invoice_other_expenses,b.invoice_cash_discount,b.company_id,e.company_state,c.customer_state');
		$this->db->from('tbl_invoices_relation a');
		$this->db->join('tbl_invoices b','b.invoice_id = a.invoice_id');
		$this->db->join('mst_customers c','c.customer_id = b.invoice_customer');
		$this->db->join('mst_taxs d','d.tax_percentage = a.tax_percent');
		$this->db->join('company_details e','e.company_id = b.company_id');
		$this->db->join('mst_users f','f.user_id = b.invoice_employee');
		$this->db->group_by('a.invoice_id');
		if(!empty($data)){
			if($data['user_id'] != ''){
				$this->db->where('f.user_id',$data['user_id']);
			}
			if(isset($data['company_id'])){
				$this->db->where('e.company_id',$data['company_id']);
			}
			if(($data['date_from'] != '') && ($data['date_to'] != '')){
				$this->db->where('b.invoice_date >=',$data['date_from']);
				$this->db->where('b.invoice_date <=',$data['date_to']);
			}
		} 
		$this->db->where('a.status',1); 
		//$this->db->where('b.status',1); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}
	}

	function get_sales_person_detail_excel($data = array()){
		$this->db->select('b.invoice_date as DATE,c.customer_name as CUSTOMER_NAME,c.customer_gst as CUSTOMER_GST,b.invoice_number as INVOICE_NUMBER,
			sum(a.total)as TOTAL_AMOUNT,sum(a.tax_total)as TAX_VALUE,b.invoice_loading_charges,b.invoice_transportaion_charges,b.invoice_other_expenses,b.invoice_cash_discount');
		$this->db->from('tbl_invoices_relation a');
		$this->db->join('tbl_invoices b','b.invoice_id=a.invoice_id');
		$this->db->join('mst_customers c','c.customer_id=b.invoice_customer');
		$this->db->join('mst_taxs d','d.tax_percentage=a.tax_percent');
		$this->db->join('company_details e','e.company_id = b.company_id');
		$this->db->join('mst_users f','f.user_id = b.invoice_employee');
		$this->db->group_by('a.invoice_id');
		if(!empty($data)){
			if($data['user_id'] != ''){
				$this->db->where('f.user_id',$data['user_id']);
			}
			if(isset($data['company_id'])){
				$this->db->where('e.company_id',$data['company_id']);
			}
			if(($data['date_from'] != '') && ($data['date_to'] != '')){
				$this->db->where('b.invoice_date >=',$data['date_from']);
				$this->db->where('b.invoice_date <=',$data['date_to']);
			}
		} 
		$this->db->where('a.status',1);
		//$this->db->where('b.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}

	public function get_suppliers_summary_list($data = array()){
		$this->db->select('a.*,b.purchase_date,b.purchase_number,c.supplier_name,c.supplier_id,c.supplier_gst,d.tax_percentage,sum(a.tax_total)as new_tax,sum(a.total)as new_total');

		$this->db->select('a.*,b.purchase_date,b.purchase_number,c.supplier_name,c.supplier_id,c.supplier_gst,d.tax_percentage,sum(a.tax_total)as new_tax,sum(a.total)as new_total,b.company_id,e.company_state,c.supplier_state');
		$this->db->from('tbl_purchase_relations a');
		$this->db->join('tbl_purchase b','b.purchase_id = a.purchase_id');
		$this->db->join('mst_suppliers c','c.supplier_id = b.purchase_supplier');
		$this->db->join('mst_taxs d','d.tax_percentage = a.tax_percent');
		$this->db->join('company_details e','e.company_id = b.company_id');
		$this->db->group_by('a.purchase_id');
		if(!empty($data)){
			if($data['supplier_id'] != ''){
				$this->db->where('c.supplier_id',$data['supplier_id']);
			}
			if(isset($data['company_id'])){
				$this->db->where('e.company_id',$data['company_id']);
			}
			if(($data['date_from'] != '') && ($data['date_to'] != '')){
				$this->db->where('b.purchase_date >=',$data['date_from']);
				$this->db->where('b.purchase_date <=',$data['date_to']);
			}
		} 
		$this->db->where('a.status',1); 
		//$this->db->where('b.status',1); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array(); 
			return $results;
		}else{
			return false;
		}
	}

	public function get_products_summary_list($data = array()){
		$this->db->select('a.product_id,a.product_name,sum(a.quantity) as quantity,a.rate,c.customer_name');
		$this->db->from('tbl_invoices_relation a');
		$this->db->join('tbl_invoices b','b.invoice_id = a.invoice_id');
		$this->db->join('mst_customers c','c.customer_id = b.invoice_customer');
		//$this->db->join('tbl_stock d','d.product_id = a.product_id');
		$this->db->join('mst_products e','e.product_id = a.product_id');
		$this->db->group_by('a.product_id');
		$this->db->order_by('e.product_id');
		if(!empty($data)){
			if($data['customer_id'] != ''){
				$this->db->where('c.customer_id',$data['customer_id']);
			}
			if(($data['date_from'] != '') && ($data['date_to'] != '')){
				$this->db->where('b.invoice_date >=',$data['date_from']);
				$this->db->where('b.invoice_date <=',$data['date_to']);
			}
		} 
		$this->db->where('a.status',1); 
		//$this->db->where('b.status',1); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array(); 
			return $results;
		}else{
			return false;
		}
	}

	function get_product_detail_excel($data = array()){
		$this->db->select('c.customer_name,a.product_name as product_name,sum(a.quantity) as quantity,a.rate as rate');
		$this->db->from('tbl_invoices_relation a');
		$this->db->join('tbl_invoices b','b.invoice_id = a.invoice_id');
		$this->db->join('mst_customers c','c.customer_id = b.invoice_customer');
		//$this->db->join('tbl_stock d','d.product_id = a.product_id');
		$this->db->join('mst_products e','e.product_id = a.product_id');
		$this->db->group_by('a.product_id');
		$this->db->order_by('e.product_id');
		if(!empty($data)){
			if($data['customer_id'] != ''){
				$this->db->where('c.customer_id',$data['customer_id']);
			}
			if(($data['date_from'] != '') && ($data['date_to'] != '')){
				$this->db->where('b.invoice_date >=',$data['date_from']);
				$this->db->where('b.invoice_date <=',$data['date_to']);
			}
		} 
		$this->db->where('a.status',1); 
		//$this->db->where('b.status',1); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array(); 
			return $results;
		}else{
			return false;
		}
	}
	public function get_hsncode_summary_list($data = array()){
		$this->db->select('a.product_id,a.product_name,e.product_hsncode,sum(a.quantity) as quantity,a.rate');
		$this->db->from('tbl_invoices_relation a');
		$this->db->join('tbl_invoices b','b.invoice_id = a.invoice_id');
		$this->db->join('mst_customers c','c.customer_id = b.invoice_customer');
		//$this->db->join('tbl_stock d','d.product_id = a.product_id');
		$this->db->join('mst_products e','e.product_id = a.product_id');
		$this->db->group_by('a.product_id');
		$this->db->order_by('e.product_id');
		if(!empty($data)){
			if($data['product_id'] != ''){
				$this->db->where('e.product_id',$data['product_id']);
			}
			if(($data['date_from'] != '') && ($data['date_to'] != '')){
				$this->db->where('b.invoice_date >=',$data['date_from']);
				$this->db->where('b.invoice_date <=',$data['date_to']);
			}
		} 
		$this->db->where('a.status',1); 
		//$this->db->where('b.status',1); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array(); 
			return $results;
		}else{
			return false;
		}
	}
	function get_hsncode_detail_excel($data = array()){
		$this->db->select('a.product_name as product_name,sum(a.quantity) as quantity,a.rate as rate');
		$this->db->from('tbl_invoices_relation a');
		$this->db->join('tbl_invoices b','b.invoice_id = a.invoice_id');
		$this->db->join('mst_customers c','c.customer_id = b.invoice_customer');
		//$this->db->join('tbl_stock d','d.product_id = a.product_id');
		$this->db->join('mst_products e','e.product_id = a.product_id');
		$this->db->group_by('a.product_id');
		$this->db->order_by('e.product_id');
		if(!empty($data)){
			if($data['product_id'] != ''){
				$this->db->where('e.product_id',$data['product_id']);
			}
			if(($data['date_from'] != '') && ($data['date_to'] != '')){
				$this->db->where('b.invoice_date >=',$data['date_from']);
				$this->db->where('b.invoice_date <=',$data['date_to']);
			}
		} 
		$this->db->where('a.status',1); 
		//$this->db->where('b.status',1); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results = $query->result_array(); 
			return $results;
		}else{
			return false;
		}
	}

	//ACCOUNTS REPORT (RECEIPT REPORT)
	public function get_receipts($data = array()){
		$this->db->select('a.*,b.customer_name as name');
		$this->db->from('tbl_receipts a');
		$this->db->join('mst_customers b','b.customer_id = a.customer_id');
		if(!empty($data)){
			if($data['customer_type'] != ""){
				if($data['customer_type'] == "1"){
					$this->db->where('a.customer_type_id',$data['customer_type']);
				}else{
					$this->db->where('a.customer_type_id',$data['customer_type']);
				}
			}
			if($data['customer_id'] != ""){
				$this->db->where('a.customer_id',$data['customer_id']);
			}
			if(isset($data['date_from'])){
				if(($data['date_from'] !="") && ($data['date_to']!="")){
					$this->db->where('a.receipt_date >=',$data['date_from']);
					$this->db->where('a.receipt_date <=',$data['date_to']);
				}
			}
		}
		// if($this->session->userdata('access_level') >= 1){
		// 	$this->db->where('a.company_id',$this->session->userdata('company_id'));
		// }
		$this->db->where('a.status',1);
		$this->db->order_by('a.receipt_date','asc');
		$receipt_array = $this->db->get();
		if($receipt_array->num_rows() > 0){
			return $receipt_array->result_array();
		}else{
			return false;
		}
	}

	public function get_invoice_payments($data = array()){
		$this->db->select('a.*,c.customer_name as name,b.invoice_number,b.invoice_date');
		$this->db->from('tbl_invoice_payments a');
		$this->db->join('tbl_invoices b','b.invoice_id = a.invoice_id');
		$this->db->join('mst_customers c','c.customer_id = b.invoice_customer');
		if(!empty($data)){
			if($data['customer_id'] != ""){
				$this->db->where('a.customer_id',$data['customer_id']);
			}
			if(isset($data['date_from'])){
				if(($data['date_from'] !="") && ($data['date_to']!="")){
					$this->db->where('b.invoice_date >=',$data['date_from']);
					$this->db->where('b.invoice_date <=',$data['date_to']);
				}
			}
		}
		// if($this->session->userdata('access_level') >= 1){
		// 	$this->db->where('a.company_id',$this->session->userdata('company_id'));
		// }
		$this->db->where('a.status',1);
		$this->db->where('b.status !=',0);
		$this->db->order_by('b.invoice_date','asc');
		$invoice_query = $this->db->get();
		if($invoice_query->num_rows() > 0){
			//echo "<pre>";print_r($invoice_query->result_array());exit;
			return $invoice_query->result_array();
		}else{
			return false;
		}
	}

	public function get_estimate_payments($data = array()){
		$this->db->select('a.*,c.customer_name as name,b.estimate_number,b.estimate_date');
		$this->db->from('tbl_estimate_payments a');
		$this->db->join('tbl_estimates b','b.estimate_id = a.estimate_id');
		$this->db->join('mst_customers c','c.customer_id = b.estimate_customer');
		if(!empty($data)){
			if($data['customer_id'] != ""){
				$this->db->where('a.customer_id',$data['customer_id']);
			}
			if(isset($data['date_from'])){
				if(($data['date_from'] !="") && ($data['date_to']!="")){
					$this->db->where('b.estimate_date >=',$data['date_from']);
					$this->db->where('b.estimate_date <=',$data['date_to']);
				}
			}
		}
		// if($this->session->userdata('access_level') >= 1){
		// 	$this->db->where('a.company_id',$this->session->userdata('company_id'));
		// }
		$this->db->where('a.status',1);
		$this->db->where('b.status !=',0);
		$this->db->order_by('b.estimate_date','asc');
		$estimate_query = $this->db->get();
		if($estimate_query->num_rows() > 0){
			return $estimate_query->result_array();
		}else{
			return false;
		}
	}

	public function get_invoice_bill_payments($data = array()){
		$this->db->select('sum(a.paid_amount) as paid_amount,a.remarks,a.payment_type,d.customer_name as name,
			c.invoice_number,c.invoice_date');
		$this->db->from('tbl_invoice_payments_history a');
		$this->db->join('tbl_invoice_payments b','b.invoice_payments_id = a.invoice_payments_id');
		$this->db->join('tbl_invoices c','c.invoice_id = b.invoice_id');
		$this->db->join('mst_customers d','d.customer_id = c.invoice_customer');
		if(!empty($data)){
			if($data['customer_id'] != ""){
				$this->db->where('a.customer_id',$data['customer_id']);
			}
			if(isset($data['date_from'])){
				if(($data['date_from'] !="") && ($data['date_to']!="")){
					$this->db->where('a.payment_date >=',$data['date_from']);
					$this->db->where('a.payment_date <=',$data['date_to']);
				}
			}
		}
		// if($this->session->userdata('access_level') >= 1){
		// 	$this->db->where('a.company_id',$this->session->userdata('company_id'));
		// }
		$this->db->where('a.status',1);
		$this->db->where('b.status !=',0);
		$this->db->group_by('a.invoice_payments_id');
		$this->db->order_by('a.payment_date','asc');
		$invoice_query = $this->db->get();
		if($invoice_query->num_rows() > 0){
			return $invoice_query->result_array();
		}else{
			return false;
		}
	}

	public function get_journals($data = array()){
		$this->db->select('a.*');
		$this->db->from('tbl_journals a');
		if(isset($data['supplier_id'])){
			if($data['supplier_id']!=""){
				$this->db->where('a.journal_type','supplier');
				$this->db->where('a.supplier_id',$data['supplier_id']);
			}
		}
		if(isset($data['customer_id'])){
			if($data['customer_id']!=""){
				$this->db->where('a.journal_type','customer');
				$this->db->where('a.customer_id',$data['customer_id']);
			}
		}
		if(isset($data['date_from'])){
			if(($data['date_from']!="")&& ($data['date_to']!="")){
				$this->db->where('a.journal_date >=',$data['date_from']);
				$this->db->where('a.journal_date <=',$data['date_to']);
			}
		}
		// if($this->session->userdata('access_level') >= 1){
		// 	$this->db->where('a.company_id',$this->session->userdata('company_id'));
		// }
		if($data['report_type'] == "supplier"){
			$this->db->where('a.journal_type',$data['report_type']);
		}else{
			$this->db->where('a.journal_type','customer');
		}
		$this->db->where('a.status',1);
		$this->db->order_by('a.journal_date','asc');
		$journal_query = $this->db->get();
		if($journal_query->num_rows() > 0){
			$results = $journal_query->result_array();
			//echo "<pre>";print_r($results);exit;
			foreach($results as $key => $result){
				if($result['journal_type'] == "customer"){
					$results[$key]['name'] = $this->common->get_particular('mst_customers',array('customer_id' => $result['customer_id']),'customer_name');
				}
				if($result['journal_type'] == 'supplier'){
					$results[$key]['name'] = $this->common->get_particular('mst_suppliers',array('supplier_id' => $result['supplier_id']),'supplier_name');

				}
			}
			return $results;
		}else{
			return false;
		}
	}

	public function get_receipt_opening_balance($data = array()){
		$total_debit = 0;
		$total_credit = 0;
		if(!empty($data)){
			if($data['customer_id']!=""){
				$customer_opening_balance = $this->common->get_particular('mst_customers',array('customer_id' => $data['customer_id']),'customer_opening_balance');
				$customer_opening_balance = ($customer_opening_balance!="") ? $customer_opening_balance : 0 ;
				$total_debit = $total_debit + $customer_opening_balance;
			}
		}
		//echo "<pre>";print_r($total_credit);
		//echo "<pre>";print_r($total_debit);exit;
		if(isset($data['date_from'])){
			if(($data['date_from']!="")&& ($data['date_to']!="")){
				$this->db->select('sum(paid_amount) as total_receipt_amount');
				$this->db->from('tbl_receipts a');
				$this->db->join('mst_customers b','a.customer_id = b.customer_id');
				if(!empty($data)){
					if($data['customer_id'] != ''){
						$this->db->where('a.customer_id',$data['customer_id']);
					}
					// if(isset($data['date_from'])){
					// 	if(($data['date_from'] !='')&&($data['date_to'] !='')){
					// 		$this->db->where('a.receipt_date <',$data['date_from']);
					// 	}
					// }
				}
				// if($this->session->userdata('access_level') >= 1){
				// 	$this->db->where('a.company_id',$this->session->userdata('company_id'));
				// }
				$this->db->where('a.status',1);
				$this->db->order_by('a.receipt_date','asc');
				$receipt_query = $this->db->get();
				if($receipt_query->num_rows() > 0){
					$result = $receipt_query->row_array();
					$total_receipt_amount = ($result['total_receipt_amount']!="") ? $result['total_receipt_amount'] : 0 ;
				}else{
					$total_receipt_amount = 0;
				}
				//echo "<pre>";print_r($total_receipt_amount);exit;
				$this->db->select('sum(invoice_amount) as total_invoice_amount');
				$this->db->from('tbl_invoice_payments a');
				$this->db->join('mst_customers b','a.customer_id = b.customer_id');
				$this->db->join('tbl_invoices c','a.invoice_id = c.invoice_id');
				if(!empty($data)){
					if($data['customer_id'] != ""){
						$this->db->where('a.customer_id',$data['customer_id']);
					}
					if(isset($data['date_from'])){
						if(($data['date_from'] !='')&&($data['date_to'] !='')){
							$this->db->where('c.invoice_date <',$data['date_from']);
						}
					}
				}
				// if($this->session->userdata('access_level')>=1){
				// 	$this->db->where('b.company_id',$this->session->userdata('brand_id'));
				// }
				//$this->db->where('c.invoice_type',2);
				$this->db->where('a.status',1);
				$this->db->where('c.status !=',0);
				$this->db->order_by('c.invoice_date','asc');
				$invoice_query = $this->db->get();
				if($invoice_query->num_rows() > 0){
					$result =  $invoice_query->row_array();
					$total_invoice_amount = ($result['total_invoice_amount']!="") ? $result['total_invoice_amount'] : 0 ;
				}else{
					$total_invoice_amount = 0 ;
				}
				//echo "<pre>";print_r($total_invoice_amount);exit;
				$this->db->select('sum(a.paid_amount) as total_invoice_paid_amount');
				$this->db->from('tbl_invoice_payments_history a');
				$this->db->join('tbl_invoice_payments b','b.invoice_payments_id = a.invoice_payments_id');
				$this->db->join('tbl_invoices c','c.invoice_id = b.invoice_id');
				$this->db->join('mst_customers d','d.customer_id = c.invoice_customer');
				if(!empty($data)){
					if($data['customer_id'] != ""){
						$this->db->where('a.customer_id',$data['customer_id']);
					}
					if(isset($data['date_from'])){
						if(($data['date_from'] !='')&&($data['date_to'] !='')){
							$this->db->where('c.invoice_date <',$data['date_from']);
						}
					}
				}
				// if($this->session->userdata('access_level')>=1){
				// 	$this->db->where('b.company_id',$this->session->userdata('brand_id'));
				// }
				$this->db->where('c.invoice_type',2);
				$this->db->where('a.status',1);
				$this->db->where('b.status !=',0);
				$this->db->group_by('a.invoice_payments_id');
				//$this->db->order_by('a.payment_date','asc');
				$this->db->order_by('c.invoice_date','asc');
				$invoice_paid_query = $this->db->get();
				if($invoice_paid_query->num_rows() > 0){
					$result =  $invoice_paid_query->row_array();
					$total_invoice_paid_amount = ($result['total_invoice_paid_amount']!="") ? $result['total_invoice_paid_amount'] : 0 ;
				}else{
					$total_invoice_paid_amount = 0 ;
				}
				$this->db->select('sum(amount) as total_journal');
				$this->db->from('tbl_journals a');
				if(isset($data['supplier_id'])){
					if($data['supplier_id'] != ""){
						$this->db->where('a.journal_type','supplier');
						$this->db->where('a.supplier_id',$data['supplier_id']);
					}
				}
				if(isset($data['customer_id'])){
					if($data['customer_id'] != ""){
						$this->db->where('a.journal_type','customer');
						$this->db->where('a.customer_id',$data['customer_id']);
					}
				}
				if(isset($data['date_from'])){
					if(($data['date_from'] !='')&&($data['date_to'] !='')){
						$this->db->where('a.journal_date <',$data['date_from']);
					}
				}
				// if($this->session->userdata('access_level')>=1){
				// 	$this->db->where('b.company_id',$this->session->userdata('brand_id'));
				// }
				$this->db->where('a.status',1);
				$this->db->order_by('a.journal_date','asc');
				$journal_query = $this->db->get();
				if($journal_query->num_rows() > 0){
					$result = $journal_query->row_array();
					$total_journal = ($result['total_journal']!="") ? $result['total_journal'] : 0;
				}else{
					$total_journal = 0;
				}
				// echo "<pre>";print_r('total_credit -'.$total_credit);
				// echo "<pre>";print_r('total_debit -'.$total_debit);
				// echo "<pre>";print_r('total_journal -'.$total_journal);
				// echo "<pre>";print_r('total_receipt_amount -'.$total_receipt_amount);
				// echo "<pre>";print_r('total_invoice_paid_amount -'.$total_invoice_paid_amount);
				// echo "<pre>";print_r('total_invoice_amount -'.$total_invoice_amount);exit;
				$total_credit = ($total_credit + ($total_journal + $total_receipt_amount +         $total_invoice_paid_amount));
				$total_debit  = ($total_debit + ($total_invoice_amount));
			}
		}
		$return = array(
			'debit' 	=> $total_debit,
			'credit' 	=> $total_credit
		);
		return $return;			
	}

	//PAYMENT REPORT (ACCOUNTS MODULE)
	public function get_payments($data = array()){
		$this->db->select('a.*,b.supplier_name as name');
		$this->db->from('tbl_payments a');
		$this->db->join('mst_suppliers b','b.supplier_id = a.supplier_id');
		if(!empty($data)){
			if($data['supplier_id'] != ""){
				$this->db->where('a.supplier_id',$data['supplier_id']);
			}
			if(isset($data['date_from'])){
				if(($data['date_from'] !="") && ($data['date_to']!="")){
					$this->db->where('a.payment_date >=',$data['date_from']);
					$this->db->where('a.payment_date <=',$data['date_to']);
				}
			}
		}
		// if($this->session->userdata('access_level') >= 1){
		// 	$this->db->where('a.company_id',$this->session->userdata('company_id'));
		// }
		$this->db->where('a.status',1);
		$this->db->order_by('a.payment_date','asc');
		$payment_array = $this->db->get();
		if($payment_array->num_rows() > 0){
			return $payment_array->result_array();
		}else{
			return false;
		}
	}

	public function get_purchase_payments($data = array()){
		$this->db->select('a.*,c.supplier_name as name,b.purchase_number,b.purchase_date');
		$this->db->from('tbl_purchase_payments a');
		$this->db->join('tbl_purchase b','b.purchase_id = a.purchase_id');
		$this->db->join('mst_suppliers c','c.supplier_id = b.purchase_supplier');
		if(!empty($data)){
			if($data['supplier_id'] != ""){
				$this->db->where('a.supplier_id',$data['supplier_id']);
			}
			if(isset($data['date_from'])){
				if(($data['date_from'] !="") && ($data['date_to']!="")){
					$this->db->where('b.purchase_date >=',$data['date_from']);
					$this->db->where('b.purchase_date <=',$data['date_to']);
				}
			}
		}
		// if($this->session->userdata('access_level') >= 1){
		// 	$this->db->where('a.company_id',$this->session->userdata('company_id'));
		// }
		$this->db->where('a.status',1);
		$this->db->where('b.status !=',0);
		$this->db->order_by('b.purchase_date','asc');
		$purchase_query = $this->db->get();
		if($purchase_query->num_rows() > 0){
			return $purchase_query->result_array();
		}else{
			return false;
		}
	}

	public function get_purchase_bill_payments($data = array()){
		$this->db->select('sum(a.paid_amount) as paid_amount,a.remarks,a.payment_type as paid_type,d.supplier_name as name,
			c.purchase_number,c.purchase_date');
		$this->db->from('tbl_purchase_payments_history a');
		$this->db->join('tbl_purchase_payments b','b.purchase_payments_id = a.purchase_payments_id');
		$this->db->join('tbl_purchase c','c.purchase_id = b.purchase_id');
		$this->db->join('mst_suppliers d','d.supplier_id = c.purchase_supplier');
		if(!empty($data)){
			if($data['supplier_id'] != ""){
				$this->db->where('a.supplier_id',$data['supplier_id']);
			}
			if(isset($data['date_from'])){
				if(($data['date_from'] !="") && ($data['date_to']!="")){
					$this->db->where('a.payment_date >=',$data['date_from']);
					$this->db->where('a.payment_date <=',$data['date_to']);
				}
			}
		}
		// if($this->session->userdata('access_level') >= 1){
		// 	$this->db->where('a.company_id',$this->session->userdata('company_id'));
		// }
		$this->db->where('a.status',1);
		$this->db->where('b.status !=',0);
		$this->db->group_by('a.purchase_payments_id');
		$this->db->order_by('a.payment_date','asc');
		$purchase_payment_query = $this->db->get();
		if($purchase_payment_query->num_rows() > 0){
			return $purchase_payment_query->result_array();
		}else{
			return false;
		}
	}

	public function get_payment_opening_balance($data = array()){
		$total_debit = 0;
		$total_credit = 0;
		if(!empty($data)){
			if($data['supplier_id']!=""){
				$supplier_opening_balance = $this->common->get_particular('mst_suppliers',array('supplier_id' => $data['supplier_id']),'supplier_opening_balance');
				$supplier_opening_balance = ($supplier_opening_balance!="") ? $supplier_opening_balance : 0 ;
				$total_credit = $total_credit + $supplier_opening_balance;
			}
		}
		if(isset($data['date_from'])){
			if(($data['date_from']!="")&& ($data['date_to']!="")){
				$this->db->select('sum(paid_amount) as total_payment_amount');
				$this->db->from('tbl_payments a');
				$this->db->join('mst_suppliers b','a.supplier_id = b.supplier_id');
				if(!empty($data)){
					if($data['supplier_id'] != ''){
						$this->db->where('a.supplier_id',$data['supplier_id']);
					}
					if(isset($data['date_from'])){
						if(($data['date_from'] !='')&&($data['date_to'] !='')){
							$this->db->where('a.payment_date <',$data['date_from']);
						}
					}
				}
				// if($this->session->userdata('access_level') >= 1){
				// 	$this->db->where('a.company_id',$this->session->userdata('company_id'));
				// }
				$this->db->where('a.status',1);
				$this->db->order_by('a.payment_date','asc');
				$payment_query = $this->db->get();
				if($payment_query->num_rows() > 0){
					$result = $payment_query->row_array();
					$total_payment_amount = ($result['total_payment_amount']!="") ? $result['total_payment_amount'] : 0 ;
				}else{
					$total_payment_amount = 0;
				}
				//echo "<pre>";print_r($total_payment_amount);exit;
				$this->db->select('sum(purchase_amount) as total_purchase_amount');
				$this->db->from('tbl_purchase_payments a');
				$this->db->join('mst_suppliers b','a.supplier_id = b.supplier_id');
				$this->db->join('tbl_purchase c','a.purchase_id = c.purchase_id');
				if(!empty($data)){
					if($data['supplier_id'] != ""){
						$this->db->where('a.supplier_id',$data['supplier_id']);
					}
					if(isset($data['date_from'])){
						if(($data['date_from'] !='')&&($data['date_to'] !='')){
							$this->db->where('c.purchase_date <',$data['date_from']);
						}
					}
				}
				// if($this->session->userdata('access_level')>=1){
				// 	$this->db->where('b.company_id',$this->session->userdata('brand_id'));
				// }
				$this->db->where('a.status',1);
				$this->db->order_by('c.purchase_date','asc');
				$purchase_query = $this->db->get();
				if($purchase_query->num_rows() > 0){
					$result =  $purchase_query->row_array();
					$total_purchase_amount = ($result['total_purchase_amount']!="") ? $result['total_purchase_amount'] : 0 ;
				}else{
					$total_purchase_amount = 0 ;
				}
				//echo "<pre>";print_r($total_purchase_amount);exit;
				$this->db->select('sum(a.paid_amount) as total_purchase_paid_amount');
				$this->db->from('tbl_purchase_payments_history a');
				$this->db->join('tbl_purchase_payments b','b.purchase_payments_id = a.purchase_payments_id');
				$this->db->join('tbl_purchase c','c.purchase_id = b.purchase_id');
				$this->db->join('mst_suppliers d','d.supplier_id = c.purchase_supplier');
				if(!empty($data)){
					if($data['supplier_id'] != ""){
						$this->db->where('a.supplier_id',$data['supplier_id']);
					}
					if(isset($data['date_from'])){
						if(($data['date_from'] !='')&&($data['date_to'] !='')){
							$this->db->where('c.purchase_date <',$data['date_from']);
						}
					}
				}
				// if($this->session->userdata('access_level')>=1){
				// 	$this->db->where('b.company_id',$this->session->userdata('brand_id'));
				// }
				$this->db->where('a.status',1);
				$this->db->where('b.status !=',0);
				$this->db->group_by('a.purchase_payments_id');
				//$this->db->order_by('a.payment_date','asc');
				$this->db->order_by('c.purchase_date','asc');
				$purchase_paid_query = $this->db->get();
				if($purchase_paid_query->num_rows() > 0){
					$result =  $purchase_paid_query->row_array();
					$total_purchase_paid_amount = ($result['total_purchase_paid_amount']!="") ? $result['total_purchase_paid_amount'] : 0 ;
				}else{
					$total_purchase_paid_amount = 0 ;
				}
				$this->db->select('sum(amount) as total_journal');
				$this->db->from('tbl_journals a');
				if(isset($data['supplier_id'])){
					if($data['supplier_id'] != ""){
						$this->db->where('a.journal_type','supplier');
						$this->db->where('a.supplier_id',$data['supplier_id']);
					}
				}
				if(isset($data['customer_id'])){
					if($data['customer_id'] != ""){
						$this->db->where('a.journal_type','customer');
						$this->db->where('a.customer_id',$data['customer_id']);
					}
				}
				if(isset($data['date_from'])){
					if(($data['date_from'] !='')&&($data['date_to'] !='')){
						$this->db->where('a.journal_date <',$data['date_from']);
					}
				}
				// if($this->session->userdata('access_level')>=1){
				// 	$this->db->where('b.company_id',$this->session->userdata('brand_id'));
				// }
				$this->db->where('a.status',1);
				$this->db->order_by('a.journal_date','asc');
				$journal_query = $this->db->get();
				if($journal_query->num_rows() > 0){
					$result = $journal_query->row_array();
					$total_journal = ($result['total_journal']!="") ? $result['total_journal'] : 0;
				}else{
					$total_journal = 0;
				}
				$total_debit = ($total_debit + ($total_journal + $total_payment_amount +         $total_purchase_paid_amount));
				$total_credit  = ($total_credit + ($total_purchase_amount));
			}
		}
		$return = array(
			'debit' 	=> $total_debit,
			'credit' 	=> $total_credit
		);
		return $return;			
	}
	public function get_day_sales_report($data = array()){
		$this->db->select('a.*,b.customer_name as name');
		$this->db->from('tbl_receipts a');
		$this->db->join('mst_customers b','b.customer_id = a.customer_id');
		if(!empty($data)){
			if($data['payment_type'] != ""){
				$this->db->where('a.payment_type',$data['payment_type']);
			}
			if(isset($data['date_from'])){
				if(($data['date_from'] !='')&&($data['date_to'] !='')){
					$this->db->where('a.receipt_date >=',$data['date_from']);
					$this->db->where('a.receipt_date <=',$data['date_to']);
				}
			}
		}
		// if($this->session->userdata('access_level') >= SUPER_ADMIN_ONLY){
		// 	$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
		// }
		$this->db->where('a.status',1);
		$this->db->order_by('a.receipt_date','asc');
		$sales_query = $this->db->get();
		if($sales_query->num_rows() > 0){
			return $sales_query->result_array();
		}else{
			return false;
		}
	}
	public function get_day_purchase_report($data = array()){
		$this->db->select('a.*,b.supplier_name as name');
		$this->db->from('tbl_payments a');
		$this->db->join('mst_suppliers b','b.supplier_id = a.supplier_id');
		if(!empty($data)){
			if($data['payment_type'] != ""){
				$this->db->where('a.payment_type',$data['payment_type']);
			}
			if(isset($data['date_from'])){
				if(($data['date_from'] !='')&&($data['date_to'] !='')){
					$this->db->where('a.payment_date >=',$data['date_from']);
					$this->db->where('a.payment_date <=',$data['date_to']);
				}
			}
		}
		// if($this->session->userdata('access_level') >= SUPER_ADMIN_ONLY){
		// 	$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
		// }
		$this->db->where('a.status',1);
		$this->db->order_by('a.payment_date','asc');
		$sales_query = $this->db->get();
		if($sales_query->num_rows() > 0){
			return $sales_query->result_array();
		}else{
			return false;
		}
	}
	public function get_day_journal_report($data = array()){
		//echo "<pre>";print_r($data);exit;
		$this->db->select('a.*');
		$this->db->from('tbl_journals a');
		if(!empty($data)){
			// if($data['payment_type'] != ""){
			// 	$this->db->where('a.payment_type',$data['payment_type']);
			// }
			if(isset($data['date_from'])){
				if(($data['date_from'] !='')&&($data['date_to'] !='')){
					$this->db->where('a.journal_date >=',$data['date_from']);
					$this->db->where('a.journal_date <=',$data['date_to']);
				}
			}
		}
		// if($this->session->userdata('access_level') >= SUPER_ADMIN_ONLY){
		// 	$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
		// }
		
		$this->db->where('a.status',1);
		$this->db->order_by('a.journal_date','asc');
		$sales_query = $this->db->get();
		if($sales_query->num_rows() > 0){
			$results = $sales_query->result_array();
			//echo "<pre>";print_r($results);exit;
			foreach ($results as $key => $result) {
				if($result['journal_type'] == "customer"){
					$results[$key]['name'] = $this->common->get_particular('mst_customers',array('customer_id' => $result['customer_id']),'customer_name');
				}
				if($result['journal_type'] == 'supplier'){
					$results[$key]['name'] = $this->common->get_particular('mst_suppliers',array('supplier_id' => $result['supplier_id']),'supplier_name');
				}
			}
			//echo "<pre>";print_r($results);exit;
			return $results;
		}else{
			return false;
		}
	}
	public function get_day_expense_report($data = array()){
		//echo "<pre>";print_r($data);exit;
		$this->db->select('a.*,b.expense_category,c.name');
		$this->db->from('tbl_expenses a');
		$this->db->join('mst_expense_categories b','a.expense_category_id = b.expense_category_id');
		$this->db->join('mst_users c','c.user_id = a.person_name');
		if(!empty($data)){
			if(isset($data['date_from'])){
				if(($data['date_from'] !='')&&($data['date_to'] !='')){
					$this->db->where('a.expense_date >=',$data['date_from']);
					$this->db->where('a.expense_date <=',$data['date_to']);
				}
			}
		}
		// if($this->session->userdata('access_level') >= SUPER_ADMIN_ONLY){
		// 	$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
		// }
		$this->db->where('a.status',1);
		$this->db->order_by('a.expense_date','asc');
		$sales_query = $this->db->get();
		if($sales_query->num_rows() > 0){
			return $sales_query->result_array();
		}else{
			return false;
		}
	}
	public function get_day_payment_report($data = array()){
		$this->db->select('a.*,b.*,c.invoice_number,c.invoice_customer,d.customer_name as name');
		$this->db->from('tbl_invoice_payments_history a');
		$this->db->join('tbl_invoice_payments b','b.invoice_payments_id = a.invoice_payments_id');
		$this->db->join('tbl_invoices c','c.invoice_id = b.invoice_id');
		$this->db->join('mst_customers d','d.customer_id = c.invoice_customer');
		if(isset($data['date_from'])){
			if(($data['date_from'] !='')&&($data['date_to'] !='')){
				$this->db->where('a.payment_date >=',$data['date_from']);
				$this->db->where('a.payment_date <=',$data['date_to']);
			}
		}
		if(isset($data['payment_type'])){
			if(($data['payment_type'] !='')){
				$this->db->where('a.payment_type',$data['payment_type']);
			}
		}
		// if($this->session->userdata('access_level') >= SUPER_ADMIN_ONLY){
		// 	$this->db->where('c.branch_id',$this->session->userdata('branch_id'));
		// }
		$this->db->where('a.status',1);
		$this->db->order_by('a.payment_date','asc');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}
	public function get_day_purchase_payment_report($data = array()){
		$this->db->select('a.*,b.*,c.purchase_number,c.purchase_supplier,d.supplier_name as name');
		$this->db->from('tbl_purchase_payments_history a');
		$this->db->join('tbl_purchase_payments b','b.purchase_payments_id = a.purchase_payments_id');
		$this->db->join('tbl_purchase c','c.purchase_id = b.purchase_id');
		$this->db->join('mst_suppliers d','d.supplier_id = c.purchase_supplier');
		if(isset($data['date_from'])){
			if(($data['date_from'] !='')&&($data['date_to'] !='')){
				$this->db->where('a.payment_date >=',$data['date_from']);
				$this->db->where('a.payment_date <=',$data['date_to']);
			}
		}
		if(isset($data['payment_type'])){
			if(($data['payment_type'] !='')){
				$this->db->where('a.payment_type',$data['payment_type']);
			}
		}
		// if($this->session->userdata('access_level') >= SUPER_ADMIN_ONLY){
		// 	$this->db->where('c.branch_id',$this->session->userdata('branch_id'));
		// }
		$this->db->where('a.status',1);
		$this->db->order_by('a.payment_date','asc');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}
	public function get_day_previous_sales_report($data = array()){
		$total = 0;
		if(isset($data['date_from'])){
			if(($data['date_from'] !='')&&($data['date_to'] !='')){
				$this->db->select('sum(a.paid_amount) as total');
				$this->db->from('tbl_receipts a');
				if(!empty($data)){
					if($data['payment_type'] != ""){
						$this->db->where('a.payment_type',$data['payment_type']);
					}
				}
				$this->db->where('a.receipt_date <',$data['date_from']);
				// if($this->session->userdata('access_level') >= SUPER_ADMIN_ONLY){
				// 	$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
				// }
				$this->db->where('a.status',1);
				$this->db->order_by('a.receipt_date','asc');
				$sales_query = $this->db->get();
				if($sales_query->num_rows() > 0){
					$total = ($sales_query->row_array()['total']!="") ? $sales_query->row_array()['total'] : 0 ;
					return $total;
				}else{
					return $total;
				}
			}
		}else{
			return $total;
		}
	}
	public function get_day_previous_purchase_report($data = array()){
		$total = 0;
		if(isset($data['date_from'])){
			if(($data['date_from'] !='')&&($data['date_to'] !='')){
				$this->db->select('sum(paid_amount) as total');
				$this->db->from('tbl_payments a');
				if(!empty($data)){
					if($data['payment_type'] != ""){
						$this->db->where('a.payment_type',$data['payment_type']);
					}
				}
				$this->db->where('a.payment_date <',$data['date_from']);
				// if($this->session->userdata('access_level') >= SUPER_ADMIN_ONLY){
				// 	$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
				// }
				$this->db->where('a.status',1);
				$this->db->order_by('a.payment_date','asc');
				$sales_query = $this->db->get();
				if($sales_query->num_rows() > 0){
					$total = ($sales_query->row_array()['total']!="") ? $sales_query->row_array()['total'] : 0 ;
					return $total;
				}else{
					return $total;
				}
			}
		}else{
			return $total;
		}
	}
	public function get_day_previous_journal_supplier_report($data = array()){
		$total = 0;
		if(isset($data['date_from'])){
			if(($data['date_from'] !='')&&($data['date_to'] !='')){
				$this->db->select('a.journal_type,sum(amount) as total ');
				$this->db->from('tbl_journals a');
				$this->db->where('a.journal_date <',$data['date_from']);
				// if($this->session->userdata('access_level') >= SUPER_ADMIN_ONLY){
				// 	$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
				// }
				$this->db->where('a.status',1);
				$this->db->where('a.journal_type','supplier');
				$this->db->order_by('a.journal_date','asc');
				$sales_query = $this->db->get();
				if($sales_query->num_rows() > 0){
					$total = ($sales_query->row_array()['total']!="") ? $sales_query->row_array()['total'] : 0 ;
					return $total;
				}else{
					return $total;
				}
			}
		}else{
			return $total;
		}
	}
	public function get_day_previous_expense_report($data = array()){
		$this->db->query('SET SESSION sql_mode =
			REPLACE(REPLACE(REPLACE(
			@@sql_mode,
			"ONLY_FULL_GROUP_BY,", ""),
			",ONLY_FULL_GROUP_BY", ""),
			"ONLY_FULL_GROUP_BY", "")');
		$total = 0;
		if(isset($data['date_from'])){
			if(($data['date_from'] !='')&&($data['date_to'] !='')){
				$this->db->select('*,sum(a.expense_amount) as total');
				$this->db->from('tbl_expenses a');
				$this->db->join('mst_expense_categories b','a.expense_category_id = b.expense_category_id');
				$this->db->where('a.expense_date <',$data['date_from']);
				// if($this->session->userdata('access_level') >= SUPER_ADMIN_ONLY){
				// 	$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
				// }
				$this->db->where('a.status',1);
				$this->db->order_by('a.expense_date','asc');
				$sales_query = $this->db->get();
				if($sales_query->num_rows() > 0){
					$total = ($sales_query->row_array()['total']!="") ? $sales_query->row_array()['total'] : 0 ;
					return $total;
				}else{
					return $total;
				}
			}
		}else{
			return $total;
		}
	}
	public function get_day_previous_payment_report($data = array()){
		$total = 0;
		if(isset($data['date_from'])){
			if(($data['date_from'] !='')&&($data['date_to'] !='')){
				$this->db->select('sum(a.paid_amount) as total');
				$this->db->from('tbl_invoice_payments_history a');
				$this->db->join('tbl_invoice_payments b','b.invoice_payments_id = a.invoice_payments_id');
				$this->db->join('tbl_invoices c','c.invoice_id = b.invoice_id');
				$this->db->where('a.payment_date <',$data['date_from']);
				if(isset($data['payment_type'])){
					if(($data['payment_type'] !='')){
						$this->db->where('a.payment_type',$data['payment_type']);
					}
				}
				// if($this->session->userdata('access_level') >= SUPER_ADMIN_ONLY){
				// 	$this->db->where('c.branch_id',$this->session->userdata('branch_id'));
				// }
				$this->db->where('a.status',1);
				$this->db->order_by('a.payment_date','asc');
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$total = ($query->row_array()['total']!="") ? $query->row_array()['total'] : 0 ;
					return $total;
				}else{
					return $total;
				}
			}
		}else{
			return $total;
		}
	}
	public function get_day_previous_purchase_payment_report($data = array()){
		$total = 0;
		if(isset($data['date_from'])){
			if(($data['date_from'] !='')&&($data['date_to'] !='')){
				$this->db->select('sum(a.paid_amount) as total');
				$this->db->from('tbl_purchase_payments_history a');
				$this->db->join('tbl_purchase_payments b','b.purchase_payments_id = a.purchase_payments_id');
				$this->db->join('tbl_purchase c','c.purchase_id = b.purchase_id');
				$this->db->where('a.payment_date <',$data['date_from']);
				if(isset($data['payment_type'])){
					if(($data['payment_type'] !='')){
						$this->db->where('a.payment_type',$data['payment_type']);
					}
				}
				// if($this->session->userdata('access_level') >= SUPER_ADMIN_ONLY){
				// 	$this->db->where('c.branch_id',$this->session->userdata('branch_id'));
				// }
				$this->db->where('a.status',1);
				$this->db->order_by('a.payment_date','asc');
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$total = ($query->row_array()['total']!="") ? $query->row_array()['total'] : 0 ;
					return $total;
				}else{
					return $total;
				}
			}
		}else{
			return $total;
		}
	}
	public function get_employee_advances_report($data = array()){
		$this->db->select('*');
		$this->db->from('tbl_employee_advances a');
		if(isset($data['date_from'])){
			if(($data['date_from'] !='')&&($data['date_to'] !='')){
				$this->db->where('a.employee_advance_date >=',$data['date_from']);
				$this->db->where('a.employee_advance_date <=',$data['date_to']);
			}
		}
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}
	public function get_employee_repays_report($data = array()){
		$this->db->select('*');
		$this->db->from('tbl_employee_advance_repaids a');
		if(isset($data['date_from'])){
			if(($data['date_from'] !='')&&($data['date_to'] !='')){
				$this->db->where('a.employee_advance_repay_date >=',$data['date_from']);
				$this->db->where('a.employee_advance_repay_date <=',$data['date_to']);
			}
		}
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}
	public function get_day_previous_journal_customer_report($data = array()){
		$total = 0;
		if(isset($data['date_from'])){
			if(($data['date_from'] !='')&&($data['date_to'] !='')){
				$this->db->select('a.journal_type,sum(amount) as total ');
				$this->db->from('tbl_journals a');
				$this->db->where('a.journal_date <',$data['date_from']);
				// if($this->session->userdata('access_level') >= SUPER_ADMIN_ONLY){
				// 	$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
				// }
				$this->db->where('a.status',1);
				$this->db->where('a.journal_type','customer');
				$this->db->order_by('a.journal_date','asc');
				$sales_query = $this->db->get();
				if($sales_query->num_rows() > 0){
					$total = ($sales_query->row_array()['total']!="") ? $sales_query->row_array()['total'] : 0 ;
					return $total;
				}else{
					return $total;
				}
			}
		}else{
			return $total;
		}
	}
}
/* End of file Reports_model.php */
/* Location: ./application/models/Reports_model.php */