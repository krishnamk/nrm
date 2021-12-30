<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchase extends CI_Controller {	
	public function __construct(){
		parent::__construct();
		$this->load->model('Purchase_model','purchase');
		$this->load->model('User_model','user');
		if(!$this->session->userdata('invoice_logged_in')){
			redirect('login','refresh');
		}
	}
	//PRODUCT DETAILS
	public function get_product_details(){
		$data = $this->input->post();
		$product_detail = $this->common->get_array('mst_products',array('product_id' => $data['product_id'] ));
		$data['product_price'] = $product_detail['product_purchase_price'];
		if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1){
			$data['brand_name'] = $this->common->get_particular('mst_brands',array('brand_id' => $product_detail['product_brand'] ),'brand_name');
			$data['category_name'] = $this->common->get_particular('mst_category',array('category_id' => $product_detail['product_category'] ),'category_name');
			$data['subcategory_name'] = $this->common->get_particular('mst_subcategory',array('sub_category_id' => $product_detail['product_subcategory'] ),'sub_category_name');
		}else{
			$data['brand_name'] 		= "";
			$data['category_name'] 		= "";
			$data['subcategory_name'] 	= "";
		}
		$data['result'] = "success";
		echo json_encode($data);
	}
	public function purchase_list(){
		$data['lists'] = $this->purchase->get_purchase_lists();
		//echo '<pre>';print_r($data);exit;
		$this->template->build('purchase/purchase_list',$data);
	}
	public function purchase(){
		if($this->input->post()){
			$data = $this->input->post();
			//echo '<pre>';print_r($data);exit;
			//PURCHASE DC ENABLE
			if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_dc'),'purchase_settings_value')==1){
				$key = array_search(0,$data['purchase_dc_relation_id']);
				//echo "<pre>";print_r($key);exit;
				if($key){
					$data['purchase_dc_number'] = $this->common->get_particular('company_details',array('company_id' => $data['company_id']),'purchase_dc_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $data['company_id']),'purchase_dc_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
					$new_dc = array(
						'purchase_dc_number'			=> $data['purchase_dc_number'],
						'company_id'					=> $data['company_id'],
						'purchase_dc_date'				=> $data['purchase_date'],
						'purchase_dc_supplier'			=> $data['purchase_supplier'],
						'purchase_dc_ref_no'			=> $data['dc_no'][$key],
						'purchase_dc_no'				=> $data['dc_no'][$key],
						'dc_status'						=> 1,
						'created_on'					=> created_on(),
						'created_by'					=> created_by(),
						'status'						=> 1
					);
					$dc_id = $this->common->insert('tbl_purchase_dc',$new_dc);
					if($dc_id){
						$current_count = $this->common->get_particular('company_details',array('company_id' => $data['company_id']),'purchase_dc_prefix_count');
						$next_count = next_number($current_count);
						$this->common->update('company_details',array('purchase_dc_prefix_count' => $next_count ),array('company_id' => $data['company_id']));
					//ADDING INWARD RECORD
						$stock_inward = array(
							'date'				=> date('Y-m-d'),
							'company_id'		=> $data['company_id'],
							'remarks'			=> 'New DC Entry '.$data['purchase_dc_number'],
							'created_on'		=> created_on(),
							'created_by'		=> created_by(),
							'status'			=> 1
						);
						$stock_inward_id  = $this->common->insert('tbl_stock_inward',$stock_inward);
						foreach($data['purchase_dc_relation_id'] as $dc_key => $purchase_dc_relation_id){
							if($purchase_dc_relation_id == 0){
								$dc_relation = array(
									'purchase_dc_id'		=> $dc_id,
									'product_id'			=> $data['product_id'][$dc_key],
									'product_name'			=> $this->common->get_particular('mst_products',array('product_id' => $data['product_id'][$dc_key],'status' => 1 ),'product_name'),
									'quantity'				=> $data['quantity'][$dc_key],
									'available_quantity'	=> $data['quantity'][$dc_key],
									'rate'					=> $data['rate'][$dc_key],
									'amount'				=> $data['amount'][$dc_key],
									'tax_id'				=> $data['tax_id'][$dc_key],
									'tax_percentage'		=> $data['tax_percentage'][$dc_key],
									'tax_total'				=> $data['tax'][$dc_key],
									'total'				    => $data['total'][$dc_key],
									'created_on'			=> created_on(),
									'created_by'			=> created_by(),
									'status'				=> 1
								);
								if(isset($data['brand_name'])){
									if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
										$dc_relation['brand_id'] = $this->common->get_particular('mst_brands',array('brand_name' => $data['brand_name'][$dc_key],'status' => 1 ),'brand_id');
										$dc_relation['brand_name'] = $data['brand_name'][$dc_key];
									}
								}
								if(isset($data['category_name'])){
									if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
										$dc_relation['category_id'] = $this->common->get_particular('mst_category',array('category_name' => $data['category_name'][$dc_key],'status' => 1 ),'category_id');
										$dc_relation['category_name'] = $data['category_name'][$dc_key];
									}
								}
								
							//echo '<pre>';print_r($dc_relation);//exit;
								$dc_relation_id = $this->common->insert('tbl_purchase_dc_relations',$dc_relation);
								if($stock_inward_id){
									$inward_relation = array(
										'stock_inward_id' 		=> $stock_inward_id,
										'purchase_dc_id' 		=> $dc_id,
										'product_id'			=> $data['product_id'][$dc_key],
										'quantity'				=> $data['quantity'][$dc_key],
										'created_on'			=> created_on(),
										'created_by'			=> created_by(),
										'status'				=> 1
									);
									$stock_inward_relation_id  = $this->common->insert('tbl_stock_inward_relations',$inward_relation);
									if($stock_inward_relation_id ){
										$stock_details = $this->common->get_array('tbl_stock',array('product_id' => $data['product_id'][$dc_key]));
										if($stock_details!=""){
											$stock = array(
												'product_id'		=> $data['product_id'][$dc_key],
												'company_id'		=> $data['company_id'],
												'quantity'			=> $stock_details['quantity']+$data['quantity'][$dc_key],
												'created_on'		=> created_on(),
												'created_by'		=> created_by(),
												'status'			=> 1
											);
											$stock_id = $this->common->update('tbl_stock',$stock,array('stock_id' => $stock_details['stock_id']));
										}
									}
								}
							}
						}
						if(!empty($data['purchase_dc_no'])){
							array_push($data['purchase_dc_no'], $dc_id);
						}
					}
				}
				if($data['purchase_dc_relation_id']!=""){
					foreach ($data['purchase_dc_relation_id'] as $dc_key => $purchase_dc_relation_id) {
					//Existing relation_id  - add rate and amount
						if($purchase_dc_relation_id != 0){
							$dc_update = array(
								'quantity'				=> $data['quantity'][$dc_key],
								'available_quantity'	=> $data['quantity'][$dc_key],
								'rate'					=> $data['rate'][$dc_key],
								'amount'				=> $data['amount'][$dc_key],
								'tax_id'				=> $data['tax_id'][$dc_key],
								'tax_percentage'		=> $data['tax_percentage'][$dc_key],
								'tax_total'				=> $data['tax'][$dc_key],
								'total'				    => $data['total'][$dc_key],
								'updated_on'			=> created_on(),
								'updated_by'			=> created_by(),
								'status'				=> 1
							);
							//echo '<pre>';print_r($dc_update);exit;
							$dc_relation_id = $this->common->update('tbl_purchase_dc_relations',$dc_update,array('purchase_dc_relation_id' => $purchase_dc_relation_id));
						}
					}
				}
			}
			//PURCHASE DC ENABLE
			if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_dc'),'purchase_settings_value')==1){
				//PURCHASE
				$new_purchase = array(
					'purchase_number'				=> $data['purchase_number'],
					'company_id'					=> $data['company_id'],
					'purchase_date'					=> $data['purchase_date'],
					'purchase_supplier'				=> $data['purchase_supplier'],
					'tax_included'					=> $data['tax_included'],
					'tax_type'						=> $data['tax_type'],
					'purchase_bill_no'				=> $data['purchase_bill_no'],
					'purchase_dc_id'				=> implode(', ', $data['purchase_dc_no']),
					'created_on'					=> created_on(),
					'created_by'					=> created_by(),
					'status'						=> 1
				);
			}else{
				$new_purchase = array(
					'purchase_number'				=> $data['purchase_number'],
					'company_id'					=> $data['company_id'],
					'purchase_date'					=> $data['purchase_date'],
					'purchase_supplier'				=> $data['purchase_supplier'],
					'tax_included'					=> $data['tax_included'],
					'tax_type'						=> $data['tax_type'],
					'purchase_bill_no'				=> $data['purchase_bill_no'],
					'purchase_ref_no'				=> $data['purchase_ref_no'],
					'created_on'					=> created_on(),
					'created_by'					=> created_by(),
					'status'						=> 1
				);
			}
			//echo "<pre>";print_r($new_purchase);//exit;
			$purchase_id = $this->common->insert('tbl_purchase',$new_purchase);
			if($purchase_id){
				$current_count = $this->common->get_particular('company_details',array('company_id' => $data['company_id']),'purchase_prefix_count');
				$next_count = next_number($current_count);
				$this->common->update('company_details',array('purchase_prefix_count' => $next_count ),array('company_id' => $data['company_id']));
				$purchase_total = 0;
				//IF PURCHASE DC ENABLE
				if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_dc'),'purchase_settings_value')==1){
					foreach ($data['purchase_dc_no'] as $key => $purchase_dc_no) {
						$purchase_products = $this->purchase->get_purchase_products($purchase_dc_no);
						foreach ($purchase_products as $key => $purchase_product) {
							$purchase_total = $purchase_total + $purchase_product['total'];
							$relation = array(
								'purchase_id'			=> $purchase_id,
								'product_id'			=> $purchase_product['product_id'],
								'product_name'			=> $purchase_product['product_name'],
								'brand_id'				=> $purchase_product['brand_id'],
								'tax_id'				=> $purchase_product['tax_id'],
								'tax_percent'			=> $purchase_product['tax_percentage'],
								'tax_total'				=> $purchase_product['tax_total'],
								'quantity'				=> $purchase_product['quantity'],
								'available_quantity'	=> $purchase_product['quantity'],
								'rate'					=> $purchase_product['rate'],
								'total'					=> $purchase_product['total'],
								'created_on'			=> created_on(),
								'created_by'			=> created_by(),
								'status'				=> 1
							);
							if(isset($purchase_product['brand_name'])){
								if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
									$relation['brand_name'] = $purchase_product['brand_name'];
								}
							}
							if(isset($purchase_product['category_name'])){
								if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
									$relation['category_name'] = $purchase_product['category_name'];
								}
							}
						    //echo "<pre>";print_r($relation);//exit;
							$purchase_relation_id = $this->common->insert('tbl_purchase_relations',$relation);
							if($data['purchase_dc_no']){
								foreach ($data['purchase_dc_no'] as $key => $purchase_dc_no) {
									$purchase_dc_status = array('dc_status' => 2);
									$purchase_dc_update = $this->common->update('tbl_purchase_dc',$purchase_dc_status,array('purchase_dc_id' => $purchase_dc_no));
								}
							}
						}
					}
				}else{
				//CODE FOR WITHOUT PURCHASE DC
					$temp_products = $this->purchase->get_temp_listings();
				    //echo "<pre>";print_r($temp_products);exit;
					if($temp_products){
						foreach ($temp_products as $key => $product) {
							//echo "<pre>";print_r($product);exit;
							$purchase_total = $purchase_total + $product['total'];
							$relation = array(
								'purchase_id'			=> $purchase_id,
								'product_id'			=> $product['product_id'],
								'product_name'			=> $product['product_name'],
								//'image'					=> $product['image'],
								'tax_id'				=> $product['tax_id'],
								'tax_percent'			=> $product['tax_percent'],
								'tax_total'				=> $product['tax_total'],
								'quantity'				=> $product['quantity'],
								'available_quantity'	=> $product['quantity'],
								'rate'					=> $product['rate'],
								'total'					=> $product['total'],
								'created_on'			=> created_on(),
								'created_by'			=> created_by(),
								'status'				=>	1
							);
							if(isset($product['product_brand'])){
								if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
									$relation['brand_id']   = $product['product_brand'];
									$relation['brand_name'] = $product['brand_name'];
								}
							}
							if(isset($product['product_category'])){
								if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
									$relation['category_id'] = $product['product_category'];
									$relation['category_name'] = $product['category_name'];
								}
							}
							if(isset($product['product_subcategory'])){
								if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){
									$relation['subcategory_id'] = $product['product_subcategory'];
									$relation['subcategory_name'] = $product['sub_category_name'];
								}
							}
						    //echo "<pre>";print_r($relation);exit;
							$purchase_relation_id = $this->common->insert('tbl_purchase_relations',$relation);
						//IF STOCK TO BE ADD
							if($data['product_stock_add']=='1'){
						// ADDING INWARD RECORD
								$stock_inward = array(
									'date'				=> date('Y-m-d'),
									'company_id'		=> $data['company_id'],
									'remarks'			=> 'Direct Purchase Entry '.$data['purchase_bill_no'],
									'created_on'		=> created_on(),
									'created_by'		=> created_by(),
									'status'			=> 1
								);
								$stock_inward_id  = $this->common->insert('tbl_stock_inward',$stock_inward);
								if($stock_inward_id){
									$inward_relation = array(
										'stock_inward_id' 		=> $stock_inward_id,
										'purchase_relation_id' 	=> $purchase_relation_id,
										'product_id'			=> $product['product_id'],
										'quantity'				=> $product['quantity'],
										'created_on'			=> created_on(),
										'created_by'			=> created_by(),
										'status'				=> 1
									);
									$stock_inward_relation_id  = $this->common->insert('tbl_stock_inward_relations',$inward_relation);
									if($stock_inward_relation_id ){
										$stock_details = $this->common->get_array('tbl_stock',array('product_id' => $product['product_id']));
									//echo "<pre>";print_r($stock_details);exit;
										if($stock_details!=""){
											$stock = array(
												'product_id'		=> $product['product_id'],
												'company_id'		=> $data['company_id'],
												'quantity'			=> $stock_details['quantity']+$product['quantity'],
												'created_on'		=> created_on(),
												'created_by'		=> created_by(),
												'status'			=> 1
											);
										//echo "<pre>";print_r($stock);exit;
											$stock_id = $this->common->update('tbl_stock',$stock,array('stock_id' => $stock_details['stock_id']));
										}
									}
								}
							}
						}
					}
				}
				$purchase_payment = array(
					'supplier_id' 		=> $data['purchase_supplier'],
					'company_id'		=> $data['company_id'],
					'purchase_id'		=> $purchase_id,
					'purchase_amount' 	=> $purchase_total,
					'purchase_status' 	=> 0,
					'created_on' 		=> created_on(),
					'created_by' 		=> created_by(),
					'status' 			=> 1
				);
				$purchase_payments_id  = $this->common->insert('tbl_purchase_payments',$purchase_payment);
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $data['company_id'],
					'log_category_id'	=> 7,
					'operation'			=> 'Purchase Created',
					'operation_details'	=> 'Purchase Created For -'.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $data['purchase_supplier']),'supplier_name'),
					'purchase_id'		=> $purchase_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' => 'success',
					'message' => 'Purchase Added Successfully'
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('purchase_view/'.$purchase_id));
			}else{
				$message = array(
					'result'	=> 'failed',
					'message'	=> 'Purchase Adding Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect(base_url('purchase'));
		}else{
			$this->common->truncate('tbl_purchase_relation_temp');
			$data['purchase_number'] = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'purchase_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'purchase_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			$data['suppliers'] = convert_options($this->common->gets_array('mst_suppliers',array('status' => 1)),'supplier_id','supplier_name','SUPPLIER');
			//COMPANY LIST IF MULTIPLE COMPANY ENABLE
			if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){
				if($this->session->userdata('access_level')==1){
					$data['company_lists'] = array_column($this->user->get_company_list(), 'company_name');
				}elseif($this->session->userdata('access_level')==2){
					$data['company_lists'] = array_column($this->user->get_current_user_companies(), 'company_name');
				}
			}
			//echo "<pre>";print_r($data);exit;
			$this->template->build('purchase/purchase',$data);
		}
	}
	public function purchase_view($purchase_id){
		$data = $this->purchase->get_purchase_details($purchase_id);
		//echo "<pre>";print_r($data);exit;
		$this->template->build('purchase/purchase_view',$data);
	}
	public function purchase_edit($purchase_id){
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);exit;
			//PURCHASE DC ENABLE
			if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_dc'),'purchase_settings_value')==1){
				$key = array_search(0,$data['purchase_dc_relation_id']);
				if($key){
					$data['purchase_dc_number'] = $this->common->get_particular('company_details',array('company_id' => $data['company_id']),'purchase_dc_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $data['company_id']),'purchase_dc_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' =>'estimate_number_of_zeros'),'settings_value'), '0', STR_PAD_LEFT);
					$new_dc = array(
						'purchase_dc_number'			=> $data['purchase_dc_number'],
						'company_id'					=> $data['company_id'],
						'purchase_dc_date'				=> $data['purchase_date'],
						'purchase_dc_supplier'			=> $data['purchase_supplier'],
						'purchase_dc_ref_no'			=> $data['dc_no'][$key],
						'purchase_dc_no'				=> $data['dc_no'][$key],
						'created_on'					=> created_on(),
						'created_by'					=> created_by(),
						'status'						=> 1
					);
					$dc_id = $this->common->insert('tbl_purchase_dc',$new_dc);
					if($dc_id){
						$current_count = $this->common->get_particular('company_details',array('company_id' => $data['company_id']),'purchase_dc_prefix_count');
						$next_count = next_number($current_count);
						$this->common->update('company_details',array('purchase_dc_prefix_count' => $next_count ),array('company_id' => $data['company_id']));
					// ADDING INWARD RECORD
						$stock_inward = array(
							'date'				=> date('Y-m-d'),
							'company_id'		=> $data['company_id'],
							'remarks'			=> 'New DC Entry '.$data['purchase_dc_number'],
							'created_on'		=> created_on(),
							'created_by'		=> created_by(),
							'status'			=> 1
						);
						$stock_inward_id  = $this->common->insert('tbl_stock_inward',$stock_inward);
						foreach ($data['purchase_dc_relation_id'] as $dc_key => $purchase_dc_relation_id) {
							if($purchase_dc_relation_id == 0){
								$dc_relation = array(
									'purchase_dc_id'		=> $dc_id,
									'product_id'			=> $data['product_id'][$dc_key],
									'product_name'			=> $this->common->get_particular('mst_products',array('product_id' => $data['product_id'][$dc_key],'status' => 1 ),'product_name'),
									'quantity'				=> $data['quantity'][$dc_key],
									'available_quantity'	=> $data['quantity'][$dc_key],
									'rate'					=> $data['rate'][$dc_key],
									'amount'				=> $data['amount'][$dc_key],
									'tax_id'				=> $data['tax_id'][$dc_key],
									'tax_percentage'		=> $data['tax_percentage'][$dc_key],
									'tax_total'				=> $data['tax'][$dc_key],
									'total'				    => $data['total'][$dc_key],
									'created_on'			=> created_on(),
									'created_by'			=> created_by(),
									'status'				=> 1
								);
								if(isset($data['brand_name'])){
									if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
										$dc_relation['brand_id'] = $this->common->get_particular('mst_brands',array('brand_name' => $data['brand_name'][$dc_key],'status' => 1 ),'brand_id');
										$dc_relation['brand_name'] = $data['brand_name'][$dc_key];
									}
								}
								if(isset($data['category_name'])){
									if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
										$dc_relation['category_id'] = $this->common->get_particular('mst_category',array('category_name' => $data['category_name'][$dc_key],'status' => 1 ),'category_id');
										$dc_relation['category_name'] = $data['category_name'][$dc_key];
									}
								}
							//echo '<pre>';print_r($dc_relation);//exit;
								$dc_relation_id = $this->common->insert('tbl_purchase_dc_relations',$dc_relation);
								if($stock_inward_id){
									$inward_relation = array(
										'stock_inward_id' 		=> $stock_inward_id,
										'purchase_dc_id' 		=> $dc_id,
										'product_id'			=> $data['product_id'][$dc_key],
										'quantity'				=> $data['quantity'][$dc_key],
										'created_on'			=> created_on(),
										'created_by'			=> created_by(),
										'status'				=> 1
									);
									$stock_inward_relation_id  = $this->common->insert('tbl_stock_inward_relations',$inward_relation);
									if($stock_inward_relation_id ){
										$stock_details = $this->common->get_array('tbl_stock',array('product_id' => $data['product_id'][$dc_key]));
										if($stock_details!=""){
											$stock = array(
												'product_id'		=> $data['product_id'][$dc_key],
												'company_id'		=> $data['company_id'],
												'quantity'			=> $stock_details['quantity']+$data['quantity'][$dc_key],
												'created_on'		=> created_on(),
												'created_by'		=> created_by(),
												'status'			=> 1
											);
											$stock_id = $this->common->update('tbl_stock',$stock,array('stock_id' => $stock_details['stock_id']));
										}
									}
								}
							}
						}
						if(!empty($data['purchase_dc_id'])){
							array_push($data['purchase_dc_id'], $dc_id);
						}
					}
				}
				if($data['purchase_dc_relation_id']!=""){
					foreach ($data['purchase_dc_relation_id'] as $dc_key => $purchase_dc_relation_id) {
					//Existing relation_id  - add rate and amount
						if($purchase_dc_relation_id != 0){
							$dc_update = array(
								'quantity'				=> $data['quantity'][$dc_key],
								'available_quantity'	=> $data['quantity'][$dc_key],
								'rate'					=> $data['rate'][$dc_key],
								'amount'				=> $data['amount'][$dc_key],
								'tax_id'				=> $data['tax_id'][$dc_key],
								'tax_percentage'		=> $data['tax_percentage'][$dc_key],
								'tax_total'				=> $data['tax'][$dc_key],
								'total'				    => $data['total'][$dc_key],
								'updated_on'			=> created_on(),
								'updated_by'			=> created_by(),
								'status'				=> 1
							);
						//echo '<pre>';print_r($dc_update);exit;
							$dc_relation_id = $this->common->update('tbl_purchase_dc_relations',$dc_update,array('purchase_dc_relation_id' => $purchase_dc_relation_id));
						}
					}
				}
			}
		//PURCHASE DC ENABLE
			if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_dc'),'purchase_settings_value')==1){
			//PURCHASE
				$purchase_update = array(
					'purchase_number'				=> $data['purchase_number'],
					'company_id'					=> $data['company_id'],
					'purchase_date'					=> $data['purchase_date'],
					'purchase_supplier'				=> $data['purchase_supplier'],
					'tax_included'					=> $data['tax_included'],
					'tax_type'						=> $data['tax_type'],
					'purchase_bill_no'				=> $data['purchase_bill_no'],
					'purchase_dc_id'				=> implode(', ', $data['purchase_dc_id']),
					'created_on'					=> created_on(),
					'created_by'					=> created_by(),
					'status'						=> 1
				);
			}else{
				$purchase_update = array(
					'purchase_number'				=> $data['purchase_number'],
					'company_id'					=> $data['company_id'],
					'purchase_date'					=> $data['purchase_date'],
					'purchase_supplier'				=> $data['purchase_supplier'],
					'tax_included'					=> $data['tax_included'],
					'tax_type'						=> $data['tax_type'],
					'purchase_bill_no'				=> $data['purchase_bill_no'],
					'created_on'					=> created_on(),
					'created_by'					=> created_by(),
					'status'						=> 1
				);
			}
			//echo "<pre>";print_r($purchase_update);//exit;
			$purchase_id = $this->common->update('tbl_purchase',$purchase_update,array('purchase_id' => $purchase_id));
			if($purchase_id){
				$this->existing_purchase_stock($purchase_id);
				$purchase_total = 0;
				//IF PURCHASE DC ENABLE
				if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_dc'),'purchase_settings_value')==1){
					foreach ($data['purchase_dc_id'] as $key => $purchase_dc_no) {
						$purchase_products = $this->purchase->get_purchase_products($purchase_dc_no);
					//echo '<pre>';print_r($purchase_products);exit;
						foreach ($purchase_products as $key => $purchase_product) {
						//echo '<pre>';print_r($purchase_product);exit;
							$purchase_total = $purchase_total + $purchase_product['total'];
							$relation = array(
								'purchase_id'			=> $purchase_id,
								'product_id'			=> $purchase_product['product_id'],
								'product_name'			=> $purchase_product['product_name'],
								'tax_id'				=> $purchase_product['tax_id'],
								'tax_percent'			=> $purchase_product['tax_percentage'],
								'tax_total'				=> $purchase_product['tax_total'],
								'quantity'				=> $purchase_product['quantity'],
								'available_quantity'	=> $purchase_product['quantity'],
								'rate'					=> $purchase_product['rate'],
								'total'					=> $purchase_product['total'],
								'created_on'			=> created_on(),
								'created_by'			=> created_by(),
								'status'				=> 1
							);
							if(isset($purchase_product['brand_id'])){
								if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
									$relation['brand_id'] = $purchase_product['brand_id'];
									$relation['brand_name'] = $purchase_product['brand_name'];
								}
							}
							if(isset($purchase_product['category_id'])){
								if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
									$relation['category_id'] = $purchase_product['category_id'];
									$relation['category_name'] = $purchase_product['category_name'];
								}
							}
						//echo "<pre>";print_r($relation);exit;
							$purchase_relation_id = $this->common->insert('tbl_purchase_relations',$relation);
							if($data['purchase_dc_id']){
								foreach ($data['purchase_dc_id'] as $key => $purchase_dc_id) {
									$purchase_dc_status = array('dc_status' => 2);
									$purchase_dc_update = $this->common->update('tbl_purchase_dc',$purchase_dc_status,array('purchase_dc_id' => $purchase_dc_id));
								}
							}
						}
					}
				}else{
					//CODE FOR WITHOUT PURCHASE DC
					$temp_products = $this->purchase->get_temp_listings();
					//echo "<pre>";print_r($temp_products);//exit;
					if($temp_products){
						foreach ($temp_products as $key => $product) {
							$purchase_total = $purchase_total + $product['total'];
							$relation = array(
								'purchase_id'			=> $purchase_id,
								'product_id'			=> $product['product_id'],
								'product_name'			=> $product['product_name'],
								'tax_id'				=> $product['product_tax'],
								'tax_percent'			=> $product['tax_percentage'],
								'tax_total'				=> $product['tax_total'],
								'quantity'				=> $product['quantity'],
								'available_quantity'	=> $product['quantity'],
								'rate'					=> $product['rate'],
								'total'					=> $product['total'],
								'created_on'			=> created_on(),
								'created_by'			=>	created_by(),
								'status'				=>	1
							);
							if(isset($product['product_brand'])){
								if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
									$relation['brand_id'] = $product['product_brand'];
									$relation['brand_name'] = $product['brand_name'];
								}
							}
							if(isset($product['product_category'])){
								if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
									$relation['category_id'] = $product['product_category'];
									$relation['category_name'] = $product['category_name'];
								}
							}
							if(isset($product['product_subcategory'])){
								if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){
									$relation['subcategory_id'] = $product['product_subcategory'];
									$relation['subcategory_name'] = $product['sub_category_name'];
								}
							}
						//echo "<pre>";print_r($relation);exit;
							$purchase_relation_id = $this->common->insert('tbl_purchase_relations',$relation);
						//IF STOCK TO BE ADD
							if($data['product_stock_add']=='1'){
						// ADDING INWARD RECORD
								$stock_inward = array(
									'date'				=> date('Y-m-d'),
									'company_id'		=> $data['company_id'],
									'remarks'			=> 'Direct Purchase Entry '.$data['purchase_bill_no'],
									'created_on'		=> created_on(),
									'created_by'		=> created_by(),
									'status'			=> 1
								);
								$stock_inward_id  = $this->common->insert('tbl_stock_inward',$stock_inward);
								if($stock_inward_id){
									$inward_relation = array(
										'stock_inward_id' 		=> $stock_inward_id,
										'purchase_relation_id' 	=> $purchase_relation_id,
										'product_id'			=> $product['product_id'],
										'quantity'				=> $product['quantity'],
										'created_on'			=> created_on(),
										'created_by'			=> created_by(),
										'status'				=> 1
									);
									$stock_inward_relation_id  = $this->common->insert('tbl_stock_inward_relations',$inward_relation);
									if($stock_inward_relation_id ){
										$stock_details = $this->common->get_array('tbl_stock',array('product_id' => $product['product_id']));
										if($stock_details!=""){
											$stock = array(
												'product_id'		=> $product['product_id'],
												'company_id'		=> $data['company_id'],
												'quantity'			=> $stock_details['quantity']+$product['quantity'],
												'created_on'		=> created_on(),
												'created_by'		=> created_by(),
												'status'			=> 1
											);
											$stock_id = $this->common->update('tbl_stock',$stock,array('stock_id' => $stock_details['stock_id']));
										}
									}
								}
							}
						}
					}
				}
				$purchase_payment = array(
					'supplier_id'		=> $data['purchase_supplier'],
					'company_id'		=> $data['company_id'],
					'purchase_id'		=> $purchase_id,
					'purchase_amount'	=> $purchase_total,
					'purchase_status'	=> 0,
					'updated_on'		=> created_on(),
					'updated_by'		=> created_by(),
					'status'			=> 1
				);
				$purchase_payments_id  = $this->common->update('tbl_purchase_payments',$purchase_payment,array('purchase_id' => $purchase_id ));
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $data['company_id'],
					'log_category_id'	=> 7,
					'operation'			=> 'Purchase Updated',
					'operation_details'	=> 'Purchase Updated For -'.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $data['purchase_supplier']),'supplier_name'),
					'purchase_id'		=> $purchase_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' => 'success',
					'message' => 'Purchase Added Successfully'
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('purchase_view/'.$purchase_id));
			}else{
				$message = array(
					'result'	=> 'failed',
					'message'	=> 'Purchase Adding Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect(base_url('purchase'));
		}else{
			$data['purchase_details'] = $this->common->get_array('tbl_purchase',array('purchase_id' => $purchase_id ));
			$data['total_products'] = $this->common->count('tbl_purchase_relations',array('purchase_id' => $purchase_id,'status' => 1));
			$this->common->truncate('tbl_purchase_relation_temp');
			$this->add_temp_products($purchase_id);
			//IF PURCHASE DC ENABLE
			if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_dc'),'purchase_settings_value')==1){
				$data['temp_products'] = $this->get_purchase_dc_list_detail($purchase_id);
			}else{
				$data['temp_products'] = $this->temp_listing();
			}
			$data['purchase_number'] = $data['purchase_details']['purchase_number'];
			$data['suppliers'] = convert_options_selected($this->common->gets_array('mst_suppliers',array('status' => 1)),'supplier_id','supplier_name','SUPPLIER',$data['purchase_details']['purchase_supplier']);
			//IF PURCHASE DC ENABLE
			if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' =>
				'purchase_dc'),'purchase_settings_value')==1){
				$data['dc_no']	= multi_select($this->common->gets_array('tbl_purchase_dc', array('status' => 1)),'purchase_dc_no','purchase_dc_id',$data['purchase_details']['purchase_dc_id']);
		}
		//COMPANY LIST IF MULTIPLE COMPANY ENABLE
		if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){
			$data['company_lists'] 	= convert_options_selected($this->common->gets_array('company_details',array('company_status' =>1,'company_id' => $data['purchase_details']['company_id'])),'company_id','company_name','COMPANY',$data['purchase_details']['company_id']);
		}
		$this->template->build('purchase/purchase',$data);
	}
}
public function purchase_remove($purchase_id){
	$update_array = array(
		'status' => 0
	);
	$update_result = $this->common->update('tbl_purchase',$update_array,array('purchase_id' => $purchase_id));
	if($update_result){
		$log = array(
			'user_id'			=> $this->session->userdata('user_id'),
			'company_id'			=> $this->session->userdata('company_id'),
			'log_category_id'	=> 7,
			'operation'			=> 'Purchase Deleted',
			'operation_details'	=> 'Purchase Deleted For -'.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $data['purchase_supplier']),'supplier_name'),
			'purchase_id'		=> $purchase_id,
			'logs_status'		=> 0,
			'created_on'		=> created_on(),
			'status'			=> 1
		);
		$log_id = $this->common->insert('tbl_logs',$log);
		$message = array(
			'result' => 'success',
			'message' => 'Purchase Removed Successfully'
		);
	}else{
		$message = array(
			'result' => 'failed',
			'message' => 'Purchase Remove Failed'
		);
	}
	$this->session->set_userdata('msg',$message);
	redirect(base_url('purchase_list'));
}
public function temp_purchase_delete(){
	$purchase_relation_temp_id = $this->input->post('purchase_relation_temp_id');
		//IF PURCHASE EDIT - DELETE (THAT DELETED STOCK TO BE REDUCED FROm STOCK)
	$purchase_temp_details = $this->common->get_array('tbl_purchase_relation_temp',array('purchase_relation_temp_id' => $purchase_relation_temp_id));
		//STOCK DELETED QTY TO BE REDUCED
	if($purchase_temp_details ){
		$stock_details = $this->common->get_array('tbl_stock',array('product_id' => $purchase_temp_details['product_id']));
		if($stock_details!=""){
			$stock = array(
				'product_id'		=> $purchase_temp_details['product_id'],
				'company_id'			=> $this->session->userdata('company_id'),
				'quantity'			=> $stock_details['quantity']-$purchase_temp_details['quantity'],
				'updated_on'		=> created_on(),
				'updated_by'		=> created_by(),
				'status'			=> 1
			);
			$stock_id = $this->common->update('tbl_stock',$stock,array('stock_id' => $stock_details['stock_id']));
		}
		$update_result = $this->common->remove('tbl_purchase_relation_temp',array('purchase_relation_temp_id' => $purchase_relation_temp_id));
		if($update_result){
			$message = array(
				'result' => 'success',
				'message' => 'Purchase Removed Successfully'
			);
		}else{
			$message = array(
				'result' => 'failed',
				'message' => 'Purchase Remove Failed'
			);
		}
	}
	$this->session->set_userdata('msg',$message);
	$message['display_message'] = return_message($message);
	echo json_encode($message);
}
public function purchase_print($purchase_id){
	$data = $this->purchase->get_purchase_details($purchase_id);
		//echo "<pre>";print_r($data);exit;
	$html = $this->load->view('purchase/purchase_print',$data,true);
	$this->load->library('pdf');
	$pdf = $this->pdf->load();
	$pdf->WriteHTML($html);
	$pdf->Output('PURCHASE_PRINT.pdf','I');
}
public function purchase_download($purchase_id){
	$data = $this->purchase->get_purchase_details($purchase_id);
		//echo "<pre>";print_r($data);exit;
	$html = $this->load->view('purchase/purchase_print',$data,true);
	$this->load->library('pdf');
	$pdf = $this->pdf->load();
	$pdf->WriteHTML($html);
	$pdf->Output('PURCHASE_PRINT.pdf','D');
}
	//PURCHASE EDIT - IF STOCK EXIST (REDUCED)
