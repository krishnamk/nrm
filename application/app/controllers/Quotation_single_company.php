<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Quotation extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Quotation_model','quotation');
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
	public function quotation_list(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['lists'] = $this->quotation->get_quotation_lists($data);
		//echo '<pre>';print_r($data);exit;
			if($data['option'] == 'view'){
				$this->template->build('quotation/quotation_list',$data);
			}else{
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$html = $this->load->view('quotation/quotation_list_pdf',$data,true);
				$pdf->WriteHTML($html);
				$pdf->Output('quotation_listing_pdf.pdf','I');
			}
		}else{
			$data['lists'] = $this->quotation->get_quotation_lists();
		//echo '<pre>';print_r($data);exit;
			$this->template->build('quotation/quotation_list',$data);
		}
	}
	public function quotation(){
		if($this->input->post()){
			$data = $this->input->post();
			echo "<pre>";print_r($data);exit;
			$temp_products = $this->quotation->get_temp_listings();
			//echo "<pre>";print_r($temp_products);exit;
			// $quotation_number = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'quotation_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'quotation_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			if($temp_products){
				$quotation = array(
					'company_id'						=>	$this->session->userdata('company_id'),
					'quotation_number'     				=>	$data['quotation_number'],
					'quotation_date' 	  				=>	date('Y-m-d',strtotime($data['quotation_date'])),
					'quotation_customer'   				=>	$data['quotation_customer'],
					'quotation_employee'				=>	$this->session->userdata('user_id'),
					'quotation_approved'				=>	1,
					'quotation_cancel'					=>	0,
					'created_on'						=>	created_on(),
					'created_by'						=>	created_by(),
					'status'							=>	1
				);
				if(isset($data['quotation_loading_changes'])){
					$quotation = array('quotation_loading_changes' => $data['quotation_loading_changes']);
				}
				if(isset($data['quotation_transportaion_changes'])){
					$quotation = array('quotation_transportaion_changes' => $data['quotation_transportaion_changes']);
				}
				if(isset($data['quotation_discount'])){
					$quotation = array('quotation_discount' => $data['quotation_discount']);
				}
				$quotation_id = $this->common->insert('tbl_quotations',$quotation);
				if($quotation_id){
					$additonal_expenses_and_tax = 0;
					if(isset($data['quotation_loading_changes'])){
						$additonal_expenses_and_tax = $additonal_expenses_and_tax + $data['quotation_loading_changes'] ;
					}
					if(isset($data['quotation_transportaion_changes'])){
						$additonal_expenses_and_tax = $additonal_expenses_and_tax + $data['quotation_transportaion_changes'] ;
					}
					$current_count =$this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'quotation_prefix_count');
					$next_count = next_number($current_count);
					$this->common->update('company_details',array('quotation_prefix_count' => $next_count ),array('company_id' => $this->session->userdata('company_id')));
					$quotation_total = 0;
					foreach ($temp_products as $key => $product) {
					//DEFAULT TAX CALCULATION BASED ON QUOTATION PRICE
						$product_detail = $this->common->get_array('mst_products',array('product_id' =>$product['product_id']));
						$tax_percentage = $this->common->get_particular('mst_taxs', array('tax_id' => $product_detail['product_tax']),'tax_percentage');
						$amount = $product['rate']*$product['quantity'];
						$tax_total = ($amount) * $tax_percentage/100;
						if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_tax_included'),'quotation_settings_value')== 1){
							$total = $amount + $tax_total;
						}else{
							$total = $amount;
						}
						$relations = array(
							'quotation_id'			=> $quotation_id,
							'product_id'			=> $product['product_id'],
							'product_name'			=> $product['product_name'],
							'brand_name' 			=> $product['brand_name'],
							'category_name' 		=> $product['category_name'],
							'subcategory_name' 		=> $product['sub_category_name'],
							'tax_name' 				=> $product['tax_name'],
							'tax_percent'			=> $product['tax_percentage'],
							'tax_total'				=> $tax_total,
							'quantity'				=> $product['quantity'],
							'rate'					=> $product['rate'],
							'total'					=> $total,
							'created_on'			=> created_on(),
							'created_by'			=> created_by(),
							'status'				=> 1
						);
						$quotation_relation_id = $this->common->insert('tbl_quotations_relation',$relations);
						$quotation_total = $quotation_total+$total;
						if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_stock_reduce'),'quotation_settings_value')== 1){
							$stock = array(
								'product_id'		=>	$product['product_id'],
								'quantity'			=>	$product['quantity'],
							);
							$this->quotation->reduce_stock($stock);
							$message = array(
								'result' 	=> 'success',
								'message' 	=> 'Stock Reduced Successfully',
							);
							$this->session->set_userdata('msg',$message);	
						}
					}
					if(isset($data['quotation_discount'])){
						$quotation_total = $quotation_total - $data['quotation_discount'];
					}else{
						$quotation_total = $quotation_total + $additonal_expenses_and_tax;
					}
					if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Quotation_Payment'),'status')== 1){
						$payment = array(
							'company_id'		=> $this->session->userdata('company_id'),
							'customer_id' 		=> $data['quotation_customer'],
							'quotation_id' 		=> $quotation_id,
							'quotation_amount' 	=> $quotation_total,
							'quotation_status' 	=> 0,
							'created_on' 		=> created_on(),
							'created_by' 		=> created_by(),
							'status' 			=> 1
						);
						$this->common->insert('tbl_quotation_payments',$payment);
					}else{
						$payment = array(
							'company_id'		=> $this->session->userdata('company_id'),
							'customer_id' 		=> $data['quotation_customer'],
							'quotation_id' 		=> $quotation_id,
							'quotation_amount' 	=> $quotation_total,
							'quotation_status' 	=> 2,
							'created_on' 		=> created_on(),
							'created_by' 		=> created_by(),
							'status' 			=> 1
						);
						$quotation_payment_id = $this->common->insert('tbl_quotation_payments',$payment);
						if($quotation_payment_id){
							$payment_history = array(
								'company_id'			=> $this->session->userdata('company_id'),
								'customer_id' 			=> $data['quotation_customer'],
								'quotation_payments_id'	=> $quotation_payment_id,
								'quotation_amount' 		=> $quotation_total,
								'paid_amount' 			=> $quotation_total,
								'balance_amount' 		=> 0,
								'payment_type'			=> "cash",
								'payment_date'			=> date('Y-m-d',strtotime($data['quotation_date'])),
								'remarks'				=> "Cash Received",
								'created_on' 			=> created_on(),
								'created_by' 			=> created_by(),
								'status' 				=> 1
							);
							$this->common->insert('tbl_quotation_payments_history',$payment_history);
						}
					}
					//DC AUTO GENERATE
					if($this->common->get_particular('mst_settings',array('settings_name' => 'quotation_dc_auto_generate'),'settings_value')== 1){
						$this->qt_generate_dc($quotation_id);
					}
					$log = array(
						'user_id'			=> $this->session->userdata('user_id'),
						'company_id'		=> $this->session->userdata('company_id'),
						'log_category_id'	=> 4,
						'operation'			=> 'Quotation Created',
						'operation_details'	=> 'Quotation Created For  -'.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['quotation_customer']),'customer_name'),
						'quotation_id'		=> $quotation_id,
						'logs_status'		=> 0,
						'created_on'		=> created_on(),
						'status'			=> 1
					);
					$log_id = $this->common->insert('tbl_logs',$log);
					$message = array(
						'result' 	=> 'success',
						'message' 	=> 'Quotation generated successfully',
					);
					$this->session->set_userdata('msg',$message);
					redirect(base_url('quotation_view/'.$quotation_id));
				}else{
					$message = array(
						'result' 	=> 'failed',
						'message' 	=> 'Quotation generation failed',
					);
					$this->session->set_userdata('msg',$message);
					redirect(base_url('quotation'));
				}
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Product adding to quotation failed',
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('quotation'));
		}else{
			$this->common->remove('tbl_quotations_relation_temp',array('company_id' => $this->session->userdata('company_id'),'created_by' => $this->session->userdata('user_id')));
			$data['lists'] 		= array();
			$data['quotation_number'] = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'quotation_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'quotation_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'invoice_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			$data['customers'] 	= convert_options($this->common->gets_array('mst_customers',array('status' =>1)),'customer_id','customer_name','CUSTOMER');
			$data['employees'] 	= convert_options($this->common->gets_array('mst_users',array('status' =>1)),'user_id','username','EMPLOYEE');
			//COMPANY LIST IF MULTIPLE COMPANY ENABLE
			//$data['company_lists'] = $this->user->get_current_user_companies();
			if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){
				if($this->session->userdata('access_level')==1){
					$data['company_lists'] = array_column($this->user->get_company_list(), 'company_name');
				}elseif($this->session->userdata('access_level')==2){
					$data['company_lists'] = array_column($this->user->get_current_user_companies(), 'company_name');
				}
			}
			//echo "<pre>";print_r($data['company_lists']);exit;
			$this->template->build('quotation/quotation',$data);
		}
	}
	public function quotation_edit($quotation_id){
		if($this->input->post()){
			$final_result = false;
			$data = $this->input->post();
			$quotation_products = $this->quotation->get_quotation_products();
			if($quotation_products){
				$quotation = array(
					'company_id'						=>	$this->session->userdata('company_id'),
					'quotation_number' 					=>	$data['quotation_number'],
					'quotation_date' 					=>	date('Y-m-d',strtotime($data['quotation_date'])),
					'quotation_customer' 				=>	$data['quotation_customer'],
					'quotation_employee'				=>	$this->session->userdata('user_id'),
					'quotation_approved'				=>	1,
					'updated_on'						=>	updated_on(),
					'updated_by'						=>	created_by(),
					'status' 							=>	1
				);
				if(isset($data['quotation_loading_changes'])){
					$quotation = array('quotation_loading_changes' => $data['quotation_loading_changes']);
				}
				if(isset($data['quotation_transportaion_changes'])){
					$quotation = array('quotation_transportaion_changes' => $data['quotation_transportaion_changes']);
				}
				if(isset($data['quotation_discount'])){
					$quotation = array('quotation_discount' => $data['quotation_discount']);
				}
				$quotation_update = $this->common->update('tbl_quotations',$quotation,array('quotation_id' => $quotation_id ));
				if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_stock_reduce'),'quotation_settings_value')== 1){
					$this->increase_quotation_stock($quotation_id);
				}
				$additonal_expenses_and_tax = 0;
				if(isset($data['quotation_loading_changes'])){
					$additonal_expenses_and_tax = $additonal_expenses_and_tax + $data['quotation_loading_changes'] ;
				}
				if(isset($data['quotation_transportaion_changes'])){
					$additonal_expenses_and_tax = $additonal_expenses_and_tax + $data['quotation_transportaion_changes'] ;
				}
				if($quotation_update){
					$quotation_total = 0;
					//DELETE RELATIONS
					$this->common->update('tbl_quotations_relation',array('status' => 0),array('quotation_id' => $quotation_id));
					foreach ($quotation_products as $key => $product) {
					//DEFAULT TAX CALCULATION BASED ON QUOTATION PRICE
						$product_detail = $this->common->get_array('mst_products',array('product_id' =>$product['product_id']));
						$tax_percentage = $this->common->get_particular('mst_taxs', array('tax_id' => $product_detail['product_tax']),'tax_percentage');
						$amount = $product['rate']*$product['quantity'];
						$tax_total = ($amount) * $tax_percentage/100;
						if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_tax_included'),'quotation_settings_value')== 1){
							$total = $amount + $tax_total;
						}else{
							$total = $amount;
						}
						$relations = array(
							'quotation_id'			=> $quotation_id,
							'product_id'			=> $product['product_id'],
							'product_name'			=> $product['product_name'],
							'brand_name' 			=> $product['brand_name'],
							'category_name' 		=> $product['category_name'],
							'subcategory_name' 		=> $product['sub_category_name'],
							'tax_name' 				=> $product['tax_name'],
							'tax_percent'			=> $product['tax_percentage'],
							'tax_total'				=> $tax_total,
							'quantity'				=> $product['quantity'],
							'rate'					=> $product['rate'],
							'total'					=> $total,
							'created_on'			=> created_on(),
							'created_by'			=> created_by(),
							'status'				=> 1
						);
						$quotation_relation_id = $this->common->insert('tbl_quotations_relation',$relations);
						$quotation_total = $quotation_total+$product['total'];
						if($quotation_relation_id){
							$final_result = true;
						}
						if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_stock_reduce'),'quotation_settings_value')== 1){
							$stock = array(
								'product_id'		=>	$product['product_id'],
								'quantity'			=>	$product['quantity'],
							);
							$this->quotation->reduce_stock($stock);
							$message = array(
								'result' 	=> 'success',
								'message' 	=> 'Stock Reduced Successfully',
							);
							$this->session->set_userdata('msg',$message);	
						}
					}
					if(isset($data['quotation_discount'])){
						$quotation_total = $quotation_total - $data['quotation_discount'];
					}else{
						$quotation_total = $quotation_total + $additonal_expenses_and_tax;
					}
					if($final_result){
						if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Quotation_Payment'),'status')== 1){
							$existing_quotation_payment = $this->common->get_array('tbl_quotation_payments',array('quotation_id' => $quotation_id ));
							$existing_quotation_paid = $this->common->sum('tbl_quotation_payments_history',array('quotation_payments_id' => $existing_quotation_payment['quotation_payments_id'] ),'paid_amount','paid_amount');
							if($existing_quotation_paid == 0){
								$quotation_status = 0;
							}elseif( ($existing_quotation_payment['quotation_amount'] >= $quotation_total ) && ( $quotation_total == $existing_quotation_paid )  ){
								$quotation_status = 2;
							}else{
								$quotation_status = 1;
							}
							$payment = array(
								'customer_id' 		=> $data['quotation_customer'],
								'quotation_id' 		=> $quotation_id,
								'quotation_amount' 	=> $quotation_total,
								'quotation_status' 	=> $quotation_status,
								'updated_on' 		=> created_on(),
								'updated_by' 		=> created_by(),
								'status' 			=> 1
							); 
							//echo "<pre>";print_r($payment);exit;
							$this->common->update('tbl_quotation_payments',$payment,array('quotation_id' => $quotation_id ));
							redirect(base_url('quotation_view/'.$quotation_id));
						}else{
							$payment = array(
								'company_id'		=> $this->session->userdata('company_id'),
								'customer_id' 		=> $data['quotation_customer'],
								'quotation_id' 		=> $quotation_id,
								'quotation_amount' 	=> $quotation_total,
								'quotation_status' 	=> 2,
								'updated_on' 		=> created_on(),
								'updated_by' 		=> created_by(),
								'status' 			=> 1
							);
							$quotation_payment_id = $this->common->update('tbl_quotation_payments',$payment,array('quotation_id' => $quotation_id ));
							if($quotation_payment_id){
								$payment_history = array(
									'company_id'			=> $this->session->userdata('company_id'),
									'customer_id' 			=> $data['quotation_customer'],
									'quotation_payments_id'	=> $quotation_payment_id,
									'quotation_amount' 		=> $quotation_total,
									'paid_amount' 			=> $quotation_total,
									'balance_amount' 		=> 0,
									'payment_type'			=> "cash",
									'payment_date'			=> date('Y-m-d',strtotime($data['quotation_date'])),
									'remarks'				=> "Cash Received",
									'updated_on' 			=> created_on(),
									'updated_by' 			=> created_by(),
									'status' 				=> 1
								);
								$this->common->update('tbl_quotation_payments_history',$payment_history,array('quotation_payments_id' => $quotation_payment_id));
							}
						}
						$log = array(
							'user_id'			=> $this->session->userdata('user_id'),
							'company_id'		=> $this->session->userdata('company_id'),
							'log_category_id'	=> 4,
							'operation'			=> 'Quotation Updated',
							'operation_details'	=> 'Quotation Updated For  -'.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['quotation_customer']),'customer_name'),
							'quotation_id'		=> $quotation_id,
							'logs_status'		=> 0,
							'created_on'		=> created_on(),
							'status'			=> 1
						);
						$log_id = $this->common->insert('tbl_logs',$log);
					}
				}else{
					$message = array(
						'result' 	=> 'failed',
						'message' 	=> 'Quotation Updated failed',
					);
					$this->session->set_userdata('msg',$message);
					redirect(base_url('quotation_list'));
				}
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Product adding to quotation failed',
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('quotation_list'));
		}else{
			$data = $this->quotation->get_quotation_details($quotation_id);
			$this->add_temp_quotation($data['relations']);
			$data['temp_products'] = $this->get_quotation_temp_listings();
			$data['customers'] 	= convert_options_selected($this->common->gets_array('mst_customers',array('status' =>1)),'customer_id','customer_name','CUSTOMER',$data['quotation_details']['quotation_customer']);
			$data['employees'] 	= convert_options_selected($this->common->gets_array('mst_users',array('status' =>1)),'user_id','username','EMPLOYEE',$data['quotation_details']['quotation_employee']);
		//echo "<pre>";print_r($data);exit;
			$this->template->build('quotation/quotation',$data);
		}
	}
	private function get_quotation_temp_listings(){
		$data['lists'] = $this->quotation->get_quotation_temp_listings();
		if($data['lists']){
			$lists = $this->load->view('quotation/includes/temp_listing', $data, TRUE);
		}else{
			$lists ='<tr>
			<td colspan="9">NO PRODUCTS ADDED</td>
			</tr>';
		}
		return $lists;
	}
	public function quotation_calculation(){
		$data = $this->input->post();
	//echo "<pre>";print_r($data);exit;
		if($data){
			$data['amount'] = $data['product_quantity'] * $data['product_rate'];
		}
		$data['result'] = "success";
		echo json_encode($data);
	}
