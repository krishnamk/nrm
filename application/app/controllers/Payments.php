<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Payments extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Payment_model','payment');
		if(!$this->session->userdata('invoice_logged_in')){
			redirect('login','refresh');
		}
	}
	//PURCHASE PAYMENT LIST
	public function purchase_payment_list(){
		$data['lists'] = $this->payment->get_purchase_payment_list();
		//echo "<pre>";print_r($data);exit;
		$this->template->build('payments/purchase/purchase_payment_list',$data);
	}
	public function purchase_payments_bill_details($purchase_payments_id){
		$data['payment'] = $this->payment->get_purchase_detail_bills($purchase_payments_id);
		//echo "<pre>";print_r($data);exit;
		$this->template->build('payments/purchase/purchase_payments',$data);
	}
	//ADD PURCHASE BILL PAYMENTS
	public function add_payment_bills(){
		$data = $this->input->post();
		//echo "<pre>";print_r($data);exit;
		$insert = array(
			'purchase_payments_id' 	=> $data['purchase_payments_id'],
			'company_id'			=> $this->session->userdata('company_id'),
			'supplier_id'			=> $data['supplier_id'],
			'purchase_amount' 		=> $data['purchase_amount'],
			'paid_amount' 			=> $data['paid_amount'],
			'balance_amount'		=> $data['balance_amount']-$data['paid_amount'],
			'payment_type' 			=> $data['payment_type'],
			'cheque_no' 			=> $data['cheque_number'],
			'upi_id'	 			=> $data['upi_id'],
			'bank_name' 			=> $data['bank_name'],
			'payment_date' 			=> date('Y-m-d',strtotime($data['payment_date'])),
			'remarks' 				=> $data['remark'],
			'created_on' 			=> created_on(),
			'created_by' 			=> created_by(),
			'status'				=> 1
		);
		$insert_result = $this->common->insert('tbl_purchase_payments_history',$insert);
		if($insert_result){
			$update = array('purchase_status' => 1 );
			$this->common->update('tbl_purchase_payments',$update,array('purchase_payments_id' => $data['purchase_payments_id'] ));
			$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $this->session->userdata('company_id'),
					'log_category_id'	=> 14,
					'operation'			=> 'Purchase Payment Added',
					'operation_details'	=> 'Purchase Payment Added -'.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $data['supplier_id']),'supplier_name'),
					'purchase_payment_id'=> $data['purchase_payments_id'],
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => 'Payment Added successfully',
			);
			if($data['balance_amount'] == $data['paid_amount']){
				$update = array('purchase_status' => 2 );
				$this->common->update('tbl_purchase_payments',$update,array('purchase_payments_id' => $data['purchase_payments_id'] ));
			}
		}else{
			$message = array(
				'result' => 'failed',
				'message' => 'Adding Payment Failed',
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('purchase_payments_bill_details/'.$data['purchase_payments_id']));
	}
}
/* End of file Payments.php */
/* Location: ./application/app/controllers/Payments.php */