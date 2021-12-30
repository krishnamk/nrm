<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('User_model','user');
	}

	public function index(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['password'] = md5($data['password']);
			if($this->common->exists('mst_users',$data)){
				$user_details = $this->common->get('mst_users',$data);
				//echo "<pre>";print_r($user_details);exit;
				if($user_details->status == 1){
					$user_session = array(
						'user_id' 			=> $user_details->user_id,
						'company_id' 		=> $user_details->company_id,
						'branch_id' 		=> $user_details->branch_id,
						'user_name' 		=> $user_details->name, 
						'last_login' 		=> $user_details->last_login,
						'access_level' 		=> $user_details->access_level,
						'invoice_logged_in' => 1 );
					$this->session->set_userdata($user_session);
					$this->common->update('mst_users',array('last_login' => date('Y-m-d H:i:s')),
						array('user_id' => $user_details->user_id));
					$message = array(
						'result' 	=> 'Success', 
						'message' 	=> 'Welcome'.$user_details->name
					);
					$this->session->set_userdata('msg',$message);
					redirect(base_url('dashboard'));
				}else{
					$message = array(
						'result' 	=> 'Failed',
						'message' 	=> 'Your not a valid user'
					);
				}
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> 'Failed',
					'message' 	=> 'Invalid Username or password'
				);
			}
			$this->session->set_userdata('msg',$message);
			$this->load->view('login',$data);
		}else{
			$this->load->view('login');
		}
	}

	public function forget_password(){
		$this->load->view('forget_password');
	}

	public function dashboard(){
		if(!$this->session->userdata('invoice_logged_in')){
			redirect('login','refresh');
		}
		$this->load->model('User_model','user');
		$data['total_invoices'] = $this->common->count('tbl_invoices','status!=0');
		$data['total_dcs'] = $this->common->count('tbl_dcs','status!=0');
		$data['total_estimates'] = $this->common->count('tbl_estimates','status!=0');
		$data['total_purchase'] = $this->common->count('tbl_purchase','status!=0');
		$data['tbl_quotations'] = $this->common->count('tbl_quotations','status!=0');
		$data['total_products'] = $this->common->count('mst_products','status!=0');
		$data['total_customers'] = $this->common->count('mst_customers','status!=0');
		$data['total_suppliers'] = $this->common->count('mst_suppliers','status!=0');
		$data['invoice_details'] = $this->user->get_invoice_list();
		$data['purchase_order_details'] = $this->user->get_purchase_order_details();
		//echo "<pre>";print_r($data['purchase_order_details']);exit;
		$data['total_invoice_payments'] = $this->user->get_invoice_payments_details();
		$data['total_pending_payments'] = $this->user->get_invoice_pending_payments_details();
		$data['total_purchase_payments'] = $this->user->get_purchase_payments_details();
		$data['total_purchase_pending_payments'] = $this->user->get_purchase_pending_payments_details();
		$this->template->build('dashboard',$data);
		$this->template->build('dashboard');
	}

	public function get_datewise_details($data = array()){
		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');
		$data['total_invoices'] = $this->user->invoice_count($date_from,$date_to);
		$data['total_dcs'] = $this->user->dc_count($date_from,$date_to);
		$data['total_estimates'] = $this->user->estimate_count($date_from,$date_to);
		$data['total_purchase'] = $this->user->purchase_count($date_from,$date_to);
		$data['tbl_quotations'] = $this->user->quotation_count($date_from,$date_to);
		$data['total_products'] = $this->user->product_count($date_from,$date_to);
		$data['total_customers'] = $this->user->customer_count($date_from,$date_to);
		$data['total_suppliers'] = $this->user->supplier_count($date_from,$date_to);
		$data['invoice_details'] = $this->user->get_invoice_lists($date_from,$date_to);
		$data['total_invoice_payments'] = sprintf("%.2f",$this->user->get_invoice_payments_detail($date_from,$date_to));
		$data['total_pending_payments'] = sprintf("%.2f",$this->user->get_invoice_pending_payments_detail($date_from,$date_to));
		$data['balance_amount'] = sprintf("%.2f",$data['total_invoice_payments'] - $data['total_pending_payments']);
		$data['total_purchase_payments'] = sprintf("%.2f",$this->user->get_purchase_payments_detail($date_from,$date_to));
		$data['total_purchase_pending_payments'] = sprintf("%.2f",$this->user->get_purchase_pending_payments_detail($date_from,$date_to));
		$data['purchase_balance_amount'] = sprintf("%.2f",$data['total_purchase_payments'] - $data['total_purchase_pending_payments']);
		echo json_encode($data);
	}

	public function logout(){
		session_destroy();
		$message = array(
			'result' 	=> 'Success',
			'message' 	=>	'Logout Successfully'
		);
		$this->session->set_userdata('msg',$message);
		redirect ('login','refresh');
	}

	//User List
	public function user_list(){
		if(!$this->session->userdata('invoice_logged_in')){
			redirect(base_url('logout'));
		}
		$data['lists'] = $this->user->get_user_details();
		//echo '<pre>';print_r($data);exit;
		$this->template->build('user/user_list',$data);
	}

	//Add User
	public function new_user(){
		if($this->input->post()){
			$data = $this->input->post();
			$access_level = $this->session->userdata('access_level');
			$data['rev_str'] = strrev($data['password']);
			$data['password'] = md5($data['password']);
			if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){
				$user = array(
					'name'				=>	$data['name'],
					'email'				=>	$data['email'],
					'mobile'			=>	$data['mobile'],
					'phone'				=>  $data['phone'],
					'user_login'		=>  $data['user_login'],
					'last_login'		=>  created_on(),
					'access_level'		=>	$data['access_level'],
					'access_company'	=>  implode(',',$data['access_company']),
					'username'			=>  $data['username'],
					'password'			=> 	$data['password'],
					'rev_str'			=>  $data['rev_str'],
					'modules'			=> implode(',',$data['modules']),
					'created_on'		=>	created_on(),
					'created_by'		=>	created_by(),
					'status'			=>	1
				);
				if(isset($data['submodules'])){
					$user['submodules'] 	= implode(',',$data['submodules']);
				}
			}else{
				$user = array(
					'name'				=>	$data['name'],
					'company_id'		=>	$data['company_id'],
					'email'				=>	$data['email'],
					'mobile'			=>	$data['mobile'],
					'phone'				=>  $data['phone'],
					'user_login'		=>  $data['user_login'],
					'last_login'		=>  created_on(),
					'access_level'		=>	$data['access_level'],
					'access_company'	=>  $data['company_id'],
					'username'			=>  $data['username'],
					'password'			=> 	$data['password'],
					'rev_str'			=>  $data['rev_str'],
					'modules'			=> implode(',',$data['modules']),
					'created_on'		=>	created_on(),
					'created_by'		=>	created_by(),
					'status'			=>	1
				);
				if(isset($data['submodules'])){
					$user['submodules'] 	= implode(',',$data['submodules']);
				}
			}
			$user_id = $this->common->insert('mst_users',$user);
			if($user_id){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $this->session->userdata('company_id'),
					'branch_id'			=> $this->session->userdata('branch_id'),
					'log_category_id'	=> 17,
					'operation'			=> 'New user Created',
					'operation_details'	=> 'New user Created -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'user_id'			=> $user_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' => 'success',
					'message' => 'User inserted successfully'
				);
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'User insert failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('user_list'));
		}else{
			$data['company_lists'] = $this->user->get_current_user_companies();
			//echo "<pre>";print_r($data);exit;
			$this->template->build('user/new_user',$data);
		}
	}
	public function user_edit($user_id){
		if($this->input->post()){
			$user_details = $this->user->get_user_details();
			$data = $this->input->post();
			//echo "<pre>";print_r($data);exit;
			$access_level = $this->session->userdata('access_level');
			$data['rev_str'] = strrev($data['password']);
			$data['password'] = md5($data['password']);
			if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){
				$user = array(
					'name'				=>	$data['name'],
					'email'				=>	$data['email'],
					'mobile'			=>	$data['mobile'],
					'user_login'		=>  $data['user_login'],
					'last_login'		=>  created_on(),
					'access_level'		=>	$data['access_level'],
					'access_company'	=>  implode(',',$data['access_company']),
					'username'			=>  $data['username'],
					'password'			=> 	$data['password'],
					'rev_str'			=>  $data['rev_str'],
					'modules'			=> implode(',',$data['modules']),
					'created_on'		=>	created_on(),
					'created_by'		=>	created_by(),
					'status'			=>	1
				);
				if(isset($data['submodules'])){
					$user['submodules'] = implode(',',$data['submodules']);
				}
			}else{
				$user = array(
					'name'				=>	$data['name'],
					'company_id'		=>	$data['company_id'],
					'email'				=>	$data['email'],
					'mobile'			=>	$data['mobile'],
					'user_login'		=>  $data['user_login'],
					'last_login'		=>  created_on(),
					'access_level'		=>	$data['access_level'],
					'username'			=>  $data['username'],
					'password'			=> 	$data['password'],
					'rev_str'			=>  $data['rev_str'],
					'modules'			=> implode(',',$data['modules']),
					'created_on'		=>	created_on(),
					'created_by'		=>	created_by(),
					'status'			=>	1
				);
				if(isset($data['submodules'])){
					$user['submodules'] = implode(',',$data['submodules']);
				}
			}
			//echo "<pre>";print_r($user);exit;
			$user_id = $this->common->update('mst_users',$user,array('user_id' => $user_id));
			if($user_id){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $this->session->userdata('company_id'),
					'branch_id'			=> $this->session->userdata('branch_id'),
					'log_category_id'	=> 17,
					'operation'			=> 'User Updated',
					'operation_details'	=> 'User Updated-'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'user_id'			=> $user_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' => 'success',
					'message' => 'User Updated successfully'
				);
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'User Updated failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('user_list'));
		}else{
			$data['user'] = $this->common->get_array('mst_users',array('user_id' => $user_id));
			$data['access_level']['modules'] = $data['user']['modules'];
			$data['access_level']['submodules'] = $data['user']['submodules'];
			if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){
				if($this->session->userdata('access_level')==1){
					$data['company_lists'] = array_column($this->user->get_company_list(), 'company_name');
				}elseif($this->session->userdata('access_level')>=2){
					$data['company_lists'] = array_column($this->user->get_current_user_companies(), 'company_name');
				}
			}
			//echo "<pre>";print_r($data['company_lists']);exit;
			$data['temp_products'] = $this->load->view('user/includes/module_access_control', $data, TRUE);
			//echo "<pre>";print_r($data);//exit;
			$this->template->build('user/new_user',$data);
		}
	}
	
	public function user_remove($user_id){
		$update = array('status' => 0 );
		$response = $this->common->delete('mst_users',$update,array('user_id' => $user_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'company_id'		=> $this->session->userdata('company_id'),
				'branch_id'			=> $this->session->userdata('branch_id'),
				'log_category_id'	=> 17,
				'operation'			=> 'User Removed',
				'operation_details'	=> 'User Removed Successfully-'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
				'user_id'			=> $user_id,
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
		redirect(base_url('user_list'));
	}
	public function user_list_ajax(){
		$data = $this->input->post();
		$response = $this->user->get_user_list($data);
		echo json_encode($response);
	}
	public function access_level_list(){
		$data = $this->input->post();
		$data['access_level'] =  $this->common->get_array('mst_access_levels',array('access_level_id' => $data['access_level']));
		//echo "<pre>";print_r($data['access_level']);exit;
		$content = $this->load->view('user/includes/module_access_control', $data, TRUE);
		if($content){
			$message = array(
				'result'	=> 'success',
				'message'	=> 'Access Level Retrived'
			);
		}else{
			$message = array(
				'result'	=> 'failed',
				'message'	=> 'Access Level Retrived Failed'
			);
		}
		$message['listings'] = $content;
		$message['display_message'] = return_message($message);
		echo json_encode($message);
	} 

	//GET COMPANIES LIST
	public function get_company_list(){
		$data = $this->user->get_company_list();
		return $data;
	}

	public function get_company_invoice_details(){
		if($this->input->post()){
			$data = $this->input->post();
			$company_detail = $this->common->get_array('company_details',array('company_id' => $data['company_id']));
			if($data['prefix_value'] == "dc_no"){
				$prefix_number = $company_detail['dc_prefix_value'].str_pad($company_detail['dc_prefix_count'],$this->common->get_particular('mst_settings',array('settings_name' => 'invoice_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			}elseif($data['prefix_value'] == "estimate_no"){
				$prefix_number = $company_detail['estimate_prefix_value'].str_pad($company_detail['estimate_prefix_count'],$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			}
			elseif($data['prefix_value'] == "quotation_no"){
				$prefix_number = $company_detail['quotation_prefix_value'].str_pad($company_detail['quotation_prefix_count'],$this->common->get_particular('mst_settings',array('settings_name' => 'quotation_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			}
			elseif($data['prefix_value'] == "invoice_no"){
				$prefix_number = $company_detail['invoice_prefix_value'].str_pad($company_detail['invoice_prefix_count'],$this->common->get_particular('mst_settings',array('settings_name' => 'invoice_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			}
			elseif($data['prefix_value'] == "sales_return_no"){
				$prefix_number = $company_detail['sales_return_prefix_value'].str_pad($company_detail['sales_return_prefix_count'],$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			}
			elseif($data['prefix_value'] == "purchase_no"){
				$prefix_number = $company_detail['purchase_prefix_value'].str_pad($company_detail['purchase_prefix_count'],$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			}
			elseif($data['prefix_value'] == "purchase_order_no"){
				$prefix_number = $company_detail['purchase_order_prefix_value'].str_pad($company_detail['purchase_order_prefix_count'],$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			} 
			elseif($data['prefix_value'] == "purchase_return_no"){
				$prefix_number = $company_detail['purchase_return_prefix_value'].str_pad($company_detail['purchase_return_prefix_count'],$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			}
			elseif($data['prefix_value'] == "purchase_dc_no"){
				$prefix_number = $company_detail['purchase_dc_prefix_value'].str_pad($company_detail['purchase_dc_prefix_count'],$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			}else{
				$prefix_number = $company_detail['expense_prefix_value'].str_pad($company_detail['expense_prefix_count'],$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			}
			echo json_encode(array('result' => 'success', 'prefix_number'=> $prefix_number,'message' =>	'successfully reterived'));
		}else{
			echo json_encode(array('result' => 'failed', 'message' => 'parameters missing' ));
		}
	}
}