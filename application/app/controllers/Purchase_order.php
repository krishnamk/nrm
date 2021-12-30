<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchase_order extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Purchase_order_model','purchase_order');
		$this->load->model('User_model','user');
		if(!$this->session->userdata('invoice_logged_in')){
			redirect('login','refresh');
		}
	}
	//PURCHASE ORDER LIST
	public function purchase_order_list(){
		$data['lists'] = $this->purchase_order->get_purchase_order_lists();
		//echo "<pre>";print_r($data);exit;
		$this->template->build('purchase_order/purchase_order_list',$data);
	}
	//PRODUCT DETAILS
	public function get_product_details(){
		$data = $this->input->post();
		$product_detail = $this->common->get_array('mst_products',array('product_id' => $data['product_id'] ));
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
	//ADD TEMPRORY PURCHASE ORDER
	public function add_temprory_purchase_order(){
		$data = $this->input->post();
		//echo '<pre>';print_r($data);exit;
		$new_purchase_order_temp = array(
			'product_id'			=> $data['product_id'],
			'quantity'				=> $data['quantity'],
			'rate'					=> $data['rate'],
			'amount'				=> $data['amount'],
			'created_on'			=> created_on(),
			'created_by'			=> created_by(),
			'status'				=> 1
		);
		$purchase_order_relation_temp_id = $this->common->insert('tbl_purchase_orders_relation_temp',$new_purchase_order_temp);
		if($purchase_order_relation_temp_id){
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
		$data['lists'] = $this->purchase_order->get_temp_listings();
		//echo "<pre>";print_r($data);exit;
		$content = $this->load->view('purchase_order/includes/temp_listing', $data, TRUE);
		return $content;
	}
	//REMOVE TEMPRORY PURCHASE ORDER
	public function remove_temp_purchase_order(){
		$purchase_order_temp_id = $this->input->post('purchase_order_temp_id');
		if($purchase_order_temp_id!=''){
			$temp_details = $this->common->get_array('tbl_purchase_orders_relation_temp',array('purchase_order_relation_temp_id' => $purchase_order_temp_id ));
			$remove = $this->common->remove('tbl_purchase_orders_relation_temp',array('purchase_order_relation_temp_id' => $purchase_order_temp_id ));
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
	//PURCHASE ORDER
	public function purchase_order(){
		if($this->input->post()){
			$data = $this->input->post();
			$temp_products = $this->purchase_order->get_temp_listings();
			//echo '<pre>';print_r($data);//exit;
			//echo "<pre>";print_r($temp_products);exit;
			$purchase_order_number = $this->common->get_particular('company_details',array('company_id' => $data['company_id']),'purchase_order_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $data['company_id']),'purchase_order_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			if($temp_products){
				$new_purchase_order = array(
					'purchase_order_number'			=> $purchase_order_number,
					'company_id'					=> $data['company_id'],
					'purchase_order_date'			=> $data['purchase_order_date'],
					'purchase_order_supplier'		=> $data['purchase_order_supplier'],
					'created_on'					=> created_on(),
					'created_by'					=> created_by(),
					'status'						=> 1
				);
				//echo "<pre>";print_r($new_purchase_order);exit;
				$purchase_order_id = $this->common->insert('tbl_purchase_orders',$new_purchase_order);
				if($purchase_order_id){
					$current_count = $this->common->get_particular('company_details',array('company_id' => $data['company_id']),'purchase_order_prefix_count');
					$next_count = next_number($current_count);
					$this->common->update('company_details',array('purchase_order_prefix_count' => $next_count ),array('company_id' => $data['company_id']));
					$purchase_order_total = 0;
					foreach ($temp_products as $key => $product) {
						$purchase_order_total = $purchase_order_total + $product['amount'];
						$relation = array(
							'purchase_order_id'		=> $purchase_order_id,
							'product_id'			=> $product['product_id'],
							'product_name'			=> $product['product_name'],
							'tax_id'				=> $product['product_tax'],
							'tax_name'				=> $product['tax_name'],
							'tax_percent'			=> $product['tax_percentage'],
							'quantity'				=> $product['quantity'],
							'rate'					=> $product['rate'],
							'amount'				=> $product['amount'],
							'created_on'			=> created_on(),
							'created_by'			=> created_by(),
							'status'				=> 1
						);
						if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
							$relation['brand_id'] = $product['product_brand'];
							$relation['brand_name'] = $product['brand_name'];
						}
						if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
							$relation['category_id'] = $product['product_category'];
							$relation['category_name'] = $product['category_name'];
						}
						if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){
							$relation['subcategory_id'] = $product['product_subcategory'];
							$relation['subcategory_name'] = $product['sub_category_name'];
						}
						//echo "<pre>";print_r($relation);exit;
						$purchase_order_relation_id = $this->common->insert('tbl_purchase_orders_relations',$relation);
					}
					$log = array(
						'user_id'			=> $this->session->userdata('user_id'),
						'company_id'		=> $data['company_id'],
						'log_category_id'	=> 8,
						'operation'			=> 'Purchase Order Created',
						'operation_details'	=> 'Purchase Order Created For -'.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $data['purchase_order_supplier']),'supplier_name'),
						'purchase_order_id'	=> $purchase_order_id,
						'logs_status'		=> 0,
						'created_on'		=> created_on(),
						'status'			=> 1
					);
					$log_id = $this->common->insert('tbl_logs',$log);
					$message = array(
						'result' => 'success',
						'message' => 'Purchase Order Added Successfully'
					);
					$this->session->set_userdata('msg',$message);
					redirect(base_url('purchase_order_view/'.$purchase_order_id));
				}else{
					$message = array(
						'result'	=> 'failed',
						'message'	=> 'Purchase Order Adding Failed'
					);
					$this->session->set_userdata('msg',$message);
				}
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Products are empty'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect(base_url('purchase_order'));
		}else{
			//$this->common->truncate('tbl_purchase_orders_relation_temp');
			$data['purchase_order_number'] = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'purchase_order_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'purchase_order_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			//echo "<pre>";print_r($data['purchase_order_number']);exit;
			$data['suppliers'] = convert_options($this->common->gets_array('mst_suppliers',array('status' => 1)),'supplier_id','supplier_name','SUPPLIER');
			//COMPANY LIST IF MULTIPLE COMPANY ENABLE
			if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){
				if($this->session->userdata('access_level')==1){
					$data['company_lists'] = array_column($this->user->get_company_list(), 'company_name');
				}elseif($this->session->userdata('access_level')==2){
					$data['company_lists'] = array_column($this->user->get_current_user_companies(), 'company_name');
				}
			}
			$this->template->build('purchase_order/purchase_order',$data);
		}
	}
	//PURCHASE view
	public function purchase_order_view($purchase_order_id){
		$data = $this->purchase_order->get_purchase_order_details($purchase_order_id);
		//echo "<pre>";print_r($data);exit;
		$this->template->build('purchase_order/purchase_order_view',$data);
	}
	public function purchase_order_calculation(){
		$data = $this->input->post();
		if($data){
			$data['amount'] = $data['product_quantity'] * $data['product_rate'];
		}
		$data['result'] = "success";
		echo json_encode($data);
	}
	//PURCHASE ORDER EDIT
	public function purchase_order_edit($purchase_order_id){
		if($this->input->post()){
			$data = $this->input->post();
			//echo '<pre>';print_r($data);exit;
			$temp_products = $this->purchase_order->get_temp_listings();
			//echo "<pre>";print_r($temp_products);exit;
			if($temp_products){
				$purchase_order_update = array(
					'purchase_order_number'			=> $data['purchase_order_number'],
					'company_id'					=> $data['company_id'],
					'purchase_order_date'			=> $data['purchase_order_date'],
					'purchase_order_supplier'		=> $data['purchase_order_supplier'],
					'updated_on'					=> created_on(),
					'updated_by'					=> created_by(),
					'status'						=> 1
				);
				//echo "<pre>";print_r($new_purchase_order);exit;
				$purchase_order_update_result = $this->common->update('tbl_purchase_orders',$purchase_order_update,array('purchase_order_id' => $purchase_order_id));
				if($purchase_order_id){
					$this->existing_purchase_order_stock($purchase_order_id);
					$purchase_order_total = 0;
					foreach ($temp_products as $key => $product) {
						$purchase_order_total = $purchase_order_total + $product['amount'];
						$relation = array(
							'purchase_order_id'		=> $purchase_order_id,
							'product_id'			=> $product['product_id'],
							'product_name'			=> $product['product_name'],
							'tax_id'				=> $product['product_tax'],
							'tax_name'				=> $product['tax_name'],
							'tax_percent'			=> $product['tax_percentage'],
							'quantity'				=> $product['quantity'],
							'rate'					=> $product['rate'],
							'amount'				=> $product['amount'],
							'updated_on'			=> created_on(),
							'updated_by'			=> created_by(),
							'status'				=>	1
						);
						if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
							$relation['brand_id'] = $product['product_brand'];
							$relation['brand_name'] = $product['brand_name'];
						}
						if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
							$relation['category_id'] = $product['product_category'];
							$relation['category_name'] = $product['category_name'];
						}
						if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_subcategory'),'product_settings_value')== 1)){
							$relation['subcategory_id'] = $product['product_subcategory'];
							$relation['subcategory_name'] = $product['sub_category_name'];
						}
						//echo "<pre>";print_r($relation);exit;
						$purchase_order_relation_id = $this->common->insert('tbl_purchase_orders_relations',$relation);
					}
					$log = array(
						'user_id'			=> $this->session->userdata('user_id'),
						'company_id'		=> $data['company_id'],
						'log_category_id'	=> 8,
						'operation'			=> 'Purchase Order Updated',
						'operation_details'	=> 'Purchase Order Updated For  -'.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $data['purchase_order_supplier']),'supplier_name'),
						'purchase_order_id'	=> $purchase_order_id,
						'logs_status'		=> 0,
						'created_on'		=> created_on(),
						'status'			=> 1
					);
					$log_id = $this->common->insert('tbl_logs',$log);
					$message = array(
						'result' => 'success',
						'message' => 'Purchase Order Updated Successfully'
					);
					$this->session->set_userdata('msg',$message);
					redirect(base_url('purchase_order_view/'.$purchase_order_id));
				}else{
					$message = array(
						'result'	=> 'failed',
						'message'	=> 'Purchase Order Update Failed'
					);
					$this->session->set_userdata('msg',$message);
				}
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Products are empty'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect(base_url('purchase_order_edit/'.$purchase_order_id));
		}else{
			$data['purchase_order_details'] = $this->common->get_array('tbl_purchase_orders',array('purchase_order_id' => $purchase_order_id ));
			$this->common->truncate('tbl_purchase_orders_relation_temp');
			$this->add_temp_products($purchase_order_id);
			$data['temp_products'] = $this->temp_listing();
			$data['purchase_order_number'] = $data['purchase_order_details']['purchase_order_number'];
			$data['suppliers'] = convert_options_selected($this->common->gets_array('mst_suppliers',array('status' => 1)),'supplier_id','supplier_name','SUPPLIER',$data['purchase_order_details']['purchase_order_supplier']);
			$data['company_lists'] 	= convert_options_selected($this->common->gets_array('company_details',array('company_status' =>1,'company_id' => $data['purchase_order_details']['company_id'])),'company_id','company_name','COMPANY',$data['purchase_order_details']['company_id']);
			$this->template->build('purchase_order/purchase_order',$data);
		}
	}
	//PURCHASE ORDER REMOVE
	public function purchase_order_remove($purchase_order_id){
		$update_array = array(
			'status' => 0
		);
		$update_result = $this->common->update('tbl_purchase_orders',$update_array,array('purchase_order_id' => $purchase_order_id));
		if($update_result){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'company_id'			=> $this->session->userdata('company_id'),
				'log_category_id'	=> 8,
				'operation'			=> 'Purchase Order Deleted',
				'operation_details'	=> 'Purchase Order Deleted For  -'.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $data['purchase_order_supplier']),'supplier_name'),
				'purchase_order_id'	=> $purchase_order_id,
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => 'Purchase Order Removed Successfully'
			);
		}else{
			$message = array(
				'result' => 'failed',
				'message' => 'Purchase Order Remove Failed'
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('purchase_order_list'));
	}
	//PURCHASE ORDER DOWNLOAD
	public function purchase_order_download($purchase_order_id){
		$data = $this->purchase_order->get_purchase_order_details($purchase_order_id);
		//echo "<pre>";print_r($data);exit;
		$html = $this->load->view('purchase_order/purchase_order_print',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output('PURCHASE_PRINT.pdf','D');
	}
	//PURCHASE ORDER PRINT
	public function purchase_order_print($purchase_order_id){
		$data = $this->purchase_order->get_purchase_order_details($purchase_order_id);
		//echo "<pre>";print_r($data);exit;
		$html = $this->load->view('purchase_order/purchase_order_print',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output('PURCHASE_PRINT.pdf','I');
	}
	public function existing_purchase_order_stock($purchase_order_id){
		$realtions = $this->common->gets_array('tbl_purchase_orders_relations',array('purchase_order_id' => $purchase_order_id,'status' => 1));
		if($realtions){
			foreach ($realtions as $key => $relation) {
			}
			$update_array = array(
				'status' => 0
			);
			$update_result = $this->common->update('tbl_purchase_orders_relations',$update_array,array('purchase_order_id' => $purchase_order_id));
		}
	}
	public function add_temp_products($purchase_order_id){
		$products = $this->common->gets_array('tbl_purchase_orders_relations',array('purchase_order_id' => $purchase_order_id, 'status' => 1));
		if($products){
			foreach ($products as $key => $product) {
				$new_temp = array(
					'product_id'			=> $product['product_id'],
					'quantity'				=> $product['quantity'],
					'rate'					=> $product['rate'],
					'amount'				=> $product['amount'],
					'created_on'			=> created_on(),
					'created_by'			=> created_by(),
					'status'				=> 1
				);
				$purchase_order_relation_id = $this->common->insert('tbl_purchase_orders_relation_temp',$new_temp);
			}
		}
	}
	public function purchase_order_mail($purchase_order_id){
		//echo "<pre>";print_r(APPPATH);exit;
		$path = APPPATH.'../attachments/purchase_order.pdf';
		$data = $this->purchase_order->get_purchase_order_details($purchase_order_id);
		//echo "<pre>";print_r($data);exit;
		$from_mail = $data['company_details']['company_email'];
		$to_mail = $data['supplier_details']['supplier_email'];
		$html = $this->load->view('purchase_order/purchase_order_print',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output($path,'F');
		//Email
		$this->load->library('email');
		$this->email->from($from_mail, 'Ctrlnext Technologies');
		$this->email->to($to_mail);
		$this->email->subject('Purchase Order (Attachment)');
		$this->email->message($message);
		$this->email->attach($path);
		$this->email->send();
		//Send mail 
		if($this->email->send()) {
				//echo "<pre>";print_r('sent');exit;
			$this->session->set_flashdata("email_sent","Email sent successfully."); 
			redirect(base_url('purchase_order_list'));
		}else{
				//echo "<pre>";print_r('Not sent');exit;
			$this->session->set_flashdata("email_sent","Error in sending Email."); 
			redirect(base_url('purchase_order_list'));
		}
		unlink($path);
	}
}