public function existing_purchase_stock($purchase_id){
		//IT STOCK NEED 
	if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_stock_add'),'purchase_settings_value')==1){
		$data = $this->purchase->get_purchase_details($purchase_id);
		if($data['relations']){
			foreach ($data['relations'] as $key => $relation) {
				$stock = array(
					'product_id'	=> $relation['product_id'],
					'quantity'		=> $relation['quantity'],
				);
				$stock_result = $this->purchase->reduce_product_stock($stock);
			}
		}
	}
	$update = array(
		'status' => 0
	);
	$update_result = $this->common->update('tbl_purchase_relations',$update,array('purchase_id' => $purchase_id ));
}
public function add_temp_products($purchase_id){
	$products = $this->common->gets_array('tbl_purchase_relations',array('purchase_id' => $purchase_id, 'status' => 1));
	if($products){
		foreach ($products as $key => $product) {
			$new_temp = array(
				'purchase_relation_id'	=> $product['purchase_relation_id'],
				'product_id'			=> $product['product_id'],
				'tax_id'				=> $product['tax_id'],
				'tax_percent'			=> $product['tax_percent'],
				'tax_total'				=> $product['tax_total'],
				'quantity'				=> $product['quantity'],
				'rate'					=> $product['rate'],
				'total'					=> $product['total'],
				'created_on'			=> created_on(),
				'created_by'			=> created_by(),
				'status'				=> 1
			);
			$purchase_relation_id = $this->common->insert('tbl_purchase_relation_temp',$new_temp);
		}
	}
}
public function add_temprory_purchase(){
	$data = $this->input->post();
	//echo "<pre>";print_r($data);exit;
	if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_tax_included'),'purchase_settings_value')==1) {
		$new_purchase_temp = array(
			'product_id'			=> $data['product_id'],
			'product_name'			=> $this->common->get_particular('mst_products',array('product_id' => $data['product_id']),'product_name'),
			'quantity'				=> $data['purchase_quantity'],
			'rate'					=> $data['purchase_rate'],
			'tax_id'				=> $data['tax_id'],
			'tax_percent'			=> $this->common->get_particular('mst_taxs',array('tax_id' => $data['tax_id']),'tax_percentage'),
			'tax_total'				=> $data['tax_total'],
			'amount'				=> $data['purchase_quantity'] * $data['purchase_rate'],
			'total'					=> $data['purchase_total'],
			'created_on'			=> created_on(),
			'created_by'			=> created_by(),
			'status'				=> 1
		);
	}else{
		$new_purchase_temp = array(
			'product_id'			=> $data['product_id'],
			'product_name'			=> $this->common->get_particular('mst_products',array('product_id' => $data['product_id']),'product_name'),
			'quantity'				=> $data['purchase_quantity'],
			'rate'					=> $data['purchase_rate'],
			'total'					=> $data['purchase_total'],
			'created_on'			=> created_on(),
			'created_by'			=> created_by(),
			'status'				=> 1
		);
	}
	if(isset($data['purchase_brand'])){
		$new_purchase_temp['brand_id'] = $this->common->get_particular('mst_brands',array('brand_name' => $data['purchase_brand']),'brand_id');
		$new_purchase_temp['brand_name'] = $data['purchase_brand'];
	}
	if(isset($data['purchase_category'])){
		$new_purchase_temp['category_id'] = $this->common->get_particular('mst_category',array('category_name' => $data['purchase_category']),'category_id');
		$new_purchase_temp['category_name'] = $data['purchase_category'];
	}
	//echo "<pre>";print_r($new_purchase_temp);exit;
	$purchase_relation_temp_id = $this->common->insert('tbl_purchase_relation_temp',$new_purchase_temp);
	if($purchase_relation_temp_id){
		$message = array(
			'result'	=> 'success',
			'message'	=> 'Temp Product Added Successfully'
		);
	}else{
		$message = array(
			'result'	=> 'failed',
			'message'	=> 'Temp Product Adding Failed'
		);
	}
	$message['listings'] = $this->temp_listing();
	$message['display_message'] = return_message($message);
	echo json_encode($message);
}
private function temp_listing(){
	$data['lists'] = $this->purchase->get_temp_listings();
    //echo "<pre>";print_r($data);exit;
	$content = $this->load->view('purchase/includes/temp_listing', $data, TRUE);
	return $content;
}
public function purchase_calculation(){
	if($this->input->post()){
		$data = $this->input->post();
		$total = ($data['purchase_rate'] * $data['purchase_quantity']);
		$return = array('result' => 'success', 'message' => 'calculations done','total' => $total  );
	}else{
		$return = array('result' => 'failed', 'message' => 'parameters empty' );
	}
	echo json_encode($return);
}
	//REMOVE TEMPRORY PURCHASE ORDER
