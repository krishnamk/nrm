<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Estimate_model extends CI_Model {
	public function get_estimate_lists($data = array()){
		$this->db->select('a.estimate_id,a.estimate_number,a.estimate_customer,a.estimate_type,a.estimate_date,a.status,b.customer_name,a.created_by,a.estimate_cancel');
		$this->db->from('tbl_estimates a');
		$this->db->join('mst_customers b','a.estimate_customer = b.customer_id');
		$this->db->where('a.estimate_approved',1);
		$this->db->order_by('a.estimate_id','desc');
		if(isset($data['customer_id'])){
			if($data['customer_id'] !=''){
				$this->db->where('b.customer_id',$data['customer_id']);
			}
		}
		if(isset($data['date_from'])){
			if(($data['date_from'] !='')&&($data['date_to'] !='')){
				$this->db->where('a.estimate_date >=',$data['date_from']);
				$this->db->where('a.estimate_date <=',$data['date_to']);
			}
		}
		// if($this->session->userdata('access_level') != 1){
		// 	$this->db->where('a.company_id',$this->session->userdata('company_id'));
		// }
		$query = $this->db->get();
		if ($query->num_rows() > 0 ) {
			$results = $query->result_array();
			foreach ($results as $key => $result) {
				$this->db->select('SUM(a.total) as estimate_total');
				$this->db->from('tbl_estimates_relation a'); 
				$this->db->where('a.estimate_id',$result['estimate_id']);
				$this->db->where('a.status',1);
				$relation_query = $this->db->get();
				if($relation_query->num_rows() > 0){
					$estimate_relation = $relation_query->row_array();
					//echo '<pre>';print_r($relation_query->result_array());exit;
					if($estimate_relation['estimate_total']!=""){
						$results[$key]['estimate_total'] = $estimate_relation['estimate_total'];
					}else{
						$results[$key]['estimate_total'] = 0;
					}
				}else{
					$results[$key]['estimate_total'] = 0;
				}
			}
			return $results;
		} else {
			return false;
		}
	}
	public function get_temp_listings(){
		$this->db->select('a.*,b.product_name,b.product_brand,b.product_category,b.product_subcategory,b.product_description,b.product_tax,f.tax_percentage,f.tax_name');
		$this->db->from('tbl_estimates_relation_temp a');
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
	public function get_estimate_details($estimate_id){
		$this->db->select('a.*');
		$this->db->from('tbl_estimates a');
		$this->db->join('mst_customers b','a.estimate_customer = b.customer_id');
		$this->db->where('estimate_id',$estimate_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['estimate_details'] = $query->row_array();
		}else{
			$data['estimate_details'] = false;
		}
		$data['company_details'] = $this->company_details($data['estimate_details']['company_id']);
		$this->db->select('a.*,b.state_name');
		$this->db->from('mst_customers a');
		$this->db->join('mst_state b','a.customer_state = b.state_code'); 
		$this->db->where('a.customer_id',$data['estimate_details']['estimate_customer']);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['customer_details'] = $query->row_array();
		}else{
			$data['customer_details'] = false;
		}
		$this->db->select('*');
		$this->db->from('tbl_estimates_relation');
		$this->db->where('estimate_id',$estimate_id);
		$this->db->where('status!=',0);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data['relations'] = $query->result_array();
		}else{
			$data['relations'] = false;
		}
		$this->db->select('sum(a.total) as pre_total,b.estimate_loading_charges,b.estimate_transportaion_charges,b.estimate_other_expenses');
		$this->db->from('tbl_estimates_relation a');
		$this->db->join('tbl_estimates b','b.estimate_id = a.estimate_id');
		$this->db->where('a.estimate_id',$estimate_id);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row_array();
			$data['pre_total'] = ($result['pre_total'] == "") ? 0 : $result['pre_total'] ;
			$data['final_total'] = $data['pre_total'] + $result['estimate_loading_charges']+ $result['estimate_transportaion_charges']+ $result['estimate_other_expenses'];
		}else{
			$data['pre_total'] = 0;
			$data['final_total'] = 0;
		}
		//TRANSPORT MODE DETAILS
		$this->db->select('a.dc_number,a.transport_mode,a.transport_name,a.transport_vechile_no');
		$this->db->from('tbl_dcs a');
		$this->db->join('tbl_estimates b','b.dc_id = a.dc_id');
		$this->db->where('b.estimate_id',$estimate_id);
		$dc_query = $this->db->get();
		$data['dc_details'] = $dc_query->row_array();
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
	//estimate PAYMENT LISTS
	function get_estimate_payment_list(){
		$this->db->select('a.*,b.estimate_number,b.estimate_date,c.customer_name');
		$this->db->from('tbl_estimate_payments a');
		$this->db->join('tbl_estimates b','b.estimate_id = a.estimate_id');
		$this->db->join('mst_customers c','c.customer_id = a.customer_id');
		$this->db->where('a.status',1);
		$this->db->where('b.status!=',0);
		$this->db->order_by('a.created_on','desc');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$results =  $query->result_array();
			foreach ($results as $key => $result) {
				$this->db->select('sum(paid_amount) as paid_amount');
				$this->db->from('tbl_estimate_payments_history');
				$this->db->where('estimate_payments_id',$result['estimate_payments_id']); 
				$this->db->where('status',1); 
				$history_query = $this->db->get();
				if($history_query->num_rows() > 0){
					$history = $history_query->row_array();
					$history['paid_amount'] = ($history['paid_amount']!='') ? $history['paid_amount'] : 0 ;
					$balance_amount = $result['estimate_amount'] - $history['paid_amount'];
					$results[$key]['paid_amount'] = $history['paid_amount'];
					$results[$key]['balance_amount'] = $balance_amount;
				}else{
					$results[$key]['paid_amount'] = 0;
					$results[$key]['balance_amount'] = $result['estimate_amount'];
				}
			}
			return $results;
		}
	}
	function get_estimate_detail_bills($payments_id){
		$this->db->select('a.*,b.estimate_number,b.estimate_date,c.customer_id,c.customer_name');
		$this->db->from('tbl_estimate_payments a');
		$this->db->join('tbl_estimates b','b.estimate_id = a.estimate_id');
		$this->db->join('mst_customers c','c.customer_id = a.customer_id');
		$this->db->where('a.estimate_payments_id',$payments_id); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result =  $query->row_array();
			$this->db->select('*');
			$this->db->from('tbl_estimate_payments_history');
			$this->db->where('estimate_payments_id',$payments_id); 
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
	function get_estimate_temp_listings(){
		$this->db->select('a.*,c.product_name,c.product_brand,c.product_category,c.product_subcategory,c.product_tax,g.tax_name,g.tax_percentage');
		$this->db->from('tbl_estimates_relation_temp a');
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
	public function get_estimate_products(){
		$this->db->select('a.*,a.product_id,b.product_name,f.tax_name,f.tax_percentage,a.stock_id,a.quantity,a.rate,a.total');
		$this->db->from('tbl_estimates_relation_temp a');
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

	function get_dcs_relation_details($dc_id){
		$this->db->select('b.dc_id,count(a.dc_relation_id) as total_dc_relation_id');
		$this->db->from('tbl_dcs_relation a');
		$this->db->join('tbl_dcs b','b.dc_id = a.dc_id');
		$this->db->where('a.dc_id',$dc_id);
		$this->db->group_by('a.dc_id');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$dcs_id = $query->row_array();
			//echo "<pre>";print_r($dcs_id);//exit;
			$this->db->select('count(a.dc_relation_id) as total_estimate_dc_relation_id');
			$this->db->from('tbl_estimates_relation a');
			$this->db->join('tbl_dcs_relation b','b.dc_relation_id = a.dc_relation_id');
			$this->db->where('a.dc_id',$dc_id);
			$this->db->where('a.status',1);
			$this->db->where('b.status',1);
			$this->db->group_by('a.dc_id');
			$relation_query = $this->db->get();
			if($relation_query->num_rows() > 0){
				$relations = $relation_query->row_array();
				//echo "<pre>";print_r($relations);exit;
				if($dcs_id['total_dc_relation_id'] == $relations['total_estimate_dc_relation_id']){
					$dc_update = array(
						'status' => 2,
						'updated_on' => created_on(),
						'updated_by' => created_by()
					);
					$this->db->update('tbl_dcs',$dc_update,array('dc_id' => $dc_id));
				}
			}
			return true;
		}else{
			return false;
		}
	}
	function check_dcs_relation_details($dc_relation_id){
		$this->db->select('a.quantity');
		$this->db->from('tbl_dcs_relation a');
		$this->db->where('a.dc_relation_id',$dc_relation_id);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$dcs_id = $query->row_array();
			$this->db->select('sum(a.quantity) as total_estimate_quantity');
			$this->db->from('tbl_estimates_relation a');
			$this->db->join('tbl_dcs_relation b','b.dc_relation_id = a.dc_relation_id');
			$this->db->where('a.dc_relation_id',$dc_relation_id);
			$this->db->where('a.status',1);
			$this->db->group_by('a.dc_relation_id');
			$relation_query = $this->db->get();
			if($relation_query->num_rows() > 0){
				$relations = $relation_query->row_array();
				if($dcs_id['quantity'] == $relations['total_estimate_quantity']){
					$dc_relation_update = array(
						'status' 			=> 2,
						'balance_quantity' 	=> 0,
						'updated_on' 		=> created_on(),
						'updated_by' 		=> created_by()
					);
					$this->db->update('tbl_dcs_relation',$dc_relation_update,array('dc_relation_id' => $dc_relation_id));
				}else{
					$dc_relation_update = array(
						'balance_quantity' 	=> $dcs_id['quantity']-$relations['total_estimate_quantity'],
						'updated_on' 		=> created_on(),
						'updated_by' 		=> created_by()
					);
					$this->db->update('tbl_dcs_relation',$dc_relation_update,array('dc_relation_id' => $dc_relation_id));
				}
			}
			return true;
		}else{
			return false;
		}
	}
	function check_dc_status($dc_id){
		$this->db->select('count(a.dc_relation_id) as total_dc_relation_id');
		$this->db->from('tbl_dcs_relation a');
		$this->db->join('tbl_dcs b','b.dc_id = a.dc_id');
		$this->db->where('a.dc_id',$dc_id);
		$this->db->where('a.status!=',2);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$dcs_id = $query->row_array();
			if($dcs_id['total_dc_relation_id'] <= 0){
				$dc_update = array(
					'status' 		=> 2,
					'dc_status' 	=> 2,
					'updated_on' 	=> created_on(),
					'updated_by' 	=> created_by()
				);
				//echo "<pre>";print_r($dc_update);exit;
				$this->db->update('tbl_dcs',$dc_update,array('dc_id' => $dc_id));
			}
			return true;
		}else{
			return false;
		}
	}
	function estimate_temp_total(){
		$this->db->select('sum(a.total) as sub_total');
		$this->db->from('tbl_estimates_relation_temp a');
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row_array();
			$results['sub_total'] = $result['sub_total'];
			return $results;
		}else{
			return false;
		}
	}
}
/* End of file estimate_model.php */
/* Location: ./application/app/models/estimate_model.php */