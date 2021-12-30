<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Invoice extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Invoice_model','invoice');
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
	public function invoice_list(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['lists'] = $this->invoice->get_invoice_lists($data);
			//echo '<pre>';print_r($data);exit;
			if($data['option'] == 'view'){
				$this->template->build('invoice/invoice_list',$data);
			}else{
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$html = $this->load->view('invoice/invoice_list_pdf',$data,true);
				$pdf->WriteHTML($html);
				$pdf->Output('invoice_listing_pdf.pdf','I');
			}
		}else{
			$data['lists'] = $this->invoice->get_invoice_lists();
		    //echo '<pre>';print_r($data);exit;
			$this->template->build('invoice/invoice_list',$data);
		}
	}
	public function invoice(){
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);exit;
			$temp_products = $this->invoice->get_temp_listings();
			//echo "<pre>";print_r($temp_products);exit;
			$invoice_number = $this->common->get_particular('company_details',array('company_id' => $data['company_id']),'invoice_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $data['company_id']),'invoice_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'invoice_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			if($temp_products){
				if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'multiple_dc_to_invoice_generate'),'invoice_settings_value') != 1) {
					$invoice = array(
						'company_id'				=>	$data['company_id'],
						'invoice_number'     		=>	$invoice_number,
						'invoice_date' 	  			=>	date('Y-m-d',strtotime($data['invoice_date'])),
						'invoice_type'   			=>	$data['invoice_type'],
						'invoice_customer'   		=>	$data['invoice_customer'],
						'invoice_employee'			=>	$data['invoice_employee'],
						'invoice_approved'			=>	1,
						'invoice_cancel'			=>	0,
						'invoice_cash_discount'		=> 	$data['invoice_cash_discount'],
						'invoice_loading_charges' 	=> $data['invoice_loading_charges'],
						'invoice_transportaion_charges' => $data['invoice_transportaion_charges'],
						'invoice_other_expenses' 	=> $data['invoice_other_expenses'],
						'total_bundle' 				=> $data['total_bundle'],
						'reverse_charge' 			=> $data['reverse_charge'],
						'date_of_supply' 			=> date('Y-m-d',strtotime($data['date_of_supply'])),
						'place_of_supply' 			=> $data['place_of_supply'],
						'created_on'				=>	created_on(),
						'created_by'				=>	created_by(),
						'status'					=>	1
					);
				}elseif(isset($data['invoice_overall_discount'])){
					$invoice = array(
						'company_id'				=>	$data['company_id'],
						'invoice_number'     		=>	$invoice_number,
						'invoice_date' 	  			=>	date('Y-m-d',strtotime($data['invoice_date'])),
						'invoice_type'   			=>	$data['invoice_type'],
						'invoice_customer'   		=>	$data['invoice_customer'],
						'invoice_employee'			=>	$data['invoice_employee'],
						'dc_id'						=>  implode(',',$data['dc_no']),
						'invoice_overall_discount'			=>  $data['invoice_overall_discount'] ? $data['invoice_overall_discount'] : "",
						'invoice_approved'			=>	1,
						'invoice_cancel'			=>	0,
						'invoice_cash_discount'		=> 	$data['invoice_cash_discount'],
						'invoice_loading_charges' 	=> $data['invoice_loading_charges'],
						'invoice_transportaion_charges' => $data['invoice_transportaion_charges'],
						'invoice_other_expenses' 	=> $data['invoice_other_expenses'],
						'total_bundle' 				=> $data['total_bundle'],
						'reverse_charge' 			=> $data['reverse_charge'],
						'date_of_supply' 			=> date('Y-m-d',strtotime($data['date_of_supply'])),
						'place_of_supply' 			=> $data['place_of_supply'],
						'created_on'				=>	created_on(),
						'created_by'				=>	created_by(),
						'status'					=>	1
					);
				}else{
					$invoice = array(
						'company_id'				=>	$data['company_id'],
						'invoice_number'     		=>	$invoice_number,
						'invoice_date' 	  			=>	date('Y-m-d',strtotime($data['invoice_date'])),
						'invoice_type'   			=>	$data['invoice_type'],
						'invoice_customer'   		=>	$data['invoice_customer'],
						'invoice_employee'			=>	$data['invoice_employee'],
						'dc_id'						=>  implode(',',$data['dc_no']),
						'invoice_approved'			=>	1,
						'invoice_cancel'			=>	0,
						'invoice_cash_discount'		=> 	$data['invoice_cash_discount'],
						'invoice_loading_charges' 	=> $data['invoice_loading_charges'],
						'invoice_transportaion_charges' => $data['invoice_transportaion_charges'],
						'invoice_other_expenses' 	=> $data['invoice_other_expenses'],
						'total_bundle' 				=> $data['total_bundle'],
						'reverse_charge' 			=> $data['reverse_charge'],
						'date_of_supply' 			=> date('Y-m-d',strtotime($data['date_of_supply'])),
						'place_of_supply' 			=> $data['place_of_supply'],
						'created_on'				=>	created_on(),
						'created_by'				=>	created_by(),
						'status'					=>	1
					);
				}
				//echo "<pre>";print_r($invoice);exit;
				$invoice_id = $this->common->insert('tbl_invoices',$invoice);
				if($invoice_id){
					$additonal_expenses_and_tax = 0;
					if(isset($data['invoice_loading_charges'])){
						$additonal_expenses_and_tax = $additonal_expenses_and_tax + $data['invoice_loading_charges'] ;
					}
					if(isset($data['invoice_transportaion_charges'])){
						$additonal_expenses_and_tax = $additonal_expenses_and_tax + $data['invoice_transportaion_charges'] ;
					}
					if(isset($data['invoice_other_expenses'])){
						$additonal_expenses_and_tax = $additonal_expenses_and_tax + $data['invoice_other_expenses'] ;
					}
					$current_count =$this->common->get_particular('company_details',array('company_id' => $data['company_id']),'invoice_prefix_count');
					$next_count = next_number($current_count);
					$this->common->update('company_details',array('invoice_prefix_count' => $next_count ),array('company_id' => $data['company_id']));
					$invoice_total = 0;
					//DISCOUNT MODULE
					if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){
						foreach ($data['dc_relation_id'] as $relation_key => $dc_relation_id) {
							$dc_relation_details = $this->common->get_array('tbl_dcs_relation',array('dc_relation_id' => $dc_relation_id,'status' => 1));
							$relations = array(
								'invoice_id'			=> $invoice_id,
								'product_id'			=> $dc_relation_details['product_id'],
								'dc_id'					=> $data['dc_id'][$relation_key],
								'dc_relation_id'		=> $data['dc_relation_id'][$relation_key],
								'product_name'			=> $dc_relation_details['product_name'],
								'rate'					=> $data['rate'][$relation_key],
								'quantity'				=> $data['invoice_quantity'][$relation_key],
								'available_quantity'	=> $data['invoice_quantity'][$relation_key],
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
							$invoice_relation_id = $this->common->insert('tbl_invoices_relation',$relations);
							$invoice_total = $invoice_total+$data['final_total'][$relation_key];
							if($invoice_relation_id){
								//DC Relation Status Change
								$dc_relation_updated = $this->invoice->check_dcs_relation_details($dc_relation_id);
							}
						}
						//DC status change
						if($dc_relation_updated){
							if($data['dc_no']){
								foreach ($data['dc_no'] as $key => $dc_id) {
									$this->invoice->check_dc_status($dc_id);
								}
							}
						}
					}elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){
						foreach ($data['dc_relation_id'] as $relation_key => $dc_relation_id) {
							$dc_relation_details = $this->common->get_array('tbl_dcs_relation',array('dc_relation_id' => $dc_relation_id,'status' => 1));
							$relations = array(
								'invoice_id'			=> $invoice_id,
								'product_id'			=> $dc_relation_details['product_id'],
								'dc_id'					=> $data['dc_id'][$relation_key],
								'dc_relation_id'		=> $data['dc_relation_id'][$relation_key],
								'product_name'			=> $dc_relation_details['product_name'],
								'rate'					=> $data['rate'][$relation_key],
								'quantity'				=> $data['invoice_quantity'][$relation_key],
								'available_quantity'	=> $data['invoice_quantity'][$relation_key],
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
							$invoice_relation_id = $this->common->insert('tbl_invoices_relation',$relations);
							$invoice_total = $invoice_total+$data['final_total'][$relation_key];
							if($invoice_relation_id){
								//DC Relation Status Change
								$dc_relation_updated = $this->invoice->check_dcs_relation_details($dc_relation_id);
							}
						}
						//DC status change
						if($dc_relation_updated){
							if($data['dc_no']){
								foreach ($data['dc_no'] as $key => $dc_id) {
									$this->invoice->check_dc_status($dc_id);
								}
							}
						}
					}else{
						if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'multiple_dc_to_invoice_generate'),'invoice_settings_value')!= 1){ 
							foreach ($temp_products as $key => $product) {
							//DEFAULT TAX CALCULATION BASED ON invoice PRICE
								$product_detail = $this->common->get_array('mst_products',array('product_id' =>$product['product_id']));
								$tax_percentage = $this->common->get_particular('mst_taxs', array('tax_id' => $product_detail['product_tax']),'tax_percentage');
								$amount = $product['rate']*$product['quantity'];
								$tax_total = ($amount) * $tax_percentage/100;
								if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1){
									$total = $amount + $tax_total;
								}else{
									$total = $amount;
								}
								$relations = array(
									'invoice_id'			=> $invoice_id,
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
								$invoice_relation_id = $this->common->insert('tbl_invoices_relation',$relations);
								$invoice_total = $invoice_total+$total;
								if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_stock_reduce'),'invoice_settings_value')== 1){
									$stock = array(
										'product_id'		=>	$product['product_id'],
										'quantity'			=>	$product['quantity'],
									);
									$this->invoice->reduce_stock($stock);
									$message = array(
										'result' 	=> 'success',
										'message' 	=> 'Stock Reduced Successfully',
									);
									$this->session->set_userdata('msg',$message);	
								}
							//DC Status Change
								if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'multiple_dc_to_invoice_generate'),'invoice_settings_value')== 1){
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
							foreach ($data['dc_relation_id'] as $key => $dc_relation_id) {
								$dc_relation_details = $this->common->get_array('tbl_dcs_relation',array('dc_relation_id' => $dc_relation_id,'status' => 1));
							//DEFAULT TAX CALCULATION BASED ON invoice PRICE
								$product_detail = $this->common->get_array('mst_products',array('product_id' =>$dc_relation_details['product_id']));
								$tax_percentage = $this->common->get_particular('mst_taxs', array('tax_id' => $product_detail['product_tax']),'tax_percentage');
								$amount = $product_detail['product_mrp']*$dc_relation_details['quantity'];
								$tax_total = ($amount) * $tax_percentage/100;
								if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1){
									$total = $amount + $tax_total;
								}else{
									$total = $amount;
								}
								$relations = array(
									'invoice_id'		=> $invoice_id,
									'product_id'		=> $dc_relation_details['product_id'],
									'dc_id'				=> $dc_relation_details['dc_id'],
									'dc_relation_id'	=> $dc_relation_id,
									'product_name'		=> $dc_relation_details['product_name'],
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
								if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
									$relations['brand_name'] = $dc_relation_details['brand_name'];
								}
								if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
									$relations['category_name'] = $dc_relation_details['category_name'];
								}
								if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){
									$relations['subcategory_name'] = $dc_relation_details['sub_category_name'];
								}
								$invoice_relation_id = $this->common->insert('tbl_invoices_relation',$relations);
								$invoice_total = $invoice_total+$total;
								if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_stock_reduce'),'invoice_settings_value')== 1){
									$stock = array(
										'product_id'		=>	$dc_relation_details['product_id'],
										'quantity'			=>	$dc_relation_details['quantity'],
									);
									$this->invoice->reduce_stock($stock);
									$message = array(
										'result' 	=> 'success',
										'message' 	=> 'Stock Reduced Successfully',
									);
									$this->session->set_userdata('msg',$message);	
								}
								if($invoice_relation_id){
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
									$this->invoice->check_dc_status($dc_id);
									//$this->invoice->get_dcs_relation_details($dc_id);
								}
							}
						}
					}
					if(isset($data['invoice_discount'])){
						$invoice_total = $invoice_total - $data['invoice_discount'];
					}else{
						$invoice_total = $invoice_total + $additonal_expenses_and_tax;
					}
					if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Invoice_Payment'),'status')== 1){
						$payment = array(
							'company_id'		=> $data['company_id'],
							'customer_id' 		=> $data['invoice_customer'],
							'invoice_id' 		=> $invoice_id,
							'invoice_amount' 	=> $invoice_total,
							'invoice_status' 	=> 0,
							'created_on' 		=> created_on(),
							'created_by' 		=> created_by(),
							'status' 			=> 1
						);
						$this->common->insert('tbl_invoice_payments',$payment);
					}else{
						$payment = array(
							'company_id'		=> $data['company_id'],
							'customer_id' 		=> $data['invoice_customer'],
							'invoice_id' 		=> $invoice_id,
							'invoice_amount' 	=> $invoice_total,
							'invoice_status' 	=> 2,
							'created_on' 		=> created_on(),
							'created_by' 		=> created_by(),
							'status' 			=> 1
						);
						$invoice_payment_id = $this->common->insert('tbl_invoice_payments',$payment);
						if($invoice_payment_id){
							$payment_history = array(
								'company_id'			=> $data['company_id'],
								'customer_id' 			=> $data['invoice_customer'],
								'invoice_payments_id'	=> $invoice_payment_id,
								'invoice_amount' 		=> $invoice_total,
								'paid_amount' 			=> $invoice_total,
								'balance_amount' 		=> 0,
								'payment_type'			=> "cash",
								'payment_date'			=> date('Y-m-d',strtotime($data['invoice_date'])),
								'remarks'				=> "Cash Received",
								'created_on' 			=> created_on(),
								'created_by' 			=> created_by(),
								'status' 				=> 1
							);
							$this->common->insert('tbl_invoice_payments_history',$payment_history);
						}
					}
					//DC AUTO GENERATE
					if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_dc_auto_generate'),'invoice_settings_value')== 1){
						$this->invoice_generate_dc($invoice_id); 
					}
					$log = array(
						'user_id'			=> $this->session->userdata('user_id'),
						'company_id'		=> $data['company_id'],
						'log_category_id'	=> 1,
						'operation'			=> 'Invoice Created',
						'operation_details'	=> 'Invoice Created For '.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['invoice_customer']),'customer_name'),
						'invoice_id'		=> $invoice_id,
						'logs_status'		=> 0,
						'created_on'		=> created_on(),
						'status'			=> 1
					);
					$log_id = $this->common->insert('tbl_logs',$log);
					$message = array(
						'result' 	=> 'success',
						'message' 	=> 'Invoice generated successfully',
					);
					$this->session->set_userdata('msg',$message);
					redirect(base_url('invoice_view/'.$invoice_id));
				}else{
					$message = array(
						'result' 	=> 'failed',
						'message' 	=> 'Invoice generation failed',
					);
					$this->session->set_userdata('msg',$message);
					redirect(base_url('invoice'));
				}
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Product adding to invoice failed',
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('invoice'));
		}else{
			$this->common->truncate('tbl_invoices_relation_temp',array('company_id' => $this->session->userdata('company_id'),'created_by' => $this->session->userdata('user_id')));
			$data['lists'] 		= array();
			$data['invoice_number'] = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'invoice_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'invoice_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'invoice_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			$data['customers'] 	= convert_options($this->common->gets_array('mst_customers',array('status' =>1)),'customer_id','customer_name','CUSTOMER');
			$data['employees'] 	= convert_options($this->common->gets_array('mst_users',array('status' =>1)),'user_id','username','EMPLOYEE');
			$data['dc_no'] 	= convert_options($this->common->gets_array('tbl_dcs',array('status' => 1,'dc_id' => $this->session->userdata('company_id'),'invoice_id' => 0)),'dc_id','dc_number','DC NO');
			//COMPANY LIST IF MULTIPLE COMPANY ENABLE
			if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){
				if($this->session->userdata('access_level')==1){
					$data['company_lists'] = array_column($this->user->get_company_list(), 'company_name');
				}elseif($this->session->userdata('access_level')==2){
					$data['company_lists'] = array_column($this->user->get_current_user_companies(), 'company_name');
				}
			}
			$this->template->build('invoice/invoice',$data);
		}
	}
	public function invoice_edit($invoice_id){
		if($this->input->post()){
			$final_result = false;
			$data = $this->input->post();
			$invoice_products = $this->invoice->get_invoice_products();
			//echo "<pre>";print_r($data);exit;
			if($invoice_products){
				$invoice = array(
					'company_id'				=>	$data['company_id'],
					'invoice_number' 			=>	$data['invoice_number'],
					'invoice_date' 				=>	date('Y-m-d',strtotime($data['invoice_date'])),
					'invoice_type'   			=>	$data['invoice_type'],
					'invoice_customer' 			=>	$data['invoice_customer'],
					'invoice_employee'			=>	$data['invoice_employee'],
					'invoice_approved'			=>	1,
					'invoice_cash_discount'		=> 	$data['invoice_cash_discount'],
					'invoice_overall_discount'	=>  $data['invoice_overall_discount'],
					'invoice_loading_charges' 	=> 	$data['invoice_loading_charges'],
					'invoice_transportaion_charges'=>$data['invoice_transportaion_charges'],
					'invoice_other_expenses' 	=> $data['invoice_other_expenses'],
					'total_bundle' 				=> $data['total_bundle'],
					'reverse_charge' 			=> $data['reverse_charge'],
					'date_of_supply' 			=> date('Y-m-d',strtotime($data['date_of_supply'])),
					'place_of_supply' 			=> $data['place_of_supply'],
					'updated_on'				=>	updated_on(),
					'updated_by'				=>	created_by(),
					'status' 					=>	1
				);
				// if(isset($data['invoice_discount'])){
				// 	$invoice = array('invoice_discount' => $data['invoice_discount']);
				// }
				$invoice_update = $this->common->update('tbl_invoices',$invoice,array('invoice_id' => $invoice_id ));
				if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_stock_reduce'),'invoice_settings_value')== 1){
					$this->increase_invoice_stock($invoice_id);
				}
				$additonal_expenses_and_tax = 0;
				if(isset($data['invoice_loading_charges'])){
					$additonal_expenses_and_tax = $additonal_expenses_and_tax + $data['invoice_loading_charges'] ;
				}
				if(isset($data['invoice_transportaion_charges'])){
					$additonal_expenses_and_tax = $additonal_expenses_and_tax + $data['invoice_transportaion_charges'] ;
				}
				if(isset($data['invoice_other_expenses'])){
					$additonal_expenses_and_tax = $additonal_expenses_and_tax + $data['invoice_other_expenses'] ;
				}
				if($invoice_update){
					$invoice_total = 0;
					//DELETE RELATIONS
					$this->common->update('tbl_invoices_relation',array('status' => 0),array('invoice_id' => $invoice_id));
					foreach ($invoice_products as $key => $product) {
						//echo "<pre>";print_r($product);exit;
						//DEFAULT TAX CALCULATION BASED ON invoice PRICE
						$product_detail = $this->common->get_array('mst_products',array('product_id' =>$product['product_id']));
						$tax_percentage = $this->common->get_particular('mst_taxs', array('tax_id' => $product_detail['product_tax']),'tax_percentage');
						$amount = $product['rate']*$product['quantity'];
						$tax_total = ($amount) * $tax_percentage/100;
						if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1){
							$total = $amount + $tax_total;
						}else{
							$total = $amount;
						}
						$relations = array(
							'invoice_id'			=> $invoice_id,
							'product_id'			=> $product['product_id'],
							'dc_id'					=> $product['dc_id'],
							'dc_relation_id'		=> $product['dc_relation_id'],
							'product_name'			=> $product['product_name'],
							'rate'					=> $product['rate'],
							'quantity'				=> $product['quantity'],
							'available_quantity'	=> $product['quantity'],
							'discount_percentage'   => $product['discount_percentage'],
							'pre_total'				=> $product['pre_total'],
							'tax_percent'			=> $tax_percentage,
							'tax_total'				=> $tax_total,
							'total'					=> $product['total'],
							'updated_on'			=> created_on(),
							'updated_by'			=> created_by(),
							'status'				=> 1

							// 'invoice_id'			=> $invoice_id,
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
						$invoice_relation_id = $this->common->insert('tbl_invoices_relation',$relations);
						$invoice_total = $invoice_total+$total;
						if($invoice_relation_id){
							$final_result = true;
						}
						if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_stock_reduce'),'invoice_settings_value')== 1){
							$stock = array(
								'product_id'		=>	$product['product_id'],
								'quantity'			=>	$product['quantity'],
							);
							$this->invoice->reduce_stock($stock);
							$message = array(
								'result' 	=> 'success',
								'message' 	=> 'Stock Reduced Successfully',
							);
							$this->session->set_userdata('msg',$message);	
						}
					}
					if(isset($data['invoice_discount'])){
						$invoice_total = $invoice_total - $data['invoice_discount'];
					}else{
						$invoice_total = $invoice_total + $additonal_expenses_and_tax;
					}
					if($final_result){
						if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Invoice_Payment'),'status')== 1){
							$existing_invoice_payment = $this->common->get_array('tbl_invoice_payments',array('invoice_id' => $invoice_id ));
							$existing_invoice_paid = $this->common->sum('tbl_invoice_payments_history',array('invoice_payments_id' => $existing_invoice_payment['invoice_payments_id'] ),'paid_amount','paid_amount');
							if($existing_invoice_paid == 0){
								$invoice_status = 0;
							}elseif( ($existing_invoice_payment['invoice_amount'] >= $invoice_total ) && ( $invoice_total == $existing_invoice_paid )  ){
								$invoice_status = 2;
							}else{
								$invoice_status = 1;
							}
							$payment = array(
								'customer_id' 		=> $data['invoice_customer'],
								'invoice_id' 		=> $invoice_id,
								'invoice_amount' 	=> $invoice_total,
								'invoice_status' 	=> $invoice_status,
								'updated_on' 		=> created_on(),
								'updated_by' 		=> created_by(),
								'status' 			=> 1
							); 
							//echo "<pre>";print_r($payment);exit;
							$this->common->update('tbl_invoice_payments',$payment,array('invoice_id' => $invoice_id ));
							redirect(base_url('invoice_view/'.$invoice_id));
						}else{
							$payment = array(
								'company_id'	 => $data['company_id'],
								'customer_id' 	 => $data['invoice_customer'],
								'invoice_id' 	 => $invoice_id,
								'invoice_amount' => $invoice_total,
								'invoice_status' => 2,
								'updated_on' 	 => created_on(),
								'updated_by' 	 => created_by(),
								'status' 		 => 1
							);
							$invoice_payment_id = $this->common->update('tbl_invoice_payments',$payment,array('invoice_id' => $invoice_id ));
							if($invoice_payment_id){
								$payment_history = array(
									'company_id'			=> $$data['company_id'],
									'customer_id' 			=> $data['invoice_customer'],
									'invoice_payments_id'	=> $invoice_payment_id,
									'invoice_amount' 		=> $invoice_total,
									'paid_amount' 			=> $invoice_total,
									'balance_amount' 		=> 0,
									'payment_type'			=> "cash",
									'payment_date'			=> date('Y-m-d',strtotime($data['invoice_date'])),
									'remarks'				=> "Cash Received",
									'updated_on' 			=> created_on(),
									'updated_by' 			=> created_by(),
									'status' 				=> 1
								);
								$this->common->update('tbl_invoice_payments_history',$payment_history,array('invoice_payments_id' => $invoice_payment_id));
							}
						}
					}
					$log = array(
						'user_id'			=> $this->session->userdata('user_id'),
						'company_id'		=> $data['company_id'],
						'log_category_id'	=> 1,
						'operation'			=> 'Invoice Updated',
						'operation_details'	=> 'Invoice Updated For '.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['invoice_customer']),'customer_name'),
						'invoice_id'		=> $invoice_id,
						'logs_status'		=> 0,
						'created_on'		=> created_on(),
						'status'			=> 1
					);
					$log_id = $this->common->insert('tbl_logs',$log);
				}else{
					$message = array(
						'result' 	=> 'failed',
						'message' 	=> 'Invoice Updated failed',
					);
					$this->session->set_userdata('msg',$message);
					redirect(base_url('invoice_list'));
				}
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Product adding to invoice failed',
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('invoice_list'));
		}else{
			$this->common->truncate('tbl_invoices_relation_temp',array('company_id' => $this->session->userdata('company_id'),'created_by' => $this->session->userdata('user_id')));
			$data = $this->invoice->get_invoice_details($invoice_id);
			$this->add_temp_invoice($data['relations']);
			$data['temp_products'] = $this->get_invoice_temp_listings();
			$data['customers'] 	= convert_options_selected($this->common->gets_array('mst_customers',array('status' =>1)),'customer_id','customer_name','CUSTOMER',$data['invoice_details']['invoice_customer']);
			$data['employees'] 	= convert_options_selected($this->common->gets_array('mst_users',array('status' =>1)),'user_id','username','EMPLOYEE',$data['invoice_details']['invoice_employee']);
			//IF multiple DC ENABLE
			$data['dc_no']	= multi_select($this->common->gets_array('tbl_dcs'),'dc_number','dc_id',$data['invoice_details']['dc_id']);
			$data['company_lists'] 	= convert_options_selected($this->common->gets_array('company_details',array('company_status' =>1,'company_id' => $data['invoice_details']['company_id'])),'company_id','company_name','COMPANY',$data['invoice_details']['company_id']);
			//echo "<pre>";print_r($data['company_lists']);exit;
			$this->template->build('invoice/invoice',$data);
		}
	}
	private function get_invoice_temp_listings(){
		$data['lists'] = $this->invoice->get_invoice_temp_listings();
		if($data['lists']){
			$lists = $this->load->view('invoice/includes/dc_temp_list_edit', $data, TRUE);
		}else{
			$lists ='<tr>
			<td colspan="9">NO PRODUCTS ADDED</td>
			</tr>';
		}
		return $lists;
	}
	public function invoice_calculation(){
		$data = $this->input->post();
	//echo "<pre>";print_r($data);exit;
		if($data){
			$data['amount'] = $data['product_quantity'] * $data['product_rate'];
		}
		$data['result'] = "success";
		echo json_encode($data);
	}
