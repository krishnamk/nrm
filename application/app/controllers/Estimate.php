<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
class Estimate extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Estimate_model','estimate');
		$this->load->model('User_model','user');
		if(!$this->session->userdata('invoice_logged_in')){
			redirect('login','refresh');
		}
	}
	//PRODUCT DETAILS
	public function get_product_details(){
		$data = $this->input->post();
		$product_detail = $this->common->get_array('mst_products',array('product_id' => $data['product_id'] ));
		$data['product_price'] = $product_detail['product_mrp'];
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
	public function estimate_list(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['lists'] = $this->estimate->get_estimate_lists($data);
			//echo '<pre>';print_r($data);exit;
			if($data['option'] == 'view'){
				$this->template->build('estimate/estimate_list',$data);
			}else{
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$html = $this->load->view('estimate/estimate_list_pdf',$data,true);
				$pdf->WriteHTML($html);
				$pdf->Output('estimate_listing_pdf.pdf','I');
			}
		}else{
			$data['lists'] = $this->estimate->get_estimate_lists();
		    //echo '<pre>';print_r($data);exit;
			$this->template->build('estimate/estimate_list',$data);
		}
	}
	public function estimate(){
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);//exit;
			$temp_products = $this->estimate->get_temp_listings();
			//echo "<pre>";print_r($temp_products);//exit;
			$estimate_number = $this->common->get_particular('company_details',array('company_id' => $data['company_id']),'estimate_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $data['company_id']),'estimate_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			if($temp_products){
				if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_dc_to_estimate_generate'),'estimate_settings_value') != 1) {
					$estimate = array(
						'company_id'				=>	$data['company_id'],
						'estimate_number'     		=>	$estimate_number,
						'estimate_date' 	  		=>	date('Y-m-d',strtotime($data['estimate_date'])),
						'estimate_type'   			=>	$data['estimate_type'],
						'estimate_customer'   		=>	$data['estimate_customer'],
						'estimate_employee'			=>	$data['estimate_employee'],
						'estimate_approved'			=>	1,
						'estimate_cancel'			=>	0,
						'estimate_cash_discount'	=> 	$data['estimate_cash_discount'],
						'estimate_loading_charges' 	=> $data['estimate_loading_charges'],
						'estimate_transportaion_charges' => $data['estimate_transportaion_charges'],
						'estimate_other_expenses' 	=> $data['estimate_other_expenses'],
						'total_bundle' 				=> $data['total_bundle'],
						'reverse_charge' 			=> $data['reverse_charge'],
						'date_of_supply' 			=> date('Y-m-d',strtotime($data['date_of_supply'])),
						'place_of_supply' 			=> $data['place_of_supply'],
						'created_on'				=>	created_on(),
						'created_by'				=>	created_by(),
						'status'					=>	1
					);
				}elseif(isset($data['estimate_overall_discount'])){
					$estimate = array(
						'company_id'				=>	$data['company_id'],
						'estimate_number'     		=>	$estimate_number,
						'estimate_date' 	  		=>	date('Y-m-d',strtotime($data['estimate_date'])),
						'estimate_type'   			=>	$data['estimate_type'],
						'estimate_customer'   		=>	$data['estimate_customer'],
						//'estimate_employee'			=>	$data['estimate_employee'],
						'dc_id'						=>  implode(',',$data['dc_no']),
						'estimate_overall_discount'	=>  $data['estimate_overall_discount'] ? $data['estimate_overall_discount'] : "",
						'estimate_approved'			=>	1,
						'estimate_cancel'			=>	0,
						'estimate_cash_discount'	=> 	$data['estimate_cash_discount'],
						'estimate_loading_charges' 	=> $data['estimate_loading_charges'],
						'estimate_transportaion_charges' => $data['estimate_transportaion_charges'],
						'estimate_other_expenses' 	=> $data['estimate_other_expenses'],
						'total_bundle' 				=> $data['total_bundle'],
						'reverse_charge' 			=> $data['reverse_charge'],
						'date_of_supply' 			=> date('Y-m-d',strtotime($data['date_of_supply'])),
						'place_of_supply' 			=> $data['place_of_supply'],
						'created_on'				=>	created_on(),
						'created_by'				=>	created_by(),
						'status'					=>	1
					);
				}else{
					$estimate = array(
						'company_id'				=>	$data['company_id'],
						'estimate_number'     		=>	$estimate_number,
						'estimate_date' 	  		=>	date('Y-m-d',strtotime($data['estimate_date'])),
						'estimate_type'   			=>	$data['estimate_type'],
						'estimate_customer'   		=>	$data['estimate_customer'],
						'estimate_employee'			=>	$data['estimate_employee'],
						'dc_id'						=>  implode(',',$data['dc_no']),
						'estimate_approved'			=>	1,
						'estimate_cancel'			=>	0,
						'estimate_cash_discount'	=> 	$data['estimate_cash_discount'],
						'estimate_loading_charges' 	=> $data['estimate_loading_charges'],
						'estimate_transportaion_charges' => $data['estimate_transportaion_charges'],
						'estimate_other_expenses' 	=> $data['estimate_other_expenses'],
						'total_bundle' 				=> $data['total_bundle'],
						'reverse_charge' 			=> $data['reverse_charge'],
						'date_of_supply' 			=> date('Y-m-d',strtotime($data['date_of_supply'])),
						'place_of_supply' 			=> $data['place_of_supply'],
						'created_on'				=>	created_on(),
						'created_by'				=>	created_by(),
						'status'					=>	1
					);
				}
				//echo "<pre>";print_r($estimate);//exit;
				$estimate_id = $this->common->insert('tbl_estimates',$estimate);
				if($estimate_id){
					$additonal_expenses_and_tax = 0;
					if(isset($data['estimate_loading_charges'])){
						$additonal_expenses_and_tax = $additonal_expenses_and_tax + $data['estimate_loading_charges'] ;
					}
					if(isset($data['estimate_transportaion_charges'])){
						$additonal_expenses_and_tax = $additonal_expenses_and_tax + $data['estimate_transportaion_charges'] ;
					}
					if(isset($data['estimate_other_expenses'])){
						$additonal_expenses_and_tax = $additonal_expenses_and_tax + $data['estimate_other_expenses'] ;
					}
					$current_count =$this->common->get_particular('company_details',array('company_id' => $data['company_id']),'estimate_prefix_count');
					$next_count = next_number($current_count);
					$this->common->update('company_details',array('estimate_prefix_count' => $next_count ),array('company_id' => $data['company_id']));
					$estimate_total = 0;
					//DISCOUNT MODULE
					if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){
						foreach ($data['dc_relation_id'] as $relation_key => $dc_relation_id) {
							$dc_relation_details = $this->common->get_array('tbl_dcs_relation',array('dc_relation_id' => $dc_relation_id,'status' => 1));
							$relations = array(
								'estimate_id'			=> $estimate_id,
								'product_id'			=> $dc_relation_details['product_id'],
								'dc_id'					=> $data['dc_id'][$relation_key],
								'dc_relation_id'		=> $data['dc_relation_id'][$relation_key],
								'product_name'			=> $dc_relation_details['product_name'],
								'rate'					=> $data['rate'][$relation_key],
								'quantity'				=> $data['estimate_quantity'][$relation_key],
								'available_quantity'	=> $data['estimate_quantity'][$relation_key],
								'discount_percentage'   => $data['discount_percentage'][$relation_key],
								'pre_total'				=> $data['after_discount_price'][$relation_key],
								'tax_percent'			=> $data['tax_percentage'][$relation_key],
								'tax_total'				=> $data['tax_total'][$relation_key],
								'total'					=> $data['final_total'][$relation_key],
								'created_on'			=> created_on(),
								'created_by'			=> created_by(),
								'status'				=> 1
							);
							if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
								$relations['brand_name'] = $dc_relation_details['brand_name'];
							}
							if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
								$relations['category_name'] = $dc_relation_details['category_name'];
							}
							if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){
								$relations['subcategory_name'] = $dc_relation_details['sub_category_name'];
							}
							//echo "<pre>";print_r($relations);exit;
							$estimate_relation_id = $this->common->insert('tbl_estimates_relation',$relations);
							$estimate_total = $estimate_total+$data['final_total'][$relation_key];
							if($estimate_relation_id){
								//DC Relation Status Change
								$dc_relation_updated = $this->estimate->check_dcs_relation_details($dc_relation_id);
							}
						}
						//DC status change
						if($dc_relation_updated){
							if($data['dc_no']){
								foreach ($data['dc_no'] as $key => $dc_id) {
									$this->estimate->check_dc_status($dc_id);
								}
							}
						}
					}elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){
						//echo "<pre>";print_r("2");//exit;
						foreach ($data['dc_relation_id'] as $relation_key => $dc_relation_id) {
							//echo "<pre>";print_r($dc_relation_id);//exit;
							$dc_relation_details = $this->common->get_array('tbl_dcs_relation',array('dc_relation_id' => $dc_relation_id,'status' => 1));
							//echo "<pre>";print_r($dc_relation_details);//exit;
							$relations = array(
								'estimate_id'			=> $estimate_id,
								'product_id'			=> $dc_relation_details['product_id'],
								'dc_id'					=> $data['dc_id'][$relation_key],
								'dc_relation_id'		=> $dc_relation_details['dc_relation_id'],
								'product_name'			=> $dc_relation_details['product_name'],
								'rate'					=> $data['rate'][$relation_key],
								'quantity'				=> $data['estimate_quantity'][$relation_key],
								'available_quantity'	=> $data['estimate_quantity'][$relation_key],
								'discount_percentage'   => $data['discount_percentage'][$relation_key],
								'pre_total'				=> $data['after_discount_price'][$relation_key],
								'total'					=> $data['final_total'][$relation_key],
								'created_on'			=> created_on(),
								'created_by'			=> created_by(),
								'status'				=> 1
							);
							if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
								$relations['brand_name'] = $dc_relation_details['brand_name'];
							}
							if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
								$relations['category_name'] = $dc_relation_details['category_name'];
							}
							if(isset($dc_relation_details['sub_category_name'])&&($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){
								$relations['subcategory_name'] = $dc_relation_details['sub_category_name'];
							}
							//echo "<pre>";print_r($relations);//exit;
							$estimate_relation_id = $this->common->insert('tbl_estimates_relation',$relations);
							$estimate_total = $estimate_total+$data['final_total'][$relation_key];
							if($estimate_relation_id){
								//DC Relation Status Change
								$dc_relation_updated = $this->estimate->check_dcs_relation_details($dc_relation_id);
								//echo "<pre>";print_r($dc_relation_updated);exit;
							}
						}
						//DC status change
						if($dc_relation_updated){
							if($data['dc_no']){
								foreach ($data['dc_no'] as $key => $dc_id) {
									$this->estimate->check_dc_status($dc_id);
								}
							}
						}
					}else{
						if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_dc_to_estimate_generate'),'estimate_settings_value')!= 1){foreach ($temp_products as $key => $product) {
							//echo "<pre>";print_r("3");exit;
							//DEFAULT TAX CALCULATION BASED ON estimate PRICE
							$product_detail = $this->common->get_array('mst_products',array('product_id' =>$product['product_id']));
							$tax_percentage = $this->common->get_particular('mst_taxs', array('tax_id' => $product_detail['product_tax']),'tax_percentage');
							$amount = $product['rate']*$product['quantity'];
							$tax_total = ($amount) * $tax_percentage/100;
							if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1){
								$total = $amount + $tax_total;
							}else{
								$total = $amount;
							}
							$relations = array(
								'estimate_id'			=> $estimate_id,
								'product_id'			=> $product['product_id'],
								'product_name'			=> $product['product_name'],
								'tax_name' 				=> $product['tax_name'],
								'tax_percent'			=> $product['tax_percentage'],
								'tax_total'				=> $tax_total,
								'quantity'				=> $product['quantity'],
								'available_quantity'	=> $product['quantity'],
								'rate'					=> $product['rate'],
								'total'					=> $total,
								'created_on'			=> created_on(),
								'created_by'			=> created_by(),
								'status'				=> 1
							);
							if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
								$relations['brand_name'] = $product['brand_name'];
							}
							if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
								$relations['category_name'] = $product['category_name'];
							}
							if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){
								$relations['subcategory_name'] = $product['sub_category_name'];
							}
							//echo "<pre>";print_r($relations);exit;
							$estimate_relation_id = $this->common->insert('tbl_estimates_relation',$relations);
							$estimate_total = $estimate_total+$total;
							if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_stock_reduce'),'estimate_settings_value')== 1){
								$stock = array(
									'product_id'		=>	$product['product_id'],
									'quantity'			=>	$product['quantity'],
								);
								$this->estimate->reduce_stock($stock);
								$message = array(
									'result' 	=> 'success',
									'message' 	=> 'Stock Reduced Successfully',
								);
								$this->session->set_userdata('msg',$message);	
							}
							//DC Status Change
							if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_dc_to_estimate_generate'),'estimate_settings_value')== 1){
								if($data['dc_no']){
									foreach ($data['dc_no'] as $key => $dc_no) {
										$dc_status = array(
											'status' 		=> 2,
											'updated_on' 	=> created_on(),
											'updated_by'	=> created_by()
										);
										$dc_update = $this->common->update('tbl_dcs',$dc_status,array('dc_id' => $dc_no));
									}
								}
							}
						}
					}else{
						//echo "<pre>";print_r("4");exit;
						foreach ($data['dc_relation_id'] as $key => $dc_relation_id) {
							$dc_relation_details = $this->common->get_array('tbl_dcs_relation',array('dc_relation_id' => $dc_relation_id,'status' => 1));
							//DEFAULT TAX CALCULATION BASED ON estimate PRICE
							$product_detail = $this->common->get_array('mst_products',array('product_id' =>$dc_relation_details['product_id']));
							$tax_percentage = $this->common->get_particular('mst_taxs', array('tax_id' => $product_detail['product_tax']),'tax_percentage');
							$amount = $product_detail['product_mrp']*$dc_relation_details['quantity'];
							$tax_total = ($amount) * $tax_percentage/100;
							if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1){
								$total = $amount + $tax_total;
							}else{
								$total = $amount;
							}
							$relations = array(
								'estimate_id'		=> $estimate_id,
								'product_id'		=> $dc_relation_details['product_id'],
								'dc_id'				=> $dc_relation_details['dc_id'],
								'dc_relation_id'	=> $dc_relation_id,
								'product_name'		=> $dc_relation_details['product_name'],
								'brand_name' 		=> $dc_relation_details['brand_name'],
								'category_name' 	=> $dc_relation_details['category_name'],
								'subcategory_name' 	=> $dc_relation_details['subcategory_name'],
								'tax_name' 			=> $dc_relation_details['tax_name'],
								'tax_percent'		=> $dc_relation_details['tax_percent'],
								'tax_total'			=> $tax_total,
								'quantity'			=> $dc_relation_details['quantity'],
								'available_quantity'=> $dc_relation_details['quantity'],
								'rate'				=> $product_detail['product_mrp'],
								'total'				=> $total,
								'created_on'		=> created_on(),
								'created_by'		=> created_by(),
								'status'			=> 1
							);
							$estimate_relation_id = $this->common->insert('tbl_estimates_relation',$relations);
							$estimate_total = $estimate_total+$total;
							if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_stock_reduce'),'estimate_settings_value')== 1){
								$stock = array(
									'product_id'		=>	$dc_relation_details['product_id'],
									'quantity'			=>	$dc_relation_details['quantity'],
								);
								$this->estimate->reduce_stock($stock);
								$message = array(
									'result' 	=> 'success',
									'message' 	=> 'Stock Reduced Successfully',
								);
								$this->session->set_userdata('msg',$message);	
							}
							if($estimate_relation_id){
								//DC Relation Status Change
								if($data['dc_no']){
									$dc_relation_status = array(
										'status' 		=> 2,
										'updated_on' 	=> created_on(),
										'updated_by'	=> created_by()
									);
									$dc_relation_update = $this->common->update('tbl_dcs_relation',$dc_relation_status,array('dc_relation_id' => $dc_relation_id));
								}
							}
						}
						//DC status change
						if($data['dc_no']){
							foreach ($data['dc_no'] as $key => $dc_id) {
								$this->estimate->check_dc_status($dc_id);
									//$this->estimate->get_dcs_relation_details($dc_id);
							}
						}
					}
				}
				if(isset($data['estimate_discount'])){
					$estimate_total = $estimate_total - $data['estimate_discount'];
				}else{
					$estimate_total = $estimate_total + $additonal_expenses_and_tax;
				}
				if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Estimate_Payment'),'status')== 1){
					$payment = array(
						'company_id'		=> $data['company_id'],
						'customer_id' 		=> $data['estimate_customer'],
						'estimate_id' 		=> $estimate_id,
						'estimate_amount' 	=> $estimate_total,
						'estimate_status' 	=> 0,
						'created_on' 		=> created_on(),
						'created_by' 		=> created_by(),
						'status' 			=> 1
					);
					$this->common->insert('tbl_estimate_payments',$payment);
				}else{
					$payment = array(
						'company_id'		=> $data['company_id'],
						'customer_id' 		=> $data['estimate_customer'],
						'estimate_id' 		=> $estimate_id,
						'estimate_amount' 	=> $estimate_total,
						'estimate_status' 	=> 2,
						'created_on' 		=> created_on(),
						'created_by' 		=> created_by(),
						'status' 			=> 1
					);
					$estimate_payment_id = $this->common->insert('tbl_estimate_payments',$payment);
					if($estimate_payment_id){
						$payment_history = array(
							'company_id'			=> $data['company_id'],
							'customer_id' 			=> $data['estimate_customer'],
							'estimate_payments_id'	=> $estimate_payment_id,
							'estimate_amount' 		=> $estimate_total,
							'paid_amount' 			=> $estimate_total,
							'balance_amount' 		=> 0,
							'payment_type'			=> "cash",
							'payment_date'			=> date('Y-m-d',strtotime($data['estimate_date'])),
							'remarks'				=> "Cash Received",
							'created_on' 			=> created_on(),
							'created_by' 			=> created_by(),
							'status' 				=> 1
						);
						$this->common->insert('tbl_estimate_payments_history',$payment_history);
					}
				}
			    //DC AUTO GENERATE
				if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_dc_auto_generate'),'estimate_settings_value')== 1){
					$this->estimate_generate_dc($estimate_id); 
				}
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $data['company_id'],
					'log_category_id'	=> 1,
					'operation'			=> 'estimate Created',
					'operation_details'	=> 'estimate Created For '.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['estimate_customer']),'customer_name'),
					'estimate_id'		=> $estimate_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'estimate generated successfully',
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('estimate_view/'.$estimate_id));
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'estimate generation failed',
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('estimate'));
			}
		}else{
			$message = array(
				'result' 	=> 'failed',
				'message' 	=> 'Product adding to estimate failed',
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('estimate'));
	}else{
		$this->common->truncate('tbl_estimates_relation_temp',array('company_id' => $this->session->userdata('company_id'),'created_by' => $this->session->userdata('user_id')));
		$data['lists'] 		= array();
		$data['estimate_number'] = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'estimate_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'estimate_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
		$data['customers'] 	= convert_options($this->common->gets_array('mst_customers',array('status' =>1)),'customer_id','customer_name','CUSTOMER');
		$data['employees'] 	= convert_options($this->common->gets_array('mst_users',array('status' =>1)),'user_id','username','EMPLOYEE');
		$data['dc_no'] 	= convert_options($this->common->gets_array('tbl_dcs',array('status' => 1,'dc_id' => $this->session->userdata('company_id'),'estimate_id' => 0)),'dc_id','dc_number','DC NO');
			//COMPANY LIST IF MULTIPLE COMPANY ENABLE
		if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){
			if($this->session->userdata('access_level')==1){
				$data['company_lists'] = array_column($this->user->get_company_list(), 'company_name');
			}elseif($this->session->userdata('access_level')==2){
				$data['company_lists'] = array_column($this->user->get_current_user_companies(), 'company_name');
			}
		}
		$this->template->build('estimate/estimate',$data);
	}
}
public function estimate_edit($estimate_id){
	if($this->input->post()){
		$final_result = false;
		$data = $this->input->post();
		$estimate_products = $this->estimate->get_estimate_products();
			//echo "<pre>";print_r($data);exit;
		if($estimate_products){
			$estimate = array(
				'company_id'				=>	$data['company_id'],
				'estimate_number' 			=>	$data['estimate_number'],
				'estimate_date' 			=>	date('Y-m-d',strtotime($data['estimate_date'])),
				'estimate_type'   			=>	$data['estimate_type'],
				'estimate_customer' 		=>	$data['estimate_customer'],
				'estimate_employee'			=>	$data['estimate_employee'],
				'estimate_approved'			=>	1,
				'estimate_cash_discount'	=> 	$data['estimate_cash_discount'],
				'estimate_overall_discount'	=>  $data['estimate_overall_discount'],
				'estimate_loading_charges' 	=> 	$data['estimate_loading_charges'],
				'estimate_transportaion_charges'=>$data['estimate_transportaion_charges'],
				'estimate_other_expenses' 	=> $data['estimate_other_expenses'],
				'total_bundle' 				=> $data['total_bundle'],
				'reverse_charge' 			=> $data['reverse_charge'],
				'date_of_supply' 			=> date('Y-m-d',strtotime($data['date_of_supply'])),
				'place_of_supply' 			=> $data['place_of_supply'],
				'updated_on'				=>	updated_on(),
				'updated_by'				=>	created_by(),
				'status' 					=>	1
			);
				// if(isset($data['estimate_discount'])){
				// 	$estimate = array('estimate_discount' => $data['estimate_discount']);
				// }
			$estimate_update = $this->common->update('tbl_estimates',$estimate,array('estimate_id' => $estimate_id ));
			if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_stock_reduce'),'estimate_settings_value')== 1){
				$this->increase_estimate_stock($estimate_id);
			}
			$additonal_expenses_and_tax = 0;
			if(isset($data['estimate_loading_charges'])){
				$additonal_expenses_and_tax = $additonal_expenses_and_tax + $data['estimate_loading_charges'] ;
			}
			if(isset($data['estimate_transportaion_charges'])){
				$additonal_expenses_and_tax = $additonal_expenses_and_tax + $data['estimate_transportaion_charges'] ;
			}
			if(isset($data['estimate_other_expenses'])){
				$additonal_expenses_and_tax = $additonal_expenses_and_tax + $data['estimate_other_expenses'] ;
			}
			if($estimate_update){
				$estimate_total = 0;
					//DELETE RELATIONS
				$this->common->update('tbl_estimates_relation',array('status' => 0),array('estimate_id' => $estimate_id));
				foreach ($estimate_products as $key => $product) {
						//echo "<pre>";print_r($product);exit;
						//DEFAULT TAX CALCULATION BASED ON estimate PRICE
					$product_detail = $this->common->get_array('mst_products',array('product_id' =>$product['product_id']));
					$tax_percentage = $this->common->get_particular('mst_taxs', array('tax_id' => $product_detail['product_tax']),'tax_percentage');
					$amount = $product['rate']*$product['quantity'];
					$tax_total = ($amount) * $tax_percentage/100;
					if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1){
						$total = $amount + $tax_total;
					}else{                                               
						$total = $amount;
					}
					$relations = array(
						'estimate_id'			=> $estimate_id,
						'product_id'			=> $product['product_id'],
						'dc_id'					=> $product['dc_id'],
						'dc_relation_id'		=> $product['dc_relation_id'],
						'product_name'			=> $product['product_name'],
						'brand_name' 			=> $product['brand_name'],
						'category_name' 		=> $product['category_name'],
						'subcategory_name' 		=> $product['subcategory_name'],
						'rate'					=> $product['rate'],
						'quantity'				=> $product['quantity'],
						'available_quantity'	=> $product['quantity'],
						'discount_percentage'   => $product['discount_percentage'],
						'pre_total'				=> $product['pre_total'],
						'tax_percent'			=> $product['tax_percent'],
						'tax_total'				=> $product['tax_total'],
						'total'					=> $product['total'],
						'updated_on'			=> created_on(),
						'updated_by'			=> created_by(),
						'status'				=> 1

							// 'estimate_id'			=> $estimate_id,
							// 'product_id'			=> $product['product_id'],
							// 'product_name'		=> $product['product_name'],
							// 'brand_name' 		=> $product['brand_name'],
							// 'category_name' 		=> $product['category_name'],
							// 'subcategory_name' 	=> $product['sub_category_name'],
							// 'tax_name' 			=> $product['tax_name'],
							// 'tax_percent'		=> $product['tax_percentage'],
							// 'tax_total'			=> $tax_total,
							// 'quantity'			=> $product['quantity'],
							// 'rate'				=> $product['rate'],
							// 'total'				=> $total,
							// 'created_on'			=> created_on(),
							// 'created_by'			=> created_by(),
							// 'status'				=> 1
					);
						//echo "<pre>";print_r($relations);exit;
					$estimate_relation_id = $this->common->insert('tbl_estimates_relation',$relations);
					$estimate_total = $estimate_total+$product['total'];
					if($estimate_relation_id){
						$final_result = true;
					}
					if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_stock_reduce'),'estimate_settings_value')== 1){
						$stock = array(
							'product_id'		=>	$product['product_id'],
							'quantity'			=>	$product['quantity'],
						);
						$this->estimate->reduce_stock($stock);
						$message = array(
							'result' 	=> 'success',
							'message' 	=> 'Stock Reduced Successfully',
						);
						$this->session->set_userdata('msg',$message);	
					}
				}
				if(isset($data['estimate_discount'])){
					$estimate_total = $estimate_total - $data['estimate_discount'];
				}else{
					$estimate_total = $estimate_total + $additonal_expenses_and_tax;
				}
				if($final_result){
					if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Estimate_Payment'),'status')== 1){
						$existing_estimate_payment = $this->common->get_array('tbl_estimate_payments',array('estimate_id' => $estimate_id ));
						$existing_estimate_paid = $this->common->sum('tbl_estimate_payments_history',array('estimate_payments_id' => $existing_estimate_payment['estimate_payments_id'] ),'paid_amount','paid_amount');
						if($existing_estimate_paid == 0){
							$estimate_status = 0;
						}elseif( ($existing_estimate_payment['estimate_amount'] >= $estimate_total ) && ( $estimate_total == $existing_estimate_paid )  ){
							$estimate_status = 2;
						}else{
							$estimate_status = 1;
						}
						$payment = array(
							'customer_id' 		=> $data['estimate_customer'],
							'estimate_id' 		=> $estimate_id,
							'estimate_amount' 	=> $estimate_total,
							'estimate_status' 	=> $estimate_status,
							'updated_on' 		=> created_on(),
							'updated_by' 		=> created_by(),
							'status' 			=> 1
						); 
							//echo "<pre>";print_r($payment);exit;
						$this->common->update('tbl_estimate_payments',$payment,array('estimate_id' => $estimate_id ));
						redirect(base_url('estimate_view/'.$estimate_id));
					}else{
						$payment = array(
							'company_id'	 => $data['company_id'],
							'customer_id' 	 => $data['estimate_customer'],
							'estimate_id' 	 => $estimate_id,
							'estimate_amount'=> $estimate_total,
							'estimate_status'=> 2,
							'updated_on' 	 => created_on(),
							'updated_by' 	 => created_by(),
							'status' 		 => 1
						);
						$estimate_payment_id = $this->common->update('tbl_estimate_payments',$payment,array('estimate_id' => $estimate_id ));
						if($estimate_payment_id){
							$payment_history = array(
								'company_id'			=> $data['company_id'],
								'customer_id' 			=> $data['estimate_customer'],
								'estimate_payments_id'	=> $estimate_payment_id,
								'estimate_amount' 		=> $estimate_total,
								'paid_amount' 			=> $estimate_total,
								'balance_amount' 		=> 0,
								'payment_type'			=> "cash",
								'payment_date'			=> date('Y-m-d',strtotime($data['estimate_date'])),
								'remarks'				=> "Cash Received",
								'updated_on' 			=> created_on(),
								'updated_by' 			=> created_by(),
								'status' 				=> 1
							);
							$this->common->update('tbl_estimate_payments_history',$payment_history,array('estimate_payments_id' => $estimate_payment_id));
						}
					}
				}
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $data['company_id'],
					'log_category_id'	=> 1,
					'operation'			=> 'estimate Updated',
					'operation_details'	=> 'estimate Updated For '.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['estimate_customer']),'customer_name'),
					'estimate_id'		=> $estimate_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'estimate Updated failed',
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('estimate_list'));
			}
		}else{
			$message = array(
				'result' 	=> 'failed',
				'message' 	=> 'Product adding to estimate failed',
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('estimate_list'));
	}else{
		//$this->common->truncate('tbl_estimates_relation_temp',array('company_id' => $this->session->userdata('company_id'),'created_by' => $this->session->userdata('user_id')));
		$this->common->truncate('tbl_estimates_relation_temp');
		$data = $this->estimate->get_estimate_details($estimate_id);
		$this->add_temp_estimate($data['relations']);
		$data['temp_products'] = $this->get_estimate_temp_listings();
		$data['customers'] 	= convert_options_selected($this->common->gets_array('mst_customers',array('status' =>1)),'customer_id','customer_name','CUSTOMER',$data['estimate_details']['estimate_customer']);
		$data['employees'] 	= convert_options_selected($this->common->gets_array('mst_users',array('status' =>1)),'user_id','username','EMPLOYEE',$data['estimate_details']['estimate_employee']);
			//IF multiple DC ENABLE
		$data['dc_no']	= multi_select($this->common->gets_array('tbl_dcs',array('dc_customer' =>$data['estimate_details']['estimate_customer'])),'dc_number','dc_id',$data['estimate_details']['dc_id']);
		$data['company_lists'] 	= convert_options_selected($this->common->gets_array('company_details',array('company_status' =>1,'company_id' => $data['estimate_details']['company_id'])),'company_id','company_name','COMPANY',$data['estimate_details']['company_id']);
			//echo "<pre>";print_r($data);exit;
		$this->template->build('estimate/estimate',$data);
	}
}
private function get_estimate_temp_listings(){
	$data['lists'] = $this->estimate->get_estimate_temp_listings();
	if($data['lists']){
		$lists = $this->load->view('estimate/includes/dc_temp_list_edit', $data, TRUE);
	}else{
		$lists ='<tr>
		<td colspan="9">NO PRODUCTS ADDED</td>
		</tr>';
	}
	return $lists;
}
public function estimate_calculation(){
	$data = $this->input->post();
	//echo "<pre>";print_r($data);exit;
	if($data){
		$data['amount'] = $data['product_quantity'] * $data['product_rate'];
	}
	$data['result'] = "success";
	echo json_encode($data);
}
//ADD TEMPRORY PURCHASE ORDER
public function add_temprory_estimate(){
	$data = $this->input->post();
	$new_estimate_temp = array(
		'product_id'			=> $data['product_id'],
		'company_id'			=> $this->session->userdata('company_id'),
		'quantity'				=> $data['quantity'],
		'rate'					=> $data['rate'],
		'total'					=> $data['amount'],
		'created_on'			=> created_on(),
		'created_by'			=> created_by(),
		'status'				=> 1
	);
		//echo "<pre>";print_r($new_estimate_temp);exit;
	$estimate_relation_temp_id = $this->common->insert('tbl_estimates_relation_temp',$new_estimate_temp);
	if($estimate_relation_temp_id){
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
	$message['listings'] 		= $this->temp_listing();
	$sub_total 					= $this->estimate->estimate_temp_total();
	$message['sub_total'] 		= implode($sub_total);
	$message['display_message'] = return_message($message);
	echo json_encode($message);
}
private function temp_listing(){
	$data['lists'] = $this->estimate->get_temp_listings();
		//echo "<pre>";print_r($data);exit;
	$content = $this->load->view('estimate/includes/temp_listing', $data, TRUE);
	return $content;
}
//REMOVE TEMPRORY PURCHASE ORDER
public function remove_temp_estimate(){
	$estimate_temp_id = $this->input->post('estimate_temp_id');
	if($estimate_temp_id!=''){
		$temp_details = $this->common->get_array('tbl_estimates_relation_temp',array('estimate_relation_temp_id' => $estimate_temp_id ));
		$remove = $this->common->remove('tbl_estimates_relation_temp',array('estimate_relation_temp_id' => $estimate_temp_id ));
		if($remove){
			$message = array(
				'result' 	=> 'success',
				'message' 	=> 'Product removed from estimate successfully',
			);
		}else{
			$message = array(
				'result' 	=> 'failed',
				'message' 	=> 'Product remove from estimate failed',
			);
		}
	}else{
		$message = array(
			'result' 	=> 'failed',
			'message' 	=> 'parameter empty',
		);
	}
	$message['listings'] = $this->temp_listing();
	$sub_total 			= $this->estimate->estimate_temp_total();
	if($sub_total == ""){
		$message['sub_total'] 		= "0";
	}else{
		$message['sub_total'] 		= implode($sub_total);
	}
	$message['display_message'] = return_message($message);
	echo json_encode($message);
}
public function estimate_view($estimate_id){
	$data = $this->estimate->get_estimate_details($estimate_id);
    //echo "<pre>";print_r($data);exit;
	$this->template->build('estimate/estimate_view',$data);
}
public function estimate_print($estimate_id){
	$data = $this->estimate->get_estimate_details($estimate_id);
	//echo "<pre>";print_r($data);exit;
	$html = $this->load->view('estimate/estimate_print_new',$data,true);
	$this->load->library('pdf');
	$pdf = $this->pdf->load();
	$pdf->WriteHTML($html);
	$pdf->Output('estimate_PRINT.pdf','I');
}
public function estimate_download($estimate_id){
	$data = $this->estimate->get_estimate_details($estimate_id);
	$html = $this->load->view('estimate/estimate_print',$data,true);
	$this->load->library('pdf');
	$pdf = $this->pdf->load();
	$pdf->WriteHTML($html);
	$pdf->Output('estimate.pdf','D');
}
private function add_temp_estimate($rows){
		//echo "<pre>";print_r($rows);exit;
	$this->common->remove('tbl_estimates_relation_temp',array('company_id' => $this->session->userdata('company_id')));
	foreach ($rows as $key => $row) {
		$stock_id = $this->common->get_particular('tbl_stock',array('product_id' => $row['product_id']),'stock_id');
		$temp = array(
			'company_id'			=> $this->session->userdata('company_id'),
			'product_id'			=> $row['product_id'],
			'stock_id'				=> $stock_id,
			'dc_id'					=> $row['dc_id'],
			'dc_relation_id'		=> $row['dc_relation_id'],
			'product_name'			=> $row['product_name'],
			'brand_name' 			=> $row['brand_name'],
			'category_name' 		=> $row['category_name'],
			'subcategory_name' 		=> $row['subcategory_name'],
			'quantity'				=> $row['quantity'],
			'rate'					=> $row['rate'],
			'discount_percentage'   => $row['discount_percentage'],
			'pre_total'				=> $row['pre_total'],
			'tax_percent'			=> $row['tax_percent'],
			'tax_total'				=> $row['tax_total'],
			'total'					=> $row['total'],
			'created_on'			=> created_on(),
			'created_by'			=> created_by(),
			'status'				=> 1
		);
		$insert_id = $this->common->insert('tbl_estimates_relation_temp',$temp);
	}
}
private function increase_estimate_stock($estimate_id){
	$data = $this->estimate->get_estimate_details($estimate_id);
	if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_stock_reduce'),'estimate_settings_value')== 1){
		if($data['relations']){
			foreach ($data['relations'] as $key => $relation) {
				$stock = array(
					'product_id'		=>	$relation['product_id'],
					'quantity'			=>	$relation['quantity'],
				);
				$this->estimate->increase_stock($stock);
			}
			$status = array('status' => 0 );
			$this->common->update('tbl_estimates_relation',$status,array('estimate_id' => $estimate_id ));
		}else{
			return false;
		}
	}
}

