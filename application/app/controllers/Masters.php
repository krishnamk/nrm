<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Masters extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Master_model','master');
		if(!$this->session->userdata('invoice_logged_in')){
			redirect('logout','refresh');
		}
	}
	// COMPANY LIST
	public function company_list(){
		$data['lists'] = $this->common->gets_array('company_details',array('company_status' => 1 ));
		$this->template->build('masters/company_listing',$data);
	}
	//CREATE COMPANY
	public function company(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['company_name'] = strtoupper($data['company_name']);
			$data['created_on'] = created_on();
			$data['created_by'] = created_by();
			$data['company_status'] = 1;
			$insert = $this->common->insert('company_details',$data);
			if($insert){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $this->session->userdata('company_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Company Added',
					'operation_details'	=> 'Company Added By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'company_id'		=> $insert,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' => 'success',
					'message' => 'Company added Successfully'
				);
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Company adding failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('company_list'));
		}else{
			$this->template->build('masters/company');
		}
	}
	//COMPANY EDIT
	public function company_edit($company_id){
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);exit;
			$data['company_name'] = strtoupper($data['company_name']);
			$data['updated_on'] = updated_on();
			$data['updated_by'] = created_by();
			$data['company_status'] = 1;
			$update = $this->common->update('company_details',$data,array( 'company_id' => $company_id ));
			if($update){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'			=> $this->session->userdata('company_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Company Edited',
					'operation_details'	=> 'Company Edited By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'company_id'			=> $company_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' => 'success',
					'message' => 'Company updated Successfully'
				);
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Company update failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('company_list'));
		}else{
			$data['company'] = $this->common->get_array('company_details',array( 'company_id' => $company_id ));
			$this->template->build('masters/company',$data);
		}
	}
	//COMPANY DELETE 
	public function company_delete($company_id){
		$update['updated_on'] = updated_on();
		$update['updated_by'] = created_by();
		$update['company_status'] = 0;
		$response = $this->common->delete('company_details',$update,array('company_id' => $company_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'company_id'		=> $this->session->userdata('company_id'),
				'log_category_id'	=> 18,
				'operation'			=> 'Company Deleted',
				'operation_details'	=> 'Company Deleted By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				'company_id'		=> $company_id,
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('company_list'));
	}

	// BRANCH LIST
	public function branch_list(){
		$data['lists'] = $this->common->gets_array('mst_branches',array('branch_status' => 1 ));
		$this->template->build('masters/branch_listing',$data);
	}
	//CREATE BRANCH
	public function branch(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['branch_name'] = strtoupper($data['branch_name']);
			$data['created_on'] = created_on();
			$data['created_by'] = created_by();
			$data['branch_status'] = 1;
			$insert = $this->common->insert('mst_branches',$data);
			if($insert){
				$message = array(
					'result' => 'success',
					'message' => 'Branch added Successfully'
				);
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Branch adding failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('branch_list'));
		}else{
			$this->template->build('masters/branch');
		}
	}
	//BRANCH EDIT
	public function branch_edit($branch_id){
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);exit;
			$data['branch_name'] = strtoupper($data['branch_name']);
			$data['updated_on'] = updated_on();
			$data['updated_by'] = created_by();
			$data['branch_status'] = 1;
			$update = $this->common->update('mst_branches',$data,array( 'branch_id' => $branch_id ));
			if($update){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'branch_id'			=> $this->session->userdata('branch_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Branch Edited',
					'operation_details'	=> 'Branch Edited By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'branch_id'			=> $branch_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' => 'success',
					'message' => 'Branch updated Successfully'
				);
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Branch update failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('branch_list'));
		}else{
			$data['branch'] = $this->common->get_array('mst_branches',array( 'branch_id' => $branch_id ));
			$this->template->build('masters/branch',$data);
		}
	}
	//BRANCH DELETE 
	public function branch_delete($branch_id){
		$update['updated_on'] = updated_on();
		$update['updated_by'] = created_by();
		$update['branch_status'] = 0;
		$response = $this->common->delete('mst_branches',$update,array('branch_id' => $branch_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'branch_id'			=> $this->session->userdata('branch_id'),
				'log_category_id'	=> 18,
				'operation'			=> 'Branch Deleted',
				'operation_details'	=> 'Branch Deleted By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				'branch_id'			=> $branch_id,
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('branch_list'));
	}
	// SALES PERSON LIST
	public function sales_person_list(){
		$data['sales_persons'] = $this->common->gets_array('mst_sales_person',array('status' => 1));
		$this->template->build('masters/sales_person_listing',$data);
	}
	//CREATE SALES PERSON
	public function sales_person(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['sales_person_name'] = strtoupper($data['sales_person_name']);
			$data['company_id'] = $this->session->userdata('company_id');
			$data['created_on'] = created_on();
			$data['created_by'] = created_by();
			$data['status'] = 1;
			$insert = $this->common->insert('mst_sales_person',$data);
			if($insert){
				$message = array(
					'result' => 'success',
					'message' => 'Sales Person added Successfully'
				);
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Sales Person adding failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('sales_person_list'));
		}else{
			$this->template->build('masters/sales_person');
		}
	}
	//SALES PERSON EDIT
	public function sales_person_edit($sales_person_id){
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);exit;
			$data['sales_person_name'] = strtoupper($data['sales_person_name']);
			$data['company_id'] = $this->session->userdata('company_id');
			$data['updated_on'] = updated_on();
			$data['updated_by'] = created_by();
			$data['status'] = 1;
			$update = $this->common->update('mst_sales_person',$data,array( 'sales_person_id' => $sales_person_id ));
			if($update){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Sales Person Edited',
					'operation_details'	=> 'Sales Person Edited By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' => 'success',
					'message' => 'Sales Person updated Successfully'
				);
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Sales Person update failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('Sales Person_list'));
		}else{
			$data['sales_persons'] = $this->common->get_array('mst_sales_person',array('sales_person_id' => $sales_person_id ));
			$this->template->build('masters/sales_person',$data);
		}
	}
	//SALES PERSON DELETE 
	public function sales_person_delete($sales_person_id){
		$update['updated_on'] = updated_on();
		$update['updated_by'] = created_by();
		$update['status'] = 0;
		$response = $this->common->delete('mst_sales_person',$update,array('sales_person_id' => $sales_person_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'log_category_id'	=> 18,
				'operation'			=> 'Sales Person Deleted',
				'operation_details'	=> 'Sales Person Deleted By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('sales_person_list'));
	}
	//ADD CUSTOMERS
	public function new_customer(){ 
		if($this->input->post()){
			$data = $this->input->post();
			$data['company_id'] = $this->session->userdata('company_id');
			$data['created_on']	= created_on();
			$data['created_by'] = created_by();
			$data['status']		= 1;
			$customer_id = $this->common->insert('mst_customers',$data);
			if($customer_id){
				$message = array(
					'result' 	=> 'Success',
					'message' 	=> 'Customer Added Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> 'Failed',
					'message' 	=> 'Customer Adding Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect('customer_list');
		}else{
			$this->template->build('masters/customers');
		}
	}
	//CUSTOMER LIST
	public function customer_list(){
		$data['customers'] = $this->common->gets_array('mst_customers',array('status' => 1));
		$this->template->build('masters/customer_list',$data);
	}
	//CUSTOMER EDIT
	public function customer_edit($customer_id){
		if($this->input->post()){
			$data = $this->input->post();
			$data['company_id'] = $this->session->userdata('company_id');
			$data['updated_on']	= updated_on();
			$data['updated_by'] = created_by();
			$data['status']		= 1;
			//echo "<pre>";print_r($data);exit;
			$customer_id = $this->common->update('mst_customers',$data,array('customer_id' => $customer_id));
			if($customer_id){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'branch_id'			=> $this->session->userdata('branch_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Customer Edited',
					'operation_details'	=> 'Customer Edited By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'customer_id'		=> $customer_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> "Success",
					'message' 	=> 'Customer Details Updated Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> "Failes",
					'message' 	=> 'Customer Details Updated Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect ('customer_list');
		}else{
			$data['customers'] = $this->common->get_array('mst_customers',array('customer_id' => $customer_id));
			//echo "<pre>";print_r($data);exit;
			$this->template->build('masters/customers',$data);
		}
	}
	//CUSTOMER DELETE
	public function customer_delete($customer_id){
		$update['updated_on'] = updated_on();
		$update['updated_by'] = created_by();
		$update['status'] = 0;
		$response = $this->common->delete('mst_customers',$update,array('customer_id' => $customer_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'branch_id'			=> $this->session->userdata('branch_id'),
				'log_category_id'	=> 18,
				'operation'			=> 'Customer Deleted',
				'operation_details'	=> 'Customer Deleted By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				'customer_id'		=> $customer_id,
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('customer_list'));
	}
	//CUSTOMER POPUP
	public function customer_popup(){
		if($this->input->post()){
			$data 				= $this->input->post();
			$data['company_id'] = $this->session->userdata('company_id');
			$data['created_on'] = created_on();
			$data['created_by'] = created_by();
			$data['status'] 	= 1;
			$insert = $this->common->insert('mst_customers',$data);
			if($insert){
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'Customer created Successfully'
				);
				$this->session->set_userdata('msg',$message);
				echo json_encode(array('result' => 'success','message' => 'Customer created Successfully' ));
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Customer creation failed'
				);
				$this->session->set_userdata('msg',$message);
				echo json_encode(array('result' => 'failed','message' => 'Customer creation failed' ));
			}
		}else{
			$html = $this->load->view('masters/customer_form',array(),true);
			echo $html;
		}
	}	
	//ADD SUPPLIER 
	public function new_supplier(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['company_id'] = $this->session->userdata('company_id');
			$data['created_on']	= created_on();
			$data['created_by']	= created_by();
			$data['status']		= 1;
			$supplier_id = $this->common->insert('mst_suppliers',$data);
			if($supplier_id){
				$message = array(
					'result'  => 'Success',
					'message' => 'Supplier Added Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result'	=> 'Success',
					'message'	=>	'Supplier Adding Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect('supplier_list');
		}else{
			$this->template->build('masters/supplier');
		}
	}
	//SUPPLIER LIST
	public function supplier_list(){
		$data['suppliers']	=	$this->common->gets_array('mst_suppliers',array('status' => 1));
		$this->template->build('masters/supplier_list',$data);
	}
	//SUPPLIER POPUP
	public function supplier_popup(){
		if($this->input->post()){
			$data 				= $this->input->post();
			$data['company_id'] = $this->session->userdata('company_id');
			$data['created_on'] = created_on();
			$data['created_by'] = created_by();
			$data['status'] 	= 1;
			$insert = $this->common->insert('mst_suppliers',$data);
			if($insert){
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'Supplier created Successfully'
				);
				$this->session->set_userdata('msg',$message);
				echo json_encode(array('result' => 'success','message' => 'Supplier created Successfully' ));
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Supplier creation failed'
				);
				$this->session->set_userdata('msg',$message);
				echo json_encode(array('result' => 'failed','message' => 'Supplier creation failed' ));
			}
		}else{
			$html = $this->load->view('masters/supplier_form',array(),true);
			echo $html;
		}
	}
	//SUPPLIER EDIT
	public function supplier_edit($supplier_id){
		if($this->input->post()){
			$data = $this->input->post();
			$data['company_id'] = $this->session->userdata('company_id');
			$data['updated_on']	= updated_on();
			$data['updated_by'] = created_by();
			$data['status']		= 1;
			$supplier_id = $this->common->update('mst_suppliers',$data,array('supplier_id' => $supplier_id));
			if($supplier_id){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'branch_id'			=> $this->session->userdata('branch_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Supplier Edited',
					'operation_details'	=> 'Supplier Edited By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'supplier_id'		=> $supplier_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> "Success",
					'message' 	=> 'Supplier Details Updated Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> "Failes",
					'message' 	=> 'Supplier Details Updated Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect ('supplier_list');
		}else{
			$data['suppliers'] = $this->common->get_array('mst_suppliers',array('supplier_id' => $supplier_id));
			//echo "<pre>";print_r($data);exit;
			$this->template->build('masters/supplier',$data);
		}
	}
	//SUPPLIER DELETE
	public function supplier_delete($supplier_id){
		$update['updated_on'] = updated_on();
		$update['updated_by'] = created_by();
		$update['status'] = 0;
		$response = $this->common->delete('mst_suppliers',$update,array('supplier_id' => $supplier_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'branch_id'			=> $this->session->userdata('branch_id'),
				'log_category_id'	=> 18,
				'operation'			=> 'Supplier Deleted',
				'operation_details'	=> 'Supplier Deleted By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				'supplier_id'		=> $supplier_id,
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('supplier_list'));
	}
	//ADD SIZE
	public function size(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['created_on'] = created_on();
			$data['created_by']	= created_by();
			$data['status']		= 1;
			$size_id = $this->common->insert('mst_sizes',$data);
			if($size_id){
				$message = array(
					'result' => 'Success',
					'message'=> 'Size Added Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' => 'Failed',
					'message'=> 'Size Added Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect('size_list');
		}else{
			$this->template->build('masters/size');
		}
	}
	//SIZE LIST
	public function size_list(){
		$data['sizes'] = $this->common->gets_array('mst_sizes',array('status' => 1));
		$this->template->build('masters/size_list',$data);
	}
	//SIZE EDIT
	public function size_edit($size_id){
		if($this->input->post()){
			$data = $this->input->post();
			$data['updated_on']	= updated_on();
			$data['updated_by'] = created_by();
			$data['status']		= 1;
			$size_id = $this->common->update('mst_sizes',$data,array('size_id' => $size_id));
			if($size_id){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'branch_id'			=> $this->session->userdata('branch_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Size Edited',
					'operation_details'	=> 'Size Edited By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> "Success",
					'message' 	=> 'Size Details Updated Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> "Failes",
					'message' 	=> 'Size Details Updated Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect ('size_list');
		}else{
			$data['sizes'] = $this->common->get_array('mst_sizes',array('size_id' => $size_id));
			//echo "<pre>";print_r($data);exit;
			$this->template->build('masters/size',$data);
		}
	}
	//SIZE DELETE
	public function size_delete($size_id){
		$update['updated_on'] = updated_on();
		$update['updated_by'] = created_by();
		$update['status'] = 0;
		$response = $this->common->delete('mst_sizes',$update,array('size_id' => $size_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'branch_id'			=> $this->session->userdata('branch_id'),
				'log_category_id'	=> 18,
				'operation'			=> 'Size Deleted',
				'operation_details'	=> 'Size Deleted By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('size_list'));
	}
	//ADD UNIT
	public function unit(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['created_on'] = created_on();
			$data['created_by']	= created_by();
			$data['status']		= 1;
			$unit_id = $this->common->insert('mst_units',$data);
			if($unit_id){
				$message = array(
					'result' => 'Success',
					'message'=> 'Unit Added Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' => 'Failed',
					'message'=> 'Unit Added Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect('unit_list');
		}else{
			$this->template->build('masters/unit');
		}
	}
	//UNIT LIST
	public function unit_list(){
		$data['units'] = $this->common->gets_array('mst_units',array('status' => 1));
		$this->template->build('masters/unit_list',$data);
	}
	//UNIT EDIT
	public function unit_edit($unit_id){
		if($this->input->post()){
			$data = $this->input->post();
			$data['updated_on']	= updated_on();
			$data['updated_by'] = created_by();
			$data['status']		= 1;
			$unit_id = $this->common->update('mst_units',$data,array('unit_id' => $unit_id));
			if($unit_id){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'branch_id'			=> $this->session->userdata('branch_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Unit Edited',
					'operation_details'	=> 'Unit Edited By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> "Success",
					'message' 	=> 'Unit Details Updated Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> "Failes",
					'message' 	=> 'Unit Details Updated Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect ('unit_list');
		}else{
			$data['units'] = $this->common->get_array('mst_units',array('unit_id' => $unit_id));
			//echo "<pre>";print_r($data);exit;
			$this->template->build('masters/unit',$data);
		}
	}
	//UNIT DELETE
	public function unit_delete($unit_id){
		$update['updated_on'] = updated_on();
		$update['updated_by'] = created_by();
		$update['status'] = 0;
		$response = $this->common->delete('mst_units',$update,array('unit_id' => $unit_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'branch_id'			=> $this->session->userdata('branch_id'),
				'log_category_id'	=> 18,
				'operation'			=> 'Unit Deleted',
				'operation_details'	=> 'Unit Deleted By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('unit_list'));
	}
	//ADD COLOUR
	public function colour(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['created_on'] = created_on();
			$data['created_by']	= created_by();
			$data['status']		= 1;
			$colour_id = $this->common->insert('mst_colours',$data);
			if($colour_id){
				$message = array(
					'result' => 'Success',
					'message'=> 'Colour Added Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' => 'Failed',
					'message'=> 'Colour Added Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect('colour_list');
		}else{
			$this->template->build('masters/colour');
		}
	}
	//COLOUR LIST
	public function colour_list(){
		$data['colours'] = $this->common->gets_array('mst_colours',array('status' => 1));
		$this->template->build('masters/colour_list',$data);
	}
	//COLOUR EDIT
	public function colour_edit($colour_id){
		if($this->input->post()){
			$data = $this->input->post();
			$data['updated_on']	= updated_on();
			$data['updated_by'] = created_by();
			$data['status']		= 1;
			$colour_id = $this->common->update('mst_colours',$data,array('colour_id' => $colour_id));
			if($colour_id){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'branch_id'			=> $this->session->userdata('branch_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Colour Edited',
					'operation_details'	=> 'Colour Edited By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> "Success",
					'message' 	=> 'Colour Details Updated Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> "Failes",
					'message' 	=> 'Colour Details Updated Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect ('colour_list');
		}else{
			$data['colours'] = $this->common->get_array('mst_colours',array('colour_id' => $colour_id));
			//echo "<pre>";print_r($data);exit;
			$this->template->build('masters/colour',$data);
		}
	}
	//COLOUR DELETE
	public function colour_delete($colour_id){
		$update['updated_on'] = updated_on();
		$update['updated_by'] = created_by();
		$update['status'] = 0;
		$response = $this->common->delete('mst_colours',$update,array('colour_id' => $colour_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'branch_id'			=> $this->session->userdata('branch_id'),
				'log_category_id'	=> 18,
				'operation'			=> 'Colour Deleted',
				'operation_details'	=> 'Colour Deleted By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				'supplier_id'		=> $supplier_id,
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('colour_list'));
	}
	//ADD Secondary Unit
	public function secondary_unit(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['created_on'] = created_on();
			$data['created_by']	= created_by();
			$data['status']		= 1;
			$secondary_unit_id = $this->common->insert('mst_secondary_units',$data);
			if($secondary_unit_id){
				$message = array(
					'result' => 'Success',
					'message'=> 'Secondary Unit Added Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' => 'Failed',
					'message'=> 'Secondary Unit Added Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect('secondary_unit_list');
		}else{
			$this->template->build('masters/secondary_unit');
		}
	}
	//Secondary Unit LIST
	public function secondary_unit_list(){
		$data['secondary_units'] = $this->common->gets_array('mst_secondary_units',array('status' => 1));
		$this->template->build('masters/secondary_unit_list',$data);
	}
	//Secondary Unit EDIT
	public function secondary_unit_edit($secondary_unit_id){
		if($this->input->post()){
			$data = $this->input->post();
			$data['updated_on']	= updated_on();
			$data['updated_by'] = created_by();
			$data['status']		= 1;
			$secondary_unit_id = $this->common->update('mst_secondary_units',$data,array('secondary_unit_id' => $secondary_unit_id));
			if($secondary_unit_id){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'branch_id'			=> $this->session->userdata('branch_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Secondary Unit Edited',
					'operation_details'	=> 'Secondary Unit Edited By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> "Success",
					'message' 	=> 'Secondary Unit Details Updated Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> "Failes",
					'message' 	=> 'Secondary Unit Details Updated Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect ('secondary_unit_list');
		}else{
			$data['secondary_units'] = $this->common->get_array('mst_secondary_units',array('secondary_unit_id' => $secondary_unit_id));
			//echo "<pre>";print_r($data);exit;
			$this->template->build('masters/secondary_unit',$data);
		}
	}
	//Secondary Unit DELETE
	public function secondary_unit_delete($secondary_unit_id){
		$update['updated_on'] = updated_on();
		$update['updated_by'] = created_by();
		$update['status'] = 0;
		$response = $this->common->delete('mst_secondary_units',$update,array('secondary_unit_id' => $secondary_unit_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'branch_id'			=> $this->session->userdata('branch_id'),
				'log_category_id'	=> 18,
				'operation'			=> 'Secondary Unit Deleted',
				'operation_details'	=> 'Secondary Unit Deleted By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('secondary_unit_list'));
	}
	//ADD TAX
	public function tax(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['created_on'] = created_on();
			$data['created_by']	= created_by();
			$data['status']		= 1;
			$tax_id = $this->common->insert('mst_taxs',$data);
			if($tax_id){
				$message = array(
					'result' => 'Success',
					'message'=> 'Tax Added Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' => 'Failed',
					'message'=> 'Tax Added Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect('tax_list');
		}else{
			$this->template->build('masters/tax');
		}
	}
	//TAX LIST
	public function tax_list(){
		$data['taxs'] = $this->common->gets_array('mst_taxs',array('status' => 1));
		$this->template->build('masters/tax_list',$data);
	}
	//TAX EDIT
	public function tax_edit($tax_id){
		if($this->input->post()){
			$data = $this->input->post();
			$data['updated_on']	= updated_on();
			$data['updated_by'] = created_by();
			$data['status']		= 1;
			$tax_id = $this->common->update('mst_taxs',$data,array('tax_id' => $tax_id));
			if($tax_id){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'branch_id'			=> $this->session->userdata('branch_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Tax Edited',
					'operation_details'	=> 'Tax Edited By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> "Success",
					'message' 	=> 'Tax Details Updated Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> "Failes",
					'message' 	=> 'Tax Details Updated Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect ('tax_list');
		}else{
			$data['taxs'] = $this->common->get_array('mst_taxs',array('tax_id' => $tax_id));
			//echo "<pre>";print_r($data);exit;
			$this->template->build('masters/tax',$data);
		}
	}
	//TAX DELETE
	public function tax_delete($tax_id){
		$update['updated_on'] = updated_on();
		$update['updated_by'] = created_by();
		$update['status'] = 0;
		$response = $this->common->delete('mst_taxs',$update,array('tax_id' => $tax_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'branch_id'			=> $this->session->userdata('branch_id'),
				'log_category_id'	=> 18,
				'operation'			=> 'Tax Deleted',
				'operation_details'	=> 'Tax Deleted By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('tax_list'));
	}
	//ADD EXPENSES CATEGORY
	public function expenses_category(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['created_on'] = created_on();
			$data['created_by']	= created_by();
			$data['status']		= 1;
			$expense_category_id = $this->common->insert('mst_expense_categories',$data);
			if($expense_category_id){
				$message = array(
					'result' => 'Success',
					'message'=> 'Expenses Category Added Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' => 'Failed',
					'message'=> 'Expenses Category Added Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect('expenses_category_list');
		}else{
			$this->template->build('masters/expenses_category');
		}
	}
	//EXPENSES CATEGORY LIST
	public function expenses_category_list(){
		$data['expenses_categories'] = $this->common->gets_array('mst_expense_categories',array('status' => 1));
		$this->template->build('masters/expenses_category_list',$data);
	}
	//EXPENSES CATEGORY  EDIT
	public function expenses_category_edit($expense_category_id){
		if($this->input->post()){
			$data = $this->input->post();
			$data['updated_on']	= updated_on();
			$data['status']		= 1;
			$expense_category_id = $this->common->update('mst_expense_categories',$data,array('expense_category_id' => $expense_category_id));
			if($expense_category_id){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'branch_id'			=> $this->session->userdata('branch_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Expenses Category Edited',
					'operation_details'	=> 'Expenses Category Edited By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> "Success",
					'message' 	=> 'Expenses Category Details Updated Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> "Failes",
					'message' 	=> 'Expenses Category Details Updated Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect ('expenses_category_list');
		}else{
			$data['expenses_categories'] = $this->common->get_array('mst_expense_categories',array('expense_category_id' => $expense_category_id));
			//echo "<pre>";print_r($data);exit;
			$this->template->build('masters/expenses_category',$data);
		}
	}
	//EXPENSES CATEGORY  DELETE
	public function expenses_category_delete($expense_category_id){
		$update['updated_on'] = updated_on();
		$update['status'] = 0;
		$response = $this->common->delete('mst_expense_categories',$update,array('expense_category_id' => $expense_category_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'branch_id'			=> $this->session->userdata('branch_id'),
				'log_category_id'	=> 18,
				'operation'			=> 'Expenses Category Deleted',
				'operation_details'	=> 'Expenses Category Deleted By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('expenses_category_list'));
	}
	//ADD TRANSPORT
	public function transport(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['created_on'] = created_on();
			$data['created_by']	= created_by();
			$data['status']		= 1;
			$transport_id = $this->common->insert('mst_transports',$data);
			if($transport_id){
				$message = array(
					'result' => 'Success',
					'message'=> 'Transport Details Added Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' => 'Failed',
					'message'=> 'Transport Details Added Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect('transport_list');
		}else{
			$this->template->build('masters/transport');
		}
	}
	//TRANSPORT LIST
	public function transport_list(){
		$data['transports'] = $this->common->gets_array('mst_transports',array('status' => 1));
		$this->template->build('masters/transport_list',$data);
	}
	//TRANSPORT EDIT
	public function transport_edit($transport_id){
		if($this->input->post()){
			$data = $this->input->post();
			$data['updated_on']	= updated_on();
			$data['updated_by'] = created_by();
			$data['status']		= 1;
			$transport_id = $this->common->update('mst_transports',$data,array('transport_id' => $transport_id));
			if($transport_id){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'branch_id'			=> $this->session->userdata('branch_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Transport Edited',
					'operation_details'	=> 'Transport Edited By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> "Success",
					'message' 	=> 'Transport Details Updated Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> "Failes",
					'message' 	=> 'Transport Details Updated Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect ('transport_list');
		}else{
			$data['transports'] = $this->common->get_array('mst_transports',array('transport_id' => $transport_id));
			//echo "<pre>";print_r($data);exit;
			$this->template->build('masters/transport',$data);
		}
	}
	//TRANSPORT DELETE
	public function transport_delete($transport_id){
		$update['updated_on'] = updated_on();
		$update['updated_by'] = created_by();
		$update['status'] = 0;
		$response = $this->common->delete('mst_transports',$update,array('transport_id' => $transport_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'branch_id'			=> $this->session->userdata('branch_id'),
				'log_category_id'	=> 18,
				'operation'			=> 'Transport Deleted',
				'operation_details'	=> 'Transport Deleted By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('transport_list'));
	}
	//ADD BRAND
	public function brand(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['created_on'] = created_on();
			$data['created_by']	= created_by();
			$data['status']		= 1;
			$brand_id = $this->common->insert('mst_brands',$data);
			if($brand_id){
				$message = array(
					'result' => 'Success',
					'message'=> 'Brand Added Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' => 'Failed',
					'message'=> 'Brand Added Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect('brand_list');
		}else{
			$this->template->build('masters/brand');
		}
	}
	//BRAND LIST
	public function brand_list(){
		$data['brands'] = $this->common->gets_array('mst_brands',array('status' => 1));
		$this->template->build('masters/brand_list',$data);
	}
	//BRAND EDIT
	public function brand_edit($brand_id){
		if($this->input->post()){
			$data = $this->input->post();
			$data['updated_on']	= updated_on();
			$data['updated_by'] = created_by();
			$data['status']		= 1;
			$brand_id = $this->common->update('mst_brands',$data,array('brand_id' => $brand_id));
			if($brand_id){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'branch_id'			=> $this->session->userdata('branch_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Brand Edited',
					'operation_details'	=> 'Brand Edited By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> "Success",
					'message' 	=> 'Brand Details Updated Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> "Failes",
					'message' 	=> 'Brand Details Updated Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect ('brand_list');
		}else{
			$data['brands'] = $this->common->get_array('mst_brands',array('brand_id' => $brand_id));
			//echo "<pre>";print_r($data);exit;
			$this->template->build('masters/brand',$data);
		}
	}
	//BRAND DELETE
	public function brand_delete($brand_id){
		$update['updated_on'] = updated_on();
		$update['updated_by'] = created_by();
		$update['status'] = 0;
		$response = $this->common->delete('mst_brands',$update,array('brand_id' => $brand_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'branch_id'			=> $this->session->userdata('branch_id'),
				'log_category_id'	=> 18,
				'operation'			=> 'Brand Deleted',
				'operation_details'	=> 'Brand Deleted By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('brand_list'));
	}
	//ADD CATEGORY
	public function category(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['created_on'] = created_on();
			$data['created_by']	= created_by();
			$data['status']		= 1;
			$category_id = $this->common->insert('mst_category',$data);
			if($category_id){
				$message = array(
					'result' => 'Success',
					'message'=> 'Category Added Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' => 'Failed',
					'message'=> 'Category Added Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect('category_list');
		}else{
			$this->template->build('masters/category');
		}
	}
	//CATEGORY LIST
	public function category_list(){
		$data['categories'] = $this->common->gets_array('mst_category',array('status' => 1));
		$this->template->build('masters/category_list',$data);
	}
	//CATEGORY EDIT
	public function category_edit($category_id){
		if($this->input->post()){
			$data = $this->input->post();
			$data['updated_on']	= updated_on();
			$data['updated_by'] = created_by();
			$data['status']		= 1;
			$category_id = $this->common->update('mst_category',$data,array('category_id' => $category_id));
			if($category_id){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'branch_id'			=> $this->session->userdata('branch_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Category Edited',
					'operation_details'	=> 'Category Edited By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> "Success",
					'message' 	=> 'Category Details Updated Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> "Failes",
					'message' 	=> 'Category Details Updated Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect ('category_list');
		}else{
			$data['categories'] = $this->common->get_array('mst_category',array('category_id' => $category_id));
			//echo "<pre>";print_r($data);exit;
			$this->template->build('masters/category',$data);
		}
	}
	//CATEGORY DELETE
	public function category_delete($category_id){
		$update['updated_on'] = updated_on();
		$update['updated_by'] = created_by();
		$update['status'] = 0;
		$response = $this->common->delete('mst_category',$update,array('category_id' => $category_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'branch_id'			=> $this->session->userdata('branch_id'),
				'log_category_id'	=> 18,
				'operation'			=> 'Category Deleted',
				'operation_details'	=> 'Category Deleted By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('category_list'));
	}
	//ADD SUB CATEGORY
	public function sub_category(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['created_on'] = created_on();
			$data['created_by']	= created_by();
			$data['status']		= 1;
			$sub_category_id = $this->common->insert('mst_subcategory',$data);
			if($sub_category_id){
				$message = array(
					'result' => 'Success',
					'message'=> 'Sub Category Added Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' => 'Failed',
					'message'=> 'Sub Category Added Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect('sub_category_list');
		}else{
			$this->template->build('masters/sub_category');
		}
	}
	//SUB CATEGORY LIST
	public function sub_category_list(){
		$data['sub_categories'] = $this->common->gets_array('mst_subcategory',array('status' => 1));
		$this->template->build('masters/sub_category_list',$data);
	}
	//SUB CATEGORY EDIT
	public function sub_category_edit($sub_category_id){
		if($this->input->post()){
			$data = $this->input->post();
			$data['updated_on']	= updated_on();
			$data['updated_by'] = created_by();
			$data['status']		= 1;
			$sub_category_id = $this->common->update('mst_subcategory',$data,array('sub_category_id' => $sub_category_id));
			if($sub_category_id){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'branch_id'			=> $this->session->userdata('branch_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Sub Category Edited',
					'operation_details'	=> 'Sub Category Edited By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> "Success",
					'message' 	=> 'Sub Category Details Updated Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> "Failes",
					'message' 	=> 'Sub Category Details Updated Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect ('sub_category_list');
		}else{
			$data['sub_categories'] = $this->common->get_array('mst_subcategory',array('sub_category_id' => $sub_category_id));
			//echo "<pre>";print_r($data);exit;
			$this->template->build('masters/sub_category',$data);
		}
	}
	//SUB CATEGORY DELETE
	public function sub_category_delete($sub_category_id){
		$update['updated_on'] = updated_on();
		$update['updated_by'] = created_by();
		$update['status'] = 0;
		$response = $this->common->delete('mst_subcategory',$update,array('sub_category_id' => $sub_category_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'branch_id'			=> $this->session->userdata('branch_id'),
				'log_category_id'	=> 18,
				'operation'			=> 'Sub Category Deleted',
				'operation_details'	=> 'Sub Category Deleted By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('sub_category_list'));
	}
	//PREFIX
	public function prefix(){
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);exit;
			$final_result = 0;
			foreach ($data as $key => $value) {
				$update = array('prefix_value' =>$value,'updated_on'=>updated_on());
				$prefix_id = $this->common->update('mst_prefix',array('prefix_value'=>$value[0],'prefix_count'=>$value[1],'prefix_updated_on'=> updated_on()),array('prefix_name'=> $key));
				if($prefix_id){
					$final_result = 1;
				}
			}
			if($final_result==1){
				$message = array(
					'result' => 'success',
					'message' => 'Prefix updated successfully'
				);
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Prefix update failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('prefix'));
		}else{
			$data['headings'] = $this->common->gets_groupby('mst_prefix',array('prefix_status' =>1),'prefix_heading');
			$data['prefixs'] = $this->common->gets('mst_prefix',array('prefix_status' =>1));
			$this->template->build('masters/prefix',$data);
		}
	}
	//ADD SUB MODULE
	public function sub_module(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['status']		= 1;
			$sub_module_id = $this->common->insert('mst_sub_modules',$data);
			if($sub_module_id){
				$message = array(
					'result' => 'Success',
					'message'=> 'Sub Module Added Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' => 'Failed',
					'message'=> 'Sub Module Added Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect('sub_module_list');
		}else{
			$this->template->build('masters/sub_module');
		}
	}
	//SUB MODULE LIST
	public function sub_module_list(){
		$data['sub_modules'] = $this->common->gets_array('mst_sub_modules',array('status' => 1));
		$this->template->build('masters/sub_module_list',$data);
	}
	//SUB MODULE EDIT
	public function sub_module_edit($sub_module_id){
		if($this->input->post()){
			$data = $this->input->post();
			$data['status']		= 1;
			$sub_module_id = $this->common->update('mst_sub_modules',$data,array('sub_module_id' => $sub_module_id));
			if($sub_module_id){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'branch_id'			=> $this->session->userdata('branch_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Sub Module Edited',
					'operation_details'	=> 'Sub Module Edited By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> "Success",
					'message' 	=> 'Sub Module Details Updated Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> "Failes",
					'message' 	=> 'Sub Module Details Updated Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect ('sub_module_list');
		}else{
			$data['module'] = $this->common->get_array('mst_sub_modules',array('sub_module_id' => $sub_module_id));
			//echo "<pre>";print_r($data);exit;
			$this->template->build('masters/sub_module',$data);
		}
	}
	//SUB MODULE DELETE
	public function sub_module_delete($sub_module_id){
		$update['status'] = 0;
		$response = $this->common->delete('mst_sub_modules',$update,array('sub_module_id' => $sub_module_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'branch_id'			=> $this->session->userdata('branch_id'),
				'log_category_id'	=> 18,
				'operation'			=> 'Sub Module Deleted',
				'operation_details'	=> 'Sub Module Deleted By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('sub_module_list'));
	}

	public function access_level_list(){
		$data['lists'] = $this->common->gets_array('mst_access_levels',array( 'status !=' => 0));
		$this->template->build('masters/access_level/access_level_list',$data);
	}
	public function access_level(){
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);exit;
			$access_level = array(
				'access_level_name'	=> strtoupper($data['access_level_name']),
				'modules'			=> implode(',',$data['modules']),
				'created_on'		=> created_on(),
				'created_by'		=> created_by(),
				'status'			=> 1
			);
			if(isset($data['submodules'])){
				$access_level['submodules'] = implode(',',$data['submodules']);
			}
			$access_level_id = $this->common->insert('mst_access_levels',$access_level);
			if($access_level_id){
				$message = array(
					'result' => 'success',
					'message' => 'Access Level Created Successfully'
				);
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Access Level Creation Failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('access_level_list'));
		}else{
			$data = array();
			$this->template->build('masters/access_level/access_level',$data);
		}
	}
	public function access_level_update($access_level_id){
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);exit;
			$update = array(
				'access_level_name'	=> strtoupper($data['access_level_name']),
				'modules'			=> implode(',',$data['modules']),
				'updated_on'		=> created_on(),
				'updated_by'		=> created_by()
			);
			if(isset($data['submodules'])){
				$update['submodules'] = implode(',',$data['submodules']);
			}
			$update_result = $this->common->update('mst_access_levels',$update,array('access_level_id' => $access_level_id));
			if($update_result ){
				$message = array(
					'result'	=> 'success',
					'message'	=> 'Access Level Updated Successfully'
				);
			}else{
				$message = array(
					'result'	=> 'failed',
					'message'	=> 'Access Level Update Failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('access_level_list'));
		}else{
			$data['access_level'] = $this->common->get_array('mst_access_levels',array( 'access_level_id' => $access_level_id));
			$this->template->build('masters/access_level/access_level',$data);
		}
	}
	public function access_level_block($access_level_id){
		$update = array(
			'status'		=> -1,
			'updated_on'	=> created_on(),
			'updated_by'	=> created_by()
		);
		$update_result = $this->common->update('mst_access_levels',$update,array('access_level_id' => $access_level_id));
		if($update_result ){
			$update = array(
				'status'		=> -1,
				'updated_on'	=> created_on(),
				'updated_by'	=> created_by()
			);
			$update_result = $this->common->update('mst_users',$update,array('access_level' => $access_level_id));
			$message = array(
				'result'	=> 'success',
				'message'	=> 'Access Level Blocked Successfully'
			);
		}else{
			$message = array(
				'result'	=> 'failed',
				'message'	=> 'Access Level Block Failed'
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('access_level_list'));
	}
	public function access_level_unblock($access_level_id){
		$update = array(
			'status'		=> 1,
			'updated_on'	=> created_on(),
			'updated_by'	=> created_by()
		);
		$update_result = $this->common->update('mst_access_levels',$update,array('access_level_id' => $access_level_id));
		if($update_result ){
			$message = array(
				'result'	=> 'success',
				'message'	=> 'Access Level Unblocked Successfully'
			);
		}else{
			$message = array(
				'result'	=> 'failed',
				'message'	=> 'Access Level Unblock Failed'
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('access_level_list'));
	}
	//ADD PRODUCT TYPE
	public function product_type(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['created_on'] = created_on();
			$data['created_by']	= created_by();
			$data['status']		= 1;
			$product_type_id = $this->common->insert('mst_product_type',$data);
			if($product_type_id){
				$message = array(
					'result' => 'Success',
					'message'=> 'Product Type Added Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' => 'Failed',
					'message'=> 'Product Type Added Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect('product_type_list');
		}else{
			$this->template->build('masters/product_type');
		}
	}
	//PRODUCT TYPE LIST
	public function product_type_list(){
		$data['product_types'] = $this->common->gets_array('mst_product_type',array('status' => 1));
		$this->template->build('masters/product_type_list',$data);
	}
	//PRODUCT TYPE EDIT
	public function product_type_edit($product_type_id){
		if($this->input->post()){
			$data = $this->input->post();
			if($data['product_type_base'] == "none"){
				$data['product_type_base_value'] = "0";
			}elseif($data['product_type_base'] == "category"){
				$data['product_type_base_value'] = "2";
			}elseif($data['product_type_base'] == "brand"){
				$data['product_type_base_value'] = "1";
			}
			$data['updated_on']	= updated_on();
			$data['updated_by'] = created_by();
			$data['status']		= 1;
			$product_type_id = $this->common->update('mst_product_type',$data,array('product_type_id' => $product_type_id));
			if($product_type_id){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'branch_id'			=> $this->session->userdata('branch_id'),
					'log_category_id'	=> 18,
					'operation'			=> 'Product Type Edited',
					'operation_details'	=> 'Product Type Edited By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> "Success",
					'message' 	=> 'Product Type Details Updated Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> "Failes",
					'message' 	=> 'Product Type Details Updated Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect ('product_type_list');
		}else{
			$data['product_types'] = $this->common->get_array('mst_product_type',array('product_type_id' => $product_type_id));
			//echo "<pre>";print_r($data);exit;
			$this->template->build('masters/product_type',$data);
		}
	}
	//PRODUCT TYPE DELETE
	public function product_type_delete($product_type_id){
		$update['updated_on'] = updated_on();
		$update['updated_by'] = created_by();
		$update['status'] = 0;
		$response = $this->common->delete('mst_product_type',$update,array('product_type_id' => $product_type_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'branch_id'			=> $this->session->userdata('branch_id'),
				'log_category_id'	=> 18,
				'operation'			=> 'Product Type Deleted',
				'operation_details'	=> 'Product Type Deleted By  -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('product_type_list'));
	}
}