<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchase_return extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Purchase_return_model','purchase_return');
		$this->load->model('User_model','user');
		if(!$this->session->userdata('invoice_logged_in')){
			redirect('login','refresh');
		}
	}
	public function get_purchase_bills(){
		$data = $this->input->post();
		$purchase_return['purchase_bills'] = convert_options($this->common->gets_array_orderby('tbl_purchase',array('purchase_supplier' => $data['supplier_id'],'purchase_return_status' => 0),'purchase_id','desc'),'purchase_id','purchase_number','PURCHASE BILL NUMBER');
		echo json_encode($purchase_return);
	}
	public function get_purchase_products(){
		$data = $this->input->post();
		$data = $this->purchase_return->get_purchase_product_details($data['purchase_id']);
	//echo "<pre>";print_r($data);exit;
		$content = $this->load->view('purchase_return/purchase_return_products', $data,TRUE);
		echo $content;
	}
	public function purchase_return(){
		if($this->input->post()){
			$data = $this->input->post();
		//echo '<pre>';print_r($data);exit;
			if(isset($data['purchase_relation_id'])){
				if(isset($data['completed'])){
					$purchase_return = array(
						'purchase_return_number'		=> $data['purchase_return_number'],
						'company_id'				    => $data['company_id'],
						'purchase_return_date'			=> $data['purchase_return_date'],
						'purchase_return_supplier'		=> $data['purchase_return_supplier'],
						'purchase_return_purchase_id'	=> $data['purchase_return_purchase_id'],
						'purchase_return_remarks'		=> $data['purchase_return_remarks'],
						'created_on'					=> created_on(),
						'created_by'					=> created_by(),
						'status'						=> 1
					);
					$purchase_return_id = $this->common->insert('tbl_purchase_return',$purchase_return);
					if($purchase_return_id){
						foreach ($data['purchase_relation_id'] as $key => $purchase_relation_id) {
							$purchase_relation_detail = $this->common->get_array('tbl_purchase_relations',array( 'purchase_relation_id' => $purchase_relation_id ));
							$purchase_return_relation = array(
								'purchase_return_id'	=> $purchase_return_id,
								'purchase_relation_id'	=> $purchase_relation_id,
								'product_id'			=> $purchase_relation_detail['product_id'],
								'product_name'			=> $purchase_relation_detail['product_name'],
								'tax_id'				=> $this->common->get_particular('mst_taxs',array('tax_percentage' => $purchase_relation_detail['tax_percent']),'tax_id'),
								'tax_percentage'		=> $purchase_relation_detail['tax_percent'],
								'current_quantity'		=> $data['current_quantity'][$key],
								'return_quantity'		=> $data['return_quantity'][$key],
								'balance_quantity'		=> $data['current_quantity'][$key]-$data['return_quantity'][$key],
								'rate'					=> $purchase_relation_detail['rate'],
								'total'					=> $purchase_relation_detail['rate']*$data['return_quantity'][$key],
								'created_on'			=> created_on(),
								'created_by'			=> created_by(),
								'status'				=> 1
							);
							if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
								$purchase_return_relation['brand_id'] = $purchase_relation_detail['brand_id'];
								$purchase_return_relation['brand_id'] = $purchase_relation_detail['brand_id'];
							}
							if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
								$purchase_return_relation['category_id'] = $this->common->get_particular('mst_category',array('category_name' => $purchase_relation_detail['category_name']),'category_id');
								$purchase_return_relation['category_name'] = $purchase_relation_detail['category_name'];
							}
							if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){
								$purchase_return_relation['subcategory_id'] = $this->common->get_particular('mst_subcategory',array('sub_category_name' => $purchase_relation_detail['subcategory_name']),'sub_category_id');
								$purchase_return_relation['subcategory_name'] = $purchase_relation_detail['subcategory_name'];
							}
							$purchase_return_relation_id = $this->common->insert('tbl_purchase_return_relations',$purchase_return_relation);
						//purchase RETURN PRODUCT SINGLE TIMES RETURN 
							$this->common->update('tbl_purchase_relations',array('purchase_return_product_status' => 2),array('purchase_relation_id' => $purchase_relation_id));
							if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_return_stock_added'),'purchase_settings_value') == 1) {
								$reduce_stock = array(
									'product_id'	=> $purchase_relation_detail['product_id'],
									'quantity'		=> $data['return_quantity'][$key],
								);
								$this->purchase_return->reduce_stock($reduce_stock);
							}
						}
					//purchase RETURN purchase SINGLE TIMES RETURN 
						$this->common->update('tbl_purchase',array('purchase_return_status' => 2),array('purchase_id' => $data['purchase_return_purchase_id']));
						$message = array(
							'result' => 'success',
							'message' => 'purchase Return Created Successfully'
						);
						$this->session->set_userdata('msg',$message);
						redirect(base_url('purchase_return_view/'.$purchase_return_id));
					}
				}else{
					$purchase_return = array(
						'purchase_return_number'		=> $data['purchase_return_number'],
						'company_id'				    => $data['company_id'],
						'purchase_return_date'			=> $data['purchase_return_date'],
						'purchase_return_supplier'		=> $data['purchase_return_supplier'],
						'purchase_return_purchase_id'	=> $data['purchase_return_purchase_id'],
						'purchase_return_remarks'		=> $data['purchase_return_remarks'],
						'created_on'				=> created_on(),
						'created_by'				=> created_by(),
						'status'					=> 1
					);
				//echo '<pre>';print_r($purchase_return);//exit;
					$purchase_return_id = $this->common->insert('tbl_purchase_return',$purchase_return);
					if($purchase_return_id){
						foreach ($data['purchase_relation_id'] as $key => $purchase_relation_id) {
							$purchase_relation_detail = $this->common->get_array('tbl_purchase_relations',array( 'purchase_relation_id' => $purchase_relation_id ));
						//echo '<pre>';print_r($purchase_relation_detail);exit;
							$purchase_return_relation = array(
								'purchase_return_id'	=> $purchase_return_id,
								'purchase_relation_id'	=> $purchase_relation_id,
								'product_id'			=> $purchase_relation_detail['product_id'],
								'product_name'			=> $purchase_relation_detail['product_name'],
								'tax_id'				=> $this->common->get_particular('mst_taxs',array('tax_percentage' => $purchase_relation_detail['tax_percent']),'tax_id'),
								'tax_percentage'		=> $purchase_relation_detail['tax_percent'],
								'current_quantity'		=> $data['current_quantity'][$key],
								'return_quantity'		=> $data['return_quantity'][$key],
								'balance_quantity'		=> $data['current_quantity'][$key]-$data['return_quantity'][$key],
								'rate'					=> $purchase_relation_detail['rate'],
								'total'					=> $purchase_relation_detail['rate']*$data['return_quantity'][$key],
								'created_on'			=> created_on(),
								'created_by'			=> created_by(),
								'status'				=> 1
							);
							if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
								$purchase_return_relation['brand_id'] = $purchase_relation_detail['brand_id'];
								$purchase_return_relation['brand_id'] = $purchase_relation_detail['brand_id'];
							}
							if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
								$purchase_return_relation['category_id'] = $this->common->get_particular('mst_category',array('category_name' => $purchase_relation_detail['category_name']),'category_id');
								$purchase_return_relation['category_name'] = $purchase_relation_detail['category_name'];
							}
							if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){
								$purchase_return_relation['subcategory_id'] = $this->common->get_particular('mst_subcategory',array('sub_category_name' => $purchase_relation_detail['subcategory_name']),'sub_category_id');
								$purchase_return_relation['subcategory_name'] = $purchase_relation_detail['subcategory_name'];
							}
						//echo '<pre>';print_r($purchase_return_relation);exit;
							$purchase_return_relation_id = $this->common->insert('tbl_purchase_return_relations',$purchase_return_relation);
						//purchase RETURN PRODUCT MULTIPLE TIMES RETURN 
							$this->purchase_return->check_purchase_return_product_status($purchase_relation_id);
							if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_return_stock_added'),'purchase_settings_value') == 1) {
								$reduce_stock = array(
									'product_id'	=> $purchase_relation_detail['product_id'],
									'quantity'		=> $data['return_quantity'][$key],
								);
								$this->purchase_return->reduce_stock($reduce_stock);
							}
						}
					//purchase RETURN purchase MULTIPLE TIMES RETURN 
						if($this->common->get_particular('mst_settings',array('settings_name' => 'purchase_return_purchase_multiple_time_return'),'settings_value') == 1){
							$this->purchase_return->check_purchase_return_purchase_status($data['purchase_return_purchase_id']);
						}
						$log = array(
							'user_id'			=> $this->session->userdata('user_id'),
							'company_id'		=> $data['company_id'],
							'log_category_id'	=> 9,
							'operation'			=> 'Purchase Return Created',
							'operation_details'	=> 'Purchase Return Created For -'.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $data['purchase_return_supplier']),'supplier_name'),
							'purchase_return_id'=> $purchase_return_id,
							'logs_status'		=> 0,
							'created_on'		=> created_on(),
							'status'			=> 1
						);
						$log_id = $this->common->insert('tbl_logs',$log);
						$message = array(
							'result' => 'success',
							'message' => 'purchase Return Created Successfully'
						);
						$this->session->set_userdata('msg',$message);
						redirect(base_url('purchase_return_view/'.$purchase_return_id));
					}
				}
			}else{
				$message = array(
					'result'	=> 'failed',
					'message'	=> 'purchase Return Creation failed'
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('purchase_return'));
			}
		}else{
			$data['purchase_return_number'] = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'purchase_return_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'purchase_return_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'purchase_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			$data['suppliers'] = convert_options($this->common->gets_array('mst_suppliers',array( 'status' => 1)),'supplier_id','supplier_name','supplier');
		//COMPANY LIST IF MULTIPLE COMPANY ENABLE
			if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){
				if($this->session->userdata('access_level')==1){
					$data['company_lists'] = array_column($this->user->get_company_list(), 'company_name');
				}elseif($this->session->userdata('access_level')==2){
					$data['company_lists'] = array_column($this->user->get_current_user_companies(), 'company_name');
				}
			}
			$this->template->build('purchase_return/purchase_return',$data);
		}
	}
	public function purchase_return_list(){
		$data['lists'] = $this->purchase_return->get_purchase_return_listings();
		$this->template->build('purchase_return/purchase_return_listing',$data);
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
	public function purchase_return_view($purchase_return_id){
		$data = $this->purchase_return->get_purchase_return_details($purchase_return_id);
	//echo "<pre>";print_r($data);exit;
		$this->template->build('purchase_return/purchase_return_view',$data);
	}
	public function purchase_return_print($purchase_return_id){
		$data = $this->purchase_return->get_purchase_return_details($purchase_return_id);
		$html = $this->load->view('purchase_return/purchase_return_print',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output('purchase_RETURN_PRINT.pdf','I');
	}
	public function purchase_return_download($purchase_return_id){
		$data = $this->purchase_return->get_purchase_return_details($purchase_return_id);
		$html = $this->load->view('purchase_return/purchase_return_print',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output('purchase_RETURN_PRINT.pdf','I');
	}
	public function purchase_return_edit($purchase_return_id){
		if($this->input->post()){
			$data = $this->input->post();
		//echo "<pre>";print_r($data);//exit;
			if(isset($data['purchase_relation_id'])){
				$purchase_return_update = array(
					'purchase_return_number'		=> $data['purchase_return_number'],
					'company_id'					=> $data['company_id'],
					'purchase_return_date'			=> $data['purchase_return_date'],
					'purchase_return_supplier'		=> $data['purchase_return_supplier'],
					'purchase_return_purchase_id'	=> $data['purchase_return_purchase_id'],
					'purchase_return_remarks'		=> $data['purchase_return_remarks'],
					'updated_on'					=> created_on(),
					'updated_by'					=> created_by(),
					'status'						=> 1
				);
				$purchase_return_update_result = $this->common->update('tbl_purchase_return',$purchase_return_update,array('purchase_return_id' => $purchase_return_id ));
				if($purchase_return_update_result){
					$this->purchase_return_existing_products_handle($purchase_return_id);
					foreach ($data['purchase_relation_id'] as $key => $purchase_relation_id) {
						$purchase_relation_detail = $this->common->get_array('tbl_purchase_relations',array( 'purchase_relation_id' => $purchase_relation_id ));
					//echo "<pre>";print_r($purchase_relation_detail);exit;
						$purchase_return_relation = array(    
							'purchase_return_id'	=> $purchase_return_id,
							'purchase_relation_id'	=> $purchase_relation_id,
							'product_id'			=> $purchase_relation_detail['product_id'],
							'product_name'			=> $purchase_relation_detail['product_name'],
							'tax_id'				=> $this->common->get_particular('mst_taxs',array('tax_percentage' => $purchase_relation_detail['tax_percent']),'tax_id'),
							'tax_percentage'		=> $purchase_relation_detail['tax_percent'],
							'return_quantity'		=> $data['return_quantity'][$key],
							'rate'					=> $purchase_relation_detail['rate'],
							'total'					=> $purchase_relation_detail['rate']*$data['return_quantity'][$key],
							'updated_on'			=> created_on(),
							'updated_by'			=> created_by(),
							'status'				=> 1
						);
						if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
							$purchase_return_relation['brand_id'] = $purchase_relation_detail['brand_id'];
							$purchase_return_relation['brand_name'] = $purchase_relation_detail['brand_name'];
						}
						if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
							$purchase_return_relation['category_id'] = $this->common->get_particular('mst_category',array('category_name' => $purchase_relation_detail['category_name']),'category_id');
							$purchase_return_relation['category_name'] = $purchase_relation_detail['category_name'];
						}
						if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){
							$purchase_return_relation['subcategory_id'] = $this->common->get_particular('mst_subcategory',array('sub_category_name' => $purchase_relation_detail['subcategory_name']),'sub_category_id');
							$purchase_return_relation['subcategory_name'] = $purchase_relation_detail['subcategory_name'];
						}
					//echo "<pre>";print_r($purchase_return_relation);exit;
						$purchase_return_relation_id = $this->common->insert('tbl_purchase_return_relations',$purchase_return_relation);
						if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_return_stock_added'),'purchase_settings_value') == 1) {
							$reduce_stock = array(
								'product_id'		=> $purchase_relation_detail['product_id'],
								'quantity'			=> $data['return_quantity'][$key],
							);
							$this->purchase_return->reduce_stock($reduce_stock);
						}
					}
					$log = array(
						'user_id'			=> $this->session->userdata('user_id'),
						'company_id'		=> $data['company_id'],
						'log_category_id'	=> 9,
						'operation'			=> 'Purchase Return Updated',
						'operation_details'	=> 'Purchase Return Updated For -'.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $data['purchase_return_supplier']),'supplier_name'),
						'purchase_return_id'=> $purchase_return_id,
						'logs_status'		=> 0,
						'created_on'		=> created_on(),
						'status'			=> 1
					);
					$log_id = $this->common->insert('tbl_logs',$log);
					$message = array(
						'result' => 'success',
						'message' => 'purchase Return Updated Successfully'
					);
					$this->session->set_userdata('msg',$message);
					redirect(base_url('purchase_return_view/'.$purchase_return_id));
				}else{
					$message = array(
						'result'	=> 'failed',
						'message'	=> 'purchase Return Update failed'
					);
					$this->session->set_userdata('msg',$message);
					redirect(base_url('purchase_return_list'));
				}
			}else{
				$message = array(
					'result'	=> 'failed',
					'message'	=> 'No Products Selected To Return'
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('purchase_return_list'));
			}
		}else{
			$data['purchase_return_details'] = $this->common->get_array('tbl_purchase_return',array('purchase_return_id' => $purchase_return_id));
			$data['suppliers'] = convert_options_selected($this->common->gets_array('mst_suppliers',array( 'status' => 1)),'supplier_id','supplier_name','supplier',$data['purchase_return_details']['purchase_return_supplier']);
			$data['purchase_bills'] = convert_options_selected($this->common->gets_array_orderby('tbl_purchase',array('purchase_supplier' => $data['purchase_return_details']['purchase_return_supplier']),'purchase_id','desc'),'purchase_id','purchase_number','purchase BILL NUMBER',$data['purchase_return_details']['purchase_return_purchase_id']);
			$data['relations']	= $this->purchase_return->get_purchase_return_relations($purchase_return_id);
		//echo "<pre>";print_r($data);exit;
			$data['listings'] = $this->load->view('purchase_return/purchase_return_products', $data, TRUE);
			$data['company_lists'] 	= convert_options_selected($this->common->gets_array('company_details',array('company_status' =>1,'company_id' => $data['purchase_return_details']['company_id'])),'company_id','company_name','COMPANY',$data['purchase_return_details']['company_id']);
			$this->template->build('purchase_return/purchase_return',$data);
		}
	}
	private function purchase_return_existing_products_handle($purchase_return_id){
		$relations = $this->common->gets_array('tbl_purchase_return_relations',array('purchase_return_id' => $purchase_return_id, 'status' => 1 ));
		if($relations){
			foreach ($relations as $key => $relation){
				$reduce_stock = array(
					'product_id'			=> $relation['product_id'],
					'quantity'				=> $relation['return_quantity'],
				);
			//echo "<pre>";print_r($reduce_stock);exit;
				$this->purchase_return->reduce_stock($reduce_stock);
			}
			$update = array(
				'status' => 0
			);
			$update_result = $this->common->update('tbl_purchase_return_relations',$update,array('purchase_return_id' => $purchase_return_id));
		}
	}
	public function purchase_return_delete($purchase_return_id){
		$update = array(
			'status'		=> 0,
			'updated_on'   => created_on(),
			'updated_by'   => created_by()
		);
		$update_result = $this->common->update('tbl_purchase_return',$update,array('purchase_return_id' => $purchase_return_id));
		if($update_result){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'company_id'			=> $this->session->userdata('company_id'),
				'log_category_id'	=> 9,
				'operation'			=> 'Purchase Return Deleted',
				'operation_details'	=> 'Purchase Return Deleted For -'.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $data['purchase_return_supplier']),'supplier_name'),
				'purchase_return_id'=> $purchase_return_id,
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => 'purchase Return Removed Successfully'
			);
		}else{
			$message = array(
				'result' => 'failed',
				'message' => 'purchase Return Remove Failed'
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('purchase_return_list'));
	}
	public function purchase_return_status_change($purchase_return_id){
		$update = $this->common->update('tbl_purchase_return',array('status' => 2),array('purchase_return_id' => $purchase_return_id));
		if($update){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'company_id'			=> $this->session->userdata('company_id'),
				'log_category_id'	=> 9,
				'operation'			=> 'Purchase Return Status Change to Completed',
				'operation_details'	=> 'Purchase Return Status Completed By -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				'purchase_return_id'	=> $purchase_return_id,
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => 'Purchase Return Mark as to Completed'
			);
		}else{
			$message = array(
				'result' => 'failed',
				'message' => 'Purchase Return Mark as to Completed Status Failed'
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('purchase_return_list'));
	}
}