<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Accounts extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Accounts_model','accounts');
		if(!$this->session->userdata($this->config->item('session_verifier'))){
			redirect('login','refresh');
		}
	}

	public function sales_receipt_list(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['lists'] = $this->accounts->get_sales_receipt_list($data);
			if($data['option'] == 'view'){
				$this->template->build('accounts/sales_receipt/sales_receipt_list',$data);
			}else{
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$html = $this->load->view('accounts/sales_receipt/sales_receipt_list_pdf',$data,true);
				$pdf->WriteHTML($html);
				$pdf->Output('sales_receipt_listing_pdf.pdf','I');
			}
		}else{
			$data['lists'] = $this->accounts->get_sales_receipt_list();
			$this->template->build('accounts/sales_receipt/sales_receipt_list',$data);
		}
	}

	public function sales_receipt(){ 
		if($this->input->post()){
			$data = $this->input->post();
			//echo "<pre>";print_r($data);exit;
			$new_receipt = array(
				'company_id'		=> $this->session->userdata('company_id'),
				'receipt_number'	=> $data['receipt_number'],
				'receipt_date'		=> date('Y-m-d',strtotime($data['receipt_date'])),
				'customer_id'		=> $data['customer_id'],
				'customer_type_id'	=> $data['customer_type_id'],
				'paid_amount'		=> $data['paid_amount'],
				'payment_type'		=> $data['payment_type'],
				'cheque_no'			=> $data['checque_number'],
				'bank_name'			=> $data['bank_name'],
				'upi_id'			=> isset($data['upi_id']) ? $data['upi_id'] : '',
				'remarks'			=> $data['payment_remark'],
				'created_on'		=> created_on(),
				'created_by'		=> created_by(),
				'status'			=> 1
			);
			$receipt_id = $this->common->insert('tbl_receipts',$new_receipt);
			if($receipt_id){
				$current_count =$this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'sales_receipt_prefix_count');
				$next_count = next_number($current_count);
				$this->common->update('company_details',array('sales_receipt_prefix_count' => $next_count ),array('company_id' => $this->session->userdata('company_id')));
				$message = array(
					'result' => 'success',
					'message' => 'Sales Receipt Created Successfully'
				);
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $this->session->userdata('company_id'),
					'log_category_id'	=> 21,
					'operation'			=> 'Sales Receipt Created',
					'operation_details'	=> 'New Sales Receipt Created For '.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['customer_id']),'customer_name'),
					'customer_id'		=> $data['customer_id'],
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Sales Receipt Creation Failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('sales_receipt_list'));
		}else{
			$data['receipt_date'] = date('Y-m-d');
			$data['receipt_number'] = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'sales_receipt_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'sales_receipt_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'quotation_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			$this->template->build('accounts/sales_receipt/sales_receipt',$data);
		}
	}

	public function sales_receipt_edit($receipt_id){
		if($this->input->post()){
			$data = $this->input->post();
			$receipt = array(
				'company_id'		=> $this->session->userdata('company_id'),
				'receipt_number'	=> $data['receipt_number'],
				'receipt_date'		=> date('Y-m-d',strtotime($data['receipt_date'])),
				'customer_id'		=> $data['customer_id'],
				'customer_type_id'	=> $data['customer_type_id'],
				'paid_amount'		=> $data['paid_amount'],
				'payment_type'		=> $data['payment_type'],
				'cheque_no'			=> $data['checque_number'],
				'bank_name'			=> $data['bank_name'],
				'upi_id'			=> isset($data['upi_id']) ? $data['upi_id'] : '',
				'remarks'			=> $data['payment_remark'],
				'updated_on'		=> created_on(),
				'updated_by'		=> created_by(),
				'status'			=> 1
			);
			$receipt_update = $this->common->update('tbl_receipts',$receipt,array('receipt_id' => $receipt_id));
			if($receipt_update){
				$message = array(
					'result' => 'success',
					'message' => 'Sales Receipt Updated Successfully'
				);
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $this->session->userdata('company_id'),
					'log_category_id'	=> 21,
					'operation'			=> 'Sales Receipt Updated',
					'operation_details'	=> 'Sales Receipt Updated For '.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['customer_id']),'customer_name'),
					'customer_id'		=> $data['customer_id'],
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Sales Receipt Update Failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('sales_receipt_list'));
		}else{
			$data['receipt'] = $this->common->get_array('tbl_receipts',array('receipt_id' => $receipt_id ));
			$data['receipt_date'] = date('Y-m-d',strtotime($data['receipt']['receipt_date']));
			$data['receipt_number'] = $data['receipt']['receipt_number'];
			$this->template->build('accounts/sales_receipt/sales_receipt',$data);
		}
	}

	public function sales_receipt_voucher($receipt_id){
		$data['receipt'] = $this->accounts->get_sales_receipt_details($receipt_id);
		//echo "<pre>";print_r($data);exit;
		$content = $this->load->view('accounts/sales_receipt/sales_receipts_voucher', $data, TRUE);
		echo $content;
	}
	public function sales_receipt_voucher_print($receipt_id){
		$data['receipt'] = $this->accounts->get_sales_receipt_details($receipt_id);
		$html = $this->load->view('accounts/sales_receipt/sales_receipts_voucher_print',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output('SALES_VOUCHER.pdf','I');
	}

	public function sales_receipt_remove($receipt_id){
		$customer_id = $this->common->get_particular('tbl_receipts',array('receipt_id' => $receipt_id),'customer_id');
		$receipt_update = array(
			'updated_on'	=> created_on(),
			'updated_by'	=> created_by(),
			'status'		=> 0
		);
		$receipt_update_result = $this->common->update('tbl_receipts',$receipt_update,array('receipt_id' => $receipt_id));
		if($receipt_update_result){
			$message = array(
				'result' => 'success',
				'message' => 'Sales Receipt Removed Successfully'
			);
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'company_id'		=> $this->session->userdata('company_id'),
				'log_category_id'	=> 21,
				'operation'			=> 'Sales Receipt Deleted',
				'operation_details'	=> 'Sales Receipt Deleted For '.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['customer_id']),'customer_name'),
				'customer_id'		=> $data['customer_id'],
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
		}else{
			$message = array(
				'result' => 'failed',
				'message' => 'Sales Receipt Remove Failed'
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('sales_receipt_list'));
	}
	public function sales_receipt_view($receipt_id){
		$data['receipt'] = $this->accounts->get_sales_receipt_details($receipt_id);
		$content = $this->load->view('accounts/sales_receipt/sales_receipt_view', $data, TRUE);
		echo $content;
	}

	//PURCHASE PAYMENT
	public function purchase_payments_view($payment_id){
		$data['payment'] = $this->accounts->get_purchase_payment_details($payment_id);
		$content = $this->load->view('accounts/purchase_payment/purchase_payments_view', $data, TRUE);
		echo $content;
	}
	public function purchase_payments_voucher($payment_id){
		$data['payment'] = $this->accounts->get_purchase_payment_details($payment_id);
		//echo "<pre>";print_r($data);exit;
		$content = $this->load->view('accounts/purchase_payment/purchase_payments_voucher', $data, TRUE);
		echo $content;
	}
	public function purchase_payments_voucher_print($payment_id){
		$data['payment'] = $this->accounts->get_purchase_payment_details($payment_id);
		//echo "<pre>";print_r($data);exit;
		$html = $this->load->view('accounts/purchase_payment/purchase_payments_voucher_print',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output('PURCHASE_VOUCHER.pdf','I');
	}
	public function purchase_payments_list(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['lists'] = $this->accounts->get_purchase_payment_list($data);
			if($data['option'] == 'view'){
				$this->template->build('accounts/purchase_payment/purchase_payments_list',$data);
			}else{
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$html = $this->load->view('accounts/purchase_payment/purchase_payments_list_pdf',$data,true);
				$pdf->WriteHTML($html);
				$pdf->Output('purchase_payments_listing_pdf.pdf','I');
			}
		}else{
			$data['lists'] = $this->accounts->get_purchase_payment_list();
			$this->template->build('accounts/purchase_payment/purchase_payments_list',$data);
		}
	}

	public function purchase_payments(){
		if($this->input->post()){
			$data = $this->input->post();
			$new_payment = array(
				'company_id'		=> $this->session->userdata('company_id'),
				'payment_number'	=> $data['payment_number'],
				'payment_date'		=> date('Y-m-d',strtotime($data['payment_date'])),
				'supplier_id'		=> $data['supplier_id'],
				'paid_amount'		=> $data['paid_amount'],
				'payment_type'		=> $data['payment_type'],
				'cheque_no'			=> $data['checque_number'],
				'bank_name'			=> $data['bank_name'],
				'upi_id'			=> isset($data['upi_id']) ? $data['upi_id'] : '',
				'remarks'			=> $data['payment_remark'],
				'created_on'		=> created_on(),
				'created_by'		=> created_by(),
				'status'			=> 1
			);
			$payment_id = $this->common->insert('tbl_payments',$new_payment);
			if($payment_id){
				$current_count =$this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'purchase_payment_prefix_count');
				$next_count = next_number($current_count);
				$this->common->update('company_details',array('purchase_payment_prefix_count' => $next_count ),array('company_id' => $this->session->userdata('company_id')));
				$message = array(
					'result' => 'success',
					'message' => 'Purchase Payment Created Successfully'
				);
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $this->session->userdata('company_id'),
					'log_category_id'	=> 21,
					'operation'			=> 'Purchase payment Created',
					'operation_details'	=> 'New Purchase payment Created For '.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $data['supplier_id']),'supplier_name'),
					'supplier_id'		=> $data['supplier_id'],
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Purchase Payment Creation Failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('purchase_payments_list'));
		}else{
			$data['payment_date'] = date('Y-m-d');
			$data['payment_number'] = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'purchase_payment_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'purchase_payment_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'quotation_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			$this->template->build('accounts/purchase_payment/purchase_payments',$data);
		}
	}

	public function purchase_payments_edit($payment_id){
		if($this->input->post()){
			$data = $this->input->post();
			$payment = array(
				'company_id'		=> $this->session->userdata('company_id'),
				'payment_number'	=> $data['payment_number'],
				'payment_date'		=> date('Y-m-d',strtotime($data['payment_date'])),
				'supplier_id'		=> $data['supplier_id'],
				'paid_amount'		=> $data['paid_amount'],
				'payment_type'		=> $data['payment_type'],
				'cheque_no'			=> $data['checque_number'],
				'bank_name'			=> $data['bank_name'],
				'upi_id'			=> isset($data['upi_id']) ? $data['upi_id'] : '',
				'remarks'			=> $data['payment_remark'],
				'updated_on'		=> created_on(),
				'updated_by'		=> created_by(),
				'status'			=> 1
			);
			$payment_update = $this->common->update('tbl_payments',$payment,array('payment_id' => $payment_id));
			if($payment_update){
				$message = array(
					'result' => 'success',
					'message' => 'Purchase Payment Updated Successfully'
				);
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $this->session->userdata('company_id'),
					'log_category_id'	=> 21,
					'operation'			=> 'Purchase payment Updated',
					'operation_details'	=> 'Purchase payment Updated For '.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $data['supplier_id']),'supplier_name'),
					'supplier_id'		=> $data['supplier_id'],
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Purchase payment Update Failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('purchase_payments_list'));
		}else{
			$data['payment'] = $this->common->get_array('tbl_payments',array('payment_id' => $payment_id ));
			$data['payment_date'] = date('Y-m-d',strtotime($data['payment']['payment_date']));
			$data['payment_number'] = $data['payment']['payment_number'];
			$this->template->build('accounts/purchase_payment/purchase_payments',$data);
		}
	}

	public function purchase_payments_remove($payment_id){
		$supplier_id = $this->common->get_particular('tbl_payments',array('payment_id' => $payment_id),'supplier_id');
		$payment_update = array(
			'updated_on'	=> created_on(),
			'updated_by'	=> created_by(),
			'status'		=> 0
		);
		$payment_update_result = $this->common->update('tbl_payments',$payment_update,array('payment_id' => $payment_id));
		if($payment_update_result){
			$message = array(
				'result' => 'success',
				'message' => 'Purchase Payment Removed Successfully'
			);
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'company_id'		=> $this->session->userdata('company_id'),
				'log_category_id'	=> 21,
				'operation'			=> 'Purchase payment Deleted',
				'operation_details'	=> 'Purchase payment Deleted For '.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $supplier_id),'supplier_name'),
				'supplier_id'		=> $supplier_id,
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
		}else{
			$message = array(
				'result' => 'failed',
				'message' => 'Purchase Payment Remove Failed'
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('purchase_payments_list'));
	}

	//JOURNAL
	public function journal_list(){
		if($this->input->post()){
			$data = $this->input->post();
			$data['lists'] = $this->accounts->get_journal_list($data);
			if($data['option'] == 'view'){
				$this->template->build('accounts/journal/journal_list',$data);
			}else{
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$html = $this->load->view('accounts/journal/journal_list_pdf',$data,true);
				$pdf->WriteHTML($html);
				$pdf->Output('journal_list_pdf.pdf','I');
			}
			$this->template->build('accounts/journal/journal_list',$data);
		}else{
			$data['lists'] = $this->accounts->get_journal_list();
			$this->template->build('accounts/journal/journal_list',$data);
		}
	}                   
	public function journal(){
		if($this->input->post()){
			$data = $this->input->post();
			//echo '<pre>';print_r($data);exit;
			$journal = array(
				'company_id'		=> $this->session->userdata('company_id'),
				'journal_number'	=> $data['journal_number'],
				'journal_date'		=> $data['journal_date'],
				'journal_type'		=> $data['journal_type'],
				'supplier_id'		=> $data['supplier_id'],
				'customer_id'		=> $data['customer_id'],
				'amount'			=> $data['amount'],
				'remarks'			=> $data['remarks'],
				'created_on'		=> created_on(),
				'created_by'		=> created_by(),
				'status'			=> 1
			);
			$journal_id = $this->common->insert('tbl_journals',$journal);
			if($journal_id){
				$current_count =$this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'journal_prefix_count');
				$next_count = next_number($current_count);
				$this->common->update('company_details',array('journal_prefix_count' => $next_count ),array('company_id' => $this->session->userdata('company_id')));
				$message = array(
					'result' => 'success',
					'message' => 'New Journal Added Successfully'
				);
				if($data['journal_type'] == 'customer'){
					$operation_details = 'New Journal Added For '.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['customer_id']),'customer_name');
				}else{
					$operation_details = 'New Journal Received From '.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $data['supplier_id']),'supplier_name');
				}
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $this->session->userdata('company_id'),
					'log_category_id'	=> 21,
					'operation'			=> 'Journal Created',
					'operation_details'	=> $operation_details,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'New Journal Adding Failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('journal_list'));
		}else{
			$data['journal_date'] = date('Y-m-d');
			$data['journal_number'] = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'journal_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'journal_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			//echo "<pre>";print_r($data);exit;
			$this->template->build('accounts/journal/journal',$data);
		}
	}
	public function journal_edit($journal_id){
		if($this->input->post()){
			$data = $this->input->post();
			$journal_update = array(
				'company_id'		=> $this->session->userdata('company_id'),
				'journal_number'	=> $data['journal_number'],
				'journal_date'		=> $data['journal_date'],
				'journal_type'		=> $data['journal_type'],
				'supplier_id'		=> $data['supplier_id'],
				'customer_id'		=> $data['customer_id'],
				'amount'			=> $data['amount'],
				'remarks'			=> $data['remarks'],
				'updated_on'		=> created_on(),
				'updated_by'		=> created_by(),
				'status'			=> 1
			);
			$journal_update_result = $this->common->update('tbl_journals',$journal_update,array('journal_id' => $journal_id ));
			if($journal_update_result){
				$message = array(
					'result' => 'success',
					'message' => 'Journal Updated Successfully'
				);
				if($data['journal_type'] == 'customer'){
					$operation_details = 'Journal Updated For '.$this->common->get_particular('mst_customers',array( 'customer_id' => $data['customer_id']),'customer_name');
				}else{
					$operation_details = 'Journal Updated From '.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $data['supplier_id']),'supplier_name');
				}
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $this->session->userdata('company_id'),
					'log_category_id'	=> 21,
					'operation'			=> 'Journal Updated',
					'operation_details'	=> $operation_details,
					'remarks'			=> '',
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Journal Update Failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('journal_list'));
		}else{
			$data['journal'] = $this->common->get_array('tbl_journals',array('journal_id' => $journal_id ));
			$data['journal_date'] = $data['journal']['journal_date'];
			$data['journal_number'] = $data['journal']['journal_number'];
			//echo "<pre>";print_r($data);exit;
			$this->template->build('accounts/journal/journal',$data);
		}
	}
	public function journal_remove($journal_id){
		$journal_type = $this->common->get_particular('tbl_journals',array( 'journal_id' => $journal_id),'journal_type');
		$journal_update = array(
			'status' => 0
		);
		$journal_update_result = $this->common->update('tbl_journals',$journal_update,array('journal_id' => $journal_id));
		if($journal_update_result){
			$message = array(
				'result' => 'success',
				'message' => 'Journal Removed Successfully'
			);
			if($journal_type == 'customer'){
				$customer_id = $this->common->get_particular('tbl_journals',array('journal_id' => $journal_id),'customer_id');
				$operation_details = 'Journal Removed For '.$this->common->get_particular('mst_customers',array( 'customer_id' => $customer_id),'customer_name');
			}else{
				$supplier_id = $this->common->get_particular('tbl_journals',array('journal_id' => $journal_id),'supplier_id');
				$operation_details = 'Journal Removed From '.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $supplier_id),'supplier_name');
			}
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'company_id'		=> $this->session->userdata('company_id'),
				'log_category_id'	=> 21,
				'operation'			=> 'Journal Removed',
				'operation_details'	=> $operation_details,
				'remarks'			=> '',
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
		}else{
			$message = array(
				'result' => 'failed',
				'message' => 'Journal Remove Failed'
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('journal_list'));
	}
	public function journal_view($journal_id){
		$data['journal'] = $this->accounts->get_journal_details($journal_id);
		//echo "<pre>";print_r($data);exit;
		$content = $this->load->view('accounts/journal/journal_view', $data, TRUE);
		echo $content;
	}

}