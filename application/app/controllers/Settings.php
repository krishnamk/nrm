<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Settings extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('User_model','user');
		if(!$this->session->userdata('invoice_logged_in')){
			redirect('logout','refresh');
		}
	}

	//Module_settings
	public function module_settings(){
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);//exit;
			if($data){
				$this->common->update('mst_modules',array('module_status' => 0));
			}
			foreach ($data['modules'] as $key => $module_id) {
				$update = array( 'module_status' => 1 );
				$module_id =$this->common->update('mst_modules',$update,array('module_id'=>$module_id));
			}
			if($module_id){
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'Modules Updated successfully',
				);
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'log_category_id'	=> 19,
					'operation'			=> 'Modules Updated',
					'operation_details'	=> 'Modules Updated By '.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Modules Updated failed',
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('dashboard'));
		}else{
			$data['modules'] = get_module_list();
			$this->template->build('settings/module_settings',$data);

		}
	}

	//Sub Module_settings
	public function sub_module_settings(){
		if($this->input->post()){
			$data = $this->input->post();
			if($data){
				$this->common->update('mst_sub_modules',array('status' => 0));
			}
			foreach ($data['submodules'] as $key => $sub_module_id) {
				$update = array('status' => 1 );
				$sub_module_id =$this->common->update('mst_sub_modules',$update,array('sub_module_id'=>$sub_module_id));
			}
			if($sub_module_id){
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'Sub Modules Updated successfully',
				);
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'log_category_id'	=> 19,
					'operation'			=> 'Sub Modules Updated',
					'operation_details'	=> 'Sub Modules Updated By '.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Sub Modules Updated failed',
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('dashboard'));
		}else{
			$data['modules'] = get_module_list();
			//echo "<pre>";print_r($data);exit;
			$this->template->build('settings/sub_module_settings',$data);

		}
	}

	//General_settings
	public function general_settings(){
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);//exit;
			if($data){
				$this->common->update('mst_general_settings',array('general_settings_value' => 0));
			}
			foreach ($data['generals'] as $key => $general_settings_id) {
				$update = array( 'general_settings_value' => 1 );
				$general_settings = $this->common->update('mst_general_settings',$update,array('general_settings_id'=>$general_settings_id));
			}
			if($general_settings){
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'General Settings Updated successfully',
				);
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'log_category_id'	=> 19,
					'operation'			=> 'General Settings Updated',
					'operation_details'	=> 'General Settings Updated By '.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'General Settings Updated failed',
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('dashboard'));
		}else{
			$data['generals'] = get_general_list();
			$this->template->build('settings/general_settings',$data);

		}
	}

	//Invoice_settings
	public function invoice_settings(){
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);exit;
			if($data){
				$this->common->update('mst_invoice_settings',array('invoice_settings_value' => 0));
			}
			foreach ($data['invoices'] as $key => $invoice_settings_id) {
				$update = array( 'invoice_settings_value' => 1 );
				$invoice_settings =$this->common->update('mst_invoice_settings',$update,array('invoice_settings_id'=>$invoice_settings_id));
			}
			if($invoice_settings){
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'Invoice Settings Updated successfully',
				);
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'log_category_id'	=> 19,
					'operation'			=> 'Invoice Settings Updated',
					'operation_details'	=> 'Invoice Settings Updated By '.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Invoice Settings Updated failed',
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('dashboard'));
		}else{
			$data['invoices'] = get_invoice_settings_list();
			$this->template->build('settings/invoice_settings',$data);
		}
	}

	//Estimate_settings
	public function estimate_settings(){
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);exit;
			if($data){
				$this->common->update('mst_estimate_settings',array('estimate_settings_value' => 0));
			}
			foreach ($data['estimates'] as $key => $estimate_settings_id) {
				$update = array( 'estimate_settings_value' => 1 );
				$estimate_settings =$this->common->update('mst_estimate_settings',$update,array('estimate_settings_id'=>$estimate_settings_id));
			}
			if($estimate_settings){
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'Estimate Settings Updated successfully',
				);
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'log_category_id'	=> 19,
					'operation'			=> 'Estimate Settings Updated',
					'operation_details'	=> 'Estimate Settings Updated By '.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Estimate Settings Updated failed',
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('dashboard'));
		}else{
			$data['estimates'] = get_estimate_settings_list();
			$this->template->build('settings/estimate_settings',$data);
		}
	}

	//Quotation_settings
	public function quotation_settings(){
		if($this->input->post()){
			$data = $this->input->post();
			if($data){
				$this->common->update('mst_quotation_settings',array('quotation_settings_value' => 0));
			}
			foreach ($data['quotations'] as $key => $quotation_settings_id){
				$update = array( 'quotation_settings_value' => 1 );
				$quotation_settings =$this->common->update('mst_quotation_settings',$update,array('quotation_settings_id'=>$quotation_settings_id));
			}
			if($quotation_settings){
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'Quotation Settings Updated successfully',
				);
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'log_category_id'	=> 19,
					'operation'			=> 'Quotation Settings Updated',
					'operation_details'	=> 'Quotation Settings Updated By '.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Quotation Settings Updated failed',
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('dashboard'));
		}else{
			$data['quotations'] = get_quotation_settings_list();
			$this->template->build('settings/quotation_settings',$data);
		}
	}

	//Purchase_settings
	public function purchase_settings(){
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);//exit;
			if($data){
				$this->common->update('mst_purchase_settings',array('purchase_settings_value' => 0));
			}
			foreach ($data['purchases'] as $key => $purchase_settings_id){
				$update = array( 'purchase_settings_value' => 1 );
				$purchase_settings =$this->common->update('mst_purchase_settings',$update,array('purchase_settings_id'=>$purchase_settings_id));
			}
			if($purchase_settings){
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'Purchase Settings Updated successfully',
				);
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'log_category_id'	=> 19,
					'operation'			=> 'Purchase Settings Updated',
					'operation_details'	=> 'Purchase Settings Updated By '.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Purchase Settings Updated failed',
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('dashboard'));
		}else{
			$data['purchases'] = get_purchase_settings_list();
			$this->template->build('settings/purchase_settings',$data);
		}
	}
	
	//Product_settings
	public function product_settings(){
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);//exit;
			if($data){
				$this->common->update('mst_product_settings',array('product_settings_value' => 0));
			}
			foreach ($data['products'] as $key => $product_settings_id) {
				$update = array( 'product_settings_value' => 1 );
				$product_settings =$this->common->update('mst_product_settings',$update,array('product_settings_id'=>$product_settings_id));
			}
			if($product_settings){
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'Product Settings Updated successfully',
				);
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'log_category_id'	=> 19,
					'operation'			=> 'Product Settings Updated',
					'operation_details'	=> 'Product Settings Updated By '.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Product Settings Updated failed',
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('dashboard'));
		}else{
			$data['products'] = get_product_settings_list();
			$this->template->build('settings/product_settings',$data);

		}

	}

	//Company_settings
	public function company_settings(){
		$this->template->build('settings/company_settings');
	}
	
	//User_settings
	public function user_settings(){
		$this->template->build('settings/user_settings');
	}

	//Report_settings
	public function report_settings(){
		$this->template->build('settings/report_settings');
	}

	//Payment_settings
	public function payment_settings(){
		$this->template->build('settings/payment_settings');
	}
	
	//Prefix_settings
	public function prefix_settings(){
		$this->template->build('settings/prefix_settings');
	}
	//Tax_settings
	public function tax_settings(){
		$this->template->build('settings/tax_settings');
	}
	
	//Dc_settings
	public function dc_settings(){
		$this->template->build('settings/dc_settings');


	}
	

	//Extra_settings
	public function extra_settings(){
		$this->template->build('settings/extra_settings');


	}
	
}