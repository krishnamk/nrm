<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Expenses extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Expenses_model','expense');
		$this->load->model('User_model','user');
		if(!$this->session->userdata('invoice_logged_in')){
			redirect('login','refresh');
		}
	}
	public function expenses_list(){
		$data['lists'] = $this->expense->get_expenses_list();
		$this->template->build('expenses/expense_list',$data);
	}
	public function expense(){
		if($this->input->post()){
			$data = $this->input->post();
			$expenses = array(
				'company_id'		=> (isset($data['company_id'])) ? $data['company_id'] : $this->session->userdata('company_id'),
				'expense_number' 	=> $data['expense_number'],
				'expense_date' 		=> $data['expense_date'],
				'expense_category_id' => $data['expense_category_id'],
				'expense_billno' 	=> $data['expense_billno'],
				'expense_amount' 	=> $data['expense_amount'],
				'expense_person' 	=> $data['expense_person'],
				'person_name'		=> $data['person_name'],
				'expense_remark' 	=> $data['expense_remark'],
				'expense_status' 	=> $data['expense_status'],
				'created_on' 		=> created_on(),
				'created_by' 		=> created_by(),
				'status' 			=> 1
			);
			$expense_id = $this->common->insert('tbl_expenses',$expenses);
			if($expense_id){
				$current_count =$this->common->get_particular('company_details',array('company_id' => (isset($data['company_id'])) ? $data['company_id'] : $this->session->userdata('company_id')),'expense_prefix_count');
				$next_count = next_number($current_count);
				$this->common->update('company_details',array('expense_prefix_count' => $next_count ),array('company_id' => (isset($data['company_id'])) ? $data['company_id'] : $this->session->userdata('company_id')));
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> (isset($data['company_id'])) ? $data['company_id'] : $this->session->userdata('company_id'),
					'log_category_id'	=> 10,
					'operation'			=> 'New Expenses Created',
					'operation_details'	=> 'New Expenses Created For '.$data['expense_person'],
					'expense_id'		=> $expense_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'Expense Added successfully',
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('expense_view/'.$expense_id));
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Expense adding failed',
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('expenses_list'));
			}
		}else{
			$data['expense_number'] = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'expense_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'expense_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			$data['category'] 	= convert_options($this->common->gets_array('mst_expense_categories',array('status' =>1)),'expense_category_id','expense_category','CATEGORY');
			//COMPANY LIST IF MULTIPLE COMPANY ENABLE
			if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){
				if($this->session->userdata('access_level')==1){
					$data['company_lists'] = array_column($this->user->get_company_list(), 'company_name');
				}elseif($this->session->userdata('access_level')==2){
					$data['company_lists'] = array_column($this->user->get_current_user_companies(), 'company_name');
				}
			}
			$this->template->build('expenses/new_expense',$data);
		}
	}
	public function expense_view($expense_id){
		$data['expense_detail'] = $this->expense->get_expense_details($expense_id);
		//echo "<pre>";print_r($data);exit;
		$this->template->build('expenses/expense_view',$data);
	}
	public function expense_edit($expense_id){
		if($this->input->post()){
			$data = $this->input->post();
			$expenses = array(
				'company_id'		=> (isset($data['company_id'])) ? $data['company_id'] : $this->session->userdata('company_id'),
				'expense_number' 	=> $data['expense_number'],
				'expense_date' 		=> $data['expense_date'],
				'expense_category_id' => $data['expense_category_id'],
				'expense_billno' 	=> $data['expense_billno'],
				'expense_amount' 	=> $data['expense_amount'],
				'expense_person' 	=> $data['expense_person'],
				'person_name'		=> $data['person_name'],
				'expense_remark' 	=> $data['expense_remark'],
				'expense_status' 	=> $data['expense_status'],
				'updated_on' 		=> created_on(),
				'updated_by' 		=> created_by(),
				'status' 			=> 1
			);
			$expense_update = $this->common->update('tbl_expenses',$expenses,array('expense_id' => $expense_id ));
			if($expense_update){
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> (isset($data['company_id'])) ? $data['company_id'] : $this->session->userdata('company_id'),
					'log_category_id'	=> 10,
					'operation'			=> 'Expenses Updated',
					'operation_details'	=> 'Expenses Updated For '.$data['expense_person'],
					'expense_id'		=> $expense_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'Expense update successfully',
				);
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Expense updating failed',
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('expense_view/'.$expense_id));
		}else{
			$data['expense_detail'] = $this->expense->get_expense_details($expense_id);
			if($data['expense_detail'] ){
				$data['category'] 	= convert_options_selected($this->common->gets_array('mst_expense_categories',array('status' =>1)),'expense_category_id','expense_category','CATEGORY',$data['expense_detail']['expense_category_id']);
			}else{
				$data['category'] 	= convert_options($this->common->gets_array('mst_expense_categories',array('status' =>1)),'expense_category_id','expense_category','CATEGORY');
			}
			$data['company_lists'] 	= convert_options_selected($this->common->gets_array('company_details',array('company_status' =>1,'company_id' => $data['expense_detail']['company_id'])),'company_id','company_name','COMPANY',$data['expense_detail']['company_id']);
			$this->template->build('expenses/new_expense',$data);
		}
	}
	public function expense_print($expense_id){
	}
	public function expense_download($expense_id){
	}
	public function expense_paid($expense_id){
		$update = array('expense_status' => 1 );
		$update_status = $this->common->update('tbl_expenses',$update,array('expense_id' => $expense_id ));
		if($update_status){
			$message = array(
				'result' 	=> 'success',
				'message' 	=> 'Expense Status Changed successfully',
			);
		}else{
			$message = array(
				'result' 	=> 'failed',
				'message' 	=> 'Expense Status Change failed',
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('expenses_list'));
	}
	public function expense_remove($expense_id){
		$update = array('status' => 0 );
		$update_status = $this->common->update('tbl_expenses',$update,array('expense_id' => $expense_id ));
		if($update_status){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'company_id'			=> $this->session->userdata('company_id'),
				'log_category_id'	=> 10,
				'operation'			=> 'Expenses Deleted',
				'operation_details'	=> 'Expenses Deleted By '.$this->session->userdata('user_id'),
				'expense_id'		=> $expense_id,
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' 	=> 'success',
				'message' 	=> 'Expense Removed successfully',
			);
		}else{
			$message = array(
				'result' 	=> 'failed',
				'message' 	=> 'Expense Remove failed',
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('expenses_list'));
	}
}
/* End of file Expenses.php */
/* Location: ./application/controllers/Expenses.php */