//ADD TEMPRORY PURCHASE ORDER
	public function add_temprory_quotation(){
		$data = $this->input->post();
		$new_quotation_temp = array(
			'product_id'			=> $data['product_id'],
			'company_id'			=> $this->session->userdata('company_id'),
			'quantity'				=> $data['quantity'],
			'rate'					=> $data['rate'],
			'total'					=> $data['amount'],
			'created_on'			=> created_on(),
			'created_by'			=> created_by(),
			'status'				=> 1
		);
		$quotation_relation_temp_id = $this->common->insert('tbl_quotations_relation_temp',$new_quotation_temp);
		if($quotation_relation_temp_id){
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
		$data['lists'] = $this->quotation->get_temp_listings();
	//echo "<pre>";print_r($data);exit;
		$content = $this->load->view('quotation/includes/temp_listing', $data, TRUE);
		return $content;
	}
//REMOVE TEMPRORY PURCHASE ORDER
	public function remove_temp_quotation(){
		$quotation_temp_id = $this->input->post('quotation_temp_id');
		if($quotation_temp_id!=''){
			$temp_details = $this->common->get_array('tbl_quotations_relation_temp',array('quotation_relation_temp_id' => $quotation_temp_id ));
			$remove = $this->common->remove('tbl_quotations_relation_temp',array('quotation_relation_temp_id' => $quotation_temp_id ));
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
	public function quotation_view($quotation_id){
		$data = $this->quotation->get_quotation_details($quotation_id);
		$this->template->build('quotation/quotation_view',$data);
	}
	public function quotation_print($quotation_id){
		$data = $this->quotation->get_quotation_details($quotation_id);
	//echo "<pre>";print_r($data);exit;
		$html = $this->load->view('quotation/quotation_print',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output('QUOTATION_PRINT.pdf','I');
	}
	public function quotation_download($quotation_id){
		$data = $this->quotation->get_quotation_details($quotation_id);
		$html = $this->load->view('quotation/quotation_print',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output('QUOTATION.pdf','D');
	}
	private function add_temp_quotation($rows){
		$this->common->remove('tbl_quotations_relation_temp',array('company_id' => $this->session->userdata('company_id')));
		foreach ($rows as $key => $row) {
			$stock_id = $this->common->get_particular('tbl_stock',array('product_id' => $row['product_id']),'stock_id');
			$temp = array(
				'company_id'			=> $this->session->userdata('company_id'),
				'product_id'			=> $row['product_id'],
				'stock_id'				=> $stock_id,
				'quantity'				=> $row['quantity'],
				'rate'					=> $row['rate'],
				'total'					=> $row['total'],
				'created_on'			=> created_on(),
				'created_by'			=> created_by(),
				'status'				=> 1
			);
		//echo "<pre>";print_r($temp);exit;
			$insert_id = $this->common->insert('tbl_quotations_relation_temp',$temp);
		}
	}
	private function increase_quotation_stock($quotation_id){
		$data = $this->quotation->get_quotation_details($quotation_id);
		if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_stock_reduce'),'quotation_settings_value')== 1){
			if($data['relations']){
				foreach ($data['relations'] as $key => $relation) {
					$stock = array(
						'product_id'		=>	$relation['product_id'],
						'quantity'			=>	$relation['quantity'],
					);
					$this->quotation->increase_stock($stock);
				}
				$status = array('status' => 0 );
				$this->common->update('tbl_quotations_relation',$status,array('quotation_id' => $quotation_id ));
			}else{
				return false;
			}
		}
	}

	public function qt_generate_dc($quotation_id){
		$data = $this->quotation->get_quotation_details($quotation_id);
		//echo "<pre>";print_r($data);//exit;
		$dc_number = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'dc_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'dc_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
		if($data){
			$dc = array(
				'company_id'			=> $data['quotation_details']['company_id'],
				'quotation_id'			=> $quotation_id,
				'dc_number'				=> $dc_number,
				'dc_date'				=> date('Y-m-d'),
				'dc_customer'			=> $data['quotation_details']['quotation_customer'],
				'transport_vechile_no'	=> $data['quotation_details']['transport_vechile_no'],
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
					//echo "<pre>";print_r($dc_relation);exit;
					$dc_relation_id  = $this->common->insert('tbl_dcs_relation',$dc_relation);
					//STOCK REDUCE
					$stock = array(
						'product_id'		=>	$relation['product_id'],
						'quantity'			=>	$relation['quantity'],
					);
					$this->quotation->reduce_stock($stock);
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
				$quotation_update_status = $this->common->update('tbl_quotations',$update,array('quotation_id' => $quotation_id ));
				//IF DC GENERATE THEN STATUS UPDATE
				// $update = array(
				// 	'updated_on'	=> created_on(),
				// 	'updated_by'	=> created_by(),
				// 	'status'		=> 2,
				// 	'dc_status'		=> 2
				// );
				// $dc_update_status = $this->common->update('tbl_dcs',$update,array('dc_id' => $dc_id ));
				$message = array(
					'result' => 'success',
					'message' => 'Dc generated successfully'
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('quotation_view/'.$quotation_id));
			}else{
				$message = array(
					'result'	=> 'failed',
					'message'	=> 'Dc generation failed'
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('quotation_list'));
			}
		}
	}
	public function check_product_qty(){
		$data = $this->input->post();
		if($data['product_id']!=""){
			$product_id 		= $data['product_id'];
			$product_qty 		= $data['product_qty'];
			$product_qty_check 	= $this->quotation->check_product_qty($product_id,$product_qty);
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
	}
//QUOTATION PAYMENT LIST
	public function quotation_payment_list(){
		$data['lists'] = $this->quotation->get_quotation_payment_list();
	//echo "<pre>";print_r($data);exit;
		$this->template->build('payments/quotation/quotation_payment_list',$data);
	}
	public function quotation_payments_bill_details($quotation_payments_id){
		$data['payment'] = $this->quotation->get_quotation_detail_bills($quotation_payments_id);
	//echo "<pre>";print_r($data);exit;
		$this->template->build('payments/quotation/quotation_payments',$data);
	}
//ADD QUOTATION BILL PAYMENTS
	public function add_quotation_payment_bills(){
		$data = $this->input->post();
	//echo "<pre>";print_r($data);exit;
		$insert = array(
			'quotation_payments_id' => $data['quotation_payments_id'],
			'company_id'			=> $this->session->userdata('company_id'),
			'customer_id'			=> $data['customer_id'],
			'quotation_amount' 		=> $data['quotation_amount'],
			'paid_amount' 			=> $data['paid_amount'],
			'balance_amount'		=> $data['balance_amount']-$data['paid_amount'],
			'payment_type' 			=> $data['payment_type'],
			'cheque_no' 			=> $data['cheque_number'],
			'bank_name' 			=> $data['bank_name'],
			'payment_date' 			=> date('Y-m-d',strtotime($data['payment_date'])),
			'remarks' 				=> $data['remark'],
			'created_on' 			=> created_on(),
			'created_by' 			=> created_by(),
			'status'				=> 1
		);
		$insert_result = $this->common->insert('tbl_quotation_payments_history',$insert);
		if($insert_result){
			$update = array('quotation_status' => 1 );
			$this->common->update('tbl_quotation_payments',$update,array('quotation_payments_id' => $data['quotation_payments_id'] ));
			$message = array(
				'result' => 'success',
				'message' => 'Payment Added successfully',
			);
			if($data['balance_amount'] == $data['paid_amount']){
				$update = array('quotation_status' => 2 );
				$this->common->update('tbl_quotation_payments',$update,array('quotation_payments_id' => $data['quotation_payments_id'] ));
			}
		}else{
			$message = array(
				'result' => 'failed',
				'message' => 'Adding Payment Failed',
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('quotation_payments_bill_details/'.$data['quotation_payments_id']));
	}
	public function quotation_remove($quotation_id){
		$update = array(
			'updated_on' 		=> created_on(),
			'updated_by' 		=> created_by(),
			'status' 			=> 0 ,
			'quotation_cancel' 	=> 1
		);
		$delete_result = $this->common->delete('tbl_quotations',$update,array('quotation_id' => $quotation_id ));
		if($delete_result){
			if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_stock_reduce'),'quotation_settings_value')== 1){
				$stock_reduced = $this->common->gets_array('tbl_quotations_relation',array('quotation_id' => $quotation_id,'status' => 1 ));
				if($stock_reduced){
					foreach ($stock_reduced as $key => $stock_reduce) {
						$stock = array(
							'product_id'				=>	$stock_reduce['product_id'],
							'quantity'					=>	$stock_reduce['quantity'],
						);
						//echo "<pre>";print_r($stock);exit;
						$this->quotation->increase_stock($stock);
					}
				}
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $this->session->userdata('company_id'),
					'log_category_id'	=> 4,
					'operation'			=> 'Quotation Deleted',
					'operation_details'	=> 'Quotation Deleted For  -'.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['quotation_customer']),'customer_name'),
					'quotation_id'		=> $quotation_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'Quotation removed successfully',
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('quotation_list'));
			}
			if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_dc_generate'),'quotation_settings_value'))== 1){
	$update_dc = array(
		'updated_on' 	=> created_on(),
		'updated_by' 	=> created_by(),
		'status' 		=> 0 ,
		'dc_cancel' 	=> 1
	);
	$dc_delete_result = $this->common->delete('tbl_dcs',$update_dc,array('quotation_id' => $quotation_id ));
	if($dc_delete_result){
		$data = $this->quotation->get_quotation_details($quotation_id);
		if($data['relations']){
			foreach ($data['relations'] as $key => $relation) {
				$stock = array(
					'product_id'		=>	$relation['product_id'],
					'quantity'			=>	$relation['quantity'],
				);
				$this->quotation->increase_stock($stock);
			}
			$status = array('status' => 0 );
			$this->common->update('tbl_quotations_relation',$status,array('quotation_id' => $quotation_id ));
		}
		$message = array(
			'result' 	=> 'success',
			'message' 	=> 'Quotation removed successfully',
		);
		$this->session->set_userdata('msg',$message);
		redirect(base_url('quotation_list'));
	}
}
}else{
	$message = array(
		'result' 	=> 'failed',
		'message' 	=> 'Quotation Removing failed',
	);
}
$this->session->set_userdata('msg',$message);
redirect(base_url('quotation_list'));
}
}
/* End of file Quotation.php */
/* Location: ./application/app/controllers/Quotation.php */