public function estimate_generate_dc($estimate_id){
	$data = $this->estimate->get_estimate_details($estimate_id);
		//echo "<pre>";print_r($data);//exit;
	$dc_number = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'dc_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'dc_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
	if($data){
		$dc = array(
			'company_id'			=> $data['estimate_details']['company_id'],
			'estimate_id'			=> $estimate_id,
			'dc_number'				=> $dc_number,
			'dc_date'				=> date('Y-m-d'),
			'dc_customer'			=> $data['estimate_details']['estimate_customer'],
			'transport_vechile_no'	=> $data['estimate_details']['transport_vechile_no'],
			'dc_approved'			=> 1,
			'created_on'			=> created_on(),
			'created_by'			=> created_by(),
			'status'				=> 1
		);
		//echo "<pre>";print_r($dc);exit;
		$dc_id = $this->common->insert('tbl_dcs',$dc);
		if($dc_id){
			$current_count = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'dc_prefix_count');
			$next_count = next_number($current_count);
			$this->common->update('company_details',array('dc_prefix_count' => $next_count ),array('company_id' => $this->session->userdata('company_id')));
			foreach ($data['relations'] as $key => $relation) {
				$dc_relation = array(
					'dc_id'					=> $dc_id,
					'product_id'			=> $relation['product_id'],
					'product_name'			=> $relation['product_name'],
					'brand_name'			=> $relation['brand_name'],
					'category_name'			=> $relation['category_name'],
					'subcategory_name' 		=> $relation['subcategory_name'],
					'tax_name'				=> $relation['tax_name'],
					'tax_percent'			=> $relation['tax_percent'],
					'quantity'				=> $relation['quantity'],
					'rate'					=> $relation['rate'],
					'created_on'			=> created_on(),
					'created_by'			=> created_by(),
					'status'				=> 1
				);
				$dc_relation_id  = $this->common->insert('tbl_dcs_relation',$dc_relation);
				//STOCK REDUCE
				$stock = array(
					'product_id'		=>	$relation['product_id'],
					'quantity'			=>	$relation['quantity'],
				);
				$this->estimate->reduce_stock($stock);
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'Stock Reduced Successfully',
				);
				$this->session->set_userdata('msg',$message);
			}
			$update = array(
				'updated_on'	=> created_on(),
				'updated_by'	=> created_by(),
				'status'		=> 2
			);
			$estimate_update_status = $this->common->update('tbl_estimates',$update,array('estimate_id' => $estimate_id ));
				//IF DC GENERATE THEN STATUS UPDATE
			$update = array(
				'updated_on'	=> created_on(),
				'updated_by'	=> created_by(),
				'status'		=> 2,
				'dc_status'		=> 2
			);
			$dc_update_status = $this->common->update('tbl_dcs',$update,array('dc_id' => $dc_id ));
			$message = array(
				'result' => 'success',
				'message' => 'Dc generated successfully'
			);
			$this->session->set_userdata('msg',$message);
			redirect(base_url('estimate_view/'.$estimate_id));
		}else{
			$message = array(
				'result'	=> 'failed',
				'message'	=> 'Dc generation failed'
			);
			$this->session->set_userdata('msg',$message);
			redirect(base_url('estimate_list'));
		}
	}
}
public function check_product_qty(){
	$data = $this->input->post();
	if($this->common->get_particular('mst_modules',array('module_name' => 'INVENTORY'),'invoice_settings_value')==1){
		if($data['product_id']!=""){
			$product_id 		= $data['product_id'];
			$product_qty 		= $data['product_qty'];
			$product_qty_check 	= $this->estimate->check_product_qty($product_id,$product_qty);
			if($product_qty_check){
				$message = array(
					'result'	=> 'success',
					'message'	=> 'Stock Qty Available'
				);
				$message['display_message'] = return_message($message);
				echo json_encode($message);
			}else{
				$message = array(
					'result'	=> 'failed',
					'message'	=> 'Stock Qty Not Available'
				);
				$message['display_message'] = return_message($message);
				echo json_encode($message);
			}
		}
	}else{
		$message = array(
			'result'	=> 'success',
			'message'	=> 'Stock Qty Available'
		);
		$message['display_message'] = return_message($message);
		echo json_encode($message);
	}
}
//estimate PAYMENT LIST
public function estimate_payment_list(){
	$data['lists'] = $this->estimate->get_estimate_payment_list();
	//echo "<pre>";print_r($data);exit;
	$this->template->build('payments/estimate/estimate_payment_list',$data);
}
public function estimate_payments_bill_details($estimate_payments_id){
	$data['payment'] = $this->estimate->get_estimate_detail_bills($estimate_payments_id);
	//echo "<pre>";print_r($data);exit;
	$this->template->build('payments/estimate/estimate_payments',$data);
}
//ADD estimate BILL PAYMENTS
public function add_estimate_payment_bills(){
	$data = $this->input->post();
	//echo "<pre>";print_r($data);exit;
	$insert = array(
		'estimate_payments_id' 	=> $data['estimate_payments_id'],
		'company_id'			=> $this->session->userdata('company_id'),
		'customer_id'			=> $data['customer_id'],
		'estimate_amount' 		=> $data['estimate_amount'],
		'paid_amount' 			=> $data['paid_amount'],
		'balance_amount'		=> $data['balance_amount']-$data['paid_amount'],
		'payment_type' 			=> $data['payment_type'],
		'cheque_no' 			=> $data['cheque_number'],
		'bank_name' 			=> $data['bank_name'],
		'payment_date' 			=> date('Y-m-d',strtotime($data['payment_date'])),
		'remarks' 				=> $data['paymentremark'],
		'created_on' 			=> created_on(),
		'created_by' 			=> created_by(),
		'status'				=> 1
	);
	$insert_result = $this->common->insert('tbl_estimate_payments_history',$insert);
	if($insert_result){
		$update = array('estimate_status' => 1 );
		$this->common->update('tbl_estimate_payments',$update,array('estimate_payments_id' => $data['estimate_payments_id'] ));
		$log = array(
			'user_id'			=> $this->session->userdata('user_id'),
			'company_id'		=> $this->session->userdata('company_id'),
			'log_category_id'	=> 15,
			'operation'			=> 'estimate Payment Added',
			'operation_details'	=> 'estimate Payment Added - '.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['customer_id']),'customer_name'),
			'estimate_payment_id'=> $data['estimate_payments_id'],
			'logs_status'		=> 0,
			'created_on'		=> created_on(),
			'status'			=> 1
		);
		$log_id = $this->common->insert('tbl_logs',$log);
		$message = array(
			'result' => 'success',
			'message' => 'Payment Added successfully',
		);
		if($data['balance_amount'] == $data['paid_amount']){
			$update = array('estimate_status' => 2 );
			$estimate_update = $this->common->update('tbl_estimate_payments',$update,array('estimate_payments_id' => $data['estimate_payments_id'] ));
			if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_dc_to_estimate_generate'),'estimate_settings_value')== 1){
				$get_estimate_id = $this->common->get_particular('tbl_estimate_payments',array('estimate_payments_id' => $data['estimate_payments_id']),'estimate_id');
				if($estimate_update){
					$status = array(
						'status' 		=> 2,
						'updated_on' 	=> created_on(),
						'updated_by'	=> created_by()
					);
					$updated = $this->common->update('tbl_estimates',$status,array('estimate_id' => $get_estimate_id));
				}
			}
		}
	}else{
		$message = array(
			'result' => 'failed',
			'message' => 'Adding Payment Failed',
		);
	}
	$this->session->set_userdata('msg',$message);
	redirect(base_url('estimate_payments_bill_details/'.$data['estimate_payments_id']));
}
public function estimate_remove($estimate_id){
	$update = array(
		'updated_on' 		=> created_on(),
		'updated_by' 		=> created_by(),
		'status' 			=> 0 ,
		'estimate_cancel' 	=> 1
	);
	$delete_result = $this->common->delete('tbl_estimates',$update,array('estimate_id' => $estimate_id ));
	if($delete_result){
		if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_stock_reduce'),'estimate_settings_value')== 1){
			$stock_reduced = $this->common->gets_array('tbl_estimates_relation',array('estimate_id' => $estimate_id,'status' => 1 ));
			if($stock_reduced){
				foreach ($stock_reduced as $key => $stock_reduce) {
					$stock = array(
						'product_id'	=>	$stock_reduce['product_id'],
						'quantity'		=>	$stock_reduce['quantity'],
					);
						//echo "<pre>";print_r($stock);exit;
					$this->estimate->increase_stock($stock);
				}
			}
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'company_id'		=> $this->session->userdata('company_id'),
				'log_category_id'	=> 1,
				'operation'			=> 'estimate Deleted',
				'operation_details'	=> 'estimate Deleted For '.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['estimate_customer']),'customer_name'),
				'estimate_id'		=> $estimate_id,
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' 	=> 'success',
				'message' 	=> 'estimate removed successfully',
			);
			$this->session->set_userdata('msg',$message);
			redirect(base_url('estimate_list'));
		}
		if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_dc_generate'),'estimate_settings_value')== 1){
			$update_dc = array(
				'updated_on' 	=> created_on(),
				'updated_by' 	=> created_by(),
				'status' 		=> 0 ,
				'dc_cancel' 	=> 1
			);
			$dc_delete_result = $this->common->delete('tbl_dcs',$update_dc,array('estimate_id' => $estimate_id ));
			if($dc_delete_result){
				$data = $this->estimate->get_estimate_details($estimate_id);
				if($data['relations']){
					foreach ($data['relations'] as $key => $relation) {
						$stock = array(
							'product_id'		=>	$relation['product_id'],
							'quantity'			=>	$relation['quantity'],
						);
						$this->estimate->increase_stock($stock);
					}
					$status = array('status' => 0 );
					$this->common->update('tbl_estimates_relation',$status,array('estimate_id' => $estimate_id ));
				}
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'estimate removed successfully',
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('estimate_list'));
			}
		}
	}else{
		$message = array(
			'result' 	=> 'failed',
			'message' 	=> 'estimate Removing failed',
		);
	}
	$this->session->set_userdata('msg',$message);
	redirect(base_url('estimate_list'));
}
	//GET CUSOTMER BASED DC