public function remove_temp_purchase(){
	$purchase_temp_id = $this->input->post('purchase_temp_id');
	if($purchase_temp_id!=''){
		$temp_details = $this->common->get_array('tbl_purchase_relation_temp',array('purchase_relation_id' => $purchase_temp_id ));
		$remove = $this->common->remove('tbl_purchase_relation_temp',array('purchase_relation_temp_id' => $purchase_temp_id ));
		if($remove){
			$message = array(
				'result' 	=> 'success',
				'message' 	=> 'Product removed from invoice successfully',
			);
		}else{
			$message = array(
				'result' 	=> 'failed',
				'message' 	=> 'Product remove from invoice failed',
			);
		}
	}else{
		$message = array(
			'result' 	=> 'failed',
			'message' 	=> 'parameter empty',
		);
	}
	$message['listings'] = $this->temp_listing();
	$message['display_message'] = return_message($message);
	echo json_encode($message);
}
public function get_supplier_based_dc(){
	$supplier_id = $this->input->post('supplier_id');
	$data['purchase_dcs'] =  convert_options($this->common->gets_array('tbl_purchase_dc',array('purchase_dc_supplier' =>$supplier_id,'status' => 1,'dc_status' => 1)),'purchase_dc_id','purchase_dc_no','PURCHASE DC');
		//echo '<pre>';print_r($data);exit;
	$data['result'] = "success";
	echo json_encode($data);
}
public function get_purchase_dc_details(){
	$purchase_dc_no = $this->input->post('purchase_dc_no');
		//echo '<pre>';print_r($purchase_dc_no);exit;
	$content = "";
	$data['count'] = 0;
	if(!empty($purchase_dc_no)){
		foreach ($purchase_dc_no as $key => $purchase_dc) {
			$data['purchase_dc_details'] = $this->common->gets_array('tbl_purchase_dc_relations',array('purchase_dc_id' => $purchase_dc,'status' => 1));
			$data['purchase_dc_no'] = $this->common->get_particular('tbl_purchase_dc',array('purchase_dc_id' => $purchase_dc,'status' => 1),'purchase_dc_no');
			$data['purchase_ref_no'] = $this->common->get_particular('tbl_purchase_dc',array('purchase_dc_id' => $purchase_dc,'status' => 1),'purchase_dc_ref_no');
			$content .= $this->load->view('purchase/includes/purchase_dc_temp_listing',$data,TRUE);
				//echo '<pre>';print_r($content);exit;
			$data['count'] = ($data['count'] + $this->common->count('tbl_purchase_dc_relations',array('purchase_dc_id' => $purchase_dc,'status' => 1)));
		}
		$message = array(
			'result'	=> 'success',
			'message'	=> 'Temp Product Added Successfully'
		);
	}else{
		$message = array(
			'result'	=> 'failed',
			'message'	=> 'Temp Product Adding Failed'
		);
	}
	$message['count'] = $data['count'];
	$message['listings'] = $content;
	$message['display_message'] = return_message($message);
	echo json_encode($message);
}
public function get_purchase_dc_list_detail($purchase_id){
	$purchase_dc_id = explode(',',$this->common->get_particular('tbl_purchase',array('purchase_id' => $purchase_id),'purchase_dc_id'));
		//echo '<pre>';print_r($purchase_dc_id);//exit;
	$content = "";
	$data['count'] = 0;
	if(!empty($purchase_dc_id)){
		foreach ($purchase_dc_id as $key => $purchase_dc) {
			$data['purchase_dc_details'] = $this->common->gets_array('tbl_purchase_dc_relations',array('purchase_dc_id' => $purchase_dc,'status' => 1));
			$data['purchase_dc_no'] = $this->common->get_particular('tbl_purchase_dc',array('purchase_dc_id' => $purchase_dc),'purchase_dc_no');
			$data['purchase_ref_no'] = $this->common->get_particular('tbl_purchase_dc',array('purchase_dc_id' => $purchase_dc),'purchase_dc_ref_no');
			$content .= $this->load->view('purchase/includes/purchase_dc_temp_listing',$data,TRUE);
			$data['count'] = ($data['count'] + $this->common->count('tbl_purchase_dc_relations',array('purchase_dc_id' => $purchase_dc,'status' => 1)));
		}
	}
	return $content;
}
public function add_purchase_dc_new_row(){
	$data['count'] = $this->input->post('key');
	$content = "";
	if($content==""){
		$content = $this->load->view('purchase/includes/add_purchase_dc_new_row',$data,TRUE);
		$data['count'] = $data['count'] + 1;
		$message = array(
			'result'	=> 'success',
			'message'	=> 'Empty Row Added Successfully'
		);
	}else{
		$message = array(
			'result'	=> 'failed',
			'message'	=> 'Temp Product Adding Failed'
		);
	}
	$message['count'] = $data['count'];
	$message['listings'] = $content;
	$message['display_message'] = return_message($message);
	echo json_encode($message);
}
public function purchase_product_calculations(){
	$data = $this->input->post();
	if(!empty($data)){
		$amount = $data['quantity'] * $data['rate'];
		echo json_encode(array('result' => 'success','amount' => $amount));
	}else{
		echo json_encode(array('result' => 'failed'));
	}
}
public function purchase_product_total_calculations(){
	$product_qty 	= $this->input->post('quantity');
	$product_price  = $this->input->post('rate');
	$tax_type 		= $this->input->post('tax_type');
	$tax_id 		= $this->input->post('tax_id');
	$tax_percentage = $this->common->get_particular('mst_taxs',array('tax_id' => $tax_id),'tax_percentage');
	$amount = $product_qty * $product_price;
	if($tax_type == 1){
		if($tax_percentage == 18){
			$tax = round( ( ( $product_price - ( $product_price / 1.18 ) ) ),2);
			$total_tax = round( ( $tax * $product_qty ),2);
			$product_price = round(( $product_price / 1.18 ),2) ;
			$product_total = round(($product_price * $product_qty)+$total_tax);
		}elseif($tax_percentage == 5){
			$tax = round( ( ( $product_price - ( $product_price / 1.05 ) ) ),2);
			$total_tax = round( ( $tax * $product_qty ),2);
			$product_price = round(( $product_price / 1.05 ),2) ;
			$product_total = round(($product_price * $product_qty)+$total_tax);
		}elseif($tax_percentage == 28){
			$tax = round( ( ( $product_price - ( $product_price / 1.28 ) ) ),2);
			$total_tax = round( ( $tax * $product_qty ),2);
			$product_price = round(( $product_price / 1.28 ),2) ;
			$product_total = round(($product_price * $product_qty)+$total_tax);
		}else{
			$tax = round( ( ( $product_price - ( $product_price / 1.12 ) ) ),2);
				//echo '<pre>';print_r("tax : ");print_r($tax);//exit;
			$total_tax = round( ( $tax * $product_qty ),2);
				//echo '<pre>';print_r("total_tax : ");print_r($total_tax);
			$product_price = round(( $product_price / 1.12 ),2) ;
				//echo '<pre>';print_r("product_price : ");print_r($product_price);
			$product_total = round(($product_price * $product_qty)+$total_tax);
				//echo '<pre>';print_r("product_total : ");print_r($product_total);exit;
		}
	}else{
		$tax = (($product_price*$tax_percentage/100));
			//echo '<pre>';print_r("tax : ");print_r($tax);//exit;
		$total_tax = ($tax*$product_qty);
			//echo '<pre>';print_r("total_tax : ");print_r($total_tax);
		$product_total = (($product_price*$product_qty)+($total_tax));
			//echo '<pre>';print_r("product_total : ");print_r($product_total);exit;
	}
	echo json_encode(array(
		'result'=>'success',
		'amount' => sprintf("%.2f",$amount),
		'tax_percentage' => $tax_percentage,
		'total_tax' => sprintf("%.2f",$total_tax),
		'product_total' => sprintf("%.2f",$product_total),
	));
}
	//Change Settings
public function change_purchase_setting($value){
		//IF value = 1 (change setting into direct estimate else value = 2 (change setting into dc to estimate))
	if($value!=""){
		if($value == 1){
			$update_settings = array(
				'purchase_settings_name' 	=> 'purchase_dc',
				'purchase_settings_value' 	=> 0
			);
			$update = $this->common->update('mst_purchase_settings',$update_settings,array('purchase_settings_name' => 'purchase_dc','purchase_settings_value' => 1));
		}else{
			$update_settings = array(
				'purchase_settings_name' 	=> 'purchase_dc',
				'purchase_settings_value' 	=> 1
			);
			$update = $this->common->update('mst_purchase_settings',$update_settings,array('purchase_settings_name' => 'purchase_dc','purchase_settings_value' => 0));
		}
		$message = array(
			'result'	=> 'Success',
			'message'	=> 'Changes Updated successfully'
		);
	}else{
		$message = array(
			'result'	=> 'failed',
			'message'	=> 'Changes Updated Failed'
		);
	}
	$this->session->set_userdata('msg',$message);
	redirect(base_url('purchase'));
}
}
/* End of file purchase.php */
/* Location: ./application/app/controllers/purchase.php */