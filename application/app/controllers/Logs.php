<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logs extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Logs_model','logs');
		if(!$this->session->userdata('invoice_logged_in')){
			redirect('login','refresh');
		}
	}

	public function index(){
		$data['categories'] = $this->logs->get_all_logs_notification();
		if($this->session->userdata('access_level') > 1){
			$data['log_notification_count'] = $this->common->count('tbl_logs',array('logs_status' => 0,'status' => 1,'user_id' => $this->session->userdata('user_id')));
		}else{
			$data['log_notification_count'] = $this->common->count('tbl_logs',array('logs_status' => 0,'status' => 1));
		}
		//echo "<pre>";print_r($data);exit;
		$this->template->build('logs/all_logs',$data);
	}

	//User List
	public function log_details($log_category_id){
		$data['log_category_id'] = $log_category_id;
		$data['lists'] = $this->logs->get_logs_details($log_category_id);
		//echo "<pre>";print_r($data);exit;
		$this->template->build('logs/logs_list',$data);
	}
	//Change Log category staus as read
	public function change_log_status($log_category_id){
		$log_status = array(
			'logs_status' => 1 );
		$update = $this->common->update('tbl_logs',$log_status,array('log_category_id' =>$log_category_id,'logs_status' => 0,'status' => 1));
		if($update){
			$message = array(
				'result' => 'success',
				'message' => 'Log Status Readed Successfully'
			);
		}else{
			$message = array(
				'result' => 'failed',
				'message' => 'Log Status Reading failed'
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('logs'));
	}

}