public function get_customer_based_estimate(){
	$customer_id = $this->input->post('customer_id');
	$data['dc_no'] =  convert_options($this->common->gets_array('tbl_dcs',array('dc_customer' =>$customer_id,'status' => 1)),'dc_id','dc_number','DC NO');
	$data['result'] = "success";
	echo json_encode($data);
}
public function get_estimate_dc_details(){
	$dc_no = $this->input->post('dc_no');
	$content = "";
	$data['count'] = 0;
	if(!empty($dc_no)){
		foreach ($dc_no as $key => $dc) {
			if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1){
				$data['dc_details'] = $this->common->gets_array('tbl_dcs_relation',array('dc_id' => $dc,'status' => 1,'balance_quantity!=' => 0));
			}elseif($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1){
				$data['dc_details'] = $this->common->gets_array('tbl_dcs_relation',array('dc_id' => $dc,'status' => 1,'balance_quantity!=' => 0));
			}else{
				$data['dc_details'] = $this->common->gets_array('tbl_dcs_relation',array('dc_id' => $dc,'status' => 1));
			}
			$content .= $this->load->view('estimate/includes/dc_temp_listing',$data,TRUE);
			$data['count'] = ($data['count'] + $this->common->count('tbl_dcs_relation',array('dc_id' => $dc,'status' => 1)));
				//SAVED INTO ESTIMATE TEMP TABLE
			foreach ($data['dc_details'] as $key => $dc_detail) {
				$estimate_relation_temp_id = $this->common->get_particular('tbl_estimates_relation_temp',array('dc_id' => $dc_detail['dc_id'],'product_id' => $dc_detail['product_id'],'quantity' => $dc_detail['quantity']),'estimate_relation_temp_id');
				$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
				$tax_total = $rate * $dc_detail['tax_percent']/100;
				$total = (($dc_detail['quantity'] * $rate) + $tax_total);
				if($estimate_relation_temp_id){
					$new_estimate_temp = array(
						'product_id'			=> $dc_detail['product_id'],
						'quantity'				=> $dc_detail['quantity'],
						'dc_id'					=> $dc_detail['dc_id'],
						'dc_relation_id'		=> $dc_detail['dc_relation_id'],
						'rate'					=> $rate,
						'total'					=> $total,
						'created_on'			=> created_on(),
						'created_by'			=> created_by(),
						'status'				=> 1
					);
					$update = $this->common->update('tbl_estimates_relation_temp',$new_estimate_temp,array('dc_id' => $dc_detail['dc_id'],'product_id' => $dc_detail['product_id'],'quantity' => $dc_detail['quantity']));
				}else{
					$new_estimate_temp = array(
						'product_id'			=> $dc_detail['product_id'],
						'quantity'				=> $dc_detail['quantity'],
						'dc_id'					=> $dc_detail['dc_id'],
						'dc_relation_id'		=> $dc_detail['dc_relation_id'],
						'rate'					=> $rate,
						'total'					=> $total,
						'created_on'			=> created_on(),
						'created_by'			=> created_by(),
						'status'				=> 1
					);
					$insert = $this->common->insert('tbl_estimates_relation_temp',$new_estimate_temp);
				}
			}
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
	$message['listings'] = $content;
	$message['display_message'] = return_message($message);
	echo json_encode($message);
}
	//DISCOUNT CALCULATIONS
public function estimate_product_total_calculations(){
	$product_qty 	= $this->input->post('quantity');
	$product_price  = $this->input->post('rate');
	$tax_type 		= $this->input->post('tax_type');
	$tax_percentage = $this->input->post('tax_percentage');
	$discount_percentage = $this->input->post('discount_percentage');
	if($discount_percentage!=""){
		$product_price = $product_price - ($product_price * $discount_percentage/100);
	}else{
		$product_price = $product_price;
	}
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
public function estimate_edit_temp_products(){
	$dc_relation_id      = $this->input->post('dc_relation_id');
	$quantity            = $this->input->post('quantity');
	$rate                = $this->input->post('rate');
	$discount_percentage = $this->input->post('discount_percentage');
	$discount_price      = $this->input->post('discount_price');
	$tax_percentage      = $this->input->post('tax_percentage');
	$tax_total  		 = $this->input->post('tax_total');
	$total               = $this->input->post('total');
	if($dc_relation_id){
		$update_estimate_temp = array(
			'quantity'				=> $quantity,
			'rate'					=> $rate,
			'discount_percentage'	=> $discount_percentage,
			'pre_total'				=> $discount_price,
			'tax_percent'			=> $tax_percentage,
			'tax_total'				=> $tax_total,
			'total'					=> $total,
			'created_on'			=> created_on(),
			'created_by'			=> created_by(),
			'status'				=> 1
		);
			//echo "<pre>";print_r($update_estimate_temp);exit;
		$update = $this->common->update('tbl_estimates_relation_temp',$update_estimate_temp,array('dc_relation_id' => $dc_relation_id));

	}
	$sub_total = $this->estimate->estimate_temp_total();
	$data['result'] = "success";
	$data['sub_total'] = implode($sub_total);
	echo json_encode($data);
}
	//Change Settings
public function change_estimate_setting($value){
		//IF value = 1 (change setting into direct estimate else value = 2 (change setting into dc to estimate))
	if($value!=""){
		if($value == 1){
			$update_settings = array(
				'estimate_settings_name' 	=> 'multiple_dc_to_estimate_generate',
				'estimate_settings_value' 	=> 0
			);
			$update = $this->common->update('mst_estimate_settings',$update_settings,array('estimate_settings_name' => 'multiple_dc_to_estimate_generate',
				'estimate_settings_value' => 1));
		}else{
			$update_settings = array(
				'estimate_settings_name' 	=> 'multiple_dc_to_estimate_generate',
				'estimate_settings_value' 	=> 1
			);
			$update = $this->common->update('mst_estimate_settings',$update_settings,array('estimate_settings_name' => 'multiple_dc_to_estimate_generate',
				'estimate_settings_value' => 0));
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
	redirect(base_url('estimate'));
}
}
/* End of file estimate.php */
/* Location: ./application/app/controllers/estimate.php */