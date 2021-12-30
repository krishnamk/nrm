<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchase_order extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Purchase_order_model','purchase_order');
	}

	//PURCHASE ORDER VIEW
	public function purchase_order_view(){
		//$data = json_decode(file_get_contents('php://input'), true);
		$data = $this->input->get();
		if(!empty($data)){
			$purchase_order_details = $this->purchase_order->get_purchase_order_details($data['purchase_order_id']);
			if($purchase_order_details){
				$return_value = array(
					'is_reterived' 	=> true,
					'message'		=>	'Purchase Order View Retrieved',
					'data'			=>	$purchase_order_details
				);
			}else{
				$return_value = array(
					'is_reterived' 	=> false,
					'message'		=>	'Purchase Order View Retrieved Failed',
				);
			}
		}else{
			$return_value = array(
				'is_reterived' => false,
				'message' 	=> 'parameters are empty.',
			);
		}
		echo json_encode($return_value);
	}

	//PURCHASE ORDER LIST
	public function purchase_order_list(){
		$per_page_limit = 10;
		$page = $this->input->get('page');
		$total_rows = $this->common->count('tbl_purchase_orders','status!=0');
		//$total_page = ceil($total_rows / $per_page_limit);
		$current_page = isset($page) ? $page : 1;
		if($total_rows!="0"){
			if($total_rows>10){
				if($current_page==1){
					$start = $current_page;
				}else{
					$start = (($current_page-1) * $per_page_limit)+1;
				}
				if($current_page * $per_page_limit > $total_rows){
					$end = $total_rows;
				}else{
					$end = $current_page * $per_page_limit;
				}
				$data['pagination_des'] = "Showing ".($start)." to ".($end)." from ". $total_rows." results";
			}else{
				$start = $current_page;
				$data['pagination_des'] = "Showing ".($current_page+1)." to ".($total_rows)." from ". $total_rows." results";
			}
			//echo "<pre>";print_r("destination :");print_r($data['pagination_des']);
			//echo "<pre>";print_r("current page no:");print_r($current_page);//exit;
			//echo "<pre>";print_r("total row:");print_r($total_rows);//exit;
			//echo "<pre>";print_r("total pages:");print_r($total_page);//exit;

			$data = $this->purchase_order->get_purchase_order_lists($per_page_limit,$start-1);
			if($data){
				$return_value = array (
					'is_reterived' => true,
					'message'      => 'Purchase Order successfully Reterived',
					'data'         =>  $data
				);
			}else{
				$return_value = array(
					'is_reterived' => false,
					'message'      => 'Purchase Order reterived failed');
			}
		}else{
			$return_value = array(
				'is_reterived' => false,
				'message'      => 'Purchase Order List Empty');
		}
		
		echo json_encode($return_value);
	}
}