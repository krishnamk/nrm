<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Sales_return extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Sales_return_model','sales_return');
		$this->load->model('User_model','user');
		if(!$this->session->userdata('invoice_logged_in')){
			redirect('login','refresh');
		}
	}
	public function get_sales_bills(){
		$data = $this->input->post();
		$sales_return['sales_bills'] = convert_options($this->common->gets_array_orderby('tbl_invoices',array('invoice_customer' => $data['customer_id'],'sales_return_status' => 0),'invoice_id','desc'),'invoice_id','invoice_number','SALES BILL NUMBER');
		echo json_encode($sales_return);
	}
	public function get_sales_products(){
		$data = $this->input->post();
		$data = $this->sales_return->get_invoice_product_details($data['invoice_id']);
		$content = $this->load->view('sales_return/sales_return_products', $data, TRUE);
		echo $content;
	}
	public function sales_return(){
		if($this->input->post()){
			$data = $this->input->post();
			//echo '<pre>';print_r($data);//exit;
			if(isset($data['invoice_relation_id'])){
				if(isset($data['completed'])){
					$sales_return = array(
						'sales_return_number'		=> $data['sales_return_number'],
						'company_id'				=> $data['company_id'],
						'sales_return_date'			=> $data['sales_return_date'],
						'sales_return_customer'		=> $data['sales_return_customer'],
						'sales_return_invoice_id'	=> $data['sales_return_invoice_id'],
						'sales_return_remarks'		=> $data['sales_return_remarks'],
						'created_on'				=> created_on(),
						'created_by'				=> created_by(),
						'status'					=> 1
					);
					$sales_return_id = $this->common->insert('tbl_sales_return',$sales_return);
					if($sales_return_id){
						foreach ($data['invoice_relation_id'] as $key => $invoice_relation_id) {
							$sales_relation_detail = $this->common->get_array('tbl_invoices_relation',array( 'invoice_relation_id' => $invoice_relation_id ));
							$sales_return_relation = array(
								'sales_return_id'		=> $sales_return_id,
								'invoice_relation_id'	=> $invoice_relation_id,
								'product_id'			=> $sales_relation_detail['product_id'],
								'product_name'			=> $sales_relation_detail['product_name'],
								'brand_id'				=> $this->session->userdata('company_id'),
								'brand_name'			=> $sales_relation_detail['brand_name'],
								'category_id'			=> $this->common->get_particular('mst_category',array('category_name' => $sales_relation_detail['category_name']),'category_id'),
								'category_name'			=> $sales_relation_detail['category_name'],
								'subcategory_id'		=> $this->common->get_particular('mst_subcategory',array('sub_category_name' => $sales_relation_detail['subcategory_name']),'sub_category_id'),
								'subcategory_name'		=> $sales_relation_detail['subcategory_name'],
								'tax_id'				=> $this->common->get_particular('mst_taxs',array('tax_percentage' => $sales_relation_detail['tax_percent']),'tax_id'),
								'tax_percentage'		=> $sales_relation_detail['tax_percent'],
								'current_quantity'		=> $data['current_quantity'][$key],
								'return_quantity'		=> $data['return_quantity'][$key],
								'balance_quantity'		=> $data['current_quantity'][$key]-$data['return_quantity'][$key],
								'rate'					=> $sales_relation_detail['rate'],
								'total'					=> $sales_relation_detail['rate']*$data['return_quantity'][$key],
								'created_on'			=> created_on(),
								'created_by'			=> created_by(),
								'status'				=> 1
							);
							$sales_return_relation_id = $this->common->insert('tbl_sales_return_relations',$sales_return_relation);
							//SALES RETURN PRODUCT SINGLE TIMES RETURN 
							$this->common->update('tbl_invoices_relation',array('sales_return_product_status' => 2),array('invoice_relation_id' => $invoice_relation_id));
							if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'sales_return_stock_added'),'invoice_settings_value') == 1) {
								$increase_stock = array(
									'product_id'	=> $sales_relation_detail['product_id'],
									'quantity'		=> $data['return_quantity'][$key],
								);
								$this->sales_return->increase_stock($increase_stock);
							}
						}
						//SALES RETURN INVOICE SINGLE TIMES RETURN 
						$this->common->update('tbl_invoices',array('sales_return_status' => 2),array('invoice_id' => $data['sales_return_invoice_id']));
						$message = array(
							'result' => 'success',
							'message' => 'sales Return Created Successfully'
						);
						$this->session->set_userdata('msg',$message);
						redirect(base_url('sales_return_view/'.$sales_return_id));
					}
				}else{
					$sales_return = array(
						'sales_return_number'		=> $data['sales_return_number'],
						'company_id'				=> $data['company_id'],
						'sales_return_date'			=> $data['sales_return_date'],
						'sales_return_customer'		=> $data['sales_return_customer'],
						'sales_return_invoice_id'	=> $data['sales_return_invoice_id'],
						'sales_return_remarks'		=> $data['sales_return_remarks'],
						'created_on'				=> created_on(),
						'created_by'				=> created_by(),
						'status'					=> 1
					);
					//echo '<pre>';print_r($sales_return);//exit;
					$sales_return_id = $this->common->insert('tbl_sales_return',$sales_return);
					if($sales_return_id){
						foreach ($data['invoice_relation_id'] as $key => $invoice_relation_id) {
							$sales_relation_detail = $this->common->get_array('tbl_invoices_relation',array( 'invoice_relation_id' => $invoice_relation_id ));
							//echo '<pre>';print_r($sales_relation_detail);exit;
							$sales_return_relation = array(
								'sales_return_id'		=> $sales_return_id,
								'invoice_relation_id'	=> $invoice_relation_id,
								'product_id'			=> $sales_relation_detail['product_id'],
								'product_name'			=> $sales_relation_detail['product_name'],
								'brand_id'				=> $this->session->userdata('company_id'),
								'brand_name'			=> $sales_relation_detail['brand_name'],
								'category_id'			=> $this->common->get_particular('mst_category',array('category_name' => $sales_relation_detail['category_name']),'category_id'),
								'category_name'			=> $sales_relation_detail['category_name'],
								'subcategory_id'		=> $this->common->get_particular('mst_subcategory',array('sub_category_name' => $sales_relation_detail['subcategory_name']),'sub_category_id'),
								'subcategory_name'		=> $sales_relation_detail['subcategory_name'],
								'tax_id'				=> $this->common->get_particular('mst_taxs',array('tax_percentage' => $sales_relation_detail['tax_percent']),'tax_id'),
								'tax_percentage'		=> $sales_relation_detail['tax_percent'],
								'current_quantity'		=> $data['current_quantity'][$key],
								'return_quantity'		=> $data['return_quantity'][$key],
								'balance_quantity'		=> $data['current_quantity'][$key]-$data['return_quantity'][$key],
								'rate'					=> $sales_relation_detail['rate'],
								'total'					=> $sales_relation_detail['rate']*$data['return_quantity'][$key],
								'created_on'			=> created_on(),
								'created_by'			=> created_by(),
								'status'				=> 1
							);
							//echo '<pre>';print_r($sales_return_relation);exit;
							$sales_return_relation_id = $this->common->insert('tbl_sales_return_relations',$sales_return_relation);
							//SALES RETURN PRODUCT MULTIPLE TIMES RETURN 
							$this->sales_return->check_sales_return_product_status($invoice_relation_id);
							if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'sales_return_stock_added'),'invoice_settings_value') == 1) {
								$increase_stock = array(
									'product_id'	=> $sales_relation_detail['product_id'],
									'quantity'		=> $data['return_quantity'][$key],
								);
								$this->sales_return->increase_stock($increase_stock);
							}
						}
						//SALES RETURN INVOICE MULTIPLE TIMES RETURN 
						if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'sales_return_invoice_multiple_time_return'),'invoice_settings_value') == 1){
							$this->sales_return->check_sales_return_invoice_status($data['sales_return_invoice_id']);
						}
						$log = array(
							'user_id'			=> $this->session->userdata('user_id'),
							'company_id'		=> $data['company_id'],
							'log_category_id'	=> 5,
							'operation'			=> 'Sales Return Created',
							'operation_details'	=> 'Sales Return Created For  -'.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['sales_return_customer']),'customer_name'),
							'sales_return_id'	=> $sales_return_id,
							'logs_status'		=> 0,
							'created_on'		=> created_on(),
							'status'			=> 1
						);
						$log_id = $this->common->insert('tbl_logs',$log);
						$message = array(
							'result' => 'success',
							'message' => 'sales Return Created Successfully'
						);
						$this->session->set_userdata('msg',$message);
						redirect(base_url('sales_return_view/'.$sales_return_id));
					}
				}
			}else{
				$message = array(
					'result'	=> 'failed',
					'message'	=> 'sales Return Creation failed'
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('sales_return'));
			}
		}else{
			$data['sales_return_number'] = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'sales_return_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'sales_return_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'invoice_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			//COMPANY LIST IF MULTIPLE COMPANY ENABLE
			if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){
				if($this->session->userdata('access_level')==1){
					$data['company_lists'] = array_column($this->user->get_company_list(), 'company_name');
				}elseif($this->session->userdata('access_level')==2){
					$data['company_lists'] = array_column($this->user->get_current_user_companies(), 'company_name');
				}
			}
			$data['customers'] = convert_options($this->common->gets_array('mst_customers',array( 'status' => 1)),'customer_id','customer_name','customer');
			$this->template->build('sales_return/sales_return',$data);
		}
	}
	public function sales_return_list(){
		$data['lists'] = $this->sales_return->get_sales_return_listings();
		$this->template->build('sales_return/sales_return_listing',$data);
	}

	public function check_product_qty(){
		$current_qty = $this->input->post('current_qty');
		$new_qty = $this->input->post('new_qty');
		if($current_qty <= $new_qty){
			//echo "<pre>";print_r("success");exit;
			echo json_encode(array('result' => 'success' ));
		}else{
			//echo "<pre>";print_r("failed");exit;
			echo json_encode(array('result' => 'failed' ));
		}
	}
	public function sales_return_view($sales_return_id){
		$data = $this->sales_return->get_sales_return_details($sales_return_id);
		//echo "<pre>";print_r($data);exit;
		$this->template->build('sales_return/sales_return_view',$data);
	}
	public function sales_return_print($sales_return_id){
		$data = $this->sales_return->get_sales_return_details($sales_return_id);
		$html = $this->load->view('sales_return/sales_return_print',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output('SALES_RETURN_PRINT.pdf','I');
	}
	public function sales_return_download($sales_return_id){
		$data = $this->sales_return->get_sales_return_details($sales_return_id);
		$html = $this->load->view('sales_return/sales_return_print',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output('SALES_RETURN_PRINT.pdf','I');
	}
	public function sales_return_edit($sales_return_id){
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);//exit;
			if(isset($data['invoice_relation_id'])){
				$sales_return_update = array(
					'sales_return_number'		=> $data['sales_return_number'],
					'company_id'					=> $this->session->userdata('company_id'),
					'sales_return_date'			=> $data['sales_return_date'],
					'sales_return_customer'		=> $data['sales_return_customer'],
					'sales_return_invoice_id'	=> $data['sales_return_invoice_id'],
					'sales_return_remarks'		=> $data['sales_return_remarks'],
					'updated_on'				=> created_on(),
					'updated_by'				=> created_by(),
					'status'					=> 1
				);
				$sales_return_update_result = $this->common->update('tbl_sales_return',$sales_return_update,array('sales_return_id' => $sales_return_id ));
				if($sales_return_update_result){
					$this->sales_return_existing_products_handle($sales_return_id);
					foreach ($data['invoice_relation_id'] as $key => $invoice_relation_id) {
						$sales_relation_detail = $this->common->get_array('tbl_invoices_relation',array( 'invoice_relation_id' => $invoice_relation_id ));
						//echo "<pre>";print_r($sales_relation_detail);exit;
						$sales_return_relation = array(    
							'sales_return_id'		=> $sales_return_id,
							'invoice_relation_id'	=> $invoice_relation_id,
							'product_id'			=> $sales_relation_detail['product_id'],
							'product_name'			=> $sales_relation_detail['product_name'],
							'brand_id'				=> $this->session->userdata('company_id'),
							'brand_name'			=> $sales_relation_detail['brand_name'],
							'category_id'			=> $this->common->get_particular('mst_category',array('category_name' => $sales_relation_detail['category_name']),'category_id'),
							'category_name'			=> $sales_relation_detail['category_name'],
							'subcategory_id'		=> $this->common->get_particular('mst_subcategory',array('sub_category_name' => $sales_relation_detail['subcategory_name']),'sub_category_id'),
							'subcategory_name'		=> $sales_relation_detail['subcategory_name'],
							'tax_id'				=> $this->common->get_particular('mst_taxs',array('tax_percentage' => $sales_relation_detail['tax_percent']),'tax_id'),
							'tax_percentage'		=> $sales_relation_detail['tax_percent'],
							'return_quantity'		=> $data['return_quantity'][$key],
							'rate'					=> $sales_relation_detail['rate'],
							'total'					=> $sales_relation_detail['rate']*$data['return_quantity'][$key],
							'updated_on'			=> created_on(),
							'updated_by'			=> created_by(),
							'status'				=> 1
						);
						//echo "<pre>";print_r($sales_return_relation);//exit;
						$sales_return_relation_id = $this->common->insert('tbl_sales_return_relations',$sales_return_relation);
						if($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'sales_return_stock_added'),'invoice_settings_value') == 1) {
							$increase_stock = array(
								'product_id'		=> $sales_relation_detail['product_id'],
								'quantity'			=> $data['return_quantity'][$key],
							);
							$this->sales_return->increase_stock($increase_stock);
						}
					}
					$log = array(
						'user_id'			=> $this->session->userdata('user_id'),
						'company_id'			=> $this->session->userdata('company_id'),
						'log_category_id'	=> 5,
						'operation'			=> 'Sales Return Updated',
						'operation_details'	=> 'Sales Return Updated For -'.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['sales_return_customer']),'customer_name'),
						'sales_return_id'	=> $sales_return_id,
						'logs_status'		=> 0,
						'created_on'		=> created_on(),
						'status'			=> 1
					);
					$log_id = $this->common->insert('tbl_logs',$log);
					$message = array(
						'result' => 'success',
						'message' => 'sales Return Updated Successfully'
					);
					$this->session->set_userdata('msg',$message);
					redirect(base_url('sales_return_view/'.$sales_return_id));
				}else{
					$message = array(
						'result'	=> 'failed',
						'message'	=> 'sales Return Update failed'
					);
					$this->session->set_userdata('msg',$message);
					redirect(base_url('sales_return_list'));
				}
			}else{
				$message = array(
					'result'	=> 'failed',
					'message'	=> 'No Products Selected To Return'
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('sales_return_list'));
			}
		}else{
			$data['sales_return_details'] = $this->common->get_array('tbl_sales_return',array('sales_return_id' => $sales_return_id));
			$data['customers'] = convert_options_selected($this->common->gets_array('mst_customers',array( 'status' => 1)),'customer_id','customer_name','customer',$data['sales_return_details']['sales_return_customer']);
			$data['sales_bills'] = convert_options_selected($this->common->gets_array_orderby('tbl_invoices',array('invoice_customer' => $data['sales_return_details']['sales_return_customer']),'invoice_id','desc'),'invoice_id','invoice_number','sales BILL NUMBER',$data['sales_return_details']['sales_return_invoice_id']);
			$data['relations']	= $this->sales_return->get_sales_return_relations($sales_return_id);
			//echo "<pre>";print_r($data);exit;
			$data['company_lists'] 	= convert_options_selected($this->common->gets_array('company_details',array('company_status' =>1,'company_id' => $data['sales_return_details']['company_id'])),'company_id','company_name','COMPANY',$data['sales_return_details']['company_id']);
			$data['listings'] = $this->load->view('sales_return/sales_return_products', $data, TRUE);;
			$this->template->build('sales_return/sales_return',$data);
		}
	}
	private function sales_return_existing_products_handle($sales_return_id){
		$relations = $this->common->gets_array('tbl_sales_return_relations',array('sales_return_id' => $sales_return_id, 'status' => 1 ));
		if($relations){
			foreach ($relations as $key => $relation){
				$reduce_stock = array(
					'product_id'			=> $relation['product_id'],
					'quantity'				=> $relation['return_quantity'],
				);
				//echo "<pre>";print_r($reduce_stock);exit;
				$this->sales_return->reduce_stock($reduce_stock);
			}
			$update = array(
				'status' => 0
			);
			$update_result = $this->common->update('tbl_sales_return_relations',$update,array('sales_return_id' => $sales_return_id));
		}
	}
	public function sales_return_delete($sales_return_id){
		$update = array(
			'status'		=> 0,
			'updated_on'   => created_on(),
			'updated_by'   => created_by()
		);
		$update_result = $this->common->update('tbl_sales_return',$update,array('sales_return_id' => $sales_return_id));
		if($update_result){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'company_id'			=> $this->session->userdata('company_id'),
				'log_category_id'	=> 5,
				'operation'			=> 'Sales Return Deleted',
				'operation_details'	=> 'Sales Return Deleted For -'.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['sales_return_customer']),'customer_name'),
				'sales_return_id'	=> $sales_return_id,
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => 'sales Return Removed Successfully'
			);
		}else{
			$message = array(
				'result' => 'failed',
				'message' => 'sales Return Remove Failed'
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('sales_return_list'));
	}

	public function sales_return_status_change($sales_return_id){
		$update = $this->common->update('tbl_sales_return',array('status' => 2),array('sales_return_id' => $sales_return_id));
		if($update){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'company_id'			=> $this->session->userdata('company_id'),
				'log_category_id'	=> 5,
				'operation'			=> 'Sales Return Status Change to Completed',
				'operation_details'	=> 'Sales Return Status Completed By -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				'sales_return_id'	=> $sales_return_id,
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => 'Sales Return Mark as to Completed'
			);
		}else{
			$message = array(
				'result' => 'failed',
				'message' => 'Sales Return Mark as to Completed Status Failed'
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('sales_return_list'));
	}
}