//ADD TEMPRORY PURCHASE ORDER
	public function add_temprory_invoice(){
		$data = $this->input->post();
		$new_invoice_temp = array(
			'product_id'			=> $data['product_id'],
			'company_id'			=> $this->session->userdata('company_id'),
			'quantity'				=> $data['quantity'],
			'rate'					=> $data['rate'],
			'total'					=> $data['amount'],
			'created_on'			=> created_on(),
			'created_by'			=> created_by(),
			'status'				=> 1
		);
		$invoice_relation_temp_id = $this->common->insert('tbl_invoices_relation_temp',$new_invoice_temp);
		if($invoice_relation_temp_id){
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
		$sub_total 					= $this->invoice->invoice_temp_total();
		$message['sub_total'] 		= implode($sub_total);
		$message['display_message'] = return_message($message);
		echo json_encode($message);
	}
	private function temp_listing(){
		$data['lists'] = $this->invoice->get_temp_listings();
		//echo "<pre>";print_r($data);exit;
		$content = $this->load->view('invoice/includes/temp_listing', $data, TRUE);
		return $content;
	}
//REMOVE TEMPRORY PURCHASE ORDER
	public function remove_temp_invoice(){
		$invoice_temp_id = $this->input->post('invoice_temp_id');
		if($invoice_temp_id!=''){
			$temp_details = $this->common->get_array('tbl_invoices_relation_temp',array('invoice_relation_temp_id' => $invoice_temp_id ));
			$remove = $this->common->remove('tbl_invoices_relation_temp',array('invoice_relation_temp_id' => $invoice_temp_id ));
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
		$sub_total 			= $this->invoice->invoice_temp_total();
		if($sub_total == ""){
			$message['sub_total'] 		= "0";
		}else{
			$message['sub_total'] 		= implode($sub_total);
		}
		$message['display_message'] = return_message($message);
		echo json_encode($message);
	}
	public function invoice_view($invoice_id){
		$data = $this->invoice->get_invoice_details($invoice_id);
		//echo "<pre>";print_r($data);exit;
		$this->template->build('invoice/invoice_view',$data);
	}
	public function invoice_print($invoice_id){
		$data = $this->invoice->get_invoice_details($invoice_id);
		//echo "<pre>";print_r($data);exit;
		//$html = $this->load->view('invoice/invoice_print',$data,true);
		$html = $this->load->view('invoice/invoice_print_new',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output('invoice_PRINT.pdf','I');
	}
	public function invoice_download($invoice_id){
		$data = $this->invoice->get_invoice_details($invoice_id);
		$html = $this->load->view('invoice/invoice_print',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output('invoice.pdf','D');
	}
	private function add_temp_invoice($rows){
		//echo "<pre>";print_r($rows);exit;
		$this->common->remove('tbl_invoices_relation_temp',array('company_id' => $this->session->userdata('company_id')));
		foreach ($rows as $key => $row) {
			$stock_id = $this->common->get_particular('tbl_stock',array('product_id' => $row['product_id']),'stock_id');
			$temp = array(
				'company_id'			=> $this->session->userdata('company_id'),
				'product_id'			=> $row['product_id'],
				'stock_id'				=> $stock_id,
				'dc_id'					=> $row['dc_id'],
				'dc_relation_id'		=> $row['dc_relation_id'],
				'product_name'			=> $row['product_name'],
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
			if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
				$temp['brand_name'] = $row['brand_name'];
			}
			if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
				$temp['category_name'] = $row['category_name'];
			}
			if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){
				$temp['subcategory_name'] = $row['sub_category_name'];
			}
			$insert_id = $this->common->insert('tbl_invoices_relation_temp',$temp);
		}
	}
	private function increase_invoice_stock($invoice_id){
		$data = $this->invoice->get_invoice_details($invoice_id);
		if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_stock_reduce'),'invoice_settings_value')== 1){
			if($data['relations']){
				foreach ($data['relations'] as $key => $relation) {
					$stock = array(
						'product_id'		=>	$relation['product_id'],
						'quantity'			=>	$relation['quantity'],
					);
					$this->invoice->increase_stock($stock);
				}
				$status = array('status' => 0 );
				$this->common->update('tbl_invoices_relation',$status,array('invoice_id' => $invoice_id ));
			}else{
				return false;
			}
		}
	}

	public function invoice_generate_dc($invoice_id){
		$data = $this->invoice->get_invoice_details($invoice_id);
		//echo "<pre>";print_r($data);//exit;
		$dc_number = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'dc_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'dc_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'invoice_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
		if($data){
			$dc = array(
				'company_id'			=> $data['invoice_details']['company_id'],
				'invoice_id'			=> $invoice_id,
				'dc_number'				=> $dc_number,
				'dc_date'				=> date('Y-m-d'),
				'dc_customer'			=> $data['invoice_details']['invoice_customer'],
				'transport_vechile_no'	=> $data['invoice_details']['transport_vechile_no'],
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
						'tax_name'				=> $relation['tax_name'],
						'tax_percent'			=> $relation['tax_percent'],
						'quantity'				=> $relation['quantity'],
						'rate'					=> $relation['rate'],
						'created_on'			=> created_on(),
						'created_by'			=> created_by(),
						'status'				=> 1
					);
					if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
						$dc_relation['brand_name'] = $relation['brand_name'];
					}
					if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
						$dc_relation['category_name'] = $relation['category_name'];
					}
					if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){
						$dc_relation['subcategory_name'] = $relation['sub_category_name'];
					}
					$dc_relation_id  = $this->common->insert('tbl_dcs_relation',$dc_relation);
				//STOCK REDUCE
					$stock = array(
						'product_id'		=>	$relation['product_id'],
						'quantity'			=>	$relation['quantity'],
					);
					$this->invoice->reduce_stock($stock);
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
				$invoice_update_status = $this->common->update('tbl_invoices',$update,array('invoice_id' => $invoice_id ));
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
				redirect(base_url('invoice_view/'.$invoice_id));
			}else{
				$message = array(
					'result'	=> 'failed',
					'message'	=> 'Dc generation failed'
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('invoice_list'));
			}
		}
	}
	public function check_product_qty(){
		$data = $this->input->post();
		if($this->common->get_particular('mst_modules',array('module_name' => 'INVENTORY'),'invoice_settings_value')==1){
			if($data['product_id']!=""){
				$product_id 		= $data['product_id'];
				$product_qty 		= $data['product_qty'];
				$product_qty_check 	= $this->invoice->check_product_qty($product_id,$product_qty);
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
//invoice PAYMENT LIST
	public function invoice_payment_list(){
		$data['lists'] = $this->invoice->get_invoice_payment_list();
	//echo "<pre>";print_r($data);exit;
		$this->template->build('payments/invoice/invoice_payment_list',$data);
	}
	public function invoice_payments_bill_details($invoice_payments_id){
		$data['payment'] = $this->invoice->get_invoice_detail_bills($invoice_payments_id);
	    //echo "<pre>";print_r($data);exit;
		$this->template->build('payments/invoice/invoice_payments',$data);
	}
//ADD invoice BILL PAYMENTS
	public function add_invoice_payment_bills(){ 
		$data = $this->input->post();
	//echo "<pre>";print_r($data);exit;
		$insert = array(
			'invoice_payments_id' 	=> $data['invoice_payments_id'],
			'company_id'			=> $this->session->userdata('company_id'),
			'customer_id'			=> $data['customer_id'],
			'invoice_amount' 		=> $data['invoice_amount'],
			'paid_amount' 			=> $data['paid_amount'],
			'balance_amount'		=> $data['balance_amount']-$data['paid_amount'],
			'payment_type' 			=> $data['payment_type'],
			'cheque_no' 			=> $data['cheque_number'],
			'upi_id'	 			=> $data['upi_id'],
			'bank_name' 			=> $data['bank_name'],
			'payment_date' 			=> date('Y-m-d',strtotime($data['payment_date'])),
			'remarks' 				=> $data['remark'],
			'created_on' 			=> created_on(),
			'created_by' 			=> created_by(),
			'status'				=> 1
		);
		$insert_result = $this->common->insert('tbl_invoice_payments_history',$insert);
		if($insert_result){
			$update = array('invoice_status' => 1 );
			$this->common->update('tbl_invoice_payments',$update,array('invoice_payments_id' => $data['invoice_payments_id'] ));
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'company_id'		=> $this->session->userdata('company_id'),
				'log_category_id'	=> 15,
				'operation'			=> 'Invoice Payment Added',
				'operation_details'	=> 'Invoice Payment Added'.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['customer_id']),'customer_name'),
				'invoice_payment_id'=> $data['invoice_payments_id'],
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
				$update = array('invoice_status' => 2 );
				$invoice_update = $this->common->update('tbl_invoice_payments',$update,array('invoice_payments_id' => $data['invoice_payments_id'] ));
				if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'multiple_dc_to_invoice_generate'),'invoice_settings_value')== 1){
					$get_invoice_id = $this->common->get_particular('tbl_invoice_payments',array('invoice_payments_id' => $data['invoice_payments_id']),'invoice_id');
					if($invoice_update){
						$status = array(
							'status' 		=> 2,
							'updated_on' 	=> created_on(),
							'updated_by'	=> created_by()
						);
						$updated = $this->common->update('tbl_invoices',$status,array('invoice_id' => $get_invoice_id));
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
		redirect(base_url('invoice_payments_bill_details/'.$data['invoice_payments_id']));
	}
	public function invoice_remove($invoice_id){
		$update = array(
			'updated_on' 		=> created_on(),
			'updated_by' 		=> created_by(),
			'status' 			=> 0 ,
			'invoice_cancel' 	=> 1
		);
		$delete_result = $this->common->delete('tbl_invoices',$update,array('invoice_id' => $invoice_id ));
		if($delete_result){
			if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_stock_reduce'),'invoice_settings_value')== 1){
				$stock_reduced = $this->common->gets_array('tbl_invoices_relation',array('invoice_id' => $invoice_id,'status' => 1 ));
				if($stock_reduced){
					foreach ($stock_reduced as $key => $stock_reduce) {
						$stock = array(
							'product_id'	=>	$stock_reduce['product_id'],
							'quantity'		=>	$stock_reduce['quantity'],
						);
						//echo "<pre>";print_r($stock);exit;
						$this->invoice->increase_stock($stock);
					}
				}
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $this->session->userdata('company_id'),
					'log_category_id'	=> 1,
					'operation'			=> 'Invoice Deleted',
					'operation_details'	=> 'Invoice Deleted For '.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['invoice_customer']),'customer_name'),
					'invoice_id'		=> $invoice_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'Invoice removed successfully',
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('invoice_list'));
			}
			if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_dc_generate'),'settings_value')== 1){
				$update_dc = array(
					'updated_on' 	=> created_on(),
					'updated_by' 	=> created_by(),
					'status' 		=> 0 ,
					'dc_cancel' 	=> 1
				);
				$dc_delete_result = $this->common->delete('tbl_dcs',$update_dc,array('invoice_id' => $invoice_id ));
				if($dc_delete_result){
					$data = $this->invoice->get_invoice_details($invoice_id);
					if($data['relations']){
						foreach ($data['relations'] as $key => $relation) {
							$stock = array(
								'product_id'		=>	$relation['product_id'],
								'quantity'			=>	$relation['quantity'],
							);
							$this->invoice->increase_stock($stock);
						}
						$status = array('status' => 0 );
						$this->common->update('tbl_invoices_relation',$status,array('invoice_id' => $invoice_id ));
					}
					$message = array(
						'result' 	=> 'success',
						'message' 	=> 'Invoice removed successfully',
					);
					$this->session->set_userdata('msg',$message);
					redirect(base_url('invoice_list'));
				}
			}
		}else{
			$message = array(
				'result' 	=> 'failed',
				'message' 	=> 'Invoice Removing failed',
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('invoice_list'));
	}
	//GET CUSOTMER BASED DC
	public function get_customer_based_invoice(){
		$customer_id = $this->input->post('customer_id');
		$data['dc_no'] =  convert_options($this->common->gets_array('tbl_dcs',array('dc_customer' =>$customer_id,'status' => 1)),'dc_id','dc_number','DC NO');
		$data['result'] = "success";
		echo json_encode($data);
	}
	public function get_invoice_dc_details(){
		$dc_no = $this->input->post('dc_no');
		$content = "";
		$data['count'] = 0;
		if(!empty($dc_no)){
			foreach ($dc_no as $key => $dc) {
				if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1){
					$data['dc_details'] = $this->common->gets_array('tbl_dcs_relation',array('dc_id' => $dc,'status' => 1,'balance_quantity!=' => 0));
				}elseif($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1){
					$data['dc_details'] = $this->common->gets_array('tbl_dcs_relation',array('dc_id' => $dc,'status' => 1,'balance_quantity!=' => 0));
				}else{
					$data['dc_details'] = $this->common->gets_array('tbl_dcs_relation',array('dc_id' => $dc,'status' => 1));
				}
				$content .= $this->load->view('invoice/includes/dc_temp_listing',$data,TRUE);
				$data['count'] = ($data['count'] + $this->common->count('tbl_dcs_relation',array('dc_id' => $dc,'status' => 1)));
				//SAVED INTO invoice TEMP TABLE
				foreach ($data['dc_details'] as $key => $dc_detail) {
					$invoice_relation_temp_id = $this->common->get_particular('tbl_invoices_relation_temp',array('dc_id' => $dc_detail['dc_id'],'product_id' => $dc_detail['product_id'],'quantity' => $dc_detail['quantity']),'invoice_relation_temp_id');
					$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
					$tax_total = $rate * $dc_detail['tax_percent']/100;
					$total = (($dc_detail['quantity'] * $rate) + $tax_total);
					if($invoice_relation_temp_id){
						$new_invoice_temp = array(
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
						$update = $this->common->update('tbl_invoices_relation_temp',$new_invoice_temp,array('dc_id' => $dc_detail['dc_id'],'product_id' => $dc_detail['product_id'],'quantity' => $dc_detail['quantity']));
					}else{
						$new_invoice_temp = array(
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
						$insert = $this->common->insert('tbl_invoices_relation_temp',$new_invoice_temp);
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
	public function invoice_product_total_calculations(){
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
	public function invoice_edit_temp_products(){
		$dc_relation_id      = $this->input->post('dc_relation_id');
		$quantity            = $this->input->post('quantity');
		$rate                = $this->input->post('rate');
		$discount_percentage = $this->input->post('discount_percentage');
		$discount_price      = $this->input->post('discount_price');
		$tax_percentage      = $this->input->post('tax_percentage');
		$tax_total  		 = $this->input->post('tax_total');
		$total               = $this->input->post('total');
		if($dc_relation_id){
			$update_invoice_temp = array(
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
			//echo "<pre>";print_r($update_invoice_temp);exit;
			$update = $this->common->update('tbl_invoices_relation_temp',$update_invoice_temp,array('dc_relation_id' => $dc_relation_id));
			
		}
		$sub_total = $this->invoice->invoice_temp_total();
		$data['result'] = "success";
		$data['sub_total'] = implode($sub_total);
		echo json_encode($data);
	}
	//Change Settings
	public function change_invoice_setting($value){
		//IF value = 1 (change setting into direct estimate else value = 2 (change setting into dc to estimate))
		if($value!=""){
			if($value == 1){
				$update_settings = array(
					'invoice_settings_name' 	=> 'multiple_dc_to_invoice_generate',
					'invoice_settings_value'	=> 0
				);
				$update = $this->common->update('mst_invoice_settings',$update_settings,array('invoice_settings_name' => 'multiple_dc_to_invoice_generate',
					'invoice_settings_value' => 1));
			}else{
				$update_settings = array(
					'invoice_settings_name' 	=> 'multiple_dc_to_invoice_generate',
					'invoice_settings_value' 	=> 1
				);
				$update = $this->common->update('mst_invoice_settings',$update_settings,array('invoice_settings_name' => 'multiple_dc_to_invoice_generate',
					'invoice_settings_value' => 0));
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
		redirect(base_url('invoice'));
	}
}
/* End of file invoice.php */
/* Location: ./application/app/controllers/invoice.php */