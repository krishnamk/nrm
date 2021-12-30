<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dc extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Dc_model','dc');
		$this->load->model('User_model','user');
		if(!$this->session->userdata('invoice_logged_in')){
			redirect('login','refresh');
		}
	} 
	public function index(){

	}
	public function dc_list(){
		if($this->input->post()){
			$data = $this->input->post();
			//echo '<pre>';print_r($data);exit;
			$data['lists'] = $this->dc->get_dc_lists($data);
			$data['pendinglists'] = $this->dc->get_dc_pending_lists($data);
			//echo '<pre>';print_r($data);exit;
			if($data['option'] == 'view'){
				$this->template->build('dc/dc_list',$data);
			}else{
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$html = $this->load->view('dc/dc_list_pdf',$data,true);
				$pdf->WriteHTML($html);
				$pdf->Output('dc_list_pdf.pdf','I');
			}
		}else{
			$data['lists'] = $this->dc->get_dc_lists();
			//echo "<pre>";print_r($data);exit;
			$this->template->build('dc/dc_list',$data);
		}
	}
	//PRODUCT DETAILS
	public function get_product_details(){
		$data = $this->input->post();
		$data['product_detail'] = $this->common->get_array('mst_products',array('product_id' => $data['product_id'] ));
		$data['product_description'] = $data['product_detail']['product_description'];
		if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1){
			$data['brand_name'] = $this->common->get_particular('mst_brands',array('brand_id' => $data['product_detail']['product_brand'] ),'brand_name');
		}else{
			$data['brand_name'] = "";
		}
		$data['result'] = "success";
		echo json_encode($data);
	}

	public function check_product_qty(){
		$data = $this->input->post();
		if($this->common->get_particular('mst_modules',array('module_name' => 'INVENTORY'),'invoice_settings_value')==1){
			if($data['product_id']!=""){
				$product_id 		= $data['product_id'];
				$product_qty 		= $data['product_qty'];
				$product_qty_check 	= $this->dc->check_product_qty($product_id,$product_qty);
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
	//ADD TEMPRORY DC ORDER
	public function add_temprory_dc(){
		$data = $this->input->post();
		$new_dc_temp = array(
			'product_id'			=> $data['product_id'],
			'quantity'				=> $data['quantity'],
			'created_on'			=> created_on(),
			'created_by'			=> created_by(),
			'status'				=> 1
		);
		$dc_relation_temp_id = $this->common->insert('tbl_dcs_relation_temp',$new_dc_temp);
		if($dc_relation_temp_id){
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
		$data['lists'] = $this->dc->get_temp_listings();
		//echo "<pre>";print_r($data);exit;
		$content = $this->load->view('dc/includes/temp_listing', $data, TRUE);
		return $content;
	}
//REMOVE TEMPRORY DC ORDER
	public function remove_temp_dc(){
		$dc_temp_id = $this->input->post('dc_temp_id');
		if($dc_temp_id!=''){
			$temp_details = $this->common->get_array('tbl_dcs_relation_temp',array('dc_relation_temp_id' => $dc_temp_id ));
			$remove = $this->common->remove('tbl_dcs_relation_temp',array('dc_relation_temp_id' => $dc_temp_id ));
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
	public function dc(){
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);//exit;
			$temp_products = $this->dc->get_dc_products();
			//echo "<pre>";print_r($temp_products);//exit;
			$dc_number = $this->common->get_particular('company_details',array('company_id' => $data['company_id']),'dc_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $data['company_id']),'dc_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'quotation_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			//echo "<pre>";print_r($dc_number);exit;
			if($temp_products){
				if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_estimate_to_dc_generate'),'estimate_settings_value') != 1) {
					$dc = array(
						'company_id'			=> $data['company_id'],
						'dc_number' 			=> $dc_number,
						'ref_no'				=> $data['ref_no'],
						'dc_date' 				=> date('Y-m-d',strtotime($data['dc_date'])),
						'dc_customer' 			=> $data['dc_customer'],
						'transport_mode' 		=> $data['transport_mode'],
						'transport_name' 		=> $data['transport_name'],
						'transport_vechile_no' 	=> $data['transport_vechile_no'],
						'dc_approved'           => 1,
						'created_on' 			=> created_on(),
						'created_by' 			=> created_by(),
						'status' 				=> 1
					);
				}else{
					$dc = array(
						'company_id'			=> $data['company_id'],
						'dc_number' 			=> $dc_number,
						'ref_no'				=> $data['ref_no'],
						'dc_date' 				=> date('Y-m-d',strtotime($data['dc_date'])),
						'dc_customer' 			=> $data['dc_customer'],
						'estimate_id' 			=> implode(',',$data['estimate_no']),
						'transport_mode' 		=> $data['transport_mode'],
						'transport_name' 		=> $data['transport_name'],
						'transport_vechile_no' 	=> $data['transport_vechile_no'],
						'dc_approved'           => 1,
						'created_on' 			=> created_on(),
						'created_by' 			=> created_by(),
						'status' 				=> 1
					);
				}
				//echo "<pre>";print_r($dc);exit;
				$dc_id = $this->common->insert('tbl_dcs',$dc);
				//echo "<pre>";print_r($dc_id);exit;
				if($dc_id){
					$current_count =$this->common->get_particular('company_details',array('company_id' => $data['company_id']),'dc_prefix_count');
					$next_count = next_number($current_count);
					$this->common->update('company_details',array('dc_prefix_count' => $next_count ),array('company_id' => $data['company_id']));
					foreach ($temp_products as $key => $product) {
						//echo "<pre>";print_r($product);exit;
						$relations = array(
							'dc_id'					=> $dc_id,
							'product_id'			=> $product['product_id'],
							'product_name'			=> $product['product_name'],
							'tax_name' 				=> $product['tax_name'],
							'tax_percent'			=> $product['tax_percentage'],
							'quantity'				=> $product['quantity'],
							'balance_quantity'		=> $product['quantity'],
							'created_on'			=> created_on(),
							'created_by'			=> created_by(),
							'status'				=> 1
						);
						if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
							$relations['brand_name'] = $product['brand_name'];
							$relations['brand_name'] = $product['brand_name'];
						}
						if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
							$relations['category_name'] = $product['category_name'];
						}
						if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){
							$relations['subcategory_name'] = $product['sub_category_name'];
						}
						//echo "<pre>";print_r($relations);//exit;
						$dc_relation_id = $this->common->insert('tbl_dcs_relation',$relations);
						//STOCK REDUCE
						$stock = array(
							'product_id'		=>	$product['product_id'],
							'quantity'			=>	$product['quantity'],
						);
						$this->dc->reduce_stock($stock);
						//Estimate Status Change
						if($data['estimate_no']){
							foreach ($data['estimate_no'] as $key => $estimate_no) {
								$estimate_status = array('status' => 2);
								$estimate_update = $this->common->update('tbl_estimates',$estimate_status,array('estimate_id' => $estimate_no));
							}
						}
						//MULTIPLE ESTIMATE TO DC CONVERT - DC STATUS TO BE COMPLETED
						if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_estimate_to_dc_generate'),'estimate_settings_value') == 1) {
							$update = array(
								'updated_on'	=> created_on(),
								'updated_by'	=> created_by(),
								'status'		=> 2,
								'dc_status'		=> 2
							);
							$dc_update_status = $this->common->update('tbl_dcs',$update,array('dc_id' => $dc_id ));
						}
					}
					$message = array(
						'result' 	=> 'success',
						'message' 	=> 'DC generated successfully',
					);
					$log = array(
						'user_id'			=> $this->session->userdata('user_id'),
						'company_id'		=> $data['company_id'],
						'log_category_id'	=> 2,
						'operation'			=> 'Dc Creation',
						'operation_details'	=> 'New Dc Created For '.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['dc_customer']),'customer_name'),
						'customer_id'		=> $data['dc_customer'],
						'dc_id'				=> $dc_id,
						'logs_status'		=> 0,
						'created_on'		=> created_on(),
						'status'			=> 1
					);
					$log_id = $this->common->insert('tbl_logs',$log);
					$this->session->set_userdata('msg',$message);
					redirect(base_url('dc_view/'.$dc_id));
				}else{
					$message = array(
						'result' 	=> 'failed',
						'message' 	=> 'Dc generation failed',
					);
				}
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Product adding to dc failed',
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('dc'));
		}else{
			$this->common->truncate('tbl_dcs_relation_temp');
			$data['lists'] 		= array();
			$data['dc_number'] = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'dc_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'dc_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'quotation_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			//echo "<pre>";print_r($data['dc_number']);exit;
			$data['customers'] 	= convert_options($this->common->gets_array('mst_customers',array('status' =>1)),'customer_id','customer_name','CUSTOMER');
			$data['estimate'] 	= convert_options($this->common->gets_array('tbl_estimates',array('status' => 1,'company_id' => $this->session->userdata('company_id'))),'estimate_id','estimate_number','ESTIMATE NO'); 
			//COMPANY LIST IF MULTIPLE COMPANY ENABLE
			if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){
				if($this->session->userdata('access_level')==1){
					$data['company_lists'] = array_column($this->user->get_company_list(), 'company_name');
				}elseif($this->session->userdata('access_level')==2){
					$data['company_lists'] = array_column($this->user->get_current_user_companies(), 'company_name');
				}
			}
			$this->template->build('dc/new_dc',$data);
		}
	}
	public function dc_edit($dc_id){
		if($this->input->post()){
			$final_result = false;
			$data = $this->input->post();
			//echo "<pre>";print_r($data);exit;
			$dc_products = $this->dc->get_dc_products();
			//echo "<pre>";print_r($dc_products);exit;
			if($dc_products){
				//echo "<pre>";print_r($data);exit;
				$dc = array(
					'company_id'			=> $data['company_id'],
					'dc_number' 			=> $data['dc_number'],
					'dc_date' 				=> date('Y-m-d',strtotime($data['dc_date'])),
					'dc_customer' 			=> $data['dc_customer'],
					'transport_mode'		=> $data['transport_mode'],
					'transport_name'		=> $data['transport_name'],
					'transport_vechile_no'	=> $data['transport_vechile_no'],
					'dc_approved'			=> 1,
					'updated_on'			=> updated_on(),
					'updated_by'			=> created_by(),
					'status' 				=> 1
				);
				if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_estimate_to_dc_generate'),'estimate_settings_value') == 1) {
					$dc = array(
						'company_id'			=> $data['company_id'],
						'dc_number' 			=> $data['dc_number'],
						'ref_no'				=> $data['ref_no'],
						'dc_date' 				=> date('Y-m-d',strtotime($data['dc_date'])),
						'dc_customer' 			=> $data['dc_customer'],
						'estimate_id' 			=> implode(',',$data['estimate_no']),
						'transport_mode' 		=> $data['transport_mode'],
						'transport_name' 		=> $data['transport_name'],
						'transport_vechile_no' 	=> $data['transport_vechile_no'],
						'dc_approved'           => 1,
						'created_on' 			=> created_on(),
						'created_by' 			=> created_by(),
						'status' 				=> 1
					);
				}
				$dc_update_result = $this->common->update('tbl_dcs',$dc,array('dc_id' => $dc_id ));
				if($dc_update_result){
					$this->increase_dc_stock($dc_id);
					foreach ($dc_products as $key => $product) {
						//echo "<pre>";print_r($product);exit;
						$relations = array(
							'dc_id'					=> $dc_id,
							'product_id'			=> $product['product_id'],
							'product_name'			=> $product['product_name'],
							'tax_name' 				=> $product['tax_name'],
							'tax_percent'			=> $product['tax_percentage'],
							'quantity'				=> $product['quantity'],
							'balance_quantity'		=> $product['quantity'],
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
						$dc_relation_id = $this->common->insert('tbl_dcs_relation',$relations);
						$stock = array(
							'product_id'		=>	$product['product_id'],
							'quantity'			=>	$product['quantity'],
						);
						$this->dc->reduce_stock($stock);
						//Estimate Status Change
						if($data['estimate_no']){
							foreach ($data['estimate_no'] as $key => $estimate_no) {
								$estimate_status = array('status' => 2);
								$estimate_update = $this->common->update('tbl_estimates',$estimate_status,array('estimate_id' => $estimate_no));
							}
						}
					}
					$message = array(
						'result' 	=> 'success',
						'message' 	=> 'DC updated successfully',
					);
					$this->session->set_userdata('msg',$message);
					$log = array(
						'user_id'			=> $this->session->userdata('user_id'),
						'company_id'		=> $data['company_id'],
						'log_category_id'	=> 2,
						'operation'			=> 'Dc Updated',
						'operation_details'	=> 'Dc Updated For '.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['dc_customer']),'customer_name'),
						'customer_id'		=> $data['dc_customer'],
						'dc_id'				=> $dc_id,
						'remarks'			=> '',
						'logs_status'		=> 0,
						'created_on'		=> created_on(),
						'status'			=> 1
					);
					$log_id = $this->common->insert('tbl_logs',$log);
					redirect(base_url('dc_view/'.$dc_id));
				}else{
					$message = array(
						'result' 	=> 'failed',
						'message' 	=> 'Dc update failed',
					);
				}
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Product adding to dc failed',
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('dc'));
		}else{
			$data = $this->dc->get_dc_details($dc_id);
			//echo "<pre>";print_r($data);exit;
			$this->add_temp_dc($data['relations']);
			$data['temp_products'] = $this->get_dc_temp_listings();
			$data['customers'] 	= convert_options_selected($this->common->gets_array('mst_customers',array('status' =>1)),'customer_id','customer_name','CUSTOMER',$data['dc_details']['dc_customer']);
			//IF ESTIMATE DC ENABLE
			if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_estimate_to_dc_generate'),'estimate_settings_value')==1){
				$data['estimate_no']	= multi_select($this->common->gets_array('tbl_estimates', array('status' => 1)),'estimate_number','estimate_id',$data['dc_details']['estimate_id']);
				//echo "<pre>";print_r($data['estimate_no']);exit;
			}
			$data['company_lists'] 	= convert_options_selected($this->common->gets_array('company_details',array('company_status' =>1,'company_id' => $data['dc_details']['company_id'])),'company_id','company_name','COMPANY',$data['dc_details']['company_id']);
			$this->template->build('dc/new_dc',$data);
		}
	}
	public function dc_delete($dc_id){
		$update = array('status' => 0 );
		$delete_result = $this->common->update('tbl_dcs',$update,array('dc_id' => $dc_id));
		if($delete_result){
			//IF ESTIMATE DC
			if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'multiple_estimate_to_dc_generate'),'estimate_settings_value') == 1) {
				$estimates_id = $this->common->get_particular('tbl_dcs',array('dc_id' => $dc_id),'estimate_id');
				if($estimates_id){
					foreach (explode(',',$estimates_id) as $key => $estimate_id) {
						$estimate_status = array('status' => 1);
						$estimate_update = $this->common->update('tbl_estimates',$estimate_status,array('estimate_id' => $estimate_id));
					}
				}
			}else{
				$estimate_id = $this->common->get_particular('tbl_dcs',array('dc_id' => $dc_id),'estimate_id');
				if($estimate_id){
					$estimate_update = array(
						'updated_on'	=> created_on(),
						'updated_by'	=> created_by(),
						'status'		=> 1
					);
					$estimate_update_result = $this->common->update('tbl_estimates',$estimate_update,array('estimate_id' => $estimate_id ));
				}
			}

		//IF QUOTATION DC
			$quotation_id = $this->common->get_particular('tbl_dcs',array('dc_id' => $dc_id),'quotation_id');
			if($quotation_id){
				$quotation_update = array(
					'updated_on'	=> created_on(),
					'updated_by'	=> created_by(),
					'status'		=> 1
				);
				$quotation_update_result = $this->common->update('tbl_quotations',$quotation_update,array('quotation_id' => $quotation_id ));
			}
		//DC STOCK QTY INCREASE
			$data = $this->dc->get_dc_details($dc_id);
			//echo "<pre>";print_r($data);exit;
			if($data['relations']){
				foreach ($data['relations'] as $key => $relation) {
					$stock = array(
						'product_id'		=>	$relation['product_id'],
						'quantity'			=>	$relation['quantity'],
					);
					$this->dc->increase_stock($stock);
				}
				$status = array('status' => 0 );
				$this->common->update('tbl_dcs_relation',$status,array('dc_id' => $dc_id));
			}
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'company_id'		=> $this->session->userdata('company_id'),
				'log_category_id'	=> 2,
				'operation'			=> 'Dc Removed',
				'operation_details'	=> 'Dc Removed For '.$this->common->get_particular('mst_customers',array('customer_id' => $data['customer_details']['customer_id']),'customer_name'),
				'customer_id'		=> $data['customer_details']['customer_id'],
				'dc_id'				=> $dc_id,
				'remarks'			=> '',
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' 	=> 'Success',
				'message' 	=> 'Dc Removing Success',
			);
			$this->session->set_userdata('msg',$message);
			redirect(base_url('dc_list'));
		}else{
			$message = array(
				'result' 	=> 'failed',
				'message' 	=> 'Dc Removing failed',
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('dc_list'));
	}
	public function dc_view($dc_id){
		$data = $this->dc->get_dc_details($dc_id);
		//echo "<pre>";print_r($data);exit;
		$this->template->build('dc/dc_view',$data);
	}
	public function dc_print($dc_id){
		$data = $this->dc->get_dc_details($dc_id);
		//echo "<pre>";print_r($data);exit;
		$html = $this->load->view('dc/dc_print',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output('DC_PRINT.pdf','I');
	}
	public function dc_download($dc_id){
		$data = $this->dc->get_dc_details($dc_id);
		$html = $this->load->view('dc/dc_print',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output('DC_PRINT.pdf','D');
	}
	public function dc_complete($dc_id){
		$update = array('status' => 2 );
		$delete_result = $this->common->update('tbl_dcs',$update,array('dc_id' => $dc_id ));
		if($delete_result){
			$message = array(
				'result' 	=> 'success',
				'message' 	=> 'Dc Completed successfully',
			);
		}else{
			$message = array(
				'result' 	=> 'failed',
				'message' 	=> 'Dc Completed failed',
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('dc_list'));
	}
	private function add_temp_dc($rows){
		$this->common->truncate('tbl_dcs_relation_temp');
		foreach ($rows as $key => $row) {
			$stock_id = $this->common->get_particular('tbl_stock',array( 'product_id' => $row['product_id']),'stock_id');
			$temp = array(
				'product_id'			=> $row['product_id'],
				'stock_id'				=> $stock_id,
				'quantity'				=> $row['quantity'],
				'created_on'			=> created_on(),
				'created_by'			=> created_by(),
				'status'				=> 1
			);
			$insert_id = $this->common->insert('tbl_dcs_relation_temp',$temp);
		}
	}
	private function get_dc_temp_listings(){
		$data['lists'] = $this->dc->get_temp_listings();
		if($data['lists']){
			$lists = $this->load->view('dc/includes/temp_listing', $data, TRUE);
		}else{
			$lists ='<tr>
			<td colspan="6">NO PRODUCTS ADDED</td>
			</tr>';
		}
		return $lists;
	}
	private function increase_dc_stock($dc_id){
		$data = $this->dc->get_dc_details($dc_id);
		//echo "<pre>";print_r($data);exit;
		if($data['relations']){
			foreach ($data['relations'] as $key => $relation) {
				$stock = array(
					'product_id'		=>	$relation['product_id'],
					'quantity'			=>	$relation['quantity'],
				);
				$this->dc->increase_stock($stock);
			}
			$status = array('status' => 0 );
			$this->common->update('tbl_dcs_relation',$status,array('dc_id' => $dc_id));
		}else{
			return false;
		}
	}
	//GET CUSOTMER BASED DC
	public function get_customer_based_dc(){
		$customer_id = $this->input->post('customer_id');
		$data['estimate_no'] =  convert_options($this->common->gets_array('tbl_estimates',array('estimate_customer' =>$customer_id,'status' => 1)),'estimate_id','estimate_number','ESTIMATE NO');
		$data['result'] = "success";
		echo json_encode($data);
	}
	public function get_estimate_details(){
		$estimate_no = $this->input->post('estimate_no');
		$content = "";
		$data['count'] = 0;
		if(!empty($estimate_no)){
			foreach ($estimate_no as $key => $estimate) {
				$data['estimate_details'] = $this->common->gets_array('tbl_estimates_relation',array('estimate_id' => $estimate,'status' => 1));
				$content .= $this->load->view('dc/includes/estimate_dc_temp_listing',$data,TRUE);
				$data['count'] = ($data['count'] + $this->common->count('tbl_estimates_relation',array('estimate_id' => $estimate,'status' => 1)));
				//SAVED INTO DC TEMP TABLE
				foreach ($data['estimate_details'] as $key => $estimate_detail) {
					$dc_relation_temp_id = $this->common->get_particular('tbl_dcs_relation_temp',array('estimate_id' => $estimate_detail['estimate_id'],'product_id' => $estimate_detail['product_id'],'quantity' => $estimate_detail['quantity']),'dc_relation_temp_id');
					if($dc_relation_temp_id){
						$new_dc_temp = array(
							'product_id'			=> $estimate_detail['product_id'],
							'quantity'				=> $estimate_detail['quantity'],
							'estimate_id'			=> $estimate_detail['estimate_id'],
							'estimate_relation_id'	=> $estimate_detail['estimate_relation_id'],
							'created_on'			=> created_on(),
							'created_by'			=> created_by(),
							'status'				=> 1
						);
						$update = $this->common->update('tbl_dcs_relation_temp',$new_dc_temp,$arrayName = array('estimate_id' => $estimate_detail['estimate_id'],'product_id' => $estimate_detail['product_id'],'quantity' => $estimate_detail['quantity']));
					}else{
						$new_dc_temp = array(
							'product_id'			=> $estimate_detail['product_id'],
							'quantity'				=> $estimate_detail['quantity'],
							'estimate_id'			=> $estimate_detail['estimate_id'],
							'estimate_relation_id'	=> $estimate_detail['estimate_relation_id'],
							'created_on'			=> created_on(),
							'created_by'			=> created_by(),
							'status'				=> 1
						);
						$insert = $this->common->insert('tbl_dcs_relation_temp',$new_dc_temp);
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

}